<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["abogado"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Apuntes Honorarios</title>
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
include_once('../controller/control-apunteshonorario.php');
$cod=$_GET['squart'];

 //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($cod);

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
       <div id="main_menu_admin">
            <ul>
               
                  <li  class="first_listleft" style="float: left; width: 600px;"><a >USUARIO:<?php echo $datos['nombreabog']; ?>  TIPO:Abogado</a></li>
                
                <li class="first_list" ><a href="miscausas.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
  <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">

    <!-- <div id="portfolio_menu">

                AGREGAR SUB MENU

            </div>--> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->


    <!--FORMULARIO REGISTRO USUARIOS-->
    <div class="container">
    <h3  class="titulo">AGREGAR APUNTES SOBRE HONORARIOS</h3>
    <br>
    
  <form action="" method="POST">
   <?php
  $objcausa=new Causa();
  $lista=$objcausa->mostrarobservaciones($codigonuevo);
    $fil=mysqli_fetch_object($lista);
        
           //echo "<td>$fil->apunteshonorarios</td>";
     
      
  ?>
 <input type="hidden" name="idcausa" value="<?php echo $codigonuevo; ?>">

    
    <div class="orden">
      <textarea name="texteditorapunthonorario" cols="30" rows="5" class="tinymce" id="texteditorapunthonorario"><?php echo $fil->apunteshonorarios; ?></textarea>
    </div><br>

   
   <textarea style="display: none;" id="textapuntehonorariosolotexto" name="textapuntehonorariosolotexto"></textarea>
   
    <input type="submit" name="btnaddapunthonorario" onclick="escribirsolotexto()" value="GUARDAR" >
  </form>

<script type="text/javascript">
  function escribirsolotexto()
  {
    var apunthonorario= tinymce.get('texteditorapunthonorario').contentDocument.activeElement.innerText;
    
      $('#textapuntehonorariosolotexto').val(apunthonorario);
  }
</script>

   
</div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>

  <!-- javascript -->
    <script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/init-tinymce.js"></script>

</body>
</html>