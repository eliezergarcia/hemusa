<?php
	include("../../conexion.php");
	include("../../sesion.php");

	$opcion = $_POST["opcion"];

	switch ($opcion) {
		case 'editarproducto':
			$idproducto = $_POST['idproducto'];
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$costo = $_POST['costo'];
			$igi = $_POST['igi'];
			$descripcion = $_POST['descripcion'];
			$stock = $_POST['stock'];
			$clase = $_POST['clase'];
			$moneda = $_POST['moneda'];
			$unidad = $_POST['unidad'];
			$claveSat = $_POST['claveSat'];
			$estandar = $_POST['estandar'];
			$paginaCatalogo = $_POST['paginaCatalogo'];
			$seccionCatalogo = $_POST['seccionCatalogo'];
			$codigoBarras = $_POST['codigoBarras'];
			$mesPromocion = $_POST['mesPromocion'];
			editar_producto($idproducto, $marca, $modelo, $costo, $igi, $descripcion, $stock, $clase, $moneda, $unidad, $claveSat, $estandar, $paginaCatalogo, $seccionCatalogo, $codigoBarras, $mesPromocion, $conexion_usuarios, $idusuario);
			break;

		case 'agregarherramienta':
			$idproducto = $_POST['idproducto'];
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$costo = $_POST['costo'];
			$igi = $_POST['igi'];
			$descripcion = $_POST['descripcion'];
			$stock = $_POST['stock'];
			$clase = $_POST['clase'];
			$moneda = $_POST['moneda'];
			$unidad = $_POST['unidad'];
			$claveSat = $_POST['claveSat'];
			$estandar = $_POST['estandar'];
			$paginaCatalogo = $_POST['paginaCatalogo'];
			$seccionCatalogo = $_POST['seccionCatalogo'];
			$codigoBarras = $_POST['codigoBarras'];
			$mesPromocion = $_POST['mesPromocion'];
			$existe = existe_marca($marca, $modelo, $conexion_usuarios);
			if($existe > 0 ){
				$informacion["respuesta"] = "EXISTE";
				$informacion["informacion"] = "No se puede registrar la información porque el la herramienta del modelo '".$modelo."' marca '".$marca."' ya existe!";
				echo json_encode($informacion);
			}else{
				agregar_herramienta($marca, $modelo, $costo, $igi, $descripcion, $stock, $clase, $moneda, $unidad, $claveSat, $estandar, $paginaCatalogo, $seccionCatalogo, $codigoBarras, $mesPromocion, $conexion_usuarios);
			}
			break;
	}

	function existe_marca($marca, $modelo, $conexion_usuarios){
		$query = "SELECT IdProducto FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_marca = mysqli_num_rows( $resultado );
		return $existe_marca;
	}

	function agregar_herramienta($marca, $modelo, $costo, $igi, $descripcion, $stock, $clase, $moneda, $unidad, $claveSat, $estandar, $paginaCatalogo, $seccionCatalogo, $codigoBarras, $mesPromocion, $conexion_usuarios){
		$query = "INSERT INTO productos (marca, ref, descripcion, precioBase, enReserva, clase, moneda, Unidad, ClaveProductoSAT, igi, estandar, paginaCatalogo, seccionCatalogo, codigoBarras, mesPromocion) VALUES ('$marca', '$modelo', '$descripcion', '$costo', '$stock', '$clase', '$moneda', '$unidad', '$claveSat', '$igi', '$estandar', '$paginaCatalogo', '$seccionCatalogo', '$codigoBarras', '$mesPromocion')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al agregar la herramienta del modelo '".$modelo."' marca '".$marca."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se agregó la herramienta del modelo '".$modelo."' marca '".$marca."' correctamente!";

			$descripcionmovimiento = "Se agrego el modelo ".$modelo." de la marca ".$marca." a la lista de precios";
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'listaprecios', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function editar_producto($idproducto, $marca, $modelo, $costo, $igi, $descripcion, $stock, $clase, $moneda, $unidad, $claveSat, $estandar, $paginaCatalogo, $seccionCatalogo, $codigoBarras, $mesPromocion, $conexion_usuarios, $idusuario){
		$query = "UPDATE productos SET marca='$marca', ref='$modelo', descripcion='$descripcion', precioBase='$costo', enReserva='$stock', clase='$clase', moneda='$moneda', Unidad='$unidad', ClaveProductoSat='$claveSat', igi='$igi', estandar='$estandar', paginaCatalogo='$paginaCatalogo', seccionCatalogo='$seccionCatalogo', codigoBarras='$codigoBarras', mesPromocion='$mesPromocion' WHERE IdProducto='$idproducto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información del modelo '".$modelo."' marca '".$marca."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se modificó la información del modelo '".$modelo."' marca '".$marca."' correctamente!";

			$descripcionmovimiento = "Se modifico la informacion del modelo ".$modelo." y marca ".$marca." en la lista de precios";
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'listaprecios', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
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
