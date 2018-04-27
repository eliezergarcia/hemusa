<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada	
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pagos</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<?php include('../../enlaces.php'); ?>
</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
  			<!-- Breadcrumb -->
		        <nav aria-label="breadcrumb">
		          <ol class="breadcrumb">             
		            <li class="breadcrumb-item">Créditos y Cobranza</li>
		            <li class="breadcrumb-item active">Pagos</li>
		          </ol>
		        </nav>    		
			
			<!-- Encabezado -->
		        <div>
		          <br>
		          <center><h1><b>Registro de pagos de clientes</b></h1></center>
		        </div>
				
			<!-- Buscar cliente -->
				<div class="col-12 row justify-content-center">
					<div class="form-group col-12 row justify-content-center">
						<label for="buscarProveedor" class="">Buscar cliente:</label>
					</div>
					<div class="form-group col-12 row justify-content-center">
						<input id="idclientebuscar" class="awesomplete form-control col-2" list="mylist" />
						<datalist id="mylist">
							<?php
					        	include("../../conexion.php");
						        $result = mysqli_query($conexion_usuarios, "SELECT id,nombreEmpresa FROM contactos WHERE tipo = 'Cliente'");
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="'.$row['id'].'">'.utf8_encode($row['nombreEmpresa']).'</option>';
									}
							?>
						</datalist>
					</div>
					<div class="form-group col-12 row justify-content-center">
						<button type="button" name="buscar" id="buscarPagosCliente" class="btn btn-primary">Buscar pendientes</button>
						<button type="button" name="buscar" id="buscarPagadosCliente" class="btn btn-primary">Consultar pagados</button>
					</div>
				</div>
				<br>

			<!-- Mensaje actualizaciones-->
				<div>
					<center><h6 class="mensaje"></h6></center>
				</div>
				<br>

			<!-- Tabla de pagos -->
				<div id="pagos">
					<div class="col-12 row justify-content-center">
						<table id="dt_pagos" class="table table-bordered table-striped display dt_pagos" cellspacing="0">
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
										<select name="registrarpor" id="registrarpor" class="form-control limpiar" required>
											<option value="factura">Factura</option>
											<option value="ordencompra">Orden de Compra</option>
										</select>
									</td>
									<td>
										<input name="facoc" id="facoc" type="text" class="form-control limpiar" required>
									</td>
									<td>
										<input name="cliente" id="cliente" class="form-control limpiar cliente" required>
									</td>
									<td>
										<input name="fecha" id="fecha" type="date" class="form-control limpiar" value="<?php echo date("Y-m-d");?>" required>
									</td>
									<td>
										<input name="monto" id="monto" type="text" class="form-control limpiar" onchange="cambiar_total()" required>
									</td>
									<td>
										<select name="cuenta" id="cuenta" class="form-control limpiar" required>
										</select>
									</td>
									<td>
										<input name="tipocambio" id="tipocambio" type="text" class="form-control limpiar" required>
									</td>
									<td>
										<button id="addRow" class="form-control btn btn-outline-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
									</td>
								</tr>
								</form>
							</tbody>
						</table>
					</div>	
				
					<!-- <div class="col-12 row justify-content-end align-items-center">
						<label for="total" class="label-control">Total a registrar: $ </label>
						<input type="text" id="total" name="total" class="form-control col-1"> 
					</div> -->
					<div class="col-11 row justify-content-end">
						<input id="registrar-pagos" type="button" class="form-control btn btn-success col-1" value="Registrar"> 
					</div>
				</div>
      	
			<!-- Tabla de pagos cliente -->
				<div id="pagos_cliente">
					<div class="container row justify-content-around">
						<div>
							<label>Fecha</label>
							<input type="date" name="fechacliente" id="fechacliente" class="form-control" value="<?php echo date("Y-m-d");?>">
						</div>
						<div>
							<label>Cuenta</label>
							<!-- <input type="text" name="cuentacliente" id="cuentacliente" class="form-control"> -->
							<select name="cuenta" id="cuentacliente" class="form-control limpiar" required>
							</select>
						</div>
						<div>
							<label>Tipo de cambio</label>
							<input type="text" name="tipocambiocliente" id="tipocambiocliente" class="form-control">
						</div>
					</div>
					<div class="col-12 row justify-content-center">
						<table id="dt_pagos_cliente" class="table table-bordered table-striped display" cellspacing="0" width="100%">
							<thead></tr>
								<tr>
									<th><input type="checkbox" name="seleccionartodo" id="seleccionartodo" class="form-control"></th>
									<th>Cliente</th>
									<th>Factura</th>								
									<th>Orden Compra</th>
									<th>Moneda</th>
									<th>Abonado</th>
									<th>Pendiente</th>
									<th>Total</th>
								</tr>
							</thead>
						</table>
					</div>	
					<div class="col-12">
						<div class="col-12">
							<div class="col-12 row justify-content-end align-items-center">
								<label for="total" class="label-control">Total a registrar: $ </label>
								<input type="text" id="total" name="total" class="form-control col-1"> 
							</div>
							<div class="col-12 row justify-content-end">
								<input id="registrar-pagos-cliente" type="button" class="form-control btn btn-success col-1" value="Registrar"> 
							</div>
						</div>
					</div>
				</div>
      	
			<!-- Tabla de pagados cliente -->
				<div id="pagados_cliente">
					<div class="col-12 row justify-content-center">
						<table id="dt_pagados_cliente" class="table table-bordered table-striped display" cellspacing="0" width="100%">
							<thead></tr>
								<tr>									
									<th>Fecha</th>
									<th>Facturas</th>								
									<th>Cliente</th>
									<th>Banco</th>
									<th>Total</th>
									<th>Ver y Editar</th>									
									<th>Desglosar Facturas</th>
								</tr>
							</thead>
						</table>
					</div>	
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
      	
			<!-- Modal Editar Pago -->
				<div class="modal fade" id="modalEditarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				        			<input type="date" class="form-control" name="fechapago" id="fechapago">
				        		</div>
				        		<div class="col form-group">
				        			<label for="tcpago">Tipo de Cambio</label>
				        			<input type="text" class="form-control" name="tcpago" id="tcpago">
				        		</div>
				        	</div>
				        	<div class="row">
				        		<div class="col form-group">
				        			<label for="fechapago">Banco</label>
				        			<select name="bancopago" id="bancopago" class="form-control">
				        				<option value="1">BANCO NACIONAL DE MEXICO, S.A</option>
				        				<option value="2">BANCO MERCANTIL DEL NORTE, S.A</option>
				        				<option value="4">BANAMEX Dlls</option>
				        			</select>
				        		</div>
				        	</div>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button id="editar-pago-cliente" type="button" class="btn btn-primary">Guardar</button>
				      </div>
				    </div>
				  </div>
				</div>

      	</main>
    </div>
