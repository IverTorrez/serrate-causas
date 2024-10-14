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
    <title>Costo Judicial Venta</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">

    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">

</head>
<body>
<?php
include_once('model/clsordengeneral.php');
include_once('model/clscostofinal.php');
include_once('model/clscausa.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsdescarga_procurador.php');
include_once('controller/control-colocarcostojudicialventa.php');

$codcostofial=$_GET['squart'];

$mascara=base64_decode($codcostofial);
$codnuevo=$mascara/1234566789;

$obor=new OrdenGeneral();
$resulor=$obor->mostraridordenDeCostofinal($codnuevo);
 $filor=mysqli_fetch_object($resulor);
 $idorden=$filor->id_orden;

 $objcausa=new Causa();
  $resul=$objcausa->mostrarcodcausadeorden($idorden);
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
        <div id="main_menu">
        
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
     
            
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->


    <!--tabal  de costos -->
    <div class="container">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">COLOCAR EGRESOS PARA EL CLIENTE(Costo judicial venta)</h3>
    <br>
    <section class="responsive">   
     <input type="hidden" name="" placeholder="id costo final" value="<?php echo $codnuevo; ?>">
    <table id="customers" >
        <thead>
            <tr>
                <th >NUMERO DE ORDEN</th>
                <th >PRIORIDAD</th>
                <th >FECHA INICIO</th>
                <th >FECHA FIN</th>
                <th width="10%">COSTO JUDICIAL COMPRA</th>
                <th width="10%">COSTO JUDICIAL VENTA</th>
                <th width="5%">COSTO PROCURADORIA COMPRA</th>
                <th width="5%">COSTO PROCURADORIA VENTA</th>
                <th >EGRESO</th>
            </tr>
        </thead>
        <tbody>
        <?php
         $objorden=new OrdenGeneral();
        $list=$objorden->mostrardetallesdeordendescargadaparacolocarcostojudicial($codnuevo);
        $fila=mysqli_fetch_object($list);

            echo "<tr>";
            echo "<td>$fila->codorden</td>";
            echo "<td>$fila->Prioridad</td>";
            echo "<td>$fila->Inicio</td>";
            echo "<td>$fila->Fin</td>";
            echo "<td>$fila->Comprajudi</td>";
            echo "<td>$fila->costoventajuducial</td>";
            echo "<td>$fila->costo_procuradoria_compra</td>";
            echo "<td>$fila->costo_procuradoria_venta</td>";
            echo "<td>$fila->total_egreso</td>";
            echo "</tr>";
        

        ?>
     

    
        </tbody>
    </table>
 

   </section>

</div><br>
<center><form method="POST" onsubmit="return validarForm(this);">
   <input type="hidden" name="textidcostofinal" id="textidcostofinal" placeholder="id costofinal" value="<?php echo $codnuevo; ?>">
   <input type="hidden" name="textidorden" id="textidorden" placeholder="id ordengeneral" value="<?php echo $fila->codorden;?>">
   <label><b>INGRESO DE DINERO PARA EGRESO DE ORDEN # <?php echo $fila->codorden;?></b></label><br>

    <input style="" class="numbertext" type="number" required="" name="textnewcostoproceventa" id="textnewcostoproceventa" value="00">

  <input type="number" class="numbertext" name="textdecimales" id="textdecimales" required="" value="00"><br>
    <input style="" type="submit" class="btncolocar" name="btncolocarcostojudiventa" id="btncolocarcostojudiventa" value="INGRESAR">
</form></center>


<style type="text/css">
  .numbertext{
    width: 7%;
  padding: 11px 12px;
  margin: 6px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box; 
  }
  .btncolocar{
    width: 20%;
  background-color: #1A5895;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  }
</style>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>

<script type="text/javascript">
function validarForm(formulario) 
{
  if(formulario.textdecimales.value.length!=2) { //comprueba que no esté vacío
    formulario.textdecimales.focus();   
    alert('Tienes que Colocar 2 decimales'); 
    return false; //devolvemos el foco
   }

   if(formulario.textdecimales.value<0) { //comprueba que no esté vacío
    formulario.textdecimales.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

   if(formulario.textnewcostoproceventa.value<0) { //comprueba que no esté vacío
    formulario.textnewcostoproceventa.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>