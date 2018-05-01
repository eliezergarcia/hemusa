<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	error_reporting(0); // Eliminamos los mensajes de error de
?>
<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<title>Usuarios</title>
	<?php include('../../enlacescss.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Usuarios</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                          		<!-- Tabla de Usuarios -->
									<table id="dt_usuarios" class="table table-striped table-hover table-bordered compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Usuario</th>
												<th>Nombre</th>
												<th>Apellidos</th>
												<th>Departamento</th>
												<th>Ver y Editar</th>
												<th>Eliminar</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Usuario</th>
												<th>Nombre</th>
												<th>Apellidos</th>
												<th>Departamento</th>
												<td></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

		<!-- Modal Registrar Usuario -->
			<form id="frmRegistrarUsuario" action="" method="POST">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade colored-header colored-header-success" id="modalRegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="exampleModalLabel"><i class="icon icon-left mdi mdi-account-add" aria-hidden="true"></i><b> Registro de usuario</b></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="row ">
									<div class="col form-group">
										<h3><b>Datos Hemusa</b></h3>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="nombre">Nombre <font color="#FF4136">*</font></label>
										<input type="text" id="nombre" name="nombre" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="apellido">Apellido <font color="#FF4136">*</font></label>
										<input type="text" id="apellido" name="apellido" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="correoHemusa">Correo electrónico <font color="#FF4136">*</font></label>
										<input type="email" id="correoHemusa" name="correoHemusa" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="usuario">Usuario <font color="#FF4136">*</font></label>
										<input type="text" id="usuario" name="usuario" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="pass">Contraseña <font color="#FF4136">*</font></label>
										<input type="text" id="pass" name="pass" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="departamento">Departamento <font color="#FF4136">*</font></label>
										<input type="text" id="departamento" name="departamento" class="form-control form-control-sm" required>
									</div>
								</div>
								<hr>
								<div class="row ">
									<div class="col form-group">
										<h3><b>Datos Personales</b></h3>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="direccion">Dirección</label>
										<input type="text" id="direccion" name="direccion" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="col-3 form-group">
										<label for="tlfCasa">Teléfono Casa</label>
										<input type="text" id="tlfCasa" name="tlfCasa" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-3 form-group">
										<label for="movil">Móvil</label>
										<input type="text" id="movil" name="movil" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-4 form-group">
										<label for="correoPersonal">Correo electrónico</label>
										<input type="email" id="correoPersonal" name="correoPersonal" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-2 form-group">
										<label for="tipoSangre">Tipo Sangre</label>
										<input type="text" id="tipoSangre" name="tipoSangre" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="contactoEmergencia">Contacto de Emergencia</label>
										<input type="text" id="contactoEmergencia" name="contactoEmergencia" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col form-group">
										<label for="imss">IMSS</label>
										<input type="text" id="imss" name="imss" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success btn-lg">Registrar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		<!-- Modal Editar Usuario -->
			<form id="frmEditarUsuario" action="" method="POST">
				<input type="hidden" id="opcion" name="opcion" value="editar">
				<input type="hidden" id="idusuario" name="idusuario">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<!-- Modal -->
				<div class="modal fade colored-header colored-header-primary" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuario">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="modalEditarLabel"><b><i class="icon icon-left mdi mdi-edit" aria-hidden="true"></i> Información de usuario</b></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="row ">
									<div class="col form-group">
										<h3><b>Datos Hemusa</b></h3>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="nombre">Nombre <font color="#FF4136">*</font></label>
										<input type="text" id="nombre" name="nombre" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="apellido">Apellido <font color="#FF4136">*</font></label>
										<input type="text" id="apellido" name="apellido" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="correoHemusa">Correo electrónico <font color="#FF4136">*</font></label>
										<input type="text" id="correoHemusa" name="correoHemusa" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="usuario">Usuario <font color="#FF4136">*</font></label>
										<input type="text" id="usuario" name="usuario" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="pass">Contraseña <font color="#FF4136">*</font></label>
										<input type="text" id="pass" name="pass" class="form-control form-control-sm" required>
									</div>
									<div class="col form-group">
										<label for="departamento">Departamento <font color="#FF4136">*</font></label>
										<input type="text" id="departamento" name="departamento" class="form-control form-control-sm" required>
									</div>
								</div>
								<hr>
								<div class="row ">
									<div class="col form-group">
										<h3><b>Datos Personales</b></h3>
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="direccion">Dirección</label>
										<input type="text" id="direccion" name="direccion" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="col-3 form-group">
										<label for="tlfCasa">Teléfono Casa</label>
										<input type="text" id="tlfCasa" name="tlfCasa" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-3 form-group">
										<label for="movil">Móvil</label>
										<input type="text" id="movil" name="movil" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-4 form-group">
										<label for="correoPersonal">Correo electrónico</label>
										<input type="text" id="correoPersonal" name="correoPersonal" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col-2 form-group">
										<label for="tipoSangre">Tipo Sangre</label>
										<input type="text" id="tipoSangre" name="tipoSangre" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="col form-group">
										<label for="contactoEmergencia">Contacto de Emergencia</label>
										<input type="text" id="contactoEmergencia" name="contactoEmergencia" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="col form-group">
										<label for="imss">IMSS</label>
										<input type="text" id="imss" name="imss" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary btn-lg">Editar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		<!-- Modal Eliminar Usuario -->
			<form id="frmEliminarUsuario" action="" method="POST">
				<input type="hidden" id="idusuario" name="idusuario" value="">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<input type="hidden" id="opcion" name="opcion" value="eliminar">
				<!-- Modal -->
				<div class="modal-full-color modal-full-color-danger modal fade" id="modalEliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
			                  	<button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
			                </div>
			                <div class="modal-body">
                  				<div class="text-center">
                    				<div class="text-center"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                    				<h4><b>¿Está seguro de eliminar el usuario?</b></h4>
                    				<div class="row justify-content-center">
                    					<input type="text" class="disabled form-control col-6 form-control form-control-sm" id="usuario" name="usuario" disabled>
                    				</div>
                    				<div class="mt-8">
                      					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      					<button type="submit" class="btn btn-danger">Eliminar</button>
                    				</div>	
                  				</div>
                			</div>
							<div class="modal-footer"></div>
						</div>
					</div>
				</div>
				<!-- Modal -->
			</form>

    <header>
    <?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
      		App.pageCalendar();       
      		App.formElements();
      		App.uiNotifications();
			listar(); // Función para listar la tabla de usuarios
			guardar(); // Función para registrar, modificar y eliminar
		});

		var  listar = function(data){ // DataTable de Usuarios
			$('#dt_usuarios tfoot th').each( function () {
	    		var title = $(this).text();
	    		$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="Buscar '+ title +'" />' );
	  		});

			var table = $("#dt_usuarios").DataTable({
				"destroy": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST"
				},
				"columns":[
					{"data": "user"},
					{"data": "nombre"},
					{"data": "apellidos"},
					{"data": "dp"},
					{"defaultContent": "<button data-toggle='modal' data-target='#modalEditarUsuario' class='editar btn btn-space btn-primary btn-lg'><i class='icon icon-left mdi mdi-edit' aria-hidden='true'></i></button>", "sortable": false},
					{"defaultContent": "<button data-toggle='modal' data-target='#modalEliminarUsuario' class='eliminar btn btn-space btn-danger btn-lg'><i class='icon icon-left mdi mdi-delete' aria-hidden='true'></i></button>", "sortable": false}
				],
				"order":[[0, "asc"]],
				"language": idioma_espanol,
				"dom":
          			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
          			"<'row be-datatable-body'<'col-sm-12'tr>>" +
          			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons":[
		          {
		            extend:    'pdfHtml5',
		            text:      '<i class="icon mdi mdi-collection-pdf" style="color:white"></i>',
		            titleAttr: 'Generar PDF',
		            download: 'open',
		            "className": "btn btn-danger btn-big",
		            exportOptions: {
		              columns: [ 0, 1, 2, 3 ]
		            }
		          },
		          {
		            extend:    'excelHtml5',
		            text:      '<i class="icon icon-left mdi mdi-file" style="color:white"></i>',
		            titleAttr: 'Generar Excel',
		            "className": "btn btn-success btn-big",
		            exportOptions: {
		              columns: [ 0, 1, 2, 3 ]
		            }
		          },
		          {
		            extend: 'csv',
		            text: '<i class="icon icon-left mdi mdi-file-text" style="color:white"></i>',
		            titleAttr: 'Generar CSV',
		            "className": "btn btn-primary btn-big",
		            exportOptions: {
		                    columns: [ 0, 1, 2, 3 ]
		            }
		          },
		          {
		            extend: 'print',
		            text: '<i class="icon icon-left mdi mdi-print" style="color:white"></i>',
		            titleAttr: 'Imprimir',
		            header: 'false',
		            exportOptions: {
		                    columns: [ 0, 1, 2, 3 ]
		            },
		            "className": "btn btn-warning btn-big",
		            orientation: 'landscape',
		            pageSize: 'LEGAL'
		          },
		          {
		            text: '<i class="icon icon-left mdi mdi-plus-circle" style="color:white"></i> Usuario',
		            "className": "btn btn-success btn-big",
		            titleAttr: 'Registrar usuario',
		            action: function (e, dt, node, config){
		              $("#modalRegistrarUsuario").modal("show");
		            }
		          }
		        ]
			});

			$("#dt_usuarios tfoot input").on( 'keyup change', function () {
	    		table
	        		.column( $(this).parent().index()+':visible' )
	        		.search( this.value )
	        		.draw();
			});

			obtener_data_editar("#dt_usuarios tbody", table);
			obtener_id_eliminar("#dt_usuarios tbody", table);
		}

		var obtener_data_editar = function(tbody, table){ // Se obtiene los datos de usuarios para editar del DT Usuarios
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#frmEditarUsuario #idusuario").val(data.id),
					usuario = $("#frmEditarUsuario #usuario").val(data.user),
					pass = $("#frmEditarUsuario #pass").val(data.password),
					nombre = $("#frmEditarUsuario #nombre").val(data.nombre),
					apellido = $("#frmEditarUsuario #apellido").val(data.apellidos),
					departamento = $("#frmEditarUsuario #departamento").val(data.dp),
					direccion = $("#frmEditarUsuario  #direccion").val(data.direccion),
					tlfCasa = $("#frmEditarUsuario  #tlfCasa").val(data.tlfcasa),
					movil = $("#frmEditarUsuario  #movil").val(data.movil),
					correoPersonal = $("#frmEditarUsuario #correoPersonal").val(data.correoPersonal),
					correoHemusa = $("#frmEditarUsuario #correoHemusa").val(data.correoHemusa),
					contraHemusa = $("#frmEditarUsuario #contraHemusa").val(data.contraHemusa),
					tipoSangre = $("#frmEditarUsuario #tipoSangre").val(data.tipoSangre),
					contactoEmergencia = $("#frmEditarUsuario #contactoEmergencia").val(data.contactoEmergencia),
					imss = $("#frmEditarUsuario #imss").val(data.imss),
					opcion = $("#frmEditarUsuario #opcion").val("editar");
			});
		}

		var obtener_id_eliminar = function(tbody, table){ // se obtiene el id del usuario para eliminar del DT Usuarios
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#frmEliminarUsuario #idusuario").val(data.id);
				$("#frmEliminarUsuario #usuario").val(data.nombre + " " + data.apellidos);
			});
		}

		var guardar = function(){ // Se envian los datos para guardar cambios
			$("form").on("submit", function(e){
				e.preventDefault();
				$("form .disabled").attr("disabled", false);
				var frm = $(this).serialize();
				$("#modalRegistrarUsuario").modal("hide");
				$("#modalEditarUsuario").modal("hide");
				$("#modalEliminarUsuario").modal("hide");
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm,
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					limpiar_datos();
					listar();
				});
			});
		}

		var mostrar_mensaje = function( informacion ){ // Mensaje que muestra las actualizaciones de cambios
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecutó la consulta.</div>";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<div class='alert alert-warning'><strong>Información!</strong> el usuario ya existe.</div>";
				color = "#5b94c5";
			}

			$(".mensaje").html( texto );
			$(".mensaje").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(5000);
			});
		}

		var limpiar_datos = function(){ // Se limpian los campos para nuevo registro
			$("#frmRegistrarUsuario #opcion").val("registrar");
			$("#frmRegistrarUsuario #idusuario").val("");
			$("#frmRegistrarUsuario #nombre").val("");
			$("#frmRegistrarUsuario #apellido").val("");
			$("#frmRegistrarUsuario #correoPersonal").val("");
			$("#frmRegistrarUsuario #usuario").val("").focus();
			$("#frmRegistrarUsuario #pass").val("");
			$("#frmRegistrarUsuario #departamento").val("");
			$("#frmRegistrarUsuario #direccion").val("");
			$("#frmRegistrarUsuario #tlfCasa").val("");
			$("#frmRegistrarUsuario #movil").val("");
			$("#frmRegistrarUsuario #correoPersonal").val("");
			$("#frmRegistrarUsuario #tipoSangre").val("");
			$("#frmRegistrarUsuario #contactoEmergencia").val("");
			$("#frmRegistrarUsuario #imss").val("");
			$("form .disabled").attr("disabled", true);
		}

		var idioma_espanol = { // Se cambia el idioma del DT
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
</body>
</html>