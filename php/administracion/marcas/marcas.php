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
	<?php include('../../enlaces.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
		<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
			<!-- Breadcrumb -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Administración</li>
						<li class="breadcrumb-item active">Marcas</li>
					</ol>
				</nav>

			<!-- Encabezado -->
			  	<div id="encabezado">
					<br><center><h1><b>Administración de marcas</b></h1></center><br>
				</div>

			<!-- Mensaje de actualizaciones -->
				<div>
					<center><h6 class="mensaje"></h6></center>
				</div>

			<!-- Tabla de Marcas -->
				<table id="dt_marcas" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
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
					<tfoot>
						<tr>
							<th>Marca</th>
							<th>Factor</th>
							<th>Moneda</th>
							<th>Tiempo de Entrega</th>
							<th>Excepción de Marca</th>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>

			<!-- Modal Editar Marca -->
				<form id="frmEditarMarca" action="" method="POST">
					<input type="hidden" id="idmarca" name="idmarca">
					<input type="hidden" id="opcion" name="opcion" value="editar">
					<input type="hidden" id="usuariologin" name="usuariologin">
					<input type="hidden" id="dplogin" name="dplogin">
					<div class="modal fade" id="modalEditarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel">Editar Marca</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          			<span aria-hidden="true">&times;</span>
					        		</button>
					      		</div>
					      		<div class="modal-body">
					      			<div class="row">
						        		<div class="form-group col">
						        			<label for="marca">Marca <font color="#FF4136">*</font></label>
						        			<input type="text" id="marca" name="marca" class="form-control" required>
						        		</div>
						        		<div class="form-group col">
						        			<label for="factor">Factor <font color="#FF4136">*</font></label>
						        			<input type="text" id="factor" name="factor" class="form-control" required>
						        		</div>
					        		</div>
					        		<div class="row">
						        		<div class="form-group col">
						        			<label for="moneda">Moneda <font color="#FF4136">*</font></label>
						        			<input type="text" id="moneda" name="moneda" class="form-control" required>
						        		</div>
						        		<div class="form-group col">
						        			<label for="tiempoEntrega">Tiempo de entrega <font color="#FF4136">*</font></label>
						        			<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="form-control" required>
						        		</div>
					        		</div>
					        		<div class="row">
						        		<div class="form-group col">
						        			<label for="excepcionmarca">Excepción de marca <font color="#FF4136">*</font></label>
						        			<div class="form-check">
											  	<input class="form-check-input form-control" type="radio" name="excepcionmarca" id="excepcionmarcasi" value="1">
											  	<label class="form-check-label" for="valorNacional">
											    	Si
											  	</label>
											</div>
											<div class="form-check">
											  	<input class="form-check-input form-control" type="radio" name="excepcionmarca" id="excepcionmarcano" value="0">
											  	<label class="form-check-label" for="valorAmericano">
											    	No
											  	</label>
											</div>
						        		</div>
					        		</div>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        		<button type="submit" class="btn btn-primary">Editar</button>
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
					<div class="modal fade" id="modalEliminarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash-o btn-outline-danger" aria-hidden="true"></i> Eliminar Marca</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          			<span aria-hidden="true">&times;</span>
					        		</button>
					      		</div>
					      		<div class="modal-body">
					        		<div class="form-group row">
					        			<label for="marca">Marca</label>
					        			<input type="text" id="marca" name="marca" class="disabled form-control" disabled>
					        		</div>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        		<button type="submit" class="btn btn-danger" >Eliminar</button>
					      		</div>
					    	</div>
					  	</div>
					</div>
				</form>

			<!-- Modal Agregar Marca -->
				<form id="frmAgregarMarca" action="" method="POST">
					<input type="hidden" id="opcion" name="opcion" value="agregar">
					<input type="hidden" id="usuariologin" name="usuariologin">
					<input type="hidden" id="dplogin" name="dplogin">
					<div class="modal fade" id="modalAgregarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus btn-outline-success" aria-hidden="true"></i> <i class="fa fa-simplybuilt btn-outline-success" aria-hidden="true"></i> Agregar Marca</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          		<span aria-hidden="true">&times;</span>
					        		</button>
					      		</div>
					      		<div class="modal-body">
											<div class="row">
						        		<div class="form-group col">
						        			<label for="marca">Marca <font color="#FF4136">*</font></label>
						        			<input type="text" id="marca" name="marca" class="form-control" required>
						        		</div>
						        		<div class="form-group col">
						        			<label for="factor">Factor <font color="#FF4136">*</font></label>
						        			<input type="text" id="factor" name="factor" class="form-control" required>
						        		</div>
											</div>
											<div class="row">
						        		<div class="form-group col">
						        			<label for="moneda">Moneda <font color="#FF4136">*</font></label>
						        			<input type="text" id="moneda" name="moneda" class="form-control" required>
						        		</div>
						        		<div class="form-group col">
						        			<label for="tiempoEntrega">Tiempo de Entrega <font color="#FF4136">*</font></label>
						        			<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="form-control" required>
						        		</div>
											</div>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					        		<button type="submit" class="btn btn-success">Agregar</button>
					      		</div>
					    	</div>
					  	</div>
					</div>
				</form>

		</div>
	</main>
</body>
</html>
	<script>
		$(document).on("ready", function(){
			var idusuario = "<?php echo $idusuario; ?>";
			var opcion = "datosusuario";
			listar(); // Función para listar la tabla de marcas
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

		var  listar = function(){
			$('#dt_marcas tfoot th').each( function () {
    			var title = $(this).text();
    			$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
  			});
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
					{"defaultContent":"<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditarMarca'><i class='fa fa-pencil-square-o'></i></button>", "sortable": false},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminarMarca' ><i class='fa fa-trash-o'></i></button>", "sortable": false}
				],
				"language": idioma_espanol,
				"dom":
					"<'container row col-10 row'<'row justify-content-center col-5 buttons'B><'row justify-content-end col-7 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'Generar PDF',
		                "className": "btn iconopdf",
		                title: '',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Generar Excel',
		                "className": "btn iconoexcel",
		                title: '',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			}
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'Generar CSV',
		            	"className": "btn iconocsv",
		            	title: '',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			}
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	title: 'Marcas',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            },
		            {
		                text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Marca',
		                "className": "btn btn-success",
		                titleAttr: 'Agregar Marca',
		                action: function ( e, dt, node, config ) {
		                    $('#modalAgregarMarca').modal('show');
		                }
		            }
				]
			});

			$("#dt_marcas tfoot input").on( 'keyup change', function () {
	    		table
	        		.column( $(this).parent().index()+':visible' )
	        		.search( this.value )
	        		.draw();
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
					listar();
					limpiar_datos();
				});
			});
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
					console.log(data);
				var idmarca = $("#idmarca").val(data.id),
					marca = $("#marca").val(data.marca),
					factor = $("#factor").val(data.factor),
					moneda = $("#moneda").val(data.moneda),
					tiempoEntrega = $("#tiempoEntrega").val(data.TiempoEntrega),
					opcion = $("#opcion").val("editar");
				if (data.excepcion == 1) {
					$("#excepcionmarcasi").attr('checked', true);
				}else{
					$("#excepcionmarcano").attr('checked', true);
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

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecutó la consulta.</div>";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<div class='alert alert-warning'><strong>Información!</strong> la marca ya existe.</div>";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<strong>Advertencia!</strong> la opción no existe o esta vacía, recargar la página. ";
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
</body>
</html>
