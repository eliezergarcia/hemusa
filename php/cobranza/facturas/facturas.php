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
					<h2 class="page-head-title">Facturas</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb page-head-nav">
								<li class="breadcrumb-item"><a href="#">Créditos y cobranza</a></li>
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
										<div class="row align-items-end">
											<div class="col-2 table-filters"><span class="table-filter-title">Proveedor</span>
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-12">
																<input placeholder="Busca un proveedor" class="form-control form-control-sm" list="proveedores" id="proveedores" name="proveedores" type="text" required >
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="col-4 table-filters">
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-4">
																<button type="button" name="buscar" id="buscarPagosProveedor" class="btn btn-primary btn-lg btn-space">Buscar pendientes</button>
															</div>
															<div class="col">
																<button type="button" name="buscar" id="buscarPagadosCliente" class="btn btn-primary btn-lg btn-space">Consultar pagados</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tabla de pagos -->
								<!-- <div id="pagos"> -->
									<!-- <div class="col-12 row justify-content-center">
										<table id="dt_pagos" class="table table-striped display dt_pagos" cellspacing="0" width="100%">
											<thead></tr>
												<tr>
													<th>Registrar por</th>
													<th>Factura/OC</th>
													<th>Cliente</th>
													<th>Fecha</th>
													<th>Monto ($)</th>
													<th>Cuenta</th>
													<th>Tipo de Cambio (mxn/usd)</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<form id="frmRegistrarPago" action="#" method="POST">
													<input type="hidden" name="opcion" id="opcion" value="registrar">
													<tr>
														<td>
															<select name="registrarpor" id="registrarpor" class="form-control form-control-sm select2 limpiar" required>
																<option value="factura">Factura</option>
																<option value="ordencompra">Orden de Compra</option>
															</select>
														</td>
														<td>
															<input name="facoc" id="facoc" type="text" class="form-control form-control-sm limpiar" required>
														</td>
														<td>
															<input name="cliente" id="cliente" class="form-control form-control-sm limpiar cliente" required>
														</td>
														<td>
															<input name="fecha" id="fecha" type="date" class="form-control form-control-sm limpiar" value="<?php echo date("Y-m-d");?>" required>
														</td>
														<td>
															<input name="monto" id="monto" type="text" class="form-control form-control-sm limpiar" onchange="cambiar_total()" required>
														</td>
														<td>
															<select name="cuenta" id="cuenta" class="form-control form-control-sm select2 limpiar" required>
															</select>
														</td>
														<td>
															<input name="tipocambio" id="tipocambio" type="text" class="form-control form-control-sm limpiar" required>
														</td>
														<td>
															<button id="addRow" class="form-control form-control-sm btn btn-sm btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
														</td>
													</tr>
												</form>
											</tbody>
										</table>
									</div> -->

									<!-- <div class="col-12 row justify-content-end align-items-center">
									<label for="total" class="label-control">Total a registrar: $ </label>
									<input type="text" id="total" name="total" class="form-control col-1">
								</div> -->
									<!-- <div class="col-11 row justify-content-end">
										<input id="registrar-pagos" type="button" class="form-control btn btn-success col-1" value="Registrar">
									</div>
								</div> -->

								<!-- Tabla de pagos cliente -->
								<br>
								<div id="pagos_cliente">
									<div class="row justify-content-center">
										<div class="col-2">
											<label>Fecha</label>
											<input type="date" name="fechaproveedor" id="fechaproveedor" class="form-control form-control-sm" value="<?php echo date("Y-m-d");?>">
										</div>
										<div class="col-2">
											<label>Cuenta</label>
											<!-- <input type="text" name="cuentacliente" id="cuentacliente" class="form-control form-control-sm"> -->
											<select name="cuentaproveedor" id="cuentaproveedor" class="form-control form-control-sm limpiar" required>
											</select>
										</div>
										<div class="col-2">
											<label>Tipo de cambio</label>
											<input type="text" name="tipocambioproveedor" id="tipocambioproveedor" class="form-control form-control-sm" value="1.00">
										</div>
									</div>
									<br><br>
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

								<!-- Tabla de pagados cliente -->
								<div id="pagados_cliente">
									<table id="dt_pagados_cliente" class="table table-bordered table-striped display" cellspacing="0" width="100%">
										<thead></tr>
											<tr>
												<th>Fecha</th>
												<th>Facturas</th>
												<th>Cliente</th>
												<th>Banco</th>
												<th>Total</th>
												<th>Editar</th>
												<th>Eliminar</th>
											</tr>
										</thead>
									</table>
								</div>

								<!-- Tabla de desglose de facturas -->
								<div id="desglosar_facturas">
									<div class="col-12 row justify-content-center">
										<table id="dt_desglosar_facturas" class="table table-bordered table-striped display" cellspacing="0" width="100%">
											<thead></tr>
												<tr>
													<th></th>
													<th>Fecha</th>
													<th>Factura</th>
													<th>Cliente</th>
													<th>Banco</th>
													<th>Total</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="col-12">
										<input type="hidden" id="idpagofacturas">
										<div class="col-10 row justify-content-end">
											<div>
												<button id="eliminar-factura-pago" class="btn btn-danger">ELIMINAR FACTURA DE PAGO</button>
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
			listar_pagos();
			registrar_pagos();
			buscar_proveedores();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#cobranza-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#facturas-menu").addClass("active");
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
				}
			});
		}

		var listar_pagos = function(){
			$("#pagos_cliente").slideUp("slow");
			$("#pagados_cliente").slideUp("slow");
			$("#desglosar_facturas").slideUp("slow");
			$("#pagos").slideDown("slow");
			var proveedor = $("#buscarProveedor").val();
			console.log(proveedor);
			var table = $('#dt_pagos').DataTable({
				"order": false,
				"ordering": false,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
		        "searching": false
			});

			obtener_datos_pago("#dt_pagos tbody", table);
			eliminar_datos_pago("#dt_pagos tbody", table);
		}

		$('#dt_pagos tr td').change(function(){
		    var $row = $(this).closest("tr");
			var buscarpor = $row.find("select[name=registrarpor]").val();
			console.log(buscarpor);
			var facoc = $row.find("input[name=facoc]").val();
			console.log(facoc);
			var opcion = "buscartotal";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "facoc": facoc, "buscarpor": buscarpor},
				success : function(data) {
					$row.find("input[name=cliente]").val(data.cliente.nombreEmpresa);
					$row.find("input[name=monto]").val(data.pedido.total);
	   			}
			});
		});

		var obtener_datos_pago = function(tbody, table){
			var counter = 1;
			$('#addRow').on( 'click', function () {
		        table.row.add( [
		            '<select name="registrarpor" id="registrarpor" class="form-control limpiar" required><option value="factura">Factura</option><option value="ordencompra">Orden de Compra</option></select>',
		            '<input name="facoc" id="facoc" type="text" class="form-control limpiar" required>',
		        	'<input name="cliente" id="cliente" class="form-control limpiar" required>',
		            '<input name="fecha" id="fecha" type="date" class="form-control limpiar" value="<?php echo date("Y-m-d");?>" required>',
		            '<input name="monto" id="monto" type="text" class="form-control limpiar" onchange="cambiar_total()" required>',
		            '<select name="cuenta" id="cuenta" class="form-control limpiar" required></select>',
		            '<input name="tipocambio" id="tipocambio" type="text" class="form-control limpiar" required>',
		            '<button id="deleteRow" class="form-control btn btn-outline-danger eliminar"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>'

		        ] ).draw( false );
		        counter++;
		    	// buscar_clientes();
				buscar_cuentas();
				eliminar_datos_pago(tbody, table);
		    } );
		}

		var eliminar_datos_pago = function(tbody, table){
			var counter = 1;
			$('button.eliminar').on( 'click', function () {
				table
			    	.row( $(this).parents('tr') )
			        .remove()
			        .draw();
		    } );
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

		var registrar_pagos = function(){
			$("#registrar-pagos").on("click", function(){
				var vacio = 0;
				var numeropagos = 0;
				var cliente = new Array();
				$("input[name=cliente]").each(function (index) {
					cliente.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}else{
						numeropagos++;
					}
				});
				var registrarpor = new Array();
				$("select[name=registrarpor]").each(function (index) {
					registrarpor.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				var facoc = new Array();
				$("input[name=facoc]").each(function (index) {
					facoc.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				var fecha = new Array();
				$("input[name=fecha]").each(function (index) {
					fecha.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				var monto = new Array();
				$("input[name=monto]").each(function (index) {
					monto.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				var cuenta = new Array();
				$("select[name=cuenta]").each(function (index) {
					cuenta.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				var tipocambio = new Array();
				$("input[name=tipocambio]").each(function (index) {
					tipocambio.push($(this).val());
					if($(this).val() == ""){
						vacio++;
					}
				});
				console.log(cliente);
				console.log(registrarpor);
				console.log(facoc);
				console.log(fecha);
				console.log(monto);
				console.log(cuenta);
				console.log(tipocambio);
				console.log(numeropagos);
				if (vacio > 0) {
					var texto = "";
						texto = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>INFORMACION!</strong> Alguno de los campos esta vacio.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";

					$(".mensaje").html( texto );
					$(".mensaje").fadeOut(7000, function(){
						$(this).html("");
						$(this).fadeIn(7000);
					});
				}else{
					var opcion = "registrar";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"cliente": JSON.stringify(cliente), "registrarpor": JSON.stringify(registrarpor), "facoc": JSON.stringify(facoc), "fecha": JSON.stringify(fecha), "monto": JSON.stringify(monto), "cuenta": JSON.stringify(cuenta), "tipocambio": JSON.stringify(tipocambio), "numeropagos": numeropagos, "opcion": opcion},
					}).done( function( data ){
						mostrar_mensaje(data);
					});
				}
			});
		}

		$("#buscarPagosProveedor").on("click", function(){
			var idproveedor = $("#proveedores").val();
			if (idproveedor == "") {
				alert("Debes de ingresar un cliente!");
			}else{
				$("#pagos").slideUp("slow");
				$("#pagados_cliente").slideUp("slow");
				$("#desglosar_facturas").slideUp("slow");
				$("#pagos_cliente").slideDown("slow");
				listar_pagos_proveedor(idproveedor);
			}
		});

		var listar_pagos_proveedor = function(idproveedor){
			console.log(idproveedor);
			var table = $('#dt_pagos_proveedor').DataTable({
				"order": false,
				"ordering": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        // "searching": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_pagos_proveedor.php",
					"data":{"idproveedor": idproveedor},
				},
				"columns":[
					// {"data":"check"},
					{"data": null,
						"render": function (data, row) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='pedido' value='"+data.factura+"' class='custom-control-input' type='checkbox' onclick='cambiar_total()'><span class='custom-control-label'></span></label>";
						},
					},
					// {"data":"cliente"},
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

			obtener_data_factura("#dt_pagos_cliente tbody", table)
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

		var obtener_data_factura = function(tbody, table){
			$(tbody).on("click", "button.abonocliente", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				$("#frmAbonoCliente #idfactura").val(data.id);
				$("#frmAbonoCliente #factura").val(data.factura);
				$("#frmAbonoCliente #abonado").val(data.abonado);
				$("#frmAbonoCliente #pendiente").val(data.pendiente);
				$("#frmAbonoCliente #total").val(data.total);
				$("#modalAbonoCliente").modal("show");
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

		$("#buscarPagadosCliente").on("click", function(){
			var idcliente = $("#clientes").val();
			if (idcliente == "") {
				alert("Debes de ingresar un cliente!");
			}else{
				listar_pagados_cliente(idcliente);
				$("#pagos").slideUp("slow");
				$("#pagos_cliente").slideUp("slow");
				$("#desglosar_facturas").slideUp("slow");
				$("#pagados_cliente").slideDown("slow");
			}
		});

		var listar_pagados_cliente = function(idcliente){
			console.log(idcliente);
			var table = $('#dt_pagados_cliente').DataTable({
				"order": false,
				"ordering": false,
        "info": false,
        "scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar_pagados_cliente.php",
					"data":{"idcliente": idcliente},
				},
				"columns":[
					{"data":"fecha"},
					{"data":"facturas"},
					{"data":"cliente"},
					{"data":"banco"},
					{"data":"total"},
					{"defaultContent": "<button class='editar-pago-cliente btn btn-primary'><i class='fas fa-pencil-alt' aria-hidden='true'></i></button>"},
					{"defaultContent": "<button class='eliminar-pago-cliente btn btn-danger'><i class='fas fa-trash' aria-hidden='true'></i></button>"}
				],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-body'<'col-sm-6'><'col-sm-4 text-right'f>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-8'tr>>"
    			// "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
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
				var factura = data.facturas;
				var idpago = data.idpedido;
				console.log(idpago);
				var confirmar = confirm("¿Estás segura de eliminar el pago de la factura "+factura+"?");
				if (confirmar == true) {
					var opcion = "eliminarpago";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"idpago": idpago, "opcion": opcion, "facturas": factura},
					}).done( function( data ){
						console.log(data);
						mostrar_mensaje(data);
						$('#dt_pagados_cliente').DataTable().ajax.reload();
					});
				} else {

				}
			});
		}

		var listar_facturas_pago = function(idpago){
			var table = $('#dt_desglosar_facturas').DataTable({
				"order": false,
				"ordering": false,
        "lengthChange": false,
        "info": false,
        // "paging": false,
        // "searching": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_facturas_pago.php",
					"data":{"idpago": idpago},
				},
				"columns":[
					{"data":"check"},
					{"data":"fecha"},
					{"data":"factura"},
					{"data":"cliente"},
					{"data":"banco"},
					{"data":"total"}
				],
				"language": idioma_espanol,
				"dom":
				"<'container row col-8 row'<'row justify-content-end col-12 buttons'f>>" +
				"<'container row col-8 row'<'justify-content-center col-12 buttons'tr>>" +
				"<'container row col-8 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>"

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

		var limpiar_datos = function(){
			$("form .limpiar").val("");
			buscar_clientes();
			buscar_cuentas();
		}
	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
