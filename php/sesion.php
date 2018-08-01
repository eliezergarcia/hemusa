<?php

	// Iniciamos la sesión
	if (!isset($_SESSION)) {
		ini_set("session.cookie_lifetime","18000");
		ini_set("session.gc_maxlifetime","18000");
		session_start();
	}

	// Con esta variable se cierra la sesión iniciada
	$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";

	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
		$logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  		// Para desconectarnos completamente del visitante, necesitamos borrar las variables de la sesión
  		$_SESSION['MM_Username'] = NULL;
	  	$_SESSION['MM_UserGroup'] = NULL;
	  	$_SESSION['PrevUrl'] = NULL;
	  	unset($_SESSION['MM_Username']);
	  	unset($_SESSION['MM_UserGroup']);
	  	unset($_SESSION['PrevUrl']);

  		$logoutGoTo = $ruta."index.php";
  		if ($logoutGoTo) {
    		header("Location: $logoutGoTo");
    		exit;
  		}
	}

	if (!isset($_SESSION)) {
		session_start();
	}

	$MM_authorizedUsers = "";
	$MM_donotCheckaccess = "true";

	// Restringe el acceso a la página
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {

  	// Declaramos la variable False para asumir que el visitante no está autorizado
  	$isValid = False;

  	// Cuando un visitante inicia sesión en este sitio, la variable de sesión MM_Username establece igual a su nombre de usuario.

  	// Por lo tanto, sabemos que un usuario NO está conectado si esa variable de sesión está en blanco.
  	if (!empty($UserName)) {

    // Además de haber iniciado sesión, puede restringir el acceso solo a ciertos usuarios basándose en una identificación establecida cuando inician sesión.

    // Analiza las cadenas en matrices.
	    $arrUsers = Explode(",", $strUsers);
	    $arrGroups = Explode(",", $strGroups);
	    if (in_array($UserName, $arrUsers)) {
	    	$isValid = true;
	    }

	    // O bien, puede restringir el acceso solo a ciertos usuarios en función de su nombre de usuario.
	    if (in_array($UserGroup, $arrGroups)) {
	    	$isValid = true;
	    }
	    if (($strUsers == "") && true) {
	    	$isValid = true;
	    }
	}
	return $isValid;
}

	$MM_restrictGoTo = "login.php";

	if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  		$MM_qsChar = "?";
  		$MM_referrer = $_SERVER['PHP_SELF'];
  		if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  			if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  		$MM_referrer .= "?" . $QUERY_STRING;
  		$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  		header("Location: ". $MM_restrictGoTo);
  		exit;
	}

	$colname_consulta_usuario = "-1";
	if (isset($_SESSION['MM_Username'])) {
  	$colname_consulta_usuario = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
	}

	// mysqli_select_sdb($conexion, $db);
	$query_consulta_usuario = sprintf("SELECT * FROM usuarios WHERE `user` = '%s'", $colname_consulta_usuario);
	$consulta_usuario = mysqli_query($conexion_usuarios, $query_consulta_usuario) or die(mysqli_error());
	$row_consulta_usuario = mysqli_fetch_assoc($consulta_usuario);
	$totalRows_consulta_usuario = mysqli_num_rows($consulta_usuario);
	$idusuario=$row_consulta_usuario['id'];
	$user=$row_consulta_usuario['user'];
	$usuario=$row_consulta_usuario['nombre'];
	$usuarioApellido=$row_consulta_usuario['apellidos'];
	$nivel_usuario=$row_consulta_usuario['nivel'];
	$departamento_usuario=$row_consulta_usuario['dp'];
	$usuariologin = $row_consulta_usuario['nombre']." ".$row_consulta_usuario['apellidos'];
	$dplogin = $row_consulta_usuario['dp'];
	$tipomenu = $row_consulta_usuario['tipomenu'];
	$avatar = $row_consulta_usuario['avatar'];
?>
