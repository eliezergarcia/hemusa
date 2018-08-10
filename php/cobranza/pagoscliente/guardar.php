<?php
	include('../../conexion.php');
	include('../../sesion.php');

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrarpagoscliente':
			$cliente = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$numeropartidas = $_POST['numeroPartidas'];
			$facturas = json_decode($_POST['facturas']);
			registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $facturas, $conexion_usuarios, $idusuario);
			break;

		case 'editarpagocliente':
			$idpago = $_POST['idpago'];
			$fechapago = $_POST['fechapago'];
			$tcpago = $_POST['tcpago'];
			$bancopago = $_POST['bancopago'];
			editar_pago_cliente($idpago, $fechapago, $tcpago, $bancopago, $conexion_usuarios);
			break;

		case 'eliminarpagocliente':
			$factura = $_POST['factura'];
			eliminar_pago_cliente($factura, $conexion_usuarios, $idusuario);
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
			$fecha = $_POST['fecha'];
			$cuenta = $_POST['cuenta'];
			$tipocambio = $_POST['tipocambio'];
			$proveedor = $_POST['proveedor'];
			$facturas = json_decode($_POST['pagos']);
			registrar_pagos_proveedor($fecha, $cuenta, $tipocambio, $proveedor, $facturas, $conexion_usuarios);
			break;

		case 'abonocliente':
			$cantidadabono = $_POST['cantidadabono'];
			$facturas = json_decode($_POST['pagos']);
			abono_cliente($facturas, $cantidadabono, $conexion_usuarios, $idusuario);
			break;
	}

	function abono_cliente($facturas, $cantidadabono, $conexion_usuarios, $idusuario){
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

	function registrar_pagos_cliente($cliente, $fecha, $cuenta, $tipocambio, $numeropartidas, $facturas, $conexion_usuarios, $idusuario){
		$query = "SELECT id FROM contactos WHERE tipo='Cliente' AND nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1 || !$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar información del cliente.";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$idcliente = $data['id'];
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

				switch ($cuenta) {
					case 1:
					$monedacuenta = "mxn";
					break;

					case 2:
					$monedacuenta = "mxn";
					break;

					case 4:
					$monedacuenta = "usd";
					break;

					case 5:
					$monedacuenta = "usd";
					break;

					case 6:
					$monedacuenta = "mxn";
					break;
				}

				foreach ($facturas as &$factura) {
					$query = "SELECT total FROM facturas WHERE folio='$factura'";
					$resultado = mysqli_query($conexion_usuarios, $query);

					while($data = mysqli_fetch_assoc($resultado)){
						$monto = $data['total'] - $data['pagado'];
					}

					if ($monedacuenta == "usd" && $tipocambio != 1) {
						$monto = $monto * $tipocambio;
					}

					$query = "INSERT INTO payments (client, factura, date, amount, account, currency, exchangeRate, idpago) VALUES ('$idcliente', '$factura', '$fecha', '$monto', '$cuenta', '$monedacuenta', '$tipocambio', '$idpago')";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al intentar registrar el pago.";
					}else{
						$query = "UPDATE facturas SET pagado='$monto', status='pagada' WHERE folio ='$factura'";
						$resultado = mysqli_query($conexion_usuarios, $query);

						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al actualizar la información de la factura.";
						}else{
							$query = "UPDATE cotizacion SET Pagado='$monto', fechaPago='$fecha' WHERE factura ='$factura'";
							$resultado = mysqli_query($conexion_usuarios, $query);

							if (!$resultado) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al actualizar la información de el pedido.";
							}else{
								$descripcionmovimiento = "Se registro un pago de $ ".$monto." de la factura ".$factura." del cliente ".$cliente;
								$fechamovimiento = date("Y-m-d H:i:s");
								$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'cobranza', '$descripcionmovimiento', '$fechamovimiento')";
								$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

								$informacion["respuesta"] = "BIEN";
								$informacion["informacion"] = "La información de la(s) factura(s) se actualizó correctamente.";
							}
						}
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

	function eliminar_pago_cliente($factura, $conexion_usuarios, $idusuario){
		$query = "SELECT cliente FROM facturas WHERE folio = '$factura'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$data = mysqli_fetch_assoc($resultado);
		$cliente = $data['cliente'];

		$query = "UPDATE facturas SET pagado=0.00, status='enviada' WHERE folio='$factura'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al eliminar el pago de la factura";
		}else{
			$query = "UPDATE cotizacion SET Pagado=0.00, fechaPago='0000-00-00' WHERE factura='$factura'";
			$resultado=mysqli_query($conexion_usuarios, $query);

			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al eliminar el pago de el pedido";
			}else{
				$query = "DELETE FROM abonos WHERE deFactura='$factura'";
				$resultado=mysqli_query($conexion_usuarios, $query);

				$query = "DELETE FROM payments WHERE factura ='$factura'";
				$resultado = mysqli_query($conexion_usuarios, $query);

				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al eliminar el pago de el pedido";
				}else{
					$descripcionmovimiento = "Se elimino el pago de la factura ".$factura." del cliente ".$cliente;
					$fechamovimiento = date("Y-m-d H:i:s");
					$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'E', 'cobranza', '$descripcionmovimiento', '$fechamovimiento')";
					$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

					$informacion["respuesta"] = "BIEN";
					$informacion["informacion"] = "El pago de la factura se eliminó correctamente.";
				}
			}
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

	function registrar_pagos_proveedor($fecha, $cuenta, $tipocambio, $proveedor, $facturas, $conexion_usuarios){
		$query = "SELECT * FROM contactos WHERE tipo='Proveedor' AND nombreEmpresa LIKE '%$proveedor%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (mysqli_num_rows($resultado) < 1 || !$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar información del cliente.";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$monedaproveedor = $data['moneda'];
				$idproveedor = $data['id'];
			}
		}

		$query = "SELECT max(idpago) AS ultimoidpago FROM pagos_oc";
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

			case 4:
				$monedacuenta = "usd";
				break;

			case 5:
				$monedacuenta = "usd";
				break;

			case 6:
				$monedacuenta = "mxn";
				break;
		}

		foreach ($facturas as &$factura) {
			$query2="SELECT moneda_pedido, costo_usd, costo_mn, cantidad FROM utilidad_pedido WHERE factura_proveedor = '$factura'";
			$res2 = mysqli_query($conexion_usuarios, $query2);
			$total = 0;
			while($data2 = mysqli_fetch_assoc($res2)){
				$monedapedido = $data['moneda_pedido'];

				if ($monedaproveedor == "usd") {
					$total = $total + (($data2['costo_usd'] * $data2['cantidad'])*1.16);
				}else{
					$total = $total + (($data2['costo_mn'] * $data2['cantidad'])*1.16);
				}
			}

			$query = "UPDATE utilidad_pedido SET pagada ='si', Tipo_pago='Factura', pago_factura='$total', fecha_pago='$fecha', cuenta='$cuenta', total_factura='$total' WHERE factura_proveedor='$factura'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al actualizar la información de la factura.";
			}else{
				$query = "INSERT INTO pagos_oc (proveedor, factura, monto, fecha, cuenta, tipo_cambio, idpago) VALUES ('$idproveedor', '$factura', '$total', '$fecha', '$cuenta', '$tipocambio', '$idpago')";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}
		}
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al registrar el pago de la factura.";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El pago se guardó correctamente.";
		}


		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
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
