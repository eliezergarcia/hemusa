<?php
	include("../../conexion.php");
	include("../../sesion.php");

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'agregarproveedor':
			$nombreEmpresa = $_POST['nombreEmpresa'];
			$rfc = $_POST['rfc'];
			$moneda = $_POST['moneda'];
			$calle = $_POST['calle'];
			$numExterior = $_POST['numExterior'];
			$numInterior = $_POST['numInterior'];
			$colonia = $_POST['colonia'];
			$cp = $_POST['cp'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$pais = $_POST['pais'];
			$tlf1 = $_POST['tlf1'];
			$tlf2 = $_POST['tlf2'];
			$paginaWeb = $_POST['paginaWeb'];
			$correoElectronico = $_POST['correoElectronico'];

			$existe = existe_proveedor($rfc, $conexion_usuarios);
			if($existe > 0 ){
				$informacion["respuesta"] = "EXISTE";
				echo json_encode($informacion);
			}else{
				agregar_proveedor($nombreEmpresa, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios);
			}

			break;

		case 'eliminarproveedor':
			$idproveedor = $_POST['idproveedor'];
			eliminarproveedor($idproveedor, $conexion_usuarios);
			break;

		case 'quitarproveedor':
			$id = $_POST['id'];
			quitarproveedor($id, $conexion_usuarios);
			break;

		case 'crearordencompra':
			$idproveedor = $_POST['idproveedor'];
			$saludo = $_POST['saludo'];
			if (isset($_POST['otra'])) {
				$iddireccionenvio = $_POST['otra'];
			}else{
				$iddireccionenvio = $_POST['direccionenvio'];
			}
			crearordencompra($idproveedor, $saludo, $iddireccionenvio, $idusuario, $conexion_usuarios);
			break;

		case 'editarinformacion':
			$idcontacto = $_POST['idproveedor'];
			$empresa = $_POST['empresa'];
			$rfc = $_POST['rfc'];
			$contacto = $_POST['contacto'];
			$calle = $_POST['calle'];
			$noexterior = $_POST['noexterior'];
			$nointerior = $_POST['nointerior'];
			$colonia = $_POST['colonia'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$cp = $_POST['cp'];
			$pais = $_POST['pais'];
			$tlf1 = $_POST['tlf1'];
			$tlf2 = $_POST['tlf2'];
			$movil = $_POST['movil'];
			$correofac1 = $_POST['correofac1'];
			$correofac2 = $_POST['correofac2'];
			$correo = $_POST['correo'];
			$paginaweb = $_POST['paginaweb'];
			$credito = $_POST['credito'];
			$contactohemusa = $_POST['contactohemusa'];
			$moneda = $_POST['moneda'];
			$formapago = $_POST['formapago'];
			$metodopago = $_POST['metodopago'];
			$cfdi = $_POST['cfdi'];
			editar_informacion($idcontacto, $empresa, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $formapago, $metodopago, $cfdi, $conexion_usuarios);
			break;

			default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;

		case 'herramientaenviado':
			$data = json_decode($_POST['herramienta']);
			herramienta_enviado($data, $conexion_usuarios);
			break;

		case 'herramientarecibido':
			$data = json_decode($_POST['herramienta']);
			herramienta_recibido($data, $conexion_usuarios);
			break;
	}

	function herramienta_enviado($data,$conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;
			$query = "UPDATE cotizacionherramientas SET enviadoFecha = '$fecha' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_enviado = '$fecha' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		verificar_resultado($resultado);
	}

	function herramienta_recibido($data,$conexion_usuarios){
		$fecha = date("Y-m-d");
		foreach ($data as &$valor) {
			$id = $valor;
			$query = "UPDATE cotizacionherramientas SET recibidoFecha = '$fecha' WHERE id = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);

			$query = "UPDATE utilidad_pedido SET fecha_llegada = '$fecha' WHERE id_cotizacion_herramientas = '$id'";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		verificar_resultado($resultado);
	}


	function existe_proveedor($rfc, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE RFC = '$rfc'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existeproveedor = mysqli_num_rows( $resultado );
		return $existeproveedor;
	}

	function agregar_proveedor($nombreEmpresa, $rfc, $moneda, $calle, $numExterior, $numInterior, $colonia, $cp, $ciudad, $estado, $pais, $tlf1, $tlf2, $paginaWeb, $correoElectronico, $conexion_usuarios){
		$query = "INSERT INTO contactos (nombreEmpresa, calle, NumInt, NumExt, ciudad, estado, cp, pais, tlf1, tlf2, correoElectronico, paginaWeb, RFC, colonia, tipo, moneda) VALUES ('$nombreEmpresa', '$calle', '$numInterior', '$numExterior', '$ciudad', '$estado', '$cp', '$pais', '$tlf1', '$tlf2', '$correoElectronico', '$paginaWeb', '$rfc', '$colonia', 'Proveedor', '$moneda')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
		mysqli_close($conexion_usuarios);
	}

	function eliminarproveedor($idproveedor, $conexion_usuarios){
		$query = "DELETE FROM contactos WHERE id = $idproveedor";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);

	}

	function quitarproveedor($id, $conexion_usuarios){
		$query = "UPDATE cotizacionherramientas SET Proveedor = 'None' WHERE id='$id'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
		mysqli_close($conexion_usuarios);
	}

	function crearordencompra($idproveedor, $saludo, $iddireccionenvio, $idusario, $conexion_usuarios){
		$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idproveedor'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$proveedor = strtoupper($data['nombreEmpresa']);
		}

	   	$query = "SELECT noDePedido FROM ordendecompras ORDER BY id DESC LIMIT 1";
     	$resultado = mysqli_query($conexion_usuarios, $query);

     	while($data = mysqli_fetch_array($resultado)){
     		$ultimaOC = $data['noDePedido'];
     	}

     	$ultimaOC = str_replace("OC", "", $ultimaOC);
     	$ultimaOC = $ultimaOC + 1;
     	$numeroOC = "OC".$ultimaOC;

     	$query = "UPDATE cotizacionherramientas SET ordenCompra = '$numeroOC', noDePedido = '$numeroOC' WHERE Pedido= 'si' AND ordenCompra = '' AND noDePedido = '' AND Proveedor LIKE '%$proveedor%'";
     	$resultado = mysqli_query($conexion_usuarios, $query);
     	if(!$resultado){
     		verificar_resultado($resultado);
     	}else{
     		$query = "SELECT address FROM envia_a WHERE id = '$iddireccionenvio'";
     		$resultado = mysqli_query($conexion_usuarios, $query);

     		if (!$resultado) {
     			verificar_resultado($resultado);
     		}else{
	     		while($data = mysqli_fetch_array($resultado)){
	     			$direccionenvio = $data['address'];
	     		}
	     		$fecha = date("Y").'-'.date("m").'-'.date("d");
	     		$query = "INSERT INTO ordendecompras (nodePedido, fecha, proveedor, contacto, texto, envia_a) VALUES ('$numeroOC', '$fecha', '$idproveedor', '$idusario', '$saludo', '$direccionenvio')";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if(!$resultado){
					verificar_resultado($resultado);
				}else{
					$query = "SELECT * FROM cotizacionherramientas WHERE noDePedido = '$numeroOC'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					while($data = mysqli_fetch_assoc($resultado)){
						$id = $data['id'];
						$ordencompra = $data['noDePedido'];
						$moneda = $data['moneda'];
						$cliente = $data['cliente'];
						$marca = $data['marca'];
						$modelo = $data['modelo'];
						$cantidad = $data['cantidad'];
						$descripcion = $data['descripcion'];
						$precioventa = $data['precioLista'];

						$query2 = "SELECT * FROM ordendecompras WHERE noDePedido = '$numeroOC'";
						$resultado2 = mysqli_query($conexion_usuarios, $query2);
						while($data2 = mysqli_fetch_assoc($resultado2)){
							$fechaordencompra = $data2['fecha'];
							$proveedor = $data2['proveedor'];
						}

						$query3 = "SELECT * FROM tipocambio WHERE fecha = '$fechaordencompra'";
						$resultado3 = mysqli_query($conexion_usuarios, $query3);
						while($data3 = mysqli_fetch_assoc($resultado3)){
							$tipocambio = $data3['tipocambio'];
						}

						$queryprecio = "SELECT precioBase, enReserva, marca, moneda FROM productos WHERE marca = '$marca' AND ref = '$modelo'";
						$resultadoprecio = mysqli_query($conexion_usuarios, $queryprecio);

						if(mysqli_num_rows($resultadoprecio) > 0){
							while($dataprecio = mysqli_fetch_assoc($resultadoprecio)){
								$precioLista = $dataprecio['precioBase'];
								$almacen = $dataprecio['enReserva'];
								$marca = $dataprecio['marca'];
								$monedaproducto = $dataprecio['moneda'];
							}
						}else{
							$precioLista = $data['precioLista'];
							$almacen = 0;
							$marca = $data['marca'];
							$monedaproducto = $data['moneda'];
						}

						$query4 = "SELECT * FROM factores_proveedores WHERE proveedor ='$idproveedor'";
						$resultado4 = mysqli_query($conexion_usuarios, $query4);
						if(!$resultado4){
							die("ERROR EN FACTORES");
							$precioProveedor = $precioLista;
						}else{
							$precioProveedor = $precioLista;
							while($datafactor = mysqli_fetch_assoc($resultado4)){
								$precioProveedor = $precioProveedor * $datafactor['factor_proveedor'];
							}
						}

						if($monedaproducto == "mxn"){
							$costo_mn = $precioProveedor;
							$venta_mn = $precioventa;
							$costo_usd = $precioProveedor / $tipocambio;
							$venta_usd = $precioventa / $tipocambio;
						}else{
							$costo_mn = $precioProveedor * $tipocambio;
							$venta_mn = $precioventa * $tipocambio;
							$costo_usd = $precioProveedor;
							$venta_usd = $precioventa;
						}

						$query5 = "SELECT nombreEmpresa FROM contactos WHERE id ='$cliente'";
						$resultado5 = mysqli_query($conexion_usuarios, $query5);
						while($data5 = mysqli_fetch_assoc($resultado5)){
							$nombrecliente = $data5['nombreEmpresa'];
						}

						$query6 = "SELECT nombreEmpresa FROM contactos WHERE id ='$proveedor'";
						$resultado6 = mysqli_query($conexion_usuarios, $query6);
						while($data6 = mysqli_fetch_assoc($resultado6)){
							$nombreproveedor = $data6['nombreEmpresa'];
						}

						$query7 = "INSERT INTO utilidad_pedido (id_cotizacion_herramientas, orden_compra, fecha_orden_compra, proveedor, moneda_pedido, cliente, marca, modelo, cantidad, descripcion, tipo_cambio, costo_mn, costo_usd, venta_mn, venta_usd, nombre_cliente, nombre_proveedor) VALUES ('$id', '$ordencompra', '$fechaordencompra', '$proveedor', '$moneda', '$cliente', '$marca', '$modelo', '$cantidad', '$descripcion', '$tipocambio', '$costo_mn', '$costo_usd', '$venta_mn', '$venta_usd', '$nombrecliente', '$nombreproveedor')";
						$resultado7 = mysqli_query($conexion_usuarios, $query7);
					}
				}
     		}
		 }

		$informacion['respuesta'] = "agregarordencompra";
		$informacion['ordencompra'] = $numeroOC;
		$informacion['nombreEmpresa'] = $proveedor;
     	echo json_encode($informacion);
     	mysqli_close($conexion_usuarios);
	}

	function editar_informacion($idcontacto, $empresa, $rfc, $contacto, $calle, $noexterior, $nointerior, $colonia, $ciudad, $estado, $cp, $pais, $tlf1, $tlf2, $movil, $correofac1, $correofac2, $correo, $paginaweb, $credito, $contactohemusa, $moneda, $formapago, $metodopago, $cfdi, $conexion_usuarios){
		$query = "UPDATE contactos SET nombreEmpresa = '$empresa', RFC = '$rfc', personaContacto = '$contacto', calle = '$calle', NumExt ='$nointerior', NumInt = '$nointerior', colonia = '$colonia', ciudad = '$ciudad', estado = '$estado', cp ='$cp', pais = '$pais', tlf1 ='$tlf1', tlf2 = '$tlf2', movil = '$movil', correoFacturacion1 = '$correofac1', correoFacturacion2 = '$correofac2', correoElectronico ='$correo',  paginaWeb = '$paginaweb', CondPago = '$credito', responsable = '$contactohemusa', moneda = '$moneda', IdFormaPago = '$formapago', IdMetodoPago = '$metodopago', IdUsoCFDI = '$cfdi' WHERE id = '$idcontacto'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
	}

	function verificar_resultado($resultado){
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
		}else{
			$informacion["respuesta"] = "BIEN";
		}
		echo json_encode($informacion);
	}


 ?>
