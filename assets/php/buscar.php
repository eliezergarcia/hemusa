<?php
	include("../../php/conexion.php");
  include("../../php/sesion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarConfiguracion':
			buscar_configuracion($idusuario, $conexion_usuarios);
			break;
	}

  function buscar_configuracion ($idusuario, $conexion_usuarios) {
    $query = "SELECT * FROM colores WHERE usuario = '$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(mysqli_num_rows($resultado) < 1){
      $query = "SELECT * FROM colores WHERE usuario = 'default'";
      $resultado = mysqli_query($conexion_usuarios, $query);
    }

    while($data = mysqli_fetch_assoc($resultado)){
      $informacion['data'] = $data;
    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }
?>
