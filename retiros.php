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
    <title>Retiros</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
    
</head>
<body>
<?php

include_once('model/clsretiros.php');
include_once('model/clscostofinal.php');



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

    <!-- <div id="portfolio_menu">

                AGREGAR SUB MENU

            </div>--> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--FORMULARIO REGISTRO DE RETIRO-->
    <div class="container">
    <h3 id="titulocrear"  class="titulo">REGISTRE SU RETIRO</h3>

    <br>
 <center> <form method="post" id="frmretiros">
   
    <input type="hidden" name="textidusu" id="textidusu" value="<?php echo $datos['id_usuario']; ?>">
 
    <div class="orden">
       <label class="lavelt">MONTO</label>
       <div style="margin-right:370px ;">
         <input style="width: 13%;" type="number" class="textform" placeholder="monto"  id="montoret" name="montoret" autocomplete="off" value="00">
       <input style="width: 13%;" type="number" class="textform" placeholder="dec." required="" id="decret" name="decret" autocomplete="off" value="00">
       </div>
       
    </div>

    <div class="orden">
       <label class="lavelt">DETALLE DEL RETIRO</label>
       <textarea class="textform" style=" height: 100px;" id="detalleret" name="detalleret"  placeholder="Escriba el detalle del retiro"></textarea>
    </div>


    <input type="submit" class="btnclose" value="REGISTRAR" id="btnreg">
    
    
  </form></center>


</div><br><br>


<!--TABLA GANANCIAS-->
<div class="container">
 <h3 style="color: #000000;font-size: 23px; text-shadow: -2px -2px 5px #333">E – REMANENTE DE LAS GANANCIAS. -</h3></div><br>

    <div class="container">
     <table id="customers">
      <thead>
        <tr>
          <th style="background: #AEAEAE;" width="90%">GANANCIAS</th>
          <th style="background: #AEAEAE;">TOTAL</th> 
        </tr>
      </thead>
       <tbody>
       <?php
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

            
          echo "<tr style='background:#ECECEC ;'>"; 
          echo "<td style='text-align: left;'>Ganancia por Diferencia en Procuraduría (compra vs venta)</td>";
          echo "<td style='text-align: right;'>$sumaganaciaprocu</td>";
         
          echo "</tr>";

          echo "<tr style='background:#ECECEC ;'>"; 
          echo "<td style='text-align: left;'>Ganancia por Gasto Procesal (compra vs venta)</td>";
          echo "<td style='text-align: right;'>$sumagananciaprocesal</td>";
         
          echo "</tr>";
          ////////////ES EL MONTO DE DINERO QUE LE RESTAMOS A LOS PROCURADORES EN PENALIDAD/////////
          $positivopenalidad=$totalentregadopenalidad*(-1);
          echo "<tr style='background:#ECECEC ;'>"; 
          echo "<td style='text-align: left;'>Ganancia por Penalidades</td>";
          echo "<td style='text-align: right;'>$positivopenalidad</td>";
         
          echo "</tr>";

         $totalsumaganacias=$filag->GananciaProcuradoria+$filaproce->GananciaProcesal+$positivopenalidad;
          echo "<tr style='background:#ECECEC ;'>"; 
          echo "<td style='text-align: center;'>TOTAL GANANCIAS</td>";
          echo "<td style='text-align: right;'><b> $totalsumaganacias </b></td>";
         
          echo "</tr>";


          $objretiros=new Retiros();
          $resultret=$objretiros->SumaDeRetiros();
          $filret=mysqli_fetch_object($resultret);

        $gananciasdisponibles=$totalsumaganacias-$filret->totalretirados;
       ?>
       <tr style="background: #ECECEC ; display: none;">
         <td colspan="1">GANANCIAS DISPONIBLES</td>
         <td style='text-align: right; font-weight: bold; font-size: 20px;'> <?php echo $gananciasdisponibles; ?></td>
       </tr>
       
         
       </tbody>
     </table>
     </div> 

    <br><br>
<!--FIN DE TABLA GANANCIAS-->



 <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">RETIROS</h3>
<div class="container">
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
      echo "<td style='text-align: right;'><b> $totalretiros</b></td>";
    ?>

    </tr>
</tbody>
</table>
</section>
</div>

    <br>
    <br>
    <br>

    <!--GANANCIAS DISPONIBLES -->
    <div class="container">
      <center>
      <table id="customers" style="width: 40%;">
        <tbody>
          <tr>
            <td style="width: 20%;">DISPONIBLE PARA RETIRAR</td>
            <td style="width: 20%; text-align: left;font-weight: bold; font-size: 30px;">    <?php echo $gananciasdisponibles; ?>  </td>
          </tr>
        </tbody>
      </table>
      </center>
    </div><br>
    <br>
    <br>




</body>
</html>
<script type="text/javascript" src="resources/jquery.js"></script>



<script type="text/javascript">



  $(document).ready(function(){
    $('#btnreg').click(function(){
       var datos=$('#frmretiros').serialize();

      // var montoretiros=$('#montoret').val().$('#montoret').val()
       
       if ($('#montoret').val()!='') 
       {
           $.ajax({
            type:"post",
            url:"controller/control-retiros.php",
            data:datos,
            success:function(respuesta)
            {
              if (respuesta==4) 
              {
                  setTimeout(function(){  }, 2000); swal('ATENCION','El monto tiene que ser mayor a CERO','info');
              }
              else
              {

                  if (respuesta==3) 
                  {
                    setTimeout(function(){  }, 2000); swal('ATENCION','No puede retirar un monto mayor a las ganacias disponibles','info');
                  }
                  else
                  {

                      if (respuesta==1) 
                      {
                        setTimeout(function(){ location.href='retiros.php' }, 1000); swal('EXELENTE','Se registro el retiro con Exito','success');
                      }
                      else
                      {
                          setTimeout(function(){  }, 2000); swal('ERROR','No se registro el retiro','warning');
                      }
                      $('#montoret').val('');
                  }
              }
            }//FIN DEL success
          });
           return false;

        }//fin del if
        else
        {
          setTimeout(function(){  }, 2000); swal('ERROR','debe llenar los campos','warning');
        }

    });
  });
</script> 
