<?php
if (isset($_POST['btnaddobserv'])) {
	agregarObservacion();
	
}
function agregarObservacion(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setobservcausa($_POST['texteditorobserv']); 
	$objca->setobservsolotexto($_POST['textobserolotexto']);

	$idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*1213141516;
    $encriptado=base64_encode($mascara);

	if($objca->modificarObservacionCausa())
	{
		echo "<script > setTimeout(function(){location.href='pm_ficha.php?squart=$encriptado';  }, 1000); swal('EXELENTE','Se Agrego La Observacion Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego La Observacion ','warning'); </script>";
	}
}

?>