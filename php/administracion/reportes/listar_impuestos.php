<?php 
	
	include("../../conexion.php");

	$anoImpuestos = $_POST['anoImpuestos'];
	$tablaImpuestos = "";

	// CNT

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-01-01' AND fecha <= '".$anoImpuestos."-01-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntEnero = $cntEnero + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-02-01' AND fecha <= '".$anoImpuestos."-02-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntFebrero = $cntFebrero + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-03-01' AND fecha <= '".$anoImpuestos."-03-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntMarzo = $cntMarzo + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-04-01' AND fecha <= '".$anoImpuestos."-04-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntAbril = $cntAbril + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-05-01' AND fecha <= '".$anoImpuestos."-05-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntMayo = $cntMayo + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-06-01' AND fecha <= '".$anoImpuestos."-06-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntJunio = $cntJunio + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-07-01' AND fecha <= '".$anoImpuestos."-07-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntJulio = $cntJulio + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-08-01' AND fecha <= '".$anoImpuestos."-08-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntAgosto = $cntAgosto + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-09-01' AND fecha <= '".$anoImpuestos."-09-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntSeptiembre = $cntSeptiembre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-10-01' AND fecha <= '".$anoImpuestos."-10-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntOctubre = $cntOctubre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-11-01' AND fecha <= '".$anoImpuestos."-11-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntNoviembre = $cntNoviembre + $data['cnt'];
		}

		$queryCNT = "SELECT cnt FROM pedimentos WHERE fecha >= '".$anoImpuestos."-12-01' AND fecha <= '".$anoImpuestos."-12-31'";
		$resCNT = mysqli_query($conexion_usuarios, $queryCNT);
		$cntDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resCNT)){
			$cntDiciembre = $cntDiciembre + $data['cnt'];
		}

		$cntTotal = $cntEnero + $cntFebrero + $cntMarzo + $cntAbril + $cntMayo + $cntJunio + $cntJulio + $cntAgosto + $cntSeptiembre + $cntOctubre + $cntNoviembre + $cntDiciembre;
				
		$tablaImpuestos.='{
			"impuesto":"CNT",
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

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-01-01' AND fecha <= '".$anoImpuestos."-01-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaEnero = $dtaEnero + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-02-01' AND fecha <= '".$anoImpuestos."-02-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaFebrero = $dtaFebrero + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-03-01' AND fecha <= '".$anoImpuestos."-03-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaMarzo = $dtaMarzo + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-04-01' AND fecha <= '".$anoImpuestos."-04-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaAbril = $dtaAbril + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-05-01' AND fecha <= '".$anoImpuestos."-05-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaMayo = $dtaMayo + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-06-01' AND fecha <= '".$anoImpuestos."-06-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaJunio = $dtaJunio + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-07-01' AND fecha <= '".$anoImpuestos."-07-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaJulio = $dtaJulio + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-08-01' AND fecha <= '".$anoImpuestos."-08-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaAgosto = $dtaAgosto + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-09-01' AND fecha <= '".$anoImpuestos."-09-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaSeptiembre = $dtaSeptiembre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-10-01' AND fecha <= '".$anoImpuestos."-10-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaOctubre = $dtaOctubre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-11-01' AND fecha <= '".$anoImpuestos."-11-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaNoviembre = $dtaNoviembre + $data['dta'];
		}

		$queryDTA = "SELECT dta FROM pedimentos WHERE fecha >= '".$anoImpuestos."-12-01' AND fecha <= '".$anoImpuestos."-12-31'";
		$resDTA = mysqli_query($conexion_usuarios, $queryDTA);
		$dtaDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resDTA)){
			$dtaDiciembre = $dtaDiciembre + $data['dta'];
		}

		$dtaTotal = $dtaEnero + $dtaFebrero + $dtaMarzo + $dtaAbril + $dtaMayo + $dtaJunio + $dtaJulio + $dtaAgosto + $dtaSeptiembre + $dtaOctubre + $dtaNoviembre + $dtaDiciembre;
				
		$tablaImpuestos.='{
			"impuesto":"DTA",
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

	// PRV

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-01-01' AND fecha <= '".$anoImpuestos."-01-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvEnero = $prvEnero + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-02-01' AND fecha <= '".$anoImpuestos."-02-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvFebrero = $prvFebrero + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-03-01' AND fecha <= '".$anoImpuestos."-03-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvMarzo = $prvMarzo + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-04-01' AND fecha <= '".$anoImpuestos."-04-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvAbril = $prvAbril + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-05-01' AND fecha <= '".$anoImpuestos."-05-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvMayo = $prvMayo + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-06-01' AND fecha <= '".$anoImpuestos."-06-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvJunio = $prvJunio + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-07-01' AND fecha <= '".$anoImpuestos."-07-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvJulio = $prvJulio + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-08-01' AND fecha <= '".$anoImpuestos."-08-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvAgosto = $prvAgosto + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-09-01' AND fecha <= '".$anoImpuestos."-09-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvSeptiembre = $prvSeptiembre + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-10-01' AND fecha <= '".$anoImpuestos."-10-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvOctubre = $prvOctubre + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-11-01' AND fecha <= '".$anoImpuestos."-11-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvNoviembre = $prvNoviembre + $data['prv'];
		}

		$queryPRV = "SELECT prv FROM pedimentos WHERE fecha >= '".$anoImpuestos."-12-01' AND fecha <= '".$anoImpuestos."-12-31'";
		$resPRV = mysqli_query($conexion_usuarios, $queryPRV);
		$prvDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resPRV)){
			$prvDiciembre = $prvDiciembre + $data['prv'];
		}

		$prvTotal = $prvEnero + $prvFebrero + $prvMarzo + $prvAbril + $prvMayo + $prvJunio + $prvJulio + $prvAgosto + $prvSeptiembre + $prvOctubre + $prvNoviembre + $prvDiciembre;
				
		$tablaImpuestos.='{
			"impuesto":"PRV",
			"enero":"$ '. number_format($prvEnero, 2, '.', '').'",
			"febrero":"$ '.number_format($prvFebrero, 2, '.', '').'",
			"marzo":"$ '.number_format($prvMarzo, 2, '.', '').'",				  
			"abril":"$ '.number_format($prvAbril, 2, '.', '').'",
			"mayo":"$ '.number_format($prvMayo, 2, '.', '').'",
			"junio":"$ '.number_format($prvJunio, 2, '.', '').'",
			"julio":"$ '.number_format($prvJulio, 2, '.', '').'",
			"agosto":"$ '.number_format($prvAgosto, 2, '.', '').'",
			"septiembre":"$ '.number_format($prvSeptiembre, 2, '.', '').'",
			"octubre":"$ '.number_format($prvOctubre, 2, '.', '').'",
			"noviembre":"$ '.number_format($prvNoviembre, 2, '.', '').'",
			"diciembre":"$ '.number_format($prvDiciembre, 2, '.', '').'",
			"total":"$ '.number_format($prvTotal, 2, '.', '').'"
		},';

	// IGI

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-01-01' AND fecha <= '".$anoImpuestos."-01-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiEnero = $igiEnero + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-02-01' AND fecha <= '".$anoImpuestos."-02-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiFebrero = $igiFebrero + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-03-01' AND fecha <= '".$anoImpuestos."-03-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiMarzo = $igiMarzo + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-04-01' AND fecha <= '".$anoImpuestos."-04-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiAbril = $igiAbril + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-05-01' AND fecha <= '".$anoImpuestos."-05-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiMayo = $igiMayo + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-06-01' AND fecha <= '".$anoImpuestos."-06-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiJunio = $igiJunio + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-07-01' AND fecha <= '".$anoImpuestos."-07-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiJulio = $igiJulio + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-08-01' AND fecha <= '".$anoImpuestos."-08-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiAgosto = $igiAgosto + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-09-01' AND fecha <= '".$anoImpuestos."-09-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiSeptiembre = $igiSeptiembre + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-10-01' AND fecha <= '".$anoImpuestos."-10-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiOctubre = $igiOctubre + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-11-01' AND fecha <= '".$anoImpuestos."-11-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiNoviembre = $igiNoviembre + $data['igi'];
		}

		$queryIGI = "SELECT igi FROM pedimentos WHERE fecha >= '".$anoImpuestos."-12-01' AND fecha <= '".$anoImpuestos."-12-31'";
		$resIGI = mysqli_query($conexion_usuarios, $queryIGI);
		$igiDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIGI)){
			$igiDiciembre = $igiDiciembre + $data['igi'];
		}

		$igiTotal = $igiEnero + $igiFebrero + $igiMarzo + $igiAbril + $igiMayo + $igiJunio + $igiJulio + $igiAgosto + $igiSeptiembre + $igiOctubre + $igiNoviembre + $igiDiciembre;
				
		$tablaImpuestos.='{
			"impuesto":"IGI",
			"enero":"$ '. number_format($igiEnero, 2, '.', '').'",
			"febrero":"$ '.number_format($igiFebrero, 2, '.', '').'",
			"marzo":"$ '.number_format($igiMarzo, 2, '.', '').'",				  
			"abril":"$ '.number_format($igiAbril, 2, '.', '').'",
			"mayo":"$ '.number_format($igiMayo, 2, '.', '').'",
			"junio":"$ '.number_format($igiJunio, 2, '.', '').'",
			"julio":"$ '.number_format($igiJulio, 2, '.', '').'",
			"agosto":"$ '.number_format($igiAgosto, 2, '.', '').'",
			"septiembre":"$ '.number_format($igiSeptiembre, 2, '.', '').'",
			"octubre":"$ '.number_format($igiOctubre, 2, '.', '').'",
			"noviembre":"$ '.number_format($igiNoviembre, 2, '.', '').'",
			"diciembre":"$ '.number_format($igiDiciembre, 2, '.', '').'",
			"total":"$ '.number_format($igiTotal, 2, '.', '').'"
		},';

	// IVA

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-01-01' AND fecha <= '".$anoImpuestos."-01-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaEnero = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaEnero = $ivaEnero + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-02-01' AND fecha <= '".$anoImpuestos."-02-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaFebrero = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaFebrero = $ivaFebrero + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-03-01' AND fecha <= '".$anoImpuestos."-03-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaMarzo = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaMarzo = $ivaMarzo + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-04-01' AND fecha <= '".$anoImpuestos."-04-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaAbril = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaAbril = $ivaAbril + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-05-01' AND fecha <= '".$anoImpuestos."-05-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaMayo = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaMayo = $ivaMayo + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-06-01' AND fecha <= '".$anoImpuestos."-06-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaJunio = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaJunio = $ivaJunio + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-07-01' AND fecha <= '".$anoImpuestos."-07-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaJulio = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaJulio = $ivaJulio + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-08-01' AND fecha <= '".$anoImpuestos."-08-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaAgosto = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaAgosto = $ivaAgosto + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-09-01' AND fecha <= '".$anoImpuestos."-09-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaSeptiembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaSeptiembre = $ivaSeptiembre + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-10-01' AND fecha <= '".$anoImpuestos."-10-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaOctubre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaOctubre = $ivaOctubre + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-11-01' AND fecha <= '".$anoImpuestos."-11-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaNoviembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaNoviembre = $ivaNoviembre + $data['iva'];
		}

		$queryIVA = "SELECT iva FROM pedimentos WHERE fecha >= '".$anoImpuestos."-12-01' AND fecha <= '".$anoImpuestos."-12-31'";
		$resIVA = mysqli_query($conexion_usuarios, $queryIVA);
		$ivaDiciembre = 00.00;
																
		while($data = mysqli_fetch_assoc($resIVA)){
			$ivaDiciembre = $ivaDiciembre + $data['iva'];
		}

		$ivaTotal = $ivaEnero + $ivaFebrero + $ivaMarzo + $ivaAbril + $ivaMayo + $ivaJunio + $ivaJulio + $ivaAgosto + $ivaSeptiembre + $ivaOctubre + $ivaNoviembre + $ivaDiciembre;
				
		$tablaImpuestos.='{
			"impuesto":"IVA (Importacion)",
			"enero":"$ '. number_format($ivaEnero, 2, '.', '').'",
			"febrero":"$ '.number_format($ivaFebrero, 2, '.', '').'",
			"marzo":"$ '.number_format($ivaMarzo, 2, '.', '').'",				  
			"abril":"$ '.number_format($ivaAbril, 2, '.', '').'",
			"mayo":"$ '.number_format($ivaMayo, 2, '.', '').'",
			"junio":"$ '.number_format($ivaJunio, 2, '.', '').'",
			"julio":"$ '.number_format($ivaJulio, 2, '.', '').'",
			"agosto":"$ '.number_format($ivaAgosto, 2, '.', '').'",
			"septiembre":"$ '.number_format($ivaSeptiembre, 2, '.', '').'",
			"octubre":"$ '.number_format($ivaOctubre, 2, '.', '').'",
			"noviembre":"$ '.number_format($ivaNoviembre, 2, '.', '').'",
			"diciembre":"$ '.number_format($ivaDiciembre, 2, '.', '').'",
			"total":"$ '.number_format($ivaTotal, 2, '.', '').'"
		},';

	$tablaImpuestos = substr($tablaImpuestos,0, strlen($tablaImpuestos) - 1);
	echo utf8_encode('{"data":['.$tablaImpuestos.']}');
	mysqli_free_result($resCNT);
	mysqli_close($conexion_usuarios);

 ?>