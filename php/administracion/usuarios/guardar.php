<?php
	include('../../conexion.php');
	include('../../sesion.php');
	error_reporting(0);

	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$correoHemusa = $_POST["correoHemusa"];
			$usuario = $_POST["usuario"];
			$password = $_POST["pass"];
			$departamento = $_POST["departamento"];
			$sexo = $_POST["sexo"];
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
				$informacion["informacion"] = "No se puede registrar la información porque el usuario '".$usuario."' ya existe!";
				echo json_encode($informacion);
			}else{
				registrar($usuariologin, $dplogin, $usuario, $password, $nombre, $apellido, $departamento, $sexo, $direccion, $tlfcasa, $movil, $correoPersonal, $correoHemusa, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios);
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
			$sexo = $_POST["sexo"];
			$direccion = $_POST["direccion"];
			$tlfcasa = $_POST["tlfCasa"];
			$movil = $_POST["movil"];
			$correoPersonal = $_POST["correoPersonal"];
			$tipoSangre = $_POST["tipoSangre"];
			$contactoEmergencia = $_POST["contactoEmergencia"];
			$imss = $_POST["imss"];
			editar($usuariologin, $dplogin, $idusuario, $nombre, $apellido, $correoHemusa, $usuario, $password, $departamento, $sexo, $direccion, $tlfcasa, $movil, $correoPersonal, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios);
			break;

		case 'eliminar':
			$idusuario = $_POST['idusuario'];
			$nombre = $_POST['nombre'];
			eliminar($usuariologin, $dplogin, $nombre, $idusuario, $conexion_usuarios);
			break;
	}

	function existe_usuario($usuario, $conexion_usuarios){
		$query = "SELECT id FROM usuarios WHERE user = '$usuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_usuario = mysqli_num_rows( $resultado );
		return $existe_usuario;
	}

	function registrar($usuariologin, $dplogin, $usuario, $password, $nombre, $apellido, $departamento, $sexo, $direccion, $tlfcasa, $movil, $correoPersonal, $correoHemusa, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios){
		if ($sexo == 'M') {
			$avatar = "defaultMasculino.png";
		}else{
			$avatar = "defaultFemenino.png";
		}

		$query = "INSERT INTO usuarios (user, password, nombre, apellidos, dp, sexo, direccion, tlfcasa, movil, correoPersonal, correoHemusa, tipoSangre, contactoEmergencia, imss, avatar) VALUES ('$usuario', '$password', '$nombre', '$apellido', '$departamento', '$sexo', '$direccion', '$tlfcasa', '$movil', '$correoPersonal', '$correoHemusa', '$tipoSangre', '$contactoEmergencia', '$imss', '$avatar')";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un error al guardar la información del usuario '".$nombre." ".$apellido."'!";
		}else{
			$descripcion = "Se registro el usuario ".$nombre." ".$apellido;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Registro', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "La información del usuario '".$nombre." ".$apellido."' se guardó correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function editar($usuariologin, $dplogin, $idusuario, $nombre, $apellido, $correoHemusa, $usuario, $password, $departamento, $sexo, $direccion, $tlfcasa, $movil, $correoPersonal, $tipoSangre, $contactoEmergencia, $imss, $conexion_usuarios){
		if ($sexo == 'M') {
			$avatar = "defaultMasculino.png";
		}else{
			$avatar = "defaultFemenino.png";
		}

		$query ="UPDATE usuarios SET user='$usuario', password='$password', nombre='$nombre', apellidos='$apellido', dp='$departamento', sexo='$sexo', direccion='$direccion', tlfcasa='$tlfcasa', movil='$movil', correoPersonal='$correoPersonal', correoHemusa='$correoHemusa', tipoSangre='$tipoSangre', contactoEmergencia='$contactoEmergencia', imss='$imss', avatar='$avatar' WHERE id='$idusuario'";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un error al modificar la información del usuario '".$nombre." ".$apellido."'!";
		}else{
			$descripcion = "Se modifico la informacion del usuario ".$nombre." ".$apellido;
			$fechahora = date("Y-m-d H:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Modificacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "Se modificó la información del usuario '".$nombre." ".$apellido."' correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}

	function eliminar($usuariologin, $dplogin, $nombre, $idusuario, $conexion_usuarios){
		$query = "DELETE FROM usuarios WHERE id =$idusuario";
		$resultado = mysqli_query($conexion_usuarios, $query);
		if (!$resultado) {
			$informacion["respuesta"] = "ERROR";
			$informacion["informacion"] = "Ocurrió un error al eliminar al usuario '".$nombre." ".$apellido."'!";
		}else{
			$descripcion = "Se elimino el usuario ".$nombre;
			$fechahora = date("Y-m-d G:i:s");
			$query = "INSERT INTO movimientosusuarios (departamento, usuario, tipomovimiento, descripcion, fechahora) VALUES ('$dplogin', '$usuariologin', 'Eliminacion', '$descripcion', '$fechahora')";
			$resultado = mysqli_query($conexion_usuarios, $query);
			$informacion["respuesta"] = "BIEN";
			$informacion["informacion"] = "El usuario '".$nombre."' se elimino correctamente!";
		}

		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
	}
 ?>
