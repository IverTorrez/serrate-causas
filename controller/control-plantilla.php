<?php
if (isset($_POST['btncrearplantilla'])) {
	guardarnuevaplantila();
}
if (isset($_POST['btneliminarplant'])) {
	darbajaunaplantilla();
}
if (isset($_POST['btnmodplantilla'])) {
	modificarnombrePlantilla();
}

function guardarnuevaplantila()
{
	$objplant=new Plantilla();
	$objplant->setnombreplantilla($_POST['textnameplantilla']);
	$objplant->setestadoplan('Activa');
	
	if ($objplant->guardarplantilla()) 
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo la Plantilla Con Exito','success'); </script>";
	}
	else
		{
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Creo la Plantilla','warning'); </script>";
		}


}


function darbajaunaplantilla()
{
	$objplant1=new Plantilla();
	$objplant1->setestadoplan('Inactivo');
	$objplant1->setid_plantilla($_POST['textidplant']);

	if ($objplant1->darbajaplantilla()) 
	{
	echo "<script > setTimeout(function(){ location.href='avancefisico.php'  }, 2000); swal('EXELENTE','Se Elimino la Plantilla Con Exito','success'); </script>";
	}
	else
	{
	echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Elimino la Plantilla','warning'); </script>";
	}
}



function modificarnombrePlantilla()
{
	$objplant2=new Plantilla();
	$objplant2->setid_plantilla($_POST['textidplantilla']);
	$objplant2->setnombreplantilla($_POST['textnameplantilla']);
	if ($objplant2->modificarplantillanombre()) 
	{
		echo "<script > setTimeout(function(){ location.href='avancefisico.php'  }, 2000); swal('EXELENTE','Se Modifico El Nombre de la Plantilla Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico El Nombre de la Plantilla','warning'); </script>";
	}
}
?>