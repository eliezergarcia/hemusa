<?php 
  require_once('../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);  
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio</title>
  <?php include('../enlaces.php'); ?>
</head>
<body>	
  <?php include('../header.php'); ?> 
  	<!-- Mensaje actualizaciones-->
  		<br>		
		<div>
			<center><h6 class="mensaje"></h6></center>
		</div>
		<!-- <br> -->
	
	<!-- Calendario -->
	  	<div class="row justify-content-center">
		  	<div id="calendar" class="col-10 calendar">
		  		
			  <br><br>
		  	</div>
	  	</div>

	<!-- Modal Crear Evento -->
		<form id="frmnotificacion" action="#" method="POST">
			<input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario.' '.$usuarioApellido; ?>">
		  	<div class="modal fade" id="modalCrearEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
				    <div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i> Crear evento - Dia <label for="" id="dia"></label></h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
				      	<div class="modal-body">
					      	<div class="row">
					      		<div class="form-group col">      			
					      			<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Agregar un titulo">
					      		</div>
					      	</div>
					      	<div class="row justify-content-center align-items-center">
					      		<div class="form-group col-6">      			
					      			<input type="datetime-local" id="fechainicio" name="fechainicio" class="form-control">
					      		</div>
					      		<div class="form-group col-1 row justify-content-center align-items-center">      			
					      			<label for="">al</label>
					      		</div>
					      		<div class="form-group col-5">      			
					      			<input type="date" id="fechafin" name="fechafin" class="form-control">
					      		</div>
					      	</div>
					      	<br>
					      	<div class="">
								<nav>
								  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
								   		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detalles del evento</a>
								    	<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Asignar a </a>
								  	</div>
								</nav>
								<div class="tab-content" id="nav-tabContent">
								  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
								  		<br>
								  		<div class="form-group">
								  			<textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control" placeholder="Descripción"></textarea>
								  		</div>
								  		<div class="form-group row align-items-center">
								  			<input type="checkbox" id="agregarnotificacion" name="agregarnotificacion" class="form-control btn-outline-primary col-1" onclick="agregarnotificacion()">
								  			<p for="" class="card-subtitle mb-2 text-muted">Agregar notificación</p>
							  			</div>
							  			<hr>
							  			<div class="form-group row align-items-center">
								  			<input type="number" id="diasnotificacion" name="diasnotificacion" class="form-control col-2" min="0" max="2" value="0" disabled>
								  			<p for="" class="col-4">días antes, a la(s)</p>
								  			<input type="time" id="horanotificacion" name="horanotificacion" class="form-control col-3" value="09:00:00" max="19:00:00" min="09:00:00" step="1" disabled>
								  		</div>
								  	</div>
								  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
								  		<br>
								  		<div class="row justify-content-center">
									  		<div class="form-group col">
									  			<label for="">Por</label>
									  			<select name="tipo" id="tipo" class="form-control" onchange="buscartipo()">
									  				<option value="ninguno">Seleccionar...</option>
									  				<option value="departamento">Departamento</option>
									  				<option value="usuario">Usuario</option>
									  			</select>
									  		</div>
									  		<div class="form-group col">
									  			<label for="">Asignar</label>
									  			<select name="asignado" id="asignado" class="form-control">
									  			
									  			</select>
									  		</div>
								  		</div>
								  	</div>
								</div>
						  	</div>
					      	<div class="modal-footer">
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        	<button id="guardar-notificacion" type="button" class="btn btn-primary">Guardar</button>
					      	</div>
				    	</div>
				  	</div>
				</div>
			</div>
		</form>

	<!-- Modal Mostrar Evento -->
		<form id="frmMostrarEvento" action="#" method="POST">
			<input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario.' '.$usuarioApellido; ?>">
		  	<div class="modal fade" id="modalMostrarEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
				    <div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i> Evento</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
				      	<div class="modal-body">
				      		<fieldset disabled>
						      	<div class="row">
						      		<div class="form-group col"> 
						      			<label for="titulo">Titulo</label>     			
						      			<input type="text" id="titulo" name="titulo" class="form-control">
						      		</div>
						      	</div>
						      	<div class="row justify-content-center align-items-center">
						      		<div class="form-group col-6"> 
						      			<label for="fechainicio">Fecha de inicio</label>     			     			
						      			<input type="datetime-local" id="fechainicio" name="fechainicio" class="form-control">
						      		</div>
						      		<div class="form-group col-6">  
						      			<label for="fechafin">Fecha de fin</label>     			    			
						      			<input type="date" id="fechafin" name="fechafin" class="form-control">
						      		</div>
						      	</div>
						      	<div class="row justify-content-center align-items-center">
						      		<div class="form-group col"> 
						      			<label for="asignado">Asignado por</label>     			     			
						      			<input type="text" id="asignado" name="asignado" class="form-control">
						      		</div>
						      	</div>
						      	<div class="row justify-content-center align-items-center">
						      		<div class="form-group col"> 
						      			<label for="descripcion">Descripción</label>     			     			
						      			<textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
						      		</div>
						      	</div>
					      	</fieldset>
					      	<div class="modal-footer">
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        	<button id="eliminar-evento" type="button" class="btn btn-danger">Eliminar</button>
					      	</div>
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
			      				<select name="proveedoressinoc" id="proveedoressinoc" class="form-control col-6" onchange="verproveedor()"></select>
			      			</div>
			      		</div>				      		
			    	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			      	</div>
			  	</div>
			</div>
		</div>
	
	<!-- Modal Tipo de Cambio -->
		<form action="#" name="frmTipoCambio">
			<input type="hidden" name="opcion" id="opcion" value="tipocambio">
			<div class="modal fade" id="modalTipoCambio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			  	<div class="modal-dialog" role="document">
				    <div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="exampleModalLabel"></h5>
				      	</div>
				      	<div class="modal-body">
				      		<div class="col-12 row justify-content-center">
				      			<h1>IMPORTANTE!!</h1>
				      			<div class="form-group row justify-content-center col-12">
				      				<label class="control-label">Ingresa el tipo de cambio del dia</label>
				      			</div>
								<?php
									$dia = date("d");
									$mes = date("m");
									$año = date("Y");
									$diario = "http://dof.gob.mx/indicadores_detalle.php?cod_tipo_indicador=158&dfecha=".$dia."%2F".$mes."%2F".$año."&hfecha=".$dia."%2F".$mes."%2F".$año;
								?>
				      			<div class="form-group row justify-content-center col-12">
				      				<h6>Link: <a href="<?php echo $diario; ?>" target="_blank">Diario Oficial</a></h6>
				      			</div>
				      			<div class="form-group row justify-content-center col-4">
				      				<input type="text" class="form-control" name="tipocambio" id="tipocambio">
				      			</div>
				      		</div>				      		
				    	</div>
				      	<div class="modal-footer">
				        	<button type="submit" class="btn btn-primary">Guardar</button>
				      	</div>
				  	</div>
				</div>
			</div>
		</form>
</body>
</html>

<script>
	$(document).ready(function() {			
		buscar_tipo_cambio();
	});

	var buscar_tipo_cambio = function(){
		var usuario = "<?php echo $usuario.' '.$usuarioApellido; ?>";
		var departamento = "<?php echo $departamento_usuario; ?>";	
		var opcion = "tipocambio";
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion},
		}).done( function( info ){
			if (info.respuesta == "BIEN") {
				guardar();
				listar_calendario(usuario, departamento);
				buscar_pendientes();
				buscar_notificaciones();
				guardar_notificacion();
				buscar_oc_pendientes();
				setInterval(buscar_oc_pendientes, 3000);
				setInterval(buscar_pendientes, 60000);
				setInterval(buscar_notificaciones, 60000);
			}else{
				guardar();
				$("#modalTipoCambio").modal("show");
			}
			
		});
	}

	var listar_calendario = function(usuario, departamento){
		$.ajax({
			method: "POST",
			url: "listar_calendario.php",
			dataType: 'json',
			data: {"usuario": usuario, "departamento": departamento},
		}).done( function( data ){
			console.log(data);
			$('#calendar').fullCalendar({
		        // put your options and callbacks here
		        header: {
		        	left: 'prev,next today',
		        	center: 'title',
		        	right: 'month,agendaWeek,agendaDay,listWeek'
		      	},
		      	defaultDate: new Date(),
		      	navLinks: true, // can click day/week names to navigate views
		      	editable: true,
		      	eventLimit: true, // allow "more" link when too many events		      	
		      	events: data,
		      	eventClick: function(calEvent, jsEvent, view){
		      		var id = calEvent.id;
		      		var opcion = "buscarevento";
		      		console.log(id);
		      		console.log(opcion);
		      		$.ajax({
						method: "POST",
						url: "buscar.php",
						dataType: 'json',
						data: {"id": id, "opcion": opcion},
					}).done( function( data ){
						$("#modalMostrarEvento").modal("show");
						$("#frmMostrarEvento #titulo").val(data.data.titulo);
						$("#frmMostrarEvento #fechainicio").val(fechainicio);
						$("#frmMostrarEvento #fechafin").val(fechafin);
						$("#frmMostrarEvento #asignado").val(data.data.asignado);
						$("#frmMostrarEvento #descripcion").val(data.data.descripcion);
					});
		      	},
			    dayClick: function(date, jsEvent, view) {
			    	$("#modalCrearEvento").modal("show");
			    	var dia = date.format("DD/MM/YYYY");
			    	document.getElementById("dia").innerHTML = dia;	
			    	var dia = moment().format('YYYY-MM-DDThh:mm');
			    	console.log(dia);
			    	$("#fechainicio").val(dia);
				},
		    });
		});	
	}

	var buscar_pendientes = function(){
		var usuario = "<?php echo $usuario.' '.$usuarioApellido; ?>";
		var departamento = "<?php echo $departamento_usuario; ?>";
        $.ajax({
			method: "POST",
			url: "buscar_pendientes.php",
			dataType: 'json',
			data: {"usuario": usuario, "departamento": departamento},
		}).done( function( data ){
			console.log(data.respuesta);
			notifpendientes = document.getElementById('notifpendientes');
	        notifpendientes.setAttribute('data-badge', data.respuesta);
		});	
	}

	var guardar_notificacion = function(usuario){
		$("#guardar-notificacion").on("click", function(){
			var frm = $("#frmnotificacion").serialize();
			var usuario = $("#frmnotificacion #usuario").val();
			console.log(frm);
			console.log(usuario);
			if ($("#frmnotificacion #titulo").val() == "") {
				alert("Debes de ingresar un título!");
			}else{
				if ($("#frmnotificacion #descripcion").val() == ""){
					alert("Debes de ingresar una descripción!");
				}else{
					$("#modalCrearEvento").modal("hide");
					$.ajax({
						method: "POST",
						url: "../guardar.php",
						datatype: "json",
						data: frm, "usuario": usuario,
					}).done( function( data ){
						console.log(data);
						var json_info = JSON.parse( data );
						mostrar_mensaje(json_info);
						listar_calendario(usuario);
					});
				}
			}
		});	
	}

	$("#agregarnotificacion").on("click", function(){
		if(document.getElementById("diasnotificacion").disabled == true){
			document.getElementById("diasnotificacion").disabled = false;
			document.getElementById("horanotificacion").disabled = false;
		}else{
			document.getElementById("diasnotificacion").disabled = true;
			document.getElementById("horanotificacion").disabled = true;
		}
	});	

	function buscar_notificaciones(){
		var usuario = "<?php echo $user; ?>";
		var departamento = "<?php echo $departamento_usuario; ?>";
		var hora=new Date();
		hora = hora.getHours()+":"+hora.getMinutes()+":00";
		console.log(hora);
		$.ajax({
			method: "POST",
			url: "buscar_notificaciones.php",
			dataType: 'json',
			data: {"usuario": usuario, "hora": hora, "departamento": departamento},
		}).done( function( data ){
			if (data.respuesta == "BIEN") {
				console.log("Tienes una notificacion");
				console.log(data.data);
			}else{
				console.log("No hay notificaciones pendientes");
			}
			
		});	
	}

	function buscartipo(){
		var opcion = $("#frmnotificacion #tipo").val();
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: 'json',
			data: {"opcion": opcion},
		}).done( function( data ){
			console.log(data);
			$('#asignado').empty();
			var asignado = document.getElementById("asignado");
			for(var i=0;i<data.length;i++){ 
       	 		$("#asignado").append("<option>" + data[i] + "</option>");
			};
		});
	}

	var guardar = function(){
		$("form").on("submit", function(e){
			e.preventDefault();
			$('.modal').modal('hide');
			var frm = $(this).serialize();
			console.log(frm);
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: frm,
			}).done( function( info ){
				console.log(info)
				if (info.tipo == "tipocambio") {
					if (info.respuesta == "BIEN") {
						buscar_tipo_cambio();					
						texto = "<div class='alert alert-success'><strong>Bien!</strong> Se registro el tipo de cambio del dia correctamente.</div>"			

						$(".mensaje").html( texto );
						$(".mensaje").fadeOut(5000, function(){
							$(this).html("");
							$(this).fadeIn(5000);
						});
					}else{
						texto = "<div class='alert alert-warning'><strong>Error</strong>, no se ejecutó la consulta.</div>";					

						$(".mensaje").html( texto );
						$(".mensaje").fadeOut(5000, function(){
							$(this).html("");
							$(this).fadeIn(5000);
						});
					}
				}else{
					mostrar_mensaje(info);
				}
			});
		});
	}

	var mostrar_mensaje = function( informacion ){
		var texto = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<div class='alert alert-success'><strong>Bien!</strong> Se ha creado el evento correctamente.</div>";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<div class='alert alert-warning'><strong>Error</strong>, no se ejecutó la consulta.</div>";		
		}

		$(".mensaje").html( texto );
		$(".mensaje").fadeOut(5000, function(){
			$(this).html("");
			$(this).fadeIn(5000);
		}); 
	}


</script>
<script src="<?php echo $ruta; ?>/php/js/notificaciones.js"></script>


