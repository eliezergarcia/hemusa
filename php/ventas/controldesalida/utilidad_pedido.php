<?php 

require_once('../incl/connect.php');
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
	
  $logoutGoTo = "../index.php";
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

$MM_restrictGoTo = "../ingreso.php";
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

?>




<!doctype html>
<html>
<link rel="shortcut icon" type="image/x-icon" href="../img/icono.ico">
<head>

<title>Utilidad pedido</title>
</head>

<body>
<font color="14A29B"><center> <h3><i>DESCRIPCION DEL PEDIDO</i></h3> </center>

</font></h3><br><br>

<?php


set_time_limit(1000);
echo'<form name="" action="utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas" method="GET" >';
if(!empty($_GET['orden_compra'])){

$sql_filtrar="";

//$usuario=$row_consulta_usuario['user'];
	// obtiene orden compra 
	 $orden_compra=$_GET['orden_compra']; 	
	 //obtiene moneda del proveedor
	  $moneda=$_GET['moneda_proveedor']; 
	  echo" MONEDA DEL PROVEEDOR " .$moneda."<br>";
	  // obtiene partidas de la orden de compra
	   $numero_partidas=$_GET['partidas']; 
	   echo" NUMERO PARTIDAS " .$numero_partidas."<br>";
	   
$sql_actualizar="WHERE orden_compra = '".$orden_compra."'";
	  // funcion para obtener la fecha 
	   $fecha=&obtener_fecha($orden_compra);
	   // funcion para obtener el tipo de cambio la fecha de la oc.
	   $tipo_cambio=&obtener_tipo_cambio($fecha);
	   // se obtienen los pedidos de la orden de compra

 obteniendo_cotizaciones($orden_compra, $tipo_cambio,$moneda, $fecha, $numero_partidas);
 filtro();
 if($numero_partidas > 0){
 mostrar_utilidad_pedido($orden_compra, $moneda, $sql_filtrar, $numero_partidas, $sql_actualizar, $usuario);
 }
echo "<br> <b><a href='editar_utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas'>Editar </a></b>";		
echo "<br><b><a href='ordenDeCompras.php'>Orden de Compras </a></b>";		

echo "<br><b><a href='../hemusa.php'>Inicio </a></b>";	

	   	 }
		 

	  


if(!empty($_GET['filtro'])){

	


require_once('../incl/connect.php');
		

$orden_compra_filtro=$_GET['orden_compra_filtro']; 	
$moneda_filtro=$_GET['moneda_proveedor_filtro']; 	
$numero_partidas_filtro=$_GET['numero_partidas_filtro']; 	
echo" MONEDA DEL PROVEEDOR " .$moneda_filtro."<br>";
echo" NUMERO PARTIDAS " .$numero_partidas_filtro."<br>";
  // funcion para obtener la fecha 
	   $fecha=&obtener_fecha($orden_compra_filtro);
	   // funcion para obtener el tipo de cambio la fecha de la oc.
	   $tipo_cambio=&obtener_tipo_cambio($fecha);

$sql_filtrar="SELECT * from utilidad_pedido WHERE orden_compra='".$orden_compra_filtro."'";
$sql_actualizar= "WHERE orden_compra = '".$orden_compra_filtro."'";
		  if(!empty($_GET['enviado'])){
			 	$enviado= $_GET['enviado']; 
		$contador=0;		
		foreach($enviado as $element)  
		{ 
		if($contador==0){
			$sql_filtrar=$sql_filtrar." and fecha_enviado= '$element'";
			$sql_actualizar=$sql_actualizar." and fecha_enviado= '$element'";
			$contador++;
			}
			else{
			$sql_filtrar=$sql_filtrar." or fecha_enviado= '$element'";
			$sql_actualizar=$sql_actualizar." or fecha_enviado= '$element'";
			$contador++;
				}
		
		//echo $elment;
		}
			 }
		 
		  
		 if(!empty($_GET['recibido'])){
			 	$recibido= $_GET['recibido']; 
		$contador=0;		
		foreach($recibido as $element)  
		{ 
		if($contador==0){
			$sql_filtrar=$sql_filtrar." and fecha_llegada= '$element'";
			$sql_actualizar=$sql_actualizar." and fecha_llegada= '$element'";
			$contador++;
			}
			else{
			$sql_filtrar=$sql_filtrar." or fecha_llegada= '$element'";
			$sql_actualizar=$sql_actualizar." or fecha_llegada= '$element'";
			$contador++;
				}
		
		//echo $element;
		}
			 }
		 
		 
		 
		 if(!empty($_GET['marca'])){
			 	$marca= $_GET['marca']; 
		$contador=0;		
		foreach($marca as $element)  
		{ 
		if($contador==0){
			$sql_filtrar=$sql_filtrar." and marca= '$element'";
			$sql_actualizar=$sql_actualizar." and marca= '$element'";
			$contador++;
			}
			else{
			$sql_filtrar=$sql_filtrar." or marca= '$element'";
			$sql_actualizar=$sql_actualizar." or marca= '$element'";
			$contador++;
				}
		
		//echo $element;
		}
			 }
		if(!empty($_GET['modelo'])){
			 	$modelo= $_GET['modelo']; 
		
		$contador=0;
		foreach($modelo as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and modelo= '$element'";
		$sql_actualizar=$sql_actualizar." and modelo= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or modelo= '$element'";
		$sql_actualizar=$sql_actualizar." or modelo= '$element'";
		$contador++;
		}
			
		//echo $element;
		}
			 }
		if(!empty($_GET['proveedor'])){
			 	$proveedor= $_GET['proveedor']; 
		$contador=0;
		foreach($proveedor as $element)  
		{ 
		
$sql_numero_proveedor="SELECT id from contactos WHERE nombreEmpresa='".$element."'";

$result_numero_proveedor = mysql_query($sql_numero_proveedor);


while($rowid=mysql_fetch_array($result_numero_proveedor)){

	$numero_proveedor=$rowid['id'];

}

		
		if($contador==0){
				
		$sql_filtrar=$sql_filtrar." and proveedor= '$numero_proveedor'";
		$sql_actualizar=$sql_actualizar." and proveedor= '$numero_proveedor'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or proveedor= '$numero_proveedor'";
		$sql_actualizar=$sql_actualizar." or proveedor= '$numero_proveedor'";
		$contador++;
		}
		
		//echo $element;
		}
			 }
		if(!empty($_GET['entrada'])){
			 	$entrada= $_GET['entrada']; 
		$contador=0;
		foreach($entrada as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and entrada= '$element'";
		$sql_actualizar=$sql_actualizar." and entrada= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or entrada= '$element'";
		$sql_actualizar=$sql_actualizar." or entrada= '$element'";
		$contador++;
		}
	//	echo $element;
		}
			 }
		if(!empty($_GET['cliente'])){
			 	$cliente= $_GET['cliente']; 
		$contador=0;
		foreach($cliente as $element)  
		{ 
		
$sql_numero_cliente="SELECT id from contactos WHERE nombreEmpresa='".$element."'";

$result_numero_cliente = mysql_query($sql_numero_cliente);


while($rowid=mysql_fetch_array($result_numero_cliente)){

	$numero_cliente=$rowid['id'];

}
		
		
			if($contador==0){
		$sql_filtrar=$sql_filtrar." and cliente= '$numero_cliente'";
		$sql_actualizar=$sql_actualizar." and cliente= '$numero_cliente'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or cliente= '$numero_cliente'";
		$sql_actualizar=$sql_actualizar." or cliente= '$numero_cliente'";
		$contador++;
		}
		//echo $element;
		}
			 }
	
		if(!empty($_GET['pedido'])){
			 	$pedido= $_GET['pedido']; 
		$contador=0;		
		foreach($pedido as $element)  
		{ 
			if($contador==0){
		$sql_filtrar=$sql_filtrar." and orden_compra= '$element'";
		$sql_actualizar=$sql_actualizar." and orden_compra= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or orden_compra= '$element'";
		$sql_actualizar=$sql_actualizar." or orden_compra= '$element'";
		$contador++;
		}
		
		//echo $element;
		}
			 }
	if(!empty($_GET['factura_proveedor'])){
			 	$factura_proveedor= $_GET['factura_proveedor']; 
		$contador=0;				
		foreach($factura_proveedor as $element)  
		{ 
		
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and factura_proveedor= '$element'";
		$sql_actualizar=$sql_actualizar." and factura_proveedor= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or factura_proveedor= '$element'";
		$sql_actualizar=$sql_actualizar." or factura_proveedor= '$element'";
		$contador++;
		}
	  //echo $element;
		}
			 }
	if(!empty($_GET['factura_hemusa'])){
		$factura_hemusa= $_GET['factura_hemusa']; 
		$contador=0;	
		foreach($factura_hemusa as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and factura_hemusa= '$element'";
		$sql_actualizar=$sql_actualizar." and factura_hemusa= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or factura_hemusa= '$element'";
		$sql_actualizar=$sql_actualizar." or factura_hemusa= '$element'";
		$contador++;
		}
		
		
		//echo $element;
		}
			 }
	if(!empty($_GET['remision'])){
        $remision= $_GET['remision']; 
		$contador=0;	
		foreach($remision as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and remision= '$element'";
		$sql_actualizar=$sql_actualizar." and remision= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or remision= '$element'";
		$sql_actualizar=$sql_actualizar." or remision= '$element'";
		$contador++;
		}
	
		//echo $element;
		}
			 }
			 
	if(!empty($_GET['utilidad'])){
		$utilidad= $_GET['utilidad']; 
		$contador=0;	
		foreach($utilidad as $element)  
		{ 
		
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and utilidad= '$element'";
		$sql_actualizar=$sql_actualizar." and utilidad= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or utilidad= '$element'";
		$sql_actualizar=$sql_actualizar." or utilidad= '$element'";
		$contador++;
		}
		
		
		//echo $element;
		}
			 }
			 
	if(!empty($_GET['folio_filtro'])){
		$folio_filtro= $_GET['folio_filtro']; 
		$contador=0;	
		foreach($folio_filtro as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and folio= '$element'";
		$sql_actualizar=$sql_actualizar." and folio= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or folio= '$element'";
		$sql_actualizar=$sql_actualizar." or folio= '$element'";
		$contador++;
		}
		
		
		//echo $element;
		}
			 }
	if(!empty($_GET['pedimento_filtro'])){
	    $pedimento_filtro= $_GET['pedimento_filtro']; 
		$contador=0;
		foreach($pedimento_filtro as $element)  
		{ 
		if($contador==0){
		$sql_filtrar=$sql_filtrar." and Pedimento= '$element'";
		$sql_actualizar=$sql_actualizar." and Pedimento= '$element'";
		$contador++;
		}
		else{
		$sql_filtrar=$sql_filtrar." or Pedimento= '$element'";
		$sql_actualizar=$sql_actualizar." or Pedimento= '$element'";
		$contador++;
		}
		
		
		
		
		//echo $element;
		}
			 }

