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
    <title>Lista Orden Vencidas Graves</title>
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
   <input type="hidden" name="" value="<?php echo $codigonuevo ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE ORDENES VENCIDAS GRAVES</h3>
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
 $concat=$fechoyal.' '.$horita;

   $objorden=new OrdenGeneral();
   $resul=$objorden->mostrarVencidasGravesDeCausaAbog($codigonuevo);

   while ($fil=mysqli_fetch_object($resul)) 
   {  
       $fechafinorden=$fil->Fin;
       $newfechfin=date_create($fechafinorden);
       $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

       $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
       $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
       /*PREGUNTAMOS SI LA FECHA ACTUAL ES MAYOSR A LA FECHA FINAL DE LA ORDEN (SI ESTA VENCIDA LEVE)*/
       if ($fecha1>$fecha2) 
       {
         echo "<tr>";
        //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->Codorden*10987654321;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='ordenob.php?squart=$encriptado'>$fil->Codorden</a></td>";
              echo "<td>$fil->fecha_giro</td>";
              echo "<td>$fil->fecha_recepcion</td>";
               echo "<td>$fil->fecha_descargap</td>";
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

              //echo "<td>$fil->Compra</td>";
              //echo "<td>$fil->Penalidad</td>";

              //echo "<td>$fil->Costojudicompra</td>";  //dato no hay aun, este dato depende de si es suficiente la orden
             // echo "<td>$fil->Costoproccompra</td>";  //dato no hay aun, este dato depende de si es suficiente la orden

              echo "<td>$fil->procuradorasig</td>";

              $objconfir=new Confirmacion();
              $resulconfir=$objconfir->mostrarfechaconfirabogado($fil->Codorden);
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