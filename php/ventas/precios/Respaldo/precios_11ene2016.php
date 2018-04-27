<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
$palabraBusca = $_REQUEST["palabraBusca"];
$refBusca = $_REQUEST["refBusca"];
$marca1 = $_REQUEST["marca1"];
$buscar = $_REQUEST["buscar"];
$delete = $_REQUEST["delete"];
$id = $_REQUEST["id"];
$ref = $_REQUEST["ref"];
$refold = $_REQUEST["refold"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];

if (isset($enReserva)) {
   $refBusca=$refold;
	 $marca1=$productor;
	 $buscar='Buscar';
}

include "../incl/connect.incl";

$insertSQL = "SELECT IVA FROM `cifrasimportantes`";
$result = mysql_query($insertSQL);
$row = mysql_fetch_array($result);
$IVA = $row['IVA'];

    if ($ref!='') {
      $insertSQL = "update Precio".$productor." set ref='$ref' where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($descripcion!='') {
      $insertSQL = "update Precio".$productor." set descripcion='$descripcion' where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($precioBase!='') {
      $insertSQL = "update Precio".$productor." set precioBase=$precioBase where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($enReserva!='') {
      $insertSQL = "update Precio".$productor." set enReserva=$enReserva where id='".$id."'";
			mysql_query($insertSQL);
    }
    if ($productor!='') {
      $insertSQL = "update Precio".$productor." set productor='$productor' where id='".$id."'";
      mysql_query($insertSQL);
    }
  if (isset($delete))
  {
    $insertSQL = "delete from Precio".$productor." where id=$id";
    mysql_query($insertSQL);
  }  


 ?> 
<html>
<head>
<title>Listas de precios</title>
<link rel="stylesheet" type="text/css" href="print.css" />
</head>
<body onLoad="self.focus();document.total.palabraBusca.focus()">
<center><h1><b>HERRAMIENTAS MECANICAS UNIVERSALES S.A. de C.V.</b></h1>
<br />
<?php
	$fecha= date('d-m-Y'); 
		echo "<center><h3>FECHA: ", $fecha , "</h3></center><br>";

?>

<br />

<h2><b><a href="adm/Marcas_de_herramientas_opciones.php">Agregar Marca</a>
<br><b><a href="adm/Editar_marca.php">Editar Marca </a></b>
<p></p>
<table border="1" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC" frame="border" summary="">
<tr valign="top"><td height="10"><div align="center">
<a href="ensenarPrecios.php?productor=Allen&widthModelo=77&widthDescripcion=165&widthPrecioLista=45&widthPrecioIva=45">Allen</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=American&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">American</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Ampco&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">Ampco</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Apex&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">Apex</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Armstrong&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">Armstrong</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=ATD&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">ATD</a><br/><p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Balta&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Balta</a><br />
<p></p></div></td><td><div align="center"><a href="ensenarPrecios.php?productor=BlackandDecker&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Blackand Decker</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Bostitch&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Bostitch</a><br /><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Campbell&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Campbell</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Carolus&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Carolus</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Central&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Central</a><br/><p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Collins&widthModelo=60&widthDescripcion=180&widthPrecioLista=65&widthPrecioIva=65">Collins</a><br />
<p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Columbia&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Columbia</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Cougar&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Cougar</a><br />
<p></p></div></td><td><div align="center">
<a href="ensenarPrecios.php?productor=CP&widthModelo=65&widthDescripcion=175&widthPrecioLista=45&widthPrecioIva=45">CP</a><br />
<p></p></div></td><td>
<a href="ensenarPrecios.php?productor=Craftsman&widthModelo=65&widthDescripcion=175&widthPrecioLista=45&widthPrecioIva=45">Craftsman</a><br />
<p></p></td><td><div align="center">
<a href="ensenarPrecios.php?productor=Crescent&widthModelo=55&widthDescripcion=185&widthPrecioLista=43&widthPrecioIva=43">Crescent</a><br />
<p></p></div></td><td><div align="center">
<a href="ensenarPrecios.php?productor=Dewalt&widthModelo=55&widthDescripcion=185&widthPrecioLista=43&widthPrecioIva=43">Dewalt</a><br />
<p></p></div></td><td><div align="center">
<a href="ensenarPrecios.php?productor=Diamond&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Diamond</a><br />
<p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Disston&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Disston</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Dogotuls&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Dogo Tuls</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Eklind&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Eklind</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Fluke&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Fluke</a><br/><p></p></div></td>
</tr>
<tr valign="top">
  <td height="10"><div align="center"><a href="ensenarPrecios.php?productor=Foy&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Foy</a><br/><p></p></div></td>
 <td><div align="center"><a href="ensenarPrecios.php?productor=Gearwrench&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">GearWrench</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Gedore&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Gedore</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=HKPorter&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">HK Porter</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=IR&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">IR</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Irimo&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Irimo</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Jacobs&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Jacobs</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=KD&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">KD</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=KDAD&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">KDAD</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Keenovens&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Keen Ovens</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Knipex&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Knipex</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Lisle&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Lisle</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Lock&widthModelo=70&widthDescripcion=225&widthPrecioLista=65&widthPrecioIva=65">Lock</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Lucky&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Lucky</a><br/><p></p></div></td>
 <td><div align="center"><a href="ensenarPrecios.php?productor=Lufkin&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Lufkin</a><br/><p></p></div></td>
 <td><div align="center"><a href="ensenarPrecios.php?productor=Maglite&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Maglite</a><br /><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Metromex&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Metromex</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Mikels&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Mikels</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Milbar&widthModelo=70&widthDescripcion=170&widthPrecioLista=45&widthPrecioIva=45">Milbar</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Milton&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Milton</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Milwaukee&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Milwaukee</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Muela&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Muela</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Nicholson&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Nicholson</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Nova&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Nova</a><br/><p></p></div></td>
