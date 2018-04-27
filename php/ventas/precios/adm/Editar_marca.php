<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editar marca</title>
</head><body link="#0000ff" vlink="#0000ff" alink="#0000ff">
<body>
<?php 
	require_once('../../incl/connect.php');

echo "<h2><center>Editar marca</center></h2>";
echo "<center>";
//Formulario para buscar una marca por nombre
echo '<form action="Editar_marca.php" method="post">';

echo '<label type="label">Nombre Marca: </label><br>';
echo'<input type="text" name="nombre_marca"></input> <br>';
echo'<br>';
echo'<input type="submit" value="Buscar" name="buscar"></input>';
echo'</form>';
echo "</center>";

// si se presiona el boton buscar, llamaa la funcion buscar marca, enviando
//como parametro, el nombre de la marca que se escribioo en el formulario para buscar
if(!empty($_POST["buscar"])){	
if(!empty($_POST["nombre_marca"])){
	$nombre_marca=$_POST["nombre_marca"]; 
	buscar_marca($nombre_marca);
     } 	
}


if(!empty($_GET['id_marca'])){ // Si se presiono el enlace que envia el id de la marca, muestra la informacion de la 
//marca en la funcion mostrar marca
	
  $id_marca=$_GET['id_marca'];
	mostrar_marca($id_marca);
	
}
//Si se presiona el boton editar_marca, se recogen los datos, marca y moneda que se mostraron<br>
//en la funcion mostrar maarca, y se llama a la funcion editar marca,<br>
//donde se ejecutan los querys update
if(!empty($_POST["editar_marca"])){	


$id_editar=$_POST["id_editar"];
$marca=$_POST["marca_editar"];
$moneda=$_POST["moneda_editar"];
if(empty($marca) or empty($moneda)){
	echo"<script>alert('Los campos no deben estar vacios')</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=../precios.php\">"; 	
	}
else{
editar_marca($id_editar, $marca, $moneda);
}

}


function buscar_marca($nombre_marca){
require_once('../../incl/connect.php');

//funcion que busca concidencias de marcas con el nombre escrito<br>
//por el usuario
$sql_marca="SELECT * FROM marcadeherramientas WHERE marca like '%$nombre_marca%'  ORDER BY marca ";
echo '<form action="Editar_marca.php" method="post">';
$resultado_marca=mysql_query($sql_marca);
echo '<center>';
echo '<table  border="1" cellpadding="1px" cellspacing="1" summary="" frame="border" >';
echo '<th>MARCA</th>';
echo '<th>MONEDA</th>';
echo '<th>EDITAR</th>';
	while($row_marca=mysql_fetch_array($resultado_marca)){
	
	$id=$row_marca['id'];	
    $marca=$row_marca['marca'];	
	$moneda=$row_marca['moneda'];	

	echo "<tr>";
	echo '<td><label for="marca"> '.$marca.' </label></td>';
	echo '<td><label for="monedaa"> '.$moneda.' </label></td>';
    echo '<td><B> <a  style="text-decoration: none;" href="Editar_marca.php?id_marca='.$id.'">Editar</a></B></td>';
	
	}

echo "</form>";
echo '</center></table>';
}


function mostrar_marca($id_marca){
	require_once('../../incl/connect.php');

// Se muestra la informacion en campos editables de la marca que se selecciono,
// se muestra el boton editar para recoger la informacion editada por el usuario
	$sql_marca="SELECT * FROM marcadeherramientas WHERE id=$id_marca ";
	$resultado_marca=mysql_query($sql_marca);
	echo '<center><form action="Editar_marca.php" method="post">';
	while($row_marca=mysql_fetch_array($resultado_marca)){
	
	$marca=$row_marca['marca'];	
	$moneda=$row_marca['moneda'];

	echo '<input type="hidden" name="id_editar" value="'.$id_marca.'">';
	echo ' <label for="moneda"> <B>MARCA :</B> </label>';
	echo ' <br><input type="text" name="marca_editar" value="'.$marca.'" size="16" />';
	echo '<br><label for="moneda"> <B>MONEDA :</B> </label></td>';
	echo '<br><input type="text" name="moneda_editar" value="'.$moneda.'" size="16"/>';
  	echo '<br><input type="submit" name="editar_marca" value="EDITAR" /><br>';

	}
	echo "</form></center>";
	}
	function editar_marca($id_editar, $marca, $moneda){
	// funcion que edita los registros de la marca seleccionada	
require_once('../../incl/connect.php');

		
	$sql_marca="SELECT marca FROM marcadeherramientas WHERE id=$id_editar ";
	$resultado_marca=mysql_query($sql_marca);

	while($row_marca=mysql_fetch_array($resultado_marca)){
	
	$marca_anterior=$row_marca['marca'];	
	
	}
	if($marca_anterior != $marca){
		// si cambia el nombre de la marca que tambien cambie el nombre de su tabla
			$sql_nombre_tabla="RENAME TABLE precio".$marca_anterior." TO precio".$marca."";
		 if(!$resultado = mysql_query($sql_nombre_tabla)) {
	echo"<script>alert('Error al  editar  nombre de la marca ')</script>";	
	die();
 }
		}


$sql_marca="UPDATE `marcadeherramientas` SET `marca` = '".$marca."' WHERE id = '".$id_editar."'";
 if(!$resultado = mysql_query($sql_marca)) {
	echo"<script>alert('Error al  editar  nombre de la marca ')</script>";	
	die();
 }
	$sql_marca="UPDATE `marcadeherramientas` SET `moneda` = '".$moneda."' WHERE id = '".$id_editar."'";
 if(!$resultado = mysql_query($sql_marca)) {
	echo"<script>alert('Error al  editar  moneda de la marca ')</script>";	
	die();
 } 
 
 //Actualiza tabla Productos
 
 $sqlActualiza="UPDATE productos SET moneda='".$moneda."' , marca='".$marca."' 
 WHERE IdMarca=".$id_editar."
 ";
 
	if(!$resultado = mysql_query($sqlActualiza)) {
	echo"<script>alert('Error al  editar tabla productos')</script>";	
	die();
 } 
		
		
echo"<script>alert('Los registros fueron modificados')</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=../precios.php\">"; 	
	
		}
	

?>
</body>