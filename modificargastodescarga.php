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
    <title>Modificar/Eliminar Orden</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
        <link rel="stylesheet" type="text/css" href="resources/tablaordenabog.css">

    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="resources/jquery.js"></script>
  <!-- javascript -->
    <script type="text/javascript" src="resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymce/init-tinymce.js"></script>

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

    <script src="js/jquery.js"></script>
    
    <script type="text/javascript" src="js/vuejs/vue.js"></script>
<script type="text/javascript" src="js/axios/axios.min.js"></script>

     <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">
    
</head>
<body>
<?php
include_once('model/clsordengeneral.php');
include_once('model/clspresupuesto.php');
include_once('model/clsdescarga_procurador.php');
include_once('model/clsconfirmacion.php');
include_once('model/clscausa.php');
include_once('model/clscotizacion.php');


include_once('controller/control-descargaproc.php');
include_once('controller/control-modinfocargadescarga.php');

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
        <div id="main_menu_admin">
        
            <ul>
                <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               

                 <li  class="" style="float: left; margin: 0 14px; width: 445px;"><p >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</p></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
                <div id="portfolio_menu">
                   <ul>
                     <?php
                     /*AQUI VERIFICARA SI EL DINERO YA FUE ENTREGADO DE ESA ORDEN*/
                     $objpresu=new Presupuesto();
                     $resulpresu=$objpresu->mostrarpresupuesto($codigonuevo);
                     $filapre=mysqli_fetch_object($resulpresu);
                     if ($filapre->fecha_entrega=='') /*SI AUN NO HA ENTREGADO DINERO PUEDE ELIMINARSE ESA ORDEN*/
                     {
                       echo ' <li style=""><button style="background: red;" id="myBtnforelimorden"  class="botones">BORRAR ORDEN</button></li>';
                     }
                     else/*POR FALSO NO SE PODRA ELIMINAR Y MOSTRARA UN MENSAJE*/
                     {
                      echo '<li style=""><button onclick="mostrarmensajenosepuedeeliminar();" style="background: red;"  class="botones">BORRAR ORDEN</button></li>';
                     }

                     ?>
                     
                   </ul>
                   <br>
                </div>
            
           
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--TABLA CAUSAS ACTIVAS-->

 <script type="text/javascript" >
    function mostrarmensajenosepuedeeliminar(){
    setTimeout(function(){  }, 2000); swal('ATENCION','Esta Orden No se Puede Eliminar, Porque El Dinero Del Presupuesto Ya Fue Entregado','warning');
    }
  </script> 

  <div class="container" >
   <section class="responsive">
   <input type="hidden" name="" value="<?php echo $codigonuevo; ?>">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">DETALLE DE LA ORDEN</h3>
    <br>
    <!--TABLA 1-->
       <table id="customers">
 <thead>     
 
    <tr align="center" > 
     <th rowspan="2" width="14%">CODIGO DE LA CAUSA</th> 
     <th rowspan="2" width="13%">NUMERO DE LA ORDEN</th>  
     <th colspan="2" width="26%">PARAMETROS USADOS PARA COTIZAR ORDEN</th>  
     <th rowspan="2" width="10%">ULTIMA FOJA ACTUALIZADA</th>
     <th rowspan="2" width="">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>  
    </tr> 
 
    <tr style="background: #B1EF07">
     <td>NIVEL DE PRIORIDAD</td> 
     <td>PLAZO OTORGADO</td> 
    </tr> 
</thead>
<tbody>
 

   <?php
  $objorden1=new OrdenGeneral();
   $resul=$objorden1->listardetalledeordentabla1($codigonuevo);
   $fil=mysqli_fetch_object($resul); 
   echo " <tr>";
  echo "<td>$fil->codigocausa</td>";
  echo "<td>$fil->numeroorden</td>";
  echo "<td>$fil->Prioridad</td>";
   switch ($fil->Condicion) {
                case 1:echo "<td>mas de 96</td>"; break;
                case 2:echo "<td>24-96</td>"; break;
                case 3:echo "<td>8-24</td>"; break;
                case 4:echo "<td>3-8</td>"; break;
                case 5:echo "<td>1-3</td>"; break;
                case 6:echo "<td>0-1</td>"; break;        
              }
          $objdesc=new DescargaProcurador();
    $resultado=$objdesc->mostrarfojadescarga($codigonuevo);
   $filafoja=mysqli_fetch_object($resultado); 
       
   echo "<td>$filafoja->ultima_foja</td>";
   echo "<td>$fil->procuradorasig</td>"; 

   echo "</tr>";           
  ?>
