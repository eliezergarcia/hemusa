<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);
	$client = $_REQUEST["client"];
	$ALL = $_REQUEST["ALL"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Estados de Cuenta</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Eliezer Hernandez">
	<meta name="description" content="Hemusa, herramientas mecanicas y universales">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!--CSS-->    
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Righteous" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.indigo-pink.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="css/buttons.semanticui.min.css">
    <link rel="stylesheet" href="css/select.semanticui.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.0.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/awesomplete.css">

    <!--Javascript-->    
    <script defer src="js/material.min.js"></script> 
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.material.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/fontawesome.js"></script>
	<script src="js/awesomplete.min.js"></script>


    <!-- Librerias para Exportación de Botones -->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script> 
    <script src="js/buttons.html5.min.js"></script>  
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>

</head>
<body onLoad="self.focus();document.agregarCotizacion.clienteContacto.focus()">
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center"><b>Estados de Cuenta</b></h1>
					</div>
				</div>
				<?php 
					echo "<br>";
				    $insertSQL = "SELECT * FROM Cotizacion WHERE factura != 0 AND cliente=".$client." ORDER BY facturaFecha desc";
					$result = mysqli_query($conexion_usuarios, $insertSQL);
					echo "<br>";					
					$insertSQL = "SELECT nombreEmpresa FROM  `contactos` WHERE id =".$client;
					$resultContacto = mysqli_query($conexion_usuarios, $insertSQL);
					$rowContacto = mysqli_fetch_array($resultContacto);
					echo "<center><h3><b>".strtoupper($rowContacto['nombreEmpresa'])."</b></h3></center>";
					$today = getdate(); 
					echo '<br>';
					print("<center><h4>".$today[mday]."/".$today[mon]."/".$today[year]."</h4></center>");
					echo '<br>';
				?>
				<div class="container">
					<?php
						echo '<center><table class="ui celler table display" width="100%">';
						echo '<thead><tr><th>Factura</th><th>Fecha</th><th>Total</th><th>Pago</th><th>Saldo</th><th>Moneda</th></tr></thead>';
						$i=1;
						$total=0;
						$pagado=0;
						$plazo1=0;
						
						while ($row = mysqli_fetch_array($result)) {
					     	if (round($row["precioTotal"]*1.15,2)>1.01*$row["Pagado"] OR $ALL==1) {
						      	echo '<tr>';
								$day = substr($row["facturaFecha"],8,2);
								$month = substr($row["facturaFecha"],5,2);
								$year = substr($row["facturaFecha"],2,2);
								$plazo2=$plazo1;
					        	$plazo1 = -((int)((mktime (0,0,0,$month,$day,$year) - mktime (0,0,0,$today[mon],$today[mday],$today[year]))/86400)).' days';
								
								if ($plazo1>=30 and $plazo2<30) {
									echo '<tr><td colspan=6><center><b>30 dias</b></center></td></tr>';
								}elseif ($plazo1>=60 and $plazo2<60) {
									echo '<tr><td colspan=6><center><b>60 dias</b></center></td></tr>';
								}elseif ($plazo1>=90 and $plazo2<90) {
									echo '<tr><td colspan=6><center><b>90 dias</b></center></td></tr>';
					        	}
								
								echo '<td height="30" valign="bottom" >'.$row["factura"].'</td><td valign="bottom" align="right">'.substr($row["facturaFecha"],8,2).'-'.substr($row["facturaFecha"],5,2).'-'.substr($row["facturaFecha"],2,2).'</td><td valign="bottom" align="right">';
									echo round($row["precioTotal"]*1.15,2);
					 			$TAL=round($row["precioTotal"]*1.15,2);
							 	$tal = ROUND($TAL,2);
							 	if (strstr($tal,".")) {
									$len = strlen($tal);
									if (substr($tal,strlen($tal)-2,1)==".") {
					         	 		echo "0";
					           		}
					       		}else{
								 	echo ".00";
					        	} 
								
								echo '</td><td valign="bottom"  align="right">-';
								echo '</td><td valign="bottom"  align="right">';
								$deuda=round(round($row["precioTotal"]*1.15,2)-$row["Pagado"],2);
								
								if ($deuda<0) {
									echo '0.00';
								}else{
									echo $deuda;
					 				$TAL=$deuda;
							 		$tal = ROUND($TAL,2);
							 		
							 		if (strstr($tal,".")) {
									 	$len = strlen($tal);
										if (substr($tal,strlen($tal)-2,1)==".") {
					         	 	    	echo "0";
					              		}
					              	}else{
								 		echo ".00";
					           		} 
								}	 
									
								echo '</td><td valign="bottom" >'.$row["moneda"].'</td></tr>';
								$insertSQL='select * from payments where factura = '.$row["factura"].' order by date desc';
							    $resultPayment = mysqli_query($conexion_usuarios, $insertSQL);
								while ($rowPayment = mysqli_fetch_array($resultPayment)) {
									$deuda+=$rowPayment["amount"];
									echo '<tr><td><center>-</center></td><td>'.substr($rowPayment["date"],8,2).'-'.substr($rowPayment["date"],5,2).'-'.substr($rowPayment["date"],2,2).'</td><td></td><td align=right>'.$rowPayment["amount"].'</td><td align=right>-</td><td></td></tr>';
								}
								
								if ($row["moneda"]=='mxn') {
									$total+=$row["precioTotal"]*1.15;
								    $pagado+=$row["Pagado"];
								}else{
									$total+=$row["precioTotal"]*1.15*11;
								   	$pagado+=$row["Pagado"]*11;
								}
							
								$i++;
							}
					   	}
						echo '</table></center>';
						echo '<br>';
						$deudatotal=round($total,2)-round($pagado,2);
					    echo "<center><big>Total + IVA: <b>".round($total,2)."</b> / Pagado: <b>".round($pagado,2)."</b><br>Saldo: <b>".$deudatotal." </b></big></center><br>";
						mysqli_close($conexion_usuarios);
					    echo '<center><a href="estadoDeCuenta.php?ALL=1&client='.$client.'">TODO</a></center>';
					?>
				</div>
		</div>
	</main>
</body>
</html>
