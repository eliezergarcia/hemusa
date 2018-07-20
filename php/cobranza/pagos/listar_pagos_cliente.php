<?php

	include("../../conexion.php");

	$cliente = $_POST['idcliente'];

	$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($data = mysqli_fetch_assoc($resultado)){
		$idcliente = $data['id'];
	}

	$query = "SELECT * FROM facturas WHERE cliente = '$cliente' AND pagado != total";
	$resultado = mysqli_query($conexion_usuarios, $query);


	if (mysqli_num_rows($resultado) < 1) {
		// $arreglo['data'] = 0;
	}else{
		while($data = mysqli_fetch_assoc($resultado)){

			$check = "<input type='checkbox' name='pedido' value='".$data['id']."'>";

			$arreglo["data"][] = array(
				'id' => $data['id'],
				'cliente' => $cliente,
				'factura' => $data['folio'],
				'ordencompra' => $data['ordenpedido'],
				'moneda' => $data['moneda'],
				'abonado' => "$ ".round($data['pagado'],2),
				'pendiente' => "$ ".round($data['total'] - $data['pagado'], 2),
				'total' => "$ ".round($data['total'],2)
			);
		}
	}

	$query = "SELECT * FROM cotizacion WHERE cliente = '$idcliente' AND factura!=0 AND NoPedClient != '0' AND (Pagado < 1.14 * precioTotal) AND facturaFecha > '2017-01-01' ORDER BY facturaFecha ASC";
	$resultado = mysqli_query($conexion_usuarios, $query);


	if (mysqli_num_rows($resultado) < 1) {
		// $arreglo['data'] = 0;
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$check = "<input type='checkbox' name='pedido' value='".$data['id']."' onclick='cambiar_total()'>";

			$abonado = round($data['Pagado'], 2);
			$total = $data['precioTotal'] * 1.16;
			$pendiente = $total - $abonado;

			$arreglo["data"][] = array(
				'id' => $data['id'],
				'check' => $check,
				'cliente' => $cliente,
				'factura' => $data['factura'],
				'ordencompra' => $data['NoPedClient'],
				'moneda' => $data['moneda'],
				'abonado' => "$ ".round($data['Pagado'],2),
				'pendiente' => "$ ".round($pendiente,2),
				'total' => "$ ".round($data['precioTotal'] * 1.16,2)
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
