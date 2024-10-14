<?php
include_once('../model/clsprocurador.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');
include_once('../model/clscontador.php');

if ($_POST['idprocu']>0) {
  $idprocu=$_POST['idprocu'];
  $fechainicio=$_POST['fechainicio'];
  $fechafin=$_POST['fechafin'];
  $montopagado=$_POST['montopagado'];
  $tabladetalle=$_POST['tabladetalle'];

  $tabladetallecontodo="<table border='1' cellspacing='0' cellpadding='1'>
                              <thead>
                               <tr>
                                 <th>Código causa</th>
                                 <th># de orden</th>
                                 <th>Monto pagado Bs.</th>
                               </tr>
                              </thead>
                            <tbody>";
  $tabladetallecontodo.=$tabladetalle;
  $tabladetallecontodo.="</tbody>
                         </table>";
  enviarCorreoPagoprocurador($fechainicio,$fechafin,$montopagado,$tabladetallecontodo,$idprocu);
}

function enviarCorreoPagoprocurador($fechainicio,$fechafin,$montopagado,$tabladetallecontodo,$idprocu)
{      ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       $fechahora=$fechoyal.' '.$horita;
  /*Se obtiene los datos de la planilla con codigo 18*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(18);
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
      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
          /*obtenemos el correo del user admin*/
               $objuser=new Usuario();
               $resultuser=$objuser->MostrarUserAdmin();
               $filuser=mysqli_fetch_object($resultuser);
               $correoCopia=$filuser->correousuario;

            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$correoCopia.""."\r\n" .  // esto sería copia normal
                        // "Bcc: tumail@dominio.com" . "\r\n" . // esto sería copia oculta
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
            /*Modificacion de asunto*/
            $searchasunto = array('[fechahora]');
            $replaceasunto = array($fechahora);
            $asuntomodificado=str_replace($searchasunto,$replaceasunto,$asunto);
        
            //Reemplazamos las variables en el texto
             $search = array('[fechainicompleta]',
                          '[fechafincompleta]',
                          '[montoapagar]',
                          '[tabladetalle]');
            $replace = array('<b>'.$fechainicio.'</b>',
                             '<b>'.$fechafin.'</b>',
                             '<b>'.$montopagado.'</b>',
                             '<b>'.$tabladetallecontodo.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);

      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {
       /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
          $objproc1=new Procurador();
          $resulproc=$objproc1->mostrarunProcurador1($idprocu);
          $filproc=mysqli_fetch_object($resulproc);
          $destinoproc=$filproc->correoproc;
        
         //Correo para el procurador
         mail($destinoproc,$asuntomodificado,$textomodificado,$cabeceras);
        
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico;
        
          //Correo para el receptor
         mail($receptor,$asuntomodificado,$textomodificado,$cabeceras);
         }
  }//fin cuando pregunta si envia notificacion

}/* fin de funcion enviarCOrreoEntregarMuchos*/



?>