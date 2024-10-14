<!DOCTYPE html>
<html>
<head>

  <title>login</title>
  <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="resources/login.css">
  <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    #number {
  font-size:30px;
  
}

<?php
/*error_reporting(E_ERROR);
include_once('model/clscajasdesalida.php');

$objimg=new Cajasdesalida();
$resulimg=$objimg->mostrarImagenIndex();
$filimg=mysqli_fetch_object($resulimg); */

?>
  </style>
</head>
<body>
 <!--LOGO-->
<div class="imgcontainer">
   <?php
      /*  include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" alt="Avatar" class="avatar">';
        }
        else
        {
          echo "<img style='width: 391px;height: 99px;' src='fotos/imagenindex/$filimg->imagenindex' alt='Avatar' class='avatar' >";
        }*/

        ?>

  
 <!--  <img src="../resources/logo.jpg" alt="Avatar" class="avatar">-->
</div>
 <!--FORMULARIO LOGIN-->

            <form class="formulario" id="frm" method="POST">

                 <input type="text" id="usuario" name="usuario" autocomplete="off" placeholder="USUARIO">
           
     <div>
        <div style="float:left;margin: 0 0 15px;width: 82%;margin-left: 5px">
          <input type="password" name="password" id="password" placeholder="CONTRASEÑA">
        </div>
        <div style="float:left;margin: 0 0 15px;padding: 6px;border: 1px solid #999;">
           <i class="fa fa-eye" aria-hidden="true" action="hide" id="show-hide-passwd"></i>
      </div>    
    </div>
   
    
    

    <div>
      <div style="float:left;margin: 0 0 15px;width: 50%"> 
         <!--IMAGEN CAPTCHA-->
          <div id="captchaLoad">
            <!--RECARGA CAPTCHA-->
          </div>
       </div>
    <div style="float:left;margin: 0 0 15px; width: 50%">
          <div id="number">
            <label>0</label>
         <!--LIMITE PARA CAMBIAR CAPTCHA-->
         </div>

    </div> 
      
         
    </div>
          
          <!--CAMPO PARA INGRESAR CAPTCHA-->
          <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="INGRESE CAPTCHA" >
          
          <button type="button"  name="iniciar" id="iniciar">INGRESAR</button>

          <div id="cargar">
            
          </div>


            </form>



<script type="text/javascript" src="resources/jquery.js"></script>
<!--<script type="text/javascript" src="validaciones/validacionLogin.js"></script>-->
</body>
</html>
<script type="text/javascript">
  /*  $(document).ready(function(){
       $('#captchaLoad').load('imagen.php');
    });
*/
</script>
