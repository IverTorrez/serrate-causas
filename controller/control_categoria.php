<?php
if (isset($_POST['GUARDAR'])) {
	guardarCategoria();
}

if (isset($_POST['btnmodcat'])) {
	modificarunacategoria();
}

if (isset($_POST['btneliminarcat'])) {
	darbajaunaCategoria();
}
function guardarCategoria(){
	$categ= new Categoria();
	$categ->setnombcategoria($_POST['nombre']);
	$categ->setabrevcategoria($_POST['adbreviatura']);
	$categ->setestadocat('Activo');
	if($categ->guardarcategoria()){
		echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Creo La Categoria Con Exito','success'); </script>";
	}else{
		echo"<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo La Categoria ','warning'); </script>";
	}
}

function modificarunacategoria()
{
	$objmodcat=new Categoria();
	$objmodcat->setnombcategoria($_POST['nombre']);
	$objmodcat->setabrevcategoria($_POST['adbreviatura']);
	$objmodcat->setid_categoria($_POST['textidcat']);
    
    if($objmodcat->modificarcategoria()){
		echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se modifico La Categoria Con Exito','success'); </script>";
	}else{
		echo"<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se modifico La Categoria ','warning'); </script>";
	}
}

function darbajaunaCategoria()
{
	$objcatbaja=new Categoria();
	$objcatbaja->setestadocat('Inactivo');
	$objcatbaja->setid_categoria($_POST['textidcatmodal']);

	if($objcatbaja->darbajacategoria()){
		echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se elimino La Categoria Con Exito','success'); </script>";
	}else{
		echo"<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se elimino La Categoria ','warning'); </script>";
	}
}
?>