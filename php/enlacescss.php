
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo $ruta; ?>media/images/logo.png">

    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/jqvmap/jqvmap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/jquery.fullcalendar/fullcalendar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/select2/css/select2.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/bootstrap-slider/css/bootstrap-slider.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/jquery.gritter/css/jquery.gritter.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>assets/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/semantic.min.css">
    <link rel="stylesheet" href="<?php echo $ruta; ?>assets/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $ruta; ?>php/css/awesomplete.css" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script src="<?php echo $ruta; ?>assets/lib/jquery/jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        $.ajax({
          method: "POST",
          url: "../../../assets/php/buscar.php",
          dataType: "json",
          data: {"opcion": opcion = "buscarConfiguracion"},
        }).done( function ( data ) {
          document.documentElement.style.setProperty('--color-primario-entorno', data.data.headerPrincipal)
          document.documentElement.style.setProperty('--color-menu-lateral', data.data.menuLateral)
          document.documentElement.style.setProperty('--color-texto-menu-lateral', data.data.textoMenuLateral)
          document.documentElement.style.setProperty('--color-hover-menu-lateral', data.data.htextoMenuLateral)
          document.documentElement.style.setProperty('--color-encabezado-menu', data.data.encabezadoMenu)
          document.documentElement.style.setProperty('--color-submenu-lateral', data.data.submenuLateral)
          document.documentElement.style.setProperty('--color-hover-submenu', data.data.hSubmenuLateral)
          document.documentElement.style.setProperty('--color-bordes-menu', data.data.bordesMenu)
          document.documentElement.style.setProperty('--color-primario', data.data.primario)
          document.documentElement.style.setProperty('--color-hover-primario', data.data.hoverPrimario)
          document.documentElement.style.setProperty('--color-borde-primario', data.data.bordePrimario)
          document.documentElement.style.setProperty('--color-success', data.data.success)
          document.documentElement.style.setProperty('--color-hover-success', data.data.hoverSuccess)
          document.documentElement.style.setProperty('--color-borde-success', data.data.bordeSuccess)
          document.documentElement.style.setProperty('--color-warning', data.data.warning)
          document.documentElement.style.setProperty('--color-hover-warning', data.data.hoverWarning)
          document.documentElement.style.setProperty('--color-borde-warning', data.data.bordeWarning)
          document.documentElement.style.setProperty('--color-danger', data.data.danger)
          document.documentElement.style.setProperty('--color-hover-danger', data.data.hoverDanger)
          document.documentElement.style.setProperty('--color-borde-danger', data.data.bordeDanger)
        }).fail( function ( data ) {
          console.log("Ocurrió un error al buscar la configuracion del usuario")
          document.documentElement.style.setProperty('--color-primario-entorno', '#3F51B5')
          document.documentElement.style.setProperty('--color-menu-lateral', '#f5f5f5')
          document.documentElement.style.setProperty('--color-texto-menu-lateral', '#646464')
          document.documentElement.style.setProperty('--color-submenu-lateral', '#eeeeee')
          document.documentElement.style.setProperty('--color-hover-menu-lateral', '#3d3d3d')
          document.documentElement.style.setProperty('--color-hover-submenu', '#e7e7e7')
          document.documentElement.style.setProperty('--color-encabezado-menu', '#b0b0b0')
          document.documentElement.style.setProperty('--color-bordes-menu', '#e6e6e6')
          document.documentElement.style.setProperty('--color-primario', '#4285f4')
          document.documentElement.style.setProperty('--color-hover-primario', '#4c8bf5')
          document.documentElement.style.setProperty('--color-borde-primario', '#1266f1')
          document.documentElement.style.setProperty('--color-success', '#34a853')
          document.documentElement.style.setProperty('--color-hover-success', '#36b057')
          document.documentElement.style.setProperty('--color-borde-success', '#288140')
          document.documentElement.style.setProperty('--color-warning', '#fbbc05')
          document.documentElement.style.setProperty('--color-hover-warning', '#fbbf0f')
          document.documentElement.style.setProperty('--color-borde-warning', '#ca9703')
          document.documentElement.style.setProperty('--color-danger', '#ea4335')
          document.documentElement.style.setProperty('--color-hover-danger', '#e72919')
          document.documentElement.style.setProperty('--color-borde-danger', '#d62516')
        })
     </script>
