<?php
if (isset($_POST['btnaddposta'])) {
	guardarNuevaPosta();
}
if (isset($_POST['btneliminarposta'])) {
	eliminarpostaplantilla();
}

if (isset($_POST['btnmodposta'])) {
	modificarnombrePosta();
}
function guardarNuevaPosta()
{
	$objpt=new Posta();
	$resultp=$objpt->contarpostasDePlantilla($_POST['idplantilla']);
	$filp=mysqli_fetch_object($resultp);
	$numero=$filp->cantidad+1;


	$objposta=new Posta();
	$objposta->setnumeroposta($numero);
	$objposta->setnombreposta($_POST['textnombposta']);
	$objposta->setid_plantillap($_POST['idplantilla']);
	$objposta->setestadop('Activa');
	
	if ($objposta->guardarposta()) 
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo la Posta Con Exito','success'); </script>";
	}
	else
		{
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Creo la Posta','warning'); </script>";
		}


}

function eliminarpostaplantilla()
{
	$objposta1=new Posta();
	$objposta1->setid_posta($_POST['textidposta']);
	if ($objposta1->eliminarPostaDeBD()) 
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino la Posta Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Elimino la Posta','warning'); </script>";
	}
}


function modificarnombrePosta()
{
	$objposta2=new Posta();
	$objposta2->setid_posta($_POST['textidpostamod']);
	$objposta2->setnombreposta($_POST['textnombpostamod']);

	if ($objposta2->modificarPosta()) 
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico la Posta Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico la Posta','warning'); </script>";
	}
}
?>