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
    <title>ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablafichaobs.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clstribunal.php');
include_once('../model/clsdemandante_demandado.php');
include_once('../model/clscuerpoexpediente.php'); 
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
                    <li><button style="width: 200px; height: 45px;" class="botones" onclick="location.href='listaordenob.php?squart=<?php echo $codcausa; ?>'">LISTA DE ORDENES</button></li>
                
                    <li><button style="width: 200px; height: 45px;" class="botones" onclick="window.open('impresiones/pdf/ficha_causa.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR TODO</button></li>
                    <li><button style="width: 300px; height: 45px;" onclick="location.href='avancefisico.php?squart=<?php echo $codcausa; ?>'" class="botones">ACTUALIZAR EL AVANCE FISICO</button></li>
                 
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
    <h3 style="color: #000000;font-size: 25px;text-align: center;">FICHA</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
  <tr>
    <th width="14%">CODIGO</th>
    <th>NOMBRE DEL PROCESO</th>
    <th width="19%">ABOGADO</th>
    <th width="19%">CLIENTE</th>
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->fichacausa($codigonuevo);
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
       <table id="tablafichaobs">
 <thead>     
  <tr>
    <th width="150px">FISIOLOGIA DEL TRIBUNAL</th>
    <th width="400px">NOMBRE DE TRIBUNAL</th>
    <th width="90px">VER UBICACION</th>
    <th width="100px">VER FOTO DE FACHADA</th>
    <th width="60px">PISO</th>
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
  $lista=$objtibunal->listartribunalficha($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)) {
       echo "<tr>";
              echo "<td>$fil->tptribu</td>";
              echo "<td>$fil->juzg</td>"; 
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='../fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
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
  $lista=$obdem->listardemandante($codigonuevo);
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
    <th >ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
 
  </tr>
</thead>
<tbody>
 
   <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandado($codigonuevo);
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
    <th >ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
 
  </tr>
</thead>
<tbody>
 
   <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listartercerista($codigonuevo);
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

 <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" onclick="location.href='agregarobservacion.php?squart=<?php echo $codcausa ?>'">AGREGAR OBSERVACION</button></li>
                    <li><button class="botones" onclick="location.href='agregarobjetivos.php?squart=<?php echo $codcausa ?>'">AGREGAR OBJETIVOS</button></li>
                    <li><button class="botones" onclick="location.href='agregarestrategiasob.php?squart=<?php echo $codcausa ?>'">AGREGAR ESTRATEGIA</button></li>
                   
                   
                 
                </ul><br><br>
                
            </div> <!-- END #portfolio_menu -->

<h3 style="color: #000000;font-size: 25px;text-align: center;">EL ESPACIO DE LA CAUSA</h3><br>

<h3><b> Observaciones Públicas.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th>OBSERVACIONES</th>
  </tr>
</thead>
<tbody>
 <?php
  $objcausa=new Causa();
  $lista=$objcausa->mostrarobservaciones($codigonuevo);
      $fil=mysqli_fetch_object($lista);
        echo "<tr id='filaprosa'>";
           echo "<td>$fil->obsevacionescausas</td>";
        echo "</tr>";
      
  ?>
 
</tbody>
</table><br>

<h3><b>Objetivos (Pretensión Jurídica).-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th>OBJETIVOS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->objetivos</td>";
    ?>
  </tr>
  </tbody>
</table><br>


<h3><b>Estrategias (Guion Jurídico a seguir).-</b></h3>
<table id="customers">
 <thead>     
  <tr>
    <th>ESTRATEGIAS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->estrategias</td>";
    ?>
  </tr>
 
</tbody>
</table><br>
<!--=========================================DESDE AQUI EL OBSERVADOR NO PUEDE VER================-->
<!--<h3><b>Apuntes Jurídicos.-</b></h3>-->
<!-- <table id="customers">-->
<!-- <thead>     -->
<!--  <tr>-->
<!--    <th style="background: #60d261;">APUNTES JURIDICOS</th>-->
<!--  </tr>-->
<!--</thead>-->
<!--<tbody>-->
<!--  <tr id="filaprosa">-->
     <?php
    // echo "<td>$fil->apuntesjuridicos</td>";
    ?>
<!--  </tr>-->
 
<!--</tbody>-->
<!--</table><br>-->


<!--<h3><b>Apuntes sobre honorarios.-</b></h3>-->
<!-- <table id="customers">-->
<!-- <thead>     -->
<!--  <tr>-->
<!--    <th style="background: #60d261;">HONORARIOS</th>-->
<!--  </tr>-->
<!--</thead>-->
<!--<tbody>-->
<!--  <tr id="filaprosa">-->
   <?php
    // echo "<td>$fil->apunteshonorarios</td>";
    ?>
<!--  </tr>-->
 
<!--</tbody>-->
<!--</table><br>-->


<!--<h3><b>Apuntes sobre otra información de la causa.-</b></h3>-->
<!-- <table id="customers">-->
<!-- <thead>     -->
<!--  <tr>-->
<!--    <th style="background: #60d261;">OTRA INFORMACION</th>-->
<!--  </tr>-->
<!--</thead>-->
<!--<tbody>-->
<!--  <tr id="filaprosa">-->
    <?php
    // echo "<td>$fil->informacion</td>";
    ?>
<!--  </tr>-->
 
<!--</tbody>-->
<!--</table>-->

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
