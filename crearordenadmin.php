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
    <title>crear orden</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

     <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">
    <!--PLUGIN PARA EL NUEVO TEXTAREA-->
    <link rel="stylesheet" href="plugin-sceditor/sceditor-3.1.1/minified/themes/default.min.css" id="theme-style" />
	<script src="plugin-sceditor/sceditor-3.1.1/minified/sceditor.min.js"></script>
	<script src="plugin-sceditor/sceditor-3.1.1/minified/icons/monocons.js"></script>
	<script src="plugin-sceditor/sceditor-3.1.1/minified/formats/bbcode.js"></script>
  <!--FIN DE NUEVA LIBREARIA DEL NUEVO PLUGIN-->
  
</head>
<script type="text/javascript">
function validarForm(formulario) {
  if(formulario.nombre.value.length==0) { //comprueba que no esté vacío
    formulario.nombre.focus();   
    alert('No has escrito el campo demandante'); 
    return false; //devolvemos el foco
  }
  if(formulario.texteditor.value.length==0) { //comprueba que no esté vacío
    formulario.texteditor.focus();   
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
include_once('model/clscausa.php');
include_once('model/clsprioridad.php');
include_once('model/clsordengeneral.php');
include_once('model/clscotizacion.php');
include_once('model/clstribunal.php');

//include_once('controller/control-ordenadmin.php');



$codcausa=$_GET['squart'];
//SE DESENCRIPTA EL CODIGO PARA PODER USARLO //

$decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";
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

 
        <p id="codcausas"><?php echo $fil->codigo; ?> </p>
        
        <div id="main_menu">
        
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

            <div id="portfolio_menu">
                
                <ul>
                    <li><button class="botones" style="width: 220px; height: 45px;" onclick="location.href='listaordenes.php?squart=<?php echo $codcausa; ?>'">LISTA DE ORDENES</button></li>
                   
                 
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
            
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->
    
    
      <?php
     include_once('model/clsprocurador.php');
     
    ?>
    <div class="container">


   <section>

<div class="container" id="divform">
<input type="hidden" name="textcodencripcausa" id="textcodencripcausa" value="<?php echo $codcausa; ?>">

<!--<form method="POST" onsubmit="return validarForm(this);">-->

<input type="hidden" name="textidcausa" id="textidcausa" value="<?php echo $codigonuevo; ?>">
<h3 class="titulo">CARGA DE INFORMACIÓN Y DOCUMENTACIÓN </h3><br>

<h3><strong> ADVERTENCIA.-</strong> Lo que se escriba a continuación será visualizado por el cliente y por todos los demás usuarios de este Sistema. </h3>
<br>
<table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>INFORMACION</h3></td>
    </tr>
  </tbody>
</table>



    <div class="orden">
      <textarea name="texteditorinformacion" cols="30" rows="5" class="tinymce" id="texteditorinformacion"></textarea>
    </div><br>

    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DOCUMENTACION</h3></td>
    </tr>
  </tbody>
</table>

    
    <div class="orden">
      <textarea name="texteditordocum" cols="30" rows="5" class="tinymce" id="texteditordocum"></textarea>
    </div>

       <table id="customers">
               <thead>
                  <th>SUGIERA TRIBUNAL</th>
                 <th>SOLICITE PRIORIDAD</th>
                 <th >SOLICITE PROCURADOR GESTOR</th>
               </thead>
               <tbody>
               <tr>
<!-- COLUMNA PARA MOSTRAR LOS TRIBUNALES DISPONIBLES DISPONIBLES DE ESTA CAUSA -->
                 <td>
                  <select id="select_trib_causa" name="select_trib_causa">
                    <?php
                    $objtibunal=new Tribunal();
                    $listatrib=$objtibunal->listartribunalficha($codigonuevo);
                    while ($filtrib=mysqli_fetch_object($listatrib)) 
                    {
                    ?>
                      <option value="<?php echo $filtrib->tptribu; ?>"><?php echo $filtrib->tptribu; ?></option>
                    <?php
                    }

                    ?>
                    
                    <option value="Exteriores">Exteriores</option>
                  </select>
                </td>
<!-- COLUMNA PARA MOSTRAR LOS TRIBUNALES DISPONIBLES DISPONIBLES DE ESTA CAUSA -->
                 <td>
                     <select name="selectprioridad" id="selectprioridad">
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                 </select> 
                 </td>

                 <td> 
                 <select id="selectproc" name="selectproc">
                 <?php 
                  $objproc=new Procurador();
                  $result=$objproc->mostrarprocuradorpordefectodecausa($codigonuevo);
                  $fila=mysqli_fetch_array($result);
                  //antiguo  echo '<option value="'.$fila['idproc'].'">'.$fila['Nombre'].' '.$fila['Apellidos'].'--'.$fila['Tipo'].' (Por Defecto)'.'</option>';
                   echo '<option value="'.$fila['idproc'].'">'.$fila['Apellidos'].', '.$fila['Nombre'].' (Procurador Por Defecto)'.'</option>';
                  $objmat=new Procurador();
                  $liscat=$objmat->listarprocuradoresexeptouno($fila['idproc']);
                 while($cat=mysqli_fetch_array($liscat)){
                echo '<option value="'.$cat['idproc'].'">'.$cat['Apellidos'].', '.$cat['Nombre'].'</option>';
            //antiguo     echo '<option value="'.$cat['idproc'].'">'.$cat['Nombre'].' '.$cat['Apellidos'].'--'.$cat['Tipo'].'</option>';
                 }
                ?> 
                </select> </td>
                </tr>
               </tbody>
               </table><br>
               <h3><strong> NOTA.-</strong> La prioridad por defecto es la número “3”. El procurador por defecto es el escogido para este juicio. </h3><br>
               <h3><strong> ADVERTENCIA.-</strong> Al ingresar el plazo de vigencia de la presente orden, cerciórese de que las fechas escogidas sean fechas futuras. El sistema no aceptará fechas pasadas. Seleccione el plazo de vigencia de la orden:</h3><br>

               <?php
               ini_set('date.timezone','America/La_Paz');
               $fechahoy=date("Y-m-d");
               $horita=date("H:i");
               $concat=$fechahoy.' '.$horita;
               //echo $concat;
               ?>

               
              <table id="customers"> 
              <tbody>

                 <tr style="background: #ffffff;">
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="fechainicio" id="fechainicio" value="<?php echo $fechahoy; ?>" > <i class="fa fa-calendar fa-2x" aria-hidden="true"></i> </td>
                   <td>Hora Inicio<input type="time" name="horainicio" id="horainicio" value="<?php echo $horita; ?>" > <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>

                   <!--<td rowspan="2" width="20%" style="text-align: left;" > -->
                   <!--   <input type="checkbox" name="" >Notificar  al  procurador  via  SMS-->
                   <!--   <br>-->
                   <!--   <input type="checkbox" name="" >Notificar al procurador via whatssap-->
                   <!--   <br>-->
                   <!--   <input type="checkbox" name="" >Notificar al procurador via @mail-->
                   <!--   <br>  -->
                   <!--   </td>-->
                  
                 </tr>
 
                  <tr style="background: #ffffff;">
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="fechafinal" id="fechafinal" value="<?php echo $fechahoy; ?>"> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora Final  <input type="time" name="horafinal" id="horafinal" value="<?php echo $horita; ?>"> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></td>
                 
                 </tr>
                 </tbody>
              </table>
               

              
      
      
     
           
               <input type="submit" name="btnguardarorden"  @click="insertarOrden()" id="btnguardarorden" value="PROCESAR">
               <center>  <div id="cargar"> <div ><img src="cargando.gif" style="width: 50px;height: 50px"></div></div></center>
               
          
      
   <!-- </form>-->
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
 

 <script type="text/javascript" src="js/vuejs/vue.js"></script>
<script type="text/javascript" src="js/axios/axios.min.js"></script>          
          
<script type="text/javascript" src="resources/jquery.js"></script>
  <!-- javascript -->
    <script type="text/javascript" src="resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/init-tinymce.js"></script>
   
</body>
</html>



<script type="text/javascript">
 $('#cargar').hide();
   var app=new Vue({
    el: '#divform',
    data:{
        informacion:'',
        documentacion:'',
        selectproc:0,
        selectprioridad:0,
        idcausa:0,
        fechainicio:'',
        horainicio:'',
        fechafinal:'',
        horafinal:'',

        codencriptado:'',

        visibleboton:true,
        lugar_ejecucion:'',
    },

    methods:{
      insertarOrden(){
           $('#btnguardarorden').hide();
          
           $('#cargar').show();
          
          let me=this;
          me.informacion='';
          me.idcausa=document.getElementById('textidcausa').value;
          me.selectprioridad=document.getElementById('selectprioridad').value;
          me.selectproc=document.getElementById('selectproc').value;

          me.fechainicio=document.getElementById('fechainicio').value;
          me.horainicio=document.getElementById('horainicio').value;

          me.fechafinal=document.getElementById('fechafinal').value;
          me.horafinal=document.getElementById('horafinal').value;
/*CARGAMOS EN LA VARIABLE lugar_ejecucion, el tipo de tribunal=====================*/
          me.lugar_ejecucion=document.getElementById('select_trib_causa').value;
         // var content = tinymce.get('texteditorinformacion').contentDocument.documentElement.innerHTML;
         let infosolotexto = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerText;
         let docsolotexto = tinymce.get('texteditordocum').contentDocument.activeElement.innerText;
         me.solotextoinfo=infosolotexto;
         me.solotextodoc=docsolotexto;

        /* let editinfovacio = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerText;
          let editdocvacio = tinymce.get('texteditordocum').contentDocument.activeElement.innerText;*/

           let editinfo = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerHTML;
          me.informacion=editinfo;
          let editdoc = tinymce.get('texteditordocum').contentDocument.activeElement.innerHTML;
          me.documentacion=editdoc;
/*======================CARGA CON NUEVO PLUGIN==========================================*/         
    /*SE CARGA LA INFORMACION HTML CON EL NUEVO PLUGINS*/
          /* var infocarga=  sceditor.instance(texteditorinformacion).val(true);
               infocarga= infocarga.replace(/[[]/ig, '<');
          var   infoHtml=infocarga.replace(/]/ig, '>');
          me.informacion=infoHtml;*/
    /*FIN DE CARGA LA INFORMACION HTML CON EL NUEVO PLUGINS*/
        /*CARGA DE INFO SOLO TEXTO*/
        /*var textinfo= infoHtml.replace( /(<([^>]+)>)/ig, '');
        me.solotextoinfo=textinfo;*/
        /*FIN DE CARGA DE SOLO TEXTO*/

   /*===============CARGA DOCUMENTACION===========================*/
   /* var doccarga=  sceditor.instance(texteditordocum).val(true);
               doccarga= doccarga.replace(/[[]/ig, '<');
          var   docHtml=doccarga.replace(/]/ig, '>');
          me.documentacion=docHtml;*/
  /*CARGA DE doc SOLO TEXTO*/
      /*  var textdoc= docHtml.replace( /(<([^>]+)>)/ig, '');
        me.solotextodoc=textdoc;*/
        
/*=====================FIN DE CARGA CON NUEVO PLUGIN====================================================*/          

         let cadena=new FormData();
          cadena.append("texteditorinformacion",this.informacion);
          cadena.append("texteditordocum",this.documentacion);
          cadena.append("selectprioridad",this.selectprioridad);
          cadena.append("selectproc",this.selectproc);
          cadena.append("textidcausa",this.idcausa);

          cadena.append("fechainicio",this.fechainicio);
          cadena.append("horainicio",this.horainicio);
          cadena.append("fechafinal",this.fechafinal);
          cadena.append("horafinal",this.horafinal);

          cadena.append("solotextoinfo",this.solotextoinfo);
          cadena.append("solotextodoc",this.solotextodoc);
/*MANDAMOS AL CONTROLADOR , EL lugar_ejecucion======================*/
          cadena.append("lugar_ejecucion",this.lugar_ejecucion);

          axios.post("controller/control-regordenadminajax.php?accion=crear",cadena)
          .then(function(response){
            var variable=response.data;
            var encrip=document.getElementById('textcodencripcausa').value;

            if (variable.error=='error3') 
            {
              $('#btnguardarorden').show();
                 $('#cargar').hide();
               setTimeout(function(){ }, 2000); swal('ERROR',' Complete todos los campos de fechas y horas','warning');
            }
            else
            {
              if (variable.error=='error2') 
              {
                $('#btnguardarorden').show();
                 $('#cargar').hide();
                setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora Inicio deben ser mayores a la Fecha y Hora actual','warning');
              }
              else
              {
                if (variable.error=='error1') 
                {
                  $('#btnguardarorden').show();
                 $('#cargar').hide();
                  setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora  Final deben ser mayores a Fecha y Hora inicio ','warning');
                }
                else
                {
                   if (variable.error=='false') 
                   {
                    $('#btnguardarorden').show();
                   $('#cargar').hide();
                    setTimeout(function(){ }, 2000); swal('ERROR','No Se Creo La Orden ','warning');
                   }
                   else
                   {
                    if (variable.error=='true') 
                    {
                     // this.visibleboton=false;

                     // $('#btnguardarorden').hide();


                 /* Swal.fire({

                  position: 'center',
                  type: 'success',
                  title: 'Se Guardo Correctamente',
                  showConfirmButton: false,
                  timer: 1500
                  })*/

                  //alert(editinfovacio);

                  setTimeout(function(){ location.href='listaordenes.php?squart='+encrip }, 2000); swal('EXELENTE','La Orden Se Creo Exitosamente','success'); 
                    }
                   }
                }
              }
            }




        /*  if(variable.error=='true')
          {

            this.visibleboton=false;

            $('#btnguardarorden').hide();


         /* Swal.fire({

          position: 'center',
          type: 'success',
          title: 'Se Guardo Correctamente',
          showConfirmButton: false,
          timer: 1500
          })*/

       /*   setTimeout(function(){ location.href='listaorden.php?squart='+encrip }, 2000); swal('EXELENTE','La Orden Se Creo Exitosamente','success'); 
        }/*fin del if que pregunta si se guardo la orden*/
      /*  else
        {
           setTimeout(function(){ }, 2000); swal('ERROR','No Se Creo La Orden ','warning');
        }/*fin del else cuando no se guardo la orden*/




          });


         
      },
    }
   });
</script>

<script>
	/*		var textarea = document.getElementById('texteditorinformacion');
			sceditor.create(textarea, {
				format: 'bbcode',
				icons: 'monocons',
				style: 'plugin-sceditor/sceditor-3.1.1/minified/themes/content/default.min.css'
			});*/


			
   /*inicializacion para documentacion*/
    /*  var textareadoc = document.getElementById('texteditordocum');
      sceditor.create(textareadoc, {
        format: 'bbcode',
        icons: 'monocons',
        style: 'plugin-sceditor/sceditor-3.1.1/minified/themes/content/default.min.css'
      });

      var themeInput = document.getElementById('theme');
      themeInput.onchange = function() {
        var theme = 'plugin-sceditor/sceditor-3.1.1/minified/themes/' + themeInput.value + '.min.css';

        document.getElementById('theme-style').href = theme;
      };*/

		</script>