filtro();
mostrar_utilidad_pedido($orden_compra_filtro, $moneda_filtro, $sql_filtrar, $numero_partidas_filtro, $sql_actualizar);
echo "<br> <b><a href='editar_utilidad_pedido.php?orden_compra=$orden_compra_filtro&moneda_proveedor=$moneda_filtro&partidas=$numero_partidas_filtro'>Editar </a></b>";		
echo "<br><b><a href='ordenDeCompras.php'>Orden de Compras </a></b>";		

echo "<br><b><a href='../hemusa.php'>Inicio </a></b>";	


	}


echo ' <br><br> <label type="label">Pedimento: </label>';
echo '<input type="text" name="pedimento" value="" size="10" />';
echo '  <label type="label">Folio: </label>';
echo '<input type="text" name="folio" value="" size="10" />';
echo '<label type="label">Factura: </label>';
echo '<input type="text" name="factura" value="" size="10" />';
echo '<label type="label">Entrada: </label>';
echo '<input type="text" name="agregar_entrada" value="" size="10" />';
echo '<input type="submit" name="agregar" value="Agregar" /><br>';
echo '<input type="submit" name="actualizar" value="Actualizar" /><br>';

if(!empty($_GET['actualizar'])){


require_once('../incl/connect.php');
	
$orden_compra=$_GET['orden_compra_folio']; 	
$moneda=$_GET['moneda_proveedor_folio']; 	
$numero_partidas=$_GET['numero_partidas_folio']; 
echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">"; 
	
	}

if(!empty($_GET['agregar'])){
	

require_once('../incl/connect.php');
	
$sql_actualizar_folio=$_GET['sql_actualizar_folio']; 		
$orden_compra=$_GET['orden_compra_folio']; 	
$moneda=$_GET['moneda_proveedor_folio']; 	
$numero_partidas=$_GET['numero_partidas_folio']; 

	if(!empty($_GET['pedimento'])){
	$pedimento=$_GET['pedimento'];
	
	}
	else{
		$pedimento="";
		}
	
if(!empty($_GET['folio']))  {
		$folio=$_GET['folio'];
		}
		else{
			$folio="";
			}
		
		
if(!empty($_GET['factura']))  {
		$factura=$_GET['factura'];
		}
		else{
			$factura="";
			}
			
			if(!empty($_GET['agregar_entrada']))  {
		$agregar_entrada=$_GET['agregar_entrada'];
		}
		else{
			$agregar_entrada="";
			}

		
	if(!empty($folio) or !empty($factura) or !empty($pedimento) or !empty($agregar_entrada)){

		 agregar_folio_pedimento_factura($pedimento, $folio, $factura, $orden_compra, $moneda, $numero_partidas, $sql_actualizar_folio, $agregar_entrada); 
		}
	else{
		 echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">"; 
		
		}
	
	}



		








function &obtener_fecha($orden_compra){


require_once('../incl/connect.php');

//query para obtener fecha
$sql_buscar_fecha="SELECT fecha from ordendecompras
 WHERE noDePedido='$orden_compra'";
$result_fecha = mysql_query($sql_buscar_fecha);
while($row_fecha = mysql_fetch_array($result_fecha)){
	$fecha=$row_fecha["fecha"]; // almacena la fecha en la variable $fecha
	echo "FECHA DE LA ORDEN DE COMPRA : ", $fecha;
	}
	
	return $fecha;
	}


