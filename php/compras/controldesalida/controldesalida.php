<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
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
                <li class="breadcrumb-item"><a href="#">Compras</a></li>
                <li class="breadcrumb-item"><a href="#">Control de salida</a></li>
            </ol>
          </nav>
      </div>
			<div class="main-content container-fluid">
					<div class="row full-calendar">
						<div class="col-lg-12">
								<div class="card card-fullcalendar">
									<div class="card-body">
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
			App.pageCalendar();
			App.formElements();
			App.uiNotifications();
			listar_nacional();
		});

		var listar_nacional = function(){
			$("#nacional").slideDown("slow");
      $("#importacion").slideUp("slow");
      $("#btnnacional").removeClass("btn-secondary");
      $("#btnnacional").addClass("btn-primary");
      $("#btnimportacion").removeClass("btn-primary");
      $("#btnimportacion").addClass("btn-secondary");
			var opcion = "nacional";
			var table = $("#dt_nacional").DataTable({
				"destroy":"true",
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {"opcion": opcion},
				},
				"columns":[
					{"data": "folio"},
					{"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-primary btn-lg'><i class='fas fa-edit fa-sm'></i></button></div>", "sortable": false},
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


			obtener_data_ver_salida_nacional("#dt_nacional tbody", table);
		}

		var listar_importacion = function(){
			$("#importacion").slideDown("slow");
      $("#nacional").slideUp("slow");
      $("#btnimportacion").removeClass("btn-secondary");
      $("#btnimportacion").addClass("btn-primary");
      $("#btnnacional").removeClass("btn-primary");
      $("#btnnacional").addClass("btn-secondary");
			var opcion = "importacion";
			var table = $("#dt_importacion").DataTable({
				"destroy":"true",
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {"opcion": opcion},
				},
				"columns":[
					{"data": "pedimento"},
					{"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-primary btn-lg'><i class='fas fa-edit fa-sm'></i></button></div>", "sortable": false},
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

			obtener_data_ver_salida_importacion("#dt_importacion tbody", table);
		}

		var obtener_data_ver_salida_nacional = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
				folio = data.folio;
				window.location="verSalidaNacional.php?folio="+folio;
      });
    }

		var obtener_data_ver_salida_importacion = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
				pedimento = data.pedimento;
				window.location="verSalidaImportacion.php?pedimento="+pedimento;
      });
    }
	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
