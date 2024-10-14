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
    <title>Crear Causas</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
  
 <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

         <!--jquery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>


</head>
<body>
<?php
include_once('model/clsmateria.php');
include_once('model/clstipolegal.php');
include_once('model/clscliente.php');
include_once('model/clscategoria.php');
include_once('model/clsabogado.php');
include_once('model/clsprocurador.php');
include_once('model/clscausa.php');
include_once('model/clsplantilla.php');
include_once('model/clsposta.php');
include_once('model/clspostacausa.php');
//include_once('controller/control-causas.php');


$codcausa=$_GET['squart'];
  //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

  $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

/*MUESTRA TODA LA INFORMACION DE LA CAUSA PARA EDITAR*/
$objcausaAct=new Causa();
$resulact=$objcausa->mostrarDatosDeUnaCausa($codigonuevo);
$filca=mysqli_fetch_object($resulact);
$idcausa=$filca->id_causa;
$idmateria=$filca->id_materia;
$idtplegal=$filca->id_tipolegal;
$idcliente=$filca->id_cliente;
$nombcausa=$filca->nombrecausa;
$idcategoria=$filca->id_categoria;
$obser=$filca->obsevacionescausas;
$idabogado=$filca->id_abogado;
$idprocurador=$filca->id_procurador;

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
                    <li><button class="botones" onclick="location.href='tipolegal.php'">CREAR NUEVO TIPO LEGAL</button></li>
                    
                    <li><button class="botones" onclick="location.href='categoria.php'">CREAR NUEVA CATEGORIA</button></li>
                    <li><button class="botones" onclick="location.href='materia.php'">CREAR NUEVA MATERIA</button></li>
                </ul>
               
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

    <!--FORMULARIO REGISTRO USUARIOS-->
    
    <div class="container">
    <?php
    if ($idcausa!=null) 
    {
      echo ' <h3  class="titulo">MODIFICAR CAUSAS</h3>';
      $estadoselec='disabled=""';/*es el estado del select del cliente*/
     
    }
    else
    {
      echo '<h3  class="titulo">CREAR CAUSAS</h3>';
      $estadoselec='enabled=""';/*es el estado del select del cliente*/
     
    }
    /*CODIGO PARA VERIFIAR SI ESTA CAUSA TIENE PLATILLA ASIGNADA O NO*/
    /*VERIFICA SI TIENES POSTAS, ESTA CAUSA*/
    $objPostaCausa=new PostaCausa();
    $resulConteoPosta=$objPostaCausa->contadorDePostasCausaDeunaCausa($idcausa);
    $filaConteoPosta=mysqli_fetch_object($resulConteoPosta);
    if ($filaConteoPosta->cantidadPostas >0) /*POR VERDADERO, QUIERE DECIR QUE TIENE POSTAS Y SE PONE DISABLE EL SELECT DE PLANTILLAS*/
    {
       $estadoselectplantilla='disabled=""'; 
    }
    else/*POR FALSO, OSEA NO TIENE POSTAS Y NO TIENE PLANTILLAS, POR LO TANTO SE PUEDE ASIGNAR UNA PLANTILLA*/
    {
       $estadoselectplantilla='enabled=""';
    }


    ?>
    
  <div id="divformcausa">
 <!-- <form action="" method="post"  >-->

  <input type="hidden" name="textidcausa" id="textidcausa" placeholder="id causa" value="<?php echo $idcausa; ?>">
  <input type="hidden" name="textidadm" id="textidadm" placeholder="id admin" value="<?php echo $datos['id_usuario']; ?>">
    <div class="orden">
    <tr>
       <td><label for="country">MATERIA</label></td>
      <td> <select id="selectmat" name="selectmat" onchange="funcionllevaidmateria(this);" >
            <?php 
              $idmatexep=0;
              if ($idcausa!=null) 
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objmatdefec=new Materia();
              $resulmatdefec=$objmatdefec->listarUnaMateriaDeCausa($idcausa);
              $matf=mysqli_fetch_array($resulmatdefec);
              echo '<option value="'.$matf['idmateriaa'].'">'.$matf['abrevmatt'].'-'.$matf['nombmat'].'</option>';
              $idmatexep=$matf['idmateriaa'];
              }
              else
              {
                echo "<option value='0'>ASIGNE MATERIA</option>";
              }

              $objmat=new Materia();
              $liscat=$objmat->listarMateriasActivasExceptoUna($idmatexep);
              while($cat=mysqli_fetch_array($liscat)){
                
              echo '<option value="'.$cat['id_materia'].'">'.$cat['abreviaturamat'].'-'.$cat['nombremateria'].'</option>';
              }
            ?> 
       </select></td>

       </tr>
    </div>

    <div class="orden">
       <label>TIPO LEGAL</label>
       <select id="selecttplegal" name="selecttplegal">
            <?php
              $idtpexep=0;
              if ($idcausa!=null)  
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objtpdefec=new TipoLegal();
              $resultpdefec=$objtpdefec->listarUNtipolegalDeCausa($idcausa);
              $tpf=mysqli_fetch_array($resultpdefec);
              echo '<option value="'.$tpf['idtplegal'].'">'.$tpf['abrevtplegal'].'-'.$tpf['nomtplegal'].'</option>';
              $idtpexep=$tpf['idtplegal'];

              $objtpmat=new TipoLegal();
              $listtp=$objtpmat->listartipolegalActivosDeUnaMateriaExceptoUno($idtpexep,$idmateria);
              while($filtp=mysqli_fetch_array($listtp))
              {
                
              echo '<option value="'.$filtp['id_tipolegal'].'">'.$filtp['abreviaturalegal'].'-'.$filtp['nombretipolegal'].'</option>';
              }


              }
              else
              {
                echo "<option>ASIGNE TIPO LEGAL</option>";
              } 

             /* $objmat=new TipoLegal();
              $liscat=$objmat->listartipolegalActivosExceptoUno($idtpexep);
              while($cat=mysqli_fetch_array($liscat))
              {
                
              echo '<option value="'.$cat['id_tipolegal'].'">'.$cat['abreviaturalegal'].'-'.$cat['nombretipolegal'].'</option>';
              }*/

            ?> 
       </select>
    </div>

    

     <div class="orden">
       <label>CLIENTE</label>
       <select id="selectcli" name="selectcli" <?php echo $estadoselec; ?> >
            <?php 

              if ($idcausa!=null) 
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objcliefec=new Cliente();
              $resulclidefec=$objcliefec->mostrarUNClienteenCausa($idcausa);
              $clif=mysqli_fetch_array($resulclidefec);
             //CONSULTA ANTIGUA echo '<option value="'.$clif['idcli'].'">'.$clif['apellidocli'].'-'.$clif['nombrecli'].'</option>';
              echo '<option value="'.$clif['idcli'].'">'.$clif['apellidocli'].', '.$clif['nombrecli'].'</option>';
              }
              else
              {
                echo "<option>ASIGNE CLIENTE</option>";
              }
              $objmat=new Cliente();
              $liscat=$objmat->listarTodosClienteActivos();
              while($cat=mysqli_fetch_array($liscat)){
               echo '<option value="'.$cat['id_cliente'].'">'.$cat['apellidocli'].', '.$cat['nombrecli'].'</option>'; 
             //consulta antigua echo '<option value="'.$cat['id_cliente'].'">'.$cat['apellidocli'].'-'.$cat['nombrecli'].'</option>';
              }
            ?> 
       </select>
    </div>

    <div class="orden">
       <label>NOMBRE</label>
       <input type="text" id="textnombproceso" placeholder="Nombre de la causa..." name="textnombproceso" autocomplete="off" required="required" value="<?php echo $nombcausa; ?>">
    </div>
    
     <div class="orden">
       <label>CATEGORIA</label>
       <select id="selectcat" name="selectcat">
            <?php
              $idcatexep=0;
              if ($idcausa!=null) 
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objcatdefec=new Categoria();
              $resulcatdefec=$objcatdefec->listarUnacategoriaDeCausa($idcausa);
              $catf=mysqli_fetch_array($resulcatdefec);
              echo '<option value="'.$catf['idcat'].'">'.$catf['abreviaturacat'].'-'.$catf['nombrecat'].'</option>';
              $idcatexep=$catf['idcat'];
              }
              else
              {
                echo "<option>ASIGNE CATEGORIA</option>";
              }


              $objmat=new Categoria();
              $liscat=$objmat->listarcategoriaActivasExceptoUna($idcatexep);
              while($cat=mysqli_fetch_array($liscat)){
                
              echo '<option value="'.$cat['id_categoria'].'">'.$cat['abreviaturacat'].'-'.$cat['nombrecat'].'</option>';
              }
            ?> 
       </select>
    </div>
   


   

