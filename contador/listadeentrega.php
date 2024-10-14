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
	<title>Lista de Entrega de Dinero</title>
  <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
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
        
         <h2 id="portfolio">USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</h2>
        <div id="main_menu">
            <ul>
                <li class="first_list"><a href="" class="main_menu_first">AVANCE FISICO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="contador_mis_causa.php" class="main_menu_first main_current">CAUSAS ACTIVAS</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
                </li>
                 <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->	
	</div><!-- FIN container -->
</div><!-- FIN header -->
<div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                <ul>
                    
                    <li><button class="botones" onclick="location.href='contador_entregar_muchos.php'" style="width: 610px; height: 60px;">ENTREGAR MUCHOS</button></li>
                    <li><button class="botones" onclick="location.href='contador_recibir_mucho.php'" style="width: 585px; height: 60px;">DEVOLVER MUCHOS</button></li>
                </ul><br><br>
                 <ul>
                    <li><button class="botones" style="width: 200px; height: 45px;">1: GIRO DE LA ORDEN</button></li>
                     <li><button class="botones" style="height: 45px; width: 200px;">2: PRESUPUESTO</button></li>
                    <li><button class="botones" style="width: 400px; height: 45px;">3: CARGA MATERIAL INFORMACION/DOCUMENTACION</button></li>
                   
                    <li><button class="botones" style="width: 240px; height: 45px;">4: CARGA MATERIAL DINERO</button></li>
                    <li><button class="botones" style="width: 150px; height: 45px;" >5: GESTION</button></li>
                   

                    
                    
                </ul><br>

                <ul>
                 <li><button class="botones" style="width: 200px; height: 45px;">6: DESCARGA GENERAL</button></li>
                    <li><button class="botones" style="width: 290px; height: 45px;">7: PRONUNCIAMIENTO ABOGADO</button></li> 
                    <li><button class="botones" style="width: 300px; height: 45px;">8: DEVOLUCION SALDO DE DINERO</button></li>           
                    <li><button class="botones" style="width: 200px; height: 45px;">VENCIDOS</button></li> 
                    <li><button class="botones" style="width: 200px; height: 45px;">IMPRIMIR</button></li>
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
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ORDENES (PARA ENTREGAR DIENRO)</h3>
    <br>
       <table id="tablalistaordenentrega">
 <thead>
  
  <tr>
    <th width="120px"># ORDEN</th>
    <th width="150px">FECHA GIRO</th>
    <th width="150px">FECHA INICIO</th>
    <th width="150px">FECHA FIN </th>
    
     <th width="150px">FECHA PRESUPUESTO</th>
     <th width="150px">FECHA RECEPCION</th>
    <th width="80px">PRIORIDAD</th>
    <th width="100px">PRESUPUESTO</th>
   
    <th width="250">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>
  </tr>
    

</thead>
<tbody>


<?php
   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesentregadinero();
   while ($fil=mysqli_fetch_object($resul)) {
      echo "<tr>";
      //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
      $mascara=$fil->codorden*5040302010;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a href='entregardinero.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codorden</a></td>";
      echo "<td>$fil->fecha_giro</td>";
      echo "<td>$fil->Inicio</td>";
      echo "<td>$fil->fin</td>";
     
       echo "<td>$fil->fecha_presupuesto</td>";
        echo "<td>$fil->fecha_recepcion</td>";
      echo "<td>$fil->prioridad</td>";
      echo "<td>$fil->monto_presupuesto</td>";

     
      echo "<td>$fil->procuradorasig</td>";
      

      echo "</tr>";
          }
  ?>
</tbody>
</table>
</section>
    </div>

</body>
</html>