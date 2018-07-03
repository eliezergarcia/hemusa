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
                                    <th>Codigo</th>
                                    <th>Clave</th>
                                    <th>Descripcion</th>
                                    <th>Precio Lista</th>
                                    <th>Marca</th>
                                    <th>Clave Sat</th>
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
			$("#mod-success").modal("show");
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
                { "data": "CODIGO" },
                { "data": "CLAVE" },
                { "data": "DESCRIPCION LARGA" },
                { "data": "PRECIO LISTA" },
                { "data": "MARCA" },
                { "data": "CLAVE SAT" }
            ],
            "language": idioma_espanol,
    				"dom":
  	    			"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
  	    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
  	    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
          });
					setTimeout(function () {
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
					}, 2000);
					setTimeout(function () {
						// $(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
						// $(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<br>");
							$(".texto1").append("<br>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<h3>La lista de precios se está actualizando.</h3>");
							$(".texto1").append("<h4>Este proceso puede demorar algunos minutos.</h4>");
							$(".texto1").append("</div>");
							$(".texto1").append("<br>");
							$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
							$(".texto1").append("<br>");
							$(".texto1").append("<h4><label id='numeroi'></label> filas de <label id='numeroj'></label> actualizadas</h4>");
						}, 2500);
					var opcion = "subirlista";
					var lista = data.data;
					var j = 251;
					// document.getElementById("numeroj").innerHTML = "Hola";
					setTimeout(function () {
						$('#numeroj').html(j-1);
						}, 2500);
						var filascorrectas = 0;
						var filaserror = 0;
					for (var i = 0; i < j; i++) {
						var lista = JSON.stringify(data.data[i]);
						console.log(lista);
						console.log(i);
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
								console.log(filascorrectas);
								if (filascorrectas == (j-1)) {
									setTimeout(function () {
										$(".texto1").fadeOut(300, function(){
											$(this).html("");
											$(this).fadeIn(300);
										});
									}, 2000);
									setTimeout(function () {
										$(".texto1").append("<br>");
										$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
										$(".texto1").append("<h3>Correcto!</h3>");
										$(".texto1").append("<h4>La lista de precios se actualizó correctamente.</h4>");
										// $(".texto1").append("<div class='text-center'>");
										// $(".texto1").append("<p>En un momento se descargará el archivo PDF.</p>");
										// $(".texto1").append("</div>");
										console.log(lista.length);
									}, 2500);
								}
							}else{
								filaserror = parseInt(filaserror) + 1;
							}
						});
					}
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


		// var listar = function(){
		// 	var palabraBusca = $("#palabraBusca").val(),
		// 		marcaBuscar = $("#marcaBuscar").val();
    //
		// 	if (marcaBuscar == "") {
		// 		marcaBuscar = "todo";
		// 	}
		// 	console.log(palabraBusca);
		// 	console.log(marcaBuscar);
		// 	var table = $("#dt_precios").DataTable({
		// 		"destroy":"true",
		// 		"bDeferRender": true,
		// 		"scrollX": true,
		// 		"sPaginationType": "full_numbers",
		// 		"ajax":{
		// 			"method":"POST",
		// 			"url":"listar_precios.php",
		// 			"data": {
		// 				"palabraBusca": palabraBusca,
		// 				"marcaBuscar": marcaBuscar
		// 			}
		// 		},
		// 		"columns":[
		// 			{"data":"marca"},
		// 			{"data":"modelo"},
		// 			{"data":"descripcion"},
		// 			{"data":"precioLista"},
		// 			{"data":"precioIVA"},
		// 			{"data":"almacen"},
		// 			{"data":"moneda"},
		// 			{"data":"clase"},
		// 			{"data":"igi"},
		// 			{"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-lg btn-primary' data-toggle='modal' data-target='#modalInformacion'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		// 		],
    //     "lengthChange": false,
		// 		"language": idioma_espanol,
		// 		"dom":
    // 			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
    // 			"<'row be-datatable-body'<'col-sm-12'tr>>" +
    // 			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
		// 		"createdRow": function ( row, data, index ) {
		// 			console.log(data.clase);
		// 			if ( data.clase == "E" ) {
		// 					$('td', row).eq(0).addClass('table-text-claseE');
		// 					$('td', row).eq(1).addClass('table-text-claseE');
		// 					$('td', row).eq(2).addClass('table-text-claseE');
		// 					$('td', row).eq(3).addClass('table-text-claseE');
		// 					$('td', row).eq(4).addClass('table-text-claseE');
		// 					$('td', row).eq(5).addClass('table-text-claseE');
		// 					$('td', row).eq(6).addClass('table-text-claseE');
		// 					$('td', row).eq(7).addClass('table-text-claseE');
		// 					$('td', row).eq(8).addClass('table-text-claseE');
		// 			}
		// 			if ( data.clase == "D" ) {
		// 					$('td', row).eq(0).addClass('table-text-claseD');
		// 					$('td', row).eq(1).addClass('table-text-claseD');
		// 					$('td', row).eq(2).addClass('table-text-claseD');
		// 					$('td', row).eq(3).addClass('table-text-claseD');
		// 					$('td', row).eq(4).addClass('table-text-claseD');
		// 					$('td', row).eq(5).addClass('table-text-claseD');
		// 					$('td', row).eq(6).addClass('table-text-claseD');
		// 					$('td', row).eq(7).addClass('table-text-claseD');
		// 					$('td', row).eq(8).addClass('table-text-claseD');
		// 			}
		// 		},
		// 		"buttons":[
		//             {
		//             extend: 'collection',
		//             text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
		//             "className": "btn btn-lg btn-space btn-secondary",
		//             buttons: [
		//                 {
		//                   extend:    'excelHtml5',
		//                   text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
		//                   // "className": "btn btn-lg btn-space btn-secondary",
		//                   exportOptions: {
		//                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		//                   }
		//                 },
		//                 {
		//                   extend: 'csv',
		//                   text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
		//                   // "className": "btn btn-lg btn-space btn-secondary",
		//                   exportOptions: {
		//                           columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		//                   }
		//                 },
		//                 {
		//                   extend:    'pdfHtml5',
		//                   text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
		//                   download: 'open',
		//                   // "className": "btn btn-lg btn-space btn-secondary",
		//                   exportOptions: {
		//                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		//                   }
		//                 },
		//                 {
		//                   extend: 'print',
		//                   text: '<i class="fas fa-print fa-lg"></i> Imprimir',
		//                   header: 'false',
		//                   exportOptions: {
		//                           columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		//                   },
		//                   orientation: 'landscape',
		//                   pageSize: 'LEGAL'
		//                 }
		//             ]
		//           }
		// 		]
		// 	});
    //
		// 	obtener_data_herramienta("#dt_precios tbody", table);
		// }

	</script>
  <script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
