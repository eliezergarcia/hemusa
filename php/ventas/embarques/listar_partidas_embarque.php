<?php 
    include("../../conexion.php");
    $folio = $_POST['folio'];

	$query = "SELECT cotizacionherramientas.*, cotizacion.guia, cotizacion.IdPaqueteria, cotizacion.NoPedClient FROM cotizacionherramientas
    INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE folio_embarque = '$folio'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error');
	}else{
        $i = 1;
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'][] = array(
				'indice' => $i,
				'marca' => $data['marca'],
				'modelo' => $data['modelo'],
                'descripcion' => $data['descripcion'],
                'cantidad' => $data['cantidad'],
                'factura' => $data['factura'],
                'ordencompra' => $data['NoPedClient'],
                'paqueteria' => $data['guia'],
                'guia' => $data['guia']
            );	
            $i++;
		}		
	}
	
	echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	mysqli_close($conexion_usuarios);
 ?>