<?php
if (isset($_POST['btnmodcargainfodocdine'])) 
{
	modifcarcargaInfoDocDetallePresupuest();
}

if (isset($_POST['btnmodinfodescarga'])) 
{
	modificarDescargaInfoDocDetallegasto();
}

if (isset($_POST['btnelimorden'])) 
{
	eliminarorden();
}

function modifcarcargaInfoDocDetallePresupuest()
{
	$objorden=new OrdenGeneral();
	$objorden->setid_orden($_POST['textidorden1']);
	$objorden->setinformacion($_POST['texteditorinformacion']);
	$objorden->setdocumentacion($_POST['texteditordocum']);

	if ($objorden->modificarInfoDocOrden()) 
	{
		$objpresu=new Presupuesto();
		$objpresu->setdetalle_presupuesto($_POST['texteditordetallepresu']);
		$objpresu->setid_orden($_POST['textidorden1']);
		if ($objpresu->modificarDetallePresupuesto()) 
		{
			$idorden=$_POST['textidorden1'];
			$mascara=$idorden*10987654321;
			$encriptado=base64_encode($mascara);
			echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success'); </script>";
		}
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Al Parecer No Se Pudo Modificar El Detalle De Presupuesto ','warning'); </script>";
		}
		
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning'); </script>";
	}
}/*fin de la funcion*/



function modificarDescargaInfoDocDetallegasto()
{ 
	$objdesc=new DescargaProcurador();
	$objdesc->setdetalleinformacion($_POST['textdescargainf']);
	$objdesc->setdescargadocumentacion($_POST['textdescargadoc']);
	$objdesc->setdetallegasto($_POST['textdetallegasto']);
	$objdesc->setultimafoja($_POST['textfoja']);
	$objdesc->setid_orden($_POST['textidordendescarga']);

	if ($objdesc->modificarDescargaInfoDocGastoDetalle()) 
	{
		    $idorden=$_POST['textidordendescarga'];
			$mascara=$idorden*10987654321;
			$encriptado=base64_encode($mascara);
			echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning'); </script>";
	}

}/*fin de la funcion*/


function eliminarorden()
{
	/*SACAMOS EL CODIGO DE LA CAUSA PARA DIRIGIRNO A LA LISTA DE ORDENES*/
	$objorcaus=new OrdenGeneral();
	$resulidcausa=$objorcaus->mostraridcausadeunaorden($_POST['idorden']);
	$filaidcausa=mysqli_fetch_object($resulidcausa);
	$idcausa=$filaidcausa->id_causa;

	$objpresu=new Presupuesto();
    $resulpresu=$objpresu->mostrarpresupuesto($_POST['idorden']);
    $filapre=mysqli_fetch_object($resulpresu);
    if ($filapre->fecha_entrega=='')
    {
    	$obcotiz=new Cotizacion();/*PRIMERO SE ELIMINARA LA COTIZACION DE LA ORDEN*/
    	$obcotiz->setid_ordencotizacion($_POST['idorden']);
    	if ($obcotiz->eliminarCotizacion()) 
    	{
            /*PREGUNTA SI HAY PRESUPUESTO DE ESA ORDEN PARA ELIMINARLA*/
    		if ($filapre->id_presupuesto!='') 
    		{
    			$objpr=new Presupuesto();
    			$objpr->setid_orden($_POST['idorden']);
    			$objpr->eliminarUNpresupuesto();
    			
    		}
	    		/*desde aqui se elimina la orden de la base de datos*/
	    		$objordenelim=new OrdenGeneral();
			    $objordenelim->setid_orden($_POST['idorden']);
			    if ($objordenelim->eliminarUnaOrden()) 
			    {
			    	$mascara=$idcausa*1234567;
                    $encriptado=base64_encode($mascara);
			    	echo "<script > setTimeout(function(){ location.href='listaordenes.php?squart=$encriptado'; }, 2000); swal('EXELENTE','Se Elimimo La Orden Con Exito','success'); </script>";
			    }
			    else
			    {
                  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR FATAL','No Se Eliminaron Todos Los Datos, Comuniquese De Inmediato Con EL Ingeniero Para Informarle Del Problema  ','warning'); </script>";
			    }
    		
    	}
    	else
    	{
    		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino La Orden','warning'); </script>";
    	}
		
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No se Puede ELiminar La Orden Porque EL Dinero Del Presupuesto Ya Fue Entregado ','warning'); </script>";
	}

}/*FIN DE LA FUNCIOM*/

?>