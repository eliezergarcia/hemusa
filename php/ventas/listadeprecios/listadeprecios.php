<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Lista de precios</title>
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
					    	<li class="breadcrumb-item active" aria-current="page">Lista de precios</li>
					  	</ol>
					</nav>
				
				<!-- Titulo -->
	    			<div class="row fondo align-itmes-center">
						<div class="col-sm-12">
							<h1 class="text-center titulo"><b>Lista de precios</b>
						</div>
					</div>	
					<br>
				
				<!-- Mensaje actualizaciones-->
					<br>
					<div>
						<center><h6 class="mensaje"></h6></center>
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
				
				<!-- Form buscar en Lista de precios -->
					<div class="container row justify-content-center">
					    <div id="cuadro3" class="">
					      	<form class="form-horizontal" id="" action="" method="POST">
					        	<div class="form-group">
					          		<center><h4 class="">Buscar en Lista</h4></center>
					        	</div>
					        	<div class="form-group row justify-content-center">
					          		<label for="palabraBusca" class="col-4 control-label">Busca Producto</label>
					          		<div class="col-8">
							          	<input id="palabraBusca" name="palabraBusca" type="text" class="form-control"  autofocus required>
					          		</div>
					        	</div>
						        <!-- <div class="form-group row justify-content-center">
							        <label for="marcaBuscar" class="col-4 control-label">Marca</label>
							        <div class="col-8">
							        <?php
							        	include("../../conexion.php");
								        $result = mysqli_query($conexion_usuarios, "SELECT marca FROM marcadeherramientas ORDER BY marca");
										echo '<select id="marcaBuscar" name="marcaBuscar" class="form-control">';
										while ($row = mysqli_fetch_array($result)) {
											echo '<option value="'.$row['marca'].'">'.$row['marca'].'</option>';
											}
										echo '<option value="todo" selected="selected">Todo</option>';
										echo '</select>';
									?>
									</div>
							    </div>  --> 
							    <div class="form-group row justify-content-center">
							    	<label for="marcaBuscar" class="col-4 control-label">Marca</label>
							    	<div class="col-8">
								    	<input id="marcaBuscar" class="awesomplete form-control" list="mylist" />
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
							    </div> 
						        <div class="form-group row justify-content-center">
						         	<div class="col row justify-content-center">
							    		<br>
						            	<input id="btn_listar_precios" type="button" class="btn btn-primary btnBuscar" value="Buscar">
						          	</div>
						        </div>
					      	</form>
					    </div>
				 	</div>

				<!-- Tabla Lista de precios -->
					<div class="container-fluid col row justify-content-center">
						<div id="cuadro1" class="">
							<div class="">		
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

					<!-- <div>
						<form id="frmEliminarUsuario" action="" method="POST">
							<input type="hidden" id="idusuario" name="idusuario" value="">
							<input type="hidden" id="opcion" name="opcion" value="eliminar">
							Modal
							<div class="modal fade" id="modalAgregarIGI" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="modalEliminarLabel">Agregar IGI</h4>
										</div>
										<div class="modal-body">							
											<input type="text" class="form-control">
										</div>
										<div class="modal-footer">
											<button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div> -->
			
				<!-- Modal Informacion -->
					<div class="modal fade" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  		<div class="modal-dialog" role="document">
				    		<div class="modal-content">
				      			<div class="modal-header">
				        			<h5 class="modal-title" id="exampleModalLabel">Informacion herramienta</h5>
				        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          				<span aria-hidden="true">&times;</span>
				        			</button>
				      			</div>
				      			<div class="modal-body">
				        			<form action="" method="POST">
				        				<div class="form-group">
				        				<input type="hidden" class="form-control" name="idproducto" id="idproducto">
										<input type="hidden" class="form-control" name="opcion" id="opcion" value="editarproducto">
				        				<div class="form-group">
				        					<label for="">Marca</label>
				        					<fieldset disabled>
				        						<input type="text" class="form-control" name="marca" id="marca">
				        					</fieldset>
				        				</div>
				        				<div class="form-group">
				        					<label for="">Modelo</label>
				        					<fieldset disabled>
				        						<input type="text" class="form-control" name="modelo" id="modelo">
				        					</fieldset>
				        				</div>
										<div class="form-group">
				        					<label for="">Costo</label>
											<fieldset disabled>
				        						<input type="text" class="form-control" name="costo" id="costo">
											</fieldset>
				        				</div>
				        				<div class="form-group">
				        					<label for="">Descripción</label>
				        					<input type="text" class="form-control" name="descripcion" id="descripcion">
				        				</div>
				        				<div class="form-group">
				        					<label for="">IGI</label>
				        					<input type="text" class="form-control" name="igi" id="igi">
				        				</div>
				      			</div>
				      			<div class="modal-footer">
				        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				        			<button type="submit" class="btn btn-success">Guardar</button>
				        			</form>
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
			// $("#cuadro2").slideUp("slow");
			// $("#cuadro1").slideDown("slow");
			guardar();
			// eliminar();
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
					{"defaultContent": "<button class='editar btn btn-primary access' data-toggle='modal' data-target='#modalInformacion'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
        		"lengthChange": false,
				"language": idioma_espanol,
				"dom": 
					"<'container row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'container row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf"
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel"
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv"
		            }
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
