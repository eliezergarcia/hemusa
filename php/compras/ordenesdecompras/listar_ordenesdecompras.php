<?php 
	
	include("../../conexion.php");

	$query = "SELECT ordendecompras.id, ordendecompras.noDePedido, ordendecompras.Fecha, ordendecompras.proveedor, contactos.nombreEmpresa, usuarios.nombre as contacto FROM ordendecompras LEFT JOIN contactos on contactos.id=ordendecompras.proveedor LEFT JOIN usuarios on usuarios.id=ordendecompras.contacto  WHERE terminado='0000-00-00' ORDER BY fecha DESC LIMIT 999";
	$resultado = mysqli_query($conexion_usuarios, $query);
	
	$arreglo = array();

	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = array(
				'ordencompra' => $data['noDePedido'],
				'proveedor' => utf8_encode($data['nombreEmpresa']),
				'contacto' => $data['contacto'],
				'fecha' => $data['Fecha']
			);
					
		}
	}

	echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
?>