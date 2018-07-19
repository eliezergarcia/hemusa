<?php
	include('../../conexion.php');
	// error_reporting(0);
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'nacional':
			// $filtromes = $_POST['filtromes'];
			// $filtroano = $_POST['filtroano'];
			// if ($filtromes != "todo") {
			// 	$fechainicio = $filtroano.'-'.$filtromes.'-01';
			// 	$fechafin = $filtroano.'-'.$filtromes.'-31';
			// }else{
			// 	$fechainicio = $filtroano.'-01-01';
			// 	$fechafin = $filtroano.'-12-31';
			// }
			nacional($conexion_usuarios);
			break;

    case 'partidasnacional':
      $folio = $_POST['folio'];
			$opcion2 = $_POST['opcion2'];
			partidas_nacional($folio, $opcion2, $conexion_usuarios);
			break;

    case 'importacion':
			// $filtromes = $_POST['filtromes'];
			// $filtroano = $_POST['filtroano'];
			// if ($filtromes != "todo") {
			// 	$fechainicio = $filtroano.'-'.$filtromes.'-01';
			// 	$fechafin = $filtroano.'-'.$filtromes.'-31';
			// }else{
			// 	$fechainicio = $filtroano.'-01-01';
			// 	$fechafin = $filtroano.'-12-31';
			// }
			importacion($conexion_usuarios);
			break;

    case 'partidasimportacion':
      $pedimento = $_POST['pedimento'];
			$opcion2 = $_POST['opcion2'];
			partidas_importacion($pedimento, $opcion2, $conexion_usuarios);
			break;
  }

  function nacional($conexion_usuarios){
    $query = "SELECT DISTINCT folio, proveedor FROM utilidad_pedido WHERE folio != '' AND folio != 0 AND folio != '0' ORDER BY id DESC LIMIT 50";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idproveedor = $data['proveedor'];
				$query2 = "SELECT * FROM contactos WHERE id = '$idproveedor'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$proveedor = $data2['nombreEmpresa'];
				}


        $arreglo['data'][] = array(
  				'folio' => $data['folio'],
					'proveedor' => utf8_encode($proveedor)
  			);
			}
		}
    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
  }

  function partidas_nacional($folio, $opcion2, $conexion_usuarios){
		$fechaFin = date("Y-m-d");
		$fechaInicio = date("Y-01-01");
		if ($opcion2 == "compras") {
			$query = "SELECT utilidad_pedido.*, contactos.nombreEmpresa, contactos.alias FROM utilidad_pedido INNER JOIN contactos ON contactos.id=utilidad_pedido.cliente WHERE folio = '$folio' AND fecha_orden_compra >='$fechaInicio' AND fecha_orden_compra <= '$fechaFin' ORDER BY marca ASC";
		}else{
			$query = "SELECT utilidad_pedido.*, contactos.nombreEmpresa, contactos.alias FROM utilidad_pedido INNER JOIN contactos ON contactos.id=utilidad_pedido.cliente WHERE folio = '$folio' AND fecha_orden_compra >='$fechaInicio' AND fecha_orden_compra <= '$fechaFin' ORDER BY nombreEmpresa ASC";
		}
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {

			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['cliente'];
				$proveedor = $data['proveedor'];
				$idherramienta = $data['id_cotizacion_herramientas'];
				$facturaproveedor = $data['factura_proveedor'];

				$query = "SELECT cotizacionRef FROM cotizacionherramientas WHERE id = '$idherramienta'";
				$resultado2 = mysqli_query($conexion_usuarios, $query);
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$cotizacionRef = $data2['cotizacionRef'];
				}

				$query = "SELECT NoPedClient FROM cotizacion WHERE ref = '$cotizacionRef'";
				$resultado3 = mysqli_query($conexion_usuarios, $query);
				while($data3 = mysqli_fetch_assoc($resultado3)){
					if ($data3['NoPedClient'] == "") {
						$pedidoCliente = "";
					}else{
						$pedidoCliente = $data3['NoPedClient'];
					}
				}

				// $query = "SELECT nombreEmpresa, alias FROM contactos WHERE id = '$cliente'";
				// $resultadocliente = mysqli_query($conexion_usuarios, $query);
				// while($datacliente = mysqli_fetch_assoc($resultadocliente)){
				// 	$cliente = $datacliente['nombreEmpresa'];
				// 	$aliascliente = $datacliente['alias'];
				// }

				if ($data['alias'] != "") {
					$cliente = $data['alias'];
				}else{
					$cliente = $data['nombreEmpresa'];
				}

				$query = "SELECT nombreEmpresa, alias FROM contactos WHERE id = '$proveedor'";
				$resultadoproveedor = mysqli_query($conexion_usuarios, $query);
				while($dataproveedor = mysqli_fetch_assoc($resultadoproveedor)){
					$proveedor = $dataproveedor['nombreEmpresa'];
					$aliasproveedor = $dataproveedor['alias'];
				}
				$proveedor = str_replace("(PROVEEDOR)", "", $proveedor);

				if ($aliasproveedor != "") {
					$proveedor = $aliasproveedor;
				}

				if ($facturaproveedor == "" || $facturaproveedor == "0") {
					$facturaproveedor = "";
				}


				$arreglo["data"][] = array(
					'indice' => $i,
					'id' => $data['id'],
					'marca' => $data['marca'],
					'modelo' => $data['modelo'],
					'cantidad' => $data['cantidad'],
					'recibido' => "",
					'descripcion' => $data['descripcion'],
					'cliente' => utf8_encode($cliente),
					'pedidocliente' => $pedidoCliente,
					'proveedor' => utf8_encode($proveedor),
					'facturaproveedor' => $facturaproveedor,
					'remision' => "",
					'factura' => "",
					'observaciones' => "",
				);
				$i++;
			}
		}

		$arreglo["fecha"][] = date("d-m-Y");

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

  function importacion($conexion_usuarios){
    $query = "SELECT DISTINCT Pedimento, proveedor FROM utilidad_pedido WHERE Pedimento != '' AND Pedimento != 0 AND fecha_orden_compra >='$fechainicio' AND fecha_orden_compra <= '$fechafin' ORDER BY id DESC";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idproveedor = $data['proveedor'];
				$query2 = "SELECT * FROM contactos WHERE id = '$idproveedor'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$proveedor = $data2['nombreEmpresa'];
				}

        $arreglo['data'][] = array(
  				'folio' => $data['Pedimento'],
					'proveedor' => utf8_encode($proveedor)
  			);
			}
		}
    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
  }

  function partidas_importacion($pedimento, $opcion2, $conexion_usuarios){
		$fechaFin = date("Y-m-d");
		$fechaInicio = date("Y-01-01");
		if ($opcion2 == "compras") {
			$query = "SELECT utilidad_pedido.*, contactos.nombreEmpresa, contactos.alias FROM utilidad_pedido INNER JOIN contactos ON contactos.id=utilidad_pedido.cliente WHERE Pedimento = '$pedimento' AND fecha_orden_compra >='$fechaInicio' AND fecha_orden_compra <= '$fechaFin' ORDER BY utilidad_pedido.marca ASC";
		}else{
			$query = "SELECT utilidad_pedido.*, contactos.nombreEmpresa, contactos.alias FROM utilidad_pedido INNER JOIN contactos ON contactos.id=utilidad_pedido.cliente WHERE Pedimento = '$pedimento' AND fecha_orden_compra >='$fechaInicio' AND fecha_orden_compra <= '$fechaFin' ORDER BY nombreEmpresa ASC";
		}
		// $query = "SELECT * FROM utilidad_pedido WHERE Pedimento = '$pedimento' AND fecha_orden_compra >='$fechaInicio' AND fecha_orden_compra <= '$fechaFin' ORDER BY marca ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {

			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['cliente'];
				$proveedor = $data['proveedor'];
				$idherramienta = $data['id_cotizacion_herramientas'];
				$facturaproveedor = $data['factura_proveedor'];

				$query = "SELECT cotizacionRef FROM cotizacionherramientas WHERE id = '$idherramienta'";
				$resultado2 = mysqli_query($conexion_usuarios, $query);
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$cotizacionRef = $data2['cotizacionRef'];
				}

				$query = "SELECT NoPedClient FROM cotizacion WHERE ref = '$cotizacionRef'";
				$resultado3 = mysqli_query($conexion_usuarios, $query);
				while($data3 = mysqli_fetch_assoc($resultado3)){
					$pedidoCliente = $data3['NoPedClient'];
				}

				// $query = "SELECT nombreEmpresa, alias FROM contactos WHERE id = '$cliente'";
				// $resultadocliente = mysqli_query($conexion_usuarios, $query);
				// while($datacliente = mysqli_fetch_assoc($resultadocliente)){
				// 	$cliente = $datacliente['nombreEmpresa'];
				// 	$aliascliente = $datacliente['alias'];
				// }

				if ($data['alias'] != "") {
					$cliente = $data['alias'];
				}else{
					$cliente = $data['nombreEmpresa'];
				}

				$query = "SELECT nombreEmpresa, alias FROM contactos WHERE id = '$proveedor'";
				$resultadoproveedor = mysqli_query($conexion_usuarios, $query);
				while($dataproveedor = mysqli_fetch_assoc($resultadoproveedor)){
					$proveedor = $dataproveedor['nombreEmpresa'];
					$aliasproveedor = $dataproveedor['alias'];
				}

				$proveedor = str_replace("(PROVEEDOR)", "", $proveedor);

				if ($aliasproveedor != "") {
					$proveedor = $aliasproveedor;
				}

				if ($facturaproveedor == "" || $facturaproveedor == "0") {
					$facturaproveedor = "";
				}

				$arreglo["data"][] = array(
					'indice' => $i,
					'id' => $data['id'],
					'marca' => $data['marca'],
					'modelo' => $data['modelo'],
					'cantidad' => $data['cantidad'],
					'recibido' => "",
					'descripcion' => $data['descripcion'],
					'cliente' => utf8_encode($cliente),
					'pedidocliente' => $pedidoCliente,
					'proveedor' => utf8_encode($proveedor),
					'facturaproveedor' => $data['factura_proveedor'],
					'remision' => "",
					'factura' => "",
					'observaciones' => "",
				);
				$i++;
			}
		}

		$arreglo["fecha"][] = date("d-m-Y");

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}
?>
