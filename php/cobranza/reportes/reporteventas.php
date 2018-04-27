<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	// error_reporting(0);

    $fechaInicio = $_REQUEST['fechaInicio'];
    $fechaFinal =  $_REQUEST['fechaFinal'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Reporte de Ventas</title>
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
						<h1 class="text-center titulo">Reporte de Ventas</h1><br>
					</div>
				</div>	
              
				<br>
                <div class="container-fluid col row">
                    <table id="dt_up_cambiaria" class="ui celler table display" width="100%">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Empresa</th>
                                <th>Moneda</th>
                                <th>Status</th>
                                <th>IVA</th>
                                <th>Base Sub.</th>
                                <th>Imp. Total</th>
                                <th>TC</th>
                                <th>MN Importe</th>
                                <th>MN Base</th>
                                <th>MN IVA</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php
                                $usdIVA = 0;
                                $usdSUB = 0;
                                $mxnIVA = 0;
                                $mxnSUB = 0;
                                $totalIVA = 0;
                                $totalSUB = 0;
                                $query = "SELECT * FROM payments WHERE date >= '".$fechaInicio."' AND date <= '".$fechaFinal."'";
                                $resultado = mysqli_query($conexion_usuarios, $query);
                                while($row = mysqli_fetch_array($resultado)){
                                    $queryCliente = "SELECT nombreEmpresa FROM contactos WHERE id = '".$row['client']."'";
                                    $resCliente = mysqli_query($conexion_usuarios, $queryCliente);
                                    while($rowCliente = mysqli_fetch_array($resCliente)){
                                        $cliente = $rowCliente['nombreEmpresa'];
                                    }
                            ?>
                            <tr>
                                <td><?php echo $row['factura']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo utf8_encode($cliente); ?></td>
                                <td><?php echo $row['currency']; ?></td>
                                <td><?php 
                                    if($row['fecha_registro']!='0000-00-00 00:00:00'){
                                        echo 'PAGADO'; 
                                    }else{

                                    }
                                    ?>
                                </td>
                                <?php $IVA = $row['amount']*0.21; ?>
                                <td>$ <?php echo round($IVA,2); ?></td>
                                <?php 
                                    if($row['currency'] == 'usd'){
                                        $usdIVA = $usdIVA + $IVA; 
                                    }else{
                                        $mxnIVA = $mxnIVA + $IVA; 
                                    }
                                ?>
                                <td>$ <?php echo round($row['amount'],2); ?></td>
                                 <?php 
                                    if($row['currency'] == 'usd'){
                                        $usdSUB = $usdSUB + $row['amount']; 
                                    }else{
                                        $mxnSUB = $mxnSUB + $row['amount']; 
                                    }
                                ?>
                                <?php $total = round($row['amount']+$IVA,2); ?>
                                <td>$ <?php echo $total; ?></td>
                                <td>$ <?php echo $row['exchangeRate']; ?></td>
                                <?php $mnImporte = $total*$row['exchangeRate']; ?>
                                <td>$ <?php echo round($mnImporte,2); ?></td>
                                <?php $ivaMnImporte = $mnImporte*0.21; ?>
                                <td>$ <?php echo round($mnImporte-$ivaMnImporte,2); ?></td>
                                <?php $totalSUB = $totalSUB + ($mnImporte-$ivaMnImporte); ?>
                                <td>$ <?php echo round($ivaMnImporte,2); ?></td>
                                <?php
                                    $totalIVA = $totalIVA + $ivaMnImporte;
                                ?>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>

                    <div class="container-fluid col-4 row justify-content-end" id="dt_totales">
                        <table class="ui celler table display">
                            <tr>
                                <td><b>USD</b></td>
                                <td>$ <?php echo round($usdIVA,2); ?></td>
                                <td>$ <?php echo round($usdSUB,2); ?></td>
                                <td>$ <?php echo round($usdSUB + $usdIVA,2); ?></td>
                            </tr>
                             <tr>
                                <td><b>MXN</b></td>
                                <td>$ <?php echo round($mxnIVA,2); ?></td>
                                <td>$ <?php echo round($mxnSUB,2); ?></td>
                                <td>$ <?php echo round($mxnSUB + $mxnIVA,2); ?></td>
                            </tr>
                             <tr>
                                <td><b>TOTAL</b></td>
                                <td>$ <?php echo round($totalIVA,2); ?></td>
                                <td>$ <?php echo round($totalSUB,2); ?></td>
                                <td>$ <?php echo round($totalSUB + $totalIVA,2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>IVA</td>
                                <td>SUBTOTAL</td>
                                <td>TOTAL</td>
                            </tr>
                        </table>
                    </div>                    
                </div>
                <br><br>
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                        },
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        "className": "btn iconoexcel",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        "className": "btn iconocsv",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo").innerHTML);
                            $(window.document.body).children().eq(4).after(document.getElementById("dt_totales").innerHTML);
                        },
                    }
                    // {
                    //     text: '<i class="fa fa-envelope-o"></i>',
                    //     "className": "btn btn-primary",
                    //     action: function ( e, dt, node, config ) {
                    //         // alert( 'Button activated' );
                    //         $('#exampleModal').modal('toogle');
                    //     }
                    // }
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
