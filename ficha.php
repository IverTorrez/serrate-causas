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
    <title>ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablaficha.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>



    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>

</head>
<body>
<?php
include_once('model/clscausa.php');
include_once('model/clstribunal.php');
include_once('model/clsdemandante_demandado.php');
include_once('model/clscuerpoexpediente.php');

include_once('model/clscliente.php');
include_once('model/clsabogado.php');
include_once('model/clsusuario.php');
include_once('model/clsplanilla_notificacion.php');

include_once('controller/control-congelarcausa.php');
include_once('controller/control-terminarcausa.php');
include_once('controller/control_demandante.php');
include_once('controller/contro-tribunal.php');

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

   $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

  $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

   $objcausa1=new Causa();
   $result1=$objcausa1->mostrarCantidadOrdenesSinSerrar($codigonuevo);
   $fil1=mysqli_fetch_object($result1);
   

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
        
       <p id="codcausas"><?php echo $fil->codigo; ?> </p>
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
                    <li><button style="width: 300px;" class="botones" onclick="location.href='tribunalFicha.php?squart=<?php echo $codcausa; ?>'">AGREGAR TRIBUNAL</button></li>
                    <li><button style="width: 350px;" class="botones" onclick="location.href='demandante_demandado.php?squart=<?php echo $codcausa ?>'">AGREGAR DEMANDANTE/DEMANDADO/TERCERISTA</button></li>
                   <form method="post">
                    <input type="hidden" placeholder="cantidad de ordenes sin serrar" name="textcant" id="textcant" value="<?php echo $fil1->conteosinserrar; ?>">
                    <input type="hidden" placeholder="id causa" name="textidcausa" id="textidcausa" value="<?php echo $codigonuevo; ?>">
                    <?php
                     if ($fil->estadocausa=='Congelada') 
                     {
                      echo '<li><button type="button" class="botones" style="width: 200px;background: #EEEEEE; color: #9A9DA6; border-color:#AEAFAF;">CONGELAR CAUSA</button></li>';
                     }
                     else
                     {
                     ?>

                      <li><button class="botones" name="btncongelar" style="width: 200px;">CONGELAR CAUSA</button></li>
                     <?php
                     }
                    ?>
                    

                    <li><button class="botones" name="btnterminar" style="width: 200px;">TERMINAR CAUSA</button></li>
                    </form> 

                    <li><button class="botones" onclick="location.href='listaordenes.php?squart=<?php echo $codcausa; ?>'">LISTA DE ORDENES</button></li>
                   
                </ul>
                 

                <ul>
                <li><button style="width: 185px" class="botones" onclick="location.href='agregarobservacion.php?squart=<?php echo $codcausa ?>'">AGREGAR OBSERVACION</button></li>
                <li><button style="width: 185px" class="botones" onclick="location.href='historigrama.php?squart=<?php echo $codcausa; ?>'">VER HISTORIGRAMA</button></li>
                
                 <!-- AGREGAREMOS EL SELECT DE COLORES CON EL BOTON DE APLICAR COLORES -->
                <li style="margin-left: 50px;">
                  <select class="form-cotrol" style="height: 35px;" id="selectcolor" name="selectcolor">
                       <option value="">Sin color</option>
                       <option value="#FFE900">Amarillo  </option>
                       <option value="#002FBB">Azul</option>
                       <option value="#0CB7F2">Celeste</option>
                       <option value="#FF0080">Fucsia</option>
                       <option value="#952F57">Guindo</option>
                       <option value="#EF7F1A">Naranja</option>
                       <option value="#E60026">Rojo</option>
                       <option value="#009846">Verde</option>
                       <option value="#78288C">Violeta</option>
                       <option value="#5DC1B9">Turquesa</option>
                       
                   </select> 
              </li>
              
              <li><button class="botones" id="btnaplicarcolor" name="btnaplicarcolor">Aplicar color</button></li>
                <!-- AGREGAREMOS EL SELECT DE COLORES CON EL BOTON DE APLICAR COLORES -->
                
                <li style="float: right;"><button  class="botones" onclick="window.open('impresiones/tcpdf/pdf/ficha_causa.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR FICHA</button></li>
                  
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
 

 
  <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
    <br>
    
    <!--TABLA 1-->
