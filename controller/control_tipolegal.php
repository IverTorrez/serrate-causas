<?php
if (isset($_POST['GUARDAR'])) {
	guardarTipolegal();
	
}
if (isset($_POST['btnmodtp'])) {
	modificaruntipolegal();
}
if (isset($_POST['btneliminartpl'])) {
	darbajaUntipolegal();
}
function guardarTipolegal()
{

	$idmat=$_POST['selectmateria'];
	if ($idmat>0) 
	{
		$tilegal =new TipoLegal();
		$tilegal->setnombtplegal($_POST['nombre']);
		$tilegal->setabrevtplegal($_POST['adbreviatura']);
	    $tilegal->setestado('Activo');
	    $tilegal->setid_materiatp($_POST['selectmateria']);
		if($tilegal->guardartipolegal()){
			echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo El Tipo Legal Con Exito','success'); </script>";
		}else{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Tipo Legal','warning'); </script>";
		}

	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Selecciono Materia','warning'); </script>";
	}
}

function modificaruntipolegal()
{
	$idmat=$_POST['selectmateria'];
	if ($idmat>0) 
	{
	
		$tilegalmod =new TipoLegal();
		$tilegalmod->setnombtplegal($_POST['nombre']);
		$tilegalmod->setabrevtplegal($_POST['adbreviatura']);
		$tilegalmod->setid_materiatp($_POST['selectmateria']);
		$tilegalmod->setid_tplegal($_POST['textidtpl']);
		if($tilegalmod->modificartipolegal()){
			echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se modifico el Tipo Legal Con Exito','success'); </script>";
		}else{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se modifico el Tipo Legal','warning'); </script>";
		}
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Selecciono Materia','warning'); </script>";
	}
}

function darbajaUntipolegal()
{
	$objtp=new TipoLegal();
	$objtp->setid_tplegal($_POST['textidtpmodal']);
	$objtp->setestado('Inactivo');
	
	if($objtp->darbajatipolegal()){
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se elimino el Tipo Legal Con Exito','success'); </script>";
	}else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se elimino el Tipo Legal','warning'); </script>";
	}
}

?>