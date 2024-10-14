<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["contador"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["contador"];
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Caja Contador</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

  <script src="../js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="../css/sweet-alert.css">
     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>

</head>
<body>
<?php

include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clscostofinal.php');

include_once('../model/clscajasdesalida.php');
include_once('../model/clstransferencia_contador.php');
include_once('../controller/control-caja.php');

 $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;
?>
    <div id="header">
        
        <div class="container">
        
        <?php
        include_once('../model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="../resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='../fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        
        <div id="main_menu">
        
            <ul>
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

     <div id="main_content">
            
        <div id="portfolio_area">
        <div class="container">    
          
            </div>

        </div>

    </div>
    
 

   <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333; display: none;">DINERO  EN CAJA DEL CONTADOR</h3>
    <div class="container" style="display: none;">
     <table id="customers">
       <thead>
         <tr>
           <th width="90%">CAJA DE CONTADOR</th>
           
           <th width="10%" >SALDO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php

         $objpre=new Presupuesto();
         $totalentregado=0;
         $lis=$objpre->mostrarpresupuestosentregados();
         while ($filap=mysqli_fetch_object($lis)) {
              $totalentregado=$filap->monto_presupuesto+$totalentregado;
          
         }

         $obccc=new Costofinal();
         $resultadog=$obccc->mostrardinerogastadosinvalida();
         $totalmontosinconfir=0;
         while ($filpaa=mysqli_fetch_object($resultadog)) {
              $totalmontosinconfir=$filpaa->Gastado+$totalmontosinconfir;
         }
         
         $obpe=new Presupuesto();
         $resultado=$obpe->mostrarpresupuestogastado();
         $totalpresugastado=0;
         while ($filp=mysqli_fetch_object($resultado)) {
              $totalpresugastado=$filp->monto_presupuesto+$totalpresugastado;
         }



         $objcaja=new Cajasdesalida();
        $result=$objcaja->mostrarcajadelcontador();
        
        $filac=mysqli_fetch_object($result);
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filac->cajacontador</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO ENTREGADO POR EL CONTADOR</td>";
          echo "<td style='text-align: right;'>$totalentregado</td>";
         
          echo "</tr>";

           /////PARA EL TOTAL DE MONTO GASTADO SIN CONFIRMAR POR EL CONTADOR
         /* echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO SIN CONFIRMAR POR EL  CONTADOR</td>";
          echo "<td style='text-align: right;'>$totalpresugastado</td>";
         
          echo "</tr>";*/

          /////PARA EL TOTAL DE MONTO GASTADO CONFIRMADO POR EL CONTADOR
         /* echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO SIN CONFIRMAR POR EL  ADMINISTRADOR</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir</td>";
         
          echo "</tr>";*/


        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado;


         ?>

    <!--     <tr>
           <td >SUMA TOTAL</td>
          
           <?php
          // echo "<td style='text-align: right;'>$tododelcontador</td>";
           ?>

         </tr>-->
       </tbody>
     </table>
      
    </div>
    <br>
    
    
    
    
    
    
    
    
    
    
    
    <div class="container" style="">
     <table id="customers">
       <thead>
         <tr>
           <th style="background: #AEAEAE;" width="90%">CAJA DE CONTADOR</th>
           
           <th style="background: #AEAEAE;" width="10%" >SALDO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php
        /*MUESTRA TODO EL PRESUPUESTO ENTREGADO POR EL CONTAOR*/
         $objpre=new Presupuesto();
         $totalentregado=0;
         $lis=$objpre->mostrarpresupuestosentregados();
         while ($filap=mysqli_fetch_object($lis)) {
              $totalentregado=$filap->monto_presupuesto+$totalentregado;
          
         }

      /*   $obp=new DescargaProcurador();
         $resulta=$obp->listarlosgastossinvalidar();
         $totalmontogastado=0;
         while ($filag=mysqli_fetch_object($resulta)) {
              $totalmontogastado=$filag->comprajudicial+$totalmontogastado;
         }*/

       /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), NO ES LO MISMO QUE LO GASTO EL PROCURADOR*/
         $obpe=new Presupuesto();
         $resultado=$obpe->mostrarpresupuestogastado();
         $totalpresugastado=0;
         while ($filp=mysqli_fetch_object($resultado)) {
              $totalpresugastado=$filp->monto_presupuesto+$totalpresugastado;
         }
////////MUESTRA EL DINERO GASTADO CONFIRMADO POR EL CONTADOR Y POR EL ABOGADO (ORDENES SERRADAS (FALTA QUE EL ADM ASISGNE EL ULTIMO VALOR))
         $obccc=new Costofinal();
         $resultadog=$obccc->mostrardinerogastadosinvalida();
         $totalmontosinconfir=0;
         while ($filpaa=mysqli_fetch_object($resultadog)) {
              $totalmontosinconfir=$filpaa->Gastado+$totalmontosinconfir;
         }

         /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), y el gasto de descarga (es cuando solo el conador se pronuncio)*/
         $objor=new OrdenGeneral();
         $resultadoorden=$objor->muestraPresupuestogastadoGastodescarga();
         $totalpresugastadoconfir=0;
         $totalgastodescargaconfircont=0;
         while ($filor=mysqli_fetch_object($resultadoorden)) {
              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalpresugastadoconfir=$filor->presupuestadogastado+$totalpresugastadoconfir;

              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalgastodescargaconfircont=$filor->gastadodescarga+$totalgastodescargaconfircont;
         }



        /*MUESTRA EL DINERO EN EFECTIVO QUE TIENE EL CONTADOR EN CAJA*/
         $objcaja=new Cajasdesalida();
        $result=$objcaja->mostrarcajadelcontador();
        
        $filac=mysqli_fetch_object($result);
            
          echo "<tr style='background:#ECECEC  ;'>"; 
          echo "<td style='text-align: left;'>A* DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filac->cajacontador</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr style='background:#ECECEC  ;'>"; 
          echo "<td style='text-align: left;'>B* DT EN MANOS DE LOS PROCURADORES (Entregado a los procuradores pero aún no gastado)</td>";
          echo "<td style='text-align: right;'>$totalentregado</td>";
         
          echo "</tr>";


