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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Saldos-Causas</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
   
   <?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " .gmdate("D, d M Y H:i:s" )."GMT");
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
?>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">




 
   
 

    <link rel="stylesheet" type="text/css" href="resources/menu.css">
   
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/tablalistordenadm.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">

  <script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">
     <script src="js/jquery.js"></script>

     

      <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">

  <!--jquery -->
    
    <script type="text/javascript" src="resources/jquery.js"></script>

    <!--INCLUIMOS LOS PLUGINS DE DATA TABLES-->
 <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"> </script>


<link rel="stylesheet" href="PluginTable/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="PluginTable/datatables.net-bs/css/responsive.bootstrap.min.css">


<script src="PluginTable/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="PluginTable/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="PluginTable/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="PluginTable/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


<!--//////////////////////////////////////-->

</head> 
<body>
<?php
 //onload="cargarsettime()"
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');
include_once('model/clspresupuesto.php');
include_once('model/clscostofinal.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clscajasdesalida.php');
include_once('model/clsdeposito.php');
include_once('model/clscliente.php');
include_once('model/clsprestamos.php');/*nuevo*/
include_once('model/clstransferencia_contador.php');/*nuevo*/
//include_once('controller/control-caja.php');/*PRESTAMO EXTERNO Y DEVOLUCIONES*/
//include_once('controller/control-transferencia.php');

//include_once('controller/control-devolvercajadelcontador.php');


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
               
                
                 <li  class="" style="float: left; margin: 0 14px; width: 420px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

     <div id="main_content">
            
        <div id="portfolio_area">
        <div class="container">    
          <div id="portfolio_menu">

            <ul>
            
             <li><button style="width: 300px;" class="botones" id="myBtnformtrans">TRANSFERENCIA DE FONDOS ENTRE CAUSAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarTodascausasActivas();">LISTAR CAUSAS ACTIVAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarTodascausascongeladas();">LISTAR CAUSAS CONGELADAS</button></li>
             <li><button  class="botones"  onclick="funcionllamarTodascausasterminadas();">LISTAR CAUSAS TERMINADAS</button></li>
             

          </ul><br><br>

           

            </div>
            </div>

        </div>

    </div>
