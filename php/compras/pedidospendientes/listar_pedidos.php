<?php 
	
	include("../../conexion.php");

	$sql_pedidos="SELECT * FROM cotizacionherramientas WHERE Proveedor != 'none' AND Proveedor != 'ALMACEN' AND  proveedorFecha =  '0000-00-00' AND Pedido =  'si'  AND pedidoFecha > '2015-01-01' ORDER BY Proveedor";

	$resultado_pedidos = mysqli_query($conexion_usuarios, $sql_pedidos);

	// while($row_pedidos = mysqli_fetch_array($resultado_pedidos)){	
	// 	$marca=$row_pedidos['marca'];	
	// 	$modelo=$row_pedidos['modelo'];	
	// 	$almacen=&buscar_stock($marca, $modelo);
	// 	$proveedor=$row_pedidos['Proveedor'];	
	// 	// $numero_proveedor=&id_contacto($proveedor);
	// 	// $tabla=&buscar_tabla($numero_proveedor);
	// 	// $precio_modelo=&buscar_precio($marca, $modelo, $tabla);
	// 	// $factor=&factor_descuento($numero_proveedor);
	// 	// $precio_modelo=$precio_modelo*$factor;
	// 	// $precio_modelo=number_format($precio_modelo,2,".","");

	// 	echo $almacen;
	// 	echo $proveedor;
	// }


	// function &buscar_stock($marca, $modelo){	

	// 	$server = "localhost";
	// 	$user = "root";
	// 	$password = "";
	// 	$db = "hemusapruebas";

	// 	$conexion_usuarios = mysqli_connect("localhost", "root", "", "hemusapruebas");
	// 	if(!$conexion_usuarios){
	// 		die('Error de conexión: ' . mysqli_connect_errno());
	// 	}

	// 	$sql_buscar_stock ="SELECT enReserva FROM  `precio".$marca."` WHERE `ref` = '$modelo'";

	// 	$resultado_stock=mysql_query($sql_buscar_stock);

	// 	if(!$resultado_stock){
	// 		// while($row_stock=mysqli_fetch_array($resultado_stock)){
	// 		// 	$almacen=$row_stock['enReserva'];				
	// 		// }
	// 	}else{
	// 		while($row_stock =mysqli_fetch_array($resultado_stock)){
	// 			$almacen=$row_stock['enReserva'];				
	// 		}
	// 	}
		
	// 	if(empty($almacen)){
	// 		$almacen=0;
	// 	}
	// 		return $almacen;	
	// }
	
	// function &id_contacto($proveedor){
	// 	include_once("../../conexion.php");
	
	// 	$sql_id_contacto ="SELECT id FROM  `contactos` WHERE `nombreEmpresa` = '.$proveedor.'"; //query para obtener el nombre de la empresa
	// 	$resultado_id=mysql_query($sql_id_contacto);

	// 	while($row_id =mysql_fetch_array($resultado_id)){
	// 		$id_contacto=$row_id['id'];	
	// 		// se almacena el nombre de la empresa en la variable nombre contacto
	// 	}
	// 		//Retorna el nombre del contacto
	// 	return $id_contacto;
	// }	

	$query_pedidos_pendientes ="SELECT cotizacionherramientas.id, cotizacionherramientas.marca, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.cantidad, cotizacionherramientas.pedidoFecha, cotizacionherramientas.noDePedido, cotizacionherramientas.Proveedor, cotizacionherramientas.enviadoFecha, cotizacionherramientas.Proveedor, cotizacionherramientas.proveedorFecha, cotizacionherramientas.precioLista, nombreEmpresa FROM cotizacionherramientas LEFT JOIN contactos ON contactos.id=cotizacionherramientas.cliente WHERE Proveedor !=  'ALMACEN' AND Proveedor !=  'none' AND  proveedorFecha =  '0000-00-00' AND Pedido =  'si'  AND pedidoFecha > '2015-01-01' AND pedidoFecha > '2015-01-01'";

	$resPedidos = mysqli_query($conexion_usuarios, $query_pedidos_pendientes);

	if(!$resPedidos){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resPedidos)){
			$arreglo["data"][] = array_map("utf8_encode", $data); 
		}
		echo json_encode($arreglo);
	}

	mysqli_free_result($resPedidos);
	mysqli_close($conexion_usuarios);
 ?>