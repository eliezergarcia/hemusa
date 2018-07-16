<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Proveedores</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
          <div class="page-head">
              <h2 class="page-head-title" style="font-size: 30px;"><b>Proveedores</b></h2>
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="#">Compras</a></li>
                    <li class="breadcrumb-item"><a href="#">Proveedores</a></li>
                </ol>
              </nav>
          </div>
          <div class="main-content container-fluid">
              <div class="row full-calendar">
                <div class="col-lg-12">
                    <div class="card card-fullcalendar">
                        <div class="card-body">
                           <!-- Tabla de proveedores -->
                            <br>
                            <table id="dt_proveedores" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Nombre empresa</th>
                                  <th>Persona Contacto</th>
                                  <th>Teléfono #1</th>
                                  <th>Correo electrónico</th>
                                  <th>Página Web</th>
                                  <th>Ver</th>
                                  <th>Eliminar</th>
                                </tr>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Proveedor -->
      <form action="#" method="POST">
        <input type="hidden" id="opcion" name="opcion" value="agregarproveedor">
        <div class="modal fade colored-header colored-header-success" id="modalAgregarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col">
                    <label for="nombreEmpresa">Nombre de empresa <font color="#FF4136">*</font></label>
                    <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col-4">
                    <label for="alias">Alias</label>
                    <input type="text" id="alias" name="alias" class="limpiar form-control form-control-sm" placeholder="Opcional">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col">
                    <label for="rfc">RFC <font color="#FF4136">*</font></label>
                    <input type="text" id="rfc" name="rfc" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="moneda">Moneda <font color="#FF4136">*</font></label>
                    <select name="moneda" id="moneda" class="limpiar form-control form-control-sm select2" required>
                      <option value="mxn">MXN</option>
                      <option value="usd">USD</option>
                    </select>
                  </div>
                  <div class="form-group col">
                    <label for="calle">Calle <font color="#FF4136">*</font></label>
                    <input type="text" id="calle" name="calle" class="limpiar form-control form-control-sm" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col">
                    <label for="numExterior">Num. Exterior <font color="#FF4136">*</font></label>
                    <input type="text" id="numExterior" name="numExterior" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="numInterior">Num. Interior</label>
                    <input type="text" id="numInterior" name="numInterior" class="limpiar form-control form-control-sm" placeholder="Opcional">
                  </div>
                  <div class="form-group col">
                    <label for="colonia">Colonia <font color="#FF4136">*</font></label>
                    <input type="text" id="colonia" name="colonia" class="limpiar form-control form-control-sm" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col">
                    <label for="cp">C.P. <font color="#FF4136">*</font></label>
                    <input type="text" id="cp" name="cp" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="ciudad">Ciudad <font color="#FF4136">*</font></label>
                    <input type="text" id="ciudad" name="ciudad" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="estado">Estado <font color="#FF4136">*</font></label>
                    <input type="text" id="estado" name="estado" class="limpiar form-control form-control-sm" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col">
                    <label for="pais">Pais <font color="#FF4136">*</font></label>
                    <input type="text" id="pais" name="pais" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="tlf1">Teléfono 1 <font color="#FF4136">*</font></label>
                    <input type="text" id="tlf1" name="tlf1" class="limpiar form-control form-control-sm" required>
                  </div>
                  <div class="form-group col">
                    <label for="tlf2">Teléfono 2</label>
                    <input type="text" id="tlf2" name="tlf2" class="limpiar form-control form-control-sm" placeholder="Opcional">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col">
                    <label for="paginaWeb">Página Web</label>
                    <input type="text" id="paginaWeb" name="paginaWeb" class="limpiar form-control form-control-sm" placeholder="Opcional">
                  </div>
                  <div class="form-group col">
                    <label for="correoElectronico">Correo electrónico <font color="#FF4136">*</font></label>
                    <input type="email" id="correoElectronico" name="correoElectronico" class="limpiar form-control form-control-sm" required>
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

    <!-- Modal Eliminar Proveedor -->
      <form id="frmEliminarProveedor" action="" method="POST">
        <input type="hidden" id="opcion" name="opcion" value="eliminarproveedor">
        <input type="hidden" id="idproveedor" name="idproveedor" value="">
        <div class="modal fade" id="modalEliminarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
              </div>
              <div class="modal-body">
                <div class="text-center">
                    <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                    <h4>¿Está seguro de eliminar el proveedor?</h4>
                    <div class="row justify-content-center">
                      <input type="text" class="disabled form-control form-control-sm col-6" id="nombreEmpresa" name="nombreEmpresa" disabled>
                    </div>
                    <div class="mt-8 invoice-footer">
                      <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-lg btn-danger">Eliminar</button>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
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
      listar_proveedores();
      guardar();
    });

    function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#compras-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#proveedores-menu").addClass("active");
    }

    var  listar_proveedores = function(){
      var opcion = "proveedores";
      var table = $("#dt_proveedores").DataTable({
        "destroy":true,
        "deferRender": true,
        "scrollX": true,
        "autoWidth": false,
        "ajax":{
          "method":"POST",
          "url":"listar.php",
          "data": {"opcion": opcion}
        },
        "columns":[
          {"data": "nombreEmpresa"},
          {"data": "personaContacto"},
          {"data": "tlf1"},
          {"data": "correoElectronico"},
          {"data": "paginaWeb"},
          {"defaultContent": "<div class='invoice-footer'><button class='verproveedor btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"},
          {"defaultContent": "<div class='invoice-footer'><button class='eliminar btn btn-lg btn-danger' data-toggle='modal' data-target='#modalEliminarProveedor'><i class='fas fa-trash fa-sm' aria-hidden='true'></i></button></div>"}
        ],
        "columnDefs": [
          { "width": "30%", "targets": 0 },
          { "width": "15%", "targets": 1 },
          { "width": "15%", "targets": 2 },
          { "width": "15%", "targets": 3 },
          { "width": "15%", "targets": 4 },
          { "width": "5%", "targets": 5 },
          { "width": "5%", "targets": 6 },
        ],
        "language": idioma_espanol,
        "lengthChange": false,
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
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
          {
            text: '<i class="fas fa-address-card fa-sm" aria-hidden="true"></i> Agregar proveedor',
            "className": "btn btn-lg btn-space btn-secondary",
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
          var json_info = JSON.parse( info );
          mostrar_mensaje(json_info);
          $('#dt_proveedores').DataTable().ajax.reload();
        });
      });
    }

    var limpiar_datos = function(){
      $("form .disabled").attr("disabled", true);
      $("form .limpiar").val("");
    }

  </script>
  <script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
  <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
