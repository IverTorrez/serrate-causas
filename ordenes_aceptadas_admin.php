<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["useradmin"]))
{
  header("location:index.php");
}
$datos=$_SESSION["useradmin"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Ordenes Aceptadas ADMIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

  
</head>
<body>
<?php

include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');

include_once('model/clsdeposito.php');
include_once('model/clspresupuesto.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsconfirmacion.php');
include_once('model/clscostofinal.php');

 $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";
?>
    <div id="header">
        
        <div class="container">
        
        <?php
        include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        
         <p id="codcausas"><?php echo $fil->codigo; ?> </p>
         <div id="main_menu_admin">
            <ul>
               
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
                
               

                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" style="width: 200px;" onclick="location.href='ficha.php?squart=<?php echo $codcausa; ?>'">VOLVER A LA FICHA</button></li>
                    
                    
                </ul>
                
               
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
     <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
    
<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ORDENES ACEPTADAS DEL ADMINISTRADOR</h3>    
    <br>



<section class="responsive">
<table id="tablalistaordenadm">
 <thead> 
   
  
</thead>

<tr id="fila1">
    <td id="tdorden" rowspan="4"  width="100px"># DE ORDEN</td>
    <td id="tdorden" colspan="10">FECHAS</td>
    <td id="tdorden" colspan="5">COTIZACION</td>
    <td id="tdorden" colspan="5">FINANZAS</td>
    <td id="tdorden" rowspan="4"  width="250px">PROCURADOR <br><p id="psubt">(GESTOR)</p></td>
    <td id="tdorden" rowspan="4"  width="130px">CALIFICACION <br><p style="font-size: 12px;">(SUFICIENTE/INSUFICIENTE)</p></td>
   
  </tr>
<tr id="fila2">
<td id="tdorden" colspan="4">FECHAS DE CARGA</td>
<td id="tdorden" rowspan="3" width="120px">FECHA DE DESCARGA</td>
<td id="tdorden" colspan="2">VIGENCIA DE LA ORDEN</td>
<td id="tdorden" colspan="3">MOMENTOS  PARA EL CIERRE  DE LA ORDEN </td>
<td id="tdorden" colspan="2">PARAMETROS USADOS PARA COTIZAR ESTA ORDEN </td>
<td id="tdorden" colspan="3">COTIZACIÓN DE PROCURADURIA</td>
<td id="tdorden" colspan="2">COSTO JUDICIAL Bs.-</td>
<td id="tdorden" colspan="2">COSTO DE PROCURADURÍA Bs.-</td>
<td id="tdorden" rowspan="3"  width="120px">TOTAL EGRESO <br> <p>(para el cliente) </td>
</tr>

<tr id="fila3">
  <td id="tdorden" colspan="2">INFORMACION  Y DOCUMENTACIÓN </td>
  <td id="tdorden" colspan="2">DINERO</td>
  <td id="tdorden" rowspan="2" width="120px">INICIO</td>
  <td id="tdorden" rowspan="2" width="120px">FIN</td>
  <td id="tdorden" colspan="2">FECHAS DE PRONUNCIAMIENTOS</td>
  <td id="tdorden" rowspan="2" width="120px">FECHA OFICIAL DE CIERRE</td>
  <td id="tdorden" rowspan="2" width="80px">NIVEL DE PRIORIDAD</td>
  <td id="tdorden" rowspan="2" width="100px">PLAZO EN HORAS</td>
  <td id="tdorden" rowspan="2" width="80px">COMPRA</td>
  <td id="tdorden" rowspan="2" width="80px">VENTA</td>
  <td id="tdorden" rowspan="2" width="80px">PENALIDAD</td>
  <td id="tdorden" rowspan="2" width="60px">COMPRA </td>
  <td id="tdorden" rowspan="2" width="60px">VENTA</td>
  <td id="tdorden" rowspan="2" width="150px">COMPRA <br> <p>(para el procurador)</p></td>
  <td id="tdorden" rowspan="2"  width="150px">VENTA <br> <p>(para el cliente)</p></td>
</tr>

<tr id="fila4">
  <td id="tdorden" width="120px">GIRO</td>
  <td id="tdorden" width="120px">PRESUPUESTO</td>
  <td id="tdorden" width="120px">CARGA MATERIAL DE INFORMACION Y DOCUMENTACION</td>
  <td id="tdorden" width="120px" >ENTREGA DE DINERO</td>
  <td id="tdorden" width="120px">DEL ABOGADO</td>
  <td id="tdorden" width="120px">DEL CONTADOR</td>
</tr>

<?php
       ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita;

  $totalcostojudicompra=0;
  $totlacostojudiventa=0;
  $totalparaprocurador=0;
  $totalventaprocurador=0;
  $totalegreso=0;
   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesDeAdminAceptadasDeunaCausa($codigonuevo);
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


          $fechafinorden=$fil->fin;
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
            $mascara=$fil->codigo*10987654321;
             $encriptado=base64_encode($mascara);
              /*VERIFICA SI LA ORDEN ESTA PREDATADA POR VERDADERO MUESTA LA FILA DE COD ORDEN NOMALMENTE*/
             if ($fil->Inicio<=$concat)
             {
                echo "<td class='tdcod'><a style='color:$fontcolor;' href='ordenadmin.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
             else/*POR FALSO MUESTA EL CODIGO CON UN * AL LADO*/
             {
               echo "<td class='tdcod'>*<a style='color:$fontcolor;' href='ordenadmin.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
              
              echo "<td> $fil->fecha_giro</td>";

          //
             ini_set('date.timezone','America/La_Paz');
            $fechoyal=date("Y-m-d");
            $horita=date("H:i");
            $concat=$fechoyal.' '.$horita; 

         ////CODIGO PARA COMPARACION DE HORAS//////////////////////////////////////////////////////////////////
            $fec=$fil->fin;
            $newfec=date_create($fec);
           $formatofechafin=date_format($newfec, 'Y-m-d H:i');

            $fecha1 =new DateTime($concat);//fecha y hora del sistema
            $fecha2 =new DateTime($formatofechafin); //FECHA Y HORA DE TERMINO DE VIGENCIA DE LA ORDEN
            $intervalo= $fecha1->diff($fecha2);

            //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
         $diasentero=intval($intervalo->format('%d'));
         $horaentero=intval($intervalo->format('%H'));
         $minutos=intval($intervalo->format('%i'));

/// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
         $totaldeminh=$horaentero*60;
         $totalminDia=$diasentero*1440;

        // /SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
    $resultadomin=$totaldeminh+$totalminDia+$minutos;
   
   ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
    $resultadohora=$resultadomin/60;
          
          if ($fecha1>$fecha2) {
            $msm='orden vencida';
          }
          else{
            $msm='hay vigencia';
          }

 /////////////////////////////////////////////////////////////////////////////////////////////////////  
         $objpresup=new Presupuesto();
              $listado=$objpresup->mostrarfechaspresupuestoyentrega($fil->codigo);
              $filapres=mysqli_fetch_object($listado);

             echo "<td>$filapres->fecha_presupuesto</td>";
                    

             // echo "<td>$fil->fecpresupuesto</td>";//aun no hay ni en la consulta, dato aleatoria
              echo "<td>$fil->fecha_recepcion</td>"; //hay en la consulta, pero esta vacia
              echo "<td>$filapres->fecha_entrega</td>"; 

              $objdesc=new DescargaProcurador();
              $resultado=$objdesc->mostrarfechadescarga($fil->codigo);
              $filafe=mysqli_fetch_object($resultado);

               echo "<td>$filafe->fecha_descarga</td>";

              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->fin</td>";

              $objconfir=new Confirmacion();
              $resp=$objconfir->mostrarfechasdeconfirmacion($fil->codigo);
              $filaco=mysqli_fetch_object($resp);


               echo "<td>$filaco->fecha_confir_abogado</td>";//aun no hay ni en la consulta, dato aleatoria
                echo "<td>$filaco->fecha_confir_contador</td>";//aun no hay ni en la consulta, dato aleatoria

                echo "<td>$fil->fecha_cierre</td>"; //hay en la consulta, pero esta vacia
             
              echo "<td>$fil->prioridad</td>";
              switch ($fil->condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;
                
              }

           

              echo "<td>$fil->Compra</td>";   
              echo "<td>$fil->Venta</td>"; 
              echo "<td>$fil->Penalidad</td>";

              $obdesc=new DescargaProcurador();
              $resss=$obdesc->mostrardescargaorden($fil->codigo);
              $filadd=mysqli_fetch_object($resss);

              $totalcostojudicompra=$filadd->comprajudicial+$totalcostojudicompra;

              echo "<td>$filadd->comprajudicial</td>";//ES LO QUE GASTO EL PROCURADOR(COSTO JUDICIAL COMPRA)

              $obcosf=new Costofinal();
              $ls=$obcosf->mostrarcostosdeunaorden($fil->codigo);
              $filc=mysqli_fetch_object($ls);

              $totlacostojudiventa=$filc->costo_procesal_venta+$totlacostojudiventa;

              echo "<td>$filc->costo_procesal_venta</td>";//ES LO QUE LE COBRAMOS POR EL COSTO JUDICIAL
              
              $obcc=new Costofinal();
              $ll=$obcc->mostrarcompraparaprocuradr($fil->codigo);
              $filcc=mysqli_fetch_object($ll);

              $totalparaprocurador=$filcc->Compraproc+$totalparaprocurador;

              echo "<td>$filcc->Compraproc</td>";//muestra el costo de procuradoria, sea positivo o negativo

              $totalventaprocurador=$filc->costo_procuradoria_venta+$totalventaprocurador;
              echo "<td>$filc->costo_procuradoria_venta</td>";//muestra lo que le cobramos al cliente por el procurador

              $totalegreso=$filc->total_egreso+$totalegreso;

              echo "<td>$filc->total_egreso</td>";//muestra todo lo que lecosto al cliente hacer esa orden 

              echo "<td>$fil->procuradorasig</td>";

               echo "<td>$fil->calificacion_todo</td>";

            
        echo "</tr>";
          }
  ?>




<tbody>

 
</tbody>
</table>
</section>
   

   

   <!--SECCION PARA MOSTRAR LAS TRANSFERENCIAS-->
    

    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
