<?php 
	include("../../conexion.php");
    $opcion = $_POST['opcion'];

	switch ($opcion) {		
		case 'quitarhembarque':
			$idherramienta = $_POST['id'];
			quitar_herramienta_embarque($idherramienta, $conexion_usuarios);
			break;
		
		case 'crearembarque':
			$usuario = $_POST['usuario'];
			$folio = $_POST['folio'];
			$idcliente = $_POST['cliente'];
			$peso = $_POST['peso'];
			$dimensiones = $_POST['dimensiones'];
			$observaciones = $_POST['observaciones'];
			crear_embarque($usuario, $folio, $idcliente, $peso, $dimensiones, $observaciones, $conexion_usuarios);
			break;
	}

	function quitar_herramienta_embarque($idherramienta, $conexion_usuarios){
		$query = "UPDATE cotizacionherramientas SET embarque = '' WHERE id = '$idherramienta'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
	}

	function crear_embarque($usuario, $folio, $idcliente, $peso, $dimensiones, $observaciones, $conexion_usuarios){
		$fecha = date("Y-m-d");
		$query = "INSERT INTO embarques (folio_embarque, cliente, fecha_embarque, peso, dimensiones, observaciones, usuario) VALUES ('$folio', '$idcliente', '$fecha', '$peso', '$dimensiones', '$observaciones', '$usuario')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$embarque = "pendiente";
		$query = "UPDATE cotizacionherramientas SET embarque='creado', folio_embarque='$folio' WHERE embarque = '$embarque' AND cliente = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
			verificar_resultado($resultado);
		}else{
			$informacion['respuesta'] = "nuevoembarque";
			$informacion['embarque'] = $folio;
			echo json_encode($informacion);
		}
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{ 
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

 ?>