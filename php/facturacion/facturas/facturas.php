<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	error_reporting(0); // Eliminamos los mensajes de error de 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Facturas</title>
	<?php include('../../enlaces.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<main class="mdl-layout__content">
				<!-- Encabezado -->
					<div id="encabezado">
						<br><h1 class="text-center"><b>Facturas</b></h1><br>
					</div>
		 				
				<!-- Mensaje de actualizaciones -->
					<div>
						<center><h6 class="mensaje"></h6></center>
					</div>

				<!-- Tabla de Usuarios -->
				<div class="col-12">
					<table id="dt_facturas" class="table table-striped table-hover table-bordered compact" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>								
								<th>Folio</th>
								<th>Orden/Pedido</th>
								<th>Total</th>
								<th>Pagado</th>
								<th>Status</th>
								<th>Fecha de creación</th>
								<th>Cliente</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>								
								<th>Folio</th>
								<th>Orden/Pedido</th>
								<th>Total</th>
								<th>Pagado</th>
								<th>Status</th>
								<th>Fecha de creación</th>
								<th>Cliente</th>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
    	</main>
    <div>
</body>
</html>
<script>
	$(document).on("ready", function(){
		listar_facturas();
	});

	var listar_facturas = function(){      

		$('#dt_facturas tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      });

      var table = $("#dt_facturas").DataTable({
        "destroy": true,
        "scrollX": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
        },
        "columns":[
          {"data": "folio"},
          {"data": "ordenpedido"},
          {"data": "total"},
          {"data": "pagado"},
          {"data": "status"},
          {"data": "fecha"},
          {"data": "cliente"},
          {"defaultContent": "<button class='pdf btn btn-primary'><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Descargar Pdf</button>"},
          {"defaultContent": "<button class='xml btn btn-primary'><i class='fa fa-file-excel-o' aria-hidden='true'></i> Descargar Xml</button>"},
          {"defaultContent": "<button class='cancelar btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i> Cancelar Factura</button>"}
        ],
				"columnDefs": [
					{ "width": "3%", "targets": 0 },
					{ "width": "3%", "targets": 1 },
				],
        "order": [[0, "asc"]],
        "language": idioma_espanol,
        "dom":  
					"<'container row col-12 row'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'Generar PDF',
            "className": "btn iconopdf",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            }
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Generar Excel',
            "className": "btn iconoexcel",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            }
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'Generar CSV',
            "className": "btn iconocsv",
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            }
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprimir',
            header: 'false',
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            },
            "className": "btn iconoimprimir",
            orientation: 'landscape',
            pageSize: 'LEGAL'
          }
          // {
          //   text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> <i class="fa fa-address-card-o" aria-hidden="true"></i>',
          //   "className": "btn btn-success",
          //   titleAttr: 'Agregar Cliente',
          //   action: function (e, dt, node, config){
          //     $("#modalAgregarCliente").modal("show");
          //   }   
          // }
        ]
      });

      	 $("#dt_facturas tfoot input").on( 'keyup change', function () {
	        table
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();    
	      });

      	obtener_pdf_factura("#dt_facturas tbody", table);
      	obtener_xml_factura("#dt_facturas tbody", table);
      	obtener_cancelar_factura("#dt_facturas tbody", table);

    }
	
	var obtener_pdf_factura = function(tbody, table){
      $(tbody).on("click", "button.pdf", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var ordenpedido = data.ordenpedido;
        // console.log(ordenpedido);
        var RFC = data.rfc;

        var request = new XMLHttpRequest();

		request.open('GET', 'http://factura.com/api/v3/cfdi33/list');

		request.setRequestHeader('Content-Type', 'application/json');
		request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
		request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');
		request.setRequestHeader('Access-Control-Allow-Headers', '*');
		request.setRequestHeader('Allow-Control-Allow-Origin', '*');
		request.setRequestHeader('Access-Control-Allow-Credentials', 'true');

		request.onreadystatechange = function () {
		  if (this.readyState === 4) {
		    var data = JSON.parse(this.responseText);
		    console.log(data);	
		    // console.log(ordenpedido);
		    var totalfacturas = data.total;
		    for (var i = 0; i < totalfacturas; i++) {
		    	if (ordenpedido == data.data[i].NumOrder){
		    		console.log(data.data[i]);
		    		var UIDfactura = data.data[i].UID;

		    		var request = new XMLHttpRequest();

					request.open('GET', 'http://factura.com/api/v3/cfdi33/'+UIDfactura+'/pdf');

						request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
						request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');
						request.setRequestHeader('Content-Type', 'application/pdf');
						request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
						request.setRequestHeader('Content-Disposition', 'attachment: filename=F2222.pdf');
						request.setRequestHeader('Access-Control-Allow-Headers', '*');
						request.setRequestHeader('Allow-Control-Allow-Origin', '*');
						request.setRequestHeader('Access-Control-Allow-Credentials', 'true');
						request.responseType = 'blob';
						// header('Content-Type: application/pdf');    
						// header("Content-Transfer-Encoding: Binary");    
						// header("Content-disposition: attachment; filename=F2222.pdf");

						request.onreadystatechange = function () {
						  	if (this.readyState === 4) {
						    	console.log('Status:', this.status);
						    	console.log('Headers:', this.getAllResponseHeaders());
						    	console.log('Body:', this.response);
						    	var blob = new Blob([this.response], {type: 'application/pdf'});
						        var link = document.createElement('a');
						        link.href = window.URL.createObjectURL(blob);
						        link.download = "factura.pdf";
						        link.click();
					        }
						};

						request.send();

					}
		    	}
		    }					   
		}		

		request.send();
      });
  }

	var obtener_xml_factura = function(tbody, table){
      $(tbody).on("click", "button.xml", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var ordenpedido = data.ordenpedido;
        // console.log(ordenpedido);
        var RFC = data.rfc;

        var request = new XMLHttpRequest();

		request.open('GEt', 'http://factura.com/api/v3/cfdi33/list');

		request.setRequestHeader('Content-Type', 'application/json');
		request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
		request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

		request.onreadystatechange = function () {
		  if (this.readyState === 4) {
		    var data = JSON.parse(this.responseText);
		    console.log(data);	
		    // console.log(ordenpedido);
		    var totalfacturas = data.total;
		    for (var i = 0; i < totalfacturas; i++) {
		    	if (ordenpedido == data.data[i].NumOrder){
		    		console.log(data.data[i]);
		    		var UIDfactura = data.data[i].UID;

		    		var request = new XMLHttpRequest();

					request.open('GET', 'http://factura.com/api/v3/cfdi33/'+UIDfactura+'/xml');

						// request.setRequestHeader('Content-Type', 'application/json');
						request.setRequestHeader('Content-type', '"text/xml"; charset="utf8"');
						request.setRequestHeader('Content-disposition', 'attachment; filename="F2222.xml"');    
						request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
						request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

						request.onreadystatechange = function () {
						  if (this.readyState === 4) {
						    console.log('Status:', this.status);
						    console.log('Headers:', this.getAllResponseHeaders());
						    console.log('Body:', this.responseText);
						    var blob = new Blob([this.responseText], {type: 'application/xml'});
					        var link = document.createElement('a');
					        link.href = window.URL.createObjectURL(blob);
					        link.download = "factura.xml";
					        link.click();
						  }
						};

						request.send();

					}
		    	}
		    }					   
		}		

		request.send();
      });
  }

	var obtener_cancelar_factura = function(tbody, table){
      $(tbody).on("click", "button.cancelar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var ordenpedido = data.ordenpedido;
        // console.log(ordenpedido);
        var RFC = data.rfc;

        var request = new XMLHttpRequest();

		request.open('GEt', 'http://factura.com/api/v3/cfdi33/list');

		request.setRequestHeader('Content-Type', 'application/json');
		request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
		request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

		request.onreadystatechange = function () {
		  if (this.readyState === 4) {
		    var data = JSON.parse(this.responseText);
		    console.log(data);	
		    console.log(ordenpedido);
		    var totalfacturas = data.total;
		    for (var i = 0; i < totalfacturas; i++) {
		    	if (ordenpedido == data.data[i].NumOrder){
		    		console.log(data.data[i]);
		    		var UIDfactura = data.data[i].UID;
		    		var folio = data.data[i].Folio;

		    		var request = new XMLHttpRequest();

					request.open('GET', 'http://factura.com/api/v3/cfdi33/'+UIDfactura+'/cancel');

						request.setRequestHeader('Content-Type', 'application/json');
						request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
						request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

						request.onreadystatechange = function () {
						  if (this.readyState === 4) {
						    console.log('Status:', this.status);
						    console.log('Headers:', this.getAllResponseHeaders());
						    console.log('Body:', this.responseText);
						    var data = JSON.parse(this.responseText);

						    if (data.response == "error") {
						    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#C9302C";

								$(".mensaje").html( texto );

						    }else if(data.response = "success"){
						    	texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Bien!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#379911";

								$(".mensaje").html( texto );

								var opcion = "cancelarfactura";
								$.ajax({
									method: "POST",
									url: "guardar.php",
									dataType: "json",
									data: {"opcion": opcion, "folio": folio},
								}).done( function( data ){
									mostrar_mensaje(data);
									listar_facturas();
								});

						  	}
						  }
						};

						request.send();

					}
		    	}
		    }					   
		}		

		request.send();
      });
  }

  // var obtener_pdf_factura = function(tbody, table){
  //     $(tbody).on("click", "button.pdf", function(){
  //       var data = table.row( $(this).parents("tr") ).data();
  //       var ordenpedido = data.ordenpedido;
  //       // console.log(ordenpedido);
  //       var RFC = data.rfc;

  //       var request = new XMLHttpRequest();

	// 	request.open('GET', 'http://devfactura.in/api/v3/cfdi33/list');

	// 	request.setRequestHeader('Content-Type', 'application/json');
	// 	request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 	request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');
	// 	request.setRequestHeader('Access-Control-Allow-Headers', '*');
	// 	request.setRequestHeader('Allow-Control-Allow-Origin', '*');
	// 	request.setRequestHeader('Access-Control-Allow-Credentials', 'true');

	// 	request.onreadystatechange = function () {
	// 	  if (this.readyState === 4) {
	// 	    var data = JSON.parse(this.responseText);
	// 	    console.log(data);	
	// 	    // console.log(ordenpedido);
	// 	    var totalfacturas = data.total;
	// 	    for (var i = 0; i < totalfacturas; i++) {
	// 	    	if (ordenpedido == data.data[i].NumOrder){
	// 	    		console.log(data.data[i]);
	// 	    		var UIDfactura = data.data[i].UID;

	// 	    		var request = new XMLHttpRequest();

	// 				request.open('GET', 'http://devfactura.in/api/v3/cfdi33/'+UIDfactura+'/pdf');

	// 					request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 					request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');
	// 					request.setRequestHeader('Content-Type', 'application/pdf');
	// 					request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
	// 					request.setRequestHeader('Content-Disposition', 'attachment: filename=F2222.pdf');
	// 					request.setRequestHeader('Access-Control-Allow-Headers', '*');
	// 					request.setRequestHeader('Allow-Control-Allow-Origin', '*');
	// 					request.setRequestHeader('Access-Control-Allow-Credentials', 'true');
	// 					request.responseType = 'blob';
	// 					// header('Content-Type: application/pdf');    
	// 					// header("Content-Transfer-Encoding: Binary");    
	// 					// header("Content-disposition: attachment; filename=F2222.pdf");

	// 					request.onreadystatechange = function () {
	// 					  	if (this.readyState === 4) {
	// 					    	console.log('Status:', this.status);
	// 					    	console.log('Headers:', this.getAllResponseHeaders());
	// 					    	console.log('Body:', this.response);
	// 					    	var blob = new Blob([this.response], {type: 'application/pdf'});
	// 					        var link = document.createElement('a');
	// 					        link.href = window.URL.createObjectURL(blob);
	// 					        link.download = "factura.pdf";
	// 					        link.click();
	// 				        }
	// 					};

	// 					request.send();

	// 				}
	// 	    	}
	// 	    }					   
	// 	}		

	// 	request.send();
  //     });
  //   }

  // var obtener_xml_factura = function(tbody, table){
  //     $(tbody).on("click", "button.xml", function(){
  //       var data = table.row( $(this).parents("tr") ).data();
  //       var ordenpedido = data.ordenpedido;
  //       // console.log(ordenpedido);
  //       var RFC = data.rfc;

  //       var request = new XMLHttpRequest();

	// 	request.open('GEt', 'http://devfactura.in/api/v3/cfdi33/list');

	// 	request.setRequestHeader('Content-Type', 'application/json');
	// 	request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 	request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');

	// 	request.onreadystatechange = function () {
	// 	  if (this.readyState === 4) {
	// 	    var data = JSON.parse(this.responseText);
	// 	    console.log(data);	
	// 	    // console.log(ordenpedido);
	// 	    var totalfacturas = data.total;
	// 	    for (var i = 0; i < totalfacturas; i++) {
	// 	    	if (ordenpedido == data.data[i].NumOrder){
	// 	    		console.log(data.data[i]);
	// 	    		var UIDfactura = data.data[i].UID;

	// 	    		var request = new XMLHttpRequest();

	// 				request.open('GET', 'http://devfactura.in/api/v3/cfdi33/'+UIDfactura+'/xml');

	// 					// request.setRequestHeader('Content-Type', 'application/json');
	// 					request.setRequestHeader('Content-type', '"text/xml"; charset="utf8"');
	// 					request.setRequestHeader('Content-disposition', 'attachment; filename="F2222.xml"');    
	// 					request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 					request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');

	// 					request.onreadystatechange = function () {
	// 					  if (this.readyState === 4) {
	// 					    console.log('Status:', this.status);
	// 					    console.log('Headers:', this.getAllResponseHeaders());
	// 					    console.log('Body:', this.responseText);
	// 					    var blob = new Blob([this.responseText], {type: 'application/xml'});
	// 				        var link = document.createElement('a');
	// 				        link.href = window.URL.createObjectURL(blob);
	// 				        link.download = "factura.xml";
	// 				        link.click();
	// 					  }
	// 					};

	// 					request.send();

	// 				}
	// 	    	}
	// 	    }					   
	// 	}		

	// 	request.send();
  //     });
  //   }

  // var obtener_cancelar_factura = function(tbody, table){
  //     $(tbody).on("click", "button.cancelar", function(){
  //       var data = table.row( $(this).parents("tr") ).data();
  //       var ordenpedido = data.ordenpedido;
  //       // console.log(ordenpedido);
  //       var RFC = data.rfc;

  //       var request = new XMLHttpRequest();

	// 	request.open('GEt', 'http://devfactura.in/api/v3/cfdi33/list');

	// 	request.setRequestHeader('Content-Type', 'application/json');
	// 	request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 	request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');

	// 	request.onreadystatechange = function () {
	// 	  if (this.readyState === 4) {
	// 	    var data = JSON.parse(this.responseText);
	// 	    console.log(data);	
	// 	    console.log(ordenpedido);
	// 	    var totalfacturas = data.total;
	// 	    for (var i = 0; i < totalfacturas; i++) {
	// 	    	if (ordenpedido == data.data[i].NumOrder){
	// 	    		console.log(data.data[i]);
	// 	    		var UIDfactura = data.data[i].UID;
	// 	    		var folio = data.data[i].Folio;

	// 	    		var request = new XMLHttpRequest();

	// 				request.open('GET', 'http://devfactura.in/api/v3/cfdi33/'+UIDfactura+'/cancel');

	// 					request.setRequestHeader('Content-Type', 'application/json');
	// 					request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
	// 					request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');

	// 					request.onreadystatechange = function () {
	// 					  if (this.readyState === 4) {
	// 					    console.log('Status:', this.status);
	// 					    console.log('Headers:', this.getAllResponseHeaders());
	// 					    console.log('Body:', this.responseText);
	// 					    var data = JSON.parse(this.responseText);

	// 					    if (data.response == "error") {
	// 					    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
	// 							color = "#C9302C";

	// 							$(".mensaje").html( texto );

	// 					    }else if(data.response = "success"){
	// 					    	texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Bien!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
	// 							color = "#379911";

	// 							$(".mensaje").html( texto );

	// 							var opcion = "cancelarfactura";
	// 							$.ajax({
	// 								method: "POST",
	// 								url: "guardar.php",
	// 								dataType: "json",
	// 								data: {"opcion": opcion, "folio": folio},
	// 							}).done( function( data ){
	// 								mostrar_mensaje(data);
	// 								listar_facturas();
	// 							});

	// 					  	}
	// 					  }
	// 					};

	// 					request.send();

	// 				}
	// 	    	}
	// 	    }					   
	// 	}		

	// 	request.send();
  //     });
  // }

	var mostrar_mensaje = function( informacion ){ // Mensaje que muestra las actualizaciones de cambios 
		var texto = "", color = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
			color = "#379911";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecutó la consulta.</div>";
			color = "#C9302C";
		}else if( informacion.respuesta == "EXISTE" ){
			texto = "<div class='alert alert-warning'><strong>Información!</strong> el usuario ya existe.</div>";
			color = "#5b94c5";
		}

		$(".mensaje").html( texto );
		$(".mensaje").fadeOut(5000, function(){
			$(this).html("");
			$(this).fadeIn(5000);
		}); 
	}

	var idioma_espanol = { // Se cambia el idioma del DT
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
