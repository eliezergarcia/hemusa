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
	}

  function reporteventas ($fechainicio, $fechafin, $folioinicio, $foliofin, $status, $conexion_usuarios) {
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

			$query2 = "SELECT payments.date, payments.account, accounts.nombre FROM payments INNER JOIN accounts ON accounts.id = payments.account WHERE payments.factura='$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);

			if (!$resultado2 || mysqli_num_rows($resultado2) < 1 || mysqli_num_rows($resultado2) == null) {
				$banco = "";
				$fechapago = "";
				$notacredito = "";
			}else{
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$banco = $data2['nombre'];
					$fechapago = $data2['date'];
					$notacredito = "";
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

			if ($data['status'] == "cancelada") {
				$arreglo['data'][] = array(
					'factura' => $data['folio'],
					'fecha' => $data['fecha'],
					'cliente' => strtoupper($data['status']),
					'moneda' => "",
					'iva' => "",
					'subtotal' => "",
					'total' => "",
					'pagado' => "",
					'banco' => "",
					'fechapago' => "",
					'notacredito' => "",
					'uid' => $data['UID'],
					'uuid' => $data['UUID']
				);
			}else{
				$arreglo['data'][] = array(
					'factura' => $data['folio'],
					'fecha' => $data['fecha'],
					'cliente' => utf8_encode($data['cliente']),
					'moneda' => strtoupper($moneda),
					'iva' => "$ ".$data['total'] * .16,
					'subtotal' => "$ ".$data['subtotal'],
					'total' => "$ ".$data['total'],
					'pagado' => "$ ".$data['pagado'],
					'banco' => $banco,
					'fechapago' => $fechapago,
					'notacredito' => $notacredito
					'uid' => $data['UID'],
					'uuid' => $data['UUID']
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
?>
