<?php 
	
	include("../../conexion.php");

	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];

	$queryCobranza = "SELECT * FROM payments WHERE date >= '".$fechaInicio."' AND date <= '".$fechaFin."' order by account, date, factura";

	$resCobranza = mysqli_query($conexion_usuarios, $queryCobranza);

	$tablaCobranza = "";

	if(!$resCobranza){
		die('Error');
	}else{
		while($data = mysqli_fetch_assoc($resCobranza)){
			$id=$data['id'];	
			$fecha=$data['date'];	
			$cliente=$data['client'];	
			$factura=$data['factura'];
			$cuenta=$data['account'];		
			$monto_total=$data['amount'];	
			$cambio=$data['exchangeRate'];	
			$moneda=$data['currency'];

			$sql_nombre ="SELECT nombre FROM  `accounts` WHERE  `id` = '".$cuenta."'";
			$resultado_nombre=mysqli_query($conexion_usuarios, $sql_nombre);

			while($row_nombre =mysqli_fetch_array($resultado_nombre)){
				$nombre_cuenta=$row_nombre['nombre'];	
				// se almacena en la variable nombre  el resultado de la consulta
			}	

			$sql_cliente = "SELECT nombreEmpresa FROM contactos WHERE id = '".$cliente."'";
			$resultado_cliente = mysqli_query($conexion_usuarios, $sql_cliente);
			
			while($row_cliente = mysqli_fetch_array($resultado_cliente)){
				$nombre_cliente = $row_cliente['nombreEmpresa'];
			}

			if($moneda =='mxn'){
				$tipo_cambio=1.00;
			}else{
				$sql_buscar_tipo_cambio="SELECT * from cambio_oficial WHERE fecha='".$fecha."'";
				$result_tipo_cambio = mysqli_query($conexion_usuarios, $sql_buscar_tipo_cambio);

				if(mysqli_num_rows($result_tipo_cambio)<1){ 
				 	$i=-1;
					while(mysqli_num_rows($result_tipo_cambio)<1){
						$dias_atras=$i.'day'; 
						$fecha_dia_anterior= strtotime ( $dias_atras , strtotime ( $fecha ) ) ;
						$fecha_dia_anterior=date ( 'Y-m-j' , $fecha_dia_anterior);
						$sql_buscar_tipo_cambio="SELECT * from cambio_oficial WHERE fecha='".$fecha_dia_anterior."'";
						$result_tipo_cambio = mysqli_query($conexion_usuarios, $sql_buscar_tipo_cambio);
						$row_cambio = mysqli_fetch_array($result_tipo_cambio);
						$tipo_cambio=$row_cambio["tipo_cambio"];
						$i--;
					}
				}else{
					while($row_cambio = mysqli_fetch_array($result_tipo_cambio)){
						$tipo_cambio=$row_cambio["tipo_cambio"];
					}
			}

			$query_iva ="SELECT IVA FROM  cifrasimportantes WHERE  `id` = 1";
			$res_iva=mysqli_query($conexion_usuarios, $query_iva);

			while($row_iva =mysqli_fetch_array($res_iva)){
				$iva=$row_iva['IVA'];	
			}
						
			$cantidad_sin_iva= ($monto_total/(1+$iva));
			$impuesto=($cantidad_sin_iva*$iva);

			$tablaCobranza.='{
				  "banco":"'.$nombre_cuenta.'",
				  "fecha":"'.$fecha.'",
				  "factura":"'.$factura.'",
				  "cliente":"'.$nombre_cliente.'",
				  "moneda":"'.$moneda.'",
				  "tipoCambio":"$ '.$tipo_cambio.'",
				  "importe":"$ '.round($cantidad_sin_iva,2).'",
				  "iva":"$ '.round($impuesto,2).'",
				  "total":"$ '.round($monto_total,2).'",
				';

			$cantidad_sin_iva=$cantidad_sin_iva*$tipo_cambio;
			$impuesto=$impuesto*$tipo_cambio;
			$monto_total=$monto_total*$tipo_cambio;

			$tablaCobranza.='
				  "importeMXN":"$ '.round($cantidad_sin_iva,2).'",
				  "ivaMXN":"$ '.round($impuesto,2).'",
				  "totalMXN":"$ '.round($monto_total,2).'"

				},';
		}
	}
	}

	$tablaCobranza = substr($tablaCobranza,0, strlen($tablaCobranza) - 1);
	echo utf8_encode('{"data":['.$tablaCobranza.']}');
	mysqli_free_result($resCobranza);
	mysqli_close($conexion_usuarios);

?>