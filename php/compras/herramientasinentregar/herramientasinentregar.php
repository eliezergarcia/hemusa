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
			<h1 class="text-center titulo">Herramientas sin entregar</h1>
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
					<div class="col-sm-8"><input id="departamento" name="departamento" type="text" class="form-control"></div>
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
    	<div id="cuadro3" class="col-sm-12 col-md-12 col-lg-3">
	      <form class="form-horizontal" id="frmMostrar" action="" method="POST">
	        <div class="form-group">
	          <label for="fechaInicio" class="col-sm-3 control-label">Fecha Inicio</label>
	          <div class="col-sm-7"><input id="fechaInicio" name="fechaInicio" type="date" class="form-control"  autofocus required></div>
	        </div>
	        <div class="form-group">
	          <label for="fechaFin" class="col-sm-3 control-label">Fecha Fin</label>
	          <div class="col-sm-7"><input id="fechaFin" name="fechaFin" type="date" class="form-control" required></div>
	        </div>
	        <div class="form-group">
	          <div class="col-sm-offset-2 col-sm-8">
	            <input id="btn_listar_herramientas" type="button" class="btn btn-primary" value="Buscar">
	          </div>
	        </div>
	      </form>
    	</div>
  	</div>

	<div class="row center-xs">
		<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_herramienta" class="table table-bordered table-hover start-xs" cellspacing="0" width="100%">
					<thead>
						<tr>								
							<th>Cliente</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Moneda</th>
							<th>Fecha Pedido</th>
							<!-- <th>Ver pedido</th>	 -->
							<th>Comentarios Seguimiento</th>											
						</tr>
					</thead>					
				</table>
			</div>			
		</div>
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
			$("#cuadro1").slideDown("slow");
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		$("#btn_listar_herramientas").on("click", function(){
			listar();
		});

		$("#btn_agregar_usuario").on("click", function(){
			agregar_nuevo_usuario();
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

		var  listar = function(){
			$("#cuadro2").slideUp("slow");
			$("#cuadro1").slideDown("slow");
			var fechaInicio = $("#frmMostrar #fechaInicio").val(),
          		fechaFin = $("#frmMostrar #fechaFin").val();
			var table = $("#dt_herramienta").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_herramienta.php",
					"data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
				},
				"columns":[
					{"data":"cliente","sortable": false},
					{"data":"marca","sortable": false},
					{"data":"modelo","sortable": false},
					{"data":"descripcion","sortable": false},
					{"data":"cantidad","sortable": false},
					{
						"data":"precio","sortable": false,
						"render": function(precio){
							return "$ " + precio;
						},
					},
					{"data":"moneda","sortable": false},
					{"data":"fecha"},
					// {"defaultContent":"<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>", "sortable": false},
					{"defaultContent":"","sortable": false}
				],
				"order":[[7, "desc"]],
				"language": idioma_espanol,
				"dom": 'Bfrtip',
				"buttons":[
					// {
					// 	"text": "<i class='fa fa-user-plus'></i>",
					// 	"titleAttr": "Agregar usuario",
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
			obtener_data_editar("#dt_cliente tbody", table);
			obtener_id_eliminar("#dt_cliente tbody", table);
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
