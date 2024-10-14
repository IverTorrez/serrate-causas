<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["contador"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["contador"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orden contador</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">

    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    
        <link rel="stylesheet" type="text/css" href="../resources/tablaordenabog.css">

    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

        <script src="../js/jquery.js"></script>
   
     <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css">

</head>
<body>
<?php
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clscausa.php');
include_once('../model/clsconfirmacion.php');

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
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
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
              $mascara=$filaidca->id_causa*1234567;
              $encriptado=base64_encode($mascara);
              ?>
                
                <ul>
                <li><button class="botones" style="width: 300px; height: 45px;" onclick="location.href='contador_ficha.php?squart=<?php echo $encriptado; ?>'">FICHA</button></li>
                    <li><button class="botones" style="width: 300px; height: 45px;" onclick="location.href='contador_lista_ordenes.php?squart=<?php echo $encriptado; ?>'">LISTA DE ORDENES</button></li>
                    <li><button class="botones" style="width: 300px; height: 45px;" onclick="window.open('impresiones/pdf/orden.php?squart=<?php echo $codorden; ?>')">IMPRIMIR ORDEN</button></li>
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
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR ORDEN</th>  
     <th rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
     <th rowspan="2" width="">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>  
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
   switch ($fil->Condicion) {
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
       <table id="tablaordencont">
 <thead>     
  <tr>
    <th colspan="4">FECHA DE CARGA </th>
    <th   colspan="2">FECHA PARA LA GESTION</th>
    <th  colspan="3">FECHA PARA LA DESCARGA</th>
    <th rowspan="3" width="150px">FECHA OFICIAL DE CIERRE DE LA ORDEN</th>
    
  </tr>

   

<tr style="background: #B1EF07">
    <td >FECHA 1</td>
    <td >FECHA 2</td>
    <td >FECHA 3</td>
    <td >FECHA 4</td>
    <td colspan="2">FECHA 5</td>
    <td >FECHA 6</td> 
    <td >FECHA 7</td> 
    <td >FECHA 8</td>
</tr>
<tr style="background: #B1EF07">
    <td width="155px">GIRO DE LA ORDEN</td>
    <td width="150px"> ASIGNACION DE PRESUPUESTO</td>
    <td width="150px">ACEPTACION DEL PROCURADOR </td>
    <td width="150px">ENTREGA DE DINERO</td>
    <td width="150px">INICIO DE LA VIGENCIA DE LA ORDEN</td>
    <td width="150px">TÉRMINO DE LA VIGENCIA DE LA ORDEN</td> 
    <td width="150px">DESCARGA GENERAL</td>
    <td width="150px">PRONUNCIAMIENTO DEL ABOGADO</td>
    <td width="150px">COCILIACION DE CUENTAS</td>
</tr>
</thead>
<tbody>


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
          echo "<td>$fila->fecha_recepcion</td>";
          echo "<td>$filapres->fecha_entrega</td>";
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


 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">INFORMACION</th>
  </tr>
  <tr  style="background: #B1EF07">  
    <td width="50%">CARGA  DE  INFORMACION  </td>
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

    echo "<td style='background:$bggr; color:$fontocolor;'>$fila1->informacion</td>";
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
    echo "<td style='background:$bggr; color:$fontocolor;'>$fila1->documentacion</td>";
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
    <td width="25%">GASTO</td>
    <td width="25%">SALDO</td>
  
  </tr>

</thead>


<tbody>
  <tr>

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

  /*CODIGO QUE COMPRUEBA SI LA ORDEN ESTA PREDATADA A PARTIR DE LA FECHA INICIO*/ 
    

       ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita;  
       if ($fila->Inicio<=$concat) 
       {
          $objpresupuesto=new Presupuesto();
          $list=$objpresupuesto->mostrarpresupuesto($codigonuevo);
          $fila1=mysqli_fetch_object($list);
          if ($fila1->id_presupuesto==null) 
            {
              echo "<td style='background:$bggrdinero; color:$fontocolordinero;'> <a href='contador_presupuestar.php?squart=$codorden'> 00</a></td>";
            }
          else
            {
              if ($filapres->fecha_entrega=="") 
                  {
                    echo "<td style='background:$bggrdinero; color:$fontocolordinero;'> <a style='color:black;' href='contador_presupuestar.php?squart=$codorden'>$fila1->monto_presupuesto</a></td>";
                  }
                  else
                  {
                    echo "<td style='background:$bggrdinero; color:$fontocolordinero;'>$fila1->monto_presupuesto</td>";
                  }
             
            }
       }
       else
       {
        echo "<td></td>";
       }



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

<script type="text/javascript" src="../../resources/jquery.js"></script>

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
      <span class="close" id="closeidcont">&times;</span><br>
      
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
var closeidcont = document.getElementById("closeidcont");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeidcont.onclick = function() {
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

</body>
</html>
