<?php 
	
	include("../../conexion.php");

	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];

	$queryUsuarios = "select contactos.nombreEmpresa as 'cliente', cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.cantidad, cotizacionherramientas.precioLista as 'precio', cotizacionherramientas.moneda, cotizacionherramientas.pedidoFecha as 'fecha', case when cotizacionherramientas.factura =0 THEN cotizacionherramientas.cotizacionNo else cotizacionherramientas.factura end as PedidoH from cotizacionherramientas left join contactos on contactos.id=cotizacionherramientas.cliente where Pedido='si' and pedidoFecha >='".$fechaInicio."' and pedidoFecha <='".$fechaFin."' and cliente!='611' and Entregado='0000-00-00' and recibidoFecha>'0000-00-00' and precioLista>0";
	
	$resUsuarios = mysqli_query($conexion_usuarios, $queryUsuarios);

	if(!$resUsuarios){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resUsuarios)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resUsuarios);
	mysqli_close($conexion_usuarios);
 ?>