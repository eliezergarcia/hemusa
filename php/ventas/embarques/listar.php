<?php 
    include("../../conexion.php");
    $opcion = $_POST['opcion'];

	switch ($opcion) {
        case 'partidasembarque':
            $idcliente = $_POST['idcliente'];
			partidas_embarque($idcliente, $conexion_usuarios);
            break;
	}

	function partidas_embarque($idcliente, $conexion_usuarios){
		$query = "SELECT * FROM cotizacionherramientas WHERE embarque = 'pendiente' AND cliente = '$idcliente'";
        $resultado = mysqli_query($conexion_usuarios, $query);

        $i = 1;
        while($data = mysqli_fetch_array($resultado)){
            
            $arreglo['data'][] = array(
                'id' => $data['id'],
                'indice' => $i,
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'cantidad' => $data['cantidad'],
                'descripcion' => $data['descripcion']
            );
            $i++;
        }        

        echo json_encode($arreglo);
        cerrar($conexion_usuarios);
    }

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{ 
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

 ?>