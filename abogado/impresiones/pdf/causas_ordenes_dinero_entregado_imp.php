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
       // $pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false, false, false);
        

        $pdf->Cell(250, 0, '                                                                                    LISTADO DE CAUSAS CON ORDENES CON DINERO ENTREGADO', 0, 0, 'C', 0, '', 0);


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



$idabogadoactual=$datos['id_abogado'];  //ES EL CODIGO DE GUSTAVO, EL ABOGADO
 
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasconordenesdineroentregadoDeCausaDeAbogado($idabogadoactual);
   while ($filc=mysqli_fetch_array($resul)) 
   {
       

$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid;" nobr="true">
   <th style="text-align:center; width:100px;">$filc[codigo]</th>
   <th style="text-align:center; width:130px;">$filc[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$filc[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$filc[clienteasig]</th>
   <th style="text-align:center; width:80px;">$filc[Categ]</th>
   <th style="text-align:center; width:482px;">$filc[Observ]</th>
</tr>
</thead>
</table>
EOF;
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
}




$pdf->Output('CausasOrdenesDineroEntregado.pdf');
?>