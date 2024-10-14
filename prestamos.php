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
    <title>Prestamos</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
    
     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">
      <script src="js/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
</head>
<body>
<?php
include_once('model/clsprestamos.php');


include_once('model/clscausa.php');
include_once('model/clsprocurador.php');
include_once('model/clspagoprocurador.php');
include_once('model/clstransferencia_contador.php');/*nuevo*/
include_once('model/clsretiros.php');
include_once('model/clscajasdesalida.php');
include_once('controller/control-caja.php');/*PRESTAMO EXTERNO Y DEVOLUCIONES*/

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
                    <li><button class="botones" id='myBtnformpres'>RECIBIR PRESTAMO</button></li>
                    <li><button class="botones" id='myBtnformdevol'>DEVOLVER PRESTAMO</button></li>
                    
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
    <?php



    ?>
    
   

</div>

<br>
<br>

<div class="container">
   <section>



    <!--*************TABLA PRESTAMOS DE TERCEROS*******************************************************-->
       
<div class="container">
  <h3 style="color: #000000;font-size: 23px;text-align: left; text-shadow: -2px -2px 5px #333">D).-PRESTAMOS DE TERCEROS</h3><br>
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>
   <!-- <th width="7%">CODIGO</th>
    <th width="10%">MONTO ANTES DEL RETIRO</th>-->

    <th width="10%">FECHA DE PRESTAMO</th>
    <th width="70%">DETALLE DEL PRESTAMO</th>
    <th width="10%">INGRESO</th>
    <th width="10%">EGRESO</th>
   <!-- <th width="10%">MONTO DESPUES DEL RETIRO</th>-->
      
  </tr>
</thead>
<tbody>
  <?php
   $subtotalpres=0;
   $subtotaldev=0;
   $totaldeuda=0;
   $objprest=new Prestamos();
   $resulprest=$objprest->listar_prestamos();
   while ($filpres=mysqli_fetch_object($resulprest)) 
        {
          if ($filpres->tipo_prestamo=='Prestamo') 
          {
            $subtotalpres=$subtotalpres+$filpres->monto_prestamo;//subtotal de prestamos
            $prestamo=$filpres->monto_prestamo;
            $devol='';
          }
          if ($filpres->tipo_prestamo=='Devolucion') 
          {
            $subtotaldev=$subtotaldev+$filpres->monto_prestamo;
            $prestamo='';
            $devol=$filpres->monto_prestamo;
          }

          
       echo "<tr>";
            //  echo " <td>RET-$filret->id_retiro</td>";
              echo " <td>$filpres->fecha_prestamo</td>";
              echo " <td style='text-align: justify;'>$filpres->detalle_prestamo</td>";
             // echo " <td>$filret->montototalcaja</td>";
              //PRESTAMO
              echo " <td style='text-align: right;'>$prestamo</td>"; 
              //DEVOLUCUION
               echo " <td style='text-align: right;'>$devol</td>"; 
             // echo " <td>$filret->monto_sobrante</td>";
              
              

        echo "</tr>";
          }
  ?>

  <tr>
    <td colspan="2">SUBTOTALES</td>
          
    <?php
      echo "<td style='text-align: right;'><b>$subtotalpres</b></td>";
      echo "<td style='text-align: right;'><b>$subtotaldev</b></td>";
    ?>

    </tr>


     <tr>
    <td colspan="3">TOTAL DEUDA</td>
          
    <?php
       $totaldeuda=$subtotalpres-$subtotaldev;
      echo "<td style='text-align: right;font-size: 25px;font-weight: bold;'>$totaldeuda</td>";
      
    ?>

    </tr>
</tbody>
</table>
</section>
</div>
<br><br><br><br>
<!--**********************FIN DE LA TABLA PRESTAMOS DE TERCEROS*****************************-->

 
</section>
</div>
    <br>
    <br>
    <br>















<!------------------------------TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE (OCULTAMOS ESTA TABLA A)--------------------->

<div class="container" style="display: none;">
  <h3  style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">DEPOSITOS Y DEVOLUCIONES TOTALES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES</h3>
  <div style="overflow: scroll; height: 300px;">

