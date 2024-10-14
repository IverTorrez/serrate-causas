<?php 
include_once('../model/clsprocurador.php');
	

         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

		$objp=new Procurador();
		$objp->setid_procurador($_POST['idprocurador']);
		$objp->setToken($_POST['token']);
		if ($objp->guardarTokenDeProcurador()) 
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
		


 ?>