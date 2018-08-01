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

    case 'querypayments':
      // $json = $_POST['lista'];
      // $data = json_decode($json);
      // $indice = $_POST['indice'];
      query_payments($conexion_usuarios);
      break;
	}

  function query_payments($conexion_usuarios){
    // $conexion_usuarios = mysqli_connect("18.236.250.216", "hemusadb", "Hemusa@2017", "hemusapruebas");
    mysqli_select_db($conexion_usuarios, "hemusapruebas2");
    $query = "SELECT * FROM cotizacion WHERE fecha>='2018-05-01' AND fecha<='2018-05-31' ORDER BY fecha ASC";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_assoc($resultado)){
      $idcotizacion = $data['id'];
      $factura = $data['factura'];
      $facturaFecha = $data['facturaFecha'];

      $arreglo['data'][] = array(
        'id' => $idcotizacion,
        'factura' => $factura,
        'facturaFecha' => $facturaFecha
      );
    }
    mysqli_select_db($conexion_usuarios, "hemusa");
    $length = count($arreglo['data']);
    for ($i=0; $i <=$length ; $i++) {
      $arreglo2['data'][] = array(
        'id2' => $arreglo['data'][$i]['id'],
        'factura2' => $arreglo['data'][$i]['factura'],
        'facturaFecha2' =>$arreglo['data'][$i]['facturaFecha']
      );

      $idcotizacion = $arreglo['data'][$i]['id'];
      $factura = $arreglo['data'][$i]['factura'];
      $facturaFecha = $arreglo['data'][$i]['facturaFecha'];

      $query = "UPDATE cotizacion SET factura='$factura', facturaFecha='$facturaFecha' WHERE id='$idcotizacion'";
      $resultado = mysqli_query($conexion_usuarios, $query);
    }


    // while($data = mysqli_fetch_assoc($resultado)){
    //   $idcotizacion = $data['id'];
    //   $factura = $data['factura'];
    //   $facturaFecha = $data['facturaFecha'];
    //
    //   $arreglo2['data'][] = array(
    //     'id' => $idcotizacion,
    //     'factura' => $factura,
    //     'facturaFecha' => $facturaFecha
    //   );
    // }


    echo json_encode($arreglo2);

    // $query = "SELECT * FROM payments WHERE factura >= 22508 AND factura <= 22876";
    // $resultado = mysqli_query($conexion_usuarios, $query);
    // $i = 1;
    // while($data = mysqli_fetch_assoc($resultado)){
    //   $idcliente = $data['client'];
    //   $factura = $data['factura'];
    //   $total = $data['amount'];
    //
    //   $query2 = "UPDATE cotizacion SET factura='0', facturaFecha='0000-00-00' WHERE cliente='$idcliente' AND Pagado='$total'  AND fechaEntregado>='2017-03-01' AND fechaEntregado<='2017-03-31'";
    //   $resultado2=mysqli_query($conexion_usuarios, $query2);
    //
    //   $query2 = "UPDATE cotizacion SET factura='$factura', Pedido=fechaEntregado WHERE cliente='$idcliente' AND Pagado='$total' AND factura='0' AND facturaFecha='0000-00-00'";
    //   $resultado2=mysqli_query($conexion_usuarios, $query2);
    //
    //   $arreglo['data'][] = array(
    //     'indice' => $i
    //   );
    //   $i++;
    // }
    //
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