</body>
</html>
	<script>
		$(document).on("ready", function(){
			buscar_cuentas();
			listar_pagos();
			registrar_pagos();
		});



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

	var cambiar_total = function(){
		var pedidos = new Array();
		$("input[name=pedido]").each(function (index) {
			if($(this).is(':checked')){
				pedidos.push($(this).val());
			}
		});
		console.log(pedidos);
		var idcliente = $("#idclientebuscar").val();
		var opcion = "buscartotalpedidoscliente";
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"pedidos": JSON.stringify(pedidos), "idcliente": idcliente, "opcion": opcion},
		}).done( function( data ){
			console.log(data);
			$("#total").val(data.total);				
		});
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
		var idcliente = $("#idclientebuscar").val();
		if (idcliente == "") {
			alert("Debes de ingresar un cliente!");
		}else{
			$("#pagos").slideUp("slow");
			$("#pagados_cliente").slideUp("slow");
			$("#desglosar_facturas").slideUp("slow");
			$("#pagos_cliente").slideDown("slow");
			listar_pagos_cliente(idcliente);
		}
	});

	var listar_pagos_cliente = function(idcliente){
		console.log(idcliente);
		var table = $('#dt_pagos_cliente').DataTable({
			"order": false,
			"ordering": false,
	        "lengthChange": false,
	        "info": false,
	        "paging": false,
	        // "searching": false,
	        "destroy":"true",
			"ajax":{
				"method":"POST",
				"url":"listar_pagos_cliente.php",
				"data":{"idcliente": idcliente},
			},
			"columns":[
				{"data":"check"},
				{"data":"cliente"},
				{"data":"factura"},
				{"data":"ordencompra"},
				{"data":"moneda"},
				{"data":"abonado"},
				{"data":"pendiente"},
				{"data":"total"}
			],
			"language": idioma_espanol,
			"dom":  
			"<'container row col-12 row'<'row justify-content-end col-12 buttons'f>>" +
			"<'container row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
			"<'container row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>"

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

	$("#registrar-pagos-cliente").on("click", function(){
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
			var cliente = $("#idclientebuscar").val();
			var fecha = $("#fechacliente").val();
			var cuenta = $("#cuentacliente").val();
			var tipocambio = $("#tipocambiocliente").val();
			var opcion = 'registrarpagoscliente';
			console.log(cliente);
			console.log(numeroPartidas);
			console.log(pagos);
			console.log(fecha);
			console.log(cuenta);
			console.log(tipocambio);
			console.log(opcion);
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"cliente": cliente, "fecha": fecha, "cuenta": cuenta, "tipocambio": tipocambio, "opcion": opcion, "numeroPartidas": numeroPartidas, "pagos": JSON.stringify(pagos)},
			}).done( function( data ){
				console.log(data);				
				mostrar_mensaje(data);
			});
		}
	});

	$("#buscarPagadosCliente").on("click", function(){
		var idcliente = $("#idclientebuscar").val();
		if (idcliente == "") {
			alert("Debes de ingresar un cliente!");
		}else{
			$("#pagos").slideUp("slow");
			$("#pagos_cliente").slideUp("slow");
			$("#desglosar_facturas").slideUp("slow");
			$("#pagados_cliente").slideDown("slow");
			listar_pagados_cliente(idcliente);
		}
	});

	var listar_pagados_cliente = function(idcliente){
		console.log(idcliente);
		var table = $('#dt_pagados_cliente').DataTable({
			"order": false,
			"ordering": false,
	        "lengthChange": false,
	        "info": false,
	        // "paging": false,
	        // "searching": false,
	        "destroy":"true",
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
				{"defaultContent": "<button class='editar-pago-cliente btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"},
				{"defaultContent": "<button class='desglosar-pago-cliente btn btn-primary'><i class='fa fa-list-alt' aria-hidden='true'></i></button>"}
			],
			"language": idioma_espanol,
			"dom":  
			"<'container row col-8 row'<'row justify-content-end col-12 buttons'f>>" +
			"<'container row col-8 row'<'justify-content-center col-12 buttons'tr>>" +
			"<'container row col-8 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>"
		});

		obtener_data_editar_pago("#dt_pagados_cliente tbody", table);
		obtener_data_desglosar_pago("#dt_pagados_cliente tbody", table);
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
			var idcliente = $("#idclientebuscar").val();
			listar_pagados_cliente(idcliente);
		});
	});

	var obtener_data_desglosar_pago = function(tbody, table){
		$(tbody).on("click", "button.desglosar-pago-cliente", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			var idpago = data.idpedido;
			console.log(idpago);
			$("#idpagofacturas").val(data.idpedido);
			$("#pagados_cliente").slideUp("slow");
			$("#desglosar_facturas").slideDown("slow");
			listar_facturas_pago(idpago);
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

	var mostrar_mensaje = function( informacion ){
		var texto = "", color = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>BIEN!</strong> Se ha registrado la información correctamente.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>ERROR!</strong> No se ejecutó la consulta.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";		
		}else if( informacion.respuesta == "EXISTE"){
			texto = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>INFORMACION!</strong> El pago de la factura/orden de compra ya se encuentra registrado.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";		
		}

		$(".mensaje").html( texto );
	}

	var limpiar_datos = function(){
		$("form .limpiar").val("");
		buscar_clientes();
		buscar_cuentas();
	}

	var idioma_espanol = {
		"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
	    "oPaginate": {
	        "sFirst":    "Primero",
	        "sLast":     "Último",
	        "sNext":     "Siguiente",
	        "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }
	}

</script>

