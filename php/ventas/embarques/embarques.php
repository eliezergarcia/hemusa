<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<head>
  <title>Embarques</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Embarques</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Facturación</a></li>
	                    <li class="breadcrumb-item"><a href="#">Embarques</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                          	<!-- Tabla de embarques -->
                							<table id="dt_embarques" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
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
                    	</div>
                	</div>
            	</div>
      		</div>
          
    	</div>

		<!-- Modal Packing List -->
			<form action="" method="POST">
				<input type="hidden" name="opcion" id="opcion" value="crearembarque">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario." ".$usuarioApellido; ?>">
				<div class="modal fade colored-header colored-header-success" id="modalNuevoEmbarque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="exampleModalLabel">Nuevo embarque</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col form-group">
										<label for="folio">Folio <font color="#FF4136">*</font></label>
										<input name="folio" id="folio" class="disabled form-control form-control-sm" disabled required>
									</div>
									<div class="col-6 form-group">
										<label for="cliente">Cliente <font color="#FF4136">*</font></label>
										<input placeholder="Busca un cliente" class="form-control form-control-sm" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="partidasnuevoembarque()"  required >
									</div>
									<div class="col form-group">
										<label for="peso">Peso <font color="#FF4136">*</font></label>
										<input name="peso" id="peso" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="row">
                  <div class="col-3 form-group">
                    <label for="dimensiones">Dimensiones <font color="#FF4136">*</font></label>
                    <input name="dimensiones" id="dimensiones" class="form-control form-control-sm" required>
                  </div>
									<div class="col form-group">
										<label for="observaciones">Observaciones</label>
										<textarea name="observaciones" id="observaciones" class="form-control form-control-sm"></textarea>
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
							<div class="modal-footer invoice-footer">
								<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-lg btn-success">Hecho</button>
							</div>
						</div>
					</div>
				</div>
			</form>

      <div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
              <div class="text-center">
                <div class="texto1">
                  <br><br>
                  <h3>Espere un momento...</h3>
                  <h4>La lista de embarque se esta generando</h4>
                  <br>
                  <div class="text-center">
                    <div class="be-spinner">
                      <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="mt-8">
                </div>
              </div>
            </div>
            <div class="modal-footer"></div>
          </div>
        </div>
      </div>

	</header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
    	App.pageCalendar();
    	App.formElements();
    	App.uiNotifications();
			listar();
			guardar();
		});

		var  listar = function(){
			var table = $("#dt_embarques").DataTable({
				"destroy": true,
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"method":"POST",
					"url":"listar_embarques.php"
				},
				"columns":[
					{"data":"folio"},
					{"data":"nombreCliente"},
					{"data":"fecha"},
					{"data":"contactoHemusa"},
					{"defaultContent": "<div class='invoice-footer'><button class='verembarque btn btn-lg btn-primary'><i class='fas fa-edit' aria-hidden='true'></i></button></div>"}
				],
				"order": [[2, "desc"]],
				"language": idioma_espanol,
				"dom":
	    			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
	    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons":[
		            {
			            extend: 'collection',
			            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
			            "className": "btn btn-lg btn-space btn-secondary",
			            buttons: [
			                {
			                  extend:    'excelHtml5',
			                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3 ]
			                  }
			                },
			                {
			                  extend: 'csv',
			                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3 ]
			                  }
			                },
			                {
			                  extend:    'pdfHtml5',
			                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
			                  download: 'open',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3 ]
			                  }
			                },
			                {
			                  extend: 'print',
			                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
			                  header: 'false',
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3 ]
			                  },
			                  orientation: 'landscape',
			                  pageSize: 'LEGAL'
			                }
			            ]
			          },
					      {
		                text: '<i class="fas fa-box fa-sm" aria-hidden="true"></i> Nuevo embarque',
		                "className": "btn btn-lg btn-space btn-secondary",
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
				success : function( data ) {
          console.log(data);
					var clientes = data;
					// $('#cliente').empty();
					// $("#cliente").append("<option>Seleccionar...</option>");
					// for(var i=0;i<clientes.length;i = i + 2){
					// 	if (cliente == clientes[i]) {
					// 		$("#cliente").append("<option value="+clientes[i]+" selected>" + clientes[i + 1] + "</option>");
					// 	}else{
					// 		$("#cliente").append("<option value="+clientes[i]+">" + clientes[i + 1] + "</option>");
					// 	}
					// };


          var lista = new Array();
          for(var i=0;i<clientes.length;i = i + 2){
            if (i != clientes.length) {
              var push = { label: clientes[i + 1], value: clientes[i] };
            }
            lista.push(push);
					}
          var input = document.getElementById("cliente");
          var awesomplete = new Awesomplete(input);

          awesomplete.list = lista;
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
					{"defaultContent": "<div class='invoice-footer'><button class='quitar btn btn-lg btn-danger'><i class='fas fa-times fa-sm' aria-hidden='true'></i></button></div>"}
				],
				"order": false,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
		        "ordering": false,
		        "language": idioma_espanol,
		        "dom":
	    			"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
	    			"<'row be-datatable-body'<'col-sm-12'tr>>"
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
        $('.modal').modal('hide');
        $("#mod-success").modal("show");
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
            setTimeout(function () {
              $(".texto1").fadeOut(300, function(){
                $(this).html("");
                $(this).fadeIn(300);
              });
            }, 2000);
            setTimeout(function () {
              $(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
              $(".texto1").append("<h3>Correcto!</h3>");
              $(".texto1").append("<h4>La lista de embarque se generó correctamente.</h4>");
              $(".texto1").append("<div class='text-center'>");
              $(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
              $(".texto1").append("</div>");
            }, 2500);
            setTimeout(function () {
              window.location.href = "verEmbarque.php?embarque="+info.embarque;
            }, 4000);
          }else{
            setTimeout(function () {
              $("#mod-success").modal("hide");
              mostrar_mensaje(info);
            }, 2000);
          }
				});
			});
		}

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
