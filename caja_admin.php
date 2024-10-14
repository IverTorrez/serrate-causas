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
    <title>Caja-Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
   
   <?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " .gmdate("D, d M Y H:i:s" )."GMT");
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
?>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

   
 

    <link rel="stylesheet" type="text/css" href="resources/menu.css">
   
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

  <script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">
     <script src="js/jquery.js"></script>
     

      <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">

  <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
</head> 
<body>
<?php
 //onload="cargarsettime()"
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');
include_once('model/clspresupuesto.php');
include_once('model/clscostofinal.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsdeposito.php');
include_once('model/clscliente.php');
include_once('model/clsprestamos.php');/*nuevo*/
include_once('model/clsprocurador.php');
include_once('model/clspagoprocurador.php');
include_once('model/clstransferencia_contador.php');/*nuevo*/
include_once('model/clsretiros.php');/*nuevo*/
//include_once('controller/control-caja.php');/*PRESTAMO EXTERNO Y DEVOLUCIONES*/
//include_once('controller/control-transferencia.php');
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
               
                
                 <li  class="" style="float: left; margin: 0 14px; width: 430px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

     <div id="main_content">
            
        <div id="portfolio_area">
        <div class="container">    
          <div id="portfolio_menu">
           

            </div>
            </div>

        </div>

    </div>
<!--FUNCIONES PARA REDIRECCIONAR AL LOGIN -->
    <script type="text/javascript">
      function cargarsettime()
      {
        setTimeout('redireccionar()',10000);
      }
    </script>

    <script type="text/javascript">
      function redireccionar()
      {
        location.href='index.php';
      }
    </script>
    
 
   <!--OCULTAMOS EL TITULO DE LA TABLA A-->
    <h3 id="titulodetodascausas" style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333; display: none;">A).- SALDOS DE TODAS LAS CAUSAS-EN FORMA ASCENDENTE SEGUN EL CODIGO</h3>

    <h3 id="titulodecausaiddesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL CODIGO</h3>

    <h3 id="titulodecausaSaldodesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL SALDO</h3>

    <h3 id="titulodecausaSaldoAsc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA ASCENDENTE SEGUN EL SALDO</h3>
   


    <div class="container" id="divtodaslascausa" style="display: none;"><!--OCULTAMOS TABLA A (REFERENCIAS)-->
      <div style="overflow: scroll; height: 300px;"><!--INICIA EL SCROLL-->
     <table id="customers">
       <thead>
         <tr>
           <th width="25%"><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="iddesc" onclick="funcionlistaridcausadescendente();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="idasc" onclick="funcionmostrarAscendenteID();">  CODIGO DE CAUSA</th>
           <th>NOMBRE DE LA CAUSA</th>
           <th>NOMBRE DEL CLIENTE</th>

           <th width="10%" ><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="saldodesc" onclick="funcionmostrarDescendenteSaldo();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="saldoasc" onclick="funcionmostrarAscendenteSaldo();">SALDO</th>
         </tr>
       </thead>
       
       <tbody id="bodytodascausas" >
         

         <?php
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaysaldoYcliente();
        $totalsaldocausas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausas=$totalsaldocausas+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: left;'>$fila->nombcli</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="3">SALDO TOTAL</td>
          
           <?php
           echo "<td style='text-align: right; font-size: 25px; font-weight: bold;'>$totalsaldocausas</td>";
           ?>

         </tr>
         

        
       </tbody>
       

       <tbody id="bodydesc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConIdDescenenteYsaldo();
        $totalsaldocausasdescendid=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausasdescendid=$totalsaldocausasdescendid+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausasdescendid</td>";
           ?>

         </tr>

       </tbody>


       <tbody id="bodysaldodesc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConSaldoDescenenteYsaldo();
        $totalsaldocausassaldodesc=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausassaldodesc=$totalsaldocausassaldodesc+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausassaldodesc</td>";
           ?>

         </tr>

       </tbody>

       <tbody id="bodysaldoAsc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConSaldoAscenenteYsaldo();
        $totalsaldocausassaldoAsc=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausassaldoAsc=$totalsaldocausassaldoAsc+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausassaldoAsc</td>";
           ?>

         </tr>

       </tbody>

      
        
      
     </table>
       </div><!--FIN DEL SCROOLL-->
    </div>

    
    <!--DIV DONDE SE CARGA LA TABLA DE CAUSAS CONGELADAS-->
    <div class="container">
    <div id="divcausascongeladas">
      
    </div>
    </div>
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS CONGELADAS-->

    <!--DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
    
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
  



   <!--<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAJA DEL CONTADOR</h3>
    ESTA TABLA ESTA PARA QUE CUADRE LA CAJA DEL ADMINISTRADOR, PERO NO SE MOSTRATA-->
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
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filac->cajacontador</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN TRANSITO  (Cargado al Procurador)</td>";
          echo "<td style='text-align: right;'>$totalentregado</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO SIN CONFIRMAR POR EL CONTADOR
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO DESCARGADO ELECTRONICAMENTE</td>";
          echo "<td style='text-align: right;'>$totalpresugastado</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO  CONFIRMADO SOLO POR EL CONTADOR(sin serrar, muestra el presupuesto)
          echo "<tr>"; 
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
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO CONFIRMADO POR EL CONTADOR (DINERO DE ORDENES SERRADAS)</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir</td>";
         
          echo "</tr>";


        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado+($totalpresugastadoconfir);


         ?>

         <tr>
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





























