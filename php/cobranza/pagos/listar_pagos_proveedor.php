<?php
	include("../../conexion.php");

	$proveedor = $_POST['idproveedor'];

	$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%$proveedor%' LIMIT 1";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($data = mysqli_fetch_assoc($resultado)){
		$monedaproveedor = $data['moneda'];
		$idproveedor = $data['id'];
	}

	$query="SELECT DISTINCT factura_proveedor, orden_compra, pago_factura, fecha_orden_compra FROM utilidad_pedido WHERE fecha_orden_compra > '2017-01-01' AND proveedor ='$idproveedor' AND pagada != 'si' AND factura_proveedor != '0' ORDER BY fecha_orden_compra DESC LIMIT 10";
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
					$total = $total + ($data2['costo_usd'] * $data2['cantidad']);
				}else{
					$total = $total + ($data2['costo_mn'] * $data2['cantidad']);
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

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
