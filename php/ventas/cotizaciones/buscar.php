<?php 
	include('../../conexion.php');
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
	
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'datosusuario':
			$idusuario = $_POST['idusuario'];			
			datos_usuario($idusuario, $conexion_usuarios);
			break;

		case 'nuevacotizacion':
			nueva_cotizacion($conexion_usuarios);
			break;

		case 'buscarclascliente':
			$refCotizacion = $_POST['refCotizacion'];
			buscar_clas_cliente($refCotizacion, $conexion_usuarios);
			break;

		case 'buscarClientes':
			buscar_clientes($conexion_usuarios);
			break;

		case 'buscarContactos':
			$id = $_POST['id'];
			buscar_contactos($id, $conexion_usuarios);
			break;

		case 'buscarDatosCliente':
			$cliente = $_POST['cliente'];
			buscar_datos_cliente($cliente, $conexion_usuarios);
			break;

		case 'buscarMarcaHerramienta':
			$modelo = $_POST['modelo'];
			buscar_marca_herramienta($modelo, $conexion_usuarios);
			break;

		case 'buscarDatosProducto':
			$modelo = $_POST['modelo'];
			$marca = $_POST['marca'];
			$idcliente = $_POST['idCliente'];
			$refCotizacion = $_POST['refCotizacion'];
			buscar_datos_producto($modelo, $marca, $idcliente, $refCotizacion, $conexion_usuarios);
			break;

		case 'buscarFletes':
			$refCotizacion = $_POST['refCotizacion'];
			buscar_fletes($refCotizacion, $conexion_usuarios);
			break;

		case 'buscarclavesat':
			$descripcion = $_POST['descripcion'];
			buscar_claves_sat($descripcion, $conexion_usuarios);
			break;

		case 'imprimircotizacion':
			$numeroCotizacion = $_POST['numeroCotizacion'];
			imprimir_cotizacion($numeroCotizacion, $conexion_usuarios);
			break;

		case 'buscartotales':
			$numerocotizacion = $_POST['numerocotizacion'];
			buscar_totales($numerocotizacion, $conexion_usuarios);
			break;
	}

	function nueva_cotizacion($conexion_usuarios){
		$n = 101;
     	$numero = substr(date("y"), 1).date("m").date("d").$n;
	   	$query = "SELECT ref FROM cotizacion ORDER BY id DESC LIMIT 100";
     	$resultado = mysqli_query($conexion_usuarios, $query);
     	
     	while($data = mysqli_fetch_array($resultado)){
     		$ultimaCotizacion = str_replace("HMU", "", $data['ref']);
	     	while ($numero <= $ultimaCotizacion) {
	     		$n++;
	     		$numero = substr(date("y"), 1).date("m").date("d").$n;
			}
     	}
		 
		$numeroCotizacion = "HMU".substr(date("y"), 1).date("m").date("d").$n;

     	$arreglo['resultado'] = "ok";
		$arreglo['numeroCotizacion'] = $numeroCotizacion;
		echo json_encode($arreglo);
		cerrar($conexion_usuarios);
	}

	function datos_usuario($idusuario, $conexion_usuarios){
		$query = "SELECT * FROM usuarios WHERE id = '$idusuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["datosusuario"] = $data;
 			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_clas_cliente($refCotizacion, $conexion_usuarios){
		$query = "SELECT cliente FROM cotizacion WHERE ref ='$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idCliente = $data['cliente'];
			}
			$query = "SELECT * FROM contactos WHERE id='$idCliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				verificar_resultado($resultado);
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$informacion['data'] = array_map("utf8_encode", $data);
				}
				echo json_encode($informacion);
			}
		}
		cerrar($conexion_usuarios);
	}

	function buscar_clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Cliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function buscar_contactos($id, $conexion_usuarios){
		$query = "SELECT personaContacto FROM contactospersonas WHERE empresa ='$id' ORDER BY personaContacto ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (mysqli_num_rows($resultado) > 0) {
			while($data = mysqli_fetch_array($resultado)){
				$informacion["idcliente"] = $id;
				$informacion["contactos"][] = utf8_encode($data['personaContacto']);
			}
		}else{
			$informacion["respuesta"] = "Ninguno";
			$informacion["idcliente"] = $id;
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function buscar_datos_cliente($cliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE nombreEmpresa LIKE '%".$cliente."%'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idCliente = $data['id'];
			$arreglo['data'] = $data;
		}

		echo json_encode($arreglo);
		cerrar($conexion_usuarios);
	}

	function buscar_marca_herramienta($modelo, $conexion_usuarios){
		$query = "SELECT marca FROM productos WHERE ref='".$modelo."'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (mysqli_num_rows($resultado) > 0) {
			while($data = mysqli_fetch_array($resultado)){
				$marcas[] = $data['marca'];
			}
		}else{
			$marcas[] = "No existe";
		}

		echo json_encode($marcas);
		cerrar($conexion_usuarios);
	}

	function buscar_datos_producto($modelo, $marca, $idcliente, $refCotizacion, $conexion_usuarios){
		$query = "SELECT * FROM productos WHERE ref ='$modelo' AND marca = '$marca'";
		$resultado = mysqli_query($conexion_usuarios, $query);	
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'] = array_map("utf8_encode", $data);
			if($data['igi'] == 0){
				$arreglo['data']['igi'] = $data['igi'] + 1;
			}else{
				$arreglo['data']['igi'] = $data['igi'] + 1;
			}
			$IdMarca = $data['IdMarca'];
		}
		$query = "SELECT clasificacion FROM contactos WHERE id ='".$idcliente."'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(!$resultado){
			$arreglo['data'] = "Error";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo['clasificacion'] = $data;
			}
			$query = "SELECT * FROM marcadeherramientas WHERE id ='".$IdMarca."'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$arreglo['data'] = "Error";
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo['marca'] = $data;
				}
				$query = "SELECT * FROM cotizacion WHERE ref ='$refCotizacion'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$arreglo['data'] = "Error";
				}else{
					while($data = mysqli_fetch_assoc($resultado)){
						$arreglo['tiempoEntrega'] = $data['TiempoEntrega'];
						$arreglo['moneda'] = $data['moneda'];
					}
					$fecha = date("Y-m-d");
					$query = "SELECT * FROM tipocambio WHERE fecha = '$fecha'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if(!$resultado){
						$arreglo['data'] = "Error";
					}else{
						while($data = mysqli_fetch_assoc($resultado)){
							$arreglo['tipocambio'] = $data;
						}
					}
					$query = "SELECT * FROM modelos_igi WHERE marca = '$marca' AND modelo = '$modelo'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if(mysqli_num_rows($resultado) < 0){
						$arreglo['igi'] = "no";
					}else{
						while($data = mysqli_fetch_assoc($resultado)){
							$arreglo['igi']['igi'] = $data['igi'] + 1;
						}
					}
				}
			}
		}

		echo json_encode($arreglo);
		cerrar($conexion_usuarios);
	}

	function buscar_fletes($refCotizacion, $conexion_usuarios){
		$query = "SELECT proveedor FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$fletes[] = $data['proveedor'];
		}

		echo json_encode($fletes);
		cerrar($conexion_usuarios);
	}

	function buscar_claves_sat($descripcion, $conexion_usuarios){
		list($palabra1, $palabra2, $palabra3) = explode(' ', $descripcion);
		$query = "SELECT ClaveProductoSAT, descripcion FROM productos WHERE descripcion LIKE '%$palabra1%' AND descripcion LIKE '%$palabra2%' AND descripcion LIKE '%$palabra3%' AND ClaveProductoSAT != '' LIMIT 2500";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_array($resultado)){
			$arreglo[] = utf8_encode($data['ClaveProductoSAT']);
			$arreglo[] = utf8_encode($data['descripcion']);
		}

		echo json_encode($arreglo);
	}

	function imprimir_cotizacion($numeroCotizacion, $conexion_usuarios){
		$query = "SELECT * FROM cotizacion WHERE ref = '$numeroCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$idcliente = $data['cliente'];
			$informacion['cotizacion'] = $data;		
			$vencimiento = $data['fecha'];
			$vencimiento = strtotime($vencimiento."+ 30 days"); 
			$vencimiento = date("Y-m-d",$vencimiento);
			$informacion['vencimiento'] = $vencimiento;
		}

		$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$numeroCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$marca = $data['marca'];
			$modelo = $data['modelo'];
			$querymarca = "SELECT * FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
			$resutadomarca = mysqli_query($conexion_usuarios, $querymarca);
			while($datamarca = mysqli_fetch_assoc($resutadomarca)){
				$stock = $datamarca['enReserva'];
			}


			$informacion['partidas'][] = array(
				'marca' => $data['marca'],
				'modelo' => $data['modelo'],
				'descripcion' => $data['descripcion'],
				'cantidad' => $data['cantidad'],
				'precioUnitario' => $data['precioLista'],
				'precioTotal' => $data['precioLista'] * $data['cantidad'],
				'unidad' => $data['Unidad'],
				'tiempoEntrega' => $data['Tiempo_Entrega']." días",
				'stock' => $stock
			);
		}
		$informacion['numeropartidas'] = mysqli_num_rows($resultado);

		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['cliente'] = $data;
		}

		echo json_encode($informacion);
	}

	function buscar_totales($numerocotizacion, $conexion_usuarios){
		$query = "SELECT * FROM cotizacion WHERE ref = '$numerocotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['cotizacion'] = $data;
		}

		echo json_encode($informacion);
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion['respuesta'] = "ERROR";
		}else{
			$informacion['respuesta'] = "BIEN";
		}
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}
?>
