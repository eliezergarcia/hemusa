<?php
	include ('../../conexion.php');

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarcuentas':
			cuentas($conexion_usuarios);
			break;

		case 'buscarvendedores':
			vendedores($conexion_usuarios);
			break;
  }

  function cuentas($conexion_usuarios){
    $query = "SELECT * FROM accounts ORDER BY id";
    $resultado = mysqli_query($conexion_usuarios, $query);

    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo["data"][] = $data;
    }

    echo json_encode($arreglo);
    mysqli_close($conexion_usuarios);
  }

	function vendedores($conexion_usuarios){
    $query = "SELECT * FROM usuarios ORDER BY id";
    $resultado = mysqli_query($conexion_usuarios, $query);

    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo["data"][] = array_map("utf8_encode", $data);
    }

    echo json_encode($arreglo);
    mysqli_close($conexion_usuarios);
  }

?>
