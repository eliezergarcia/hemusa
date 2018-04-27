<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agregar Precio</title>
</head>
<body link="#0000ff" vlink="#0000ff" alink="#0000ff">

<?php 
$ref = $_REQUEST["ref"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];
$agregar = $_REQUEST["agregar"];

if (isset($agregar)) {
   include "../../incl/connect.incl";
	 
   $insertSQL = "INSERT INTO Precio".$productor." (ref,precioBase,descripcion,enReserva) VALUES ('$ref',$precioBase,'$descripcion','$enReserva')";
   mysql_query($insertSQL);
   mysql_close($conn);
}

 ?> 

<table border="0" cellpadding="0" cellspacing="0" summary="" align="center">
<tr><td>



<table border="1" cellpadding="3" cellspacing="0" summary="" align="center" bgcolor="#ffffff">
<tr valign='top' bgcolor='#ffffff'>
<td>Modelo</td><td>Descripcion</td><td>Productor</td><td>Precio</td><td>En Reserva</td>
</tr>

<?php  
echo "<form action='$PHP_SELF' method='post'>"; 
?>
<tr align="right">
<td valign="top"><input type="text" name="ref" size="10" value=""></td>
<td valign="top"><textarea name="descripcion" rows="5" cols="20" value=""></textarea>
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
<td valign="top"><input type="text" name="precioBase" size="7" value=""></td>
<td valign="top"><input type="text" name="enReserva" size="7" value="0"></td>
</td>
</tr>
</table>
<p>

<input type="submit" name="agregar" value="Agregar">
</form>
<a href="../precios.php">atras</a>
</td></tr>
</table>


</body>
