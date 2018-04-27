<?php 
	
	include("../../conexion.php");
	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];
	
	// sql para herramientas que no estan enviadas ni recibidas
	$sql_sin_enviar ="SELECT cotizacionherramientas.id, cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.cantidad, cotizacionherramientas.pedidoFecha, cotizacionherramientas.noDePedido, cotizacionherramientas.Proveedor, cotizacionherramientas.enviadoFecha, contactos.nombreEmpresa FROM cotizacionherramientas LEFT JOIN contactos on contactos.id=cotizacionherramientas.cliente WHERE  pedido='si' and noDePedido != '' and enviadoFecha = '0000-00-00' and pedidoFecha >='".$fechaInicio."'  and pedidofecha <='".$fechaFin."' and recibidoFecha ='0000-00-00' and Entregado ='0000-00-00' ORDER BY pedidoFecha DESC";


	$resSin_enviar = mysqli_query($conexion_usuarios, $sql_sin_enviar);

	if(!$resSin_enviar){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resSin_enviar)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}

	mysqli_free_result($resSin_enviar);
	mysqli_close($conexion_usuarios);
 ?>

