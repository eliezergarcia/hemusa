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
		$nombreContacto = utf8_encode($row['nombreEmpresa']);
		$tipo = $row['tipo'];
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Proveedor</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
					<div class="page-head">
							<h2 class="page-head-title" style="font-size: 30px;"><b>Información de proveedor</b></h2>
							<nav aria-label="breadcrumb">
	              <ol class="breadcrumb">
	                <li class="breadcrumb-item">Compras</li>
	                <li class="breadcrumb-item"><a href="proveedores.php" class="text-primary">Proveedores</a></li>
	                <li class="breadcrumb-item active">Proveedor: <?php echo $nombreContacto; ?></li>
	              </ol>
	          	</nav>
					</div>
					<div class="main-content container-fluid">
							<div class="row full-calendar">
								<div class="col-lg-12">
										<div class="card card-fullcalendar">
												<div class="card-body">
													<!-- Menu -->
														<div class="container-fluid col-12 row justify-content-start align-items-center">
															<div>
																<span class="mdl-chip mdl-chip--contact">
																		<h2><span class="mdl-chip__text"><?php echo $nombreContacto; ?></span></h2>
																</span>
															</div>
															<div class="col dropdown row justify-content-end align-items-center">
																<button class="btn btn-lg btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<b>Menú</b> <i class="fa fa-bars" aria-hidden="true"></i></button>
																<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalEditarInformacion">Información de proveedor</button>
																	<!-- <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalCrearOC" onclick="crearoc()">Crear orden de compra</button> -->
																	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalFactoresCosto">Factores de costo</button>
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
 																						 <input class="custom-control-input" type="radio" name="filtroestado" value="sinpedido" checked=""  onclick="listar_sinpedido()"><span class="custom-control-label">Sin pedido</span>
 																					 </label>
																					 <label class="custom-control custom-radio">
																						 <input class="custom-control-input" type="radio" name="filtroestado" value="sinentregar"  onclick="listar_sinentregar()"><span class="custom-control-label">Sin entregar</span>
																					 </label>
 																				 	</div>
																					<div class="col-4">
																						<label class="custom-control custom-radio">
																							<input class="custom-control-input" type="radio" name="filtroestado" value="sinrecibido"  onclick="listar_sinrecibido()"><span class="custom-control-label">Sin recibido</span>
																						</label>
																						<label class="custom-control custom-radio">
																							<input class="custom-control-input" type="radio" name="filtroestado" value="backorder"  onclick="listar_backorder()"><span class="custom-control-label">Backorder</span>
																						</label>
						                              </div>
																					<div class="col-4">
																						<label class="custom-control custom-radio">
																							<input class="custom-control-input" type="radio" name="filtroestado" value="ordenesdecompras"  onclick="listar_ordenesdecompra()"><span class="custom-control-label">Ordenes de compras</span>
																						</label>
						                              </div>
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

															<!-- Listar sin pedido -->
																<div id="listar_sinpedido">
																	<table id="dt_listar_sinpedido" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																		<thead>
																			<tr>
																				<th>
																					<label class="custom-control custom-control-sm custom-checkbox">
							                              <input class="custom-control-input" name="selg" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
							                            </label>
																				</th>
																				<th>#</th>
																				<th>Marca</th>
																				<th>Modelo</th>
																				<th>Descripcion</th>
																				<th>Cantidad</th>
																				<th>Cliente</th>
																				<th>Costo</th>
																				<th>Fecha Pedido</th>
																				<th>Almacen</th>
																				<th>Utilidad</th>
																			</tr>
																		</thead>
																	</table>
																	<div>
																		<br>
																		<center><h3><b>Total: $ <label id="totalsinpedido" style="font-size: 25px;"><b></b></label></b></h3></center>
																	</div>
																</div>

															<!-- Listar sin recibido -->
																<div id="listar_sinrecibido">
																	<table id="dt_listar_sinrecibido" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																		<thead>
																			<tr>
																				<th>
																					<label class="custom-control custom-control-sm custom-checkbox">
							                              <input class="custom-control-input" name="selg" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
							                            </label>
																				</th>
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
																				<th></th>
																			</tr>
																		</thead>
																	</table>
																</div>

															<!-- Listar sin entregar -->
																<div id="listar_sinentregar">
																	<table id="dt_listar_sinentregar" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																		<thead>
																			<tr>
																				<th>
																					<label class="custom-control custom-control-sm custom-checkbox">
							                              <input class="custom-control-input" name="selg" type="checkbox" onclick="seleccionartodo()"><span class="custom-control-label"></span>
							                            </label>
																				</th>
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

															<!-- Listar backorder -->
																<div id="listar_backorder">
																	<table id="dt_listar_backorder" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Cliente</th>
																				<th>Marca</th>
																				<th>Modelo</th>
																				<th>Cantidad</th>
																				<th>Descripcion</th>
																				<th>Fecha pedido</th>
																				<th>Orden compra</th>
																				<th>Proveedor</th>
																				<th>Fecha enviado</th>
																			</tr>
																		</thead>
																	</table>
																</div>

															<!-- Listar ordenes de compra -->
																<div id="listar_ordenesdecompra">
																	<table id="dt_listar_ordenesdecompra" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Orden</th>
																				<th>Proveedor</th>
																				<th>Contacto</th>
																				<th>Fecha</th>
																				<th>Moneda</th>
																				<th>Ver</th>
																		</thead>
																	</table>
																</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>

		<!-- Modal Editar Información -->
			<form action="#" method="POST">
				<input type="hidden" id="opcion" name="opcion" value="editarinformacion">
				<input type="hidden" id="idproveedor" name="idproveedor">
				<div class="modal fade" id="modalEditarInformacion" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCotizacionLabel">
					<div class="modal-dialog colored-header colored-header-primary" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="modalNuevaCotizacionLabel">Información de proveedor</h4>
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
										<label for="formapago" class="col-4">Forma de Pago</label>
										<select type="text" id="formapago" name="formapago" class="limpiar form-control form-control-sm col-7">
											<option value="0">Ninguno</option>
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
											<option value="0">Ninguno</option>
											<option value="1">Pago en una sola exhibición</option>
											<option value="2">Pago en parcialidades o diferido</option>
										</select>
									</div>
									<div class="row form-group">
										<label for="cfdi" class="col-4">Uso de CFDI</label>
										<select type="text" id="cfdi" name="cfdi" class="limpiar form-control form-control-sm col-7">
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
							<div class="modal-footer invoice-footer">
								<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-lg btn-primary">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		<!-- Modal Crear OC -->
			<div class="modal fade" id="modalCrearOC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog colored-header colored-header-success" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h4 class="modal-title" id="exampleModalLabel">Nueva orden de compra</h4>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<form action="#" method="POST">
			        			<input type="hidden" id="idproveedor" name="idproveedor" value="<?php echo $_REQUEST['id']; ?>">
			        			<input type="hidden" id="opcion" name="opcion" value="crearordencompra">
										<div class="row">
                      <div class="form-group col">
                        <label for="saludo">Saludo</label>
                        <textarea name="saludo" id="saludo" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
										<div class="row">
                      <div class="form-group col">
                        <label for="direccionenvio">Envia a</label>
                        <select name="direccionenvio" id="direccionenvio" class="form-control form-control-sm select2" onchange="agregardireccion()"></select>
                      </div>
                    </div>
										<div class="row">
                      <div class="form-group col">
                        <textarea name="otra" id="otra" cols="30" rows="3" class="form-control form-control-sm" disabled></textarea>
                      </div>
                    </div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        		<button type="submit" class="btn btn-lg btn-success">Hecho</button>
			        		</form>
			      		</div>
			    	</div>
			  	</div>
			</div>

		<!-- Modal OC Pendientes -->
			<div class="modal fade" id="modalOCPendientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog colored-header colored-header-primary" role="document">
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

		<!-- Modal Factores Costo -->
			<div class="modal fade" id="modalFactoresCosto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog  colored-header colored-header-primary" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel"><b>Factores de costo</b></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table id="dt_factores_costo" class="table table-hover table-striped display compact" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Factor</th>
										<th></th>
										<th></th>
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

			<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-header">
							<div class="modal-content">
            </div>
            <div class="modal-body">
              <div class="text-center">
                <div class="texto1">
                  <br><br>
                  <h3>Espere un momento...</h3>
                  <h4>La orden de compra se esta generando</h4>
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

	</div>
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
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		listar_sinpedido();
		guardar();
	});

	function nav_active () {
		$(".nav-item").removeClass("open section-active");
		$("#compras-menu").addClass("open section-active");

		$(".nav-link").removeClass("active");
		$("#proveedores-menu").addClass("active");
	}

	function seleccionartodo(){
		$("input[name=enviado]").each(function (index) {
			if($("input[name=selenviado]").is(':checked')){
				$('input[name=enviado]').prop('checked' , true);
			}else{
				$('input[name=enviado]').prop('checked' , false);
			}
		});

		$("input[name=recibido]").each(function (index) {
			if($("input[name=selrecibido]").is(':checked')){
				$('input[name=recibido]').prop('checked' , true);
			}else{
				$('input[name=recibido]').prop('checked' , false);
			}
		});

		$("input[name=sel]").each(function (index) {
			if($("input[name=selg]").is(':checked')){
				$('input[name=sel]').prop('checked' , true);
			}else{
				$('input[name=sel]').prop('checked' , false);
			}
		});

		$("input[name=hsinpedido]").each(function (index) {
			if($("input[name=selg]").is(':checked')){
				$('input[name=hsinpedido]').prop('checked' , true);
			}else{
				$('input[name=hsinpedido]').prop('checked' , false);
			}
		});
	}

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

	var agregardireccion = function(){
		if ($("select[name=direccionenvio]").val() == "Otra"){
			document.getElementById('otra').disabled = false;
		}else{
			document.getElementById('otra').disabled = true;
		}
	}

	var listar_sinpedido = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideDown("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_backorder").slideUp("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinpedido";
		var buscar = $("#buscar").val();
		console.log(buscar);
		console.log(idproveedor);
		var table = $("#dt_listar_sinpedido").DataTable({
	    "destroy": true,
			"scrollX": true,
			"autoWidth": false,
      "ajax":{
        "method":"POST",
        "url":"listar.php" ,
        "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
      },
      "columns":[
				{"data": null,
					"render": function (data) {
						return "<label class='custom-control custom-control-sm custom-checkbox'><input name='hsinpedido' value='"+data.id+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
					},
				},
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
        // {"defaultContent": "<div class='invoice-footer'><button class='quitar btn btn-lg btn-danger'><i class='fas fa-times fa-sm' aria-hidden='true'></i></button></div>"}
      ],
      "language": idioma_espanol,
			"dom":
				"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
				"<'row be-datatable-body'<'col-sm-12'tr>>" +
				"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
			"columnDefs": [
        { "width": "3%", "orderable": false, "targets": 0 },
        { "width": "2%", "orderable": false, "targets": 1 },
        { "width": "8%", "targets": 2 },
        { "width": "8%", "targets": 3 },
				{ "width": "7%", "targets": 5 },
				{ "width": "7%", "targets": 7 },
				{ "width": "10%", "targets": 8 },
				{ "width": "6%", "targets": 9 },
        { "width": "6%", "targets": 10 },
      ],
			"paging": false,
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
									columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
								}
							},
							{
								extend: 'csv',
								text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
								// "className": "btn btn-lg btn-space btn-secondary",
								exportOptions: {
												columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
								}
							},
							{
								extend:    'pdfHtml5',
								text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
								download: 'open',
								// "className": "btn btn-lg btn-space btn-secondary",
								exportOptions: {
									columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
								}
							},
							{
								extend: 'print',
								text: '<i class="fas fa-print fa-lg"></i> Imprimir',
								header: 'false',
								exportOptions: {
												columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
								},
								orientation: 'landscape',
								pageSize: 'LEGAL'
							}
					]
				},
					{
						 text: '<i class="fas fa-times" aria-hidden="true"></i> Quitar',
						 "className": "btn btn-lg btn-danger btn-space",
							action: function ( e, dt, node, config ) {
								var verificar = 0;
								$("input[name=hsinpedido]").each(function (index) {
									if($(this).is(':checked')){
										verificar++;
									}
								});
							if(verificar == 0){
								alert("Debes de seleccionar al menos una partida!");
							}else{
								var herramienta = new Array();
								var numeroPartidas = 0;
								$("input[name=hsinpedido]").each(function (index) {
									if($(this).is(':checked')){
										herramienta.push($(this).val());
										numeroPartidas++;
									}
								});
								var opcion = "quitarproveedor";
								console.log(herramienta);
								$.ajax({
									method: "POST",
									url: "guardar.php",
									dataType: "json",
									data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
								}).done( function( data ){
									console.log(data);
									mostrar_mensaje(data);
									$("#dt_listar_sinpedido").DataTable().ajax.reload();
									obtener_total(idproveedor);
								});
							}
						}
					},
          {
          	text: '<i class="fa fa-cart-plus fa-sm" aria-hidden="true"></i> Orden de compra',
          	"className": "btn btn-success btn-lg btn-space",
          	action: function (e, dt, node, config){
  					$("#modalCrearOC").modal("show");
  					crear_orden_compra();
					}
		     }
				]
	    });

	  obtener_id_quitar("#dt_listar_sinpedido tbody", table, idproveedor);
		obtener_total(idproveedor);
	}

	var crear_orden_compra = function (){
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
		$("#listar_backorder").slideUp("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinrecibido";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_sinrecibido").DataTable({
      "destroy": true,
			"scrollX": true,
			"autoWidth": false,
      "ajax":{
        "method":"POST",
        "url":"listar.php" ,
        "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
      },
      "columns":[
				// {"data": "check", "sortable": false},
				{"data": null,
					"render": function (data) {
						return "<label class='custom-control custom-control-sm custom-checkbox'><input name='sel' value='"+data.id+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
					},
				},
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
        {"data": "costo"},
				{"data": "cantidad", "sortable": false,
					"render": function(cantidad){
						if(cantidad > 1){
							return "<div class='invoice-footer'><button class='splitSinrecibido btn btn-lg btn-primary'  data-toggle='modal' data-target='#modalSplitSinRecibido'>Split</button></div>";
						}else{
							return "";
						}
					}
				}
      ],
			"columnDefs": [
				{ "orderable": false, "targets": 0 },
				{ "orderable": false, "targets": 1 },
				{ "width": "8%", "targets": 2 },
				{ "width": "8%", "targets": 3 },
				{ "width": "7%", "targets": 4 },
				{ "width": "9%", "targets": 5 },
				{ "width": "7%", "targets": 6 },
				{ "width": "7%", "targets": 9 },
				{ "width": "9%", "targets": 10 },
				{ "width": "7%", "targets": 11 },
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
										columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend: 'csv',
									text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend:    'pdfHtml5',
									text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
									download: 'open',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
										columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend: 'print',
									text: '<i class="fas fa-print fa-lg"></i> Imprimir',
									header: 'false',
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									},
									orientation: 'landscape',
									pageSize: 'LEGAL'
								}
						]
					},
					{
		         text: '<i class="fas fa-check fa-sm" aria-hidden="true"></i> Enviado',
						 key: {
                 shiftKey: true,
                 key: 'e'
             },
		         "className": "btn btn-lg btn-primary btn-space",
		          action: function ( e, dt, node, config ) {
		          	var verificar = 0;
								$("input[name=sel]").each(function (index) {
									if($(this).is(':checked')){
										verificar++;
									}
								});
							if(verificar == 0){
								alert("Debes de seleccionar al menos una partida!");
							}else{
								var herramienta = new Array();
								var numeroPartidas = 0;
								$("input[name=sel]").each(function (index) {
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
									$("#dt_listar_sinrecibido").DataTable().ajax.reload();
								});
		                	}
						}
					},
						{
		                text: '<i class="fas fa-check fa-sm" aria-hidden="true"></i> Recibido',
										key: {
			                  shiftKey: true,
			                  key: 'r'
			              },
		                "className": "btn btn-lg btn-primary btn-space",
		                action: function ( e, dt, node, config ) {
		                	var verificar = 0;
							$("input[name=sel]").each(function (index) {
								if($(this).is(':checked')){
									verificar++;
								}
							});
							if(verificar == 0){
								alert("Debes de seleccionar al menos una partida!");
							}else{
								var herramienta = new Array();
								var numeroPartidas = 0;
								$("input[name=sel]").each(function (index) {
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
									$("#dt_listar_sinrecibido").DataTable().ajax.reload();
								});
		                	}
		                }
		            },
								{
					         text: '<i class="fas fa-times fa-sm" aria-hidden="true"></i> Enviado',
					         "className": "btn btn-lg btn-danger btn-space",
					          action: function ( e, dt, node, config ) {
					          	var verificar = 0;
											$("input[name=sel]").each(function (index) {
												if($(this).is(':checked')){
													verificar++;
												}
											});
										if(verificar == 0){
											alert("Debes de seleccionar al menos una partida!");
										}else{
											var herramienta = new Array();
											var numeroPartidas = 0;
											$("input[name=sel]").each(function (index) {
												if($(this).is(':checked')){
													herramienta.push($(this).val());
													numeroPartidas++;
												}
											});
											var opcion = "herramientaquitarenviado";
											console.log(herramienta);
											$.ajax({
												method: "POST",
												url: "guardar.php",
												dataType: "json",
												data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
											}).done( function( data ){
												console.log(data);
												mostrar_mensaje(data);
												$("#dt_listar_sinrecibido").DataTable().ajax.reload();
											});
					                	}
									}
								}
				]
	    });

	    split_sin_recibido("#dt_listar_sinrecibido tbody", table);
	}

	var listar_sinentregar = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideDown("slow");
		$("#listar_backorder").slideUp("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "sinentregar";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_sinentregar").DataTable({
      "destroy": true,
			"autoWidth": false,
      "ajax":{
        "method":"POST",
        "url":"listar.php" ,
        "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
      },
      "columns":[
				// {"data": "check", "sortable": false},
				{"data": null,
					"render": function (data) {
						return "<label class='custom-control custom-control-sm custom-checkbox'><input name='sel' value='"+data.id+"' class='custom-control-input' type='checkbox'><span class='custom-control-label'></span></label>";
					},
				},
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
				{ "orderable": false, "targets": 0 },
				{ "orderable": false, "targets": 1 },
				{ "width": "8%", "targets": 2 },
				{ "width": "8%", "targets": 3 },
				{ "width": "7%", "targets": 4 },
				{ "width": "9%", "targets": 5 },
				{ "width": "7%", "targets": 6 },
				{ "width": "7%", "targets": 9 },
				{ "width": "9%", "targets": 10 },
				{ "width": "6%", "targets": 11 },
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
										columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend: 'csv',
									text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend:    'pdfHtml5',
									text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
									download: 'open',
									// "className": "btn btn-lg btn-space btn-secondary",
									exportOptions: {
										columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									}
								},
								{
									extend: 'print',
									text: '<i class="fas fa-print fa-lg"></i> Imprimir',
									header: 'false',
									exportOptions: {
													columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
									},
									orientation: 'landscape',
									pageSize: 'LEGAL'
								}
						]
				},
				{
								text: '<i class="fas fa-times fa-sm" aria-hidden="true"></i> Recibido',
								"className": "btn btn-lg btn-danger btn-space",
								action: function ( e, dt, node, config ) {
									var verificar = 0;
					$("input[name=sel]").each(function (index) {
						if($(this).is(':checked')){
							verificar++;
						}
					});
					if(verificar == 0){
						alert("Debes de seleccionar al menos una partida!");
					}else{
						var herramienta = new Array();
						var numeroPartidas = 0;
						$("input[name=sel]").each(function (index) {
							if($(this).is(':checked')){
								herramienta.push($(this).val());
								numeroPartidas++;
							}
						});
						var opcion = "herramientaquitarrecibido";
						console.log(herramienta);
						$.ajax({
							method: "POST",
							url: "guardar.php",
							dataType: "json",
							data: {"herramienta": JSON.stringify(herramienta), "opcion": opcion},
						}).done( function( data ){
							console.log(data);
							mostrar_mensaje(data);
							$("#dt_listar_sinentregar").DataTable().ajax.reload();
						});
									}
								}
						},
				]
	    });

	    // obtener_id_quitar("#dt_listar_sinpedido tbody", table, idproveedor);
	}

	var listar_backorder = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_backorder").slideDown("slow");
		$("#listar_ordenesdecompra").slideUp("slow");
		var opcion = "backorder";
		var buscar = $("#buscar").val();
		console.log(idproveedor);
		var table = $("#dt_listar_backorder").DataTable({
      "destroy": true,
			"autoWidth": false,
      "ajax":{
        "method":"POST",
        "url":"listar.php" ,
        "data": {"idproveedor": idproveedor, "opcion": opcion, "buscar": buscar},
      },
      "columns":[
			  {"data": "indice"},
			  {"data": "cliente"},
			  {"data": "marca"},
	      {"data": "modelo"},
			  {"data": "cantidad"},
        {"data": "descripcion"},
        {"data": "fechapedido"},
        {"data": "ordencompra"},
        {"data": "proveedor"},
        {"data": "fechaenviado"}
	    ],
			"columnDefs": [
				{ "width": "3%", "orderable": false, "targets": 0 },
				{ "width": "8%", "targets": 2 },
				{ "width": "8%", "targets": 3 },
				{ "width": "6%", "targets": 4 },
				{ "width": "8%", "targets": 6 },
				{ "width": "9%", "targets": 7 },
				{ "width": "9%", "targets": 9 },
			],
			"paging": false,
      "language": idioma_espanol,
			"dom":
				"<'row be-datatable-header'<'col-sm-6'><'col-sm-6 text-right'f>>" +
				"<'row be-datatable-body'<'col-sm-12'tr>>" +
				"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
	    });
	}

	var listar_ordenesdecompra = function(){
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		$("#listar_sinpedido").slideUp("slow");
		$("#listar_sinrecibido").slideUp("slow");
		$("#listar_sinentregar").slideUp("slow");
		$("#listar_backorder").slideUp("slow");
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
				{"data": "moneda"},
			  {"defaultContent": "<div class='invoice-footer'><button class='verordencompra btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
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
									 columns: [ 0, 1, 2, 3, 4, 5 ]
								 }
							 },
							 {
								 extend: 'csv',
								 text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
								 // "className": "btn btn-lg btn-space btn-secondary",
								 exportOptions: {
												 columns: [ 0, 1, 2, 3, 4, 5 ]
								 }
							 },
							 {
								 extend:    'pdfHtml5',
								 text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
								 download: 'open',
								 // "className": "btn btn-lg btn-space btn-secondary",
								 exportOptions: {
									 columns: [ 0, 1, 2, 3, 4, 5 ]
								 }
							 },
							 {
								 extend: 'print',
								 text: '<i class="fas fa-print fa-lg"></i> Imprimir',
								 header: 'false',
								 exportOptions: {
												 columns: [ 0, 1, 2, 3, 4, 5 ]
								 },
								 orientation: 'landscape',
								 pageSize: 'LEGAL'
							 }
					 ]
			 	},
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

	$('#modalFactoresCosto').on('show.bs.modal', function (e) {
		var opcion = "factorescosto";
		var idproveedor = "<?php echo $_REQUEST['id']; ?>";
		var table = $("#dt_factores_costo").DataTable({
			"destroy":"true",
			"deferRender": true,
			"scrollX": true,
			"ajax":{
				"url": "buscar.php",
				"type": "POST",
				"data": {"idproveedor": idproveedor,"opcion": opcion}
			},
			"columns":[
				{"data": "indice"},
				{"data": "factor"},
				{"defaultContent": "<div class='invoice-footer'><button type='button' class='editarcosto btn btn-lg btn-primary'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"},
				{"defaultContent": "<div class='invoice-footer'><button type='button' class='eliminarcosto btn btn-lg btn-danger'><i class='fas fa-times fa-sm' aria-hidden='true'></i></button></div>"}
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
						agregar_costo(idproveedor);
					}
				}
			]
		});
		obtener_data_editar_costo("#dt_factores_costo tbody", table, idproveedor);
		obtener_data_eliminar_costo("#dt_factores_costo tbody", table, idproveedor);
	})

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
			$("#formapago").val(data.contacto.IdFormaPago).change();
			$("#metodopago").val(data.contacto.IdMetodoPago).change();
			$("#cfdi").val(data.contacto.IdUsoCFDI).change();
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
				dataType: "json",
				data: frm,
			}).done( function( info ){
				if(info.respuesta != 'agregarordencompra'){
					mostrar_mensaje(info);
				}else{
					$("#mod-success").modal("show");
					if (info.respuesta == "agregarordencompra") {
						setTimeout(function () {
							$(".texto1").fadeOut(300, function(){
								$(this).html("");
								$(this).fadeIn(300);
							});
						}, 2000);
						setTimeout(function () {
							$(".texto1").append("<div class='text-success'><span class='modal-main-icon mdi mdi-check-circle'></span></div>");
							$(".texto1").append("<h3>Correcto!</h3>");
							$(".texto1").append("<h4>La orden de compra se generó correctamente.</h4>");
							$(".texto1").append("<div class='text-center'>");
							$(".texto1").append("<p>Esperé un momento será redireccionado...</p>");
							$(".texto1").append("</div>");
						}, 2500);
						setTimeout(function () {
							window.location.href = "../ordenesdecompras/verOrdenCompra.php?ordenCompra="+info.ordencompra;
						}, 4000);
					}else{
						setTimeout(function () {
							$("#mod-success").modal("hide");
							mostrar_mensaje(info);
						}, 2000);
					}
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
						$("#dt_listar_sinpedido").DataTable().ajax.reload();
						obtener_total(idproveedor);
					}
				});
			}else{

			}
		});
	}

	var split_sin_recibido = function(tbody, table){
		$(tbody).on("click", "button.splitSinrecibido", function(){
			var data = table.row( $(this).parents("tr") ).data();
			var idherramienta = data.id;
			var opcion = "splitsinrecibido";
			var cantidadsplit = prompt("Ingresa la cantidad del split: ");
			if (cantidadsplit < 1) {
				alert("Error en la cantidad del split");
			}else{
				$.ajax({
					method: "POST",
					url: "guardar.php",
					dataType: "json",
					data: {"opcion": opcion, "idherramienta": idherramienta, "cantidadsplit": cantidadsplit},
				}).done( function( info ){
					mostrar_mensaje(info);
					$("#dt_listar_sinrecibido").DataTable().ajax.reload();
				});
			}
		});
	}

	var agregar_costo = function(idproveedor){
		var factor = prompt("Ingresa el factor de costo: ");
		if (factor == null || factor == "") {
			alert("Error en el factor de costo.");
		} else {
			var opcion = "agregarcosto";
			$.ajax({
				method: "POST",
				url: "guardar.php",
				data: {"opcion": opcion, "factor": factor, "idproveedor": idproveedor},
				success: function (data) {
					var json_info = JSON.parse( data );
					mostrar_mensaje(json_info);
					$("#dt_listar_sinpedido").DataTable().ajax.reload();
					$("#dt_factores_costo").DataTable().ajax.reload();
					obtener_total(idproveedor);
				}
			});
		}
	}

	var obtener_data_eliminar_costo = function(tbody, table, idproveedor){
		$(tbody).on("click", "button.eliminarcosto", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			if (confirm("Esta seguro(a) de eliminar el factor?")){
				var id = data.id;
				var opcion = "eliminarcosto";
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "id": id},
					success: function (data) {
						var json_info = JSON.parse( data );
						mostrar_mensaje(json_info);
						$("#dt_listar_sinpedido").DataTable().ajax.reload();
						$("#dt_factores_costo").DataTable().ajax.reload();
						obtener_total(idproveedor);
					}
				});
			}else{

			}
		});
	}

	var obtener_data_editar_costo = function(tbody, table, idproveedor){
		$(tbody).on("click", "button.editarcosto", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			var idfactor = data.id;
			var factor = data.factor;
			var factornuevo = prompt("Ingresa el factor de costo: ", factor);
			if (factornuevo == null || factornuevo == "") {
				alert("Error en el factor de costo.");
			} else {
				var opcion = "editarcosto";
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: {"opcion": opcion, "factor": factornuevo, "idfactor": idfactor},
					success: function (data) {
						var json_info = JSON.parse( data );
						mostrar_mensaje(json_info);
						$("#dt_listar_sinpedido").DataTable().ajax.reload();
						$("#dt_factores_costo").DataTable().ajax.reload();
						obtener_total(idproveedor);
					}
				});
			}
		});
	}

</script>
	<script src="<?php echo $ruta; ?>/php/js/idioma_espanol.js"></script>
	<script src="<?php echo $ruta; ?>/php/js/mensajes_cambios.js"></script>
</body>
</html>
