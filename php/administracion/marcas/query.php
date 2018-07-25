<?php

	include("../../conexion.php");
	$query = "SELECT DISTINCT id, factura FROM cotizacionherramientas WHERE factura != '' AND factura != '0' AND pedidoFecha > '2018-06-01' AND pedidoFecha < '2018-07-31'";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$idherramienta = $data['id'];
      $idcotizacion = $data['factura'];

      $query2 = "SELECT factura_hemusa FROM utilidad_pedido WHERE id_cotizacion_herramientas ='$idherramienta'";
      $resultado2 = mysqli_query($conexion_usuarios, $query2);
      while($data2 = mysqli_fetch_assoc($resultado2)){
        $factura = $data2['factura_hemusa'];
      }

      $query3 = "UPDATE cotizacion SET factura='$factura' WHERE id='$idcotizacion'";
      $resultado3 = mysqli_query($conexion_usuarios, $query3);


      $arreglo['data'][] = array(
        'idherramienta' => $idherramienta,
        'idcotizacion' => $idcotizacion,
        'factura' => $factura
      );
		}
	}
  echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
