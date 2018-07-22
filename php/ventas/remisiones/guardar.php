<?php
	include("../../conexion.php");
	// error_reporting(0);

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'cambiarMoneda':
			$remision = $_POST['remision'];
			cambiar_moneda($remision, $conexion_usuarios);
			break;

		case 'numeroguia':
			$numeroguia = $_POST['numeroguia'];
			$remision = $_POST['remision'];
			numeroguia($numeroguia, $remision, $conexion_usuarios);
			break;

		case 'paqueteria':
			$paqueteria = $_POST['paqueteria'];
			$remision = $_POST['remision'];
			paqueteria($paqueteria, $remision, $conexion_usuarios);
			break;

		case 'proveedor':
			$proveedor = $_POST['proveedor'];
			$remision = $_POST['remision'];
			proveedor($proveedor, $remision, $conexion_usuarios);
			break;

		case 'cantidad':
			$cantidad = $_POST['cantidad'];
			$remision = $_POST['remision'];
			cantidad($cantidad, $remision, $conexion_usuarios);
			break;

		case 'formapago':
			$formapago = $_POST['formapago'];
			$remision = $_POST['remision'];
			formapago($formapago, $remision, $conexion_usuarios);
			break;

		case 'metodopago':
			$metodopago = $_POST['metodopago'];
			$remision = $_POST['remision'];
			metodopago($metodopago, $remision, $conexion_usuarios);
			break;

		case 'usocfdi':
			$cfdi = $_POST['cfdi'];
			$remision = $_POST['remision'];
			usocfdi($cfdi, $remision, $conexion_usuarios);
			break;

		case 'editarpartida':
			$id = $_POST['id'];
			$descripcion = $_POST['descripcion'];
			$claveSat = $_POST['claveSat'];
			$noserie = $_POST['noserie'];
			$cantidad = $_POST['cantidad'];
			$fechacompromiso = $_POST['fechacompromiso'];
			$proveedor = $_POST['proveedor'];
			$entregado = $_POST['entregado'];
			if (isset($_POST['split'])) {
				$split = $_POST['split'];
			}else{
				$split = 0;
			}
			editarpartida($id, $descripcion, $claveSat, $noserie, $cantidad, $fechacompromiso, $proveedor, $split, $entregado, $conexion_usuarios);
			break;

		case 'agregarcontacto':
			$idcliente = $_POST['idcliente'];
			$contacto = $_POST['contacto'];
			$puesto = $_POST['puesto'];
			$calle = $_POST['calle'];
			$colonia = $_POST['colonia'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$cp = $_POST['cp'];
			$pais = $_POST['pais'];
			$tlf = $_POST['tlf'];
			$movil = $_POST['movil'];
			$correoElectronico = $_POST['correoElectronico'];
			agregar_contacto($usuariologin, $dplogin, $idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios);
			break;

		case 'guardarfactura':
			$folio = $_POST['folio'];
			$remision = $_POST['remision'];
			$total = $_POST['total'];
			$status = $_POST['status'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			$tipoDocumento = $_POST['tipoDocumento'];
			$moneda = $_POST['moneda'];
			$uidfactura = $_POST['UIDFactura'];
			$uuidfactura = $_POST['UUIDFactura'];
			guardar_factura($folio, $remision, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios);
			break;

		case 'quitarstock':
			$remision = $_POST['remision'];
			$partidas = json_decode($_POST['herramienta']);
			$folio = $_POST['folio'];
			$tipoDocumento = $_POST['tipoDocumento'];
			quitar_stock($remision, $partidas, $folio, $tipoDocumento, $conexion_usuarios);
			break;

		case 'agregarherramientaremision':
			$data = json_decode($_POST['herramienta']);
			$remision = $_POST['remision'];
			agregar_herramienta($data, $remision, $conexion_usuarios);
			break;

		case 'quitarherramienta':
			$remision = $_POST['remision'];
			$herramienta = json_decode($_POST['herramienta']);
			quitar_herramienta($remision, $herramienta, $conexion_usuarios);
			break;

		case 'packinglist':
			$data = json_decode($_POST['herramienta']);
			packinglist($data, $conexion_usuarios);
			break;

		case 'entregado':
			$data = json_decode($_POST['herramienta']);
			entregado($data, $conexion_usuarios);
			break;

		case 'nuevaremision':
			$numeroCotizacion= $_POST['numeroCotizacion'];
			$remision = $_POST['remision'];
			$fechaCotizacion = $_POST['fechaCotizacion'];
			$vendedor = $_POST['vendedor'];
			$cliente = $_POST['cliente'];
			$contactoCliente = $_POST['contactoCliente'];
			$moneda = $_POST['moneda'];
			$comentarios = $_POST['comentarios'];
			nuevaremision($numeroCotizacion, $remision, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $comentarios, $conexion_usuarios);
			break;
	}

	function quitar_stock($remision, $partidas, $folio, $tipoDocumento, $conexion_usuarios){
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
						$query2 = "UPDATE cotizacionherramientas SET factura='$folio' WHERE id = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);

						$query2 = "UPDATE utilidad_pedido SET factura_hemusa='$folio' WHERE id_cotizacion_herramientas = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
				}else{
						$query2 = "UPDATE cotizacionherramientas SET Entregado='$fecha', factura='$folio' WHERE id = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);

						$query2 = "UPDATE utilidad_pedido SET fecha_entregado='$fecha', factura_hemusa='$folio' WHERE id_cotizacion_herramientas = '$id'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
				}
			}
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la herramienta!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La herramienta se modificó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_moneda($remision, $conexion_usuarios){
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

			$query = "SELECT moneda FROM remisiones WHERE remision = '$remision'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (mysqli_num_rows($resultado) > 0) {
				while($data = mysqli_fetch_assoc($resultado)){
					$monedapedido = $data['moneda'];
				}

				$query = "SELECT * FROM cotizacionherramientas WHERE remision = '$remision'";
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
						$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'usd' WHERE remision = '$remision'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
						}
						$query = "UPDATE remisiones SET total = '$total', moneda = 'usd' WHERE remision ='$remision'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
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
						$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'mxn' WHERE remision = '$remision'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
						}
						$query = "UPDATE remisiones SET total = '$total', moneda = 'mxn' WHERE remision='$remision'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
						}
					}
				}
			}else{
				$query = "SELECT moneda FROM cotizacion WHERE remision = '$remision'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al buscar la moneda de la cotización!";
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$moneda = $data['moneda'];
					}

					$total = 0;
					$query = "SELECT * FROM cotizacionherramientas WHERE remision = '$remision'";
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
							$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'usd' WHERE remision = '$remision'";
							$resultado = mysqli_query($conexion_usuarios, $query);
							if (!$resultado) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
							}else{
								$informacion["respuesta"] = "BIEN";
								$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
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
							$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'mxn' WHERE remision = '$remision'";
							$resultado = mysqli_query($conexion_usuarios, $query);
							if (!$resultado) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
							}else{
								$informacion["respuesta"] = "BIEN";
								$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
							}
						}
					}
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function agregar_contacto($usuariologin, $dplogin, $idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios){
		$query = "INSERT INTO contactospersonas (empresa,personaContacto,puesto,calle,colonia,ciudad,estado,cp,pais,tlf1,movil,correoElectronico) VALUES ('$idcliente', '$contacto', '$puesto', '$calle', '$colonia', '$ciudad', '$estado', '$cp', '$pais', '$tlf', '$movil', '$correoElectronico')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al registrar el contacto '".$contacto."'!";
		}else{
			$informacion["idcliente"] = $idcliente;
			$informacion["guardar"] = "contacto";
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se guardo el contacto '".$contacto."' correctamente!";

			$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while ($data = mysqli_fetch_assoc($resultado)) {
				$cliente = $data['nombreEmpresa'];
			}

			$descripcion = "Se agrego el contacto ".$contacto." al cliente ".$cliente;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
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
			$informacion["informacion"] = "Ocurrió un problema al intentar agregar la(s) partida(s) a la lista de embarque!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se agregó la(s) partida(s) a la lista de embarque correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function entregado($data, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;
			$query = "UPDATE utilidad_pedido SET fecha_entregado='$fecha' WHERE id_cotizacion_herramientas=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$query = "UPDATE cotizacionherramientas SET Entregado='$fecha' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la(s) partida(s)!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de la(s) partida(s) se modificó a 'Entregado' correctamente!";
		}

		echo json_encode($informacion);
		verificar_resultado($resultado);
	}

	function nuevaremision($numeroCotizacion, $remision, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $comentarios, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (mysqli_num_rows($resultado) < 1) {
			$informacion["respuesta"] = "ERROR";
			$informacion["remision"] = "Ocurrió un error al buscar información de contacto.";
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$idCliente = $data['id'];
				$idFormaPago = $data['IdFormaPago'];
				$idMetodoPago = $data['IdMetodoPago'];
				$idUsoCFDI = $data['IdUsoCFDI'];
			}
			$query = "INSERT INTO cotizacion (ref, cliente, contacto, vendedor, fecha, moneda, Otra, remision, remisionFecha) VALUES ('$numeroCotizacion', '$idCliente', '$contactoCliente', '$vendedor', '$fechaCotizacion', '$moneda', '$comentarios', '$remision', '$fechaCotizacion')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "INSERT INTO remisiones (remision, cotizacionRef, contacto, vendedor, fecha, cliente, moneda, IdFormaPago, IdMetodoPago, IdUsoCFDI, comentarios) VALUES ('$remision', '$numeroCotizacion', '$contactoCliente', '$vendedor', '$fechaCotizacion', '$idCliente', '$moneda', '$idFormaPago', '$idMetodoPago', '$idUsoCFDI', '$comentarios')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				verificar_resultado($resultado);
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["remision"] = $remision;
			}
		}
		echo json_encode($informacion);
	}

	function agregar_herramienta($herramienta, $remision, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($herramienta as &$id) {
			$query = "UPDATE utilidad_pedido SET remision = '$remision', fecha_entregado='$fecha' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE cotizacionherramientas SET remision = '$remision', Entregado='$fecha' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		$query = "SELECT moneda, partidaCantidad, precioTotal FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaremision = $data['moneda'];
			$partidas = $data['partidaCantidad'];
			$totalcotizacion = $data['precioTotal'];
		}

		$query = "SELECT tipocambio FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tipocambio = $data['tipocambio'];
		}

		$total = 0;
		$i = 0;

		foreach ($herramienta as &$id) {
			$query = "SELECT marca, modelo, precioLista, cantidad, moneda FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$precioUnitario = $data2['precioLista'];
				$precioLista = $data2['precioLista'] * $data2['cantidad'];
				$moneda = $data2['moneda'];
				$marca = $data2['marca'];
				$modelo = $data2['modelo'];
				$cantidadquitar = $data2['cantidad'];
			}

			$query = "SELECT enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$cantidad = $data2['enReserva'];
			}

			$cantidadstock = $cantidad - $cantidadquitar;

			$query = "UPDATE productos SET enReserva = '$cantidadstock' WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);


			if($monedaremision == "usd" && $moneda == "usd"){
				$precioUnitario = $precioUnitario;
				$total = $total + $precioLista;
			}else if($monedaremision == "usd" && $moneda == "mxn"){
				$precioUnitario = $precioUnitario / $tipocambio;
				$total = $total + ($precioLista / $tipocambio );
			}else if($monedaremision == "mxn" && $moneda == "mxn"){
				$precioUnitario = $precioUnitario;
				$total = $total + $precioLista;
			}else if($monedaremision == "mxn" && $moneda == "usd"){
				$precioUnitario = $precioUnitario * $tipocambio;
				$total = $total + ($precioLista * $tipocambio );
			}

			$i++;
			$query = "UPDATE cotizacionherramientas SET precioLista = '$precioUnitario', moneda = '$monedaremision' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
		$partidas = $partidas + $i;
		$totalcotizacion = $totalcotizacion + $total;
		$query = "UPDATE remisiones SET total = '$totalcotizacion', partidas = '$partidas' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET precioTotal = '$totalcotizacion', partidaCantidad = '$partidas' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);


		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar agregar la herramienta a la remisión!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La herramienta se agregó a la remisión correctamente!";
		}

		echo json_encode($informacion);
	}

	function quitar_herramienta($remision, $herramienta, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($herramienta as &$id) {
			$query = "UPDATE utilidad_pedido SET remision = '', fecha_entregado='0000-00-00' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE cotizacionherramientas SET remision = '', Entregado='0000-00-00' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		$query = "SELECT moneda, partidaCantidad, precioTotal FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaremision = $data['moneda'];
			$partidas = $data['partidaCantidad'];
			$totalcotizacion = $data['precioTotal'];
		}

		$query = "SELECT tipocambio FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tipocambio = $data['tipocambio'];
		}

		$total = 0;
		$i = 0;

		foreach ($herramienta as &$id) {
			$query = "SELECT marca, modelo, precioLista, cantidad, moneda FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$precioUnitario = $data2['precioLista'];
				$precioLista = $data2['precioLista'] * $data2['cantidad'];
				$moneda = $data2['moneda'];
				$marca = $data2['marca'];
				$modelo = $data2['modelo'];
				$cantidadquitar = $data2['cantidad'];
			}

			$query = "SELECT enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$cantidad = $data2['enReserva'];
			}

			$cantidadstock = $cantidad + $cantidadquitar;

			$query = "UPDATE productos SET enReserva = '$cantidadstock' WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);


			// if($monedaremision == "usd" && $moneda == "usd"){
			// 	$precioUnitario = $precioUnitario;
			// 	$total = $total + $precioLista;
			// }else if($monedaremision == "usd" && $moneda == "mxn"){
			// 	$precioUnitario = $precioUnitario / $tipocambio;
			// 	$total = $total + ($precioLista / $tipocambio );
			// }else if($monedaremision == "mxn" && $moneda == "mxn"){
			// 	$precioUnitario = $precioUnitario;
			// 	$total = $total + $precioLista;
			// }else if($monedaremision == "mxn" && $moneda == "usd"){
			// 	$precioUnitario = $precioUnitario * $tipocambio;
			// 	$total = $total + ($precioLista * $tipocambio );
			// }

			$total = $total + $precioLista;

			$i++;
			$query = "UPDATE cotizacionherramientas SET precioLista = '$precioUnitario', moneda = '$monedaremision' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
		$partidas = $partidas - $i;
		$totalcotizacion = $totalcotizacion - $total;
		$query = "UPDATE remisiones SET total = '$totalcotizacion', partidas = '$partidas' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET precioTotal = '$totalcotizacion', partidaCantidad = '$partidas' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);


		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar agregar la herramienta a la remisión!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La herramienta se agregó a la remisión correctamente!";
		}

		echo json_encode($informacion);
	}

	function numeroguia($numeroguia, $remision, $conexion_usuarios){
		$query = "UPDATE remisiones SET numeroGuia='$numeroguia' WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET guia='$numeroguia' WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
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

	function paqueteria($paqueteria, $remision, $conexion_usuarios){
		if($paqueteria == "NINGUNA"){
			$paqueteria = 0;
		}
		$query = "UPDATE remisiones SET paqueteria='$paqueteria' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET IdPaqueteria='$paqueteria' WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

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

	function proveedor($proveedor, $remision, $conexion_usuarios){
		$query = "SELECT id FROM cotizacionherramientas WHERE remision='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$id = $data['id'];
				if($proveedor == "None"){
					$fecha = "0000-00-00";
				}else{
					$fecha = date("Y-m-d");
				}
				$query2 = "UPDATE cotizacionherramientas SET Proveedor='$proveedor', proveedorFecha='$fecha' WHERE id='$id'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);
				if (!$resultado2) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al guardar el proveedor ".$proveedor."!";
				}else{
					$informacion["respuesta"] = "BIEN";
					$informacion["informacion"] = "El proveedor ".$proveedor." se guardó correctamente!";
				}
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cantidad($cantidad, $remision, $conexion_usuarios){
		$query = "SELECT id FROM cotizacionherramientas WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$id = $data['id'];
				$query2 = "UPDATE cotizacionherramientas SET cantidad='$cantidad' WHERE id='$id'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);
				if (!$resultado2) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al modificar la cantidad de las partidas!";
				}else{
					$informacion["respuesta"] = "BIEN";
					$informacion["informacion"] = "La cantidad de las partidas se modificó correctamente!";
				}
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function formapago($formapago, $remision, $conexion_usuarios){
		$query = "UPDATE remisiones SET IdFormaPago='$formapago' WHERE remision='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT * FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
		}

		$query = "UPDATE contactos SET IdFormaPago='$formapago' WHERE id='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar la forma de pago!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La forma de pago se actualizó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function metodopago($metodopago, $remision, $conexion_usuarios){
		$query = "UPDATE remisiones SET IdMetodoPago='$metodopago' WHERE remision='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT * FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
		}

		$query = "UPDATE contactos SET IdMetodoPago='$metodopago' WHERE id='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar el método de pago!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El método de pago se actualizó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function usocfdi($cfdi, $remision, $conexion_usuarios){
		$query = "UPDATE remisiones SET IdUsoCFDI='$cfdi' WHERE remision='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT * FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
		}

		$query = "UPDATE contactos SET IdUsoCFDI='$cfdi' WHERE id='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar el uso de CFDI!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El CFDI se actualizó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editarpartida($id, $descripcion, $claveSat, $noserie, $cantidad, $fechacompromiso, $proveedor, $split, $entregado, $conexion_usuarios){
		if($proveedor == "None"){
			$fecha = "0000-00-00";
		}else{
			$fecha = date("Y-m-d");
		}
		$query = "UPDATE utilidad_pedido SET fecha_entregado = '$entregado' WHERE id_cotizacion_herramientas =$id";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacionherramientas SET descripcion='$descripcion', ClaveProductoSAT='$claveSat', NoSerie='$noserie', cantidad='$cantidad', fechacompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', Entregado = '$entregado' WHERE id =$id";
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
						$remision = $data['remision'];
					}
					$query = "INSERT INTO cotizacionherramientas (cliente, cotizacionNo, cotizacionRef, marca, modelo, descripcion, precioLista, flete, cantidad, Unidad, ClaveProductoSAT, proveedorFlete, NoSerie, fechaCompromiso, Pedido, fechaPedido, ordenCompra, numeroPedido, Proveedor, moneda, referencia_interna, lugar_cotizacion, Tiempo_Entrega, remision) VALUES ('$cliente', '$cotizacionNo', '$cotizacionRef', '$marca', '$modelo', '$descripcion', '$precioLista', '$flete', '$split', '$Unidad', '$ClaveProductoSAT', '$proveedorFlete', '$NoSerie', '$fechaCompromiso', '$Pedido', '$fechaPedido', '$ordenCompra', '$numeroPedido', '$Proveedor', '$moneda', '$referencia_interna', '$lugar_cotizacion', '$Tiempo_Entrega', '$remision')";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al aplicar el split a la partida!";
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

	function guardar_factura($folio, $remision, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios){
		$query = "INSERT INTO facturas (folio, tipoDocumento, remision, total, status, moneda, fecha, UID, UUID, cliente) VALUES ('$folio', '$tipoDocumento', '$remision', '$total', '$status', '$moneda', '$fecha', '$uidfactura', '$uuidfactura', '$cliente')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$fecha = date("Y-m-d");

		$query = "UPDATE cotizacion SET factura = '$folio', facturaFecha = '$fecha' WHERE remision = '$remision'";
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

 ?>
