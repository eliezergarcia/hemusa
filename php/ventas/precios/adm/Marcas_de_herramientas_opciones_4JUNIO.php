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
      <input type="float" name="factor"></input>   <br>
    
    <label type="label"> Moneda: </label><br>
   <select name="moneda" id="moneda">  
<option selected="selected" value="mxn"> mxn </option>  

   <option value="usd" > usd </option>
</select> <br>

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



</form></center>
</body>

<?php

require_once('../../incl/connect.php');
 function Agregar_marca($marca, $factor,$moneda){require_once('../../incl/connect.php');
$query = "CREATE TABLE precio$marca
 (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ref VARCHAR(50),
descripcion VARCHAR(250),
 precioBase DECIMAL(10,2),
 enReserva INT(11),
 clase VARCHAR(20),
 CantidadMinima INT(11) default '1',
 fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 )";

$actualizar = 
"INSERT INTO marcadeherramientas 
(id,
 marca      ,
 factor, moneda)
values 
('',
 '$marca',
 '$factor',
 '$moneda')";

if(!$resultado = mysql_query( $query)) {
	
 echo"<script>alert('Error al  agregar la marca ')</script>";	
 die();
	}

if(!$resultado = mysql_query($actualizar)) {
	echo"<script>alert('Error al  agregar la marca ')</script>";	
	 die();
	}
	else{

	 echo"<script>alert('La marca se agrego exitosamente')</script>";
	}
 
 }


 
	if(empty($_POST) ){
		DIE("");
		} 
		
	
$marca=$_POST["nombre_marca"]; 
$factor=$_POST["factor"]; 
$moneda=$_POST["moneda"]; 
 if(!is_numeric($factor)) {
		echo"<script>alert('El factor $factor NO es numerico intente de nuevo')</script>";

		  DIE("");
    }

 
 if(isset($_POST['agregar'])){require_once('../../incl/connect.php');
$query = "SELECT marca FROM marcadeherramientas where marca='$marca'";

$resultado_marca = mysql_query($query);
$r = mysql_fetch_array($resultado_marca);
	

	if(empty ($r)){
	
		Agregar_marca($marca, $factor,$moneda);
	

		}
 
else{
	echo"<script>alert('La marca $marca ya existe intente de nuevo')</script>";
	

	}
	 


	
	
	
	}
 
 
?>
</html>