<table id="customers">
 <thead>     
  <tr>
    <th width="14%">CODIGO</th>
    <th>NOMBRE DEL PROCESO</th>
    <th width="19%">ABOGADO</th> 
    <th width="19%">CLIENTE</th>
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->fichacausa($codigonuevo);
   while ($fil=mysqli_fetch_object($resul)) {
        $nombreCausa=$fil->nombrecausa;
        $nombabogado=($fil->abogadogestor);
        $nombcliente=($fil->clienteasig);
        $nombProc   =($fil->procuradorasig);
       echo "<tr>";
              echo "<td>$fil->codigo</a></td>";
              echo "<td>$nombreCausa</td>";
              echo "<td>$nombabogado</td>";
              echo "<td>$nombcliente</td>";
              echo "<td>$nombProc</td>";
           
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
       <table  id="tablaficha" border="1">
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
  $lista=$objtibunal->listartribunalficha($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)) {
           $tipotribu=($fil->tptribu);
           $juzgado=($fil->juzg);
           $piso=($fil->Pis);
           $expediente=($fil->expediente);
           $contacto1=($fil->cont1);
           $contacto2=($fil->cont2);
           $contacto3=($fil->cont3);
           $contacto4=($fil->cont4);
       echo "<tr >";
              echo "<td>$tipotribu</td>";
              echo "<td>$juzgado</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td>$piso</td>";
              echo "<td>$expediente</td>";
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
              echo "<td>$contacto1</td>";
              echo "<td>$contacto2</td>";
              echo "<td>$contacto3</td>";
              echo "<td>$contacto4</td>";
              
              echo "<td><a onclick='funcionllevaidmodalelimtrib($fil->id_tribunal)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
           
        echo "</tr>";
          }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>

<style type="text/css">
  
</style>
<!--TABLA DEMANDANTE DE UNA CAUSA-->
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
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandante($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);

        $nombdeman=($fil->nombresdeman);
        $ultdomicilio=($fil->ultimodomicilio);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado.php?squarts=$encriptado'> $nombdeman</a></td>";
          echo "<td>$ultdomicilio</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaldemandante($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
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
  <tr>
    <th width="30%">DEMANDADO</th>
    <th>ULTIMO DOMICILIO SEÑALADO</th>
    <th width="5%">FOJAS</th>
    <th width="7%">BORRAR</th>
  </tr>
</thead>
<tbody>
 

  <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandado($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);
        $nomdemandado=($fil->nombresdeman);
        $ultdomi=($fil->ultimodomicilio);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado.php?squarts=$encriptado'>$nomdemandado</a></td>";
          echo "<td>$ultdomi</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaldemandado($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
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
    <th width="7%">BORRAR</th>
  </tr>
