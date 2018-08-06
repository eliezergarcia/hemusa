<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pagos</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
			<div class="page-head">
					<h2 class="page-head-title">Consultar pagados</h2>
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
															<input placeholder="Busca un cliente" class="form-control form-control-sm" list="clientes" id="clientes" name="clientes" type="text" required >
														</div>
													</div>
												</div>
											</div>
											<div class="col-4 table-filters">
												<div class="filter-container">
													<div class="row">
														<div class="col">
															<button type="button" name="buscar" id="buscarPagadosCliente" class="btn btn-primary btn-lg">Buscar</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tabla de pagados cliente -->
								<div id="pagados_cliente">
									<table id="dt_pagados_cliente" class="table table-bordered table-striped display" cellspacing="0" width="100%">
										<thead></tr>
											<tr>
												<th>Fecha</th>
												<th>Facturas</th>
												<!-- <th>Cliente</th> -->
												<th>Banco</th>
												<th>Moneda</th>
												<th>Tipo cambio</th>
												<th>Total</th>
												<!-- <th>Editar</th> -->
												<th>Eliminar</th>
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

		<!-- Modal Editar Pago -->
			<div class="modal fade colored-header colored-header-primary" id="modalEditarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar Pago</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="col-12">
			        	<div class="row">
			        		<input type="hidden" name="idpago" id="idpago">
			        		<div class="col form-group">
			        			<label for="fechapago">Fecha</label>
			        			<input type="date" class="form-control form-control-sm" name="fechapago" id="fechapago">
			        		</div>
			        		<div class="col form-group">
			        			<label for="tcpago">Tipo de Cambio</label>
			        			<input type="text" class="form-control form-control-sm" name="tcpago" id="tcpago">
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col form-group">
			        			<label for="fechapago">Banco</label>
			        			<select name="bancopago" id="bancopago" class="form-control form-control-sm">
			        				<option value="1">BANCO NACIONAL DE MEXICO, S.A</option>
			        				<option value="2">BANCO MERCANTIL DEL NORTE, S.A</option>
			        				<option value="4">BANAMEX Dlls</option>
			        			</select>
			        		</div>
			        	</div>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
			        <button id="editar-pago-cliente" type="button" class="btn btn-lg btn-primary">Guardar</button>
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

		function buscar_clientes () {
			opcion = "buscarclientes";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var clientes = data;
					console.log(clientes);
					var input = document.getElementById("clientes");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = clientes;
					$("#clientes").focus();
				}
			});
		}

		$("#seleccionartodo").on("click", function(){
			$("input[name=pedido]").each(function (index) {
				if($('input[name="seleccionartodo"]').is(':checked')){
					$('input[name="pedido"]').prop('checked' , true);
				}else{
					$('input[name="pedido"]').prop('checked' , false);
				}
			});
		});

		$("#buscarPagadosCliente").on("click", function(){
			var idcliente = $("#clientes").val();
			if (idcliente == "") {
				alert("Debes de ingresar un cliente!");
			}else{
				listar_pagados_cliente(idcliente);
			}
		});

		var listar_pagados_cliente = function(idcliente){
			console.log(idcliente);
			var opcion = "pagadoscliente"
			var table = $('#dt_pagados_cliente').DataTable({
				"order": false,
				"ordering": false,
        "info": false,
        "scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"idcliente": idcliente, "opcion": opcion},
				},
				"columns":[
					{"data":"fecha"},
					{"data":"factura"},
					// {"data":"cliente"},
					{"data":"banco"},
					{"data":"moneda"},
					{"data":"tipocambio"},
					{"data":"total"},
					// {"defaultContent": "<button class='editar-pago-cliente btn btn-primary'><i class='fas fa-pencil-alt' aria-hidden='true'></i></button>"},
					{"defaultContent": "<button class='eliminar-pago-cliente btn btn-danger'><i class='fas fa-trash' aria-hidden='true'></i></button>"}
				],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-body'<'col-sm-6'><'col-sm-4 text-right'f>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-8'tr>>"
			});

			obtener_data_editar_pago("#dt_pagados_cliente tbody", table);
			obtener_data_eliminar_pago("#dt_pagados_cliente tbody", table);
		}

		var obtener_data_editar_pago = function(tbody, table){
			$(tbody).on("click", "button.editar-pago-cliente", function(){
				var data = table.row( $(this).parents("tr") ).data();
					console.log(data);

				$("#fechapago").val(data.fecha);
				$("#tcpago").val(data.tipocambio);
				$("#bancopago").val(data.cuenta);
				$("#idpago").val(data.idpedido);

				$("#modalEditarPago").modal("show");
			});
		}

		$("#editar-pago-cliente").on("click", function(){
			var fechapago = $("#fechapago").val();
			var tcpago = $("#tcpago").val();
			var bancopago = $("#bancopago").val();
			var idpago = $("#idpago").val();
			var opcion = "editarpagocliente";
			$("#modalEditarPago").modal("hide");
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"fechapago": fechapago, "tcpago": tcpago, "bancopago": bancopago, "idpago": idpago, "opcion": opcion},
			}).done( function( info ){
				mostrar_mensaje(info);
				$('#dt_pagados_cliente').DataTable().ajax.reload();
			});
		});

		var obtener_data_eliminar_pago = function(tbody, table){
			$(tbody).on("click", "button.eliminar-pago-cliente", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var factura = data.factura;
				console.log(factura);
				var confirmar = confirm("¿Estás segura de eliminar el pago de la factura "+factura+"?");
				if (confirmar == true) {
					var opcion = "eliminarpagocliente";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"opcion": opcion, "factura": factura},
					}).done( function( data ){
						console.log(data);
						$('#dt_pagados_cliente').DataTable().ajax.reload();
						mostrar_mensaje(data);
					});
				} else {

				}
			});
		}

		$("#eliminar-factura-pago").on("click", function(){
			var verificar = 0;
			$("input[name=factura]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});

			if(verificar == 0){
				alert("Debes de seleccionar al menos una factura!");
			}else{
				console.log(verificar);
				var facturas = new Array();
				var numeroFacturas = 0;
				$("input[name=factura]").each(function (index) {
					if($(this).is(':checked')){
						facturas.push($(this).val());
						numeroFacturas++;
					}
				});
				var idpago = $("#idpagofacturas").val();
				var opcion = 'eliminarfacturapago';
				console.log(numeroFacturas);
				console.log(facturas);
				console.log(opcion);
				console.log(idpago);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"idpago": idpago, "opcion": opcion, "facturas": JSON.stringify(facturas)},
				}).done( function( data ){
					console.log(data);
					mostrar_mensaje(data);
					listar_facturas_pago(idpago);
				});
			}
		});

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
