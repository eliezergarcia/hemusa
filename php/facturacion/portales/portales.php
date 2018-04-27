<?php
	require_once('../../conexion.php'); // Llamada para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada para validar si hay sesión inciada
	error_reporting(0); // Eliminamos los mensajes de error de 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Portales</title>
	<?php include('../../enlaces.php'); // Archivo en donde se encuentran los CSS y JS ?>
</head>
<body>
	<?php include('../../header.php'); // Archivo en donde se encuentra el header y menú ?>
		<main class="mdl-layout__content">
				<!-- Encabezado -->
					<div id="encabezado">
						<br><h1 class="text-center"><b>Portales de clientes</b></h1><br>
					</div>
		 				
				<!-- Mensaje de actualizaciones -->
					<div>
						<center><h6 class="mensaje"></h6></center>
					</div>

				<!-- Tabla de Usuarios -->
					<table id="dt_portales" class="table table-striped table-hover table-bordered compact" cellspacing="0" width="100%">
						<thead>
							<tr>								
								<th>Cliente</th>
								<th>Portal</th>
								<th>Usuario</th>
								<th>Password</th>
								<th>Instrucciones</th>
							</tr>
						</thead>
						<tfoot>
							<tr>								
								<th>Cliente</th>
								<th>Portal</th>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>

    	</main>
    <div>
</body>
</html>
<script>
	$(document).on("ready", function(){
		var idusuario = "<?php echo $idusuario; ?>";
		var opcion = "datosusuario";
		$.ajax({ // Se obtienen los datos del usuario en sesion
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion, "idusuario": idusuario},
			success: function ( data ){	
				console.log(data);		
				$("form #usuariologin").val(data.datosusuario.nombre + " " + data.datosusuario.apellidos);
				$("form #dplogin").val(data.datosusuario.dp);
				listar(); // Función para listar la tabla de usuarios
				guardar(); // Función para registrar, modificar y eliminar 							
			}
		});

	});

	var  listar = function(data){ // DataTable de Usuarios 
		$('#dt_portales tfoot th').each( function () {
    		var title = $(this).text();
    		$(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
  		});

		var table = $("#dt_portales").DataTable({
			"destroy":"true",
			"ajax":{
				"url": "listar.php",
				"type": "POST" 
			},
			"columns":[
				{"data": "usuario"},
				{"data": "nombre"},
				{"data": "apellidos"},
				{"data": "dp"},
				{"defaultContent": "<button data-toggle='modal' data-target='#modalEditarUsuario' class='editar btn btn-outline-info'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>", "sortable": false},
				{"defaultContent": "<button data-toggle='modal' data-target='#modalEliminarUsuario' class='eliminar btn btn-outline-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></button>", "sortable": false}
			],
			"order":[[0, "asc"]],
			"language": idioma_espanol,
			"dom":  
				"<'container row col-10 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
				"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
				"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
			"buttons":[
	            {
	                extend:    'pdfHtml5',
	                text:      '<i class="fa fa-file-pdf-o"></i>',
	                titleAttr: 'Generar PDF',
	                exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	                "className": "btn iconopdf"
	            },
				{
	                extend:    'excelHtml5',
	                text:      '<i class="fa fa-file-excel-o"></i>',
	                titleAttr: 'Generar Excel',
	                exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	                "className": "btn iconoexcel"
	            },
	            {
	            	extend: 'csvHtml5',
	            	text: '<i class="fa fa-file-text-o"></i>',
	            	titleAttr: 'Generar CSV',
	            	exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
	            	"className": "btn iconocsv"
	            },
	            {
	            	extend: 'print',
	            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
	            	titleAttr: 'Imprimir',
	            	header: 'false',
	            	exportOptions: {
                			columns: [ 0, 1, 2, 3 ]
        			},
        			orientation: 'landscape',
        			pageSize: 'LEGAL',
        			"className": "btn iconoimprimir",
        			title: 'Usuarios HEMUSA'
	            },
	            {
	            	text: '<i class="fa fa-user-plus" aria-hidden="true"></i>',
	            	"className": "btn btn-success",
	            	titleAttr: 'Agregar Usuario',
	            	action: function (e, dt, node, config){
    					$('#modalRegistrarUsuario').modal('show');
					}		
	            }
			]
		});
		
		$("#dt_usuarios tfoot input").on( 'keyup change', function () {
    		table
        		.column( $(this).parent().index()+':visible' )
        		.search( this.value )
        		.draw();		
		});

		obtener_data_editar("#dt_usuarios tbody", table);
		obtener_id_eliminar("#dt_usuarios tbody", table); 
	}

	var obtener_data_editar = function(tbody, table){ // Se obtiene los datos de usuarios para editar del DT Usuarios 
		$(tbody).on("click", "button.editar", function(){
			var data = table.row( $(this).parents("tr") ).data();
		});
	}

	var obtener_id_eliminar = function(tbody, table){ // se obtiene el id del usuario para eliminar del DT Usuarios 
		$(tbody).on("click", "button.eliminar", function(){
			var data = table.row( $(this).parents("tr") ).data();			
		});
	}

	var guardar = function(){ // Se envian los datos para guardar cambios 
		$("form").on("submit", function(e){
			e.preventDefault();
		});
	}

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

	var limpiar_datos = function(){ // Se limpian los campos para nuevo registro 

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
