<?php

	include ('../../conexion.php');

	$opcion = $_POST['opcion'];
	$informacion = [];

	switch ($opcion) {
		case 'direccionenvio':
			direccionenvio($conexion_usuarios);
			break;

		case 'buscarClientes':
			buscar_clientes($conexion_usuarios);
			break;

		case 'datosordencompra':
			$ordencompra = $_POST['ordencompra'];
			datosordencompra($ordencompra, $conexion_usuarios);
			break;

		case 'buscardatospartida':
			$idpartida = $_POST['idpartida'];
			buscardatospartida($idpartida, $conexion_usuarios);
			break;

		case 'imprimircotizacion':
			$ordencompra = $_POST['ordencompra'];
			imprimir_cotizacion($ordencompra, $conexion_usuarios);
			break;


	}

	function direccionenvio($conexion_usuarios){
		$query = "SELECT id,nickname FROM envia_a";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$direcciones[] = utf8_encode($data['id']);
			$direcciones[] = utf8_encode($data['nickname']);
		}

		echo json_encode($direcciones);
	}

	function buscar_clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Proveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
	}


	function datosordencompra($ordencompra, $conexion_usuarios){
		$query = "SELECT * FROM ordendecompras WHERE noDePedido = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['ordendecompra'] = "ERROR";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$informacion['ordendecompra'] = array_map("utf8_encode", $data);
				$idproveedor = $data['proveedor'];
			}

			$query = "SELECT * FROM contactos WHERE id ='$idproveedor'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["proveedor"] = "ERROR";
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$informacion["proveedor"] = array_map("utf8_encode", $data);
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function buscardatospartida($idpartida, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE id = '$idpartida'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			die("!Error");
		}else{
			while($data = mysqli_fetch_assoc($resultado))
				$arreglo["data"][] = $data;
		}

		echo json_encode($arreglo);
	}

	function imprimir_cotizacion($ordencompra, $conexion_usuarios){
		$query = "SELECT * FROM ordendecompras WHERE noDePedido = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['ordencompra'] = array_map("utf8_encode", $data);
			$fecha = $data['fecha'];
			$informacion['fecha'] = strftime("%d - %m - %Y", strtotime($fecha));
			$idproveedor = $data['proveedor'];
			$fechaoc = $data['fecha'];
		}

		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['cliente'] = array_map("utf8_encode", $data);
			$monedaproveedor = $data['moneda'];
		}

		$query = "SELECT * FROM utilidad_pedido WHERE orden_compra = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			if (!$resultado) {
				verificar_resultado($resultado);
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$queryalmacen = "SELECT precioBase,enReserva FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$resultadoalmacen = mysqli_query($conexion_usuarios, $queryalmacen);
					if(mysqli_num_rows($resultadoalmacen) > 0){
						while($dataalmacen = mysqli_fetch_array($resultadoalmacen)){
							$almacen = $dataalmacen['enReserva'];
						}
					}else{
						$almacen = 0;
					}

					if($monedaproveedor == "usd"){
						$precioUnitario = $data['costo_usd'];
						$precioTotal = $data['costo_usd'] * $data['cantidad'];
						$utilidad = (($data['venta_usd'] - $data['costo_usd'])/$data['venta_usd']) * 100;
					}else{
						$precioUnitario = $data['costo_mn'];
						$precioTotal = $data['costo_mn'] * $data['cantidad'];
						$utilidad = (($data['venta_mn'] - $data['costo_mn'])/$data['venta_mn']) * 100;
					}


					$informacion['partidas'][] = array(
						'id' => $data['id'],
						'indice' => $i,
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => "$ ".round($precioUnitario,2),
						'cantidad' => $data['cantidad'],
						'precioTotal' => "$ ".round($precioTotal,2),
						'almacen' => $almacen,
						'fechaCompromiso' => "",
						'utilidad' => "% ".round($utilidad,2)
					);
					$i++;
				}
			}
		}else{
			$query = "SELECT * FROM cotizacionherramientas WHERE noDePedido = '$ordencompra'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				verificar_resultado($resultado);
				die("Error");
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$query1 = "SELECT precioBase,enReserva,moneda FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$res1 = mysqli_query($conexion_usuarios, $query1);
					while($data1 = mysqli_fetch_array($res1)){
						$precioBase = $data1['precioBase'];
						$almacen = $data1['enReserva'];
						$moneda = $data1['moneda'];
					}

					$query2 = "SELECT * FROM tipocambio WHERE fecha = '$fechaoc'";
					$res2 = mysqli_query($conexion_usuarios, $query2);
					while($data2 = mysqli_fetch_assoc($res2)){
						$tipocambio = $data2['tipocambio'];
					}

					if($monedaproveedor == "usd" && $moneda == "usd"){
						$precioUnitario = $precioBase;
						$precioTotal = $precioBase * $data['cantidad'];
						$utilidad = (($data['precioLista'] - $precioUnitario)/$data['precioLista']) * 100;
					}elseif($monedaproveedor == "usd" && $moneda == "mxn"){
						$precioUnitario = $precioBase;
						$precioTotal = ($precioBase * $data['cantidad']) / $tipocambio;
						$utilidad = (($data['precioLista'] - $precioUnitario)/$data['precioLista']) * 100;
					}

					if($monedaproveedor == "mxn" && $moneda == "mxn"){
						$precioUnitario = $precioBase;
						$precioTotal = $precioBase * $data['cantidad'];
						$utilidad = (($data['precioLista'] - $precioUnitario)/$data['precioLista']) * 100;
					}elseif($monedaproveedor == "mxn" && $moneda == "usd"){
						$precioUnitario = $precioBase;
						$precioTotal = ($precioBase * $data['cantidad']) * $tipocambio;
						$utilidad = (($data['precioLista'] - $precioUnitario)/$data['precioLista']) * 100;
					}

					$informacion['partidas'][] = array(
						'id' => $data['id'],
						'indice' => $i,
						'marca' => $data['marca'],
						'modelo' => $data['modelo'],
						'descripcion' => utf8_encode($data['descripcion']),
						'precioUnitario' => "$ ".round($precioUnitario,2),
						'cantidad' => $data['cantidad'],
						'precioTotal' => "$ ".round($precioTotal,2),
						'almacen' => $almacen,
						'fechaCompromiso' => "",
						'utilidad' => "% ".round($utilidad,2)
					);
					$i++;
				}
			}
		}

		$query = "SELECT * FROM ordendecompras WHERE noDePedido = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$flete = $data['flete'];
			$idproveedor = $data['proveedor'];
			$fechaoc = $data['fecha'];
		}

		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
		}

		$query = "SELECT * FROM utilidad_pedido WHERE orden_compra = '$ordencompra'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			$subtotal = 0;
			while($data = mysqli_fetch_assoc($resultado)){
				if($monedaproveedor == "usd"){
					$subtotal = $subtotal +  ($data['costo_usd'] * $data['cantidad']);
				}else{
					$subtotal = $subtotal + ($data['costo_mn'] * $data['cantidad']);
				}
			}

			$iva = ($subtotal + $flete) * .16;
			$total = ($subtotal + $flete) * 1.16;
			$utilidad = (($total - $subtotal)/$total) * 100;

			$informacion['totales'][] = array(
				'subtotal' => "$ ".round($subtotal, 2),
				'flete' => "$ ".round($flete, 2),
				'iva' => "$ ".round($iva, 2),
				'total' => "$ ".round($total, 2),
				'utilidad' => "% ".round($utilidad, 2)
			);
		}else{
			$query = "SELECT * FROM cotizacionherramientas WHERE noDePedido = '$ordencompra'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				verificar_resultado($resultado);
				die("Error");
			}else{
				$i = 1;
				$subtotal = 0;
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$query1 = "SELECT precioBase,enReserva,moneda FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$res1 = mysqli_query($conexion_usuarios, $query1);
					while($data1 = mysqli_fetch_array($res1)){
						$precioBase = $data1['precioBase'];
						$almacen = $data1['enReserva'];
						$moneda = $data1['moneda'];
					}

					$query2 = "SELECT * FROM tipocambio WHERE fecha = '$fechaoc'";
					$res2 = mysqli_query($conexion_usuarios, $query2);
					while($data2 = mysqli_fetch_assoc($res2)){
						$tipocambio = $data2['tipocambio'];
					}

					if($monedaproveedor == "usd" && $moneda == "usd"){
						$precioUnitario = $precioBase;
						$subtotal = $subtotal + ($precioUnitario * $data['cantidad']);
					}elseif($monedaproveedor == "usd" && $moneda == "mxn"){
						$precioUnitario = $precioBase;
						$subtotal = $subtotal + (($precioUnitario * $data['cantidad']) / $tipocambio);
					}

					if($monedaproveedor == "mxn" && $moneda == "mxn"){
						$subtotal = $subtotal + ($precioBase * $data['cantidad']);
					}elseif($monedaproveedor == "mxn" && $moneda == "usd"){
						$precioUnitario = $precioBase;
						$subtotal = $subtotal + (($precioUnitario * $data['cantidad']) * $tipocambio);
					}

				}
				$iva = ($subtotal + $flete) * .16;
				$total = ($subtotal + $flete) * 1.16;
				$utilidad = (($total - $subtotal)/$total) * 100;

				$informacion['totales'][] = array(
					'subtotal' => "$ ".round($subtotal, 2),
					'flete' => "$ ".round($flete, 2),
					'iva' => "$ ".round($iva, 2),
					'total' => "$ ".round($total, 2),
					'utilidad' => "% ".round($utilidad, 2)
				);
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

?>
