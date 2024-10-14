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
    <title>Lista de Ordenes Vencidas Leves</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

  
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
                    <li><button class="botones" style="width: 200px;" onclick="location.href='ficha.php?squart=<?php echo $codcausa; ?>'">VOLVER A LA FICHA</button></li>
                    
                    
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
    
<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ORDENES  VENCIDAS LEVES</h3>    
    <br>



<section class="responsive">
<table id="tablalistaordenadm">
 <thead> 
   
  
</thead>

<tr id="fila1">
    <td id="tdorden" rowspan="4"  width="100px"># DE ORDEN</td>
    <td id="tdorden" colspan="10">FECHAS</td>
    <td id="tdorden" colspan="5">COTIZACION</td>
    <td id="tdorden" colspan="5">FINANZAS</td>
    <td id="tdorden" rowspan="4"  width="250px">PROCURADOR <br><p id="psubt">(GESTOR)</p></td>
    <td id="tdorden" rowspan="4"  width="130px">CALIFICACION <br><p style="font-size: 12px;">(SUFICIENTE/INSUFICIENTE)</p></td>
   
  </tr>
<tr id="fila2">
<td id="tdorden" colspan="4">FECHAS DE CARGA</td>
<td id="tdorden" rowspan="3" width="120px">FECHA DE DESCARGA</td>
<td id="tdorden" colspan="2">VIGENCIA DE LA ORDEN</td>
<td id="tdorden" colspan="3">MOMENTOS  PARA EL CIERRE  DE LA ORDEN </td>
<td id="tdorden" colspan="2">PARAMETROS USADOS PARA COTIZAR ESTA ORDEN </td>
<td id="tdorden" colspan="3">COTIZACIÓN DE PROCURADURIA</td>
<td id="tdorden" colspan="2">COSTO JUDICIAL Bs.-</td>
<td id="tdorden" colspan="2">COSTO DE PROCURADURÍA Bs.-</td>
<td id="tdorden" rowspan="3"  width="120px">TOTAL EGRESO <br> <p>(para el cliente) </td>
</tr>

<tr id="fila3">
  <td id="tdorden" colspan="2">INFORMACION  Y DOCUMENTACIÓN </td>
  <td id="tdorden" colspan="2">DINERO</td>
  <td id="tdorden" rowspan="2" width="120px">INICIO</td>
  <td id="tdorden" rowspan="2" width="120px">FIN</td>
  <td id="tdorden" colspan="2">FECHAS DE PRONUNCIAMIENTOS</td>
  <td id="tdorden" rowspan="2" width="120px">FECHA OFICIAL DE CIERRE</td>
  <td id="tdorden" rowspan="2" width="80px">NIVEL DE PRIORIDAD</td>
  <td id="tdorden" rowspan="2" width="100px">PLAZO EN HORAS</td>
  <td id="tdorden" rowspan="2" width="80px">COMPRA</td>
  <td id="tdorden" rowspan="2" width="80px">VENTA</td>
  <td id="tdorden" rowspan="2" width="80px">PENALIDAD</td>
  <td id="tdorden" rowspan="2" width="60px">COMPRA </td>
  <td id="tdorden" rowspan="2" width="60px">VENTA</td>
  <td id="tdorden" rowspan="2" width="150px">COMPRA <br> <p>(para el procurador)</p></td>
  <td id="tdorden" rowspan="2"  width="150px">VENTA <br> <p>(para el cliente)</p></td>
</tr>

<tr id="fila4">
  <td id="tdorden" width="120px">GIRO</td>
  <td id="tdorden" width="120px">PRESUPUESTO</td>
  <td id="tdorden" width="120px">CARGA MATERIAL DE INFORMACION Y DOCUMENTACION</td>
  <td id="tdorden" width="120px" >ENTREGA DE DINERO</td>
  <td id="tdorden" width="120px">DEL ABOGADO</td>
  <td id="tdorden" width="120px">DEL CONTADOR</td>
</tr>



<?php
 

  /*******NUEVO LISTADO************************************NUEVO LISTADO/*************/
  ini_set('date.timezone','America/La_Paz');
 $fechoyal=date("Y-m-d");
 $horita=date("H:i");
 $concat=$fechoyal.' '.$horita;

   $objorden=new OrdenGeneral();
   $resul=$objorden->mostrarOrdenVencidasLevesDeCausaAdmin($codigonuevo);

   while ($fil=mysqli_fetch_object($resul)) 
   {  
       $fechafinorden=$fil->Fin;
       $newfechfin=date_create($fechafinorden);
       $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

       $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
       $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
       /*PREGUNTAMOS SI LA FECHA ACTUAL ES MAYOSR A LA FECHA FINAL DE LA ORDEN (SI ESTA VENCIDA LEVE)*/
       if ($fecha1>$fecha2) 
       {
         echo "<tr>";
        //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->Codorden*10987654321;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='ordenadmin.php?squart=$encriptado'>$fil->Codorden</a></td>";
              echo "<td>$fil->fecha_giro</td>";
              echo "<td>$fil->fecha_presupuesto</td>";
              echo "<td>$fil->fecha_recepcion</td>";
               echo "<td>$fil->fecha_entrega</td>";
               echo "<td>$fil->fecha_descarga</td>";
              echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->Fin</td>";
              echo "<td>$fil->fecha_confir_abogado</td>";
              echo "<td>$fil->fecha_confir_contador</td>";
              echo "<td>$fil->fecha_cierre</td>";
              echo "<td>$fil->Prioridad</td>";
              
             
             switch ($fil->Condicion) {
                case 1:echo "<td>mas de 90</td>"; break;
                case 2:echo "<td>72-90</td>"; break;
                case 3:echo "<td>48-72</td>"; break;
                case 4:echo "<td>24-48</td>"; break;
                case 5:echo "<td>8-24</td>"; break;
                case 6:echo "<td>0-8</td>"; break;        
              }

              echo "<td>$fil->Compra</td>";
              echo "<td>$fil->Venta</td>";
              echo "<td>$fil->Penalidad</td>";

              echo "<td>$fil->gastos</td>"; 

              echo "<td>$fil->ventacotfinal</td>";  //dato no hay aun, esta en costo final
               echo "<td>$fil->compraprocu</td>";  //dato no hay aun, esta en costo final
               echo "<td>$fil->ventaparaclie</td>";  //dato no hay aun, esta en costo final
               echo "<td>$fil->totalparaclie</td>";  //dato no hay aun, esta en costo final

              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->calificacion_todo</td>";



        echo "</tr>";
       }

       
   }
  ?>





<tbody>

 
</tbody>
</table>
</section>
   

   

   <!--SECCION PARA MOSTRAR LAS TRANSFERENCIAS-->
    

    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
