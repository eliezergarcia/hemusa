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
							<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva remisión</h4>
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
                <h4>La remisión se esta generando</h4>
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
          var input = document.getElementById("cliente");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = data;
				}
			});
		});


    function buscarDatosCliente(){
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

    function agregarcontacto(){
			var contacto = $("#contactoCliente").val();
			if (contacto == "- Agregar contacto -") {
				$("#modalAgregarContacto").modal("show");
			}
		}

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$('form .disabled').attr('disabled', false);
				var frm = $(this).serialize();

				$.ajax({
					method: "POST",
					url: "guardar.php",
          dataType: "json",
					data: frm
				}).done( function( info ){
          if (info.guardar == "contacto") {
						mostrar_mensaje(info);
            $('#modalAgregarContacto').modal('hide');
						$('#modalNuevaRemision').modal('show');
						buscarContactos(info.idcliente);
					}else{
            $('.modal').modal('hide');
            $("#mod-success").modal("show");
            if (info.respuesta == "BIEN") {
              setTimeout(function () {
                $(".texto1").fadeOut(300, function(){
                  $(this).html("");
                  $(this).fadeIn(300);
                });
              }, 2000);
              setTimeout(function () {
                $(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
                $(".texto1").append("<h3>Correcto!</h3>");
                $(".texto1").append("<h4>La remisión se generó correctamente.</h4>");
                $(".texto1").append("<div class='text-center'>");
                $(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
                $(".texto1").append("</div>");
              }, 2500);
              setTimeout(function () {
                window.location= "verRemision.php?remision="+info.remision;
              }, 4000);
            }else{
              setTimeout(function () {
                $("#mod-success").modal("hide");
                mostrar_mensaje(info);
              }, 2000);
            }
          }
				});
			});
		}

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
