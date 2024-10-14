<!DOCTYPE html>
<html>
<head>
    <title>tipousuario</title>
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clsmateria.php');
include_once('../model/clstipolegal.php');
include_once('../model/clscliente.php');
include_once('../model/clscategoria.php');
include_once('../model/clsabogado.php');
include_once('../model/clsprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clstipousuario.php');

include_once('../controller/control-causas.php');
include_once('../controller/control_categoria.php');
include_once('../controller/control-tipousuario.php');

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
        
        <h2 id="portfolio">USUARIO:xxx  TIPO:administrador</h2>
        <div id="main_menu">
        
            <ul>
                <li class="first_list"><a href="" class="main_menu_first">AVANCE FISICO</a></li>
                <li class="first_list"><a href="usuarios.php" class="main_menu_first ">USUARIOS</a></li>
                <li class="first_list"><a href=""  class="main_menu_first ">MATRIZ COTIZACIONES</a>   
                </li>
                <li class="first_list"><a href="causasActivas.php" class="main_menu_first">CAUSAS ACTIVAS</a>               
                </li>
                <li class="first_list"><a href="avancefisico.php" class="main_menu_first">SALIR</a></li>
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
    <br>
    <br>
    <h3  class="titulo">AGREGAR NUEVO TIPO DE USUARIO</h3>
    <br>
    <br>
  <form action="" method="post">
    <div class="orden">
       <label>TIPO DE USUARIO</label>
       <input type="text" id="textnombtpusu" name="textnombtpusu" autocomplete="off">
    </div>
    <input type="submit" value="GUARDAR" id="btnguardartpusu" name="btnguardartpusu">
  </form>   
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