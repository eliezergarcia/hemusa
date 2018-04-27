<?php 
	
	include("../../conexion.php");

	$ordencompra = $_POST['ordencompra'];

	$query = "SELECT * FROM cotizacionherramientas WHERE noDePedido = '$ordencompra'";
	
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error');
	}else{
		$i = 1;
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = array(
				'indice' => $i,
				'marca' => "",
				'modelo' => "",
				'descripcion' => "",
				'precioUnitario' => "",
				'cantidad' => "",
				'precioTotal' => "",
				'almacen' => "",
				'fechaCompromiso' => ""				
			);
			$i++;
		}
		echo json_encode($arreglo);
	}

	mysqli_close($conexion_usuarios);
 ?>
	