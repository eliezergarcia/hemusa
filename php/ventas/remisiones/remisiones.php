<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<head>
  <title>Remisiones</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
    	<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Remisiones</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Facturación</a></li>
	                    <li class="breadcrumb-item"><a href="#">Remisiones</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
								<!-- Tabla de remisiones -->
									<table id="dt_remisiones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Remision</th>
												<th>Cliente</th>
												<th>Contacto</th>
												<th>Fecha</th>
												<th>Cantidad</th>
												<th>Suma</th>
												<th>Factura(s)</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

	<!-- Modal Nueva Remisión -->
		<form name="agregarRemision" action="#" method="POST">
			<input type="hidden" id="opcion" name="opcion" value="nuevaremision">
			<div class="modal fade colored-header colored-header-success" id="modalNuevaRemision" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modalNuevaCotizacionLabel"><i class="fas fa-file fa-sm"></i> Nueva remisión</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body container">
							<div class="row">
								<div class="col form-group">
									<label for="numeroCotizacion">Referencia <font color="#FF4136">*</font></label>
									<input type="text" id="numeroCotizacion" name="numeroCotizacion" class="disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="remision">Remision <font color="#FF4136">*</font></label>
									<input type="text" id="remision" name="remision" class="disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="fechaCotizacion">Fecha <font color="#FF4136">*</font></label>
									<input type="text" id="fechaCotizacion" name="fechaCotizacion" class="disabled form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" disabled>
								</div>
								<div class="col form-group">
									<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
									<input type="text" id="vendedor" name="vendedor" class="disabled form-control form-control-sm" value="<?php echo $usuario." ".$usuarioApellido; ?>" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-8 form-group">
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
										<option>
											<option value="mxn" selected>MXN</option>
											<option value="usd">USD</option>
										</option>
									</select>
								</div>
								<div class="col form-group">
									<label for="comentarios">Comentarios</label>
									<textarea name="comentarios" id="comentarios" class="form-control form-control-sm" cols="30" rows="3" placeholder="Opcional"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-success">Hecho</button>
						</div>
					</div>
				</div>
			</div>
		</form>

	</header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
	      	App.pageCalendar();
	      	App.formElements();
	      	App.uiNotifications();
			listar();
			guardar();
			// eliminar();
		});

		var  listar = function(){
			var table = $("#dt_remisiones").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_remisiones.php"
				},
				"columns":[
					{"data": "indice"},
					{"data": "remision"},
					{"data": "cliente"},
					{"data": "contacto"},
					{"data": "fecha"},
					{"data": "cantidad"},
					{"data": "suma"},
					{"data": "facturas"},
					{"defaultContent": "<div class='invoice-footer'><button class='verRemision btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
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
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
			            	]
		          	},
					{
						text: '<i class="fas fa-file fa-sm" aria-hidden="true"></i> Nueva remisión',
						"className": "btn btn-lg btn-space btn-secondary",
						action: function (e, dt, node, config){
							$('#modalNuevaRemision').modal('show');
						}
					}
				]
			});
			$("#dt_remision tfoot input").on( 'keyup change', function () {
        		table
            		.column( $(this).parent().index()+':visible' )
            		.search( this.value )
            		.draw();
    		});
			obtener_data_editar("#dt_remisiones tbody", table);
			// obtener_id_eliminar("#dt_cliente tbody", table);
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.verRemision", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				window.location.href = "verRemision.php?remision="+data.remision;
			});
		}

		$("#modalNuevaRemision").on("show.bs.modal", function(){
			var opcion = "nuevaremision";
			console.log(opcion);
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					console.log(data);
					if(data.resultado == 'ok'){
						$("form #numeroCotizacion").val(data.numeroCotizacion);
						$("form #remision").val(data.remision);
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
					data: frm
				}).done( function( info ){
					var json_info = JSON.parse( info );
					if (json_info.respuesta == "BIEN") {
						window.location= "verRemision.php?remision="+json_info.remision;
					}else{
						mostrar_mensaje(json_info);
					}
				});
			});
		}

		var eliminar = function(){
			$("#eliminar-usuario").on("click", function(){
				var idusuario = $("#frmEliminarUsuario #idusuario").val(),
					opcion = $("#frmEliminarUsuario #opcion").val();
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"idusuario": idusuario, "opcion": opcion}
				}).done( function( info ){
					// console.log(info);
					// var json_info = JSON.parse( info );
					// console.log(json_info);
					texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
					color = "#379911";
					$(".mensaje").html( texto ).css({"color": color });
					$(".mensaje").fadeOut(3000, function(){
					$(this).html("");
					$(this).fadeIn(3000);
					});

					limpiar_datos();
					listar();
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<strong>Error</strong>, no se ejecutó la consulta.";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<strong>Información!</strong> el usuario ya existe.";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<strong>Adbertencia!</strong> la opción no existe o esta vacía, recargar la página. ";
				color = "#DDB11D";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(3000, function(){
			$(this).html("");
			$(this).fadeIn(3000);
			});
		}

		var limpiar_datos = function(){
			$("#opcion").val("registrar");
			$("#idusuario").val("");
			$("#usuario").val("").focus();
			$("#password").val("");
			$("#nombre").val("");
			$("#apellidos").val("");
			$("#departamento").val("");
			$("#nivel").val("");
		}

		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#frmEliminarUsuario #idusuario").val(data.id);
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
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
