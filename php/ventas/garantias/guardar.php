<?php 
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "hemusapruebas";

	$conexion_usuarios = mysqli_connect($server, $user, $password, $db);
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}

	$idusuario = $_POST["idusuario"];
	$usuario = $_POST["usuario"];
	$password = $_POST["password"];
	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$departamento = $_POST["departamento"];
	$nivel = $_POST["nivel"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'registrar':
			if( $usuario != "" && $password != "" && $nombre != "" && $apellidos != "" && $departamento != "" && $nivel != "" ){
					$existe = existe_usuario($usuario, $conexion_usuarios);
					if($existe > 0 ){
						$informacion["respuesta"] = "EXISTE";
						echo json_encode($informacion);
					}else{
						registrar($usuario, $password, $nombre, $apellidos, $departamento, $nivel, $conexion_usuarios);
					}
								
				}else{
					$informacion["respuesta"] = "VACIO";
					echo json_encode($informacion);
			}
			break;
		case 'modificar':
			modificar($usuario, $password, $nombre, $apellidos, $departamento, $nivel, $idusuario, $conexion_usuarios);
			break;
		
		case 'eliminar':
			eliminar($idusuario, $conexion_usuarios);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function existe_usuario($usuario, $conexion_usuarios){
		$query = "SELECT id FROM usuarios WHERE user = '$usuario';";
		$resultado = mysqli_query($conexion_usuarios, $query);
		$existe_usuario = mysqli_num_rows( $resultado );
		return $existe_usuario;
	}

	function registrar($usuario, $password, $nombre, $apellidos, $departamento, $nivel, $conexion_usuarios){
		$query = "INSERT INTO usuarios (user,password,nombre,apellidos,dp,nivel) VALUES('$usuario', '$password', '$nombre', '$apellidos', '$departamento', '$nivel');";
		$resultado = mysqli_query($conexion_usuarios, $query);		
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
	}

	function modificar($usuario, $password, $nombre, $apellidos, $departamento, $nivel, $idusuario, $conexion_usuarios){
		$query ="UPDATE usuarios SET user='$usuario', password='$password', nombre='$nombre', apellidos='$apellidos', dp='$departamento', nivel='$nivel' WHERE id=$idusuario";
		$resultado = mysqli_query($conexion_usuarios, $query);
		verificar_resultado($resultado);
		cerrar($conexion_usuarios);
	}

	function eliminar($idusuario, $conexion_usuarios){
		$query = "DELETE FROM usuarios WHERE id =$idusuario";
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