function &obtener_tipo_cambio($fecha){


require_once('../incl/connect.php');

//query para obtener el tipo de cambio
$sql_buscar_tipo_cambio="SELECT * from cambio_oficial
 WHERE fecha='$fecha'";
$result_tipo_cambio = mysql_query($sql_buscar_tipo_cambio);


// si no existe el tipo de cambio en la fecha que se genero la orden de compra
//buscar el tipo de cambio de un dia anterior
 if(mysql_num_rows($result_tipo_cambio)<1){ // si el numero de registros es 0
 $i=-1;
	 while(mysql_num_rows($result_tipo_cambio)<1){
		 $dias_atras=$i.'day';  // Variable para restar un dia a la fecha
		
$fecha_dia_anterior=  strtotime ( $dias_atras , strtotime ( $fecha ) ) ;
$fecha_dia_anterior=date ( 'Y-m-j' , $fecha_dia_anterior);
echo "<p>FECHA DEL TIPO DE CAMBIO ".$fecha_dia_anterior."</p>";
echo $dias_atras;
$sql_buscar_tipo_cambio="SELECT * from cambio_oficial
 WHERE fecha='$fecha_dia_anterior'";
$result_tipo_cambio = mysql_query($sql_buscar_tipo_cambio);
$row_cambio = mysql_fetch_array($result_tipo_cambio);
$tipo_cambio=$row_cambio["tipo_cambio"]; // almacena el tipo de cambio con la fecha de un dia anterior
		echo "<br>TIPO DE CAMBIO: $", $tipo_cambio;
		$i--;
	 }
	 }




else{
while($row_cambio = mysql_fetch_array($result_tipo_cambio)){
	$tipo_cambio=$row_cambio["tipo_cambio"];
// almacena el tipo de cambio correspondiente a la fecha 
	echo "<br>TIPO DE CAMBIO: $", $tipo_cambio;
	}
}
	return $tipo_cambio;
	}





function obteniendo_cotizaciones($orden_compra, $tipo_cambio, $moneda, $fecha, $numero_partidas){


require_once('../incl/connect.php');

// query para obtener los datos del pedido
 $sql_buscar_corizacion="SELECT * from cotizacionherramientas
 WHERE noDePedido='$orden_compra' ORDER BY modelo ";

$result_cotizacion = mysql_query($sql_buscar_corizacion);


	/////////////////si las partidas cambiaron de oc

	$num_rows = mysql_num_rows($result_cotizacion);

	if($num_rows == 0){
		$sql_eliminar_partida=" DELETE FROM `utilidad_pedido` WHERE orden_compra='".$orden_compra."'";
		$resultado = mysql_query($sql_eliminar_partida);
		
		}
	///////////si la partida cambia de oc
	

while ($row_cotizacion = mysql_fetch_array($result_cotizacion)){


//buscando el nombre del cliente
$pedido=$row_cotizacion["Pedido"];
$id_cotizacion_herramientas=$row_cotizacion["id"];
$numero_cliente=$row_cotizacion["cliente"];

if($pedido != 'si'){ // si el pedido se cancela , el cliente es almacen
	
	$numero_cliente=611;
	
	}
$sql_buscar_cliente="SELECT nombreEmpresa from contactos WHERE id=".$row_cotizacion["cliente"] ."";
$result_nombre_cliente = mysql_query($sql_buscar_cliente);
$rowcliente = mysql_fetch_array($result_nombre_cliente);
$cliente=$rowcliente["nombreEmpresa"];
/// buscando el numero del proveedor
$sql_buscar_proveedor="SELECT proveedor from ordendecompras WHERE noDePedido='".$orden_compra ."'";
$result_numero_proveedor = mysql_query($sql_buscar_proveedor);
$rowproveedor = mysql_fetch_array($result_numero_proveedor);
$numero_proveedor=$rowproveedor["proveedor"];

$sql_nombre_proveedor="SELECT nombreEmpresa from contactos WHERE id=".$numero_proveedor."";
$result_nombre_proveedor = mysql_query($sql_nombre_proveedor);
$rowproveedor= mysql_fetch_array($result_nombre_proveedor);
$nombre_proveedor=$rowproveedor["nombreEmpresa"];

$marca=$row_cotizacion["marca"]; // se almacena la marca
$modelo=$row_cotizacion["modelo"]; // se almacena el modelo
$cantidad=$row_cotizacion["cantidad"]; // se almacena cantidad
$descripcion=$row_cotizacion["descripcion"]; 
$id_factura=$row_cotizacion["factura"]; 
// se obtiene el precio de compra mediante la funcion obtener_precio_compra
$precio_compra=&obtener_precio_compra($numero_proveedor,$marca,$modelo, $orden_compra);

if(oc_registrada($orden_compra)){ // si esta orden de compra se encuentra registrada en precios oc<br>
// toma el precio registrado por el comprador
$precio_compra=&precio_modelo_oc($orden_compra, $marca, $modelo);
	//precio modelo oc obtiene el precio del modelo 
	}


// se obtiene el precio de venta de la columna precio de lista tabla cotizacionherramientas
$precio_venta=$row_cotizacion["precioLista"];
// se obtiene la moneda con la que se vendio el producto
$moneda_producto=$row_cotizacion["moneda"];

// se obtiene la cotizacion de donde proviene la orden de compra
$id_cotizacion=$row_cotizacion["cotizacionNo"];

// si la moneda del proveedor es uds, obtener el costo moneda nacional 
if($moneda=="usd"){
	  
	$costo_mn=$precio_compra*$tipo_cambio;
	}
	else{ // si es mxn el costo moneda nacional se queda igual 
	$costo_mn=$precio_compra;
	}
	 // costo moneda nacional formato 2 decimales
	$costo_mn=number_format($costo_mn,2,".",""); 
	
// calcular  el costo en dolares
if($moneda=="usd"){  // si la moneda del proveedor es uds se queda igual
	$costo_usd=$precio_compra;
	
	}
	else{ // si es mxn lo divide entre el tipo de cambio
$costo_usd=$precio_compra/$tipo_cambio;
	}
	// formato 2 decimales
	$costo_usd=number_format($costo_usd,2,".",""); 

// si la cotizacion se  hizo en pesos
if($moneda_producto=="mxn"){
	
$venta_mn=$precio_venta; // la venta en moneda nacional se queda igual
	}
	else{
		$venta_mn=$precio_venta*$tipo_cambio;
	// si se hizo en dolares la venta en moneda nacional se multiplica por el tipo de cambio
		}
		// formato 2 decimales para moneda nacional
$venta_mn=number_format($venta_mn,2,".","");
if($moneda_producto=="usd"){
	// si la cotizacion se hizo en usd la venta usd permanece igual
$venta_usd=$precio_venta;
	}
	else{ // si se hizo en moneda nacional se divide entre el tipo de cambio
		$venta_usd=$precio_venta/$tipo_cambio;
	
		}
		
$venta_usd=number_format($venta_usd,2,".","");
	
	
// se obtiene la utilidad en la funcion obtener_utilidad
$utilidad=&obtener_utilidad($cliente, $costo_mn, $venta_mn);


$factura=&obtener_factura($id_factura, $id_cotizacion);

//	Query para comprobar que el pedido este en la tabla utilidad_pedido donde se almacena el desgloce de los pedidos de la orden de compra 	
$sql_utilidad_pedido="SELECT id from utilidad_pedido WHERE orden_compra='".$orden_compra."'";


$result_utilidad_pedido = mysql_query($sql_utilidad_pedido);
$partidas_registradas = mysql_num_rows($result_utilidad_pedido);

$sql_actualizar_partidas="UPDATE `utilidad_pedido` SET cantidad = '".$cantidad."'
   WHERE id_cotizacion_herramientas = '".$id_cotizacion_herramientas."'";
   

	   if(!$resultado = mysql_query($sql_actualizar_partidas)) {
		 	echo"<script>alert('Error al  cargar pedido')</script>";	
	  
	   }	

if($partidas_registradas < $numero_partidas ){
		
$sql_buscar_partidas="SELECT id_cotizacion_herramientas, orden_compra FROM  `utilidad_pedido` WHERE id_cotizacion_herramientas='".$id_cotizacion_herramientas."' ORDER BY modelo ";

	$resultado_buscar=mysql_query($sql_buscar_partidas);
	
	$row_buscar_partidas = mysql_fetch_array($resultado_buscar);
	$res_oc=$row_buscar_partidas["orden_compra"];
	if(mysql_num_rows($resultado_buscar)== 0){
		
	agregar_utilidad_pedido($orden_compra, $fecha, $numero_proveedor,$moneda, $numero_cliente,$marca,$modelo,$cantidad,$tipo_cambio,$costo_mn,$costo_usd,$venta_mn,$venta_usd, $descripcion, $id_cotizacion_herramientas,$moneda_producto); 

	
	}
	else{
		if($res_oc != $orden_compra){
			$sql_eliminar_partida=" DELETE FROM `utilidad_pedido` WHERE id_cotizacion_herramientas =".$id_cotizacion_herramientas." ";
			
$resultado = mysql_query($sql_eliminar_partida);
echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">";
			
			}
		
		}
	

}
if($partidas_registradas > $numero_partidas ){ // si hay una partida en utilidad_pedido pero en la oc  no


	
	$sql_buscar_partidas="SELECT id_cotizacion_herramientas FROM `utilidad_pedido` WHERE orden_compra='".$orden_compra."' ";
	
	$resultado_buscar=mysql_query($sql_buscar_partidas);
	
while($row = mysql_fetch_array($resultado_buscar)){
	$id=$row["id_cotizacion_herramientas"];
	
	$sql="SELECT noDePedido FROM `cotizacionherramientas` WHERE id='".$id."' ";
	$result=mysql_query($sql);
while($row_buscar= mysql_fetch_array($result)){
	if($row_buscar["noDePedido"] != $orden_compra){
		
$sql_eliminar_partida=" DELETE FROM `utilidad_pedido` WHERE id_cotizacion_herramientas =".$id." ";
$resultado = mysql_query($sql_eliminar_partida);
echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">";

		
		}
	
} // fin while
	

}
	
	} // fin del if las partidas en utilidad pedido son mas que en cotizacion herramientas

}// Fin del while
	
	} // Fin de la funcion



