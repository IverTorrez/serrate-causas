<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["abogado"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablafichaabog.css">
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
include_once('../controller/control_demandante.php');
include_once('../model/clscuerpoexpediente.php'); 

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codcausa=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/12345678910;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
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
        <div id="main_menu">
        
            <ul>
                

                <li  class="first_listleft" style="float: left; width: 600px;"><a >USUARIO:<?php echo $datos['nombreabog']; ?>  TIPO:Abogado</a></li>
                
                <li class="first_list" ><a href="miscausas.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" style="width: 220px; height: 45px;" onclick="location.href='listaorden.php?squart=<?php echo $codcausa; ?>'">LISTA DE ORDENES</button></li>

                    <?php
                    //$idabogado=2;
                    $idabogado=$datos["id_abogado"];
                    $objc=new Causa();
                    $lis=$objc->mostrariddelabogadoenunacausa($codigonuevo);
                    $fila=mysqli_fetch_object($lis);
                    if ($fila->id_abogado==$idabogado) 
                    {
                      ?>
                    <li><button style="width: 420px; height: 45px;" class="botones" onclick="location.href='demandante_demandado_tercerista.php?squart=<?php echo $codcausa; ?>'">AGREGAR DEMANDANTE/DEMANDADO/TERCERISTA</button></li>
                     <?php
                    }


                    ?>
                    
                    
                    <li><button class="botones" style="width: 220px; height: 45px;" onclick="window.open('impresiones/pdf/ficha_causa.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR TODO</button></li>

                    <?php
                    //$idabogados=2;
                    $objca=new Causa();
                    $list=$objca->mostrariddelabogadoenunacausa($codigonuevo);
                    $filac=mysqli_fetch_object($list);
                    if ($filac->id_abogado==$idabogado) 
                    {
                    ?>
                    <li><button style="width: 330px; height: 45px;" onclick="location.href='avancefisico.php?squart=<?php echo $codcausa; ?> '" class="botones">ACTUALIZAR EL AVANCE FISICO</button></li>

                    <?php
                    }
                    else
                    {
                    ?>
                     <li><button style="width: 330px; height: 45px;" class="botones" onclick="location.href='historigrama.php?squart=<?php echo $codcausa; ?> '">VER HISTORIGRAMA</button></li>

                    <?php
                    }

                    ?>
                    


                 
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
    <th>NOMBRE DEL PROCESO</th>
    <th width="19%">ABOGADO</th>
    <th width="19%">CLIENTE</th>
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->fichacausa($codigonuevo);
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
       <table id="tablafichaabog">
 <thead>     
  <tr>
    <th width="170px">FISIOLOGIA DEL TRIBUNAL</th>
    <th width="400px">NOMBRE DE TRIBUNAL</th>
    <th width="70px">VER UBICACION</th>
    <th width="100px">VER FOTO DE FACHADA</th>
    <th width="50px">PISO</th>
    <th width="100px"># DE EXP.</th>
    <th width="100px">EXPEDIENTE DIGITAL</th>
    <th width="100px">CODIGO JURIDICO</th>
    <th width="400px">CONTACTO 1</th>
    <th width="400px">CONTACTO 2</th>
    <th width="400px">CONTACTO 3</th>
    <th width="400px">CONTACTO 4</th>
   
  </tr>
</thead>
<tbody>
  <?php
  $objtibunal=new Tribunal();
  $lista=$objtibunal->listartribunalficha($codigonuevo);
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
            
              echo "<td>$fil->codnurejianuj</td>";
              echo "<td>$fil->cont1</td>";
              echo "<td>$fil->cont2</td>";
              echo "<td>$fil->cont3</td>";
              echo "<td>$fil->cont4</td>";
             
           
        echo "</tr>";
          }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA DEMANDANTE DE UNA CAUSA-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">DEMANDANTE</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <?php
    if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
    {
    echo '<th width="7%">BORRAR</th>';  
    }
    ?>
     
    
  </tr>
</thead>
<tbody>

  <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandante($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
          if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'> $fil->nombresdeman</a></td>";
          }
          else
          {
            echo "<td>$fil->nombresdeman</td>";
          }
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a onclick='funcionllevaidmodaldemandante($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
          }
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA DEMANDADO DE UNA CAUSA-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr >
    <th width="30%">DEMANDADO</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <?php
    if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
    {
    echo '<th width="7%">BORRAR</th>';  
    }
    ?>
  </tr>
