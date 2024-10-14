<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["useradmin"]))
{
  header("location:index.php");
}
$datos=$_SESSION["useradmin"];
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Relacion Contador-Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
    
     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
</head>
<body>
<?php
include_once('model/clscausa.php');
include_once('model/clspiso.php');
include_once('model/clspresupuesto.php');
include_once('model/clsordengeneral.php');
include_once('model/clscostofinal.php');
include_once('model/clsdeposito.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsprestamos.php');/*nuevo*/
include_once('model/clsretiros.php');/*nuevo*/
include_once('model/clsprocurador.php');
include_once('model/clspagoprocurador.php');
include_once('model/clscajasdesalida.php');
include_once('model/clstransferencia_contador.php');
//include_once('controller/control-piso.php');
//include_once('controller/control-caja.php');/*PRESTAMO EXTERNO Y DEVOLUCIONES*/
//include_once('controller/control-devolvercajadelcontador.php');


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
       
       <div id="main_menu_admin">
            <ul>
               
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
              
                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
      
            <div id="portfolio_menu">
                
                <ul>
                  <li><button style="" class="botones" id="myBtnformcont">ENTREGAR CAJA AL CONTADOR</button></li>
                  <li><button style="" class="botones" id="myBtnformcontdevolver">DEVOLVER CAJA DEL CONTADOR</button></li>
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->



<br>
<br>













<!------------------------------TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE (OCULTAMOS ESTA TABLA A)--------------------->

<div class="container" style="display: none;">
  <h3  style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DEPOSITOS Y DEVOLUCIONES TOTALES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES</h3>
  <div style="overflow: scroll; height: 300px;">

<table id="customers">
  <thead>
    <tr>
      <th colspan="5">DEPOSITOS Y DEVOLUCIONES TOTALES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES</th>
    </tr>

    <tr>
      <th>CODIGO DE LA CAUSA</th>
      <th>CLIENTE</th>
      <th>DEPOSITOS (ingresos)</th>
      <th>DEVOLUCION (egresos)</th>
      <th>SALDO</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $totaldepositosd=0;
    $totaldevolucion=0;
    $saldocausa_depo_devo=0;/*ES EL SALDO DE CAUSA(TOTAL DEPOSITOS MENOS TOTAL DEVOLUCIONES) DE UNA CAUSA*/
    $totaldepositosMenosDevolucion=0;/*DEPOSITOS MENOS DEVOLUCIONES DE TODAS LAS CAUSAS*/
    $totalsaldos=0;
    $objcausa=new Causa();
    $resultcausa=$objcausa->mostrarcodigocausaysaldoYcliente();
    while ($filcausa=mysqli_fetch_object($resultcausa)) 
    {
      echo "<tr>";
        echo "<td>$filcausa->codigo</td>";
        echo "<td style='text-align: left;'>$filcausa->nombcli</td>";
        
        //$objcausa1=new Causa();
        $resuldepos=$objcausa->totalDeDepositosDeCausa($filcausa->idcausa);
        $fildepos=mysqli_fetch_object($resuldepos);

        $resuldev=$objcausa->totalDevueltoAlCliente($filcausa->idcausa);
        $fildev=mysqli_fetch_object($resuldev);

        echo "<td style='text-align: right;'>$fildepos->totaldeposito</td>";
        $totaldepositosd=$totaldepositosd+$fildepos->totaldeposito;

        echo "<td style='text-align: right;'>$fildev->totaldevuelto</td>";
        $totaldevolucion=$totaldevolucion+$fildev->totaldevuelto;
        
        $saldocausa_depo_devo=$fildepos->totaldeposito-$fildev->totaldevuelto;
        echo "<td style='text-align: right;'>$saldocausa_depo_devo</td>";
        $totalsaldos=$totalsaldos+$filcausa->caja;
      echo "</tr>";
    }

    ?>
    <tr>
      <td colspan="2">TOTALES</td>
      <td style='text-align: right;'><?php echo $totaldepositosd; ?></td>
      <td style='text-align: right;'><?php echo $totaldevolucion; ?></td>
      <?php
      $totaldepositosMenosDevolucion=$totaldepositosd-$totaldevolucion
      ?>
      <td style='text-align: right; font-size: 25px; font-weight: bold;'><?php echo $totaldepositosMenosDevolucion; ?></td>
    </tr>
    
  </tbody>
 </table>
  </div>
