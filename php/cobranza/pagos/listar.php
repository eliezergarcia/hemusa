<?php
	include('../../conexion.php');
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'informacionfactura':
			$factura = $_POST['factura'];
			informacion_factura($factura, $conexion_usuarios);
			break;

    case 'herramientafactura':
			$factura = $_POST['factura'];
			herramienta_factura($factura, $conexion_usuarios);
			break;
  }

  function informacion_factura($factura, $conexion_usuarios){
    $query = "SELECT * FROM facturas WHERE folio = '$factura'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){

        $query2 = "SELECT * FROM cotizacion WHERE factura='$factura'";
        $resultado2 = mysqli_query($conexion_usuarios, $query2);

        if (mysqli_num_rows($resultado2) < 1) {
          $moneda = "";
        }else{
          while($data2 = mysqli_fetch_assoc($resultado2)){
            $moneda = $data2['moneda'];
          }
        }

        $query3 = "SELECT payments.*, accounts.nombre FROM payments INNER JOIN accounts ON accounts.id = payments.account WHERE factura = '$factura'";
        $resultado3 = mysqli_query($conexion_usuarios, $query3);

        if (mysqli_num_rows($resultado3) < 1) {
          $monedapago = "";
          $banco = "";
          $fechapago = "";
        }else{
          while($data3 = mysqli_fetch_assoc($resultado3)){
            $monedapago = $data3['currency'];
            $banco = $data3['nombre'];
            $fechapago = $data3['date'];
          }
        }


        $arreglo['data'][] = array(
          'factura' => $data['folio'],
          'fechafactura' => $data['fecha'],
          'cliente' => $data['cliente'],
          'subtotal' => "$ ".$data['subtotal'],
          'iva' => "$ ".$data['subtotal'] * .16,
          'total' => "$ ".$data['total'],
          'moneda' => $moneda,
          'pagado' => $data['pagado'],
          'monedapago' => $monedapago,
          'banco' => $banco,
          'fechapago' => $fechapago,
        );
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }

  function herramienta_factura($factura, $conexion_usuarios){
    $query = "SELECT * FROM utilidad_pedido WHERE factura_hemusa='$factura'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      $i = 1;
      while ($data = mysqli_fetch_assoc($resultado)){
        if ($data['remision'] == 0){
          $remision = "";
        }else{
          $remision = $data['remision'];
        }

        $arreglo['data'][] = array(
          'indice' => $i,
          'remision' => $remision,
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'cantidad' => $data['cantidad'],
          'folio' => $data['folio'],
          'fecharecibido' => $data['fecha_llegada']
        );
        $i++;
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }
?>
