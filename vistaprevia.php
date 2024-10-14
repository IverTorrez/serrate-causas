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
    <title>Vista Previa</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
    
</head>
<body>
<?php

include_once('model/clscausa.php');
include_once('model/clsplantilla.php');
include_once('model/clsposta.php');
include_once('model/clspostacausa.php');
include_once('model/clsinformeposta.php');
include_once('model/clstipoposta.php');
include_once('model/clsordengeneral.php');

$cod=$_GET['squart'];//CODIGO DE LA PLANTILLA

 //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/1234567;

  // $objcausa=new Causa();
  // $resul=$objcausa->mostrarcodcausa($codigonuevo);
  // $fil=mysqli_fetch_object($resul);
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
        
    
       <div id="main_menu_admin">
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

    <!-- <div id="portfolio_menu">

                AGREGAR SUB MENU

            </div>--> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

     <!--NOMBRE DE LA PLANTILLA-->
     <?php
     $objplant=new Plantilla();
     $resultplant=$objplant->mostrarUnaPlantilla($codigonuevo);
     $filnombpl=mysqli_fetch_object($resultplant);

     ?>
  <div class="container">

      <input type="hidden" name="" placeholder="id PLANTILLA" value="<?php echo $codigonuevo; ?>">
     <section class="responsive">
      <h3 style="color: #000000;font-size: 20px;text-align: center;font-family: fantasy;"><?php echo $filnombpl->nombreplantilla; ?></h3>
      <br>
      <!--TABLA 1-->

     </section>

  </div>

    
    <br>
    



    <?php
/*DESDE AQUI EMPIEZA EL BOTON INICIO CON SU FLECHA HACIA ABAJO*/


      
  
  /*POR FALSO LOS DEJA CON EL COLOR NONE*/
  
      $colorbordebtnini='#E5E5E5';
       $colorfondopostaini='#E5E5E5';
    


$objppl=new Posta();
$resulcont=$objppl->contarpostasDePlantilla($codigonuevo);
$filcont=mysqli_fetch_object($resulcont);

if ($filcont->cantidad>0) /*PREGUNTA SI ESTA PLANTILLA TIENE ALGUNA POSTA*/
{
  
echo "<div class='container'>
      <center> <div>
      <div style='height: 60px;' >
         <button class='btniniposta' style='border: 5px solid $colorbordebtnini; background:$colorfondopostaini;'>INICIO</button>
      </div>
    <div class='trianguloini' style='border-bottom: 20px solid $colorbordebtnini ;'></div>
    </div></center>
    </div>";

  }
  else
  {
    echo '<h3 style="color: #000000;font-size: 20px;text-align: center;font-family: fantasy;">PLANTILLA VACIA</h3>';
  }
/*HASTA AQUI EMPEZO EL BOTON INICIO CON SU FLECHA HACIA ABAJO*/
//$varabilitaboton="enabled=''";



/*SE ENLISTA TODAS LAS POSTAS DE UNA PLANTILLA*/
$objposca=new Posta();
$reulpcau=$objposca->listarPostasDePlantillaAscendente($codigonuevo);
while ($filposta=mysqli_fetch_object($reulpcau)) 
{

  

 

/*EMPIEZA LAS FLACHAS CON LA TABLA*****************************************************************************************/
echo "<div class='container'>
    <center> 
        <div style=''>
        <div class='linea' ></div> 
        <div class='triangulo'></div>
        </div>
    </center>";
  

  echo "<table style='width: 100%;'><!--EMPIEZA LA TABLA QUE MUESTRA LAS POSTAS-->
  <tbody>
    <tr style='height: 100px;'>";
   /*empieza la primera columna de la tabla informacion de posta*/
   echo "<td style='width: 46%;'><div style='text-align: right;'>
                              <label style='color: #B0B0B0; font-family: fantasy;'>$filposta->nombreposta</label><br>
                              <label></label><br>
                              <label></label><br>
                              <label></label><br>
                              <label></label><br>

                              <label></label><br>
                              </div>
         </td>";/*termina la primera columna de latabla*/
  
  /*empieza la segunda columna de la tabla numero de posta*/
   echo "<td style='width: 8%;'>

        <button class='btnpostanuevo'>$filposta->numeroposta</button>

        </td>";/*termina la segunda columna*/

   /*empieza la tercera columna de la tabla flecha del truncamiento*/
    echo "<td style='width: 8%;'>";
           /* <div style='width: 100%;'>
               <div class='divflechatruncaprueeva'>
                <div class='lineatruncaprueva' id=''></div> <div class='triangulotruncaprueba'></div>
              </div>

            </div>*/
    
     echo "</td>";/*termina la tercera columna de la tabla*/

  /*empieza la cuarta columna de la tabla , el tipode truncamiento*/
  echo "<td style='width: 38%;'>";
          /* <div style=' width: 70%; margin-top: -8px; ' class='tipotruncamiento'>
                <div>
                  <br>
                     <center> <p >TRUNCAMIENTO</p></center>
                </div>
            </div> */    
        
    echo "</td>";/*termina la cuarta columna de la tabla , el tipode truncamiento*/

  echo " </tr>

  </tbody>
</table><!--FIN DE LA TABALA-->
</div><!--FIN DEL CONTAINER-->"; 


  
}/*FIN DEL WHILE QUE RECORRE TODAS LAS POSTAS DE UNA PLANTILLA*/
?>


