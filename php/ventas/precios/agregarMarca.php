<?php
	include("../../inicio.php");
?>
<body>
	<div class="container-fluid center-xs contenido">
        <div class="row center-xs start-sm enlaces">
          <a href="../../inicio.php">Inicio</a>
          <p>></p>
          <a href="precios.php">Lista de precios</a>
          <p>></p>
          <a href="agregarMarca.php">Agregar marca</a>
        </div>
        <div class="row center-xs between-lg encabezado">
          <div class="row middle-xs titulo">
            <h2>Agregar marca</h2>
          </div>
        </div>
   		<form action="#" method="post" class="row center-xs">
	   		<div class="row start-xs col-lg-4">
		      	<div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-12">
					<label for="nombre_marca" class="col-xs-4">Nombre de la marca: </label>
					<input type="text" id="nombre_marca" name="nombre_marca" class="col-xs-8">
				</div>

		      	<div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-12">
					<label for="factor" class="col-xs-4">Factor de precio: </label>
					<input type="text" id="factor" name="factor" class="col-xs-8">
				</div>

				<div class="row middle-xs radio input-group col-xs-12 col-sm-6 col-md-6 col-lg-12">
					<p class="col-xs-4">Moneda:</p>
					<div class="col-xs-8">
						<input type="radio" name="moneda" id="mxn">
						<label for="mxn">MXN</label>
			 			<input type="radio" name="moneda" id="usd">
			 			<label for="usd">USD</label>
					</div>
				</div>
				<div class="row middle-xs center-xs col-xs-12">
					<input type="submit" id="btn-submit" value="Agregar" class="col-xs-6 col-md-3">
				</div>
			</div>
			</div>
   		</form>
    </div>
</body>

<?php

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