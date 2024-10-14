<?php
if (isset($_POST['btnaddapunthonorario'])) {
	agregarApuntesHonorario();
	
}
function agregarApuntesHonorario(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setapunteshonorarios($_POST['texteditorapunthonorario']);
	$objca->setapunteshonorariossolotexto($_POST['textapuntehonorariosolotexto']);

    $idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*12345678910;
    $encriptado=base64_encode($mascara);

	if($objca->modificarApuntesHonorarioCausa())
	{
		echo "<script > setTimeout(function(){ location.href='fichacausa.php?squart=$encriptado'; }, 1000); swal('EXELENTE','Se Agrego Apuntes Honorario Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego Apuntes Honorario ','warning'); </script>";
	}
}

?>