<div class="orden" style="">
       <label>OBSERVACIONES</label>
       
        <div style="margin-left:375px; width: 100%;">
   <textarea style="width: 100%;" name="textobserpro" cols="30" rows="5" class="tinymce" id="textobserpro"><?php echo $obser; ?></textarea>
      </div>
</div>
  
  <textarea style="display: none;" id="textobsersolotexto" name="textobsersolotexto"></textarea>

     <div class="orden">
       <label>ABOGADO GESTOR</label>
       <select id="selectabog" name="selectabog">
            <?php
             $idabogexep=0;
              if ($idcausa!=null) 
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objabogdefec=new Abogado();
              $resulabogdefec=$objabogdefec->listarUnAbogadosDeUnaCausa($idcausa);
              $abogf=mysqli_fetch_array($resulabogdefec);
             //consulta antigua echo '<option value="'.$abogf['idabog'].'">'.$abogf['nombreabog'].'-'.$abogf['apellidoabog'].'</option>';
             echo '<option value="'.$abogf['idabog'].'">'.$abogf['apellidoabog'].', '.$abogf['nombreabog'].'</option>';
              $idabogexep=$abogf['idabog'];
              }
              else
              {
                echo "<option>ASIGNE ABOGADO</option>";
              }


              $objmat=new Abogado();
              $liscat=$objmat->listarTodosAbogadosActivosExceptoUno($idabogexep);
              while($cat=mysqli_fetch_array($liscat)){
               echo '<option value="'.$cat['id_abogado'].'">'.$cat['apellidoabog'].', '.$cat['nombreabog'].'</option>'; 
              //consulta antigua echo '<option value="'.$cat['id_abogado'].'">'.$cat['nombreabog'].'-'.$cat['apellidoabog'].'</option>';
              }
            ?> 
       </select>
       <input type="hidden" name="textidabogadoactual" id="textidabogadoactual" value="<?php echo $idabogexep; ?>">
    </div>

    <div class="orden">
       <label>PROCURADOR POR DEFECTO</label>
       <select id="selectproc" name="selectproc">
            <?php
              $idprocexep=0;
              if ($idcausa!=null) 
              {  /*CODIGO QUE SE EJECUTA SELECCIONAR UNA CAUSA PARA MODIFICAR*/
              $objprocdefec=new Procurador();
              $resulprocdefec=$objprocdefec->mostrarprocuradorpordefectodecausa($idcausa);
              $procf=mysqli_fetch_array($resulprocdefec);
              //consulta antigua echo '<option value="'.$procf['idproc'].'">'.$procf['Nombre'].'-'.$procf['Apellidos'].'--'.$procf['Tipo'].'</option>';
              echo '<option value="'.$procf['idproc'].'">'.$procf['Apellidos'].', '.$procf['Nombre'].'</option>';
              $idprocexep=$procf['idproc'];
              }
              else
              {
                echo "<option>ASIGNE PROCURADOR</option>";
              }


              $objmat=new Procurador();
              $liscat=$objmat->listarprocuradoresexeptouno($idprocexep);
              while($cat=mysqli_fetch_array($liscat)){
              echo '<option value="'.$cat['idproc'].'">'.$cat['Apellidos'].', '.$cat['Nombre'].'</option>';
           //consulta antigua   echo '<option value="'.$cat['idproc'].'">'.$cat['Nombre'].'-'.$cat['Apellidos'].'--'.$cat['Tipo'].'</option>';
              }
            ?> 
       </select>
        <input type="hidden" name="textidprocactual" id="textidprocactual" value="<?php echo $idprocexep; ?>">
    </div>


    

    <div class="orden">
       <label style="float: left;">ASIGNAR PLANTILLA</label>
      <select name="selectplantilla" id="selectplantilla" <?php echo $estadoselectplantilla; ?>  >
        <option value="0">ASIGNE UNA PLANTILLA</option>
        
        <?php
        $objplant=new Plantilla();
        $resultplant=$objplant->listarplantillasActivasConPostas();
        while($filpla=mysqli_fetch_array($resultplant))
        {   
           echo '<option value="'.$filpla['id_plantilla'].'">'.$filpla['nombreplantilla'].'</option>';
        }
        ?>
      </select>
    </div>
    
    <?php
    if ($idcausa!=null) 
    {
     echo '<input type="submit" value="MODIFICAR" id="btnmodiproceso"  @click="modificarCausa()" name="btnmodiproceso">'; 
    }
    else
    {
      echo '<input type="submit" value="GUARDAR"  @click="insertarCausa()" id="btncrearproceso" name="btncrearproceso">';
    }
    ?>
    
   <center>  <div id="cargar"> <div ><img src="cargando.gif" style="width: 50px;height: 50px"></div></div></center>


 <!-- </form>-->

