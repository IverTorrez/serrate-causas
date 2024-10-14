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
    <title>Avance Fisico</title>
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

include_once('model/clsplantilla.php');
include_once('model/clsposta.php');
include_once('controller/control-plantilla.php');
include_once('controller/control-posta.php');

$codplantilla=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codplantilla);

   $codigonuevo=$decodificado/1234567;

  /*PREGUNTA SI SE SELLECIONO ALGUNA PLANTILLA ,PARA ABILITAR Y DESABILITAR BOTONES*/
   if ($codigonuevo>0) 
   {
     

       $objp=new Plantilla();
       $resulp=$objp->mostrarUnaPlantilla($codigonuevo);
       $filpla=mysqli_fetch_object($resulp);

       $nombrepl=$filpla->nombreplantilla;
        /*PREGUNTA QUE LA PLANTILLA SELECCIONADA NO ESTE BORRADA, PARA ABILITAR Y DESABILITAR BOTNES,DESABILITA EL BOTON AGREGAR POSTA*/
       if ($filpla->id_plantilla>0) 
       {
         $varcrear='disabled=""';
       $fondobotoncrear='style="background: #85929E;"';

       $readonlytext='readonly=""';

       $switchboton=1;
       $idplantilla1=$filpla->id_plantilla;
       }
       else
       {
        $varmod='disabled=""';
        $fondoboton='style="background: #85929E;"';

        $switchboton=0;
       }

   }
   else
   {
    $fondoboton='style="background: #85929E;"';
    $varmod='disabled=""';
   }
   

   

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
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first main_current">AVANCE FISICO</a></li>
               
                
               

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

                 <li style="margin-left:10%; "> <p style="color: #000000;font-size: 20px;font-family: fantasy;">LISTADO DE PLANTILLAS</p></li>

                 <li style="float: right; margin-right: 17%; "><a href="avancefisico.php" style="font-size: 20px;font-family: fantasy; color: blue;">CREAR NUEVA PLANTILLA</a></li>
             </ul><br>
            </div> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--///////////////////////CUERPO DE LA PAGINA AVANCE FISICO////////////////////////////////////////////-->

              <!--PANELPLANTILLAS-->
<div role="tabpanel" style="margin-right: 5%; margin-left: 5%;" class="tab-pane fade in active" id="ACTIVOS">
         <div class="alert alert-info">
        
          </div>
    
    <section>
     
    </section>
   <div style="height: 400px;border: 1px solid #85929E; overflow: scroll; width: 500px;">
    <section id="tabla_resultadoActivos">
    <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
    <div class="orden">
        <table id="tablapostas">
          <thead>
           <tr>
            <th >NOMBRE DE LA PLANTILLA</th>
            <th width="10%">VER</th>
            <th width="18%">ELIMINAR</th>
            </tr>
          </thead>
            <?php
             $objplan=new Plantilla();
             $resulplan=$objplan->listarplantillasActivas();
              while ($filpl=mysqli_fetch_object($resulplan)) 
              {
                echo "<tr>";
                   $mascara=$filpl->id_plantilla*1234567;
                   $encriptado=base64_encode($mascara);
                   echo "<td style='text-align: left;'><a href='avancefisico.php?squart=$encriptado'>$filpl->nombreplantilla</a> </td>";

                   echo "<td><a href='vistaprevia.php?squart=$encriptado' target='_blank'><center><i class='fa fa-eye fa-1x' aria-hidden='true'></i></center></a></td>";

                   echo "<td><a onclick='funcionllevaidmodal($filpl->id_plantilla)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
                echo "</tr>";

              }
            ?>
             
          <tbody>

            
          </tbody>
        </table>
        
      </div>
    
    </section>
    </div>
</div>



