<?php 
	include("../../conexion.php");

	$queryEntregas = "SELECT cotizacionherramientas.cotizacionNo, cotizacionherramientas.modelo, cotizacionherramientas.marca, cotizacionherramientas.descripcion, cotizacionherramientas.precioLista, cotizacionherramientas.cantidad, cotizacionherramientas.factura, cotizacionherramientas.remision, cotizacionherramientas.noDePedido, contactos.nombreEmpresa FROM cotizacionherramientas LEFT JOIN contactos on contactos.id=cotizacionherramientas.cliente WHERE  enviadoFecha != '0000-00-00' and  recibidoFecha != '0000-00-00' and recibidoFecha > '2015-01-01' and factura =0 and remision =0 AND cliente != '611' and Entregado = '0000-00-00' and Pedido='si' and programar_entrega = '' order by pedidoFecha DESC";
	
	$resEntregas = mysqli_query($conexion_usuarios, $queryEntregas);

	if(!$resEntregas){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resEntregas)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resEntregas);
	mysqli_close($conexion_usuarios);
 ?>