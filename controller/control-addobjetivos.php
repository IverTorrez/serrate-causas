<?php
if (isset($_POST['btnaddobjetivos'])) {
	agregarObjetivos();
	
}
function agregarObjetivos(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setobjetivocausa($_POST['texteditorobjetivo']);
	$objca->setobjetivossolotexto($_POST['textobjetsolotexto']);

	$idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*1234567;
    $encriptado=base64_encode($mascara);


	if($objca->modificarObjetivosCausa())
	{
		echo "<script > setTimeout(function(){ location.href='ficha.php?squart=$encriptado'; }, 1000); swal('EXELENTE','Se Agrego Objetivos Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego Objetivos ','warning'); </script>";
	}
}

?>