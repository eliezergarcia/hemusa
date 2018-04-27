<?php 
	header("Content-Type: text/html;charset=utf-8");
	require_once('../../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);
	$ruta = "http://localhost/Hemusa/";
?>

<?php 
						
	$numero = $_REQUEST["numero"];

	$id = $_REQUEST["id"];
	$cliente = $_REQUEST["cliente"];

	$comentario = $_REQUEST["comentario"];
	$nuevoComentario = $_REQUEST["nuevoComentario"];
	$agregarComentario = $_REQUEST["agregarComentario"];
	$nuevoEntrega = $_REQUEST["nuevoEntrega"];
	$agregarPedido = $_REQUEST["agregarPedido"];
	$pedido = $_REQUEST["pedido"];
	$fecha = $_REQUEST["fecha"];
	$contacto = $_REQUEST["contacto"];
	$TiempoEntrega = $_REQUEST["TiempoEntrega"];
	$CondPago = $_REQUEST["CondPago"];
	$NOPartidas = $_REQUEST["NOPartidas"];
	$Otra = $_REQUEST["Otra"];
	$marca = $_REQUEST["marca"];
	$modelo = $_REQUEST["modelo"];
	$descripcion = $_REQUEST["descripcion"];
	$cantidad = $_REQUEST["cantidad"];
	$precioUnidad = $_REQUEST["precioUnidad"];
	$factor = $_REQUEST["factor"];
	$marcaSet = $_REQUEST["marcaSet"];
	$modeloSet = $_REQUEST["modeloSet"];
	$descripcionSet = $_REQUEST["descripcionSet"];
	$precioUnidadSet = $_REQUEST["precioUnidadSet"];
	$agregar = $_REQUEST["agregar"];
	$editar = $_REQUEST["editar"];
	$noEditar = $_REQUEST["noEditar"];
	$sigue = $_REQUEST["sigue"];
	$refBusca = $_REQUEST["refBusca"];
	$palabraBusca = $_REQUEST["palabraBusca"];
	$buscar = $_REQUEST["buscar"];
	$set = $_REQUEST["set"];
	$CotizacionNo = $_REQUEST["CotizacionNo"];
	$deMenu = $_REQUEST["deMenu"];
	$imprimir = $_REQUEST["imprimir"];
	$Pago = $_REQUEST["Pago"];
	$Pago1 = $_REQUEST["Pago1"];
	$Pago2 = $_REQUEST["Pago2"];
	$factura = $_REQUEST["factura"];
	$facturaFecha = $_REQUEST["facturaFecha"];
	$factura1 = $_REQUEST["factura1"];
	$factura2 = $_REQUEST["factura2"];
	$NoPedClient = $_REQUEST["NoPedClient"];
	$decotizacion = $_REQUEST["decotizacion"];



	//set when editing an item
	$idPartida = $_REQUEST["idPartida"];
	$iReg = $_REQUEST["iReg"];
?>

<html lang="es">
<head>
	<title>Pedido</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Eliezer Hernandez">
	<meta name="description" content="Hemusa, herramientas mecanicas y universales">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!--CSS-->    
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Righteous" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.indigo-pink.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="css/buttons.semanticui.min.css">
    <link rel="stylesheet" href="css/select.semanticui.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.0.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/awesomplete.css">

    <!--Javascript-->    
    <script defer src="js/material.min.js"></script> 
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.material.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/fontawesome.js"></script>
	<script src="js/awesomplete.min.js"></script>


    <!-- Librerias para Exportación de Botones -->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script> 
    <script src="js/buttons.html5.min.js"></script>  
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>

</head>
<body>
	<?php include('../../../header.php'); ?>
  		<main class="mdl-layout__content">

			<!-- Encabezado -->
			  	<div class="row fondo">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<h1 class="text-center titulo">Pedido</h1>
					</div>
				</div>

			<?php
			//logging in to adm
			$adm = $_REQUEST["adm"];
			if ($adm==1) {
				$resultEmpleo = mysqli_query($conexion_usuarios, "SELECT * FROM Empleos WHERE contrasena='$psw'");
				$rowEmpleo = mysqli_fetch_array($resultEmpleo);	
				if (isset($psw)==0 or $rowEmpleo['nombre']=='') {
					 echo '<body onLoad="self.focus();document.password.psw.focus()">';
				} else {
					 echo '<body onLoad="self.focus();document.nuevaTarea.fechaEmpieza.focus()">';
				   //echo '<META HTTP-EQUIV="Refresh" CONTENT="300; URL=hemusa.php?psw='.$psw.'">';
				}	 



			}


			$agregar = $_REQUEST["agregar"];
			$editar = $_REQUEST["editar"];
			$suprimir = $_REQUEST["suprimir"];
			$sigue = $_REQUEST["sigue"];




			//editing an item
			   if(isset($editar)) {
				   
				   
				    $tiene_oc=&material_enOC("", "parcial", $idPartida);
					 
					 
					
				   $descripcion=addslashes($descripcion);	
				   $referencia_interna="";
				   $lugar_cotizacion="";
				   $NumSerie="";
				   
				   if($_POST["referencia_interna"]){
					   $referencia_interna=$_POST["referencia_interna"];
					   
					   }
					  if($_POST["lugar_cotizacion"]){
					   $lugar_cotizacion=$_POST["lugar_cotizacion"];
					   }  
					   
					   if($_POST["NoSerie"]){
					   $NumSerie=$_POST["NoSerie"];
					   }  
					   
			if ($descripcion!='') {
			      	 $insertSQL = "update CotizacionHerramientas set descripcion='$descripcion' where id=$idPartida";
			      	 mysqli_query($conexion_usuarios, $insertSQL);
			   		}

			  $insertSQL = "update CotizacionHerramientas set referencia_interna='".$referencia_interna."'
					  where id=".$idPartida."";
			         mysqli_query($conexion_usuarios, $insertSQL);
			    
				    $insertSQL = "update CotizacionHerramientas set lugar_cotizacion='".$lugar_cotizacion."'
					  where id=".$idPartida."";
			         mysqli_query($conexion_usuarios, $insertSQL);
					 
					   $insertSQL = "update CotizacionHerramientas set NoSerie='".$NumSerie."'
					  where id=".$idPartida."";
			         mysqli_query($conexion_usuarios, $insertSQL);

					 
					 if ($marca!='') {
			      	 $insertSQL = "update CotizacionHerramientas set marca='$marca' where id='$idPartida'";
			      	 mysqli_query($conexion_usuarios, $insertSQL);
			   		}
			   		if ($modelo!='') {
			         $insertSQL = "update CotizacionHerramientas set modelo='$modelo' where id=$idPartida";
			      	 mysqli_query($conexion_usuarios, $insertSQL);
			   	  }
			   		
					 
					  if($tiene_oc==0 or $nivel_usuario ==0){
				   
			   		
			   		if ($cantidad!='') {
			         $insertSQL = "update CotizacionHerramientas set cantidad='$cantidad' where id=$idPartida";
							 mysqli_query($conexion_usuarios, $insertSQL);
			      }
			      if ($precioUnidad!='') {
			         $insertSQL = "update CotizacionHerramientas set precioLista=$precioUnidad where id=$idPartida";
			         mysqli_query($conexion_usuarios, $insertSQL);
			      }	 
				  
				  
			       
			    
				 
				  echo '<script>alert("El registro ha sido editado.");</script>';
				  
				  
				
					 }
					 
					 else{
						 
						 		echo '<script>alert("La partida tiene OC ");</script>';
						 
						 }
						 
						        $idPartida='0';
			   }
			?>

			<style>
			#popup {
			    width:160px;
			    height:80px;
			    padding:20px;
			    background-color:gray;    
			    position:absolute;
			    top:100px;
			    left:100px;
			    display:none;
			}
			</style>

			<?php
			//deleting an item
				 if (isset($suprimir)) {
					 
					 
					 $tiene_oc=&material_enOC("", "parcial", $idPartida);
					 
					/* $password= '<script>password</script>';*/
					 if($tiene_oc==0 or $nivel_usuario==0 ){
						
						 $insertSQL = "delete from CotizacionHerramientas where id=$idPartida";
			      mysqli_query($conexion_usuarios, $insertSQL);
				   
						$NOPartidas--;
				    mysqli_query($conexion_usuarios, "UPDATE `Cotizacion` SET `partidaCantidad` = $NOPartidas WHERE `id` = $CotizacionNo"); 
					
			echo '<script>alert("El registro ha sido eliminado.");</script>';
						 }else{

										echo '<script>alert("La partida tiene OC Consulte al Administrador ");</script>';
									
											
									
								}

			 $idPartida='0';
				 }  




			//adding an item
			   if (isset($agregar) and $cantidad!='') {
				    $insertSQL="SELECT * FROM Cotizacion WHERE id=".$CotizacionNo;
					$resultCotizacion = mysqli_query($conexion_usuarios, $insertSQL);
			      	$rowCotizacion = mysqli_fetch_array($resultCotizacion);
				  	// funcion que acepta apostrofes mysql
						
						$descripcion=addslashes($descripcion);	
						 $referencia_interna="";
				  		 $lugar_cotizacion="";
						 $NumSerie="";
				   
				   if($_POST["referencia_interna"]){
					   $referencia_interna=$_POST["referencia_interna"];
					   
					   }
					  if($_POST["lugar_cotizacion"]){
					   $lugar_cotizacion=$_POST["lugar_cotizacion"];
					   }  
					   
					    if($_POST["NoSerie"]){
					   $NumSerie=$_POST["NoSerie"];
					   }  
				  
						$insertSQL = "INSERT INTO `CotizacionHerramientas` ( `cliente`, `cotizacionNo` ,`cotizacionRef` ,
						`marca` ,`modelo` , `descripcion` , `precioLista` , `cantidad`, `moneda`, `Pedido`, `pedidoFecha` ,
						referencia_interna, lugar_cotizacion , NoSerie)
						 VALUES (".$rowCotizacion['cliente'].", '$CotizacionNo', '".$rowCotizacion['ref']."', '$marca',
						 '$modelo', '$descripcion', '$precioUnidad', $cantidad, '".$rowCotizacion['moneda']."', 'si', 
						 now(),'".$referencia_interna."' , '".$lugar_cotizacion."', '".$NumSerie."' )";
						$result = mysqli_query($conexion_usuarios, $insertSQL);
						$NOPartidas++;
			      mysqli_query($conexion_usuarios, "UPDATE `Cotizacion` SET `partidaCantidad` = $NOPartidas WHERE `id` = $CotizacionNo"); 
				 }


			//set when search is made...	 
				 $marca = $_REQUEST["marca"];
				 $modelo = $_REQUEST["modelo"];
				 $descripcion = $_REQUEST["descripcion"];
				 $cantidad = $_REQUEST["cantidad"];
				 $precioUnidad = $_REQUEST["precioUnidad"];
				 $factor = $_REQUEST["factor"];
				 if (isset($modelo) and $modelo!='' and $cantidad=='') {
				 		$refBusca=$modelo;
				 		$buscar = 'buscar';
				 		$marca1=$marca;
			   } elseif (isset($descripcion) and $cantidad=='') {
				 	 $palabraBusca=$descripcion;
				 	 $buscar = 'buscar';
				 	 $marca1=$marca;
			   }


			//set if all items are delivered..
				 $insertSQL = "SELECT factura FROM cotizacion WHERE factura=".$factura;
			   $Entrega = $_REQUEST["Entrega"];
				 if ($Entrega=='todo' or $num_row==0 and isset($factura) and $factura!=0 and isset($factura2)) {
						$insertSQL = "select * from cotizacionHerramientas WHERE factura=".$CotizacionNo." or cotizacionNo=".$CotizacionNo." and factura=0";
						$resultEnt=mysqli_query($conexion_usuarios, $insertSQL);
						while ($rowEnt = mysqli_fetch_array($resultEnt)) {
							
							
							 if ($rowEnt['Entregado']=='0000-00-00') {
						      if ($rowEnt['cliente']!=611) {
							       $insertSQL = "update Precio".$rowEnt['marca']." set enReserva=enReserva-".$rowEnt['cantidad']." where ref='".$rowEnt['modelo']."'";
									   mysqli_query($conexion_usuarios, $insertSQL);
								 $sqlProductos="UPDATE productos SET 
								 enReserva=enReserva-".$rowEnt['cantidad']."  
								 where ref='".$rowEnt['modelo']."' and marca='".$rowEnt['marca']."'";
									   mysqli_query($conexion_usuarios, $sqlProductos);
									}
				 					$insertSQL = "UPDATE cotizacionherramientas SET  Entregado = now() WHERE id=".$rowEnt['id'];
				 					mysqli_query($conexion_usuarios, $insertSQL);	    
							 }
						}
				 }


			//funcion que verifica si una o mas partidas ya estan en ordenes de compra.
			function &material_enOC($CotizacionNo, $pedido, $id){

			if($pedido=="total"){
				$sql= "SELECT * FROM	 cotizacionherramientas WHERE factura='".$CotizacionNo."' or cotizacionNo='".$CotizacionNo."' and factura=0";
			}
			else{
				$sql= "SELECT * FROM	 cotizacionherramientas WHERE id=".$id."";
			}
				

				$result_sql=mysqli_query($conexion_usuarios, $sql);
				$tiene_oc=0;
						while ($row_sql = mysqli_fetch_array($result_sql)) {
						if(!empty($row_sql['noDePedido'])){
								$tiene_oc=1;
							}
				
						} // fin de while.
						return $tiene_oc;
				} // fin de funcion



			//set if giving a proveedor to the partidas
			$Proveedor = $_REQUEST["Proveedor"];
			$id =$_REQUEST["id"];	 
			$noDePedido =$_REQUEST["noDePedido"];
				 if (isset($Proveedor)) {
					 
				
				    if (isset($noDePedido)) {
							$tiene_oc=&material_enOC($CotizacionNo, "total", "");
						
					
					
					if($tiene_oc==0 or $nivel_usuario==0){
					    $insertSQL = "UPDATE cotizacionherramientas SET Proveedor = '".$Proveedor."', `recibidoFecha` = '0000-00-00', `enviadoFecha` = '0000-00-00', `proveedorFecha` = '0000-00-00', `noDePedido` = '' WHERE factura='".$CotizacionNo."' or cotizacionNo='".$CotizacionNo."' and factura=0";									 
						if($Proveedor=='ALMACEN'){
							
							
							$fecha_de_hoy= date('Y-m-d'); 
							$insertSQL = "UPDATE cotizacionherramientas SET Proveedor = '".$Proveedor."', `recibidoFecha` = '".$fecha_de_hoy."', `enviadoFecha` = '".$fecha_de_hoy."', `proveedorFecha` = '0000-00-00', `noDePedido` = '' WHERE factura='".$CotizacionNo."' or cotizacionNo='".$CotizacionNo."' and factura=0";	
								
							}
				 			mysqli_query($conexion_usuarios, $insertSQL);
							
					}
					else{
						
						echo '<script>alert("El pedido tiene OC  Consulte al Administrador ");</script>';
						}
						} else {
							
							$tiene_oc=&material_enOC($CotizacionNo, "parcial", $id);
							if($tiene_oc==0 or $nivel_usuario==0){
				 			$insertSQL = "UPDATE cotizacionherramientas SET Proveedor = '".$Proveedor."', `recibidoFecha` = '0000-00-00', `enviadoFecha` = '0000-00-00', `proveedorFecha` = '0000-00-00', `noDePedido` = '' WHERE id=".$id;
							
							;									 
						if($Proveedor=='ALMACEN'){
							
							
							$fecha_de_hoy= date('Y-m-d'); 
							$insertSQL = "UPDATE cotizacionherramientas SET Proveedor = '".$Proveedor."', `recibidoFecha` = '".$fecha_de_hoy."', `enviadoFecha` = '".$fecha_de_hoy."', `proveedorFecha` = '0000-00-00', `noDePedido` = '' WHERE id=".$id;
								
							}
							
							
				 			mysqli_query($conexion_usuarios, $insertSQL);
							}else{
										echo '<script>alert("El pedido tiene OC Consulte al Administrador");</script>';
								}
							
							
						}
						 //Actualiza si todo el material del pedido esta recibido

						 ActualizaRecibido($CotizacionNo);
				 }

				 
			//making split of a partida.
			$idSplit = $_REQUEST["idSplit"];
			$cantidadSplit = $_REQUEST["cantidadSplit"];
			$split = $_REQUEST["split"];
			if (isset($split)) {
				 $insertSQL='select * from cotizacionherramientas where id = '.$idSplit;
				 $resultPartida=mysqli_query($conexion_usuarios, $insertSQL);
				 $rowPartida = mysqli_fetch_array($resultPartida);
				 
				 if ($cantidadSplit<$rowPartida["cantidad"]) {
				    $insertSQL="update `cotizacionherramientas` set cantidad=cantidad-".$cantidadSplit." where id=".$idSplit;

					
					
					 	if(!$resultSplit=mysqli_query($conexion_usuarios, $insertSQL)){
						
					echo "<script type=\"text/javascript\">alert(\"Error al crear split \");</script>"; 
				
						}
						// funcion que acepta apostrofes mysql
						
						$descripcion_partida=addslashes($rowPartida["descripcion"]);	
						
				    $insertSQL="INSERT INTO `cotizacionherramientas` ( `cliente` , `cotizacionNo` , `cotizacionRef` , `marca` , `modelo` , `descripcion` , `precioLista` , `cantidad` ,  `Pedido` , `pedidoFecha` , `noDePedido` , `Proveedor` , `proveedorFecha` , `enviadoFecha` , `recibidoFecha` , `Entregado` , `remision` , `factura` , `moneda` , `Unidad` , `Pedimento`, `FechaPedimento`, `Aduana` , `IdMaterialImportacion` ) VALUES ( ".$rowPartida["cliente"].", ".$rowPartida["cotizacionNo"].", '".$rowPartida["cotizacionRef"]."', '".$rowPartida["marca"]."', '".$rowPartida["modelo"]."', '".$descripcion_partida."', ".$rowPartida["precioLista"].", ".$cantidadSplit.", '".$rowPartida["Pedido"]."', '".$rowPartida["pedidoFecha"]."', '".$rowPartida["noDePedido"]."', '".$rowPartida["Proveedor"]."', '".$rowPartida["proveedorFecha"]."', '".$rowPartida["enviadoFecha"]."', '".$rowPartida["recibidoFecha"]."', '".$rowPartida["Entregado"]."', ".$rowPartida["remision"].", ".$rowPartida["factura"].", '".$rowPartida["moneda"]."'
					, '".$rowPartida["Unidad"]."',
					'".$rowPartida["Pedimento"]."', '".$rowPartida["FechaPedimento"]."','".$rowPartida["Aduana"]."', '".$rowPartida["IdMaterialImportacion"]."' 
					
					);";
				    
					 	if(!$resultSplit=mysqli_query($conexion_usuarios, $insertSQL)){
						
					echo "<script type=\"text/javascript\">alert(\"Error al crear split \");</script>"; 
				
						}else{
						
				  $queryInsert="SELECT MAX( id ) AS id_max FROM cotizacionherramientas";
				  $resInsert=mysqli_query($conexion_usuarios, $queryInsert);
				  $rowInsert = mysqli_fetch_array($resInsert);
				  $id_nuevo= $rowInsert['id_max'];
						
						
						splitUtilidadPedido($idSplit, $id_nuevo, $cantidadSplit);
						}
						$idSplit='';
				 }  
			}
				 
				 
			//quitar herr de la factura
			$quitar = $_REQUEST["quitar"];
			if (isset($quitar) and $quitar!='') {
				
				$insertSQL='update cotizacionherramientas set factura=0 where id = '.$quitar;
				 $result=mysqli_query($conexion_usuarios, $insertSQL);
				  ActualizarTablaCotizacion2($quitar, $_REQUEST['CotizacionNo']);
				  ActualizaTablaCotizacion($quitar, $_REQUEST['CotizacionNo'] );
				 
				
			}
				 
				 

			//set if changing factura
			$factnew = $_REQUEST["factnew"];

			if (isset($factnew) and $factnew!='new') {

			$insertSQL = "SELECT factura FROM cotizacion WHERE factura=".$factnew;
				 $result=mysqli_query($conexion_usuarios, $insertSQL);
				 $num_rows = mysqli_num_rows($result);

				 if ($factnew==0) 
				    $insertSQL = "UPDATE cotizacion SET factura=".$factnew.", facturaFecha='0000-00-00' WHERE id=".$CotizacionNo;
				 elseif ($num_rows==0)
				    $insertSQL = "UPDATE cotizacion SET factura=".$factnew.", facturaFecha=now() WHERE id=".$CotizacionNo;
				 else
				    echo '<i><big><FONT COLOR="ff0000">EL NUMERO DE FACTURA YA EXISTE EN LA SISTEMA!!!!</FONT></big><b></i></b>';
				 mysqli_query($conexion_usuarios, $insertSQL);	 
			}
			//set if changing discount
			$descuento = $_REQUEST["descuento"];

			if (isset($descuento) and $descuento!='new') {
			$insertSQL = "UPDATE cotizacion SET descuento=".$descuento." WHERE id=".$CotizacionNo;
			mysqli_query($conexion_usuarios, $insertSQL);	 
			}
			//set if changing guia
			$guia = $_REQUEST["guia"];

			if (isset($guia) and $guia!='new') {
			$insertSQL = "UPDATE cotizacion SET guia='".$guia."' WHERE id=".$CotizacionNo;
				 mysqli_query($conexion_usuarios, $insertSQL);	 
			}

			//set if changing comision
			$comision = $_REQUEST["comision"];

			if (isset($comision) and $comision!='new') {
			$insertSQL = "UPDATE cotizacion SET comision='".$comision."' WHERE id=".$CotizacionNo;
				 mysqli_query($conexion_usuarios, $insertSQL);	 
			}

			//set if changing moneda
			$moneda = $_REQUEST["moneda"];

			if (isset($moneda)) {
			$insertSQL = "UPDATE cotizacion SET moneda='".$moneda."' WHERE id=".$CotizacionNo;
				 mysqli_query($conexion_usuarios, $insertSQL);
				 
			   if ($moneda=='usd') {
				    $insertSQL = "UPDATE CotizacionHerramientas SET precioLista = precioLista/$exchangerate, moneda='usd' WHERE cotizacionNo=$CotizacionNo AND factura=0 or factura=$CotizacionNo";
				    mysqli_query($conexion_usuarios, $insertSQL);	
				 } else {
				    $insertSQL = "UPDATE CotizacionHerramientas SET precioLista = precioLista*$exchangerate, moneda='mxn' WHERE cotizacionNo=$CotizacionNo AND factura=0 or factura=$CotizacionNo";
				    mysqli_query($conexion_usuarios, $insertSQL);	
			   }	  
				 
			}

			//set if changing type of invoice
			$Comentario = $_REQUEST["Comentario"];

			if (isset($Comentario)) {
			$insertSQL = "UPDATE cotizacion SET Comentario='".$Comentario."' WHERE id=".$CotizacionNo;
				 mysqli_query($conexion_usuarios, $insertSQL);
				 
				 
			}

			//set if adding a tool from another pedido
			$agregarHerrFactura = $_REQUEST["agregarHerrFactura"];
			$numero = $_REQUEST["numero"];
			if (isset($agregarHerrFactura)) {
			$insertSQL = "UPDATE cotizacionHerramientas SET factura='".$numero."' WHERE id=".$agregarHerrFactura;
				 
				 mysqli_query($conexion_usuarios, $insertSQL);
				 ActualizarTablaCotizacion($agregarHerrFactura);
				  ActualizaTablaCotizacion($agregarHerrFactura, $numero);
			}
			 ?> 

				<?php 
					if (isset($factura1))
				  		echo '<body onLoad="self.focus();document.CambiarPago.factura.focus()">';
					
					if (isset($Pago1))
				  		echo '<body onLoad="self.focus();document.CambiarPago.Pago.focus()">';

				 ?> 

			<!-- Información de contacto -->
				<div class="container-fluid row center-xs col-sm-12">
					<div class="col-sm-8">
						<table class="table stripe" cellspacing="0" width="100%">
							<?php
								if (isset($deMenu)) {
									$insertSQL = "SELECT partidaCantidad FROM `Cotizacion` WHERE id=$id";
									$result = mysqli_query($conexion_usuarios, $insertSQL);
									$row = mysqli_fetch_array($result);
									$NOPartidas=$row['partidaCantidad'];
									$id='0';
								}
											 
								$insertSQL = "SELECT * FROM Cotizacion where id=".$CotizacionNo;
								$result1 = mysqli_query($conexion_usuarios, $insertSQL);
								$row1 = mysqli_fetch_array($result1);
								$cliente=$row1['cliente'];
								$IVA=$row1['IVA'];

								if (isset($Pago2)) {
									$Pago+=$row1['Pagado'];
									mysqli_query($conexion_usuarios, "UPDATE `cotizacion` SET `Pagado` = ".$Pago." WHERE `id` = $CotizacionNo"); 
									mysqli_close($conn);
								}  
						
								if (isset($factura2)) {
						   			if (isset($decotizacion)) {
									 	mysqli_query($conexion_usuarios, "UPDATE `cotizacionherramientas` SET `Pedido` = 'si',`pedidoFecha` = Now() WHERE `CotizacionNo` = $CotizacionNo");
									 	$insertSQL="UPDATE `cotizacion` SET `Pedido` = Now() WHERE `id` = ".$CotizacionNo;
							 	   		mysqli_query($conexion_usuarios, $insertSQL);
									}			
						    					
						    		if (isset($factura) and $factura!=0) {
										$insertSQL = "SELECT factura FROM cotizacion WHERE factura=".$factura;
						       			$result=mysqli_query($conexion_usuarios, $insertSQL);
						       			$num_rows = mysqli_num_rows($result);
									 	
									 	if ($num_rows==0) {
						         			 mysqli_query($conexion_usuarios, "UPDATE `cotizacion` SET `factura` = ".$factura." WHERE `id` = $CotizacionNo");
									    	mysqli_query($conexion_usuarios, "UPDATE `cotizacionherramientas` SET `Entregado` = now() WHERE `CotizacionNo` = $CotizacionNo");
						       			} else {
						          			echo '<i><big><FONT COLOR="ff0000">EL NUMERO DE FACTURA YA EXISTE EN LA SISTEMA!!!!</FONT></big><b></i></b>';
									 	}
									 	$nuevoEntrega=2;
							  		} 
						    		
						    		if (isset($facturaFecha)) {
						       			mysqli_query($conexion_usuarios, "UPDATE `cotizacion` SET `facturaFecha` = '".$facturaFecha."' WHERE `id` = $CotizacionNo");
							  		} 
						    		
						    		if (isset($NoPedClient))
						    	 		mysqli_query($conexion_usuarios, "UPDATE `cotizacion` SET `NoPedClient` = '".$NoPedClient."' WHERE `id` = $CotizacionNo"); 
								 
									// if(!empty($NoPedClient)){
									// 	mysqli_query($conexion_usuarios, "UPDATE `cotizacionherramientas` SET `descripcion` =concat( `descripcion` ,  '   (".$NoPedClient.")' ) WHERE `cotizacionNo` = $CotizacionNo");
									// }

						   			if (isset($nuevoComentario))
					   			 		mysqli_query($conexion_usuarios, "UPDATE `cotizacion` SET `Comentario`='".$nuevoComentario."' WHERE `id`=$CotizacionNo");
						 			}  

									$result = mysqli_query($conexion_usuarios, "SELECT * FROM Contactos WHERE id=$cliente");
					   				$row = mysqli_fetch_array($result);
					         		echo "<tr><center><font size='5px'><p><b><a href='../../hemusa/contactos/ensenarContacto.php?id=".$row['id']."' >".$row['nombreEmpresa']."</a></b></p></font></center></tr>";
									 		echo "<tbody><th>RFC</th><th>Calle</th><th>Colonia</th><th>Ciudad</th><th>CP</th>";
									 		echo "<tr><td>".$row['RFC']."</td><td>".$row['calle']."</td><td>".$row['colonia']."</td>";
									 		echo "<td>".$row['ciudad']."</td><td>".$row['cp']."</td></tr>";
									 		echo "<tr><th>Nombre</th><th>Tel.</th><th>Fax</th><th>Email</th><th></th></tr>";
									 		echo "<tr><td>".$row['personaContacto'].".</td><td>TLF: ".$row['tlf1']."</td><td>".$row['fax']."</td><td>".$row['correoElectronico']."</td><td></td></tr></tbody>";
								 ?>
						</table>
					</div>
				</div>
				<div class="container-fluid row center-xs col-sm-12">
					<div class="col-sm-10">
				<?php
					$insertSQL = "SELECT * FROM Cotizacion where id=".$CotizacionNo;
			   		$result = mysqli_query($conexion_usuarios, $insertSQL);
				 	$row = mysqli_fetch_array($result);
						
						echo '<div class="row start-xs col-sm-12">';
						    echo '<div class="col-sm-3 form-group"><p class="col-sm-4">Factura: </p><p class="col-sm-7">';
							
							if ($factnew=='new') {
								if($row['factura'] =='0' or $row['factura']==''){
									echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
									echo '<input class="form-control" type="text" name="factnew" value="'.$row['factura'].'" />
										<input class="btn btn-primary" type="submit" value="cambiar" />';
									echo '</form></div>';
								}else{
									if($nivel_usuario != 0){
										echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
										echo '<input class="form-control" type="text" name="factnew" value="'.$row['factura'].'"  readonly/><input class="btn btn-primary" type="submit" value="cambiar"  disabled/>';
										echo '</form></div>';
										echo "<script type=\"text/javascript\">alert(\"Para cancelar contacte Usuario Administrador \");</script>"; 
									}else{
										echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
										echo '<input class="form-control" type="text" name="factnew" value="'.$row['factura'].'" /><input class="btn btn-primary" type="submit" value="cambiar" />';
										echo '</form></div>';			
									}
								}
							}else{
								echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&factnew=new">'.$row['factura'].'</a></p></div>';
							}

						$fechaFactura=$row["facturaFecha"];
						echo '<div class="col-sm-3 form-group"><p class="col-sm-4">Fecha: </p><p class="col-sm-7">'.substr($row["facturaFecha"],8,2).'/'.substr($row["facturaFecha"],5,2).'/'.substr($row["facturaFecha"],0,4).'</p></div><div class="col-sm-3"><p class="col-sm-4 form-group">No. de OC: </p><p class="col-sm-7">'.$row['NoPedClient'].'</p></div><div class="col-sm-3 form-group">';
						
						
						echo "<p class='col-sm-4'>Descuento:</p><p class='col-sm-7'> ";
						
						if ($descuento=='new') {
							echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
							echo '<input type="text" name="descuento" value="'.$row[descuento].'" /><input type="submit" value="cambiar" />';
							echo '</form></p></div>';
						} else {
						   echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&descuento=new">'.$row[descuento].'</a></p></div>';
						}
			   			echo '<div class="col-sm-3 form-group"><p class="col-sm-4">Moneda:</p><p class="col-sm-7"> ';
						if ($row['moneda']=='usd')
						   echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&moneda=mxn">'.$row['moneda'].'</a></p></div>';
						else
						   echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&moneda=usd">'.$row['moneda'].'</a></p></div>';
						$moneda=$row['moneda'];
			      		echo '<div class="col-sm-3 form-group"><p class="col-sm-4">No. de Guia: </p><p class="col-sm-7">';

						if ($guia=='new') {
							 echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
							 echo '<input type="text" name="guia" value="'.$row[guia].'" /><input type="submit" value="cambiar" />';
							 echo '</form></p></div>';
						}else {
						   	if ($row[guia]=='') 
						      	echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&guia=new">x</a></p></div>';
			         		else
						      	echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&guia=new">'.$row[guia].'</a></p></div>';
						}
						
						$sql_iva = "SELECT IVA FROM cifrasimportantes where id=1";
						$resultiva = mysqli_query($conexion_usuarios, $sql_iva);
			   			$rowiva= mysqli_fetch_array($conexion_usuarios, $resultiva);
			   
						$iva=$rowiva['IVA'];
				 		$precioIva=(1+$iva)*$row["precioTotal"];
			   			echo "<div class='col-sm-3 form-group'><p class='col-sm-4'>Pagado:</p><p class='col-sm-7'>".$row[Pagado]." / ".$precioIva." (".$row[fechaPago].")</p></div>";
			      		echo '<div class="col-sm-3 form-group"><p class="col-sm-4">Comision: </p><p class="col-sm-7">';
						
						if ($comision=='new') {
							echo '<form action="verPedido.php?CotizacionNo='.$CotizacionNo.'" method="post">';
							echo '<input type="text" name="comision" value="'.$row['comision'].'" /><input type="submit" value="cambiar" />';
							echo '</form></p></div>';
						} else {
				       		echo '<a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&comision=new">'.$row['comision'].'</a></p></div>';
						}

			 	 	$insertSQL="select * from contactosPersonas where empresa = $cliente and personaContacto='FACTURA' order by id";
					$resultFactura = mysqli_query($conexion_usuarios, $insertSQL);
			    	$num_rows = mysqli_num_rows($result);
			 
					if (isset($sigue)) {
						$result = mysqli_query($conexion_usuarios, "SELECT id FROM CotizacionHerramientas");
			  			$insertSQL = "INSERT INTO `Cotizacion` ( `ref` , `cliente` , `contacto` , `fecha`, `TiempoEntrega`, `CondPago`, `Otra`) VALUES ('$numero', $cliente, '$contacto', '$fecha', '$TiempoEntrega', '$CondPago', '$Otra')";
						mysqli_query($conexion_usuarios, $insertSQL);
			      	 	$result = mysqli_query($conexion_usuarios, "SELECT id FROM Cotizacion order by id");
			      	 	while ($row = mysqli_fetch_array($result)) {
			         		$CotizacionNo=$row['id'];
				    	}
						mysqli_close($conn);
						$NOPartidas=0;
				    }
				 
				 	$fechaEntregado=$row["fechaEntregado"];

				 	if (isset($nuevoEntrega) and $nuevoEntrega!='') {
					  	if ($nuevoEntrega=='2') {
							$today = getdate(); 
			      	 		$fechaEnt = $today[year]."-".$today[mon]."-".$today[mday];
							 $insertSQL = 'select * from cotizacionHerramientas where id='.$id;
							 $resultEnt=mysqli_query($conexion_usuarios, $insertSQL);
							 $rowEnt = mysqli_fetch_array($resultEnt);
							 if ($rowEnt['cliente']!=611 and $rowEnt['Entregado']=='0000-00-00') {
				    	   $insertSQL = "update Precio".$rowEnt[marca]." set enReserva=enReserva-".$rowEnt[cantidad]." where ref='".$rowEnt[modelo]."'";
						   }
							 mysqli_query($conexion_usuarios, $insertSQL);
					  } else {
					  	$fechaEnt = '0000-00-00';
						
							$insertSQL = 'select * from cotizacionHerramientas where id='.$id;
							$resultEnt=mysqli_query($conexion_usuarios, $insertSQL);
							$rowEnt = mysqli_fetch_array($resultEnt);
							 if ($rowEnt[cliente]!=611 and $rowEnt['Entregado']!='0000-00-00') {
				    	   $insertSQL = "update Precio".$rowEnt[marca]." set enReserva=enReserva+".$rowEnt[cantidad]." where ref='".$rowEnt[modelo]."'";
							 }
							mysqli_query($conexion_usuarios, $insertSQL);
						}
			      mysqli_select_db("hemusa");
			  		$insertSQL = "UPDATE `cotizacionherramientas` SET `Entregado` = '".$fechaEnt."' WHERE `id` = ".$id;

						
						 
			      $result = mysqli_query($conexion_usuarios, $insertSQL);
				 }
				echo '<div class="row between-xs col-sm-11 form-group">';
				 echo '<tr valign=top><td>No. de Pedido: <b>'.$row1[ref].'</b></td><td>Fecha: <b>'.substr($row1[fecha],8,2)."/".substr($row1[fecha],5,2)."/".substr($row1[fecha],0,4).'</b></td><td>Hecho por: <b>'.$row1[contacto].'</b></td><td align=right valign=top>Proveedor</td><td>';

										$insertSQL = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Proveedor' order by nombreEmpresa";
										$result1 = mysqli_query($conexion_usuarios, $insertSQL);
										echo '<form name="todo" action="verPedido.php?CotizacionNo='.$CotizacionNo.'&noDePedido='.$CotizacionNo.'" method="post">';
										echo '<select class="form-control" name="Proveedor" onChange="document.todo.submit()"><option value="None">Elegir</option><option value="None">None</option>';
										if ($row["Proveedor"]=="ALMACEN")
											 echo '<option value="ALMACEN" selected="selected">ALMACEN</option>';
										else	 
											 echo '<option value="ALMACEN">ALMACEN</option>';
										while ($row1 = mysqli_fetch_array($result1)) {
													if ($row["Proveedor"]==strtoupper($row1["nombreEmpresa"])) {
											 			 echo '<option value="'.strtoupper($row1["nombreEmpresa"]).'" selected="selected">'.strtoupper(substr($row1["nombreEmpresa"],0,15)).'</option>';
										      } else {
										   			 echo '<option value="'.strtoupper($row1["nombreEmpresa"]).'">'.strtoupper(substr($row1["nombreEmpresa"],0,15)).'</option>';
													}
										}
										echo '</select></form>';
				 
				 
				 echo '</td></tr>';
				 echo '</div>';

				 $insertSQL = "SELECT * FROM CotizacionHerramientas where factura=$CotizacionNo or cotizacionNo=$CotizacionNo and factura=0 ORDER BY id";
			   $result = mysqli_query($conexion_usuarios, $insertSQL);
				 echo '<table class="table display start-xs form-group">';
			   echo '<tr><th><center><b><a  style="text-decoration: none;" href="../verPedido.php?CotizacionNo='.$CotizacionNo.'">#</a></b></center></th><th><b>Marca</b></th><th><b>Modelo</b></th><th><b>Descripcion</b></th>
			   <th><b>NoSerie.</b></th>
			   <th><b>Cantidad</b></th><th><b>Precio Unidad</b></th><th><b>Precio Total</b></th>
			   <th>Ref. Interna </th><th>Lugar Cotizaci&oacute;n</th>
			   <th><b>';
			   
			   //echo'<a  style="text-decoration: none;" href="verPedido.php?CotizacionNo='.$CotizacionNo.'&Entrega=todo">Entr.</a></b></td>';
			   echo "Entr.</b></th>";
			   echo'<th><b>Alm.</b></th><th><b>Proveedor</b></th><th><b>Split</b></th>
			   
			   </tr>';
				 $insertSQL = "SELECT * FROM Cotizacion where id=".$CotizacionNo;
			 	 $result3 = mysqli_query($conexion_usuarios, $insertSQL);
			 	 $row3 = mysqli_fetch_array($result3);
				 $total=0;$IVAmenos=0;$i=1;$TodoEntregado='si';
				 while ($row = mysqli_fetch_array($result)) {
				   if ($imprimir!=1) { 
						    echo '<tr>';
						 echo '<td valign="top"><center><a  style="text-decoration: none;" href="verPedido.php?iReg='.$i.'&CotizacionNo='.$CotizacionNo.'&idPartida='.$row["id"].'&factor='.$factor.'">'.$i.'</a></center></td>';
				     if ($row["recibidoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
						    echo '<td style="color: green" valign="top">';
				     elseif ($row["enviadoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
						    echo '<td style="color: orange" valign="top">';
						 else
						    echo '<td style="color: red" valign="top">';			 
						 echo $row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">';
						 echo str_replace( "\r\n","<br>", $row["descripcion"]).'</td>';
						 echo "<td>".$row["NoSerie"]."</td>";
						 echo'<td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">'.round($row["precioLista"]*(100-$row3['descuento'])/100,2);
						 $TAL=round($row["precioLista"]*(100-$row3['descuento'])/100,2);
					   $tal = ROUND($TAL,2);
					 	 if (strstr($tal,".")) {
						  	$len = strlen($tal);
								if (substr($tal,strlen($tal)-2,1)==".") {
			           	 echo "0";
			        	}
			     	 } else {
						 	 echo ".00";
			     	 } 
			  	 echo '</td><td valign="top" align="right">'.$row["cantidad"]*round($row["precioLista"]*(100-$row3['descuento'])/100,2);
					 $TAL=$row["cantidad"]*round($row["precioLista"]*(100-$row3['descuento'])/100,2);
					 $tal = ROUND($TAL,2);
					 if (strstr($tal,".")) {
							$len = strlen($tal);
							if (substr($tal,strlen($tal)-2,1)==".") {
			         	 echo "0";
			        }
			     } else {
						 echo ".00";
			     } 
					 
						 echo '</td>';
						  echo "<td>".$row["referencia_interna"]." </td>";
						 echo "<td>".$row["lugar_cotizacion"]." </td>";
						 echo'<td valign="top">';
						 if ($row["Entregado"]!='0000-00-00') {
						 //  echo '<a  style="text-decoration: none;" href="verPedido.php?nuevoEntrega=1&CotizacionNo='.$CotizacionNo.'&id='.$row["id"].'">'.$row["Entregado"]."</a>";
						echo"".$row["Entregado"];
							 $hayEntregas=1;
						 } else {
						  // echo '<a  style="text-decoration: none;" href="verPedido.php?nuevoEntrega=2&CotizacionNo='.$CotizacionNo.'&id='.$row["id"].'&factor='.$factor.'">No</a>';
						  echo "No";
							 $TodoEntregado='no';
						 }
						 echo '</td><td>';
					    $stock=&buscar_stock($row["marca"], $row["modelo"]); // funcion que busca la existencia
						echo $stock;
						 echo '</td>';
						 
								$insertSQL = "SELECT nombreEmpresa FROM contactos WHERE tipo = 'Proveedor' order by nombreEmpresa";
								$result1 = mysqli_query($conexion_usuarios, $insertSQL);
								echo '<form name="id'.$row["id"].'" action="verPedido.php?CotizacionNo='.$CotizacionNo.'&id='.$row["id"].'" method="post">';
								echo '<td><select class="form-control" name="Proveedor" onChange="document.id'.$row["id"].'.submit()"><option value="None">None</option>';
								
								if ($row["Proveedor"]=="ALMACEN")
									echo '<option value="ALMACEN" selected="selected">ALMACEN</option>';
								else	 
									echo '<option value="ALMACEN">ALMACEN</option>';
								
								while ($row1 = mysqli_fetch_array($result1)) {
									//row1 esla consulta de proveedorees, row es la el proveedor actual del pedido
									if ($row["Proveedor"]==strtoupper($row1["nombreEmpresa"])) {
										echo '<option value="'.strtoupper($row1["nombreEmpresa"]).'" selected="selected">'.substr(strtoupper($row1["nombreEmpresa"]),0,20).'</option>';
									}else{
										echo '<option value="'.strtoupper($row1["nombreEmpresa"]).'">'.substr(strtoupper($row1["nombreEmpresa"]),0,20).'</option>';
													}
								}
								echo '</td>';
								echo '</form>';

										if ($idSplit==$row["id"]) {
										   echo '<td>';
											 echo '<form action="verPedido.php" method="post">';
											 echo '<input type="hidden" name="CotizacionNo" value="'.$CotizacionNo.'" />';
											 echo '<input type="hidden" name="idSplit" value="'.$idSplit.'" />';
											 echo '<input class="form-control" type="text" name="cantidadSplit" />';
											 echo '<input class="btn btn-primary" type="submit" name="split" value="Split" />';
											 echo '</form>';
											 echo '</td>';
						        } elseif ($row["Entregado"]=='0000-00-00' and $row["cantidad"]>1) {
										 	 echo '<td><a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&idSplit='.$row["id"].'">Split</a></td>';
						        } else {
										   echo '<td>No Split</td>';
						        }
						 
						
						 echo '</tr>';
				   } else {
					   echo '<tr><td valign="top"><center>'.$i.'</center></td><td valign="top">'.$row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">'.$row["descripcion"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">'.round($row["precioLista"]).'.00</td></tr>';
					 }
					 echo $row1['descuento'];
						 $total+=$row["cantidad"]*$row["precioLista"]*(100-$row3['descuento'])/100;
						 if ($row["IVA"]=='no')
						    $IVAmenos+=$row["cantidad"]*$row["precioLista"]*(100-$row3['descuento'])/100;
						 $i++;
			   }
				 



					if (isset($imprimir)==0) {
				   echo "<form name='agregarPartida1' action='verPedido.php?CotizacionNo=".$CotizacionNo."' method='post'>"; 
			     if (isset($set)) {
				     $marca1=$marcaSet;
				     $modelo1=$modeloSet;
				     $descripcion1=str_replace( "\r\n","<br>", $descripcionSet);
				     $precioBase=$precioUnidadSet;
					 } elseif (isset($refBusca) and $refBusca!='') {
						      if ($marca1=='') {
			  		 		     $marca1 = $_REQUEST["marca1"];
									}
						 		  $insertSQL1="SELECT * FROM MarcaDeHerramientas WHERE marca='".$marca1."'";
									$result1 = mysqli_query($conexion_usuarios, $insertSQL1);
									$r = mysqli_fetch_array($result1);
									$marca1=$r["marca"];
									$insertSQL="SELECT * FROM Precio".$marca1." WHERE ref='".$refBusca."'";
			  					$result = mysqli_query($conexion_usuarios, $insertSQL);
									$row = mysqli_fetch_array($result);
				       		$modelo1=strtoupper($refBusca);//$row["ref"];
				       		$descripcion1=str_replace( "\r\n","<br>",$row["descripcion"]);
				       		$cantidad1=$row["cantidad"];
				       		$precioBase=round($row["precioBase"]*$r["factor"],2);
						 } elseif (isset($idPartida) and $idPartida!='0') {
				 			$insertSQL = "SELECT * FROM CotizacionHerramientas where id=$idPartida";
			   			 	$result = mysqli_query($conexion_usuarios, $insertSQL);
				       		$row = mysqli_fetch_array($result);
							$marca1=$row["marca"];
				       		$modelo1=$row["modelo"];
							$referencia_interna=$row["referencia_interna"];
							$lugar_cotizacion=$row["lugar_cotizacion"];
							$NoSerie=$row["NoSerie"];
							
				       		$descripcion1=str_replace( "\r\n","<br>",$row["descripcion"]);
				       		$cantidad1=$row["cantidad"];
				       		$precioBase=$row["precioLista"];
							$material_entregado=$row["Entregado"];
				   	 }
						 if (isset($iReg))
						 			
						
						 
				     		echo '<tr><td valign="top" align="center">'.$iReg.'</td>';
						 else		
								echo '<tr><td valign="top" align="center">'.$i.'</td>';
						 		echo '<td valign="top"><input class="form-control" type="text" name="marca" size="10" value="'.$marca1.'"/></td>';
				     		echo '<td valign="top"><input class="form-control" type="text" name="modelo" size="10" value="'.$modelo1.'"/></td>';
				     		echo '<td valign="top"><textarea class="form-control" name="descripcion" rows="6" cols="35" value="">'.$descripcion1.'</textarea></td>';
							
							
								echo '<td align="center" valign="top"> <input class="form-control" type="text" name="NoSerie" 
							size="10" value="'.$NoSerie.'"/></td>'; 
							
							
							
							if($material_entregado!='0000-00-00'and isset($iReg)){
								echo '<td valign="top"><input class="form-control" type="text" name="cantidad" size="10" value="'.$cantidad1.'" disabled/></td>';	
								
			echo '<script>alert("Para editar cantidad quite entregado, y verifique cantidad correcta en almacen .");</script>';
								}
								else{
				     		echo '<td valign="top"><input class="form-control" type="text" name="cantidad" size="10" value="'.$cantidad1.'"/></td>';
								}
						 if (isset($iReg))
				     		echo '<td valign="top" align="right"><input class="form-control" type="text" name="precioUnidad" size="10" value="'.round($precioBase,2).'"/></td>';
						 else		
				     		echo '<td valign="top" align="right"><input class="form-control" type="text" name="precioUnidad" size="10" value="'.round($precioBase*$exchangerate,2).'"/></td>';
				 		 $insertSQL = "SELECT descuento FROM descuentos where client=$cliente and marca='$marca1'";
			   		 $resultDescuento = mysqli_query($conexion_usuarios, $insertSQL);
				     $rowDescuento = mysqli_fetch_array($resultDescuento);
						 if ($rowDescuento['descuento']!='' and $iReg!='1') {
				     		echo '<td valign="top" align="right"><input class="form-control" type="text" name="factor" size="10" value="'.$rowDescuento['descuento'].'" /></td>';
								
						 } else {
				     		echo '<td valign="top" align="right"><input class="form-control" type="text" name="factor" size="10" value="'.$factor.'" /></td>';
						 }
				   			if (isset($idPartida) and $idPartida!='0') {
				     			 
								 
								echo '<td align="center" valign="top"> <input class="form-control" type="text" name="referencia_interna" 
							size="10" value="'.$referencia_interna.'"/></td>'; 
							echo '<td align="center" valign="top"><input class="form-control" type="text" name="lugar_cotizacion" 
							size="10" value="'.$lugar_cotizacion.'"/>';
								 echo '<br><input type="hidden" name="idPartida" value="'.$idPartida.'" />';
				     			 echo '<input class="btn btn-primary" type="submit" name="editar" value="Editar" /><br> ';
				     			 echo '<br><input class="btn btn-danger" type="submit" name="suprimir"  value="Suprimir" />';
								//echo '<br><input type="button" name="suprimir" onclick="showPopup()" value="Eliminar" />';
				        } else {
							
								echo '<td align="center" valign="top"> <input class="form-control" type="text" name="referencia_interna" 
							size="10" value=""  placeholder="(Opcional)"/></td>'; 
							echo '<td align="center" valign="top"><input class="form-control" type="text" name="lugar_cotizacion" 
							size="10" value=""  placeholder="Lugar de Cotizaci&oacute;n (Opcional)"/></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
				     		   echo '<td><input class="btn btn-primary" type="submit" name="agregar" value="Agregar" />';
				        }
						 		echo '</td>';	 
			       		echo '<tr>';	 
				   			echo '</form>';
			       }

				 	$i--;
				 
			   		mysqli_query($conexion_usuarios, "UPDATE `Cotizacion` SET `precioTotal` = $total WHERE `id` = $CotizacionNo"); 
			   		$result = mysqli_query($conexion_usuarios, $insertSQL);	 
			   		mysqli_query($conexion_usuarios, "UPDATE `Cotizacion` SET `partidaCantidad` = $i WHERE `id` = $CotizacionNo"); 
			   		$result = mysqli_query($conexion_usuarios, $insertSQL);	 

				echo '</table>';
				?>
			<!-- Tabla de Total, IVA y Gran Total-->
				<div class="container-fluid row center-xs col-sm-12">
					<div class="col-sm-offset-7 col-sm-3">
						<?php
							if ($imprimir!=1) { 
						   		echo '<table class="table table-hover start-xs" cellspacing="0" width="100%">';
						   		echo '<thead><tr><th>Total ('.$moneda.')</th><th>IVA</th><th>Gran Total</th></thead>';
								$insertSQL = "SELECT * FROM Cotizacion where id=".$CotizacionNo;
						 		$result1 = mysqli_query($conexion_usuarios, $insertSQL);
					   	 		$row1 = mysqli_fetch_array($result1);
							 	
							 	if ($row1['descuento']!=0) {
							 		echo '<td><b>Desc.</b></td></tr>';
							 	}	 
							 
							 	echo '<tr><td>$ '.round($total,2);
							 	$TAL=$total;
							 	$tal = ROUND($TAL,2);
							 	
							 	if (strstr($tal,".")) {
								  	$len = strlen($tal);
									if (substr($tal,strlen($tal)-2,1)==".") {
					           			echo "0";
					        		}
					     		}else{
								 	echo ".00";
					     		} 
							 	
							 	echo '</td>';		 
						   		echo '<td>$ ';
							 	echo round(round($total,2)*$IVA,2)-($IVA*$IVAmenos);
							 	$TAL1=round($total,2)*$IVA-($IVA*$IVAmenos);
							 	$tal = ROUND($TAL1,2);
							 	
							 	if (strstr($tal,".")) {
								  	$len = strlen($tal);
									if (substr($tal,strlen($tal)-2,1)==".") {
					           			echo "0";
					        		}
					     		}else{
								 	echo ".00";
					     		} 
							 	
							 	echo '</td>';		 
						   		echo '<td>$ ';
							 	$TAL=round($total,2)+ROUND($total*$IVA,2)-($IVA*$IVAmenos);
							 	echo $TAL;
							 	$tal = ROUND($TAL,2);
							 	
							 	if (strstr($tal,".")) {
								  	$len = strlen($tal);
									if (substr($tal,strlen($tal)-2,1)==".") {
					           			echo "0";
					        		}
					     		}else{
								 	echo ".00";
					     		}	 
							 	
							 	echo '</td>';	
							 	
							 	if ($row1['descuento']!=0) {
							 		echo '<td align=right>'.$row1['descuento'].'%</td></tr>';
							 	}	 
					     		
					     		echo '</table>';
						 	}else{
						   		echo '<table align="right">';
						   		echo '<tr><td><b>Total Pedido (más IVA)</b></td><td align="right" width="60"><b>'.round($total).'.00</b></td></tr>';
					     		echo '</table>';
					   		}	   
					 	 	
					 	 	$insertSQL = "SELECT * FROM Cotizacion where id=".$CotizacionNo;
						 	$result1 = mysqli_query($conexion_usuarios, $insertSQL);
					   		$row1 = mysqli_fetch_array($result1);
						 	echo "<p class='col-sm-12'><b>Tiempo de entrega: </b>";
						 	
						 	if ($row1["TiempoEntrega"]==0) {
						    	echo " Inmediata";
						 	}else{
						 		echo $row1["TiempoEntrega"]." dias</p>";
						 	}
						 
						 	echo "<p class='col-sm-12'><b>Condiciones de pago: </b> ";
						 	
						 	if ($row1["CondPago"]==0) {
						    	echo "Contado";
						 	}else{
						 		echo $row1["CondPago"]." dias</p>";
						 	}
						 	
						 	if ($row1["Otra"]!=""){
						   		echo "Otra: ".$row1["Otra"];
						 	}

						 	if (($TodoEntregado=='si') and ($fechaEntregado=='0000-00-00')) {
						   		$insertSQL="UPDATE `cotizacion` SET `fechaEntregado` = now() WHERE id=".$CotizacionNo;
						   		mysqli_query($conexion_usuarios, $insertSQL);
						 	}elseif (($TodoEntregado=='no') and ($fechaEntregado!='0000-00-00')) {
						   		$insertSQL="UPDATE `cotizacion` SET `fechaEntregado` = '0000-00-00' WHERE id=".$CotizacionNo;
						   		mysqli_query($conexion_usuarios, $insertSQL);
						 	}	   
						?>
					</div>
				</div>
				<div class="container-fluid center-xs col-sm-offset-1 col-sm-10">
					<hr>	
				</div>
			<!-- Con Remisión, Sin Remisión -->
				<div class="container-fluid row center-xs col-sm-12">
					<?php
						// Mostrando herramientas de remisiones sin factura
						echo '<div class="col-sm-12 form-group"><a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&PedidoConRemision=1"><button class="btn btn-danger">Con Remision</button></a></div>';
						
						if($_GET['PedidoConRemision']=="1" ){	
							$insertSQL = "SELECT * FROM CotizacionHerramientas where remision!=0 AND factura=0 AND cliente=$cliente ORDER BY modelo";
					   		$result = mysqli_query($conexion_usuarios, $insertSQL);
					   		echo '<div class="row">';		
						 	echo '<table class="mdl-data-table display start-xs">';
					   		echo '<tr>
					   				<th>#</th>
					   				<th>Marca</th>
					   				<th>Modelo</th>
					   				<th>Descripcion</th>
					   				<th>Cantidad</th>
					   				<th>Precio Unidad</th>
					   				<th>Agregar</th>
					   			</tr>';
						 	$i=1;
						 	
						 	while ($row = mysqli_fetch_array($result)) {
						   		if ($imprimir!=1) { 
						     		echo '<tr><td>';
								 	
								 	if ($moneda==$row["moneda"]) {
								    	echo '<a style="text-decoration: none;" href="verPedido.php?agregarHerrFactura='.$row["id"].'&numero='.$CotizacionNo.'&fecha='.$fecha.'&contacto='.$contacto.'&CotizacionNo='.$CotizacionNo.'&cliente='.$cliente.'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'&PedidoConRemision=1">'.$i.'</a>';
								 	}else{
						        		echo $i;								
								 	}
								 
								 	echo '</td>';
							   		
							   		if ($row["recibidoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
								   		echo '<td style="color: green" valign="top">';
					       			elseif ($row["enviadoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
								    	echo '<td style="color: orange" valign="top">';
						     		else
								    	echo '<td style="color: red" valign="top">';			 		 
								 	
								 	echo $row["marca"].'</td><td>'.$row["modelo"].'</td><td>';
								 	echo str_replace( "\r\n","<br>", $row["descripcion"]).' (R'.$row["remision"].$row["moneda"].')</td><td>'.$row["cantidad"].'</td><td>'.round($row["precioLista"],2);
								 	$TAL=round($row["precioLista"],2);
							   		$tal = ROUND($TAL,2);
							 	 	
							 	 	if (strstr($tal,".")) {
								  		$len = strlen($tal);
										if (substr($tal,strlen($tal)-2,1)==".") {
					           	 		echo "0";
					        			}
					     	 		}else{
								 	 	echo ".00";
					     	 		} 
					  	 	 		
					  	 	 		echo '</td>';	 
								 	echo '<td>';
								 	echo '<a style="text-decoration: none;" href="verPedido.php?agregarHerrFactura='.$row["id"].'&numero='.$CotizacionNo.'&fecha='.$fecha.'&contacto='.$contacto.'&CotizacionNo='.$CotizacionNo.'&cliente='.$cliente.'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'&PedidoConRemision=1"><center>x</center></a>';
								 	echo '</td>';		 
								 	echo '</tr>';
						   		}else{
							   		echo '<tr><td valign="top"><center>'.$i.'</center></td><td valign="top">'.$row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">'.$row["descripcion"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">'.round($row["precioLista"]).'.00</td></tr>';
							 	}
								
								$i++;
					   		}
						 	
						 	$i--;
						 	echo '</table>';
						 	echo '</div>';
						}

						echo '<div class="col-sm-12 form-group"><a href="verPedido.php?CotizacionNo='.$CotizacionNo.'&PedidoSinRemision=1"><button class="btn btn-danger">Sin Remision</button></a></div>';
							 
						if($_GET['PedidoSinRemision']=="1" ){		
							//showing tools not delivered but asked for without invoice
						 	$insertSQL = "SELECT * FROM CotizacionHerramientas where cotizacionNo!=$CotizacionNo AND pedidoFecha!='0000-00-00' AND Entregado='0000-00-00' AND factura=0 AND cliente=$cliente ORDER BY modelo";
					   		$result = mysqli_query($conexion_usuarios, $insertSQL);			
					   		echo '<table class="mdl-data-table start-xs">';
					   		echo '<tr><td width="15"><center><b>#</b></center></td>';
							echo '<td><b>Marca</b></td><td width="80"><b>Modelo</b></td><td width="300"><b>Descripcion</b></td><td width="5"><b>Cant.</b></td><td width="75"><b>Precio Unidad</b></td><td><b>Agregar</b></td></tr>';
						 	$i=1;
						 	while ($row = mysqli_fetch_array($result)) {
						   		if ($imprimir!=1) { 
						     		echo '<tr><td valign="top"><center>';
								 	if ($moneda==$row["moneda"]) {
								    	echo '<a style="text-decoration: none;" href="verPedido.php?agregarHerrFactura='.$row["id"].'&numero='.$CotizacionNo.'&fecha='.$fecha.'&contacto='.$contacto.'&CotizacionNo='.$CotizacionNo.'&cliente='.$cliente.'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'&PedidoSinRemision=1">'.$i.'</a>';
								 	}else{
						        		echo $i;								
								 	}
									echo '</center></td>';
							   		
							   		if ($row["recibidoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
								    	echo '<td style="color: green" valign="top">';
					       			elseif ($row["enviadoFecha"]!='0000-00-00' or strtoupper($row["Proveedor"])=='ALMACEN')
								    	echo '<td style="color: orange" valign="top">';
						     		else
								    	echo '<td style="color: red" valign="top">';			 
								 	echo $row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">';

							 	 	$insertSQL = "SELECT * FROM Cotizacion where id=".$row["cotizacionNo"];
								 	$resultSinRem = mysqli_query($conexion_usuarios, $insertSQL);
								 	$rowSinRem = mysqli_fetch_array($resultSinRem);
								 	echo str_replace( "\r\n","<br>", substr($row["descripcion"],0,20)).' ('.$rowSinRem["NoPedClient"].$rowSinRem["moneda"].')</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">'.round($row["precioLista"],2);
								 	$TAL=round($row["precioLista"],2);
							   		$tal = ROUND($TAL,2);
							 	 	
							 	 	if (strstr($tal,".")) {
								  		$len = strlen($tal);
										if (substr($tal,strlen($tal)-2,1)==".") {
					           	 			echo "0";
					        			}
					     	 		}else{
								 	 	echo ".00";
					     	 		} 
					  	 			
					  	 			echo '</td>';	 
								 	echo '<td valign="top">';
								 	echo '<a style="text-decoration: none;" href="verPedido.php?agregarHerrFactura='.$row["id"].'&numero='.$CotizacionNo.'&fecha='.$fecha.'&contacto='.$contacto.'&CotizacionNo='.$CotizacionNo.'&cliente='.$cliente.'&NOPartidas='.$NOPartidas.'&id='.$row["id"].'&PedidoSinRemision=1"><center>x</center></a>';
								 	echo '</td>';		 
								 	echo '</tr>';
						   		}else{
							   		echo '<tr><td valign="top"><center>'.$i.'</center></td><td valign="top">'.$row["marca"].'</td><td valign="top">'.$row["modelo"].'</td><td valign="top">'.$row["descripcion"].'</td><td valign="top" align="right">'.$row["cantidad"].'</td><td valign="top" align="right">'.round($row["precioLista"]).'.00</td></tr>';
							 	}
								$i++;
					   		}
						 	$i--;
						 	echo '</table>';
						}

						echo "<br><a href='verPedido.php?Pago1=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'></a>";
						echo "<div class='col-sm-12 form-group'><a href='verPedido.php?factura1=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'><button class='btn btn-primary'>Cambiar datos de la Factura</button></a></div>";

						if ($fechaFactura!='0000-00-00') {
					  		if ($row1[Comentario]=='credito') {
						   		echo "<a href='skabelon.php?factura1=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'>Imprimir Factura Grande</a><br>";
							}else{
						   		echo "<a href='skabelonMini.php?factura1=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'>Imprimir Factura Pequeño</a><br>";
							}
						}
					?>	
						<div class="col-sm-12 form-group">
					<?php
						echo "<a href='verPedido.php?Pago1=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'><button class='btn btn-primary'>Pago</button></a><br>";
					?>
						</div>
					<?php
						if (isset($Pago1)){
						 	echo "<form name='CambiarPago' action='verPedido.php?CCondP=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas' method='post'>"; 
						 	$rest=$row1[precioTotal]*(1+$IVA)-$row1[Pagado];
						 	echo 'Antes estaba pagado: '.$row1[Pagado].' más <input type="text" name="Pago" size="15" value="'.$rest.'"/>';
						 	echo '<input type="submit" name="Pago2" value="Pago" />';
					   		echo "</form>";
						}
					?>	
						<div class="col-sm-12 form-group">
					<?php
						if ($hayEntregas!=1)
						   echo "<a href='../cotizaciones/agregarCotizacion.php?cancelar=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas'><button class='btn btn-primary'>Cancelar</button></a><br><br>";
					?>
						</div>
						<div class="col-sm-12 form-group">
					<?php
						if (isset($factura1)){
						 	echo "<form name='factura0' action='verPedido.php?CCondP=1&numero=".$numero."&fecha=".$fecha."&contacto=".$contacto."&CotizacionNo=".$CotizacionNo."&cliente=$cliente&NOPartidas=$NOPartidas' method='post'><b><br>Cambio de Factura</b><br><br>"; 
						 	echo 'Numero Antes: '.$row1[factura].' - ya: <input type="text" name="factura" size="15" value="'.$row1[factura].'"/><br>';
						 	echo 'Fecha Antes: '.$row1[facturaFecha].' - ya: <input type="text" name="facturaFecha" size="15" value="'.$row1[facturaFecha].'"/><br>';
						 	echo 'No. de Pedido del Cliente: '.$row1[NoPedClient].' - ya: <input type="text" name="NoPedClient" size="15" value="'.$row1[NoPedClient].'"/><br>';
						 	echo 'Tipo Antes: '.$row1[Comentario].' - ya: <select name="nuevoComentario" class="small"><option value="contado" selected="selected">Contado</option><option value="credito" selected="selected">Credito</option></select><br>';
						 	echo '<input type="submit" name="factura2" value="cambio" />';
					   		echo "</form>";
						}
					?>
						</div>
				</div>
				<?php 

				//funcion para buscar el stock del modelo 
			function &buscar_stock($marca, $modelo)
			{	

			$sql_buscar_marca ="SELECT marca
			FROM  marcadeherramientas
			WHERE  `marca` = '".$marca."'";

			$res_marca=mysqli_query($conexion_usuarios, $sql_buscar_marca);
				if(mysqli_num_rows($res_marca) ==0 ){
				
				$almacen="N/A";
				}
				else{


				
			$sql_buscar_stock ="SELECT enReserva 
			FROM  `precio".$marca."` 
			WHERE  `ref` = '$modelo'";

			$almacen=0;
			$resultado_stock=mysqli_query($conexion_usuarios, $sql_buscar_stock);

			if(mysqli_num_rows($resultado_stock) > 0){
			while($row_stock =mysqli_fetch_array($resultado_stock)){
			$almacen=$row_stock['enReserva'];				

			}
			}
			else{
				$almacen="N/A";
				}
				}
			return $almacen;	
			}

			function ActualizarTablaCotizacion($IdCotizacionHerramientas){
				$Query="SELECT * FROM cotizacionherramientas where id=".$IdCotizacionHerramientas;
				 $resultadoQuery=mysqli_query($conexion_usuarios, $Query);
				  while($rowQuery=mysqli_fetch_array($resultadoQuery)){
					$IdCotizacion=$rowQuery['cotizacionNo'];	
					$Precio=$rowQuery['precioLista'];	
					$cantidad=$rowQuery['cantidad'];	
								
					}
				$QueryActualizar="UPDATE cotizacion SET  partidaCantidad = ((partidaCantidad)-1),
				precioTotal=((precioTotal)-(".$Precio."*".$cantidad."))
				 where id=".$IdCotizacion;
					mysqli_query($conexion_usuarios, $QueryActualizar);
					
					
				
				}
				
			function ActualizarTablaCotizacion2($IdCotizacionHerramientas,$Cotizacion){
					  
					  	$Query="SELECT * FROM cotizacionherramientas where id=".$IdCotizacionHerramientas;
				 $resultadoQuery=mysqli_query($conexion_usuarios, $Query);
				  while($rowQuery=mysqli_fetch_array($resultadoQuery)){
					$IdCotizacion=$rowQuery['cotizacionNo'];	
					$Precio=$rowQuery['precioLista'];	
					$cantidad=$rowQuery['cantidad'];	
								
					}
					
					
					if($Cotizacion!=$IdCotizacion){
				$QueryActualizar="UPDATE cotizacion SET  partidaCantidad = ((partidaCantidad)+1),
				precioTotal=((precioTotal)+(".$Precio."*".$cantidad."))
				 where id=".$IdCotizacion;
					mysqli_query($conexion_usuarios, $QueryActualizar);
					
					}
				
					
					
					}
					


			function ActualizaTablaCotizacion($IdCotHerramientas, $CotizacionNo){

				 $sqlInfo="SELECT cotizacionNo, factura FROM cotizacionherramientas 
				 WHERE id=".$IdCotHerramientas;
				$resultInfo= mysqli_query($conexion_usuarios, $sqlInfo);
			 	$Row= mysqli_fetch_array($resultInfo);
			    if ($Row['factura']=='0'){
			    	$IdTablaCotizacion=$Row['cotizacionNo'];
				}
				else{
					$IdTablaCotizacion=$Row['factura'];
					
					}
					
					if($Row['factura']==0 and $CotizacionNo != $IdTablaCotizacion ){
						ActualizaRecibido($CotizacionNo);
						}
							ActualizaRecibido($IdTablaCotizacion);
					

				 
				 
					
				
				}
				
				
				function ActualizaRecibido($IdTablaCotizacion){
							
			    //una ves que obtenemos el pedido al que pertenece la partida,
				//hacemos una consulta de todas las partidas de ese pedido, si todas tienen
				// recibido la columna REcibido de la tabla cotizacion es 1 , caso contrario es 0
			  $sqlInfo=" SELECT recibidoFecha  FROM `cotizacionherramientas`  WHERE (`factura` =".$IdTablaCotizacion." OR `cotizacionNo` =".$IdTablaCotizacion." AND factura =0)
			 and recibidoFecha='0000-00-00'
			  ";
			  
			 
			 $resultado = mysqli_query($conexion_usuarios, $sqlInfo);
			  if(mysqli_num_rows($resultado)>0){ // si almenos un registro del pedido tiene recibido '0'
			  // el pedido de la tala cotizacion en la columna recibido debe ser 0
				  
				 $sqlActualiza="UPDATE cotizacion SET Recibido=b'0' WHERE id=".$IdTablaCotizacion;
				  mysqli_query($conexion_usuarios, $sqlActualiza);
				  }
			 else{ // caso contrario pedido columna recibido es 1
				 
				  $sqlActualiza="UPDATE cotizacion SET Recibido=b'1' WHERE id=".$IdTablaCotizacion;
				  mysqli_query($conexion_usuarios, $sqlActualiza);
				 }
				 
				
				 
				
				// si el pedido ya no tiene partidas, se queda en recibido=0
				$sqlInfo=" SELECT recibidoFecha  FROM `cotizacionherramientas`  WHERE (`factura` =".$IdTablaCotizacion." OR `cotizacionNo` =".$IdTablaCotizacion." AND factura =0)
			  ";
			  
			 
			 $resultado = mysqli_query($conexion_usuarios, $sqlInfo);
			  if(mysqli_num_rows($resultado)==0){ 
			  
				 $sqlActualiza="UPDATE cotizacion SET Recibido=b'0' WHERE id=".$IdTablaCotizacion;
				  mysqli_query($conexion_usuarios, $sqlActualiza);
				  }
				
				
					
					
					}
					
					
					
					
							
					
					function splitUtilidadPedido($idCotherr, $idInsertar, $cantidad){
								
				 
						$sqlQeury="SELECT * FROM utilidad_pedido where 
						id_cotizacion_herramientas=".$idCotherr."";
						$resultQ=mysqli_query($conexion_usuarios, $sqlQeury);
						
						if(mysqli_num_rows($resultQ)>0){
						while ($rowQ= mysqli_fetch_array($resultQ)) {
						$id_cotizacion_herramientas=$idInsertar;	
						$orden_compra=$rowQ['orden_compra'];
						$fecha=$rowQ['fecha_orden_compra'];
						$numero_proveedor=$rowQ['proveedor'];
						$moneda_producto=$rowQ['moneda_pedido'];
						$numero_cliente=$rowQ['cliente'];
						$marca=$rowQ['marca'];
						$modelo=$rowQ['modelo'];

						$cantidad=$cantidad;
						$descripcion=$rowQ['descripcion'];		
						$tipo_cambio=$rowQ['tipo_cambio'];
						$costo_mn=$rowQ['costo_mn'];	
						$costo_usd=$rowQ['costo_usd'];
						$venta_mn=$rowQ['venta_mn'];	
						$venta_usd=$rowQ['venta_usd'];
						$folio=$rowQ['folio'];
						$pedimento=$rowQ['Pedimento'];
						$factura_proveedor=$rowQ['factura_proveedor'];
								
							$query_agregar_pedido= "INSERT INTO utilidad_pedido 
								(id, id_cotizacion_herramientas,
								 orden_compra,
								 fecha_orden_compra,
								 proveedor,
								 moneda_pedido,
								 cliente, marca,modelo, cantidad,descripcion, tipo_cambio,
								 costo_mn, costo_usd, venta_mn, venta_usd, folio, 
								 Pedimento, factura_proveedor)
								values 
								('','$id_cotizacion_herramientas',
								 '$orden_compra','$fecha', '$numero_proveedor', '$moneda_producto', '$numero_cliente',  '$marca',  '$modelo', '$cantidad','$descripcion',  '$tipo_cambio',  '$costo_mn',  '$costo_usd','$venta_mn','$venta_usd', '$folio', '$pedimento','$factura_proveedor')";

			if(!$resultadoU = mysqli_query($conexion_usuarios, $query_agregar_pedido)) {
				echo"<script>alert('Error al  agregar en utilidad_pedido ')</script>";	
				
				}
				
						
						}}
						
					
						
						
						}
				
				
				

			?>

		</main>
	</div>
</body>
</html>
