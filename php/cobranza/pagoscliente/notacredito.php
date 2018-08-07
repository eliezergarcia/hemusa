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
						        					<label for="entorno">Seleccione el entorno: <font color="#FF4136">*</font></label>
															<select type="text" id="entorno" name="entorno" class="form-control form-control-sm">
																<option value="produccion">Produccion</option>
																<option value="pruebas">Pruebas</option>
															</select>
						        				</div>
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
														<div class="form-group col-6">
															<label for="">Cliente <font color="#FF4136">*</font></label>
															<select name="clientenc" id="clientenc" class="form-control form-control-sm col-12" onchange="datos_cliente()">
															</select>
														</div>
													</div>
													<hr>
													<div class="row">
														<div class="form-group col-6">
															<label for="">No. de orden/pedido</label>
															<input type="text" name="ordenpedido" id="ordenpedido" class="form-control form-control-sm col-12" placeholder="No. de pedido">
														</div>
														<div class="form-group col-6">
															<label for="">Forma de pago <font color="#FF4136">*</font></label>
															<select type="text" id="formaPago" name="formaPago" class="form-control form-control-sm">
																<option value="1">Efectivo</option>
																<option value="2">Cheque nominativo</option>
																<option value="3">Transferencia electrónica de fondos</option>
																<option value="4">Tarjeta de crédito</option>
																<option value="5">Monedero electrónico</option>
																<option value="6">Dinero electrónico</option>
																<option value="7">Vales de despensa</option>
																<option value="8">Tarjeta de débito</option>
																<option value="9">Tarjeta de servicio</option>
																<option value="10">Otros</option>
																<option value="11">NA</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label for="">Método de pago <font color="#FF4136">*</font></label>
															<select type="text" id="metodoPago" name="metodoPago" class="form-control form-control-sm">
																<option value="1">Pago en una sola exhibición</option>
																<option value="2">Pago en parcialidades o diferido</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label for="">Condiciones de pago <font color="#FF4136">*</font></label>
															<input type="text" name="condicionesPago" id="condicionesPago" class="form-control form-control-sm col-12">
														</div>
														<div class="form-group col-4">
															<label for="">Moneda <font color="#FF4136">*</font></label>
															<select name="moneda" id="moneda" class="form-control form-control-sm col-12">
																<option value="mxn" selected>MXN</option>
																<option value="usd">USD</option>
															</select>
														</div>
														<div class="form-group col-4">
						        					<label for="fecha">Fecha <font color="#FF4136">*</font></label>
						        					<input type="text" id="fecha" name="fecha" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" required>
						        				</div>
														<div class="form-group col-4">
															<label for="tipoCambio">Tipo de cambio </label>
															<input type="text" id="tipoCambio" name="tipoCambio" class="form-control form-control-sm" required>
														</div>
													</div>
													<hr>
													<div class="row">
														<div class="form-group col-6">
															<label for="">Concepto <font color="#FF4136">*</font></label>
															<input type="text" name="concepto" id="concepto" class="form-control form-control-sm col-12" placeholder="Descripción">
														</div>
														<div class="form-group col-6">
															<label for="">Cantidad <font color="#FF4136">*</font></label>
															<input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm col-12" value="1" onchange="cambiar_total()">
														</div>
														<div class="form-group col-6">
															<label for="">Unidad <font color="#FF4136">*</font></label>
															<select name="unidad" id="unidad" class="form-control form-control-sm col-12">
																<option value="H87" selected>Pieza</option>
																<option value="E48" selected>Unidad de servicio</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label for="">Precio unitario <font color="#FF4136">*</font></label>
															<input type="number" name="precioUnitario" id="precioUnitario" class="form-control form-control-sm col-12" value="0.00" onchange="cambiar_total()">
														</div>
														<div class="form-group col-6">
															<label for="">Subtotal</label>
															<input type="number" name="subtotal" id="subtotal" class="form-control form-control-sm col-12" value="0.00" onchange="cambiar_total()">
														</div>
														<div class="form-group col-3">
															<label for="">IVA</label>
															<select name="iva" id="iva" class="form-control form-control-sm col-12">
																<option value="1.16" selected>16%</option>
															</select>
														</div>
														<div class="form-group col-3">
															<label for="">Total</label>
															<input type="number" name="total" id="total" class="form-control form-control-sm col-12" value="0.00" onchange="cambiar_total()">
														</div>
														<div class="form-group col-6">
															<label for="">Clave SAT <font color="#FF4136">*</font></label>
															<select name="claveSat" id="claveSat" class="form-control form-control-sm col-12">
																<option value="27113201" selected>27113201</option>
															</select>
														</div>
													</div>
													<hr>

												</div>
												<div class="modal-footer invoice-footer">
													<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
													<button type="button" id="generar-notacredito" class="btn btn-lg btn-success">Agregar</button>
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

	<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<div class="text-center">
						<div class="texto1">
							<br><br>
							<h3>Espere un momento...</h3>
							<h4>Se está generando la factura</h4>
							<br>
							<div class="text-center">
								<div class="be-spinner">
									<svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
										<circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
									</svg>
								</div>
							</div>
						</div>
						<div class="mt-8">
						</div>
					</div>
				</div>
				<div class="modal-footer"></div>
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

		function datos_cliente() {
			opcion = "datoscliente";
			var RFC = $("#clientenc").val();
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "RFC": RFC},
				success : function(data) {

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

		$('#modalNotaCredito').on('shown.bs.modal', function (e) {
			var opcion = "buscarclientesnc";
		  $.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data:{"opcion": opcion},
			}).done( function ( data ) {
				var clientes = data;
				var total = (clientes.data).length;
				console.log(total);
				$("select[name=clientenc]").append("<option value=''>Selecciona un cliente...</option>");
				for(var i=0;i<=total;i++){
					 $("select[name=clientenc]").append("<option value='"+ clientes.data[i].RFC + "'>" + clientes.data[i].nombreEmpresa + "</option>");
					 $("#tipoCambio").val(clientes.data[i].tipocambio);
				};
			});
		})

		function cambiar_total() {
			var cantidad = $("#cantidad").val();
			var precioUnitario = $("#precioUnitario").val();
			var subtotal = $("#subtotal").val();
			var iva = $("#iva").val();
			var total = $("#total").val();

			$("#subtotal").val((precioUnitario * cantidad).toFixed(2));
			$("#total").val(((precioUnitario * cantidad) * iva).toFixed(2));
		}

		$("#generar-notacredito").on("click", function () {
			var RFC = $("#clientenc").val();

			var request = new XMLHttpRequest();

			request.open('GET', apiConfig.enlace+'api/v1/clients/'+RFC);

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());
					console.log('Body:', this.responseText);
					var data = JSON.parse(this.responseText);

					if (data.status == 0){
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-danger'><span class='modal-main-icon mdi mdi-close-circle-o'></span></div>");
							$(".texto1").append("<h3>Error!</h3>");
							$(".texto1").append("<h4>Ocurrió un problema al conectar a  portal 'Factura.com'.</h4>");
						}, 350);
						setTimeout( function () {
							$("#mod-success").modal("hide");
							$(".texto1").html("");
							$(".texto1").append("<br><br>");
							$(".texto1").append("<h3>Espere un momento...</h3>");
							$(".texto1").append("<h4>Se está generando la nota de crédito</h4>");
							$(".texto1").append("<br>");
							$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
							$(".texto1").append("<br>");
							$(".texto1").append("<br>");
						}, 3000);
					}else if (data.status == "error") {
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-warning'><span class='modal-main-icon mdi mdi-alert-triangle'></span></div>");
							$(".texto1").append("<h3>Aviso!</h3>");
							$(".texto1").append("<h4>El cliente no esta registrado en portal 'Factura.com'</h4>");
							$(".texto1").append("<div class='text-center'>");
								$(".texto1").append("<p>Registrarlo a continuación para poder facturar.</p>");
								$(".texto1").append("</div>");
							}, 425);
							buscarDatosCliente(RFC);
						}else{
							var UID = data.Data.UID;
							generar_factura(RFC, UID);
						}
					}
				}

			request.send();

		});

		function generar_factura(RFC, UID) {
			var tipoDocumento = $("#tipoDocumento").val();
			var usoCFDI = $("#usoCFDI").val();
			var RFC = $("#clientenc").val();
			var ordenpedido = $("#ordenpedido").val();
			var formaPago = $("#formaPago").val();
			var metodoPago = $("#metodoPago").val();
			var condicionesPago = $("#condicionesPago").val();
			var moneda = $("#moneda").val();
			var concepto = $("#concepto").val();
			var cantidad = $("#cantidad").val();
			var unidad = $("#unidad").val();
			var precioUnitario = $("#precioUnitario").val();
			var subtotal = $("#subtotal").val();
			var iva = $("#iva").val();
			var total = $("#total").val();
			var claveSat = $("#claveSat").val();

			console.log(tipoDocumento);
			console.log(usoCFDI);
			console.log(RFC);
			console.log(ordenpedido);
			console.log(formaPago);
			console.log(metodoPago);
			console.log(condicionesPago);
			console.log(moneda);
			console.log(concepto);
			console.log(cantidad);
			console.log(unidad);
			console.log(precioUnitario);
			console.log(subtotal);
			console.log(iva);
			console.log(total);
			console.log(claveSat);


			var request = new XMLHttpRequest();

			request.open('POST', apiConfig.enlace+'api/v3/cfdi33/create');
			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());
					console.log('Body:', this.responseText);
					var data = JSON.parse(this.responseText);
					if (data.response == "error" && typeof data.message.message != "undefined") {
						$("#mod-success").modal("hide");
						$.gritter.add({
							title: 'Error!',
							text: data.message.message+'<br>'+data.message.messageDetail,
							class_name: 'color danger'
						});
					}else if (data.response == "error" && typeof data.message != "undefined") {
						$("#mod-success").modal("hide");
						$.gritter.add({
							title: 'Aviso!',
							text: data.message,
							class_name: 'color warning'
						});
					}else{
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La nota de crédito se generó correctamente en el portal 'Factura.com'.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>En un momento se descargará el archivo PDF.</p>");
							$(".texto1").append("</div>");
						}, 350);
						var UIDFactura = data.uid;
						var UUIDFactura = data.UUID;
						var tipoDocumento = $("#frmInformacionFactura #tipoDocumento").val();
						var moneda = $("#frmInformacionFactura #moneda").val();
						apiConfig.opcion = $("#frmInformacionFactura #entorno").val();
						if (apiConfig.opcion == "produccion"){
							// guardarFactura(numeroPedido, refCotizacion, herramienta, tipoDocumento, moneda, UIDFactura, UUIDFactura);
						}else{
							var request = new XMLHttpRequest();

							request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDFactura+'/pdf');

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
									var blob = new Blob([this.response], {type: 'application/pdf'});
									var link = document.createElement('a');
									link.href = window.URL.createObjectURL(blob);
									link.download = "facturaprueba.pdf";
									link.click();
								}
							};
							request.send();
						}
					}
				}
			};

			var body = {
				'Receptor': {
					'UID': UID,
					'ResidenciaFiscal': '',
				},
				'TipoDocumento': tipoDocumento,
				'Conceptos': [{
		        'ClaveProdServ': claveSat,
		        'Cantidad': cantidad,
		        'ClaveUnidad': unidad,
		        'Unidad': 'Unidad de servicio',
		        'ValorUnitario': precioUnitario,
		        'Descripcion': concepto,
		        'Impuestos':{
		            'Traslados':[{'Base' : subtotal, 'Impuesto': '002', 'TipoFactor': 'Tasa', 'TasaOCuota': 0.16, 'Importe': subtotal * iva}],
		        }
		    }],
				'UsoCFDI': usoCFDI,
				'Serie': apiConfig.serienc,
				'FormaPago': formaPago,
				'MetodoPago': metodoPago,
				'CondicionesDePago': condicionesPago,
				'Cuenta': "",
				'Moneda': (moneda).toUpperCase(),
				'TipoCambio': "",
				'NumOrder': ordenpedido,
				'FechaFromAPI': "",
				'Comentarios': condicionesPago
			};
			console.log(JSON.stringify(body));
			// request.send(JSON.stringify(body));

		}
	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
