<?php 
	include ('../../conexion.php');
	include ('../../sesion.php');
	
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'agregar':
			$marca = $_POST['marca'];
			$factor = $_POST['factor'];
			$moneda = $_POST['moneda'];
			$tiempoEntrega = $_POST['tiempoEntrega'];
			$existe = existe_marca($marca, $conexion_usuarios);
			if($existe > 0){
				$informacion["respuesta"] = "EXISTE";
				echo json_encode($informacion);
			}else{
				agregar($usuariologin, $dplogin, $marca, $factor, $moneda, $tiempoEntrega, $conexion_usuarios);
			}
			break;
		case 'editar':
			$idmarca = $_POST['idmarca'];
			$marca = $_POST['marca'];
			$factor = $_POST['factor'];
			$moneda = $_POST['moneda'];
			$tiempoEntrega = $_POST['tiempoEntrega'];
			$excepcionmarca = $_POST['excepcionmarca'];
			editar($usuariologin, $dplogin, $idmarca, $marca, $factor, $moneda, $tiempoEntrega, $excepcionmarca,  $conexion_usuarios);
			break;
		
		case 'eliminar':
			$idmarca = $_POST['idmarca'];
			$marca = $_POST['marca'];
			eliminar($usuariologin, $dplogin, $idmarca, $marca, $conexion_usuarios);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function existe_marca($marca, $conexion_usuarios){
		$query = "SELECT id FROM marcadeherramientas WHERE marca = '$marca';";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_marca = mysqli_num_rows( $resultado );
		return $existe_marca;
	}

	function agregar($usuariologin, $dplogin, $marca, $factor, $moneda, $tiempoEntrega, $conexion_usuarios){
		$query = "INSERT INTO marcadeherramientas (marca,factor,moneda,TiempoEntrega) VALUES('$marca', '$factor', '$moneda', '$tiempoEntrega');";
		$resultado = mysqli_query($conexion_usuarios, $query);		
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{		
			$descripcion = "Se registro la marca ".$marca;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}
		cerrar($conexion_usuarios);
	}

	function editar($usuariologin, $dplogin, $idmarca, $marca, $factor, $moneda, $tiempoEntrega, $excepcionmarca, $conexion_usuarios){
		$query ="UPDATE marcadeherramientas SET factor='$factor', moneda='$moneda', TiempoEntrega='$tiempoEntrega', excepcion='$excepcionmarca' WHERE id=$idmarca";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{		
			// $descripcion = "Se editaron los datos de la marca ".$marca;
			// $fechahora = date("Y-m-d G:i:s");
			// $query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Modificacion', '$descripcion', '$fechahora')";
			// $resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}
		cerrar($conexion_usuarios);
	}

	function eliminar($usuariologin, $dplogin, $idmarca, $marca, $conexion_usuarios){
		$query = "DELETE FROM marcadeherramientas WHERE id =$idmarca";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{		
			$descripcion = "Se elimino la marca ".$marca;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Eliminacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}
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
