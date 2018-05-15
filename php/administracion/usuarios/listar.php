<?php
	include("../../conexion.php");

	$query = "SELECT * FROM usuarios ORDER BY user";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error al buscar usuarios!');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'][] = $data;
		}
	}

	echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	mysqli_close($conexion_usuarios);
?>
