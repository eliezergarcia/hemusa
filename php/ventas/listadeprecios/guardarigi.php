<?php 
	include('../../conexion.php');
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}

	$idproducto = $_POST["idproducto"];
	$igi = $_POST["igi"];

	$queryIgi = "UPDATE productos SET igi = '".$igi."' WHERE idproducto = '".$idproducto."'";
	$resIgi = mysqli_query($conexion_usuarios, $queryIgi);

	// function verificar_resultado($resultado){
	// 	if(!$resultado){
	// 		$informacion["respuesta"] = "ERROR";
	// 	}else{ 
	// 		$informacion["respuesta"] = "BIEN";
	// 	}
	// 	echo json_encode($informacion);
	// }
	
	mysqli_close($conexion_usuarios);

 ?>