<!--EMPIEZA LA TABLA QUE MUESTRA LAS POSTAS (con responsive)-->
<!--<table style="width: 100%">
  <tbody>
    <tr style=" height: 100px; background: blue;">
      <td style="width: 46%;"><div style="text-align: right;">
                              <label style='color: black; font-family: fantasy;'>INICO DE DEMANDA</label><br>
                              <label>fdgf</label><br>
                              <label>cxffd</label><br>
                              <label>cfvfd</label><br>
                              <label>fdvf</label>
                              </div>
                              </td>
      <td style="width: 8%;"><button class="btnpostanuevo">1</button></td>

      <td style="width: 8%;">
          <div style="width: 100%; ">
             <div class='divflechatruncaprueeva' style="background: pink;" >
              <div class='lineatruncaprueva' id=''></div> <div class='triangulotruncaprueba'></div>
            </div>

          </div>


          
      </td>

      <td style="width: 38%;">
         <div style=' width: 70%; margin-top: -8px; ' class='tipotruncamiento'>
              <div>
                <br>
                   <center> <p >TRUNCAMIENTOvvv</p></center>
              </div>
          </div>     
        
      </td>

    </tr>

  </tbody>
</table>--><!--FIN DE LA TABALA-->
       

 <!--****************************TABLA MODELO  PARA LAS OTRAS INTERFACES DEL HISTORIGRAMA******************************************-->
<!--      
  <div class='container'>
      <center> <div>
      <div style='height: 60px;' >
         <button class='btniniposta' style='border: 5px solid #E5E5E5; background:#E5E5E5;'>INICIO</button>
      </div>
    <div class='trianguloini' style='border-bottom: 20px solid #E5E5E5 ;'></div>
    </div></center>
    </div>



  <div class="container">
    <center> 
        <div style="">
        <div class='linea' ></div> 
        <div class='triangulo'></div>
        </div>
    </center>-->
  
<!--EMPIEZA LA TABLA QUE MUESTRA LAS POSTAS-->
 <!-- <table style=" width: 100%; ">
  <tbody>
    <tr style=" height: 100px; ">
      <td style="width: 46%;"><div style="text-align: right;">
                              <label style='color: black; font-family: fantasy;'>INICO DE DEMANDA</label><br>
                              <label>fdgf</label><br>
                              <label>cxffd</label><br>
                              <label>cfvfd</label><br>
                              <label>cfvfd</label><br>

                              <label>fdvf</label>
                              </div>
      </td>

      <td style="width: 8%;">

        <button class="btnpostanuevo">1</button>

      </td>

      <td style="width: 8%;">
            <div style="width: 100%; ">
               <div class='divflechatruncaprueeva'>
                <div class='lineatruncaprueva' id=''></div> <div class='triangulotruncaprueba'></div>
              </div>

            </div>


          
      </td>

      <td style="width: 38%;">
           <div style=' width: 70%; margin-top: -8px; ' class='tipotruncamiento'>
                <div>
                  <br>
                     <center> <p >TRUNCAMIENTO</p></center>
                </div>
            </div>     
        
      </td>

    </tr>

  </tbody>
</table>
</div>--><!--FIN DEL CONTAINER-->



  


<style type="text/css">
  /*ESTILO PARA DAR FORMA A LAS POSTAS */

  .btnpostanuevo{
    font-size: 17px; 
color: black; 
width: 100%; 
height: 80px; 
-moz-border-radius:50%; 
-webkit-border-radius: 50%; 
border-radius: 50%;
cursor: pointer;

border-width:9px;
margin-bottom: 20px;
  }
.btnposta{

font-size: 17px; 
color: black; 
width: 100px; 
height: 70px; 
-moz-border-radius:50%; 
-webkit-border-radius: 50%; 
border-radius: 50%;
cursor: pointer;
position: absolute; 
right: 46%;
border-width:9px;
/*border-color: #187C08 ;*/


}

.btniniposta{

font-size: 17px; 
color: black; 
width: 100px; 
height: 60px; 
-moz-border-radius:10%; 
-webkit-border-radius: 10%; 
border-radius: 10%;
cursor: pointer;
/*position: absolute; 
right: 50%; */
}

.trianguloini
{
  width: 0px;
  height: 0px;
  border-left: 41px solid transparent;
  border-right: 41px solid transparent;
  /*border-bottom: 20px solid #B0B0B0 ;*/
 /*  margin-left: 586px;*/
 
   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);

}

.triangulo
{
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 20px solid #B0B0B0 ;
 /*  margin-left: 45.8%;*/

   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);

}
.linea
{
  height: 100px;
  width: 4px;
  background: #B0B0B0   ;
 /* margin-left: 46.3%;*/

}

