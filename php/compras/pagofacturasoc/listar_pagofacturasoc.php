<?php 
	
	include("../../conexion.php");

	$factura = $_POST['factura'];  

	$sql="SELECT utilidad_pedido.*, contactos.nombreEmpresa FROM utilidad_pedido LEFT JOIN contactos on contactos.id=utilidad_pedido.proveedor WHERE factura_proveedor='".$factura."'";
	

	$sql2="SELECT ordendecompras.id, contactos.calle, contactos.colonia, contactos.cp, contactos.ciudad, contactos.estado, contactos.pais, contactos.tlf1, contactos.tlf2, contactos.correoElectronico, ordendecompras.noDePedido, ordendecompras.oa,ordendecompras.factura,  ordendecompras.fecha, contactos.nombreEmpresa, ordendecompras.terminado, usuarios.nombre as contacto FROM ordendecompras LEFT JOIN contactos on contactos.id=ordendecompras.proveedor LEFT JOIN usuarios on usuarios.id=ordendecompras.contacto WHERE terminado='0000-00-00' ORDER BY ordendecompras.fecha DESC";

	$resOrdenCompra = mysqli_query($conexion_usuarios, $sql);

	if(!$resOrdenCompra){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resOrdenCompra)){
			$arreglo["data"][] = $data;
			// array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}

	mysqli_free_result($resOrdenCompra);
	mysqli_close($conexion_usuarios);
?>