<div >
      
    <form method="post"  style="margin-left:650px; width: 680px; position: absolute; top: 225px;  ">
      <input type="hidden" name="textidplantilla" id="textidplantilla" value="<?php echo $idplantilla1; ?>">
      <div class="orden">
      <label >COLOQUE NOMBRE A LA NUEVA PLANTILLA</label>
      <input class="textform" required=""   type="text" autocomplete="off"  name="textnameplantilla" placeholder="Nombre de plantilla" value="<?php echo $nombrepl; ?>">
      </div>

      <div class="orden">
        <label >INDICAR EL NOMBRE DE LAS POSTAS: </label>
       <button  id="myBtnform" type="button" <?php echo $varmod; echo $fondoboton; ?>  class="btnposta">AGREGAR OTRA POSTA</button>
      </div>

      <div class="orden">
        <table id="tablapostas">
          <thead>
           <tr>
            <th width="20%">NUMERO DE POSTAS</th>
            <th>NOMBRE DEL EVENTO</th>
            <th width="12%">ELIMINAR</th>
            </tr>
          </thead>
             
             <?php
             $objpst=new Posta();
             $resulpost=$objpst->listarPostasDePlantilla($codigonuevo);
             while ($filpst=mysqli_fetch_object($resulpost))
             {
              echo "<tr>";
                 echo "<td>$filpst->numeroposta</td>";
                 echo "<td> <a href='javascript:void(0)' onclick='funcionllevaidmodalpostamod($filpst->id_posta)' class='vinculoposta' parametro='$filpst->id_posta' parametronombre='$filpst->nombreposta'> $filpst->nombreposta</a></td>";
                 $contador=0;
                 $objpst1=new Posta();
                 $resulpost1=$objpst1->listarSIguientePostasDEPlantilla($filpst->id_posta,$codigonuevo);
                  while ($filnext=mysqli_fetch_object($resulpost1))
                  {
                   $contador++;
                  }

                  if ($contador>0) 
                  {
                    echo "<td></td>";
                  }
                  else
                  {
                    echo "<td><a onclick='funcionllevaidmodalposta($filpst->id_posta)'><center><i class='fa fa-trash fa-2x' style='height: 5px; width:5px; 'aria-hidden='false'></i></center></a></td>";
                  }
                  
              echo "</tr>";
             } 

             ?>
          <tbody>

            
          </tbody>
        </table>
        
      </div>

      <div class="orden">
        <button  type="button" onclick="location.href='conclucionextraordinaria.php'"  class="btnpostaedit">EDITAR CONCLUSION EXTRAORDINARIA DE CAUSAS </button>
        <?php
        if ($switchboton==1) 
        {
          echo ' <button name="btnmodplantilla" class="btnpostacrear">MODIFICAR NOMBRE DE PLANTILLA</button>';
        }
        else
        {
          echo '<button name="btncrearplantilla" class="btnpostacrear">GENERAR NUEVA PLANTILLA</button>';
        }
        ?>

        

      </div>
     
    </form>
</div>

<style type="text/css">
  .btnposta
{
   width: 30%;
  background-color: #1A5895;
  color: white;
  /*padding: 14px 20px;*/
  /*margin: 8px 0;*/
  border: none;
  border-radius: 4px;
  cursor: pointer;
  height: 33px;
 margin-top: 3px;
   
}
.btnpostacrear
{
   width: 30%;
  background-color: #1A5895;
  color: white;
  /*padding: 14px 20px;*/
  /*margin: 8px 0;*/
  border: none;
  border-radius: 4px;
  cursor: pointer;
  height: 33px;
 margin-top: 3px;
 float: right;
   
}

 .btnpostaedit
{
   width: 60%;
  background-color: #1A5895;
  color: white;
  /*padding: 14px 20px;*/
  /*margin: 8px 0;*/
  border: none;
  border-radius: 4px;
  cursor: pointer;
  height: 33px;
 margin-top: 3px;
   
}

#tablapostas {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

#tablapostas td, #tablapostas th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
   border: 1px solid #000;
   border-spacing: 0;


}


