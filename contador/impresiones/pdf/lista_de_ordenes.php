<?php

session_start();
if(!isset($_SESSION["contador"]))
{
  header("location:../../../index.php");
}
$datos=$_SESSION["contador"];

require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');
include_once('../../../model/clsordengeneral.php');
include_once('../../../model/clspresupuesto.php'); 
include_once('../../../model/clsdescarga_procurador.php'); 


class PDF extends TCPDF
{
   //Cabecera de página
   function Header()
   {

      $this->Image('images/logoserrate3.jpg',30,3, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);

     // $this->SetFont('','B',12);

     // $this->Cell(30,10,'Title',1,0,'C');
    
   }

   function Footer()
   {


    
	$this->SetY(-10);

	$this->SetFont('','I',8);
   // $this->Image('images/footer3.png',120,200,'', 10, '', '', '', false, 300, '', false, false, 0, false,false,false);
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/'.$this->getAliasNbPages(),0,0,'C');
   }
}




$pdf = new PDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);/*PARA HOJA TAMAÑO LEGAL SE PONE LEGAL EN MAYUSCULA*/


$pdf->startPageGroup();
$pdf->AddPage();
$pdf->SetFont('','',10);
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(34, 30 ,2.5);
#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,10);

/*===============================================================
TAMAÑO TOTAL DE LA HOJA OFICIO ECHADA(ORIZONTAL)=905px DISPONIBLE PARA OCUPAR CON DATOS, RESPETANDO LOSMARGENES ESTABLECIDOS POR CODIGO EN LA FUNCION ->SetMargins(34, 30 ,2.5)
/*===============================================================*/
 $codcausa=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

$objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    $codigocausa=$fil->codigo;
        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);
        
        $pdf->Cell(250, 0, '                                                                                       LISTA DE ORDENES DE LA CAUSA: '.$codigocausa, 0, 0, 'C', 0, '', 0);


        $pdf->Cell(85, 0, '', 0, 1, 'R', 0, '', 1);
        $pdf->Cell(0, 0, $subtitulo, 0, 1, 'C', 0, '', 0);
$pdf->Ln(5);


$pdf->SetFont('','',8);
/*===============================================================
CABECERA DE LA TABLA
/*===============================================================*/
$bloque1=<<<EOF

