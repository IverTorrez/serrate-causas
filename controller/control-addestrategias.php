<?php
if (isset($_POST['btnaddestrategias'])) {
	agregarEstrategias();
	
}
function agregarEstrategias(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setestrategiscausa($_POST['texteditorestrategia']);
	$objca->setestrategiassolotexto($_POST['textestrategiasolotexto']);

    $idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*1234567;
    $encriptado=base64_encode($mascara);

	if($objca->modificarEstrategiasCausa())
	{
		echo "<script > setTimeout(function(){ location.href='ficha.php?squart=$encriptado'; }, 1000); swal('EXELENTE','Se Agrego Estrategias Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego Estrategias ','warning'); </script>";
	}
}

?>