<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
$palabraBusca = $_REQUEST["palabraBusca"];
$refBusca = $_REQUEST["refBusca"];
$marca1 = $_REQUEST["marca1"];
$buscar = $_REQUEST["buscar"];
$delete = $_REQUEST["delete"];
$id = $_REQUEST["id"];
$ref = $_REQUEST["ref"];
$refold = $_REQUEST["refold"];
$descripcion = $_REQUEST["descripcion"];
$productor = $_REQUEST["productor"];
$precioBase = $_REQUEST["precioBase"];
$enReserva = $_REQUEST["enReserva"];

if (isset($enReserva)) {
   $refBusca=$refold;
	 $marca1=$productor;
	 $buscar='Buscar';
}

include "../incl/connect.incl";

$insertSQL = "SELECT IVA FROM `cifrasimportantes`";
$result = mysql_query($insertSQL);
$row = mysql_fetch_array($result);
$IVA = $row['IVA'];

    if ($ref!='') {
      $insertSQL = "update Precio".$productor." set ref='$ref' where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($descripcion!='') {
      $insertSQL = "update Precio".$productor." set descripcion='$descripcion' where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($precioBase!='') {
      $insertSQL = "update Precio".$productor." set precioBase=$precioBase where id='".$id."'";
      mysql_query($insertSQL);
    }
    if ($enReserva!='') {
      $insertSQL = "update Precio".$productor." set enReserva=$enReserva where id='".$id."'";
			mysql_query($insertSQL);
    }
    if ($productor!='') {
      $insertSQL = "update Precio".$productor." set productor='$productor' where id='".$id."'";
      mysql_query($insertSQL);
    }
  if (isset($delete))
  {
    $insertSQL = "delete from Precio".$productor." where id=$id";
    mysql_query($insertSQL);
  }  


 ?> 


<html>
<head>
<title>Listas de precios</title>
<link rel="stylesheet" type="text/css" href="print.css" />
</head>
<body onLoad="self.focus();document.total.palabraBusca.focus()">
<center><h1><b>HERRAMIENTAS MECANICAS UNIVERSALES S.A. de C.V.</b></h1>
<br />
<h3><b>01 DE ENERO DE 2004</b></h3>
<br />
<h2><b><a href="adm/factores.php">Listas de precios</a></b></h2>
<p></p>
<table border="1" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC" frame="border" summary="">
<tr valign="top"><td height="10"><div align="center">
<a href="ensenarPrecios.php?productor=Ampco&widthModelo=77&widthDescripcion=165&widthPrecioLista=45&widthPrecioIva=45">Ampco</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Apex&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">Apex</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=ATD&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">ATD</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Armstrong&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">ATD</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=ArmstrongAD&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">ATD</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Balta&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Balta</a><br/>
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Central&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Central</a><br />
<p></p></div></td><td><div align="center"><a href="ensenarPrecios.php?productor=Clark&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Clark Feather</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Cougar&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Cougar</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Craftsman&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Craftsman</a><br/><p></p></div></td><td><div align="center">
<a href="ensenarPrecios.php?productor=Eklind&widthModelo=60&widthDescripcion=180&widthPrecioLista=65&widthPrecioIva=65">Eklind</a><br />
<p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Foy&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Foy</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=GearWrench&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">GearWrench</a><br />
<p></p></div></td><td><div align="center">
<a href="ensenarPrecios.php?productor=IR&widthModelo=65&widthDescripcion=175&widthPrecioLista=45&widthPrecioIva=45">Ingersoll Rand</a><br />
<p></p></div></td><td>
<a href="ensenarPrecios.php?productor=Irimo&widthModelo=65&widthDescripcion=175&widthPrecioLista=45&widthPrecioIva=45">Irimo</a><br />
<p></p></td><td><div align="center">
<a href="ensenarPrecios.php?productor=KD&widthModelo=55&widthDescripcion=185&widthPrecioLista=43&widthPrecioIva=43">KD</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=KDAD&widthModelo=90&widthDescripcion=150&widthPrecioLista=45&widthPrecioIva=45">ATD</a><br />
<p></p></div></td>
<td><div align="center">
<a href="ensenarPrecios.php?productor=Lisle&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Lisle</a><br />
<p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Lock&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Lock</a><br/><p></p></div></td>
</tr>
<tr valign="top">
  <td height="10"><div align="center"><a href="ensenarPrecios.php?productor=Lucky&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Lucky</a><br/><p></p></div></td>
	<td><div align="center"><a href="ensenarPrecios.php?productor=Milbar&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Milbar</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Milton&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Milton</a><br /><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Milwaukee&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Milwaukee</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Nova&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Nova</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=OTC&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">OTC</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Plews&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Plews</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Prolock&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Prolock</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=SG&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">SG</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Snapon&widthModelo=60&widthDescripcion=180&widthPrecioLista=45&widthPrecioIva=45">Snap-on</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Sunpro&widthModelo=70&widthDescripcion=225&widthPrecioLista=65&widthPrecioIva=65">Sunpro</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Surtek&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Surtek</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Urrea&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Urrea</a><br/><p></p></div></td>
  <td><div align="center"><a href="ensenarPrecios.php?productor=Vim&widthModelo=70&widthDescripcion=170&widthPrecioLista=45&widthPrecioIva=45">Vim</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Williams&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Williams</a><br/><p></p></div></td>
