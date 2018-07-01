<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);

?>
<!DOCTYPE html>
</html lang="es">
<head>
	<title>Pedidos</title>
	<?php include("../../enlacescss.php"); ?>
</head>
<body>
	<?php include("../../header.php"); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Pedidos</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
	                    <li class="breadcrumb-item"><a href="#">Pedidos</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                      			<!-- Boton de Buscar -->
									<form class="form-horizontal row justify-content-center" action="pedidos.php" method="post">
										<div class="form-group col-12 row justify-content-center">
											<input type="text" class="form-control form-control-sm col-2" name="buscar" id="buscar" placeholder="Buscar">
										</div>
										<!-- <div class="form-group col-12 row justify-content-center">
											<input class="btn btn-primary" type="submit" value="Buscar" />
										</div> -->
									</form>

								<!-- Grupo de botones -->
									<div class="row justify-content-center btn-toolbar">
										<div role="group" class="btn-group btn-group-justified mb-2 col-6">
											<a href="#" id="btnsinproveedor" class="btn btn-primary btn-space" onclick="listar_sinproveedor()">SIN PROVEEDOR</a href="#">
										  	<a href="#" id="btnnoentregado" class="btn btn-primary btn-space" onclick="listar_noentregado()">NO ENTREGADO</a href="#">
											<a href="#" id="btnnopagado" class="btn btn-primary btn-space" onclick="listar_nopagado()">NO PAGADO</a href="#">
											<a href="#" id="btnterminado" class="btn btn-primary btn-space" onclick="listar_terminado()">TERMINADO</a href="#">
										</div>
									</div>

								<!-- Tabla de No entregado -->
									<div id="noentregado">
										<br>
										<center><h4><b>Pedidos con herramienta sin entregar</b></h4></center><br>
										<table id="dt_noentregado" class="table table-striped display compact" cellspacing="0" width="100%">
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
									<div id="sinproveedor">
										<br>
										<center><h4><b>Pedidos con herramienta sin proveedor</b></h4></center><br>
										<table id="dt_sinproveedor" class="table table-striped display compact" cellspacing="0" width="100%">
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
									<div id="nopagado">
										<br>
										<center><h4><b>Pedidos no pagados</b></h4></center><br>
										<table id="dt_nopagado" class="table table-striped display compact" cellspacing="0" width="100%">
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

								<!-- Tabla de terminado -->
									<div id="terminado">
										<br>
										<center><h4><b>Pedidos terminados</b></h4></center><br>
										<table id="dt_terminado" class="table table-striped display compact" cellspacing="0" width="100%">
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
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
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
	</header>
	<?php include("../../enlacesjs.php"); ?>
	<script>
		$(document).ready(function(){
			App.init();
      		App.pageCalendar();
      		App.formElements();
      		App.uiNotifications();
			listar_sinproveedor();
		});

		var listar_sinproveedor = function(){
			$("#noentregado").slideUp("slow");
			$("#sinproveedor").slideDown("slow");
			$("#nopagado").slideUp("slow");
			$("#terminado").slideUp("slow");
			$("#btnsinproveedor").removeClass("btn-secondary");
			$("#btnsinproveedor").addClass("btn-primary");
			$("#btnnoentregado").removeClass("btn-primary");
			$("#btnnoentregado").addClass("btn-secondary");
			$("#btnnopagado").removeClass("btn-primary");
			$("#btnnopagado").addClass("btn-secondary");
			$("#btnterminado").removeClass("btn-primary");
			$("#btnterminado").addClass("btn-secondary");
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
						{"defaultContent": "<div class='invoice-footer'><button class='verpedido btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"order": [5, "desc"],
			        "language": idioma_espanol,
			        "dom":
	          			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          			"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
				            extend: 'collection',
				            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
				            "className": "btn btn-lg btn-space btn-secondary",
				            buttons: [
				                {
				                  extend:    'excelHtml5',
				                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
				            ]
				        },
					]
				});
			verpedido("#dt_sinproveedor tbody", table);
		}

		var listar_noentregado = function(){
			$("#noentregado").slideDown("slow");
			$("#sinproveedor").slideUp("slow");
			$("#nopagado").slideUp("slow");
			$("#terminado").slideUp("slow");
			$("#btnnoentregado").removeClass("btn-secondary");
			$("#btnnoentregado").addClass("btn-primary");
			$("#btnsinproveedor").removeClass("btn-primary");
			$("#btnsinproveedor").addClass("btn-secondary");
			$("#btnnopagado").removeClass("btn-primary");
			$("#btnnopagado").addClass("btn-secondary");
			$("#btnterminado").removeClass("btn-primary");
			$("#btnterminado").addClass("btn-secondary");
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
						{"defaultContent": "<div class='invoice-footer'><button class='verpedido btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"order": [5, "desc"],
			        "language": idioma_espanol,
			        "dom":
	          			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          			"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
				            extend: 'collection',
				            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
				            "className": "btn btn-lg btn-space btn-secondary",
				            buttons: [
				                {
				                  extend:    'excelHtml5',
				                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
				            ]
				          },
					]
				});
			verpedido("#dt_noentregado tbody", table);
		}

		var listar_nopagado = function(){
			$("#noentregado").slideUp("slow");
			$("#sinproveedor").slideUp("slow");
			$("#nopagado").slideDown("slow");
			$("#terminado").slideUp("slow");
			$("#btnnopagado").removeClass("btn-secondary");
			$("#btnnopagado").addClass("btn-primary");
			$("#btnsinproveedor").removeClass("btn-primary");
			$("#btnsinproveedor").addClass("btn-secondary");
			$("#btnnoentregado").removeClass("btn-primary");
			$("#btnnoentregado").addClass("btn-secondary");
			$("#btnterminado").removeClass("btn-primary");
			$("#btnterminado").addClass("btn-secondary");
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
						{"defaultContent": "<div class='invoice-footer'><button class='verpedido btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"order": [5, "desc"],
			        "language": idioma_espanol,
			        "dom":
	          			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          			"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
				            extend: 'collection',
				            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
				            "className": "btn btn-lg btn-space btn-secondary",
				            buttons: [
				                {
				                  extend:    'excelHtml5',
				                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
				            ]
				          },
					]
				});
			verpedido("#dt_nopagado tbody", table);
		}

		var listar_terminado = function(){
			$("#noentregado").slideUp("slow");
			$("#sinproveedor").slideUp("slow");
			$("#nopagado").slideUp("slow");
			$("#terminado").slideDown("slow");
			$("#btnterminado").removeClass("btn-secondary");
			$("#btnterminado").addClass("btn-primary");
			$("#btnsinproveedor").removeClass("btn-primary");
			$("#btnsinproveedor").addClass("btn-secondary");
			$("#btnnoentregado").removeClass("btn-primary");
			$("#btnnoentregado").addClass("btn-secondary");
			$("#btnnopagado").removeClass("btn-primary");
			$("#btnnopagado").addClass("btn-secondary");
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
						{"defaultContent": "<div class='invoice-footer'><button class='verpedido btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"order": [5, "desc"],
			        "language": idioma_espanol,
			        "dom":
	          			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          			"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
				            extend: 'collection',
				            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
				            "className": "btn btn-lg btn-space btn-secondary",
				            buttons: [
				                {
				                  extend:    'excelHtml5',
				                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
				            ]
				          },
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
	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
