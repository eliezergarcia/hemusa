<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agregar Precio</title>
</head><body link="#0000ff" vlink="#0000ff" alink="#0000ff">

<?php 
error_reporting(E_ALL ^ E_NOTICE);
$ref = $_REQUEST["ref"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];
$clase = $_REQUEST["clase"];
$agregar = $_REQUEST["agregar"];

if (isset($agregar)) {
   include "../../incl/connect.incl";
	 
   $insertSQL = "INSERT INTO Precio".$productor." (ref,precioBase,descripcion,enReserva,clase) VALUES ('$ref',$precioBase,'$descripcion','$enReserva','$clase')";
   mysql_query($insertSQL);

$exito=$insertSQL;

if($exito){

	 echo "<script languaje='javascript'>alert('La herramienta se agrego correctamente')</script>";

   mysql_close($conn);
}
}
 ?> 


<br><form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="post">
<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">
<tr valign='top' bgcolor='#ffffff'>
<td>Modelo</td><td>Descripcion</td><td>Productor</td><td>Precio</td><td>En Reserva</td>
<td>Clase</td>
</tr>



<tr align="right">
<td valign="top"><input type="text" name="ref" size="10" value="" required/></td>
<td valign="top"><textarea name="descripcion" rows="5" cols="20" value="" required/></textarea>
<td valign="top">

<select name="productor">
<?php 
   include "../../incl/connect.incl";
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
