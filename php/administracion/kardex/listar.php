<?php
	include("../../conexion.php");

	$opcion = $_POST['estado'];
	$informacion = [];

	switch ($opcion) {
		case 'pedido':
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $fechainicio = $_POST['fechainicio'];
      $fechafin = $_POST['fechafin'];
			listarpedidos($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios);
			break;

    case 'compra':
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $fechainicio = $_POST['fechainicio'];
      $fechafin = $_POST['fechafin'];
			listarcompras($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios);
			break;

    case 'venta':
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $fechainicio = $_POST['fechainicio'];
      $fechafin = $_POST['fechafin'];
      listarventas($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios);
      break;
	}

  function listarpedidos($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios){
    $query = "SELECT cotizacionherramientas.*, cotizacion.NoPedClient, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE marca='$marca' AND modelo='$modelo' AND pedidoFecha != '0000-00-00' AND pedidoFecha>='$fechainicio' AND pedidoFecha<='$fechafin'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){
        $arreglo['data'][] = array(
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'descripcion' => $data['descripcion'],
          'cantidad' => $data['cantidad'],
          'fechapedido' => $data['pedidoFecha'],
          'proveedor' => $data['Proveedor'],
          'cliente' => $data['nombreEmpresa'],
					'pedidocliente' => $data['NoPedClient']
        );
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
  	mysqli_close($conexion_usuarios);
  }

  function listarcompras($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios){
    $query = "SELECT cotizacionherramientas.*, utilidad_pedido.moneda_pedido, utilidad_pedido.costo_mn, utilidad_pedido.costo_usd, utilidad_pedido.orden_compra, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN utilidad_pedido ON utilidad_pedido.id_cotizacion_herramientas=cotizacionherramientas.id INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE cotizacionherramientas.marca='$marca' AND cotizacionherramientas.modelo='$modelo'
     AND cotizacionherramientas.recibidoFecha != '0000-00-00' AND cotizacionherramientas.recibidoFecha>='$fechainicio' AND cotizacionherramientas.recibidoFecha<='$fechafin'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){
        if ($data['moneda_pedido'] == "mxn") {
          $costo = $data['costo_mn'];
        }else{
          $costo = $data['costo_usd'];
        }

        $arreglo['data'][] = array(
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'descripcion' => $data['descripcion'],
          'cantidad' => $data['cantidad'],
          'ordencompra' => $data['orden_compra'],
          'cliente' => $data['nombreEmpresa'],
          'recibido' => $data['recibidoFecha'],
          'costo' => "$ ".round($costo, 2),
          'moneda' => strtoupper($data['moneda_pedido'])
        );
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
  	mysqli_close($conexion_usuarios);
  }

  function listarventas($marca, $modelo, $fechainicio, $fechafin, $conexion_usuarios){
    $query = "SELECT cotizacionherramientas.*, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE marca='$marca' AND modelo='$modelo' AND Entregado != '0000-00-00' AND Entregado>='$fechainicio' AND Entregado<='$fechafin'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){
        $idcotizacion = $data['factura'];
        if ($data['remision'] == '0' || $data['remision'] == '') {
          $remision = "";
        }else{
          $remision = $data['remision'];
        }

				if ($data['factura'] == "0" || $data['factura'] == "") {
					$factura = "";
				}else{
					$query2 = "SELECT factura FROM cotizacion WHERE id = '$idcotizacion'";
					$resultado2 = mysqli_query($conexion_usuarios, $query2);

					if (mysqli_num_rows($resultado2) < 1) {
						$factura = $data['factura'];
					}else{
						while($data2 = mysqli_fetch_assoc($resultado2)){
							$factura = $data2['factura'];
						}
					}
				}


        $arreglo['data'][] = array(
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'descripcion' => $data['descripcion'],
          'cantidad' => $data['cantidad'],
          'cliente' => $data['nombreEmpresa'],
          'proveedor' => $data['Proveedor'],
          'precioventa' => "$ ".$data['precioLista'],
          'moneda' => strtoupper($data['moneda']),
          'entregado' => $data['Entregado'],
          'remision' => $remision,
          'factura' => $factura
        );
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
  	mysqli_close($conexion_usuarios);
  }
?>