<table border="0.1px">
	<thead>
	   <tr>
		<th style="text-align:center;  width:100px; background-color:#e8e8e8;"># DE ORDEN</th>
		<th style="text-align:center;  width:100px; background-color:#e8e8e8;">COSTO PROCESAL <p style="font-size:7px;"> (MONTO ENTREGADO) </p></th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">COSTO PROCESAL <p style="font-size:7px;"> (MONTO GASTADO)</p> </th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">COSTO PROCESAL <p style="font-size:7px;"> (SALDO POR DEVOLVER)</p> </th>
		<th style="text-align:center;  width:125px;  background-color:#e8e8e8;">PROCURADOR <p style="font-size:7px;"> (GESTOR)</p> </th>
		<th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE GIRO DE LA ORDEN</th>
    <th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE PRESUPUESTO</th>
    <th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE ENTREGA DE DINERO</th>
    <th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE DESCARGA</th>
    <th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE INICIO DE VIGENCIA</th>
    <th style="text-align:center;  width:70px; background-color:#e8e8e8;">FECHA DE TERMINO DE VIGENCIA</th>
		</tr>
	</thead>

	

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');







 ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita; 

   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesdeunacausa($codigonuevo);
   while ($fil=mysqli_fetch_array($resul)) 
   {

    /*PARA EL COLOR A LAS FILAS DEPENDIENDO DE SU URGENCIA*/
      if ($fil['estado_orden']=='Serrada')/*PREGUNTA SI ESTA SERRADA LA ORDEN*/ 
      {
       $backgroundfila='white'; 
       $fontcolor='#000000';
      }
      else/*POR FALSO*/
      {


          $fechafinorden=$fil['fin'];
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

 //      echo "<tr style='background: $backgroundfila; color:$fontcolor;'>";
            //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->codigo*10987654321;
             $encriptado=base64_encode($mascara);
             if ($fil['Inicio']<=$concat) 
             {
      //         echo "<td class='tdcod'><a style='color:$fontcolor;' href='contador_orden.php?squart=$encriptado'>$fil->codigo</a></td>";
      $numeroOrden=$fil['codigo'];
             }
             else
             {
      //        echo "<td class='tdcod'>*<a style='color:$fontcolor;' href='contador_orden.php?squart=$encriptado'>$fil->codigo</a></td>";
      $numeroOrden="*".$fil['codigo'];
             }
 
              

              $objpre=new Presupuesto();
              $lis=$objpre->mostrarUnpresupuestoEntregadoDeorden($fil['codigo']);
              $filap=mysqli_fetch_array($lis);

      //        echo "<td>$filap->monto_presupuesto</td>";
      $montoPresupuestado=$filap['monto_presupuesto'];

              $objdescar=new DescargaProcurador();
              $list=$objdescar->mostrardescargaorden($fil['codigo']);
              $filades=mysqli_fetch_array($list);

      //        echo "<td>$filades->gastos</td>";//no hay ni en la consulta
      $montoGastado=$filades['gastos'];
      //        echo "<td>$filades->saldo</td>";//no hay ni en la consulta
      $saldoDescarga=$filades['saldo'];
      //        echo "<td>$fil->procuradorasig</td>";
      $procuradorAsignado=$fil['procuradorasig'];

      //        echo "<td>$fil->fecha_giro</td>";
      $FechaGiro=$fil['fecha_giro'];
              $objpresup=new Presupuesto();
              $listado=$objpresup->mostrarfechaspresupuestoyentrega($fil['codigo']);
              $filapres=mysqli_fetch_array($listado);

      //       echo "<td>$filapres->fecha_presupuesto</td>";
      $FechaPresupuesto=$filapres['fecha_presupuesto'];
      //        echo "<td>$filapres->fecha_entrega</td>";
      $FechaentregaPresupuesto=$filapres['fecha_entrega'];

              $objdesc=new DescargaProcurador();
              $resultado=$objdesc->mostrarfechadescarga($fil['codigo']);
              $filafe=mysqli_fetch_array($resultado);

      //         echo "<td>$filafe->fecha_descarga</td>";
      $FechaDescarga=$filafe['fecha_descarga'];
      //         echo "<td>$fil['Inicio']</td>";
      $FechaInicio=$fil['Inicio'];
      //        echo "<td>$fil['fin']</td>";
      $FechaFin=$fil['fin'];
      //  echo "</tr>";

$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; background-color: $backgroundfila; color:$fontcolor;" nobr="true">
   <th style="text-align:center; width:100px;">$numeroOrden</th>
   <th style="text-align:center; width:100px;">$montoPresupuestado</th>
   <th style="text-align:center; width:80px;">$montoGastado</th>
   <th style="text-align:center; width:80px;">$saldoDescarga</th>
   <th style="text-align:center; width:125px;">$procuradorAsignado</th>
   <th style="text-align:center; width:70px;">$FechaGiro</th>
   <th style="text-align:center; width:70px;">$FechaPresupuesto</th>
   <th style="text-align:center; width:70px;">$FechaentregaPresupuesto</th>
   <th style="text-align:center; width:70px;">$FechaDescarga</th>
   <th style="text-align:center; width:70px;">$FechaInicio</th>
   <th style="text-align:center; width:70px;">$FechaFin</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');

}








  $objcausa=new Causa();
  $resulcausa=$objcausa->listarcausasconordenesgiradasDeProcurador($idprocuradoractual);
  while($row=mysqli_fetch_array($resulcausa))
  {
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid;" nobr="true">
   <th style="text-align:center; width:100px;">$row[codigo]</th>
   <th style="text-align:center; width:130px;">$row[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$row[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$row[clienteasig]</th>
   <th style="text-align:center; width:80px;">$row[Categ]</th>
   <th style="width:435px;">$row[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');

  }

$nameFile='ListaOrdenes_'.$codigocausa.'.pdf';
$pdf->Output($nameFile);

?>