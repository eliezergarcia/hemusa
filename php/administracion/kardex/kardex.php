<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
	$mes = date("m");
	$ano = date("Y");
?>
<!DOCTYPE html>
</html lang="es">
<head>
	<title>Kardex</title>
	<?php include("../../enlacescss.php"); ?>
</head>
<body>
	<?php include("../../header.php"); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Kardex artículo</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Kardex</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                    		<div class="card-body">
                          <form class="" action="#" method="post">
                            <div class="row table-filters-container">
                              <div class="col-12">
                                <div class="row align-items-end">
                                  <div class="col-2 table-filters"><span class="table-filter-title">Herramienta</span>
                                    <div class="filter-container">
                                      <div class="row">
                                        <div class="col-6">
                                          <label class="control-label">Marca:</label>
                                          <input type="text" name="marca" id="marca" value="" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-6">
                                          <label class="control-label">Modelo:</label>
                                          <input type="text" name="modelo" id="modelo" value="" class="form-control form-control-sm" required>
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
                                  <div class="col-1 table-filters"><span class="table-filter-title">Estado</span>
                                    <div class="filter-container">
                                      <div class="row">
                                        <div class="col-12">
                                          <label class="control-label"></label>
                                          <select class="form-control form-control-sm select2" name="estado" id="estado" required>
                                            <option value="todo">Todo</option>
                                            <option value="pedido">Pedido</option>
                                            <option value="compra">Compra</option>
                                            <option value="venta">Venta</option>
                                            <option value="devolucion">Devolución</option>
                                            <option value="modificacion">Modificación</option>
                                            <option value="alta">Alta</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-1 table-filters"><span class="table-filter-title"></span>
                                    <div class="filter-container">
                                      <div class="row">
                                        <div class="col-12">
                                          <label class="control-label"></label>
                                          <button type="submit" id="buscar-informacion" class="btn btn-lg btn-primary">Buscar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>

                          <!-- Tabla de Pedidos -->
                            <h2>Pedidos</h2><br>
                            <table id="dt_pedidos" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Marca</th>
                                  <th>Modelo</th>
                                  <th>Descripción</th>
                                  <th>Cantidad</th>
                                  <th>Fecha pedido</th>
                                  <th>Proveedor</th>
                                  <th>Cliente</th>
                                </tr>
                              </thead>
                            </table>

                            <!-- Tabla de Pedidos -->
                              <br><h2>Compras</h2><br>
                              <table id="dt_compras" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Orden compra</th>
                                    <th>Cliente</th>
                                    <th>Recibido</th>
                                    <th>Costo</th>
                                    <th>Moneda</th>
                                  </tr>
                                </thead>
                              </table>

                            <!-- Tabla de Pedidos -->
                              <br><h2>Ventas</h2><br>
                              <table id="dt_ventas" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Cliente</th>
                                    <th>Proveedor</th>
                                    <th>Precio venta</th>
                                    <th>Moneda</th>
                                    <th>Entregado</th>
                                    <th>Remision</th>
                                    <th>Factura</th>
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
	<?php include("../../enlacesjs.php"); ?>
	<script>
		$(document).ready(function(){
			App.init();
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
      buscar();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#kardex-menu").addClass("active");
    }

    function buscar (){
      $("form").on("submit", function (e) {
        e.preventDefault();
        var estado = $("#estado").val();
        switch (estado) {
          case 'pedido':
            var marca = $("#marca").val();
            var modelo = $("#modelo").val();
            var fechainicio = $("#fechainicio").val();
            var fechafin = $("#fechafin").val();
            listar_pedidos(marca, modelo, fechainicio, fechafin, estado);
            break;

          case 'compra':
            var marca = $("#marca").val();
            var modelo = $("#modelo").val();
            var fechainicio = $("#fechainicio").val();
            var fechafin = $("#fechafin").val();
            listar_compras(marca, modelo, fechainicio, fechafin, estado);
            break;

          case 'venta':
            var marca = $("#marca").val();
            var modelo = $("#modelo").val();
            var fechainicio = $("#fechainicio").val();
            var fechafin = $("#fechafin").val();
            listar_ventas(marca, modelo, fechainicio, fechafin, estado);
            break;

          case 'todo':
            var marca = $("#marca").val();
            var modelo = $("#modelo").val();
            var fechainicio = $("#fechainicio").val();
            var fechafin = $("#fechafin").val();
            estado = "pedido";
            listar_pedidos(marca, modelo, fechainicio, fechafin, estado);
            estado = "compra";
            listar_compras(marca, modelo, fechainicio, fechafin, estado);
            estado = "venta";
            listar_ventas(marca, modelo, fechainicio, fechafin, estado);
            break;
        }
      });
    }

		function listar_pedidos(marca, modelo, fechainicio, fechafin, estado) {
			var table = $("#dt_pedidos").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"estado": estado, "marca": marca, "modelo": modelo, "fechainicio": fechainicio, "fechafin": fechafin}
				},
				"columns":[
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "descripcion"},
					{"data": "cantidad"},
					{"data": "fechapedido"},
					{"data": "proveedor"},
          {"data": "cliente"}
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
            ],
  				}
				]
			});
		}

    function listar_compras(marca, modelo, fechainicio, fechafin, estado) {
			var table = $("#dt_compras").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"estado": estado, "marca": marca, "modelo": modelo, "fechainicio": fechainicio, "fechafin": fechafin}
				},
				"columns":[
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "descripcion"},
					{"data": "cantidad"},
					{"data": "ordencompra"},
					{"data": "cliente"},
          {"data": "recibido"},
          {"data": "costo"},
          {"data": "moneda"}
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
            ],
  				}
				]
			});
		}

    function listar_ventas(marca, modelo, fechainicio, fechafin, estado) {
			var table = $("#dt_ventas").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"estado": estado, "marca": marca, "modelo": modelo, "fechainicio": fechainicio, "fechafin": fechafin}
				},
				"columns":[
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "descripcion"},
					{"data": "cantidad"},
					{"data": "cliente"},
					{"data": "proveedor"},
          {"data": "precioventa"},
          {"data": "moneda"},
          {"data": "entregado"},
          {"data": "remision"},
          {"data": "factura"}
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
            ],
  				}
				]
			});
		}


	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
