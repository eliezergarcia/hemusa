<?php
	include("../../inicio.php");
?>

<?php 

$ref="";
$descripcion="";
$precioBase="";
$enReserva="";
$refold=""; $productor=""; $igi="";
if(!empty($_REQUEST["buscar"])){
$palabraBusca= $_REQUEST["palabraBusca"];
$marcaBuscar = $_REQUEST["marcaBuscar"];
$buscar = $_REQUEST["buscar"];
$delete = $_REQUEST["delete"];
$id = $_REQUEST["id"];
$ref = $_REQUEST["ref"];
$refold = $_REQUEST["refold"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];
$existencia = $_REQUEST["existencia"];
$igi = $_REQUEST["igi"];
$id_igi = $_REQUEST["id_igi"];
}


if(!empty($_POST['edit'])){
	
	if(!empty($_POST['clase'])){
		$clase=$_POST['clase'];
		  $insertSQL = "update Precio".$productor." set clase='".$clase."' where id='".$id."'";
      mysql_query($insertSQL);
	      $insertSQL = "update productos set clase='".$clase."' where IdTablaMarca='".$id."' and marca='".$productor."'";
		   mysql_query($insertSQL);
		}
			if(!empty($_POST['CantidadMinima'])){
		$cantidad_min=$_POST['CantidadMinima'];
		  $insertSQL = "update Precio".$productor." set CantidadMinima='".$cantidad_min."' where id='".$id."'";
      mysql_query($insertSQL);
	      $insertSQL = "update productos set CantidadMinima='".$cantidad_min."' where IdTablaMarca='".$id."' and marca='".$productor."'";
		   mysql_query($insertSQL);
		}
		
			if(!empty($_POST['Unidad'])){
				
		$unidad=strtoupper($_POST['Unidad']);
		  $insertSQL = "update Precio".$productor." set Unidad='".$unidad."' where id='".$id."'";
      mysql_query($insertSQL);
	      $insertSQL = "update productos set Unidad='".$unidad."' where IdTablaMarca='".$id."' and marca='".$productor."'";
		   mysql_query($insertSQL);
		}
		
	
	}
if( !empty($_POST["igi"])){
	
	 
	 if($ref!=''){
		 $modelo_igi=$ref;
		 }
		 else{
			 $modelo_igi=$refold;
			 }
$valor_igi=($_POST["igi"]/100);
	if($id_igi == '0'){ // si el id del igi q se recibio no existe, agregaremos el modelo con el igi
		require_once('../incl/connect.php');
		$query_igi = 
"INSERT INTO modelos_igi(marca, modelo, igi)
values ('$productor','$modelo_igi', '$valor_igi' )";

if(!$resultado = mysql_query($query_igi)){
echo"<script>alert('Error al agregar igi')</script>";	
}
		
} // fin condision igi no existe
} 


if (isset($enReserva)) {
   $refBusca=$refold;
	 $marcaBuscar=$productor;
	 $buscar='Buscar';
}

