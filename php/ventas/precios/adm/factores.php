<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Cambiar Factores</title>
</head>
<body>
<center><br><br>
<a href="../precios.php">Atras</a>
<br><br>
<table summary="" border="1" cellpadding="2" cellspacing="0" frame="border">
<tr><td width="100"><b>Marca</b></td><td width="70"><b>Factor</b></td></tr>

<?php require_once('../../incl/connect.php');
$marca = $_REQUEST["marca"];
   $factor = $_REQUEST["factor"];
   $cambio = $_REQUEST["cambio"];

   if (isset($marca)) {
	    $insertSQL="UPDATE `marcadeherramientas` SET `factor` = '".$factor."' WHERE marca = '".$marca."'";
			mysql_query($insertSQL);
			
			//Actualiza tabla productos
$sqlActualiza="UPDATE `productos` SET `factor` = '".$factor."' WHERE marca = '".$marca."'";
			mysql_query($sqlActualiza);
	 }

   $result = mysql_query("SELECT * FROM MarcaDeHerramientas ORDER BY marca");


   while ($row = mysql_fetch_array($result)) {



     echo '<tr valign="top"><td>'.$row["marca"].'</td>';
		 echo '<td>';
		 echo '<form action="factores.php" name="'.$row["marca"].'">';
		 echo '<input type="text" name="factor" value="'.$row["factor"].'" size="8"" />';
		 echo '<input type="hidden" name="marca" value="'.$row["marca"].'" />';
		 echo '<input type="submit" name="cambio" value="cambiar" />';
		 echo '</form>';
		 echo '</td></tr>';
   }

 ?> 

</table></center>
</body>
</html>
