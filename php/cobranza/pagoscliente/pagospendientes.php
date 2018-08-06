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
															<input placeholder="Busca un cliente" class="form-control form-control-sm" list="clientes" id="clientes" name="clientes" type="text" required >
														</div>
													</div>
												</div>
											</div>
											<div class="col-1 table-filters"><span class="table-filter-title"></span>
												<div class="filter-container">
													<div class="row">
														<div class="col-12">
															<label class="control-label"></label>
															<button type="button" name="buscar" id="buscarPagosCliente" class="btn btn-primary btn-lg">Buscar</button>
														</div>
													</div>
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
															<select name="cuenta" id="cuentacliente" class="form-control form-control-sm select2 limpiar" required>
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
									<table id="dt_pagos_cliente" class="table table-bordered table-striped display" cellspacing="0" width="100%">
										<thead></tr>
											<tr>
												<th>
													<label class="custom-control custom-control-sm custom-checkbox">
														<input class="custom-control-input" name="seleccionartodo" id="seleccionartodo" type="checkbox"><span class="custom-control-label"></span>
													</label>
												</th>
												<!-- <th>Cliente</th> -->
												<th>Factura</th>
												<th>Orden Compra</th>
												<th>Moneda</th>
												<th>Abonado</th>
												<th>Pendiente</th>
												<th>Total</th>
												<!-- <th></th> -->
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
												<input id="abono-cliente" type="button" class="form-control btn btn-primary col-12" value="Abonar">
											</div>
											<div class="col-2">
												<input id="registrar-pagos-cliente" type="button" class="form-control btn btn-success col-12" value="Registrar">
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
			buscar_cuentas();
			registrar_pagos();
			buscar_clientes();
		});

		function nav_active() {
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
					var input = document.getElementById("clientes");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = clientes;
					$("#clientes").focus();
				}
			});
		}

		var cambiar_total = function(){
			var facturas = new Array();
			$("input[name=factura]").each(function (index) {
				if($(this).is(':checked')){
					facturas.push($(this).val());
				}
			});
			console.log(facturas);
			var opcion = "buscartotalpedidoscliente";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"facturas": JSON.stringify(facturas), "opcion": opcion},
			}).done( function( data ){
				console.log(data);
				$("#total").val(data.total);
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
					for(var i=0;i<=2;i++){
		         $("select[name=cuenta]").append("<option value='"+ cuentas.data[i].id + "'>" + cuentas.data[i].nombre + "</option>");
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

		$("#buscarPagosCliente").on("click", function(){
			var idcliente = $("#clientes").val();
			if (idcliente == "") {
				alert("Debes de ingresar un cliente!");
			}else{
				listar_pagos_cliente(idcliente);
			}
		});

		var listar_pagos_cliente = function(idcliente){
			console.log(idcliente);
			var opcion = "pagospendientescliente";
			var table = $('#dt_pagos_cliente').DataTable({
				"order": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data":{"opcion": opcion, "idcliente": idcliente},
				},
				"columns":[
					{"data": null,
						"render": function (data, row) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='factura' value='"+data.factura+"' class='custom-control-input' type='checkbox' onclick='cambiar_total()'><span class='custom-control-label'></span></label>";
						},
					},
					{"data":"factura"},
					{"data":"ordencompra"},
					{"data":"moneda"},
					{"data":"abonado"},
					{"data":"pendiente"},
					{"data":"total"},
				],
				"order": ["1", "asc"],
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-space'<'col-sm-6'><'col-sm-3 text-right'f>>" +
    			"<'row be-datatable-body justify-content-center'<'col-sm-6'tr>>"
			});
		}

		$("#abono-cliente").on("click", function () {
			var verificar = 0;
			$("input[name=factura]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});

			if(verificar == 0){
				alert("Debes de seleccionar al menos una factura.");
			}else{
				console.log(verificar);
				var pagos = new Array();
				$("input[name=factura]").each(function (index) {
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
			$("input[name=factura]").each(function (index) {
				if($('input[name="seleccionartodo"]').is(':checked')){
					$('input[name="factura"]').prop('checked' , true);
				}else{
					$('input[name="factura"]').prop('checked' , false);
				}
			});
		});

		$("#registrar-pagos-cliente").on("click", function(){
			var verificar = 0;
			$("input[name=factura]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});

			if(verificar == 0){
				alert("Debes de seleccionar al menos una factura.");
			}else{
				console.log(verificar);
				var facturas = new Array();
				var numeroPartidas = 0;
				$("input[name=factura]").each(function (index) {
					if($(this).is(':checked')){
						facturas.push($(this).val());
						numeroPartidas++;
					}
				});
				var cliente = $("#clientes").val();
				var fecha = $("#fechacliente").val();
				var cuenta = $("#cuentacliente").val();
				var tipocambio = $("#tipocambiocliente").val();
				var opcion = 'registrarpagoscliente';
				console.log(cliente);
				console.log(numeroPartidas);
				console.log(facturas);
				console.log(fecha);
				console.log(cuenta);
				console.log(tipocambio);
				console.log(opcion);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"cliente": cliente, "fecha": fecha, "cuenta": cuenta, "tipocambio": tipocambio, "opcion": opcion, "numeroPartidas": numeroPartidas, "facturas": JSON.stringify(facturas)},
				}).done( function( data ){
					console.log(data);
					$('#dt_pagos_cliente').DataTable().ajax.reload();
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
