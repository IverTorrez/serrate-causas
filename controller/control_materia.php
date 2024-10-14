<?php
if (isset($_POST['GUARDAR'])) {
	guardarMateria();
	
}
if (isset($_POST['btnmodmat'])) {
	modificarunaMateria();
}

if (isset($_POST['btneliminarmat'])) {
	dardebajaunamateria();
}
function guardarMateria(){
	$materia =new Materia();
	$materia->setnombmateria($_POST['nombre']);
	$materia->setabrevmateria($_POST['adbreviatura']);
	$materia->setestadomat('Activo');

	if($materia->guardarmateria()){
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo La Materia Con Exito','success'); </script>";
	}else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo La Materia ','warning'); </script>";
	}
}

function modificarunaMateria()
{
	$objmat=new Materia();
	$objmat->setnombmateria($_POST['nombre']);
	$objmat->setabrevmateria($_POST['adbreviatura']);
	$objmat->setid_materia($_POST['textidmat']);

	if($objmat->modificaMateria()){
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se modifico la Materia Con Exito','success'); </script>";
	}else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se modifico la Materia ','warning'); </script>";
	}
	
}

function dardebajaunamateria()
{
	$obmatbaja=new Materia();
	$obmatbaja->setestadomat('Inactivo');
	$obmatbaja->setid_materia($_POST['textidmatmodal']);
	
	if($obmatbaja->darbajamateria()){
		echo "<script > setTimeout(function(){ location.href='materia.php' }, 2000); swal('EXELENTE','Se elimino la Materia Con Exito','success'); </script>";
	}else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se elimino la Materia ','warning'); </script>";
	}

}

?>