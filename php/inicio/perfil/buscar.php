<?php
	include("../../conexion.php");
  include("../../sesion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarDatosUsuario':
			buscar_datos_usuario($idusuario, $conexion_usuarios);
			break;
	}

  function buscar_datos_usuario ($idusuario, $conexion_usuarios) {
    $query = "SELECT * FROM usuarios WHERE id = '$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    while($data = mysqli_fetch_assoc($resultado)){
      $informacion["data"] = $data;
    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }
?>
