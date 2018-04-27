<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agregar Precio</title>
</head><body link="#0000ff" vlink="#0000ff" alink="#0000ff">


<?php require_once('../../incl/connect.php');
?>
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

$MM_restrictGoTo = "../../ingreso.php";
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











<?php 
error_reporting(E_ALL ^ E_NOTICE);
$ref = $_REQUEST["ref"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];
$clase = $_REQUEST["clase"];
$agregar = $_REQUEST["agregar"];

$EnPortal=false;

if(isset($_POST['EnPortal'])){
	$EnPortal=true;
	}



$sqlmarca="SELECT * FROM marcadeherramientas marcadeherramientas where marca='".$productor."'";
$result=mysql_query($sqlmarca);
while ($row = mysql_fetch_array($result)) {
			
$Idmarca=$row['id'];
$FactorMarca=$row['factor'];
$monedaMarca=$row['moneda'];
	}

if (isset($agregar)) {
	$fecha=date('Y-m-d');require_once('../../incl/connect.php');
$insertSQL = "INSERT INTO Precio".$productor." (ref,precioBase,descripcion,enReserva,clase) VALUES ('$ref',$precioBase,'$descripcion','$enReserva','$clase')";
   mysql_query($insertSQL);
    
	 $inventario_inicial= "INSERT INTO inventario_inicial (marca, modelo, descripcion, precio, stock, clase, fecha, usuario) VALUES ('".$productor."','".$ref."','".$descripcion."','".$precioBase."','".$enReserva."', '".$clase."', '".$fecha."', '".$usuario."')";
   mysql_query($inventario_inicial);
   
     $IdTablaMarca=0;
     $SqlIdTablaMArca="SELECT MAX(id) as ultimo FROM precio".$productor."";
	 $resultId=mysql_query($SqlIdTablaMArca);
	while ($rowId = mysql_fetch_array($resultId)) {
			$IdTablaMarca=$rowId['ultimo'];
	}
	 
  	 $sQlProductos= "INSERT INTO productos (Idmarca, IdTablaMarca, marca, ref, descripcion, precioBase, enReserva, clase, fecha, factor, moneda, EnPortal) VALUES ('".$Idmarca."' , ".$IdTablaMarca.",'".$productor."','".$ref."','".$descripcion."','".$precioBase."','".$enReserva."', '".$clase."', '".$fecha."','".$FactorMarca."', '".$monedaMarca."', '".$EnPortal."')";
   mysql_query($sQlProductos);


$exito=$insertSQL;

if($exito){

	 echo "<script languaje='javascript'>alert('La herramienta se agrego correctamente')</script>";

  
}
}
 ?> 


<br><form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="post">
<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">
<tr valign='top' bgcolor='#ffffff'>
<td width="60">Modelo</td><td width="137">Descripcion</td><td width="61">Productor</td><td width="42">Precio</td><td width="49">En Reserva</td>
<td width="46">Clase</td>
<td width="100">En Portal </td>

</tr>



<tr align="right">
<td valign="top"><input type="text" name="ref" size="10" value="" required/></td>
<td valign="top"><textarea name="descripcion" rows="5" cols="20" value="" required/></textarea>
<td valign="top">

<select name="productor">
<?php require_once('../../incl/connect.php');
$insertSQL = "select * from marcadeherramientas order by marca";
   $result=mysql_query($insertSQL);
   mysql_close($conn);
   while ($row = mysql_fetch_array($result)) {
         echo '<option value="'.$row["marca"].'" label="">'.$row["marca"].'</option>';
	 }

 ?> 
 
</select>
</td>
<td valign="top"><input type="text" name="precioBase" size="7" value="" required/></td>
<td valign="top"><input type="text" name="enReserva" size="7" value="0" required/></td>
<td valign="top"><select name="clase" id="select">
  <option value="A">A</option>
  <option value="D">D</option>
  <option value="E">E</option>
</select></td>
<td>  <input type="checkbox" name="EnPortal" value="1"> Producto en portal de clientes</td>
</table>
<br>
<p>

<table align="center" border="0" width="30%"><tr><td style="text-align: center">
<input type="submit" name="agregar" value="Agregar">
</td><td style="text-align: center">
<a href="../precios.php">Atras</a>
</td></tr>
</table>
</form>

</body>
