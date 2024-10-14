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
    <title>nuevoJuzgado</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>

</head>
<body>
<?php
include_once('model/clsdistrito.php');
include_once('model/clspiso.php');
include_once('model/clsjuzgados.php');
include_once('controller/control-juzgados.php');

include_once('modal/modal_ubicacion.php');
$codtribunal=$_GET['squart'];
$decodificado=base64_decode($codtribunal);

   $codigonuevotrib=$decodificado/1213141516;

$objjuzg=new Juzgados();
   $resultjuz=$objjuzg->mostrardatostribunal($codigonuevotrib);
   $filjuz=mysqli_fetch_object($resultjuz);

   $idjuz=$filjuz->id_juzgados;
   $nombrenum=$filjuz->nombrenumerico;
   $jerarquiatri=$filjuz->jerarquia;
   $materiatri=$filjuz->materiajuz;
   $coordenadastri=$filjuz->coordenadasjuz;
   $fototri=$filjuz->fotojuz;
   $iddistr=$filjuz->id_distrito;
   $idpiso=$filjuz->id_piso;
   $contac1=$filjuz->contacto1;
   $contac2=$filjuz->contacto2;
   $contac3=$filjuz->contacto3;
   $contac4=$filjuz->contacto4;
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
               
                
               

                 <li  class="" style="float: left; margin: 0 14px; width: 440px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">        
            <div id="portfolio_menu">
                
                <ul>
                   
                   <li><button style="width: 200px;" class="botones" onclick="location.href='distrito.php'">AGREGAR NUEVO DISTRITO</button></li>
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
   if ($idjuz!=0) 
   {
     echo '<h3 class="titulo">MODIFICAR TRIBUNAL</h3>';
   }
   else
   {
   echo '<h3 class="titulo">REGISTRAR NUEVO TRIBUNAL</h3>';
   }
   ?>
    <br>
    
    <br>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" placeholder="id juzgado a modificar" name="textidjuz" value="<?php echo $idjuz;?>">
    <div class="orden">
       <label>NOMBRE</label>
       <input type="number" id="number" name="textnombjuz" autocomplete="off" placeholder="Nombe numerico Ej: 6" required="required" value="<?php echo $nombrenum; ?>">
    </div>

    <div class="orden">
       <label>JERARQUIA</label>
       <input type="text" id="textjerarqjuz" name="textjerarqjuz" autocomplete="off" placeholder="Jerarquia del tribunal" required="required" value="<?php echo $jerarquiatri; ?>">
    </div>

    <div class="orden">
       <label>MATERIA</label>
       <input type="text" id="textmatjuz" name="textmatjuz" autocomplete="off" placeholder="Materia del tribunal" required="required" value="<?php echo $materiatri; ?>">
    </div>

    <div class="orden">
       <label>COORDENADAS</label>
       <button data-toggle="modal" data-target="#maps" type="button" style="height: 50px; width: 600px; background: #81D4E9; color: white;">ELEGIR UBICACION</button>
    </div>

    <div class="orden">
       <label>FOTO</label>
       <input type="file" id="filefotojuz" name="filefotojuz" autocomplete="off">
    </div>

    <div class="orden">
       <label >DISTRITO</label>
      
     <select id="selctdist" name="selctdist" >
        <?php
        $iddistrexep=0;
        if ($idjuz!=null)
        {
          $objdis=new Distrito();
          $resultdis=$objdis->mostrarDistritoDetribunal($idjuz);
          $fildef=mysqli_fetch_array($resultdis);
          echo '<option value="'.$fildef['iddistrito'].'">'.$fildef['nombredistrito'].'</option>';
              $iddistrexep=$fildef['iddistrito'];
        }
        else
        {
      echo "<option>ASIGNE DISTRITO</option>";
        }
        $obdis1=new Distrito();
        $resultd1=$obdis1->listarDistritosexeptouno($iddistrexep);
        while ($fild1=mysqli_fetch_array($resultd1)) {
          echo '<option value="'.$fild1['id_distrito'].'">'.$fild1['nombredistrito'].'</option>';
        } 
          

        ?>
      
      </select>
      
    </div>

    <div class="orden">
       <label>PISO</label>
  
     <select id="selectpiso" name="selectpiso">
     <?php
     $idpisoexep=0;
     if ($idjuz!=null) 
     {
       $objpiso=new Piso();
       $resultp=$objpiso->mostrarpisoEnTribunal($idjuz);
       $filp=mysqli_fetch_array($resultp);
       echo '<option value="'.$filp['idpiso'].'">'.$filp['nombrepiso'].'</option>';
              $idpisoexep=$filp['idpiso'];
     }
     else
        {
         echo "<option>ASIGNE PISO</option>";
        }
      $objpiso1=new Piso();
      $resulp1=$objpiso1->listarPisosActivosExeptoUno($idpisoexep);
      while ($filp1=mysqli_fetch_array($resulp1)) {
          echo '<option value="'.$filp1['id_piso'].'">'.$filp1['nombrepiso'].'</option>';
        } 
     ?>

     </select>
      
    </div>

     <div class="orden">
       <label>CONTACTO 1</label>
       <input type="text" id="contacto1" name="contacto1" autocomplete="off" placeholder="Contacto del tribunal" required="required" value="<?php echo $contac1; ?>">
    </div>

    <div class="orden">
       <label>CONTACTO 2</label>
       <input type="text" id="contacto2" name="contacto2" autocomplete="off" placeholder="Contacto del tribunal" required="required" value="<?php echo $contac2; ?>">
    </div>

    <div class="orden">
       <label>CONTACTO 3</label>
       <input type="text" id="contacto3" name="contacto3" autocomplete="off" placeholder="Contacto del tribunal" required="required" value="<?php echo $contac3; ?>">
    </div>

    <div class="orden">
       <label>CONTACTO 4</label>
       <input type="text" id="contacto4" name="contacto4" autocomplete="off" placeholder="Contacto del tribunal" required="required" value="<?php echo $contac4; ?>">
    </div>

    <?php
   if ($idjuz!=0) 
   {
     echo '<input type="submit" value="MODIFICAR" id="btnmodijuz" name="btnmodijuz">';
   }
   else
   {
   echo ' <input type="submit" value="GUARDAR" id="btnguardarjuz" name="btnguardarjuz">';
   }


   
   ?>

   
   

    <input type="hidden" placeholder="latitud" name="textlatitud" id="textlatitud">
   <input type="hidden" placeholder="longitud" name="textlongitud" id="textlongitud">
   <input type="hidden" placeholder="link" name="textlink" id="textlink" value="<?php echo $coordenadastri; ?>"> 
  </form>

  <script type="text/javascript">

function addparametroubicacion(x,y,dir){
document.getElementById("textlatitud").value = x+"";
document.getElementById("textlongitud").value = y+"";
document.getElementById("textlink").value=dir+"https://maps.google.com/?q="+x+","+y+"";
}

</script>
    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