</div>

<!--FIN DE TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE-->














   <div class="container">
   <h3 style="color: #000000;font-size: 23px; text-shadow: -2px -2px 5px #333">B - RELACIÓN ADMINISTRADOR/CONTADOR</h3>
   </div><br>


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
          echo "<tr style='background:#ECECEC  ;'>"; 
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














<!--PAGOS HECHOS A PROCURADORES     (OCULTAMOS ESTA TABLA)-->
<div class="container" style="display: none;">
  <h2 style="color: #000000;font-size: 30px; text-shadow: -2px -2px 5px #333; text-align: left;">PAGO A PROCURADORES</h2>
  
   <section>
 <table id="customers"  >

 <thead>     
  <tr>
    <th>FECHA</th> 
    <th>NOMBRE DEL PROCURADOR</th>
    <th>MONTO</th>
  </tr>
</thead>
<tbody>
  <?php
    $totalpagado=0;
   $objpago=new PagoProcurador();
   $resulpago=$objpago->mostrarTodosLosPagos();
   while ($filpago=mysqli_fetch_object($resulpago)) {
             $totalpagado=$totalpagado+$filpago->pagoproc;
       echo "<tr>";
              echo "<td>$filpago->fechapago</td>";        
              echo "<td style='text-align: left;'>$filpago->procu</td>";
              echo "<td style='text-align: right;'>$filpago->pagoproc</td>";
        echo "</tr>";
          }
  ?>
  <tr>
     <td colspan="2">TOTAL PAGADO</td>
    <?php
      echo "<td style='text-align: right; font-size: 25px;'><b> $totalpagado</b></td>";
    ?>
  </tr>
</tbody>
</table>
</section>
</div>
















<!--*************TABLA PRESTAMOS DE TERCEROS  (OCULTAMOS ESTA TABLA)*******************************-->
       
<div class="container" style="display: none;">
  <h3 style="color: #000000;font-size: 30px;text-align: left; text-shadow: -2px -2px 5px #333">D).-PRESTAMOS DE TERCEROS</h3>
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>
   <!-- <th width="7%">CODIGO</th>
    <th width="10%">MONTO ANTES DEL RETIRO</th>-->

    <th width="10%">FECHA DE PRESTAMO</th>
    <th width="70%">DETALLE DEL PRESTAMO</th>
    <th width="10%">INGRESO</th>
    <th width="10%">EGRESO</th>
   <!-- <th width="10%">MONTO DESPUES DEL RETIRO</th>-->
      
  </tr>
</thead>
<tbody>
  <?php
   $subtotalpres=0;
   $subtotaldev=0;
   $totaldeuda=0;
   $objprest=new Prestamos();
   $resulprest=$objprest->listar_prestamos();
   while ($filpres=mysqli_fetch_object($resulprest)) 
        {
          if ($filpres->tipo_prestamo=='Prestamo') 
          {
            $subtotalpres=$subtotalpres+$filpres->monto_prestamo;//subtotal de prestamos
            $prestamo=$filpres->monto_prestamo;
            $devol='';
          }
          if ($filpres->tipo_prestamo=='Devolucion') 
          {
            $subtotaldev=$subtotaldev+$filpres->monto_prestamo;
            $prestamo='';
            $devol=$filpres->monto_prestamo;
          }

          
       echo "<tr>";
            //  echo " <td>RET-$filret->id_retiro</td>";
              echo " <td>$filpres->fecha_prestamo</td>";
              echo " <td style='text-align: justify;'>$filpres->detalle_prestamo</td>";
             // echo " <td>$filret->montototalcaja</td>";
              //PRESTAMO
              echo " <td style='text-align: right;'>$prestamo</td>"; 
              //DEVOLUCUION
               echo " <td style='text-align: right;'>$devol</td>"; 
             // echo " <td>$filret->monto_sobrante</td>";
              
              

        echo "</tr>";
          }
  ?>

  <tr>
    <td colspan="2">SUBTOTALES</td>
          
    <?php
      echo "<td style='text-align: right;'><b>$subtotalpres</b></td>";
      echo "<td style='text-align: right;'><b>$subtotaldev</b></td>";
    ?>

    </tr>


     <tr>
    <td colspan="3">TOTAL DEUDA</td>
          
    <?php
       $totaldeuda=$subtotalpres-$subtotaldev;
      echo "<td style='text-align: right;font-size: 25px;font-weight: bold;'>$totaldeuda</td>";
      
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