</tbody>
</table>
</section>
<br>
<br>
<!--TABLA 2-->


<!--TABLA 3-->
<section class="responsive">
    <h3 style="color: #000000;font-size: 25px;text-align: center;">ELEMENTOS DE LA ORDEN</h3>
    <?php
 $objorden3=new OrdenGeneral();
$resul=$objorden3->mostrarinfodocuorden($codigonuevo);
$fila=mysqli_fetch_object($resul);
?>

<!--METODO PARA LISTAR LAS DESCARGAS DE UNA ORDEN-->
<?php
 $objdesc=new DescargaProcurador();
$result=$objdesc->mostrardescargaorden($codigonuevo);
$fild=mysqli_fetch_object($result);
?>


 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">INFORMACION</th>
  </tr>
  <tr  style="background: #B1EF07">  
    <td width="50%">CARGA  DE  INFORMACION  </td>
    <td width="50%">DESCARGA DE INFORMACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fila->informacion</td>";
    echo "<td>$fild->detalle_informacion</td>";
    ?>
  
  </tr>
 
</tbody>
</table><br>

 <table id="customers">
 <thead>     
  <tr>
    <th colspan="2">DOCUMENTACION</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">CARGA  DE  DOCUMENTACION   </td>
    <td width="50%">DESCARGA DE DOCUMENTACION</td>
  
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
    <?php
    echo "<td>$fila->documentacion</td>";
    echo "<td>$fild->documentaciondescarga</td>";
    ?>
  
  </tr>
 
</tbody>
</table><br>
 <table id="customers">
 <thead>     
  <tr>
    <th colspan="3">DINERO</th>
  </tr>
  <tr style="background: #B1EF07">  
    <td width="50%">PRESUPUESTO</td>
    <td width="25%">GASTO</td>
    <td width="25%">SALDO</td>
  
  </tr>

</thead>


<tbody>
  <tr>

  <?php
$objpresupuesto=new Presupuesto();
$list=$objpresupuesto->mostrarpresupuesto($codigonuevo);
$fila1=mysqli_fetch_object($list);
if ($fila1->id_presupuesto==null) {
  echo "<td> 00</td>";
}
else{
  echo "<td>$fila1->monto_presupuesto</td>";
}

///DESCARGA DEL DINERO GASTADO Y EL SALDO DE LA ORDEN
   echo "<td>$fild->gastos</td>";

   echo "<td>$fild->saldo</td>";
?>


    
  
  </tr>
 </tbody>
</table>
<table id="customers">
 <thead>     
<tr>  
    <th width="50%">DETALLE DEL PRESUPUESTO A GASTAR (CARGA DE DINERO)</th>
    <th width="50%">DETALLE DEL DINERO GASTADO (DESCARGA DE DINERO)</th>
  </tr>

</thead>
<tbody>
  <tr id="filaprosa">
   <?php
    echo "<td>$fila1->detalle_presupuesto</td>";

///DETALLE DEL GASTO DEL DINERO
   echo "<td>$fild->detalle_gasto</td>";

    ?>
  
  </tr>
 
</tbody>
</table><br><br>

