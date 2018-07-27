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
          <h2 class="page-head-title">Ordenes de compras</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Logística</li>
              <li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="../../compras/ordenesdecompras/ordenesdecompras.php" class="text-primary">Ordenes de compras</a></li>
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
                          <div class="row align-items-end">
                            <div class="col-1 table-filters"><span class="table-filter-title">Fecha <i class="fas fa-calendar-alt"></i></span>
                              <div class="filter-container">
                                <form>
                                  <div class="row">
                                    <div class="col-12">
                                      <label for="filtroano">Año: </label>
                                      <select name="filtroano" id="filtroano" class="form-control form-control-sm">
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
                            <div class="col-3 table-filters"><span class="table-filter-title">Filtro <i class="fas fa-filter"></i></span>
                              <div class="filter-container">
                                <form>
                                  <div class="row">
                                    <div class="col-4">
                                      <label for="ordencompra">Orden de compra: </label>
                                      <input type="text" class="form-control form-control-sm" name="ordencompra" id="ordencompra">
                                    </div>
                                    <div class="col-4">
                                      <label for="folio">Folio: </label>
                                      <input type="text" class="form-control form-control-sm" name="folio" id="folio">
                                    </div>
                                    <div class="col-4">
                                      <label for="pedimento">Pedimento: </label>
                                      <input type="text" class="form-control form-control-sm" name="pedimento" id="pedimento">
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <div class="col-2 table-filters"><span class="table-filter-title"></span>
                              <div class="filter-container">
                                <div class="row">
                                  <button class="btn btn-lg btn-primary" onclick="listar_partidas()"><i class="fas fa-search fa-sm"></i> Buscar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                         <!-- Tabla de Partidas -->
                          <br>
                          <table id="dt_partidas_oc_descripcion" class="table table-hover table-striped compact" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <!-- <th><input type="checkbox" class="btn btn-outline-primary" name="checksel" onclick="seleccionartodo()"></th> -->
                                <th>
            											<label class="custom-control custom-control-sm custom-checkbox">
            												<input class="custom-control-input" name="checksel" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
            											</label>
            										</th>
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
                                <th>Cant. Facturada</th>
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
      guardar();
    });

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#logistica-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#ordenesdecompraslogisitca-menu").addClass("active");
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

    var listar_partidas = function(){
      var ano = $("#filtroano").val();
      var folio = $("#folio").val();
      var pedimento = $("#pedimento").val();
      var ordencompra = $("#ordencompra").val();
      $("#folio").val("");
      $("#ordencompra").val("");
      $("#pedimento").val("");
      var opcion = "partidasocdescripcion";
      var table = $("#dt_partidas_oc_descripcion").DataTable({
        "destroy":"true",
        "bDeferRender": true,
        "scrollX": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion, "ano": ano, "folio": folio, "ordencompra": ordencompra, "pedimento": pedimento}
        },
        "columns":[
          {"data": null,
						"render": function (data, row) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hcheck' value='"+data.idcotizacionherramientas+"' class='custom-control-input' type='checkbox' onclick='cambiar_total()'><span class='custom-control-label'></span></label>";
						},
					},
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
        "order":[[3, "desc"]],
        "info": false,
        "paging": false,
        "ordering": false,
        "language": idioma_espanol,
        "dom":
          "<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
          "<'row be-datatable-body'<'col-sm-12'tr>>" +
          "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",

        "buttons": [
          {
            extend: 'collection',
            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
            "className": "btn btn-lg btn-space btn-secondary",
            buttons: [
                {
                  extend:    'excelHtml5',
                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel Nacional',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 28  ]
                  },
                  title: 'excel_nacional',
                  customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c', sheet).attr( 's', '25' );
                  }
                },
                {
                  extend: 'excelHtml5',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Excel Importacion',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29]
                  },
                  title: 'excel_importacion',
                  customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c', sheet).attr( 's', '25' );
                  }
                },
            ]
          },
          {
            text: 'Actualizar datos',
            "className": "btn btn-lg btn-space btn-success",
            action: function (e, dt, node, config){
              $("#modalActualizarDatos").modal("show");
            }
          }
        ]
      });
      obtener_data_partida("#dt_partidas_oc_descripcion tbody", table);
      obtener_data_duplicar("#dt_partidas_oc_descripcion tbody", table);
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
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

          if ($("#frmActualizarDatos #pedimento").val().length != 0 && $("#frmActualizarDatos #pedimento").val().length != 21 ) {
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
