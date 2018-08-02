<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion = [];

	switch ($opcion) {
		case 'reporteventas':
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];

      if ($filtromes != "todo") {
  			$fechainicio = $filtroano.'-'.$filtromes.'-01';
  			$fechafin = $filtroano.'-'.$filtromes.'-31';
  		}else{
  			$fechainicio = $filtroano.'-01-01';
  			$fechafin = $filtroano.'-12-31';
  		}

			reporteventas($fechainicio, $fechafin, $conexion_usuarios);
			break;
	}

  function reporteventas ($fechainicio, $fechafin, $conexion_usuarios) {
		$queryfacturas = "SELECT * FROM facturas WHERE fecha>='$fechainicio' AND fecha<='$fechafin' ORDER BY folio ASC";
    $resultadofacturas = mysqli_query($conexion_usuarios, $queryfacturas);

    while ($data = mysqli_fetch_assoc($resultadofacturas)){
			$factura = $data['folio'];

			$query3 = "SELECT * FROM cotizacion WHERE factura='$factura'";
			$resultado3 = mysqli_query($conexion_usuarios, $query3);

			if (mysqli_num_rows($resultado3) < 1) {
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

				$arreglo['data'][] = array(
					'factura' => $data['folio'],
					'fecha' => $data['fecha'],
					'cliente' => $data['cliente'],
					'moneda' => strtoupper($data['moneda']),
					'iva' => "$ ".$data['total'] * .16,
					'subtotal' => "$ ".$data['total'] * .84,
					'total' => "$ ".$data['total'] * 1.16,
					'pagado' => "$ ".$data['pagado'],
					'banco' => $banco,
					'fechapago' => $fechapago,
					'notacredito' => $notacredito
				);
			}
    }

    $querycotizacion = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON  contactos.id = cotizacion.cliente WHERE factura != '' AND factura != '0' AND facturaFecha>='$fechainicio' AND facturaFecha<='$fechafin' AND factura != 'H 29770' ORDER BY factura ASC";
    $resultadocotizacion = mysqli_query($conexion_usuarios, $querycotizacion);

    while ($data = mysqli_fetch_assoc($resultadocotizacion)){
			$factura = $data['factura'];

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

      $arreglo['data'][] = array(
        'factura' => $data['factura'],
        'fecha' => $data['facturaFecha'],
        'cliente' => $data['nombreEmpresa'],
        'moneda' => strtoupper($data['moneda']),
        'iva' => "$ ".$data['precioTotal'] * .16,
        'subtotal' => "$ ".$data['precioTotal'],
        'total' => "$ ".$data['precioTotal'] * 1.16,
        'pagado' => "$ ".$data['Pagado'],
        'banco' => $banco,
        'fechapago' => $fechapago,
        'notacredito' => $notacredito
      );
    }


		if (mysqli_num_rows($resultadofacturas) < 1 && mysqli_num_rows($resultadocotizacion) < 1) {
			$arreglo['data'] = 0;
		}

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
  }
?>