<td><div align="center"><a href="ensenarPrecios.php?productor=Wright&widthModelo=70&widthDescripcion=155&widthPrecioLista=45&widthPrecioIva=45">Wright</a><br/><p></p></div></td>
</tr>
</table>
<a href="../hemusa.php">Atras</a>
</center>
<center>
<form action="adm/agregarPrecio.php" method="post">
<input type="submit" name="add" value="Agregar Herr.">
</form>
<a href="../hemusa.php" style="text-decoration: none;">Back to Menu</a>
</center>
<p>
<center>




<?php  
echo "<form action='precios.php' method='post' name='total'>"; 
echo '<p></p><table summary="" >';
echo '<tr><td>Busca Clave</td><td>Busca Frase</td><td>Marca</td></tr>';
echo '<tr><td><input type="text" name="refBusca" value=""></td>';
echo '<td><input type="text" name="palabraBusca" value=""></td><td>';
$result = mysql_query("SELECT * FROM marcadeherramientas ORDER BY marca");
echo '<select name="marca1" class="small">';
while ($row = mysql_fetch_array($result)) {
	if ($row['category']==$cat || $cat=='') {
		echo '<option value="'.$row['marca'].'" selected="selected">'.$row['marca'].'</option>';
	}
}
echo '<option value="todo" selected="selected">Todo</option>';
echo '</select>';
echo '<input type="submit" name="buscar" value="Buscar"></td></tr>';
echo '</table>';
echo '<br />';
$marcas = mysql_query("SELECT * FROM MarcaDeHerramientas ORDER BY marca");
if(isset($buscar) and $imprimir!=1)
{
  $marcaBuscar="";   
  if(isset($marca1)) {
    if ($marca1!='todo') {
		  $marcaBuscar=$marcaBuscar.$marca1;
		}
  }
  $Ampco = $_REQUEST["Ampco"];
  if(isset($Ampco)) {
    $marcaBuscar=$marcaBuscar.$Ampco;
  }
  $Apex = $_REQUEST["Apex"];
  if(isset($Apex)) {
    $marcaBuscar=$marcaBuscar.$Apex;
  }
  }
  $Armstrong = $_REQUEST["Armstrong"];
  if(isset($Armstrong)) {
    $marcaBuscar=$marcaBuscar.$Armstrong;
  }
  }
  $ArmstrongAD = $_REQUEST["ArmstrongAD"];
  if(isset($ArmstrongAD)) {
    $marcaBuscar=$marcaBuscar.$ArmstrongAD;
  }
  $Central = $_REQUEST["Central"];
  if(isset($Central)) {
    $marcaBuscar=$marcaBuscar.$Central;
  }
  $Clark = $_REQUEST["Clark"];
  if(isset($Clark)) {
    $marcaBuscar=$marcaBuscar.$Clark;
  }
  $Eklind = $_REQUEST["Eklind"];
  if(isset($Eklind)) {
    $marcaBuscar=$marcaBuscar.$Eklind;
  }
	$GearWrench = $_REQUEST["GearWrench"];
  if(isset($GearWrench)) {
    $marcaBuscar=$marcaBuscar.$GearWrench;
	}
  $IR = $_REQUEST["IR"];
  if(isset($IR)) {
    $marcaBuscar=$marcaBuscar.$IR;
  }
  $KD = $_REQUEST["KD"];
  if(isset($KD)) {
    $marcaBuscar=$marcaBuscar.$KD;
  }
  }
  $KDAD = $_REQUEST["KDAD"];
  if(isset($KDAD)) {
    $marcaBuscar=$marcaBuscar.$KDAD;
  }
  $Lisle = $_REQUEST["Lisle"];
  if(isset($Lisle)) {
    $marcaBuscar=$marcaBuscar.$Lisle;
  }
  $Milbar = $_REQUEST["Milbar"];
  if(isset($Milbar)) {
    $marcaBuscar=$marcaBuscar.$Milbar;
  }
  $Milton = $_REQUEST["Milton"];
  if(isset($Milton)) {
    $marcaBuscar=$marcaBuscar.$Milton;
  }
  $Milwaukee = $_REQUEST["Milwaukee"];
  if(isset($Milton)) {
    $marcaBuscar=$marcaBuscar.$Milwaukee;
  }
  $Nova = $_REQUEST["Nova"];
  if(isset($Nova)) {
    $marcaBuscar=$marcaBuscar.$Nova;
  }
  $OTC = $_REQUEST["OTC"];
  if(isset($OTC)) {
    $marcaBuscar=$marcaBuscar.$OTC;
  }
  $Plews = $_REQUEST["Plews"];
  if(isset($Plews)) {
    $marcaBuscar=$marcaBuscar.$Plews;
  }
  $SG = $_REQUEST["SG"];
  if(isset($SG)) {
    $marcaBuscar=$marcaBuscar.$SG;
  }
  $Sunpro = $_REQUEST["Sunpro"];
  if(isset($Sunpro)) {
    $marcaBuscar=$marcaBuscar.$Sunpro;
  }
  $Vim = $_REQUEST["Vim"];
  if(isset($Vim)) {
    $marcaBuscar=$marcaBuscar.$Vim;
  }
  $Wright = $_REQUEST["Wright"];
  if(isset($Wright)) {
    $marcaBuscar=$marcaBuscar.$Wright;
  }
  $Irimo = $_REQUEST["Irimo"];
  if(isset($Irimo)) {
    $marcaBuscar=$marcaBuscar.$Irimo;
  }
  $Snapon = $_REQUEST["Snapon"];
  if(isset($Snapon)) {
    $marcaBuscar=$marcaBuscar.$Snapon;
  }
  $Balta = $_REQUEST["Balta"];
  if(isset($Balta)) {
    $marcaBuscar=$marcaBuscar.$Balta;
  }
  $Foy = $_REQUEST["Foy"];
  if(isset($Foy)) {
    $marcaBuscar=$marcaBuscar.$Foy;
  }
  $Lock = $_REQUEST["Lock"];
  if(isset($Lock)) {
    $marcaBuscar=$marcaBuscar.$Lock;
  }
  $Lucky = $_REQUEST["Lucky"];
  if(isset($Lucky)) {
    $marcaBuscar=$marcaBuscar.$Lucky;
  }
  $Prolok = $_REQUEST["Prolok"];
  if(isset($Prolok)) {
    $marcaBuscar=$marcaBuscar.$Prolok;
  }
  $Surtek = $_REQUEST["Surtek"];
  if(isset($Surtek)) {
    $marcaBuscar=$marcaBuscar.$Surtek;
  }
  $Urrea = $_REQUEST["Urrea"];
  if(isset($Urrea)) {
    $marcaBuscar=$marcaBuscar.$Urrea;
  }
  if($marcaBuscar=='') {
    $marcaBuscar="AmpcoApexArmstrongBaltaCentralClarkCougarEklindFoyGearWrenchIRKDKDADLisleLockLuckyMilbarMiltonMilwaukeeProlokNovaOTCPlewsSunproSurtekUrreaVimWrightIrimoSnapon";
  }

	echo '<center>El resultado de la búsqueda: '.$palabraBusca.'</center><p></p>';
	$res = mysql_query("SELECT * FROM MarcaDeHerramientas ORDER BY marca");
	echo '<table border="0" cellpadding="1" cellspacing="0" summary="" frame="border" width="">';
	echo '<tr valign="bottom"><td><b>Marca</b><br><img src="Line.jpg" width="50" height="2" /><td><b>Modelo</b><br><img src="Line.jpg" width="80" height="2" /></td><td><b>Descripción<br><img src="Line.jpg" width="200" height="2" /></b></td><td><b>Precio de lista</b><br><img src="Line.jpg" width="70" height="2" /></td><td ><b>Precio con IVA</b><br><img src="Line.jpg" width="70" height="2" /></td><td ><b>Almacen</b><br><img src="Line.jpg" width="45" height="2" /></td></tr>';
