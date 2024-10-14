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
    <title>demandante-demandado</title>
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

include_once('../model/clsdemandante_demandado.php');

include_once('../controller/control_demandante.php');



   
   $cod=$_GET['squart'];
   if ($cod!='') /*PREGUNTA SI SE ESCOGIO UNA CAUSA*/
   {
    
 //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/12345678910;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

  }/*FIN DEL IF QUE PREGUNTA SI SE ESCOGIO UNA CAUSA*/
  else/*POR FALSO OSEA SE QUIERE EDITAR UNA DEMANDADO TERCERISTA O DEMANDANTE*/
  {
    $coddeman=$_GET['squarts'];
    $decodificado1=base64_decode($coddeman);

   $codigonuevodeman=$decodificado1/456789;
   $objdeman=new Demandante_Demandado();
   $resultdeman=$objdeman->mostrarUnDemandante($codigonuevodeman);
   $fildem=mysqli_fetch_object($resultdeman);

   $nombredeman=$fildem->nombresdeman;
   $fojade=$fildem->foja;
   $ultdomidem=$fildem->ultimodomicilio;
   $codigonuevo=$fildem->id_causa;

   /*muestra el codigo de la causa*/
   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($fildem->id_causa);
   $fil=mysqli_fetch_object($resul);

   $disabe='disabled=""';
  }


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


    <!--FORMULARIO REGISTRO DEMANDANTE-DEMANDADO-->
<div class="container">

 

    <br>
    <?php
    if ($codigonuevodeman>0) 
    {
      echo '<h3  class="titulo">MODIFICAR DEMANDANTE-DEMANDADO-TERCERISTA</h3>';
    }
    else
    {
      echo '<h3  class="titulo">AGREGAR DEMANDANTE-DEMANDADO-TERCERISTA</h3>';
    }
    ?>
    
    <br>
    <br>
 <form method="POST">
<input type="hidden" name="tipousuario" id="tipousuario" value="Abogado">
 <input type="hidden" name="textidcausa" id="textidcausa" placeholder="id causa" value="<?php echo $codigonuevo; ?>">

  <input type="hidden" name="textiddemanedit" id="textiddemanedit" placeholder="id deman editar" value="<?php echo $codigonuevodeman; ?>">
    <div class="orden">
        <label>NOMBRE</label>               
        <input type="text" name="nombre" id="nombre" placeholder="Nombre.." autocomplete="off" required="required" value="<?php echo $nombredeman; ?>">
    </div>

    <div class="orden">
        <label>TIPO</label>
         <select name="tipodemandante" id="tipodemandante" <?php echo $disabe; ?> >
           <option value="Demandante">Demandante</option>
           <option value="Demandado">Demandado</option>
           <option value="Tercerista">Tercerista</option>
         </select>
    </div>

    
        <label>ULTIMO DOMICILIO</label>
   
   
   
   <div style="margin-left:375px; width: 1200px;">
   <textarea style="" name="texteditor" cols="30" rows="5" class="tinymce" id="texteditor" required="required"> <?php echo $ultdomidem; ?> </textarea>
   </div>
   
    
  <textarea style="display: none;" id="textultimodomsolotexto" name="textultimodomsolotexto"></textarea>


    <div class="orden">
        <label>FOJAS</label>
        <input type="text" name="foja" id="foja" placeholder="Foja" autocomplete="off" required="required" value="<?php echo $fojade; ?>">
    </div>
    <?php
    if ($codigonuevodeman>0) 
    {
      echo '<input name="btnmoddeman" type="submit"  id="btnmoddeman" onclick="escribirolotexto()" value="MODIFICAR" />';
    }
    else
    {
      echo '<input name="GUARDAR" type="submit"  id="GUARDAR" onclick="escribirolotexto()" value="GUARDAR" />';
    }
    ?>
    
 
    </form> 

    <script type="text/javascript">
  function escribirolotexto()
  {
    var ultimidomi= tinymce.get('texteditor').contentDocument.activeElement.innerText;
    
      $('#textultimodomsolotexto').val(ultimidomi);
  }
</script>


</div>

    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>

<script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymcedemandado/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymcedemandado/init-tinymce.js"></script>
</body>
</html>
