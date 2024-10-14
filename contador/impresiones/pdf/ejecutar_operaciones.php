<?php
session_start();
$datos=$_SESSION["procurador"]; 
$idproc=$datos['id_procurador'];
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

include_once('../../../model/clsprocurador.php');
include_once('../../../model/clspresupuesto.php');

// create new PDF document




class PDF extends TCPDF
{
   //Cabecera de página
   function Header()
   {

      $this->Image('images/logoserrate3.jpg',30,8, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);

     // $this->SetFont('','B',12);

     // $this->Cell(30,10,'Title',1,0,'C');
    
   }

   function Footer()
   {


    
  $this->SetY(-10);

  $this->SetFont('','I',8);
    $this->Image('images/footer3.png',120,200,'', 10, '', '', '', false, 300, '', false, false, 0, false,false,false);
  $this->Cell(0,10,'Pagina '.$this->PageNo().'/'.$this->getAliasNbPages(),0,0,'C');
   }
}



$procnombre=$datos['nombreproc'];

$pdf = new PDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);/*PARA HOJA TAMAÑO LEGAL SE PONE LEGAL EN MAYUSCULA*/

$pdf->startPageGroup();

$pdf->AddPage('L','LEGAL');

#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(34, 30 ,30);

$pdf->Cell(250, 0, '                                                                                       ORDENES PARA EJECUCION', 0, 0, 'C', 0, '', 1);
$pdf->Cell(85, 0, 'Procurador : '.$procnombre, 0, 1, 'R', 0, '', 1);
$pdf->Ln(12);
/*===============================================================
TAMAÑO TOTAL DE LA HOJA OFICIO ECHADA(ORIZONTAL)=952px DISPONIBLE PARA OCUPAR CON DATOS
/*===============================================================*/
$pdf->SetFont('','',8);
$bloque1=<<<EOF

<table border="0.1px">
	<thead>
	   <tr>
		<th style="text-align:center;  width:75px; background-color:#e8e8e8;">CODIGO</th>
		<th style="text-align:center;  width:45px; background-color:#e8e8e8;"># ORDEN</th>
		<th style="text-align:center;  width:50px; background-color:#e8e8e8;">EXP</th>
		<th style="text-align:center;  width:50px; background-color:#e8e8e8;">U/FOJA</th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">NOMBRE CAUSA</th>

    <th style="text-align:center;  width:182px; background-color:#e8e8e8;">OBSERVACIONES DE LA CAUSA</th>

		<th style="text-align:center;  width:70px; background-color:#e8e8e8;">VENCIMIENTO</th>

    <th style="text-align:center;  width:150px; background-color:#e8e8e8;">DETALLE CARGA DINERO</th>
    <th style="text-align:center;  width:200px; background-color:#e8e8e8;">INFORMACION DE CARGA</th>
		</tr>
	</thead>

	<tbody>
		
	</tbody>

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');
//FIN DEL BLOQUE 1

$pdf->SetFont('','',8);
//EMPIEZA EL BLOQUE 2
$objproc=new Procurador();
$resulproc=$objproc->listarOrdenesParaEjecutar_Impresion($idproc);
while ($filc=mysqli_fetch_array($resulproc)) 
{ 


   $objtri=new Procurador();
   $resultr=$objtri->mostrarPrimerTribunaldeCausa($filc['idcausa']);
   $rowt=mysqli_fetch_array($resultr);

   $objult=new Procurador();
   $resulult=$objult->mostrarUltimafojaDeCausa($filc['idcausa']);
   $rowult=mysqli_fetch_array($resulult);

   $objpresu=new Presupuesto();
   $resulpresu=$objpresu->mostrarpresupuesto($filc['codorden']);
   $rowpres=mysqli_fetch_array($resulpresu);



	
$bloque2=<<<EOF
<table border="0.1px">
<tr style="page-break-inside: avoid;">
   <td style="text-align:center; width:75px;">$filc[codigocausa]</td>
   <td style="text-align:center; width:45px;">$filc[codorden]</td>

   <td style="text-align:center; width:50px;">$rowt[expediente]</td>
   <td style="text-align:center; width:50px;">$rowult[ultima_foja]</td>

   <td style="text-align:center; width:80px;">$filc[nomcausa]</td>
   <td style="text-align:center; width:182px;">$filc[Obser]</td>
   <td style="text-align:center; width:70px;">$filc[fechafin]</td>
   <td style=" width:150px;">$rowpres[detalle_presupuesto]</td>
   <td style=" width:200px;">$filc[infocarga]</td>

</tr>

</table>
EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');	

}

// set auto page breaks



/*SALIDAD DEL ARCHIVO*/

$pdf->Output();
?>