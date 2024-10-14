<?php

session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../../../index.php");
}

$datos=$_SESSION["abogado"];
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

include_once('../../../model/clscausa.php');
include_once('../../../model/clsordengeneral.php');
include_once('../../../model/clsautoorden.php');
include_once('../../../model/clstipolegal.php');
include_once('../../../model/clsprocurador.php');
include_once('../../../model/clscliente.php');
include_once('../../../model/clscategoria.php');
// create new PDF document

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
    //$this->Image('images/footer3.png',120,200,'', 10, '', '', '', false, 300, '', false, false, 0, false,false,false);
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

/***************************************SUBTITULOS PARA LA TABLAS******************************/
if ($_SESSION['listado']=='codigo') 
{
	$objtp=new TipoLegal();
	$resulttp=$objtp->mostrarunTipolegal($_SESSION['id']);
	$tp=mysqli_fetch_object($resulttp);
	$subtitulo="CAUSAS CON EL TIPO LEGAL:  ".$tp->nombretipolegal." ($tp->abreviaturalegal)";
}

if ($_SESSION['listado']=='procurador') 
{
	$objp=new Procurador();
	$resulp=$objp->mostrarunprocuradro($_SESSION['id']);
	$p=mysqli_fetch_object($resulp);
	$subtitulo="CAUSAS DEL PROCURADOR:  ".$p->Nombre;
}

if ($_SESSION['listado']=='cliente') 
{
	$objcli=new Cliente();
	$resulcli=$objcli->mostrarunCliente($_SESSION['id']);
	$cli=mysqli_fetch_object($resulcli);
	$subtitulo="CAUSAS DEL CLIENTE:  ".$cli->nombrecli." ".$cli->apellidocli;
}

if ($_SESSION['listado']=='categoria') 
{
	$objcat=new Categoria();
	$resulcat=$objcat->mostrarUnaCategoria($_SESSION['id']);
	$cat=mysqli_fetch_object($resulcat);
	$subtitulo="CAUSAS CON LA CATEGORIA:  ".$cat->nombrecat." ($cat->abreviaturacat)";
}

if ($_SESSION['listado']=='porcategoria') 
{
  $subtitulo="LISTADO DE CAUSAS ORDENADAS POR CATEGORIA";
}

if ($_SESSION['listado']=='porpisos') 
{
  $subtitulo="LISTADO DE CAUSAS ORDENADAS POR PISOS";
}





$abogadonombre=$datos['nombreabog'];
        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);
        
        $pdf->Cell(250, 0, '                                                                                       MIS CAUSAS', 0, 0, 'C', 0, '', 0);


        $pdf->Cell(85, 0, 'Abogado: '.$abogadonombre, 0, 1, 'R', 0, '', 1);
        $pdf->Cell(0, 0, $subtitulo, 0, 1, 'C', 0, '', 0);
$pdf->Ln(5);


/*===============================================================
CABECERA DE LA TABLA
/*===============================================================*/
$bloque1=<<<EOF

<table border="0.1px">
	<thead>
	   <tr>
		<th style="text-align:center; height: 20px; width:100px; background-color:#e8e8e8;">CODIGO</th>
		<th style="text-align:center; height: 20px; width:130px; background-color:#e8e8e8;">NOMBRE DEL PROCESO</th>
		<th style="text-align:center; height: 20px; width:80px; background-color:#e8e8e8;">PROCURADOR</th>
		<th style="text-align:center; height: 20px; width:80px; background-color:#e8e8e8;">CLIENTE</th>
		<th style="text-align:center; height: 20px; width:80px; background-color:#e8e8e8;">CATEGORIA</th>
		<th style="text-align:center; height: 20px; width:435px; background-color:#e8e8e8;">OBSERVACIONES</th>
		</tr>
	</thead>

	<tbody>
		
	</tbody>

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');
//FIN DEL BLOQUE 1


$idabogadoactual=$datos['id_abogado'];



