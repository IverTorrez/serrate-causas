<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR MAESTRO*/
if(!isset($_SESSION["procuradormaestro"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procuradormaestro"];

include_once('../model/clsordengeneral.php');

$cod=$_GET['squart'];
//SE DESENCRIPTA EL CODIGO PARA PODER USARLO //

$decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/1020304050;


?>

<!DOCTYPE html>
<html>
<head>
    <title>Descarga</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
</head>

<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsconfirmacion.php');
include_once('../controller/control-descargaproc.php');

/*$objordees=new OrdenGeneral();
$resuloo=$objordees->mustraestadodeunaorden($codigonuevo);
$files=mysqli_fetch_object($resuloo);
if ($files->estado_orden=='Descargada' or $files->estado_orden=='Serrada' or $files->estado_orden=='PronuncioContador' or $files->estado_orden=='PronuncioAbogado') 
{
    echo '<script type="text/javascript">
    javascript:window.history.back();
  </script>';
}

echo $files->estado_orden; */




$cod=$_GET['squart'];
//SE DESENCRIPTA EL CODIGO PARA PODER USARLO //

$decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/1020304050;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausadeorden($codigonuevo);
   $fil=mysqli_fetch_object($resul);
 //   echo "<td style='width: 10%;'>$fil->codigo</td>";
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
                 <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador Maestro</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="pm_mis_causa.php"  class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
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
    
    
      <?php
     include_once('../model/clsprocurador.php');
     
    ?>
    <div class="container">
   <section>

<div class="container" id="divform">

<!--<form method="POST" onsubmit="return validarForm(this);">-->

<input type="hidden" name="textencrip" id="textencrip" value="<?php echo $cod; ?>">

<input type="hidden" name="textidorden" id="textidorden" value="<?php echo $codigonuevo; ?>">
<b><h3 class="titulo">INGRESO DE DESCARGA </h3></b><br><br>
<?php
$objord=new OrdenGeneral();
$list=$objord->mostrarinformacionparadescarga($codigonuevo);
$fil=mysqli_fetch_object($list); 

?>

<table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>INFORMACION</h3></td>
    </tr>
  </tbody>
</table><br>
  <?php
   echo "<strong>CARGA DE INFORMACION:</strong>$fil->informacion";
  ?>
    <div class="orden">
      <textarea name="textdescargainf" cols="30" rows="5" class="tinymce" id="textdescargainf"></textarea>
    </div>

    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DOCUMENTACION</h3></td>
    </tr>
  </tbody>
</table><br>
     <?php
   echo "<strong>CARGA DE DOCUMENTACION:</strong>$fil->documentacion";
  ?>
    <div class="orden">
      <textarea name="textdescargadoc" cols="30" rows="5" class="tinymce" id="textdescargadoc"></textarea>
    </div>
    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DETALLE DE PRESUPUESTO</h3></td>
    </tr>
  </tbody>
</table>
<br>
<?php
   echo "<strong>DETALLE DE PRESUPUESTO:</strong>$fil->detalle_presupuesto";

   $ojorden=new OrdenGeneral();
   $resulord=$ojorden->mostraridcausadeunaorden($codigonuevo);
   $filidcausa=mysqli_fetch_object($resulord); 
   $idcausa=$filidcausa->id_causa;

   $objdescar=new DescargaProcurador();
   $resulultfoja=$objdescar->mostarultimafojaDeCausa($idcausa);
   $filultfoja=mysqli_fetch_object($resulultfoja);

   $ultimafoja=$filultfoja->ultima_foja;

  ?>
    <div class="orden">
      <textarea name="textdetallegasto" cols="30" rows="5" class="tinymce" id="textdetallegasto"></textarea>
    </div>
    <br>
    <div class="orden">
      <table >
      <tbody>
         <tr>
           <td>Ultima Foja: <?php echo $ultimafoja; ?> </td>

         </tr>

         <tr>
          <td width="400px"> <h3 style="text-align: left;"  class="titulo">FOJA</h3></td>
          <td width="35%"></td>
          <td width="35%"><h3 style="text-align: left;"  class="titulo">GASTO</h3></td>
       </tr>

       <tr>
         <td><input type="text" name="textfoja" style="width: 100%;" id="textfoja" placeholder="Foja" autocomplete="off" required="" value="<?php echo $ultimafoja; ?>"></td>
         <td style="text-align: right;"> <?php
         echo "<strong>PRESUPUESTO DE CARGA EN Bs. :</strong>$fil->monto_presupuesto";
        ?></td>
         <td> <input type="number" name="textgasto" autocomplete="off" style="width: 30%;" id="textgasto" placeholder="Gasto" required="" value="00">
               <input type="number" name="textgastodecimal" autocomplete="off" style="width: 30%;" id="textgastodecimal" placeholder="Gasto" required="" value="00"></td>
       </tr>
      </tbody>
    </table>
    </div>
      <br>
      
     
           
               <input type="submit" name="btndescarga" @click="insertarDescarga()" id="btndescarga" value="PROCESAR">
               <center>  <div id="cargar"> <div ><img src="../cargando.gif" style="width: 50px;height: 50px"></div></div></center>
             


           
      
   <!-- </form>-->
    </div><br><br>
</section>


 

            
          
<script type="text/javascript" src="../resources/jquery.js"></script>

 <script type="text/javascript" src="../js/vuejs/vue.js"></script>
<script type="text/javascript" src="../js/axios/axios.min.js"></script>

  <!-- javascript -->
    <script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/init-tinymce.js"></script>
   
</body>
</html>


<script type="text/javascript">
function validarForm(formulario) {
  if(formulario.textgastodecimal.value.length!=2) { //comprueba que no esté vacío
    formulario.textgastodecimal.focus();   
    alert('Tienes que Colocar 2 decimales'); 
    return false; //devolvemos el foco
   }

   if(formulario.textgastodecimal.value<0) { //comprueba que no esté vacío
    formulario.textgastodecimal.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

   if(formulario.textgasto.value<0) { //comprueba que no esté vacío
    formulario.textgasto.focus();   
    alert('No Puede Colocar Numeros Negativos'); 
    return false; //devolvemos el foco
   }

  return true;
}
</script>















<script type="text/javascript">
 $('#cargar').hide();
   var app=new Vue({
    el: '#divform',
    data:{
        idorden:0,
        informacion:'',
        documentacion:'',
        detallegasto:'',
        foja:'',
        gasto:'',
        gastodecimal:'',

       /* selectproc:0,
        selectprioridad:0,
        idcausa:0,
        fechainicio:'',
        horainicio:'',
        fechafinal:'',
        horafinal:'',*/

        codencriptado:'',

        visibleboton:true,
    },

    methods:{
      insertarDescarga(){
          $('#btndescarga').hide();
          
           $('#cargar').show();
          
          let me=this;
          me.informacion='';
          me.idorden=document.getElementById('textidorden').value;


          me.foja=document.getElementById('textfoja').value;
          me.gasto=document.getElementById('textgasto').value;
           me.gastodecimal=document.getElementById('textgastodecimal').value;
         // var content = tinymce.get('texteditorinformacion').contentDocument.documentElement.innerHTML;

        /* let editinfovacio = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerText;
          let editdocvacio = tinymce.get('texteditordocum').contentDocument.activeElement.innerText;*/
          let infsolotexto = tinymce.get('textdescargainf').contentDocument.activeElement.innerText;
          let docsolotexto = tinymce.get('textdescargadoc').contentDocument.activeElement.innerText;
          let detgastosolotexto = tinymce.get('textdetallegasto').contentDocument.activeElement.innerText;

          me.infosolotexto=infsolotexto;
          me.docusolotexto=docsolotexto;
          me.detallegastosolotexto=detgastosolotexto;



           let editinfo = tinymce.get('textdescargainf').contentDocument.activeElement.innerHTML;
           me.informacion=editinfo;

          let editdoc = tinymce.get('textdescargadoc').contentDocument.activeElement.innerHTML;
          me.documentacion=editdoc;

          let editdetgasto = tinymce.get('textdetallegasto').contentDocument.activeElement.innerHTML;
          me.detallegasto=editdetgasto;

         let cadena=new FormData();
         cadena.append("textidorden",this.idorden);
          cadena.append("textdescargainf",this.informacion);
          cadena.append("textdescargadoc",this.documentacion);
           cadena.append("textdetallegasto",this.detallegasto);
           cadena.append("textfoja",this.foja);
           cadena.append("textgasto",this.gasto);
           cadena.append("textgastodecimal",this.gastodecimal);

           cadena.append("infosolotexto",this.infosolotexto);
           cadena.append("docusolotexto",this.docusolotexto);
           cadena.append("detallegastosolotexto",this.detallegastosolotexto);

          axios.post("../controller/control-descargaprocajax.php?accion=crear",cadena)
          .then(function(response){
            var variable=response.data;
            var encrip=document.getElementById('textencrip').value;

            if (variable.error=='error2') 
            {
              $('#btndescarga').show();
          
               $('#cargar').hide();
               setTimeout(function(){ location.href='orden.php?squart='+encrip; }, 3000); swal('ATENCION','No se registro la descarga porque la orden ya fue descargada','warning');
            }
            else
            {
              if (variable.error=='error1') 
              {
                $('#btndescarga').show();
          
                   $('#cargar').hide();
                setTimeout(function(){  }, 2000); swal('ERROR',' No Se Descargo La Orden','warning');
              }
              else
              {
                if (variable.error=='false') 
                {
                  $('#btndescarga').hide();
                  setTimeout(function(){ location.href='orden.php?squart='+encrip; }, 2000); swal('ATENCION','Se Registro La Descarga Fuera Del Plazo De La Fecha Final','success');
                }
                else
                {
                   if (variable.error=='true') 
                   {
                    $('#btndescarga').hide();
                    setTimeout(function(){ location.href='orden.php?squart='+encrip; }, 2000); swal('EXELENTE','Se Registro La Descarga Con Exito','success');

                   }
                   else
                   {
                    if (variable.error=='negativo') 
                    {
                      $('#btndescarga').show();
          
                      $('#cargar').hide();
                      setTimeout(function(){  }, 2000); swal('ATENCION','No Puede Colocar Una Cantidad Menor A Cero','warning');
                    }
                   }
                   
                }
              }
            }




     

          });


         
      },
    }
   });
</script>

