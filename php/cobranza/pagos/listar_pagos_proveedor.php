<?php 
	
	include("../../conexion.php");
	ini_set('max_execution_time', 300);

	$idproveedor = $_POST['idcliente'];
	$query = "SELECT moneda FROM contactos WHERE id = '$idproveedor'";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($data = mysqli_fetch_assoc($resultado)){
		$monedaproveedor = $data['moneda'];
	}

	$query="SELECT DISTINCT factura_proveedor FROM  `utilidad_pedido` WHERE  `fecha_orden_compra` >  '2016-01-01' AND  `proveedor` ='$idproveedor' AND pagada != 'si' and factura_proveedor != '0' ORDER BY factura_proveedor  ";
	$resultado = mysqli_query($conexion_usuarios, $query);

	
	if (!$resultado) {
		die("Error!");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$facturaproveedor = $data['factura_proveedor'];

			$query2="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$facturaproveedor'";
			$res2 = mysqli_query($conexion_usuarios, $query2);
			$total = 0;
			while($data2 = mysqli_fetch_assoc($res2)){
				if ($monedaproveedor == "usd") {
					$total = $total + ($data2['costo_usd'] * $data2['cantidad']);
				}else{
					$total = $total + ($data2['costo_mn'] * $data2['cantidad']);
				}
			}


			$check = "<input type='checkbox' name='pedido' value='".$facturaproveedor."' onclick='cambiar_total()'>";

			$arreglo["data"][] = array(
				'check' => $check,				
				'factura' => $facturaproveedor,
				'total' => "$ ".round($total, 2)
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>