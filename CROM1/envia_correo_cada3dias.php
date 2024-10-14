<?php
error_reporting(E_ERROR);
/*ini_set('date.timezone','America/La_Paz');
$fechoyal=date("Y-m-d");
$horita=date("H:i");
$concat=$fechoyal.' '.$horita;*/
       /* $senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
       /* $senior = iconv('UTF-8', 'windows-1252', $senior);*/

       /* $credito = stripslashes('crédito'); /*se pasa los datos para que se interprete*/
       /* $credito = iconv('UTF-8', 'windows-1252', $credito);*/

        /*$comprension = stripslashes('comprensión'); /*se pasa los datos para que se interprete*/
       /* $comprension = iconv('UTF-8', 'windows-1252', $comprension);*/
$cajaCausasMascara=0;
include_once('../model/clscausa.php');
include_once('../model/clsusuario.php');
include_once('../model/clscliente.php');
include_once('../model/clsplanilla_notificacion.php');
	$objcausa=new Causa();
	$resultcausa=$objcausa->listarcausasConSaldoENtre300y0();
	while ($filcausa=mysqli_fetch_object($resultcausa)) 
	{
	/*ES LA SUMA DE LAS ORDENES QUE TODAVIA NO SE PRONUNCIO EL ADMIN, ESTOS COSTOS AUN NO LOS PUEDE VER EL CLIENTE*/
	     $idcausa=$filcausa->idcausa;
		 $objcausagastos=new Causa();
         $resulgastosSinCOnfir=$objcausagastos->SumadorDeGastoProcesalesDeCausaSinconfirmarPorAdmin($idcausa);
         $filsinconfir=mysqli_fetch_object($resulgastosSinCOnfir);
         $cajaCausasMascara=$filcausa->caja+$filsinconfir->CostoproceSInConfirmar;
         /*PRESGUNTA SI LA CAJA DE LA CAUSA ESTA ENTRE 300 Y 60, INCLUSO DESPUES DE SUMARLE SU COSTOS JUDICIALES SIN CONFIRMAR*/
         if ($cajaCausasMascara<=300 and $cajaCausasMascara>=60) 
         {
            $clienteNombre=$filcausa->clienteasig;
            $nombreCausa=$filcausa->nombrecausa;
         	$codigocausa=$filcausa->codigo;
			$saldocausa=$cajaCausasMascara;
			/*$destino=$filcausa->correocliente;
			$asunto="ALERTA: SALDO INSUFICIENTE PARA COSTOS PROCESALES $codigocausa";
			$mensajedecorreo="$senior cliente. $clienteNombre: \n";
			$mensajedecorreo.="A la presente fecha $concat, su causa $codigocausa de nombre $nombreCausa apenas tiene un saldo de $saldocausa bolivianos para la partida de los costos procesales. \n"; 
			$mensajedecorreo.="En este sentido, le recomendamos que realice el depósito correspondiente para así aumentar su saldo disponible. \n";
			$mensajedecorreo.="Agradecemos su $comprension. \n";
			$mensajedecorreo.="Atte. El Sistema";

			$cabeceras = 'From: SERRATE <sistema@serrate.com.bo >' . "\r\n" .
			'Reply-To: sistema@serrate.com.bo ' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	         mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
	         
	         /*obtenemos el correo del user admin*/
		       /*      $objuser=new Usuario();
		             $resultuser=$objuser->MostrarUserAdmin();
		             $filuser=mysqli_fetch_object($resultuser);
		             $correoadmin=$filuser->correousuario;
		      $asuntoadmin=$asunto."(Copia)";
		   mail($correoadmin,$asuntoadmin,$mensajedecorreo,$cabeceras);*/

		   enviarCorreoCada3DiaSaldoentre60y300($idcausa,$saldocausa);
         	
         }/*fin del if que pregunta si la caja esta entre 300 y 60*/

		
	}/*FIN DEL WHILE*/
	
		/*PRUEBA DE MENSAJE PARA MI IVER TORREZ*/
