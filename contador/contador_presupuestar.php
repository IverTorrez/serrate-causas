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
    <title>Presupuestar Orden</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css"> 

</head>
<body>
<?php

include_once('../model/clsprocurador.php');
include_once('../model/clspresupuesto.php');

include_once('../model/clscotizacion.php');
include_once('../model/clsprioridad.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clscausa.php');
include_once('../model/clstribunal.php');
include_once('../model/clsplanilla_notificacion.php');
include_once('../model/clsusuario.php');
include_once('../controller/controlpresupuesto.php');
include_once('../controller/control-modificarpresupuesto.php');

  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codorden=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codorden);

   $codigonuevo=$decodificado/10987654321;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausadeorden($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";


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
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
  <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">


  <section class="responsive">
  <table id="customers">
    <thead>
      <tr>
        <th>FISIOLOGIA DEL TRIBUNAL</th>
        <th>NOMBRE DEL TRIBUNAL</th>
        <th>VER UBICACION</th>
        <th>VER FOTO DE FACHADA</th>
        <th>PISO</th>
      </tr>
    </thead>
    <tbody>
        <?php
       $objcausa=new Causa();
  $listado=$objcausa->mostraridcausadeorden($codigonuevo);
  $filacod=mysqli_fetch_object($listado);

    $objtibunal=new Tribunal();
     $lista=$objtibunal->listartribunalficha($filacod->codcausa);
      while ($fil=mysqli_fetch_object($lista)) {
       echo "<tr>";
              echo "<td>$fil->tptribu</td>"; 
              echo "<td>$fil->juzg</td>";
              echo "<td><a href='$fil->coordenadasjuz' target='_blank'><center><i class='fa fa-map-marker fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td><a href='../fotos/fotosjuzgados/$fil->fotojuz' target='_blank'><center><i class='fa fa-camera fa-2x' aria-hidden='true'></i></center></a></td>";
              echo "<td>$fil->Pis</td>";
              
             
           
        echo "</tr>";
          }
  ?>
      
    </tbody>
  </table><br>
    
  </section>


  
 
  <?php
 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila=mysqli_fetch_object($resul);
?>

<section class="responsive">
<!-- tabla de informacion-->
 <table id="customers">
 <thead>     
  <tr>
    <th>INFORMACION</th>
      
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
     <?php
    echo "<td>$fila->informacion</td>";
    ?>
  </tr>

</tbody>
</table><br>

<!--Ttabla de documentacion-->
 <table id="customers">
 <thead>     
 <tr >
    <th>DOCUMENTACION </th>  
  </tr>
</thead>
<tbody>
  <tr id="filaprosa">
   <?php
    echo "<td>$fila->documentacion</td>";
    ?>
  </tr>
</tbody>
</table>
<!--seccion para asignar presupuesto-->

<br>

    <h3 style="color: #000000;font-size: 25px;text-align: center;">ASIGNAR PRESUPUESTO PARA ESTA ORDEN</h3>
<form method="post" onsubmit="return validarForm(this);">
<input type="hidden" name="idor" id="idor" value="<?php echo $codigonuevo; ?>">
<input type="hidden" name="idcontador" id="idcontador" value="<?php echo $datos['id_contador']; ?>">
 <div id="contenedor">
<br>

<?php
$objorden=new OrdenGeneral();
$list=$objorden->mostrardatosorden($codigonuevo);
$filaorden=mysqli_fetch_object($list);


?>

<table width="100%">
<tbody >
<tr>
  <td width="300px">PRIORIDAD SUGERIDA :<b> <?php echo "$filaorden->Prioridad";?> </b></td>
  <td width="500px">PROCURADOR POR DEFECTO :<b> <?php echo "$filaorden->procuradorasig";?> </b></td>
  <td width="350px"> CREDITO DEL PROCESO (Bs):<b> <?php echo "$filaorden->Cajacausa";?> </b></td>
</tr><br><br><br>

<tr>
  <td><select id="idprioridad" name="idprioridad">
         <option>3</option>
         <option>2</option>
         <option>1</option>
</select></td>

  <td><select id="idprocu" name="idprocu">
             <?php 
                 $objproc=new Procurador();
                  $result=$objproc->mostrarprocuradorpordefectodeOrden($codigonuevo);
                  $fila=mysqli_fetch_array($result);
               //antiguo     echo '<option value="'.$fila['idproc'].'">'.$fila['Nombre'].' '.$fila['Apellidos'].'--'.$fila['Tipo'].' (Por Defecto)'.'</option>';
               echo '<option value="'.$fila['idproc'].'">'.$fila['Apellidos'].', '.$fila['Nombre'].' (Por Defecto)'.'</option>';
                  $objmat=new Procurador();
                  $liscat=$objmat->listarprocuradoresexeptouno($fila['idproc']);
                 while($cat=mysqli_fetch_array($liscat)){
                 echo '<option value="'.$cat['idproc'].'">'.$cat['Apellidos'].', '.$cat['Nombre'].'</option>';
       //antiguo          echo '<option value="'.$cat['idproc'].'">'.$cat['Nombre'].' '.$cat['Apellidos'].'--'.$cat['Tipo'].'</option>';
                 }
                ?> 
</select> </td>

  <td></td>
</tr>
</tbody>
</table>

<style type="text/css">
  select, .form-control{
    width: 50%;
  padding: 11px 12px;
  margin: 6px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box; 
  }
  #btnpresupuestar, #btnmodificarpresu{
    width: 20%;
  background-color: #1A5895;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left: 500px; 
  margin-top: 20px;
  }
