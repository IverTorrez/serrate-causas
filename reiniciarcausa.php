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
    <title>Reiniciar</title>

    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablareiniciacausa.css">
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
include_once('model/clscausa.php');
include_once('model/clstribunal.php');
include_once('model/clsdemandante_demandado.php');
include_once('model/clspresupuesto.php');
include_once('model/clscostofinal.php');
include_once('model/clsordengeneral.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsdevoluciondinero.php');

include_once('model/clscliente.php');
include_once('model/clsusuario.php');
include_once('model/clsabogado.php');
include_once('model/clsprocurador.php');
include_once('model/clsplanilla_notificacion.php');

include_once('controller/control-reiniciar_causa.php');
include_once('controller/control-devolversaldocausa.php');

include_once('controller/control_demandante.php');
include_once('controller/contro-tribunal.php');
include_once('model/clscuerpoexpediente.php');

?> 
<?php
  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/

   $codcausa=$_GET['squart'];

    //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
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
            <ul>
               
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>

                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
                
                 <li  class="" style="float: left; margin: 0 14px; width: 445px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul>
                <form method="post">
                   <input type="hidden" name="textidcausa" value="<?php echo $codigonuevo; ?>">
                    <li><button class="botones" name="btnactivarcausa">REINICIAR CAUSA</button></li>
                    </form>
                    <li><button class="botones" onclick="location.href='listaordenes.php?squart=<?php echo $codcausa ?>'">LISTA DE ORDENES</button></li>
                     <li>
                     <?php
                     $objcausa1=new Causa();
                       $resultado=$objcausa1->mostrarcajacausa($codigonuevo);
                       $filsaldo=mysqli_fetch_object($resultado);
                       if ($filsaldo->caja>0) {
                      echo '<button class="botones" id="myBtnform">ENTREGAR SALDO</button></li>';

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
    <th width="19%">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
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
       <table id="tablareiniciacausa">
 <thead>     
  <tr>
    <th width="170px">FISIOLOGIA DEL TRIBUNAL</th>
    <th width="400px">NOMBRE DE TRIBUNAL</th>
    <th width="70px">VER UBICACION</th>
    <th width="100px">VER FOTO DE FACHADA</th>
    <th width="50px">PISO</th>
    <th width="100px"># DE EXP.</th>
    <th width="100px">EXPEDIENTE DIGITAL</th>
    <th width="100px">AGREGAR A EXPEDIENTE DIGITAL</th>
    <th width="100px">CODIGO JURIDICO</th>
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
       echo "<tr>";
              echo "<td>$fil->tptribu</td>";
              echo "<td>$fil->juzg</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
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
               echo "<td><a onclick='funcionllevaidmodalelimtrib($fil->idjuzgado)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
           
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
    <th width="7%">BORRAR</th>
  </tr>
</thead>
<tbody>

   <?php
  $obdem=new Demandante_Demandado();
  $lista=$obdem->listardemandante($codigonuevo);
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td>$fil->foja</td>";
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
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td>$fil->foja</td>";
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
        echo "<tr id='filaprosa'>";
          echo "<td>$fil->nombresdeman</td>";
          echo "<td>$fil->ultimodomicilio</td>";
          echo "<td>$fil->foja</td>";
          echo "<td><a onclick='funcionllevaidmodaltercerista($fil->id_deman)'><center><i class='fa fa-trash fa-2x' aria-hidden='true'></i></center></a></td>";
        echo "</tr>";
      }
  ?>
 
</tbody>
</table>
</section>
<br>
<br>


<!--TABLA OBSERVACIONES DE UNA CAUSA-->
<section class="responsive">
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
      while ($fil=mysqli_fetch_object($lista)){
        echo "<tr id='filaprosa'>";
           echo "<td>$fil->obsevacionescausas</td>";
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
    <?php
     /*FUNCIONES PARA HACER EL TOTAL DE LA CAJA DEL ADMINISTRADOR*/
     /*SUMA DE TODAS LAS CAUSAS*/
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaysaldo();
        $totalsaldocausas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausas=$totalsaldocausas+$fila->caja;
         // echo "<tr>"; 
         // echo "<td>$fila->codigo</td>";
         // echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
         // echo "<td style='text-align: right;'>$fila->caja</td>";
         // echo "</tr>";
        }

