<?php
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
include_once('../../../model/clscausa.php');
include_once('../../../model/clspostacausa.php');
include_once('../../../model/clsinformeposta.php');
include_once('../../../model/clstipoposta.php');
include_once('../../../model/clsordengeneral.php');
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



#tablapdf tr:hover {background-color: #ddd;}

#tablapdf th {
 
  
  background-color: #82C244;
  color: white;
}
</style>
<table  width='100%' style='font-size:10px;' id='tablapdf'>
	 <tr>
		<td style='background-color:#e8e8e8; width:10%;'>CODIGO</td>
		<td style='background-color:#e8e8e8;text-align:center; width:10%;'>NOMBRE DEL PROCESO</td>
		<td style='background-color:#e8e8e8;text-align:center; width:6%;'>CLIENTE</td>
		<td style='background-color:#e8e8e8;text-align:center; width:10%;'>DIRECCION</td>
		<td style='background-color:#e8e8e8;text-align:center; width:6%;'>TELEFONO</td>
		<td style='background-color:#e8e8e8;text-align:center; width:10%;'>CORREO</td>
		<td style='background-color:#e8e8e8;text-align:center; width:5%;'>COORDENADAS</td>
		<td style='background-color:#e8e8e8;text-align:center; width:5%;'>SALDO</td>
		<td style='background-color:#e8e8e8;text-align:center; width:38%;'>OBSERVACIONES</td>
		</tr>
	

	<tbody>";
$objcausa=new Causa();
  $resulcausa=$objcausa->mostrarInforme_1();
  while($row=mysqli_fetch_array($resulcausa))
  {
$BLOQUE_1.="
<tr nobr='true'>
   <td style='text-align:left; width:10%;'>$row[codigo]</td>
   <td style='text-align:left; width:10%;'>$row[nombrecausa]</td>
   <td style='text-align:left; width:6%;'>$row[clienteasig]</td>
   <td style='text-align:left; width:10%;'>$row[Dircliente]</td>
   <td style='text-align:left; width:6%;'>$row[Telfcli]</td>
   <td style='text-align:left; width:10%;'>$row[CorreoCli]</td>
   <td style='text-align:left; width:5%;'>$row[CoorCli]</td>
   <td style='text-align:left; width:5%;'>$row[caja]</td>
   <td style='text-align:left; width:38%;'>$row[obsevacionescausas]</td>
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
$dompdf->stream("Informe1.pdf",array("Attachment" => 0));
?>