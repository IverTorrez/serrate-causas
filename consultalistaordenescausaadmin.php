<?php
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');

include_once('model/clsdeposito.php');
include_once('model/clspresupuesto.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsconfirmacion.php');
include_once('model/clscostofinal.php');
include_once('model/clsdevoluciondinero.php');

$codigonuevo=$_GET['codicausa'];
?>


 <div class="container">
     <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
    
    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">EGRESOS</h3>
    <h3 style="color: #000000;font-size: 20px;text-align: center;">(LISTADO DE ORDENES)</h3>
    <br>



<section class="responsive">
<table id="tablalistaordenadm">
 <thead> 
   
  
</thead>

<tr id="fila1">
    <th id="tdorden" rowspan="4"  width="100px"># DE ORDEN</th>
    <th id="tdorden" colspan="10">FECHAS</th>
    <th id="tdorden" colspan="5">COTIZACION</th>
    <th id="tdorden" colspan="5">FINANZAS</th>
    <th id="tdorden" rowspan="4"  width="250px">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>
    <th id="tdorden" rowspan="4"  width="130px">CALIFICACION <br><p style="font-size: 12px;">(SUFICIENTE/INSUFICIENTE)</p></th>
   
  </tr>
<tr id="fila2">
<td id="tdorden" colspan="4">FECHAS DE CARGA</td>
<td id="tdorden" rowspan="3" width="100px">FECHA DE DESCARGA</td>
<td id="tdorden" colspan="2">VIGENCIA DE LA ORDEN</td>
<td id="tdorden" colspan="3">MOMENTOS  PARA EL CIERRE  DE LA ORDEN </td>
<td id="tdorden" colspan="2">PARAMETROS USADOS PARA COTIZAR ESTA ORDEN </td>
<td id="tdorden" colspan="3">COTIZACIÓN DE PROCURADURIA</td>
<td id="tdorden" colspan="2">COSTO JUDICIAL Bs.-</td>
<td id="tdorden" colspan="2">COSTO DE PROCURADURÍA Bs.-</td>
<td id="tdorden" rowspan="3"  width="100px">TOTAL EGRESO <br> <p>(para el cliente) </td>
</tr>

<tr id="fila3">
  <td id="tdorden" colspan="2">INFORMACION  Y DOCUMENTACIÓN </td>
  <td id="tdorden" colspan="2">DINERO</td>
  <td id="tdorden" rowspan="2" width="100px">INICIO</td>
  <td id="tdorden" rowspan="2" width="100px">FIN</td>
  <td id="tdorden" colspan="2">FECHAS DE PRONUNCIAMIENTOS</td>
  <td id="tdorden" rowspan="2" width="100px">FECHA OFICIAL DE CIERRE</td>
  <td id="tdorden" rowspan="2" width="80px">NIVEL DE PRIORIDAD</td>
  <td id="tdorden" rowspan="2" width="50px">PLAZO EN HORAS</td>
  <td id="tdorden" rowspan="2" width="80px">COMPRA</td>
  <td id="tdorden" rowspan="2" width="80px">VENTA</td>
  <td id="tdorden" rowspan="2" width="80px">PENALIDAD</td>
  <td id="tdorden" rowspan="2" width="60px">COMPRA </td>
  <td id="tdorden" rowspan="2" width="60px">VENTA</td>
  <td id="tdorden" rowspan="2" width="100px">COMPRA <br> <p>(para el procurador)</p></td>
  <td id="tdorden" rowspan="2"  width="100px">VENTA <br> <p>(para el cliente)</p></td>
</tr>

<tr id="fila4">
  <td id="tdorden" width="100px">GIRO</td>
  <td id="tdorden" width="100px">PRESUPUESTO</td>
  <td id="tdorden" width="100px">CARGA MATERIAL DE INFORMACION Y DOCUMENTACION </td>
  <td id="tdorden" width="100px" >ENTREGA DE DINERO</td>
  <td id="tdorden" width="100px">DEL ABOGADO</td>
  <td id="tdorden" width="100px">DEL CONTADOR</td>
</tr>



