<?php 	
	include("../conexion.php");

	$usuario = $_POST['usuario'];
	$departamento = $_POST['departamento'];

	$query = "SELECT * FROM calendario WHERE asignado = '$usuario' OR asignado = '$departamento' AND pendiente = 'si'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (mysqli_num_rows($resultado) > 0) {
		$n = 0;
		while($data = mysqli_fetch_array($resultado)){
			$n++;
		}
		$pendientes['respuesta'] = $n;
	}else{
		$pendientes['respuesta'] = 0;
	}

	echo json_encode($pendientes);
	mysqli_close($conexion_usuarios);
 ?>