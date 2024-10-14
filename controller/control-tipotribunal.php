<?php
if (isset($_POST['btnregtptrib'])) {
	guardatptribunal();
}
if (isset($_POST['btnedit'])) {
	modificarunaclasetribunal();
}
if (isset($_POST['btneliminartptrib'])) {
	dardeBajaUnaClaseTribunal();
}

function guardatptribunal()
{
	$objtpt=new ClaseTribunal();
	$objtpt->setnombreclstrib($_POST['texttptrib']);
	$objtpt->setestadoclstrib('Activo');
	if ($objtpt->guardarclasetrib()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo la Clase de Tribunal Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo la Clase de Tribunal ','warning'); </script>";
	}
}

function modificarunaclasetribunal()
{
	$objclstri=new ClaseTribunal();
	$objclstri->setnombreclstrib($_POST['texttptrib']);
	$objclstri->setid_clasetrib($_POST['textidtptrib']);
	
	if ($objclstri->modificarclasetribunal()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se modifico la Clase de Tribunal Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se modifico la Clase de Tribunal ','warning'); </script>";
	}
}

function dardeBajaUnaClaseTribunal()
{
	$objbaja=new ClaseTribunal();
	$objbaja->setestadoclstrib('Inactivo');
	$objbaja->setid_clasetrib($_POST['textidtptribtmodal']);
	
	if ($objbaja->darbajaclasedeTribunal()) {
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se elimino la Clase de Tribunal Con Exito','success'); </script>";
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se elimino la Clase de Tribunal ','warning'); </script>";
	}

}


?>