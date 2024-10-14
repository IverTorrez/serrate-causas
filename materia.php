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
    <title>materia</title>
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
include_once('model/clsmateria.php');
include_once('controller/control_materia.php');

$codmateria=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
$decodificado=base64_decode($codmateria);

   $codigonuevo=$decodificado/1234567;


$objmat1=new Materia();
$resulmat=$objmat1->mostrarunaMateria($codigonuevo);
$film=mysqli_fetch_object($resulmat);

$idmat=$film->id_materia;
$nommat=$film->nombremateria;
$abrevmat=$film->abreviaturamat;
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


    <!--FORMULARIO REGISTRO USUARIOS-->
    <div class="container">
    <?php
    if ($idmat!=null) {
      echo "<h3 class='titulo'>MODIFICAR MATERIA</h3>";
    }
    else
    {
      echo "<h3  class='titulo'>CREAR NUEVA MATERIA</h3>";
    }


    ?>
    
    <br>
    <br>

  <center> <form action="" method="POST">
   
    <div class="orden">
    <input type="hidden" name="textidmat" value="<?php echo $idmat; ?>"><br>
       <label class="lavelt">NOMBRE </label>
       <input type="text" id="nombre" class="textform" name="nombre" autocomplete="off" placeholder="Nombre" required="" value="<?php echo $nommat; ?>" >
    </div>

    <div class="orden">
       <label class="lavelt">ABREVIATURA</label>
       <input type="text" id="adbreviatura" class="textform" name="adbreviatura" autocomplete="off" required="" placeholder="Abreviatura" value="<?php echo $abrevmat; ?>">
    </div>
   <?php
    if ($idmat!=null) {
      echo "<input type='submit' class='btnclose' value='MODIFICAR' name='btnmodmat'>";
    }
    else
    {
      echo "<input type='submit' class='btnclose' value='GUARDAR' name='GUARDAR'>";
    }


    ?>

    
  </form></center>

   
</div><br>


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
   $objmat=new Materia();
   $resulm=$objmat->listarmateria();
   while ($fil=mysqli_fetch_object($resulm)) {
       echo "<tr>";
            $mascara=$fil->id_materia*1234567;
            $encriptado=base64_encode($mascara);
              echo " <td><a href='materia.php?squart=$encriptado'>$fil->nombremateria</a></td>";
              echo " <td>$fil->abreviaturamat</td>";
              
              echo "<td><a onclick='funcionllevaidmodal($fil->id_materia)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
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
    $('#textidmatmodal').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR MATERIA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar esta materia ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidmatmodal" name="textidmatmodal" placeholder="id materia" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarmat" name="btneliminarmat" value="Eliminar">
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