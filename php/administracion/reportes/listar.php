<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion = [];

	switch ($opcion) {
		case 'reporteventas':
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			$folioinicio = $_POST['folioinicio'];
			$foliofin = $_POST['foliofin'];
			$status = $_POST['status'];

      if ($filtromes != "todo") {
  			$fechainicio = $filtroano.'-'.$filtromes.'-01';
  			$fechafin = $filtroano.'-'.$filtromes.'-31';
  		}else{
  			$fechainicio = $filtroano.'-01-01';
  			$fechafin = $filtroano.'-12-31';
  		}

			reporteventas($fechainicio, $fechafin, $folioinicio, $foliofin, $status, $conexion_usuarios);
			break;

		case 'reportecobranza':
			$fechainicio = $_POST['fechainicio'];
			$fechafin = $_POST['fechafin'];
			$status = $_POST['status'];
			reportecobranza($fechainicio, $fechafin, $status, $conexion_usuarios);
			break;

		case 'reportebancos':
			$fechainicio = $_POST['fechainicio'];
			$fechafin = $_POST['fechafin'];
			$banco = $_POST['banco'];
			reportebancos($fechainicio, $fechafin, $banco, $conexion_usuarios);
			break;

		case 'reportecomisiones':
			$fechainicio = $_POST['fechainicio'];
			$fechafin = $_POST['fechafin'];
			$vendedor = $_POST['vendedor'];
			reportecomisiones($fechainicio, $fechafin, $vendedor, $conexion_usuarios);
			break;
	}

  function reporteventas ($fechainicio, $fechafin, $folioinicio, $foliofin, $status, $conexion_usuarios){
		switch ($status) {
			case 'todo':
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND folio<='$foliofin'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin'";
				}
				break;

			case 'enviada':
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND folio<='$foliofin' AND status='abonada'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin' AND status='abonada'";
				}
				break;

			case 'abonado':
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND folio<='$foliofin' AND status='enviada'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin' AND status='enviada'";
				}
				break;

			case 'pagada':
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND folio<='$foliofin' AND status='pagada'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin' AND status='pagada'";
				}
				break;

			case 'cancelada':
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND folio<='$foliofin' AND status='cancelada'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin' AND status='cancelada'";
				}
				break;

			default:
				if ($folioinicio |= "" && $foliofin != "") {
					$queryfacturas = "SELECT * FROM facturas WHERE folio>='$folioinicio' AND fecha<='$foliofin'";
				}else{
					$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin'";
				}
				break;
		}

    $resultadofacturas = mysqli_query($conexion_usuarios, $queryfacturas);

    while ($data = mysqli_fetch_assoc($resultadofacturas)){
			$factura = $data['folio'];
			$fechafactura = $data['fecha'];

			$query2 = "SELECT payments.date, payments.account, accounts.nombre FROM payments INNER JOIN accounts ON accounts.id = payments.account WHERE payments.factura='$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);

			if (!$resultado2 || mysqli_num_rows($resultado2) < 1 || mysqli_num_rows($resultado2) == null) {
				$banco = "";
				$fechapago = "";
			}else{
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$banco = $data2['nombre'];
					$fechapago = $data2['date'];
				}
			}

			$query3 = "SELECT * FROM cotizacion WHERE factura = '$factura'";
			$resultado3 = mysqli_query($conexion_usuarios, $query3);

			if (!$resultado3 || mysqli_num_rows($resultado3) < 1 || mysqli_num_rows($resultado3) == null) {
				$moneda = "";
			}else{
				$data3 = mysqli_fetch_assoc($resultado3);
				$moneda = $data3['moneda'];
			}

			$query4 = "SELECT * FROM abonos WHERE deFactura = '$factura'";
			$resultado4 = mysqli_query($conexion_usuarios, $query4);

			$notadecredito = "";

			if (mysqli_num_rows($resultado4) < 1 || mysqli_num_rows($resultado4) == null) {
				$notacredito = "";
				$pagado = $data['pagado'];
			}else{
				while($data4 = mysqli_fetch_assoc($resultado4)){
					$folio = $data4['numero'];
					$valor = $data4['valor'];
					$deFactura = $data4['deFactura'];
					$notacredito = "FOLIO: ".$folio." "."FACTURA: ".$deFactura." "."MONTO: ".$valor;
					$pagado = $data['pagado'] + $valor;
				}
			}

			if ($moneda == "mxn") {
				$tipocambio = "1.00";
			}else{
				$query5 = "SELECT tipocambio FROM tipocambio WHERE fecha = '$fechafactura'";
				$resultado5 = mysqli_query($conexion_usuarios, $query5);

				if (mysqli_num_rows($resultado5) < 1 || mysqli_num_rows($resultado5) == null) {
					$tipocambio = "";
				}else{
					while($data5 = mysqli_fetch_assoc($resultado5)){
						$tipocambio = $data5['tipocambio'];
					}
				}
			}

			$mniva = ($data['subtotal'] * .16) * $tipocambio;
			$mnsubtotal = $data['subtotal'] * $tipocambio;
			$mntotal = $data['total'] * $tipocambio;

			if ($data['status'] == "cancelada") {
				$arreglo['data'][] = array(
					'factura' => $data['folio'],
					'fecha' => $data['fecha'],
					'cliente' => strtoupper($data['cliente']),
					'status' => strtoupper($data['status']),
					'moneda' => "",
					'tipocambio' => "",
					'iva' => "",
					'subtotal' => "",
					'total' => "",
					'pagado' => "",
					'banco' => "",
					'fechapago' => "",
					'notacredito' => "",
					'uid' => $data['UID'],
					'uuid' => $data['UUID'],
					'mniva' => "",
					'mnsubtotal' => "",
					'mntotal' => ""
				);
			}else{
				$arreglo['data'][] = array(
					'factura' => $data['folio'],
					'fecha' => $data['fecha'],
					'cliente' => utf8_encode($data['cliente']),
					'status' => $data['status'],
					'moneda' => strtoupper($moneda),
					'tipocambio' => $tipocambio,
					'iva' => "$ ".round($data['subtotal'] * .16, 2),
					'subtotal' => "$ ".$data['subtotal'],
					'total' => "$ ".$data['total'],
					'pagado' => "$ ".$pagado,
					'banco' => $banco,
					'fechapago' => $fechapago,
					'notacredito' => $notacredito,
					'uid' => $data['UID'],
					'uuid' => $data['UUID'],
					'mniva' => round($mniva, 2),
					'mnsubtotal' => round($mnsubtotal, 2),
					'mntotal' => round($mntotal, 2)
				);
			}
		}

    // $querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE facturaFecha>='$fechainicio' AND facturaFecha<='$fechafin'";
    // $resultadocotizacion = mysqli_query($conexion_usuarios, $querycotizacion);
		//
    // while ($data = mysqli_fetch_assoc($resultadocotizacion)){
		// 	$factura = $data['factura'];
		//
		// 	$query2 = "SELECT payments.date, payments.account, accounts.nombre FROM payments INNER JOIN accounts ON accounts.id = payments.account WHERE payments.factura='$factura'";
		// 	$resultado2 = mysqli_query($conexion_usuarios, $query2);
		//
		// 	if (!$resultado2 || mysqli_num_rows($resultado2) < 1 || mysqli_num_rows($resultado2) == null) {
		// 		$banco = "";
		// 		$fechapago = "";
		// 		$notacredito = "";
		// 	}else{
		// 		while($data2 = mysqli_fetch_assoc($resultado2)){
		// 			$banco = $data2['nombre'];
		// 			$fechapago = $data2['date'];
		// 			$notacredito = "";
		// 		}
		// 	}
		//
    //   $arreglo['data'][] = array(
    //     'factura' => $data['factura'],
    //     'fecha' => $data['facturaFecha'],
    //     'cliente' => utf8_encode($data['nombreEmpresa']),
    //     'moneda' => strtoupper($data['moneda']),
    //     'iva' => "$ ".$data['precioTotal'] * .16,
    //     'subtotal' => "$ ".$data['precioTotal'],
    //     'total' => "$ ".$data['precioTotal'] * 1.16,
    //     'pagado' => "$ ".$data['Pagado'],
    //     'banco' => $banco,
    //     'fechapago' => $fechapago,
    //     'notacredito' => $notacredito
    //   );
    // }


		if (mysqli_num_rows($resultadofacturas) < 1) {
			$arreglo['data'] = 0;
		}

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function reportecobranza ($fechainicio, $fechafin, $status, $conexion_usuarios) {
		$fechahoy = date("Y-m-d");
		$query = "SELECT facturas.*, contactos.CondPago FROM facturas INNER JOIN contactos ON contactos.nombreEmpresa = facturas.cliente WHERE fecha>='$fechainicio' AND fecha<='$fechafin' AND pagado!=total AND status!='cancelada' ORDER BY folio ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$i = 1;
		while($data = mysqli_fetch_assoc($resultado)){
			$factura = $data['folio'];

			$query2 = "SELECT * FROM cotizacion WHERE factura='$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);

			if (mysqli_num_rows($resultado2) < 1) {
				$moneda = "";
			}else{
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$moneda = $data2['moneda'];
				}
			}

			if ($data['CondPago'] == 0) {
				$fecha = $data['fecha'];
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
				$vencimiento = date ( 'Y-m-d' , $nuevafecha );
			}else{
				$fecha = $data['fecha'];
				$nuevafecha = strtotime ( '+'.$data['CondPago'].' day' , strtotime ( $fecha ) ) ;
				$vencimiento = date ( 'Y-m-d' , $nuevafecha );
			}

			if ($status == "vencida" && $vencimiento < $fechahoy) {
				$arreglo['data'][] = array(
					"indice" => $i,
					"factura" => $data['folio'],
					"fecha" => $fecha,
					"cliente" => $data['cliente'],
					"moneda" => strtoupper($moneda),
					"total" => "$ ".$data['total'],
					"pagado" => "$ ".$data['pagado'],
					"credito" => $data['CondPago']." días",
					"vencimiento" => $vencimiento
				);
				$i++;
			}
			if ($status == "porvencer" && $vencimiento > $fechahoy) {
				$arreglo['data'][] = array(
					"indice" => $i,
					"factura" => $data['folio'],
					"fecha" => $fecha,
					"cliente" => $data['cliente'],
					"moneda" => strtoupper($moneda),
					"total" => "$ ".$data['total'],
					"pagado" => "$ ".$data['pagado'],
					"credito" => $data['CondPago']." días",
					"vencimiento" => $vencimiento
				);
				$i++;
			}

		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function reportebancos($fechainicio, $fechafin, $banco, $conexion_usuarios) {
		$query = "SELECT DISTINCT client, date FROM payments WHERE account = '$banco' AND date >= '$fechainicio' AND date <= '$fechafin' ORDER BY date ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['client'];
				$fecha = $data['date'];

				$query2 = "SELECT payments.*, contactos.nombreEmpresa FROM payments INNER JOIN contactos ON contactos.id = payments.client WHERE client = '$idcliente' AND date = '$fecha'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				$facturas = "";
				$cantidadtotal = "";
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$fecha = $data2['date'];
					$facturas = $facturas." ".$data2['factura'];
					$cliente = $data2['nombreEmpresa'];
					$cantidadtotal = $cantidadtotal + $data2['amount'];
				}

				$arreglo['data'][] = array(
					'fecha' => $fecha,
					'factura' => $facturas,
					'cliente' => $cliente,
					'cantidadtotal' => "$ ".$cantidadtotal
				);
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function reportecomisiones($fechainicio, $fechafin, $vendedor, $conexion_usuarios){
		$query = "SELECT clientes_de_vendedor.id_cliente, contactos.nombreEmpresa FROM clientes_de_vendedor INNER JOIN contactos ON contactos.id = clientes_de_vendedor.id_cliente WHERE id_vendedor = '$vendedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['id_cliente'];
				$cliente = $data['nombreEmpresa'];

				$query2 = "SELECT payments.*, facturas.subtotal, facturas.total, facturas.fecha, accounts.nombre FROM payments INNER JOIN facturas ON facturas.folio = payments.factura INNER JOIN accounts ON accounts.id = payments.account WHERE payments.client = '$idcliente' AND payments.date >= '$fechainicio' AND payments.date <= '$fechafin' ORDER BY date";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				while($data2 = mysqli_fetch_assoc($resultado2)){
					$fecha = $data2['date'];

					$query3 = "SELECT tipocambio FROM tipocambio WHERE fecha='$fecha'";
					$resultado3 = mysqli_query($conexion_usuarios, $query3);
					$data3 = mysqli_fetch_assoc($resultado3);
					$tipocambio = $data3['tipocambio'];

					if ($data2['currency'] == "usd") {
						$subtotal = ($data2['subtotal'] * $tipocambio);
						$iva = ($data2['subtotal'] * $tipocambio) * .16;
						$total = ($data2['total'] * $tipocambio);
					}else{
						$subtotal = $data2['subtotal'];
						$iva = $data2['subtotal']* .16;
						$total = $data2['total'];
						$tipocambio = 1.00;
					}

					$arreglo['data'][] = array(
						'indice' => $i,
						'banco' => $data2['nombre'],
						'fecha' => $data2['date'],
						'factura' => $data2['factura'],
						'cliente' => $cliente,
						'moneda' => $data2['currency'],
						'tipocambio' => $tipocambio,
						'importe' => round($subtotal, 2),
						'iva' => round($iva, 2),
						'total' => round($total, 2)
					);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}
?>
