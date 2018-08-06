<?php
	include('../../conexion.php');
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'pagospendientescliente':
			$cliente = $_POST['idcliente'];
			pagos_pendientes_cliente($cliente, $conexion_usuarios);
			break;

		case 'pagadoscliente':
			$cliente = $_POST['idcliente'];
			pagados_cliente($cliente, $conexion_usuarios);
			break;

		case 'pagospendientesproveedor':
			$proveedor = $_POST['idproveedor'];
			pagos_pendientes_proveedor($proveedor, $conexion_usuarios);
			break;

		case 'informacionfactura':
			$factura = $_POST['factura'];
			informacion_factura($factura, $conexion_usuarios);
			break;

    case 'herramientafactura':
			$factura = $_POST['factura'];
			herramienta_factura($factura, $conexion_usuarios);
			break;

		case 'notascredito':
			$cliente = $_POST['cliente'];
			$fechainicio = $_POST['fechainicio'];
			$fechafin = $_POST['fechafin'];
			$folio = $_POST['folio'];
			notas_credito($cliente, $fechainicio, $fechafin, $folio, $conexion_usuarios);
			break;
  }

	function pagos_pendientes_cliente($cliente, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['id'];
		}

		$query = "SELECT * FROM facturas WHERE cliente = '$cliente' AND pagado != total AND status != 'cancelada' ORDER BY fecha";
		$resultado1 = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado1)){
			$factura = $data['folio'];

			$query2 = "SELECT * FROM cotizacion WHERE factura='$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);

			if (mysqli_num_rows($resultado2) < 1 || !$resultado2) {
				$arreglo["data"][] = array(
					'id' => $data['id'],
					'cliente' => $cliente,
					'factura' => $data['folio'],
					'ordencompra' => $data['ordenpedido'],
					'moneda' => $data['moneda'],
					'abonado' => "$ ".round($data['pagado'],2),
					'pendiente' => "$ ".round($data['total'] - $data['pagado'], 2),
					'total' => "$ ".round($data['total'],2)
				);
			}else{
				while($data2 = mysqli_fetch_assoc($resultado2)){
					$abonado = round($data2['Pagado'], 2);
					$total = $data2['precioTotal'] * 1.16;
					$pendiente = $total - $abonado;

					$arreglo["data"][] = array(
						'id' => $data['id'],
						'check' => $check,
						'cliente' => $cliente,
						'factura' => $data2['factura'],
						'ordencompra' => $data2['NoPedClient'],
						'moneda' => $data2['moneda'],
						'abonado' => "$ ".round($data2['Pagado'],2),
						'pendiente' => "$ ".round($pendiente,2),
						'total' => "$ ".round($data2['precioTotal'] * 1.16,2)
					);
				}
			}
		}

		if (mysqli_num_rows($resultado1) < 1 && mysqli_num_rows($resultado2) < 1) {
			$arreglo['data'] = 0;
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
	}

	function pagados_cliente($cliente, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['id'];
		}

		$query = "SELECT payments.*, contactos.nombreEmpresa, accounts.nombre FROM payments INNER JOIN contactos ON contactos.id=payments.client INNER JOIN accounts ON accounts.id=payments.account WHERE client = '$idcliente' AND date > '2017-01-01' ORDER BY id DESC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$factura = $data['factura'];

				$queryabono = "SELECT valor FROM abonos WHERE deFactura='$factura'";
				$resultadoabono = mysqli_query($conexion_usuarios, $queryabono);

				if (mysqli_num_rows($resultadoabono) < 1) {
					$abono = "";
				}else{
					while($dataabono = mysqli_fetch_assoc($resultadoabono)){
						$abono = $dataabono['valor'];
					}
				}

				$arreglo["data"][] = array(
					'idpedido' => $data['id'],
					'tipocambio' => $data['exchangeRate'],
					'cuenta' => $data['account'],
					'moneda' => strtoupper($data['currency']),
					'tipocambio' => $data['exchangeRate'],
					'fecha' => $data['date'],
					'factura' => $data['factura'],
					'cliente' => $data['nombreEmpresa'],
					'banco' => $data['nombre'],
					'total' => "$ ".($data['amount'] + $abono),
				);
			}
		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
	}

	function pagos_pendientes_proveedor($proveedor, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%$proveedor%' AND tipo ='Proveedor' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
			$idproveedor = $data['id'];
		}

		$query="SELECT DISTINCT factura_proveedor, orden_compra, pago_factura, fecha_orden_compra FROM utilidad_pedido WHERE fecha_orden_compra > '2017-01-01' AND proveedor ='$idproveedor' AND pagada != 'si' AND factura_proveedor != '0' ORDER BY fecha_orden_compra DESC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$facturaproveedor = $data['factura_proveedor'];

				$query2="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$facturaproveedor'";
				$res2 = mysqli_query($conexion_usuarios, $query2);
				$total = 0;
				while($data2 = mysqli_fetch_assoc($res2)){
					$monedapedido = $data['moneda_pedido'];

					if ($monedaproveedor == "usd") {
						$total = $total + (($data2['costo_usd'] * $data2['cantidad'])*1.16);
					}else{
						$total = $total + (($data2['costo_mn'] * $data2['cantidad'])*1.16);
					}
				}

				$fecha = $data['fecha_orden_compra'];
				$nuevafecha = strtotime ( '+30 day' , strtotime ( $fecha ) ) ;
				$fechavencimiento = date ( 'd-m-Y' , $nuevafecha );
				$fecha = date ( 'd-m-Y' , strtotime($data['fecha_orden_compra']));


				$check = "<input type='checkbox' name='pedido' value='".$facturaproveedor."' onclick='cambiar_total()'>";

				$arreglo["data"][] = array(
					'factura' => $data['factura_proveedor'],
					'ordencompra' => $data['orden_compra'],
					'fecha' => $fecha,
					'fechavencimiento' => $fechavencimiento,
					'moneda' => $monedapedido,
					'abonado' => $data['pago_factura'],
					'pendiente' => round($total - $data['pago_factura'],2),
					'total' => round($total,2)
				);
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
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
          'pagado' => "$ ".$data['pagado'],
          'monedapago' => strtoupper($monedapago),
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

	function notas_credito($cliente, $fechainicio, $fechafin, $folio, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$idcliente = $data['id'];

		if ($cliente != '') {
			$query = "SELECT * FROM abonos WHERE cliente = '$idcliente' ORDER BY fecha DESC";
		} elseif ($folio != '') {
			$query = "SELECT * FROM abonos WHERE numero = '$folio' ORDER BY fecha DESC";
		} else {
			$query = "SELECT * FROM abonos WHERE fecha >= '$fechainicio' AND fecha <= '$fechafin' ORDER BY fecha DESC";
		}

		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['cliente'];

				$query2 = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente' LIMIT 1";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);
				$data2 = mysqli_fetch_assoc($resultado2);
				$cliente = $data2['nombreEmpresa'];

				$arreglo['data'][] = array(
					'folio' => $data['numero'],
					'fecha' => $data['fecha'],
					'cliente' => $cliente,
					'factura' => $data['deFactura'],
					'descripcion' => utf8_encode($data['descripcion']),
					'valor' => "$ ".$data['valor'],
					'subtipo' => $data['subtipo']
				);
			}
		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
	}
?>
