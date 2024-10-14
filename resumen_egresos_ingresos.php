
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Ordenes</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

  
</head>
<body>
<?php
error_reporting(E_ERROR);
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');

include_once('model/clsdeposito.php');
include_once('model/clspresupuesto.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsconfirmacion.php');
include_once('model/clscostofinal.php');
include_once('model/clsdevoluciondinero.php');
include_once('model/clscotizacion.php');

 $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";

   $objcausacli=new Causa();
   $resulcli=$objcausacli->listarUnaCausaCualquiera($codigonuevo);
   $filcli=mysqli_fetch_object($resulcli);
   $nombrecli=$filcli->clienteasig;
?>
    <div id="header">
        
        <div class="container">
        
        <?php
        include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        
         <p id="codcausas"><?php echo $fil->codigo; ?> </p>
         <div id="main_menu_admin">
            <ul>
               
                 
                
               
                 <li  class="" style="float: left; margin: 0 14px; width: 1050px;"><a >CLIENTE:<?php echo $nombrecli; ?> </a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
           
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
  
 <!-- inicio del container table -->
<div class="container">

 
<br>
<br>
   <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">AVANCE FINANCIERO</h3>
<U>INGRESOS.-</u>
<br>
<br>

<!--tabla ingresos-->


<section class="responsive">
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
        while ($fila=mysqli_fetch_object($resul))
        {
            $totalingreso=$totalingreso+$fila->monto_deposito;
          echo "<tr>"; 
          echo "<td>$fila->fecha_deposito</td>";
          echo "<td style='text-align: left;'>$fila->detalle_deposito</td>";
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
      
    </div><br><br>
</section>
<br>
<br>
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DETALLE DE EGRESOS</h3>
<u>EGRESOS.-</u>
<br>
<br>
<!--TABLA EGRESOS-->
<section class="responsive">
 <table id="customers">
<thead>     
  <tr id="formato">
    <th  rowspan="2" width="8%"># DE ORDEN</th>
    <th rowspan="2" width="20%">CARGA DE INFORMACION</th>
    <th  rowspan="2" width="20%">DESCARGA DE INFORMACION</th>
    <th  rowspan="2" width="10%">FECHA DE FINALIZACION DE LA ORDEN</th>
    <th  colspan="2">PARAMETROS ELECTRONICO PARA COTIZAR ESTA ORDEN</th>
    <th  rowspan="2" width="8%">COSTO JUDICIAL (Bs.)</th>
    <th rowspan="2" width="10%">COSTO DE PROCURADURIA (Bs.)</th>
    <th rowspan="2" >COSTO TOTAL DE LA ORDEN (Bs.)</th>
  </tr>
<tr id="formato">
  <th>NIVEL DE PRIORIDAD</th>
  <th >PLAZO EN HORAS</th>
</tr>
</thead>

<tbody>
  

  <?php
  $totalcostojudicial=0;
  $totalcostprocuradoria=0;
  $totalegreasotodasorden=0;
  $objorden=new OrdenGeneral();
  $resultor=$objorden->listarordenesParaClientedeCausa($codigonuevo);
  while ($filor=mysqli_fetch_object($resultor)) 
  {
     if ($filor->estado_orden!='Serrada') 
    {
      $backgroundfila='#d0f3bc';
    }
    else
    {
     $backgroundfila='white'; 
    }

    echo "<tr style='background: $backgroundfila'>";
       echo "<td>$filor->idorden</td>";
       echo "<td style='text-align: justify;'>$filor->informacion</td>";

        $objdesc=new DescargaProcurador();
        $resultdes=$objdesc->muestraDescargaDeorden($filor->idorden);
        $fildes=mysqli_fetch_object($resultdes);

       echo "<td style='text-align: justify;'>$fildes->detalle_informacion</td>";

       echo "<td>$filor->Fin</td>";
       echo "<td>$filor->prioridadcot</td>";
       
       switch ($filor->condicioncot) {
          case 1:echo "<td>mas de 96</td>";break;
          case 2:echo "<td>24 a 96</td>";break;
          case 3:echo "<td>8 a 24</td>";break;
          case 4:echo "<td>3 a 8</td>";break;
          case 5:echo "<td>1 a 3</td>";break;  
          case 6:echo "<td>0 a 1</td>";break;
         
        
       }
       $egresototalorden=0;

      // ESTE CODIGO VERIFICA QUE EL ADMIN YA AYGA PUESTO EL VERDADERO COSTO PROCESAL A LA ORDEN
       $objcostof=new Costofinal();
       $resultcostf=$objcostof->mostrarcostosdeunaorden($filor->idorden);
       $filcof=mysqli_fetch_object($resultcostf);
       if ($filcof->validadofinal=='Si') 
       {
         $costoproceventa=$filcof->costo_procesal_venta;
        // $egresototalorden=$filcof->total_egreso;

        // $totalegreasotodasorden=$egresototalorden+$totalegreasotodasorden;
       }
       else
       {
         $costoproceventa='??';
       //  $egresototalorden='??';
       }
       //////////////////////////////////////////////////////////////////////////////////////////
    /*VERIFICA QUE LA ORDEN YA ESTE SERRADA PARA MOSTRAR EL REAL COSTO DE PROCURADORIA POR FALSO MOSTRARA EL COSTO DE COTIZACION CON UNA LEYENDA "MONTO POR CONFIRMAR"*/
       if ($filor->estado_orden=='Serrada') 
       {
         $costoventaprocuradoria=$filcof->costo_procuradoria_venta;
         //$egresototalorden=$costoventaprocuradoria+$egresototalorden;
         $switchprocu='Confirmado';
       }
       else
       {
         $objcotiz=new Cotizacion();
         $resulcotiz=$objcotiz->mostrarcotizaciondeorden($filor->idorden);
         $filcotiz=mysqli_fetch_object($resulcotiz);
         
         $costoventaprocuradoria=$filcotiz->venta.'  monto por confirmar';
         $switchprocu='Noconfirmado';

       }
       /*--------------------------------------------------------------------*/

       if ($costoproceventa=='??') 
       {
         $egresototalorden='??';
       }
       else
       {
         $egresototalorden=$egresototalorden+$costoproceventa;
       }



   /*IF QUE PREGUNTA SI YA SE SERRO LA ORDEN*/
       if ($switchprocu=='Confirmado') 
       {
         $egresototalorden=$egresototalorden+$filcof->costo_procuradoria_venta;
       }
     
       echo "<td>$costoproceventa</td>";
       echo "<td>$costoventaprocuradoria</td>";
       

       /*IF QUE PREGUNTA SI TODAVIA NO SE COLOCO EL COSTO JUDICIAL VENTA Y SI TODAVIA NO SE SERRO LA ORDEN*/
       if ($costoproceventa=='??' and $switchprocu=='Noconfirmado') 
       {
         echo "<td>??</td>";
       }

      /*IF QUE PREGUNTA SI TODAVIA NO SE COLOCO EL COSTO JUDICIAL VENTA Y SI LA ORDEN YA ESTA SERRADA*/
       if ($costoproceventa=='??' and $switchprocu=='Confirmado') 
       {
         $egresototalordenConmensaje=$egresototalorden.' hasta ahora';
         echo "<td>$egresototalordenConmensaje</td>";
         $totalegreasotodasorden=$totalegreasotodasorden+$egresototalorden;

         /*CALCULA EL SUBTOTAL DEL COSTO DE PROCURADORIA*/
         $totalcostprocuradoria=$totalcostprocuradoria+$filcof->costo_procuradoria_venta;
       }

      /*IF QUE PREGUNTA SI YA SE COLOCO EL COSTO JUDICIAL VENTA Y SI YA SE SERRO LA ORDEN*/
       if ($costoproceventa!='??' and $switchprocu=='Confirmado') 
       {
        $nuevoegresoorden=$filcof->costo_procuradoria_venta+$filcof->costo_procesal_venta;
         echo "<td>$nuevoegresoorden</td>";
         $totalegreasotodasorden=$totalegreasotodasorden+$filcof->costo_procuradoria_venta+$filcof->costo_procesal_venta;

         /*CALCULA EL TOTAL DE COSTO DE PROCURADORIA DE TODAS LAS ORDENES*/
         $totalcostprocuradoria=$totalcostprocuradoria+$filcof->costo_procuradoria_venta;
         /*CALCULA EL TOTAL COSTO JUDICIAL DE TODAS LAS ORDENES*/
         $totalcostojudicial=$totalcostojudicial+$filcof->costo_procesal_venta;
       }

      // echo "<td>$egresototalorden</td>";
    echo "</tr>";
    
  }
  ?>
 
</tbody>
  <td colspan="6"> TOTAL EGRESOS</td>
  <td > <?php echo $totalcostojudicial; ?></td>

  <td ><?php echo $totalcostprocuradoria; ?> </td>

  <td ><?php echo $totalegreasotodasorden; ?></td>
</table>
</section>
<br>
<br>


   <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">TRANSFERENCIAS ENTRE SUS CAUSAS</h3>

<!--SECCION PARA MOSTRAR LAS TRANSFERENCIAS-->
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


<br>
<br>



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



<br>
<br>
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">RESUMEN</h3>
<div class="container">
     <center><table id="tablaresumenfinal" >
       <thead>
        
         
       </thead>
       <tbody>
         <tr>
           <td>TOTAL EGRESO</td>
           <?php
           echo "<td id='monto1'>-$totalegreasotodasorden</td>";
           ?>
           
     
         </tr>

         <tr>
           <td>TOTAL INGRESOS</td>
           <?php
           echo "<td id='monto1'>$totalingreso</td>";
           ?>
         </tr>

         <tr>
           <td>TOTAL TRANFERENCIA RECIBIDA</td>
           <?php
           echo "<td id='monto1'>$totaltrans</td>";
           ?>
         </tr>

         <tr>
           <td>TOTAL TRANFERENCIA ENTREGADA</td>
           <?php
           echo "<td id='monto1'>-$totaltrasentre</td>";
           ?>
         </tr>

          <tr>
           <td>SALDO DEVUELTO AL CLIENTE</td>
           <?php
           
           echo "<td id='monto1'>-$totaldevuelto</td>";
           ?>
         </tr>



         
           <?php
           $saldototal=$totalingreso-$totalegreasotodasorden+$totaltrans-$totaltrasentre-$totaldevuelto;
            if ($saldototal<0) 
            {
             $colorfila='red';
            }
            else
            {
              $colorfila='white';
            }
          echo  "<tr id='monto2' style='background: $colorfila;'>";
            echo "<td>SALDO</td>";

            echo "<td >$saldototal</td>";
            echo "</tr>";

            //echo $saldototal;
           ?>
           
        
       </tbody>
     </table></center>
      
    </div>

<br>
<br>
    </div>
 <!-- fin del container table -->

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>