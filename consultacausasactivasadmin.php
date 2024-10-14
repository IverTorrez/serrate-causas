<?php
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');

$objcausa=new Causa();
   $resul=$objcausa->listarcausas();
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
       /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color:$colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>";

        /*LISTAR ORDENES DE LA CAUSA*/
               $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
                    echo "<br>";
                  }

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

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color:$colorcausa' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  $cont++;
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/ 


      echo "</td>";
     $nombreCausa=$fil->nombrecausa;
       $nombcliente=$fil->clienteasig;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $observ     =$fil->Observ;

      echo "<td><a style='color:$colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>"; 
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
     
      echo "</tr>";
    }/*FIN DE LISTADO DE CAUSAS*/
?>