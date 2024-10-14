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
    <title>Causas Con Ordenes Presupuestadas</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clsmateria.php');
include_once('../model/clstipolegal.php');
include_once('../model/clscliente.php'); 
include_once('../model/clscategoria.php');
include_once('../model/clsabogado.php');
include_once('../model/clsprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../controller/control-causas.php'); 
 
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
                  //////FUNCIONES PARA MOSTRAR EL TOTAL DE CADA ORDEN EN SUS PASOS DE SEGUIMUIENTO
                   $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradas();
                   $fil1=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadas();
                   $fil2=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadas();
                   $fil3=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregado();
                   $fil4=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizar();
                   $fil5=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadas();
                   $fil6=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenespronunciabogado();
                   $fil7=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenespronunciocontador();
                   $fil8=mysqli_fetch_object($resul8);

                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGraves();
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resulpre_presu=$objorden1->mostrartotalordenesPre_presupuestadas();
                   $filprepresu=mysqli_fetch_object($resulpre_presu);
                  ?>
                
                 <ul>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenesgiradas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil1->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenespresupuestadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenesaceptadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: ACEPTADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>

                    <li><button class="botones" style="width: 140px; height: 55px; " onclick="location.href='causasordenesdineroentregado.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

                     <li><button class="botones" style="width: 140px; height: 55px;" onclick="location.href='causasordeneslistaspararealizar.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasordenesdescargadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>

                    <li><button class="botones" onclick="location.href='causasordenespronunciadasabogado.php'" style="width: 160px; height: 55px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenespronunciadascontador.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>

                   
                       
                </ul><br>

                <ul>
                   
                  <li><button  class="botones" style="height: 55px; width: 150px; " onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDAS LEVES</button></li>

                    <li><button  class="botones" style="height: 55px; width: 150px; " onclick="location.href='caususvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDAS GRAVES</button></li>
                    
                    <li><button  class="botones" style="height: 55px; width: 145px; " onclick="window.open('impresiones/pdf/causas_ordenes_presupuestadas.php')">IMPRIMIR</button></li>
                </ul>
               
                <br>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

   <!--TABLA MIS CAUSAS PROCURADOR-->
      <!--TABLA CAUSAS Con ordenes-->
    <div class="container">
<!-- BOTON NUEVO AGREGADO PARA EL PASO INTERMEDIO      -->
    <div >
      <table width="100%">
        <tr>

          <td width="30%"> 
            <button style="height: 55px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepresu->Totalpre_presupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="../resources/imagenedesistema/Intermedio.png"></button>
          </td>

          <td width="70%">
            <h3 style="color: #000000;font-size: 25px;">LISTADO DE CAUSAS CON ORDENES PRESUPUESTADAS</h3>
          </td>
        </tr>
      </table>  
    </div>
   
    <br>
   <section class="responsive">
    
       <table id="tablacausaPmaestro">
 <thead> 
 
  <tr>
    <th width="160px">CODIGO</th>
    <th width="280px">NOMBRE DEL PROCESO</th>
    <th width="150px">ABOGADO</th>
    <th width="150px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="150px">CLIENTE</th>
    <th width="90px">CATEGORIA</th>
    <th width="400px">OBSERVACIONES</th>
   
  </tr>
</thead>
<tbody>
 <?php
 
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasconordenespresupuestadas();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='ordenespresupuestadas.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a></td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
              echo "<td>$fil->Categ</td>";
              echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
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
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
   /* $(function() {
  var f = function() {
    $(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
  };
  $('input').change(f).trigger('change');
});*/
</script>