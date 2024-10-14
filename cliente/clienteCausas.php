<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["cliente"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["cliente"];
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030"> 
	<title>Causas del cliente</title>
  <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
	<link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
        <link rel="stylesheet" type="text/css" href="../resources/tabla.css">

    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php

include_once('../model/clscausa.php'); 
include_once('../model/clstribunal.php');
include_once('../model/clsdeposito.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clscostofinal.php');
include_once('../model/clscotizacion.php');
include_once('../model/clsdevoluciondinero.php');
?>
<!-- MENU 1 -->
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
        
        <div id="main_menu_admin">
        
            <ul>
                <li class="first_listleftadm"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 
               
                
               

                

                <li class="" style="float: left; margin: 0 14px; width: 1000px;"><a >USUARIO:<?php echo $datos['nombrecli']; ?>  TIPO:Cliente</a></li> 
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div>
    <div id="main_content">
      <div id="portfolio_area">
        
      </div>
    </div> <!-- FIN header -->
    <br>
 
   
    <!-- inicio del container table -->
     <div class="container">
   <section>
    <h3 style="color: #000000;font-size: 25px;text-align: center;">MIS CAUSAS</h3>
    <br>
    <label>Estas son todas sus causas. Si usted desea ingresar a alguna de ellas, seleccione el código de la causa que quiere ver.</label><br><br>
       <table id="customers" >
 <thead>     
  <tr>
    <th  width="16%">CODIGO</th>
    <th >NOMBRE DEL PROCESO</th>
    <th width="21%">ABOGADO</th>
    <th width="21%">PROCURADOR<br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="8%">SALDO TOTAL en Bs.</th>
  </tr>
</thead>
<tbody>
  
 <?php
 $idCliente=$datos['id_cliente'];
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasActivasDeunCliente($idCliente);
   while ($fil=mysqli_fetch_object($resul)) 
   {  
       $colorcausa='';
      if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
       //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
       $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
             echo "<td class='tdcod'><a style='color:$colorcausa' href='clienteFicha.php?squart=$encriptado' onclick=funcionirfichaCli($fil->id_causa)>$fil->codigo</a></td>";
             echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";

//<!--DESDE AQUI ELCODIGO PARA MOSTAR LA CAJA DE LA CAUSA, (LA MISMA QUE SE MUESTRA EN AVANCE FINANCIERO)-->
         $objcausagastos=new Causa();
         $resulgastosSinCOnfir=$objcausagastos->SumadorDeGastoProcesalesDeCausaSinconfirmarPorAdmin($fil->id_causa);
         $filsinconfir=mysqli_fetch_object($resulgastosSinCOnfir);
         $cajaCausasMascara=$fil->caja+$filsinconfir->CostoproceSInConfirmar;
             
        echo "<td>$cajaCausasMascara</td>";
     echo "</tr>";
    }
  ?>

</tbody>
</table>
</section>
</div>
 <!-- fin del container table -->
<script type="text/javascript">
      /*  function  fyuncionirficha()
        {
            location.href='index.php';
        }*/
    </script>

   <script type="text/javascript">
  
 // $(funcionirfichaCli());

 // function funcionirfichaCli(idped)
 //{
 // $.ajax({
 //   url : 'clienteFicha.php',
  //  type : 'POST',
  //  dataType : 'html',
   // data : { idped: idped },
  //  })
  //location.href='ficha.php';
  //.done(function(resultadoproduct){
  //  $("#tabladetallepedido").html(resultadoproduct);
 // })
 // $('#textidped').val(idped);
 // location.href='clienteFicha.php.php';
//}

</script>
<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>