// funcion para obtener el precio de compra al proveedor
function &obtener_precio_compra($numero_proveedor,$marca,$modelo, $orden_compra){
	
$sql="SELECT fecha from ordendecompras WHERE noDePedido='".$orden_compra."'";

$result = mysql_query($sql);
while($row= mysql_fetch_array($result)){
$fecha_oc=$row["fecha"];
	
}




$sql_buscar_tabla="SELECT tabla from factores_proveedores WHERE proveedor=".$numero_proveedor."";
//  las tablas donde se encuentran los articulos se llaman precio.marca
$tabla="precio".$marca;

$result_tabla = mysql_query($sql_buscar_tabla);
while($row_tabla = mysql_fetch_array($result_tabla)){
// si en factores proveedores el proveedor ocupa una tabla especial la tabla en la que va a buscar los modelos es solamente esa 
	
	if($row_tabla["tabla"]!= "todas" && !empty($row_tabla["tabla"])){
	$tabla=$row_tabla["tabla"];
	
	}
}




$moneda="";
$sql_moneda="SELECT moneda from factores_proveedores WHERE proveedor=".$numero_proveedor."";

$result_moneda = mysql_query($sql_moneda);
while ($row_moneda= mysql_fetch_array($result_moneda)){
	if(!empty($row_moneda["moneda"])){
	$moneda=$row_moneda["moneda"];
	}
	else{
		$moneda="mxn";
		}
}

if($fecha_oc < '2016-02-01' and $numero_proveedor == 7){
	$tabla="preciosnapon2015";

	}
	
	
$sql_precio_Base="SELECT precioBase from $tabla WHERE ref='$modelo' ";

$result_precio_Base = mysql_query($sql_precio_Base);
$row_precio_base = mysql_fetch_array($result_precio_Base);

$precio_modelo= $row_precio_base['precioBase']; //obtiene el precio del modelo de la marca
 
 
 
 // query para obtener los factores de adquisicion del proveedor
 
$sql_factor="SELECT factor_proveedor from factores_proveedores WHERE proveedor='$numero_proveedor' ";

$result_factor = mysql_query($sql_factor);

// el factor proveedor comienza en cero
$row_factor_proveedor=0.0;
$index=0;

while($row_factores= mysql_fetch_array($result_factor)){
      
   $rawdata[$index] = $row_factores["factor_proveedor"];
   $factor= $rawdata[$index];
if(empty($row_factores["factor_proveedor"])){
	 echo"<script>alert('No se encontro factor de adquisicion ')</script>";
	 
	}
	// si el factor vale cero solo se suma el primer factor encontrado
	if($row_factor_proveedor==0){
		$row_factor_proveedor+=$factor;
		}
		else{ // si ya tiene almacenado un factor los demas factores se multiplican
   $row_factor_proveedor= $row_factor_proveedor*$factor;
		}
   $index++;
 
   }


// el factor_proveedor es = a la multiplicacion de los factores de adquisicion
$factor_proveedor= $row_factor_proveedor; 


if($fecha_oc < '2016-02-01' and $numero_proveedor == 7){ // snapon antes  de el primero febrero tenia el 40
	$factor_proveedor =0.60;

	}
// el precio proveedor es la multiplicacion del modelo por el factor
$precio_proveedor=$precio_modelo*$factor_proveedor;
$precio_proveedor=round($precio_proveedor,2);
//Formato dos decimales

$precio_proveedor=number_format($precio_proveedor,2,".","");

return $precio_proveedor;
	
	
	}
	
	function &obtener_utilidad($cliente, $costo_mn, $venta_mn ){
		if($cliente=="ALMACEN"){
			$utilidad=0; // si cliente es almacen no existe utilidad
			}
			else{
				if($costo_mn==0 or $venta_mn==0){
					$utilidad=0;
					
					}
					else{
						//utilidad venta/costo-1*100 para obtener el %
				$utilidad=(1-($costo_mn/$venta_mn))*100;
				// formato con dos decimales
				$utilidad=number_format($utilidad,2,".",""); 
				
				
						}
				

				}
		return $utilidad;
		}
		
