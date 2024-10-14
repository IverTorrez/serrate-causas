<?php
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');


/*FUNCION PARA MOSTRAR LA CONDICION DE UNA ORDEN*/
function mostrarcondiciondeorden($idordennn)
{
  ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat=$fechoyal.' '.$horita;

      $objneworden=new OrdenGeneral();
      $resultadoorden=$objneworden->mostrarfechayhorafin($idordennn);
      $filordd=mysqli_fetch_object($resultadoorden);
                           
      $prioriorden=$filordd->prioriOrden;
      $fechafinorden=$filordd->Fechafin;
      $newfechfin=date_create($fechafinorden);
      $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

      $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
      $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                           /*COMPARACION DE FECHAS */
          if ($fecha1>$fecha2) 
          {
            $vard='R';
            $varconcat=$vard.$prioriorden;

            $varcaraorden="<strike>$varconcat</strike>";

            $totaltiempoexpirar=0;
          }

              else
              {

                  $intervalo= $fecha1->diff($fecha2);

                  //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                  $diasentero=intval($intervalo->format('%d'));
                  $horaentero=intval($intervalo->format('%H'));
                  $minutos=intval($intervalo->format('%i'));


                  /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                  $totaldeminh=$horaentero*60;
                  $totalminDia=$diasentero*1440;

                  //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                  $resultadomin=$totaldeminh+$totalminDia+$minutos;
                               
                  ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                  $resultadohora=$resultadomin/60;

                  if ($resultadohora>=96) {
                  $varcaraorden='G'.$prioriorden;
                  }
                  if ($resultadohora>=24 and $resultadohora<96) {
                  $varcaraorden='C'.$prioriorden;
                  }
                  if ($resultadohora>=8 and $resultadohora<24) {
                  $varcaraorden='V'.$prioriorden;
                  }

                  if ($resultadohora>=3 and $resultadohora<8) {
                  $varcaraorden='A'.$prioriorden;
                  }
                  if ($resultadohora>=1 and $resultadohora<3) {
                  $varcaraorden='N'.$prioriorden;
                  }
                  if ($resultadohora<1) {
                  $varcaraorden='R'.$prioriorden;
                  }

                  $minutosparaexpirar=$resultadomin;
                                               
                  $horaconvert=0;
                  $minutoscovert=0;
                  $totaltiempoexpirar=0;
                                               
                  $horaconvert=$minutosparaexpirar/60;
                  $horaconvert11=intval($horaconvert);
                  $minutoscovert=$minutosparaexpirar%60;
                  $totaltiempoexpirar=$horaconvert11.':'.$minutoscovert;

              }/*FIN DEL ELSE*/
  return $varcaraorden;
}/*fin de la funcion que muestra la condicion de una orden*/



/****----------------------------------------------------------------------------------------------******************************/

   $idprocurador1=$_GET['codproc'];
    $arrayordensporpisos=array();
    $objetorden1=new OrdenGeneral();
    $listaordenpiso=$objetorden1->listarOrdenesProcuradorPorpisosDecreciente($idprocurador1);
    while ($filaordenpiso=mysqli_fetch_object($listaordenpiso)) 
    {

          if (in_array($filaordenpiso->idordenn,$arrayordensporpisos)) /*COMPRUEBA SI ESA ORDEN YA A MOSTRADO*/
          {
           
          }
          else
          {

          $pisojuzgado=$filaordenpiso->pisoNomb;
          $idordenpiso=$filaordenpiso->idordenn;

          array_push($arrayordensporpisos,$idordenpiso); /*METEMOS LA ORDEN EN UN ARRAY*/

           $objordenlistado=new OrdenGeneral();
           $resultadoinfo=$objordenlistado->mostrarInformaciondeCausaDeUnaOrden($idordenpiso);
           $filacausasorden=mysqli_fetch_object($resultadoinfo);

           $condicionorden=mostrarcondiciondeorden($idordenpiso);
           /*ENCRIPTACION DEL ID DE CAUSA*/
           $mascarac=$filacausasorden->idcausa*1213141516;
           $encriptado1=base64_encode($mascarac);
            /*ENCRIPTACION DEL ID DE ORDEN*/
            $mascara=$filacausasorden->idorden*1020304050;
            $encriptada=base64_encode($mascara);
            
            $colorcausa='';
               if ($filacausasorden->estadocausa=='Congelada') 
                {
                  $colorcausa='#b7b3b3';
                }
/*PARA EL ABOGADO*/       
      $mascara=$filacausasorden->idabogado*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$filacausasorden->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
                
           echo "<tr style='color: $colorcausa'>";
           echo " <td><a style='color: $colorcausa' href='ficha.php?squart=$encriptado1' target='_blank'>$filacausasorden->codigocausa</a><br><br>
            <a style='color: $colorcausa' href='orden.php?squart=$encriptada' target='_blank'>$condicionorden&nbsp;$pisojuzgado&nbsp;($idordenpiso)</a> 
           </td>";
           echo "<td>$filacausasorden->nombrecausa</td>";
            echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$filacausasorden->abogadogestor</a></td>";
             // echo "<td>$filacausasorden->procuradorasig</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$filacausasorden->clienteasig</a></td>";
           echo "<td>$filacausasorden->Categ</td>";
           echo "<td style='text-align: justify;'>$filacausasorden->Observ</td>";
           echo "</tr>";
           }

    
     
    }

?>