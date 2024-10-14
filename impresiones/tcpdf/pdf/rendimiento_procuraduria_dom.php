<?php
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
include_once('../../../model/clscausa.php');

include_once('../../../model/clscajasdesalida.php');
/*INFORME DE PRUEBA CON LA LIBRERIA DOMPDF, el encbezado se puede repetir en las hojas*/
 $codcausa=$_GET['cod'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

       //PARA OBTENER LA IMAGEN DEL INDEX
       $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
       $linkimg='../../../fotos/imagenindex/'.$filimg->imagenindex;


   $objc=new Causa();
$resc=$objc->mostrarUnacausa($codigonuevo);
$fill=mysqli_fetch_object($resc);
$cliente=$fill->clienteasig;
$codigocausa=$fill->codigo;

$BLOQUE_1="
<html>
<head>
  <style>
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
#idimg {
  float:left;
  width:250px;
  margin-top:5px;
} 

    @page { margin: 60px; }
    #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 50px; background-color: white; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px; background-color: white; }
    #footer .page:after { content: counter(page, upper-number); }
  </style>
  <title>Rendimiento Procuradoria</title>
<body>
  <div id='header'>
   <img id='idimg' src='$linkimg'>
   
  </div>
  
<div id='content'>
    
 
<center><h3>RENDIMIENTO DE PROCURADURÍA DE LA CAUSA: $codigocausa </center></h3>

";



/***************************************LISTADO DE ORDENES********************************/
ini_set('date.timezone','America/La_Paz');
$fechoyal=date("Y-m-d");
$horita=date("H:i");
////$concat es la fecha y hora de la paz Bolivia
$concat=$fechoyal.' '.$horita;

/*----------------------------------------------------------------------*/
/*-----        IMPRESION DE RENDIMIENTO DE PROCURADORIA         --------*/
/*----------------------------------------------------------------------*/
//   -----   FICHA ------
$BLOQUE_1.="
<table  width='100%' style='font-size:8px;' id='tablapdf'>
  <thead>
   <tr>
    <td style='background-color:#e8e8e8; width:10%;'>CODIGO</td>
    <td style='background-color:#e8e8e8;text-align:center; width:80%;'>NOMBRE DEL PROCESO</td>
    <td style='background-color:#e8e8e8;text-align:center; width:10%;'>CLIENTE</td> 
    </tr>
   </thead>
  <tbody>";
$objcausa=new Causa();
$resul=$objcausa->fichacausa($codigonuevo);
while ($fil=mysqli_fetch_array($resul)) 
   {  
   $BLOQUE_1.="
      <tr nobr='true'>
         <td style='text-align:center; '>$fil[codigo]</td>
         <td style='text-align:left;'>$fil[nombrecausa]</td> 
       <td style='text-align:right; '>$fil[clienteasig]</td>   
      </tr>
  </tbody>
  </table><br>
  ";
   }

//  -------   LISTADO DE ORDENES CON RENDIMIENTO----

$BLOQUE_1.="
<table  width='100%' style='font-size:8px;' id='tablapdf'>
  <thead>
   <tr>
    <td style='background-color:#e8e8e8; width:5%;'># DE ORDEN</td>
    <td style='background-color:#e8e8e8;text-align:center; width:33%;'>CARGA DE INFORMACION</td>
    <td style='background-color:#e8e8e8;text-align:center; width:32%;'>DESCARGA DE INFORMACION</td>
    <td style='background-color:#e8e8e8;text-align:center; width:4%;'>NIVEL DE PRIORIDAD</td>
    <td style='background-color:#e8e8e8;text-align:center; width:4%;'>PLAZO EN HORAS</td>
    <td style='background-color:#e8e8e8;text-align:center; width:5%;'>COTIZACION POSITIVA PARA PAGAR AL PROCURADOR</td>
    <td style='background-color:#e8e8e8;text-align:center; width:5%;'>COTIZACION NEGATIVA PARA PAGAR AL PROCURADOR</td> 
    <td style='background-color:#e8e8e8;text-align:center; width:5%;'>MONTO PAGADO AL PROCURADOR</td> 
    <td style='background-color:#e8e8e8;text-align:center; width:7%;'>PROCURADOR QUE ATENDIO CADA ORDEN</td> 
    </tr>
   </thead>
  <tbody> ";
  $totalrendimeinto=0;
  $totalcotizacion=0;
  $totalcoti_negativo=0;
  $objrend=new Causa();
$resuldep=$objrend->rendimientoProcuradoriaDeCausa($codigonuevo);
while ($fila=mysqli_fetch_array($resuldep)) 
   {
     
   
   $totalcotizacion=$totalcotizacion+$fila['cot_positiva'];
   $totalcoti_negativo=$totalcoti_negativo+$fila['cot_negativa'];
   $totalrendimeinto=$totalrendimeinto+$fila['pagadoProcurador'];
$BLOQUE_1.="
<tr nobr='true'>
   <td style='text-align:center; '>$fila[codorden]</td>
   <td style='text-align:left;'>$fila[CargaInfo]</td>
   <td style='text-align:left; '>$fila[detalle_informacion]</td>
   <td style='text-align:center; '>$fila[Prioriorden]</td>
   <td style='text-align:center; '>$fila[plazo_horas]</td>
   <td style='text-align:right; '>$fila[cot_positiva]</td>
   <td style='text-align:right; '>$fila[cot_negativa]</td>
   <td style='text-align:right; '>$fila[pagadoProcurador]</td>
   <td style='text-align:center; '>$fila[procuAsignado]</td>
   
</tr>";
    }
$BLOQUE_1.="
<tr nobr='true'>
   <td style='text-align:center; ' colspan='5'>TOTAL RENDIMIENTO</td>
   <td style='text-align:right;'>$totalcotizacion</td>
   <td style='text-align:right;'>$totalcoti_negativo</td>
   <td style='text-align:right;'>$totalrendimeinto</td>
   <td style='text-align:right;'></td>
</tr>";
    
 $BLOQUE_1.="
 </tbody>
  </table><br>";

$BLOQUE_1.="
 </div>

</body>
</html>";

//CODIGO PARA VISUALIZAR EL PDF

$dompdf=new Dompdf();
$dompdf->load_html($BLOQUE_1);
$dompdf->setPaper('LEGAL','landscape');
//ini_set("memory_limit", "32M");
$dompdf->render();

// add the header 
$canvas = $dompdf->get_canvas(); 
//$font = get_font("helvetica", "bold"); 

// the same call as in my previous example 
$canvas->page_text(470, 585, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0)); 
ob_end_clean(); //LIMPIA ESPACIOS EN BLANCO PARA NO GENERAR ERROREA
$dompdf->stream("Informe1.pdf",array("Attachment" => 0));
?>