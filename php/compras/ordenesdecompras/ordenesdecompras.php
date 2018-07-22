<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
  $mes = date("m");
	$ano = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Ordenes de Compras</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="page-head">
          <h2 class="page-head-title" style="font-size: 30px;"><b>Ordenes de compras</b></h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="#">Compras</a></li>
                <li class="breadcrumb-item"><a href="#">Ordenes de compras</a></li>
            </ol>
          </nav>
      </div>
      <div class="main-content container-fluid">
          <div class="row full-calendar">
            <div class="col-lg-12">
                <div class="card card-fullcalendar">
                    <div class="card-body">
                      <div class="row table-filters-container">
                        <div class="col-12">
                          <div class="row">
                            <div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
                              <div class="filter-container">
                                <form>
                                  <div class="row">
                                    <div class="col-6">
                                      <label class="control-label">Mes:</label>
                                      <select class="form-control form-control-sm select2" name="filtromes" id="filtromes">
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                        <option value="todo">Todo</option>
                                      </select>
                                    </div>
                                    <div class="col-6">
                                      <label class="control-label">Año:</label>
                                      <select class="form-control form-control-sm select2" name="filtroano" id="filtroano">
                                        <option value="2017">2017</option>
                                        <option value="2018" selected>2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                      </select>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <div class="col-2 table-filters"><span class="table-filter-title">Tipo</span>
                              <div class="filter-container">
                                <form>
                                  <div class="row">
                                    <div class="col-12">
                                     <label class="custom-control custom-radio">
                                       <input class="custom-control-input" type="radio" name="filtroestado" value="ordenesdecompras" checked=""><span class="custom-control-label">Ordenes de compra</span>
                                     </label>
                                     <label class="custom-control custom-radio">
                                       <input class="custom-control-input" type="radio" name="filtroestado" value="herramientasoc"><span class="custom-control-label">Herramientas en OC</span>
                                     </label>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <div class="col-3 table-filters"><span class="table-filter-title">Referencia</span>
                              <div class="filter-container">
                                <form>
                                  <div class="row">
                                    <div class="col-8">
                                      <label class="control-label">Palabra:</label>
                                      <input type="text" class="form-control form-control-sm" name="filtroreferencia" id="filtroreferencia" value="">
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Tabla de ordenes -->
                        <table id="dt_ordenes" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Orden</th>
                              <th>Proveedor</th>
                              <th>Contacto</th>
                              <th>Fecha</th>
                              <th>Moneda</th>
                              <th>Cliente</th>
                              <th>Proveedor</th>
                              <th>Marca</th>
                              <th>Modelo</th>
                              <th>Descripción</th>
                              <th>Cantidad</th>
                              <th>Orden compra</th>
                              <th>Fecha pedido</th>
                              <th>Fecha enviado</th>
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

    <!-- Modal Crear OC -->
      <div class="modal fade colored-header colored-header-success" id="modalCrearOC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel"><b>Nueva orden de compra</b></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="frmCrearOC" action="#" method="POST">
                    <input type="hidden" id="opcion" name="opcion" value="crearordencompra">
                    <div class="row">
                      <div class="form-group col">
                        <label for="proveedor">Proveedor</label>
                        <input placeholder="Busca un proveedor" class="form-control form-control-sm" data-min-length="1" list="proveedor" id="proveedor" name="proveedor" type="text" required >
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <label for="saludo">Saludo</label>
                        <textarea name="saludo" id="saludo" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <label for="direccionenvio">Envia a</label>
                        <select name="direccionenvio" id="direccionenvio" class="form-control form-control-sm select2" onchange="agregardireccion()"></select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <textarea name="otra" id="otra" cols="30" rows="3" class="form-control form-control-sm" disabled></textarea>
                      </div>
                    </div>
                </div>
                <div class="modal-footer invoice-footer">
                  <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-lg btn-success">Hecho</button>
                  </form>
                </div>
            </div>
          </div>
      </div>

    <!-- Modal OC Pendientes -->
			<div class="modal fade" id="modalOCPendientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-12 row justify-content-center">
								<div class="form-group row justify-content-center col-12">
									<label class="control-label">Proveedores con herramienta sin entregar y sin crear OC</label>
								</div>
								<div class="form-group row justify-content-center col-12">
									<select name="proveedoressinoc" id="proveedoressinoc" class="form-control col-6" onchange="verproveedor2()"></select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

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
                  <h4>La orden de compra se esta generando</h4>
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
      $("#filtromes").val("<?php echo $mes; ?>").change();
			$("#filtroano").val("<?php echo $ano; ?>").change();
      guardar();
    });

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#compras-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#ordenesdecompras-menu").addClass("active");
    }

    $("#filtromes").on("change", function (){
			listar_ordenes();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$("#filtroano").on("change", function (){
			listar_ordenes();
			$('#dt_pedidos').DataTable().ajax.reload();
		});


		$('input[name=filtroestado]').change(function() {
			listar_ordenes();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

		$("#filtroreferencia").on("change", function (){
			listar_ordenes();
			$('#dt_pedidos').DataTable().ajax.reload();
		});

    var listar_ordenes = function(){
      var filtromes = $("#filtromes").val();
			var filtroano = $("#filtroano").val();
			var filtroestado = $("input[name=filtroestado]:checked").val();
			var filtroreferencia = $("#filtroreferencia").val();
			console.log(filtroano);
			console.log(filtromes);
			console.log(filtroestado);
			console.log(filtroreferencia);
      var table = $("#dt_ordenes").DataTable({
        "destroy":true,
        "scrollX": true,
        "autoWidth": false,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": filtroestado, "filtromes": filtromes, "filtroano": filtroano, "buscar": filtroreferencia}
        },
        "columns":[
          {"defaultContent":''},
          {"data":'ordencompra'},
          {"data":"proveedor"},
          {"data": "contacto",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
                return data;
							}else{
                return "";
							}
						},
					},
          {"data": "fecha",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
                return data;
							}else{
                return "";
							}
						},
					},
          {"data": "moneda",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
                return data;
							}else{
                return "";
							}
						},
					},
          {"data": "cliente",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "proveedor",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "marca",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "modelo",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "descripcion",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "cantidad",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "ordencompra",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "fechapedido",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"data": "fechaenviado",
						"render": function (data) {
							if (filtroestado == "ordenesdecompras") {
								return "";
							}else{
								return data;
							}
						},
					},
          {"defaultContent": "<div class='invoice-footer'><button class='veroc btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
        ],
        // "columnDefs": [
        //   { "width": "30%", "targets": 0 },
        //   { "width": "15%", "targets": 1 },
        //   { "width": "15%", "targets": 2 },
        //   { "width": "15%", "targets": 3 },
        //   { "width": "15%", "targets": 4 },
        //   { "width": "5%", "targets": 5 },
        // ],
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
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
          {
            text: '<i class="fas fa-shopping-cart fa-sm" aria-hidden="true"></i> Nueva Orden de Compra',
            "className": "btn btn-lg btn-space btn-secondary",
            action: function (e, dt, node, config){
            $("#modalCrearOC").modal("show");
            var opcion = "direccionenvio";
        		$.ajax({
              method: "POST",
              url: "buscar.php",
              dataType: "json",
              data: {"opcion": opcion},
              success: function (data) {
                console.log(data);
                var direcciones = data;
                $('select[name=direccionenvio]').empty();
                for(var i=0;i<direcciones.length;i=i+2){
                        $("select[name=direccionenvio]").append("<option value="+ direcciones[i] +">" + direcciones[i+1] + "</option>");
                };
                $("select[name=direccionenvio]").append("<option>Otra</option>");
                $("#frmCrearOC #idproveedor").val(idproveedor);
              }
						});
            var opcion = "buscarClientes";
              $.ajax({
                method: "POST",
                url: "buscar.php",
                dataType: "json",
                data: {"opcion": opcion},
                success : function(data) {
                  console.log(data);
                  var input = document.getElementById("proveedor");
        					var awesomplete = new Awesomplete(input);
        					awesomplete.list = data;
                }
              });
    				}
		      }
        ]
      });

      if (filtroestado == "ordenesdecompras") {
        table.columns( [4] ).order( 'desc' );
        table.columns( [6] ).visible( false );
				table.columns( [7] ).visible( false );
				table.columns( [8] ).visible( false );
				table.columns( [9] ).visible( false );
        table.columns( [10] ).visible( false );
        table.columns( [11] ).visible( false );
        table.columns( [12] ).visible( false );
        table.columns( [13] ).visible( false );
        table.columns( [14] ).visible( false );
      }else{
				table.columns( [1] ).visible( false );
				table.columns( [2] ).visible( false );
				table.columns( [3] ).visible( false );
				table.columns( [4] ).visible( false );
				table.columns( [5] ).visible( false );
        table.columns( [8] ).order( 'desc' );
			}

      table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
      } ).draw();

      obtener_data_id("#dt_ordenes tbody", table);
      // obtener_id_eliminar("#dt_orden_compras tbody", table);
    }

    var listar_ordenesdecompras = function(){
      $("#ordenesdecompras").slideDown("slow");
      $("#backorder").slideUp("slow");
      $("#sinenviar").slideUp("slow");
      $("#btnordenesdecompras").removeClass("btn-secondary");
      $("#btnordenesdecompras").addClass("btn-primary");
      $("#btnbackorder").removeClass("btn-primary");
      $("#btnbackorder").addClass("btn-secondary");
      $("#btnsinenviar").removeClass("btn-primary");
      $("#btnsinenviar").addClass("btn-secondary");

      var opcion = "ordenesdecompras";
      var table = $("#dt_orden_compras").DataTable({
        "destroy":true,
        "scrollX": true,
        "autoWidth": false,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion},
        },
        "columns":[
          {"data":'ordencompra'},
          {"data":"proveedor"},
          {"data":"contacto"},
          {"data":"fecha"},
          {"data":"moneda"},
          {"defaultContent": "<div class='invoice-footer'><button class='verOC btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
        ],
        // "columnDefs": [
        //   { "width": "30%", "targets": 0 },
        //   { "width": "15%", "targets": 1 },
        //   { "width": "15%", "targets": 2 },
        //   { "width": "15%", "targets": 3 },
        //   { "width": "15%", "targets": 4 },
        //   { "width": "5%", "targets": 5 },
        // ],
        "order":[[3, "desc"]],
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
            text: '<i class="fas fa-shopping-cart fa-sm" aria-hidden="true"></i> Nueva Orden de Compra',
            key: {
                shiftKey: true,
                key: 'o'
            },
            "className": "btn btn-lg btn-space btn-secondary",
            action: function (e, dt, node, config){
            $("#modalCrearOC").modal("show");
            var opcion = "direccionenvio";
        		$.ajax({
              method: "POST",
              url: "buscar.php",
              dataType: "json",
              data: {"opcion": opcion},
              success: function (data) {
                console.log(data);
                var direcciones = data;
                $('select[name=direccionenvio]').empty();
                for(var i=0;i<direcciones.length;i=i+2){
                        $("select[name=direccionenvio]").append("<option value="+ direcciones[i] +">" + direcciones[i+1] + "</option>");
                };
                $("select[name=direccionenvio]").append("<option>Otra</option>");
                $("#frmCrearOC #idproveedor").val(idproveedor);
              }
						});
            var opcion = "buscarClientes";
              $.ajax({
                method: "POST",
                url: "buscar.php",
                dataType: "json",
                data: {"opcion": opcion},
                success : function(data) {
                  console.log(data);
                  var input = document.getElementById("proveedor");
        					var awesomplete = new Awesomplete(input);
        					awesomplete.list = data;
                }
              });
    				}
		      }
        ]
      });

      $("#dt_orden_compras tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
      });
      obtener_data_id("#dt_orden_compras tbody", table);
      obtener_id_eliminar("#dt_orden_compras tbody", table);
    }

    var listar_backorder = function(){
      $("#ordenesdecompras").slideUp("slow");
      $("#backorder").slideDown("slow");
      $("#sinenviar").slideUp("slow");
      $("#btnbackorder").removeClass("btn-secondary");
      $("#btnbackorder").addClass("btn-primary");
      $("#btnordenesdecompras").removeClass("btn-primary");
      $("#btnordenesdecompras").addClass("btn-secondary");
      $("#btnsinenviar").removeClass("btn-primary");
      $("#btnsinenviar").addClass("btn-secondary");
      var opcion = "backorder";
      var table = $("#dt_backorder").DataTable({
        "destroy":"true",
        "bDeferRender": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php" ,
          "data": {"opcion": opcion},
        },
        "columns":[
          {"data":'indice'},
          {"data":"cliente"},
          {"data":"marca"},
          {"data":"modelo"},
          {"data":"descripcion"},
          {"data":"cantidad"},
          {"data":"fechapedido"},
          {"data":"ordencompra"},
          {"data":"proveedor"},
          {"data":"fechaenviado"}
        ],
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          }
        ]
      });
    }

     var listar_sinenviar = function(){
      $("#ordenesdecompras").slideUp("slow");
      $("#backorder").slideUp("slow");
      $("#sinenviar").slideDown("slow");
      $("#btnsinenviar").removeClass("btn-secondary");
      $("#btnsinenviar").addClass("btn-primary");
      $("#btnordenesdecompras").removeClass("btn-primary");
      $("#btnordenesdecompras").addClass("btn-secondary");
      $("#btnbackorder").removeClass("btn-primary");
      $("#btnbackorder").addClass("btn-secondary");
      var opcion = "sinenviar";
      var table = $("#dt_sinenviar").DataTable({
        "destroy":"true",
        "bDeferRender": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php" ,
          "data": {"opcion": opcion},
        },
        "columns":[
          {"data":'indice'},
          {"data":"cliente"},
          {"data":"marca"},
          {"data":"modelo"},
          {"data":"descripcion"},
          {"data":"cantidad"},
          {"data":"fechapedido"},
          {"data":"ordencompra"},
          {"data":"proveedor"},
          {"data":"fechaenviado"}
        ],
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
        ]
      });
    }

    var agregardireccion = function(){
      if ($("select[name=direccionenvio]").val() == "Otra"){
        document.getElementById('otra').disabled = false;
      }else{
        document.getElementById('otra').disabled = true;
      }
    }

    var obtener_data_id = function(tbody, table){
      $(tbody).on("click", "button.veroc", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var ordencompra = data.ordencompra;
        window.location.href = "verOrdenCompra.php?ordenCompra="+ordencompra;
      });
    }

    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        var idcontacto = $("#frmEliminarUsuario #idcompra").val(data.id);
      });
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        $('.modal').modal('hide');
        $("#mod-success").modal("show");
        var frm = $(this).serialize();
        console.log(frm);
        $.ajax({
          method: "POST",
          url: "guardar.php",
          dataType: "json",
          data: frm,
        }).done( function( info ){
          console.log(info);
          if (info.respuesta == "agregarordencompra") {
            setTimeout(function () {
              $(".texto1").fadeOut(300, function(){
                $(this).html("");
                $(this).fadeIn(300);
              });
            }, 2000);
            setTimeout(function () {
              $(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
              $(".texto1").append("<h3>Correcto!</h3>");
              $(".texto1").append("<h4>La orden de compra se generó correctamente.</h4>");
              $(".texto1").append("<div class='text-center'>");
              $(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
              $(".texto1").append("</div>");
            }, 2500);
            setTimeout(function () {
              window.location.href = "verOrdenCompra.php?ordenCompra="+info.ordencompra;
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
  <script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
  <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
