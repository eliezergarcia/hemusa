Z<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 

require_once('../incl/connect.php');
$insertSQL = "SELECT IVA FROM `cifrasimportantes`";
$result = mysql_query($insertSQL);
$row = mysql_fetch_array($result);
$IVA = $row['IVA'];

if(!empty($_REQUEST["agregarPersona"]) or !empty($_REQUEST["editpersona"] ) or !empty( $_REQUEST["deletepersona"])){
$nombre = $_REQUEST["nombre"];
$puesto = $_REQUEST["puesto"];
$RFC = $_REQUEST["RFC"];
$personaContacto = $_REQUEST["personaContacto"];
$calle = $_REQUEST["calle"];
$colonia = $_REQUEST["colonia"];
$ciudad = $_REQUEST["ciudad"];
$estado = $_REQUEST["estado"];
$cp = $_REQUEST["cp"];
$pais = $_REQUEST["pais"];
$tlf1 = $_REQUEST["tlf1"];
$fax = $_REQUEST["fax"];
$movil = $_REQUEST["movil"];
$correoElectronico = $_REQUEST["correoElectronico"];
$agregarPersona = $_REQUEST["agregarPersona"];
$editpersona = $_REQUEST["editpersona"];
$deletepersona = $_REQUEST["deletepersona"];


}
$edit = $_REQUEST["edit"];
$codigo = $_REQUEST["codigo"];
$Info = $_REQUEST["Info"];
$cotizacion = $_REQUEST["cotizacion"];
$id=$_REQUEST["id"];
$verPagos=$_REQUEST["verPagos"];
$clienteContacto=$_REQUEST["clienteContacto"];

if(isset($_REQUEST["buscar"])){
$buscar=$_REQUEST["buscar"];
}
//making split of a partida.
if(!empty( $_REQUEST["split"]) or !empty( $_REQUEST["idSplit"] ) or !empty ($_REQUEST["cantidadSplit"])){
$idSplit = $_REQUEST["idSplit"];
$cantidadSplit = $_REQUEST["cantidadSplit"];
$split = $_REQUEST["split"];
}
if (isset($split)) {
	 require_once('../incl/connect.php');
$insertSQL='select * from cotizacionherramientas where id = '.$idSplit;
	 $resultPartida=mysql_query($insertSQL);
	 $rowPartida = mysql_fetch_array($resultPartida);
	 
	 if ($cantidadSplit<$rowPartida["cantidad"]) {
	    $insertSQL="update `cotizacionherramientas` set cantidad=cantidad-".$cantidadSplit." where id=".$idSplit;
	    $resultSplit=mysql_query($insertSQL);	 
		
		
	    $insertSQL="INSERT INTO `cotizacionherramientas` ( `cliente` , `cotizacionNo` , `cotizacionRef` , `marca` , `modelo` , `descripcion` , `precioLista` , `cantidad` ,  `Pedido` , `pedidoFecha` , `noDePedido` , `Proveedor` , `proveedorFecha` , `enviadoFecha` , `recibidoFecha` , `Entregado` , `remision` , `factura`, moneda , `Unidad` , `Pedimento`, `FechaPedimento`, `Aduana`, `IdMaterialImportacion`  ) VALUES ( ".$rowPartida["cliente"].", ".$rowPartida["cotizacionNo"].", '".$rowPartida["cotizacionRef"]."', '".$rowPartida["marca"]."', '".addslashes($rowPartida["modelo"])."', '".addslashes($rowPartida["descripcion"])."', ".$rowPartida["precioLista"].", ".$cantidadSplit.", '".$rowPartida["Pedido"]."', '".$rowPartida["pedidoFecha"]."', '".$rowPartida["noDePedido"]."', '".$rowPartida["Proveedor"]."', '".$rowPartida["proveedorFecha"]."', '".$rowPartida["enviadoFecha"]."', '".$rowPartida["recibidoFecha"]."', '".$rowPartida["Entregado"]."', ".$rowPartida["remision"].", ".$rowPartida["factura"].", '".$rowPartida["moneda"]."' , 
		'".$rowPartida["Unidad"]."', '".$rowPartida["Pedimento"]."', '".$rowPartida["FechaPedimento"]."','".$rowPartida["Aduana"]."',
		'".$rowPartida["IdMaterialImportacion"]."' );";
	
			
			
			
			
				if(!$resultSplit=mysql_query($insertSQL)){
			
	echo "<script type=\"text/javascript\">alert(\"Error al crear split \");</script>"; 
	
			}
			else{
			
	  $queryInsert="SELECT MAX( id ) AS id_max FROM cotizacionherramientas";
	  $resInsert=mysql_query($queryInsert);
	  $rowInsert = mysql_fetch_array($resInsert);
	  $id_nuevo= $rowInsert['id_max'];
			
			
			splitUtilidadPedido($idSplit, $id_nuevo, $cantidadSplit);
			}
			$idSplit='';
			
			
			
	 }  
}
//end making split

if (isset($agregarPersona)) {
	 require_once('../incl/connect.php');
$insertSQL = "INSERT INTO `contactosPersonas` ( `empresa` , `nombre` , `RFC` , `personaContacto` , `puesto` , `calle` , `ciudad` , `colonia` , `estado` , `cp` , `tlf1` , `fax` , `movil` , `correoElectronico`, pais) VALUES ('$id',       '$nombre', '$RFC', '$personaContacto', '$puesto', '$calle', '$ciudad', '$colonia', '$estado', '$cp', '$tlf1', '$fax', '$movil', '$correoElectronico', '$pais')";
	 mysql_query($insertSQL);
   mysql_close($conn);
}
if (isset($editpersona)) {
	 require_once('../incl/connect.php');
$insertSQL = "UPDATE `contactospersonas` SET `nombre` = '".$nombre."',`RFC` = '".$RFC."',`personaContacto` = '".$personaContacto."',`puesto` = '".$puesto."',`calle` = '".$calle."',`colonia` = '".$colonia."',`ciudad` = '".$ciudad."',`estado` = '".$estado."',`cp` = '".$cp."',`tlf1` = '".$tlf1."',`fax` = '".$fax."',`movil` = '".$movil."',`correoElectronico` = '".$correoElectronico."', pais= '".$pais."' WHERE `id` = ".$clienteContacto;
	 mysql_query($insertSQL);
   mysql_close($conn);
}
  ?> 

<html>
<link rel="shortcut icon" type="image/x-icon" href="../img/icono.ico">
<head>
<title>Ensenar Contacto</title>
<link rel="stylesheet" type="text/css" href="../fonts.css" />
</head>

<body onLoad="self.focus();document.search.buscar.focus();">
  <table border="0" cellpadding="0" cellspacing="0" summary="" align="center">
    <tr><td><center>

    <style type="text/css">
	.menu a {
		font-family: Century Gothic;
		font-size: 14px;
		font-weight: 900;
		text-decoration: none;
		color: #000000;
		border: 1px solid #FFFFFF;	
	}
	.menu a:hover {
		font-family: Century Gothic;
		font-size: 14px;
		font-weight: 900;
		background-color:#FFFCFC;
		text-decoration: none;
		color: #FF0000;
		border: 1px solid #FF0000;
	}

	</style>
    <style>
		#ventas {
			font-family:Century Gothic;
			font-size:10px;
		}
		#ventas caption {
			text-align:center;
			padding:5px 10px;
			background-color:#8A1618;
			color:#fff;
			font-weight:bold;
		}
		#ventas th {
			
			background-color:#8A1618;
			color:#FFFBFB;
			width:200px;
			
		}
	
		
		#ventas td {
			padding:2px 5px;
			background-color: #FFFFFF;
			border-color: #804B27;
			
		}
		
	</style>

<?php 
    if (isset($cotizacion)) {
       echo '<form action="../cotizaciones/iniciarCotizacion.php" name="Contacto" method=post>';
    } else {
       echo '<form action="ensenarContacto.php?id='.$id.'" name="Contacto" method=post>';
    } 
	 require_once('../incl/connect.php');
