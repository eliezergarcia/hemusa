<?php
	include('../../php/conexion.php');
  include('../../php/sesion.php');
  // error_reporting(0);

	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
  $opcion = $_POST["opcion"];
  $informacion = [];

  switch ($opcion) {
    case 'listarcontactos':
      listar_contactos($idusuario, $conexion_usuarios);
      break;

    case 'buscarmensajes':
      $idcontacto = $_POST['idcontacto'];
      buscar_mensajes($idcontacto, $idusuario, $conexion_usuarios);
      break;

		case 'guardarmensaje':
			$idcontacto = $_POST['idcontacto'];
			$mensaje = $_POST['mensaje'];
			guardar_mensaje($idusuario, $idcontacto, $mensaje, $conexion_usuarios);
			break;
  }

  function listar_contactos($idusuario, $conexion_usuarios){
    $query = "SELECT * FROM usuarios WHERE id != $idusuario ORDER BY nombre";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (!$resultado) {

    }else{
      while($data = mysqli_fetch_assoc($resultado)){
				$idcontacto = $data['id'];

				$query2 = "SELECT * FROM mensajeschat WHERE idcontacto = '$idusuario' AND idusuario = '$idcontacto' AND leido = 'no' ORDER BY id DESC LIMIT 1";
				$resultado2 = mysqli_query($conexion_usuarios, $query2);

				if(mysqli_num_rows($resultado2) < 1){
					$informacion['usuarios'][] = array(
						'id' => $idcontacto,
						'nombre' => $data['nombre'],
						'apellidos' => $data['apellidos'],
						'reciente' => "no"
					);
				}else{
					while($data2 = mysqli_fetch_assoc($resultado2)){
						$informacion['usuarios'][] = array(
							'id' => $idcontacto,
							'nombre' => $data['nombre'],
							'apellidos' => $data['apellidos'],
							'reciente' => $data2['mensaje']
						);
					}
				}

      }
    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }

  function buscar_mensajes($idcontacto, $idusuario, $conexion_usuarios){
    $query = "SELECT * FROM mensajeschat WHERE idusuario = '$idusuario' AND idcontacto = '$idcontacto' OR idusuario = '$idcontacto' AND idcontacto = '$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(mysqli_num_rows($resultado) < 1){
      $informacion['mensajes'][] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){
        $informacion['mensajes'][] = $data;
      }
    }

    $query = "SELECT * FROM usuarios WHERE id = '$idcontacto'";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_assoc($resultado)){
      $informacion['contacto'][] = $data;
    }

		$query = "UPDATE mensajeschat SET leido = 'si' WHERE idusuario = '$idcontacto' AND idcontacto = '$idusuario' AND leido = 'no'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }

	function guardar_mensaje($idusuario, $idcontacto, $mensaje, $conexion_usuarios){
		$query = "SELECT id FROM mensajeschat ORDER BY id DESC LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$ultimoid = $data['id'];
		}

		$id = $ultimoid + 1;

		$query = "INSERT INTO mensajeschat (idusuario, idcontacto, mensaje) VALUES ('$idusuario', '$idcontacto', '$mensaje')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['respuesta'] = "ERROR! al guardar el mensaje";
		}else{
			$informacion['respuesta'] = "BIEN! el mensaje se guardo correctamente";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}
?>
