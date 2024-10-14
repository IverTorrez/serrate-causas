<?php

session_start();
if(!isset($_SESSION["userObs"]))
{
  header("location:../../../index.php");
}
$datos=$_SESSION["userObs"];

require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');
include_once('../../../model/clsordengeneral.php');

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


$nombrecont=$datos['nombreusuario'];

        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);
        
        $pdf->Cell(250, 0, '                                                                                       LISTADO DE CAUSAS CON ORDENES VENCIDAS LEVES', 0, 0, 'C', 0, '', 0);


        $pdf->Cell(85, 0, 'Observador: '.$nombrecont, 0, 1, 'R', 0, '', 1);
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
		<th style="text-align:center;  width:100px; background-color:#e8e8e8;">CODIGO</th>
		<th style="text-align:center;  width:130px; background-color:#e8e8e8;">NOMBRE DEL PROCESO</th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">ABOGADO</th>
    <th style="text-align:center;  width:80px; background-color:#e8e8e8;">PROCURADOR <br> <span>(POR DEFECTO)</span></th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">CLIENTE</th>
		
		<th style="text-align:center;  width:435px; background-color:#e8e8e8;">OBSERVACIONES</th>
		</tr>
	</thead>

	

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');


ini_set('date.timezone','America/La_Paz');
 $fechoyal=date("Y-m-d");
 $horita=date("H:i");
 $concat=$fechoyal.' '.$horita;
 
 $arrayIdCausas=array();
 $objorde=new OrdenGeneral();
 $resulorden=$objorde->mostrarfechafinalyCodCausaVencidosLeves();
 while ($filord=mysqli_fetch_object($resulorden)) 
 {
     $fechafinorden=$filord->Fechafinal;
     $newfechfin=date_create($fechafinorden);
     $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

     $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
     $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
     /*PREGUNTAMOS SI LA FECHA ACTUAL ES MAYOSR A LA FECHA FINAL DE LA ORDEN (SI ESTA VENCIDA LEVE)*/
    if ($fecha1>$fecha2) 
      { /*COMPRUEBA SI EL IDCAUSA YA EXIXTE EN EL ARRAY*/
          if (in_array($filord->id_causa,$arrayIdCausas)) 
          {
           
          }
          else
          {
            array_push($arrayIdCausas, $filord->id_causa);
          }
        
      }
 }/*FIN DEL WHILE QUE RRECORRE LAS ORDENES DESCARGADAS VENCIDAS LEVES*/





  if (count($arrayIdCausas)>0) 
 {
   $contador1=0;
   $contadorarray=count($arrayIdCausas);
   while ($contador1<$contadorarray) 
   { 
     $idcausa1=$arrayIdCausas[$contador1];
     $objcausa1=new Causa();
     $resultcausa=$objcausa1->mostrarUnacausa($idcausa1);
     $filcausa=mysqli_fetch_array($resultcausa);
    /*  echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$filcausa->idcausa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='listadovencidasleves.php?squart=$encriptado'>$filcausa->codigo</a></td>";
              echo "<td>$filcausa->nombrecausa</td>";
              echo "<td>$filcausa->abogadogestor</td>";
              echo "<td>$filcausa->procuradorasig</td>";
              echo "<td>$filcausa->clienteasig</td>";
              echo "<td>$filcausa->Categ</td>";
              echo "<td style='text-align: justify;'>$filcausa->Observ</td>";     
        echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid;" nobr="true">
   <th style="text-align:center; width:100px;">$filcausa[codigo]</th>
   <th style="text-align:center; width:130px;">$filcausa[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$filcausa[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$filcausa[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$filcausa[clienteasig]</th>
   
   <th style="width:435px;">$filcausa[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');

     $contador1++;
     
   }/*FIN DEL WHILE QUE RECORRE EL ARRAY PARA MOSTRAR CAUSAS*/
 }/*FIN DEL IF QUE PREGUNTA SI EL ARRAY TIENE VALORES*/



$nameFile='CausasOrdenesVencidasLeves.pdf';
$pdf->Output($nameFile);

?>