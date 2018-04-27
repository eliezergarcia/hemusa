<?php 
  include("../../header.php");
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
  
  <!-- Buttons DataTables -->
  <link rel="stylesheet" href="css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
    <div class="row fondo">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <h1 class="text-center">Información Bancaria</h1>
    </div>
  </div>
  <?php
    // In PHP earlier then 4.1.0, $HTTP_POST_FILES  should be used instead of $_FILES.
    $id = $_REQUEST["id"];
    $nombreEmpresa = $_REQUEST["nombreEmpresa"];
    $personaContacto = $_REQUEST["personaContacto"];
    $calle = $_REQUEST["calle"];
    $ciudad = $_REQUEST["ciudad"];
    $estado = $_REQUEST["estado"];
    $cp = $_REQUEST["cp"];
    $pais = $_REQUEST["pais"];
    $tlf1 = $_REQUEST["tlf1"];
    $tlf2 = $_REQUEST["tlf2"];
    $fax = $_REQUEST["fax"];
    $movil = $_REQUEST["movil"];
    $correoElectronico = $_REQUEST["correoElectronico"];
    $paginaWeb = $_REQUEST["paginaWeb"];
    $tipo = $_REQUEST["tipo"];
    $agregar = $_REQUEST["agregar"];
    $edit = $_REQUEST["edit"];
    $delete = $_REQUEST["delete"];
    $palabraBusca = $_REQUEST["palabraBusca"];
    $buscar = $_REQUEST["buscar"];
  ?>
  <?php
   $today = getdate(); 
   $fecha = $today[mday]."/".$today[mon]."/".$today[year];
   require_once('../incl/connect.php');

   $insertSQL="SELECT * FROM Contactos WHERE id=".$id;
   $result = mysql_query($insertSQL);
   while ($row = mysql_fetch_array($result)) {
      if ($row['category']==$cat || $cat=='') {
         echo "<tr height='970'>";
         echo "<td valign='top'>";
         echo "<img src='../cotizaciones/pics/HEMUSA.bmp'  width='658pt' height='60pt' />";
         echo "<br><center><b>R.F.C.: HMU-810909-370</b></center>";
         echo "<p align=right>Monterrey - ".$fecha." &nbsp;</p><br><br>";
         echo strtoupper($row['nombreEmpresa']);
         echo "<BR>At´n: ".$row['personaContacto'];
         echo "<BR>Calle: ".$row['calle'];
         echo "<BR>Ciudad: ".$row['ciudad'];
         echo "<BR>Estado.: ".$row['estado'];
         echo "<BR>Fax: ".$row['fax'];
         echo "<BR>E-mail: ".$row['correoElectronico'];
         echo "<br><br>";        
         echo "Estimados Señores:<br>";
         echo "<br><br>";
         echo "Para cumplir las disposiciones relativas sobre Transferencias Electrónicas de Fondos Interbancarias derivadas de nuestras relaciones comerciales, favor de anotar los datos de la nuestras:<br>";
         echo "<br><table>";
         echo "<tr><td WIDTH='350'>BANCO NACIONAL DE MEXICO, S.A.<br>";
         echo "CUENTA 0621 0014371<br>";
         echo "SUCURSAL 0186 PINO SUAREZ<br>";
         echo "CLABE 002580062100143718<br>";
         echo "</td><td>";
         echo "BANAMEX Dlls<br>";
         echo "CUENTA 06219000578<br>";
         echo "SUCURSAL 0186 PINO SUAREZ <br>";
         echo "CLABE 002580062190005785<br>";
                                 echo "SWIFT CODE BNMXMXMM";
         echo "</td></tr><tr><td><br><br>";
         echo "BANCO MERCANTIL DEL NORTE, S.A.<br>";
         echo "CUENTA 13671593 3<br>";
         echo "SUCURSAL 0158 CUAUHTEMOC<br>";
         echo "CLABE 072580001367159332<br>";
         echo "</td><td></td></tr></table><br><br>";
         echo "En cualesquiera de estas Instituciones bancarias podrá realizar sus transferencias, solo les agradeceremos se sirvan comunicarnos el deposito, con el fin de contabilizarlo y mantener sus saldos al día.<br><br>";
         echo "Aprovechamos la oportunidad para reiterarles nuestro agradecimiento por su preferencia, y como siempre estamos a sus amables órdenes.<br>";
         echo "<br><br>";
         echo "<br><br>";
         echo "<br><b>Atentamente</b><br>";
                                                                 echo "<br><br>";
         echo "<br><b>_________________________</b><br>";
         echo "<b>CUENTAS POR COBRAR</b><br>";
         echo "<br><br>";
         echo "<b>Herramientas Mecánicas Universales, S.A. de C.V.</b><BR>";
         echo "<br><br>";
         echo "<br><br><center><i><b>¿SU PROBLEMA SON LAS HERRAMIENTAS? ¡LLAMENOS!</b></i></center>";
                 
         
         echo "</td></tr>";
      }
   }
   mysql_close($conn);
  ?>
  </div>
  <script src="js/jquery-1.12.3.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.js"></script>
  <!--botones DataTables--> 
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.bootstrap.min.js"></script>
  <!--Libreria para exportar Excel-->
  <script src="js/jszip.min.js"></script>
  <!--Librerias para exportar PDF-->
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <!--Librerias para botones de exportación-->
  <script src="js/buttons.html5.min.js"></script>
</body>
</html>