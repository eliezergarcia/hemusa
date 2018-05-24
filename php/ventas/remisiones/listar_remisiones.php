<?php

	include("../../conexion.php");
	ini_set('max_execution_time', 300);

	$ano=date('Y'); //2017
	$mes=date('m');//01
	$dia=date('d');//14

    $ano_inicio=$ano."-".$mes."-".$dia;
	$ano_fin=($ano-1)."-".$mes."-".$dia;

	$query = "SELECT cotizacion.*, contactos.nombreEmpresa, remisiones.remision as r , case when remisiones.efectivo is null then 0 else remisiones.Efectivo end as 'Efectivo' FROM cotizacion LEFT JOIN contactos on
	contactos.id=cotizacion.cliente LEFT JOIN remisiones on remisiones.remision=cotizacion.remision WHERE cotizacion.Comentario='' AND cotizacion.remision!=0 AND
	cotizacion.remisionFactura=0 AND cotizacion.remisionFecha <= '$ano_inicio' AND cotizacion.remisionFecha >='$ano_fin' ORDER BY cotizacion.remision DESC";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die("Error al buscar remisiones!");
	}else{
		$i = 1;
		while($data = mysqli_fetch_assoc($resultado)){
			if($data['Efectivo'] == 1){
				$factura = "Pagada";
			}else{
				$factura = "";
			}

			$arreglo['data'][] = array(
				'indice' => $i,
				'cotizacionRef' => $data['ref'],
				'remision' => $data['remision'],
				'cliente' => $data['nombreEmpresa'],
				'contacto' => $data['contacto'],
				'fecha' => $data['remisionFecha'],
				'cantidad' => $data['partidaCantidad'],
				'suma' => "$ ".$data['precioTotal'],
				'facturas' => $factura
			);
			$i++;
		}
	}

	echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
	mysqli_close($conexion_usuarios);
?>
