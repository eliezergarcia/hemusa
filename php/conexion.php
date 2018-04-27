 <?php
 	# FileName="Connection_php_mysql.htm"
	# Type="MYSQL"
	# HTTP="true"

	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "hemusa2018";
	$ruta = "http://localhost/hemusa/"; 
	$database_conexion_usuarios = "hemusa2018";

	// $conexion_usuarios = mysqli_connect("34.208.155.107", "hemusadb", "Hemusa@2017", "hemusa");
	$conexion_usuarios = mysqli_connect("34.208.155.107", "hemusadb", "Hemusa@2017","hemusa2018");
	// $conexion_usuarios = mysqli_connect("127.0.0.1", "root", "", "hemusa2018");
	if(!$conexion_usuarios){
		die('Error de conexión: ' . mysqli_connect_errno());
	}

	// $hostname_conexion_usuarios = "34.208.155.107";
	// $username_conexion_usuarios = "hemusadb";
	// $password_conexion_usuarios = "Hemusa@2017";
	// $conexion_usuarios = mysql_pconnect($hostname_conexion_usuarios, $username_conexion_usuarios, $password_conexion_usuarios) or trigger_error(mysql_error(),E_USER_ERROR);

	// $conexion_usuarios = mysqli_connect("34.208.155.107", "hemusadb", "Hemusa@2017", "hemusa");

	// mysql_select_db($database_conexion_usuarios, $conexion_usuarios);

?>
