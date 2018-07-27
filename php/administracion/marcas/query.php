<?php

	include("../../conexion.php");
	// $query = "SELECT DISTINCT id, factura FROM cotizacionherramientas WHERE factura != '' AND factura != '0' AND pedidoFecha > '2018-06-01' AND pedidoFecha < '2018-07-31'";
	// $resultado = mysqli_query($conexion_usuarios, $query);

	$query = "SELECT DISTINCT factura_hemusa FROM utilidad_pedido WHERE factura_hemusa != '0' AND factura_hemusa != '' ORDER BY factura_hemusa ASC";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			// $idcotizacion = $data['id'];
			// $fecha = $data['fechaEntregado'];
			// $factura = $data['factura'];
			// $facturaFecha = $data['facturaFecha'];
			// $idherramienta = $data['id'];
      // $idcotizacion = $data['factura'];
			//
      // $query2 = "UPDATE cotizacion SET facturaFecha='$fecha' WHERE id='$idcotizacion'";
      // $resultado2 = mysqli_query($conexion_usuarios, $query2);
			//
      // $query3 = "UPDATE cotizacion SET factura='$factura' WHERE id='$idcotizacion'";
      // $resultado3 = mysqli_query($conexion_usuarios, $query3);


      $arreglo['data'][] = array(
        'factura' => $data['factura_hemusa']
      );
		}
	}
  echo json_encode($arreglo);
	mysqli_close($conexion_usuarios);
 ?>
