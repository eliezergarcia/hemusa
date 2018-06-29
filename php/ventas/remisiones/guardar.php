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
			editarpartida($id, $claveSat, $noserie, $cantidad, $fechacompromiso, $proveedor, $split, $entregado, $conexion_usuarios);
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
			$ordenpedido = $_POST['ordenpedido'];
			$total = $_POST['total'];
			$status = $_POST['status'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			guardar_factura($folio, $ordenpedido, $total, $status, $fecha, $cliente, $conexion_usuarios);
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

		case 'agregarherramientaremision':
			$data = json_decode($_POST['herramienta']);
			$remision = $_POST['remision'];
			agregar_herramienta($data, $remision, $conexion_usuarios);
			break;

		case 'quitarherramientaremision':
			$idherramienta = $_POST['idherramienta'];
			$remision = $_POST['remision'];
			quitar_herramienta($idherramienta, $remision, $conexion_usuarios);
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
			$query = "SELECT moneda, total FROM pedidos WHERE remision = '$remision'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (mysqli_num_rows($resultado) > 0) {
				while($data = mysqli_fetch_assoc($resultado)){
					$monedapedido = $data['moneda'];
					$totalpedido = $data['pedido'];
				}

				if ($monedapedido == "mxn") {
					// Se hace el cambio a moneda USD
					$totalpedido = $totalpedido / $tipocambio;
					$monedacambio = "usd";
				}else{
					// Se hace el cambio a moneda MXN
					$totalpedido = $totalpedido * $tipocambio;
					$monedacambio = "mxn";
				}

				$query = "UPDATE pedidos SET total = '$totalpedido', moneda = '$monedacambio' WHERE remision = '$remision'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}

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
						$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'mxn' WHERE remision = '$remision'";
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
		foreach ($data as &$valor) {
			$id = $valor;
			$query = "UPDATE cotizacionherramientas SET embarque='pendiente' WHERE id=$id";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar agregar la(s) partida(s) al packing list!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se agregó la(s) partida(s) al packing list correctamente!";
		}

		echo json_encode($informacion);
		verificar_resultado($resultado);
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
		$query = "SELECT id FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$idCliente = $data['id'];
			}
			$query = "INSERT INTO cotizacion (ref, cliente, contacto, vendedor, fecha, moneda, Otra, remision, remisionFecha) VALUES ('$numeroCotizacion', '$idCliente', '$contactoCliente', '$vendedor', '$fechaCotizacion', '$moneda', '$comentarios', '$remision', '$fechaCotizacion')";
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
		foreach ($herramienta as &$valor) {
			$id = $valor;
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

		foreach ($herramienta as &$valor) {
			$id = $valor;
			$query = "SELECT precioLista, cantidad, moneda FROM cotizacionherramientas WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$precioLista = $data2['precioLista'] * $data2['cantidad'];
				$moneda = $data2['moneda'];
			}

			if($monedaremision == "usd" && $moneda == "usd"){
				$total = $total + $precioLista;
			}else if($monedaremision == "usd" && $moneda == "mxn"){
				$total = $total + ($precioLista / $tipocambio );
			}else if($monedaremision == "mxn" && $moneda == "mxn"){
				$total = $total + $precioLista;
			}else if($monedaremision == "mxn" && $moneda == "usd"){
				$total = $total + ($precioLista * $tipocambio );
			}
			$i++;
		}
		$partidas = $partidas + $i;
		$totalcotizacion = $totalcotizacion + $total;
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

	function quitar_herramienta($idherramienta, $remision, $conexion_usuarios){
		$fecha = date("Y-m-d");
		$query = "UPDATE utilidad_pedido SET remision = '$remision', fecha_entregado='$fecha' WHERE id_cotizacion_herramientas = '$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacionherramientas SET remision = '', Entregado='0000-00-00'  WHERE id = '$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT moneda FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaremision = $data['moneda'];
		}

		$query = "SELECT tipocambio FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tipocambio = $data['tipocambio'];
		}

		$total = 0;
		$i = 0;
		$query = "SELECT precioLista, cantidad, moneda FROM cotizacionherramientas WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$precioLista = $data['precioLista'] * $data['cantidad'];
			$moneda = $data['moneda'];
			if($monedaremision == "usd" && $moneda == "usd"){
				$total = $total + $precioLista;
			}else if($monedaremision == "usd" && $moneda == "mxn"){
				$total = $total + ($precioLista / $tipocambio );
			}else if($monedaremision == "mxn" && $moneda == "mxn"){
				$total = $total + $precioLista;
			}else if($monedaremision == "mxn" && $moneda == "usd"){
				$total = $total + ($precioLista * $tipocambio );
			}
			$i++;
		}

		$query = "UPDATE cotizacion SET precioTotal = '$total', partidaCantidad = '$i' WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar quitar la herramienta de la remisión!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La herramienta se quitó de la remisión correctamente!";
		}

		echo json_encode($informacion);
	}

	function numeroguia($numeroguia, $remision, $conexion_usuarios){
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

	function editarpartida($id, $claveSat, $noserie, $cantidad, $fechacompromiso, $proveedor, $split, $entregado, $conexion_usuarios){
		if($proveedor == "None"){
			$fecha = "0000-00-00";
		}else{
			$fecha = date("Y-m-d");
		}
		$query = "UPDATE utilidad_pedido SET fecha_entregado = '$entregado' WHERE id_cotizacion_herramientas =$id";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacionherramientas SET ClaveProductoSAT='$claveSat', NoSerie='$noserie', cantidad='$cantidad', fechacompromiso='$fechacompromiso', Proveedor='$proveedor', proveedorFecha='$fecha', Entregado = '$entregado' WHERE id =$id";
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

	function guardar_factura($folio, $ordenpedido, $total, $status, $fecha, $cliente, $conexion_usuarios){
		$query = "SELECT * FROM facturas WHERE folio = '$folio'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) == 0){
			$query = "INSERT INTO facturas (folio, ordenpedido, total, status, fecha, cliente) VALUES ('$folio', '$ordenpedido', '$total', '$status', '$fecha', '$cliente')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$fecha = date("Y-m-d");

			$query = "UPDATE cotizacion SET factura = '$folio', facturaFecha = '$fecha' WHERE remision = '$ordenpedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
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
