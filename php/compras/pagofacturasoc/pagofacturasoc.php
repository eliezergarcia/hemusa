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
			<h1 class="text-center titulo">Pago a Proveedores</h1>
		</div>
	</div>
	
	<div class="row center-xs">
		<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"><small class="mensaje"></small></h3>
			</div>
			<form>
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-12 buttons">
						<input id="btn_registrar_factura" type="button" class="btn btn-primary" value="Registrar pago por Factura">
						<input id="btn_registrar_oc" type="button" class="btn btn-primary" value="Registrar pago por OC">
					</div>
					<!-- <div class="col-sm-offset-0 col-sm-12 buttons">
						<input id="btn_oc_pagadas" type="button" class="btn btn-primary" value="Facturas de OC Pagadas">
						<input id="btn_oc_no_pagadas" type="button" class="btn btn-primary" value="Facturas de Oc no Pagadas">
					</div> -->
					<div class="col-sm-offset-0 col-sm-12 buttons">
						<input id="btn_cargar_pagos" type="button" class="btn btn-primary" value="Cargar Pagos de Proveedor">
					</div>
				</div>
			</form>			
		</div>		
	</div>

	<div class="row center-xs">
		<div id="cuadroCargarPagos" class="cargarPagos row between-xs middle-xs col-sm-12 col-md-12 col-lg-9">
			<div class="row center-xs col-lg-4">
				<p class="col-lg-12">Importar archivo:</p>
				<img src="img/csv.png" width="50%">
			</div>
			<div class="center-xs col-lg-4">
				<form class="form-horizontal" id="" action="" method="POST">
					<div class="row center-xs form-group">
						<input id="" type="file" class="btn" value="Browse...">
					</div>
					<div class="form-group">
						<input id="" type="submit" class="btn btn-primary" value="Subir">
					</div>
			</form>
			</div>
			<div class="start-xs col-lg-4">
				• Recuerde<br>
				» Al archivo debe ser de tipo .csv <br>
				» Las columnas deben ser: factura, Monto del Pago(Formato número), orden de compra, fecha pago , cuenta y T.C (formato número).<br>
				SIN ENCABEZADOS<br>
				» Limite Maximo 20,000 registros por lote.<br>
  	  			»El archivo se crea en excel, porteriormente, Guardar como: CSV (Delimitado por comas, se crea un archivo por hoja)<br><br>
  				• Suegerencias<br>
  					» Revise bien que su archivo .csv este correcto.<br>
  	  				» Asegurese de que eltamaño del archivo no exceda los 3 MB.
			</div>
			
		</div>
	</div>

	<div class="row center-xs">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-3">
			<form class="form-horizontal" id="frmPagoFactura" action="" method="POST">
				<input type="hidden" id="idusuario" name="idusuario" value="0">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<div class="form-group">
					<label for="factura" class="col-sm-2 control-label">Factura</label>
					<div class="col-sm-8"><input id="factura" name="factura" type="text" class="form-control"  autofocus></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="btn_registrar_pago_factura" type="button" class="btn btn-primary" value="Buscar">
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
			<form class="form-horizontal" id="frmPagoOC" action="" method="POST">
				<div class="form-group">
					<label for="ordenCompra" class="col-sm-2 control-label">Orden de Compra</label>
					<div class="col-sm-8"><input id="ordenCompra" name="ordenCompra" type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="btn_registrar_pago_oc" type="button" class="btn btn-primary" value="Buscar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
		</div>
	</div>

	
	<div class="row center-xs">
	    <div id="cuadro4" class="col-sm-10 col-md-10 col-lg-10">
	      <div class="col-sm-offset-2 col-sm-8">
	        <h3 class="text-center"> <small class="mensaje"></small></h3>
	      </div>
	      <div class="table-responsive col-sm-12">    
	        <table class="table table-hover start-xs" id="dt_pago_factura" cellspacing="0" width="100%">
	          <thead>
	            <tr>                
	              <th>Orden Compra</th>
	              <!-- <th>Factura<th> -->
	              <th>Proveedor</th>
	              <th>Total OC</th>
	              <th>Pagado</th>
	              <th>Pago</th>
	              <th>Tipo de Cambio</th>
	              <th>Fecha Pago</th>
	              <th>Cuenta</th>
	              <th>Pago OC</th>
	            </tr>
	          </thead> 
	         <!--  <tbody>
	          	<th></th>
	          	<th></th>
	            <th></th>
	            <th></th>
	            <th></th>
	            <th></th>
	            <th></th>
	            <th></th>
	            <th>
	            	<?php
						echo '<select name="seleccionar_cuenta" id="seleccionar_cuenta" >';
						echo "<option value='' disabled selected>ELEGIR</option>";
						include("../../conexion.php");
						$sql_cuenta ="SELECT * FROM  `accounts` ";
						$resultado_cuenta=mysqli_query($conexion_usuarios, $sql_cuenta);
						while($row_cuenta=mysqli_fetch_array($resultado_cuenta)){
							$id=$row_cuenta['id'];	
							if($id == 1 or $id==2 or $id==4 or $id==5 or $id==6){
    							$nombre=$row_cuenta['nombre'];	
								if(!empty($nombre)){
									echo "<option value='".$id."'>".$nombre."</option>";
								}
							}
						}
					echo'</select>';
					?>
	            </th>
	            <th></th>
	          </tbody> -->         
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
			guardar();
			eliminar();
			$("#cuadroCargarPagos").slideUp("slow");
			$("#cuadro2").slideUp("slow");
			$("#cuadro3").slideUp("slow");
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		$("#btn_registrar_pago_oc").on("click", function(){
			registrar_pago_oc();
		});

		$("#btn_registrar_pago_factura").on("click", function(){
			registrar_pago_factura();
		});

		$("#btn_registrar_oc").on("click", function(){
			registrar_oc();
		});

		$("#btn_registrar_factura").on("click", function(){
			registrar_factura();
		});

		$("#btn_oc_pagadas").on("click", function(){
			oc_pagadas();
		});

		$("#btn_oc_no_pagadas").on("click", function(){
			oc_no_pagadas();
		});

		$("#btn_cargar_pagos").on("click", function(){
			$("#cuadroCargarPagos").slideDown("slow");
			$("#cuadro2").slideUp("slow");
			$("#cuadro3").slideUp("slow");
			$("#cuadro4").slideUp("slow");
			$("#dt_pago_factura").slideUp("slow");
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

		var registrar_pago_oc = function(){
			var ordenCompra = $("#frmPagoOC #ordenCompra").val();
			var table = $("#dt_pago_factura").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_orden_compra.php",
					"data":{"ordenCompra": ordenCompra}
				},
				"info": false,
				"searching": false,
				"paging": false,	
				"columns":[
					{"data":"orden_compra", "sortable": false},
					// {"data":"factura_proveedor", "sortable": false},
					{"data":"nombreEmpresa", "sortable": false},
					{
						"data":"total_factura", "sortable": false,
						"render": function(total_factura){
							return "$ " + total_factura;
						}
					},
					{
						"data":"", "sortable": false,
						"render": function(){
							return "$ " + 0;
						}
					},
					{
						"data":"total_factura", "sortable": false,
						"render": function(total_factura){
							return "$ " + total_factura;
						}
					},
					{
						"data":"tipo_cambio", "sortable": false,
						"render": function(tipo_cambio){
							return "$ " + tipo_cambio;
						}
					},
					{"data":"fecha_orden_compra", "sortable": false},
					{"defaultContent":"","sortable": false},
					{"defaultContent":"<button type='button' class='editar btn btn-primary'>Registrar Pago</button>", "sortable": false}
				],
				"language": idioma_espanol
			});
			// obtener_data_editar("#dt_cliente tbody", table);
			// obtener_id_eliminar("#dt_cliente tbody", table);
		}

		var registrar_pago_factura = function(){
			var factura = $("#frmPagoFactura #factura").val();
			var table = $("#dt_pago_factura").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_pagofacturasoc.php",
					"data":{"factura": factura}
				},
				"info": false,
				"searching": false,
				"paging": false,	
				"columns":[
					{"data":"orden_compra", "sortable": false},
					// {"data":"factura_proveedor", "sortable": false},
					{"data":"nombreEmpresa", "sortable": false},
					{
						"data":"total_factura", "sortable": false,
						"render": function(total_factura){
							return "$ " + total_factura;
						}
					},
					{
						"data":"", "sortable": false,
						"render": function(){
							return "$ " + 0;
						}
					},
					{
						"data":"total_factura", "sortable": false,
						"render": function(total_factura){
							return "$ " + total_factura;
						}
					},
					{
						"data":"tipo_cambio", "sortable": false,
						"render": function(tipo_cambio){
							return "$ " + tipo_cambio;
						}
					},
					{"data":"fecha_orden_compra", "sortable": false},
					{"defaultContent":"","sortable": false},
					{"defaultContent":"<button type='button' class='editar btn btn-primary'>Registrar Pago</button>", "sortable": false}
				],
				"language": idioma_espanol
			});
			// obtener_data_editar("#dt_cliente tbody", table);
			// obtener_id_eliminar("#dt_cliente tbody", table);
		}


		var registrar_factura = function(){
			limpiar_datos();
			$("#cuadroCargarPagos").slideUp("slow");
			$("#cuadro2").slideDown("slow");
			$("#cuadro3").slideUp("slow");
			$("#cuadro4").slideDown("slow");
			$("#cuadroCargarPagos").slideUp("slow");
		}

		var registrar_oc = function(){
			limpiar_datos();
			$("#cuadro2").slideUp("slow");
			$("#cuadro3").slideDown("slow");
			$("#cuadro4").slideDown("slow");
			$("#cuadroCargarPagos").slideUp("slow");
		}

		var oc_pagadas = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro3").slideUp("slow");
			$("#cuadro4").slideUp("slow");
			$("#cuadroCargarPagos").slideUp("slow");
		}

		var oc_no_pagadas = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro3").slideUp("slow");
			$("#cuadro4").slideUp("slow");
			$("#cuadroCargarPagos").slideUp("slow");
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

