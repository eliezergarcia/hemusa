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
              	<h2 class="page-head-title">Reporte de marcas</h2>
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
                            <form action="#" method="post">
                              <input type="hidden" name="opcion" id="opcion" value="movimientosusuarios">
                              <div class="row table-filters-container">
                                <div class="col-12">
                                  <div class="row align-items-end">
                                    <div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-6">
                                            <label class="control-label">Inicio</label>
                                            <input class="form-control form-control-sm" size="16" type="date" name="fechainicio" id="fechainicio" required>
                                          </div>
                                          <div class="col-6">
                                            <label class="control-label">Fin</label>
                                            <input class="form-control form-control-sm" size="16" type="date" name="fechafin" id="fechafin" required>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-2 table-filters"><span class="table-filter-title">Marca</span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-12">
                                            <label class="control-label"></label>
                                            <select class="form-control form-control-sm select2" name="marca" id="marca" required>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-1 table-filters"><span class="table-filter-title"></span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-12">
                                            <button type="submit" name="button" class="btn btn-lg btn-primary">Buscar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>

                          	<!-- Tabla de Reportes de Ventas -->
															<table id="dt_reporte_marcas" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>#</th>
                                    <th>Cliente</th>
																		<th>Marca</th>
																		<th>Modelo</th>
																		<th>Descripción</th>
																		<th>P. Unitario venta (sin IVA)</th>
																		<th>Moneda</th>
																		<th>Cantidad</th>
																		<th>Fecha pedido</th>
																		<th>Orden compra</th>
																		<th>Proveedor</th>
																		<th>Factura</th>
																		<th>Remision</th>
																		<th>Fecha entregado</th>
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
			buscar_marcas();
      listar();
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

    var buscar_marcas = function(){
      var opcion = "buscarmarcas";
      $.ajax({
        method: "POST",
        url: "buscar.php",
        dataType: "json",
        data: {"opcion": opcion},
        success : function(data) {
          var cuentas = data;
          var total = data.data.length;
          for(var i=0;i<=total;i++){
             $("select[name=marca]").append("<option value='"+ cuentas.data[i].marca + "'>" + cuentas.data[i].marca + "</option>");
          };
        }
      });
    }

		function listar (){
      $("form").on("submit", function (e){
        e.preventDefault();
        var opcion = "reportemarcas";
        var fechainicio = $("#fechainicio").val();
        var fechafin = $("#fechafin").val();
        var marca = $("#marca").val();
        var table = $("#dt_reporte_marcas").DataTable({
          "destroy": true,
          "deferRender": true,
          "scrollX": true,
          "autoWidth": false,
          "ajax":{
            "url": "listar.php",
            "type": "POST",
            "data": {"opcion": opcion, "fechainicio": fechainicio, "fechafin": fechafin, "marca": marca},
          },
          "columns":[
            {"data": "indice"},
            {"data": "cliente"},
            {"data": "marca"},
            {"data": "modelo"},
            {"data": "descripcion"},
            {"data": "preciounitario"},
            {"data": "moneda"},
            {"data": "cantidad"},
            {"data": "fechapedido"},
            {"data": "ordencompra"},
            {"data": "proveedor"},
            {"data": "factura"},
            {"data": "remision"},
            {"data": "fechaentregado"}
          ],
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
                  title: 'reportemarcas',
                  customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c', sheet).attr( 's', '25' );
                  }
                }
                ]
              }
              ]
            });
      });
		}
	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
