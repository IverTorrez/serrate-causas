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
    <title>Crear Usuarios</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
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
include_once('model/clstipousuario.php');
include_once('model/clsusuario.php');
include_once('model/clsabogado.php');
include_once('model/clscliente.php');
include_once('model/clscontador.php');
include_once('model/clsprocurador.php');
 
//include_once('controller/control-usuarios.php');
///incluimos el archivo donde esta el modal para guardar la ubicacion
include_once('modal/modal_ubicacion.php');

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
      $tituloform='<h3  class="titulo">MODIFICAR USUARIO ADMINISTRADOR</h3>';
    }
    else
    {
      $tituloform='<h3  class="titulo">MODIFICAR USUARIO OBSERVADOR</h3>';
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
    $tituloform='<h3  class="titulo">MODIFICAR USUARIO ABOGADO</h3>';
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
    $tituloform='<h3  class="titulo">MODIFICAR USUARIO CONTADOR</h3>';

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
       $tituloform='<h3  class="titulo">MODIFICAR USUARIO PROCURADOR</h3>';
     }
     else
     {
      $tituloform='<h3  class="titulo">MODIFICAR USUARIO PROCURADOR MAESTRO</h3>';
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

    $tituloform='<h3  class="titulo">MODIFICAR USUARIO CLIENTE</h3>';

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
    <div class="container" id="divformusuarios">
    <?php echo $tituloform; ?>
  <!--<form  method="post" enctype="multipart/form-data" id="frmusuarios">-->

  <input type="hidden" name="textidusuario" id="textidusuario" placeholder="id usuario" value="<?php echo $codigonuevouser; ?>">
  <input type="hidden" name="texttipousuario" id="texttipousuario" placeholder="tipo de usuario" value="<?php echo $codigonuevotipo; ?>">

    <div class="orden">
       <label>TIPO DE USUARIO *</label>
       <select id="selecttpusu" name="selecttpusu" <?php echo $variableenabled; ?>  >
         <option value="1">Abogado</option>
         <option value="2">Cliente</option>
         <option value="3">Administrador</option>
         <option value="4">Contador</option>
         <option value="5">Procurador</option>
         <option value="6">Procurador Maestro</option>
         <option value="7">Observador</option>
        
       </select>
    </div>
    
    <div class="orden">
        <label for="country">ESTADO<p style="font-size: 13px;">(ACTIVO/INACTIVO)</p></label>
        <input type="checkbox" class="flipswitch" id="checkestado" name="checkestado" <?php echo $valorchequed; ?> >  
        <span></span>   
    </div>

    <div class="orden">
       <label>NOMBRES *</label>
       <input type="text" id="textnombusu"  name="textnombusu" autocomplete="off" placeholder="Nombres del usuario" required="required" value="<?php echo $nombusu; ?>">
    </div>

    <div class="orden">
       <label>APELLIDOS *</label>
       <input type="text" id="textapellusu" name="textapellusu" autocomplete="off" placeholder="Apellidos del usuario" required="required" value="<?php echo $apellusu; ?>">
    </div>

    <div class="orden">
       <label>USUARIO *</label>
       <input type="text" id="textnomblogin" name="textnomblogin" autocomplete="off" placeholder="Escriba un (alias) del usuario" required="required" value="<?php echo $aliasusu; ?>">
    </div>

    <div class="orden">
       <label>CONTRASEÑA*</label>
       <input type="password" id="textpassusu" name="textpassusu" placeholder="Contraseña del usuario" required="required" value="<?php echo $claveusua; ?>">

       <input type="hidden" name="textpasscompara" id="textpasscompara" value="<?php echo $claveusua; ?>">
    </div>

    <div class="orden">
       <label>DIRECCION</label>
       <input type="text" id="textdirusu" name="textdirusu" autocomplete="off" placeholder="Direccion del usuario" value="<?php echo $direcusu; ?>">
    </div>

    <div class="orden">
       <label>TELEFONO</label>
       <input type="number" id="texttelfusu" name="texttelfusu" autocomplete="off" placeholder="Telefono del usuario" value="<?php echo $telusu; ?>">
    </div>

    <div class="orden">
       <label>CORREO</label>
       <input type="email" id="textmailusu" name="textmailusu" autocomplete="off" placeholder="Correo del usuario" value="<?php echo $emailusu; ?>">
    </div>

    <div class="orden">
       <label>FOTO</label>
       <input type="file" id="filefotousu" name="filefotousu" autocomplete="off">
    </div>

    <div class="orden">
       <label>COORDENADAS</label>
       
       <button data-toggle="modal" data-target="#maps" type="button" style="height: 50px; width: 585px; background: #81D4E9; color: white;">ELEGIR UBICACION</button>
    </div>

    <div class="orden">
       <label>OBSERVACIONES</label>
            <textarea style="height: 80px;"  id="textobservusu" name="textobservusu" autocomplete="off" placeholder="Escriba alguna observacion sobre el usuario"><?php echo $observusu; ?></textarea>

    </div>

  <?php
  if ($idusuario!=null) {
    echo '<input type="submit" value="MODIFICAR" id="btnmodusu" @click="insertarUsuarios=false;modificarUsuarios()" name="btnmodusu">';
  }
  else
  {
    echo '<input type="submit" value="GUARDAR" id="btnguardarusu" @click="insertarUsuarios()" name="btnguardarusu">';
  }
  ?>
 
    
 <center>  <div id="cargar"> <div ><img src="cargando.gif" style="width: 50px;height: 50px"></div></div></center>

   <input type="hidden" name="textlatitud" id="textlatitud">
   <input type="hidden" name="textlongitud" id="textlongitud">
   <input type="hidden" name="textlink" placeholder="link" id="textlink" value="<?php echo $coordenusu; ?>"> 
 <!-- </form>-->

  </div>

  </div> 






<?php
if ($codigonuevouser!=null) 
{

?>
  <div class="container" >
      
    <form   style="margin-left:970px; width:238px; height: 210px; position: absolute; top: 175px; border: 4px solid #85929E;  ">
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
}

?>







  <script type="text/javascript">

function addparametroubicacion(x,y,dir){
document.getElementById("textlatitud").value = x+"";
document.getElementById("textlongitud").value = y+"";
document.getElementById("textlink").value=dir+"https://maps.google.com/?q="+x+","+y+"";
}

</script>
   

    <br>
    <br>
    <br>


 <script type="text/javascript" src="js/vuejs/vue.js"></script>
 <script type="text/javascript" src="js/vuejs/vue.min.js"></script>

<script type="text/javascript" src="js/axios/axios.min.js"></script>

<script type="text/javascript" src="resources/jquery.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>


<script type="text/javascript">
 /* $(document).ready(function(){
    $('#btnguardarusu').click(function(){
       var datos=$('#frmusuarios').serialize();
       
       if ($('#textpassusu').val()!='' && $('#textapellusu').val()!=''  && $('#textnombusu').val()!='' && $('#textnomblogin').val()!='') 
       {
            var tipousu = $("#selecttpusu").val();
            var estado = $("#checkestado").val();
            var nombre = $("#textnombusu").val();
            var apell = $('#textapellusu').val();
            var nomlogin = $('#textnomblogin').val();
            var pass = $('#textpassusu').val();   //Ya que utilizas jquery aprovechalo...
            var dir = $('#textdirusu').val();
            var telf = $('#texttelfusu').val();
            var correo = $('#textmailusu').val();
            var coord = $('#textlink').val();
            var observ = $('#textobservusu').val();
            var file2 = $('#filefotousu').val();
            var archivo = file2[0].files;


           var formData = new FormData(document.getElementById("frmusuarios"));
          formData.append('selecttpusu',tipousu);
          formData.append('checkestado',estado);
          formData.append('textnombusu',nombre);
          formData.append('textapellusu',apell);
          formData.append('textnomblogin',nomlogin);
          formData.append('textpassusu',pass);
          formData.append('textdirusu',dir);
          formData.append('texttelfusu',telf);
          formData.append('textmailusu',correo);
          formData.append('textlink',coord);
          formData.append('textobservusu',observ);
          formData.append('filefotousu',archivo);

           $.ajax({
            type:"post",
            url:"controller/control-regusuarioajax.php",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success:function(respuesta){
              if (respuesta==6) {
                setTimeout(function(){ location.href='piso.php' }, 500); swal('EXELENTE','Se Creo El Piso Con Exito','success');
              }
              else
              {
                setTimeout(function(){  }, 2000); swal('ERROR','No Se Creo El Piso','warning');
              }
              $('#textpiso').val('');
            }
          });
           return false;

        }
        else{
          setTimeout(function(){  }, 2000); swal('ERROR','Debe llenar los campos','warning');
        }
    });
  });*/
</script>



<script type="text/javascript">
$('#cargar').hide();
   var app=new Vue({
    el: '#divformusuarios',
    data:{
        
    },

    methods:{
      insertarUsuarios:function(){
          
          $('#btnguardarusu').hide();
          
           $('#cargar').show();
          let formdata=new FormData()
          formdata.append("selecttpusu",document.getElementById("selecttpusu").value)

          var Cheq1=document.getElementById("checkestado").checked
          if (Cheq1==false) 
          {
            formdata.append("checkestado",'null')
          }
          else
          {
            if (Cheq1==true) 
            {
              formdata.append("checkestado",'true')
            }
          }
          
          formdata.append("textnombusu",document.getElementById("textnombusu").value)
          formdata.append("textapellusu",document.getElementById("textapellusu").value)
          formdata.append("textnomblogin",document.getElementById("textnomblogin").value)
          formdata.append("textpassusu",document.getElementById("textpassusu").value)
          formdata.append("textdirusu",document.getElementById("textdirusu").value)
          formdata.append("texttelfusu",document.getElementById("texttelfusu").value)
          formdata.append("textmailusu",document.getElementById("textmailusu").value)
          formdata.append("filefotousu",document.getElementById("filefotousu").files[0])
          formdata.append("textlink",document.getElementById("textlink").value)
          formdata.append("textobservusu",document.getElementById("textobservusu").value)

          var Cheq=document.getElementById("checkestado").checked
          

          axios.post("controller/control-regusuariosVuej.php?accion=crear",formdata)
          .then(function(response){
           
            console.info(response);
            var variable=response.data;
            if (variable.error=='password') 
            {
              $('#btnguardarusu').show();
                 $('#cargar').hide();
              setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña','info');
            }
            else
            {
               if (variable.error=='true') 
               {
                setTimeout(function(){ location.href='usuarios.php' }, 2000); swal('EXELENTE','Se Creo El Usuario Con Exito','success');
               /* if (Cheq==true) 
                {
                  alert('Esta chequeao');
                }
                else
                {
                  if (Cheq==false) 
                  {
                    alert('No se chequeo');
                  }
                }*/
                
               }
               else
               {
                 if (variable.error=='false') 
                 {
                  $('#btnguardarusu').show();
                  $('#cargar').hide();
                   setTimeout(function(){  }, 2000); swal('ERROR','No Se Registro El Usuario','error');
                 }
                 else
                 {
                   if (variable.error=='vacio') 
                   {
                    $('#btnguardarusu').show();
                    $('#cargar').hide();
                     setTimeout(function(){  }, 2000); swal('ERROR','Complete Todos Los Campos Con asterisco (*) ','warning');
                   }
                 }
               }
            }

           // setTimeout(function(){  }, 2000); swal('','Debe usar otra Contraseña','error');
        
    

          });


         
      },

      /*************************nueva funcion****************************/
      modificarUsuarios:function(){
          $('#btnmodusu').hide();
          
           $('#cargar').show();
          
          let formdata=new FormData()
          formdata.append("selecttpusu",document.getElementById("selecttpusu").value)

          var Cheq1=document.getElementById("checkestado").checked
          if (Cheq1==false) 
          {
            formdata.append("checkestado",'null')
          }
          else
          {
            if (Cheq1==true) 
            {
              formdata.append("checkestado",'true')
            }
          }
          formdata.append("texttipousuario",document.getElementById("texttipousuario").value)
          formdata.append("textidusuario",document.getElementById("textidusuario").value)

          formdata.append("textnombusu",document.getElementById("textnombusu").value)
          formdata.append("textapellusu",document.getElementById("textapellusu").value)
          formdata.append("textnomblogin",document.getElementById("textnomblogin").value)
          formdata.append("textpassusu",document.getElementById("textpassusu").value)
          formdata.append("textdirusu",document.getElementById("textdirusu").value)
          formdata.append("texttelfusu",document.getElementById("texttelfusu").value)
          formdata.append("textmailusu",document.getElementById("textmailusu").value)
          formdata.append("filefotousu",document.getElementById("filefotousu").files[0])
          formdata.append("textlink",document.getElementById("textlink").value)
          formdata.append("textobservusu",document.getElementById("textobservusu").value)

          formdata.append("textpasscompara",document.getElementById("textpasscompara").value)

          var Cheq=document.getElementById("checkestado").checked
          

          axios.post("controller/control-modusuariosVuej.php?accionm=modificar",formdata)
          .then(function(response){
           
            console.info(response);
            var variablem=response.data;

            if (variablem.error=='password') 
            {
              $('#btnmodusu').show();
          
           $('#cargar').hide();
              setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña','info');

            }
            else
            {
               if (variablem.error=='true') 
               {
                setTimeout(function(){ location.href='usuarios.php' }, 2000); swal('EXELENTE','Se Modifico El Usuario Con Exito','success');
               /* if (Cheq==true) 
                {
                  alert('Esta chequeao');
                }
                else
                {
                  if (Cheq==false) 
                  {
                    alert('No se chequeo');
                  }
                }*/
                
               }
               else
               {
                 if (variablem.error=='false') 
                 {
                   $('#btnmodusu').show();
          
                   $('#cargar').hide();
                   setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Usuario','error');
                 }
               }
            }

           // setTimeout(function(){  }, 2000); swal('','Debe usar otra Contraseña','error');
        
    

          });


         
      },
      /*hasta aqui lafuncion editar**/


    }
   });
</script>





<script type="text/javascript">
  /* var app=new Vue({
    el: '#divmodusuarios',
    data:{
        
    },

    methods:{
      modificarUsuarios:function(){
          
          
          let formdata=new FormData()
          formdata.append("selecttpusu",document.getElementById("selecttpusu").value)

          var Cheq1=document.getElementById("checkestado").checked
          if (Cheq1==false) 
          {
            formdata.append("checkestado",'null')
          }
          else
          {
            if (Cheq1==true) 
            {
              formdata.append("checkestado",'true')
            }
          }
          formdata.append("texttipousuario",document.getElementById("texttipousuario").value)
          formdata.append("textidusuario",document.getElementById("textidusuario").value)

          formdata.append("textnombusu",document.getElementById("textnombusu").value)
          formdata.append("textapellusu",document.getElementById("textapellusu").value)
          formdata.append("textnomblogin",document.getElementById("textnomblogin").value)
          formdata.append("textpassusu",document.getElementById("textpassusu").value)
          formdata.append("textdirusu",document.getElementById("textdirusu").value)
          formdata.append("texttelfusu",document.getElementById("texttelfusu").value)
          formdata.append("textmailusu",document.getElementById("textmailusu").value)
          formdata.append("filefotousu",document.getElementById("filefotousu").files[0])
          formdata.append("textlink",document.getElementById("textlink").value)
          formdata.append("textobservusu",document.getElementById("textobservusu").value)

          var Cheq=document.getElementById("checkestado").checked
          

          axios.post("controller/control-modusuariosVuej.php?accionm=modificar",formdata)
          .then(function(response){
           
            console.info(response);
            var variable=response.data;
            if (variable.error=='password') 
            {
              setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña','info');
            }
            else
            {
               if (variable.error=='true') 
               {
                setTimeout(function(){ location.href='usuarios.php' }, 2000); swal('EXELENTE','Se Modifico El Usuario Con Exito','success');
               /* if (Cheq==true) 
                {
                  alert('Esta chequeao');
                }
                else
                {
                  if (Cheq==false) 
                  {
                    alert('No se chequeo');
                  }
                }*/
                
       /*        }
               else
               {
                 if (variable.error=='false') 
                 {
                   setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Usuario','error');
                 }
               }
            }

           // setTimeout(function(){  }, 2000); swal('','Debe usar otra Contraseña','error');
        
    

          });


         
      },
    }
   });*/
</script>

























