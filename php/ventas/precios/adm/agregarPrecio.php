<?php
  include("../../inicio.php");
?>
<title>Editar marca</title>

<?php 
error_reporting(E_ALL ^ E_NOTICE);
$ref = $_REQUEST["ref"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];
$clase = $_REQUEST["clase"];
$cantidad_minima = $_REQUEST["CantidadMinima"];
$unidad =  strtoupper($_REQUEST["Unidad"]);
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
$insertSQL = "INSERT INTO Precio".$productor." (ref,precioBase,descripcion,enReserva,clase, CantidadMinima, Unidad ) VALUES ('$ref',$precioBase,'$descripcion','$enReserva','$clase', '$cantidad_minima', '$unidad')";
   mysql_query($insertSQL);
    
	 $inventario_inicial= "INSERT INTO inventario_inicial (marca, modelo, descripcion, precio, stock, clase, fecha, usuario) VALUES ('".$productor."','".$ref."','".$descripcion."','".$precioBase."','".$enReserva."', '".$clase."', '".$fecha."', '".$usuario."')";
   mysql_query($inventario_inicial);
   
     $IdTablaMarca=0;
     $SqlIdTablaMArca="SELECT MAX(id) as ultimo FROM precio".$productor."";
	 $resultId=mysql_query($SqlIdTablaMArca);
	while ($rowId = mysql_fetch_array($resultId)) {
			$IdTablaMarca=$rowId['ultimo'];
	}
	 
  	 $sQlProductos= "INSERT INTO productos (Idmarca, IdTablaMarca, marca, ref, descripcion, precioBase, enReserva, clase, fecha, factor, moneda, EnPortal, CantidadMinima, Unidad) VALUES ('".$Idmarca."' , ".$IdTablaMarca.",'".$productor."','".$ref."','".$descripcion."','".$precioBase."','".$enReserva."', '".$clase."', '".$fecha."','".$FactorMarca."', '".$monedaMarca."', '".$EnPortal."', '".$cantidad_minima."', '".$unidad."')";
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
<td width="46">Cantidad Minima</td>
<td width="46">Unidad</td>
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
  <option value="E" selected>E</option>
</select></td>

<td valign="top"><input type="text" name="CantidadMinima" size="7" value="1" required/></td>

<td valign="top"><input type="text" name="Unidad" size="7" value="PIEZA" required/></td>
<td>  <input type="checkbox" name="EnPortal" value="1"> Producto en <br> portal de clientes</td>
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
