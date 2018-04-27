<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Proveedores</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <main class="mdl-layout__content">
      <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Compras</li>
            <li class="breadcrumb-item active">Proveedores</li>
          </ol>
        </nav>

      <!-- Encabezado -->
        <div>
          <br>
          <center><h1><b>Proveedores</b></h1></center>
        </div>

      <!-- Mensaje de actualizaciones -->
        <div>
          <center><h6 class="mensaje"></h6></center>
        </div>

      <!-- Tabla de proveedores -->
        <br>
        <table id="dt_proveedores" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Proveedor</th>
              <th>Persona Contacto</th>
              <th>Teléfono 1</th>
              <th>Fáx</th>
              <th>Correo electrónico</th>
              <th>Página Web</th>
              <th>Ver Proveedor</th>
              <th>Eliminar Proveedor</th>
            </tr>
          </thead>
          <tfoot>
             <tr>
              <th>Proveedor</th>
              <th>Persona Contacto</th>
              <th>Teléfono 1</th>
              <th>Fáx</th>
              <th>Correo electrónico</th>
              <th>Página Web</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>

      <!-- Modal Agregar Proveedor -->
        <form action="#" method="POST">
          <input type="hidden" id="opcion" name="opcion" value="agregarproveedor">
          <div class="modal fade" id="modalAgregarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group col">
                      <label for="nombreEmpresa">Nombre de empresa <font color="#FF4136">*</font></label>
                      <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="limpiar form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="rfc">RFC <font color="#FF4136">*</font></label>
                      <input type="text" id="rfc" name="rfc" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="moneda">Moneda <font color="#FF4136">*</font></label>
                      <select name="moneda" id="moneda" class="limpiar form-control" required>
                        <option value="mxn">MXN</option>
                        <option value="usd">USD</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="calle">Calle <font color="#FF4136">*</font></label>
                      <input type="text" id="calle" name="calle" class="limpiar form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="numExterior">Num. Exterior <font color="#FF4136">*</font></label>
                      <input type="text" id="numExterior" name="numExterior" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="numInterior">Num. Interior</label>
                      <input type="text" id="numInterior" name="numInterior" class="limpiar form-control" placeholder="Opcional">
                    </div>
                    <div class="form-group col">
                      <label for="colonia">Colonia <font color="#FF4136">*</font></label>
                      <input type="text" id="colonia" name="colonia" class="limpiar form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="cp">C.P. <font color="#FF4136">*</font></label>
                      <input type="text" id="cp" name="cp" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="ciudad">Ciudad <font color="#FF4136">*</font></label>
                      <input type="text" id="ciudad" name="ciudad" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="estado">Estado <font color="#FF4136">*</font></label>
                      <input type="text" id="estado" name="estado" class="limpiar form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="pais">Pais <font color="#FF4136">*</font></label>
                      <input type="text" id="pais" name="pais" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="tlf1">Teléfono 1 <font color="#FF4136">*</font></label>
                      <input type="text" id="tlf1" name="tlf1" class="limpiar form-control" required>
                    </div>
                    <div class="form-group col">
                      <label for="tlf2">Teléfono 2</label>
                      <input type="text" id="tlf2" name="tlf2" class="limpiar form-control" placeholder="Opcional">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="paginaWeb">Página Web</label>
                      <input type="text" id="paginaWeb" name="paginaWeb" class="limpiar form-control" placeholder="Opcional">
                    </div>
                    <div class="form-group col">
                      <label for="correoElectronico">Correo electrónico <font color="#FF4136">*</font></label>
                      <input type="email" id="correoElectronico" name="correoElectronico" class="limpiar form-control" required>
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

      <!-- Modal Eliminar Proveedor -->
        <form id="frmEliminarProveedor" action="" method="POST">
          <input type="hidden" id="opcion" name="opcion" value="eliminarproveedor">
          <input type="hidden" id="idproveedor" name="idproveedor" value="">
          <div class="modal fade" id="modalEliminarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalEliminarLabel">Eliminar Proveedor</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nombreEmpresa">¿Está seguro de eliminar el proveedor?</label>
                    <input type="text" class="disabled form-control col-12" id="nombreEmpresa" name="nombreEmpresa" disabled>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
        </form>

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
  </bdiv >
</body>
</html>
  <script>

    $(document).on("ready", function(){
      buscar_oc_pendientes();
		  setInterval(buscar_oc_pendientes, 3000);
      listar_proveedores();
      guardar();
    });

    var  listar_proveedores = function(){
      $('#dt_proveedores tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      });
      var opcion = "proveedores";
      var table = $("#dt_proveedores").DataTable({
        "destroy":true,
        "deferRender": true,
        "scrollX": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion}
        },
        "columns":[
          {"data": "nombreEmpresa"},
          {"data": "personaContacto"},
          {"data": "tlf1"},
          {"data": "fax"},
          {"data": "correoElectronico"},
          {"data": "paginaWeb"},
          {"defaultContent": "<button class='verproveedor btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"},
          {"defaultContent": "<button class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminarProveedor'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        ],
        "order":[[0, "asc"]],
        "language": idioma_espanol,
        "lengthChange": false,
        "dom":
          "<'container row col-12 row align-items-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-12 row'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            "className": "btn iconopdf",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5 ]
            },
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            "className": "btn iconoexcel",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5 ]
            },
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            "className": "btn iconocsv",
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
            },
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprimir',
            header: 'false',
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
            },
            "className": "btn iconoimprimir",
            orientation: 'landscape',
            pageSize: 'LEGAL'
          },
          {
            text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Proveedor',
            "className": "btn btn-success",
            titleAttr: 'Agregar Proveedor',
            action: function (e, dt, node, config){
              $("#modalAgregarProveedor").modal("show");
            }
          }
        ]
      });
      $("#dt_proveedores tfoot input").on( 'keyup change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
      });

      obtener_id_ver("#dt_proveedores tbody",table);
      obtener_id_eliminar("#dt_proveedores tbody",table);
    }

    var obtener_id_ver = function(tbody, table){
      $(tbody).on("click", "button.verproveedor", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var id = data.id;
        window.location.href = "verContacto.php?id="+id;
      });
    }

    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        $("#frmEliminarProveedor #idproveedor").val(data.id);
        $("#frmEliminarProveedor #nombreEmpresa").val(data.nombreEmpresa);
      });
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        $("form .disabled").attr("disabled", false);
        $(".modal").modal("hide");
        var frm = $(this).serialize();
        console.log(frm);
        $.ajax({
          method: "POST",
          url: "guardar.php",
          data: frm
        }).done( function( info ){
          console.log(info);
          var json_info = JSON.parse( info );
          mostrar_mensaje(json_info);
          limpiar_datos();
          listar_proveedores();
        });
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
        texto = "<div class='alert alert-warning'><strong>Información!</strong> el RFC ya existe.</div>";
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

    var limpiar_datos = function(){
      $("form .disabled").attr("disabled", true);
      $("form .limpiar").val("");
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
