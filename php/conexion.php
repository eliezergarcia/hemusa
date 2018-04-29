 <?php
	$server = "localhost";
	$user = "hemusadb";
	$password = "Hemusa@2017";
	$db = "hemusa2018";
	$ruta = "http://".$server."/sistemahemusa/"; 
	$database_conexion_usuarios = "hemusa2018";

	$conexion_usuarios = mysqli_connect("34.208.155.107", $user, $password, $db);
	
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}
?>
