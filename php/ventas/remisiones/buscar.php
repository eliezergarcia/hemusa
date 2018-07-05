<?php

	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'buscardatos':
			$remision = $_POST['remision'];
			buscardatos($remision, $conexion_usuarios);
			break;

		case 'paqueterias':
			$paqueteria = $_POST['paqueteria'];
			paqueterias($paqueteria, $conexion_usuarios);
			break;

		case 'proveedores':
			proveedores($conexion_usuarios);
			break;

		case 'datosgenerales':
			$remision = $_POST['remision'];
			datos_generales($remision, $conexion_usuarios);
			break;

		case 'datosRFC':
			$rfc = $_POST['rfc'];
			datosrfc($rfc, $conexion_usuarios);
			break;

		case 'buscarpartidasfacturar':
			$remision = $_POST['remision'];
			buscarpartidasfacturar($remision, $conexion_usuarios);
			break;

		case 'buscarClientes':
			buscar_clientes($conexion_usuarios);
			break;

		case 'buscarDatosCliente':
			$cliente = $_POST['cliente'];
			buscar_datos_cliente($cliente, $conexion_usuarios);
			break;

		case 'buscarContactos':
			$id = $_POST['id'];
			buscar_contactos($id, $conexion_usuarios);
			break;

		case 'nuevaremision':
			nueva_remision($conexion_usuarios);
			break;

		case 'imprimircotizacion':
			$remision = $_POST['remision'];
			imprimir_cotizacion($remision, $conexion_usuarios);
			break;
	}

	function imprimir_cotizacion($remision, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die('Error al buscar partidas! 2');
		}else{
			$i=1;
			$subtotal = 0;
			while($data = mysqli_fetch_assoc($resultado)){
				$refCotizacion = $data['cotizacionRef'];

				$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion'";
				$resultado2 = mysqli_query($conexion_usuarios, $query);
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$pedidoCliente = $data2['NoPedClient'];
				}

				// $descripcion = str_replace($data['descripcion'], "", "(", 5);
				$descripcion = utf8_encode($data['descripcion']);
				$datadescripcion = explode('(', $descripcion);
				$desc = $datadescripcion[0];

				$arreglo["partidas"][]=array(
					'indice' => $i,
					'marca' => $data['marca'],
					'modelo' => $data['modelo'],
					'descripcion' => utf8_encode($desc),
					'pedidoCliente' => $pedidoCliente,
					'cantidad' => $data['cantidad'],
					'precioUnitario' => "$ ".round($data['precioLista'],2),
					'precioTotal' => "$ ".round($data['precioLista'] * $data['cantidad'],2)
				);
				$i++;
				$subtotal = $subtotal + ($data['precioLista'] * $data['cantidad']);
			}
			$arreglo["totales"][]=array(
				'subtotal' => "$ ".round($subtotal,2),
				'iva' => "$ ".round($subtotal * .16,2),
				'total' => "$ ".round($subtotal * 1.16,2)
			);
		}

		$query = "SELECT * FROM cotizacion WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['cotizacion'] = array_map("utf8_encode", $data);
			$idcliente = $data['cliente'];
		}

		$query = "SELECT * FROM contactos WHERE id ='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['cliente'] = array_map("utf8_encode", $data);
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_free_result($resultado);
		mysqli_close($conexion_usuarios);
	}

	function nueva_remision($conexion_usuarios){
		$n = 101;
     	$numero = substr(date("y"), 1).date("m").date("d").$n;
	   	$query = "SELECT ref FROM cotizacion ORDER BY id DESC LIMIT 100";
     	$resultado = mysqli_query($conexion_usuarios, $query);

     	while($data = mysqli_fetch_array($resultado)){
     		$ultimaCotizacion = str_replace("HMU", "", $data['ref']);
	     	while ($numero <= $ultimaCotizacion) {
	     		$n++;
	     		$numero = substr(date("y"), 1).date("m").date("d").$n;
			}
     	}

		$numeroCotizacion = "HMU".substr(date("y"), 1).date("m").date("d").$n;

		$query = "SELECT max(remision) AS ultimaremision FROM cotizacion";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$remision = $data['ultimaremision'] + 1;
		}

     	$arreglo['resultado'] = "ok";
		$arreglo['numeroCotizacion'] = $numeroCotizacion;
		$arreglo['remision'] = $remision;
		echo json_encode($arreglo);
	}

	function buscar_clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Cliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
	}

	function buscar_contactos($id, $conexion_usuarios){
		$query = "SELECT personaContacto FROM contactospersonas WHERE empresa ='$id' ORDER BY personaContacto ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (mysqli_num_rows($resultado) > 0) {
			while($data = mysqli_fetch_array($resultado)){
				$informacion["idcliente"] = $id;
				$informacion["contactos"][] = utf8_encode($data['personaContacto']);
			}
		}else{
			$informacion["respuesta"] = "Ninguno";
			$informacion["idcliente"] = $id;
		}

		echo json_encode($informacion);
	}

	function buscar_datos_cliente($cliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%".$cliente."%'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idCliente = $data['id'];
			$arreglo['data'] = $data;
		}

		echo json_encode($arreglo);
	}

	function buscardatos($remision, $conexion_usuarios){

		$query = "SELECT * FROM cotizacion WHERE remision='$remision'";
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

				if ($data['vendedor'] == "") {
					$informacion['vendedor'] = $data['vendedor'];
				}else{
					$informacion['vendedor'] = $data['contacto'];
				}

				
				$query3 = "SELECT DISTINCT factura FROM cotizacionherramientas WHERE remision = '$remision'";
				$res3 = mysqli_query($conexion_usuarios, $query3);
				while($data3 = mysqli_fetch_assoc($res3)){
					$cotizacionRef = $data3['factura'];
				}

				$query4 = "SELECT * FROM cotizacion WHERE id='$cotizacionRef'";
				$resultado4 = mysqli_query($conexion_usuarios, $query4);
				while($data4 = mysqli_fetch_assoc($resultado4)){
					$vendedor = $data4['vendedor'];
					$factura = $data4['factura'];
					$pedidocliente = $data4['NoPedClient'];
				}

				$informacion['factura'] = $factura;
				$informacion['pedidocliente'] = $pedidocliente;

				$informacion['remision'] = $data['remision'];
				$informacion['fecha'] = $data['fecha'];
				$informacion['pagado'] = $data['Pagado'];
				$informacion['total'] = $data['precioTotal'];
				$informacion['moneda'] = $data['moneda'];
				$informacion['paqueteria'] = $data['IdPaqueteria'];
				$informacion['numeroGuia'] = $data['guia'];
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

	function datos_generales($remision, $conexion_usuarios){
		$query = "SELECT * FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			die("Error!");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo['cotizacion'] = $data;
				$idcliente = $data['cliente'];
			}

			$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				die("Error!");
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo['cliente'] = $data;
				}
			}

		}

		echo json_encode($arreglo);

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

	function buscarpartidasfacturar($remision, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$arreglo = Array();

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
					'Descripcion' => $data['descripcion'],
					'Descuento' => 0,
					// 'Impuestos' => "{
					// 	            'Traslados':[{'Base' : 15000, 'Impuesto': '002', 'TipoFactor': 'Tasa', 'TasaOCuota': 0.16, 'Importe': 2400}],
					// 	            'Retenidos':[{'Base' : 15000, 'Impuesto': '001', 'TipoFactor': 'Tasa', 'TasaOCuota': 0.10, 'Importe': 1500}],
					// 	            'Locales':[{'Impuesto': 'ISH', 'TasaOCuota': 0.03}]
					// 	        }",
					'Impuestos' => $traslados,
					'Aduana' => $data['Pedimento']
					// 'Predial' => "487842327ee",
					// 'Partes' => $Partes
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

		$query = "SELECT * FROM cotizacion WHERE remision = '$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
			$fecha = $data['fecha'];
			$arreglo['moneda'] = strtoupper($data['moneda']);
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

		echo json_encode($arreglo);
	}


?>