/*ESTAS FUNCIONES SON PARA HACER LA SUMA DE LA CAJA DEL CONTADOR ///////////////////////////////////////////*/
/*MUESTRA TODO EL PRESUPUESTO ENTREGADO POR EL CONTAOR*/
         $objpre=new Presupuesto();
         $totalentregado=0;
         $lis=$objpre->mostrarpresupuestosentregados();
         while ($filap=mysqli_fetch_object($lis)) {
              $totalentregado=$filap->monto_presupuesto+$totalentregado;
          }

          /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), NO ES LO MISMO QUE LO GASTO EL PROCURADOR*/
         $obpe=new Presupuesto();
         $resultado=$obpe->mostrarpresupuestogastado();
         $totalpresugastado=0;
         while ($filp=mysqli_fetch_object($resultado)) {
              $totalpresugastado=$filp->monto_presupuesto+$totalpresugastado;
         }

         ////////MUESTRA EL DINERO GASTADO CONFIRMADO POR EL CONTADOR Y POR EL ABOGADO (ORDENES SERRADAS (FALTA QUE EL ADM ASISGNE EL ULTIMO VALOR))
         $obccc=new Costofinal();
         $resultadog=$obccc->mostrardinerogastadosinvalida();
         $totalmontosinconfir=0;
         while ($filpaa=mysqli_fetch_object($resultadog)) {
              $totalmontosinconfir=$filpaa->Gastado+$totalmontosinconfir;
         }

         /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), y el gasto de descarga (es cuando solo el conador se pronuncio)*/
         $objor=new OrdenGeneral();
         $resultadoorden=$objor->muestraPresupuestogastadoGastodescarga();
         $totalpresugastadoconfir=0;
         $totalgastodescargaconfircont=0;
         while ($filor=mysqli_fetch_object($resultadoorden)) {
              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalpresugastadoconfir=$filor->presupuestadogastado+$totalpresugastadoconfir;

              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalgastodescargaconfircont=$filor->gastadodescarga+$totalgastodescargaconfircont;
         }

         /*MUESTRA EL DINERO EN EFECTIVO QUE TIENE EL CONTADOR EN CAJA*/
         $objcaja=new Cajasdesalida();
        $result=$objcaja->mostrarcajadelcontador();
        
        $filac=mysqli_fetch_object($result);

        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado+($totalpresugastadoconfir);


        /*NUEVO CODIGO PARA EL TOTAL DEL CONTADOR*/
           /*ESTA FUNCION DEVUELVE EL SALDO DE LAS DESCARGAS QUE NO TIENEN COSTO FINAL, Y POR LO TANTO PUEDEN AFECTAR A LA CAJA DEL CONTADOR , OSEA SI EL RESULTADO DE LA CONSULTA ES POSITIVO SE VUELVE NEGATIVO Y VICEVERSA, ESTO PARA NO AFECTAR A LA CAJA DEL CONTADOR*/
           $saldocuadrar=0;
           $objorden=new OrdenGeneral();
           $resultado1=$objorden->mostrarsaldosOrdenesNoserradas();
           $fila1=mysqli_fetch_object($resultado1);
          /*CONVERCION DEL SALDO */
          $saldocuadrar=$fila1->saldito*(-1);
           


           $nuevototalcontador=$tododelcontador+($saldocuadrar);
