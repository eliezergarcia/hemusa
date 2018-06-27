<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);
	$factura = $_REQUEST['factura'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Compra Nacional</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Eliezer Hernandez">
	<meta name="description" content="Hemusa, herramientas mecanicas y universales">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!--CSS-->    
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Righteous" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.indigo-pink.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="css/buttons.semanticui.min.css">
    <link rel="stylesheet" href="css/select.semanticui.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.0.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/awesomplete.css">

    <!--Javascript-->    
    <script defer src="js/material.min.js"></script> 
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.material.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/fontawesome.js"></script>
	<script src="js/awesomplete.min.js"></script>


    <!-- Librerias para Exportación de Botones -->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script> 
    <script src="js/buttons.html5.min.js"></script>  
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>

</head>
<body onLoad="self.focus();document.agregarCotizacion.clienteContacto.focus()">
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center titulo">Compra Nacional</h1>
					</div>
				</div>	
				<div class="container-fluid">
					<div id="cuadroCotizaciones" class="">
						<div class="col-sm-offset-2 col-sm-8">
							<h3 class="text-center"> <small class="mensaje"></small></h3>
						</div>
						<div class="container-fluid col" id="info">
							<hr>
							<div class="col-12 row align-items-center">
								<div class="col-2">
									<img src="<?php echo $ruta; ?>media/images/logo_hemusa.png" alt="" width="110%">
								</div>
								<div class="col-8 row justify-content-center">
									<h2><b>HERRAMIENTAS MECÁNICAS UNIVERSALES S.A DE C.V</b></h2>
									<h5 class="col-12 row justify-content-center">RUPERTO MARTÍNEZ 831 PTE, MONTERREY, N.L. C.P. 64000, MÉXICO </h5>
									<h5 class="col-12 row justify-content-center">TELS: (81) 8345-3811, FÁX: (81) 8342-8082 </h5>
									<h5 class="col-12 row justify-content-center">ventas@hemusa.com, www.hemusa.com </h5>
									<h5 class="col-12 row justify-content-center">Portal de clientes: www.hemusa.com.mx </h5>
								</div>
							</div>
							<hr>
							<br>
							<div class="col-12 row justify-content-around align-items-center">
								<div class=""><h6>FECHA: </h5></div>
								<div class=""><h6>CONTROL DE SALIDA DE HERRAMIENTA</h6></div>
								<div class="">
									<h6 class="col-12 justify-content-end"><b>COMPRA NACIONAL</b></h6>
									<h6 class="col-12 justify-content-end">FOLIO: </h6>
								</div>
							</div>
							<br>
						</div>
						<div class="">
							<table id="dt_importacion" class="ui celler table table-hover display start-xs" cellspacing="0" width="100%">
								<thead>
									<tr>								
										<th>#</th>
										<th>Cliente</th>
										<th>Marca</th>
										<th>Modelo</th>
										<th>Cantidad</th>
										<th>Recibido</th>
										<th>Remision</th>
										<th>Factura</th>
										<th>Observaciones</th>
										<th>Proveedor</th>
										<th>Factura Proveedor</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$queryControl = "SELECT * FROM utilidad_pedido WHERE factura_proveedor ='".$factura."' ORDER BY marca ASC, modelo ASC";
									$resultadoControl = mysqli_query($conexion_usuarios, $queryControl);
									$i=1;
									while($row=mysqli_fetch_array($resultadoControl)){
										$resultadoCliente = mysqli_query($conexion_usuarios, "SELECT nombreEmpresa FROM contactos WHERE tipo= 'Cliente' AND id =".$row['cliente']);
										while($rowCliente = mysqli_fetch_array($resultadoCliente)){
											$cliente = $rowCliente['nombreEmpresa'];
										}

										$resultadoProveedor = mysqli_query($conexion_usuarios, "SELECT nombreEmpresa FROM contactos WHERE tipo= 'Proveedor' AND id =".$row['proveedor']);
										while($rowProveedor = mysqli_fetch_array($resultadoProveedor)){
											$proveedor = $rowProveedor['nombreEmpresa'];
										}
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $cliente; ?></td>
										<td><?php echo $row['marca']; ?></td>
										<td><?php echo $row['modelo']; ?></td>
										<td><?php echo $row['cantidad']; ?></td>
										<td class="row justify-content-center"><input type="checkbox" name=""></td>
										<?php
											if($row['remision']!='0'){
										?>
												<td><?php echo $row['remision']; ?></td>
										<?php		
											}else{
										?>
												<td></td>
										<?php
											}
										?>
										<td></td>
										<td></td>
										<td><?php echo $proveedor ?></td>
										<td><?php echo $row['factura_proveedor']; ?></td>
									</tr>
								<?php
									$i++;
									}
								?>
								</tbody>
								<tfoot>
						        </tfoot> 
							</table>
						</div>			
					</div>		
				</div>
      		</main>
    </div>
</body>
</html>
 
	<script>
		$(document).on("ready", function(){
			$('[data-toggle="tooltip"]').tooltip();

			$('#dt_importacion tfoot th').each( function () {
        		var title = $(this).text();
        		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      		});

			var table = $("#dt_importacion").DataTable({
				"destroy":"true",
				"bDeferRender": true,			
				"sPaginationType": "full_numbers",
		        "language": idioma_espanol,
		        "lengthChange": false,
		        "columnDefs": [
		          { "searchable": true, "targets": 0 }
		        ],
		        // "order": [[1, "asc"], [2, "asc"]],
				"language": idioma_espanol,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
					"<'clear'>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                download: 'open',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            			},
            			orientation: 'landscape',
                		pageSize: 'LEGAL',
        //         		customize: function(doc) {
    				// 		doc.content.splice(1, 0, {
	       //  					margin: [10, 15],
	       //  					text: 'Esto puede contener informacion del usuario',
	       //  					fontSize: 15			
    				// 		});
  						// }
  						customize: function (pdf) {
							return "My header here....\n\n"+  pdf +"\n\nMy Footer here.....";
						}
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i> Almacén',
		            	titleAttr: 'Imprimir',
		            	title: '',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 2, 3, 4, 5, 1, 9, 10 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			customize: function(window) {
            				$( window.document.body )
		                    	.addClass( 'asset-print-body' )
		                    	.css( {
		                        	margin: '10px'
		                        	/* Etc CSS Styles..*/
		                    	});
   							$(window.document.body).children().eq(0).after(document.getElementById("info").innerHTML);
  						}
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i> Facturación',
		            	titleAttr: 'Imprimir',
		            	title: '',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL',
            			customize: function(window) {
            				$( window.document.body )
		                    	.addClass( 'asset-print-body' )
		                    	.css( {
		                        	margin: '10px'
		                        	/* Etc CSS Styles..*/
		                    	});
   							$(window.document.body).children().eq(0).after(document.getElementById("info").innerHTML);
  						}
		            }
				]
			});

			$("#dt_importacion tfoot input").on( 'keyup change', function () {
        		table
            		.column( $(this).parent().index()+':visible' )
            		.search( this.value )
            		.draw();		
    		});
		});

		var idioma_espanol = {
			"sProcessing":     "Procesando...",
   			"sLengthMenu":     "Mostrar _MENU_ registros",
    		"sZeroRecords":    "No se encontraron resultados",
    		"sEmptyTable":     "Ningún dato disponible en esta tabla",
    		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix":    "",
    		"sSearch":         "<a class='btn searchBtn' id='searchBtn'><i class='fa fa-search'></i></a> ",
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