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
			<h1 class="text-center titulo">Backorder</h1>
		</div>
	</div>

	<div class="row center-xs">
    <div id="cuadro3" class="col-sm-12 col-md-12 col-lg-3">
      <form class="form-horizontal" id="frmMostrar" action="" method="POST">
        <div class="form-group">
          <label for="fechaInicio" class="col-sm-3 control-label">Fecha Inicio</label>
          <div class="col-sm-7"><input id="fechaInicio" name="fechaInicio" type="date" class="form-control"  autofocus required></div>
        </div>
        <div class="form-group">
          <label for="fechaFin" class="col-sm-3 control-label">Fecha Fin</label>
          <div class="col-sm-7"><input id="fechaFin" name="fechaFin" type="date" class="form-control" required></div>
        </div>
        <!-- <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <input id="btn_listar_pedimentos" type="button" class="btn btn-primary" value="Buscar">
          </div>
        </div> -->
      </form>
    </div>
  </div>

	<form class="form-horizontal" action="" method="POST">
        <div class="form-group">
          <div class="center-xs col-sm-offset-2 col-sm-8">
            <input id="btn_backorder" type="button" class="btn btn-primary" value="Backorder">
            <input id="btn_sinenviar" type="button" class="btn btn-primary" value="Sin Enviar">
          </div>
        </div>
      </form>
	<div class="row center-xs">
		<div id="cuadro1" class="col-sm-10 col-md-10 col-lg-10">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_backorder" class="table table-hover start-xs" cellspacing="0" width="100%">
					<thead>
						<tr>								
							<th>Cliente</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Descripcion</th>
							<th>Cantidad</th>
							<th>Fecha Pedido</th>
							<th>Orden Compra</th>
							<th>Proveedor</th>
							<th>Fecha enviado</th>
							<th>Comentarios</th>
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
			
		});

		$("#btn_backorder").on("click", function(){
      		listar_Backorder();
    	});

    	$("#btn_sinenviar").on("click", function(){
      		listar_Sin_enviar();
    	});

		var  listar_Backorder = function(){
			var fechaInicio = $("#frmMostrar #fechaInicio").val(),
          	fechaFin = $("#frmMostrar #fechaFin").val();
			var table = $("#dt_backorder").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_Backorder.php",
					"data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
				},
				"columns":[
					{"data":"nombreEmpresa", "sortable": false},
					{"data":"marca", "sortable": false},
					{"data":"modelo", "sortable": false},
					{"data":"descripcion", "sortable": false},
					{"data":"cantidad", "sortable": false},
					{"data":"pedidoFecha"},
					{"data":"noDePedido", "sortable": false},
					{"data":"Proveedor","sortable": false},
					{"data":"enviadoFecha"},
					{"defaultContent":"","sortable": false}
				],
				"order": [[ 5, "desc" ], [ 8, "desc" ]],
				"language": idioma_espanol,
				"dom":  'Bfrtip',
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

		var  listar_Sin_enviar = function(){
			var fechaInicio = $("#frmMostrar #fechaInicio").val(),
          	fechaFin = $("#frmMostrar #fechaFin").val();
			var table = $("#dt_backorder").DataTable({
				"destroy":"true",
				"ajax":{
					"method":"POST",
					"url":"listar_Sin_enviar.php",
					"data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
				},
				"columns":[
					{"data":"nombreEmpresa","sortable": false},
					{"data":"marca", "sortable": false},
					{"data":"modelo", "sortable": false}, 
					{"data":"descripcion", "sortable": false},
					{"data":"cantidad", "sortable": false},
					{"data":"pedidoFecha"},
					{"data":"noDePedido", "sortable": false},
					{"data":"Proveedor","sortable": false},
					{"data":"enviadoFecha"},
					{"defaultContent":"","sortable": false}
				],
				"order": [[ 5, "desc" ]],
				"language": idioma_espanol,
				"dom":  'Bfrtip',
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
