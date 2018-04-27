<?php 
	include('../../conexion.php');
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
			die('Error');
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = array_map("utf8_encode", $data);
			}
			echo json_encode($arreglo);
		}
		
		mysqli_free_result($resultado);
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

		echo json_encode($arreglo);
	}

	function facturado_no_entregado($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (ref LIKE '%$buscar%' AND facturaFecha LIKE '%$buscar%') AND Pedido!='0000-00-00' AND fechaEntregado='0000-00-00' AND cliente= '$idcliente' AND factura !='0' ORDER BY factura DESC";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if(mysqli_num_rows($resultado) > 0){
				if (!$resultado) {
					die('Error al buscar herramientano entregado');
				}else{
					$i = 1;
					while($data = mysqli_fetch_assoc($resultado)){
						$arreglo["data"][] = array(
								'id' => $data['id'],
								'indice' => $i, 
								'ref' => $data['ref'], 
								'fecha' => $data['facturaFecha'], 
								'cantidad' => $data['partidaCantidad'], 
								'suma' => $data['precioTotal']
							);
						$i++;
					}
				}
			}else{
				$query = "SELECT * FROM pedidos WHERE entregado ='0000-00-00' and cliente= '$idcliente' and factura != '' ORDER BY factura DESC";
				$resultado = mysqli_query($conexion_usuarios, $query);
				$arreglo = array();
					
				if (!$resultado) {
					// die('Error al buscar herramienta sin pedido');
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

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function sin_entregar($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query="SELECT cotizacionherramientas.*, cotizacion.NoPedClient FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE (marca LIKE '%$buscar%' AND modelo LIKE '%$buscar%' AND descripcion LIKE '%$buscar%' AND noDePedido LIKE '%$buscar%' AND numeroPedido LIKE '%$buscar%' AND enviadoFecha LIKE '%$buscar%' AND recibidoFecha LIKE '%$buscar%') AND Entregado='0000-00-00' AND pedidoFecha!='0000-00-00' AND cotizacionherramientas.cliente ='$idcliente' ORDER BY marca ASC";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				die('Error al buscar herramienta sin entregar');
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$cotizacion = $data['cotizacionRef'];
					// $orden = '<a href=\"../../compras/ordenesdecompras/verOrdenCompra.php?ordenCompra='.$data['noDePedido'].'\">'.$data['noDePedido'].'</a>';
			
					if($data['enviadoFecha'] == '0000-00-00'){
						$enviado = "no";
					}else{
						$enviado = $data['enviadoFecha'];
					}
					
					if($data['recibidoFecha'] == '0000-00-00'){
						$recibido = "no";
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
							'recibido' => $recibido
						);
					$i++;
				}
			}
		}		

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function remisiones($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (remision LIKE '%$buscar%' AND contacto LIKE '%$buscar%' AND remisionFecha LIKE '%$buscar%') AND Comentario='' AND remision!=0 AND remisionFactura=0 AND cliente='$idcliente' ORDER BY remision DESC ";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (!$resultado) {
				die('Error al buscar herramienta sin entregar');
			}else{
				$i = 1;
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo["data"][] = array(
							'id' => $data['id'],
							'indice' => $i, 
							'remision' => $data['remision'], 
							'cliente' => $cliente, 
							'contacto' => utf8_encode($data['contacto']), 
							'cantidad' => $data['partidaCantidad'], 
							'fecha' => $data['remisionFecha'], 
							'suma' => "$ ".$data['precioTotal'],
							'moneda' => $data['moneda']
						);
					$i++;
				}
			}
		}		

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function cotizaciones($idcliente, $buscar, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			die("Error al buscar proveedor");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$cliente = $data['nombreEmpresa'];
			}

			$query = "SELECT * FROM cotizacion WHERE (ref LIKE '%$buscar%' AND contacto LIKE '%$buscar%' AND fecha LIKE '%$buscar%') AND remision=0 AND comentario='' AND cliente= '$idcliente' ORDER BY fecha DESC";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$arreglo = array();

			if (!$resultado) {
				die('Error al buscar herramienta sin entregar');
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

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}
	
 ?>