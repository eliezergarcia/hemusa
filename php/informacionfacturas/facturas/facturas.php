<?php 
	include("../../header.php");
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap4.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
  	<div class="row fondo">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center titulo">Facturas</h1>
		</div>
	</div>
	<div class="row center-xs">
		<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_factura" class="table table-bordered table-hover start-xs" cellspacing="0" width="100%">
					<thead>
						<tr>								
							<th>Factura</th>
							<th>Fecha</th>
							<th>Empresa</th>
							<th>SubTotal</th>
							<th>IVA</th>
							<th>Moneda</th>
			<!-- 				<th>Moneda Factura</th>
							<th>Pagado</th>
							<th>Moneda Pago</th>
							<th>Banco</th>
							<th>Fecha</th> -->
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
	</div>

	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="js/dataTables.buttons.min.js"></script>
	<script src="js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="js/pdfmake.min.js"></script>
	<script src="js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="js/buttons.html5.min.js"></script>

	<script>
		$(document).on("ready", function(){
			listar();
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});


		var  listar = function(){
			$("#cuadro2").slideUp("slow");
			$("#cuadro1").slideDown("slow");
			var table = $("#dt_factura").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_facturas.php" 
				},
				"columns":[
					{"data":"factura"},
					{"data":"facturaFecha"},
					{"data":"nombreEmpresa", "sortable": false},
					{
						"data":"precioTotal", "sortable": false,
						"render": function(precioTotal){
							return "$ " + precioTotal;
						},
					},
					{
						"data":"IVA", "sortable": false,
						"render": function(moneda){
							return "$ " + moneda;
						},
					},
					{
						"data":"moneda", "sortable": false,
						"render": function(IVA){
							return "$ " + IVA;
						},
					}
				],
				"language": idioma_espanol,
				"dom": 'Bfrtip',
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf"
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel"
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv"
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
</body>
</html>
