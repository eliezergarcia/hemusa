<?php 
	
	include("../../conexion.php");

	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];

	$queryPedimentos = "SELECT * FROM pedimentos WHERE fecha >='".$fechaInicio."'  and fecha <='".$fechaFin."'";

	$resPedimentos = mysqli_query($conexion_usuarios, $queryPedimentos);

	if(!$resPedimentos){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resPedimentos)){
			$arreglo["data"][] = $data;
			array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}

	
	mysqli_close($conexion_usuarios);
 ?>