</div>

<script type="text/javascript">
  function escribirsolotexto()
  {
   var observ= tinymce.get('textobserpro').contentDocument.activeElement.innerText;
     $('#textobsersolotexto').val(observ);
    //alert(observ);
  }
</script>
   
</div>
    <br>
    <br>
    <br>

<script type="text/javascript" src="js/vuejs/vue.js"></script>
<script type="text/javascript" src="js/axios/axios.min.js"></script> 

<script type="text/javascript" src="resources/jquery.js"></script>
<script type="text/javascript" src="resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymcedemandado/tinymce.min.js"></script>
    <script type="text/javascript" src="resources/tinymce/plugin/tinymcedemandado/init-tinymce.js"></script>
</body>
</html>
<script type="text/javascript">
   /* $(function() {
  var f = function() {
    $(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
  };
  $('input').change(f).trigger('change');
});*/
</script>



<script type="text/javascript">
  function funcionllevaidmateria(obj){

    var dato= obj.options[obj.selectedIndex].value; 
  if (dato>0) 
    {
      $.ajax({ 
        url:'consultaTplegalmat.php',
        type:'POST',
        dateType:'html',
        data:{dato:dato},

      })
   
    .done(function(resul){
      $('#selecttplegal').html(resul);
      
      })

    $('#customers').hide();
   }

} 
</script>