#tablapostas tr:hover {background-color: #ddd;}

#tablapostas th {
  padding-top: 12px;
  padding-bottom: 12px;
 
  color: black;
}
</style>





  










        <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidplant').val(idd);
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR PLANTILLA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar esta Plantilla??</b></label><br><br>
        <input type="hidden" class="textform" id="textidplant" name="textidplant" placeholder="id categoria" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarplant" name="btneliminarplant" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>








     <!-- The Modal (FORMULARIO) PARA AGREGAR UNA POSTA A LA PLANTILLA  -->
<div id="myModalform" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclose">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >AGREGAR UNA POSTA PARA ESTA PLANTILLA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <input type="hidden" name="idplantilla" value="<?php echo $codigonuevo; ?>">
    
      <b><label>NOMBRE DEL EVENTO</label></b>
      <input style="width: 100%;" type="text" class="textform" autocomplete="off" required="" name="textnombposta" placeholder="Nombre..">



    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; max-width: 180px; float: left; width: 35%;" type="submit" class="btnclose" id="btnaddposta" name="btnaddposta" value="AGREGAR">
    <button class="btnclose" id="btncloseform" style="float: right;" type="button">Cancelar</button>
      </form>

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA INTRODUCIR EL MOTIVO del rechazo-->
<script>
// Get the modal
var modalform = document.getElementById("myModalform");

// Get the button that opens the modal
var btnf = document.getElementById("myBtnform");
var btncloseform = document.getElementById("btncloseform");

// Get the <span> element that closes the modal
var spanclose = document.getElementById("spanclose");

// When the user clicks the button, open the modal 
btnf.onclick = function() {
  modalform.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclose.onclick = function() {
  modalform.style.display = "none";
}
btncloseform.onclick=function() {
  modalform.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>
















        <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL PARA ELIMINAR UN POSTA DE LA CAUSA
  function funcionllevaidmodalposta(idd)
  {
    $('#textidposta').val(idd);
    var modal = document.getElementById("myModalelimposta");
    var btnclose = document.getElementById("btncloseformelimposta");
    var span = document.getElementById("spancloseelimposta");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar una posta de una plantilla -->
<div id="myModalelimposta" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseelimposta">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR POSTA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar esta Posta??</b></label><br><br>
        <input type="hidden" class="textform" id="textidposta" name="textidposta" placeholder="id posta" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarposta" name="btneliminarposta" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformelimposta" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>














        <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL PARA MODIFICAR UN POSTA DE LA PLANTILLA
  function funcionllevaidmodalpostamod(idd)
  {
    $('#textidpostamod').val(idd);
    var modal = document.getElementById("myModalmodposta");
    var btnclose = document.getElementById("btncloseformmodposta");
    var span = document.getElementById("spanclosemodposta");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar una posta de una plantilla -->
<div id="myModalmodposta" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosemodposta">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >MODIFICAR POSTA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      
        <input type="hidden" class="textform" id="textidpostamod" name="textidpostamod" placeholder="id posta" required><br>
        <b><label>NOMBRE DEL EVENTO</label></b>
      <input style="width: 100%;" type="text" class="textform" autocomplete="off" required="" id="textnombpostamod" name="textnombpostamod" placeholder="Nombre..">
                                                        
 
    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btnmodposta" name="btnmodposta" value="Modifcar">
     <button type="button" class="btnclose" id="btncloseformmodposta" style="float: right;">Cancelar</button>
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

<script type="text/javascript">/*SCRIP QUE INTRODUCE EL NOMBRE DE UNA POSTA PARA MODIFICAR*/
         $('#btnmodcat').hide();//valores empiezan invisible
         $('#titulomodi').hide();

        $(document).ready(function(){
        $('.vinculoposta').click(function(){
          $valorn = $(this).attr('parametronombre'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          
          $('#textnombpostamod').val($valorn);
           
        });
      });
  
</script>