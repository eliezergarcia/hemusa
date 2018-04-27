<?php 
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);  
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Descripcion de Pedido</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <main class="mdl-layout__content">
      
      <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">             
              <li class="breadcrumb-item">Compras</li>
              <li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="ordenesdecompras.php">Ordenes de compras</a></li>
              <li id="breadcrumb" class="breadcrumb-item" aria-current="page">
                Orden de compra: <a id="toolTipVerCliente" href="<?php echo $ruta; ?>php/compras/ordenesdecompras/verOrdenCompra.php?ordenCompra="><?php echo $_REQUEST['ordenCompra']; ?></a>
              </li>
              <li id="breadcrumb" class="breadcrumb-item active" aria-current="page">Descripción de Pedido</li>
            </ol>
        </nav>

      <!-- Encabezado -->
        <div>
          <br>
          <center><h1><b>Descripcion de Pedido</b></h1></center>
          <br>
        </div>

      <!-- Mensaje actualizaciones-->
          <div>
            <center><h6 class="mensaje"></h6></center>
          </div>

      <!-- Tabla de Partidas -->
        <br>
        <table id="dt_partidas_oc_descripcion" class="table table-bordered table-striped compact" cellspacing="0" width="100%">
          <thead>
            <tr>
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
              <th>Venta MXN</th>
              <th>Venta USD</th>
              <th>Total Venta MXN</th>
              <th>Total Venta USD</th>
              <th>Moneda</th>
              <th>Utilidad</th>
              <th>Folio</th>
              <th>Pedimento</th>
              <th>Editar</th>
            </tr>
          </thead>
        </table>
     
      <!-- Tabla de Total   -->
        <div class="col-12 row justify-content-start">
            <table id="dt_totales_oc" class="table table-bordered" cellspacing="0" width="100%">
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
      
      <!-- Modal Editar Partida -->
        <form action="" method="POST" id="frmEditarPartida">
          <div class="modal fade" id="modalEditarPartida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar partida</h5>
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
                        <input type="text" class="form-control col" name="pedimento" id="pedimento">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="folio" class="col">Folio:</label>
                        <input type="text" class="form-control col" name="folio" id="folio">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="facturaproveedor" class="col">Factura proveedor:</label>
                        <input type="text" class="form-control col" name="facturaproveedor" id="facturaproveedor">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="entrada" class="col">Entrada:</label>
                        <input type="text" class="form-control col" name="entrada" id="entrada">
                      </div>                    
                    </div>
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

      <!-- Modal Actualizar Datos -->
        <form action="" method="POST" id="frmActualizarDatos">
          <div class="modal fade" id="modalActualizarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control col" name="pedimento" id="pedimento">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="folio" class="col">Folio:</label>
                        <input type="text" class="form-control col" name="folio" id="folio">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="facturaproveedor" class="col">Factura proveedor:</label>
                        <input type="text" class="form-control col" name="facturaproveedor" id="facturaproveedor">
                      </div>
                      <div class="col row form-group justify-content-center">
                        <label for="entrada" class="col">Entrada:</label>
                        <input type="text" class="form-control col" name="entrada" id="entrada">
                      </div>                    
                    </div>
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
    
    </main>
  </div>
</body>
</html>
  <script>
    $(document).on("ready", function(){
      var ordencompra = "<?php echo $_REQUEST['ordenCompra']; ?>";
      var opcion = "datosordencompra";
      console.log(ordencompra);
      listar_partidas(ordencompra);
      listar_totales(ordencompra);     
      guardar(ordencompra);     
    });

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
          {"data":'ventamxn'},
          {"data":'ventausd'},
          {"data":'totalventamxn'},
          {"data":'totalventausd'},
          {"data":'moneda'},
          {"data":'utilidad'},
          {"data":'folio'},
          {"data":'pedimento'},
          {"defaultContent":'<button class="editar btn btn-primary" data-toggle="modal" data-target="#modalEditarPartida"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'}
        ],
        "order":[[3, "desc"]],
        "searching": false,
        "info": false,
        "paging": false,
        "ordering": false,
        "language": idioma_espanol,
        "dom":
          "<'col-11 row'<'justify-content-center col-11 buttons'B>>" +  
          "<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>",
        "buttons": [
          {
            text: 'Actualizar Datos',
            "className": "btn btn-success",
            titleAttr: 'Agregar Cliente',
            action: function (e, dt, node, config){
              $("#modalActualizarDatos").modal("show");
            }   
          }
        ]
      });
      obtener_data_partida("#dt_partidas_oc_descripcion tbody", table);
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
        "searching": false,
        "info": false,
        "paging": false,
        "ordering": false
      });      
    }

    var guardar = function(ordencompra){
      $("form").on("submit", function(e){
        e.preventDefault();
        $("#frmActualizarDatos #ordencompra").val(ordencompra);
        var frm = $(this).serialize();
        console.log(frm);
        if ($("#frmActualizarDatos #pedimento").val().length != 0 && $("#frmActualizarDatos #pedimento").val().length != 21 ) {
            alert("El número de pedimento es inválido!\nVerifica que tiene la siguiente estructura\nEjemplo: XX--XX--XXXX--XXXXXXX");
        }else{
          $(".modal").modal("hide");
          $.ajax({
          method: "POST",
          url: "guardar.php",
          data: frm
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje(json_info);
            listar_partidas(ordencompra);
          });
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

      $(".mensaje").html( texto );
      $(".mensaje").fadeOut(5000, function(){
        $(this).html("");
        $(this).fadeIn(5000);
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