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
<html>
<head>
	<title>Contacto Cliente</title>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->
  	<?php include('../../enlaces.php'); ?>  
</head>
<body>
	<?php include('../../header.php'); ?>
		<main class="mdl-layout__content">

			<!-- Breadcrumb -->
	            <nav aria-label="breadcrumb">
	              <ol class="breadcrumb">             
	                <li class="breadcrumb-item">Ventas</li>
	                <li class="breadcrumb-item"><a href="clientes.php">Clientes</a></li>
	                <li class="breadcrumb-item active">Info Cliente: <?php echo $nombreContacto; ?></li>
	              </ol>
	         	</nav>
				
			<!-- Mensaje actualizaciones -->
				<div>
					<center><h6 class="mensaje"></h6></center>
				</div>
			
			<!-- Menú -->
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
					    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalEditarInformacion">Editar Información</button>
					    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaRemision">Nueva Remision</button>
					    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaCotizacion">Nueva Cotizacion</button>
					  	</div>
					</div>
				</div>
				<div class="container-fluid col-12 justify-content-center">
					<hr>
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
						<button class="btn btn-primary" onclick="listar_sinentregar()">SIN ENTREGAR</button>
						<button class="btn btn-primary" onclick="listar_facturadonoentregado()">Facturado No Entregado</button>
						<button class="btn btn-primary" onclick="listar_remisiones()">REMISIONES</button>
						<button class="btn btn-primary" onclick="listar_cotizaciones()">COTIZACIONES</button>
					</div>
				</div>
			
			<!-- Listar facturado no entregado -->
				<br>
				<div id="listar_facturadonoentregado" class="col-12 row justify-content-center">
					<h4><b>FACTURADO NO ENTREGADO</b></h4>
					<br><br>
					<table id="dt_listar_facturadonoentregado" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Ref.</th>
								<th>Fecha</th>
								<th>Cantidad</th>
								<th>Suma</th>
							</tr>
						</thead>						
					</table>
				</div>
			
			<!-- Listar sin entregar -->
				<br>
				<div id="listar_sinentregar" class="col-12 row justify-content-center">
					<h4><b>SIN ENTREGAR</b></h4>
					<br><br>
					<table id="dt_listar_sinentregar" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Precio Unitario</th>
								<th>Pedido</th>
								<th>Orden</th>
								<th>Enviado</th>
								<th>Recibido</th>
							</tr>
						</thead>						
					</table>
				</div>
			
			<!-- Listar remisiones -->
				<br>
				<div id="listar_remisiones" class="col-12 row justify-content-center">
					<h4><b>REMISIONES</b></h4>
					<br><br>
					<table id="dt_listar_remisiones" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Remision</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Fecha</th>
								<th>Cantidad</th>
								<th>Suma</th>
								<th>Moneda</th>
							</tr>
						</thead>						
					</table>
				</div>
			
			<!-- Listar cotizaciones -->
				<br>
				<div id="listar_cotizaciones" class="col-12 row justify-content-center">
					<h4><b>COTIZACIONES</b></h4>
					<br><br>
					<table id="dt_listar_cotizaciones" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Ref.</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Fecha</th>
								<th>Ver</th>
							</tr>
						</thead>						
					</table>
				</div>			

			<!-- Modal Agregar Clasificacion -->
				<form action="#" method="POST">
					<input type="hidden" id="opcion" name="opcion" value="agregarclas">
					<input type="hidden" id="idcliente" name="idcliente">
					<input type="hidden" id="usuariologin" name="usuariologin">
					<input type="hidden" id="dplogin" name="dplogin">
					<input type="hidden" id="nombrecliente" name="nombrecliente">
					<div class="modal fade" id="modalAgregarClas" tabindex="-1" role="dialog" aria-labelledby="modalAgregarClas" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="tituloEditarPartida">Asignar clasificación</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					        		</button>
					      		</div>
					      		<div class="modal-body col-12 row">
					      			<div class="col-12 row justify-content-center">
					      				<label for="clasificacion" class="row justify-content-center col-12">Selecciona una opción: </label>						      			
					      			</div>
					      			<div class="form-check col">
									  	<input class="form-check-input" type="radio" name="clasificacion" id="clasificacion" value="clas1">
									  	<label class="form-check-label" for="clasificacion">
										    16%
									  	</label>
									</div>
									<div class="form-check col">
									  	<input class="form-check-input" type="radio" name="clasificacion" id="clasificacion" value="clas2">
									  	<label class="form-check-label" for="clasificacion">
										    20%
									  	</label>
									</div>
									<div class="form-check col">
									  	<input class="form-check-input" type="radio" name="clasificacion" id="clasificacion" value="clas3">
									  	<label class="form-check-label" for="clasificacion">
										    25%
									  	</label>
									</div>
									<div class="form-check col">
									  	<input class="form-check-input" type="radio" name="clasificacion" id="clasificacion" value="clas4">
									  	<label class="form-check-label" for="clasificacion">
										    30%
									  	</label>
									</div>
								</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					        		<button type="submit" class="btn btn-success">Asignar</button>
					      		</div>
					    	</div>
					  	</div>
					</div>
				</form>

			<!-- Modal Nueva Cotizacion -->
			 	<form action="#" method="POST">
			 		<input type="hidden" id="opcion" name="opcion" value="agregarcotizacion">
			 		<input type="hidden" id="idcliente" name="idcliente">
					<input type="hidden" id="usuariologin" name="usuariologin">
					<input type="hidden" id="dplogin" name="dplogin">
					<div class="modal fade" id="modalNuevaCotizacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva Cotización</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body container">
									<div class="row">
										<div class="col form-group">
											<label for="numerocotizacion">Número cotización <font color="#FF4136">*</font></label>
											<input type="text" id="numerocotizacion" name="numerocotizacion" class="limpiar disabled form-control" disabled>
										</div>
										<div class="col form-group">
											<label for="fechacotizacion">Fecha <font color="#FF4136">*</font></label>
											<input type="text" id="fechacotizacion" name="fechacotizacion" class="limpiar disabled form-control" disabled>
										</div>
										<div class="col form-group">
											<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
											<input type="text" id="vendedor" name="vendedor" class="limpiar disabled form-control" disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-8 form-group" >
												<label for="nombrecliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
												<input type="text" id="nombrecliente" name="nombrecliente" class="limpiar disabled form-control col-12" disabled>
										</div>
										<div class="col form-group">
											<label for="contactocliente">Contacto <font color="#FF4136">*</font></label>
											<select name="contactocliente" id="contactocliente" class="form-control" onchange="agregarcontacto()" required>
												
											</select>
										</div>
									</div>
									<div class="row">
											<div class="col-2 form-group">
												<label for="moneda" class="col-12">Moneda <font color="#FF4136">*</font></label>
												<select id="moneda" name="moneda" class="form-control" required>
													<option>
														<option value="mxn">MXN</option>
														<option value="usd">USD</option>
													</option>
												</select>
											</div>
											<div class="col-4 form-group">
												<label for="tiempoEntrega" class="col-12">Tiempo de entrega <font color="#FF4136">*</font></label>
												<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="awesomplete form-control col-12" list="clientes" placeholder="(días)" required/>
											</div>
											<div class="col form-group">
												<label for="condicionesPago">Condiciones de pago</label>
												<input type="text" id="condicionesPago" name="condicionesPago" class="form-control" placeholder="(Opcional)">
											</div>
									</div>
									<div class="row">
										<div class="col form-group">
											<label for="comentarios" class="col-12">Comentarios</label>
											<textarea name="comentarios" id="comentarios" class="form-control" cols="30" rows="3" placeholder="(Opcional)"></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer row center-xs">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</div>
					</div>
				</form>	    

			<!-- Modal Editar Información -->
				<form action="#" method="POST">
			 		<input type="hidden" id="opcion" name="opcion" value="editarinformacion">
			 		<input type="hidden" id="idcliente" name="idcliente">
					<input type="hidden" id="usuariologin" name="usuariologin">
					<input type="hidden" id="dplogin" name="dplogin">
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
												<option value="1">Pago en una sola exhibición</option>
												<option value="2">Pago en parcialidades o diferido</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="row form-group col">
											<label for="cfdi" class="col-4">Uso de CFDI</label>
											<select type="text" id="cfdi" name="cfdi" class="limpiar form-control col-8">
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
			<!-- Modal Agregar Contacto -->
			 	<form action="#" method="POST">
			 		<input type="hidden" id="opcion" name="opcion" value="agregarcontacto">
			 		<input type="hidden" id="idcliente" name="idcliente">
			 		<input type="hidden" id="usuariologin" name="usuariologin">
			 		<input type="hidden" id="dplogin" name="dplogin">
					<div class="modal fade" id="modalAgregarContacto" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalNuevaCotizacionLabel">Agregar contacto</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body container">
									<div class="col-12">
										<div class="row">
											<div class="form-group col">
												<label for="contacto">Contacto <font color="#FF4136">*</font></label>
												<input type="text" id="contacto" name="contacto" class="form-control" required>
											</div>
											<div class="form-group col">
												<label for="puesto">Puesto <font color="#FF4136">*</font></label>
												<input type="text" id="puesto" name="puesto" class="form-control" required>
											</div>	
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="calle">Calle</label>
												<input type="text" id="calle" name="calle" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="colonia">Colonia</label>
												<input type="text" id="colonia" name="colonia" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="ciudad">Ciudad</label>
												<input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="(Opcional)">
											</div>		
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="estado">Estado</label>
												<input type="text" id="estado" name="estado" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="cp">C.P.</label>
												<input type="text" id="cp" name="cp" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="pais">Pais</label>
												<input type="text" id="pais" name="pais" class="form-control" placeholder="(Opcional)">
											</div>		
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="tlf">Telefono</label>
												<input type="text" id="tlf" name="tlf" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="movil">Movil</label>
												<input type="text" id="movil" name="movil" class="form-control" placeholder="(Opcional)">
											</div>
											<div class="form-group col">
												<label for="correoElectronico">Correo electronico <font color="#FF4136">*</font></label>
												<input type="text" id="correoElectronico" name="correoElectronico" class="form-control">
											</div>		
										</div>
									</div>
								</div>
								<div class="modal-footer row center-xs">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn btn-success" name="crearCotizacion">Agregar</button>
								</div>
							</div>
						</div>
					</div>
				</form>	  

			<!-- Modal Nueva Remisión -->
				<form name="agregarRemision" action="#" method="POST">
					<input type="hidden" id="opcion" name="opcion" value="nuevaremision">
					<div class="modal fade" id="modalNuevaRemision" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva Remisión</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body container">
									<div class="row">
										<div class="col form-group">
											<label for="numeroCotizacion">Número cotización <font color="#FF4136">*</font></label>
											<input type="text" id="numeroCotizacion" name="numeroCotizacion" class="disabled form-control" disabled>
										</div>
										<div class="col form-group">
											<label for="remision">Remision <font color="#FF4136">*</font></label>
											<input type="text" id="remision" name="remision" class="disabled form-control" disabled>
										</div>
										<div class="col form-group">
											<label for="fechaCotizacion">Fecha <font color="#FF4136">*</font></label>
											<input type="text" id="fechaCotizacion" name="fechaCotizacion" class="disabled form-control" value="<?php echo date("Y-m-d"); ?>" disabled>
										</div>
										<div class="col form-group">
											<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
											<input type="text" id="vendedor" name="vendedor" class="disabled form-control" value="<?php echo $usuario." ".$usuarioApellido; ?>" disabled>
										</div>
									</div>
									<div class="row">
											<div class="col-8 form-group">
												<label for="cliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
												<input placeholder="Busca un cliente" class="disabled form-control col-12" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="buscarDatosCliente()" disabled required>
												<!-- <datalist id="clientes">
												</datalist> -->
											</div>
											<div class="col form-group">
												<label for="contactoCliente">Contacto <font color="#FF4136">*</font></label>
												<select name="contactoCliente" id="contactoCliente" class="form-control" onchange="agregarcontacto()" required>
													<option value="">Selecciona</option>
												</select>
											</div>
									</div>
									<div class="row">
											<div class="col-2 form-group">
												<label for="moneda" class="col-12">Moneda <font color="#FF4136">*</font></label>
												<select id="moneda" name="moneda" class="form-control" required>
													<option>
														<option value="mxn" selected>MXN</option>
														<option value="usd">USD</option>
													</option>
												</select>
											</div>
											<div class="col form-group">
												<label for="comentarios" class="col-12">Comentarios</label>
												<textarea name="comentarios" id="comentarios" class="form-control" cols="30" rows="3" placeholder="Opcional"></textarea>
											</div>
									</div>
									<!-- <div class="row">
									</div> -->
								</div>
								<div class="modal-footer row center-xs">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</div>
					</div>
				</form>

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
		  	
		</main>
	</div>
