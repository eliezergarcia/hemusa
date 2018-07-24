<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Descripcion de Pedido</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="page-head">
          <h2 class="page-head-title" style="font-size: 30px;"><b>Descripción de pedido</b></h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Compras</li>
              <li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="ordenesdecompras.php" class="text-primary">Ordenes de compras</a></li>
              <li id="breadcrumb" class="breadcrumb-item" aria-current="page">
                Orden de compra: <a id="toolTipVerCliente" href="<?php echo $ruta; ?>php/compras/ordenesdecompras/verOrdenCompra.php?ordenCompra=<?php echo $_REQUEST['ordenCompra']; ?>" class="text-primary"><?php echo $_REQUEST['ordenCompra']; ?></a>
              </li>
              <li id="breadcrumb" class="breadcrumb-item active" aria-current="page">Descripción de pedido</li>
            </ol>
          </nav>
      </div>
      <div class="main-content container-fluid">
          <div class="row full-calendar">
            <div class="col-lg-12">
                <div class="card card-fullcalendar">
                    <div class="card-body">
                         <!-- Tabla de Partidas -->
                          <br>
                          <table id="dt_partidas_oc_descripcion" class="table table-hover table-striped table-bordered compact" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th><input type="checkbox" class="btn btn-outline-primary" name="checksel" onclick="seleccionartodo()"></th>
                                <th>#</th>
                                <th>Enviado</th>
                                <th>Recibido</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>Proveedor</th>
                                <th>Entrada</th>
                                <th>Cliente</th>
                                <th>Pedido</th>
                                <th>Fecha</th>
                                <th>Tipo cambio</th>
                                <th>Costo MXN</th>
                                <th>Costo USD</th>
                                <th>Costo Total (MXN)</th>
                                <th>Costo Total (USD)</th>
                                <th>Factura Proveedor</th>
                                <th>Factura Hemusa</th>
                                <th>Remision</th>
                                <th>Cant. Faturada</th>
                                <th>Venta MXN</th>
                                <th>Venta USD</th>
                                <th>Total Venta MXN</th>
                                <th>Total Venta USD</th>
                                <th>Moneda</th>
                                <th>Utilidad</th>
                                <th>Folio</th>
                                <th>Pedimento</th>
                                <th>Editar</th>
                                <th></th>
                              </tr>
                            </thead>
                          </table>

                        <!-- Tabla de Total -->
                          <br>
                          <table id="dt_totales_oc" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Costo</th>
                                <th>Flete</th>
                                <th>Venta</th>
                                <th>Utilidad</th>
                              </tr>
                            </thead>
                          </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar Partida -->
      <form action="" method="POST" id="frmEditarPartida">
        <div class="modal fade colored-header colored-header-primary" id="modalEditarPartida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de partida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row justify-content-center">
                  <input type="hidden" name="opcion" id="opcion" value="editarpartidadescripcion">
                  <input type="hidden" name="idpartida" id="idpartida" value="">
                  <input type="hidden" name="ordencompra" id="ordencompra">
                  <div class="col-12 justify-content-center align-items-end">
                    <div class="col row form-group justify-content-center">
                      <label for="pedimento" class="col">Pedimento:</label>
                      <input type="text" class="form-control form-control-sm col" name="pedimento" id="pedimento">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="folio" class="col">Folio:</label>
                      <input type="text" class="form-control form-control-sm col" name="folio" id="folio">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="facturaproveedor" class="col">Factura proveedor:</label>
                      <input type="text" class="form-control form-control-sm col" name="facturaproveedor" id="facturaproveedor">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="entrada" class="col">Entrada:</label>
                      <input type="text" class="form-control form-control-sm col" name="entrada" id="entrada">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer invoice-footer">
                <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    <!-- Modal Actualizar Datos -->
      <form action="" method="POST" id="frmActualizarDatos">
        <div class="modal fade colored-header colored-header-success" id="modalActualizarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row justify-content-center">
                  <input type="hidden" name="opcion" id="opcion" value="actualizar">
                  <input type="hidden" name="ordencompra" id="ordencompra">
                  <div class="col-12 justify-content-center align-items-end">
                    <div class="col row form-group justify-content-center">
                      <label for="pedimento" class="col">Pedimento:</label>
                      <input type="text" class="form-control form-control-sm col" name="pedimento" id="pedimento">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="folio" class="col">Folio:</label>
                      <input type="text" class="form-control form-control-sm col" name="folio" id="folio">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="facturaproveedor" class="col">Factura proveedor:</label>
                      <input type="text" class="form-control form-control-sm col" name="facturaproveedor" id="facturaproveedor">
                    </div>
                    <div class="col row form-group justify-content-center">
                      <label for="entrada" class="col">Entrada:</label>
                      <input type="text" class="form-control form-control-sm col" name="entrada" id="entrada">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer invoice-footer">
                <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-lg btn-success">Agregar</button>
              </div>
            </div>
          </div>
        </div>
      </form>

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
      var ordencompra = "<?php echo $_REQUEST['ordenCompra']; ?>";
      var opcion = "datosordencompra";
      listar_partidas(ordencompra);
      listar_totales(ordencompra);
      guardar(ordencompra);
    });

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#compras-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#ordenesdecompras-menu").addClass("active");
    }

    function seleccionartodo(){
      $("input[name=hcheck]").each(function (index) {
				if($("input[name=checksel]").is(':checked')){
					$('input[name=hcheck]').prop('checked' , true);
				}else{
					$('input[name=hcheck]').prop('checked' , false);
				}
			});
    }

    var listar_partidas = function(ordencompra){
      var opcion = "partidasocdescripcion";
      var table = $("#dt_partidas_oc_descripcion").DataTable({
        "destroy":"true",
        "bDeferRender": true,
        "scrollX": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion, "ordencompra": ordencompra}
        },
        "columns":[
          {"data":'check'},
          {"data":'indice'},
          {"data":'enviado'},
          {"data":'recibido'},
          {"data":'marca'},
          {"data":'modelo'},
          {"data":'cantidad'},
          {"data":'descripcion'},
          {"data":'proveedor'},
          {"data":'entrada'},
          {"data":'cliente'},
          {"data":'pedido'},
          {"data":'fecha'},
          {"data":'tipocambio'},
          {"data":'costomxn'},
          {"data":'costousd'},
          {"data":'totalmxn'},
          {"data":'totalusd'},
          {"data":'facturap'},
          {"data":'facturah'},
          {"data":'remision'},
          {"data":'cantfacturada'},
          {"data":'ventamxn'},
          {"data":'ventausd'},
          {"data":'totalventamxn'},
          {"data":'totalventausd'},
          {"data":'moneda'},
          {"data":'utilidad'},
          {"data":'folio'},
          {"data":'pedimento'},
          {"defaultContent":'<div class="invoice-footer"><button class="editar btn btn-lg btn-primary" data-toggle="modal" data-target="#modalEditarPartida"><i class="fas fa-edit fa-sm" aria-hidden="true"></i></button></div>'},
          {"defaultContent":'<div class="invoice-footer"><button class="duplicar btn btn-lg btn-primary">Duplicar</button></div>'}
        ],
        "order":[[3, "desc"]],
        // "searching": false,
        "info": false,
        "paging": false,
        "ordering": false,
        "language": idioma_espanol,
        "dom":
          "<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
          "<'row be-datatable-body'<'col-sm-12'tr>>" +
          "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        "createdRow": function ( row, data, index ) {
          if ( data.proveedor || data.proveedor == "") {
            $('td', row).eq(8).addClass('table-text-proveedor');
          }
          if ( data.cliente || data.cliente == "") {
            $('td', row).eq(10).addClass('table-text-cliente');
          }
          if ( data.pedido || data.pedido == "") {
            $('td', row).eq(11).addClass('table-text-pedido');
          }
          if ( data.facturap || data.facturap == "") {
            $('td', row).eq(18).addClass('table-text-facturap');
          }
          if ( data.facturah || data.facturah == "") {
            $('td', row).eq(19).addClass('table-text-facturah');
          }
          if ( data.remision || data.remision == "") {
            $('td', row).eq(20).addClass('table-text-remision');
          }
          if ( data.totalventamxn || data.totalventamxn == "") {
            $('td', row).eq(24).addClass('table-text-totalventamxn');
          }
          if ( data.totalventausd || data.totalventausd == "") {
            $('td', row).eq(25).addClass('table-text-totalventausd');
          }
          if ( data.folio || data.folio == "") {
            $('td', row).eq(28).addClass('table-text-folio');
          }
          if ( data.pedimento || data.pedimento == "") {
            $('td', row).eq(29).addClass('table-text-pedimento');
          }
        },
        "buttons": [
          {
            text: 'Actualizar datos',
            "className": "btn btn-success btn-lg",
            action: function (e, dt, node, config){
              $("#modalActualizarDatos").modal("show");
            }
          }
        ]
      });
      obtener_data_partida("#dt_partidas_oc_descripcion tbody", table);
      obtener_data_duplicar("#dt_partidas_oc_descripcion tbody", table);
    }

    var listar_totales = function(ordencompra){
      var opcion = "totalesocdescripcion";
      console.log(opcion);
      console.log(ordencompra);
      var table = $("#dt_totales_oc").DataTable({
        "destroy":"true",
        "bDeferRender": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion, "ordencompra": ordencompra}
        },
        "columns":[
          {"data":"costo"},
          {"data":"flete"},
          {"data":"venta"},
          {"data":"utilidad"}
        ],
        "dom":
          // "<'row be-datatable-header'<'col-sm-4'>>" +
          "<'row be-datatable-body'<'col-sm-4'tr>>",
        "searching": false,
        "info": false,
        "paging": false,
        "ordering": false
      });
    }

    var guardar = function(ordencompra){
      $("form").on("submit", function(e){
        e.preventDefault();
        var opcion =  $("#opcion", this).val();

        console.log(opcion);
        if (opcion == "editarpartidadescripcion") {
          var frm = $(this).serialize();
          $(".modal").modal("hide");
          // var frm = $(this).serialize();
          $.ajax({
            method: "POST",
            url: "guardar.php",
            data: frm,
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje(json_info);
            $("#dt_partidas_oc_descripcion").DataTable().ajax.reload();
            $("#dt_totales_oc").DataTable().ajax.reload();
          });
        }else{

          $("#frmActualizarDatos #ordencompra").val(ordencompra);
          var frm = $(this).serialize();
          console.log(frm);

          var verificar = 0;
          $("input[name=hcheck]").each(function (index) {
            if($(this).is(':checked')){
              verificar++;
            }
          });
          if(verificar == 0){
            alert("Debes de seleccionar al menos una partida!");
          }else{
            var herramienta = new Array();
            $("input[name=hcheck]").each(function (index) {
              if($(this).is(':checked')){
                herramienta.push($(this).val());
              }
            });
            console.log(herramienta);

            if ($("#frmActualizarDatos #pedimento").val().length != 0 && $("#frmActualizarDatos #pedimento").val().length != 21 && $("#frmActualizarDatos #pedimento").val() != "2018*") {
              alert("El número de pedimento es inválido!\nVerifica que tiene la siguiente estructura\nEjemplo: XX--XX--XXXX--XXXXXXX");
            }else{
              var pedimento = $("#frmActualizarDatos #pedimento").val();
              var folio = $("#frmActualizarDatos #folio").val();
              var facturaproveedor = $("#frmActualizarDatos #facturaproveedor").val();
              var entrada = $("#frmActualizarDatos #entrada").val();
              var opcion = "actualizar";
              $(".modal").modal("hide");
              $.ajax({
                method: "POST",
                url: "guardar.php",
                data: {"herramienta": JSON.stringify(herramienta), "pedimento": pedimento, "folio": folio, "facturaproveedor": facturaproveedor, "entrada": entrada, "opcion": opcion}
              }).done( function( info ){
                var json_info = JSON.parse( info );
                mostrar_mensaje(json_info);
                $("#dt_partidas_oc_descripcion").DataTable().ajax.reload();
                $("#dt_totales_oc").DataTable().ajax.reload();
              });
            }
          }
        }
      });
    }

    var obtener_data_partida = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        console.log(data);
        $("#frmEditarPartida #idpartida").val(data.id)
        $("#frmEditarPartida #ordencompra").val(data.pedido)
        $("#frmEditarPartida #pedimento").val(data.pedimento)
        $("#frmEditarPartida #folio").val(data.folio)
        $("#frmEditarPartida #facturaproveedor").val(data.facturap)
        $("#frmEditarPartida #entrada").val(data.entrada)
      });
    }

    var obtener_data_duplicar = function(tbody, table){
      $(tbody).on("click", "button.duplicar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        console.log(data);
        var cantidad = data.cantidad;
        var idherramienta = data.id;
        var opcion = "duplicar";
  			var cantduplicar = prompt("Ingresa la cantidad para Almacén: ");
        if (cantduplicar < 1 || cantduplicar > cantidad) {
  				alert("Error en la cantidad del split");
  			}else{
          $.ajax({
  					method: "POST",
  					url: "guardar.php",
  					dataType: "json",
  					data: {"opcion": opcion, "idherramienta": idherramienta, "cantduplicar": cantduplicar, "cantidad": cantidad},
  				}).done( function( info ){
  					mostrar_mensaje(info);
  					$("#dt_partidas_oc_descripcion").DataTable().ajax.reload();
  				});
        }
      });
    }
  </script>
  <script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
  <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
