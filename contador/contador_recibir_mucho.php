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
<head><meta charset="gb18030">
	<title>Devolver Muchos</title>
  <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/formularios.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>

     <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
</head>
<body >
<?php
include_once('../model/clsprocurador.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsdescarga_procurador.php');
include_once('../model/clsconfirmacion.php');


include_once('../model/clspresupuesto.php');


include_once('../model/clscotizacion.php');
include_once('../model/clscausa.php');
include_once('../model/clscostofinal.php');
include_once('../model/clscajasdesalida.php');
include_once('../model/clscontador.php');

$_SESSION['sumatotal']=0;
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
        
        <div id="main_menu">
            <ul>
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->	
	</div><!-- FIN container -->
</div><!-- FIN header -->
<div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                 <?php
                  //////FUNCIONES PARA MOSTRAR EL TOTAL DE CADA ORDEN EN SUS PASOS DE SEGUIMUIENTO
                   $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradas();
                   $fil1=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadas();
                   $fil2=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadas();
                   $fil3=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregado();
                   $fil4=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizar();
                   $fil5=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadas();
                   $fil6=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenespronunciabogado();
                   $fil7=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenespronunciocontador();
                   $fil8=mysqli_fetch_object($resul8);

                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGraves();
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resulpre_presu=$objorden1->mostrartotalordenesPre_presupuestadas();
                   $filprepresu=mysqli_fetch_object($resulpre_presu);

                  ?>
                
                <ul>
                    
                    <li><button class="botones" onclick="location.href='contador_entregar_muchos.php'" style="width: 610px; height: 60px;">ENTREGAR MUCHOS</button></li>
                    <li><button class="botones" onclick="location.href='contador_recibir_mucho.php'" style="width: 585px; height: 60px;">DEVOLVER MUCHOS</button></li>
                </ul><br><br>
                 <ul>
                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenesgiradas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil1->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

                     <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenespresupuestadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenesaceptadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: INF/DOC  &nbsp;&nbsp;ENTREGADOS &nbsp;</button></li>
                   
                    <li><button class="botones" style="width: 140px; height: 55px; " onclick="location.href='causasordenesdineroentregado.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

                    <li><button class="botones" style="width: 140px; height: 55px;" onclick="location.href='causasordeneslistasparadescargar.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasordenesdescargadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>
                   
                    <li><button class="botones" onclick="location.href='causasordenespronunciadasabogado.php'" style="width: 160px; height: 55px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenespronunciadascontador.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>
                   
               
           
                    
                </ul><br>

                <ul>
                            
                    <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDAS LEVES</button></li>
                    
                    <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDAS GRAVES</button></li>
                     
                    <li><button class="botones" style="width: 145px; height: 55px; ">IMPRIMIR</button></li>
                </ul>
                <br>
                <br> 
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

 <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
<!-- boton para el paso intermedio -->
<div >
      <table width="100%">
        <tr>
          <td width="40%"> 
            <button style="height: 55px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepresu->Totalpre_presupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="../resources/imagenedesistema/Intermedio.png"></button>
          </td>
          <td width="60%">
           <h3 style="color: #000000;font-size: 25px;">DEVOLVER MUCHOS </h3>
          </td>
        </tr>
      </table>  
    </div>
<!-- boton para el paso intermedio -->
    
    <br>
  

    <form method="post">
     <div class="orden">
       <select id="selectproc" name="selectproc" style="width: 30%;" onchange="this.form.submit()">   
          <option >SELECIONE UN PROCURADOR</option>  
          <?php
         $objproc=new Procurador();
         $listp=$objproc->listarprocurador();
        while($proc=mysqli_fetch_array($listp)){
                echo '<option value="'.$proc['id_procurador'].'">'.$proc['apellidoproc'].', '.$proc['nombreproc'].'</option>';
            //antiguo     echo '<option value="'.$proc['id_procurador'].'">'.$proc['nombreproc'].' '.$proc['apellidoproc'].'--'.$proc['tipoproc'].'</option>';
               }
          ?>      
           
            
       </select>
    </div>
    <?php

    if (isset($_POST['selectproc'])) {
       $idp=$_POST['selectproc'];
        $objproc2=new Procurador();
        $listt=$objproc2->mostrarunprocuradro($idp);
        $procu=mysqli_fetch_array($listt);
       echo '<b>Procurador: </b>'; echo $procu['Nombre']; 
    }
   

    ?>
   <section class="responsive">