/*//////////////////////////////HASTA AQUI LAS SUMAS PARA LA CAJA DEL CONTADOR/////////////////////////////////////*/
       /*LOS ACUMULADOS PARA LOS PROCURADORES, POSITIVOS Y NEGATIVOS*/
       $obcosto=new Costofinal();
       $rr=$obcosto->mostrartodaslaspenalidades();
       $totalpenalidades=0;
       while ($fill=mysqli_fetch_object($rr)) {
         $totalpenalidades=$fill->penalidadcostofinal+$totalpenalidades;
        } 


       $obcaja=new Costofinal();
       $list=$obcaja->mostrargeneradosporprocuradornocancelados();
       $totalgenerado=0;
       while ($fil=mysqli_fetch_object($list)) {
         $totalgenerado=$fil->costo_procuradoria_compra+$totalgenerado;
        } 

         $saldoapagarprocuradoria=$totalgenerado+$totalpenalidades;


         /*FUNCION PARA MOSTRAR DEUDA EXTERNA*/
         $obcajas=new Cajasdesalida();
        $lista=$obcajas->mostrardeudaexterna();
        $filc=mysqli_fetch_object($lista);
        //$filc->deudaexterna

        /*SUMA DE GANANCIAS /////////////////////////////////////////////*/
        $totalsumaganacias=0;

       $sumaganaciaprocu=0;
       $obcaja2=new Costofinal();
       $list=$obcaja2->mostrargananciasprocuradoria();
        $filag=mysqli_fetch_object($list);
        $sumaganaciaprocu=$sumaganaciaprocu+$filag->GananciaProcuradoria;

        $sumagananciaprocesal=0;
        $obc=new Costofinal();
        $re=$obc->mostrargananciaprocesal();
        $filaproce=mysqli_fetch_object($re);
        $sumagananciaprocesal=$sumagananciaprocesal+$filaproce->GananciaProcesal;

        $objcostof=new Costofinal();
        $resulpenal=$objcostof->mostrarpenalidadCancelada();
         $totalentregadopenalidad=0;
        while ($filpenal=mysqli_fetch_object($resulpenal)) {
         $totalentregadopenalidad=$filpenal->penalidadcostofinal+$totalentregadopenalidad;
        } 
        

        ////////////ES EL MONTO DE DINERO QUE LE RESTAMOS A LOS PROCURADORES EN PENALIDAD/////////
        $positivopenalidad=$totalentregadopenalidad*(-1);

        $totalsumaganacias=$filag->GananciaProcuradoria+$filaproce->GananciaProcesal+$positivopenalidad;


        /*EL TOTAL EN EFECTIVO QUE TIENE LA CAJA DEL ADMINISTRADOR*/
         $totalencajaadm=0;
         $totalencajaadm=$totalsumaganacias+$totalgenerado+$totalsaldocausas+$filc->deudaexterna-($nuevototalcontador);



         ?>


     <!--MODAL PARA DEVOLVER SALDO AL CLIENTE  /////////////////////////////////////////////////////-->
   
    <section class="modal fade" id="modal-devolversaldo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                             <li class="active"><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">DEVOLUCION DE SALDO</a></li>

                                      
                                        </ul>

                                        <!-- TAB PANES -->
                                        <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                                <form action="" method="post"><br>
                                                  <label><b>Se Devolvera el saldo al cliente</b></label><br><br>
                                                  <input type="text" name="textidcausadevolver" value="<?php echo $codigonuevo;?>"><br>
                                                  <input type="text" name="textsaldocausa" value="<?php echo $filsaldo->caja;?>"><br>
                                                  <input type="text" name="textsaldocajadm" value="<?php echo $totalencajaadm;?>"><br>
                                                  <label><?php echo $filsaldo->caja;?> Bs.</label><br><br>
                                                       
                                                        
                                                      
                                                       <input style="background: #1A5895;"  type="submit" class="btn btn-primary form-control" id="btndevolversaldocausa" name="btndevolversaldocausa" value="DEVOLVER SALDO">

 
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



         <!-- The Modal (FORMULARIO) PARA devolver dinero -->
<div id="myModalform" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclose">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >DEVOLUCION DE SALDO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
     <label><b>Se Devolvera el saldo al cliente</b></label><br><br>
      <input type="hidden" name="textidcausadevolver" value="<?php echo $codigonuevo;?>">
      <input type="hidden" name="textsaldocausa" value="<?php echo $filsaldo->caja;?>">
      <input type="hidden" name="textsaldocajadm" value="<?php echo $totalencajaadm;?>">
      <label><b> Total a Devolver :</b></label>
      <label><b> <?php echo $filsaldo->caja;?> Bs.</b></label><br><br>

       <br>



    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; max-width: 180px; float: left; width: 35%;" type="submit" class="btnclose" id="btndevolversaldocausa" name="btndevolversaldocausa" value="DEVOLVER SALDO">
    <button class="btnclose" id="btncloseform" style="float: right;" type="button">Cancelar</button>
      </form>

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA devolver dinero-->
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






<!--**************MODAL PARA ELIMINAR UN TRIBUNAL DE LA CAUSA *************************-->

<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL DENADANTE 
  function funcionllevaidmodalelimtrib(idd)
  {
    $('#textidjuzgado').val(idd);
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
        <input type="hidden" class="textform" id="textidjuzgado" name="textidjuzgado" placeholder="id juzgado" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminartribcausa" name="btneliminartribcausa" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformprestrib" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>








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





<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>


