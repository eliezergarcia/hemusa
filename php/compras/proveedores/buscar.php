<?php

	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'direccionenvio':
			direccionenvio($conexion_usuarios);
			break;

		case 'totalsinpedido':
			$idproveedor = $_POST['idproveedor'];
			total_sin_pedido($idproveedor, $conexion_usuarios);
			break;

		case 'informacioncontacto':
			$idproveedor = $_POST['idproveedor'];
			informacion_contacto($idproveedor, $conexion_usuarios);
			break;
	}

	function total_sin_pedido($idproveedor, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$proveedor = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacionherramientas WHERE Pedido = 'si' AND noDePedido = '' AND Proveedor LIKE '%$proveedor%' OR Proveedor = '$idproveedor'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (!$resultado) {
				die('Error al buscar herramienta sin pedido');
			}else{
				$i = 1;
				$totalsinpedido = 0;
				while($data = mysqli_fetch_assoc($resultado)){
					$cotizacionRef = $data['cotizacionRef'];
					$marca = $data['marca'];
					$modelo = $data['modelo'];
					// $precioLista = $data['precioLista'];

					$querycliente = "SELECT cliente FROM cotizacion WHERE ref = '$cotizacionRef'";
					$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
					while($datacliente = mysqli_fetch_assoc($resultadocliente)){
						$idcliente = $datacliente['cliente'];
					}

					$queryempresa = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
					$resultadoempresa = mysqli_query($conexion_usuarios, $queryempresa);
					while($dataempresa = mysqli_fetch_assoc($resultadoempresa)){
						$cliente = $dataempresa['nombreEmpresa'];
					}

					$queryprecio = "SELECT precioBase, enReserva, marca FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);
					while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
						$precioLista = $dataprecio['precioBase'];
						$almacen = $dataprecio['enReserva'];
						$marca = $dataprecio['marca'];
					}

					$queryfactor = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
					$resultadofactor = mysqli_query($conexion_usuarios, $queryfactor);
					if(!$resultadofactor){
						die("ERROR EN FACTORES");
					}else{
						$precioProveedor = $precioLista;
						while($datafactor = mysqli_fetch_assoc($resultadofactor)){
							$precioProveedor = ($precioProveedor * $datafactor['factor_proveedor']);
						}
						$precioProveedor = round($precioProveedor,2) * $data['cantidad'];
					}
					$totalsinpedido = $totalsinpedido + $precioProveedor;
				}
			}
		}

		$informacion['totalsinpedido'] = round($totalsinpedido,2);
		echo json_encode($informacion);
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

	function informacion_contacto($idproveedor, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['contacto'] = $data;
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	}


?>