<br>
<table id="tabladevolvermuchos">
 <thead>    
  <tr>
    <th rowspan="2" width="50px" style="font-size: 10px;">ORDEN </th>
    <th rowspan="2" width="65px" style="font-size: 10px;">CAUSA</th>
    <th colspan="2" style="font-size: 10px;">CARGA</th>
    <th colspan="2" style="font-size: 10px;">DESCARGA</th>
    <th  rowspan="2" width="50px">MONTO ENTREGADO</th>
    <th rowspan="2" width="50px">MONTO GASTADO</th>
    <th rowspan="2" width="65px">MONTO POR DEVOLVER</th>
    <th rowspan="2" width="50px">SELECCIONAR</th>
  </tr >
    <tr style="background: #B1EF07; ">
    <td width="225px" style="font-size: 10px;">INFORMACION</td>
    <td width="200px" style="font-size: 10px;">DETALLE DE DINERO</td>
    <td width="230px" style="font-size: 10px;">INFORMACION</td>
    <td width="200px" style="font-size: 10px;">DETALLE DE DINERO </td>   
    </tr>

</thead>
<tbody id="listaregistros">
<tr>
<!--
    <td>6484455667</td>
    <td><a href="contador_ficha.php">F-DIVORCIO-36</a></td>
    <td>prosa </td>
    <td>. 200 bs en el poder especial. 50 en transporte</td>
    <td> prosa</td>
    <td>. 200 bs en el poder especial. 50 en transporte</td>
    <td>50</td>
    <td>45</td>
    <td>5</td>
    <?php
    $nom=2;
    ?>
    <td><input style="width: 23px; height: 23px; background: red;" type="checkbox" onclick="funcionpp(this.form)" value="array[2]"  name="cheq<?php echo $nom;?>" id="cheq<?php echo $nom;?>" ></td>
    <script type="text/javascript">
       
     function funcionpp(form)
     {
        
           
        /*
         * Al hacer clic sobre el checkbox verificamos si esta activado o no
         * y asi alternamos entre el tipo de input donde esta la contrasena
         * entre text y password
         */
        
          if ($('#cheq2').is(':checked')) {
            alert('esta chequeado putos');
          } else {
            alert('ya no esta chequeado putos');
          }
     
     


        
     }

       
    </script>-->

    <?php
    if (isset($_POST['selectproc'])) {

        $idproc=$_POST['selectproc'];

      
        //echo $idproc;
        $contadorsito=0;
        $objorden=new OrdenGeneral();
        $listor=$objorden->consultaparadevolvermuchos($idproc);
        while ($fil=mysqli_fetch_object($listor)){
            $contadorsito++;
            
            $objordencon=new OrdenGeneral();
              $muestra=$objordencon->mostrarfechaypronuncionabogado($fil->Codorden);
              $filac1=mysqli_fetch_object($muestra);
              if ($filac1->fechaabog!='') /*PREGUNTA SI LA FECHA DE PRONUNCIAMIENTO DEL ABOGADO ES DIFERENTE DE VACIA(SI YA SE PRONUNCIO EL ABOGADO)*/
              {
                  if ($filac1->confabog==0)/*PREGUNTA SI EL PRONUNCIAMIENTO DEL ABOGADO ES 0 (SI SE RECHAZO)*/
                  {
                    $bgcdescarga='#ff0000';/*COLOR DEL BACKGROUND ROJO*/
                      $fontcolordes='white';/*COLOR DE LAS LETRAS BLANCAS*/
                   // echo '<button class="btninforechazo" id="myBtn">??</button>';
                  }
                    else/*POR FALSO, EL PRONUNCIAMIENTO ES 1 (APROBADO)*/
                      {
                        $bgcdescarga='#009900';/*COLOR DEL BACKGROUND VERDE*/
                        $fontcolordes='white';/*COLOR DE LAS LETRAS BLANCAS*/
                      }
              }
              else/*POR FALSO, AUN EL ABOGADO NO HIZO SU PRONUNCIAMIENTO*/
              {
                $bgcdescarga='#ffffff';/*COLOR DEL BACKGROUND BLANCO*/
                $fontcolordes='black';/*COLOR DE LAS LETRAS NEGRAS*/
              }
            echo "<tr style='font-size: 10px;'>";
            echo "<td style='font-size: 10px;'>$fil->Codorden</td>";
            echo "<td style='font-size: 10px;'>$fil->codigocausa</td>";
            echo "<td style='font-size: 10px; text-align: justify;'>$fil->infoorden</td>";
            echo "<td style='font-size: 10px; text-align: justify;'>$fil->Infopresupuesto</td>";
            echo "<td style='font-size: 10px; text-align: justify; background:$bgcdescarga; color:$fontcolordes;'>$fil->Infodescarga</td>";
            echo "<td style='font-size: 10px; text-align: justify; background:$bgcdescarga; color:$fontcolordes;'>$fil->Infogastodesc</td>";
            echo "<td style='font-size: 12px;'>$fil->Montopresu</td>";
            echo "<td style='font-size: 12px;'>$fil->Gastodescarga</td>";
            echo "<td style='font-size: 12px;'>$fil->Saldodevolver</td>";
            echo "<td><input style='width: 23px; height: 23px;' type='checkbox' name='lista[]' id='lista[]' data-idRegistro='$fil->Saldodevolver' value='$fil->Codorden' ></td>";
            echo "</tr>";

        }
        
    }

     
    ?>



