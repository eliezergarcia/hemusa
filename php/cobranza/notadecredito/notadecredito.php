<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Notas de credito</title>
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

    <script src="js/zelect.js"></script>

</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo" id="titulo">
					<div class="col-sm-12">
						<br><h1 class="text-center"><b>Notas de Crédito</b></h1>
					</div>
				</div>	
				
				<style>
					.notacredito hr{
						border-width: 4px;
					}
				</style>

				<br>

				<!-- Botones -->
					<div class="row justify-content-center">
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseCrearNota" aria-expanded="false" aria-controls="collapseExample">
					    Crear Nota de Crédito
						</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTablaNotas" aria-expanded="false" aria-controls="collapseTablaNotas">
					    Ver Notas de Crédito
						</button>
					</div>
				
				<br>
				<div class="collapse" id="collapseTablaNotas">
				  	<div class="card card-body">
				    	<div class="row justify-content-center">
							<form action="notaDeCredito.php" name="buscaNota">
								<div class="form-group row justify-content-center">
									<label for="">Buscar nota:</label>
									<input type="text" class="form-control" name="NotaBusca" value="">
								</div>	
								<div class="form-group row justify-content-center">
									<input type="submit" class="btn btn-primary" name="buscar" value="Buscar">
								</div>
							</form>
						</div>
						<div class="container">
							<table id="dt_notas" class="ui celler table display" width="100%">
								<thead>
									<tr>
										<th>Numero</th>
										<th>Fecha</th>
										<th>Cliente</th>
										<th>Factura</th>
										<th>Descripcion</th>
										<th>Valor</th>
										<th>Subtipo</th>
									</tr>
								</thead>
								<?php 
								   	$result = mysqli_query($conexion_usuarios, "SELECT * FROM abonos WHERE tipo='notacredito' ORDER BY numero ");
									$NotaBusca = $_REQUEST["NotaBusca"];
								   	if(isset($NotaBusca)){   
								      	while ($row = mysqli_fetch_array($result)) {	 		
											$test=strtolower($row['numero'].$row['factura'].$row['fecha'].$row['deFactura'].$row['descripcion'].$row['valor']);
											$find=strtolower($NotaBusca);
											$findLen = strlen($find);
											$testLen = strlen($test);
											$subTest=substr($test, 0, $findLen);
											$i=0;
											$a=0;
											
											while ($i<($testLen-$findLen+1)) {
								  		     	$subTest=substr($test, $i, $findLen);
								  		     	if (strcmp($find,$subTest)==0 and $a!=1) {
								         	 		echo '<tr><td><a href="notaDeCredito.php?edit='.$row['id'].'">'.$row['numero'].'</a></td><td>'.$row['fecha'].'</td>';
													$insertSQL="SELECT nombreEmpresa FROM contactos WHERE id=".$row['cliente'];
								   					$resultCliente = mysqli_query($conexion_usuarios, $insertSQL);
													$rowCliente = mysqli_fetch_array($resultCliente);
													echo '<td>'.$rowCliente['nombreEmpresa'].'</td>';
													echo '<td>'.$row['deFactura'].'</td><td>'.$row['descripcion'].'</td><td>'.$row['valor'].'</td><td>'.$row['subtipo'].'</td></tr>';
								    			    $a=1;
											    }
											    $i++;
											}	
										}		
								   	}else{
								     	while ($row = mysqli_fetch_array($result)) {	 		
								         	echo '<tr><td><a href="notaDeCredito.php?edit='.$row['id'].'">'.$row['numero'].'</a></td><td>'.$row['fecha'].'</td>';
											$insertSQL="SELECT nombreEmpresa FROM contactos WHERE id=".$row['cliente'];
								   			$resultCliente = mysqli_query($conexion_usuarios, $insertSQL);
											$rowCliente = mysqli_fetch_array($resultCliente);
											echo '<td>'.utf8_encode($rowCliente['nombreEmpresa']).'</td>';
											echo '<td>'.$row['deFactura'].'</td><td>'.utf8_encode($row['descripcion']).'</td><td>$ '.$row['valor'].'</td><td>'.$row['subtipo'].'</td></tr>';
										}		
								   	}	 
								?>
							</table>
						</div>
				  	</div>
				</div>

				<div class="collapse" id="collapseCrearNota">
				  	<div class="card card-body">
				    	<div class="container notacredito">
					<br>
					<h3>Nueva nota de crédito</h3>
					<hr>
					<h5><i class="fa fa-info-circle" aria-hidden="true"></i> Por favor ingresa la siguiente información para la creación de: Nota de crédito.</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;Los campos marcados con * son obligatorios.</h5><br>
					<div class="row">
						<div class="form-group col-6">
							<label for="">Tipo de CFDI *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Nota de crédito</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Cliente *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>VENTAS AL PUBLICO EN GENERAL</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Lugar de expedición *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Principal</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Fecha de CFDI *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Timbrar con fecha actual</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Uso CFDI *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Seleccionar</option>
								<option value="">Adquisición de mercancias</option>
								<option value="">Devolución</option>
								<option value="">Descuento o bonificación</option>
								<option value="">Gastos en general</option>
								<option value="">Por definir</option>
							</select>
						</div>
					</div>
					<br>
					<h3>Datos de remisión</h3>
					<hr>
					<div class="row">
						<div class="form-group col-6">
							<label for="">Serie *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>NC</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">No. de orden/pedido</label>
							<input type="text" class="form-control col-8" placeholder="No. de pedido">
						</div>
						<div class="form-group col-6">
							<label for="">Método de pago</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Pago en una sola exhibición</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Forma de pago *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Seleccionar</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Condiciones de pago</label>
							<input type="text" class="form-control col-8">
						</div>
						<div class="form-group col-6">
							<label for="">Moneda *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>MXN</option>
								<option value="">USD</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Número de decimales *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>2</option>
								<option value="">3</option>
								<option value="">4</option>
							</select>
						</div>
					</div>
					<br>
					<h3>Conceptos</h3>
					<hr>
					<div class="row">
						<div class="form-group col-6">
							<label for="">Concepto * <i class="fa fa-info-circle" aria-hidden="true"></i></label>
							<input type="text" class="form-control col-9" placeholder="Selecciona un producto o servicio de lista de productos">
						</div>
						<div class="form-group col-6">
							<label for="">Cantidad *</label>
							<input type="text" class="form-control col-8" value="1">
						</div>
						<div class="form-group col-6">
							<label for="">Unidad *</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>Seleccionar</option>
							</select>
						</div>
						<div class="form-group col-6">
							<label for="">Precio unitario *</label>
							<input type="text" class="form-control col-8" value="0.00">
						</div>
						<div class="form-group col-6">
							<label for="">Subtotal</label>
							<input type="text" class="form-control col-8" value="$0.00">
						</div>
						<div class="form-group col-3">
							<label for="">IVA</label>
							<select name="" id="" class="form-control col-8">
								<option value="" selected>16%</option>
							</select>
						</div>
						<div class="form-group col-3">
							<label for="">Total</label>
							<input type="text" class="form-control col-8" value="$0.00">
						</div>
						<div class="form-group col-6">
							<label for="">Clave SAT *</label>
							<input type="text" class="form-control col-8" placeholder="Clave SAT">
						</div>
					</div>
					<hr>
					<div class="row justify-content-end">
						<button class="btn btn-outline-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Parte</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Concepto</button>
					</div>
					<br>
				</div>
				  	</div>
				</div>
	
				<!-- <div class="row center-xs">
					<div id="cuadro2" class="center-xs col-sm-12 col-md-12 col-lg-6">
						<form class="form-horizontal" action="" method="POST">
							<div class="form-group">
								<h3 class="col-sm-offset-2 col-sm-8 text-center">					
								Registro</h3>
							</div>
							<input type="hidden" id="idusuario" name="idusuario" value="0">
							<input type="hidden" id="opcion" name="opcion" value="registrar">
							<div class="form-group">
								<label for="usuario" class="col-sm-2 control-label">Cliente</label>
								<div class="col-sm-8"><input id="usuario" name="usuario" type="text" class="form-control"  autofocus></div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Factura</label>
								<div class="col-sm-8"><input id="password" name="password" type="text" class="form-control" ></div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-8">
									<input id="" type="submit" class="btn btn-primary" value="Agregar">
									<input id="btn_listar" type="button" class="btn btn-primary" value="Mostrar notas">
								</div>
							</div>
						</form>
						<div class="col-sm-offset-2 col-sm-8">
							<p class="mensaje"></p>
						</div>
						
					</div>
				</div>
				<div class="row center-xs">
					<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
						<div class="col-sm-offset-2 col-sm-8">
							<h3 class="text-center"> <small class="mensaje"></small></h3>
						</div>
						<form>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-8 buttons">
									<input id="btn_agregar_nota" type="button" class="btn btn-primary" value="Agregar Nota de Crédito">
								</div>
							</div>
						</form>
						<div class="table-responsive col-sm-12">		
							<table id="dt_notas" class="table table-hover start-xs" cellspacing="0" width="100%">
								<thead>
									<tr>								
										<th>Fecha</th>
										<th>Cliente</th>
										<th>Factura</th>
										<th>Descripción</th>
										<th>Valor</th>
										<th>Subtipo</th>
										<th>Editar</th>											
									</tr>
								</thead>					
							</table>
						</div>			
					</div>		
				</div> -->
			</div>
		</main>
</body>
</html>

	<script>
		$(document).on("ready", function(){
			listar();
		});

		var  listar = function(){
			var table = $("#dt_notas").DataTable({
				"order": [[0, "asc"]],
				"language": idioma_espanol,
				"dom":  
                    "<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
                    "<'clear'>" +
                    "<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
                    "<'container-fluid row'<'row justify-content-center col-sm-12 buttons'i>>" +
                    "<'container-fluid row'<'row justify-content-center col-sm-12 buttons'p>>",
		        "buttons":[
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        download: 'open',
                        titleAttr: 'PDF',
                        "className": "btn iconopdf",
                        exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6 ]
                        },
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        "className": "btn iconoexcel",
                        exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6 ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        "className": "btn iconocsv",
                        exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6 ]
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo").innerHTML);
                            // $(window.document.body).children().eq(4).after(document.getElementById("dt_totales").innerHTML);
                        },
                    }
				]
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
