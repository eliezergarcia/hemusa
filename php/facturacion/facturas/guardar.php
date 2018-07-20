<?php
	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'cancelarfactura':
			$UIDfactura = $_POST['uidFactura'];
			$motivoCancelacion = $_POST['motivoCancelacion'];
			cancelar_factura($UIDfactura, $motivoCancelacion, $conexion_usuarios);
			break;
	}

	function cancelar_factura($UIDfactura, $motivoCancelacion, $conexion_usuarios){
		$query = "UPDATE facturas SET status='cancelada', motivoCancelacion='$motivoCancelacion' WHERE UID='$UIDfactura'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar cancelar la factura en el sistema.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La factura se canceló correctamente.";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}
?>
