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
    <title>Planilla Notificacion</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->

    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">


<script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script>-->
      <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
   <!--jquery -->
    

</head>
<body>
<?php

include_once('model/clsplanilla_notificacion.php');

 
//include_once('controller/control-usuarios.php');
///incluimos el archivo donde esta el modal para guardar la ubicacion
//include_once('modal/modal_ubicacion.php');

$tituloform='<h3  class="titulo">CREACIÓN DE PLANTILLA DE NOTIFICACIÓN</h3>';/*TITULO POR DEFECTO*/
$codplanilla=$_GET['squart'];
$decodificado=base64_decode($codplanilla);
$codigonuevo_plan=$decodificado/1234567;

$variableenabled="enabled";/*VARIABLE QUE EMPIEZA ABILITANDO EL SELECT*/
$valorchequed=null;


if ($codigonuevo_plan>0) {
  /*SE EJECUTA CUANDO ES USUARIO ES DE LA TABLA USUARIO*/
    $objplanilla=new Planillas_envio_notificacion();
    $resulpla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa($codigonuevo_plan);
    $filpla=mysqli_fetch_object($resulpla);

    $cod_planilla=$filpla->cod_planilla;
    $tipo_notifi=$filpla->tipo_notificacion;
    $evento=$filpla->evento;
    $emisor=$filpla->emisor;
    $tipo_receptor=$filpla->tipo_dinamico_estatico;
    $receptor_estatico=$filpla->receptor_estatico;
    $descripcion_receptor=$filpla->descripcion_receptor;
    $asunto=$filpla->asunto;
    $envia_notificacion=$filpla->envia_notif;
    $texto_notificacion=$filpla->texto;
    $nombre_emisor=$filpla->nombre_emisor;
   
    $tituloform='<h3  class="titulo">MODIFICAR DE PLANILLA</h3>';
    
    if ($envia_notificacion==2) //si la plantilla no envia notificacion, chequeamos como inactivo
    {
      $valorchequed='checked=""';
    }

   
   
}/*FIN DEL IF*/


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
               

                 <li  class="" style="float: left; margin: 0 14px; width: 445px; color: black;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
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

    <!--FORMULARIO REGISTRO USUARIOS-->
   <div id="divmodusuarios">
    <!--Campos para los select de la planilla para modificar (solo son para ayuda)-->
     <input type="hidden" name="text_tiponot" id="text_tiponot" value="<?php echo $tipo_notifi; ?>">
     <input type="hidden" name="text_tiporeceptor" id="text_tiporeceptor" value="<?php echo $tipo_receptor; ?>">

    <div class="container" id="divformusuarios">
    <?php echo $tituloform; ?>
  <button style="width: 200px;" class="botones" onclick="location.href='planilla_notificaciones.php'">NUEVO</button>
  <input type="hidden" name="textidusuario" id="textidusuario" placeholder="id usuario" value="<?php echo $datos['id_usuario']; ?>">
  
   <div class="orden">
       <label>CÓDIGO </label>
       <input style="background: #DED8D6;" type="text" id="textcodigoplanilla"  name="textcodigoplanilla" autocomplete="off" readonly="" placeholder="Código de planilla" required="required" value="<?php echo $cod_planilla; ?>" >
    </div>

    <div class="orden">
       <label>TIPO DE NOTI. *</label>
       <select id="selecttpnotif" name="selecttpnotif" onchange="ponerSoloLecturaEmisorCasoSeaNotPush();">
         <option value="1" >CORREO</option>
         <option value="2" >NOTIFICACIÓN PUSCH</option>
        
       </select>
    </div>

    <div class="orden">
       <label>EVENTO *</label>
       <input type="text" id="texteventonotif"  name="texteventonotif" autocomplete="off" placeholder="Evento de la notificación" required="required" value="<?php echo $evento; ?>">
    </div>
    <div class="orden">
       <label>EMISOR *</label>
       <input type="text" id="textemisornotif"  name="textemisornotif" autocomplete="off" placeholder="Emisor de la notificación Ej. ejemplo@correo.com" required="required" value="<?php echo $emisor; ?>">
    </div>
    <div class="orden">
       <label>NOMBRE EMISOR *</label>
       <input type="text" id="textnombreemisor"  name="textnombreemisor" autocomplete="off" placeholder="Nombre de emisor" required="required" value="<?php echo $nombre_emisor; ?>">
    </div>

    <div class="orden">
       <label>TIPO DE RECEPTOR *</label>
       <select id="selecttpreceptor" name="selecttpreceptor" onchange="ponerSoloLecturaReceptEstatico();">
         <option value="1">DINÁMICO</option>
         <option value="2">ESTÁTICO</option>        
       </select>
    </div>

    <div class="orden">
       <label>RECEPTOR ESTÁTICO *</label>
       <input type="text" id="textreceptorestatico"  name="textreceptorestatico" autocomplete="off" placeholder="Receptor Ej. ejemplo@correo.com" required="required" value="<?php echo $receptor_estatico; ?>">
    </div>

    <div class="orden">
       <label>DESCRIPCIÓN RECEPTOR *</label>
       <input type="text" id="textdescriprecept"  name="textdescriprecept" autocomplete="off" placeholder="Descripción de receptor" required="required" value="<?php echo $descripcion_receptor; ?>">
    </div>

    <div class="orden">
       <label>ASUNTO *</label>
       <input type="text" id="textasunto"  name="textasunto" autocomplete="off" placeholder="Asunto de la notificación" required="required" value="<?php echo $asunto; ?>">
    </div>

    
    
    <div class="orden">
        <label for="country">ENVIA NOTI.<p style="font-size: 13px;">(ACTIVO/INACTIVO)</p></label>
        <input type="checkbox" class="flipswitch" id="checkenvianotif" name="checkenvianotif" <?php echo $valorchequed; ?> >  
        <span></span>   
    </div>

    


    <div class="orden">
       <label>TEXTO <p style="font-size: 13px;">Colocar &lt;br&gt; para un salto de línea, los datos que seran autoconpletados poner entre corchetes [ ] </p></label>
            <textarea style="min-height: 120px; max-width: 600px; min-width: 600px;"  id="text_textonotif" name="text_textonotif" autocomplete="off" placeholder="Escriba el texto de la notificación"><?php echo $texto_notificacion; ?></textarea>

    </div>

  <?php
  if ($cod_planilla!=null) {
    echo '<input type="submit" value="MODIFICAR" id="btnmodpla" @click="insertarPlanilla=false;modificarPlanilla()" name="btnmodpla">';
  }
  else
  {
    echo '<input type="submit" value="GUARDAR" id="btnguardarusu" @click="insertarPlanilla()" name="btnguardarusu">';
  }
  ?>
 
    
 <center>  <div id="cargar"> <div ><img src="cargando.gif" style="width: 50px;height: 50px"></div></div></center>

  
 <!-- </form>-->

  </div>

  </div> 




