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
    <title>Causas Ordenes Presupuestadas</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');
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

                 <?php
                   /*CONTADORES DE ORDENES VENCIDADAS LEVES Y GRAVES*/
                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGraves();
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resultorpre_presu=$objorden9->mostrartotalordenesPre_presupuestadas();
                   $filprepresu=mysqli_fetch_object($resultorpre_presu);



                  ?>
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
              
                 
                <ul>
                    <?php
                include_once('botones_seguimientos.php');
                ?>
                    
                    
                   
                    
                    
                    
                </ul>
                
            </div> <!-- END #portfolio_menu -->
            
            
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->



    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
<!-- BOTON NUEVO AGREGADO PARA EL PASO INTERMEDIO      -->
    <div >
      <table width="100%">
        <tr>

          <td width="25%"> 
            <button style="height: 55px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepresu->Totalpre_presupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="resources/imagenedesistema/Intermedio.png"></button>
          </td>

          <td width="75%">
             <h3 style="color: #000000;font-size: 25px;">LISTADO DE CAUSAS CON ORDENES PRESUPUESTADAS</h3>
          </td>
        </tr>
      </table>  
    </div>
   <section class="responsive">

    
    <br>
       <table id="tablacausasactivas">
 <thead> 
  
  <tr>
    <th width="130px">CODIGO</th>
    <th width="300px">NOMBRE DEL PROCESO</th>
    <th width="250px">ABOGADO</th>
    <th width="250px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="250px">CLIENTE</th>
    <th width="100px" >CATEGORIA</th>
    <th width="350px">OBSERVACIONES</th>
  </tr>
</thead>
<tbody>
 <?php
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasconordenespresupuestadas();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='ordenes_presupuestadas.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a></td>";
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

<script type="text/javascript" src="resources/jquery.js"></script>


</body>
</html>
