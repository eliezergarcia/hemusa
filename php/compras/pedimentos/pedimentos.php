<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
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
              <h2 class="page-head-title">Pedimentos</h2>
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="#">Compras</a></li>
                    <li class="breadcrumb-item"><a href="#">Pedimentos</a></li>
                </ol>
              </nav>
          </div>
          <div class="main-content container-fluid">
              <div class="row full-calendar">
                <div class="col-lg-12">
                    <div class="card card-fullcalendar">
                        <div class="card-body">
                           <!-- Form buscar pedimentos -->
                            <div class="col-12">
                              <div class="row justify-content-center">
                                <div>
                                  <div class="row justify-content-center form-group">
                                    <label for="fechaInicio">Fecha Inicio:</label>
                                    <input type="date" class="form-control form-control-sm row justify-content-center" name="fechaInicio" id="fechaInicio">
                                  </div>
                                  <div class="row justify-content-center form-group">
                                    <label for="fechaInicio">Fecha Fin:</label>
                                    <input type="date" class="form-control form-control-sm" name="fechaFin" id="fechaFin">
                                  </div>
                                  <div class="row justify-content-center form-group">
                                    <button class="btn btn-lg btn-primary" onclick="listar()"><i class="fas fa-search fa-sm"></i> Buscar</button>
                                  </div>
                                  <div class="row justify-content-center form-group">
                                    <button class="btn btn-lg btn-secondary" data-toggle="modal" data-target="#modalAgregarPedimento"><i class="far fa-file-alt fa-sm"></i> Agregar pedimento</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <!-- Tabla de pedimentos -->
                            <table id="dt_pedimentos" class="table table-bordered table-striped display compact" cellspacing="0" width="100%">
                              <thead>
                                <th>Fecha</th>
                                <th>Número</th>
                                <th>Valor</th>
                                <th>CNT</th>
                                <th>DTA</th>
                                <th>PRV</th>
                                <th>IGI</th>
                                <th>IVA</th>
                                <th>Editar</th>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
          </div>
        </div>
    </div>

    <!-- Modal Agregar Pedimento -->
      <form action="" method="POST">
        <input type="hidden" name="opcion" id="opcion" value="agregarpedimento">
        <div class="modal fade colored-header colored-header-success" id="modalAgregarPedimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><i class="far fa-file-alt fa-sm"></i> Registro de pedimento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body row justify-content-center">
                <div class="row justify-content-center form-group col-12">
                  <label for="fechaPedimento" class="col-4">Fecha pedimento: <font color="#FF4136">*</font></label>
                  <input type="date" class="form-control form-control-sm col-6" name="fechaPedimento" id="fechaPedimento" value="<?php echo date("Y-m-d"); ?>" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="numeroPedimento" class="col-4">Número pedimento: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="numeroPedimento" id="numeroPedimento" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="aduana" class="col-4">Aduana: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="aduana" id="aduana" value="Nuevo Laredo">
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="valorAduana" class="col-4">Valor aduana: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="valorAduana" id="valorAduana" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="cnt" class="col-4">CNT: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="cnt" id="cnt" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="dta" class="col-4">DTA: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="dta" id="dta" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="prv" class="col-4">PRV: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="prv" id="prv" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="igi" class="col-4">IGI: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="igi" id="igi" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="iva" class="col-4">IVA: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="iva" id="iva" value="" required>
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

    <!-- Modal Editar Pedimento -->
      <form action="" method="POST" id="frmEditarPedimento">
        <input type="hidden" name="opcion" id="opcion" value="editarpedimento">
        <input type="hidden" name="idpedimento" id="idpedimento">
        <div class="modal fade colored-header colored-header-primary" id="modalEditarPedimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><i class="icon fas fa-edit fa-sm"></i> Información de pedimento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body row justify-content-center">
                <div class="row justify-content-center form-group col-12">
                  <label for="fechaPedimento" class="col-4">Fecha pedimento: <font color="#FF4136">*</font></label>
                  <input type="date" class="form-control form-control-sm col-6" name="fechaPedimento" id="fechaPedimento" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="numeroPedimento" class="col-4">Número pedimento: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="numeroPedimento" id="numeroPedimento" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="aduana" class="col-4">Aduana: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="aduana" id="aduana" value="Nuevo Laredo">
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="valorAduana" class="col-4">Valor aduana: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="valorAduana" id="valorAduana" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="cnt" class="col-4">CNT: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="cnt" id="cnt" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="dta" class="col-4">DTA: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="dta" id="dta" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="prv" class="col-4">PRV: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="prv" id="prv" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="igi" class="col-4">IGI: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="igi" id="igi" value="" required>
                </div>
                <div class="row justify-content-center form-group col-12">
                  <label for="iva" class="col-4">IVA: <font color="#FF4136">*</font></label>
                  <input type="text" class="form-control form-control-sm col-6" name="iva" id="iva" value="" required>
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
  </head>
  <?php include('../../enlacesjs.php'); ?>
  <script>
    $(document).ready(function(){
      App.init();
      App.pageCalendar();
      App.formElements();
      App.uiNotifications();
      guardar();
    });

    var listar = function(){
      var fechaInicio = $("#fechaInicio").val(),
          fechaFin = $("#fechaFin").val();
      $("#dt_pedimentos").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
      var table = $("#dt_pedimentos").DataTable({
        "destroy":"true",
        "ajax":{
          "method":"POST",
          "url":"listar_pedimentos.php",
          "data": {"fechaInicio": fechaInicio, "fechaFin": fechaFin}
        },
        "columns":[
          {"data":"fecha"},
          {"data":"numero_pedimento"},
          {
            "data":"valor_aduana",
            "render": function(valor_aduana){
              return "$ " + valor_aduana;
            }
          },
          {
            "data":"cnt", "sortable": false,
            "render": function(cnt){
              return "$ " + cnt;
            }
          },
          {
            "data":"dta", "sortable": false,
            "render": function(dta){
              return "$ " + dta;
            }
          },
          {
            "data":"prv", "sortable": false,
            "render": function(prv){
              return "$ " + prv;

            }
          },
          {
            "data":"igi", "sortable": false,
            "render": function(igi){
              return "$ " + igi;
            }
          },
          {
            "data":"iva", "sortable": false,
            "render": function(iva){
              return "$ " + iva;
            }
          },
          {"defaultContent":"<div class='invoice-footer'><button type='button' class='editar btn btn-lg btn-primary' data-toggle='modal' data-target='#modalEditarPedimento'><i class='fas fa-edit fa-sm'></i></button></div>", "sortable": false}
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var aduanasTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var cntTotal = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var dtaTotal = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var prvTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var igiTotal = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var ivaTotal = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            $( api.column( 1 ).footer() ).html('Total');
            $( api.column( 2 ).footer() ).html('$ ' + aduanasTotal + '.00');
            $( api.column( 3 ).footer() ).html('$ ' + cntTotal + '.00');
            $( api.column( 4 ).footer() ).html('$ ' + dtaTotal + '.00');
            $( api.column( 5 ).footer() ).html('$ ' + prvTotal + '.00');
            $( api.column( 6 ).footer() ).html('$ ' + igiTotal + '.00');
            $( api.column( 7 ).footer() ).html('$ ' + ivaTotal + '.00');
        },
        "order": [[ 0, "desc" ]],
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
        ]
      });
      obtener_data_editar("#dt_pedimentos tbody", table);
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        if ($("#numeroPedimento").val().length != 0 && $("#numeroPedimento").val().length != 21 ) {
            alert("El número de pedimento es inválido!\nVerifica que tenga la siguiente estructura\nEjemplo: XX--XX--XXXX--XXXXXXX");
        }else{
          $(".modal").modal("hide");
          var frm = $(this).serialize();
          console.log(frm);
          $.ajax({
            method: "POST",
            url: "guardar.php",
            dataType: "json",
            data: frm
          }).done( function( info ){
            mostrar_mensaje(info);
            $("#dt_pedimentos").DataTable().ajax.reload();
          });
        }
      });
    }

    var limpiar_datos = function(){
      $("#opcion").val("registrar");
      $("#fecha").val("").focus();
      $("#numero_pedimento").val("");
      $("#aduana").val("Nuevo Laredo");
      $("#valor_aduana").val("");
      $("#cnt").val("");
      $("#dta").val("");
      $("#igi").val("");
      $("#prv").val("");
      $("#iva").val("");
    }

    var agregar_nuevo_pedimento = function(){
      limpiar_datos();
      $("#cuadro2").slideDown("slow");
      $("#cuadro1").slideUp("slow");
    }

    var obtener_data_editar = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        console.log(data);
        $("#frmEditarPedimento #idpedimento").val(data.id),
        $("#frmEditarPedimento #fechaPedimento").val(data.fecha),
        $("#frmEditarPedimento #numeroPedimento").val(data.numero_pedimento),
        $("#frmEditarPedimento #aduana").val(data.aduana),
        $("#frmEditarPedimento #valorAduana").val(data.valor_aduana),
        $("#frmEditarPedimento #cnt").val(data.cnt),
        $("#frmEditarPedimento #dta").val(data.dta),
        $("#frmEditarPedimento #prv").val(data.prv),
        $("#frmEditarPedimento #igi").val(data.igi),
        $("#frmEditarPedimento #iva").val(data.iva);
      });
    }

  </script>
  <script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
  <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
