<?php 
	include('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {		
		case 'agregarpedimento':
			$fechaPedimento = $_POST['fechaPedimento'];
			$numeroPedimento = $_POST['numeroPedimento'];
			$aduana = $_POST['aduana'];
			$valorAduana = $_POST['valorAduana'];
			$cnt = $_POST['cnt'];
			$dta = $_POST['dta'];
			$prv = $_POST['prv'];
			$igi = $_POST['igi'];
			$iva = $_POST['iva'];
			agregar_pedimento($fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios);
			break;

		case 'editarpedimento':
			$idpedimento = $_POST['idpedimento'];
			$fechaPedimento = $_POST['fechaPedimento'];
			$numeroPedimento = $_POST['numeroPedimento'];
			$aduana = $_POST['aduana'];
			$valorAduana = $_POST['valorAduana'];
			$cnt = $_POST['cnt'];
			$dta = $_POST['dta'];
			$prv = $_POST['prv'];
			$igi = $_POST['igi'];
			$iva = $_POST['iva'];
			editar_pedimento($idpedimento, $fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios);
			break;
		
	}

	function agregar_pedimento($fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios){
		$query = "INSERT INTO pedimentos (fecha, aduana, numero_pedimento, valor_aduana, cnt, dta, prv, igi, iva) VALUES ('$fechaPedimento', '$aduan', '$numeroPedimento', '$valorAduana', '$cnt', '$dta', '$prv', '$igi', '$iva')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		verificar_resultado($resultado);
	}

	function editar_pedimento($idpedimento, $fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios){
		$query = "UPDATE pedimentos SET fecha = '$fechaPedimento', aduana = '$aduana', numero_pedimento = '$numeroPedimento', valor_aduana = '$valorAduana', cnt = '$cnt', dta = '$dta', prv = '$prv', igi = '$igi', iva = '$iva' WHERE id = '$idpedimento'";
		$resultado = mysqli_query($conexion_usuarios, $query);
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