</body>
</html>

<script>
	$(document).on("ready", function(){
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
		var idusuario = "<?php echo $idusuario; ?>";
		console.log(idusuario);
		buscar_oc_pendientes();
		setInterval(buscar_oc_pendientes, 3000);
		buscardatoscliente(idcliente);
		guardar();
		listar_sinentregar();
		var opcion = "datosusuario";
		$.ajax({ // Se obtienen los datos del usuario en sesion
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion, "idusuario": idusuario},
			success: function ( data ){		
				console.log(data);
				$("form #usuariologin").val(data.datosusuario.nombre + " " + data.datosusuario.apellidos);
				$("form #dplogin").val(data.datosusuario.dp);
				$("form #vendedor").val(data.datosusuario.nombre + " " + data.datosusuario.apellidos);
				$("form #idcliente").val(idcliente);
			}
		});

	});

	var listar_facturadonoentregado = function(){
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_facturadonoentregado").slideDown("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_remisiones").slideUp("slow");
		$("#listar_cotizaciones").slideUp("slow");
		var opcion = "facturadonoentregado";
		var buscar = $("#buscar").val();
		var table = $("#dt_listar_facturadonoentregado").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idcliente": idcliente, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "ref"},
	          {"data": "fecha"},
	          {"data": "cantidad"},
	          {"data": "suma"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'col-12 row '<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'col-12 row '<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row '<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }	
				]
	    });
	}

	var listar_sinentregar = function(){
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_facturadonoentregado").slideUp("slow");
		$("#listar_sinentregar").slideDown("slow");
		$("#listar_remisiones").slideUp("slow");
		$("#listar_cotizaciones").slideUp("slow");
		var opcion = "sinentregar";
		var buscar = $("#buscar").val();
		var table = $("#dt_listar_sinentregar").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idcliente": idcliente, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "marca"},
	          {"data": "modelo"},
	          {"data": "descripcion"},
	          {"data": "cantidad"},
			  {"data": "precioUnitario"},
			  {"data": "pedido"},
			  {"data": "orden"},
			  {"data": "enviado"},
			  {"data": "recibido"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'col-12 row '<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'col-12 row '<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row '<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }	
				]
	    });
	}

	var listar_remisiones = function(){
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_facturadonoentregado").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_remisiones").slideDown("slow");
		$("#listar_cotizaciones").slideUp("slow");
		var opcion = "remisiones";
		var buscar = $("#buscar").val();
		var table = $("#dt_listar_remisiones").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idcliente": idcliente, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "remision"},
	          {"data": "cliente"},
	          {"data": "contacto"},
	          {"data": "fecha"},
			  {"data": "cantidad"},
			  {"data": "suma"},
			  {"data": "moneda"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'col-12 row '<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'col-12 row '<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row '<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }	
				]
	    });
	}

	var listar_cotizaciones = function(){
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_facturadonoentregado").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_remisiones").slideUp("slow");
		$("#listar_cotizaciones").slideDown("slow");
		var opcion = "cotizaciones";
		var buscar = $("#buscar").val();
		var table = $("#dt_listar_cotizaciones").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idcliente": idcliente, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "cotizacion"},
	          {"data": "cliente"},
	          {"data": "contacto"},
	          {"data": "fecha"},
			  {"defaultContent": "<button class='vercotizacion btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
	        ],
	        "language": idioma_espanol,
				"dom":  
					"<'col-12 row '<'row justify-content-center col-4 buttons'B><'row justify-content-end col-8 buttons'f>>" +
					"<'col-12 row '<'justify-content-center col-12 buttons'tr>>" +
					"<'col-12 row '<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				"buttons":[
		            {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                "className": "btn iconopdf",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                "className": "btn iconoexcel",
		                exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'csvHtml5',
		            	text: '<i class="fa fa-file-text-o"></i>',
		            	titleAttr: 'CSV',
		            	"className": "btn iconocsv",
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
		            },
		            {
		            	extend: 'print',
		            	text: '<i class="fa fa-print" aria-hidden="true"></i>',
		            	titleAttr: 'Imprimir',
		            	header: 'false',
		            	exportOptions: {
                    			columns: [ 0, 1, 2, 3, 4 ]
            			},
            			title: 'Herramienta sin pedido',
            			"className": "btn iconoimprimir",
            			orientation: 'landscape',
            			pageSize: 'LEGAL'
		            }	
				]
	    });
		obtener_data_ver_cotizacion("#dt_listar_cotizaciones tbody", table);
	}

	var obtener_data_ver_cotizacion = function(tbody, table){ // se obtiene el id del usuario para eliminar del DT Usuarios 
		$(tbody).on("click", "button.vercotizacion", function(){
			var data = table.row( $(this).parents("tr") ).data();
			var cotizacion = data.cotizacion;
			window.location.href = "../cotizaciones/verCotizacion.php?numero="+cotizacion;
		});
	}

	function buscardatoscliente(idcliente){
		var opcion = "datoscliente";	
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"idcliente": idcliente, "opcion": opcion}
		}).done( function( data ){
			console.log(data);
			if(data.data.clasificacion == 0){
				estandar = alert("El cliente no tiene asignado ning�na clasificaci�n.\n\nFavor de asignar a continuaci�n para poder cotizar.");
				$('#modalAgregarClas').modal('show');
			}

			$("form #nombrecliente").val(data.data.nombreEmpresa);
			$("#moneda").val(data.data.moneda);
			$("#condicionesPago").val(data.data.CondPago);

		});
	}

	$('#modalNuevaCotizacion').on('show.bs.modal', function (e) {
		var opcion = "nuevacotizacion";
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
  		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion},
		}).done( function( data ){
			console.log(data);
			$("#numerocotizacion").val(data.numeroCotizacion);
			$("#fechacotizacion").val(data.fecha);
		});

		opcion = "buscarcontactos";
		console.log(opcion);
		console.log(idcliente);
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"idcliente": idcliente, "opcion": opcion},
			success : function(data) {
				console.log(data);
				if (data.respuesta == "Ninguno") {
					$("form #contactocliente").empty();
					$("form #contactocliente").append("<option>Ninguno</option>");
					$("form #contactocliente").append("<option>- Agregar contacto -</option>");	
				}else{
					var contactos = data;
					$('#contactocliente').empty();
					var contacto = document.getElementById("contactocliente");
					for(var i=0;i<contactos.length;i++){ 
	           	 		$("#contactocliente").append("<option>" + contactos[i] + "</option>");
	 				};
	 				$("form #contactocliente").append("<option>- Agregar contacto -</option>");
				}
   			}
		});	
	})

	$('#modalNuevaRemision').on('show.bs.modal', function (e) {
		var idcontacto = "<?php echo $_REQUEST['id']; ?>";	
		var opcion = "nuevaremision";
		console.log(opcion);
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion, "idcontacto": idcontacto},
			success : function(data) {
				console.log(data);
				if(data.resultado == 'ok'){
					$("form #numeroCotizacion").val(data.numeroCotizacion);
					$("form #remision").val(data.remision);
					$("form #cliente").val(data.cliente);
					$("form #moneda").val(data.moneda);
				}
			}
		});
		var opcion = "buscarcontactos";
		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"idcliente": idcontacto, "opcion": opcion},
			success : function(data) {
				// console.log(data);
				if (data.respuesta == "Ninguno") {
					$("form #contactoCliente").empty();
					$("form #contactoCliente").append("<option>Ninguno</option>");
					$("form #contactoCliente").append("<option>- Agregar contacto -</option>");	
					$("#frmagregarcontacto #idcliente").val(data.idcliente);
				}else{
					var contactos = data;
					$('#contactoCliente').empty();
					var contacto = document.getElementById("contactoCliente");
					for(var i=0;i<contactos.length;i++){ 
						$("#contactoCliente").append("<option>" + contactos[i] + "</option>");
					};
					$("form #contactoCliente").append("<option>- Agregar contacto -</option>");
				}
			}
		});	
	})		

	function seleccionartodo(){
		$("input[name=hremision]").each(function (index) {
			if($("input[name=sel]").is(':checked')){
				$('input[name=hremision]').prop('checked' , true);
			}else{
				$('input[name=hremision]').prop('checked' , false);
			}
		});
	}

	function agregarcontacto(){
		var contacto = $("form #contactocliente").val();
		var contacto2 = $("#agregarRemision #contactocliente").val();
		if (contacto == "- Agregar contacto -" || contacto2 == "- Agregar contacto -") {
			$("#modalNuevaCotizacion").modal("hide");
			$("#modalNuevaRemision").modal("hide");
			$("#modalAgregarContacto").modal("show");
		}
	}

	$('#modalEditarInformacion').on('show.bs.modal', function (e) {
		var opcion = "informacioncontacto";
		var idcliente = "<?php echo $_REQUEST['id']; ?>";
  		$.ajax({
			method: "POST",
			url: "buscar.php",
			dataType: "json",
			data: {"opcion": opcion, "idcliente": idcliente},
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
				if (datos.respuesta == "agregarcotizacion") {
					var numero = datos.numero;
					var fecha = datos.fecha;
					var contacto = datos.contacto;
					var cliente = datos.cliente;
					var partidas = datos.partidas;
					window.location= "../cotizaciones/verCotizacion.php?numero="+numero;
				}else if(datos.respuesta == "nuevaremision"){
					var remision = datos.remision;
					window.location= "../remisiones/verRemision.php?remision="+remision;
				}else{
					console.log(datos);
					mostrar_mensaje(datos);
				}
			});
		});
	}

	var mostrar_mensaje = function( informacion ){
		var texto = "", color = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<div class='alert alert-success'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
			color = "#379911";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<div class='alert alert-danger'><strong>Error</strong>, no se ejecut� la consulta.</div>";
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