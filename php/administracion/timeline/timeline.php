<?php
	require_once('../../conexion.php');
	require_once('../../sesion.php');
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Timeline</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>
	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title">Timeline</h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
	                    <li class="breadcrumb-item"><a href="#">Timeline</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
                            <form action="#" method="post">
                              <input type="hidden" name="opcion" id="opcion" value="movimientosusuarios">
                              <div class="row table-filters-container">
                                <div class="col-12">
                                  <div class="row align-items-end">
                                    <div class="col-3 table-filters"><span class="table-filter-title">Fecha</span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-6">
                                            <label class="control-label">Inicio</label>
                                            <div class="input-group date datetimepicker" data-link-field="dtp_input1">
                                              <input class="form-control form-control-sm" size="16" type="text" value="" name="fechainicio" id="fechainicio" required>
                                              <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-6">
                                            <label class="control-label">Fin</label>
                                            <div class="input-group date datetimepicker" data-link-field="dtp_input1">
                                              <input class="form-control form-control-sm" size="16" type="text" value="" name="fechafin" id="fechafin" required>
                                              <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-2 table-filters"><span class="table-filter-title">Departamento</span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-12">
                                            <label class="control-label"></label>
                                            <select class="form-control form-control-sm select2" name="departamento" id="departamento" required>
                                              <option value="todos">Todos</option>
                                              <option value="ventas">Ventas</option>
                                              <option value="compras">Compras</option>
                                              <option value="logistica">Logística</option>
                                              <option value="cobranza">Crédito y cobranza</option>
                                              <option value="facturacion">Facturación</option>
                                              <option value="administracion">Administración</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-1 table-filters"><span class="table-filter-title"></span>
                                      <div class="filter-container">
                                        <div class="row">
                                          <div class="col-12">
                                            <button type="submit" name="button" class="btn btn-lg btn-primary">Buscar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                      		</div>
                    	</div>
                      <div class="row">
                        <div class="col-12">
                          <ul id="items-timeline" class="timeline timeline-variant">
                            <li class="timeline-item timeline-item-detailed left">
                              <div class="timeline-content timeline-type comment">
                                <div class="timeline-icon"><i class="icon fa-comment-alt"></i></div>
                                <div class="timeline-avatar"><img class="circle" src="<?php echo $ruta;?>assets/img/avatar.png" alt="Avatar"></div>
                                <div class="timeline-header"><span class="timeline-autor">Kristopher Donny  </span>
                                  <p class="timeline-activity">Mauris condimentum est <a href="#">Viverra erat fermentum</a>.</p><span class="timeline-time">September 13, 2018 - 9:54 AM</span>
                                </div>
                                <div class="timeline-summary">
                                  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus sit amet tellus vel leo posuere fames commodo in eget ante. Vivamus vehicula sed velit at pulvinar.  </p>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-item-detailed right">
                              <div class="timeline-content timeline-type gallery">
                                <div class="timeline-icon"><i class="icon fas fa-image"></i></div>
                                <div class="timeline-avatar"><img class="circle" src="<?php echo $ruta;?>assets/img/avatar3.png" alt="Avatar"></div>
                                <div class="timeline-header"><span class="timeline-autor">Sherwood Clifford  </span>
                                  <p class="timeline-activity">pellentesque tortor <a href="#">enim</a>.</p><span class="timeline-time">August 23, 2018 - 10:42 AM</span>
                                </div>
                                <div class="timeline-gallery"><img class="gallery-thumbnail" src="<?php echo $ruta;?>assets/img/gallery/img2.jpg" alt="Thumbnail"><img class="gallery-thumbnail" src="<?php echo $ruta;?>assets/img/gallery/img4.jpg" alt="Thumbnail"><img class="gallery-thumbnail" src="<?php echo $ruta;?>assets/img/gallery/img11.jpg" alt="Thumbnail"><img class="gallery-thumbnail" src="<?php echo $ruta;?>assets/img/gallery/img12.jpg" alt="Thumbnail"></div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-item-detailed left">
                              <div class="timeline-content timeline-type comment">
                                <div class="timeline-icon"><i class="icon fa-comment-alt"></i></div>
                                <div class="timeline-avatar"><img class="circle" src="<?php echo $ruta;?>assets/img/avatar4.png" alt="Avatar"></div>
                                <div class="timeline-header"><span class="timeline-autor">Benji Harper </span>
                                  <p class="timeline-activity">Mauris condimentum est <a href="#">Vestibulum justo neque</a>.</p><span class="timeline-time">August 19, 2018 - 7:15 PM</span>
                                </div>
                                <div class="timeline-summary">
                                  <p>Praesent luctus efficitur turpis, nec convallis mauris commodo a. Aliquam sed consectetur tellus, et condimentum diam. Sed efficitur augue urna, et lacinia ex dictum at. Nulla a molestie arcu. </p>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-loadmore"><a class="load-more-btn" href="#">Load more</a></li>
                          </ul>
                        </div>
                      </div>
                	</div>
            	</div>
      		</div>
    	</div>
    <header>
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
      listar();
		});

		function nav_active () {
      $(".nav-item").removeClass("open section-active");
      $("#administracion-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#timeline-menu").addClass("active");
    }

    function listar() {
      $("form").on("submit", function (e) {
        e.preventDefault();
        var frm = $(this).serialize();
        console.log(frm);
        $.ajax({
          method: "POST",
          url: "listar.php",
          dataType: "json",
          data: frm,
        }).done( function (data) {
          var total = data.data.length;
          var posicion = "right";
          $("#items-timeline").html("");
          for (var i = 0; i < data.data.length; i++) {
            if (posicion == "right"){
              $("#items-timeline").append('<li class="timeline-item timeline-item-detailed right"><div class="timeline-content timeline-type '+data.data[i].color+'"><div class="timeline-icon">'+data.data[i].icono+'</div><div class="timeline-avatar"><img class="circle" src="<?php echo $ruta;?>assets/img/'+data.data[i].avatar+'" alt="Avatar"></div><div class="timeline-header"><span class="timeline-autor">'+data.data[i].usuario+'  </span><p class="timeline-activity"> - '+data.data[i].departamento+' </p><span class="timeline-time">'+data.data[i].fechahora+'</span></div><div class="timeline-summary"><p>'+data.data[i].descripcion+'</p></div></div></li>');
              posicion = "left";
            }else{
              $("#items-timeline").append('<li class="timeline-item timeline-item-detailed left"><div class="timeline-content timeline-type '+data.data[i].color+'"><div class="timeline-icon">'+data.data[i].icono+'</i></div><div class="timeline-avatar"><img class="circle" src="<?php echo $ruta;?>assets/img/'+data.data[i].avatar+'" alt="Avatar"></div><div class="timeline-header"><span class="timeline-autor">'+data.data[i].usuario+'  </span><p class="timeline-activity"> - '+data.data[i].departamento+' </p><span class="timeline-time">'+data.data[i].fechahora+'</span></div><div class="timeline-summary"><p>'+data.data[i].descripcion+'</p></div></div></li>');
              posicion = "right";
            }
          }
          console.log(data);
        });
      });
    }

	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
