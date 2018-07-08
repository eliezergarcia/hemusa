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
	<title>Contacto cliente</title>
  	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
			<div class="page-head">
		  	<h2 class="page-head-title" style="font-size: 30px;"><b>Información de cliente</b></h2>
		  	<nav aria-label="breadcrumb">
        	<ol class="breadcrumb">
          	<li class="breadcrumb-item">Ventas</li>
          	<li class="breadcrumb-item"><a href="clientes.php" class="text-primary">Clientes</a></li>
          	<li class="breadcrumb-item active">Cliente: <?php echo $nombreContacto; ?></li>
        	</ol>
         </nav>
			</div>
			<div class="main-content container-fluid">
			  <div class="row full-calendar">
			    <div class="col-lg-12">
			        <div class="card card-fullcalendar">
						<div class="card-body">
							<!-- Menú -->
								<div class="container-fluid col-12 row justify-content-start align-items-center">
									<div>
										<span class="mdl-chip mdl-chip--contact">
						    				<h2><span class="mdl-chip__text"><?php echo $nombreContacto; ?></span></h2>
										</span>
									</div>
									<div class="col dropdown row justify-content-end align-items-center">
									 	<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    	<i class="fas fa-bars" aria-hidden="true"></i>
									  	</button>
									  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalEditarInformacion">Editar Información</button>
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaRemision">Nueva Remision</button>
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaCotizacion">Nueva Cotizacion</button>
									  	</div>
									</div>
								</div>
								<hr>

							<!-- Input de búsqueda -->
								<form class="form-horizontal row justify-content-center" action="pedidos.php" method="post">
									<div class="form-group col-12 row justify-content-center">
										<input type="text" class="form-control form-control-sm col-2" name="buscar" id="buscar" placeholder="Buscar">
									</div>
								</form>

							<!-- Grupo de botones -->
								<div class="row justify-content-center btn-toolbar">
									<div role="group" class="btn-group btn-group-justified mb-2 col-8">
										<a href="#" id="btncotizaciones" class="btn btn-primary btn-space" onclick="listar_cotizaciones()">COTIZACIONES</a href="#">
										<a href="#" id="btnremisiones" class="btn btn-primary btn-space" onclick="listar_remisiones()">REMISIONES</a href="#">
										<a href="#" id="btnsinentregar" class="btn btn-primary btn-space" onclick="listar_sinentregar()">SIN ENTREGAR</a href="#">
									  <a href="#" id="btnfacturado" class="btn btn-primary btn-space" onclick="listar_facturadonoentregado()">FACTURADO NO ENTREGADO</a href="#">
										<a href="#" id="btnnopagadas" class="btn btn-primary btn-space" onclick="listar_facturasnopagadas()">NO PAGADAS</a href="#">
									</div>
								</div>

							<!-- Listar sin entregar -->
								<div id="listar_sinentregar">
									<br>
									<center><h4><b>Herramienta sin entregar</b></h4></center>
									<table id="dt_listar_sinentregar" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>
												<th>Cantidad</th>
												<th>Precio Unitario</th>
												<th>Pedido</th>
												<th>Orden de compra</th>
												<th>Enviado</th>
												<th>Recibido</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar facturado no entregado -->
								<div id="listar_facturadonoentregado">
									<br>
									<center><h4><b>Herramienta facturada no entregada</b></h4></center>
									<table id="dt_listar_facturadonoentregado" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Ref.</th>
												<th>Fecha</th>
												<th>Cantidad</th>
												<th>Suma</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar facturas no pagadas -->
								<div id="listar_facturasnopagadas">
									<br>
									<center><h4><b>Facturas no pagadas</b></h4></center>
									<table id="dt_listar_facturasnopagadas" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Factura</th>
												<th>Orden compra</th>
												<th>Fecha factura</th>
												<th>Pagado</th>
												<th>Suma</th>
												<th>Moneda</th>
												<th>Vence factura</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar remisiones -->
								<div id="listar_remisiones">
									<br>
									<center><h4><b>Remisiones</b></h4></center>
									<table id="dt_listar_remisiones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Remision</th>
												<th>Ref. Cotización</th>
												<th>Cliente</th>
												<th>Contacto</th>
												<th>Fecha</th>
												<th>Cantidad</th>
												<th>Suma</th>
												<th>Moneda</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar cotizaciones -->
								<div id="listar_cotizaciones">
									<br>
									<center><h4><b>Cotizaciones</b></h4></center>
									<table id="dt_listar_cotizaciones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
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
						</div>
		       </div>
		    	</div>
				</div>
    	</div>
  	</div>

	<!-- Modal Agregar Clasificacion -->
		<form action="#" method="POST">
			<input type="hidden" id="opcion" name="opcion" value="agregarclas">
			<input type="hidden" id="idcliente" name="idcliente">
			<input type="hidden" id="usuariologin" name="usuariologin">
			<input type="hidden" id="dplogin" name="dplogin">
			<input type="hidden" id="nombrecliente" name="nombrecliente">
			<div class="modal fade colored-header colored-header-success" id="modalAgregarClas" tabindex="-1" role="dialog" aria-labelledby="modalAgregarClas" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="tituloEditarPartida"> Clasificación de cliente</h4>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			      			<div class="col-12 row justify-content-center form-group">
								<h4>Selecciona una opción:</h4>
							</div>
			      			<div class="row justify-content-center">
								<div class="col-2 form-check form-group">
                    <label class="custom-control custom-radio">
                      	<input type="radio" class="custom-control-input" name="clasificacion" id="clasificacion" value="clas1"><span class="custom-control-label">16 %</span>
                    </label>
                    <label class="custom-control custom-radio">
                      	<input type="radio" class="custom-control-input" name="clasificacion" id="clasificacion" value="clas2"><span class="custom-control-label">20 %</span>
                    </label>
                    <label class="custom-control custom-radio">
                      	<input type="radio" class="custom-control-input" name="clasificacion" id="clasificacion" value="clas3"><span class="custom-control-label">25 %</span>
                    </label>
                    <label class="custom-control custom-radio">
                      	<input type="radio" class="custom-control-input" name="clasificacion" id="clasificacion" value="clas4"><span class="custom-control-label">30 %</span>
                    </label>
                </div>
							</div>
						</div>
			      		<div class="modal-footer invoice-footer">
			        		<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        		<button type="submit" class="btn btn-lg btn-success">Guardar</button>
			      		</div>
			    	</div>
			  	</div>
			</div>
		</form>

	<!-- Modal Editar Información -->
		<form action="#" id="frmEditarInformacion" method="POST">
	 		<input type="hidden" id="opcion" name="opcion" value="editarinformacion">
	 		<input type="hidden" id="idcliente" name="idcliente">
			<input type="hidden" id="usuariologin" name="usuariologin">
			<input type="hidden" id="dplogin" name="dplogin">
			<div class="modal fade colored-header colored-header-primary" id="modalEditarInformacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modalNuevaCotizacionLabel">Información de cliente</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body container">
							<div class="row form-group">
								<label for="empresa" class="col-4">Empresa</label>
								<input type="text" id="empresa" name="empresa" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="alias" class="col-4">Alias</label>
								<input type="text" id="alias" name="alias" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="rfc" class="col-4">RFC</label>
								<input type="text" id="rfc" name="rfc" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="contacto" class="col-4">Contacto</label>
								<input type="text" id="contacto" name="contacto" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="calle" class="col-4">Calle</label>
								<input type="text" id="calle" name="calle" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="noexterior" class="col-4">No. Exterior</label>
								<input type="text" id="noexterior" name="noexterior" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="nointerior" class="col-4">No. Interior</label>
								<input type="text" id="nointerior" name="nointerior" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="colonia" class="col-4">Colonia</label>
								<input type="text" id="colonia" name="colonia" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="ciudad" class="col-4">Ciudad</label>
								<input type="text" id="ciudad" name="ciudad" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="estado" class="col-4">Estado</label>
								<input type="text" id="estado" name="estado" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="cp" class="col-4">C.P.</label>
								<input type="text" id="cp" name="cp" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="pais" class="col-4">País</label>
								<input type="text" id="pais" name="pais" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="tlf1" class="col-4">Teléfono #1</label>
								<input type="text" id="tlf1" name="tlf1" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="tlf2" class="col-4">Teléfono #2</label>
								<input type="text" id="tlf2" name="tlf2" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="movil" class="col-4">Móvil</label>
								<input type="text" id="movil" name="movil" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="correofac1" class="col-4">E-mail Facturacion #1</label>
								<input type="text" id="correofac1" name="correofac1" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="correofac2" class="col-4">E-mail Facturacion #2</label>
								<input type="text" id="correofac2" name="correofac2" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="correo" class="col-4">E-mail Facturacion</label>
								<input type="text" id="correo" name="correo" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="paginaweb" class="col-4">Página Web</label>
								<input type="text" id="paginaweb" name="paginaweb" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="credito" class="col-4">Crédito</label>
								<input type="text" id="credito" name="credito" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="contactohemusa" class="col-4">Contacto Hemusa</label>
								<input type="text" id="contactohemusa" name="contactohemusa" class="limpiar form-control form-control-sm col-7">
							</div>
							<div class="row form-group">
								<label for="moneda" class="col-4">Moneda</label>
								<select type="text" id="moneda" name="moneda" class="limpiar form-control form-control-sm col-7">
									<option value="mxn">MXN</option>
									<option value="usd">USD</option>
								</select>
							</div>
							<div class="row form-group">
								<label for="clasificacion" class="col-4">Clasificación</label>
								<select id="clasificacion" name="clasificacion" class="form-control form-control-sm col-7">
									<option value="1.20">16 %</option>
									<option value="1.25">20 %</option>
									<option value="1.33">25 %</option>
									<option value="1.42">30 %</option>
								</select>
							</div>
							<div class="row form-group">
								<label for="formapago" class="col-4">Forma de Pago</label>
								<select type="text" id="formapago" name="formapago" class="limpiar form-control form-control-sm col-7">
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
							<div class="row form-group">
								<label for="metodopago" class="col-4">Método de Pago</label>
								<select type="text" id="metodopago" name="metodopago" class="limpiar form-control form-control-sm col-7">
									<option value="1">Pago en una sola exhibición</option>
									<option value="2">Pago en parcialidades o diferido</option>
								</select>
							</div>
							<div class="row form-group">
								<label for="cfdi" class="col-4">Uso de CFDI</label>
								<select type="text" id="cfdi" name="cfdi" class="limpiar form-control form-control-sm col-7">
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
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-primary">Guardar</button>
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
			<div class="modal fade colored-header colored-header-success" id="modalNuevaCotizacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva cotización</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body container">
							<div class="row">
								<div class="col form-group">
									<label for="numerocotizacion">Número cotización <font color="#FF4136">*</font></label>
									<input type="text" id="numerocotizacion" name="numerocotizacion" class="limpiar disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="fechacotizacion">Fecha <font color="#FF4136">*</font></label>
									<input type="text" id="fechacotizacion" name="fechacotizacion" class="limpiar disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
									<input type="text" id="vendedor" name="vendedor" class="limpiar disabled form-control form-control-sm" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-7 form-group" >
										<label for="nombrecliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
										<input type="text" id="nombrecliente" name="nombrecliente" class="limpiar disabled form-control form-control-sm col-12" disabled>
								</div>
								<div class="col form-group">
									<label for="contactocliente">Contacto <font color="#FF4136">*</font></label>
									<select name="contactocliente" id="contactocliente" class="form-control form-control-sm select2" onchange="agregarcontacto()" required>

									</select>
								</div>
							</div>
							<div class="row">
									<div class="col-3 form-group">
										<label for="moneda" class="col-12">Moneda <font color="#FF4136">*</font></label>
										<select id="moneda" name="moneda" class="form-control form-control-sm select2" required>
											<option>
												<option value="mxn">MXN</option>
												<option value="usd">USD</option>
											</option>
										</select>
									</div>
									<div class="col-4 form-group">
										<label for="tiempoEntrega" class="col-12">Tiempo de entrega <font color="#FF4136">*</font></label>
										<input type="text" id="tiempoEntrega" name="tiempoEntrega" class="awesomplete form-control form-control-sm col-12" list="clientes" placeholder="días" required/>
									</div>
									<div class="col form-group">
										<label for="condicionesPago">Condiciones de pago</label>
										<input type="text" id="condicionesPago" name="condicionesPago" class="form-control form-control-sm" placeholder="Opcional">
									</div>
							</div>
							<div class="row">
								<div class="col form-group">
									<label for="comentarios" class="col-12">Comentarios</label>
									<textarea name="comentarios" id="comentarios" class="form-control form-control-sm" cols="30" rows="3" placeholder="Opcional"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-success">Hecho</button>
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
			<div class="modal fade colored-header colored-header-success" id="modalAgregarContacto" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
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
										<input type="text" id="contacto" name="contacto" class="form-control form-control-sm" required>
									</div>
									<div class="form-group col">
										<label for="puesto">Puesto <font color="#FF4136">*</font></label>
										<input type="text" id="puesto" name="puesto" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="calle">Calle</label>
										<input type="text" id="calle" name="calle" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="colonia">Colonia</label>
										<input type="text" id="colonia" name="colonia" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="ciudad">Ciudad</label>
										<input type="text" id="ciudad" name="ciudad" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="estado">Estado</label>
										<input type="text" id="estado" name="estado" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="cp">C.P.</label>
										<input type="text" id="cp" name="cp" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="pais">Pais</label>
										<input type="text" id="pais" name="pais" class="form-control form-control-sm" placeholder="Opcional">
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="tlf">Telefono</label>
										<input type="text" id="tlf" name="tlf" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="movil">Movil</label>
										<input type="text" id="movil" name="movil" class="form-control form-control-sm" placeholder="Opcional">
									</div>
									<div class="form-group col">
										<label for="correoElectronico">Correo electronico <font color="#FF4136">*</font></label>
										<input type="text" id="correoElectronico" name="correoElectronico" class="form-control form-control-sm">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-success" name="crearCotizacion">Agregar</button>
						</div>
					</div>
				</div>
			</div>
		</form>

	<!-- Modal Nueva Remisión -->
		<form name="agregarRemision" action="#" method="POST">
			<input type="hidden" id="opcion" name="opcion" value="nuevaremision">
			<div class="modal fade colored-header colored-header-success" id="modalNuevaRemision" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modalNuevaCotizacionLabel">Nueva remisión</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body container">
							<div class="row">
								<div class="col form-group">
									<label for="numeroCotizacion">Referencia <font color="#FF4136">*</font></label>
									<input type="text" id="numeroCotizacion" name="numeroCotizacion" class="disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="remision">Remision <font color="#FF4136">*</font></label>
									<input type="text" id="remision" name="remision" class="disabled form-control form-control-sm" disabled>
								</div>
								<div class="col form-group">
									<label for="fechaCotizacion">Fecha <font color="#FF4136">*</font></label>
									<input type="text" id="fechaCotizacion" name="fechaCotizacion" class="disabled form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" disabled>
								</div>
								<div class="col form-group">
									<label for="vendedor">Vendedor <font color="#FF4136">*</font></label>
									<input type="text" id="vendedor" name="vendedor" class="disabled form-control form-control-sm" value="<?php echo $usuario." ".$usuarioApellido; ?>" disabled>
								</div>
							</div>
							<div class="row">
									<div class="col-7 form-group">
										<label for="cliente" class="col-12">Cliente <font color="#FF4136">*</font></label>
										<input placeholder="Busca un cliente" class="disabled form-control form-control-sm col-12" data-min-length="1" list="clientes" id="cliente" name="cliente" type="text" onchange="buscarDatosCliente()" disabled required>
										<!-- <datalist id="clientes">
										</datalist> -->
									</div>
									<div class="col form-group">
										<label for="contactoCliente">Contacto <font color="#FF4136">*</font></label>
										<select name="contactoCliente" id="contactoCliente" class="form-control form-control-sm select2" onchange="agregarcontacto()" required>
											<option value="">Selecciona</option>
										</select>
									</div>
							</div>
							<div class="row">
									<div class="col-3 form-group">
										<label for="moneda" class="col-12">Moneda <font color="#FF4136">*</font></label>
										<select id="moneda" name="moneda" class="form-control form-control-sm select2" required>
											<option>
												<option value="mxn" selected>MXN</option>
												<option value="usd">USD</option>
											</option>
										</select>
									</div>
									<div class="col form-group">
										<label for="comentarios" class="col-12">Comentarios</label>
										<textarea name="comentarios" id="comentarios" class="form-control form-control-sm" cols="30" rows="3" placeholder="Opcional"></textarea>
									</div>
							</div>
							<!-- <div class="row">
							</div> -->
						</div>
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-success">Hecho</button>
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

		<div id="mod-cotizacion" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="texto1">
                <br><br>
                <h3>Espere un momento...</h3>
                <h4>La cotización se esta generando</h4>
                <br>
                <div class="text-center">
                  <div class="be-spinner">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                      <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="mt-8">
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

		<div id="mod-remision" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="texto1">
                <br><br>
                <h3>Espere un momento...</h3>
                <h4>La remisión se esta generando</h4>
                <br>
                <div class="text-center">
                  <div class="be-spinner">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                      <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="mt-8">
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

	</header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			var idusuario = "<?php echo $idusuario; ?>";
			console.log(idusuario);
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

		var listar_sinentregar = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideDown("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			$("#btnsinentregar").removeClass("btn-secondary");
			$("#btnsinentregar").addClass("btn-primary");
			$("#btnfacturado").removeClass("btn-primary");
			$("#btnfacturado").addClass("btn-secondary");
			$("#btnremisiones").removeClass("btn-primary");
			$("#btnremisiones").addClass("btn-secondary");
			$("#btncotizaciones").removeClass("btn-primary");
			$("#btncotizaciones").addClass("btn-secondary");
			$("#btnnopagadas").removeClass("btn-primary");
			$("#btnnopagadas").addClass("btn-secondary");
			var opcion = "sinentregar";
			var buscar = $("#buscar").val();
			var table = $("#dt_listar_sinentregar").DataTable({
      "destroy":"true",
			"scrollX": true,
			"autoWidth": false,
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
			  {"data": "recibido"},
				{"defaultContent": "<div class='invoice-footer'><button class='verherramienta btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		   ],
			 "columnDefs": [
			    { "width": "5%", "className": "dt-center", "targets": 0 },
					{ "width": "10%", "targets": 1 },
					{ "width": "10%", "targets": 2 },
					{ "width": "7%", "targets": 4 },
					{ "width": "10%", "targets": 5 },
					{ "width": "10%", "targets": 6 },
					{ "width": "8%", "targets": 7 },
					{ "width": "8%", "targets": 8 },
					{ "width": "8%", "targets": 9 },
			  ],
		   "language": idioma_espanol,
			 "dom":
    		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
    		"<'row be-datatable-body'<'col-sm-12'tr>>" +
    		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
			 "buttons":[
          {
            extend: 'collection',
            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
            "className": "btn btn-lg btn-space btn-secondary",
            buttons: [
                {
                  extend:    'excelHtml5',
                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                  }
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
                  download: 'open',
                  // "className": "btn btn-lg btn-space btn-secondary",
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                  },
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
				]
		    });
				obtener_data_ver_herramienta("#dt_listar_sinentregar tbody", table);
		}

		var listar_facturadonoentregado = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_facturadonoentregado").slideDown("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			$("#btnfacturado").removeClass("btn-secondary");
			$("#btnfacturado").addClass("btn-primary");
			$("#btnsinentregar").removeClass("btn-primary");
			$("#btnsinentregar").addClass("btn-secondary");
			$("#btnremisiones").removeClass("btn-primary");
			$("#btnremisiones").addClass("btn-secondary");
			$("#btncotizaciones").removeClass("btn-primary");
			$("#btncotizaciones").addClass("btn-secondary");
			$("#btnnopagadas").removeClass("btn-primary");
			$("#btnnopagadas").addClass("btn-secondary");
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
		          {"data": "suma"},
							{"defaultContent": "<div class='invoice-footer'><button class='vercotizacion btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		        ],
		        "language": idioma_espanol,
				"dom":
	          		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          		"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons":[
		            {
			            extend: 'collection',
			            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
			            "className": "btn btn-lg btn-space btn-secondary",
			            buttons: [
			                {
			                  extend:    'excelHtml5',
			                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'csv',
			                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend:    'pdfHtml5',
			                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
			                  download: 'open',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'print',
			                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
			                  header: 'false',
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  },
			                  orientation: 'landscape',
			                  pageSize: 'LEGAL'
			                }
			            ]
			        },
				]
		    });
				obtener_data_ver_cotizacion_facturado("#dt_listar_facturadonoentregado tbody", table);
		}

		var listar_remisiones = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideDown("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			$("#btnremisiones").removeClass("btn-secondary");
			$("#btnremisiones").addClass("btn-primary");
			$("#btnsinentregar").removeClass("btn-primary");
			$("#btnsinentregar").addClass("btn-secondary");
			$("#btnfacturado").removeClass("btn-primary");
			$("#btnfacturado").addClass("btn-secondary");
			$("#btncotizaciones").removeClass("btn-primary");
			$("#btncotizaciones").addClass("btn-secondary");
			$("#btnnopagadas").removeClass("btn-primary");
			$("#btnnopagadas").addClass("btn-secondary");
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
					{"data": "cotizacion"},
          {"data": "cliente"},
          {"data": "contacto"},
          {"data": "fecha"},
				  {"data": "cantidad"},
				  {"data": "suma"},
				  {"data": "moneda"},
					{"defaultContent": "<div class='invoice-footer'><button class='verremision btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		        ],
		        "language": idioma_espanol,
				"dom":
	          		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          		"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons":[
		            {
			            extend: 'collection',
			            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
			            "className": "btn btn-lg btn-space btn-secondary",
			            buttons: [
			                {
			                  extend:    'excelHtml5',
			                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
			                  }
			                },
			                {
			                  extend: 'csv',
			                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
			                  }
			                },
			                {
			                  extend:    'pdfHtml5',
			                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
			                  download: 'open',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
			                  }
			                },
			                {
			                  extend: 'print',
			                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
			                  header: 'false',
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
			                  },
			                  orientation: 'landscape',
			                  pageSize: 'LEGAL'
			                }
			            ]
			        },
				]
		    });
				obtener_data_ver_remision("#dt_listar_remisiones tbody", table);
		}

		var listar_facturasnopagadas = function () {
				var idcliente = "<?php echo $_REQUEST['id']; ?>";
				$("#listar_facturadonoentregado").slideUp("slow");
				$("#listar_sinentregar").slideUp("slow");
				$("#listar_remisiones").slideUp("slow");
				$("#listar_cotizaciones").slideUp("slow");
				$("#listar_facturasnopagadas").slideDown("slow");
				$("#btncotizaciones").removeClass("btn-primary");
				$("#btncotizaciones").addClass("btn-secondary");
				$("#btnsinentregar").removeClass("btn-primary");
				$("#btnsinentregar").addClass("btn-secondary");
				$("#btnfacturado").removeClass("btn-primary");
				$("#btnfacturado").addClass("btn-secondary");
				$("#btnremisiones").removeClass("btn-primary");
				$("#btnremisiones").addClass("btn-secondary");
				$("#btnnopagadas").removeClass("btn-secondary");
				$("#btnnopagadas").addClass("btn-primary");
				var opcion = "facturasnopagadas";
				var buscar = $("#buscar").val();
				var table = $("#dt_listar_facturasnopagadas").DataTable({
	        "destroy":"true",
	        "ajax":{
	          "method":"POST",
	          "url":"listar.php" ,
	          "data": {"idcliente": idcliente, "opcion": opcion, "buscar": buscar},
	        },
	        "columns":[
	          {"data": "indice"},
	          {"data": "factura"},
	          {"data": "pedido"},
	          {"data": "fechafactura"},
	          {"data": "pagado"},
						{"data": "suma"},
						{"data": "moneda"},
						{"data": "vencefactura"},
						{"defaultContent": "<div class='invoice-footer'><button class='vercotizacion btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
	        ],
			    "language": idioma_espanol,
					"dom":
        		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
        		"<'row be-datatable-body'<'col-sm-12'tr>>" +
        		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
				            extend: 'collection',
				            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
				            "className": "btn btn-lg btn-space btn-secondary",
				            buttons: [
				                {
				                  extend:    'excelHtml5',
				                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4 ]
				                  }
				                },
				                {
				                  extend: 'csv',
				                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4 ]
				                  }
				                },
				                {
				                  extend:    'pdfHtml5',
				                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
				                  download: 'open',
				                  // "className": "btn btn-lg btn-space btn-secondary",
				                  exportOptions: {
				                    columns: [ 0, 1, 2, 3, 4 ]
				                  }
				                },
				                {
				                  extend: 'print',
				                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
				                  header: 'false',
				                  exportOptions: {
				                          columns: [ 0, 1, 2, 3, 4 ]
				                  },
				                  orientation: 'landscape',
				                  pageSize: 'LEGAL'
				                }
				            ]
				        },
					]
			    });
					obtener_data_ver_cotizacion_nopagada("#dt_listar_facturasnopagadas tbody", table);
		}

		var listar_cotizaciones = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideDown("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			$("#btncotizaciones").removeClass("btn-secondary");
			$("#btncotizaciones").addClass("btn-primary");
			$("#btnsinentregar").removeClass("btn-primary");
			$("#btnsinentregar").addClass("btn-secondary");
			$("#btnfacturado").removeClass("btn-primary");
			$("#btnfacturado").addClass("btn-secondary");
			$("#btnremisiones").removeClass("btn-primary");
			$("#btnremisiones").addClass("btn-secondary");
			$("#btnnopagdas").removeClass("btn-primary");
			$("#btnnopagdas").addClass("btn-secondary");
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
				  {"defaultContent": "<div class='invoice-footer'><button class='vercotizacion btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		        ],
		        "language": idioma_espanol,
				"dom":
	          		"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
	          		"<'row be-datatable-body'<'col-sm-12'tr>>" +
	          		"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
					"buttons":[
			            {
			            extend: 'collection',
			            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
			            "className": "btn btn-lg btn-space btn-secondary",
			            buttons: [
			                {
			                  extend:    'excelHtml5',
			                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'csv',
			                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend:    'pdfHtml5',
			                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
			                  download: 'open',
			                  // "className": "btn btn-lg btn-space btn-secondary",
			                  exportOptions: {
			                    columns: [ 0, 1, 2, 3, 4 ]
			                  }
			                },
			                {
			                  extend: 'print',
			                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
			                  header: 'false',
			                  exportOptions: {
			                          columns: [ 0, 1, 2, 3, 4 ]
			                  },
			                  orientation: 'landscape',
			                  pageSize: 'LEGAL'
			                }
			            ]
			        },
					]
		    });
			obtener_data_ver_cotizacion("#dt_listar_cotizaciones tbody", table);
		}

		var obtener_data_ver_cotizacion = function(tbody, table){
			$(tbody).on("click", "button.vercotizacion", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var cotizacion = data.cotizacion;
				var remision = data.remision;
				var pedido = data.pedido;

				if(remision == 0 || remision == ""){
					window.location.href = "../pedidos/verPedido.php?refCotizacion="+cotizacion+"&numeroPedido="+pedido;
				}else{
					window.location.href = "../remisiones/verRemision.php?remision="+remision;
				}
			});
		}

		var obtener_data_ver_cotizacion_nopagada = function(tbody, table){
			$(tbody).on("click", "button.vercotizacion", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var cotizacion = data.cotizacion;
				var remision = data.remision;
				var pedido = data.pedido;

				if(remision == 0 || remision == ""){
					window.location.href = "../pedidos/verPedido.php?refCotizacion="+cotizacion+"&numeroPedido="+pedido;
				}else{
					window.location.href = "../remisiones/verRemision.php?remision="+remision;
				}
			});
		}

		var obtener_data_ver_cotizacion_facturado = function(tbody, table){
			$(tbody).on("click", "button.vercotizacion", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var cotizacion = data.cotizacion;
				var remision = data.remision;
				var pedido = data.pedido;

				if(remision == 0 || remision == ""){
					window.location.href = "../pedidos/verPedido.php?refCotizacion="+cotizacion+"&numeroPedido="+pedido;
				}else{
					window.location.href = "../remisiones/verRemision.php?remision="+remision;
				}
			});
		}

		var obtener_data_ver_remision = function(tbody, table){
			$(tbody).on("click", "button.verremision", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var remision = data.remision;
				window.location.href = "../remisiones/verRemision.php?remision="+remision;
			});
		}

		var obtener_data_ver_herramienta = function(tbody, table){
			$(tbody).on("click", "button.verherramienta", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				var cotizacion = data.cotizacion;
				var remision = data.remision;
				var pedido = data.pedido;

				if(remision == 0 || remision == ""){
					window.location.href = "../pedidos/verPedido.php?refCotizacion="+cotizacion+"&numeroPedido="+pedido;
				}else{
					window.location.href = "../remisiones/verRemision.php?remision="+remision;
				}
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
				// if(data.data.clasificacion == 0){
				// 	estandar = alert("El cliente no tiene asignado ningúna clasificación.\n\nFavor de asignar a continuación para poder cotizar.");
				// 	$('#modalAgregarClas').modal('show');
				// }

				$("form #nombrecliente").val(data.data.nombreEmpresa);
				$("#moneda").val(data.data.moneda).change();
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
				$("#moneda").val(data.moneda).change();
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
						$("form #moneda").val(data.moneda).change();
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
				console.log(data);
				$("#empresa").val(data.contacto.nombreEmpresa);
				$("#alias").val(data.contacto.alias);
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
				$("#frmEditarInformacion #clasificacion").val(data.contacto.clasificacion).change();
				$("#formapago").val(data.contacto.IdFormaPago);
				$("#metodopago").val(data.contacto.IdMetodoPago);
				$("#cfdi").val(data.contacto.IdUsoCFDI);
			});
		})

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$("form .disabled").attr("disabled", false);
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: frm,
				}).done( function( info ){
					if (info.respuesta == "agregarcontacto") {
						var numero = info.numero;
						$('#modalAgregarContacto').modal('hide');
						info.respuesta = "BIEN";
						mostrar_mensaje(info);
						buscarDatosCliente(info.idcliente);
					}else if (info.respuesta == "agregarcotizacion") {
						$(".modal").modal("hide");
						$("#mod-cotizacion").modal("show");
						setTimeout(function () {
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
						}, 2000);
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La cotización se generó correctamente.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
							$(".texto1").append("</div>");
						}, 2500);
						setTimeout(function () {
							window.location= "../cotizaciones/verCotizacion.php?numero="+info.numero;
						}, 4000);
					}else if(info.respuesta == "nuevaremision"){
						$(".modal").modal("hide");
						$("#mod-remision").modal("show");
						setTimeout(function () {
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
						}, 2000);
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La remisión se generó correctamente.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
							$(".texto1").append("</div>");
						}, 2500);
						setTimeout(function () {
							window.location= "../remisiones/verRemision.php?remision="+info.remision;
						}, 4000);
					}else{
						$("#mod-cotizacion").modal("hide");
						$("#mod-remision").modal("hide");
						mostrar_mensaje(info);
					}
				});
			});
		}

	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
