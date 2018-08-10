<?php

	include("../../conexion.php");
	include("../../sesion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'cambiarMoneda':
		 	$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			cambiar_moneda($refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'numeroguia':
			$numeroguia = $_POST['numeroguia'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			numeroguia($numeroguia, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'paqueteria':
			$paqueteria = $_POST['paqueteria'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			paqueteria($paqueteria, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'formapago':
			$formapago = $_POST['formapago'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			formapago($formapago, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'metodopago':
			$metodopago = $_POST['metodopago'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			metodopago($metodopago, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'usocfdi':
			$cfdi = $_POST['cfdi'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			usocfdi($cfdi, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario);
			break;

		case 'proveedor':
			$proveedor = $_POST['proveedor'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			$data = json_decode($_POST['herramienta']);
			proveedor($proveedor, $refCotizacion, $numeroPedido, $data, $conexion_usuarios, $idusuario);
			break;

		case 'cantidad':
			$cantidad = $_POST['cantidad'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			$data = json_decode($_POST['herramienta']);
			cantidad($cantidad, $refCotizacion, $numeroPedido, $data, $conexion_usuarios, $idusuario);
			break;

		case 'editarpartida':
			$id = $_POST['id'];
			$descripcion = $_POST['descripcion'];
			$claveSat = $_POST['claveSat'];
			$unidad = $_POST['unidad'];
			$noserie = $_POST['noserie'];
			// $cantidad = $_POST['cantidad'];
			$fechacompromiso = $_POST['fechacompromiso'];
			$proveedor = $_POST['proveedor'];
			if (isset($_POST['split'])) {
				$split = $_POST['split'];
			}else{
				$split = 0;
			}
			$entregado = $_POST['entregado'];
			$pedimento = $_POST['pedimento'];
			editarpartida($id, $descripcion, $claveSat, $unidad, $noserie, $fechacompromiso, $proveedor, $split, $pedimento, $entregado, $conexion_usuarios, $idusuario);
			break;

		case 'guardarfactura':
			$folio = $_POST['folio'];
			$refCotizacion = $_POST['refCotizacion'];
			$ordenpedido = $_POST['ordenpedido'];
			$subtotal = $_POST['subtotal'];
			$total = $_POST['total'];
			$status = $_POST['status'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			$tipoDocumento = $_POST['tipoDocumento'];
			$moneda = $_POST['moneda'];
			$uidfactura = $_POST['UIDFactura'];
			$uuidfactura = $_POST['UUIDFactura'];
			guardar_factura($folio, $refCotizacion, $ordenpedido, $subtotal, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios, $idusuario);
			break;

		case 'quitarstock':
			$numeroPedido = $_POST['numeroPedido'];
			$refCotizacion = $_POST['refCotizacion'];
			$partidas = json_decode($_POST['herramienta']);
			$folio = $_POST['folio'];
			$tipoDocumento = $_POST['tipoDocumento'];
			quitar_stock($numeroPedido, $refCotizacion, $partidas, $folio, $tipoDocumento, $conexion_usuarios);
			break;

		case 'packinglist':
			$data = json_decode($_POST['herramienta']);
			packinglist($data, $conexion_usuarios, $idusuario);
			break;

		case 'entregado':
			$data = json_decode($_POST['herramienta']);
			entregado($data, $conexion_usuarios, $idusuario);
			break;
	}

	function quitar_stock($numeroPedido, $refCotizacion, $partidas, $folio, $tipoDocumento, $conexion_usuarios){
		foreach ($partidas as &$id) {
			$query = "SELECT * FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$fecha = date("Y-m-d");
			while($data = mysqli_fetch_assoc($resultado)){
				$id = $data['id'];
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$cantidadquitar = $data['cantidad'];
				$entregado = $data['Entregado'];
				$folio = str_replace("H ","",$folio);

				if ($tipoDocumento == "factura/pagoanticipado") {
					if ($entregado == "0000-00-00") {
						$query2 = "UPDATE cotizacionherramientas SET factura='$folio' WHERE id = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);

						$query2 = "UPDATE utilidad_pedido SET factura_hemusa='$folio' WHERE id_cotizacion_herramientas = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
					}
				}else{
					if ($entregado == "0000-00-00") {
						$query2 = "UPDATE cotizacionherramientas SET Entregado='$fecha', factura='$folio' WHERE id = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);

						$query2 = "UPDATE utilidad_pedido SET fecha_entregado='$fecha', factura_hemusa='$folio' WHERE id_cotizacion_herramientas = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);

						$query3 = "SELECT enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
						$resultado3 = mysqli_query($conexion_usuarios, $query3);
						while($data2 = mysqli_fetch_assoc($resultado3)){
							$cantidad = $data2['enReserva'];
						}

						$cantidadstock = $cantidad - $cantidadquitar;

						$query4 = "UPDATE productos SET enReserva = '$cantidadstock' WHERE marca = '$marca' AND ref = '$modelo'";
						$resultado4 = mysqli_query($conexion_usuarios, $query4);
					}
				}
			}
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado y el stock de la herramienta!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado se cambio a 'Entregado' y se quitó del stock correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_moneda($refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		$fecha = date("Y-m-d");
		$query = "SELECT tipocambio FROM tipocambio WHERE fecha='$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar el tipo de cambio del día!";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$tipocambio = $data['tipocambio'];
			}

			$query = "SELECT moneda FROM pedidos WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (mysqli_num_rows($resultado) > 0) {
				while($data = mysqli_fetch_assoc($resultado)){
					$monedapedido = $data['moneda'];
				}

				$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al buscar información de las partidas!";
				}else{
					if ($monedapedido == "mxn") {
						// Se hace el cambio a moneda USD
						while($data = mysqli_fetch_assoc($resultado)){
							$id = $data['id'];
							$precioLista = $data['precioLista'];
							$flete = $data['flete'];
							$precioLista = $precioLista / $tipocambio;
							$flete = $flete / $tipocambio;
							$total = $total + ($precioLista * $data['cantidad']);
							$queryCambio = "UPDATE cotizacionherramientas SET precioLista = '$precioLista', moneda = 'usd', flete = '$flete' WHERE id='$id'";
							$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							if (!$resultadoCambio) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información!";
								break;
							}
						}
						$query = "UPDATE pedidos SET total = '$total', moneda = 'usd' WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

							$descripcionmovimiento = "Se cambio la moneda del pedido ".$numeroPedido." de MXN a USD";
							$fechamovimiento = date("Y-m-d H:i:s");
							$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
							$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

							$query = "SELECT * FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);

							while($data = mysqli_fetch_assoc($resultado)){
								$id = $data['id'];
								$costoFlete = $data['costoFlete'];
								$costoFlete = $costoFlete / $tipocambio;
								$queryCambio = "UPDATE fletescotizacion SET costoFlete = '$costoFlete' WHERE id = '$id'";
								$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							}
						}
					}else{
						// Se hace el cambio a moneda MXN
						while($data = mysqli_fetch_assoc($resultado)){
							$id = $data['id'];
							$precioLista = $data['precioLista'];
							$flete = $data['flete'];
							$precioLista = $precioLista * $tipocambio;
							$flete = $flete * $tipocambio;
							$total = $total + ($precioLista * $data['cantidad']);
							$queryCambio = "UPDATE cotizacionherramientas SET precioLista = '$precioLista', moneda = 'mxn', flete = '$flete' WHERE id='$id'";
							$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							if (!$resultadoCambio) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información!";
								break;
							}
						}
						$query = "UPDATE pedidos SET total = '$total', moneda = 'mxn' WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

							$descripcionmovimiento = "Se cambio la moneda del pedido ".$numeroPedido." de USD a MXN";
							$fechamovimiento = date("Y-m-d H:i:s");
							$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
							$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

							$query = "SELECT * FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);

							while($data = mysqli_fetch_assoc($resultado)){
								$id = $data['id'];
								$costoFlete = $data['costoFlete'];
								$costoFlete = $costoFlete * $tipocambio;
								$queryCambio = "UPDATE fletescotizacion SET costoFlete = '$costoFlete' WHERE id = '$id'";
								$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							}
						}
					}
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function packinglist($data, $conexion_usuarios, $idusuario){
		$modelos = "";
		foreach ($data as &$id) {
			$query = "UPDATE cotizacionherramientas SET embarque='pendiente' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "SELECT * FROM cotizacionherramientas WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$data2 = mysqli_fetch_assoc($resultado);
			$modelos = $data2['modelo'].", ".$modelos;
			$numeroPedido = $data2['numeroPedido'];
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al agregar las partidas al packing list!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Las partidas se agregaron al packinglist correctamente!";

			$descripcionmovimiento = "Se agregaron a lista de embarque los modelos ".$modelos."del pedido ".$numeroPedido;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos/packinglist', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function entregado($herramienta, $conexion_usuarios, $idusuario){
		$fecha = date("Y-m-d");
		$modelos = "";
		foreach ($herramienta as &$id) {
			$query = "UPDATE utilidad_pedido SET fecha_entregado='$fecha' WHERE id_cotizacion_herramientas=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$query = "UPDATE cotizacionherramientas SET Entregado='$fecha' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "SELECT * FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$cantidad = $data['cantidad'];
				$modelos = $data['modelo'].", ".$modelos;
				$numeroPedido = $data['numeroPedido'];
			}

			$query = "UPDATE productos SET enReserva = enReserva-$cantidad WHERE marca='$marca' AND ref='$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar el estado a 'Entregado' de las partidas!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de las partidas se modificó a 'Entregado' correctamente!";

			$descripcionmovimiento = "Se cambio el estado a Entregado des los modelos ".$modelos."del pedido ".$numeroPedido;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function numeroguia($numeroguia, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		$query = "UPDATE pedidos SET numeroGuia='$numeroguia' WHERE cotizacionRef ='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$query = "UPDATE cotizacion SET guia='$numeroguia' WHERE ref ='$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el número de guía '".$numeroguia."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El número de guía '".$numeroguia."' se guardó correctamente!";

			$descripcionmovimiento = "Se cambio el numero de guia del pedido ".$numeroPedido." a ".$numeroguia;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function paqueteria($paqueteria, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		if($paqueteria == "NINGUNA"){
			$paqueteria = "";
		}

		$query = "SELECT nombre FROM paqueterias WHERE IdPaqueteria = '$paqueteria'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$nombrepaqueteria = $data['nombre'];

		$query = "UPDATE pedidos SET paqueteria='$paqueteria' WHERE cotizacionRef ='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (mysqli_num_rows($resultado) < 1) {
			$query = "UPDATE cotizacion SET IdPaqueteria='$paqueteria' WHERE ref ='$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la paqueteria!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La paqueteria se guardó correctamente!";

			$descripcionmovimiento = "Se cambio la paqueteria del pedido ".$numeroPedido." a ".$nombrepaqueteria;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function formapago($formapago, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		$query = "SELECT Descripcion FROM formasdepago WHERE IdFormaPago = '$formapago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$nombreformapago = $data['Descripcion'];

		$query = "UPDATE pedidos SET IdFormaPago='$formapago' WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
			$query = "UPDATE contactos SET IdFormaPago='$formapago' WHERE id='$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar la forma de pago.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La forma de pago se actualizó correctamente.";

			$descripcionmovimiento = "Se cambio la forma de pago del pedido ".$numeroPedido." a ".$nombreformapago;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function metodopago($metodopago, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		$query = "SELECT Descripcion FROM metodosdepago WHERE IdMetodoPago = '$metodopago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$nombremetodopago = $data['Descripcion'];

		$query = "UPDATE pedidos SET IdMetodoPago='$metodopago' WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
			$query = "UPDATE contactos SET IdMetodoPago='$metodopago' WHERE id='$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar el método de pago.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "el método de pago se actualizó correctamente.";

			$descripcionmovimiento = "Se cambio el metodo de pago del pedido ".$numeroPedido." a ".$nombremetodopago;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function usocfdi($cfdi, $refCotizacion, $numeroPedido, $conexion_usuarios, $idusuario){
		$query = "SELECT Descripcion FROM usocfdi WHERE IdUsoCFDI = '$cfdi'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$nombreusocfdi = $data['Descripcion'];

		$query = "UPDATE pedidos SET IdUsoCFDI='$cfdi' WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
			$query = "UPDATE contactos SET IdUsoCFDI='$cfdi' WHERE id='$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar el Uso de CFDI.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El Uso de CFDI se actualizó correctamente";

			$descripcionmovimiento = "Se cambio el uso de CFDI del pedido ".$numeroPedido." a ".$nombreusocfdi;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function proveedor($proveedor, $refCotizacion, $numeroPedido, $data, $conexion_usuarios, $idusuario){
		foreach ($data as &$valor) {
			$id = $valor;

			if ($proveedor == "ALMACEN") {
				$fecha = date("Y-m-d");
				$query = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}elseif ($proveedor == "None") {
				$query = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='0000-00-00', enviadoFecha='0000-00-00', recibidoFecha='0000-00-00' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}else{
				$fecha = date("Y-m-d");
				$query = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='0000-00-00', recibidoFecha='0000-00-00' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}
		}
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el proveedor ".$proveedor."!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El proveedor ".$proveedor." se guardó correctamente!";

			$descripcionmovimiento = "Se cambio el proveedor en general a las partidas del pedido ".$numeroPedido." a ".$proveedor;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cantidad($cantidad, $refCotizacion, $numeroPedido, $partidas, $conexion_usuarios, $idusuario){
		foreach ($partidas as &$id) {
			$query = "UPDATE cotizacionherramientas SET cantidad='$cantidad' WHERE id='$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al cambiar la cantidad de la(s) partida(s).";
		}else{
			$descripcionmovimiento = "Se cambio la cantidad en general a las partidas del pedido ".$numeroPedido." a ".$cantidad;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				$precioLista = $data['precioLista'];
				$flete = $data['flete'];
				$total = $total + ($precioLista * $data['cantidad']);
			}

			$query = "UPDATE pedidos SET total='$total' WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al modificar la información del pedido!";
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "La cantidad de la(s) partida(s) se modificó correctamente!";
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editarpartida($id, $descripcion, $claveSat, $unidad, $noserie, $fechacompromiso, $proveedor, $split, $pedimento, $entregado, $conexion_usuarios, $idusuario){
		$query = "SELECT * FROM cotizacionherramientas WHERE id = '$id'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$marca = $data['marca'];
		$modelo = $data['modelo'];
		$refCotizacion = $data['cotizacionRef'];
		$numeroPedido = $data['numeroPedido'];

		$query = "UPDATE utilidad_pedido SET descripcion = '$descripcion', Pedimento = '$pedimento', fecha_entregado = '$entregado' WHERE id_cotizacion_herramientas =$id";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if ($proveedor == "ALMACEN") {
			$fecha = date("Y-m-d");
			$query = "UPDATE cotizacionherramientas SET descripcion='$descripcion', ClaveProductoSAT='$claveSat', Unidad='$unidad', NoSerie='$noserie', fechaCompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha', Pedimento = '$pedimento', Entregado='$entregado' WHERE id =$id";
		}else{
			$fecha = date("Y-m-d");
			$query = "UPDATE cotizacionherramientas SET descripcion='$descripcion', ClaveProductoSAT='$claveSat', Unidad='$unidad', NoSerie='$noserie', fechaCompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', Pedimento = '$pedimento', enviadoFecha='0000-00-00', recibidoFecha='0000-00-00', Entregado='$entregado' WHERE id =$id";
		}

		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar los datos de la partida!";
		}else{
			if ($split > 0) {
				$query = "SELECT * FROM cotizacionherramientas WHERE id=$id";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al buscar los datos de la partida!";
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$cliente = $data['cliente'];
						$cotizacionNo = $data['cotizacionNo'];
						$cotizacionRef = $data['cotizacionRef'];
						$marca = $data['marca'];
						$modelo = $data['modelo'];
						$descripcion = $data['descripcion'];
						$precioLista = $data['precioLista'];
						$flete = $data['flete'];
						$cantidad = $data['cantidad'];
						$Unidad = $data['Unidad'];
						$ClaveProductoSAT = $data['ClaveProductoSAT'];
						$proveedorFlete = $data['proveedorFlete'];
						$NoSerie = $data['NoSerie'];
						$fechaCompromiso = $data['fechaCompromiso'];
						$Pedido = $data['Pedido'];
						$pedidoFecha = $data['pedidoFecha'];
						$fechaPedido = $data['fechaPedido'];
						$Proveedor = $data['Proveedor'];
						$proveedorFecha = $data['proveedorFecha'];
						$ordenCompra = $data['ordenCompra'];
						$numeroPedido = $data['numeroPedido'];
						$moneda = $data['moneda'];
						$referencia_interna = $data['referencia_interna'];
						$lugar_cotizacion = $data['lugar_cotizacion'];
						$Tiempo_Entrega = $data['Tiempo_Entrega'];
					}
					$query = "INSERT INTO cotizacionherramientas (cliente, cotizacionNo, cotizacionRef, marca, modelo, descripcion, precioLista, flete, cantidad, Unidad, ClaveProductoSAT, proveedorFlete, NoSerie, fechaCompromiso, Pedido, pedidoFecha, fechaPedido, ordenCompra, numeroPedido, Proveedor, proveedorFecha, moneda, referencia_interna, lugar_cotizacion, Tiempo_Entrega) VALUES ('$cliente', '$cotizacionNo', '$cotizacionRef', '$marca', '$modelo', '$descripcion', '$precioLista', '$flete', '$split', '$Unidad', '$ClaveProductoSAT', '$proveedorFlete', '$NoSerie', '$fechaCompromiso', '$Pedido', '$pedidoFecha', '$fechaPedido', '$ordenCompra', '$numeroPedido', '$Proveedor', '$proveedorFecha', '$moneda', '$referencia_interna', '$lugar_cotizacion', '$Tiempo_Entrega')";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al modificar los datos de la partida!";
					}else{
						$query = "UPDATE pedidos SET partidas = (partidas + 1) WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
						$resultado = mysqli_query($conexion_usuarios, $query);

						$cantidad = $cantidad - $split;
						$query = "UPDATE cotizacionherramientas SET cantidad='$cantidad' WHERE id=$id";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al actualizar el número de partidas!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "Los datos de la partida se modificaron y se aplicó el split correctamente!";

							$descripcionmovimiento = "Se modifico la informacion de la herramienta ".$modelo." de la marca ".$marca." y se aplico un split de ".$cantidad." - ".$split." del pedido ".$numeroPedido;
							$fechamovimiento = date("Y-m-d H:i:s");
							$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
							$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
						}
					}
				}
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "Los datos de la partida se modificaron correctamente!";

				$descripcionmovimiento = "Se modifico la informacion de la herramienta ".$modelo." de la marca ".$marca." del pedido ".$numeroPedido;
				$fechamovimiento = date("Y-m-d H:i:s");
				$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'pedidos', '$descripcionmovimiento', '$fechamovimiento')";
				$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function guardar_factura($folio, $refCotizacion, $ordenpedido, $subtotal, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios, $idusuario){
		$ordenpedido = str_replace(".","",$ordenpedido);
		$ordenpedido = str_replace(",","",$ordenpedido);
		$ordenpedido = str_replace("OC","",$ordenpedido);
		$folio = str_replace("H ","",$folio);

		$query = "INSERT INTO facturas (folio, tipoDocumento, ordenpedido, subtotal, total, moneda, status, fecha, UID, UUID, cliente) VALUES ('$folio', '$tipoDocumento', '$ordenpedido', '$subtotal', '$total','$moneda', '$status', '$fecha', '$uidfactura', '$uuidfactura', '$cliente')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la factura '".$folio."'!";
		}else{
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la informacion del pedido, la referencia de cotización esta vacía!";

			$descripcionmovimiento = "Se genero la factura ".$folio." con pedido ".$ordenpedido." del cliente ".$cliente;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'pedidos/facturas', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}

		echo json_encode($informacion);
	}

?>
