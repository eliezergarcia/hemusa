<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
	$mes = date("m");
	$ano = date("Y");
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
														<div class="row table-filters-container">
						                  <div class="col-12">
						                    <div class="row">
						                      <div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-6">
																						<label class="control-label">Mes:</label>
																						<select class="form-control form-control-sm select2" name="filtromes" id="filtromes">
																							<option value="01">Enero</option>
																							<option value="02">Febrero</option>
																							<option value="03">Marzo</option>
																							<option value="04">Abril</option>
																							<option value="05">Mayo</option>
																							<option value="06">Junio</option>
																							<option value="07">Julio</option>
																							<option value="08">Agosto</option>
																							<option value="09">Septiembre</option>
																							<option value="10">Octubre</option>
																							<option value="11">Noviembre</option>
																							<option value="12">Diciembre</option>
																							<option value="todo">Todo</option>
																						</select>
						                              </div>
						                              <div class="col-6">
																						<label class="control-label">Año:</label>
																						<select class="form-control form-control-sm select2" name="filtroano" id="filtroano">
																							<option value="2017">2017</option>
																							<option value="2018" selected>2018</option>
																							<option value="2019">2019</option>
																							<option value="2020">2020</option>
																						</select>
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-2 table-filters"><span class="table-filter-title">Tipo</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-6">
																						<label class="custom-control custom-radio">
										                          <input class="custom-control-input" type="radio" name="filtrotipo" checked="" value="pedido"><span class="custom-control-label">Pedido</span>
										                        </label>
										                        <label class="custom-control custom-radio">
										                          <input class="custom-control-input" type="radio" name="filtrotipo" value="herramienta"><span class="custom-control-label">Herramienta</span>
										                        </label>
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-3 table-filters"><span class="table-filter-title">Estado</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
																					<div class="col-6">
 																					 <label class="custom-control custom-radio">
 																						 <input class="custom-control-input" type="radio" name="filtroestado" value="sinproveedor" checked=""><span class="custom-control-label">Sin proveedor</span>
 																					 </label>
																					 <label class="custom-control custom-radio">
																						 <input class="custom-control-input" type="radio" name="filtroestado" value="facturadonopagado"><span class="custom-control-label">Facturado no pagado</span>
																					 </label>
 																				 	</div>
																					<div class="col-6">
																						<label class="custom-control custom-radio">
																							<input class="custom-control-input" type="radio" name="filtroestado" value="noentregado"><span class="custom-control-label">No entregado</span>
																						</label>
										                        <label class="custom-control custom-radio">
										                          <input class="custom-control-input" type="radio" name="filtroestado" value="terminado"><span class="custom-control-label">Terminado</span>
										                        </label>
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-3 table-filters"><span class="table-filter-title">Referencia</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-8">
																						<label class="control-label">Palabra:</label>
																						<input type="text" class="form-control form-control-sm" name="filtroreferencia" id="filtroreferencia" value="">
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
						                    </div>
						                  </div>
														</div>


														<!-- Tabla de pedidos -->
															<table id="dt_pedidos" class="table table-striped display compact" cellspacing="0" width="100%">
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
																		<th>Marca</th>
																		<th>Modelo</th>
																		<th>Descripcion</th>
																		<th>Precio Unitario</th>
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
			$("#filtromes").val("<?php echo $mes; ?>").change();
			$("#filtroano").val("<?php echo $ano; ?>").change();
			listar_pedidos();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#ventas-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#pedidos-menu").addClass("active");
    }

		$("#filtromes").on("change", function (){
			listar_pedidos();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$("#filtroano").on("change", function (){
			listar_pedidos();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$('input[name=filtrotipo]').change(function() {
			listar_pedidos();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$('input[name=filtroestado]').change(function() {
			listar_pedidos();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$("#filtroreferencia").on("change", function (){
			listar_pedidos();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		function listar_pedidos () {
			var filtromes = $("#filtromes").val();
			var filtroano = $("#filtroano").val();
			var filtrotipo = $("input[name=filtrotipo]:checked").val();
			var filtroestado = $("input[name=filtroestado]:checked").val();
			var filtroreferencia = $("#filtroreferencia").val();
			console.log(filtroano);
			console.log(filtromes);
			console.log(filtrotipo);
			console.log(filtroestado);
			console.log(filtroreferencia);
			var table = $("#dt_pedidos").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": filtroestado, "filtromes": filtromes, "filtroano": filtroano, "filtrotipo": filtrotipo, "buscar": filtroreferencia}
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
					{"data": "marca",
						"render": function (data) {
							if (filtrotipo == "pedido") {
								return "";
							}else{
								return data;
							}
						},
					},
					{"data": "modelo",
						"render": function (data) {
							if (filtrotipo == "pedido") {
								return "";
							}else{
								return data;
							}
						},
					},
					{"data": "descripcion",
						"render": function (data) {
							if (filtrotipo == "pedido") {
								return "";
							}else{
								return data;
							}
						},
					},
					{"data": "precioUnitario",
						"render": function (data) {
							if (filtrotipo == "pedido") {
								return "";
							}else{
								return data;
							}
						},
					},
					{"defaultContent": "",
						"render": function (data) {
							return "<div class='invoice-footer'><button class='verpedido btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>";
						},
					}
				],
				"columnDefs": [
					{ "width": "10%", "targets": 0 },
					{ "width": "10%", "targets": 1 },
					{ "width": "10%", "targets": 3 },
					{ "width": "10%", "targets": 4 },
					{ "width": "10%", "targets": 5 },
					{ "width": "7%", "targets": 6 },
					{ "width": "7%", "targets": 7 },
					{ "width": "10%", "targets": 8 },
					{ "width": "10%", "targets": 9 },
					{ "width": "20%", "targets": 10 },
					{ "width": "10%", "targets": 11 },
					{ "width": "5%", "targets": 12 },
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
            	],
						}
					]
				});

			if (filtrotipo == "pedido") {
        table.columns( [8] ).visible( false );
				table.columns( [9] ).visible( false );
				table.columns( [10] ).visible( false );
				table.columns( [11] ).visible( false );
      }else{
				table.columns( [3] ).visible( false );
				table.columns( [4] ).visible( false );
				table.columns( [5] ).visible( false );
				table.columns( [6] ).visible( false );
				table.columns( [7] ).visible( false );
			}
			verpedido("#dt_pedidos tbody", table);
		}

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
					"autoWidth": false,
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
					"columnDefs": [
						{ "width": "10%", "targets": 0 },
						{ "width": "10%", "targets": 1 },
						{ "width": "10%", "targets": 3 },
						{ "width": "10%", "targets": 4 },
						{ "width": "10%", "targets": 5 },
						{ "width": "7%", "targets": 6 },
						{ "width": "7%", "targets": 7 },
						{ "width": "5%", "targets": 8 },
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
					"autoWidth": false,
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
					"columnDefs": [
						{ "width": "10%", "targets": 0 },
						{ "width": "10%", "targets": 1 },
						{ "width": "10%", "targets": 3 },
						{ "width": "10%", "targets": 4 },
						{ "width": "10%", "targets": 5 },
						{ "width": "7%", "targets": 6 },
						{ "width": "7%", "targets": 7 },
						{ "width": "5%", "targets": 8 },
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
					"autoWidth": false,
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
					"columnDefs": [
						{ "width": "10%", "targets": 0 },
						{ "width": "10%", "targets": 1 },
						{ "width": "10%", "targets": 3 },
						{ "width": "10%", "targets": 4 },
						{ "width": "10%", "targets": 5 },
						{ "width": "7%", "targets": 6 },
						{ "width": "7%", "targets": 7 },
						{ "width": "5%", "targets": 8 },
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
					"autoWidth": false,
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
					"columnDefs": [
						{ "width": "10%", "targets": 0 },
						{ "width": "10%", "targets": 1 },
						{ "width": "10%", "targets": 3 },
						{ "width": "10%", "targets": 4 },
						{ "width": "10%", "targets": 5 },
						{ "width": "7%", "targets": 6 },
						{ "width": "7%", "targets": 7 },
						{ "width": "5%", "targets": 8 },
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
