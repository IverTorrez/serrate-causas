<?php
if (isset($_POST['btnguardarpiso'])) {
	guardapiso();
}
if (isset($_POST['btnmodpiso'])) {
	modificarunpiso();
}
if (isset($_POST['btneliminarpiso'])) {
	darbajpiso();
}

function guardapiso()
{
	$objpiso=new Piso();
	$objpiso->setnombrepiso($_POST['textpiso']);
	$objpiso->setestado('Activo');
	if ($objpiso->guardarpiso()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo El Piso Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo El Piso','danger'); </script>";
	}
}

function modificarunpiso()
{
	$objpisomod=new Piso();
	$objpisomod->setnombrepiso($_POST['textpiso']);
	$objpisomod->setid_piso($_POST['textidpiso']);
	if ($objpisomod->modificarpiso()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico El Piso Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Piso','danger'); </script>";
	}
}

function darbajpiso()
{
	$obpisobaja=new Piso();
	$obpisobaja->setid_piso($_POST['textidpiso']);
	$obpisobaja->setestado('Inactivo');
    if ($obpisobaja->darbajapiso()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se dio de baja el piso con exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se dio de baja el piso','danger'); </script>";
	}

}


?>