<?php
	include('../../conexion.php');
	include('../../sesion.php');
	// error_reporting(0);

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'agregarcotizacion':
			$numeroCotizacion = $_POST['numeroCotizacion'];
			$fechaCotizacion = $_POST['fechaCotizacion'];
			$vendedor = $_POST['vendedor'];
			$cliente = $_POST['cliente'];
			$contactoCliente = $_POST['contactoCliente'];
			$moneda = $_POST['moneda'];
			$tiempoEntrega = $_POST['tiempoEntrega'];
			$condicionesPago = $_POST['condicionesPago'];
			$comentarios = $_POST['comentarios'];
			agregar_cotizacion($usuariologin, $dplogin, $numeroCotizacion, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $tiempoEntrega, $condicionesPago, $comentarios, $conexion_usuarios);
			break;

		case 'agregarcontacto':
			$idcliente = $_POST['idcliente'];
			$contacto = $_POST['contacto'];
			$puesto = $_POST['puesto'];
			$calle = $_POST['calle'];
			$colonia = $_POST['colonia'];
			$ciudad = $_POST['ciudad'];
			$estado = $_POST['estado'];
			$cp = $_POST['cp'];
			$pais = $_POST['pais'];
			$tlf = $_POST['tlf'];
			$movil = $_POST['movil'];
			$correoElectronico = $_POST['correoElectronico'];
			agregar_contacto($usuariologin, $dplogin, $idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios);
			break;

		case 'agregarClas':
			$idCliente = $_POST['id'];
			$clas = $_POST['clasificacion'];
			agregarClas($idCliente, $clas, $conexion_usuarios);
			break;

		case 'agregar':
			$idproducto= $_POST['idproducto'];
			$noExisteProducto = $_POST['noExisteProducto'];
			$valorClaseE = $_POST['valorClaseE'];
			$refCotizacion = $_POST['refCotizacion'];
			if(isset($_POST["marca"])){
				$marca = $_POST["marca"];
			}else{
				$marca = $_POST["marca2"];
			}
			if(isset($_POST["modificarPrecioLista"])){
				$modificar = "si";
			}else{
				$modificar = "no";
			}
			$modelo = $_POST["modelo"];
			$descripcion = $_POST["descripcion"];
			$precioUnitario = str_replace("$ ", "", $_POST["precioUnitario"]);
			$cantidad = $_POST["cantidad"];
			$claveSat = $_POST["claveSat"];
			$unidad = $_POST["unidad"];
			$tedias = $_POST["tedias"];
			$refInterna = $_POST["refInterna"];
			$cotizadoEn = $_POST["cotizadoEn"];
			agregar($idproducto, $modificar, $noExisteProducto, $valorClaseE, $modelo, $marca, $descripcion, $claveSat, $precioUnitario, $cantidad, $unidad, $tedias, $refInterna, $cotizadoEn, $refCotizacion, $conexion_usuarios);
			break;

		case 'editar':
			$refCotizacion = $_POST['refCotizacion'];
			$idherramienta = $_POST["idherramienta"];
			$descripcion = $_POST["descripcion"];
			$precioUnitario = str_replace("$ ", "", $_POST["precioUnitario"]);
			$cantidad = $_POST["cantidad"];
			$claveSat = $_POST["claveSat"];
			$tedias = $_POST["tedias"];
			$refInterna = $_POST["refInterna"];
			$cotizadoEn = $_POST["cotizadoEn"];
			$proveedorFlete = $_POST['proveedorFlete'];
			editar($refCotizacion, $descripcion, $precioUnitario, $cantidad, $claveSat, $tedias, $refInterna, $cotizadoEn, $proveedorFlete, $idherramienta, $conexion_usuarios);
			actualizarTotalFlete($refCotizacion, $conexion_usuarios);
			actualizarTotalCotizacion($refCotizacion, $conexion_usuarios);
			break;

		case 'eliminar':
			$idherramienta = $_POST["idherramienta"];
			$refCotizacion = $_POST['refCotizacion'];
			eliminar($refCotizacion, $idherramienta, $conexion_usuarios);
			break;

		case 'agregarFlete':
			$refCotizacion = $_POST['refCotizacion'];
			$proveedor = $_POST['proveedor'];
			$totalFlete = $_POST['totalFlete'];
			agregarFlete($refCotizacion, $proveedor, $totalFlete, $conexion_usuarios);
			break;

		case 'editarFlete':
			$idflete = $_POST['idflete'];
			$proveedor = $_POST['proveedor'];
			$costoFlete = $_POST['totalFlete'];
			$refCotizacion = $_POST['refCotizacion'];
			editarFlete($idflete, $proveedor, $costoFlete, $refCotizacion, $conexion_usuarios);
			actualizarTotalFlete($refCotizacion, $conexion_usuarios);
			actualizarTotalCotizacion($refCotizacion, $conexion_usuarios);
			break;

		case 'eliminarFlete':
			$idflete = $_POST['idflete'];
			eliminarFlete($idflete, $conexion_usuarios);
			break;

		case 'cambiarCondPago':
			$refCotizacion = $_POST['refCotizacion'];
			$condPago = $_POST['condPago'];
			cambiar_condiciones_pago($refCotizacion, $condPago, $conexion_usuarios);
			break;

		case 'cambiarTiempoEntrega':
			$refCotizacion = $_POST['refCotizacion'];
			$tiempoEntrega = $_POST['tiempoEntrega'];
			cambiar_tiempo_entrega($refCotizacion, $tiempoEntrega, $conexion_usuarios);
			break;

		case 'cambiarMoneda':
		 	$refCotizacion = $_POST['refCotizacion'];
			cambiar_moneda($refCotizacion, $conexion_usuarios);
			break;

		case 'cambiarClasificacion':
		 	$clasificacion = $_POST['clasificacion'];
			$idcliente = $_POST['idcliente'];
			cambiar_clasificacion($clasificacion, $idcliente, $conexion_usuarios);
			break;

		case 'cambiarPedido':
			$data = json_decode($_POST['herramienta']);
			$refCotizacion = $_POST['refCotizacion'];
			$numeroPedido = $_POST['numeroPedido'];
			$numeroPartidas = $_POST['numeroPartidas'];
			cambiarPedido($data, $refCotizacion, $numeroPedido, $numeroPartidas, $conexion_usuarios);
			break;

		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function agregar_cotizacion($usuariologin, $dplogin, $numeroCotizacion, $fechaCotizacion, $vendedor, $cliente, $contactoCliente, $moneda, $tiempoEntrega, $condicionesPago, $comentarios, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE nombreEmpresa LIKE '%$cliente%' LIMIT 1";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar el 'Id' de '".$nombreEmpresa."'!";
		}else{
			while($data = mysqli_fetch_array($resultado)){
				$idCliente = $data['id'];
			}
			$fecha = date("Y", strtotime($fechaCotizacion)).'-'.date("m", strtotime($fechaCotizacion)).'-'.date("d", strtotime($fechaCotizacion));
			$query = "INSERT INTO cotizacion (ref, cliente, contacto, vendedor, fecha, moneda, TiempoEntrega, CondPago, Otra) VALUES ('$numeroCotizacion', '$idCliente', '$contactoCliente', '$vendedor', '$fecha', '$moneda', '$tiempoEntrega', '$condicionesPago', '$comentarios')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al crear la cotización '".$numeroCotizacion."'!";
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["cotizacion"] = $numeroCotizacion;

				$descripcion = "Se creo la cotizacion ".$numeroCotizacion;
				$fechahora = date("Y-m-d G:i:s");
				$query = "INSERT INTO movimientosusuarios (cotizacion, departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$numeroCotizacion','$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}
		}
		$informacion["respuesta"] = "BIEN";
		$informacion["cotizacion"] = $numeroCotizacion;
		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function agregar_contacto($usuariologin, $dplogin, $idcliente, $contacto, $puesto, $calle, $colonia, $ciudad, $estado, $cp, $pais, $tlf, $movil, $correoElectronico, $conexion_usuarios){
		$query = "INSERT INTO contactospersonas (empresa,personaContacto,puesto,calle,colonia,ciudad,estado,cp,pais,tlf1,movil,correoElectronico) VALUES ('$idcliente', '$contacto', '$puesto', '$calle', '$colonia', '$ciudad', '$estado', '$cp', '$pais', '$tlf', '$movil', '$correoElectronico')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al registrar el contacto '".$contacto."'!";
		}else{
			$informacion["idcliente"] = $idcliente;
			$informacion["guardar"] = "contacto";
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se guardo el contacto '".$contacto."' correctamente!";

			$query = "SELECT nombreEmpresa FROM contactos WHERE id = '$idcliente'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			while ($data = mysqli_fetch_assoc($resultado)) {
				$cliente = $data['nombreEmpresa'];
			}

			$descripcion = "Se agrego el contacto ".$contacto." al cliente ".$cliente;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function agregarClas($idCliente, $clas, $conexion_usuarios){
		switch ($clas) {
			case 'clas1':
				$clas = 1.20;
				break;

			case 'clas2':
				$clas = 1.25;
				break;

			case 'clas3':
				$clas = 1.33;
				break;

			case 'clas4':
				$clas = 1.42;
				break;
		}

		$query = "UPDATE contactos SET clasificacion='$clas' WHERE id=$idCliente";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al asignar la clasificación al cliente!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La clasificación se asignó al cliente correctamente!";
		}

		echo json_encode($informacion);
		cerrar($conexion_usuarios);
	}

	function agregar($idproducto, $modificar, $noExisteProducto, $valorClaseE, $modelo, $marca, $descripcion, $claveSat, $precioUnitario, $cantidad, $unidad, $tedias, $refInterna, $cotizadoEn, $refCotizacion, $conexion_usuarios){
		$proveedorFlete = "Ninguno";
		$query = "SELECT * FROM cotizacion WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$cotizacionNo = $data['id'];
			$cliente = $data['cliente'];
			$moneda = $data['moneda'];
		}

		$query = "INSERT INTO cotizacionherramientas (cliente, cotizacionNo, modelo, marca, descripcion, ClaveProductoSAT, precioLista, cantidad, Unidad, Tiempo_Entrega, referencia_interna, lugar_cotizacion, cotizacionRef, moneda) VALUES ('$cliente', '$cotizacionNo', '$modelo', '$marca', '$descripcion', '$claveSat', '$precioUnitario', '$cantidad', '$unidad', '$tedias', '$refInterna', '$cotizadoEn', '$refCotizacion', '$moneda')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar los datos de la partida!";
			echo json_encode($informacion);
		}else{
			$query = "SELECT DISTINCT partidaCantidad FROM cotizacion WHERE ref='".$refCotizacion."'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if(!$resultado){
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al buscar número de partidas!";
				echo json_encode($informacion);
			}else{
				while($data = mysqli_fetch_array($resultado)){
					$numPartidas = $data['partidaCantidad'];
				}
				$numPartidas++;
				$query = "UPDATE cotizacion SET partidaCantidad='".$numPartidas."' WHERE ref='".$refCotizacion."'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al actualizar número de partidas!";
					echo json_encode($informacion);
				}else{
					$query = "SELECT precioLista,cantidad FROM cotizacionherramientas WHERE cotizacionRef = '".$refCotizacion."'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al buscar datos de partida!";
						echo json_encode($informacion);
					}else{
						$precioTotal = 0;
						while ($data = mysqli_fetch_array($resultado)) {

							$precioTotal = $precioTotal + ( $data['precioLista'] * $data['cantidad'] );
						}
						$query = "UPDATE cotizacion SET precioTotal ='".$precioTotal."' WHERE ref ='".$refCotizacion."'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al actualizar el precio total de la cotización!";
							echo json_encode($informacion);
						}else{
							if ($valorClaseE != "none") {
								$fecha = date("Y-m-d H:i:s");
								switch ($valorClaseE) {
									case 'nacional':
										$factorClaseE = 1.20;
										break;
									case 'americano':
										$factorClaseE = 1.40;
										break;
									case 'otro':
										$factorClaseE = 1.60;
										break;
								}
								if ($noExisteProducto == "noExisteProducto") {
									$enReserva = 0;
									$clase = "E";
									$moneda = "usd";
									$cantidadMinima = 1;
									$query = "INSERT INTO productos (marca, ref, descripcion, ClaveProductoSAT, precioBase, enReserva, clase, fecha, factor, moneda, CantidadMinima, Unidad) VALUES ('$marca', '$modelo', '$descripcion', '$claveSat', '$precioUnitario', '$enReserva', '$clase', '$fecha', '$factorClaseE', '$moneda', '$cantidadMinima', '$unidad')";
									$resultado = mysqli_query($conexion_usuarios, $query);
									if (!$resultado) {
										$informacion["respuesta"] = "ERROR";
										$informacion["informacion"] = "Ocurrió un problema al registrar el producto!";
										echo json_encode($informacion);
									}else{
										$informacion["respuesta"] = "BIEN";
										$informacion["informacion"] = "Los datos de la partida se guardaron correctamente y se registro el nuevo producto!";
										echo json_encode($informacion);
									}
								}else{
									$query = "UPDATE productos SET factor ='".$factorClaseE."' WHERE ref ='".$modelo."'";
									$resultado = mysqli_query($conexion_usuarios, $query);
									if (!$resultado) {
										$informacion["respuesta"] = "ERROR";
										$informacion["informacion"] = "Ocurrió un problema al actualizar el factor del modelo!";
										echo json_encode($informacion);
									}else{
										if($modificar == "si"){
											$query ="UPDATE productos SET marca='$marca', ref='$modelo', descripcion='$descripcion', precioBase='$precioUnitario', ClaveProductoSAT='$claveSat', Unidad='$unidad' WHERE IdProducto='$idproducto'";
											$resultado = mysqli_query($conexion_usuarios, $query);
											if(!$resultado){
												$informacion["respuesta"] = "ERROR";
												$informacion["informacion"] = "Ocurrió un problema al actualizar los datos del producto!";
												echo json_encode($informacion);
											}else{
												$informacion["respuesta"] = "BIEN";
												$informacion["informacion"] = "Los datos de la partida se guardaron correctamente y se actualizaron los datos del producto!";
												echo json_encode($informacion);
											}
										}else{
											$informacion["respuesta"] = "BIEN";
											$informacion["informacion"] = "Los datos de la partida se guardaron correctamente!";
											echo json_encode($informacion);
										}
									}
								}
							}else{
								if($modificar == "si"){
									$query ="UPDATE productos SET marca='$marca', ref='$modelo', descripcion='$descripcion', precioBase='$precioUnitario', ClaveProductoSAT='$claveSat', Unidad='$unidad' WHERE IdProducto='$idproducto'";
									$resultado = mysqli_query($conexion_usuarios, $query);
									if(!$resultado){
										$informacion["respuesta"] = "ERROR";
										$informacion["informacion"] = "Ocurrió un problema al actualizar los datos del producto!";
										echo json_encode($informacion);
									}else{
										$informacion["respuesta"] = "BIEN";
										$informacion["informacion"] = "Los datos de la partida se guardaron correctamente y se actualizaron los datos del producto!";
										echo json_encode($informacion);
									}
								}else{
									$informacion["respuesta"] = "BIEN";
									$informacion["informacion"] = "Los datos de la partida se guardaron correctamente!";
									echo json_encode($informacion);
								}
							}
						}
					}
				}
			}
		}
		$query = "SELECT TiempoEntrega FROM cotizacion WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			if($tedias > $data['TiempoEntrega']){
				$query2 = "UPDATE cotizacion SET TiempoEntrega = '$tedias' WHERE ref = '$refCotizacion'";
				$res2 = mysqli_query($conexion_usuarios, $query2);
			}
		}
		actualizarTiempoEntrega($refCotizacion, $conexion_usuarios);
		cerrar($conexion_usuarios);
	}

	function editar($refCotizacion, $descripcion, $precioUnitario, $cantidad, $claveSat, $tedias, $refInterna, $cotizadoEn, $proveedorFlete, $idherramienta, $conexion_usuarios){
		$query ="UPDATE cotizacionherramientas SET descripcion='$descripcion', precioLista='$precioUnitario', cantidad='$cantidad', ClaveProductoSAT='$claveSat', Tiempo_Entrega='$tedias', referencia_interna='$refInterna', lugar_cotizacion='$cotizadoEn', proveedorFlete ='$proveedorFlete' WHERE id=$idherramienta";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al actualizar la información de la partida!";
			echo json_encode($informacion);
		}else{
			if($proveedorFlete == "Ninguno" || $proveedorFlete == "ninguno"){
				$query = "UPDATE cotizacionherramientas SET flete = 0.0000 WHERE id='".$idherramienta."'";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}
		}
	}

	function actualizarTiempoEntrega($refCotizacion, $conexion_usuarios){
		$query = "SELECT TiempoEntrega FROM cotizacion WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			$tedias = $data['TiempoEntrega'];
		}

		$query = "SELECT Tiempo_Entrega FROM cotizacionherramientas WHERE cotizacionRef = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		while($data = mysqli_fetch_assoc($resultado)){
			if ($tedias < $data['Tiempo_Entrega']) {
				$tedias = $data['Tiempo_Entrega'];
			}
		}
		$query = "UPDATE cotizacion SET TiempoEntrega = '$tedias' WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
	}

	function actualizarTotalFlete($refCotizacion, $conexion_usuarios){
		$query = "SELECT proveedorFlete FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND proveedorFlete != 'Ninguno'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if(mysqli_num_rows($resultado) > 0){
			$query = "SELECT proveedor FROM fletescotizacion WHERE refCotizacion ='$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				verificar_resultado($resultado);
			}else{
				while($data2 = mysqli_fetch_array($resultado)){
					$proveedorFlete = $data2['proveedor'];
					$query = "SELECT costoFlete FROM fletescotizacion WHERE refCotizacion ='$refCotizacion' AND proveedor = '$proveedorFlete'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					while($data = mysqli_fetch_array($resultado)){
						$costoFlete = $data['costoFlete'];
					}
					$query = "SELECT precioLista, cantidad FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND proveedorFlete = '$proveedorFlete'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						verificar_resultado($resultado);
					}else{
						$costoTotal = 0;
						while($data = mysqli_fetch_array($resultado)){
							$precioLista = $data['precioLista'];
							$cantidad = $data['cantidad'];
							$costoTotal = $costoTotal + ($precioLista * $cantidad);
						}
						$costoFleteTotal = $costoFlete / $costoTotal;
						$info['costoFlete'] = $costoFlete;
						$info['costoTotal'] = $costoTotal;
						$info['costoFleteTotal'] = $costoFleteTotal;

						$query = "SELECT id, precioLista, cantidad, marca FROM cotizacionherramientas WHERE cotizacionRef='$refCotizacion' AND proveedorFlete = '$proveedorFlete'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							verificar_resultado($resultado);
						}else{
							$flete = 0;
							$costoTotal = 0;
							while($data = mysqli_fetch_array($resultado)){
								$id = $data['id'];
								$precioLista = $data['precioLista'];
								$cantidad = $data['cantidad'];
								$marca = $data['marca'];
								$flete = $flete + (($precioLista * $cantidad) * $costoFleteTotal);
								$flete = $flete / $cantidad;
								$fleteHerramienta = $flete;
								$info['flete'.$marca] = $fleteHerramienta;
								$precioListaTotal = $precioLista + $fleteHerramienta;
								$info['Total'.$marca] = $precioListaTotal;
								$query = "UPDATE cotizacionherramientas SET flete ='".$fleteHerramienta."' WHERE id='".$id."'";
								$resultado2 = mysqli_query($conexion_usuarios, $query);
								$flete = 0;
								$fleteHerramienta = 0;
								$precioListaTotal = 0;
							}
							if (!$resultado2) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al actualizar la información del flete!";
								echo json_encode($informacion);
							}else{
								// $informacion["respuesta"] = "BIEN";
								// $informacion["informacion"] = "Se actualizó la información correctamente!";
								// echo json_encode($informacion);
							}
						}
					}
				}
			}
		}
	}

	function actualizarTotalCotizacion($refCotizacion, $conexion_usuarios){
		$query = "SELECT precioLista, flete, cantidad FROM cotizacionherramientas WHERE cotizacionRef = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar los datos de las partidas!";
			echo json_encode($informacion);
		}else{
			$precioTotal = 0;
			while ($data = mysqli_fetch_array($resultado)) {
				$precioTotal = $precioTotal + ( ($data['precioLista'] + $data['flete']) * $data['cantidad'] );
			}
			$query = "UPDATE cotizacion SET precioTotal ='".$precioTotal."' WHERE ref ='".$refCotizacion."'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if(!$resultado){
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al actualizar los datos de la cotización!";
			}else{
				$informacion["respuesta"] = "BIEN";
				$informacion["informacion"] = "La información se actualizó correctamente!";
			}
			echo json_encode($informacion);
		}
		actualizarTiempoEntrega($refCotizacion, $conexion_usuarios);
	}

	function eliminar($refCotizacion, $idherramienta, $conexion_usuarios){
		$query = "DELETE FROM cotizacionherramientas WHERE id =$idherramienta";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar eliminar la partida!";
			echo json_encode($informacion);
		}else{
			$query = "SELECT DISTINCT partidaCantidad FROM cotizacion WHERE ref='".$refCotizacion."'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if(!$resultado){
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al buscar número de partidas!";
				echo json_encode($informacion);
			}else{
				while($data = mysqli_fetch_array($resultado)){
					$numPartidas = $data['partidaCantidad'];
				}
				$numPartidas--;
				$query = "UPDATE cotizacion SET partidaCantidad='".$numPartidas."' WHERE ref='".$refCotizacion."'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al actualizar número de partidas!";
					echo json_encode($informacion);
				}else{
					$query = "SELECT precioLista,cantidad FROM cotizacionherramientas WHERE cotizacionRef = '".$refCotizacion."'";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$informacion["respuesta"] = "ERROR";
						$informacion["informacion"] = "Ocurrió un problema al buscar datos de partida!";
						echo json_encode($informacion);
					}else{
						$precioTotal = 0;
						while ($data = mysqli_fetch_array($resultado)) {

							$precioTotal = $precioTotal + ( $data['precioLista'] * $data['cantidad'] );
						}
						$query = "UPDATE cotizacion SET precioTotal ='".$precioTotal."' WHERE ref ='".$refCotizacion."'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al actualizar precio total de la cotización!";
							echo json_encode($informacion);
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La partida se eliminó y se actualizó la información correctamente!";
							echo json_encode($informacion);
						}
					}
				}
			}
		}
		actualizarTiempoEntrega($refCotizacion, $conexion_usuarios);
		cerrar($conexion_usuarios);
	}

	function agregarFlete($refCotizacion, $proveedor, $totalFlete, $conexion_usuarios){
		$query = "INSERT INTO fletescotizacion (refCotizacion, proveedor, costoFlete) VALUES ('$refCotizacion', '$proveedor', '$totalFlete')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al agregar el flete!";
			echo json_encode($informacion);
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se agregó el flete correctamente!";
			echo json_encode($informacion);
		}
		cerrar($conexion_usuarios);
	}

	function eliminarFlete($idflete, $conexion_usuarios){
		$query = "SELECT * FROM fletescotizacion WHERE id = '$idflete'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar información del flete!";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$refCotizacion = $data['refCotizacion'];
				$proveedor = $data['proveedor'];
				$costoFlete = $data['costoFlete'];
			}
			$query = "DELETE FROM fletescotizacion WHERE id =$idflete";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al eliminar el flete!";
			}else{
				$query = "UPDATE cotizacionherramientas SET flete = 0.0000, proveedorFlete = 'Ninguno' WHERE cotizacionRef = '$refCotizacion' AND proveedorFlete='$proveedor'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de las partidas!";
				}else{
					actualizarTotalCotizacion($refCotizacion, $conexion_usuarios);
				}
			}
		}
	}

	function editarFlete($idflete, $proveedor, $costoFlete, $refCotizacion, $conexion_usuarios){
		$query ="UPDATE fletescotizacion SET proveedor='$proveedor', costoFlete='$costoFlete' WHERE id=$idflete";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información del flete!";
		}
	}

	function cambiar_condiciones_pago($refCotizacion, $condPago, $conexion_usuarios){
		$query = "UPDATE cotizacion SET CondPago = '$condPago' WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar las condiciones de pago!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Las condiciones de pago se modificaron correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_tiempo_entrega($refCotizacion, $tiempoEntrega, $conexion_usuarios){
		$query = "UPDATE cotizacion SET TiempoEntrega = '$tiempoEntrega' WHERE ref = '$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar modificar el tiempo de entrega!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El tiempo de entrega se modificó correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_moneda($refCotizacion, $conexion_usuarios){
		$fecha = date("Y-m-d");
		$query = "SELECT tipocambio FROM tipocambio WHERE fecha='$fecha'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al buscar el tipo de cambio del día!";
		}else{
			while($data = mysqli_fetch_assoc($resultado)){
				$tipocambio = $data['tipocambio'];
			}
			$query = "SELECT moneda FROM cotizacion WHERE ref = '$refCotizacion'";
			$resultado = mysqli_query($conexion_usuarios, $query);
			if (!$resultado) {
				$informacion["respuesta"] = "ERROR";
				$informacion["informacion"] = "Ocurrió un problema al buscar la moneda de la cotización!";
			}else{
				while($data = mysqli_fetch_assoc($resultado)){
					$moneda = $data['moneda'];
				}

				$total = 0;
				$query = "SELECT * FROM cotizacionherramientas WHERE cotizacionRef = '$refCotizacion'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$informacion["respuesta"] = "ERROR";
					$informacion["informacion"] = "Ocurrió un problema al buscar información de las partidas!";
				}else{
					if ($moneda == "mxn") {
						// Se hace el cambio a moneda USD
						while($data = mysqli_fetch_assoc($resultado)){
							$id = $data['id'];
							$precioLista = $data['precioLista'];
							$flete = $data['flete'];
							$precioLista = $precioLista / $tipocambio;
							$flete = $flete / $tipocambio;
							$total = $total + ($precioLista * $data['cantidad']);
							$queryCambio = "UPDATE cotizacionherramientas SET precioLista = '$precioLista', moneda = 'usd', flete = '$flete' WHERE id='$id'";
							$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							if (!$resultadoCambio) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información!";
								break;
							}
						}
						$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'usd' WHERE ref = '$refCotizacion'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

							$query = "SELECT * FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);

							while($data = mysqli_fetch_assoc($resultado)){
								$id = $data['id'];
								$costoFlete = $data['costoFlete'];
								$costoFlete = $costoFlete / $tipocambio;
								$queryCambio = "UPDATE fletescotizacion SET costoFlete = '$costoFlete' WHERE id = '$id'";
								$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							}
						}
					}else{
						// Se hace el cambio a moneda MXN
						while($data = mysqli_fetch_assoc($resultado)){
							$id = $data['id'];
							$precioLista = $data['precioLista'];
							$flete = $data['flete'];
							$precioLista = $precioLista * $tipocambio;
							$flete = $flete * $tipocambio;
							$total = $total + ($precioLista * $data['cantidad']);
							$queryCambio = "UPDATE cotizacionherramientas SET precioLista = '$precioLista', moneda = 'mxn', flete = '$flete' WHERE id='$id'";
							$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							if (!$resultadoCambio) {
								$informacion["respuesta"] = "ERROR";
								$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información!";
								break;
							}
						}
						$query = "UPDATE cotizacion SET precioTotal = '$total', moneda = 'mxn' WHERE ref = '$refCotizacion'";
						$resultado = mysqli_query($conexion_usuarios, $query);
						if (!$resultado) {
							$informacion["respuesta"] = "ERROR";
							$informacion["informacion"] = "Ocurrió un problema al intentar modificar la información de la cotización!";
						}else{
							$informacion["respuesta"] = "BIEN";
							$informacion["informacion"] = "La moneda se cambio y la información se modificó correctamente!";

							$query = "SELECT * FROM fletescotizacion WHERE refCotizacion = '$refCotizacion'";
							$resultado = mysqli_query($conexion_usuarios, $query);

							while($data = mysqli_fetch_assoc($resultado)){
								$id = $data['id'];
								$costoFlete = $data['costoFlete'];
								$costoFlete = $costoFlete * $tipocambio;
								$queryCambio = "UPDATE fletescotizacion SET costoFlete = '$costoFlete' WHERE id = '$id'";
								$resultadoCambio = mysqli_query($conexion_usuarios, $queryCambio);
							}
						}
					}
				}
			}
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiar_clasificacion($clasificacion, $idcliente, $conexion_usuarios){
		$query = "UPDATE contactos SET clasificacion = '$clasificacion' WHERE id = '$idcliente'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al intentar cambiar la clasificación del cliente!";
		}else{
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La clasificación del cliente se cambió correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function cambiarPedido($data, $refCotizacion, $numeroPedido, $numeroPartidas, $conexion_usuarios){
		$fecha = date("Y").'-'.date("m").'-'.date("d");
		$query = "SELECT * FROM cotizacion WHERE ref='$refCotizacion'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$respuesta['respuesta'] = "Error al buscar información de la cotización";
		}else{
			while($datos = mysqli_fetch_assoc($resultado)){
				$idcliente = $datos['cliente'];
				$contacto = $datos['contacto'];
				$vendedor = $datos['vendedor'];
				$moneda = $datos['moneda'];
			}

			$total = 0.000;
			foreach ($data as &$valor) {
				$id = $valor;
				$query = "SELECT precioLista,flete,cantidad FROM cotizacionherramientas WHERE id='$id'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				while($precio = mysqli_fetch_assoc($resultado)){
					$total = $total + (($precio['precioLista'] + $precio['flete']) * $precio['cantidad']);
				}
			}

			foreach ($data as &$valor) {
				$id = $valor;
				$pedido = "si";
				$query = "UPDATE cotizacionherramientas SET numeroPedido='$numeroPedido', fechaPedido='$fecha', pedidoFecha='$fecha', Pedido ='$pedido' WHERE cotizacionRef='$refCotizacion' AND id=$id";
				$resultado = mysqli_query($conexion_usuarios, $query);
			}

			if (!$resultado) {
				$respuesta['respuesta'] = "ERROR 2";
			}else{
				$query = "UPDATE cotizacion SET Pedido = '$fecha', NoPedClient = '$numeroPedido' WHERE ref='$refCotizacion'";
				$resultado = mysqli_query($conexion_usuarios, $query);
				if (!$resultado) {
					$respuesta['respuesta'] = "ERROR 3";
				}else{
					$entregado = "0000-00-00";
					$query = "INSERT INTO pedidos (cotizacionRef, numeroPedido, cliente, contacto, vendedor, fecha, partidas, total, entregado, moneda) VALUES ('$refCotizacion', '$numeroPedido', '$idcliente', '$contacto', '$vendedor', '$fecha', '$numeroPartidas', '$total', '$entregado', '$moneda')";
					$resultado = mysqli_query($conexion_usuarios, $query);
					if (!$resultado) {
						$respuesta['respuesta'] = "ERROR 4";
					}else{
						$respuesta['respuesta'] = "OK";
					}
				}
			}
		}
		echo json_encode($respuesta);
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
