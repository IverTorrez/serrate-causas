<?php
include_once('../model/clsordengeneral.php');
include_once('../model/clscausa.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');

    /*ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");*/
	     ////$concat es la fecha y hora del sistema
	    /* $concat=$fechoyal.' '.$horita;*/

	$objorden=new OrdenGeneral();
	$resulorden=$objorden->listarDatosDeOrdenesParaNotificarEmail();
	while ($filorden=mysqli_fetch_object($resulorden)) 
	{
		//$senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
        //$senior = iconv('UTF-8', 'windows-1252', $senior);
        
       // $numero = stripslashes('número'); /*se pasa los datos para que se interprete*/
        /*$numero = iconv('UTF-8', 'windows-1252', $numero);*/
		
		$inicioorden=$filorden->Inicio;
        $idorden=$filorden->codorden;
        $codcausa=$filorden->codigocausa;
        $nombreprocurador=$filorden->procasig;
        $tokenproc=$filorden->token;


        // $destino=$filorden->correoprocurador;
        // $asunto="Inicio De Orden $idorden";
        // $mensajedecorreo="$senior Procurador: $nombreprocurador \n";
        // $mensajedecorreo.="Se le informa que la orden $numero $idorden de la causa $codcausa, que le fue asignada ya entro en vigencia en fecha  $inicioorden \n";
        // $mensajedecorreo.="Fecha de envio de Correo $concat";
        // $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
        //               'Reply-To:  info@serrate.bo' . "\r\n" .
        //               'X-Mailer: PHP/' . phpversion();

        // mail($destino,$asunto,$mensajedecorreo,$cabeceras);
		/*ESTE CODIGO MARCA COMO NOTIFICADO LA ORDEN (PARA QUE YA NO SE NOTIFIQUE LA ORDEN AL PROCURADOR)*/
		$objordenmarcar=new OrdenGeneral();
		$objordenmarcar->set_notificadoemail('Si');
		$objordenmarcar->MarcarNotificacionEmail($idorden);

    $resultcau=$objordenmarcar->mostraridcausadeunaorden($idorden);
    $filacausa=mysqli_fetch_object($resultcau);
    $idcausa=$filacausa->id_causa;
		
/*-------------ENVIO DE NOTIFICACION POR TELEGRAM--------------------------**/
//  function getSslPage($url){
// 		$ch=curl_init();
// 		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
// 		curl_setopt($ch,CURLOPT_HEADER, FALSE);
// 		curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
// 		curl_setopt($ch,CURLOPT_URL,$url);
// 		curl_setopt($ch,CURLOPT_REFERER, $url);
// 		curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
// 		$result=curl_exec($ch);
// 		curl_close($ch);
// 		return $result;
// 	}
	
              
// $mensajePHP="
// INICIO DE VIGENCIA DE ORDEN
// La orden ".$idorden." de la causa con codigo ".$codcausa. "

// Ya entro en vigencia en fecha :".$inicioorden."
// Procurador asignado : ".$nombreprocurador;

//                 $apiToken="1267787795:AAHPMazq5TSJOJPXRBkWqPiA6DCrEEI1AZ8";/*TOKEN DEL BOT de telegram*/
//                 $data=[
//                   'chat_id'=>'@NotificacionesSerrate', /*nombre del canal publico*/
//                   'text'=>$mensajePHP
//                 ];

//                 $response=
//                 getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?". http_build_query($data));
                
               

/*-------------FIN DE ENVIO DE NOTIFICACION POR TELEGRAM--------------------------**/

/*===============ENVIO DE NOTIFICACION PUSCH=====================================*/
 
/*function send_notification ($tokens, $message = "", $n)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(*/
         /*'to'             => $tokens,*/
    /*     'registration_ids' => $tokens,
         'priority'     => "high",
         'notification' => $n,
         'data'         => $message
    );*/

    //var_dump($fields);

 /*   $headers = array(
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
}*//*fin de funcion curl de envio de notificacion*/


// $tokens[] = $fila->token;

  /*   $msg = array
      (
          'title'     => $codcausa.'- ('.$idorden.')',
          'body'     =>'Se inició la vigencia de esta orden.',
          'message'   => 'Este mensaje es para usted, activo',  
          'subtitle'  => 'This is a subtitle. subtitle',
          'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
          'vibrate'   => 1,
          'requireInteraction' => 'true',
          'sound'     => 'warning',
          'icon'     =>'../resources/logoserrate3.jfif',
          'largeIcon' => 'large_icon',
          'smallIcon' => 'small_icon'
      );*/
/*ESTA NOTIFICACION ES PARA CUANDO EL NAVEGADOR ESTA CERRADO ESTA INACTIVO, (AL PARECER)*/
   /*   $n = array(
          "title" => $codcausa."- (".$idorden.")",
          "body"  => "Se inició la vigencia de esta orden.",
          "text"  => "Click me to open an Activity!",
          "icon" => "resources/logoserrate3.jfif",
          "requireInteraction" =>"true",
          "vibrate"=>1,
          "sound" => "warning"
      );

  $tokens[]=$filorden->token;
  $message_status = send_notification($tokens, $msg, $n);*/

// echo $message_status;
  enviarNotPuschInicioOrden($idcausa,$tokenproc,$idorden);
/*==============FINENVIO DE NOTIFICACION PUSCH===================================*/	
		
	}/*fin del while que recorreo las ordenes*/

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
}/*fin de funcion curl de envio de notificacion*/

function enviarNotPuschInicioOrden($idcausa,$tokenproc,$idorden)
{     /*Seleccionamos la planilla 17*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(17);
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
             

// $tokens[] = $fila->token;
        //Reemplazamos los nombrel asunto 
              $searchasunto = array('[codigocausa]',
                                    '[numeroorden]');
              $replaceasunto = array($codigocausa,
                                     $idorden);
              $asuntoModif= str_replace($searchasunto,$replaceasunto,$asunto);

 /*Armando del link para redireccionar en la notificacion*/
        $mascaraorden=$idorden*1020304050;
        $encriptadoorden=base64_encode($mascaraorden);
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
          'click_action'=>$urlredireccion,
          'largeIcon' => 'large_icon',
          'smallIcon' => 'small_icon'
      );
/*ESTA NOTIFICACION ES PARA CUANDO EL NAVEGADOR ESTA CERRADO ESTA INACTIVO, (AL PARECER)*/
      $n = array(
          "title" => $asuntoModif,
          "body"  => $texto,
          "text"  => "Click me to open an Activity!",
          "icon" => "resources/logoserrate3.jfif",
          "click_action"=> $urlredireccion,
          "requireInteraction" =>"true",
          "vibrate"=>1,
          "sound" => "warning"
      );

  $tokens[]=$tokenproc;
  $message_status = send_notification($tokens, $msg, $n);

  }/*fin del if que pregunta si esta activo para enviar notificacion*/
}/*Fin de la funcion que envia la notificacion pusch*/
?>