<!--*****************************************CAJA DEL CONTADOR (ocultamos tablas B las dos)***********-->
    <div class="container" style="display: none;">
      <h3 style="color: #000000;font-size: 30px;text-align: left; text-shadow: -2px -2px 5px #333">B).- RELACIÓN ADMINISTRADOR-CONTADOR</h3>
     <table id="customers">
       <thead>
         <tr>
           <th width="90%">CAJA DE CONTADOR</th>
           
           <th width="10%" >SALDO</th>
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
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>A* DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right; font-size: 25px; font-weight: bold;'>$filac->cajacontador</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr>"; 
          echo "<td style='text-align: left;'>B* DT EN MANOS DEL PROCURADOR (entregado al procurador pero aun no gastado)</td>";
          echo "<td style='text-align: right;'>$totalentregado</td>";
         
          echo "</tr>";


/*------------------------NUEVO CODIGOS PARA LA TABLA-------------------------------------------------------*/
            $objordengasto=new OrdenGeneral();
            $resulgasto=$objordengasto->dineroGastadoSinConciliarporContador();
             $filgasto=mysqli_fetch_object($resulgasto);
             $gastosinconciliar=0;
             $gastosinconciliar=$gastosinconciliar+($filgasto->gastado);
          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr>"; 
          echo "<td style='text-align: left;'>C* DT GASTADO (gastado por el procurador pero sin conciliar con el contador)</td>";
          echo "<td style='text-align: right;'>$gastosinconciliar</td>";
         
          echo "</tr>";


          
          $objsaldos=new OrdenGeneral();
          $resulsaldo=$objsaldos->SaldosPorDevolverAContador();
          $filsaldo=mysqli_fetch_object($resulsaldo);
          $saldosdev=0;
          $saldosdev=$saldosdev+($filsaldo->saldos);
           echo "<tr>"; 
          echo "<td style='text-align: left;'>D* DT SALDO DE VENIDA (saldo por volver a caja, sin conciliar con el contador)</td>";
          echo "<td style='text-align: right;'>$saldosdev</td>";
         
          echo "</tr>";
         

        /*ES EL VOLUMEN TOTAL MANEJADO POR EL CONTADOR*/
          $volumtotal=$filac->cajacontador+$totalentregado+($gastosinconciliar)+($saldosdev);
          echo "<tr>"; 
          echo "<td style='text-align: left;font-weight: bold;'>E* TOTAL DINERO MANEJADO POR EL CONTADOR</td>";
          echo "<td style='text-align: right; font-weight: bold;'>$volumtotal</td>";
         
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
          echo "<tr>"; 
          echo "<td style='text-align: left;font-weight: bold;'>F* TOTAL DINERO SIN CONFIRMAR POR EL ADMINISTRADOR</td>";
          echo "<td style='text-align: right;font-weight: bold;'>$totalmontosinconfir</td>";
         
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













