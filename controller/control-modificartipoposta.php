<?php

include_once('../model/clstipoposta.php');
$si=1;
$no=0;
	$objpiso=new TipoPosta();
	$objpiso->setid_tipoposta($_POST['textidconclu']);
	$objpiso->setnombretipoposta($_POST['textnombconclu']);
	
	if ($objpiso->modificarTipoPosta()) {
		echo 1;
	}
	else
	{
		echo 0;
	}
	

?>