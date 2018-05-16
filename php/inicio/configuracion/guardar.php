<?php
	include("../../conexion.php");
  include("../../sesion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'editarColoresEntorno':
      $headerPrincipal = $_POST['headerPrincipal'];
      $menuLateral = $_POST['menuLateral'];
      $textoMenuLateral = $_POST['textoMenuLateral'];
      $htextoMenuLateral = $_POST['htextoMenuLateral'];
      $encabezadoMenu = $_POST['encabezadoMenu'];
      $submenuLateral = $_POST['submenuLateral'];
      $hSubmenuLateral = $_POST['hSubmenuLateral'];
			$bordesMenu = $_POST['bordesMenu'];
			editar_colores_entorno($idusuario, $headerPrincipal, $menuLateral, $textoMenuLateral, $htextoMenuLateral, $encabezadoMenu, $submenuLateral, $hSubmenuLateral, $bordesMenu, $conexion_usuarios);
			break;
	}

  function editar_colores_entorno($idusuario, $headerPrincipal, $menuLateral, $textoMenuLateral, $htextoMenuLateral, $encabezadoMenu, $submenuLateral, $hSubmenuLateral, $bordesMenu, $conexion_usuarios){
    $query = "SELECT * FROM colores WHERE usuario = '$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    $num = mysqli_num_rows($resultado);

    if($num < 1){
      $query = "INSERT INTO colores (usuario, headerPrincipal, menuLateral, textoMenuLateral, htextoMenuLateral, encabezadoMenu, submenuLateral, hSubmenuLateral, bordesMenu) VALUES ('$idusuario', '$headerPrincipal', '$menuLateral', '$textoMenuLateral', '$htextoMenuLateral', '$encabezadoMenu', '$submenuLateral', '$hSubmenuLateral', '$bordesMenu')";
    }else{
      $query = "UPDATE colores SET headerPrincipal='$headerPrincipal', menuLateral='$menuLateral', textoMenuLateral='$textoMenuLateral', htextoMenuLateral='$htextoMenuLateral', encabezadoMenu='$encabezadoMenu', submenuLateral='$submenuLateral', hSubmenuLateral='$hSubmenuLateral', bordesMenu='$bordesMenu' WHERE usuario ='$idusuario'";
    }

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
?>
