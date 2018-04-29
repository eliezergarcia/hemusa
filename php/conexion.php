 <?php
	$server = "127.0.0.1";
	$user = "root";
	$password = "1234";
	$db = "hemusa2018";
	$ruta = "http://".$server."/sistemahemusa/"; 
	$database_conexion_usuarios = "hemusa2018";

	$conexion_usuarios = mysqli_connect($server, $user, $password, $db);
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
?>
