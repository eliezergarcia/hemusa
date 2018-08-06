<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Información de factura</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
			<div class="page-head">
					<h2 class="page-head-title">Nota de crédito</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb page-head-nav">
								<li class="breadcrumb-item"><a href="#">Créditos y cobranza</a></li>
								<li class="breadcrumb-item"><a href="#">Pagos de cliente</a></li>
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
											<div class="col-2 table-filters"><span class="table-filter-title">Cliente</span>
												<div class="filter-container">
													<div class="row">
														<div class="col-12">
															<label class="control-label"></label>
															<input type="text" name="cliente" id="cliente" value="" class="form-control form-control-sm" required>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
												<div class="filter-container">
													<div class="row">
														<div class="col-6">
															<label class="control-label">Inicio:</label>
															<input type="date" name="fechainicio" id="fechainicio" value="" class="form-control form-control-sm" required>
														</div>
														<div class="col-6">
															<label class="control-label">Fin:</label>
															<input type="date" name="fechafin" id="fechafin" value="" class="form-control form-control-sm" required>
														</div>
													</div>
												</div>
											</div>
											<div class="col-1 table-filters"><span class="table-filter-title">Folio</span>
												<div class="filter-container">
													<div class="row">
														<div class="col-12">
															<label class="control-label"></label>
															<input type="text" name="folio" id="folio" value="" class="form-control form-control-sm">
														</div>
													</div>
												</div>
											</div>
											<div class="col-1 table-filters"><span class="table-filter-title"></span>
												<div class="filter-container">
													<div class="row">
														<div class="col-12">
															<label class="control-label"></label>
															<button type="submit" id="buscar-notas" class="btn btn-lg btn-primary">Buscar</button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-5 table-filters"><span class="table-filter-title"></span>
												<div class="filter-container">
													<div class="row">
														<div class="col-12">
															<label class="control-label"></label>
															<!-- <button type="button" class="btn btn-lg btn-success" data-toggle='modal' data-target='#modalNotaCredito'>Nueva nota de crédito</button> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<br>
								<button type="button" class="btn btn-lg btn-success btn-space" data-toggle='modal' data-target='#modalNotaCredito'>Nueva nota de crédito</button>

							<!-- Tabla de notas de crédito -->
								<br>
								<table id="dt_notas_credito" class="table table-bordered table-striped display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Folio</th>
											<th>Fecha</th>
											<th>Cliente</th>
											<th>Factura</th>
											<th>Descripción</th>
											<th>Valor</th>
											<th>Subtipo</th>
										</tr>
									</thead>
								</table>


						<!-- Modal Nueva Nota de Crédito -->
							<div class="modal fade colored-header colored-header-success" id="modalNotaCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="exampleModalLabel"><b>Nota de crédito</b></h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<h5><i class="fa fa-info-circle" aria-hidden="true"></i> Por favor ingresa la siguiente información para la creación de: Nota de crédito.</h5>
												<h5>&nbsp;&nbsp;&nbsp;&nbsp;Los campos marcados con <font color="#FF4136">*</font> son obligatorios.</h5><br>
												<div class="row">
													<div class="form-group col-6">
														<label for="">Tipo de CFDI <font color="#FF4136">*</font></label>
														<select name="tipoDocumento" id="tipoDocumento" class="form-control form-control-sm col-12">
															<option value="nota_credito" selected>Nota de crédito</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">Uso CFDI <font color="#FF4136">*</font></label>
														<select name="usoCFDI" id="usoCFDI" class="form-control form-control-sm col-12">
															<option value="G02" selected>Devoluciones, descuentos o bonificaciones</option>
														</select>
													</div>
													<div class="form-group col-8">
														<label for="">Cliente <font color="#FF4136">*</font></label>
														<select name="cliente" id="cliente" class="form-control form-control-sm col-12">
														</select>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="form-group col-6">
														<label for="">Serie <font color="#FF4136">*</font></label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>NC</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">No. de orden/pedido</label>
														<input type="text" class="form-control form-control-sm col-12" placeholder="No. de pedido">
													</div>
													<div class="form-group col-6">
														<label for="">Método de pago</label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>Pago en una sola exhibición</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">Forma de pago <font color="#FF4136">*</font></label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>Seleccionar</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">Condiciones de pago</label>
														<input type="text" class="form-control form-control-sm col-12">
													</div>
													<div class="form-group col-6">
														<label for="">Moneda <font color="#FF4136">*</font></label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>MXN</option>
															<option value="">USD</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">Número de decimales <font color="#FF4136">*</font></label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>2</option>
															<option value="">3</option>
															<option value="">4</option>
														</select>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="form-group col-6">
														<label for="">Concepto <font color="#FF4136">*</font> <i class="fa fa-info-circle" aria-hidden="true"></i></label>
														<input type="text" class="form-control form-control-sm col-12" placeholder="Selecciona un producto o servicio de lista de productos">
													</div>
													<div class="form-group col-6">
														<label for="">Cantidad <font color="#FF4136">*</font></label>
														<input type="text" class="form-control form-control-sm col-12" value="1">
													</div>
													<div class="form-group col-6">
														<label for="">Unidad <font color="#FF4136">*</font></label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>Seleccionar</option>
														</select>
													</div>
													<div class="form-group col-6">
														<label for="">Precio unitario <font color="#FF4136">*</font></label>
														<input type="text" class="form-control form-control-sm col-12" value="0.00">
													</div>
													<div class="form-group col-6">
														<label for="">Subtotal</label>
														<input type="text" class="form-control form-control-sm col-12" value="$0.00">
													</div>
													<div class="form-group col-3">
														<label for="">IVA</label>
														<select name="" id="" class="form-control form-control-sm col-12">
															<option value="" selected>16%</option>
														</select>
													</div>
													<div class="form-group col-3">
														<label for="">Total</label>
														<input type="text" class="form-control form-control-sm col-12" value="$0.00">
													</div>
													<div class="form-group col-6">
														<label for="">Clave SAT <font color="#FF4136">*</font></label>
														<input type="text" class="form-control form-control-sm col-12" placeholder="Clave SAT">
													</div>
												</div>
												<hr>

											</div>
											<div class="modal-footer invoice-footer">
												<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" id="" class="btn btn-lg btn-success">Agregar</button>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
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
			buscar_clientes();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#cobranza-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#pagoscliente-menu").addClass("active");
    }

		function buscar_clientes() {
			opcion = "buscarclientes";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var clientes = data;
					console.log(clientes);
					var input = document.getElementById("cliente");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = clientes;
					$("#cliente").focus();
				}
			});
		}

		$("#buscar-notas").on("click", function () {
			var opcion = "notascredito";
			var cliente = $("#cliente").val();
			var fechainicio = $("#fechainicio").val();
			var fechafin = $("#fechafin").val();
			var folio = $("#folio").val();
 			var table = $('#dt_notas_credito').DataTable({
				"order": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"opcion": opcion, "cliente": cliente, "fechainicio": fechainicio, "fechafin": fechafin, "folio": folio},
				},
				"columns":[
					{"data":"folio"},
					{"data":"fecha"},
					{"data":"cliente"},
					{"data":"factura"},
					{"data":"descripcion"},
					{"data":"valor"},
					{"data":"subtipo"}
				],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-header'<'col-sm-6 col-xs-12'B><'col-sm-6 col-xs-12 text-right'f>>" +
    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
    			"<'row be-datatable-footer'<'col-sm-5 col-xs-12'i><'col-sm-7 col-xs-12'p>>",
				"buttons": [
					{
						extend: 'collection',
						text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
						"className": "btn btn-lg btn-space btn-secondary",
						buttons: [
								{
									extend: 'excelHtml5',
									text: '<i class="fas fa-file-alt fa-lg"></i> Excel',
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
			var cliente = $("#cliente").val("");
			var fechainicio = $("#fechainicio").val("");
			var fechafin = $("#fechafin").val("");
			var folio = $("#folio").val("");
		});

		$('#myModal').on('shown.bs.modal', function (e) {
		  // do something...
		})

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
