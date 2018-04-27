<?php require_once('../../Connections/conexion_usuarios.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "ingreso.php";
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
?><?php
$colname_consulta_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_consulta_usuario = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_conexion_usuarios, $conexion_usuarios);
$query_consulta_usuario = sprintf("SELECT * FROM usuarios WHERE `user` = '%s'", $colname_consulta_usuario);
$consulta_usuario = mysql_query($query_consulta_usuario, $conexion_usuarios) or die(mysql_error());
$row_consulta_usuario = mysql_fetch_assoc($consulta_usuario);
$totalRows_consulta_usuario = mysql_num_rows($consulta_usuario);
$usuario=$row_consulta_usuario['nombre'];
$nivel_usuario=$row_consulta_usuario['nivel'];
$departamento=$row_consulta_usuario['dp'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editar herramienta</title>
</head>
<body onLoad="self.focus();document.precio.enReserva.focus()" link="#0000ff" vlink="#0000ff" alink="#0000ff">
<basefont> 
<table border="0" cellpadding="0" cellspacing="0" summary="" align="center">
<tr><td>

<?php

$productor=$_REQUEST["productor"];
$id=$_REQUEST["id"];

   include "../../incl/connect.incl";


$insertSQL = "select * from Precio".$productor." where id = $id";
$result = mysql_query($insertSQL);
echo "<h1>".$productor."</h1>";
echo '<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">';
echo "<tr valign='top' bgcolor='#ffffff'>";
echo "<td>Modelo</td><td>Descripcion</td><td>Precio</td><td>En reserva</td><td>IGI</td>";
echo "</tr>";

$row = mysql_fetch_array($result);


// consulta para saber si el modelo tiene igi
$porcentaje=0;
$id_igi=0;
$sql_igi= "select * from modelos_igi where marca='".$productor."' and modelo ='".$row['ref']."'";
$result_igi = mysql_query($sql_igi);

while($row_igi =mysql_fetch_array($result_igi)){
$id_igi=$row_igi['id'];
$igi_modelo=$row_igi['igi'];	
$porcentaje=$igi_modelo*100;
}

	 echo "<tr>";
	 echo "<td>".$row['ref']."</td><td>".$row['descripcion']."</td><td align='right'>".$row['precioBase']."</td><td align='right'>".$row['enReserva']."</td><td align='right'>".$porcentaje." %</td>";
	 $ref=$row['ref'];
 	 echo "</tr>";


?>
<?php 

echo "<form action='../precios.php?refBusca=".$ref."' name='precio' method='post'>";
mysql_close($conn);
 ?> 
 <tr align="right">
 
<td valign="top"><input type="text" name="ref" size="10" value=""></td>
<td valign="top"><textarea name="descripcion" rows="5" cols="20" value=""></textarea>
<td valign="top" align="right"><input type="text" name="precioBase" size="7" value=""></td>
<?php
 if($nivel_usuario == 0 or $departamento=="Importacion"){
 ?>
<td valign="top" align="right"><input type="text" name="enReserva" size="7" value=""></td>
<?php
 }
 
?>

</td>
<?php

 if($nivel_usuario == 0 or $departamento=="Importacion"){
?>
<td valign="top" align="right"><input type="text" name="igi" size="7" value="">%</td>
<?php
 }
 ?>
</td>
</tr>
</table>
<p>

<?php  
echo '<input type="hidden" name="id" value="'.$id.'">';
echo '<input type="hidden" name="productor" value="'.$productor.'">';
echo '<input type="hidden" name="refold" value="'.$ref.'">';
echo '<input type="hidden" name="id_igi" value="'.$id_igi.'" />';
?> 

<input type="submit" name="edit" value="Cambiar">
<?php  if($nivel_usuario == 0){
	?>
<input type="submit" name="delete" value="Eliminar">
<?php
}
?>


</form>
<?php
echo '<b><a href="solicitud_inventario.php?id_modelo='.$id.'&marca='.$productor.'&ref_modelo='.$ref.'">Ajuste de inventario</a></b>';
?>
</td></tr>
</table>


</body>
