<?php
session_start();
$datos=$_SESSION["procuradormaestro"]; 
$idproc=$datos['procuradormaestro'];
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;

include_once('../../../model/clsprocurador.php');
include_once('../../../model/clspresupuesto.php');
/*INFORME DE PRUEBA CON LA LIBRERIA DOMPDF, el encbezado se puede repetir en las hojas*/


$BLOQUE_1="
<style type='text/css'>
  #tablapdf{
  font-family:'Arial Narrow',sans-serif;
  border-collapse: collapse;
  
}
#tablapdf td, #tablapdf th {
  border: 1px solid #ddd;
  
  text-align: center;
   border: 1px solid #000;
   border-spacing: 0;
}
#tablapdf td,ol{
  list-style:none;
}



#tablapdf tr:hover {background-color: #ddd;}

#tablapdf th {
 
  
  background-color: #82C244;
  color: white;
}
</style>
<center>
<h3>ORDENES PARA EJECUCIÓN</h3>
</center>
<table  width='100%' style='font-size:10px;' id='tablapdf'>
   <tr>
    <td style='background-color:#e8e8e8; width:75px;'>CODIGO</td>
    <td style='background-color:#e8e8e8;text-align:center; width:45px;'>#ORDEN</td>
    <td style='background-color:#e8e8e8;text-align:center; width:50px;'>EXP</td>
    <td style='background-color:#e8e8e8;text-align:center; width:50px;'>U/FOJA</td>
    <td style='background-color:#e8e8e8;text-align:center; width:80px;'>NOMBRE CAUSA</td>
    <td style='background-color:#e8e8e8;text-align:center; width:185px;'>OBSERVACIONES DE LA CAUSA</td>
    <td style='background-color:#e8e8e8;text-align:center; width:70px;'>VENCIMIENTO</td>
    <td style='background-color:#e8e8e8;text-align:center; width:150px;'>DETALLE CARGA DE DINERO</td>
    <td style='background-color:#e8e8e8;text-align:center; width:200px;'>INFORMACION DE CARGA</td>
    </tr>
  

  <tbody>";
$objpresu=new Presupuesto();

$objproc=new Procurador();
$resulproc=$objproc->listarOrdenesParaEjecutarPM_Impresion();
while ($filc=mysqli_fetch_array($resulproc)) 
  {
     $resultr=$objproc->mostrarPrimerTribunaldeCausa($filc['idcausa']);
     $rowt=mysqli_fetch_array($resultr);

     $resulult=$objproc->mostrarUltimafojaDeCausa($filc['idcausa']);
     $rowult=mysqli_fetch_array($resulult);

     
     $resulpresu=$objpresu->mostrarpresupuesto($filc['codorden']);
     $rowpres=mysqli_fetch_array($resulpresu);
$BLOQUE_1.="
<tr nobr='true'style=''>
   <td style='text-align:center; width:75px;'>$filc[codigocausa]</td>
   <td style='text-align:center; width:45px;'>$filc[codorden]</td>

   <td style='text-align:center; width:50px;'>$rowt[expediente]</td>
   <td style='text-align:center; width:50px;'>$rowult[ultima_foja]</td>

   <td style='text-align:center; width:80px;'>$filc[nomcausa]</td>
   <td style='text-align:justify; width:185px;'>$filc[Obser]</td>
   <td style='text-align:center; width:70px;'>$filc[fechafin]</td>
   <td style='text-align:left; width:150px;'>$rowpres[detalle_presupuesto]</td>
   <td style='text-align:left; width:200px;'>$filc[infocarga]</td>
</tr>";
 }
    
$BLOQUE_1.="</tbody>

</table>";



//CODIGO PARA VISUALIZAR EL PDF



$dompdf=new Dompdf();
$dompdf->load_html($BLOQUE_1);
$dompdf->setPaper('LEGAL','landscape');
ini_set("memory_limit", "32M");
$dompdf->render();
$dompdf->stream("Ejecutar_Operaciones.pdf",array("Attachment" => 0));
?>