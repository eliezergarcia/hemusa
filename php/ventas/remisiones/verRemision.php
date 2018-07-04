<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);
	$resultado = mysqli_query($conexion_usuarios, "SELECT cliente FROM cotizacion WHERE remision='".$_REQUEST['remision']."'");
	while($data = mysqli_fetch_array($resultado)){
		$idcliente = $data['cliente'];
	}
	$resultado = mysqli_query($conexion_usuarios, "SELECT * FROM contactos WHERE id='".$idcliente."'");
	while($data = mysqli_fetch_array($resultado)){
		$nombrecliente = $data['nombreEmpresa'];
		$rfc = $data['RFC'];
		$calle = utf8_encode($data['calle']);
		$colonia = $data['colonia'];
		$ciudad = $data['ciudad'];
		$estado = $data['estado'];
		$cp = $data['cp'];
	}

?>

<!DOCTYPE html>
</html>
<html>
<head>
	<title>Pedido</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
      <div class="page-head">
        <h2 class="page-head-title">Remisión</h2>
        <nav aria-label="breadcrumb">
			  	<ol class="breadcrumb">
			    	<li class="breadcrumb-item">Facturación</li>
			    	<li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="<?php echo $ruta; ?>php/ventas/remisiones/remisiones.php" class="text-primary">Remisiones</a></li>
			    	<li id="breadcrumb" class="breadcrumb-item acti ve" aria-current="page">
			    		Cliente: <a id="toolTipVerCliente" href="<?php echo $ruta; ?>php/ventas/clientes/verContacto.php?id=<?php echo $idcliente; ?>" class="text-primary"><?php echo $nombrecliente; ?></a> - Remision: <?php echo $_REQUEST['remision']; ?>
			    	</li>
			  	</ol>
				</nav>
      </div>
      <div class="main-content container-fluid">
				<div class="row full-calendar">
        	<div class="col-lg-12">
            <div class="card card-fullcalendar">
              <div class="card-body">
								<br>
								<div class="row align-items-start justify-content-around">
									<div class="col-4 row justify-content-center">
										<div class="col">
												<h4><b>Cliente</b></h4>
												<h5 style="font-size: 17px;"><?php echo $nombrecliente; ?></h5>
												<h4 class="card-subtitle mb-2 text-muted">RFC</h4>
												<h5 style="font-size: 17px;"><?php echo $rfc; ?></h5>
												<h4 class="card-subtitle mb-2 text-muted">Calle, colonia</h4>
												<h5 style="font-size: 17px;"><?php echo $calle.", ".$colonia; ?></h5>
												<h4 class="card-subtitle mb-2 text-muted">Ciudad, estado, c.p.</h4>
												<h5 style="font-size: 17px;"><?php echo $ciudad.", ".$estado.", ".$cp; ?></h5><br><br>
										</div>
									</div>
									<div class="col row justify-content-start">
										<div class="col-3 form-group">
											<h4><b>Ref. Cotización</b></h4>
											<label id="refCotizacion"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Fecha</b></h4>
											<label id="fecha"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Vendedor</b></h4>
											<label id="vendedor"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Orden de Compra</b></h4>
											<label id="ordenCompra"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Factura</b></h4>
											<label id="factura"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Pagado</b></h4>
											<label id="pagado"></label>
										</div>
										<div class="col-3 form-group">
											<h4><b>Moneda </b> <a id="cambiarmoneda" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<select id="moneda" class="form-control form-control-sm select2">
												<option value="usd" selected>USD</option>
												<option value="mxn">MXN</option>
											</select>
										</div>
										<div class="col-3 form-group">
											<h4><b>Paquetería </b><a id="cambiarpaqueteria" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<select id="paqueteria" class="form-control form-control-sm select2">
											</select>
										</div>
										<div class="col-3 form-group">
											<h4><b>No. de guía</b></h4>
											<div class="input-group mb-3">
												<input type="text" id="numeroGuia" class="form-control form-control-sm">
												<div class="input-group-append">
													<button id="cambiarng" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
												</div>
											</div>
										</div>
										<div class="col-3 form-group">
											<h4><b>Proveedor </b><a id="cambiarproveedor" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<div>
												<select name="proveedorg" id="proveedorg" class="form-control form-control-sm select2"></select>
											</div>
										</div>
										<div class="col-3 form-group">
											<h4><b>Cantidad</b></h4>
											<div class="input-group mb-3">
												<input type="text" id="cantidadg" class="form-control form-control-sm">
												<div class="input-group-append">
													<button id="cambiarcantidadg" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
												</div>
											</div>
										</div>
										<div class="col-3 form-group">
											<h4><b>Forma de pago </b><a id="cambiarformapago" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<div>
												<select type="text" id="formapago" name="formapago" class="form-control form-control-sm select2">
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
										<div class="col-3 form-group">
											<h4><b>Método de pago </b><a id="cambiarmetodopago" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<div>
												<select type="text" id="metodopago" name="metodopago" class="form-control form-control-sm select2">
													<option value="1">Pago en una sola exhibición</option>
													<option value="2">Pago en parcialidades o diferido</option>
												</select>
											</div>
										</div>
										<div class="col-3 form-group">
											<h4><b>Uso de CFDI </b><a id="cambiarusocfdi" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
											<div>
												<select id="cfdi" name="cfdi" class="form-control form-control-sm select2">
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
								</div>
								<hr>

			    			<!-- Tabla de partidas -->
			    				<br><br><br>
			    				<table id="dt_pedido" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripcion</th>
												<th>No. Serie</th>
												<th>Precio Unidad</th>
												<th>Cantidad</th>
												<th>Precio Total</th>
												<th>Fecha Compromiso</th>
												<th>Clave SAT</th>
												<th>Proveedor</th>
												<th>Almacen</th>
												<th>Editar</th>
												<th>Quitar</th>
											</tr>
										</thead>
									</table>

									<br>
									<div class="row justify-content-end">
										<div class="col-3">
											<table class="table table-bordered table-striped">
												<tbody>
													<tr>
														<th><h5><b>SUB-TOTAL:</b></h5></th>
														<th><h5><label style="font-size: 15px;" id="subtotal"></h5></label></th>
													</tr>
													<tr>
														<th><h5><b>IVA (16%):</b></h5></th>
														<th><h5><label style="font-size: 15px;" id="iva"></label></h5></th>
													</tr>
													<tr>
														<th><h5><b>TOTAL:</b></h5></th>
														<th><h5><b><label style="font-size: 18px;" class="text-primary" id="total"></label></b></h5></th>
													</tr>
													<tr>
														<th><h5><b>MONEDA:</b></h5></th>
														<th><h5><label style="font-size: 15px;" id="monedatotal"></label></h5></th>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

	<!-- Modal Editar Partidas -->
		<form id="frmEditar" action="" class="form-horizontal" method="POST">
			<input type="hidden" name="id" id="id">
			<input type="hidden" name="opcion" id="opcion" value="editarpartida">
			<div class="modal fade colored-header colored-header-primary" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="exampleModalLabel">Información de partida</h4>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
				      	<div class="modal-body">
						  <div class="form-group row">
				      			<label for="claveSat" class="control-label col-4">Clave SAT</label>
				      			<input type="text" class="form-control form-control-sm col-7" name="claveSat" id="claveSat">
				      		</div>
				      		<div class="form-group row">
				      			<label for="noserie" class="control-label col-4">No. Serie</label>
				      			<input type="text" class="form-control form-control-sm col-7" name="noserie" id="noserie">
				      		</div>
				      		<div class="form-group row">
				      			<label for="cantidad" class="control-label col-4">Cantidad</label>
				      			<input type="text" class="form-control form-control-sm col-7" name="cantidad" id="cantidad">
				      		</div>
				      		<div class="form-group row">
				      			<label for="fechacompromiso" class="control-label col-4">Fecha compromiso</label>
				      			<input type="date" class="form-control form-control-sm col-7" name="fechacompromiso" id="fechacompromiso">
				      		</div>
				      		<div class="form-group row">
				      			<label for="proveedor" class="control-label col-4">Proveedor</label>
				      			<select name="proveedor" id="proveedor" class="form-control form-control-sm col-7"></select>
				      		</div>
				      		<div class="form-group row">
				      			<label for="split" class="control-label col-4">Split</label>
				      			<input type="text" class="form-control form-control-sm col-7" name="split" id="split">
				      		</div>
							<div class="form-group row">
				      			<label for="entregado" class="control-label col-4">Entregado</label>
				      			<input type="date" class="form-control form-control-sm col-7" name="entregado" id="entregado">
				      		</div>
				      	</div>
				      	<div class="modal-footer invoice-footer">
				        	<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
				        	<button id="editar-partida" type="button" class="btn btn-lg btn-primary">Guardar</button>
				      	</div>
			    	</div>
			  	</div>
			</div>
		</form>

	<!-- Modal Devolucion -->
		<form id="frmDevolucion" action="" method="POST">
			<div class="modal fade" id="modalDevolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle btn-outline-danger" aria-hidden="true"></i> Devolucion de material</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
				      	<div class="modal-body">
				        	<table id="dt_devolucion" class="table compact" cellspacing="0" width="100%">
				        		<thead>
				        			<tr>
				        				<th>Marca</th>
				        				<th>Modelo</th>
				        				<th>Descripcion</th>
				        				<th><input type="checkbox" class="btn btn-outline-primary" name="sel" onclick="seleccionartodo()"></th>
				        			</tr>
				        		</thead>
				        	</table>
				        	<div class="form-group col-12">
				        		<label for="">Comentarios</label>
				        		<textarea name="comentarios" id="comentarios" cols="30" rows="5" class="form-control"></textarea>
				        	</div>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        	<button id="agregar-devolucion" type="button" class="btn btn-danger">Devolucion</button>
				      	</div>
			    	</div>
			  	</div>
			</div>
		</form>

	<!-- Modal Registrar Cliente en Portal -->
		<div class="modal fade" id="modalRegistrarClientePortal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Registro de cliente en portal Factura.com</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div class="modal-body">
			        	<form id="frmRegistrarClientePortal" action="" method="POST">
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="nombre">Nombre</label>
		        					<input type="text" id="nombre" name="nombre" class="form-control" placeholder="(Opcional)">
		        				</div>
		        				<div class="col">
		        					<label for="apellidos">Apellidos</label>
		        					<input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="(Opcional)">
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="email">Correo electronico <font color="#FF4136">*</font></label>
		        					<input type="text" id="email" name="email" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="telefono">Teléfono</label>
		        					<input type="text" id="telefono" name="telefono" class="form-control" placeholder="(Opcional)">
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="razons">Razón Social <font color="#FF4136">*</font></label>
		        					<input type="text" id="razons" name="razons" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="rfc">RFC <font color="#FF4136">*</font></label>
		        					<input type="text" id="rfc" name="rfc" class="form-control">
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="numero_exterior">Número exterior <font color="#FF4136">*</font></label>
		        					<input type="text" id="numero_exterior" name="numero_exterior" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="numero_interior">Número interior</label>
		        					<input type="text" id="numero_interior" name="numero_interior" class="form-control" placeholder="(Opcional)">
		        				</div>
		        				<div class="col">
		        					<label for="codpos">Código Postal <font color="#FF4136">*</font></label>
		        					<input type="text" id="codpos" name="codpos" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="calle">Calle <font color="#FF4136">*</font></label>
		        					<input type="text" id="calle" name="calle" class="form-control">
		        				</div>
		        			</div>
		        			<div class="row form-group">
		        				<div class="col">
		        					<label for="colonia">Colonia <font color="#FF4136">*</font></label>
		        					<input type="text" id="colonia" name="colonia" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="estado">Estado <font color="#FF4136">*</font></label>
		        					<input type="text" id="estado" name="estado" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="ciudad">Ciudad <font color="#FF4136">*</font></label>
		        					<input type="text" id="ciudad" name="ciudad" class="form-control">
		        				</div>
		        				<div class="col">
		        					<label for="delegacion">Delegación <font color="#FF4136">*</font></label>
		        					<input type="text" id="delegacion" name="delegacion" class="form-control">
		        				</div>
		        			</div>
			        	</form>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			        	<button type="button" id="registrar-cliente-portal" class="btn btn-success">Registrar</button>
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

	<!-- Modal Packing List -->
		<div class="modal fade colored-header colored-header-primary" id="modalPackingList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel">Packing List</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="dt_packing_list" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Marca</th>
									<th>Modelo</th>
									<th>Cantidad</th>
									<th>Descripción</th>
									<th><input type="checkbox" class="btn btn-outline-primary" name="sel" onclick="seleccionartodo()"></th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="modal-footer invoice-footer">
						<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
						<button id="agregar-packing-list" type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Agregar</button>
					</div>
				</div>
			</div>
		</div>

	<!-- Modal Nueva Remision -->
		<form id="frmAgregarHerramienta" action="" method="POST">
			<div class="modal fade colored-header colored-header-success" id="modalAgregarHerramienta" role="dialog" aria-labelledby="modalPedidoExample" aria-hidden="true">
				<div class="modal-dialog full-width" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modalPedidoExample">Agregar herramienta a remisión</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table id="dt_agregar_herramienta" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Marca</th>
										<th>Modelo</th>
										<th>Descripción</th>
										<th>Cantidad</th>
										<th>Precio Total</th>
										<th>Ref.</th>
										<th>Pedido</th>
										<th><input type="checkbox" class="btn btn-outline-primary" name="sel" onclick="seleccionartodo()"></th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="modal-footer invoice-footer">
							<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="agregar-herramienta" type="button" class="btn btn-lg btn-success">Agregar</button>
						</div>
					</div>
				</div>
			</div>
		</form>

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

	</header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
    	App.pageCalendar();
    	App.formElements();
    	App.uiNotifications();
			var remision = "<?php echo $_REQUEST['remision']; ?>";
			buscardatos(remision);
			cambiarnumeroguia(remision);
			cambiarpaqueteria(remision);
			cambiarproveedorgeneral(remision);
			cambiarcantidadgeneral(remision);
			cambiarformapago(remision);
			cambiarmetodopago(remision);
			cambiarusocfdi(remision);
			editarPartida(remision);
			agregarHerramienta(remision);
			packinglist();
		});

		function buscardatos(remision){
			var opcion = "buscardatos";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "remision": remision},
				success : function(data) {
					console.log(data);
					document.getElementById("refCotizacion").innerHTML = data.refCotizacion;
					document.getElementById("fecha").innerHTML = data.fecha;
					document.getElementById("vendedor").innerHTML = data.vendedor;
					document.getElementById("ordenCompra").innerHTML = data.pedidocliente;
					document.getElementById("factura").innerHTML = data.factura;
					document.getElementById("pagado").innerHTML = "$ "+data.pagado+" - $"+data.total;
					document.getElementById("monedatotal").innerHTML = (data.moneda).toUpperCase();
					$("#moneda").val(data.moneda).change();
					$("#paqueteria").val(data.paqueteria).change();
					$("#numeroGuia").val(data.numeroGuia);
					$("#formapago").val(data.cliente.IdFormaPago).change();
					$("#metodopago").val(data.cliente.IdMetodoPago).change();
					$("#cfdi").val(data.cliente.IdUsoCFDI).change();

					var paqueteria = data.paqueteria;
					paqueterias(paqueteria);
					var RFC = data.cliente.RFC;
					listar_partidas(remision, RFC);

					var request = new XMLHttpRequest();

					request.open('GET', apiConfig.enlace + 'api/v3/cfdi33/list');

					request.setRequestHeader('Content-Type', 'application/json');
					request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
					request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

					request.onreadystatechange = function () {
						if (this.readyState === 4) {
							console.log('Status:', this.status);
							console.log('Headers:', this.getAllResponseHeaders());
							var data = JSON.parse(this.responseText);
							console.log(data);
							var total = data.total;
							for (var i = 0; i < total; i++) {
								if (remision == data.data[i].NumOrder){
									document.getElementById("factura").innerHTML = data.data[i].Folio;
								}
							}
						}
					};

					request.send();

	   		}
			});
		}

		function paqueterias(paqueteria){
			var opcion = "paqueterias";
			console.log(opcion);
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"paqueteria": paqueteria, "opcion": opcion},
				success : function(data) {
					console.log(data);
					var paqueterias = data;
					$('#paqueteria').empty();
					$("#paqueteria").append("<option>Seleccionar...</option>");
					$("#paqueteria").append("<option>NINGUNA</option>");
					for(var i=0;i<paqueterias.length;i = i + 2){
						if (paqueteria == paqueterias[i]) {
							$("#paqueteria").append("<option value="+paqueterias[i]+" selected>" + paqueterias[i + 1] + "</option>");
						}else{
							$("#paqueteria").append("<option value="+paqueterias[i]+">" + paqueterias[i + 1] + "</option>");
						}
	 				};
	   			}
			});
		}

		var listar_partidas = function(remision, RFC){
				var opcion = "listarpartidas";
				var table = $("#dt_pedido").DataTable({
					"destroy":"true",
					"deferRender": true,
					"scrollX": true,
					"ajax":{
						"url": "listar.php",
						"type": "POST",
						"data": {"remision": remision, "opcion": opcion}
					},
					"columns":[
						{"data": "indice"},
						{"data": "marca"},
						{"data": "modelo"},
						{"data": "descripcion"},
						{"data": "noserie"},
						{"data": "preciounidad"},
						{"data": "cantidad"},
						{"data": "preciototal"},
						{"data": "fechacompromiso"},
						{"data": "claveSat"},
						{"data": "proveedor"},
						{"data": "almacen"},
						{"defaultContent": "<div class='invoice-footer'><button type='button' class='editar btn btn-lg btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit fa-sms' aria-hidden='true'></i></button></div>"},
						{"defaultContent": "<div class='invoice-footer'><button class='quitar btn btn-lg btn-danger'><i class='fas fa-times fa-sm' aria-hidden='true'></i></button></div>"}
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
			                .column( 7 )
			                .data()
			                .reduce( function (a, b) {
			                    return intVal(a) + intVal(b);
			                }, 0 );

			            $("#subtotal").text("$ "+ subtotal.toFixed(2));
									$("#iva").text("$ "+ (subtotal * .16).toFixed(2));
									$("#total").text("$ "+ (subtotal + subtotal*.16).toFixed(2));
			        },
			        "dom":
		    				"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
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
				        },
					"buttons":[
						{
							extend: 'collection',
							text: '<i class="fas fa-file fa-sm"></i> Exportar remisión',
							"className": "btn btn-lg btn-space btn-secondary",
							buttons: [
								{
									text: '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
									// "className": "btn btn-danger",
									action: function (e, dt, node, config){
										var opcion = "pdf";
										genPDF(remision, opcion);
									},
								},
								{
									text: '<i class="fas fa-print fa-lg"></i> Imprimir',
									// "className": "btn btn-warning",
									action: function (e, dt, node, config){
										var opcion = "imprimir";
										genPDF(remision, opcion);
									},
								}

							]
						},
						// {
						// 	text: '<i class="fas fa-check-circle fa-sm" aria-hidden="true"></i> Entregado',
						// 	"className": "btn btn-lg btn-space btn-secondary",
						// 	action: function ( e, dt, node, config ) {
						// 		entregado(remision, RFC);
						// 	}
						// },
						{
							text: '<i class="fas fa-list fa-sm" aria-hidden="true"></i> Packing list',
							"className": "btn btn-lg btn-space btn-secondary",
							action: function ( e, dt, node, config ) {
								$('#modalPackingList').modal('show');
							}
						},
						{
							text: '<i class="fas fa-wrench fa-sm" aria-hidden="true"></i> Agregar a remisión',
							"className": "btn btn-lg btn-space btn-secondary",
							action: function ( e, dt, node, config ) {
								$('#modalAgregarHerramienta').modal('show');
							}
						},
            {
              text: '<i class="fas fa-file fa-sm" aria-hidden="true"></i> Generar factura',
              "className": "btn btn-lg btn-space btn-primary",
              action: function ( e, dt, node, config ) {
              	generar_factura(RFC, remision);
              }
            }
					]
				});

			proveedores();
			obtener_data_editar("#dt_pedido tbody", table);
			obtener_data_quitar("#dt_pedido tbody", table, remision);
		}

		$('#modalPackingList').on('show.bs.modal', function (e) {
			var opcion = "listarpartidas";
			var remision = "<?php echo $_REQUEST['remision']; ?> ";
			var table = $("#dt_packing_list").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"remision": remision,"opcion": opcion}
				},
				"columns":[
					{"data": "indice"},
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "cantidad"},
					{"data": "descripcion"},
					{"data": "check"},
				],
				"order": false,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
		        "ordering": false,
		        "language": idioma_espanol,
		        "dom":
      				"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
      				"<'row be-datatable-body'<'col-sm-12'tr>>" +
      				"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
			});
		})

		var packinglist = function(){
			$("#agregar-packing-list").on("click", function(){
				var verificar = 0;
				$("input[name=hpacking]").each(function (index) {
					if($(this).is(':checked')){
						verificar++;
					}
				});
				if(verificar == 0){
					alert("Debes de seleccionar al menos una partida!");
				}else{
					var herramienta = new Array();
					$("input[name=hpacking]").each(function (index) {
						if($(this).is(':checked')){
							herramienta.push($(this).val());
						}
					});
					var opcion = "packinglist";
					console.log(herramienta);
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
					}).done( function( data ){
						console.log(data);
						mostrar_mensaje(data);
					});
				}
			});
		}

		var entregado = function(remision, RFC){
			var verificar = 0;
			$("input[name=hentregado]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});
			if(verificar == 0){
				alert("Debes de seleccionar al menos una partida!");
			}else{
				var herramienta = new Array();
				$("input[name=hentregado]").each(function (index) {
					if($(this).is(':checked')){
						herramienta.push($(this).val());
					}
				});
				var opcion = "entregado";
				console.log(herramienta);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
				}).done( function( info ){
					mostrar_mensaje(info);
					$("#dt_pedido").DataTable().ajax.reload();
				});
			}
		}

		function genPDF(remision, opcionPDF) {
	      var opcion = "imprimircotizacion";
	      $.ajax({
	        method: "POST",
	        url: "buscar.php",
	        dataType: "json",
	        data: {"opcion": opcion, "remision": remision},
	      }).done( function( data ){
	        console.log(data);
	        var columns = [
	            {title: "#", dataKey: "indice"},
	            {title: "Marca", dataKey: "marca"},
	            {title: "Modelo", dataKey: "modelo"},
	            {title: "Descripción", dataKey: "descripcion"},
							{title: "Pedido cliente", dataKey: "pedidoCliente"},
	            {title: "Cantidad", dataKey: "cantidad"},
	            {title: "P. Unitario", dataKey: "precioUnitario"},
	            {title: "P. Total", dataKey: "precioTotal"},
	        ];

	        var rows = data.partidas;

	        var columnstotales = [
	            {title: "SUBTOTAL", dataKey: "subtotal"},
	            {title: "IVA (16%)", dataKey: "iva"},
	            {title: "TOTAL", dataKey: "total"},
	        ];

	        var rowstotales = data.totales;
	        var imgLogo = 'data:image/jpeg;base64,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';
	      var doc = new jsPDF('p', 'pt', 'a4');
				doc.setLineWidth(1)
				doc.setDrawColor(0,0,0);
        doc.line(20, 28, 575, 28)
        doc.addImage(imgLogo, 'JPEG', 20, 30, 150, 58);
        doc.setFontStyle('bold');
        doc.setFontSize(14);
        doc.text("HERRAMIENTAS MECÁNICAS UNIVERSALES S.A. DE C.V.", 175, 50);
        doc.setFontStyle('normal');
        doc.setFontSize(9);
        doc.text("RUPERTO MARTINEZ 831 PTE, MONTERREY, N.L., C.P. 64000, MEXICO", 215, 65);
        doc.text("TELS: (81) 8345 3811, FAX: (81) 8342 8082,    ventas@hemusa.com, www.hemusa.com", 190, 80);
        doc.setLineWidth(1);
				doc.setDrawColor(0,0,0);
        doc.line(20, 92, 575, 92);
				doc.setFontSize(13);
				doc.setFontStyle('bold');
				doc.text("REMISION", 270, 110);
				doc.setFontSize(10);
				doc.setFontStyle('bold');
				doc.text("Fecha:", 385, 135);
				doc.text("Hecho por:", 385, 150);
				doc.text("Folio:", 385, 165);
				doc.setFontStyle('normal');
				doc.text(data.cotizacion.fecha, 475, 135);
				if(data.cotizacion.vendedor == ''){
					doc.text(data.cotizacion.contacto, 475, 150);
				}else{
					doc.text(data.cotizacion.vendedor, 475, 150);
				}
				doc.text(data.cotizacion.remision, 475, 165);
				doc.setFontSize(10);
				doc.setFontStyle('bold');
				doc.text("Cliente", 20, 135);
				doc.text("Condiciones de pago", 395, 230);
				doc.setFontSize(10);
				doc.setFontStyle('normal');
				doc.text(data.cliente.nombreEmpresa, 20, 150);
				if (data.cotizacion.CondPago == 0) {
					doc.text("Contado", 435, 245);
				}else{
					doc.text(data.cotizacion.CondPago + " días", 435, 245);
				}
				doc.text(data.cliente.RFC, 20, 165);
				doc.setFontStyle('bold');
				doc.setFontSize(10);
				doc.text("Contacto", 425, 195);
				doc.setFontSize(10);
				doc.setFontStyle('normal');
				doc.text(data.cotizacion.contacto, 420, 210);
				doc.text(data.cliente.calle + ", " + data.cliente.colonia, 20, 180);
				doc.text(data.cliente.ciudad + ", " + data.cliente.estado + ", C.P." + data.cliente.cp, 20, 195);

	        doc.autoTable(columns, rows, {
	          theme: 'grid',
	          margin: {top: 280, right: 20, bottom: 20, left: 20},
	          tableWidth: 'auto',
	          styles: {overflow: 'linebreak', cellPadding: 6, fontSize: 8, rowHeight: 15, pageBreak: 'always', columnWidth: 'auto'},
						columnStyles: {
	            indice: {columnWidth: 20, halign: 'center'},
	            marca: {columnWidth: 60},
	            modelo:{columnWidth: 60},
	            descripcion: {columnWidth: 195},
							pedidoCliente: {columnWidth: 70},
	            cantidad:{columnWidth:50, halign: 'center'},
	            precioUnitario: {columnWidth: 50},
	            precioTotal:{columnWidth: 50},
	          },
	        });

	        doc.autoTable(columnstotales, rowstotales, {
	          theme: 'grid',
	                  margin: {top: doc.autoTable.previous.finalY  + 15, right: 20, bottom: 20, left: 350},
	          tableWidth: 'auto',
	          styles: {overflow: 'linebreak', cellPadding: 6, fontSize: 8, rowHeight: 15, pageBreak: 'always', columnWidth: 'auto'},
	        });

					doc.setFontSize(10);
	        doc.setFontStyle('bold');
	      doc.text("Recibí de conformidad:", 130, doc.autoTable.previous.finalY  + 50);
				doc.text("Surtido por:", 350, doc.autoTable.previous.finalY  + 50);
			doc.setFontStyle('normal');
			doc.setFontSize(9);
	        doc.text("Nombre:", 130, doc.autoTable.previous.finalY  + 70);
			doc.text("Firma:", 130, doc.autoTable.previous.finalY  + 90);
	        doc.setFontStyle('bold');
			doc.setFontStyle('normal');
	        doc.text("Nombre:", 350, doc.autoTable.previous.finalY  + 70);
			if(data.cotizacion.vendedor == ""){
				doc.text(data.cotizacion.contacto, 390, doc.autoTable.previous.finalY  + 70);
			}else{
				doc.text(data.cotizacion.vendedor, 390, doc.autoTable.previous.finalY  + 70);
			}
			doc.text("Firma:", 350, doc.autoTable.previous.finalY  + 90);
			doc.setLineWidth(1)
			doc.setDrawColor(0,0,0);
			doc.setFontStyle('normal');
			doc.line(20, doc.autoTable.previous.finalY  + 110, 575, doc.autoTable.previous.finalY  + 110)
			doc.setFontSize(11);
			doc.text("¿Necesitas Herramienta? ¡Llámanos!", 200, doc.autoTable.previous.finalY  + 140);
			if (opcionPDF == "imprimir") {
				doc.autoPrint();
			}
      doc.save('remision_'+remision+'.pdf');

      });
    }

		$('#modalAgregarHerramienta').on('show.bs.modal', function (e) {
			var idcontacto = "<?php echo $idcliente; ?>";
			var opcion = "agregarherramienta";
			var table = $("#dt_agregar_herramienta").DataTable({
				"destroy": true,
				"autoWidth": true,
				"processing": true,
				"deferRender": true,
				"scrollX": true,
				"sPaginationType": "full_numbers",
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"opcion": opcion, "idcontacto": idcontacto}
				},
				"columns":[
					{"data": "indice"},
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "descripcion"},
					{"data": "cantidad"},
					{"data": "precioTotal"},
					{"data": "cotizacion"},
					{"data": "numeroPedido"},
					{"data": "input"}
				],
				"createdRow": function ( row, data, index ) {
					if ( data.enviado != '0000-00-00' && data.recibido == '0000-00-00' ) {
						$('td', row).eq(1).addClass('table-text-enviado');
						$('td', row).eq(2).addClass('table-text-enviado');
					}

					if ( data.enviado != '0000-00-00' && data.recibido != '0000-00-00' ) {
						$('td', row).eq(1).addClass('table-text-recibido');
						$('td', row).eq(2).addClass('table-text-recibido');
					}
				},
				"dom":
      				"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
      				"<'row be-datatable-body'<'col-sm-12'tr>>" +
      				"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"order": false,
		        "lengthChange": false,
		        "info": false,
		        "paging": false,
		        "ordering": false,
		        "language": idioma_espanol
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

			$("input[name=hpacking]").each(function (index) {
				if($("input[name=sel]").is(':checked')){
					$('input[name=hpacking]').prop('checked' , true);
				}else{
					$('input[name=hpacking]').prop('checked' , false);
				}
			});

			$("input[name=hentregado]").each(function (index) {
				if($("input[name=sel]").is(':checked')){
					$('input[name=hentregado]').prop('checked' , true);
				}else{
					$('input[name=hentregado]').prop('checked' , false);
				}
			});
		}

		$("#cambiarmoneda").on("click", function (e) {
			e.preventDefault();
			var remision = "<?php  echo $_REQUEST['remision']; ?>";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion = "cambiarMoneda", "remision": remision},
			}).done( function ( info ) {
				mostrar_mensaje(info);
				buscardatos(remision);
				$("#dt_pedido").DataTable().ajax.reload();
			});
		});

		var cambiarnumeroguia = function(remision){
			$("#cambiarng").on("click", function(e){
				e.preventDefault();
				var opcion = "numeroguia";
				var numeroguia = $("#numeroGuia").val();
				console.log(numeroguia);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "remision": remision, "numeroguia": numeroguia},
				}).done( function( info ){
					mostrar_mensaje(info);
				});
			});
		}

		var cambiarpaqueteria = function(remision){
			$("#cambiarpaqueteria").on("click", function(e){
				e.preventDefault();
				var opcion = "paqueteria";
				var paqueteria = $("#paqueteria").val();
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "paqueteria": paqueteria, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
				});
			});
		}

		function proveedores(){
			var opcion = "proveedores";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var proveedores = data;
					console.log(proveedores);
					$('select[name=proveedor]').empty();
					$("select[name=proveedor]").append("<option>Seleccionar...</option>");
					$("select[name=proveedor]").append("<option>None</option>");
					$("select[name=proveedor]").append("<option>ALMACEN</option>");
					for(var i=0;i<proveedores.length;i++){
						if (proveedor == proveedores[i]) {
							$("select[name=proveedor]").append("<option selected>"+proveedores[i]+"</option>");
						}else{
	           	 			$("select[name=proveedor]").append("<option>"+proveedores[i]+"</option>");
						}
	 				};
	 				$('select[name=proveedorg]').empty();
					$("select[name=proveedorg]").append("<option>Seleccionar...</option>");
					$("select[name=proveedorg]").append("<option>None</option>");
					$("select[name=proveedorg]").append("<option>ALMACEN</option>");
					for(var i=0;i<proveedores.length;i++){
	           	 		$("select[name=proveedorg]").append("<option>"+proveedores[i]+"</option>");
	 				};
	   			}
			});
		}

		var cambiarproveedorgeneral = function(remision){
			$("#cambiarproveedor").on("click", function(e){
				e.preventDefault();
				var opcion = "proveedor";
				var proveedor = $("#proveedorg").val();
				console.log(opcion);
				console.log(proveedor);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "proveedor": proveedor, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
					$("#dt_pedido").DataTable().ajax.reload();
				});
			});
		}

		var cambiarcantidadgeneral = function(remision){
			$("#cambiarcantidadg").on("click", function(event){
				event.preventDefault();
				var opcion = "cantidad";
				var cantidad = $("#cantidadg").val();
				if (cantidad == 0 || cantidad == "") {
					alert("Error en cantidad general!");
				}
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "cantidad": cantidad, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
					$("#dt_pedido").DataTable().ajax.reload();
				});
			});
		}

		var cambiarformapago = function(remision){
			$("#cambiarformapago").on("click", function(event){
				event.preventDefault();
				var opcion = "formapago";
				var formapago = $("#formapago").val();
				console.log(opcion);
				console.log(formapago);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "formapago": formapago, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
				});
			});
		}

		var cambiarmetodopago = function(remision){
			$("#cambiarmetodopago").on("click", function(event){
				event.preventDefault();
				var opcion = "metodopago";
				var metodopago = $("#metodopago").val();
				console.log(metodopago);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "metodopago": metodopago, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
				});
			});
		}

		var cambiarusocfdi = function(remision){
			$("#cambiarusocfdi").on("click", function(event){
				event.preventDefault();
				var opcion = "usocfdi";
				var cfdi = $("#cfdi").val();
				console.log(cfdi);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "cfdi": cfdi, "remision": remision},
				}).done( function( info ){
					mostrar_mensaje(info);
				});
			});
		}

		var editarPartida = function(remision){
			$("#editar-partida").on("click", function(){
				var cantidad = $("#frmEditar #cantidad").val();
				var split = $("#frmEditar #split").val();
				if (document.getElementById("split").disabled == true	) {
					split = 0;
				}
				if (split >= cantidad) {
					alert("Error en cantidad de split!");
				}else{
					$("#modalEditar").modal("hide");
					var frm = $("#frmEditar").serialize()
					console.log(frm);
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: frm,
					}).done( function( info ){
						$("#dt_pedido").DataTable().ajax.reload();
						mostrar_mensaje(info);
					});
				}
			});
		}

		var generar_factura = function(RFC, remision){
			$("#mod-success").modal("show");
			var request = new XMLHttpRequest();

			request.open('GET', apiConfig.enlace+'api/v1/clients/'+RFC);

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', apiConfig.apiKey);
			request.setRequestHeader('F-SECRET-KEY', apiConfig.secretKey);

			request.onreadystatechange = function () {
				if (this.readyState === 4) {
			    console.log('Status:', this.status);
		    	console.log('Headers:', this.getAllResponseHeaders());
		    	console.log('Body:', this.responseText);
		    	var data = JSON.parse(this.responseText);
			    if (data.status == "error"){
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
									}, 425);
									guardarFactura(remision);
					 			}
							}
						};

						var opcion = "buscarpartidasfacturar";
						$.ajax({
							method: "POST",
							url: "buscar.php",
							dataType: "json",
							data: {"opcion": opcion, "remision": remision}
						}).done( function( conceptos ){
								console.log(conceptos);
								var fecha = "<?php echo date("Y-m-d")."T".date("H:i:s"); ?>";
								var body = {
							    'Receptor': {
							        'UID': data.Data.UID,
							        'ResidenciaFiscal': '',
							    },
							    'TipoDocumento':'factura',
							    'Conceptos': conceptos.data,
							    'UsoCFDI': conceptos.cfdi,
							    'Serie':'1194',
							    'FormaPago': conceptos.formapago,
							    'MetodoPago': conceptos.metodopago,
							    'CondicionesDePago': conceptos.condpago,
							    'Moneda': conceptos.moneda,
							    'TipoCambio': conceptos.tipocambio,
							    'NumOrder': remision,
							    'FechaFromAPI': fecha,
							    // 'Comentarios': 'Comentarios para agregar a la factura PDF',
							    'EnviarCorreo': false
								};
								console.log(JSON.stringify(body));
								request.send(JSON.stringify(body));
						});
					}
				}
			};
			request.send();
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
				// alert("El cliente no esta registrado en portal de Factura.com\n\n Registrarlo a continuación");
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

		function guardarFactura(remision) {
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
						if (remision == data.data[i].NumOrder){
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
								data: {"opcion": opcion, "folio": folio, "ordenpedido": ordenpedido, "total": total, "status": status, "fecha": fecha, "cliente": cliente}
							}).done( function( data ){
								console.log(data);
								mostrar_mensaje(data);
							});

							descargarPDF(UID);
						}
					}
				}
			};
			request.send();
		}

		function descargarPDF (UID) {
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
					link.download = "factura.pdf";
					link.click();
				}
			};

			request.send();
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

			request.open('POST', 'http://factura.com/api/v1/clients/create');

			request.setRequestHeader('Content-Type', 'application/json');
			request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
			request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

			request.onreadystatechange = function () {
			  if (this.readyState === 4) {
			    console.log('Status:', this.status);
			    console.log('Headers:', this.getAllResponseHeaders());
			    console.log('Body:', this.responseText);
			    var data = JSON.parse(this.responseText);
			    if (data.status == "success"){
			    	texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Bien!</strong> El cliente se registro correctamente en el portal! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
					color = "#379911";

					$(".mensaje").html( texto );
			    }else{
			    	texto = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
					color = "#C9302C";

					$(".mensaje").html( texto );
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

			console.log(JSON.stringify(body));
			request.send(JSON.stringify(body));
			$("#modalRegistrarClientePortal").modal("hide");
		});

		function ocultarcolumnas(){
			var columnaentregado=document.getElementById('columnaentregado');
			columnaentregado.click();
			var columnaalmacen=document.getElementById('columnaalmacen');
			columnaalmacen.click();
			var columnaproveedor=document.getElementById('columnaproveedor');
			columnaproveedor.click();
			var columnasplit=document.getElementById('columnasplit');
			columnasplit.click();
		}

		var agregarHerramienta = function(remision){
			$("#agregar-herramienta").on("click", function(){
				var verificar = 0;
				$("input[name=hremision]").each(function (index) {
					if($(this).is(':checked')){
						verificar++;
					}
				});
				if(verificar == 0){
					alert("Debes de seleccionar al menos una partida!");
				}else{
					var herramienta = new Array();
					var numeroPartidas = 0;
					$("input[name=hremision]").each(function (index) {
						if($(this).is(':checked')){
							herramienta.push($(this).val());
							numeroPartidas++;
						}
					});
					var opcion = "agregarherramientaremision";
					console.log(herramienta);
					console.log(remision);
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion, "remision": remision},
					}).done( function( data ){
						$(".modal").modal("hide");
						mostrar_mensaje(data);
						$("#dt_pedido").DataTable().ajax.reload();
					});
				}
			});
		}

		function cerrarcollapse(){
			$('.collapse').collapse('hide');
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				$("#frmEditar #id").val(data.id);
				$("#frmEditar #claveSat").val(data.claveSat);
				$("#frmEditar #noserie").val(data.noserie);
				$("#frmEditar #cantidad").val(data.cantidad);
				$("#frmEditar #fechacompromiso").val(data.fechacompromiso);
				$("#frmEditar #proveedor").val(data.proveedor).change();
				$("#frmEditar #entregado").val(data.entregado);
				var cantidad = data.cantidad;
				if (cantidad > 1) {
					document.getElementById("split").disabled = false;
					$("#frmEditar #split").val(0);
				}else{
					$("#frmEditar #split").val("No split");
					document.getElementById("split").disabled = true;
				}
			});
		}

		var obtener_data_quitar = function(tbody, table, remision){
			$(tbody).on("click", "button.quitar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				idherramienta = data.id;
				if (confirm("Esta seguro(a) de quitar la herramienta de la remision?")){
					var opcion = "quitarherramientaremision";
					$.ajax({
						method: "POST",
						url: "guardar.php",
						dataType: "json",
						data: {"opcion": opcion, "idherramienta": idherramienta, "remision": remision},
						success: function ( info ) {
							mostrar_mensaje( info );
							$("#dt_pedido").DataTable().ajax.reload();
						}
					});
				}
			});
		}

		var listar_devolucion = function(refCotizacion, numeroPedido){
			var opcion = "devolucion";
			var table = $("#dt_devolucion").DataTable({
					"destroy":"true",
					"deferRender": true,
					"ajax":{
						"url": "listar.php",
						"type": "POST",
						"data": {"refCotizacion": refCotizacion, "numeroPedido": numeroPedido, "opcion": opcion}
					},
					"columns":[
						{"data": "marca"},
						{"data": "modelo"},
						{"data": "descripcion"},
						{"data": "check"}
					],
					"order": false,
			        "lengthChange": false,
			        "info": false,
			        "paging": false,
			        "ordering": false,
			        "searching": false
				});
		}

		var agregarDevolucion = function(refCotizacion, numeroPedido){
			$("#agregar-devolucion").on("click", function(){
				var comentarios = $("#frmDevolucion #comentarios").val();
				var herramienta = new Array();
				var numeroPartidas = 0;
				$("input[name=hdevolucion]").each(function (index) {
					if($(this).is(':checked')){
						herramienta.push($(this).val());
						numeroPartidas++;
					}
				});

				if (numeroPartidas == 0) {
					alert("Debes de seleccionar al menos una partida!");
				}else{
					if (comentarios == "") {
						alert("Escribe un motivo de la devolucion!");
					}else{
						$("#modalDevolucion").modal('hide');
					}
				}

				// console.log(frm);
				// $.ajax({
				// 	method: "POST",
				// 	url: "guardar.php",
				// 	data: frm
				// }).done( function( info ){
				// 	console.log(info);
				// 	var json_info = JSON.parse( info );
				// 	mostrar_mensaje(json_info);
				// 	limpiar_datos();
				// 	listar_partidas();
				// 	listar_info_tabla();
				// 	listar_totales_tabla();
				// });
			});
		}
	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
