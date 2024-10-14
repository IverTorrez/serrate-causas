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
    <title>Costo Judicial</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>

</head>
<body>
<?php
include_once('model/clsordengeneral.php');
include_once('model/clscostofinal.php');
include_once('controller/control-confirmarcomprajudseleccionados.php');
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
     
            <div id="portfolio_menu">
                
                <ul>
                   <form method="post" id="frmconfir"> 
                    <li><button style=" width: 400px;" name="btnconfirmarmontos" id="btnconfirmarmontos" class="botones">CONFIRMAR SELECCIONADOS CON EL MONTO ANTERIOR</button></li>
                  
                   
                </ul>
                
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->


    <!--tabal  de costos -->
    <div class="container">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">COLOCAR EGRESOS PARA EL CLIENTE(Costo judicial venta)</h3>
    <br>
      
     
    <table id="tablacolocarcostoj" >
        <thead>
            <tr>
                <th width="6%" style="font-size: 12px;">NUMERO DE ORDEN</th>
                <th width="13%" style="font-size: 12px;">CODIGO DE CAUSA</th>
                <th width="23%" style="font-size: 12px;">CARGA DE INFORMACION</th>
                <th width="20%" style="font-size: 12px;">DESCARGA DE INFORMACION</th>
                <th width="3%" style="font-size: 12px;">COSTO JUDICIAL COMPRA</th>
                <th width="15%" style="font-size: 12px;">DETALLE DE CARGA DEL COSTO JUDICIAL COMPRA</th>
                <th width="15%" style="font-size: 12px;">DETALLE DE DESCARGA DEL COSTO JUDICIAL COMPRA </th>
                <th width="3%" style="font-size: 12px;">COSTO JUDICIAL VENTA</th>
                <th width="2%" style="font-size: 12px;">TIKEAR</th>
            </tr>
        </thead>
        <tbody>
     

        <?php
        $objorden=new OrdenGeneral();
        $list=$objorden->listarordenesparacolocarcostojudicial();
        while ($fila=mysqli_fetch_object($list)) {
            $mascara=$fila->codcostofial*1234566789;
            $encriptado=base64_encode($mascara);

            echo "<tr>";
            echo "<td>$fila->codorden</td>";
            echo "<td>$fila->codigocausa</td>";
            echo "<td style='text-align: justify;'>$fila->cargainfo</td>";
            echo "<td style='text-align: justify;'>$fila->detalle_informacion</td>";
            echo "<td>$fila->comprajudicial</td>";
            echo "<td style='text-align: justify;'>$fila->detalle_presupuesto</td>";
            echo "<td style='text-align: justify;'>$fila->detalle_gasto</td>";
            echo "<td><a href='egresofinal.php?squart=$encriptado'>??</a></td>";
            echo "<td><input style='width: 20px; height: 20px;' type='checkbox'  name='lista[]' id='lista[]' value='$fila->codcostofial'> </td>";
            echo "</tr>";
        }

        ?>
         
        </tbody>
    </table>
   
   </form> 
    
 

  

</div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>


<script type="text/javascript">
 /* $(document).ready(function(){
    $('#btnconfirmarmontos').click(function(){
       var datos=$('#frmconfir').serialize();
       
       
       if (datos!='') 
       {
           $.ajax({
            type:"post",
            url:"../controller/control-confirmarcomprajudicial.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) {
                setTimeout(function(){  }, 500); swal('EXELENTE','Se encontraron registros','success');
              }
              else{
                setTimeout(function(){  }, 2000); swal('ERROR','NO se encontraron registros','warning');
              }
              $('#textpiso').val('');
            }
          });
           return false;
          
          
        }
        else{
          setTimeout(function(){  }, 2000); swal('ERROR','Debe Seleccionar registros','warning');
        }
        
    });
  });*/
</script> 