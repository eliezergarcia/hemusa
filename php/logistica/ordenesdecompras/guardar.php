<?php
	include('../../conexion.php');
	// error_reporting(0


	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'duplicar':
			$cantidad = $_POST['cantidad'];
			$idherramienta = $_POST['idherramienta'];
			$cantduplicar = $_POST['cantduplicar'];
			duplicar($idherramienta, $cantduplicar, $cantidad, $conexion_usuarios);
			break;

		case 'flete':
			$flete = $_POST['flete'];
			$ordencompra = $_POST['ordencompra'];
			flete($flete, $ordencompra, $conexion_usuarios);
			break;

		case 'actualizar':
			$ordencompra = $_POST['ordencompra'];
			$pedimento = $_POST['pedimento'];
			$folio = $_POST['folio'];
			// $facturaproveedor = $_POST['facturaproveedor'];
			// $entrada = $_POST['entrada'];
			$datapartidas = json_decode($_POST['herramienta']);
			actualizar($ordencompra, $pedimento, $folio, $datapartidas, $conexion_usuarios);
			break;

		case 'editarpartidadescripcion':
			$idpartida = $_POST['idpartida'];
			$ordencompra = $_POST['ordencompra'];
			$pedimento = $_POST['pedimento'];
			$folio = $_POST['folio'];
			$facturaproveedor = $_POST['facturaproveedor'];
			$entrada = $_POST['entrada'];
			editar_partida_descripcion($idpartida, $ordencompra, $pedimento, $folio, $facturaproveedor, $entrada, $conexion_usuarios);
			break;

		case 'editarpartida':
			$idherramienta  = $_POST['idherramienta'];
			$precioUnitario = $_POST['precioUnitario'];
			$fechaCompromiso = $_POST['fechaCompromiso'];
			editar_partida($idherramienta, $precioUnitario, $fechaCompromiso, $conexion_usuarios);
			break;

		case 'cambiarMoneda':
			$ordenCompra = $_POST['ordenCompra'];
			cambiar_moneda($ordenCompra, $conexion_usuarios);
			break;

		case 'crearordencompra':
			$proveedor  = $_POST['proveedor'];
			$saludo = $_POST['saludo'];
			$direccionenvio = $_POST['direccionenvio'];
			crear_orden_compra($proveedor, $saludo, $direccionenvio, $conexion_usuarios);
			break;
	}

	function duplicar($idherramienta, $cantduplicar, $cantidad, $conexion_usuarios){
		if ($cantduplicar == $cantidad) {
			$query = "UPDATE utilidad_pedido SET cliente = '611', nombre_cliente = 'ALMACEN' WHERE id = '$idherramienta'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al intentar mover la herramienta a Almacen!";
			}else{
				$query = "SELECT * FROM utilidad_pedido WHERE id = '$idherramienta'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				while($data = mysqli_fetch_assoc($resultado)){
					$marca = $data['marca'];
					$modelo = $data['modelo'];
				}

				$query = "SELECT * FROM productos WHERE marca ='$marca' AND ref ='$modelo'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				while($data = mysqli_fetch_assoc($resultado)){
					$stock = $data['enReserva'];
				}

				$stock = $stock + $cantduplicar;

				$query = "UPDATE productos SET enReserva='$stock' WHERE marca ='$marca' AND ref ='$modelo'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al aumentar el stock de la herramienta!";
				}else{
					$informacion["respuesta"] = "BIEN";
					$informacion["informacion"] = "La herramienta se movió al Almacen y se modificó el stock correctamente!";
				}
			}
		}else{
			$query = "SELECT * FROM utilidad_pedido WHERE id ='$idherramienta'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				$id = $data['id'];
				$idCotizacionHerramientas = $data['id_cotizacion_herramientas'];
				$ordenCompra = $data['orden_compra'];
				$fechaOrdenCompra = $data['fecha_orden_compra'];
				$proveedor = $data['proveedor'];
				$entrada = $data['entrada'];
				$monedaPedido = $data['moneda_pedido'];
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$cantidad = $data['cantidad'];
				$descripcion = $data['descripcion'];
				$tipoCambio = $data['tipo_cambio'];
				$costoMXN = $data['costo_mn'];
				$costoUSD = $data['costo_usd'];
				$ventaMXN = $data['venta_mn'];
				$ventaUSD = $data['venta_usd'];
				$fechaLlegada = $data['fecha_llegada'];
				$fechaEnviado = $data['fecha_enviado'];
				$utilidad = $data['utilidad'];
				$nombreProveedor = $data['nombre_proveedor'];
			}

			$query = "INSERT INTO utilidad_pedido (id_cotizacion_herramientas, orden_compra, fecha_orden_compra, proveedor, entrada, moneda_pedido, cliente, marca, modelo, cantidad, descripcion, tipo_cambio, costo_mn, costo_usd, venta_mn, venta_usd, fecha_llegada, fecha_enviado, utilidad, nombre_cliente, nombre_proveedor) VALUES ('$idCotizacionHerramientas', '$ordenCompra', '$fechaOrdenCompra', '$proveedor', '$entrada', '$monedaPedido', '611', '$marca', '$modelo', '$cantduplicar', '$descripcion', '$tipoCambio', '$costoMXN', '$costoUSD', '$ventaMXN', '$ventaUSD', '$fechaLlegada', '$fecha_enviado', '$utilidad', 'ALMACEN', '$nombreProveedor')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al intentar mover la herramienta a Almacen!";
			}else{
				$cantidad = $cantidad - $cantduplicar;
				$query = "UPDATE utilidad_pedido SET cantidad = '$cantidad' WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al intentar modificar la cantidad de la partida!";
				}else{
					$query = "SELECT * FROM productos WHERE marca ='$marca' AND ref ='$modelo'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					while($data = mysqli_fetch_assoc($resultado)){
						$stock = $data['enReserva'];
					}

					$stock = $stock + $cantduplicar;

					$query = "UPDATE productos SET enReserva='$stock' WHERE marca ='$marca' AND ref ='$modelo'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al aumentar el stock de la herramienta!";
					}else{
						$informacion["respuesta"] = "BIEN";
						$informacion["informacion"] = "La herramienta se movió al Almacen y se modificó el stock correctamente!";
					}
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_moneda($ordenCompra, $conexion_usuarios){
		$query = "SELECT moneda FROM ordendecompras WHERE noDePedido = '$ordenCompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar la moneda de la Orden de compra!";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$monedaorden = $data['moneda'];
			}

			if($monedaorden == "usd"){
				$moneda = "mxn";
			}else{
				$moneda = "usd";
			}

			$query = "UPDATE utilidad_pedido SET moneda_pedido ='$moneda' WHERE orden_compra='$ordenCompra'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE ordendecompras SET moneda ='$moneda' WHERE noDePedido='$ordenCompra'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";
			}
		}
		echo json_encode($informacion);
    mysqli_close($conexion_usuarios);
	}

	function crear_orden_compra($proveedor, $saludo, $iddireccionenvio, $conexion_usuarios){
		$query = "SELECT id,moneda FROM contactos WHERE nombreEmpresa LIKE '%$proveedor%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idproveedor = $data['id'];
			$monedaproveedor = $data['moneda'];
			$proveedor = strtoupper($proveedor);
		}

	   	$query = "SELECT noDePedido FROM ordendecompras ORDER BY id DESC LIMIT 1";
     	$resultado = mysqli_query($conexion_usuarios, $query);

     	while($data = mysqli_fetch_array($resultado)){
     		$ultimaOC = $data['noDePedido'];
     	}

     	$ultimaOC = str_replace("OC", "", $ultimaOC);
     	$ultimaOC = $ultimaOC + 1;
     	$numeroOC = "OC".$ultimaOC;

     	$query = "UPDATE cotizacionherramientas SET ordenCompra = '$numeroOC', noDePedido = '$numeroOC' WHERE (Pedido= 'si' AND ordenCompra = '' AND noDePedido = '' AND Proveedor LIKE '%$proveedor%') OR (Pedido= 'si' AND ordenCompra = '' AND noDePedido = '' AND Proveedor = '$idproveedor')";
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
	     		$query = "INSERT INTO ordendecompras (nodePedido, fecha, proveedor, texto, envia_a, moneda) VALUES ('$numeroOC', '$fecha', '$idproveedor', '$saludo', '$direccionenvio', '$monedaproveedor')";
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

						$query4 = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
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

						if($monedaproducto == "mxn"){
							$costo_mn = $precioProveedor;
							$venta_mn = $precioventa;
							$costo_usd = $precioProveedor / $tipocambio;
							$venta_usd = $precioventa / $tipocambio;
						}else{
							$costo_mn = $precioProveedor * $tipocambio;
							$venta_mn = $precioventa * $tipocambio;
							$costo_usd = $precioProveedor;
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
    echo json_encode($informacion);
    mysqli_close($conexion_usuarios);
	}

	function flete($flete, $ordencompra, $conexion_usuarios){
		$query = "UPDATE ordendecompras SET flete = '$flete' WHERE noDePedido = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la información del flete!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El flete se guardó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function actualizar($ordencompra, $pedimento, $folio, $datapartidas, $conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($datapartidas as &$valor) {
			$id = $valor;
			$query = "UPDATE cotizacionherramientas SET FechaPedimento = '$fecha', Pedimento = '$pedimento', foliopedimento = '$folio' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET Pedimento = '$pedimento', folio = '$folio' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar guardar la información del pedido!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información se guardó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_partida_descripcion($idpartida, $ordencompra, $pedimento, $folio, $facturaproveedor, $entrada, $conexion_usuarios){
		$query = "SELECT * FROM utilidad_pedido WHERE id ='$idpartida'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcotherramientas = $data['id_cotizacion_herramientas'];
		}

		$query = "UPDATE cotizacionherramientas SET FechaPedimento = '$fecha', Pedimento = '$pedimento', foliopedimento = '$folio', facturaproveedor = '$facturaproveedor', entrada = '$entrada' WHERE id = '$idcotherramientas'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacionherramientas SET FechaPedimento = '$fecha', Pedimento = '$pedimento', foliopedimento = '$folio', facturaproveedor = '$facturaproveedor', entrada = '$entrada' WHERE id = '$idcotherramientas'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE utilidad_pedido SET Pedimento = '$pedimento', folio = '$folio', factura_proveedor = '$facturaproveedor', entrada = '$entrada' WHERE id = '$idpartida'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la partida!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "la información de la partida se modificó correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_partida($idherramienta, $precioUnitario, $fechaCompromiso, $conexion_usuarios){
		$query = "SELECT * FROM utilidad_pedido WHERE id = '$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$moneda = $data['moneda_pedido'];
			$id = $data['id_cotizacion_herramientas'];
			$fecha = $data['fecha_orden_compra'];
		}

		$query = "SELECT * FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tipocambio = $data['tipocambio'];
		}

		if($moneda == "usd"){
			$costousd = $precioUnitario;
			$costomxn = $precioUnitario * $tipocambio;
		}else{
			$costomxn = $precioUnitario;
			$costousd = $precioUnitario / $tipocambio;
		}

		$query = "UPDATE cotizacionherramientas SET fechaCompromiso = '$fechaCompromiso' WHERE id ='$id'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE utilidad_pedido SET costo_mn = '$costomxn', costo_usd = '$costousd' WHERE id ='$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información de la partida!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información de la partida se modificó correctamente!";
		}

		echo json_encode($informacion);
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
 ?>
