<?php 
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "hemusapruebas";

	$conexion_usuarios = mysqli_connect($server, $user, $password, $db);
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
	
	$idpedimento = $_REQUEST["idpedimento"];
	$fecha = $_POST["fecha"];
	$numero_pedimento = $_POST["numero_pedimento"];
	$aduana = $_POST["aduana"];
	$valor_aduana = $_POST["valor_aduana"];
	$cnt = $_POST["cnt"];
	$dta = $_POST["dta"];
	$prv = $_POST["prv"];
	$igi = $_POST["igi"];
	$iva = $_POST["iva"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			if( $fecha != "" && $numero_pedimento != "" && $aduana != "" && $valor_aduana != "" && $cnt != "" && $dta != "" && $prv != "" && $igi != "" && $iva != ""){
					$existe = existe_pedimento($numero_pedimento, $conexion_usuarios);
					if($existe > 0 ){
						$informacion["respuesta"] = "EXISTE";
						echo json_encode($informacion);
					}else{
						registrar($fecha, $numero_pedimento, $aduana, $valor_aduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios);
					}
								
				}else{
					$informacion["respuesta"] = "VACIO";
					echo json_encode($informacion);
			}
			break;
		case 'modificar':
			modificar($fecha, $numero_pedimento, $aduana, $valor_aduana, $cnt, $dta, $prv, $igi, $iva, $idpedimento, $conexion_usuarios);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function existe_pedimento($numero_pedimento, $conexion_usuarios){
		$query = "SELECT id FROM pedimentos WHERE numero_pedimento = '$numero_pedimento';";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_pedimento = mysqli_num_rows( $resultado );
		return $existe_pedimento;
	}

	function registrar($fecha, $numero_pedimento, $aduana, $valor_aduana, $cnt, $dta, $prv, $igi, $iva, $conexion_usuarios){
		$query = "INSERT INTO pedimentos (fecha,numero_pedimento,aduana,valor_aduana,cnt,dta, prv, igi, iva) VALUES('$fecha', '$numero_pedimento', '$aduana', '$valor_aduana', '$cnt', '$dta', '$prv', '$igi', '$iva');";
		$resultado = mysqli_query($conexion_usuarios, $query);		
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
	}

	function modificar($fecha, $numero_pedimento, $aduana, $valor_aduana, $cnt, $dta, $prv, $igi, $iva, $idpedimento, $conexion_usuarios){
		$query ="UPDATE pedimentos SET fecha='$fecha', numero_pedimento='$numero_pedimento', aduana='$aduana', valor_aduana='$valor_aduana', cnt='$cnt', dta='$dta', prv='$prv', igi='$igi', iva='$iva' WHERE id=$idpedimento";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
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