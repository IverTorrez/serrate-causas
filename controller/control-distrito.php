<?php
if (isset($_POST['btnguardardist'])) {
	guardadist();
}

if (isset($_POST['btnedit'])) {
	modificadistrito();
}
if (isset($_POST['btneliminardist'])) {
	darbajaundistrito();
}


function guardadist()
{
	$objdist=new Distrito();
	$objdist->setnombredistrito($_POST['textnomdist']);
	$objdist->setabreviaturadist($_POST['textabrev']);
	$objdist->setestadodist('Activo');

	if ($objdist->guardardistrito()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo El Distrito Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se Creo El Distrito','warning'); </script>";
	}	
}

function modificadistrito()
{
	$objdist=new Distrito();
	$objdist->setid_distrito($_POST['textiddist']);
	$objdist->setnombredistrito($_POST['textnomdist']);
	$objdist->setabreviaturadist($_POST['textabrev']);
	if ($objdist->modificardistrito()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico El Distrito Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Modifico El Distrito','warning'); </script>";
	}
}

function darbajaundistrito()
{
	$objdisbaja=new Distrito();
	$objdisbaja->setid_distrito($_POST['textiddistmodal']);
	$objdisbaja->setestadodist('Inactivo');
	
	if ($objdisbaja->darbajadistrito()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se elimino El Distrito Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se elimino El Distrito','warning'); </script>";
	}

}
?>