$insertSQL = "SELECT IVA FROM `cifrasimportantes`";
$result = mysqli_query($conexion_usuarios, $insertSQL);
$row = mysqli_fetch_array($result);
global $IVA;
$IVA = $row['IVA'];

    if ($ref!='') {
		
      $insertSQL = "update Precio".$productor." set ref='$ref' where id='".$id."'";
      mysql_query($insertSQL);
	  $insertSQL = "update modelos_igi set modelo='$ref' where marca='".$productor."' and modelo='$refold'";
      mysql_query($insertSQL);
	  
	    $insertSQL = "update productos set ref='$ref' where IdTablaMarca='".$id."' and
		marca='".$productor."'";
      mysql_query($insertSQL);
    }
    if ($descripcion!='') {
      $insertSQL = "update Precio".$productor." set descripcion='$descripcion' where id='".$id."'";
      mysql_query($insertSQL);
	      $insertSQL = "update productos set descripcion='$descripcion' where IdTablaMarca='".$id."' and marca='".$productor."'";
		   mysql_query($insertSQL);
    }
    if ($precioBase!='') {
		
      $insertSQL = "update Precio".$productor." set precioBase=$precioBase where id='".$id."'";
      mysql_query($insertSQL);
	    $insertSQL = "update productos set precioBase=$precioBase where IdTablaMarca='".$id."' and marca='".$productor."'";
		 mysql_query($insertSQL);
   
    }
	
	if($igi != ''){ // si se actualiza el modelo del igi
		$insertSQL = "update modelos_igi set igi=".($igi/100)." where id='".$id_igi."'";
      mysql_query($insertSQL);

		
		}
    if ($enReserva!='') {
//query para obtener stock anterior
$sql_stock="SELECT * FROM Precio".$productor." where id ='".$id."' ";

$resultado_stock=mysql_query($sql_stock);

while($row_stock=mysql_fetch_array($resultado_stock)){
$stock_anterior=$row_stock['enReserva'];	
$modelo_cambiar=$row_stock['ref'];	
}
// se guarda el stock anterior en la variable stock_anterior
// se actualza el nuevo stock
      $insertSQL = "update Precio".$productor." set enReserva=$enReserva where id='".$id."'";
			mysql_query($insertSQL);
						
$insertSQL = "update productos set enReserva=$enReserva where IdTablaMarca='".$id."' and marca='".$productor."'";
			  mysql_query($insertSQL);
 if($stock_anterior >$enReserva){
	$accion="restar";
	}else{
		$accion="sumar";
		}
    
	 
	 $sql_solicitud= 
"INSERT INTO solicitud_inventario 
(id,
 id_modelo,
 marca, modelo, cantidad, accion, motivo, contacto_hemusa, solicitud_aprobada)
values 
('',
 '$id',
 '$productor',
 '$modelo_cambiar', '$enReserva', '$accion', 'ajuste manual antes ".$stock_anterior." despues ".$enReserva."', '$usuario', 'aprobada')";



if(!$resultado_solicitud = mysql_query($sql_solicitud)) {
	echo"<script>alert('Error al  crear solicitud ')</script>";	
	 die();
	}
	 		
			
			
			
    }
    if ($productor!='') {
      $insertSQL = "update Precio".$productor." set productor='$productor' where id='".$id."'";
      mysql_query($insertSQL);
    }
  if (isset($delete))
  {
    $insertSQL = "delete from Precio".$productor." where id=$id";
    mysql_query($insertSQL);
	
	    $insertSQL = "delete from productos  where IdTablaMarca='".$id."' and
		marca='".$productor."'";
		 mysql_query($insertSQL);
  }  


 ?> 
	<div class="container-fluid center-xs contenido">
        <div class="row center-xs start-sm enlaces">
          <a href="../../inicio.php">Inicio</a>
          <p>></p>
          <a href="precios.php">Lista de precios</a>
        </div>
        <div class="row center-xs between-lg encabezado">
          <div class="row middle-xs titulo">
            <h2>Lista de precios</h2>
          </div>
          <div class="row middle-xs center-xs iconos">
          	<div class="icon-group agregar">	
            		<a href="agregarMarca.php"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            		<p>Agregar marca</p>
          	</div>
          	<div class="icon-group editar">
            		<a href="editarMarca.php"><i class="editar fa fa-pencil-square-o" aria-hidden="true"></i></a>
            		<p>Editar marca</p>
          	</div>
			<div class="icon-group agregar">	
            	<a href="agregarHerramienta.php"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            	<p>Agregar herramienta</p>
          	</div>
          	<div class="icon-group agregar">	
				<?php
					$sql_solicitud_inventario="SELECT * FROM solicitud_inventario WHERE solicitud_aprobada= 'pendiente' ORDER BY fecha ";

					$res_solicitud=mysqli_query($conexion_usuarios, $sql_solicitud_inventario);
				 
					if(mysqli_num_rows($res_solicitud) > 0){
							echo '<a href="solicitudes_creadas.php"><i class="fa fa-archive" aria-hidden="true"></i></a>';
							echo '<p><font color="red">Solicitud Inventario('.mysqli_num_rows($res_solicitud).')</font></p>';
						}else{
							echo '<a href="solicitudes_creadas.php"><i class="fa fa-archive" aria-hidden="true"></i></a>';
							echo '<p><font color="red">Solicitud Inventario</p>';
						}
				?>
          	</div>
        </div>
    </div>
    <form action="precios.php" name="" method="post"> 
        <div class="row ">
        	<div class="row center-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-12">
				<label for="buscarPalabra" class="center-xs col-xs-6 col-lg-2">Busca frase: </label>
				<input type="text" id="buscarPalabra" name="buscarPalabra" class="col-xs-6 col-lg-2">
			</div>
			<div class="row center-xs input-group col-xs-12 col-sm-6 col-md-6 col-lg-12">
				<label for="buscarMarca" class="center-xs col-xs-6 col-lg-2">Marca: </label>
				<?php
					$result = mysqli_query($conexion_usuarios, "SELECT marca FROM marcadeherramientas ORDER BY marca");
					echo '<select name="buscarBuscar" class="col-xs-6 col-lg-2">';
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="'.$row['marca'].'" >'.$row['marca'].'</option>';	
					}
					echo '<option value="todo" selected="selected">Todo</option>';
					echo '</select>';
				?>
			</div>
			<!-- <div class="row middle-xs center-xs col-xs-6">
				<input type="submit" id="btn-submit" value="Agregar" class="center-xs col-xs-6 col-lg-2">
			</div> -->
		</div>
    </form>