/*------------------------NUEVO CODIGOS PARA LA TABLA-------------------------------------------------------*/
            $objordengasto=new OrdenGeneral();
            $resulgasto=$objordengasto->dineroGastadoSinConciliarporContador();
             $filgasto=mysqli_fetch_object($resulgasto);
             $gastosinconciliar=0;
             $gastosinconciliar=$gastosinconciliar+($filgasto->gastado);
          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr style='background:#ECECEC  ;'>"; 
          echo "<td style='text-align: left;'>C* DT GASTADO (Gastado por los procuradores pero sin conciliar con el contador)</td>";
          echo "<td style='text-align: right;'>$gastosinconciliar</td>";
         
          echo "</tr>";


          
          $objsaldos=new OrdenGeneral();
          $resulsaldo=$objsaldos->SaldosPorDevolverAContador();
          $filsaldo=mysqli_fetch_object($resulsaldo);
          $saldosdev=0;
          $saldosdev=$saldosdev+($filsaldo->saldos);
           echo "<tr style='background:#ECECEC  ;'>"; 
          echo "<td style='text-align: left;'>D* DT SALDO DE VENIDA (saldo por volver a caja, sin conciliar con el contador)</td>";
          echo "<td style='text-align: right;'>$saldosdev</td>";
         
          echo "</tr>";
         

        /*ES EL VOLUMEN TOTAL MANEJADO POR EL CONTADOR*/
          $volumtotal=$filac->cajacontador+$totalentregado+($gastosinconciliar)+($saldosdev);
          echo "<tr style='background:#ECECEC  ;'>"; 
          echo "<td style='text-align: left;'>E* TOTAL DINERO MANEJADO POR EL CONTADOR</td>";
          echo "<td style='text-align: right;'>$volumtotal</td>";
         
          echo "</tr>";