<div class="container">
   <section>
 <table id="customers">
 <thead>     
  <tr>
    <th width="5%">COD.</th>
    <th>TIPO NOT.</th>
    <th width="5%">EVENTO DE ENVIO</th>
    <th>EMISOR</th>
    <th>NOMBRE EMISOR</th>
    <th>TIPO RECEPTOR</th>
    <th>RECEPTOR ESTÁTICO</th>
    <th>DESC. RECEPTOR</th>
    <th  width="5%">ASUNTO</th>
    <th >ENVIA NOT.?</th> 
    <th>TEXTO</th>  
    <th></th>

  </tr>
</thead>
<tbody>
  <?php
   $obplan=new Planillas_envio_notificacion();
   $resulm=$obplan->listarPlanillas_envioNotif_activas();
   while ($fil=mysqli_fetch_object($resulm)) {
         if ($fil->envia_notificacion=='No') {
           $colorbackgroun='#A29E9C ';
         }
         else
         {
          $colorbackgroun='none';
         }
         $search = array('[nombreapellidoabogado]', 
                         '[codigocausa]', 
                         '[nombrecausa]', 
                         '[nombreapellidoprocurador]');
         $replace = array('Luis Gustavo',
                          'K-CAUSITA-12',
                          'Pension para niño',
                          'Cristina castro');

         $textomodificado=str_replace($search,$replace, $fil->texto);
       echo "<tr style='background-color: $colorbackgroun;'>";
            $mascara=$fil->cod_planilla*1234567;
            $encriptado=base64_encode($mascara);
              echo "<td><a href='planilla_notificaciones.php?squart=$encriptado'>$fil->cod_planilla</a></td>";
              echo "<td>$fil->tipo_notifi</td>";
              echo "<td style='text-align: left;'>$fil->evento</td>";
              echo "<td style='text-align: left;'>$fil->emisor</td>";
              echo "<td style='text-align: left;'>$fil->nombre_emisor</td>";
              echo "<td style='text-align: left;'>$fil->tipo_dinamico_est</td>";
              echo "<td style='text-align: left;'>$fil->receptor_estatico</td>";
              echo "<td style='text-align: left;'>$fil->descripcion_receptor</td>";
              echo "<td style='text-align: left;'>$fil->asunto</td>";
              echo "<td>$fil->envia_notificacion</td>";
              echo "<td style='text-align: left;'>$fil->texto</td>";                          
              echo "<td><a onclick='funcionllevaidmodal($fil->cod_planilla)'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> </td>";
        echo "<tr>";
          }
  ?>
