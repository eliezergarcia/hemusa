<?php 
	include("../../inicio.php");
	include("../../conexion.php");
?>


<div class="container-fluid center-xs contenido">
        <div class="row center-xs start-sm enlaces">
          <a href="../../inicio.php">Inicio</a>
          <p>></p>
          <a href="precios.php">Lista de precios</a>
          <p>></p>
          <a href="solicitudes_creadas.php">Solicitudes de inventario</a>
        </div>
        <div class="row center-xs between-lg encabezado">
          <div class="row middle-xs titulo">
            <h2>Solicitud de inventario</h2>
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
       <?php 




if($nivel_usuario==0){
	// si el usuario es administrador, procede a mostrar las solicitudes creadas por los demas usuarios.
	
	mostrar_solicitudes();
	
	}
	else{
		// si el usuario no es administrador, lanza un mensaje y redirecciona
	 echo"<script>alert('No tiene acceso a solicitudes contacte al administrador')</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=../precios.php\">"; 	
		}
if(!empty($_GET['id_solicitud_aprobada'])){ // si se presiono el id de alguna solitud para aprobarla
	// se almacena el id con los datos se la marca y modelo , y se modifica el inventario
	$id_solicitud=$_GET['id_solicitud_aprobada'];
	modificar_inventario($id_solicitud);
}

if(!empty($_GET['id_solicitud_rechazada'])){ // si se presiono el id de alguna solitud para aprobarla
	// se almacena el id con los datos se la marca y modelo , y se modifica el inventario
	$id_solicitud=$_GET['id_solicitud_rechazada'];
	modificar_solicitud($id_solicitud);
}

?>

<?php


function mostrar_solicitudes(){
	// funcion que imprime las solicitudes creasas por los usuarios, y que esten pendientes
	
	echo "<br><br><center><h2> SOLICITUD DE AJUSTE DE INVENTARIO </h2></center>";
	$con = new mysqli("localhost", "root", "", "hemusa");
	$sql_solicitud_inventario = "SELECT * FROM solicitud_inventario WHERE solicitud_aprobada = 'pendiente'  ORDER BY fecha ";

	$res_solicitud= mysqli_query($con, $sql_solicitud_inventario);

	echo '<center><table  border="1" cellpadding="1px" cellspacing="1" summary="" frame="border" >';
    echo '<th> Marca </th>';
    echo '<th> Modelo </th>';
	echo '<th> Almacen </th>';
    echo '<th> Cantidad Solicitud </th>';
	echo '<th> Acci&oacute;n </th>';
	echo '<th> Cantidad Resultado</th>';
    echo '<th> Motivo </th>';
	echo '<th> Contacto Hemusa </th>';
	echo '<th> Fecha y Hora </th>';
	echo '<th> Aprobar </th>';		
	echo '<th> Rechazar </th>';				
	
	while($row_solicitud=mysqli_fetch_array($res_solicitud)){
	
	$id=$row_solicitud['id'];	
	
    $id_modelo=$row_solicitud['id_modelo'];	
	$marca=$row_solicitud['marca'];	
    $modelo=$row_solicitud['modelo'];	
	$cantidad=$row_solicitud['cantidad'];	
	$accion=$row_solicitud['accion'];	
	$motivo=$row_solicitud['motivo'];
	$contacto_hemusa=$row_solicitud['contacto_hemusa'];	
	$fecha=$row_solicitud['fecha'];	
	$solicitud_aprobada=$row_solicitud['solicitud_aprobada'];		
////////////query y while para obtener el stock que se quiere modificar en la solicitud
$sql_inventario="SELECT * FROM precio".$marca." WHERE id='".$id_modelo."' ";
$result_inventario=mysqli_query($con, $sql_inventario);
		
while($row_inventario=mysqli_fetch_array($result_inventario)){
	$cantidad_actual=$row_inventario['enReserva'];	
}
//////fin del query y while para obtener la cantidad de almacen

	// informacion de la solicitud, del modelo que se quiere modificar existencia
	echo "<tr>";
	echo '<td> '.$marca.' </td>';
	echo '<td> '.$modelo.' </td>';
	echo '<td> <center>'.$cantidad_actual.' </center></td>';
	echo '<td> <center>'.$cantidad.' </center></td>';
	echo '<td><font color="red"> '.$accion.' </font></td>';
	if($accion == "sumar"){
			echo '<td> <center>'.($cantidad_actual+$cantidad).' </center></td>';
		}
		else{
				echo '<td> <center>'.($cantidad_actual-$cantidad).' </center></td>';
						}
	echo '<td> '.$motivo.' </td>';
	echo '<td> '.$contacto_hemusa.' </td>';
	echo '<td> '.$fecha.' </td>';

	
    echo '<td><B> <a  style="text-decoration: none;" href="solicitudes_creadas.php?id_solicitud_aprobada='.$id.'" >Aprobar</a></B></td>';
	
    echo '<td><B> <a  style="text-decoration: none;" href="solicitudes_creadas.php?id_solicitud_rechazada='.$id.'" >Rechazar</a></B></td>';
	
	}
	echo '</table></center>';
	}
	
	
	?>
  
