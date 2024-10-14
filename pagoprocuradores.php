<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["useradmin"]))
{
  header("location:index.php");
}
$datos=$_SESSION["useradmin"];
$_SESSION['idprocurador1']=0;
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pago Procuradoria</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <!--jquery -->
   <!-- <script type="text/javascript" src="resources/jquery.min.js"></script>-->
</head>
<body>
<?php

include_once('model/clsprocurador.php');
include_once('model/clsordengeneral.php');
include_once('model/clscostofinal.php');
include_once('model/clspagoprocurador.php');
include_once('model/clscausa.php');
include_once('model/clspresupuesto.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsusuario.php');

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
                    <li><button class="botones" onclick="location.href='resumen_pagos.php'">RESUMEN PAGOS</button></li>
                    
                </ul>
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

    <select name="selectprocu" id="selectprocu" onchange="funcionllevaidproc(this);">
        <option>ORDENAR POR PROCURADOR</option>
        <?php 
              $objmat=new Procurador();
              $liscat=$objmat->listarprocurador();
              while($cat=mysqli_fetch_array($liscat)){
               echo '<option value="'.$cat['id_procurador'].'">'.$cat['apellidoproc'].', '.$cat['nombreproc'].'</option>'; 
             //antiguo echo '<option value="'.$cat['id_procurador'].'">'.$cat['nombreproc'].' '.$cat['apellidoproc'].'--'.$cat['tipoproc'].'</option>';
              }
            ?> 
        
    </select>

    <br>
    <br>
    
    <table id="customers">
        <thead>
           
        </thead>
        <tbody>
        <tr>
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="" > <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Inicio  <input type="time" name="" > <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                  
                 </tr>

                  <tr>
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="" > <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Final <input type="time" name="" > <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                 
        </tr>

        
            
        </tbody>
    </table>

    <div id="divfechas">
     
   </div>
   

   
    
 

    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                <ul>
                    <li><button type="submit" name="btnconsultar" class="botones">CONSULTAR</button></li>
                    <li><button style="width: 200px;" type="button" class="botones" onclick="window.open('impresiones/tcpdf/pdf/consulta_pago.php')">IMPRIMIR CONSULTA</button></li>
                    
                   
                </ul>
                
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
 <?php 
/*$obfechpago=new PagoProcurador();
$resulfech=$obfechpago->mostrarUnPago(1);
$filfecha=mysqli_fetch_object($resulfech);
$fecha=date_create($filfecha->fechapago);
$fechaformat=date_format($fecha, 'Y-m-d');
echo $fechaformat;

$hora=date_create($filfecha->fechapago);
$horaformat=date_format($hora, 'H:i');

echo $horaformat;*/
?>
  <br><br>
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

       $_SESSION['mensajepago']=" \n";
       /*esta variable guardara el detalle del pago*/
       $_SESSION['detallepago']="";
       
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
    
    $_SESSION['mensajepago'].="Fecha Inicio De Consulta: $fechainicompleta \n";
    $_SESSION['mensajepago'].="Fecha Final De Consulta: $fechafincompleta \n";
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
             $montopagadodeorden=$fila->penalidadproc;
           }
           else{
            $montoapagar=$fila->compraprocu+$montoapagar;
            echo "<td>$fila->compraprocu</td>";
            $montopagadodeorden=$fila->compraprocu;
           }
           
           echo "</tr>";
           
           $causacodigo=$fila->codigocausa;
           $codigoorden=$fila->codorden;
         //  $_SESSION['detallepago'].=" Causa $causacodigo || # de Orden $codigoorden || Pago Asignado por la orden || Bs. $montopagadodeorden \n";
           $_SESSION['detallepago'].="<tr>
                                        <td>$causacodigo</td>
                                        <td>$codigoorden</td>
                                        <td>$montopagadodeorden</td>
                                      </tr>";
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
       $_SESSION['mensajepago'].="Monto Total Pagado Bs.: $montoapagar \n";
       $_SESSION['mensajepago'].="\n";
       $_SESSION['mensajepago'].="El detalle del monto pagado es el siguiente:\n";
       $_SESSION['mensajepago'].=$_SESSION['detallepago'];
       
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
   if ($contador>0) {
     echo '<form method="post"> <input type="submit" name="btnaplicarpago" value="APLICAR PAGO"></form>';
   }
   ?>

    <script type="text/javascript">
   function llamaArchivoEnviaCorreoPagoProcurador(idprocu)
      {
        var formDataReg = new FormData(); 
        var fechainicio=$('#textfechaini').val();
        var fechafin=$('#textfechafin').val(); 
        var tabladetalle=$('#texttabla').val();
        var montopagado=$('#textmontopago').val();
        var idprocu=idprocu;
      
     formDataReg.append('fechainicio',fechainicio);
     formDataReg.append('fechafin',fechafin);
     formDataReg.append('tabladetalle',tabladetalle);
     formDataReg.append('montopagado',montopagado);
     formDataReg.append('idprocu',idprocu);
      $.ajax({ url: 'controller/control-enviaCorreoPagoProcurador.php', 
               type: 'post', 
               data: formDataReg, 
               contentType: false, 
               processData: false, 
               success: function(response){
               console.info(response); 
                /*if (response==1) 
                {}*/ 
               // alert(response);

            }
            });
      }//fin de funcion lama archivo envia correo
</script>
  
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
        
       
      if (count($_SESSION['arraysesion'])>0) 
       {
          
          $nuevoarray=$_SESSION['arraysesion'];
         // echo $nuevoarray[2]; 
        //  echo "<br>";
        
        //  echo count($_SESSION['arraysesion']); 

           $_SESSION['fechapago1'];  
           $_SESSION['fechapago2'];  
           $_SESSION['montopago'];  
           $_SESSION['idprocurador'];

          $contador1=0;
          $contadorExito=0;
          $todasOrdenesPagadas="";
          $contadorarray=count($nuevoarray);
          while ($contador1<$contadorarray) 
            {
               $idorden=$nuevoarray[$contador1];
               $objcostfinal=new Costofinal();
               $objcostfinal->setcanceladoprocurador('Si');
               if($objcostfinal->modificarelCanceladoProcurador($idorden))
               {
                 $contadorExito++;
                  //if que pregunta si el valor ya existe en la cadena
                   if ( (strrpos($todasOrdenesPagadas, $idorden))===false ) 
                   {                    
                      $todasOrdenesPagadas=$todasOrdenesPagadas.$idorden.",";
                   }
               }

               $contador1++;
            }/*FIN DEL WHILE QUE CAMBIA EL ESTADOR DEL COSTOFINAL A CANCELADO=SI*/
            
            //verifica que todas las ordenes se hayan registrado el cancelado=si
            if ($contadorExito==$contadorarray) 
            {
                       
             ini_set('date.timezone','America/La_Paz');
             $fechoyal=date("Y-m-d");
             $horita=date("H:i");
             $concat=$fechoyal.' '.$horita;
            $objepagoprocurador=new PagoProcurador();
            $objepagoprocurador->setfechapago($concat);
            $objepagoprocurador->setmontopago($_SESSION['montopago']);
            $objepagoprocurador->setfechainiconsulta($_SESSION['fechapago1']);
            $objepagoprocurador->setfechafinconsulta($_SESSION['fechapago2']);
            $objepagoprocurador->setidprocurador($_SESSION['idprocurador']);
            $objepagoprocurador->setOrdenesCanceladas($todasOrdenesPagadas);

              if ($objepagoprocurador->guardarpagoprocurador()) 
              {
                  /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
               /* $objproc1=new Procurador();
                $resulproc=$objproc1->mostrarunProcurador1($_SESSION['idprocurador']);
                $filproc=mysqli_fetch_object($resulproc);
                $destino=$filproc->correoproc;*/

                 /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
                    /*$cabeceras = 'From: SERRATE <sistema@serrate.com.bo>' . "\r\n" .
                        'Reply-To: sistema@serrate.com.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();*/
                         /*PONEMOS EL ASUNTO DEL CORREO*/
                   /* $asunto="RECIBO DE “PAGO DE PROCURADURÍA” $concat";*/
                    /*CREAMOS EL MENSAJE DEL CORREO*/
                   /* $mensaje="Se le asigno nueva Causa: no es de prueba \n";
                    $mensaje .="Codigo: $codigocausa \n";
                    $mensaje .="Conclucion: nos vemos";*/
                   /* $_SESSION['mensajepago'].="Att. El Sistema";
                    mail($destino,$asunto,$_SESSION['mensajepago'],$cabeceras);*/
                    
                    /*EL EL CORREO COPIA PARA LA EMPRESA*/
                    //$procuradorpagado=$filproc->nombreproc.' '.$filproc->apellidoproc;
                  /*  $objuser=new Usuario();
                     $resultuser=$objuser->MostrarUserAdmin();
                     $filuser=mysqli_fetch_object($resultuser);
                     $correoadmin=$filuser->correousuario;
                    $destinocopia=$correoadmin;
                    $asuntocopia="RECIBO DE “PAGO DE PROCURADURÍA” $concat (Copia)";*/
                   // $_SESSION['mensajepago'].="Pagado Al Procurador: $procuradorpagado";
                   /* mail($destinocopia,$asuntocopia,$_SESSION['mensajepago'],$cabeceras);*/

                   $tabladetalle=$_SESSION['detallepago'];
                   $fechaini=$_SESSION['fechapago1'];
                   $fechafin=$_SESSION['fechapago2'];
                   $montopago=$_SESSION['montopago'];
                   $idprocurador=$_SESSION['idprocurador'];
                     echo "<input type='hidden' name='texttabla' id='texttabla' value='$tabladetalle' >
                           <input type='hidden' name='textfechaini' id='textfechaini' value='$fechaini' >
                           <input type='hidden' name='textfechafin' id='textfechafin' value='$fechafin' >
                           <input type='hidden' name='textmontopago' id='textmontopago' value='$montopago' >
                     <script >
                          llamaArchivoEnviaCorreoPagoProcurador($idprocurador);
                     </script>";

                //obtiene el codigo del pago para poder imprimir
                $resultcodpago=$objepagoprocurador->obtenerUltimoPagoDeProcDeFecha($_SESSION['idprocurador'],$fechoyal);
                $filidpago=mysqli_fetch_object($resultcodpago);
                $idpago=$filidpago->id_pago;
                 echo "<script > 
                     var linkrep='impresiones/tcpdf/pdf/pago_procurador.php?pago=$idpago';
                     setTimeout(function(){ abrirNuevoTab(linkrep); }, 1000); 
                          swal('EXELENTE','Se registro El Pago ','success');
                  
                  </script>";
              }
              else
              {
                echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se registro el pago, pero se modificaron registros de las ordenes $todasOrdenesPagadas Comuniquese con el area de sistemas y no haga nada ','warning'); </script>";
              }

             }//fin del if que verifica si se guardaron los registros de cancelado de la orden
            else
            {
                echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se registro el pago, cantidad de Ordenes afectadas: $contadorExito de un total de $contadorarray','warning'); </script>";

            }//fin del else cuando el contadorExito no es igual al contadorarray  
        
          $_SESSION['arraysesion']=null;
       }//fin del if que verifica si el array tiene datos
       else
       {
         echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No hay datos de la consulta','warning'); </script>";
       }

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
<script type="text/javascript" src="resources/jquery.js"></script>
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


<script type="text/javascript">
  function funcionllevaidproc(obj){

    var dato= obj.options[obj.selectedIndex].value; 
  if (dato>0) 
    {
      $.ajax({ 
        url:'consultaultimafechapago.php',
        type:'POST',
        dateType:'html',
        data:{dato:dato},

      })
   
    .done(function(resul){
      $('#divfechas').html(resul);
      
      })

    $('#customers').hide();
   }

}



      function abrirNuevoTab(url) {
        // Abrir nuevo tab
        var win = window.open(url, '_blank');
        // Cambiar el foco al nuevo tab (punto opcional)
        win.focus();
      }
     // $('#open').click(function(){
       // abrirNuevoTab('https://programacionextrema.com')
      //})

</script>