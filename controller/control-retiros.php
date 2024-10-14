<?php
 
include_once('../model/clsretiros.php');

include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clscostofinal.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clscajasdesalida.php');
include_once('../model/clsdeposito.php');
include_once('../model/clscliente.php');


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


$objretiros=new Retiros();
$resultret=$objretiros->SumaDeRetiros();
$filret=mysqli_fetch_object($resultret);

        /*EL TOTAL EN EFECTIVO QUE TIENE LA CAJA DEL ADMINISTRADOR*/
         $totalencajaadm=0;
         $totalencajaadm=$totalsumaganacias+$totalgenerado+$totalsaldocausas+$filc->deudaexterna-($nuevototalcontador)-($filret->totalretirados);

/*FIN DEL CALCULO DE CAJA DEL ADMINISTRADOR*/


$ganaciasDisponibles=$totalsumaganacias-($filret->totalretirados);
    ///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
    ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     ////$concat es la fecha y hora del sistema
     $concat=$fechoyal.' '.$horita;
   
	$objret=new Retiros();
	$retiro=$_POST['montoret'].'.'.$_POST['decret'];

	$saldorestante=$totalencajaadm-$retiro;
	$objret->setmontoretiro($retiro);
	$objret->setmontosobrante($saldorestante);
	$objret->setfecharetiro($concat);
	$objret->setdetalleretiro($_POST['detalleret']);
	$objret->setmontototalcaja($totalencajaadm);
  $objret->setid_usuarioret($_POST['textidusu']);

if ($retiro>0) 
{
  

     if ($retiro<=$ganaciasDisponibles) 
     {
        if ($objret->guardarretiro()) 
          {
            echo 1;
          }
          else
          {
            echo 0;
          }
     }
     else
     {
       echo 3;
     }
	
}
else
{
  echo 4;
}

?>