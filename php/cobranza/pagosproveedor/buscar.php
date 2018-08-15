<?php
	include ('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarclientes':
			clientes($conexion_usuarios);
			break;

		case 'buscarproveedores':
			proveedores($conexion_usuarios);
			break;

		case 'buscarcuentas':
			cuentas($conexion_usuarios);
			break;

		case 'buscartotal':
			$facoc = $_POST['facoc'];
			$buscarpor = $_POST['buscarpor'];
			buscar_total($facoc, $buscarpor, $conexion_usuarios);
			break;

		case 'buscartotalpedidoscliente':
			$facturas = json_decode($_POST['facturas']);
			buscar_total_pedidos_cliente($facturas, $conexion_usuarios);
			break;

		case 'buscartotalpedidosproveedores':
			$proveedor = $_POST['idproveedor'];
			$pedidos = json_decode($_POST['pedidos']);
			buscar_total_pedidos_proveedor($proveedor, $pedidos, $conexion_usuarios);
			break;

		case 'buscartotalpedidos':
			$idproveedor = $_POST['idproveedor'];
			$pedidos = json_decode($_POST['pedidos']);
			buscar_total_pedidos($idproveedor, $pedidos, $conexion_usuarios);
			break;
	}

	function buscar_total_pedidos_cliente($facturas, $conexion_usuarios){
		$total = 0;
		foreach ($facturas as &$factura) {
			$query = "SELECT * FROM facturas WHERE folio = '$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1 || !$resultado) {
				$query2 = "SELECT * FROM cotizacion WHERE factura = '$factura'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				while($data2 = mysqli_fetch_assoc($resultado2)){
					$total = $total + (($data2['precioTotal'] * 1.16) - $data2['Pagado']);
				}
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$total = $total + ($data['total'] - $data['pagado']);
				}
			}
		}


		$arreglo['total'] = round($total,2);
		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_total_pedidos_proveedor($proveedor, $pedidos, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE tipo='Proveedor' AND nombreEmpresa LIKE '%$proveedor%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
			$idcliente = $data['id'];
		}

		$total = 0;
		foreach ($pedidos as &$factura) {
			$query="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$monedapedido = $data['moneda_pedido'];

				if ($monedaproveedor == "usd") {
					$total = $total + (($data['costo_usd'] * $data['cantidad'])*1.16);
				}else{
					$total = $total + (($data['costo_mn'] * $data['cantidad'])*1.16);
				}
			}
		}


		$arreglo['total'] = round($total, 2);
		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_total_pedidos($idproveedor, $pedidos, $conexion_usuarios){
		$query = "SELECT moneda FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
		}

		$total = 0;
		foreach ($pedidos as &$valor) {
			$factura = $valor;
			$query="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				if ($monedaproveedor == "usd") {
					$total = $total + ($data['costo_usd'] * $data['cantidad']);
				}else{
					$total = $total + ($data['costo_mn'] * $data['cantidad']);
				}
			}
		}

		$arreglo['total'] = $total;
		echo json_encode($arreglo);
	}

	function clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Cliente' AND nombreEmpresa != ''";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function proveedores($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Proveedor' AND nombreEmpresa != ''";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cuentas($conexion_usuarios){
		$query = "SELECT * FROM accounts ORDER BY id";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = $data;
 			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_total($facoc, $buscarpor, $conexion_usuarios){

		if ($buscarpor == "factura" ) {
			$query = "SELECT * FROM utilidad_pedido WHERE factura_proveedor = '$facoc'";
		}else{
			$query = "SELECT * FROM utilidad_pedido WHERE orden_compra = '$facoc'";
		}
		$resultado = mysqli_query($conexion_usuarios, $query);
		$total = 0;
		while($data = mysqli_fetch_assoc($resultado)){
			$idproveedor = $data['proveedor'];

			$query2 = "SELECT moneda,nombreEmpresa FROM contactos WHERE id = '$idproveedor'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);
			while($data2 = mysqli_fetch_assoc($resultado2)){
				$monedaproveedor = $data2['moneda'];
				$arreglo['cliente'] = $data2['nombreEmpresa'];
			}

			if ($monedaproveedor == "usd") {
				$total = $total + ($data['costo_usd'] * $data['cantidad']);
			}else{
				$total = $total + ($data['costo_mn'] * $data['cantidad']);
			}
		}
		$arreglo['pedido'] = $total;

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}

?>