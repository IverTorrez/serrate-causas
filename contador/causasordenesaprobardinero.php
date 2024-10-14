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
    <title>Pronunciadas Contador</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');
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
               
                
                <li class="first_list"><a href="contador_mis_causa.php" class="main_menu_first main_current">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
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
                    <li><button class="botones" style=" height: 45px; box-shadow: inset 0px 19px 8px #6FD37E;">ORDENES GIRADAS</button></li>
                    <li><button class="botones" style=" height: 45px; box-shadow: inset 0px 19px 8px #6FD37E;">PRESUPUESTADAS</button></li>
                    <li><button class="botones" style=" height: 45px; box-shadow: inset 0px 19px 8px #6FD37E;">ACEPTADAS</button></li>
                    <li><button class="botones" style=" height: 45px; box-shadow: inset 0px 19px 8px #6FD37E;">DINERO ENTREGADO</button></li>
                    <li><button class="botones" style="width: 170px; height: 45px; ">  LISTAS PARA REALIZAR</button></li>
                    <li><button class="botones" onclick="location.href='causasordenesdescargas.php'" style=" height: 45px; box-shadow: inset 0px 19px 8px #00FFE8;">DESCARGADAS</button></li>
                    <li><button class="botones" style=" height: 45px; box-shadow: inset 0px 19px 8px #00FFE8;">PRONUNCIAMIENTO DEL ABOGADO</button></li>
                    <li><button class="botones" style="width: 170px; height: 45px; box-shadow: inset 0px 19px 8px #00FFE8;">CUENTAS CONCILIADAS</button></li>
                    
                </ul><br>
                 <ul>
                 
                    <li><button class="botones" style="width: 170px; height: 45px;background: #A9CFCB;">VENCIDAS</button></li>
                    <li><button class="botones" style="width: 250px; height: 45px;background: #A9CFCB;">VENCIDAS DEL ABOGADO</button></li>
                   
                    
                </ul>
                
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CAUSAS CON ORDENES DESCARGADAS <br>(APROBAR O RECHAZAR EL DINERO)</h3>
    <br>
   <section class="responsive">
    
       <table id="tablacausaabogado">
 <thead> 
 
  <tr>
    <th width="130px">CODIGO</th>
    <th width="300px">NOMBRE DEL PROCESO</th>
    
    <th width="250px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="250px">CLIENTE</th>

    <th width="350px">OBSERVACIONES</th> 
   
  </tr>
</thead>
<tbody>
 <?php
 
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasordenespronunciadasabog();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='ordenesdescargadaspc.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a></td>";
              echo "<td>$fil->nombrecausa</td>";
              //echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
             
              echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
        echo "</tr>";
          }
  ?>
 
</tbody>
</table>
</section>
    </div>
<script type="text/javascript">
        function  fyuncionirficha()
        {
            location.href='index.php';
        }
    </script>


 <script type="text/javascript">
  
  $(funcionirficha());

  function funcionirficha(idped)
 {
  $.ajax({
    url : 'ficha.php',
    type : 'POST',
    dataType : 'html',
    data : { idped: idped },
    })
  //location.href='ficha.php';
  //.done(function(resultadoproduct){
  //  $("#tabladetallepedido").html(resultadoproduct);
 // })
 // $('#textidped').val(idped);
  location.href='ficha.php';
}

</script>
    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
