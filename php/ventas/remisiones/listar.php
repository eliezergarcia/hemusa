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
		$query = "SELECT cotizacion.*, contactos.nombreEmpresa, remisiones.remision as r , case when remisiones.efectivo is null then 0 else remisiones.Efectivo end as 'Efectivo' FROM cotizacion LEFT JOIN contactos on
		contactos.id=cotizacion.cliente LEFT JOIN remisiones on remisiones.remision=cotizacion.remision WHERE cotizacion.Comentario='' AND cotizacion.remision!=0 AND
		cotizacion.remisionFactura=0 AND cotizacion.remisionFecha >= '$fechainicio' AND cotizacion.remisionFecha <='$fechafin' ORDER BY cotizacion.remision DESC LIMIT 100";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				if($data['Efectivo'] == 1){
					$factura = "Pagada";
				}else{
					$remision = $data['remision'];

					$query2 = "SELECT factura FROM cotizacionherramientas WHERE remision = '$remision'";
					$resultado2 = mysqli_query($conexion_usuarios, $query2);
					while($data2 = mysqli_fetch_assoc($resultado2)){
						$factura = $data2['factura'];
						if ($data2['factura'] == 0) {
							$factura = "Pendiente";
						}else{
							mysqli_free_result($resultado2);
							$query3 = "SELECT factura FROM cotizacion WHERE id = '$factura'";
							$resultado3 = mysqli_query($conexion_usuarios, $query3);
							while($data3 = mysqli_fetch_assoc($resultado3)){
								$factura = $data3['factura'];
							}
							mysqli_free_result($resultado3);
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

				$arreglo["data"][]=array(
					'id' => $data['id'],
					'indice' => $i,
					'check' => $check,
					'claveSat' => $data['ClaveProductoSAT'],
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
					'almacen' => $almacen
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

		$i = 1;

		while($data = mysqli_fetch_assoc($resultado)){
			$input = '<input type="checkbox" class="btn btn-outline-primary" name="hremision" value="'.$data['id'].'">';
			$arreglo['data'][] = array(
				'indice' => $i,
				'id' => $data['id'],
				'enviado' => $data['enviadoFecha'],
				'recibido' => $data['recibidoFecha'],
				'marca' => $data['marca'],
				'modelo' => $data['modelo'],
				'descripcion' => utf8_encode($data['descripcion']),
				'cantidad' => $data['cantidad'],
				'precioTotal' => round($data['precioLista'] * $data['cantidad'],2),
				'cotizacion' => $data['cotizacionRef'],
				'numeroPedido' => $data['numeroPedido'],
				'input' => $input
			);
			$i++;
		}

		echo json_encode($arreglo);
	}
?>
