
<?php
//error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["useradmin"]))
{
  header("location:login.php");
}
$datos=$_SESSION["useradmin"];

include('fpdf181/fpdf.php');


class PDF extends FPDF
	{
		function Header()
		{
			//$this->Image('images/logofinor.jpg', 5, 5, 20 );
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10, 'INF 1 SALDOS ACTIVOS',0,0,'C');
			$this->Ln(20);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}



include_once('model/clscausa.php');

  
  $objcausa=new Causa();
  $resulcausa=$objcausa->mostrarInforme_1();
  $colon=30;

//$resultado= $mysqli->query("SELECT * FROM piso");

 
	$pdf = new PDF('L','mm',array(215.9,355.6));
	$pdf->AliasNbPages(10000,20000);
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Times');
	$pdf->SetFontSize(7);
	$pdf->Cell($colon,9,'CODIGO DE CAUSA ',1,0,'C',1);
	$pdf->Cell(35,9,'NOMBRE',1,0,'C',1);
	$pdf->Cell(35,9,'CLIENTE',1,0,'C',1);
	$pdf->Cell(35,9,'DIRECCION',1,0,'C',1);
	$pdf->Cell(15,9,'TELEFONO',1,0,'C',1);
	$pdf->Cell(35,9,'CORREO',1,0,'C',1);
	$pdf->Cell(45,9,'COORDENADAS',1,0,'C',1);
	$pdf->Cell(15,9,'SALDO',1,0,'C',1);
	
	$pdf->Cell(90,9,'OBSERVACIONES',1,1,'C',1);



	/*$pdf->Cell(25,6,'MATERNO',1,0,'C',1);
	$pdf->Cell(20,6,'CEDULA',1,0,'C',1);
	$pdf->Cell(20,6,'ID BECA',1,0,'C',1);
	$pdf->Cell(25,6,'ESTADO',1,0,'C',1);
	$pdf->Cell(28,6,'ID USUARIO',1,1,'C',1);*/

	//$pdf->SetFont('Arial','',10);


	while($row=mysqli_fetch_object($resulcausa))
	{   
		//$pdf->Cell(25,6,$row['id_piso'],1,0,'C',1);
		$pdf->Cell(30,6,utf8_decode($row->codigo),1,0,'L',1);
		$pdf->Cell(35,6,utf8_decode($row->nombrecausa),1,0,'L',1);
		$pdf->Cell(35,6,utf8_decode($row->clienteasig),1,0,'L',1);
		$pdf->Cell(35,6,utf8_decode($row->Dircliente),1,0,'L',1);
		$pdf->Cell(15,6,utf8_decode($row->Telfcli),1,0,'L',1);
		$pdf->Cell(35,6,utf8_decode($row->CorreoCli),1,0,'L',1);
		$pdf->Cell(45,6,utf8_decode($row->CoorCli),1,0,'L',1);
		$pdf->Cell(15,6,utf8_decode($row->caja),1,0,'L',1);

		$pdf->Cell(90,6,utf8_decode($row->Observ),1,1,'L',1);


		/*$pdf->Cell(25,6,utf8_decode($row['maternoest']),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode($row['cedulaest']),1,0,'C',1);
		$pdf->Cell(20,6,$row['id_beca'],1,0,'C',1);
		$pdf->Cell(25,6,utf8_decode($row['estadoest']),1,0,'C',1);
		$pdf->Cell(28,6,$row['id_usuario'],1,1,'C',1);*/

		
      
		
	}

	
	$pdf->Output();


/*$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
 
$pdf->Output();
echo "ffffffffffffffff";*/

?>