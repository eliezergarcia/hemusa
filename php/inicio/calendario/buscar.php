<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'tipocambio':
			tipo_cambio($conexion_usuarios);
			break;

		case 'departamento':
			buscardepartamentos($conexion_usuarios);
			break;

		case 'usuario':
			buscarusuarios($conexion_usuarios);
			break;

		case 'buscarevento':
			$id = $_POST['id'];
			buscarevento($id, $conexion_usuarios);
			break;

	}

	function tipo_cambio($conexion_usuarios){
		$fecha = date("Y-m-d");
		$query = "SELECT * FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			$informacion['respuesta'] = "BIEN";
		}else{
			$informacion['respuesta'] = "ERROR";
		}

		echo json_encode($informacion);
	}

	function buscardepartamentos($conexion_usuarios){
		$query = "SELECT DISTINCT dp FROM usuarios ORDER BY dp";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['respuesta'] = "ERROR";
		}else{
			while ($data = mysqli_fetch_array($resultado)) {
				$informacion[] = $data['dp'];
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function buscarusuarios($conexion_usuarios){
		$query = "SELECT DISTINCT nombre,apellidos FROM usuarios ORDER BY dp";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['respuesta'] = "ERROR";
		}else{
			while ($data = mysqli_fetch_array($resultado)) {
				$informacion[] = $data['nombre'].' '.$data['apellidos'] ;
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function buscarevento($id, $conexion_usuarios){
		$query = "SELECT * FROM calendario WHERE id = '$id'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['respuesta'] = "ERROR";
		}else{
			while ($data = mysqli_fetch_assoc($resultado)) {
				$informacion['data'] = $data;
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

 ?>
