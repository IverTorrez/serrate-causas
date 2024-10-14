<?php 
include_once('../model/clscausa.php');
	

		$objc=new Causa();
		$objc->setid_causa($_POST['textid_causa']);
		$objc->setcolor_causa($_POST['selectcolor']);
		if ($objc->asignarColorA_Causa()) 
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
		


 ?>