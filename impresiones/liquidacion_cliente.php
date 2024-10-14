<?php
require('mc_table.php');
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsdeposito.php');
include_once('../model/clsdevoluciondinero.php');

function GenerateWord()
{
	//Get a random word
	$nb=rand(3,10);
	$w='';
	for($i=1;$i<=$nb;$i++)
		$w.=chr(rand(ord('a'),ord('m')));
	return $w;
}

function GenerateSentence()
{
	//Get a random sentence
	$variable="ESTA ES UNA COLUMNA ";
	$nb=rand(1,10);
	$s='';
	for($i=1;$i<=$nb;$i++)
		$s.=GenerateWord().' ';
	return substr($variable,0,-1);
}



$pdf=new PDF_MC_Table('L','mm','Legal');/*orientacion, medida, tamaño de la hoja*/
//$pdf->AliasNbPages(10000,20000);
$pdf->AliasNbPages();
//$pdf->SetMargins(10, 15 , 10);/*margenes*/
$pdf->AddPage();/*el tamaño de la hoja*/

$pdf->SetFont('Arial','',7);
//Table with 20 rows and 4 columns
//$pdf->SetWidths(array(30,35,30,35,14,30,30,12,120));/*DEFINE EL TAMAÑO DE CADA COLUMNA*/
//srand(microtime()*1000000);*/


  //  $pdf->SetFillColor(232,232,232);
    /*ENCABEZADO DE LA TABLA*/ 
  /*  $pdf->Cell(30,9,'CODIGO DE CAUSA ',1,0,'C',1);
	$pdf->Cell(35,9,'NOMBRE',1,0,'C',1);
	$pdf->Cell(30,9,'CLIENTE',1,0,'C',1);
	$pdf->Cell(35,9,'DIRECCION',1,0,'C',1);
	$pdf->Cell(14,9,'TELEFONO',1,0,'C',1);
	$pdf->Cell(30,9,'CORREO',1,0,'C',1);
	$pdf->Cell(30,9,'COORDENADAS',1,0,'C',1);
	$pdf->Cell(12,9,'SALDO',1,0,'C',1);
	
	$pdf->Cell(120,9,'OBSERVACIONES',1,1,'C',1);*/

/*SE CREA EL OBJETO DE LA CAUSA */
 /* $objcausa=new Causa();
  $resulcausa=$objcausa->mostrarInforme_1();
  while($row=mysqli_fetch_object($resulcausa))
  {
  	$pdf->Row(array($row->codigo,$row->nombrecausa,$row->clienteasig,$row->Dircliente,$row->Telfcli,$row->CorreoCli,$row->CoorCli,$row->caja,$row->Observ));
  }*/

