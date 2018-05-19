<?php 	
	include("../conexion.php");

	$usuario = $_POST['usuario'];
	$departamento = $_POST['departamento'];
	$hora = $_POST['hora'];

	$query = "SELECT * FROM calendario WHERE horanotificacion = '$hora' AND asignado = '$usuario' OR asignado = '$departamento'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (mysqli_num_rows($resultado) > 0) {
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['data'] = $data;
		}
		$informacion['respuesta'] = "BIEN";
	}else{
		$informacion['respuesta'] = "ERROR";
	}

	echo json_encode($informacion);
	mysqli_close($conexion_usuarios);
 ?>