// 	$destinoiver="ivertorrez23@hotmail.com";
// 	$asuntoiver="Envio de correo Cada 3 Dias $concat";
// 	$mensajeiver="Este es el correo cada 3 Dias a las 20:00 pm hora de francia(hora del servidor), en Bolivia es las 14:00, 6 hr. diferencia  empezo el martes 8 de octubre 2019";
// 	$cabezaraiver='From: SERRATE <info@serrate.bo>' . "\r\n" .
// 		'Reply-To: info@serrate.bo' . "\r\n" .
// 		'X-Mailer: PHP/' . phpversion();
	
// 	mail($destinoiver,$asuntoiver,$mensajeiver,$cabezaraiver);
function enviarCorreoCada3DiaSaldoentre60y300($idcausa,$saldocausa)
{ ini_set('date.timezone','America/La_Paz');
  $fechoyal=date("Y-m-d");
  $horita=date("H:i");
  $fechahora=$fechoyal.' '.$horita;
  /*Se obtiene los datos de la planilla con codigo 16*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(16);
  $filplanilla=mysqli_fetch_object($resulplanilla);
  $envia_notif           =$filplanilla->envia_notif;
  $emisor                =$filplanilla->emisor;
  $tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
  $receptor_estatico     =$filplanilla->receptor_estatico;
  $asunto                =$filplanilla->asunto;
  $texto                 =$filplanilla->texto;
  $nombre_emisor         =$filplanilla->nombre_emisor;
  if ($envia_notif==1) //preguntamos si envia la notificacion
  { //preguntamos si existe un emisor con direccion de correo electronico valido 
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
        /*obtenemos el correo del user admin para la copia*/
            $objuser=new Usuario();
            $resultuser=$objuser->MostrarUserAdmin();
            $filuser=mysqli_fetch_object($resultuser);
            $correoAdmin=$filuser->correousuario;      
       
        /*Datos del cliente*/
            $objcli=new Cliente();
        	$resultcli=$objcli->mostrarUNClienteenCausa($idcausa);
        	$filcli=mysqli_fetch_object($resultcli);
        	$correoDestino         =$filcli->correocli;
        	$nombreapellidocliente =$filcli->nombrecli." ".$filcli->apellidocli;
        /*Datos de la causa*/
            $objca=new Causa();
            $resultc=$objca->mostrarUnacausa($idcausa);
            $filcausa=mysqli_fetch_object($resultc);
            $codigocausa=$filcausa->codigo;
            $nombrecausa=$filcausa->nombrecausa;

      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$correoAdmin.""."\r\n" .  // esto sería copia normal
                        // "Bcc: tumail@dominio.com" . "\r\n" . // esto sería copia oculta
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
            //Reemplazamos DEL ASUNTO
            $search_asunto  = array('[codigocausa]');
            $replace_asunto = array($codigocausa);
            $asuntomodificado=str_replace($search_asunto,$replace_asunto,$asunto);
            //Reemplazamos las variables en el texto
              $search = array('[nombreapellidocliente]',
                              '[fechahora]',
                              '[codigocausa]',
                              '[nombrecausa]',
                              '[saldocausa]');
             $replace = array('<b>'.$nombreapellidocliente.'</b>',
                              '<b>'.$fechahora.'</b>',
                              '<b>'.$codigocausa.'</b>',
                              '<b>'.$nombrecausa.'</b>',
                              '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);

      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {

  
          //Correo para el destino
         mail($correoDestino,$asuntomodificado,$textomodificado,$cabeceras);
         //Correo para el contador
        // mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         //echo 1;
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico; 
            //Correo para el destino  
          mail($receptor,$asuntomodificado,$textomodificado,$cabeceras);
          
         }
  }//fin cuando pregunta si envia notificacion
}//fin de funcion de enviar correo	
?>