<?php 
	
	include("../../conexion.php");

	$query="SELECT embarques.folio_embarque, embarques.cliente, embarques.fecha_embarque, embarques.usuario, contactos.nombreEmpresa 
	FROM embarques LEFT JOIN contactos on contactos.id=embarques.cliente WHERE folio_embarque >  '2666' ORDER BY folio_embarque DESC 
	LIMIT 150 ";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo['data'][] = array(
				'folio' => $data['folio_embarque'],
				'nombreCliente' => $data['nombreEmpresa'],
				'fecha' => $data['fecha_embarque'],
				'contactoHemusa' => $data['usuario']
			);	
		}		
	}
	
	echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	mysqli_close($conexion_usuarios);
 ?>