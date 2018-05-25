<?php
    include("../../conexion.php");
    $opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarfolioembarque':
			buscar_folio_embarque($conexion_usuarios);
            break;

        case 'buscarclientes':
			buscar_clientes($conexion_usuarios);
			break;
	}

	function buscar_folio_embarque($conexion_usuarios){
		$query = "SELECT max( folio_embarque) as folio FROM embarques";
        $resultado = mysqli_query($conexion_usuarios, $query);
        while($data = mysqli_fetch_array($resultado)){
            $informacion['folio'] = $data['folio'] + 1;
        }

        echo json_encode($informacion);
        cerrar($conexion_usuarios);
    }

  function buscar_clientes($conexion_usuarios){
		$query = "SELECT id,nombreEmpresa FROM contactos WHERE tipo = 'Cliente' ORDER BY nombreEmpresa";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_array($resultado)){
      $informacion[] = $data['id'];
			$informacion[] = utf8_encode($data['nombreEmpresa']);
		}

		echo json_encode($informacion);
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
