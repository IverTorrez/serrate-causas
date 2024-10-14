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
    <title>tipolegal</title>
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

include_once('model/clstipolegal.php');
include_once('model/clsmateria.php');
include_once('controller/control_tipolegal.php');

$codtipo=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
$decodificado=base64_decode($codtipo);

   $codigonuevo=$decodificado/1234567;


$objtplegal=new TipoLegal();
$resultple=$objtplegal->mostrarunTipolegal($codigonuevo);
$filtp=mysqli_fetch_object($resultple);

$idtipol=$filtp->id_tipolegal;
$nomtpl=$filtp->nombretipolegal;
$abrevtpl=$filtp->abreviaturalegal;

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
    <h3 id="titulocrear"  class="titulo">CREAR NUEVO TIPO LEGAL</h3>

    <h3 id="titulomod"  class="titulo">MODIFICAR TIPO LEGAL</h3>
    <br>
  
<center>  
  <form action="" method="POST"> 
    <input type="hidden" name="textidtpl" id="textidtpl" value="<?php echo $idtipol; ?>">
    <div class="orden">
       <label class="lavelt">NOMBRE</label>
       <input type="text" id="nombre" class="textform" placeholder="Nombre" name="nombre" required="" autocomplete="off" value="<?php echo $nomtpl; ?>">
    </div>

    <div class="orden">
       <label class="lavelt" >ABREVIATURA</label>
       <input type="text" class="textform" id="adbreviatura" placeholder="Abreviatura" required="" name="adbreviatura" autocomplete="off" value="<?php echo $abrevtpl; ?>">
    </div>

      <div class="orden">
       <label class="lavelt" >MATERIA</label>
        <select class="textform" name="selectmateria" id="selectmateria">
           <option>SELECCIONE MATERIA</option>
           <?php
           $objmateria=new Materia();
           $resultmateria=$objmateria->listarMateriasActivasExceptoUna(0);
           while($filmat=mysqli_fetch_array($resultmateria))
           {
             echo '<option value="'.$filmat['id_materia'].'">'.$filmat['abreviaturamat'].'-'.$filmat['nombremateria'].'</option>';
           }

           ?>
        </select>
    </div>


    <input type="submit" class="btnclose" value="GUARDAR" id="GUARDAR" name="GUARDAR">

    <input type="submit" class="btnclose" value="MODIFICAR" id="btnmodtp" name="btnmodtp">
  </form></center>
  
</div><br>







<div class="container">
   <section>
 <table id="tablapiso" class="tablapiso" >
 <thead>     
  <tr>
    <th>NOMBRE</th>
   
    <th>ABREVIATURA</th>
    <th>MATERIA</th>
    <th>BORRAR</th>

  </tr>
</thead>
<tbody>
  <?php
   $objtpl=new TipoLegal();
   $resultp=$objtpl->listartipolegal();
   while ($fil=mysqli_fetch_object($resultp)) {
       echo "<tr>";
            $mascara=$fil->id_tipolegal*1234567;
            $encriptado=base64_encode($mascara);
              echo " <td><a href='javascript:void(0)' class='vinculo' parametro='$fil->nombretipolegal' parametro2='$fil->id_tipolegal' parametro3='$fil->abreviaturalegal' parametro4='$fil->idmat'>$fil->nombretipolegal</a></td>";
              echo " <td>$fil->abreviaturalegal</td>";
              echo " <td>$fil->matlegal</td>";
              echo "<td><a onclick='funcionllevaidmodal($fil->id_tipolegal)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
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
    $('#textidtpmodal').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR TIPO LEGAL</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este tipo legal ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidtpmodal" name="textidtpmodal" placeholder="id tipo legal" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminartpl" name="btneliminartpl" value="Eliminar">
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
         $('#btnmodtp').hide();
         $('#titulomod').hide();

        $(document).ready(function(){
        $('.vinculo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
           $valor3=$(this).attr('parametro3');
           $valor4=$(this).attr('parametro4');
          $('#nombre').val($valor);
           $('#textidtpl').val($valor2);
           $('#adbreviatura').val($valor3);
           $('#selectmateria').val($valor4);
           
           $('#GUARDAR').hide();
           $('#titulocrear').hide();
           $('#btnmodtp').show();
           $('#titulomod').show();

        });

      });
  
</script>



