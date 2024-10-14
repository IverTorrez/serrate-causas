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
<html>
<head>
    <title>ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablafichaabog.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablaficha.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="../resources/jquery.min.js"></script>
</head>
<body>
<?php

include_once('../model/clscausa.php');
include_once('../model/clstribunal.php');

include_once('../model/clsdemandante_demandado.php'); 
include_once('../model/clscuerpoexpediente.php');
include_once('../controller/control_demandante.php'); 
include_once('../controller/contro-tribunal.php');


  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

   $codcausa=$_GET['squart'];

    //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevocausa=$decodificado/1213141516;

    $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevocausa);
   $fil=mysqli_fetch_object($resul);
  //  echo "<td style='width: 10%;'>$fil->codigo</td>";

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
        <div id="main_menu">
        
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
            
            <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" style="width: 200px; height: 45px;" onclick="location.href='pm_lista_ordenes.php?squart=<?php echo $codcausa; ?>'">LISTA DE ORDENES</button></li>
                    <li><button class="botones" style="width: 200px;height: 45px;" onclick="location.href='agregartribunalficha.php?squart=<?php echo $codcausa; ?>'" >AGREGAR TRIBUNAL</button></li>
                    <li><button class="botones" style="width: 400px;height: 45px;" onclick="location.href='demandante_demandado_tercerista.php?squart=<?php echo $codcausa; ?>'">AGREGAR DEMANDANTE/DEMANDADO /TERCERISTA</button></li>
                    
                    <li><button class="botones" style="width: 195px;height: 45px;" onclick="location.href='agregarobservacion.php?squart=<?php echo $codcausa; ?>'">AGREGAR OBSERVACION</button></li>
                    <li><button class="botones" style="width: 193px;height: 45px;" onclick="window.open('impresiones/pdf/ficha_causa.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR FICHA</button></li>
                    
                </ul><br>

                <ul>
                  <li><button class="botones" style="width: 193px;height: 45px; " onclick="location.href='historigrama.php?squart=<?php echo $codcausa; ?>'">VER HISTORIGRAMA</button></li>
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">
   <section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">FICHA</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
  <tr>
    <th width="14%">CODIGO</th>
    <th>NOMBRE DE LA CAUSA</th>
    <th width="19%">ABOGADO</th>
    <th width="19%">CLIENTE</th>
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->fichacausa($codigonuevocausa);
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
              echo "<td>$fil->codigo</a></td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->clienteasig</td>";
              echo "<td>$fil->procuradorasig</td>";
              
           
        echo "</tr>";
          }
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->
<section class="responsive">
       <table id="tablaficha">
 <thead>     
  <tr>
   <th width="170px">FISIOLOGIA DEL TRIBUNAL</th>
    <th width="400px">NOMBRE DE TRIBUNAL</th>
    <th width="70px">VER UBICACION</th>
    <th width="100px">VER FOTO DE FACHADA</th>
    <th width="50px">PISO</th>
    <th width="100px"># DE EXP.</th>
    <th width="100px">EXPEDIENTE DIGITAL</th>
    <th width="70px">AGREGAR A EXPEDIENTE DIGITAL</th>
    <th width="130px">CODIGO JURIDICO</th>
    <th width="400px">CONTACTO 1</th>
    <th width="400px">CONTACTO 2</th>
    <th width="400px">CONTACTO 3</th>
    <th width="400px">CONTACTO 4</th>
    <th width="70px">BORRAR</th>
  </tr>
</thead>
<tbody>
  <?php
  $objtibunal=new Tribunal();
  $lista=$objtibunal->listartribunalficha($codigonuevocausa);
      while ($fil=mysqli_fetch_object($lista)) {
       echo "<tr>";
              echo "<td>$fil->tptribu</td>";
              echo "<td>$fil->juzg</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='../fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td>$fil->Pis</td>";
              echo "<td>$fil->expediente</td>";
              echo "<td>";
              ?>

                        <select name='selectcuerpo' onchange="window.open(this.value)">
                           <option value="">Seleccione</option>
                          <?php
                          $objcuerpo=new CuerpoExpediente();
                          $resulcuerpo=$objcuerpo->mostrarLosCuerposDeExpedientesDeTribunal($fil->id_tribunal);
                          while($filcu=mysqli_fetch_array($resulcuerpo))
                          {
                            echo '<option value="'.$filcu['linkcuerpo'].'">'.$filcu['nombrecuerpo'].'</option>';
                          }
                          ?>
                         </select>
              <?php
              echo "</td>";
              
              $mascara=$fil->id_tribunal*1234567;
              $encriptado=base64_encode($mascara);
              echo "<td><a href='expedientedigital.php?squart=$encriptado'><center><i class='fa fa-print fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td>$fil->codnurejianuj</td>";
              echo "<td>$fil->cont1</td>";
              echo "<td>$fil->cont2</td>";
              echo "<td>$fil->cont3</td>";
              echo "<td>$fil->cont4</td>";
              echo "<td><a onclick='funcionllevaidmodalelimtrib($fil->id_tribunal)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
           
        echo "</tr>";
          }
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 3-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">DEMANDANTE</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <th width="7%">BORRAR</th>
  
  </tr>
