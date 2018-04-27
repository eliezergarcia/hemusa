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
      <h1 class="text-center">Pedidos sin orden de compra</h1>
      <p class="text-center">En esta pagina se muestran los pedidos con proveedor asignado y que estan pendientes de crear oc. </p>
    </div>
  </div>
  

  <div class="row center-xs">
      <div class="table-responsive col-sm-11">    
        <table id="dt_pedidos" class="table table-hover start-xs" cellspacing="0" width="100%">
          <thead>
            <tr>           
              <th>Proveedor</th>
              <th>Cliente</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Fecha de pedido</th>
              <th>Almacen</th>
              <th>Costo</th>                     
            </tr>
          </thead>          
        </table>
      </div>      
    </div>    
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
    });

    var  listar = function(){
      var table = $("#dt_pedidos").DataTable({
        "destroy":"true",
        "ajax":{
          "method":"POST",
          "url":"listar_pedidos.php" 
        },
        "columns":[
          {"data":"Proveedor","sortable": false},
          {"data":"nombreEmpresa", "sortable": false},
          {"data":"marca", "sortable": false},
          {"data":"modelo", "sortable": false},
          {"data":"descripcion", "sortable": false},
          {"data":"cantidad", "sortable": false},
          {"data":"pedidoFecha", "sortable": false},
          {"defaultContent": "0", "sortable": false},
          {
            "data":"precioLista", "sortable": false,
            "render": function(precioLista){
              return "$ " + precioLista;
            }
          }
        ],
        "order": [[6,"desc"]],
        "language": idioma_espanol,
        "dom": 'Bfrtip',
        "buttons":[
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'Exportar PDF',
            "className": "btn iconopdf"
          },
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Exportar Excel',
            "className": "btn iconoexcel"
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'Exportar CSV',
            "className": "btn iconocsv"
          }
        ]
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