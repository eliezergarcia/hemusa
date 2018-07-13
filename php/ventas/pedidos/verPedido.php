<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);
	$resultado = mysqli_query($conexion_usuarios, "SELECT cliente FROM cotizacion WHERE ref='".$_REQUEST['refCotizacion']."'");
	while($data = mysqli_fetch_array($resultado)){
		$idcliente = $data['cliente'];
	}
	$resultado = mysqli_query($conexion_usuarios, "SELECT * FROM contactos WHERE id='$idcliente'");
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
        <h2 class="page-head-title" style="font-size: 30px;"><b>Pedido</b></h2>
        <nav aria-label="breadcrumb" role="navigation">
			  	<ol class="breadcrumb">
			    	<li class="breadcrumb-item">Ventas</li>
			    	<li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="pedidos.php" class="text-primary">Pedidos</a></li>
			    	<li id="breadcrumb" class="breadcrumb-item acti ve" aria-current="page">
			    		Cliente: <a id="toolTipVerCliente" href="<?php echo $ruta; ?>php/ventas/clientes/verContacto.php?id=<?php echo $idcliente; ?>" class="text-primary"><?php echo $nombrecliente; ?></a> - Ref. Cotizacion: <a href="<?php echo $ruta; ?>php/ventas/cotizaciones/verCotizacion.php?numero=<?php echo $_REQUEST['refCotizacion']; ?>" class="text-primary"><?php echo $_REQUEST['refCotizacion']; ?></a> - No. Pedido: <?php echo $_REQUEST['numeroPedido']; ?>
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
													<h4><b>Pedido cliente</b></h4>
													<label id="pedidoCliente"></label>
												</div>
												<div class="col-3 form-group">
													<h4><b>Facturas</b></h4>
													<label id="factura"></label>
												</div>
												<div class="col-3 form-group">
													<h4><b>Pagado</b></h4>
													<label id="pagado"></label>
												</div>
												<div class="col-3 form-group">
													<h4><b>Moneda </b> <a id="cambiarmoneda" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<select id="moneda" class="form-control form-control-sm col-10">
														<option value="usd" selected>USD</option>
														<option value="mxn">MXN</option>
													</select>
												</div>
												<div class="col-3 form-group">
													<h4><b>Paquetería </b><a id="cambiarpaqueteria" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<select id="paqueteria" class="form-control form-control-sm col-10">
													</select>
												</div>
												<div class="col-3 form-group">
													<h4><b>No. de guía</b></h4>
													<div class="input-group mb-3">
														<input type="text" id="numeroGuia" class="form-control form-control-sm col-9">
														<div class="input-group-append">
															<button id="cambiarng" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
														</div>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4><b>Forma de pago </b><a id="cambiarformapago" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<div>
												  	<select type="text" id="formapago" name="formapago" class="form-control form-control-sm col-10">
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
														<select type="text" id="metodopago" name="metodopago" class="form-control form-control-sm col-10">
															<option value="1">Pago en una sola exhibición</option>
															<option value="2">Pago en parcialidades o diferido</option>
														</select>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4><b>Uso de CFDI </b><a id="cambiarusocfdi" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<div>
														<select id="cfdi" name="cfdi" class="form-control form-control-sm col-10">
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
												<div class="col-3 form-group">
													<h4><b>Proveedor </b><a id="cambiarproveedor" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<div>
														<select name="proveedorg" id="proveedorg" class="form-control form-control-sm col-10"></select>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4><b>Cantidad</b></h4>
													<div class="input-group mb-3">
														<input type="text" id="cantidadg" class="form-control form-control-sm col-9">
														<div class="input-group-append">
															<button id="cambiarcantidadg" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<hr>
				    			<!-- Tabla de partidas -->
				    				<br><br><br>
				    				<table id="dt_pedido" class="table table-striped table-hover table-fw-widget" width="100%">
											<thead>
												<tr>
													<th><input type="checkbox" class="btn btn-outline-primary" name="selprovg" onclick="seleccionartodo()"></th>
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
													<th>Remisión</th>
													<th>Factura</th>
													<!-- <th>Entregado <input type="checkbox" class="btn btn-outline-primary" name="sel" onclick="seleccionartodo()"></th> -->
													<th>Editar</th>
												</tr>
											</thead>
										</table>

				    			<!-- Tabla de totales -->
				    				<br><br><br>
				    				<div class="col-12 row justify-content-end align-items-start">
										<div class="col row justify-content-start">

										</div>
										<div class="col-3">
											<div class="row justify-content-center">
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
									<br><br>
							</div>
						</div>
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
							<table id="dt_packing_list" class="table table-hover table-striped display compact" cellspacing="0" width="100%">
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
					      		<!-- <div class="form-group row">
					      			<label for="cantidad" class="control-label col-4">Cantidad</label>
					      			<input type="text" class="form-control form-control-sm col-7" name="cantidad" id="cantidad">
					      		</div> -->
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
										<!-- <div class="form-group row">
					      			<label for="entregado" class="control-label col-4">Entregado</label>
					      			<input type="date" class="form-control form-control-sm col-7" name="entregado" id="entregado">
					      		</div> -->
										<div class="form-group row">
					      			<label for="pedimento" class="control-label col-4">Pedimento</label>
					      			<input type="text" class="form-control form-control-sm col-7" name="pedimento" id="pedimento">
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
				        		<h5 class="modal-title" id="exampleModalLabel">Devolucion de material</h5>
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
					        		<textarea name="comentarios" id="comentarios" cols="30" rows="5" class="form-control form-control-sm"></textarea>
					        	</div>
					      	</div>
					      	<div class="modal-footer invoice-footer">
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					        	<button id="agregar-devolucion" type="button" class="btn btn-danger">Devolucion</button>
					      	</div>
				    	</div>
				  	</div>
				</div>
			</form>

		<!-- Modal Registrar Cliente en Portal -->
			<div class="modal fade colored-header colored-header-success" id="modalRegistrarClientePortal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="exampleModalLabel">Registro de cliente en portal Factura.com</h4>
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

		<!-- Modal Información Facturar -->
			<div class="modal fade colored-header colored-header-success" id="modalInformacionFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="exampleModalLabel">Información de factura</h4>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
				      	<div class="modal-body">
									<h4>Por favor verifique los datos a continuación antes de facturar:</h4>
				        	<form id="frmInformacionFactura" action="" method="POST">
			        			<div class="row form-group">
			        				<div class="col-8">
			        					<label for="cliente">Cliente <font color="#FF4136">*</font></label>
			        					<input type="text" id="cliente" name="cliente" class="form-control form-control-sm" disabled required>
			        				</div>
			        				<div class="col">
			        					<label for="tipoDocumento">Tipo de documento <font color="#FF4136">*</font></label>
			        					<input type="text" id="tipoDocumento" name="tipoDocumento" class="form-control form-control-sm" value="factura" disabled required>
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
											<div class="col">
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
			var refCotizacion = "<?php echo $_REQUEST['refCotizacion']; ?>";
			var numeroPedido = "<?php echo $_REQUEST['numeroPedido']; ?>";
			buscardatos(refCotizacion, numeroPedido);
			agregarDevolucion(refCotizacion, numeroPedido);
			cambiarnumeroguia(refCotizacion, numeroPedido);
			cambiarpaqueteria(refCotizacion, numeroPedido);
			cambiarformapago(refCotizacion, numeroPedido);
			cambiarmetodopago(refCotizacion, numeroPedido);
			cambiarusocfdi(refCotizacion, numeroPedido);
			editarPartida(refCotizacion, numeroPedido);
			packinglist();
		});

		$('#modalPackingList').on('show.bs.modal', function (e) {
			var opcion = "listarpartidas";
			var refCotizacion = "<?php echo $_REQUEST['refCotizacion']; ?> ";
			var numeroPedido = "<?php echo $_REQUEST['numeroPedido']; ?> ";
			var table = $("#dt_packing_list").DataTable({
					"destroy":"true",
					"deferRender": true,
					"scrollX": true,
					"ajax":{
						"url": "listar.php",
						"type": "POST",
						"data": {"refCotizacion": refCotizacion, "numeroPedido": numeroPedido, "opcion": opcion}
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
          				"<'row be-datatable-body'<'col-sm-12'tr>>",
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

		function seleccionartodo(){
			$("input[name=hdevolucion]").each(function (index) {
				if($(this).is(':checked')){
					$('input[type="checkbox"]').prop('checked' , false);
				}else{
					$('input[type="checkbox"]').prop('checked' , true);
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

			$("input[name=hproveedor]").each(function (index) {
				if($("input[name=selprovg]").is(':checked')){
					$('input[name=hproveedor]').prop('checked' , true);
				}else{
					$('input[name=hproveedor]').prop('checked' , false);
				}
			});
		}

		function cerrarcollapse(){
			$('.collapse').collapse('hide');
		}

		var listar_partidas = function(refCotizacion, numeroPedido, RFC){
				var opcion = "listarpartidas";
				var table = $("#dt_pedido").DataTable({
					"destroy":"true",
					"deferRender": true,
					"scrollX": true,
					"autoWidth": false,
					"ajax":{
						"url": "listar.php",
						"type": "POST",
						"data": {"refCotizacion": refCotizacion, "numeroPedido": numeroPedido, "opcion": opcion}
					},
					"columns":[
						{"data": "check"},
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
						{"data": "remision"},
						{"data": "factura"},
						{"defaultContent": "<div class='invoice-footer'><button type='button' class='editar btn btn-lg btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"columnDefs": [
						{ "width": "2%", "targets": 0 },
						{ "width": "2%", "targets": 1 },
						{ "width": "10%", "targets": 2 },
						{ "width": "10%", "targets": 3 },
						// { "width": "10%", "targets": 4 },
						{ "visible": false, "targets": 5 },
						{ "width": "8%", "targets": 6 },
						{ "width": "5%", "targets": 7 },
						{ "width": "8%", "targets": 8 },
						{ "visible": false, "targets": 9 },
						{ "visible": false, "targets": 10 },
						{ "width": "15%", "targets": 11 },
						{ "width": "2%", "targets": 12 },
						{ "width": "2%", "targets": 13 },
						{ "width": "5%", "targets": 14 },
						{ "width": "5%", "targets": 15 },
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
                .column( 8 )
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
							$('td', row).eq(2).addClass('table-text-enviado');
							$('td', row).eq(3).addClass('table-text-enviado');
						}

						if ( data.enviado != '0000-00-00' && data.recibido != '0000-00-00' ) {
							$('td', row).eq(2).addClass('table-text-recibido');
							$('td', row).eq(3).addClass('table-text-recibido');
						}
						if ( data.enviado == '0000-00-00' && data.recibido == '0000-00-00' ) {
							$('td', row).eq(2).addClass('text-danger');
							$('td', row).eq(3).addClass('text-danger');
						}
					},
					"buttons":[
						// {
            //   text: 'Devolucion',
            //   "className": "btn btn-danger",
            //   action: function ( e, dt, node, config ) {
            //   	$('#modalDevolucion').modal('show');
            //   	listar_devolucion(refCotizacion, numeroPedido);
            //   }
            // },
						// {
						// 	text: '<i class="fas fa-check-circle fa-sm" aria-hidden="true"></i> Entregado',
						// 	"className": "btn btn-lg btn-space btn-secondary",
						// 	action: function ( e, dt, node, config ) {
						// 		entregado(refCotizacion, numeroPedido, RFC);
						// 	}
						// },
						{
							extend: 'colvis',
							columns: ':not(.noVis)',
							text: '<i class="fas fa-columns fa-sm"></i> Columnas',
							"className": "btn btn-lg btn-space btn-secondary",
						},
            {
                text: '<i class="fas fa-box fa-sm" aria-hidden="true"></i> Lista de embarque',
                "className": "btn btn-lg btn-space btn-secondary",
                action: function ( e, dt, node, config ) {
                	$('#modalPackingList').modal('show');
                }
            },
						{
							text: '<i class="fas fa-file-alt fa-sm" aria-hidden="true"></i> Generar factura',
							"className": "btn btn-lg btn-space btn-primary",
							action: function ( e, dt, node, config ) {
								buscar_datos_factura(RFC, numeroPedido, refCotizacion);
							}
						}
					]
				});

			proveedores();
			obtener_data_split("#dt_pedido tbody", table);
			obtener_data_editar("#dt_pedido tbody", table);
			buscar_cliente_portal(RFC, numeroPedido, refCotizacion);
		}

		var entregado = function(refCotizacion, numeroPedido, RFC){
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
				}).done( function( data ){
					console.log(data);
					mostrar_mensaje(data);
					$("#dt_pedido").DataTable().ajax.reload();
				});
			}
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
				var cantidad = data.cantidad;
				if (cantidad > 1) {
					document.getElementById("split").disabled = false;
					$("#frmEditar #split").val(0);
				}else{
					$("#frmEditar #split").val("No split");
					document.getElementById("split").disabled = true;
				}
				$("#frmEditar #entregado").val(data.entregado);
				$("#frmEditar #pedimento").val(data.pedimento);
			});
		}

		var editarPartida = function(refCotizacion, numeroPedido){
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
						data: frm,
					}).done( function( info ){
						var json_info = JSON.parse( info );
						console.log(json_info);
						$("#dt_pedido").DataTable().ajax.reload();
						mostrar_mensaje(json_info);
					});
				}
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

		function buscardatos(refCotizacion, numeroPedido){
			var opcion = "buscardatos";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				success : function(data) {
					console.log(data);
					console.log(data.ordenCompra);
					document.getElementById("refCotizacion").innerHTML = data.refCotizacion;
					document.getElementById("fecha").innerHTML = data.fecha;
					document.getElementById("vendedor").innerHTML = data.vendedor;
					document.getElementById("pedidoCliente").innerHTML = data.pedidoCliente;
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
					var RFC = data.cliente.RFC;
					paqueterias(paqueteria);
					listar_partidas(refCotizacion, numeroPedido, RFC);
					cambiarproveedorgeneral(refCotizacion, numeroPedido, RFC);
					cambiarcantidadgeneral(refCotizacion, numeroPedido, RFC);

					var request = new XMLHttpRequest();

					request.open('GET', apiConfig.enlace + 'api/v3/cfdi33/list');

					request.setRequestHeader('Access-Control-Allow-Origin', '*');
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
					};

					// request.onreadystatechange = function () {
					// 	if (this.readyState === 4) {
					// 		console.log('Status:', this.status);
					// 		console.log('Headers:', this.getAllResponseHeaders());
					// 		var data = JSON.parse(this.responseText);
					// 		console.log(data);
					// 		var total = data.total;
					// 		for (var i = 0; i < total; i++) {
					// 			if (numeroPedido == data.data[i].NumOrder){
					// 				document.getElementById("factura").innerHTML = data.data[i].Folio;
					// 			}
					// 		}
					// 	}
					// };
					// request.send();
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

		var obtener_data_split = function(tbody, table){
			$(tbody).on("click", "button.split", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				$("#frmSplit #idherramienta").val(data.id);
				$("#frmSplit #modelo").val(data.modelo);
				$("#frmSplit #cantidad").val(data.cantidad);
			});
		}

		$("#cambiarmoneda").on("click", function (e) {
			e.preventDefault();
			var refCotizacion = "<?php  echo $_REQUEST['refCotizacion']; ?>";
			var numeroPedido = "<?php  echo $_REQUEST['numeroPedido']; ?>";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion = "cambiarMoneda", "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
			}).done( function ( info ) {
				mostrar_mensaje(info);
				buscardatos(refCotizacion, numeroPedido);
			});
		});

		var cambiarnumeroguia = function(refCotizacion, numeroPedido){
			$("#cambiarng").on("click", function(event){
				event.preventDefault();
				var opcion = "numeroguia";
				var numeroguia = $("#numeroGuia").val();
				console.log(numeroguia);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "numeroguia": numeroguia, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					buscardatos(refCotizacion, numeroPedido);
				});
			});
		}

		var cambiarpaqueteria = function(refCotizacion, numeroPedido){
			$("#cambiarpaqueteria").on("click", function(event){
				event.preventDefault();
				var opcion = "paqueteria";
				var paqueteria = $("#paqueteria").val();
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "paqueteria": paqueteria, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					buscardatos(refCotizacion, numeroPedido);
				});
			});
		}

		var cambiarformapago = function(refCotizacion, numeroPedido){
			$("#cambiarformapago").on("click", function(event){
				event.preventDefault();
				var opcion = "formapago";
				var formapago = $("#formapago").val();
				console.log(opcion);
				console.log(formapago);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "formapago": formapago, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					buscardatos(refCotizacion, numeroPedido);
				});
			});
		}

		var cambiarmetodopago = function(refCotizacion, numeroPedido){
			$("#cambiarmetodopago").on("click", function(event){
				event.preventDefault();
				var opcion = "metodopago";
				var metodopago = $("#metodopago").val();
				console.log(opcion);
				console.log(metodopago);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "metodopago": metodopago, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					buscardatos(refCotizacion, numeroPedido);
				});
			});
		}

		var cambiarusocfdi = function(refCotizacion, numeroPedido){
			$("#cambiarusocfdi").on("click", function(event){
				event.preventDefault();
				var opcion = "usocfdi";
				var cfdi = $("#cfdi").val();
				console.log(opcion);
				console.log(cfdi);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "cfdi": cfdi, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					buscardatos(refCotizacion, numeroPedido);
				});
			});
		}

		var cambiarproveedorgeneral = function(refCotizacion, numeroPedido, RFC){
			$("#cambiarproveedor").on("click", function(e){
				e.preventDefault();
				var opcion = "proveedor";
				var proveedor = $("#proveedorg").val();
				console.log(opcion);
				console.log(proveedor);
				var verificar = 0;
				$("input[name=hproveedor]").each(function (index) {
					if($(this).is(':checked')){
						verificar++;
					}
				});
				if(verificar == 0){
					alert("Debes de seleccionar al menos una partida.");
				}else{
					var herramienta = new Array();
					$("input[name=hproveedor]").each(function (index) {
						if($(this).is(':checked')){
							herramienta.push($(this).val());
						}
					});
					var opcion = "proveedor";
					console.log(herramienta);
					$.ajax({
						method: "POST",
						url: "guardar.php",
						data: {"opcion": opcion, "herramienta": JSON.stringify(herramienta), "proveedor": proveedor, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
					}).done( function( info ){
						var json_info = JSON.parse( info );
						listar_partidas(refCotizacion, numeroPedido, RFC);
						mostrar_mensaje(json_info);
					});
				}
			});
		}

		var cambiarcantidadgeneral = function(refCotizacion, numeroPedido, RFC){
			$("#cambiarcantidadg").on("click", function(event){
				event.preventDefault()
				var cantidad = $("#cantidadg").val();
				if (cantidad == 0 || cantidad == "") {
					alert("Error en la cantidad.");
				}else{
					var verificar = 0;
					$("input[name=hproveedor]").each(function (index) {
						if($(this).is(':checked')){
							verificar++;
						}
					});
					if(verificar == 0){
						alert("Debes de seleccionar al menos una partida.");
					}else{
						var herramienta = new Array();
						$("input[name=hproveedor]").each(function (index) {
							if($(this).is(':checked')){
								herramienta.push($(this).val());
							}
						});
						var opcion = "cantidad";
						console.log(herramienta);
						$.ajax({
							method: "POST",
							url: "guardar.php",
							data: {"opcion": opcion, "herramienta": JSON.stringify(herramienta), "refCotizacion": refCotizacion, "numeroPedido": numeroPedido, "cantidad": cantidad},
						}).done( function( info ){
							var json_info = JSON.parse( info );
							$("#cantidadg").val("");
							listar_partidas(refCotizacion, numeroPedido, RFC);
							mostrar_mensaje(json_info);
						});
					}
				}
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

		function buscar_datos_factura(RFC, numeroPedido, refCotizacion){
			var verificar = 0;
			$("input[name=hproveedor]").each(function (index) {
				if($(this).is(':checked')){
					verificar++;
				}
			});
			if(verificar == 0){
				alert("Debes de seleccionar al menos una partida.");
			}else{
				var herramienta = new Array();
				$("input[name=hproveedor]").each(function (index) {
					if($(this).is(':checked')){
						herramienta.push($(this).val());
					}
				});
				console.log(herramienta);
				$("#modalInformacionFactura").modal("show");
				var opcion = "partidasfactura";
				var table = $("#dt_partidas_facturar").DataTable({
					"destroy":"true",
					"deferRender": true,
					"scrollX": true,
					"autoWidth": false,
					"ajax":{
						"url": "buscar.php",
						"type": "POST",
						"data": {"herramienta": JSON.stringify(herramienta), "opcion": opcion}
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
				data: {"opcion": opcion, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
			}).done( function( info ){
				console.log(info);
				$("#frmInformacionFactura #cliente").val(info.cliente.nombreEmpresa);
				$("#frmInformacionFactura #moneda").val(info.moneda);
				$("#frmInformacionFactura #tipoCambio").val(info.tipoCambio);
				$("#frmInformacionFactura #numeroOrden").val(info.pedidoCliente);
				$("#frmInformacionFactura #usoCFDI").val(info.cliente.IdUsoCFDI);
				$("#frmInformacionFactura #formaPago").val(info.cliente.IdFormaPago);
				$("#frmInformacionFactura #metodoPago").val(info.cliente.IdMetodoPago);
				$("#frmInformacionFactura #condicionesPago").val(info.cliente.CondPago);
			});
		}

		function buscar_cliente_portal(RFC, numeroPedido, refCotizacion){
			$("#generarFactura").on("click", function(){
				$("#modalInformacionFactura").modal("hide");
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
						if (data.status == 0){
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
							setTimeout(function () {
								$(".texto1").append("<div class='text-danger'><span class='modal-main-icon mdi mdi-close-circle-o'></span></div>");
								$(".texto1").append("<h3>Error!</h3>");
								$(".texto1").append("<h4>Ocurrió un problema al conectar a  portal 'Factura.com'.</h4>");
							}, 425);
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
							}, 5000);
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
							generar_factura(RFC, numeroPedido, refCotizacion, UID);
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

		var generar_factura = function(RFC, numeroPedido, refCotizacion, UID){
			var herramienta = new Array();
			$("input[name=hproveedor]").each(function (index) {
				if($(this).is(':checked')){
					herramienta.push($(this).val());
				}
			});

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
						// $(".texto1").fadeOut(300, function(){
						// 	$(this).html("");
						// 	$(this).fadeIn(300);
						// });
						// setTimeout(function () {
						// 	$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
						// 	$(".texto1").append("<h3>Correcto!</h3>");
						// 	$(".texto1").append("<h4>La factura se generó correctamente en el portal 'Factura.com'.</h4>");
						// 	$(".texto1").append("<div class='text-center'>");
						// 	$(".texto1").append("<p>En un momento se descargará el archivo PDF.</p>");
						// 	$(".texto1").append("</div>");
						// }, 500);
						var UIDFactura = data.uid;
						var UUIDFactura = data.UUID;
						guardarFactura(numeroPedido, refCotizacion, herramienta, UIDFactura, UUIDFactura);
					}
				}
			};

			var opcion = "buscarpartidasfacturar";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion, "herramienta": JSON.stringify(herramienta), "refCotizacion": refCotizacion, "numeroPedido": numeroPedido}
			}).done( function( conceptos ){
				// console.log(conceptos);
				var fecha = "<?php echo date("Y-m-d")."T".date("H:i:s"); ?>";
				var body = {
					'Receptor': {
						'UID': UID,
						'ResidenciaFiscal': '',
					},
					'TipoDocumento': $("#frmInformacionFactura #tipoDocumento").val(),
					'Conceptos': conceptos.data,
					'UsoCFDI': conceptos.cfdi,
					'Serie': '41735',
					'FormaPago': conceptos.formapago,
					'MetodoPago': conceptos.metodopago,
					'CondicionesDePago': conceptos.condpago,
					'Moneda': ($("#frmInformacionFactura #moneda").val()).toUpperCase(),
					'TipoCambio': $("#frmInformacionFactura #tipoCambio").val(),
					'NumOrder': $("#frmInformacionFactura #numeroOrden").val(),
					'FechaFromAPI': fecha,
					// 'Comentarios': 'Comentarios para agregar a la factura PDF',
					'EnviarCorreo': $("#frmInformacionFactura #enviarCorreo").val()
				};
				console.log(JSON.stringify(body));
				request.send(JSON.stringify(body));
			});
		}

		function guardarFactura(numeroPedido, refCotizacion, herramienta, UIDFactura, UUIDFactura) {
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
								data: {"opcion": opcion, "folio": folio, "ordenpedido": ordenpedido, "total": total, "status": status, "fecha": fecha, "UIDFactura": UIDFactura, "UUIDFactura": UUIDFactura, "cliente": cliente}
							}).done( function( data ){
								console.log(data);
								mostrar_mensaje(data);
							});

							quitarStock(numeroPedido, refCotizacion, herramienta, folio);
							buscardatos(refCotizacion, numeroPedido);
							descargarPDF(UID);
						}
					}
				}
			};
			request.send();
		}

		function quitarStock(numeroPedido, refCotizacion, herramienta, folio){
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion = "quitarstock", "numeroPedido": numeroPedido, "refCotizacion": refCotizacion, "folio": folio, "herramienta": JSON.stringify(herramienta)},
			}).done( function( data ){
				console.log(data);
				mostrar_mensaje(data);
			});
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

	</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
