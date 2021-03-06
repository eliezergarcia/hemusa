<?php 
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexi�n con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesi�n inciada
	error_reporting(0);
	$resultado = mysqli_query($conexion_usuarios, "SELECT cliente FROM cotizacion WHERE ref='".$_REQUEST['refCotizacion']."'");
	while($data = mysqli_fetch_array($resultado)){
		$idcliente = $data['cliente'];
	}
	$resultado = mysqli_query($conexion_usuarios, "SELECT nombreEmpresa FROM contactos WHERE id='".$idcliente."'");
	while($data = mysqli_fetch_array($resultado)){
		$nombrecliente = $data['nombreEmpresa'];
	}

?>

<!DOCTYPE html>
</html>
<html>
<head>
	<title>Pedido</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<?php include('../../enlaces.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<main class="mdl-layout__content">
    		<div class="page-content">
    			<!-- Breadcrumb -->
	    			<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">				    	
					    	<li class="breadcrumb-item">Ventas</li>
					    	<li class="breadcrumb-item"><a id="toolTipVerCotizaciones" href="pedidos.php">Pedidos</a></li>
					    	<li id="breadcrumb" class="breadcrumb-item acti ve" aria-current="page">
					    		Cliente: <a id="toolTipVerCliente" href="<?php echo $ruta; ?>php/ventas/clientes/verContacto.php?id=<?php echo $idcliente; ?>"><?php echo $nombrecliente; ?></a> - Ref. Cotizacion: <a href="<?php echo $ruta; ?>php/ventas/cotizaciones/verCotizacion.php?numero=<?php echo $_REQUEST['refCotizacion']; ?>"><?php echo $_REQUEST['refCotizacion']; ?></a> - No. Pedido: <?php echo $_REQUEST['numeroPedido']; ?>
					    	</li>
					  	</ol>
					</nav>

				<!-- Encabezado -->
					<div id="encabezado" class="row fondo">
						<div class="col-sm-12">
							<h1 class="text-center"><b>PEDIDO</b></h1><br>
						</div>
					</div>
				
				<!-- Botones de informacion -->
					<div class="row justify-content-center">
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#informacioncliente" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-info-circle" aria-hidden="true"></i> Cliente</button>
							<button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#informacionpedido" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-info-circle" aria-hidden="true"></i> Pedido</button>
						</div>
					</div>
				
				<!-- Mensaje actualizaciones-->
					<br>
					<div>
						<center><h6 class="mensaje"></h6></center>
					</div>
					
    			<!-- Informacion de Cliente -->
    				<br>
    				<div class="container collapse" id="informacioncliente">
	    				<div class="card col-12">
						  	<div class="card-body">
						  		<div class="row col-12">
						    		<h2 id="encabezadoCliente" class="card-title"></h2>
						  		</div>
						  		<br><br>
						    	<div class="row">
						    		<br>
						    		<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">RFC</h5>
								    	<p id="encabezadoRFC" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Calle</h5>
								    	<p id="encabezadoCalle" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Colonia</h5>
								    	<p id="encabezadoColonia" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Ciudad</h5>
								    	<p id="encabezadoCiudad" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">C.P.</h5>
								    	<p id="encabezadoCP" class="card-text"></p>
							    	</div>
						    	</div>
						    	<hr>
						    	<div class="row col-12">
						    		<h4 class="card-title">Contacto</h4><br>
						  		</div>
						  		<div class="row">
						    		<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Nombre</h5>
								    	<p id="encabezadoNombreC" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Telefono</h5>
								    	<p id="encabezadoTelC" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Fax</h5>
								    	<p id="encabezadoFaxC" class="card-text"></p>
							    	</div>
							    	<div class="col">
								    	<h5 class="card-subtitle mb-2 text-muted">Correo electronico</h5>
								    	<p id="encabezadoCorreoC" class="card-text"></p>
							    	</div>
						    	</div>
						  	</div>
						</div>
    				</div>
    		
    			<!-- Informacion de Pedido -->
    				<br>
	    			<div class="container collapse" id="informacionpedido">
		    			<div class="row">
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Ref. Cotizacion</label>
					      		<input type="text" id="refCotizacion" class="form-control" disabled>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Fecha</label>
					      		<input type="text" id="fecha" class="form-control" disabled>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Vendedor</label>
					      		<input type="text" id="vendedor" class="form-control" disabled>
					    	</div>	
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Orden de compra</label>
					      		<input type="text" id="ordenCompra" class="form-control" disabled>
					    	</div>
					  	</div>
					  	<div class="row">
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Factura</label>
					      		<input type="text" id="factura" class="form-control" disabled>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Pagado</label>
					      		<input type="text" id="pagado" class="form-control" disabled>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Moneda</label>
					      		<select id="moneda" class="form-control">
					      			<option value="usd" selected>USD</option>
					      			<option value="mxn">MXN</option>
					      		</select>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">Paqueteria</label>
					      		<select id="paqueteria" class="form-control">
					      			
					      		</select>
					    	</div>
					    	<div class="form-group col">
					      		<label for="disabledTextInput">No. de guia</label>
					      		<a href="" id="cambiarng"><i class="fa fa-pencil btn-outline-primary" aria-hidden="true"></i></a>
					      		<div class="mdl-tooltip" data-mdl-for="cambiarng">
									<strong>Cambiar no. de guia</strong>
								</div>
					      		<div>
					      			<input type="text" id="numeroGuia" class="form-control"> 
					      		</div>
					    	</div>
					    </div>	
						<hr>
					    <div class="row">
					    	<div class="form-group col-2">
					      		<label for="disabledTextInput">Proveedor</label>					      		
					      		<div>
					      			<select name="proveedorg" id="proveedorg" class="form-control"></select>
					      		</div>
					    	</div>
					    	<div class="form-group col-2">
					      		<label for="disabledTextInput">Cantidad</label>
					      		<a href="" id="cambiarcantidadg"><i class="fa fa-pencil btn-outline-primary" aria-hidden="true"></i></a>
					      		<div>
					      			<input type="text" id="cantidadg" name="cantidadg" class="form-control">
					      		</div>
					    	</div>
					    	<div class="form-group col">	
								<label for="formapago">Forma de Pago</label>
					      		<div>
								  	<select type="text" id="formapago" name="formapago" class="form-control">
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
					    	<div class="form-group col">
								<label for="metodopago">Método de Pago</label>
					      		<div>
								  <select type="text" id="metodopago" name="metodopago" class="form-control">
										<option value="1">Pago en una sola exhibición</option>
										<option value="2">Pago en parcialidades o diferido</option>
									</select>
					      		</div>					      	
					    	</div>
							<div class="form-group col">
								<label for="cfdi">Uso de CFDI</label>
					      		<div>
								  <select type="text" id="cfdi" name="cfdi" class="form-control">
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

    			<!-- Tabla de partidas -->
    				<br><br><br>    				
	    			<div class="col-12">
	    				<table id="dt_pedido" class="table table-bordered table-striped table-responsive display compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Marca</th>
									<th>Modelo</th>
									<th>Descripcion</th>
									<th>No. Serie</th>
									<th>Precio Unidad</th>
									<th>Cantidad</th>
									<th>Precio Total</th>
									<th>Fecha Compromiso</th>
									<th>Proveedor</th>
									<th>Almacen</th>
									<th>Entregado <input type="checkbox" class="btn btn-outline-primary" name="sel" onclick="seleccionartodo()"></th>
									<th>Editar</th>
								</tr>
							</thead>
						</table>						
					</div>
					<br>
					<br>

				<!-- Modal Packing List -->	
					<div class="modal fade" id="modalPackingList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Packing List</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">						      		
									<table id="dt_packing_list" class="table table-bordered table-striped table-responsive display compact" cellspacing="0" width="100%">
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
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button id="agregar-packing-list" type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button>
								</div>
							</div>
						</div>
					</div>													

				<!-- Modal Editar Partidas -->
					<form id="frmEditar" action="" class="form-horizontal" method="POST">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="opcion" id="opcion" value="editarpartida">
						<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  	<div class="modal-dialog" role="document">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o btn-outline-primary" aria-hidden="true"></i> Editar partida</h5>
						        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          			<span aria-hidden="true">&times;</span>
						        		</button>
						      		</div>
							      	<div class="modal-body">
									  <div class="form-group row">
							      			<label for="claveSat" class="control-label col-4">Clave SAT</label>
							      			<input type="text" class="form-control col-8" name="claveSat" id="claveSat">
							      		</div>
							      		<div class="form-group row">
							      			<label for="noserie" class="control-label col-4">No. Serie</label>
							      			<input type="text" class="form-control col-8" name="noserie" id="noserie">
							      		</div>
							      		<div class="form-group row">
							      			<label for="cantidad" class="control-label col-4">Cantidad</label>
							      			<input type="text" class="form-control col-8" name="cantidad" id="cantidad">
							      		</div>
							      		<div class="form-group row">
							      			<label for="fechacompromiso" class="control-label col-4">Fecha compromiso</label>
							      			<input type="date" class="form-control col-8" name="fechacompromiso" id="fechacompromiso">
							      		</div>
							      		<div class="form-group row">
							      			<label for="proveedor" class="control-label col-4">Proveedor</label>
							      			<select name="proveedor" id="proveedor" class="form-control col-8"></select>
							      		</div>
							      		<div class="form-group row">
							      			<label for="split" class="control-label col-4">Split</label>
							      			<input type="text" class="form-control col-8" name="split" id="split">
							      		</div>
										<div class="form-group row">
							      			<label for="entregado" class="control-label col-4">Entregado</label>
							      			<input type="date" class="form-control col-8" name="entregado" id="entregado">
							      		</div>
							      	</div>
							      	<div class="modal-footer">
							        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							        	<button id="editar-partida" type="button" class="btn btn-primary">Editar</button>
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

				<!-- Modal Split -->
					<div class="modal fade" id="modalSplit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-chain-broken btn-outline-info" aria-hidden="true"></i> Split</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          			<span aria-hidden="true">&times;</span>
					        		</button>
					      		</div>
						      	<div class="modal-body">
						        	<form id="frmSplit" action="" method="POST">
						        		<input type="hidden" id="idherramienta" name="idherramienta">
						        		<div class="row justify-content-center align-items-center">
						        			<fieldset class="col" disabled>
							        			<div class="form-group col">
							        				<center><label for="modelo">Modelo</label></center>
							        				<input type="text" id="modelo" name="modelo" class="form-control">
							        			</div>
							        			<div class="form-group col">
							        				<center><label for="cantidad">Cantidad</label></center>
							        				<input type="text" id="cantidad" name="cantidad" class="form-control">
							        			</div>
						        			</fieldset>
						        			<div class="form-group col">
						        				<center><label for="numerosplit">Split</label></center>
						        				<input type="text" id="numerosplit" name="numerosplit" class="form-control">
						        			</div>
						        		</div>
						        	</form>
						      	</div>
						      	<div class="modal-footer">
						        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						        	<button type="button" class="btn btn-info">Split</button>
						      	</div>
					    	</div>
					  	</div>
					</div>
    		
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
    		
			
			</div>
    	</main>
</body>
</html>
<script>
	$(document).on("ready", function(){			
		var refCotizacion = "<?php echo $_REQUEST['refCotizacion']; ?>";
		var numeroPedido = "<?php echo $_REQUEST['numeroPedido']; ?>";
		buscardatos(refCotizacion, numeroPedido);
		agregarDevolucion(refCotizacion, numeroPedido);
		cambiarnumeroguia(refCotizacion, numeroPedido);
		cambiarpaqueteria(refCotizacion, numeroPedido);
		cambiarformapago(refCotizacion, numeroPedido);
		cambiarmetodopago(refCotizacion, numeroPedido);
		cambiarusocfdi(refCotizacion, numeroPedido);
		cambiarproveedorgeneral(refCotizacion, numeroPedido);
		cambiarcantidadgeneral(refCotizacion, numeroPedido);
		$('.collapse').collapse('show');
		setTimeout(cerrarcollapse, 3000);
		editarPartida(refCotizacion, numeroPedido);
		buscar_oc_pendientes();
		setInterval(buscar_oc_pendientes, 3000);
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
					"<'container row col-10 row'<'row justify-content-end col-12 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>"
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
	}

	function cerrarcollapse(){
		$('.collapse').collapse('hide');
	}

	var listar_partidas = function(refCotizacion, numeroPedido, RFC){
		$("#dt_pedido").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
			var opcion = "listarpartidas"; 
			var table = $("#dt_pedido").DataTable({
				"destroy":"true",
				"deferRender": true,
				"scrollX": true,
				"ajax":{
					"url": "listar.php",
					"type": "POST",
					"data": {"refCotizacion": refCotizacion, "numeroPedido": numeroPedido, "opcion": opcion}
				},
				"columns":[					
					{"data": "marca"},
					{"data": "modelo"},
					{"data": "descripcion"},
					{"data": "noserie"},
					{"data": "preciounidad"},
					{"data": "cantidad"},
					{"data": "preciototal"},
					{"data": "fechacompromiso"},
					{"data": "proveedor"},
					{"data": "almacen"},
					{"data": "entregado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
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
		                .column( 6 )
		                .data()
		                .reduce( function (a, b) {
		                    return intVal(a) + intVal(b);
		                }, 0 );

		            $( api.column( 6 ).footer() ).html('SubTotal $ ' + subtotal.toFixed(2));
		            $( api.column( 7 ).footer() ).html('IVA $ ' + (subtotal * .16).toFixed(2));
		            $( api.column( 8 ).footer() ).html('Total $ ' + (subtotal + subtotal*.16).toFixed(2));
		        },
		        "dom":  
					"<'container row col-10 row'<'row justify-content-center col-6 buttons'B><'row justify-content-end col-6 buttons'f>>" +
					"<'container row col-10 row'<'justify-content-center col-12 buttons'tr>>" +
					"<'container row col-10 row'<'row justify-content-center col-4 buttons'i><'row justify-content-end col-8 buttons'p>>",
				// "rowCallback": function( Row, Data) {
				//     if ( Data[9] == 0 )
				//     {
				//         $('td', Row).css('background-color', 'Green');
				//     }
				//     else if ( Data[9] == "Bueno" )
				//     {
				//         $('td', Row).css('background-color', 'Blue');
				//     }
				//     else if ( Data[9] == "Malo" )
				//     {
				//         $('td', Row).css('background-color', 'Red');
				//     }
				// },
				"createdRow": function ( row, data, index ) {
		            console.log(data.entregado);
		            if ( data.entregado == "si" ) {
		                $('td', row).eq(0).addClass('table-success');
		                $('td', row).eq(1).addClass('table-success');
		                $('td', row).eq(2).addClass('table-success');
		                $('td', row).eq(3).addClass('table-success');
		                $('td', row).eq(4).addClass('table-success');
		                $('td', row).eq(5).addClass('table-success');
		                $('td', row).eq(6).addClass('table-success');
		                $('td', row).eq(7).addClass('table-success');
		                $('td', row).eq(8).addClass('table-success');
		                $('td', row).eq(9).addClass('table-success');		                
		            }
		        },
				"buttons":[
					// {
		            //     text: 'Devolucion',
		            //     "className": "btn btn-danger",
		            //     action: function ( e, dt, node, config ) {
		            //     	$('#modalDevolucion').modal('show');
		            //     	listar_devolucion(refCotizacion, numeroPedido);
		            //     }
		            // },
		            {
		                text: 'Generar Factura',
		                "className": "btn btn-success",
		                action: function ( e, dt, node, config ) {
		                	generar_factura(RFC, numeroPedido, refCotizacion);
		                }
		            },
		            {
		                text: 'Packing list',
		                "className": "btn btn-primary",
		                action: function ( e, dt, node, config ) {
		                	$('#modalPackingList').modal('show');
		                }
		            },
					{
		                text: 'Entregado',
		                "className": "btn btn-primary",
		                action: function ( e, dt, node, config ) {
		                	entregado(refCotizacion, numeroPedido, RFC);
		                }
		            }
				]
			});			

		proveedores();
		obtener_data_split("#dt_pedido tbody", table);
		obtener_data_editar("#dt_pedido tbody", table);	
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
				listar_partidas(refCotizacion, numeroPedido, RFC);
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
			var cantidad = data.cantidad;
			if (cantidad > 1) {
				document.getElementById("split").disabled = false;	
				$("#frmEditar #split").val(0);	
			}else{
				$("#frmEditar #split").val("No split");
				document.getElementById("split").disabled = true;
			}
			$("#frmEditar #entregado").val(data.entregado);
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
					console.log(info);
					var json_info = JSON.parse( info );
					console.log(json_info);
					listar_partidas(refCotizacion, numeroPedido);
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
				document.getElementById("encabezadoCliente").innerHTML = data.cliente.nombreEmpresa;
				document.getElementById("encabezadoRFC").innerHTML = data.cliente.RFC;
				document.getElementById("encabezadoCalle").innerHTML = data.cliente.calle;
				document.getElementById("encabezadoColonia").innerHTML = data.cliente.colonia;
				document.getElementById("encabezadoCiudad").innerHTML = data.cliente.ciudad;
				document.getElementById("encabezadoCP").innerHTML = data.cliente.cp;

				$("#refCotizacion").val(data.refCotizacion);
				$("#ordenCompra").val(data.ordenCompra);
				$("#fecha").val(data.fecha);
				$("#vendedor").val(data.vendedor);
				$("#factura").val(data.factura);
				$("#pagado").val("$ "+data.pagado+" - $"+data.total);
				$("#moneda").val(data.moneda);
				$("#paqueteria").val(data.paqueteria);
				$("#numeroGuia").val(data.numeroGuia);
				$("#formapago").val(data.cliente.IdFormaPago);
				$("#metodopago").val(data.cliente.IdMetodoPago);
				$("#cfdi").val(data.cliente.IdUsoCFDI);

				var paqueteria = data.paqueteria;
				paqueterias(paqueteria);
				var RFC = data.cliente.RFC;
				listar_partidas(refCotizacion, numeroPedido, RFC);

				// var request = new XMLHttpRequest();				

				// request.open('GET', 'http://devfactura.in/api/v3/cfdi33/list');
				
				// request.setRequestHeader("Access-Control-Allow-Origin", "*");
				// request.setRequestHeader('Access-Control-Allow-Headers', '*');
				// request.setRequestHeader('Access-Control-Allow-Credentials', 'true');
				// request.setRequestHeader('Content-Type', 'application/json');
				// request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
				// request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');
				
				// request.onreadystatechange = function () {
				//   if (this.readyState === 4) {		
				// 	console.log('Status:', this.status);
				// 	console.log('Headers:', this.getAllResponseHeaders());			
				//     var data = JSON.parse(this.responseText);
				// 	console.log(data);
				//     var total = data.total;
				//     for (var i = 0; i < total; i++) {
				//     	if (numeroPedido == data.data[i].NumOrder){
				//     		$("#factura").val(data.data[i].Folio);
				//     	}
				//     }
				//   }
				// };

				// request.send();

				var request = new XMLHttpRequest();				

				request.open('GET', 'http://factura.com/api/v3/cfdi33/list');

				request.setRequestHeader("Access-Control-Allow-Origin", "*");
				request.setRequestHeader('Access-Control-Allow-Headers', '*');
				request.setRequestHeader('Access-Control-Allow-Credentials', 'true');
				request.setRequestHeader('Content-Type', 'application/json');
				request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
				request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

				request.onreadystatechange = function () {
				if (this.readyState === 4) {		
					console.log('Status:', this.status);
					console.log('Headers:', this.getAllResponseHeaders());			
					var data = JSON.parse(this.responseText);
					console.log(data);
					var total = data.total;
					for (var i = 0; i < total; i++) {
						if (numeroPedido == data.data[i].NumOrder){
							$("#factura").val(data.data[i].Folio);
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

	var obtener_data_split = function(tbody, table){
		$(tbody).on("click", "button.split", function(){
			var data = table.row( $(this).parents("tr") ).data();
			console.log(data);
			$("#frmSplit #idherramienta").val(data.id);
			$("#frmSplit #modelo").val(data.modelo);
			$("#frmSplit #cantidad").val(data.cantidad);			
		});
	}

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
		$("#paqueteria").on("change", function(event){
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
		$("#formapago").on("change", function(event){
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
		$("#metodopago").on("change", function(event){
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
		$("#cfdi").on("change", function(event){
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

	var cambiarproveedorgeneral = function(refCotizacion, numeroPedido){
		$("#proveedorg").on("change", function(e){
			e.preventDefault();
			var opcion = "proveedor";
			var proveedor = $("#proveedorg").val();
			console.log(opcion);
			console.log(proveedor);		
			$.ajax({
				method: "POST",
				url: "guardar.php",
				data: {"opcion": opcion, "proveedor": proveedor, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
			}).done( function( info ){				
				var json_info = JSON.parse( info );
				mostrar_mensaje(json_info);
				listar_partidas(refCotizacion, numeroPedido);
			});
		});
	}

	var cambiarcantidadgeneral = function(refCotizacion, numeroPedido){
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
				data: {"opcion": opcion, "cantidad": cantidad, "refCotizacion": refCotizacion, "numeroPedido": numeroPedido},
			}).done( function( info ){				
				var json_info = JSON.parse( info );
				mostrar_mensaje(json_info);
				listar_partidas(refCotizacion, numeroPedido);
			});
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
				texto = "<strong>Advertencia!</strong> la opci�n no existe o esta vac�a, recargar la p�gina. ";
				color = "#DDB11D";
			}

			// $(".mensaje").alert();
			$(".mensaje").html( texto );
			$(".mensaje").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(5000);
			}); 
	}

	var generar_factura = function(RFC, numeroPedido, refCotizacion){
		// var request = new XMLHttpRequest();

		// request.open('GET', 'http://devfactura.in/api/v1/clients/'+RFC);

		// request.setRequestHeader('Content-Type', 'application/json');
		// request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
		// request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');
		// request.setRequestHeader('Access-Control-Allow-origin', 'true');
		// request.setRequestHeader("Access-Control-Allow-Origin", "*");

		// request.onreadystatechange = function () {
		// 	if (this.readyState === 4) {
		//     	console.log('Status:', this.status);
		//     	console.log('Headers:', this.getAllResponseHeaders());
		//     	console.log('Body:', this.responseText);
		//     	var data = JSON.parse(this.responseText);
		// 	    if (data.status == "error"){
		// 	    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error</strong>, "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
		// 						color = "#C9302C";

		// 			$(".mensaje").html( texto );


		// 	    	var opcion = "datosRFC";
		// 	    	$.ajax({
		// 				method: "POST",
		// 				url: "buscar.php",
		// 				dataType: "json",
		// 				data: {"opcion": opcion, "rfc": RFC},
		// 			}).done( function( data ){
		// 				console.log(data.datos);
		// 				$("#modalRegistrarClientePortal #email").val(data.datos.correoElectronico);
		// 				$("#modalRegistrarClientePortal #telefono").val(data.datos.tlf1);
		// 				$("#modalRegistrarClientePortal #razons").val(data.datos.nombreEmpresa);
		// 				$("#modalRegistrarClientePortal #rfc").val(data.datos.RFC);
		// 				$("#modalRegistrarClientePortal #numero_exterior").val(data.datos.NumExt);
		// 				$("#modalRegistrarClientePortal #numero_interior").val(data.datos.NumInt);
		// 				$("#modalRegistrarClientePortal #codpos").val(data.datos.cp);
		// 				$("#modalRegistrarClientePortal #calle").val(data.datos.calle);
		// 				$("#modalRegistrarClientePortal #colonia").val(data.datos.colonia);
		// 				$("#modalRegistrarClientePortal #estado").val(data.datos.estado);
		// 				$("#modalRegistrarClientePortal #ciudad").val(data.datos.ciudad);
		// 				$("#modalRegistrarClientePortal #delegacion").val(data.datos.pais);
		// 				alert("El cliente no esta registrado en portal de Factura.com\n\n Registrarlo a continuación");
		// 	    		$("#modalRegistrarClientePortal").modal("show");
		// 			});
		// 	    }else{
		// 			var request = new XMLHttpRequest();

		// 			request.open('POST', 'http://devfactura.in/api/v3/cfdi33/create');

		// 			request.setRequestHeader('Content-Type', 'application/json');
		// 			request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
		// 			request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');

		// 			request.onreadystatechange = function () {
		// 				if (this.readyState === 4) {
		// 					console.log('Status:', this.status);
		// 				    console.log('Headers:', this.getAllResponseHeaders());
		// 				    console.log('Body:', this.responseText);
		// 				    var data = JSON.parse(this.responseText);

		// 				    if (data.response == "error" && data.message) {
		// 				    	texto = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
		// 						color = "#C9302C";

		// 						$(".mensaje").html( texto );
		// 				    }

		// 				    if (data.response == "error" && data.message.message) {
		// 				    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
		// 						color = "#C9302C";

		// 						$(".mensaje").html( texto );
		// 				    }else if(data.response = "success"){
		// 				    	texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Bien!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
		// 						color = "#379911";

		// 						$(".mensaje").html( texto );

		// 						var request = new XMLHttpRequest();

		// 						request.open('GEt', 'http://devfactura.in/api/v3/cfdi33/list');

		// 						request.setRequestHeader('Content-Type', 'application/json');
		// 						request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
		// 						request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');							

		// 						request.onreadystatechange = function () {
		// 						  if (this.readyState === 4) {
		// 						    var data = JSON.parse(this.responseText);
		// 						    console.log(data);						   
		// 						    var totalfacturas = data.total;
		// 						    for (var i = 0; i < totalfacturas; i++) {
		// 						    	if (numeroPedido == data.data[i].NumOrder){
		// 						    		var folio = data.data[i].Folio;
		// 						    		var ordenpedido = data.data[i].NumOrder;
		// 						    		var total = data.data[i].Total;
		// 						    		var status = data.data[i].Status;
		// 						    		var fecha = data.data[i].FechaTimbrado;
		// 						    		var cliente = data.data[i].RazonSocialReceptor;
		// 						    		var opcion = "guardarfactura";
		// 						    		console.log(folio);
		// 						    		console.log(ordenpedido);
		// 						    		console.log(total);
		// 						    		console.log(status);
		// 						    		console.log(fecha);
		// 						    		console.log(cliente);
		// 						    		console.log(opcion);
		// 						    		$.ajax({
		// 										method: "POST",
		// 										url: "guardar.php",
		// 										dataType: "json",
		// 										data: {"opcion": opcion, "folio": folio, "ordenpedido": ordenpedido, "total": total, "status": status, "fecha": fecha, "cliente": cliente}
		// 									}).done( function( data ){
		// 										console.log(data);
		// 										mostrar_mensaje(data);
		// 									});
		// 									var request = new XMLHttpRequest();

		// 									request.open('GET', 'http://devfactura.in/api/v3/cfdi33/'+data.data[i].UID+'/pdf');

		// 									request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJDNtc1I3Z2JySG5pcUs0VWtQTlVxbmVsaFdyWUl6Ym5kQ1FKcmE2UGNIMG1WeGs5aEtXU3dp');
		// 									request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJERYUXBSWGo5R0VINzE4UlRiY25oc09SUWhnMU9vRWdYSTQwOWJuTDZXUlhYR1E0Vmp5ZUFX');
		// 									request.setRequestHeader('Content-Type', 'application/pdf');
		// 									request.setRequestHeader('Content-Transfer-Encoding', 'Binary');
		// 									request.setRequestHeader('Content-Disposition', 'attachment: filename=F2222.pdf');		
		// 									request.responseType = 'blob';

		// 									request.onreadystatechange = function () {
		// 										if (this.readyState === 4) {
		// 											console.log('Status:', this.status);
		// 											console.log('Headers:', this.getAllResponseHeaders());
		// 											console.log('Body:', this.response);
		// 											var blob = new Blob([this.response], {type: 'application/pdf'});
		// 											var link = document.createElement('a');
		// 											link.href = window.URL.createObjectURL(blob);
		// 											link.download = "factura.pdf";
		// 											link.click();
		// 										}
		// 									};

		// 									request.send();
		// 						    	}
		// 						    }
		// 						  }
		// 						};

		// 						request.send();
		// 				    }
		// 				}
		// 			};

		// 			var opcion = "buscarpartidasfacturar";
		// 			$.ajax({
		// 				method: "POST",
		// 				url: "buscar.php",
		// 				dataType: "json",
		// 				data: {"opcion": opcion, "numeroPedido": numeroPedido, "refCotizacion": refCotizacion}
		// 			}).done( function( conceptos ){
		// 				console.log(conceptos);
		// 				var fecha = "<?php echo date("Y-m-d")."T".date("H:i:s"); ?>";
		// 				console.log(fecha);
		// 				var body = {
		// 				    'Receptor': {
		// 				        'UID': data.Data.UID,
		// 				        'ResidenciaFiscal': '',
		// 				    },
		// 				    'TipoDocumento':'factura',
		// 				    'Conceptos': conceptos.data,
		// 				    'UsoCFDI': conceptos.cfdi,
		// 				    'Serie':'1194',
		// 				    'FormaPago': conceptos.formapago,
		// 				    'MetodoPago': conceptos.metodopago,
		// 				    'CondicionesDePago': conceptos.condpago,
		// 				    'Moneda': conceptos.moneda,
		// 				    'TipoCambio': conceptos.tipocambio,
		// 				    'NumOrder': numeroPedido,
		// 				    'FechaFromAPI': fecha,
		// 				    // 'Comentarios': 'Comentarios para agregar a la factura PDF',
		// 				    'EnviarCorreo': false
		// 				};

		// 				console.log(JSON.stringify(body));
		// 				request.send(JSON.stringify(body));
		// 			});

					
		// 		}
		// 	}
		// };
		// request.send();
		
		var request = new XMLHttpRequest();

		request.open('GET', 'http://factura.com/api/v1/clients/'+RFC);

		request.setRequestHeader('Content-Type', 'application/json');
		request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
		request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');
		request.setRequestHeader('Access-Control-Allow-origin', 'true');
		request.setRequestHeader("Access-Control-Allow-Origin", "*");

		request.onreadystatechange = function () {
			if (this.readyState === 4) {
		    	console.log('Status:', this.status);
		    	console.log('Headers:', this.getAllResponseHeaders());
		    	console.log('Body:', this.responseText);
		    	var data = JSON.parse(this.responseText);
			    if (data.status == "error"){
			    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error</strong>, "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#C9302C";

					$(".mensaje").html( texto );


			    	var opcion = "datosRFC";
			    	$.ajax({
						method: "POST",
						url: "buscar.php",
						dataType: "json",
						data: {"opcion": opcion, "rfc": RFC},
					}).done( function( data ){
						console.log(data.datos);
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
						alert("El cliente no esta registrado en portal de Factura.com\n\n Registrarlo a continuación");
			    		$("#modalRegistrarClientePortal").modal("show");
					});
			    }else{
					var request = new XMLHttpRequest();

					request.open('POST', 'http://factura.com/api/v3/cfdi33/create');

					request.setRequestHeader('Content-Type', 'application/json');
					request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
					request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');

					request.onreadystatechange = function () {
						if (this.readyState === 4) {
							console.log('Status:', this.status);
						    console.log('Headers:', this.getAllResponseHeaders());
						    console.log('Body:', this.responseText);
						    var data = JSON.parse(this.responseText);

						    if (data.response == "error" && data.message) {
						    	texto = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#C9302C";

								$(".mensaje").html( texto );
						    }

						    if (data.response == "error" && data.message.message) {
						    	texto = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!</strong> "+ data.message.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#C9302C";

								$(".mensaje").html( texto );
						    }else if(data.response = "success"){
						    	texto = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Bien!</strong> "+ data.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></i></div>";
								color = "#379911";

								$(".mensaje").html( texto );

								var request = new XMLHttpRequest();

								request.open('GEt', 'http://factura.com/api/v3/cfdi33/list');

								request.setRequestHeader('Content-Type', 'application/json');
								request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
								request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');							

								request.onreadystatechange = function () {
								  if (this.readyState === 4) {
								    var data = JSON.parse(this.responseText);
								    console.log(data);						   
								    var totalfacturas = data.total;
								    for (var i = 0; i < totalfacturas; i++) {
								    	if (numeroPedido == data.data[i].NumOrder){
								    		var folio = data.data[i].Folio;
								    		var ordenpedido = data.data[i].NumOrder;
								    		var total = data.data[i].Total;
								    		var status = data.data[i].Status;
								    		var fecha = data.data[i].FechaTimbrado;
								    		var cliente = data.data[i].RazonSocialReceptor;
								    		var opcion = "guardarfactura";
								    		console.log(folio);
								    		console.log(ordenpedido);
								    		console.log(total);
								    		console.log(status);
								    		console.log(fecha);
								    		console.log(cliente);
								    		console.log(opcion);
								    		$.ajax({
												method: "POST",
												url: "guardar.php",
												dataType: "json",
												data: {"opcion": opcion, "folio": folio, "ordenpedido": ordenpedido, "total": total, "status": status, "fecha": fecha, "cliente": cliente}
											}).done( function( data ){
												console.log(data);
												mostrar_mensaje(data);
											});
											var request = new XMLHttpRequest();

											request.open('GET', 'http://factura.com/api/v3/cfdi33/'+data.data[i].UID+'/pdf');

											request.setRequestHeader('F-API-KEY', 'JDJ5JDEwJHJWelRXTWlJMEd4OS9kS3hRZTJNZy5neFAwV2dzdGttLjVleTcueDIyUHlMOEE0VEY5dUFL');
											request.setRequestHeader('F-SECRET-KEY', 'JDJ5JDEwJDd3bXhpWENGRXJFMkNvOE1Hblo5Y2VPV3J5WXJxZmJoVEJhQjR0OE1Xa0hrV1lmRXhCWkFt');
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

								request.send();
						    }
						}
					};

					var opcion = "buscarpartidasfacturar";
					$.ajax({
						method: "POST",
						url: "buscar.php",
						dataType: "json",
						data: {"opcion": opcion, "numeroPedido": numeroPedido, "refCotizacion": refCotizacion}
					}).done( function( conceptos ){
						console.log(conceptos);
						var fecha = "<?php echo date("Y-m-d")."T".date("H:i:s"); ?>";
						console.log(fecha);
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
						    'NumOrder': numeroPedido,
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

	var idioma_espanol = {
		"sProcessing":     "Procesando...",
   		"sLengthMenu":     "Mostrar _MENU_ registros",
    	"sZeroRecords":    "No se encontraron resultados",
    	"sEmptyTable":     "Ning�n dato disponible en esta tabla",
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

