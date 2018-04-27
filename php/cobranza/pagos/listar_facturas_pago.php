<?php 
	
	include("../../conexion.php");

	$idpago = $_POST['idpago'];

	$query = "SELECT * FROM cotizacion WHERE idpago = '$idpago'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (!$resultado) {
		die("Error!");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$factura = $data['factura'];
			$total = $data['precioTotal'] * 1.16;			

			$querypago = "SELECT * FROM payments WHERE id='$idpago'";
			$resultadopago = mysqli_query($conexion_usuarios, $querypago);
			while($datapago = mysqli_fetch_assoc($resultadopago)){
				$idcliente = $datapago['client'];
				$idpago = $datapago['id'];
				$cuenta = $datapago['account'];
				$fecha = $datapago['date'];
			}

			$querycliente = "SELECT nombreEmpresa FROM contactos WHERE id='$idcliente'";
			$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
			while($datacliente = mysqli_fetch_assoc($resultadocliente)){
				$cliente = $datacliente['nombreEmpresa'];
			}

			$querybanco = "SELECT nombre FROM accounts WHERE id='$cuenta'";
			$resultadobanco = mysqli_query($conexion_usuarios, $querybanco);
			while($databanco = mysqli_fetch_assoc($resultadobanco)){
				$banco = $databanco['nombre'];
			}

			$check = "<input type='checkbox' name='factura' value='".$data['id']."'>";

			$arreglo["data"][] = array(
				'check' => $check,
				'fecha' => $fecha,
				'factura' => $data['factura'],
				'cliente' => $cliente,
				'banco' => $banco,
				'total' => "$ ".$data['precioTotal'] * 1.16
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>