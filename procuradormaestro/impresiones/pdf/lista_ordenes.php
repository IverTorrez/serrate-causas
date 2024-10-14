<?php

session_start();
if(!isset($_SESSION["procuradormaestro"]))
{
  header("location:../../../index.php");
}
$datos=$_SESSION["procuradormaestro"];

require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');
include_once('../../../model/clsordengeneral.php');
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

   $codigonuevocausa=$decodificado/1213141516;
 $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevocausa);
   $fil=mysqli_fetch_object($resul);
   $codigocausa=$fil->codigo;

$nombrecont=$datos['nombreproc'];

        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);
        
        $pdf->Cell(250, 0, '                                                                                       LISTA DE ORDENES DE LA CAUSA: '.$codigocausa, 0, 0, 'C', 0, '', 0);


        $pdf->Cell(85, 0, 'Procurador Maestro: '.$nombrecont, 0, 1, 'R', 0, '', 1);
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
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="3" width="80px"># DE ORDEN</th>
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="3" width="70px">FECHA DE GIRO DE LA ORDEN</th>
    <th style="text-align:center; background-color:#e8e8e8;" colspan="2" width="140px">VIGENCIA DE DE LA ORDEN</th>
    <th style="text-align:center; background-color:#e8e8e8;" colspan="4" width="240px">COTIZACION</th>
    <th style="text-align:center; background-color:#e8e8e8;" colspan="2" width="200px">FINANZAS</th>
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="3" width="175px">PROCURADOR </th>
  </tr>
  <tr >
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="2" width="70px">INICIO</th>
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="2" width="70px">FIN</th>
    <th style="text-align:center; background-color:#e8e8e8;" colspan="2" width="120px">PARAMETROS USADOS PARA COTIZAR ESTA ORDEN</th>
    <th style="text-align:center; background-color:#e8e8e8;" colspan="2" width="120px">COTIZACION DE PROCURADORIA</th>
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="2" width="100px">COSTO JUDICIAL (COMPRA) Bs.-</th>
    <th style="text-align:center; background-color:#e8e8e8;" rowspan="2" width="100px">COSTO DE PROCURADORIA (COMPRA) Bs.-</th>

  </tr>
  <tr >
    <th style="text-align:center; background-color:#e8e8e8;" width="60px">NIVEL DE PRIORIDAD</th>
    <th style="text-align:center; background-color:#e8e8e8;" width="60px">PLAZO EN HORAS</th>
    <th style="text-align:center; background-color:#e8e8e8;" width="60px">CP+(Compra)</th>
    <th style="text-align:center; background-color:#e8e8e8;" width="60px">CP-(Penalidad)</th>
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

  $objOrden=new OrdenGeneral();
  $listadoorden=$objOrden->listarOrdenesProcuradorMaestro($codigonuevocausa);
  while ($filor=mysqli_fetch_object($listadoorden)) 
  {

    /*PARA EL COLOR A LAS FILAS DEPENDIENDO DE SU URGENCIA*/
      if ($filor->estado_orden=='Serrada')/*PREGUNTA SI ESTA SERRADA LA ORDEN*/ 
      {
       $backgroundfila='white'; 
       $fontcolor='#000000';
      }
      else/*POR FALSO*/
      {


          $fechafinorden=$filor->Fin;
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

 //   echo "<tr style='background: $backgroundfila; color:$fontcolor'>";
      //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$filor->idorden*1020304050;
             $encriptado=base64_encode($mascara);
              /*VERIFICA SI LA ORDEN ESTA PREDATADA POR VERDADERO MUESTA LA FILA DE COD ORDEN NOMALMENTE*/
             if ($filor->Inicio<=$concat)
             {
  //              echo "<td class='tdcod'><a style='color:$fontcolor' href='orden.php?squart=$encriptado'>$filor->idorden</a></td>";
  $numeroOrden=$filor->idorden;          
             }
             else/*POR FALSO MUESTA EL CODIGO CON UN * AL LADO*/
             {
  //            echo "<td class='tdcod'>*<a style='color:black;' href='orden.php?squart=$encriptado'>$filor->idorden</a></td>";
  $numeroOrden="*".$filor->idorden;
             }
              
  /*            echo "<td>$filor->fecha_giro</td>";
              echo "<td>$filor->Inicio</td>";
              echo "<td>$filor->Fin</td>";
              echo "<td>$filor->Prioridad</td>";*/
  $FechaGiro=$filor->fecha_giro;
  $FechaInicio=$filor->Inicio;
  $FechaFIn=$filor->Fin;
  $Prioridad=$filor->Prioridad;
              switch ($filor->Condicion) 
              {
                case 1:$PlazoHoras="mas de 96"; break;
                case 2:$PlazoHoras="24-96"; break;
                case 3:$PlazoHoras="8-24"; break;
                case 4:$PlazoHoras="3-8"; break;
                case 5:$PlazoHoras="1-3"; break;
                case 6:$PlazoHoras="0-1"; break;         
              }
   /*           echo "<td>$filor->Compra</td>";
              echo "<td>$filor->Penalidad</td>";*/
  $CompraProc=$filor->Compra;
  $PenalidadProc=$filor->Penalidad;

              $objdescarga=new DescargaProcurador();
              $resultdescarga=$objdescarga->mostrardescargaorden($filor->idorden);
              $fildescarga=mysqli_fetch_object($resultdescarga);

  //           echo "<td>$fildescarga->gastos</td>";  //ES EL DATOS DE GASTO DE LA DESCARGA, LO QUE LE CUESTA A LA EMPRESA HACER ESA ORDEN
  $Gasto=$fildescarga->gastos;
            /*FUNCION PARA MOSTRAR LA COMPRA DE PROCURADORIA (COMPRA O PENALIDAD)*/ 
             $objorden2=new OrdenGeneral();
              $resulorden2=$objorden2->muestraCalificacionOrden($filor->idorden);
              $filcalif=mysqli_fetch_object($resulorden2);
              if ($filcalif->calificacion_todo!='') 
              {
                  if ($filcalif->calificacion_todo=='Suficiente') 
                  {
   //                 echo "<td>$filor->Compra</td>";
  $CostoProcuraduriaParaelProcurador=$filor->Compra;
                  }
                  else
                  {
  //                  echo "<td>$filor->Penalidad</td>";
  $CostoProcuraduriaParaelProcurador=$filor->Penalidad;
                  }
              }
              /*AUN NO SE A SERRADO LA ORDEN*/
              else
              {
   //             echo "<td></td>"; 
  $CostoProcuraduriaParaelProcurador="";
              }

  //            echo "<td>$filor->Procurador</td>";
  $procuradorGestor=$filor->Procurador;
   // echo "</tr>";



$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; background-color: $backgroundfila; color:$fontcolor" nobr="true">
   <th style="text-align:center; width:80px;">$numeroOrden</th>
   <th style="text-align:center; width:70px;">$FechaGiro</th>
   <th style="text-align:center; width:70px;">$FechaInicio</th>
   <th style="text-align:center; width:70px;">$FechaFIn</th>
   <th style="text-align:center; width:60px;">$Prioridad</th>
   <th style="text-align:center; width:60px;">$PlazoHoras</th>
   <th style="text-align:center; width:60px;">$CompraProc</th>
   <th style="text-align:center; width:60px;">$PenalidadProc</th>
   <th style="text-align:center; width:100px;">$Gasto</th>
   <th style="text-align:center; width:100px;">$CostoProcuraduriaParaelProcurador</th>
   <th style="text-align:center; width:175px;">$procuradorGestor</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');


  }/*FIN LIS LISTADO DE ORDENES DE UNA CAUSA*/

$nameFile='ListaOrdenes_'.$codigocausa.'.pdf';
$pdf->Output($nameFile);

?>