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
                      <div class="col-1"><span class="table-filter-title">Factura</span>
                        <div class="filter-container">
                          <form>
                            <div class="row">
                              <div class="col-12">
                                <label class="control-label"></label>
                                <input type="text" name="factura" id="factura" value="" class="form-control form-control-sm">
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
                                <button id="buscar-informacion" type="button" name="button" class="btn btn-lg btn-primary">Buscar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Tabla de Reportes de Ventas -->
                  <br>
                  <table id="dt_factura" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Factura</th>
                        <th>Fecha factura</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>Iva</th>
                        <th>Total</th>
                        <th>Moneda</th>
                        <th>Pagado</th>
                        <th>Moneda Pago</th>
                        <th>Banco</th>
                        <th>Fecha pago</th>
                      </tr>
                    </thead>
                  </table>

                <!-- Tabla de Reportes de Ventas -->
                  <br>
                  <table id="dt_herramienta" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Remisión</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Cantidad</th>
                        <th>Folio</th>
                        <th>Fecha recibido</th>
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
