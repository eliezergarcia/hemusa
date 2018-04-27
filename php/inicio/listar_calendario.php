<?php 	
	include("../conexion.php");

	$usuario = $_POST['usuario'];
	$departamento = $_POST['departamento'];

	$query = "SELECT * FROM calendario WHERE usuario = '$usuario' OR asignado = '$usuario' OR asignado = '$departamento'";
	$resultado = mysqli_query($conexion_usuarios, $query);	
	$arreglo = array();

	if(!$resultado){
		die('Error');
	}else{		
		while($data = mysqli_fetch_array($resultado)){
			if ($data['diasnotificacion'] == 0) {
				$color = "#FF4136";
			}
			if ($data['diasnotificacion'] == 1) {
				$color = "#FFDC00";
			}
			if ($data['diasnotificacion'] == 2) {
				$color = "#2ECC40";
			}
			$arreglo[] = array(
						'id' => $data['id'], 
						'title' => $data['titulo'], 
						'start' => $data['fechainicio'], 
						'end' => $data['fechafin'], 
						'color' => $color,
						'textColor' => '#FFF'
					);
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resultado);
	mysqli_close($conexion_usuarios);
 ?>
