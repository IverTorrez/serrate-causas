<?php 
include_once('../model/clsconfirmacion.php');
include_once('../model/clsordengeneral.php');	
include_once('../model/clscostofinal.php');	
include_once('../model/clscotizacion.php');
include_once('../model/clscausa.php');	

$idconfirmacion=$_POST['idconfirCamb'];
$idorden=$_POST['idordenCamb'];
$pronunciaminetoActual=$_POST['estadoPronunciamiento'];
$motivosdelrechazo=$_POST['new_motivo_rechazo'];
/*obtenemos la cotizacion de procuraduria de esta orden*/
$objcotizacion=new Cotizacion();
$resultcot=$objcotizacion->mostrarcotizaciondeorden($idorden);
$filcoti=mysqli_fetch_object($resultcot);
$compraProc=$filcoti->compra;
$ventaProc=$filcoti->venta;
$penalidadProc=$filcoti->penalizacion;

/*PREGUNTAMOS CUAL ES EL PRONUNCIAMIENTO ACTUAL del abogado, SI ES "0", SIGNIFICA QUE CONFIRMAREMOS, SI ES "1", SIGNIFICA QUE RECHAZAREMOS*/
if ($pronunciaminetoActual==0) 
{/*por verdadero ACEPTAREMOS la orden y aplicamos los cambios*/
	    /*primero cambiamos el pronunciamiento, de la tabla confirmacion*/
        $objconf=new Confirmacion();
		$objconf->setid_confirmacion($idconfirmacion);
		$objconf->setconfirabogado(1);
		if ($objconf->cambiarPronunciamientoAbogado()) 
		{/*VERIFCAMOS SI CON EL CAMBIO DE PRONUNCIAMIENTO CAMBIA LA CALIFICACION DE LA ORDEN*/
		  $resultconfisis=$objconf->mostrarlaconfirmaciondelsistemayabogado($idconfirmacion);
		  $filconfsis=mysqli_fetch_object($resultconfisis);
		  if ($filconfsis->confir_sistema==1) 
		  {/*POR VERDADERO, CALIFICAMOS COMO Suficiente Y aplicamos el pago al procurador, DESDE AQUI SE MUEVE EL DINERO*/
			  	$objorden=new OrdenGeneral();
			  	$objorden->setid_orden($idorden);
			  	$objorden->setcalificacion('Suficiente');
			  	if ($objorden->cambiarCalificacionOrden()) 
			  	{/*por verdadero, modificamos los costo finales de la orden, por los montos positivos,vor aver hecho bien la orden*/
			  		$objcostfinal=new Costofinal();
                    /*obtenemos el costo_procesal_venta para sumarle la venta de procuraduria y obtner el nuevo toalEgreso*/
			  		$resulCostofinal=$objcostfinal->mostrarcostosdeunaorden($idorden);
			  		$filcostfinal=mysqli_fetch_object($resulCostofinal);
			  		$newTotalEgreso=$filcostfinal->costo_procesal_venta+$ventaProc;
			  		/*obtnemos la ganacia de procuraduria compra vs venta*/
			  		$gananciaProcuraduria=$ventaProc-$compraProc;

			  		$objcostfinal->setcosto_procuradoria_compra($compraProc);
			  		$objcostfinal->setcosto_procuradoria_venta($ventaProc);
			  		$objcostfinal->settotal_egreso($newTotalEgreso);
			  		$objcostfinal->setpenalidadcostofinal(0);
			  		$objcostfinal->setgananciaprocuradoria($gananciaProcuraduria);
			  		$objcostfinal->setid_orden($idorden);
			  		if ($objcostfinal->modificarCostosDeProcuraduriaDeOrden()) 
			  		{/*una vez se ejecuta la funcion de modificado el costo final, actualizamos la cja de la causa, restandole el costo_procuraduria_venta*/
	                       $objcausa=new Causa();
	                       /*obtenemos el id de causa apartir del id orden*/
	                       $resultcodcausa=$objcausa->mostraridcausadeorden($idorden);
	                       $filidcausa=mysqli_fetch_object($resultcodcausa);
	                       $idcausa=$filidcausa->codcausa;
	                        /*obtenemos el total de la caja de la causa*/
	                       $resulCaja=$objcausa->mostrarcajacausa($idcausa);
	                       $filcajacausa=mysqli_fetch_object($resulCaja);
	                       /*obtnenemos la nueva caja de la causa*/
	                       $newSaldoCajacausa=$filcajacausa->caja-$ventaProc;

	                       $objcausa->setcajacausa($newSaldoCajacausa);
	                       $objcausa->setid_causa($idcausa);
	                       if ($objcausa->modificarcajadecausa()) 
	                       {
	                       	 echo 1;/*enviamos mensaje de exito*/
	                       }
	                       else
	                       {
	                       	echo 5;/*mensaje de error, nivel 4, no se modifico el saldo de la causa ERROR N4-SA*/
	                       }
                       
			  			
			  		}/*FIN DEL IF QUE PREGUNTA SI SE EJECUTO LA FUNCION modificarCostosDeProcuraduriaDeOrden()*/
			  		else
			  		{
			  			echo 4;/*mensaje de error, nivel 3,no se ejecuto la funcion para cambiar costosfinal ERROR N3-C*/
			  		}

			  	}/*fin del if que pregunta si se ejecuto la funcion cambiarCalificacionOrden()*/
			  	else
			  	{
			  	   echo 3;/*mensaje de error, nivel 2, no se ejecuto la funcion, para hacer suficiente, ERROR N2-S*/
			  	}

		  }/*fin del if que pregunta si la calificacion del sistem es "1",se aplican los costos*/
		  else
		  {
            echo 2;/*mensaje de Exito: se cambio el pronunciamiento, pero la orden aun es insuficiente, por la calificacion del sistem */
		  }

			
		}/*fin del if que pregunta si se ejecuto la funcion cambiarPronunciamientoAbogado()*/
		else
		{
			echo 0;/*mensaje de error:, no se ejecutaron cambios*/
		}
		
	
}/*fin del if que pregunta si el $pronunciaminetoActual==0, y aceptamos la orden y aplicamos cambios*/
/*=========================================================================================================================*/
else
{   
	/*===============RECHAZO DE LA ORDEN================*/
	/*preguntamos si el $pronunciaminetoActual==1, tenemos que rechazar*/
	if ($pronunciaminetoActual==1) 
	{/*por verdadero rechazaremos la orden y aplicamos los cambios*/
		/*primero cambiamos el pronunciamiento, de la tabla confirmacion*/
        $objconf=new Confirmacion();
		$objconf->setid_confirmacion($idconfirmacion);
		$objconf->setconfirabogado(0);
		$objconf->setjustificacionabog($motivosdelrechazo);
		if ($objconf->cambiarPronunciamientoAbogado_Rechazar()) 
		{
		  /*PREGUNTAMOS SI LA CALIFICACION DE LA ORDEN es Suficiente*/
		  $objorden=new OrdenGeneral();
		  $resultorden=$objorden->mostrarcalificacionorden($idorden);
		  $filorden=mysqli_fetch_object($resultorden);
		  /*preguntamos si la orden esta con calificacion suficiente,(debemoc hacerla insufuciente)*/
		  if ($filorden->calificacion_todo=='Suficiente') 
		  {/*por verdadero tenemos que hacer la orden Insuficiente*/
		  	    $objorden->setid_orden($idorden);
			  	$objorden->setcalificacion('Insuficiente');
			  	if ($objorden->cambiarCalificacionOrden()) 
			  	{
			  		/*por verdadero, modificamos los costo finales de la orden, por los montos negativos,por aver hecho mal la orden*/
			  		$objcostfinal=new Costofinal();
                    /*obtenemos el totalegreso para restarle la venta de procuraduria y obtner el nuevo toalEgreso*/
			  		$resulCostofinal=$objcostfinal->mostrarcostosdeunaorden($idorden);
			  		$filcostfinal=mysqli_fetch_object($resulCostofinal);
			  		$newTotalEgreso=$filcostfinal->total_egreso-$ventaProc;

			  		$objcostfinal->setcosto_procuradoria_compra(0);
			  		$objcostfinal->setcosto_procuradoria_venta(0);
			  		$objcostfinal->settotal_egreso($newTotalEgreso);
			  		$objcostfinal->setpenalidadcostofinal($penalidadProc);
			  		$objcostfinal->setgananciaprocuradoria(0);
			  		$objcostfinal->setid_orden($idorden);
			  		if ($objcostfinal->modificarCostosDeProcuraduriaDeOrden()) 
			  		{/*por verdadero actualizamos la caja de la causa, sumandole el cotos de venta de procuraduria */
			  			   $objcausa=new Causa();
	                       /*obtenemos el id de causa apartir del id orden*/
	                       $resultcodcausa=$objcausa->mostraridcausadeorden($idorden);
	                       $filidcausa=mysqli_fetch_object($resultcodcausa);
	                       $idcausa=$filidcausa->codcausa;

	                        /*obtenemos el total de la caja de la causa*/
	                       $resulCaja=$objcausa->mostrarcajacausa($idcausa);
	                       $filcajacausa=mysqli_fetch_object($resulCaja);

	                       /*obtnenemos la nueva caja de la causa*/
	                       $newSaldoCajacausa=$filcajacausa->caja+$ventaProc;

	                       $objcausa->setcajacausa($newSaldoCajacausa);
	                       $objcausa->setid_causa($idcausa);
	                       if ($objcausa->modificarcajadecausa()) 
	                       {
	                       	 echo 1;/*enviamos mensaje de exito*/
	                       }
	                       else
	                       {
	                       	echo 9;/*mensaje de error, nivel 9, no se modifico el saldo de la causa(deberia sumarse el costo venta de procuraduria) ERROR N9-SA*/
	                       }
			  			
			  		}/*fin del if que pregunta si se ejecuto la funcion modificarCostosDeProcuraduriaDeOrden()*/
			  		else
			  		{
			         echo 8;/*mensaje de error: nivel 8,no se modifico la tabla costofinal(poner los negativos), y deveria haberse hecho,ERROR N8-CFN*/
			  		}
			  	  
			  	}/*fin del if que pregunta si se ejecuto la funcion cambiarCalificacionOrden()*/
			  	else
			  	{
			  		echo 7;/*mensaje de error: nivel 7, no se pudo hacer insuficiente la orden, ERROR N7-IN*/
			  	}

		  	
		  }/*fin del if que pregunta si la calificacion de la orden es Suficiente*/
		  else
		  {
		  	echo 6;/*mensaje de exito: se cambio el pronunciamiento, pero no se hizo efecto en las cuentas, ya que el sistema rechazo esta orden*/
		  }
		  
		}/*fin del if que pregunta si se ejecuto la funcion cambiarPronunciamientoAbogado()*/
		else
		{
			echo 0;/*mensaje de error, no se aplicaron los cambios*/
		}
		
	}/*fin del if que preguntamos si el $pronunciaminetoActual==1, tenemos que rechazar*/

}/*fin del else cuando $pronunciaminetoActual no es igual a cero*/

		


 ?>