</tbody>
</table>
</section>
</div><!--fin container-->
<br>

 <script type="text/javascript" src="js/vuejs/vue.js"></script>
 <script type="text/javascript" src="js/vuejs/vue.min.js"></script>

<script type="text/javascript" src="js/axios/axios.min.js"></script>

<script type="text/javascript" src="resources/jquery.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>



<!-- The Modal (FORMULARIO) PARA eliminar(dar de baja) un tribunal o juzgado -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content" id="diveliminarplanilla">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">ITECH</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ELIMINAR PLANILLA</p> </center>
     </div><br>
    
    <div class="modal-body">
      
    <b>  Se eliminara la planilla: <m id="mtexto" name ="mtexto"> </m></b><br>
    <input type="hidden" name="textidusuariobaja" id="textidusuariobaja" placeholder="id usuario" value="<?php echo $datos['id_usuario']; ?>">
        <input type="hidden" class="textform" id="textcodplanilla" name="textcodplanilla" placeholder="cod planilla" required><br>
                                      
    </div>
    <div class="modal-footer">
     <input style="background: #1A5895;" type="button" class="btnclose" id="btneliminarplanilla" name="btneliminarplanilla" @click="eliminarPlanilla()" value="Eliminar">

     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Cancelar</button>
     </div>  
  </div>
</div>

</body>
</html>



<script type="text/javascript">

    

