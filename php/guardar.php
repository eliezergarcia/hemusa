<?php 	
	include("conexion.php");

	$usuario = $_POST['usuario'];
	$titulo = $_POST['titulo'];
	$fechainicio = $_POST['fechainicio'];
	$fechafin = $_POST['fechafin'];
	$descripcion = $_POST['descripcion'];
	if (isset($_POST['agregarnotificacion'])) {
		$notificacion = "si";
		$diasnotificacion = $_POST['diasnotificacion'];
		$horanotificacion = $_POST['horanotificacion'];
		$pendiente = "si";
	}else{
		$notificacion = "no";
		$diasnotificacion = 0;
		$horanotificacion = "00:00:00";		
		$pendiente = "si";
	}

	if ($_POST['tipo'] == 'ninguno') {
		$asignado = $_POST['usuario'];
		$pendiente = "no";
	}else{
		$asignado = $_POST['asignado'];
	}


	$query = "INSERT INTO calendario (titulo, fechainicio, fechafin, descripcion, notificacion, diasnotificacion, horanotificacion, usuario, asignado, pendiente) VALUES ('$titulo', '$fechainicio', '$fechafin', '$descripcion', '$notificacion', '$diasnotificacion', '$horanotificacion', '$usuario', '$asignado', '$pendiente')";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (!$resultado) {
		$informacion["respuesta"] = "ERROR";
	}else{
		$informacion["respuesta"] = "BIEN";
	}

	echo json_encode($informacion);
	mysqli_close($conexion_usuarios);
 ?>