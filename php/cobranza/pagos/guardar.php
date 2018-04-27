<?php 
	include('../../conexion.php');

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			$cliente = json_decode($_POST['cliente']);
			$tipo = json_decode($_POST['registrarpor']);
			$facoc = json_decode($_POST['facoc']);
			$fecha = json_decode($_POST['fecha']);
			$monto = json_decode($_POST['monto']);
			$cuenta = json_decode($_POST['cuenta']);
			$tipocambio = json_decode($_POST['tipocambio']);
			$numeropagos = $_POST['numeropagos'];
			// $existe = existe_pago($tipo, $facoc, $cliente, $conexion_usuarios);
			// if($existe > 0 ){
			// 	$informacion["respuesta"] = "EXISTE";
			// 	echo json_encode($informacion);
			// }else{
			// }
				registrar($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $numeropagos, $conexion_usuarios);
			
			break;

		case 'registrarpagoscliente':
			$cliente = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$numeropartidas = $_POST['numeroPartidas'];
			$pagos = json_decode($_POST['pagos']);
			registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $pagos, $conexion_usuarios);
			break;

		case 'editarpagocliente':
			$idpago = $_POST['idpago'];
			$fechapago = $_POST['fechapago'];
			$tcpago = $_POST['tcpago'];
			$bancopago = $_POST['bancopago'];
			editar_pago_cliente($idpago, $fechapago, $tcpago, $bancopago, $conexion_usuarios);
			break;

		case 'eliminarfacturapago':
			$idpago = $_POST['idpago'];
			$facturas = json_decode($_POST['facturas']);
			eliminar_factura_pago($idpago, $facturas, $conexion_usuarios);
			break;

		case 'registrarproveedor':
			$cliente = $_POST['cliente'];
			$tipo = $_POST['registrarpor'];
			$facoc = $_POST['facoc'];
			$fecha = $_POST['fecha'];
			$monto = $_POST['monto'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			registrarproveedor($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $conexion_usuarios);
			
			break;
		case 'registrarpagosproveedor':
			$proveedor = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$total = $_POST['total'];
			$facturas = json_decode($_POST['pagos']);
			registrar_pagos_proveedor($proveedor, $fecha, $cuenta, $total, $tipocambio, $facturas, $conexion_usuarios);
			break;
	}

	function existe_pago($tipo, $facoc, $cliente, $conexion_usuarios){
		if ($tipo == "factura") {
			$query = "SELECT id FROM pagos WHERE factura = '$facoc' AND cliente = '$cliente'";
		}else{
			$query = "SELECT id FROM pagos WHERE ordenCompra = '$facoc' AND cliente = '$cliente'";
		}

		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_pago = mysqli_num_rows( $resultado );
		return $existe_pago;
	}

	function registrar($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $numeropagos, $conexion_usuarios){	
		for ($i=0; $i < $numeropagos ; $i++) { 
			$clien = $cliente[$i];
			$tip = $tipo[$i];
			$fac = $facoc[$i];
			$fec = $fecha[$i];
			$mon = $monto[$i];
			$cuen = $cuenta[$i];
			$tipoca = $tipocambio[$i];
			if ($tip == "factura") {
				$query = "INSERT INTO pagos (cliente,tipo,factura,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				// $query = "SELECT cliente FROM pedidos WHERE factura = '$fac'";
				// $resultado = mysqli_query($conexion_usuarios, $query);

				// if (!$resultado) {
				// 	die("Error al buscar id cliente!");
				// }else{
				// 	while($data = mysqli_fetch_assoc($resultado){
				// 		$clien = $data['cliente'];
				// 	}
				// 	$query = "INSERT INTO pagos (cliente,tipo,factura,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				// 	$resultado = mysqli_query($conexion_usuarios, $query);		
				// }

			}else{
				$query = "INSERT INTO pagos (cliente,tipo,ordenCompra,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				// $query = "SELECT * FROM pedidos WHERE numeroPedido = '$fac'";
				// $resultado = mysqli_query($conexion_usuarios, $query);
				
				// while($data = mysqli_fetch_assoc($resultado){
				// 	$clien = $data['cliente'];
				// }

				// $query2 = "INSERT INTO pagos (cliente,tipo,ordenCompra,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				// $resultado2 = mysqli_query($conexion_usuarios, $query2);		
			}

		}
		verificar_resultado($resultado);
		
		// cerrar($conexion_usuarios);
	}

	function registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $pagos, $conexion_usuarios){
		$totalpagar = 0;
		foreach ($pagos as &$valor) {
			$idpedido = $valor;
			$query = "SELECT * FROM cotizacion WHERE id ='$idpedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				verificar_resultado($resultado);
			}else{

				while($data = mysqli_fetch_assoc($resultado)){					
					$moneda = $data['moneda'];
					$total = $data['precioTotal'] * 1.16;
					$pagado = $data['Pagado'];
					$monto = $total - $pagado;

					if ($moneda == "usd") {
						$monto = $monto * $tipocambio;
					}
				}

				$totalpagar = $totalpagar + $monto;
			}
		}

		$query = "INSERT INTO payments (client, date, amount, account, exchangeRate) VALUES ('$cliente', '$fecha', '$totalpagar', '$cuenta', '$tipocambio')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			foreach ($pagos as &$valor) {
				$idpedido = $valor;
				$total = 0;
				$query = "SELECT * FROM cotizacion WHERE id = '$idpedido'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if(!$resultado){
					verificar_resultado($resultado);
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$total = $data['precioTotal'] * 1.16;
						$query2 = "UPDATE cotizacion SET Pagado = '$total' WHERE id='$idpedido'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
					}
				}
			}

			if (!$resultado2) {
				verificar_resultado($resultado2);
			}else{
				$query = "SELECT * FROM payments ORDER BY id DESC LIMIT 1";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					verificar_resultado($resultado);
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$idpago = $data['id'];
					}

					foreach ($pagos as &$valor) {
						$idpedido = $valor;
						$query = "UPDATE cotizacion SET idpago = '$idpago' WHERE id = '$idpedido'";
						$resultado = mysqli_query($conexion_usuarios, $query);
					}
					verificar_resultado($resultado);
				}
			}
		}
	}

	function editar_pago_cliente($idpago, $fechapago, $tcpago, $bancopago, $conexion_usuarios){
		$query = "UPDATE payments SET date = '$fechapago', exchangeRate = '$tcpago', account = '$bancopago' WHERE id = '$idpago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			if ($tcpago > 1) {
				$monto = 0;
				$query = "SELECT * FROM cotizacion WHERE idpago = '$idpago'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				while($data = mysqli_fetch_assoc($resultado)){
					$monto = $monto + (($data['precioTotal'] * 1.16) * $tcpago);
				}
				$query = "UPDATE payments SET amount = '$monto' WHERE id = '$idpago'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				verificar_resultado($resultado);
			}else{
				$monto = 0;
				$query = "SELECT * FROM cotizacion WHERE idpago = '$idpago'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				while($data = mysqli_fetch_assoc($resultado)){
					$monto = $monto + ($data['precioTotal'] * 1.16);
				}

				$query = "UPDATE payments SET amount = '$monto' WHERE id = '$idpago'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				verificar_resultado($resultado);
			}
		}
	}

	function eliminar_factura_pago($idpago, $facturas, $conexion_usuarios){
		foreach ($facturas as &$valor) {
			$idfactura = $valor;
			$query = "SELECT * FROM cotizacion WHERE id = '$idfactura'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				verificar_resultado($resultado);
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$monto = $data['Pagado'];
				}
				$pagado = 0;
				$eliminaridpago = 0;
				$query = "UPDATE cotizacion SET Pagado = '$pagado', idpago = '$eliminaridpago' WHERE id = '$idfactura'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if (!$resultado) {
					verificar_resultado($resultado);
				}else{
					$query = "SELECT * FROM payments WHERE id = '$idpago'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					while($data = mysqli_fetch_assoc($resultado)){
						$total = $data['amount'];
						$tipocambio = $data['exchangeRate'];
					}

					if ($tipocambio > 1) {
						$total = $total - ($monto * $tipocambio);
					}else{
						$total = $total - $monto;
					}

					$query = "UPDATE payments SET amount = '$total' WHERE id = '$idpago'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					verificar_resultado($resultado);
				}
			}
		}
	}

	function registrarproveedor($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $conexion_usuarios){	
		$monto = $monto * 1.16;
		$query = "SELECT id,moneda FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idproveedor = $data['id'];
			$monedaproveedor = $data['moneda'];
		}

		$fecha = date("Y-m-d");

		if ($tipo == "factura") {
			$query = "INSERT INTO pagos_oc (proveedor, monto,fecha,cuenta,factura,tipo_cambio) VALUES('$idproveedor', '$monto', '$fecha', '$cuenta', '$facoc', '$tipocambio')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET pagada = 'si', pago_factura =  '$monto', fecha_pago = '$fecha', total_factura = '$monto' WHERE factura_proveedor = '$facoc'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}else{
			$query = "INSERT INTO pagos_oc (proveedor, monto,fecha,cuenta,orden_compra,tipo_cambio) VALUES('$idproveedor', '$monto', '$fecha', '$cuenta', '$facoc', '$tipocambio')";
			$resultado = mysqli_query($conexion_usuarios, $query);	

			$query = "UPDATE utilidad_pedido SET pagada = 'si', pago_factura =  '$monto', fecha_pago = '$fecha', total_factura = '$monto' WHERE orden_compra = '$facoc'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		verificar_resultado($resultado);
	}

	function registrar_pagos_proveedor($proveedor, $fecha, $cuenta, $total, $tipocambio, $facturas, $conexion_usuarios){
		$total = $total * 1.16;
		$query = "INSERT INTO pagos_oc (proveedor, monto, fecha, cuenta, tipo_cambio) VALUES ('$proveedor', '$total', '$fecha', '$cuenta', '$tipocambio')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT moneda FROM contactos WHERE id = '$proveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
		}

		foreach ($facturas as &$valor) {
			$factura = $valor;

			$query="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$total = 0;
			while($data = mysqli_fetch_assoc($resultado)){
				if ($monedaproveedor == "usd") {
					$total = $total + ($data['costo_usd'] * $data['cantidad']);
				}else{
					$total = $total + ($data['costo_mn'] * $data['cantidad']);
				}
			}
			$total = $total * 1.16;
			$fecha = date("Y-m-d");
			$query2="UPDATE utilidad_pedido SET pagada = 'si', pago_factura = '$total', fecha_pago = '$fecha', cuenta = '$cuenta', total_factura = '$total' WHERE factura_proveedor = '$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);
		}
		verificar_resultado($resultado);
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{ 
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

 ?>