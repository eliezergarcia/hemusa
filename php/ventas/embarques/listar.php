<?php
    include("../../conexion.php");
    $opcion = $_POST['opcion'];

	switch ($opcion) {
    case 'embarques':
			embarques($conexion_usuarios);
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

  function embarques($conexion_usuarios){
    $query="SELECT embarques.folio_embarque, embarques.cliente, embarques.fecha_embarque, embarques.usuario, contactos.nombreEmpresa
  	FROM embarques LEFT JOIN contactos on contactos.id=embarques.cliente WHERE folio_embarque >  '2666' ORDER BY folio_embarque DESC
  	LIMIT 150 ";
  	$resultado = mysqli_query($conexion_usuarios, $query);

  	if(!$resultado){
  		die('Error');
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
