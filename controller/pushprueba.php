 <?php
 //error_reporting(E_ERROR);
 include_once('../model/clscausa.php');
include_once('../model/clsprioridad.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clscotizacion.php');
include_once('../model/clscliente.php');
include_once('../model/clsprocurador.php');
include_once('../model/clsusuario.php');





/*--------------ENVIA CORREO AL CLIENTE------------------------------------*/
            $senior = stripslashes('Se�0�9or'); /*se pasa los datos para que se interprete*/
            $senior = iconv('UTF-8', 'windows-1252', $senior);

            $codigo1 = stripslashes('c��digo'); /*se pasa los datos para que se interprete*/
            $codigo1 = iconv('UTF-8', 'windows-1252', $codigo1);

            $esta = stripslashes('est��'); /*se pasa los datos para que se interprete*/
            $esta = iconv('UTF-8', 'windows-1252', $esta);

            $tramitacion = stripslashes('Tramitaci��n'); /*se pasa los datos para que se interprete*/
            $tramitacion = iconv('UTF-8', 'windows-1252', $tramitacion);
             

             $mensajedecorreo="$senior. \n";
             $mensajedecorreo.="Informamos a usted, que en su causa de $codigo1 D-FR-34  de nombre Parapcausa, se $esta tramitando lo siguiente: \n";
             $mensajedecorreo.="Todo el tema de estos dias \n";

             $mensajedecorreo.="Atte. El Sistema";

             $asunto="INFORME DE AVANCE 99";

             /*obtenemos el correo del user admin*/
             $objuser=new Usuario();
             $resultuser=$objuser->MostrarUserAdmin();
             $filuser=mysqli_fetch_object($resultuser);
             $correoEmisor=$filuser->correousuario;
             $destino="ivermenacho123@gmail.com";
             $cabeceras = 'From: SERRATE <'.$correoEmisor.'>' . "\r\n" .
                           'Reply-To:'.$correoEmisor.''."\r\n" .
                           'X-Mailer: PHP/' . phpversion();

           //   mail($destino,$asunto,$mensajedecorreo,$cabeceras);
/*--------------FIN DE ENVIO DE CORREO DE CORREO AL CLIENTE----------------*/



















/*===============ENVIO DE NOTIFICACION PUSCH=====================================*/
function send_notification($tokens, $message = "", $n)
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


// $tokens[] = $fila->token;

     $msg = array
      (
          'title'     => $codigocausa."-".$fila->ultorden,
          'body'     =>  'Se giró una nueva orden',
          'message'   => 'Este mensaje es para usted, activo',  
          'subtitle'  => 'This is a subtitle. subtitle',
          'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
          'vibrate'   => 1,
          'requireInteraction'=>'true',
          'sound'     => 'warning',
          'icon'     =>'../resources/logoserrate3.jfif',
          'largeIcon' => 'large_icon',
          'smallIcon' => 'small_icon'
      );
/*ESTA NOTIFICACION ES PARA CUANDO EL NAVEGADOR ESTA CERRADO ESTA INACTIVO, (AL PARECER)*/
      $n = array(
          "title" => "C-RFFDE-23  -  45",
          "body"  => "Se giró una nueva orden",
          "text"  => "Click me to open an Activity!",
          "icon" => "resources/logoserrate3.jfif",
          "requireInteraction" =>"true",
          "sound" => "warning"
      );

  $tokens[]="cMY-GMZfFPu4Ffp0BnXfAx:APA91bEZlZTJBRhyL8N8LHdjYOvh7gEuEOjBBoUZaI3SEHIFemG2atSPsTZVkDfqXz74U0hNBDCIpRJ26NydsxlcdfYKzn-NVtduyQ2stx4VA98_hbMP4PpnnwmB92FnYHZpEcMUgpc9";
  $message_status = send_notification($tokens, $msg, $n);





 echo $message_status;


/*==============FINENVIO DE NOTIFICACION PUSCH===================================*/

?>