<?php 
	include('../../conexion.php');	
	
		$query = "SELECT * FROM facturas";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			die("Error!");
		}else{
			while($data = mysqli_fetch_assoc($resultado)){

				$cliente = $data['cliente'];

				$querycliente = "SELECT * FROM contactos WHERE nombreEmpresa ='$cliente'";
				$resultadocliente = mysqli_query($conexion_usuarios, $querycliente);
				while($datacliente = mysqli_fetch_assoc($resultadocliente)){
					$rfc = $datacliente['RFC'];
				}


				$arreglo["data"][] = array(
					'folio' => $data['folio'],
					'ordenpedido' => $data['ordenpedido'],
					'total' => "$ ".$data['total'],
					'pagado' => "$ ".$data['pagado'],
					'status' => $data['status'],
					'fecha' => $data['fecha'],
					'cliente' => $data['cliente'],
					'rfc' => $rfc
				);
			}
		}

		echo json_encode($arreglo);
		mysqli_close($conexion_usuarios);

?>