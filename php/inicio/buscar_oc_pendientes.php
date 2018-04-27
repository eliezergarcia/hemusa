<?php 	
	include("../conexion.php");

	$query = "SELECT DISTINCT Proveedor FROM cotizacionherramientas WHERE Pedido = 'si' AND noDePedido = ''";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (mysqli_num_rows($resultado) > 0) {
		$n = 0;
		while($data = mysqli_fetch_assoc($resultado)){
			if($data['Proveedor'] != "ALMACEN"){
				$n++;
				$pendientes['respuesta'] = $n;
			}
		}
	}else{
		$pendientes['respuesta'] = 0;
	}

	echo json_encode($pendientes);
	mysqli_close($conexion_usuarios);
 ?>