</thead>
<tbody>
 
  <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listartercerista($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        $mascara=$fil->id_deman*456789;
        $encriptado=base64_encode($mascara);
        $nombtercerista=($fil->nombresdeman);
        $ultdomi=($fil->ultimodomicilio);
        echo "<tr id='filaprosa'>";
          echo "<td><a href='demandante_demandado.php?squarts=$encriptado'>$nombtercerista</a></td>";
          echo "<td>$ultdomi</td>";
          echo "<td style='text-align: center;'>$fil->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaltercerista($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>

<div id="main_content">
            
        <div id="portfolio_area">
            
            
            
            <div id="portfolio_menu">
<ul>
  <li><button style="width: 397px;" class="botones" onclick="location.href='agregarobservacion.php?squart=<?php echo $codcausa ?>'">AGREGAR OBSERVACION</button></li>
   <li><button style="width: 397px;" class="botones" onclick="location.href='agregarobjetivos.php?squart=<?php echo $codcausa ?>'">AGREGAR OBJETIVOS</button></li>
    <li><button style="width: 397px;" class="botones" onclick="location.href='agregarestrategias.php?squart=<?php echo $codcausa ?>'">AGREGAR ESTRATEGIAS</button></li>
</ul><br>
</div>

</div>
</div>
<h3 style="color: #000000;font-size: 25px;text-align: center;">EL ESPACIO DE LA CAUSA</h3><br>
<!--TABLA OBSERVACIONES-->
<section class="responsive">
<h3><b> Observaciones Públicas.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th>OBSERVACIONES</th>
  </tr>
</thead>
<tbody>

  <?php
  /*FUNCION PARA MOSTRAR LAS OBSERVACIONES, APUNTES, ETC*/
  $objcausa=new Causa();
  $lista=$objcausa->mostrarobservaciones($codigonuevo);
      $fil=mysqli_fetch_object($lista);

        $observaciones=($fil->obsevacionescausas);
        $objetivos=($fil->objetivos);
        $estrategias=($fil->estrategias);
        $apuntesjuridicos=($fil->apuntesjuridicos);
        $apunteshonorarios=($fil->apunteshonorarios);
        $informacion=($fil->informacion);
        echo "<tr >";
           echo "<td>$observaciones</td>";
        echo "</tr>";
      
  ?>
 
</tbody>
</table><br>

<h3><b> Objetivos (Pretensión Jurídica).-</b></h3>
<table id="customers">
 <thead>     
  <tr>
    <th>OBJETIVOS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$objetivos</td>";
    ?>
  </tr>
  </tbody>
</table><br>

<h3><b> Estrategias (Guion Jurídico a seguir).-</b></h3>
<table id="customers">
 <thead>     
  <tr>
    <th>ESTRATEGIAS</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
     <?php
    echo "<td>$estrategias</td>";
    ?>
  </tr>
 
</tbody>
</table><br>

<h3><b>Apuntes Jurídicos.-</b></h3>
<table id="customers">
 <thead>     
  <tr>
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
    echo "<td>$apunteshonorarios</td>";
    ?>
  </tr>
 
</tbody>
</table><br>

<h3><b>Otros apuntes de la causa.-</b></h3>
 <table id="customers">
 <thead>     
  <tr>
    <th style="background: #60d261;">OTRA INFORMACION</th>
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$informacion</td>";
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
        <input type="hidden" name="textidcausa1" id="textidcausa1" placeholder="id causa" value="<?php echo $codigonuevo; ?>">
        <input type="hidden" class="textform" id="textidtribunal" name="textidtribunal" placeholder="id tribunal" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminartribcausa" name="btneliminartribcausa" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformprestrib" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>








<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>

<script type="text/javascript">
  /**********************boton asignar colores a la causa*************************************************/
$(document).ready(function() { 
   $("#btnaplicarcolor").on('click', function() {

   /*cargamos los inputs a nuevas variables*/ 
   var formDataColor = new FormData(); 
   
   var textid_causa=$('#textidcausa').val();
   var selectcolor=$('#selectcolor').val();
   
   
    /*CARGAMOS EL GIF DE CARGANDO Y PONEMOS DISABLED EL BOTON*/
   if ( (textid_causa=='') ) 
   {
     setTimeout(function(){  }, 2000); swal('ATENCION','Algunos datos se perdieron, recargue la pagina e intente nuevamente por favor','warning');
     
     
   }
   else
   {
     /*cargamos las nueva variables a a los parametros que se enviara al archivo php */
     formDataColor.append('textid_causa',textid_causa);
     formDataColor.append('selectcolor',selectcolor);
     
      $.ajax({ url: 'controller/control-asignarcolor_causa.php', 
               type: 'post', 
               data: formDataColor, 
               contentType: false, 
               processData: false, 
               success: function(response) { 
                 if (response == 1) { 
                    setTimeout(function(){ location.href='causasActivas.php'; }, 1000); swal('EXELENTE','Se asigno color con exito','success'); 
                    } 
                    if (response==0) 
                   {
                   /*QUITAMOS EL CARGANDO Y QUITAMOS EL DISABLED DEL BOTON*/ 
                    
                    setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal intente nuevamente por favor','error');
                   
                    //alert('Formato de imagen incorrecto.'); 
                    }
                  
                 
                } 
            }); 

      }/*FIN DEL ELSE QUE SE EJECTUTA AL CONFIRMAR QUE TODOS LOS CAMPOS FUERON LLENADOS*/
        return false;


    }); 
  });
/*******************************************fin boton asignar colores***********************************/
</script>

