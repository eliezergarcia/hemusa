<?php 
	
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion[] = "";

	switch ($opcion) {
		case 'listarpartidas':
			$remision = $_POST['remision'];
			partidas($remision, $conexion_usuarios);
			break;

		case 'agregarherramienta':
			$idcontacto = $_POST['idcontacto'];
			agregarherramienta($idcontacto, $conexion_usuarios);
			break;
	}

	function partidas($remision, $conexion_usuarios){	
		$query = "SELECT * FROM cotizacionherramientas WHERE remision ='$remision'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die('Error al buscar partidas! 2');
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
					'descripcion' => $data['descripcion'],
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
		mysqli_free_result($resultado);
		mysqli_close($conexion_usuarios);
	}

	function agregarherramienta($idcontacto, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE Pedido='si' AND cliente='$idcontacto' AND Entregado='0000-00-00' AND factura = '0' AND remision = '' ORDER BY modelo";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$i = 1;
		
		while($data = mysqli_fetch_assoc($resultado)){
			$input = '<input type="checkbox" class="btn btn-outline-primary" name="hremision" value="'.$data['id'].'">';
			$arreglo['data'][] = array(
				'id' => $data['id'],
				'marca' => $data['marca'],
				'modelo' => $data['modelo'],
				'descripcion' => utf8_encode($data['descripcion']),
				'cantidad' => $data['cantidad'],
				'precioTotal' => round($data['precioLista'] * $data['cantidad'],2),
				'cotizacion' => $data['cotizacionRef'],
				'numeroPedido' => $data['numeroPedido'],
				'input' => $input
			);
		}

		echo json_encode($arreglo);
	}
?>