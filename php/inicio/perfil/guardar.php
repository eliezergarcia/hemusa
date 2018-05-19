<?php
	include("../../conexion.php");
  include("../../sesion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'editarInfo':
      $usuario = $_POST['usuario'];
      $nombreCompleto = $_POST['nombreCompleto'];
      $departamento = $_POST['departamento'];
      $emailHemusa = $_POST['emailHemusa'];
      $emailPersonal = $_POST['emailPersonal'];
      $celular = $_POST['celular'];
      $ubicacion = $_POST['ubicacion'];
      $imss = $_POST['imss'];
      $tipoSangre = $_POST['tipoSangre'];
      $cumple = $_POST['cumple'];
      $genero = $_POST['genero'];
			editar_info($idusuario, $usuario, $nombreCompleto, $departamento, $emailHemusa, $emailPersonal, $celular, $ubicacion, $imss, $tipoSangre, $cumple, $genero, $conexion_usuarios);
			break;
	}

  function editar_info($idusuario, $usuario, $nombreCompleto, $departamento, $emailHemusa, $emailPersonal, $celular, $ubicacion, $imss, $tipoSangre, $cumple, $genero, $conexion_usuarios) {
    $nombres = explode(" ", $nombreCompleto);
    $query = "UPDATE usuarios SET user='$usuario', nombre='$nombres[0]', apellidos='$nombres[1]', dp='$departamento', correoHemusa='$emailHemusa', correoPersonal='$emailPersonal', movil='$celular', direccion='$ubicacion', imss='$imss', tipoSangre='$tipoSangre', fechaNacimiento='$cumple', genero='$genero' WHERE id='$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(!$resultado){
      $informacion["respuesta"] = "ERROR";
      $informacion["informacion"] = "Ocurrió un error al tratar de modificar la información!";
    }else{
      $informacion["respuesta"] = "BIEN";
      $informacion["informacion"] = "La información se modificó correctamente!";
    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }
