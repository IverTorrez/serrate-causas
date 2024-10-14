<?php

if (isset($_POST['btnpresupuestar'])) {
    /*FUNSIONES PARA VERIFICAR QUE UNA ORDEN NO SE PRESUPUESTE DOS VECES*/
    $objpre=new Presupuesto();
    $resultpre=$objpre->mostrarIdordenenPresupuesto($_POST['idor']);
    $filidor=mysqli_fetch_object($resultpre);
    if ($filidor->id_orden=='')
    {
	   guardarpresupuesto();
	   //modificarorden();
   }
   else
   {
     echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Se Giro El Presupuesto, Porque esta orden ya tiene un presupuesto ','warning'); </script>";
   }	

}

function guardarpresupuesto()
{
	ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;

    $montopresupuesto=$_POST['montop'].'.'.$_POST['montodecimal'];
	$objtip=new Presupuesto();

	$objtip->setmonto_presupuesto($montopresupuesto);
	$objtip->setdetalle_presupuesto($_POST['texteditor']);
	$objtip->setdetallepresusolotexto($_POST['textdetallepresusolotexto']);
	$objtip->setfecha_presupuesto($concat);
	//$objtip->setfecha_entrega();
    $objtip->setid_orden($_POST['idor']);
    $objtip->setid_contador($_POST['idcontador']);
    $objtip->setestadopresupuesto('Presupuestado');
    
	 if ($objtip->guardarpresupuesto()) 
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
					$objord->setestadoorden('Presupuestada');
					$objord->modificar_alpresupuestar();

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
	/*----------------------ENVIARA UN CORREO AL PROCURADOR ASIGNADO PARA LA ORDEN-----------------------*/
				             /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
			             //   $objproc1=new Procurador();
			             //   $resulproc=$objproc1->mostrarunProcurador1($_POST['idprocu']);
			             //   $filproc=mysqli_fetch_object($resulproc);

			             //   $destinoproc=$filproc->correoproc;
                               /*OBTENEMOS EL CODIGO DE LA CAUSA*/
			     //              $objcausa=new Causa();
							 //  $resul=$objcausa->mostrarcodcausadeorden($idorden1);
							 //  $fil=mysqli_fetch_object($resul);
							 //  $codcausa=$fil->codigo;

			                /*PONEMOS EL ASUNTO DEL CORREO*/
					       // $asunto="Orden Asignada: $idorden1";

			                /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
    //                       $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
    //                         'Reply-To: info@serrate.bo' . "\r\n" .
    //                         'X-Mailer: PHP/' . phpversion();

		  //                  $mensajeproc="Se帽or procurador: Se le comunica a usted que, a partir de la presente fecha, usted tiene la tutela de la orden $idorden1 (presupuestada)  perteneciente a la causa con c贸digo $codcausa. \n";
		  //                  $mensajeproc.="Atte. El Sistema. \n";
		                    
		  //                  $mensajenuevo = stripslashes($mensajeproc); /*se pasa los datos para que se interprete*/
    //                         $mensajenuevo = iconv('UTF-8', 'windows-1252', $mensajenuevo);
				// 			mail($destinoproc,$asunto,$mensajenuevo,$cabeceras);
	/*----------------------------------------------FIN DEL ENVIO DE CORREO-------------------------------*/
				    }/*FIN DEL ESLE QUE EVIA EL CORREO*/

/*===============ENVIO DE NOTIFICACION PUSCH=====================================*/
 $objproc=new Procurador();
 $resultp=$objproc->mostrarunprocuradro($_POST['idprocu']);
 $filp=mysqli_fetch_object($resultp);
 
 /*OBTENEMOS EL CODIGO DE LA CAUSA*/
	$objcausa=new Causa();
	$resul=$objcausa->mostrarcodcausadeorden($_POST['idor']);
    $fil=mysqli_fetch_object($resul);
    $codcausa=$fil->codigo;
 
 $idorden=$_POST['idor'];
 
 $iprocurador=$_POST['idprocu'];
 $idcausaa=$fil->idcausa;
enviarNotPuschPresupuesto($idcausaa,$iprocurador,$idorden);



// $tokens[] = $fila->token;

   /*  $msg = array
      (
          'title'     => $codcausa.'- ('.$idorden.')',
          'body'     =>'Pase a recoger el dinero del presupuesto.',
          'message'   => 'Este mensaje es para usted, activo',  
          'subtitle'  => 'This is a subtitle. subtitle',
          'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
          'vibrate'   => 1,
          'requireInteraction' => 'true',
          'sound'     => 'warning',
          'icon'     =>'../resources/logoserrate3.jfif',
          'largeIcon' => 'large_icon',
          'smallIcon' => 'small_icon'
      );
/*ESTA NOTIFICACION ES PARA CUANDO EL NAVEGADOR ESTA CERRADO ESTA INACTIVO, (AL PARECER)*/
    /*  $n = array(
          "title" => $codcausa."- (".$idorden.")",
          "body"  => "Pase a recoger el dinero del presupuesto.",
          "text"  => "Click me to open an Activity!",
          "icon" => "resources/logoserrate3.jfif",
          "requireInteraction" =>"true",
          "vibrate"=>1,
          "sound" => "warning"
      );

  $tokens[]=$filp->token;
  $message_status = send_notification($tokens, $msg, $n);*/

