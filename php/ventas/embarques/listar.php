<?php
    include("../../conexion.php");
    $opcion = $_POST['opcion'];

	switch ($opcion) {
    case 'embarques':
      $buscar = $_POST['buscar'];
      $filtromes = $_POST['filtromes'];
      $filtroano = $_POST['filtroano'];
      if ($filtromes != "todo") {
        $fechainicio = $filtroano.'-'.$filtromes.'-01';
        $fechafin = $filtroano.'-'.$filtromes.'-31';
      }else{
        $fechainicio = $filtroano.'-01-01';
        $fechafin = $filtroano.'-12-31';
      }
			embarques($buscar, $fechainicio, $fechafin, $conexion_usuarios);
      break;

    case 'partidasembarque':
      $idcliente = $_POST['idcliente'];
			partidas_embarque($idcliente, $conexion_usuarios);
      break;

    case 'imprimirembarque':
      $folio = $_POST['folio'];
			imprimir_embarque($folio, $conexion_usuarios);
      break;

    case 'verembarque':
      $folio = $_POST['folio'];
      ver_embarque($folio, $conexion_usuarios);
      break;
	}

  function embarques($buscar, $fechainicio, $fechafin, $conexion_usuarios){
    $query="SELECT embarques.*, contactos.nombreEmpresa FROM embarques LEFT JOIN contactos on contactos.id=embarques.cliente WHERE (folio_embarque LIKE '%$buscar%' OR nombreEmpresa LIKE '%$buscar%' OR fecha_embarque LIKE '%$buscar%' OR usuario LIKE '%$buscar%') AND fecha_embarque >= '$fechainicio' AND fecha_embarque <= '$fechafin' ORDER BY folio_embarque DESC";
  	$resultado = mysqli_query($conexion_usuarios, $query);

  	if(mysqli_num_rows($resultado) < 1){
  		$arreglo['data'] = 0;
  	}else{
  		while($data = mysqli_fetch_assoc($resultado)){
  			$arreglo['data'][] = array(
  				'folio' => $data['folio_embarque'],
  				'nombreCliente' => $data['nombreEmpresa'],
  				'fecha' => $data['fecha_embarque'],
  				'contactoHemusa' => $data['usuario']
  			);
  		}
  	}

  	echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }

	function imprimir_embarque($folio, $conexion_usuarios){
    $query = "SELECT cotizacionherramientas.*, cotizacion.guia, cotizacion.IdPaqueteria, cotizacion.NoPedClient FROM cotizacionherramientas
      INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE folio_embarque = '$folio'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(!$resultado){
      die('Error');
    }else{
      $i = 1;
      while($data = mysqli_fetch_assoc($resultado)){
        $idpaqueteria = $data['IdPaqueteria'];

        $querypaqueteria = "SELECT nombre FROM paqueterias WHERE IdPaqueteria = '$idpaqueteria'";
        $resultadopaqueteria = mysqli_query($conexion_usuarios, $querypaqueteria);
        while($datapaqueteria = mysqli_fetch_assoc($resultadopaqueteria)){
          $paqueteria = $datapaqueteria['nombre'];
        }

        $arreglo['partidas'][] = array(
          'indice' => $i,
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'descripcion' => $data['descripcion'],
          'cantidad' => $data['cantidad'],
          'factura' => $data['factura'],
          'ordencompra' => $data['NoPedClient'],
          'paqueteria' => utf8_encode($paqueteria),
          'guia' => $data['guia']
        );
        $i++;
      }
    }

    $query = "SELECT * FROM embarques WHERE folio_embarque='$folio'";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo['embarque'] = $data;
      $idcliente = $data['cliente'];
    }

    $query = "SELECT * FROM contactos WHERE id = '$idcliente'";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo['cliente'] = $data;
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
    mysqli_close($conexion_usuarios);
  }

  function ver_embarque($folio, $conexion_usuarios){
    $query = "SELECT cotizacionherramientas.*, cotizacion.guia, cotizacion.IdPaqueteria, cotizacion.NoPedClient FROM cotizacionherramientas
      INNER JOIN cotizacion ON cotizacion.ref = cotizacionherramientas.cotizacionRef WHERE folio_embarque = '$folio'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(!$resultado){
      die('Error');
    }else{
      $i = 1;
      while($data = mysqli_fetch_assoc($resultado)){
        $idpaqueteria = $data['IdPaqueteria'];

        $querypaqueteria = "SELECT nombre FROM paqueterias WHERE IdPaqueteria = '$idpaqueteria'";
        $resultadopaqueteria = mysqli_query($conexion_usuarios, $querypaqueteria);
        while($datapaqueteria = mysqli_fetch_assoc($resultadopaqueteria)){
          $paqueteria = $datapaqueteria['nombre'];
        }

        $arreglo['data'][] = array(
          'indice' => $i,
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'descripcion' => $data['descripcion'],
          'cantidad' => $data['cantidad'],
          'factura' => $data['factura'],
          'ordencompra' => $data['NoPedClient'],
          'paqueteria' => utf8_encode($paqueteria),
          'guia' => $data['guia']
        );
        $i++;
      }
    }

    $query = "SELECT * FROM embarques WHERE folio_embarque='$folio'";
    $resultado = mysqli_query($conexion_usuarios, $query);
    while($data = mysqli_fetch_assoc($resultado)){
      $arreglo['embarque'][] = $data;
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
  }

  function partidas_embarque($idcliente, $conexion_usuarios){
    $query = "SELECT * FROM cotizacionherramientas WHERE folio_embarque ='' AND embarque = 'pendiente' AND cliente = '$idcliente'";
    $resultado = mysqli_query($conexion_usuarios, $query);

    if(mysqli_num_rows($resultado) < 1){
      $arreglo['data'] = 0;
    }else{
      $i = 1;
      while($data = mysqli_fetch_assoc($resultado)){
        $arreglo['data'][] = array(
          'id' => $data['id'],
          'indice' => $i,
          'enviado' => $data['enviadoFecha'],
          'recibido' => $data['recibidoFecha'],
          'marca' => $data['marca'],
          'modelo' => $data['modelo'],
          'cantidad' => $data['cantidad'],
          'descripcion' => $data['descripcion']
        );
        $i++;
      }
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PARTIAL_OUTPUT_ON_ERROR);
  }

 ?>
