<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["abogado"];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Orden Descargada</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/tablaordenabog.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

</head>
<body>
<?php
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clsconfirmacion.php');
include_once('../controller/control-pronunciamientoabogado.php');
$codorden=$_GET['squart']; 
//SE DESENCRIPTA EL CODIGO DE LA ORDEN PARA PODER USARLO // 
$decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/10987654321;
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
        
        <h2 id="portfolio">USUARIO:<?php echo $datos['nombreabog']; ?>  TIPO:Abogado</h2>
        <div id="main_menu">
        
            <ul>
                <li  class="first_listleft" style="float: left; width: 600px;"><a >USUARIO:<?php echo $datos['nombreabog']; ?>  TIPO:Abogado</a></li>
                
                <li class="first_list" ><a href="miscausas.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" style="width: 200px; height: 45px;">FICHA</button></li>
                    <li><button class="botones" style="width: 200px; height: 45px;">LISTA DE ORDENES</button></li>

                    <?php
                     $idabogado=$datos["id_abogado"];
                    $objconfir=new Confirmacion();
                    $listconfir=$objconfir->mostrarcodconfirmacion($codigonuevo);
                    $filaconfir=mysqli_fetch_object($listconfir);
                    $codconfirmacion=$filaconfir->codconfir;

                    $objeorden=new OrdenGeneral();
                    $lista=$objeorden->mustraestadodeunaordenidabogado($codigonuevo);
                    $filaorden=mysqli_fetch_object($lista);

                    if (($filaorden->estado_orden=='Descargada' or $filaorden->estado_orden=='PronuncioContador') and $filaorden->fechaconfabogado=='' and $filaorden->idabogado==$idabogado) {
                       echo '<li><form method="post">
                       <input type="hidden" name="idorden" value="'; echo $codigonuevo; echo '">
                       <input type="hidden" name="idconfir" value="'; echo $codconfirmacion; echo '">
                      <button class="botones" name="btnaceptardescarga" style="width: 200px; height: 45px;">ACEPTAR</button>
                      </form></li>

                    <li><form method="post">
                     <input type="hidden" name="idorden" value="'; echo $codigonuevo; echo '">
                     <input type="hidden" name="idconfir" value="'; echo $codconfirmacion; echo '">
                    <button class="botones" name="btnrechazardescarga" style="width: 200px; height: 45px;">RECHAZAR</button>
                    </form></li>';
                     } 
                   
                    ?>

                    
                   
                   
                 
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
   <input type="hidden" name="" value="<?php echo $codigonuevo ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->

</section>

<style type="text/css">
 
</style>

<!--TABLA DETALLE ORDEN-->
<section class="responsive">
 <table id="customers">
 <thead> 

  
</thead>
<tbody>
<tr id="fila1">
  <td id="tdorden" rowspan="2" width="14%">CODIGO DE LA CAUSA</td>
  <td id="tdorden" rowspan="2" width="13%">NUMERO DE LA ORDEN</td>
  <td id="tdorden" colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR LA ORDEN</td>
  <td id="tdorden" rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</td>
  <td  id="tdorden" rowspan="2">PROCURADOR <br><p id="psubt">(GESTOR)</p></td>
    
</tr>
 
 <tr id="fila2">
   <td id="tdorden" >NIVEL DE PRIORIDAD</td>
   <td id="tdorden" >PLAZO EN HORAS</td>

 </tr>
 
  <?php
  $objorden1=new OrdenGeneral();
   $resul=$objorden1->listardetalledeordentabla1($codigonuevo);
   $fil=mysqli_fetch_object($resul); 
   echo " <tr>";
  echo "<td>$fil->codigocausa</td>";
  echo "<td>$fil->numeroorden</td>";
  echo "<td>$fil->Prioridad</td>";
   switch ($fil->Condicion) {
                case 1:echo "<td>mas de 90</td>"; break;
                case 2:echo "<td>72-90</td>"; break;
                case 3:echo "<td>48-72</td>"; break;
                case 4:echo "<td>24-48</td>"; break;
                case 5:echo "<td>8-24</td>"; break;
                case 6:echo "<td>0-8</td>"; break;        
              }
        $objdescarga=new DescargaProcurador();
        $list=$objdescarga->mostrarfojadescarga($codigonuevo);
        $filfoja=mysqli_fetch_object($list);

   echo "<td>$filfoja->ultima_foja</td>"; 
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
 
</tbody>
</table>
</section><br>

