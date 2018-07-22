<?php
	include('../../conexion.php');

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			$cliente = json_decode($_POST['cliente']);
			$tipo = json_decode($_POST['registrarpor']);
			$facoc = json_decode($_POST['facoc']);
			$fecha = json_decode($_POST['fecha']);
			$monto = json_decode($_POST['monto']);
			$cuenta = json_decode($_POST['cuenta']);
			$tipocambio = json_decode($_POST['tipocambio']);
			$numeropagos = $_POST['numeropagos'];
			// $existe = existe_pago($tipo, $facoc, $cliente, $conexion_usuarios);
			// if($existe > 0 ){
			// 	$informacion["respuesta"] = "EXISTE";
			// 	echo json_encode($informacion);
			// }else{
			// }
				registrar($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $numeropagos, $conexion_usuarios);

			break;

		case 'registrarpagoscliente':
			$cliente = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$numeropartidas = $_POST['numeroPartidas'];
			$pagos = json_decode($_POST['pagos']);
			registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $pagos, $conexion_usuarios);
			break;

		case 'editarpagocliente':
			$idpago = $_POST['idpago'];
			$fechapago = $_POST['fechapago'];
			$tcpago = $_POST['tcpago'];
			$bancopago = $_POST['bancopago'];
			editar_pago_cliente($idpago, $fechapago, $tcpago, $bancopago, $conexion_usuarios);
			break;

		case 'eliminarpago':
			$idpago = $_POST['idpago'];
			$factura = $_POST['facturas'];
			eliminar_factura_pago($idpago, $factura, $conexion_usuarios);
			break;

		case 'registrarproveedor':
			$cliente = $_POST['cliente'];
			$tipo = $_POST['registrarpor'];
			$facoc = $_POST['facoc'];
			$fecha = $_POST['fecha'];
			$monto = $_POST['monto'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			registrarproveedor($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $conexion_usuarios);
			break;

		case 'registrarpagosproveedor':
			$proveedor = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$total = $_POST['total'];
			$facturas = json_decode($_POST['pagos']);
			registrar_pagos_proveedor($proveedor, $fecha, $cuenta, $total, $tipocambio, $facturas, $conexion_usuarios);
			break;

		case 'abonocliente':
			$cantidadabono = $_POST['cantidadabono'];
			$facturas = json_decode($_POST['pagos']);
			abono_cliente($facturas, $cantidadabono, $conexion_usuarios);
			break;
	}

	function abono_cliente($facturas, $cantidadabono, $conexion_usuarios){
		foreach ($facturas as &$idfactura) {
			$query = "UPDATE facturas SET pagado = pagado + '$cantidadabono' WHERE id ='$idfactura'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1 || !$resultado) {
				$query = "UPDATE cotizacion SET Pagado = Pagado + '$cantidadabono' WHERE id ='$idfactura'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un error al aplicar el abono.";
				}else{
					$informacion["respuesta"] = "BIEN";
					$informacion["informacion"] = "El abono se registró correctamente.";
				}
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "El abono se registró correctamente.";
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function existe_pago($tipo, $facoc, $cliente, $conexion_usuarios){
		if ($tipo == "factura") {
			$query = "SELECT id FROM pagos WHERE factura = '$facoc' AND cliente = '$cliente'";
		}else{
			$query = "SELECT id FROM pagos WHERE ordenCompra = '$facoc' AND cliente = '$cliente'";
		}

		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_pago = mysqli_num_rows( $resultado );
		return $existe_pago;
	}

	function registrar($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $numeropagos, $conexion_usuarios){
		for ($i=0; $i < $numeropagos ; $i++) {
			$clien = $cliente[$i];
			$tip = $tipo[$i];
			$fac = $facoc[$i];
			$fec = $fecha[$i];
			$mon = $monto[$i];
			$cuen = $cuenta[$i];
			$tipoca = $tipocambio[$i];
			if ($tip == "factura") {
				$query = "INSERT INTO pagos (cliente,tipo,factura,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				// $query = "SELECT cliente FROM pedidos WHERE factura = '$fac'";
				// $resultado = mysqli_query($conexion_usuarios, $query);

				// if (!$resultado) {
				// 	die("Error al buscar id cliente!");
				// }else{
				// 	while($data = mysqli_fetch_assoc($resultado){
				// 		$clien = $data['cliente'];
				// 	}
				// 	$query = "INSERT INTO pagos (cliente,tipo,factura,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				// 	$resultado = mysqli_query($conexion_usuarios, $query);
				// }

			}else{
				$query = "INSERT INTO pagos (cliente,tipo,ordenCompra,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				// $query = "SELECT * FROM pedidos WHERE numeroPedido = '$fac'";
				// $resultado = mysqli_query($conexion_usuarios, $query);

				// while($data = mysqli_fetch_assoc($resultado){
				// 	$clien = $data['cliente'];
				// }

				// $query2 = "INSERT INTO pagos (cliente,tipo,ordenCompra,fecha,monto,cuenta,tipoCambio) VALUES('$clien', '$tip', '$fac', '$fec', '$mon', '$cuen', '$tipoca')";
				// $resultado2 = mysqli_query($conexion_usuarios, $query2);
			}

		}
		verificar_resultado($resultado);

		// cerrar($conexion_usuarios);
	}

	function registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $pagos, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1 || !$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar información del cliente.";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['id'];
			}
		}

		$query = "SELECT max(idpago) AS ultimoidpago FROM payments";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1 || !$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar información de facturas.";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idpago = $data['ultimoidpago'] + 1;
			}
		}

		switch ($cuenta) {
			case 1:
				$monedacuenta = "mxn";
				break;

			case 2:
				$monedacuenta = "mxn";
				break;

			case 3:
				$monedacuenta = "usd";
				break;

			case 4:
				$monedacuenta = "usd";
				break;
		}

		foreach ($pagos as &$idpedido) {
			$query = "SELECT * FROM cotizacion WHERE id ='$idpedido'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			if (mysqli_num_rows($resultado) < 1 || !$resultado) {
				$query = "SELECT * FROM facturas WHERE id ='$idpedido'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				while($data = mysqli_fetch_assoc($resultado)){
					$moneda = $data['moneda'];
					$total = $data['total'];
					$pagado = $data['pagado'];
					$monto = $total - $pagado;
					$factura = $data['folio'];

					if ($moneda == "usd" && $tipocambio != 1) {
						$monto = $monto * $tipocambio;
					}
				}

				$query = "INSERT INTO payments (client, factura, date, amount, account, currency, exchangeRate, idpago) VALUES ('$idcliente', '$factura', '$fecha', '$monto', '$cuenta', '$monedacuenta', '$tipocambio', '$idpago')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al intentar registrar el pago.";
				}else{
					$query = "SELECT * FROM facturas WHERE id ='$idpedido'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					while($data = mysqli_fetch_assoc($resultado)){
						$moneda = $data['moneda'];
						$total = $data['total'];
					}

					$query = "UPDATE facturas SET pagado='$total', status='pagada' WHERE id ='$idpedido'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al actualizar la información de la factura.";
					}else{
						$informacion["respuesta"] = "BIEN";
						$informacion["informacion"] = "La información de la(s) factura(s) se actualizó correctamente.";
					}
				}
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$moneda = $data['moneda'];
					$total = $data['precioTotal'] * 1.16;
					$pagado = $data['Pagado'];
					$monto = $total - $pagado;
					$factura = $data['factura'];

					if ($moneda == "usd" && $tipocambio != 1) {
						$monto = $monto * $tipocambio;
					}
				}

				$query = "INSERT INTO payments (client, factura, date, amount, account, currency, exchangeRate, idpago) VALUES ('$idcliente', '$factura', '$fecha', '$monto', '$cuenta', '$monedacuenta', '$tipocambio', '$idpago')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al intentar registrar el pago.";
				}else{
					$query = "SELECT * FROM cotizacion WHERE id ='$idpedido'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					while($data = mysqli_fetch_assoc($resultado)){
						$moneda = $data['moneda'];
						$total = $data['precioTotal'] * 1.16;
					}

					$query = "UPDATE cotizacion SET Pagado='$total' WHERE id ='$idpedido'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al actualizar la información de la factura.";
					}else{
						$informacion["respuesta"] = "BIEN";
						$informacion["informacion"] = "La información de la(s) factura(s) se actualizó correctamente.";
					}
				}
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_pago_cliente($idpago, $fechapago, $tcpago, $bancopago, $conexion_usuarios){
		$query = "UPDATE payments SET date = '$fechapago', exchangeRate = '$tcpago', account = '$bancopago' WHERE id = '$idpago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información de el pago.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del pago se modificó correctamente";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function eliminar_factura_pago($idpago, $factura, $conexion_usuarios){
		$query = "UPDATE facturas SET pagado=0, status='enviada' WHERE folio='$factura'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "UPDATE cotizacion SET Pagado=0 WHERE factura='$factura'";
		$resultado=mysqli_query($conexion_usuarios, $query);

		$query = "DELETE FROM payments WHERE id ='$idpago'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al eliminar el pago.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El pago de la factura se eliminó correctamente.";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function registrarproveedor($cliente, $tipo, $facoc, $fecha, $monto, $cuenta, $tipocambio, $conexion_usuarios){
		$monto = $monto * 1.16;
		$query = "SELECT id,moneda FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$idproveedor = $data['id'];
			$monedaproveedor = $data['moneda'];
		}

		$fecha = date("Y-m-d");

		if ($tipo == "factura") {
			$query = "INSERT INTO pagos_oc (proveedor, monto,fecha,cuenta,factura,tipo_cambio) VALUES('$idproveedor', '$monto', '$fecha', '$cuenta', '$facoc', '$tipocambio')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET pagada = 'si', pago_factura =  '$monto', fecha_pago = '$fecha', total_factura = '$monto' WHERE factura_proveedor = '$facoc'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}else{
			$query = "INSERT INTO pagos_oc (proveedor, monto,fecha,cuenta,orden_compra,tipo_cambio) VALUES('$idproveedor', '$monto', '$fecha', '$cuenta', '$facoc', '$tipocambio')";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET pagada = 'si', pago_factura =  '$monto', fecha_pago = '$fecha', total_factura = '$monto' WHERE orden_compra = '$facoc'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		verificar_resultado($resultado);
	}

	function registrar_pagos_proveedor($proveedor, $fecha, $cuenta, $total, $tipocambio, $facturas, $conexion_usuarios){
		$total = $total * 1.16;
		$query = "INSERT INTO pagos_oc (proveedor, monto, fecha, cuenta, tipo_cambio) VALUES ('$proveedor', '$total', '$fecha', '$cuenta', '$tipocambio')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		$query = "SELECT moneda FROM contactos WHERE id = '$proveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$monedaproveedor = $data['moneda'];
		}

		foreach ($facturas as &$valor) {
			$factura = $valor;

			$query="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$total = 0;
			while($data = mysqli_fetch_assoc($resultado)){
				if ($monedaproveedor == "usd") {
					$total = $total + ($data['costo_usd'] * $data['cantidad']);
				}else{
					$total = $total + ($data['costo_mn'] * $data['cantidad']);
				}
			}
			$total = $total * 1.16;
			$fecha = date("Y-m-d");
			$query2="UPDATE utilidad_pedido SET pagada = 'si', pago_factura = '$total', fecha_pago = '$fecha', cuenta = '$cuenta', total_factura = '$total' WHERE factura_proveedor = '$factura'";
			$resultado2 = mysqli_query($conexion_usuarios, $query2);
		}
		verificar_resultado($resultado);
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}

	function cerrar($conexion_usuarios){
		mysqli_close($conexion_usuarios);
	}

 ?>
