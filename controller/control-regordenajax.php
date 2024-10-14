 <?php
 error_reporting(E_ERROR);
 include_once('../model/clscausa.php');
include_once('../model/clsprioridad.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clscotizacion.php');
include_once('../model/clscliente.php');
include_once('../model/clsprocurador.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');
$accion='crear';
$resultado->error =false;
$resul=''; 

if (isset($_GET['accion'])) 
{
  $accion=$_GET['accion'];
  switch ($accion) {
    case "crear":

        $idcausas=$_POST['textidcausa'];
   $idprocu=$_POST['selectproc'];
   
     $f1=$_POST['fechainicio'];
     $h1=$_POST['horainicio'];
     $f2=$_POST['fechafinal'];
     $h2=$_POST['horafinal'];
     if ( ($f1!=null) and ($h1!=null) and ($f2!=null) and ($h2!=null) ) {
      //echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Las Fechas no son nulas','success'); </script>";
      // $fechini1=$_POST['fechainicio'];
       $fechini1=$f1;
    $newfechini1=date_create($fechini1);
    $fechainiformato=date_format($newfechini1, 'Y-m-d');


   // $horaini1=$_POST['horainicio'];
    $horaini1=$h1;
    $newhoraini1=date_create($horaini1);
    $horainiformato=date_format($newhoraini1, 'H:i');
    $fechasinihoracompleto=$fechainiformato.' '.$horainiformato;

    ///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
    ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     ////$concat es la fecha y hora del sistema
     $concat=$fechoyal.' '.$horita;

     ///fecha y hora final
     $fechfin2=$_POST['fechafinal'];
    $newfechfin2=date_create($fechfin2);
    $fechafinformato=date_format($newfechfin2, 'Y-m-d');


    $horafin2=$_POST['horafinal'];
    $newhorafin2=date_create($horafin2);
    $horafinformato=date_format($newhorafin2, 'H:i');

    $fechasfinhoracompleto=$fechafinformato.' '.$horafinformato;
    /////////////////////
    //AQUI SE HACE LA VALIDACION DE FECHAS ES DECIR: FECHA INICIO MAYOR A FECHA DEL SISTEMA Y FECHA FIN MAYOR A FECHA INICIO
   /* */
    
     if ($fechasinihoracompleto>$concat) 
     {

         if ($fechasfinhoracompleto>$fechasinihoracompleto) 
         {
           //echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Fecha Final es mayor que Fecha Inicio TODO ESTA BIEN','success'); </script>";
             ///AQUI SE SACA LA HORA DEL SISTEMA Y SE DA FORMATO A LA FECHA Y HORA
   /*  ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;*/


   /* $f1=$_POST['fechainicio'];
    $f2=$_POST['fechafinal'];

    */
    //$horafinal=$_POST['horafinal'];
    $horafinal=$h2;

     //LA FECHA INTRODUCIDA SE CAMBIA DE FORMATO A Aﾃ前-MES-DIA
     $date=date_create($f2); 
     $nuevafecha=date_format($date, 'Y-m-d');
  //  echo ' Fecha Final con FORMATO :'.$nuevafecha; echo "<br>"; 
   
     //LA HORA INTRODUCIDA SE CAMBIA EL FORMATO A HORA-MINITO-SEGUNDO
    $horas=date_create($horafinal); 
    $nuevahora=date_format($horas, 'H:i:s');
  //  echo 'Hora Final con FORMATO :'.$nuevahora;echo "<br>";

   $fechahora=$nuevafecha.$nuevahora;
  //  echo 'Fecha y Hora Final juntos :'.$fechahora;echo "<br>";


    ///ESTAS DOS LINEAS DE CODIGO AGARRAN FECHA Y HORA DE LA ZONA HORARIA Y FECHA Y HORA FINAL PUESTA POR EL ABOGADO
    $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
    $fecha2 =new DateTime($fechahora);


    $intervalo= $fecha1->diff($fecha2);

 //   echo 'DIferencia de horas  :'.$intervalo->format('%Y-%m-%d %H:%i:%s');echo "<br>"; 
 //   echo 'Fecha y hora actual  :'.$concat;echo "<br>";
    

    //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
    $mesentero=intval($intervalo->format('%m'));
    $diasmes=$mesentero*30;
    $diasentero=intval($intervalo->format('%d'));
    $horaentero=intval($intervalo->format('%H'));
    $minutos=intval($intervalo->format('%i'));

 //   echo 'DIAS ENTEROS  :'.$diasentero;echo "<br>";
 //   echo 'HORAS ENTEROS  :'.$horaentero;echo "<br>";   
  //  echo 'MINUTOS ENTEROS  :'.$minutos;echo "<br>";
     

     /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
    $totaldeminh=$horaentero*60;
    $totalminDia=($diasentero+$diasmes)*1440;
    
    //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
    $resultadomin=$totaldeminh+$totalminDia+$minutos;
   
   ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
    $resultadohoradecimal=$resultadomin/60;



    
  /*  */
     $resultadohora= round($resultadohoradecimal,2);/*redondeamos a dos decimales*/
  //PREGUNTA EL TOTAL DE LAS HORAS DE CADA ORDEN
      if ($resultadohora>=96) {
        $condicion=1;
      }
      if ($resultadohora>=24 and $resultadohora<96) {
        $condicion=2;
      }
      if ($resultadohora>=8 and $resultadohora<24) {
        $condicion=3;
      }
      if ($resultadohora>=3 and $resultadohora<8) {
         $condicion=4;
      }
      if ($resultadohora>=1 and $resultadohora<3) {
        $condicion=5;
      }
      if ($resultadohora<1) {
        $condicion=6;
      }
      $prioridad=$_POST['selectprioridad'];

    //  echo "La condicion es:".$condicion;echo "<br>";echo "<br>";
    //  echo "La prioridad es:".$prioridad;echo "<br>";echo "<br>";
  
     //obtenemos datos de la tabla prioridad para hacr cotizacion
      $objprioridad=new Prioridad();
      $listprio=$objprioridad->muestraprioridadselect($prioridad,$condicion);
      $fil=mysqli_fetch_object($listprio);
    //  echo "BD El id es:".$fil->id_prioridad;echo "<br>";echo "<br>";
    //   echo "BD El nombre de prio es:".$fil->nombreprioridad;echo "<br>";echo "<br>";
    //   echo "BD El preciocompra es:".$fil->preciocompra;echo "<br>";echo "<br>";
    //  echo "BD El precioventa es:". $fil->precioventa;echo "<br>";echo "<br>";
      // echo "BD la penalizacion  es:".$fil->penalizacion;echo "<br>";echo "<br>";
      // echo "BD La condicion es:".$fil->condicion;echo "<br>";echo "<br>";
      
      $objorden=new OrdenGeneral();
    $objorden->setinformacion($_POST['texteditorinformacion']);
    $objorden->setdocumentacion($_POST['texteditordocum']);
    $objorden->setfechainiorden($_POST['fechainicio']); //la fecha que da el abogado, desde cuando empieza la orden
    $objorden->setfechafinorden($_POST['fechafinal']);//fecha que da el abogado, cuando caduca la orden
    $objorden->sethorainiorden($_POST['horainicio']);//la hora que da el abogado, desde cuando empieza la orden
    $objorden->sethorafinorden($_POST['horafinal']);//hora que da el abogado, cuando caduca la orden
    $objorden->setfechagiro($concat); //fecha cuando se giro la orden la pone el sistema
    $objorden->setplazohoras($resultadohora);//el total de horas entre fechagiro y fechafinal
    $objorden->setestadoorden('Girada');//la orden ya a sido girada
    $objorden->setprioridaorden($fil->nombreprioridad);//no se muy bien para que lo puse, por el momento esta asi
    $objorden->setid_causaorden($idcausas);
    $objorden->setid_procuradororden($idprocu);
    $objorden->setid_prioridadorden($fil->id_prioridad);

    $objorden->settiporden('Normal');
    $objorden->setvisible('Si');

    $fechainibandera=$_POST['fechainicio'].' '.$_POST['horainicio'].':'.'00';
    
    $objorden->setinfosolotexto($_POST['solotextoinfo']);
    $objorden->setdocsolotexto($_POST['solotextodoc']);
    $objorden->setfechainibandera($fechainibandera);
    $objorden->set_notificadoemail('No');
/*========CARGAMOS EL LUGAR DE EJECUCION*/
    $objorden->set_lugar_ejecucion($_POST['lugar_ejecucion']);
    
    $idcausas=0;
    $idcausas=$_POST['textidcausa'];
     $mascara=$idcausas*12345678910;
    $encriptado=base64_encode($mascara);
  

          if ($objorden->guardarorden()) 
          {
            
              $objcotiz=new Cotizacion();
              $objcotiz->setcotizacioncompra($fil->preciocompra);
              $objcotiz->setcotizacionventa($fil->precioventa);
              $objcotiz->setcotizacionpenalidad($fil->penalizacion);
              $objcotiz->setprioridadcoti($prioridad);
              $objcotiz->setcondicioncoti($condicion);

              $objord=new OrdenGeneral();
              $idcausa=$_POST['textidcausa'];
              $resul=$objord->listarultimaordenDeAbogado($idcausa);
              $fila=mysqli_fetch_object($resul);

              /*AQUI VERIFICARA SI ESTA ORDEN YA TIENE UNA COTIZACION*/

              $objcotveri=new Cotizacion();
              $resulcotiveri=$objcotveri->mostrarcotizaciondeorden($fila->ultorden);
              $filaveri=mysqli_fetch_object($resulcotiveri);

              if ($filaveri->id_cotizacion=='') 
              {
                  $objcotiz->setid_ordencotizacion($fila->ultorden);
                  if ($objcotiz->guardarcotizacion()) 
                  {
                    $resultado->error='true';
                    
                  }
                  else
                  {
                    $resultado->error='false';
                    
                  }
              }
/*--------------ENVIA CORREO AL CLIENTE------------------------------------*/
               enviarCorreoCrearOrden();
               enviarNotPuschCrearOrden($idcausa,$idprocu);
        
/*--------------FIN DE ENVIO DE CORREO DE CORREO AL CLIENTE----------------*/

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
	
//                 $objproc=new Procurador();
//                 $resultp=$objproc->mostrarunprocuradro($idprocu);
//                 $filp=mysqli_fetch_object($resultp);

//                 $inicioOrden=$_POST['fechainicio'].' '.$_POST['horainicio'];
//                 $finOrden=$_POST['fechafinal'].' '.$_POST['horafinal'];

// $mensajePHP="
// GIRO DE NUEVA ORDEN
// EL abogado giro la orden ".$fila->ultorden." a la causa con codigo ".$codigocausa. "

// Para el procurador :".$filp->Nombre."
// Inicio de vigencia : ".$inicioOrden. " 
// Termino de vigencia : ".$finOrden;                                

//                 $apiToken="1267787795:AAHPMazq5TSJOJPXRBkWqPiA6DCrEEI1AZ8";/*TOKEN DEL BOT de telegram*/
//                 $data=[
//                   'chat_id'=>'@NotificacionesSerrate', /*nombre del canal publico*/
//                   'text'=>$mensajePHP
//                 ];

//                 $response=
//                 getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?". http_build_query($data));
                
               

/*-------------FIN DE ENVIO DE NOTIFICACION POR TELEGRAM--------------------------**/

          }/*FIN DEL IF QUE PREGUNTA SI SE GUARDO LA ORDEN*/
             


         }/*FIN DEL IF QUE PREGUNTA SI FECHA FINAL ES MAYO A FECHA INICIO*/
         else
         {
           $resultado->error='error1';
           /*"<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora  Final deben ser mayores a Fecha y Hora inicio ','warning'); </script>";*/
         }
       
     }
     else{
       $resultado->error= 'error2';
       /*"<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora Inicio deben ser mayores a la Fecha y Hora actual, Asegurese de que la Fecha y Hora Inicio sean mayores que la fecha y hora  actual ','warning'); </script>";*/
     }

       
     }
     else{
    $resultado->error='error3';
    /*"<script > setTimeout(function(){ }, 2000); swal('ERROR',' Complete todos los campos de fechas y horas','warning'); </script>";*/
     }
      
      break;
    
    default:
      # code...
      break;
  }/*fin de switch*/
}/*fin del if*/


 //FUNCION PARA ENVIAR CORREO ELECTRONICO