<?php
			
	if( !empty($buscar) and !empty($marcaBuscar)){
		echo '<center>El resultado de la b&uacute;squeda: '.$palabraBusca.'
		</center><p></p>';
		echo '<table border="0" cellpadding="3" cellspacing="0" summary="" 
		frame="border" width="85%"  style="text-align:left">';
		echo '<tr valign="bottom"><td><b>Marca</b><br><img src="Line.jpg" width="50" height="2" /><td><b>Modelo</b><br><img src="Line.jpg" width="" height="2" /></td><td><b>Descripci&oacute;n<br><img src="Line.jpg" width="200" height="2" /></b></td><td><b>Precio de <br>Lista</b><br><img src="Line.jpg" width="70" height="2" /></td><td ><b>Precio con<br>IVA</b><br><img src="Line.jpg" width="70" height="2" /></td>';

		 echo '<form action="precios.php?palabraBusca='.$palabraBusca.'&buscar=Buscar&marcaBuscar='.$marcaBuscar.'" method="post">';
//echo '<input type="hidden" name="marcaBuscar" value="'.$marcaBuscar.'" />'; 
		echo '<td> <select name="existencia" id="existencia" onchange="submit()">';
		echo "<option value='' select ='selected' ><b>Almacen</b></option>";
		echo "<option value='en almacen'>Todo en almacen</option>";		
		echo "</select></td>";
		echo "<td><b>Moneda</b><br><img src='Line.jpg' width='70' height='2' /></td><td><b>Clase</b>
		<br><img src='Line.jpg' width='70' height='2' /></td>";
		echo"</tr>";
		echo '</form>';
		
		if ($marcaBuscar=='todo'){
			buscar_todas_marcas($palabraBusca, $existencia);
		}else{
			buscar_enmarca($palabraBusca,$marcaBuscar, $existencia);
		}
	}
?>
</main>
</body>
</html>
<?php

