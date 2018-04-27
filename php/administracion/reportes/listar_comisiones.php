<?php 
	
	include("../../conexion.php");

	$idvendedor = $_POST['idvendedor'];
	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];

	$queryComisiones = "SELECT * FROM payments WHERE date >='".$fechaInicio."' AND date <='".$fechaFin."'";

	$resComisiones = mysqli_query($conexion_usuarios, $queryComisiones);

	$tablaComisiones = "";

	if(!$resComisiones){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resComisiones)){
			$suma_sin_iva=0;
			$suma_impuesto=0;
			$suma_monto_total=0;
			$monto_total=$data['amount'];

			$sql_clientes="SELECT * FROM clientes_de_vendedor WHERE id_cliente='".$data['client']."' AND id_vendedor = '".$idvendedor."'";;
			$res_clientes=mysqli_query($conexion_usuarios, $sql_clientes);
			while($row_clientes = mysqli_fetch_array($res_clientes)){


			// nombre_cuenta
				$sql_nombre ="SELECT nombre FROM accounts WHERE  id = '".$data['account']."'";
				$resultado_nombre=mysqli_query($conexion_usuarios, $sql_nombre);

				while($row_nombre =mysqli_fetch_array($resultado_nombre)){
					$nombre_cuenta=$row_nombre['nombre'];	
				}

			// nombre_cliente
				$sql_cliente = "SELECT nombreEmpresa FROM contactos WHERE id = '".$data['client']."'";
				$resultado_cliente = mysqli_query($conexion_usuarios, $sql_cliente);
				while($dataCliente = mysqli_fetch_array($resultado_cliente)){
					$nombre_cliente = $dataCliente['nombreEmpresa'];
				}

			// tipo_cambio
				if($data['currency'] =='mxn'){
					$tipo_cambio = 1.00;
				}else{
					$sql_buscar_tipo_cambio="SELECT * from cambio_oficial WHERE fecha= '".$data['date']."'";
					$result_tipo_cambio = mysqli_query($conexion_usuarios, $sql_buscar_tipo_cambio);

					// si no existe el tipo de cambio en la fecha que se genero la orden de compra
					//buscar el tipo de cambio de un dia anterior
					if(mysqli_num_rows($result_tipo_cambio)<1){ // si el numero de registros es 0
						$i=-1;
						while(mysqli_num_rows($result_tipo_cambio)<1){
							$dias_atras=$i.'day';  // Variable para restar un dia a la fecha
							$fecha_dia_anterior=  strtotime ( $dias_atras , strtotime ( $fecha ) ) ;
							$fecha_dia_anterior=date ( 'Y-m-j' , $fecha_dia_anterior);
							$sql_buscar_tipo_cambio="SELECT * from cambio_oficial WHERE fecha='".$fecha_dia_anterior."'";
							$result_tipo_cambio = mysqli_query($conexion_usuarios, $sql_buscar_tipo_cambio);
							$row_cambio = mysqli_fetch_array($result_tipo_cambio);
							$tipo_cambio=$row_cambio["tipo_cambio"]; // almacena el tipo de cambio con la fecha de un dia anterior
							$i--;
						}
					}else{
						while($row_cambio = mysqli_fetch_array($result_tipo_cambio)){
							$tipo_cambio=$row_cambio["tipo_cambio"];
							// almacena el tipo de cambio correspondiente a la fecha 
						}
					}
				}
			
			// iva
				$query_iva ="SELECT IVA FROM  cifrasimportantes WHERE  `id` = 1";
				$res_iva=mysqli_query($conexion_usuarios, $query_iva);

				while($row_iva =mysqli_fetch_array($res_iva)){
					$iva=$row_iva['IVA'];	
					// se almacena en la variable nombre  el resultado de la consulta
				}

				$cantidad_sin_iva= ($monto_total/(1+$iva));
				$impuesto=($cantidad_sin_iva*$iva);

			if($data['currency']=='usd'){
				$cantidad_sin_iva=$cantidad_sin_iva*$tipo_cambio;
				$impuesto=$impuesto*$tipo_cambio;
				$monto_total=$monto_total*$tipo_cambio;
			} 

			$tablaComisiones.='{
				  "banco":"'.$nombre_cuenta.'",
				  "fecha":"'.$data['date'].'",
				  "factura":"'.$data['factura'].'",
				  "cliente":"'.$nombre_cliente.'",
				  "moneda":"'.$data['currency'].'",
				  "tipoCambio":"$ '.$tipo_cambio.'",
				  "importe":"$ '.round($cantidad_sin_iva,2).'",
				  "iva":"$ '.round($impuesto,2).'",
				  "total":"$ '.round($monto_total,2).'"

				},';
		}

		}
	}

	$tablaComisiones = substr($tablaComisiones,0, strlen($tablaComisiones) - 1);
	echo utf8_encode('{"data":['.$tablaComisiones.']}');
	mysqli_free_result($resComisiones);
	mysqli_close($conexion_usuarios);

 ?>