<script type="text/javascript">
  $('#cargar').hide();
   var app=new Vue({
    el: '#divformcausa',
    data:{
        idcausamod:0,

        idmateria:0,
        idtipolegal:0,   
        idcliente:0,
        nombrecausa:'',
        idcategoria:0,
        observaciones:'',
        observtexto:'',
        idabogado:0,
        idprocurador:0,
        idplantilla:0,
        idadmin:0,
   
    },

    methods:{
      insertarCausa(){
          $('#btncrearproceso').hide();
          
           $('#cargar').show();
          
          let me=this;
          
          me.idmateria=document.getElementById('selectmat').value;
          me.idtipolegal=document.getElementById('selecttplegal').value;
          me.idcliente=document.getElementById('selectcli').value;

          me.nombrecausa=document.getElementById('textnombproceso').value;
          me.idcategoria=document.getElementById('selectcat').value;

           let observacioneshtml = tinymce.get('textobserpro').contentDocument.activeElement.innerHTML;
           me.observaciones=observacioneshtml;

           let observacionestexto = tinymce.get('textobserpro').contentDocument.activeElement.innerText;
           me.observtexto=observacionestexto;

          me.idabogado=document.getElementById('selectabog').value;
          me.idprocurador=document.getElementById('selectproc').value;
          me.idplantilla=document.getElementById('selectplantilla').value;
          me.idadmin=document.getElementById('textidadm').value;
         

          let cadena=new FormData();
          cadena.append("selectmat",this.idmateria);
          cadena.append("selecttplegal",this.idtipolegal);
          cadena.append("selectcli",this.idcliente);
          cadena.append("textnombproceso",this.nombrecausa);
          cadena.append("selectcat",this.idcategoria);

          cadena.append("textobserpro",this.observaciones);
          cadena.append("textobsersolotexto",this.observtexto);

          cadena.append("selectabog",this.idabogado);
          cadena.append("selectproc",this.idprocurador);
          cadena.append("selectplantilla",this.idplantilla);
          cadena.append("textidadm",this.idadmin);
         
          axios.post("controller/control-regcausaVuej.php?accion=crear",cadena)
          .then(function(response){
            var variable=response.data;
            console.log(response);
            if (variable.error=='false') 
            {
              $('#btncrearproceso').show();
          
              $('#cargar').hide();
               setTimeout(function(){  }, 2000); swal('ERROR',' No se Creo La Causa','warning');
            }
            else
            {
              if (variable.error=='true') 
              {
                setTimeout(function(){ location.href='causasActivas.php' }, 1000); swal('EXELENTE','Se Creo La Causa Con Exito','success');
              }
              
            }




          });

         
      },/*fin de la funcion crear causa*/


      modificarCausa(){
          $('#btnmodiproceso').hide();
          
           $('#cargar').show();
          
          
          let me=this;
          
          me.idmateria=document.getElementById('selectmat').value;
          me.idtipolegal=document.getElementById('selecttplegal').value;
          me.idcliente=document.getElementById('selectcli').value;

          me.nombrecausa=document.getElementById('textnombproceso').value;
          me.idcategoria=document.getElementById('selectcat').value;

           let observacioneshtml = tinymce.get('textobserpro').contentDocument.activeElement.innerHTML;
           me.observaciones=observacioneshtml;

           let observacionestexto = tinymce.get('textobserpro').contentDocument.activeElement.innerText;
           me.observtexto=observacionestexto;

          me.idabogado=document.getElementById('selectabog').value;
          me.idprocurador=document.getElementById('selectproc').value;
          me.idplantilla=document.getElementById('selectplantilla').value;
          me.idadmin=document.getElementById('textidadm').value;
          me.idcausamod=document.getElementById('textidcausa').value;
          /*DATOS DEL ABOGADO ACTUAL Y PROCURADOR ACTUAL*/
          me.idabogactual=document.getElementById('textidabogadoactual').value;
          me.idprocactual=document.getElementById('textidprocactual').value;
         

          let cadena=new FormData();
          cadena.append("selectmat",this.idmateria);
          cadena.append("selecttplegal",this.idtipolegal);
          cadena.append("selectcli",this.idcliente);
          cadena.append("textnombproceso",this.nombrecausa);
          cadena.append("selectcat",this.idcategoria);

          cadena.append("textobserpro",this.observaciones);
          cadena.append("textobsersolotexto",this.observtexto);

          cadena.append("selectabog",this.idabogado);
          cadena.append("selectproc",this.idprocurador);
          cadena.append("selectplantilla",this.idplantilla);
          cadena.append("textidadm",this.idadmin);

          cadena.append("textidcausa",this.idcausamod);
          /*DATOS DEL PROCURADOR Y ABOGADO ACTUAL*/
          cadena.append("textidabogadoactual",this.idabogactual);
          cadena.append("textidprocactual",this.idprocactual);
         
          axios.post("controller/control-modcausaVuej.php?accion=modificar",cadena)
          .then(function(response){
            var variable=response.data;
            console.log(response);
            if (variable.error=='false') 
            {
              $('#btncrearproceso').show();
          
               $('#cargar').hide();
          
               setTimeout(function(){  }, 2000); swal('ERROR',' No se modifico La Causa','warning');
            }
            else
            {
              if (variable.error=='true') 
              {
                setTimeout(function(){ location.href='causasActivas.php' }, 1000); swal('EXELENTE','Se modifico La Causa Con Exito','success');
              }
              
            }




          });

         
      },/*fin de la funcio de mod causa*/




    }

   });
</script>

