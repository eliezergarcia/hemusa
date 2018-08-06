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
              	<h2 class="page-head-title">Reporte de bancos</h2>
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
                                  <div class="col-3 table-filters"><span class="table-filter-title">Banco</span>
                                    <div class="filter-container">
                                      <div class="row">
                                        <div class="col-12">
                                          <label class="control-label"></label>
                                          <select class="form-control form-control-sm select2" name="banco" id="banco">
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
						                      <div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
						                        <div class="filter-container">
					                            <div class="row">
					                              <div class="col-6">
																					<label class="control-label">Inicio</label>
																					<input type="date" name="fechainicio" id="fechainicio" value="" class="form-control form-control-sm">
					                              </div>
					                              <div class="col-6">
																					<label class="control-label">Fin</label>
																					<input type="date" name="fechafin" id="fechafin" value="" class="form-control form-control-sm">
					                              </div>
					                            </div>
						                        </div>
						                      </div>
																	<div class="col-1 table-filters"><span class="table-filter-title"></span>
						                        <div class="filter-container">
					                            <div class="row">
					                              <div class="col-12">
																					<button id="listar-reporte" type="button" name="button" class="btn btn-lg btn-primary">Buscar</button>
					                              </div>
					                            </div>
						                        </div>
						                      </div>
																</div>
						                  </div>
														</div>

                          	<!-- Tabla de Reportes de Ventas -->
															<br>
															<table id="dt_reporte_bancos" class="table table-striped table-bordered table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>Fecha</th>
                                    <th>Factura</th>
																		<th>Cliente</th>
																		<th>Cantidad total</th>
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
			nav_active();
			prettyPrint();
			buscar_cuentas();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#reportes-menu").addClass("active");
    }

    var buscar_cuentas = function(){
      var opcion = "buscarcuentas";
      $.ajax({
        method: "POST",
        url: "buscar.php",
        dataType: "json",
        data: {"opcion": opcion},
        success : function(data) {
          var cuentas = data;
          for(var i=0;i<=4;i++){
            $("select[name=banco]").append("<option value='"+ cuentas.data[i].id + "'>" + cuentas.data[i].nombre + "</option>");
          };
          $("#banco").focus();
        }
      });
    }

		$("#listar-reporte").on("click", function () {
			listar();
		});

		var listar = function(){
			var opcion = "reportebancos";
			var fechainicio = $("#fechainicio").val();
			var fechafin = $("#fechafin").val();
			var banco = $("#banco").val();
			var table = $('#dt_reporte_bancos').DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"opcion": opcion, "banco": banco, "fechainicio": fechainicio, "fechafin": fechafin},
				},
				"columns":[
					{"data":"fecha"},
					{"data":"factura"},
					{"data":"cliente"},
					{"data":"cantidadtotal"},
				],
				"columnDefs": [
					{ "width": "13%", "targets": 0 },
					{ "width": "10%", "targets": 1 },
					// { "width": "13%", "targets": 2 },
					{ "width": "15%", "targets": 3 },
				],
				"ordering": false,
				"lengthChange": false,
        "info": false,
        "paging": false,
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-space'<'col-sm-4 text-right'B><'col-sm-5 text-right'f>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-6'tr>>",
					"buttons":[
	          {
	            extend: 'collection',
	            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
	            "className": "btn btn-lg btn-space btn-secondary",
	            buttons: [
	                {
	                  extend:    'excelHtml5',
	                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
										customize: function ( xlsx ){
	                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
	                    $('row c', sheet).attr( 's', '25' );
	                  }
	                },
	                {
	                  extend: 'csv',
	                  text: '<i class="fas fa-file-alt fa-lg"></i> CSV',
	                },
	                {
	                  extend:    'pdfHtml5',
	                  text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
	                  download: 'open',
	                },
	                {
	                  extend: 'print',
	                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
	                  header: 'false',
	                  orientation: 'landscape',
	                  pageSize: 'LEGAL'
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
