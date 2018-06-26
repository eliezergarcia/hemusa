<?php

	include("../../conexion.php");

	$palabraBusca = $_POST['palabraBusca'];
	$marcaBuscar = $_POST['marcaBuscar'];

		if ($marcaBuscar == 'todo') {
			$queryPrecios = "SELECT * FROM productos WHERE (productos.marca LIKE '%$palabraBusca%' OR productos.ref LIKE  '%$palabraBusca%' OR productos.descripcion LIKE  '%$palabraBusca%')";
		}else{
			$queryPrecios = "SELECT * FROM productos WHERE marca = '$marcaBuscar' AND (productos.marca LIKE '%$palabraBusca%' OR productos.ref LIKE  '%$palabraBusca%' OR productos.descripcion LIKE  '%$palabraBusca%')";
		}


		$resPrecios = mysqli_query($conexion_usuarios, $queryPrecios);

		if(!$resPrecios){
			die('Error');
		}else{

			while($data = mysqli_fetch_assoc($resPrecios)){
				$marca = $data['marca'];
				$modelo = $data['ref'];

				$querymarca = "SELECT * FROM marcadeherramientas WHERE marca = '$marca'";
				$resultadomarca = mysqli_query($conexion_usuarios, $querymarca);

				while($datamarca = mysqli_fetch_assoc($resultadomarca)){
					$factor = $datamarca['factor'];
					$excepcion = $datamarca['excepcion'];
					$descuento = $datamarca['descuento'];
				}

				if ($data['igi'] == 0) {
					$queryigi = "SELECT * FROM modelos_igi WHERE marca = '$marca' AND modelo = '$modelo'";
					$resultadoigi = mysqli_query($conexion_usuarios, $queryigi);

					if (mysqli_num_rows($resultadoigi) > 0) {
						while($dataigi = mysqli_fetch_assoc($resultadoigi)){
							$igi = $dataigi['igi'];
						}
					}else{
						$igi = 0;
					}

				}else{
					$igi = $data['igi'];
				}

				if ($excepcion == 1) {
					$costo = ($data['precioBase'] * $factor);
					$precioLista = $data['precioBase'] + ($data['precioBase'] * $descuento) + ($data['precioBase'] * $igi);
					$precioIVA = $precioLista * 1.16;
				}else{
					$costo = ($data['precioBase'] * $factor);
					$precioLista = ($data['precioBase'] * $factor)  + ($data['precioBase'] * $descuento) + ($data['precioBase'] * $igi);
					$precioIVA = $precioLista * 1.16;
				}

				$arreglo["data"][] = array(
					'idproducto' => $data['IdProducto'],
					'marca' => utf8_encode($data['marca']),
					'modelo' => utf8_encode($data['ref']),
					'descripcion' => utf8_encode($data['descripcion']),
					'costo' => round($costo,2),
					'precioLista' => "$ ".round($precioLista, 2),
					'precioIVA' => "$ ".round($precioIVA, 2),
					'almacen' => $data['enReserva'],
					'moneda' => $data['moneda'],
					'clase' => $data['clase'],
					'igi' => $igi
				);

			}
			echo json_encode($arreglo);
		}
		mysqli_free_result($resPrecios);
		mysqli_close($conexion_usuarios);

 ?>