if ($refBusca!='') {
   $insertSQL1="SELECT factor FROM MarcaDeHerramientas WHERE marca='".$marcaBuscar."'";
   $result1 = mysql_query($insertSQL1);
   $r = mysql_fetch_array($result1);
   $insertSQL="SELECT * FROM Precio".$marcaBuscar." WHERE ref='".$refBusca."'";
   $result = mysql_query($insertSQL);
   $row = mysql_fetch_array($result);
   if ($row['category']==$cat || $cat=='') {
		$precioBase=round($row['precioBase']*$r['factor']/10000,8);
		if (strlen($precioBase)<7) {
			$precioUnidad=round($row['precioBase']*$r['factor'],2).".00";
		} elseif (strlen($precioBase)==7) {
		    $precioUnidad=round($row['precioBase']*$r['factor'],2)."0";
		} else {
		    $precioUnidad=round($row['precioBase']*$r['factor'],2);
	    }
						
		echo "<tr valign='top' height='10' ><td>".$marcaBuscar."</td><td><b>";
		$descripcion=str_replace( "#","no.", $row["descripcion"]);
		$descripcion=str_replace( "\r\n","<br>", $descripcion);
		echo "<a href='adm/editarPrecio.php?productor=".$marcaBuscar."&id=".$row["id"]."' style='text-decoration: none;'>".$row['ref']."</a></b></td><td>".$descripcion." - ".$row['pagina']."</td><td align='right'>";
		echo $precioUnidad;
		echo "</td><td align='right'><b>".round(($row['precioBase']*$r['factor'])*(1+$IVA)).".00</b></td><td align=right>".$row['enReserva']."</td></tr>";
   }
} else {
	//echo $palabraBusca;
	$strlen=strlen($palabraBusca);
	//echo $strlen;
	//adskille de enkelte ord
	$pos=0;
	$wordno=1;
	while ($pos<$strlen) {
		if ($wordno==1) {
			if (substr($palabraBusca,$pos,1)==' ') {
				$wordno+=1;
			} else {
				$word1=$word1.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==2) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word2=='') {}
				else
				  $wordno+=1;
			} else {
				$word2=$word2.substr($palabraBusca,$pos,1);
			}	
		}
		if ($wordno==3) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word3=='') {}
				else
				  $wordno+=1;
			} else {
				$word3=$word3.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==4) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word4=='') {}
				else
				  $wordno+=1;
			} else {
				$word4=$word4.substr($palabraBusca,$pos,1);
			}
		}
		if ($wordno==5) {
			if (substr($palabraBusca,$pos,1)==' ') {
			  if ($word5==''){}
				else
				  $wordno+=1;
			} else {
				$word5=$word5.substr($palabraBusca,$pos,1);
			}
		}
		$pos+=1;
	}
	if ($word1=='')
		 $word1=' ';
	else
		 $word1=strtolower($word1);
	if ($word2=='')
		 $word2=' ';
	else
	   $word2=strtolower($word2);
	if ($word3=='')
		 $word3=' ';
	else
	$word3=strtolower($word3);
	if ($word4=='')
		 $word4=' ';
	else
	$word4=strtolower($word4);
	if ($word5=='')
		 $word5=' ';
	else
	$word5=strtolower($word5);
    while ($r = mysql_fetch_array($res)) {
		$marca = $r['marca'];
		if (strstr($marcaBuscar,$marca)) {
			$result = mysql_query("SELECT * FROM Precio".$r['marca']." ORDER BY ref");
			while ($row = mysql_fetch_array($result)) {
				$test=strtolower($row['ref']).strtolower($row['descripcion']);
				$find=strtolower($palabraBusca);
				$i=0;
 				if (strstr($test,$word1) and (strstr($test,$word2) or $word2==' ') and (strstr($test,$word3) or $word3==' ') and (strstr($test,$word4) or $word4==' ') and (strstr($test,$word5) or $word5==' ')) {
					$precioBase=round($row['precioBase']*$r['factor']/10000,8);
					if (strlen($precioBase)<7) {
						$precioUnidad=round($row['precioBase']*$r['factor'],2).".00";
					} elseif (strlen($precioBase)==7) {
						$precioUnidad=round($row['precioBase']*$r['factor'],2)."0";
					} else {
						$precioUnidad=round($row['precioBase']*$r['factor'],2);
					}
					echo "<tr valign='top' height='10' ><td>".$marca."</td><td><b>";
					$descripcion=str_replace( "#","no.", $row["descripcion"]);
					$descripcion=str_replace( "\r\n","<br>", $descripcion); 					
					echo "<a href='adm/editarPrecio.php?productor=".$marca."&id=".$row["id"]."' style='text-decoration: none;'>".$row['ref']."</a></b></td><td>".$descripcion." - ".$row['pagina']."</td><td align='right'>";
					echo $precioUnidad;
  					echo "</td><td align='right'><b>".number_format(($row['precioBase']*$r['factor'])*(1+$IVA),2)."</b></td><td align=right>".$row['enReserva']."</td></tr>";
				} else {
					$i++;
				}
			}			
		}
	}
}	 
	echo "</table><br><br>";
}
$i=0;
while ($marca = mysql_fetch_array($marcas)) {
	$marcaX = $marca['marca'];
    echo $marcaX.'<input type="checkbox" name="'.$marcaX.'" value="'.$marcaX.'">, ';
	$i++;
	if ($i==10)
	   echo "<br>";
}
echo '</form>';





 ?> 
</body>
</html>
