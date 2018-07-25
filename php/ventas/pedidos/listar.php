<?php

	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'noentregado':
			$buscar = $_POST['buscar'];
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			if ($filtromes != "todo") {
				$fechainicio = $filtroano.'-'.$filtromes.'-01';
				$fechafin = $filtroano.'-'.$filtromes.'-31';
			}else{
				$fechainicio = $filtroano.'-01-01';
				$fechafin = $filtroano.'-12-31';
			}
			$filtrotipo = $_POST['filtrotipo'];
			noentregado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios);
			break;

		case 'sinproveedor':
			$buscar = $_POST['buscar'];
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			if ($filtromes != "todo") {
				$fechainicio = $filtroano.'-'.$filtromes.'-01';
				$fechafin = $filtroano.'-'.$filtromes.'-31';
			}else{
				$fechainicio = $filtroano.'-01-01';
				$fechafin = $filtroano.'-12-31';
			}
			$filtrotipo = $_POST['filtrotipo'];
			sinproveedor($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios);
			break;

		case 'facturadonopagado':
			$buscar = $_POST['buscar'];
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			if ($filtromes != "todo") {
				$fechainicio = $filtroano.'-'.$filtromes.'-01';
				$fechafin = $filtroano.'-'.$filtromes.'-31';
			}else{
				$fechainicio = $filtroano.'-01-01';
				$fechafin = $filtroano.'-12-31';
			}
			$filtrotipo = $_POST['filtrotipo'];
			facturadonopagado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios);
			break;

		case 'terminado':
			$buscar = $_POST['buscar'];
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			if ($filtromes != "todo") {
				$fechainicio = $filtroano.'-'.$filtromes.'-01';
				$fechafin = $filtroano.'-'.$filtromes.'-31';
			}else{
				$fechainicio = $filtroano.'-01-01';
				$fechafin = $filtroano.'-12-31';
			}
			$filtrotipo = $_POST['filtrotipo'];
			terminado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios);
			break;

		case 'listarpartidas':
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			partidas($refCotizacion, $numeroPedido, $conexion_usuarios);
			break;

		case 'devolucion':
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			devolucion($refCotizacion, $numeroPedido, $conexion_usuarios);
	}

	function sinproveedor($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios){
		if ($filtrotipo == "pedido") {
			$query = "SELECT DISTINCT cotizacionRef FROM cotizacionherramientas WHERE Pedido = 'si' AND pedidoFecha != '0000-00-00' AND Proveedor = 'None' AND pedidoFecha >= '$fechainicio' AND pedidoFecha <= '$fechafin'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (mysqli_num_rows($resultado) < 1) {
				$arreglo["data"] = 0;
			}else{
				while($data1 = mysqli_fetch_assoc($resultado)){
					$cotizacionRef = $data1['cotizacionRef'];
					$marca = $data1['marca'];
					$modelo = $data1['modelo'];
					$descripcion = $data1['descripcion'];
					$precioUnitario = $data1['precioLista'];

					$querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%' OR precioTotal LIKE '%$buscar%') AND cotizacion.ref = '$cotizacionRef' ORDER BY fecha";
					$rescotizacion = mysqli_query($conexion_usuarios, $querycotizacion);


					while($data = mysqli_fetch_assoc($rescotizacion)){
						if($data['numeroPedido'] == ""){
							$pedido = $data['NoPedClient'];
						}else{
							$pedido = $data['numeroPedido'];
						}
						$arreglo['data'][] = array(
							'cotizacionRef' => $data['ref'],
							'numeroPedido' => $pedido,
							'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
							'contacto' => $data['contacto'],
							'vendedor' => $data['vendedor'],
							'fecha' => $data['Pedido'],
							'partidas' => $data['partidaCantidad'],
							'total' => "$ ".$data['precioTotal'],
							'marca' => $marca,
							'modelo' => $modelo,
							'descripcion' => utf8_encode($descripcion),
							'precioUnitario' => " $".$precioUnitario,
						);
					}
				}
			}
		}else{
			$query = "SELECT cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista, cotizacion.ref, cotizacion.NoPedClient, cotizacion.cliente, cotizacion.vendedor, cotizacion.contacto, cotizacion.Pedido, cotizacion.partidaCantidad, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref=cotizacionherramientas.cotizacionRef INNER JOIN contactos ON contactos.id=cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR cotizacion.NoPedClient LIKE '%$buscar%' OR contactos.nombreEmpresa LIKE '%$buscar%' OR cotizacion.vendedor LIKE '%$buscar%' OR cotizacion.contacto LIKE '%$buscar%' OR cotizacionherramientas.marca LIKE '%$buscar%' OR cotizacionherramientas.modelo LIKE '%$buscar%' OR cotizacionherramientas.descripcion LIKE '%$buscar%' OR cotizacionherramientas.precioLista LIKE '%$buscar%') AND cotizacionherramientas.Pedido = 'si' AND cotizacionherramientas.pedidoFecha != '0000-00-00' AND cotizacionherramientas.Proveedor = 'None' AND cotizacionherramientas.pedidoFecha >= '$fechainicio' AND cotizacionherramientas.pedidoFecha <= '$fechafin'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}
					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $pedido,
						'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['Pedido'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal'],
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => " $".$data['precioLista'],
					);
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function noentregado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios){
		if ($filtrotipo == "pedido") {
			$query = "SELECT DISTINCT cotizacionRef FROM cotizacionherramientas WHERE Pedido = 'si' AND pedidoFecha != '0000-00-00' AND Proveedor != 'None' AND Entregado ='0000-00-00' AND factura = 0 AND remision = 0 AND pedidoFecha >= '$fechainicio' AND pedidoFecha <= '$fechafin'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo["data"] = 0;
			}else{
				while($data1 = mysqli_fetch_assoc($resultado)){
					$cotizacionRef = $data1['cotizacionRef'];
					$marca = $data1['marca'];
					$modelo = $data1['modelo'];
					$descripcion = $data1['descripcion'];
					$precioUnitario = $data1['precioLista'];

					$querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%' OR precioTotal LIKE '%$buscar%') AND cotizacion.ref = '$cotizacionRef'";
					$rescotizacion = mysqli_query($conexion_usuarios, $querycotizacion);

					while($data = mysqli_fetch_assoc($rescotizacion)){
						if($data['numeroPedido'] == ""){
							$pedido = $data['NoPedClient'];
						}else{
							$pedido = $data['numeroPedido'];
						}
						$arreglo['data'][] = array(
							'cotizacionRef' => $data['ref'],
							'numeroPedido' => $pedido,
							'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
							'contacto' => $data['contacto'],
							'vendedor' => $data['vendedor'],
							'fecha' => $data['Pedido'],
							'partidas' => $data['partidaCantidad'],
							'total' => "$ ".$data['precioTotal'],
							'marca' => $marca,
							'modelo' => $modelo,
							'descripcion' => utf8_encode($descripcion),
							'precioUnitario' => " $".$precioUnitario,
						);
					}
				}
			}
		}else{
			$query = "SELECT cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista, cotizacion.ref, cotizacion.NoPedClient, cotizacion.cliente, cotizacion.vendedor, cotizacion.contacto, cotizacion.Pedido, cotizacion.partidaCantidad, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref=cotizacionherramientas.cotizacionRef INNER JOIN contactos ON contactos.id=cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR cotizacion.NoPedClient LIKE '%$buscar%' OR contactos.nombreEmpresa LIKE '%$buscar%' OR cotizacion.vendedor LIKE '%$buscar%' OR cotizacion.contacto LIKE '%$buscar%' OR cotizacionherramientas.marca LIKE '%$buscar%' OR cotizacionherramientas.modelo LIKE '%$buscar%' OR cotizacionherramientas.descripcion LIKE '%$buscar%' OR cotizacionherramientas.precioLista LIKE '%$buscar%') AND cotizacionherramientas.Pedido = 'si' AND cotizacionherramientas.pedidoFecha != '0000-00-00' AND cotizacionherramientas.Proveedor != 'None' AND cotizacionherramientas.Entregado ='0000-00-00' AND cotizacionherramientas.factura = 0 AND cotizacionherramientas.remision = 0 AND cotizacionherramientas.pedidoFecha >= '$fechainicio' AND cotizacionherramientas.pedidoFecha <= '$fechafin'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}
					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $pedido,
						'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['Pedido'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal'],
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => " $".$data['precioLista'],
					);
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function facturadonopagado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios){
		if ($filtrotipo == "pedido") {
			$query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id=cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR cotizacion.NoPedClient LIKE '%$buscar%') AND cotizacion.factura != 0 AND cotizacion.facturaFecha != '0000-00-00' AND (cotizacion.Pagado < 1.14 * cotizacion.precioTotal) AND (cotizacion.fecha >= '$fechainicio' AND cotizacion.fecha <= '$fechafin') ORDER BY fecha";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = "";
					$modelo = "";
					$descripcion = "";
					$precioUnitario = "";

					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}

					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $pedido,
						'nombreEmpresa' => $data['nombreEmpresa'],
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['fecha'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal'],
						'marca' => $marca,
						'modelo' => $modelo,
						'descripcion' => utf8_encode($descripcion),
						'precioUnitario' => " $".$precioUnitario,
					);
				}
			}

			$query = "SELECT facturas.*, pedidos.cotizacionRef, pedidos.contacto, pedidos.vendedor, pedidos.partidas FROM facturas LEFT JOIN pedidos ON pedidos.numeroPedido = facturas.ordenpedido WHERE (pedidos.cotizacionRef LIKE '%$buscar%' OR facturas.ordenpedido LIKE '%$buscar%' OR facturas.cliente LIKE '%$buscar%' OR pedidos.contacto LIKE '%$buscar%' OR pedidos.vendedor LIKE '%$buscar%' OR facturas.fecha LIKE '%$buscar%' OR facturas.total LIKE '%$buscar%') AND (facturas.pagado < 1.14 * facturas.total) AND (facturas.fecha >= '$fechainicio' AND facturas.fecha <= '$fechafin') ORDER BY fecha";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = "";
					$modelo = "";
					$descripcion = "";
					$precioUnitario = "";

					$arreglo['data'][] = array(
						'cotizacionRef' => $data['cotizacionRef'],
						'numeroPedido' => $data['ordenpedido'],
						'nombreEmpresa' => $data['cliente'],
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['fecha'],
						'partidas' => $data['partidas'],
						'total' => "$ ".$data['total'],
						'marca' => $marca,
						'modelo' => $modelo,
						'descripcion' => utf8_encode($descripcion),
						'precioUnitario' => " $".$precioUnitario,
					);
				}
			}
		}else{
			$query = "SELECT cotizacion.*, contactos.nombreEmpresa, cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista FROM cotizacion INNER JOIN contactos ON contactos.id=cotizacion.cliente INNER JOIN cotizacionherramientas ON cotizacionherramientas.factura=cotizacion.id WHERE (cotizacion.ref LIKE '%$buscar%' OR cotizacion.NoPedClient LIKE '%$buscar%' OR contactos.nombreEmpresa LIKE '%$buscar%' OR cotizacion.contacto LIKE '%$buscar%' OR cotizacion.vendedor LIKE '%$buscar%' OR cotizacion.fecha LIKE '%$buscar%' OR cotizacionherramientas.marca LIKE '%$buscar%' OR cotizacionherramientas.modelo LIKE '%$buscar%' OR cotizacionherramientas.descripcion LIKE '%$buscar%' OR cotizacionherramientas.precioLista LIKE '%$buscar%') AND (cotizacion.Pagado < 1.14 * cotizacion.precioTotal) AND (cotizacion.fecha >= '$fechainicio' AND cotizacion.fecha <= '$fechafin')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}

					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $pedido,
						'nombreEmpresa' => $data['nombreEmpresa'],
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['fecha'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal'],
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => " $".$data['precioLista'],
					);
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function terminado($buscar, $fechainicio, $fechafin, $filtrotipo, $conexion_usuarios){
		if ($filtrotipo == "pedido") {
			$query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%') AND fechaEntregado != '0000-00-00' AND Pagado > 1.14 * precioTotal AND fecha >= '$fechainicio' AND fecha <= '$fechafin' ORDER BY facturaFecha";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				if($data['numeroPedido'] == ""){
					$pedido = $data['NoPedClient'];
				}else{
					$pedido = $data['numeroPedido'];
				}

				$arreglo['data'][] = array(
					'cotizacionRef' => $data['ref'],
					'numeroPedido' => $pedido,
					'nombreEmpresa' => $data['nombreEmpresa'],
					'contacto' => $data['contacto'],
					'vendedor' => $data['vendedor'],
					'fecha' => $data['Pedido'],
					'partidas' => $data['partidaCantidad'],
					'total' => "$ ".$data['precioTotal']
				);
			}

			$query = "SELECT pedidos.*, contactos.nombreEmpresa FROM pedidos INNER JOIN contactos ON contactos.id = pedidos.cliente WHERE (cotizacionRef LIKE '%$buscar%' OR numeroPedido LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR fecha LIKE '%$buscar%') AND entregado != '0000-00-00' AND pagado > 1.14 * total AND fecha >= '$fechainicio' AND fecha <= '$fechafin' ORDER BY facturaFecha";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo['data'][] = array(
					'cotizacionRef' => $data['cotizacionRef'],
					'numeroPedido' => $data['numeroPedido'],
					'nombreEmpresa' => $data['nombreEmpresa'],
					'contacto' => $data['contacto'],
					'vendedor' => $data['vendedor'],
					'fecha' => $data['fecha'],
					'partidas' => $data['partidas'],
					'total' => "$ ".$data['total']
				);
			}
		}else{
			$query = "SELECT cotizacion.*, contactos.nombreEmpresa, cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista FROM cotizacion INNER JOIN contactos ON contactos.id=cotizacion.cliente INNER JOIN cotizacionherramientas ON cotizacionherramientas.factura=cotizacion.id WHERE (cotizacion.ref LIKE '%$buscar%' OR cotizacion.NoPedClient LIKE '%$buscar%' OR contactos.nombreEmpresa LIKE '%$buscar%' OR cotizacion.contacto LIKE '%$buscar%' OR cotizacion.vendedor LIKE '%$buscar%' OR cotizacion.fecha LIKE '%$buscar%' OR cotizacionherramientas.marca LIKE '%$buscar%' OR cotizacionherramientas.modelo LIKE '%$buscar%' OR cotizacionherramientas.descripcion LIKE '%$buscar%' OR cotizacionherramientas.precioLista LIKE '%$buscar%') AND (cotizacion.Pagado > 1.14 * cotizacion.precioTotal) AND (cotizacion.fecha >= '$fechainicio' AND cotizacion.fecha <= '$fechafin')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				while($data = mysqli_fetch_assoc($resultado)){

					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}

					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'nombreEmpresa' => $data['nombreEmpresa'],
						'numeroPedido' => $pedido,
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['fecha'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal'],
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => " $".$data['precioLista'],
					);
				}
			}

			// $query = "SELECT pedidos.*, contactos.nombreEmpresa, cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista FROM pedidos INNER JOIN contactos ON contactos.id=pedidos.cliente INNER JOIN cotizacionherramientas ON cotizacionherramientas.numeroPedido=pedidos.numeroPedido WHERE (pedidos.cotizacionRef LIKE '%$buscar%' OR pedidos.numeroPedido LIKE '%$buscar%' OR contactos.nombreEmpresa LIKE '%$buscar%' OR pedidos.contacto LIKE '%$buscar%' OR pedidos.vendedor LIKE '%$buscar%' OR pedidos.fecha LIKE '%$buscar%' OR cotizacionherramientas.marca LIKE '%$buscar%' OR cotizacionherramientas.modelo LIKE '%$buscar%' OR cotizacionherramientas.descripcion LIKE '%$buscar%' OR cotizacionherramientas.precioLista LIKE '%$buscar%') AND (pedidos.pagado > 1.14 * pedidos.total) AND (pedidos.fecha >= '$fechainicio' AND pedidos.fecha <= '$fechafin')";
			// $resultado = mysqli_query($conexion_usuarios, $query);
			//
			// if(mysqli_num_rows($resultado) < 1){
			// 	$arreglo['data'] = 0;
			// }else{
			// 	while($data = mysqli_fetch_assoc($resultado)){
			//
			// 		$arreglo['data'][] = array(
			// 			'cotizacionRef' => $data['cotizacionRef'],
			// 			'numeroPedido' => $data['numeroPedido'],
			// 			'nombreEmpresa' => $data['nombreEmpresa'],
			// 			'contacto' => $data['contacto'],
			// 			'vendedor' => $data['vendedor'],
			// 			'fecha' => $data['fecha'],
			// 			'partidas' => $data['partidas'],
			// 			'total' => "$ ".$data['total'],
			// 			'marca' => $data['marca'],
			// 			'modelo' => $data['modelo'],
			// 			'descripcion' => utf8_encode($data['descripcion']),
			// 			'precioUnitario' => " $".$data['precioLista'],
			// 		);
			// 	}
			// }
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function partidas($refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef ='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			$i=1;
			while($data = mysqli_fetch_assoc($resultado)){
				$idherramienta = $data['id'];
				$modelo = $data['modelo'];
				$marca = $data['marca'];

				$query2 = "SELECT enReserva FROM productos WHERE ref = '$modelo' AND marca ='".$marca."'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				if(mysqli_num_rows($resultado2) > 0){
					while($dataAlmacen = mysqli_fetch_array($resultado2)){
						$almacen = $dataAlmacen['enReserva'];
					}
				}else{
					$almacen = 0;
				}

				$query3 = "SELECT fecha FROM pedidos WHERE cotizacionRef = '$refCotizacion' AND numeroPedido ='$numeroPedido'";
				$resultado3 = mysqli_query($conexion_usuarios, $query3);
				if(mysqli_num_rows($resultado3) > 0){
					while($dataFC = mysqli_fetch_array($resultado3)){
						if($data['fechaCompromiso'] == '0000-00-00'){
							if($data['Tiempo_Entrega'] == ''){
								$fechacompromiso = "Sin fecha de compromiso";
							}else{
								$dias = $data['Tiempo_Entrega'];
								$fechacompromiso = $dataFC['fecha'];
								$fechacompromiso = strtotime($fechacompromiso."+".$dias."days");
								$fechacompromiso = date("Y-m-d",$fechacompromiso);
							}
						}else{
							$fechacompromiso = $data['fechaCompromiso'];
						}
					}
				}else{
					$fechacompromiso = "Sin fecha de compromiso";
				}
				$check = '<input type="checkbox" class="btn btn-outline-primary" name="hproveedor" value="'.$data['id'].'">';

				if($data['Entregado'] == "0000-00-00"){
					$entregado = '<input type="checkbox" class="btn btn-outline-primary" name="hentregado" value="'.$data['id'].'">';
				}else{
					$entregado = $data['Entregado'];
				}

				if ($data['factura'] != 0) {
					$factura = $data['factura'];
					$query4 = "SELECT factura FROM cotizacion WHERE id = '$factura'";
					$resultado4 = mysqli_query($conexion_usuarios, $query4);
					if (mysqli_num_rows($resultado)<1) {
						$factura = $data['factura'];
					}else{
						while($data4 = mysqli_fetch_assoc($resultado4)){
							$factura = $data4['factura'];
						}
					}
				}

				$query5 = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas = '$idherramienta'";
				$resultado5 = mysqli_query($conexion_usuarios, $query5);
				if (mysqli_num_rows($resultado5) < 1) {
					$folio = "";
				}else{
					while($data5 = mysqli_fetch_assoc($resultado5)){
						$folio = $data5['folio'];
					}
				}

				$arreglo["data"][]=array(
				'id' => $data['id'],
				'indice' => $i,
				'check' => $data['id'],
				'claveSat' => $data['ClaveProductoSAT'],
				'pedimento' => $data['Pedimento'],
				'enviado' => $data['enviadoFecha'],
				'recibido' => $data['recibidoFecha'],
				'entregado' => $entregado,
				'proveedor' => $data['Proveedor'],
				'marca' => $marca,
				'modelo' => $modelo,
				'descripcion' => utf8_encode($data['descripcion']),
				'noserie' => $data['NoSerie'],
				'preciounidad' => "$ ".($data['precioLista'] + $data['flete']),
				'cantidad' => $data['cantidad'],
				'preciototal' => "$ ".($data['precioLista'] + $data['flete']) * $data['cantidad'],
				'fechacompromiso' => $fechacompromiso,
				'almacen' => $almacen,
				'remision' => $data['remision'],
				'factura' => $data['factura'],
				'folio' => $folio
				);
				$i++;
			}
		}else{
			$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef ='$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				$i=1;
				while($data = mysqli_fetch_assoc($resultado)){
					$idherramienta = $data['id'];
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$query2 = "SELECT enReserva FROM productos WHERE ref = '$modelo' AND marca ='".$marca."'";
					$resultado2 = mysqli_query($conexion_usuarios, $query2);

					if (mysqli_num_rows($resultado2) > 0) {
						while($dataAlmacen = mysqli_fetch_array($resultado2)){
							$almacen = $dataAlmacen['enReserva'];
						}
					}else{
						$almacen = 0;
					}

					$query3 = "SELECT fecha, TiempoEntrega FROM cotizacion WHERE ref = '$refCotizacion'";
					$resultado3 = mysqli_query($conexion_usuarios, $query3);

					if (mysqli_num_rows($resultado3) > 0) {
						while($dataFC = mysqli_fetch_array($resultado3)){
							if($data['fechaCompromiso'] == '0000-00-00'){
								if($data['Tiempo_Entrega'] == ""){
									$fechacompromiso = "Sin fecha de compromiso";
								}else{
									$dias = $data['Tiempo_Entrega'];
									$fechacompromiso = $dataFC['fecha'];
									$fechacompromiso = strtotime($fechacompromiso."+".$dias."days");
									$fechacompromiso = date("Y-m-d",$fechacompromiso);
								}
							}else{
								$fechacompromiso = $data['fechaCompromiso'];
							}
						}
					}else{
						$fechacompromiso = "Sin fecha de compromiso";
					}

					$check = '<input type="checkbox" class="btn btn-outline-primary" name="hproveedor" value="'.$data['id'].'">';

					if($data['Entregado'] == "0000-00-00"){
						$entregado = '<input type="checkbox" class="btn btn-outline-primary" name="hentregado" value="'.$data['id'].'">';
					}else{
						$entregado = $data['Entregado'];
					}

					if ($data['factura'] != 0) {
						$factura = $data['factura'];
						// $query4 = "SELECT factura FROM cotizacion WHERE id = '$factura'";
						// $resultado4 = mysqli_query($conexion_usuarios, $query4);
						// while($data4 = mysqli_fetch_assoc($resultado4)){
						// 	$factura = $data4['factura'];
						// }
					}else{
						$factura = "";
						// $cotizacionRef = $data['cotizacionRef'];
						// $query4 = "SELECT factura FROM cotizacion WHERE ref = '$cotizacionRef'";
						// $resultado4 = mysqli_query($conexion_usuarios, $query4);
						// while($data4 = mysqli_fetch_assoc($resultado4)){
						// 	$factura = $data4['factura'];
						// }
					}

					$query5 = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas = '$idherramienta'";
					$resultado5 = mysqli_query($conexion_usuarios, $query5);
					while($data5 = mysqli_fetch_assoc($resultado5)){
						$folio = $data5['folio'];
					}

					$arreglo["data"][]=array(
						'id' => $data['id'],
						'indice' => $i,
						'check' => $data['id'],
						'claveSat' => $data['ClaveProductoSAT'],
						'pedimento' => $data['Pedimento'],
						'enviado' => $data['enviadoFecha'],
						'recibido' => $data['recibidoFecha'],
						'entregado' => $entregado,
						'proveedor' => $data['Proveedor'],
						'marca' => $marca,
						'modelo' => $modelo,
						'descripcion' => utf8_encode($data['descripcion']),
						'noserie' => $data['NoSerie'],
						'preciounidad' => "$ ".($data['precioLista'] + $data['flete']),
						'cantidad' => $data['cantidad'],
						'preciototal' => "$ ".($data['precioLista'] + $data['flete']) * $data['cantidad'],
						'fechacompromiso' => $fechacompromiso,
						'almacen' => $almacen,
						'remision' => $data['remision'],
						'factura' => $factura,
						'folio' => $folio
				  );
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function devolucion($refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$tabla = "";

		if (!$resultado) {
			$tabla['data'] = "Error al listar herramienta!";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
			$check = '<input type=\"checkbox\" class=\"btn btn-outline-primary\" name=\"hdevolucion\" value=\"'.$data['id'].'\">';
			$descripcion = str_replace('"', "pulg. ", $data['descripcion']);

			$tabla.='{
				  "marca":"'.$data['marca'].'",
				  "modelo":"'.$data['modelo'].'",
				  "descripcion":"'.$descripcion.'",
				  "check":"'.$check.'"
				},';
			}
		}

		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo utf8_encode('{"data":['.$tabla.']}');
		mysqli_free_result($resultado);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			echo json_encode("ERROR");
		}else{
			echo json_encode("BIEN");
		}
	}

 ?>
