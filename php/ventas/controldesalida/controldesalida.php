<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);

	if(isset($_REQUEST['modificarPedimento'])){
		// echo $_REQUEST['numeroImportacion'];
		// echo $_REQUEST['numeroFolio'];
		// echo $_REQUEST['numeroPedimento'];
		$insertarDatos = mysqli_query($conexion_usuarios, "UPDATE pedimentos SET numeroImportacion = ".$_REQUEST['numeroImportacion'].", numeroFolio = ".$_REQUEST['numeroFolio']." WHERE numero_pedimento =".$_REQUEST['numeroPedimento']);
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Importación</title>
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
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center titulo">Control de Salida de Herramienta</h1>
					</div>
				</div>	
				<br>
				<div class="container-fluid col mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
				  	<header class="mdl-layout__header">
				    	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
					      	<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Importación</a>
					      	<a href="#fixed-tab-2" class="mdl-layout__tab">Compra Nacional</a>
				    	</div>
				  	</header>
				  	<main class="mdl-layout__content">
				    	<section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
				      		<div class="page-content">
				      			<br>
				      			<div class="container">
									<div id="cuadroCotizaciones" class="">
										<div class="col-sm-offset-2 col-sm-8">
											<h3 class="text-center"> <small class="mensaje"></small></h3>
										</div>
										<div class="">
											<table id="dt_control_salida" class="ui celler table table-hover display start-xs" cellspacing="0" width="100%">
												<thead>
													<tr>								
														<th>Pedimento</th>
														<th>Fecha Enviado</th>
														<th># Importación</th>
														<th># Folio</th>
														<th>Editar</th>
														<th>Terminado</th>
														<th>Ver</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$queryControl = "SELECT * FROM pedimentos ORDER BY id DESC";
													$resultadoControl = mysqli_query($conexion_usuarios, $queryControl);
													$i=1;
													while($row=mysqli_fetch_array($resultadoControl)){
														
												?>
													<tr>
														<td><?php echo $row['numero_pedimento']; ?>
														</td>
														<td><?php echo $row['fecha'] ?></td>
														<form action="controldesalida.php" method="POST">
															<td>
																<input name="numeroPedimento" type="hidden" value="<?php echo $row['numero_pedimento']; ?>">
																<input name="numeroImportacion" type="text" class="form-control" value="<?php echo $row['numeroImportacion']; ?>">	
															</td>
															<td>
																<input name="numeroFolio" type="text" class="form-control" value="<?php echo $row['numeroFolio']; ?>">
															</td>
															<td><button type="submit" name="modificarPedimento" class="btn btn-outline-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
														</form>
														<td class="row justify-content-center">
															<input type="checkbox" class="form-control">
														</td>
														<td><a href="importacion.php?numeroPedimento=<?php echo $row['numero_pedimento']; ?>"><button class="btn btn-outline-info"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
													</tr>
												<?php
													}
												?>
												</tbody>
												<tfoot>
										        </tfoot> 
											</table>
										</div>	
									</div>		
								</div>
				      		</div>
				    	</section>
				    	<section class="mdl-layout__tab-panel" id="fixed-tab-2">
				      		<div class="page-content">
				      			<br>
				      			<div class="container">
									<div id="cuadroCotizaciones" class="">
										<div class="col-sm-offset-2 col-sm-8">
											<h3 class="text-center"> <small class="mensaje"></small></h3>
										</div>
										<div class="">
											<table id="dt_compra_nacional" class="ui celler table table-hover display start-xs" cellspacing="0" width="100%">
												<thead>
													<tr>								
														<th>Factura</th>
														<th>Ver</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$queryCompraNacional = "SELECT DISTINCT factura_proveedor FROM utilidad_pedido ORDER BY id DESC";
													$resultadoCompraNacional = mysqli_query($conexion_usuarios, $queryCompraNacional);
													while($row=mysqli_fetch_array($resultadoCompraNacional)){
														
												?>
													<tr>
														<td><?php echo $row['factura_proveedor']; ?></td>
														<td><a href="compra_nacional.php?factura=<?php echo $row['factura_proveedor']; ?>"><button class="btn btn-outline-info"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
													</tr>
												<?php
													}
												?>
												</tbody>
												<tfoot>
										        </tfoot> 
											</table>
										</div>	
									</div>		
								</div>
				      		</div>
				    	</section>
				  	</main>
				</div>

				
      		</main>
    </div>
</body>
</html>
 
	<script>
		$(document).on("ready", function(){
			$('[data-toggle="tooltip"]').tooltip();

			$('#dt_control_salida tfoot th').each( function () {
        		var title = $(this).text();
        		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      		});

			var table = $("#dt_control_salida").DataTable({
				"destroy":"true",
				"bDeferRender": true,			
				"sPaginationType": "full_numbers",
				"order":[[1, "desc"]],
		        "language": idioma_espanol,
		        "lengthChange": false,
		        "columnDefs": [
		          { "searchable": true, "targets": 0 }
		        ],
				"language": idioma_espanol,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
					"<'clear'>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                messageTop: 'Compra Nacional',
		                download: 'open',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
			});

			$("#dt_control_salida tfoot input").on( 'keyup change', function () {
        		table
            		.column( $(this).parent().index()+':visible' )
            		.search( this.value )
            		.draw();		
    		});

    		$('#dt_compra_local tfoot th').each( function () {
        		var title = $(this).text();
        		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      		});

			var table = $("#dt_compra_local").DataTable({
				"destroy":"true",
				"bDeferRender": true,			
				"sPaginationType": "full_numbers",
				"order": [[0, "asc"]],
		        "language": idioma_espanol,
		        "lengthChange": false,
		        "columnDefs": [
		          { "searchable": true, "targets": 0 }
		        ],
				"language": idioma_espanol,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
					"<'clear'>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                messageTop: 'Compra Nacional',
		                download: 'open',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
			});

			$("#dt_compra_local tfoot input").on( 'keyup change', function () {
        		table
            		.column( $(this).parent().index()+':visible' )
            		.search( this.value )
            		.draw();		
    		});

    		$('#dt_compra_nacional tfoot th').each( function () {
        		var title = $(this).text();
        		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      		});

			var table = $("#dt_compra_nacional").DataTable({
				"destroy":"true",
				"bDeferRender": true,			
				"sPaginationType": "full_numbers",
				"order":[[1, "desc"]],
		        "language": idioma_espanol,
		        "lengthChange": false,
		        "columnDefs": [
		          { "searchable": true, "targets": 0 }
		        ],
				"language": idioma_espanol,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
					"<'clear'>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                messageTop: 'Compra Nacional',
		                download: 'open',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
			});

			$("#dt_compra_nacional tfoot input").on( 'keyup change', function () {
        		table
            		.column( $(this).parent().index()+':visible' )
            		.search( this.value )
            		.draw();		
    		});
		});

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
	</script>