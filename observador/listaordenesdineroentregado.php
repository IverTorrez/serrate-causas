<?php
error_reporting(E_ERROR);
session_start(); 
/*OBSERVADOR*/
if(!isset($_SESSION["userObs"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["userObs"]; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista Orden Con Dinero Entregado</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablalistordenobs.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clsconfirmacion.php');
include_once('../model/clsordengeneral.php'); 
?> 
<?php
  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

   $codcausa=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/12345678910;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

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
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Observador</a></li>
                
                <li class="first_list" ><a href="miscausasob.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul>
                    <li><button style="height: 45px;" class="botones" onclick="location.href='fichacausaob.php?squart=<?php echo $codcausa; ?>'">VER FICHA</button></li>
                   
                   
                 
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">
   <section class="responsive">
   <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE ORDENES CON DINERO ENTREGADO</h3>
    <br>
    <!--TABLA 1-->

</section>

<!--TABLA 2-->
<section class="responsive">
       <table id="tablalistordenobs">
 <thead>     
  <tr>
    <th width="100px"># DE ORDEN</th>
    <th width="160px">FECHA DE GIRO</th>
    <th width="150px">FECHA DE RECEPCION DE ORDEN</th>
    <th width="150px">FECHA DE DESCARGA</th>
    <th width="150px">FECHA DE INICIO DE VIGENCIA</th>
    <th width="150px">FECHA DE TERMINO DE VIGENCIA</th>
    <th width="70px">PRIORIDAD</th>
    
    <th width="70px">PLAZO (Hrs)</th>
    <th width="200px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="200px">PRONUNCIAMIENTO DEL ABOGADO</th>
    
   
  </tr>
</thead>
<tbody>


<?php
      ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita;
       
   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesdineroentregadodeunacausa($codigonuevo);
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
              echo "<td class='tdcod'><a style='color:$fontcolor;' href='ordenob.php?squart=$encriptado'>$fil->codigo</a></td>";
              echo "<td>$fil->fecha_giro</td>";

          //
             ini_set('date.timezone','America/La_Paz');
            $fechoyal=date("Y-m-d");
            $horita=date("H:i");
            $concat=$fechoyal.' '.$horita;

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

              

              echo "<td>$fil->fecha_recepcion</td>";
              ///////CODIGO QUE MUESTRA LA FECHA DE DESCARGA DE UNA ORDEN
              $objord=new OrdenGeneral();
              $list=$objord->mostrarfechadescarga($fil->codigo);
              $fildes=mysqli_fetch_object($list);

              echo "<td>$fildes->fecha_descarga</td>";
              /////////////////////////////////
             
              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->fin</td>";
             
              echo "<td>$fil->prioridad</td>";
              switch ($fil->condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;
                
              }

                            
              echo "<td>$fil->procuradorasig</td>";

              $objconfir=new Confirmacion();
              $resulconfir=$objconfir->mostrarfechaconfirabogado($fil->codigo);
              $filaconfir=mysqli_fetch_object($resulconfir);
              if ($filaconfir->fecha_confir_abogado!='') 
              {
                if ($filaconfir->confir_abogado==1) 
                {
                  $pronuncioabogado="Aprovado";
                }
                else
                {
                  $pronuncioabogado="Rechazado";
                }
              }
              else
              {
                $pronuncioabogado="";
              }

               echo "<td>$pronuncioabogado</td>";

            
        echo "</tr>";
          }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>



    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>