<?php
if ($tipomenu != 4) {
	if ($tipomenu == 1) {
		echo '<header id="header-menu" class="be-wrapper be-fixed-sidebar be-color-header">';
		echo '<nav id="nav-menu" class="navbar navbar-expand fixed-top be-top-header">';
	}else if ($tipomenu == 2) {
		echo '<header id="header-menu" class="be-wrapper be-collapsible-sidebar be-collapsible-sidebar-collapsed be-color-header">';
		echo '<nav id="nav-menu" class="navbar navbar-expand fixed-top be-top-header">';
	}else if ($tipomenu == 3){
		echo '<header class="be-wrapper be-offcanvas-menu be-fixed-sidebar be-color-header">';
		echo '<nav class="navbar navbar-expand navbar-default fixed-top be-top-header">';
	}
?>
<div class="container-fluid">
	<div class="be-navbar-header">
		<?php
		if ($tipomenu == 3) {
			echo '<a href="#" class="nav-link be-toggle-left-sidebar"><span class="icon mdi mdi-menu" style="color: white;"></span></a>';
		}
		?>
		<a href="<?php echo $ruta;?>php/inicio/calendario/inicio.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $ruta; ?>media/images/logo_hemusa.png" alt="logo" width="160" height="60" class="logo-img"></a>
	</div>
	<div class="be-right-navbar">
		<ul class="nav navbar-nav float-right be-user-nav">
			<li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><img src="<?php echo $ruta; ?>assets/img/<?php echo $avatar; ?>" alt="Avatar"><span class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></span></a>
				<div role="menu" class="dropdown-menu">
					<div class="user-info">
						<div class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></div>
						<div class="user-position online">Disponible</div>
					</div>
					<a href="<?php echo $ruta;?>php/inicio/perfil/perfil.php" class="dropdown-item"><span class="icon mdi mdi-face"></span> Cuenta</a>
					<a href="<?php echo $ruta;?>php/inicio/configuracion/configuracion.php" class="dropdown-item"><span class="icon mdi mdi-settings"></span> Configuración</a>
					<a href="../../../index.php" class="dropdown-item"><span class="icon mdi mdi-power"></span> Cerrar sesión</a>
				</div>
			</li>
		</ul>
		<!-- <ul class="nav navbar-nav float-right be-icons-nav">
		<li class="nav-item dropdown">
		<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
		<span class="icon mdi mdi-notifications"></span>
		<span class="indicator"></span>
	</a>
	<ul class="dropdown-menu be-notifications">
	<li>
	<div class="title">Notificaciones<span class="badge badge-pill">3</span></div>
	<div class="list">
	<div class="be-scroller">
	<div class="content">
	<ul id="notificaciones">
	<li class="notification notification-unread"><a href="#">
	<div class="image"><img src="<?php echo $ruta; ?>assets/img/avatar2.png" alt="Avatar"></div>
	<div class="notification-info">
	<div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
</div></a></li>
<li class="notification"><a href="#">
<div class="image"><img src="<?php echo $ruta; ?>assets/img/avatar3.png" alt="Avatar"></div>
<div class="notification-info">
<div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
</div></a></li>
<li class="notification"><a href="#">
<div class="image"><img src="<?php echo $ruta; ?>assets/img/avatar4.png" alt="Avatar"></div>
<div class="notification-info">
<div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
</div></a></li>
<li class="notification"><a href="#">
	<div class="image"><img src="<?php echo $ruta; ?>assets/img/avatar5.png" alt="Avatar"></div>
	<div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div></a></li>
</ul>
</div>
</div>
</div>
<div class="footer"> <a href="#">Ver todas las notificaciones</a></div>
</li>
</ul>
</li>
<li class="nav-item dropdown"><a href="#" role="button" aria-expanded="false" class="nav-link be-toggle-right-sidebar"><span id='listar-contactos-chat' class="icon mdi mdi-comments"></span></a></li>
<li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="icon mdi mdi-apps"></span></a>
	<ul class="dropdown-menu be-connections">
		<li>
			<div class="list">
				<div class="content">
					<div class="row">
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/github.png" alt="Github"><span>GitHub</span></a></div>
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/bitbucket.png" alt="Bitbucket"><span>Bitbucket</span></a></div>
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/slack.png" alt="Slack"><span>Slack</span></a></div>
					</div>
					<div class="row">
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/dribbble.png" alt="Dribbble"><span>Dribbble</span></a></div>
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/mail_chimp.png" alt="Mail Chimp"><span>Mail Chimp</span></a></div>
						<div class="col"><a href="#" class="connection-item"><img src="<?php echo $ruta;?>assets/img/dropbox.png" alt="Dropbox"><span>Dropbox</span></a></div>
					</div>
				</div>
			</div>
			<div class="footer"> <a href="#">Más</a></div>
		</li>
	</ul>
</li>
</ul> -->
</div>
</div>
</nav>
<?php
if ($tipomenu != 4){
	echo '<div class="be-left-sidebar">';
		echo '<div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menú</a>';
			echo '<div class="left-sidebar-spacer">';
				echo '<div class="left-sidebar-scroll">';
					echo '<div class="left-sidebar-content">';
						echo '<ul class="sidebar-elements">';
						}
						?>
						<li class="divider">Menu</li>
						<li class=""><a href="<?php echo $ruta; ?>php/inicio/calendario/inicio.php"><i class="icon fas fa-home"></i><span>Inicio</span></a>
						</li>
						<li class="parent"><a href="#"><i class="icon fas fa-dollar-sign"></i><span>Ventas</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/ventas/clientes/clientes.php"><i class="fas fa-address-book"></i> Clientes</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/ventas/listadeprecios/listadeprecios.php"><i class="fas fa-list-alt"></i> Lista de precios</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/ventas/cotizaciones/cotizaciones.php"><i class="fas fa-file-alt"></i> Cotizaciones</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/ventas/pedidos/pedidos.php"><i class="far fa-file-alt"></i> Pedidos</a>
								</li>
							</ul>
						</li>
						<li class="parent"><a href="#"><i class="icon fas fa-shopping-cart"></i><span>Compras</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/compras/proveedores/proveedores.php"><i class="fas fa-address-book"></i> Proveedores</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/compras/ordenesdecompras/ordenesdecompras.php"><i class="fas fa-cart-arrow-down"></i> Ordenes de compras</a>
								</li>
							</ul>
						</li>
						<li class="parent"><a href="#"><i class="icon fas fa-cubes"></i><span>Logística</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/logistica/pedimentos/pedimentos.php"><i class="fas fa-warehouse"></i> Pedimentos</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/logistica/controldesalida/controldesalida.php"><i class="fas fa-dolly"></i> Control de salida</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/logistica/ordenesdecompras/descripcionPedido.php"><i class="fas fa-cart-arrow-down"></i> Ordenes de compras</a>
								</li>
							</ul>
						</li>
						<li class="parent"><a href="#"><i class="icon far fa-credit-card"></i><span>Créditos y cobranza</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/cobranza/pagos/pagos.php"><i class="fab fa-cc-amazon-pay"></i> Pagos de cliente</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/cobranza/pagos/pagosproveedor.php"><i class="fab fa-cc-amazon-pay"></i> Pagos de proveedor</a>
								</li>
							</ul>
						</li>
						<li class="parent"><a href="#"><i class="icon far fa-file-alt"></i><span>Facturación</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/ventas/remisiones/remisiones.php"><i class="fas fa-file"></i> Remisiones</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/ventas/embarques/embarques.php"><i class="fas fa-dolly"></i> Embarques</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/facturacion/facturas/facturas.php"><i class="fas fa-file-alt"></i> Facturas</a>
								</li>
							</ul>
						</li>
						<li class="parent"><a href="#"><i class="icon fas fa-unlock-alt"></i><span>Administración</span></a>
							<ul class="sub-menu">
								<li><a href="<?php echo $ruta; ?>php/administracion/usuarios/usuarios.php"><i class="fas fa-users-cog"></i> Usuarios</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/administracion/marcas/marcas.php"><i class="fas fa-wrench"></i> Marcas</a>
								</li>
								<li><a href="<?php echo $ruta; ?>php/administracion/marcas/subirlista.php"><i class="fas fa-th-list"></i> Subir lista de precios</a>
								</li>
							</ul>
						</li>
						<li class="divider">Features</li>
						<li><a href="<?php echo $ruta; ?>php/email/email.php"><i class="icon fas fa-envelope"></i><span>Email</span><span class="badge badge-primary float-right">BETA</span></a></li>
						<li><a href="<?php echo $ruta; ?>php/galeria/galeria.php"><i class="icon fas fa-images"></i><span>Galería</span><span class="badge badge-primary float-right">BETA</span></a></li>
						<?php
						if ($tipomenu != 4){
							echo '</ul>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
						?>
						<nav class="be-right-sidebar">
							<div class="sb-content">
								<div class="tab-navigation">
									<ul role="tablist" class="nav nav-tabs nav-justified">
										<li role="presentation" class="nav-item"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" class="nav-link active">Chat</a></li>
										<!-- <li role="presentation" class="nav-item"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" class="nav-link">Todo</a></li> -->
										<li role="presentation" class="nav-item"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" class="nav-link">Configuración</a></li>
									</ul>
								</div>
								<div class="tab-panel">
									<div class="tab-content">
										<div id="tab1" role="tabpanel" class="tab-pane tab-chat active">
											<div class="chat-contacts">
												<div class="chat-sections">
													<div class="be-scroller">
														<div class="content">
															<h2>Nuevos mensajes</h2>
															<div id="lista-reciente" class="contact-list contact-list-recent">
																<!-- <div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar1.png" alt="Avatar">
																	<div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
																	<div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar2.png" alt="Avatar">
																		<div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
																		<div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar3.png" alt="Avatar">
																			<div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div> -->
																		</div>
																		<h2>Contactos</h2>
																		<div id="lista-contactos" class="contact-list">
																		</div>
																	</div>
																</div>
															</div>
															<div class="bottom-input">
																<input type="hidden" name="idcontacto" id="idcontacto" value="">
																<input type="text" placeholder="Search..." name="q"><span class="mdi mdi-search"></span>
															</div>
														</div>
														<div class="chat-window">
															<div id="contacto-title" class="title">
																<!-- <div class="user"><img src="assets/img/avatar2.png" alt="Avatar">
																	<h2>Maggie jackson</h2><span>Active 1h ago</span>
																</div><span class="icon return mdi mdi-chevron-left"></span> -->
															</div>
															<div class="chat-messages">
																<div class="be-scroller">
																	<div id="chat-messages" class="content">
																		<ul id="mensajes-chat">
																			<!-- <li class="friend">
																				<div class="msg">Hello</div>
																			</li>
																			<li class="self">
																				<div class="msg">Hi, how are you?</div>
																			</li>
																			<li class="friend">
																				<div class="msg">Good, I'll need support with my pc</div>
																			</li>
																			<li class="self">
																				<div class="msg">Sure, just tell me what is going on with your computer?</div>
																			</li>
																			<li class="friend">
																				<div class="msg">I don't know it just turns off suddenly</div>
																			</li> -->
																		</ul>
																	</div>
																</div>
															</div>
															<form class="frmEnviarMensaje" action="#" method="post">
																<div class="chat-input">
																	<div class="input-wrapper">
																		<span class="photo mdi mdi-camera"></span>
																		<input type="text" placeholder="Mensaje..." name="mensajeusuario" id="mensajeusuario">
																		<span id="enviarmensaje" class="mdi mdi-mail-send"></span>
																	</div>
																</div>
															</form>
														</div>
													</div>
													<div id="tab2" role="tabpanel" class="tab-pane tab-todo">
														<div class="todo-container">
															<div class="todo-wrapper">
																<div class="be-scroller">
																	<div class="todo-content"><span class="category-title">Today</span>
																		<ul class="todo-list">
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Initialize the project</span>
																				</label>
																			</li>
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
																				</label>
																			</li>
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Updates changes to GitHub							</span>
																				</label>
																			</li>
																		</ul><span class="category-title">Tomorrow</span>
																		<ul class="todo-list">
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Initialize the project							</span>
																				</label>
																			</li>
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
																				</label>
																			</li>
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Updates changes to GitHub							</span>
																				</label>
																			</li>
																			<li>
																				<label class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
																					<input type="checkbox" class="custom-control-input"><span title="This task is too long to be displayed in a normal space!" class="custom-control-label">This task is too long to be displayed in a normal space!							</span>
																				</label>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
															<div class="bottom-input">
																<input type="text" placeholder="Create new task..." name="q"><span class="mdi mdi-plus"></span>
															</div>
														</div>
													</div>
													<div id="tab3" role="tabpanel" class="tab-pane tab-settings">
														<div class="settings-wrapper">
															<div class="be-scroller"><span class="category-title">General</span>
																<ul class="settings-list">
																	<li>
																		<div class="switch-button switch-button-sm">
																			<input type="checkbox" checked="" name="st1" id="st1"><span>
																				<label for="st1"></label></span>
																			</div><span class="name">Disponible</span>
																		</li>
																		<li>
																			<div class="switch-button switch-button-sm">
																				<input type="checkbox" checked="" name="st2" id="st2"><span>
																					<label for="st2"></label></span>
																				</div><span class="name">Habilitar notificaciones</span>
																			</li>
																		</ul><span class="category-title">Notificaciones</span>
																		<ul class="settings-list">
																			<li>
																				<div class="switch-button switch-button-sm">
																					<input type="checkbox" name="st4" id="st4"><span>
																						<label for="st4"></label></span>
																					</div><span class="name">Nuevos email</span>
																				</li>
																				<li>
																					<div class="switch-button switch-button-sm">
																						<input type="checkbox" name="st7" id="st7"><span>
																							<label for="st7"></label></span>
																						</div><span class="name">Mensajes de chat</span>
																					</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</nav>
<?php
}else{
?>
    <div class="be-wrapper be-mega-menu">
      <nav class="navbar navbar-expand fixed-top be-top-header">
        <div class="container-fluid">
          <div class="be-navbar-header"></a>
						<a href="<?php echo $ruta;?>php/inicio/calendario/inicio.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $ruta; ?>media/images/logo_hemusa.png" alt="logo" width="160" height="60" class="logo-img"></a>
          </div>
					<div class="be-right-navbar">
						<ul class="nav navbar-nav float-right be-user-nav">
							<li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><img src="<?php echo $ruta; ?>assets/img/<?php echo $avatar; ?>" alt="Avatar"><span class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></span></a>
								<div role="menu" class="dropdown-menu">
									<div class="user-info">
										<div class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></div>
										<div class="user-position online">Disponible</div>
									</div>
									<a href="<?php echo $ruta;?>php/inicio/perfil/perfil.php" class="dropdown-item"><span class="icon mdi mdi-face"></span> Cuenta</a>
									<a href="<?php echo $ruta;?>php/inicio/configuracion/configuracion.php" class="dropdown-item"><span class="icon mdi mdi-settings"></span> Configuración</a>
									<a href="../../../index.php" class="dropdown-item"><span class="icon mdi mdi-power"></span> Cerrar sesión</a>
								</div>
							</li>
						</ul>
            <!-- <ul class="nav navbar-nav float-right be-icons-nav">
              <li class="nav-item dropdown"><a class="nav-link be-toggle-right-sidebar" href="#" role="button" aria-expanded="false"><span class="icon mdi mdi-settings"></span></a></li>
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                <ul class="dropdown-menu be-notifications">
                  <li>
                    <div class="title">Notifications<span class="badge badge-pill">3</span></div>
                    <div class="list">
                      <div class="be-scroller">
                        <div class="content">
                          <ul>
                            <li class="notification notification-unread"><a href="#">
                                <div class="image"><img src="assets/img/avatar2.png" alt="Avatar"></div>
                                <div class="notification-info">
                                  <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                                </div></a></li>
                            <li class="notification"><a href="#">
                                <div class="image"><img src="assets/img/avatar3.png" alt="Avatar"></div>
                                <div class="notification-info">
                                  <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                </div></a></li>
                            <li class="notification"><a href="#">
                                <div class="image"><img src="assets/img/avatar4.png" alt="Avatar"></div>
                                <div class="notification-info">
                                  <div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
                                </div></a></li>
                            <li class="notification"><a href="#">
                                <div class="image"><img src="assets/img/avatar5.png" alt="Avatar"></div>
                                <div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all notifications</a></div>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-apps"></span></a>
                <ul class="dropdown-menu be-connections">
                  <li>
                    <div class="list">
                      <div class="content">
                        <div class="row">
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/github.png" alt="Github"><span>GitHub</span></a></div>
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/bitbucket.png" alt="Bitbucket"><span>Bitbucket</span></a></div>
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/slack.png" alt="Slack"><span>Slack</span></a></div>
                        </div>
                        <div class="row">
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/dribbble.png" alt="Dribbble"><span>Dribbble</span></a></div>
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/mail_chimp.png" alt="Mail Chimp"><span>Mail Chimp</span></a></div>
                          <div class="col"><a class="connection-item" href="#"><img src="assets/img/dropbox.png" alt="Dropbox"><span>Dropbox</span></a></div>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">More</a></div>
                  </li>
                </ul>
              </li>
            </ul> -->
          </div>
        </div>
      </nav>
      <nav class="navbar navbar-expand-lg be-sub-header row justify-content-center">
        <div class="col-8" style="padding: 10px 20px 0;">
          <!--+mega-menu('dashboard1','home')-->
                <!-- Mega Menu structure-->
                <nav class="navbar navbar-expand-md">
                  <button class="navbar-toggler hidden-md-up collapsed" type="button" data-toggle="collapse" data-target="#be-mega-menu-collapse" aria-controls="#be-mega-menu-collapse" aria-expanded="false" aria-label="Toggle navigation"><a class="mega-menu-toggle" href="#">Mega Menu</a></button>
                  <div class="navbar-collapse collapse be-nav-tabs" id="be-mega-menu-collapse">
                    <ul class="nav navbar-nav">
                      <li id="home-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon mdi mdi-home"></span><span>Home</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
                            <li class="nav-item"><a id="calendario-menu" class="nav-link" href="<?php echo $ruta; ?>php/inicio/calendario/inicio.php"><i class="icon fas fa-calendar-alt"></i><span>Calendario</span></a>
                            </li>
                        </ul>
                      </li>
	                    <li id="ventas-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon fas fa-dollar-sign"></span><span>Ventas</span></a>
	                      <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item"><a id="clientes-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/clientes/clientes.php"><i class="fas fa-address-book"></i> Clientes</a>
													</li>
													<li class="nav-item"><a id="listaprecios-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/listadeprecios/listadeprecios.php"><i class="fas fa-list-alt"></i> Lista de precios</a>
													</li>
													<li class="nav-item"><a id="cotizaciones-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/cotizaciones/cotizaciones.php"><i class="fas fa-file-alt"></i> Cotizaciones</a>
													</li>
													<li class="nav-item"><a id="pedidos-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/pedidos/pedidos.php"><i class="far fa-file-alt"></i> Pedidos</a>
													</li>
	                      </ul>
	                    </li>
                      <li id="compras-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon fas fa-shopping-cart"></span><span>Compras</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item"><a id="proveedores-menu" class="nav-link" href="<?php echo $ruta; ?>php/compras/proveedores/proveedores.php"><i class="fas fa-address-book"></i> Proveedores</a>
													</li>
													<li class="nav-item"><a id="ordenesdecompras-menu" class="nav-link" href="<?php echo $ruta; ?>php/compras/ordenesdecompras/ordenesdecompras.php"><i class="fas fa-cart-arrow-down"></i> Ordenes de compras</a>
													</li>
													<!-- <li class="nav-item"><a id="backorder-menu" class="nav-link" href="<?php echo $ruta; ?>php/compras/ordenesdecompras/backorder.php"><i class="fas fa-clipboard-list"></i> Backorder</a>
													</li> -->
                        </ul>
                      </li>
                      <li id="logistica-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon fas fa-cubes"></span><span>Logística</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item"><a id="pedimentos-menu" class="nav-link" href="<?php echo $ruta; ?>php/logistica/pedimentos/pedimentos.php"><i class="fas fa-warehouse"></i> Pedimentos</a>
													</li>
													<li class="nav-item"><a id="controldesalida-menu" class="nav-link" href="<?php echo $ruta; ?>php/logistica/controldesalida/controldesalida.php"><i class="fas fa-dolly"></i> Control de salida</a>
													</li>
													<li class="nav-item"><a id="ordenesdecompraslogisitca-menu" class="nav-link" href="<?php echo $ruta; ?>php/logistica/ordenesdecompras/descripcionPedido.php"><i class="fas fa-cart-arrow-down"></i> Ordenes de compras</a>
													</li>
                        </ul>
                      </li>
                      <li id="cobranza-menu" class="nav-item parent"><a class="nav-link" href="" role="button" aria-expanded="false"><span class="icon fas fa-credit-card"></span><span>Créditos y cobranza</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item dropdown parent"><a id="pagoscliente-menu" class="nav-link" href="#" data-toggle="dropdown"><i class="fab fa-cc-amazon-pay"></i> Pagos de cliente</a>
														<div class="dropdown-menu be-sub-nav" role="menu">
			                        <a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/pagoscliente/pagospendientes.php">Consultar pendientes</a>
															<a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/pagoscliente/informacionfactura.php">Información de factura</a>
															<a class="dropdown-item" href="<?php echo $ruta; ?>php/cobranza/pagoscliente/notacredito.php">Nota de crédito</a>
			                      </div>
													</li>
													<li class="nav-item"><a id="pagosproveedor-menu" class="nav-link" href="<?php echo $ruta; ?>php/cobranza/pagos/pagosproveedor.php"><i class="fab fa-cc-amazon-pay"></i> Pagos a proveedor</a>
													</li>
													<li class="nav-item dropdown parent"><a id="reportes-menu" class="nav-link" href="" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> Reportes</a>
														<div class="dropdown-menu be-sub-nav" role="menu">
			                        <a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/reportes/reporteventas.php">Reporte de ventas</a>
															<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/reportes/reportecobranza.php">Reporte de cobranza</a>
			                      </div>
													</li>
                        </ul>
                      </li>
											<li id="facturacion-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon fas fa-file-alt"></span><span>Facturación</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item"><a id="remisiones-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/remisiones/remisiones.php"><i class="fas fa-file"></i> Remisiones</a>
													</li>
													<li class="nav-item"><a id="embarques-menu" class="nav-link" href="<?php echo $ruta; ?>php/ventas/embarques/embarques.php"><i class="fas fa-dolly"></i> Embarques</a>
													</li>
													<li class="nav-item"><a id="facturas-menu" class="nav-link" href="<?php echo $ruta; ?>php/facturacion/facturas/facturas.php"><i class="fas fa-file-alt"></i> Facturas</a>
													</li>
                        </ul>
                      </li>
											<li id="administracion-menu" class="nav-item parent"><a class="nav-link" href="#" role="button" aria-expanded="false"><span class="icon fas fa-unlock-alt"></span><span>Administración</span></a>
                        <ul class="be-nav-tabs-sub be-sub-nav nav">
													<li class="nav-item"><a id="usuarios-menu" class="nav-link" href="<?php echo $ruta; ?>php/administracion/usuarios/usuarios.php"><i class="fas fa-users-cog"></i> Usuarios</a>
													</li>
													<li class="nav-item"><a id="marcas-menu" class="nav-link" href="<?php echo $ruta; ?>php/administracion/marcas/marcas.php"><i class="fas fa-wrench"></i> Marcas</a>
													</li>
													<li class="nav-item"><a id="kardex-menu" class="nav-link" href="<?php echo $ruta; ?>php/administracion/kardex/kardex.php"><i class="fas fa-list-alt"></i> Kárdex</a>
													</li>
													<li class="nav-item"><a id="subirlista-menu" class="nav-link" href="<?php echo $ruta; ?>php/administracion/marcas/subirlista.php"><i class="fas fa-th-list"></i> Subir lista de precios</a>
													</li>
													<!-- <li class="nav-item"><a id="query-menu" class="nav-link" href="<?php echo $ruta; ?>php/administracion/query/query.php">Query</a>
													</li> -->
													<li class="nav-item dropdown parent"><a id="reportes-menu" class="nav-link" href="" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> Reportes</a>
														<div class="dropdown-menu be-sub-nav" role="menu">
			                        <a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/reportes/reporteventas.php">Reporte de ventas</a>
															<a class="dropdown-item" href="<?php echo $ruta; ?>php/administracion/reportes/reportecobranza.php">Reporte de cobranza</a>
			                      </div>
													</li>
                        </ul>
                      </li>
											<li id="email-menu" class="nav-item parent"><a class="nav-link" href="<?php echo $ruta; ?>php/email/email.php"><i class="icon fas fa-envelope"></i><span>Email</span><span class="badge badge-primary float-right">BETA</span></a></li>
                      </li>
											<li id="galeria-menu" class="nav-item parent"><a class="nav-link" href="<?php echo $ruta; ?>php/galeria/galeria.php"><i class="icon fas fa-images"></i><span>Galería</span><span class="badge badge-primary float-right">BETA</span></a></li>
                      </li>
                    </ul>
                  </li>
              </ul>
            </div>
          </nav>
        </div>
      </nav>
    </div>
<?php
}
?>
