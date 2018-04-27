<?php 
	include("../../header.php");
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap4.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
  	<div class="row fondo">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Entregas</h1>
		</div>
	</div>
	
	<div class="row">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12">
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">					
					Formulario de Registro de Usuarios</h3>
				</div>
				<input type="hidden" id="idusuario" name="idusuario" value="0">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<div class="form-group">
					<label for="usuario" class="col-sm-2 control-label">Usuario</label>
					<div class="col-sm-8"><input id="usuario" name="usuario" type="text" class="form-control"  autofocus></div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8"><input id="password" name="password" type="text" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-8"><input id="nombre" name="nombre" type="text" class="form-control"  autofocus></div>
				</div>
				<div class="form-group">
					<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
					<div class="col-sm-8"><input id="apellidos" name="apellidos" type="text" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="departamento" class="col-sm-2 control-label">Departamento</label>
					<div class="col-sm-8"><input id="departamento" name="departamento" type="text" class="form-control" maxlength="8" ></div>
				</div>
				<div class="form-group">
					<label for="nivel" class="col-sm-2 control-label">Nivel</label>
					<div class="col-sm-8"><input id="nivel" name="nivel" type="text" class="form-control" maxlength="8" ></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="" type="submit" class="btn btn-primary" value="Guardar">
						<input id="btn_listar" type="button" class="btn btn-primary" value="Listar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
			
		</div>
	</div>
	<div class="row center-xs">
		<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<form>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8 botones">
						<input id="btn_listar_sinfactura" type="button" class="btn btn-primary" value="Sin factura o remisión">
						<input id="btn_listar_confactura" type="button" class="btn btn-primary" value="Con Factura">
						<input id="btn_listar_conremision" type="button" class="btn btn-primary" value="Con Remisión">
						<input id="btn_listar_entregasprogramadas" type="button" class="btn btn-primary" value="Entregas Programadas">
						<input id="btn_listar_entregasvencidas" type="button" class="btn btn-primary" value="Entregas Vencidas">
					</div>
				</div>
			</form>
			<div class="table-responsive col-sm-12">		
				<table id="dt_entrega" class="table table-hover start-xs" cellspacing="0" width="100%">
					<thead>
						<tr>								
							<th>Cliente</th>
							<th>Orden de Compra</th>
							<th>Modelo</th>
							<th>Marca</th>
							<th>Descripción</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Factura</th>
							<th>Remisión</th>
							<th>Eliminar</th>											
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
	</div>
	<div>
		<form id="frmEliminarUsuario" action="" method="POST">
			<input type="hidden" id="idusuario" name="idusuario" value="">
			<input type="hidden" id="opcion" name="opcion" value="eliminar">
			<!-- Modal -->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
						</div>
						<div class="modal-body">							
							¿Está seguro de eliminar al usuario?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>
	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="js/dataTables.buttons.min.js"></script>
	<script src="js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="js/pdfmake.min.js"></script>
	<script src="js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="js/buttons.html5.min.js"></script>

	<script>
		$(document).on("ready", function(){
			$("#cuadro2").slideUp("slow");
		});

		// $("#btn_listar").on("click", function(){
		// 	listar();
		// });

		$("#btn_listar_sinfactura").on("click", function(){
			listar_sinfactura();
		});

		$("#btn_listar_confactura").on("click", function(){
			listar_sinfactura();
		});

		$("#btn_listar_conremision").on("click", function(){
			listar_sinfactura();
		});

		$("#btn_listar_entregasprogramadas").on("click", function(){
			listar_sinfactura();
		});

		$("#btn_listar_entregasvencidas").on("click", function(){
			listar_sinfactura();
		});

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				// console.log(frm);
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

		var eliminar = function(){
			$("#eliminar-usuario").on("click", function(){
				var idusuario = $("#frmEliminarUsuario #idusuario").val(),
					opcion = $("#frmEliminarUsuario #opcion").val();
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"idusuario": idusuario, "opcion": opcion}
				}).done( function( info ){
					// console.log(info);
					// var json_info = JSON.parse( info );
					// console.log(json_info);
					texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
					color = "#379911";
					$(".mensaje").html( texto ).css({"color": color });
					$(".mensaje").fadeOut(3000, function(){
					$(this).html("");
					$(this).fadeIn(3000);
					}); 

					limpiar_datos();
					listar();
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<strong>Error</strong>, no se ejecutó la consulta.";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<strong>Información!</strong> el usuario ya existe.";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<strong>Adbertencia!</strong> la opción no existe o esta vacía, recargar la página. ";
				color = "#DDB11D";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(3000, function(){
			$(this).html("");
			$(this).fadeIn(3000);
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

		var listar_sinfactura = function(){
			$("#cuadro2").slideUp("slow");
			$("#cuadro1").slideDown("slow");
			var table = $("#dt_entrega").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_sinfactura.php"
				},
				"columns":[
					{"data":"nombreEmpresa"},
					{"data":"noDePedido"},
					{"data":"modelo", "sortable": false},
					{"data":"marca", "sortable": false},
					{"data":"descripcion", "sortable": false},
					{
						"data":"precioLista", "sortable": false,
						"render": function(cantidad){
							return "$ " + cantidad;
						},
					},
					{"data":"cantidad", "sortable": false},
					{"data":"factura", "sortable": false},
					{"data":"remision", "sortable": false},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>", "sortable": false}
				],
				"language": idioma_espanol,
				"dom": 'Bfrtip',
				"buttons":[
					// {
					// 	"text": "",
					// 	"titleAttr": "Agregar entrega",
					// 	"className": "btn btn-success",
					// 	"action": function(){
					// 		agregar_nuevo_usuario();
					// 	}
					// },
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
			obtener_data_editar("#dt_entrega tbody", table);
			obtener_id_eliminar("#dt_entrega tbody", table);
		}

		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
					// console.log(data);
				var idusuario = $("#idusuario").val(data.id),
					usuario = $("#usuario").val(data.user),
					pass = $("#password").val(data.password),
					nombre = $("#nombre").val(data.nombre),
					apellidos = $("#apellidos").val(data.apellidos),
					departamento = $("#departamento").val(data.dp),
					nivel = $("#nivel").val(data.nivel),
					opcion = $("#opcion").val("modificar");

					$("#cuadro2").slideDown("slow");
					$("#cuadro1").slideUp("fast");
			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#frmEliminarUsuario #idusuario").val(data.id);
			});
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