$('#cargar').hide();
   var app=new Vue({
    el: '#divformusuarios',
    data:{
        
    },

    methods:{
      insertarPlanilla:function(){
          
          $('#btnguardarusu').hide();
          
           $('#cargar').show();
          let formdata=new FormData()
         // formdata.append("selecttpusu",document.getElementById("selecttpusu").value)

          var Cheq1=document.getElementById("checkenvianotif").checked
          if (Cheq1==false) 
          {
            formdata.append("checkenvianotif",'null')
          }
          else
          {
            if (Cheq1==true) 
            {
              formdata.append("checkenvianotif",'true')
            }
          }
          
          //formdata.append("textcodigoplanilla",document.getElementById("textcodigoplanilla").value)
          formdata.append("textidusuario",document.getElementById("textidusuario").value)
          formdata.append("selecttpnotif",document.getElementById("selecttpnotif").value)
          formdata.append("texteventonotif",document.getElementById("texteventonotif").value)
          formdata.append("textemisornotif",document.getElementById("textemisornotif").value)
          formdata.append("textnombreemisor",document.getElementById("textnombreemisor").value)
          formdata.append("selecttpreceptor",document.getElementById("selecttpreceptor").value)
          formdata.append("textreceptorestatico",document.getElementById("textreceptorestatico").value)
          formdata.append("textdescriprecept",document.getElementById("textdescriprecept").value)
          formdata.append("textasunto",document.getElementById("textasunto").value)
          formdata.append("text_textonotif",document.getElementById("text_textonotif").value)
        // alert(document.getElementById("textdescriprecept").value);
        //  var Cheq=document.getElementById("checkenvianotif").checked
          

          axios.post("controller/control-planilla-notificacion.php?accion=crear",formdata)
          .then(function(response){
           
            console.info(response);
            var variable=response.data;
            switch (variable.error) {
              case 'password':
                        $('#btnguardarusu').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña','info');
                        break;
             case 'true':
                        setTimeout(function(){ location.href='planilla_notificaciones.php' }, 2000); swal('EXELENTE','Se creo la planilla con exito','success');  
                        break;
             case 'false':
                        $('#btnguardarusu').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ERROR','No se registro la planilla','error');
                        break;
             case 'vacio':
                        $('#btnguardarusu').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ERROR','Complete todos los campos con asterisco (*) ','warning');
                        break;
              default:
                    setTimeout(function(){  }, 2000); swal('ERROR','No se tuvo ninguna respuesta','warning');                      
          }//fin del switch
            
          });
    
      },

      /*************************nueva funcion****************************/
      modificarPlanilla:function(){
          $('#btnmodpla').hide();
          
           $('#cargar').show();
          
          let formdata=new FormData()

          var Cheq1=document.getElementById("checkenvianotif").checked
          if (Cheq1==false) 
          {
            formdata.append("checkenvianotif",'null')
          }
          else
          {
            if (Cheq1==true) 
            {
              formdata.append("checkenvianotif",'true')
            }
          }
          
          formdata.append("textcodigoplanilla",document.getElementById("textcodigoplanilla").value)
          formdata.append("textidusuario",document.getElementById("textidusuario").value)
          formdata.append("selecttpnotif",document.getElementById("selecttpnotif").value)
          formdata.append("texteventonotif",document.getElementById("texteventonotif").value)
          formdata.append("textemisornotif",document.getElementById("textemisornotif").value)
          formdata.append("textnombreemisor",document.getElementById("textnombreemisor").value)
          formdata.append("selecttpreceptor",document.getElementById("selecttpreceptor").value)
          formdata.append("textreceptorestatico",document.getElementById("textreceptorestatico").value)
          formdata.append("textdescriprecept",document.getElementById("textdescriprecept").value)
          formdata.append("textasunto",document.getElementById("textasunto").value)
          formdata.append("text_textonotif",document.getElementById("text_textonotif").value)
          

          axios.post("controller/control-planilla-notificacion.php?accion=modificar",formdata)
          .then(function(response){
           
            console.info(response);
            var variablem=response.data;

            switch (variablem.error) {
              case 'datosiguales':
                        $('#btnmodpla').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ATENCION','No existen modificaciones','info');
                        break;
             case 'true':
                        setTimeout(function(){ location.href='planilla_notificaciones.php' }, 2000); swal('EXELENTE','Se modifico la planilla con exito','success');  
                        break;
             case 'false':
                        $('#btnmodpla').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ERROR','No se modifico la planilla','error');
                        break;
             case 'vacio':
                        $('#btnmodpla').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ERROR','Complete todos los campos con asterisco (*) ','warning');
                        break;
              case 'errorupdate':
                        $('#btnmodpla').show();
                        $('#cargar').hide();
                        setTimeout(function(){  }, 2000); swal('ERROR','Ocurrio un error al modificar el registro','warning');
                        break;
              default:
                    setTimeout(function(){  }, 2000); swal('ERROR','No se tuvo ninguna respuesta','warning');                      
          }//fin del switch

           // setTimeout(function(){  }, 2000); swal('','Debe usar otra Contraseña','error');
        
    

          });


         
      },
      /*hasta aqui lafuncion editar**/

     

    }
   });