// echo $message_status;


/*==============FINENVIO DE NOTIFICACION PUSCH===================================*/	

							if ($totalgiradascausa>0) {
								echo "<script > setTimeout(function(){ location.href='listaordenesgiradas.php?squart=$encriptado'; }, 500); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
							}
							else
							{
								echo "<script > setTimeout(function(){ location.href='causasordenesgiradas.php'; }, 1000); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
							}

							//echo "<script > setTimeout(function(){  }, 2000); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
					    }
					else
					{
						echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Al Parecer Algo Salio Mal, Verifique por Favor ','warning'); </script>";
					}

		        }
	 		
	}//CUANDO SE GIRA EL PRESUPUESTO
	else
	{
     echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Giro El Presupuesto ','warning'); </script>";
	}		
	
}//FIN DE TODA LA FINCION


/*FUNCIONES PARA ENVIAR NOTIFICACIONES PUSH*/

function send_notification ($tokens, $message = "", $n)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
         /*'to'             => $tokens,*/
         'registration_ids' => $tokens,
         'priority'     => "high",
         'notification' => $n,
         'data'         => $message
    );

    //var_dump($fields);

    $headers = array(
        'Authorization:key = AAAAw9UVT0w:APA91bEtfDH55NLKJdaMwhR54aaA_-pggP-CsSzb74Vh6FiJ14zHMt4D000UVLnYBE0zxyujWYlnE6K64nJxaiM_-94tMj0lpdRpj-Nf7OPO0mnismHi92oXB-xcL6Gj3-aaahi32LRU',
        'Content-Type: application/json'
        );

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   $result = curl_exec($ch);           
   if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
   }
   curl_close($ch);
   return $result;
}

function enviarNotPuschPresupuesto($idcausa,$idprocu,$idorden)
{     /*Seleccionamos la planilla 9*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(9);
      $filplanilla=mysqli_fetch_object($resulplanilla);
      $envia_notif=$filplanilla->envia_notif;
      $emisor=$filplanilla->emisor;
      //$tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
      //$receptor_estatico=$filplanilla->receptor_estatico;
      $asunto=$filplanilla->asunto;
      $texto=$filplanilla->texto;


      if ($envia_notif==1) //preguntamos si envia la notificacion
      {
        $objcodcausa=new Causa();
        $resulcod=$objcodcausa->listarUnaCausaCualquiera($idcausa);
        $filcod=mysqli_fetch_object($resulcod);
        $codigocausa=$filcod->codigo;
             
        $objproc=new Procurador();
        $resultp=$objproc->mostrarunprocuradro($idprocu);
        $filp=mysqli_fetch_object($resultp);


// $tokens[] = $fila->token;
        //Reemplazamos los nombrel asunto 
              $searchasunto = array('[codigocausa]',
                                    '[numeroorden]');
              $replaceasunto = array($codigocausa,
                                     $idorden);
              $asuntoModif= str_replace($searchasunto,$replaceasunto,$asunto);

 /*Armando del link para redireccionar en la notificacion*/
        $host= $_SERVER["HTTP_HOST"];
   // $url= $_SERVER["REQUEST_URI"];
        $urlresumen='/procurador/orden.php?squart='.$encriptadoorden;
   // echo "http://" . $host . $url;echo "<br>";
   // echo $url;
        $urlredireccion=$urlresumen;

     $msg = array
      (
          'title'     => $asuntoModif,
          'body'     =>  $texto,
          'message'   => 'Este mensaje es para usted, activo',  
          'subtitle'  => 'This is a subtitle. subtitle',
          'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
          'vibrate'   => 1,
          'requireInteraction' => 'true',
          'sound'     => 'warning',
          'icon'     =>'../resources/logoserrate3.jfif',
         // 'click_action'=>$urlredireccion,
          'largeIcon' => 'large_icon',
          'smallIcon' => 'small_icon'
      );
/*ESTA NOTIFICACION ES PARA CUANDO EL NAVEGADOR ESTA CERRADO ESTA INACTIVO, (AL PARECER)*/
      $n = array(
          "title" => $asuntoModif,
          "body"  => $texto,
          "text"  => "Click me to open an Activity!",
          "icon" => "resources/logoserrate3.jfif",
          //"click_action"=> $urlredireccion,
          "requireInteraction" =>"true",
          "vibrate"=>1,
          "sound" => "warning"
      );

  $tokens[]=$filp->token;
  $message_status = send_notification($tokens, $msg, $n);

  }/*fin del if que pregunta si esta activo para enviar notificacion*/
}/*Fin de la funcion que envia la notificacion pusch*/


/*function modificarorden()
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
			$objord->setestadoorden('Presupuestada');
			$objord->modificar_alpresupuestar();

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

					if ($totalgiradascausa>0) {
						echo "<script > setTimeout(function(){ location.href='listaordenesgiradas.php?squart=$encriptado'; }, 500); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
					}
					else
					{
						echo "<script > setTimeout(function(){ location.href='causasordenesgiradas.php'; }, 1000); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
					}

					//echo "<script > setTimeout(function(){  }, 2000); swal('$nom','Se Giro El Presupuesto Con Exito','success'); </script>";
			    }
			else
			{
				echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Giro El Presupuesto ','warning'); </script>";
			}

    }
  

	
}*/
?>