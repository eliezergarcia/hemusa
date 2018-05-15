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
                <div class="name" style="font-size: 23px;">Configuración del sistema</div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header card-header-divider row align-items-end justify-content-between">
                  <p style="font-size: 20px;">Colores del entorno</p>
                  <button type="button" name="button" class="btn btn-secondary btn-space btn-lg">Editar <i class="fas fa-pencil-alt fa-sm"></i></button>
                </div>
                <div class="card-body">
                  <div class="row justify-content-between">
                    <div class="form-group col">
                      <label for="">Color primario </label>
                      <input type="color" class="btn btn-lg btn-space" name="" value="">
                    </div>
                    <div class="form-group col-6">
                      <label for="">Color success </label>
                      <input type="color" class="btn btn-lg btn-space" name="" value="">
                    </div>
                    <div class="form-group col-6">
                      <label for="">Color danger </label>
                      <input type="color" class="btn btn-lg btn-space" name="" value="">
                    </div>
                    <div class="form-group col-6">
                      <label for="">Color warning </label>
                      <input type="color" class="btn btn-lg btn-space" name="" value="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header card-header-divider">Breadcrumbs<span class="card-subtitle">Default bootstrap breadcrumbs component</span></div>
                <div class="card-body">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header card-header-divider">Breadcrumbs<span class="card-subtitle">Default bootstrap breadcrumbs component</span></div>
                <div class="card-body">
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
        App.chat()
        buscarDatosUsuario()
      })

    </script>
    <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
  </body>
</html>