<!--FUNCIONES PARA REDIRECCIONAR AL LOGIN -->
    <script type="text/javascript">
      function cargarsettime()
      {
        setTimeout('redireccionar()',10000);
      }
    </script>

    <script type="text/javascript">
      function redireccionar()
      {
        location.href='index.php';
      }
    </script>
    
 
  <div class="container">
    <h3 id="titulodetodascausas" style="color: #000000;font-size: 20px; ">A – RELACIÓN ADMINISTRADOR/CLIENTE <small style="color: #000000;font-size: 13px;"> (DEPÓSITOS Y DEVOLUCIONES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES DE TODAS LAS CAUSAS)</small></h3>
  </div>

    <h3 id="titulodecausaiddesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL CODIGO</h3>

    <h3 id="titulodecausaSaldodesc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA DESCEDENTE SEGUN EL SALDO</h3>

    <h3 id="titulodecausaSaldoAsc" style="display: none; color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE TODAS LAS CAUSAS-EN FORMA ASCENDENTE SEGUN EL SALDO</h3>

    <div class="container" id="divtodaslascausa" style="display: none;">
     <table id="customers">
       <thead>
         <tr >
           <th width="25%" style="background: #AEAEAE;"><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="iddesc" onclick="funcionlistaridcausadescendente();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="idasc" onclick="funcionmostrarAscendenteID();">  CODIGO DE CAUSA</th>
           <th style="background: #AEAEAE;">NOMBRE DE LA CAUSA</th>
           <th style="background: #AEAEAE;">NOMBRE DEL CLIENTE</th>

           <th style="background: #AEAEAE;" width="10%" ><img style="cursor: pointer;" align="left" src="resources/img-desc.png" id="saldodesc" onclick="funcionmostrarDescendenteSaldo();"> <img style="cursor: pointer; display: none;" align="left" src="resources/img-asc.png" id="saldoasc" onclick="funcionmostrarAscendenteSaldo();">SALDO</th>
         </tr>
       </thead>
       <tbody id="bodytodascausas">
         

         <?php
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaysaldoYcliente();
        $totalsaldocausas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausas=$totalsaldocausas+$fila->caja;
          echo "<tr style='background:#ECECEC ;'>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: left;'>$fila->nombcli</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr style="background: #ECECEC;">
           <td colspan="3">SALDO TOTAL</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausas</td>";
           ?>

         </tr>
         

       
       </tbody>

       <tbody id="bodydesc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConIdDescenenteYsaldo();
        $totalsaldocausasdescendid=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausasdescendid=$totalsaldocausasdescendid+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausasdescendid</td>";
           ?>

         </tr>

       </tbody>


       <tbody id="bodysaldodesc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConSaldoDescenenteYsaldo();
        $totalsaldocausassaldodesc=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausassaldodesc=$totalsaldocausassaldodesc+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausassaldodesc</td>";
           ?>

         </tr>

       </tbody>

       <tbody id="bodysaldoAsc" style="display: none;">
       <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConSaldoAscenenteYsaldo();
        $totalsaldocausassaldoAsc=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausassaldoAsc=$totalsaldocausassaldoAsc+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausassaldoAsc</td>";
           ?>

         </tr>

       </tbody>

      
        
      
     </table>
      
    </div>

    
    <!--DIV DONDE SE CARGA LA TABLA DE CAUSAS CONGELADAS-->
    <div class="container">
    <div id="divcausascongeladas">
      
    </div>
    </div>
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS CONGELADAS-->

    <!--DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
    
    <!--HASTA AQUI DIV DONDE SE ARGA LA TABLA DE CAUSAS TERMINADAS-->
     



   <!--<h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAJA DEL CONTADOR</h3>
    ESTA TABLA ESTA PARA QUE CUADRE LA CAJA DEL ADMINISTRADOR, PERO NO SE MOSTRATA-->
    <div class="container" style="display: none;">
     <table id="customers">
       <thead>
         <tr>
           <th width="90%">CAJA DE CONTADOR</th>
           
           <th width="10%" >SALDO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php
        /*MUESTRA TODO EL PRESUPUESTO ENTREGADO POR EL CONTAOR*/
         $objpre=new Presupuesto();
         $totalentregado=0;
         $lis=$objpre->mostrarpresupuestosentregados();
         while ($filap=mysqli_fetch_object($lis)) {
              $totalentregado=$filap->monto_presupuesto+$totalentregado;
          
         }

      /*   $obp=new DescargaProcurador();
         $resulta=$obp->listarlosgastossinvalidar();
         $totalmontogastado=0;
         while ($filag=mysqli_fetch_object($resulta)) {
              $totalmontogastado=$filag->comprajudicial+$totalmontogastado;
         }*/

       /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), NO ES LO MISMO QUE LO GASTO EL PROCURADOR*/
         $obpe=new Presupuesto();
         $resultado=$obpe->mostrarpresupuestogastado();
         $totalpresugastado=0;
         while ($filp=mysqli_fetch_object($resultado)) {
              $totalpresugastado=$filp->monto_presupuesto+$totalpresugastado;
         }
