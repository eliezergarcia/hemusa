<?php
  require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
  require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Cotizaciones</title>
  <?php include('../../enlacescss.php'); ?>
</head>
<body>
  <?php include('../../header.php'); ?>
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="user-profile">
          <div class="row">
            <!-- <div class="col-lg-12"> -->
              <div class="user-display">
                <div class="user-display-bg"><img src="../../../assets/img/gallery/img-1.png" alt="Profile Background" style="margin-top: -300px;"></div>
                <div class="user-display-bottom">
                  <div class="user-display-avatar"><img src="../../../assets/img/eliezerhernandez.jpg" alt="Avatar"></div>
                  <div class="user-display-info">
                    <div class="name" style="font-size: 20px;"><?php echo $usuariologin; ?></div>
                    <div class="nick"><span class="mdi mdi-account"></span> <?php echo $user; ?></div>
                  </div>
                  <!-- <div class="row user-display-details justify-content-between">
                    <div class="col">
                      <div class="title">Issues</div>
                      <div class="counter">26</div>
                    </div>
                    <div class="col">
                      <div class="title">Commits</div>
                      <div class="counter">26</div>
                    </div>
                    <div class="col">
                      <div class="title">Followers</div>
                      <div class="counter">26</div>
                    </div>
                  </div> -->
                </div>
              </div>
            <div class="user-info-list card col-7">
              <div class="card-header card-header-divider">Información de usuario<span class="card-subtitle">I am a web developer and designer based in Montreal - Canada, I like read books, good music and nature.</span></div>
                <div class="card-body" style="padding: 0px 20px;">
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-id-card fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Nombre completo</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-briefcase fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Departamento</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-envelope fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">E-mail</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-mobile-alt fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Celular</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-globe fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Ubicación</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-hospital fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">IMSS</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-heart fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Tipo de sangre</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-birthday-cake fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Cumpleaños</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col row">
                      <i class="fas fa-mars-double fa-2x col-2"> </i>
                      <h4 style="margin-top: 5px; padding-left: 10px;">Género</h4>
                    </div>
                    <div class="col row">
                      <input type="text" name="" class="form-control form-control-sm col-10 input2" value="">
                      <i class="fas fa-pencil-alt fa-lg" style="margin-top: 15px; padding-left: 30px;"></i>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-5">
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
                        <td class="user-avatar"> <img src="../../../assets/img/avatar6.png" alt="Avatar">Penelope Thornton</td>
                        <td>Initial commit</td>
                        <td>Aug 6, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar4.png" alt="Avatar">Benji Harper</td>
                        <td>Main structure markup</td>
                        <td>Jul 28, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar5.png" alt="Avatar">Justine Myranda</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar3.png" alt="Avatar">Sherwood Clifford</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar.png" alt="Avatar">Kristopher Donny</td>
                        <td>Left sidebar adjusments</td>
                        <td>Jul 15, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                      <tr>
                        <td class="user-avatar"> <img src="../../../assets/img/avatar2.png" alt="Avatar">Adeline Shepherd</td>
                        <td>Topbar dropdown style</td>
                        <td>Jun 30, 2015</td>
                        <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <!-- </div> -->
          <!-- </div> -->
          <!-- <div class="row">
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
            </div> -->
            <!-- <div class="col-lg-6">
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
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </header>
    <?php include('../../enlacesjs.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	App.init();
      	App.pageProfile();
        App.chat();
      });
    </script>
  </body>
</html>
