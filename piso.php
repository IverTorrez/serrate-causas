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
    <title>piso</title>
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
include_once('model/clspiso.php');
include_once('controller/control-piso.php');

$codpiso=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
$decodificado=base64_decode($codpiso);

   $codigonuevo=$decodificado/1234567;


$objpiso1=new Piso();
$resulp=$objpiso1->mostrarUnPiso($codigonuevo);
$fil2=mysqli_fetch_object($resulp);
$idpiso=$fil2->id_piso;
$nomp=$fil2->nombrepiso;

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
    <?php
    if ($idpiso!=null) {
      echo "<h3 class='titulo'>MODIFICAR PISO</h3>";
    }
    else
    {
      echo "<h3 class='titulo'>REGISTRAR NUEVO PISO</h3>";
    }


    ?>
    
   
 <center> <form  method="post" id="frmpiso">
    <div class="orden">
       <label>NOMBRE</label>
       <input type="hidden" class="textform" name="textidpiso" value="<?php echo $idpiso; ?>">
       <input type="text" class="textform" required="" placeholder="Nombre " id="textpiso" name="textpiso" autocomplete="off" value="<?php echo $nomp; ?>">
    </div>
    <?php
    if ($idpiso!=null) {
      echo " <input class='btnclose'  type='submit' id='btnmodpiso' name='btnmodpiso' value='MODIFICAR'> ";
    }
    else
    {
      echo ' <input class="btnclose" type="submit" id="btngajax" value="GUARDAR"> ';
    }
    ?>
   
  </form></center>
</div>

<br>
<br>

<div class="container">
   <section>
 <table id="tablapiso" class="tablapiso" >
 <thead>     
  <tr>
    <th>NOMBRE</th>
   
    
    <th>BORRAR</th>
  </tr>
</thead>
<tbody>
  <?php
   $objpiso=new Piso();
   $resul=$objpiso->listarpisos();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            $mascara=$fil->id_piso*1234567;
            $encriptado=base64_encode($mascara);
              echo " <td><a href='piso.php?squart=$encriptado'>$fil->nombrepiso</a></td>";
              
              echo "<td><a onclick='funcionllevaidmodal($fil->id_piso)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
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
    $('#textidpiso').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR PISO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este piso ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidpiso" name="textidpiso" placeholder="id piso" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarpiso" name="btneliminarpiso" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btngajax').click(function(){
       var datos=$('#frmpiso').serialize();
       
       if ($('#textpiso').val()!='') 
       {
           $.ajax({
            type:"post",
            url:"controller/control-regpisoajax.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) {
                setTimeout(function(){ location.href='piso.php' }, 500); swal('EXELENTE','Se Creo El Piso Con Exito','success');
              }
              else{
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo El Piso','warning');
              }
              $('#textpiso').val('');
            }
          });
           return false;

        }
        else{
          setTimeout(function(){  }, 2000); swal('ERROR','debe llenar los campos','warning');
        }
    });
  });
</script> 
