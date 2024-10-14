<?php
if (isset($_POST['btndepositocont'])) {
	depositaralcontador();
}

if (isset($_POST['btnrecibirprestamo'])) {
	recibirprestamo();
}

if (isset($_POST['btndevolverp'])) {
	devolverprestamo();
}

function depositaralcontador()
{
	$obc=new Cajasdesalida();
	$lis=$obc->mostrarcajadelcontador();
	$fila=mysqli_fetch_object($lis);
	$montodeposito=$_POST['textdepositocon'];
	$sumatotal=$montodeposito+$fila->cajacontador;

	$objcaja=new Cajasdesalida();
	$objcaja->setid_cajasalida($_POST['textidcaja']);
	$objcaja->setcajacontador($sumatotal);

	
	$totalcajadm=$_POST['textsaldoadm'];
	if ($montodeposito<=$totalcajadm) {

		
	  if ($objcaja->modificarsaldodecaja()) 
	  {
/*------------CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR----------------------------------------*/
         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         $objtranscont=new TransferenciaContador();
         $objtranscont->setfechatransferencia($concat);
         $objtranscont->setmontotransferencia($montodeposito);
         $objtranscont->settipotransferencia('Deposito');
         $objtranscont->setId_usuario($_POST['textidusu1']);
         $objtranscont->guardartransferenciaContador();
/*--------------FIN DEL CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR------------------------------*/
		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Deposito al Contador','success'); </script>";
      }
	   else
		{
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Deposito','warning'); </script>";
		}

    }
    else
    	{
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Puede Depositar una cantidad mayor a la caja del Administrador','warning'); </script>";
		}



}


function recibirprestamo()
{
	$objca=new Cajasdesalida();
	$liss=$objca->mostrardeudaexterna();
	$fil=mysqli_fetch_object($liss);
	$deudaactual=$fil->deudaexterna;

	$nuevadeudaexterna=$deudaactual+$_POST['textmontoprestamo'];
    
    $obca=new Cajasdesalida();
    $obca->setdeudaexterna($nuevadeudaexterna);
    if ($obca->modificardeudaexterna()) 
    {
    	///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
	     ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
    	$objpres=new Prestamos();
    	$objpres->setfechaprestamo($concat);
    	$objpres->setdetalleprestamo($_POST['textdetpres']);
    	$objpres->setmontoprestamo($_POST['textmontoprestamo']);
    	$objpres->settipoprestamo('Prestamo');
    	$objpres->setid_usuariop($_POST['textidusu']);

    	$objpres->guardarprestamo();
    	echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Registro el Prestamo','success'); </script>";
    }
    else{
    	echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Registro el Prestamo','warning'); </script>";
    }


}

function devolverprestamo()
{
	$montodevolver=$_POST['textmontodevolver'];
	$monotoactualadm=$_POST['textmontoactulacajaadm'];

	if ($montodevolver<=$monotoactualadm) {
		
		$objcc=new Cajasdesalida();
		$ll=$objcc->mostrardeudaexterna();
		$fill=mysqli_fetch_object($ll);
		$deudactual=$fill->deudaexterna;

		if ($montodevolver<=$deudactual) {
			$nuevadeudaexternaa=$deudactual-$montodevolver;

			$obcaa=new Cajasdesalida();
			$obcaa->setdeudaexterna($nuevadeudaexternaa);
			if ($obcaa->modificardeudaexterna()) 
			{
				///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
			     ini_set('date.timezone','America/La_Paz');
			     $fechoyal=date("Y-m-d");
			     $horita=date("H:i");
			     ////$concat es la fecha y hora del sistema
			     $concat=$fechoyal.' '.$horita;
		    	$objpres=new Prestamos();
		    	$objpres->setfechaprestamo($concat);
		    	$objpres->setdetalleprestamo($_POST['textdetdev']);
		    	$objpres->setmontoprestamo($_POST['textmontodevolver']);
		    	$objpres->settipoprestamo('Devolucion');
		    	$objpres->setid_usuariop($_POST['textidusu']);

		    	$objpres->guardarprestamo();
				echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Devolvio el Prestamo','success'); </script>";
			}
			else{
				echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Devolvio el Prestamo','warning'); </script>";
			}
		}
		else{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Puede Devolver un Monto Mayor a la Deuda','warning'); </script>";
		}
	}
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Tiene Saldo Suficiente Para Devolver esa Cantidad','warning'); </script>";
	}

}
?>