<?php
	include("../../conexion.php");

	$opcion = $_POST['opcion'];
	$informacion = [];

	switch ($opcion) {
    case 'movimientosusuarios':
			$fechainicio = $_POST['fechainicio'];
			$fechafin = $_POST['fechafin'];
			$departamento = $_POST['departamento'];
			movimientos_usuarios($fechainicio, $fechafin, $departamento, $conexion_usuarios);
			break;
  }

  function movimientos_usuarios($fechainicio, $fechafin, $departamento, $conexion_usuarios){
    $query = "SELECT movimientosusuarios.*, usuarios.* FROM movimientosusuarios INNER JOIN usuarios ON usuarios.id = movimientosusuarios.idusuario WHERE fechahora >= '$fechainicio' AND fechahora <= '$fechafin' ORDER BY fechahora";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if (mysqli_num_rows($resultado) < 1) {
      $arreglo['data'] = 0;
    }else{
      while($data = mysqli_fetch_assoc($resultado)){
        $documento = $data['documento'];
        switch ($documento) {
          case 'tipocambio':
            $icono = '<i class="icon fas fa-dollar-sign"></i>';
            break;

          case 'contacto':
            $icono = '<i class="fas fa-address-card"></i>';
            break;

          case 'cotizaciones':
            $icono = '<i class="icon fas fa-file"></i>';
            break;

          case 'cotizaciones/pedidos':
            $icono = '<i class="icon fas fa-file"></i>';
            break;

          case 'pedidos':
            $icono = '<i class="icon fas fa-file"></i>';
            break;

          case 'pedidos/packinglist':
            $icono = '<i class="icon fas fa-cube"></i>';
            break;
        }

        if ($data['tipomovimiento'] == "R") {
          $color = "gallery";
        }elseif ($data['tipomovimiento'] == "M") {
          $color = "file";
        }elseif ($data['tipomovimiento'] == "D") {
          $color = "quote";
        }

        $arreglo['data'][] = array(
          'avatar' => $data['avatar'],
          'tipomovimiento' => $data['tipomovimiento'],
          'documento' => $data['documento'],
          'usuario' => $data['nombre']." ".$data['apellidos'],
          'departamento' => $data['dp'],
          'fechahora' => $data['fechahora'],
          'descripcion' => utf8_encode($data['descripcion']),
          'icono' => $icono,
          'color' => $color
        );
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
		mysqli_close($conexion_usuarios);
  }

?>
