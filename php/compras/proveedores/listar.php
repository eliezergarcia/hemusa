<?php
	ini_set('max_execution_time', 300);
	include("../../conexion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'proveedores':
			proveedores($conexion_usuarios);
			break;

		case 'sinpedido':
			$buscar = $_POST['buscar'];
			$idproveedor = $_POST['idproveedor'];
			sinpedido($idproveedor, $buscar, $conexion_usuarios);
			break;

		case 'sinrecibido':
			$buscar = $_POST['buscar'];
			$idproveedor = $_POST['idproveedor'];
			sinrecibido($idproveedor, $buscar, $conexion_usuarios);
			break;

		case 'sinentregar':
			$buscar = $_POST['buscar'];
			$idproveedor = $_POST['idproveedor'];
			sinentregar($idproveedor, $buscar, $conexion_usuarios);
			break;

		case 'ordenesdecompra':
			$buscar = $_POST['buscar'];
			$idproveedor = $_POST['idproveedor'];
			ordenes_compra($idproveedor, $buscar, $conexion_usuarios);
			break;
	}

	function proveedores($conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE tipo = 'Proveedor' AND nombreEmpresa != '' ORDER BY nombreEmpresa";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			die("Error!");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = array_map("utf8_encode", $data);
			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function sinpedido($idproveedor, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$proveedor = $data['nombreEmpresa'];
			}

			$query = "SELECT contactos.*, cotizacionherramientas.* FROM cotizacionherramientas INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE (marca LIKE '%$buscar%' OR modelo LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR pedidoFecha LIKE '%$buscar%') AND Pedido = 'si' AND noDePedido = '' AND Proveedor LIKE '$proveedor' OR Proveedor ='$idproveedor'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$cotizacionRef = $data['cotizacionRef'];
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$queryprecio = "SELECT precioBase, enReserva, marca FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);

					if(mysqli_num_rows($resultadoprecio) > 0){
						while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
							$precioLista = $dataprecio['precioBase'];
							$almacen = $dataprecio['enReserva'];
							$marca = $dataprecio['marca'];
						}
					}else{
						$precioLista = $data['precioLista'];
						$almacen = 0;
						$marca = $data['marca'];
					}

					$queryfactor = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
					$resultadofactor = mysqli_query($conexion_usuarios, $queryfactor);
					if(!$resultadofactor){
						die("ERROR EN FACTORES");
					}else{
						$precioProveedor = $precioLista;
						while($datafactor = mysqli_fetch_assoc($resultadofactor)){
							$precioProveedor = $precioProveedor * $datafactor['factor_proveedor'];
						}
					}

					$querymarca = "SELECT * FROM marcadeherramientas WHERE marca = '$marca'";
					$resultadomarca = mysqli_query($conexion_usuarios, $querymarca);
					if(mysqli_num_rows($resultadomarca) > 0){
						while($datamarca = mysqli_fetch_assoc($resultadomarca)){
							$factor = $datamarca['factor'];
							$excepcion = $datamarca['excepcion'];
						}
					}else{
						$factor = 1;
						$excepcion = 0;
					}

					if ($excepcion == 1) {
						$precio = $precioLista * $factor;
						$utilidad = (($precio - $precioProveedor)/$precio) * 100;
					}else{
						$utilidad = (($precioLista - $precioProveedor)/$precioLista) * 100;
					}

					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'marca' => $data['marca'],
							'modelo' => $data['modelo'],
							'descripcion' => $data['descripcion'],
							'cantidad' => $data['cantidad'],
							'cliente' => $data['nombreEmpresa'],
							'precioProveedor' => "$ ".round($precioProveedor,2),
							'fecha' => $data['pedidoFecha'],
							'almacen' => $almacen,
							'utilidad' => "%".round($utilidad, 2)
						);
					$i++;
				}
			}
			}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function sinrecibido($idproveedor, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$proveedor = strtoupper($data['nombreEmpresa']);
			}

			$query = "SELECT cotizacionherramientas.*, contactos.nombreEmpresa FROM cotizacionherramientas INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE (enviadoFecha LIKE '%$buscar%' OR marca LIKE '%$buscar%' OR modelo LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR noDePedido LIKE '%$buscar%' OR pedidoFecha LIKE '%$buscar%') AND Proveedor LIKE '%$proveedor%' AND recibidoFecha='0000-00-00' AND proveedorFecha!='0000-00-00' AND noDePedido != '' AND pedidoFecha >= '2017-01-01' ORDER BY modelo";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$cotizacionRef = $data['cotizacionRef'];
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					if($data['enviadoFecha'] == '0000-00-00'){
						$enviado = '<input type="checkbox" class="btn btn-outline-primary" name="enviado" value="'.$data['id'].'">';;
					}else{
						$enviado = $data['enviadoFecha'];
					}

					$queryprecio = "SELECT precioBase, enReserva, marca FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);

					if(mysqli_num_rows($resultadoprecio) > 0){
						while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
							$precioLista = $dataprecio['precioBase'];
							$almacen = $dataprecio['enReserva'];
							$marca = $dataprecio['marca'];
						}
					}else{
						$precioLista = $data['precioLista'];
						$almacen = 0;
					}

					$queryfactor = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
					$resultadofactor = mysqli_query($conexion_usuarios, $queryfactor);
					if(!$resultadofactor){
						die("ERROR EN FACTORES");
					}else{
						$precioProveedor = $precioLista;
						while($datafactor = mysqli_fetch_assoc($resultadofactor)){
							$precioProveedor = $precioProveedor * $datafactor['factor_proveedor'];
						}
					}

					$recibido = '<input type="checkbox" class="btn btn-outline-primary" name="recibido" value="'.$data['id'].'">';;

					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'enviado' => $enviado,
							'recibir' => $recibido,
							'marca' => $data['marca'],
							'modelo' => $data['modelo'],
							'cantidad' => $data['cantidad'],
							'descripcion' => utf8_encode($data['descripcion']),
							'cliente' => $data['nombreEmpresa'],
							'pedido' => $data['noDePedido'],
							'fecha' => $data['pedidoFecha'],
							'costo' => "$ ".round($precioProveedor,2)
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function sinentregar($idproveedor, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$proveedor = strtoupper($data['nombreEmpresa']);
			}

			$query = "SELECT cotizacionherramientas.*, contactos.* FROM cotizacionherramientas INNER JOIN contactos ON contactos.id = cotizacionherramientas.cliente WHERE (enviadoFecha LIKE '%$buscar%' OR recibidoFecha LIKE '%$buscar%' OR marca LIKE '%$buscar%' OR modelo LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR noDePedido LIKE '%$buscar%' OR pedidoFecha LIKE '%$buscar%') AND Proveedor='$proveedor' AND recibidoFecha!='0000-00-00' AND proveedorFecha!='0000-00-00' AND Entregado='0000-00-00' AND pedidoFecha >= '2017-01-01' ORDER BY modelo";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$marca = $data['marca'];
					$modelo = $data['modelo'];

					$queryprecio = "SELECT precioBase, enReserva, marca FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
					$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);

					if(mysqli_num_rows($resultadoprecio) > 0){
						while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
							$precioLista = $dataprecio['precioBase'];
							$almacen = $dataprecio['enReserva'];
							$marca = $dataprecio['marca'];
						}
					}else{
						$precioLista = $data['precioLista'];
						$almacen = 0;
					}

					$queryfactor = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
					$resultadofactor = mysqli_query($conexion_usuarios, $queryfactor);
					if(!$resultadofactor){
						die("ERROR EN FACTORES");
					}else{
						$precioProveedor = $precioLista;
						while($datafactor = mysqli_fetch_assoc($resultadofactor)){
							$precioProveedor = $precioProveedor * $datafactor['factor_proveedor'];
						}
					}

					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'enviado' => $data['enviadoFecha'],
							'recibir' => $data['recibidoFecha'],
							'marca' => $data['marca'],
							'modelo' => $data['modelo'],
							'cantidad' => $data['cantidad'],
							'descripcion' => utf8_encode($data['descripcion']),
							'cliente' => $data['nombreEmpresa'],
							'pedido' => $data['noDePedido'],
							'fecha' => $data['pedidoFecha'],
							'costo' => "$ ".round($precioProveedor,2)
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function ordenes_compra($idproveedor, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$proveedor = strtoupper($data['nombreEmpresa']);
			}

			$query = "SELECT ordendecompras.*, usuarios.nombre FROM ordendecompras INNER JOIN usuarios ON usuarios.id = ordendecompras.contacto WHERE (noDePedido LIKE '%$buscar%' OR fecha LIKE '%$buscar%' OR nombre LIKE '%$buscar%') AND proveedor = '$idproveedor' ORDER BY fecha DESC";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (mysqli_num_rows($resultado) < 1) {
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'ordencompra' => $data['noDePedido'],
							'proveedor' => utf8_encode($proveedor),
							'contacto' => $data['nombre'],
							'fecha' => $data['fecha'],
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}
 ?>