<?php
       ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita;

  $totalcostojudicompra=0;
  $totlacostojudiventa=0;
  $totalparaprocurador=0;
  $totalventaprocurador=0;
  $totalegreso=0;
   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesdeunacausa($codigonuevo);
   while ($fil=mysqli_fetch_object($resul)) 
   {
     /*PARA EL COLOR A LAS FILAS DEPENDIENDO DE SU URGENCIA*/
      if ($fil->estado_orden=='Serrada')/*PREGUNTA SI ESTA SERRADA LA ORDEN*/ 
      {
       $backgroundfila='white';
       $fontcolor='#000000'; 
      }
      else/*POR FALSO*/
      {


          $fechafinorden=$fil->fin;
          $newfechfin=date_create($fechafinorden);
          $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

          $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
          $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
          if ($fecha1>$fecha2)/*PREGUNTA SI LA ORDEN ESTA VENCIDA*/ 
              {
                $vard='R';
                $varconcat=$vard.$prioriorden;

                $varcaraorden="<strike>$varconcat</strike>";

                $totaltiempoexpirar=0;
                $tiempo=0;
                $backgroundfila='#ffffff';
                $fontcolor='#b7b3b3';

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
                      $tiempo=$resultadohora;
                      $fontcolor='#000000';
                      if ($resultadohora>96) 
                      {
                        $backgroundfila='#D0E2D1'; 
                      }
                      if ($resultadohora>24 and $resultadohora<=96) 
                      {
                        $backgroundfila='#42A4D2'; 
                      }
                      if ($resultadohora>8 and $resultadohora<=24) 
                      {
                        $backgroundfila='#39B743'; 
                      }
                      if ($resultadohora>3 and $resultadohora<=8) 
                      {
                        $backgroundfila='#F5EB0F'; 
                      }
                      if ($resultadohora>1 and $resultadohora<=3) 
                      {
                        $backgroundfila='#F5860F'; 
                      }
                      if ($resultadohora>0 and $resultadohora<=1) 
                      {
                        $backgroundfila='red'; 
                      }

                      

          }
        }/*FIN DEL ELSE CUANDO UNA ORDEN NO ESTA SERRADA*/
     /*HASTA AQUI PONE LOS COLORES DE SU URGENCIAS*/


       echo "<tr style='background: $backgroundfila; color:$fontcolor;'>";
            //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->codigo*10987654321;
             $encriptado=base64_encode($mascara);
              /*VERIFICA SI LA ORDEN ESTA PREDATADA POR VERDADERO MUESTA LA FILA DE COD ORDEN NOMALMENTE*/
             if ($fil->Inicio<=$concat)
             {
                echo "<td class='tdcod'><a style='color:$fontcolor;' href='ordenadmin.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
             else/*POR FALSO MUESTA EL CODIGO CON UN * AL LADO*/
             {
               echo "<td class='tdcod'>*<a style='color:$fontcolor;' href='ordenadmin.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
              
              echo "<td> $fil->fecha_giro</td>";

          //
             ini_set('date.timezone','America/La_Paz');
            $fechoyal=date("Y-m-d");
            $horita=date("H:i");
            $concat=$fechoyal.' '.$horita; 

         ////CODIGO PARA COMPARACION DE HORAS//////////////////////////////////////////////////////////////////
            $fec=$fil->fin;
            $newfec=date_create($fec);
           $formatofechafin=date_format($newfec, 'Y-m-d H:i');

            $fecha1 =new DateTime($concat);//fecha y hora del sistema
            $fecha2 =new DateTime($formatofechafin); //FECHA Y HORA DE TERMINO DE VIGENCIA DE LA ORDEN
            $intervalo= $fecha1->diff($fecha2);

            //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
         $diasentero=intval($intervalo->format('%d'));
         $horaentero=intval($intervalo->format('%H'));
         $minutos=intval($intervalo->format('%i'));

/// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
         $totaldeminh=$horaentero*60;
         $totalminDia=$diasentero*1440;

        // /SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
    $resultadomin=$totaldeminh+$totalminDia+$minutos;
   
   ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
    $resultadohora=$resultadomin/60;
          
          if ($fecha1>$fecha2) {
            $msm='orden vencida';
          }
          else{
            $msm='hay vigencia';
          }

 /////////////////////////////////////////////////////////////////////////////////////////////////////  
         $objpresup=new Presupuesto();
              $listado=$objpresup->mostrarfechaspresupuestoyentrega($fil->codigo);
              $filapres=mysqli_fetch_object($listado);

             echo "<td>$filapres->fecha_presupuesto</td>";
                    

             // echo "<td>$fil->fecpresupuesto</td>";//aun no hay ni en la consulta, dato aleatoria
              echo "<td>$fil->fecha_recepcion</td>"; //hay en la consulta, pero esta vacia
              echo "<td>$filapres->fecha_entrega</td>"; 

              $objdesc=new DescargaProcurador();
              $resultado=$objdesc->mostrarfechadescarga($fil->codigo);
              $filafe=mysqli_fetch_object($resultado);

               echo "<td>$filafe->fecha_descarga</td>";

              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->fin</td>";

              $objconfir=new Confirmacion();
              $resp=$objconfir->mostrarfechasdeconfirmacion($fil->codigo);
              $filaco=mysqli_fetch_object($resp);


               echo "<td>$filaco->fecha_confir_abogado</td>";//aun no hay ni en la consulta, dato aleatoria
                echo "<td>$filaco->fecha_confir_contador</td>";//aun no hay ni en la consulta, dato aleatoria

                echo "<td>$fil->fecha_cierre</td>"; //hay en la consulta, pero esta vacia
             
              echo "<td>$fil->prioridad</td>";
              switch ($fil->condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;
                
              }

           

              echo "<td>$fil->Compra</td>";   
              echo "<td>$fil->Venta</td>"; 
              echo "<td>$fil->Penalidad</td>";

              $obdesc=new DescargaProcurador();
              $resss=$obdesc->mostrardescargaorden($fil->codigo);
              $filadd=mysqli_fetch_object($resss);

              $totalcostojudicompra=$filadd->comprajudicial+$totalcostojudicompra;

              echo "<td>$filadd->comprajudicial</td>";//ES LO QUE GASTO EL PROCURADOR(COSTO JUDICIAL COMPRA)

              $obcosf=new Costofinal();
              $ls=$obcosf->mostrarcostosdeunaorden($fil->codigo);
              $filc=mysqli_fetch_object($ls);

              $totlacostojudiventa=$filc->costo_procesal_venta+$totlacostojudiventa;

              echo "<td>$filc->costo_procesal_venta</td>";//ES LO QUE LE COBRAMOS POR EL COSTO JUDICIAL
              
              $obcc=new Costofinal();
              $ll=$obcc->mostrarcompraparaprocuradr($fil->codigo);
              $filcc=mysqli_fetch_object($ll);

              $totalparaprocurador=$filcc->Compraproc+$totalparaprocurador;

              echo "<td>$filcc->Compraproc</td>";//muestra el costo de procuradoria, sea positivo o negativo

              $totalventaprocurador=$filc->costo_procuradoria_venta+$totalventaprocurador;
              echo "<td>$filc->costo_procuradoria_venta</td>";//muestra lo que le cobramos al cliente por el procurador

              $totalegreso=$filc->total_egreso+$totalegreso;

              echo "<td>$filc->total_egreso</td>";//muestra todo lo que lecosto al cliente hacer esa orden 
              $procuradorasig=$fil->procuradorasig;
              echo "<td>$procuradorasig</td>";

               echo "<td>$fil->calificacion_todo</td>";

            
        echo "</tr>";
          }
  ?>

<!-- ESTA FILA ES LA SUMATORIA DE LOS COSTOS-->
<tr>
  <td colspan="16">TOTALES EGRESOS</td>
  <?php
  echo "<td>$totalcostojudicompra</td>";
  echo "<td>$totlacostojudiventa</td>"; 
  echo "<td>$totalparaprocurador</td>";
  echo "<td>$totalventaprocurador</td>"; 
   echo "<td>$totalegreso</td>";
   ?>
  <td></td>
  <td></td>
</tr>


<tbody>

 
</tbody>
</table>
</section>

</div><!--FIN DEL DIV CONTAINER QUE CONTIENE LISTA DE ORDENES-->

<br><br><br><br><br><br><br>


    <br><br>

    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">INGRESOS</h3>
    <div class="container">
     <table id="customers">
       <thead>
         <tr>
           <th width="15%">FECHA</th>
           <th>DETALLE</th>
           <th width="7%" >MONTO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php
         $objdeposito=new Deposito();
        $resul=$objdeposito->Listardepositodecausa($codigonuevo);
        $totalingreso=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalingreso=$totalingreso+$fila->monto_deposito;
            
            $detalleDep=$fila->detalle_deposito;
          echo "<tr>"; 
          echo "<td>$fila->fecha_deposito</td>";
          echo "<td style='text-align: left;'>$detalleDep</td>";
          echo "<td style='text-align: right;'>$fila->monto_deposito</td>";
          echo "</tr>";
   

        }

       $objtransfer=new Deposito();
       $totaltrans=0;
       $resultran=$objtransfer->ListarTransferenciarecibidadecausa($codigonuevo);
       while ($filatran=mysqli_fetch_object($resultran)) {
         $totaltrans=$totaltrans+$filatran->monto_deposito;
       }

       $objtransferentregada=new Deposito();
       $totaltrasentre=0;
       $resulentreg=$objtransferentregada->ListarTransferenciaentregadadecausa($codigonuevo);
       while ($filatranentr=mysqli_fetch_object($resulentreg)) {
         $totaltrasentre=$totaltrasentre+$filatranentr->monto_deposito;
       }


         ?>

         <tr>
           <td colspan="2">TOTAL INGRESOS</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalingreso</td>";
           ?>

         </tr>
       </tbody>
     </table>
      
    </div><br><br><br><br><br><br><br><br><br>




   <!--SECCION PARA MOSTRAR LAS TRANSFERENCIAS-->
   <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">TRANSFERENCIAS ENTRE LAS CAUSAS</h3>
    <div class="container">
      <table id="customers">
         <thead>
          <tr>
            <th>TRANSFERECIA DE: (INGRESO)</th>
            <th>TRANSFERECIA A: (EGRESO)</th>
            <th>MONTO</th>
          </tr>

         </thead>
         <?php

         /*ENLISTA LAS TRANSFERENCIAS QUE LE HACEN A LA CAUSA (ES DECIR LOS INGRESOS QUE SE LE HACE A LA CAUSA)*/
          $objcausa2=new Causa();
        $resulcausa1=$objcausa2->mostrarDetallesTransferenciasRecibidasDeCausa($codigonuevo);
       // $totalingreso=0;
        while ($filacausa=mysqli_fetch_object($resulcausa1)){
            $idorigeningreso=$filacausa->idorigendeposito;

            $obcausa22=new Causa();
            $resultca=$obcausa22->mostrarUnacausa($idorigeningreso);
            $filacausaorigen=mysqli_fetch_object($resultca);

          echo "<tr>"; 
          echo "<td>$filacausaorigen->codigo</td>";
          echo "<td style='text-align: left;'></td>";
          echo "<td style='text-align: right;'>$filacausa->monto_deposito</td>";
          echo "</tr>";
   

        }
        /*DESDE AQUI ENLISTAS LAS TRANSFERENCIAS QUE SE HACE A OTRA CAUSA ES DECIR (LOS EGRESOS DE LA CAUSA A OTRA CAUSA) */

        $obcausasalida=new Causa();
        $resultcausasalida=$obcausasalida->mostrarDetallesTransferenciasEntregadasDeCausa($codigonuevo);
        while ($filacausasalida=mysqli_fetch_object($resultcausasalida)){
            $iddestinoingreso=$filacausasalida->id_causa;

            $obcausa33=new Causa();
            $resultca=$obcausa33->mostrarUnacausa($iddestinoingreso);
            $filacausadestino=mysqli_fetch_object($resultca);

          echo "<tr>"; 
          echo "<td></td>";
          echo "<td style='text-align: left;'>$filacausadestino->codigo</td>";
          echo "<td style='text-align: right;'>$filacausasalida->monto_deposito</td>";
          echo "</tr>";
   

        }
        
         ?>

         <tbody>

          
        </tbody>
      </table>
    </div><br><br><br><br>





    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DEVOLUCIONES AL CLIENTE</h3>
    <div class="container">
     <table id="customers">
       <thead>
         <tr>
           <th width="15%">FECHA</th>
           
           <th width="7%" >MONTO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php
         $objdevolu=new DevolucionDinero();
        $resuldev=$objdevolu->listarLasDevolucionesdeCausa($codigonuevo);
        $totaldevuelto=0;
        while ($filadev=mysqli_fetch_object($resuldev)){
            $totaldevuelto=$totaldevuelto+$filadev->montodevolucion;
          echo "<tr>"; 
          echo "<td>$filadev->fechadevolucion</td>";
          //echo "<td style='text-align: left;'>$fila->detalle_deposito</td>";
          echo "<td style='text-align: right;'>$filadev->montodevolucion</td>";
          echo "</tr>";
   

        }

    


         ?>

         <tr>
           <td >TOTAL DEVOLUCIONES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totaldevuelto</td>";
           ?>

         </tr>
       </tbody>
     </table>
      
    </div><br><br>






        <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">RESUMEN FINAL</h3>
    <div class="container">
     <center><table id="tablaresumenfinal"  style="width: 50%;">
       <thead>
        
         
       </thead>
       <tbody>
         <tr>
           <td>TOTAL EGRESO (Costo + Procuraduría)</td>
           <?php
           echo "<td id='monto1'>-$totalegreso</td>";
           ?>
           
     
         </tr>

         <tr>
           <td>TOTAL INGRESOS (Depósitos)</td>
           <?php
           echo "<td id='monto1'>$totalingreso</td>";
           ?>
         </tr>

         <tr>
           <td>TOTAL TRANFERENCIA RECIBIDA DE OTRAS CAUSAS</td>
           <?php
           echo "<td id='monto1'>$totaltrans</td>";
           ?>
         </tr>

         <tr>
           <td>TOTAL TRANFERENCIA ENTREGADA A OTRAS CAUSAS</td>
           <?php
           echo "<td id='monto1'>-$totaltrasentre</td>";
           ?>
         </tr>

          <tr>
           <td>TOTAL DEVOLUCIONES AL CLIENTE</td>
           <?php
           
           echo "<td id='monto1'>-$totaldevuelto</td>";
           ?>
         </tr>

         <tr id="monto2">
           <td>SALDO</td>
           <?php
           $saldototal=$totalingreso-$totalegreso+$totaltrans-$totaltrasentre-$totaldevuelto;
            echo "<td >$saldototal</td>";
           ?>
           
         </tr>
       </tbody>
     </table></center>
      
    </div>