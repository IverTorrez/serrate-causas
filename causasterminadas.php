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
    <title>Causas Terminadas</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('model/clscausa.php');
include_once('model/clsabogado.php');
include_once('model/clsprocurador.php'); 
include_once('model/clscliente.php');
include_once('model/clscategoria.php'); 
include_once('model/clspiso.php');
include_once('model/clstipolegal.php');

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
     
              
            </div>
         </div>
   </div>
    
    

    <!--TABLA CAUSAS ACTIVAS-->
    

 <div class="container">
 <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CAUSAS TERMINADAS</h3>
   <section class="responsive">
   
    <br>
       <table id="tablacausasactivas">
 <thead>

  <tr>
  <!--SELECTOR PARA ELEJIR CAUSAS-->
  <form method="post">
   <td><select id="selectcausas" name="selectcodcausa" onchange="this.form.submit()">
          <option>FILTRAR POR CODIGO </option>       
          <?php
          $objtplegal=new TipoLegal();
          $listatplegal=$objtplegal->listarLosTiposLegalConSuMateria();
          while($tpl=mysqli_fetch_array($listatplegal)){
                
                 echo '<option value="'.$tpl['id_tipolegal'].'">'.$tpl['Codigo'].'</option>';
               }

          ?>
        </select></td>
  </form>

   
    <td></td>


  <!--SELECTOR PARA ELEJIR CAUSAS segun el abogado-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodabogado"  onchange="this.form.submit()"> 
               <option>FILTRAR POR ABOGADO</option>
               <?php
              $obabog=new Abogado();
              $listaabog=$obabog->listarAbogadosActivos();
              while($abog=mysqli_fetch_array($listaabog)){
                
                 echo '<option value="'.$abog['id_abogado'].'">'.$abog['apellidoabog'].', '.$abog['nombreabog'].'</option>';
               }

          ?>
        </select></td>
    </form>

   <!--SELECTOR PARA ELEJIR CAUSAS segun el PROCURADOR-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodprocurador" onchange="this.form.submit()"> 
           <option>FILTRAR POR PROCURADOR</option>
             <?php
              $obproc=new Procurador();
              $listaproc=$obproc->listarProcuradorActivos();
              while($proc=mysqli_fetch_array($listaproc)){
                
                 echo '<option value="'.$proc['id_procurador'].'">'.$proc['apellidoproc'].', '.$proc['nombreproc'].'</option>';
               }

             ?>
        </select></td>
    </form>

    <!--SELECTOR PARA ELEJIR CAUSAS segun el CLIENTE-->
   <form method="post">
    <td><select id="selectcausas" name="selectcodcliente"  onchange="this.form.submit()"> 
               <option>FILTRAR POR CLIENTE</option>
               <?php
              $obcli=new Cliente();
              $listarcli=$obcli->listarClienteActivos();
              while($cli=mysqli_fetch_array($listarcli)){
                
                 echo '<option value="'.$cli['id_cliente'].'">'.$cli['apellidocli'].', '.$cli['nombrecli'].'</option>';
               }

             ?>
        </select></td>
    </form>

   <!--SELECTOR PARA ELEJIR CAUSAS SEGUN LA CATEGORIA-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodcateg"  onchange="this.form.submit()"> 
               <option>FILTRAR POR CATEGORIA</option>
               <?php
              $obcat=new Categoria();
              $listarcat=$obcat->listarCategoriasActivas();
              while($cat=mysqli_fetch_array($listarcat)){
                
                 echo '<option value="'.$cat['id_categoria'].'">'.$cat['nombrecat'].'- '.$cat['abreviaturacat'].'</option>';
               }

             ?>
        </select></td>
    </form>

  <!--SELECTOR PARA ELEJIR CAUSAS SEGUN EL PISO DEL TRIBUNAL-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodpiso"  onchange="this.form.submit()"> 
               <option>FILTRAR POR PISO</option>
               <?php
              $obpiso=new Piso();
              $listarpiso=$obpiso->listarpisos();
              while($pis=mysqli_fetch_array($listarpiso)){
                
                 echo '<option value="'.$pis['id_piso'].'">'.$pis['nombrepiso'].'</option>';
               }

             ?>
        </select></td>
    </form>
 </tr>      
  <tr>
    <th width="130px">CODIGO</th>
    <th width="300px">NOMBRE DEL PROCESO</th>
    <th width="240px">ABOGADO</th>
    <th width="240px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="240px">CLIENTE</th>
    <th width="100px">CATEGORIA</th>
    <th width="380px">OBSERVACIONES</th>
  </tr>
