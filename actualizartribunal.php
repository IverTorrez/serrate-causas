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
    <title>Actualizar Tribunales</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
        <link rel="stylesheet" type="text/css" href="resources/tablaordenadm.css">

    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
    <script type="text/javascript" src="resources/jquery.min.js"></script>
</head>
<body>
<?php
include_once('model/clsjuzgados.php');
include_once('controller/control-juzgados.php');
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
     
            <div id="portfolio_menu">
                
                <ul>
                    <li><button style="font-size: 12px; width: 300px;" onclick="location.href='nuevojuzgado.php'" class="botones">CREAR NUEVO TRIBUNAL</button></li>
                    <li><button style="font-size: 12px;" class="botones"  onclick="window.open('impresiones/tcpdf/pdf/tribunales.php')" >IMPRIMIR</button></li>

                    <li style="float: right;"><button style="font-size: 12px; width: 300px;" class="botones" onclick="location.href='piso.php'">CREAR/ACTUALIZAR  PISOS</button></li>
                   
                </ul>
                
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->


    <!--tabal  de costos -->
    <div class="container">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTA DE TRIBUNALES</h3>
    <br>
    <table id="customers">
        <thead>
          
        </thead>
        <tbody>
          <tr id="fila1">
                <th colspan="4" style="font-size: 13px;">NOMBRE DEL TRIBUNAL</th>
                <th rowspan="2" style="font-size: 13px;">PISO</th>
                <th rowspan="2" style="font-size: 13px;">COORDENADAS</th>
                <th rowspan="2" style="font-size: 13px;">FOTO DE LA FACHADA</th>
                <th rowspan="2" style="font-size: 13px;">CONTACTO 1</th>
                <th rowspan="2" style="font-size: 13px;">CONTACTO 2</th>
                <th rowspan="2" style="font-size: 13px;">CONTACTO 3</th>
                <th rowspan="2" style="font-size: 13px;">CONTACTO 4</th>
                <th rowspan="2" style="font-size: 14px;">ACTUALIZAR</th>
                <th rowspan="2" style="font-size: 14px;" >ELIMINAR</th>
            </tr>
        <tr id="fila2">
            <td>NOMBRE NUMERICO</td>
            <td>JERARQUIA</td>
            <td>MATERIA</td>
            <td>CODIGO CIUDAD</td>
            
        </tr>

        <?php
        $objjuzg=new Juzgados();
       $resul=$objjuzg->listartodosjuzgados();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
              echo "<td>$fil->nombrenumerico".º."</td>";
              echo "<td>$fil->jerarquia</td>";
              echo "<td>$fil->materiajuz</td>";
              echo "<td>$fil->distr</td>";
              echo "<td>$fil->piso1</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$fil->contacto1</td>";
              echo "<td>$fil->contacto2</td>";
              echo "<td>$fil->contacto3</td>";
              echo "<td>$fil->contacto4</td>";
              $mascarac=$fil->id_juzgados*1213141516;
             $encriptado1=base64_encode($mascarac);
              echo "<td><a href='nuevojuzgado.php?squart=$encriptado1'><i class='fa fa-edit fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td> <a onclick='funcionllevaidmodal($fil->id_juzgados)'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td>";
        echo "<tr>";
          }


        ?>
            
        </tbody>
    </table>
 

   
</div>
    <br>
    <br>
    <br>

    <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidtribunal').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR TRIBUNAL</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este tribunal ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidtribunal" name="textidtribunal" placeholder="id tribunal" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminartrib" name="btneliminartrib" value="Eliminar">
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

