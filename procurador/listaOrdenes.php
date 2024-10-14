<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR*/
if(!isset($_SESSION["procurador"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procurador"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>lista De Ordenes</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablalistordenproc.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php

include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsdescarga_procurador.php');

 $codcausa=$_GET['squart'];

    //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevocausa=$decodificado/1213141516;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevocausa);
   $fil=mysqli_fetch_object($resul);
  //  echo "<td style='width: 10%;'>$fil->codigo</td>";
?>
    
    <div id="header">
        
        <div class="container">
        
        <?php
        include_once('../model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="../resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='../fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        
        <p id="codcausas"><?php echo $fil->codigo; ?> </p>
        <div id="main_menu">
        
            <ul>
                 <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="misCausas.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">    
            <div id="portfolio_menu">
                
                 <ul>
                    <li><button style="height: 45px;" class="botones" onclick="location.href='ficha.php?squart=<?php echo $codcausa; ?>'">VOLVER A LA FICHA</button></li>   
                </ul>       
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

   <!--TABLA LISTA DE ORDENES PROCURADOR-->
    <div class="container">

   <section class="responsive">
   <input type="hidden" name="" value="<?php echo $codigonuevocausa; ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE ORDENES</h3>
    <br>
    <!--TABLA 1-->

</section>
   
    <br>
    
       <table id="customers">

  <tr id="fila1">
    <th colspan="1" rowspan="4" width="13%"># ORDEN</th>
    <th colspan="1" rowspan="4" width="13%"">FECHA GIRO</th>
    <th colspan="2">VIGENCIA DE ORDEN</th>
    <th colspan="4">COTIZACION</th>
    <th colspan="2">FINANZAS</th>
    
    
  </tr>
 

  <tr id="fila2">
    <td rowspan="3" width="13%"">INICIO</td>
    <td rowspan="3" width="13%"">FIN</td>
   </tr>
<tr id="fila2">
  <td colspan="2" rowspan="1">PARAMETROS</td>
  <td colspan="2" rowspan="1">COTIZACION</td>
  <td rowspan="4" width="8%">COSTO JUDICIAL</td>
  <td rowspan="4" width="8%">COSTO DE PROCURADURIA</td>
</tr>
<tr id="fila2">
    <td width="8%">NIVEL PRIORIDAD</td>
    <td width="8%">PLAZO EN HORAS</td>
    <td width="8%">GANANCIA</td>
    <td width="8%">SANCION</td>
</tr>
<tbody>


 <?php
 $idproc=$datos['id_procurador'];  //id_procurador CODIGO DEL PROCURADOR
       ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita;

   $objorden=new OrdenGeneral();
   $resul=$objorden->listarOrdenesDeProcuradorDeunaCausaparaproc($codigonuevocausa,$idproc);
   while ($fil=mysqli_fetch_object($resul)) 
   {
      /*PARA EL COLOR A LAS FILAS DEPENDIENDO DE SU URGENCIA*/
      if ($fil->estado_orden=='Serrada')/*PREGUNTA SI ESTA SERRADA LA ORDEN*/ 
      {
       $backgroundfila='white'; 
       $fontcolor='#000000';
      }
      else/*POR FALSO*/
      {


          $fechafinorden=$fil->Fin;
          $newfechfin=date_create($fechafinorden);
          $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

          $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
          $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
          if ($fecha1>$fecha2)/*PREGUNTA SI LA ORDEN ESTA VENCIDA*/ 
              {
                $vard='R';
                $varconcat=$vard.$prioriorden;

                $varcaraorden="<strike>$varconcat</strike>";

                $totaltiempoexpirar=0;
                $tiempo=0;
                $backgroundfila='#ffffff';
                $fontcolor='#b7b3b3';
              }
          else
          {
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
                      $tiempo=$resultadohora;
                      $fontcolor='#000000';
                      if ($resultadohora>96) 
                      {
                        $backgroundfila='#D0E2D1'; 
                      }
                      if ($resultadohora>24 and $resultadohora<=96) 
                      {
                        $backgroundfila='#42A4D2'; 
                      }
                      if ($resultadohora>8 and $resultadohora<=24) 
                      {
                        $backgroundfila='#39B743'; 
                      }
                      if ($resultadohora>3 and $resultadohora<=8) 
                      {
                        $backgroundfila='#F5EB0F'; 
                      }
                      if ($resultadohora>1 and $resultadohora<=3) 
                      {
                        $backgroundfila='#F5860F'; 
                      }
                      if ($resultadohora>0 and $resultadohora<=1) 
                      {
                        $backgroundfila='red'; 
                      }

                      

          }
        }/*FIN DEL ELSE CUANDO UNA ORDEN NO ESTA SERRADA*/
     /*HASTA AQUI PONE LOS COLORES DE SU URGENCIAS*/


     
       echo "<tr style='background: $backgroundfila; color:$fontcolor;'>";
        //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->Codorden*1020304050;
             $encriptado=base64_encode($mascara);
              /*VERIFICA SI LA ORDEN ESTA PREDATADA POR VERDADERO MUESTA LA FILA DE COD ORDEN NOMALMENTE*/
              if ($fil->Inicio<=$concat) 
              {
                echo "<td class='tdcod'><a style='color:$fontcolor;' href='orden.php?squart=$encriptado'>$fil->Codorden</a></td>";
              }
              else/*POR FALSO MUESTA EL CODIGO CON UN * AL LADO*/
              {
               echo "<td class='tdcod'>*<a style='color:$fontcolor;' href='orden.php?squart=$encriptado'>$fil->Codorden</a></td>"; 
              }
              
              echo "<td>$fil->fecha_giro</td>";
              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->Fin</td>";
              echo "<td>$fil->Prioridad</td>";
              
             
             switch ($fil->Condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;        
              }

              echo "<td>$fil->Compra</td>";
              echo "<td>$fil->Penalidad</td>";

              $objdescarga=new DescargaProcurador();
              $resultdescarga=$objdescarga->mostrardescargaorden($fil->Codorden);
              $fildescarga=mysqli_fetch_object($resultdescarga);


              echo "<td>$fildescarga->gastos</td>";  //ES EL DATOS DE GASTO DE LA DESCARGA, LO QUE LE CUESTA A LA EMPRESA HACER ESA ORDEN

              $objorden2=new OrdenGeneral();
              $resulorden2=$objorden2->muestraCalificacionOrden($fil->Codorden);
              $filcalif=mysqli_fetch_object($resulorden2);
              if ($filcalif->calificacion_todo!='') 
              {
                  if ($filcalif->calificacion_todo=='Suficiente') 
                  {
                    echo "<td>$fil->Compra</td>"; 
                  }
                  else
                  {
                    echo "<td>$fil->Penalidad</td>";
                  }
              }
              /*AUN NO SE A SERRADO LA ORDEN*/
              else
              {
                echo "<td></td>";  
              }

              

              //echo "<td>$fil->procuradorasig</td>";



        echo "</tr>";
   }/*FIN DEL WHILE QUE ENLISTA LAS ORDENES*/
    ?>


</tbody>
</table>

    </div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
   /* $(function() {
  var f = function() {
    $(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
  };
  $('input').change(f).trigger('change');
});*/
</script>