<?php
	include('../../conexion.php');
	include('../../sesion.php');

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
			agregar_pedimento($fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios, $idusuario);
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
			editar_pedimento($idpedimento, $fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios, $idusuario);
			break;

	}

	function agregar_pedimento($fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios, $idusuario){
		$query = "INSERT INTO pedimentos (fecha, aduana, numero_pedimento, valor_aduana, cnt, dta, prv, igi, iva) VALUES ('$fechaPedimento', '$aduana', '$numeroPedimento', '$valorAduana', '$cnt', '$dta', '$prv', '$igi', '$iva')";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al guardar la información del pedimento '".$numeroPedimento."'!";
		}else{
			$descripcionmovimiento = "Se registro el numero de pedimento ".$numeroPedimento;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'R', 'logistica', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se guardó la información del pedimento '".$numeroPedimento."' correctamente!";
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar_pedimento($idpedimento, $fechaPedimento, $numeroPedimento, $aduana, $valorAduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios, $idusuario){
		$query = "UPDATE pedimentos SET fecha = '$fechaPedimento', aduana = '$aduana', numero_pedimento = '$numeroPedimento', valor_aduana = '$valorAduana', cnt = '$cnt', dta = '$dta', prv = '$prv', igi = '$igi', iva = '$iva' WHERE id = '$idpedimento'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un problema al modificar la información del pedimento '".$numeroPedimento."'!";
		}else{
			$descripcionmovimiento = "Se modifico el numero de pedimento ".$numeroPedimento;
			$fechamovimiento = date("Y-m-d H:i:s");
			$querymovimiento = "INSERT INTO movimientosusuarios (idusuario, tipomovimiento, documento, descripcion, fechahora) VALUES ('$idusuario', 'M', 'logistica', '$descripcionmovimiento', '$fechamovimiento')";
			$resultadomovimiento = mysqli_query($conexion_usuarios, $querymovimiento);

			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se modificó la información del pedimento '".$numeroPedimento."' correctamente!";
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