<!---------------------------------TABLA RELACION ADMIN-CONTADOR (OCULTAMOS ESTA TABLA)---------->
   <div class="container" style="display: none;">
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
        echo "<td style='text-align: left;'>$filtran->fecha_trans</td>";
        echo "<td style='text-align: right;'>$depositocont</td>";
        echo "<td style='text-align: right;'>$devolucioncont</td>";


        echo "</tr>";
      }
      ?>

     <tr>
       <td style="text-align: center;font-weight: bold;">SUBTOTALES</td>
       <td style='text-align: right;'><?php echo $subtotaldepositocont; ?></td>
       <td style='text-align: right;'><?php echo $subtotaldevolucioncont; ?></td>
     </tr>
     
     <?php
     $totalrelacioncont=$subtotaldevolucioncont-$subtotaldepositocont;
     ?>
     <tr>
       <td colspan="2" style="font-weight: bold;">TOTAL</td>
       <td style='text-align: right; font-size: 25px; font-weight: bold;'><?php echo $totalrelacioncont; ?></td>
     </tr>

      <tbody>
        
      </tbody>
    </table>
   </div> 
 
  <!--*********************FIN DE LA TABLA RELACION ADMIN-CONTADOR***************************-->











<!------TABLA SUMA ACUMULADAS PARA PAGAR A PROCURADORES (OCULTAMOS LA TABLA)-->
<div class="container" style=" display: none;">
  <h2 style="color: #000000;font-size: 30px; text-shadow: -2px -2px 5px #333; text-align: left;">C).-SUMA ACUMULADA PARA PAGAR A LOS PROCURADORES</h2>
  
   <section>
 <table id="customers"  >

 <thead>     
  <tr>
    <th>NOMBRE DEL PROCURADOR</th>
    <th>POSITIVO <br>(ganacias)</th> 
    <th>NEGATIVO <br>(penalidad)</th>
    <th width="10%">TOTAL POR PAGAR</th>
  </tr>
</thead>
<tbody>
  <?php
   
   $pagodelproc=0;
   $sumapositivos=0;
   $sumapenalidad=0;
   $totalporpagar=0;
   $objpagoacumulado=new PagoProcurador();
   $resulpagoacu=$objpagoacumulado->consultaParaPagarATodosProcuradores();
   while ($filacum=mysqli_fetch_object($resulpagoacu)) 
         {
             $pagodelproc=$filacum->compraprocu+($filacum->penalidadproc);
             $sumapositivos=$sumapositivos+$filacum->compraprocu;
             $sumapenalidad=$sumapenalidad+($filacum->penalidadproc);
       echo "<tr>";
              echo "<td style='text-align: left;'>$filacum->procu</td>";        
              echo "<td style='text-align: right;'>$filacum->compraprocu</td>";
              echo "<td style='text-align: right;'>$filacum->penalidadproc</td>";

              echo "<td style='text-align: right;'>$pagodelproc</td>";
        echo "</tr>";
          }
  ?>
  <tr>
     <td >ACUMULADO POR PAGAR A LOS PROCURADORES</td>
    <?php
      $totalporpagar=$sumapositivos+($sumapenalidad);
      echo "<td style='text-align: right;'><b>$sumapositivos</b></td>";
      echo "<td style='text-align: right;'><b>$sumapenalidad</b></td>";
      echo "<td style='text-align: right; font-size: 25px;'><b>$totalporpagar</b></td>";
    ?>
  </tr>
