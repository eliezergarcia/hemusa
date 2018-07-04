<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Subir lista de precios</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>

	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Subir lista de precios</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Subir lista de precios</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                            <br>
                            <div class="row col-4 justify-content-center">
                              <input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
                            </div>
                            <br>

                            <!-- Tabla Lista de precios -->
                              <table id="example" class="ui celler table" width="100%">
                                <thead>
                                  <tr>
                                    <th>Modelo</th>
                                    <th>Descripcion</th>
																		<th>Estándar</th>
                                    <th>Precio Base</th>
																		<th>Marca</th>
																		<th>Página Catálogo</th>
																		<th>Sección Catálogo</th>
																		<th>Código de Barras</th>
                                    <th>Clave Sat</th>
																		<th>Unidad</th>
																		<th>IVA</th>
																		<th>Mes Promoción</th>
																		<th>Descuento</th>
                                  </tr>
                                </thead>
                              </table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

			<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						</div>
						<div class="modal-body">
							<div class="text-center">
								<div class="texto1">
									<br><br>
									<h3>Espere un momento...</h3>
									<h4>Se está procesando el archivo.</h4>
									<br>
									<div class="text-center">
										<div class="be-spinner">
											<svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
												<circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
											</svg>
										</div>
									</div>
								</div>
								<div class="mt-8">
								</div>
							</div>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
			</div>
	<header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
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
          $('#example').DataTable( {
            data: data.data,
            "columns": [
                { "data": "MODELO"},
                { "data": "DESCRIPCION"},
                { "data": "ESTANDAR"},
                { "data": "PRECIO BASE"},
                { "data": "MARCA"},
                { "data": "PAGINA CATALOGO"},
								{ "data": "SECCION CATALOGO"},
								{ "data": "CODIGO BARRAS"},
								{ "data": "CLAVE SAT"},
								{ "data": "UNIDAD"},
								{ "data": "IVA"},
								{ "data": "MES PROMOCION"},
								{ "data": "DESCUENTO"}
            ],
            "language": idioma_espanol,
    				"dom":
  	    			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
  	    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
  	    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
						"buttons":[
							{
									text: '<i class="fas fa-upload"></i> Subir lista',
									"className": "btn btn-lg btn-space btn-primary",
									titleAttr: 'Subir lista',
									action: function ( e, dt, node, config ) {

									}
							}
						]
          });

				}
			});
			// setTimeout( function () {
			// 	// $("#mod-success").modal("hide");
			// 	$(".texto1").html("");
			// 	$(".texto1").append("<br><br>");
			// 	$(".texto1").append("<h3>Espere un momento...</h3>");
			// 	$(".texto1").append("<h4>Se está procesando el archivo.</h4>");
			// 	$(".texto1").append("<br>");
			// 	$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
			// 	$(".texto1").append("<br>");
			// 	$(".texto1").append("<br>");
			// }, 5000);
		}

		var obtener_data_subir_lista = function(tbody, table){
			$(".subirlistaprecios").on("click", function(){
				console.log("Subir Lista");
				// $("#mod-success").modal("show");
				// obtener_data_subir_lista(data.data);
				// setTimeout(function () {
				// 	$(".texto1").fadeOut(300, function(){
				// 		$(this).html("");
				// 		$(this).fadeIn(300);
				// 	});
				// }, 5000);
				// setTimeout(function () {
				// 		$(".texto1").append("<br>");
				// 		$(".texto1").append("<br>");
				// 		$(".texto1").append("<div class='text-center'>");
				// 		$(".texto1").append("<h3>La lista de precios se está actualizando.</h3>");
				// 		$(".texto1").append("<h4>Este proceso puede demorar algunos minutos.</h4>");
				// 		$(".texto1").append("</div>");
				// 		$(".texto1").append("<br>");
				// 		$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
				// 		$(".texto1").append("<br>");
				// 		$(".texto1").append("<h4><label id='numeroi'></label> filas de <label id='numeroj'></label> actualizadas</h4>");
				// 	}, 7000);
				// var opcion = "subirlista";
				// var lista = data.data;
				// var j = 1000;
				// setTimeout(function () {
				// 	$('#numeroj').html(j);
				// }, 7000);
				// 	var filascorrectas = 0;
				// 	var filaserror = 0;
				// for (var i = 1; i <= j; i++) {
				// 	var lista = JSON.stringify(data.data[i]);
				// 	console.log(lista);
				// 	console.log(i);
				// 	$.ajax({
				// 		method: "POST",
				// 		url: "guardar.php",
				// 		dataType: "json",
				// 		data: {"opcion": opcion, "lista": lista, "indice": i},
				// 	}).done( function( info ){
				// 		console.log(info.respuesta);
				// 		$('#numeroi').html(info.indice);
				// 		if (info.respuesta == "BIEN") {
				// 			filascorrectas = parseInt(filascorrectas) + 1;
				// 		}else{
				// 			filaserror = parseInt(filaserror) + 1;
				// 		}
				// 		if (info.indice == (j)) {
				// 			setTimeout(function () {
				// 				$(".texto1").fadeOut(300, function(){
				// 					$(this).html("");
				// 					$(this).fadeIn(300);
				// 				});
				// 			}, 2000);
				// 			setTimeout(function () {
				// 				$(".texto1").append("<br>");
				// 				$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
				// 				$(".texto1").append("<h3>Correcto!</h3>");
				// 				$(".texto1").append("<h4>La lista de precios se actualizó correctamente.</h4>");
				// 				$(".texto1").append("<br>");
				// 				$(".texto1").append("<h5>Correctos: <h4 class='text-success'>"+filascorrectas+"</h4></h5>");
				// 				$(".texto1").append("<h5>Errores: <h4 class='text-danger'>"+filaserror+"</h4></h5>");
				// 				console.log(lista.length);
				// 			}, 2500);
				// 		}
				// 	});
				// }
			});
		}

	</script>
  <script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
