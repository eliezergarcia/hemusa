<?php

	include("../../conexion.php");

	$cliente = $_POST['idcliente'];

	$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($data = mysqli_fetch_assoc($resultado)){
		$idcliente = $data['id'];
	}

	$query = "SELECT payments.*, contactos.nombreEmpresa, accounts.nombre FROM payments INNER JOIN contactos ON contactos.id=payments.client INNER JOIN accounts ON accounts.id=payments.account WHERE client = '$idcliente' AND date > '2017-01-01' ORDER BY id DESC";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (mysqli_num_rows($resultado) < 1) {
		$arreglo['data'] = 0;
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			// $idcliente = $data['client'];
			// $idpago = $data['id'];
			// $cuenta = $data['account'];
			//
			// $querycliente = "SELECT nombreEmpresa FROM contactos WHERE id='$idcliente'";
			// $resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
			// while($datacliente = mysqli_fetch_assoc($resultadocliente)){
			// 	$cliente = $datacliente['nombreEmpresa'];
			// }
			//
			// $querybanco = "SELECT nombre FROM accounts WHERE id='$cuenta'";
			// $resultadobanco = mysqli_query($conexion_usuarios, $querybanco);
			// while($databanco = mysqli_fetch_assoc($resultadobanco)){
			// 	$banco = $databanco['nombre'];
			// }

			$arreglo["data"][] = array(
				'idpedido' => $data['id'],
				'tipocambio' => $data['exchangeRate'],
				'cuenta' => $data['account'],
				'fecha' => $data['date'],
				'facturas' => $data['factura'],
				'cliente' => $data['nombreEmpresa'],
				'banco' => $data['nombre'],
				'total' => "$ ".$data['amount'],
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
