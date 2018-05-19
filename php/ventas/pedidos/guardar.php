<?php 
	
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
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
			proveedor($proveedor, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'cantidad':
			$cantidad = $_POST['cantidad'];
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			cantidad($cantidad, $refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'editarpartida':
			$id = $_POST['id'];
			$claveSat = $_POST['claveSat'];
			$noserie = $_POST['noserie'];
			$cantidad = $_POST['cantidad'];
			$fechacompromiso = $_POST['fechacompromiso'];
			$proveedor = $_POST['proveedor'];
			if (isset($_POST['split'])) {
				$split = $_POST['split'];
			}else{
				$split = 0;
			}
			$entregado = $_POST['entregado'];
			editarpartida($id, $claveSat, $noserie, $cantidad, $fechacompromiso, $proveedor, $split, $entregado, $conexion_usuarios);			
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

		case 'packinglist':
			$data = json_decode($_POST['herramienta']);
			packinglist($data, $conexion_usuarios);
			break;

		case 'entregado':
			$data = json_decode($_POST['herramienta']);
			entregado($data, $conexion_usuarios);
			break;
	}

	function packinglist($data, $conexion_usuarios){
		foreach ($data as &$valor) {
			$id = $valor;
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
		$query = "UPDATE cotizacion SET guia='$numeroguia' WHERE ref ='$refCotizacion'";
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

	function paqueteria($paqueteria, $refCotizacion, $numeroPedido, $conexion_usuarios){
		if($paqueteria == "NINGUNA"){
			$paqueteria = "";
		}
		$query = "UPDATE pedidos SET paqueteria='$paqueteria' WHERE cotizacionRef ='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$query = "UPDATE cotizacion SET IdPaqueteria='$paqueteria' WHERE ref ='$refCotizacion'";
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

	function formapago($formapago, $refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM pedidos WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) != 0){
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
		}else{
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
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

	function metodopago($metodopago, $refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM pedidos WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) != 0){
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
		}else{
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
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

	function usocfdi($cfdi, $refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM pedidos WHERE cotizacionRef = '$refCotizacion' AND numeroPedido = '$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) != 0){
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
		}else{
			$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion' AND NoPedClient = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
			}
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

	function proveedor($proveedor, $refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT id FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar partidas!";
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

	function cantidad($cantidad, $refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT id FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar datos de las partidas!";
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

	function guardar_factura($folio, $ordenpedido, $total, $status, $fecha, $cliente, $conexion_usuarios){
		$query = "SELECT * FROM facturas WHERE folio = '$folio'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) == 0){	
			$query = "INSERT INTO facturas (folio, ordenpedido, total, status, fecha, cliente) VALUES ('$folio', '$ordenpedido', '$total', '$status', '$fecha', '$cliente')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$fecha = date("Y-m-d");
			$query = "UPDATE pedidos SET factura = '$folio', facturaFecha = '$fecha' WHERE numeroPedido = '$ordenpedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE cotizacion SET factura = '$folio', facturaFecha = '$fecha' WHERE NoPedClient = '$ordenpedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la factura '".$folio."'!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La factura '".$folio."' se guardó correctamente!";
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

