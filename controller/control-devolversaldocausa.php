<?php
if (isset($_POST['btndevolversaldocausa'])) {
	devolverSaldoDeCausa();
}

function devolverSaldoDeCausa() 
{
	    $idcausa=$_POST['textidcausadevolver'];
		$saldocausa=$_POST['textsaldocausa'];
		$saldoADM=$_POST['textsaldocajadm'];

		if ($saldocausa<=$saldoADM) 
		{
			$obconsulta=new Causa();
			$resultcaja=$obconsulta->mostrarcajacausa($idcausa);
			$filsaldo=mysqli_fetch_object($resultcaja);
			if ($filsaldo->caja>0) 
			{
				
			

					$objmodcaja=new Causa();
					$objmodcaja->setid_causa($idcausa);
					$objmodcaja->setcajacausa(0);
					if ($objmodcaja->modificarcajadecausa()) 
					{
						ini_set('date.timezone','America/La_Paz');
				         $fechoyal=date("Y-m-d");
				         $horita=date("H:i");
				         $concat=$fechoyal.' '.$horita;
				         
						$objdevol=new DevolucionDinero();
						$objdevol->setmontodevolucion($saldocausa);
						$objdevol->setfechadevolucion($concat);
						$objdevol->setid_causadevolucion($idcausa);

						if ($objdevol->guardardevolucion()) 
						{
							echo "<script > setTimeout(function(){  }, 1000); swal('EXELENTE','Se devolvio el saldo de la causa','success'); </script>";
						} 
						else 
						{
							echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Se modifico la caja de la causa, pero no se registro la devolucion','warning'); </script>";
						}
						
						
				    	
					}

					else
					{
						echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se pudo devolver el saldo','warning'); </script>";
					}

            }/*FIN DEL IF QUE PREGUNTA SI EL SALDO DE LA CAUSA ES MAYOR A CERO*/
            else
            {
            	echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No hay saldo para entregar','info'); </script>";
            }

		}/*FIN DEL IF QUE PREFUNTA SI EL SALDO A ENTREGAR ES MENOR IGUAL A CAJA ADMIN*/

		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No se se hizo la devolucion, la caja del administrador no tiene saldo suficiente para devolver','warning'); </script>";
		}
	

	
} 

?>