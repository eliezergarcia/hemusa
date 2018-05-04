<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Clientes</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
          <div class="page-head">
              <h2 class="page-head-title">Clientes</h2>
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                    <li class="breadcrumb-item"><a href="#">Clientes</a></li>
                </ol>
              </nav>
          </div>
          <div class="main-content container-fluid">
              <div class="row full-calendar">
                <div class="col-lg-12">
                    <div class="card card-fullcalendar">
                      <div class="card-body">
                          <!-- <div class="row invoice-footer">
                            <div class="col-lg-12">
                              <button class="btn btn-lg btn-space btn-secondary"><i class="fas fa-file-pdf fa-lg"></i></button>
                              <button class="btn btn-lg btn-space btn-secondary"><i class="fas fa-file-excel fa-lg"></i></button>
                              <button class="btn btn-lg btn-space btn-secondary"><i class="fas fa-file-alt fa-lg"></i></button>
                              <button class="btn btn-lg btn-space btn-secondary"><i class="fas fa-print fa-lg"></i></button>
                              <button class="btn btn-lg btn-space btn-primary">Agregar cliente</button>
                            </div>
                          </div> -->
                          <!-- Tabla de Clientes -->
                            <table id="dt_clientes" class="table table-striped table-hover compact" cellspacing="0" width="100%">
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
                              <tbody>
                              </tbody>
                            </table>

                          <br>
                      </div>
                    </div>
                </div>
            </div>
      </div>
    </div>

      <!-- Modal Agregar Cliente -->
        <form action="#" method="POST">
          <input type="hidden" id="opcion" name="opcion" value="agregarcliente">
          <div class="modal fade colored-header colored-header-success" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b>Registro de cliente</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group col">
                      <label for="nombreEmpresa"><h4>Nombre de empresa <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="limpiar form-control form-control-sm" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="rfc"><h4>RFC <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="rfc" name="rfc" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="moneda"><h4>Moneda <font color="#FF4136">*</h4></font></label>
                      <select name="moneda" id="moneda" class="limpiar form-control form-control-xs select2" required>
                        <option value="mxn">MXN</option>
                        <option value="usd">USD</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="calle"><h4>Calle <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="calle" name="calle" class="limpiar form-control form-control-sm" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="numExterior"><h4>Num. Exterior <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="numExterior" name="numExterior" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="numInterior"><h4>Num. Interior <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="numInterior" name="numInterior" class="limpiar form-control form-control-sm" placeholder="Opcional">
                    </div>
                    <div class="form-group col">
                      <label for="colonia"><h4>Colonia <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="colonia" name="colonia" class="limpiar form-control form-control-sm" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="cp"><h4>C.P. <font color="#FF4136">*</h4></font></font></label>
                      <input type="text" id="cp" name="cp" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="ciudad"><h4>Ciudad <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="ciudad" name="ciudad" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="estado"><h4>Estado <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="estado" name="estado" class="limpiar form-control form-control-sm" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="pais"><h4>País <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="pais" name="pais" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="tlf1"><h4>Teléfono #1 <font color="#FF4136">*</h4></font></label>
                      <input type="text" id="tlf1" name="tlf1" class="limpiar form-control form-control-sm" required>
                    </div>
                    <div class="form-group col">
                      <label for="tlf2"><h4>Teléfono #2</h4></label>
                      <input type="text" id="tlf2" name="tlf2" class="limpiar form-control form-control-sm" placeholder="Opcional">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="paginaWeb"><h4>Página Web </h4></label>
                      <input type="text" id="paginaWeb" name="paginaWeb" class="limpiar form-control form-control-sm" placeholder="Opcional">
                    </div>
                    <div class="form-group col">
                      <label for="correoElectronico"><h4>Correo electrónico <font color="#FF4136">*</h4></font></label>
                      <input type="email" id="correoElectronico" name="correoElectronico" class="limpiar form-control form-control-sm" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer invoice-footer">
                  <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success btn-lg">Guardar</button>
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
          <div class="modal-full-color modal-full-color-danger modal fade" id="modalEliminarCliente" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                  <div class="text-center">
                    <div class="text-center"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                    <h4><b>¿Está seguro de eliminar el cliente?</b></h4>
                    <div class="row justify-content-center"><input type="text" class="disabled form-control col-6 form-control form-control-sm" id="nombreEmpresa" name="nombreEmpresa"></div>
                    <div class="mt-8 invoice-footer">
                      <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-lg btn-danger">Eliminar</button>
                    </div>
                  </div>
                </div>
                <div class="modal-footer"></div>
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

  </header>
  <?php include('../../enlacesjs.php'); ?>
  <script type="text/javascript">
    $.fn.niftyModal('setDefaults',{
        overlaySelector: '.modal-overlay',
        contentSelector: '.modal-content',
        closeSelector: '.modal-close',
        classAddAfterOpen: 'modal-show'
    });

    $(document).ready(function(){
      // buscar_oc_pendientes();
		  // setInterval(buscar_oc_pendientes, 3000);
      App.init();
      App.pageCalendar();       
      App.formElements();
      App.uiNotifications();
      listar_clientes();
      guardar();
    });

    var listar_clientes = function(){
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
          {"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-primary btn-lg'><i class='fas fa-edit fa-sm'></i></button></div>", "sortable": false},
          {"defaultContent": "<div class='invoice-footer'><button class='eliminar btn btn-space btn-danger btn-lg' data-toggle='modal' data-target='#modalEliminarCliente'><i class='fas fa-trash-alt fa-sm'></i></button></div>", "sortable": false}
        ],
        "columnDefs": [
          { "width": "9%", "targets": 6 },
          { "width": "9%", "targets": 5 },
        ],
        "order": [[0, "asc"]],
        "language": idioma_espanol,
        "dom":
          "<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
          "<'row be-datatable-body'<'col-sm-12'tr>>" +
          "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        "buttons":[
          {
            extend: 'collection',
            text: 'Exportar tabla',
            "className": "btn btn-lg btn-space btn-secondary",
            buttons: [
                {
                  extend:    'excelHtml5',
                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
          {
            text: 'Agregar cliente',
            "className": "btn btn-lg btn-space btn-success",
            action: function (e, dt, node, config){
              $("#modalAgregarCliente").modal("show");
            }
          }
        ]
      });

      // $("#dt_clientes tfoot input").on( 'keyup change', function () {
      //   table
      //       .column( $(this).parent().index()+':visible' )
      //       .search( this.value )
      //       .draw();
      // });

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
        $.gritter.add({
          title: 'Correcto!',
          text: 'Se elimino el cliente correctamente.',
          class_name: 'color success'
        });
      }else if( informacion.respuesta == "ERROR"){
        $.gritter.add({
          title: 'Error!',
          text: 'No se ejecuto la consulta.',
          class_name: 'color danger'
        });
      }else if( informacion.respuesta == "EXISTE" ){
        $.gritter.add({
          title: 'Información!',
          text: 'No se pudo registrar el cliente, el RFC ingresado ya existe.',
          class_name: 'color warning'
        });
      }else if( informacion.respuesta == "VACIO" ){
        $.gritter.add({
          title: 'Advertencia!',
          text: 'Debe de llenar todos los campos.',
          class_name: 'color warning'
        });
      }else if( informacion.respuesta == "OPCION_VACIA"){
        $.gritter.add({
          title: 'Advertencia!',
          text: 'La opción no existe o esta vacía.',
          class_name: 'color warning'
        });
      }
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
</body>
</html>
