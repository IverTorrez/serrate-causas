<?php
error_reporting(E_ERROR);
/*ini_set('date.timezone','America/La_Paz');
$fechoyal=date("Y-m-d");
$horita=date("H:i");
$concat=$fechoyal.' '.$horita;*/
       /* $senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
       /* $senior = iconv('UTF-8', 'windows-1252', $senior);*/

        /*$credito = stripslashes('crédito'); /*se pasa los datos para que se interprete*/
        /*$credito = iconv('UTF-8', 'windows-1252', $credito);*/

       /* $comprension = stripslashes('comprensión'); /*se pasa los datos para que se interprete*/
      /*  $comprension = iconv('UTF-8', 'windows-1252', $comprension);*/
$cajaCausasMascara=0;
include_once('../model/clscausa.php');
include_once('../model/clsusuario.php');
include_once('../model/clscliente.php');
include_once('../model/clsplanilla_notificacion.php');

	$objcausa=new Causa();
	$resultcausa=$objcausa->listarCausasConSaldoMenosCero();
	while ($filcausa=mysqli_fetch_object($resultcausa)) 
	{
		
		/*ES LA SUMA DE LAS ORDENES QUE TODAVIA NO SE PRONUNCIO EL ADMIN, ESTOS COSTOS AUN NO LOS PUEDE VER EL CLIENTE*/
		 $objcausagastos=new Causa();
         $resulgastosSinCOnfir=$objcausagastos->SumadorDeGastoProcesalesDeCausaSinconfirmarPorAdmin($filcausa->idcausa);
         $filsinconfir=mysqli_fetch_object($resulgastosSinCOnfir);
       //  +$filsinconfir->CostoproceSInConfirmar; Antes le sumabamos el costo procesal sin confirmar por el admin
         $cajaCausasMascara=$filcausa->caja;
         /*PRESGUNTA SI LA CAJA DE LA CAUSA ES MENOR A CERO, INCLUSI DESPUES DE SUMARLE SU COSTOS JUDICIALES SIN CONFIRMAR*/
         if ($cajaCausasMascara<60) 
         {
             $idcausa=$filcausa->idcausa;
            /* $nombreCliente=$filcausa->clienteasig;
             $nombreCausa=$filcausa->nombrecausa;
         	$codigocausa=$filcausa->codigo;
			$saldocausa=$cajaCausasMascara;
			$destino=$filcausa->correocliente;
			$asunto="URGENTE: CAUSA CONGELADA POR SALDO INSUFICIENTE $codigocausa";
			$mensajedecorreo="$senior cliente. $nombreCliente : \n";
			$mensajedecorreo.="A la presente fecha $concat, su causa $codigocausa de nombre $nombreCausa, ha sido congelada temporalmente por tener un SALDO INSUFICIENTE para la partida de los costos procesales.\n";
			$mensajedecorreo.="En este sentido, le solicitamos que urgentemente realice el depósito correspondiente para así retomar su importante causa. \n";
			$mensajedecorreo.="Atte. El Sistema.";

			$cabeceras = 'From: SERRATE <sistema@serrate.com.bo>' . "\r\n" .
			'Reply-To: sistema@serrate.com.bo' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	         mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
	         
	         /*obtenemos el correo del user admin y enviarle*/
		   /*          $objuser=new Usuario();
		             $resultuser=$objuser->MostrarUserAdmin();
		             $filuser=mysqli_fetch_object($resultuser);
		             $correoadmin=$filuser->correousuario;
	        $asuntoadmin=$asunto." Copia";
         	mail($correoadmin,$asunto,$mensajedecorreo,$cabeceras);*/
         	/*fin obtenemos el correo del user admin y enviarle*/
         	enviarCorreoCadaDiaSaldoMenoresCero($idcausa);
         	/*----------------------------------se congelara lacausa--------------------------------------------*/
         	$objcausa=new Causa();
    		$objcausa->setid_causa($idcausa);
    		$objcausa->setestadocausa('Congelada');
    
    		$objcausa->cambiarestadoCausa();
         	/*----------------------------------fin se congelara lacausa--------------------------------------------*/
         }/*FIN DEL IF */
	}/*FIN DEL WHILE*/
	
	/*PRUEBA DE MENSAJE PARA MI IVER TORREZ*/
// 	$destinoiver="ivertorrez23@hotmail.com";
// 	$asuntoiver="Envio de correo Por Dia $concat";
// 	$mensajeiver="Este es el correo cada Dia a las 21:00 pm hora de francia, pero en Bolivia es 15:00, estamos atrasados con 6 horas ";
// 	$cabezaraiver='From: SERRATE <info@serrate.bo>' . "\r\n" .
// 		'Reply-To: info@serrate.bo' . "\r\n" .
// 		'X-Mailer: PHP/' . phpversion();
	
// 	mail($destinoiver,$asuntoiver,$mensajeiver,$cabezaraiver);

function enviarCorreoCadaDiaSaldoMenoresCero($idcausa)
{ ini_set('date.timezone','America/La_Paz');
  $fechoyal=date("Y-m-d");
  $horita=date("H:i");
  $fechahora=$fechoyal.' '.$horita;
  /*Se obtiene los datos de la planilla con codigo 15*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(15);
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
                              '[nombrecausa]');
             $replace = array('<b>'.$nombreapellidocliente.'</b>',
                              '<b>'.$fechahora.'</b>',
                              '<b>'.$codigocausa.'</b>',
                              '<b>'.$nombrecausa.'</b>');
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

