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
    <title>Entraga de Dinero </title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
        <link rel="stylesheet" type="text/css" href="../resources/tablaordenabog.css">

    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
</head>
<body>
<?php 
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clscajasdesalida.php');
include_once('../controller/control-entregarpresupuesto.php');

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/5040302010;

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
                <li class="first_list"><a href="contador_mis_causa.php" class="main_menu_first">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
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
                
                    <li><button class="botones" style="width: 300px; height: 45px;" onclick="location.href='listadeentrega.php'">LISTA DE ORDENES</button></li>
                    <?php
                    $obj=new OrdenGeneral();
                    $res=$obj->mostrarpresupuestoentregar($codigonuevo);
                    $filp=mysqli_fetch_object($res);
                    ?>

                    <form method="post">
                    <input type="hidden" name="textmonto" id="textmonto" value="<?php echo $filp->monto_presupuesto ?>">
                    <input type="hidden" name="textidorden" value="<?php echo $codigonuevo ?>">
                    <li><button class="botones" name="btnentregadinero" style="width: 300px; height: 45px;">ENTREGAR DINERO</button></li>
                    </form>

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
   
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR ORDEN</th> 
      <th rowspan="2" width="">PROCURADOR <br><p id="psubt">(GESTOR)</p></th> 
     <th rowspan="2" width="16%">PRESUPUESTO A ENTREGAR</th>
      
    </tr> 
 
    <tr style="background: #B1EF07">
     <td>NIVEL DE PRIORIDAD</td> 
     <td>PLAZO OTORGADO</td> 
    </tr> 
</thead>
<tbody>
 

   <?php
  $objorden1=new OrdenGeneral();
   $resul=$objorden1->listardetalledeordentabla1($codigonuevo);
   $fil=mysqli_fetch_object($resul); 
   echo " <tr>";
  echo "<td>$fil->codigocausa</td>";
  echo "<td>$fil->numeroorden</td>";
  echo "<td>$fil->Prioridad</td>";
   switch ($fil->Condicion) {
                case 1:echo "<td>mas de 90</td>"; break;
                case 2:echo "<td>72-90</td>"; break;
                case 3:echo "<td>48-72</td>"; break;
                case 4:echo "<td>24-48</td>"; break;
                case 5:echo "<td>8-24</td>"; break;
                case 6:echo "<td>0-8</td>"; break;        
              }
  echo "<td>$fil->procuradorasig</td>"; 
  

  $objord=new OrdenGeneral();
   $resultt=$objord->mostrarpresupuestoentregar($codigonuevo);
   $fill=mysqli_fetch_object($resultt); 

   echo "<td style='font-size: 35px;'>$fill->monto_presupuesto</td>";
  

   echo "</tr>";           
  ?>
</tbody>
</table>
</section>
<br >
<br>
<!--TABLA 2-->
<section class="responsive">
       <table id="customers">
 <thead>     
  <tr>
    <th >GIRO DE LA ORDEN</th>
    <th >INICIO DE LA VIGENCIA DE LA ORDEN</th>
    <th >FIN DE LA VIGENCIA DE LA ORDEN</th>
    <th >FECHA PRESUPUESTO</th>
    <th >ACEPTACION DEL PROCURADOR</th>
    
  </tr>
  
</thead>
<tbody>

  <?php
         $objorden2=new OrdenGeneral();
        $resul=$objorden2->listarfechasdeunaordenaentregar($codigonuevo);
    
        while ($fila=mysqli_fetch_object($resul)){
           
          echo "<tr>"; 
          echo "<td>$fila->fecha_giro</td>";
          echo "<td>$fila->Inicio</td>";
          echo "<td>$fila->fin</td>";
          echo "<td>$fila->fecha_presupuesto</td>";
          echo "<td>$fila->fecha_recepcion</td>";
          
          echo "</tr>";


        }


         ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 3-->
<section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">ELEMENTOS DE LA ORDEN</h3>
    <!--METODOS PARA LISATAR LAS CARGAS DE UNA ORDEN-->
    <?php
 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila=mysqli_fetch_object($resul);
?>

<!--METODO PARA LISTAR LAS DESCARGAS DE UNA ORDEN-->
<?php
 $objdesc=new DescargaProcurador();
$result=$objdesc->mostrardescargaorden($codigonuevo);
$fild=mysqli_fetch_object($result);
?>

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">INFORMACION</th>
  </tr>
  <tr  style="background: #B1EF07">  
    <td width="50%">CARGA  DE  INFORMACION  </td>
    <td width="50%">DESCARGA DE INFORMACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fila->informacion</td>";

    echo "<td>$fild->detalle_informacion</td>";
    ?>
   
  </tr>
 
</tbody>
</table><br>

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">DOCUMENTACION</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">CARGA  DE  DOCUMENTACION   </td>
    <td width="50%">DESCARGA DE DOCUMENTACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fila->documentacion</td>";

    echo "<td>$fild->documentaciondescarga</td>";
    ?>
   
  </tr>
 
</tbody>
</table><br>
 <table id="customers">
 <thead>     
  <tr>
    <th colspan="3">DINERO</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">PRESUPUESTO</td>
    <td width="25%">GASTO</td>
    <td width="25%">SALDO</td>
  
  </tr>

</thead>


<tbody>
  <tr>

<?php
$objpresupuesto=new Presupuesto();
$list=$objpresupuesto->mostrarpresupuesto($codigonuevo);
$fila1=mysqli_fetch_object($list);

  echo "<td>$fila1->monto_presupuesto</td>";
 
 ///DESCARGA DEL DINERO GASTADO Y EL SALDO DE LA ORDEN
   echo "<td>$fild->gastos</td>";

   echo "<td>$fild->saldo</td>";

?>


    
   
  </tr>
 </tbody>
</table>
<table id="customers">
 <thead>     
<tr>  
    <th width="50%">DETALLE DEL PRESUPUESTO A GASTAR (CARGA DE DINERO)</th>
    <th width="50%">DETALLE DEL DINERO GASTADO (DESCARGA DE DINERO)</th>
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
   
     <?php
    echo "<td>$fila1->detalle_presupuesto</td>";

///DETALLE DEL GASTO DEL DINERO
   echo "<td>$fild->detalle_gasto</td>";

    ?>
  
  </tr>
 
</tbody>
</table>
</section>
<br>


    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
