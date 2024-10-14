<?php
if (isset($_POST['btncambiarimagenindex'])) {
	modificaimagenIndex();
}

function modificaimagenIndex()
{
	$objimg=new Cajasdesalida();
	$foto=$_FILES['fileimagenindex']['name'];
	$ruta=$_FILES['fileimagenindex']['tmp_name'];
	$destino="fotos/imagenindex/".$foto;
	copy($ruta,$destino);

	$objimg->setimaginindex($foto);
	$objimg->setid_cajasalida(1);
	
	if ($objimg->modificarImagenIndex()) 
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico La Imagen del Index Con Exito','success'); </script>";
	}
	else
		{
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico La Imagen del Index','warning'); </script>";
		}

}
?>