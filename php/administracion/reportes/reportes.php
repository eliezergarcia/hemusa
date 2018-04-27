<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Reportes administración</title>
	<?php include('../../enlaces.php'); ?>
</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<!-- Breadcrumb -->
	    			<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">				    	
					    	<li class="breadcrumb-item">Administración</li>
					    	<li class="breadcrumb-item active" aria-current="page">Reportes</li>
					  	</ol>
					</nav>
				
				<!-- Titulo -->
	    			<div class="row fondo align-itmes-center">
						<div class="col-sm-12">
							<h1 class="text-center titulo"><b>Reportes</b> <i class="material-icons icono">insert_chart</i></h1>
						</div>
					</div>	
					<br>
				
				<!-- Dropdown de Reportes -->
					<div class="dropdown row justify-content-center">
					  	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    	Mostrar Reporte
					  	</button>
					  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    	<a class="dropdown-item" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Reporte de Bancos</a>
					    	<a class="dropdown-item" data-toggle="collapse" href="#collapseReporteImpuestos" role="button" aria-expanded="false" aria-controls="collapseReporteImpuestos">Reporte de Impuestos</a>
					    	<a class="dropdown-item" data-toggle="collapse" href="#collapseReporteAcumulados" role="button" aria-expanded="false" aria-controls="collapseReporteAcumulados">Reporte de Acumulados</a>
					    	<a class="dropdown-item" data-toggle="collapse" href="#collapseReporteComisiones" role="button" aria-expanded="false" aria-controls="collapseReporteComisiones">Reporte de Comisiones</a>
							<a class="dropdown-item" data-toggle="collapse" href="#collapseReportePedidosSinOC" role="button" aria-expanded="false" aria-controls="collapseReportePedidosSinOC">Reporte de Pedidos sin OC</a>
							<a class="dropdown-item" data-toggle="collapse" href="#collapseReporteCobranza" role="button" aria-expanded="false" aria-controls="collapseReporteCobranza">Reporte de Cobranza</a>			   	
							<a class="dropdown-item" data-toggle="collapse" href="#collapseHerramientaSinEntregar" role="button" aria-expanded="false" aria-controls="collapseHerramienta" id="btn_listar_herramienta_sin_entregar">Reporte de de Herramienta sin Entregar</a>
							<a class="dropdown-item" data-toggle="collapse" href="#collapseHerramientaSinFactura" role="button" aria-expanded="false" aria-controls="collapseHerramienta" id="btn_listar_herramienta_sin_factura">Reporte de de Herramienta sin Factura</a>
					  	</div>
					</div>				

				<!-- Collapse Reporte de Impuestos-->
					<br>
						<div class="collapse col-12 " id="collapseReporteImpuestos">
							<div class="card card-body">
								<div class="container row justify-content-center">
									<div>
										<form id="frmMostrarImpuestos" action="" method="POST" class="row justify-content-center">
											<input name="ano_impuestos" id="anoImpuestos" type="text" class="form-control col-5 row justify-content-center" placeholder="Ingresa un año">&nbsp;&nbsp;&nbsp;&nbsp;
											<button id="btn_listar_impuestos" type="button" class="btn btn-primary">Mostar</button>
										</form>
									</div>
									<br><br>
								</div>
								<div id="titulo_impuestos">
	  								<br><center><h3>Reporte de Impuestos <label for="" id="tituloAnoImpuestos"></label></h3></center><br>
	  							</div>
	  							<table id="dt_impuestos" class="table table-bordered display" cellspacing="0" width="100%">
	  								<thead>
	  									<tr>
		  									<th>Impuesto</th>
		  									<th>Enero</th>
		  									<th>Febrero</th>
		  									<th>Marzo</th>
		  									<th>Abril</th>
		  									<th>Mayo</th>
		  									<th>Junio</th>
		  									<th>Julio</th>
		  									<th>Agosto</th>
		  									<th>Septiembre</th>
		  									<th>Octubre</th>
		  									<th>Noviembre</th>
		  									<th>Diciembre</th>
		  									<th>Total</th>
		  								</tr>
	  								</thead>
	  							</table>
							</div>
						</div>	

				<!-- Collapse Reporte de Acumulados -->
					<br>
						<div class="collapse col-12 " id="collapseReporteAcumulados">
							<div class="card card-body">
								<div class="container row justify-content-center">
									<div>
										<form id="frmMostrarAcumulados" action="" method="POST" class="row justify-content-center">
											<input name="ano_impuestos" id="anoAcumulados" type="text" class="form-control col-5 row justify-content-center" placeholder="Ingresa un año">&nbsp;&nbsp;&nbsp;&nbsp;
											<button id="btn_listar_acumulados" type="button" class="btn btn-primary">Mostar</button>
										</form>
									</div>
									<br><br>
								</div>
								<div id="titulo_acumulados">
	  								<br><center><h3>Reporte de Acumulados <label id="anoImpuestos"></label></h3></center><br>
	  							</div>
	  							<table id="dt_acumulados" class="table table-bordered display" cellspacing="0" width="100%">
	  								<thead>
	  									<tr>
		  									<th>Reporte</th>
		  									<th>Enero</th>
		  									<th>Febrero</th>
		  									<th>Marzo</th>
		  									<th>Abril</th>
		  									<th>Mayo</th>
		  									<th>Junio</th>
		  									<th>Julio</th>
		  									<th>Agosto</th>
		  									<th>Septiembre</th>
		  									<th>Octubre</th>
		  									<th>Noviembre</th>
		  									<th>Diciembre</th>
		  									<th>Total</th>
		  								</tr>
	  								</thead>
	  							</table>
							</div>
						</div>
				
				<!-- Collapse Reporte Pedidos Sin OC -->
						<div class="collapse col-12 " id="collapseReportePedidosSinOC">
	  						<div class="card card-body">
	  							<div id="titulo_pedidosSinOC">
	  								<center><h3>Reporte de Pedidos sin Orden de Compra</h3></center><br>
	  								<center><h6>Pedidos sin proveedor asignado y que están pendientes de crear OC</h6></center>
	  							</div>
	    						<br>
	    						<br>
	    						<?php
									//Se busca el nombre del proveedor 
									$sql_pedidos_pendientes ="SELECT * FROM  `cotizacionherramientas` WHERE  `Proveedor` !=  'none' AND `Proveedor` !=  'ALMACEN' AND  `proveedorFecha` =  '0000-00-00' AND  `Pedido` =  'si'  AND pedidoFecha > '2015-01-01' order by Proveedor";

									$resultado_pedidos=mysqli_query($conexion_usuarios, $sql_pedidos_pendientes);
									$count=0;
									$resultado_proveedor=mysqli_query($conexion_usuarios, $sql_pedidos_pendientes);

									while($row_proveedor =mysqli_fetch_array($resultado_proveedor)){
										$filtro_proveedor[$count]=$row_proveedor['Proveedor'];	
										$count ++;
									}

									$filtro_proveedor= array_values(array_unique($filtro_proveedor));

									echo '<table id="dt_pedidos_sin_oc" class="table table-bordered table-striped table-hover compact" cellspacing="0" width="100%">';
									echo '<thead><tr>';
									echo '<th> # </th>';
									echo '<th>Proveedor';
									echo '</th>';

									echo '<th> Cliente  </th>';
									echo '<th> Marca </th>';
									echo '<th> Modelo </th>';
									echo '<th> Descripcion </th>';
									echo '<th> Cantidad </th>';
									echo '<th> Fecha de Pedido </th>';
									echo '<th> Almacen </th>';
									echo '<th> Costo </th>';
									echo '</tr></thead>';

									$i=0;

									if(!empty($_POST["proveedor_oc"])){
									
										$nombre_proveedor=$_POST["proveedor_oc"];
										echo $nombre_proveedor;
									
										if($nombre_proveedor!='Proveedor'){
											$sql_pedidos_pendientes ="SELECT * FROM  `cotizacionherramientas` WHERE  `Proveedor` ='$nombre_proveedor' AND proveedorFecha` =  '0000-00-00' AND  `Pedido` =  'si'  AND pedidoFecha > '2015-01-01' order by Proveedor";
												$resultado_pedidos=mysqli_query($conexion_usuarios, $sql_pedidos_pendientes);
											}
									}

									while($row_pedidos =mysqli_fetch_array($resultado_pedidos)){

										$cliente=$row_pedidos['cliente'];

										// nombre_cliente
											$sql_nombre_cliente ="SELECT nombreEmpresa FROM contactos WHERE id= '".$cliente."'";
											$resultado_nombre=mysqli_query($conexion_usuarios, $sql_nombre_cliente);

											if(!$resultado_nombre=mysqli_query($conexion_usuarios, $sql_nombre_cliente)){
												$nombre_cliente="";
											}else{
												while($row_nombre =mysqli_fetch_array($resultado_nombre)){
													$nombre_cliente=$row_nombre['nombreEmpresa'];				
												}
											}

										$marca=$row_pedidos['marca'];	
										$modelo=$row_pedidos['modelo'];	
										$cantidad=$row_pedidos['cantidad'];	
										$descripcion=$row_pedidos['descripcion'];	
										$pedido_fecha=$row_pedidos['pedidoFecha'];	
										$proveedor=$row_pedidos['Proveedor'];	

										// numero_proveedor
											$sql_id_contacto ="SELECT id FROM  `contactos` WHERE  `nombreEmpresa` = '$proveedor'"; 
											$resultado_id=mysqli_query($conexion_usuarios, $sql_id_contacto);

											while($row_id =mysqli_fetch_array($resultado_id)){
												$numero_proveedor=$row_id['id'];	
											}										

										// tabla	
											$tabla="";	
											$sql_buscar_tabla ="SELECT tabla FROM  `factores_proveedores` WHERE  `proveedor` = '$numero_proveedor'";
											$resultado_tabla=mysqli_query($conexion_usuarios, $sql_buscar_tabla);

											if(!$resultado_tabla=mysqli_query($conexion_usuarios, $sql_buscar_tabla)){
												$tabla="todas";
											}else{
												while($row_tabla =mysqli_fetch_array($resultado_tabla)){
													$tabla=$row_tabla['tabla'];				
												}
											}
											
											if(empty($tabla)){
												$tabla="todas";
											}

										// precio_modelo
											if($tabla == 'todas' ){
												$sql_buscar_costo ="SELECT precioBase FROM  `precio".$marca."` WHERE  `ref` = '$modelo'";
											}else{
												$sql_buscar_costo ="SELECT precioBase FROM  `".$tabla."` WHERE  `ref` = '$modelo'";
											}

											$resultado_precio=mysqli_query($conexion_usuarios, $sql_buscar_costo);

											if(!$resultado_precio=mysqli_query($conexion_usuarios, $sql_buscar_costo)){
												$precio_modelo=0;
												
											}else{
												while($row_precio =mysqli_fetch_array($resultado_precio)){
													$precio_modelo=$row_precio['precioBase'];				
												}
											}
											
											if(empty($precio)){
												$precio_modelo=0;
											}
										
										// factor
											$sql_factor="SELECT factor_proveedor from factores_proveedores WHERE proveedor='$numero_proveedor' ";
											$result_factor = mysqli_query($conexion_usuarios, $sql_factor);
											$row_factor_proveedor=0.0;

											while($row_factores= mysqli_fetch_array($result_factor)){
											   $factor= $row_factores["factor_proveedor"];

												if($row_factor_proveedor==0){
													$row_factor_proveedor+=$factor;
												}else{
											   		$row_factor_proveedor= $row_factor_proveedor*$factor;
												}
											}

											$factor= $row_factor_proveedor; 

											if(empty($factor_proveedor)){
												$factor=1;
											}
	
										$precio_modelo=$precio_modelo*$factor;
										$precio_modelo=number_format($precio_modelo,2,".",""); //obtener 2 decimales

										// almacen
											$sql_buscar_stock ="SELECT enReserva FROM  `precio".$marca."` WHERE `ref` = '$modelo'";
											$resultado_stock=mysqli_query($conexion_usuarios, $sql_buscar_stock);

											if(!$resultado_stock=mysqli_query($conexion_usuarios, $sql_buscar_stock)){
												$almacen=0;
											}else{
												while($row_stock =mysqli_fetch_array($resultado_stock)){
													$almacen=$row_stock['enReserva'];				
												}
											}
											
											if(empty($almacen)){
												$almacen=0;
											}

											$i++;
										
										echo '<tr>';
										echo '<td valign="top">'.$i.'</td>';
										echo '<td valign="top">'.$proveedor.'</td>';
										echo '<td valign="top">'.$nombre_cliente.'</td>';
										echo '<td valign="top">'.$marca.'</td>';
										echo '<td valign="top">'.$modelo.'</td>';
										echo '<td valign="top">'.utf8_encode($descripcion).'</td>';
										echo '<td valign="top">'.$cantidad.'</td>';
										echo '<td valign="top">'.$pedido_fecha.'</td>';
										echo '<td valign="top">'.$almacen.'</td>';
										echo '<td valign="top">'.$precio_modelo.'</td>';
										
										echo '</tr>';
									}
									// echo '<tfoot><tr>';
									// echo '<th> # </th>';
									// echo '<th>Proveedor';
									// echo '</th>';

									// echo '<th> Cliente  </th>';
									// echo '<th> Marca </th>';
									// echo '<th> Modelo </th>';
									// echo '<th> Descripcion </th>';
									// echo '<th> Cantidad </th>';
									// echo '<th> Fecha de Pedido </th>';
									// echo '<th> Almacen </th>';
									// echo '<th> Costo </th>';
									// echo '</tr></tfoot>';

									echo '</table>';
								?>
	  						</div>
						</div>					

				<!-- Collapse Reporte de Cobranza -->
					<div class="collapse col-12 " id="collapseReporteCobranza">
						<div class="card card-body">
							<div class="container">
								<form id="frmMostrarCobranza" method="post">
									<div class="form-group row justify-content-center align-itmes-center">
										<label for="fechaInicio" class="label-control col-2">Fecha inicio:</label>
										<input type="date" id="fechaInicio" name="fechaInicio" class="form-control col-2">
									</div>
									<div class="form-group row justify-content-center align-itmes-center">
										<label for="fechaFin" class="label-control col-2">Fecha fin:</label>
										<input type="date" id="fechaFin" name="fechaFin" class="form-control col-2">
									</div>
									<div class="form-group row justify-content-center">
										<button id="btn_listar_cobranza" type="button" class="btn btn-primary">Mostrar</button>
									</div>
								</form>
							</div>
							<div id="titulo_reporteCobranza">
	  							<br><center><h2>Reporte de Cobranza</h2></center><br>
		  						<div class="col-12">
		  							<h3><b>PERIODO:</b></h3>
		  							<h4><label id="valFechaInicio"></label> - <label id="valFechaFin"></label></h4>
		  						</div>
		  						<br>
	  						</div>
	  						<table id="dt_reporte_cobranza" class="ui celler table display" width="100%">
	  							<thead>
	  								<tr>
	  									<th>Banco</th>
	  									<th>Fecha</th>
	  									<th>Factura</th>
	  									<th>Cliente</th>
	  									<th>Moneda</th>
	  									<th>TC</th>
	  									<th>Importe</th>
	  									<th>Iva</th>
	  									<th>Total</th>
	  									<th>Importe MXN</th>
	  									<th>Iva MXN</th>
	  									<th>Total MXN</th>
	  								</tr>
	  							</thead>
	  						</table>
						</div>
					</div>
				
				<!-- Collapse Reporte de Comisiones -->
					<div class="collapse col-12 " id="collapseReporteComisiones">
						<div class="card card-body">
							<div id="titulo_comisiones">
	  							<center><h3>Reporte de Comisiones</h3></center><br>
	  						</div>
	  						<br>
	  						<form id="frmMostrarComisiones" method="POST">
	  							<div class="form-group row justify-content-center">
	  								<label for="contacto hemusa" class="col-1">Vendedor</label>
									<select id="idvendedor" name="vendedor" class="form-control col-2">
								<?php
									$query_usuarios = "SELECT id,nombre FROM usuarios where dp = 'Ventas'";
									$resultado_usuarios = mysqli_query($conexion_usuarios, $query_usuarios);
									while($row_usuarios = mysqli_fetch_array($resultado_usuarios)){
									 	echo "<option value='".$row_usuarios['id']."' >".$row_usuarios['nombre']."</option>";
									}	
								?>
									</select>
	  							</div>
	  							<div class="form-group row justify-content-center">
	  								<label for="fecha_inicio" class="col-1">Fecha inicio: </label>
									<input type="date" id="fechaInicio" name="fechaInicio" class="form-control col-2" value="" />
	  							</div>
	  							<div class="form-group row justify-content-center">
	  								<label for="fecha_fin" class="col-1">Fecha fin: </label>
									<input type="date" id="fechaFin" name="fechaFin" class="form-control col-2" value="" />
								</div>
								<div class="form-group row justify-content-center">
									<button id="btn_listar_comisiones" type="button" class="btn btn-primary">Mostrar</button>
								</div>
							</form>
							<table id="dt_reporte_comisiones" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Banco</th>
										<th>Fecha</th>
										<th>Factura</th>
										<th>Cliente</th>
										<th>Moneda</th>
										<th>TC</th>
										<th>Importe</th>
										<th>Iva</th>
										<th>Total</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
			
				<!-- Collapse Reporte Herramienta sin Entregar -->
					<div class="collapse col-12 " id="collapseHerramientaSinEntregar">
	  					<div class="card card-body">
	  						<div id="titulo_herramientaSinEntregar">
	  							<center><h3>Reporte de Herramienta sin Entregar</h3></center><br>
	  						</div>
	  						<table id="dt_herramienta_sin_entregar" class="table table-bordered table-striped table-hover compact" cellspacing="0" width="100%">
	  							<thead>
	  								<tr>
	  									<th>Marca</th>
	  									<th>Modelo</th>
	  									<th>Cliente</th>
	  									<th>Descripcion</th>
	  									<th>Cantidad</th>
	  									<th>Precio</th>
	  									<th>Moneda</th>
	  									<th>Pedido Cliente</th>
	  									<th>Fecha Pedido</th>
	  								</tr>
	  							</thead>
	  						</table>
	  					</div>
	  				</div>
			
				<!-- Collapse Reporte Herramienta sin Factura -->
					<div class="collapse col-12 " id="collapseHerramientaSinFactura">
	  					<div class="card card-body">
	  						<div id="titulo_herramientaSinFactura">
	  							<center><h3>Reporte de Herramienta sin Factura</h3></center><br>
	  						</div>
	  						<table id="dt_herramienta_sin_factura" class="ui celler table">
	  							<thead>
	  								<tr>
	  									<th>Marca</th>
	  									<th>Modelo</th>
	  									<th>Cliente</th>
	  									<th>Cantidad</th>
	  									<th>Remision</th>
	  								</tr>
	  							</thead>
	  						</table>
	  					</div>
	  				</div>
			
			</div>	
      	</main>
