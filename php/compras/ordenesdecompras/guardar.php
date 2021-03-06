<?php 
	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'flete':
			$flete = $_POST['flete'];
			$ordencompra = $_POST['ordencompra'];
			flete($flete, $ordencompra, $conexion_usuarios);
			break;

		case 'actualizar':
			$ordencompra = $_POST['ordencompra'];
			$pedimento = $_POST['pedimento'];
			$folio = $_POST['folio'];
			$facturaproveedor = $_POST['facturaproveedor'];
			$entrada = $_POST['entrada'];
			actualizar($ordencompra, $pedimento, $folio, $facturaproveedor, $entrada, $conexion_usuarios);
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

		case 'crearordencompra':
			$proveedor  = $_POST['proveedor'];
			$saludo = $_POST['saludo'];
			$direccionenvio = $_POST['direccionenvio'];			
			crear_orden_compra($proveedor, $saludo, $direccionenvio, $conexion_usuarios);
			break;
	}

	function crear_orden_compra($proveedor, $saludo, $iddireccionenvio, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE nombreEmpresa LIKE '%$proveedor%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idproveedor = $data['id'];
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
	     		$query = "INSERT INTO ordendecompras (nodePedido, fecha, proveedor, texto, envia_a) VALUES ('$numeroOC', '$fecha', '$idproveedor', '$saludo', '$direccionenvio')";
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
		verificar_resultado($resultado);
		mysqli_close($conexion_usuarios);
	}

	function actualizar($ordencompra, $pedimento, $folio, $facturaproveedor, $entrada, $conexion_usuarios){
		$fecha = date("Y-m-d");
		$query = "UPDATE cotizacionherramientas SET FechaPedimento = '$fecha', Pedimento = '$pedimento', foliopedimento = '$folio', facturaproveedor = '$facturaproveedor', entrada = '$entrada' WHERE noDePedido = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		
		$query = "UPDATE cotizacionherramientas SET FechaPedimento = '$fecha', Pedimento = '$pedimento', foliopedimento = '$folio', facturaproveedor = '$facturaproveedor', entrada = '$entrada' WHERE ordenCompra = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE utilidad_pedido SET Pedimento = '$pedimento', folio = '$folio', factura_proveedor = '$facturaproveedor', entrada = '$entrada' WHERE orden_compra = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		verificar_resultado($resultado);
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

		verificar_resultado($resultado);
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

		verificar_resultado($resultado);
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