<?php 
	
	include("../../conexion.php");

	$queryGarantias = "SELECT * FROM warranties WHERE entregadoProveedor='0000-00-00' and entregado='0000-00-00' ORDER BY modelo";

	$resGarantias = mysqli_query($conexion_usuarios, $queryGarantias);

	if(!$resGarantias){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resGarantias)){
			$arreglo["data"][] = $data; 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resGarantias);
	mysqli_close($conexion_usuarios);
 ?>