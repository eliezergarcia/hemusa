<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Perfil de usuario</title>
  <script type="text/javascript">

  </script>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="user-profile">
          <div class="row">
            <div class="col-sm-12">
              <div class="user-display">
                <div class="user-display-bg"><img src="../../../assets/img/gallery/img-1.png" alt="Profile Background" style="margin-top: -300px;"></div>
                <div class="user-display-bottom">
                  <div class="name" style="font-size: 23px;">Configuración del sistema</div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12">
              <div class="card">
                <div class="card-header card-header-divider row align-items-end justify-content-between">
                  <p style="font-size: 20px;">Colores del entorno</p>
                  <form id="frmColoresEntorno">
                    <button id="btnDefaultColoresEntorno" type="button" name="button" class="btn btn-secondary btn-space btn-lg">Colores default</button>
                    <button id="btnColoresEntorno" type="button" name="button" class="btn btn-secondary btn-space btn-lg">Editar <i class="fas fa-pencil-alt fa-sm"></i></button>
                </div>
                <div class="card-body colores">
                  <div class="row justify-content-between align-items-center">
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Header principal </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-primario-entorno" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Menú lateral</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-menu-lateral" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Texto menú lateral</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-texto-menu-lateral" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Hover texto menú </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-menu-lateral" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Encabezados menú </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-encabezado-menu" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Submenú lateral </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-submenu-lateral" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Hover submenú </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-submenu" name="" value="">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                      <label class="col-8">Bordes menú </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-bordes-menu" name="" value="">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-sm-12">
              <div class="card">
                <div class="card-header card-header-divider row align-items-end justify-content-between">
                  <p style="font-size: 20px;">Colores principales</p>
                  <form id="frmColoresEntorno">
                    <button id="btnDefaultColoresEntorno" type="button" name="button" class="btn btn-secondary btn-space btn-lg">Colores default</button>
                    <button type="button" name="button" class="btn btn-secondary btn-space btn-lg">Editar <i class="fas fa-pencil-alt fa-sm"></i></button>
                </div>
                <div class="card-body colores">
                  <div class="row justify-content-between align-items-center">
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Primario </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-primario">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Hover primario</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-primario">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Borde primario</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-borde-primario">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Success </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-success">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Hover success</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-success">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Borde success</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-borde-success">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Warning </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-warning">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Hover warning</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-warning">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Borde warning</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-borde-warning">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Danger </label>
                      <input type="color" class="btn btn-lg btn-space" id="color-danger">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Hover danger</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-hover-danger">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                      <label class="col-8">Borde danger</label>
                      <input type="color" class="btn btn-lg btn-space" id="color-borde-danger">
                    </div>
                  </div>
                  </form>
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
        App.chat()
        buscarConfiguracion()
      })

      const inputs = [].slice.call(document.querySelectorAll('.colores input'));

      // listen for changes
      inputs.forEach(input => input.addEventListener('change', handleUpdate));
      inputs.forEach(input => input.addEventListener('mousemove', handleUpdate));

      function handleUpdate(e) {
        // append 'px' to the end of spacing and blur variables
        const suffix = (this.id != 'null' ? '' : 'px');
        document.documentElement.style.setProperty(`--${this.id}`, this.value + suffix);
      }

      function buscarConfiguracion () {
        $.ajax({
          method: "POST",
          url: "buscar.php",
          dataType: "json",
          data: {"opcion": opcion = "buscarConfiguracion"},
        }).done( function ( data ) {
          $("#color-primario-entorno").val(data.data.headerPrincipal)
          $("#color-menu-lateral").val(data.data.menuLateral)
          $("#color-texto-menu-lateral").val(data.data.textoMenuLateral)
          $("#color-hover-menu-lateral").val(data.data.htextoMenuLateral)
          $("#color-encabezado-menu").val(data.data.encabezadoMenu)
          $("#color-submenu-lateral").val(data.data.submenuLateral)
          $("#color-hover-submenu").val(data.data.hSubmenuLateral)
          $("#color-bordes-menu").val(data.data.bordesMenu)
          $("#color-primario").val(data.data.primario)
          $("#color-hover-primario").val(data.data.hoverPrimario)
          $("#color-borde-primario").val(data.data.bordePrimario)
          $("#color-success").val(data.data.success)
          $("#color-hover-success").val(data.data.hoverSuccess)
          $("#color-borde-success").val(data.data.bordeSuccess)
          $("#color-warning").val(data.data.warning)
          $("#color-hover-warning").val(data.data.hoverWarning)
          $("#color-borde-warning").val(data.data.bordeWarning)
          $("#color-danger").val(data.data.danger)
          $("#color-hover-danger").val(data.data.hoverDanger)
          $("#color-borde-danger").val(data.data.bordeDanger)
        }).fail( function ( info ) {
          $.gritter.add({
	        	title: 'Error!',
	        	text: 'Ocurrió un error al cargar la configuración de usuario.',
	        	class_name: 'color danger'
	      	});
        })
      }

      $("#btnDefaultColoresEntorno").on("click", function () {
        $.ajax({
          method: "POST",
          url: "buscar.php",
          dataType: "json",
          data: {"opcion": opcion = "defaultColoresEntorno"},
        }).done( function ( data ) {
          $("#color-primario-entorno").val(data.data.headerPrincipal)
          $("#color-menu-lateral").val(data.data.menuLateral)
          $("#color-texto-menu-lateral").val(data.data.textoMenuLateral)
          $("#color-hover-menu-lateral").val(data.data.htextoMenuLateral)
          $("#color-encabezado-menu").val(data.data.encabezadoMenu)
          $("#color-submenu-lateral").val(data.data.submenuLateral)
          $("#color-hover-submenu").val(data.data.hSubmenuLateral)
          $("#color-bordes-menu").val(data.data.bordesMenu)
          $("#color-primario").val(data.data.primario)
          $("#color-hover-primario").val(data.data.hoverPrimario)
          $("#color-borde-primario").val(data.data.bordePrimario)
          $("#color-success").val(data.data.success)
          $("#color-hover-success").val(data.data.hoverSuccess)
          $("#color-borde-success").val(data.data.bordeSuccess)
          $("#color-warning").val(data.data.warning)
          $("#color-hover-warning").val(data.data.hoverWarning)
          $("#color-borde-warning").val(data.data.bordeWarning)
          $("#color-danger").val(data.data.danger)
          $("#color-hover-danger").val(data.data.hoverDanger)
          $("#color-borde-danger").val(data.data.bordeDanger)
        }).fail( function ( info ) {
          $.gritter.add({
	        	title: 'Error!',
	        	text: 'Ocurrió un error al cargar los colores de entorno default.',
	        	class_name: 'color danger'
	      	});
        })
      })

      $("#btnColoresEntorno").on("click", function () {
        var headerPrincipal = $("#color-primario-entorno").val()
        var menuLateral = $("#color-menu-lateral").val()
        var textoMenuLateral = $("#color-texto-menu-lateral").val()
        var htextoMenuLateral = $("#color-hover-menu-lateral").val()
        var encabezadoMenu = $("#color-encabezado-menu").val()
        var submenuLateral = $("#color-submenu-lateral").val()
        var hSubmenuLateral = $("#color-hover-submenu").val()
        var bordesMenu = $("#color-bordes-menu").val()
        var opcion = "editarColoresEntorno"
        $.ajax({
          method: "POST",
          url: "guardar.php",
          dataType: "json",
          data: {"opcion": opcion, "headerPrincipal": headerPrincipal, "menuLateral": menuLateral, "textoMenuLateral": textoMenuLateral, "htextoMenuLateral": htextoMenuLateral, "encabezadoMenu": encabezadoMenu, "submenuLateral": submenuLateral, "hSubmenuLateral": hSubmenuLateral, "bordesMenu": bordesMenu},
        }).done( function ( info ) {
          mostrar_mensaje(info)
        }).fail( function ( info ) {
          mostrar_mensaje(info)
        })
      })

    </script>
    <script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
  </body>
</html>
