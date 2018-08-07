<?php
	include('../../conexion.php');
	error_reporting(0);

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'marcas':
    marcas($conexion_usuarios);
	}

  function marcas($conexion_usuarios){
    $query = "SELECT marca FROM marcadeherramientas";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_array($resultado)){
      $informacion[] = utf8_encode($data['marca']);
    }

    echo json_encode($informacion);
    mysqli_close($conexion_usuarios);
  }
?>