</style>




<!--<div id="lateral">

PRIORIDAD SUGERIDA : 2
  <br>
  <br>
DEFINIR PRIORIDAD

<select  style="width: 15%; ">
<option>2</option>
<option>3</option>
</select>
</div>

<div id="principal">
  
PROCURADOR POR DEFECTO : Juan Perez martinez

<div id="lateral2">
  CREDITO DEL PROCESO (B0s): 500

</div>
<br>
<br>
 DEFINIR PROCURADOR
<select style="width: 25%;">
<option>juan peres</option>
</select> 

</div>-->
<?php
$objpresu=new Presupuesto();
$resultP=$objpresu->mostrarpresupuesto($codigonuevo);
$filpre=mysqli_fetch_object($resultP);

?>


<br>
</div>
<!-- OBTENEMOS LA SUGERENCIA DE PRESUPUESTO QUE HIZO EL PROCURADOR -->
<?php
$resultveri=$objorden->mustraestadodeunaorden($codigonuevo);
    $filveri=mysqli_fetch_object($resultveri);

    $resultprepre=$objorden->mostrarSugerenciaPre_presupuestodeOrden($codigonuevo);
    $filpre_pre=mysqli_fetch_object($resultprepre);
  /*preguntamos si el estado de la orden es igual a pre-presupuestada */
    if ($filveri->estado_orden=='Pre-presupuestada') 
    {
      $detallePresupuesto=$filpre_pre->sugerencia_presupuesto;
    }
    else /*por falso mostramos el detalle de presupuesto de la tabla presupuesto*/
    {
      $detallePresupuesto=$filpre->detalle_presupuesto;
    }
?>
<!--tabla para asignar presupuesto-->
  <table id="customers">
    <tbody>
      <tr>
        <td colspan="3">
          <div class="orden">
      <textarea name="texteditor" cols="30"  rows="5" class="tinymce" id="texteditor" > <?php echo $detallePresupuesto; ?> </textarea>
          </div>
       </td>

       <textarea style="display: none;" id="textdetallepresusolotexto" name="textdetallepresusolotexto" ></textarea>
      </tr>
      <?php
        if ($filpre->id_presupuesto==null)
        {
          $parteentera=00;
          $decimalentero=00;
        }
        else
        {
       /*AQUI SEPARAREMOS EL PRESUPUESTO LA PARTE ENTERA Y PARTE DECIMAL*/
        $parteentera= intval($filpre->monto_presupuesto);/*parte entera*/
        /*desde aqui se saca la parte decimal para hacerlo entero*/
        $aux = (string) $filpre->monto_presupuesto;
        $decimalpuro = substr( $aux, strpos( $aux, "." ) );
        $decimalentero= $decimalpuro*100;
        }
      ?>
      <td>DEFINIR PRESUPUESTO (Bs)</td>
      <td><input style="width: 100px" type="number" required="" class="form-control" name="montop" id="montop" value="<?php echo $parteentera; ?>" >
          <input style="width: 100px" type="number" required="" class="form-control" name="montodecimal" id="montodecimal" value="<?php echo $decimalentero; ?>" ></td>
      <!--<td style="text-align: left;">-->
      <!--<input type="checkbox" name="" >Notificar  al  procurador  via  SMS-->
      <!--<br>-->
      <!--<input type="checkbox" name="" >Notificar al procurador via whatssap-->
      <!--<br>-->
      <!--<input type="checkbox" name="checkemail" id="checkemail" >Notificar al procurador via @mail-->
      <!--<br>-->

      <!--</td>-->
      <tr>
        
      </tr>
    </tbody>
  </table>
           <?php
           if ($filpre->id_presupuesto==null) 
           {
             echo '<input type="submit" value="APLICAR" name="btnpresupuestar" onclick="escribirolotexto()" id="btnpresupuestar"> ';
           }
           else
           {
            echo '<input type="submit" value="MODIFICAR PRESUPUESTO" name="btnmodificarpresu" onclick="escribirolotexto()" id="btnmodificarpresu"> ';
           }


           
           ?>
           
</form>
</section>

<script type="text/javascript">
  function escribirolotexto()
  {
    var detallepre= tinymce.get('texteditor').contentDocument.activeElement.innerText;
    
      $('#textdetallepresusolotexto').val(detallepre);
  }
</script>

    </div>

    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>

<script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/init-tinymce.js"></script>
</body>
</html>

<script type="text/javascript">
function validarForm(formulario) {
  if(formulario.montodecimal.value.length>2) { //comprueba que no esté vacío
    formulario.montodecimal.focus();   
    alert('Solo Se permite Hasta 2 decimales'); 
    return false; //devolvemos el foco
   }

   if(formulario.montodecimal.value<0) { //comprueba que no esté vacío
    formulario.montodecimal.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

   if(formulario.montop.value<0) { //comprueba que no esté vacío
    formulario.montop.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>
