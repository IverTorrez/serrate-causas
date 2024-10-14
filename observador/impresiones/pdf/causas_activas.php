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
include_once('../../../model/clsabogado.php');
include_once('../../../model/clstipolegal.php');
include_once('../../../model/clsprocurador.php');
include_once('../../../model/clscliente.php');
include_once('../../../model/clscategoria.php');


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
/***************************************SUBTITULOS PARA LA TABLAS******************************/
if ($_SESSION['listado']=='tplegal') 
{
  $objtp=new TipoLegal();
  $resulttp=$objtp->mostrarunTipolegal($_SESSION['id']);
  $tp=mysqli_fetch_object($resulttp);
  $subtitulo="CAUSAS CON EL TIPO LEGAL:  ".$tp->nombretipolegal." ($tp->abreviaturalegal)";
}

if ($_SESSION['listado']=='abogado') 
{
  $objab=new Abogado();
  $resulab=$objab->mostrarunAbogado($_SESSION['id']);
  $p=mysqli_fetch_object($resulab);
  $subtitulo="CAUSAS DEL ABOGADO:  ".$p->nombreabog;
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


$nombrecont=$datos['nombreusuario'];

        //$pdf->Image('images/logoserrate3.jpg',10, 10, 70, 15, '', '', '', false, 300, '', false, false, 0, false,false,false);
        
        $pdf->Cell(280, 0, '                                                                                       CAUSAS ACTIVAS', 0, 0, 'C', 0, '', 0);


        $pdf->Cell(55, 0, 'Observador: '.$nombrecont, 0, 1, 'R', 0, '', 1);
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
    <th style="text-align:center;  width:80px; background-color:#e8e8e8;">PROCURADOR</th>
		<th style="text-align:center;  width:80px; background-color:#e8e8e8;">CLIENTE</th>
		
		<th style="text-align:center;  width:435px; background-color:#e8e8e8;">OBSERVACIONES</th>
		</tr>
	</thead>

	

</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');


/*DATOS DE LAS CAUSAS ACTIVAS*********************/

/*========================================================================
                            LISTADO DE TODAS LAS CAUSAS ACTVAS
=========================================================================*/

if ($_SESSION['listado']=='vacio') 
{
$objcausa=new Causa();
   $resul=$objcausa->listarcausas();
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $ordenes='';
       $colorcausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
     // echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
     // echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>";

       /*LISTAR ORDENES D E LA CAUSA*/
               $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               { 
                  if ($cont==0) 
                  {
                    //echo "<br>";
                  }
                  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
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
               //  echo "<a style='color: $colorcausa' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";
                 $ordenes.=" $varcaraorden ";
                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
   /*   echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/

$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenes </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/

}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  vacio*/










/*======================================================================================
                            LISTADO DE TODAS LAS CAUSAS SEGUN EL TIPO LEGAL
=======================================================================================*/
if ($_SESSION['listado']=='tplegal') 
{
   $objcausa=new Causa();
   $resul=$objcausa->listarCausaDeUnTipoLegal($_SESSION['id']);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    /*  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

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
                 //echo "<a style='color: $colorcausa' target='_blank' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
    /*  echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/

$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/

}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  tplegal*/












/*======================================================================================
                            LISTADO DE TODAS LAS CAUSAS SEGUN EL ABOGADO
=======================================================================================*/
if ($_SESSION['listado']=='abogado') 
{
  
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeabogado($_SESSION['id']);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
   /*   echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

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
               //  echo "<a style='color: $colorcausa' target='_blank' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";
                $ordenescausa.=" $varcaraorden ";
                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
   /*   echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  abogado*/








/*======================================================================================
                            LISTADO DE TODAS LAS CAUSAS SEGUN EL PROCURADOR
=======================================================================================*/
if ($_SESSION['listado']=='procurador') 
{

  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeprocurador($_SESSION['id']);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    /*  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

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
                // echo "<a style='color: $colorcausa' target='_blank' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
     /* echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  procurador*/









/*======================================================================================
                            LISTADO DE TODAS LAS CAUSAS SEGUN EL CLIENTE
=======================================================================================*/
if ($_SESSION['listado']=='cliente') 
{
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdecliente($_SESSION['id']);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    /*  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

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
               //  echo "<a style='color: $colorcausa' target='_blank' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
     /* echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   
   <th style="width:435px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  cliente*/










/*======================================================================================
                            LISTADO DE TODAS LAS CAUSAS SEGUN LA CATEGORIA
=======================================================================================*/
if ($_SESSION['listado']=='categoria') 
{
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeCategoria($_SESSION['id']);
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
     /* echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";*/

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
                 //echo "<a style='color: $colorcausa' target='_blank' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $ordenescausa.=" $varcaraorden ";

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
  /*    echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:355px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/

}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  categoria*/










/*======================================================================================
                      LISTADO DE TODAS LAS CAUSAS ORDENADOS POR CATEGORIA ASCENDENTE
=======================================================================================*/
if ($_SESSION['listado']=='porcategoria') 
{
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasOrdenadoPorCategoria();
   while ($fil=mysqli_fetch_array($resul)) 
   {
       $colorcausa='';
       $ordenescausa='';
     if ($fil['estadocausa']=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
    /*  echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='contador_ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>";*/

       /*LISTAR ORDENES D E LA CAUSA*/
               $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil['id_causa']);
               while ($filord=mysqli_fetch_object($listadoor)) 
               { 
                  if ($cont==0) 
                  {
                   // echo "<br>";
                  }
                  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
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
                // echo "<a style='color: $colorcausa' href='contador_orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";
                $ordenescausa.=" $varcaraorden ";
                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
 /*     echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";*/
$bloque2=<<<EOF
<table border="0.1px" cellpadding="1">
<thead>
<tr style="page-break-inside: avoid; color: $colorcausa;" nobr="true">
   <th style="text-align:center; width:100px;">$fil[codigo] <br> $ordenescausa </th>
   <th style="text-align:center; width:130px;">$fil[nombrecausa]</th>
   <th style="text-align:center; width:80px;">$fil[abogadogestor]</th>
   <th style="text-align:center; width:80px;">$fil[procuradorasig]</th>
   <th style="text-align:center; width:80px;">$fil[clienteasig]</th>
   <th style="text-align:center; width:80px;">$fil[Categ]</th>
   <th style="width:355px;">$fil[Observ]</th>
</tr>
</thead>
</table>
EOF;
$pdf->SetMargins(34, 30 ,2.5);
$pdf->writeHTML($bloque2,false,false,false,false,'');
  }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI LA VARIABLE SESSION ES IGUAL A  porcategoria*/



$nameFile='CausaActivas.pdf';
$pdf->Output($nameFile);

?>