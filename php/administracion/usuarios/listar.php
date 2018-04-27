<?php 
	
	include("../../conexion.php");

	$query = "SELECT * FROM usuarios ORDER BY user";
	$resultado = mysqli_query($conexion_usuarios, $query);
	
	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'][] = array_map("utf8_encode", $data);
		}
	}

	echo json_encode($arreglo);
	mysqli_free_result($resultado);
	mysqli_close($conexion_usuarios);
?>