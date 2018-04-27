<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
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
            <li class="breadcrumb-item active">Ordenes de compras</li>
          </ol>
        </nav>

      <!-- Encabezado -->
        <div>
          <br>
          <center><h1><b>Ordenes de compras</b></h1></center>
        </div>

      <!-- Grupo de botones -->
				<div class="row justify-content-center">
					<div class="row justify-content-center" data-toggle="buttons">
            <button class="btn btn-primary" onclick="listar_ordenesdecompras()">ORDENES DE COMPRAS</button>
						<button class="btn btn-primary" onclick="listar_backorder()">BACKORDER</button>
					  <button class="btn btn-primary" onclick="listar_sinenviar()">SIN ENVIAR</button>
					</div>
				</div>


      <!-- Tabla Ordenes de Compras -->
        <br>
        <div id="ordenesdecompras">
          <table id="dt_orden_compras" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
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
            <tfoot>
              <tr>
                <th>Orden</th>
                <th>Proveedor</th>
                <th>Contacto</th>
                <th>Fecha</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>

       <!-- Tabla Backorder -->
          <br>
          <div id="backorder">
            <table id="dt_backorder" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
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
              <table id="dt_sinenviar" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
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

      <!-- Modal Crear OC -->
        <div class="modal fade" id="modalCrearOC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Orden de Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="frmCrearOC" action="#" method="POST">
                      <input type="hidden" id="opcion" name="opcion" value="crearordencompra">
                      <div class="row justify-content-center">
                        <div class="form-group col-12">
                          <label for="proveedor">Proveedor</label>
                          <input placeholder="Busca un proveedor" class="form-control col-12" data-min-length="1" list="proveedor" id="proveedor" name="proveedor" type="text" required >
                        </div>
                        <div class="form-group col-12">
                          <label for="saludo">Saludo</label>
                          <textarea name="saludo" id="saludo" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-12">
                          <label for="direccionenvio">Envia a</label>
                          <select name="direccionenvio" id="direccionenvio" class="form-control" onchange="agregardireccion()"></select>
                        </div>
                        <div class="form-group col-12">
                          <textarea name="otra" id="otra" cols="30" rows="3" class="form-control" disabled></textarea>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
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

    </main>
  </div>
</body>
</html>
  <script>
    $(document).on("ready", function(){
      buscar_oc_pendientes();
		  setInterval(buscar_oc_pendientes, 3000);
      guardar();
      listar_ordenesdecompras();
    });

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
      $(".mensaje").fadeOut(5000, function(){
      $(this).html("");
      $(this).fadeIn(3000);
      });
    }

    var listar_ordenesdecompras = function(){
      $("#ordenesdecompras").slideDown("slow");
      $("#backorder").slideUp("slow");
      $("#sinenviar").slideUp("slow");
      $('#dt_orden_compras tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control" type="text" placeholder="Buscar '+title+'" />' );
      });

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
          {"defaultContent": "<button class='verOC btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
        ],
        "order":[[3, "desc"]],
        "language": idioma_espanol,
        "dom":
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
          "<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconopdf"
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoexcel"
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconocsv"
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprmir',
            header: 'false',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoimprimir"
          },
          {
            text: '<i class="fa fa-cart-plus" aria-hidden="true"></i>',
            "className": "btn btn-success btnNuevaCotizacion",
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
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
          "<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconopdf"
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoexcel"
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconocsv"
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprmir',
            header: 'false',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoimprimir"
          }
        ]
      });
    }

     var listar_sinenviar = function(){
      $("#ordenesdecompras").slideUp("slow");
      $("#backorder").slideUp("slow");
      $("#sinenviar").slideDown("slow");
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
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
          "<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
          "<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconopdf"
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoexcel"
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconocsv"
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprmir',
            header: 'false',
            exportOptions: {
              columns: [ 0, 1, 2, 3 ]
            },
            "className": "btn iconoimprimir"
          }
        ]
      });
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
<script src="<?php echo $ruta; ?>/php/js/notificaciones.js"></script>
