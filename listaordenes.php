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
    <title>Lista de Ordenes</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

   <script src="js/jquery.js"></script>
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
include_once('model/clsdevoluciondinero.php');

 $codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";
    /*============PARA GENERAR EL NUMERO DE PAGINA===========*/
    $objorden1=new OrdenGeneral();
    $resulcount=$objorden1->contadorde_ordenesDeCausa($codigonuevo);
    $filclunt=mysqli_fetch_object($resulcount);
    $cantidadOrdenes=$filclunt->cantidadorden;
    $numerodePaginas=($cantidadOrdenes / 20);
    
    $numPaginasEntero= ceil( $numerodePaginas );//redondea hacia adelante
    
   /*===============================================================*/
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
                    
                    <?php
                    $objcausa33=new Causa();
                    $resultaca=$objcausa33->mostrarEstadoCausa($codigonuevo);
                     $files=mysqli_fetch_object($resultaca);
                     if ($files->estadocausa!='Terminada') 
                     {
                    ?>
                       <li><button class="botones" style="width: 200px;" onclick="location.href='ficha.php?squart=<?php echo $codcausa; ?>'">VOLVER A LA FICHA</button></li>
                       <li><button class="botones" style="width: 300px;" onclick="location.href='deposito.php?squart=<?php echo $codcausa; ?>'">INGRESAR NUEVO DEPOSITO</button></li>

                    <?php
                     }
                     else
                     {
                  echo '<li><button class="botones" style="width: 200px;background: #EEEEEE; color: #9A9DA6; border-color:#AEAFAF;">VOLVER A LA FICHA</button></li>
                        <li><button class="botones" style="width: 300px; background: #EEEEEE; color: #9A9DA6; border-color:#AEAFAF;" >INGRESAR NUEVO DEPOSITO</button></li>';
                     }
                    ?>
                    
                    <li><button class="botones" style="width: 150px;" onclick="window.open('impresiones/tcpdf/pdf/listaordenesdomp.php?cod=<?php echo $codcausa; ?>')">IMPRIMIR TODO</button></li>
                    
                     <li><button class="botones" style="width: 150px;" onclick="abrirPaginasImpresion(<?php echo $numPaginasEntero; ?>)">IMPRIMIR TODO 2</button></li>
                     
                    <li><button style="width: 390px" class="botones" onclick="window.open('impresiones/liquidacion_cliente.php?cod=<?php echo $codigonuevo; ?>')">IMPRIMIR LIQUIDACION PARA EL CLIENTE (EXT.)</button></li>
                   
                    
                </ul>
                 <ul>

                    <li><button style="width: 300px;" class="botones" onclick="window.open('impresiones/tcpdf/pdf/rendimiento_procuraduria_dom.php?cod=<?php echo $codcausa; ?>')">IMPRIMIR RENDIMIENTO DE PROCURADURÍA </button></li>
                    <li><button style="width: 300px;" class="botones" onclick="window.open('impresiones/tcpdf/pdf/fechas_de_tramitacion.php?cod=<?php echo $codcausa; ?>')">IMPRIMIR FECHAS DE TRAMITACIÓN DE ORDEN</button></li>
                    <li><button style=" width: 290px; " class="botones" onclick="copiarAlPortapapeles2('textcopy');">GENERAR LINK DE MONITOREO PARA EL CLIENTE</button></li>
                    <?php
                    if ($files->estadocausa!='Terminada') 
                    {
                      ?>

                      <li><button style=" width: 300px; " class="botones" onclick="location.href='crearordenadmin.php?squart=<?php echo $codcausa; ?>'">GIRAR UNA ORDEN COMO ADMINISTRADOR</button></li>

                    <?php
                    }
                    else
                    {
                      echo '<li><button style=" width: 300px;background: #EEEEEE; color: #9A9DA6; border-color:#AEAFAF;" class="botones">GIRAR UNA ORDEN COMO ADMINISTRADOR</button></li>';
                    }
                    ?>
                    
                   
                 </ul>
               
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
   <?php
   
   /*****************CODIGO PARA GENERAR EL LINK PARA MONITOREODEL CLIENTE*******************/
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    $urlresumen='/resumen_egresos_ingresos.php?squart='.$codcausa;
   // echo "http://" . $host . $url;echo "<br>";
   // echo $url;
   $urlcompleto=$host.$urlresumen;
    
   echo '<div id="copiartexto" style="display:none">
         <p id="textcopy">'.$urlcompleto.'</p>
         </div>';
   //echo $urlactual;
   //echo "<br>";

/************************************************************************************/

    ?>


    <!--FUNCION PARA GENERAR LINK
    <script type="text/javascript">
         //Asigno el evento "click" del botón para provoar el copiado
    document.getElementById('btngeneralink').addEventListener('click', copiarAlPortapapeles);

    //Función que lanza el copiado del código
    function copiarAlPortapapeles(ev)
    {
        var codigoACopiar = document.getElementById('copiartexto');    //Elemento a copiar
        //Debe estar seleccionado en la página para que surta efecto, así que...
        var seleccion = document.createRange(); //Creo una nueva selección vacía
        seleccion.selectNodeContents(codigoACopiar);    //incluyo el nodo en la selección
        //Antes de añadir el intervalo de selección a la selección actual, elimino otros que pudieran existir (sino no funciona en Edge)
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(seleccion);  //Y la añado a lo seleccionado actualmente
        try {
            var res = document.execCommand('copy'); //Intento el copiado
            if (res)
                exito();
            else
                fracaso();

            mostrarAlerta();
        }
        catch(ex) {
            excepcion();
        }
        window.getSelection().removeRange(seleccion);
    }
    </script>-->

<!--FUNCION  EN JAVA SCRIPT PARA COPIAR EL LINK DESPUES DE PRESIONAR EL BOTON *************************** -->
<script type="text/javascript">
  function copiarAlPortapapeles2(id_elemento) {

  // Crea un campo de texto "oculto"
  var aux = document.createElement("input");

  // Asigna el contenido del elemento especificado al valor del campo
  aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);

  // Añade el campo a la página
  document.body.appendChild(aux);

  // Selecciona el contenido del campo
  aux.select();

  // Copia el texto seleccionado
  document.execCommand("copy");

  // Elimina el campo de la página
  document.body.removeChild(aux);
  alert("Se Copio Link De Monitoreo Al Portapapeles");

}

function abrirPaginasImpresion(numPagina){
    var contador=1;
    while (contador<=numPagina)
    {
    window.open("impresiones/tcpdf/pdf/listaordenes.php?cod=<?php echo $codcausa; ?>&page="+contador) //No es necesario el ; en JS
   // window.open("impresiones/tcpdf/pdf/listaordenesdomp.php?cod=<?php echo $codcausa; ?>")
    contador++;
    }
  }
</script>
<!--***********************************************************************************************-->

<div id="divresultadolista">
  
</div>

<?php
echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro de timestamp para evitar el caché
        var url = 'consultalistaordenescausaadmin.php?codicausa=$codigonuevo&nocache=' + new Date().getTime();
        $('#divresultadolista').load(url);
    });
</script>";
?>

 

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->




    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