<div id="divgastodescarga">
<!--<form method="post" >-->
 
   <input type="hidden" name="textidorden" placeholder="id orden" id="textidorden" value="<?php echo $codigonuevo; ?>"> 
   <input type="hidden" name="textiddescarga" placeholder="id descarga" id="textiddescarga" value="<?php echo $fild->id_descarga; ?>">
   
   <b><h3 style="color: #000000;font-size: 18px;text-align: left;">Para modificar el gasto,  el contador no debe haber hecho la devolucion de saldo</h3></b>
   <td>
   <?php
   /*AQUI SEPARAREMOS EL PRESUPUESTO LA PARTE ENTERA Y PARTE DECIMAL*/
        $parteentera= intval($fild->gastos);/*parte entera*/
        /*desde aqui se saca la parte decimal para hacerlo entero*/
        $aux = (string) $fild->gastos;
        $decimalpuro = substr( $aux, strpos( $aux, "." ) );
        $decimalentero= $decimalpuro*100;

   ?>
   <input style="width: 10%;" type="number" name="textnuevogasto" class="textform" id="textnuevogasto" required="" value="<?php echo $parteentera; ?>">
   <input style="width: 10%;" type="number" name="textnuevogastodecimal" class="textform" id="textnuevogastodecimal" required="" value="<?php echo $decimalentero; ?>"></td><br>
   <?php
     if ($fild->id_descarga=='') 
        {
          echo '<input type="submit" disabled="" style="margin-left: 1px; background:#85929E;" class="btnclose" name="btnmodgasto" id="btnmodgasto" value="MODIFICAR GASTO">';
        }  
        else
        {
          echo '<input type="submit" style="margin-left: 1px;" class="btnclose"  name="btnmodgasto" id="btnmodgasto" @click="modGastodescarga()"  value="MODIFICAR GASTO">';
        } 

   ?>
  
<!--</form>-->
<br><br><br>
</div>

</section>




<script type="text/javascript">
   var app=new Vue({
    el: '#divgastodescarga',
    data:{
        idordendescarga:0,
        iddescarga:0,
        gastoentero:0,
        gastodecimal:0,
       
        codencriptado:'',

        visibleboton:true,
    },

    methods:{
      modGastodescarga(){
          
          
          let me=this;
          //me.informacion='';
          me.idordendescarga=document.getElementById('textidorden').value;
          me.iddescarga=document.getElementById('textiddescarga').value;
          me.gastoentero=document.getElementById('textnuevogasto').value;
          me.gastodecimal=document.getElementById('textnuevogastodecimal').value;


         let cadena=new FormData();
         cadena.append("textidorden",this.idordendescarga);
          cadena.append("textiddescarga",this.iddescarga);
          cadena.append("textnuevogasto",this.gastoentero);
           cadena.append("textnuevogastodecimal",this.gastodecimal);
         

          axios.post("controller/control-modgastodescargaVuej.php?accion=modgasto",cadena)
          .then(function(response){
            var variable=response.data;
            var encrip=document.getElementById('textencrip').value;
   
            if (variable.error=='entregado') 
            {
               setTimeout(function(){  }, 2000); swal('ATENCION','No se puede Modificar el gasto, porque el contador ya hizo la devolucion del saldo','warning');
            }
            else
            {
              if (variable.error=='negativo') 
              {
                setTimeout(function(){  }, 2000); swal('ATENCION','No Puede Colocar Una Cantidad Menor A Cero','warning');
              }
              else
              {
                if (variable.error=='true') 
                {
                  setTimeout(function(){ location.href='ordenadmin.php?squart='+encrip }, 2000); swal('EXELENTE','Modifico el gasto Con Exito','success');
                }
                else
                {
                  if (variable.error=='false') 
                  {
                    setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico el gasto ','error');
                  }
                }
                
              }
            }
            console.info(response);


          });


         
      },
    }
   });
</script>


<!--****************************SECCION PARA MODIFICAR  LA CARGA DE INFORMACION Y DOCUMENTACION DEL ABOGADO********-->
<section>



<div class="container" id="divformcarga">

<!--<form method="POST" onsubmit="return validarForm(this);">-->
<input type="hidden" name="textencrip" id="textencrip" value="<?php echo $codorden; ?>">
<input type="hidden" name="textidorden1" id="textidorden1" placeholder="id orden" value="<?php echo $codigonuevo; ?>">
<h1 class="" style="font-size: 24px;"><b> SECCIÓN PARA MODIFICAR LA CARGA DE INFORMACIÓN, DOCUMENTACIÓN Y DETALLE DE PRESUPUESTO</b></h1><br>

