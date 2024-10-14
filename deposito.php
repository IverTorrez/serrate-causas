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
    <title>Deposito</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">

    <script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">

</head>
<body>
<?php
include_once('model/clsdeposito.php');
include_once('model/clscausa.php');
include_once('model/clscliente.php');
include_once('model/clsusuario.php');
include_once('model/clsplanilla_notificacion.php');
include_once('controller/control-deposito.php');

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
        <div id="main_menu">
        
            <ul>
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               

                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

<!-- LINEA QUE SEPARA EL CUERPO DE LA CABEZA-->
 <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">

    <!-- <div id="portfolio_menu">

                AGREGAR SUB MENU

            </div>--> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->





    <!--FORMULARIO REGISTRO DEPOSITO A UNA CAUSA-->
    <div class="container">

  


    <h3  class="titulo">REGISTRAR NUEVO DEPOSITO</h3>
  <form action="" method="post" onsubmit="return validarForm(this);"  >

   <input type="hidden" name="textidcausa" id="textidcausa" value="<?php echo $codigonuevo; ?>">
    <div class="orden">
       <label >MONTO EN (Bs.)</label>
       <input type="number" id="textmonto" name="textmonto" autocomplete="off" placeholder="Ingrese un monto en Bs." required="required">
    </div>

    <div class="orden">
       <label >DETALLE</label>
       
       <textarea style="height: 80px;" id="textdetalle" name="textdetalle" placeholder="Ingrese un detalle del deposito" required="required" ></textarea>
    </div>

    <div style="margin-left: 225px;">
        NOTIFICAR AL CLIENTE SOBRE SU ESTADO DE CUENTA
        <input type="checkbox" style="width: 23px; height: 23px;"  id="checnotif" name="checnotif">
        <span></span>   
    </div><br><br><br><br>

    
   <input type="submit" value="GUARDAR" id="btnregdeposito" name="btnregdeposito">
  </form>

  
   
</div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>

<script type="text/javascript">
function validarForm(formulario) {

   if(formulario.textmonto.value <=0) { //comprueba que no esté vacío
    formulario.textmonto.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>
