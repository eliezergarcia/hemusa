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
	<title></title>
	<?php include('../../enlaces.php'); ?>
</head>
<body>
	
	<?php include('../../header.php'); ?>
	
  		<main class="mdl-layout__content">
    		<div class="page-content">
                    <div class="row fondo" id="titulo">
                        <div class="col-sm-12">
                            <br><h1 class="text-center titulo">Subir Lista de precios</h1>
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