</tr>
<tr>
    <td colspan="8">MONTO TOTAL DE DINERO POR DEVOLVER</td>
    <td colspan="1" style="padding: -2px -2px;"><input style="font-size: 12px; font-weight: bold;padding: 0px 0px 0px 0px; border: 0px solid #000; height: 20px; width: 55px;" type="text" name="texttotaldev" id="texttotaldev" readonly="readonly" ></td>
</tr>
</tbody>
</table>
</section>
<br>
   <form method="post">
     <input type="submit" name="btndevolvermuchos" value="APLICAR">
     </form>

</form>

   </div><br>

</body>
</html>
<script type="text/javascript">
   function llamaArchivoEnviaCorreoDevolverCont(idprocu,idcontador)
      {
        var formDataVenta = new FormData(); 
        var fechadevuelto=$('#textfecha').val();
        var montodevolver=$('#textmontodevolver').val(); 
        var tabladetalle=$('#texttabla').val();
        var idprocu=idprocu;
        var idcontador=idcontador;
        

        formDataVenta.append('fechadevuelto',fechadevuelto);
     formDataVenta.append('montodevolver',montodevolver);
     formDataVenta.append('tabladetalle',tabladetalle);
     formDataVenta.append('idprocu',idprocu);
     formDataVenta.append('idcontador',idcontador);
      $.ajax({ url: '../controller/control-enviaCorreoDevolverCont.php', 
               type: 'post', 
               data: formDataVenta, 
               contentType: false, 
               processData: false, 
               success: function(response){
               console.info(response); 
                /*if (response==1) 
                {}*/ 
               // alert(response);

            }
            });
      }//fin de funcion lama archivo envia correo
