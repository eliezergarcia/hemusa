<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Salida Nacional</title>
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
                <li class="breadcrumb-item"><a href="controldesalida.php" class="text-primary">Control de salida</a></li>
                <li class="breadcrumb-item"><a href="#">Salida Nacional</a></li>
            </ol>
          </nav>
      </div>
			<div class="main-content container-fluid">
					<div class="row full-calendar">
						<div class="col-lg-12">
								<div class="card card-fullcalendar">
									<div class="card-body">
										<!-- Tabla Ordenes de Compras -->
											<br>
											<table id="dt_partidas" class="table table-striped table-hover compact" cellspacing="0" width="100%">
												<thead>
													<tr>
                            <th>#</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Recibido</th>
                            <th>Cliente</th>
                            <th>Proveedor</th>
                            <th>Factura Proveedor</th>
													</tr>
												</thead>
											</table>
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
			listar_partidas();
		});

		var listar_partidas = function(){
      var folio = "<?php echo $_REQUEST['folio']; ?>";
			var opcion = "partidasnacional";
			var table = $("#dt_partidas").DataTable({
				"destroy":"true",
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {"opcion": opcion, "folio": folio},
				},
				"columns":[
          {"data":'indice'},
          {"data":'marca'},
          {"data":'modelo'},
          {"data":'cantidad'},
          {"defaultContent": ''},
          {"data":'cliente'},
          {"data":'proveedor'},
          {"data":'facturaproveedor'}
				],
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
		}
	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
