<?php 
  	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  	$ruta = "http://localhost/Hemusa/";
  	error_reporting(0);

  	if(!empty($_GET["embarque"])){
  		$folio_embarque=$_GET["embarque"];
    }

    if(!empty($_GET["id_cliente"])){
  		$id_cliente=$_GET["id_cliente"];
    }

    $sql_herramienta="SELECT * FROM embarques WHERE folio_embarque ='".$folio_embarque."' ";
	$result=mysqli_query($conexion_usuarios, $sql_herramienta);

		while($row=mysqli_fetch_array($result)){	
			$fecha=$row['fecha_embarque'];	
			$cliente=$row['cliente'];	
			$factura=$row['factura'];	
			$remision=$row['remision'];	
			$dimensiones=$row['dimensiones'];	
			$observaciones=$row['observaciones'];	
			$peso=$row['peso'];	
			// $nombre_cliente=&nombre_contacto($cliente);
		}

	$sqlCliente = "SELECT * FROM contactos WHERE id ='".$id_cliente."'";
	$resultCliente = mysqli_query($conexion_usuarios, $sqlCliente);
	while($row = mysqli_fetch_array($resultCliente)){
		$nombreCliente=$row['nombreEmpresa'];
		$calleCliente=$row['calle'];	
		$numeroIntCliente=$row['NumInt'];	
		$numeroExtCliente=$row['NumExt'];	
		$coloniaCliente=$row['colonia'];
		$ciudadCliente=$row['ciudad'];
		$estadoCliente=$row['estado'];
		$cpCliente=$row['cp'];
		$paisCliente=$row['pais'];
		$rfcCliente=$row['RFC'];
	}
