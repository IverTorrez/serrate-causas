<?php
if (isset($_POST['btnactivarcausa'])) {
	activarcausa();
}

function activarcausa() 
{
			
		$objcausa=new Causa();
		$objcausa->setid_causa($_POST['textidcausa']);
		$objcausa->setestadocausa('Activa');

		if ($objcausa->cambiarestadoCausa()) {
/*------------CODIGO PARA ENVIAR CORREOS A LOS USUARIOS-------------------------*/
           enviarCorreoReiniciarCausa();
/*------------FIN  CODIGO PARA ENVIAR CORREOS A LOS USUARIOS-------------------------*/
			echo "<script > setTimeout(function(){ location='causasActivas.php' }, 1000); swal('Exelente',' Ahora la causa esta activa','success'); </script>";
		}
		else{
			echo "<script > setTimeout(function(){  }, 2000); swal('','ERROR No se pudo volver activa la causa','warning'); </script>";
		}
	

	
} 

//FUNCION PARA ENVIAR CORREO ELECTRONICO
function enviarCorreoReiniciarCausa()
{   /*Se obtiene los datos de la planilla con codigo 21*/
      $objplanilla= new Planillas_envio_notificacion();
      $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(21);
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
             $correoAbogado=$filabog->correoabog;

             /*correo para el proc maestro*/
            $objproc1=new Procurador();
            $resulprocM=$objproc1->mostrarProcuradorMaestro();
            $filpm=mysqli_fetch_object($resulprocM);
            $destinoprocM=$filpm->correoproc;

            $correoCopia=$correoAbogado.",".$destinoprocM;

             $nombreAbogado=$filabog->nombreabog.' '.$filabog->apellidoabog;
                  /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$correoCopia.""."\r\n" .  // esto sería copia normal
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