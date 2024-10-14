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
    <title>Orden</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
     <link rel="stylesheet" type="text/css" href="../resources/tablaordenproc.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

     <script src="../js/jquery.js"></script>

   <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css"> 

</head>
<body>


<?php

include_once('../model/clscausa.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsconfirmacion.php');
include_once('../controller/control-recibirorden.php');

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

  $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/1020304050;

     $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausadeorden($codigonuevo);
   $fil=mysqli_fetch_object($resul);
 //   echo "<td style='width: 10%;'>$fil->codigo</td>";

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
              <?php
              $objeordecausa=new OrdenGeneral();
              $listordenca=$objeordecausa->mostraridcausadeunaorden($codigonuevo);
              $filaidca=mysqli_fetch_object($listordenca);
              $mascara=$filaidca->id_causa*1213141516;
              $encriptado=base64_encode($mascara);
              ?>
                
                <ul>
                    <li><button style="height: 45px;" class="botones" onclick="location.href='pm_ficha.php?squart=<?php echo $encriptado; ?>'">FICHA</button></li>
                    <li><button style="height: 45px;" class="botones" onclick="location.href='pm_lista_ordenes.php?squart=<?php echo $encriptado; ?>'">LISTA DE ORDENES</button></li>

                    <?php
                    /*CUANDO ESTA LISTA PARA ACEPTARSE EL PROCURADOR MAESTRO PUEDE ACEPTAR CUALQUIER ORDEN (INCLUSO LAS QUE NO ESTAN GIRADAS A SU NOMBRE)*/
                   // $idproc=$datos['id_procurador'];;
                   $objord=new OrdenGeneral();
                   $resulta=$objord->mostrarfecharecepcionPM($codigonuevo); 
                    $fi=mysqli_fetch_object($resulta); 

                    if ($fi->fecha_recepcion==null and $fi->fecha_presupuesto!=null) 
                    {
                      echo ' <li>
                      <form method="post">
                        <input type="hidden" name="idorden" value="'; echo $codigonuevo; echo '">
                        <button style="height: 45px;" class="botones" name="btnrecibirorden">ACEPTAR</button>
                      </form>
                      </li>';
                    }
                  else
                  {
                    // $idproc=$datos['id_procurador'];;
                    $objorde=new OrdenGeneral();
                    $result=$objorde->verificarparadescargarordenPM($codigonuevo);
                    $fill=mysqli_fetch_object($result);  
                      if ($fill->fecha_recepcion!=null and $fill->fecha_entrega!=null and $fill->estado_orden!='Descargada')
                      {

                           $objpresu=new Presupuesto();
                           $lis=$objpresu->mostrarfechaspresupuestoyentrega($codigonuevo);
                           $filap=mysqli_fetch_object($lis); 
                           if ($filap->fecha_entrega!=null and $filap->estadopresupuesto!='Gastado' and $filap->estadopresupuesto!='Gastadoconfir') 
                           {
                             
                      
                          ?>
                    <!--ESTE BOTON LLAMA AL MENSAJE QUE DICE QUE NO PUEDE DESCARGAR LA ORDEN SIN AVER RECIBIDO EL DINERO--> 
                          <li><button style="height: 45px;" class="botones" onclick="location.href='descarga.php?squart=<?php echo $codorden ?>' ">DESCARGAR</button></li>

                         <?php 
                          }
                      }

                     
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
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETRO PARA COTIZAR ORDEN</th>  
     <th rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
     <th rowspan="2">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>  
    </tr> 
 
    <tr style="background: #B1EF07">
     <td>NIVEL DE PRIORIDAD</td> 
     <td>PLAZO OTORGADO</td> 
    </tr> 
</thead>
<tbody> 
  <?php
  $objorden1=new OrdenGeneral();
   $resul=$objorden1->listardetalledeordentabla1($codigonuevo);
   $fil=mysqli_fetch_object($resul); 
   echo " <tr>";
  echo "<td>$fil->codigocausa</td>";
  echo "<td>$fil->numeroorden</td>";
  echo "<td>$fil->Prioridad</td>";
   switch ($fil->Condicion) 
           {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;      
              }

    $objdesc=new DescargaProcurador();
    $resultado=$objdesc->mostrarfojadescarga($codigonuevo);
   $filafoja=mysqli_fetch_object($resultado); 

   echo "<td>$filafoja->ultima_foja</td>"; 
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->
<section class="responsive">
       <table id="tablaordenproc">
 <thead>     
  <tr>
    <th colspan="4">FECHA DE CARGA </th>
    <th   colspan="2">FECHA PARA LA GESTION</th>
    <th  colspan="3">FECHA PARA LA DESCARGA</th>
    <th rowspan="3" width="140px">FECHA OFICIAL DE CIERRE DE LA ORDEN</th>
    
  </tr>

<tr style="background: #B1EF07">
    <td>FECHA 1</td>
    <td>FECHA 2</td>
    <td>FECHA 3</td>
    <td>FECHA 4</td>
    <td colspan="2">FECHA 5</td>
    <td >FECHA 6</td>
    <td>FECHA 7</td> 
    <td>FECHA 8</td>
</tr>
<tr style="background: #B1EF07">
    <td width="150px">GIRO DE UNA NUEVA ORDEN</td>
    <td width="140px">ASIGNACION DE PRESUPUESTO</td>
    <td width="140px">ACEPTACION DEL PROCURADOR</td>
    <td width="140px">ENTREGA DE DINERO</td>
    <td width="140px">INICIO DE LA VIGENCIA DE LA ORDEN</td>
    <td width="140px">TÉRMINO DE LA VIGENCIA DE LA ORDEN</td> 
    <td width="140px">DESCARGA GENERAL</td>
    <td width="140px">PRONUNCIAMIENTO DEL ABOGADO</td>
    <td width="140px">COCILIACION DE CUENTAS</td>
</tr>
</thead>
<tbody>
 
 <?php
         $objorden2=new OrdenGeneral();
        $resul=$objorden2->listarfechasdeunaorden($codigonuevo);
    
        $filafech=mysqli_fetch_object($resul);
           
          echo "<tr>"; 
          echo "<td>$filafech->fecha_giro</td>";

          $objpresup=new Presupuesto();
          $listado=$objpresup->mostrarfechaspresupuestoyentrega($codigonuevo);
          $filapres=mysqli_fetch_object($listado);

          echo "<td>$filapres->fecha_presupuesto</td>";

          echo "<td>$filafech->fecha_recepcion</td>";
          echo "<td>$filapres->fecha_entrega</td>";///es la fecha de entrega de presupuesto al procurador
          echo "<td>$filafech->Inicio</td>";
          echo "<td>$filafech->Fin</td>";

          $objdesc=new DescargaProcurador();
          $resultado=$objdesc->mostrarfechadescarga($codigonuevo);
          $filafe=mysqli_fetch_object($resultado);

          echo "<td>$filafe->fecha_descarga</td>";///es la fecha de descarga de la orden

          $objconfir=new Confirmacion();
          $resultconfir=$objconfir->mostrarfechasdeconfirmacion($codigonuevo);
          $filaconfir=mysqli_fetch_object($resultconfir);

          echo "<td>$filaconfir->fecha_confir_abogado</td>";
          echo "<td>$filaconfir->fecha_confir_contador</td>";

          echo "<td>$filafech->fecha_cierre</td>";///esta en la consulta, esta vacia
          echo "</tr>";


        


         ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 3-->
<section class="responsive">
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
         <p>Lugar de ejecución: <?php echo $fillugar->lugar_ejecucion; ?></p>
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
          echo '<button class="btninforechazo" id="myBtn" data-toggle="modal" data-target="#openModal">??</button>';
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
  
/*--METODOS PARA LISTAR LAS CARGAS DE UNA ORDEN-->*/

 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila=mysqli_fetch_object($resul);


/*--METODO PARA LISTAR LAS DESCARGAS DE UNA ORDEN-->*/

 $objdesc=new DescargaProcurador();
$result=$objdesc->mostrardescargaorden($codigonuevo);
$fild=mysqli_fetch_object($result);
?>

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">INFORMACION</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">CARGA  DE  INFORMACION  </td>
    <td width="50%">DESCARGA DE INFORMACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
     <?php
    /*CPNDICION PARA SABER SI LA ORDEN YA FUE ACEPTADA POR EL PROCURADOR*/
    if ($filafech->fecha_recepcion=='') {
      $bggr='#ffffff';
      $fontocolor='black';
    }
    else
    {
      $bggr='#009900';
      $fontocolor='white';
    }
    /*CONDICIEN PARA SABER SI LA ORDEN YA FUE DESCARGADA Y SI FUE ACEPTADA*/
    if ($filafe->fecha_descarga!='') {
      
    }
    
    echo "<td style='background:$bggr; color:$fontocolor;' >$fila->informacion</td>";
    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$fild->detalle_informacion</td>";

    
    ?>
  </tr>
 
</tbody>
</table><br>

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">DOCUMENTACION</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">CARGA  DE  DOCUMENTACION   </td>
    <td width="50%">DESCARGA DE DOCUMENTACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
      <?php
    echo "<td style='background:$bggr; color:$fontocolor;'>$fila->documentacion</td>";

    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$fild->documentaciondescarga</td>";
    ?>
  </tr>
 
</tbody>
</table><br>
 <table id="customers">
 <thead>     
  <tr>
    <th colspan="3">DINERO</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">PRESUPUESTO</td>
    <td>GASTO</td>
    <td>SALDO</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filadinero">
        <?php
      /*CONDICION QUE PREGUNTA SI YA SE PRESUPUESTO UNA ORDEN*/
      if ($filapres->fecha_presupuesto!='') 
      {
          $bggrdinero='#ff8c00';
          $fontocolordinero='white';
          /*CONDICION QUE PREGUNTA SI YA SE ENTREGO EL DINERO DEL PRESUPUESTO*/
          if ($filapres->fecha_entrega!='') 
          {
             $bggrdinero='#009900';
             $fontocolordinero='white';
          }
      }
    else
      {     
        $bggrdinero='#ffffff';
        $fontocolordinero='black';
      }
      /*CONDICION QUE PREGUNTA SI YA CONCILIO CUENTAS EL CONTADOR*/
      if ($filaconfir->fecha_confir_contador!='') 
      {
        $bgcgastos='#009900';
        $fontcolorgasto='white';
      }
      else
      {
        $bgcgastos='#ffffff';
        $fontcolorgasto='black';
      }

        $objpresupuesto=new Presupuesto();
        $list=$objpresupuesto->mostrarpresupuesto($codigonuevo);
        $fila1=mysqli_fetch_object($list);

        echo "<td style='background:$bggrdinero; color:$fontocolordinero;'>$fila1->monto_presupuesto</td>";
       
       ///DESCARGA DEL DINERO GASTADO Y EL SALDO DE LA ORDEN
         echo "<td style='background:$bgcgastos; color:$fontcolorgasto;'>$fild->gastos</td>";

         echo "<td style='background:$bgcgastos; color:$fontcolorgasto;'>$fild->saldo</td>";

?>
  </tr>
 </tbody>
</table>
<table id="customers">
 <thead>     
<tr>  
    <th width="50%">DETALLE DEL PRESUPUESTO A GASTAR (CARGA DE DINERO)</th>
    <th width="50%">DETALLE DEL DINERO GASTADO (DESCARGA DE DINERO)</th>
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
   <?php
   $resultveri=$objorden1->mustraestadodeunaorden($codigonuevo);
    $filveri=mysqli_fetch_object($resultveri);

    $resultprepre=$objorden1->mostrarSugerenciaPre_presupuestodeOrden($codigonuevo);
    $filpre_pre=mysqli_fetch_object($resultprepre);
  /*preguntamos si el estado de la orden es igual a pre-presupuestada */
    if ($filveri->estado_orden=='Pre-presupuestada') 
    {
      $detallePresupuesto=$filpre_pre->sugerencia_presupuesto;
    }
    else /*por falso mostramos el detalle de presupuesto de la tabla presupuesto*/
    {
      $detallePresupuesto=$fila1->detalle_presupuesto;
    }
    echo "<td>$detallePresupuesto</td>";

///DETALLE DEL GASTO DEL DINERO
   echo "<td>$fild->detalle_gasto</td>";

    ?>
  
  </tr>
 
</tbody>
</table>

</section>
<br>

    </div>

    <br>
    <br>
    <br>





<!-- The Modal PARA VISUALIZAR EL MOTIVO DEL RECHAZO -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span><br>
      
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

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
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
