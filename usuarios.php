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
    <title>Usuarios</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
    

     <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
     

</head>
<body>
<?php
include_once('model/clstipousuario.php');
include_once('model/clsusuario.php');
include_once('model/clsabogado.php');
include_once('model/clscliente.php');
include_once('model/clscontador.php');
include_once('model/clsprocurador.php');

include_once('controller/control-usuarios.php');
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
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first main_current" >USUARIOS</a></li>
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
                    <li><button class="botones" onclick="location.href='crearUsuario.php'">CREAR USUARIO</button></li>
                    <form method="post">
                    <li><button class="botones" name="btnabogados">ABOGADOS</button></li>
                    <li><button class="botones" name="btnprocuradores">PROCURADORES</button></li>
                    <li><button class="botones" name="btncontadores">CONTADORES</button></li>
                    <li><button class="botones" name="btncliente">CLIENTES</button></li>
                    <li><button class="botones" name="btnprocuradoresmaestros">PROC. MAESTRO</button></li>
                    <li><button class="botones" name="btnobservadores">OBSERVADORES</button></li>
                    <li><button class="botones" name="btnadmin">ADMINISTRADORES</button></li>
                    </form>
                    
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
 <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
     <?php
     if (!isset($_POST['btnabogados']) and !isset($_POST['btnprocuradores']) and !isset($_POST['btncontadores']) and !isset($_POST['btncliente']) and !isset($_POST['btnprocuradoresmaestros']) and !isset($_POST['btnobservadores']) and !isset($_POST['btnadmin'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE USUARIOS</h3>';
     }

     if (isset($_POST['btnabogados'])) 
     {
      echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ABOGADOS</h3>'; 
     }

     if (isset($_POST['btnprocuradores'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE PROCURADORES</h3>'; 
     }

     if (isset($_POST['btncontadores'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CONTADORES</h3>'; 
     }

     if (isset($_POST['btncliente'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CLIENTES</h3>'; 
     }

     if (isset($_POST['btnprocuradoresmaestros'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE PROCURADORES MAESTRO</h3>'; 
     }

     if (isset($_POST['btnobservadores'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE OBSERVADORES</h3>'; 
     }

     if (isset($_POST['btnadmin'])) 
     {
       echo '<h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ADMINISTRADORES</h3>'; 
     }
     ?>
     
   <section class="responsive">
   
    <br>
       <table id="tablausuarios">
 <thead>     
  <tr>
    <th width="200px">NOMBRES</th>
    <th width="200px">APELLIDOS</th>
    <th width="150px">USUARIO</th>
    <th width="150px">CONTRASEÑA</th>
    <th width="250px">DIRECCION</th>
    <th width="100px">TELEFONO</th>
    <th width="200px">EMAIL</th>
    <th width="50px">FOTO DE FACHADA</th>
    <th width="50px">COORDENADAS DE UBICACION</th>
    <th width="350">OBSERVACIONES</th>
    <th width="50px">ESTADO</th>
    <th width="50px">BORRAR</th>
  </tr>
</thead>
<tbody>
 <?php
 /*PREGUNTA SI NO ESTAN PRESIONADAOS LOS BOTONES DE USUARIOS*/
 if (!isset($_POST['btnabogados']) and !isset($_POST['btnprocuradores']) and !isset($_POST['btncontadores']) and !isset($_POST['btncliente']) and !isset($_POST['btnprocuradoresmaestros']) and !isset($_POST['btnobservadores']) and !isset($_POST['btnadmin'])) 
 {
   
   $usuario=new Usuario();
   $resul=$usuario->listarusuarios();
   while ($fil=mysqli_fetch_object($resul)) {
       
       if ($fil->estadousu=='Inactivo') 
          {
            $colorfont='#b7b3b3';
          }
          else
          {
            $colorfont='none';
          }
       echo "<tr style='color: $colorfont'>";
              $mascara=$fil->id_usuario*1234567;
              $encriptado=base64_encode($mascara);

              $mascarauser=1*1234567;
              $encriptadouser=base64_encode($mascarauser);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptado&type=$encriptadouser'> $fil->nombreusuario</a></td>";
              echo "<td>$fil->apellidosusuario</td>";
              echo "<td>$fil->nombrelogusu</td>";
              echo "<td>$fil->claveusu</td>";
              echo "<td>$fil->direccion</td>";
              echo "<td>$fil->telefonousu</td>";
              echo "<td>$fil->correousuario</td>";
              echo "<td><a href='fotos/fotosusuarios/$fil->fotousu' target='_blank' ><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$fil->coordenadas' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$fil->observaciones</td>";
              echo "<td>$fil->estadousu</td>";
              echo "<td><a onclick='funcionllevaidusuariomodal($fil->id_usuario)'  ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }

//<!--COMIENZA EL LISTADO DE ABOGADOS-->
 
   $abogado=new Abogado();
   $resulabog=$abogado->listarabogado();
   while ($filab=mysqli_fetch_object($resulabog)) {
       
       if ($filab->estadoabog=='Inactivo') 
          {
            $colorfont='#b7b3b3';
          }
          else
          {
            $colorfont='none';
           // style='color: $colorfont'
          }
       echo "<tr style='color: $colorfont'>";
              $mascaraidabog=$filab->id_abogado*1234567;
              $encriptadoidabog=base64_encode($mascaraidabog);

              $mascarauserabog=2*1234567;
              $encriptadouserabog=base64_encode($mascarauserabog);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidabog&type=$encriptadouserabog'>$filab->nombreabog</a></td>";
              echo "<td>$filab->apellidoabog</td>";
              echo "<td>$filab->nombrelogabog</td>";
              echo "<td>$filab->claveabog</td>";
              echo "<td>$filab->direccionabog</td>";
              echo "<td>$filab->telefonoabog</td>";
              echo "<td>$filab->correoabog</td>";
              echo "<td><a href='fotos/fotosusuarios/$filab->fotoabog' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filab->coordenadasabog' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filab->observacionesabog</td>";
              echo "<td>$filab->estadoabog</td>";
              echo "<td><a onclick='funcionllevaidabogadomodal($filab->id_abogado)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  

  //<!--COMIENZA EL LISTADO DE Contador-->
  
   $contador=new Contador();
   $resulcont=$contador->listarcontador();
   while ($filcont=mysqli_fetch_object($resulcont)) {
       if ($filcont->estadocont=='Inactivo') 
          {
            $colorfont='#b7b3b3';
          }
          else
          {
            $colorfont='none';
           // style='color: $colorfont'
          }
       echo "<tr style='color: $colorfont'>";
             $mascaraidcont=$filcont->id_contador*1234567;
              $encriptadoidcont=base64_encode($mascaraidcont);

              $mascarausercont=3*1234567;
              $encriptadousercont=base64_encode($mascarausercont);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidcont&type=$encriptadousercont'>$filcont->nombrecont</a></td>";
              echo "<td>$filcont->apellidocont</td>";
              echo "<td>$filcont->nombrelogcont</td>";
              echo "<td>$filcont->clavecont</td>";
              echo "<td>$filcont->direccioncont</td>";
              echo "<td>$filcont->telefonocont</td>";
              echo "<td>$filcont->correocont</td>";
              echo "<td><a href='fotos/fotosusuarios/$filcont->fotocont' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filcont->coordenadascont' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filcont->observacionescont</td>";
              echo "<td>$filcont->estadocont</td>";
              echo "<td><a onclick='funcionllevaidcontadormodal($filcont->id_contador)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  

  //<!--COMIENZA EL LISTADO DE Procurador-->
  
   $procurador=new Procurador();
   $resulproc=$procurador->listarTodosprocurador();
   while ($filproc=mysqli_fetch_object($resulproc)) {
       if ($filproc->estadoproc=='Inactivo') 
              {
                $colorfont='#b7b3b3';
              }
              else
              {
                $colorfont='none';
               // style='color: $colorfont'
              }
       echo "<tr style='color: $colorfont'>";
             $mascaraidproc=$filproc->id_procurador*1234567;
              $encriptadoidproc=base64_encode($mascaraidproc);

              $mascarauserproc=4*1234567;
              $encriptadouserproc=base64_encode($mascarauserproc);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidproc&type=$encriptadouserproc'>$filproc->nombreproc</a></td>";
              echo "<td>$filproc->apellidoproc</td>";
              echo "<td>$filproc->nombrelogproc</td>";
              echo "<td>$filproc->claveproc</td>";
              echo "<td>$filproc->direccionproc</td>";
              echo "<td>$filproc->telefonoproc</td>";
              echo "<td>$filproc->correoproc</td>";
              echo "<td><a href='fotos/fotosusuarios/$filproc->fotoproc' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filproc->coordenadasproc' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filproc->observacionesproc</td>";
              echo "<td>$filproc->estadoproc</td>";
              echo "<td><a onclick='funcionllevaidprocuradormodal($filproc->id_procurador)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  
 

  //<!--COMIENZA EL LISTADO DE CLIENTES-->
  
   $cliente=new Cliente();
   $resulcli=$cliente->listarcliente();
   while ($filcli=mysqli_fetch_object($resulcli)) {
             if ($filcli->estadocli=='Inactivo') 
              {
                $colorfont='#b7b3b3';
              }
              else
              {
                $colorfont='none';
               // style='color: $colorfont'
              }
       echo "<tr style='color: $colorfont'>";
              $mascaraidcli=$filcli->id_cliente*1234567;
              $encriptadoidcli=base64_encode($mascaraidcli);

              $mascarausercli=5*1234567;
              $encriptadousercli=base64_encode($mascarausercli);

              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidcli&type=$encriptadousercli'>$filcli->nombrecli</a></td>";
              echo "<td>$filcli->apellidocli</td>";
              echo "<td>$filcli->nombrelogcli</td>";
              echo "<td>$filcli->clavecli</td>";
              echo "<td>$filcli->direccioncli</td>";
              echo "<td>$filcli->telefonocli</td>";
              echo "<td>$filcli->correocli</td>";
              echo "<td><a href='fotos/fotosusuarios/$filcli->fotocli' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filcli->coordenadascli' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filcli->observacionescli</td>";
              echo "<td>$filcli->estadocli</td>";
              echo "<td><a onclick='funcionllevaidclientemodal($filcli->id_cliente)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }



  }/*FIN DEL IF QUE PREGUNTA SI NO ESTAN PRESIONADOS LOS BOTONES DE USUARIOS*/








  if (isset($_POST['btnabogados'])) /*pregunta si se presiono el boton abogados*/
  {
    $abogado1=new Abogado();
   $resulabog1=$abogado1->listarabogado();
   while ($filab1=mysqli_fetch_object($resulabog1)) {
            if ($filab1->estadoabog=='Inactivo') 
              {
                $colorfont='#b7b3b3';
              }
              else
              {
                $colorfont='none';
               // style='color: $colorfont'
              }
       echo "<tr style='color: $colorfont'>";
              $mascaraidabog=$filab1->id_abogado*1234567;
              $encriptadoidabog=base64_encode($mascaraidabog);

              $mascarauserabog=2*1234567;
              $encriptadouserabog=base64_encode($mascarauserabog);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidabog&type=$encriptadouserabog'>$filab1->nombreabog</a></td>";
              echo "<td>$filab1->apellidoabog</td>";
              echo "<td>$filab1->nombrelogabog</td>";
              echo "<td>$filab1->claveabog</td>";
              echo "<td>$filab1->direccionabog</td>";
              echo "<td>$filab1->telefonoabog</td>";
              echo "<td>$filab1->correoabog</td>";
              echo "<td><a href='fotos/fotosusuarios/$filab1->fotoabog' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filab1->coordenadasabog' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filab1->observacionesabog</td>";
              echo "<td>$filab1->estadoabog</td>";
              echo "<td><a onclick='funcionllevaidabogadomodal($filab1->id_abogado)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  } /*fin del if que pregunta si se presiono el boton abogados*/


  if (isset($_POST['btnprocuradores'])) /*pregunta sise presiono el boton procuradores*/
  {
    $procurador1=new Procurador();
   $resulproc1=$procurador1->listarSoloprocuradores();
   while ($filproc1=mysqli_fetch_object($resulproc1)) {
              if ($filproc1->estadoproc=='Inactivo') 
                  {
                    $colorfont='#b7b3b3';
                  }
                  else
                  {
                    $colorfont='none';
                   // style='color: $colorfont'
                  }
       echo "<tr style='color: $colorfont'>";
             $mascaraidproc=$filproc1->id_procurador*1234567;
              $encriptadoidproc=base64_encode($mascaraidproc);

              $mascarauserproc=4*1234567;
              $encriptadouserproc=base64_encode($mascarauserproc);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidproc&type=$encriptadouserproc'>$filproc1->nombreproc</a></td>";
              echo "<td>$filproc1->apellidoproc</td>";
              echo "<td>$filproc1->nombrelogproc</td>";
              echo "<td>$filproc1->claveproc</td>";
              echo "<td>$filproc1->direccionproc</td>";
              echo "<td>$filproc1->telefonoproc</td>";
              echo "<td>$filproc1->correoproc</td>";
              echo "<td><a href='fotos/fotosusuarios/$filproc1->fotoproc' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filproc1->coordenadasproc' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filproc1->observacionesproc</td>";
              echo "<td>$filproc1->estadoproc</td>";
              echo "<td><a onclick='funcionllevaidprocuradormodal($filproc1->id_procurador)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  } /*fin del if que pregunta sise presiono el boton procuradores*/

  if (isset($_POST['btncontadores'])) /*pregunta sise presiono el boton contador*/
  {
    $contador1=new Contador();
   $resulcont1=$contador1->listarcontador();
   while ($filcont1=mysqli_fetch_object($resulcont1)) {
              if ($filcont1->estadocont=='Inactivo') 
                      {
                        $colorfont='#b7b3b3';
                      }
                      else
                      {
                        $colorfont='none';
                       // style='color: $colorfont'
                      }
       echo "<tr style='color: $colorfont'>";
             $mascaraidcont=$filcont1->id_contador*1234567;
              $encriptadoidcont=base64_encode($mascaraidcont);

              $mascarausercont=3*1234567;
              $encriptadousercont=base64_encode($mascarausercont);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidcont&type=$encriptadousercont'>$filcont1->nombrecont</a></td>";
              echo "<td>$filcont1->apellidocont</td>";
              echo "<td>$filcont1->nombrelogcont</td>";
              echo "<td>$filcont1->clavecont</td>";
              echo "<td>$filcont1->direccioncont</td>";
              echo "<td>$filcont1->telefonocont</td>";
              echo "<td>$filcont1->correocont</td>";
              echo "<td><a href='fotos/fotosusuarios/$filcont1->fotocont' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filcont1->coordenadascont' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filcont1->observacionescont</td>";
              echo "<td>$filcont1->estadocont</td>";
              echo "<td><a onclick='funcionllevaidcontadormodal($filcont1->id_contador)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  }/* fin del if que pregunta sise presiono el boton contador*/


  if (isset($_POST['btncliente'])) /* if que pregunta sise presiono el boton cliente*/
  {
    $cliente1=new Cliente();
   $resulcli1=$cliente1->listarcliente();
   while ($filcli1=mysqli_fetch_object($resulcli1)) {
              if ($filcli1->estadocli=='Inactivo') 
                      {
                        $colorfont='#b7b3b3';
                      }
                      else
                      {
                        $colorfont='none';
                       // style='color: $colorfont'
                      }
       echo "<tr style='color: $colorfont'>";
              $mascaraidcli=$filcli1->id_cliente*1234567;
              $encriptadoidcli=base64_encode($mascaraidcli);

              $mascarausercli=5*1234567;
              $encriptadousercli=base64_encode($mascarausercli);

              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidcli&type=$encriptadousercli'>$filcli1->nombrecli</a></td>";
              echo "<td>$filcli1->apellidocli</td>";
              echo "<td>$filcli1->nombrelogcli</td>";
              echo "<td>$filcli1->clavecli</td>";
              echo "<td>$filcli1->direccioncli</td>";
              echo "<td>$filcli1->telefonocli</td>";
              echo "<td>$filcli1->correocli</td>";
              echo "<td><a href='fotos/fotosusuarios/$filcli1->fotocli' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filcli1->coordenadascli' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filcli1->observacionescli</td>";
              echo "<td>$filcli1->estadocli</td>";
              echo "<td><a onclick='funcionllevaidclientemodal($filcli1->id_cliente)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  }/* fin del if que pregunta sise presiono el boton cliente*/


  if (isset($_POST['btnprocuradoresmaestros'])) /* if que pregunta sise presiono el boton procurador maestro*/
  {
    $procurador2=new Procurador();
    $resulproc2=$procurador2->listarProcuradoresMaestros();
   while ($filproc2=mysqli_fetch_object($resulproc2)) {
              if ($filproc2->estadoproc=='Inactivo') 
                      {
                        $colorfont='#b7b3b3';
                      }
                      else
                      {
                        $colorfont='none';
                       // style='color: $colorfont'
                      }
       echo "<tr style='color: $colorfont'>";
             $mascaraidproc=$filproc2->id_procurador*1234567;
              $encriptadoidproc=base64_encode($mascaraidproc);

              $mascarauserproc=4*1234567;
              $encriptadouserproc=base64_encode($mascarauserproc);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptadoidproc&type=$encriptadouserproc'>$filproc2->nombreproc</a></td>";
              echo "<td>$filproc2->apellidoproc</td>";
              echo "<td>$filproc2->nombrelogproc</td>";
              echo "<td>$filproc2->claveproc</td>";
              echo "<td>$filproc2->direccionproc</td>";
              echo "<td>$filproc2->telefonoproc</td>";
              echo "<td>$filproc2->correoproc</td>";
              echo "<td><a href='fotos/fotosusuarios/$filproc2->fotoproc' target='_blank'><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$filproc2->coordenadasproc' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$filproc2->observacionesproc</td>";
              echo "<td>$filproc2->estadoproc</td>";
              echo "<td><a onclick='funcionllevaidprocuradormodal($filproc2->id_procurador)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  }/* fin del if que pregunta sise presiono el boton procurador maestro*/



  if (isset($_POST['btnobservadores'])) /*if que pregunta sise presiono el boton observadores*/
  {
    $usuario1=new Usuario();
   $resul1=$usuario1->listarusuariosObservador();
   while ($fil1=mysqli_fetch_object($resul1)) {
             if ($fil1->estadousu=='Inactivo') 
                      {
                        $colorfont='#b7b3b3';
                      }
                      else
                      {
                        $colorfont='none';
                       // style='color: $colorfont'
                      }
       echo "<tr style='color: $colorfont'>";
              $mascara=$fil1->id_usuario*1234567;
              $encriptado=base64_encode($mascara);

              $mascarauser=1*1234567;
              $encriptadouser=base64_encode($mascarauser);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptado&type=$encriptadouser'> $fil1->nombreusuario</a></td>";
              echo "<td>$fil1->apellidosusuario</td>";
              echo "<td>$fil1->nombrelogusu</td>";
              echo "<td>$fil1->claveusu</td>";
              echo "<td>$fil1->direccion</td>";
              echo "<td>$fil1->telefonousu</td>";
              echo "<td>$fil1->correousuario</td>";
              echo "<td><a href='fotos/fotosusuarios/$fil1->fotousu' target='_blank' ><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$fil1->coordenadas' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$fil1->observaciones</td>";
              echo "<td>$fil1->estadousu</td>";
              echo "<td><a onclick='funcionllevaidusuariomodal($fil1->id_usuario)'  ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  }/* fin del if que pregunta sise presiono el boton observadores*/

  if (isset($_POST['btnadmin'])) /* if que pregunta sise presiono el boton administradores*/
  {
    $usuario2=new Usuario();
   $resul2=$usuario2->listarusuariosAdministrador();
   while ($fil2=mysqli_fetch_object($resul2)) {
             if ($fil2->estadousu=='Inactivo') 
                      {
                        $colorfont='#b7b3b3';
                      }
                      else
                      {
                        $colorfont='none';
                       // style='color: $colorfont'
                      }
       echo "<tr style='color: $colorfont'>";
              $mascara=$fil2->id_usuario*1234567;
              $encriptado=base64_encode($mascara);

              $mascarauser=1*1234567;
              $encriptadouser=base64_encode($mascarauser);
              echo "<td><a style='color: $colorfont' href='crearUsuario.php?squart=$encriptado&type=$encriptadouser'> $fil2->nombreusuario</a></td>";
              echo "<td>$fil2->apellidosusuario</td>";
              echo "<td>$fil2->nombrelogusu</td>";
              echo "<td>$fil2->claveusu</td>";
              echo "<td>$fil2->direccion</td>";
              echo "<td>$fil2->telefonousu</td>";
              echo "<td>$fil2->correousuario</td>";
              echo "<td><a href='fotos/fotosusuarios/$fil2->fotousu' target='_blank' ><i class='fa fa-camera fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td><a href='$fil2->coordenadas' target='_blank'><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></a></td>";
              echo "<td>$fil2->observaciones</td>";
              echo "<td>$fil2->estadousu</td>";
              echo "<td><a onclick='funcionllevaidusuariomodal($fil2->id_usuario)' ><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>";
        echo "</tr>";
          }
  }/* fin del if que pregunta sise presiono el boton administradores*/

  ?>

</tbody>
</table>
</section>

    </div>

    <br>
    <br>
    <br>


     <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DE LA TABLA USUARIO
  function funcionllevaidusuariomodal(idd)
  {
    $('#textidusu').val(idd);
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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(VISIBLE =NO) un usuario -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR USUARIO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Usuario ??</b></label><br><br>
        <input type="hidden" name="textidadmin" id="textidadmin" placeholder="id adminactual" value="<?php echo $datos['id_usuario']; ?>">
        <input type="hidden" class="textform" id="textidusu" name="textidusu" placeholder="id usuario" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarusu" name="btneliminarusu" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DE LA TABLA BOGADO
  function funcionllevaidabogadomodal(idd)
  {
    $('#textidabog').val(idd);
    var modal = document.getElementById("myModalabog");
    var btnclose = document.getElementById("btncloseformpresabog");
    var span = document.getElementById("spancloseabog");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(VISIBLE =NO) un usuario -->
<div id="myModalabog" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseabog">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR USUARIO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Usuario ??</b></label><br><br>
        
        <input type="hidden" class="textform" id="textidabog" name="textidabog" placeholder="id abogados" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarabog" name="btneliminarabog" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpresabog" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DE LA TABLA Contador
  function funcionllevaidcontadormodal(idd)
  {
    $('#textidcont').val(idd);
    var modal = document.getElementById("myModalcont");
    var btnclose = document.getElementById("btncloseformprescont");
    var span = document.getElementById("spanclosecont");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(VISIBLE =NO) un contador -->
<div id="myModalcont" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosecont">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR USUARIO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Usuario ??</b></label><br><br>
        
        <input type="hidden" class="textform" id="textidcont" name="textidcont" placeholder="id contador" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarcont" name="btneliminarcont" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformprescont" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DE LA TABLA procurador
  function funcionllevaidprocuradormodal(idd)
  {
    $('#textidproc').val(idd);
    var modal = document.getElementById("myModalproc");
    var btnclose = document.getElementById("btncloseformpresproc");
    var span = document.getElementById("spancloseproc");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(VISIBLE =NO) un procurador -->
<div id="myModalproc" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseproc">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR USUARIO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Usuario ??</b></label><br><br>
        
        <input type="hidden" class="textform" id="textidproc" name="textidproc" placeholder="id procurador" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarproc" name="btneliminarproc" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformpresproc" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>



<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DE LA TABLA cliente
  function funcionllevaidclientemodal(idd)
  {
    $('#textidcli').val(idd);
    var modal = document.getElementById("myModalcli");
    var btnclose = document.getElementById("btncloseformprescli");
    var span = document.getElementById("spanclosecli");

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
   


         <!-- The Modal (FORMULARIO) PARA eliminar(VISIBLE =NO) un cliente -->
<div id="myModalcli" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosecli">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR USUARIO</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <label><b>Esta seguro de eliminar este Usuario ??</b></label><br><br>
        
        <input type="hidden" class="textform" id="textidcli" name="textidcli" placeholder="id cliente" required><br>
                                                        

    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="submit" class="btnclose" id="btneliminarcli" name="btneliminarcli" value="Eliminar">
     <button type="button" class="btnclose" id="btncloseformprescli" style="float: right;">Cancelar</button>
     </div>
      </form>

   
  </div>

</div>




<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
   /* $(function() {
  var f = function() {
    $(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
  };
  $('input').change(f).trigger('change');
});*/
</script>