/*======================================================================================
                                   LISTADO DE LAS CAUSAS DEL ABOGADO
/*=======================================================================================*/
$pdf->SetFont('','',8);
//EMPIEZA EL BLOQUE 2

if ($_SESSION['listado']=='vacio') 
{
	
$objcausa=new Causa();
$resulcausa=$objcausa->listarcausasDeAbogado($idabogadoactual);
while ($filc=mysqli_fetch_array($resulcausa)) 
{ 
	$ordenescausa="";

    $colorcausa='';
    if ($filc['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
	/*ORDENES SIN SERRAR*/
	           $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($filc["id_causa"]);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
                    $ordenescausa.="<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                $ordenescausa.= " $varcaraorden  ";

                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/



               if ($idabogadoactual==$filc['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($filc['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                //echo "<td style='color:$colorcausa; background:$colorfondo;'>$fil->nombrecausa</td>";
              }

	/*FIN DE ORDENES SIN SERRAR*/

$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$filc[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$filc[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$filc[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$filc[clienteasig]</th>
   <th style="text-align:center; width:80px;">$filc[Categ]</th>
   <th style="width:435px;">$filc[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');	

}/*FIN DEL WHILE QUE RECORRE TODAS LAS CAUSAS*/

}/*FIN DEL IF QUE PREGUNTA SI CODIGO ES IGUAL A VACIO */




/*======================================================================================
                                   LISTADO DE LAS CAUSAS DEL ABOGADO SEGUN EL CODIGO
/*=======================================================================================*/
if ($_SESSION['listado']=='codigo') 
{
	$idtplegal=$_SESSION['id'];
  $objcausa=new Causa();
   $resul=$objcausa->listarCausaDeUnTipoLegalDeAbogado($idtplegal,$idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   { 
       $colorcausa='';
       $ordenescausa="";
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
     // echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      //echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
               //  echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
    //  echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                //echo "<td style='color:$colorcausa; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                //echo "<td>$fil->nombrecausa</td>";
              }
      //echo "<td>$fil->abogadogestor</td>";
    /*  echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/


$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px;background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/

}/*FIN DEL IF QUE PREGUNTA SI LA VARIAVLE codigo ES IGUAL codigo*/







/*======================================================================================
                                   LISTADO DE LAS CAUSAS DEL ABOGADO SEGUN EL PROCURADOR
/*=======================================================================================*/

if ($_SESSION['listado']=='procurador') 
{
	$idproc=$_SESSION['id'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeprocuradorDeAbogado($idproc,$idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa="";
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    //  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
     // echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
               //  echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
   //   echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
               // echo "<td style='color:$colorcausa; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                //echo "<td>$fil->nombrecausa</td>";
              }
     // echo "<td>$fil->abogadogestor</td>";
     /* echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/


$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
	
}/*FIN DEL QUE PREGUNTA SI listado es igual a procurador*/







/*======================================================================================
                                   LISTADO DE LAS CAUSAS DEL ABOGADO SEGUN EL CLIENTE
/*=======================================================================================*/


if ($_SESSION['listado']=='cliente') 
{
	$idclie=$_SESSION['id'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeclienteDeAbogado($idclie,$idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa="";
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
     // echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //

     /* $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                  /* $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);*/
                // echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
    //  echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
               // echo "<td style='background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                //echo "<td>$fil->nombrecausa</td>";
              }
     // echo "<td>$fil->abogadogestor</td>";
    /*  echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/


$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/


}/*fin del if que pregunta si listado es igual a cliente*/









/*======================================================================================
                                   LISTADO DE LAS CAUSAS DEL ABOGADO SEGUN LA CATEGORIA
/*=======================================================================================*/
if ($_SESSION['listado']=='categoria') 
{   
	$idcat=$_SESSION['id'];
	$objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeCategoriaDeAbogado($idcat,$idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa="";
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    //  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
  //    $mascara=$fil->id_causa*12345678910;
    //  $encriptado=base64_encode($mascara);
     // echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
              //   echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
     // echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
            //    echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
         //       echo "<td>$fil->nombrecausa</td>";
              }
     // echo "<td>$fil->abogadogestor</td>";
 /*     echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
	
}/*FIN DEL IF QUE PREGUNTA SI listado es igual a categoria*/










/*======================================================================================
                    LISTADO DE LAS CAUSAS DEL ABOGADO ORDENADO POR CATEGORIA
/*=======================================================================================*/
if ($_SESSION['listado']=='porcategoria') 
{
    $objcausa=new Causa();
   $resul=$objcausa->listarcausasDeAbogadoOrdenadoPorCategoria($idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    //   echo "<tr style='color: $colorcausa'>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
    //        $mascara=$fil->id_causa*12345678910;
    //         $encriptado=base64_encode($mascara);
    //          echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>"; 

                 /*LISTAR ORDENES DE LA CAUSA*/
                 $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
            //        echo "<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
        //         echo "<a style='color: $colorcausa' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";
                $ordenescausa.=" $varcaraorden ";
                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/

            //  echo "</td>";
              /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['id_causa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
    //            echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
    //            echo "<td>$fil->nombrecausa</td>";
              }
              
             // echo "<td>$fil->abogadogestor</td>";
    //          echo "<td>$fil->procuradorasig</td>";
    //          echo "<td>$fil->clienteasig</td>";
    //         echo "<td>$fil->Categ</td>";
    //          echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
    //    echo "</tr>";
$bloquePorCategoria=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloquePorCategoria,false,false,false,false,'');
    }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI listado es igual a porcategoria*/










/*======================================================================================
                    LISTADO DE LAS CAUSAS DEL ABOGADO ORDENADO POR PISO DEL TRIBUNAL
/*=======================================================================================*/
if ($_SESSION['listado']=='porpisos') 
{
     $arrayorcausapisos=array();
   $objcausa=new Causa();
   $resul=$objcausa->listarCausasActivasPorPisoDeAbogado($idabogadoactual);
   while ($fil=mysqli_fetch_array($resul)) 
   {
    $colorfondo='';
       $ordenescausa='';
       $colorcausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      
       if (in_array($fil['idcausa'],$arrayorcausapisos)) /*COMPRUEBA SI ESA ORDEN YA A MOSTRADO*/
          {
           
          }
          else
          {
    //     echo "<tr style='color: $colorcausa'>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->idcausa*12345678910;
             $encriptado=base64_encode($mascara);
     //         echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->idcausa)>$fil->codigo</a><br>"; 
          
             array_push($arrayorcausapisos,$fil['idcausa']); /*METEMOS LA ORDEN EN UN ARRAY*/
                 /*LISTAR ORDENES DE LA CAUSA*/
                 $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['idcausa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
       //             echo "<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

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

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
             //    echo "<a style='color: $colorcausa' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";
               $ordenescausa.=" $varcaraorden ";
                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/

         //     echo "</td>";
              /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil['idabog']) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil['idcausa']);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
    //            echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
    //            echo "<td>$fil->nombrecausa</td>";
              }
              
             // echo "<td>$fil->abogadogestor</td>";
    //          echo "<td>$fil->procuradorasig</td>"; 
    //          echo "<td>$fil->clienteasig</td>";
    //         echo "<td>$fil->Categ</td>";
    //          echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
    //    echo "</tr>";
$bloquePorPisos=<<<EOF
<table border="0.1px">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa</th>
   <th style="text-align:center; width:130px; background-color:$colorfondo;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloquePorPisos,false,false,false,false,'');
      }/*din del else*/

    }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI listado es igual a porpisos*/


/*SALIDAD DEL ARCHIVO*/

$pdf->Output('MisCausas.pdf');
?>