</tbody>
</table>
</section>
</div>
   




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













<!--****************TABLA GANANCIAS (ocultamos esta tabla)**************************-->
 
    <div class="container" style="display: none;">
      <h3 style="color: #000000;font-size: 30px;text-align: left; text-shadow: -2px -2px 5px #333">E).-REMANENTE DE LAS GANANCIAS</h3>
      <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">GANANCIAS</h3>
     <table id="customers">
      <thead>
        <tr>
          <th width="90%">GANANCIAS</th>
          <th>TOTAL</th> 
        </tr>
      </thead>
       <tbody>
       <?php
       $totalsumaganacias=0;

       $sumaganaciaprocu=0;
       $obcaja2=new Costofinal();
       $list=$obcaja2->mostrargananciasprocuradoria();
        $filag=mysqli_fetch_object($list);
        $sumaganaciaprocu=$sumaganaciaprocu+$filag->GananciaProcuradoria;

        $sumagananciaprocesal=0;
        $obc=new Costofinal();
        $re=$obc->mostrargananciaprocesal();
        $filaproce=mysqli_fetch_object($re);
        $sumagananciaprocesal=$sumagananciaprocesal+$filaproce->GananciaProcesal;

        $objcostof=new Costofinal();
        $resulpenal=$objcostof->mostrarpenalidadCancelada();
         $totalentregadopenalidad=0;
        while ($filpenal=mysqli_fetch_object($resulpenal)) {
         $totalentregadopenalidad=$filpenal->penalidadcostofinal+$totalentregadopenalidad;
        } 

            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>Ganancia por Diferencia en Procuraduría (compra vs venta)</td>";
          echo "<td style='text-align: right;'>$sumaganaciaprocu</td>";
         
          echo "</tr>";

          echo "<tr>"; 
          echo "<td style='text-align: left;'>Ganancia por Gasto Judicial (compra vs venta)</td>";
          echo "<td style='text-align: right;'>$sumagananciaprocesal</td>";
         
          echo "</tr>";
          ////////////ES EL MONTO DE DINERO QUE LE RESTAMOS A LOS PROCURADORES EN PENALIDAD/////////
          $positivopenalidad=$totalentregadopenalidad*(-1);
          echo "<tr>"; 
          echo "<td style='text-align: left;'>Ganancia por Penalidades</td>";
          echo "<td style='text-align: right;'>$positivopenalidad</td>";
         
          echo "</tr>";

         $totalsumaganacias=$filag->GananciaProcuradoria+$filaproce->GananciaProcesal+$positivopenalidad;
          echo "<tr>"; 
          echo "<td style='text-align: center;'>SUMA TOTAL</td>";
          echo "<td style='text-align: right;font-size: 25px;'><b> $totalsumaganacias </b></td>";
         
          echo "</tr>";


       ?>
       
         
       </tbody>
     </table>
     </div> 

 
<!--FIN DE TABLA GANANCIAS-->







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














<!--***************************TABLA CAJA TOTAL DEL ADMIN************************-->
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">TOTALES DE LA CAJA DEL ADMINISTRADOR</h3>
<div class="container">
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>

    <th width="90%">DETALLE</th>
   
    <th width="10%">MONTO</th>
    
   
  </tr>
