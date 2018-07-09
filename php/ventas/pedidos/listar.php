<?php

	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'noentregado':
			$buscar = $_POST['buscar'];
			noentregado($buscar, $conexion_usuarios);
			break;

		case 'sinproveedor':
			$buscar = $_POST['buscar'];
			sinproveedor($buscar, $conexion_usuarios);
			break;

		case 'nopagado':
			$buscar = $_POST['buscar'];
			nopagado($buscar, $conexion_usuarios);
			break;

		case 'terminado':
			$buscar = $_POST['buscar'];
			terminado($buscar, $conexion_usuarios);
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

	function noentregado($buscar, $conexion_usuarios){
		$query = "SELECT DISTINCT cotizacionRef FROM cotizacionherramientas WHERE Pedido = 'si' AND pedidoFecha != '0000-00-00' AND Proveedor = 'None' AND pedidoFecha >= '2017-01-01' AND Entregado ='0000-00-00' AND factura = 0 AND remision = 0";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo["data"] = 0;
		}else{
			while($data1 = mysqli_fetch_assoc($resultado)){
				$cotizacionRef = $data1['cotizacionRef'];

				$querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%') AND cotizacion.ref = '$cotizacionRef'";
				$rescotizacion = mysqli_query($conexion_usuarios, $querycotizacion);

				while($data = mysqli_fetch_assoc($rescotizacion)){
					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $data['NoPedClient'],
						'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['Pedido'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal']
					);
				}
			}

		}



		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function sinproveedor($buscar, $conexion_usuarios){
		$query = "SELECT DISTINCT cotizacionRef FROM cotizacionherramientas WHERE Pedido = 'si' AND pedidoFecha != '0000-00-00' AND Proveedor = 'None' AND pedidoFecha >= '2017-01-01'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo["data"] = 0;
		}else{
			while($data1 = mysqli_fetch_assoc($resultado)){
				$cotizacionRef = $data1['cotizacionRef'];

				$querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%') AND cotizacion.ref = '$cotizacionRef'";
				$rescotizacion = mysqli_query($conexion_usuarios, $querycotizacion);

				while($data = mysqli_fetch_assoc($rescotizacion)){
					$arreglo['data'][] = array(
						'cotizacionRef' => $data['ref'],
						'numeroPedido' => $data['NoPedClient'],
						'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
						'contacto' => $data['contacto'],
						'vendedor' => $data['vendedor'],
						'fecha' => $data['Pedido'],
						'partidas' => $data['partidaCantidad'],
						'total' => "$ ".$data['precioTotal']
					);
				}
			}

		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function nopagado($buscar, $conexion_usuarios){
		// $query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%') AND factura!=0 AND NoPedClient != '0' AND Pagado < 1.14 * precioTotal AND fecha >= '2017-01-01' ORDER BY facturaFecha ASC";
		// $resultado = mysqli_query($conexion_usuarios, $query);
		//
		// while($data = mysqli_fetch_assoc($resultado)){
		// 	$idcotizacion = $data['id'];
		//
		// 	$query2 = "SELECT cotizacionRef FROM cotizacionherramientas WHERE factura = '$idcotizacion'";
		// 	$resultado2 = mysqli_query($conexion_usuarios, $query2);
		// 	while($data2 = mysqli_fetch_assoc($resultado2)){
		// 		$cotizacionRef = $data2['cotizacionRef'];
		// 	}
		//
		//
		// 	$arreglo['data'][] = array(
		// 		'cotizacionRef' => $cotizacionRef,
		// 		'numeroPedido' => $data['NoPedClient'],
		// 		'nombreEmpresa' => $data['nombreEmpresa'],
		// 		'contacto' => $data['contacto'],
		// 		'vendedor' => $data['vendedor'],
		// 		'fecha' => $data['Pedido'],
		// 		'partidas' => $data['partidaCantidad'],
		// 		'total' => "$ ".$data['precioTotal']
		// 	);
		// }

		$query = "SELECT pedidos.*, contactos.nombreEmpresa FROM pedidos INNER JOIN contactos ON contactos.id = pedidos.cliente WHERE (cotizacionRef LIKE '%$buscar%' OR numeroPedido LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR fecha LIKE '%$buscar%') AND factura!= '' AND numeroPedido != '' AND pagado < 1.14 * total AND fecha >= '2017-01-01' ORDER BY facturaFecha ASC";
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

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function terminado($buscar, $conexion_usuarios){
		$query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE (cotizacion.ref LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR Pedido LIKE '%$buscar%') AND fechaEntregado != '0000-00-00' AND Pagado > 1.14 * precioTotal ORDER BY facturaFecha DESC LIMIT 500";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'][] = array(
				'cotizacionRef' => $data['ref'],
				'numeroPedido' => $data['NoPedClient'],
				'nombreEmpresa' => $data['nombreEmpresa'],
				'contacto' => $data['contacto'],
				'vendedor' => $data['vendedor'],
				'fecha' => $data['Pedido'],
				'partidas' => $data['partidaCantidad'],
				'total' => "$ ".$data['precioTotal']
			);
		}

		$query = "SELECT pedidos.*, contactos.nombreEmpresa FROM pedidos INNER JOIN contactos ON contactos.id = pedidos.cliente WHERE (cotizacionRef LIKE '%$buscar%' OR numeroPedido LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR vendedor LIKE '%$buscar%' OR fecha LIKE '%$buscar%') AND entregado != '0000-00-00' AND pagado > 1.14 * total ORDER BY facturaFecha DESC LIMIT 499";
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

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function partidas($refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef ='$refCotizacion' AND numeroPedido='$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			$i=1;
			while($data = mysqli_fetch_assoc($resultado)){
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
					while($data4 = mysqli_fetch_assoc($resultado4)){
						$factura = $data4['factura'];
					}
				}else{
					$factura = $data['factura'];
					$cotizacionRef = $data['cotizacionRef'];
					$query4 = "SELECT factura FROM cotizacion WHERE ref = '$cotizacionRef'";
					$resultado4 = mysqli_query($conexion_usuarios, $query4);
					while($data4 = mysqli_fetch_assoc($resultado4)){
						$factura = $data4['factura'];
					}
				}

				$arreglo["data"][]=array(
				'id' => $data['id'],
				'indice' => $i,
				'check' => $check,
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
				'factura' => $factura
				);
				$i++;
			}
		}else{
			$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef ='$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(!$resultado){
				die('Error al buscar partidas! 2');
			}else{
				$i=1;
				while($data = mysqli_fetch_assoc($resultado)){
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

					$check = '<input type="checkbox" class="btn btn-outline-primary" name="hpacking" value="'.$data['id'].'">';

					if($data['Entregado'] == "0000-00-00"){
						$entregado = '<input type="checkbox" class="btn btn-outline-primary" name="hentregado" value="'.$data['id'].'">';
					}else{
						$entregado = $data['Entregado'];
					}

					if ($data['factura'] != 0) {
						$factura = $data['factura'];
						$query4 = "SELECT factura FROM cotizacion WHERE id = '$factura'";
						$resultado4 = mysqli_query($conexion_usuarios, $query4);
						while($data4 = mysqli_fetch_assoc($resultado4)){
							$factura = $data4['factura'];
						}
					}else{
						$factura = $data['factura'];
						$cotizacionRef = $data['cotizacionRef'];
						$query4 = "SELECT factura FROM cotizacion WHERE ref = '$cotizacionRef'";
						$resultado4 = mysqli_query($conexion_usuarios, $query4);
						while($data4 = mysqli_fetch_assoc($resultado4)){
							$factura = $data4['factura'];
						}
					}


					$arreglo["data"][]=array(
						'id' => $data['id'],
						'indice' => $i,
						'check' => $check,
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
						'factura' => $factura
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
