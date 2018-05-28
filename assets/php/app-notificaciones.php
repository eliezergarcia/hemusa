<?php
	include('../../php/conexion.php');
  include('../../php/sesion.php');
  // error_reporting(0);

  $opcion = $_POST["opcion"];

  switch ($opcion) {
    case 'buscarMensajesChat':
      buscar_mensajes_chat($idusuario, $conexion_usuarios);
      break;
  }

  function buscar_mensajes_chat($idusuario, $conexion_usuarios){
    $query = "SELECT * FROM mensajeschat WHERE idcontacto = '$idusuario' AND leido = 'no'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) > 0) {
      while($data = mysqli_fetch_assoc($resultado)){
        $idcontacto = $data['idusuario'];
      }

      $query = "SELECT * FROM usuarios WHERE id = '$idcontacto'";
      $resultado = mysqli_query($conexion_usuarios, $query);

      while($data = mysqli_fetch_assoc($resultado)){
        $nombreContacto = $data['nombre']." ".$data['apellidos'];
        $avatar = $data['avatar'];
      }

      $informacion['contacto'] = $nombreContacto;
      $informacion['avatar'] = $avatar;

    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }
?>
