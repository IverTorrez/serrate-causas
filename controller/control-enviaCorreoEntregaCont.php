<?php
include_once('../model/clsprocurador.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');
include_once('../model/clscontador.php');

if ($_POST['idprocu']>0) {
  $idprocu=$_POST['idprocu'];
  $fechaentrega=$_POST['fechaentrega'];
  $montoentregado=$_POST['montoentregado'];
  $tabladetalle=$_POST['tabladetalle'];
  $idcontador=$_POST['idcontador'];

  $tabladetallecontodo="<table border='1' cellspacing='0' cellpadding='1'>
                              <thead>
                               <tr>
                                 <th>Código causa</th>
                                 <th># de orden</th>
                                 <th>Monto presupuesto Bs.</th>
                               </tr>
                              </thead>
                            <tbody>";
  $tabladetallecontodo.=$tabladetalle;
  $tabladetallecontodo.="</tbody>
                         </table>";
  enviarCorreoEntregarMuchos($fechaentrega,$montoentregado,$tabladetallecontodo,$idprocu,$idcontador);
}

function enviarCorreoEntregarMuchos($fechaentrega,$montoentregado,$tabladetallecontodo,$idprocu,$idcontador)
{ /*Se obtiene los datos de la planilla con codigo 11*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(11);
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
       /*------------envia el correo al contador-------------------------------*/
          $objcont=new Contador();
          $resulconta=$objcont->mostrarunContador($idcontador);
          $filcont=mysqli_fetch_object($resulconta);
          $destinocont=$filcont->correocont;
      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$destinocont.""."\r\n" .  // esto sería copia normal
                        // "Bcc: tumail@dominio.com" . "\r\n" . // esto sería copia oculta
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {
       /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
          $objproc1=new Procurador();
          $resulproc=$objproc1->mostrarunProcurador1($idprocu);
          $filproc=mysqli_fetch_object($resulproc);

          $destinoproc=$filproc->correoproc;
          $nombreProcurador=$filproc->nombreproc.' '.$filproc->apellidoproc;
               
          
            $asuntoproc=$asunto;
           
            //Reemplazamos las variables en el texto
          $search = array('[nombreapellidoprocurador]',
                          '[fechahora]',
                          '[montoentregado]',
                          '[tabladetalle]');
            $replace = array('<b>'.$nombreProcurador.'</b>',
                             '<b>'.$fechaentrega.'</b>',
                             '<b>'.$montoentregado.'</b>',
                             '<b>'.$tabladetallecontodo.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
          

          //Correo para el procurador
         mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
         //Correo para el contador
        // mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         //echo 1;
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico;
           /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
          $objproc1=new Procurador();
          $resulproc=$objproc1->mostrarunProcurador1($idprocu);
          $filproc=mysqli_fetch_object($resulproc);
          $destinoproc=$filproc->correoproc;
          $nombreProcurador=$filproc->nombreproc.' '.$filproc->apellidoproc;

          
            $asuntoproc=$asunto;
          
           //Reemplazamos las variables en el texto
          $search = array('[nombreapellidoprocurador]',
                          '[fechahora]',
                          '[montoentregado]',
                          '[tabladetalle]');
            $replace = array('<b>'.$nombreProcurador.'</b>',
                             '<b>'.$fechaentrega.'</b>',
                             '<b>'.$montoentregado.'</b>',
                             '<b>'.$tabladetallecontodo.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
            //Correo para el destino  
          mail($receptor,$asuntoproc,$textomodificado,$cabeceras);
          //Correo para el contador
         //mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         }
  }//fin cuando pregunta si envia notificacion

}/* fin de funcion enviarCOrreoEntregarMuchos*/



?>