?>
<!DOCTYPE html>
<head>
  <title>Lista de Embarque</title>
  <?php include('../../enlaces.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
    	<main class="mdl-layout__content">
    		<!-- <br>
    		<br> -->
    		<style>
    			.borde{
					border-style: solid;
					border-width: 2px;
    			}

    			.parrafo{
    				font-size: 12px;
    			}
    		</style>
			<div class="container-fluid col row justify-content-center align-items-center">
				<div class="col-2">
					<br>
					<center><img src="logo_hemusa.png" alt="" width="100%"></center>
					<br>
					<center><h6><b>HERRAMIENTAS MECANICAS UNIVERSALES S.A. DE C.V</b></h6></center>
					<hr>
					<p class="parrafo">RUPERTO MARTINEZ No. 831 PTE
					MONTERREY CENTRO, MONTERREY
					NL. 64000<br>	
					HMU810909370<br>
					TEL: (81) 83-45-38-11
					ventas@hemusa.com</p>
					<img src="marcas.png" alt="" width="100%">
				</div>
				<div class="col-8 row">
					<div class="col-12 row justify-content-center">
    					<h1 class="text-center">Lista de Embarque</h1><br>	
    				</div>

    				<div class="row">
						<div class="col">
							<div class="list-group">
								<button type="button" class="list-group-item list-group-item-action active"><h4>VENDIDO A:</h4></button>
								<button type="button" class="list-group-item list-group-item-action">
									<h3><?php echo $nombreCliente; ?></h3>
									<h5><?php echo $calleCliente.", #".$numeroExtCliente; ?><br></h5>
									<h5><?php echo $coloniaCliente.", ".$estadoCliente; ?><br></h5>
									<h5><?php echo $cpCliente.", ".$ciudadCliente; ?><br></h5>
									<h5><?php echo $paisCliente; ?><br></h5>
									<h5><?php echo $rfcCliente; ?><br></h5>
								</button>
							</div>
						</div>
						<div class="col">
							<div class="list-group">
								<button type="button" class="list-group-item list-group-item-action active"><h4>CONSIGNADO A:</h4></button>
								<button type="button" class="list-group-item list-group-item-action">
									<h3><?php echo $nombreCliente; ?></h3>
									<h5><?php echo $calleCliente.", #".$numeroExtCliente; ?><br></h5>
									<h5><?php echo $coloniaCliente.", ".$estadoCliente; ?><br></h5>
									<h5><?php echo $cpCliente.", ".$ciudadCliente; ?><br></h5>
									<h5><?php echo $paisCliente; ?><br></h5>
									<h5><?php echo $rfcCliente; ?><br></h5>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="list-group text-center">
					  	<button type="button" class="list-group-item list-group-item-action active">Folio</button>
					  	<button type="button" class="list-group-item list-group-item-action" disabled=""><?php echo $folio_embarque; ?></button>
					  	<button type="button" class="list-group-item list-group-item-action active">Fecha</button>
					  	<button type="button" class="list-group-item list-group-item-action" disabled=""><?php echo $fecha; ?></button>
					  	<!-- <button type="button" class="list-group-item list-group-item-action active">Factura</button>
					  	<button type="button" class="list-group-item list-group-item-action" disabled=""><?php echo $factura; ?></button> -->
					</div>
				</div>
				<table id="dt_cotizaciones" class="ui celler table table-hover display" cellspacing="0" width="100%">
					<thead>
						<tr class="text-center">	
							<th>N°</th>							
							<!-- <th>Pedimento FECHA, ADUANA, NUMERO</th> -->
							<th>Marca</th>
							<th>Modelo</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Factura</th>
							<th>Orden de Compra</th>
							<th>Paqueteria</th>
							<th># Guía</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							$sql_buscar_folio="SELECT * FROM cotizacionherramientas WHERE folio_embarque=".$folio_embarque." ";
							$result_folio=mysqli_query($conexion_usuarios, $sql_buscar_folio);
							while($row=mysqli_fetch_array($result_folio)){	
					    		echo "<tr class='text-center'>";
								$i++;
								$id=$row['id'];	
								$marca=$row['marca'];	
								$marca= strtoupper($marca);
					    		$modelo=$row['modelo'];	
								$modelo= strtoupper($modelo);
								$descripcion=$row['descripcion'];	
								$cantidad=$row['cantidad'];	
								$remision=$row['remision'];
								$factura=$row['factura'];
								$ordenCompra=$row['noDePedido'];
								$cotizacion=$row['cotizacionRef'];

								$sql2="SELECT * FROM cotizacion WHERE ref =".$cotizacion." ";
								$result_sql2=mysqli_query($conexion_usuarios, $sql2);
								while($row2=mysqli_fetch_array($result_sql2)){
									$paqueteria=$row2['IdPaqueteria'];
									$numeroGuia=$row2['guia'];
								}
						
								$descripcion= strtoupper($descripcion);
								$longitud=strlen($descripcion);
								
								if($longitud >40){
									$descripcion= substr($descripcion, 0, 40);  
								}

								echo "<center><td> ".$i." </td></center>";
								// echo '<td></td>';
								echo "<center><td> ".$marca." </td></center>";
								echo "<center><td> ".$modelo." </td></center>";
								echo "<td> ".$descripcion." </td>";
								echo "<center><td> ".$cantidad." </td></center>";
								echo "<center><td>";  
										if($factura!='0'){
											echo $factura;
										}else{
											echo $remision;
										}
								echo "</td></center>";
								echo "<center><td> ".$ordenCompra." </td></center>";
								echo "<center><td> ".$paqueteria." </td></center>";
								echo "<center><td> ".$numeroGuia." </td></center>";
							}	
						?>
					</tbody>
				</table>
				<div>
					<br>
					<br>
					<p>
						<?php
			  				echo"REVIS&Oacute;_____________________________________________________________ CONFIRM&Oacute;____________________________________________________________ PESO <u>".$peso." KG</u> DIMENSIONES <u> ".$dimensiones." CM</u>";
			  			?>
			  		</p>
			  		<br>
				</div>
			</div>
			<div class="container-fluid col">
				<h3><b>DOCUMENTO SIN VALOR FISCAL SOLO PARA FINES INFORMATIVOS</b></h3><br>
			</div>
			<div class="container-fluid col row justify-content-center">
				<h5><b>PARA CONSULTAR SU FACTURA ELECTRONICA INGRESE A www.hemusa.com.mx</b></h5><br>
			</div>	
			<div class="container-fluid col row justify-content-center">
				<h5><b>COMRA EN LINEA www.hemusa.com</b></h5>
			</div>	
	<?php

		// Informacion de embarque
			echo '<div class="container">';
		// 	echo '<div style="text-align: right;">';
		// 	echo ' <b>Folio</b> <input type="text" style="text-align:center" name="Embarque" step="1" value="'.$folio_embarque.'" /><br>';
		// 	echo '<b>Fecha</b>  <input type="text" style="text-align:center" name="Fecha" step="1" value="'.$fecha.'"/><br>';
		  		
		//   	if(!empty($factura)){
		// 		echo '<b>Factura</b> <input type="text" style="text-align:center" name="Factura" step="1" value="'.$factura.'"/><br>';
		//  	}
	 // 		echo '</div>';
	
		// if(!empty($remision)){
		// 	echo '<b>Remisi&oacute;n</b> <input type="text" style="text-align:center" name="Remision" step="1" value="'.$remision.'"/>';
 	// 	}
		
		// echo"</small>";
		// echo '</div>';
 	// 	echo "<br><b><big> Cliente </b></big>", $nombre_cliente;
		// echo" <br><b>  Observaciones  <br></b>";
		// echo "<b><hr></b><br>";
		// echo "".$observaciones."";
		// echo "<b><hr></b>";
		// echo '<center><table width="100%" border="1"  cellpadding="0" cellspacing="0"  style="text-align:center;"></center>';
		// echo "<th><b>N&#186;</b></th>"; //columna 0
		// echo "<th><b>Marca</b></th>"; //columna 0
		// echo "<th><b>Modelo</b></th>"; //columna 1
		// echo "<th><b>Cantidad</b></th>"; //columna 2
		// echo "<th><b>Descripci&oacute;n</b></th>"; //columna 3
		// echo "<tr>";
  
		// $i=0;
		// $sql_buscar_folio="SELECT * FROM cotizacionherramientas WHERE folio_embarque=".$folio_embarque." ";
		// $result_folio=mysqli_query($conexion_usuarios, $sql_buscar_folio);
		// while($row=mysqli_fetch_array($result_folio)){	
  //   		echo "<tr>";
		// 	$i++;
		// 	$id=$row['id'];	
		// 	$marca=$row['marca'];	
		// 	$marca= strtoupper($marca);
  //   		$modelo=$row['modelo'];	
		// 	$modelo= strtoupper($modelo);
		// 	$cantidad=$row['cantidad'];	
	
		// 	$descripcion=$row['descripcion'];	
		// 	$descripcion= strtoupper($descripcion);
		// 	$longitud=strlen($descripcion);
			
		// 	if($longitud >40){
		// 		$descripcion= substr($descripcion, 0, 40);  
		// 	}

		// 	echo "<td> ".$i." </td>";
		// 	echo "<td> ".$marca." </td>";
		// 	echo "<td> ".$modelo." </td>";
		// 	echo "<td> ".$cantidad." </td>";
		// 	echo "<td> ".$descripcion." </td>";
		// }	
	
		// echo "</table>";

	function &nombre_contacto($id){
		$sql_nombre_contacto ="SELECT nombreEmpresa FROM  `contactos` WHERE  `id` = '$id'"; //query para obtener el nombre de la empresa
		$resultado_nombre=mysqli_query($conexion_usuarios, $sql_nombre_contacto);
		
		while($row_nombre =mysqli_fetch_array($resultado_nombre)){
			$nombre_contacto=$row_nombre['nombreEmpresa'];	
 			// se almacena el nombre de la empresa en la variable nombre contacto
		}
		
		//Retorna el nombre del contacto
		return $nombre_contacto;
	}

?>

		</main>
	</div>
</body>
</html>

<script>
	$(document).on("ready", function(){
			$('[data-toggle="tooltip"]').tooltip();

			var table = $("#dt_cotizaciones").DataTable({
				"searching": false,
		        "language": idioma_espanol,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
				"language": idioma_espanol,
				"ordering": false,
				"dom":  
					"<'container-fluid row'<'row justify-content-center col-sm-4 buttons'B><'row justify-content-end col-sm-8 buttons'f>>" +
					"<'container-fluid row'<'row justify-content-center col-sm-12 buttons'tr>>" +
					"<'container-fluid row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				// "buttons":[
		  //           {
		  //               extend:    'pdfHtml5',
		  //               text:      '<i class="fa fa-file-pdf-o"></i>',
		  //               titleAttr: 'PDF',
		  //               download: 'open',
		  //               "className": "btn iconopdf",
		  //               orientation: 'landscape',
		  //           },
		  //           {
		  //           	extend: 'print',
		  //           	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		  //           	titleAttr: 'Imprimir',
		  //           	header: 'false',
    //         			"className": "btn iconoimprimir",
    //         			orientation: 'landscape',
    //         			pageSize: 'LEGAL',
    //         			customize: function ( win ) {
    //                 $(win.document.body)
    //                     .css( 'font-size', '10pt' )
    //                     .prepend(
    //                         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
    //                     );
 
    //                 $(win.document.body).find( 'table' )
    //                     .addClass( 'compact' )
    //                     .css( 'font-size', 'inherit' );
    //             }
		  //           },
		            // {
		            // 	text: '<i class="fa fa-envelope-o" aria-hidden="true"></i>',
		            // 	titleAttr: 'Enviar a correo',
		            // 	"className": "btn iconocsv",
		            // },
				]
			});
		});

	var idioma_espanol = {
			"sProcessing":     "Procesando...",
   			"sLengthMenu":     "Mostrar _MENU_ registros",
    		"sZeroRecords":    "No se encontraron resultados",
    		"sEmptyTable":     "Ningún dato disponible en esta tabla",
    		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix":    "",
    		"sSearch":         "Buscar:",
    		"sUrl":            "",
    		"sInfoThousands":  ",",
    		"sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
</script>