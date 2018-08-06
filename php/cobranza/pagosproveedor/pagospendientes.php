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
					<h2 class="page-head-title">Pagos pendientes</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb page-head-nav">
								<li class="breadcrumb-item"><a href="#">Créditos y cobranza</a></li>
								<li class="breadcrumb-item"><a href="#">Pagos a proveedor</a></li>
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
											<div class="col-2 table-filters"><span class="table-filter-title">Proveedor</span>
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-12">
																<label class="control-label"></label>
																<input placeholder="Busca un proveedor" class="form-control form-control-sm" list="proveedores" id="proveedores" name="proveedores" type="text" required >
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="col-1 table-filters">
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-12">
																<label class="control-label"></label>
																<button type="button" name="buscar" id="buscarPagosProveedor" class="btn btn-primary btn-lg">Buscar</button>
															</div>
															<!-- <div class="col">
																<label class="control-label"></label>
																<button type="button" name="buscar" id="buscarPagadosCliente" class="btn btn-primary btn-lg">Consultar pagados</button>
															</div> -->
														</div>
													</form>
												</div>
											</div>
											<div class="col-6 table-filters"><span class="table-filter-title">información de pago</span>
												<div class="filter-container">
													<div class="row">
														<div class="col-3">
															<label class="control-label">Fecha</label>
															<input type="date" name="fechacliente" id="fechacliente" class="form-control form-control-sm" value="<?php echo date("Y-m-d");?>">
														</div>
														<div class="col-5">
															<label class="control-label">Cuenta</label>
															<select name="cuentaproveedor" id="cuentaproveedor" class="form-control form-control-sm select2 limpiar" required>
															</select>
														</div>
														<div class="col-3">
															<label class="control-label">Tipo de cambio</label>
															<input type="text" name="tipocambiocliente" id="tipocambiocliente" class="form-control form-control-sm" value="1.00">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tabla de pagos cliente -->
								<br>
								<div id="pagos_cliente">
									<table id="dt_pagos_proveedor" class="table table-bordered table-striped display" cellspacing="0" width="100%">
										<thead></tr>
											<tr>
												<th>
													<label class="custom-control custom-control-sm custom-checkbox">
														<input class="custom-control-input" name="seleccionartodo" id="seleccionartodo" type="checkbox" onclick="cambiar_total()"><span class="custom-control-label"></span>
													</label>
												</th>
												<th>Factura</th>
												<th>Orden Compra</th>
												<th>Fecha</th>
												<th>Fecha Vencimiento</th>
												<th>Moneda</th>
												<th>Abonado</th>
												<th>Pendiente</th>
												<th>Total</th>
											</tr>
										</thead>
									</table>
									<br>
									<div class="col-9">
										<div class="row justify-content-end">
											<div class="col-2">
												<label for="total" class="label-control">Cantidad a abonar: $ </label>
												<input type="text" id="cantidadabono" name="cantidadabono" class="form-control form-control-sm col-12">
											</div>
											<div class="col-2">
												<label for="total" class="label-control">Total a registrar: $ </label>
												<input type="text" id="total" name="total" class="form-control form-control-sm col-12">
											</div>
										</div>
									</div>
									<br>
									<div class="col-9">
										<div class="row justify-content-end">
											<div class="col-2">
												<input id="abono-proveedor" type="button" class="form-control btn btn-primary col-12" value="Abonar">
											</div>
											<div class="col-2">
												<input id="registrar-pagos-proveedor" type="button" class="form-control btn btn-success col-12" value="Registrar">
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
			buscar_cuentas();
			buscar_proveedores();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#cobranza-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#pagosproveedor-menu").addClass("active");
    }

		function buscar_proveedores () {
			opcion = "buscarproveedores";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var proveedores = data;
					console.log(proveedores);
					var input = document.getElementById("proveedores");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = proveedores;
					$("#proveedores").focus();
				}
			});
		}

		var buscar_cuentas = function(){
			var opcion = "buscarcuentas";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var cuentas = data;
					for(var i=0;i<=4;i++){
		         $("select[name=cuentaproveedor]").append("<option value='"+ cuentas.data[i].id + "'>" + cuentas.data[i].nombre + "</option>");
		     	};
	   		}
			});
		}

		$("#buscarPagosProveedor").on("click", function(){
			var idproveedor = $("#proveedores").val();
			if (idproveedor == "") {
				alert("Debes de ingresar un cliente!");
			}else{
				listar_pagos_proveedor(idproveedor);
			}
		});

		var listar_pagos_proveedor = function(idproveedor){
			console.log(idproveedor);
			var opcion = "pagospendientesproveedor";
			var table = $('#dt_pagos_proveedor').DataTable({
				"order": false,
				"ordering": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"opcion": opcion, "idproveedor": idproveedor},
				},
				"columns":[
					{"data": null,
						"render": function (data, row) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='pedido' value='"+data.factura+"' class='custom-control-input' type='checkbox' onclick='cambiar_total()'><span class='custom-control-label'></span></label>";
						},
					},
					{"data":"factura"},
					{"data":"ordencompra"},
					{"data":"fecha"},
					{"data":"fechavencimiento"},
					{"data":"moneda"},
					{"data":"abonado"},
					{"data":"pendiente"},
					{"data":"total"},
					// {"defaultContent": "<div class='invoice-footer'><button class='abonocliente btn btn-primary'><i class='fas fa-money-bill fa-sm'></i> Abono</button></div>"}
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
    			"<'row be-datatable-space'<'col-sm-6'><'col-sm-3 text-right'f>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-6'tr>>"
    			// "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
			});
		}

		var cambiar_total = function(){
			var pedidos = new Array();
			$("input[name=pedido]").each(function (index) {
				if($(this).is(':checked')){
					pedidos.push($(this).val());
				}
			});
			console.log(pedidos);
			var idproveedor = $("#proveedores").val();
			var opcion = "buscartotalpedidosproveedores";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"pedidos": JSON.stringify(pedidos), "idproveedor": idproveedor, "opcion": opcion},
			}).done( function( data ){
				console.log(data);
				$("#total").val(data.total);
			});
		}

		$("#abono-cliente").on("click", function () {
			var verificar = 0;
			$("input[name=pedido]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});

			if(verificar == 0){
				alert("Debes de seleccionar al menos una factura.");
			}else{
				console.log(verificar);
				var pagos = new Array();
				$("input[name=pedido]").each(function (index) {
					if($(this).is(':checked')){
						pagos.push($(this).val());
					}
				});
			}
			var cantidadabono = $("#cantidadabono").val();
			var opcion = "abonocliente";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion, "cantidadabono": cantidadabono, "pagos": JSON.stringify(pagos)},
			}).done( function( data ){
				console.log(data);
				$('#dt_pagos_cliente').DataTable().ajax.reload();
				$("#cantidadabono").val("");
				$("#total").val("");
				mostrar_mensaje(data);
			});
		});

		$("#seleccionartodo").on("click", function(){
			$("input[name=pedido]").each(function (index) {
				if($('input[name="seleccionartodo"]').is(':checked')){
					$('input[name="pedido"]').prop('checked' , true);
				}else{
					$('input[name="pedido"]').prop('checked' , false);
				}
			});
		});

		$("#registrar-pagos-proveedor").on("click", function(){
			var verificar = 0;
			$("input[name=pedido]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});

			if(verificar == 0){
				alert("Debes de seleccionar al menos un pedido!");
			}else{
				console.log(verificar);
				var pagos = new Array();
				var numeroPartidas = 0;
				$("input[name=pedido]").each(function (index) {
					if($(this).is(':checked')){
						pagos.push($(this).val());
						numeroPartidas++;
					}
				});
				var fecha = $("#fechaproveedor").val();
				var cuenta = $("#cuentaproveedor").val();
				var tipocambio = $("#tipocambioproveedor").val();
				var proveedor = $("#proveedores").val();
				var opcion = "registrarpagosproveedor";
				console.log(pagos);
				console.log(proveedor);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "fecha": fecha, "cuenta": cuenta, "tipocambio": tipocambio, "proveedor": proveedor, "pagos": JSON.stringify(pagos)},
				}).done( function( data ){
					console.log(data);
					$('#dt_pagos_proveedor').DataTable().ajax.reload();
					$("#total").val("");
					mostrar_mensaje(data);
				});
			}
		});

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