</body>
</html>
<?php	
	function modificar_inventario($id_solicitud){
		require_once('../../incl/connect.php');
$sql="SELECT * FROM solicitud_inventario WHERE id='".$id_solicitud."' ";
		$result=mysql_query($sql);

		
while($row=mysql_fetch_array($result)){
	
	$id=$row['id'];	
    $id_modelo=$row['id_modelo'];	
	$marca=$row['marca'];	
    $modelo=$row['modelo'];	
	$cantidad=$row['cantidad'];	
	$accion=$row['accion'];	
	$motivo=$row['motivo'];
	$contacto_hemusa=$row['contacto_hemusa'];	
	$fecha=$row['fecha'];	
	$solicitud_aprobada=$row['solicitud_aprobada'];		
$sql_inventario="SELECT * FROM precio".$marca." WHERE id='".$id_modelo."' ";

$result_inventario=mysql_query($sql_inventario);

		
while($row_inventario=mysql_fetch_array($result_inventario)){
	$cantidad_actual=$row_inventario['enReserva'];	
}
	if($accion=="sumar"){
		$cantidad=$cantidad+$cantidad_actual;
		$sql_sumar="UPDATE precio".$marca." SET `enReserva` = ".$cantidad." WHERE id = '".$id_modelo."'";

		 if(!$resultado = mysql_query($sql_sumar)) {
			echo"<script>alert('Error al  modificar inventario ')</script>";	

			 }
		}
		
		elseif($accion=="restar"){
			$cantidad=$cantidad_actual-$cantidad;
			$sql_restar="UPDATE precio".$marca." SET `enReserva` = ".$cantidad." WHERE id = '".$id_modelo."'";
		
		 if(!$resultado = mysql_query($sql_restar)) {
			echo"<script>alert('Error al  modificar inventario ')</script>";	

			 }
		
			}

}
	$sql_aprobar="UPDATE `solicitud_inventario` SET `solicitud_aprobada` = 'aprobada' WHERE id = '".$id_solicitud."'";
 if(!$resultado = mysql_query($sql_aprobar)) {
	echo"<script>alert('Error al  aprobar solicitud ')</script>";	

 }
	
		 echo"<script>alert('La solicitud se aprobo correctamente')</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitudes_creadas.php\">"; 
			

	
		
		}
		
		
		
		function modificar_solicitud($id_solicitud){
			
			require_once('../../incl/connect.php');
$sql_no_aprobar="UPDATE `solicitud_inventario` SET `solicitud_aprobada` = 'no aprobada' WHERE id = '".$id_solicitud."'";
 		if(!$resultado = mysql_query($sql_no_aprobar)) {
			echo"<script>alert('Error al  rechazar solicitud ')</script>";	
			}
	
		 echo"<script>alert('La solicitud se rechazo correctamente')</script>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;URL=solicitudes_creadas.php\">"; 
			
			}
		
		
	echo '	<center><br><b><a href="../precios.php">Listas de Precios</a></b></center>';
 ?> 
