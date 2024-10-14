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
<head>
    <title>Cajas</title>
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
include_once('controller/control-caja.php');
include_once('controller/control-transferencia.php');
include_once('controller/control-devolvercajadelcontador.php');


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
           <ul>
            <li><button style="" class="botones" id="myBtnformcont">ENTREGAR CAJA AL CONTADOR</button></li>
            <li><button style="" class="botones" id="myBtnformcontdevolver">DEVOLVER CAJA DEL CONTADOR</button></li>
             <li><button style="width: 300px;" class="botones" id="myBtnformtrans">TRANSFERENCIA DE FONDOS ENTRE CAUSAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarcausasActivas();">LISTAR CAUSAS ACTIVAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarcausascongeladas();">LISTAR CAUSAS CONGELADAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarcausasterminadas();">LISTAR CAUSAS TERMINADAS</button></li>
          </ul><br><br>

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
    
 

    <h3 id="titulodetodascausas" style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA ASCENDENTE SEGUN EL CODIGO</h3>

    <h3 id="titulodecausaiddesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL CODIGO</h3>

    <h3 id="titulodecausaSaldodesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL SALDO</h3>

    <h3 id="titulodecausaSaldoAsc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA ASCENDENTE SEGUN EL SALDO</h3>

    <div class="container" id="divtodaslascausa">
     <table id="customers">
       <thead>
         <tr>
           <th width="25%"><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="iddesc" onclick="funcionlistaridcausadescendente();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="idasc" onclick="funcionmostrarAscendenteID();">  CODIGO DE CAUSA</th>
           <th>NOMBRE DE LA CAUSA</th>

           <th width="10%" ><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="saldodesc" onclick="funcionmostrarDescendenteSaldo();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="saldoasc" onclick="funcionmostrarAscendenteSaldo();">SALDO</th>
         </tr>
       </thead>
       <tbody id="bodytodascausas">
         

         <?php
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaysaldo();
        $totalsaldocausas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausas=$totalsaldocausas+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausas</td>";
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
      
    </div>

    
    <!--DIV DONDE SE CARGA LA TABLA DE CAUSAS CONGELADAS-->
    <div class="container">
    <div id="divcausascongeladas">
      
    </div>
    </div>
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS CONGELADAS-->

    <!--DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
    
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
     <br><br><br>



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

    

    <!--CONSULTAS Y TABLAS PARA MOSTRAR EL SALDO DEL CONTADOR (ESTA TABLA NO AFECTA A LAS CAJA DEL ADMIN)-->
    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAJA DEL CONTADOR </h3>
    <div class="container">
    <table id="customers">
      <thead>
        <tr>
          <th>SUBCAJAS</th>
          <th>MONTO</th>
        </tr>
      </thead>


      <tbody>
      <?php

      $objpresugastado=new Presupuesto();
      $resulgastado=$objpresugastado->sumaPresupuestoGastadoSinConfirContador();
      $filgastadosinconfi=mysqli_fetch_object($resulgastado);

      $objpressingas=new Presupuesto();
      $resulsingas=$objpressingas->sumaPresupuestoEntregado_al_Procurador_SinGastar();
      $filentregadosingas=mysqli_fetch_object($resulsingas);

       $objcajacont=new Cajasdesalida();
        $resultcont=$objcajacont->mostrarcajadelcontador();
        
        $filacont=mysqli_fetch_object($resultcont);

        /*FUNCION PARA SUMAR TODO EL PRESUPUESTO GASTADO O ENTREGAO AL PROCURADOR (DINERO QUE AUN NO AH CONFIRMADO EL CONTADOR O NO HIZO LA DEVOLUCION)*/
        $objpresup=new Presupuesto();
        $resulpresu=$objpresup->sumaPresupuestoEntregado_al_Procurador();
        $filapresu=mysqli_fetch_object($resulpresu);

        /*FUNCION PARA SUMAR TODO EL PRESUPUESTO CONFIRMADO POR EL CONTADOR (YA SE HIZO LA DEVOLUCION DE DINERO)*/
        $objpregas=new Presupuesto();
        $resulpresugas=$objpregas->sumaPresupuestoConfirmadoContador();
        $filapresugas=mysqli_fetch_object($resulpresugas);
        
        $totalentregadoContador=$filacont->cajacontador+$filapresu->totalentregado+$filapresugas->totalconfirmado;
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filacont->cajacontador</td>";
         
          echo "</tr>";


         /* echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO ENTREGADO AL PROCURADOR</td>";
          echo "<td style='text-align: right;'>$filapresu->totalentregado</td>";
         
          echo "</tr>";*/

          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO ENTREGADO AL PROCURADOR (AUN NO GASTADO)</td>";
          echo "<td style='text-align: right;'>$filentregadosingas->totalentregadosingastar</td>";
         
          echo "</tr>";
          
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO SIN CONFIRMAR POR EL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filgastadosinconfi->totalgastado</td>";
         
          echo "</tr>";



          /*echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO CONFIRMADO POR EL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filapresugas->totalconfirmado</td>";
         
          echo "</tr>";*/




          /*echo "<tr>"; 
          echo "<td style='text-align: center;'>TOTAL</td>";
          echo "<td style='text-align: right;'>$totalentregadoContador</td>";
         
          echo "</tr>";*/

          $obccc1=new Costofinal();
         $resultadog1=$obccc1->mostrardinerogastadosinvalida();
         $totalmontosinconfir1=0;
         while ($filpaa=mysqli_fetch_object($resultadog1)) {
              $totalmontosinconfir1=$filpaa->Gastado+$totalmontosinconfir1;
         }

         echo "<tr>"; 
          echo "<td style='text-align: left;'>MONTO TOTAL SIN CONFIRMAR POR EL ADMINISTRADOR</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir1</td>";
         
          echo "</tr>";

      ?>
        
      </tbody>
      
    </table>
      
    </div><br><br>



    
    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SUMA ACUMULADA PARA PAGAR A PROCURADORES</h3>
    <div class="container">
     <table id="customers">
      <thead>
        <tr>
          <th width="90%">SUMA ACUMULADA PARA PAGAR A PROCURADORES</th>
          <th>TOTAL</th> 
        </tr>
      </thead>
       <tbody>
       <?php
       /*LOS ACUMULADOS PARA LOS PROCURADORES, POSITIVOS Y NEGATIVOS*/
       $obcosto=new Costofinal();
       $rr=$obcosto->mostrartodaslaspenalidades();
       $totalpenalidades=0;
       while ($fill=mysqli_fetch_object($rr)) {
         $totalpenalidades=$fill->penalidadcostofinal+$totalpenalidades;
        } 


       $obcaja=new Costofinal();
       $list=$obcaja->mostrargeneradosporprocuradornocancelados();
       $totalgenerado=0;
       while ($fil=mysqli_fetch_object($list)) {
         $totalgenerado=$fil->costo_procuradoria_compra+$totalgenerado;
        } 
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>ACUMULADO POSITIVO PARA PAGAR A LOS PROCURADORES</td>";
          echo "<td style='text-align: right;'>$totalgenerado</td>";
         
          echo "</tr>";

          echo "<tr>"; 
          echo "<td style='text-align: left;'>ACUMULADO NEGATIVO PARA COBRAR A LOS PROCURADORES</td>";
          echo "<td style='text-align: right;'>$totalpenalidades</td>";
         
          echo "</tr>";

          $saldoapagarprocuradoria=$totalgenerado+$totalpenalidades;

       ?>

          <tr>
           <td >SALDO TOTAL PARA PAGAR A PROCURADORIA</td>
          
           <?php
           echo "<td style='text-align: right;'>$saldoapagarprocuradoria</td>";
           ?>

         </tr>
       
         
       </tbody>
     </table>
     </div> 

    <br><br>


     <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">PRESTAMO DE UN TERCERO</h3>
    <div class="container">
     <table id="customers">
      <thead>
        <tr>
          <th>PRESTAMO DE UN TERCERO</th>
          <th width="10%">TOTAL</th> 
          <th width="10%">RECIBIR PRESTAMO</th> 
          <th width="10%">DEVOLVER PRESTAMO</th> 
        </tr>
      </thead>
       <tbody>
       <?php
       $obcajas=new Cajasdesalida();
       $lista=$obcajas->mostrardeudaexterna();
        $filc=mysqli_fetch_object($lista);
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>MONTO DEUDA EXTERNA</td>";
          echo "<td style='text-align: right;'>$filc->deudaexterna</td>";
          echo "<td><button style=' height:40px; background-color: #1A5895; color: white; border: none; border-radius: 4px; cursor: pointer;' id='myBtnformpres'>RECIBIR PRESTAMO</button></td>";
          echo "<td><button style='height:40px; background-color: #1A5895; color: white; border: none; border-radius: 4px; cursor: pointer;' id='myBtnformdevol'>DEVOLVER PRESTAMO</button></td>";
         
          echo "</tr>";

       ?>
      
       
         
       </tbody>
     </table >
     </div> 

    <br><br>

