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
              	<h2 class="page-head-title">Reportes</h2>
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
						                  <div class="col-12 col-lg-12 col-xl-6">
						                    <div class="row">
						                      <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">Fecha</span>
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
						                    </div>
						                  </div>
														</div>

                          	<!-- Tabla de Reportes de Ventas -->
															<table id="dt_reportes" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>Factura</th>
																		<th>Fecha</th>
																		<th>Cliente</th>
																		<th>Moneda</th>
																		<th>Iva</th>
																		<th>Subtotal</th>
																		<th>Total</th>
																		<th>Pagado</th>
																		<th>Banco</th>
																		<th>Fecha pago</th>
																		<th>Nota de crédito</th>
																	</tr>
																</thead>
															</table>
                      		</div>
                    	</div>
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
			// nav_active();
			prettyPrint();
			listar();
			$("#filtromes").val("<?php echo $mes; ?>").change();
			$("#filtroano").val("<?php echo $ano; ?>").change();
		});

		$("#filtromes").on("change", function (){
			listar();
		});

		$("#filtroano").on("change", function (){
			listar();
		});

		var listar = function(){
			var opcion = "reporteventas";
			var filtromes = $("#filtromes").val();
			var filtroano = $("#filtroano").val();
			console.log(filtroano);
			console.log(filtromes);
			var table = $("#dt_reportes").DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "filtromes": filtromes, "filtroano": filtroano},
				},
				"columns":[
					{"data": "factura"},
					{"data": "fecha"},
					{"data": "cliente"},
					{"data": "moneda"},
					{"data": "iva"},
					{"data": "subtotal"},
					{"data": "total"},
					{"data": "pagado"},
					{"data": "banco"},
					{"data": "fechapago"},
					{"data": "notacredito"}
				],
				"language": idioma_espanol,
				"pageLength": 25,
				"createdRow": function ( row, data, index ) {
					if ( data.pagado == "$ 0.00" ) {
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> CSV',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          }
				]
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
