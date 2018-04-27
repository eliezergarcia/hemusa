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





<?php 




if($nivel_usuario==0){
	// si el usuario es administrador, procede a mostrar las solicitudes creadas por los demas usuarios.
	
	mostrar_solicitudes();
	
	}
	else{
		// si el usuario no es administrador, lanza un mensaje y redirecciona
	 echo"<script>alert('No tiene acceso a solicitudes contacte al administrador')</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=../precios.php\">"; 	
		}
if(!empty($_GET['id_solicitud_aprobada'])){ // si se presiono el id de alguna solitud para aprobarla
	// se almacena el id con los datos se la marca y modelo , y se modifica el inventario
	$id_solicitud=$_GET['id_solicitud_aprobada'];
	modificar_inventario($id_solicitud);
}

if(!empty($_GET['id_solicitud_rechazada'])){ // si se presiono el id de alguna solitud para aprobarla
	// se almacena el id con los datos se la marca y modelo , y se modifica el inventario
	$id_solicitud=$_GET['id_solicitud_rechazada'];
	modificar_solicitud($id_solicitud);
}






function mostrar_solicitudes(){
	// funcion que imprime las solicitudes creasas por los usuarios, y que esten pendientes
	
 echo "<br><br><center><h2> SOLICITUD DE AJUSTE DE INVENTARIO </h2></center>";
require_once('../../incl/connect.php');
$sql_solicitud_inventario="SELECT * FROM solicitud_inventario WHERE solicitud_aprobada= 'pendiente'  ORDER BY fecha ";

$res_solicitud=mysql_query($sql_solicitud_inventario);

	echo '<center><table  border="1" cellpadding="1px" cellspacing="1" summary="" frame="border" >';
    echo '<th> Marca </th>';
    echo '<th> Modelo </th>';
	echo '<th> Almacen </th>';
    echo '<th> Cantidad Solicitud </th>';
	echo '<th> Acci&oacute;n </th>';
	echo '<th> Cantidad Resultado</th>';
    echo '<th> Motivo </th>';
	echo '<th> Contacto Hemusa </th>';
	echo '<th> Fecha y Hora </th>';
	echo '<th> Aprobar </th>';		
	echo '<th> Rechazar </th>';				
while($row_solicitud=mysql_fetch_array($res_solicitud)){
	
	$id=$row_solicitud['id'];	
    $id_modelo=$row_solicitud['id_modelo'];	
	$marca=$row_solicitud['marca'];	
    $modelo=$row_solicitud['modelo'];	
	$cantidad=$row_solicitud['cantidad'];	
	$accion=$row_solicitud['accion'];	
	$motivo=$row_solicitud['motivo'];
	$contacto_hemusa=$row_solicitud['contacto_hemusa'];	
	$fecha=$row_solicitud['fecha'];	
	$solicitud_aprobada=$row_solicitud['solicitud_aprobada'];		
	
////////////query y while para obtener el stock que se quiere modificar en la solicitud
$sql_inventario="SELECT * FROM precio".$marca." WHERE id='".$id_modelo."' ";
$result_inventario=mysql_query($sql_inventario);
		
while($row_inventario=mysql_fetch_array($result_inventario)){
	$cantidad_actual=$row_inventario['enReserva'];	
}
//////fin del query y while para obtener la cantidad de almacen

	// informacion de la solicitud, del modelo que se quiere modificar existencia

	echo "<tr>";
	echo '<td> '.$marca.' </td>';
	echo '<td> '.$modelo.' </td>';
	echo '<td> <center>'.$cantidad_actual.' </center></td>';
	echo '<td> <center>'.$cantidad.' </center></td>';
	echo '<td><font color="red"> '.$accion.' </font></td>';
	if($accion == "sumar"){
			echo '<td> <center>'.($cantidad_actual+$cantidad).' </center></td>';
		}
		else{
				echo '<td> <center>'.($cantidad_actual-$cantidad).' </center></td>';
						}
	echo '<td> '.$motivo.' </td>';
	echo '<td> '.$contacto_hemusa.' </td>';
	echo '<td> '.$fecha.' </td>';

	
    echo '<td><B> <a  style="text-decoration: none;" href="solicitudes_creadas.php?id_solicitud_aprobada='.$id.'" >Aprobar</a></B></td>';
	
    echo '<td><B> <a  style="text-decoration: none;" href="solicitudes_creadas.php?id_solicitud_rechazada='.$id.'" >Rechazar</a></B></td>';
	
	}
	echo '</table></center>';
	}
	
	
	
	function modificar_inventario($id_solicitud){
		require_once('../../incl/connect.php');
$sql="SELECT * FROM solicitud_inventario WHERE id='".$id_solicitud."' ";
		$result=mysql_query($sql);

		
while($row=mysql_fetch_array($result)){
	
	$id=$row['id'];	
    $id_modelo=$row['id_modelo'];	
	$marca=$row['marca'];	
    $modelo=$row['modelo'];	
	$cantidad=$row['cantidad'];	
	$accion=$row['accion'];	
	$motivo=$row['motivo'];
	$contacto_hemusa=$row['contacto_hemusa'];	
	$fecha=$row['fecha'];	
	$solicitud_aprobada=$row['solicitud_aprobada'];		
$sql_inventario="SELECT * FROM precio".$marca." WHERE id='".$id_modelo."' ";

$result_inventario=mysql_query($sql_inventario);

		
while($row_inventario=mysql_fetch_array($result_inventario)){
	$cantidad_actual=$row_inventario['enReserva'];	
}
	if($accion=="sumar"){
		$cantidad=$cantidad+$cantidad_actual;
		$sql_sumar="UPDATE precio".$marca." SET `enReserva` = ".$cantidad." WHERE id = '".$id_modelo."'";

		 if(!$resultado = mysql_query($sql_sumar)) {
			echo"<script>alert('Error al  modificar inventario ')</script>";	

			 }
		}
		
		elseif($accion=="restar"){
			$cantidad=$cantidad_actual-$cantidad;
			$sql_restar="UPDATE precio".$marca." SET `enReserva` = ".$cantidad." WHERE id = '".$id_modelo."'";
		
		 if(!$resultado = mysql_query($sql_restar)) {
			echo"<script>alert('Error al  modificar inventario ')</script>";	

			 }
		
			}

}
	$sql_aprobar="UPDATE `solicitud_inventario` SET `solicitud_aprobada` = 'aprobada' WHERE id = '".$id_solicitud."'";
 if(!$resultado = mysql_query($sql_aprobar)) {
	echo"<script>alert('Error al  aprobar solicitud ')</script>";	

 }
	
		 echo"<script>alert('La solicitud se aprobo correctamente')</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitudes_creadas.php\">"; 
			

	
		
		}
		
		
		
		function modificar_solicitud($id_solicitud){
			
			require_once('../../incl/connect.php');
$sql_no_aprobar="UPDATE `solicitud_inventario` SET `solicitud_aprobada` = 'no aprobada' WHERE id = '".$id_solicitud."'";
 		if(!$resultado = mysql_query($sql_no_aprobar)) {
			echo"<script>alert('Error al  rechazar solicitud ')</script>";	
			}
	
		 echo"<script>alert('La solicitud se rechazo correctamente')</script>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitudes_creadas.php\">"; 
			
			}
		
		
	echo '	<center><br><b><a href="../precios.php">Listas de Precios</a></b></center>';
 ?> 
</body>
</html>
