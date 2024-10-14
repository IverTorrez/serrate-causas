<?php
error_reporting(E_ERROR);
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
$objcausa=new Causa();
   $resul=$objcausa->listarcausas();
   while ($fil=mysqli_fetch_object($resul)) { 
       echo "<tr>";
                   //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='fichacausaob.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

              /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

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
                               $varcaraorden='Gris'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='Celeste'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='Verde'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='Amarillo'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='Naranja'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='Rojo'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a target='_blank' href='ordenob.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
              
              echo "</td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
             
              echo "<td>$fil->Observ</td>";
        echo "</tr>";
          }/*FIN DEL LISTADO DE TODAS LAS CAUSAS ACTIVAS*/
?>
