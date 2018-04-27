<?php
    include("../../conexion.php");

    $numeroCotizacion = $_POST['numeroCotizacion'];

    $query = "SELECT cotizacionherramientas.*, cotizacion.partidaCantidad FROM cotizacionherramientas INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE cotizacionRef = '$numeroCotizacion' AND numeroPedido = ''";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(!$resultado){
        die('Error al listar las partidas de la cotizacion!');
    }else{
        $i=1;
        while($data = mysqli_fetch_assoc($resultado)){
            $marca = $data['marca'];
            $modelo = $data['modelo'];


            $querystock = "SELECT enReserva,clase,factor FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
            $resultadostock = mysqli_query($conexion_usuarios, $querystock);
            if (mysqli_num_rows($resultadostock) > 0) {
                while($datastock = mysqli_fetch_array($resultadostock)){
                    $stock = $datastock['enReserva'];
                    $clase = $datastock['clase'];
                    $factor = $datastock['factor'];
                }
            }else{
                $stock = 0;
                $clase = "E";
                $factor= 1;
            }

            $precioUnitario = $data['precioLista'] + $data['flete'];

            $precioTotal = $precioUnitario*$data['cantidad'];

            // $imagenModelo = '<img src=\"https://s3.amazonaws.com/hemusaimages/'.strtolower($data["marca"]).'/'.strtolower($data["marca"]).'-'.$data["modelo"].'.jpg\" width=\"80px\">';

            $arreglo["data"][]= array(
                'refCotizacion' => $data['cotizacionRef'],
                'numPartidas' => $data['partidaCantidad'],
                'clase' => $clase,
                'factor' => $factor,
                'id' => $data['id'],
                'numero' => $i,
                'marca' => $data['marca'],
                'modelo' => $modelo,
                'descripcion' => $data['descripcion'],
                'precioUnitario' =>'$ '.$precioUnitario,
                'cantidad' => $data['cantidad'],
                'precioTotal' =>'$ '.number_format($precioTotal, 2, '.', ''),
                'claveSat' => $data['ClaveProductoSAT'],
                'unidad' => $data['Unidad'],
                'tedias' => $data['Tiempo_Entrega'],
                'stock' => $stock,
                'refInterna' => $data['referencia_interna'],
                'cotizadoEn' => $data['lugar_cotizacion'],
                'proveedorFlete' => $data['proveedorFlete']
            );	

            $i++;	
        }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);	
    mysqli_free_result($resultado);
    mysqli_close($conexion_usuarios);
?>