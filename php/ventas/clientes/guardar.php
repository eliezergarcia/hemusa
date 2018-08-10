<?php
	include("../../conexion.php");
	include("../../sesion.php");

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'agregarcliente':
			$nombreEmpresa = $_POST['nombreEmpresa'];
			$alias = $_POST['alias'];
			$rfc = $_POST['rfc'];
			$moneda = $_POST['moneda'];
			$calle = $_POST['calle'];
			$numExterior = $_POST['numExterior'];
			$numInterior = $_POST['numInterior'];
			$colonia = $_POST['colonia'];
			$cp = $_POST['cp'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$pais = $_POST['pais'];
			$tlf1 = $_POST['tlf1'];
			$tlf2 = $_POST['tlf2'];
			$paginaWeb = $_POST['paginaWeb'];
			$correoElectronico = $_POST['correoElectronico'];

			$existe = existe_cliente($rfc, $conexion_usuarios);
			if($existe > 0 ){
				$informacion["respuesta"] = "EXISTE";
				$informacion["informacion"] = "No se pudo registrar la información porque el RFC '".$rfc."' ya existe!";
				echo json_encode($informacion);
			}else{
				agregar_cliente($nombreEmpresa, $alias, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios, $idusuario);
			}

			break;

		case 'eliminarcliente':
			$idcliente = $_POST['idcliente'];
			$nombreEmpresa = $_POST['nombreEmpresa'];
			eliminar_cliente($idcliente, $nombreEmpresa, $conexion_usuarios, $idusuario);
			break;

		case 'agregarclas':
			$idcliente = $_POST['idcliente'];
			$clas = $_POST['clasificacion'];
			$nombrecliente = $_POST['nombrecliente'];
			agregarClas($usuariologin, $dplogin, $idcliente, $clas, $nombrecliente, $conexion_usuarios);
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
			agregar_contacto($idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios, $idusuario, $idusuario);
			break;

		case 'agregarcotizacion':
			$usuariologin = $_POST['usuariologin'];
			$dplogin = $_POST['dplogin'];
			$numerocotizacion = $_POST['numerocotizacion'];
			$fechacotizacion = $_POST['fechacotizacion'];
			$vendedor = $_POST['vendedor'];
			$idcliente = $_POST['idcliente'];
			$contactocliente = $_POST['contactocliente'];
			$moneda = $_POST['moneda'];
			$tiempoentrega = $_POST['tiempoEntrega'];
			$condicionespago = $_POST['condicionesPago'];
			$comentarios = $_POST['comentarios'];
			agregar_cotizacion($numerocotizacion, $fechacotizacion, $vendedor, $idcliente, $contactocliente, $moneda, $tiempoentrega, $condicionespago, $comentarios, $conexion_usuarios, $idusuario);
			break;

		case 'editarinformacion':
			$idcontacto = $_POST['idcliente'];
			$empresa = $_POST['empresa'];
			$alias = $_POST['alias'];
			$rfc = $_POST['rfc'];
			$contacto = $_POST['contacto'];
			$calle = $_POST['calle'];
			$noexterior = $_POST['noexterior'];
			$nointerior = $_POST['nointerior'];
			$colonia = $_POST['colonia'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$cp = $_POST['cp'];
			$pais = $_POST['pais'];
			$tlf1 = $_POST['tlf1'];
			$tlf2 = $_POST['tlf2'];
			$movil = $_POST['movil'];
			$correofac1 = $_POST['correofac1'];
			$correofac2 = $_POST['correofac2'];
			$correo = $_POST['correo'];
			$paginaweb = $_POST['paginaweb'];
			$credito = $_POST['credito'];
			$contactohemusa = $_POST['contactohemusa'];
			$moneda = $_POST['moneda'];
			$clasificacion = $_POST['clasificacion'];
			$formapago = $_POST['formapago'];
			$metodopago = $_POST['metodopago'];
			$cfdi = $_POST['cfdi'];
			editar_informacion($idcontacto, $empresa, $alias, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $clasificacion, $formapago, $metodopago, $cfdi, $conexion_usuarios, $idusuario);
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
			nuevaremision($numeroCotizacion, $remision, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $comentarios, $conexion_usuarios, $idusuario, $idusuario);
			break;

		case 'agregarcuenta':
			$idcliente= $_POST['idcliente'];
			$cuenta= $_POST['cuenta'];
			$moneda= $_POST['moneda'];
			agregar_cuenta($idcliente, $cuenta, $moneda, $conexion_usuarios, $idusuario);
			break;

		case 'editarcuenta':
			$idcuenta= $_POST['idcuenta'];
			$cuenta= $_POST['cuenta'];
			$moneda= $_POST['moneda'];
			editar_cuenta($idcuenta, $cuenta, $moneda, $conexion_usuarios, $idusuario);
			break;

		case 'eliminarcuenta':
			$idcuenta= $_POST['idcuenta'];
			eliminar_cuenta($idcuenta, $conexion_usuarios, $idusuario);
			break;

		case 'guardarfactura':
			$folio = $_POST['folio'];
			$remisiones = json_decode($_POST['remisiones']);
			$total = $_POST['total'];
			$status = $_POST['status'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			$tipoDocumento = $_POST['tipoDocumento'];
			$moneda = $_POST['moneda'];
			$uidfactura = $_POST['UIDFactura'];
			$uuidfactura = $_POST['UUIDFactura'];
			guardar_factura($folio, $remisiones, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios, $idusuario);
			break;

		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function guardar_factura($folio, $remisiones, $total, $status, $fecha, $tipoDocumento, $moneda, $uidfactura, $uuidfactura, $cliente, $conexion_usuarios, $idusuario){
		$folio = str_replace("H ","",$folio);

		$ordenpedido = "";
		foreach ($remisiones as &$remision) {
			$ordenpedido = $remision.", ".$ordenpedido;
		}

		$query = "INSERT INTO facturas (folio, tipoDocumento, remision, total, moneda, status, fecha, UID, UUID, cliente) VALUES ('$folio', '$tipoDocumento', '$ordenpedido', '$total','$moneda', '$status', '$fecha', '$uidfactura', '$uuidfactura', '$cliente')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$fecha = date("Y-m-d");

		$modelos = "";
		foreach ($remisiones as &$remision) {
			// $query = "UPDATE cotizacion SET factura = '$folio', facturaFecha = '$fecha' WHERE remision = '$remision'";
			// $resultado = mysqli_query($conexion_usuarios, $query);
			if ($remision != '' || $remision != 0) {
				$modelos = $remision.", ".$modelos;

				$query = "SELECT * FROM cotizacionherramientas WHERE remision = '$remision'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				$fecha = date("Y-m-d");
				while($data = mysqli_fetch_assoc($resultado)){
					$id = $data['id'];
					$query2 = "UPDATE cotizacionherramientas SET factura='$folio' WHERE remision = '$remision'";
					$resultado2 = mysqli_query($conexion_usuarios, $query2);

					$query2 = "UPDATE utilidad_pedido SET factura_hemusa='$folio' WHERE id_cotizacion_herramientas = '$id'";
					$resultado2 = mysqli_query($conexion_usuarios, $query2);
				}
			}

		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información de las partidas.";
		}else{
			$descripcionmovimiento = "Se genero la factura ".$folio." de las remisiones ".$modelos;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La factura '".$folio."' se guardó en el sistema correctamente.";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function agregar_cuenta($idcliente, $cuenta, $moneda, $conexion_usuarios, $idusuario){
		$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['nombreEmpresa'];

		$query = "INSERT INTO cuentasclientes (IdContacto, Cuenta, moneda) VALUES ('$idcliente', '$cuenta', '$moneda')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al agregar la cuenta de banco.";
		}else{
			$descripcionmovimiento = "Se agrego la cuenta de banco ".$cuenta." con moneda ".$moneda." al cliente ".$cliente;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La cuenta de banco se agregó correctamente.";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_cuenta($idcuenta, $cuenta, $moneda, $conexion_usuarios, $idusuario){
		$query = "SELECT cuentasclientes.IdContacto, contactos.nombreEmpresa FROM cuentasclientes INNER JOIN contactos ON contactos.id = cuentasclientes.IdContacto";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['nombreEmpresa'];

		$query = "UPDATE cuentasclientes SET Cuenta='$cuenta', moneda='$moneda' WHERE IdCuenta='$idcuenta'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al editar la cuenta de banco.";
		}else{
			$descripcionmovimiento = "Se modifico la informacion de la cuenta ".$cuenta." con moneda ".$moneda." al cliente ".$cliente;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La cuenta de banco se modificó correctamente.";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function eliminar_cuenta($idcuenta, $conexion_usuarios, $idusuario){
		$query = "SELECT cuentasclientes.IdContacto, cuentasclientes.Cuenta, contactos.nombreEmpresa FROM cuentasclientes INNER JOIN contactos ON contactos.id = cuentasclientes.IdContacto";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['nombreEmpresa'];
		$cuenta = $data['Cuenta'];

		$query = "DELETE FROM cuentasclientes WHERE IdCuenta = $idcuenta";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al eliminar la cuenta de banco.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La cuenta de banco se eliminó correctamente.";

			$descripcionmovimiento = "Se elimino la cuenta ".$cuenta." del cliente ".$cliente;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'E', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function existe_cliente($rfc, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE RFC = '$rfc' AND tipo = 'Cliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existecliente = mysqli_num_rows( $resultado );
		return $existecliente;
	}

	function agregar_cliente($nombreEmpresa, $alias, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios, $idusuario){
		$query = "INSERT INTO contactos (nombreEmpresa, alias, calle, NumInt, NumExt, ciudad, estado, cp, pais, tlf1, tlf2, correoElectronico, paginaWeb, RFC, colonia, tipo, moneda) VALUES ('$nombreEmpresa', '$alias', '$calle', '$numInterior', '$numExterior', '$ciudad', '$estado', '$cp', '$pais', '$tlf1', '$tlf2', '$correoElectronico', '$paginaWeb', '$rfc', '$colonia', 'Cliente', '$moneda')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al registrar la información del cliente '".$nombreEmpresa."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del cliente '".$nombreEmpresa."' se guardó correctamente!";

			$descripcionmovimiento = "Se registro el cliente ".$nombreEmpresa;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function eliminar_cliente($idcliente, $nombreEmpresa, $conexion_usuarios, $idusuario){
		$query = "DELETE FROM contactos WHERE id = $idcliente";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al eliminar el cliente '".$nombreEmpresa."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se eliminó el cliente '".$nombreEmpresa."' correctamente!";

			$descripcionmovimiento = "Se elimino el cliente ".$nombreEmpresa;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'E', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function nuevaremision($numeroCotizacion, $remision, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $comentarios, $conexion_usuarios, $idusuario){
		$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$idCliente = $data['id'];
				$idFormaPago = $data['IdFormaPago'];
				$idMetodoPago = $data['IdMetodoPago'];
				$idUsoCFDI = $data['IdUsoCFDI'];
			}
			// $query = "INSERT INTO cotizacion (ref, cliente, contacto, vendedor, fecha, moneda, Otra, remision, remisionFecha) VALUES ('$numeroCotizacion', '$idCliente', '$contactoCliente', '$vendedor', '$fechaCotizacion', '$moneda', '$comentarios', '$remision', '$fechaCotizacion')";
			// $resultado = mysqli_query($conexion_usuarios, $query);

			$query = "INSERT INTO remisiones (remision, cotizacionRef, contacto, vendedor, fecha, cliente, moneda, IdFormaPago, IdMetodoPago, IdUsoCFDI) VALUES ('$remision', '$numeroCotizacion', '$contactoCliente', '$vendedor', '$fechaCotizacion', '$idCliente', '$moneda', '$idFormaPago', '$idMetodoPago', '$idUsoCFDI')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al generar la remisión!";
			}else{
				$descripcionmovimiento = "Se creo la remision ".$remision." al cliente ".$cliente;
				$fechamovimiento = date("Y-m-d H:i:s");
				$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
				$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

				$informacion["respuesta"] = "nuevaremision";
				$informacion["remision"] = $remision;
				echo json_encode($informacion);
			}
		}
		mysqli_close($conexion_usuarios);
	}

	function agregarClas($usuariologin, $dplogin, $idcliente, $clas, $nombrecliente, $conexion_usuarios){
		switch ($clas) {
			case 'clas1':
				$clas = 1.20;
				break;

			case 'clas2':
				$clas = 1.25;
				break;

			case 'clas3':
				$clas = 1.33;
				break;

			case 'clas4':
				$clas = 1.42;
				break;
		}

		$query = "UPDATE contactos SET clasificacion='$clas' WHERE id=$idcliente";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			$descripcion = "Se modifico la clasificacion del cliente ".$nombrecliente." al ".$clas." %";
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}
		cerrar($conexion_usuarios);
	}

	function agregar_contacto($idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios, $idusuario){
		$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['nombreEmpresa'];

		$query = "INSERT INTO contactospersonas (empresa,personaContacto,puesto,calle,colonia,ciudad,estado,cp,pais,tlf1,movil,correoElectronico) VALUES ('$idcliente', '$contacto', '$puesto', '$calle', '$colonia', '$ciudad', '$estado', '$cp', '$pais', '$tlf', '$movil', '$correoElectronico')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar el contacto del cliente!";
		}else{
			$informacion["idcliente"] = $idcliente;
			$informacion["respuesta"] = "agregarcontacto";
			$informacion["informacion"] = "El contacto del cliente se guardó correctamente!";

			$descripcionmovimiento = "Se agrego el contacto ".$contacto." al cliente ".$cliente;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);	}

	function agregar_cotizacion($numerocotizacion, $fechacotizacion, $vendedor, $idcliente, $contactocliente, $moneda, $tiempoentrega, $condicionespago, $comentarios, $conexion_usuarios, $idusuario){
		$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['nombreEmpresa'];

		$query = "INSERT INTO cotizacion (ref, cliente, contacto, vendedor, fecha, moneda, TiempoEntrega, CondPago, Otra) VALUES ('$numerocotizacion', '$idcliente', '$contactocliente', '$vendedor', '$fechacotizacion', '$moneda', '$tiempoentrega', '$condicionespago', '$comentarios')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			// $descripcion = "Se creo la cotizacion ".$numerocotizacion;
			// $fechahora = date("Y-m-d G:i:s");
			// $query = "INSERT INTO movimientosusuarios (cotizacion, departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$numerocotizacion', '$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			// $resultado = mysqli_query($conexion_usuarios, $query);
			// if (!$resultado) {
			// 	$informacion["respuesta"] = "ERROR";
			// 	$informacion["informacion"] = "Ocurrió un problema al generar la cotización!";
			// }else{
				$descripcionmovimiento = "Se creo la cotizacion con referencia ".$numeroCotizacion." al cliente ".$cliente;
				$fechamovimiento = date("Y-m-d H:i:s");
				$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
				$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

				$informacion['respuesta'] = "agregarcotizacion";
				$informacion['numero'] = $numerocotizacion;
				echo json_encode($informacion);
			// }
		}
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function editar_informacion($idcontacto, $empresa, $alias, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $clasificacion, $formapago, $metodopago, $cfdi, $conexion_usuarios, $idusuario){
		$query = "UPDATE contactos SET nombreEmpresa = '$empresa', alias = '$alias', RFC = '$rfc', personaContacto = '$contacto', calle = '$calle', NumExt ='$noexterior', NumInt = '$nointerior', colonia = '$colonia', ciudad = '$ciudad', estado = '$estado', cp ='$cp', pais = '$pais', tlf1 ='$tlf1', tlf2 = '$tlf2', movil = '$movil', correoFacturacion1 = '$correofac1', correoFacturacion2 = '$correofac2', correoElectronico ='$correo',  paginaWeb = '$paginaweb', CondPago = '$credito', responsable = '$contactohemusa', moneda = '$moneda', clasificacion = '$clasificacion', IdFormaPago = '$formapago', IdMetodoPago = '$metodopago', IdUsoCFDI = '$cfdi' WHERE id = '$idcontacto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la información del cliente!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del cliente se guardó correctamente!";

			$descripcionmovimiento = "Se modifico la informacion del cliente ".$empresa;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'contactos', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}
 ?>
