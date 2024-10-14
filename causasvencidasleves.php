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
    <title>Causas Vencidas Leves</title>
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


                  ?>
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
              
                 
                <ul>
                    <li ><button  class="botones" onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDOS LEVES</button></li>
                    
                     <li ><button  class="botones" onclick="location.href='causasvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDOS GRAVES</button></li>
                    
                    
                   
                    
                    
                    
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

    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CAUSAS VENCIDAS LEVES</h3>
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
   ini_set('date.timezone','America/La_Paz');
 $fechoyal=date("Y-m-d");
 $horita=date("H:i");
 $concat=$fechoyal.' '.$horita;
 
 $arrayIdCausas=array();
 $objorde=new OrdenGeneral();
 $resulorden=$objorde->mostrarfechafinalyCodCausaVencidosLeves();
 while ($filord=mysqli_fetch_object($resulorden)) 
 {
     $fechafinorden=$filord->Fechafinal;
     $newfechfin=date_create($fechafinorden);
     $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

     $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
     $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
     /*PREGUNTAMOS SI LA FECHA ACTUAL ES MAYOSR A LA FECHA FINAL DE LA ORDEN (SI ESTA VENCIDA LEVE)*/
    if ($fecha1>$fecha2) 
      { /*COMPRUEBA SI EL IDCAUSA YA EXIXTE EN EL ARRAY*/
          if (in_array($filord->id_causa,$arrayIdCausas)) 
          {
           
          }
          else
          {
            array_push($arrayIdCausas, $filord->id_causa);
          }
        
      }
 }/*FIN DEL WHILE QUE RRECORRE LAS ORDENES DESCARGADAS VENCIDAS LEVES*/


 if (count($arrayIdCausas)>0) 
 {
   $contador1=0;
   $contadorarray=count($arrayIdCausas);
   while ($contador1<$contadorarray) 
   { 
     $idcausa1=$arrayIdCausas[$contador1];
     $objcausa1=new Causa();
     $resultcausa=$objcausa1->mostrarUnacausa($idcausa1);
     $filcausa=mysqli_fetch_object($resultcausa);
      echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$filcausa->idcausa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='listadovencidasleves.php?squart=$encriptado'>$filcausa->codigo</a></td>";
              echo "<td>$filcausa->nombrecausa</td>";
              echo "<td>$filcausa->abogadogestor</td>";
              echo "<td>$filcausa->procuradorasig</td>";
              echo "<td>$filcausa->clienteasig</td>";
              echo "<td>$filcausa->Categ</td>";
             
              echo "<td style='text-align: justify;'>$filcausa->Observ</td>";

            
        echo "</tr>";

     $contador1++;
     
   }/*FIN DEL WHILE QUE RECORRE EL ARRAY PARA MOSTRAR CAUSAS*/
 }/*FIN DEL IF QUE PREGUNTA SI EL ARRAY TIENE VALORES*/


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