<table id="customers">
  <thead>
    <tr>
      <th colspan="5">DEPOSITOS Y DEVOLUCIONES TOTALES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES</th>
    </tr>

    <tr>
      <th>CODIGO DE LA CAUSA</th>
      <th>CLIENTE</th>
      <th>DEPOSITOS (ingresos)</th>
      <th>DEVOLUCION (egresos)</th>
      <th>SALDO</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $totaldepositosd=0;
    $totaldevolucion=0;
    $saldocausa_depo_devo=0;/*ES EL SALDO DE CAUSA(TOTAL DEPOSITOS MENOS TOTAL DEVOLUCIONES) DE UNA CAUSA*/
    $totaldepositosMenosDevolucion=0;/*DEPOSITOS MENOS DEVOLUCIONES DE TODAS LAS CAUSAS*/
    $totalsaldos=0;
    $objcausa=new Causa();
    $resultcausa=$objcausa->mostrarcodigocausaysaldoYcliente();
    while ($filcausa=mysqli_fetch_object($resultcausa)) 
    {
      echo "<tr>";
        echo "<td>$filcausa->codigo</td>";
        echo "<td style='text-align: left;'>$filcausa->nombcli</td>";
        
        //$objcausa1=new Causa();
        $resuldepos=$objcausa->totalDeDepositosDeCausa($filcausa->idcausa);
        $fildepos=mysqli_fetch_object($resuldepos);

        $resuldev=$objcausa->totalDevueltoAlCliente($filcausa->idcausa);
        $fildev=mysqli_fetch_object($resuldev);

        echo "<td style='text-align: right;'>$fildepos->totaldeposito</td>";
        $totaldepositosd=$totaldepositosd+$fildepos->totaldeposito;

        echo "<td style='text-align: right;'>$fildev->totaldevuelto</td>";
        $totaldevolucion=$totaldevolucion+$fildev->totaldevuelto;
        
        $saldocausa_depo_devo=$fildepos->totaldeposito-$fildev->totaldevuelto;
        echo "<td style='text-align: right;'>$saldocausa_depo_devo</td>";
        $totalsaldos=$totalsaldos+$filcausa->caja;
      echo "</tr>";
    }

    ?>
    <tr>
      <td colspan="2">TOTALES</td>
      <td style='text-align: right;'><?php echo $totaldepositosd; ?></td>
      <td style='text-align: right;'><?php echo $totaldevolucion; ?></td>
      <?php
      $totaldepositosMenosDevolucion=$totaldepositosd-$totaldevolucion
      ?>
      <td style='text-align: right; font-size: 25px; font-weight: bold;'><?php echo $totaldepositosMenosDevolucion; ?></td>
    </tr>
    
  </tbody>
 </table>
  </div>
</div>

<!--FIN DE TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE-->

















<!---------------------------------TABLA RELACION ADMIN-CONTADOR------------------------------>



   <div class="container" style="display: none;">
    <table id="customers">
      <head>
        <tr> 
          <th colspan="3">RELACION ADMINISTRADOR-CONTADOR</th>
        </tr>

        <tr>
        <th>FECHA</th>
        <th>ENTREGAS AL CONTADOR (egresos)</th>
        <th>DEVOLUCIONES DEL CONTADOR (ingresos)</th>
        </tr>

      </head>

      <?php
      $totalrelacioncont=0;


      $depositocont=0;
      $subtotaldepositocont=0;

      $devolucioncont=0;
      $subtotaldevolucioncont=0;
      $objtrans=new TransferenciaContador();
      $resultran=$objtrans->listarTransferenciasCOntador();
      while ($filtran=mysqli_fetch_object($resultran)) 
      {
            if ($filtran->tipo_trans=='Deposito') 
            {
              $depositocont=$filtran->monto_trans;
              $subtotaldepositocont=$subtotaldepositocont+$depositocont;
              $devolucioncont='';
            }
            if ($filtran->tipo_trans=='Devolucion') 
            {
              $depositocont='';
              $devolucioncont=$filtran->monto_trans;
              $subtotaldevolucioncont=$subtotaldevolucioncont+$devolucioncont;
            }

        echo "<tr>";
        echo "<td>$filtran->fecha_trans</td>";
        echo "<td style='text-align: right;'>$depositocont</td>";
        echo "<td style='text-align: right;'>$devolucioncont</td>";


        echo "</tr>";
      }
      ?>

     <tr>
       <td>SUBTOTALES</td>
       <td style='text-align: right;'><?php echo $subtotaldepositocont; ?></td>
       <td style='text-align: right;'><?php echo $subtotaldevolucioncont; ?></td>
     </tr>
     
     <?php
     $totalrelacioncont=$subtotaldevolucioncont-$subtotaldepositocont;
     ?>
     <tr>
       <td colspan="2">TOTAL</td>
       <td style='text-align: right;'><?php echo $totalrelacioncont; ?></td>
     </tr>

      <tbody>
        
      </tbody>
    </table>
   </div> 
  <!--*********************FIN DE LA TABLA RELACION ADMIN-CONTADOR***************************-->





















