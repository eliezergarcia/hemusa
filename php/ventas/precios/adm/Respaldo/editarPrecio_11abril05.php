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
echo "<td>Modelo</td><td>Descripcion</td><td>Precio</td><td>En reserva</td>";
echo "</tr>";

$row = mysql_fetch_array($result);

	 echo "<tr>";
	 echo "<td>".$row['ref']."</td><td>".$row['descripcion']."</td><td align='right'>".$row['precioBase']."</td><td align='right'>".$row['enReserva']."</td>";
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
<td valign="top" align="right"><input type="text" name="enReserva" size="7" value=""></td>
</td>
</tr>
</table>
<p>

<?php  
echo '<input type="hidden" name="id" value="'.$id.'">';
echo '<input type="hidden" name="productor" value="'.$productor.'">';
echo '<input type="hidden" name="refold" value="'.$ref.'">';
?> 
<input type="submit" name="edit" value="Cambiar">
<input type="submit" name="delete" value="Eliminar">
</form>

</td></tr>
</table>


</body>
