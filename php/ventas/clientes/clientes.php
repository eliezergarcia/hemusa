<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Clientes</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <main class="mdl-layout__content">

      <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Ventas</li>
            <li class="breadcrumb-item active">Clientes</li>
          </ol>
        </nav>

      <!-- Encabezado -->
        <div class="row fondo">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center"><b>Clientes</b></h1><br>
          </div>
        </div>

      <!-- Mensaje de actualizaciones -->
        <div>
          <center><h6 class="mensaje"></h6></center>
        </div>

      <!-- Tabla de Clientes -->
        <table id="dt_clientes" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Nombre empresa</th>
              <th>Persona contacto</th>
              <th>Teléfono #1</th>
              <th>Fáx</th>
              <th>Correo electrónico</th>
              <th>Ver Cliente</th>
              <th>Eliminar Cliente</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <th>Nombre empresa</th>
            <th>Persona contacto</th>
            <th>Teléfono #1</th>
            <th>Fáx</th>
            <th>Correo electrónico</th>
            <td></td>
            <td></td>
          </tfoot>
        </table>

      <!-- Modal Agregar Cliente -->
        <form action="#" method="POST">
          <input type="hidden" id="opcion" name="opcion" value="agregarcliente">
          <input type="hidden" id="usuariologin" name="usuariologin">
          <input type="hidden" id="dplogin" name="dplogin">
          <div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
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
                      <input type="text" id="paginaWeb" name="paginaWeb" class="limpiar form-control" placeholder="(Opcional)">
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

      <!-- Modal Eliminar Cliente -->
        <form id="frmEliminarCliente" action="" method="POST">
          <input type="hidden" id="opcion" name="opcion" value="eliminarcliente">
          <input type="hidden" id="idcliente" name="idcliente" value="">
          <input type="hidden" id="usuariologin" name="usuariologin">
          <input type="hidden" id="dplogin" name="dplogin">
          <div class="modal fade" id="modalEliminarCliente" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalEliminarLabel">Eliminar Cliente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nombreEmpresa">¿Está seguro de eliminar el cliente?</label>
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

    </div>
  </main>
</body>
</html>
  <script>

    $(document).on("ready", function(){
      var idusuario = "<?php echo $idusuario; ?>";
      console.log(idusuario);
      buscar_oc_pendientes();
		  setInterval(buscar_oc_pendientes, 3000);
      listar_clientes();
      guardar();
      // var opcion = "datosusuario";
      // $.ajax({ // Se obtienen los datos del usuario en sesion
      //   method: "POST",
      //   url: "buscar.php",
      //   dataType: "json",
      //   data: {"opcion": opcion, "idusuario": idusuario},
      //   success: function ( data ){
      //     console.log(data);
      //     $("form #usuariologin").val(data.datosusuario.nombre + " " + data.datosusuario.apellidos);
      //     $("form #dplogin").val(data.datosusuario.dp);
      //   }
      // });
    });

    var listar_clientes = function(){
      $('#dt_clientes tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control" type="text" placeholder="Buscar '+ title +'" />' );
      });

      var opcion = "clientes";
      var table = $("#dt_clientes").DataTable({
        "destroy":"true",
        "scrollX": true,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion},
        },
        "columns":[
          {"data": "nombreEmpresa"},
          {"data": "personaContacto"},
          {"data": "tlf1"},
          {"data": "fax"},
          {"data": "correoElectronico"},
          {"defaultContent": "<button class='editar btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"},
          {"defaultContent": "<button class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminarCliente'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        ],
        "order": [[0, "asc"]],
        "language": idioma_espanol,
        "dom":
        "<'container row col-10 row align-items-center'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-12 buttons'i><'row justify-content-center col-12 buttons'p>>",
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'Generar PDF',
            "className": "btn iconopdf",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4 ]
            }
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Generar Excel',
            "className": "btn iconoexcel",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4 ]
            }
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'Generar CSV',
            "className": "btn iconocsv",
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
            }
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprimir',
            header: 'false',
            exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
            },
            "className": "btn iconoimprimir",
            orientation: 'landscape',
            pageSize: 'LEGAL'
          },
          {
            text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Cliente',
            "className": "btn btn-success",
            titleAttr: 'Agregar Cliente',
            action: function (e, dt, node, config){
              $("#modalAgregarCliente").modal("show");
            }
          }
        ]
      });

      $("#dt_clientes tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
      });

      obtener_data_ver_cliente("#dt_clientes tbody", table);
      obtener_id_eliminar("#dt_clientes tbody",table);
    }

    var obtener_data_ver_cliente = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var id = data.id;
        window.location="verContacto.php?id="+id;
      });
    }

    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        $("#frmEliminarCliente #idcliente").val(data.id);
        $("#frmEliminarCliente #nombreEmpresa").val(data.nombreEmpresa);
      });
    }

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        $("form .disabled").attr("disabled", false);
        $("#modalAgregarCliente").modal("hide");
        $("#modalEliminarCliente").modal("hide");
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
          listar_clientes();
        });
      });
    }

    function limpiar_datos(){
      $("form .disabled").attr("disabled", true);
      $("form .limpiar").val("");
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
      $(".mensaje").fadeOut(8000, function(){
        $(this).html("");
        $(this).fadeIn(8000);
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
