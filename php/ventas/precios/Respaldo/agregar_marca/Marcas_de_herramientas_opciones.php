<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<h3>
<font color="19A3A8"><center> <i>Nueva Marca</i> </center>
</font></h3>
<body>
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <center>
 
     <label type="label">Nombre de la marca: </label><br>
      <input type="text" name="nombre_marca"></input> <br>
      
   <label type="label"> Factor de precio : </label><br>
      <input type="float" name="factor"></input>

      <br>
     <input type="submit" value="Agregar" name="agregar"></input>
      
      
  
      </center>

   </form>
   
   
   
   <script language="JavaScript">
function newPage(url){
window.open(url,"","algun parametro que desees");
}
</script>
<center>
<h3>
<font color="19A3A8"><center> <i>Mas opciones</i> </center>
</font></h3>
<form>
<input type="button" value="Consulta de precios " 
onClick="window.location.href='../precios.php'">

<input type="button" value="Factores de marcas" onClick="newPage('../adm/factores.php')">

</form></center>
</body>

<?php
 function Agregar_marca($marca, $factor){
	 
	

include "../../incl/connect.incl";

$query = "CREATE TABLE precio$marca
 (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ref VARCHAR(50),
descripcion VARCHAR(250),
 precioBase DECIMAL(10,2),
 enReserva INT(11)
 )";
$actualizar = 
"INSERT INTO marcadeherramientas 
(id,
 marca      ,
 factor)
values 
('',
 '$marca',
 '$factor')";

if(!$resultado = mysql_query( $query)) die();
 if(!$resultado = mysql_query($actualizar)) die();

 }


 
	if(empty($_POST) ){
		DIE("");
		} 
		
	
$marca=$_POST["nombre_marca"]; 
$factor=$_POST["factor"]; 
 if(!is_numeric($factor)) {
		echo"<script>alert('El factor $factor NO es numerico intente de nuevo')</script>";

		  DIE("");
    }

 
 if(isset($_POST['agregar'])){
	Agregar_marca($marca, $factor);
	}
 
 
?>
</html>