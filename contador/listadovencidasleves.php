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
    <title>Ordenes Vencidas Leves</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablalistordenab.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
include_once('../model/clsordengeneral.php');
include_once('../model/clscausa.php');
$codcausa=$_GET['squart']; 
//SE DESENCRIPTA EL CODIGO DE LA CAUSA PARA PODER USARLO // 
$decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/12345678910; 

    $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";
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
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
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
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE ORDENES VENCIDAS LEVES</h3>
    <br>
    <!--TABLA 1-->

<section class="responsive">
    <!--TABLA 1-->
       <table id="tblistordencontador">
    
 <thead>     
  <tr>
    <th width="100px"># DE ORDEN</th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(MONTO ENTREGADO)</p></th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(MONTO GASTADO)</p></th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(SALDO POR DEVOLVER)</p></th>
    <th width="150px">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>

    <th width="140px">FECHA DE GIRO DE LA ORDEN</th>
    <th width="140px">FECHA DE PRESUPUESTO</th>
    <th width="140px">FECHA DE ENTREGA DE DINERO</th>
    <th width="140px">FECHA DE DESCARGA</th>
    <th width="140px">FECHA DE INICIO DE VIGENCIA</th>
    <th width="140px">FECHA DE TERMINO DE VIGENCIA</th>
    
  </tr>
</thead>
<tbody>
  

  <?php
  ini_set('date.timezone','America/La_Paz');
 $fechoyal=date("Y-m-d");
 $horita=date("H:i");
 $concat=$fechoyal.' '.$horita;

   $objorden=new OrdenGeneral();
   $resul=$objorden->mostrarOrdenVencidasLevesDeCausaCont($codigonuevo);

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
              echo "<td class='tdcod'><a href='contador_orden.php?squart=$encriptado'>$fil->Codorden</a></td>";
              echo "<td>$fil->monto_presupuesto</td>";
              echo "<td>$fil->gastos</td>";
              echo "<td>$fil->saldo</td>";
              echo "<td>$fil->procuradorasig</td>";
               echo "<td>$fil->fecha_giro</td>";
               echo "<td>$fil->fecha_presupuesto</td>";
               echo "<td>$fil->fecha_entrega</td>";

               echo "<td>$fil->fecha_descarga</td>";
              
              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->Fin</td>";
             


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