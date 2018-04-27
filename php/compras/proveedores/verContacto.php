<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);
	$idContacto = $_REQUEST['id'];
	$fecha = date("d").'-'.date("m").'-'.date("Y");
	$vendedor = $usuario.' '.$usuarioApellido;
	$query = "SELECT * FROM contactos WHERE id ='".$idContacto."'";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($row = mysqli_fetch_array($resultado)){
		$nombreContacto = $row['nombreEmpresa'];
		$tipo = $row['tipo'];
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Proveedor</title>
  <?php include('../../enlaces.php'); ?>  
</head>
<body>

	<?php include('../../header.php'); ?>
		<main class="mdl-layout__content">

		<!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">             
                <li class="breadcrumb-item">Compras</li>
                <li class="breadcrumb-item"><a href="proveedores.php">Proveedores</a></li>
                <li class="breadcrumb-item active">Info Proveedor: <?php echo $nombreContacto; ?></li>
              </ol>
          </nav>		
	
		<!-- Men� -->
			<div class="container-fluid col-12 row justify-content-start align-items-center">
				<div class="col">
					<span class="mdl-chip mdl-chip--contact">
	    				<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white"><?php echo substr($nombreContacto, 0, 1); ?></span>
	    				<span class="mdl-chip__text"><?php echo $nombreContacto; ?></span>
					</span>
				</div>
				<div class="col dropdown row justify-content-end align-items-center">
				 	<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<i class="fa fa-bars" aria-hidden="true"></i>
				  	</button>
				  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    	<button class="dropdown-item" type="button">Agrega Contacto</button>
				    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalEditarInformacion">Editar Información</button>
						<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalCrearOC" onclick="crearoc()">Crear Orden de Compra</button>
				  	</div>
				</div>
			</div>
			<div class="col-12">
				<hr>
			</div>

		<!-- Mensaje -->
	  		<div>
	  			<center><h6 class="mensaje"></h6></center>
	  		</div>

		<!-- Boton de Buscar -->
			<form class="form-horizontal row justify-content-center" action="pedidos.php" method="post">
				<div class="form-group col-12 row justify-content-center">
					<input type="text" class="form-control col-2" name="buscar" id="buscar" placeholder="Buscar">
				</div>
			</form>

  		<!-- Grupo de botones -->
  			<div class="container row justify-content-center">
  				<div class="col-12 row justify-content-center">
  					<h2><b>Herramienta</b></h2>
  				</div>
  				<div class="row justify-content-between">
				  	<button class="btn btn-primary" onclick="listar_sinpedido()">SIN PEDIDO</button>
					<button class="btn btn-primary" onclick="listar_sinrecibido()">SIN RECIBIDO</button>
					<button class="btn btn-primary" onclick="listar_sinentregar()">SIN ENTREGAR</button>
					<button class="btn btn-primary" onclick="listar_ordenesdecompra()">ORDENES DE COMPRA</button>
				</div>
  			</div>

		<!-- Modal Editar Información -->
			<form action="#" method="POST">
				<input type="hidden" id="opcion" name="opcion" value="editarinformacion">
				<input type="hidden" id="idproveedor" name="idproveedor">
				<div class="modal fade" id="modalEditarInformacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="modalNuevaCotizacionLabel">Editar Información</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body container">
								<div class="row">
									<div class="row form-group col">
										<label for="empresa" class="col-4">Empresa</label>
										<input type="text" id="empresa" name="empresa" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="rfc" class="col-4">RFC</label>
										<input type="text" id="rfc" name="rfc" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="contacto" class="col-4">Contacto</label>
										<input type="text" id="contacto" name="contacto" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="calle" class="col-4">Calle</label>
										<input type="text" id="calle" name="calle" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="noexterior" class="col-4">No. Exterior</label>
										<input type="text" id="noexterior" name="noexterior" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="nointerior" class="col-4">No. Interior</label>
										<input type="text" id="nointerior" name="nointerior" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="colonia" class="col-4">Colonia</label>
										<input type="text" id="colonia" name="colonia" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="ciudad" class="col-4">Ciudad</label>
										<input type="text" id="ciudad" name="ciudad" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="estado" class="col-4">Estado</label>
										<input type="text" id="estado" name="estado" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="cp" class="col-4">C.P.</label>
										<input type="text" id="cp" name="cp" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="pais" class="col-4">País</label>
										<input type="text" id="pais" name="pais" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="tlf1" class="col-4">Teléfono #1</label>
										<input type="text" id="tlf1" name="tlf1" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="tlf2" class="col-4">Teléfono #2</label>
										<input type="text" id="tlf2" name="tlf2" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="movil" class="col-4">Móvil</label>
										<input type="text" id="movil" name="movil" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="correofac1" class="col-4">E-mail Facturacion #1</label>
										<input type="text" id="correofac1" name="correofac1" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
								<div class="row form-group col">
										<label for="correofac2" class="col-4">E-mail Facturacion #2</label>
										<input type="text" id="correofac2" name="correofac2" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
								<div class="row form-group col">
										<label for="correo" class="col-4">E-mail Facturacion</label>
										<input type="text" id="correo" name="correo" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="paginaweb" class="col-4">Página Web</label>
										<input type="text" id="paginaweb" name="paginaweb" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="credito" class="col-4">Crédito</label>
										<input type="text" id="credito" name="credito" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="contactohemusa" class="col-4">Contacto Hemusa</label>
										<input type="text" id="contactohemusa" name="contactohemusa" class="limpiar form-control col-8">
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="moneda" class="col-4">Moneda</label>
										<select type="text" id="moneda" name="moneda" class="limpiar form-control col-8">
											<option value="mxn">MXN</option>
											<option value="usd">USD</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="formapago" class="col-4">Forma de Pago</label>
										<select type="text" id="formapago" name="formapago" class="limpiar form-control col-8">
											<option value="1">Efectivo</option>
											<option value="2">Cheque nominativo</option>
											<option value="3">Transferencia electrónica de fondos</option>
											<option value="4">Tarjeta de crédito</option>
											<option value="5">Monedero electrónico</option>
											<option value="6">Dinero electrónico</option>
											<option value="7">Vales de despensa</option>
											<option value="8">Tarjeta de débito</option>
											<option value="9">Tarjeta de servicio</option>
											<option value="10">Otros</option>
											<option value="11">NA</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="metodopago" class="col-4">Método de Pago</label>
										<select type="text" id="metodopago" name="metodopago" class="limpiar form-control col-8">
											<option value="0">Ninguno</option>
											<option value="1">Pago en una sola exhibición</option>
											<option value="2">Pago en parcialidades o diferido</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="row form-group col">
										<label for="cfdi" class="col-4">Uso de CFDI</label>
										<select type="text" id="cfdi" name="cfdi" class="limpiar form-control col-8">
											<option value="0">Ninguno</option>
											<option value="1">Adquisición de mercancias</option>
											<option value="2">Devoluciones, descuentos o bonificaciones</option>
											<option value="3">Gastos en general</option>
											<option value="4">Construcciones</option>
											<option value="5">Mobiliario y equipo de oficina por inversiones</option>
											<option value="6">Equipo de transporte</option>
											<option value="7">Equipo de computo y accesorios</option>
											<option value="8">Dados, troqueles, moldes, matrices y herramental</option>
											<option value="9">Comunicaciones telefónicas</option>
											<option value="10">Comunicaciones satelitales</option>
											<option value="11">Otra maquinaria y equipo</option>
											<option value="12">Horarios médicos, dentales y gastos hospitalarios</option>
											<option value="13">Gastos médicos por incapacidad o discapacidad</option>
											<option value="14">Gastos funerales</option>
											<option value="15">Donativos</option>
											<option value="16">Intereses reales efectivamente pagados por créditos hipotecarios</option>
											<option value="17">Aportaciones voluntarias al SAR</option>
											<option value="18">Primas por seguros de gastos médicos</option>
											<option value="19">Gastos de transportación escolar obligatoria</option>
											<option value="20">Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones</option>
											<option value="21">Pagos por servicios educativos (colegiaturas)</option>
											<option value="22">Por definir</option>
										</select>
									</div>
								</div>
							</div>
							<div class="modal-footer row center-xs">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</form>	
	
		<!-- Listar sin pedido -->
			<br>
			<div id="listar_sinpedido" class="col-12 row justify-content-center">
				<h2><b>SIN PEDIDO</b></h2>
				<br><br>
				<table id="dt_listar_sinpedido" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Descripcion</th>
							<th>Cantidad</th>
							<th>Cliente</th>
							<th>Precio Proveedor</th>
							<th>Fecha Pedido</th>
							<th>Almacen</th>
							<th>Utilidad</th>
							<th>Quitar</th>
						</tr>
					</thead>						
				</table>
				<div>
					<h2><b>TOTAL: $<label id="totalsinpedido"></label></b></h2>
					<br><br>
				</div>
			</div>

		<!-- Listar sin recibido -->
			<br>
			<div id="listar_sinrecibido" class="col-12 row justify-content-center">
				<h2><b>SIN RECIBIDO</b></h2>
				<br><br>
				<table id="dt_listar_sinrecibido" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Enviado</th>
							<th>Recibido</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Cantidad</th>
							<th>Descripcion</th>
							<th>Cliente</th>
							<th>Pedido</th>
							<th>Fecha</th>
							<th>Costo</th>
						</tr>
					</thead>						
				</table>
			</div>
		
		<!-- Listar sin entregar -->
			<div id="listar_sinentregar" class="col-12 row justify-content-center">
				<h2><b>SIN ENTREGAR</b></h2>
				<br><br>
				<table id="dt_listar_sinentregar" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Enviado</th>
							<th>Recibido</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Cantidad</th>
							<th>Descripcion</th>
							<th>Cliente</th>
							<th>Pedido</th>
							<th>Fecha</th>
							<th>Costo</th>
						</tr>
					</thead>						
				</table>
			</div>
	
		<!-- Listar ordenes de compra -->
			<div id="listar_ordenesdecompra" class="col-12 row justify-content-center">
				<h2><b>ORDENES DE COMPRA</b></h2>
				<br><br>
				<table id="dt_listar_ordenesdecompra" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Número</th>
							<th>Proveedor</th>
							<th>Contacto</th>
							<th>Fecha</th>
							<th>Ver</th>
					</thead>						
				</table>
			</div>

		<!-- Modal Crear OC -->
			<div class="modal fade" id="modalCrearOC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel">Crear Orden de Compra</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<form action="#" method="POST">
			        			<input type="hidden" id="idproveedor" name="idproveedor" value="<?php echo $_REQUEST['id']; ?>">
			        			<input type="hidden" id="opcion" name="opcion" value="crearordencompra">
			        			<div class="row justify-content-center">
			        				<div class="form-group col-12">
			        					<label for="saludo">Saludo</label>
			        					<textarea name="saludo" id="saludo" cols="30" rows="3" class="form-control"></textarea>
			        				</div>
			        				<div class="form-group col-12">
			        					<label for="direccionenvio">Envia a</label>
			        					<select name="direccionenvio" id="direccionenvio" class="form-control" onchange="agregardireccion()"></select>
			        				</div>
			        				<div class="form-group col-12">
			        					<textarea name="otra" id="otra" cols="30" rows="3" class="form-control" disabled></textarea>
			        				</div>
			        			</div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			        		<button type="submit" class="btn btn-primary">Crear</button>
			        		</form>
			      		</div>
			    	</div>	
			  	</div>
			</div>

		<!-- Modal OC Pendientes -->
			<div class="modal fade" id="modalOCPendientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar btn-outline-primary" aria-hidden="true"></i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-12 row justify-content-center">
								<div class="form-group row justify-content-center col-12">
									<label class="control-label">Proveedores con herramienta sin entregar y sin crear OC</label>
								</div>
								<div class="form-group row justify-content-center col-12">
									<select name="proveedoressinoc" id="proveedoressinoc" class="form-control col-6" onchange="verproveedor2()"></select>
								</div>
							</div>				      		
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
	</div>
</body>
</html>

<script>
	$(document).on("ready", function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		listar_sinpedido();
		buscar_oc_pendientes();
		setInterval(buscar_oc_pendientes, 3000);
		// crearordencompra();
		guardar();
	});

	function buscarDatosCliente(){
			$("#frmAgregarCotizacion #contactoCliente").val("");
			$("#frmAgregarCotizacion #moneda").val("");
			$("#frmAgregarCotizacion #tiempoEntrega").val("");
			$("#frmAgregarCotizacion #condicionesPago").val("");
			$("#frmAgregarCotizacion #comentarios").val("");
			var cliente = $("#frmAgregarCotizacion #cliente").val();
			var opcion = "buscarDatosCliente";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"cliente": cliente, "opcion": opcion},
				success : function(data) {
					$("#frmAgregarCotizacion #contactoCliente").val(data.data.personaContacto);
					$("#frmAgregarCotizacion #moneda").val(data.data.moneda);
					$("#frmAgregarCotizacion #condicionesPago").val(data.data.CondPago);
					var id = data.data.id;
					buscarContactos(id);
	   			}
			});
	}
	
	var listar_sinpedido = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideDown("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinpedido";
		var buscar = $("#buscar").val();
		console.log(buscar);
		console.log(idproveedor);
		var table = $("#dt_listar_sinpedido").DataTable({
	        "destroy": true,
			"scrollX": true,
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "marca"},
	          {"data": "modelo"},
	          {"data": "descripcion"},
	          {"data": "cantidad"},
	          {"data": "cliente"},
	          {"data": "precioProveedor"},
	          {"data": "fecha"},
	          {"data": "almacen"},
	          {"data": "utilidad"},
	          {"defaultContent": "<button class='quitar btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i></button>"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            },
		            {
		            	text: '<i class="fa fa-cart-plus" aria-hidden="true"></i>',
		            	"className": "btn btn-success btnNuevaCotizacion",
		            	action: function (e, dt, node, config){
        					$("#modalCrearOC").modal("show");
        					crearoc();
        					// $.ajax({
							// 	method: "POST",
							// 	url: "buscar.php",
							// 	dataType: "json",
							// 	data: {"opcion": opcion},
							// 	success: function (data) {
							// 		console.log(data);
							// 		var direcciones = data;
							// 		$('select[name=direccionenvio]').empty();
							// 		for(var i=0;i<direcciones.length;i=i+2){ 
					        //    	 		$("select[name=direccionenvio]").append("<option value="+ direcciones[i] +">" + direcciones[i+1] + "</option>");
					 		// 		};
					 		// 		$("select[name=direccionenvio]").append("<option>Otra</option>");
					 		// 		$("#frmCrearOC #idproveedor").val(idproveedor);
							// 	}
							// });
    					}		
		            }
				]
	    });

	    obtener_id_quitar("#dt_listar_sinpedido tbody", table, idproveedor);
		obtener_total(idproveedor);
	}

	var crearoc = function (){
		var opcion = "direccionenvio";
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion},
			success: function (data) {
				console.log(data);
				var direcciones = data;
				$('select[name=direccionenvio]').empty();
				for(var i=0;i<direcciones.length;i=i+2){ 
					$("select[name=direccionenvio]").append("<option value="+ direcciones[i] +">" + direcciones[i+1] + "</option>");
				};
				$("select[name=direccionenvio]").append("<option>Otra</option>");
				$("#frmCrearOC #idproveedor").val(idproveedor);
			}
		});
	}

	var listar_sinrecibido = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideDown("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinrecibido";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_sinrecibido").DataTable({
	        "destroy": true,
			"scrollX": true,
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
			  {"data": "indice"},
			  {"data": "enviado"},
			  {"data": "recibir"},
	          {"data": "marca"},
			  {"data": "modelo"},
			  {"data": "cantidad"},
	          {"data": "descripcion"},
	          {"data": "cliente"},
	          {"data": "pedido"},
	          {"data": "fecha"},
	          {"data": "costo"}
	        ],
			"columnDefs": [
				{ "width": "15%", "targets": 7 },
				{ "width": "6%", "targets": 9 }
			],
	        "language": idioma_espanol,
				"dom":  
					"<'container-fluid row col-12 row'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            },
					{
		                text: '<i class="fa fa-check" aria-hidden="true"></i> Enviado',
		                "className": "btn btn-primary",
		                action: function ( e, dt, node, config ) {
		                	var verificar = 0;
							$("input[name=enviado]").each(function (index) {
								if($(this).is(':checked')){
									verificar++;
								}
							});
							if(verificar == 0){
								alert("Debes de seleccionar al menos una partida!");
							}else{
								var herramienta = new Array();
								var numeroPartidas = 0;
								$("input[name=enviado]").each(function (index) {
									if($(this).is(':checked')){
										herramienta.push($(this).val());
										numeroPartidas++;
									}
								});
								var opcion = "herramientaenviado";
								console.log(herramienta);					
								$.ajax({
									method: "POST",
									url: "guardar.php",
									dataType: "json",
									data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
								}).done( function( data ){
									console.log(data);				
									mostrar_mensaje(data);
									listar_sinrecibido();
								});
		                	}
						}
					},
						{
		                text: '<i class="fa fa-check" aria-hidden="true"></i> Recibido',
		                "className": "btn btn-primary",
		                action: function ( e, dt, node, config ) {
		                	var verificar = 0;
							$("input[name=recibido]").each(function (index) {
								if($(this).is(':checked')){
									verificar++;
								}
							});
							if(verificar == 0){
								alert("Debes de seleccionar al menos una partida!");
							}else{
								var herramienta = new Array();
								var numeroPartidas = 0;
								$("input[name=recibido]").each(function (index) {
									if($(this).is(':checked')){
										herramienta.push($(this).val());
										numeroPartidas++;
									}
								});
								var opcion = "herramientarecibido";
								console.log(herramienta);					
								$.ajax({
									method: "POST",
									url: "guardar.php",
									dataType: "json",
									data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
								}).done( function( data ){
									console.log(data);				
									mostrar_mensaje(data);
									listar_sinrecibido();
								});
		                	}
		                }
		            }
				]
	    });

	    // obtener_id_quitar("#dt_listar_sinpedido tbody", table, idproveedor);
	}

	var listar_sinentregar = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";		
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideDown("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinentregar";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_sinentregar").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
			  {"data": "indice"},
			  {"data": "enviado"},
			  {"data": "recibir"},
	          {"data": "marca"},
			  {"data": "modelo"},
			  {"data": "cantidad"},
	          {"data": "descripcion"},
	          {"data": "cliente"},
	          {"data": "pedido"},
	          {"data": "fecha"},
	          {"data": "costo"}
	        ],
			"columnDefs": [
				{ "width": "6%", "targets": 2 },
				{ "width": "15%", "targets": 7 },
				{ "width": "6%", "targets": 9 }
			],
	        "language": idioma_espanol,
				"dom":  
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
	    });

	    // obtener_id_quitar("#dt_listar_sinpedido tbody", table, idproveedor);
	}

	var listar_ordenesdecompra = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_ordenesdecompra").slideDown("slow");
		var opcion = "ordenesdecompra";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_ordenesdecompra").DataTable({
	        "destroy": true,
			"scrollX": true,
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
			  {"data": "indice"},
			  {"data": "ordencompra"},
			  {"data": "proveedor"},
	          {"data": "contacto"},
			  {"data": "fecha"},
			  {"defaultContent": "<button class='verordencompra btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'container-fluid row col-12 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container-fluid row col-12 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }
				]
	    });

	    ver_orden_compra("#dt_listar_ordenesdecompra tbody", table, idproveedor);
	}

	var ver_orden_compra = function(tbody, table, idproveedor){
		$(tbody).on("click", "button.verordencompra", function(){
			var data = table.row( $(this).parents("tr") ).data();
			var ordencompra = data.ordencompra;
			console.log(data);
			window.location.href = "../ordenesdecompras/verOrdenCompra.php?ordenCompra="+ordencompra;
		});
	}

	$('#modalEditarInformacion').on('show.bs.modal', function (e) {
		var opcion = "informacioncontacto";
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
  		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion, "idproveedor": idproveedor},
		}).done( function( data ){
			$("#empresa").val(data.contacto.nombreEmpresa);
			$("#rfc").val(data.contacto.RFC);
			$("#contacto").val(data.contacto.personaContacto);
			$("#calle").val(data.contacto.calle);
			$("#noexterior").val(data.contacto.NumInt);
			$("#nointerior").val(data.contacto.NumExt);
			$("#colonia").val(data.contacto.colonia);
			$("#ciudad").val(data.contacto.ciudad);
			$("#estado").val(data.contacto.estado);
			$("#cp").val(data.contacto.cp);
			$("#pais").val(data.contacto.pais);
			$("#tlf1").val(data.contacto.tlf1);
			$("#tlf2").val(data.contacto.tlf2);
			$("#movil").val(data.contacto.movil);
			$("#correofac1").val(data.contacto.correoFacturacion1);
			$("#correofac2").val(data.contacto.correoFacturacion2);
			$("#correo").val(data.contacto.correoElectronico);
			$("#paginaweb").val(data.contacto.paginaWeb);
			$("#credito").val(data.contacto.CondPago);
			$("#contactohemusa").val(data.contacto.responsable);
			$("#moneda").val(data.contacto.moneda);
			$("#formapago").val(data.contacto.IdFormaPago);
			$("#metodopago").val(data.contacto.IdMetodoPago);
			$("#cfdi").val(data.contacto.IdUsoCFDI);
			$("#idproveedor").val(idproveedor);
		});		
	})

	var guardar = function(){
		$("form").on("submit", function(e){
			e.preventDefault();
			$(".modal").modal("hide");
			$("form .disabled").attr("disabled", false);
			var frm = $(this).serialize();
			console.log(frm);
			$.ajax({
				method: "POST",
				url: "guardar.php",
				data: frm,
			}).done( function( info ){
				console.log(info);
				var datos = JSON.parse(info);
				if (datos.respuesta == "agregarordencompra") {
					window.location.href = "../ordenesdecompras/verOrdenCompra.php?ordenCompra="+datos.ordencompra;
				}else{
					console.log(datos);
					mostrar_mensaje(datos);
				}
			});
		});
	}

	function obtener_total(idproveedor){
		var opcion = "totalsinpedido";
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"idproveedor": idproveedor, "opcion": opcion},
		}).done( function( info ){				
			console.log(info);
			$("#totalsinpedido").text(info.totalsinpedido);
		});
	}

	function agregardireccion(){
		var direccion = $("#direccionenvio").val();
		if (direccion == "Otra") {
			document.getElementById("otra").disabled = false;
		}else{
			document.getElementById("otra").disabled = true;
		}
	}

	// var crearordencompra = function(){
	// 	$("#frmCrearOC").on("submit", function(e){
	// 		e.preventDefault();
	// 		var frm = $(this).serialize();
	// 		console.log(frm);
	// 		$.ajax({
	// 			method: "POST",
	// 			url: "guardar.php",
	// 			dataType: "json",
	// 			data: frm,
	// 		}).done( function( info ){				
	// 			console.log(info);
	// 			window.location.href = "../ordenesdecompras/verOrdenCompra.php?ordenCompra="+info;
	// 		});
	// 	});
	// }

	var obtener_id_quitar = function(tbody, table, idproveedor){
		$(tbody).on("click", "button.quitar", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			if (confirm("Esta seguro(a) de quitar la herramienta del proveedor?")){
				var id = data.id;
				var opcion = "quitarproveedor";
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "id": id},
					success: function (data) {
						var json_info = JSON.parse( data );
						mostrar_mensaje(json_info);
						listar_sinpedido(idproveedor);
					}
				});
			}else{

			}
		});
	}

	var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
				texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
				color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
				texto = "<div class='alert alert-warning'><strong>Error</strong>, no se ejecut� la consulta.</div>";
				color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
				texto = "<strong>Informaci�n!</strong> el usuario ya existe.";
				color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
				texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
				color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA"){
				texto = "<div class='alert alert-warning'><strong>Advertencia!</strong> la opci�n no existe o esta vac�a, recargar la p�gina.</div> ";
				color = "#DDB11D";
			}

			$(".mensaje").html( texto );
			$(".mensaje").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(5000);
			}); 
	}

	var idioma_espanol = {
			"sProcessing":     "Procesando...",
   			"sLengthMenu":     "Mostrar _MENU_ registros",
    		"sZeroRecords":    "No se encontraron resultados",
    		"sEmptyTable":     "Ning�n dato disponible en esta tabla",
    		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix":    "",
    		"sSearch":         "Buscar: ",
    		"sUrl":            "",
    		"sInfoThousands":  ",",
    		"sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "�ltimo",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
</script>
<script src="<?php echo $ruta; ?>/php/js/notificaciones.js"></script>
