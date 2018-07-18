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
                                  <div class="col-12">
                                    <label class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="filtrotipo" checked="" value="nacional"><span class="custom-control-label">Nacional</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
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

										<br>
										<!-- Grupo de botones -->
											<div class="row justify-content-center btn-toolbar">
												<div role="group" class="btn-group btn-group-justified mb-2 col-6">
													<a href="#" id="btnnacional" class="btn btn-primary btn-space" onclick="listar_nacional()">NACIONAL</a href="#">
													<a href="#" id="btnimportacion" class="btn btn-primary btn-space" onclick="listar_importacion()">IMPORTACION</a href="#">
												</div>
											</div>

											<!-- Tabla Ordenes de Compras -->
												<br>
												<div id="nacional">
													<table id="dt_nacional" class="table table-striped table-hover compact" cellspacing="0" width="100%">
														<thead>
															<tr>
																<th>Folio</th>
                                <th>Proveedor</th>
																<th>Ver</th>
															</tr>
														</thead>
													</table>
												</div>

												<!-- Tabla Ordenes de Compras -->
													<br>
													<div id="importacion">
														<table id="dt_importacion" class="table table-striped table-hover compact" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<th>Pedimento</th>
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
      $("#filtromes").val("<?php echo $mes; ?>").change();
      // listar_folios();
		});

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#logistica-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#controldesalida-menu").addClass("active");
    }

    $("#filtromes").on("change", function (){
      // $('#dt_folios').DataTable().ajax.reload();
			listar_folios();
		});

		$("#filtroano").on("change", function (){
      // $('#dt_folios').DataTable().ajax.reload();
			listar_folios();
		});

		$('input[name=filtrotipo]').change(function() {
      // $('#dt_folios').DataTable().ajax.reload();
			listar_folios();
		});

    var listar_folios = function(){
			var filtromes = $("#filtromes").val();
			var filtroano = $("#filtroano").val();
			var filtrotipo = $("input[name=filtrotipo]:checked").val();
      var table = $("#dt_folios").DataTable({
				"destroy":"true",
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {"opcion": filtrotipo, "filtromes": filtromes, "filtroano": filtroano},
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
