<?php
	include("../../conexion.php");
	include("../../sesion.php");

	$query = "SELECT * FROM calendario WHERE usuario = '$idusuario' OR asignado = '$idusuario' OR asignado = '$departamento_usuario'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		$arreglo[] = "";
	}else{
		while($data = mysqli_fetch_array($resultado)){
			// if ($data['diasnotificacion'] == 0) {
			// 	$color = "#FF4136";
			// }
			// if ($data['diasnotificacion'] == 1) {
			// 	$color = "#FFDC00";
			// }
			// if ($data['diasnotificacion'] == 2) {
			// 	$color = "#2ECC40";
			// }
			if ($data['horaInicio'] != '00:00:00' && $data['horaFin'] != '00:00:00') {
				$fechaInicio = $data['fechaInicio']."T".$data['horaInicio'];
				$fechaFin = $data['fechaFin']."T".$data['horaFin'];
			}else{
				$fechaInicio = $data['fechaInicio']."T08:00:00";
				$fechaFin = $data['fechaFin']."T19:00:00";
			}

			$arreglo[] = array(
						'id' => $data['id'],
						'title' => $data['titulo'],
						'start' => $fechaInicio,
						'end' => $fechaFin,
						'color' => "",
						'textColor' => '#FFF'
					);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
