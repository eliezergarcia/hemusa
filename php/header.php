<?php
	if ($tipomenu == 1) {
		echo '<header id="header-menu" class="be-wrapper be-fixed-sidebar be-color-header">';
		echo '<nav id="nav-menu" class="navbar navbar-expand fixed-top be-top-header">';
	}else if ($tipomenu == 2) {
		echo '<header id="header-menu" class="be-wrapper be-collapsible-sidebar be-collapsible-sidebar-collapsed be-color-header">';
		echo '<nav id="nav-menu" class="navbar navbar-expand fixed-top be-top-header">';
	}else if ($tipomenu == 3){
		echo '<div class="be-wrapper be-offcanvas-menu be-fixed-sidebar be-color-header">';
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
	      	<a href="<?php echo $ruta;?>php/inicio/inicio.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $ruta; ?>media/images/logo_hemusa.png" alt="logo" width="160" height="60" class="logo-img"></a>
	      </div>
	      <div class="be-right-navbar">
	        <ul class="nav navbar-nav float-right be-user-nav">
	          <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><img src="<?php echo $ruta; ?>assets/img/eliezerhernandez.jpg" alt="Avatar"><span class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></span></a>
	            <div role="menu" class="dropdown-menu">
	              <div class="user-info">
	                <div class="user-name"><?php echo $usuario." ".$usuarioApellido; ?></div>
	                <div class="user-position online">Disponible</div>
	              </div>
	              	<a href="<?php echo $ruta;?>php/perfil.php" class="dropdown-item"><span class="icon mdi mdi-face"></span> Cuenta</a>
	              	<a href="#" class="dropdown-item"><span class="icon mdi mdi-settings"></span> Configuración</a>
	              	<a href="<?php echo $logoutGoTo; ?>" class="dropdown-item"><span class="icon mdi mdi-power"></span> Cerrar sesión</a>
	            </div>
	          </li>
	        </ul>
	        <ul class="nav navbar-nav float-right be-icons-nav">
	          <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
	            <ul class="dropdown-menu be-notifications">
	              <li>
	                <div class="title">Notificaciones<span class="badge badge-pill">3</span></div>
	                <div class="list">
	                  <div class="be-scroller">
	                    <div class="content">
	                      <ul>
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
	           <li class="nav-item dropdown"><a href="#" role="button" aria-expanded="false" class="nav-link be-toggle-right-sidebar"><span class="icon mdi mdi-comments"></span></a></li>
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
	        </ul>
	      </div>
	    </div>
	</nav>
	<div class="be-left-sidebar">
	    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menú</a>
	      <div class="left-sidebar-spacer">
	        <div class="left-sidebar-scroll">
	          <div class="left-sidebar-content">
	            <ul class="sidebar-elements">
	              <li class="divider">Menu</li>
	              <li class=""><a href="<?php echo $ruta; ?>php/inicio/inicio.php"><i class="icon fas fa-home"></i><span>Inicio</span></a>
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
                      <li><a href="<?php echo $ruta; ?>php/compras/pedimentos/pedimentos.php"><i class="fas fa-warehouse"></i> Pedimentos</a>
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
                    </ul>
                  </li>
	              <li class="divider">Features</li>
	              <li class="parent"><a href="#"><i class="icon fas fa-envelope"></i><span>Email</span></a>
	                <ul class="sub-menu">
	                  <li><a href="email-inbox.html">Inbox</a>
	                  </li>
	                  <li><a href="email-read.html">Email Detail</a>
	                  </li>
	                  <li><a href="email-compose.html">Email Compose</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="parent"><a href="#"><i class="icon mdi mdi-view-web"></i><span>Layouts</span></a>
	                <ul class="sub-menu">
	                  <li><a href="layouts-primary-header.html">Primary Header</a>
	                  </li>
	                  <li><a href="layouts-success-header.html">Success Header</a>
	                  </li>
	                  <li><a href="layouts-warning-header.html">Warning Header</a>
	                  </li>
	                  <li><a href="layouts-danger-header.html">Danger Header</a>
	                  </li>
	                  <li><a href="layouts-search-input.html"><span class="badge badge-primary float-right">New</span>Search Input</a>
	                  </li>
	                  <li><a href="layouts-offcanvas-menu.html"><span class="badge badge-primary float-right">New</span>Off Canvas Menu</a>
	                  </li>
	                  <li><a href="layouts-nosidebar-left.html">Without Left Sidebar</a>
	                  </li>
	                  <li><a href="layouts-nosidebar-right.html">Without Right Sidebar</a>
	                  </li>
	                  <li><a href="layouts-nosidebars.html">Without Both Sidebars</a>
	                  </li>
	                  <li><a href="layouts-fixed-sidebar.html">Fixed Left Sidebar</a>
	                  </li>
	                  <li><a href="layouts-boxed-layout.html"><span class="badge badge-primary float-right">New</span>Boxed Layout</a>
	                  </li>
	                  <li><a href="pages-blank-aside.html">Page Aside</a>
	                  </li>
	                  <li><a href="layouts-collapsible-sidebar.html">Collapsible Sidebar</a>
	                  </li>
	                  <li><a href="layouts-sub-navigation.html"><span class="badge badge-primary float-right">New</span>Sub Navigation</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="parent"><a href="#"><i class="icon fas fa-map"></i><span>Maps</span></a>
	                <ul class="sub-menu">
	                  <li><a href="maps-google.html">Google Maps</a>
	                  </li>
	                  <li><a href="maps-vector.html">Vector Maps</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="parent"><a href="#"><i class="icon fas fa-bars"></i><span>Menu Levels</span></a>
	                <ul class="sub-menu">
	                  <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 1</span></a>
	                    <ul class="sub-menu">
	                      <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
	                      </li>
	                      <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
	                        <ul class="sub-menu">
	                          <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
	                          </li>
	                          <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
	                          </li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </li>
	                  <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 1</span></a>
	                    <ul class="sub-menu">
	                      <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
	                      </li>
	                      <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
	                        <ul class="sub-menu">
	                          <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
	                          </li>
	                          <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
	                          </li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </li>
	                </ul>
	              </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="progress-widget">
	        <div class="progress-data"><span class="progress-value">60%</span><span class="name">Current Project</span></div>
	        <div class="progress">
	          <div style="width: 60%;" class="progress-bar progress-bar-primary"></div>
	        </div>
	      </div>
	    </div>
    </div>
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
                      <div class="contact-list contact-list-recent">
                        <div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar1.png" alt="Avatar">
                            <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                        <div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar2.png" alt="Avatar">
                            <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                        <div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar3.png" alt="Avatar">
                            <div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div>
                      </div>
                      <h2>Contactos</h2>
                      <div class="contact-list">
                        <?php 
                            $query = "SELECT * FROM usuarios";
                            $resultado = mysqli_query($conexion_usuarios, $query);
                            while($data = mysqli_fetch_assoc($resultado)){
                        ?>
                            <div class="user"><a href="#"><img src="<?php echo $ruta; ?>assets/img/avatar4.png" alt="Avatar">
                            <div class="user-data2"><span class="status"></span><span class="name"><?php echo $data['nombre']." ".$data["apellidos"]; ?></span></div></a></div> 
                        <?php
                            }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bottom-input">
                  <input type="text" placeholder="Search..." name="q"><span class="mdi mdi-search"></span>
                </div>
              </div>
              <div class="chat-window">
                <div class="title">
                  <div class="user"><img src="assets/img/avatar2.png" alt="Avatar">
                    <h2>Maggie jackson</h2><span>Active 1h ago</span>
                  </div><span class="icon return mdi mdi-chevron-left"></span>
                </div>
                <div class="chat-messages">
                  <div class="be-scroller">
                    <div class="content">
                      <ul>
                        <li class="friend">
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
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="chat-input">
                  <div class="input-wrapper"><span class="photo mdi mdi-camera"></span>
                    <input type="text" placeholder="Message..." name="q" autocomplete="off"><span class="send-msg mdi mdi-mail-send"></span>
                  </div>
                </div>
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
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st3" id="st3"><span>
                          <label for="st3"></label></span>
                      </div><span class="name">Login con Facebook</span>
                    </li>
                  </ul><span class="category-title">Notificaciones</span>
                  <ul class="settings-list">
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st4" id="st4"><span>
                          <label for="st4"></label></span>
                      </div><span class="name">Notificaciones de email</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st5" id="st5"><span>
                          <label for="st5"></label></span>
                      </div><span class="name">Actualizaciones de proyectp</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st6" id="st6"><span>
                          <label for="st6"></label></span>
                      </div><span class="name">Nuevos comentarios</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st7" id="st7"><span>
                          <label for="st7"></label></span>
                      </div><span class="name">Mensajes de chat</span>
                    </li>
                  </ul><span class="category-title">Flujo de trabajo</span>
                  <ul class="settings-list">
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st8" id="st8"><span>
                          <label for="st8"></label></span>
                      </div><span class="name">Implementar en commit</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
