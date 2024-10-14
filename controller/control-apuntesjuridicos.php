<?php
if (isset($_POST['btnaddapuntjuri'])) {
	agregarApuntesjuridicos();
	
}
function agregarApuntesjuridicos(){
	$objca =new Causa();
	$objca->setid_causa($_POST['idcausa']);
	$objca->setapuntesjuridicos($_POST['texteditorapuntjurid']);
	$objca->setapuntesjuridicossolotexto($_POST['textapuntejurisolotexto']);

    $idcausa1=$_POST['idcausa'];
    $mascara=$idcausa1*12345678910;
    $encriptado=base64_encode($mascara);

	if($objca->modificarApuntesJuridicosCausa())
	{
		echo "<script > setTimeout(function(){ location.href='fichacausa.php?squart=$encriptado'; }, 1000); swal('EXELENTE','Se Agrego Apuntes Juridicos Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Agrego Apuntes Juridicos ','warning'); </script>";
	}
}

?>