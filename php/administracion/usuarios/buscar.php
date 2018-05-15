<?php
	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'departamentos':
			departamentos($conexion_usuarios);
			break;
	}

	function departamentos($conexion_usuarios){
		$query = "SELECT DISTINCT dp FROM usuarios";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar departamentos!");
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$arreglo['departamentos'][] = $data['dp'];
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}
?>
