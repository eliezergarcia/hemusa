<?php 
	
	include("../../conexion.php");

	$queryNotas = "SELECT abonos.fecha, abonos.cliente, abonos.deFactura, abonos.descripcion, abonos.valor, abonos.tipo, abonos.subtipo, contactos.nombreEmpresa FROM abonos LEFT JOIN contactos on contactos.id=abonos.cliente WHERE abonos.tipo = 'notacredito' ORDER BY fecha DESC";

	$resNotas = mysqli_query($conexion_usuarios, $queryNotas);

	if(!$resNotas){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resNotas)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resNotas);
	mysqli_close($conexion_usuarios);
 ?>