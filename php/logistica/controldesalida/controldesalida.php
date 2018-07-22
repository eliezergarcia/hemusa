<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
  $mes = date("m");
  $ano = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Control de salida</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="page-head">
          <p class="page-head-title">Control de salida</p>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="#">Logística</a></li>
                <li class="breadcrumb-item"><a href="#">Control de salida</a></li>
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
                          <div class="col-2 table-filters"><span class="table-filter-title">Cantidad</span>
                            <div class="filter-container">
                              <form>
                                <div class="row">
                                  <div class="col-8">
                                    <label class="control-label">Mostrar:</label>
                                    <select class="form-control form-control-sm select2" name="filtrocantidad" id="filtrocantidad">
                                      <option value="100" selected>100</option>
                                      <option value="200">200</option>
                                      <option value="300">300</option>
                                      <option value="400">400</option>
                                      <option value="500">500</option>
                                      <option value="600">600</option>
                                      <option value="700">700</option>
                                      <option value="800">800</option>
                                      <option value="900">900</option>
                                      <option value="1000">1000</option>
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
                                  <div class="col-12">
                                    <label class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" name="filtrotipo" checked="" value="nacional"><span class="custom-control-label">Nacional</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" name="filtrotipo" value="importacion"><span class="custom-control-label">Importación</span>
                                    </label>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div
                        </div>
                      </div>
                    </div>
                  </div>

                <!-- Tabla de Folios -->
                  <table id="dt_folios" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Folio</th>
                        <th>Proveedor</th>
                        <th>Ver</th>
                      </tr>
                    </thead>
                  </table>

								</div>
						</div>
				</div>
		</div>
	</div>
</header>
<?php include('../../enlacesjs.php'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
      App.init();
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
      listar_folios();
		});

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#logistica-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#controldesalida-menu").addClass("active");
    }

    $('#filtrocantidad').change(function() {
			listar_folios();
		});

		$('input[name=filtrotipo]').change(function() {
			listar_folios();
		});

    var listar_folios = function(){
			var filtrocantidad = $("#filtrocantidad").val();
			var filtrotipo = $("input[name=filtrotipo]:checked").val();
      var table = $("#dt_folios").DataTable({
				"destroy":"true",
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {"opcion": filtrotipo, "filtrocantidad": filtrocantidad},
				},
        "sAjaxDataProp": "data",
				"columns":[
          {"data": null,
            "render": function (data) {
              return data.folio;
            },
          },
          {"data": null,
            "render": function (data) {
              return data.proveedor;
            },
          },
					{"data": null,
            "render": function () {
              return "<div class='invoice-footer'><button class='editar btn btn-space btn-primary btn-lg'><i class='fas fa-edit fa-sm'></i></button></div>";
            },
          }
				],
				"order": [[0, "desc"]],
				"language": idioma_espanol,
				"dom":
					"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
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
										columns: [ 0, 1, 2, 3, 4 ]
									}
								},
								{
									extend: 'csv',
									text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4 ]
									}
								},
								{
									extend:    'pdfHtml5',
									text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
									download: 'open',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
										columns: [ 0, 1, 2, 3, 4 ]
									}
								},
								{
									extend: 'print',
									text: '<i class="fas fa-print fa-lg"></i> Imprimir',
									header: 'false',
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4 ]
									},
									orientation: 'landscape',
									pageSize: 'LEGAL'
								}
						]
					}
				]
			});
      obtener_data("#dt_folios tbody", table, filtrotipo);
    }

    var obtener_data = function(tbody, table, filtrotipo){
      $('#dt_folios tbody').off('click');
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
				folio = data.folio;
        if (filtrotipo == "nacional") {
          window.location="verSalidaNacional.php?folio="+folio;
        }else{
          window.location="verSalidaImportacion.php?pedimento="+folio;
        }
      });
    }

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
