<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  // error_reporting(0);
  // echo "<embed loop='false' src='../../../assets/whatsapp-apple.mp3' hidden='true' autoplay='true'>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  	<title>Inicio</title>
  	<?php include('../../enlacescss.php'); ?>
</head>
<body id="body-menu" class="">
  	<?php include('../../header.php'); ?>
	  	<div class="be-content">
	        <!-- <div class="page-head">
	          	<h2 class="page-head-title">Calendario</h2>
	          	<nav aria-label="breadcrumb" role="navigation">
		            <ol class="breadcrumb page-head-nav">
		              	<li class="breadcrumb-item"><a href="#">Inicio</a></li>
		              	<li class="breadcrumb-item"><a href="#">Calendario</a></li>
		            </ol>
	          	</nav>
	        </div> -->
	        <!-- <div class="col-2">
		        <select id="menu" name="menu" class="form-control form-control-sm select2">
		        	<option value="1">Barra completa</option>
		        	<option value="2">Barra lateral plegable</option>
		        	<option value="3">Barra oculta</option>
		        </select>
	        </div> -->
	        <div class="main-content container-fluid">
	          	<div class="row full-calendar">
	            	<div class="col-lg-12">
	              		<div class="card card-fullcalendar">
	                		<div class="card-body">
	                  			<div id="calendar"></div>
	                		</div>
	              		</div>
	          		</div>
	        	</div>
			</div>
		</div>


		<!-- Modal Evento Calendario -->
	    	<div id="modalEvento" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
		      	<div class="modal-dialog">
		        	<div class="modal-content">
		          		<div class="modal-header modal-header-colored">
		            		<h3 class="modal-title">Calendario - Evento</h3>
		            		<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close">       </span></button>
		          		</div>
			          	<div class="modal-body">
			              	<label><h4><b>Titulo</b></h4></label>
			            	<div class="form-group">
			              		<input type="titulo" class="form-control form-control-sm">
			            	</div>
			                <label><h4><b>Fecha</b></h4></label>
			            	<div class="row no-margin-y">
			              		<div class="col-6 col-sm-7 col-md-5 col-lg-4 col-xl-6">
			                        <div data-min-view="2" data-date-format="dd-mm-yyyy" class="input-group date datetimepicker">
			                          	<input size="16" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control form-control-sm">
			                          	<div class="input-group-append">
			                            	<button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
			                          	</div>
			                        </div>
			                    </div>
			              		<div class="col-6 col-sm-7 col-md-5 col-lg-4 col-xl-6">
			                        <div data-min-view="2" data-date-format="dd-mm-yyyy" class="input-group date datetimepicker">
			                          	<input size="16" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control form-control-sm">
			                          	<div class="input-group-append">
			                            	<button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
			                          	</div>
			                        </div>
			                    </div>
			            	</div>
			            	<div class="form-group row">
			                	<div class="col-12 col-sm-7 col-md-5 col-lg-4 col-xl-6">
			                    	<div data-start-view="0" data-date="" data-date-format="HH:ii" data-link-field="dtp_input1" class="input-group date datetimepicker">
			                      		<input size="16" type="text" value="00:00" readonly="" class="form-control form-control-sm">
			                      		<div class="input-group-append">
			                        		<button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
			                      		</div>
			                    	</div>
			                  	</div>
			                  	<div class="col-12 col-sm-7 col-md-5 col-lg-4 col-xl-6">
			                    	<div data-start-view="0" data-date="" data-date-format="HH:ii" data-link-field="dtp_input1" class="input-group date datetimepicker">
			                      		<input size="16" type="text" value="00:00" readonly="" class="form-control form-control-sm">
			                      		<div class="input-group-append">
			                        		<button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
			                      		</div>
			                    	</div>
			                  	</div>
			                </div>
			                <div class="row">
			              		<div class="form-group col-md-12">
			                		<label class="custom-control custom-checkbox custom-control-inline">
	                          			<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label custom-control-color">Todo el día</span>
	                        		</label>
			              		</div>
			            	</div>
			                <label><h4><b>Repetir</b></h4></label>
			                <div class="form-group row">
			                    <div class="col-12 col-sm-12 col-lg-12">
			                        <select class="form-control form-control-sm select2">
			                            <option value="AK">No repetir</option>
			                            <option value="HI">Diariamente</option>
			                            <option value="HI">De Lunes a Viernes</option>
			                            <option value="HI">Semanalmente</option>
			                            <option value="HI">Mensualmente</option>
			                            <option value="HI">Anualmente</option>
			                        </select>
			                    </div>
			                </div>
			                <label><h4><b>Recordatorio</b></h4></label>
			                <div class="form-group row">
			                    <div class="col-12 col-sm-8 col-lg-12">
			                        <select class="form-control form-control-sm select2">
			                        	<option value="">Añadir recordatorio..</option>
			                            <option value="AK">5 minutos</option>
			                            <option value="HI">10 minutos</option>
			                            <option value="HI">15 minutos</option>
			                            <option value="HI">30 minutos</option>
			                            <option value="HI">1 hora</option>
			                            <option value="HI">1 día</option>
			                            <option value="HI">2 días</option>
			                            <option value="HI">3 días</option>
			                            <option value="HI">1 semana</option>
			                        </select>
			                    </div>
			                </div>
	                      	<label for="inputTextarea3"><h4><b>Notas</b></h4></label>
			                <div class="form-group row">
	                      		<div class="col-12 col-sm-8 col-lg-12">
	                        		<textarea id="inputTextarea3" class="form-control"></textarea>
	                      		</div>
	                    	</div>
			          	</div>
			          	<div class="modal-footer">
			            	<button type="button" data-dismiss="modal" class="btn btn-secondary btn-lg md-close">Cancelar</button>
			            	<button type="button" class="btn btn-primary btn-lg md-close">Guardar</button>
			          	</div>
		        	</div>
	      		</div>
	    	</div>

		<!-- Modal Tipo de Cambiio -->
			<div id="modalTipoCambio" class="modal fade" data-backdrop="static" data-keyboard="false">
	      		<div class="modal-dialog">
			        <div class="modal-content">
                  <div class="modal-header">
                  </div>
			          	<div class="modal-body">
			            	<div class="text-center">
                      <div class="text-warning"><span class="modal-main-icon mdi mdi-alert-triangle"></span></div>
				              		<h2><b>Aviso!</b></h2>
				              		<h4>No se ha ingresado el tipo de cambio del día.<br>Puedes ingresar al siguiente enlace para obtenerlo:
				              			<?php
                              $dias = array("Monday", "Tuesday", "Wednesdey", "Thursday", "Friday", "Saturday", "Sunday");
        											$dia = date("d");                              
        											$mes = date("m");
        											$año = date("Y");
        											$diario = "http://dof.gob.mx/indicadores_detalle.php?cod_tipo_indicador=158&dfecha=".$dia."%2F".$mes."%2F".$año."&hfecha=".$dia."%2F".$mes."%2F".$año;
        										?>
				              			<a href="<?php echo $diario; ?>" target="_blank" style="color: var(--color-warning); text-decoration: underline;">'Diario Oficial'</a>
				              		</h4>
				              		<br>
                          <form action="#" method="POST">
				              		<div class="row justify-content-center">
				              			<input id="opcion" name="opcion" type="hidden" value="tipocambio">
				              			<input id="tipocambio" name="tipocambio" type="text" class="form-control form-control-sm col-lg-3" required>
				              		</div>
				              		<div class="mt-8">
				                		<button type="submit" class="btn btn-space btn-warning btn-lg">Guardar</button>
                            </form>
				              		</div>
			            	</div>
			          	</div>
			        <div class="modal-footer"></div>
			        </div>
	      		</div>
	    	</div>
	</header>
	<?php include('../../enlacesjs.php'); ?>
  <script src="https://www.gstatic.com/firebasejs/5.0.1/firebase.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
      App.pageCalendar();
      App.formElements();
      App.uiNotifications();
      App.init();
			buscar_tipo_cambio();
			listar_calendario();
		});

    var config = {
      apiKey: "AIzaSyDe92NNoooohCjs30aiW3INmdBtZChCDls ",
      authDomain: "hemusa-194306.firebaseapp.com",
      databaseURL: "https://hemusa-194306.firebaseio.com",
    };

    firebase.initializeApp(config);
    const preObject = document.getElementById('object')
    const dbRefObject = firebase.database().ref().child('object')
    dbRefObject.on('value', snap => console.log(snap.val()))


		// $("#menu").on("change", function(){
		// 	if ($("#menu").val() == 1){
		// 		$("#header-menu").removeClass("be-offcanvas-menu");
		// 		$("#header-menu").addClass("be-fixed-sidebar");

		// 		$("#nav-menu").removeClass("navbar-default");
		// 		$("#nav-menu").addClass("");
		// 	}else if($("#menu").val() == 2){
		// 		// $("#header-menu").removeClass("");
		// 		// $("#header-menu").addClass("be-wrapper be-collapsible-sidebar be-collapsible-sidebar-collapsed be-color-header");

		// 		// $("#nav-menu").removeClass("");
		// 		// $("#nav-menu").addClass("navbar navbar-expand fixed-top be-top-header");
		// 	}else if ($("#menu").val() == 3){
		// 		$("#header-menu").removeClass("be-fixed-sidebar");
		// 		$("#header-menu").addClass("be-offcanvas-menu");

		// 		$("#nav-menu").removeClass("");
		// 		$("#nav-menu").addClass("navbar-default");
		// 	}
		// });


		var buscar_tipo_cambio = function(){
			var opcion = "tipocambio";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
			}).done( function( info ){
				console.log(info);
				if (info.respuesta == "BIEN") {
					guardar();
					listar_calendario(usuario, departamento);
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
				    	// $("#modalCrearEvento").modal("show");
				    	// var dia = date.format("DD/MM/YYYY");
				    	// document.getElementById("dia").innerHTML = dia;
				    	// var dia = moment().format('YYYY-MM-DDThh:mm');
				    	// console.log(dia);
				    	// $("#fechainicio").val(dia);
				    	$('[data-toggle="popover"]').popover();
				    	console.log("hola");
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
					mostrar_mensaje(info);
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			if( informacion.respuesta == "BIEN" ){
				$.gritter.add({
		        	title: 'Correcto!',
		        	text: 'El tipo de cambio de hoy se registro correctamente.',
		        	class_name: 'color success'
		      	});
			}else if( informacion.respuesta == "ERROR"){
				$.gritter.add({
		        title: 'Error',
		        text: 'This is a simple Gritter Notification.',
		        class_name: 'color danger'
		      });
			}

			$(".mensaje").html( texto );
			$(".mensaje").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(5000);
			});
		}
	</script>
</body>
</html>
