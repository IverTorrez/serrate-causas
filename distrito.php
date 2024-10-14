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
    <title>Distrito</title>
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
include_once('model/clsdistrito.php');
include_once('controller/control-distrito.php')
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
                
                <ul>
                    <li><button class="botones">VOLVER A LA FICHA</button></li>
                    <li><button class="botones">LISTA DE ORDENES</button></li>
                    <li><button class="botones">ACTUALIZAR TRIBUNALES</button></li>
                </ul>
                <br>
                <br>
            </div>--> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
    
    <div class="container">
   
    <h3 id="titulocrear" class="titulo">REGISTRAR NUEVO DISTRITO</h3>

    <h3 id="titulomodi" class="titulo">MODIFICAR DISTRITO</h3>
    
    
     <center> <form action="" method="post">

    <div class="orden">
    <input type="hidden" name="textiddist" id="textiddist" ><br>
       <label class="lavelt">NOMBRE</label>
       <input type="text" id="textnomdist" class="textform" name="textnomdist" placeholder="Nombre" required="" autocomplete="off" >
    </div>

    <div class="orden">
       <label class="lavelt">ABREVIATURA</label>
       <input type="text" id="textabrev" class="textform" name="textabrev" autocomplete="off" placeholder="Abreviatura" required="" >
    </div>
    
        <input type="submit" class="btnclose" value="GUARDAR" id="btnguardardist" name="btnguardardist">
  
        <input type="submit" class="btnclose" value="MODIFICAR" id="btnedit" name="btnedit">
    

   
  </form></center> 
</div>

<br>
<br>

<div class="container">
   <section>
<table id="tablapiso" class="tablapiso">
 <thead>     
  <tr>
    <th>NOMBRE</th>
    <th>ABREVIATURA</th>
    
    <th>BORRAR</th>
  </tr>
</thead>
<tbody>
  <?php
   $obdist=new Distrito();
   $resul=$obdist->listardistritos();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
              echo "<td><a href='javascript:void(0)' class='vinculo' parametro='$fil->id_distrito' parametro2='$fil->nombredistrito' parametro3='$fil->abreviaturadist'>$fil->nombredistrito</a></td>";
              echo "<td>$fil->abreviaturadist</td>";
              echo "<td><a onclick='funcionllevaidmodal($fil->id_distrito)'> <i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
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
    $('#textiddistmodal').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR DISTRITO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este distrito??</b></label><br><br>
        <input type="hidden" class="textform" id="textiddistmodal" name="textiddistmodal" placeholder="id categoria" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminardist" name="btneliminardist" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>





<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>

<script type="text/javascript">
         $('#btnedit').hide();//valores empiezan invisible
         $('#titulomodi').hide();

        $(document).ready(function(){
        $('.vinculo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
           $valor3=$(this).attr('parametro3');
          $('#textiddist').val($valor);
           $('#textnomdist').val($valor2);
           $('#textabrev').val($valor3);

           $('#btnguardardist').hide();
           $('#titulocrear').hide();
           $('#btnedit').show();
           $('#titulomodi').show();
        });
      });
  
</script>
