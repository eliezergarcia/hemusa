<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);

	$noEntregado = $_REQUEST["noEntregado"];
	$noPagado = $_REQUEST["noPagado"];
	$Terminado = $_REQUEST["Terminado"];
	$busca = $_REQUEST["busca"];

?>
<!DOCTYPE html>
</html>
<head>
	<title>Pedidos</title>
	<?php include("../../enlaces.php"); ?>
</head>
<body>
	<?php include("../../header.php"); ?>
		<main class="mdl-layout__content">  		
			<!-- Encabezado -->
				<br><center><h1><b>Pedidos</b></h1></center><br>

			
			<!-- Boton de Buscar -->
				<form class="form-horizontal row justify-content-center" action="pedidos.php" method="post">
					<div class="form-group col-12 row justify-content-center">
						<input type="text" class="form-control col-2" name="buscar" id="buscar" placeholder="Buscar">
					</div>
					<!-- <div class="form-group col-12 row justify-content-center">
						<input class="btn btn-primary" type="submit" value="Buscar" />
					</div> -->
				</form>
			
			<!-- Grupo de botones -->
				<div class="row justify-content-center">
					<div class="row justify-content-center" data-toggle="buttons">
						<button class="btn btn-primary" onclick="listar_sinproveedor()">SIN PROVEEDOR</button>
					  	<button class="btn btn-primary" onclick="listar_noentregado()">NO ENTREGADO</button>
						<button class="btn btn-primary" onclick="listar_nopagado()">NO PAGADO</button>
						<button class="btn btn-primary" onclick="listar_terminado()">TERMINADO</button>
					</div>
				</div>
			
			<!-- Tabla de No entregado -->
				<br>
				<div id="noentregado">
					<center><h4><b>Pedidos con herramienta sin entregar</b></h4></center><br>
					<table id="dt_noentregado" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Cotizacion</th>
								<th>Pedido</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Vendedor</th>
								<th>Fecha</th>
								<th>Partidas</th>
								<th>Total</th>
								<th>Ver</th>
							</tr>
						</thead>
					</table>
				</div>
			
			<!-- Tabla de sin proveedor -->
				<br>
				<div id="sinproveedor">
					<center><h4><b>Pedidos con herramienta sin proveedor</b></h4></center><br>
					<table id="dt_sinproveedor" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Cotizacion</th>
								<th>Pedido</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Vendedor</th>
								<th>Fecha</th>
								<th>Partidas</th>
								<th>Total</th>
								<th>Ver</th>
							</tr>
						</thead>
					</table>
				</div>
			
			<!-- Tabla de nopagado -->
				<br>
				<div id="nopagado">
					<center><h4><b>Pedidos no pagados</b></h4></center><br>
					<table id="dt_nopagado" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Cotizacion</th>
								<th>Pedido</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Vendedor</th>
								<th>Fecha</th>
								<th>Partidas</th>
								<th>Total</th>
								<th>Ver</th>
							</tr>
						</thead>
					</table>
				</div>

			<!-- Tabla de nopagado -->
				<br>
				<div id="terminado">
					<center><h4><b>Pedidos terminados</b></h4></center><br>
					<table id="dt_terminado" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Cotizacion</th>
								<th>Pedido</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Vendedor</th>
								<th>Fecha</th>
								<th>Partidas</th>
								<th>Total</th>
								<th>Ver</th>
							</tr>
						</thead>
					</table>
				</div>

			<!-- Modal OC Pendientes -->		
				<div class="modal fade" id="modalOCPendientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="col-12 row justify-content-center">
									<div class="form-group row justify-content-center col-12">
										<label class="control-label">Proveedores con herramienta sin entregar y sin crear OC</label>
									</div>
									<div class="form-group row justify-content-center col-12">
										<select name="proveedoressinoc" id="proveedoressinoc" class="form-control col-6" onchange="verproveedor2()"></select>
									</div>
								</div>				      		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

		</main>
	</div>
</body>
</html>
	
