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
    <title>ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablafichaproc.css">
    <!--<link rel="stylesheet" type="text/css" href="../../resources/formularios.css">-->
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php

include_once('../model/clscausa.php');
include_once('../model/clstribunal.php');

include_once('../model/clsdemandante_demandado.php');
include_once('../model/clscuerpoexpediente.php'); 

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

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
                    <li><button style="height: 45px;" class="botones" onclick="location.href='listaOrdenes.php?squart=<?php echo $codcausa ?>'">LISTA DE ORDENES</button></li>
                    <li><button style="height: 45px;" class="botones" onclick="location.href='historigrama.php?squart=<?php echo $codcausa; ?>'">VER HISTORIGRAMA</button></li>
                    <li><button style="height: 45px;" class="botones" onclick="window.open('impresiones/pdf/ficha_causa.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR FICHA</button></li>    
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

   <!--TABLA FICHA PROCURADOR-->
  <div class="container">

                             <!--TABLA CODIGO DE LA CAUSA-->



   <section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">FICHA</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
  <tr>
    <th width="14%">CODIGO</th>
    <th>PROCESO</th>
    <th width="19%">ABOGADO</th>
    <th width="19%">CLIENTE</th>
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->fichacausa($codigonuevocausa);
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
              echo "<td>$fil->codigo</a></td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->clienteasig</td>";
              echo "<td>$fil->procuradorasig</td>";
              
           
        echo "</tr>";
          }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->
<section class="responsive">
       <table id="tablafichaproc">
 <thead>     
  <tr>
    <th width="170px">FISIOLOGIA DEL TRIBUNAL</th>
    <th width="400px">NOMBRE DE TRIBUNAL</th>
    <th width="70px">VER UBICACION</th>
    <th width="100px">VER FOTO DE FACHADA</th>
    <th width="50px">PISO</th>
    <th width="100px"># DE EXP.</th>
    <th width="100px">EXPEDIENTE DIGITAL</th>
   
    <th width="100px">CODIGO JURIDICO</th>
    <th width="400px">CONTACTO 1</th>
    <th width="400px">CONTACTO 2</th>
    <th width="400px">CONTACTO 3</th>
    <th width="400px">CONTACTO 4</th>
  </tr>
</thead>
<tbody>
  <?php
  $objtibunal=new Tribunal();
  $lista=$objtibunal->listartribunalficha($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)) {
       echo "<tr>";
              echo "<td>$fil->tptribu</td>";
              echo "<td>$fil->juzg</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='../fotos/fotosjuzgados/$fil->fotojuz' target='blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td>$fil->Pis</td>";
              echo "<td>$fil->expediente</td>";
              echo "<td>";
              ?>

                        <select name='selectcuerpo' onchange="window.open(this.value)">
                           <option value="">Seleccione</option>
                          <?php
                          $objcuerpo=new CuerpoExpediente();
                          $resulcuerpo=$objcuerpo->mostrarLosCuerposDeExpedientesDeTribunal($fil->id_tribunal);
                          while($filcu=mysqli_fetch_array($resulcuerpo))
                          {
                            echo '<option value="'.$filcu['linkcuerpo'].'">'.$filcu['nombrecuerpo'].'</option>';
                          }
                          ?>
                         </select>
              <?php
              echo "</td>";
              
              echo "<td>$fil->codnurejianuj</td>";
              echo "<td>$fil->cont1</td>";
              echo "<td>$fil->cont2</td>";
              echo "<td>$fil->cont3</td>";
              echo "<td>$fil->cont4</td>";
           
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
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">DEMANDANTE</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    
  </tr>
</thead>
<tbody>
    <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandante($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 4-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">DEMANDADO</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
   
  </tr>
</thead>
<tbody>
   <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandado($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>

<!--TABLA TERCERISTA-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">TERCERISTA</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
   
  </tr>
</thead>
<tbody>
  <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listartercerista($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
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
 <table id="customers">
 <thead>     
  <tr>
    <th>OBSERVACIONES</th>
  </tr>
</thead>
<tbody>
  <?php
  $objcausa=new Causa();
  $lista=$objcausa->mostrarobservaciones($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
           echo "<td>$fil->obsevacionescausas</td>";
        echo "</tr>";
      }
  ?>
</tbody>
</table>

</section>


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