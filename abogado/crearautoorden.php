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
    <title>Crear Nota para la agenda</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

</head>
<script type="text/javascript">
function validarForm(formulario) {
  if(formulario.nombre.value.length==0) { //comprueba que no esté vacío
    formulario.nombre.focus();   
    alert('No has escrito el campo demandante'); 
    return false; //devolvemos el foco
  }
  if(formulario.nombre.value.length==0) { //comprueba que no esté vacío
    formulario.nombre.focus();   
    alert('No has escrito el campo ultimo domicilio'); 
    return false; //devolvemos el foco
  }
  if(formulario.foja.value.length==0) { //comprueba que no esté vacío
    formulario.foja.focus();   
    alert('No has escrito el campo fojas'); 
    return false; //devolvemos el foco
  }
  return true;
}
</script>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clsautoorden.php');


include_once('../controller/control-autoorden.php');



$codcausa=$_GET['squart'];
//SE DESENCRIPTA EL CODIGO PARA PODER USARLO //

$decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/12345678910;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";
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


        <p id="codcausas"><?php echo $fil->codigo; ?> </p>
        
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
                    <li><button class="botones" style="width: 220px; height: 45px;" onclick="location.href='listaorden.php?squart=<?php echo $codcausa ?>'">LISTA DE ORDENES</button></li>
                   
                 
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
            
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
    
    
      <?php
     include_once('../model/clsprocurador.php');
     
    ?>
    <div class="container">


   <section>

<div class="container">
<form method="POST" onsubmit=" return validarForm(this);" id="formulario"  name="formulario">

<input type="hidden" name="textidcausa" id="textidcausa" value="<?php echo $codigonuevo ?>">
<b><h3 class="titulo">ESCRIBA ALGUN DETALLE SOBRE LA NOTA PARA LA AGENDA </h3></b><br>


<br>
<table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DETALLE</h3></td>
    </tr>
  </tbody>
</table>



    <div class="orden">
      <textarea name="texteditordetalleauto" cols="30" rows="5" class="tinymce" id="texteditordetalleauto"></textarea>
    </div><br>

    

    
    

       <table id="customers">
               <thead>
                
                 <th >ESCOJA UN COLOR PARA ESTA NOTA </th>
               </thead>
               <tbody>
               <tr>
                 

                 <td colspan="2"> 
                 <select id="selectcolor" name="selectcolor">
                   <option value="#F5EB0F">Amarillo</option>
                   <option value="red">Rojo</option>
                   <option value="blue">Azul</option>
                   <option value="#42A4D2">Celeste</option>
                   <option value="#009900">Verde</option>
                   <option value="#F5860F">Naranja</option>

                 
                </select> </td>
                </tr>
               </tbody>
               </table><br>
               
               <h3><strong> ATENCION.-</strong> El color que escoja para esta nota de la agenda sera el color de fondo del nombre de la causa en la pagina principal Causas Activas:</h3><br>

                <?php
               ini_set('date.timezone','America/La_Paz');
               $fechahoy=date("Y-m-d");
               $horita=date("H:i");
               $concat=$fechahoy.' '.$horita;
              // echo $concat;
               ?>

              <table id="customers"> 
              <tbody>

                 <tr>
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="fechainicio" id="fechainicio" value="<?php echo $fechahoy; ?>"> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i> </td>
                   <td>Hora Inicio<input type="time" name="horainicio" id="horainicio" value="<?php echo $horita; ?>" > <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                  
                 </tr>

                  <tr>
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="fechafinal" id="fechafinal" value="<?php echo $fechahoy; ?>"> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora Final  <input type="time" name="horafinal" id="horafinal" value="<?php echo $horita; ?>" > <i class="fa fa-clock-o fa-2x" aria-hidden="true"></td>
                 
                 </tr>
                 </tbody>
              </table>
               

              
      
      
     
           
               <input type="submit" name="btnguardarautoorden" id="btnguardarautoorden" value="PROCESAR">
              
          
      
    </form>
    </div>
</section><br><br>

<?php
/*if (isset($_POST['btnguardarorden'])) {
     $f1=$_POST['fechainicio'];
     $h1=$_POST['horainicio'];
     $f2=$_POST['fechafinal'];
     $h2=$_POST['horafinal'];
     if ( ($f1!=null) and ($h1!=null) and ($f2!=null) and ($h2!=null) ) {
      //echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Las Fechas no son nulas','success'); </script>";
       $fechini1=$_POST['fechainicio'];
    $newfechini1=date_create($fechini1);
    $fechainiformato=date_format($newfechini1, 'Y-m-d');


    $horaini1=$_POST['horainicio'];
    $newhoraini1=date_create($horaini1);
    $horainiformato=date_format($newhoraini1, 'H:i');
    $fechasinihoracompleto=$fechainiformato.' '.$horainiformato;

    ///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
    ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     ////$concat es la fecha y hora del sistema
     $concat=$fechoyal.' '.$horita;

     ///fecha y hora final
     $fechfin2=$_POST['fechafinal'];
    $newfechfin2=date_create($fechfin2);
    $fechafinformato=date_format($newfechfin2, 'Y-m-d');


    $horafin2=$_POST['horafinal'];
    $newhorafin2=date_create($horafin2);
    $horafinformato=date_format($newhorafin2, 'H:i');

    $fechasfinhoracompleto=$fechafinformato.' '.$horafinformato;
    /////////////////////
    //AQUI SE HACE LA VALIDACION DE FECHAS ES DECIR: FECHA INICIO MAYOR A FECHA DEL SISTEMA Y FECHA FIN MAYOR A FECHA INICIO
   /* */
    
   /*  if ($fechasinihoracompleto>$concat) {

         if ($fechasfinhoracompleto>$fechasinihoracompleto) {
           echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Fecha Final es mayor que Fecha Inicio TODO ESTA BIEN','success'); </script>";




         }
         else{
            echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora  Final deben ser mayores a Fecha y Hora inicio ','warning'); </script>";
         }
       
     }
     else{
       echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora Inicio deben ser mayores a la Fecha y Hora actual, Asegurese de que la Fecha y Hora Inicio sean mayores que la fecha y hora  actual ','warning'); </script>";
     }

       
     }
     else{
      echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' Complete todos los campos de fechas y horas','warning'); </script>";
     }


     



    ////////////
}*/

?>
 

           
          
<script type="text/javascript" src="../resources/jquery.js"></script>
  <!-- javascript -->
    <script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/init-tinymce.js"></script>
   
</body>
</html>