</body>
</html>
	<script>
		// $('#selectCliente').zelect();
		$(document).on("ready", function(){
			// listar_pedidos_sin_oc();
			// listar_impuestos();
			// listar_cobranza();
			$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    			$("#success-alert").slideUp(500);
			});
		});

		$('#btn_listar_impuestos').on("click", function(){
	      	listar_impuestos();
	      	// obtener_data_reporte_cobranza();
	    });

	    $('#btn_listar_acumulados').on("click", function(){
	      	listar_acumulados();
	      	// obtener_data_reporte_cobranza();
	    });

		$('#btn_listar_cobranza').on("click", function(){
	      	listar_cobranza();
	      	obtener_data_reporte_cobranza();
	    });

		$('#btn_listar_comisiones').on("click", function(){
	      	listar_comisiones();
	    });

		$('#btn_listar_herramienta_sin_entregar').on("click", function(){
	      	listar_herramienta_sin_entregar();
	    });

		var  listar_pedidos_sin_oc = function(){
			// $('#dt_pedidos_sin_oc tfoot th').each( function () {
		 //        var title = $(this).text();
		 //        $(this).html( '<input class="form-control" type="text" placeholder="Buscar '+title+'" />' );
		 //    });

			var table = $("#dt_pedidos_sin_oc").DataTable({				
				"language": idioma_espanol,
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            "className": "btn iconocsv"
			          },
			          {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_pedidosSinOC").innerHTML);
                        },
			          },
				]
			});		

			// $("#dt_pedidos_sin_oc tfoot input").on( 'keyup change', function () {
	  //           table
	  //               .column( $(this).parent().index()+':visible' )
	  //               .search( this.value )
	  //               .draw();    
   //    		});	
		}

		var listar_impuestos = function(){
			$("#dt_impuestos").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var anoImpuestos = $("#frmMostrarImpuestos #anoImpuestos").val();
			var table = $("#dt_impuestos").DataTable({
				"destroy":"true",
		        	"ajax":{
		          		"method":"POST",
		          		"url":"listar_impuestos.php",
		          		"data": {"anoImpuestos": anoImpuestos}
		        },	
		        "columns":[
		        	{"data": "impuesto"},
		        	{"data": "enero"},
		        	{"data": "febrero"},
		        	{"data": "marzo"},
		        	{"data": "abril"},
		        	{"data": "mayo"},
		        	{"data": "junio"},
		        	{"data": "julio"},
		        	{"data": "agosto"},
		        	{"data": "septiembre"},
		        	{"data": "octubre"},
		        	{"data": "noviembre"},
		        	{"data": "diciembre"},
		        	{"data": "total"}
		        ],
				"paging": false,
				"info": false,
				"searching": false,
				"order": false,			
				"language": idioma_espanol,
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalEnero = api
		                .column( 1 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalFebrero = api
		                .column( 2 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMarzo = api
		                .column( 3 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalAbril = api
		                .column( 4 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMayo = api
		                .column( 5 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJunio = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJulio = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalAgosto = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalSeptiembre = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalOctubre = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalNoviembre = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalDiciembre = api
		                .column( 12 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalTotales = api
		                .column( 13 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            $( api.column( 0 ).footer() ).html('TOTAL');
		            $( api.column( 1 ).footer() ).html('$ ' + totalEnero + '.00');
		            $( api.column( 2 ).footer() ).html('$ ' + totalFebrero + '.00');
		            $( api.column( 3 ).footer() ).html('$ ' + totalMarzo + '.00');
		            $( api.column( 4 ).footer() ).html('$ ' + totalAbril + '.00');
		            $( api.column( 5 ).footer() ).html('$ ' + totalMayo + '.00');
		            $( api.column( 6 ).footer() ).html('$ ' + totalJunio + '.00');
		            $( api.column( 7 ).footer() ).html('$ ' + totalJulio + '.00');
		            $( api.column( 8 ).footer() ).html('$ ' + totalAgosto + '.00');
		            $( api.column( 9 ).footer() ).html('$ ' + totalSeptiembre + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalOctubre + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalNoviembre + '.00');
		            $( api.column( 12 ).footer() ).html('$ ' + totalDiciembre + '.00');
		            $( api.column( 13 ).footer() ).html('$ ' + totalTotales + '.00');
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_impuestos").innerHTML);
                        },
			        },
				]
			});		
			var anoImpuestos=document.getElementById("anoImpuestos").value;
			$("#tituloAnoImpuestos").val(anoImpuestos);
		}

		var listar_acumulados = function(){
			$("#dt_acumulados").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var anoAcumulados = $("#frmMostrarAcumulados #anoAcumulados").val();
			var table = $("#dt_acumulados").DataTable({
				"destroy":"true",
		        	"ajax":{
		          		"method":"POST",
		          		"url":"listar_acumulados.php",
		          		"data": {"anoAcumulados": anoAcumulados}
		        },	
		        "columns":[
		        	{"data": "reporte"},
		        	{"data": "enero"},
		        	{"data": "febrero"},
		        	{"data": "marzo"},
		        	{"data": "abril"},
		        	{"data": "mayo"},
		        	{"data": "junio"},
		        	{"data": "julio"},
		        	{"data": "agosto"},
		        	{"data": "septiembre"},
		        	{"data": "octubre"},
		        	{"data": "noviembre"},
		        	{"data": "diciembre"},
		        	{"data": "total"}
		        ],
				"paging": false,
				"info": false,
				"searching": false,
				"order": false,			
				"language": idioma_espanol,
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalEnero = api
		                .column( 1 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalFebrero = api
		                .column( 2 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMarzo = api
		                .column( 3 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalAbril = api
		                .column( 4 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalMayo = api
		                .column( 5 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJunio = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalJulio = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalAgosto = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalSeptiembre = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalOctubre = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalNoviembre = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalDiciembre = api
		                .column( 12 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            var totalTotales = api
		                .column( 13 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 )

		            $( api.column( 0 ).footer() ).html('TOTAL');
		            $( api.column( 1 ).footer() ).html('$ ' + totalEnero + '.00');
		            $( api.column( 2 ).footer() ).html('$ ' + totalFebrero + '.00');
		            $( api.column( 3 ).footer() ).html('$ ' + totalMarzo + '.00');
		            $( api.column( 4 ).footer() ).html('$ ' + totalAbril + '.00');
		            $( api.column( 5 ).footer() ).html('$ ' + totalMayo + '.00');
		            $( api.column( 6 ).footer() ).html('$ ' + totalJunio + '.00');
		            $( api.column( 7 ).footer() ).html('$ ' + totalJulio + '.00');
		            $( api.column( 8 ).footer() ).html('$ ' + totalAgosto + '.00');
		            $( api.column( 9 ).footer() ).html('$ ' + totalSeptiembre + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalOctubre + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalNoviembre + '.00');
		            $( api.column( 12 ).footer() ).html('$ ' + totalDiciembre + '.00');
		            $( api.column( 13 ).footer() ).html('$ ' + totalTotales + '.00');
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_acumulados").innerHTML);
                        },
			        },
				]
			});		
		}

		var listar_cobranza = function(){
			$("#dt_reporte_cobranza").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var fechaInicio = $("#frmMostrarCobranza #fechaInicio").val(),
          		fechaFin = $("#frmMostrarCobranza #fechaFin").val();
			var table = $("#dt_reporte_cobranza").DataTable({	
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_cobranza.php",
		          "data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
		        },
		        "columns":[
		        	{"data": "banco"},
		        	{"data": "fecha"},
		        	{"data": "factura"},
		        	{"data": "cliente"},
		        	{"data": "moneda"},
		        	{"data": "tipoCambio"},
		        	{"data": "importe"},
		        	{"data": "iva"},
		        	{"data": "total"},
		        	{"data": "importeMXN"},
		        	{"data": "ivaMXN"},
		        	{"data": "totalMXN"}
		        ],
				"language": idioma_espanol,
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalImporte = api
		                .column( 9 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalIva = api
		                .column( 10 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalTotal = api
		                .column( 11 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            $( api.column( 8 ).footer() ).html('TOTAL');
		            $( api.column( 9 ).footer() ).html('$ ' + totalImporte + '.00');
		            $( api.column( 10 ).footer() ).html('$ ' + totalIva + '.00');
		            $( api.column( 11 ).footer() ).html('$ ' + totalTotal );
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_reporteCobranza").innerHTML);
                        },
			        },
				]
			});	
			// obtener_data_reporte_cobranza("#dt_reporte_cobranza tbody", table);	
		}

		var obtener_data_reporte_cobranza = function(){
	      	var fechaInicio =document.getElementById("fechaInicio").value;
	        var fechaFin =document.getElementById("fechaFin").value;
	        document.getElementById("valFechaInicio").innerHTML = fechaInicio;	
	        document.getElementById("valFechaFin").innerHTML = fechaFin;	         
	    }

		var  listar_comisiones = function(){
			$("#dt_reporte_comisiones").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var fechaInicio = $("#frmMostrarComisiones #fechaInicio").val(),
          		fechaFin = $("#frmMostrarComisiones #fechaFin").val(),
          		idvendedor = $("#frmMostrarComisiones #idvendedor").val();
			var table = $("#dt_reporte_comisiones").DataTable({	
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_comisiones.php",
		          "data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin, "idvendedor": idvendedor}
		        },
		        "decimal": ",",
		        "order": [[1, "asc"]],
				"language": idioma_espanol,
				"columns": [
					{"data":"banco"},
					{"data":"fecha"},
					{"data":"factura"},
					{"data":"cliente"},
					{"data":"moneda"},
					{"data":"tipoCambio"},
					{"data":"importe"},
					{"data":"iva"},
					{"data":"total"}
				],
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",
          		"footerCallback": function ( row, data, start, end, display ) {
		            var api = this.api();
		            // Remove the formatting to get integer data for summation
		            var intVal = function ( i ) {
		                return typeof i === 'string' ?
		                    i.replace(/[\$,]/g, '')*1 :
		                    typeof i === 'number' ?
		                        i : 0;
		            };

		            var totalImporte = api
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalIva = api
		                .column( 7 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            var totalTotal = api
		                .column( 8 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            $( api.column( 3 ).footer() ).html('<b>COMISION</b>');
		            $( api.column( 4 ).footer() ).html('$ ' + (totalImporte*0.03).toFixed(4) );
		            $( api.column( 5 ).footer() ).html('<b>TOTAL</b>');
		            $( api.column( 6 ).footer() ).html('$ ' + totalImporte.toFixed(4) );
		            $( api.column( 7 ).footer() ).html('$ ' + totalIva.toFixed(4) );
		            $( api.column( 8 ).footer() ).html('$ ' + totalTotal.toFixed(4) );
		        },
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_comisiones").innerHTML);
                        },
			        },
				]
			});

		}

		var  listar_herramienta_sin_entregar = function(){
			var table = $("#dt_herramienta_sin_entregar").DataTable({	
				"destroy":"true",
		        "ajax":{
		          "method":"POST",
		          "url":"listar_herramienta_sin_entregar.php"
		        },
		        "order": [[1, "asc"]],
				"language": idioma_espanol,
				"columns": [
					{"data":"marca"},
					{"data":"modelo"},
					{"data":"cliente"},
					{"data":"descripcion"},
					{"data":"cantidad"},
					{"data":"precio"},
					{"data":"moneda"},
					{"data":"pedidoCliente"},
					{"data":"fechaPedido"}
				],
				"dom": 
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",          	
				"buttons":[
		            {
			            extend:    'pdfHtml5',
			            text:      '<i class="fa fa-file-pdf-o"></i>',
			            titleAttr: 'PDF',
			            footer: true,
			            orientation: 'landscape',
			            download: 'open',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconopdf"
			        },
			          {
			            extend:    'excelHtml5',
			            text:      '<i class="fa fa-file-excel-o"></i>',
			            titleAttr: 'Excel',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconoexcel"
			          },
			          {
			            extend: 'csvHtml5',
			            text: '<i class="fa fa-file-text-o"></i>',
			            titleAttr: 'CSV',
			            footer: true,
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            "className": "btn iconocsv"
			          },
			        {
			            extend: 'print',
			            text: '<i class="fa fa-print" aria-hidden="true"></i>',
			            titleAttr: 'Imprmir',
			            footer: true,
			            header: 'false',
			            exportOptions: {
			              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
			            },
			            orientation: 'landscape',
			            download: 'open',
			            "className": "btn iconoimprimir",
			            title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_herramientaSinEntregar").innerHTML);
                        },
			        },
				]
			});

		}

		$('#btn_listar_herramienta_sin_factura').on("click", function(){
			var  listar_herramienta_sin_factura = function(){
				var table = $("#dt_herramienta_sin_factura").DataTable({	
					"destroy":"true",
			        "ajax":{
			          "method":"POST",
			          "url":"listar_herramienta_sin_factura.php"
			        },
			        "order": [[1, "asc"]],
					"language": idioma_espanol,
					"columns": [
						{"data":"marca"},
						{"data":"modelo"},
						{"data":"cliente"},
						{"data":"cantidad"},
						{"data":"remision"}
					],
					"dom": 
						"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
	          			"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
	          			"<'container-fluid row'<'row justify-content-center col-6 buttons'i><'row justify-content-end col-6 buttons'p>>",          	
					"buttons":[
			            {
				            extend:    'pdfHtml5',
				            text:      '<i class="fa fa-file-pdf-o"></i>',
				            titleAttr: 'PDF',
				            footer: true,
				            orientation: 'landscape',
				            download: 'open',
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconopdf"
				        },
				          {
				            extend:    'excelHtml5',
				            text:      '<i class="fa fa-file-excel-o"></i>',
				            titleAttr: 'Excel',
				            footer: true,
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconoexcel"
				          },
				          {
				            extend: 'csvHtml5',
				            text: '<i class="fa fa-file-text-o"></i>',
				            titleAttr: 'CSV',
				            footer: true,
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            "className": "btn iconocsv"
				          },
				        {
				            extend: 'print',
				            text: '<i class="fa fa-print" aria-hidden="true"></i>',
				            titleAttr: 'Imprmir',
				            footer: true,
				            header: 'false',
				            exportOptions: {
				              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
				            },
				            orientation: 'landscape',
				            download: 'open',
				            "className": "btn iconoimprimir",
				            title: '',
	                        customize: function(window) {
	                            $(window.document.body).children().eq(0).after(document.getElementById("titulo_herramientaSinFactura").innerHTML);
	                        },
				        },
					]
				});
			}
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
