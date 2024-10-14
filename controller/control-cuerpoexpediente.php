<?php
if (isset($_POST['btnguardarcuerpo'])) 
{
	guardarcuerpoexpediente();
}

if (isset($_POST['btnmodcuerpo'])) 
{
	modificarunCuerpoExpediente();
}

if (isset($_POST['btnelimcuerpo'])) 
{
  eliminarCuerpoexpediente();	
}

function guardarcuerpoexpediente()
{
	$objcuerpoexp=new CuerpoExpediente();
	$objcuerpoexp->setlinkcuerpo($_POST['textlinkcuerpo']);
	$objcuerpoexp->setnombrecuerpo($_POST['textnombrecuerpo']);
	$objcuerpoexp->setid_tribunal($_POST['textidtribunal']);
	
	if ($objcuerpoexp->guardarCuerpoExpediente()) 
	{
		echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Insertaron Los Datos Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Registraron Los Datos','warning'); </script>";
	}
}

function modificarunCuerpoExpediente()
{
	$objmodcuerpo=new CuerpoExpediente();
	$objmodcuerpo->setlinkcuerpo($_POST['textlinkcuerpo']);
	$objmodcuerpo->setnombrecuerpo($_POST['textnombrecuerpo']);
	$objmodcuerpo->setid_cuerpo($_POST['textidcuerpomod']);

	if ($objmodcuerpo->modificarCuerpoExpediente()) 
	{
		echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Modificaron Los Datos Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Modificaron Los Datos','warning'); </script>";
	}
}

function eliminarCuerpoexpediente()
{
	$objelimcuerpo=new CuerpoExpediente();
	$objelimcuerpo->setid_cuerpo($_POST['textidcuerpomod']);

	if ($objelimcuerpo->eliminarcuerpoexp()) 
	{
		echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Eliminaron Los Datos Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Eliminaron Los Datos','warning'); </script>";
	}
}
?>