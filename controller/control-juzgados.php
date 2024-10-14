<?php
//error_reporting(E_ERROR);
/*TODO ESTE CONTROLADOR ES DEL ADMINISTRADOR*/
if (isset($_POST['btnguardarjuz'])) {
      guardajuzgado();
}
if (isset($_POST['btnmodijuz'])) {
	editarjuzgados();
}
if (isset($_POST['btneliminartrib'])) {
	dardebjatribunal();
}

function guardajuzgado()
{
	$objjuzg=new Juzgados();
	$objjuzg->setnombnumerico($_POST['textnombjuz']);
	$objjuzg->setjerarquia($_POST['textjerarqjuz']);
	$objjuzg->setmateriajuz($_POST['textmatjuz']);
	$objjuzg->setcoordenadasjuz($_POST['textlink']);

	$foto=$_FILES['filefotojuz']['name'];
	$ruta=$_FILES['filefotojuz']['tmp_name'];
	$destino="fotos/fotosjuzgados/".$foto;
	copy($ruta,$destino);


	$objjuzg->setfotojuz($foto);
	$objjuzg->setid_distritoj($_POST['selctdist']);
	$objjuzg->setid_pisoj($_POST['selectpiso']);

	$objjuzg->setcontacto1($_POST['contacto1']);
	$objjuzg->setcontacto2($_POST['contacto2']);
	$objjuzg->setcontacto3($_POST['contacto3']);
	$objjuzg->setcontacto4($_POST['contacto4']);

	$objjuzg->setestadoj('Activo');

	if ($objjuzg->guardarjuzgados()) {
		echo "<script > setTimeout(function(){ location.href='actualizartribunal.php' }, 2000); swal('EXELENTE','Se Creo El Tribunal Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo El Tribunal','warning'); </script>";
	}
}

function editarjuzgados()
{
	/*PREGUNTA SI SE ESCOGIO OTRA FOTO PARA EDITAR AL JUZGADO TRIBUNAL*/
	if ($_FILES['filefotojuz']['tmp_name']==null) 
	{
		$objuzgmod=new Juzgados();
		$objuzgmod->setnombnumerico($_POST['textnombjuz']);
		$objuzgmod->setjerarquia($_POST['textjerarqjuz']);
		$objuzgmod->setmateriajuz($_POST['textmatjuz']);
		$objuzgmod->setcoordenadasjuz($_POST['textlink']);
		$objuzgmod->setid_distritoj($_POST['selctdist']);
	    $objuzgmod->setid_pisoj($_POST['selectpiso']);

		$objuzgmod->setcontacto1($_POST['contacto1']);
		$objuzgmod->setcontacto2($_POST['contacto2']);
		$objuzgmod->setcontacto3($_POST['contacto3']);
		$objuzgmod->setcontacto4($_POST['contacto4']);

			$objuzgmod->setid_juzgado($_POST['textidjuz']);
			if ($objuzgmod->modificarJuzgSinFoto()) 
			{
				echo "<script > setTimeout(function(){ location.href='actualizartribunal.php' }, 2000); swal('EXELENTE','Se Modifico El Tribunal Con Exito','success'); </script>";
			}
			else
			{
				echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se pudo modificar el tribunal','warning'); </script>";
			}

		
	}/*FIN DEL IF QUE PREGUNTA SI SE ESCOGIO OTRA FOTO PARA EL TRIBUNAL*/

	else/*POR FALSO QUIERE DECIR  QUE ESCOGIO OTRA FOTO PARA EL JUZGADO, SE MODIFICARA TAMBIEN LA FOTO DEL JUZGADO*/
	{
        $objuzgmodf=new Juzgados();
		$objuzgmodf->setnombnumerico($_POST['textnombjuz']);
		$objuzgmodf->setjerarquia($_POST['textjerarqjuz']);
		$objuzgmodf->setmateriajuz($_POST['textmatjuz']);
		$objuzgmodf->setcoordenadasjuz($_POST['textlink']);

		$foto=$_FILES['filefotojuz']['name'];
		$ruta=$_FILES['filefotojuz']['tmp_name'];
		$destino="fotos/fotosjuzgados/".$foto;
		copy($ruta,$destino);


	    $objuzgmodf->setfotojuz($foto);
		$objuzgmodf->setid_distritoj($_POST['selctdist']);
	    $objuzgmodf->setid_pisoj($_POST['selectpiso']);

		$objuzgmodf->setcontacto1($_POST['contacto1']);
		$objuzgmodf->setcontacto2($_POST['contacto2']);
		$objuzgmodf->setcontacto3($_POST['contacto3']);
		$objuzgmodf->setcontacto4($_POST['contacto4']);

		$objuzgmodf->setid_juzgado($_POST['textidjuz']);
		if ($objuzgmodf->modificarJuzgConFoto()) 
		{
			echo "<script > setTimeout(function(){ location.href='actualizartribunal.php' }, 2000); swal('EXELENTE','Se Modifico El Tribunal Con Exito','success'); </script>";
		}
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se pudo modificar el tribunal','warning'); </script>";
		}
	}/*FIN DEL ELSE QUE SE EJECUTA AL SELECCIONAR FOTO*/

}/*FIN DE LA FUNCION EditarJuzgadotribunal*/

/*funcion dar de baja un tribunal o juzgado*/
function dardebjatribunal()
{
	$objjbaja=new Juzgados();
	$objjbaja->setid_juzgado($_POST['textidtribunal']);
	$objjbaja->setestadoj('Inactivo');
	if ($objjbaja->darbajaUntribunal()) 
	{
		echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se elimino el tribunal con  Exito','success'); </script>";	
	}
	else
	{
      echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se pudo eliminar el tribunal ','warning'); </script>";
	}
}


?>