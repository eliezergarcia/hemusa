<?php 
	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'cancelarfactura':
			$folio = $_POST['folio'];
			cancelar_factura($folio, $conexion_usuarios);
			break;
	}

	function cancelar_factura($folio, $conexion_usuarios){
		$status = "cancelada";
		$query = "UPDATE facturas SET status='$status' WHERE folio='$folio'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		verificar_resultado($resultado);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}

		echo json_encode($informacion);
	}

?>