</thead>
<tbody>
   <?php
  $obdem1=new Demandante_Demandado();
  $lista1=$obdem1->listardemandante($codigonuevocausa);
      while ($fil1=mysqli_fetch_object($lista1)){
        $mascara=$fil1->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'> $fil1->nombresdeman<a></td>";
          echo "<td>$fil1->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil1->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaldemandante($fil1->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 4-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">DEMANDADO</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <th width="7%">BORRAR</th>
  </tr>
</thead>
<tbody>
   <?php
  $obdem2=new Demandante_Demandado();
  $lista2=$obdem2->listardemandado($codigonuevocausa);
      while ($fil2=mysqli_fetch_object($lista2)){
        $mascara=$fil2->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'>$fil2->nombresdeman</a></td>";
          echo "<td>$fil2->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil2->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaldemandado($fil2->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br><br>
<!--TABLA TERCERISTA-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">TERCERISTA</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <th width="7%">BORRAR</th>
  </tr>
</thead>
<tbody>
  <?php
  $obdem3=new Demandante_Demandado();
  $lista3=$obdem3->listartercerista($codigonuevocausa);
      while ($fil3=mysqli_fetch_object($lista3)){
        $mascara=$fil3->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'>$fil3->nombresdeman<a></td>";
          echo "<td>$fil3->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil3->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaltercerista($fil3->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
        echo "</tr>";
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
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL DENADANTE 
  function funcionllevaidmodaldemandante(idd)
  {
    $('#textiddeman').val(idd);
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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un demandante -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR DEMANDANTE</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Demandante ??</b></label><br><br>
        <input type="hidden" name="texttipod" id="texttipod" value="Demandante">
        <input type="hidden" class="textform" id="textiddeman" name="textiddeman" placeholder="id demandante" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminardeman" name="btneliminardeman" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>








<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL DENADANTE 
  function funcionllevaidmodaldemandado(idd)
  {
    $('#textiddemandado').val(idd);
    var modal = document.getElementById("myModaldeman");
    var btnclose = document.getElementById("btncloseformpresdema");
    var span = document.getElementById("spanclosepresdeman");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un demandante -->
<div id="myModaldeman" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepresdeman">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR DEMANDADO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Demandado ??</b></label><br><br>
        <input type="hidden" name="texttipod" id="texttipod" value="Demandado">
        <input type="hidden" class="textform" id="textiddemandado" name="textiddeman" placeholder="id Demandado" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminardeman" name="btneliminardeman" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpresdema" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>









<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL DENADANTE 
  function funcionllevaidmodaltercerista(idd)
  {
    $('#textidtercer').val(idd);
    var modal = document.getElementById("myModaltercer");
    var btnclose = document.getElementById("btncloseformpresterce");
    var span = document.getElementById("spanclosepresterce");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un demandante -->
<div id="myModaltercer" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepresterce">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR TERCERISTA</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Tercerista ??</b></label><br><br>
        <input type="hidden" name="texttipod" id="texttipod" value="Tercerista">
        <input type="hidden" class="textform" id="textidtercer" name="textiddeman" placeholder="id Demandado" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminardeman" name="btneliminardeman" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpresterce" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<!--**************MODAL PARA ELIMINAR UN TRIBUNAL DE LA CAUSA *************************-->

<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL DENADANTE 
  function funcionllevaidmodalelimtrib(idd)
  {
    $('#textidtribunal').val(idd);
    var modal = document.getElementById("myModalelimtrib");
    var btnclose = document.getElementById("btncloseformprestrib");
    var span = document.getElementById("spancloseprestrib");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un demandante -->
<div id="myModalelimtrib" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseprestrib">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR TRIBUNAL</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Tribunal de esta Causa ??</b></label><br><br>
        <input type="hidden" name="textidcausa1" id="textidcausa1" placeholder="id causa" value="<?php echo $codigonuevocausa; ?>">
        <input type="hidden" class="textform" id="textidtribunal" name="textidtribunal" placeholder="id Tribunal" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminartribcausa" name="btneliminartribcausa" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformprestrib" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>









<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