/*---------------------------FIN DEL NUEVO CODIGO----------------------------------------------------------*/

          /////PARA EL TOTAL MONTO GASTADO SIN CONFIRMAR POR EL CONTADOR
          echo "<tr style='display:none;'>"; 
          echo "<td style='text-align: left;'>DINERO DESCARGADO ELECTRONICAMENTE</td>";
          echo "<td style='text-align: right;'>$totalpresugastado</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO  CONFIRMADO SOLO POR EL CONTADOR(sin serrar, muestra el presupuesto)
          echo "<tr style='display:none;'>"; 
          echo "<td style='text-align: left;'>DINERO DESCARGADO MATERIALMENTE</td>";
          echo "<td style='text-align: right;'>$totalpresugastadoconfir</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO confirmado POR EL CONTADOR es lo que gasto en la descarga
       /* CODIGO QUE LUEGO VEO PARA QUE SE UTILIZO
         echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO CONFIRMADO SOLO POR EL CONTADOR (DESCARGA)</td>";
          echo "<td style='text-align: right;'>$totalgastodescargaconfircont</td>";
         
          echo "</tr>";*/


          /////PARA EL TOTAL MONTO GASTADO CONFIRMADO POR EL CONTADOR
          echo "<tr style='background:#ECECEC  ; display: none;'>"; 
          echo "<td style='text-align: left;'>F* TOTAL DINERO SIN CONFIRMAR POR EL ADMINISTRADOR</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir</td>";
         
          echo "</tr>";


        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado+($totalpresugastadoconfir);


         ?>

         <tr style='display:none;'>
           <td >SUMA TOTAL</td>
          
           <?php
           echo "<td style='text-align: right;'>$tododelcontador</td>";

           /*NUEVO CODIGO PARA EL TOTAL DEL CONTADOR*/
           /*ESTA FUNCION DEVUELVE EL SALDO DE LAS DESCARGAS QUE NO TIENEN COSTO FINAL, Y POR LO TANTO PUEDEN AFECTAR A LA CAJA DEL CONTADOR , OSEA SI EL RESULTADO DE LA CONSULTA ES POSITIVO SE VUELVE NEGATIVO Y VICEVERSA, ESTO PARA NO AFECTAR A LA CAJA DEL CONTADOR*/
           $saldocuadrar=0;
           $objorden=new OrdenGeneral();
           $resultado1=$objorden->mostrarsaldosOrdenesNoserradas();
           $fila1=mysqli_fetch_object($resultado1);
          /*CONVERCION DEL SALDO */
          $saldocuadrar=$fila1->saldito*(-1);
           


           $nuevototalcontador=$tododelcontador+($saldocuadrar);
           ?>

         </tr>
       </tbody>
     </table>
      
    </div>
    <!--hasta aqui  PARA QUE CUADRE LA CAJA DEL ADMINISTRADOR, PERO NO SE MOSTRATA-->
    
    
    
    
    
    




<br><br><br><br>
<!---------------------------------TABLA RELACION ADMIN-CONTADOR------------------------------>



   <div class="container">
    <table id="customers">
      <head>
        <tr> 
          <th colspan="3">RELACION ADMINISTRADOR-CONTADOR</th>
        </tr>

        <tr>
        <th>FECHA</th>
        <th>ENTREGAS AL CONTADOR (egresos)</th>
        <th>DEVOLUCIONES DEL CONTADOR (ingresos)</th>
        </tr>

      </head>

      <?php
      $totalrelacioncont=0;


      $depositocont=0;
      $subtotaldepositocont=0;

      $devolucioncont=0;
      $subtotaldevolucioncont=0;
      $objtrans=new TransferenciaContador();
      $resultran=$objtrans->listarTransferenciasCOntador();
      while ($filtran=mysqli_fetch_object($resultran)) 
      {
            if ($filtran->tipo_trans=='Deposito') 
            {
              $depositocont=$filtran->monto_trans;
              $subtotaldepositocont=$subtotaldepositocont+$depositocont;
              $devolucioncont='';
            }
            if ($filtran->tipo_trans=='Devolucion') 
            {
              $depositocont='';
              $devolucioncont=$filtran->monto_trans;
              $subtotaldevolucioncont=$subtotaldevolucioncont+$devolucioncont;
            }

        echo "<tr>";
        echo "<td>$filtran->fecha_trans</td>";
        echo "<td style='text-align: right;'>$depositocont</td>";
        echo "<td style='text-align: right;'>$devolucioncont</td>";


        echo "</tr>";
      }
      ?>

     <tr>
       <td>SUBTOTALES</td>
       <td style='text-align: right;'><?php echo $subtotaldepositocont; ?></td>
       <td style='text-align: right;'><?php echo $subtotaldevolucioncont; ?></td>
     </tr>
     
     <?php
     $totalrelacioncont=$subtotaldevolucioncont-$subtotaldepositocont;
     ?>
     <tr>
       <td colspan="2">TOTAL</td>
       <td style='text-align: right;'><?php echo $totalrelacioncont; ?></td>
     </tr>

      <tbody>
        
      </tbody>
    </table>
   </div> 
  <!--*********************FIN DE LA TABLA RELACION ADMIN-CONTADOR***************************-->

    
    
    
  


<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