<!--PAGOS HECHOS A PROCURADORES     (OCULTAMOS ESTA TABLA)-->
<div class="container" style="display: none;">
  <h2 style="color: #000000;font-size: 30px; text-shadow: -2px -2px 5px #333; text-align: left;">PAGO A PROCURADORES</h2>
  
   <section>
 <table id="customers"  >

 <thead>     
  <tr>
    <th>FECHA</th> 
    <th>NOMBRE DEL PROCURADOR</th>
    <th>MONTO</th>
  </tr>
</thead>
<tbody>
  <?php
    $totalpagado=0;
   $objpago=new PagoProcurador();
   $resulpago=$objpago->mostrarTodosLosPagos();
   while ($filpago=mysqli_fetch_object($resulpago)) {
             $totalpagado=$totalpagado+$filpago->pagoproc;
       echo "<tr>";
              echo "<td>$filpago->fechapago</td>";        
              echo "<td style='text-align: left;'>$filpago->procu</td>";
              echo "<td style='text-align: right;'>$filpago->pagoproc</td>";
        echo "</tr>";
          }
  ?>
  <tr>
     <td colspan="2">TOTAL PAGADO</td>
    <?php
      echo "<td style='text-align: right; font-size: 25px;'><b> $totalpagado</b></td>";
    ?>
  </tr>
</tbody>
</table>
</section>
</div>




















<!--***************************TABLA RETIROS (OCULTAMOS ESTA TABLA)************************-->
<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333;display: none; ">RETIROS</h3>
<div class="container" style="display: none;">
   <section>
 <table id="customers" class="customers" >
 <thead>     
  <tr>
   <!-- <th width="7%">CODIGO</th>
    <th width="10%">MONTO ANTES DEL RETIRO</th>-->

    <th width="10%">FECHA DE RETIRO</th>
    <th width="80%">DETALLE DEL RETIRO</th>
    <th width="10%">MONTO RETIRADO</th>

   <!-- <th width="10%">MONTO DESPUES DEL RETIRO</th>-->
    
   
  </tr>
</thead>
<tbody>
  <?php
   $totalretiros=0;
   $objret=new Retiros();
   $resulret=$objret->listar_retiros();
   while ($filret=mysqli_fetch_object($resulret)) {
          $totalretiros=$totalretiros+$filret->monto_retiro;
       echo "<tr>";
            //  echo " <td>RET-$filret->id_retiro</td>";
              echo " <td>$filret->fecha_retiro</td>";
              echo " <td style='text-align: justify;'>$filret->detalle_retiro</td>";
             // echo " <td>$filret->montototalcaja</td>";
              echo " <td style='text-align: right;'>$filret->monto_retiro</td>"; 
             // echo " <td>$filret->monto_sobrante</td>";
              
              

        echo "</tr>";
          }
  ?>

  <tr>
    <td colspan="2">TOTAL RETIROS</td>
          
    <?php
      echo "<td style='text-align: right;font-size: 25px;'><b> $totalretiros</b></td>";
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

<!--**************************FIN DE LA TABLA RETIROS**************************-->










<div style="display: none;">
<tr >
    <td style="font-weight: bold;">TOTAL EN CAJA  DEL ADMINISTRADOR</td>
          
    <?php
      $totalencajadeladmin=$totaldepositosMenosDevolucion+($totalrelacioncont)-($totalpagado)+$totaldeuda-($totalretiros);
      echo "<td style='text-align: right; font-size:25px;'><b>$totalencajadeladmin</b></td>";
    ?>

