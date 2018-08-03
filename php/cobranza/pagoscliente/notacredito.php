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
					<h2 class="page-head-title">Información de factura</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb page-head-nav">
								<li class="breadcrumb-item"><a href="#">Créditos y cobranza</a></li>
								<li class="breadcrumb-item"><a href="#">Información de factura</a></li>
						</ol>
					</nav>
			</div>
			<div class="main-content container-fluid">
				<div class="row full-calendar">
					<div class="col-lg-12">
						<div class="card card-fullcalendar">
							<div class="card-body">
                <h3>Nueva nota de crédito</h3>
      					<hr>
      					<h5><i class="fa fa-info-circle" aria-hidden="true"></i> Por favor ingresa la siguiente información para la creación de: Nota de crédito.</h5>
      					<h5>&nbsp;&nbsp;&nbsp;&nbsp;Los campos marcados con * son obligatorios.</h5><br>
      					<div class="row">
      						<div class="form-group col-6">
      							<label for="">Tipo de CFDI *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Nota de crédito</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Cliente *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>VENTAS AL PUBLICO EN GENERAL</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Lugar de expedición *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Principal</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Fecha de CFDI *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Timbrar con fecha actual</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Uso CFDI *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Seleccionar</option>
      								<option value="">Adquisición de mercancias</option>
      								<option value="">Devolución</option>
      								<option value="">Descuento o bonificación</option>
      								<option value="">Gastos en general</option>
      								<option value="">Por definir</option>
      							</select>
      						</div>
      					</div>
      					<br>
      					<h3>Datos de remisión</h3>
      					<hr>
      					<div class="row">
      						<div class="form-group col-6">
      							<label for="">Serie *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>NC</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">No. de orden/pedido</label>
      							<input type="text" class="form-control col-8" placeholder="No. de pedido">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Método de pago</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Pago en una sola exhibición</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Forma de pago *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Seleccionar</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Condiciones de pago</label>
      							<input type="text" class="form-control col-8">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Moneda *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>MXN</option>
      								<option value="">USD</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Número de decimales *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>2</option>
      								<option value="">3</option>
      								<option value="">4</option>
      							</select>
      						</div>
      					</div>
      					<br>
      					<h3>Conceptos</h3>
      					<hr>
      					<div class="row">
      						<div class="form-group col-6">
      							<label for="">Concepto * <i class="fa fa-info-circle" aria-hidden="true"></i></label>
      							<input type="text" class="form-control col-9" placeholder="Selecciona un producto o servicio de lista de productos">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Cantidad *</label>
      							<input type="text" class="form-control col-8" value="1">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Unidad *</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>Seleccionar</option>
      							</select>
      						</div>
      						<div class="form-group col-6">
      							<label for="">Precio unitario *</label>
      							<input type="text" class="form-control col-8" value="0.00">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Subtotal</label>
      							<input type="text" class="form-control col-8" value="$0.00">
      						</div>
      						<div class="form-group col-3">
      							<label for="">IVA</label>
      							<select name="" id="" class="form-control col-8">
      								<option value="" selected>16%</option>
      							</select>
      						</div>
      						<div class="form-group col-3">
      							<label for="">Total</label>
      							<input type="text" class="form-control col-8" value="$0.00">
      						</div>
      						<div class="form-group col-6">
      							<label for="">Clave SAT *</label>
      							<input type="text" class="form-control col-8" placeholder="Clave SAT">
      						</div>
      					</div>
      					<hr>
      					<div class="row justify-content-end">
      						<button class="btn btn-outline-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Parte</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      						<button class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Concepto</button>
      					</div>
      					<br>
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
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#cobranza-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#pagoscliente-menu").addClass("active");
    }

    $("#buscar-informacion").on("click", function () {
      var factura = $("#factura").val();
      informacion_factura(factura);
      herramienta_factura(factura);
    });

		var informacion_factura = function(factura){
      var opcion = "informacionfactura";
			var table = $('#dt_factura').DataTable({
				"order": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"factura": factura, "opcion": opcion},
				},
				"columns":[
					{"data":"factura"},
					{"data":"fechafactura"},
					{"data":"cliente"},
					{"data":"subtotal"},
					{"data":"iva"},
					{"data":"total"},
          {"data":"moneda"},
          {"data":"pagado"},
          {"data":"monedapago"},
          {"data":"banco"},
          {"data":"fechapago"}
				],
				// "columnDefs": [
				// 	{ "width": "2%", "targets": 0 },
				// 	// { "width": "13%", "targets": 1 },
				// 	{ "width": "5%", "targets": 2 },
				// 	{ "width": "8%", "targets": 3 },
				// 	{ "width": "5%", "targets": 4 },
				// 	{ "width": "8%", "targets": 5 },
				// 	{ "width": "8%", "targets": 6 },
				// 	{ "width": "8%", "targets": 7 },
				// 	{ "width": "5%", "targets": 8 },
				// ],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-12'tr>>"
    			// "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
			});
		}

    var herramienta_factura = function(factura){
      var opcion = "herramientafactura";
			var table = $('#dt_herramienta').DataTable({
				"order": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"factura": factura, "opcion": opcion},
				},
				"columns":[
          {"data":"indice"},
					{"data":"remision"},
					{"data":"marca"},
					{"data":"modelo"},
					{"data":"cantidad"},
					{"data":"folio"},
					{"data":"fecharecibido"}
				],
				// "columnDefs": [
				// 	{ "width": "2%", "targets": 0 },
				// 	// { "width": "13%", "targets": 1 },
				// 	{ "width": "5%", "targets": 2 },
				// 	{ "width": "8%", "targets": 3 },
				// 	{ "width": "5%", "targets": 4 },
				// 	{ "width": "8%", "targets": 5 },
				// 	{ "width": "8%", "targets": 6 },
				// 	{ "width": "8%", "targets": 7 },
				// 	{ "width": "5%", "targets": 8 },
				// ],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'>>" +
    			"<'row be-datatable-body justify-content-start'<'col-sm-6'tr>>"
    			// "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
			});
		}

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
