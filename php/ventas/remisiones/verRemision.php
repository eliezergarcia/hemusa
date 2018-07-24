<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);

	$resultado = mysqli_query($conexion_usuarios, "SELECT cliente FROM remisiones WHERE remision='".$_REQUEST['remision']."' AND cliente!=0");
	while($data = mysqli_fetch_array($resultado)){
		$idcliente = $data['cliente'];
	}
	if (mysqli_num_rows($resultado) < 1) {
		$resultado = mysqli_query($conexion_usuarios, "SELECT cliente FROM cotizacion WHERE remision='".$_REQUEST['remision']."'");
		while($data = mysqli_fetch_array($resultado)){
			$idcliente = $data['cliente'];
		}
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
	<title>Remisión</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
      <div class="page-head">
        <h2 class="page-head-title" style="font-size: 30px;"><b>Remisión</b></h2>
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
													<div class="form-group">
														<h4 class="card-subtitle mb-2 text-muted">Cliente</h4>
														<h5 style="font-size: 17px;"><?php echo $nombrecliente; ?></h5>
													</div>
													<div class="form-group">
														<h4 class="card-subtitle mb-2 text-muted">RFC</h4>
														<h5 style="font-size: 17px;"><?php echo $rfc; ?></h5>
													</div>
													<div class="form-group">
														<h4 class="card-subtitle mb-2 text-muted">Calle, colonia</h4>
														<h5 style="font-size: 17px;"><?php echo $calle.", ".$colonia; ?></h5>
													</div>
													<div class="form-group">
														<h4 class="card-subtitle mb-2 text-muted">Ciudad, estado, c.p.</h4>
														<h5 style="font-size: 17px;"><?php echo $ciudad.", ".$estado.", ".$cp; ?></h5><br><br>
													</div>
												</div>
											</div>
											<div class="col row justify-content-start">
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Referencia cotización</h4>
													<label id="refCotizacion"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Fecha</h4>
													<label id="fecha"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Vendedor</h4>
													<label id="vendedor"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Remisión</h4>
													<label id="remision"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Facturas</h4>
													<label id="factura"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Pagado</h4>
													<label id="pagado"></label>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Moneda <a id="cambiarmoneda" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<select id="moneda" class="form-control form-control-sm col-10">
														<option value="usd" selected>USD</option>
														<option value="mxn">MXN</option>
													</select>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Paquetería <a id="cambiarpaqueteria" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<select id="paqueteria" class="form-control form-control-sm col-10">
													</select>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">No. guía</h4>
													<div class="input-group mb-3">
														<input type="text" id="numeroGuia" class="form-control form-control-sm col-9">
														<div class="input-group-append">
															<button id="cambiarng" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
														</div>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Forma de pago <a id="cambiarformapago" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
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
													<h4 class="card-subtitle mb-2 text-muted">Método de pago <a id="cambiarmetodopago" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<div>
														<select type="text" id="metodopago" name="metodopago" class="form-control form-control-sm col-10">
															<option value="1">Pago en una sola exhibición</option>
															<option value="2">Pago en parcialidades o diferido</option>
														</select>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Uso de CFDI <a id="cambiarusocfdi" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
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
												<!-- <div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Proveedor <a id="cambiarproveedor" href="#" class="text-primary"><i class="fas fa-sync"></i></a></h4>
													<div>
														<select name="proveedorg" id="proveedorg" class="form-control form-control-sm col-10"></select>
													</div>
												</div>
												<div class="col-3 form-group">
													<h4 class="card-subtitle mb-2 text-muted">Cantidad</h4>
													<div class="input-group mb-3">
														<input type="text" id="cantidadg" class="form-control form-control-sm col-9">
														<div class="input-group-append">
															<button id="cambiarcantidadg" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></button>
														</div>
													</div>
												</div> -->
											</div>
										</div>
										<hr>
				    			<!-- Tabla de partidas -->
				    				<br><br><br>
				    				<table id="dt_pedido" class="table table-striped table-hover table-fw-widget" width="100%">
											<thead>
												<tr>
													<th>
														<label class="custom-control custom-control-sm custom-checkbox">
                              <input class="custom-control-input" name="selprovg" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
                            </label>
													</th>
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
													<th>Factura</th>
													<th>Folio</th>
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
				      			<label for="descripcion" class="control-label col-4">Descripción</label>
				      			<input type="text" class="form-control form-control-sm col-7" name="descripcion" id="descripcion">
				      		</div>
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
									<th>
										<label class="custom-control custom-control-sm custom-checkbox">
											<input class="custom-control-input" name="sel" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
										</label>
									</th>
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

	<!-- Modal Agregar Herramienta a Remision -->
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
										<th>Moneda</th>
										<th>
											<label class="custom-control custom-control-sm custom-checkbox">
												<input class="custom-control-input" name="sel" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
											</label>
										</th>
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
													<option value="factura/pagoanticipado">Factura/Pago anticipado</option>
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
												<label for="cuenta">Cuenta <font color="#FF4136">*</font></label>
												<!-- <input type="text" id="cuenta" name="cuenta" class="form-control form-control-sm" disabled required> -->
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
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
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

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#facturacion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#remisiones-menu").addClass("active");
    }

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
					document.getElementById("remision").innerHTML = data.remision;
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

					// request.setRequestHeader('Access-Control-Allow-Origin', '*');
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
						{"data": "id",
							"render": function (data) {
								return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hproveedor' value='"+data+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
							},
						},
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
						{"data": "factura"},
						{"data": "folio"},
						{"defaultContent": "<div class='invoice-footer'><button type='button' class='editar btn btn-lg btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
					],
					"columnDefs": [
						{ "width": "2%", "targets": 0 },
						{ "width": "2%", "targets": 1 },
						{ "width": "7%", "targets": 2 },
						{ "width": "7%", "targets": 3 },
						{ "visible": false, "targets": 5 },
						{ "width": "8%", "targets": 6 },
						{ "width": "5%", "targets": 7 },
						{ "width": "8%", "targets": 8 },
						{ "visible": false, "targets": 9 },
						{ "visible": false, "targets": 10 },
						{ "width": "15%", "targets": 11 },
						{ "width": "2%", "targets": 12 },
						// { "width": "2%", "targets": 13 },
						{ "width": "5%", "targets": 13 },
						{ "visible": false,  "targets": 14 },
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
						{
							extend: 'colvis',
							columns: ':not(.noVis)',
							text: '<i class="fas fa-columns fa-sm"></i> Columnas',
							"className": "btn btn-lg btn-space btn-secondary",
						},
						{
							extend: 'collection',
							text: '<i class="fas fa-file fa-sm"></i> Exportar remisión',
							"className": "btn btn-lg btn-space btn-secondary",
							buttons: [
								{
									text: '<i class="fas fa-file-pdf fa-lg"></i> PDF',
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
							text: '<i class="fas fa-list fa-sm" aria-hidden="true"></i> Lista de embarque',
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
							text: '<i class="fas fa-wrench fa-sm" aria-hidden="true"></i> Quitar',
							"className": "btn btn-lg btn-space btn-danger",
							action: function ( e, dt, node, config ) {
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
									var opcion = "quitarherramienta";
									console.log(herramienta);
									$.ajax({
										method: "POST",
										url: "guardar.php",
										dataType: "json",
										data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion, "remision": remision},
									}).done( function( data ){
										console.log(data);
										mostrar_mensaje(data);
										buscardatos(remision);
									});
								}
							}
						},
						{
							text: '<i class="fas fa-file-alt fa-sm" aria-hidden="true"></i> Generar factura',
							"className": "btn btn-lg btn-space btn-primary",
							action: function ( e, dt, node, config ) {
								buscar_datos_factura(RFC, remision);
							}
						}
					]
				});

			proveedores();
			obtener_data_editar("#dt_pedido tbody", table);
			obtener_data_quitar("#dt_pedido tbody", table, remision);
			buscar_cliente_portal(RFC, remision);
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
					{"data": null,
						"render": function (data, row) {
							return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hpacking' value='"+data.id+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
						},
					},
				],
				"order": false,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "ordering": false,
        "language": idioma_espanol,
        "dom":
  				"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
  				"<'row be-datatable-body'<'col-sm-12'tr>>"
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
							{title: "MONEDA", dataKey: "moneda"},
	        ];

	        var rowstotales = data.totales;
	        var imgLogo = 'data:image/jpeg;base64,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';
				var pagadoLogo = 'data:image/jpeg;base64,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';
	      var doc = new jsPDF('p', 'pt', 'a4');
				doc.setLineWidth(1)
				doc.setDrawColor(0,0,0);
        doc.line(20, 28, 575, 28)
        doc.addImage(imgLogo, 'JPEG', 20, 30, 150, 58);
				if (data.cotizacion.IdFormaPago == 1) {
					doc.addImage(pagadoLogo, 'JPEG', 395, 200, 150, 58);
				}
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
				doc.text("FOLIO N° "+data.cotizacion.remision, 255, 126);
				doc.setFontSize(10);
				doc.setFontStyle('bold');
				// doc.text("Folio:", 385, 135);
				doc.text("Fecha:", 385, 150);
				doc.text("Hecho por:", 385, 165);
				doc.setFontStyle('normal');
				doc.text(data.cotizacion.fecha, 475, 150);
				if(data.cotizacion.vendedor == ''){
					doc.text(data.cotizacion.contacto, 475, 165);
				}else{
					doc.text(data.cotizacion.vendedor, 475, 165);
				}
				doc.setFontSize(10);
				doc.setFontStyle('bold');
				doc.text("Cliente", 20, 150);
				doc.text("Cond. de pago:", 385, 180);
				doc.setFontSize(10);
				doc.setFontStyle('normal');
				doc.text(data.cliente.nombreEmpresa, 20, 165);
				if (data.cliente.CondPago == 0) {
					doc.text("Contado", 475, 180);
				}else{
					doc.text(data.cliente.CondPago + " días", 475, 180);
				}
				doc.text(data.cliente.RFC, 20, 180);
				doc.setFontStyle('bold');
				doc.setFontSize(10);
				doc.text("Contacto", 20, 235);
				doc.setFontSize(10);
				doc.setFontStyle('normal');
				doc.text(data.cotizacion.contacto, 20, 250);
				doc.text(data.cliente.calle + ", " + data.cliente.colonia, 20, 195);
				doc.text(data.cliente.ciudad + ", " + data.cliente.estado + ", C.P." + data.cliente.cp, 20, 210);

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
	    doc.text("Recibí de conformidad:", 350, 730);
			doc.text("Surtido por:", 130, 730);
			doc.setFontStyle('normal');
			doc.setFontSize(9);
	    doc.text("Nombre:", 130, 760);
			// doc.text("Firma:", 350, doc.autoTable.previous.finalY  + 90);
			if(data.cotizacion.vendedor == ""){
				doc.text(data.cotizacion.contacto, 170, 760);
			}else{
				doc.text(data.cotizacion.vendedor, 170, 760);
			}
	    doc.setFontStyle('bold');
			doc.setFontStyle('normal');
	    // doc.text("Nombre:", 130, doc.autoTable.previous.finalY  + 70);
			doc.text("Firma:", 350, 760);
			doc.setLineWidth(1)
			doc.setDrawColor(0,0,0);
			doc.setFontStyle('normal');
			doc.line(20, 785, 575, 785)
			doc.setFontSize(11);
			doc.text("¿Necesitas Herramienta? ¡Llámanos!", 200, 815);
			if (opcionPDF == "imprimir") {
				doc.autoPrint();
			}
      doc.save('remision_'+remision+'.pdf');

      });
    }

		$('#modalAgregarHerramienta').on('show.bs.modal', function (e) {
			var idcontacto = "<?php echo $idcliente; ?>";
			var opcion = "agregarherramienta";
			var monedaremision = $("#moneda").val();
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
					{"data": "moneda"},
					{"data": null,
						"render": function (data, type, row) {
							if (data.moneda == "" || monedaremision != data.moneda) {
								return "";
							}else{
								return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hremision' value='"+data.id+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
							}
						},
					}
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
      				"<'row be-datatable-body'<'col-sm-12'tr>>",
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

			$("input[name=hproveedor]").each(function (index) {
				if($("input[name=selprovg]").is(':checked')){
					$('input[name=hproveedor]').prop('checked' , true);
				}else{
					$('input[name=hproveedor]').prop('checked' , false);
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
						buscardatos(remision);
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
				$("#frmEditar #descripcion").val(data.descripcion);
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

		function buscar_datos_factura(RFC, remision){
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
				data: {"opcion": opcion, "remision": remision},
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
				$("#frmInformacionFactura #cuenta").val(info.cuenta);
			});
		}

		function buscar_cliente_portal(RFC, remision){
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
							generar_factura(RFC, remision, UID);
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

		var generar_factura = function(RFC, remision, UID){
			var herramienta = new Array();
			$("input[name=hproveedor]").each(function (index) {
				if($(this).is(':checked')){
					herramienta.push($(this).val());
				}
			});
			console.log(herramienta);
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
							guardarFactura(remision, herramienta, tipoDocumento, moneda, UIDFactura, UUIDFactura);
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
				data: {"opcion": opcion, "herramienta": JSON.stringify(herramienta), "remision": remision}
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

		function guardarFactura(remision, herramienta, tipoDocumento, moneda, UIDFactura, UUIDFactura) {
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
							// var ordenpedido = data.data[i].NumOrder;
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
								data: {"opcion": opcion, "folio": folio, "remision": remision, "total": total, "status": status, "fecha": fecha, "tipoDocumento": tipoDocumento, "moneda": moneda, "UIDFactura": UIDFactura, "UUIDFactura": UUIDFactura, "cliente": cliente}
							}).done( function( data ){
								console.log(data);
								mostrar_mensaje(data);
							});

							quitarStock(remision, herramienta, folio, tipoDocumento);
							buscardatos(remision);
							descargarPDF(UID, folio);
						}
					}
				}
			};
			request.send();
		}

		function quitarStock(remision, herramienta, folio, tipoDocumento){
			console.log(folio);
			$.ajax({
				method: "POST",
				url: "guardar.php",
				dataType: "json",
				data: {"opcion": opcion = "quitarstock", "remision": remision, "folio": folio, "herramienta": JSON.stringify(herramienta), "tipoDocumento": tipoDocumento},
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
