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
    <title>Conclucion Extraordinaria</title>
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


include_once('model/clstipoposta.php');






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
    
      <h3 class='titulo' id="titulomod">MODIFICAR CONCLUCION EXTRAORDINARIA</h3>
   
      <h3 class='titulo' id="titulocrear">REGISTRAR NUEVA CONCLUCION EXTRAORDINARIA</h3>
    


  
    
   

  <center> <form  method="post" id="frmconclu">
    <div class="orden">
       <label>NOMBRE CONCLUCION</label>
       <input type="hidden" class="textform" name="textidconclu" id="textidconclu" >
       <input type="text" class="textform" required="" placeholder="Nombre de conclucion" id="textnombconclu" name="textnombconclu" autocomplete="off" >
    </div>
    <input class="btnclose" type="submit" id="btnregajax" value="GUARDAR">
    <input type="button" class="btnclose" id="btnmodtp"  value="MODIFICAR"> 
  
   
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
   
    
    <th width="10%">BORRAR</th>
  </tr>
</thead>
<tbody>
  <?php
   $objpiso=new TipoPosta();
   $resul=$objpiso->listarTipoPostas();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            $mascara=$fil->id_tipoposta*1234567;
            $encriptado=base64_encode($mascara);
              echo " <td><a href='javascript:void(0)' class='vinculo' parametro='$fil->nombretipoposta' parametro2='$fil->id_tipoposta' >$fil->nombretipoposta</a></td>";
              
              echo "<td><a onclick='funcionllevaidmodal($fil->id_tipoposta)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
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
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL 
  function funcionllevaidmodal(idd)
  {
    $('#textidconclicion').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR CONCLUCION EXTRAORDINARIA</p></center>
     </div><br>
    <form method="post" id="frmelimconclu">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar esta Conclucion Extraordinaria ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidconclicion" name="textidconclicion" placeholder="id conclucion" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="button" class="btnclose" id="btneliminarconclu" name="btneliminarconclu" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>



<!--CODIGO AJAX PARA REGISTRAR UNA CONCLUCION EXTRAORDINARIA-->

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnregajax').click(function(){
       var datos=$('#frmconclu').serialize();
       
       if ($('#textnombconclu').val()!='') 
       {
           $.ajax({
            type:"post",
            url:"controller/control-regtipopostaajax.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) {
                setTimeout(function(){ location.href='conclucionextraordinaria.php' }, 500); swal('EXELENTE','Se Creo La Conclucion Extraordinaria Con Exito','success');
              }
              else{
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo La Conclucion Extraordinaria','warning');
              }
              $('#textnombconclu').val('');
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


<!--CODIGO AJAX PARA MODIFICAR UNA CONCLUCION EXTRAORDINARIA-->

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnmodtp').click(function(){
       var datos=$('#frmconclu').serialize();
       
       if ($('#textidconclu').val()!=1) 
       {
        
        if ($('#textnombconclu').val()!='') 
           {
               $.ajax({
                type:"post",
                url:"controller/control-modificartipoposta.php",
                data:datos,
                success:function(respuesta){
                  if (respuesta==1) {
                    setTimeout(function(){ location.href='conclucionextraordinaria.php' }, 500); swal('EXELENTE','Se Modifico La Conclucion Extraordinaria Con Exito','success');
                  }
                  else{
                    setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico La Conclucion Extraordinaria','warning');
                  }
                  $('#textnombconclu').val('');
                }
              });
               return false;
            }
            else
            {
              setTimeout(function(){  }, 2000); swal('ERROR','debe llenar los campos','warning');
            }
       }
       else
       {

          setTimeout(function(){  }, 2000); swal('ERROR','Este Es El Unico Registro Que No se Puede Modificar','warning'); 

       }


    });
  });
</script>




<!--CODIGO AJAX PARA ELIMINAR UNA CONCLUCION EXTRAORDINARIA-->

<script type="text/javascript">
  $(document).ready(function(){
    $('#btneliminarconclu').click(function(){
       var datos=$('#frmelimconclu').serialize();
       
       if ($('#textidconclicion').val()!=1) 
       {
        
        
               $.ajax({
                type:"post",
                url:"controller/control-darbajatipopostaajax.php",
                data:datos,
                success:function(respuesta){
                  if (respuesta==1) {
                    setTimeout(function(){ location.href='conclucionextraordinaria.php' }, 500); swal('EXELENTE','Se Modifico La Conclucion Extraordinaria Con Exito','success');
                  }
                  else{
                    setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico La Conclucion Extraordinaria','warning');
                  }
                  $('#textnombconclu').val('');
                }
              });
               return false;
           
       }
       else
       {

          setTimeout(function(){  }, 2000); swal('ERROR','Este Es El Unico Registro Que No se Puede Eliminar','warning'); 

       }


    });
  });
</script>


<!--CODIGO PARA CARGAR DATOS DE UN REGISTRO AL TEXT, PARA MODIFICAR UN REGISTRO-->
<script type="text/javascript">
         $('#btnmodtp').hide();
         $('#titulomod').hide();

        $(document).ready(function(){
        $('.vinculo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
           
          $('#textnombconclu').val($valor);
           $('#textidconclu').val($valor2);
          
           $('#btnregajax').hide();
           $('#titulocrear').hide();
           $('#btnmodtp').show();
           $('#titulomod').show();
        });

      });
  
</script>