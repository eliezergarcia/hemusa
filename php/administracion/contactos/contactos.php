<?php 
  include("../../header.php");
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
  
  <!-- Buttons DataTables -->
  <link rel="stylesheet" href="css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
    <div class="row fondo">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <h1 class="text-center">Administración de contactos</h1>
    </div>
  </div>
  
  <div class="container-fluid row center-xs">
    <div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12">
      <form class="form-horizontal" action="" method="POST">
        <div class="form-group">
          <h3 class="col-sm-offset-2 col-sm-8 text-center">         
          Información de contacto</h3>
        </div>
        <!-- <div class="menu-info row center-xs">
          <ul class="nav start-xs">
            <li><a href="">Información</a>
              <ul>
                <li><a href="">Agregar Persona</a>
                <li><a href="">Portal</a>
                <li><a href="">Información Bancaria</a>
                <li><a href="">Garantías</a>
                <li><a href="">Devoluciones</a>
                <li><a href="">Reparaciones</a>
              </ul>
            </li>
          </ul>
        </div> -->
        <input type="hidden" id="idcontacto" name="idcontacto" value="0">
        <input type="hidden" id="opcion" name="opcion" value="registrar">
        <div class="form-group row col-lg-6">
          <label for="nombreEmpresa" class="col-sm-4 control-label">Nombre empresa</label>
          <div class="col-sm-8"><input id="nombreEmpresa" name="nombreEmpresa" type="text" class="form-control"  autofocus></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="rfc" class="col-sm-4 control-label">R.F.C</label>
          <div class="col-sm-8"><input id="rfc" name="rfc" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="personaContacto" class="col-sm-4 control-label">Contacto</label>
          <div class="col-sm-8"><input id="personaContacto" name="personaContacto" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="calle" class="col-sm-4 control-label">Calle</label>
          <div class="col-sm-8"><input id="calle" name="calle" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="ciudad" class="col-sm-4 control-label">Ciudad</label>
          <div class="col-sm-8"><input id="ciudad" name="ciudad" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="codigoPostal" class="col-sm-4 control-label">Código Postal</label>
          <div class="col-sm-8"><input id="codigoPostal" name="codigoPostal" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="pais" class="col-sm-4 control-label">País</label>
          <div class="col-sm-8"><input id="pais" name="pais" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="direccionEnvio" class="col-sm-4 control-label">Dirección Envío</label>
          <div class="col-sm-8"><input id="direccionEnvio" name="direccionEnvio" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="tlf1" class="col-sm-4 control-label">Teléfono #1</label>
          <div class="col-sm-8"><input id="tlf1" name="tlf1" type="text" class="form-control"  autofocus></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="fax" class="col-sm-4 control-label">Fáx</label>
          <div class="col-sm-8"><input id="fax" name="fax" type="text" class="form-control" ></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="correoElectronico" class="col-sm-4 control-label">Correo electrónico</label>
          <div class="col-sm-8"><input id="correoElectronico" name="correoElectronico" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="paginaWeb" class="col-sm-4 control-label">Página Web</label>
          <div class="col-sm-8"><input id="paginaWeb" name="paginaWeb" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="codigo" class="col-sm-4 control-label">Código</label>
          <div class="col-sm-8"><input id="codigo" name="codigo" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="moneda" class="col-sm-4 control-label">Moneda</label>
          <div class="col-sm-8"><input id="moneda" name="moneda" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="formaPago" class="col-sm-4 control-label">Forma de Pago</label>
          <div class="col-sm-8"><input id="formaPago" name="formaPago" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="metodoPago" class="col-sm-4 control-label">Método de Pago</label>
          <div class="col-sm-8"><input id="metodoPago" name="metodoPago" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="cfdi" class="col-sm-4 control-label">Uso CFDI</label>
          <div class="col-sm-8"><input id="cfdi" name="cfdi" type="text" class="form-control"></div>
        </div>
        <div class="form-group row col-lg-6">
          <label for="responsable" class="col-sm-4 control-label">Responsable</label>
          <div class="col-sm-8"><input id="responsable" name="responsable" type="text" class="form-control"></div>
        </div>
        <div class="row col-lg-12">
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="" type="submit" class="btn btn-primary" value="Guardar">
          </div>
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="btn_listar" type="button" class="btn btn-primary" value="Listar Contactos">
          </div>
        </div>
      </form>  
    </div>
  </div>
  <div class="container-fluid row center-xs">
    <div id="cuadroBotones" class="col-sm-12 col-md-12 col-lg-12">
        <div class="row col-lg-12">
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="btn_agregar_persona" type="submit" class="btn btn-primary" value="Agregar Persona">
            <input id="" type="submit" class="btn btn-primary" value="Portal">
            <!-- <input id="" type="submit" class="btn btn-primary" value="Tiempos de Entregas"> Dashboard -->
            <input id="btn_infoBanco" type="button" class="btn btn-primary" value="Informacion Bancaria">
            <input id="" type="submit" class="btn btn-primary" value="Garantias">
            <input id="" type="submit" class="btn btn-primary" value="Devoluciones">
            <input id="" type="submit" class="btn btn-primary" value="Reparaciones">
          </div>
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="" type="submit" class="btn btn-primary" value="Nueva Orden de Compra">
            <input id="" type="submit" class="btn btn-primary" value="Ver Orden de Compra">
          </div>
        </div>
    </div>
  </div>
  
  <div class="row center-xs">
    <div id="cuadro3" class="col-sm-12 col-md-12 col-lg-4">
      <form class="form-horizontal" action="" method="POST">
        <div class="form-group">
          <h3 class="col-sm-offset-2 col-sm-8 text-center">         
          Agregar Persona</h3>
        </div>
        <input type="hidden" id="idcontacto" name="idcontacto" value="0">
        <input type="hidden" id="opcion" name="opcion" value="registrar">
        <div class="form-group">
          <label for="nombreEmpresa" class="col-sm-2 control-label">Contacto</label>
          <div class="col-sm-8"><input id="nombreEmpresa" name="nombreEmpresa" type="text" class="form-control"  autofocus></div>
        </div>
        <div class="form-group">
          <label for="rfc" class="col-sm-2 control-label">Puesto</label>
          <div class="col-sm-8"><input id="rfc" name="rfc" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="personaContacto" class="col-sm-2 control-label">Calle</label>
          <div class="col-sm-8"><input id="personaContacto" name="personaContacto" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="calle" class="col-sm-2 control-label">Colonia</label>
          <div class="col-sm-8"><input id="calle" name="calle" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
          <div class="col-sm-8"><input id="ciudad" name="ciudad" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="codigoPostal" class="col-sm-2 control-label">Estado</label>
          <div class="col-sm-8"><input id="codigoPostal" name="codigoPostal" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="pais" class="col-sm-2 control-label">CP</label>
          <div class="col-sm-8"><input id="pais" name="pais" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="direccionEnvio" class="col-sm-2 control-label">Pais</label>
          <div class="col-sm-8"><input id="direccionEnvio" name="direccionEnvio" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="tlf1" class="col-sm-2 control-label">Teléfono #1</label>
          <div class="col-sm-8"><input id="tlf1" name="tlf1" type="text" class="form-control"  autofocus></div>
        </div>
        <div class="form-group">
          <label for="fax" class="col-sm-2 control-label">Fáx</label>
          <div class="col-sm-8"><input id="fax" name="fax" type="text" class="form-control" ></div>
        </div>
        <div class="form-group">
          <label for="correoElectronico" class="col-sm-2 control-label">Móvil</label>
          <div class="col-sm-8"><input id="correoElectronico" name="correoElectronico" type="text" class="form-control"></div>
        </div>
        <div class="form-group">
          <label for="paginaWeb" class="col-sm-2 control-label">E-mail</label>
          <div class="col-sm-8"><input id="paginaWeb" name="paginaWeb" type="text" class="form-control"></div>
        </div>
        <div class="row col-lg-12">
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="" type="submit" class="btn btn-primary" value="Guardar">
          </div>
          <div class="col-sm-offset-0 col-sm-12 buttons">
            <input id="btn_listar_contactos" type="button" class="btn btn-primary" value="Listar Contactos">
          </div>
        </div>
      </form>
      
    </div>
  </div>
  
  <div class="container row">
    <div id="cuadroBanco" class="infoBanco col-sm-10 col-md-10 col-lg-12">
      <div class="row center-xs">
        <img src='img/HEMUSA.bmp'  width='658pt' height='60pt' /><br><br>
      </div>
      <br>
      <input id="empresa"></input><br>
      Atte: <input id="persona"></input><br>
      Calle: <input id="cal"></input><br>
      Ciudad: <input id="ciu"></input><br>
      Estado: Nuevo León<br>
      Fáx: <input id="fa"></input><br>
      E-mail: <input id="correo"></input><br><br>
      Estimados Señores:<br><br>
      Para cumplir las disposiciones relativas sobre Transferencias Electrónicas de Fondos Interbancarias derivadas de nuestras relaciones comerciales, favor de anotar los datos de la nuestras:<br><br>
      <div class="row between-xs">
        <div>
          BANCO NACIONAL DE MEXICO, S.A.<br>
          CUENTA 0621 0014371<br>
          SUCURSAL 0186 PINO SUAREZ<br>
          CLABE 002580062100143718<br>
        </div>
        <div>
          BANAMEX Dlls<br>
          CUENTA 06219000578<br>
          SUCURSAL 0186 PINO SUAREZ <br>
          CLABE 002580062100143718<br>
          SWIFT CODE BNMXMXMM"<br>
        </div>
        <div>
          BANCO MERCANTIL DEL NORTE, S.A.<br>
          CUENTA 13671593 3<br>
          SUCURSAL 0158 CUAUHTEMOC<br>
          CLABE 072580001367159332<br>
        </div>
      </div>
      <br><br>
      En cualesquiera de estas Instituciones bancarias podrá realizar sus transferencias, solo les agradeceremos se sirvan comunicarnos el deposito, con el fin de contabilizarlo y mantener sus saldos al día.<br><br>
      Aprovechamos la oportunidad para reiterarles nuestro agradecimiento por su preferencia, y como siempre estamos a sus amables órdenes.<br><br>
    
      <div class="row center-xs">
        Atentamente<br><br><br><br>
        _______________________________<br>
        CUENTAS POR COBRAR<br><br><br>
        Herramientas Mecánicas Universales, S.A. de C.V.
      </div>
    </div>
  <div>

  <div class="container-fluid row center-xs">
    <div id="cuadro1" class="col-sm-10 col-md-10 col-lg-12">
      <div class="col-sm-offset-2 col-sm-8">
        <h3 class="text-center"> <small class="mensaje"></small></h3>
      </div>
      <form>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8 buttons">
            <input id="btn_agregar_contacto" type="button" class="btn btn-primary" value="Agregar contacto">
          </div>
        </div>
      </form>
      <div class="table-responsive col-sm-12">    
        <table id="dt_contacto" class="table table-bordered table-hover start-xs" cellspacing="0" width="100%">
          <thead>
            <tr>                
              <th>Nombre empresa</th>
              <th>Persona contacto</th>
              <th>Teléfono #1</th>
              <th>Fáx</th>
              <th>Correo electrónico</th>
              <th>Mostrar Información</th>
              <th>Eliminar Contacto</th>
            </tr>
          </thead>          
        </table>
      </div>      
    </div>    
  </div>
  </div>
    <form id="frmEliminarUsuario" action="" method="POST">
      <input type="hidden" id="idcontacto" name="idcontacto" value="">
      <input type="hidden" id="opcion" name="opcion" value="eliminar">
      <!-- Modal -->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Contacto</h4>
            </div>
            <div class="modal-body">              
              ¿Está seguro de eliminar el contacto?<strong data-name=""></strong>
            </div>
            <div class="modal-footer">
              <button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
  </div>
  <script src="js/jquery-1.12.3.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.js"></script>
  <!--botones DataTables--> 
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.bootstrap.min.js"></script>
  <!--Libreria para exportar Excel-->
  <script src="js/jszip.min.js"></script>
  <!--Librerias para exportar PDF-->
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <!--Librerias para botones de exportación-->
  <script src="js/buttons.html5.min.js"></script>

  <script>
  
    $(document).on("ready", function(){
      listar();
      guardar();
      eliminar();
    });

    $("#btn_listar").on("click", function(){
      listar();
    });

    $("#btn_listar_contactos").on("click", function(){
      listar();
    });

    $("#btn_agregar_contacto").on("click", function(){
      agregar_nuevo_contacto();
    });

    $("#btn_agregar_persona").on("click", function(){
      agregar_nueva_persona();
    });

    $("#btn_infoBanco").on("click", function(){
      $("#cuadroBanco").slideDown("slow");
      $("#cuadro1").slideUp("slow");
      $("#cuadro3").slideUp("slow");
      $("#cuadro2").slideUp("slow");
    });

    var guardar = function(){
      $("form").on("submit", function(e){
        e.preventDefault();
        var frm = $(this).serialize();
        $.ajax({
          method: "POST",
          url: "guardar.php",
          data: frm
        }).done( function( info ){
          console.log(info);
          var json_info = JSON.parse( info );
          console.log(json_info);
          mostrar_mensaje(json_info);
          limpiar_datos();
          listar();
        });
      });
    }

    var eliminar = function(){
      $("#eliminar-usuario").on("click", function(){
        var idcontacto = $("#frmEliminarUsuario #idcontacto").val(),
          opcion = $("#frmEliminarUsuario #opcion").val();
        $.ajax({
          method:"POST",
          url: "guardar.php",
          data: {"idcontacto": idcontacto, "opcion": opcion}
        }).done( function( info ){
          // var json_info = JSON.parse( info );
          // mostrar_mensaje( json_info );
          texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
          color = "#379911";
          $(".mensaje").html( texto ).css({"color": color });
          $(".mensaje").fadeOut(3000, function(){
          $(this).html("");
          $(this).fadeIn(3000);
          }); 

          limpiar_datos();
          listar();
        });
      });
    }

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

    var limpiar_datos = function(){
      $("#opcion").val("registrar");
      $("#nombreEmpresa").val("");
      $("#personaContacto").val("");
      $("#tlf1").val("").focus();
      $("#fax").val("");
      $("#correoElectronico").val("");
    }

    var  listar = function(){
      $("#cuadro2").slideUp("slow");
      $("#cuadro3").slideUp("slow");
      $("#cuadroBotones").slideUp("slow");
      $("#cuadroBanco").slideUp("slow");
      $("#cuadro1").slideDown("slow");
      var table = $("#dt_contacto").DataTable({
        "destroy":"true",
        "ajax":{
          "method":"POST",
          "url":"listar.php" 
        },
        "columns":[
          {"data":"nombreEmpresa", "sortable": false},
          {"data":"personaContacto"},
          {"data":"tlf1", "sortable": false},
          {"data":"fax", "sortable": false},
          {"data":"correoElectronico", "sortable": false},
          {"defaultContent":"<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>", "sortable": false},
          {"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>", "sortable": false}
        ],
        "language": idioma_espanol,
        "dom": 'Bfrtip',
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            "className": "btn iconopdf"
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            "className": "btn iconoexcel"
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            "className": "btn iconocsv"
          }
        ]
      });
      obtener_data_editar("#dt_contacto tbody",table);
      obtener_id_eliminar("#dt_contacto tbody",table);
      obtener_data_banco("#dt_contacto tbody",table);
    }

    var agregar_nuevo_contacto = function(){
      limpiar_datos();
      $("#cuadro2").slideDown("slow");
      $("#cuadro1").slideUp("slow");
    }

     var agregar_nueva_persona = function(){
      limpiar_datos();
      $("#cuadro3").slideDown("slow");
      $("#cuadroBanco").slideUp("slow");
      $("#cuadro2").slideUp("slow");
    }

    var obtener_data_editar = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        var idcontacto = $("#idcontacto").val(data.id), 
          nombreEmpresa = $("#nombreEmpresa").val(data.nombreEmpresa),
          rfc = $("#rfc").val(data.RFC),
          personaContacto = $("#Con").val(data.personaContacto),
          calle = $("#calle").val(data.calle),
          ciudad = $("#ciudad").val(data.ciudad),
          codigoPostal = $("#codigoPostal").val(data.cp),
          pais = $("#pais").val(data.pais),
          direccionEnvio = $("#direccionEnvio").val(data.direccionEnvio),
          tlf1 = $("#tlf1").val(data.tlf1),
          fax = $("#fax").val(data.fax),
          correoElectronico = $("#correoElectronico").val(data.correoElectronico),
          paginaWeb = $("#paginaWeb").val(data.paginaWeb),
          codigo = $("#codigo").val(data.codigo),
          moneda = $("#moneda").val(data.moneda),
          formaPago = $("#formaPago").val(data.formaPago),
          metodoPago = $("#metodoPago").val(data.metodoPago),
          cfdi = $("#cfdi").val(data.cfdi),
          responsable = $("#responsable").val(data.responsable),
          opcion = $("#opcion").val("modificar");

          $("#cuadro2").slideDown("slow");
          $("#cuadroBotones").slideDown("slow");
          $("#cuadro1").slideUp("slow");
      });
    }

    var obtener_data_banco = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        var idcontacto = $("#idcontacto").val(data.id), 
          nombreEmpresa = $("#empresa").val(data.nombreEmpresa),
          rfc = $("#rf").val(data.RFC),
          personaContacto = $("#persona").val(data.personaContacto),
          calle = $("#cal").val(data.calle),
          ciudad = $("#ciu").val(data.ciudad),
          codigoPostal = $("#codigoPostal").val(data.cp),
          pais = $("#pais").val(data.pais),
          direccionEnvio = $("#direccionEnvio").val(data.direccionEnvio),
          tlf1 = $("#tlf1").val(data.tlf1),
          fax = $("#fa").val(data.fax),
          correoElectronico = $("#correo").val(data.correoElectronico),
          paginaWeb = $("#paginaWeb").val(data.paginaWeb),
          codigo = $("#codigo").val(data.codigo),
          moneda = $("#moneda").val(data.moneda),
          formaPago = $("#formaPago").val(data.formaPago),
          metodoPago = $("#metodoPago").val(data.metodoPago),
          cfdi = $("#cfdi").val(data.cfdi),
          responsable = $("#responsable").val(data.responsable),
          opcion = $("#opcion").val("modificar");

          $("#cuadro2").slideDown("slow");
          $("#cuadroBotones").slideDown("slow");
          $("#cuadro1").slideUp("slow");
          $("#cuadroBanco").slideUp("slow");
      });
    }

    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
          console.log(data);
        var idcontacto = $("#frmEliminarUsuario #idcontacto").val(data.id);
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