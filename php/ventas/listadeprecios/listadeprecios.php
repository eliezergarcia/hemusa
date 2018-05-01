<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Lista de precios</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	
	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Lista de precios</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
	                    <li class="breadcrumb-item"><a href="#">Herramientas</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                          		<!-- Form buscar en Lista de precios -->
									<div>
								        <h4>Buscar herramienta en lista</h4>								        	
								      	<form action="#" method="POST">
								        	<div class="form-group row">
								          		<label for="palabraBusca" class="col-1 col-form-label">Busca Producto</label>
								          		<div class="col-2">
										          	<input id="palabraBusca" name="palabraBusca" type="text" class="form-control form-control-sm"  autofocus required>
								          		</div>
								        	</div>
										    <div class="form-group row align-items-end">
										    	<label for="marcaBuscar" class="col-1 col-form-label">Marca</label>
										    	<div class="col-2">
											    	<input id="marcaBuscar" class="awesomplete form-control form-control-sm" list="mylist" />
													<datalist id="mylist">
														<?php
												        	include("../../conexion.php");
													        $result = mysqli_query($conexion_usuarios, "SELECT marca FROM marcadeherramientas ORDER BY marca");
															// echo '<select id="marcaBuscar" name="marcaBuscar" class="form-control">';
															while ($row = mysqli_fetch_array($result)) {
																echo '<option value="'.$row['marca'].'">'.$row['marca'].'</option>';
																}
															echo '<option value="todo" selected="selected">Todo</option>';
															echo '</select>';
														?>
													</datalist>
												</div>
											    <input id="btn_listar_precios" type="button" class="btn btn-lg btn-primary" value="Buscar">
										    </div>
										    <!-- <div class="form-group row justify-content-center col-5">
										        <div class="col-2">
										            <input id="btn_listar_precios" type="button" class="btn btn-lg btn-primary" value="Buscar">
										        </div>
										    </div> -->
								      	</form>
								 	</div>
								 	<br>

								<!-- Tabla Lista de precios -->
									<table id="dt_precios" class="table table-bordered table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>								
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>											
												<th>Precio de lista</th>
												<th>Precio con IVA</th>
												<th>Almacen</th>
												<th>Moneda</th>	
												<th>Clase</th>
												<th>IGI</th>
												<th>Ver y Editar</th>
											</tr>
										</thead>
									</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

		<!-- Modal Subir lista de precios -->
			<div class="modal fade" id="subirListaPrecios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			   		<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel">Subir lista de precios</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
				      	<div class="modal-body">
				        	<div>
								<form action="subirlista.php" class="row justify-content-start" enctype="multipart/form-data" method="post">
	 								<div class="col-12 row justify-content-start align-items-center form-group">
						  	 			<label class="row col-3">Subir archivo: </label>
						  	 			<input id="archivo" name="archivo" accept=".csv" type="file" class="form-control row col-9 justify-content-center">
						  	 			<!-- <input name="MAX_FILE_SIZE" type="hidden" value="20000000" />  -->
						  	 		</div>
							</div>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				        	<button type="submit" class="btn btn-primary">Subir</button>
				      	</div>
			  	 				</form>
			    	</div>
			  	</div>
			</div>
		
		<!-- Modal Informacion Herramienta -->
			<form action="" method="POST">
				<div class="modal fade colored-header colored-header-primary" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  		<div class="modal-dialog modal-lg" role="document">
			    		<div class="modal-content">
			      			<div class="modal-header">
			        			<h4 class="modal-title" id="exampleModalLabel"><b><i class="icon icon-left mdi mdi-edit" aria-hidden="true"></i> Informacion de herramienta</b></h4>
			        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          				<span aria-hidden="true">&times;</span>
			        			</button>
			      			</div>
			      			<div class="modal-body row">
		        				<input type="hidden" class="form-control" name="idproducto" id="idproducto">
								<input type="hidden" class="form-control" name="opcion" id="opcion" value="editarproducto">
		        				<div class="form-group col-6">
		        					<label for="">Marca</label>
		        					<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="marca" id="marca">
		        					</fieldset>
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">Modelo</label>
		        					<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="modelo" id="modelo">
		        					</fieldset>
		        				</div>
								<div class="form-group col-6">
		        					<label for="">Costo</label>
									<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="costo" id="costo">
									</fieldset>
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">IGI</label>
		        					<input type="text" class="form-control form-control-sm" name="igi" id="igi">
		        				</div>
		        				<div class="form-group col">
		        					<label for="">Descripción</label>
		        					<input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion">
		        				</div>
			      			</div>
			      			<div class="modal-footer">
			        			<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        			<button type="submit" class="btn btn-lg btn-primary">Editar</button>
			        			</form>
			      			</div>
			    		</div>
			  		</div>
				</div>
			</form>
				
	<header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
      		App.pageCalendar();       
      		App.formElements();
      		App.uiNotifications();
			guardar();
		});

		$("#btn_listar_precios").on("click", function(){
			listar();
		});

		$("#btn_agregar_herramienta").on("click", function(){
			listar();
		});

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$(".modal").modal("hide");
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					limpiar_datos();
					listar();
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecut� la consulta.</div>";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<strong>Informaci�n!</strong> el usuario ya existe.";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<strong>Advertencia!</strong> la opci�n no existe o esta vac�a, recargar la p�gina. ";
				color = "#DDB11D";
			}

			// $(".mensaje").alert();
			$(".mensaje").html( texto );
			$(".mensaje").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(5000);
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

		var listar = function(){
			var palabraBusca = $("#palabraBusca").val(),
				marcaBuscar = $("#marcaBuscar").val();

			if (marcaBuscar == "") {
				marcaBuscar = "todo";
			}
			console.log(palabraBusca);
			console.log(marcaBuscar);
			var table = $("#dt_precios").DataTable({
				"destroy":"true",
				"bDeferRender": true,
				"scrollX": true,
				"sPaginationType": "full_numbers",
				"ajax":{
					"method":"POST",
					"url":"listar_precios.php",
					"data": {
						"palabraBusca": palabraBusca, 
						"marcaBuscar": marcaBuscar
					}
				},
				"columns":[
					{"data":"marca"},
					{"data":"modelo"},
					{"data":"descripcion"},
					{"data":"precioLista"},
					{"data":"precioIVA"},
					{"data":"almacen"},
					{"data":"moneda"},
					{"data":"clase"},
					{"data":"igi"},
					{"defaultContent": "<button class='editar btn btn-lg btn-primary' data-toggle='modal' data-target='#modalInformacion'><i class='icon icon-left mdi mdi-edit' aria-hidden='true'></i></button>"}
				],
        		"lengthChange": false,
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
		            "className": "btn btn-danger btn-big"
		          },
		          {
		            extend:    'excelHtml5',
		            text:      '<i class="icon icon-left mdi mdi-file" style="color:white"></i>',
		            titleAttr: 'Generar Excel',
		            "className": "btn btn-success btn-big"
		          },
		          {
		            extend: 'csv',
		            text: '<i class="icon icon-left mdi mdi-file-text" style="color:white"></i>',
		            titleAttr: 'Generar CSV',
		            "className": "btn btn-primary btn-big"
		          },
		          {
		            extend: 'print',
		            text: '<i class="icon icon-left mdi mdi-print" style="color:white"></i>',
		            titleAttr: 'Imprimir',
		            header: 'false',
		            "className": "btn btn-warning btn-big",
		            orientation: 'landscape',
		            pageSize: 'LEGAL'
		          },
				]
			});

			obtener_data_herramienta("#dt_precios tbody", table);
		}

		var obtener_data_herramienta = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
					console.log(data);
				var idproducto = $("#idproducto").val(data.idproducto),
					marca = $("#marca").val(data.marca),
					modelo = $("#modelo").val(data.modelo),
					descripcion = $("#descripcion").val(data.descripcion),
					costo = $("#costo").val(data.costo),
					igi = $("#igi").val(data.igi);
			});
		}

		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
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
</body>
</html>