<h3><strong> ADVERTENCIA.-</strong> Lo que se escriba a continuación será visualizado por el cliente y por todos los demás usuarios de este Sistema. </h3>
<br>
<table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>CARGA DE INFORMACIÓN</h3></td>
    </tr>
  </tbody>
</table>



    <div class="orden">
      <textarea name="texteditorinformacion" cols="30" rows="5" class="tinymce" id="texteditorinformacion"> <?php echo $fila->informacion; ?> </textarea>
    </div><br>

    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>CARGA DE DOCUMENTACIÓN</h3></td>
    </tr>
  </tbody>
</table>

    
    <div class="orden">
      <textarea name="texteditordocum" cols="30" rows="5" class="tinymce" id="texteditordocum"> <?php echo $fila->documentacion; ?> </textarea>
    </div>



    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>CARGA DEL DETALLE DEL PRESUPUESTO</h3></td>
    </tr>
  </tbody>
</table>

    
    <div class="orden">
      <textarea name="texteditordetallepresu" cols="30" rows="5" class="tinymce" id="texteditordetallepresu"> <?php echo $fila1->detalle_presupuesto; ?> </textarea>
    </div>



               <?php
               ini_set('date.timezone','America/La_Paz');
               $fechahoy=date("Y-m-d");
               $horita=date("H:i");
               $concat=$fechahoy.' '.$horita;
               //echo $concat;
               ?>

               
           
      <input style="width: 50%; margin-left: 1px;" type="submit" class="btnclose" name="btnmodcargainfodocdine" @click="modCargaInfoDP()" id="btnmodcargainfodocdine" value="MODIFICAR CARGA DE INFORMACIÓN, DOCUMENTACIÓN Y DETALLE DE PRESUPUESTO">
               
          
      
    <!--</form>-->
    </div>
</section><br><br>






