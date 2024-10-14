
<?php 
if(isset($_POST['btnrecibirorden']))
{
	/*funcion para verificar que no se acepte varias veces la orden*/
	 $objor=new OrdenGeneral();
    $resultpre=$objor->mostrarfecharecepcionDeOrden($_POST['idorden']);
    $filidor=mysqli_fetch_object($resultpre);
    if ($filidor->fecha_recepcion=='')
    {
     recibirUnaorden();
   }
   else
   {
     echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No se registro el recibo de la orden, porque ya se recibio esta orden','warning'); </script>";
   }
} 


function recibirUnaorden()
{
	 ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;

	$orden1=new OrdenGeneral();
	$orden1->setid_orden($_POST['idorden']);
     $codor=$_POST['idorden'];
     $mascara=$codor*1020304050;
     $encript=base64_encode($mascara);
   

	$orden1->setfecharecepcion($concat);
	$orden1->setestadoorden('Aceptada');
	if($orden1->recibirorden())
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Recibio La Orden Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se recibio la orden','warning'); </script>";
	}
}


?>