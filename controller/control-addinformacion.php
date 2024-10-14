<?php
if (isset($_POST['btnaddinformacion'])) {
	agregarInformacion();
	
}
function agregarInformacion(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setinformacioncausa($_POST['texteditorinformacion']);
	$objca->setinforsolotexto($_POST['textotrainforsolotexto']);

    $idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*12345678910;
    $encriptado=base64_encode($mascara);

	if($objca->modificarInformacionCausa())
	{
		echo "<script > setTimeout(function(){ location.href='fichacausa.php?squart=$encriptado'; }, 1000); swal('EXELENTE','Se Agrego Informacion Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego Informacion ','warning'); </script>";
	}
}

?>