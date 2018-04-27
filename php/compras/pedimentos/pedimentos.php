<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Ordenes de Compras</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <main class="mdl-layout__content">
      <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Compras</li>
            <li class="breadcrumb-item active">Pedimentos</li>
          </ol>
        </nav>

      <!-- Encabezado -->
        <div>
          <br>
          <center><h1><b>Pedimentos</b></h1></center>
        </div>

      <!-- Mensaje de actualizaciones-->
          <div>
            <center><h6 class="mensaje"></h6></center>
          </div>


      <!-- Form buscar pedimentos -->
        <div class="col-12">
          <div class="row justify-content-center">
            <div>
              <div class="row justify-content-center form-group">
                <label for="fechaInicio">Fecha Inicio:</label>
                <input type="date" class="form-control row justify-content-center" name="fechaInicio" id="fechaInicio">
              </div>
              <div class="row justify-content-center form-group">
                <label for="fechaInicio">Fecha Fin:</label>
                <input type="date" class="form-control" name="fechaFin" id="fechaFin">
              </div>
              <div class="row justify-content-center form-group">
                <button class="btn btn-primary" onclick="listar()">Buscar</button>
              </div>
              <div class="row justify-content-center form-group">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPedimento">Agregar Pedimento</button>
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

      <!-- Modal Agregar Pedimento -->
        <form action="" method="POST">
          <input type="hidden" name="opcion" id="opcion" value="agregarpedimento">
          <div class="modal fade" id="modalAgregarPedimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Pedimento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <div class="row justify-content-center form-group col-12">
                    <label for="fechaPedimento" class="col">Fecha pedimento: <font color="#FF4136">*</font></label>
                    <input type="date" class="form-control row justify-content-center col" name="fechaPedimento" id="fechaPedimento" value="<?php echo date("Y-m-d"); ?>" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="numeroPedimento" class="col">Número pedimento: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="numeroPedimento" id="numeroPedimento" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="aduana" class="col">Aduana: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="aduana" id="aduana" value="Nuevo Laredo">
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="valorAduana" class="col">Valor aduana: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="valorAduana" id="valorAduana" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="cnt" class="col">CNT: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="cnt" id="cnt" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="dta" class="col">DTA: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="dta" id="dta" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="prv" class="col">PRV: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="prv" id="prv" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="igi" class="col">IGI: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="igi" id="igi" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="iva" class="col">IVA: <font color="#FF4136">*</font></label>
                    <input type="text" class="form-control col" name="iva" id="iva" value="" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </form>

      <!-- Modal Editar Pedimento -->
        <form action="" method="POST" id="frmEditarPedimento">
          <input type="hidden" name="opcion" id="opcion" value="editarpedimento">
          <input type="hidden" name="idpedimento" id="idpedimento">
          <div class="modal fade" id="modalEditarPedimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Pedimento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <div class="row justify-content-center form-group col-12">
                    <label for="fechaPedimento" class="col">Fecha pedimento:</label>
                    <input type="date" class="form-control row justify-content-center col" name="fechaPedimento" id="fechaPedimento" value="<?php echo date("Y-m-d"); ?>" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="numeroPedimento" class="col">Número pedimento:</label>
                    <input type="text" class="form-control col" name="numeroPedimento" id="numeroPedimento" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="aduana" class="col">Aduana:</label>
                    <input type="text" class="form-control col" name="aduana" id="aduana" value="Nuevo Laredo">
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="valorAduana" class="col">Valor aduana:</label>
                    <input type="text" class="form-control col" name="valorAduana" id="valorAduana" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="cnt" class="col">CNT</label>
                    <input type="text" class="form-control col" name="cnt" id="cnt" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="dta" class="col">DTA</label>
                    <input type="text" class="form-control col" name="dta" id="dta" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="prv" class="col">PRV</label>
                    <input type="text" class="form-control col" name="prv" id="prv" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="igi" class="col">IGI</label>
                    <input type="text" class="form-control col" name="igi" id="igi" value="" required>
                  </div>
                  <div class="row justify-content-center form-group col-12">
                    <label for="iva" class="col">IVA</label>
                    <input type="text" class="form-control col" name="iva" id="iva" value="" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Editar</button>
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
          {"defaultContent":"<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditarPedimento'><i class='fa fa-pencil-square-o'></i></button>", "sortable": false}
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
          "<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
          "<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
          "<'container-fluid row'<'row justify-content-center col-12 buttons'i>>"+
          "<'container-fluid row'<'row justify-content-center col-12 buttons'p>>",
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
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprimir',
            header: 'false',
            "className": "btn iconoimprimir",
            orientation: 'landscape',
            pageSize: 'LEGAL'
          },
        ]
      });
      obtener_data_editar("#dt_pedimentos tbody", table);
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        if ($("#numeroPedimento").val().length != 0 && $("#numeroPedimento").val().length != 21 ) {
            alert("El número de pedimento es inválido!\nVerifica que tiene la siguiente estructura\nEjemplo: XX--XX--XXXX--XXXXXXX");
        }else{
          $(".modal").modal("hide");
          var frm = $(this).serialize();
          console.log(frm);
          $.ajax({
            method: "POST",
            url: "guardar.php",
            data: frm
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje(json_info);
            listar();
          });
        }
      });
    }

    var mostrar_mensaje = function( informacion ){
      var texto = "", color = "";
      if( informacion.respuesta == "BIEN" ){
        texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
        color = "#379911";
      }else if( informacion.respuesta == "ERROR"){
        texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecutó la consulta.</div>";
        color = "#C9302C";
      }else if( informacion.respuesta == "EXISTE" ){
        texto = "<strong>Información!</strong> el usuario ya existe.";
        color = "#5b94c5";
      }else if( informacion.respuesta == "VACIO" ){
        texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
        color = "#ddb11d";
      }else if( informacion.respuesta == "OPCION_VACIA"){
        texto = "<strong>Advertencia!</strong> la opción no existe o esta vacía, recargar la página. ";
        color = "#DDB11D";
      }

      // $(".mensaje").alert();
      $(".mensaje").html( texto );
      $(".mensaje").fadeOut(5000, function(){
        $(this).html("");
        $(this).fadeIn(5000);
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
        $("#frmEditarPedimento #fecha").val(data.fecha),
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
