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

		case 'editarColoresPrincipales':
      $primario = $_POST['primario'];
      $hoverPrimario = $_POST['hoverPrimario'];
      $bordePrimario = $_POST['bordePrimario'];
			$success = $_POST['success'];
      $hoverSuccess = $_POST['hoverSuccess'];
      $bordeSuccess = $_POST['bordeSuccess'];
			$warning = $_POST['warning'];
      $hoverWarning = $_POST['hoverWarning'];
      $bordeWarning = $_POST['bordeWarning'];
			$danger = $_POST['danger'];
      $hoverDanger = $_POST['hoverDanger'];
      $bordeDanger = $_POST['bordeDanger'];
			editar_colores_principales($idusuario, $primario, $hoverPrimario, $bordePrimario, $success, $hoverSuccess, $bordeSuccess, $warning, $hoverWarning, $bordeWarning, $danger, $hoverDanger, $bordeDanger, $conexion_usuarios);
			break;

		case 'tipocambio':
			$cambiodolar = $_POST['cambiodolar'];
			$cambiopeso = $_POST['cambiopeso'];
			$iva = $_POST['iva'];
			tipo_cambio($cambiodolar, $cambiopeso, $iva, $conexion_usuarios);
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

	function editar_colores_principales($idusuario, $primario, $hoverPrimario, $bordePrimario, $success, $hoverSuccess, $bordeSuccess, $warning, $hoverWarning, $bordeWarning, $danger, $hoverDanger, $bordeDanger, $conexion_usuarios){
    $query = "SELECT * FROM colores WHERE usuario = '$idusuario'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    $num = mysqli_num_rows($resultado);

    if($num < 1){
      $query = "INSERT INTO colores (usuario, primario, hoverPrimario, bordePrimario, success, hoverSuccess, bordeSuccess, warning, hoverWarning, bordeWarning, danger, hoverDanger, bordeDanger) VALUES ('$idusuario', '$primario', '$hoverPrimario', '$bordePrimario', '$success', '$hoverSuccess', '$bordeSuccess', '$warning', '$hoverWarning', '$bordeWarning', '$danger', '$hoverDanger', '$bordeDanger')";
    }else{
      $query = "UPDATE colores SET primario='$primario', hoverPrimario='$hoverPrimario', bordePrimario='$bordePrimario', success='$success', hoverSuccess='$hoverSuccess', bordeSuccess='$bordeSuccess', warning='$warning', hoverWarning='$hoverWarning', bordeWarning='$bordeWarning', danger='$danger', hoverDanger='$hoverDanger', bordeDanger='$bordeDanger' WHERE usuario ='$idusuario'";
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

	function tipo_cambio($cambiodolar, $cambiopeso, $iva, $conexion_usuarios){
		$query = "UPDATE cifrasimportantes SET exchangerate='$cambiodolar', cambio_dos='$cambiopeso', comision_ml='$iva' WHERE id = 1";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if(!$resultado){
      $informacion["respuesta"] = "ERROR";
      $informacion["informacion"] = "Ocurrió un error al tratar de modificar la información";
    }else{
      $informacion["respuesta"] = "BIEN";
      $informacion["informacion"] = "La información de tipo de cambio para ventas se modificó correctamente";
    }

    echo json_encode($informacion, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
	}
?>
