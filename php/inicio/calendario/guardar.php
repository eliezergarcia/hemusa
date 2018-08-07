<?php
	include("../../conexion.php");
	include("../../sesion.php");
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'tipocambio':
			$tipocambio = $_POST['tipocambio'];
			tipo_cambio($tipocambio, $conexion_usuarios, $idusuario);
			break;

		case 'crearevento':
			$titulo = $_POST['titulo'];
			$fechaInicio = date("Y-m-d", strtotime($_POST['fechaInicio']));
			$fechaFin = date("Y-m-d", strtotime($_POST['fechaFin']));
			if(isset($_POST["horaInicio"])){
				$horaInicio = $_POST['horaInicio'];
			}else{
				$horaInicio = '00-00-00';
			}
			if(isset($_POST["horaFin"])){
				$horaFin = $_POST['horaFin'];
			}else{
				$horaFin = '00-00-00';
			}
			$repetir = $_POST['repetir'];
			$recordatorio = $_POST['recordatorio'];
			$notas = $_POST['notas'];
			crear_evento($idusuario, $titulo, $fechaInicio, $fechaFin, $horaInicio, $horaFin, $repetir, $recordatorio, $notas, $conexion_usuarios);
			break;

		case 'editarevento':
			$idEvento	= $_POST['idEvento'];
			$titulo = $_POST['titulo'];
			$fechaInicio = date("Y-m-d", strtotime($_POST['fechaInicio']));
			$fechaFin = date("Y-m-d", strtotime($_POST['fechaFin']));
			if(isset($_POST["horaInicio"])){
				$horaInicio = $_POST['horaInicio'];
			}else{
				$horaInicio = '00-00-00';
			}
			if(isset($_POST["horaFin"])){
				$horaFin = $_POST['horaFin'];
			}else{
				$horaFin = '00-00-00';
			}
			$repetir = $_POST['repetir'];
			$recordatorio = $_POST['recordatorio'];
			$notas = $_POST['notas'];
			editar_evento($idusuario, $idEvento, $titulo, $fechaInicio, $fechaFin, $horaInicio, $horaFin, $repetir, $recordatorio, $notas, $conexion_usuarios);
			break;
	}

	function tipo_cambio($tipocambio, $conexion_usuarios, $idusuario){
		$fecha = date("Y-m-d");

		$query = "INSERT INTO tipocambio (tipocambio, fecha) VALUES ('$tipocambio' , '$fecha')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el tipo de cambio del día.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El tipo de cambio del día se guardó correctamente.";

			$descripcionmovimiento = "Se agrego el tipo de cambio del dia a: ".$tipocambio;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'tipocambio', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
	}

	function crear_evento($idusuario, $titulo, $fechaInicio, $fechaFin, $horaInicio, $horaFin, $repetir, $recordatorio, $notas, $conexion_usuarios){
		$query = "INSERT INTO calendario (titulo, usuario, fechaInicio, fechaFin, horaInicio, horaFin, repetir, recordatorio, notas) VALUES ('$titulo', '$idusuario', '$fechaInicio', '$fechaFin', '$horaInicio', '$horaFin', '$repetir', '$recordatorio', '$notas')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el evento.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El evento se guardó correctamente en el calendario.";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_evento($idusuario, $idEvento, $titulo, $fechaInicio, $fechaFin, $horaInicio, $horaFin, $repetir, $recordatorio, $notas, $conexion_usuarios){
		$query = "UPDATE calendario SET titulo='$titulo', fechaInicio='$fechaInicio', fechaFin='$fechaFin', horaInicio='$horaInicio', horaFin='$horaFin', repetir='$repetir', recordatorio='$recordatorio', notas='$notas' WHERE id='$idEvento'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el evento.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El evento se modificó correctamente en el calendario.";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
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
