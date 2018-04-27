<?php 
	
	include("../../conexion.php");

	$query = "SELECT * FROM cotizacionherramientas WHERE Pedido = 'si' AND numeroPedido != '' AND Entregado = '0000-00-00'";
	$resultado = mysqli_query($conexion_usuarios, $query);													
	$arreglo = Array();

	if(!$resultado){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$ref = $data['cotizacionRef'];
			$querycliente = "SELECT cliente FROM cotizacion WHERE ref = '$ref'";
			$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
			while($datacliente = mysqli_fetch_assoc($resultadocliente)){
				$idcliente = $datacliente['cliente'];
			}

			$queryempresa = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
			$resultadoempresa = mysqli_query($conexion_usuarios, $queryempresa);
			while($dataempresa = mysqli_fetch_assoc($resultadoempresa)){
				$cliente = $dataempresa['nombreEmpresa'];
			}


			$arreglo['data'][] = array(
				'marca' => utf8_encode($data['marca']),
				'modelo' => utf8_decode($data['modelo']),
				'cliente' => $cliente,
				'descripcion' => $data['descripcion'],
				'cantidad' => $data['cantidad'],
				'precio' => "$ ".$data['precioLista'],
				'moneda' => $data['moneda'],
				'pedidoCliente' => $data['numeroPedido'],
				'fechaPedido' => $data['fechaPedido']
			);
		}
	}

	echo json_encode($arreglo);
	mysqli_free_result($resultado);
	mysqli_close($conexion_usuarios);

 ?>