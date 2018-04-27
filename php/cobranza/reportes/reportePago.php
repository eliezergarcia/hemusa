<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	error_reporting(0);
    $account = $_REQUEST["account"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Reporte de Pagos</title>
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
                    <div class="row fondo" id="titulo">
                        <div class="col-sm-12">
                            <br><h1 class="text-center titulo">Reporte de Pagos</h1>
                        </div>
                    </div>
                    <style>
                        #titulo2{
                            display: none;
                        }
                    </style>
                    <div class="row fondo" id="titulo2">
                        <div class="col-sm-12">
                            <br><h1 class="text-center titulo">Reporte de Pólizas</h1>
                        </div>
                    </div>
                    <br>
                <div id="info">
                    <?php
                        $insertSQL="SELECT nombre FROM `accounts` WHERE id=".$account;
                        $result2 = mysqli_query($conexion_usuarios, $insertSQL);
                        $row2 = mysqli_fetch_array($result2);
                        echo '<center><h3><b>'.$row2['nombre'].'</b></h3></center>';
                    ?>
                </div>
                <br>
                <?php
                    //obtenemos el archivo .csv
                    $tipo = $_FILES['archivo']['type'];
 
                    $tamanio = $_FILES['archivo']['size'];
 
                    $archivotmp = $_FILES['archivo']['tmp_name'];
 
                    //cargamos el archivo
                    $lineas = file($archivotmp);
 
                    //inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
                    $i=0;
                ?>
                <table id="dt_reporte_pagos" class="ui celler table display" width="100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Factura</th>
                            <th>Cliente</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    //Recorremos el bucle para leer línea por línea
                    foreach ($lineas as $linea_num => $linea){ 
                        //abrimos bucle
                        /*si es diferente a 0 significa que no se encuentra en la primera línea 
                        (con los títulos de las columnas) y por lo tanto puede leerla*/
                        if($i != 0){ 
                            //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
                            /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
                            leyendo hasta que encuentre un ; */
                            $datos = explode(";",$linea);
                     
                            //Almacenamos los datos que vamos leyendo en una variable
                            //usamos la función utf8_encode para leer correctamente los caracteres especiales
                            $fecha = utf8_encode($datos[0]);
                            $descripcion = $datos[1];
                            $deposito = str_replace(",", ".", $datos[2]);
                            $retiro = $datos[3];
                            // $deposito = str_replace(',', ".", $deposito);
                     
                            //guardamos en base de datos la línea leida
                            // mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");
                    if($deposito !=''){
                        $query = "SELECT * FROM payments WHERE amount ='".$deposito."' AND date='".$fecha."'";
                        $resultado = mysqli_query($conexion_usuarios, $query);
                        while($data = mysqli_fetch_array($resultado)){
                            $factura = $data['factura'];
                            $fech = $data['date'];

                            $queryCliente = "SELECT nombreEmpresa FROM contactos WHERE id='".$data['client']."'";
                            $resultadoCliente = mysqli_query($conexion_usuarios, $queryCliente);
                            while($dataCliente = mysqli_fetch_array($resultadoCliente)){
                                $cliente = $dataCliente['nombreEmpresa'];
                            }
                        }

                ?>
                        <tr>
                            <td><?php echo $fech; ?></td>
                            <td>
                                <?php 
                                    echo $factura;
                                ?>
                            </td>
                            <td><?php echo $cliente; ?></td>
                            <td>$ <?php echo $deposito; ?></td>  
                            <td>$<?php echo $retiro; ?></td>                          
                        </tr>
                <?php
                     
                            //cerramos condición
                        }
                
                    }
 
                    /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
                    entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
                    $i++;
                    //cerramos bucle
                    }
                ?>
                    </tbody>
                </table>
               <!--  <?php 
                    $insertSQL="SELECT DISTINCT date as 'fecha' , (SELECT GROUP_CONCAT(p.factura order by p.factura  SEPARATOR ', ' ) FROM payments as p WHERE p.client=payments.client and payments.date=p.date  and p.account=payments.account  order by p.factura ASC ) AS 'factura', contactos.nombreEmpresa as 'cliente' , (select sum(pagos.amount) from payments as pagos where pagos.date=payments.date and pagos.client=payments.client  and pagos.account=payments.account) as PAGO FROM `payments` left JOIN contactos on contactos.id= payments.client WHERE account=".$account." and date>='".$inicio."' AND date<='".$ultimo."' order by payments.date, contactos.nombreEmpresa";
                    $result = mysqli_query($conexion_usuarios, $insertSQL);
                    echo '<center><table summary="" border="1" cellpadding="2" cellspacing="0">';
                    echo '<tr><td><b>Fecha</b></td><td><b>Factura</b></td><td><b>Cliente</b></td><td><b>Cantidad</b></td></tr>';
                    $Total=0;
                    while ($row= mysqli_fetch_array($result)) {  
                        $row['factura']=str_replace (",","<br>",  $row['factura'] );
                        echo "<tr>";
                        echo  '<td>'.$row['fecha'].'</td> ';
                        echo  '<td>'.$row['factura'].'</td> ';
                        echo  '<td>'.$row['cliente'].'</td> ';
                        echo  '<td>'.$row['PAGO'].'</td> ';
                        echo "</tr>";
                        $Total+=$row['PAGO'];
                    }
                    echo '</table>';
                    echo "<br><h2><b>TOTAL: ".$Total."</b></h2></center>";
                ?>  -->
                <!-- <div class="container">
                    <table id="dt_reporte_pagos" class="ui celler table display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Factura</th>
                                <th>Cliente</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </main>
</body>
</html>

<script>
    $(document).on("ready", function(){
        var table = $("#dt_reporte_pagos").DataTable({
                "destroy":"true",
                "bDeferRender": true,           
                "sPaginationType": "full_numbers",
                "order": [[0, "asc"]],
                "language": idioma_espanol,
                "lengthChange": false,
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
                                columns: [ 0, 1, 2, 3 ]
                        },
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        "className": "btn iconoexcel",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        "className": "btn iconocsv",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Pagos',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo").innerHTML);
                            $(window.document.body).children().eq(1).after(document.getElementById("info").innerHTML);
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Poliza',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 0, 1, 2, 4 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after(document.getElementById("titulo2").innerHTML);
                            $(window.document.body).children().eq(1).after(document.getElementById("info").innerHTML);
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
