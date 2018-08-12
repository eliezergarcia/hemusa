<?php
  sleep(1);
	include ('../../conexion.php');
	include ('../../sesion.php');

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'query':
			$json = $_POST['lista'];
			$data = json_decode($json);
      $indice = $_POST['indice'];
			query($data, $indice, $conexion_usuarios);
			break;

    case 'query2':
			query2($conexion_usuarios);
			break;

    case 'querypayments':
      // $json = $_POST['lista'];
      // $indice = $_POST['indice'];
      $facturas = json_decode($_POST['facturas']);
      query_payments($facturas, $conexion_usuarios);
      // query_payments($conexion_usuarios);
      break;
	}

  function query2($conexion_usuarios){
    $query = "SELECT id, factura FROM cotizacion WHERE factura != 0";
    $resultado = mysqli_query($conexion_usuarios, $query);

    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo['data'][] = $data;

      $factura = $data['factura'];
      $idcotizacion = $data['id'];
      $query2 = "UPDATE cotizacionherramientas SET factura = '$factura' WHERE factura='$idcotizacion'";
      $resultado2 = mysqli_query($conexion_usuarios, $query2);
    }

    echo json_encode($arreglo);
    mysqli_close($conexion_usuarios);
  }

  function query_payments($facturas, $conexion_usuarios){

    $length = count($facturas);

    for ($i=0; $i <=$length ; $i++) {
      $fecha = $facturas[$i]->{'FechaTimbrado'};
      $folio = $facturas[$i]->{'Folio'};
      $ordenpedido = $facturas[$i]->{'NumOrder'};
      $cliente = $facturas[$i]->{'RazonSocialReceptor'};
      $status = $facturas[$i]->{'Status'};
      $subtotal = $facturas[$i]->{'Subtotal'};
      $total = $facturas[$i]->{'Total'};
      $uid = $facturas[$i]->{'UID'};
      $uuid = $facturas[$i]->{'UUID'};
      $factura = str_replace("H ","",$folio);

      $query = "SELECT amount FROM payments WHERE factura='$factura'";
      $resultado = mysqli_query($conexion_usuarios, $query);
      if (!$resultado || mysqli_num_rows($resultado)<1 || mysqli_num_rows($resultado)==null) {
        $pagado = "0.00";
      }else{
        $data = mysqli_fetch_assoc($resultado);
        $pagado = $data['amount'];
      }

      $query = "INSERT INTO facturas (folio, tipoDocumento, ordenpedido, subtotal, total, pagado, status, fecha, UID, UUID, cliente) VALUES ('$factura', 'factura', '$ordenpedido', '$subtotal', '$total', '$pagado', '$status', '$fecha', '$uid', '$uuid', '$cliente')";
      $resultado = mysqli_query($conexion_usuarios, $query);

      if (!$resultado || mysqli_num_rows($resultado)<1 || mysqli_num_rows($resultado)==null) {
      }else{
        echo json_encode($i);
      }
    }

    // mysqli_select_db($conexion_usuarios, "nuevo");
    // $query = "SELECT * FROM cotizacion WHERE fecha>='2018-07-01' AND fecha<='2018-07-31' AND remision = 0";
    // $resultado = mysqli_query($conexion_usuarios, $query);
    // while($data = mysqli_fetch_assoc($resultado)){
    //   $idcotizacion = $data['id'];
    //   $precioTotal = $data['precioTotal'];
    //   $partidas = $data['partidaCantidad'];
    //   $moneda = $data['moneda'];
    //
    //   $arreglo['data'][] = array(
    //     'id' => $idcotizacion,
    //     'precioTotal' => $precioTotal,
    //     'partidas' => $partidas,
    //     'moneda' => $moneda
    //   );
    // }
    // mysqli_select_db($conexion_usuarios, "hemusa20julio");
    // $length = count($arreglo['data']);
    // for ($i=0; $i <=$length ; $i++) {
    //   $arreglo2['data'][] = array(
    //     'id2' => $arreglo['data'][$i]['id'],
    //     'precioTotal2' => $arreglo['data'][$i]['precioTotal'],
    //     'partidas2' => $arreglo['data'][$i]['partidas'],
    //     'moneda2' => $arreglo['data'][$i]['moneda']
    //   );
    //
    //   $idcotizacion = $arreglo['data'][$i]['id'];
    //   $precioTotal = $arreglo['data'][$i]['precioTotal'];
    //   $partidas = $arreglo['data'][$i]['partidas'];
    //   $moneda = $arreglo['data'][$i]['moneda'];
    //
    //   $query = "UPDATE cotizacion SET precioTotal='$precioTotal', partidaCantidad='$partidas', moneda='$moneda' WHERE id='$idcotizacion'";
    //   $resultado = mysqli_query($conexion_usuarios, $query);
    // }
    //
    // echo json_encode($arreglo2);

    // $query = "SELECT cotizacion.factura, cotizacion.ref, facturas.subtotal FROM cotizacion INNER JOIN facturas ON facturas.folio = cotizacion.factura WHERE cotizacion.precioTotal='11083.22' AND cotizacion.remision= '0' AND cotizacion.factura!= '0'";
    // $query = "SELECT * FROM cotizacion WHERE precioTotal = '11083.22' AND remision = 0";
    // $resultado = mysqli_query($conexion_usuarios, $query);
    //
    // while($data = mysqli_fetch_assoc($resultado)){
    //   $ref = $data['ref'];
    //
    //   $query2 = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$ref'";
    //   $resultado2 = mysqli_query($conexion_usuarios, $query2);
    //
    //   $partidas = 0;
    //   $precioCotizacion = 0;
    //   while($data2 = mysqli_fetch_assoc($resultado2)){
    //     $precioCotizacion = $precioCotizacion + ($data2['precioLista'] * $data2['cantidad']);
    //     $partidas++;
    //   }
    //
    //   $arreglo['data'][] = array(
    //     'ref' => $data['ref'],
    //     'precioCotizacion' => $precioCotizacion,
    //     'precioFactura' => $data['subtotal'],
    //     'partidas' => $partidas
    //   );
    //
    //   $factura = $data['factura'];
    //   $precioTotal = round($precioCotizacion,2);
    //
    //   $query3 = "UPDATE cotizacion SET precioTotal='$precioTotal', partidaCantidad='$partidas' WHERE ref='$ref'";
    //   $resultado3 = mysqli_query($conexion_usuarios, $query3);
    // }

    // mysqli_select_db($conexion_usuarios, "hemusa2");
    // $query = "SELECT cotizacion.ref, cotizacion.fecha, cotizacionherramientas.cotizacionRef, cotizacionherramientas.marca, cotizacionherramientas.modelo FROM cotizacion INNER JOIN cotizacionherramientas ON cotizacionherramientas.cotizacionRef = cotizacion.ref WHERE cotizacion.fecha>='2018-07-21' AND cotizacion.fecha<='2018-07-31'";
    // $resultado = mysqli_query($conexion_usuarios, $query);
    // while($data = mysqli_fetch_assoc($resultado)){
    //   $arreglo['data'][] = array(
    //     'ref' => $data['cotizacionRef'],
    //     'marca' => $data['marca'],
    //     'modelo' => $data['modelo']
    //   );
    // }
    //
    echo json_encode($arreglo);
  }

  function query($data, $indice, $conexion_usuarios){
		$factura = $data->{'FOLIO'};
		$fecha = $data->{'FECHA'};
		$cliente = $data->{'CLIENTES'};
		$moneda = $data->{'MONEDA'};
		$status = $data->{'STATUS'};
		$iva = $data->{'IVA'};
		$subtotal = $data->{'BASE SUBTOTAL'};
		$total = $data->{'IMPORTE TOTAL'};
		$tc = $data->{'TC'};

    $total = str_replace(",",".",$total);
    $total = round($total, 2);
    if ($cliente == "CANCELADA") {
      $fechaFactura = $fecha;
    }else{
      $fecha = explode("/", $data->{'FECHA'});
      $fechaFactura = $fecha[2]."-".$fecha[1]."-".$fecha[0];
    }

    $informacion['fechaFactura'] = $fechaFactura;
    $informacion['factura'] = $factura;
    $informacion['indice'] = $indice;

    $query = "SELECT * FROM payments WHERE factura >= 22508 AND factura <= 22876 AND factura='$factura'";
    $resultado = mysqli_query($conexion_usuarios, $query);
    $i = 1;
    while($data = mysqli_fetch_assoc($resultado)){
      $idcliente = $data['client'];
      $factura = $data['factura'];
      $total = $data['amount'];

      // $query2 = "UPDATE cotizacion SET factura='0', facturaFecha='0000-00-00' WHERE cliente='$idcliente' AND Pagado='$total'";
      // $resultado2=mysqli_query($conexion_usuarios, $query2);

      $query2 = "UPDATE cotizacion SET factura='$factura', facturaFecha='$fechaFactura' WHERE cliente='$idcliente' AND Pagado='$total' AND fechaEntregado>='2017-03-01' AND fechaEntregado<='2017-03-31'";
      $resultado2=mysqli_query($conexion_usuarios, $query2);


      $arreglo['data'][] = array(
        'indice' => $i
      );
      $i++;
    }

    // if ($factura >= 22668 && $factura <= 22876){
    //   $query = "UPDATE cotizacion SET facturaFecha='$fechaFactura' WHERE factura='$factura' AND fechaEntregado>='2017-01-01' AND fechaEntregado<='2017-01-31'";
    //   $resultado = mysqli_query($conexion_usuarios, $query);
    // }


		echo json_encode($informacion);
    mysqli_close($conexion_usuarios);
	}

?>
