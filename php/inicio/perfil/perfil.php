<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Perfil de usuario</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="user-profile">
          <div class="row">
            <div class="user-display">
              <div class="user-display-bg"><img src="../../../assets/img/gallery/img-1.png" alt="Profile Background" style="margin-top: -300px;"></div>
              <div class="user-display-bottom">
                <a href="" data-toggle="tooltip" data-placement="left" title="Cambiar foto de perfil"><div class="user-display-avatar"><img src="../../../assets/img/<?php echo $avatar; ?>" alt="Avatar"></div></a>
                <div class="user-display-info">
                  <div class="name" style="font-size: 20px;"><?php echo $usuariologin; ?></div>
                  <div class="nick"><span class="mdi mdi-account"></span> <?php echo $user; ?></div>
                </div>
              </div>
            </div>
            <div class="user-info-list card col-7">
              <br>
              <div class="row align-items-center card-header-divider">
                <div class="col-6"><h4>Información de usuario</h4>
                  <span class="card-subtitle">Modifique la Información y presione el botón de editar para guardar.</span>
                </div>
                <div class="col-6">
                  <button id="editarInfo" class="btn btn-space btn-lg btn-secondary" style="margin-left: 310px; margin-top: 20px">Editar <i class="fas fa-pencil-alt fa-sm"></i></button>
                </div>
              </div>
              <form id="frmInfoUsuario" method="post">
                <input type="hidden" name="opcion" value="editarInfo">
                <div class="card-body" style="padding: 0px 20px;">
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-user col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Usuario</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="usuario" id="usuario" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-id-card col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Nombre completo</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="nombreCompleto" id="nombreCompleto" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-briefcase col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Departamento</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="departamento" id="departamento" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-envelope col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">E-mail de Hemusa</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="emailHemusa" id="emailHemusa" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-envelope col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">E-mail personal</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="emailPersonal" id="emailPersonal" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-mobile-alt col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Celular</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="celular" id="celular" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-globe col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Ubicación</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="ubicacion" id="ubicacion" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-hospital col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">IMSS</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="text" name="imss" id="imss" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-heart col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Tipo de sangre</h4>
                    </div>
                    <div class="col row">
                      <select style="font-size: 16px;" type="text" name="tipoSangre" id="tipoSangre" class="form-control form-control-sm col-12 select2 input2" value="">
                        <option value="O negativo">O negativo</option>
                        <option value="O positivo">O positivo</option>
                        <option value="A negativo">A negativo</option>
                        <option value="A positivo">A positivo</option>
                        <option value="B negativo">B negativo</option>
                        <option value="B positivo">B positivo</option>
                        <option value="AB negativo">AB negativo</option>
                        <option value="AB positivo">AB positivo</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-birthday-cake col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Cumpleaños</h4>
                    </div>
                    <div class="col row">
                      <input style="font-size: 16px;" type="date" name="cumple" id="cumple" class="form-control form-control-sm col-12 input2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-mars-double col-2" style="font-size: 23px;"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Género</h4>
                    </div>
                    <div class="col row">
                      <select style="font-size: 16px;" type="text" name="sexo" id="sexo" class="form-control form-control-sm col-10 select2 input2">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-lg-5">
              <div class="widget widget-fullwidth widget-small">
                <div class="widget-head pb-6">
                  <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                  <div class="title">Actividad del departamento</div>
                </div>
                <div class="widget-chart-container">
                  <div id="bar-chart1" style="height: 180px;"></div>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th style="width:37%;">User</th>
                        <th style="width:36%;">Commit</th>
                        <th>Date</th>
                        <th class="actions"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar6.png" alt="Avatar">Penelope Thornton</td>
                        <td>Initial commit</td>
                        <td>Aug 6, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar4.png" alt="Avatar">Benji Harper</td>
                        <td>Main structure markup</td>
                        <td>Jul 28, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar5.png" alt="Avatar">Justine Myranda</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar3.png" alt="Avatar">Sherwood Clifford</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar.png" alt="Avatar">Kristopher Donny</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar2.png" alt="Avatar">Adeline Shepherd</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar5.png" alt="Avatar">Justine Myranda</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar3.png" alt="Avatar">Sherwood Clifford</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar.png" alt="Avatar">Kristopher Donny</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
    <?php include('../../enlacesjs.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	App.init()
        App.formElements()
      	App.pageProfile()
        buscarDatosUsuario()
        App.chat()
      })

      function buscarDatosUsuario () {
        $.ajax({
          method: "POST",
          url: "buscar.php",
          dataType: "json",
          data: {"opcion": opcion = "buscarDatosUsuario"},
        }).done(function (data) {
          $("#usuario").val(data.data.user)
          $("#nombreCompleto").val(data.data.nombre + " " + data.data.apellidos)
          $("#departamento").val(data.data.dp)
          $("#emailHemusa").val(data.data.correoHemusa)
          $("#emailPersonal").val(data.data.correoPersonal)
          $("#celular").val(data.data.movil)
          $("#ubicacion").val(data.data.direccion)
          $("#imss").val(data.data.imss)
          $("#tipoSangre").val(data.data.tipoSangre).change()
          $("#cumple").val(data.data.fechaNacimiento)
          $("#genero").val(data.data.sexo).change()
        }).fail(function (data) {
          console.log("Error al buscar los datos de usuario!")
        })
      }

      $("#editarInfo").on("click", function() {
        var frm = $("#frmInfoUsuario").serialize()
        $.ajax({
          method: "POST",
          url: "guardar.php",
          dataType: "json",
          data: frm,
        }).done(function ( info ) {
            mostrar_mensaje(info)
          }).fail(function (info) {
            mostrar_mensaje(info)
          })
      })

    </script>
    <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
  </body>
</html>
