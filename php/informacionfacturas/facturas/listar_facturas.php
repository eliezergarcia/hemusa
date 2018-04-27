<?php 
	
	include("../../conexion.php");
	$queryFacturas = "SELECT cotizacion.factura, cotizacion.facturaFecha, cotizacion.factura, cotizacion.cliente, cotizacion.precioTotal, cotizacion.moneda, cotizacion.IVA, contactos.nombreEmpresa FROM cotizacion LEFT JOIN contactos on contactos.id=cotizacion.cliente ORDER BY cotizacion.factura";
	$resFacturas = mysqli_query($conexion_usuarios, $queryFacturas);

	if(!$resFacturas){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resFacturas)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resFacturas);
	mysqli_close($conexion_usuarios);
 ?>