</thead>
<tbody>


   <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandado($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
        if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'>$fil->nombresdeman</a></td>";
          }
          else
          {
           echo "<td>$fil->nombresdeman</td>"; 
          }
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a onclick='funcionllevaidmodaldemandado($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
          }
        echo "</tr>";
      }
  ?>

 
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA TERCERISTA DE UNA CAUSA-->
<section class="responsive">
 <table id="customers">
 <thead>     
  <tr>
    <th width="30%">TERCERISTA</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <?php
    if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
    {
    echo '<th width="7%">BORRAR</th>';  
    }
    ?>
  </tr>
</thead>
<tbody>
 
  <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listartercerista($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);
        echo "<tr id='filaprosa'>";
        if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a href='demandante_demandado_tercerista.php?squarts=$encriptado'> $fil->nombresdeman</a></td>";
          }
          else
          {
            echo "<td>$fil->nombresdeman</td>";
          }
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          if ($filac->id_abogado==$idabogado)/*PREGUNTA SI ESTA CAUSA ES DEL ABOGADO ACTUAL , PARA PODER ELIMINAR O HACER MODIFICACIONES*/
          {
          echo "<td><a onclick='funcionllevaidmodaltercerista($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
          }
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
<!-- BOTONES DE AGREGADO DE OBSERVACIONES, ESTRATEGIAS Y OTROS..... -->

            <div id="portfolio_menu">
                
                <ul>
                <?php
                    $idabogado=$datos["id_abogado"];
                    $objca1=new Causa();
                    $listca1=$objca1->mostrariddelabogadoenunacausa($codigonuevo);
                    $filaca1=mysqli_fetch_object($listca1);
                    if ($filaca1->id_abogado==$idabogado)
                    {
                ?>
                      <li><button class="botones" onclick="location.href='agregarobservacion.php?squart=<?php echo $codcausa; ?>'">AGREGAR OBSERVACION</button></li>

                    <li><button class="botones" style="background: #60d261;" onclick="location.href='agregarapuntesjuridicos.php?squart=<?php echo $codcausa; ?>'">AGREGAR APUNTES JURIDICOS</button></li>

                    <li><button class="botones" style="background: #60d261;" onclick="location.href='agregarapunteshonorarios.php?squart=<?php echo $codcausa; ?>'">AGREGAR APUNTES HONORARIOS</button></li>

                    <li><button class="botones" style="background: #60d261;" onclick="location.href='agregarinformacion.php?squart=<?php echo $codcausa; ?>'">AGREGAR OTROS APUNTES</button></li>
                   
                   <?php
                    }

                   ?>

                    
                 
                </ul><br>
                
            </div> <!-- END #portfolio_menu -->

<!--TABLA OBSERVACIONES DE UNA CAUSA-->
<h3 style="color: #000000;font-size: 25px;text-align: center;">EL ESPACIO DE LA CAUSA</h3><br>

<h3><b> Observaciones Públicas.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th>OBSERVACIONES</th>
  </tr>
</thead>
<tbody>
 <?php
  $objcausa=new Causa();
  $lista=$objcausa->mostrarobservaciones($codigonuevo);
      $fil=mysqli_fetch_object($lista);
        echo "<tr id='filaprosa'>";
           echo "<td>$fil->obsevacionescausas</td>";
        echo "</tr>";
    
  ?>
 
</tbody>
</table><br>

<h3><b>Objetivos (Pretensión Jurídica).-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th>OBJETIVOS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->objetivos</td>";
    ?>
  </tr>
  </tbody>
</table><br>


<h3><b>Estrategias (Guion Jurídico a seguir).-</b></h3>
<table id="customers">
 <thead>     
  <tr>
    <th>ESTRATEGIAS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->estrategias</td>";
    ?>
  </tr>
 
</tbody>
</table><br>

<h3><b>Apuntes Jurídicos.-</b></h3>
 <table id="customers">
 <thead>     
  <tr >
    <th style="background: #60d261;">APUNTES JURIDICOS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->apuntesjuridicos</td>";
    ?>
  </tr>
 
</tbody>
</table><br>


<h3><b>Apuntes sobre honorarios.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th style="background: #60d261;">HONORARIOS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
   <?php
    echo "<td>$fil->apunteshonorarios</td>";
    ?>
  </tr>
 
</tbody>
</table><br>


<h3><b>Apuntes sobre otra información de la causa.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th style="background: #60d261;">OTRA INFORMACION</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fil->informacion</td>";
    ?>
  </tr>
 
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


 
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
