<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	// $ruta = "http://localhost/Hemusa/";
	error_reporting(0); // Eliminamos los mensajes de error de PHP
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include('../../enlacescss.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Marcas</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Marcas</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                      			<!-- Tabla de Marcas -->
															<table id="dt_marcas" class="table table-striped table-hover compact" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>Marca</th>
																		<th>Factor</th>
																		<th>Moneda</th>
																		<th>Tiempo de Entrega</th>
																		<th>Excepción de Marca</th>
																		<th>Ver y Editar</th>
																		<th>Eliminar</th>
																	</tr>
																</thead>
															</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

    <!-- Modal Agregar Marca -->
			<form id="frmAgregarMarca" action="" method="POST">
				<input type="hidden" id="opcion" name="opcion" value="agregar">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade colored-header colored-header-success" id="modalAgregarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h4 class="modal-title" id="exampleModalLabel">Registro de marca</h4>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<div class="modal-body">
										<div class="row">
					        		<div class="form-group col">
					        			<label for="marca">Marca <font color="#FF4136">*</font></label>
					        			<input type="text" id="marca" name="marca" class="form-control form-control-sm" required>
					        		</div>
					        		<div class="form-group col">
					        			<label for="factor">Factor <font color="#FF4136">*</font></label>
					        			<input type="text" id="factor" name="factor" class="form-control form-control-sm" required>
					        		</div>
										</div>
										<div class="row">
					        		<div class="form-group col">
					        			<label for="moneda">Moneda <font color="#FF4136">*</font></label>
					        			<!-- <input type="text" id="moneda" name="moneda" class="form-control form-control-sm" required> -->
					        			<select id="moneda" name="moneda" class="form-control form-control-sm select2" required="">
					        				<option value="mxn">MXN</option>
					        				<option value="usd">USD</option>
					        			</select>
					        		</div>
					        		<div class="form-group col">
					        			<label for="tiempoEntrega">Tiempo de Entrega <font color="#FF4136">*</font></label>
					        			<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="form-control form-control-sm" required>
					        		</div>
										</div>
				      		</div>
				      		<div class="modal-footer invoice-footer">
				        		<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
				        		<button type="submit" class="btn btn-lg btn-success">Agregar</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
			</form>

		<!-- Modal Editar Marca -->
			<form id="frmEditarMarca" action="" method="POST">
				<input type="hidden" id="idmarca" name="idmarca">
				<input type="hidden" id="opcion" name="opcion" value="editar">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade colored-header colored-header-primary" id="modalEditarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h4 class="modal-title" id="exampleModalLabel">Información de marca</h4>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          			<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<div class="modal-body">
				      			<div class="row">
					        		<div class="form-group col">
					        			<label for="marca">Marca <font color="#FF4136">*</font></label>
					        			<input type="text" id="marca" name="marca" class="form-control form-control-sm" required>
					        		</div>
					        		<div class="form-group col">
					        			<label for="factor">Factor <font color="#FF4136">*</font></label>
					        			<input type="text" id="factor" name="factor" class="form-control form-control-sm" required>
					        		</div>
											<div class="form-group col">
					        			<label for="descuento">Descuento <font color="#FF4136">*</font></label>
					        			<input type="text" id="descuento" name="descuento" class="form-control form-control-sm" required>
					        		</div>
				        		</div>
				        		<div class="row">
					        		<div class="form-group col">
					        			<label for="moneda">Moneda <font color="#FF4136">*</font></label>
					        			<!-- <input type="text" id="moneda" name="moneda" class="form-control form-control-sm" required> -->
					        			<select id="moneda" name="moneda" class="form-control form-control-sm select2">
					        				<option value="mxn">MXN</option>
					        				<option value="usd">USD</option>
					        			</select>
					        		</div>
					        		<div class="form-group col">
					        			<label for="tiempoEntrega">Tiempo de entrega <font color="#FF4136">*</font></label>
					        			<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="form-control form-control-sm" required>
					        		</div>
				        		</div>
				        		<div class="row">
					        		<div class="form-group col">
					        			<label for="excepcionmarca">Excepción de marca <font color="#FF4136">*</font>&nbsp;&nbsp;&nbsp;</label>
					        			<label class="custom-control custom-radio custom-control-inline">
				                          	<input type="radio" class="custom-control-input" name="excepcionmarca" id="excepcionmarcasi" value="1">
				                          	<span class="custom-control-label">Sí</span>
				                        </label>
				                        <label class="custom-control custom-radio custom-control-inline">
				                          	<input type="radio" class="custom-control-input" name="excepcionmarca" id="excepcionmarcano" value="0">
				                          	<span class="custom-control-label">No</span>
				                        </label>
					        		</div>
				        		</div>
				      		</div>
				      		<div class="modal-footer invoice-footer">
				        		<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
				        		<button type="submit" class="btn btn-lg btn-primary">Guardar</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
			</form>

		<!-- Modal Eliminar Marca -->
			<form id="frmEliminarMarca" action="" method="POST">
				<input type="hidden" id="idmarca" name="idmarca">
				<input type="hidden" id="opcion" name="opcion" value="eliminar">
				<input type="hidden" id="usuariologin" name="usuariologin">
				<input type="hidden" id="dplogin" name="dplogin">
				<div class="modal fade" id="modalEliminarMarca" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				  	<div class="modal-dialog" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
			                  	<button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
			                </div>
				      		<div class="modal-body">
				      			<div class="text-center">
              				<div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
              				<h4>¿Está seguro de eliminar la marca?</h4>
              				<div class="row justify-content-center">
              					<input type="text" id="marca" name="marca" class="disabled col-6 form-control form-control-sm" disabled>
              				</div>
              				<div class="mt-8 invoice-footer">
                					<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                					<button type="submit" class="btn btn-lg btn-danger">Eliminar</button>
              				</div>
            				</div>
				      		</div>
				      		<div class="modal-footer">
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
			listar();
			guardar();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#marcas-menu").addClass("active");
    }

		var  listar = function(){
			var table = $("#dt_marcas").DataTable({
				"destroy": true,
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar.php"
				},
				"columns":[
					{"data":"marca"},
					{"data":"factor"},
					{"data":"moneda"},
					{"data":"TiempoEntrega",},
					{
						"data":"excepcion",
						"render": function(excepcion){
							if (excepcion == 1) {
								return "Si";
							}else{
								return "No";
							}
						},
					},
					{"defaultContent":"<div class='invoice-footer'><button type='button' class='editar btn btn-space btn-primary btn-lg' data-toggle='modal' data-target='#modalEditarMarca'><i class='fas fa-edit fa-sm'></i></button></div>", "sortable": false},
					{"defaultContent":"<div class='invoice-footer'><button type='button' class='eliminar btn btn-space btn-danger btn-lg' data-toggle='modal' data-target='#modalEliminarMarca' ><i class='fas fa-trash-alt fa-sm'></i></button></div>", "sortable": false}
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
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'csv',
			                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend:    'pdfHtml5',
			                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
			                  download: 'open',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'print',
			                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
			                  header: 'false',
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  },
			                  orientation: 'landscape',
			                  pageSize: 'LEGAL'
			                }
			            ]
			          },
		            {
		                text: '<i class="fas fa-wrench fa-sm"></i> Agregar marca',
		                "className": "btn btn-lg btn-space btn-success",
		                titleAttr: 'Agregar Marca',
		                action: function ( e, dt, node, config ) {
		                    $('#modalAgregarMarca').modal('show');
		                }
		            }
				]
			});

			obtener_data_editar("#dt_marcas tbody", table);
			obtener_id_eliminar("#dt_marcas tbody", table);
		}

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$("form .disabled").attr("disabled", false);
				$("#modalAgregarMarca").modal("hide");
				$("#modalEditarMarca").modal("hide");
				$("#modalEliminarMarca").modal("hide");
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					$('#dt_marcas').DataTable().ajax.reload();
				});
			});
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var idmarca = $("#frmEditarMarca #idmarca").val(data.id),
					marca = $("#frmEditarMarca #marca").val(data.marca),
					factor = $("#frmEditarMarca #factor").val(data.factor),
					descuento = $("#frmEditarMarca #descuento").val(data.descuento),
					moneda = $("#frmEditarMarca #moneda").val(data.moneda).change(),
					tiempoEntrega = $("#frmEditarMarca #tiempoEntrega").val(data.TiempoEntrega),
					opcion = $("#frmEditarMarca #opcion").val("editar");
				if (data.excepcion == 1) {
					$("#frmEditarMarca #excepcionmarcasi").attr('checked', true);
				}else{
					$("#frmEditarMarca #excepcionmarcano").attr('checked', true);
				}
			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var idmarca = $("#frmEliminarMarca #idmarca").val(data.id);
				var marca = $("#frmEliminarMarca #marca").val(data.marca);
			});
		}

		var limpiar_datos = function(){
			$("#marca").val();
			$("#factor").val();
			$("#moneda").val();
			$("#tiempoEntrega").val();
			$("#excepcionmarca").val();
			$("form .disabled").attr("disabled", true);
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
	<script src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
