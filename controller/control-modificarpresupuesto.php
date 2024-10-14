<?php
if (isset($_POST['btnmodificarpresu'])) 
{   /*funcion para verificar que no se modifique el presupuesto despues de entregar el presupuesto*/
	 $objpre=new Presupuesto();
    $resultpre=$objpre->mostrarFechaEntregaPresupuestoDEorden($_POST['idor']);
    $filidor=mysqli_fetch_object($resultpre);
    if ($filidor->fecha_entrega=='')
    {
	modificarpresupuestoOrden();
	
	}
	else
	{
      echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Se Modifico El Presupuesto, porque ya se entrego el dinero ','warning'); </script>";
	}
}
function modificarpresupuestoOrden()
{
		$montopresupuesto=$_POST['montop'].'.'.$_POST['montodecimal'];
		$objpresu=new Presupuesto();
		$objpresu->setmonto_presupuesto($montopresupuesto);
		$objpresu->setdetalle_presupuesto($_POST['texteditor']);
		$objpresu->setdetallepresusolotexto($_POST['textdetallepresusolotexto']);
		$objpresu->setid_contador($_POST['idcontador']);
		$objpresu->setid_orden($_POST['idor']);

	 if ($objpresu->modificarPresupuesto()) 
	 {
	 	$cotiz=new Cotizacion();
		$cotiz->setid_ordencotizacion($_POST['idor']);
		$list=$cotiz->devolvercondicion();
		while ($bdc=mysqli_fetch_object($list)) 
		{
			$prio=new Prioridad();
			$rr=$bdc->condicioncot;
		    $reslp=$prio->listaunaprioridad($_POST['idprioridad'],$rr);

		}

	   
		   while ($lisp=mysqli_fetch_array($reslp)) 
		   {

			   	$objord=new OrdenGeneral();
			   	$objord->setid_orden($_POST['idor']);
				$objord->setprioridaorden($_POST['idprioridad']);
				$objord->setid_prioridadorden($lisp['id_prioridad']);
				$objord->setid_procuradororden($_POST['idprocu']);
				//$objord->setestadoorden('Presupuestada');
				$objord->modificarorden_almodificarpresupuestar();

				$cotiz->setcotizacioncompra($lisp['preciocompra']);
				$cotiz->setcotizacionventa($lisp['precioventa']);
				$cotiz->setcotizacionpenalidad($lisp['penalizacion']);
				$cotiz->setprioridadcoti($lisp['nombreprioridad']);

			    $idorden1=$_POST['idor'];
				$objorden1=new OrdenGeneral();
				$listadd=$objorden1->mostraridcausadeunaorden($idorden1);
				$filor=mysqli_fetch_object($listadd);
				$idcausa=$filor->id_causa;

					

				  if ($cotiz->modificar_alpresupuestarcoti()) 
				    {  
				        $objorden2=new OrdenGeneral();
						$listtt=$objorden2->mostrartotalgiradasdeCausa($idcausa);
						$filorgir=mysqli_fetch_object($listtt);
						$totalgiradascausa=$filorgir->totalgiradacausa;

						 $mascara=$idcausa*12345678910;
			             $encriptado=base64_encode($mascara);
		/*-------------CODIGO PARA VERIFICAR SI SE CHECKEO EL ENVIO DE EMAIL-------*/
				    if ($_POST['checkemail']==null)/*pregunta si no esta chequeado*/
				    {
				    	
				    	
				    }
				    else/*por falso (osea esta chequeado) envia el correo*/
				    {
	/*------------------------ENVIARA UN CORREO AL PROCURADOR ASIGNADO PARA LA ORDEN-------------*/
				             /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
				             $idprocurador=$_POST['idprocu'];
				             enviarCorreoModPresupuesto($idorden1,$idprocurador);

			                /*$objproc1=new Procurador();
			                $resulproc=$objproc1->mostrarunProcurador1($_POST['idprocu']);
			                $filproc=mysqli_fetch_object($resulproc);

			                $destinoproc=$filproc->correoproc;
                               /*OBTENEMOS EL CODIGO DE LA CAUSA*/
			                  /* $objcausa=new Causa();
							   $resul=$objcausa->mostrarcodcausadeorden($idorden1);
							   $fil=mysqli_fetch_object($resul);
							   $codcausa=$fil->codigo;

			                /*PONEMOS EL ASUNTO DEL CORREO*/
					       /* $asunto="Orden Asignada: $idorden1";

			                /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
                          /* $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                            'Reply-To: info@serrate.bo' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

		                    $mensajeproc="Señor procurador: Se le comunica a usted que, a partir de la presente fecha, usted tiene la tutela de la orden $idorden1 (presupuestada)  perteneciente a la causa con código $codcausa. \n";
		                    $mensajeproc.="Atte. El Sistema. \n";

		                    $mensajenuevo = stripslashes($mensajeproc); /*se pasa los datos para que se interprete*/
                           /* $mensajenuevo = iconv('UTF-8', 'windows-1252', $mensajenuevo);
							mail($destinoproc,$asunto,$mensajenuevo,$cabeceras);*/
	/*-------------------------------------FIN DEL ENVIO DE CORREO-------------------------------*/
	                }/*FIN DEL ESLE QUE EVIA EL CORREO*/

						if ($totalgiradascausa>0) 
						{
							echo "<script > setTimeout(function(){ location.href='listaordenesgiradas.php?squart=$encriptado'; }, 500); swal('EXELENTE','Se Modifico El Presupuesto Con Exito','success'); </script>";
						}
						else
						{
							echo "<script > setTimeout(function(){ location.href='causasordenesgiradas.php'; }, 1000); swal('EXELENTE','Se Modifico El Presupuesto Con Exito','success'); </script>";
						}

						//echo "<script > setTimeout(function(){  }, 2000); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
				   }
					else
					{
						echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Algo Salio Mal No Se Modificaron Todos Los Datos','warning'); </script>";
					}


		   }
	 		
	 }	/*FIN DEL IF QUE PREGUNTA SI LA FUNCION SE EJECUTO*/
	 else
	 {
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Presupuesto ','warning'); </script>";
	 }

}/*FIN DE LA FUNCION MODIFICAAR PRESUPUESTO*/