function enviarCorreoCrearOrden()
{   /*Se obtiene los datos de la planilla con codigo 7*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(7);
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

             $objcodcausa=new Causa();
             $resulcod=$objcodcausa->listarUnaCausaCualquiera($_POST['textidcausa']);
             $filcod=mysqli_fetch_object($resulcod);
             $codigocausa=$filcod->codigo;
             $nombrecausa=$filcod->nombrecausa;

            //Reemplazamos los nombrel asunto 
              $searchasunto = array('[codigocausa]');
             $replaceasunto = array($codigocausa);
                $asuntoModif= str_replace($searchasunto,$replaceasunto,$asunto);

            $montodeposito=$_POST['textmonto'];
            ini_set('date.timezone','America/La_Paz');
            $fechoyal=date("Y-m-d");
            $horita=date("H:i");
            $fechahora=$fechoyal.' '.$horita;

            $cargaInformacion=$_POST['texteditorinformacion'];
           
            if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
            {
              
            /*SACAMOS LOS DATOS DEL CLIENTE, Y EL CORREO*/    
             $objcli=new Cliente();
             $resulcli=$objcli->mostrarUNClienteenCausa($_POST['textidcausa']);
             $filcli=mysqli_fetch_object($resulcli);
             $nombreCliente=$filcli->nombrecli." ".$filcli->apellidocli;
             $destinocli=$filcli->correocli;

            //Reemplazamos los nombre de causas, abogado procurador etc
              $search = array('[nombreapellidocliente]', 
                              '[codigocausa]', 
                              '[nombrecausa]',
                              '[cargaInformacion]');
            $replace = array('<b>'.$nombreCliente.'</b>',
                             '<b>'.$codigocausa.'</b>',
                             '<b>'.$nombrecausa.'</b>',
                              $cargaInformacion);
            $textomodificado=str_replace($search,$replace,$texto);

               //Correo para el Cliente   
             mail($destinocli,$asuntoModif,$textomodificado,$cabeceras);
             //Correo para el abogado
           //  mail($correoAbog,$asuntoAbog,$textomodificado,$cabeceras);
             
            }//fin del if que pregunta si el receptor es dinamico
            else//por falso cargamos el receptor estatico
            {
                  $receptor=$receptor_estatico;
                  
               /*SACAMOS LOS DATOS DEL CLIENTE, Y EL CORREO*/    
             $objcli=new Cliente();
             $resulcli=$objcli->mostrarUNClienteenCausa($_POST['textidcausa']);
             $filcli=mysqli_fetch_object($resulcli);
             $nombreCliente=$filcli->nombrecli." ".$filcli->apellidocli;
             $destinocli=$filcli->correocli;

              //Reemplazamos los nombre de causas, abogado procurador etc
              $search = array('[nombreapellidocliente]', 
                              '[codigocausa]', 
                              '[nombrecausa]',
                              '[cargaInformacion]');
            $replace = array('<b>'.$nombreCliente.'</b>',
                             '<b>'.$codigocausa.'</b>',
                             '<b>'.$nombrecausa.'</b>',
                              $cargaInformacion);
            $textomodificado=str_replace($search,$replace,$texto);
          
            //Correo para el destino      
              mail($receptor,$asuntoModif,$textomodificado,$cabeceras);
            }
      }//fin cuando pregunta si envia notificacion


} //fin de funcion de enviar correo  


/*===============ENVIO DE NOTIFICACION PUSCH=====================================*/

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
}/*fin de enviar notif*/

function enviarNotPuschCrearOrden($idcausa,$idprocu)
{     /*Seleccionamos la planilla 8*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(8);
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

/*Obtenemos el numero de la orden girada*/
        $objorden=new OrdenGeneral();
        $resultulorden=$objorden->listarultimaorden($idcausa);
        $filult=mysqli_fetch_object($resultulorden);
        $codigoorden=$filult->ultorden;
        $mascaraorden=$codigoorden*1020304050;
        $encriptadoorden=base64_encode($mascaraorden);
// $tokens[] = $fila->token;
        //Reemplazamos los nombrel asunto 
              $searchasunto = array('[codigocausa]',
                                    '[numeroorden]');
              $replaceasunto = array($codigocausa,
                                     $codigoorden);
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

  $tokens[]=$filp->token;
  $message_status = send_notification($tokens, $msg, $n);

  }/*fin del if que pregunta si esta activo para enviar notificacion*/
}/*Fin de la funcion que envia la notificacion pusch*/
// echo $message_status;

/*==============FINENVIO DE NOTIFICACION PUSCH===================================*/

echo json_encode($resultado);
die();


?>