</script>
<?php
if (isset($_POST['btndevolvermuchos'])) 
{
       
       ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       $concat=$fechoyal.' '.$horita;

       
       $contadorlista=$_POST['lista'];

       $nuevocont=count($_POST['lista']);
       $totaldevolver=0;
       $arrayid=array();
       //PREGUNTA SI SE SELECCIONO ALGUN CHECKBOX 
    if ($nuevocont>0) 
    {

               $obcaj=new Cajasdesalida();
               $lss=$obcaj->mostrarcajadelcontador();
               $fll=mysqli_fetch_object($lss);
               $saldocontador=$fll->cajacontador;
        
               $totaldev=$_POST['texttotaldev'];
               $futuracajacontador=$saldocontador+($totaldev);

               $contadorproab=0;
               $contadorsinab=0;

               $acumuladosaldodevolver=0;
               $contadordevueltos=0;
            //////PREGUNTA SI TIENE SALDO EN CAJA PARA DEVOLVER SI UBIESE QUE DEVOLVER DINERO AL PROCURADOR
          if ($futuracajacontador>=0) 
          {
/*--------------COMPLEMENTO DEL MENSAJE----------------------------------*/
$devolvio = stripslashes('devolvi��'); /*se pasa los datos para que se interprete*/
    $devolvio = iconv('UTF-8', 'windows-1252', $devolvio);
            $idprocurador3=0;         
             $_SESSION['mensajepago']="En Fecha $concat, usted $devolvio el monto de  $totaldev bolivianos (descarga de dinero)  conforme al siguiente detalle:   \n"; 
             //CODIGO PARA ACTUALIZAR LA CAJA DEL CONTADOR
              $obcaja=new Cajasdesalida();
              $lss=$obcaja->mostrarcajadelcontador();
              $fll=mysqli_fetch_object($lss);
              $saldocontador1=$fll->cajacontador;

              $tabladetalledevolver="";

              ////$values es el codigo de la orden
              foreach ($contadorlista as $key => $value)/*FOREACH QUE RRECORRE TODAS LAS ORDENES TIQUEADAS OSELECCIONADAS*/ 
              {
                $objverif=new Confirmacion();
                $resulconfir=$objverif->mostrarfechaconfircontador($value);/**/
                $filveri=mysqli_fetch_object($resulconfir);
                /*PREGUNTA SI LA FECHA DE CONFIRMACION DEL CONTADOR ESTA VACIA,OSEA NO HIZO LA DEVOLUCION*/ 
                if ($filveri->fecha_confir_contador=='')
                {
                  
                

                $objdescarga=new DescargaProcurador();
                $listado=$objdescarga->mostrarsaldodescarga($value);
                $fila=mysqli_fetch_object($listado);
                $totaldevolver=$totaldevolver+$fila->saldo;
                array_push($arrayid,$value);
                
                $acumuladosaldodevolver=$acumuladosaldodevolver+$fila->saldo;
                $contadordevueltos++;
         /////PRIMERO SE PREGUNTA SI LA ORDEN ESTA PARA REGISTRAR COMO PRONUNCIAMIENTO DEL CONTADOR, O ESTA PARA FINALIZAR
                $objconf=new Confirmacion();
                $resull=$objconf->mostrarfechaconfirabogado($value);
                $filac=mysqli_fetch_object($resull);
                //si fecha esta vacia, solo se registrara el pronunciamienro del cotador
                  if ($filac->fecha_confir_abogado=='') 
                  {
  ////////////////////AQUI SOLO SE REGISTRA EL PRONUNCIAMIENTO DEL CONTADOR//////////////////////////////////////////
                     $obconfir=new Confirmacion();
                     $listadocon=$obconfir->mostrarcodconfirmacion($value);
                     $filaconf=mysqli_fetch_object($listadocon);
                     $codconfirm=$filaconf->codconfir;
                      ///FUNCION QUE  REGISTRA EL PRONUNCIAMIENTO DEL CONTADOR////////
                     $objconfir=new Confirmacion();
                     $objconfir->setconfircontador(1);
                     $objconfir->setfechaconfircontador($concat);
                     $objconfir->setid_confirmacion($codconfirm);

                     $objconfir->registrarpronunciamientoContador();
                      ///HASTA AQUI PRONUNCIAMIENTO CONTADOR/////////////////////////
                      //AQUI SE CAMBIA EL ESTADO DE LA ORDEN///////
                     $orden1=new OrdenGeneral();
                     $orden1->setid_orden($value);                
                     $orden1->setestadoorden('PronuncioContador');
                     $orden1->cambiarestadodeorden();
                    ///HASTA AQUI FUNCION QUE CAMBIA EL ESTADO
                   ///EL CONTADOR VALIDA LA DESCARGA DEL PROCURADOR////////////////////
                     $objdes=new DescargaProcurador();
                     $objdes->setid_orden($value);
                     $objdes->setvalidado('Si');
                     $objdes->validardescarga();

                      //FUNCION QUE CAMBIA EL ESTADO DEL PRESUPUESTO, OJO POR ES UNA PRUEBA SIN SERRAR LA ORDEN 
                          $obpre=new Presupuesto();
                          $obpre->setestadopresupuesto('Gastadoconfir');
                          $obpre->setid_orden($value);
                          $obpre->cambiarelestadodepresupuesto();

        ///HASTA AQUI LA VALIDACION DE LA DESCARGA//////////////
                           $contadorsinab++;
                  }/*FIN DEL IF QUE PREGUNTA SI LA FECHA DE CONFIRMACION DEL ABOGADO ESTA VACIA*/
//DESDE AQUI SI LA FECHA NO ESTA VACIA, SE HARA EL SIERRE DE LA ORDEN Y SE ASIGNARA LOS VALORES, SI LA ORDEN ES SUFICIENTE O NO  
                   else{

                 ////SACAMOS LOS NUMEROS CON LOS QUE FUERON COTIZADO LA ORDEN
                          $objcotizacion=new Cotizacion();
                          $lista=$objcotizacion->mostrarcotizaciondeorden($value);
                          $filcot=mysqli_fetch_object($lista);
                          $compraprocu=$filcot->compra;
                          $ventaprocu=$filcot->venta;
                          $penalidad=$filcot->penalizacion;

      /////////////FUNCION QUE MUESTRA LO QUE NOS COSTO PROCESAL (LO QUE NOSOTROS GASTAMOS)
                          $objdesc=new DescargaProcurador();
                          $listad=$objdesc->mostrarcomprajudicialdeorden($value);
                          $fild=mysqli_fetch_object($listad);
                          $compjudicial=$fild->comprajudicial;

                          $egresototal=$compjudicial+$ventaprocu;

                          $gananciaprocuradoria=$ventaprocu-$compraprocu;

                    //FUNCION QUE CAMBIA EL ESTADO DEL PRESUPUESTO, OJO POR EL MOMENTO ESTA CUANDO SE TIENE QUE SERRAR LA ORDEN 
                          $obpre=new Presupuesto();
                          $obpre->setestadopresupuesto('Gastadoconfir');
                          $obpre->setid_orden($value);
                          $obpre->cambiarelestadodepresupuesto();
               

                 ///FUNCION QUE MUESTRA EL CODIGO DE CONFIRMACION, APARTIR DEL CODIGO DE UNA ORDEN
                          $obconfir1=new Confirmacion();
                          $listadocon1=$obconfir1->mostrarcodconfirmacion($value);
                          $filaconf=mysqli_fetch_object($listadocon1);
                          $codconfirm=$filaconf->codconfir;
                       /*FUNCION QUE SEIRRA LA ORDEN*/
                          $orden1=new OrdenGeneral();
                          $orden1->setid_orden($value); 
                          $orden1->setestadoorden('Serrada');
                          $orden1->cambiarestadodeorden();

                 //FUNCION PARA REGISTARAR EL PRONUNCIAMIENTO DEL CONTADOR , EN LA TABLA CONFIRMACION
                          $objconfir=new Confirmacion();
                          $objconfir->setid_confirmacion($codconfirm);
                          $objconfir->setconfircontador(1);
                          $objconfir->setfechaconfircontador($concat);
                          $objconfir->pronunciamientocontador();

                          $obconf=new Confirmacion();
                          $list=$obconf->mostrarlaconfirmaciondelsistemayabogado($codconfirm);
                          $filaco=mysqli_fetch_object($list);
            ////////////////DESDE AQUI SE ASIGNA VALORES A COSTOS FINALES////////////
/////////////////verifica que las dos confirmaciones sean 1 , caso contrario se asignan otros valores 
                          if ($filaco->confir_sistema==1 and $filaco->confir_abogado==1) 
                              {
                
                                /*FUNCION QUE GUARDA EL COSTO FINAL EN LA BASE DE DATOS*/             
                                $objcostofin=new Costofinal();
                                $objcostofin->setcosto_procuradoria_compra($compraprocu);
                                $objcostofin->setcosto_procuradoria_venta($ventaprocu);
                                $objcostofin->setcosto_prosesal_venta($compjudicial);

                                 $objcostofin->setCostoprocesalCompra($compjudicial);

                                $objcostofin->settotal_egreso($egresototal);
                                $objcostofin->setid_orden($value);
                                $objcostofin->setpenalidadcostofinal(0);
                                $objcostofin->setmalgasto(0);
                                $objcostofin->setvalidadofinal('No');
                                $objcostofin->setcanceladoprocurador('No');
                                $objcostofin->setgananciaprocuradoria($gananciaprocuradoria);
                                $objcostofin->setgananciaprocesal(0);

                                $objcostofin->guardarcostofinal();
                               /*MUESTRA EL ID CAUSA A PARTIR DE ID ORDEN*/
                                $objo=new OrdenGeneral();
                                $lis=$objo->mostraridcausadeunaorden($value);
                                $filc=mysqli_fetch_object($lis);
                                $idcausa=$filc->id_causa;
                                /*CALIFICACION DE LA ORDEN COMO SUFICIENTE*/
                                $objor=new OrdenGeneral();
                                $objor->setid_orden($value);
                                $objor->setcalificacion('Suficiente');
                                $objor->setfechacierre($concat);
                                $objor->ultinacalificacion();
                               /*MUESTRA EL SADO DE CAJA DE LA CAUSA*/
                                $obca=new Causa();
                                $li=$obca->mostrarcajacausa($idcausa);
                                $filca=mysqli_fetch_object($li);
                                $saldocaja=$filca->caja;

                                $nuevosaldo=$saldocaja-$egresototal;
                            /*MODIFICA EL SALDO DE LA CAJA DE LA CAUSA*/
                                $objcausa=new Causa();
                                $objcausa->setid_causa($idcausa);
                                $objcausa->setcajacausa($nuevosaldo);
                                $objcausa->modificarcajadecausa();
                /////EL CONTADOR VALIDA LA DESCARGA   /////////////////////////
                                $objdes=new DescargaProcurador();
                                $objdes->setid_orden($value);
                                $objdes->setvalidado('Si');
                                $objdes->validardescarga();
/*///////CODIGO PARA ACTUALIZAR LA CAJA DEL CONTADOR////////////////            (SE ACTUALIZARA DE OTRA MANERA)
                                $obdesc=new DescargaProcurador();
                                $lst=$obdesc->mostrardescargaorden($_POST['idorden']);
                                $fl=mysqli_fetch_object($lst);
                                $saldodesc=$fl->saldo;

                                $obcaj=new Cajasdesalida();
                                $lss=$obcaj->mostrarcajadelcontador();
                                $fll=mysqli_fetch_object($lss);
                                $saldocontador=$fll->cajacontador;

                                $nuevosaldocontador=$saldocontador+($saldodesc);

                                $obcajac=new Cajasdesalida();
                                $obcajac->setcajacontador($nuevosaldocontador);
                                $obcajac->modificarcajacontador();
*/////////////////////////////////////////////////////////////////////////////////////////////

                                $objca=new Cajasdesalida();
                                $listaca=$objca->mostrarganacias();
                                $fic=mysqli_fetch_object($listaca);
                                $saldoganancia=$fic->gananciasprocesalyproc;
                                $nuevosaldoganacia=$saldoganancia+$gananciaprocuradoria;

                                $objcaja=new Cajasdesalida();
                                $objcaja->setid_cajasalida(1);

                                $objcaja->setgananciaspp($nuevosaldoganacia);
                                $objcaja->modificarganancias();
         
                
                              }///AQUI ACABA LA CONDICION QUE PREGUNTA SI LA ORDEN TIENE 1 Y 1 EN SUS DOSCALIFICACIONES (OSEA SUFICIENTE)

                                 else
                                   {//// SI LA ORDEN ES INSUFICIENTE
                                      $objcostofin=new Costofinal();
                                      $objcostofin->setcosto_procuradoria_compra(0);
                                      $objcostofin->setcosto_procuradoria_venta(0);
                                      $objcostofin->setcosto_prosesal_venta($compjudicial);

                                      $objcostofin->setCostoprocesalCompra($compjudicial);
                                      
                                      $objcostofin->settotal_egreso($compjudicial);
                                      $objcostofin->setid_orden($value);
                                      $objcostofin->setpenalidadcostofinal($penalidad);///SE ANOTA LA PENALIDAD PARA EL PROCURADOR
                                      $objcostofin->setmalgasto(0);/*LO QUE SE GASTO EN LA ORDEN (JUDICIAL), GASTO MAL HECHO, dato sin valor*/
                                      $objcostofin->setvalidadofinal('No');
                                      $objcostofin->setcanceladoprocurador('No');
                                      $objcostofin->setgananciaprocuradoria(0);
                                      $objcostofin->setgananciaprocesal(0);

                                      $objcostofin->guardarcostofinal();
                                  /////SE MODIFICA LA CAJA DE LA CAUSA //////////
                                      $objo=new OrdenGeneral();
                                      $lis=$objo->mostraridcausadeunaorden($value);
                                      $filc=mysqli_fetch_object($lis);
                                      $idcausa=$filc->id_causa;

                                      $obca=new Causa();
                                      $li=$obca->mostrarcajacausa($idcausa);
                                      $filca=mysqli_fetch_object($li);
                                      $saldocaja=$filca->caja;

                                      $nuevosaldo=$saldocaja-$compjudicial;

                                      $objcausa=new Causa();
                                      $objcausa->setid_causa($idcausa);
                                      $objcausa->setcajacausa($nuevosaldo);
                                      $objcausa->modificarcajadecausa(); 
                                    ///////SE CALIFICA LA ORDEN COMO INSUFICIENTE//
                                      $objor=new OrdenGeneral();
                                      $objor->setid_orden($value);
                                      $objor->setcalificacion('Insuficiente');
                                      $objor->setfechacierre($concat);
                                      $objor->ultinacalificacion();

                                      //////////////SE CONFIRMA LA DESCARGA POR EL CONTADOR///////////
                                      $objdes=new DescargaProcurador();
                                      $objdes->setid_orden($value);
                                      $objdes->setvalidado('Si');
                                      $objdes->validardescarga();
                          ///////////HASTA AQUI/////////////////////////////////// 
                           /*///////CODIGO PARA ACTUALIZAR LA CAJA DEL CONTADOR//////////////////////////
                                      $obdesc=new DescargaProcurador();
                                      $lst=$obdesc->mostrardescargaorden($_POST['idorden']);
                                      $fl=mysqli_fetch_object($lst);
                                      $saldodesc=$fl->saldo;

                                      $obcaj=new Cajasdesalida();
                                      $lss=$obcaj->mostrarcajadelcontador();
                                      $fll=mysqli_fetch_object($lss);
                                      $saldocontador=$fll->cajacontador;

                                      $nuevosaldocontador=$saldocontador+($saldodesc);

                                      $obcajac=new Cajasdesalida();
                                      $obcajac->setcajacontador($nuevosaldocontador);
                                      $obcajac->modificarcajacontador();*/

             

                                    }//HASTA AQUI SI LA ORDEN ES INSUFICIENTE
              
                             // $contadorproab++;
/*------COMO YA SE SERRO LA ORDEN, SE VERIFICARA EL SALDO DE LA CAUSA PARA ENVIAR EN CORREO AL ADMINISTRADOR*/
                          $senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
                          $senior = iconv('UTF-8', 'windows-1252', $senior);
                          $objcausa=new Causa();
                          $resulcausa=$objcausa->mostrarcodcausadeorden($value);
                          $filcausa=mysqli_fetch_object($resulcausa);
                          $codigocausa=$filcausa->codigo;
                          $idcausa1=$filcausa->idcausa;

                          /*MUESTRA LA CAJA(SALDO DE LA CAUSA)*/
                          $objcajacausa=new Causa();
                          $resulcajac=$objcajacausa->mostrarcajacausa($idcausa1);
                          $filcajac=mysqli_fetch_object($resulcajac);
                          $cajacausa=$filcajac->caja;
                          $destino="info@serrate.bo";
                          $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                        'Reply-To: info@serrate.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                          if ($cajacausa>=0 and $cajacausa<=200) 
                          {
                            $asunto="Alerta De Cobranza";
                            $mensajedecorreo="$senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo de $cajacausa Bs. Le recordamos que haga sus gestiones de cobranza";
                            //mail($destino,$asunto,$mensajedecorreo,$cabeceras);
                          }
                          if ($cajacausa<0) 
                          {
                            $asunto="Alerta De Cobranza (Urgente)";
                            $mensajedecorreo="URGENTE $senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo en contra de $cajacausa Bs. Se recomienda congelar el proceso inmediatamente y hacer sus gestiones de cobranza ";
                          //  mail($destino,$asunto,$mensajedecorreo,$cabeceras);
                          }
/*---------------------FIN DEL ENVIO DE CORREO-----------------------------------------------------------*/
                       }//AQUI ACABA EL ELSE PARA SERRAR LA ORDEN//////////////////

///HASTA AQUI SE HACE EL SIERRES DE LA ORDEN YA SEA SUFICIENTE OINSUFIECIENTE/////////
/*-------------------------------------MOSTRAMOS EL CODIGO DE CAUSA DE LA ORDEN PARA COMPLETAR EL MENSAJE------------*/
                /*sacamos el id del procurador de la orden*/
                   $objproc3=new Procurador();
                   $resulproc3=$objproc3->mostrarprocuradorpordefectodeOrden($value);
                   $filproc3=mysqli_fetch_object($resulproc3);
                   $idprocurador3=$filproc3->idproc;
                   /*MOSTRARA EL PRESUPUESTO DE LA ORDEN*/
                   $objpresu=new Presupuesto();
                   $resulpresu=$objpresu->mostrarpresupuesto($value);
                   $filpresu=mysqli_fetch_object($resulpresu);
                   $montopresuuesto=$filpresu->monto_presupuesto;

                   $objcausa=new Causa();
                   $resul=$objcausa->mostrarcodcausadeorden($value);
                   $fil=mysqli_fetch_object($resul);
                   $codcausa=$fil->codigo;

                   /*mostrara los gastos y saldo de la orden*/
                   $objdescargap=new DescargaProcurador();
                   $resuldes=$objdescargap->muestraDescargaDeorden($value);
                   $fildes=mysqli_fetch_object($resuldes);
                   $gastado=$fildes->gastos;
                   $saldodes=$fildes->saldo;
                   
                  //$_SESSION['mensajepago'].="# de orden:$value || Codigo de causa:$codcausa || Monto Entregado:$montopresuuesto Bs. || Monto Gastado:$gastado Bs. || Monto Por Devolver:$saldodes Bs. \n";
                  $tabladetalledevolver.="<tr>
                                            <td>$value</td>
                                            <td>$codcausa</td>
                                            <td>$montopresuuesto</td>
                                            <td>$gastado</td>
                                            <td>$saldodes</td>
                                          </tr>";
/*-------------------------------------------------------------------FIN DEL COMPLETADO DE MENSAJE----------------------*/

                }/*FIN DEL IF QUE VERIFICA QUE EL CONTADOR NO HAYA HECHO LA DEVOLUCION DE LA ORDEN*/      
               } //AQUI ACABA EL FOREACH
               $nuevosaldocontador=$saldocontador1+($acumuladosaldodevolver);

                $obcajac=new Cajasdesalida();
                $obcajac->setcajacontador($nuevosaldocontador);
                $obcajac->modificarcajacontador();
/*------------------------------CODIGO PARA ENVIAR EL CORREO AL PROCURADOR--------------------*/

              /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
                /*$objproc1=new Procurador();
                $resulproc=$objproc1->mostrarunProcurador1($idprocurador3);
                $filproc=mysqli_fetch_object($resulproc);
                $destino=$filproc->correoproc;
                $nombreproc3=$filproc->nombreproc.' '.$filproc->apellidoproc;*/
                /*EMPIEZA EL MENSAJE*/
                //$iniciomensaje = stripslashes('RECIBO DE DEVOLUCIÓN DE DINERO'); /*se pasa los datos para que se interprete*/
               /* $iniciomensaje = iconv('UTF-8', 'windows-1252', $iniciomensaje);*/

              //  $mensajedecorreo="$iniciomensaje  \n";
                /*$mensajedecorreo="Procurador: $nombreproc3 \n";
                $mensajedecorreo.=$_SESSION['mensajepago'];
                $mensajedecorreo.="Atte. El Sistema.";*/
               /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
                   /* $cabeceras = 'From: SERRATE <sistema@serrate.com.bo>' . "\r\n" .
                        'Reply-To: sistema@serrate.com.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();*/
                         /*PONEMOS EL ASUNTO DEL CORREO*/
                 //   $asunto="$iniciomensaje (Copia)";
                    
                    //mail($destino,$asunto,$mensajedecorreo,$cabeceras);
          /*------------envia el correo al contador-------------------------------*/
                  /* $objcont=new Contador();
                   $resulconta=$objcont->mostrarunContador($datos['id_contador']);
                   $filcont=mysqli_fetch_object($resulconta);
                   $destinocont=$filcont->correocont;
                   $asuntocont=$iniciomensaje;
                    mail($destinocont,$asuntocont,$mensajedecorreo,$cabeceras);*/

                    $idcontador=$datos['id_contador'];
                     echo "<input type='hidden' id='texttabla' name='texttabla' value='$tabladetalledevolver'>
                           <input type='hidden' id='textfecha' name='textfecha' value='$concat'>
                           <input type='hidden' id='textmontodevolver' name='textmontodevolver' value='$totaldev'>
                    <script > 
                       llamaArchivoEnviaCorreoDevolverCont($idprocurador3,$idcontador); 
                    </script>";
/*-------------------------FIN DEL CODIGO PARA ENVIAR EL CORREO AL PROCURADOR--------------------*/
              /*MENSAJE QUE MUESTRA QUE SE HIZO LA FUNCION*/
              echo "<script > setTimeout(function(){ location.href='contador_mis_causa.php'; }, 1000); swal('EXELENTE','Se Hizo La Devolucion Con Exito','success'); </script>";
                   //echo "Se serrara la orden: "; echo $contadorproab; echo "<br>";
                   //echo "Solo se registrara el pronunciamienro del contador: "; echo $contadorsinab;
                  
                     //echo "<script>alert('$arrayid, $totaldevolver');</script>";

                /*   $carritovector=$arrayid;
                   $ci=0;
                   while($ci< count($carritovector)){
                   echo $carritovector[$ci];
                   echo "<br>";
                   $ci++;
                   } */

                   
          }/*FIN DEL IF, QUE PREGUNTA SI TIENE SALDO PARA DEVOLVER*/
          ///SI NO TIENE SALDO SUFICIENTE LE MOSTRARA UN MENSAJE
          else
           {
          echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No Tiene Saldo Suficiente Para Devolver','warning'); </script>";
           }

    //////RESULTADO SI NO SELECCIONO NINGUNO
    }/*FINAL DEL IF QUE PREGUNTA SI SELECCIONO ALGUN CHECKBOX*/
    else
       {
         echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No Selecciono Casillas','warning'); </script>";
       }

       
     
       
    
}/*FINAL DE CODIGO , CUANDO OPRIME EL BOTON APLICAR, PARA DEVOLVER MUCHOS */