function buscar_todas_marcas($palabraBusca, $existencia){
	global $IVA;
	
	echo "Palabra Buscar: ".$palabraBusca;
	
	if($existencia == "en almacen" ){
		
			$sql="SELECT productos.IdProducto, productos.IdTablaMarca, productos.marca, productos.ref, productos.descripcion, productos.precioBase,
	productos.enReserva, productos.clase, productos.moneda, productos.factor,
	case when modelos_igi.igi is null then 0 else modelos_igi.igi end  as igi , 
	case when modelos_igi.proveedor is null then 0 else modelos_igi.proveedor end as 				    proveedorModelo FROM productos  LEFT JOIN modelos_igi on modelos_igi.marca=productos.marca
				 and modelos_igi.modelo=productos.ref
				  WHERE 
  (
productos.marca LIKE  '%".$palabraBusca."%'
OR productos.ref LIKE  '%".$palabraBusca."%'
OR productos.descripcion LIKE  '%".$palabraBusca."%'

)AND(
productos.enReserva>0
)";
		}
	else{
	$sql="SELECT productos.IdProducto, productos.IdTablaMarca, productos.marca, productos.ref, productos.descripcion, productos.precioBase,
	productos.enReserva, productos.clase, productos.moneda, productos.factor,
	case when modelos_igi.igi is null then 0 else modelos_igi.igi end  as igi , 
	case when modelos_igi.proveedor is null then 0 else modelos_igi.proveedor end as 				    proveedorModelo FROM productos  LEFT JOIN modelos_igi on modelos_igi.marca=productos.marca
				 and modelos_igi.modelo=productos.ref
				  WHERE 
  (
productos.marca LIKE  '%".$palabraBusca."%'
OR productos.ref LIKE  '%".$palabraBusca."%'
OR productos.descripcion LIKE  '%".$palabraBusca."%'

)";
	}

//echo $sql;
			$result = mysql_query($sql);
  		       
			while ($row = mysql_fetch_array($result)) {
			
			$color=$row['clase'];
		
			if($color=="E"){
           
			 	$color='#0066FF';
				}
			elseif($color=="D"){
				$color='#FF3333';
				}
			 elseif($color!="D"&&"E"){
				$color='#070707';
				}
		// codigo para calcular igi en base al costo.
	
	
		
$igi_del_modelo=$row['igi'];
if($igi_del_modelo != 0){
		$factor_descuento=&obtener_precio_compra($row['proveedorModelo']);
		if($factor_descuento==0){
		$factor_descuento=1;
		}
		$igi_del_modelo=($row['precioBase']*$factor_descuento)*$igi_del_modelo;
	}



	
		
            echo'<tr style="color:'.$color.'">';
           
			echo "<td>".$row['marca']."</td>";
			echo "<td><a href='adm/editarPrecio.php?productor=".$row['marca']."
			&id=".$row["IdTablaMarca"]."' style='text-decoration: none;'><font color='".$color."'><b>".$row['ref']."</b></font></a>
			</td>";
		
			if($igi_del_modelo != 0){
				echo "<td>".$row['descripcion']." (Este modelo tiene IGI)"."</td>";
				echo "<td>".number_format((($row['precioBase']*
				$row['factor'])+$igi_del_modelo),2,'.',',')."</td>";
				echo "<td><b>".number_format(((($row['precioBase']*
				$row['factor'])+$igi_del_modelo)*(1+$IVA)),2,'.',',').
				"</b></td>";
			}
			else{
				echo "<td>".$row['descripcion']."</td>";
				echo "<td>".number_format(($row['precioBase']*
				$row['factor']),2,'.',',')."</td>";
				echo "<td><b>".number_format((($row['precioBase']*
				$row['factor'])*(1+$IVA)),2,'.',',').
				"</b></td>";
				}
		
	
		    echo "<td>".($row['enReserva'])."</td>";
			echo "<td>".($row['moneda'])."</td>";
			echo "<td>".($row['clase'])."</td>";
			echo "</tr>";
				
			}
			
	}
	
	
	
	
	function buscar_enmarca($palabraBusca,$marcaBuscar, $existencia){
		global $IVA;
	
//echo "buscaras en ".$marcaBuscar." la palabra ".$palabraBusca;
			
		if($existencia == "en almacen" and !empty($palabraBusca)){
			$sql="SELECT precio".$marcaBuscar.".id, ref, descripcion, precioBase,
				 enReserva,clase, moneda, factor, case when modelos_igi.igi is null
				 then 0 else modelos_igi.igi end  as igi , case when modelos_igi.proveedor
				 is null then 0 else modelos_igi.proveedor end as proveedorModelo
				  FROM Precio".$marcaBuscar." 
				 LEFT JOIN marcadeherramientas on marcadeherramientas.marca
				 ='".$marcaBuscar."' 
				  LEFT JOIN modelos_igi on modelos_igi.marca='".$marcaBuscar."'
				 and modelos_igi.modelo=precio".$marcaBuscar.".ref
				  WHERE  descripcion  like '%".$palabraBusca."%' 
				  and enReserva >0  UNION ALL
				  SELECT precio".$marcaBuscar.".id, ref, descripcion, precioBase,
				 enReserva,clase, moneda, factor ,case when modelos_igi.igi is null
				 then 0 else modelos_igi.igi end  as igi ,  case when modelos_igi.proveedor
				 is null then 0 else modelos_igi.proveedor end as proveedorModelo
				 FROM Precio".$marcaBuscar." 
				 LEFT JOIN marcadeherramientas on marcadeherramientas.marca
				 ='".$marcaBuscar."' 
				 LEFT JOIN modelos_igi on modelos_igi.marca='".$marcaBuscar."'
				 and modelos_igi.modelo=precio".$marcaBuscar.".ref
				  WHERE   ref like '%".$palabraBusca."%'
				  and enReserva >0  
				  order by ref ";
		}
		elseif($existencia == "en almacen" and empty($palabraBusca)){
			$sql="SELECT precio".$marcaBuscar.".id, ref, descripcion, precioBase,
				 enReserva,clase, moneda, factor ,case when modelos_igi.igi is null
				 then 0 else modelos_igi.igi end  as igi ,  case when modelos_igi.proveedor
				 is null then 0 else modelos_igi.proveedor end as proveedorModelo
				 FROM Precio".$marcaBuscar." 
				 LEFT JOIN marcadeherramientas on marcadeherramientas.marca
				 ='".$marcaBuscar."'  
				  LEFT JOIN modelos_igi on modelos_igi.marca='".$marcaBuscar."'
				 and modelos_igi.modelo=precio".$marcaBuscar.".ref
				 WHERE enReserva >0 
				  order by ref ";
			}
		
		elseif(empty($existencia)){
				$sql="SELECT precio".$marcaBuscar.".id, ref, descripcion, precioBase,
				 enReserva,clase, moneda, factor ,case when modelos_igi.igi is null
				 then 0 else modelos_igi.igi end  as igi , case when modelos_igi.proveedor
				 is null then 0 else modelos_igi.proveedor end as proveedorModelo
				FROM Precio".$marcaBuscar." LEFT JOIN marcadeherramientas on 
               marcadeherramientas.marca='".$marcaBuscar."' 
			    LEFT JOIN modelos_igi on modelos_igi.marca='".$marcaBuscar."'
				 and modelos_igi.modelo=precio".$marcaBuscar.".ref
			   WHERE descripcion like 
			'%".$palabraBusca."%' or ref like '%".$palabraBusca."%' order by ref  ";

			}
//Codigo para diferenciar por colores las clases de productos en la consulta
		
		
		
			
			//echo $sql;
			$result = mysql_query($sql);
  		       
			while ($row = mysql_fetch_array($result)) {
			
			$color=$row['clase'];
		
			if($color=="E"){
           
			 	$color='#0066FF';
				}
			elseif($color=="D"){
				$color='#FF3333';
				}
			 elseif($color!="D"&&"E"){
				$color='#070707';
				}
		// codigo para calcular igi en base al costo.
	
	
		
$igi_del_modelo=$row['igi'];
if($igi_del_modelo != 0){
		$factor_descuento=&obtener_precio_compra($row['proveedorModelo']);
		if($factor_descuento==0){
		$factor_descuento=1;
		}
		$igi_del_modelo=($row['precioBase']*$factor_descuento)*$igi_del_modelo;
	}



	
		
            echo'<tr style="color:'.$color.'">';
           
			echo "<td>".$marcaBuscar."</td>";
			echo "<td><a href='adm/editarPrecio.php?productor=".$marcaBuscar."
			&id=".$row["id"]."' style='text-decoration: none;'><font color='".$color."'><b>".$row['ref']."</b></font></a>
			</td>";
		
			if($igi_del_modelo != 0){
				echo "<td>".$row['descripcion']." (Este modelo tiene IGI)"."</td>";
				echo "<td>".number_format((($row['precioBase']*
				$row['factor'])+$igi_del_modelo),2,'.',',')."</td>";
				echo "<td><b>".number_format(((($row['precioBase']*
				$row['factor'])+$igi_del_modelo)*(1+$IVA)),2,'.',',').
				"</b></td>";
			}
			else{
				echo "<td>".$row['descripcion']."</td>";
				echo "<td>".number_format(($row['precioBase']*
				$row['factor']),2,'.',',')."</td>";
				echo "<td><b>".number_format((($row['precioBase']*
				$row['factor'])*(1+$IVA)),2,'.',',').
				"</b></td>";
				}
		
	
		    echo "<td>".($row['enReserva'])."</td>";
			echo "<td>".($row['moneda'])."</td>";
			echo "<td>".($row['clase'])."</td>";
			echo "</tr>";
				
			}
			
			
		}
		
		

// funcion para obtener el precio de compra al proveedor
function &obtener_precio_compra($numero_proveedor){

require_once('../incl/connect.php');
	

$sql_factor="SELECT factor_proveedor from factores_proveedores WHERE proveedor='".$numero_proveedor."' ";

$result_factor = mysql_query($sql_factor);

// el factor proveedor comienza en cero
$row_factor_proveedor=0.0;

while($row_factores= mysql_fetch_array($result_factor)){
      

   $factor=  $row_factores["factor_proveedor"];
	// si el factor vale cero solo se suma el primer factor encontrado
	if($row_factor_proveedor==0){
		$row_factor_proveedor+=$factor;
		}
		else{ // si ya tiene almacenado un factor los demas factores se multiplican
   $row_factor_proveedor= $row_factor_proveedor*$factor;
		}

   }
// el factor_proveedor es = a la multiplicacion de los factores de adquisicion
$factor_proveedor= $row_factor_proveedor; 

return $factor_proveedor;
	
	
	}
	
		
?>
</body>
</html>