<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="es">
<title>Movimientos</title>
<head>
	<meta charset="UTF-8">
	<?php include('../../enlaces.php'); ?>
</head>
<body>
		<?php include('../../header.php'); ?>
			<main class="mdl-layout__content">
    			<div class="page-content">
				<!-- Breadcrumb -->
	    			<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">				    	
					    	<li class="breadcrumb-item">Administración</li>
					    	<li class="breadcrumb-item active">Movimientos de usuarios</li>
					    </ol>
					</nav>
				
				<!-- Encabezado -->
					<div class="col-12 row justify-content-center">
						<h1><b>Movimientos de usuarios</b></h1><br>
					</div>
					<div class="col-12 row justify-content-center">
						<p>Aquí se muestran todos los movimientos realizados por los usuarios.</p>
					</div>

				<!-- Botones de buscar -->
					<br>
					<div class="col-12 row justify-content-center">
						<div>
							<form id="frmBuscar" action="#" class="">
								<div class="form-group row">
									<input type="datetime-local" id="fechainicio" name="fechainicio" class="form-control" placeholder="Fecha y hora inicio">
								</div>
								<div class="form-group row">
									<input type="datetime-local" id="fechafin" name="fechafin" class="form-control" placeholder="Fecha y hora fin">
								</div>
								<div class="form-group row justify-content-center">
									<button type="button" id="buscar" name="buscar" class="btn btn-primary">Buscar</button>
								</div>
							</form>
						</div>
					</div>

				<!-- Tabla de movimientos -->
					<br><br><br>
					<table id="dt_movimientos" class="ui table table-hover display compact" width="100%">
						<thead>
							<tr>
								<th>Cotización</th>
								<th>Pedido</th>
								<th>Remisión</th>
								<th>Factura</th>
								<th>Departamento</th>
								<th>Usuario</th>
								<th>Tipo de movimiento</th>
								<th>Descripción</th>
								<th>Fecha y Hora</th>
							</tr>
						</thead>
					</table>

				</div>
			</main>
		</body>
</body>
</html>
	<script>
		$(document).on("ready", function(){
			listar();
		});

		var listar = function(){
			$("#buscar").on("click", function(e){
				e.preventDefault();
				var fechainicio = $("#frmBuscar #fechainicio").val();
				var fechafin = $("#frmBuscar #fechafin").val();
				var table = $("#dt_movimientos").DataTable({
					"destroy":"true",
					"ajax":{
						"method":"POST",
						"url":"listar.php",
						"data": {"fechainicio": fechainicio, "fechafin": fechafin},
					},
					"columns":[
						{"data": "cotizacion"},
						{"data": "pedido"},
						{"data": "remision"},
						{"data": "factura"},
						{"data": "departamento"},
						{"data": "usuario"},
						{"data": "tipomovimiento"},
						{"data": "descripcion"},
						{"data": "fechahora"}
					],
					"order": [[8, "desc"]],
					"language": idioma_espanol,
					"dom":  
						"<'col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
						"<'col-12 row'<'justify-content-center col-12 buttons'tr>>" +
						"<'col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
					"buttons":[
			            {
			                extend:    'pdfHtml5',
			                text:      '<i class="fa fa-file-pdf-o"></i>',
			                titleAttr: 'PDF',
			                "className": "btn iconopdf",
			                title: '',
			            	exportOptions: {
	                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
	            			}
			            },
						{
			                extend:    'excelHtml5',
			                text:      '<i class="fa fa-file-excel-o"></i>',
			                titleAttr: 'Excel',
			                "className": "btn iconoexcel",
			                title: '',
			            	exportOptions: {
	                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
	            			}
			            },
			            {
			            	extend: 'csvHtml5',
			            	text: '<i class="fa fa-file-text-o"></i>',
			            	titleAttr: 'CSV',
			            	"className": "btn iconocsv",
			            	title: '',
			            	exportOptions: {
	                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
	            			}
			            },
			            {
			            	extend: 'print',
			            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            	titleAttr: 'Imprimir',
			            	header: 'false',
			            	title: '',
			            	exportOptions: {
	                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
	            			},
	            			"className": "btn iconoimprimir",
	            			orientation: 'landscape',
	            			pageSize: 'LEGAL',
	            			customize: function(window) {
	                            $(window.document.body).children().eq(0).after(document.getElementById("encabezado"));
	                        }
			            }		            
					]
				});
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
	</script>
</body>
</html>
