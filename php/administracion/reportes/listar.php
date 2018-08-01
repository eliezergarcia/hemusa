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
    // mysqli_select_db($conexion_usuarios, "hemusa");
    $query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON  contactos.id = cotizacion.cliente WHERE factura != '' AND factura != '0' AND facturaFecha>='$fechainicio' AND facturaFecha<='$fechafin' ORDER BY factura ASC";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while ($data = mysqli_fetch_assoc($resultado)){
				$factura = $data['factura'];

				$query2 = "SELECT payments.date, payments.account, accounts.nombre FROM payments INNER JOIN accounts ON accounts.id = payments.account WHERE payments.factura='$factura'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				if (!$resultado2) {
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
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
  }
?>