/*funcion que evia correo al modificar presupuesto*/
function enviarCorreoModPresupuesto($idorden,$idprocu)
{
	/*Se obtiene los datos de la planilla con codigo 10*/
	$objplanilla= new Planillas_envio_notificacion();
	$resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(10);
	$filplanilla=mysqli_fetch_object($resulplanilla);
	$envia_notif           =$filplanilla->envia_notif;
	$emisor                =$filplanilla->emisor;
	$tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
	$receptor_estatico     =$filplanilla->receptor_estatico;
	$asunto                =$filplanilla->asunto;
	$texto                 =$filplanilla->texto;
	$nombre_emisor         =$filplanilla->nombre_emisor;

	if ($envia_notif==1) //preguntamos si envia la notificacion
	{
		//preguntamos si existe un emisor con direccion de correo electronico valido 
			$arroba='@';
			if (strpos($emisor, $arroba)==true) 
			{
				$correoEmisor=$emisor;
			}
			else //por falso colocamos el correo del administrador
			{
                /*obtenemos el correo del user admin*/
	             $objuser=new Usuario();
	             $resultuser=$objuser->MostrarUserAdmin();
	             $filuser=mysqli_fetch_object($resultuser);
	             $correoEmisor=$filuser->correousuario;
			}
			/*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";

            
           /*OBTENEMOS EL CODIGO DE LA CAUSA*/
			    $objcausa=new Causa();
			    $resul=$objcausa->mostrarcodcausadeorden($idorden);
				$fil=mysqli_fetch_object($resul);
				$codigocausa=$fil->codigo;

		if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
		{
			 /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
			    $objproc1=new Procurador();
			    $resulproc=$objproc1->mostrarunProcurador1($idprocu);
			    $filproc=mysqli_fetch_object($resulproc);

			    $destinoproc=$filproc->correoproc;
                
           /*reemplazamos las variables en el asunto*/
            $searchasunto = array('[numeroorden]');
            $replaceasunto = array($idorden);
            $asuntoproc=str_replace($searchasunto,$replaceasunto,$asunto);
	       
            //Reemplazamos las variables en el texto
	        $search = array('[codigocausa]', 
                            '[numeroorden]');
            $replace = array('<b>'.$codigocausa.'</b>',
                            '<b>'.$idorden.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);

          //Correo para el procurador
	       mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
	       
		}//fin del if que pregunta si el receptor es dinamico
		else//por falso cargamos el receptor estatico
		{
			$receptor=$receptor_estatico;
			
           /*reemplazamos las variables en el asunto*/
            $searchasunto = array('[numeroorden]');
            $replaceasunto = array($idorden);
            $asuntoproc=str_replace($searchasunto,$replaceasunto,$asunto);

	        //Reemplazamos los nombre de causas, abogado procurador etc
	        $search = array('[codigocausa]', 
                            '[numeroorden]');
            $replace = array('<b>'.$codigocausa.'</b>',
                            '<b>'.$idorden.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
           
            //Correo para el destino	
	        mail($receptor,$asuntoproc,$textomodificado,$cabeceras);
		}
	}//fin cuando pregunta si envia notificacion
}

?>