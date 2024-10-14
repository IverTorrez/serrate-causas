<?php

session_start();
if(!isset($_SESSION["userObs"]))
{
  header("location:../../../index.php");
}
$datos=$_SESSION["userObs"];

require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');


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
        
        $pdf->Cell(250, 0, '                                                                                       LISTADO DE CAUSAS CON ORDENES ACEPTADAS', 0, 0, 'C', 0, '', 0);


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


  $objcausa=new Causa();
  $resulcausa=$objcausa->listarcausasconordenesaceptadas();
  while($row=mysqli_fetch_array($resulcausa))
  {


$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid;" nobr="true">
   <th style="text-align:center; width:100px;">$row[codigo]</th>
   <th style="text-align:center; width:130px;">$row[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$row[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$row[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$row[clienteasig]</th>
   
   <th style="width:435px;">$row[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');

  }

$nameFile='CausaOrdenesAceptadas.pdf';
$pdf->Output($nameFile);

?>