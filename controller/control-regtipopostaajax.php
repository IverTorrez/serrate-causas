
<?php

include_once('../model/clstipoposta.php');
$si=1;
$no=0;
	$objpiso=new TipoPosta();
	$objpiso->setnombretipoposta($_POST['textnombconclu']);
	$objpiso->setestadotp('Activo');
	if ($objpiso->guardartipoposta()) {
		echo 1;
	}
	else
	{
		echo 0;
	}
	

?>