<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	error_reporting(0); // Eliminamos los mensajes de error de 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Facturas</title>
	<?php include('../../enlacescss.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Facturas</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Facturación</a></li>
	                    <li class="breadcrumb-item"><a href="#">Facturas</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                          		<!-- Tabla de Facturas -->
									<table id="dt_facturas" class="table table-striped table-hover display compact" cellspacing="0" width="100%" >
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
	      	App.pageCalendar();
	      	App.formElements();
	      	App.uiNotifications();
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
	          {"defaultContent": "<div class='invoice-footer'><button class='pdf btn btn-lg btn-primary'><i class='fas fa-file-pdf fa-sm' aria-hidden='true'></i> Descargar Pdf</button></div>"},
	          {"defaultContent": "<div class='invoice-footer'><button class='xml btn btn-lg btn-primary'><i class='fas fa-file-alt fa-sm' aria-hidden='true'></i> Descargar Xml</button></div>"},
	          {"defaultContent": "<div class='invoice-footer'><button class='cancelar btn btn-lg btn-danger'><i class='fas fa-trash fa-sm' aria-hidden='true'></i> Cancelar Factura</button></div>"}
	        ],
					"columnDefs": [
						{ "width": "3%", "targets": 0 },
						{ "width": "3%", "targets": 1 },
					],
	        "order": [[0, "asc"]],
	        "language": idioma_espanol,
	        "dom":
	    		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	    		"<'row be-datatable-body'<'col-sm-12'tr>>" +
	    		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
	        "buttons":[
	        	{
		            extend: 'collection',
		            text: 'Exportar tabla',
		            "className": "btn btn-lg btn-space btn-secondary",
		            buttons: [
		                {
		                  extend:    'excelHtml5',
		                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
		                  }
		                },
		                {
		                  extend: 'csv',
		                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
		                  }
		                },
		                {
		                  extend:    'pdfHtml5',
		                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
		                  download: 'open',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
		                  }
		                },
		                {
		                  extend: 'print',
		                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
		                  header: 'false',
		                  exportOptions: {
		                          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
		                  },
		                  orientation: 'landscape',
		                  pageSize: 'LEGAL'
		                }
		            ]
		        },  
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

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
