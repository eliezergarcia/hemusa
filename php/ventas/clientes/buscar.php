<?php
	include ('../../conexion.php');
	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'datosusuario':
			$idusuario = $_POST['idusuario'];			
			datosusuario($idusuario, $conexion_usuarios);
			break;

		case 'datoscliente':
			$idcliente = $_POST['idcliente'];
			buscar_datos_cliente($idcliente, $conexion_usuarios);
			break;

		case 'nuevacotizacion':			
			nueva_cotizacion($conexion_usuarios);
			break;

		case 'buscarcontactos':
			$idcliente = $_POST['idcliente'];
			buscar_contactos($idcliente, $conexion_usuarios);
			break;
			
		case 'informacioncontacto':
			$idcliente = $_POST['idcliente'];
			informacion_contacto($idcliente, $conexion_usuarios);
			break;

		case 'nuevaremision':
			$idcontacto = $_POST['idcontacto'];
			nueva_remision($idcontacto, $conexion_usuarios);
			break;

		case 'buscarClientes':
			buscar_clientes($conexion_usuarios);
			break;
	}

	function buscar_clientes($conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Cliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
	}

	function nueva_remision($idcontacto, $conexion_usuarios){
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

		$query = "SELECT max(remision) AS ultimaremision FROM cotizacion";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$remision = $data['ultimaremision'] + 1;
		}

     	$arreglo['resultado'] = "ok";
		$arreglo['numeroCotizacion'] = $numeroCotizacion;
		$arreglo['remision'] = $remision;

		$query = "SELECT nombreEmpresa, moneda FROM contactos WHERE id = '$idcontacto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['cliente'] = $data['nombreEmpresa'];
			$arreglo['moneda'] = $data['moneda'];
		}
		echo json_encode($arreglo);
	}

	function datosusuario($idusuario, $conexion_usuarios){
		$query = "SELECT * FROM usuarios WHERE id = '$idusuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["datosusuario"] = array_map("utf8_encode", $data);
 			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);
	}

	function buscar_datos_cliente($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id ='".$idcliente."'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$informacion['data'] = $data;
		}
		echo json_encode($informacion);
		mysqli_free_result($resultado);
		cerrar($conexion_usuarios);
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
		$arreglo['fecha'] = date("Y-m-d");
		echo json_encode($arreglo);
		cerrar($conexion_usuarios);
	}

	function buscar_contactos($idcliente, $conexion_usuarios){
		$query = "SELECT personaContacto FROM contactospersonas WHERE empresa ='$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) > 0) {
			while($data = mysqli_fetch_array($resultado)){
				$informacion[] = utf8_encode($data['personaContacto']);
			}
		}else{
			$informacion["respuesta"] = "Ninguno";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function informacion_contacto($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['contacto'] = $data;
		}

		echo json_encode($arreglo);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

?>