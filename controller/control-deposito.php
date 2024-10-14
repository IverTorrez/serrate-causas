<?php  
     if (isset($_POST['btnregdeposito'])) {

         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         //echo $concat; echo "<br>";

         $objcausa=new Causa();
         $list=$objcausa->mostrarcajacausa($_POST['textidcausa']);
         $fil=mysqli_fetch_object($list);

         $dep=$_POST['textmonto']; 

         

         $sumadeposito=$dep+$fil->caja;

         //echo $sumadeposito;

         $objdeposito=new Deposito();
         $objdeposito->setfechadeposito($concat);
         $objdeposito->setdetalledeposito($_POST['textdetalle']);
         $objdeposito->setmontodeposito($_POST['textmonto']);
         $objdeposito->setid_causadeposito($_POST['textidcausa']);
         $objdeposito->settipodeposito('Deposito');
         $objdeposito->setidorigen(0);

         if ($objdeposito->guardardeposito()) 
         {
             
             $objcausas=new Causa();
              /*ENCRIPTACION DEL CODIGO DE LA CAUSA*/
                 $idcausa1=$_POST['textidcausa'];
                $mascara=$idcausa1*1234567;
                $encriptado=base64_encode($mascara);

             if ($objcausas->sumarEldepositoAcaja($_POST['textidcausa'],$sumadeposito))
              {
                  if ($_POST['checnotif']==null) 
               {
                   $var="";
               }
               else
               {
/*-------------------CODIGO PARA ENVIAR EL CORREO AL CLIENTE--------------------------------*/
               
        /*--------------SALDO DE LA CAUSA-----------------------*/
                /*ES LA SUMA DE LAS ORDENES QUE TODAVIA NO SE PRONUNCIO EL ADMIN, ESTOS COSTOS AUN NO LOS PUEDE VER EL CLIENTE*/
                 $objcausagastos=new Causa();
                 $resulgastosSinCOnfir=$objcausagastos->SumadorDeGastoProcesalesDeCausaSinconfirmarPorAdmin($idcausa1);
                 $filsinconfir=mysqli_fetch_object($resulgastosSinCOnfir);
                 
                $saldocausa=$sumadeposito+$filsinconfir->CostoproceSInConfirmar;   
                enviarCorreoDepositoCausa($saldocausa);
             
/*--------------------FIN DEL CODIGO PARA ENVIAR CORREO---------------------------------------*/
                $var="Se enviaron los correos";
               }/*fin del else que envia los correo*/
                  
                echo "<script > setTimeout(function(){ location.href='listaordenes.php?squart=$encriptado'; }, 2000); swal('EXELENTE','Se Deposito a la Causa','success'); </script>";
              }
              else
              {
                echo "<script > setTimeout(function(){  }, 2000); swal('ERROR FATAL','COMUNIQUESE CON EL INGENIERO E INFORME DEL PROBLEMA','warning'); </script>";
              }

             
         }
         else
         {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Deposito','warning'); </script>";
 
         }


     }

//FUNCION PARA ENVIAR CORREO ELECTRONICO
function enviarCorreoDepositoCausa($saldocausa)
{   /*Se obtiene los datos de la planilla con codigo 6*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(6);
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
                              '[montodeposito]',
                              '[fechahora]',
                              '[saldocausa]');
            $replace = array('<b>'.$nombreCliente.'</b>',
                             '<b>'.$codigocausa.'</b>',
                             '<b>'.$nombrecausa.'</b>',
                             '<b>'.$montodeposito.'</b>',
                             '<b>'.$fechahora.'</b>',
                             '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
           
            if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
            {
               //Correo para el Cliente   
             mail($destinocli,$asuntoModif,$textomodificado,$cabeceras);
             //Correo para el abogado
           //  mail($correoAbog,$asuntoAbog,$textomodificado,$cabeceras);
             
            }//fin del if que pregunta si el receptor es dinamico
            else//por falso cargamos el receptor estatico
            {
              $receptor=$receptor_estatico;
            //Correo para el destino      
              mail($receptor,$asuntoModif,$textomodificado,$cabeceras);
            }
      }//fin cuando pregunta si envia notificacion


} //fin de funcion de enviar correo

     ?>
