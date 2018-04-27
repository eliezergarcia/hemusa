<?php 
  require_once('php/conexion.php');   

  if (!isset($_SESSION)) {
    session_start();
  }

  $loginFormAction = $_SERVER['PHP_SELF'];

  if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
  }

  if (isset($_POST['user'])) {
    $loginUsername = $_POST['user'];
    $password = $_POST['password'];
    $MM_fldUserAuthorization = "";
    $MM_redirectLoginSuccess = "php/inicio/inicio.php";
    $MM_redirectLoginFailed = "index.php";
    $MM_redirecttoReferrer = false;

    mysqli_select_db($conexion_usuarios, $database_conexion_usuarios);
  
    $LoginRS__query=sprintf("SELECT user, password FROM usuarios WHERE user='%s' AND password='%s'", get_magic_quotes_gpc() ? 
      $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
    $LoginRS = mysqli_query($conexion_usuarios, $LoginRS__query) or die(mysqli_error());

    $loginFoundUser = mysqli_num_rows($LoginRS);

    if ($loginFoundUser) {
      $loginStrGroup = "";
      
      //declare two session variables and assign them
      $_SESSION['MM_Username'] = $loginUsername;
      $_SESSION['MM_UserGroup'] = $loginStrGroup;       

      if (isset($_SESSION['PrevUrl']) && false) {

        $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];  
      }

      header("Location: " . $MM_redirectLoginSuccess );

      }else{
        header("Location: ". $MM_redirectLoginFailed );
    }
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  
  <title>HEMUSA S.A de C.V</title>
  <?php include('php/enlaces.php'); ?>
</head>
<body>
  <div class="modal fade index" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
        </div>
        <div class="modal-body">
          <form class="" id="form_login" name="form_login" method="post" action="<?php echo $loginFormAction; ?>" >
          <div class="row form-group justify-content-center">
            <img src="imagenes/Hemusa.png" alt="" width="50%">  
          </div>
          <div class="row form-group justify-content-center">
            <p>Ingresa los datos de acceso de tu cuenta</p>
          </div>
          <div class="row form-group input-group justify-content-center">
            <input type="text" id="user" name="user" placeholder="Usuario" class="form-control col-8" required="">
          </div>
          <div class="row form-group input-group justify-content-center">
            <input type="password" id="pass" name="password" class="form-control col-8" placeholder="Contraseña" required="">
          </div>
        </div>
        <div class="modal-footer row justify-content-center">          
          <button type="submit" name="Submit" id="btn-submit" class="btn btn-primary form-control col-8" value="Ingresar">Ingresar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<script>
  $(document).on("ready", function(){
    $("#modalLogin").modal("show");
  });
</script>

