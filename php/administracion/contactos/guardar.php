<?php 
	include("../../conexion.php");
	$idcontacto = $_POST["idcontacto"];
	$nombreEmpresa = $_POST["nombreEmpresa"];
	$rfc = $_POST["rfc"];
	$personaContacto = $_POST["personaContacto"];
	$calle = $_POST["calle"];
	$ciudad = $_POST["ciudad"];
	$codigoPostal = $_POST["codigoPostal"];
	$pais = $_POST["pais"];
	$direccionEnvio = $_POST["direccionEnvio"];
	$tlf1 = $_POST["tlf1"];
	$fax = $_POST["fax"];
	$correoElectronico = $_POST["correoElectronico"];
	$paginaWeb = $_POST["paginaWeb"];
	$codigo = $_POST["codigo"];
	$moneda = $_POST["moneda"];
	$formaPago = $_POST["formaPago"];
	$metodoPago = $_POST["metodoPago"];
	$cfdi = $_POST["cfdi"];
	$responsable = $_POST["responsable"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			if( $nombreEmpresa != "" && $personaContacto != "" && $tlf1 != "" && $fax != "" && $correoElectronico != ""){
					$existe = existe_contacto($nombreEmpresa, $conexion_usuarios);
					if($existe > 0 ){
						$informacion["respuesta"] = "EXISTE";
						echo json_encode($informacion);
					}else{
						registrar($nombreEmpresa, $personaContacto, $tlf1, $fax, $correoElectronico, $conexion_usuarios);
					}
								
				}else{
					$informacion["respuesta"] = "VACIO";
					echo json_encode($informacion);
			}
		break;
		case 'modificar':
			modificar($nombreEmpresa, $rfc, $personaContacto, $calle, $ciudad, $codigoPostal, $pais, $direccionEnvio, $tlf1, $fax, $correoElectronico, $paginaWeb, $codigo, $moneda, $formaPago, $metodoPago, $responsable, $cfdi, $idcontacto, $conexion_usuarios);
			break;
		
		case 'eliminar':
			eliminar($idcontacto, $conexion_usuarios);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
		break;
	}

	function existe_contacto($nombreEmpresa, $conexion_usuarios){
		$query = "SELECT id FROM contactos WHERE nombreEmpresa = '$nombreEmpresa';";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_contacto = mysqli_num_rows( $resultado );
		return $existe_contacto;
	}

	function registrar($nombreEmpresa, $personaContacto, $tlf1, $fax, $correoElectronico, $conexion_usuarios){
		$query = "INSERT INTO contactos (nombreEmpresa,personaContacto,tlf1,fax,correoElectronico) VALUES('$nombreEmpresa', '$personaContacto', '$tlf1', '$fax', '$correoElectronico');";
		$resultado = mysqli_query($conexion_usuarios, $query);		
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
	}

	function modificar($nombreEmpresa, $rfc, $personaContacto, $calle, $ciudad, $codigoPostal, $pais, $direccionEnvio, $tlf1, $fax, $correoElectronico, $paginaWeb, $codigo, $moneda, $formaPago, $metodoPago, $responsable, $cfdi, $idcontacto, $conexion_usuarios){
		$query ="UPDATE contactos SET nombreEmpresa='$nombreEmpresa', RFC='$rfc', personaContacto='$personaContacto', calle='$calle', ciudad='$ciudad', cp='$codigoPostal', pais='$pais', direccion_envio='$direccionEnvio', tlf1='$tlf1', fax='$fax', correoElectronico='$correoElectronico', paginaWeb='$paginaWeb', codigo='$codigo', moneda='$moneda', IdformaPago='$formaPago', IdmetodoPago='$metodoPago', responsable='$responsable', IdUsoCFDI='$cfdi', WHERE id=$idcontacto";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
	}

	function eliminar($idcontacto, $conexion_usuarios){
		$query = "DELETE FROM contactos WHERE id = $idcontacto";
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