<!--CODIGO PARA MOSTRAR DINERO GASTADO DE ORDEN PERO , ES INSUFICIENTE , NO E MOSTRARA
    <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DINERO MAL GASTADO</h3>
    <div class="container">
     <table id="customers">
      <thead>
        <tr>
          <th width="90%">TOTAL DE DINERO MAL GASTADO</th>
          <th>TOTAL</th> 
        </tr>
      </thead>
       <tbody>-->
       <?php
       /*
       $obco=new Costofinal();
       $listam=$obco->mostrartodolosmalgasto();
       $totalmalgastado=0;
      while ( $film=mysqli_fetch_object($listam)) {
           $totalmalgastado=$film->malgasto+$totalmalgastado;
        } 
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>MONTO MAL GASTADO</td>";
          echo "<td style='text-align: right;'>$totalmalgastado</td>";
         
          echo "</tr>";
        */
       ?>
       
         
 <!--      </tbody>
     </table>
     </div> 

    <br><br>-->
    <div style="display: none;">
   <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">MONTO SIN CONFIRMAR</h3>
    <div class="container">
    <table id="customers">
    <thead>
      <tr>
        <th>MONTO SIN CONFIRMAR</th>
        <th>TOTAL</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $obccc1=new Costofinal();
         $resultadog1=$obccc1->mostrardinerogastadosinvalida();
         $totalmontosinconfir1=0;
         while ($filpaa=mysqli_fetch_object($resultadog1)) {
              $totalmontosinconfir1=$filpaa->Gastado+$totalmontosinconfir1;
         }

         echo "<tr>"; 
          echo "<td style='text-align: left;'>MONTO TOTAL SIN CONFIRMAR POR EL ADMINISTRADOR</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir1</td>";
         
          echo "</tr>";

      ?>
    </tbody>
      
    </table>
      
    </div><br><br>
    </div>

     <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">GANANCIAS</h3>
    <div class="container">
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
          echo "<td style='text-align: left;'>GANANCIAS EN PROCURADORIA</td>";
          echo "<td style='text-align: right;'>$sumaganaciaprocu</td>";
         
          echo "</tr>";

          echo "<tr>"; 
          echo "<td style='text-align: left;'>GANANCIAS EN GASTOS PROCESALES</td>";
          echo "<td style='text-align: right;'>$sumagananciaprocesal</td>";
         
          echo "</tr>";
          ////////////ES EL MONTO DE DINERO QUE LE RESTAMOS A LOS PROCURADORES EN PENALIDAD/////////
          $positivopenalidad=$totalentregadopenalidad*(-1);
          echo "<tr>"; 
          echo "<td style='text-align: left;'>COMPENSACION POR PENALIDAD</td>";
          echo "<td style='text-align: right;'>$positivopenalidad</td>";
         
          echo "</tr>";

         $totalsumaganacias=$filag->GananciaProcuradoria+$filaproce->GananciaProcesal+$positivopenalidad;
          echo "<tr>"; 
          echo "<td style='text-align: center;'>SUMA TOTAL</td>";
          echo "<td style='text-align: right;'>$totalsumaganacias</td>";
         
          echo "</tr>";


       ?>
       
         
       </tbody>
     </table>
     </div> 

    <br><br>


        <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DINERO EN CAJA DEL ADMINISTRADOR</h3>
    <div class="container">
     <center><table id="customers" style="width: 50%;" >
       <thead>
        
         
       </thead>
       <tbody>
         <tr>
           <td style="text-align: left; font-size: 40px;"><b>TOTAL EN CAJA</b></td>
           <?php
           $totalencajaadm=0;
           $totalencajaadm=$totalsumaganacias+$totalgenerado+$totalsaldocausas+$filc->deudaexterna-($nuevototalcontador);
           echo "<td style='font-size: 40px;'><b>$totalencajaadm</b></td>";

          $_SESSION['cajaADM']=$totalencajaadm;

         function mostrarCajaADM()
          {
            return $_SESSION['cajaADM'];
          }

      

           ?>
          
     
         </tr>

       
       </tbody>
     </table></center>
      
    </div>




    <br>
    <br>
    <br>



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
    <form method="post" onsubmit="return validarFormDepositoContador(this);" >
    <div class="modal-body">
      <label><b>Ingrese el monto en Bs.(El monto ingresado tine que ser menor o igual al saldo en caja Del Administrador, el sistema solo aceptara numeros enteros)</b></label><br><br>
      <input type="number" class="textform"  id="textdepositocon" name="textdepositocon" placeholder="Monto del Deposito" required><br>
                                                        
      <input type="hidden" id="textidcaja" name="textidcaja" placeholder="codigo caja" value="1" required><br>

      <input type="hidden" class="form-control" id="textsaldoadm" name="textsaldoadm"  value="<?php echo $totalencajaadm;?>" required><br>

     



    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btndepositocont" name="btndepositocont" value="DEPOSITAR">
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


    


            <!-- The Modal (FORMULARIO) PARA recibir prestamo externo -->
