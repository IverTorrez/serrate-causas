<!DOCTYPE html>
<html>
<head>

  <title>login</title>
  <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="resources/login.css">
  <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    #number {
  font-size:30px;
  
}

<?php
error_reporting(E_ERROR);
include_once('model/clscajasdesalida.php');

$objimg=new Cajasdesalida();
$resulimg=$objimg->mostrarImagenIndex();
$filimg=mysqli_fetch_object($resulimg); 

?>
  </style>
</head>
<body>
 <!--LOGO-->
<div class="imgcontainer">
   <?php
        include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" alt="Avatar" class="avatar">';
        }
        else
        {
          echo "<img style='width: 391px;height: 99px;' src='fotos/imagenindex/$filimg->imagenindex' alt='Avatar' class='avatar' >";
        }

        ?>

  
 <!--  <img src="../resources/logo.jpg" alt="Avatar" class="avatar">-->
</div>
 <!--FORMULARIO LOGIN-->

            <form class="formulario" id="frm" method="POST">

                 <input type="text" id="usuario" name="usuario" autocomplete="off" placeholder="USUARIO">
           
     <div>
        <div style="float:left;margin: 0 0 15px;width: 82%;margin-left: 5px">
          <input type="password" name="password" id="password" placeholder="CONTRASEÑA">
        </div>
        <div style="float:left;margin: 0 0 15px;padding: 6px;border: 1px solid #999;">
           <i class="fa fa-eye" aria-hidden="true" action="hide" id="show-hide-passwd"></i>
      </div>    
    </div>
   
    
    

    
          
          <!--CAMPO PARA INGRESAR CAPTCHA-->
         <!-- <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="INGRESE CAPTCHA" >-->
          
          <button type="button"  name="iniciar" id="iniciar">INGRESAR</button>

          <div id="cargar">
            
          </div>


            </form>



<script type="text/javascript" src="resources/jquery.js"></script>
<!--<script type="text/javascript" src="validaciones/validacionLogin.js"></script>-->
</body>
</html>
<script type="text/javascript">
    /*$(document).ready(function(){
       $('#captchaLoad').load('imagen.php');
    });*/

/*===================FUNCION QUE LLAMA AL EDITAR EMPLEADO===========================================*/
$(document).ready(function() { 
   $("#iniciar").on('click', function() {
  
   var formDataeditCli = new FormData(); 
   
   var iniciar=$('#iniciar').val();
   var usuario=$('#usuario').val();
   var password=$('#password').val();
   
   if ( (usuario=='') ||  (password=='') ) 
   {
     setTimeout(function(){  }, 2000); swal('ATENCION','Deve de completar todos los campos','warning'); 
     
     
   }
   else
   {
     /*cargamos las nueva variables a a los parametros que se enviara al archivo php que registra*/
     formDataeditCli.append('iniciar',iniciar);
     formDataeditCli.append('usuario',usuario);
     formDataeditCli.append('password',password);
    
      $.ajax({ url: 'controller/control-login.php', 
               type: 'post', 
               data: formDataeditCli, 
               contentType: false, 
               processData: false, 
               success: function(response) { 
                console.info(response);
                //    var posOk=response[1];
                //    var posIdpregunta=response[4];
                //    console.info(posIdpregunta);
                  if (response=="administrador") 
                  {
                    
                    //setTimeout(function(){ location.href='clientes'; }, 1000); swal('EXELENTE','','success'); 
                    setTimeout(function(){$(location).attr('href','causasActivas.php')}, 1000);
                     
                  }
                  else
                  {

                    if(response=="observador")
                    { 
                     setTimeout(function(){$(location).attr('href','observador/miscausasob.php')}, 1000);
          
                    }
                    else
                    {
                      if(response=="abogado")
                       { 
                         setTimeout(function(){$(location).attr('href','abogado/miscausas.php')}, 2000);        
                       }
                       else
                       {
                         if(response=="cliente")
                          { 
                           setTimeout(function(){$(location).attr('href','cliente/clienteCausas.php')}, 2000);
                          }
                          else
                          {
                            if(response=="contador")
                              { 
                               setTimeout(function(){$(location).attr('href','contador/contador_mis_causa.php')}, 2000);
                              }
                              else
                              {
                                if(response=="procurador")
                                  { 
                                   setTimeout(function(){$(location).attr('href','procurador/misCausas.php')}, 2000);
                                  }
                                  else
                                  {
                                    if(response=="procuradormaestro")
                                      { 
                                       setTimeout(function(){$(location).attr('href','procuradormaestro/pm_mis_causa.php')}, 2000);
                                      }
                                      else
                                      {
                                        alert("Usuario no encontrado");
                                      }
                                  }
                              }
                          }
                       }
                    }
                    //setTimeout(function(){  }, 2000); swal('ERROR','Intente nuevamente','error');
                    
                                       
                  } 
                }
            }); 

      }/*FIN DEL ELSE QUE SE EJECTUTA AL CONFIRMAR QUE TODOS LOS CAMPOS FUERON LLENADOS*/
        return false;


    }); 
  });
  
  
  /*===================VOLVER TEXT EL INPUT PASSWORD===========================================*/


/*MOSTRAR Y OCULTAR CONTRASEÑA*/
    $(document).on('ready', function() {
      $('#show-hide-passwd').on('click', function(e) {
        e.preventDefault();
        var current = $(this).attr('action');
        if (current == 'hide') {
           $('#password').get(0).type='text';
         /* $(this).prev().attr('type','text');*/
          $(this).removeClass('fa fa-eye').addClass('fa fa-eye-slash').attr('action','show');
        }
        if (current == 'show') {
           $('#password').get(0).type='password';
          /*$(this).prev().attr('type','password');*/
          $(this).removeClass('fa fa-eye-slash').addClass('fa fa-eye').attr('action','hide');
        }
      })
    })
</script>
