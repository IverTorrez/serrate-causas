<?php

include_once('../model/clstipoposta.php');
$si=1;
$no=0;
	$objpiso=new TipoPosta();
	$objpiso->setid_tipoposta($_POST['textidconclicion']);
	$objpiso->setestadotp('Inactivo');
	
	if ($objpiso->DarbajaTipoPosta()) {
		echo 1;
	}
	else
	{
		echo 0;
	}
	

?>