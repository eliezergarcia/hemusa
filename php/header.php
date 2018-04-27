
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  		<header class="mdl-layout__header">
    		<div class="mdl-layout__header-row">
		    	<!-- Title -->
		      	<img src="<?php echo $ruta; ?>imagenes/logo_hemusa.png" alt="Logo Hemusa" width="9%">
		      	<!-- Add spacer, to align navigation to the right -->
		      	<div class="mdl-layout-spacer"></div>
		      	<!-- Navigation -->
		      	<nav class="mdl-navigation mdl-layout--large-screen-only mdl-navigation__link">
			        <i class="material-icons  mdl-list__item-avatar">person </i>
      				<?php echo $usuario." ".$usuarioApellido ?>
		      	</nav>
				<!-- Barra de notificaciones -->
					<?php 
						if ($departamento_usuario == "Administracion" || $departamento_usuario == "Ventas" || $departamento_usuario == "Facturacion") {
					?>
						<div id="toolTipVerOCpendientes" data-toggle="modal" data-target="#modalOCPendientes">
							<span id="ocpendientes" name="ocpendientes" class="mdl-badge" data-badge="0"><i id="verocpendientes" class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></span>
						</div>
					<?php
						}
					?>
					<!-- <?php 
						if ($departamento_usuario == "Administracion" || $departamento_usuario == "Facturacion") {
					?>
						<div id="toolTipVerFacturasPendientes" data-toggle="modal" data-target="#modalFacturasPendientes">
							<span id="ocpendientes" class="mdl-badge" data-badge="0"><i id="verfacturaspendientes" class="fa fa-google-wallet" aria-hidden="true"></i></span>
						</div>
					<?php
						}
					?> -->				
					<!-- <div id="toolTipVerNotificaciones">
						<span id="notifpendientes" class="mdl-badge" data-badge="0"><i id="vernotificaciones" class="fa fa-bell" aria-hidden="true"></i></span>
					</div> -->
					<div class="mdl-tooltip" data-mdl-for="toolTipVerOCpendientes">
						<strong>Ver OC pendientes</strong>
					</div>
					<div class="mdl-tooltip" data-mdl-for="toolTipVerNotificaciones">
						<strong>Ver notificaciones</strong>
					</div>
					<!-- <div id="toolTipCerrarSesion">
						<a href="<?php echo $logoutAction; ?>" class="mdl-navigation__link"><i id="cerrarSesion" class="fa fa-power-off" aria-hidden="true"></i></a>
					</div> -->
					<div class="dropdown">
						<i class="fa fa-cog fa-lg mdl-navigation__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-hidden="true"></i>
						<div class="dropdown-menu" aria-labelledby="dLabel">
							<a href="<?php echo $logoutAction; ?>" class="dropdown-item" href="#"><i id="cerrarSesion" class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesión</a>
						</div>
					</div>
				<div class="mdl-tooltip" data-mdl-for="toolTipCerrarSesion">
					<strong>Cerrar sesión</strong>
				</div>
		    </div>
 		</header>
  		<div class="mdl-layout__drawer">
		    <span class="mdl-layout-title">Menú
		   	</span>
		    	<?php 
		    		if($departamento_usuario == 'Creditos y Cobranza'){
		    			echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;Créditos y Cobranza</h4>';
		    		}

		    		if($departamento_usuario == 'Administracion'){
		    			echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;Administración</h4>';
		    		}

		    		if($departamento_usuario == 'Ventas'){
		    			echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;Ventas</h4>';
		    		}
		    	?>
		    <nav class="mdl-navigation">
				<a class="list-group-item" href="<?php echo $ruta; ?>php/inicio/inicio.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Inicio</a>

				<!-- <a class="list-group-item" href="#"><i class="fa fa-line-chart fa-fw" aria-hidden="true"></i>&nbsp; Dashboard</a> -->
				
				<div class="dropdown">
			        <a class="dropdown-toggle list-group-item" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cc fa-fw" aria-hidden="true"></i>&nbsp; Ventas</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/clientes/clientes.php">Clientes</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/listadeprecios/listadeprecios.php">Lista de precios</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/cotizaciones/cotizaciones.php">Cotizaciones</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/pedidos/pedidos.php">Pedidos</a>
			          	<!-- <div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/controldesalida/controldesalida.php">Control de Salida</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Entregas</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Garantías</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/reportes/reportes.php">Reportes</a> -->
			        </div>
			    </div>
		      	
		      	<div class="dropdown">
			        <a class="dropdown-toggle list-group-item" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cart-plus fa-fw" aria-hidden="true"></i>&nbsp; Compras</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/compras/proveedores/proveedores.php">Proveedores</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/compras/ordenesdecompras/ordenesdecompras.php">Ordenes de compras</a>
			          	<!-- <div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Backorder</a> -->
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/compras/pedimentos/pedimentos.php"">Pedimentos</a>
			          	<!-- <div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Pago de facturas OC</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Pedidos pendientes de OC</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Herramientas sin entregar</a> -->
			        </div>
			    </div>
				
				<div class="dropdown">
			        <a class="nav-link dropdown-toggle list-group-item" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-usd fa-fw" aria-hidden="true"></i>&nbsp; Créditos y Cobranza</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/pagos/pagos.php">Pagos cliente</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/pagos/pagosproveedor.php">Pagos proveedor</a>
			          	<!-- <a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/reportes/reportes.php">Reportes</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="#">Ventas</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/notadecredito/notadecredito.php">Notas de Crédito</a> -->
			        </div>
			    </div>
		      	
		      	<div class="dropdown">
		        	<a class="dropdown-toggle list-group-item" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-google-wallet fa-fw" aria-hidden="true"></i>&nbsp; Facturación</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown3">
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/remisiones/remisiones.php">Remisiones</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/facturacion/facturas/facturas.php">Facturas</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="<?php echo $ruta; ?>php/ventas/embarques/embarques.php">Embarques</a>
			          	<!-- <div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/facturacion/portales/portales.php">Portales clientes</a> -->
		        	</div>
		      	</div>
		    <?php
		      	if($departamento_usuario == "Administracion"){

		    ?>
		      	<div class="dropdown">
		        	<a class="dropdown-toggle list-group-item" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> &nbsp; Administración</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown4">
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/usuarios/usuarios.php">Usuarios</a>
		          		<div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/marcas/marcas.php">Marcas</a>
		          		<!-- <div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/reportes/reportes.php">Reportes</a>
		          		<div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/movimientos/movimientos.php">Movimientos</a> -->
		        	</div>
		      	</div>
		    <?php  	
		    	}
		    ?>
		      	<!-- <div class="dropdown">
		        	<a class="dropdown-toggle list-group-item" href="#" id="navbarDropdown5" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-external-link fa-fw" aria-hidden="true"></i>&nbsp; Links</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown5">
		          		<a class="dropdown-item" href="#">Action</a>
		          		<a class="dropdown-item" href="#">Another action</a>
		          		<div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="#">Something else here</a>
		        	</div>
		      	</div> -->
		    </nav>
  		</div>
  			
    	