<?php
	include ('../../conexion.php');
	
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'datosusuario':
			$idusuario = $_POST['idusuario'];
			datosusuario($idusuario, $conexion_usuarios);
			break;

		case 'departamentos':
			departamentos($conexion_usuarios);
			break;
	}

	function datosusuario($idusuario, $conexion_usuarios){
		$query = "SELECT * FROM usuarios WHERE id = '$idusuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["datosusuario"] = $data;
 			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function departamentos($conexion_usuarios){
		$query = "SELECT DISTINCT dp FROM usuarios";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar departamentos en el sistema!");
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$arreglo['departamentos'][] = $data['dp'];
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}

?>