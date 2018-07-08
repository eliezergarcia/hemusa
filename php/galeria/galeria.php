<?php
	require_once('../conexion.php');
	require_once('../sesion.php');
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Galería</title>
	<?php include('../enlacescss.php'); ?>
</head>
<body>
	<?php include('../header.php'); ?>
  <div class="be-content">
    <div class="page-head">
      <h2 class="page-head-title" style="font-size: 30px;"><b>Galería</b></h2>
    </div>
    <div class="main-content container-fluid">
      <div class="gallery-container">
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img1.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img1.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img2.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img2.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img3.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img3.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img4.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img4.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img5.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img5.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img6.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img6.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img7.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img7.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img8.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img8.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img9.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img9.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img10.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img10.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img11.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img11.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="photo">
            <div class="img"><img src="<?php echo $ruta; ?>assets/img/gallery/img12.jpg" alt="Gallery Image">
              <div class="over">
                <div class="info-wrapper">
                  <div class="info">
                    <div class="title">Boats On The Ocean</div>
                    <div class="date">Jun 23 2016</div>
                    <div class="description">Vestibulum lectus nulla, maximus in eros non, tristique consectetur.</div>
                    <div class="func"><a href="#"><i class="fas fa-link"></i></a><a href="<?php echo $ruta; ?>assets/img/gallery/img12.jpg" class="image-zoom"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header>
  <?php include('../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
		});

    $(window).on('load',function(){
      App.pageGallery();
    });

	</script>
</body>
</html>
