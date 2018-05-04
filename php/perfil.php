<?php
  require_once('conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
  
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Cotizaciones</title>
  <?php include('enlacescss.php'); ?>
</head>
<body>
  <?php include('header.php'); ?> 
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="user-profile">
          <div class="row">
            <div class="col-lg-5">
              <div class="user-display">
                <div class="user-display-bg"><img src="../assets/img/gallery/img3.jpg" alt="Profile Background"></div>
                <div class="user-display-bottom">
                  <div class="user-display-avatar"><img src="../assets/img/eliezerhernandez.jpg" alt="Avatar"></div>
                  <div class="user-display-info">
                    <div class="name"><?php echo $usuariologin; ?></div>
                    <div class="nick"><span class="mdi mdi-account"></span> <?php echo $user; ?></div>
                  </div>
                  <div class="row user-display-details">
                    <div class="col-4">
                      <div class="title">Issues</div>
                      <div class="counter">26</div>
                    </div>
                    <div class="col-4">
                      <div class="title">Commits</div>
                      <div class="counter">26</div>
                    </div>
                    <div class="col-4">
                      <div class="title">Followers</div>
                      <div class="counter">26</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="user-info-list card">
                <div class="card-header card-header-divider">Información de usuario<span class="card-subtitle">I am a web developer and designer based in Montreal - Canada, I like read books, good music and nature.</span></div>
                <div class="card-body">
                  <table class="no-border no-strip skills">
                    <tbody class="no-border-x no-border-y">
                      <tr>
                        <td class="icon"><span class="mdi mdi-case"></span></td>
                        <td class="item">Ocupation<span class="icon s7-portfolio"></span></td>
                        <td>Developer and designer</td>
                      </tr>
                      <tr>
                        <td class="icon"><span class="mdi mdi-cake"></span></td>
                        <td class="item">Birthday<span class="icon s7-gift"></span></td>
                        <td>16 September 1989</td>
                      </tr>
                      <tr>
                        <td class="icon"><span class="mdi mdi-smartphone-android"></span></td>
                        <td class="item">Mobile<span class="icon s7-phone"></span></td>
                        <td>(999) 999-9999</td>
                      </tr>
                      <tr>
                        <td class="icon"><span class="mdi mdi-globe-alt"></span></td>
                        <td class="item">Location<span class="icon s7-map-marker"></span></td>
                        <td>Montreal, Canada</td>
                      </tr>
                      <tr>
                        <td class="icon"><span class="mdi mdi-pin"></span></td>
                        <td class="item">Website<span class="icon s7-global"></span></td>
                        <td>www.website.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="widget widget-fullwidth widget-small">
                <div class="widget-head pb-6">
                  <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                  <div class="title">Actividad del departamento</div>
                </div>
                <div class="widget-chart-container">
                  <div id="bar-chart1" style="height: 180px;"></div>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th style="width:37%;">User</th>
                        <th style="width:36%;">Commit</th>
                        <th>Date</th>
                        <th class="actions"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar6.png" alt="Avatar">Penelope Thornton</td>
                        <td>Initial commit</td>
                        <td>Aug 6, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar4.png" alt="Avatar">Benji Harper</td>
                        <td>Main structure markup</td>
                        <td>Jul 28, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar5.png" alt="Avatar">Justine Myranda</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar3.png" alt="Avatar">Sherwood Clifford</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar.png" alt="Avatar">Kristopher Donny</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar2.png" alt="Avatar">Adeline Shepherd</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header card-header-divider">Current Progress<span class="card-subtitle">This is the user current progress widget</span></div>
                <div class="card-body">
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">Bootstrap Admin</span>
                      <div class="progress">
                        <div style="width: 78%" class="progress-bar bg-primary"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">78%</span></div>
                  </div>
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">Custom Work</span>
                      <div class="progress">
                        <div style="width: 57%" class="progress-bar bg-primary"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">57%</span></div>
                  </div>
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">Clients Module</span>
                      <div class="progress">
                        <div style="width: 45%" class="progress-bar bg-primary"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">45%</span></div>
                  </div>
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">Email Templates</span>
                      <div class="progress">
                        <div style="width: 36%" class="progress-bar bg-danger"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">36%</span></div>
                  </div>
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">Plans Module</span>
                      <div class="progress">
                        <div style="width: 30%" class="progress-bar bg-danger"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">30%</span></div>
                  </div>
                  <div class="row user-progress">
                    <div class="col-10"><span class="title">User Managemenet System</span>
                      <div class="progress">
                        <div style="width: 21%" class="progress-bar bg-danger"></div>
                      </div>
                    </div>
                    <div class="col-2 pl-0 pl-sm-3"><span class="value">21%</span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header card-header-divider">Latest Activity<span class="card-subtitle">This is a custom timeline widget</span></div>
                <div class="card-body">
                  <ul class="user-timeline">
                    <li class="latest">
                      <div class="user-timeline-date">Just Now</div>
                      <div class="user-timeline-title">Create New Page</div>
                      <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                    </li>
                    <li>
                      <div class="user-timeline-date">Today - 15:35</div>
                      <div class="user-timeline-title">Back Up Theme</div>
                      <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                    </li>
                    <li>
                      <div class="user-timeline-date">Yesterday - 10:41</div>
                      <div class="user-timeline-title">Changes In The Structure</div>
                      <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
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
                      <h2>Recent</h2>
                      <div class="contact-list contact-list-recent">
                        <div class="user"><a href="#"><img src="assets/img/avatar1.png" alt="Avatar">
                            <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                        <div class="user"><a href="#"><img src="assets/img/avatar2.png" alt="Avatar">
                            <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                        <div class="user"><a href="#"><img src="assets/img/avatar3.png" alt="Avatar">
                            <div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div>
                      </div>
                      <h2>Contacts</h2>
                      <div class="contact-list">
                        <div class="user"><a href="#"><img src="assets/img/avatar4.png" alt="Avatar">
                            <div class="user-data2"><span class="status"></span><span class="name">Mike Bolthort</span></div></a></div>
                        <div class="user"><a href="#"><img src="assets/img/avatar5.png" alt="Avatar">
                            <div class="user-data2"><span class="status"></span><span class="name">Maggie jackson</span></div></a></div>
                        <div class="user"><a href="#"><img src="assets/img/avatar6.png" alt="Avatar">
                            <div class="user-data2"><span class="status offline"></span><span class="name">Jhon Voltemar</span></div></a></div>
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
                      </div><span class="name">Available</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st2" id="st2"><span>
                          <label for="st2"></label></span>
                      </div><span class="name">Enable notifications</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st3" id="st3"><span>
                          <label for="st3"></label></span>
                      </div><span class="name">Login with Facebook</span>
                    </li>
                  </ul><span class="category-title">Notifications</span>
                  <ul class="settings-list">
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st4" id="st4"><span>
                          <label for="st4"></label></span>
                      </div><span class="name">Email notifications</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st5" id="st5"><span>
                          <label for="st5"></label></span>
                      </div><span class="name">Project updates</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" checked="" name="st6" id="st6"><span>
                          <label for="st6"></label></span>
                      </div><span class="name">New comments</span>
                    </li>
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st7" id="st7"><span>
                          <label for="st7"></label></span>
                      </div><span class="name">Chat messages</span>
                    </li>
                  </ul><span class="category-title">Workflow</span>
                  <ul class="settings-list">
                    <li>
                      <div class="switch-button switch-button-sm">
                        <input type="checkbox" name="st8" id="st8"><span>
                          <label for="st8"></label></span>
                      </div><span class="name">Deploy on commit</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
    <?php include('enlacesjs.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.pageProfile();
      });
    </script>
  </body>
</html>