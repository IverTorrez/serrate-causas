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
    <title>Orden</title>

    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">

    <link rel="stylesheet" type="text/css" href="resources/menu_sin_estilo_listas_admin.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablaordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
    

     <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">

</head> 
<body>
<?php

include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');

include_once('model/clsdeposito.php');
include_once('model/clspresupuesto.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsconfirmacion.php');
include_once('model/clscostofinal.php');
include_once('model/clscotizacion.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsplanilla_notificacion.php');
include_once('model/clsusuario.php');
include_once('controller/control-pronuncioadminorden.php');
 /*RECIBE EL CODIGO DE LA ORDEN*/
 $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO DE LA ORDEN PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/10987654321;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausadeorden($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";
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
            <ul id="ul-menu">
               
                 <li id="li-menu" class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li id="li-menu" class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li id="li-menu" class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li id="li-menu" class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li id="li-menu" class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               

                 <li  id="li-menu" class="" style="float: left; margin: 0 14px; width: 445px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul id="ul-portsfolio">
                 <?php
                    $objeordecausa=new OrdenGeneral();
                    $listordenca=$objeordecausa->mostraridcausadeunaorden($codigonuevo);
                    $filaidca=mysqli_fetch_object($listordenca);
                    $mascara=$filaidca->id_causa*1234567;
                    $encriptado=base64_encode($mascara);
                  ?>
                    <li id="li-porta"><button class="botones" onclick="location.href='ficha.php?squart=<?php echo $encriptado; ?>'">FICHA</button></li>
                    <li id="li-porta"><button class="botones" onclick="location.href='listaordenes.php?squart=<?php echo $encriptado; ?>'">LISTA DE ORDENES</button></li>
                    <li id="li-porta"><button class="botones" onclick="window.open('impresiones/tcpdf/pdf/ordenpdf.php?cod=<?php echo $codcausa; ?>')">IMPRIMIR ORDEN</button></li>
                    <?php
                     /*$objtipoorden=new OrdenGeneral();
                     $resulttipo=$objtipoorden->mostrarTipoOrden($codigonuevo);
                     $filatipo=mysqli_fetch_object($resulttipo);*/

                     
                          $objconfir=new Confirmacion();
                          $listconfir=$objconfir->mostrarcodconfirmacion($codigonuevo);
                          $filaconfir=mysqli_fetch_object($listconfir);
                          $codconfirmacion=$filaconfir->codconfir;

                          $objeorden=new OrdenGeneral();
                          $lista=$objeorden->mustraestadodeunaordenidabogado($codigonuevo);
                          $filaorden=mysqli_fetch_object($lista);

                          if (($filaorden->estado_orden=='Descargada' or $filaorden->estado_orden=='PronuncioContador') and $filaorden->fechaconfabogado=='' ) 
                          {
                             echo '<li id="li-porta">
                             <input type="hidden" name="idorden" placeholder="id orden" value="'; echo $codigonuevo; echo '">
                             <input type="hidden" name="idconfir" placeholder="id confirm" value="'; echo $codconfirmacion; echo '">
                            <button class="botones" id="myBtnformacep" name="" >APROBAR</button>
                            </li>
                          
                          <li id="li-porta">
                           <input type="hidden" name="idorden" placeholder="id orden" value="'; echo $codigonuevo; echo '">
                           <input type="hidden" name="idconfir" placeholder="id confirm" value="'; echo $codconfirmacion; echo '">
                          <button class="botones" name="btnmodal" id="myBtnform">RECHAZAR</button>
                          </li>';
                           } 
                       
                     
                    ?>
                    
            
            <li id="li-porta" style="float: right;"><button style="background: red; width: 200px;" onclick="location.href='modificargastodescarga.php?squart=<?php echo $codcausa; ?>'"  class="botones"> MODIFICAR/BORRAR ORDEN</button></li>
            
             <?php
            $resultOrden=$objeordecausa->mostrarEstadoOrdenYCanceladoProc_DeOrden($codigonuevo);
            $filorden2=mysqli_fetch_object($resultOrden);
            if ($filorden2->estado_orden=='Serrada' && $filorden2->canceladoprocurador==0) 
            {?>
               <li id="li-porta" style="float: right;"><button style="background: red; width: 200px;color: white;" id="btnmodalcambiarPro"  class="botones">INVERTIR PRONUNCIAMIENTO</button></li>
            <?php
            }
            ?>
           <!-- <?php
            /*CODIGO PARA VERIFICAR QUE LA ORDEN YA ESTE DESCARGADA Y AUN NO HAYGA PRONUNCIAMIENTO DEL CONTADOR*/
             //$objconfir1=new Confirmacion();
            // $resulfech=$objconfir1->mostrarFechasdescargaFechaconfircont($codigonuevo);
            // $filfec=mysqli_fetch_object($resulfech);
            // if ($filfec->fecha_confir_contador=='' and $filfec->fecha_descarga!='')
              {
                ?>
                <li style="float: right;"><button style="background: red;" onclick="location.href='modificargastodescarga.php?squart=<?php// echo $codcausa; ?>'" class="botones">MODIFICAR GASTO DE DESCARGA</button></li>
            
              <?php
              }/*FIN DEL IF*/ 

              ?>-->
            
                 
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">

 
  <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
   <section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->

</section>



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
  <th id="tdorden" rowspan="2" width="13%">ULTIMA FOJA SINCRONIZADA</th>
  <th id="tdorden" rowspan="2">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>
    
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
  $procuradorasig=$fil->procuradorasig;
   echo "<td>$procuradorasig</td>"; 

   echo "</tr>";           
  ?>
  
 
</tbody>
</table>
</section><br>

<section class="responsive">
 <table id="tablaordenadm">
   <thead>
   
   </thead>
   <tbody>
   <tr id="fila1">
     <th id="tdorden" colspan="4">FECHAS DE CARGA</th>
     <th  id="tdorden" id="tdorden" rowspan="2" colspan="2">FECHAS PARA LA GESTION</th>
     <th id="tdorden" rowspan="2" colspan="3" >FECHAS PARA LA DESCARGA</th>
     <th id="tdorden" rowspan="4" width="160px">FECHA  OFICIAL DE CIERRE DE LA ORDEN</th>
    </tr>

    <tr id="fila2">
      <td id="tdorden" colspan="2">INFORMACION Y DOCUMENTACION</td>
      <td id="tdorden" colspan="2">DINERO</td>
    </tr>

    <tr id="fila2">
      <td id="tdorden">FECHA 1</td>
      <td id="tdorden">FECHA 2</td>
      <td id="tdorden">FECHA 3</td>
      <td id="tdorden">FECHA 4</td>
      <td id="tdorden" colspan="2">FECHA 5</td>
      <td id="tdorden">FECHA 6</td>
      <td id="tdorden">FECHA 7</td>
      <td id="tdorden">FECHA 8</td>
    </tr>

    <tr id="fila2">
      <td id="tdorden" width="160px">GIRO DE UNA NUEVA ORDEN</td>
      <td id="tdorden" width="160px">ASIGNACION DE PRESUPUESTO</td>
      <td id="tdorden" width="160px">CARGA MATERIAL DE INFORMACION Y DOCUMENTACION</td>
      <td id="tdorden" width="160px">ENTREGA DE DINERO</td>
      <td id="tdorden" width="160px">INICIO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="160px">TERMINO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="160px">DESCARGA GENERAL</td>
      <td id="tdorden" width="160px">PRONUCIAMIENTO DEL ABOGADO</td>
      <td id="tdorden" width="160px">DEVOLUCION DEL SALDO DE DINERO</td>
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

          //echo "<td>$fila->fecha_presupuesto</td>";///no hay aun,ni enla consulta, falta definir
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

          echo "<td>$fila->fecha_cierre</td>";///esta en la consulta
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
         <label>Lugar de ejecuci¨®n: <?php echo $fillugar->lugar_ejecucion; ?></label>
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

          echo '<button class="" id="myBtn">OTRO BOTON</button>';
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
    /*CARGA DE INFORMACION*/
     $informacion=$fila1->informacion;
    echo "<td style='background:$bggr; color:$fontocolor;'>$informacion</td>";
    /*DESCARGA DE INFORMACION*/
    $detalle_informacion=$fild->detalle_informacion;
    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$detalle_informacion</td>";
    ?>
    
  
  </tr>
 
</tbody>
</table><br>

<!--TABLA DOCUMENTACION CARGA Y DESCARGA DE UNA ORDEN-->
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
    /*CARGA DE DOCUMENTACION*/
    $documentacion=$fila1->documentacion;
    echo "<td style='background:$bggr; color:$fontocolor;'>$documentacion</td>";
    /*DESCARGA DE DOCUMENTACION*/
    $documentaciondescarga=$fild->documentaciondescarga;
    echo "<td style='background:$bgcdescarga; color:$fontcolordes;'>$documentaciondescarga</td>";
    ?>
   
  </tr>
 
</tbody>
</table><br>

<!--TABLA DINERO CARGA Y DESCARGA DE UNA ORDEN-->
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
?>
 <table id="customers">
 <thead> 
 <th colspan="3">DINERO</th>
  <tr id="fila2">
    <td width="50%">PRESUPUESTO</td>
    <td>GASTO</td>
    <td>SALDO</td>
  
  </tr>
</thead>
<tbody>
  <tr id="filadinero">
    <?php
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
    <th width="50%">DETALLE DEL PRESUPUESTO POR GASTAR (CARGA DE DINERO)</th>
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
    $detallePresupuesto2=$detallePresupuesto;
    echo "<td>$detallePresupuesto2</td>";

///DETALLE DEL GASTO DEL DINERO
    $detalle_gasto=$fild->detalle_gasto;
   echo "<td>$detalle_gasto</td>";

    ?>
  </tr>
  </tbody>
</table>
</section>


    </div>


 

    



    <br>
    <br>
    <br>


     <!-- The Modal (FORMULARIO) PARA INTROCDUCIR  EL MOTIVO DEL RECHAZO -->
<div id="myModalform" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclose">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ESCRIBA MOTIVO DEL RECHAZO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <input type="hidden" name="idorden" value="<?php echo $codigonuevo; ?>">
      <input type="hidden" name="idconfir" value="<?php echo $codconfirmacion; ?>">

      <textarea id="textarearechazo" name="textarearechazo" class="form-control" style="width: 100%; height: 50px;" placeholder="Escriba justificacion" required="required"></textarea> <br>



    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; float: left; width: 150px;" type="submit" class="btnclose" id="btnrechazardescarga" name="btnrechazardescarga" value="RECHAZAR DESCARGA">
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






     <!-- The Modal PARA VISUALIZAR EL MOTIVO DEL RECHAZO -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="closeid">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >MOTIVO DEL RECHAZO</p></center>
     </div><br>

    <div class="modal-body">
      <p><b><?php echo $filac1->justificacion; ?></b></p><br><br>

    </div>
    <div class="modal-footer">
    <button class="btnclose" id="btnclose" style="float: right;" type="button">Ok</button>

      

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
var spanid = document.getElementById("closeid");

// When the user clicks the button, open the modal  qqq
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanid.onclick = function() {
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










<!--**********************MODAL PARA ACEPTA LA DESCARGA***********************************************************-->
<!-- The Modal (FORMULARIO) PARA ACEPTAR LA DESCARGA -->
<div id="myModalformacep" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseacep">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ESTA SEGURO DE APROBAR LA DESCARGA ??</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <input type="hidden" name="idorden" placeholder="id Orden" value="<?php echo $codigonuevo; ?>">
      <input type="hidden" name="idconfir" placeholder="id Confirmacion" value="<?php echo $codconfirmacion; ?>">

       <br>



    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; float: left; width: 150px;" type="submit" class="btnclose" id="btnaceptardescarga" name="btnaceptardescarga" value="APROBAR DESCARGA">
    <button class="btnclose" id="btncloseformacep" style="float: right;" type="button">Cancelar</button>
      </form>

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA ACEPTAR LA DESCARGA -->
<script>
// Get the modal
var modalformacep = document.getElementById("myModalformacep");

// Get the button that opens the modal
var btnacep = document.getElementById("myBtnformacep");
var btncloseformac = document.getElementById("btncloseformacep");

// Get the <span> element that closes the modal
var spancloseacp = document.getElementById("spancloseacep");

// When the user clicks the button, open the modal 
btnacep.onclick = function() {
  modalformacep.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spancloseacp.onclick = function() {
  modalformacep.style.display = "none";
}
btncloseformac.onclick=function() {
  modalformacep.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>




<script type="text/javascript" src="resources/jquery.js"></script>
</body> 
</html>












<!--=====================================CODIGOS PARA CAMBIAR EL PRONUNCIAMIENTO DEL ABOGADO==================== -->
<?php
$resultPrun=$objconfir->mostrarlaconfirmaciondelsistemayabogado($codconfirmacion);
$filpron=mysqli_fetch_object($resultPrun);
if ($filpron->confir_abogado==1) 
{
  $estadorOrdenPron="Aceptada";
}
else
{
  if ($filpron->confir_abogado==0) {
    $estadorOrdenPron="Rechazada";
  }
}
?>

            <!-- The Modal (FORMULARIO) PARA CAMBIAR PRONUNCIAMIENTO DEL ABOGADO -->
            <div id="modalCambiarPronunciamiento" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <div class="modal-header">
                  <span class="close" id="spanclosecambiarpr">&times;</span><br>
                  
                  <h2 style="font-style: italic; ">SERRATE 3.0</h2>
                </div>
                 <div><br>
                  <center> <p style="font-size: 20px;font-family: fantasy;" >CAMBIAR PRONUNCIAMIENTO</p></center>
                 </div><br>
                <form method="post">
                <div class="modal-body">
                  <label >Actualmente esta orden esta: <?php echo $estadorOrdenPron; ?> </label><br>
                  <input type="hidden" name="idordenCamb" id="idordenCamb" placeholder="id Orden" value="<?php echo $codigonuevo; ?>">
                  <input type="hidden" name="idconfirCamb" id="idconfirCamb" placeholder="id Confirmacion" value="<?php echo $codconfirmacion; ?>">

                  <input type="hidden" name="estadoPronunciamiento" id="estadoPronunciamiento" placeholder="pronunciamineto" value="<?php echo $filpron->confir_abogado ?>">
                  <?php
                  if ($filpron->confir_abogado==1) 
                  {
                   ?>
                   <textarea id="new_motivo_rechazo" name="new_motivo_rechazo" class="form-control" style="width: 100%; height: 50px;" placeholder="Escriba justificacion" required="required"></textarea> <br>
                   <?php 
                  }
                  ?>

                   <br><br>
                </div>
                <div class="modal-footer">
                <?php
 // PREGUNTAMOS CUAL ES EL PRONUNCIAMIENTO ACTUAL DEL ABOGADO, PARA VER QUE BOTON SE LE MOSTRARA, ACEPTAR O RECHAZAR
                    
                    if ($filpron->confir_abogado==1) 
                    {
                    ?>
                 <button type="button" class="btnclose" id="btncambiarPron" name="btncambiarPron" >Rechazar </button>

                    <?php 
                    }
                    else
                    {
                      if ($filpron->confir_abogado==0) 
                      {
                      ?>
                      <button type="button" class="btnclose" id="btncambiarPron" name="btncambiarPron" >Aceptar </button>
                      <?php 
                      }
                    }

                    ?>
               
               
                <button class="btnclose" id="btncloseformcambiarpron" style="float: right;" type="button">Cancelar</button>
                  </form>

                </div>
              </div>

            </div>
    <!--END The Modal (FORMULARIO) PARA CAMBIAR PRONUNCIAMIENTO DEL ABOGADO -->


            <!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA CAMBIAR EL PRONUNCIAMIENTO -->
            <script>
            // Get the modal
            var modalCambiarPronunciamiento = document.getElementById("modalCambiarPronunciamiento");

            // Get the button that opens the modal
            var btnmodalcambiarPro = document.getElementById("btnmodalcambiarPro");
            var btncloseformcambiarpron = document.getElementById("btncloseformcambiarpron");

            // Get the <span> element that closes the modal
            var spanclosecambiarpr = document.getElementById("spanclosecambiarpr");

            // When the user clicks the button, open the modal 
            btnmodalcambiarPro.onclick = function() {
              modalCambiarPronunciamiento.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            spanclosecambiarpr.onclick = function() {
              modalCambiarPronunciamiento.style.display = "none";
            }
            btncloseformcambiarpron.onclick=function() {
              modalCambiarPronunciamiento.style.display = "none";
            }
            </script>
            <!--END SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA CAMBIAR EL PRONUNCIAMIENTO -->






<!-- *********BOTON QUE LLAMA AL CONTROLADOR CAMBIAR PRONUNCIAMIENTO  -->
<script type="text/javascript">

$(document).ready(function() { 
   $("#btncambiarPron").on('click', function() {
  // $('#img_cargando_clonar').show();

   /*cargamos los inputs a nuevas variables*/ 
   var formDataClonar = new FormData();  
   var idordenCamb=$('#idordenCamb').val();
   var idconfirCamb=$('#idconfirCamb').val();
   var estadoPronunciamiento=$('#estadoPronunciamiento').val();
   var new_motivo_rechazo=$('#new_motivo_rechazo').val();
   
    /*CARGAMOS EL GIF DE CARGANDO Y PONEMOS DISABLED EL BOTON*/
   if ( (idordenCamb=='' || idconfirCamb=='') ) 
   {
     setTimeout(function(){  }, 2000); swal('ATENCION','Algunos datos se perdieron, recargue la pagina e intente nuevamente','warning');
     // $('#img_cargando_clonar').hide(); 
     
   }
   else
   {
     /*cargamos las nueva variables a a los parametros que se enviara al archivo php que registra el curso*/
     formDataClonar.append('idordenCamb',idordenCamb);
     formDataClonar.append('idconfirCamb',idconfirCamb);
     formDataClonar.append('estadoPronunciamiento',estadoPronunciamiento);
     formDataClonar.append('new_motivo_rechazo',new_motivo_rechazo);   
      $.ajax({ url: 'controller/control-cambiarPronunciamientoOrden.php', 
               type: 'post', 
               data: formDataClonar, 
               contentType: false, 
               processData: false, 
               success: function(response) { 
                 if (response == 1) 
                 { 
                    setTimeout(function(){ location.reload(); }, 500); swal('EXELENTE','Se cambio el pronunciamiento con exito','success'); 
                 }
                 else
                 {
                   if (response== 2) 
                   {
                     setTimeout(function(){  }, 2000); swal('EXELENTE','se cambio el pronunciamiento, pero la orden aun es insuficiente, por la calificacion del sistem','success');
                   }
                   else
                   {
                       if (response==3) 
                       {
                        setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N2-S','warning');
                       }
                       else
                       {
                          if (response==4) 
                          {
                            setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N3-C','warning');
                          }
                          else
                          {
                              if (response==5) 
                              {
                                setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N4-SA','warning');
                              }
                              else
                              {
                                  if (response==6) 
                                  {
                                    setTimeout(function(){ location.reload(); }, 2000); swal('EXELENTE','se cambio el pronunciamiento, pero no se hizo efecto en las cuentas, ya que el sistema rechazo esta orden','success');
                                  }
                                  else
                                  {
                                      if (response==7) 
                                      {
                                        setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N7-IN','warning');
                                      }
                                      else
                                      {
                                          if (response==8) 
                                          {
                                            setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N8-CFN','warning');
                                          }
                                          else
                                          {
                                              if (response==9) 
                                              {
                                                setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal, comuniquese con el Ingeniero del Sofware, ERROR N9-SA','warning');
                                              }
                                              else
                                              {
                                                  if (response==0) 
                                                  {
                                                    setTimeout(function(){  }, 2000); swal('ERROR','Algo salio mal intente nuevamente por favor','error');
                                                       // $('#img_cargando_clonar').hide();
                                                  }
                                              }
                                          }
                                      }
                                  }
                              }
                          }
                       }
                   }
                 }
                    
                  
                 
                } 
            }); 

      }/*FIN DEL ELSE QUE SE EJECTUTA AL CONFIRMAR QUE TODOS LOS CAMPOS FUERON LLENADOS*/
        return false;


    }); 
  });
</script>
<!-- *********FIN DE BOTON QUE LLAMA AL CONTROLADOR CAMBIAR PRONUNCIAMIENTO  -->

<!--============= FIN CODIGOS PARA CAMBIAR EL PRONUNCIAMIENTO DEL ABOGADO -->



