<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR MAESTRO*/
if(!isset($_SESSION["procuradormaestro"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procuradormaestro"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Expediente Digital</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="../resources/jquery.min.js"></script>
    
</head>
<body>
<?php
include_once('../model/clstribunal.php');
include_once('../model/clscausa.php');
include_once('../model/clscuerpoexpediente.php');
include_once('../controller/control-cuerpoexpediente.php');
include_once('../controller/control-subirexpedientedigitalprocm.php');

$codtribunal=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
$decodificado=base64_decode($codtribunal);

   $codigonuevo=$decodificado/1234567;


$objtrib=new Tribunal();
$resultrib=$objtrib->mostrardatosdeUntribunal($codigonuevo);
$filtrib=mysqli_fetch_object($resultrib);
$codcausa=$filtrib->id_causa;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codcausa);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

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
               
                 <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador Maestro</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="pm_mis_causa.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
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


    <div class="container">
   <section>
 <table id="tribunalexp">
 <thead>     
  <tr>
    <th>FISIOLOGIA DEL TRUBUNAL</th>
    <th>NOMBRE DE TRIBUNAL</th>
    <th># DE EXP.</th>
    <th>CODIGO JURIDICO </th>

  </tr>
</thead>
<tbody>
  <?php
   $objtrib1=new Tribunal();
   $resulm=$objtrib1->mostrarDetallesDeTribunal($codigonuevo);
   while ($fil=mysqli_fetch_object($resulm)) {
       echo "<tr>";
            
              echo " <td>$fil->tptribu</td>";
              echo " <td>$fil->juzg</td>";
              
              echo "<td>$fil->expediente</td>";
              echo "<td>$fil->codnurejianuj</td>";
        echo "</tr>";
          }
  ?>
</tbody>
</table>

</section>
<div class="orden">

<button class="btnclose" onclick="funcionllevaidmodal();">SUBIR UN ARCHIVO</button>
</div>
</div><br><br>

<div class="container">
<label><b> CUERPOS DEL EXPEDIENTE</b></label>
   <section>
 <table id="tablacuerpoexp" class="tablacuerpoexp" >
 <thead>     
  <tr>
    <th>#</th>
   
    <th>NOMBRE</th>
    

  </tr>
</thead>
<tbody>
  <?php
   $objcuerpoex=new CuerpoExpediente();
   $resulcuerpo=$objcuerpoex->mostrarLosCuerposDeExpedientesDeTribunal($codigonuevo);
   $contador=1;
   while ($filcuerpo=mysqli_fetch_object($resulcuerpo))
   {
     echo "<tr>";
            
              echo " <td>$contador</td>";
              echo " <td><a href='javascript:void(0)' class='vinculo' parametro='$filcuerpo->id_cuerpo' parametro2='$filcuerpo->nombrecuerpo' parametro3='$filcuerpo->linkcuerpo' >$filcuerpo->nombrecuerpo</a></td>";
              
              
              
        echo "</tr>";
        $contador++;
   }

   
  ?>
</tbody>
</table>
</section>


</div>

 


    <!--FORMULARIO REGISTRO USUARIOS-->
    <div class="container">
    
      
   
    


    
    

   <form action="" method="POST" style="margin-left:600px; width: 600px; position: absolute; top: 250px; " >
    <input type="hidden" name="textidtribunal" placeholder="id tribunal" value="<?php echo $codigonuevo; ?>">

    <input type="hidden" name="textidcuerpomod" id="textidcuerpomod" placeholder="id cuerpo">
    <h3  class='titulo' id="titulocrear">CREAR NUEVO CUERPO DEL EXPEDIENTE</h3>
    <h3  class='titulo' id="titulomod">MODIFICAR CUERPO DEL EXPEDIENTE</h3>
    <div class="orden">
    
       <label class="">NOMBRE </label>
       <input style="width: 80%;" type="text" id="textnombrecuerpo" class="textform" name="textnombrecuerpo" autocomplete="off" placeholder="Nombre" required="" >
    </div>

    <div class="orden">
       <label class="">LINK</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input style="width: 80%;" type="text" id="textlinkcuerpo" class="textform" name="textlinkcuerpo" autocomplete="off" required="" placeholder="Link del cuerpo" >
    </div>
       
     <center> <input type='submit' class='btnclose'  name='btnguardarcuerpo' id="btnguardarcuerpo" value='GUARDAR'></center>
     <center> <input type="submit" class="btnclose" name="btnmodcuerpo" id="btnmodcuerpo" value="MODIFICAR"> 
     <input type="submit" class="btnclose" name="btnelimcuerpo" id="btnelimcuerpo" value="ELIMINAR"></center>
      
      
    

    
  </form>

   
</div><br>





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

    var btncloseguar = document.getElementById("btnguardarfile");

    var span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    btnclose.onclick=function() {
      modal.style.display = "none";
    }
    btncloseguar.onclick=function()
    {
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
      <center> <p style="font-size: 20px;font-family: fantasy;" >SUBIR UN ARCHIVO</p></center>
     </div><br>
    <form method="post" enctype="multipart/form-data" action="../controller/control-subirexpedientedigital.php" target="_blank" >
    <div class="modal-body">
      <label><b>Nota:</b> Evite Subir Archivos que contengan tilde, ya que pueden ser modificados por el sistema y el navegador no los reconocera para su lectura</label><br>
        <input type="hidden" class="textform" id="textidtribunal" name="textidtribunal" placeholder="id tribunal" value="<?php echo $filtrib->id_tribunal; ?>"><br>
        <input type="hidden" name="textlincarpeta" value="<?php echo $filtrib->linkcarpeta; ?>">
        <input type="file" style="width: 100%;" name="filecuerpoexpediente" class="textform">                                                

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btnguardarfile" name="btnguardarfile" value="Guardar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
         $('#btnmodcuerpo').hide();
         $('#titulomod').hide();
         $('#btnelimcuerpo').hide();

        $(document).ready(function(){
        $('.vinculo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
           $valor3=$(this).attr('parametro3');
          
          $('#textidcuerpomod').val($valor);
           $('#textnombrecuerpo').val($valor2);
           $('#textlinkcuerpo').val($valor3);
          
           
           $('#btnguardarcuerpo').hide();
           $('#titulocrear').hide();
           $('#btnmodcuerpo').show();
           $('#titulomod').show();
            $('#btnelimcuerpo').show();

        });

      });
  
</script>