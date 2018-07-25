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
														<div class="">
															<h4>Instrucciones: <button class="btn btn-warning" data-toggle="modal" data-target="#modalInstrucciones"><i class="fas fa-info-circle"></i></button></h4>
														</div>
														<br>
                            <div class="row col-4">
                              <input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
				                      <!-- <input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
				                      <label class="btn-secondary" for="files"> <i class="mdi mdi-upload"></i><span>Selecciona un archivo...					</span></label> -->
                            </div>
                            <br>
														<!-- <button type="button" name="button" id="ejecutar-query" class="btn btn-lg btn-primary">Ejecutar Query</button> -->

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

			<!-- Modal Instrucciones -->
				<div class="modal fade colored-header colored-header-warning" id="modalInstrucciones" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Instrucciones</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body row align-items-center justify-content-center">
									<div>
										<div class="col-12 justify-content-center">
											<label>Para poder subir la lista de precios correctamente, es necesario que el archivo tenga las siguientes características:</label>
										</div>
										<br>
										<div class="col-12 justify-content-center">
											<label>1. La <b>primera fila</b> deberá ser los <b>encabezados de cada columna</b></label>
											<label>2. Los <b>nombres</b> de las <b>columnas</b> a actualizar deberán estar <b>en mayúsculas y sin acentos</b>, tal y como se muestra a continuación: </label>
											<br><br>
											<div class="row col justify-content-around">
												<div class="col">
													<h5>- MODELO</h5>
													<h5>- DESCRIPCION</h5>
													<h5>- ESTANDAR</h5>
													<h5>- PRECIO BASE</h5>
													<h5>- MARCA</h5>
													<h5>- PAGINA CATALOGO</h5>
													<h5>- SECCION CATALOGO</h5>
												</div>
												<div class="col">
													<h5>- CODIGO BARRAS</h5>
													<h5>- CLAVE SAT</h5>
													<h5>- UNIDAD</h5>
													<h5>- IVA</h5>
													<h5>- MES PROMOCION</h5>
													<h5>- DESCUENTO</h5>
												</div>
											</div>
										</div>
										<br>
										<div class="col-12 justify-content-center">
											<label>3. El <b>formato</b> de las <b>columnas de precio</b> deberán tener <b>formato general, sin "$, puntos y comas"</b>.</label>
										</div>
										<div class="col-12 justify-content-center">
											<label>4. El archivo deberá <b>guardarse como "Texto CSV (.csv)"</b>.</label>
										</div>
										<div class="col-12 justify-content-center">
											<label>5. El <b>delimitador de campos</b> deberá ser: <b>":"</b>.</label>
										</div>
										<div class="col-12 justify-content-center">
											<label>6. El <b>delimitador de cadena</b> deberá ser: <b>comilla simple</b>.</label>
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
									<h3>La lista de precios se está actualizando</h3>
									<h4>Este proceso puede demorar algunos minutos.</h4>
									<br>
									<div class="be-spinner">
										<svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
											<circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
										</svg>
									</div>
									<h4><label id='numeroi'></label> filas de <label id='numeroj'></label> actualizadas</h4>
									<h5>Correctos: <h4 class='text-success' id='filascorrectas'></h4></h5>
									<h5>Errores: <h4 class='text-danger' id='filaserror'></h4></h5>
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
			$("#csv-file").change(handleFileSelect);
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#subirlista-menu").addClass("active");
    }

		var data;

		function handleFileSelect(evt) {
			var file = evt.target.files[0];

			Papa.parse(file, {
				header: true,
				delimiter:":",
				dynamicTyping: true,
				complete: function(results) {
					data = results;
					console.log((data.data).length);
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
								"className": "btn btn-lg btn-space btn-primary subirlistaprecios",
								titleAttr: 'Subir lista',
								action: function ( e, dt, node, config ) {
									subirlista(data.data);
								}
							}
						]
          });

				}
			});
		}

		function subirlista (lista){
			console.log(lista);
			$("#mod-success").modal("show");
				var opcion = "subirlista";
				var lista = data.data;
				var j = 10;
				setTimeout(function () {
					$('#numeroj').html(j);
				}, 5500);
					var filascorrectas = 0;
					var filaserror = 0;
					$('#filascorrectas').html(filascorrectas);
					$('#filaserror').html(filaserror);
					var arregloErrores = new Array();
				for (var i = 1; i <= j; i++) {
					var lista = JSON.stringify(data.data[i]);
					// console.log(lista);
					// console.log(i);
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"opcion": opcion, "lista": lista, "indice": i},
					}).done( function( info ){
						console.log(info.respuesta);
						$('#numeroi').html(info.indice);
						if (info.respuesta == "BIEN") {
							filascorrectas = parseInt(filascorrectas) + 1;
							$('#filascorrectas').html(filascorrectas);
						}else{
							filaserror = parseInt(filaserror) + 1;
							$('#filaserror').html(filaserror);
							arregloErrores.push(info);
						}
						if (info.indice == (j)) {
							mensaje_actualizado(j, filascorrectas, filaserror, arregloErrores);
						}
					});
				}
		}

		function mensaje_actualizado (totales, filascorrectas, filaserror, arregloErrores) {
			console.log(arregloErrores);
			setTimeout(function () {
				$(".texto1").fadeOut(300, function(){
					$(this).html("");
					$(this).fadeIn(300);
				});
			}, 2000);
			setTimeout(function () {
				$(".texto1").append("<br><br>");
				$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
				$(".texto1").append("<h3>Correcto!</h3>");
				$(".texto1").append("<h4>La lista de precios se actualizó correctamente.</h4>");
				$(".texto1").append("<br>");
				$(".texto1").append("<h5>Totales: <h4>"+totales+"</h4></h5>");
				$(".texto1").append("<h5>Correctos: <h4 class='text-success'>"+filascorrectas+"</h4></h5>");
				$(".texto1").append("<h5>Errores: <h4 class='text-danger'>"+filaserror+"</h4></h5>");
				$(".texto1").append("<br>");
				if (filascorrectas != totales) {
					$(".texto1").append("<button class='btn btn-primary btn-lg' id='reintentarErrores'>Reintentar errores</button>");
					reintentarErrores(arregloErrores);
				}
			}, 2500);
		}

		var reintentarErrores = function (arregloErrores) {
			$("#reintentarErrores").on("click", function (){
				subirlista(arregloErrores);
				$(".texto1").fadeOut(300, function(){
					$(this).html("");
					$(this).fadeIn(300);
				});
				setTimeout(function () {
					$(".texto1").append("<br><br>");
					$(".texto1").append("<h3>La lista de precios se está actualizando</h3>");
					$(".texto1").append("<h4>Este proceso puede demorar algunos minutos</h4>");
					$(".texto1").append("<br>");
					// $(".texto1").append("<div class='be-spinner'>");
					$(".texto1").append('<svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">');
					// $(".texto1").append('<circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>');
					// $(".texto1").append("</svg>");
					// $(".texto1").append("</div>");
					$(".texto1").append("<h4><label id='numeroi'></label> filas de <label id='numeroj'></label> actualizadas</h4>");
					$(".texto1").append("<h5>Correctos: <h4 class='text-success' id='filascorrectas'></h4></h5>");
					$(".texto1").append("<h5>Errores: <h4 class='text-danger' id='filaserror'></h4></h5>");
				}, 500);
			});
		}

		$('#mod-success').on('hidden.bs.modal', function (e) {
			$(".texto1").fadeOut(300, function(){
				$(this).html("");
				$(this).fadeIn(300);
			});
			setTimeout(function () {
				$(".texto1").append("<br><br>");
				$(".texto1").append("<h3>La lista de precios se está actualizando</h3>");
				$(".texto1").append("<h4>Este proceso puede demorar algunos minutos</h4>");
				$(".texto1").append("<br>");
				$(".texto1").append("<div class='be-spinner'>");
				$(".texto1").append("<svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'>");
				$(".texto1").append("<circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle>");
				$(".texto1").append("</svg>");
				$(".texto1").append("</div>");
				$(".texto1").append("<h4><label id='numeroi'></label> filas de <label id='numeroj'></label> actualizadas</h4>");
				$(".texto1").append("<h5>Correctos: <h4 class='text-success' id='filascorrectas'></h4></h5>");
				$(".texto1").append("<h5>Errores: <h4 class='text-danger' id='filaserror'></h4></h5>");
			}, 500);
		});

	$("#ejecutar-query").on("click", function (){
		$.ajax({
			method: "POST",
			url: "query.php",
			dataType: "json",
		}).done(function (info){
			console.log(info);
		});
	});

	</script>
  <script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