function &obtener_factura($id_factura, $id_cotizacion){


require_once('../incl/connect.php');
		
	
$sql_factura="SELECT factura from cotizacion WHERE id=".$id_factura."";

$result_factura = mysql_query($sql_factura);

 if(mysql_num_rows($result_factura)==0){
	 $sql_factura="SELECT factura from cotizacion WHERE id=".$id_cotizacion."";
	 }
	 $result_factura = mysql_query($sql_factura);
while ($row_factura= mysql_fetch_array($result_factura)){
	if($row_factura["factura"]==0){

$factura=0;
	
	
	}
	else{
		$factura=$row_factura["factura"];
		}
}


			
			return $factura;
			
			}
function agregar_utilidad_pedido($orden_compra, $fecha, $numero_proveedor,$moneda, $numero_cliente,$marca,$modelo,$cantidad,$tipo_cambio,$costo_mn,$costo_usd,$venta_mn,$venta_usd, $descripcion,$id_cotizacion_herramientas,$moneda_producto){



require_once('../incl/connect.php');
		
//Funcion para aceptar las apostrofes en mysql
$descripcion=addslashes($descripcion);			
//Funcion para aceptar las apostrofes en mysql
$marca=addslashes($marca);					
$query_agregar_pedido= 
"INSERT INTO utilidad_pedido 
(id, id_cotizacion_herramientas,
 orden_compra,
 fecha_orden_compra,
 proveedor,
 moneda_pedido,
 cliente, marca,modelo, cantidad,descripcion, tipo_cambio,
 costo_mn, costo_usd, venta_mn, venta_usd)
values 
('','$id_cotizacion_herramientas',
 '$orden_compra','$fecha', '$numero_proveedor', '$moneda_producto', '$numero_cliente',  '$marca',  '$modelo', '$cantidad','$descripcion',  '$tipo_cambio',  '$costo_mn',  '$costo_usd','$venta_mn','$venta_usd')";

	
	
		if(!$resultado = mysql_query( $query_agregar_pedido)) {
	echo"<script>alert('Error al  agregar la orden de compra ')</script>";	
	 //die();
	}
	
		}
		
		
		
function mostrar_utilidad_pedido($orden_compra, $moneda, $sql_filtrar, $numero_partidas, $sql_actualizar){


require_once('../incl/connect.php');
		
global $usuario;
echo '<input type="hidden" name="orden_compra_filtro" value="'.$orden_compra.'">';
echo '<input type="hidden" name="moneda_proveedor_filtro" value="'.$moneda.'">';
echo '<input type="hidden" name="numero_partidas_filtro" value="'.$numero_partidas.'">';
echo '<input type="hidden" name="orden_compra_folio" value="'.$orden_compra.'">';
echo '<input type="hidden" name="moneda_proveedor_folio" value="'.$moneda.'">';
echo '<input type="hidden" name="numero_partidas_folio" value="'.$numero_partidas.'">';
echo '<input type="hidden" name="sql_actualizar_folio" value="'.$sql_actualizar.'">';
$suma_costo_mn=0.00;
$suma_venta_mn=0.00;

// tabla para almacenar los resultados
echo '<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">';
echo '<tr> ';
echo'<td><b> <big>#</big> </b>  </td>';
//echo'<td><b> <big> Enviado </big> </b> </td>';

echo '<th><b> <big> <select name="enviado[]" id="enviado"  multiple>   ';
echo ' <option value="enviado" >Enviado</option>';

$consulta_mysql="SELECT fecha_enviado FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";

$resultado_consulta_mysql=mysql_query($consulta_mysql);


$count=0;
while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_fecha_enviado[$count]=$fila['fecha_enviado'];
$count++;	
}

$filtro_fecha_enviado= array_values(array_unique($filtro_fecha_enviado));
foreach($filtro_fecha_enviado as $element ){
echo "<option value='".$element."'>".$element."</option>";
}

echo '</select></big> </b> </th> ';





//echo'<td><b> <big> Recibido </big> </b> </td>';
echo '<th><b> <big> <select name="recibido[]" id="recibido"  multiple>   ';
echo ' <option value="recibido" >Recibido </option>';

$consulta_mysql="SELECT fecha_llegada FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";

$resultado_consulta_mysql=mysql_query($consulta_mysql);


$count=0;
while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_fecha_llegada[$count]=$fila['fecha_llegada'];
$count++;	
}

$filtro_fecha_llegada= array_values(array_unique($filtro_fecha_llegada));
foreach($filtro_fecha_llegada as $element ){
echo "<option value='".$element."'>".$element."</option>";
}

echo '</select></big> </b> </th> ';



//echo'<td><b> <big> Marca </big> </b></td>';
echo '<th><b> <big> <select name="marca[]" id="marca"  multiple>   ';
echo ' <option value="marca" > Marca </option>';

$consulta_mysql="SELECT marca FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";

$resultado_consulta_mysql=mysql_query($consulta_mysql);


$count=0;
while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_marca[$count]=$fila['marca'];
$count++;	
}

$filtro_marca= array_values(array_unique($filtro_marca));
foreach($filtro_marca as $element ){
echo "<option value='".$element."'>".$element."</option>";
}

echo '</select></big> </b> </th> ';


//echo'<td><b> <big> Modelo </big> </b> </td>';
echo '<th><b> <big> <select name="modelo[]" id="modelo"  multiple>   ';
echo ' <option value="modelo" > Modelo </option>';
$consulta_mysql="SELECT modelo FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  
$count=0;
while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_modelo[$count]=$fila['modelo'];
$count++;	
}

$filtro_modelo= array_values(array_unique($filtro_modelo));
foreach($filtro_modelo as $element ){
echo "<option value='".$element."'>".$element."</option>";
}



echo '</select></big> </b> </th> ';






echo'<td><b> <big> Cant </big> </b> </td>';
echo'<td><b> <big> Descripci&oacute;n </big> </b> </td>';
//echo'<td><b> <big> Proveedor </big> </b> </td>';
echo '<th bgcolor="#AED5FF"><b> <big> <select name="proveedor[]" id="proveedor" multiple>   ';
echo ' <option value="proveedor" > Proveedor</option>';
$consulta_mysql="SELECT proveedor FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;
while($row_numero_proveedor = mysql_fetch_array($resultado_consulta_mysql)){
$numero_proveedor=$row_numero_proveedor["proveedor"];

$sql_nombre_proveedor="SELECT nombreEmpresa from contactos WHERE id=".$numero_proveedor."";
$result_nombre_proveedor = mysql_query($sql_nombre_proveedor);


while($fila=mysql_fetch_array($result_nombre_proveedor)){

	$filtro_nombre_empresa[$count]=$fila['nombreEmpresa'];
$count++;	
}


	}
$filtro_nombre_empresa= array_values(array_unique($filtro_nombre_empresa));
foreach($filtro_nombre_empresa as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';


//echo'<td><b> <big> Entrada </big> </b> </td>';

echo '<th><b> <big> <select name="entrada[]" id="entrada" multiple>   ';
echo ' <option value="entrada" > Entrada </option>';
$consulta_mysql="SELECT entrada FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

$filtro_entrada[$count]=$fila['entrada'];
$count++;	
}



