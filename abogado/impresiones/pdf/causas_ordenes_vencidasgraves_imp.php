<?php
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../../../index.php");
}
$datos=$_SESSION["abogado"];

require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');
include_once('../../../model/clstribunal.php');
include_once('../../../model/clsdemandante_demandado.php');
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
TAMAÑO TOTAL DE LA HOJA OFICIO ECHADA(ORIZONTAL)=952px DISPONIBLE PARA OCUPAR CON DATOS
/*===============================================================*/

/*****************************CABECERA DE LA HOJA***********************************/
$abogadonombre=$datos['nombreabog'];
        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false, false, false);
        

        $pdf->Cell(250, 0, '                                                                                    LISTADO DE CAUSAS CON ORDENES VENCIDAS GRAVES', 0, 0, 'C', 0, '', 0);


        $pdf->Cell(85, 0, 'Abogado: '.$abogadonombre, 0, 1, 'R', 0, '', 1);
        $pdf->Cell(0, 0, $subtitulo, 0, 1, 'C', 0, '', 0);
$pdf->Ln(10);


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
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">PROCURADOR</th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">CLIENTE</th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">CATEGORIA</th>
		<th style="text-align:center;  width:435px; background-color:#e8e8e8;">OBSERVACIONES</th>
		</tr>
	</thead>

	<tbody>
		
	</tbody>

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');



$codabog=$datos['id_abogado'];
 ini_set('date.timezone','America/La_Paz');
 $fechoyal=date("Y-m-d");
 $horita=date("H:i");
 $concat=$fechoyal.' '.$horita;
 
 $arrayIdCausas=array();
 $objorde=new OrdenGeneral();
 $resulorden=$objorde->mostrarOrdenVencidasGravesDeCausaDeAbogado($codabog);
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
     $filc=mysqli_fetch_array($resultcausa);
      
 
$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid;" nobr="true">
   <th style="text-align:center; width:100px;">$filc[codigo]</th>
   <th style="text-align:center; width:130px;">$filc[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$filc[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$filc[clienteasig]</th>
   <th style="text-align:center; width:80px;">$filc[Categ]</th>
   <th style=" width:435px;">$filc[Observ]</th>
</tr>
</thead>
</table>
EOF;
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');

     $contador1++;
     
   }/*FIN DEL WHILE QUE RECORRE EL ARRAY PARA MOSTRAR CAUSAS*/
 }/*FIN DEL IF QUE PREGUNTA SI EL ARRAY TIENE VALORES*/








$pdf->Output('CausasOrdenesVencidasGraves.pdf');
?>