</tr>
<tr valign="top">
  <td height="10"><div align="center"><a href="ensenarPrecios.php?productor=OTC&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">OTC</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Ochsenkopf&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Ochsenkopf</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Plews&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Plews</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Plumb&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Plumb</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Proforza&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Proforza</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Prolok&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Prolok</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Pronosa&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Pronosa</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Proto&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Proto</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Seekonk&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Seekonk</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=SG&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">SG</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Snapon&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Snapon</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Stanley&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Stanley</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Sunpro&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Sunpro</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Surtek&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Surtek</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Truper&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Truper</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Urrea&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Urrea</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Vim&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Vim</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Visegrip&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Vise Grip</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Weller&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Weller</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Wenger&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Wenger</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Williams&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Williams</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Wiss&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Wiss</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Wright&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Wright</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Xcelite&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Xcelite</a><br/><p></p></div></td>
</table>
<a href="../hemusa.php">Atras</a>
</center>
<center>
<form action="adm/agregarPrecio.php" method="post">
<input type="submit" name="add" value="Agregar Herr.">
</form>
<a href="../hemusa.php" style="text-decoration: none;">Back to Menu</a>
</center>
<p>
<center>




<?php  
echo "<form action='precios.php' method='post' name='total'>"; 
echo '<p></p><table summary="" >';
echo '<tr><td>Busca Clave</td><td>Busca Frase</td><td>Marca</td></tr>';
echo '<tr><td><input type="text" name="refBusca" value=""></td>';
echo '<td><input type="text" name="palabraBusca" value=""></td><td>';
$result = mysql_query("SELECT * FROM marcadeherramientas ORDER BY marca");
echo '<select name="marca1" class="small">';
while ($row = mysql_fetch_array($result)) {
	if ($row['category']==$cat || $cat=='') {
		echo '<option value="'.$row['marca'].'" selected="selected">'.$row['marca'].'</option>';
	}
}
echo '<option value="todo" selected="selected">Todo</option>';
echo '</select>';
echo '<input type="submit" name="buscar" value="Buscar"></td></tr>';
echo '</table>';
echo '<br />';
$marcas = mysql_query("SELECT * FROM MarcaDeHerramientas ORDER BY marca");
if(isset($buscar) and $imprimir!=1)
{
  $marcaBuscar="";   
  if(isset($marca1)) {
    if ($marca1!='todo') {
		  $marcaBuscar=$marcaBuscar.$marca1;
  		  $marcaBuscar= trim($marcaBuscar);

		}
  }
  $Allen = $_REQUEST["Allen"];
  if(isset($Allen)) {
    $marcaBuscar=$marcaBuscar.$Allen;
 }
  $American = $_REQUEST["American"];
  if(isset($American)) {
    $marcaBuscar=$marcaBuscar.$American;
  }
  $Ampco = $_REQUEST["Ampco"];
  if(isset($Ampco)) {
    $marcaBuscar=$marcaBuscar.$Ampco;
  }
  $Apex = $_REQUEST["Apex"];
  if(isset($Apex)) {
    $marcaBuscar=$marcaBuscar.$Apex;
}
  $Armstrong = $_REQUEST["Armstrong"];
  if(isset($Armstrong)) {
    $marcaBuscar=$marcaBuscar.$Armstrong;
  }
  $Associated = $_REQUEST["Associated"];
  if(isset($Associated)) {
    $marcaBuscar=$marcaBuscar.$Associated;
  }
  $ATD= $_REQUEST["ATD"];
  if(isset($ATD)) {
    $marcaBuscar=$marcaBuscar.$ATD;
  }
  $Balta = $_REQUEST["Balta"];
  if(isset($Balta)) {
    $marcaBuscar=$marcaBuscar.$Balta;
  }
 $Belknap = $_REQUEST["Belknap"];
  if(isset($Belknap)) {
    $marcaBuscar=$marcaBuscar.$Belknap;
	}
  $Blackanddecker = $_REQUEST["Blackanddecker"];
  if(isset($Blackanddecker)) {
    $marcaBuscar=$marcaBuscar.$Blackanddecker;
  }
 
 $Bostitch = $_REQUEST["Bostitch"];
  if(isset($Bostitch)) {
    $marcaBuscar=$marcaBuscar.$Bostitch;
	}
  $Campbell = $_REQUEST["Campbell"];
  if(isset($Campbell)) {
    $marcaBuscar=$marcaBuscar.$Campbell;
}
  $Carolus = $_REQUEST["Carolus"];
  if(isset($Carolus)) {
    $marcaBuscar=$marcaBuscar.$Carolus;
 }
  $Central = $_REQUEST["Central"];
  if(isset($Central)) {
    $marcaBuscar=$marcaBuscar.$Central;
  }
  $Clark = $_REQUEST["Clark"];
  if(isset($Clark)) {
    $marcaBuscar=$marcaBuscar.$Clark;
  }
  $Collins = $_REQUEST["Collins"];
  if(isset($Collins)) {
    $marcaBuscar=$marcaBuscar.$Collins;
 }
  $Columbia = $_REQUEST["Columbia"];
  if(isset($Columbia)) {
    $marcaBuscar=$marcaBuscar.$Columbia;
  }
  $Cougar = $_REQUEST["Cougar"];
  if(isset($Cougar)) {
    $marcaBuscar=$marcaBuscar.$Cougar;
  }
  $CP= $_REQUEST["CP"];
  if(isset($CP)) {
    $marcaBuscar=$marcaBuscar.$CP;
  }
  $Craftsman = $_REQUEST["Craftsman"];
  if(isset($Craftsman)) {
    $marcaBuscar=$marcaBuscar.$Craftsman;
  }
  $Crescent = $_REQUEST["Crescent"];
  if(isset($Crescent)) {
    $marcaBuscar=$marcaBuscar.$Crescent;
  }
  $Dewalt = $_REQUEST["Dewalt"];
  if(isset($Dewalt)) {
    $marcaBuscar=$marcaBuscar.$Dewalt;
  }
  $Diamond = $_REQUEST["Diamond"];
  if(isset($Diamond)) {
    $marcaBuscar=$marcaBuscar.$Diamond;
  }
$Dogotuls = $_REQUEST["Dogotuls"];
  if(isset($Dogotuls)) {
    $marcaBuscar=$marcaBuscar.$Dogotuls;
  }
  $Disston = $_REQUEST["Disston"];
  if(isset($Disston)) {
    $marcaBuscar=$marcaBuscar.$Disston;
  }
  $Eklind = $_REQUEST["Eklind"];
  if(isset($Eklind)) {
    $marcaBuscar=$marcaBuscar.$Eklind;
 }
$Foy = $_REQUEST["Foy"];
  if(isset($Foy)) {
    $marcaBuscar=$marcaBuscar.$Foy;
}
$Fluke = $_REQUEST["Fluke"];
  if(isset($Fluke)) {
    $marcaBuscar=$marcaBuscar.$Fluke;
}
  $Gedore = $_REQUEST["Gedore"];
  if(isset($Gedore)) {
    $marcaBuscar=$marcaBuscar.$Gedore;
  }
  $GrearWrench = $_REQUEST["GrearWrench"];
  if(isset($GrearWrench)) {
    $marcaBuscar=$marcaBuscar.$GrearWrench;
  }
  $Hkporter = $_REQUEST["Hkporter"];
  if(isset($Hkporter)) {
    $marcaBuscar=$marcaBuscar.$Hkporter;
  }
  $IR = $_REQUEST["IR"];
  if(isset($IR)) {
    $marcaBuscar=$marcaBuscar.$IR;
 }
  $Irimo = $_REQUEST["Irimo"];
  if(isset($Irimo)) {
    $marcaBuscar=$marcaBuscar.$Irimo;
}
  $Jacobs = $_REQUEST["Jacobs"];
  if(isset($Jacobs)) {
    $marcaBuscar=$marcaBuscar.$Jacobs;
  }
  $KD = $_REQUEST["KD"];
  if(isset($KD)) {
    $marcaBuscar=$marcaBuscar.$KD;
  }
  $KDAD = $_REQUEST["KDAD"];
  if(isset($KDAD)) {
    $marcaBuscar=$marcaBuscar.$KDAD;
  }
  $Klein = $_REQUEST["Klein"];
  if(isset($Klein)) {
    $marcaBuscar=$marcaBuscar.$Klein;
  }
$KeenOvens = $_REQUEST["KeenOvens"];
  if(isset($KeenOvens)) {
    $marcaBuscar=$marcaBuscar.$KeenOvens;
  }
  $Knipex= $_REQUEST["Knipex"];
  if(isset($Knipex)) {
    $marcaBuscar=$marcaBuscar.$Knipex;
  }
  $Lisle = $_REQUEST["Lisle"];
  if(isset($Lisle)) {
    $marcaBuscar=$marcaBuscar.$Lisle;
}
  $Lock = $_REQUEST["Lock"];
  if(isset($Lock)) {
    $marcaBuscar=$marcaBuscar.$Lock;
  }
  $Lucky = $_REQUEST["Lucky"];
  if(isset($Lucky)) {
    $marcaBuscar=$marcaBuscar.$Lucky;
  }
  $Lufkin = $_REQUEST["Lufkin"];
  if(isset($Lufkin)) {
    $marcaBuscar=$marcaBuscar.$Lufkin;
  }
  $Maglite = $_REQUEST["Maglite"];
  if(isset($Maglite)) {
    $marcaBuscar=$marcaBuscar.$Maglite;
 }
  $Metromex = $_REQUEST["Metromex"];
  if(isset($Metromex)) {
    $marcaBuscar=$marcaBuscar.$Metromex;
 }
  $Mikels = $_REQUEST["Mikels"];
  if(isset($Mikels)) {
    $marcaBuscar=$marcaBuscar.$Mikels;
}
  $Milbar = $_REQUEST["Milbar"];
  if(isset($Milbar)) {
    $marcaBuscar=$marcaBuscar.$Milbar;
}
  $Milton = $_REQUEST["Milton"];
  if(isset($Milton)) {
    $marcaBuscar=$marcaBuscar.$Milton;
 }
  $Milwaukee = $_REQUEST["Milwaukee"];
  if(isset($Milwaukee)) {
    $marcaBuscar=$marcaBuscar.$Milwaukee;
 }
  $Muela = $_REQUEST["Muela"];
  if(isset($Muela)) {
    $marcaBuscar=$marcaBuscar.$Muela;
}
  $Nicholson = $_REQUEST["Nicholson"];
  if(isset($Nicholson)) {
    $marcaBuscar=$marcaBuscar.$Nicholson;
}
  $Nova = $_REQUEST["Nova"];
  if(isset($Nova)) {
    $marcaBuscar=$marcaBuscar.$Nova;
 }
  $OTC = $_REQUEST["OTC"];
  if(isset($OTC)) {
    $marcaBuscar=$marcaBuscar.$OTC;
  }
$Ochsenkopf = $_REQUEST["Ochsenkopf"];
  if(isset($Ochsenkopf)) {
    $marcaBuscar=$marcaBuscar.$Ochsenkopf;
}
  $Plews = $_REQUEST["Plews"];
  if(isset($Plews)) {
    $marcaBuscar=$marcaBuscar.$Plews;
 }
  $Plumb= $_REQUEST["Plumb"];
  if(isset($Plumb)) {
    $marcaBuscar=$marcaBuscar.$Plumb;
}
  $Proforza= $_REQUEST["Proforza"];
  if(isset($Proforza)) {
    $marcaBuscar=$marcaBuscar.$Proforza;
}
  $Prolok= $_REQUEST["Prolok"];
  if(isset($Prolok)) {
    $marcaBuscar=$marcaBuscar.$Prolok;
}
 $Pronosa= $_REQUEST["Pronosa"];
  if(isset($Pronosa)) {
    $marcaBuscar=$marcaBuscar.$Pronosa;
}
  $Proto= $_REQUEST["Proto"];
  if(isset($Proto)) {
    $marcaBuscar=$marcaBuscar.$Proto;
}
  $Seekonk= $_REQUEST["Seekonk"];
  if(isset($Seekonk)) {
    $marcaBuscar=$marcaBuscar.$Seekonk;
}
  $SG= $_REQUEST["SG"];
  if(isset($SG)) {
    $marcaBuscar=$marcaBuscar.$SG;
}
  $Snapon= $_REQUEST["Snapon"];
  if(isset($Snapon)) {
    $marcaBuscar=$marcaBuscar.$Snapon;
}
  $Stanley= $_REQUEST["Stanley"];
  if(isset($Stanley)) {
    $marcaBuscar=$marcaBuscar.$Stanley;
}
  $Sunpro= $_REQUEST["Sunpro"];
  if(isset($Sunpro)) {
    $marcaBuscar=$marcaBuscar.$Sunpro;
}
  $Surtek= $_REQUEST["Surtek"];
  if(isset($Surtek)) {
    $marcaBuscar=$marcaBuscar.$Surtek;
}
  $Truper= $_REQUEST["Truper"];
  if(isset($Truper)) {
    $marcaBuscar=$marcaBuscar.$Truper;
}
  $Tulmex= $_REQUEST["Tulmex"];
  if(isset($Tulmex)) {
    $marcaBuscar=$marcaBuscar.$Tulmex;
}
  $Urrea= $_REQUEST["Urrea"];
  if(isset($Urrea)) {
    $marcaBuscar=$marcaBuscar.$Urrea;
}
  $Victorinox= $_REQUEST["Victorinox"];
  if(isset($Victorinox)) {
    $marcaBuscar=$marcaBuscar.$Victorinox;
}
  $Vim= $_REQUEST["Vim"];
  if(isset($Vim)) {
    $marcaBuscar=$marcaBuscar.$Vim;
}
  $ViseGrip= $_REQUEST["ViseGrip"];
  if(isset($ViseGrip)) {
    $marcaBuscar=$marcaBuscar.$ViseGrip;
}
  $Weller= $_REQUEST["Weller"];
  if(isset($Weller)) {
    $marcaBuscar=$marcaBuscar.$Weller;
}
  $Wenger= $_REQUEST["Wenger"];
  if(isset($Wenger)) {
    $marcaBuscar=$marcaBuscar.$Wenger;
}
  $Wera= $_REQUEST["Wera"];
  if(isset($Wera)) {
    $marcaBuscar=$marcaBuscar.$Wera;
}
  $Williams= $_REQUEST["Williams"];
  if(isset($Williams)) {
    $marcaBuscar=$marcaBuscar.$Williams;
}
  $Wiss= $_REQUEST["Wiss"];
  if(isset($Wiss)) {
    $marcaBuscar=$marcaBuscar.$Wiss;
}
  $Wright= $_REQUEST["Wright"];
  if(isset($Wright)) {
    $marcaBuscar=$marcaBuscar.$Wright;
}
  $Xcelite= $_REQUEST["Xcelite"];
  if(isset($Xcelite)) {
    $marcaBuscar=$marcaBuscar.$Xcelite;
  }
 if($marcaBuscar=='') {
	  
	 //Codigo para realizar la busqueda dinamica de los producutos en todas las tablas.#Con soporte para nuevas tablas y nuevos precios by .'.LCG.'.
	  
	  include "../incl/connect.incl";
$select_marcas = "SELECT * FROM marcadeherramientas";//realiza la consulta ala base de datos
$resultados_m = mysql_query($select_marcas) or die("Error en: $busqueda: " . mysql_error());

$row_marcas = mysql_fetch_array($resultados_m);


do{
	
		$cadena[]=$row_marcas['marca'];//devuelve los datos de la consulta y los almacena en un array
	
	
} while ($row_marcas = mysql_fetch_array($resultados_m));   
 
 $marcaBuscar= implode($cadena);
  }

	echo '<center>El resultado de la búsqueda: '.$palabraBusca.'</center><p></p>';
	$res = mysql_query("SELECT * FROM MarcaDeHerramientas ORDER BY marca");
	echo '<table border="0" cellpadding="3" cellspacing="0" summary="" frame="border" width="85%">';
	echo '<tr valign="bottom"><td><b>Marca</b><br><img src="Line.jpg" width="50" height="2" /><td><b>Modelo</b><br><img src="Line.jpg" width="" height="2" /></td><td><b>Descripción<br><img src="Line.jpg" width="200" height="2" /></b></td><td><b>Precio de lista</b><br><img src="Line.jpg" width="70" height="2" /></td><td ><b>Precio con IVA</b><br><img src="Line.jpg" width="70" height="2" /></td><td ><b>Almacen</b><br><img src="Line.jpg" width="45" height="2" /></td><td><b>Moneda</b><br><img src="Line.jpg" width="45" height="2" /></td><td><b>Clase</b><br><img src="Line.jpg" width="40" height="2" /></td></tr>';
if ($refBusca!='') {
   $insertSQL1="SELECT factor,moneda FROM MarcaDeHerramientas WHERE marca='".$marcaBuscar."'";
   $result1 = mysql_query($insertSQL1);
   $r = mysql_fetch_array($result1);
   $insertSQL="SELECT * FROM Precio".$marcaBuscar." WHERE ref='".$refBusca."'";
   $result = mysql_query($insertSQL);
   $row = mysql_fetch_array($result);
   if ($row['category']==$cat || $cat=='') {
		$precioBase=round($row['precioBase']*$r['factor']/10000,8);
		if (strlen($precioBase)<7) {
			$precioUnidad=round($row['precioBase']*$r['factor'],2).".00";
		} elseif (strlen($precioBase)==7) {
		    $precioUnidad=round($row['precioBase']*$r['factor'],2)."0";
		} else {
		    $precioUnidad=round($row['precioBase']*$r['factor'],2);
	    }
						
		echo "<tr valign='top' height='10' ><td>".$marcaBuscar."</td><td><b>";
		$descripcion=str_replace( "#","no.", $row["descripcion"]);
		$descripcion=str_replace( "\r\n","<br>", $descripcion);
		echo "<a href='adm/editarPrecio.php?productor=".$marcaBuscar."&id=".$row["id"]."' style='text-decoration: none;'>".$row['ref']."</a></b></td><td>".$descripcion." - ".$row['pagina']."</td><td align='left'>";
		echo $precioUnidad;
			echo "</td><td align='left'><b>".round(($row['precioBase']*$r['factor'])*(1+$IVA)).".00</b></td><td align='left'>".$row['enReserva']."</td><td align='left' style='color: '#070707'>".$r['moneda']."</td>";
		
		
		//COdigo para diferenciar por colores las clases de productos en la consulta
		
		$color=$row['clase'];
		//echo $color;
		if($color=="E"){
             echo "<td align='left'>";
		     echo "<font color='#0066FF'>".$row['clase']."</font>";
		     echo "</td>";
		}
		elseif($color=="D"){
			echo "<td align='left'>";
		     echo "<font color='#FF3333'>".$row['clase']."</font>";
		     echo "</td>";
		}
			 elseif($color!="D"&&"E"){
				 
			 echo "<td align='left' style='color: '#070707'>".$row['clase']."</td>";
		
		}
		
		
		
		echo "</tr>";
   }
} else {
	//echo $palabraBusca;
	$strlen=strlen($palabraBusca);
	//echo $strlen;
	//adskille de enkelte ord
	$pos=0;
	$wordno=1;
	while ($pos<$strlen) {
		if ($wordno==1) {
			if (substr($palabraBusca,$pos,1)==' ') {
				$wordno+=1;
			} else {
				$word1=$word1.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==2) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word2=='') {}
				else
				  $wordno+=1;
			} else {
				$word2=$word2.substr($palabraBusca,$pos,1);
			}	
		}
		if ($wordno==3) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word3=='') {}
				else
				  $wordno+=1;
			} else {
				$word3=$word3.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==4) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word4=='') {}
				else
				  $wordno+=1;
			} else {
				$word4=$word4.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==5) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word5==''){}
				else
				  $wordno+=1;
			} else {
				$word5=$word5.substr($palabraBusca,$pos,1);
			}
		}
		$pos+=1;
	}
	if ($word1=='')
		 $word1=' ';
	else
		 $word1=strtolower($word1);
	if ($word2=='')
		 $word2=' ';
	else
	   $word2=strtolower($word2);
	if ($word3=='')
		 $word3=' ';
	else
	$word3=strtolower($word3);
	if ($word4=='')
		 $word4=' ';
	else
	$word4=strtolower($word4);
	if ($word5=='')
		 $word5=' ';
	else
	$word5=strtolower($word5);
    while ($r = mysql_fetch_array($res)) {
		$marca = $r['marca'];
		if (strstr($marcaBuscar,$marca)) {
			$result = mysql_query("SELECT * FROM Precio".$r['marca']." ORDER BY ref");
			while ($row = mysql_fetch_array($result)) {
				$test=strtolower($row['ref']).strtolower($row['descripcion']);
				$find=strtolower($palabraBusca);
				$i=0;
 				if (strstr($test,$word1) and (strstr($test,$word2) or $word2==' ') and (strstr($test,$word3) or $word3==' ') and (strstr($test,$word4) or $word4==' ') and (strstr($test,$word5) or $word5==' ')) {
					$precioBase=round($row['precioBase']*$r['factor']/10000,8);
					if (strlen($precioBase)<7) {
						$precioUnidad=round($row['precioBase']*$r['factor'],2).".00";
					} elseif (strlen($precioBase)==7) {
						$precioUnidad=round($row['precioBase']*$r['factor'],2)."0";
					} else {
						$precioUnidad=round($row['precioBase']*$r['factor'],2);
					}
					//Codigo para mostra la lista de precio de acuerdo ala clase de cada uno de lso productos By .'.LCG.'. 16/10/2015-12:01 pm
	$color=$row['clase'];
					
					
					switch ($color) {
    case "A":
        echo "<tr valign='top' height='10' ><td>".$marca."</td><td><b>";
					$descripcion=str_replace( "#","no.", $row["descripcion"]);
					$descripcion=str_replace( "\r\n","<br>", $descripcion); 					
					echo "<a href='adm/editarPrecio.php?productor=".$marca."&id=".$row["id"]."' style='text-decoration: none;'>".$row['ref']."</a></b></td><td>".$descripcion." - ".$row['pagina']."</td><td align='left'>";
					echo $precioUnidad;
  					echo "</td><td align='left'><b>".number_format(($row['precioBase']*$r['factor'])*(1+$IVA),2)."</b></td><td align='left'>".$row['enReserva']."</td><td align='left' style='color: '#FF3333'>".$r['moneda']."</td>";
					
					
				echo "	<td align=right style='color: '#070707' style='font-weight: bold'>".$row['clase']."</td>";
     break;
	case "D":
       echo "<tr valign='top' height='10' ><td><font color='#FF3333'>".$marca."</font></td><td><b>";
					$descripcion=str_replace( "#","no.", $row["descripcion"]);
					$descripcion=str_replace( "\r\n","<br>", $descripcion); 					
					echo "<a href='adm/editarPrecio.php?productor=".$marca."&id=".$row["id"]."' style='text-decoration: none;'><font color='#FF3333'>".$row['ref']."</a></b></font></td><td><font color='#FF3333'>".$descripcion." - ".$row['pagina']."</font></td><td align='left'><font color='#FF3333'>";
					echo $precioUnidad;
  					echo "</font></td><td align='left'><font color='#FF3333'><b>".number_format(($row['precioBase']*$r['factor'])*(1+$IVA),2)."</b></font></td><td align='left'><font color='#FF3333'>".$row['enReserva']."</font></td><td align='left' style='color: '#FF3333'><font color='#FF3333'>".$r['moneda']."</font></td>";
					
					
				echo "	<td align=right style='color: '#070707' style='font-weight: bold'><font color='#FF3333'>".$row['clase']."</font></td>";
     break;
	case "E":
       echo "<tr valign='top' height='10' ><td><font color='#0066FF'>".$marca."</font></td><td color='#0066FF'><b>";
					$descripcion=str_replace( "#","no.", $row["descripcion"]);
					$descripcion=str_replace( "\r\n","<br>", $descripcion); 					
					echo "<a href='adm/editarPrecio.php?productor=".$marca."&id=".$row["id"]."' style='text-decoration: none;'><font color='#0066FF'>".$row['ref']."</a></b></font></td><td><font color='#0066FF'>".$descripcion." - ".$row['pagina']."</font></td><td align='left'><font color='#0066FF'>";
					echo $precioUnidad;
  					echo "</font></td><td align='left'><font color='#0066FF'><b>".number_format(($row['precioBase']*$r['factor'])*(1+$IVA),2)."</b></font></td><td align='left'><font color='#0066FF'>".$row['enReserva']."</font></td><td align='left' style='color: '#070707'><font color='#0066FF'>".$r['moneda']."</font></td>";
					
					
				echo "	<td align=right style='color: '#070707' style='font-weight: bold'><font color='#0066FF'>".$row['clase']."</font></td>";
				 break;
				 
				 default:
				 
				 echo "<tr valign='top' height='10' ><td><font color='#09D7D7'>".$marca."</font></td><td color='#09D7D7'><b>";
					$descripcion=str_replace( "#","no.", $row["descripcion"]);
					$descripcion=str_replace( "\r\n","<br>", $descripcion); 					
					echo "<a href='adm/editarPrecio.php?productor=".$marca."&id=".$row["id"]."' style='text-decoration: none;'><font color='#09D7D7'>".$row['ref']."</a></b></font></td><td><font color='#09D7D7'>".$descripcion." - ".$row['pagina']."</font></td><td align='left'><font color='#09D7D7'>";
					echo $precioUnidad;
  					echo "</font></td><td align='left'><font color='#09D7D7'><b>".number_format(($row['precioBase']*$r['factor'])*(1+$IVA),2)."</b></font></td><td align='left'><font color='#09D7D7'>".$row['enReserva']."</font></td><td align='left' style='color: '#09D7D7'><font color='#09D7D7'>".$r['moneda']."</font></td>";
					
					
				echo "	<td align=right style='color: '#09D7D7' style='font-weight: bold'><font color='#09D7D7'>".$row['clase']."</font></td>";
				 
        
        break;
}
					
	
				/*	$color=$row['clase']; 
				//codigo que cambiaba el color ala clase de los productos dependiendo el tipo de clase 
		//echo $color;
		if($color=="E"){
             echo "<td align='left'>";
		     echo "<font color='#0066FF'>".$row['clase']."</font>";
		     echo "</td>";
		}
		elseif($color=="D"){
			echo "<td align='left'>";
		     echo "<font color='#FF3333'>".$row['clase']."</font>";
		     echo "</td>";
		}
			 elseif($color!="D"&&"E"){
				 
			 echo "<td align='left' style='color: '#070707'>".$row['clase']."</td>";
		
		}
				*/	
				
				
					echo "</tr>";
					
	//}			
		} else {
					$i++;
				}
			}			
		}
	}
}	 
	echo "</table><br><br>";
}
$i=0;
while ($marca = mysql_fetch_array($marcas)) {
	$marcaX = $marca['marca'];
    echo $marcaX.'<input type="checkbox" name="'.$marcaX.'" value="'.$marcaX.'">, ';
	$i++;
	if ($i==10)
	   echo "<br>";
}
echo '</form>';





 ?> 
</body>
</html>
