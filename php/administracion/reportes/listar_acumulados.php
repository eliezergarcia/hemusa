<?php 
	
	include("../../conexion.php");

	$anoAcumulados = $_POST['anoAcumulados'];
	$tablaAcumulados = "";

	// CNT

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-01-01' AND fecha <= '".$anoAcumulados."-01-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntEnero = $cntEnero + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-02-01' AND fecha <= '".$anoAcumulados."-02-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntFebrero = $cntFebrero + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-03-01' AND fecha <= '".$anoAcumulados."-03-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntMarzo = $cntMarzo + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-04-01' AND fecha <= '".$anoAcumulados."-04-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntAbril = $cntAbril + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-05-01' AND fecha <= '".$anoAcumulados."-05-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntMayo = $cntMayo + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-06-01' AND fecha <= '".$anoAcumulados."-06-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntJunio = $cntJunio + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-07-01' AND fecha <= '".$anoAcumulados."-07-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntJulio = $cntJulio + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-08-01' AND fecha <= '".$anoAcumulados."-08-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntAgosto = $cntAgosto + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-09-01' AND fecha <= '".$anoAcumulados."-09-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntSeptiembre = $cntSeptiembre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-10-01' AND fecha <= '".$anoAcumulados."-10-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntOctubre = $cntOctubre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-11-01' AND fecha <= '".$anoAcumulados."-11-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntNoviembre = $cntNoviembre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoAcumulados."-12-01' AND fecha <= '".$anoAcumulados."-12-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntDiciembre = $cntDiciembre + $data['cnt'];
		}

		$cntTotal = $cntEnero + $cntFebrero + $cntMarzo + $cntAbril + $cntMayo + $cntJunio + $cntJulio + $cntAgosto + $cntSeptiembre + $cntOctubre + $cntNoviembre + $cntDiciembre;
				
		$tablaAcumulados.='{
			"reporte":"Ventas",
			"enero":"$ '. number_format($cntEnero, 2, '.', '').'",
			"febrero":"$ '.number_format($cntFebrero, 2, '.', '').'",
			"marzo":"$ '.number_format($cntMarzo, 2, '.', '').'",				  
			"abril":"$ '.number_format($cntAbril, 2, '.', '').'",
			"mayo":"$ '.number_format($cntMayo, 2, '.', '').'",
			"junio":"$ '.number_format($cntJunio, 2, '.', '').'",
			"julio":"$ '.number_format($cntJulio, 2, '.', '').'",
			"agosto":"$ '.number_format($cntAgosto, 2, '.', '').'",
			"septiembre":"$ '.number_format($cntSeptiembre, 2, '.', '').'",
			"octubre":"$ '.number_format($cntOctubre, 2, '.', '').'",
			"noviembre":"$ '.number_format($cntNoviembre, 2, '.', '').'",
			"diciembre":"$ '.number_format($cntDiciembre, 2, '.', '').'",
			"total":"$ '.number_format($cntTotal, 2, '.', '').'"
		},';

	// DTA

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-01-01' AND fecha <= '".$anoAcumulados."-01-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaEnero = $dtaEnero + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-02-01' AND fecha <= '".$anoAcumulados."-02-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaFebrero = $dtaFebrero + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-03-01' AND fecha <= '".$anoAcumulados."-03-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaMarzo = $dtaMarzo + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-04-01' AND fecha <= '".$anoAcumulados."-04-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaAbril = $dtaAbril + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-05-01' AND fecha <= '".$anoAcumulados."-05-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaMayo = $dtaMayo + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-06-01' AND fecha <= '".$anoAcumulados."-06-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaJunio = $dtaJunio + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-07-01' AND fecha <= '".$anoAcumulados."-07-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaJulio = $dtaJulio + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-08-01' AND fecha <= '".$anoAcumulados."-08-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaAgosto = $dtaAgosto + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-09-01' AND fecha <= '".$anoAcumulados."-09-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaSeptiembre = $dtaSeptiembre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-10-01' AND fecha <= '".$anoAcumulados."-10-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaOctubre = $dtaOctubre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-11-01' AND fecha <= '".$anoAcumulados."-11-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaNoviembre = $dtaNoviembre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoAcumulados."-12-01' AND fecha <= '".$anoAcumulados."-12-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaDiciembre = $dtaDiciembre + $data['dta'];
		}

		$dtaTotal = $dtaEnero + $dtaFebrero + $dtaMarzo + $dtaAbril + $dtaMayo + $dtaJunio + $dtaJulio + $dtaAgosto + $dtaSeptiembre + $dtaOctubre + $dtaNoviembre + $dtaDiciembre;
				
		$tablaAcumulados.='{
			"reporte":"Cobranza",
			"enero":"$ '. number_format($dtaEnero, 2, '.', '').'",
			"febrero":"$ '.number_format($dtaFebrero, 2, '.', '').'",
			"marzo":"$ '.number_format($dtaMarzo, 2, '.', '').'",				  
			"abril":"$ '.number_format($dtaAbril, 2, '.', '').'",
			"mayo":"$ '.number_format($dtaMayo, 2, '.', '').'",
			"junio":"$ '.number_format($dtaJunio, 2, '.', '').'",
			"julio":"$ '.number_format($dtaJulio, 2, '.', '').'",
			"agosto":"$ '.number_format($dtaAgosto, 2, '.', '').'",
			"septiembre":"$ '.number_format($dtaSeptiembre, 2, '.', '').'",
			"octubre":"$ '.number_format($dtaOctubre, 2, '.', '').'",
			"noviembre":"$ '.number_format($dtaNoviembre, 2, '.', '').'",
			"diciembre":"$ '.number_format($dtaDiciembre, 2, '.', '').'",
			"total":"$ '.number_format($dtaTotal, 2, '.', '').'"
		},';

	$tablaAcumulados = substr($tablaAcumulados,0, strlen($tablaAcumulados) - 1);
	echo utf8_encode('{"data":['.$tablaAcumulados.']}');
	mysqli_free_result($resCNT);
	mysqli_close($conexion_usuarios);

 ?>