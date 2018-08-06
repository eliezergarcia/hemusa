<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
	$mes = date("m");
	$ano = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Facturas</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
    	<div class="page-head">
        	<h2 class="page-head-title">Facturas</h2>
        	<nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="#">Facturación</a></li>
                <li class="breadcrumb-item"><a href="#">Facturas</a></li>
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
											<div class="col-3 table-filters"><span class="table-filter-title">Referencia</span>
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-8">
																<label class="control-label">Palabra:</label>
																<input type="text" class="form-control form-control-sm" name="filtroreferencia" id="filtroreferencia" value="">
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

              	<!-- Tabla de Facturas -->
									<table id="dt_facturas" class="table table-striped table-hover display compact" cellspacing="0" width="100%" >
										<thead>
											<tr>
												<th>#</th>
												<th>Folio</th>
												<th>Orden/Pedido</th>
												<th>Remisión</th>
												<th>Total</th>
												<th>Pagado</th>
												<th>Status</th>
												<th>Fecha de creación</th>
												<th>Cliente</th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</thead>
									</table>
							</div>
            </div>
          </div>
      	</div>
			</div>
		</div>

		<!-- Modal Cancelar Factura -->
      <form id="frmCancelarFactura" action="" method="POST">
        <input type="hidden" id="opcion" name="opcion" value="cancelarfactura">
        <input type="hidden" id="uidFactura" name="uidFactura" value="">
        <div class="modal fade" id="modalCancelarFactura" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
              </div>
              <div class="modal-body">
                <div class="text-center">
                  <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                  <h4>Selecciona el motivo de cancelación de la factura: <h4 id="foliocancelacion"></h4></h4>
                  <div class="row justify-content-center">
										<div class="col-10">
											<select class="form-control form-control-sm select2" name="motivoCancelacion" id="motivoCancelacion">
												<option selected>Error en datos fiscales (RFC, domicilio, nombre o razón social)</option>
												<option>Error en forma o método de pago (contado, parcialidad, efectivo, transferencia)</option>
												<option>Error en los montos (facturar de más o de menos)</option>
												<option>No pago de la factura electrónica</option>
												<option>Productos y Servicios (error en el concepto)</option>
												<option>Impuestos aplicables en la factura electrónica</option>
											</select>
										</div>
									</div>
                  <div class="mt-8 invoice-footer">
                    <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="cancelar_factura()" class="btn btn-lg btn-danger">Hecho</button>
                  </div>
                </div>
              </div>
              <div class="modal-footer"></div>
            </div>
          </div>
        </div>
      </form>

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
			$("#filtromes").val("<?php echo $mes; ?>").change();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#facturacion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#facturas-menu").addClass("active");
    }

		$("#filtromes").on("change", function (){
			listar_facturas();
			// $('#dt_facturas').DataTable().ajax.reload();
		});

		$("#filtroano").on("change", function (){
			listar_facturas();
			// $('#dt_facturas').DataTable().ajax.reload();
		});

		$('input[name=filtrotipo]').change(function() {
			listar_facturas();
			// $('#dt_facturas').DataTable().ajax.reload();
		});

		$('input[name=filtroestado]').change(function() {
			listar_facturas();
			// $('#dt_facturas').DataTable().ajax.reload();
		});

		$("#filtroreferencia").on("change", function (){
			listar_facturas();
			// $('#dt_facturas').DataTable().ajax.reload();
		});

		var listar_facturas = function(){
			var filtromes = $("#filtromes").val();
			var filtroano = $("#filtroano").val();
			var filtroreferencia = $("#filtroreferencia").val();
      var table = $("#dt_facturas").DataTable({
        "destroy": true,
        "scrollX": true,
				"autoWidth": false,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
					"data": {"filtromes": filtromes, "filtroano": filtroano, "buscar": filtroreferencia}
        },
        "columns":[
					{"defaultContent": ""},
          {"data": "folio"},
          {"data": "ordenpedido"},
					{"data": "remision"},
          {"data": "total"},
          {"data": "pagado"},
          {"data": "status"},
          {"data": "fecha"},
          {"data": "cliente"},
          {"defaultContent": "<div class='invoice-footer'><button class='pdf btn btn-lg btn-primary'><i class='fas fa-file-pdf fa-sm' aria-hidden='true'></i> PDF</button></div>"},
          {"defaultContent": "<div class='invoice-footer'><button class='xml btn btn-lg btn-primary'><i class='fas fa-file-alt fa-sm' aria-hidden='true'></i> XML</button></div>"},
          {"defaultContent": "<div class='invoice-footer'><button class='cancelar btn btn-lg btn-danger'><i class='fas fa-times-circle fa-sm' aria-hidden='true'></i> Cancelar</button></div>"}
        ],
				"order": [1, "desc"],
				"columnDefs": [
					{ "width": "4%", "targets": 0 },
					{ "width": "7%", "targets": 1 },
					{ "width": "10%", "targets": 2 },
					{ "width": "8%", "targets": 3 },
					{ "width": "8%", "targets": 4 },
					{ "width": "8%", "targets": 5 },
					{ "width": "6%", "targets": 6 },
					{ "width": "10%", "targets": 7 },
					{ "width": "5%", "orderable": false, "targets": 9 },
					{ "width": "5%", "orderable": false, "targets": 10 },
					{ "width": "5%", "orderable": false, "targets": 11 },
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
	                  exportOptions: {
	                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	                  }
	                },
	                {
	                  extend: 'csv',
	                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
	                  // "className": "btn btn-lg btn-space btn-secondary",
	                  exportOptions: {
	                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	                  }
	                },
	                {
	                  extend:    'pdfHtml5',
	                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
	                  download: 'open',
	                  // "className": "btn btn-lg btn-space btn-secondary",
	                  exportOptions: {
	                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	                  }
	                },
	                {
	                  extend: 'print',
	                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
	                  header: 'false',
	                  exportOptions: {
	                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	                  },
	                  orientation: 'landscape',
	                  pageSize: 'LEGAL'
	                }
	            ]
	        },
          // {
          //   text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> <i class="fa fa-address-card-o" aria-hidden="true"></i>',
          //   "className": "btn btn-success",
          //   titleAttr: 'Agregar Cliente',
          //   action: function (e, dt, node, config){
          //     $("#modalAgregarCliente").modal("show");
          //   }
          // }
        ]
      });
			table.on( 'order.dt search.dt', function () {
					table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
							cell.innerHTML = i+1;
					} );
			} ).draw();

    	obtener_pdf_factura("#dt_facturas tbody", table);
    	obtener_xml_factura("#dt_facturas tbody", table);
    	obtener_cancelar_factura("#dt_facturas tbody", table);
	  }

		var obtener_pdf_factura = function(tbody, table){
      $(tbody).on("click", "button.pdf", function(){
				$("#mod-spinner").modal("show");
        var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
        var UIDfactura = data.uid;
				var folio = data.folio;
        console.log(UIDfactura);

				var request = new XMLHttpRequest();

				request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDfactura+'/pdf');

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
							$("#mod-spinner").modal("hide");
							var blob = new Blob([this.response], {type: 'application/pdf'});
							var link = document.createElement('a');
							link.href = window.URL.createObjectURL(blob);
							link.download = "H "+folio+".pdf";
							link.click();
						}
				};

				request.send();

	     });
	  }

		var obtener_xml_factura = function(tbody, table){
	    $(tbody).on("click", "button.xml", function(){
				$("#mod-spinner").modal("show");
        var data = table.row( $(this).parents("tr") ).data();
				var folio = data.folio;
				var UIDfactura = data.uid;
				var request = new XMLHttpRequest();

				request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDfactura+'/xml');

				// request.setRequestHeader('Content-Type', 'application/json');
				request.setRequestHeader('Content-type', '"text/xml"; charset="utf8"');
				request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
				request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

				request.onreadystatechange = function () {
					if (this.readyState === 4) {
						console.log('Status:', this.status);
						console.log('Headers:', this.getAllResponseHeaders());
						console.log('Body:', this.responseText);
						$("#mod-spinner").modal("hide");
						var blob = new Blob([this.responseText], {type: 'application/xml'});
						var link = document.createElement('a');
						link.href = window.URL.createObjectURL(blob);
						link.download = "H "+folio+".xml";
						link.click();
					}
				};
				request.send();
	    });
	  }

		var obtener_cancelar_factura = function(tbody, table){
	   $(tbody).on("click", "button.cancelar", function(){
	      var data = table.row( $(this).parents("tr") ).data();
	      $("#uidFactura").val(data.uid);
				$("#foliocancelacion").val(data.folio);
				$("#modalCancelarFactura").modal("show");
	    });
	  }

		function cancelar_factura () {
			$("#modalCancelarFactura").modal("hide");
			$("#mod-spinner").modal("show");
			var frm = $("#frmCancelarFactura").serialize();
			var UIDfactura = $("#uidFactura").val();
			console.log(frm);
			console.log(UIDfactura);
			var request = new XMLHttpRequest();

			request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDfactura+'/cancel');

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());
					console.log('Body:', this.responseText);
					var data = JSON.parse(this.responseText);

					if (data.response == "error") {
						$.gritter.add({
							title: 'Error!',
							text: data.message,
							class_name: 'color danger'
						});
					}else if(data.response = "success"){
						var opcion = "cancelarfactura";
						$.ajax({
							method: "POST",
							url: "guardar.php",
							dataType: "json",
							data: frm,
						}).done( function( info ){
							$("#mod-spinner").modal("hide");
							mostrar_mensaje(info);
							listar_facturas();
						});
					}
				}
			};

			request.send();
		}

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
