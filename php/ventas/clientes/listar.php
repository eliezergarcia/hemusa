<?php
	include('../../conexion.php');
	// error_reporting(0);
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'clientes':
			clientes($conexion_usuarios);
			break;

		case 'nuevaremision':
			$idcontacto = $_POST['idcontacto'];
			nuevaremision($idcontacto, $conexion_usuarios);
			break;

		case 'facturadonoentregado':
			$idcliente = $_POST['idcliente'];
			$buscar = $_POST['buscar'];
			facturado_no_entregado($idcliente, $buscar, $conexion_usuarios);
			break;

		case 'sinentregar':
			$idcliente = $_POST['idcliente'];
			$buscar = $_POST['buscar'];
			sin_entregar($idcliente, $buscar, $conexion_usuarios);
			break;

		case 'facturasnopagadas':
			$idcliente = $_POST['idcliente'];
			$buscar = $_POST['buscar'];
			facturas_no_pagadas($idcliente, $buscar, $conexion_usuarios);
			break;

		case 'remisiones':
			$idcliente = $_POST['idcliente'];
			$buscar = $_POST['buscar'];
			remisiones($idcliente, $buscar, $conexion_usuarios);
			break;

		case 'cotizaciones':
			$idcliente = $_POST['idcliente'];
			$buscar = $_POST['buscar'];
			cotizaciones($idcliente, $buscar, $conexion_usuarios);
			break;
	}

	function clientes($conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE tipo = 'Cliente' AND nombreEmpresa != '' ORDER BY nombreEmpresa ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			$arreglo["data"] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = $data;
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function sin_entregar($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query="SELECT cotizacionherramientas.*, cotizacion.NoPedClient FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE (marca LIKE '%$buscar%' OR modelo LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR noDePedido LIKE '%$buscar%' OR numeroPedido LIKE '%$buscar%' OR enviadoFecha LIKE '%$buscar%' OR recibidoFecha LIKE '%$buscar%') AND Entregado='0000-00-00' AND pedidoFecha!='0000-00-00' AND cotizacionherramientas.cliente ='$idcliente' ORDER BY marca ASC";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$cotizacion = $data['cotizacionRef'];
					// $orden = '<a href=\"../../compras/ordenesdecompras/verOrdenCompra.php?ordenCompra='.$data['noDePedido'].'\">'.$data['noDePedido'].'</a>';

					if($data['enviadoFecha'] == '0000-00-00'){
						$enviado = "No";
					}else{
						$enviado = $data['enviadoFecha'];
					}

					if($data['recibidoFecha'] == '0000-00-00'){
						$recibido = "No";
					}else{
						$recibido = $data['recibidoFecha'];
					}

					if($data['numeroPedido'] == ""){
						$pedido = $data['NoPedClient'];
					}else{
						$pedido = $data['numeroPedido'];
					}

					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'marca' => $data['marca'],
							'modelo' => $data['modelo'],
							'descripcion' => utf8_encode($data['descripcion']),
							'cantidad' => $data['cantidad'],
							'precioUnitario' => "$ ".$data['precioLista'],
							'pedido' => $pedido,
							'orden' => $data['noDePedido'],
							'enviado' => $enviado,
							'recibido' => $recibido,
							'remision' => $data['remision'],
							'pedido' => $data['NoPedClient'],
							'cotizacion' => $data['cotizacionRef']
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function facturado_no_entregado($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (ref LIKE '%$buscar%' OR facturaFecha LIKE '%$buscar%') AND Pedido!='0000-00-00' AND fechaEntregado='0000-00-00' AND factura !='0' AND cliente= '$idcliente' ORDER BY factura DESC";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if(mysqli_num_rows($resultado) > 0){
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'pedidocliente' => $data['NoPedClient'],
							'remision' => $data['remision'],
							'ref' => $data['ref'],
							'fecha' => $data['facturaFecha'],
							'cantidad' => $data['partidaCantidad'],
							'suma' => "$ ".$data['precioTotal']
						);
					$i++;
				}
			}else{
				$query = "SELECT * FROM pedidos WHERE entregado ='0000-00-00' AND cliente= '$idcliente' AND factura != '' ORDER BY factura DESC";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if(mysqli_num_rows($resultado) < 1){
					$arreglo['data'] = 0;
				}else{
					$i = 1;
					while($data = mysqli_fetch_assoc($resultado)){
						$arreglo["data"][] = array(
								'id' => $data['id'],
								'indice' => $i,
								'ref' => $data['cotizacionRef'],
								'fecha' => $data['facturaFecha'],
								'cantidad' => $data['partidas'],
								'suma' => "$ ".$data['total']
							);
						$i++;
					}
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function facturas_no_pagadas($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT cotizacion.*, contactos.CondPago FROM cotizacion LEFT JOIN contactos ON contactos.id=cotizacion.cliente WHERE (factura LIKE '%$buscar%' OR NoPedClient LIKE '%$buscar%' OR facturaFecha LIKE '%$buscar%') AND cliente = '$idcliente' AND factura!='0' ORDER BY facturaFecha DESC ";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			$i = 1;
			while($data = mysqli_fetch_assoc($resultado)){
				if ($data['CondPago'] == 0) {
					$fecha = $data['facturaFecha'];
					$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
					$vencimiento = date ( 'd-m-Y' , $nuevafecha );
				}else{
					$fecha = $data['facturaFecha'];
					$nuevafecha = strtotime ( '+'.$data['CondPago'].' day' , strtotime ( $fecha ) ) ;
					$vencimiento = date ( 'd-m-Y' , $nuevafecha );
				}

				$arreglo["data"][] = array(
					'id' => $data['id'],
					'indice' => $i,
					'cotizacion' => $data['ref'],
					'remision' => $data['remision'],
					'factura' => $data['factura'],
					'pedido' => $data['NoPedClient'],
					'fechafactura' => date('d-m-Y', strtotime($data['facturaFecha'])),
					'pagado' => "$ ".round($data['Pagado'], 2),
					'suma' => "$ ".round($data['precioTotal'] + ($data['precioTotal']*.16),2),
					'moneda' => strtoupper($data['moneda']),
					'vencefactura' => $vencimiento
				);
				$i++;
			}

		}
		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function remisiones($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (remision LIKE '%$buscar%' OR ref LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR remisionFecha LIKE '%$buscar%') AND Comentario='' AND remision!=0 AND remisionFactura=0 AND cliente='$idcliente' ORDER BY remision DESC ";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'cotizacion' => $data['ref'],
							'remision' => $data['remision'],
							'cliente' => $cliente,
							'contacto' => utf8_encode($data['contacto']),
							'cantidad' => $data['partidaCantidad'],
							'fecha' => $data['remisionFecha'],
							'suma' => "$ ".$data['precioTotal'],
							'moneda' => strtoupper($data['moneda'])
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function cotizaciones($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(mysqli_num_rows($resultado) < 1){
			$arreglo['data'] = 0;
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (ref LIKE '%$buscar%' OR contacto LIKE '%$buscar%' OR fecha LIKE '%$buscar%') AND remision=0 AND comentario='' AND cliente= '$idcliente' ORDER BY fecha DESC";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if(mysqli_num_rows($resultado) < 1){
				$arreglo['data'] = 0;
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i,
							'cotizacion' => $data['ref'],
							'cliente' => $cliente,
							'contacto' => utf8_encode($data['contacto']),
							'fecha' => $data['fecha']
						);
					$i++;
				}
			}
		}

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
	}

	function nuevaremision($idcontacto, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE Pedido='si' AND cliente='$idcontacto' AND Entregado='0000-00-00' AND factura = '0' AND remision='' ORDER BY modelo";
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

		echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}

 ?>
