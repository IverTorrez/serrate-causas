/*ENVIAR DATOS PARA SER VALIDADOS*/
$("#iniciar").click(function(e)
{
  e.preventDefault();
   // removemos el div con la clase alert
    $('.alert').remove();

  var data=$('#frm').serialize();
   user=$('#usuario').val();
   pass=$('#password').val();
   capt=$('#captcha').val();
    
   /*VALIDAMOS CAMPOS*/
   validaUser=/^([a-zA-Z0-9]{2,40})$/;
   validaPass=/^([a-zA-Z0-9]{2,40})$/;
   validaCapt=/^([a-z0-9]{3,3})$/;

   if(user=="" || user==null)
        {
           cambiarColor("usuario");
        // mostramos le mensaje de alerta
        mostraAlerta("Campo obligatorio");
        return false;
        }
    else    
      { 
      if(!(validaUser.test(user)) )
      {
        cambiarColor("usuario");
        // mostramos le mensaje de alerta
        mostraAlerta("usuario no cumple el formato");
        return false;
      } 
      else
        {  if(pass=="" || pass==null)
          {
            cambiarColor("password");
            // mostramos le mensaje de alerta
            mostraAlerta("Campo obligatorio");
            return false;
          }
       else
       {  if(!(validaPass.test(pass)) )
         {
            cambiarColor("usuario");
            // mostramos le mensaje de alerta
            mostraAlerta("la contraseña no cumple el formato");
        return false;
         }

           else
          {
           if(capt=="" || capt==null)
            {
               cambiarColor("captcha");
                // mostramos le mensaje de alerta
               mostraAlerta("Campo obligatorio");
               return false;
            }
             else
            {
             if(!(validaCapt.test(capt)) )
              {
                cambiarColor("captcha");
                // mostramos le mensaje de alerta
                mostraAlerta("captcha no cumple el formato");
                return false;
              }
              else
               {

         $.ajax(      
  {
    url:"controller/control-login.php",
    type:"post",
    data:data,
    beforeSend:function()
    {
      $("#iniciar").css('display', 'none');
       //Añadimos la imagen de carga en el contenedor
        $("#cargar").css('display', 'block');
        $('#cargar').html('<div ><img src="cargando.gif" style="width: 50px;height: 50px"></div>');
    },
    success:function(res) 
    {     
       if(res=="administrador")
          { 
          setTimeout(function(){$(location).attr('href','causasActivas.php')}, 1000);
           
          }
      else
        {
          if(res=="5")
          { 
          setTimeout(function(){$(location).attr('href','procurador/misCausas.php')}, 1000);
           /*alert(res);*/

          }
           else
        {
          if(res=="6")
          { 
          setTimeout(function(){$(location).attr('href','procuradormaestro/pm_mis_causa.php')}, 1000);
           /*alert(res);*/

          }
        else
        {
          if(res=="observador")
          { 
          setTimeout(function(){$(location).attr('href','observador/miscausasob.php')}, 1000);
           /*alert(res);*/

          }
       

          else
          {
             if(res=="abogado")
             { 
               setTimeout(function(){$(location).attr('href','abogado/miscausas.php')}, 2000);        
             }
               else
                {
                  if(res=="cliente")
                  { 
                   setTimeout(function(){$(location).attr('href','cliente/clienteCausas.php')}, 2000);
                  }
                    else
                    {           
                      if(res=="contador")
                      { 
                       setTimeout(function(){$(location).attr('href','contador/contador_mis_causa.php')}, 2000);
                      }
                       else
                       {  
                         if(res=="procurador")
                            { 
                             setTimeout(function(){$(location).attr('href','procurador/misCausas.php')}, 2000);
                            }
                            else
                            {
                              if(res=="procuradormaestro")
                                { 
                                 setTimeout(function(){$(location).attr('href','procuradormaestro/pm_mis_causa.php')}, 2000);
                                }
                                else
                                {
                                setTimeout(function(){alert(res),$("#iniciar").css('display', 'block')}, 1000);
                                 setTimeout(function(){$('#cargar').css('display', 'none')}, 1000);
                               }
                            }   
                        
                       }          
                    }      
                }
            }
           }
          }
       }
    }

  });
                  }
                }
              }  
            }
         }
    }

});

  /*FUNCION CONTADOR*/
var n = 1;
var limite=40;
var l = document.getElementById("number");
  window.setInterval(function(){
    if(n<=limite)
{
    l.innerHTML = n;
    var p=l.innerHTML ;
     console.log(p);
  if(n>=10)
  {
    l.style.color="red";
  }
  n++;
}
else
{
  $(document).ready(function(){
       $('#captchaLoad').load('imagen.php');
    });
l.style.color="#000000";
  n=1;
}

},1000);



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





$('input').focus(function(){
    $('.alert').remove();
    colorDefault('usuario');
    colorDefault('password');
    colorDefault('captcha');
});

$('textarea').focus(function(){
    $('.alert').remove();
    colorDefault('mensaje');
});

// creamos un funcion de color por defecto a los bordes de los inputs
function colorDefault(dato){
    $('#' + dato).css({
        border: "1px solid #999"
    });
}

// creamos una funcio para cambiar de color a su bordes de los input
function cambiarColor(dato){
    $('#' + dato).css({
        border: "1px solid #dd5144"
    });
}

// funcion para mostrar la alerta

function mostraAlerta(texto){
    $('#usuario').before('<div class="alert">Error: '+ texto +'</div>');
}