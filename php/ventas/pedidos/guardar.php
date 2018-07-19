<?php

	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'cambiarMoneda':
		 	$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			cambiar_moneda($refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'numeroguia':
			$numeroguia = $_POST['numeroguia'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			numeroguia($numeroguia, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'paqueteria':
			$paqueteria = $_POST['paqueteria'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			paqueteria($paqueteria, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'formapago':
			$formapago = $_POST['formapago'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			formapago($formapago, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;
		case 'metodopago':
			$metodopago = $_POST['metodopago'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			metodopago($metodopago, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;
		case 'usocfdi':
			$cfdi = $_POST['cfdi'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			usocfdi($cfdi, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;
		case 'proveedor':
			$proveedor = $_POST['proveedor'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			$data = json_decode($_POST['herramienta']);
			proveedor($proveedor, $refCotizacion, $numeroPedido, $data, $conexion_usuarios);
			break;

		case 'cantidad':
			$cantidad = $_POST['cantidad'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			$data = json_decode($_POST['herramienta']);
			cantidad($cantidad, $refCotizacion, $numeroPedido, $data, $conexion_usuarios);
			break;

		case 'editarpartida':
			$id = $_POST['id'];
			$descripcion = $_POST['descripcion'];
			$claveSat = $_POST['claveSat'];
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
			editarpartida($id, $descripcion, $claveSat, $noserie, $fechacompromiso, $proveedor, $split, $pedimento, $entregado, $conexion_usuarios);
			break;

		case 'guardarfactura':
			$folio = $_POST['folio'];
			$ordenpedido = $_POST['ordenpedido'];
			$total = $_POST['total'];
			$status = $_POST['status'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			$tipoDocumento = $_POST['tipoDocumento'];
			$moneda = $_POST['moneda'];
			$uidfactura = $_POST['UIDFactura'];
			$uuidfactura = $_POST['UUIDFactura'];
			guardar_factura($folio, $ordenpedido, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios);
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
			packinglist($data, $conexion_usuarios);
			break;

		case 'entregado':
			$data = json_decode($_POST['herramienta']);
			entregado($data, $conexion_usuarios);
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

	function cambiar_moneda($refCotizacion, $numeroPedido, $conexion_usuarios){
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
			}else{
				$query = "SELECT moneda FROM cotizacion WHERE ref = '$refCotizacion'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al buscar la moneda de la cotización!";
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$moneda = $data['moneda'];
					}

					$total = 0;
					$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$refCotizacion'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al buscar información de las partidas!";
					}else{
						if ($moneda == "mxn") {
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
							$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'usd' WHERE ref = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);
							if (!$resultado) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
							}else{
								$informacion["respuesta"] = "BIEN";
								$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

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
							$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'mxn' WHERE ref = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);
							if (!$resultado) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
							}else{
								$informacion["respuesta"] = "BIEN";
								$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

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
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function packinglist($data, $conexion_usuarios){
		foreach ($data as &$id) {
			$query = "UPDATE cotizacionherramientas SET embarque='pendiente' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al agregar las partidas al packing list!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Las partidas se agregaron al packinglist correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function entregado($herramienta, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($herramienta as &$id) {
			$query = "UPDATE utilidad_pedido SET fecha_entregado='$fecha' WHERE id_cotizacion_herramientas=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$query = "UPDATE cotizacionherramientas SET Entregado='$fecha' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "SELECT marca, modelo, cantidad FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$cantidad = $data['cantidad'];
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
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function numeroguia($numeroguia, $refCotizacion, $numeroPedido, $conexion_usuarios){
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
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function paqueteria($paqueteria, $refCotizacion, $numeroPedido, $conexion_usuarios){
		if($paqueteria == "NINGUNA"){
			$paqueteria = "";
		}

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
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function formapago($formapago, $refCotizacion, $numeroPedido, $conexion_usuarios){
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
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function metodopago($metodopago, $refCotizacion, $numeroPedido, $conexion_usuarios){
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
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function usocfdi($cfdi, $refCotizacion, $numeroPedido, $conexion_usuarios){
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
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function proveedor($proveedor, $refCotizacion, $numeroPedido, $data, $conexion_usuarios){
		foreach ($data as &$valor) {
			$id = $valor;

			if ($proveedor == "ALMACEN") {
				$fecha = date("Y-m-d");
				$query = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}else{
				$fecha = "0000-00-00";
				$query = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}

			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al guardar el proveedor ".$proveedor."!";
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "El proveedor ".$proveedor." se guardó correctamente!";
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cantidad($cantidad, $refCotizacion, $numeroPedido, $partidas, $conexion_usuarios){
		foreach ($partidas as &$id) {
			$query = "UPDATE cotizacionherramientas SET cantidad='$cantidad' WHERE id='$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al cambiar la cantidad de la(s) partida(s).";
		}else{
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

	function editarpartida($id, $descripcion, $claveSat, $noserie, $fechacompromiso, $proveedor, $split, $pedimento, $entregado, $conexion_usuarios){
		$query = "UPDATE utilidad_pedido SET Pedimento = '$pedimento', fecha_entregado = '$entregado' WHERE id_cotizacion_herramientas =$id";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if ($proveedor == "ALMACEN") {
			$fecha = date("Y-m-d");
			$query = "UPDATE cotizacionherramientas SET descripcion='$descripcion', 'ClaveProductoSAT='$claveSat', NoSerie='$noserie', fechacompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha', Pedimento = '$pedimento', Entregado='$entregado' WHERE id =$id";
		}else{
			$fecha = "0000-00-00";
			$query = "UPDATE cotizacionherramientas SET descripcion='$descripcion', ClaveProductoSAT='$claveSat', NoSerie='$noserie', fechacompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', enviadoFecha='$fecha', recibidoFecha='$fecha', Pedimento = '$pedimento', Entregado='$entregado' WHERE id =$id";
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
						$fechaPedido = $data['fechaPedido'];
						$Proveedor = $data['Proveedor'];
						$ordenCompra = $data['ordenCompra'];
						$numeroPedido = $data['numeroPedido'];
						$moneda = $data['moneda'];
						$referencia_interna = $data['referencia_interna'];
						$lugar_cotizacion = $data['lugar_cotizacion'];
						$Tiempo_Entrega = $data['Tiempo_Entrega'];
					}
					$query = "INSERT INTO cotizacionherramientas (cliente, cotizacionNo, cotizacionRef, marca, modelo, descripcion, precioLista, flete, cantidad, Unidad, ClaveProductoSAT, proveedorFlete, NoSerie, fechaCompromiso, Pedido, fechaPedido, ordenCompra, numeroPedido, Proveedor, moneda, referencia_interna, lugar_cotizacion, Tiempo_Entrega) VALUES ('$cliente', '$cotizacionNo', '$cotizacionRef', '$marca', '$modelo', '$descripcion', '$precioLista', '$flete', '$split', '$Unidad', '$ClaveProductoSAT', '$proveedorFlete', '$NoSerie', '$fechaCompromiso', '$Pedido', '$fechaPedido', '$ordenCompra', '$numeroPedido', '$Proveedor', '$moneda', '$referencia_interna', '$lugar_cotizacion', '$Tiempo_Entrega')";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al modificar los datos de la partida!";
					}else{
						$cantidad = $cantidad - $split;
						$query = "UPDATE cotizacionherramientas SET cantidad='$cantidad' WHERE id=$id";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al actualizar el número de partidas!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "Los datos de la partida se modificaron y se aplicó el split correctamente!";
						}
					}
				}
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "Los datos de la partida se modificaron correctamente!";
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function guardar_factura($folio, $ordenpedido, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios){
		$ordenpedido = str_replace(".","",$ordenpedido);
		$ordenpedido = str_replace(",","",$ordenpedido);
		$ordenpedido = str_replace("OC","",$ordenpedido);

		$query = "INSERT INTO facturas (folio, tipoDocumento, ordenpedido, total, moneda, status, fecha, UID, UUID, cliente) VALUES ('$folio', '$tipoDocumento', '$ordenpedido', '$total','$moneda', '$status', '$fecha', '$uidfactura', '$uuidfactura', '$cliente')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$fecha = date("Y-m-d");
		$query = "UPDATE pedidos SET factura = '$folio', facturaFecha = '$fecha' WHERE numeroPedido = '$ordenpedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET factura = '$folio', facturaFecha = '$fecha' WHERE NoPedClient = '$ordenpedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la factura '".$folio."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La factura '".$folio."' se guardó en el sistema correctamente!";
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
