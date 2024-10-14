<?php
// error_reporting(E_ERROR);
// session_start();
// if(!isset($_SESSION["useradmin"]))
// {
//   header("location:index.php");
// }
// $datos=$_SESSION["useradmin"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');


include_once('model/clstipousuario.php');
include_once('model/clsusuario.php');
include_once('model/clsabogado.php');
include_once('model/clscliente.php');
include_once('model/clscontador.php');
include_once('model/clsprocurador.php');
 
//include_once('controller/control-usuarios.php');
///incluimos el archivo donde esta el modal para guardar la ubicacion
// include_once('modal/modal_ubicacion.php');

$tituloform='<h3  class="titulo">CREACIÓN DE NUEVO USUARIO</h3>';/*TITULO POR DEFECTO*/
$coduser=$_GET['squart'];
$decodificado=base64_decode($coduser);
$codigonuevouser=$decodificado/1234567;

$tipouser=$_GET['type'];
$decodificadotipo=base64_decode($tipouser);
$codigonuevotipo=$decodificadotipo/1234567;

$variableenabled="enabled";/*VARIABLE QUE EMPIEZA ABILITANDO EL SELECT*/
$valorchequed=null;

$fotodeusuario='';
switch ($codigonuevotipo) {
  case 1:/*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA USUARIO*/
    $objclsusu=new Usuario();
    $resulusu=$objclsusu->mostrarunUsuario($codigonuevouser);
    $filusu=mysqli_fetch_object($resulusu);

    $idusuario=$filusu->id_usuario;
    $nombusu=$filusu->nombreusuario;
    $apellusu=$filusu->apellidosusuario;
    $aliasusu=$filusu->nombrelogusu;
    $claveusua=$filusu->claveusu;
    $direcusu=$filusu->direccion;
    $telusu=$filusu->telefonousu;
    $emailusu=$filusu->correousuario;
    $coordenusu=$filusu->coordenadas;
    $observusu=$filusu->observaciones;
    $estadousu=$filusu->estadousu;
     
    $fotodeusuario=$filusu->fotousu;

    $tipousuariocls=$filusu->tipousuario;

    if ($tipousuariocls=='Administrador') {
      $tituloform='ADMINISTRADOR';
    }
    else
    {
      $tituloform='OBSERVADOR';
    }

    if ($estadousu=='Inactivo') {
      $valorchequed='checked=""';
    }

    $variableenabled="disabled";
    break;/*fin SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA usuario*/

    case 2:/*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA ABOGADO*/
    $objabog=new Abogado();
    $resulabog=$objabog->mostrarunAbogado($codigonuevouser);
    $filabog=mysqli_fetch_object($resulabog);

    $idusuario=$filabog->id_abogado;
    $nombusu=$filabog->nombreabog;
    $apellusu=$filabog->apellidoabog;
    $aliasusu=$filabog->nombrelogabog;
    $claveusua=$filabog->claveabog;
    $direcusu=$filabog->direccionabog;
    $telusu=$filabog->telefonoabog;
    $emailusu=$filabog->correoabog;
    $coordenusu=$filabog->coordenadasabog;
    $observusu=$filabog->observacionesabog;
    $estadousu=$filabog->estadoabog; 
    
    $fotodeusuario=$filabog->fotoabog;
    $tituloform='ABOGADO';
    $variableenabled="disabled";/*desabilita el select*/

    if ($estadousu=='Inactivo') {
      $valorchequed='checked=""';
    }
    break;/* FIN SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA ABOGADO*/

    case 3:/*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA contador*/
    $objcont=new Contador();
    $resulcont=$objcont->mostrarunContador($codigonuevouser);
    $filacont=mysqli_fetch_object($resulcont);

    $idusuario=$filacont->id_contador;
    $nombusu=$filacont->nombrecont;
    $apellusu=$filacont->apellidocont;
    $aliasusu=$filacont->nombrelogcont;
    $claveusua=$filacont->clavecont;
    $direcusu=$filacont->direccioncont;
    $telusu=$filacont->telefonocont;
    $emailusu=$filacont->correocont;
    $coordenusu=$filacont->coordenadascont;
    $observusu=$filacont->observacionescont;
    $estadousu=$filacont->estadocont;
    
    $fotodeusuario=$filacont->fotocont;
    $tituloform='CONTADOR';

    $variableenabled="disabled";/*desabilita el select*/

    if ($estadousu=='Inactivo') {
      $valorchequed='checked=""';
    }   
    break;/* FIN SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA contador*/

    case 4:/*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA procurador*/
    $objproc=new Procurador();
    $resulproc=$objproc->mostrarunProcurador1($codigonuevouser);
    $filaproc=mysqli_fetch_object($resulproc);

    $idusuario=$filaproc->id_procurador;
    $nombusu=$filaproc->nombreproc;
    $apellusu=$filaproc->apellidoproc;
    $aliasusu=$filaproc->nombrelogproc;
    $claveusua=$filaproc->claveproc;
    $direcusu=$filaproc->direccionproc;
    $telusu=$filaproc->telefonoproc;
    $emailusu=$filaproc->correoproc;
    $coordenusu=$filaproc->coordenadasproc;
    $observusu=$filaproc->observacionesproc;
    $estadousu=$filaproc->estadoproc; 
   
    $fotodeusuario=$filaproc->fotoproc; 
    $tipoproc=$filaproc->tipoproc;
    if ($tipoproc=='Procurador') {
       $tituloform='PROCURADOR';
     }
     else
     {
      $tituloform='PROCURADOR MAESTRO';
     }

    $variableenabled="disabled";/*desabilita el select*/

    if ($estadousu=='Inactivo') {
      $valorchequed='checked=""';
    }

    break;/* FIN SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA procurador*/

    case 5:/*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA cliente*/
    $objcli=new Cliente();
    $resulcli=$objcli->mostrarunCliente($codigonuevouser);
    $filacli=mysqli_fetch_object($resulcli);

    $idusuario=$filacli->id_cliente;
    $nombusu=$filacli->nombrecli;
    $apellusu=$filacli->apellidocli;
    $aliasusu=$filacli->nombrelogcli;
    $claveusua=$filacli->clavecli;
    $direcusu=$filacli->direccioncli;
    $telusu=$filacli->telefonocli;
    $emailusu=$filacli->correocli;
    $coordenusu=$filacli->coordenadascli;
    $observusu=$filacli->observacionescli;
    $estadousu=$filacli->estadocli;

    $fotodeusuario=$filacli->fotocli;

    $tituloform='CLIENTE';

    $variableenabled="disabled";/*desabilita el select*/

    if ($estadousu=='Inactivo') 
    {
      $valorchequed='checked=""';
    }

    break;/* FIN SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA cliente*/
  
 
}/*FIN DEL SWITCH*/


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
         
      
      


    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

                 <?php
                   /*CONTADORES DE ORDENES VENCIDADAS LEVES Y GRAVES*/
                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGraves();
                   $fil10=mysqli_fetch_object($resul10);

                   $resultorpre_presu=$objorden9->mostrartotalordenesPre_presupuestadas();
                   $filprepresu=mysqli_fetch_object($resultorpre_presu);


                  ?>
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
              
                 
                <ul>
                  <p>PERFIL DEL USUARIO: <?php echo $tituloform; ?></p>               
                    
                </ul>
               
            </div> <!-- END #portfolio_menu -->
            
            
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->



    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
   <section class="responsive">
