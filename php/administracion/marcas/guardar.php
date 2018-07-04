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
				$informacion["informacion"] = "No se pudo registrar la información porque la marca '".$marca."' ya existe!";
				echo json_encode($informacion);
			}else{
				agregar($usuariologin, $dplogin, $marca, $factor, $moneda, $tiempoEntrega, $conexion_usuarios);
			}
			break;
		case 'editar':
			$idmarca = $_POST['idmarca'];
			$marca = $_POST['marca'];
			$factor = $_POST['factor'];
			$descuento = $_POST['descuento'];
			$moneda = $_POST['moneda'];
			$tiempoEntrega = $_POST['tiempoEntrega'];
			$excepcionmarca = $_POST['excepcionmarca'];
			editar($usuariologin, $dplogin, $idmarca, $marca, $factor, $descuento, $moneda, $tiempoEntrega, $excepcionmarca,  $conexion_usuarios);
			break;

		case 'eliminar':
			$idmarca = $_POST['idmarca'];
			$marca = $_POST['marca'];
			eliminar($usuariologin, $dplogin, $idmarca, $marca, $conexion_usuarios);
			break;

		case 'subirlista':
			$json = $_POST['lista'];
			// $data = var_dump(json_decode($_POST['lista']));
			// $lista = $_POST['lista'];
			// $json = '[{"foo-bar": 12345, "foo-bar2": 78965}]';
			$data = json_decode($json);
			$indice = $_POST['indice'];
			subir_lista($data, $indice, $conexion_usuarios);
			break;

		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function subir_lista($data, $indice, $conexion_usuarios){
		$modelo = $data->{'MODELO'};
		$descripcion = $data->{'DESCRIPCION'};
		$estandar = $data->{'ESTANDAR'};
		$precioBase = $data->{'PRECIO BASE'};
		$marca = strtolower($data->{'MARCA'});
		$paginaCatalogo = $data->{'PAGINA CATALOGO'};
		$seccionCatalogo = $data->{'SECCION CATALOGO'};
		$codigoBarras = $data->{'CODIGO BARRAS'};
		$clavesat = $data->{'CLAVE SAT'};
		$unidad = $data->{'UNIDAD'};
		$clavesat = $data->{'CLAVE SAT'};
		$iva = $data->{'IVA'};
		$mesPromocion = $data->{'MES PROMOCION'};
		$descuento = $data->{'DESCUENTO'};

		if ($unidad == 'EA') {
			$unidad = "PIEZA";
		}

		if ($unidad == 'SET') {
			$unidad = "KIT";
		}

		if ($unidad == 'PR') {
			$unidad = "PAR";
		}

		$descuentos = str_replace(" %", "", $descuento);
		$query = "UPDATE productos SET descripcion='$descripcion', precioBase='$precioBase', clase='A', CantidadMinima='$estandar', Unidad='$unidad', ClaveProductoSAT='$clavesat', estandar='$estandar', paginaCatalogo='$paginaCatalogo', seccionCatalogo='$seccionCatalogo', codigoBarras='$codigoBarras', iva='$iva', mesPromocion='$mesPromocion', descuento='$descuentos' WHERE marca='$marca' AND ref='$modelo'";
		// $query = "SELECT * FROM productos WHERE marca ='$marca' AND ref = '$modelo'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(!$resultado){
			$query = "INSERT INTO productos (marca, ref, descripcion, precioBase, enReserva, clase, moneda, CantidadMinima, Unidad, ClaveProductoSAT, EnPortal, estandar, paginaCatalogo, seccionCatalogo, codigoBarras, iva, mesPromocion, descuento) VALUES ('$marca', '$modelo', '$descripcion', '$precioBase', 0, 'A', 'mxn', '$estandar', '$unidad', '$clavesat', 0, '$estandar', '$paginaCatalogo', '$seccionCatalogo', '$codigoBarras', '$iva', '$mesPromocion', '$descuento')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if(!$resultado){
				$informacion["indice"] = $indice;
				$informacion["respuesta"] = "ERROR";
				$informacion["error"] = mysqli_error($query);
			}else{
				$informacion["indice"] = $indice;
				$informacion["respuesta"] = "BIEN";
			}
		}else{
			$informacion["indice"] = $indice;
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);

		// $informacion["indice"] = $indice;
		// $informacion["modelo"] = $modelo;
		// $informacion["descripcion"] = $descripcion;
		// $informacion["estandar"] = $estandar;
		// $informacion["precioBase"] = $precioBase;
		// $informacion["marca"] = $marca;
		// $informacion["paginaCatalogo"] = $paginaCatalogo;
		// $informacion["seccionCatalogo"] = $seccionCatalogo;
		// $informacion["codigoBarras"] = $codigoBarras;
		// $informacion["unidad"] = $unidad;
		// $informacion["iva"] = $iva;
		// $informacion["mesPromocion"] = $mesPromocion;
		// $informacion["descuento"] = $descuento;
		// $informacion["clavesat"] = $clavesat;
		// $informacion["respuesta"] = "BIEN";
		// echo json_encode($informacion);
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
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la información de la marca '".$marca."'!";
		}else{
			$descripcion = "Se registro la marca ".$marca;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información de la marca '".$marca."' se guardo correctamente!";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function editar($usuariologin, $dplogin, $idmarca, $marca, $factor, $descuento, $moneda, $tiempoEntrega, $excepcionmarca, $conexion_usuarios){
		$query ="UPDATE marcadeherramientas SET factor='$factor', descuento='$descuento', moneda='$moneda', TiempoEntrega='$tiempoEntrega', excepcion='$excepcionmarca' WHERE id=$idmarca";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un error al modificar la información de la marca '".$marca."'!";
		}else{
			$descripcion = "Se editaron los datos de la marca ".$marca;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Modificacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se modificó la información de la marca '".$marca."' correctamente!";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function eliminar($usuariologin, $dplogin, $idmarca, $marca, $conexion_usuarios){
		$query = "DELETE FROM marcadeherramientas WHERE id =$idmarca";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un error al eliminar la marca '".$marca."'!";
		}else{
			$descripcion = "Se elimino la marca ".$marca;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Eliminacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La marca '".$marca."' se eliminó correctamente!";
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
