<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'listarremisiones':
			$buscar = $_POST['buscar'];
			$filtromes = $_POST['filtromes'];
			$filtroano = $_POST['filtroano'];
			if ($filtromes != "todo") {
				$fechainicio = $filtroano.'-'.$filtromes.'-01';
				$fechafin = $filtroano.'-'.$filtromes.'-31';
			}else{
				$fechainicio = $filtroano.'-01-01';
				$fechafin = $filtroano.'-12-31';
			}
			remisiones($buscar, $fechainicio, $fechafin, $conexion_usuarios);
			break;

		case 'listarpartidas':
			$remision = $_POST['remision'];
			partidas($remision, $conexion_usuarios);
			break;

		case 'agregarherramienta':
			$idcontacto = $_POST['idcontacto'];
			agregarherramienta($idcontacto, $conexion_usuarios);
			break;
	}

	function remisiones($buscar, $fechainicio, $fechafin, $conexion_usuarios){
		$query = "SELECT cotizacion.*, contactos.nombreEmpresa FROM cotizacion INNER JOIN contactos ON contactos.id = cotizacion.cliente WHERE cotizacion.Comentario='' AND cotizacion.remision!=0 AND
		cotizacion.remisionFactura=0 AND cotizacion.remisionFecha >= '$fechainicio' AND cotizacion.remisionFecha <='$fechafin' ORDER BY cotizacion.remision";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				$remision = $data['remision'];

				$query2 = "SELECT * FROM remisiones WHERE remision = '$remision'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				if (mysqli_num_rows($resultado2) < 1) {
					$facturas = "";
					$query3 = "SELECT DISTINCT factura FROM cotizacionherramientas WHERE remision = '$remision'";
					$resultado3 = mysqli_query($conexion_usuarios, $query3);
					while($data3 = mysqli_fetch_assoc($resultado3)){
						$factura2 = $data3['factura'];
						if ($data3['factura'] == "" || $data3['factura'] == "0") {
							$facturas = "Pendiente, ".$facturas;
						}else{
							$query4 = "SELECT factura FROM cotizacion WHERE id = '$factura2'";
							$resultado4 = mysqli_query($conexion_usuarios, $query4);

							while($data4 = mysqli_fetch_assoc($resultado4)){
								$facturas = $data4['factura'].", ".$facturas;
							}
						}
					}
					$factura = rtrim($facturas, ',');
				}else{
					while($data2 = mysqli_fetch_assoc($resultado2)){
						if ($data2['Efectivo'] == 1 && $data2['IdFormaPago'] == 0) {
							$factura = "Pagada";
						}elseif ($data2['Efectivo'] == 1 && $data2['IdFormaPago'] == 1) {
							$factura = "Pagada";
						}else{
							$factura = "";
							$query3 = "SELECT factura FROM cotizacionherramientas WHERE remision = '$remision'";
							$resultado3 = mysqli_query($conexion_usuarios, $query3);
							while($data3 = mysqli_fetch_assoc($resultado3)){
								$factura = $data3['factura'].", ".$factura;
							}
						}
					}
				}


				$arreglo['data'][] = array(
					'indice' => $i,
					'cotizacionRef' => $data['ref'],
					'remision' => $data['remision'],
					'cliente' => $data['nombreEmpresa'],
					'contacto' => $data['contacto'],
					'fecha' => $data['remisionFecha'],
					'cantidad' => $data['partidaCantidad'],
					'suma' => "$ ".$data['precioTotal'],
					'facturas' => $factura
				);
				$i++;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	}

	function partidas($remision, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			$i=1;
			while($data = mysqli_fetch_assoc($resultado)){
				$idherramienta = $data['id'];
				$marca = $data['marca'];
				$modelo = $data['modelo'];
				$refCotizacion = $data['cotizacionRef'];

				$query2 = "SELECT enReserva FROM productos WHERE ref = '$modelo' AND marca ='".$marca."'";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				if (mysqli_num_rows($resultado2) > 0) {
					while($dataAlmacen = mysqli_fetch_array($resultado2)){
						$almacen = $dataAlmacen['enReserva'];
					}
				}else{
					$almacen = 0;
				}

				$query3 = "SELECT fecha, TiempoEntrega FROM cotizacion WHERE ref = '$refCotizacion'";
				$resultado3 = mysqli_query($conexion_usuarios, $query3);

				if (mysqli_num_rows($resultado3) > 0) {
					while($dataFC = mysqli_fetch_array($resultado3)){
						if($data['fechaCompromiso'] == '0000-00-00'){
							if($data['Tiempo_Entrega'] == ""){
								$fechacompromiso = "Sin fecha de compromiso";
							}else{
								$dias = $data['Tiempo_Entrega'];
								$fechacompromiso = $dataFC['fecha'];
								$fechacompromiso = strtotime($fechacompromiso."+".$dias."days");
								$fechacompromiso = date("Y-m-d",$fechacompromiso);
							}
						}else{
							$fechacompromiso = $data['fechaCompromiso'];
						}
					}
				}else{
					$fechacompromiso = "Sin fecha de compromiso";
				}

				$check = '<input type="checkbox" class="btn btn-outline-primary" name="hpacking" value="'.$data['id'].'">';

				if($data['Entregado'] == "0000-00-00"){
					$entregado = '<input type="checkbox" class="btn btn-outline-primary" name="hentregado" value="'.$data['id'].'">';
				}else{
					$entregado = $data['Entregado'];
				}

				$query4 = "SELECT * FROM utilidad_pedido WHERE id_cotizacion_herramientas = '$idherramienta'";
				$resultado4 = mysqli_query($conexion_usuarios, $query4);
				if (mysqli_num_rows($resultado4) < 1) {
					$folio = "";
				}else{
					while($data4 = mysqli_fetch_assoc($resultado4)){
						$folio = $data4['folio'];
					}
				}

				if ($data['factura'] != 0) {
					$factura = $data['factura'];
					$query5 = "SELECT factura FROM cotizacion WHERE id ='$factura'";
					$resultado5 = mysqli_query($conexion_usuarios, $query5);

					if (!$resultado5) {
						$factura = $data['factura'];
					}else{
						while($data5 = mysqli_fetch_assoc($resultado5)){
							$factura = $data5['factura'];
						}
					}
				}else{
					$factura = "";
				}

				$arreglo["data"][]=array(
					'id' => $data['id'],
					'indice' => $i,
					'check' => $check,
					'claveSat' => $data['ClaveProductoSAT'],
					'unidad' => $data['Unidad'],
					'pedimento' => $data['Pedimento'],
					'enviado' => $data['enviadoFecha'],
					'recibido' => $data['recibidoFecha'],
					'entregado' => $entregado,
					'proveedor' => $data['Proveedor'],
					'marca' => $marca,
					'modelo' => $modelo,
					'descripcion' => utf8_encode($data['descripcion']),
					'noserie' => $data['NoSerie'],
					'preciounidad' => "$ ".($data['precioLista'] + $data['flete']),
					'cantidad' => $data['cantidad'],
					'preciototal' => "$ ".($data['precioLista'] + $data['flete']) * $data['cantidad'],
					'fechacompromiso' => $fechacompromiso,
					'almacen' => $almacen,
					'folio' => $folio,
					'factura' => $factura
				);
				$i++;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function agregarherramienta($idcontacto, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE Pedido='si' AND cliente='$idcontacto' AND Entregado='0000-00-00' AND factura = '0' AND remision = '' ORDER BY modelo";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1) {
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				// $input = '<input type="checkbox" class="btn btn-outline-primary" name="hremision" value="'.$data['id'].'">';
				$arreglo['data'][] = array(
					'indice' => $i,
					'id' => $data['id'],
					'enviado' => $data['enviadoFecha'],
					'recibido' => $data['recibidoFecha'],
					'marca' => $data['marca'],
					'modelo' => $data['modelo'],
					'moneda' => $data['moneda'],
					'descripcion' => utf8_encode($data['descripcion']),
					'cantidad' => $data['cantidad'],
					'precioTotal' => round($data['precioLista'] * $data['cantidad'],2),
					'cotizacion' => $data['cotizacionRef'],
					'numeroPedido' => $data['numeroPedido']
				);
				$i++;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}
?>
