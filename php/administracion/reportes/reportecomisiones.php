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
              	<h2 class="page-head-title">Reporte de comisiones</h2>
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
                                  <div class="col-2"><span class="table-filter-title">Vendedor</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row">
						                              <div class="col-12">
																						<label class="control-label"></label>
																						<select class="form-control form-control-sm select2" name="vendedor" id="vendedor">
																						</select>
																					</div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
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

                          	<!-- Tabla de Reportes de Comisiones -->
															<table id="dt_reportecomisiones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
                                    <th>#</th>
																		<th>Banco</th>
																		<th>Fecha</th>
																		<th>Factura</th>
                                    <th>Cliente</th>
                                    <th>Moneda</th>
                                    <th>Tipo cambio</th>
																		<th>Importe</th>
                                    <th>IVA</th>
																		<th>Total</th>
																	</tr>
																</thead>
                                <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                </tfoot>
															</table>

                              <br>
                              <div class="row justify-content-end">
                                <div class="col-4">
                                  <div class="">
                                    <h3 id="comisionvendedor">Comision del vendedor (3%): </h3>
                                  </div>
                                </div>
                              </div>
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
      buscar_vendedores();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#reportes-menu").addClass("active");
    }

    var buscar_vendedores = function(){
      var opcion = "buscarvendedores";
      $.ajax({
        method: "POST",
        url: "buscar.php",
        dataType: "json",
        data: {"opcion": opcion},
        success : function(data) {
          var vendedores = data;
          var total = vendedores.data.length;
          for(var i=0;i<=total;i++){
            $("select[name=vendedor]").append("<option value='"+ vendedores.data[i].id + "'>" + vendedores.data[i].nombre + " " + vendedores.data[i].apellidos + "</option>");
          };
          $("#vendedor").focus();
        }
      });
    }

		$("#listar-reportes").on("click", function () {
			listar();
		});

		var listar = function(){
			var opcion = "reportecomisiones";
			var fechainicio = $("#fechainicio").val();
			var fechafin = $("#fechafin").val();
			var vendedor = $("#vendedor").val();
			var table = $("#dt_reportecomisiones").DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "fechainicio": fechainicio, "fechafin": fechafin, "vendedor": vendedor},
				},
				"columns":[
					{"data": "indice"},
					{"data": "banco"},
					{"data": "fecha"},
          {"data": "factura"},
					{"data": "cliente"},
					{"data": "moneda"},
          {"data": "tipocambio"},
					{"data": "importe",
            "render": function(importe){
              return "$ " + importe;
            }
          },
					{"data": "iva",
            "render": function(iva){
              return "$ " + iva;
            }
          },
					{"data": "total",
            "render": function(total){
              return "$ " + total;
            }
          }
				],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var importe = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var iva = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var comision = (importe * 0.03).toFixed(2);
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 7 ).footer() ).html('$ ' + importe.toFixed(2) + ' M.N');
            $( api.column( 8 ).footer() ).html('$ ' + iva.toFixed(2) + ' M.N');
            $( api.column( 9 ).footer() ).html('$ ' + total.toFixed(2) + ' M.N');
            document.getElementById("comisionvendedor").innerHTML = "Comision del vendedor (3%): "+comision + ' M.N';
        },
				// "order": [1, "asc"],
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  },
                  title: 'reportecobranza',
                  customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c', sheet).attr( 's', '25' );
                  }
                }
            ]
          }
				]
			});
		}

	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