</script>





<script type="text/javascript">

  var cod_planilla= document.getElementById("textcodigoplanilla").value;
   if (cod_planilla>0) 
   {
     var tipoNotifi= document.getElementById("text_tiponot").value;
     var tipoRecept= document.getElementById("text_tiporeceptor").value;
     $('#selecttpnotif').val(tipoNotifi);
     $('#selecttpreceptor').val(tipoRecept);

   }

  ponerSoloLecturaReceptEstatico();
  function ponerSoloLecturaReceptEstatico()
     {
       var tipo_receptor= document.getElementById("selecttpreceptor").value
        if (tipo_receptor==1) //si estaseleccionado Dinamico (1), el campo se hace de solo lectura y no de escritura
        {
          document.getElementById("textreceptorestatico").readOnly = true; // o solo lectura
          $('#textreceptorestatico').val('');

          //Cambiams el color del boton a opaco
        const receptor = document.getElementById("textreceptorestatico"); 
        receptor.style.backgroundColor = "#DED8D6";
            // boton.addEventListener("click", ()=>{ boton.style.color = "white"; boton.style.backgroundColor = "green"; });

        }
        else //por falso , el campo se hace de escritura
        {

          document.getElementById("textreceptorestatico").readOnly = false; // escritura
          //Cambiams el color del boton a fondo blanco
          const receptor = document.getElementById("textreceptorestatico"); 
          receptor.style.backgroundColor = "#FFFFFF";
        }          
     }

     ponerSoloLecturaEmisorCasoSeaNotPush();
  function ponerSoloLecturaEmisorCasoSeaNotPush()
     {
       var tipo_not= document.getElementById("selecttpnotif").value
        if (tipo_not==2) //si esta seleccionado NOT. PUSH (2), el campo EMISOR se hace de solo lectura y no de escritura
        {
          document.getElementById("textemisornotif").readOnly = true; // solo lectura
          $('#textemisornotif').val('');
          //Cambiams el color del boton a opaco
        const emisor = document.getElementById("textemisornotif"); 
        emisor.style.backgroundColor = "#DED8D6";

        }
        else //por falso , el campo se hace de escritura
        {

          document.getElementById("textemisornotif").readOnly = false; // escritura
          //Cambiams el color del boton a fondo blanco
          const emisor = document.getElementById("textemisornotif"); 
          emisor.style.backgroundColor = "#FFFFFF";
        }          
     }
 
   
   //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textcodplanilla').val(idd);
    $('#mtexto').text(idd);
    
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
/****FUNCION PARA ELIMINAR ***************/

   var app1=new Vue({
    el: '#diveliminarplanilla',
    data:{
        
    },

    methods:{
      eliminarPlanilla:function(){
          
          $('#btneliminarplanilla').hide();
          
          let formdata=new FormData()

          //formdata.append("textcodigoplanilla",document.getElementById("textcodigoplanilla").value)
          formdata.append("textidusuariobaja",document.getElementById("textidusuariobaja").value)
          formdata.append("textcodplanilla",document.getElementById("textcodplanilla").value)
          
          axios.post("controller/control-planilla-notificacion.php?accion=eliminar",formdata)
          .then(function(response){
           
            console.info(response);
            var variable=response.data;
            switch (variable.error) {
              case 'true':                   
                        setTimeout(function(){ location.href='planilla_notificaciones.php' }, 2000); swal('EXELENTE','Se elimino la planilla con exito','success');  
                        break;
             case 'false':
                        setTimeout(function(){  }, 2000); swal('ERROR','No se elimino la planilla','error'); 
                        break;
             case 'mod':                      
                        setTimeout(function(){  }, 2000); swal('ERROR','Error en la actualizacion','error');
                        break;
             
              default:
                    setTimeout(function(){  }, 2000); swal('ERROR','No se tuvo ninguna respuesta','warning');                      
          }//fin del switch
            
          });
    
      },   //fin de la funcion eliminar

    }
   });


</script>
   


         



