////////MUESTRA EL DINERO GASTADO CONFIRMADO POR EL CONTADOR Y POR EL ABOGADO (ORDENES SERRADAS (FALTA QUE EL ADM ASISGNE EL ULTIMO VALOR))
         $obccc=new Costofinal();
         $resultadog=$obccc->mostrardinerogastadosinvalida();
         $totalmontosinconfir=0;
         while ($filpaa=mysqli_fetch_object($resultadog)) {
              $totalmontosinconfir=$filpaa->Gastado+$totalmontosinconfir;
         }

         /*MUESTRA EL PRESUPUESTO QUE YA GASTO EL PROCURADOR(ORDENES DESCARGADAS), y el gasto de descarga (es cuando solo el conador se pronuncio)*/
         $objor=new OrdenGeneral();
         $resultadoorden=$objor->muestraPresupuestogastadoGastodescarga();
         $totalpresugastadoconfir=0;
         $totalgastodescargaconfircont=0;
         while ($filor=mysqli_fetch_object($resultadoorden)) {
              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalpresugastadoconfir=$filor->presupuestadogastado+$totalpresugastadoconfir;

              /*ES LA SUA DEL PRESUPUESTO GASTADO CONFIRMADO POR EL CONTADOR, PERO ORDEN NO ESTA SERRADA*/
              $totalgastodescargaconfircont=$filor->gastadodescarga+$totalgastodescargaconfircont;
         }



        /*MUESTRA EL DINERO EN EFECTIVO QUE TIENE EL CONTADOR EN CAJA*/
         $objcaja=new Cajasdesalida();
        $result=$objcaja->mostrarcajadelcontador();
        
        $filac=mysqli_fetch_object($result);
            
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN CAJA DEL CONTADOR</td>";
          echo "<td style='text-align: right;'>$filac->cajacontador</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL DE MONTO ENTREGADO
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO EN TRANSITO  (Cargado al Procurador)</td>";
          echo "<td style='text-align: right;'>$totalentregado</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO SIN CONFIRMAR POR EL CONTADOR
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO DESCARGADO ELECTRONICAMENTE</td>";
          echo "<td style='text-align: right;'>$totalpresugastado</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO  CONFIRMADO SOLO POR EL CONTADOR(sin serrar, muestra el presupuesto)
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO DESCARGADO MATERIALMENTE</td>";
          echo "<td style='text-align: right;'>$totalpresugastadoconfir</td>";
         
          echo "</tr>";

          /////PARA EL TOTAL MONTO GASTADO confirmado POR EL CONTADOR es lo que gasto en la descarga
       /* CODIGO QUE LUEGO VEO PARA QUE SE UTILIZO
         echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO CONFIRMADO SOLO POR EL CONTADOR (DESCARGA)</td>";
          echo "<td style='text-align: right;'>$totalgastodescargaconfircont</td>";
         
          echo "</tr>";*/


          /////PARA EL TOTAL MONTO GASTADO CONFIRMADO POR EL CONTADOR
          echo "<tr>"; 
          echo "<td style='text-align: left;'>DINERO GASTADO CONFIRMADO POR EL CONTADOR (DINERO DE ORDENES SERRADAS)</td>";
          echo "<td style='text-align: right;'>$totalmontosinconfir</td>";
         
          echo "</tr>";


        $tododelcontador=$filac->cajacontador+$totalentregado+$totalpresugastado+($totalpresugastadoconfir);


         ?>

         <tr>
           <td >SUMA TOTAL</td>
          
           <?php
           echo "<td style='text-align: right;'>$tododelcontador</td>";

           /*NUEVO CODIGO PARA EL TOTAL DEL CONTADOR*/
           /*ESTA FUNCION DEVUELVE EL SALDO DE LAS DESCARGAS QUE NO TIENEN COSTO FINAL, Y POR LO TANTO PUEDEN AFECTAR A LA CAJA DEL CONTADOR , OSEA SI EL RESULTADO DE LA CONSULTA ES POSITIVO SE VUELVE NEGATIVO Y VICEVERSA, ESTO PARA NO AFECTAR A LA CAJA DEL CONTADOR*/
           $saldocuadrar=0;
           $objorden=new OrdenGeneral();
           $resultado1=$objorden->mostrarsaldosOrdenesNoserradas();
           $fila1=mysqli_fetch_object($resultado1);
          /*CONVERCION DEL SALDO */
          $saldocuadrar=$fila1->saldito*(-1);
           


           $nuevototalcontador=$tododelcontador+($saldocuadrar);
           ?>

         </tr>
       </tbody>
     </table>
      
    </div>
    <!--hasta aqui  PARA QUE CUADRE LA CAJA DEL ADMINISTRADOR, PERO NO SE MOSTRATA-->



<!--TABLA DE CAUSAS ACTIVAS-->
<div class="container" id="divtodasactivas">
 <h3  style=" color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAUSAS ACTIVAS</h3>
<table class="table table-bordered table-striped dt-responsive tablaactivas" style="width: 100%;">
              
     <thead>
          <tr style="background:#AEAEAE; color: white;">
          <th>ID</th>
          <th>CODIGO DE LA CAUSA</th>
          <th>NOMBRE DE LA CAUSA</th>
          <th>NOMBRE DEL CLIENTE</th>
          <th>SALDO</th>
          
       </tr>
    </thead>           
                
      <tbody>

        <?php
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConIdDescenenteYsaldo();
        $totalsaldocausasdescendid=0;
        while ($fila=mysqli_fetch_object($resul))
        {
            $totalsaldocausasdescendid=$totalsaldocausasdescendid+$fila->caja;

            if ($fila->estadocausa=='Terminada') 
            {
               
            } 
            else
            {
            echo "<tr style='background:#ECECEC ;'>"; 
            echo "<td>$fila->id</td>";
            echo "<td>$fila->codigo</td>";
            echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
            echo "<td style='text-align: left;'>$fila->cli</td>";
            echo "<td style='text-align: right;'>$fila->caja</td>";
            echo "</tr>";
            }

        }


         ?>

         <tfoot>
            <tr>
                <th colspan="4" style="text-align:center;background:#ECECEC ;">SALDO TOTAL</th>
                <th style="text-align: right;background:#ECECEC ;"><?php echo number_format($totalsaldocausasdescendid, 2, '.', ' '); ?></th>
            </tr>
        </tfoot>
                          
      </tbody>
