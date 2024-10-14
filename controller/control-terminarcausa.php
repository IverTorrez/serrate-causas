<?php
if (isset($_POST['btnterminar'])) {
	terminarunacausa();
}

function terminarunacausa() 
{
	if ($_POST['textcant']==0) 
	{
		$objt=new Causa();
		$result=$objt->totalCostosfinalSinCOnfirmar($_POST['textidcausa']);
		$filt=mysqli_fetch_object($result);
		if ($filt->totalsinconfirmar==0) 
		{
			$objcausa=new Causa();
			$objcausa->setid_causa($_POST['textidcausa']);
			$objcausa->setestadocausa('Terminada');

			if ($objcausa->cambiarestadoCausa()) {
/*---------------CODIGO PARA ENVIAR EL CORREO A LOS USUARIOS----------------*/
                enviarCorreoTerminarCausa();           
/*----------------FIN CODIGO PARA ENVIAR EL CORREO A LOS USUARIOS-----------------*/

				echo "<script > setTimeout(function(){ location='causasActivas.php' }, 1000); swal('Exelente','Se Termino La Causa Con Exito','success'); </script>";
			}
			else{
				echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se termino La Causa','warning'); </script>";
			}
		}/*FIN DEL IF QUE PREGUNTA SI EL TOTAL DE ORDENES SIN CONFIRMAR ES IGUAL A CERO*/
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se puede terminar  La Causa, porque hay ordenes sin Consignar el costo judicial venta','warning'); </script>";
		}
	}/*--------FIN DEL IF QUE PREGUNTA SI LA CANTIDAD DE ORDENES SIN SERRAR ES IGUAL A CERO*/
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se puede terminar  La Causa, porque hay ordenes en proceso','warning'); </script>";
	}

	
}

//FUNCION PARA ENVIAR CORREO ELECTRONICO
function enviarCorreoTerminarCausa()
{   /*Se obtiene los datos de la planilla con codigo 5*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(5);
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
            /*correo para el abogado*/
             $objabog=new Abogado();
             $resultabog=$objabog->listarUnAbogadosDeUnaCausa($_POST['textidcausa']);
             $filabog=mysqli_fetch_object($resultabog);
             $correoCopia=$filabog->correoabog;
             $nombreAbogado=$filabog->nombreabog.' '.$filabog->apellidoabog;
                  /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$correoCopia.""."\r\n" .  // esto ser¨ªa copia normal
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
              $asuntoModif  = str_replace($searchasunto,$replaceasunto,$asunto);

            /*SACAMOS LOS DATOS DEL CLIENTE, Y EL CORREO*/    
             $objcli=new Cliente();
             $resulcli=$objcli->mostrarUNClienteenCausa($_POST['textidcausa']);
             $filcli=mysqli_fetch_object($resulcli);
             $nombreCliente=$filcli->nombrecli." ".$filcli->apellidocli;
             $destinocli=$filcli->correocli;
        
            //Reemplazamos los nombre de causas, abogado procurador etc
              $search = array('[nombreapellidocliente]', 
                            '[codigocausa]', 
                            '[nombrecausa]');
            $replace = array('<b>'.$nombreCliente.'</b>',
                            '<b>'.$codigocausa.'</b>',
                            '<b>'.$nombrecausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);

           
           
            if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
            {
               //Correo para el Cliente   
             mail($destinocli,$asuntoModif,$textomodificado,$cabeceras);
             
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