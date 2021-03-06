<?php 
	
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	// $informacion[] = "";

	switch ($opcion) {
		case 'buscardatos':
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			buscardatos($refCotizacion, $numeroPedido, $conexion_usuarios);
			break;	

		case 'paqueterias':
			$paqueteria = $_POST['paqueteria'];
			paqueterias($paqueteria, $conexion_usuarios);
			break;

		case 'proveedores':		
			proveedores($conexion_usuarios);
			break;

		case 'datosRFC':
			$rfc = $_POST['rfc'];		
			datosrfc($rfc, $conexion_usuarios);
			break;

		case 'buscarpartidasfacturar':
			$numeroPedido = $_POST['numeroPedido'];	
			$cotizacionRef = $_POST['refCotizacion'];	
			buscarpartidasfacturar($numeroPedido, $cotizacionRef, $conexion_usuarios);
			break;

		case 'proveedoressinoc':
			proveedoressinoc($conexion_usuarios);
		break;

	}

	function buscardatos($refCotizacion, $numeroPedido, $conexion_usuarios){
		$query = "SELECT * FROM cotizacion WHERE ref='$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) > 0){
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];

				$query2 = "SELECT * FROM contactos WHERE id = '$idcliente'";
				$res2 = mysqli_query($conexion_usuarios, $query2);
				while($data2 = mysqli_fetch_assoc($res2)){
					$informacion['cliente'] = $data2;
				}

				$informacion['refCotizacion'] = $data['ref'];
				$informacion['remision'] = $data['remision'];
				$informacion['fecha'] = $data['fecha'];
				$informacion['vendedor'] = $data['vendedor'];
				$informacion['factura'] = $data['factura'];
				$informacion['pagado'] = $data['Pagado'];
				$informacion['total'] = $data['precioTotal'];
				$informacion['moneda'] = $data['moneda'];
				$informacion['paqueteria'] = $data['IdPaqueteria'];
				$informacion['numeroGuia'] = $data['guia'];
			}
		}else{
			$query = "SELECT * FROM pedidos WHERE cotizacionRef='$refCotizacion' AND numeroPedido = '$numeroPedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];

				$query2 = "SELECT * FROM contactos WHERE id = '$idcliente'";
				$res2 = mysqli_query($conexion_usuarios, $query2);
				while($data2 = mysqli_fetch_assoc($res2)){
					$informacion['cliente'] = $data2;
				}

				$informacion['refCotizacion'] = $data['cotizacionRef'];
				$informacion['ordenCompra'] = $data['ordenCompra'];
				$informacion['fecha'] = $data['fecha'];
				$informacion['vendedor'] = $data['vendedor'];
				$informacion['factura'] = $data['factura'];
				$informacion['pagado'] = $data['pagado'];
				$informacion['total'] = $data['total'];
				$informacion['moneda'] = $data['moneda'];
				$informacion['paqueteria'] = $data['paqueteria'];
				$informacion['numeroGuia'] = $data['numeroGuia'];
			}
		}

		echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);	
	}

	function paqueterias($paqueteria, $conexion_usuarios){
		$query = "SELECT * FROM paqueterias";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$paqueterias[] = $data['IdPaqueteria'];
			$paqueterias[] = utf8_encode($data['nombre']);
		}

		echo json_encode($paqueterias);
	}

	function proveedores($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo='Proveedor' ORDER BY nombreEmpresa ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$proveedores[] = utf8_encode(strtoupper($data['nombreEmpresa']));
		}

		echo json_encode($proveedores);
	}

	function datosrfc($rfc, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE RFC = '$rfc'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['datos'] = $data;
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscarpartidasfacturar($numeroPedido, $cotizacionRef, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE numeroPedido = '$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) > 0){
			while ($data = mysqli_fetch_assoc($resultado)) {
				$traslados = Array();
				$traslados['Traslados'][] = array(
					'Base' => $data['precioLista'] * $data['cantidad'],
					'Impuesto' => "002",
					'TipoFactor' => "Tasa",
					'TasaOCuota' => 0.1600,
					'Importe' => ($data['precioLista'] * $data['cantidad']) * 0.1600
				);
				// $retenidos['Retenidos'][] = array(
				// 	'Base' => $data['precioLista'] * $data['cantidad'],
				// 	'Impuesto' => 002,
				// 	'TipoFactor' => "Tasa",
				// 	'TasaOCuota' => 0.16,
				// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
				// );
				// $locales['Locales'][] = array(
				// 	'Base' => $data['precioLista'] * $data['cantidad'],
				// 	'Impuesto' => 002,
				// 	'TipoFactor' => "Tasa",
				// 	'TasaOCuota' => 0.16,
				// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
				// );	
				if ($data['Pedimento'] != '') {
					$Partes = "{}";
					$arreglo['data'][] = array(
						'ClaveProdServ' => $data['ClaveProductoSAT'],
						'NoIdentificacion' => $data['modelo'],
						'Cantidad' => $data['cantidad'],
						'ClaveUnidad' => "E48",
						'Unidad' => "Unidad de servicio",
						'ValorUnitario' => $data['precioLista'],
						'Descripcion' => $data['descripcion']." Aduana: Nuevo Laredo, "."Fecha: ".date("d-m-Y"),
						'Descuento' => 0,
						'Impuestos' => $traslados,
						'Aduana' => $data['Pedimento']
					);		
				}else{
					$arreglo['data'][] = array(
						'ClaveProdServ' => $data['ClaveProductoSAT'],
						'NoIdentificacion' => $data['modelo'],
						'Cantidad' => $data['cantidad'],
						'ClaveUnidad' => "E48",
						'Unidad' => "Unidad de servicio",
						'ValorUnitario' => $data['precioLista'],
						'Descripcion' => $data['descripcion'],
						'Descuento' => 0,
						'Impuestos' => $traslados
					);
				}		
	
			}
		}else{
			$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$cotizacionRef'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$base = 0;
			while ($data = mysqli_fetch_assoc($resultado)) {
				$traslados['Traslados'][] = array(
					'Base' => $data['precioLista'] * $data['cantidad'],
					'Impuesto' => "002",
					'TipoFactor' => "Tasa",
					'TasaOCuota' => 0.1600,
					'Importe' => ($data['precioLista'] * $data['cantidad']) * 0.1600
				);
				// $retenidos['Retenidos'][] = array(
				// 	'Base' => $data['precioLista'] * $data['cantidad'],
				// 	'Impuesto' => 002,
				// 	'TipoFactor' => "Tasa",
				// 	'TasaOCuota' => 0.16,
				// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
				// );
				// $locales['Locales'][] = array(
				// 	'Base' => $data['precioLista'] * $data['cantidad'],
				// 	'Impuesto' => 002,
				// 	'TipoFactor' => "Tasa",
				// 	'TasaOCuota' => 0.16,
				// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
				// );	
				if ($data['Pedimento'] != '') {
					$Partes = "{}";
					$arreglo['data'][] = array(
						'ClaveProdServ' => $data['ClaveProductoSAT'],
						'NoIdentificacion' => $data['modelo'],
						'Cantidad' => $data['cantidad'],
						'ClaveUnidad' => "E48",
						'Unidad' => "Unidad de servicio",
						'ValorUnitario' => $data['precioLista'],
						'Descripcion' => $data['descripcion']." Aduana: Nuevo Laredo, "."Fecha: ".date("d-m-Y"),
						'Descuento' => 0,
						'Impuestos' => $traslados,
						'Aduana' => $data['Pedimento']
					);		
				}else{
					$arreglo['data'][] = array(
						'ClaveProdServ' => $data['ClaveProductoSAT'],
						'NoIdentificacion' => $data['modelo'],
						'Cantidad' => $data['cantidad'],
						'ClaveUnidad' => "E48",
						'Unidad' => "Unidad de servicio",
						'ValorUnitario' => $data['precioLista'],
						'Descripcion' => $data['descripcion'],
						'Descuento' => 0,
						'Impuestos' => $traslados
					);
				}	
				unset($traslados);	
			}
		}

		$query = "SELECT * FROM pedidos WHERE cotizacionRef = '$cotizacionRef' AND numeroPedido = '$numeroPedido'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) > 0){
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
				$fecha = $data['fecha'];
				$arreglo['moneda'] = strtoupper($data['moneda']);
			}
		}else{
			$query = "SELECT * FROM cotizacion WHERE ref = '$cotizacionRef'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];
				$fecha = $data['fecha'];
				$arreglo['moneda'] = strtoupper($data['moneda']);
			}
		}

		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcfdi = $data['IdUsoCFDI'];
			$idformapago = $data['IdFormaPago'];
			$idmetodopago = $data['IdMetodoPago'];
			$arreglo['condpago'] = "Pago en ".$data['CondPago']." dias";
		}

		$query = "SELECT * FROM usocfdi WHERE IdUsoCFDI = '$idcfdi'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['cfdi'] = $data['Clave'];
		}

		$query = "SELECT * FROM formasdepago WHERE IdFormaPago = '$idformapago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['formapago'] = $data['Clave'];
		}

		$query = "SELECT * FROM metodosdepago WHERE IdMetodoPago = '$idmetodopago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['metodopago'] = $data['Clave'];
		}

		$query = "SELECT * FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['tipocambio'] = $data['tipocambio'];
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);	
	}

	function proveedoressinoc($conexion_usuarios){
		$query = "SELECT DISTINCT Proveedor FROM cotizacionherramientas WHERE Pedido = 'si' AND ordenCompra = ' ' AND numeroPedido != ' '";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_array($resultado)){
			$idproveedor= $data['Proveedor'];
			$proveedores[] = $idproveedor;
			$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Proveedor' AND id = '$idproveedor'";
			$resultadonombre = mysqli_query($conexion_usuarios, $query);
			while ($datanombre = mysqli_fetch_array($resultadonombre)) {
				$proveedores[] = $datanombre['nombreEmpresa'];
			}
		}

		echo json_encode($proveedores);
	}

?>