</tr>
</div>


   






<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>





            <!-- The Modal (FORMULARIO) PARA recibir prestamo externo -->
<div id="myModalformpres" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >PRESTAMO EXTERNO</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormPrestamoexterno(this);">
    <div class="modal-body">
      <label><b>Ingrese el monto en Bs.(El sistema solo aceptara numeros enteros)</b></label><br><br>
       <input type="hidden" name="textidusu" id="textidusu" value="<?php echo $datos['id_usuario']; ?>">
        <input type="number" class="textform" id="textmontoprestamo" name="textmontoprestamo" placeholder="Monto del Prestamo" required><br>

      <label><b>Detalle Del Prestamo</b></label><br><br>
        <textarea style="height: 50px; width: 100%;" placeholder="Escriba el detalle del prestamo" name="textdetpres" id="textdetpres"></textarea>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;width: 180px;" type="submit" class="btnclose" id="btnrecibirprestamo" name="btnrecibirprestamo" value="RECIBIR PRESTAMO">
    <button class="btnclose" type="button" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) prestamo externo-->
<script>
// Get the modal
var modalformpres = document.getElementById("myModalformpres");

// Get the button that opens the modal
var btnpre = document.getElementById("myBtnformpres");
var btncloseformpres = document.getElementById("btncloseformpres");

// Get the <span> element that closes the modal
var spanclosepres = document.getElementById("spanclosepres");

// When the user clicks the button, open the modal 
btnpre.onclick = function() {
  modalformpres.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosepres.onclick = function() {
  modalformpres.style.display = "none";
}
btncloseformpres.onclick=function() {
  modalformpres.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>











                <!-- The Modal (FORMULARIO) PARA devolver prestamo externo -->
<div id="myModalformdevol" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosedevol">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >DEVOLVER PRESTAMO EXTERNO</p></center>
     </div><br>
    <form method="post" onsubmit="return validarFormDevolverPrestamo(this);">
      <input type="hidden" name="textidusu" id="textidusu" value="<?php echo $datos['id_usuario']; ?>">
    <div class="modal-body">
      <label><b>Ingrese el monto en Bs.(El sistema solo aceptara numeros enteros)</b></label><br><br>
       <input type="number" class="textform" id="textmontodevolver" name="textmontodevolver" placeholder="Monto que devolvera" required><br>
                                                        
      <input type="hidden" name="textmontoactulacajaadm" id="textmontoactulacajaadm" value="<?php echo $totalencajadeladmin;?>">
      
                                                        
      <label><b>Detalle De La Devolucion</b></label><br><br>
        <textarea style="height: 50px; width: 100%;" placeholder="Escriba el detalle de la devolucion" name="textdetdev" id="textdetdev"></textarea>

    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; width: 180px;" type="submit" class="btnclose" id="btndevolverp" name="btndevolverp" value="DEVOLVER PRESTAMO">
     
    <button class="btnclose" type="button" id="btncloseformdevol"  style="float: right;">Cancelar</button>
     

    </div>
    </form>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) devolver prestamo-->
<script>
// Get the modal
var modalformdevol = document.getElementById("myModalformdevol");

// Get the button that opens the modal
var btndevol = document.getElementById("myBtnformdevol");
var btncloseformdevol = document.getElementById("btncloseformdevol");

// Get the <span> element that closes the modal
var spanclosedevol = document.getElementById("spanclosedevol");

// When the user clicks the button, open the modal 
btndevol.onclick = function() {
  modalformdevol.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosedevol.onclick = function() {
  modalformdevol.style.display = "none";
}
btncloseformdevol.onclick=function() {
  modalformdevol.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>



<script type="text/javascript">
function validarFormPrestamoexterno(formulariopres) {

   if(formulariopres.textmontoprestamo.value <=0) { //comprueba que no esté vacío
    formulariopres.textmontoprestamo.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>



<script type="text/javascript">
function validarFormDevolverPrestamo(formulariodevolpres) {

   if(formulariodevolpres.textmontodevolver.value <=0) { //comprueba que no esté vacío
    formulariodevolpres.textmontodevolver.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>

