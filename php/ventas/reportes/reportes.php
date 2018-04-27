<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Reportes</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <main class="mdl-layout__content">
		<!-- Breadcrumb -->
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">             
				<li class="breadcrumb-item">Ventas</li>
				<li class="breadcrumb-item active">Reportes</li>
			</ol>
			</nav>

    			<div class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center titulo">Reportes</h1>
						<br><h3 class="text-center titulo">Herramienta</h3>
					</div>
				</div>	
				<br>
				<div class="container-fluid col mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
				  	<header class="mdl-layout__header">
				    	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
					      	<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Sin factura</a>
					      	<a href="#fixed-tab-2" class="mdl-layout__tab">Sin entregar</a>
				    	</div>
				  	</header>
				  	<main class="mdl-layout__content">
				    	<section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
				      		<div class="page-content">
				      			<br>
				      			<div class="container">
									<div id="cuadroCotizaciones" class="">
										<div class="">
											<table id="dt_herramienta_sin_factura" class="ui celler table table-hover display start-xs" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>Ref. Cotización</th>								
														<th>Marca</th>
														<th>Modelo</th>
														<th>Cantidad</th>
														<th>Cliente</th>
														<th>Pedido Cliente</th>
														<th>Remision</th>
													</tr>
												</thead>
												<tbody>
												<?php

													$querySinFactura = "SELECT * FROM cotizacionherramientas WHERE factura = '0' AND remision != '0' AND cotizacionRef != ''";
													$resSinFactura = mysqli_query($conexion_usuarios, $querySinFactura);
													while($dataSinFactura = mysqli_fetch_array($resSinFactura)){
														
														$queryPedidoCliente = "SELECT NoPedClient FROM cotizacion WHERE ref= '".$dataSinFactura['cotizacionRef']."'";
														$resPedidoCliente = mysqli_query($conexion_usuarios, $queryPedidoCliente);
														while($dataPedidoCliente = mysqli_fetch_array($resPedidoCliente)){
															$pedidoCliente = $dataPedidoCliente['NoPedClient'];
														}

														$queryCliente = "SELECT nombreEmpresa FROM contactos WHERE id= '".$dataSinFactura['cliente']."'";
														$resCliente = mysqli_query($conexion_usuarios, $queryCliente);
														while($dataCliente = mysqli_fetch_array($resCliente)){
															$cliente = $dataCliente['nombreEmpresa'];
														}
												?>
													<tr>
														<td><?php echo $dataSinFactura['cotizacionRef']; ?></td>
														<td><?php echo $dataSinFactura['marca']; ?></td>
														<td><?php echo $dataSinFactura['modelo']; ?></td>
														<td><?php echo $dataSinFactura['cantidad']; ?></td>
														<td><?php echo utf8_encode($cliente); ?></td>
														<td><?php echo $pedidoCliente; ?></td>
														<td><?php echo $dataSinFactura['remision']; ?></td>
													</tr>
												<?php
													}
												?>
												</tbody>
												<tfoot>
													<tr>
														<th>Ref. Cotización</th>								
														<th>Marca</th>
														<th>Modelo</th>
														<th>Cantidad</th>
														<th>Cliente</th>
														<th>Pedido Cliente</th>
														<th>Remision</th>
													</tr>
										        </tfoot> 
											</table>
										</div>	
									</div>		
								</div>
				      		</div>
				    	</section>
				    	<section class="mdl-layout__tab-panel" id="fixed-tab-2">
				      		<div class="page-content">
				      			<br>
				      			<div class="container">
									<div id="cuadroCotizaciones" class="">
										<div class="col-sm-offset-2 col-sm-8">
											<h3 class="text-center"> <small class="mensaje"></small></h3>
										</div>
										<div class="">
											<table id="dt_herramienta_sin_entregar" class="ui celler table table-hover display start-xs" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>Ref. Cotización</th>								
														<th>Marca</th>
														<th>Modelo</th>
														<th>Cantidad</th>
														<th>Cliente</th>
														<th>Pedido Cliente</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$resSinFactura = mysqli_query($conexion_usuarios, "SELECT * FROM cotizacionherramientas WHERE factura = '0' AND remision = '0' AND cotizacionRef != ''");
													while($dataSinFactura = mysqli_fetch_array($resSinFactura)){
														
														$resPedidoCliente = mysqli_query($conexion_usuarios, "SELECT NoPedClient FROM cotizacion WHERE ref= '".$dataSinFactura['cotizacionRef']."'");
														while($dataPedidoCliente = mysqli_fetch_array($resPedidoCliente)){
															$pedidoCliente = $dataPedidoCliente['NoPedClient'];
														}

														$resCliente = mysqli_query($conexion_usuarios, "SELECT nombreEmpresa FROM contactos WHERE id= '".$dataSinFactura['cliente']."'");
														while($dataCliente = mysqli_fetch_array($resCliente)){
															$cliente = $dataCliente['nombreEmpresa'];
														}
												?>
													<tr>
														<td><?php echo $dataSinFactura['cotizacionRef']; ?></td>
														<td><?php echo $dataSinFactura['marca']; ?></td>
														<td><?php echo $dataSinFactura['modelo']; ?></td>
														<td><?php echo $dataSinFactura['cantidad']; ?></td>
														<td><?php echo utf8_encode($cliente); ?></td>
														<td><?php echo $pedidoCliente; ?></td>
													</tr>
												<?php
													}
												?>
												</tbody>
												<tfoot>
													<tr>
														<th>Ref. Cotización</th>								
														<th>Marca</th>
														<th>Modelo</th>
														<th>Cantidad</th>
														<th>Cliente</th>
														<th>Pedido Cliente</th>
													</tr>
										        </tfoot>  
											</table>
										</div>	
									</div>		
								</div>
				      		</div>
				    	</section>
				  	</main>
				</div>

				
      		</main>
    </div>
</body>
</html>
 
	<script>
		$(document).on("ready", function(){
			$('[data-toggle="tooltip"]').tooltip();

			var table = $("#dt_herramienta_sin_factura").DataTable({
				"destroy":"true",
				"bDeferRender": true,			
				"sPaginationType": "full_numbers",				
		        "language": idioma_espanol,
		        "lengthChange": false,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +					
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'i>>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                messageTop: 'Herramienta sin factura',
		                download: 'open',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
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