$filtro_entrada= array_values(array_unique($filtro_entrada));
foreach($filtro_entrada as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
echo '</select></big> </b> </th> ';


//echo'<td><b> <big> Cliente </big> </b> </td>';
echo '<th bgcolor="#AED5FF"><b> <big> <select name="cliente[]" id="cliente" multiple>   ';
echo ' <option value="cliente" > Cliente </option>';
$consulta_mysql="SELECT cliente FROM utilidad_pedido  WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;
while($row_numero_cliente = mysql_fetch_array($resultado_consulta_mysql)){
$numero_cliente=$row_numero_cliente["cliente"];
$sql_nombre_cliente="SELECT nombreEmpresa from contactos WHERE id=".$numero_cliente."";
$result_nombre_cliente = mysql_query($sql_nombre_cliente);


while($fila=mysql_fetch_array($result_nombre_cliente)){

	$filtro_nombre_cliente[$count]=$fila['nombreEmpresa'];
$count++;	
}


	}
$filtro_nombre_cliente= array_values(array_unique($filtro_nombre_cliente));
foreach($filtro_nombre_cliente as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
echo '</select></big> </b> </th> ';

//echo'<td><b> <big> Pedido </big> </b> </td>';
echo '<th bgcolor="#9EDFF7"><b> <big> <select name="pedido[]" id="pedido" multiple>   ';
echo ' <option value="pedido" > Pedido </option>';
$consulta_mysql="SELECT orden_compra FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_orden_compra[$count]=$fila['orden_compra'];
$count++;	
}



$filtro_orden_compra= array_values(array_unique($filtro_orden_compra));
foreach($filtro_orden_compra as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';









echo'<td><b> <big> Fecha </big> </b> </td>';
echo'<td><b> <big> Cambio </big> </b> </td>';
echo'<td><b> <big> Costo M.N</big> </b> </td>';
echo'<td><b> <big> Costo USD.</big> </b> </td>';
echo'<td><b> <big> Costo total Fact(mxn)</big> </b> </td>';
echo'<td><b> <big> Costo total Fact(usd)</big> </b> </td>';

//echo'<td bgcolor="#BBF8E4"><b> <big> FacturaP </big> </b> </td>';

echo '<th bgcolor="#BBF8E4"><b> <big> <select name="factura_proveedor[]" id="factura_proveedor" multiple>   ';
echo ' <option value="factura_proveedor" > FacturaP </option>';
$consulta_mysql="SELECT factura_proveedor FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_factura_proveedor[$count]=$fila['factura_proveedor'];
$count++;	
}



$filtro_factura_proveedor= array_values(array_unique($filtro_factura_proveedor));
foreach($filtro_factura_proveedor as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';



//echo'<td bgcolor="#95E3E1"><b> <big> FacturaH</big> </b> </td>';


echo '<th bgcolor="#95E3E1"> <select name="factura_hemusa[]" id="factura_hemusa" multiple>   ';
echo ' <option value="facturaH"> FacturaH </option>';
$consulta_mysql="SELECT factura_hemusa FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_factura_hemusa[$count]=$fila['factura_hemusa'];
$count++;	
}



$filtro_factura_hemusa= array_values(array_unique($filtro_factura_hemusa));
foreach($filtro_factura_hemusa as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select> </th> ';


//echo'<td bgcolor="#4FAEBD" ><b> <big> Remision</big> </b> </td>';

echo '<th  bgcolor="#4FAEBD"><b> <big> <select name="remision[]" id="remision" multiple>   ';
echo ' <option value="remision" > Remision </option>';
$consulta_mysql="SELECT remision FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_remision[$count]=$fila['remision'];
$count++;	
}



$filtro_remision= array_values(array_unique($filtro_remision));
foreach($filtro_remision as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';

echo'<td><b> <big> Cant.Fac</big> </b> </td>';
echo'<td><b> <big> Venta M.N </big> </b> </td>';
echo'<td><b> <big> Venta USD. </big> </b> </td>';
echo'<td bgcolor="#FFBDBF"><b> <big> Total mxn venta</big> </b> </td>';
echo'<td bgcolor="#FF8A8C"><b> <big> Total usd venta</big> </b> </td>';
echo'<td><b> <big> Moneda </big> </b> </td>';
//echo'<td><b> <big> Utilidad </big> </b> </td>';
if($usuario=="Paulina Ramirez"){
echo '<th><b> <big> <select name="utilidad[]" id="utilidad" multiple>   ';
echo ' <option value="utilidad" > Utilidad </option>';
$consulta_mysql="SELECT utilidad FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_utilidad[$count]=$fila['utilidad'];
$count++;	
}



$filtro_utilidad= array_values(array_unique($filtro_utilidad));
foreach($filtro_utilidad as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';
}

//echo'<td bgcolor="#849B91"><b> <big> Folio </big> </b> </td>';
echo '<th bgcolor="#849B91" ><b> <big> <select name="folio_filtro[]" id="folio_filtro" multiple>   ';
echo ' <option value="folio" >Folio </option>';
$consulta_mysql="SELECT folio FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_folio[$count]=$fila['folio'];
$count++;	
}



$filtro_folio= array_values(array_unique($filtro_folio));
foreach($filtro_folio as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';




//echo'<td bgcolor="#BED8CA"><b> <big> Pedimento </big> </b> </td>';
echo '<th bgcolor="#BED8CA"><b> <big> <select name="pedimento_filtro[]" id="pedimento_filtro" multiple>   ';
echo ' <option value="pedimento" >Pedimento</option>';
$consulta_mysql="SELECT Pedimento FROM utilidad_pedido WHERE orden_compra='".$orden_compra."'";
$resultado_consulta_mysql=mysql_query($consulta_mysql);
  $count=0;

while($fila=mysql_fetch_array($resultado_consulta_mysql)){

	$filtro_pedimento[$count]=$fila['Pedimento'];
$count++;	
}



$filtro_pedimento= array_values(array_unique($filtro_pedimento));
foreach($filtro_pedimento as $element ){
echo "<option value='".$element."'>".$element."</option>";
}
  

echo '</select></big> </b> </th> ';

echo '</tr>';

if(!empty($sql_filtrar)){
	$sql_buscar_oc=$sql_filtrar;
	//echo $sql_buscar_oc;
	}
	else{
$sql_buscar_oc="SELECT * from utilidad_pedido
 WHERE orden_compra='$orden_compra'";
	}
$result_oc= mysql_query($sql_buscar_oc);

$i=1;
while($row_oc = mysql_fetch_array($result_oc)){

 $sql_buscar_cotizacion="SELECT * from cotizacionherramientas
 WHERE id='".$row_oc["id_cotizacion_herramientas"]."'";
 


$id_cotizacion_herramientas=$row_oc["id_cotizacion_herramientas"];

$result_cotizacion = mysql_query($sql_buscar_cotizacion);
if(mysql_num_rows($result_cotizacion)== 0){
$sql_eliminar_partida=" DELETE FROM `utilidad_pedido` WHERE id_cotizacion_herramientas =$id_cotizacion_herramientas ";


$resultado = mysql_query($sql_eliminar_partida);

 echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">";

}

while ($row_cotizacion = mysql_fetch_array($result_cotizacion)){
$id_cotizacion=$row_cotizacion["cotizacionNo"]; 	
$enviado=$row_cotizacion["enviadoFecha"]; 
$recibido=$row_cotizacion["recibidoFecha"]; 
$fecha_entregado=$row_cotizacion["Entregado"]; 
$id_factura=$row_cotizacion["factura"]; 
$remision=$row_cotizacion["remision"]; 
$fecha_entregado=$row_cotizacion["Entregado"];
 
}

$sql_fecha_llegada="UPDATE `utilidad_pedido` SET `fecha_llegada` = '".$recibido."' WHERE id_cotizacion_herramientas='$id_cotizacion_herramientas'";
   
 if(!$resultado = mysql_query($sql_fecha_llegada)) {
	echo"<script>alert('Error al agregar fecha recibido')</script>";		
	}
$sql_fecha_enviado="UPDATE `utilidad_pedido` SET `fecha_enviado` = '".$enviado."' WHERE id_cotizacion_herramientas='$id_cotizacion_herramientas'";
   
		 if(!$resultado = mysql_query($sql_fecha_enviado)) {
	echo"<script>alert('Error al agregar fecha enviado')</script>";		
	}
	
 
	$sql_fecha_entregado="UPDATE `utilidad_pedido` SET `fecha_entregado` = '".$fecha_entregado."' WHERE id_cotizacion_herramientas='$id_cotizacion_herramientas'";
   
		 if(!$resultado = mysql_query($sql_fecha_entregado)) {
	echo"<script>alert('Error al actualizar fecha entregado')</script>";		
	}
	

//if($row_oc["orden_compra"] == $orden_compra){
echo '<tr>';

echo "<td valign='top'>$i </td>";

echo '<td valign="top">'.$enviado.'</td>';

	
	

echo '<td valign="top">'.$recibido.'</td>';

	
$marca=$row_oc["marca"];
//funcion para mostrar apostrofes 
$marca = stripslashes($marca);


echo '<td valign="top">'.$marca.'</td>';
$modelo=$row_oc["modelo"];
//funcion para mostrar apostrofes 
$modelo = stripslashes($modelo);
echo '<td valign="top"><a href="duplicar_articulo.php?id_cotizacion_herramientas='.$row_oc["id_cotizacion_herramientas"].'">'.$modelo.'</a></td>';
$cantidad=$row_oc["cantidad"];
echo '<td valign="top"><center>'.$cantidad.'</center></td>';
$descripcion=$row_oc["descripcion"];
//funcion para mostrar apostrofes 
$descripcion = stripslashes($descripcion);
echo '<td valign="top"><center>'.$descripcion.'</center></td>';
//Buscando el nombre del proveedor
$numero_proveedor=$row_oc["proveedor"];
$sql_nombre_proveedor="SELECT nombreEmpresa from contactos WHERE id=".$numero_proveedor."";
$result_nombre_proveedor = mysql_query($sql_nombre_proveedor);
$rowproveedor= mysql_fetch_array($result_nombre_proveedor);
$nombre_proveedor=$rowproveedor["nombreEmpresa"];
// se imprime el proveedor
echo '<td bgcolor="#AED5FF" valign="top">'.$nombre_proveedor.'</td>';

$entrada=$row_oc["entrada"];
echo '<td valign="top">'.$entrada.'</td>';

//buscando el nombre del cliente
$numero_cliente=$row_oc["cliente"];
$sql_buscar_cliente="SELECT nombreEmpresa from contactos WHERE id=".$numero_cliente."";
$result_nombre_cliente = mysql_query($sql_buscar_cliente);
$rowcliente = mysql_fetch_array($result_nombre_cliente);
$cliente=$rowcliente["nombreEmpresa"];
// se imprime el cliente

	if($fecha_entregado!='0000-00-00'){
		
		if($fecha_entregado < $recibido  or $recibido=='0000-00-00'){
	$cliente="ALMACEN";
	$numero_cliente=611;
	$sql_almacen="UPDATE `utilidad_pedido` SET `cliente` = '".$numero_cliente."' WHERE id_cotizacion_herramientas='$id_cotizacion_herramientas'";
   
	
		 if(!$resultado = mysql_query($sql_almacen)) {
	echo"<script>alert('Error al cambiar cliente')</script>";		
	
		 }
	
	}
		
		
		}
echo '<td bgcolor="#AED5FF" valign="top"><a href="editar_cliente.php?id_utilidad_pedido='.$row_oc["id"].'">'.$cliente.'</a></td>';


$orden_compra=$row_oc["orden_compra"]; 
echo '<td bgcolor="#9EDFF7" valign="top">'.$orden_compra.'</td>';
$fecha=$row_oc["fecha_orden_compra"];
echo '<td valign="top">'.$fecha.'</td>';	



$tipo_cambio=$row_oc["tipo_cambio"];
echo '<td valign="top"><center>'.$tipo_cambio.'</center></td>';
$costo_mn=$row_oc["costo_mn"];
// imprime costo en moneda nacional
echo '<td valign="top">$ '.$costo_mn.'</td>';
$suma_costo_mn=$suma_costo_mn+($costo_mn*$cantidad);

$costo_usd=$row_oc["costo_usd"];
// imprime el costo en moneda usd 
echo '<td valign="top">$ '.$costo_usd.'</td>';
$costo_total_mn=$costo_mn*$cantidad;
echo '<td valign="top"> $'.$costo_total_mn.'</td>';
$costo_total_usd=$costo_usd*$cantidad;
echo '<td valign="top"> $'.$costo_total_usd.'</td>';

$venta_mn=$row_oc["venta_mn"];
$suma_venta_mn=$suma_venta_mn+($venta_mn*$cantidad);
$venta_usd=$row_oc["venta_usd"];
$moneda_producto=$row_oc["moneda_pedido"];
$total_mn=0;
$total_usd=0;

$factura_proveedor=$row_oc["factura_proveedor"];
echo '<td bgcolor="#BBF8E4" valign="top"> '.$factura_proveedor.'</td>';

$factura=&obtener_factura($id_factura, $id_cotizacion);
if($cliente == 'ALMACEN'){
	$factura=0;
	$remision=0;
	}

echo '<td bgcolor="#95E3E1" valign="top"> '.$factura.'  </td>';


 $actualizar_factura="UPDATE `utilidad_pedido` SET `factura_hemusa` = '".$factura."' WHERE id_cotizacion_herramientas='".$id_cotizacion_herramientas."'";
   
		 if(!$res_act_fac = mysql_query($actualizar_factura)) {
	echo"<script>alert('Error al actualizar fac hemusa')</script>";		
	}


 $actualizar_remision="UPDATE `utilidad_pedido` SET `remision` = '".$remision."' WHERE id_cotizacion_herramientas='".$id_cotizacion_herramientas."'";
   
		 if(!$res_act_rem= mysql_query($actualizar_remision)) {
	echo"<script>alert('Error al actualizar remision')</script>";		
	}



echo '<td bgcolor="#4FAEBD" valign="top"> '.$remision.'  </td>';


if($factura !=0 || $remision!=0){
		if($moneda_producto=='mxn'){
			
				$total_mn=$venta_mn*$cantidad;
				$total_usd=($total_mn/$tipo_cambio);
			}
			else{
				
				$total_usd=$venta_usd*$cantidad;
				$total_mn=($total_usd*$tipo_cambio);
				}

echo '<td valign="top"> '.$cantidad.'   </td>';

	}
	else{

		$cantidad_f=0;
		echo '<td valign="top"> '.$cantidad_f.'   </td>';
		}
		
echo '<td valign="top">$ '.$venta_mn.'</td>';
echo '<td valign="top">$ '.$venta_usd.'</td>';		
		
$total_mn=number_format($total_mn,4,".",""); 
	$total_usd=number_format($total_usd,4,".",""); 	
	echo '<td bgcolor="#FFBDBF" valign="top"> $'.$total_mn.'</td>';
	echo '<td bgcolor="#FF8A8C" valign="top"> $'.$total_usd.'</td>';

echo '<td valign="top">'.$moneda_producto.'</td>';





	$utilidad= &obtener_utilidad($cliente, $costo_mn, $venta_mn );
if($usuario=="Paulina Ramirez"){
if($utilidad < 10){
	echo '<td valign="top"> <font color="red"> '.$utilidad.' % </font></td>';
	}
	else{
		
	echo '<td valign="top"> <font color="black"> '.$utilidad.' % </font></td>';	
		}
	
}
  $sql_utilidad="UPDATE `utilidad_pedido` SET `utilidad` = '".$utilidad."' WHERE id_cotizacion_herramientas='$id_cotizacion_herramientas'";
   
		 if(!$resultado = mysql_query($sql_utilidad)) {
	echo"<script>alert('Error al agregar utilidad')</script>";		
	}

$folio=$row_oc["folio"];
echo '<td bgcolor="#849B91" valign="top">'.$folio.'</td>';		
$pedimento=$row_oc["Pedimento"];
echo '<td bgcolor="#BED8CA" valign="top">'.$pedimento.'</td>';		
		
		
$i++;
echo '</tr>';	
	
}
	
	
//}

echo '</table>';	
echo '<table WIDTH="30%" border="1" cellpadding="3" cellspacing="1" summary="" frame="border">';
echo '<tr>';
echo '<td valign="top"><b>COSTO OC </b></td>'; // nueva fila para el costo
echo '<td valign="top"><b>FLETE OC </b></td>'; // fila para sumar el flete
echo '<td valign="top"><b>VENTA OC </b></td>'; // nueva fila para el venta
echo '<td valign="top"><b>UTILIDAD OC </b></td>'; // nueva fila para utilidad
echo '<tr>';

$sql_buscar_flete="SELECT flete from ordendecompras
 WHERE noDePedido='". $orden_compra."'";

$result_flete = mysql_query($sql_buscar_flete);


while ($row_flete = mysql_fetch_array($result_flete)){
$flete=$row_flete["flete"]; 	

}

if($moneda !='mxn'){
	$flete=$flete*$tipo_cambio;
	}


echo '<td> $'.$suma_costo_mn.'</td>';
echo '<td> $'.$flete.'</td>';
echo '<td> $'.$suma_venta_mn.'</td>';
$utilidad_oc=(1-(($suma_costo_mn+$flete)/$suma_venta_mn))*100;
$utilidad_oc=number_format($utilidad_oc,4,".",""); 

echo '<td> '.$utilidad_oc.'%</td>';
echo '</table>';

	echo "<br><b><a target='_blank' href='../contactos/ensenarContacto.php?id=$numero_proveedor&verOC=1'>Contacto Proveedor</a></b>";		 
}







function agregar_folio_pedimento_factura($pedimento, $folio, $factura, $orden_compra, $moneda, $numero_partidas, $sql_actualizar_folio, $agregar_entrada){
	
	
	

require_once('../incl/connect.php');
		
  $sql_partidas="SELECT orden_compra from utilidad_pedido ".$sql_actualizar_folio;
  $result_partidas = mysql_query($sql_partidas);


while ($row_oc = mysql_fetch_array($result_partidas)){
$oc=$row_oc["orden_compra"]; 	





if($orden_compra == $oc){

	if(!empty($pedimento)){
		$sql_pedimento="UPDATE `utilidad_pedido` SET `Pedimento` = '".$pedimento."'".$sql_actualizar_folio;
   
		 if(!$resultado = mysql_query($sql_pedimento)) {
	echo"<script>alert('Error al agregar pedimento ')</script>";		
	}

		}
	
	if(!empty($folio)){
			$sql_folio="UPDATE `utilidad_pedido` SET `folio` = '".$folio."'".$sql_actualizar_folio;
   
   	 if(!$resultado = mysql_query($sql_folio)) {
	echo"<script>alert('Error al agregar folio ')</script>";		
	}
   
		}
	
	if(!empty($factura )){





	$sql_factura="UPDATE `utilidad_pedido` SET `factura_proveedor` = '".$factura."'".$sql_actualizar_folio;
   	 if(!$resultado = mysql_query($sql_factura)) {
	echo"<script>alert('Error al agregar factura ')</script>";		
	}

	}
if(!empty($agregar_entrada)){
		$sql_entrada="UPDATE `utilidad_pedido` SET `entrada` = '".$agregar_entrada."'".$sql_actualizar_folio;
   
		 if(!$resultado = mysql_query($sql_entrada)) {
	echo"<script>alert('Error al agregar entrada ')</script>";		
	}

		}
	
if(empty($pedimento) and empty($folio) and empty($factura) and empty($agregar_entrada)){
	 echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">"; 
	
	}

} //fin del if


}// Fin del while


	
	 echo "<meta http-equiv=\"refresh\" content=\"0;URL=utilidad_pedido.php?orden_compra=$orden_compra&moneda_proveedor=$moneda&partidas=$numero_partidas\">"; 
	
	
	}










echo '</form>';




function filtro(){
	
echo '<br><u><font color="#14A29B">PULSE EL BOTON PARA FILTRAR EL PEDIDO</font></u> <input type="submit" name= "filtro" value="Filtrar" ></input>';
	
	}
function &oc_registrada($orden_compra){
	

require_once('../incl/connect.php');

	$oc_registrada="";
	$buscar_oc="SELECT orden_compra from precios_oc WHERE orden_compra='".$orden_compra."'";

$res_buscar = mysql_query($buscar_oc);

if(mysql_num_rows($res_buscar) > 0){	
	$oc_registrada=TRUE;
	}
	else{
		
		$oc_registrada=FALSE;
		}
	return $oc_registrada;
}	
	
function &precio_modelo_oc($orden_compra, $marca, $modelo){


require_once('../incl/connect.php');
		

$precio_modelo=0;	
$sql_precio="SELECT precio from precios_oc WHERE orden_compra='".$orden_compra."' and marca='".$marca."'
and modelo='".$modelo."'";

$result_precio_oc = mysql_query($sql_precio);

 
while ($row_precio_oc= mysql_fetch_array($result_precio_oc)){

$precio_modelo=$row_precio_oc["precio"]; 

}
		return $precio_modelo;
	
	}
?>
	
</body>
</html>