<script type="text/javascript">
   var app=new Vue({
    el: '#divformcarga',
    data:{
        idordencarga:0,
        informacion:'',
        documentacion:'',
        detallepresu:'',
       

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
      modCargaInfoDP(){
          
          
          let me=this;
          me.informacion='';
          me.idordencarga=document.getElementById('textidorden1').value;

         

         let infsolotexto = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerText;
          let docsolotexto = tinymce.get('texteditordocum').contentDocument.activeElement.innerText;
          let detpresusolotexto = tinymce.get('texteditordetallepresu').contentDocument.activeElement.innerText;

          me.infosolotexto=infsolotexto;
          me.docusolotexto=docsolotexto;
          me.detallepresusolotexto=detpresusolotexto;



           let editinfo = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerHTML;
           me.informacion=editinfo;

          let editdoc = tinymce.get('texteditordocum').contentDocument.activeElement.innerHTML;
          me.documentacion=editdoc;

          let editdetpre = tinymce.get('texteditordetallepresu').contentDocument.activeElement.innerHTML;
          me.detallepresu=editdetpre;

         let cadena=new FormData();
         cadena.append("textidorden1",this.idordencarga);
          cadena.append("texteditorinformacion",this.informacion);
          cadena.append("texteditordocum",this.documentacion);
           cadena.append("texteditordetallepresu",this.detallepresu);

           cadena.append("infosolotexto",this.infosolotexto);
           cadena.append("docusolotexto",this.docusolotexto);
           cadena.append("detallepresusolotexto",this.detallepresusolotexto);


           

         

          axios.post("controller/control-modcarga_ordenajax.php?accion=crear",cadena)
          .then(function(response){
            var variable=response.data;
            var encrip=document.getElementById('textencrip').value;

            if (variable.error=='error1') 
            {
               setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning');
            }
            else
            {
              if (variable.error=='false') 
              {
                setTimeout(function(){  }, 2000); swal('ERROR','Al Parecer No Se Pudo Modificar El Detalle De Presupuesto ','warning');
              }
              else
              {
                if (variable.error=='true') 
                {
                  setTimeout(function(){ location.href='ordenadmin.php?squart='+encrip }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success');
                }
                
              }
            }



          });


         
      },
    }
   });
</script>

<!--*****************************FIN DE LA SECCION PARA MODIFICAR LA CARGA DE INFORMACION Y DOCUMENTACION******-->
<br><br><br>



<!--**************************************SECCION PARA MODIFICAR LA DESCARGA DE LA ORDEN, DECARGA DEL PROCURADOR*************-->


<section>

<div class="container" id="divformdescarga">
<!--<form method="POST" onsubmit="return validarForm(this);">-->

<input type="hidden" name="textidordendescarga" id="textidordendescarga" placeholder="id orden" value="<?php echo $codigonuevo; ?>">
<b><h3 style="font-size: 24px;"> SECCIÓN PARA MODIFICAR LA DESCARGA DE LA ORDEN </h3></b><br><br>


<table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DESCARGA DE INFORMACIÓN</h3></td>
    </tr>
  </tbody>
</table><br>
  
    <div class="orden">
      <textarea name="textdescargainf" cols="30" rows="5" class="tinymce" id="textdescargainf"> <?php echo $fild->detalle_informacion; ?> </textarea>
    </div><br>

    <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DESCARGA DE DOCUMENTACIÓN</h3></td>
    </tr>
  </tbody>
</table><br>
     
    <div class="orden">
      <textarea name="textdescargadoc" cols="30" rows="5" class="tinymce" id="textdescargadoc" > <?php echo $fild->documentaciondescarga; ?> </textarea>
    </div><br><br>
 <table id="customers">
  <tbody>
    <tr style="background: #1A5895; color: white;">
      <td><h3>DESCARGA DETALLE DE PRESUPUESTO</h3></td>
    </tr>
  </tbody>
</table><br>

    <div class="orden">
      <textarea name="textdetallegasto" cols="30" rows="5" class="tinymce" id="textdetallegasto" > <?php echo $fild->detalle_gasto; ?> </textarea>
    </div>
    <br>
    <div class="orden">
    <table >
      <tbody>
         <tr>
          <td width="400px"> <h3 style="text-align: left;"  class="titulo">FOJA</h3></td>
          <td width="35%"></td>
          
       </tr>

       <tr>
         <td><input type="text" class="textform" name="textfoja" style="width: 100%;" id="textfoja" placeholder="Foja" required="" value="<?php echo $fild->ultima_foja; ?>"></td>
         
       </tr>
      </tbody>
    </table>
      
     
    </div>
     
      
     
               <?php
               if ($fild->id_descarga=='') 
               {
                /*ESTE ES EL BOTON BLOQUEADO*/
                echo '<input  style="width: 30%; margin-left: 1px; background:#85929E; " class="btnclose" type="submit" disabled=""  name="btnmodinfodescarga" id="btnmodinfodescarga" value="MODIFICAR DESCARGA DE ORDEN">'; 
               }
               else
               {
                /*ESTE ES EL BOTON QUE EJECUTA LA MODIFICACION*/
                echo '<input  style="width: 30%; margin-left: 1px; " type="submit" class="btnclose" name="btnmodinfodescarga" @click="modDescargaInfoDP()" id="btnmodinfodescarga" value="MODIFICAR DESCARGA DE ORDEN">';
               }
               ?>
               
             


           
      
   <!-- </form>-->
    </div>
</section>




<script type="text/javascript">
   var app=new Vue({
    el: '#divformdescarga',
    data:{
        idordendescarga:0,
        informaciondescarga:'',
        documentaciondescarga:'',
        detallegasto:'',
        fojadescarga:'',
       

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
      modDescargaInfoDP(){
          
          
          let me=this;
          me.informaciondescarga='';
          me.idordendescarga=document.getElementById('textidordendescarga').value;
          me.fojadescarga=document.getElementById('textfoja').value;

         

         // me.foja=document.getElementById('textfoja').value;
         // me.gasto=document.getElementById('textgasto').value;
         //  me.gastodecimal=document.getElementById('textgastodecimal').value;
         // var content = tinymce.get('texteditorinformacion').contentDocument.documentElement.innerHTML;

        /* let editinfovacio = tinymce.get('texteditorinformacion').contentDocument.activeElement.innerText;
          let editdocvacio = tinymce.get('texteditordocum').contentDocument.activeElement.innerText;*/

          let infdescsolotexto = tinymce.get('textdescargainf').contentDocument.activeElement.innerText;
          let docdescsolotexto = tinymce.get('textdescargadoc').contentDocument.activeElement.innerText;
          let detgastdescsolotexto = tinymce.get('textdetallegasto').contentDocument.activeElement.innerText;

          me.infodescsolotexto=infdescsolotexto;
          me.docudescsolotexto=docdescsolotexto;
          me.detallegastdescsolotexto=detgastdescsolotexto;

           let editinfo = tinymce.get('textdescargainf').contentDocument.activeElement.innerHTML;
           me.informaciondescarga=editinfo;

          let editdoc = tinymce.get('textdescargadoc').contentDocument.activeElement.innerHTML;
          me.documentaciondescarga=editdoc;

          let editdetpre = tinymce.get('textdetallegasto').contentDocument.activeElement.innerHTML;
          me.detallegasto=editdetpre;

         let cadena=new FormData();
         cadena.append("textidordendescarga",this.idordendescarga);
          cadena.append("textdescargainf",this.informaciondescarga);
          cadena.append("textdescargadoc",this.documentaciondescarga);
           cadena.append("textdetallegasto",this.detallegasto);
           cadena.append("textfoja",this.fojadescarga);

           cadena.append("infodescsolotexto",this.infodescsolotexto);
           cadena.append("docudescsolotexto",this.docudescsolotexto);
           cadena.append("detallegastdescsolotexto",this.detallegastdescsolotexto);

           

         

          axios.post("controller/control-moddescargaajax.php?accion=crear",cadena)
          .then(function(response){
            var variable=response.data;
            var encrip=document.getElementById('textencrip').value;

            if (variable.error=='false') 
            {
               setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning');
            }
            else
            {
              if (variable.error=='true') 
              {
                setTimeout(function(){ location.href='ordenadmin.php?squart='+encrip }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success');
              }
              
            }



          });


         
      },
    }
   });
</script>



<!--************************************** FIN DE LA SECCION PARA MODIFICAR LA DESCARGA DE LA ORDEN, DECARGA DE LPROCURADOR*************-->


    </div>

    <br>
    <br>
    <br>





    <!--**********************MODAL ELIMINAR UNA ORDEN***********************************************************-->
<!-- The Modal (FORMULARIO) PARA eliminar orden -->
<div id="myModalformacep" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spancloseacep">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ESTA SEGURO DE ELIMINAR ESTA ORDEN ??</p></center>
     </div><br>
    <form method="post">
    <div class="modal-body">
      <input type="hidden" name="idorden" placeholder="id Orden" value="<?php echo $codigonuevo; ?>">
      

       <br>



    </div>
    <div class="modal-footer">
    <input style="background: #1A5895; max-width: 120px; float: left; width: 35%;" type="submit" class="btnclose" id="btnelimorden" name="btnelimorden" value="ELIMINAR">
    <button class="btnclose" id="btncloseformacep" style="float: right;" type="button">Cancelar</button>
      </form>

    </div>
  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA eliminar orden  -->
<script>
// Get the modal
var modalformacep = document.getElementById("myModalformacep");

// Get the button that opens the modal
var btnacep = document.getElementById("myBtnforelimorden");
var btncloseformac = document.getElementById("btncloseformacep");

// Get the <span> element that closes the modal
var spancloseacp = document.getElementById("spancloseacep");

// When the user clicks the button, open the modal 
btnacep.onclick = function() {
  modalformacep.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spancloseacp.onclick = function() {
  modalformacep.style.display = "none";
}
btncloseformac.onclick=function() {
  modalformacep.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>