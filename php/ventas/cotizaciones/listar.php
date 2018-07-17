<?php
	include("../../conexion.php");
	// error_reporting(0);

	$opcion = $_POST['opcion'];
	$informacion = [];

	switch ($opcion) {
		case 'listarcotizaciones':
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			listarcotizaciones($filtromes, $filtroano, $conexion_usuarios);
			break;

		case 'listarpartidas':
			$numeroCotizacion = $_POST['numeroCotizacion'];
			listarpartidas($numeroCotizacion, $conexion_usuarios);
			break;

		case 'listarFletes':
			$refCotizacion = $_POST['refCotizacion'];
			listarFletes($refCotizacion, $conexion_usuarios);
			break;

		case 'listarCambiarPedido':
			$refCotizacion = $_POST['refCotizacion'];
			listarCambiarPedido($refCotizacion, $conexion_usuarios);
			break;
	}

	function listarcotizaciones($filtromes, $filtroano, $conexion_usuarios){
		if ($filtromes != "todo") {
			$fechainicio = $filtroano.'-'.$filtromes.'-01';
			$fechafin = $filtroano.'-'.$filtromes.'-31';
		}else{
			$fechainicio = $filtroano.'-01-01';
			$fechafin = $filtroano.'-12-31';
		}

		$query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE fecha >= '$fechainicio' AND fecha <= '$fechafin' AND partidaPedido != partidaCantidad ORDER BY id DESC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo['data'][] = array(
					'ref' => $data['ref'],
					'nombreEmpresa' => utf8_encode($data['nombreEmpresa']),
					'vendedor' => $data['vendedor'],
					'contacto' => $data['contacto'],
					'fecha' => $data['fecha'],
					'partidaCantidad' => $data['partidaCantidad'],
					'precioTotal' => "$ ".$data['precioTotal']
				);
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function listarpartidas($numeroCotizacion, $conexion_usuarios){
		$query = "SELECT cotizacionherramientas.*, cotizacion.partidaCantidad FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE cotizacionRef = '$numeroCotizacion' AND numeroPedido = '' ORDER BY id ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
				$arreglo["data"] = 0;
		}else{
			$i=1;
			while($data = mysqli_fetch_assoc($resultado)){
				$marca = $data['marca'];
				$modelo = $data['modelo'];


				$querystock = "SELECT enReserva,clase,factor FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
				$resultadostock = mysqli_query($conexion_usuarios, $querystock);
				if (mysqli_num_rows($resultadostock) > 0) {
					while($datastock = mysqli_fetch_array($resultadostock)){
						$stock = $datastock['enReserva'];
						$clase = $datastock['clase'];
						$factor = $datastock['factor'];
					}
				}else{
					$stock = 0;
					$clase = "E";
					$factor= 1;
				}

				$precioUnitario = $data['precioLista'] + $data['flete'];

				$precioTotal = $precioUnitario*$data['cantidad'];

				// $imagenModelo = '<img src=\"https://s3.amazonaws.com/hemusaimages/'.strtolower($data["marca"]).'/'.strtolower($data["marca"]).'-'.$data["modelo"].'.jpg\" width=\"80px\">';

				$arreglo["data"][]= array(
					'refCotizacion' => $data['cotizacionRef'],
					'numPartidas' => $data['partidaCantidad'],
					'clase' => $clase,
					'factor' => $factor,
					'id' => $data['id'],
					'numero' => $i,
					'marca' => $data['marca'],
					'modelo' => $modelo,
					'descripcion' => utf8_encode($data['descripcion']),
					'precioUnitario' => round($precioUnitario,2),
					'cantidad' => $data['cantidad'],
					'precioTotal' =>'$ '.number_format($precioTotal, 2, '.', ''),
					'claveSat' => $data['ClaveProductoSAT'],
					'unidad' => $data['Unidad'],
					'tedias' => $data['Tiempo_Entrega'],
					'stock' => $stock,
					'refInterna' => $data['referencia_interna'],
					'cotizadoEn' => $data['lugar_cotizacion'],
					'proveedorFlete' => $data['proveedorFlete'],
					'flete' => $data['flete']
				);

				$i++;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	}

	function listarFletes($refCotizacion, $conexion_usuarios){
		$query = "SELECT * FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo["data"] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = $data;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		cerrar($conexion_usuarios);
	}

	function listarCambiarPedido($refCotizacion, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND numeroPedido = ''";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			die("Error la listar partidas de cotizacion!");
		}else{
			$i=1;
			while($data = mysqli_fetch_assoc($resultado)){

				$input = '<input type="checkbox" class="btn btn-outline-primary" name="hcambiarpedido" value="'.$data['id'].'">';

				$arreglo["data"][]=array(
					'indice' => $i,
					'marca' => $data['marca'],
					'modelo' => $data['modelo'],
					'descripcion' => $data['descripcion'],
					'cantidad' => $data['cantidad'],
					'precioTotal' => $data['precioLista'],
					'input' => $input
				);

				$i++;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		cerrar($conexion_usuarios);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}
 ?>