</table>

</div>
<!--ESCRIP QUE INICIA LA DATATABLE-->
<script>
  
/******************INICIALIZACION DE LAS DATATABLES TABLAS***********************/
  $(".tablaactivas").dataTable(
    {
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
}
);
</script>
<!--FIN-----------------TABLA DE CAUSAS ACTIVAS-->









<!--TABLA DE CAUSAS CONGELADAS-->
<div class="container" id="divcongeladas">
   <h3  style=" color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAUSAS CONGELADAS</h3>
  <table class="table table-bordered table-striped dt-responsive tablacongeladas" style="width: 100%;">
    <thead>
       <tr style="background:#AEAEAE; color: white;">
         <th>ID</th>
         <th>CODIGO DE CAUSA</th>
         <th>NOMBRE DE LA CAUSA</th>
         <th>NOMBRE DEL CLIENTE</th>
         <th>SALDO</th>
       </tr>

    </thead>

    <tbody>

      <?php
         
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaCongeladasYsaldo();
        $totalsaldocausascongeladas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausascongeladas=$totalsaldocausascongeladas+$fila->caja;
          echo "<tr style=' background:#ECECEC ;'>"; 
          echo "<td>$fila->id</td>";
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: left;'>$fila->cli</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>
        <tfoot>
            <tr style=" background:#ECECEC ;">
                <th colspan="4" style="text-align:center;">SALDO TOTAL DE CAUSA CONGELADAS</th>
                <th style="text-align: right;"><?php echo number_format($totalsaldocausascongeladas, 2, '.', ' '); ?></th>
            </tr>
        </tfoot>
    </tbody>
  </table>
  
</div>

<script>
  
/******************INICIALIZACION DE LAS DATATABLES TABLAS***********************/
  $(".tablacongeladas").dataTable(
    {
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
}
);
</script>

<!--FIN-----------------TABLA DE CAUSAS congeladas-->









<!--TABLA DE CAUSAS CONGELADAS-->
<div class="container" id="divterminadas">

    <h3  style=" color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">CAUSAS TERMINADAS</h3>
  <table class="table table-bordered table-striped dt-responsive tablaterminadas" style="width: 100%;">
    <thead>
       <tr style="background:#AEAEAE; color: white;">
         <th>ID</th>
         <th>CODIGO DE CAUSA</th>
         <th>NOMBRE DE LA CAUSA</th>
         <th>NOMBRE DEL CLIENTE</th>
         <th>SALDO</th>
       </tr>

    </thead>

    <tbody>

       <?php
         
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaTerminadasYsaldo();
        $totalsaldocausasterminadas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausasterminadas=$totalsaldocausasterminadas+$fila->caja;
          echo "<tr style=' background:#ECECEC ;'>";
          echo "<td>$fila->id</td>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: left;'>$fila->cli</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tfoot>
            <tr style="background:#ECECEC ;">
                <th colspan="4" style="text-align:center;">SALDO TOTAL DE CAUSA TERMINADAS</th>
                <th style="text-align: right;"><?php echo number_format($totalsaldocausasterminadas, 2, '.', ' '); ?></th>
            </tr>
        </tfoot>
      
    </tbody>
  </table>

  
  
</div>

<script>
  
/******************INICIALIZACION DE LAS DATATABLES TABLAS***********************/
  $(".tablaterminadas").dataTable(
    {
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
}
);
</script>
<!--FIN-----------------TABLA DE CAUSAS terminadas-->






<script type="text/javascript">
    $('#divterminadas').hide();
      $('#divcongeladas').hide();

    function funcionllamarTodascausasActivas()
    {
      $('#divterminadas').hide();
      $('#divcongeladas').hide();
      $('#divtodasactivas').show();
     
    }

    function funcionllamarTodascausascongeladas()
    {
      $('#divtodasactivas').hide();
      $('#divterminadas').hide();
      $('#divcongeladas').show();
      
    }

    function funcionllamarTodascausasterminadas()
    {
      $('#divtodasactivas').hide();
      $('#divterminadas').show();
      $('#divcongeladas').hide();
    }
