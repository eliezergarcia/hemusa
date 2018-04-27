<?php
	include('../../conexion.php');

	$fechainicio = $_POST['fechainicio'];
	$fechafin = $_POST['fechafin'];	
	$fechainicio = date("Y-m-d G:i:s", strtotime($fechainicio));
	$fechafin= date("Y-m-d G:i:s", strtotime($fechafin));	

	$query = "SELECT * FROM movimientosusuarios WHERE fechahora >='".$fechainicio."' AND fechahora <= '".$fechafin."'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (!$resultado) {
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = array_map("utf8_encode", $data); 
		}
	}

	echo json_encode($arreglo);
	mysqli_free_result($resultado);
	mysqli_close($conexion_usuarios);
?>