</thead>
<tbody>
 <?php
 if (!isset($_POST['selectcodcausa']) and !isset($_POST['selectcodabogado']) and !isset($_POST['selectcodprocurador']) and !isset($_POST['selectcodcliente']) and !isset($_POST['selectcodcateg']) and !isset($_POST['selectcodpiso'])) 
 {
   
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasTerminadas();
   while ($fil=mysqli_fetch_object($resul)) {
       echo "<tr>";
               //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a></td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
              echo "<td>$fil->Categ</td>";
              echo "<td style='text-align: justify;'>$fil->Observ</td>";
        echo "<tr>";
          }

 }





   if (isset($_POST['selectcodcausa']))/*pregunta si se selecciono alguna causa*/ 
  {
    $idtipolegal=$_POST['selectcodcausa'];
    $objcausa1=new Causa();
    $resultcausa1=$objcausa1->listarCausaterminadasDeUnTipoLegal($idtipolegal);
     while ($fil1=mysqli_fetch_object($resultcausa1)) {
       echo "<tr>";
              //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil1->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil1->id_causa)>$fil1->codigo</a></td>";
              echo "<td>$fil1->nombrecausa</td>";
              echo "<td>$fil1->abogadogestor</td>";
              echo "<td>$fil1->procuradorasig</td>";
              echo "<td>$fil1->clienteasig</td>";
              echo "<td>$fil1->Categ</td>";
              echo "<td style='text-align: justify;'>$fil1->Observ</td>";
        echo "</tr>";
          }
  }


  if (isset($_POST['selectcodabogado']))/*pregunta si se selecciono algun abogado*/ 
  {
    $idabog=$_POST['selectcodabogado'];
    $objcausa1=new Causa();
    $resultcausa1=$objcausa1->listarcausasTerminadasdeabogado($idabog);
     while ($fil1=mysqli_fetch_object($resultcausa1)) {
       echo "<tr>";
              //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil1->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil1->id_causa)>$fil1->codigo</a></td>";
              echo "<td>$fil1->nombrecausa</td>";
              echo "<td>$fil1->abogadogestor</td>";
              echo "<td>$fil1->procuradorasig</td>";
              echo "<td>$fil1->clienteasig</td>";
              echo "<td>$fil1->Categ</td>";
              echo "<td style='text-align: justify;'>$fil1->Observ</td>";
        echo "</tr>";
          }
  }


  if (isset($_POST['selectcodprocurador']))/*pregunta si se selecciono algun procurador*/ 
  {
    $idproc=$_POST['selectcodprocurador'];
    $objcausa1=new Causa();
    $resultcausa1=$objcausa1->listarcausasTerminadasdeprocurador($idproc);
     while ($fil1=mysqli_fetch_object($resultcausa1)) {
       echo "<tr>";
              //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil1->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil1->id_causa)>$fil1->codigo</a></td>";
              echo "<td>$fil1->nombrecausa</td>";
              echo "<td>$fil1->abogadogestor</td>";
              echo "<td>$fil1->procuradorasig</td>";
              echo "<td>$fil1->clienteasig</td>";
              echo "<td>$fil1->Categ</td>";
              echo "<td style='text-align: justify;'>$fil1->Observ</td>";
        echo "</tr>";
          }
  }


  if (isset($_POST['selectcodcliente']))/*pregunta si se selecciono algun cliente*/ 
  {
    $idcli=$_POST['selectcodcliente'];
    $objcausa1=new Causa();
    $resultcausa1=$objcausa1->listarcausasTerminadasdecliente($idcli);
     while ($fil1=mysqli_fetch_object($resultcausa1)) {
       echo "<tr>";
              //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil1->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil1->id_causa)>$fil1->codigo</a></td>";
              echo "<td>$fil1->nombrecausa</td>";
              echo "<td>$fil1->abogadogestor</td>";
              echo "<td>$fil1->procuradorasig</td>";
              echo "<td>$fil1->clienteasig</td>";
              echo "<td>$fil1->Categ</td>";
              echo "<td style='text-align: justify;'>$fil1->Observ</td>";
        echo "</tr>";
          }
  }


  if (isset($_POST['selectcodcateg']))/*pregunta si se selecciono alguna categoria*/ 
  {
    $idcat=$_POST['selectcodcateg'];
    $objcausa1=new Causa();
    $resultcausa1=$objcausa1->listarcausasTerminadasdeCategoria($idcat);
     while ($fil1=mysqli_fetch_object($resultcausa1)) {
       echo "<tr>";
              //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
             $mascara=$fil1->id_causa*1234567;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil1->id_causa)>$fil1->codigo</a></td>";
              echo "<td>$fil1->nombrecausa</td>";
              echo "<td>$fil1->abogadogestor</td>";
              echo "<td>$fil1->procuradorasig</td>";
              echo "<td>$fil1->clienteasig</td>";
              echo "<td>$fil1->Categ</td>";
              echo "<td style='text-align: justify;'>$fil1->Observ</td>";
        echo "</tr>";
          }
  }



  /*PREGUNTA SI SE SELECCIONO ALGUN PISO*/
if (isset($_POST['selectcodpiso'])) 
{
  $idpiso=$_POST['selectcodpiso'];
  $objcausap=new Causa();
   $resulpiso=$objcausap->listarCausasActivasPorPisoTerminadas($idpiso);
   while ($fil=mysqli_fetch_object($resulpiso)) {
      echo "<tr>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->idcausa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a href='reiniciarcausa.php?squart=$encriptado' onclick=funcionirficha($fil->idcausa)>$fil->codigo</a></td>";

       
      
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun  piso*/
  ?>
 
</tbody>
</table>
</section>
    </div>


<script type="text/javascript">
      /*  function  fyuncionirficha()
        {
            location.href='index.php';
        }*/
    </script>


 <script type="text/javascript">
  
 // $(funcionirficha());

 // function funcionirficha(idped)
// {
//  $.ajax({
 //   url : 'ficha.php',
 //   type : 'POST',
 //   dataType : 'html',
 //   data : { idped: idped },
    })
  //location.href='ficha.php';
  //.done(function(resultadoproduct){
  //  $("#tabladetallepedido").html(resultadoproduct);
 // })
 // $('#textidped').val(idped);
//  location.href='ficha.php';
//}

</script>
    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>