<script>
	$(document).on("ready", function(){	
		buscar_oc_pendientes();
		setInterval(buscar_oc_pendientes, 3000);
		listar_sinproveedor();
	});

	var listar_sinproveedor = function(){
		$("#noentregado").slideUp("slow");
		$("#sinproveedor").slideDown("slow");
		$("#nopagado").slideUp("slow");
		$("#terminado").slideUp("slow");
		var buscar = $("#buscar").val();
		var opcion = "sinproveedor";
		console.log(buscar);
		console.log(opcion);
			var table = $("#dt_sinproveedor").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "buscar": buscar}
				},
				"columns":[
					{"data": "cotizacionRef"},
					{"data": "numeroPedido"},
					{"data": "nombreEmpresa"},
					{"data": "contacto"},
					{"data": "vendedor"},
					{"data": "fecha"},
					{"data": "partidas"},
					{"data": "total"},
					{"defaultContent": "<button class='verpedido btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
				"order": [5, "desc"],
		        "language": idioma_espanol,
		        "dom":  
					"<'col-12 row justify-content-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'col-12 row justify-content-center'<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row justify-content-center'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			title: '',
            			customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulonoentregado"));
                        }
		            }
				]
			});
		verpedido("#dt_sinproveedor tbody", table);
	}

	var listar_noentregado = function(){
		$("#noentregado").slideDown("slow");
		$("#sinproveedor").slideUp("slow");
		$("#nopagado").slideUp("slow");
		$("#terminado").slideUp("slow");
		var buscar = $("#buscar").val();		
		var opcion = "noentregado";
		console.log(buscar);
		console.log(opcion);
			var table = $("#dt_noentregado").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "buscar": buscar}
				},
				"columns":[
					{"data": "cotizacionRef"},
					{"data": "numeroPedido"},
					{"data": "nombreEmpresa"},
					{"data": "contacto"},
					{"data": "vendedor"},
					{"data": "fecha"},
					{"data": "partidas"},
					{"data": "total"},
					{"defaultContent": "<button class='verpedido btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
				"order": [5, "desc"],
		        "language": idioma_espanol,
		        "dom":  
					"<'col-12 row justify-content-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'col-12 row justify-content-center'<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row justify-content-center'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			title: '',
            			customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulonoentregado"));
                        }
		            }
				]
			});
		verpedido("#dt_noentregado tbody", table);
	}

	var listar_nopagado = function(){
		$("#noentregado").slideUp("slow");
		$("#sinproveedor").slideUp("slow");
		$("#nopagado").slideDown("slow");
		$("#terminado").slideUp("slow");
		var buscar = $("#buscar").val();
		var opcion = "nopagado";
		console.log(opcion);
		console.log(buscar);
			var table = $("#dt_nopagado").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "buscar": buscar}
				},
				"columns":[
					{"data": "cotizacionRef"},
					{"data": "numeroPedido"},
					{"data": "nombreEmpresa"},
					{"data": "contacto"},
					{"data": "vendedor"},
					{"data": "fecha"},
					{"data": "partidas"},
					{"data": "total"},
					{"defaultContent": "<button class='verpedido btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
				"order": [5, "desc"],
		        "language": idioma_espanol,
		        "dom":  
					"<'col-12 row justify-content-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'col-12 row justify-content-center'<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row justify-content-center'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			title: '',
            			customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulonoentregado"));
                        }
		            }
				]
			});
		verpedido("#dt_nopagado tbody", table);
	}

	var listar_terminado = function(){
		$("#noentregado").slideUp("slow");
		$("#sinproveedor").slideUp("slow");
		$("#nopagado").slideUp("slow");
		$("#terminado").slideDown("slow");
		var buscar = $("#buscar").val();
		var opcion = "terminado";
		console.log(opcion);
			var table = $("#dt_terminado").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "buscar": buscar}
				},
				"columns":[
					{"data": "cotizacionRef"},
					{"data": "numeroPedido"},
					{"data": "nombreEmpresa"},
					{"data": "contacto"},
					{"data": "vendedor"},
					{"data": "fecha"},
					{"data": "partidas"},
					{"data": "total"},
					{"defaultContent": "<button class='verpedido btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
				"order": [5, "desc"],
		        "language": idioma_espanol,
				// "language": {
				// 	"lengthMenu": "Display _MENU_ records per page",
				// 	"zeroRecords": "Nothing found - sorry",
				// 	"info": "Showing page _PAGE_ of _PAGES_",
				// 	"infoEmpty": "Ningún dato disponible en esta tabla",
				// 	"infoFiltered": "(filtered from _MAX_ total records)"
				// },
		        "dom":  
					"<'col-12 row justify-content-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'col-12 row justify-content-center'<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row justify-content-center'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			title: '',
            			customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulonoentregado"));
                        }
		            }
				]
			});
		verpedido("#dt_terminado tbody", table);
	}

	var verpedido = function(tbody, table){
		$(tbody).on("click", "button.verpedido", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			window.location=("verPedido.php?refCotizacion="+data.cotizacionRef+"&numeroPedido="+data.numeroPedido);	
		});
	}

	var idioma_espanol = {
		"processing":     "Procesando...",
		"lengthMenu":     "Mostrar _MENU_ registros",
		// "loadingRecords": "Cargando...",
		"zeroRecords":    "No se encontraron resultados",
		"emptyTable":     "Ningún dato disponible en esta tabla",
		"info":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"infoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"infoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"infoPostFix":    "",
		"search":         "Buscar:",
		"Url":            "",
		"InfoThousands":  ",",
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
		// {
		// "decimal":        "",
		// "emptyTable":     "Ningún dato disponible en esta tabla",
		// "info":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		// "infoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		// "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
		// "infoPostFix":    "",
		// "thousands":      ",",
		// "lengthMenu":     "Mostrar _MENU_ registros",
		// "loadingRecords": "Procesando...",
		// "processing":     "Procesando...",
		// "search":         "Buscar:",
		// "zeroRecords":    "No se encontraron resultados",
		// "paginate": {
		// 	"first":      "Primero",
		// 	"last":       "Ultimo",
		// 	"next":       "Siguiente",
		// 	"previous":   "Anterior"
		// },
		// "aria": {
		// 	"sortAscending":  ": Activar para ordenar la columna de manera ascendente",
		// 	"sortDescending": ": Activar para ordenar la columna de manera descendente"
		// }
	}
</script>
<script src="<?php echo $ruta; ?>/php/js/notificaciones.js"></script>