</script>






<br><br>
<!------------------------------TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE--------------------->

<div class="container">
<table id="customers">
  <thead>
    <tr>
      <th colspan="5">DEPOSITOS Y DEVOLUCIONES TOTALES CON EL CLIENTE POR CONCEPTO DE GASTOS JUDICIALES</th>
    </tr>

    <tr>
      <th>CODIGO DE LA CAUSA</th>
      <th>CLIENTE</th>
      <th>DEPOSITOS <br> (ingresos)</th>
      <th>DEVOLUCION <br> (egresos)</th>
      <th>SALDO <br> (para efectos del cálculo)</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $totaldepositosd=0;
    $totaldevolucion=0;
    $saldocausa_depo_devo=0;/*ES EL SALDO DE CAUSA(TOTAL DEPOSITOS MENOS TOTAL DEVOLUCIONES) DE UNA CAUSA*/
    $totaldepositosMenosDevolucion=0;/*DEPOSITOS MENOS DEVOLUCIONES DE TODAS LAS CAUSAS*/
    $totalsaldos=0;
    $objcausa=new Causa();
    $resultcausa=$objcausa->mostrarcodigocausaysaldoYcliente();
    while ($filcausa=mysqli_fetch_object($resultcausa)) 
    {
      echo "<tr>";
        echo "<td>$filcausa->codigo</td>";
        echo "<td style='text-align: left;'>$filcausa->nombcli</td>";
        
        //$objcausa1=new Causa();
        $resuldepos=$objcausa->totalDeDepositosDeCausa($filcausa->idcausa);
        $fildepos=mysqli_fetch_object($resuldepos);

        $resuldev=$objcausa->totalDevueltoAlCliente($filcausa->idcausa);
        $fildev=mysqli_fetch_object($resuldev);

        echo "<td style='text-align: right;'>$fildepos->totaldeposito</td>";
        $totaldepositosd=$totaldepositosd+$fildepos->totaldeposito;

        echo "<td style='text-align: right;'>$fildev->totaldevuelto</td>";
        $totaldevolucion=$totaldevolucion+$fildev->totaldevuelto;
        
        $saldocausa_depo_devo=$fildepos->totaldeposito-$fildev->totaldevuelto;
        echo "<td style='text-align: right;'>$saldocausa_depo_devo</td>";
        $totalsaldos=$totalsaldos+$filcausa->caja;
      echo "</tr>";
    }

    ?>
    <tr>
      <td colspan="2">TOTALES</td>
      <td style='text-align: right;'><?php echo $totaldepositosd; ?></td>
      <td style='text-align: right;'><?php echo $totaldevolucion; ?></td>
      <?php
      $totaldepositosMenosDevolucion=$totaldepositosd-$totaldevolucion
      ?>
      <td style='text-align: right;'><?php echo $totaldepositosMenosDevolucion; ?></td>
    </tr>
    
  </tbody>
</table>
</div>
<br><br><br>
<!--FIN DE TABLA DEPOSITOS Y DEVOLUCIONESCON EL CLIENTE-->

</body>
</html>





 <!-- The Modal (FORMULARIO) transferencia de una causa a otra -->
