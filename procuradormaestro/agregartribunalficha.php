<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR MAESTRO*/
if(!isset($_SESSION["procuradormaestro"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procuradormaestro"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insertar Tribunal</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
</head>
<body>
   <?php
      include_once('../model/clscausa.php');
      include_once('../model/clsclasetribunal.php');
      include_once('../model/clsjuzgados.php');
      include_once('../model/clstribunal.php');
      include_once('../controller/contro-tribunal.php');

      $cod=$_GET['squart'];

      //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/1213141516;

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
       <div id="main_menu_admin">
            <ul>
               
                 <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador Maestro</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="pm_mis_causa.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
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
                    <li><button class="botones" style="height: 45px;" onclick="location.href='pm_ficha.php?squart=<?php echo $cod ?>'">VOLVER A LA FICHA</button></li>
                    <li><button class="botones" style="height: 45px;" onclick="location.href='pm_lista_ordenes.php?squart=<?php echo $cod ?>'">LISTA DE ORDENES</button></li>
                    <li><button style="width: 250px; height: 45px;" class="botones" onclick="location.href='actualizartribunal.php'">CREAR/ACTUALIZAR TRIBUNALES</button></li>
                    
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">


   
    <h3 class="titulo">SELECCIONAR TRIBUNAL PARA LA FICHA</h3>
  
    <br>
<form  method="post">
     <input type="hidden" name="textidcausa" id="textidcausa" value="<?php echo $codigonuevo; ?>">
     <input type="hidden" name="texttipousu" value="PMaestro">
     <div class="orden">
       <label for="">TIPO TRIBUNAL</label>
       <select id="idClaseTrib" name="idClaseTrib">
      <!-- <option>ad quo</option>-->
       <?php
       $objtptrib=new ClaseTribunal();
        $liscat=$objtptrib->listarclasetribunal();
              while($cat=mysqli_fetch_array($liscat)){
                
              echo '<option value="'.$cat['id_clasetribunal'].'">'.$cat['nombreclasetrib'].'</option>';
              }
       ?>
       </select>
    </div>

     <div class="orden">
       <label>JUZGADO</label>
       <select id="idJuzgado" name="idJuzgado">
      <!-- <option>29 publico civil sc</option>-->
        <?php
       $objjuz=new Juzgados();
        $liscat=$objjuz->listarjuzgados();
              while($cat=mysqli_fetch_array($liscat)){
                
              echo '<option value="'.$cat['id_juzgados'].'">'.$cat['nombrenumerico'].'º '.$cat['juzgado'].' '.$cat['dist'].'</option>';
              }
       ?>
       </select> 
    </div>

    <div class="orden">
       <label>Nº EXP</label>
       <input type="text" id="nroExpediente" name="nroExpediente" autocomplete="off" placeholder="Coloque número de expediente">
    </div>

    <div class="orden">
       <label>CODIGO JUDICIAL</label>
       <input type="text" id="codNI" name="codNI" autocomplete="off" placeholder="Coloque codigo judicial">
    </div>

   

  
   
    <input type="submit" value="GUARDAR" id="guardarTribunalF" name="guardarTribunalF">
</form>
    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
