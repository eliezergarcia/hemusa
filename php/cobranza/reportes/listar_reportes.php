<?php 
	
	include("../../conexion.php");
	$queryUsuarios = "SELECT * FROM usuarios ORDER BY user";
	$resUsuarios = mysqli_query($conexion_usuarios, $queryUsuarios);

	if(!$resUsuarios){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resUsuarios)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resUsuarios);
	mysqli_close($conexion_usuarios);
 ?>