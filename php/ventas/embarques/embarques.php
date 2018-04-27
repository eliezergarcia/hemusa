<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<head>
  <title>Embarques</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="page-content">
			<!-- Breadcrumb -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Facturación</li>
						<li class="breadcrumb-item active">Embarques</li>
					</ol>
				</nav>

			<!-- Encabezado -->
				<div id="encabezado" class="row fondo">
					<div class="col-sm-12">
						<br><h1 class="text-center"><b>Lista de embarques</b></h1><br>
					</div>
				</div>

			<!-- Mensaje actualizaciones-->
				<div>
					<center><h6 class="mensaje"></h6></center>
				</div>

			<!-- Tabla de embarques -->
				<div class="">
					<table id="dt_embarques" class="table table-bordered table-striped table-hover display compact" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Nombre cliente</th>
								<th>Fecha</th>
								<th>Contacto hemusa</th>
								<th>Ver</th>
							</tr>
						</thead>
					</table>
				</div>

			<!-- Modal Packing List -->
				<form action="" method="POST">
					<input type="hidden" name="opcion" id="opcion" value="crearembarque">
					<input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario." ".$usuarioApellido; ?>">
					<div class="modal fade" id="modalNuevoEmbarque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Crear Embarque</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col form-group">
											<label for="folio">Folio <font color="#FF4136">*</font></label>
											<input name="folio" id="folio" class="disabled form-control" disabled required>
										</div>
										<div class="col-6 form-group">
											<label for="cliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
											<select placeholder="Busca un cliente" class="form-control col-12" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="partidasnuevoembarque()"  required >
											</select>
										</div>
										<div class="col form-group">
											<label for="peso">Peso <font color="#FF4136">*</font></label>
											<input name="peso" id="peso" class="form-control" required>
										</div>
										<div class="col form-group">
											<label for="dimensiones">Dimensiones <font color="#FF4136">*</font></label>
											<input name="dimensiones" id="dimensiones" class="form-control" required>
										</div>
									</div>
									<div class="row">
										<div class="col form-group">
											<label for="observaciones">Observaciones</label>
											<textarea name="observaciones" id="observaciones" class="form-control"></textarea>
										</div>
									</div>
									<table id="dt_crear_embarque" class="table table-bordered table-striped table-responsive display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Cantidad</th>
												<th>Descripción</th>
												<th>Quitar</th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary">Crear</button>
								</div>
							</div>
						</div>
					</div>
				</form>

		</main>
	</div>
</body>
</html>

	<script>
		$(document).on("ready", function(){
			listar();
			guardar();
		});

		var  listar = function(){
			var table = $("#dt_embarques").DataTable({
				"destroy": true,
				"autoWidth": true,
				"processing": true,
				"deferRender": true,
				"scrollX": true,
				"sPaginationType": "full_numbers",
				"ajax":{
					"method":"POST",
					"url":"listar_embarques.php"
				},
				"columns":[
					{"data":"folio"},
					{"data":"nombreCliente"},
					{"data":"fecha"},
					{"data":"contactoHemusa"},
					{"defaultContent": "<button class='verembarque btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
				],
				"order": [[2, "desc"]],
				"language": idioma_espanol,
				"dom":
					"<'container row col-10 row align-items-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                download: 'open',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3 ]
            			},
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            },
					      {
		                text: '<i id="toolTipNuevaCotizacion" class="fa fa-plus-circle" aria-hidden="true"></i> Embarque',
		                "className": "btn btn-success btnNuevaCotizacion",
		                action: function ( e, dt, node, config ) {
		                	$('#modalNuevoEmbarque').modal('show');
		                }
		            },
				]
			});
			mostrar_embarque("#dt_embarques tbody", table);
		}

		$('#modalNuevoEmbarque').on('show.bs.modal', function (e) {
			var opcion = "buscarfolioembarque";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
			}).done( function( data ){
				console.log(data);
				console.log(data.folio);
				$("#folio").val(data.folio);
			});
			opcion = "buscarclientes";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var clientes = data;
					$('#cliente').empty();
					$("#cliente").append("<option>Seleccionar...</option>");
					for(var i=0;i<clientes.length;i = i + 2){
						if (cliente == clientes[i]) {
							$("#cliente").append("<option value="+clientes[i]+" selected>" + clientes[i + 1] + "</option>");
						}else{
							$("#cliente").append("<option value="+clientes[i]+">" + clientes[i + 1] + "</option>");
						}
					};
				}
			});
		})

		var partidasnuevoembarque = function (){
			var idcliente = $("#cliente").val();
			var opcion = "partidasembarque";
			var table = $("#dt_crear_embarque").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"idcliente": idcliente, "opcion": opcion}
				},
				"columns":[
					{"data": "indice"},
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "cantidad"},
					{"data": "descripcion"},
					{"defaultContent": "<button class='quitar btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i></button>"}
				],
				"order": false,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
		        "ordering": false,
		        "language": idioma_espanol,
		        "dom":
					"<'container row col-10 row'<'row justify-content-end col-12 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>"
			});

			obtener_id_quitar("#dt_crear_embarque tbody", table, idcliente);
		}

		var obtener_id_quitar = function(tbody, table, idcliente){
			$(tbody).on("click", "button.quitar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				if (confirm("Esta seguro(a) de quitar la herramienta del embarque?")){
					var id = data.id;
					console.log(id);
					var opcion = "quitarhembarque";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						data: {"opcion": opcion, "id": id},
						success: function (data) {
							var json_info = JSON.parse( data );
							partidasnuevoembarque();
						}
					});
				}
			});
		}

		var mostrar_embarque = function(tbody, table){
			$(tbody).on("click", "button.verembarque", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var folio = data.folio;
				console.log(folio);
				window.location.href = "verEmbarque.php?embarque="+folio;
			});
		}

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$('form .disabled').attr('disabled', false);
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: frm
				}).done( function( info ){
					if(info.respuesta == "nuevoembarque"){
						window.location.href = "verEmbarque.php?embarque="+info.embarque;
					}
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<strong>Error</strong>, no se ejecutó la consulta.";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<strong>Información!</strong> el usuario ya existe.";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<strong>Adbertencia!</strong> la opción no existe o esta vacía, recargar la página. ";
				color = "#DDB11D";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(3000, function(){
			$(this).html("");
			$(this).fadeIn(3000);
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