<table>
  <tbody>
    <tr>
      <td><strong>Nombre  </strong></td>
      <td><p> : <?php echo $nombusu?></p></td>
 
  </tr>
 <tr>
  <td><strong>Apellidos </strong></td>
  <td><p>: <?php echo $apellusu; ?></p></td>   
 </tr>

 <tr>
  <td><strong>Direccion </strong></td>
  <td><p>: <?php echo $direcusu; ?></p></td>
 </tr>

 <tr>
  <td><strong>Telefono</strong></td>
  <td><p>: <?php echo $telusu; ?></p></td>
 </tr>

 <tr>
  <td><strong>Correo</strong></td>
  <td><p>: <?php echo $emailusu; ?></p></td>
 
 </tr>

 <tr>
   <td><p><strong>Foto </strong></p></td>
   <td></td>
 </tr>
 
 </tbody>
</table>

  <div class="container" >
      
    <form   style="margin-left:70px; width:238px; height: 210px;  ">
       <?php
         if ($fotodeusuario=='') 
            {
            ?>

              <img style="width:230px; height: 200px;" src="resources/imagenedesistema/usuariosinfoto.png">

            <?php
              
            }
            else
            {
              /*$foto = "fotos/fotosusuarios/$fotodeusuario";
              $propiedades = GetImageSize($foto);
              $anchura=$propiedades[0];
              $altura=$propiedades[1];*/

            ?>
          <center>  <img style="max-width: 230px; max-height: 200px; vertical-align:middle;" src="fotos/fotosusuarios/<?php echo $fotodeusuario; ?>"></center>

             <?php

            }     
           ?>
      
      
       
     
    </form>
  </div>
 <?php
 if ($coordenusu!='') 
 {
   $ubicacionTodo="<a href='$coordenusu' target='_blank'> <i class='fa fa-map-marker fa-2x'></i></a>";
 }
 else
 {
  $ubicacionTodo='<i class="fa fa-map-marker fa-2x" style="color:#c9d5e0;"></i>';
 }

 ?>

  <p><strong>Ubicacion:</strong> <?php echo $ubicacionTodo ?> </p>


</section>

    </div>




    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>


</body>
</html>



