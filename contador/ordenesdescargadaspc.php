<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["contador"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["contador"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ordenes Descargadas</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablalistordenab.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
include_once('../model/clsordengeneral.php');
$codcausa=$_GET['squart']; 
//SE DESENCRIPTA EL CODIGO DE LA CAUSA PARA PODER USARLO // 
$decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/12345678910;
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
        
        <h2 id="portfolio">USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</h2>
        <div id="main_menu">
        
            <ul>
                <li class="first_list"><a href="" class="main_menu_first">AVANCE FISICO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                
                <li class="first_list"><a href="contador_mis_causa.php" class="main_menu_first">CAUSAS ACTIVAS</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
           
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">

  <input type="hidden" name="" value="<?php echo $codigonuevo ?>">
   <section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE ORDENES DESCARGADAS</h3>
    <br>
    <!--TABLA 1-->

</section>

<!--TABLA 2-->
<section class="responsive">
       <table id="customers">
 <thead>     
  <tr>
    <th width="130px"># DE ORDEN</th>
    <th width="170px">FECHA DE GIRO</th>
    <th width="160px">FECHA DE RECEPCION DE ORDEN</th>
    <th width="160px">FECHA DE DESCARGA</th>
    <th width="160px">FECHA DE INICIO DE VIGENCIA</th>
    <th width="160px">FECHA DE TERMINO DE VIGENCIA</th>
    <th width="100px">PRIORIDAD</th>   
    <th width="100px">PLAZO (Hrs)</th>
   
   
    
   
  </tr>
</thead>
<tbody>


<?php
   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesparaabprobardinero($codigonuevo);
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->codigo*10987654321;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='calificarorden.php?squart=$encriptado'>$fil->codigo</a></td>";
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
             ////////CODIGO QUE MUESTRA LA FECHA DE DESCARGA DE UNA ORDEN
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

                            
            //  echo "<td>$fil->procuradorasig</td>";

              

            
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