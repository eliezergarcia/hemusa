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
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Lista de precios</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
	                    <li class="breadcrumb-item"><a href="#">Lista de precios</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
														<div class="row table-filters-container">
						                  <div class="col-12">
						                    <div class="row">
						                      <div class="col-4 table-filters pb-0 pb-xl-4"><span class="table-filter-title">Herramienta</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row align-items-end">
						                              <div class="col-6">
																						<label class="control-label">Palabra:</label>
																						<input id="palabraBusca" name="palabraBusca" type="text" class="form-control form-control-sm"  autofocus required>
						                              </div>
						                              <div class="col-4">
																						<label class="control-label">Marca:</label>
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
																					<div class="col-2">
																						<button id="btn_listar_precios" class="btn btn-lg btn-primary"><i class="fas fa-search fa-sm"></i> Buscar</button>
																					</div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
						                    </div>
						                  </div>
														</div>
                          		<!-- Form buscar en Lista de precios -->
                          			<br>
															<!-- <div>
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
																	<div class="invoice-footer">
																    	<button id="btn_listar_precios" class="btn btn-lg btn-primary"><i class="fas fa-search fa-sm"></i> Buscar</button>
																		</form>
																	</div>
										    				</div>
							 								</div> -->
								 							<br>

								<!-- Tabla Lista de precios -->
									<table id="dt_precios" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>
												<th>Precio lista</th>
												<th>Precio IVA</th>
												<th>Almacen</th>
												<th>Moneda</th>
												<th>Clase</th>
												<th>IGI</th>
												<th>Estándar</th>
												<th>Unidad</th>
												<th>Clave SAT</th>
												<th>Pág. Catálogo</th>
												<th>Sec. Catálogo</th>
												<th>IVA</th>
												<th>Mes Promoción</th>
												<th>Desc.</th>
												<th>Editar</th>
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
			<div class="modal fade colored-header colored-header-success" id="modalSubirListaPrecios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		   		<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Subir lista de precios</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
			      <div class="modal-body">
			        <div class="row justify-content-center">
								<!-- <form action="subirlista.phps" enctype="multipart/form-data" method="post"> -->
									<div class="row justify-content-center">
										<!-- <div class="col-12">
											<label>Para poder subir la lista de precios, verifique lo siguiente: </label>
										</div>
										<h4>- Extensión del archivo ".csv" </h4>
										<h4>- La fila #1 deberá ser los encabezados de cada fila </h4>
										<h4>- Cada encabezado deberá tener solo una linea de texto </h4> -->
										<!-- <label>Para poder subir la lista de precios, verifique que cumpla con lo siguiente: </label> -->
									</div>
									<div class="row justify-content-center">
										<label>Subir archivo: </label>
									</div>
									<div class="row justify-content-center">
										<input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
									</div>
				  	 			<!-- <input name="MAX_FILE_SIZE" type="hidden" value="20000000" />  -->
								</div>
			      	</div>
			      	<div class="modal-footer invoice-footer">
			        	<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        	<button type="submit" class="btn btn-lg btn-success">Agregar</button>
			      	</div>
		  	 				<!-- </form> -->
		    		</div>
		  		</div>
				</div>

		<!-- Modal Informacion Herramienta -->
			<form action="" method="POST">
				<div class="modal fade colored-header colored-header-primary" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  		<div class="modal-dialog modal-lg" role="document">
			    		<div class="modal-content">
			      			<div class="modal-header">
			        			<h4 class="modal-title" id="exampleModalLabel"><i class="icon fas fa-edit" aria-hidden="true"></i> Información de herramienta</h4>
			        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          				<span aria-hidden="true">&times;</span>
			        			</button>
			      			</div>
			      			<div class="modal-body row">
		        				<input type="hidden" class="form-control" name="idproducto" id="idproducto">
								<input type="hidden" class="form-control" name="opcion" id="opcion" value="editarproducto">
		        				<div class="form-group col-6">
		        					<label for="">Marca <font color="#FF4136">*</font></label>
		        					<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="marca" id="marca" required="">
		        					</fieldset>
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">Modelo <font color="#FF4136">*</font></label>
		        					<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="modelo" id="modelo" required="">
		        					</fieldset>
		        				</div>
								<div class="form-group col-6">
		        					<label for="">Costo <font color="#FF4136">*</font></label>
									<fieldset disabled>
		        						<input type="text" class="form-control form-control-sm" name="costo" id="costo" required="">
									</fieldset>
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">IGI <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="igi" id="igi" required="">
		        				</div>
		        				<div class="form-group col">
		        					<label for="">Descripción <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" required="">
		        				</div>
			      			</div>
			      			<div class="modal-footer invoice-footer">
			        			<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        			<button type="submit" class="btn btn-lg btn-primary">Guardar</button>
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
			$("#csv-file").change(handleFileSelect);
		});

		var data;

		function handleFileSelect(evt) {
			var file = evt.target.files[0];

			Papa.parse(file, {
				header: true,
				delimiter:":",
				dynamicTyping: true,
				complete: function(results) {
					data = results;
					console.log(data);
				}
			});
		}

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
					$('#dt_precios').DataTable().ajax.reload();
				});
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
			var table = $("#dt_precios").DataTable({
				"destroy": true,
				"DeferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
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
					{"data":"estandar"},
					{"data":"unidad"},
					{"data":"clavesat"},
					{"data":"pagcatalogo"},
					{"data":"seccatalogo"},
					{"data":"iva"},
					{"data":"mespromocion"},
					{"data":"descuento"},
					{"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-lg btn-primary' data-toggle='modal' data-target='#modalInformacion'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
				],
				"columnDefs": [
					{ "width": "8%", "targets": 0 },
					{ "width": "8%", "targets": 1 },
					{ "width": "8%", "targets": 3 },
					{ "width": "8%", "targets": 4 },
					{ "width": "5%", "targets": 5 },
					{ "width": "5%", "targets": 6 },
					{ "width": "5%", "targets": 7 },
					{ "width": "5%", "targets": 8 },
					{ "width": "6%", "targets": 9 },
					{ "width": "6%", "targets": 10 },
					{ "visible": false, "targets": 11 },
					{ "visible": false, "targets": 12 },
					{ "visible": false, "targets": 13 },
					{ "width": "5%", "targets": 14 },
					{ "visible": false, "targets": 15 },
					{ "width": "5%", "targets": 16 },
				],
        "lengthChange": false,
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"createdRow": function ( row, data, index ) {
					console.log(data.clase);
					if ( data.clase == "E" ) {
							$('td', row).eq(0).addClass('table-text-claseE');
							$('td', row).eq(1).addClass('table-text-claseE');
							$('td', row).eq(2).addClass('table-text-claseE');
							$('td', row).eq(3).addClass('table-text-claseE');
							$('td', row).eq(4).addClass('table-text-claseE');
							$('td', row).eq(5).addClass('table-text-claseE');
							$('td', row).eq(6).addClass('table-text-claseE');
							$('td', row).eq(7).addClass('table-text-claseE');
							$('td', row).eq(8).addClass('table-text-claseE');
					}
					if ( data.clase == "D" ) {
							$('td', row).eq(0).addClass('table-text-claseD');
							$('td', row).eq(1).addClass('table-text-claseD');
							$('td', row).eq(2).addClass('table-text-claseD');
							$('td', row).eq(3).addClass('table-text-claseD');
							$('td', row).eq(4).addClass('table-text-claseD');
							$('td', row).eq(5).addClass('table-text-claseD');
							$('td', row).eq(6).addClass('table-text-claseD');
							$('td', row).eq(7).addClass('table-text-claseD');
							$('td', row).eq(8).addClass('table-text-claseD');
					}
				},
				"buttons":[
					{
						extend: 'colvis',
						columns: ':not(.noVis)',
						text: '<i class="fas fa-columns fa-sm"></i> Columnas',
						"className": "btn btn-lg btn-space btn-secondary",
					},
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
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