<!--**********************FIN DE LA TABLA PRESTAMOS DE TERCEROS*****************************-->












<!--***************************TABLA RETIROS (OCULTAMOS ESTA TABLA)************************-->
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333; display: none;">RETIROS</h3>
<div class="container" style="display: none;">
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>
   <!-- <th width="7%">CODIGO</th>
    <th width="10%">MONTO ANTES DEL RETIRO</th>-->

    <th width="10%">FECHA DE RETIRO</th>
    <th width="80%">DETALLE DEL RETIRO</th>
    <th width="10%">MONTO RETIRADO</th>

   <!-- <th width="10%">MONTO DESPUES DEL RETIRO</th>-->
    
   
  </tr>
</thead>
<tbody>
  <?php
   $totalretiros=0;
   $objret=new Retiros();
   $resulret=$objret->listar_retiros();
   while ($filret=mysqli_fetch_object($resulret)) {
          $totalretiros=$totalretiros+$filret->monto_retiro;
       echo "<tr>";
            //  echo " <td>RET-$filret->id_retiro</td>";
              echo " <td>$filret->fecha_retiro</td>";
              echo " <td style='text-align: justify;'>$filret->detalle_retiro</td>";
             // echo " <td>$filret->montototalcaja</td>";
              echo " <td style='text-align: right;'>$filret->monto_retiro</td>"; 
             // echo " <td>$filret->monto_sobrante</td>";
              
              

        echo "</tr>";
          }
  ?>

  <tr>
    <td colspan="2">TOTAL RETIROS</td>
          
    <?php
      echo "<td style='text-align: right;font-size: 25px;'><b> $totalretiros</b></td>";
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

<!--**************************FIN DE LA TABLA RETIROS**************************-->




<div style="display: none;">
<tr >
    <td style="font-weight: bold;">TOTAL EN CAJA  DEL ADMINISTRADOR</td>
          
    <?php
      $totalencajadeladmin=$totaldepositosMenosDevolucion+($totalrelacioncont)-($totalpagado)+$totaldeuda-($totalretiros);
      echo "<td style='text-align: right; font-size:25px;'><b>$totalencajadeladmin</b></td>";
    ?>

</tr>
</div>


    <br>
    <br>
    <br>






    <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidpiso').val(idd);
    var modal = document.getElementById("myModal");
    var btnclose = document.getElementById("btncloseformpres");
    var span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    btnclose.onclick=function() {
      modal.style.display = "none";
    }
  }
</script>
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un tribunal o juzgado -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR PISO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este piso ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidpiso" name="textidpiso" placeholder="id piso" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarpiso" name="btneliminarpiso" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>



 <!-- The Modal (FORMULARIO) PARA ENTREGAR DINERO AL CONTADOR -->
<div id="myModalformcont" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosecont">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >DEPOSITO A LA CAJA DEL CONTADOR</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormDepositoContador(this);" id="frmdeposcont">
    <div class="modal-body">
      <input type="hidden" name="textidusu1" id="textidusu1" value="<?php echo $datos['id_usuario']; ?>">
      <label><b>Ingrese el monto en Bs.(El monto ingresado tine que ser menor o igual al saldo en caja Del Administrador, el sistema solo aceptara numeros enteros)</b></label><br><br>
      <input type="number" class="textform"  id="textdepositocon" name="textdepositocon" placeholder="Monto del Deposito" required><br>
                                                        
      <input type="hidden" id="textidcaja" name="textidcaja" placeholder="codigo caja" value="1" required><br>

      <input type="hidden" class="form-control" id="textsaldoadm" name="textsaldoadm"  value="<?php echo $totalencajadeladmin;?>" required><br>

     



    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="button" class="btnclose" id="btndepositocont" name="btndepositocont" value="DEPOSITAR">
    <button class="btnclose" type="button" id="btncloseformcont" style="float: right;" >Cancelar</button>
    </div>
      </form>

    </div>
  </div>

