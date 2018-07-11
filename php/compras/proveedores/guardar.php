<?php
	include("../../conexion.php");
	include("../../sesion.php");

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'agregarproveedor':
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

			$existe = existe_proveedor($rfc, $conexion_usuarios);
			if($existe > 0 ){
				$informacion["respuesta"] = "EXISTE";
				$informacion["informacion"] = "No se pudo registrar la información porque el RFC '".$rfc."' ya existe!";
				echo json_encode($informacion);
			}else{
				agregar_proveedor($nombreEmpresa, $alias, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios);
			}

			break;

		case 'eliminarproveedor':
			$idproveedor = $_POST['idproveedor'];
			eliminarproveedor($idproveedor, $conexion_usuarios);
			break;

		case 'quitarproveedor':
			$id = $_POST['id'];
			$data = json_decode($_POST['herramienta']);
			quitarproveedor($id, $data, $conexion_usuarios);
			break;

		case 'crearordencompra':
			$idproveedor = $_POST['idproveedor'];
			$saludo = $_POST['saludo'];
			if (isset($_POST['otra'])) {
				$iddireccionenvio = $_POST['otra'];
			}else{
				$iddireccionenvio = $_POST['direccionenvio'];
			}
			crearordencompra($idproveedor, $saludo, $iddireccionenvio, $idusuario, $conexion_usuarios);
			break;

		case 'editarinformacion':
			$idcontacto = $_POST['idproveedor'];
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
			$formapago = $_POST['formapago'];
			$metodopago = $_POST['metodopago'];
			$cfdi = $_POST['cfdi'];
			editar_informacion($idcontacto, $empresa, $alias, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $formapago, $metodopago, $cfdi, $conexion_usuarios);
			break;

			default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;

		case 'herramientaenviado':
			$data = json_decode($_POST['herramienta']);
			herramienta_enviado($data, $conexion_usuarios);
			break;

		case 'herramientarecibido':
			$data = json_decode($_POST['herramienta']);
			herramienta_recibido($data, $conexion_usuarios);
			break;

		case 'herramientaquitarenviado':
			$data = json_decode($_POST['herramienta']);
			herramienta_quitar_enviado($data, $conexion_usuarios);
			break;

		case 'herramientaquitarrecibido':
			$data = json_decode($_POST['herramienta']);
			herramienta_quitar_recibido($data, $conexion_usuarios);
			break;

		case 'splitsinrecibido':
			$cantidadsplit = $_POST['cantidadsplit'];
			$idherramienta = $_POST['idherramienta'];
			split_sin_recibido($idherramienta, $cantidadsplit, $conexion_usuarios);
			break;
	}

	function split_sin_recibido($idherramienta, $cantidadsplit, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE id ='$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$fechaCreacion = $data['FechaCreacion'];
			$cliente = $data['cliente'];
			$cotizacionNo = $data['cotizacionNo'];
			$cotizacionRef = $data['cotizacionRef'];
			$marca = $data['marca'];
			$modelo = $data['modelo'];
			$descripcion = $data['descripcion'];
			$precioLista = $data['precioLista'];
			$cantidad = $data['cantidad'];
			$unidad = $data['Unidad'];
			$claveSat = $data['ClaveProductoSAT'];
			$pedido = $data['Pedido'];
			$pedidoFecha = $data['pedidoFecha'];
			$noDePedido = $data['noDePedido'];
			$proveedor = $data['Proveedor'];
			$proveedorFecha = $data['proveedorFecha'];
			$iva = $data['IVA'];
			$moneda = $data['moneda'];
			$referenciaInterna = $data['referencia_interna'];
			$lugarCotizacion = $data['lugar_cotizacion'];
			$tiempoEntrega = $data['Tiempo_Entrega'];
			$flete = ($data['flete'] / 2);
			$proveedorFlete = $data['proveedorFlete'];
			$numeroPedido = $data['numeroPedido'];
			$fechaPedido = $data['fechaPedido'];
			$ordenCompra = $data['ordenCompra'];
		}

		$split = $cantidad - $cantidadsplit;

		$query = "INSERT INTO cotizacionherramientas (FechaCreacion, cliente, cotizacionNo, cotizacionRef, marca, modelo, descripcion, precioLista, cantidad, Unidad, ClaveProductoSAT, Pedido, pedidoFecha, noDePedido, Proveedor, proveedorFecha, IVA, moneda, referencia_interna, lugar_cotizacion, Tiempo_Entrega, flete, proveedorFlete, numeroPedido, fechaPedido, ordenCompra) VALUES ('$fechaCreacion', '$cliente', '$cotizacionNo', '$cotizacionRef', '$marca', '$modelo', '$descripcion', '$precioLista', '$cantidadsplit', '$unidad', '$claveSat', '$pedido', '$pedidoFecha', '$noDePedido', '$proveedor', '$proveedorFecha', '$iva', '$moneda', '$referenciaInterna', '$lugarCotizacion', '$tiempoEntrega', '$flete', '$proveedorFlete', '$numeroPedido', '$fechaPedido', '$ordenCompra')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar aplicar el split 1 a la partida!";
		}else{
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al intentar aplicar el split 2 a la partida!";
			}else{
				$query = "UPDATE cotizacionherramientas SET cantidad = '$split' WHERE id='$idherramienta'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al intentar aplicar el split 3 a la partida!";
				}else{
					$query = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas ='$idherramienta'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					while($data = mysqli_fetch_assoc($resultado)){
						$id = $data['id'];
						$idCotizacionHerramientas = $data['id_cotizacion_herramientas'];
						$ordenCompra = $data['orden_compra'];
						$fechaOrdenCompra = $data['fecha_orden_compra'];
						$proveedor = $data['proveedor'];
						$entrada = $data['entrada'];
						$monedaPedido = $data['moneda_pedido'];
						$cliente = $data['cliente'];
						$marca = $data['marca'];
						$modelo = $data['modelo'];
						$cantidad = $data['cantidad'];
						$descripcion = $data['descripcion'];
						$tipoCambio = $data['tipo_cambio'];
						$costoMXN = $data['costo_mn'];
						$costoUSD = $data['costo_usd'];
						$ventaMXN = $data['venta_mn'];
						$ventaUSD = $data['venta_usd'];
						$utilidad = $data['utilidad'];
						$nombreCliente = $data['nombre_cliente'];
						$nombreProveedor = $data['nombre_proveedor'];
					}

					$split = $cantidad - $cantidadsplit;

					$query = "INSERT INTO utilidad_pedido (id_cotizacion_herramientas, orden_compra, fecha_orden_compra, proveedor, entrada, moneda_pedido, cliente, marca, modelo, cantidad, descripcion, tipo_cambio, costo_mn, costo_usd, venta_mn, venta_usd, utilidad, nombre_cliente, nombre_proveedor) VALUES ('$idCotizacionHerramientas', '$ordenCompra', '$fechaOrdenCompra', '$proveedor', '$entrada', '$monedaPedido', '$cliente', '$marca', '$modelo', '$cantidadsplit', '$descripcion', '$tipoCambio', '$costoMXN', '$costoUSD', '$ventaMXN', '$ventaUSD', '$utilidad', '$nombreCliente', '$nombreProveedor')";
					$resultado = mysqli_query($conexion_usuarios, $query);

					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al intentar aplicar el split 4 a la partida!";
					}else{
						$query = "UPDATE utilidad_pedido SET cantidad = '$split' WHERE id='$id'";
						$resultado = mysqli_query($conexion_usuarios, $query);

						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar aplicar el split 5 a la partida!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "El split se aplicó correctamente a la partida!";
						}
					}
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function herramienta_enviado($data, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;

			$query = "UPDATE cotizacionherramientas SET enviadoFecha = '$fecha' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_enviado = '$fecha' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la(s) partida(s)!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de la(s) partida(s) se cambio a 'Enviado' correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function herramienta_recibido($data, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;

			$query = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data2 = mysqli_fetch_assoc($resultado)){
				$marca = $data2['marca'];
				$modelo = $data2['modelo'];
				$cantidadaumentar = $data2['cantidad'];
			}

			$query = "SELECT enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data3 = mysqli_fetch_assoc($resultado)){
				$cantidad = $data3['enReserva'];
			}

			$cantidadstock = $cantidad + $cantidadaumentar;

			$query = "UPDATE cotizacionherramientas SET recibidoFecha = '$fecha' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_llegada = '$fecha' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE productos SET enReserva = '$cantidadstock' WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la(s) partida(s)!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de la(s) partida(s) se cambio a 'Recibido' y se aumento el stock correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function herramienta_quitar_enviado($data, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;
			$query = "UPDATE cotizacionherramientas SET enviadoFecha = '0000-00-00' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_enviado = '0000-00-00' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la(s) partida(s)!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de la(s) partida(s) se cambio a 'Sin Enviar' correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function herramienta_quitar_recibido($data,$conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;

			$query = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$cantidadquitar = $data['cantidad'];
			}

			$query = "SELECT enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$cantidad = $data['enReserva'];
			}

			$cantidadstock = $cantidad - $cantidadquitar;

			$query = "UPDATE cotizacionherramientas SET recibidoFecha = '0000-00-00' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_llegada = '0000-00-00' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE productos SET enReserva = '$cantidadstock' WHERE marca = '$marca' AND ref = '$modelo'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el estado de la(s) partida(s)!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El estado de la(s) partida(s) se cambio a 'Sin Recibido' y se quitó de el stock correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function existe_proveedor($rfc, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE RFC = '$rfc' AND tipo = 'Proveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existeproveedor = mysqli_num_rows( $resultado );
		return $existeproveedor;
	}

	function agregar_proveedor($nombreEmpresa, $alias, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios){
		$query = "INSERT INTO contactos (nombreEmpresa, alias, calle, NumInt, NumExt, ciudad, estado, cp, pais, tlf1, tlf2, correoElectronico, paginaWeb, RFC, colonia, tipo, moneda) VALUES ('$nombreEmpresa', '$alias', '$calle', '$numInterior', '$numExterior', '$ciudad', '$estado', '$cp', '$pais', '$tlf1', '$tlf2', '$correoElectronico', '$paginaWeb', '$rfc', '$colonia', 'Proveedor', '$moneda')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al registrar la información del proveedor '".$nombreEmpresa."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del proveedor '".$nombreEmpresa."' se guardó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function eliminarproveedor($idproveedor, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$nombreEmpresa = $data['nombreEmpresa'];
		}

		$query = "DELETE FROM contactos WHERE id = $idproveedor";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al eliminar el proveedor '".$nombreEmpresa."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se eliminó el proveedor '".$nombreEmpresa."' correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function quitarproveedor($id, $data, $conexion_usuarios){
		foreach ($data as &$id) {
			$query = "UPDATE cotizacionherramientas SET Proveedor = 'None' WHERE id='$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar quitar la herramienta del proveedor!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La herramienta se quitó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function crearordencompra($idproveedor, $saludo, $iddireccionenvio, $idusario, $conexion_usuarios){
		$query = "SELECT nombreEmpresa, moneda FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$proveedor = strtoupper($data['nombreEmpresa']);
			$monedaproveedor = $data['moneda'];
		}

	   	$query = "SELECT noDePedido FROM ordendecompras ORDER BY id DESC LIMIT 1";
     	$resultado = mysqli_query($conexion_usuarios, $query);

     	while($data = mysqli_fetch_array($resultado)){
     		$ultimaOC = $data['noDePedido'];
     	}

     	$ultimaOC = str_replace("OC", "", $ultimaOC);
     	$ultimaOC = $ultimaOC + 1;
     	$numeroOC = "OC".$ultimaOC;

     	$query = "UPDATE cotizacionherramientas SET ordenCompra = '$numeroOC', noDePedido = '$numeroOC' WHERE Pedido= 'si' AND ordenCompra = '' AND noDePedido = '' AND Proveedor LIKE '%$proveedor%'";
     	$resultado = mysqli_query($conexion_usuarios, $query);
     	if(!$resultado){
     		verificar_resultado($resultado);
     	}else{
     		$query = "SELECT address FROM envia_a WHERE id = '$iddireccionenvio'";
     		$resultado = mysqli_query($conexion_usuarios, $query);

     		if (!$resultado) {
     			verificar_resultado($resultado);
     		}else{
	     		while($data = mysqli_fetch_array($resultado)){
	     			$direccionenvio = $data['address'];
	     		}
	     		$fecha = date("Y").'-'.date("m").'-'.date("d");
	     		$query = "INSERT INTO ordendecompras (nodePedido, fecha, proveedor, contacto, texto, envia_a, moneda) VALUES ('$numeroOC', '$fecha', '$idproveedor', '$idusario', '$saludo', '$direccionenvio', '$monedaproveedor')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if(!$resultado){
					verificar_resultado($resultado);
				}else{
					$query = "SELECT * FROM cotizacionherramientas WHERE noDePedido = '$numeroOC'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					while($data = mysqli_fetch_assoc($resultado)){
						$id = $data['id'];
						$ordencompra = $data['noDePedido'];
						$moneda = $data['moneda'];
						$cliente = $data['cliente'];
						$marca = $data['marca'];
						$modelo = $data['modelo'];
						$cantidad = $data['cantidad'];
						$descripcion = $data['descripcion'];
						$precioventa = $data['precioLista'];

						$query2 = "SELECT * FROM ordendecompras WHERE noDePedido = '$numeroOC'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
						while($data2 = mysqli_fetch_assoc($resultado2)){
							$fechaordencompra = $data2['fecha'];
							$proveedor = $data2['proveedor'];
						}

						$query3 = "SELECT * FROM tipocambio WHERE fecha = '$fechaordencompra'";
						$resultado3 = mysqli_query($conexion_usuarios, $query3);
						while($data3 = mysqli_fetch_assoc($resultado3)){
							$tipocambio = $data3['tipocambio'];
						}

						$queryprecio = "SELECT precioBase, enReserva, marca, moneda FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
						$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);

						if(mysqli_num_rows($resultadoprecio) > 0){
							while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
								$precioLista = $dataprecio['precioBase'];
								$almacen = $dataprecio['enReserva'];
								$marca = $dataprecio['marca'];
								$monedaproducto = $dataprecio['moneda'];
							}
						}else{
							$precioLista = $data['precioLista'];
							$almacen = 0;
							$marca = $data['marca'];
							$monedaproducto = $data['moneda'];
						}

						$query4 = "SELECT * FROM factorescosto WHERE proveedor ='$idproveedor'";
						$resultado4 = mysqli_query($conexion_usuarios, $query4);
						if(!$resultado4){
							die("ERROR EN FACTORES");
							$precioProveedor = $precioLista;
						}else{
							$precioProveedor = $precioLista;
							while($datafactor = mysqli_fetch_assoc($resultado4)){
								$precioProveedor = $precioProveedor * $datafactor['factor_proveedor'];
							}
						}

						if($moneda == "mxn" && $monedaproducto == "mxn"){
							$costo_mn = $precioProveedor;
							$costo_usd = $precioProveedor / $tipocambio;
							$venta_mn = $precioventa;
							$venta_usd = $precioventa / $tipocambio;
						}
						if($moneda == "mxn" && $monedaproducto == "usd"){
							$costo_mn = $precioProveedor * $tipocambio;
							$costo_usd = $precioProveedor;
							$venta_mn = $precioventa;
							$venta_usd = $precioventa / $tipocambio;
						}
						if($moneda == "usd" && $monedaproducto == "usd"){
							$costo_mn = $precioProveedor * $tipocambio;
							$costo_usd = $precioProveedor;
							$venta_mn = $precioventa * $tipocambio;
							$venta_usd = $precioventa;
						}
						if($moneda == "usd" && $monedaproducto == "mxn"){
							$costo_mn = $precioProveedor;
							$costo_usd = $precioProveedor / $tipocambio;
							$venta_mn = $precioventa * $tipocambio;
							$venta_usd = $precioventa;
						}

						$query5 = "SELECT nombreEmpresa FROM contactos WHERE id ='$cliente'";
						$resultado5 = mysqli_query($conexion_usuarios, $query5);
						while($data5 = mysqli_fetch_assoc($resultado5)){
							$nombrecliente = $data5['nombreEmpresa'];
						}

						$query6 = "SELECT nombreEmpresa FROM contactos WHERE id ='$proveedor'";
						$resultado6 = mysqli_query($conexion_usuarios, $query6);
						while($data6 = mysqli_fetch_assoc($resultado6)){
							$nombreproveedor = $data6['nombreEmpresa'];
						}

						$query7 = "INSERT INTO utilidad_pedido (id_cotizacion_herramientas, orden_compra, fecha_orden_compra, proveedor, moneda_pedido, cliente, marca, modelo, cantidad, descripcion, tipo_cambio, costo_mn, costo_usd, venta_mn, venta_usd, nombre_cliente, nombre_proveedor) VALUES ('$id', '$ordencompra', '$fechaordencompra', '$proveedor', '$moneda', '$cliente', '$marca', '$modelo', '$cantidad', '$descripcion', '$tipocambio', '$costo_mn', '$costo_usd', '$venta_mn', '$venta_usd', '$nombrecliente', '$nombreproveedor')";
						$resultado7 = mysqli_query($conexion_usuarios, $query7);
					}
				}
     		}
		 }

		$informacion['respuesta'] = "agregarordencompra";
		$informacion['ordencompra'] = $numeroOC;
		$informacion['nombreEmpresa'] = $proveedor;
   	echo json_encode($informacion);
   	mysqli_close($conexion_usuarios);
	}

	function editar_informacion($idcontacto, $empresa, $alias, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $formapago, $metodopago, $cfdi, $conexion_usuarios){
		$query = "UPDATE contactos SET nombreEmpresa = '$empresa', alias = '$alias', RFC = '$rfc', personaContacto = '$contacto', calle = '$calle', NumExt ='$nointerior', NumInt = '$nointerior', colonia = '$colonia', ciudad = '$ciudad', estado = '$estado', cp ='$cp', pais = '$pais', tlf1 ='$tlf1', tlf2 = '$tlf2', movil = '$movil', correoFacturacion1 = '$correofac1', correoFacturacion2 = '$correofac2', correoElectronico ='$correo',  paginaWeb = '$paginaweb', CondPago = '$credito', responsable = '$contactohemusa', moneda = '$moneda', IdFormaPago = '$formapago', IdMetodoPago = '$metodopago', IdUsoCFDI = '$cfdi' WHERE id = '$idcontacto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información del proveedor!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del proveedor se modificó correctamente!";
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
