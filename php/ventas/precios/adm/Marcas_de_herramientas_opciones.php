<?php
	include("../../inicio.php");
?>
<body>
	<div class="container-fluid center-xs contenido">
        <div class="row center-xs start-sm enlaces">
          <a href="../../inicio.php">Inicio</a>
          <p>></p>
          <a href="precios.php">Lista de precios</a>
        </div>
        <div class="row center-xs between-lg encabezado">
          <div class="row middle-xs titulo">
            <!-- <i class="fa fa-users" aria-hidden="true"></i> -->
            <h2>Lista de precios</h2>
          </div>
          <div class="row middle-xs center-xs iconos">
          	<div class="icon-group agregar">	
            		<a href="adm/Marcas_de_herramientas_opciones.php"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            		<p>Agregar marca</p>
          	</div>
          	<div class="icon-group editar">
            		<a href="adm/Editar_marca.php"><i class="editar fa fa-pencil-square-o" aria-hidden="true"></i></a>
            		<p>Editar marca</p>
          	</div>
			<div class="icon-group agregar">	
            	<a href="adm/agregarPrecio.php"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            	<p>Agregar herramienta</p>
          	</div>
          	<div class="icon-group agregar">	
				<?php
					$sql_solicitud_inventario="SELECT * FROM solicitud_inventario WHERE solicitud_aprobada= 'pendiente' ORDER BY fecha ";

					$res_solicitud=mysqli_query($conexion_usuarios ,$sql_solicitud_inventario);
				 
					if(mysqli_num_rows($res_solicitud) > 0){
							echo '<a href="adm/solicitudes_creadas.php"><i class="fa fa-archive" aria-hidden="true"></i></a>';
							echo '<p><font color="red">Solicitud Inventario('.mysqli_num_rows($res_solicitud).')</font></p>';
						}else{
							echo '<a href="adm/solicitudes_creadas.php"><i class="fa fa-archive" aria-hidden="true"></i></a>';
							echo '<p><font color="red">Solicitud Inventario</p>';
						}
				?>
          	</div>
        </div>
    </div>
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
 Unidad VARCHAR(10) default 'PIEZA',
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