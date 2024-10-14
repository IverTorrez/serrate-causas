
<?php
 
include_once('../model/clspiso.php');

	$objpiso=new Piso();
	$objpiso->setnombrepiso($_POST['textpiso']);
	$objpiso->setestado('Activo');
	if ($objpiso->guardarpiso()) {
		echo 1;
	}
	else
	{
		echo 0;
	}
	

?>