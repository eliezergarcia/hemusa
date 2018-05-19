<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'tipocambio':
			$tipocambio = $_POST['tipocambio'];
			tipo_cambio($tipocambio, $conexion_usuarios);
			break;
	}

	function tipo_cambio($tipocambio, $conexion_usuarios){
		$fecha = date("Y-m-d");

		$query = "INSERT INTO tipocambio (tipocambio, fecha) VALUES ('$tipocambio' , '$fecha')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["tipo"] = "tipocambio";
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["tipo"] = "tipocambio";
			$informacion["respuesta"] = "BIEN";
		}

		echo json_encode($informacion);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion['respuesta'] = "ERROR";
		}else{
			$informacion['respuesta'] = "BIEN";
		}

		echo json_encode($informacion);
	}

?>
