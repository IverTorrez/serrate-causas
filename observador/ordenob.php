<?php
error_reporting(E_ERROR);
session_start(); 
/*OBSERVADOR*/
if(!isset($_SESSION["userObs"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["userObs"]; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orden</title>

    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablaordenobs.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/jquery.js"></script>
   
     <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');

include_once('../model/clsordengeneral.php'); 
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsconfirmacion.php');
?>  
<?php
  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

   $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/10987654321;

    $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausadeorden($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";

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
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Observador</a></li>
                
                <li class="first_list" ><a href="miscausasob.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
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
             <?php
              $objeordecausa=new OrdenGeneral();
              $listordenca=$objeordecausa->mostraridcausadeunaorden($codigonuevo);
              $filaidca=mysqli_fetch_object($listordenca);
              $mascara=$filaidca->id_causa*12345678910;
              $encriptado=base64_encode($mascara);
              ?>
                
                <ul>
                    <li><button style="height: 45px; width: 200px;" class="botones" onclick="location.href='fichacausaob.php?squart=<?php echo $encriptado; ?>'">FICHA</button></li>
                    <li><button style="height: 45px; width: 200px;" class="botones" onclick="location.href='listaordenob.php?squart=<?php echo $encriptado; ?>'">LISTA DE ORDENES</button></li>
                   
                   
                 
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
   <input type="hidden" name="" value="<?php echo $codigonuevo ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->

</section>

<style type="text/css">
  
 
 

  }
</style>

<!--TABLA DETALLE ORDEN-->
<section class="responsive">
 <table id="customers">
 <thead> 

  
</thead>
<tbody>
<tr id="fila1">
  <th id="tdorden" rowspan="2" width="14%">CODIGO DE LA CAUSA</th>
  <th id="tdorden" rowspan="2" width="13%">NUMERO DE LA ORDEN</th>
  <th id="tdorden" colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR LA ORDEN</th>
  <th id="tdorden" rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
  <th  id="tdorden" rowspan="2">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>
    
</tr>
 
 <tr id="fila2">
   <td id="tdorden" >NIVEL DE PRIORIDAD</td>
   <td id="tdorden" >PLAZO EN HORAS</td>

 </tr>
 

  <?php
  $objorden1=new OrdenGeneral();
   $resul=$objorden1->listardetalledeordentabla1($codigonuevo);
   $fil=mysqli_fetch_object($resul); 
   echo " <tr>";
  echo "<td>$fil->codigocausa</td>";
  echo "<td>$fil->numeroorden</td>";
  echo "<td>$fil->Prioridad</td>";
   switch ($fil->Condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;        
              }
    $objdescarga=new DescargaProcurador();
        $list=$objdescarga->mostrarfojadescarga($codigonuevo);
        $filfoja=mysqli_fetch_object($list);

   echo "<td>$filfoja->ultima_foja</td>"; 
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
 
</tbody>
</table>
</section><br>

<section class="responsive">
 <table id="tablaordenobs">
   <thead>
   
   </thead>
   <tbody>
   <tr id="fila1">
     <th id="tdorden" colspan="4">FECHAS DE CARGA</th>
     <th  id="tdorden" id="tdorden"  colspan="2">FECHAS PARA LA GESTION</th>
     <th id="tdorden"  colspan="3" >FECHAS PARA LA DESCARGA</th>
     <th id="tdorden" rowspan="3" width="150px" >FECHA  OFICIAL DE CIERRE DE LA ORDEN</th>
    </tr>

   

    <tr id="fila2">
      <td id="tdorden">FECHA 1</td>
      <td id="tdorden">FECHA 2</td>
      <td id="tdorden">FECHA 3</td>
      <td id="tdorden">FECHA 4</td>
      <td id="tdorden" colspan="2">FECHA 5</td>
      <td width="150px">FECHA 6</td>
      <td id="tdorden">FECHA 7</td>
      <td id="tdorden">FECHA 8</td>
    </tr>

    <tr id="fila2">
      <td id="tdorden" width="155px" >GIRO DE UNA NUEVA ORDEN</td>
      <td id="tdorden" width="150px" >ASIGNACION DE PRESUPUESTO</td>
      <td id="tdorden" width="150px" >ACEPTACION DEL PROCURADOR</td>
      <td id="tdorden" width="150px" >ENTREGA DE DINERO</td>
      <td id="tdorden" width="150px" >INICIO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="150px" >TERMINO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="150px" >DESCARGA GENERAL</td>
      <td id="tdorden" width="150px" >PRONUCIAMIENTO DEL ABOGADO</td>
      <td id="tdorden" width="150px" >COCILIACION DE CUENTAS</td>
    </tr>

   

    <?php
         $objorden2=new OrdenGeneral();
        $resul=$objorden2->listarfechasdeunaorden($codigonuevo);
    
        $fila=mysqli_fetch_object($resul);
           
          echo "<tr>"; 
          echo "<td>$fila->fecha_giro</td>";
           $objpresup=new Presupuesto();
          $listado=$objpresup->mostrarfechaspresupuestoyentrega($codigonuevo);
          $filapres=mysqli_fetch_object($listado);


          echo "<td>$filapres->fecha_presupuesto</td>";
          echo "<td>$fila->fecha_recepcion</td>";///esta en la consulta, esta vacia
           echo "<td>$filapres->fecha_entrega</td>"; //es la fecha de entrega de dinero
          echo "<td>$fila->Inicio</td>";
          echo "<td>$fila->Fin</td>";
         $objdesc=new DescargaProcurador();
          $resultado=$objdesc->mostrarfechadescarga($codigonuevo);
          $filafe=mysqli_fetch_object($resultado);

          echo "<td>$filafe->fecha_descarga</td>";

          $objconfir=new Confirmacion();
          $resultconfir=$objconfir->mostrarfechasdeconfirmacion($codigonuevo);
          $filaconfir=mysqli_fetch_object($resultconfir);

          echo "<td>$filaconfir->fecha_confir_abogado</td>";
          echo "<td>$filaconfir->fecha_confir_contador</td>";

          echo "<td>$fila->fecha_cierre</td>";///esta en la consulta, esta vacia
          echo "</tr>";


        


         ?>


   </tbody>
   
 </table> 
</section><br>

 


 <section>
   <div >
    <table style="width: 100%;" >
    <tr>
      <td style="width: 35%;">
        <?php
        $resullugareje=$objorden1->mostrarLugarDeEjecucionDeOrden($codigonuevo);
        $fillugar=mysqli_fetch_object($resullugareje);
        if ($fillugar->lugar_ejecucion!='') 
        {
        ?>
         <label>Lugar de ejecución: <?php echo $fillugar->lugar_ejecucion; ?></label>
        <?php  
        }
        ?>
        
      </td>
      <td style="width: 65%;">
        <h3 style="color: #000000;font-size: 25px;">ELEMENTOS DE LA ORDEN</h3>
      </td>
    </tr> 
  </table>   
 </div>
     <?php
    $objordencon=new OrdenGeneral();
    $muestra=$objordencon->mostrarfechaypronuncionabogado($codigonuevo);
    $filac1=mysqli_fetch_object($muestra);
    if ($filac1->fechaabog!='') {
      if ($filac1->confabog==0) {
        $bgcdescarga='#ff0000';
          $fontcolordes='white';
        echo '<button class="btninforechazo" id="myBtn">??</button>';
      }
      else
        {
          $bgcdescarga='#009900';
          $fontcolordes='white';
        }
    }
    else
    {
      $bgcdescarga='#ffffff';
      $fontcolordes='black';
    }
    ?>
    <br>
   

</section>
<?php
 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila1=mysqli_fetch_object($resul);
?>

<!--METODO PARA LISTAR LAS DESCARGAS DE UNA ORDEN-->
<?php
 $objdesc=new DescargaProcurador();
$result=$objdesc->mostrardescargaorden($codigonuevo);
$fild=mysqli_fetch_object($result);
?>


<!--TABLA INFORMACION CARGA Y DESCARGA DE UNA ORDEN-->
<section class="responsive">
 <table id="customers">
 <thead> 
 <th colspan="2">INFORMACION</th>
  <tr id="fila2">
    <td width="50%">CARGA DE INFORMACION</td>
    <td width="50%">DESCARGA DE INFORMACION</td>
  
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
    <?php

     /*CPNDICION PARA SABER SI LA ORDEN YA FUE ACEPTADA POR EL PROCURADOR*/
    if ($fila->fecha_recepcion=='') {
      $bggr='#ffffff';
      $fontocolor='black';
    }
    else
    {
      $bggr='#009900';
      $fontocolor='white';
    }
    /*CONDICIEN PARA SABER SI LA ORDEN YA FUE DESCARGADA Y SI FUE ACEPTADA*/

    echo "<td style='background:$bggr; color:$fontocolor;'>$fila1->informacion</td>";

    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$fild->detalle_informacion</td>";
    ?>
    
  
  </tr>
 
</tbody>
</table><br>

 <table id="customers">
 <thead> 
 <th colspan="2">DOCUMENTACION</th>
  <tr id="fila2">
    <td width="50%">CARGA DE DOCUMENTACION</td>
    <td width="50%">DESCARGA DE DOCUMENTACION</td>
  
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
     <?php
    echo "<td style='background:$bggr; color:$fontocolor;'>$fila1->documentacion</td>";

    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$fild->documentaciondescarga</td>";
    ?>
   
  
  </tr>
 
</tbody>
</table>
</section>


    </div>

    <br>
    <br>
    <br>

    <!--MODAL PARA VISUALIZAR EL MORTIVO DEL RECHAZO DE LA DESCARGA /////////////////////////////-->
   
    <section class="modal fade" id="modal-muestrainforechazo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
               <div class="modal-content modal-popup">

                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>

                    <div class="modal-body">
                         <div class="container-fluid">
                              <div class="row">

                                   <div class="col-md-12 col-sm-12">
                                        <div class="modal-title">
                                             <h2 style="font-style: italic;">SERRATE 3.0</h2>
                                        </div>

                                        <!-- NAV TABS -->
                                        <ul class="nav nav-tabs" role="tablist">
                                             <li class="active"><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">MOTIVO DEL RECHAZO</a></li>

                                      
                                        </ul>

                                        <!-- TAB PANES -->
                                        <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                                  <form action="" method="post"><br>
                                                     <label><b><?php echo $filac1->justificacion; ?></b></label><br><br>
                                                 
                  
                                                        <button style="background: #1A5895; max-width: 180px; float: right;" type="submit" class="btn btn-primary form-control" id="btncancelar" class="close" data-dismiss="modal" name="btncancelar">OK</button> 

 
                                                  </form>
                                             </div>

                                        
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>

       <!-- The Modal PARA VISUALIZAR EL MOTIVO DEL RECHAZO -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="closeidob">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >MOTIVO DEL RECHAZO</p></center>
     </div><br>

    <div class="modal-body">
      <p><b><?php echo $filac1->justificacion; ?></b></p><br><br>

    </div>
    <div class="modal-footer">
    <button class="btnclose" id="btnclose" style="float: right;" type="submit">Ok</button>

      

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL motivo del rechazo-->
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btnclose = document.getElementById("btnclose");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var closeidob = document.getElementById("closeidob");
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeidob.onclick = function() {
  modal.style.display = "none";
}
btnclose.onclick=function() {
  modal.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>