<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Solicitud inventario</title>
</head><body link="#0000ff" vlink="#0000ff" alink="#0000ff">
<body>
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


if(!empty($_GET['id_modelo'])){ // Si se presiono el enlace que envia el id de la marca, muestra la informacion de la 
//marca en la funcion mostrar marca
	
  $id_modelo=$_GET['id_modelo'];
  $marca=$_GET['marca'];
  $ref=$_GET['ref_modelo'];
  echo "<br><br><center><h2> SOLICITUD DE AJUSTE DE INVENTARIO </h2></center>";
  echo '<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">';
  echo '<tr>';
  echo '<td> Contacto Hemusa </td>';
  echo '<td> '.$usuario.'</td>';
  echo '<input type="hidden" name="contacto_hemusa" value="'.$usuario.'">';
  echo '<form action="solicitud_inventario.php?id_modelo='.$id_modelo.'&marca='.$marca.'&ref_modelo='.$ref.'" method="post">';  
  echo '<tr><td> Marca </td>';
  echo '<td> '.$marca.'</td>';
  echo '<tr><td> Modelo </td>';
  echo '<td> '.$ref.'</td>';
  echo '<input type="hidden" name="contacto_hemusa" value="'.$usuario.'">';
  echo '<input type="hidden" name="id_modelo" value="'.$id_modelo.'">';
  echo '<input type="hidden" name="marca" value="'.$marca.'">';
  echo '<input type="hidden" name="ref" value="'.$ref.'">';
   if(empty($_POST['agregar_pieza']) and empty($_POST['quitar_pieza'])){
	    echo '<tr><td>No. Piezas</td>';
  echo '<td><input type="text" name="cantidad" value="" size="16" /></td>';
  echo '<tr><td> Acci&oacute;n </td>';
  echo '<td><input type="checkbox" name="agregar_pieza" value="sumar"   onchange="submit()" /> AGREGAR INVENTARIO ';
  echo '<input type="checkbox" name="quitar_pieza" value="restar"  onchange="submit()" /> 	QUITAR AL INVENTARIO </td>';
	   }

else if(isset($_POST['agregar_pieza'])){
	
	require_once('../../incl/connect.php');
$sql_stock="SELECT * FROM Precio".$marca." where id ='".$id_modelo."' ";

$resultado_stock=mysql_query($sql_stock);

while($row_stock=mysql_fetch_array($resultado_stock)){
$stock_anterior=$row_stock['enReserva'];	

}
	echo  "<center> <font color= 'red'>Actualmente hay : ".$stock_anterior.", con el cambio habr&aacute; : ".($stock_anterior+$_POST['cantidad'])." </center> </font>";
	echo '<tr><td>No. Piezas</td>';
    echo '<td><input type="text" name="cantidad" value="'.$_POST['cantidad'].'" size="16" /></td>';
    echo '<tr><td> Acci&oacute;n </td>';

	 echo '<td><input type="checkbox" name="agregar_pieza" value="sumar"  onchange="submit()"  checked/> AGREGAR INVENTARIO </td>';
	}
	
else if(isset($_POST['quitar_pieza'])){
require_once('../../incl/connect.php');
$sql_stock="SELECT * FROM Precio".$marca." where id ='".$id_modelo."' ";

$resultado_stock=mysql_query($sql_stock);

while($row_stock=mysql_fetch_array($resultado_stock)){
$stock_anterior=$row_stock['enReserva'];	

}
	echo  "<center> <font color= 'red'>Actualmente hay : ".$stock_anterior.", con el cambio habr&aacute; : ".($stock_anterior-$_POST['cantidad'])." </center> </font>";
	echo '<tr><td>No. Piezas</td>';
    echo '<td><input type="text" name="cantidad" value="'.$_POST['cantidad'].'" size="16" /></td>';
    echo '<tr><td> Acci&oacute;n </td>';
	echo '<td><input type="checkbox" name="quitar_pieza" value="restar"  onchange="submit()"  checked /> 	QUITAR AL INVENTARIO </td>';	
}
 
  echo '<tr><td>MOTIVO</td>';
  echo '<td><textarea id="motivo_ajuste" name="motivo_ajuste" rows="5" cols="50"></textarea></td>';
  echo '</table>';
  echo '<center><br><input type="submit" name="enviar_solicitud" value="Enviar" /><br></center>';
  echo '</form>';
  
	
}


	

if(!empty($_POST['enviar_solicitud'])){
		    
	$contacto_hemusa=$_POST['contacto_hemusa'];
	$id_modelo=$_POST['id_modelo'];
	$marca=$_POST['marca'];
	$modelo=$_POST['ref'];
	$cantidad=$_POST['cantidad'];	
	$motivo=$_POST['motivo_ajuste'];	
	 if(is_numeric($cantidad)) {
		 

	
	if(!empty($_POST['agregar_pieza']) and !empty($_POST['quitar_pieza'])){
		echo"<script>alert('No procede solicitud, seleccione agregar o quitar')</script>";	
	
echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitud_inventario.php?id_modelo=".$id_modelo."&marca=".$marca."&ref_modelo=".$modelo."\">"; 
		}
		else if(!empty($_POST['agregar_pieza'])){
			$accion=$_POST['agregar_pieza'];	
			crear_solicitud($id_modelo, $marca, $modelo, $cantidad ,$accion, $motivo,$contacto_hemusa );
			}
			else if(!empty($_POST['quitar_pieza'])){
				$accion=$_POST['quitar_pieza'];	
				crear_solicitud($id_modelo, $marca, $modelo, $cantidad ,$accion, $motivo,$contacto_hemusa);
				}	
				
				else if(empty($_POST['agregar_pieza']) and empty($_POST['quitar_pieza'])){
				 echo"<script>alert('No procede solicitud, seleccione agregar o quitar')</script>";	
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitud_inventario.php?id_modelo=".$id_modelo."&marca=".$marca."&ref_modelo=".$modelo."\">"; 
					
					}
					
					
	 } //Fin del if is numeric cantidad
	 else{
		 echo"<script>alert('Cantidad no valida ')</script>";
		 		echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitud_inventario.php?id_modelo=".$id_modelo."&marca=".$marca."&ref_modelo=".$modelo."\">"; 
					
		 }
	
}


function crear_solicitud($id_modelo, $marca, $modelo, $cantidad ,$accion, $motivo,$contacto_hemusa){
require_once('../../incl/connect.php');
$sql_solicitud= 
"INSERT INTO solicitud_inventario 
(id,
 id_modelo,
 marca, modelo, cantidad, accion, motivo, contacto_hemusa, solicitud_aprobada)
values 
('',
 '$id_modelo',
 '$marca',
 '$modelo', '$cantidad', '$accion', '$motivo', '$contacto_hemusa', 'pendiente')";



if(!$resultado = mysql_query($sql_solicitud)) {
	echo"<script>alert('Error al  crear solicitud ')</script>";	
	 die();
	}
	else{

	 echo"<script>alert('La solicitud se envio correctamente')</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=../precios.php\">"; 	
	}
	
	}






?>
</body>