
<?php 
if(isset($_POST['btnentregadinero']))
{
	 ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;

     $objcaja=new Cajasdesalida();
     $list=$objcaja->mostrarcajadelcontador();
     $fil=mysqli_fetch_object($list);

     $totalcajacont=$fil->cajacontador;

     $montoentregar=$_POST['textmonto'];

    if ($montoentregar<=$totalcajacont) {

    	$objpresu=new Presupuesto(); 
	$objpresu->setid_orden($_POST['textidorden']);
	$objpresu->setfecha_entrega($concat);
	$objpresu->setestadopresupuesto('Entregado');
	if($objpresu->entregardinero()){
		$nuevosaldo=$totalcajacont-$montoentregar;

		$objca=new Cajasdesalida();
		$objca->setid_cajasalida(1);
		$objca->setcajacontador($nuevosaldo);
		$objca->modificarsaldodecaja();
        


		$objorden=new OrdenGeneral();
		$objorden->setid_orden($_POST['textidorden']);
		$objorden->setestadoorden('DineroEntregado');
		if ($objorden->cambiarestadodeorden()) {
			echo "<script > setTimeout(function(){ location.href='listadeentrega.php'; }, 2000); swal('EXELENTE','Se Registro La Entrega De Dinero Con Exito ','success'); </script>";
		}
	   else{
		    echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No Se Registro La Entrega','warning'); </script>";
		   }
	  }
     else{
	    	echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No Se Registro La Entrega','warning'); </script>";
		}
    	
    }

    else{
    	echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No Puede entregar, El saldo de su caja es menor al monto a entregar','warning'); </script>";
    }
		

		
} 


?>