<div id="myModalformpres" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >PRESTAMO EXTERNO</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormPrestamoexterno(this);">
    <div class="modal-body">
      <label><b>Ingrese el monto en Bs.(El sistema solo aceptara numeros enteros)</b></label><br><br>
        <input type="number" class="textform" id="textmontoprestamo" name="textmontoprestamo" placeholder="Monto del Prestamo" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;width: 180px;" type="submit" class="btnclose" id="btnrecibirprestamo" name="btnrecibirprestamo" value="RECIBIR PRESTAMO">
    <button class="btnclose" type="button" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) prestamo externo-->
<script>
// Get the modal
var modalformpres = document.getElementById("myModalformpres");

// Get the button that opens the modal
var btnpre = document.getElementById("myBtnformpres");
var btncloseformpres = document.getElementById("btncloseformpres");

// Get the <span> element that closes the modal
var spanclosepres = document.getElementById("spanclosepres");

// When the user clicks the button, open the modal 
btnpre.onclick = function() {
  modalformpres.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosepres.onclick = function() {
  modalformpres.style.display = "none";
}
btncloseformpres.onclick=function() {
  modalformpres.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>


    
                 <!-- The Modal (FORMULARIO) PARA devolver prestamo externo -->
<div id="myModalformdevol" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosedevol">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >DEVOLVER PRESTAMO EXTERNO</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormDevolverPrestamo(this);">
    <div class="modal-body">
      <label><b>Ingrese el monto en Bs.(El sistema solo aceptara numeros enteros)</b></label><br><br>
       <input type="number" class="textform" id="textmontodevolver" name="textmontodevolver" placeholder="Monto que devolvera" required><br>
                                                        
      <input type="hidden" name="textmontoactulacajaadm" id="textmontoactulacajaadm" value="<?php echo $totalencajaadm;?>">
      
                                                        

    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; width: 180px;" type="submit" class="btnclose" id="btndevolverp" name="btndevolverp" value="DEVOLVER PRESTAMO">
     
    <button class="btnclose" type="button" id="btncloseformdevol"  style="float: right;">Cancelar</button>
     

    </div>
    </form>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) devolver prestamo-->
<script>
// Get the modal
var modalformdevol = document.getElementById("myModalformdevol");

// Get the button that opens the modal
var btndevol = document.getElementById("myBtnformdevol");
var btncloseformdevol = document.getElementById("btncloseformdevol");

// Get the <span> element that closes the modal
var spanclosedevol = document.getElementById("spanclosedevol");

// When the user clicks the button, open the modal 
btndevol.onclick = function() {
  modalformdevol.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosedevol.onclick = function() {
  modalformdevol.style.display = "none";
}
btncloseformdevol.onclick=function() {
  modalformdevol.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>

     <!--MODAL PARA HACER DEPOSITO DE UNA CAUSA A OTRA////////////////////////////////////////////-->
   
 


 <!-- The Modal (FORMULARIO) transferencia de una causa a otra -->
<div id="myModalformtrans" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosetrans">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >TRANSFERENCIA DE UNA CAUSA A OTRA</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormTranferenciaCausa(this);">
    <div class="modal-body">
    <div style="font-size: 12px;">
      <label><b>Elija la causa origen y causa destino</b></label><br><br>
      <label><b>Nota 1: En el listado de causas origen, solo apareceran las causas que tienen saldo y esten activas</b></label><br><br>
      <label><b>Nota 2: En el listado de causas destino, solo apareceran las causas que que esten activas</b></label><br><br>
       <label><b>Nota 3: Solo se hara la tranferencia entre causas del mismo cliente</b></label><br><br>
   </div> 
       <label>Origen>></label>
         <select name="selectcausaorigen" style="height: 30px;">
         <option value="0">Elija Causa Origen</option>
              <?php 
                $objcau=new Causa();
                $listcau=$objcau->mostrarCausaOrigen();
                while($cau=mysqli_fetch_array($listcau)){
                                                              
                    echo '<option value="'.$cau['id_causa'].'">'.$cau['codigo'].'</option>';
                 }
              ?> 
                                                           
         </select> 
     <label>Destino>></label>
                                                      
        <select name="selectdestino"  style="height: 30px;">
           <option value="0">Elija Causa Destino</option>
              <?php
                $objedast=new Causa();
                $listdest=$objedast->mostrarCodigoDeCausasActivas();
                while ($dest=mysqli_fetch_array($listdest)) {
                   echo '<option value="'.$dest['id_causa'].'">'.$dest['codigo'].'</option>';
                }

               ?>
                                                         
        </select><br><br>
   <label><b> Monto De La Transferencia</b></label><br><br>
       <input type="number" class="textform" id="textmontotransferencia" name="textmontotransferencia" placeholder="Monto De tranferecia"  required><br>

                                                        

    
      
                                                        

    </div>
    <div class="modal-footer">
   <input style="background: #1A5895;width: 180px;" type="submit" class="btnclose" id="btntransferencia" name="btntransferencia" value="TRANSFERIR">
    <button class="btnclose" type="button" id="btncloseformtrans" style="float: right;">Cancelar</button>
      </form>

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA INTRODUCIR EL MOTIVO del rechazo-->
<script>
// Get the modal
var modalformtrans = document.getElementById("myModalformtrans");

// Get the button that opens the modal
var btndetrans = document.getElementById("myBtnformtrans");
var btncloseformtrans = document.getElementById("btncloseformtrans");

// Get the <span> element that closes the modal
var spanclosetrans = document.getElementById("spanclosetrans");

// When the user clicks the button, open the modal 
btndetrans.onclick = function() {
  modalformtrans.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosetrans.onclick = function() {
  modalformtrans.style.display = "none";
}
btncloseformtrans.onclick=function() {
  modalformtrans.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>


<!--FUNCIONES DE JQUERY PARA LLAMAR A LAS CONSULTAS DE CAUSAS CONGELADAS, CAUSAS TERMINADAS Y ACTIVAS POR SEPARADO-->

<!--FUNCION DE JQUERY PARA LLAMAR A LAS CONSULTAS lista de causa de forma descendente de mayor a  menor segun el id-->
<script type="text/javascript">
function funcionlistaridcausadescendente(){
  
  /* $.ajax({ 
        url:'consultacausaconiddescendentes.php',
        type:'POST',
        dateType:'html',
       

      })
   
    .done(function(resul){
      $('#bodytodascausas').html(resul);
      
      })*/

    $('#bodytodascausas').hide();
    $('#bodysaldodesc').hide();
    $('#bodysaldoAsc').hide();
    $('#bodydesc').show();

    $('#iddesc').hide();
    $('#idasc').show();

    $('#titulodecausaiddesc').show();

    $('#titulodetodascausas').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').hide();

}
  
</script>



<script type="text/javascript">
  function funcionmostrarAscendenteID()
  {
   $('#bodytodascausas').show();
    $('#bodydesc').hide();
    $('#bodysaldodesc').hide();
    $('#bodysaldoAsc').hide();

    $('#titulodecausaiddesc').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').hide();

    $('#titulodetodascausas').show();


    $('#iddesc').show();
    $('#idasc').hide();
  }
</script>



<script type="text/javascript">
  function funcionmostrarDescendenteSaldo()
  {
   $('#bodytodascausas').hide();
   $('#bodydesc').hide();
    $('#bodysaldoAsc').hide();

    $('#bodysaldodesc').show();

   
   $('#titulodetodascausas').hide();
   $('#titulodecausaiddesc').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').show();
    $('#saldodesc').hide();
    $('#saldoasc').show();
  }
</script>


<script type="text/javascript">
  function funcionmostrarAscendenteSaldo()
  {
   $('#bodytodascausas').hide();
   $('#bodydesc').hide();
   $('#bodysaldodesc').hide();
    $('#bodysaldoAsc').show();

    $('#titulodetodascausas').hide();
   $('#titulodecausaiddesc').hide();
   $('#titulodecausaSaldodesc').hide();

   $('#titulodecausaSaldoAsc').show();


    $('#saldodesc').show();
    $('#saldoasc').hide();
  }
</script>



<script type="text/javascript">
  function funcionllamarcausascongeladas(){


      $.ajax({ 
        url:'consultaparacajadecausascongeladas.php',
        type:'POST',
        dateType:'html',
       

      })
   
    .done(function(resul){
      $('#divcausascongeladas').html(resul);
      
      })

    $('#divtodaslascausa').hide();
    $('#titulodetodascausas').hide();


    $('#titulodecausaiddesc').hide();

    ///$('#titulodetodascausas').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').hide();
   

} 
</script>

<!--FUNCIONES DE JQUERY PARA LLAMAR A LA CONSULTAS DE CAUSAS TERMINADAS -->

<script type="text/javascript">
  function funcionllamarcausasterminadas(){


      $.ajax({ 
        url:'consultaparacajadecausasterminadas.php',
        type:'POST',
        dateType:'html',
       

      })
   
    .done(function(resul){
      $('#divcausascongeladas').html(resul);
      
      })

    $('#divtodaslascausa').hide();
    $('#titulodetodascausas').hide();


    $('#titulodecausaiddesc').hide();

    //$('#titulodetodascausas').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').hide();
   

} 
</script>


<!--FUNCIONES DE JQUERY PARA LLAMAR A LA CONSULTAS DE CAUSAS ACTIVAS -->

<script type="text/javascript">
  function funcionllamarcausasActivas(){


      $.ajax({ 
        url:'consultaparacajadecausasactivas.php',
        type:'POST',
        dateType:'html',
       

      })
   
    .done(function(resul){
      $('#divcausascongeladas').html(resul);
      
      })

    $('#divtodaslascausa').hide();
    $('#titulodetodascausas').hide();

    $('#titulodecausaiddesc').hide();

    $('#titulodetodascausas').hide();
    $('#titulodecausaSaldoAsc').hide();

   $('#titulodecausaSaldodesc').hide();
   

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
    <form method="post">
    <div class="modal-body">
      <label><b>Se devolvera la cantidad de Bs. :<?php echo $filacont->cajacontador; ?>   </b></label><br><br>
     <br>
                                                        
      <input type="hidden" id="textidcaja" name="textidcaja" placeholder="codigo caja" value="1" required><br>

      <input type="hidden" class="form-control" id="textsaldoadm" name="textsaldoadm"  value="<?php echo $filacont->cajacontador;?>" required><br>

     



    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btndevolvercajacont" name="btndevolvercajacont" value="DEVOLVER">
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



<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>


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


<script type="text/javascript">
function validarFormTranferenciaCausa(formulariotrans) {

   if(formulariotrans.textmontotransferencia.value <=0) { //comprueba que no esté vacío
    formulariotrans.textmontotransferencia.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>


<script type="text/javascript">
function validarFormPrestamoexterno(formulariopres) {

   if(formulariopres.textmontoprestamo.value <=0) { //comprueba que no esté vacío
    formulariopres.textmontoprestamo.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>


<script type="text/javascript">
function validarFormDevolverPrestamo(formulariodevolpres) {

   if(formulariodevolpres.textmontodevolver.value <=0) { //comprueba que no esté vacío
    formulariodevolpres.textmontodevolver.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>
