<?php 
	include('../../conexion.php');

	$opcion = $_POST["opcion"];	
	$usuariologin = $_POST['usuariologin'];
	$dplogin = $_POST['dplogin'];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':			
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$correoHemusa = $_POST["correoHemusa"];
			$usuario = $_POST["usuario"];
			$password = $_POST["pass"];
			$departamento = $_POST["departamento"];
			$direccion = $_POST["direccion"];
			$tlfcasa = $_POST["tlfCasa"];
			$movil = $_POST["movil"];
			$correoPersonal = $_POST["correoPersonal"];			
			$tipoSangre = $_POST["tipoSangre"];
			$contactoEmergencia = $_POST["contactoEmergencia"];
			$imss = $_POST["imss"];

			$existe = existe_usuario($usuario, $conexion_usuarios);
			if($existe > 0 ){
				$informacion["respuesta"] = "EXISTE";
				echo json_encode($informacion);
			}else{
				registrar($usuariologin, $dplogin, $usuario, $password, $nombre, $apellido, $departamento, $direccion, $tlfcasa, $movil, $correoPersonal, $correoHemusa, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios);
			}
			break;
		
		case 'editar':
			$idusuario = $_POST["idusuario"];
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$correoHemusa = $_POST["correoHemusa"];
			$usuario = $_POST["usuario"];
			$password = $_POST["pass"];
			$departamento = $_POST["departamento"];
			$direccion = $_POST["direccion"];
			$tlfcasa = $_POST["tlfCasa"];
			$movil = $_POST["movil"];
			$correoPersonal = $_POST["correoPersonal"];			
			$tipoSangre = $_POST["tipoSangre"];
			$contactoEmergencia = $_POST["contactoEmergencia"];
			$imss = $_POST["imss"];
			editar($usuariologin, $dplogin, $idusuario, $nombre, $apellido, $correoHemusa, $usuario, $password, $departamento, $direccion, $tlfcasa, $movil, $correoPersonal, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios);
			break;
		
		case 'eliminar':
			$idusuario = $_POST['idusuario'];
			$usuario = $_POST['usuario'];
			eliminar($usuariologin, $dplogin, $usuario, $idusuario, $conexion_usuarios);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function existe_usuario($usuario, $conexion_usuarios){
		$query = "SELECT id FROM usuarios WHERE usuario = '$usuario';";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_usuario = mysqli_num_rows( $resultado );
		return $existe_usuario;
	}

	function registrar($usuariologin, $dplogin, $usuario, $password, $nombre, $apellido, $departamento, $direccion, $tlfcasa, $movil, $correoPersonal, $correoHemusa, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios){
		$query = "INSERT INTO usuarios (user, password, nombre, apellidos, dp, direccion, tlfcasa, movil, correoPersonal, correoHemusa, tipoSangre, contactoEmergencia, imss) VALUES('$usuario', '$password', '$nombre', '$apellido', '$departamento', '$direccion', '$tlfcasa', '$movil', '$correoPersonal', '$correoHemusa', '$tipoSangre', '$contactoEmergencia', '$imss');";
		$resultado = mysqli_query($conexion_usuarios, $query);		
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{		
			$descripcion = "Se registro el usuario ".$nombre." ".$apellido;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}

		cerrar($conexion_usuarios);
	}

	function editar($usuariologin, $dplogin, $idusuario, $nombre, $apellido, $correoHemusa, $usuario, $password, $departamento, $direccion, $tlfcasa, $movil, $correoPersonal, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios){
		$query ="UPDATE usuarios SET user='$usuario', password='$password', nombre='$nombre', apellidos='$apellido', dp='$departamento', direccion='$direccion', tlfcasa='$tlfcasa', movil='$movil', correoPersonal='$correoPersonal', correoHemusa='$correoHemusa', tipoSangre='$tipoSangre', contactoEmergencia='$contactoEmergencia', imss='$imss' WHERE id=$idusuario";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{		
			$descripcion = "Se modifico la informacion del usuario ".$nombre." ".$apellido;
			$fechahora = date("Y-m-d H:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Modificacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}

		cerrar($conexion_usuarios);
	}

	function eliminar($usuariologin, $dplogin, $usuario, $idusuario, $conexion_usuarios){
		$query = "DELETE FROM usuarios WHERE id =$idusuario";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			verificar_resultado($resultado);
		}else{
			$descripcion = "Se elimino el usuario ".$usuario;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Eliminacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			verificar_resultado($resultado);
		}
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