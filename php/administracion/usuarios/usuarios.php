<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	error_reporting(0); // Eliminamos los mensajes de error de
?>
<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<?php include('../../enlaces.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<main class="mdl-layout__content">
				<!-- Breadcrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Administración</li>
							<li class="breadcrumb-item active">Usuarios</li>
						</ol>
					</nav>

				<!-- Encabezado -->
					<div id="encabezado" class="col-sm-12">
						<br><h1 class="text-center"><b>Administración de usuarios</b></h1><br>
					</div>

				<!-- Mensaje de actualizaciones -->
					<div>
						<center><h6 class="mensaje"></h6></center>
					</div>

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

				<!-- Modal Registrar Usuario -->
					<form id="frmRegistrarUsuario" action="" method="POST">
						<input type="hidden" id="opcion" name="opcion" value="registrar">
						<input type="hidden" id="usuariologin" name="usuariologin">
						<input type="hidden" id="dplogin" name="dplogin">
						<div class="modal fade" id="modalRegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus btn-outline-success" aria-hidden="true"></i> Registrar Usuario</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="row ">
											<div class="col form-group">
												<h3>Datos Hemusa</h3>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="nombre">Nombre</label>
												<input type="text" id="nombre" name="nombre" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="apellido">Apellido</label>
												<input type="text" id="apellido" name="apellido" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="correoHemusa">Correo electrónico</label>
												<input type="email" id="correoHemusa" name="correoHemusa" class="form-control" required>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="usuario">Usuario</label>
												<input type="text" id="usuario" name="usuario" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="pass">Contraseña</label>
												<input type="text" id="pass" name="pass" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="departamento">Departamento</label>
												<input type="text" id="departamento" name="departamento" class="form-control" required>
											</div>
										</div>
										<hr>
										<div class="row ">
											<div class="col form-group">
												<h3>Datos Personales</h3>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="direccion">Dirección</label>
												<input type="text" id="direccion" name="direccion" class="form-control" required>
											</div>
										</div>
										<div class="row">
											<div class="col-2 form-group">
												<label for="tlfCasa">Teléfono Casa</label>
												<input type="text" id="tlfCasa" name="tlfCasa" class="form-control" required>
											</div>
											<div class="col-2 form-group">
												<label for="movil">Móvil</label>
												<input type="text" id="movil" name="movil" class="form-control" required>
											</div>
											<div class="col-6 form-group">
												<label for="correoPersonal">Correo electrónico</label>
												<input type="email" id="correoPersonal" name="correoPersonal" class="form-control" required>
											</div>
											<div class="col-2 form-group">
												<label for="tipoSangre">Tipo Sangre</label>
												<input type="text" id="tipoSangre" name="tipoSangre" class="form-control" required>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="contactoEmergencia">Contacto de Emergencia</label>
												<input type="text" id="contactoEmergencia" name="contactoEmergencia" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="imss">IMSS</label>
												<input type="text" id="imss" name="imss" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success">Registrar</button>
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
						<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuario">
							<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="modalEditarLabel">Editar Usuario</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="row ">
											<div class="col form-group">
												<h3>Datos Hemusa</h3>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="nombre">Nombre <font color="#FF4136">*</font></label>
												<input type="text" id="nombre" name="nombre" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="apellido">Apellido <font color="#FF4136">*</font></label>
												<input type="text" id="apellido" name="apellido" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="correoHemusa">Correo electrónico <font color="#FF4136">*</font></label>
												<input type="text" id="correoHemusa" name="correoHemusa" class="form-control" required>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="usuario">Usuario <font color="#FF4136">*</font></label>
												<input type="text" id="usuario" name="usuario" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="pass">Contraseña <font color="#FF4136">*</font></label>
												<input type="text" id="pass" name="pass" class="form-control" required>
											</div>
											<div class="col form-group">
												<label for="departamento">Departamento <font color="#FF4136">*</font></label>
												<input type="text" id="departamento" name="departamento" class="form-control" required>
											</div>
										</div>
										<hr>
										<div class="row ">
											<div class="col form-group">
												<h3>Datos Personales</h3>
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="direccion">Dirección</label>
												<input type="text" id="direccion" name="direccion" class="form-control" placeholder="Opcional">
											</div>
										</div>
										<div class="row">
											<div class="col-2 form-group">
												<label for="tlfCasa">Teléfono Casa</label>
												<input type="text" id="tlfCasa" name="tlfCasa" class="form-control" placeholder="Opcional">
											</div>
											<div class="col-2 form-group">
												<label for="movil">Móvil</label>
												<input type="text" id="movil" name="movil" class="form-control" placeholder="Opcional">
											</div>
											<div class="col-6 form-group">
												<label for="correoPersonal">Correo electrónico</label>
												<input type="text" id="correoPersonal" name="correoPersonal" class="form-control" placeholder="Opcional">
											</div>
											<div class="col-2 form-group">
												<label for="tipoSangre">Tipo Sangre</label>
												<input type="text" id="tipoSangre" name="tipoSangre" class="form-control" placeholder="Opcional">
											</div>
										</div>
										<div class="row">
											<div class="col form-group">
												<label for="contactoEmergencia">Contacto de Emergencia</label>
												<input type="text" id="contactoEmergencia" name="contactoEmergencia" class="form-control" placeholder="Opcional">
											</div>
											<div class="col form-group">
												<label for="imss">IMSS</label>
												<input type="text" id="imss" name="imss" class="form-control" placeholder="Opcional">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-primary">Editar</button>
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
						<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<label for="usuario">¿Está seguro de eliminar al usuario?</label>
										<input type="text" class="disabled form-control" id="usuario" name="usuario" disabled>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-danger">Eliminar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal -->
					</form>

    	</main>
    <div>
</body>
</html>
<script>
	$(document).on("ready", function(){
		var idusuario = "<?php echo $idusuario; ?>";
		var opcion = "datosusuario";
		listar(); // Función para listar la tabla de usuarios
		guardar(); // Función para registrar, modificar y eliminar
		// $.ajax({ // Se obtienen los datos del usuario en sesion
		// 	method: "POST",
		// 	url: "buscar.php",
		// 	dataType: "json",
		// 	data: {"opcion": opcion, "idusuario": idusuario},
		// 	success: function ( data ){
		// 		console.log(data);
		// 		$("form #usuariologin").val(data.datosusuario.nombre + " " + data.datosusuario.apellidos);
		// 		$("form #dplogin").val(data.datosusuario.dp);
		// 	}
		// });

	});

	var  listar = function(data){ // DataTable de Usuarios
		$('#dt_usuarios tfoot th').each( function () {
    		var title = $(this).text();
    		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
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
				{"defaultContent": "<button data-toggle='modal' data-target='#modalEditarUsuario' class='editar btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>", "sortable": false},
				{"defaultContent": "<button data-toggle='modal' data-target='#modalEliminarUsuario' class='eliminar btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></button>", "sortable": false}
			],
			"order":[[0, "asc"]],
			"language": idioma_espanol,
			"dom":
				"<'container row col-10 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
				"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
				"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
			"buttons":[
	            {
	                extend:    'pdfHtml5',
	                text:      '<i class="fa fa-file-pdf-o"></i>',
	                titleAttr: 'Generar PDF',
	                exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	                "className": "btn iconopdf"
	            },
				{
	                extend:    'excelHtml5',
	                text:      '<i class="fa fa-file-excel-o"></i>',
	                titleAttr: 'Generar Excel',
	                exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	                "className": "btn iconoexcel"
	            },
	            {
	            	extend: 'csvHtml5',
	            	text: '<i class="fa fa-file-text-o"></i>',
	            	titleAttr: 'Generar CSV',
	            	exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	            	"className": "btn iconocsv"
	            },
	            {
	            	extend: 'print',
	            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
	            	titleAttr: 'Imprimir',
	            	header: 'false',
	            	exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
        			orientation: 'landscape',
        			pageSize: 'LEGAL',
        			"className": "btn iconoimprimir",
        			title: 'Usuarios HEMUSA'
	            },
	            {
	            	text: '<i class="fa fa-user-plus" aria-hidden="true"></i>',
	            	"className": "btn btn-success",
	            	titleAttr: 'Agregar Usuario',
	            	action: function (e, dt, node, config){
    					$('#modalRegistrarUsuario').modal('show');
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