<div id="myModalformtrans" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosetrans">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >TRANSFERENCIA DE UNA CAUSA A OTRA</p></center>
     </div>
    <form method="post" onsubmit="return validarFormTranferenciaCausa(this);" id="frmtrans">
    <div class="modal-body">
    <div style="font-size: 12px;">
      <label><b>Elija la causa origen y causa destino</b></label><br>
      <label><b>Nota 1: En el listado de causas origen, solo apareceran las causas que tienen saldo y esten activas</b></label><br>
      <label><b>Nota 2: En el listado de causas destino, solo apareceran las causas que que esten activas</b></label><br>
       <label><b>Nota 3: Solo se hara la tranferencia entre causas del mismo cliente</b></label><br>
   </div> 
       <label>Origen>></label>
         <select name="selectcausaorigen" style="height: 30px;">
         <option value="0">Elija Causa Origen</option>
              <?php 
                $objcau=new Causa();
                $listcau=$objcau->mostrarCausaOrigen();
                while($cau=mysqli_fetch_array($listcau)){
                                                              
                    echo '<option value="'.$cau['id_causa'].'">'.$cau['codigo'].'</option>';
                 }
              ?> 
                                                           
         </select> 
     <label>Destino>></label>
                                                      
        <select name="selectdestino"  style="height: 30px;">
           <option value="0">Elija Causa Destino</option>
              <?php
                $objedast=new Causa();
                $listdest=$objedast->mostrarCodigoDeCausasActivas();
                while ($dest=mysqli_fetch_array($listdest)) {
                   echo '<option value="'.$dest['id_causa'].'">'.$dest['codigo'].'</option>';
                }

               ?>
                                                         
        </select><br>
   <label><b> Monto De La Transferencia</b></label><br>
       <input type="number" class="textform" id="textmontotransferencia" name="textmontotransferencia" placeholder="Monto De tranferecia"  required>

                                                        

    
      
                                                        

    </div>
    <div class="modal-footer" style="height: 80px;">
   <input style="background: #1A5895;width: 180px; float: left; height: 40px;" type="button" class="btnclose" id="btntransferencia" name="btntransferencia" value="Transferir">
   
    <img src="cargando.gif" id="imgcarga" style="width: 50px;height: 50px; float: left;">
    
    <button class="btnclose" type="button" id="btncloseformtrans" style="float: right;height: 40px;">Cancelar</button>
      </form>

    </div>
  </div>


  <!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA HACER TRANFERENCIAS ENTRE CAUSAS-->
<script>
// Get the modal
var modalformtrans = document.getElementById("myModalformtrans");

// Get the button that opens the modal
var btndetrans = document.getElementById("myBtnformtrans");
var btncloseformtrans = document.getElementById("btncloseformtrans");

// Get the <span> element that closes the modal
var spanclosetrans = document.getElementById("spanclosetrans");

// When the user clicks the button, open the modal 
btndetrans.onclick = function() {
  modalformtrans.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclosetrans.onclick = function() {
  modalformtrans.style.display = "none";
}
btncloseformtrans.onclick=function() {
  modalformtrans.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>

<script type="text/javascript">
function validarFormTranferenciaCausa(formulariotrans) {

   if(formulariotrans.textmontotransferencia.value <=0) { //comprueba que no esté vacío
    formulariotrans.textmontotransferencia.focus();   
    alert('No Puede Colocar Numeros Negativos o Cero'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>











<script type="text/javascript">
  $('#imgcarga').hide();
  $(document).ready(function(){
    $('#btntransferencia').click(function(){
       var datos=$('#frmtrans').serialize();
       
       $('#btntransferencia').hide();
       $('#imgcarga').show();
       if ($('#textmontotransferencia').val()>0) 
       {
           $.ajax({
            type:"post",
            url:"controller/control-TranferenciaCausasAjax.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) 
              {
                setTimeout(function(){ location.href='saldos_causas.php' }, 500); swal('EXELENTE','Se Hizo la Transferencia','success');
              }
              if(respuesta==2)
              {
                setTimeout(function(){  }, 2000); swal('ERROR','Causa Origen Tiene Que ser Diferente a Causa Destino','warning');
                $('#btntransferencia').show();
                 $('#imgcarga').hide();
              }
              if (respuesta==3) 
              {
                 setTimeout(function(){  }, 2000); swal('ERROR','No Se Deposito','warning');
                 $('#btntransferencia').show();
                 $('#imgcarga').hide();
              }
              if (respuesta==4) 
              {
                setTimeout(function(){  }, 2000); swal('ERROR','La caja de causa origen es menor al monto de transferencia','warning');
                $('#btntransferencia').show();
                $('#imgcarga').hide();
              }
              if (respuesta==5) 
              {
                setTimeout(function(){  }, 2000); swal('ERROR','Solo se puede transferir entre causas del mismo cliente','warning');
                $('#btntransferencia').show();
                $('#imgcarga').hide();
              }
              if (respuesta==6) 
              {
                setTimeout(function(){  }, 2000); swal('ERROR','Debe seleccionar causa origen y causa Destino','warning');
                $('#btntransferencia').show();
                $('#imgcarga').hide();
              }
             // $('#textpiso').val('');
            }
          });
           return false;

        }
        else
        {
          setTimeout(function(){  }, 2000); swal('ERROR','debe llenar los campos','warning');
          $('#btntransferencia').show();
          $('#imgcarga').hide();
        }
    });
  });
</script>     
 
