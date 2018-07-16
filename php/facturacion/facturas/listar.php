<?php
	include('../../conexion.php');
	$buscar = $_POST['buscar'];
	$filtromes = $_POST['filtromes'];
	$filtroano = $_POST['filtroano'];
	if ($filtromes != "todo") {
		$fechainicio = $filtroano.'-'.$filtromes.'-01';
		$fechafin = $filtroano.'-'.$filtromes.'-31';
	}else{
		$fechainicio = $filtroano.'-01-01';
		$fechafin = $filtroano.'-12-31';
	}

	$query = "SELECT * FROM facturas WHERE (folio LIKE '%$buscar%' OR ordenpedido LIKE '%$buscar%' OR total LIKE '%$buscar%' OR pagado LIKE '%$buscar%' OR status LIKE '%$buscar%' OR fecha LIKE '%$buscar%' OR cliente LIKE '%$buscar%') AND fecha >= '$fechainicio' AND fecha <= '$fechafin' ORDER BY id DESC";
	$resultado = mysqli_query($conexion_usuarios, $query);

	if (mysqli_num_rows($resultado) < 1) {
		$arreglo['data'] = 0;
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