$insertSQL = "select Contactos.*, formasdepago.Descripcion as FormaPago from 
Contactos LEFT JOIN formasdepago on contactos.IdFormaPago=formasdepago.IdFormaPago
where id = ".$id."";

    $result = mysql_query($insertSQL);
    $row = mysql_fetch_array($result);
       $id=$row["id"];
       echo '<table border="0" cellpadding="0" cellspacing="0" summary="" align="center" bgcolor="#ffffff" id="ventas">';

       echo '<tr><td align="right" valign="bottom">Empresa</td><td width="5" ></td><td valign="bottom">';
	  	 echo'<div class="menu">';
	   echo'<b><big><a href="editarContacto.php?id='.$row["id"].'">'.$row["nombreEmpresa"].'</a></big></b></td></tr>';
			echo "</div>";
			 $nombreEmpresa=$row["nombreEmpresa"];
			 //getting Factura info
			 if (isset($clienteContacto)) {
 	 		    $insertSQL="select * from contactosPersonas where id = $clienteContacto";
			    $resultFactura = mysql_query($insertSQL);
			    $rowFactura = mysql_fetch_array($resultFactura);
			 }
			 if ($rowFactura['personaContacto']=='FACTURA') {
       		echo '<tr><td align="right">Nombre p/ Factura</td><td></td><td>'.$rowFactura["nombre"].'</td></tr>';
			    echo '<tr><td align="right">R.F.C.</td><td></td><td>'.$rowFactura["RFC"].'</td></tr>';
       } else {
			    echo '<tr><td align="right">R.F.C.</td><td></td><td>'.$row["RFC"].'</td></tr>';
			 }
       echo '<tr><td align="right">Contacto</td><td></td><td>';
   		 echo '<select name="clienteContacto" class="small" onChange="document.Contacto.submit()">';
			 //getting contact person for this contact
		   $rowPersona = mysql_fetch_array($resultPersona);
			 if (isset($clienteContacto) and $clienteContacto!='0') {
    	 		$resultPersona = mysql_query("select * from contactosPersonas where id = $clienteContacto
				order by personaContacto 
				" );
		   } else {
    	 	  $resultPersona = mysql_query("select * from contactosPersonas where empresa = $id order by personaContacto ");
			 }
       while ($rowPersona = mysql_fetch_array($resultPersona)) {
         echo '<option value="'.$rowPersona['id'].'" selected="selected">'.$rowPersona['personaContacto'].'- '.$rowPersona['puesto'].'</option>';
			 }
			 echo $clienteContacto;
			 if (isset($clienteContacto) and $clienteContacto!='0') {
			   echo '<option value="0">General</option>';
			 } else {
			   echo '<option value="0" selected="selected">General</option>';
			 }
   		 echo '</td></tr>';
			 echo '</form>';
			 if (isset($clienteContacto) and $clienteContacto!='0') {
    	 		$resultPersona = mysql_query("select * from contactosPersonas where id = $clienteContacto");
					$rowPersona = mysql_fetch_array($resultPersona);
		   }
			 if ($rowPersona["puesto"]!='') {
			 	 echo '<tr><td align="right">Puesto</td><td></td><td>';
			   echo $rowPersona["puesto"];
			   echo '</td></tr>';
			 }
			 echo '<tr><td align="right">Calle</td><td></td><td>';
			 if ($rowPersona["calle"]!='') {
			   echo $rowPersona["calle"];
			 } else { 
			   echo $row["calle"]." ".$row["NumExt"];
			 }
			 echo ', ';
			 if ($rowPersona["colonia"]!='') {
			   echo $rowPersona["colonia"];
			 } else { 
			   echo $row["colonia"];
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">Ciudad</td><td></td><td>';
			 if ($rowPersona["ciudad"]!='') {
			   echo $rowPersona["ciudad"];
			 } else { 
			   echo $row["ciudad"];
			 }
       echo ', ';
			 if ($rowPersona["estado"]!='') {
			   echo $rowPersona["estado"];
			 } else { 
			   echo $row["estado"];
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">C&oacute;digo Postal</td><td></td><td>';
			 if ($rowPersona["cp"]!='') {
			   echo $rowPersona["cp"];
			 } else { 
			   echo $row["cp"];
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">Pa&iacute;s</td><td></td><td>';
			 echo $row["pais"];
			 echo '</td></tr>';
			 
			 
			   $direccion_envio=$row["direccion_envio"];
			   if(!empty($direccion_envio)){
			 echo '<tr><td align="right"><font color="red">Direcci&oacute;n env&iacute;o</font></td><td></td><td>';
			 echo $row["direccion_envio"];
			 echo '</td></tr>';
				   }
				   else{
			 echo '<tr><td align="right">Direccion envio</td><td></td><td>';
			 echo $row["direccion_envio"];
			 echo '</td></tr>';
					   }
			 
       echo '<tr><td align="right">Telefono.</td><td></td><td>';
			 if ($rowPersona["tlf1"]!='') {
			   echo $rowPersona["tlf1"];
			 } else { 
			   echo $row["tlf1"];
			 }
			 echo ' / ';
			 echo $row["tlf2"];
			 echo '</td></tr>';
       echo '<tr><td align="right">Fax</td><td></td><td>';
			 if ($rowPersona["fax"]!='') {
			   echo $rowPersona["fax"];
			 } else { 
			   echo $row["fax"];
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">Telefono M&oacute;vil</td><td></td><td>';
			 if ($rowPersona["movil"]!='') {
			   echo $rowPersona["movil"];
			 } else { 
			   echo $row["movil"];
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">E-mail</td><td></td><td>';
			 if ($rowPersona["correoElectronico"]!='') {
			   echo "<a href='mailto:".$rowPersona['correoElectronico']."'>".$rowPersona['correoElectronico']."</a>";
			 } else { 
			   echo "<a href='mailto:".$row['correoElectronico']."'>".$row['correoElectronico']."</a>";
			 }
			 echo '</td></tr>';
       echo '<tr><td align="right">P&aacute;gina Web </td><td></td><td>'.$row["paginaWeb"].'</td></tr>';
			 $tipo=$row["tipo"];
       echo '<tr><td align="right">Codigo</td><td></td><td>'.$row["codigo"].'</td></tr>';
       echo '<tr><td align="right">Moneda</td><td></td><td>'.$row["moneda"].'</td></tr>';
	    echo '<tr><td align="right">M&eacute;todo De Pago</td><td></td><td>'.$row["FormaPago"].'</td></tr>';
       echo '<tr><td align="right">Responsable</td><td></td><td>'.$row["responsable"].'</td></tr>';
        // si el tipo de contacto es cliente 
	   if (strtoupper($tipo)=='CLIENTE') {
		   $hora_comida=$row["hora_comida_inicio"]." a ".$row["hora_comida_fin"];
		   $hora_almacen=$row["hora_almacen_inicio"]." a ".$row["hora_almacen_fin"];
		   $hora_revision=$row["hora_revision_inicio"]." a ".$row["hora_revision_fin"];
		   $dia_almacen=$row["dia_almacen"];
		   $dia_revision=$row["dia_revision"];
		   echo "<tr><td align='right'>Horario comida </td><td></td><td>".$hora_comida."</td>";
		   echo "</tr>";
		    echo "<tr><td align='right' >Recepci&oacute;n de material </td><td></td><td>".$dia_almacen."</td>";
		   echo "</tr>";
		    echo "<tr><td align='right' >Horario de almac&eacute;n </td><td></td><td>".$hora_almacen."</td>";
		   echo "</tr>";
		     echo "<tr><td align='right' >D&iacute;a revisi&oacute;n </td><td></td><td>".$dia_revision."</td>";
		   echo "</tr>";
		    echo "<tr><td align='right' >Horario de revisi&oacute;n </td><td></td><td>".$hora_revision."</td>";
		   echo "</tr>";
		   
	   }
	   echo '</table>';
       echo '</form>';
 echo'<div class="menu">';
    	 
echo '<table id="ventas"><tr><td>';
		   echo '<a href="editarContacto.php?id='.$id.'">Editar Contacto</a></td><td>';

			 if (isset($clienteContacto) and $clienteContacto!='Empresa') {
		     echo '<a href="personas/editarPersona.php?id='.$clienteContacto.'&cliente='.$id.'">Editar Persona</a></td><td colspan=2 align=center>';
			 } else {
		     echo '<a href="personas/agregarPersona.php?id='.$id.'">Agregar Persona</a></td><td colspan=2 align=center>';
			 }
			 //getting Factura info
 	 		 $insertSQL="select * from contactosPersonas where empresa = $id and personaContacto='FACTURA'";
			 $resultFactura = mysql_query($insertSQL);
			 $rowFactura = mysql_fetch_array($resultFactura);
			 if ($rowFactura['personaContacto']=='**FACTURA') {
			    echo '<a href="personas/editarPersona.php?id='.$rowFactura['id'].'&cliente='.$id.'">Info p/ Factura</a></td><td>';			 
			 } else {
			    echo '<a href="personas/agregarPersona.php?factura=factura&id='.$id.'">Info p/ Factura</a></td></tr><tr><td>';
       }
			 echo '<a href="verComentarios.php?id='.$clienteContacto.'&cliente='.$id.'">Ver Comentarios</a>';
			 echo '</td><td><a href="../reportes/tiempoDeEntrega.php?cliente='.$id.'">Tiempos de Entregas</a>';
			 echo '</td><td aling="center"><a href="CartaBanco.php?id='.$id.'">Cartas</a></td></tr>';
			 echo '<tr><td>';
echo '</td></tr>';
//echo'</table>';
	 
	
    ?>
  
		<?php 
		if (strtoupper($tipo)=='CLIENTE') {
			
			echo '<table id="ventas">';
				echo '<tr><td><a href="../ordendecompras/warranties.php?cliente='.$id.'">Garantias</a></td>';
		    echo '<td><a href="../remisiones/iniciarRemision.php?cliente='.$id.'">Nuevo Remision</a></td>';
		    echo '<td><a href="../cotizaciones/iniciarCotizacion.php?cliente='.$id.'">Nuevo Cotizaci&oacute;n</a></td></tr>';
    echo '<tr><td><a href="../entregas/nueva_entrega.php?id_cliente='.$id.'">Nueva Entrega </a></center></td>';
    echo '<td><a href="../cotizaciones/importar_cotizacion.php?id_cliente='.$id.'&moneda='.$row["moneda"].'">Importar cotizaci&oacute;n</a></center></td>';
   echo '<td><a href="../hemusa.php">Men&uacute; Principal</a></td>';
    }
	 else {

echo '<table id="ventas">';
echo '<tr><td><a href="../ordendecompras/warranties.php?proveedor='.$id.'">Garantias</a></td>';
echo '<td><a href="../ordendecompras/creandoOrdenDeCompra.php?idProveedor='.$id.'">Nuevo Orden de Compra</a></td><td>';
echo '<a href="ensenarContacto.php?id='.$row['id'].'&verOC=1" >Ver Orden de Compra</a></td>';
echo '<td><a href="../hemusa.php">Men&uacute; Principal</a></td>';
		}    
	
	  
	echo"</tr></table>";
    $marca = $_REQUEST["marca"];
 	echo "</div>";	 
  
    ?> 
    
    <br>
    
		
		
		<?php 
		//form de buscar
		echo '<center><form action="ensenarContacto.php" name="search" method="post">';
		echo '<input type="hidden" name="id" value="'.$id.'" />';
		echo '<input type="text" name="buscar" value="" size="9" />';
		echo '<input type="submit" name="" value="Buscar" />';
    echo '</form></center>';
	  
		
		
		require_once('../incl/connect.php');
//funcion para buscar el stock del modelo 
function &buscar_stock($marca, $modelo)
{	
require_once('../incl/connect.php');
$sql_buscar_stock ="SELECT enReserva 
FROM  `precio".$marca."` 
WHERE  `ref` = '$modelo'";

$almacen=0;
$resultado_stock=mysql_query($sql_buscar_stock);


while($row_stock =mysql_fetch_array($resultado_stock)){
$almacen=$row_stock['enReserva'];				

}


return $almacen;	
}
			
			
	// fin de la funcion para buscar stock	
		
		
//funcion para buscar el PRECIO del modelo 
function &buscar_precio($marca, $modelo, $tabla)
{	
require_once('../incl/connect.php');
if($tabla == 'todas' ){
$sql_buscar_costo ="SELECT precioBase 
FROM  `precio".$marca."` 
WHERE  `ref` = '$modelo'";
	}
	else{
		$sql_buscar_costo ="SELECT precioBase 
FROM  `".$tabla."` 
WHERE  `ref` = '$modelo'";
		
		}

$resultado_precio=mysql_query($sql_buscar_costo);

if(!$resultado_precio=mysql_query($sql_buscar_costo)){
	$precio=0;
	
}
else{
while($row_precio =mysql_fetch_array($resultado_precio)){
$precio=$row_precio['precioBase'];				
}

}
if(empty($precio)){
	$precio=0;
	}
return $precio;	
}
			
			
	// fin de la funcion para buscar PRECIO
	
			
//funcion para buscar tabla proveedor
function &buscar_tabla($id)
{	
require_once('../incl/connect.php');
$tabla="";	
$sql_buscar_tabla ="SELECT tabla 
FROM  `factores_proveedores` 
WHERE  `proveedor` = '$id'";

$resultado_tabla=mysql_query($sql_buscar_tabla);

if(!$resultado_tabla=mysql_query($sql_buscar_tabla)){
	$tabla="todas";
	
}
else{
while($row_tabla =mysql_fetch_array($resultado_tabla)){
$tabla=$row_tabla['tabla'];				
}

}
if(empty($tabla)){
	$tabla="todas";
	}
return $tabla;	
}
// fin de la funcion para buscar tabla
		
	// funcion para sacar los factores de descuento
	
function &factor_descuento($id){
	
$sql_factor="SELECT factor_proveedor
from factores_proveedores WHERE proveedor='$id' ";

$result_factor = mysql_query($sql_factor);
$row_factor_proveedor=0.0;

while($row_factores= mysql_fetch_array($result_factor)){

   $factor= $row_factores["factor_proveedor"];

	if($row_factor_proveedor==0){
		$row_factor_proveedor+=$factor;
		}
		else{
   $row_factor_proveedor= $row_factor_proveedor*$factor;
		}
   }

$factor_proveedor= $row_factor_proveedor; 

if(empty($factor_proveedor)){
	$factor_proveedor=1;
	}
	return $factor_proveedor;
	
	}		
		
		
		
		
if ($tipo=='Proveedor') {
  require_once('../incl/connect.php');
$verOC = $_REQUEST["verOC"];
		 if (isset($verOC)) {
			 
			
	 
		    	 $insertSQL = "SELECT ordendecompras.id,ordendecompras.noDePedido,ordendecompras.fecha, ordendecompras.proveedor,ordendecompras.contacto,ordendecompras.texto,ordendecompras.envia_a, ordendecompras.oa, ordendecompras.factura, ordendecompras.terminado, ordendecompras.flete, ordendecompras.moneda, contactos.nombreEmpresa as 'NombreProveedor', usuarios.Nombre as 'EmpleadoHemusa' FROM ordendecompras 
				 LEFT JOIN contactos on contactos.id= ordendecompras.proveedor
				 LEFT JOIN usuarios on usuarios.id=ordendecompras.contacto
				 WHERE proveedor=".$id." ORDER BY fecha DESC";
			//	echo $insertSQL;
   				 $result = mysql_query($insertSQL);
	 				 echo '<center><h2><b>Ordenes de compra</b></h2></center>';
	 				 echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	 				 echo '<tr><td width="15"><center>#</center></td><td width="60">Numero</td><td width="80">Proveedor</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="5">Warranty</td></tr>';
	 				 $i=1;
	 				 while ($row = mysql_fetch_array($result)) {
						  
							 //$proveedor=&buscar_contacto($row['proveedor']);
							 
							 $proveedor="";
 echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../ordendecompras/creandoOrdenDeCompra.php?noOC='.$row['noDePedido'].'">'.$i.'</a></center></td><td valign="top">'.$row["noDePedido"].'</td><td valign="top">'.$row['NombreProveedor'].'</td><td valign="top">'.$row['EmpleadoHemusa'].'</td><td valign="top" align="right">'.$row["fecha"].'</td>';

require_once('../incl/connect.php');
$insertSQL = "SELECT * FROM warranties WHERE oc='".$row['noDePedido']."'";
 $resultWarranties = mysql_query($insertSQL);
 $num_rows = mysql_num_rows($resultWarranties);
if ($num_rows>0){
echo '<td valign="top" align="right"><a href="warranties.php?OC='.$row['noDePedido'].'">Ver</a>';
}
 else{ echo '<td valign="top" align="right"><a href="warranties.php?OC='.$row['noDePedido'].'">Agregar</a>';
		 	
}


echo '</td></tr>';
		 						 
								 
								
		 						 $i++;
          }
	 			
	 				echo '</table>';

		 
		 } else {
		 


	 	 echo $buscar;

     $quitar = $_REQUEST["quitar"];
     $idHerramienta = $_REQUEST["idHerramienta"];
		 if (isset($quitar)) {
		 		if (isset($idHerramienta)) {
				 		$insertSQL="UPDATE cotizacionHerramientas SET Proveedor='None' WHERE id=".$idHerramienta;
		 				$result = mysql_query($insertSQL);
			  }				
	 	 }
	   echo '<br><br><center><b><a href="ensenarContacto.php?id='.$id.'&herramientasSinPedido=si">Herramientas sin pedido</a></b></center>';
	   
	   if($_GET['herramientasSinPedido']=='si'  or $buscar!=''){
	   echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	   echo '<tr><td width="15"><center><b><a  style="text-decoration: none;" href="../pedidos/editar_pedido.php?id_proveedor='.$id.'">#</a></b></center></td><td width="60"><b>Marca</b></td><td><b>Modelo</b></td><td><b>Descripción</b></td><td width="5"><b>Cant.</b></td><td><b>Cliente</b></td><td width="60"><b>PrecioProv.</b></td><td width="60"><b>Fecha</b></td><td><b>Quitar</b></td><td><b>Almacen</b></td></tr>';
	   $insertSQL = "SELECT * FROM cotizacionHerramientas 
	   
	    WHERE 
  (
marca LIKE  '%".$buscar."%'
OR modelo LIKE  '%".$buscar."%'
OR descripcion LIKE  '%".$buscar."%'
OR noDePedido LIKE  '%".$buscar."%'


)
	  AND( 
	    Proveedor='".strtoupper($nombreEmpresa)."' AND proveedorFecha='0000-00-00' )
	   ORDER BY modelo";
		 $result = mysql_query($insertSQL);
		 $i=1;
		 $total=0;
		 while ($row = mysql_fetch_array($result)) {
		 			 		$insertSQL="SELECT precioBase FROM precio".$row["marca"]." where ref='".$row["modelo"]."'";
	 					  $resultPrecioBase = mysql_query($insertSQL);
							$rowPrecioBase = mysql_fetch_array($resultPrecioBase);
							
							if (isset($buscar) and $buscar!='')	{
								 $insertSQL = "SELECT `nombreEmpresa` FROM `contactos` WHERE id =".$row["cliente"];
	 					  	 $resultCliente = mysql_query($insertSQL);
								 $rowCliente = mysql_fetch_array($resultCliente);
		 	 		    	 $info=strtoupper($row["modelo"]."--".$row["descripcion"]."--".$row["cantidad"]."--".$rowCliente["nombreEmpresa"]."--".$rowPrecioBase['precioBase']."--".$row["NoPedClient"]."--".$row["ref"]);
		 						 if (strstr($info,strtoupper($buscar))) {
    			 			 		echo '<tr><td valign="top"><center>'.$i.'</center></td><td valign="top">'.$row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">'.$row["descripcion"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">';
  							 		echo $rowCliente["nombreEmpresa"].'</td>';
									$tabla=&buscar_tabla($id);
									$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
									$factor=&factor_descuento($id);
									$precio_modelo=$precio_modelo*$factor;
									$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
			  				 		echo '<td valign="top" align=right>'.$precio_modelo.'</td><td valign="top">'.$row["pedidoFecha"].'</td><td valign="top"><center><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&quitar=set&idHerramienta='.$row['id'].'&herramientasSinPedido=si">X</a></center></td>';
								 		$total+=$precio_modelo*$row["cantidad"];							
								 		
										//Lineas para obtener el stock con la marca y el modelo
										
										$marca_sin_pedir=$row["marca"];
										$marca_sin_pedir=trim($marca_sin_pedir);
										$modelo_sin_pedir=$row["modelo"];
										$existencia_almacen=&buscar_stock($marca_sin_pedir, $modelo_sin_pedir);
										echo '<td valign="top"><center> '.$existencia_almacen.' </center></td>';
										// fin de lineas
										
										
										echo '</tr>';
								 		$i++;
							   
								 }
							} else {
    			 			 echo '<tr><td valign="top"><center>'.$i.'</center></td>';
		          if ($row["Entregado"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
			           echo '<td style="color: green" valign="top">';
	            else
			           echo '<td style="color: red" valign="top">';			 
								 echo $row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">'.$row["descripcion"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">';
  							 $insertSQL = "SELECT `nombreEmpresa` FROM `contactos` WHERE id =".$row["cliente"];
	 					  	 $resultCliente = mysql_query($insertSQL);
								 $rowCliente = mysql_fetch_array($resultCliente);
								 echo $rowCliente["nombreEmpresa"].'</td>';
								 
						$tabla=&buscar_tabla($id);
						$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
						$factor=&factor_descuento($id);
						$precio_modelo=$precio_modelo*$factor;
						$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
					
								 
			  				 echo '<td valign="top" align=right>'.$precio_modelo.'</td><td valign="top">'.$row["pedidoFecha"].'</td><td valign="top"><center><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&quitar=set&idHerramienta='.$row['id'].'&herramientasSinPedido=si">X</a></center></td>';
								 $total+=$precio_modelo*$row["cantidad"];
							//Lineas para obtener el stock con la marca y el modelo
										$marca_sin_pedir=$row["marca"];
										$marca_sin_pedir=trim($marca_sin_pedir);
										$modelo_sin_pedir=$row["modelo"];
										$existencia_almacen=&buscar_stock($marca_sin_pedir, $modelo_sin_pedir);
										echo '<td valign="top"><center> '.$existencia_almacen.' </center></td>';
										// fin de lineas
								 echo '</tr>';
								 $i++;
							}
			}	
			echo '</table>';
			echo '<b>'.$total.'</b>';
			echo '<form action="../ordendecompras/creandoOrdenDeCompra.php?idProveedor='.$id.'" method="post">';
			echo '<button type="submit">Pedir</button>';			
			echo '</form>';
			
			
		
	   }
			
			
			
			
     $idHerramienta = $_REQUEST["idHerramienta"];
     $enviado = $_REQUEST["enviado"];
		 if (isset($enviado)) {
		 		if (isset($idHerramienta)) {
				 		$insertSQL="select * from cotizacionHerramientas WHERE id=".$idHerramienta;
		 				$result = mysql_query($insertSQL);
						$row = mysql_fetch_array($result);
						if ($row['enviadoFecha']=='0000-00-00')
				 		   $insertSQL="UPDATE cotizacionHerramientas SET enviadoFecha=now() WHERE id=".$idHerramienta;
						else
							 $insertSQL="UPDATE cotizacionHerramientas SET enviadoFecha='0000-00-00' WHERE id=".$idHerramienta;
		 				$result = mysql_query($insertSQL);
				} 		
	 	 }
     $recibir = $_REQUEST["recibir"];
		 if (isset($recibir)) {
		 		if (isset($idHerramienta)) {
				    $insertSQL = 'select * from cotizacionHerramientas where id='.$idHerramienta;
				    $resultEnt=mysql_query($insertSQL);
				 		$rowEnt = mysql_fetch_array($resultEnt);
						if ($rowEnt['recibidoFecha']=='0000-00-00'){
				       $insertSQL = "update Precio".$rowEnt['marca']." set enReserva=enReserva+".$rowEnt['cantidad']." where ref='".$rowEnt['modelo']."'";	
					   $sqlProductos="UPDATE productos set enReserva=enReserva+".$rowEnt['cantidad']."  WHERE ref='".$rowEnt['modelo']."' and marca='".$rowEnt['marca']."'";
						}
						else{
				       $insertSQL = "update Precio".$rowEnt['marca']." set enReserva=enReserva-".$rowEnt['cantidad']." where ref='".$rowEnt['modelo']."'";		
					      $sqlProductos="UPDATE productos set enReserva=enReserva-".$rowEnt['cantidad']."  WHERE ref='".$rowEnt['modelo']."' and marca='".$rowEnt['marca']."'";
						}
						mysql_query($insertSQL);
						mysql_query($sqlProductos); // para actualizar la tabla productos masiva

						if ($rowEnt['recibidoFecha']=='0000-00-00'){
				 		   $insertSQL="UPDATE cotizacionHerramientas SET recibidoFecha=now() WHERE id=".$idHerramienta;
						   $result = mysql_query($insertSQL);
						   ActualizaTablaCotizacion($idHerramienta);
						}
						else{
				 		   $insertSQL="UPDATE cotizacionHerramientas SET recibidoFecha='0000-00-00' WHERE id=".$idHerramienta;
						   $result = mysql_query($insertSQL);
						   ActualizaTablaCotizacion($idHerramienta);
						}
						//echo $insertSQL;	 							 
		 				
				} 	// fin isset idherramienta	
	 	 } // fin de if isset enviado

	   echo '<br><br><center><b><a href="ensenarContacto.php?id='.$id.'&HerramientasSinRecibido=1">Herramientas sin recibido</a></b></center>';
	   
	   if($_GET['HerramientasSinRecibido']=="1" or $buscar!=''){
	 	 echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	   echo '<tr><td><center><b><a  style="text-decoration: none;" href="../pedidos/sin_recibir.php?id_proveedor='.$id.'">#</a></b></center></td><td><b>Enviado</b></td><td><b>Recibir</b></td><td><b>Marca</b></td><td><b>Modelo</b></td><td><b>Cant.</b></td><td><b>Descripción</b></td><td><b>Cliente</b></td><td><b>Pedido</b></td><td><b>Fecha</b></td><td><b>Costo</b></td></tr>';
	   $insertSQL = "SELECT cotizacionherramientas.id, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.enviadoFecha, cotizacionherramientas.recibidoFecha, cotizacionherramientas.marca, cotizacionherramientas.cantidad, cotizacionherramientas.pedidoFecha, cotizacionherramientas.noDePedido, contactos.nombreEmpresa,
	   cotizacionherramientas.Entregado, cotizacionherramientas.cotizacionNo,
	   cotizacionherramientas.cotizacionRef,
	   cotizacionherramientas.Proveedor, cotizacionherramientas.cliente,
	   cotizacionherramientas.precioLista,  cotizacionherramientas.factura,
	    cotizacionherramientas.moneda 
	     FROM cotizacionHerramientas 
	   LEFT JOIN contactos on contactos.id=cotizacionherramientas.cliente
 WHERE 
  (
marca LIKE  '%".$buscar."%'
OR modelo LIKE  '%".$buscar."%'
OR descripcion LIKE  '%".$buscar."%'
OR noDePedido LIKE  '%".$buscar."%'
OR enviadoFecha LIKE  '%".$buscar."%'

)
 
 AND(
 Proveedor='".strtoupper($nombreEmpresa)."' AND recibidoFecha='0000-00-00' AND proveedorFecha!='0000-00-00')
 
  ORDER BY modelo";
		
	//	echo $insertSQL;
		 $result = mysql_query($insertSQL);
		 $i=1;
		 while ($row = mysql_fetch_array($result)) {

				if (isset($buscar) and $buscar!='')	{
					
		 	 	 	 $info=strtoupper($row["modelo"]."--".$row["descripcion"]."--".$row["cantidad"]."--".$row["nombreEmpresa"]."--".$rowPrecioBase['precioBase']."--"."--"."--".$row["noDePedido"]."--".$row["pedidoFecha"]."--".$row["enviadoFecha"]);
		 		   if (strstr($info,strtoupper($buscar))) {

     			 		echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="verPedido.php?numero='.$row[numero].'&fecha='.$fecha.'">'.$i.'</a></center></td>';
							echo '<td><a  style="text-decoration: none;" href="ensenarContacto.php?buscar='.$buscar.'&id='.$id.'&enviado=set&idHerramienta='.$row['id'].'&HerramientasSinRecibido=1">';
							if ($row['enviadoFecha']=='0000-00-00')
							   echo 'No';
							else 	 
								 echo $row['enviadoFecha'];
							echo '</a></td>';
							echo '<td valign="top"><a  style="text-decoration: none;" href="ensenarContacto.php?buscar='.$buscar.'&id='.$id.'&recibir=set&idHerramienta='.$row['id'].'">recibir</a></td>';

		          if ($row["Entregado"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
			           echo '<td style="color: green" valign="top">';
	            else
			           echo '<td style="color: red" valign="top">';			 


							echo '<a href="http://buy1.snapon.com/catalog/search.asp?partno='.$row["modelo"].'&searchTrnsfr=true&search_type=Part&store=snapon-store" target="snapon" style="text-decoration: none;">'.$row["marca"].'</a></td><td valign="top">'.$row["modelo"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top">'.SUBSTR($row["descripcion"],0,25).'</td><td valign="top" align="right">';
							
							if ($row["Entregado"]!='0000-00-00') {
							   echo 'ALMACEN</td>';
							} else {
							   echo $row["nombreEmpresa"].'</td>';
							}	 

			  			echo '<td valign="top"><a name="marca">'.$row["noDePedido"].'</a></td><td valign="top">'.$row["pedidoFecha"].'</td><td align=right>';
				
						$tabla=&buscar_tabla($id);
						$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
						$factor=&factor_descuento($id);
						$precio_modelo=$precio_modelo*$factor;
						$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
						echo ''.$precio_modelo.'</td>';
							
							if ($idSplit==$row["id"]) {
							   echo '<td>';
								 echo '<form action="ensenarContacto.php" method="post">';
								 echo '<input type="hidden" name="CotizacionNo" value="'.$CotizacionNo.'" />';
								 echo '<input type="hidden" name="idSplit" value="'.$idSplit.'" />';
								 echo '<input type="hidden" name="buscar" value="'.$buscar.'" />';
								 echo '<input type="hidden" name="id" value="'.$id.'" />';
								 echo '<input type="text" name="cantidadSplit" />';
								 echo '<input type="submit" name="split" value="Split" />';
								 echo '</form>';
								 echo '</td>';
			        } elseif ($row["cantidad"]>1) {
							 	 echo '<td><a href="ensenarContacto.php?buscar='.$buscar.'&id='.$id.'&idSplit='.$row["id"].'">Split</a></td>';
			        } else {
							   echo '<td>No Split</td>';
			        }
							
							echo '</tr>';
							$i++;					 
					 
					 }
					 
				} else {

     			 		echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="verPedido.php?numero='.$row['numero'].'&fecha='.$fecha.'">'.$i.'</a></center></td>';
							echo '<td><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&enviado=set&HerramientasSinRecibido=1&buscar='.$row['modelo'].'&idHerramienta='.$row['id'].'">';
							if ($row['enviadoFecha']=='0000-00-00')
							   echo 'No';
							else 	 
								 echo $row['enviadoFecha'];
							echo '</a></td>';
							echo '<td valign="top"><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&recibir=set&idHerramienta='.$row['id'].'&buscar='.$row['modelo'].'">recibir</a></td>';

		   				if ($row["Entregado"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
			    		   echo '<td style="color: green" valign="top">';
	            else
			           echo '<td style="color: red" valign="top">';			 
							
							
							echo $row["marca"].'</td><td valign="top"><a href="http://buy1.snapon.com/catalog/search.asp?partno='.$row["modelo"].'&searchTrnsfr=true&search_type=Part&store=snapon-store" target="snapon" style="text-decoration: none;">'.$row["modelo"].'</a></td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top">'.SUBSTR($row["descripcion"],0,25).'</td><td valign="top" align="right">';
			
			
							if ($row["Entregado"]!='0000-00-00') {
							   echo 'ALMACEN</td>';
							} else {
							   echo $row["nombreEmpresa"].'</td>';
							}	 

			  			echo '<td valign="top"><a name="marca">'.$row["noDePedido"].'</a></td><td valign="top">'.$row["pedidoFecha"].'</td><td align=right>';
				
						$tabla=&buscar_tabla($id);
						$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
						$factor=&factor_descuento($id);
						$precio_modelo=$precio_modelo*$factor;
						$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
							echo ''.$precio_modelo.'</td></tr>';
							$i++;
				 }

			}	
			echo '</table>';

	   }
			
		
	   echo '<br><br><center><b><a href="ensenarContacto.php?id='.$id.'&HerramientasSinEntregar=1">Herramientas sin entregar</a></b></center>';
	   
	   	if($_GET['HerramientasSinEntregar']=="1" or $buscar!=''){
	 	 echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	   $cliente = $_REQUEST["cliente"];
     if (isset($cliente)) {
	      echo '<tr><td><center><b>#</b></center></td><td><b>Enviado</b></td><td><b>Recibir</b></td><td><b>Marca</b></td><td><b>Modelo</b></td><td><b>Cant.</b></td><td><b>Descripción</b></td><td><b><a href="ensenarContacto.php?id='.$id.'">Cliente</a></b></td><td><b>Pedido</b></td><td><b>Fecha</b></td><td><b>Costo</b></td></tr>';
		    $insertSQL = "SELECT * FROM cotizacionHerramientas WHERE Proveedor='".strtoupper($nombreEmpresa)."' AND recibidoFecha!='0000-00-00' AND proveedorFecha!='0000-00-00' AND Entregado='0000-00-00' ORDER BY cliente";
		 } else {
	      echo '<tr><td><center><b>#</b></center></td><td><b>Enviado</b></td><td><b>Recibir</b></td><td><b>Marca</b></td><td><b>Modelo</b></td><td><b>Cant.</b></td><td><b>Descripción</b></td><td><b><a href="ensenarContacto.php?id='.$id.'&cliente=1">Cliente</a></b></td><td><b>Pedido</b></td><td><b>Fecha</b></td><td><b>Costo</b></td></tr>';
		  
		  
		    $insertSQL = "SELECT cotizacionherramientas.id, cotizacionherramientas.modelo, cotizacionherramientas.descripcion, cotizacionherramientas.enviadoFecha, cotizacionherramientas.recibidoFecha, cotizacionherramientas.marca, cotizacionherramientas.cantidad, cotizacionherramientas.pedidoFecha, cotizacionherramientas.noDePedido, contactos.nombreEmpresa,
	   cotizacionherramientas.Entregado, cotizacionherramientas.cotizacionNo,
	   cotizacionherramientas.cotizacionRef,
	   cotizacionherramientas.Proveedor, cotizacionherramientas.cliente,
	     cotizacionherramientas.precioLista,  cotizacionherramientas.factura,
	    cotizacionherramientas.moneda 
	     FROM cotizacionHerramientas 
	   LEFT JOIN contactos on contactos.id=cotizacionherramientas.cliente
 WHERE 
  (
marca LIKE  '%".$buscar."%'
OR modelo LIKE  '%".$buscar."%'
OR descripcion LIKE  '%".$buscar."%'
OR noDePedido LIKE  '%".$buscar."%'
OR enviadoFecha LIKE  '%".$buscar."%'
OR recibidoFecha LIKE  '%".$buscar."%'
)
 
 AND(
 Proveedor='".strtoupper($nombreEmpresa)."' AND recibidoFecha!='0000-00-00' AND proveedorFecha!='0000-00-00' AND Entregado='0000-00-00' )
 
 ORDER BY recibidoFecha";
		  
		//  echo $insertSQL;
		 /*   $insertSQL = "SELECT * FROM cotizacionHerramientas WHERE Proveedor='".strtoupper($nombreEmpresa)."' AND recibidoFecha!='0000-00-00' AND proveedorFecha!='0000-00-00' AND Entregado='0000-00-00' ORDER BY recibidoFecha";
		 
		 */
		 }
		 $result = mysql_query($insertSQL);
		 $i=1;
		 while ($row = mysql_fetch_array($result)) {

				if (isset($buscar) and $buscar!='')	{
					/* $insertSQL = "SELECT `nombreEmpresa`, tlf1 FROM `contactos` WHERE id =".$row["cliente"];
	 			 	 $resultCliente = mysql_query($insertSQL);
					 $rowCliente = mysql_fetch_array($resultCliente);*/
		 	 	 	 $info=strtoupper($row["modelo"]."--".$row["descripcion"]."--".$row["cantidad"]."--".$row["nombreEmpresa"]."--"."--"."--".$row["ref"]."--".$row["noDePedido"]."--".$row["pedidoFecha"]."--".$row["enviadoFecha"]);
		 		   if (strstr($info,strtoupper($buscar))) {

     			 		if ($row['factura']!=0)
							   echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row["factura"].'">'.$i.'</a></center></td>';
							else	 
							   echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row["cotizacionNo"].'">'.$i.'</a></center></td>';
							echo '<td><a  style="text-decoration: none;" href="ensenarContacto.php?buscar='.$buscar.'&id='.$id.'&enviado=set&idHerramienta='.$row['id'].'">';
							if ($row['enviadoFecha']=='0000-00-00')
							   echo 'No';
							else 	 
								 echo $row['enviadoFecha'];
							echo '</a></td>';
							echo '<td valign="top"><a  style="text-decoration: none;" href="ensenarContacto.php?buscar='.$buscar.'&id='.$id.'&recibir=set&idHerramienta='.$row['id'].'">'.$row['recibidoFecha'].'</a></td>';

		   if ($row["Entregado"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
			    echo '<td style="color: green" valign="top">';
	     else
			    echo '<td style="color: red" valign="top">';			 


							echo $row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top">'.SUBSTR($row["descripcion"],0,25).'</td><td valign="top" align="right">';
							echo substr($row["nombreEmpresa"],0,30).' - '.'</td>';

			  			echo '<td valign="top"><a name="marca">'.$row["noDePedido"].'</a></td><td valign="top">'.$row["pedidoFecha"].'</td><td align=right>';



							
						$tabla=&buscar_tabla($id);
						$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
						$factor=&factor_descuento($id);
						$precio_modelo=$precio_modelo*$factor;
						$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
							echo ''.$precio_modelo.'</td>';

							echo '</tr>';
							$i++;					 
					 
					 } 

				} else {

     			 		if ($row['factura']!=0)
							   echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row["factura"].'">'.$i.'</a></center></td>';
							else	 
     			 		   echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row["cotizacionNo"].'">'.$i.'</a></center></td>';
							echo '<td><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&enviado=set&idHerramienta='.$row['id'].'">';
							if ($row['enviadoFecha']=='0000-00-00')
							   echo 'No';
							else 	 
								 echo $row['enviadoFecha'];
							echo '</a></td>';
							echo '<td valign="top"><a  style="text-decoration: none;" href="ensenarContacto.php?id='.$id.'&recibir=set&idHerramienta='.$row['id'].'">'.$row['recibidoFecha'].'</a></td>';

		   if ($row["Entregado"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
			    echo '<td style="color: green" valign="top">';
	     else
			    echo '<td style="color: red" valign="top">';			 
							
							
							echo $row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top">'.SUBSTR($row["descripcion"],0,25).'</td><td valign="top" align="right">';
						
							echo substr($row["nombreEmpresa"],0,30).' - '.'</td>';

			  			echo '<td valign="top"><a name="marca">'.$row["noDePedido"].'</a></td><td valign="top">'.$row["pedidoFecha"].'</td><td align=right>';
						/*	if (strtoupper($row["marca"])=="SNAPON") {
							   $insertSQL = "SELECT `precioBase` FROM precioSnapon WHERE ref ='".$row["modelo"]."'";
								 $resultPrecio = mysql_query($insertSQL);
								 $rowPrecio = mysql_fetch_array($resultPrecio);
								 echo .6*$rowPrecio["precioBase"];
							}*/
						$tabla=&buscar_tabla($id);
						$precio_modelo=&buscar_precio($row["marca"], $row["modelo"], $tabla);
						$factor=&factor_descuento($id);
						$precio_modelo=$precio_modelo*$factor;
						$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales
						echo ''.$precio_modelo.'</td></tr>';
						$i++;
				 }

			}	
			echo '</table>';


			}//Fin del if($_GET[HerramientasSinEntregar=1])
			
		}	// sin del else verOC
			
			
			
			
			
			
			
			
			
			
} //fin del if $tipo==proveedor
 elseif (strtoupper($tipo)=='CLIENTE') {


    if (isset($buscar) and $buscar!='') {
		//buscar en facturas no entregados
		
		
	
		
	/*  $insertSQL = "SELECT * FROM Cotizacion WHERE Pedido!='0000-00-00' AND fechaEntregado='0000-00-00' and cliente=".$id." and factura !=0 ORDER BY factura DESC";
	 
	 */
	 $insertSQL="SELECT cotizacion.id, cotizacion.ref, cotizacion.cliente, 
	 cotizacion.contacto , cotizacion.factura, cotizacion.facturaFecha,
	 cotizacion.NoPedClient, cotizacion.fecha, cotizacion.partidaCantidad ,
	 contactos.nombreEmpresa, cotizacion.precioTotal, cotizacion.IVA, 
	 cotizacion.moneda, cotizacion.Pedido, cotizacion.TiempoEntrega
	 FROM cotizacion LEFT JOIN contactos on contactos.id=cotizacion.cliente
	 WHERE 
	 
	 ( factura LIKE '%".$buscar."%' OR cotizacion.ref LIKE '%".$buscar."%' OR NoPedClient LIKE '%".$buscar."%' ) 
	 
	 AND (fechaEntregado='0000-00-00' and cliente=".$id." and factura !=0) order by factura  DESC
	 ";
	 
	// echo $insertSQL;
	 
		$result = mysql_query($insertSQL);
	
		echo "<b>No Entregado:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
		echo '<tr><td width="15"><center>En días</center></td><td width="60">Ref.</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td></tr>';
		$i=1;
		while ($row = mysql_fetch_array($result)) {
	    	/*	$insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);
*/
		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$row["IVA"],2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($row["nombreEmpresa"].$row["contacto"].$row["fecha"].$row["precioTotal"].$precioConIva.$row["Pedido"].$row["factura"].$row["facturaFecha"].$row["NoPedClient"].$row["ref"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {

	    			 echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?deMenu=1&numero='.$row["ref"].'&fecha='.$row["fecha"].'&contacto='.$row['contacto'].'&CotizacionNo='.$row['id'].'&cliente='.$row['cliente'].'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'">';
						 $year = substr($row['Pedido'],0,4);
						 $month = substr($row['Pedido'],5,2);									 
						 $day = substr($row['Pedido'],8,2);	
						 echo ((int)((mktime (0,0,0,$month,$day,$year) + ($row['TiempoEntrega']+1)*86400 - time(void))/86400));
			
						 echo '</a></center></td><td valign="top">';
						 if ($row["factura"]!=0)
			   		 		echo $row["factura"];
			       else
			   		 		echo $row["NoPedClient"];
			       echo '</td><td valign="top">'.$row["nombreEmpresa"].'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["Pedido"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.$precioConIva.'</td></tr>';
         }

			//	 $total+=round($row["cantidad"]*$row["precioLista"]);
				 $i++;
    }
	  echo '</table>';




		
		//buscar en facturas no pagados
		
		
		 $insertSQL="SELECT cotizacion.id, cotizacion.ref, cotizacion.cliente, 
	 cotizacion.contacto , cotizacion.factura, cotizacion.facturaFecha,
	 cotizacion.NoPedClient, cotizacion.fecha, cotizacion.partidaCantidad ,
	 contactos.nombreEmpresa, cotizacion.precioTotal, cotizacion.IVA, 
	 cotizacion.moneda, cotizacion.Pedido, cotizacion.TiempoEntrega
	 FROM cotizacion LEFT JOIN contactos on contactos.id=cotizacion.cliente
	 WHERE 
	 
	 ( factura LIKE '%".$buscar."%' OR cotizacion.ref LIKE '%".$buscar."%' OR NoPedClient  LIKE '%".$buscar."%' ) 
	 
	 AND ( factura!=0 AND Pedido != '0000-00-00' AND `Pagado` < 1.14 * `precioTotal` AND cliente=".$id." ) ORDER BY facturaFecha DESC
	 ";
		
  /*  $insertSQL = "SELECT * FROM Cotizacion WHERE factura!=0 AND Pedido != '0000-00-00' AND `Pagado` < 1.14 * `precioTotal` AND cliente=".$id." ORDER BY facturaFecha DESC";*/
  // echo $insertSQL;
	 
   	$result = mysql_query($insertSQL);
		echo "<b>No Pagado:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
		echo '<tr><td width="15"><center>En días</center></td><td width="60">Ref.</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td></tr>';
		

		$i=1;
		while ($row = mysql_fetch_array($result)) {
	    	/*	$insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);
*/
		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$row["IVA"],2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($row["nombreEmpresa"].$row["contacto"].$row["fecha"].$row["precioTotal"].$precioConIva.$row["Pedido"].$row["factura"].$row["facturaFecha"].$row["NoPedClient"].$row["ref"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {

	    			 echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?deMenu=1&numero='.$row["ref"].'&fecha='.$row["fecha"].'&contacto='.$row['contacto'].'&CotizacionNo='.$row['id'].'&cliente='.$row['cliente'].'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'">';
						 $year = substr($row['Pedido'],0,4);
						 $month = substr($row['Pedido'],5,2);									 
						 $day = substr($row['Pedido'],8,2);	
						 echo ((int)((mktime (0,0,0,$month,$day,$year) + ($row['TiempoEntrega']+1)*86400 - time(void))/86400));
			
						 echo '</a></center></td><td valign="top">';
						 if ($row["factura"]!=0)
			   		 		echo $row["factura"];
			       else
			   		 		echo $row["NoPedClient"];
			       echo '</td><td valign="top">'.$row["nombreEmpresa"].'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["Pedido"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.$precioConIva.'</td></tr>';
         }

				 //$total+=round($row["cantidad"]*$row["precioLista"]);
				 $i++;
    }
	  echo '</table>';
	

		
		//buscar en facturas terminados
	
	
	 $insertSQL="SELECT cotizacion.id, cotizacion.ref, cotizacion.cliente, 
	 cotizacion.contacto , cotizacion.factura, cotizacion.facturaFecha,
	 cotizacion.NoPedClient, cotizacion.fecha, cotizacion.partidaCantidad ,
	 contactos.nombreEmpresa, cotizacion.precioTotal, cotizacion.IVA, 
	 cotizacion.moneda, cotizacion.Pedido, cotizacion.TiempoEntrega
	 FROM cotizacion LEFT JOIN contactos on contactos.id=cotizacion.cliente
	 WHERE 
	 
	 ( factura LIKE '%".$buscar."%' OR cotizacion.ref LIKE '%".$buscar."%' OR NoPedClient  LIKE '%".$buscar."%' ) 
	 
	 AND ( fechaEntregado!='0000-00-00' and cliente=".$id." and Pagado>1.14*precioTotal) ORDER BY  factura DESC
	 ";
	
	/*  $insertSQL = "SELECT * FROM Cotizacion WHERE fechaEntregado!='0000-00-00' and cliente=".$id." and Pagado>1.14*precioTotal ORDER BY factura DESC";*/
	//echo $insertSQL;
	 
    $result = mysql_query($insertSQL);
		echo "<b>Terminados:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
		echo '<tr><td width="15"><center>En días</center></td><td width="60">Ref.</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td><td>Cant.</td>
		<td>Pedido</td><td>Suma</td><td>Moneda</td></tr>';
		$i=1;
		while ($row = mysql_fetch_array($result)) {
	    		/*$insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);*/

		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$row["IVA"],2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($row["nombreEmpresa"]."--".$row["contacto"]."--".$row["fecha"]."--".$row["precioTotal"]."--".$precioConIva.$row["Pedido"]."--".$row["factura"]."--".$row["facturaFecha"]."--".$row["NoPedClient"]."--".$row["ref"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {

	    			 echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?deMenu=1&numero='.$row["ref"].'&fecha='.$row["fecha"].'&contacto='.$row['contacto'].'&CotizacionNo='.$row['id'].'&cliente='.$row['cliente'].'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'">';
						 $year = substr($row['Pedido'],0,4);
						 $month = substr($row['Pedido'],5,2);									 
						 $day = substr($row['Pedido'],8,2);	
						 echo ((int)((mktime (0,0,0,$month,$day,$year) + ($row['TiempoEntrega']+1)*86400 - time(void))/86400));
			
						 echo '</a></center></td><td valign="top">';
						 if ($row["factura"]!=0)
			   		 		echo $row["factura"];
			       else
			   		 		echo $row["ref"];
			       echo '</td><td valign="top">'.$row["nombreEmpresa"].'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["Pedido"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td>
				   <td>'.$row["NoPedClient"].'</td>
				   <td valign="top" align="right">'.$precioConIva.'</td><td>'.$row['moneda'].'</td></tr>';
         }

				 
				 $i++;
    }
	  echo '</table>';


		
		//buscar en cotizaciones
		
			 $insertSQL="SELECT cotizacion.id, cotizacion.ref, cotizacion.cliente, 
	 cotizacion.contacto , cotizacion.factura, cotizacion.facturaFecha,
	 cotizacion.NoPedClient, cotizacion.fecha, cotizacion.partidaCantidad ,
	 contactos.nombreEmpresa, cotizacion.precioTotal, cotizacion.IVA, 
	 cotizacion.moneda, cotizacion.Pedido, cotizacion.TiempoEntrega
	 FROM cotizacion LEFT JOIN contactos on contactos.id=cotizacion.cliente
	 WHERE 
	 
	 ( factura LIKE '%".$buscar."%' OR cotizacion.ref LIKE '%".$buscar."%' OR NoPedClient  LIKE '%".$buscar."%' ) 
	 
	 AND ( remision=0 and comentario='' and cliente=".$id." ) ORDER BY  fecha  DESC
	 ";
	
		//echo $insertSQL;
	 
	 /*	$insertSQL = "SELECT * FROM Cotizacion WHERE remision=0 and comentario='' and cliente=".$id." ORDER BY fecha DESC";*/
   	$result = mysql_query($insertSQL);
		echo "<b>Cotizaciones:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
		echo '<tr><td width="15"><center>En días</center></td><td width="60">Ref.</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td></tr>';
		$i=1;
		while ($row = mysql_fetch_array($result)) {
	    		$insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);

		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$row["IVA"],2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($r["nombreEmpresa"].$row1["modelo"].$row1["cotizacionRef"].$row1["marca"].$precioConIva.$row1["descripcion"].$row1["Proveedor"].$row1["noDePedido"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {

	    			 echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?deMenu=1&numero='.$row["ref"].'&fecha='.$row["fecha"].'&contacto='.$row['contacto'].'&CotizacionNo='.$row['id'].'&cliente='.$row['cliente'].'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'">';
						 $year = substr($row['Pedido'],0,4);
						 $month = substr($row['Pedido'],5,2);									 
						 $day = substr($row['Pedido'],8,2);	
						 echo ((int)((mktime (0,0,0,$month,$day,$year) + ($row['TiempoEntrega']+1)*86400 - time(void))/86400));
			
						 echo '</a></center></td><td valign="top">';
						 if ($row["factura"]!=0)
			   		 		echo $row["factura"];
			       else
			   		 		echo $row["ref"];
			       echo '</td><td valign="top">'.$r["nombreEmpresa"].'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["Pedido"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.$precioConIva.'</td></tr>';
         }

				
				 $i++;
    }
	  echo '</table>';


		
		//buscar en pagos
	//  $result = mysql_query("SELECT * FROM `payments` where client=".$id." ORDER BY factura DESC");
		
//buscar en herramientas no entregados
	//   $insertSQL = "SELECT * FROM cotizacionHerramientas WHERE cliente=".$id." AND Pedido='si' AND Entregado='0000-00-00' ORDER BY modelo";
	  $insertSQL=" SELECT Cotizacionherramientas.id, Cotizacionherramientas.cliente, Cotizacionherramientas.cotizacionRef, Cotizacionherramientas.modelo, Cotizacionherramientas.marca, Cotizacionherramientas.descripcion, Cotizacionherramientas.Proveedor, Cotizacionherramientas.noDePedido, Cotizacionherramientas.factura, Cotizacionherramientas.cotizacionNo, Cotizacionherramientas.cantidad, Cotizacionherramientas.precioLista, Cotizacionherramientas.enviadoFecha, Cotizacionherramientas.recibidoFecha,
	  cotizacionherramientas.Entregado
	  , Cotizacion.NoPedClient
FROM cotizacionHerramientas
LEFT JOIN cotizacion ON cotizacionherramientas.cotizacionNo = cotizacion.Id
WHERE (

cotizacionherramientas.marca LIKE  '%".$buscar."%'
OR cotizacionherramientas.modelo LIKE  '%".$buscar."%'
OR cotizacionherramientas.descripcion LIKE  '%".$buscar."%'
OR cotizacionherramientas.noDePedido LIKE  '%".$buscar."%'
OR cotizacion.NoPedClient LIKE '%".$buscar."%'

)

AND (Cotizacionherramientas.cliente =".$id."
AND Cotizacionherramientas.Pedido =  'si'
AND Cotizacionherramientas.Entregado =  '0000-00-00')
ORDER BY modelo";

//echo $insertSQL;
	 
		 $result = mysql_query($insertSQL);
		
		echo "<b>Herramientas Pedido:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	     echo '<tr><td width="15"><b>#</b></td><td width="60"><b>Marca</b></td><td width="80"><b>Modelo</b></td><td width="100"><b>Descripción</b></td><td width="5"><b>Cant.</b></td><td width="75"><b>Precio Unidad</b></td><td width="60"><b>Pedido</b></td><td width="60"><b>Orden</b></td><td width="60"><b>Enviado</b></td><td width="60"><b>Recibido</b></td></tr>';
		$i=1;
		while ($row1 = mysql_fetch_array($result)) {
	    		$insertSQL = "SELECT * FROM Contactos WHERE id=".$row1['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);

		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$IVA,2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($r["nombreEmpresa"].$row1["modelo"].$row1["cotizacionRef"].$row1["marca"].$precioConIva.$row1["descripcion"].$row1["Proveedor"].$row1["noDePedido"].$row1["NoPedClient"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {
					       if ($row1["factura"]!='0') {
								    $cotizacionNo=$row1["factura"];
								 } else {
								    $cotizacionNo=$row1["cotizacionNo"];
								 }  
								 
	               echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$cotizacionNo.'">'.$i.'</a></td><td valign="top">'.$row1["marca"].'</td><td valign="top">'.$row1["modelo"].'</td><td valign="top">'.$row1["descripcion"].'</td><td valign="top" align="right">'.$row1["cantidad"].'</td><td valign="top" align="right">'.$row1["precioLista"].'</td>';
			           echo '<td valign="top">'.$row1["NoPedClient"].'</td><td valign="top"><a href="../ordendecompras/creandoOrdenDeCompra.php?noOC='.$row1["noDePedido"].'" style="text-decoration: none;">'.$row1["noDePedido"].'</a></td>';
							   if ($row1["enviadoFecha"]=='0000-00-00') 
								    echo '<td valign="top">No</td>';
								 else
								    echo '<td valign="top">'.substr($row1["enviadoFecha"],8,2).'/'.substr($row1["enviadoFecha"],5,2).'/'.substr($row1["enviadoFecha"],0,4).'</td>';
							   if ($row1["recibidoFecha"]=='0000-00-00') 
								    echo '<td valign="top">No</td></tr>';
								 else
								    echo '<td valign="top">'.substr($row1["recibidoFecha"],8,2).'/'.substr($row1["recibidoFecha"],5,2).'/'.substr($row1["recibidoFecha"],0,4).'</td></tr>';
								 $i++;
         }

				 $total+=round($row["cantidad"]*$row["precioLista"]);
    }
	  echo '</table>';



		
		//buscar en herramientas entregados
	 
	 
	 
	 
	  $insertSQL=" SELECT Cotizacionherramientas.id, Cotizacionherramientas.cliente, Cotizacionherramientas.cotizacionRef, Cotizacionherramientas.modelo, Cotizacionherramientas.marca, Cotizacionherramientas.descripcion, Cotizacionherramientas.Proveedor, Cotizacionherramientas.noDePedido, Cotizacionherramientas.factura, Cotizacionherramientas.cotizacionNo, Cotizacionherramientas.cantidad, Cotizacionherramientas.precioLista, Cotizacionherramientas.enviadoFecha, Cotizacionherramientas.recibidoFecha,
cotizacionherramientas.Entregado,
Cotizacion.NoPedClient
FROM cotizacionHerramientas
LEFT JOIN cotizacion ON cotizacionherramientas.cotizacionNo = cotizacion.Id 
WHERE (

cotizacionherramientas.marca LIKE  '%".$buscar."%'
OR cotizacionherramientas.modelo LIKE  '%".$buscar."%'
OR cotizacionherramientas.descripcion LIKE  '%".$buscar."%'
OR cotizacionherramientas.noDePedido LIKE  '%".$buscar."%'
OR Cotizacion.NoPedClient LIKE  '%".$buscar."%'

)

AND (Cotizacionherramientas.cliente =".$id."
AND Cotizacionherramientas.Pedido =  'si'
AND Cotizacionherramientas.Entregado !=  '0000-00-00')
ORDER BY modelo";
//echo $insertSQL;
	 
	 /*  $insertSQL = "SELECT * FROM cotizacionHerramientas WHERE cliente=".$id." AND Pedido='si' AND Entregado!='0000-00-00' ORDER BY modelo";*/
  	 $result = mysql_query($insertSQL);

echo "<b>Herramientas Entregado:</b>";
echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
echo '<tr><td width="15"><b>#</b></td><td width="60"><b>Marca</b></td><td width="80"><b>Modelo</b></td><td width="100"><b>Descripción</b></td><td width="5"><b>Cant.</b></td><td width="75"><b>Precio Unidad</b></td><td><b>Pedido</b></td>
<td width="60"><b>Factura</b></td><td width="60"><b>Orden</b></td><td width="60"><b>Entregado</b></td></tr>';
		$i=1;
		while ($row1 = mysql_fetch_array($result)) {
	    		$insertSQL = "SELECT * FROM Contactos WHERE id=".$row1['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);

		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$IVA,2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($r["nombreEmpresa"].$row1["modelo"].$row1["cotizacionRef"].$row1["marca"].$precioConIva.$row1["descripcion"].$row1["Proveedor"].$row1["noDePedido"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {
					       if ($row1["factura"]!='0') {
								    $cotizacionNo=$row1["factura"];
								 } else {
								    $cotizacionNo=$row1["cotizacionNo"];
								 }  
	               echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$cotizacionNo.'">'.$i.'</a></td><td valign="top">'.$row1["marca"].'</td><td valign="top">'.$row1["modelo"].'</td><td valign="top">'.$row1["descripcion"].'</td><td valign="top" align="right">'.$row1["cantidad"].'</td><td valign="top" align="right">'.$row1["precioLista"].'</td>';
	    		       
								 if ($row1['factura']!=0) {
								    $insertSQL = "SELECT * FROM Cotizacion WHERE id=".$row1['factura'];
								 } else {
								    $insertSQL = "SELECT * FROM Cotizacion WHERE id=".$row1['cotizacionNo'];
								 
								 }
      		          $resultNoFactura = mysql_query($insertSQL);
      		       $rowNoFactura = mysql_fetch_array($resultNoFactura);
				   echo "<td>".$row1['NoPedClient']."</td>";
  		           echo '<td valign="top">'.$rowNoFactura["factura"];
								 echo '</td><td valign="top"><a href="../ordendecompras/creandoOrdenDeCompra.php?noOC='.$row1["noDePedido"].'" style="text-decoration: none;">'.$row1["noDePedido"].'</a></td>';
							   if ($row1["Entregado"]=='0000-00-00') 
								    echo '<td valign="top">No</td>';
								 else
								    echo '<td valign="top">'.substr($row1["Entregado"],8,2).'/'.substr($row1["Entregado"],5,2).'/'.substr($row1["Entregado"],0,4).'</td>';
								 $i++;
         }

				 $total+=round($row["cantidad"]*$row["precioLista"]);
    }
	  echo '</table>';



			
		//buscar en herramientas cotizados
	  
	  
	  	  $insertSQL=" SELECT Cotizacionherramientas.id, Cotizacionherramientas.cliente, Cotizacionherramientas.cotizacionRef, Cotizacionherramientas.modelo, Cotizacionherramientas.marca, Cotizacionherramientas.descripcion, Cotizacionherramientas.Proveedor, Cotizacionherramientas.noDePedido, Cotizacionherramientas.factura, Cotizacionherramientas.cotizacionNo, Cotizacionherramientas.cantidad, Cotizacionherramientas.precioLista, Cotizacionherramientas.enviadoFecha, Cotizacionherramientas.recibidoFecha,
		  
cotizacionherramientas.Entregado,  Cotizacion.NoPedClient
FROM cotizacionHerramientas
LEFT JOIN cotizacion ON cotizacionherramientas.cotizacionNo = cotizacion.Id
WHERE (

cotizacionherramientas.marca LIKE  '%".$buscar."%'
OR cotizacionherramientas.modelo LIKE  '%".$buscar."%'
OR cotizacionherramientas.descripcion LIKE  '%".$buscar."%'
OR cotizacionherramientas.noDePedido LIKE  '%".$buscar."%'

)

AND (Cotizacionherramientas.cliente =".$id."
AND Cotizacionherramientas.Pedido =  'no'
)
ORDER BY modelo";
	 
	  
	/*   $insertSQL = "SELECT * FROM cotizacionHerramientas WHERE cliente=".$id." and Pedido='no' ORDER BY modelo";*/
  	 $result = mysql_query($insertSQL);

		echo "<b>Herramientas Cotizados:</b>";
	  echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	     echo '<tr><td width="15"><b>#</b></td><td width="60"><b>Marca</b></td><td width="80"><b>Modelo</b></td><td width="100"><b>Descripción</b></td><td width="5"><b>Cant.</b></td><td width="75"><b>Precio Unidad</b></td><td width="60"><b>Pedido</b></td><td><b>Contacto</b></td><td width="60"><b>Entregado</b></td></tr>';
		$i=1;
		while ($row1 = mysql_fetch_array($result)) {
	    		$insertSQL = "SELECT * FROM Contactos WHERE id=".$row1['cliente'];
      		$res = mysql_query($insertSQL);
      		$r = mysql_fetch_array($res);

		 			$precioConIva=ROUND($row["precioTotal"],2)+ROUND($row["precioTotal"]*$IVA,2);
		 			$precioConIva = ROUND($precioConIva,2);
		 			if (strstr($precioConIva,".")) {
			  		 $len = strlen($precioConIva);
						 if (substr($precioConIva,strlen($precioConIva)-2,1)==".") {
           	 		$precioConIva=$precioConIva."0";
             }
          } else {
			 			 $precioConIva=$precioConIva.".00";
					} 
			 
		 	 		$info=strtoupper($r["nombreEmpresa"].$row1["modelo"].$row1["cotizacionRef"].$row1["marca"].$precioConIva.$row1["descripcion"].$row1["Proveedor"].$row1["noDePedido"]);
		 
		 			if (strstr($info,strtoupper($buscar))) {
	               echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../cotizaciones/agregarCotizacion.php?CotizacionNo='.$row1[cotizacionNo].'&id='.$row["id"].'">'.$i.'</a></td><td valign="top">'.$row1["marca"].'</td><td valign="top">'.$row1["modelo"].'</td><td valign="top">'.$row1["descripcion"].'</td><td valign="top" align="right">'.$row1["cantidad"].'</td><td valign="top" align="right">'.$row1["precioLista"].'</td>';
			           echo '<td valign="top">'.$row1["cotizacionRef"].'</td>';
							 
$sql_contacto="SELECT contacto FROM cotizacion WHERE id= ".$row1['cotizacionNo']."";
$res_contacto=mysql_query($sql_contacto);  
$row_contacto=mysql_fetch_array($res_contacto);
$contacto_hemusa=$row_contacto['contacto'];	
echo "<td>".$contacto_hemusa."</td>";
							   if ($row1["Entregado"]=='0000-00-00') 
								    echo '<td valign="top">No</td>';
								 else
								    echo '<td valign="top">'.substr($row1["Entregado"],8,2).'/'.substr($row1["Entregado"],5,2).'/'.substr($row1["Entregado"],0,4).'</td>';
								 $i++;
         }

				 $total+=round($row["cantidad"]*$row["precioLista"]);
    }
	  echo '</table>';
		
		
		
		
		} 
		
		
		else {
		
		
		
 echo'  <a href="ensenarContacto.php?id='.$id.'&facturado_no_entregado=si"> Facturado No Entregado  </a><br>';
 echo'  <a href="ensenarContacto.php?id='.$id.'&herramientas_sin_entregar=si&marca='.$marca.'"> Herramientas sin entregar  </a><br>';
echo'  <a href="ensenarContacto.php?id='.$id.'&facturas_no_pagadas=si"> Facturas No Pagadas </a><br>';
echo'  <a href="ensenarContacto.php?id='.$id.'&ver_remisiones=si"> Remisiones  </a><br>';
 echo'  <a href="ensenarContacto.php?id='.$id.'&ver_cotizaciones=si"> Cotizaciones  </a><br>';
 echo '<center><a href="ensenarContacto.php?id='.$id.'&verPagos=1">Pagos del cliente</a></center>';
 
 
	if(!empty($_GET['facturado_no_entregado'])){
	 	facturado_no_entregado($id);
 }
		

	if(!empty($_GET['herramientas_sin_entregar'])){
	 	$marca=$_GET['marca'];
herramientas_sin_entregar($id, $marca);

 }


 
	if(!empty($_GET['facturas_no_pagadas'])){
	 	facturas_no_pagadas($id);
 }
			
			if(!empty($_GET['ver_remisiones'])){
	 	remisiones($id);
 }
			if(!empty($_GET['ver_cotizaciones'])){
	 	cotizaciones($id);
 }				 
		


 require_once('../incl/connect.php');
if (isset($verPagos)) {	 
	 
	 		echo "<b>Entregado y Pagado:</b>";
	 		$insertSQL = "SELECT * FROM Cotizacion WHERE fechaEntregado!='0000-00-00' and cliente=".$id." and Pagado>1.14*precioTotal ORDER BY factura DESC";
   		$result = mysql_query($insertSQL);
	 		echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	 		echo '<tr><td width="15">#</td><td width="60">Ref.</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td></tr>';
	 		$i=1;
	 		while ($row = mysql_fetch_array($result)) {
	     			$insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
       			$res = mysql_query($insertSQL);
       			$r = mysql_fetch_array($res);
	     			echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row['id'].'">'.$i.'</a></td><td valign="top">';
			 			if ($row["factura"]!=0) {
			    		 echo $row["factura"];
			      } else {
			    		 echo $row["ref"];
			      }
			 			echo '</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["fecha"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.round(1+(1+$row["IVA"])*$row["precioTotal"],2);
			 			echo '</td></tr>';
			 		
			 			$i++;
      } // fin del while
	 		echo '</table><br><br>';

   		echo '<b><center>Pagos</center></b>';
	 		$result = mysql_query("SELECT * FROM `payments` where client=".$id." ORDER BY factura DESC");
	 		echo '<table summary="" border="1" cellpadding="2" cellspacing="0">';
   		echo '<tr><td>#</td><td>Fecha</td><td>Factura</td><td>Cuenta</td><td>Cantidad</td><td>Eliminar</td></tr>';
	 		$i=1;
   		while ($row = mysql_fetch_array($result)) {
       			echo '<tr><td>'.$i.'</td><td>'.$row['date'].'</td><td>';
		 				if ($row['tipo']!='factura')
		  				 echo "R";
		 					 echo $row['factura'].'</td><td>';
	   					 $insertSQL="SELECT * FROM `accounts` WHERE id=".$row['account'];
		 					 $result1 = mysql_query($insertSQL);
		 					 $row1 = mysql_fetch_array($result1);
		 					 echo $row1['nombre'];
		 					 echo '</td><td align=right>'.$row['amount'].'</td>';
		 					 echo '<td><a href="payments.php?id='.$row['id'].'&delete=si">Eliminar</a></td></tr>';
		 					 $i++;
   					} // fin del while
	    
		echo '</table>';
		} // fin  del if ver pagos
   		
	 
   }

	
	 
  	
} // fin del if si es cliente




function &buscar_contacto($id_contacto){
require_once('../incl/connect.php');
$sql_cliente="SELECT nombreEmpresa FROM contactos WHERE id ='".$id_contacto."' ";

if(!$resultado_contacto= mysql_query($sql_cliente)) die();

   while($row_contacto = mysql_fetch_array($resultado_contacto)){
     
	  $nombre_contacto=$row_contacto['nombreEmpresa'];	
   }

  return $nombre_contacto; 

}


function facturas_no_pagadas($id){
	require_once('../incl/connect.php');
echo "<b>Facturas no Pagadas:</b>";
	 	echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	 	echo '<tr><td width="15">#</td><td>Factura</td><td width="60">Ref.</td><td width="5">Fecha</td><td width="70">Pagado</td><td width="70">Suma</td><td>Mon.</td><td>VenceFact.</td></tr>';
		
		
		  $insertSQL = "SELECT Cotizacion.*, contactos.id as 'IdCliente',
		  contactos.CondPago as diasCredito
		  FROM Cotizacion
		  
		  LEFT JOIN contactos on contactos.id=".$id."
		   WHERE factura!=0 AND Pedido != '0000-00-00' AND `Pagado` < 1.14 * `precioTotal` AND cliente=".$id." ORDER BY facturaFecha DESC";
		 
   	$result = mysql_query($insertSQL);
		
	 	$i=1;
	 	$total=0;
	 while ($row = mysql_fetch_array($result)) {
		
	      echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row['id'].'">';
			
			echo $i;
			$vencefac=date("d-m-Y",strtotime($row["facturaFecha"]."+ ".$row["diasCredito"]." days"));
			  echo '</a></center></td><td>'.$row["factura"].'</td><td valign="top">'.$row["ref"].'</td><td valign="top" align="right">'.$row["facturaFecha"].'</td><td valign="top" align="right">'.$row["Pagado"].'</td><td valign="top" align="right">'.$row["precioTotal"]*(1+$row["IVA"]).'</td><td valign="top" align="right">'.$row["moneda"].'</td>';
			  if(date( "Y-m-d", strtotime( $vencefac ." + 0 days" ) ) < date('Y-m-d')){
				  echo "<td style='color:red'>".$vencefac."</td>";
				  }
				  else{
					    echo "<td>".$vencefac."</td>";
					  }
			 
			  
			 echo' </tr>';
				if ($row["moneda"]=='usd')
			     $total+=($row["precioTotal"]*(1+$row["IVA"])-$row["Pagado"])*11;
				else
			     $total+=$row["precioTotal"]*(1+$row["IVA"])-$row["Pagado"];
			  $i++;
   }
	  echo '</table>';
    echo "Credito: <b>".round($total,2)."</b><br><br>";
	 
	
	}


function remisiones($id){
	
	require_once('../incl/connect.php');
echo '<center><b>Remisiones:</b></center>';
		 $insertSQL = "SELECT * FROM Cotizacion WHERE Comentario='' and remision!=0 and remisionFactura=0 AND cliente=".$id." ORDER BY remision DESC ";
   $result = mysql_query($insertSQL);

	 echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	 echo '<tr><td width="15"><center>#</center></td><td width="60">Remision</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td><td>Mon.</td></tr>';
	 $i=1;$total=0;
	 while ($row = mysql_fetch_array($result)) {
	 $insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
   $res = mysql_query($insertSQL);
   $r = mysql_fetch_array($res);
	    echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../remisiones/agregarHerrRemision.php?deMenu=1&remision='.$row['remision'].'">'.$i.'</a></center></td><td valign="top">'.$row["remision"].'</td><td valign="top">'.$r["nombreEmpresa"].'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["remisionFecha"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.$row["precioTotal"].'</td><td>'.$row["moneda"].'</td></tr>';
			$total+=round($row["precioTotal"]);
			$i++;
   }
	 echo '</table>';
	 echo 'Remision Total: <b>'.round($total,2).'</b>';
	
	}
	
	
	
	function cotizaciones($id){
		require_once('../incl/connect.php');
$insertSQL = "SELECT * FROM Cotizacion WHERE remision=0 and comentario='' and cliente=".$id." ORDER BY fecha DESC";
 $result = mysql_query($insertSQL);
 echo '<br><br><br><b>Cotizaciones</b>';
 echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
 echo '<tr><td width="60">Ref.</td><td width="80">Cliente</td><td width="50">Contacto</td><td width="5">Fecha</td></tr>';
 $i=1;
	 					 while ($row = mysql_fetch_array($result)) {
	 					 $insertSQL = "SELECT * FROM Contactos WHERE id=".$row['cliente'];
   					   $res = mysql_query($insertSQL);
   					   $r = mysql_fetch_array($res);
					   $NOPartidas=$row['partidaCantidad'];
					   $nombre_contacto=&buscar_contacto($row['cliente']);
	    			   echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../cotizaciones/agregarCotizacion.php?deMenu=1&numero='.$row["ref"].'&fecha='.$row["fecha"].'&contacto='.$row['contacto'].'&CotizacionNo='.$row['id'].'&cliente='.$row['cliente'].'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'">'.$row["ref"].'</a></td><td valign="top">'.$nombre_contacto.'</td><td valign="top">'.$row["contacto"].'</td><td valign="top" align="right">'.$row["fecha"].'</td></tr>';
						   
						 
						   $i++;
   				   }
	           echo '</table>';
	 
		
		}

function facturado_no_entregado($id){
	
			require_once('../incl/connect.php');
$insertSQL = "SELECT * FROM Cotizacion WHERE Pedido!='0000-00-00' AND fechaEntregado='0000-00-00' and cliente=".$id."  and factura !='0' ORDER BY factura DESC";
		$result = mysql_query($insertSQL);
	 	echo "<br>";
	 	echo "<b>Facturado Y no Entregado:</b>";
	 	echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';
	 	echo '<tr><td width="15">#</td><td width="60">Ref.</td><td width="5">Fecha</td><td width="70">Cant.</td><td width="70">Suma</td></tr>';
	 	$i=1;
	 	while ($row = mysql_fetch_array($result)) {
		 if ($row["fechaEntregado"]=="0000-00-00") {
	    echo '<tr><td valign="top"><center><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row['id'].'">';
			
			echo $i;
			echo '</a></center></td><td valign="top">'.$row["ref"].'/'.$row["NoPedClient"].'</td><td valign="top" align="right">'.$row["Pedido"].'</td><td valign="top" align="right">'.$row["partidaCantidad"].'</td><td valign="top" align="right">'.$row["precioTotal"].'</td></tr>';
		
			$i++;
		 } // fin del if
    }// fin del while
	  echo '</table>';
	
	
	}

function herramientas_sin_entregar($id, $marca_seleccionada){
	
	require_once('../incl/connect.php');
echo "<br><b>Herramientas que no han sido entregadas:</b><br>";
	echo '<table  border="1" cellpadding="1" cellspacing="1" summary="" frame="border" >';

echo '<tr><td width="15"><b>#</b></td><td width="60"><b>Marca</b></td><td width="80"><b>Modelo</b></td><td width="100"><b>Descripción</b></td><td width="5"><b>Cant.</b></td><td width="75"><b>Precio Unidad</b></td><td width="60"><b>Pedido</b></td><td width="60"><b>Orden</b></td><td width="60"><b>Enviado</b></td><td width="60"><b>Recibido</b></td></tr>';
	
        $sql_marcas="SELECT marca FROM CotizacionHerramientas WHERE  Entregado='0000-00-00' and Pedido='si' and pedidoFecha != '0000-00-00' and cliente=".$id." ";
	
		$result_marcas=mysql_query($sql_marcas);
		$count=0;
		unset($filtro_marca);
		 while ($row_marca = mysql_fetch_array($result_marcas)) {
		$marca= strtoupper($row_marca["marca"]);
		$filtro_marca[$count]=$marca;
		$count++;
		  }
		$filtro_marca= array_values(array_unique($filtro_marca));	
	    
		sort($filtro_marca);
		foreach($filtro_marca as $element){
			
			echo'  <a href="ensenarContacto.php?id='.$id.'&herramientas_sin_entregar=si&marca='.$element.'"> '.$element.'  </a><br>';
			}
			echo'  <a href="ensenarContacto.php?id='.$id.'&herramientas_sin_entregar=si&marca=TODO"> TODO  </a><br>';
			
	if($marca_seleccionada=='TODO'){
		$sql_pedidos = "SELECT * FROM CotizacionHerramientas WHERE  Entregado='0000-00-00' and Pedido='si' and pedidoFecha!= '0000-00-00' and cliente='".$id."'";
	}
		else{
				$sql_pedidos = "SELECT * FROM CotizacionHerramientas WHERE  Entregado='0000-00-00' and Pedido='si' and pedidoFecha!= '0000-00-00' and marca='".$marca_seleccionada."' and cliente='".$id."'";
			}
		
	
	
	
	if(!empty($marca_seleccionada)){
		
 $result_pedidos= mysql_query($sql_pedidos);
 $i=1;
 while ($row1 = mysql_fetch_array($result_pedidos)) {


$sql_cotizacion= "SELECT NoPedClient from cotizacion where id=".$row1["cotizacionNo"]." ";
$result_cot= mysql_query($sql_cotizacion);
$row= mysql_fetch_array($result_cot);


echo '<tr><td valign="top"><a  style="text-decoration: none;" href="../pedidos/verPedido.php?CotizacionNo='.$row1["cotizacionNo"].'&id='.$row1["cotizacionNo"].'">'.$i.'</a></td><td valign="top">'.$row1["marca"].'</td><td valign="top">'.$row1["modelo"].'</td><td valign="top">'.$row1["descripcion"].'</td><td valign="top" align="right">'.$row1["cantidad"].'</td><td valign="top" align="right">'.$row1["precioLista"].'</td>';
 if ($row1["noDePedido"]=='' and  $row1["Proveedor"]=='ALMACEN') 
 {
	echo '<td valign="top">'.$row["NoPedClient"].'</td><td valign="top">'.$row1["Proveedor"].'</td>';								 }
elseif ($row1["noDePedido"]=='' and  $row1["Proveedor"]!='') {

echo '<td valign="top">'.$row["NoPedClient"].'</td><td valign="top" style="color: ORANGE">SIN PED.</td>';		
}


elseif ($row1["noDePedido"]=='') {
 echo '<td valign="top">'.$row["NoPedClient"].'</td><td valign="top" style="color: RED">SIN PROV.</td>';								 }
 else{				
 
 	 
echo '<td valign="top">'.$row["NoPedClient"].'</td><td valign="top"><a href="../ordendecompras/creandoOrdenDeCompra.php?noOC='.$row1["noDePedido"].'" style="text-decoration: none;">'.$row1["noDePedido"].'</a></td>';
 }
								
							   if ($row1["enviadoFecha"]=='0000-00-00') {
								    echo '<td valign="top">No</td>';
							   }
								 else{
								    echo '<td valign="top">'.substr($row1["enviadoFecha"],8,2).'/'.substr($row1["enviadoFecha"],5,2).'/'.substr($row1["enviadoFecha"],0,4).'</td>';
								 }
							   if ($row1["recibidoFecha"]=='0000-00-00') {
								    echo '<td valign="top">No</td></tr>';
							   }
			 else{
			  echo '<td valign="top">'.substr($row1["recibidoFecha"],8,2).'/'.substr($row1["recibidoFecha"],5,2).'/'.substr($row1["recibidoFecha"],0,4).'</td></tr>';
			 }
				
		 
	  $i++;
	 }
		} 
	}
	



function ActualizaTablaCotizacion($IdCotHerramientas){
	 //si Accion es true, se añade el recibido
	 //si accion es false se quita el recibido.
	 $sqlInfo="SELECT cotizacionNo, factura FROM cotizacionherramientas 
	 WHERE id=".$IdCotHerramientas;
	$resultInfo= mysql_query($sqlInfo);
 	$Row= mysql_fetch_array($resultInfo);
    if ($Row['factura']=='0'){
    	$IdTablaCotizacion=$Row['cotizacionNo'];
	}
	else{
		$IdTablaCotizacion=$Row['factura'];
		
		}
    //una ves que obtenemos el pedido al que pertenece la partida,
	//hacemos una consulta de todas las partidas de ese pedido, si todas tienen
	// recibido la columna REcibido de la tabla cotizacion es 1 , caso contrario es 0
  $sqlInfo=" SELECT recibidoFecha  FROM `cotizacionherramientas`  WHERE (`factura` =".$IdTablaCotizacion." OR `cotizacionNo` =".$IdTablaCotizacion." AND factura =0)
 and recibidoFecha='0000-00-00'
  ";
 $resultado = mysql_query($sqlInfo);
  if(mysql_num_rows($resultado)>0){ // si almenos un registro del pedido tiene recibido '0'
  // el pedido de la tala cotizacion en la columna recibido debe ser 0
	  
	 $sqlActualiza="UPDATE cotizacion SET Recibido=b'0' WHERE id=".$IdTablaCotizacion;
	  mysql_query($sqlActualiza);
	  }
 else{ // caso contrario pedido columna recibido es 1
	 
	  $sqlActualiza="UPDATE cotizacion SET Recibido=b'1'  WHERE id=".$IdTablaCotizacion;
	  mysql_query($sqlActualiza);
	 }
	 
	 
	
	
	}
	
	
	
	
	
	
	
			function splitUtilidadPedido($idCotherr, $idInsertar, $cantidad){
					
	 
			$sqlQeury="SELECT * FROM utilidad_pedido where 
			id_cotizacion_herramientas=".$idCotherr."";
			$resultQ=mysql_query($sqlQeury);
			
			if(mysql_num_rows($resultQ)>0){
			while ($rowQ= mysql_fetch_array($resultQ)) {
			$id_cotizacion_herramientas=$idInsertar;	
			$orden_compra=$rowQ['orden_compra'];
			$fecha=$rowQ['fecha_orden_compra'];
			$numero_proveedor=$rowQ['proveedor'];
			$moneda_producto=$rowQ['moneda_pedido'];
			$numero_cliente=$rowQ['cliente'];
			$marca=$rowQ['marca'];
			$modelo=$rowQ['modelo'];

			$cantidad=$cantidad;
			$descripcion=$rowQ['descripcion'];		
			$tipo_cambio=$rowQ['tipo_cambio'];
			$costo_mn=$rowQ['costo_mn'];	
			$costo_usd=$rowQ['costo_usd'];
			$venta_mn=$rowQ['venta_mn'];	
			$venta_usd=$rowQ['venta_usd'];
			$folio=$rowQ['folio'];
			$pedimento=$rowQ['Pedimento'];
			$factura_proveedor=$rowQ['factura_proveedor'];
					
				$query_agregar_pedido= "INSERT INTO utilidad_pedido 
					(id, id_cotizacion_herramientas,
					 orden_compra,
					 fecha_orden_compra,
					 proveedor,
					 moneda_pedido,
					 cliente, marca,modelo, cantidad,descripcion, tipo_cambio,
					 costo_mn, costo_usd, venta_mn, venta_usd, folio, 
					 Pedimento, factura_proveedor)
					values 
					('','$id_cotizacion_herramientas',
					 '$orden_compra','$fecha', '$numero_proveedor', '$moneda_producto', '$numero_cliente',  '$marca',  '$modelo', '$cantidad','$descripcion',  '$tipo_cambio',  '$costo_mn',  '$costo_usd','$venta_mn','$venta_usd', '$folio', '$pedimento','$factura_proveedor')";

if(!$resultadoU = mysql_query( $query_agregar_pedido)) {
	echo"<script>alert('Error al  agregar en utilidad_pedido ')</script>";	
	
	}
	
			
			}}
			
		
			
			
			}
	
	
	
	
	
	
	

 ?> 


</center></td></tr>
</table>


</body>
