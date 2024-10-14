<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR MAESTRO*/
if(!isset($_SESSION["procuradormaestro"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procuradormaestro"];
$_SESSION['idprocurador1']=0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pago Procuradoria</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
</head>
<body>
<?php

include_once('../model/clsprocurador.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clscostofinal.php');
include_once('../model/clspagoprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clscajasdesalida.php');


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
        
       <div id="main_menu_admin">
            <ul>
               
                <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador Maestro</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="pm_mis_causa.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
  



    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
               
                
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->


    <!--tabal  de costos -->
    <div class="container">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">PAGO A PROCURADORES</h3><br>
    <form method="post">
    
    <table id="customers">
        <thead>
           
        </thead>
        <tbody>
        <tr>
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="fechinicio" required=""> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Inicio  <input type="time" name="horainico" required=""> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                  
                 </tr>

                  <tr>
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="fechafin" required=""> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Final <input type="time" name="horafin" required=""> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                 
                 </tr>

        
            
        </tbody>
    </table>

    <select name="selectprocu" id="selectprocu" required="required">
        <option>ORDENAR POR PROCURADOR</option>
        <?php 
              $objmat=new Procurador();
              $liscat=$objmat->listarprocurador();
              while($cat=mysqli_fetch_array($liscat)){
                echo '<option value="'.$cat['id_procurador'].'">'.$cat['apellidoproc'].', '.$cat['nombreproc'].'</option>'; 
          //antiguo   echo '<option value="'.$cat['id_procurador'].'">'.$cat['nombreproc'].' '.$cat['apellidoproc'].'--'.$cat['tipoproc'].'</option>';
              }
            ?> 
        
    </select>
 

    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                <ul>
                    <li><button type="submit" name="btnconsultar" class="botones">CONSULTAR</button></li>
                    <li><button style="width: 200px;" class="botones" type="button" onclick="window.open('impresiones/pdf/consulta_pago.php')">IMPRIMIR CONSULTA</button></li>
                    
                   
                </ul>
                
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
  

  
    <table id="customers" style="width: 70%">
        <thead>
           <tr >
               <th width="15%">CODIGO DEL PROCESO</th>
               <th width="5%">NUMERO DE ORDEN</th>
               <th width="5%">PRIORIDAD</th>
               <th width="10%">PLAZO DE VIGENCIA DE LA ORDEN</th>
               <th width="10%">COTIZACIÓN POSITIVA DE PROCURADURÍA</th>
               <th width="10%">COTIZACIÓN NEGATIVA DE PROCURADURÍA (PENALIDAD) </th>
               <th width="15%">MONTO A PAGAR</th>
           </tr> 
        </thead>
        <tbody>
       
         <?php
         $arraydeordenparapagar=array();
          error_reporting(E_ERROR);
   if (isset($_POST['btnconsultar'])) {
       
     $_SESSION['arraysesion']=array();
     $_SESSION['montopago']=0;
     $_SESSION['fechapago1']="";
     $_SESSION['fechapago2']="";
     $_SESSION['idprocurador']=$_POST['selectprocu'];

    $fechini1=$_POST['fechinicio'];
    $newfechini1=date_create($fechini1);
    $fechainiformato=date_format($newfechini1, 'Y-m-d');

    $horaini=$_POST['horainico'];
    $newhoraini=date_create($horaini);
    $horainiformato=date_format($newhoraini, 'H:i');
    $fechainicompleta=$fechainiformato.' '.$horainiformato;
    
    $_SESSION['fechapago1']=$fechainicompleta;

     $fechfin=$_POST['fechafin'];
    $newfechfin1=date_create($fechfin);
    $fechafinformato=date_format($newfechfin1, 'Y-m-d');

    $horafinn=$_POST['horafin'];
    $newhorafin=date_create($horafinn);
    $horafinformato=date_format($newhorafin, 'H:i');

    $fechafincompleta=$fechafinformato.' '.$horafinformato;

    $_SESSION['fechapago2']=$fechafincompleta;
    $contador=0;
    $montoapagar=0;
    $objorden=new OrdenGeneral();
    $result=$objorden->consultaparapagoaprocurador($_POST['selectprocu']);
    
    $_SESSION['idprocurador1']=$_POST['selectprocu'];
    
    while($fila=mysqli_fetch_object($result))
    {
        if ($fila->fecha_cierre>=$fechainicompleta and $fila->fecha_cierre<=$fechafincompleta) 
        {
           $contador++;
           array_push($_SESSION['arraysesion'], $fila->codorden);
            echo "<tr>";
           echo "<td>$fila->codigocausa</td>";
           echo "<td>$fila->codorden</td>";
           echo "<td>$fila->priori</td>";
           switch ($fila->condicion) 
           {
             case 1:echo "<td>mas de 96</td>"; break;
             case 2:echo "<td>24 a 96</td>"; break;
             case 3:echo "<td>8 a 24</td>"; break;
             case 4:echo "<td>3 a 8</td>"; break;
             case 5:echo "<td>1 a 3</td>"; break;
             case 6:echo "<td>0 a 1</td>"; break;
           }
          // echo "<td>$fila->condicion</td>";
           echo "<td>$fila->cotcompra</td>";
           echo "<td>$fila->cotpenalidad</td>";
           if ($fila->compraprocu==0) {
            $montoapagar=$fila->penalidadproc+$montoapagar;
             echo "<td>$fila->penalidadproc</td>";
           }
           else{
            $montoapagar=$fila->compraprocu+$montoapagar;
            echo "<td>$fila->compraprocu</td>";
           }
           
           echo "</tr>";
        }
    }
    $_SESSION['montopago']=$montoapagar;
    echo $arraydeordenparapagar[5];
  // $idproc=1;
   $objprocu=new Procurador();
   $list=$objprocu->mostrarunprocuradro($_POST['selectprocu']);
   $fi=mysqli_fetch_object($list);
   $nombreprocurador=$fi->Nombre;


   /* $id=1;
      $fechacomun=$fechini1.' '.$horaini;
      $fechainicompleta1='2019-03-22 17:40'; 
       $oborden=new OrdenGeneral();
       $lista=$oborden->consultaparapagoaprocurador($fechacomun,$id);
       while($fil=mysqli_fetch_object($lista))
       {  
           echo "<tr>";
           echo "<td>$fil->codigocausa</td>";
           echo "<td>$fil->codorden</td>";
           echo "<td>$fil->priori</td>";
           echo "<td>$fil->condicion</td>";
           echo "<td>$fil->cotcompra</td>";
           echo "<td>$fil->cotpenalidad</td>";
           echo "<td>$fil->compraprocu</td>";
           echo "</tr>";
       }*/
       echo "Procurador :<b>".$nombreprocurador;echo "</b><br>";
       echo " Fecha Inicio De La Consulta :<b>".$fechainicompleta; echo "</b><br>";
       echo "Fecha Final De La Consulta :<b>".$fechafincompleta."</b>";
   }/*fin de la funcion al presionar el boton consultar*/

   


   /*FUNCION AL DARLE CLICK AL BOTON APLICAR PAGO*/
   
    ?>


        <tr>
            <td colspan="6">TOTAL A PAGAR EN ESE RANGO DE TIEMPO</td>
            <td style="text-align: right; font-size: 30px;" ><?php echo $montoapagar; ?></td>
        </tr>
            
        </tbody>
    </table>

 </form> 
   

    
  
 <?php


  
     /*FUNCIONES PARA HACER EL TOTAL DE LA CAJA DEL ADMINISTRADOR*/
     /*SUMA DE TODAS LAS CAUSAS*/
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaysaldo();
        $totalsaldocausas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausas=$totalsaldocausas+$fila->caja;
         // echo "<tr>"; 
         // echo "<td>$fila->codigo</td>";
         // echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
         // echo "<td style='text-align: right;'>$fila->caja</td>";
         // echo "</tr>";
        }

/*ESTAS FUNCIONES SON PARA HACER LA SUMA DE LA CAJA DEL CONTADOR ///////////////////////////////////////////*/
/*MUESTRA TODO EL PRESUPUESTO ENTREGADO POR EL CONTAOR*/
         $objpre=new Presupuesto();
         $totalentregado=0;
         $lis=$objpre->mostrarpresupuestosentregados();
         while ($filap=mysqli_fetch_object($lis)) {
              $totalentregado=$filap->monto_presupuesto+$totalentregado;
          }

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

        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado+($totalpresugastadoconfir);


        /*NUEVO CODIGO PARA EL TOTAL DEL CONTADOR*/
           /*ESTA FUNCION DEVUELVE EL SALDO DE LAS DESCARGAS QUE NO TIENEN COSTO FINAL, Y POR LO TANTO PUEDEN AFECTAR A LA CAJA DEL CONTADOR , OSEA SI EL RESULTADO DE LA CONSULTA ES POSITIVO SE VUELVE NEGATIVO Y VICEVERSA, ESTO PARA NO AFECTAR A LA CAJA DEL CONTADOR*/
           $saldocuadrar=0;
           $objorden=new OrdenGeneral();
           $resultado1=$objorden->mostrarsaldosOrdenesNoserradas();
           $fila1=mysqli_fetch_object($resultado1);
          /*CONVERCION DEL SALDO */
          $saldocuadrar=$fila1->saldito*(-1);
           


           $nuevototalcontador=$tododelcontador+($saldocuadrar);
/*//////////////////////////////HASTA AQUI LAS SUMAS PARA LA CAJA DEL CONTADOR/////////////////////////////////////*/
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

         $saldoapagarprocuradoria=$totalgenerado+$totalpenalidades;


         /*FUNCION PARA MOSTRAR DEUDA EXTERNA*/
         $obcajas=new Cajasdesalida();
        $lista=$obcajas->mostrardeudaexterna();
        $filc=mysqli_fetch_object($lista);
        //$filc->deudaexterna

        /*SUMA DE GANANCIAS /////////////////////////////////////////////*/
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
        

        ////////////ES EL MONTO DE DINERO QUE LE RESTAMOS A LOS PROCURADORES EN PENALIDAD/////////
        $positivopenalidad=$totalentregadopenalidad*(-1);

        $totalsumaganacias=$filag->GananciaProcuradoria+$filaproce->GananciaProcesal+$positivopenalidad;


        /*EL TOTAL EN EFECTIVO QUE TIENE LA CAJA DEL ADMINISTRADOR*/
         $totalencajaadm=0;
         $totalencajaadm=$totalsumaganacias+$totalgenerado+$totalsaldocausas+$filc->deudaexterna-($nuevototalcontador);

/*FIN DEL CALCULO DE CAJA DEL ADMINISTRADOR*/

      



 /*FUNCIONES QUE SE EJECUTAN AL PRESIONAR EL BOTON APLICAR PAGO, INSERTA EL PAGO A LOS PROCURADORES*/
if (isset($_POST['btnaplicarpago'])) 
   {
     if ($totalencajaadm>$_SESSION['montopago'])/*PREGUNTA QUE LA CAJA DEL ADMINISTRADOR SEA MAYOR AL PAGO DE PROCURADOR*/ 
     {
       
      /*if (count($_SESSION['arraysesion'])>0) 
       {
          
          $nuevoarray=$_SESSION['arraysesion'];
         // echo $nuevoarray[2]; 
          echo "<br>";
          echo count($_SESSION['arraysesion']); echo "<br>";
          echo $_SESSION['fechapago1'];  echo "<br>";
          echo $_SESSION['fechapago2'];  echo "<br>";
          echo $_SESSION['montopago'];  echo "<br>";
          echo $_SESSION['idprocurador'];  echo "<br>";
          $contador1=0;
          $contadorarray=count($nuevoarray);
          while ($contador1<$contadorarray) 
            {
               $idorden=$nuevoarray[$contador1];
               $objcostfinal=new Costofinal();
               $objcostfinal->setcanceladoprocurador('Si');
               $objcostfinal->modificarelCanceladoProcurador($idorden);



               $contador1++;
            }/*FIN DEL WHILE QUE CAMBIA EL ESTADOR DEL COSTOFINAL A CANCELADO=SI*/
    /*         ini_set('date.timezone','America/La_Paz');
             $fechoyal=date("Y-m-d");
             $horita=date("H:i");
             $concat=$fechoyal.' '.$horita;
            $objepagoprocurador=new PagoProcurador();
            $objepagoprocurador->setfechapago($concat);
            $objepagoprocurador->setmontopago($_SESSION['montopago']);
            $objepagoprocurador->setfechainiconsulta($_SESSION['fechapago1']);
            $objepagoprocurador->setfechafinconsulta($_SESSION['fechapago2']);
            $objepagoprocurador->setidprocurador($_SESSION['idprocurador']);

              if ($objepagoprocurador->guardarpagoprocurador()) 
              {
                 echo "<script > setTimeout(function(){ }, 1000); swal('EXELENTE','Se registro El Pago ','success'); </script>";
              }
              else
              {
                echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se registro el pago','warning'); </script>";
              }
        
          $_SESSION['arraysesion']=null;
       }
       else
       {
         echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No hay datos de la consulta','warning'); </script>";
       }*/

    }/*FIN DEL IF QUE PREGUNTA SI LA CAJ DEL ADMIN ES MAYOR AL PAGO*/ 
    else/*por falso mostrara un mensaje didiendo que no tiene saldo suficiente para pagar al procurador*/
    {
     echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No tiene saldo suficiente para pagar al procurador','warning'); </script>";
    } /*fin del else que muestra mensaje didicendo que no tiene saldo*/    
       
   }/**/
   
 ?>
</div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
   /* $(function() {
  var f = function() {
    $(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
  };
  $('input').change(f).trigger('change');
});*/
</script>
