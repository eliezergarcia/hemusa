 <?php
  $server= $_SERVER["HTTP_HOST"];
	$user = "root";
	$password = "1234";
	$db = "hemusa";
  $database_conexion_usuarios = "hemusa";
	$ruta = "http://".$server."/sistemahemusa/";

	$conexion_usuarios = mysqli_connect("18.236.250.216", "hemusadb", "Hemusa@2017", "hemusa");
	// $conexion_usuarios = mysqli_connect($server, $user, $password, $db);
	// $conexion_usuarios = mysqli_connect("127.0.0.1", "root", "", "hemusa2018");
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
?>
