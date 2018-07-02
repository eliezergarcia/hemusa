<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);
	$vendedor = $usuario.' '.$usuarioApellido;
	$fecha = date("d").'-'.date("m").'-'.date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Cotizaciones</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Cotizaciones</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
	                    <li class="breadcrumb-item"><a href="#">Cotizaciones</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                      			<!-- Tabla de Cotizaciones -->
															<table id="dt_cotizaciones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>Referencia</th>
																		<th>Cliente</th>
																		<th>Vendedor</th>
																		<th>Contacto</th>
																		<th>Fecha</th>
																		<th>Partidas</th>
																		<th>Total (Sin IVA)</th>
																		<th>Ver</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

		<!-- Modal Nueva Cotizacion -->
		 	<form name="agregarCotizacion" action="#" method="POST">
		 		<input type="hidden" id="opcion" name="opcion" value="agregarcotizacion">
		 		<input type="hidden" id="usuariologin" name="usuariologin">
		 		<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade colored-header colored-header-success" id="modalNuevaCotizacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva cotización</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body container">
								<div class="row">
									<div class="col form-group">
										<label for="numeroCotizacion">Número cotización <font color="#FF4136">*</font></label>
										<input type="text" id="numeroCotizacion" name="numeroCotizacion" class="disabled form-control form-control-sm" disabled>
									</div>
									<div class="col form-group">
										<label for="fechaCotizacion">Fecha <font color="#FF4136">*</font></label>
										<input type="text" id="fechaCotizacion" name="fechaCotizacion" class="disabled form-control form-control-sm" value="<?php echo $fecha; ?>" disabled>
									</div>
									<div class="col form-group">
										<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
										<input type="text" id="vendedor" name="vendedor" class="disabled form-control form-control-sm" value="<?php echo $vendedor; ?>" disabled>
									</div>
								</div>
								<div class="row">
										<div class="col-7 form-group">
											<label for="cliente">Cliente <font color="#FF4136">*</font></label>
											<input placeholder="Busca un cliente" class="form-control form-control-sm col-12" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="buscarDatosCliente()"  required >
											<!-- <datalist id="clientes">
											</datalist> -->
										</div>
										<div class="col form-group">
											<label for="contactoCliente">Contacto <font color="#FF4136">*</font></label>
											<select name="contactoCliente" id="contactoCliente" class="form-control form-control-sm select2" onchange="agregarcontacto()" required>
												<option value="">Selecciona</option>
											</select>
										</div>
								</div>
								<div class="row">
									<div class="col-3 form-group">
										<label for="moneda">Moneda <font color="#FF4136">*</font></label>
										<select id="moneda" name="moneda" class="form-control form-control-sm select2" required>
											<option value="mxn">MXN</option>
											<option value="usd">USD</option>
										</select>
									</div>
									<div class="col-4 form-group">
										<label for="tiempoEntrega">Tiempo de entrega <font color="#FF4136">*</font></label>
										<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="awesomplete form-control form-control-sm col-12" list="clientes" placeholder="días" required/>
									</div>
									<div class="col form-group">
										<label for="condicionesPago">Condiciones de pago <font color="#FF4136">*</font></label>
										<input type="text" id="condicionesPago" name="condicionesPago" class="form-control form-control-sm" placeholder="días" required>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="comentarios">Comentarios</label>
										<textarea name="comentarios" id="comentarios" class="form-control form-control-sm" cols="30" rows="3" placeholder="Opcional"></textarea>
									</div>
								</div>
							</div>
							<div class="modal-footer invoice-footer">
								<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-lg btn-success" name="crearCotizacion">Hecho</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		<!-- Modal Agregar Contacto -->
		 	<form id="frmagregarcontacto" action="#" method="POST">
		 		<input type="hidden" id="opcion" name="opcion" value="agregarcontacto">
		 		<input type="hidden" id="idcliente" name="idcliente">
		 		<input type="hidden" id="usuariologin" name="usuariologin">
		 		<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade colored-header colored-header-success" id="modalAgregarContacto" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="modalNuevaCotizacionLabel">Registro de contacto</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body container">
								<div class="col-12">
									<div class="row">
										<div class="form-group col">
											<label for="contacto">Contacto <font color="#FF4136">*</font></label>
											<input type="text" id="contacto" name="contacto" class="form-control form-control-sm" required>
										</div>
										<div class="form-group col">
											<label for="puesto">Puesto <font color="#FF4136">*</font></label>
											<input type="text" id="puesto" name="puesto" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group col">
											<label for="calle">Calle</label>
											<input type="text" id="calle" name="calle" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="colonia">Colonia</label>
											<input type="text" id="colonia" name="colonia" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="ciudad">Ciudad</label>
											<input type="text" id="ciudad" name="ciudad" class="form-control form-control-sm" placeholder="Opcional">
										</div>
									</div>
									<div class="row">
										<div class="form-group col">
											<label for="estado">Estado</label>
											<input type="text" id="estado" name="estado" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="cp">C.P.</label>
											<input type="text" id="cp" name="cp" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="pais">Pais</label>
											<input type="text" id="pais" name="pais" class="form-control form-control-sm" placeholder="Opcional">
										</div>
									</div>
									<div class="row">
										<div class="form-group col">
											<label for="tlf">Telefono</label>
											<input type="text" id="tlf" name="tlf" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="movil">Movil</label>
											<input type="text" id="movil" name="movil" class="form-control form-control-sm" placeholder="Opcional">
										</div>
										<div class="form-group col">
											<label for="correoElectronico">Correo electronico <font color="#FF4136">*</font></label>
											<input type="text" id="correoElectronico" name="correoElectronico" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer invoice-footer">
								<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-lg btn-success" name="crearCotizacion">Agregar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		<!-- Modal OC Pendientes -->
			<div class="modal fade" id="modalOCPendientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-12 row justify-content-center">
								<div class="form-group row justify-content-center col-12">
									<label class="control-label">Proveedores con herramienta sin entregar y sin crear OC</label>
								</div>
								<div class="form-group row justify-content-center col-12">
									<select name="proveedoressinoc" id="proveedoressinoc" class="form-control col-6" onchange="verproveedor2()"></select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

			<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						</div>
						<div class="modal-body">
							<div class="text-center">
								<div class="texto1">
									<br><br>
									<h3>Espere un momento...</h3>
									<h4>La cotización se esta generando</h4>
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
      		App.pageCalendar();
      		App.formElements();
      		App.uiNotifications();
			listar_cotizaciones();
			guardar();
		});

		var listar_cotizaciones = function(){
			var opcion = "listarcotizaciones";
			var table = $("#dt_cotizaciones").DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion},
				},
				"columns":[
					{"data": "ref"},
					{"data": "nombreEmpresa"},
					{"data": "vendedor"},
					{"data": "contacto"},
					{"data": "fecha"},
					{"data": "partidaCantidad"},
					{"data": "precioTotal"},
					{"defaultContent": "<div class='invoice-footer'><button class='vercotizacion btn btn-space btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
				],
				"columnDefs": [
					{ "width": "5%", "targets": 0 },
					{ "width": "5%", "targets": 2 },
					{ "width": "5%", "targets": 3 },
				],
				"order":[[4, "desc"]],
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
					{
						text: '<i class="fas fa-file-alt fa-sm" aria-hidden="true"></i> Agregar cotización',
						"className": "btn btn-lg btn-space btn-secondary",
						action: function (e, dt, node, config){
							$('#modalNuevaCotizacion').modal('show');
						}
					}
				]
			});

			obtener_data_ver_cotizacion("#dt_cotizaciones tbody", table);
		}

		var obtener_data_ver_cotizacion = function(tbody, table){ // se obtiene el id del usuario para eliminar del DT Usuarios
			$(tbody).on("click", "button.vercotizacion", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var cotizacion = data.ref;
				// console.log(cotizacion);
				window.location.href = "verCotizacion.php?numero="+cotizacion;
			});
		}

		$("#modalNuevaCotizacion").on("show.bs.modal", function(){
			var opcion = "nuevacotizacion";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					// console.log(data);
					if(data.resultado == 'ok'){
						$("form #numeroCotizacion").val(data.numeroCotizacion);
					}
				}
			});
			opcion = "buscarClientes";
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
				}
			});
		});

		function agregarcontacto(){
			var contacto = $("form #contactoCliente").val();
			if (contacto == "- Agregar contacto -") {
				$("#modalAgregarContacto").modal("show");
			}
		}

		function buscarDatosCliente(){
			$("#frmAgregarCotizacion #contactoCliente").val("");
			$("#frmAgregarCotizacion #moneda").val("");
			$("#frmAgregarCotizacion #tiempoEntrega").val("");
			$("#frmAgregarCotizacion #condicionesPago").val("");
			$("#frmAgregarCotizacion #comentarios").val("");
			var cliente = $("form #cliente").val();
			var opcion = "buscarDatosCliente";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"cliente": cliente, "opcion": opcion},
				success : function(data) {
					var idcliente = data.data.id
					buscarContactos(idcliente);
					$("form #moneda").val(data.data.moneda).change();
					$("form #condicionesPago").val(data.data.CondPago);
				}
			});
		}

		function buscarContactos(idcliente){
			var opcion = "buscarContactos";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"id": idcliente, "opcion": opcion},
				success : function(data) {
					// console.log(data);
					if (data.respuesta == "Ninguno") {
						$("form #contactoCliente").empty();
						$("form #contactoCliente").append("<option>Ninguno</option>");
						$("form #contactoCliente").append("<option>- Agregar contacto -</option>");
						$("#frmagregarcontacto #idcliente").val(data.idcliente);
					}else{
						$("#frmagregarcontacto #idcliente").val(data.idcliente);
						var contactos = data.contactos;
						$('#contactoCliente').empty();
						var contacto = document.getElementById("contactoCliente");
						for(var i=0;i<contactos.length;i++){
							$("#contactoCliente").append("<option>" + contactos[i] + "</option>");
						};
						$("form #contactoCliente").append("<option>- Agregar contacto -</option>");
					}
				}
			});
		}

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$('form .disabled').attr('disabled', false);
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm,
				}).done( function( info ){
					var json_info = JSON.parse( info );
					if (json_info.guardar == "contacto") {
						mostrar_mensaje(json_info);
						$('#modalAgregarContacto').modal('hide');
						$('#modalNuevaCotizacion').modal('show');
						buscarContactos(json_info.idcliente);
					}else{
						$('.modal').modal('hide');
						$("#mod-success").modal("show");
						if (json_info.respuesta == "BIEN") {
							setTimeout(function () {
								$(".texto1").fadeOut(300, function(){
									$(this).html("");
									$(this).fadeIn(300);
								});
							}, 2000);
							setTimeout(function () {
								$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
								$(".texto1").append("<h3>Correcto!</h3>");
								$(".texto1").append("<h4>La cotización se generó correctamente.</h4>");
								$(".texto1").append("<div class='text-center'>");
								$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
								$(".texto1").append("</div>");
							}, 2500);
							setTimeout(function () {
								window.location= "verCotizacion.php?numero="+json_info.cotizacion;
							}, 4000);
						}else{
							setTimeout(function () {
								$("#mod-success").modal("hide");
								mostrar_mensaje(json_info);
							}, 2000);
						}
					}
				});
			});
		}

	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
