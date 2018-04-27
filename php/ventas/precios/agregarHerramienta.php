<?php
  include("../../inicio.php");
?>
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
$result=mysqli_query($conexion_usuarios, $sqlmarca);
while ($row = mysqli_fetch_array($result)) {
      
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
    <div class="container-fluid center-xs contenido">
      <div class="row center-xs start-sm enlaces">
        <a href="../../inicio.php">Inicio</a>
        <p>></p>
        <a href="precios.php">Lista de precios</a>
        <p>></p>
        <a href="agregarHerramienta.php">Agregar herramienta</a>
      </div>
      <div class="row center-xs between-lg encabezado">
        <div class="row middle-xs titulo">
          <h2>Agregar herramienta</h2>
        </div>
      </div>
     <form action="#" class="" name="" method="post">
      <div class="row around-xs start-xs">
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="empresa" class="col-xs-4">Model: </label>
          <input type="text" id="empresa" name="empresa" class="col-xs-8">
        </div>
        <div class="row middle-xs input-group input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="rfc" class="col-xs-4">Descripción: </label>
          <input type="text" id="rfc" name="rfc" class="col-xs-8">
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <p class="col-xs-4">Productor:</p>
         <?php
            $result = mysqli_query($conexion_usuarios, "SELECT marca FROM marcadeherramientas ORDER BY marca");
            echo '<select name="buscarBuscar" class="col-xs-6 col-lg-8">';
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="'.$row['marca'].'" >'.$row['marca'].'</option>'; 
            }
            echo '<option value="todo" selected="selected">Todo</option>';
            echo '</select>';
          ?>
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="contacto" class="col-xs-4">Precio: </label>
          <input type="text" id="contacto" name="contacto" class="col-xs-8">
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="noInterior" class="col-xs-4">En reserva: </label>
          <input type="text" id="noInterior" name="noInterior" value="0" class="col-xs-8">
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <p class="col-xs-4">Dia de revisión:</p>
          <select name="diaRevision" class="col-xs-4">
            <option value="A" selected>A</option>
            <option value="D">D</option>
            <option value="E">E</option>
          </select>
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="noExterior" class="col-xs-4">Cantidad mínima: </label>
          <input type="text" id="noExterior" name="noExterior" value="1" class="col-xs-8">
        </div>
        <div class="row middle-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <label for="noExterior" class="col-xs-4">Unidad: </label>
          <input type="text" id="noExterior" name="noExterior" value="Pieza" class="col-xs-8">
        </div>
        <div class="row middle-xs radio input-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <p class="col-xs-4">En portal:</p>
          <div class="col-xs-8">
            <input type="radio" name="moneda" id="mxn">
            <label for="mxn">Producto en portal de clientes</label>
          </div>
        </div>
        <div class="row middle-xs center-xs col-xs-6">
          <input type="submit" id="btn-submit" value="Agregar" class="col-xs-6 col-lg-4">
        </div>
      </div>
    </form>
</body>
