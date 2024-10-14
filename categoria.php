<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["useradmin"]))
{
  header("location:index.php");
}
$datos=$_SESSION["useradmin"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>categoria</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
    
</head>
<body>
<?php

include_once('model/clscategoria.php');
include_once('controller/control_categoria.php');

?>
    
    <div id="header">
        
        <div class="container">
        
       <?php
        include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
       
        <div id="main_menu_admin">
            <ul>
               
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
                
               

                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</a></li>
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


    <!--FORMULARIO REGISTRO CATEGORIA-->
    <div class="container">
    <h3 id="titulocrear"  class="titulo">CREAR NUEVA CATEGORIA</h3>

    <h3 id="titulomodi"  class="titulo">MODIFICAR CATEGORIA</h3>
    <br>
    <br>
 <center> <form action="" method="POST">
    <input type="hidden" name="textidcat" id="textidcat">
 
    <div class="orden">
       <label class="lavelt">NOMBRE</label>
       <input type="text" class="textform" placeholder="Nombre" required="" id="nombre" name="nombre" autocomplete="off">
    </div>

    <div class="orden">
       <label class="lavelt">ABREVIATURA</label>
       <input type="text"  class="textform" id="adbreviatura" placeholder="Abreviatura" required="" name="adbreviatura" autocomplete="off">
    </div>


    <input type="submit" class="btnclose" value="GUARDAR" id="GUARDAR" name="GUARDAR">

    <input type="submit" class="btnclose" value="MODIFICAR" id="btnmodcat" name="btnmodcat">
  </form></center>

   
</div><br>


<?php
/*$numerocondecimal= 22;
$redondeado= round($numerocondecimal,2);//redondea con 2 decimales
echo $redondeado;*/


?>



<div class="container">
   <section>
 <table id="tablapiso" class="tablapiso" >
 <thead>     
  <tr>
    <th>NOMBRE</th>
   
    <th>ABREVIATURA</th>
    <th>BORRAR</th>

  </tr>
</thead>
<tbody>
  <?php
   $objcat=new Categoria();
   $resultp=$objcat->listarcategoria();
   while ($fil=mysqli_fetch_object($resultp)) {
       echo "<tr>";
            $mascara=$fil->id_categoria*1234567;
            $encriptado=base64_encode($mascara);
              echo " <td><a href='javascript:void(0)' class='vinculo' parametro='$fil->id_categoria' parametro2='$fil->nombrecat' parametro3='$fil->abreviaturacat'>$fil->nombrecat</a></td>";
              echo " <td>$fil->abreviaturacat</td>";
              
              echo "<td><a onclick='funcionllevaidmodal($fil->id_categoria)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
        echo "<tr>";
          }
  ?>
</tbody>
</table>
</section>
</div>

    <br>
    <br>
    <br>


        <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidcatmodal').val(idd);
    var modal = document.getElementById("myModal");
    var btnclose = document.getElementById("btncloseformpres");
    var span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    btnclose.onclick=function() {
      modal.style.display = "none";
    }
  }
</script>
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un tribunal o juzgado -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR CATEGORIA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar esta categoria??</b></label><br><br>
        <input type="hidden" class="textform" id="textidcatmodal" name="textidcatmodal" placeholder="id categoria" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarcat" name="btneliminarcat" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>


<script type="text/javascript" src="resources/jquery.js"></script>
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


<script type="text/javascript">
         $('#btnmodcat').hide();//valores empiezan invisible
         $('#titulomodi').hide();

        $(document).ready(function(){
        $('.vinculo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
           $valor3=$(this).attr('parametro3');
          $('#textidcat').val($valor);
           $('#nombre').val($valor2);
           $('#adbreviatura').val($valor3);
           $('#GUARDAR').hide();
           $('#titulocrear').hide();
           $('#btnmodcat').show();
           $('#titulomodi').show();
        });
      });
  
</script>