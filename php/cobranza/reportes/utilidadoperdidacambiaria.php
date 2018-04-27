<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);

    $fechaInicio = $_REQUEST['fechaInicio'];
    $fechaFinal =  $_REQUEST['fechaFinal'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Utilidad o Perdida Cambiaria</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Eliezer Hernandez">
	<meta name="description" content="Hemusa, herramientas mecanicas y universales">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!--CSS-->    
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Righteous" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.indigo-pink.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="css/buttons.semanticui.min.css">
    <link rel="stylesheet" href="css/select.semanticui.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.0.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/awesomplete.css">

    <!--Javascript-->    
    <script defer src="js/material.min.js"></script> 
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.material.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/fontawesome.js"></script>
	<script src="js/awesomplete.min.js"></script>


    <!-- Librerias para Exportación de Botones -->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script> 
    <script src="js/buttons.html5.min.js"></script>  
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>

    <script src="js/zelect.js"></script>

</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
    			<div class="row fondo">
					<div class="col-sm-12" id="titulo">
						<br><h1 class="text-center titulo">Reporte de Utilidad o Pérdida Cambiaria</h1>
					</div>
				</div>	
				<br>
                <div class="container-fluid col" id="info">
                            <hr>
                            <div class="col-12 row align-items-center">
                                <div class="col-2">
                                    <img src="<?php echo $ruta; ?>media/images/logo_hemusa.png" alt="" width="110%">
                                </div>
                                <div class="col-8 row justify-content-center">
                                    <h2><b>HERRAMIENTAS MECÁNICAS UNIVERSALES S.A DE C.V</b></h2>
                                    <h5 class="col-12 row justify-content-center">RUPERTO MARTÍNEZ 831 PTE, MONTERREY, N.L. C.P. 64000, MÉXICO </h5>
                                    <h5 class="col-12 row justify-content-center">TELS: (81) 8345-3811, FÁX: (81) 8342-8082 </h5>
                                    <h5 class="col-12 row justify-content-center">ventas@hemusa.com, www.hemusa.com </h5>
                                    <h5 class="col-12 row justify-content-center">Portal de clientes: www.hemusa.com.mx </h5>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 row justify-content-start">
                                <h5 class="col-12 row justify-content-start">Mes: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strftime("%B", strtotime($fechaFinal)); ?></h5>
                                <h5 class="col-12 row justify-content-start">Fechas: <?php echo strftime("%d/%m/%Y", strtotime($fechaInicio)).' - '.strftime("%d/%m/%Y", strtotime($fechaFinal)); ?></h5>
                            </div>
                            <br>
                        </div>
                <div class="container-fluid col row justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enviarCorreoModal">Enviar <i class="fa fa-envelope-o"></i></button>
                </div>

                <div class="modal fade" id="enviarCorreoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Enviar correo electrónico</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="correoElectronico" class="col-2">Para: </label>
                                        <input type="email" class="form-control" name="correoElectronico" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asunto" class="col-2">Asunto: </label>
                                        <input type="text" class="form-control" name="asunto" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mensaje" class="col-2">Mensaje: </label>
                                        <textarea name="mensaje" class="form-control" id="" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <br>
                <div class="container-fluid col row">
                    <table id="dt_up_cambiaria" class="ui celler table display" width="100%">
                        <thead>
                            <tr>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Total USD</th>
                                <th>TC</th>
                                <th>Total MXN</th>
                                <th></th>
                                <th>Fecha Pago</th>
                                <th>TC</th>
                                <th>Total MXN</th>
                                <th></th>
                                <th>Utilidad/Perdida Cambiaria</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM payments WHERE date >= '".$fechaInicio."' AND date <= '".$fechaFinal."' AND currency = 'usd'";
                                $resultado = mysqli_query($conexion_usuarios, $query);
                                while($row = mysqli_fetch_array($resultado)){

                            ?>
                            <tr>
                                <td><?php echo $row['factura']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>$ <?php echo $row['amount']; ?></td>
                                <td><?php echo $row['exchangeRate']; ?></td>
                                <td>$ <?php echo $row['amount']*$row['exchangeRate']; ?></td>
                                <td></td>
                                <td>
                                    <?php
                                        echo $row['fecha_registro'];
                                    ?>
                                </td>
                                <td>19.0446</td>
                                <td>$ <?php echo round($row['amount']*19.0446, 2); ?></td>
                                <?php $dif = round($row['amount']*19.0446, 2) -  $row['amount']*$row['exchangeRate']; ?>
                                <td></td>
                                <td>$ <?php echo $dif; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
</body>
</html>

<script>
    $(document).on("ready", function(){
        var table = $("#dt_up_cambiaria").DataTable({
                "destroy":"true",
                "bDeferRender": true,           
                "sPaginationType": "full_numbers",
                "order": [[1, "asc"]],
                "language": idioma_espanol,
                "lengthChange": false,
                "columnDefs": [
                  { "orderable": false, "targets": 5 }
                ],
                "language": idioma_espanol,
                "dom":  
                    "<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
                    "<'clear'>" +
                    "<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
                    "<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
                "buttons":[
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        download: 'open',
                        titleAttr: 'PDF',
                        "className": "btn iconopdf",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                        title: 'Reporte de Utilidad o Perdida Cambiaria'
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        "className": "btn iconoexcel",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        "className": "btn iconocsv",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo").innerHTML);
                            $(window.document.body).children().eq(2).after(document.getElementById("info").innerHTML);
                        },
                    }
                ]
            });
    });

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
