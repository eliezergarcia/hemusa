<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Utilidad o Perdida Cambiarias</title>
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

    <script src="js/zelect.js"></script>

</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center"><b>Reportes</b></h1>
					</div>
				</div>	
				<br>
				<div class="container row justify-content-center">
					<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Seleccionar
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <a class="dropdown-item" data-toggle="collapse" href="#collapseReporteVentas" role="button" aria-expanded="false" aria-controls="collapseExample">Reporte Ventas</a>
						    <a class="dropdown-item" data-toggle="collapse" href="#collapseReportePagos" role="button" aria-expanded="false" aria-controls="collapseExample">Reporte Pagos</a>
						    <a class="dropdown-item" data-toggle="collapse" href="#collapseEstadosCuenta" role="button" aria-expanded="false" aria-controls="collapseExample">Estados de Cuenta</a>
						    <a class="dropdown-item" data-toggle="collapse" href="#collapseUtilidad" role="button" aria-expanded="false" aria-controls="collapseExample">Utilidad o Pérdida Cambiaria</a>
					  	</div>
					</div>
				</div>
				<br>
				<div class="collapse container col-6" id="collapseUtilidad">
				  	<div class="card card-body row justify-content-center">
				  	 	<form action="utilidadoperdidacambiaria.php" class="row justify-content-center">
				  	 			<h4 class="form-group">Generar reporte de Utilidad o Pérdida cambiaria</h4><br>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
					  	 			<label class="row col-2">Fecha inicio: </label>
					  	 			<input name="fechaInicio" type="date" class="form-control row col-3"><br>
				  	 			</div>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
					  	 			<label class="row col-2">Fecha final: </label>
					  	 			<input name="fechaFinal" type="date" class="form-control row col-3">
					  	 		</div>
					  	 		<br>
					  	 		<button type="submit" class="btn btn-primary form-group">Mostrar</button>
				  	 	</form>
				  	</div>
				</div>
				<div class="collapse container col-6" id="collapseReporteVentas">
				  	<div class="card card-body">
				  	 	<form action="reporteventas.php" class="row justify-content-center">
					  	 		<h4 class="form-group">Generar reporte de Ventas</h4><br>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
					  	 			<label class="row col-2">Fecha inicio: </label>
					  	 			<input name="fechaInicio" type="date" class="form-control row col-3"><br>
				  	 			</div>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
					  	 			<label class="row col-2">Fecha final: </label>
					  	 			<input name="fechaFinal" type="date" class="form-control row col-3">
					  	 		</div>
					  	 		<br>
					  	 		<button type="submit" class="btn btn-primary form-group">Mostrar</button>
				  	 	</form>
				  	</div>
				</div>
				<div class="collapse container col-6" id="collapseReportePagos">
				  	<div class="card card-body ">
				  	 	<form action="reportePago.php" class="row justify-content-center" enctype="multipart/form-data" method="post">
				  	 			<h4 class="form-group">Generar reporte de Pagos</h4><br>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
				  	 				<label class="row col-2">Banco: </label>
				  	 			<?php
				  	 				$result = mysqli_query($conexion_usuarios, "SELECT * FROM accounts");
   									echo '<select name="account" class="small form-control col-4" onChange="document.payment.submit()"><option value="" selected="selected">------Eligir------</option>';
   									while ($row = mysqli_fetch_array($result)) {
      									if ($row['id']==$account) {
				 							echo '<option value="'.$row['id'].'" >'.$row['id'].' - '.substr($row['nombre'],0,10).'</option>';
										} else {
         									echo '<option value="'.$row['id'].'">'.$row['id'].' - '.substr($row['nombre'],0,10).'</option>';
										}
   									}
   									echo '</select>';
 								?> 
 								</div>
 								<div class="col-12 row justify-content-center align-items-center form-group">
					  	 			<label class="row col-2">Subir archivo: </label>
					  	 			<input id="archivo" name="archivo" type="file" class="form-control row col-4 justify-content-center">
					  	 			<input name="MAX_FILE_SIZE" type="hidden" value="20000" /> 
					  	 		</div>
					  	 		<button type="submit" name="enviar" class="btn btn-primary form-group">Mostrar</button>
				  	 	</form>
				  	</div>
				</div>
				<div class="collapse container col-6" id="collapseEstadosCuenta">
				  	<div class="card card-body ">
				  	 	<form action="estadoDeCuenta.php" class="row justify-content-center">
				  	 			<h4 class="form-group">Generar Estados de Cuenta</h4><br>
				  	 			<div class="col-12 row justify-content-center align-items-center form-group">
				  	 				<label class="row col-2">Cliente: </label>
				  	 			<?php
				  	 			$result = mysqli_query($conexion_usuarios, "SELECT * FROM Contactos WHERE tipo='cliente' ORDER BY nombreEmpresa ");
								echo '<select name="client" class="small form-group col-4 form-control" onChange="document.payment.submit()">';
								if ($client=='') {
									echo '<option value="" selected="selected">------Eligir------</option>';
								}
								if(isset($palabraBusca)){   
								    while ($row = mysqli_fetch_array($result)) {	 		
										$test=strtolower($row['nombreEmpresa'].$row['personaContacto'].$row['calle'].$row['ciudad'].$row['estado'].$row['cp'].$row['pais'].$row['tlf1'].$row['tlf2'].$row['fax'].$row['movil'].$row['correoElectronico'].$row['paginaWeb'].$row['RFC'].$row['tipo'].$row['codigo']);
										$find=strtolower($palabraBusca);
										$findLen = strlen($find);
										$testLen = strlen($test);
										$subTest=substr($test, 0, $findLen);
										$i=0;
										$a=0;
										while ($i<($testLen-$findLen+1)) {
								  		    $subTest=substr($test, $i, $findLen);
								  		    if (strcmp($find,$subTest)==0 and $a!=1) {
									            if ($row['category']==$cat || $cat=='') {
								                   	echo '<option value="'.$row['id'].'">'.substr($row['nombreEmpresa'],0,40).'</option>';
										        }
												$a=1;
											}
											$i++;
										}			
								    }
								}else{
								    while ($row = mysqli_fetch_array($result)) {
										if ($row['id']==$client) {
								         	echo '<option value="'.$row['id'].'" selected="selected">'.utf8_encode(substr($row['nombreEmpresa'],0,40)).'</option>';
										}else{
								         	echo '<option value="'.$row['id'].'">'.utf8_encode(substr($row['nombreEmpresa'],0,40)).'</option>';
										}
								   }
								}
								echo '</select>';
								?> 
 								</div>
					  	 		<button type="submit" name="Estado de Cuenta" class="btn btn-primary form-group" value="Estado de Cuenta">Mostrar</button>
				  	 	</form>
				  	</div>
				</div>
			</div>
		</main>
</body>
</html>	

	<!-- <script>
		$(document).on("ready", function(){
			listar();
		});

		var  listar = function(){
			$("#cuadro2").slideUp("slow");
			$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php" 
				},
				"columns":[
					{"data":"user"},
					{"data":"password", "sortable": false},
					{"data":"nombre"},
					{"data":"apellidos", "sortable": false},
					{"data":"dp", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false},
					{"data":"nivel", "sortable": false}
				],
				"language": idioma_espanol,
				"dom": 'Bfrtip',
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf"
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel"
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv"
		            }
				]
			});
		}

		var idioma_espanol = {
			"sProcessing":     "Procesando...",
   			"sLengthMenu":     "Mostrar _MENU_ registros",
    		"sZeroRecords":    "No se encontraron resultados",
    		"sEmptyTable":     "Ningún dato disponible en esta tabla",
    		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix":    "",
    		"sSearch":         "Buscar:",
    		"sUrl":            "",
    		"sInfoThousands":  ",",
    		"sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
	</script> -->
</body>
</html>
