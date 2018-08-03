<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
	$fecha = date("d").'-'.date("m").'-'.date("Y");
	$mes = date("m");
	$ano = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Reportes</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Reporte de cobranza</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Reportes</a></li>
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
						                    <div class="row align-items-end">
						                      <div class="col-3"><span class="table-filter-title">Fecha</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-6">
																						<label class="control-label">Inicio:</label>
																						<input type="date" class="form-control form-control-sm" name="fechainicio" id="fechainicio">
						                              </div>
						                              <div class="col-6">
																						<label class="control-label">Fin:</label>
                                            <input type="date" class="form-control form-control-sm" name="fechafin" id="fechafin">
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-1"><span class="table-filter-title">Status</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-12">
																						<label class="control-label"></label>
																						<select class="form-control form-control-sm select2" name="status" id="status">
																							<option value="vencida">Vencida</option>
																							<option value="porvencer">Por vencer</option>
																						</select>
																					</div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-1">
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-12">
																						<button id="listar-reportes" type="button" name="button" class="btn btn-lg btn-primary">Buscar</button>
						                              </div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																</div>
						                  </div>
														</div>

                          	<!-- Tabla de Reportes de Ventas -->
															<table id="dt_reportecobranza" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
                                    <th>#</th>
																		<th>Factura</th>
																		<th>Fecha</th>
																		<th>Cliente</th>
																		<th>Moneda</th>
																		<th>Total</th>
																		<th>Pagado</th>
																		<th>Crédito</th>
                                    <th>Vencimiento</th>
																	</tr>
																</thead>
															</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

			<div id="mod-spinner" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
	      <div class="modal-dialog" style="top: 400px;">
					<div class="text-center">
						<div class="be-spinner">
							<svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
								<circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
							</svg>
						</div>
					</div>
	    	</div>
			</div>

    <header>
    <?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
			App.megaMenu();
			App.pageCalendar();
			App.formElements();
			App.uiNotifications();
			nav_active();
			prettyPrint();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#reportes-menu").addClass("active");
    }

		$("#listar-reportes").on("click", function () {
			listar();
		});

		var listar = function(){
			var opcion = "reportecobranza";
			var fechainicio = $("#fechainicio").val();
			var fechafin = $("#fechafin").val();
			var status = $("#status").val();
			var table = $("#dt_reportecobranza").DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "fechainicio": fechainicio, "fechafin": fechafin, "status": status},
				},
				"columns":[
					{"data": "indice"},
					{"data": "factura"},
					{"data": "fecha"},
					{"data": "cliente"},
					{"data": "moneda"},
					{"data": "total"},
					{"data": "pagado"},
					{"data": "credito"},
					{"data": "vencimiento"}
				],
				"order": [1, "asc"],
				"language": idioma_espanol,
				"pageLength": 25,
				"createdRow": function ( row, data, index ) {
					if ( data.pagado == data.total ) {
						$('td', row).eq(0).addClass('text-success');
						$('td', row).eq(1).addClass('text-success');
						$('td', row).eq(2).addClass('text-success');
						$('td', row).eq(3).addClass('text-success');
						$('td', row).eq(4).addClass('text-success');
						$('td', row).eq(5).addClass('text-success');
						$('td', row).eq(6).addClass('text-success');
						$('td', row).eq(7).addClass('text-success');
						$('td', row).eq(8).addClass('text-success');
						$('td', row).eq(9).addClass('text-success');
						$('td', row).eq(10).addClass('text-success');
						$('td', row).eq(11).addClass('text-success');
						$('td', row).eq(12).addClass('text-success');
					}
					if ( data.pagado != '$ 0.00' && (data.pagado != data.total) ) {
						$('td', row).eq(0).addClass('text-warning');
						$('td', row).eq(1).addClass('text-warning');
						$('td', row).eq(2).addClass('text-warning');
						$('td', row).eq(3).addClass('text-warning');
						$('td', row).eq(4).addClass('text-warning');
						$('td', row).eq(5).addClass('text-warning');
						$('td', row).eq(6).addClass('text-warning');
						$('td', row).eq(7).addClass('text-warning');
						$('td', row).eq(8).addClass('text-warning');
						$('td', row).eq(9).addClass('text-warning');
						$('td', row).eq(10).addClass('text-warning');
						$('td', row).eq(11).addClass('text-success');
						$('td', row).eq(12).addClass('text-success');
					}
					if ( data.status == "CANCELADA" ) {
						$('td', row).eq(0).addClass('text-danger');
						$('td', row).eq(1).addClass('text-danger');
						$('td', row).eq(2).addClass('text-danger');
						$('td', row).eq(3).addClass('text-danger');
						$('td', row).eq(4).addClass('text-danger');
						$('td', row).eq(5).addClass('text-danger');
						$('td', row).eq(6).addClass('text-danger');
						$('td', row).eq(7).addClass('text-danger');
						$('td', row).eq(8).addClass('text-danger');
						$('td', row).eq(9).addClass('text-danger');
						$('td', row).eq(10).addClass('text-danger');
					}
				},
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
                    columns: [ 0, 1, 2, 4, 3, 6, 7, 8, 5, 13, 14, 15 ]
                  },
                  title: 'reporteventas',
                  customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c', sheet).attr( 's', '25' );
                  }
                }
            ]
          }
				]
			});
      table.columns( [13] ).visible( false );
			table.columns( [14] ).visible( false );
			table.columns( [15] ).visible( false );
			$("#folioinicio").val("");
			$("#foliofin").val("");
			obtener_data_descargar_factura("#dt_reportes tbody", table);
		}

		var obtener_data_descargar_factura = function(tbody, table){
			$(tbody).on("click", "button.descargarfactura", function(){
				$("#mod-spinner").modal("show");
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var UIDfactura = data.uid;
				var folio = data.factura;
				console.log(UIDfactura);

				var request = new XMLHttpRequest();

				request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDfactura+'/pdf');

				request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
				request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);
				request.setRequestHeader('Content-Type', 'application/pdf');
				request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
				request.responseType = 'blob';

				request.onreadystatechange = function () {
						if (this.readyState === 4) {
							console.log('Status:', this.status);
							console.log('Headers:', this.getAllResponseHeaders());
							console.log('Body:', this.response);
							$("#mod-spinner").modal("hide");
							var blob = new Blob([this.response], {type: 'application/pdf'});
							var link = document.createElement('a');
							link.href = window.URL.createObjectURL(blob);
							link.download = "H "+folio+".pdf";
							link.click();
						}
				};

				request.send();
			});
		}

		var  listar_pedidos_sin_oc = function(){


			var table = $("#dt_pedidos_sin_oc").DataTable({
				"language": idioma_espanol,
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconocsv"
			          },
			          {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_pedidosSinOC").innerHTML);
                        },
			          },
				]
			});

			// $("#dt_pedidos_sin_oc tfoot input").on( 'keyup change', function () {

		}

		var listar_impuestos = function(){
			$("#dt_impuestos").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var anoImpuestos = $("#frmMostrarImpuestos #anoImpuestos").val();
			var table = $("#dt_impuestos").DataTable({
				"destroy":"true",
		        	"ajax":{
		          		"method":"POST",
		          		"url":"listar_impuestos.php",
		          		"data": {"anoImpuestos": anoImpuestos}
		        },
		        "columns":[
		        	{"data": "impuesto"},
		        	{"data": "enero"},
		        	{"data": "febrero"},
		        	{"data": "marzo"},
		        	{"data": "abril"},
		        	{"data": "mayo"},
		        	{"data": "junio"},
		        	{"data": "julio"},
		        	{"data": "agosto"},
		        	{"data": "septiembre"},
		        	{"data": "octubre"},
		        	{"data": "noviembre"},
		        	{"data": "diciembre"},
		        	{"data": "total"}
		        ],
				"paging": false,
				"info": false,
				"searching": false,
				"order": false,
				"language": idioma_espanol,
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalEnero = api
		                .column( 1 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalFebrero = api
		                .column( 2 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMarzo = api
		                .column( 3 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalAbril = api
		                .column( 4 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMayo = api
		                .column( 5 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJunio = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJulio = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalAgosto = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalSeptiembre = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalOctubre = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalNoviembre = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalDiciembre = api
		                .column( 12 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalTotales = api
		                .column( 13 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            $( api.column( 0 ).footer() ).html('TOTAL');
		            $( api.column( 1 ).footer() ).html('$ ' + totalEnero + '.00');
		            $( api.column( 2 ).footer() ).html('$ ' + totalFebrero + '.00');
		            $( api.column( 3 ).footer() ).html('$ ' + totalMarzo + '.00');
		            $( api.column( 4 ).footer() ).html('$ ' + totalAbril + '.00');
		            $( api.column( 5 ).footer() ).html('$ ' + totalMayo + '.00');
		            $( api.column( 6 ).footer() ).html('$ ' + totalJunio + '.00');
		            $( api.column( 7 ).footer() ).html('$ ' + totalJulio + '.00');
		            $( api.column( 8 ).footer() ).html('$ ' + totalAgosto + '.00');
		            $( api.column( 9 ).footer() ).html('$ ' + totalSeptiembre + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalOctubre + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalNoviembre + '.00');
		            $( api.column( 12 ).footer() ).html('$ ' + totalDiciembre + '.00');
		            $( api.column( 13 ).footer() ).html('$ ' + totalTotales + '.00');
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_impuestos").innerHTML);
                        },
			        },
				]
			});
			var anoImpuestos=document.getElementById("anoImpuestos").value;
			$("#tituloAnoImpuestos").val(anoImpuestos);
		}

		var listar_acumulados = function(){
			$("#dt_acumulados").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var anoAcumulados = $("#frmMostrarAcumulados #anoAcumulados").val();
			var table = $("#dt_acumulados").DataTable({
				"destroy":"true",
		        	"ajax":{
		          		"method":"POST",
		          		"url":"listar_acumulados.php",
		          		"data": {"anoAcumulados": anoAcumulados}
		        },
		        "columns":[
		        	{"data": "reporte"},
		        	{"data": "enero"},
		        	{"data": "febrero"},
		        	{"data": "marzo"},
		        	{"data": "abril"},
		        	{"data": "mayo"},
		        	{"data": "junio"},
		        	{"data": "julio"},
		        	{"data": "agosto"},
		        	{"data": "septiembre"},
		        	{"data": "octubre"},
		        	{"data": "noviembre"},
		        	{"data": "diciembre"},
		        	{"data": "total"}
		        ],
				"paging": false,
				"info": false,
				"searching": false,
				"order": false,
				"language": idioma_espanol,
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalEnero = api
		                .column( 1 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalFebrero = api
		                .column( 2 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMarzo = api
		                .column( 3 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalAbril = api
		                .column( 4 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMayo = api
		                .column( 5 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJunio = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJulio = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalAgosto = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalSeptiembre = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalOctubre = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalNoviembre = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalDiciembre = api
		                .column( 12 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalTotales = api
		                .column( 13 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            $( api.column( 0 ).footer() ).html('TOTAL');
		            $( api.column( 1 ).footer() ).html('$ ' + totalEnero + '.00');
		            $( api.column( 2 ).footer() ).html('$ ' + totalFebrero + '.00');
		            $( api.column( 3 ).footer() ).html('$ ' + totalMarzo + '.00');
		            $( api.column( 4 ).footer() ).html('$ ' + totalAbril + '.00');
		            $( api.column( 5 ).footer() ).html('$ ' + totalMayo + '.00');
		            $( api.column( 6 ).footer() ).html('$ ' + totalJunio + '.00');
		            $( api.column( 7 ).footer() ).html('$ ' + totalJulio + '.00');
		            $( api.column( 8 ).footer() ).html('$ ' + totalAgosto + '.00');
		            $( api.column( 9 ).footer() ).html('$ ' + totalSeptiembre + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalOctubre + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalNoviembre + '.00');
		            $( api.column( 12 ).footer() ).html('$ ' + totalDiciembre + '.00');
		            $( api.column( 13 ).footer() ).html('$ ' + totalTotales + '.00');
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_acumulados").innerHTML);
                        },
			        },
				]
			});
		}

		var listar_cobranza = function(){
			$("#dt_reporte_cobranza").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var fechaInicio = $("#frmMostrarCobranza #fechaInicio").val(),
          		fechaFin = $("#frmMostrarCobranza #fechaFin").val();
			var table = $("#dt_reporte_cobranza").DataTable({
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_cobranza.php",
		          "data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
		        },
		        "columns":[
		        	{"data": "banco"},
		        	{"data": "fecha"},
		        	{"data": "factura"},
		        	{"data": "cliente"},
		        	{"data": "moneda"},
		        	{"data": "tipoCambio"},
		        	{"data": "importe"},
		        	{"data": "iva"},
		        	{"data": "total"},
		        	{"data": "importeMXN"},
		        	{"data": "ivaMXN"},
		        	{"data": "totalMXN"}
		        ],
				"language": idioma_espanol,
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalImporte = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalIva = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalTotal = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            $( api.column( 8 ).footer() ).html('TOTAL');
		            $( api.column( 9 ).footer() ).html('$ ' + totalImporte + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalIva + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalTotal );
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_reporteCobranza").innerHTML);
                        },
			        },
				]
			});
			// obtener_data_reporte_cobranza("#dt_reporte_cobranza tbody", table);
		}

		var obtener_data_reporte_cobranza = function(){
	      	var fechaInicio =document.getElementById("fechaInicio").value;
	        var fechaFin =document.getElementById("fechaFin").value;
	        document.getElementById("valFechaInicio").innerHTML = fechaInicio;
	        document.getElementById("valFechaFin").innerHTML = fechaFin;
	    }

		var  listar_comisiones = function(){
			$("#dt_reporte_comisiones").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var fechaInicio = $("#frmMostrarComisiones #fechaInicio").val(),
          		fechaFin = $("#frmMostrarComisiones #fechaFin").val(),
          		idvendedor = $("#frmMostrarComisiones #idvendedor").val();
			var table = $("#dt_reporte_comisiones").DataTable({
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_comisiones.php",
		          "data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin, "idvendedor": idvendedor}
		        },
		        "decimal": ",",
		        "order": [[1, "asc"]],
				"language": idioma_espanol,
				"columns": [
					{"data":"banco"},
					{"data":"fecha"},
					{"data":"factura"},
					{"data":"cliente"},
					{"data":"moneda"},
					{"data":"tipoCambio"},
					{"data":"importe"},
					{"data":"iva"},
					{"data":"total"}
				],
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalImporte = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalIva = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalTotal = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            $( api.column( 3 ).footer() ).html('<b>COMISION</b>');
		            $( api.column( 4 ).footer() ).html('$ ' + (totalImporte*0.03).toFixed(4) );
		            $( api.column( 5 ).footer() ).html('<b>TOTAL</b>');
		            $( api.column( 6 ).footer() ).html('$ ' + totalImporte.toFixed(4) );
		            $( api.column( 7 ).footer() ).html('$ ' + totalIva.toFixed(4) );
		            $( api.column( 8 ).footer() ).html('$ ' + totalTotal.toFixed(4) );
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_comisiones").innerHTML);
                        },
			        },
				]
			});

		}

		var  listar_herramienta_sin_entregar = function(){
			var table = $("#dt_herramienta_sin_entregar").DataTable({
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_herramienta_sin_entregar.php"
		        },
		        "order": [[1, "asc"]],
				"language": idioma_espanol,
				"columns": [
					{"data":"marca"},
					{"data":"modelo"},
					{"data":"cliente"},
					{"data":"descripcion"},
					{"data":"cantidad"},
					{"data":"precio"},
					{"data":"moneda"},
					{"data":"pedidoCliente"},
					{"data":"fechaPedido"}
				],
				"dom":
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_herramientaSinEntregar").innerHTML);
                        },
			        },
				]
			});

		}

		$('#btn_listar_herramienta_sin_factura').on("click", function(){
			var  listar_herramienta_sin_factura = function(){
				var table = $("#dt_herramienta_sin_factura").DataTable({
					"destroy":"true",
			        "ajax":{
			          "method":"POST",
			          "url":"listar_herramienta_sin_factura.php"
			        },
			        "order": [[1, "asc"]],
					"language": idioma_espanol,
					"columns": [
						{"data":"marca"},
						{"data":"modelo"},
						{"data":"cliente"},
						{"data":"cantidad"},
						{"data":"remision"}
					],
					"dom":
						"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
	          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
	          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
					"buttons":[
			            {
				            extend:    'pdfHtml5',
				            text:      '<i class="fa fa-file-pdf-o"></i>',
				            titleAttr: 'PDF',
				            footer: true,
				            orientation: 'landscape',
				            download: 'open',
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconopdf"
				        },
				          {
				            extend:    'excelHtml5',
				            text:      '<i class="fa fa-file-excel-o"></i>',
				            titleAttr: 'Excel',
				            footer: true,
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconoexcel"
				          },
				          {
				            extend: 'csvHtml5',
				            text: '<i class="fa fa-file-text-o"></i>',
				            titleAttr: 'CSV',
				            footer: true,
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconocsv"
				          },
				        {
				            extend: 'print',
				            text: '<i class="fa fa-print" aria-hidden="true"></i>',
				            titleAttr: 'Imprmir',
				            footer: true,
				            header: 'false',
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            orientation: 'landscape',
				            download: 'open',
				            "className": "btn iconoimprimir",
				            title: '',
	                        customize: function(window) {
	                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_herramientaSinFactura").innerHTML);
	                        },
				        },
					]
				});
			}
		});
	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
