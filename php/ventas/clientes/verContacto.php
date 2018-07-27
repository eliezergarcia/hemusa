<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
	$idContacto = $_REQUEST['id'];
	$fecha = date("d").'-'.date("m").'-'.date("Y");
	$vendedor = $usuario.' '.$usuarioApellido;
	$query = "SELECT * FROM contactos WHERE id ='".$idContacto."'";
	$resultado = mysqli_query($conexion_usuarios, $query);
	while($row = mysqli_fetch_array($resultado)){
		$nombreContacto = $row['nombreEmpresa'];
		$tipo = $row['tipo'];
		$RFC = $row['RFC'];
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
									 	<button class="btn btn-lg btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Menú <i class="fa fa-bars" aria-hidden="true"></i>
									  	</button>
									  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalEditarInformacion">Información de cliente</button>
												<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalAgregarContacto">Agregar contacto</button>
												<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalCuentasBanco">Cuentas de banco</button>
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaRemision">Nueva Remision</button>
									    	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalNuevaCotizacion">Nueva Cotizacion</button>
									  	</div>
									</div>
								</div>
								<hr>
								<div class="row table-filters-container">
									<div class="col-12">
										<div class="row">
											<div class="col-4 table-filters"><span class="table-filter-title">Herramienta/Estado</span>
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-4">
															 <label class="custom-control custom-radio">
																 <input class="custom-control-input" type="radio" name="filtroestado" value="enpedido" checked onclick="listar_enpedido()"><span class="custom-control-label">En pedido</span>
															 </label>
															 <label class="custom-control custom-radio">
																 <input class="custom-control-input" type="radio" name="filtroestado" value="sinentregar"  onclick="listar_sinentregar()"><span class="custom-control-label">Sin entregar</span>
															 </label>
															</div>
															<div class="col-4">
																<label class="custom-control custom-radio">
																	<input class="custom-control-input" type="radio" name="filtroestado" value="sinproveedor"  onclick="listar_sinproveedor()"><span class="custom-control-label">Sin proveedor</span>
																</label>
															</div>
															<div class="col-4">
																<label class="custom-control custom-radio">
																	<input class="custom-control-input" type="radio" name="filtroestado" value="cotizaciones"  onclick="listar_cotizaciones()"><span class="custom-control-label">Cotizaciones</span>
																</label>
																<label class="custom-control custom-radio">
																	<input class="custom-control-input" type="radio" name="filtroestado" value="remisiones"  onclick="listar_remisiones()"><span class="custom-control-label">Remisiones</span>
																</label>
															</div>
															<!-- <div class="col-3">
																<label class="custom-control custom-radio">
																	<input class="custom-control-input" type="radio" name="filtroestado" value="nopagadas"  onclick="listar_facturasnopagadas()"><span class="custom-control-label">Facturas no pagadas</span>
																</label>
															</div> -->
														</div>
													</form>
												</div>
											</div>
											<div class="col-3 table-filters"><span class="table-filter-title">Referencia</span>
												<div class="filter-container">
													<form>
														<div class="row">
															<div class="col-8">
																<label class="control-label">Palabra:</label>
																<input type="text" class="form-control form-control-sm" name="buscar" id="buscar" value="">
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

							<!-- Input de búsqueda -->
								<!-- <form class="form-horizontal row justify-content-center" action="pedidos.php" method="post">
									<div class="form-group col-12 row justify-content-center">
										<input type="text" class="form-control form-control-sm col-2" name="buscar" id="buscar" placeholder="Buscar">
									</div>
								</form> -->

							<!-- Grupo de botones -->
								<!-- <div class="row justify-content-center btn-toolbar">
									<div role="group" class="btn-group btn-group-justified mb-2 col-8">
										<a href="#" id="btncotizaciones" class="btn btn-primary btn-space" onclick="listar_cotizaciones()">COTIZACIONES</a href="#">
										<a href="#" id="btnremisiones" class="btn btn-primary btn-space" onclick="listar_remisiones()">REMISIONES</a href="#">
										<a href="#" id="btnsinentregar" class="btn btn-primary btn-space" onclick="listar_sinentregar()">SIN ENTREGAR</a href="#">
									  <a href="#" id="btnfacturado" class="btn btn-primary btn-space" onclick="listar_facturadonoentregado()">FACTURADO NO ENTREGADO</a href="#">
										<a href="#" id="btnnopagadas" class="btn btn-primary btn-space" onclick="listar_facturasnopagadas()">NO PAGADAS</a href="#">
									</div>
								</div> -->

							<!-- Listar en pedido -->
								<div id="listar_enpedido">
									<table id="dt_listar_enpedido" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
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
												<th>Entregado</th>
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar sin proveedor -->
								<div id="listar_sinproveedor">
									<table id="dt_listar_sinproveedor" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>
												<th>Cantidad</th>
												<th>Precio Unitario</th>
												<!-- <th>Pedido</th>
												<th>Orden de compra</th>
												<th>Enviado</th>
												<th>Recibido</th>
												<th>Entregado</th> -->
												<th>Ver</th>
											</tr>
										</thead>
									</table>
								</div>

							<!-- Listar sin entregar -->
								<div id="listar_sinentregar">
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
									<table id="dt_listar_remisiones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th></th>
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
									<table id="dt_listar_cotizaciones" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Referencia</th>
												<th>Cliente</th>
												<th>Vendedor</th>
												<th>Contacto</th>
												<th>Fecha</th>
												<th>Partidas</th>
												<th>Total (Sin IVA)</th>
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

	<!-- Modal Cuentas Banco -->
		<div class="modal fade" id="modalCuentasBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  colored-header colored-header-primary" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><b>Cuentas de banco</b></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="dt_cuentas_banco" class="table table-hover table-striped display compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Cuenta</th>
									<th>Moneda</th>
									<th>Ver</th>
									<th>Eliminar</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

	<!-- Modal Agregar Cuenta Banco -->
		<div class="modal fade" id="modalAgregarCuentaBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  colored-header colored-header-success" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><b>Agregar cuenta</b></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="idclienteagregarcuenta" id="idclienteagregarcuenta" value="">
						<div class="row form-group justify-content-center align-items-center">
							<label for="cuenta">Cuenta </label>
							<input type="text" id="cuenta" name="cuenta" class="form-control form-control-sm col-3" placeholder="4 dígitos">
						</div>
						<div class="row form-group justify-content-center">
							<label for="monedacuenta">Moneda </label>
							<select type="text" id="monedacuenta" name="monedacuenta" class="form-control form-control-sm col-3">
								<option value="mxn" selected>MXN</option>
								<option value="usd">USD</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-lg btn-success" data-dismiss="modal" onclick="agregar_cuenta()">Agregar</button>
					</div>
				</div>
			</div>
		</div>

	<!-- Modal Editar Cuenta Banco -->
		<div class="modal fade" id="modalEditarCuentaBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  colored-header colored-header-primary" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><b>Editar cuenta</b></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="idcuentaeditar" id="idcuentaeditar" value="">
						<div class="row form-group justify-content-center align-items-center">
							<label for="cuentaeditar">Cuenta </label>
							<input type="text" id="cuentaeditar" name="cuentaeditar" class="form-control form-control-sm col-3" placeholder="4 dígitos">
						</div>
						<div class="row form-group justify-content-center">
							<label for="monedacuentaeditar">Moneda </label>
							<select type="text" id="monedacuentaeditar" name="monedacuentaeditar" class="form-control form-control-sm col-3">
								<option value="mxn" selected>MXN</option>
								<option value="usd">USD</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-lg btn-primary" data-dismiss="modal" onclick="editar_cuenta()">Editar</button>
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

	<!-- Modal Información Facturar -->
		<div class="modal fade colored-header colored-header-success" id="modalInformacionFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h4 class="modal-title" id="exampleModalLabel"><b>Información de factura</b></h4>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div class="modal-body">
								<h4>Por favor verifique los datos a continuación antes de facturar:</h4>
			        	<form id="frmInformacionFactura" action="" method="POST">
									<div class="row form-group">
		        				<div class="col-4">
		        					<label for="entorno">Seleccione el entorno: <font color="#FF4136">*</font></label>
											<select type="text" id="entorno" name="entorno" class="form-control form-control-sm">
												<option value="produccion">Produccion</option>
												<option value="pruebas">Pruebas</option>
											</select>
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col-8">
		        					<label for="cliente">Cliente <font color="#FF4136">*</font></label>
		        					<input type="text" id="cliente" name="cliente" class="form-control form-control-sm" disabled required>
		        				</div>
		        				<div class="col">
		        					<label for="tipoDocumento">Tipo de documento <font color="#FF4136">*</font></label>
		        					<!-- <input type="text" id="tipoDocumento" name="tipoDocumento" class="form-control form-control-sm" value="factura" disabled required> -->
											<select type="text" id="tipoDocumento" name="tipoDocumento" class="form-control form-control-sm">
												<option value="factura">Factura</option>
												<!-- <option value="factura/pagoanticipado">Factura/Pago anticipado</option> -->
												<!-- <option value="refacturacion">Refacturación</option> -->
											</select>
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="fecha">Fecha <font color="#FF4136">*</font></label>
		        					<input type="text" id="fecha" name="fecha" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" disabled required>
		        				</div>
		        				<div class="col">
		        					<label for="moneda">Moneda <font color="#FF4136">*</font></label>
		        					<input type="text" id="moneda" name="moneda" class="form-control form-control-sm" disabled required>
		        				</div>
										<div class="col">
											<label for="tipoCambio">Tipo de cambio </label>
											<input type="text" id="tipoCambio" name="tipoCambio" class="form-control form-control-sm" disabled required>
										</div>
										<div class="col">
											<label for="numeroOrden">Número de orden <font color="#FF4136">*</font></label>
											<input type="text" id="numeroOrden" name="numeroOrden" class="form-control form-control-sm" required>
										</div>
		        			</div>
		        			<div class="row form-group">
										<div class="col">
											<label for="cuenta">Cuenta </label>
											<!-- <input type="text" id="usoCFDI" name="usoCFDI" class="form-control form-control-sm" disabled required> -->
											<input id="cuenta" name="cuenta" class="form-control form-control-sm">
										</div>
										<div class="col-5">
											<label for="usoCFDI">Uso de CFDI <font color="#FF4136">*</font></label>
											<!-- <input type="text" id="usoCFDI" name="usoCFDI" class="form-control form-control-sm" disabled required> -->
											<select id="usoCFDI" name="usoCFDI" class="form-control form-control-sm" disabled>
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
										<div class="col-5">
											<label for="formaPago">Forma de pago <font color="#FF4136">*</font></label>
											<!-- <input type="text" id="formaPago" name="formaPago" class="form-control form-control-sm" disabled required> -->
											<select type="text" id="formaPago" name="formaPago" class="form-control form-control-sm" disabled>
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
		        			<div class="row form-group">
										<div class="col">
											<label for="metodoPago">Método de pago <font color="#FF4136">*</font></label>
											<!-- <input type="text" id="metodoPago" name="metodoPago" class="form-control form-control-sm" disabled required> -->
											<select type="text" id="metodoPago" name="metodoPago" class="form-control form-control-sm" disabled>
												<option value="1">Pago en una sola exhibición</option>
												<option value="2">Pago en parcialidades o diferido</option>
											</select>
										</div>
										<div class="col">
											<label for="condicionesPago">Condiciones de pago <font color="#FF4136">*</font></label>
											<input type="text" id="condicionesPago" name="condicionesPago" class="form-control form-control-sm" disabled required>
										</div>
		        			</div>
		        			<div class="row form-group">
										<div class="col-3">
											<label for="enviarCorreo">Enviar por correo </label>
											<!-- <input type="text" id="enviarCorreo" name="enviarCorreo" class="form-control form-control-sm" required> -->
											<select type="text" id="enviarCorreo" name="enviarCorreo" class="form-control form-control-sm" required>
												<option value="true" selected>Envíar</option>
												<option value="false">No envíar</option>
											</select>
										</div>
		        			</div>
			        	</form>
								<hr>
								<table id="dt_partidas_facturar" class="table table-hover table-striped display compact" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Marca</th>
											<th>Modelo</th>
											<th>Precio Unitario</th>
											<th>Cantidad</th>
											<th>Precio Total</th>
										</tr>
									</thead>
								</table>
								<br>
								<div class="row justify-content-end">
									<div class="col-6">
										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<th><h5><b>SUB-TOTAL:</b></h5></th>
													<th><h5><label style="font-size: 15px;" id="subtotalFactura"></h5></label></th>
												</tr>
												<tr>
													<th><h5><b>IVA (16%):</b></h5></th>
													<th><h5><label style="font-size: 15px;" id="ivaFactura"></label></h5></th>
												</tr>
												<tr>
													<th><h5><b>TOTAL:</b></h5></th>
													<th><h5><b><label style="font-size: 18px;" class="text-primary" id="totalFactura"></label></b></h5></th>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
			      	</div>
			      	<div class="modal-footer invoice-footer">
			        	<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        	<button type="button" class="btn btn-lg btn-success" id="generarFactura">Generar</button>
			      	</div>
		    	</div>
		  	</div>
		</div>

		<!-- Modal Registrar Cliente en Portal -->
			<div class="modal fade colored-header colored-header-success" id="modalRegistrarClientePortal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="exampleModalLabel"><b>Registro de cliente en portal Factura.com</b></h4>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
				      	<div class="modal-body">
									<h4>Por favor verifique los datos del cliente:</h4>
				        	<form id="frmRegistrarClientePortal" action="" method="POST">
			        			<div class="row form-group">
			        				<div class="col">
			        					<label for="nombre">Nombre</label>
			        					<input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Opcional">
			        				</div>
			        				<div class="col">
			        					<label for="apellidos">Apellidos</label>
			        					<input type="text" id="apellidos" name="apellidos" class="form-control form-control-sm" placeholder="Opcional">
			        				</div>
			        			</div>
			        			<div class="row form-group">
			        				<div class="col">
			        					<label for="email">Correo electronico <font color="#FF4136">*</font></label>
			        					<input type="text" id="email" name="email" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="telefono">Teléfono</label>
			        					<input type="text" id="telefono" name="telefono" class="form-control form-control-sm" placeholder="Opcional">
			        				</div>
			        			</div>
			        			<div class="row form-group">
			        				<div class="col">
			        					<label for="razons">Razón Social <font color="#FF4136">*</font></label>
			        					<input type="text" id="razons" name="razons" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="rfc">RFC <font color="#FF4136">*</font></label>
			        					<input type="text" id="rfc" name="rfc" class="form-control form-control-sm">
			        				</div>
			        			</div>
			        			<div class="row form-group">
			        				<div class="col">
			        					<label for="numero_exterior">Número exterior <font color="#FF4136">*</font></label>
			        					<input type="text" id="numero_exterior" name="numero_exterior" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="numero_interior">Número interior</label>
			        					<input type="text" id="numero_interior" name="numero_interior" class="form-control form-control-sm" placeholder="Opcional">
			        				</div>
			        				<div class="col">
			        					<label for="codpos">Código Postal <font color="#FF4136">*</font></label>
			        					<input type="text" id="codpos" name="codpos" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="calle">Calle <font color="#FF4136">*</font></label>
			        					<input type="text" id="calle" name="calle" class="form-control form-control-sm">
			        				</div>
			        			</div>
			        			<div class="row form-group">
			        				<div class="col">
			        					<label for="colonia">Colonia <font color="#FF4136">*</font></label>
			        					<input type="text" id="colonia" name="colonia" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="estado">Estado <font color="#FF4136">*</font></label>
			        					<input type="text" id="estado" name="estado" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="ciudad">Ciudad <font color="#FF4136">*</font></label>
			        					<input type="text" id="ciudad" name="ciudad" class="form-control form-control-sm">
			        				</div>
			        				<div class="col">
			        					<label for="delegacion">Delegación <font color="#FF4136">*</font></label>
			        					<input type="text" id="delegacion" name="delegacion" class="form-control form-control-sm">
			        				</div>
			        			</div>
				        	</form>
				      	</div>
				      	<div class="modal-footer invoice-footer">
				        	<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
				        	<button type="button" id="registrar-cliente-portal" class="btn btn-lg btn-success">Agregar</button>
				      	</div>
			    	</div>
			  	</div>
			</div>

		<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					</div>
					<div class="modal-body">
						<div class="text-center">
							<div class="texto1">
								<br><br>
								<h3>Espere un momento...</h3>
								<h4>Se está generando la factura</h4>
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			var idusuario = "<?php echo $idusuario; ?>";
			console.log(idusuario);
			buscardatoscliente(idcliente);
			guardar();
			listar_enpedido();
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

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#ventas-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#clientes-menu").addClass("active");
    }

		var listar_enpedido = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_enpedido").slideDown("slow");
			$("#listar_sinproveedor").slideUp("slow");
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			var opcion = "enpedido";
			var buscar = $("#buscar").val();
			var table = $("#dt_listar_enpedido").DataTable({
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
				{"data": "entregado"},
				{"defaultContent": "<div class='invoice-footer'><button class='verherramienta btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
		   ],
			 "columnDefs": [
			    { "width": "3%", "className": "dt-center", "targets": 0 },
					{ "width": "8%", "targets": 1 },
					{ "width": "8%", "targets": 2 },
					{ "width": "7%", "targets": 4 },
					{ "width": "8%", "targets": 5 },
					{ "width": "8%", "targets": 6 },
					{ "width": "8%", "targets": 7 },
			  ],
				"createdRow": function ( row, data, index ) {
					if ( data.enviado == 'No' && data.recibido == 'No') {
						$('td', row).eq(1).addClass('text-danger');
						$('td', row).eq(2).addClass('text-danger');
					}

					if ( data.enviado != 'No' && data.recibido == 'No') {
						$('td', row).eq(1).addClass('table-text-enviado');
						$('td', row).eq(2).addClass('table-text-enviado');
					}

					if ( data.enviado != 'No' && data.recibido != 'No') {
						$('td', row).eq(1).addClass('table-text-recibido');
						$('td', row).eq(2).addClass('table-text-recibido');
					}
					if ( data.enviado != 'No' && data.recibido != 'No' && data.entregado != 'No') {
						$('td', row).eq(1).addClass('text-primary');
						$('td', row).eq(2).addClass('text-primary');
					}
				},
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
                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> CSV'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
                  download: 'open'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
				]
		    });
				obtener_data_ver_herramienta("#dt_listar_enpedido tbody", table);
		}

		var listar_sinproveedor = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_enpedido").slideUp("slow");
			$("#listar_sinproveedor").slideDown("slow");
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
			var opcion = "sinproveedor";
			var buscar = $("#buscar").val();
			var table = $("#dt_listar_sinproveedor").DataTable({
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
			  // {"data": "pedido"},
			  // {"data": "orden"},
			  // {"data": "enviado"},
			  // {"data": "recibido"},
				// {"data": "entregado"},
				{"defaultContent": "<div class='invoice-footer'><button class='verherramienta btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
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
                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend: 'csv',
                  text: '<i class="fas fa-file-alt fa-lg"></i> CSV'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
                  download: 'open'
                  // "className": "btn btn-lg btn-space btn-secondary",
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
                  header: 'false',
                  orientation: 'landscape',
                  pageSize: 'LEGAL'
                }
            ]
          },
				]
		    });
				obtener_data_ver_herramienta("#dt_listar_sinproveedor tbody", table);
		}

		var listar_sinentregar = function(){
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			$("#listar_enpedido").slideUp("slow");
			$("#listar_sinproveedor").slideUp("slow");
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideDown("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
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
				"createdRow": function ( row, data, index ) {
					if ( data.enviado == 'No' && data.recibido == 'No') {
						$('td', row).eq(1).addClass('text-danger');
						$('td', row).eq(2).addClass('text-danger');
					}

					if ( data.enviado != 'No' && data.recibido == 'No') {
						$('td', row).eq(1).addClass('table-text-enviado');
						$('td', row).eq(2).addClass('table-text-enviado');
					}

					if ( data.enviado != 'No' && data.recibido != 'No') {
						$('td', row).eq(1).addClass('table-text-recibido');
						$('td', row).eq(2).addClass('table-text-recibido');
					}
					if ( data.enviado != 'No' && data.recibido != 'No' && data.entregado != 'No') {
						$('td', row).eq(1).addClass('text-primary');
						$('td', row).eq(2).addClass('text-primary');
					}
				},
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
			var RFC = "<?php echo $RFC; ?>";
			$("#listar_enpedido").slideUp("slow");
			$("#listar_sinproveedor").slideUp("slow");
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideDown("slow");
			$("#listar_cotizaciones").slideUp("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
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
					{"data": null,
						"render": function (data) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hremision' value='"+data.remision+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
						},
					},
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
						"paging": false,
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
							{
								text: '<i class="fas fa-file-alt fa-sm" aria-hidden="true"></i> Generar factura',
								"className": "btn btn-lg btn-space btn-primary",
								action: function ( e, dt, node, config ) {
									listar_partidas_remisiones_facturar(RFC);
								}
							}
					]
		    });
				obtener_data_ver_remision("#dt_listar_remisiones tbody", table);
		}

		// $('#modalInformacionFactura').on('hide.bs.modal', function (e) {
		// 	$("#dt_partidas_facturar").DataTable().ajax.reload();
		// 	$("#dt_listar_remisiones").DataTable().ajax.reload();
		// });

		var listar_facturasnopagadas = function () {
				var idcliente = "<?php echo $_REQUEST['id']; ?>";
				$("#listar_enpedido").slideUp("slow");
				$("#listar_sinproveedor").slideUp("slow");
				$("#listar_facturadonoentregado").slideUp("slow");
				$("#listar_sinentregar").slideUp("slow");
				$("#listar_remisiones").slideUp("slow");
				$("#listar_cotizaciones").slideUp("slow");
				$("#listar_facturasnopagadas").slideDown("slow");
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
			$("#listar_enpedido").slideUp("slow");
			$("#listar_sinproveedor").slideUp("slow");
			$("#listar_facturadonoentregado").slideUp("slow");
			$("#listar_sinentregar").slideUp("slow");
			$("#listar_remisiones").slideUp("slow");
			$("#listar_cotizaciones").slideDown("slow");
			$("#listar_facturasnopagadas").slideUp("slow");
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
							{"data": "vendedor"},
		          {"data": "contacto"},
		          {"data": "fecha"},
							{"data": "partidas"},
							{"data": "total"},
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

				window.location.href = "../cotizaciones/verCotizacion.php?numero="+cotizacion;
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
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La cotización se generó correctamente.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
							$(".texto1").append("</div>");
						}, 350);
						setTimeout(function () {
							window.location= "../cotizaciones/verCotizacion.php?numero="+info.numero;
						}, 2000);
					}else if(info.respuesta == "nuevaremision"){
						$(".modal").modal("hide");
						$("#mod-remision").modal("show");
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La remisión se generó correctamente.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
							$(".texto1").append("</div>");
						}, 350);
						setTimeout(function () {
							window.location= "../remisiones/verRemision.php?remision="+info.remision;
						}, 2000);
					}else{
						$("#mod-cotizacion").modal("hide");
						$("#mod-remision").modal("hide");
						mostrar_mensaje(info);
					}
				});
			});
		}

		$('#modalCuentasBanco').on('show.bs.modal', function (e) {
			var opcion = "cuentasbanco";
			var idcliente = "<?php echo $_REQUEST['id']; ?>";
			var table = $("#dt_cuentas_banco").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "buscar.php",
					"type": "POST",
					"data": {"idcliente": idcliente,"opcion": opcion}
				},
				"columns":[
					{"data": "indice"},
					{"data": "cuenta"},
					{"data": "moneda"},
					{"defaultContent": "<div class='invoice-footer'><button type='button' class='editarcuenta btn btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"},
					{"defaultContent": "<div class='invoice-footer'><button type='button' class='eliminarcuenta btn btn-danger'><i class='fas fa-times fa-sm' aria-hidden='true'></i></button></div>"}
				],
				"columnDefs": [
					{ "width": "20%", "targets": 0 },
					{ "width": "40%", "targets": 1 },
					{ "width": "20%", "targets": 2 },
					{ "width": "20%", "targets": 3 },
				],
				"order": false,
				"lengthChange": false,
				"info": false,
				"paging": false,
				"ordering": false,
				"language": idioma_espanol,
				"dom":
					"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'>>" +
					"<'row be-datatable-body'<'col-sm-12'tr>>",
				"buttons": [
					{
						text: '<i class="fas fa-plus fa-sm" aria-hidden="true"></i> Agregar',
						"className": "btn btn-lg btn-space btn-success",
						action: function ( e, dt, node, config ) {
							$("#modalAgregarCuentaBanco").modal("show");
							$("#idclienteagregarcuenta").val(idcliente);
						}
					}
				]
			});
			obtener_data_editar_cuenta("#dt_cuentas_banco tbody", table, idcliente);
			obtener_data_eliminar_cuenta("#dt_cuentas_banco tbody", table, idcliente);
		})

		function agregar_cuenta () {
			var idcliente = $("#idclienteagregarcuenta").val();
			var cuenta = $("#cuenta").val();
			var moneda = $("#monedacuenta").val();
			var opcion = "agregarcuenta";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				data: {"opcion": opcion, "idcliente": idcliente, "cuenta": cuenta, "moneda": moneda},
				success: function (data) {
					var json_info = JSON.parse( data );
					mostrar_mensaje(json_info);
					$("#dt_cuentas_banco").DataTable().ajax.reload();
				}
			});
		}

		function editar_cuenta () {
			var idcuenta = $("#idcuentaeditar").val();
			var cuenta = $("#cuentaeditar").val();
			var moneda = $("#monedacuentaeditar").val();
			var opcion = "editarcuenta";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				data: {"opcion": opcion, "idcuenta": idcuenta, "cuenta": cuenta, "moneda": moneda},
				success: function (data) {
					var json_info = JSON.parse( data );
					mostrar_mensaje(json_info);
					$("#dt_cuentas_banco").DataTable().ajax.reload();
				}
			});
		}

		var obtener_data_editar_cuenta = function(tbody, table, idcliente){
			$(tbody).on("click", "button.editarcuenta", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				$("#idcuentaeditar").val(data.id);
				$("#cuentaeditar").val(data.cuenta);
				$("#monedacuentaeditar").val(data.moneda);
				$("#modalEditarCuentaBanco").modal("show");
			});
		}

		var obtener_data_eliminar_cuenta = function(tbody, table, idcliente){
			$(tbody).on("click", "button.eliminarcuenta", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				if (confirm("Esta seguro(a) de eliminar esta cuenta?")){
					var idcuenta = data.id;
					var opcion = "eliminarcuenta";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						data: {"opcion": opcion, "idcuenta": idcuenta},
						success: function (data) {
							var json_info = JSON.parse( data );
							mostrar_mensaje(json_info);
							$("#dt_cuentas_banco").DataTable().ajax.reload();
						}
					});
				}else{

				}
			});
		}

		function listar_partidas_remisiones_facturar (RFC) {
			$("#modalInformacionFactura").modal("show");
			var verificar = 0;
			$("input[name=hremision]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});
			if(verificar == 0){
				alert("Debes de seleccionar al menos una partida!");
			}else{
				var remisiones = new Array();
				$("input[name=hremision]").each(function (index) {
					if($(this).is(':checked')){
						remisiones.push($(this).val());
					}
				});
				var opcion = "herramientasremisiones";
				var table = $("#dt_partidas_facturar").DataTable({
					"destroy":"true",
					"deferRender": true,
					"scrollX": true,
					"autoWidth": false,
					"ajax":{
						"url": "buscar.php",
						"type": "POST",
						"data": {"remisiones": JSON.stringify(remisiones), "opcion": opcion}
					},
					"columns":[
						{"data": "indice"},
						{"data": "marca"},
						{"data": "modelo"},
						{"data": "precioUnitario"},
						{"data": "cantidad"},
						{"data": "precioTotal"}
					],
					"columnDefs": [
						{ "width": "10%", "targets": 0 },
						{ "width": "20%", "targets": 1 },
						{ "width": "20%", "targets": 2 },
						{ "width": "20%", "targets": 3 },
						{ "width": "10%", "targets": 4 },
						{ "width": "20%", "targets": 5 },
					],
					"order": false,
					"lengthChange": false,
					"info": false,
					"paging": false,
					"ordering": false,
					"language": idioma_espanol,
					"footerCallback": function ( row, data, start, end, display ) {
						var api = this.api();
						var intVal = function ( i ) {
							return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
							i : 0;
						};

						var subtotal = api
						.column( 5 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

						$("#subtotalFactura").text("$ "+ subtotal.toFixed(2));
						$("#ivaFactura").text("$ "+ (subtotal * .16).toFixed(2));
						$("#totalFactura").text("$ "+ (subtotal + subtotal*.16).toFixed(2));
					},
					"dom":
					"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'>>" +
					"<'row be-datatable-body'<'col-sm-12'tr>>",
					"createdRow": function ( row, data, index ) {
						if ( data.enviado != '0000-00-00' && data.recibido == '0000-00-00' ) {
							$('td', row).eq(1).addClass('table-text-enviado');
							$('td', row).eq(2).addClass('table-text-enviado');
						}

						if ( data.enviado != '0000-00-00' && data.recibido != '0000-00-00' ) {
							$('td', row).eq(1).addClass('table-text-recibido');
							$('td', row).eq(2).addClass('table-text-recibido');
						}
						if ( data.enviado == '0000-00-00' && data.recibido == '0000-00-00' ) {
							$('td', row).eq(1).addClass('text-danger');
							$('td', row).eq(2).addClass('text-danger');
						}
					}
				});
			}
			var opcion = "buscardatos";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "RFC": RFC},
			}).done( function( info ){
				console.log(info);
				$("#frmInformacionFactura #cliente").val(info.cliente.nombreEmpresa);
				$("#frmInformacionFactura #moneda").val(info.cliente.moneda);
				$("#frmInformacionFactura #tipoCambio").val(info.tipoCambio);
				$("#frmInformacionFactura #usoCFDI").val(info.cliente.IdUsoCFDI);
				$("#frmInformacionFactura #formaPago").val(info.cliente.IdFormaPago);
				$("#frmInformacionFactura #metodoPago").val(info.cliente.IdMetodoPago);
				$("#frmInformacionFactura #condicionesPago").val(info.cliente.CondPago);
				$("#frmInformacionFactura #cuenta").val(info.cuenta);
			});
			buscar_cliente_portal(RFC, remisiones);
		}

		function buscar_cliente_portal(RFC, remisiones){
			$("#generarFactura").on("click", function(){
				apiConfig.opcion = $("#frmInformacionFactura #entorno").val();
				if (apiConfig.opcion == "pruebas") {
					apiConfig.enlace = "http://devfactura.in/",
					apiConfig.apiKey = "JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp",
					apiConfig.secretKey = "JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX",
					apiConfig.serie = "1194"
				}

				$("#modalInformacionFactura").modal("hide");
				$("#mod-success").modal("show");
				var request = new XMLHttpRequest();

				request.open('GET', apiConfig.enlace+'api/v1/clients/'+RFC);

				request.setRequestHeader('Content-Type', 'application/json');
				request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
				request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

				request.onload = function() {
					var responseText = request.responseText;
					console.log(responseText);
				};

				request.onerror = function(xhr) {
					$.gritter.add({
						title: 'Error!',
						text: 'Ocurrió un problema en la conexión de "Factura.com".',
						class_name: 'color danger'
					});
					$(".texto1").fadeOut(300, function(){
						$(this).html("");
						$(this).fadeIn(300);
					});
					setTimeout(function () {
						$(".texto1").append("<div class='text-danger'><span class='modal-main-icon mdi mdi-close-circle-o'></span></div>");
						$(".texto1").append("<h3>Error!</h3>");
						$(".texto1").append("<h4>Ocurrió un problema al conectar a  portal 'Factura.com'.</h4>");
					}, 350);
					setTimeout( function () {
						$("#mod-success").modal("hide");
						$(".texto1").html("");
						$(".texto1").append("<br><br>");
						$(".texto1").append("<h3>Espere un momento...</h3>");
						$(".texto1").append("<h4>Se está generando la factura</h4>");
						$(".texto1").append("<br>");
						$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
						$(".texto1").append("<br>");
						$(".texto1").append("<br>");
					}, 3000);
				};

				request.onreadystatechange = function () {
					if (this.readyState === 4) {
						console.log('Status:', this.status);
						console.log('Headers:', this.getAllResponseHeaders());
						console.log('Body:', this.responseText);
						var data = JSON.parse(this.responseText);

						if (data.status == 0){
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
							setTimeout(function () {
								$(".texto1").append("<div class='text-danger'><span class='modal-main-icon mdi mdi-close-circle-o'></span></div>");
								$(".texto1").append("<h3>Error!</h3>");
								$(".texto1").append("<h4>Ocurrió un problema al conectar a portal 'Factura.com'.</h4>");
							}, 350);
							setTimeout( function () {
								$("#mod-success").modal("hide");
								$(".texto1").html("");
								$(".texto1").append("<br><br>");
								$(".texto1").append("<h3>Espere un momento...</h3>");
								$(".texto1").append("<h4>Se está generando la factura</h4>");
								$(".texto1").append("<br>");
								$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
								$(".texto1").append("<br>");
								$(".texto1").append("<br>");
							}, 3000);
						}else if (data.status == "error") {
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
							setTimeout(function () {
								$(".texto1").append("<div class='text-warning'><span class='modal-main-icon mdi mdi-alert-triangle'></span></div>");
								$(".texto1").append("<h3>Aviso!</h3>");
								$(".texto1").append("<h4>El cliente no esta registrado en portal 'Factura.com'</h4>");
								$(".texto1").append("<div class='text-center'>");
									$(".texto1").append("<p>Registrarlo a continuación para poder facturar.</p>");
									$(".texto1").append("</div>");
								}, 425);
								buscarDatosCliente(RFC);
							}else{
								var UID = data.Data.UID;
								generar_factura(RFC, remisiones, UID);
							}
						}
					}
				request.send();
			});
		}

		function buscarDatosCliente (RFC) {
			var opcion = "datosRFC";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "rfc": RFC},
			}).done( function( data ){
				$("#modalRegistrarClientePortal #email").val(data.datos.correoElectronico);
				$("#modalRegistrarClientePortal #telefono").val(data.datos.tlf1);
				$("#modalRegistrarClientePortal #razons").val(data.datos.nombreEmpresa);
				$("#modalRegistrarClientePortal #rfc").val(data.datos.RFC);
				$("#modalRegistrarClientePortal #numero_exterior").val(data.datos.NumExt);
				$("#modalRegistrarClientePortal #numero_interior").val(data.datos.NumInt);
				$("#modalRegistrarClientePortal #codpos").val(data.datos.cp);
				$("#modalRegistrarClientePortal #calle").val(data.datos.calle);
				$("#modalRegistrarClientePortal #colonia").val(data.datos.colonia);
				$("#modalRegistrarClientePortal #estado").val(data.datos.estado);
				$("#modalRegistrarClientePortal #ciudad").val(data.datos.ciudad);
				$("#modalRegistrarClientePortal #delegacion").val(data.datos.pais);
				setTimeout( function () {
					$("#mod-success").modal("hide");
					$("#modalRegistrarClientePortal").modal("show");
					$(".texto1").html("");
					$(".texto1").append("<br><br>");
					$(".texto1").append("<h3>Espere un momento...</h3>");
					$(".texto1").append("<h4>Se está generando la factura</h4>");
					$(".texto1").append("<br>");
					$(".texto1").append("<div class='text-center'><div class='be-spinner'><svg width='40px' height='40px' viewBox='0 0 66 66' xmlns='http://www.w3.org/2000/svg'><circle fill='none' stroke-width='4' stroke-linecap='round' cx='33' cy='33' r='30' class='circle'></circle></svg></div></div></div>");
					$(".texto1").append("<br>");
					$(".texto1").append("<br>");
				}, 2500);
			});
		}

		$("#registrar-cliente-portal").on("click", function(){
			var nombre = $("#modalRegistrarClientePortal #nombre").val();
			var apellidos = $("#modalRegistrarClientePortal #apellidos").val();
			var email = $("#modalRegistrarClientePortal #email").val();
			var telefono = $("#modalRegistrarClientePortal #telefono").val();
			var razons = $("#modalRegistrarClientePortal #razons").val();
			var rfc = $("#modalRegistrarClientePortal #rfc").val();
			var numero_exterior = $("#modalRegistrarClientePortal #numero_exterior").val();
			var numero_interior = $("#modalRegistrarClientePortal #numero_interior").val();
			var codpos = $("#modalRegistrarClientePortal #codpos").val();
			var calle = $("#modalRegistrarClientePortal #calle").val();
			var colonia = $("#modalRegistrarClientePortal #colonia").val();
			var estado = $("#modalRegistrarClientePortal #estado").val();
			var ciudad = $("#modalRegistrarClientePortal #ciudad").val();
			var delegacion = $("#modalRegistrarClientePortal #delegacion").val();

			var request = new XMLHttpRequest();

			request.open('POST', apiConfig.enlace+'api/v1/clients/create');

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
			  if (this.readyState === 4) {
			    console.log('Status:', this.status);
			    console.log('Headers:', this.getAllResponseHeaders());
			    console.log('Body:', this.responseText);
			    var data = JSON.parse(this.responseText);
			    if (data.status == "success"){
						$.gritter.add({
							title: 'Correcto!',
							text: 'El cliente se registró correctamente en el portal "Factura.com", intente generar la factura nuevamente.',
							class_name: 'color success'
						});
			    }else{
						$.gritter.add({
							title: 'Error!',
							text: data.message,
							class_name: 'color danger'
						});
					}
			  }
			};

			var body = {
			  'nombre': nombre,
			  'apellidos': apellidos,
			  'email': email,
			  'telefono': telefono,
			  'razons': razons,
			  'rfc': rfc,
			  'calle': calle,
			  'numero_exterior': numero_exterior,
			  'numero_interior': numero_interior,
			  'codpos': codpos,
			  'colonia': colonia,
			  'estado': estado,
			  'ciudad': ciudad,
			  'delegacion': delegacion
			};

			request.send(JSON.stringify(body));
			$("#modalRegistrarClientePortal").modal("hide");
		});

		var generar_factura = function(RFC, remisiones, UID){
			var request = new XMLHttpRequest();

			request.open('POST', apiConfig.enlace+'api/v3/cfdi33/create');
			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());
					console.log('Body:', this.responseText);
					var data = JSON.parse(this.responseText);
					if (data.response == "error" && typeof data.message.message != "undefined") {
						$("#mod-success").modal("hide");
						$.gritter.add({
							title: 'Error!',
							text: data.message.message+'<br>'+data.message.messageDetail,
							class_name: 'color danger'
						});
					}else if (data.response == "error" && typeof data.message != "undefined") {
						$("#mod-success").modal("hide");
						$.gritter.add({
							title: 'Aviso!',
							text: data.message,
							class_name: 'color warning'
						});
					}else{
						$(".texto1").fadeOut(300, function(){
							$(this).html("");
							$(this).fadeIn(300);
						});
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La factura se generó correctamente en el portal 'Factura.com'.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>En un momento se descargará el archivo PDF.</p>");
							$(".texto1").append("</div>");
						}, 350);
						var UIDFactura = data.uid;
						var UUIDFactura = data.UUID;
						var tipoDocumento = $("#frmInformacionFactura #tipoDocumento").val();
						var moneda = $("#frmInformacionFactura #moneda").val();
						apiConfig.opcion = $("#frmInformacionFactura #entorno").val();
						if (apiConfig.opcion == "produccion"){
							guardarFactura(remisiones, tipoDocumento, moneda, UIDFactura, UUIDFactura);
						}else{
							var request = new XMLHttpRequest();

							request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UIDFactura+'/pdf');

							request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
							request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);
							request.setRequestHeader('Content-Type', 'application/pdf');
							request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
							request.setRequestHeader('Content-Disposition', 'attachment: filename=F2222.pdf');
							request.responseType = 'blob';

							request.onreadystatechange = function () {
								if (this.readyState === 4) {
									console.log('Status:', this.status);
									console.log('Headers:', this.getAllResponseHeaders());
									console.log('Body:', this.response);
									var blob = new Blob([this.response], {type: 'application/pdf'});
									var link = document.createElement('a');
									link.href = window.URL.createObjectURL(blob);
									link.download = "factura.pdf";
									link.click();
								}
							};

							request.send();
						}
					}
				}
			};

			var opcion = "buscarpartidasfacturar";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "remisiones": JSON.stringify(remisiones), "RFC": RFC}
			}).done( function( conceptos ){
				var tipoDocumento = $("#frmInformacionFactura #tipoDocumento").val();
				if (tipoDocumento == "factura" || tipoDocumento == "factura/pagoanticipado") {
					tipoDocumento = "factura";
				}
				var cuenta = $("#frmInformacionFactura #cuenta").val();
				if (cuenta == "") {
					cuenta = "No Identificado";
				}
				var fecha = "<?php echo date("Y-m-d")."T".date("H:i:s"); ?>";
				var body = {
					'Receptor': {
						'UID': UID,
						'ResidenciaFiscal': '',
					},
					'TipoDocumento': tipoDocumento,
					'Conceptos': conceptos.data,
					'UsoCFDI': conceptos.cfdi,
					'Serie': apiConfig.serie,
					'FormaPago': conceptos.formapago,
					'MetodoPago': conceptos.metodopago,
					'CondicionesDePago': conceptos.condpago,
					'Cuenta': cuenta,
					'Moneda': ($("#frmInformacionFactura #moneda").val()).toUpperCase(),
					'TipoCambio': $("#frmInformacionFactura #tipoCambio").val(),
					'NumOrder': $("#frmInformacionFactura #numeroOrden").val(),
					'FechaFromAPI': fecha,
					'Comentarios': conceptos.condpago,
					'EnviarCorreo': $("#frmInformacionFactura #enviarCorreo").val()
				};
				console.log(JSON.stringify(body));
				request.send(JSON.stringify(body));
			});
		}

		function guardarFactura(remisiones, tipoDocumento, moneda, UIDFactura, UUIDFactura) {
			var request = new XMLHttpRequest();

			request.open('GET', apiConfig.enlace+'api/v3/cfdi33/list');

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					var data = JSON.parse(this.responseText);
					console.log(data);
					var totalfacturas = data.total;
					for (var i = 0; i < totalfacturas; i++) {
						if (UIDFactura == data.data[i].UID){
							var folio = data.data[i].Folio;
							var ordenpedido = data.data[i].NumOrder;
							var total = data.data[i].Total;
							var status = data.data[i].Status;
							var fecha = data.data[i].FechaTimbrado;
							var cliente = data.data[i].RazonSocialReceptor;
							var UID = data.data[i].UID;
							var opcion = "guardarfactura";
							$.ajax({
								method: "POST",
								url: "guardar.php",
								dataType: "json",
								data: {"opcion": opcion, "folio": folio, "remisiones": JSON.stringify(remisiones), "total": total, "status": status, "fecha": fecha, "tipoDocumento": tipoDocumento, "moneda": moneda, "UIDFactura": UIDFactura, "UUIDFactura": UUIDFactura, "cliente": cliente}
							}).done( function( data ){
								console.log(data);
								mostrar_mensaje(data);
							});

							// quitarStock(numeroPedido, refCotizacion, herramienta, folio, tipoDocumento);
							descargarPDF(UID, folio);
						}
					}
				}
			};
			request.send();
		}

		function quitarStock(numeroPedido, refCotizacion, herramienta, folio, tipoDocumento){
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion = "quitarstock", "numeroPedido": numeroPedido, "refCotizacion": refCotizacion, "folio": folio, "herramienta": JSON.stringify(herramienta), "tipoDocumento": tipoDocumento},
			}).done( function( data ){
				console.log(data);
				mostrar_mensaje(data);
			});
		}

		function descargarPDF (UID, folio) {
			var request = new XMLHttpRequest();

			request.open('GET', apiConfig.enlace+'api/v3/cfdi33/'+UID+'/pdf');

			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);
			request.setRequestHeader('Content-Type', 'application/pdf');
			request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
			request.setRequestHeader('Content-Disposition', 'attachment: filename=F2222.pdf');
			request.responseType = 'blob';

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());
					console.log('Body:', this.response);
					var blob = new Blob([this.response], {type: 'application/pdf'});
					var link = document.createElement('a');
					link.href = window.URL.createObjectURL(blob);
					link.download = folio+".pdf";
					link.click();
				}
			};

			request.send();
		}

	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
