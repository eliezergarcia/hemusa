<?php 
	
	include("../../conexion.php");

	$idcliente = $_POST['idcliente'];

	// $query = "SELECT * FROM pedidos WHERE cliente = '$idcliente' AND pagado != total";
	// $resultado = mysqli_query($conexion_usuarios, $query);


	// if (!$resultado) {
	// 	die("Error!");
	// }else{
	// 	while($data = mysqli_fetch_assoc($resultado)){
	// 		$idcliente = $data['cliente'];
	// 		$querycliente = "SELECT nombreEmpresa FROM contactos WHERE id='$idcliente'";
	// 		$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
	// 		while($datacliente = mysqli_fetch_assoc($resultadocliente)){
	// 			$cliente = $datacliente['nombreEmpresa'];
	// 		}

	// 		$check = "<input type='checkbox' name='pedido' value='".$data['id']."'>";

	// 		$arreglo["data"][] = array(
	// 			'check' => $check,				
	// 			'cliente' => $cliente,
	// 			'factura' => $data['factura'],
	// 			'ordencompra' => $data['numeroPedido'],
	// 			'moneda' => $data['moneda'],
	// 			'abonado' => $data['pagado'],
	// 			'pendiente' => "$ ".round($data['total'] - $data['pagado'], 4),
	// 			'total' => "$ ".$data['total']
	// 		);
	// 	}
	// }

	$query = "SELECT * FROM cotizacion WHERE cliente = '$idcliente' AND factura!=0 AND NoPedClient != '0' AND Pagado < 1.14 * precioTotal ORDER BY facturaFecha ASC";
	$resultado = mysqli_query($conexion_usuarios, $query);

	
	if (!$resultado) {
		die("Error!");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
			$querycliente = "SELECT nombreEmpresa FROM contactos WHERE id='$idcliente'";
			$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
			while($datacliente = mysqli_fetch_assoc($resultadocliente)){
				$cliente = $datacliente['nombreEmpresa'];
			}

			$check = "<input type='checkbox' name='pedido' value='".$data['id']."' onclick='cambiar_total()'>";

			$abonado = round($data['Pagado'], 2);
			$total = $data['precioTotal'] * 1.16;
			$pendiente = $total - $abonado;

			$arreglo["data"][] = array(
				'check' => $check,				
				'cliente' => $cliente,
				'factura' => $data['factura'],
				'ordencompra' => $data['NoPedClient'],
				'moneda' => $data['moneda'],
				'abonado' => "$ ".round($data['Pagado'],2),
				'pendiente' => "$ ".(round($data["precioTotal"]*(1+$data["IVA"]),2) - $data['Pagado']),
				'total' => "$ ".$data['precioTotal'] * 1.16
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>