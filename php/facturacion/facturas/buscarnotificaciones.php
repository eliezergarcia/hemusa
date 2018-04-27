<?php 	
	include("../../conexion.php");

	$opcion = $_POST['opcion'];

	switch ($opcion) {
		case 'buscarevento':
			$id = $_POST['id'];
			buscarevento($id, $conexion_usuarios);
			break;
        
        case 'buscarocpendientes':
            buscar_oc_pendientes($conexion_usuarios);
            break;
        
        case 'proveedoressinoc':
			proveedoressinoc($conexion_usuarios);
		    break;
	}

	function buscarevento($id, $conexion_usuarios){
		$query = "SELECT * FROM calendario WHERE id = '$id'";
		$resultado = mysqli_query($conexion_usuarios, $query);

		if (!$resultado) {
			$informacion['respuesta'] = "ERROR";
		}else{
			while ($data = mysqli_fetch_assoc($resultado)) {
				$informacion['data'] = $data;
			}
		}
		echo json_encode($informacion);
		mysqli_close($conexion_usuarios);
    }
    
    function buscar_oc_pendientes($conexion_usuarios){
        $query = "SELECT DISTINCT Proveedor FROM cotizacionherramientas WHERE Pedido = 'si' AND noDePedido = ''";
        $resultado = mysqli_query($conexion_usuarios, $query);

        if (mysqli_num_rows($resultado) > 0) {
            $n = 0;
            while($data = mysqli_fetch_assoc($resultado)){
                if($data['Proveedor'] != "ALMACEN"){
                    $n++;
                    $pendientes['respuesta'] = $n;
                }
            }
        }else{
            $pendientes['respuesta'] = 0;
        }

        echo json_encode($pendientes);
		mysqli_close($conexion_usuarios);
		
    }

	function proveedoressinoc($conexion_usuarios){
		$query = "SELECT DISTINCT Proveedor FROM cotizacionherramientas WHERE Pedido = 'si' AND Proveedor != 'None' AND noDePedido = '' ORDER BY Proveedor ASC";
		$resultado = mysqli_query($conexion_usuarios, $query);

		while($data = mysqli_fetch_array($resultado)){
			$proveedor = $data['Proveedor'];
			if($proveedor != "ALMACEN"){
				if(is_numeric($proveedor)){
					$idproveedor = $proveedor;
					$queryid = "SELECT nombreEmpresa FROM contactos WHERE id = '$idproveedor' ORDER BY nombreEmpresa ASC LIMIT 1";
					$resid = mysqli_query($conexion_usuarios, $queryid);
					while($dataid = mysqli_fetch_assoc($resid)){
						$proveedor = $dataid['nombreEmpresa'];
					}
					$proveedores[] = utf8_encode($idproveedor);
					$proveedores[] = utf8_encode($proveedor);
				}else{
					$queryid = "SELECT id FROM contactos WHERE tipo = 'Proveedor' AND nombreEmpresa LIKE '%$proveedor%' ORDER BY nombreEmpresa ASC LIMIT 1";
					$resid = mysqli_query($conexion_usuarios, $queryid);
					while($dataid = mysqli_fetch_assoc($resid)){
						$idproveedor = $dataid['id'];
					}
					$proveedores[] = utf8_encode($idproveedor);
					$proveedores[] = utf8_encode($proveedor);
				}	
			}			
		}
		echo json_encode($proveedores);
	}

 ?>