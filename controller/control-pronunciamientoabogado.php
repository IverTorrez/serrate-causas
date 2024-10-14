
<?php 
if(isset($_POST['btnaceptardescarga']))
{
	 ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;
     
     $objconfir=new Confirmacion();
     $objconfir->setid_confirmacion($_POST['idconfir']);
     $objconfir->setconfirabogado(1);
     $objconfir->setfechaconfirabogado($concat);
     if ($objconfir->pronunciamientoabogado()) {

     	 $orden1=new OrdenGeneral();
	     $orden1->setid_orden($_POST['idorden']);
         $codor=$_POST['idorden'];
         $mascara=$codor*1020304050;
         $encript=base64_encode($mascara); 
	     $orden1->setestadoorden('PronuncioAbogado');

	     if($orden1->cambiarestadodeorden())
		        echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Acepto La Descarga De la Orden','success'); </script>";
	       else
		       echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encript'; }, 2000); swal('ERROR','No se Acepto la Descarga de la Orden','warning'); </script>";
     	
     }
     else
		 echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encript'; }, 2000); swal('ERROR',' No se registro el pronunciamiento','warning'); </script>";

} 
///////////RECHAZO DE LA ORDEN///////////////////////////////////////
if(isset($_POST['btnrechazardescarga']))
{
	 ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;
     
     $objconfir=new Confirmacion();
     $objconfir->setid_confirmacion($_POST['idconfir']);
     $objconfir->setconfirabogado(0);
     $objconfir->setfechaconfirabogado($concat);
     if ($objconfir->pronunciamientoabogado()) {

     	 $orden1=new OrdenGeneral();
	     $orden1->setid_orden($_POST['idorden']);
         $codor=$_POST['idorden'];
         $mascara=$codor*1020304050;
         $encript=base64_encode($mascara); 
	     $orden1->setestadoorden('PronuncioAbogado');

	     if($orden1->cambiarestadodeorden())
		        echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Rechazo La Descarga De la Orden','success'); </script>";
	       else
		       echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encript'; }, 2000); swal('ERROR','No se Rechazo la Descarga de la Orden','warning'); </script>";
     	
     }
     else
		 echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encript'; }, 2000); swal('ERROR',' No se registro el pronunciamiento','warning'); </script>";
		 	
}


?>