.divflechatruncaprueeva{
  width: 100%; 
  height: 100px;
 /* float: left;*/ 
  transform: rotate(270deg);
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -o-transform: rotate(270deg); 
}

.lineatruncaprueva{

  height: 80%;
  width: 4px;
  background: red ;

  margin-left: 50px;
}
.triangulotruncaprueba{
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 20px solid red ;
   margin-left: 42px;

   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);
}

.lineatrunca
{
  height: 90px;
  width: 4px;
  background: red ;
  margin-left: 70px;
  
 

}
.triangulotrunca
{
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 20px solid red ;
   margin-left: 62px;

   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);

}
.cdontenedorflecha
{
  
cursor: pointer;
background: blue; 
margin-right: 780px;
position: center;

}

.tipotruncamiento
{ 
  height: 80px;
  background: #F93434;
  color: white;
 
  -moz-border-radius:50%; 
-webkit-border-radius: 50%; 
border-radius: 50%;
border: 4px solid red;

}
.divflechatrunca
{
  width: 15%; 
  
  float: left; 
  transform: rotate(270deg);
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -o-transform: rotate(270deg);  
}

</style>


    <br>
    <br>
    <br>





      <script type="text/javascript">
 //FUNCION QUE LEVANTA EL MODAL Y EL ID DEL TRIBUNAL O JUZGADO
  function funcionllevaidmodal(idd)
  {
    $('#textidpostacausa').val(idd);
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
   


         <!-- The Modal (FORMULARIO) PARA REGISTRAR UN INFORME DE POSTA OSENTENCIA -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 750px;">
    <div class="modal-header">
      <span class="close" id="spanclosepres">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p id="titlusent" style="font-size: 20px;font-family: fantasy;" >REGISTRO DE SENTENCIA</p></center>
     
     </div><br>
    <form method="post">
      <input type="hidden" name="textidpostacausa" id="textidpostacausa" placeholder="id postacausa">
      <input type="hidden" name="textestadopostaCausa" id="textestadopostaCausa" placeholder="estado postacausa">
      <input type="hidden" name="textidinformeposta" id="textidinformeposta" placeholder="id informeposta para editar">
    <div class="modal-body">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:13px;"><b>NUMERO DE FOJA: </b></label>
        <label style="font-size:15px;" ><b id="labelfoja"></b></label><br>
        

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:13px;"><b> TIPO DE POSTA: </b></label>
        <label style="font-size:15px;"><b id="labeltipoposta"></b></label><br>
     
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <label style="font-size:13px;"><b> FECHA DE INSTANCIA: </b></label>   
     <label style="font-size:15px;" ><b id="labelfecha"></b></label><br>

     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:13px;"><b>GASTOS PROCESALES HASTA INSTANCIA: </b></label> 
      <label style="font-size:15px;" ><b id="labelgastoproc"></b></label><br>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:13px;"><b>HONORARIOS HASTA INSTANCIA: </b></label> 
      <label style="font-size:15px;" ><b id="labelhonorario"></b></label><br>

      

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <label style="font-size:13px;"><b>GASTOS TOTALES HASTA INSTANCIA: </b></label> 
      <label style="font-size:15px;" ><b id="labelgastototal"></b></label><br>
                                                          

    </div>
    <div class="modal-footer">
     

     
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Ok</button>
     </div>
      </form>

   
  </div>

</div>







<script type="text/javascript" src="resources/jquery.js"></script>

  <!-- javascript -->
    <script type="text/javascript" src="resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/init-tinymce.js"></script>

</body>
</html>



<!--CODIGO PARA CARGAR DATOS DE UN REGISTRO AL TEXT, PARA MODIFICAR UN REGISTRO-->
<script type="text/javascript">
         
         $('#titulomod').hide();

        $(document).ready(function(){
        $('.btnposta').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
          $valor3=$(this).attr('parametro3');
          $valor4=$(this).attr('parametro4');
          $valor5=$(this).attr('parametro5');
          $valor6=$(this).attr('parametro6');
          $valor7=$(this).attr('parametro7');
          $valorgproc=$(this).attr('parametrogastopro');
          $valortotal=$(this).attr('parametrogastototal');
          //var sw=$(this).attr('parametro3');
          
          $('#textestadopostaCausa').val($valor);
           $('#labelfoja').text($valor2);
           $('#labelhonorario').text($valor3);
           $('#titlusent').text($valor4);
           $('#labelfecha').text($valor5);
           $('#labeltipoposta').text($valor6);
           $('#labelgastoproc').text($valorgproc);
           $('#labelgastototal').text($valortotal);
           $('#textidinformeposta').val($valor7);

           

          /* if ($('#textfoja').val()=='') 
           {
             $('#btneliminarinforme').hide();
             $('#selecttpposta').val(1);
           }
           else
           {
            $('#btneliminarinforme').show();
            $('#selecttpposta').val($valor6);
           }*/
          
          /* $('#btnregajax').hide();
           $('#titulocrear').hide();
           $('#btnmodtp').show();
           $('#titulomod').show();*/
        });

      });
  
</script>