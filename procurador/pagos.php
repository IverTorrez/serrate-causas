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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Pagos</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php



include_once('../model/clsprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');

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
         
        <div id="main_menu">
        
            <ul>
                <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first main_current">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="misCausas.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            <!--    
            <div class="container">    
            <div id="portfolio_menu">
            
                 <ul>
                    <li><button class="botones" onclick="location.href=''">FICHA</button></li> 
                    <li><button class="botones" onclick="location.href=''">LISTA DE ORDENES</button></li>   
                </ul>      
                <br>
                <br>
            </div>
  
            </div> --> 
            <!-- END .container -->      
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

   

   <!--TABLA LISTA DE DETALLE DE ORDENES PROCURADOR-->
    <div class="container">
   <section class="responsive">
    <br>
    <br>
    <h3 style="color: #000000;font-size: 25px;text-align: center;">CONSULTA DE PAGO DE PROCURADURÍA</h3>
    <br>
    <form method="post">
<table id="customers">
        <thead>
           
        </thead>
        <tbody>
        <tr>
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="fechinicio" required=""> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Inicio  <input type="time" name="horainico" required=""> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                  
                 </tr>

                  <tr>
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="fechafin" required=""> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Final <input type="time" name="horafin" required=""> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                 
                 </tr>

        
            
        </tbody>
    </table>
<input type="submit" name="btnconsultar" value="CONSULTAR">
</form>
<br>
<br>
<br>
<br>
<!--REPORTE TABLA ORDENES TERMINADAS-->
    <div class="container">
   <section class="responsive">
    
    <br>
    
       <table id="customers">

  <tr>
    <th>CODIGO CAUSA</th>
    <th width="70px">NUMERO DE ORDEN</th>
    <th>PRIORIDAD</th>
    <th>PLAZO OTORGADO</th>
    <th width="200px">COTIZACION DE LA GANANCIA DE PROCURADURIA</th>
    <th width="200px">COTIZACION DE LA SANCION DE PROCURADURIA</th>
    <th>MONTO A PAGAR</th>
  </tr>

<tbody>
<?php
$idprocurador=$datos['id_procurador'];
  $arraydeordenparapagar=array();
          error_reporting(E_ERROR);
   if (isset($_POST['btnconsultar'])) 
   {
       
     $_SESSION['arraysesion']=array();
     $_SESSION['montopago']=0;
     $_SESSION['fechapago1']="";
     $_SESSION['fechapago2']="";
     $_SESSION['idprocurador']=$_POST['selectprocu'];

    $fechini1=$_POST['fechinicio'];
    $newfechini1=date_create($fechini1);
    $fechainiformato=date_format($newfechini1, 'Y-m-d');

    $horaini=$_POST['horainico'];
    $newhoraini=date_create($horaini);
    $horainiformato=date_format($newhoraini, 'H:i');
    $fechainicompleta=$fechainiformato.' '.$horainiformato;
    
    $_SESSION['fechapago1']=$fechainicompleta;

     $fechfin=$_POST['fechafin'];
    $newfechfin1=date_create($fechfin);
    $fechafinformato=date_format($newfechfin1, 'Y-m-d');

    $horafinn=$_POST['horafin'];
    $newhorafin=date_create($horafinn);
    $horafinformato=date_format($newhorafin, 'H:i');

    $fechafincompleta=$fechafinformato.' '.$horafinformato;

    $_SESSION['fechapago2']=$fechafincompleta;
    $contador=0;
    $montoapagar=0;
    $objorden=new OrdenGeneral();
    $result=$objorden->consultaparapagoaprocurador($idprocurador);
    while($fila=mysqli_fetch_object($result))
    {
        if ($fila->fecha_cierre>=$fechainicompleta and $fila->fecha_cierre<=$fechafincompleta) {
           $contador++;
           array_push($_SESSION['arraysesion'], $fila->codorden);
            echo "<tr>";
           echo "<td>$fila->codigocausa</td>";
           echo "<td>$fila->codorden</td>";
           echo "<td>$fila->priori</td>";

           switch ($fila->condicion) 
           {
             case 1:echo "<td>mas de 96</td>"; break;
             case 2:echo "<td>24 a 96</td>"; break;
             case 3:echo "<td>8 a 24</td>"; break;
             case 4:echo "<td>3 a 8</td>"; break;
             case 5:echo "<td>1 a 3</td>"; break;
             case 6:echo "<td>0 a 1</td>"; break;
           }
           //echo "<td>$fila->condicion</td>";
           echo "<td>$fila->cotcompra</td>";
           echo "<td>$fila->cotpenalidad</td>";
           if ($fila->compraprocu==0) {
            $montoapagar=$fila->penalidadproc+$montoapagar;
             echo "<td>$fila->penalidadproc</td>";
           }
           else{
            $montoapagar=$fila->compraprocu+$montoapagar;
            echo "<td>$fila->compraprocu</td>";
           }
           
           echo "</tr>";
        }
    }
    $_SESSION['montopago']=$montoapagar;
    echo $arraydeordenparapagar[5];
  // $idproc=1;
   $objprocu=new Procurador();
   $list=$objprocu->mostrarunprocuradro($_POST['selectprocu']);
   $fi=mysqli_fetch_object($list);
   $nombreprocurador=$fi->Nombre;


   /* $id=1;
      $fechacomun=$fechini1.' '.$horaini;
      $fechainicompleta1='2019-03-22 17:40'; 
       $oborden=new OrdenGeneral();
       $lista=$oborden->consultaparapagoaprocurador($fechacomun,$id);
       while($fil=mysqli_fetch_object($lista))
       {  
           echo "<tr>";
           echo "<td>$fil->codigocausa</td>";
           echo "<td>$fil->codorden</td>";
           echo "<td>$fil->priori</td>";
           echo "<td>$fil->condicion</td>";
           echo "<td>$fil->cotcompra</td>";
           echo "<td>$fil->cotpenalidad</td>";
           echo "<td>$fil->compraprocu</td>";
           echo "</tr>";
       }*/
       echo "Reporte de órdenes terminadas desde: <b>".$fechainicompleta."</b> hasta: <b>".$fechafincompleta."</b> del procurador: <b>".$datos['nombreproc']." ".$datos['apellidoproc']."</b><br><br>";
   }/*fin de la funcion al presionar el boton consultar*/
   ?>
</tbody>

<tr>
  <td colspan="6">TOTAL A PAGAR EN ESE RANGO DE TIEMPO</td>
  <td ><?php echo $montoapagar; ?></td>
</tr>
</table>


</section>
    </div>
</section>
    </div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
