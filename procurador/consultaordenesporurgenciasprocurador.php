<?php


include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');

$idprocurador=$_GET['codproc'];
    ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat2=$fechoyal.' '.$horita;

    ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat=$fechoyal.' '.$horita;

    $nuevoarrayordenes1=array();
    $arrayordenvenciadasnuevas=array();
    $arrayordenesParahaceractivas=array();
    $contadoraarayorden=0;
    $valormenor=100;

    $ordenurgente=0;

    $varcaraorden="";
    $sumatotalurgencia=0;
    $urgenciatiempo=0;
    $urgenciamayor=0;
    $posicionurgente=0;

    $objordeness=new OrdenGeneral();
    $resull=$objordeness->listarordenesSinSerrardeProcurador($idprocurador);

      while($filordenes=mysqli_fetch_object($resull))
      {
          array_push($nuevoarrayordenes1, $filordenes->codorden);
      }
      //$contadoraarayorden=count($nuevoarrayordenes);
        $CONTADOR1=0;
        $CONTADORARRAYY=count($nuevoarrayordenes1);
        while ($CONTADOR1<$CONTADORARRAYY) /*while 2*/
          { $nuevoarrayordenes=array();
            $nuevoarrayordenes=$nuevoarrayordenes1;
             
                  $contador=0;
                  $urgenciamayor=500;/*recien agregado, ES EL PARAMETRO PARA COMPARAR LA URGENCIA DE UNA ORDEN*/
                  while ($contador<count($nuevoarrayordenes)) /*while 3*/
                  { $idOrden=0;
                    $idOrden=$nuevoarrayordenes[$contador];
                    /**/
                    $obbjorden=new OrdenGeneral();
                    $listoo=$obbjorden->mostrarFechafinyPrioridadOrden($idOrden);
                    $filaordenes=mysqli_fetch_object($listoo);

                    $prioridadorden1=$filaordenes->PrioridadOrden;
                    $fechafinordenes=$filaordenes->Fechafin;
                    $newfechfinal=date_create($fechafinordenes);
                    $fechafinalformato=date_format($newfechfinal, 'Y-m-d H:i');

                    $fechas1 =new DateTime($concat2);/*fechas de la zona horaria*/
                    $fechas2 =new DateTime($fechafinalformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                    if ($fechas2>$fechas1) 
                      {   

                          $intervalo1= $fechas1->diff($fechas2);

                        //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                        $diasentero1=intval($intervalo1->format('%d'));
                        $horaentero1=intval($intervalo1->format('%H'));
                        $minutos1=intval($intervalo1->format('%i'));


                        /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                        $totaldeminh1=$horaentero1*60;
                        $totalminDia1=$diasentero1*1440;

                        //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                        $resultadomin1=$totaldeminh1+$totalminDia1+$minutos1;
                       
                         ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                        $resultadohora1=$resultadomin1/60;

                        if ($resultadohora1>=96) {
                          $varcaraorden='G'.$prioridadorden1;
                                   $urgenciatiempo=16;
                        }
                        if ($resultadohora1>=24 and $resultadohora1<96) {
                          $varcaraorden='C'.$prioridadorden1;
                                   $urgenciatiempo=13;
                        }
                        if ($resultadohora1>=8 and $resultadohora1<24) {
                          $varcaraorden='V'.$prioridadorden1;
                                   $urgenciatiempo=10;
                        }

                        if ($resultadohora1>=3 and $resultadohora1<8) {
                          $varcaraorden='A'.$prioridadorden1;
                                   $urgenciatiempo=7;
                        }
                        if ($resultadohora1>=1 and $resultadohora1<3) {
                          $varcaraorden='N'.$prioridadorden1;
                                   $urgenciatiempo=4;
                        }
                        if ($resultadohora1<1) {
                           $varcaraorden='R'.$prioridadorden1;
                                   $urgenciatiempo=1;
                        }

                        $sumatotalurgencia=$urgenciatiempo+$prioridadorden1;
                        
                        $auxurgencia=$sumatotalurgencia;
                        $auxorden=$idOrden;
                        $auxposision=$contador;

                              

                         
                      }/*FIN DEL IF   QUE PREGUNTA SI LA FECHA FINAL DE LA ORDEN ES MAYOR A LA DE ZONA HORARIA*/
                      else  /*SI, LA ORDEN ESTA VENCIDA*/
                      {
                         $varcondicion='R';
                         $varconcat1=$varcondicion.$prioridadorden1;

                         $varcaraorden1="<strike>$varconcat1</strike>";
                         /*GUARDA EN EL ARRAY*/

                          $ordenurgente=$idOrden;
                          $posicionurgente=$contador;
                          //$contador=count($nuevoarrayordenes);
                         // array_push($arrayordenvenciadasnuevas, $idOrdenvencida);

                          $auxurgencia=19+$prioridadorden1;
                          $auxorden=$ordenurgente;
                          $auxposision=$contador;
                          

                      }/*FIN DEL ELSE*/

                      if ($auxurgencia<$urgenciamayor) 
                              {  
                                $urgenciamayor=$auxurgencia;
                                $oficialorden=$auxorden;
                                $oficiposicionurgente=$auxposision;      
                              }
                 


                      $contador++;
                    
                  }/*FIN DEL WHILE 3 QUE RRECORRE EL ARRAY DE ORDENES*/
              
              array_push($arrayordenesParahaceractivas, $oficialorden);

              unset($nuevoarrayordenes1[$oficiposicionurgente]);/*ELIMINA UNA POSICION DEL VECTOR*/

              $nuevoarrayordenes1 = array_values($nuevoarrayordenes1);/*le da un nuevo formato*/
              $CONTADOR1++;                     
             
          }/*FIN DEL WHILE 2*/
          
          
          /*  $contadororden=count($arrayordenesParahaceractivas);
            $contadorsito=0;
            while ($contadorsito<$contadororden) 
            {
              echo $arrayordenesParahaceractivas[$contadorsito]; echo "<br>";
              $contadorsito++;
            }*/

/*EMPIEZA A LISTAR LAS CAUSAS CON SU RESPECTIVA ORDEN ,UNA FILA POR ORDEN,  (LISTADO DE ORDENES CONFORME A LAS URGENCIAS///////) */
            $arrayparaenlistarcausa=array();
            $arrayparaenlistarcausa=$arrayordenesParahaceractivas;
            $cantidadordenes=count($arrayparaenlistarcausa);
            $contadorOrdenes=0;
          while ($contadorOrdenes<$cantidadordenes) /*while que muestra la causa con una orden*/
          {
            $idordenarray=$arrayparaenlistarcausa[$contadorOrdenes];

            $objetoorden=new OrdenGeneral();
            $listarcausaordenes=$objetoorden->mostrarInformaciondeCausaDeUnaOrden($idordenarray);
            $filacausas=mysqli_fetch_object($listarcausaordenes);
            /*ENCRIPTACION DEL ID DE CAUSA*/
               $mascarac=$filacausas->idcausa*1213141516;
               $encriptado1=base64_encode($mascarac);
               
               $colorcausa='';
               if ($filacausas->estadocausa=='Congelada') 
                {
                  $colorcausa='#b7b3b3';
                }
                
            echo "<tr style='color: $colorcausa'>";
            echo "<td><a style='color: $colorcausa' href='ficha.php?squart=$encriptado1' target='_blank'>$filacausas->codigocausa</a> <br> <br>" ;

              /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($idordenarray);
                   $filordd=mysqli_fetch_object($resultadoorden);
                   
                   $prioriorden=$filordd->prioriOrden;
                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";

                        $totaltiempoexpirar='';
                   }

                   else{

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
                  
                 



                 
                   $mascara=$idordenarray*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' href='orden.php?squart=$encriptada' target='_blank'>$varcaraorden&nbsp;$totaltiempoexpirar&nbsp;($idordenarray)</td></a>";

/*PARA EL ABOGADO*/       
      $mascara=$filacausas->idabogado*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$filacausas->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
            echo "<td>$filacausas->nombrecausa</td>";
            echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$filacausas->abogadogestor</a></td>";
             // echo "<td>$filacausas->procuradorasig</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$filacausas->clienteasig</a></td>";
            echo "<td>$filacausas->Categ</td>";
            echo "<td style='text-align: justify;'>$filacausas->Observ</td>";
            echo "</tr>";
            $contadorOrdenes++;
          }/*FIN DEL WHILE QUE MUESRA UNA CAUSA CON UNA ORDEN*/


?>