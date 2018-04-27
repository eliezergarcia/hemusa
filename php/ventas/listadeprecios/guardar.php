<?php 
	include("../../conexion.php");

	$opcion = $_POST["opcion"];

	switch ($opcion) {
		case 'editarproducto':
			$idproducto = $_POST['idproducto'];
			$descripcion = $_POST['descripcion'];
			$igi = $_POST['igi'];
			editar_producto($idproducto, $descripcion, $igi, $conexion_usuarios);
			break;
	
	}

	function editar_producto($idproducto, $descripcion, $igi, $conexion_usuarios){
		$query = "UPDATE productos SET descripcion='$descripcion', igi='$igi' WHERE IdProducto = '$idproducto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
	}


	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{ 
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

 ?>