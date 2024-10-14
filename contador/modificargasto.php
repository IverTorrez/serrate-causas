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
    <title>Modificar Gasto</title>
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
include_once('../model/clsconfirmacion.php');

include_once('../controller/control-descargaproc.php');

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/10987654321;

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
            
           
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">
   <section class="responsive">
   <input type="text" name="" value="<?php echo $codigonuevo ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR ORDEN</th>  
     <th rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
     <th rowspan="2" width="">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>  
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
          $objdesc=new DescargaProcurador();
    $resultado=$objdesc->mostrarfojadescarga($codigonuevo);
   $filafoja=mysqli_fetch_object($resultado); 
       
   echo "<td>$filafoja->ultima_foja</td>";
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->


<!--TABLA 3-->
<section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">ELEMENTOS DE LA ORDEN</h3>
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
if ($fila1->id_presupuesto==null) {
  echo "<td> <a href='contador_presupuestar.php?squart=$codorden'> 00</a></td>";
}
else{
  echo "<td>$fila1->monto_presupuesto</td>";
}

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
<form method="post">
 <center>
   <input type="text" name="textidorden" id="textidorden" value="<?php echo $codigonuevo; ?>"> 
   <input type="text" name="textiddescarga" id="textiddescarga" value="<?php echo $fild->id_descarga; ?>">
   <input type="text" name="textnuevogasto" id="textnuevogasto" placeholder="Coloque el nuevo gasto"></center>
  <input type="submit" name="btnmodgasto" id="btnmodgasto" value="MODIFICAR">
</form>
</section>
<br>


    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