?>

<!--FUNCION AJAX QUE SE EJECUTAL AL HACER CLICK EN UN CHECKBOX-->
    <script type="text/javascript">
          $(function(){

          $('body').on('click', '#listaregistros input[type=checkbox]', function(event)
            {
                /// asignamos a la variavle saldoorden el valor del saldo de la orden
                var  saldoorden= $(this).attr('data-idRegistro');
                //PRESGUNTA SI EL CHECKBOX ESTA CHECKEADO, SUMARA EL VALOR DEL SALDO DE ESA ORDEN
                if ($(this).is(':checked')) 
                {
                
                  $.ajax({
                  url : 'sumador_devolver.php',
                  type : 'POST',
                  dataType : 'html',
                  data : { saldord:saldoorden },
                  }) 

                   .done(function(resultado){
                   $("#texttotaldev").val(resultado);
                   })    

                }
            //POR FALSO, SI NO ESTA CHECKEADO, RESTARA EL VALOR DEL SALDO DE ESA ORDEN
            else{

                 $.ajax({
                 url : 'restador_devolver.php',
                 type : 'POST',
                 dataType : 'html',
                 data : { saldord:saldoorden },
                 })

                 .done(function(resultado){
                 $("#texttotaldev").val(resultado);
                  })
                }
            
        
           });
         });
        
    </script>
