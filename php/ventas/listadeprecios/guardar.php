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
		$query = "SELECT * FROM productos WHERE IdProducto = '$idproducto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$marca = $data['marca'];
			$modelo = $data['ref'];
		}


		$query = "UPDATE productos SET descripcion='$descripcion', igi='$igi' WHERE IdProducto = '$idproducto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información del modelo '".$modelo."' marca '".$marca."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se modificó la información del modelo '".$modelo."' marca '".$marca."' correctamente!";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
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