</thead>
<tbody >
  <tr>
    <td style="text-align: left;"><a href="saldos_causas.php" target="_blank">A* Depósitos y devoluciones con el cliente (dato para operación)</a>  </td>
    <?php
      $depositosydevoluciones=$totaldepositosd-$totaldevolucion;
      echo "<td style='text-align: right;'><b>$depositosydevoluciones</b></td>";/*TOTAL LOS DEPOSITOS Y DEVOLUCIONES DE TODAS LA CAUSAS (no s lo mismo que saldos de todas las causas)*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;"><a href="relacion-contador-admin.php" target="_blank">B* Relación Administrador-contador (dato para operación)</a> </td>
    <?php
      echo "<td style='text-align: right;'><b>$totalrelacioncont</b></td>";/*TOTAL RELACION ADMIN-CONTADOR*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;"> <a href="pagoprocuradores.php" target="_blank">C* Pago a procuradores (*solo egresos)</a> </td>
   <?php
      echo "<td style='text-align: right;'><b>$totalpagado</b></td>";/*TOTAL PAGADO A PROCURADORES*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;"><a href="prestamos.php" target="_blank">D* Préstamos a terceros</a> </td>
    <?php
      echo "<td style='text-align: right;'><b>$totaldeuda</b></td>";/*TOTAL DEUDA A TERCEROS*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;"> <a href="retiros.php" target="_blank">E* Remanente de la ganancias (*solo egresos)</a> </td>
    <?php
      echo "<td style='text-align: right;'><b>-$totalretiros</b></td>";/*TOTAL RETIRADOS POR GANACIAS*/
    ?>
  </tr>





  <tr>
    <td style="font-weight: bold;">TOTAL EN CAJA  DEL ADMINISTRADOR</td>
          
    <?php
      $totalencajadeladmin=$depositosydevoluciones+($totalrelacioncont)-($totalpagado)+$totaldeuda-($totalretiros);
      echo "<td style='text-align: right; font-size:25px;'><b>$totalencajadeladmin</b></td>";
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

    <br>
    <br>
    <br>
<!--**************************FIN DE LA TABLA CAJA DEL ADMIN**************************-->















<!--****TABLA NUEVA CAJA TOTAL DEL ADMIN (ocultamos la caja 2 del admin) opcion 2*****-->
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333; display: none;">2.-TOTALES DE LA CAJA DEL ADMINISTRADOR</h3>
<div class="container" style="display: none;">
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>

    <th width="90%">DETALLE</th>
   
    <th width="10%">MONTO</th>
    
   
  </tr>
</thead>
<tbody>
  <tr>
    <td style="text-align: left;">A* Depósitos y devoluciones con el cliente (saldo de todas las causas)</td>
    <?php
      echo "<td style='text-align: right;'><b>$totalsaldos</b></td>";/*TOTAL SALDOS DE TODAS LAS CAUSAS*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;">B* DINERO DEL CONTADOR</td>
    <?php
      echo "<td style='text-align: right;'><b>$filac->cajacontador</b></td>";/*TOTAL DINERO DEL CONTADOR*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;">C* Pago a procuradores (*solo egresos)</td>
   <?php
      echo "<td style='text-align: right;'><b>$totalpagado</b></td>";/*TOTAL PAGADO A PROCURADORES*/
    ?>
  </tr>

  <tr>
    <td style="text-align: left;">D* Préstamos a terceros</td>
    <?php
      echo "<td style='text-align: right;'><b>$totaldeuda</b></td>";/*TOTAL DEUDA A TERCEROS*/
    ?>
  </tr>


   <tr>
    <td style="text-align: left;">E* Ganancias Totales</td>
    <?php
    // $totalsumaganacias;
      echo "<td style='text-align: right;'><b>$totalsumaganacias</b></td>";/*EL TOTAL DE GANANCIAS*/
    ?>
  </tr>


  <tr>
    <td style="text-align: left;">F* Remanente de la ganancias (*solo egresos)</td>
    <?php
      echo "<td style='text-align: right;'><b>-$totalretiros</b></td>";/*TOTAL RETIRADOS POR GANACIAS*/
    ?>
  </tr>


  <tr>
    <td style="text-align: left;">G* Ganancias Disponibles</td>
    <?php
     $gananciasdisponibles=$totalsumaganacias-$totalretiros;
      echo "<td style='text-align: right;'><b>$gananciasdisponibles</b></td>";/*GANACIAS DISPONIBLES PARA RETIRAR*/
    ?>
  </tr>


 



  <tr>
    <td style="font-weight: bold;">TOTAL EN CAJA  DEL ADMINISTRADOR</td>
          
    <?php


        /*FORMULA PARA LA CAJA DEL ADMIN (INTERFAZ CAJA)*/
        $totalencajaadm=0;
        $totalencajaadm=$totalsaldocausas+$totalsumaganacias+$totalgenerado+$filc->deudaexterna-($nuevototalcontador);
        /***********************************************/


          /*OBTENEMOS LOS PRESUPUESTOS DE ORDENES QUE NO SE AN SERRADO, PARA HACER CUADRAR LA CAJA DEL ADMIN */

          /*presupuestos entregados*/
          $presu_entregados=0;
          $objor1=new OrdenGeneral();
          $resulor=$objor1->presupuestosENtregadosSinSerrar();
          $filas=mysqli_fetch_object($resulor);
          $presu_entregados=$presu_entregados+$filas->presup_entregado;
          /*fin de presupuestos entregados*/
          
          $presu_gastado=0;
          $resulgastado=$objor1->presupuestosGastadosSinSerrar();
          $filgastado=mysqli_fetch_object($resulgastado);
          $presu_gastado=$presu_gastado+$filgastado->presup_gastado;

          $presu_confirContsinSerrar=0;
          $resulconfircontsinserrar=$objor1->presupuestoConfirContadorNoSerrada();
          $filconfirsinserrar=mysqli_fetch_object($resulconfircontsinserrar);
          $presu_confirContsinSerrar=$presu_confirContsinSerrar+$filconfirsinserrar->monto_confir_sinserrar;

