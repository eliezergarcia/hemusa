<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
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
          <h2 class="page-head-title">Ordenes de compras</h2>
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
                        <!-- Grupo de botones -->
                          <div class="row justify-content-center btn-toolbar">
                            <div role="group" class="btn-group btn-group-justified mb-2 col-6">
                              <a href="#" id="btnordenesdecompras" class="btn btn-primary btn-space" onclick="listar_ordenesdecompras()">ORDENES DE COMPRAS</a href="#">
                                <a href="#" id="btnbackorder" class="btn btn-primary btn-space" onclick="listar_backorder()">BACKORDER</a href="#">
                              <a href="#" id="btnsinenviar" class="btn btn-primary btn-space" onclick="listar_sinenviar()">SIN ENVIAR</a href="#">
                            </div>
                          </div>

                        <!-- Tabla Ordenes de Compras -->
                          <br>
                          <div id="ordenesdecompras">
                            <table id="dt_orden_compras" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Orden</th>
                                  <th>Proveedor</th>
                                  <th>Contacto</th>
                                  <th>Fecha</th>
                                  <th>Ver Orden</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                              <!-- <tfoot>
                                <tr>
                                  <th>Orden</th>
                                  <th>Proveedor</th>
                                  <th>Contacto</th>
                                  <th>Fecha</th>
                                  <td></td>
                                </tr>
                              </tfoot> -->
                            </table>
                          </div>

                       <!-- Tabla Backorder -->
                          <br>
                          <div id="backorder">
                            <table id="dt_backorder" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Cliente</th>
                                  <th>Marca</th>
                                  <th>Modelo</th>
                                  <th>Descripción</th>
                                  <th>Cantidad</th>
                                  <th>Fecha pedido</th>
                                  <th>Orden compra</th>
                                  <th>Proveedor</th>
                                  <th>Fecha enviado</th>
                                </tr>
                              </thead>
                            </table>
                          </div>

                        <!-- Tabla Sin Enviar -->
                          <br>
                            <div id="sinenviar">
                              <table id="dt_sinenviar" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Fecha pedido</th>
                                    <th>Orden compra</th>
                                    <th>Proveedor</th>
                                    <th>Fecha enviado</th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
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
                  <h4 class="modal-title" id="exampleModalLabel"><i class="icon fas fa-shopping-cart"></i> Nueva orden de compra</h4>
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

  </header>
  <?php include('../../enlacesjs.php'); ?>
  <script>
    $(document).ready(function(){
    //   buscar_oc_pendientes();
		  // setInterval(buscar_oc_pendientes, 3000);
      App.init();
      App.pageCalendar();
      App.formElements();
      App.uiNotifications();
      guardar();
      listar_ordenesdecompras();
    });

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
      // $('#dt_orden_compras tfoot th').each( function () {
      //   var title = $(this).text();
      //   $(this).html( '<input class="form-control form-control-sm" type="text" placeholder="Buscar '+title+'" />' );
      // });

      var opcion = "ordenesdecompras";
      var table = $("#dt_orden_compras").DataTable({
        "destroy":true,
        "scrollX": true,
        "bDeferRender": true,
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
          {"defaultContent": "<div class='invoice-footer'><button class='verOC btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
        ],
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
            text: '<i class="fas fa-shopping-cart fa-sm" aria-hidden="true"></i> Nueva OC',
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
                  var proveedores = data;
                  console.log(proveedores);
                  $("#frmCrearOC #proveedor").autocomplete({
                    source: proveedores
                  });
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
      $(tbody).on("click", "button.verOC", function(){
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
        var frm = $(this).serialize();
        console.log(frm);
        $.ajax({
          method: "POST",
          url: "guardar.php",
          data: frm,
        }).done( function( info ){
          console.log(info);
          var datos = JSON.parse(info);
          if (datos.respuesta == "agregarordencompra") {
            window.location.href = "verOrdenCompra.php?ordenCompra="+datos.ordencompra;
          }else{
            console.log(datos);
            mostrar_mensaje(datos);
          }
        });
      });
    }
  </script>
  <script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
  <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
