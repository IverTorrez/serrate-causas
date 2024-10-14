<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["contador"]))
{
  header("location:../login.php");
}
$datos=$_SESSION["contador"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calificar Orden</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../../resources/formularios.css">
        <link rel="stylesheet" type="text/css" href="../../resources/tablaordenabog.css">

    <link rel="stylesheet" type="text/css" href="../../resources/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../../js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="../../css/sweet-alert.css">

</head>
<body>
<?php
include_once('../../model/clsordengeneral.php');
include_once('../../model/clspresupuesto.php');
include_once('../../model/clsdescarga_procurador.php');
include_once('../../model/clsconfirmacion.php');
include_once('../../model/clscotizacion.php');
include_once('../../model/clscausa.php');
include_once('../../model/clscostofinal.php');
include_once('../../model/clscajasdesalida.php');

include_once('../../controller/control-pronunciamientocontador.php');


  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/10987654321;

   ?>

    <div id="header">
         
        <div class="container">
        
        <?php
        include_once('../../model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="../../resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='../../fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        <h2 id="portfolio">USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</h2>
        <div id="main_menu">
        
            <ul>
                <li class="first_list"><a href="" class="main_menu_first">AVANCE FISICO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="contador_mis_causa.php" class="main_menu_first">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
            
            <div id="portfolio_menu">
                
                <ul>
                <li><button class="botones" style="width: 100px; height: 45px;">FICHA</button></li>
                    <li><button class="botones" style="width: 200px; height: 45px;">LISTA DE ORDENES</button></li>
                    <li><button class="botones" style="width: 200px; height: 45px;">IMPRIMIR ORDEN</button></li>
                    <?php
                    $objconfir=new Confirmacion();
                    $listconfir=$objconfir->mostrarcodconfirmacion($codigonuevo);
                    $filaconfir=mysqli_fetch_object($listconfir);
                    $codconfirmacion=$filaconfir->codconfir;

                    $objeorden=new OrdenGeneral();
                    $lista=$objeorden->mustraestadodeunaorden($codigonuevo);
                    $filaorden=mysqli_fetch_object($lista);

                    if (($filaorden->estado_orden=='PronuncioAbogado' or $filaorden->estado_orden=='Descargada') and $filaorden->estado_orden!='PronuncioContador') {
                       echo '<li><form method="post">
                       <input type="hidden" name="idorden" value="'; echo $codigonuevo; echo '">
                       <input type="hidden" name="idconfir" value="'; echo $codconfirmacion; echo '">
                      <button class="botones" name="btnaceptargastos" style="width: 200px; height: 45px;">ACEPTAR $</button>
                      </form></li>

                    <li><form method="post">
                     <input type="hidden" name="idorden" value="'; echo $codigonuevo; echo '">
                     <input type="hidden" name="idconfir" value="'; echo $codconfirmacion; echo '">
                    <button class="botones" name="btnrechazardescarga" style="width: 200px; height: 45px;">RECHAZAR $</button>
                    </form></li>';
                     } 
                   
                    ?>
                    <li style="float: right;"><button style="background: red; height: 45px;" onclick="location.href='modificargasto.php?squart=<?php echo $codorden ?>'" class="botones">ALTERAR GASTOS</button></li>
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
   <input type="text" name="" value="<?php echo $codigonuevo ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR ORDEN</th>  
     <th rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
     <th rowspan="2" width="">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>  
    </tr> 
 
    <tr style="background: #B1EF07">
     <td>NIVEL DE PRIORIDAD</td> 
     <td>PLAZO OTORGADO</td> 
    </tr> 
</thead>
<tbody>
 

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
          $objdesc=new DescargaProcurador();
    $resultado=$objdesc->mostrarfojadescarga($codigonuevo);
   $filafoja=mysqli_fetch_object($resultado); 
       
   echo "<td>$filafoja->ultima_foja</td>";
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->
<section class="responsive">
       <table id="tablaordencont">
 <thead>     
  <tr>
    <th colspan="4">FECHA DE CARGA </th>
    <th   colspan="2">FECHA PARA LA GESTION</th>
    <th  colspan="3">FECHA PARA LA DESCARGA</th>
    <th rowspan="3" width="150px">FECHA OFICIAL DE CIERRE DE LA ORDEN</th>
    
  </tr>

   

<tr style="background: #B1EF07">
    <td >FECHA 1</td>
    <td >FECHA 2</td>
    <td >FECHA 3</td>
    <td >FECHA 4</td>
    <td colspan="2">FECHA 5</td>
    <td >FECHA 6</td> 
    <td >FECHA 7</td> 
    <td >FECHA 8</td>
</tr>
<tr style="background: #B1EF07">
    <td width="155px">GIRO DE LA ORDEN</td>
    <td width="150px"> ASIGNACION DE PRESUPUESTO</td>
    <td width="150px">ACEPTACION DEL PROCURADOR </td>
    <td width="150px">ENTREGA DE DINERO</td>
    <td width="150px">INICIO DE LA VIGENCIA DE LA ORDEN</td>
    <td width="150px">TÉRMINO DE LA VIGENCIA DE LA ORDEN</td> 
    <td width="150px">DESCARGA GENERAL</td>
    <td width="150px">PRONUNCIAMIENTO DEL ABOGADO</td>
    <td width="150px">COCILIACION DE CUENTAS</td>
</tr>
</thead>
<tbody>
 <tr>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>
   <td>2017-12-31 23:59</td>

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
          echo "<td>$filapres->fecha_entrega</td>";
          echo "<td>$fila->Inicio</td>";
          echo "<td>$fila->Fin</td>";

          $objdesc=new DescargaProcurador();
          $resultado=$objdesc->mostrarfechadescarga($codigonuevo);
          $filafe=mysqli_fetch_object($resultado);

          echo "<td>$filafe->fecha_descarga</td>";
          echo "<td>$fila->fecha_pronunabog</td>";///no hay aun,ni enla consulta, falta definir
          echo "<td>$fila->fecha_pronuncont</td>";///no hay aun,ni enla consulta, falta definir
          echo "<td>$fila->fecha_cierre</td>";///esta en la consulta, esta vacia
          echo "</tr>";


        }


         ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 3-->
<section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">ELEMENTOS DE LA ORDEN</h3>
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


 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">INFORMACION</th>
  </tr>
  <tr  style="background: #B1EF07">  
    <td width="50%">CARGA  DE  INFORMACION  </td>
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

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">DOCUMENTACION</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">CARGA  DE  DOCUMENTACION   </td>
    <td width="50%">DESCARGA DE DOCUMENTACION</td>
  
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
</table><br>
 <table id="customers">
 <thead>     
  <tr>
    <th colspan="3">DINERO</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">PRESUPUESTO</td>
    <td width="25%">GASTO</td>
    <td width="25%">SALDO</td>
  
  </tr>

</thead>


<tbody>
  <tr>

  <?php
$objpresupuesto=new Presupuesto();
$list=$objpresupuesto->mostrarpresupuesto($codigonuevo);
$fila1=mysqli_fetch_object($list);
if ($fila1->id_presupuesto==null) {
  echo "<td> <a href='contador_presupuestar.php?squart=$codorden'> 00</a></td>";
}
else{
  echo "<td>$fila1->monto_presupuesto</td>";
}

///DESCARGA DEL DINERO GASTADO Y EL SALDO DE LA ORDEN
   echo "<td>$fild->gastos</td>";

   echo "<td>$fild->saldo</td>";
?>


    
  
  </tr>
 </tbody>
</table>
<table id="customers">
 <thead>     
<tr>  
    <th width="50%">DETALLE DEL PRESUPUESTO A GASTAR (CARGA DE DINERO)</th>
    <th width="50%">DETALLE DEL DINERO GASTADO (DESCARGA DE DINERO)</th>
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
   <?php
    echo "<td>$fila1->detalle_presupuesto</td>";

///DETALLE DEL GASTO DEL DINERO
   echo "<td>$fild->detalle_gasto</td>";

    ?>
  
  </tr>
 
</tbody>
</table>
</section>
<br>


    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../../resources/jquery.js"></script>
</body>
</html>