<section class="responsive">
 <table id="customers">
   <thead>
   
   </thead>
   <tbody>
   <tr id="fila1">
     <td id="tdorden" colspan="4">FECHAS DE CARGA</td>
     <td  id="tdorden" id="tdorden" colspan="2">FECHAS PARA LA GESTION</td>
     <td id="tdorden"   >FECHA DE LA DESCARGA</td>
     
    </tr>

    

    <tr id="fila2">
      <td id="tdorden">FECHA 1</td>
      <td id="tdorden">FECHA 2</td>
      <td id="tdorden">FECHA 3</td>
      <td id="tdorden">FECHA 4</td>
      <td id="tdorden" colspan="2">FECHA 5</td>
      <td id="tdorden" >FECHA 6</td>
      
    </tr>

    <tr id="fila2">
      <td id="tdorden" width="155px" >GIRO DE UNA NUEVA ORDEN</td>
      <td id="tdorden" width="150px" >ASIGNACION DE PRESUPUESTO</td>
      <td id="tdorden" width="150px" >ACEPTACION DEL PROCURADOR</td>
      <td id="tdorden" width="150px" >ENTREGA DE DINERO</td>
      <td id="tdorden" width="150px" >INICIO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="150px" >TERMINO DE LA VIGENCIA DE LA ORDEN</td>
      <td id="tdorden" width="150px" >DESCARGA GENERAL</td>
      
    </tr>


    <?php
         $objorden2=new OrdenGeneral();
        $resul=$objorden2->listarfechasdeunaorden($codigonuevo);
    
        while ($fila=mysqli_fetch_object($resul)){
           
          echo "<tr>"; 
          echo "<td>$fila->fecha_giro</td>";

          $objpresup=new Presupuesto();
          $listado=$objpresup->mostrarfechaspresupuestoyentrega($codigonuevo);
          $filapres=mysqli_fetch_object($listado);


          echo "<td>$filapres->fecha_presupuesto</td>";
          echo "<td>$fila->fecha_recepcion</td>";
          echo "<td>$filapres->fecha_entrega</td>"; //es la fecha de entrega de dinero
          echo "<td>$fila->Inicio</td>";
          echo "<td>$fila->Fin</td>";

          $objdesc=new DescargaProcurador();
          $resultado=$objdesc->mostrarfechadescarga($codigonuevo);
          $filafe=mysqli_fetch_object($resultado);

          echo "<td>$filafe->fecha_descarga</td>";
         // echo "<td>$fila->fecha_pronunabog</td>";///no hay aun,ni enla consulta, falta definir
         // echo "<td>$fila->fecha_pronuncont</td>";///no hay aun,ni enla consulta, falta definir
         // echo "<td>$fila->fecha_cierre</td>";///esta en la consulta, esta vacia
          echo "</tr>";


        }


         ?>

   </tbody>
   
 </table> 
</section><br>

 


 <section>
    <h3 style="color: #000000;font-size: 25px;text-align: center;">ELEMENTOS DE LA ORDEN</h3>
    <br>
   

</section>
<?php
 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila=mysqli_fetch_object($resul);
?>

<!--METODO PARA LISTAR LAS DESCARGAS DE UNA ORDEN-->
<?php
 $objdesc=new DescargaProcurador();
$result=$objdesc->mostrardescargaorden($codigonuevo);
$fild=mysqli_fetch_object($result);
?>


<!--TABLA INFORMACION CARGA Y DESCARGA DE UNA ORDEN-->
<section class="responsive">
 <table id="customers">
 <thead> 
 <th colspan="2">INFORMACION</th>
  <tr id="fila2">
    <td width="50%">CARGA DE INFORMACION</td>
    <td width="50%">DESCARGA DE INFORMACION</td>
   
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
     <?php
    echo "<td>$fila->informacion</td>";

    echo "<td>$fild->detalle_informacion</td>";
    ?>
    
  
  </tr>
 
</tbody>
</table><br>

<!--TABLA DOCUMENTACION CARGA Y DESCARGA DE UNA ORDEN-->
 <table id="customers">
 <thead> 
 <th colspan="2">DOCUMENTACION</th>
  <tr id="fila2">
    <td  width="50%">CARGA DE DOCUMENTACION</td>
    <td  width="50%">DESCARGA DE DOCUMENTACION</td>
  
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
   <?php
    echo "<td>$fila->documentacion</td>";

    echo "<td>$fild->documentaciondescarga</td>";
    ?>
  
  
  </tr>
 
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