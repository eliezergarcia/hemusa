<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Query</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>

	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Query</b></h2>
              	<!-- <nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Subir lista de precios</a></li>
	                </ol>
              	</nav> -->
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                            <div class="row col-4">
                              <input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
				                      <!-- <input id="csv-file" name="files" accept=".csv" type="file" class="form-control">
				                      <label class="btn-secondary" for="files"> <i class="mdi mdi-upload"></i><span>Selecciona un archivo...					</span></label> -->
                            </div>
                            <br>
														<button type="button" name="button" id="ejecutar-query" onclick="query_payments()" class="btn btn-lg btn-primary">Ejecutar Query</button>

                            <!-- Tabla Lista de precios -->
                              <table id="example" class="ui celler table" width="100%">
                                <thead>
                                  <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
																		<th>Cliente</th>
                                    <th>Moneda</th>
																		<th>Status</th>
																		<th>IVA</th>
																		<th>Subtotal</th>
																		<th>Total</th>
                                    <th>TC</th>
                                  </tr>
                                </thead>
                              </table>
                      		</div>
                    	</div>
                	</div>
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
			$("#query-menu").addClass("active");
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
          var j = (data.data).length;
					console.log(data);
          $('#example').DataTable( {
            data: data.data,
            "columns": [
                { "data": "FOLIO"},
                { "data": "FECHA"},
                { "data": "CLIENTES"},
                { "data": "MONEDA"},
                { "data": "STATUS"},
                { "data": "IVA"},
                { "data": "BASE SUBTOTAL"},
								{ "data": "IMPORTE TOTAL"},
								{ "data": "TC"}
            ],
            "language": idioma_espanol,
    				"dom":
  	    			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
  	    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
  	    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
						"buttons":[
              {
								text: '<i class="fas fa-upload"></i> Query payments',
								"className": "btn btn-lg btn-space btn-primary query",
								titleAttr: 'Subir lista',
								action: function ( e, dt, node, config ) {
									query_payments(data.data);
								}
							},
							{
								text: '<i class="fas fa-upload"></i> Query',
								"className": "btn btn-lg btn-space btn-primary query",
								titleAttr: 'Subir lista',
								action: function ( e, dt, node, config ) {
									query(data.data, j);
								}
							}
						]
          });

				}
			});
		}

    function query_payments(lista){
			// var request = new XMLHttpRequest();
			//
			// request.open('GET', apiConfig.enlace+'api/v3/cfdi33/list?per_page=38');
			//
			// request.setRequestHeader('Content-Type', 'application/json');
			// request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			// request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);
			//
			// request.onreadystatechange = function () {
			//   if (this.readyState === 4) {
			//     console.log('Status:', this.status);
			//     console.log('Headers:', this.getAllResponseHeaders());
			// 		var data = JSON.parse(this.responseText);
			// 		console.log(data);
			// 		var facturas = JSON.stringify(data.data);
			// 		var opcion = "querypayments";
			// 		$.ajax({
			// 			method: "POST",
			// 			url: "guardar.php",
			// 			dataType: "json",
			// 			data: {"opcion": opcion, "facturas": facturas},
			// 		}).done( function( info ){
			// 			console.log(info);
			// 		});
			//   }
			// };
			//
			// request.send();
			var opcion = "querypayments";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion},
			}).done( function( info ){
				console.log(info);
			});
    }

		function query(lista, j){
			var lista = JSON.stringify(lista);
      // console.log(lista);
      var opcion = "query";
      var filascorrectas = 0;
      var filaserror = 0;
      var filasexistentes = 0;
      var filascanceladas = 0;
      var arregloErrores = new Array();
      var  totales = 0;
      console.log(j);
      for (var i = 0; i <= 500; i++) {
        var lista = JSON.stringify(data.data[i]);
        $.ajax({
          method: "POST",
          url: "guardar.php",
          dataType: "json",
          data: {"opcion": opcion, "lista": lista, "indice": i},
        }).done( function( info ){
          console.log(info);
          if (info.respuesta == "BIEN") {
            filascorrectas = parseInt(filascorrectas) + 1;
            totales = totales + 1;
          }else if (info.respuesta == "CANCELADA"){
            filascanceladas = parseInt(filascanceladas) + 1;
            totales = totales + 1;
          }else if(info.respuesta == "EXISTE"){
            filasexistentes = parseInt(filasexistentes) + 1;
            totales = totales + 1;
          }else{
            filaserror = parseInt(filaserror) + 1;
            totales = totales + 1;
            arregloErrores.push(info);
          }
          if (info.indice == (j)) {
            console.log("Correctos: "+filascorrectas);
            console.log("Errores: "+filaserror);
            console.log("Canceladas: "+filascanceladas);
            console.log("Existe: "+filasexistentes);
            console.log("Totales: "+totales);
            console.log("Arreglo de errores: "+JSON.stringify(arregloErrores));
          }
        });
      }
		}


	</script>
  <script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