</div>



<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) deposito al contador-->
<script>
// Get the modal
var modalformcont = document.getElementById("myModalformcont");

// Get the button that opens the modal
var btn = document.getElementById("myBtnformcont");
var btncloseform = document.getElementById("btncloseformcont");

// Get the <span> element that closes the modal
var spanclose = document.getElementById("spanclosecont");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modalformcont.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclose.onclick = function() {
  modalformcont.style.display = "none";
}
btncloseform.onclick=function() {
  modalformcont.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>
<script type="text/javascript">
function validarFormDepositoContador(formulariocont) {

   if(formulariocont.textdepositocon.value <=0) { //comprueba que no esté vacío
    formulariocont.textdepositocon.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>












<!-- The Modal (FORMULARIO) PARA DEVOLVER CAJA DEL CONTADOR -->
<div id="myModalformcontdevolver" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosecontdevolver">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >DEVOLVER CAJA DEL CONTADOR</p></center>
     </div><br>
    <form method="post" id="frmdevolvercont">
    <div class="modal-body">
      <input type="hidden" name="textidusu1" id="textidusu1" value="<?php echo $datos['id_usuario']; ?>">
      <label><b>Se devolvera la cantidad de Bs. :<?php echo $filac->cajacontador; ?>   </b></label><br><br>
     <br>
                                                        
      <input type="hidden" id="textidcaja" name="textidcaja" placeholder="codigo caja" value="1" required><br>

      <input type="hidden" class="form-control" id="montodevcont" name="montodevcont"  value="<?php echo $filac->cajacontador; ?>" required><br>

     



    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="button" class="btnclose" id="btndevolvercajacont" name="btndevolvercajacont" value="DEVOLVER">
    <button class="btnclose" type="button" id="btncloseformcontdevove" style="float: right;" >Cancelar</button>
    </div>
      </form>

    </div>
  </div>

</div>





<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) deposito al contador-->
<script>
// Get the modal
var modalformcontdevol = document.getElementById("myModalformcontdevolver");

// Get the button that opens the modal
var btn = document.getElementById("myBtnformcontdevolver");
var btncloseform = document.getElementById("btncloseformcontdevove");

// Get the <span> element that closes the modal
var spanclose = document.getElementById("spanclosecontdevolver");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modalformcontdevol.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclose.onclick = function() {
  modalformcontdevol.style.display = "none";
}
btncloseform.onclick=function() {
  modalformcontdevol.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>






















<!--CODIGO JAVASCRIPT  PARA INSERTAR CON JQUERY-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#btndepositocont').click(function(){
       var datos=$('#frmdeposcont').serialize();
       
       if ($('#textdepositocon').val()>0) 
       {
           $.ajax({
            type:"post",
            url:"controller/control-depositoContador.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) 
              {
                setTimeout(function(){ location.href='relacion-contador-admin.php' }, 500); swal('EXELENTE','Se Deposito Al COntador Con Exito','success');
              }
              if(respuesta==0)
              {
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Deposito AL Contador','warning');
              }
              if (respuesta==2) 
              {
                setTimeout(function(){  }, 2000); swal('ERROR','No Puede Depositar una cantidad mayor a la caja del Administrador','warning');
              }
              $('#textdepositocon').val('');
            }
          });
           return false;

        }
        else
        {
          setTimeout(function(){  }, 2000); swal('ERROR','debe colocar un numero mayor a cero','warning');
        }
    });
  });
</script> 






<!--CODIGO JAVASCRIPT  PARA INSERTAR CON JQUERY-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#btndevolvercajacont').click(function(){
       var datos=$('#frmdevolvercont').serialize();
       
       if ($('#montodevcont').val()>0) 
       {
           $.ajax({
            type:"post",
            url:"controller/control-devolverCajaContador.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) 
              {
                setTimeout(function(){ location.href='relacion-contador-admin.php' }, 500); swal('EXELENTE','Se Devolvio El Dinero Del Contador Exito','success');
              }
              if(respuesta==0)
              {
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Devolvio el Dinero Del Contador','warning');
              }
              
              
            }
          });
           return false;

        }
        else{
          setTimeout(function(){  }, 2000); swal('ERROR','No hay Saldo Para Devolver','warning');
        }
    });
  });
</script>