/*NUEVO CODIGO PARA EL TOTAL DEL CONTADOR*/
           /*ESTA FUNCION DEVUELVE EL SALDO DE LAS DESCARGAS QUE NO TIENEN COSTO FINAL, Y POR LO TANTO PUEDEN AFECTAR A LA CAJA DEL CONTADOR , OSEA SI EL RESULTADO DE LA CONSULTA ES POSITIVO SE VUELVE NEGATIVO Y VICEVERSA, ESTO PARA NO AFECTAR A LA CAJA DEL CONTADOR*/

           $cajadelcontador=$filac->cajacontador+$presu_entregados+$presu_gastado+$presu_confirContsinSerrar;/*MONTO DE DINERO DEL CONTADOR ()*/
            
           /*MUESTRA LOS SALDOS DE LAS DESCARGAS, ORDENES CON ESTADO-> PronuncioContador*/
           $saldocuadrar=0;
           $objorden=new OrdenGeneral();
           $resultado1=$objorden->mostrarsaldosOrdenesNoserradas();
           $fila1=mysqli_fetch_object($resultado1);
          /*CONVERCION DEL SALDO */
          $saldocuadrar=$fila1->saldito*(-1);
           


           $nuevototalcontador1=$cajadelcontador+($saldocuadrar);
/*-------------------------------------------------*/

        $obcaja=new Costofinal();
       $list=$obcaja->mostrargeneradosporprocuradornocancelados();
       $totalgenerado=0;
       while ($fil=mysqli_fetch_object($list)) 
       {
         $totalgenerado=$fil->costo_procuradoria_compra+$totalgenerado;/*ES EL TOTAL POSITIVO PARA PAGAR A LOS PROCURADORES*/
        } 

       
      $totalencajadeladmin=$totalsaldos+($gananciasdisponibles)+($totalgenerado)-($nuevototalcontador1)+($totaldeuda);
      echo "<td style='text-align: right; font-size:25px;'><b>$totalencajadeladmin</b></td>";
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

    <br>
    <br>
    <br>
<!--**************************FIN DE LA TABLA NUEVA CAJA DEL ADMIN**************************-->









</body>
</html>