ini_set('date.timezone','America/La_Paz');
$fechoyal=date("Y-m-d");
$horita=date("H:i");
$concat=$fechoyal.' '.$horita;
/*CODIGO PARA HACER LA FECHA LITERAL*/
  $fecha = substr($concat, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  $literal= $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
  /*----------------------------------------------*/
  $codigonuevo=$_GET['cod'];/*RECIBINOS EL CODIGO DE CAUSA*/
  /*FUNCION PARA MOSTRAR EL CLIENTE DE LA CAUSA*/
$objc=new Causa();
$resc=$objc->mostrarUnacausa($codigonuevo);
$fill=mysqli_fetch_object($resc);
$cliente=$fill->clienteasig;
$codigocausa=$fill->codigo;
/*..........................................*/


$pdf->SetFont('','',8);

        $pdf->Cell(0, 0, 'Santa Cruz: '.$literal, 0, 1, 'R', 0, '', 1);
        $pdf->Cell(0, 0, $subtitulo, 0, 1, 'C', 0, '', 0);
$pdf->Ln(5);

$pdf->Cell(0, 0,utf8_decode('Señor'), 0, 1, 'L', 0, '', 1);
$pdf->Ln(4);
$pdf->Cell(0, 0,utf8_decode($cliente.' (Cliente)'), 0, 1, 'L', 0, '', 0);
$pdf->Ln(4);
$pdf->Cell(0, 0, 'Presente.-', 0, 1, 'L', 0, '', 0);
$pdf->Ln(4);
$pdf->Cell(0, 0,'REF.-   INFORME DE AVANCE FINANCIERO ', 0, 1, 'L', 0, '', 0);
$pdf->Ln(4);
$pdf->Cell(0, 0,utf8_decode('Señor cliente,'), 0, 1, 'L', 0, '', 0);
$pdf->Ln(4);
$pdf->Cell(0, 0,utf8_decode('Mediante la presente adjunto informe del avance Financiero del proceso nominado con el código: '.$codigocausa.', que su persona tiene con nosotros.
'), 0, 1, 'L', 0, '', 0);
$pdf->Ln(5);

/*ENCABEZADA DE LA TABLA DE DETALLES DE LA CAUSA*/
$pdf->SetFont('','',12);
$pdf->Cell(0, 0, 'INFORME DE AVANCE FINANCIERO', 0, 1, 'C', 0, '', 1);
$pdf->Ln(4);
$pdf->SetFillColor(232,232,232);

  $pdf->SetFont('','',7);
    /*ENCABEZADO DE LA TABLA*/ 
  $pdf->Cell(60,9,'CODIGO',1,0,'C',1);
	$pdf->Cell(193,9,'NOMBRE DEL PROCESO',1,0,'C',1);
	
	$pdf->Cell(80,9,'CLIENTE',1,1,'C',1);

	$objcausa=new Causa();
  $resul=$objcausa->fichacausa($codigonuevo);
  $fil=mysqli_fetch_array($resul);
  $codigocausa=$fil['codigo'];
  $nombrecausa=$fil['nombrecausa'];
  $nombrecli=$fil['clienteasig'];
  $pdf->SetFillColor(255,255,255);
  $pdf->Cell(60,5,$codigocausa,1,0,'C',1);
	$pdf->Cell(193,5,utf8_decode($nombrecausa),1,0,'C',1);
	$pdf->Cell(80,5,$nombrecli,1,1,'C',1);
   $pdf->Ln(6);
/****************************************LISTADO DE INGRESOS (DEPOSITOS)*******************************/
$pdf->SetFont('','',12);
$pdf->Cell(0, 0, 'I.  INGRESOS (COSTOS PROCESALES). - Los ingresos que su persona ha realizado para ser apropiados a la Partida de Costos Procesales, son los siguientes:
', 0, 1, 'L', 0, '', 1);

$pdf->Ln(4);
$pdf->SetFillColor(232,232,232);

  $pdf->SetFont('','',7);
    /*ENCABEZADO DE LA TABLA*/ 
  $pdf->Cell(30,9,'FECHA',1,0,'C',1);
	$pdf->Cell(253,9,'DETALLE',1,0,'C',1);
	
	$pdf->Cell(50,9,'MONTO',1,1,'C',1);

	$pdf->SetFillColor(255,255,255);//color en rgb
	$totaldepositos=0;
$objdep=new Deposito();
$resuldep=$objdep->Listardepositodecausa($codigonuevo);
while ($fila=mysqli_fetch_array($resuldep)) 
   {
     
   $totaldepositos=$totaldepositos+$fila['monto_deposito'];
   $fechadeposito=$fila['fecha_deposito'];
   $detalledeposito=$fila['detalle_deposito'];
   $montodeposito=$fila['monto_deposito'];
   
   $pdf->Cell(30,5,$fechadeposito,1,0,'C',1);
	$pdf->Cell(253,5,utf8_decode($detalledeposito),1,0,'L',1);
	$pdf->Cell(50,5,$montodeposito,1,1,'R',1);
 }
 /*FILA DE TOTALES*/
 $totaldepositosFormato=number_format($totaldepositos, 2, '.', ' ');
 $pdf->Cell(283,5,'TOTAL INGRESOS',1,0,'C',1);
	$pdf->Cell(50,5,$totaldepositosFormato,1,1,'R',1);


/****************************************LISTADO DE ORDENES(GASTOS PROCESALES)************************/
$pdf->Ln(7);
$pdf->SetFont('','',12);
$pdf->Cell(0, 0, 'II.  EGRESOS (COSTOS PROCESALES). - Por su parte, los Costos Procesales realizados hasta la emision del presente informe, son los siguientes:', 0, 1, 'L', 0, '', 1);
$pdf->Ln(5);
$pdf->Cell(0, 0, 'EGRESOS POR COSTOS PROCESALES (Expresado en Bolivianos)', 0, 1, 'C', 0, '', 1);
$pdf->Ln(3);
$pdf->SetFont('','',8);


$pdf->SetFont('Arial','',7);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(20,20,22,22,79,112,15,23,23));/*DEFINE EL TAMAÑO DE CADA COLUMNA*/
srand(microtime()*1000000);

  $pdf->SetFillColor(232,232,232);
    /*ENCABEZADO DE LA TABLA*/ 
    $pdf->Cell(20,9,'# ORDEN',1,0,'C',1);
	$pdf->Cell(20,9,'PRIORIDAD',1,0,'C',1);
	$pdf->Cell(22,9,'INICIO',1,0,'C',1);
	$pdf->Cell(22,9,'FIN',1,0,'C',1);
	$pdf->Cell(79,9,'ORDEN GIRADA',1,0,'C',1);
	$pdf->Cell(112,9,'RESULTADO',1,0,'C',1);
	$pdf->Cell(15,9,'GASTOS',1,0,'C',1);
	$pdf->Cell(23,9,'PROCURADURIA',1,0,'C',1);
	
	$pdf->Cell(23,9,'TOTAL EGRESO',1,1,'C',1);

	/*****************COMIENZA EL LISTADO DE ORDENES**********/
$totalcostojudicial=0;
  $totalcostprocuradoria=0;
  $totalegreasotodasorden=0;
  $objorden=new OrdenGeneral();
  $resultor=$objorden->listarOrdenesLiquidacionParaClienteTEXT($codigonuevo);
  while ($filor=mysqli_fetch_array($resultor)) 
  {
  	if ($filor['estado_orden']!='Serrada') 
        {
          $backgroundfila='#d0f3bc';
        }
        else
        {
         $backgroundfila='white'; 
        }

		  $numOrden        = $filor['idorden'];      
		  $cargaInfo       = $filor['informacion'];
		  $descargaInfo    = $filor['detalle_informacion'];       
		  $fechaInicio     = $filor['Inicio'];
		  $fechaFin        = $filor['Fin'];    
		  $prioridadOrden  = $filor['prioridadcot'];
		         
		  $egresototalorden=0;

  if ($filor['validadofinal']=='Si') 
           {
             $costoproceventa=$filor['costo_procesal_venta'];         
           }
           else
           {
             $costoproceventa='??';        
           }

     if ($filor['estado_orden']=='Serrada') 
           {
             $costoventaprocuradoria=$filor['costo_procuradoria_venta'];
             $switchprocu='Confirmado';
           }
           else
           {
             /*$objcotiz=new Cotizacion();
             $resulcotiz=$objcotiz->mostrarcotizaciondeorden($filor['idorden']);
             $filcotiz=mysqli_fetch_array($resulcotiz);*/
             
             $costoventaprocuradoria=$filor['venta'].'  monto por confirmar';
             $switchprocu='Noconfirmado';

           }

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
             $egresototalorden=$egresototalorden+$filor['costo_procuradoria_venta'];
           }

           $CostoProcesal=$costoproceventa;
    $CostoProcuraduria=$costoventaprocuradoria;

           /*IF QUE PREGUNTA SI TODAVIA NO SE COLOCO EL COSTO JUDICIAL VENTA Y SI TODAVIA NO SE SERRO LA ORDEN*/
           if ($costoproceventa=='??' and $switchprocu=='Noconfirmado') 
           {
            $TotalEgresoOrden='??';
           }
        
        /*IF QUE PREGUNTA SI TODAVIA NO SE COLOCO EL COSTO JUDICIAL VENTA Y SI LA ORDEN YA ESTA SERRADA*/
           if ($costoproceventa=='??' and $switchprocu=='Confirmado') 
           {
             $egresototalordenConmensaje=$egresototalorden.' hasta ahora';
             $TotalEgresoOrden=$egresototalordenConmensaje;

             $totalegreasotodasorden=$totalegreasotodasorden+$egresototalorden;

             /*CALCULA EL SUBTOTAL DEL COSTO DE PROCURADORIA*/
             $totalcostprocuradoria=$totalcostprocuradoria+$filor['costo_procuradoria_venta'];
           }

            /*IF QUE PREGUNTA SI YA SE COLOCO EL COSTO JUDICIAL VENTA Y SI YA SE SERRO LA ORDEN*/
           if ($costoproceventa!='??' and $switchprocu=='Confirmado') 
           {
            $nuevoegresoorden=$filor['costo_procuradoria_venta']+$filor['costo_procesal_venta'];
            $TotalEgresoOrden=$nuevoegresoorden;
            $totalegreasotodasorden=$totalegreasotodasorden+$filor['costo_procuradoria_venta']+$filor['costo_procesal_venta'];

             /*CALCULA EL TOTAL DE COSTO DE PROCURADORIA DE TODAS LAS ORDENES*/
             $totalcostprocuradoria=$totalcostprocuradoria+$filor['costo_procuradoria_venta'];
             /*CALCULA EL TOTAL COSTO JUDICIAL DE TODAS LAS ORDENES*/
             $totalcostojudicial=$totalcostojudicial+$filor['costo_procesal_venta'];
           }

        $pdf->Row(array($numOrden,$prioridadOrden,$fechaInicio,$fechaFin,utf8_decode($cargaInfo),utf8_decode($descargaInfo),$CostoProcesal,$CostoProcuraduria,$TotalEgresoOrden));
   }/********FIN DEL WHILE QUE RECORRE TODAS LAS ORDENES DE UNA CAUSA*******************/
   $totalcostojudicialFormato= number_format($totalcostojudicial, 2, '.', ' ');
$totalcostprocuradoriaFormato=number_format($totalcostprocuradoria, 2, '.', ' ');
$totalegreasotodasordenFormato=number_format($totalegreasotodasorden, 2, '.', ' ');

$pdf->SetFillColor(255,255,255);
 $pdf->Cell(275,6,'TOTAL EGRESOS ',1,0,'C',1);
	$pdf->Cell(15,6,$totalcostojudicialFormato,1,0,'C',1);
	$pdf->Cell(23,6,$totalcostprocuradoriaFormato,1,0,'C',1);
	$pdf->Cell(23,6,$totalegreasotodasordenFormato,1,0,'C',1);
$pdf->Ln(14);

/***********************************LISTADO DE TRANFERENCIAS**************************************/
#Establecemos los márgenes izquierda, arriba y derecha:
//$pdf->SetMargins(34, 30 ,2.5);
$pdf->SetFont('','',12);
$pdf->Cell(0, 0, 'III.  EGRESOS E INGRESOS POR MOTIVO DE TRANFERENCIAS. - Tranferencia de dinero entre sus causas tanto de ingresos como de egresos', 0, 1, 'L', 0, '', 1);
$pdf->Ln(6);
$pdf->Cell(0, 0, 'TRANSFERENCIAS ENTRE SUS CAUSAS', 0, 1, 'C', 0, '', 1);
$pdf->Ln(4);
$pdf->SetFont('','',8);

  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(142,5,'TRANSFERECIA DE: (INGRESO) ',1,0,'C',1);
	$pdf->Cell(142,5,'TRANSFERECIA A: (EGRESO)',1,0,'C',1);
	$pdf->Cell(50,5,'MONTO',1,1,'C',1);
  $pdf->Ln(6);

  /*ENLISTA LAS TRANSFERENCIAS QUE LE HACEN A LA CAUSA (ES DECIR LOS INGRESOS QUE SE LE HACE A LA CAUSA)*/
  $pdf->SetFillColor(255,255,255);
        $objcausa2=new Causa();
        $resulcausa1=$objcausa2->mostrarDetallesTransferenciasRecibidasDeCausa($codigonuevo);
       // $totalingreso=0;
        $totalTranferenciasRecibidas=0;
        while ($filacausa=mysqli_fetch_array($resulcausa1))
        {
        	  

            $idorigeningreso=$filacausa['idorigendeposito'];

            $obcausa22=new Causa();
            $resultca=$obcausa22->mostrarUnacausa($idorigeningreso);
            $filacausaorigen=mysqli_fetch_array($resultca);
            $totalTranferenciasRecibidas=$totalTranferenciasRecibidas+$filacausa['monto_deposito'];

            $codcausaorigen=$filacausaorigen['codigo'];
             $montotrnrecibido=$filacausa['monto_deposito'];
            $pdf->Cell(142,5,$codcausaorigen,1,0,'C',1);
	          $pdf->Cell(142,5,' ',1,0,'C',1);
	          $pdf->Cell(50,5,$montotrnrecibido,1,1,'R',1);
        }/*FIN DEL WHILE QUE RECORRE LAS TRANSFERENCIAS RECIBIDAS*/

/***********************DESDE AQUI ENLISTAS LAS TRANSFERENCIAS QUE SE HACE A OTRA CAUSA ES DECIR (LOS EGRESOS DE LA CAUSA A OTRA CAUSA) ***************************/
        $totalTranferenciaEntregadas=0;
        $obcausasalida=new Causa();
        $resultcausasalida=$obcausasalida->mostrarDetallesTransferenciasEntregadasDeCausa($codigonuevo);
        while ($filacausasalida=mysqli_fetch_array($resultcausasalida))
        {
            $iddestinoingreso=$filacausasalida['id_causa'];

            $obcausa33=new Causa();
            $resultca=$obcausa33->mostrarUnacausa($iddestinoingreso);
            $filacausadestino=mysqli_fetch_array($resultca);
            $totalTranferenciaEntregadas=$totalTranferenciaEntregadas+$filacausasalida['monto_deposito'];

            $codcausadestino=$filacausadestino['codigo'];
            $montotrndestino=$filacausasalida['monto_deposito'];

            $pdf->Cell(142,5,'',1,0,'C',1);
	          $pdf->Cell(142,5,$codcausadestino,1,0,'C',1);
	          $pdf->Cell(50,5,$montotrndestino,1,1,'R',1);
        } /*FIN DEL WHILE QUE RRECORRE LAS TRANSFERENCIAS EMTREGADAS A OTRAS CAUSAS*/      

$pdf->Ln(10);

/************************LISTADO DE DEVOLUCIONES AL CLIENTE**********************************/
$pdf->SetFont('','',12);
$pdf->Cell(0, 0, 'IV. DEVOLUCIONES DEL RESTO DE DINERO EN TERMINO DE CAUSA. - Devolucion del monto sobrante de dinero tras el termino de causa', 0, 1, 'L', 0, '', 1);
$pdf->Ln(5);
$pdf->Cell(0, 0, 'DEVOLUCIONES AL CLIENTE', 0, 1, 'C', 0, '', 1);
$pdf->Ln(3);
$pdf->SetFont('','',8);
/*=====================ENCABEZADO========================================*/
$pdf->SetFillColor(232,232,232);
$pdf->Cell(284,5,'FECHA',1,0,'C',1);
$pdf->Cell(50,5,'MONTO',1,1,'R',1);

        $pdf->SetFillColor(255,255,255);
        $objdevolu=new DevolucionDinero();
        $resuldev=$objdevolu->listarLasDevolucionesdeCausa($codigonuevo);
        $totaldevuelto=0;
        while ($filadev=mysqli_fetch_array($resuldev))
        {
            $totaldevuelto=$totaldevuelto+$filadev['montodevolucion'];
     

				$fechadevolucion=$filadev['fechadevolucion'];
				$montodevol=$filadev['montodevolucion'];
				$pdf->Cell(284,5,$fechadevolucion,1,0,'C',1);
				$pdf->Cell(50,5,$montodevol,1,1,'R',1);

        }/*FIN DEL WHILE QUE RRECORE TODAS LAS DEVOLUCIONES*/
 /*TOTAL DEVOLUCIONES*/
$totaldevueltoFormato=number_format($totaldevuelto, 2, '.', ' ');
$pdf->Cell(284,5,'TOTAL DEVOLUCIONES',1,0,'C',1);
$pdf->Cell(50,5,$totaldevueltoFormato,1,1,'R',1);
$pdf->Ln(10);
/************************FIN DEL LISTADO DE DEVOLUCIONES AL CLIENTE**********************************/


/***********************TABLA DE RESUMEN TOTAL*****************************************/
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(130, 30 ,121.5);
$pdf->SetFont('','',12);
$pdf->Ln(1);
$pdf->SetFont('','',8);
$totalTranferenciasRecibidasFormato=number_format($totalTranferenciasRecibidas, 2, '.', ' ');
$totalTranferenciaEntregadasFormato=number_format($totalTranferenciaEntregadas, 2, '.', ' ');
$saldototal=$totaldepositos-$totalegreasotodasorden+$totalTranferenciasRecibidas-$totalTranferenciaEntregadas-$totaldevuelto;
$saldototalFormato=number_format($saldototal, 2, '.', ' ');

$pdf->Cell(90,8,'RESUMEN',1,1,'C',1);
$pdf->Cell(60,5,'TOTAL EGRESOS',1,0,'C',1);
$pdf->Cell(30,5,'-'.$totalegreasotodasordenFormato,1,1,'R',1);

$pdf->Cell(60,5,'TOTAL INGRESOS',1,0,'C',1);
$pdf->Cell(30,5,$totaldepositosFormato,1,1,'R',1);

$pdf->Cell(60,5,'TOTAL TRANSFERENCIA RECIBIDA',1,0,'C',1);
$pdf->Cell(30,5,$totalTranferenciasRecibidasFormato,1,1,'R',1);

$pdf->Cell(60,5,'TOTAL TRANSFERENCIA ENTREGADA',1,0,'C',1);
$pdf->Cell(30,5,'-'.$totalTranferenciaEntregadasFormato,1,1,'R',1);

$pdf->Cell(60,5,'TOTAL DEVUELTO AL CLIENTE',1,0,'C',1);
$pdf->Cell(30,5,'-'.$totaldevueltoFormato,1,1,'R',1);

$pdf->Cell(60,5,'SALDO',1,0,'C',1);
$pdf->Cell(30,5,$saldototalFormato,1,1,'R',1);

/**********************FIN DE LA TABLA RESUMEN TOTAL**************************************/
$pdf->Ln(10);
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 30 ,2.5);
$pdf->SetFont('','',10);

$pdf->Cell(0, 0, ' ', 0, 1, 'L', 0, '', 1);
$pdf->Cell(0, 0, 'Es por cuanto tenemos a bien informar.', 0, 1, 'L', 0, '', 1);
$pdf->Ln(10);
$pdf->Cell(0, 0,utf8_decode('LA ADMINISTRACIÓN'), 0, 1, 'C', 0, '', 1);






ob_end_clean(); //LIMPIA ESPACIOS EN BLANCO PARA NO GENERAR ERROREA
$pdf->Output();
?>
