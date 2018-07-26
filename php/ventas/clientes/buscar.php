<?php
	include ('../../conexion.php');
	error_reporting(0);
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'datosusuario':
			$idusuario = $_POST['idusuario'];
			datosusuario($idusuario, $conexion_usuarios);
			break;

		case 'datoscliente':
			$idcliente = $_POST['idcliente'];
			buscar_datos_cliente($idcliente, $conexion_usuarios);
			break;

		case 'nuevacotizacion':
			nueva_cotizacion($conexion_usuarios);
			break;

		case 'buscarcontactos':
			$idcliente = $_POST['idcliente'];
			buscar_contactos($idcliente, $conexion_usuarios);
			break;

		case 'informacioncontacto':
			$idcliente = $_POST['idcliente'];
			informacion_contacto($idcliente, $conexion_usuarios);
			break;

		case 'nuevaremision':
			$idcontacto = $_POST['idcontacto'];
			nueva_remision($idcontacto, $conexion_usuarios);
			break;

		case 'buscarClientes':
			buscar_clientes($conexion_usuarios);
			break;

		case 'cuentasbanco':
			$idcliente = $_POST['idcliente'];
			cuentas_banco($idcliente, $conexion_usuarios);
			break;

		case 'herramientasremisiones':
			$remisiones = json_decode($_POST['remisiones']);
			herramientas_remisiones($remisiones, $conexion_usuarios);
			break;

		case 'buscardatos':
			$RFC = $_POST['RFC'];
			buscardatos($RFC, $conexion_usuarios);
			break;

		case 'datosRFC':
			$rfc = $_POST['rfc'];
			datosrfc($rfc, $conexion_usuarios);
			break;

		case 'buscarpartidasfacturar':
			$RFC = $_POST['RFC'];
			$remisiones = json_decode($_POST['remisiones']);
			buscarpartidasfacturar($remisiones, $RFC, $conexion_usuarios);
			break;
	}

	function buscarpartidasfacturar($remisiones, $RFC, $conexion_usuarios){
		foreach ($remisiones as &$remision) {
			$query = "SELECT cotizacionherramientas.*, unidades.Clave FROM cotizacionherramientas INNER JOIN unidades ON unidades.descripcion=cotizacionherramientas.Unidad WHERE remision = '$remision'";
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
						'ClaveUnidad' => $data['Clave'],
						'Unidad' => $data['Unidad'],
						'ValorUnitario' => round($data['precioLista'],2),
						'Descripcion' => utf8_encode("SKU: ".$data['modelo']."/ ".$data['descripcion'])." Aduana: Nuevo Laredo, "."Fecha: ".date("d-m-Y"),
						'Descuento' => 0,
						'Impuestos' => $traslados,
						'Aduana' => $data['Pedimento']
					);
				}else{
					$arreglo['data'][] = array(
						'ClaveProdServ' => $data['ClaveProductoSAT'],
						'NoIdentificacion' => $data['modelo'],
						'Cantidad' => $data['cantidad'],
						'ClaveUnidad' => $data['Clave'],
						'Unidad' => $data['Unidad'],
						'ValorUnitario' => round($data['precioLista'],2),
						'Descripcion' => utf8_encode("SKU: ".$data['modelo']."/ ".$data['descripcion']),
						'Descuento' => 0,
						'Impuestos' => $traslados
						);
				}
				unset($traslados);
			}
		}
		// if ($numeroPedido == "") {
		// 	$numeroPedido = "null";
		// }
		// $query = "SELECT * FROM cotizacionherramientas WHERE numeroPedido = '$numeroPedido'";
		// $resultado = mysqli_query($conexion_usuarios, $query);
		//
		// if(mysqli_num_rows($resultado) > 0){
		// 	while ($data = mysqli_fetch_assoc($resultado)) {
		// 		$traslados = Array();
		// 		$traslados['Traslados'][] = array(
		// 			'Base' => $data['precioLista'] * $data['cantidad'],
		// 			'Impuesto' => "002",
		// 			'TipoFactor' => "Tasa",
		// 			'TasaOCuota' => 0.1600,
		// 			'Importe' => ($data['precioLista'] * $data['cantidad']) * 0.1600
		// 		);
		// 		// $retenidos['Retenidos'][] = array(
		// 		// 	'Base' => $data['precioLista'] * $data['cantidad'],
		// 		// 	'Impuesto' => 002,
		// 		// 	'TipoFactor' => "Tasa",
		// 		// 	'TasaOCuota' => 0.16,
		// 		// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
		// 		// );
		// 		// $locales['Locales'][] = array(
		// 		// 	'Base' => $data['precioLista'] * $data['cantidad'],
		// 		// 	'Impuesto' => 002,
		// 		// 	'TipoFactor' => "Tasa",
		// 		// 	'TasaOCuota' => 0.16,
		// 		// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
		// 		// );
		// 		if ($data['Pedimento'] != '') {
		// 			$Partes = "{}";
		// 			$arreglo['data'][] = array(
		// 				'ClaveProdServ' => $data['ClaveProductoSAT'],
		// 				'NoIdentificacion' => $data['modelo'],
		// 				'Cantidad' => $data['cantidad'],
		// 				'ClaveUnidad' => "E48",
		// 				'Unidad' => "Unidad de servicio",
		// 				'ValorUnitario' => round($data['precioLista'],2),
		// 				'Descripcion' => $data['descripcion']." Aduana: Nuevo Laredo, "."Fecha: ".date("d-m-Y"),
		// 				'Descuento' => 0,
		// 				'Impuestos' => $traslados,
		// 				'Aduana' => $data['Pedimento']
		// 			);
		// 		}else{
		// 			$arreglo['data'][] = array(
		// 				'ClaveProdServ' => $data['ClaveProductoSAT'],
		// 				'NoIdentificacion' => $data['modelo'],
		// 				'Cantidad' => $data['cantidad'],
		// 				'ClaveUnidad' => "E48",
		// 				'Unidad' => "Unidad de servicio",
		// 				'ValorUnitario' => round($data['precioLista'],2),
		// 				'Descripcion' => $data['descripcion'],
		// 				'Descuento' => 0,
		// 				'Impuestos' => $traslados
		// 			);
		// 		}
		//
		// 	}
		// }else{
		// 	$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$cotizacionRef'";
		// 	$resultado = mysqli_query($conexion_usuarios, $query);
		// 	$base = 0;
		// 	while ($data = mysqli_fetch_assoc($resultado)) {
		// 		$traslados['Traslados'][] = array(
		// 			'Base' => $data['precioLista'] * $data['cantidad'],
		// 			'Impuesto' => "002",
		// 			'TipoFactor' => "Tasa",
		// 			'TasaOCuota' => 0.1600,
		// 			'Importe' => ($data['precioLista'] * $data['cantidad']) * 0.1600
		// 		);
		// 		// $retenidos['Retenidos'][] = array(
		// 		// 	'Base' => $data['precioLista'] * $data['cantidad'],
		// 		// 	'Impuesto' => 002,
		// 		// 	'TipoFactor' => "Tasa",
		// 		// 	'TasaOCuota' => 0.16,
		// 		// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
		// 		// );
		// 		// $locales['Locales'][] = array(
		// 		// 	'Base' => $data['precioLista'] * $data['cantidad'],
		// 		// 	'Impuesto' => 002,
		// 		// 	'TipoFactor' => "Tasa",
		// 		// 	'TasaOCuota' => 0.16,
		// 		// 	'Importe' => ($data['precioLista'] * $data['cantidad']) + ($data['precioLista'] * $data['cantidad'] * 0.16)
		// 		// );
		// 		if ($data['Pedimento'] != '') {
		// 			$Partes = "{}";
		// 			$arreglo['data'][] = array(
		// 				'ClaveProdServ' => $data['ClaveProductoSAT'],
		// 				'NoIdentificacion' => $data['modelo'],
		// 				'Cantidad' => $data['cantidad'],
		// 				'ClaveUnidad' => "E48",
		// 				'Unidad' => "Unidad de servicio",
		// 				'ValorUnitario' => round($data['precioLista'],2),
		// 				'Descripcion' => $data['descripcion']." Aduana: Nuevo Laredo, "."Fecha: ".date("d-m-Y"),
		// 				'Descuento' => 0,
		// 				'Impuestos' => $traslados,
		// 				'Aduana' => $data['Pedimento']
		// 			);
		// 		}else{
		// 			$arreglo['data'][] = array(
		// 				'ClaveProdServ' => $data['ClaveProductoSAT'],
		// 				'NoIdentificacion' => $data['modelo'],
		// 				'Cantidad' => $data['cantidad'],
		// 				'ClaveUnidad' => "E48",
		// 				'Unidad' => "Unidad de servicio",
		// 				'ValorUnitario' => round($data['precioLista'],2),
		// 				'Descripcion' => $data['descripcion'],
		// 				'Descuento' => 0,
		// 				'Impuestos' => $traslados
		// 			);
		// 		}
		// 		unset($traslados);
		// 	}
		// }

		$query = "SELECT * FROM contactos WHERE RFC = '$RFC'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcfdi = $data['IdUsoCFDI'];
			$idformapago = $data['IdFormaPago'];
			$idmetodopago = $data['IdMetodoPago'];
			if ($data['CondPago'] == 0 || $data['CondPago'] == "") {
				$arreglo['condpago'] = "Contado";
			}else{
				$arreglo['condpago'] = $data['CondPago']." dias";
			}
		}
		//
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
		//
		// $query = "SELECT * FROM tipocambio WHERE fecha = '$fecha'";
		// $resultado = mysqli_query($conexion_usuarios, $query);
		// while($data = mysqli_fetch_assoc($resultado)){
		// 	$arreglo['tipocambio'] = $data['tipocambio'];
		// }

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function herramientas_remisiones($remisiones, $conexion_usuarios){
		$i = 1;
		foreach ($remisiones as &$remision) {
			$query = "SELECT * FROM cotizacionherramientas WHERE remision='$remision'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][]=array(
				'id' => $data['id'],
				'indice' => $i,
				'enviado' => $data['enviadoFecha'],
				'recibido' => $data['recibidoFecha'],
				'marca' => $data['marca'],
				'modelo' => $data['modelo'],
				'cantidad' => $data['cantidad'],
				'precioUnitario' => "$ ".($data['precioLista'] + $data['flete']),
				'descripcion' => utf8_encode($data['descripcion']),
				'precioTotal' => "$ ".($data['precioLista'] + $data['flete']) * $data['cantidad']
				);
			}
			$i++;
		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function buscardatos($RFC, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE RFC = '$RFC'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['cliente'] = $data;
			$idcliente = $data['id'];
		}

		$query = "SELECT Cuenta FROM cuentasclientes WHERE Cuenta != '' AND Cuenta != 'N/A' AND IdContacto = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$cuenta = $data['Cuenta'];
		}

		$fecha = date("Y-m-d");
		$query = "SELECT tipocambio FROM tipocambio WHERE fecha = '$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tipoCambio = $data['tipocambio'];
		}

		$informacion['tipoCambio'] = $tipoCambio;
		$informacion['cuenta'] = $cuenta;

		echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
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

	function buscar_clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Cliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
	}

	function nueva_remision($idcontacto, $conexion_usuarios){
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

		$query = "SELECT nombreEmpresa, moneda FROM contactos WHERE id = '$idcontacto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['cliente'] = $data['nombreEmpresa'];
			$arreglo['moneda'] = $data['moneda'];
		}
		echo json_encode($arreglo);
	}

	function datosusuario($idusuario, $conexion_usuarios){
		$query = "SELECT * FROM usuarios WHERE id = '$idusuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["datosusuario"] = array_map("utf8_encode", $data);
 			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_datos_cliente($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id ='".$idcliente."'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['data'] = $data;
		}
		echo json_encode($informacion);
		mysqli_free_result($resultado);
		cerrar($conexion_usuarios);
	}

	function nueva_cotizacion($conexion_usuarios){
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

     	$arreglo['resultado'] = "ok";
		$arreglo['numeroCotizacion'] = $numeroCotizacion;
		$arreglo['fecha'] = date("Y-m-d");
		echo json_encode($arreglo);
		cerrar($conexion_usuarios);
	}

	function buscar_contactos($idcliente, $conexion_usuarios){
		$query = "SELECT personaContacto FROM contactospersonas WHERE empresa ='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			while($data = mysqli_fetch_array($resultado)){
				$informacion[] = utf8_encode($data['personaContacto']);
			}
		}else{
			$informacion["respuesta"] = "Ninguno";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function informacion_contacto($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['contacto'] = $data;
		}

		echo json_encode($arreglo);
	}

	function cuentas_banco($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM cuentasclientes WHERE IdContacto = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo['data'][] = array(
					'id' => $data['IdCuenta'],
					'indice' => $i,
					'cuenta' => $data['Cuenta'],
					'moneda' => $data['moneda']
				);

				$i++;
			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

?>
