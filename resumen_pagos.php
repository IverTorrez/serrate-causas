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
    <title>Resumen De Pagos Proc.</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
    
     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    <script type="text/javascript" src="resources/jquery.min.js"></script>
 <!--INCLUIMOS LOS PLUGINS DE DATA TABLES-->
      <!-- ESTE SCRIP DE JQUYERY ES EL QUE HACE FUNCIONAR AL DATA TABLES -->
    <script src="js/jquery.js"></script>
 <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"> </script>


<link rel="stylesheet" href="PluginTable/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="PluginTable/datatables.net-bs/css/responsive.bootstrap.min.css">


<script src="PluginTable/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="PluginTable/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="PluginTable/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="PluginTable/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
</head>
<body>
<?php
include_once('model/clspiso.php');
include_once('model/clsprocurador.php');
include_once('model/clspagoprocurador.php');
include_once('controller/control-piso.php');


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
      
           <!-- <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones">VOLVER A LA FICHA</button></li>
                    <li><button class="botones">LISTA DE ORDENES</button></li>
                    <li><button class="botones">ACTUALIZAR TRIBUNALES</button></li>
                </ul>
                <br>
                <br>
            </div>--> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

<br>
<br>


<div class="container">
  <h2 style="color: #000000;font-size: 23px; text-shadow: -2px -2px 5px #333; margin-left: 20px;">C- PAGO A PROCURADORES. –</h2>
</div>
<br><br>

<div class="container">
  <h2 style="color: #000000;font-size: 20px; text-shadow: -2px -2px 5px #333; margin-left: 20px;">SUMA ACUMULADA PARA PAGAR A LOS PROCURADORES</h2>
  
   <section>
 <table id="tablapiso" class="tablapiso" >

 <thead>     
  <tr>
    <th style="background: #AEAEAE;">NOMBRE DEL PROCURADOR</th>
    <th style="background: #AEAEAE;">POSITIVO <br>(ganacias)</th> 
    <th style="background: #AEAEAE;">NEGATIVO <br>(penalidad)</th>
    <th width="10%" style="background: #AEAEAE;">TOTAL POR PAGAR</th>
  </tr>
</thead>
<tbody>
  <?php
   
   $pagodelproc=0;
   $sumapositivos=0;
   $sumapenalidad=0;
   $totalporpagar=0;
   $objpagoacumulado=new PagoProcurador();
   $resulpagoacu=$objpagoacumulado->consultaParaPagarATodosProcuradores();
   while ($filacum=mysqli_fetch_object($resulpagoacu)) 
         {
             $pagodelproc=$filacum->compraprocu+($filacum->penalidadproc);
             $sumapositivos=$sumapositivos+$filacum->compraprocu;
             $sumapenalidad=$sumapenalidad+($filacum->penalidadproc);
       echo "<tr style='background: #ECECEC;'>";
              echo "<td style='text-align: left;'>$filacum->procu</td>";        
              echo "<td style='text-align: right;'>$filacum->compraprocu</td>";
              echo "<td style='text-align: right;'>$filacum->penalidadproc</td>";

              echo "<td style='text-align: right;'>$pagodelproc</td>";
        echo "</tr>";
          }
  ?>
  <tr style="background: #ECECEC;">
     <td >ACUMULADO POR PAGAR A LOS PROCURADORES</td>
    <?php
      $totalporpagar=$sumapositivos+($sumapenalidad);
      echo "<td style='text-align: right;'><b>$sumapositivos</b></td>";
      echo "<td style='text-align: right;'><b>$sumapenalidad</b></td>";
      echo "<td style='text-align: right; font-size: 25px;'><b>$totalporpagar</b></td>";
    ?>
  </tr>
</tbody>
</table>
</section>
</div>
    <br>
    <br>




<div class="container">
  <h2 style="color: #000000;font-size: 20px; text-shadow: -2px -2px 5px #333; margin-left: 200px;">PAGO A PROCURADORES</h2>
  
   <section style="width: 70%;">
 <table  class="table table-bordered table-striped dt-responsive tablapagos" >

 <thead>     
  <tr>
    <th>COD PAGO</th>
    <th>FECHA</th> 
    <th>NOMBRE DEL PROCURADOR</th>
    <th>MONTO</th>
  </tr>
</thead>
<tbody>
  <?php
    $totalpagado=0;
   $objpago=new PagoProcurador();
   $resulpago=$objpago->mostrarTodosLosPagos();
   while ($filpago=mysqli_fetch_object($resulpago)) {
             $totalpagado=$totalpagado+$filpago->pagoproc;
       echo "<tr>";
               echo "<td><a href='impresiones/tcpdf/pdf/pago_procurador.php?pago=$filpago->id_pago' target='_blank'> $filpago->id_pago</a></td>";
              echo "<td>$filpago->fechapago</td>";        
              echo "<td style='text-align: left;'>$filpago->procu</td>";
              echo "<td style='text-align: right;'>$filpago->pagoproc</td>";
        echo "</tr>";
          }
  ?>
  <!--<tr>-->
  <!--   <td colspan="2">TOTAL PAGADO</td>-->
    <?php
    //   echo "<td style='text-align: right; font-size: 25px;'><b> $totalpagado</b></td>";
    ?>
  <!--</tr>-->
  
  <tfoot>
      <tr>
        <th colspan="2" style="text-align:center;">Total Pagado</th>
        <th style="text-align: right;"></th>
      </tr>
    </tfoot>
</tbody>
</table>
</section>
</div>
    <br>
    <br>
    <br>


    <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidpiso').val(idd);
    var modal = document.getElementById("myModal");
    var btnclose = document.getElementById("btncloseformpres");
    var span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    btnclose.onclick=function() {
      modal.style.display = "none";
    }
  }
</script>
   


         <!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un tribunal o juzgado -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR PISO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este piso ??</b></label><br><br>
        <input type="hidden" class="textform" id="textidpiso" name="textidpiso" placeholder="id piso" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarpiso" name="btneliminarpiso" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<!--<script type="text/javascript" src="resources/jquery.js"></script>-->
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btngajax').click(function(){
       var datos=$('#frmpiso').serialize();
       
       if ($('#textpiso').val()!='') 
       {
           $.ajax({
            type:"post",
            url:"controller/control-regpisoajax.php",
            data:datos,
            success:function(respuesta){
              if (respuesta==1) {
                setTimeout(function(){ location.href='piso.php' }, 500); swal('EXELENTE','Se Creo El Piso Con Exito','success');
              }
              else{
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo El Piso','warning');
              }
              $('#textpiso').val('');
            }
          });
           return false;

        }
        else{
          setTimeout(function(){  }, 2000); swal('ERROR','debe llenar los campos','warning');
        }
    });
  });
</script> 











<script>
/******************INICIALIZACION DE LAS DATATABLES TABLAS***********************/
  $(document).ready(function() {
    $('.tablapagos').DataTable( {
        
        "footerCallback": 
        function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
              // ESTE CODIGO EN COMENTARIO MUESTRA EL TOTAL FILTRADO Y EL TOTAL GENERAL
                // 'Bs.'+pageTotal +' ( Bs.'+ total +' Total Pagado)'
                ' '+pageTotal 
            );
        },
// desde aqui traducimos un datatable
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
/*hasta aqui para traducir un datatable*/
    } );



} );


 
</script>
