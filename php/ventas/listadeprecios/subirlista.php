<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	$ruta = "http://localhost/Hemusa/";
	// error_reporting(0);
    set_time_limit(30);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<?php include('../../enlaces.php'); ?>

</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
                    <div class="row fondo" id="titulo">
                        <div class="col-sm-12">
                            <br><h1 class="text-center titulo">Subir lista de precios</h1>
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
                <table id="dt_reporte_pagos" class="ui celler table" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Clave</th>
                            <th>Descripcion</th>
                            <th>Estandar</th>
                            <th>Master</th>
                            <th>Precio Lista</th>
                            <th>Precio Distribuidor</th>
                            <th>Página Catálogo</th>
                            <th>Marca</th>
                            <th>Sección Catálogo</th>
                            <th>Código Barras</th>
                            <th>Clave Sat</th>
                            <th>Disponibilidad</th>
                            <th>Mes Promoción</th>
                            <th>Nombre Promoción</th>
                            <th>Descuento</th>
                            <th>Precio Mínimo Venta</th>
                            <th>Descontinuado</th>
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
                            $datos = explode(":", $linea);
                     
                            //Almacenamos los datos que vamos leyendo en una variable
                            //usamos la función utf8_encode para leer correctamente los caracteres especiales
                            $codigo = utf8_encode($datos[0]);
                            $clave = utf8_encode($datos[1]);
                            $descripcion = utf8_encode($datos[2]);
                            $estandar = utf8_encode($datos[3]);
                            $master = utf8_encode($datos[4]);
                            $precioLista = utf8_encode($datos[5]);
                            $precioDis = utf8_encode($datos[6]);
                            $pagCat = utf8_encode($datos[7]);
                            $marca = utf8_encode($datos[9]);
                            $secCat = utf8_encode($datos[10]);
                            $codigoBarras = utf8_encode($datos[11]);
                            $claveSat = utf8_encode($datos[14]);
                            $disponibilidad = utf8_encode($datos[15]);
                            $mesProm = utf8_encode($datos[16]);
                            $nombreProm = utf8_encode($datos[17]);
                            $descuento = utf8_encode($datos[18]);
                            $precioMin = utf8_encode($datos[19]);

                            $mar = strtolower($marca);

                            // $deposito = utf8_encode($datos[2]);
                            // $retiro = utf8_encode($datos[3]);
                            // $deposito = str_replace(',', ".", $deposito);
                     
                            //guardamos en base de datos la línea leida
                            // mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");
                            $query = "SELECT * FROM productos WHERE ref = '$codigo'";
                            $resultado = mysqli_query($conexion_usuarios, $query);
                            if (!$resultado) {
                                // $query = "UPDATE productos SET claveSat='$claveSat', estandar='$estandar', codigoBarras='$codigoBarras', paginaCatalogo='$pagCat', seccionCatalogo='$secCat', mesPromocion='$mesPromocion', precioMinimo='$precioMin', precioBase='$precioLista', precioDistribuidor='$precioDis', Unidad='Unidad'";
                                $des = "actualizar";
                            }else{
                                // $query = "INSERT INTO productos (marca,ref, descripcion, claveSat, estandar, codigoBarras, minimoPedir, paginaCatalogo, seccionCatalogo, mesPromocion, precioMinimo, precioBase,  precioDistribuidor, enReserva, clase, cantidadMinima, Unidad) VALUES ('$marca', '$codigo, '$descripcion', '$claveSat', '$estandar', '$codigoBarras', '$minimoPedir', '$pagCat', '$secCat', '$mesPromocion', '$precioMinimo', '$precioLista', '$precioDistribuidor', '0', 'A', '1', 'PIEZA')";
                                $des = "nuevo";
                            }

                            // mysqli_free_results($query);

                                // $resultado = mysqli_query($conexion_usuarios, $query);
                ?>
                        <tr>
                            <td><?php echo $codigo; ?></td>
                            <td><?php echo $clave; ?></td>
                            <td><?php echo $descripcion; ?></td>  
                            <td><?php echo $estandar; ?></td>    
                            <td><?php echo $master; ?></td>                          
                            <td><?php echo $precioLista; ?></td> 
                            <td><?php echo $precioDis; ?></td>                                                   
                            <td><?php echo $pagCat; ?></td>                          
                            <td><?php echo $marca; ?></td>                          
                            <td><?php echo $secCat; ?></td>                          
                            <td><?php echo $codigoBarras; ?></td>                          
                            <td><?php echo $claveSat; ?></td>
                            <td><?php echo $disponibilidad; ?></td>                          
                            <td><?php echo $mesProm; ?></td>                          
                            <td><?php echo $nombreProm; ?></td>                          
                            <td><?php echo $descuento; ?></td>                          
                            <td><?php echo $precioMin; ?></td>  
                            <td><?php echo $des; ?>
                            </td>                                                    
                        </tr>
                <?php
                     
                            //cerramos condición
                        }
 
                    /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
                    entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
                    $i++;
                    //cerramos bucle
                    }
                ?>
                    </tbody>
                </table>
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
                "order": false,
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        },
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        "className": "btn iconoexcel",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        "className": "btn iconocsv",
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        titleAttr: 'Imprimir',
                        header: 'false',
                        exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        },
                        "className": "btn iconoimprimir",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: '',
                        customize: function(window) {
                            // $(window.document.body).children().eq(0).after(document.getElementById("titulo").innerHTML);
                            // $(window.document.body).children().eq(1).after(document.getElementById("info").innerHTML);
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