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
	<?php include('../../enlaces.php'); ?>

</head>
<body>

	<?php include('../../header.php'); ?>

  		<main class="mdl-layout__content">
    		<div class="page-content">
				<!-- Breadcrumb -->
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item">Ventas</li>
					    	<li class="breadcrumb-item active">Cotizaciones</li>
					  	</ol>
					</nav>

    			<!-- Encabezado -->
	    			<div id="encabezado" class="row fondo">
						<div class="col-sm-12">
							<br><h1 class="text-center"><b>Cotizaciones</b></h1><br>
						</div>
					</div>

			 	<!-- Mensaje actualizaciones-->
					<div>
						<center><h6 class="mensaje"></h6></center>
					</div>

				<!-- Tooltips -->
					<div class="mdl-tooltip" data-mdl-for="toolTipNuevaCotizacion">
						<strong>Nueva cotización</strong>
					</div>

				<!-- Modal Nueva Cotizacion -->
				 	<form name="agregarCotizacion" action="#" method="POST">
				 		<input type="hidden" id="opcion" name="opcion" value="agregarcotizacion">
				 		<input type="hidden" id="usuariologin" name="usuariologin">
				 		<input type="hidden" id="dplogin" name="dplogin">
						<div class="modal fade" id="modalNuevaCotizacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva Cotización</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body container">
										<div class="row">
											<div class="col form-group">
												<label for="numeroCotizacion">Número cotización <font color="#FF4136">*</font></label>
												<input type="text" id="numeroCotizacion" name="numeroCotizacion" class="disabled form-control" disabled>
											</div>
											<div class="col form-group">
												<label for="fechaCotizacion">Fecha <font color="#FF4136">*</font></label>
												<input type="text" id="fechaCotizacion" name="fechaCotizacion" class="disabled form-control" value="<?php echo $fecha; ?>" disabled>
											</div>
											<div class="col form-group">
												<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
												<input type="text" id="vendedor" name="vendedor" class="disabled form-control" value="<?php echo $vendedor; ?>" disabled>
											</div>
										</div>
										<div class="row">
												<div class="col-8 form-group">
													<label for="cliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
													<input placeholder="Busca un cliente" class="form-control col-12" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="buscarDatosCliente()"  required >
													<!-- <datalist id="clientes">
													</datalist> -->
												</div>
												<div class="col form-group">
													<label for="contactoCliente">Contacto <font color="#FF4136">*</font></label>
													<select name="contactoCliente" id="contactoCliente" class="form-control" onchange="agregarcontacto()" required>
														<option value="">Selecciona</option>
													</select>
												</div>
										</div>
										<div class="row">
												<div class="col-2 form-group">
													<label for="moneda" class="col-12">Moneda <font color="#FF4136">*</font></label>
													<select id="moneda" name="moneda" class="form-control" required>
														<option>
															<option value="mxn" selected>MXN</option>
															<option value="usd">USD</option>
														</option>
													</select>

												</div>
												<div class="col-4 form-group">
													<label for="tiempoEntrega" class="col-12">Tiempo de entrega <font color="#FF4136">*</font></label>
													<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="awesomplete form-control col-12" list="clientes" placeholder="días" required/>
												</div>
												<div class="col form-group">
													<label for="condicionesPago">Condiciones de pago <font color="#FF4136">*</font></label>
													<input type="text" id="condicionesPago" name="condicionesPago" class="form-control" placeholder="días" required>
												</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="comentarios" class="col-12">Comentarios</label>
												<textarea name="comentarios" id="comentarios" class="form-control" cols="30" rows="3" placeholder="Opcional"></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer row center-xs">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success" name="crearCotizacion">Crear</button>
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
						<div class="modal fade" id="modalAgregarContacto" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="modalNuevaCotizacionLabel">Agregar contacto</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body container">
										<div class="col-12">
											<div class="row">
												<div class="form-group col">
													<label for="contacto">Contacto <font color="#FF4136">*</font></label>
													<input type="text" id="contacto" name="contacto" class="form-control" required>
												</div>
												<div class="form-group col">
													<label for="puesto">Puesto <font color="#FF4136">*</font></label>
													<input type="text" id="puesto" name="puesto" class="form-control" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col">
													<label for="calle">Calle</label>
													<input type="text" id="calle" name="calle" class="form-control" placeholder="Opcional">
												</div>
												<div class="form-group col">
													<label for="colonia">Colonia</label>
													<input type="text" id="colonia" name="colonia" class="form-control" placeholder="Opcional">
												</div>
												<div class="form-group col">
													<label for="ciudad">Ciudad</label>
													<input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Opcional">
												</div>
											</div>
											<div class="row">
												<div class="form-group col">
													<label for="estado">Estado</label>
													<input type="text" id="estado" name="estado" class="form-control" placeholder="Opcional">
												</div><font color="#FF4136">*</font>
												<div class="form-group col">
													<label for="cp">C.P.</label>
													<input type="text" id="cp" name="cp" class="form-control" placeholder="Opcional">
												</div>
												<div class="form-group col">
													<label for="pais">Pais</label>
													<input type="text" id="pais" name="pais" class="form-control" placeholder="Opcional">
												</div>
											</div>
											<div class="row">
												<div class="form-group col">
													<label for="tlf">Telefono</label>
													<input type="text" id="tlf" name="tlf" class="form-control" placeholder="Opcional">
												</div>
												<div class="form-group col">
													<label for="movil">Movil</label>
													<input type="text" id="movil" name="movil" class="form-control" placeholder="Opcional">
												</div>
												<div class="form-group col">
													<label for="correoElectronico">Correo electronico <font color="#FF4136">*</font></label>
													<input type="text" id="correoElectronico" name="correoElectronico" class="form-control" required>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer row center-xs">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success" name="crearCotizacion">Agregar</button>
									</div>
								</div>
							</div>
						</div>
					</form>

				<!-- Tabla de Cotizaciones -->
					<table id="dt_cotizaciones" class="table table-bordered table-striped table-hover display compact" cellspacing="0" width="100%">
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

			</div>
      	</main>
    </div>
