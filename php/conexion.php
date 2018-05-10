 <?php
	$server = "127.0.0.1";
	$user = "root";
	$password = "1234";
	$db = "hemusa";
	$ruta = "http://".$server."/sistemahemusa/";
	$database_conexion_usuarios = "hemusa";

	// $conexion_usuarios = mysqli_connect("34.208.155.107", "hemusadb", "Hemusa@2017", "hemusa");
	$conexion_usuarios = mysqli_connect("127.0.0.1", $user, $password, $db);
	// $conexion_usuarios = mysqli_connect("127.0.0.1", "root", "", "hemusa2018");
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
?>