</body>
</html>
<script>
	$(document).on("ready", function(){
		var idusuario = "<?php echo $idusuario; ?>";
		var opcion = "datosusuario";
		buscar_oc_pendientes();
		setInterval(buscar_oc_pendientes, 3000);
		listar_cotizaciones();
		guardar();
	});

	var listar_cotizaciones = function(){
		var opcion = "listarcotizaciones";
		var table = $("#dt_cotizaciones").DataTable({
			"destroy": true,
			"autoWidth": true,
			"processing": true,
			"deferRender": true,
			"scrollX": true,
			"sPaginationType": "full_numbers",
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
				{"defaultContent": "<button class='vercotizacion btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
			],
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "5%", "targets": 2 },
				{ "width": "5%", "targets": 3 },
			],
			"order":[[4, "desc"]],
			// "initComplete": function () {
			//     var api = this.api();
			//     api.$('td').click( function () {
			//         api.search( this.innerHTML ).draw();
			//     });
			// },
			"language": idioma_espanol,
			"dom":
				"<'container row col-10 row align-items-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
				"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
				"<'container row col-10 row'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
			"buttons":[
				{
					extend:    'pdfHtml5',
					text:      '<i class="fa fa-file-pdf-o"></i>',
					titleAttr: 'PDF',
					"className": "btn iconopdf",
					exportOptions: {
							columns: [ 0, 1, 2, 3, 4, 5, 6 ]
					},
				},
				{
					extend:    'excelHtml5',
					text:      '<i class="fa fa-file-excel-o"></i>',
					titleAttr: 'Excel',
					"className": "btn iconoexcel",
					exportOptions: {
							columns: [ 0, 1, 2, 3, 4, 5, 6 ]
					},
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fa fa-file-text-o"></i>',
					titleAttr: 'CSV',
					"className": "btn iconocsv",
					exportOptions: {
							columns: [ 0, 1, 2, 3, 4, 5, 6 ]
					},
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print" aria-hidden="true"></i>',
					titleAttr: 'Imprimir',
					header: 'false',
					exportOptions: {
							columns: [ 0, 1, 2, 3, 4, 5, 6 ]
					},
					"className": "btn iconoimprimir",
					orientation: 'landscape',
					pageSize: 'LEGAL'
				},
				{
					text: '<i id="toolTipNuevaCotizacion" class="fa fa-plus-circle" aria-hidden="true"></i> Cotizacion',
					"className": "btn btn-success btnNuevaCotizacion",
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
				$("#cliente").autocomplete({
					source: clientes
				});
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
				if (data.data.moneda == "mxn" ) {
					$("form #moneda").empty();
					$("form #moneda").append("<option value='mxn' selected>MXN</option>");
					$("form #moneda").append("<option value='usd'>USD</option>");
				}else{
					$("form #moneda").empty();
					$("form #moneda").append("<option value='usd' selected>USD</option>");
					$("form #moneda").append("<option value='mxn'>MXN</option>");
				}
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
			$('.modal').modal('hide');
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
					$('#modalNuevaCotizacion').modal('show');
					buscarContactos(json_info.idcliente);
				}else{
					if (json_info.respuesta == "BIEN") {
						window.location= "verCotizacion.php?numero="+json_info.cotizacion;
					}else{
						mostrar_mensaje(json_info);
						listar_cotizaciones();
					}
				}
			});
		});
	}

	var mostrar_mensaje = function( informacion ){
		var texto = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecutó la consulta.</div>";
		}

		$(".mensaje").html( texto );
		$(".mensaje").fadeOut(5000, function(){
			$(this).html("");
			$(this).fadeIn(5000);
		});
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
<script src="<?php echo $ruta; ?>/php/js/notificaciones.js"></script>
