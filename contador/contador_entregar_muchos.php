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
<head>
	<title>Entregar muchos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<body>
<?php
include_once('../model/clsprocurador.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clscajasdesalida.php');
include_once('../model/clscontador.php');
include_once('../model/clscausa.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');
$_SESSION['sumatotalentrga']=0;
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
           <h3 style="color: #000000;font-size: 25px;">ENTREGAR MUCHOS </h3>
          </td>
        </tr>
      </table>  
    </div>
<!-- boton para el paso intermedio -->

   <section>
    
    <form method="post">
     <div class="orden">
       <select id="selectprocu" name="selectprocu" style="width: 30%;" onchange="this.form.submit()">           
            <option >SELECIONE UN PROCURADOR</option>
             <?php
             $objproc=new Procurador();
             $listp=$objproc->listarprocurador();
             while($proc=mysqli_fetch_array($listp)){
                echo '<option value="'.$proc['id_procurador'].'">'.$proc['apellidoproc'].', '.$proc['nombreproc'].'</option>';
              //antiguo   echo '<option value="'.$proc['id_procurador'].'">'.$proc['nombreproc'].' '.$proc['apellidoproc'].'--'.$proc['tipoproc'].'</option>';
               }
          ?>      
       </select>
    </div>

     <?php

    if (isset($_POST['selectprocu'])) {
       $idp=$_POST['selectprocu'];
        $objproc2=new Procurador();
        $listt=$objproc2->mostrarunprocuradro($idp);
        $procu=mysqli_fetch_array($listt);
       echo '<b>Procurador: </b>'; echo $procu['Nombre']; echo "<br>"; echo "<br>"; 
    }
    ?>
    
<table id="customers">
 <thead>    
  <tr>
    <th>CODIGO DE LA CAUSA</th>
    <th> NUMERO DE ORDEN </th>
    <th>MONTO PRESUPUESTADO</th>
    <th>SELECCIONAR O AGREGAR</th>
  </tr>
</thead>
<tbody id="listaregistros">


<?php
/*MUESTRA TODAS LAS ORDENES QUE ESTAN PARA ENTREGAR PRESUPUESTO A UN PROCURADOR*/
if (isset($_POST['selectprocu'])) {
   $idproc=$_POST['selectprocu'];

   $objorden=new OrdenGeneral();
   $listado=$objorden->consultaentregarmuchos($idproc);
   while ($fila=mysqli_fetch_object($listado))
   {
       echo "<tr>";
       echo "<td>$fila->codigocausa</td>";
       echo "<td>$fila->Codorden</td>";
       echo "<td>$fila->Montopresu</td>";
       echo "<td><input style='width: 23px; height: 23px;' type='checkbox' name='lista[]' id='lista[]' data-idRegistro='$fila->Montopresu' value='$fila->Codorden' ></td>";
       echo "</tr>";
   }

}
?>

<tr>
    <td colspan="2">MONTO TOTAL DE DINERO POR ENTREGAR</td>
    <td colspan="1" style="padding: 0px 0px;"><input style="font-size: 25px; font-weight: bold;padding: 0px 0px; border: 0px solid #000;" type="text" name="texttotalentregar" id="texttotalentregar" readonly="readonly" ></td>
</tr>
</tbody>
</table>
<br>
 <input type="submit" name="btnentregarmuchos" id="btnentregarmuchos" value="APLICAR">
</form>
</section>
    
   </div><br>

</body>
</html>
<script type="text/javascript">
   function llamaArchivoEnviaCorreo(idprocu,idcontador)
      {
        var formDataVenta = new FormData(); 
        var fechaentrega=$('#textfecha').val();
        var montoentregado=$('#textmontoentregado').val();
        var tabladetalle=$('#texttabla').val();
        var idprocu=idprocu;
        var idcontador=idcontador;
        

        formDataVenta.append('fechaentrega',fechaentrega);
     formDataVenta.append('montoentregado',montoentregado);
     formDataVenta.append('tabladetalle',tabladetalle);
     formDataVenta.append('idprocu',idprocu);
     formDataVenta.append('idcontador',idcontador);
      $.ajax({ url: '../controller/control-enviaCorreoEntregaCont.php', 
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
if (isset($_POST['btnentregarmuchos'])) 
{
    $recibio = stripslashes('recibi¨®'); /*se pasa los datos para que se interprete*/
    $recibio = iconv('UTF-8', 'windows-1252', $recibio);
    ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat=$fechoyal.' '.$horita;

    $contadorlista=$_POST['lista'];

    $nuevocont=count($_POST['lista']);
    /*PREGUUNTA SI EL ARRAY DE LOS CHECKBOX ES MAYOR A CERO , OSEA SI CHECQUEO AL MENOS 1*/
    if ($nuevocont>0)  
    {
        /*POR VERDADERO, PREGUNTARA SI HAY SALDO SUFICIENTE EN CAJA DEL CONTADOR PARA ENTREGAR*/
        $obcaj=new Cajasdesalida();
        $lss=$obcaj->mostrarcajadelcontador();
        $fll=mysqli_fetch_object($lss);
        $saldocontador=$fll->cajacontador;
          
        $montoentregar=$_POST['texttotalentregar'];
        $acumuladorDelPresuppuestoaENtregar=0;
        $contadordeentregados=0;
        /*PREGUNTA SI EL TOTAL A ENTREGAR ES MENOR O IGUAL A LA CAJA DEL CONTADOR*/
        if ($montoentregar<=$saldocontador) 
        {   /*POR VERDADERO */
/*--------------COMPLEMENTO DEL MENSAJE----------------------------------*/ 
             $idprocurador3=0;         
            // $_SESSION['mensajepago']="En Fecha $concat, usted $recibio el monto de $montoentregar bolivianos (carga de dinero) conforme al siguiente detalle:  \n"; 
             $tabladetalle="";
             /*FOREACH PARA RRECORER EL ARRAY DE LAS CASILLAS SELECCIONADAS*/
             foreach ($contadorlista as $key => $value) 
             {
                 /*VERIFICA QUE EL PRESUPUESTO NO ESTE ENTREGADO AUN PARA ENTREGAR*/
                 $objveripre=new Presupuesto();
                 $resulverifi=$objveripre->mostrarpresupuesto($value);
                 $filveri=mysqli_fetch_object($resulverifi);
                 if ($filveri->fecha_entrega=='') /*PREGUNTA SI LA FECHA DE ENTREGA ESTA VACIA, POR VERDADERO, HACE LA ENTEGA*/
                 {
                  $acumuladorDelPresuppuestoaENtregar=$acumuladorDelPresuppuestoaENtregar+$filveri->monto_presupuesto;
                  
                   /*CAMBIA EL ESTADO DE PRESUPUESTO*/
                  $objpresu=new Presupuesto(); 
                  $objpresu->setid_orden($value);
                  $objpresu->setfecha_entrega($concat);
                  $objpresu->setestadopresupuesto('Entregado');
                  $objpresu->entregardinero();
                  
                  /*CAMBIA EL ESTADO DE LA ORDEN*/
                  $objorden=new OrdenGeneral();
                  $objorden->setid_orden($value);
                  $objorden->setestadoorden('DineroEntregado');
                  $objorden->cambiarestadodeorden();

                  $contadordeentregados++;
/*------------------MOSTRAMOS EL CODIGO DE CAUSA DE LA ORDEN PARA COMPLETAR EL MENSAJE------------*/
                /*sacamos el id del procurador de la orden*/
                   $objproc3=new Procurador();
                   $resulproc3=$objproc3->mostrarprocuradorpordefectodeOrden($value);
                   $filproc3=mysqli_fetch_object($resulproc3);
                   $idprocurador3=$filproc3->idproc;

                   $objcausa=new Causa();
                   $resul=$objcausa->mostrarcodcausadeorden($value);
                   $fil=mysqli_fetch_object($resul);
                   $codcausa=$fil->codigo;
                   $montopresupuesto1=$filveri->monto_presupuesto;
                 // $_SESSION['mensajepago'].="Codigo de causa:$codcausa ||# de orden:$value || Monto Del Presupuesto:$montopresupuesto1 Bs.\n";
                  $tabladetalle.="<tr>
                                   <td>$codcausa</td>
                                   <td>$value</td>
                                   <td>$montopresupuesto1</td>
                                 </tr>";
/*--------------------------FIN DEL COMPLETADO DE MENSAJE----------------------*/
                }/*FIN DEL IF QUE PREGUNTA SI LA FECHA DE ENTREGA ESTA VACIA*/
               
             }/*FIN DEL FOREACH*/
             //$tabladetalle.="</tbody>
             //               </table>";
             /*ACABA EL FOREACH Y MUESTRA MENSAJE DE CONFIRMACION*/
               $nuevosaldo=$saldocontador-$acumuladorDelPresuppuestoaENtregar;
              /*MODIFICA LA CAJA DEL CONTADOR*/
              $objca=new Cajasdesalida();
              $objca->setid_cajasalida(1);
              $objca->setcajacontador($nuevosaldo);
              $objca->modificarsaldodecaja();
/*------------------------------CODIGO PARA ENVIAR EL CORREO AL PROCURADOR--------------------*/
              $idcontador=$datos['id_contador'];
              //enviarCorreoEntregarMuchos($concat,$montoentregar,$tabladetalle,$idprocurador3,$idcontador);

              echo "<input type='hidden' id='texttabla' name='texttabla' value='$tabladetalle'>
                    <input type='hidden' id='textfecha' name='textfecha' value='$concat'>
                    <input type='hidden' id='textmontoentregado' name='textmontoentregado' value='$montoentregar'>
                    <script > 
                       llamaArchivoEnviaCorreo($idprocurador3,$idcontador); 
                    </script>";

              /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
                /*$objproc1=new Procurador();
                $resulproc=$objproc1->mostrarunProcurador1($idprocurador3);
                $filproc=mysqli_fetch_object($resulproc);
                $destino=$filproc->correoproc;
                $nombreproc3=$filproc->nombreproc.' '.$filproc->apellidoproc;
                /*EMPIEZA EL MENSAJE*/
                //$mensajedecorreo="RECIBO DE ENTREGA DE DINERO \n";
             /*   $mensajedecorreo="Procurador:$nombreproc3 \n";
                $mensajedecorreo.=$_SESSION['mensajepago'];
                $mensajedecorreo.="Atte. El Sistema.";
               /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
                 /*   $cabeceras = 'From: SERRATE <sistema@serrate.com.bo>' . "\r\n" .
                        'Reply-To: sistema@serrate.com.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                         /*PONEMOS EL ASUNTO DEL CORREO*/
                 /*   $asunto="RECIBO DE ENTREGA DE DINERO";
                    
                    mail($destino,$asunto,$mensajedecorreo,$cabeceras);
          /*------------envia el correo al contador-------------------------------*/
                /*   $objcont=new Contador();
                   $resulconta=$objcont->mostrarunContador($datos['id_contador']);
                   $filcont=mysqli_fetch_object($resulconta);
                   $destinocont=$filcont->correocont;
                   $asuntocont="RECIBO DE ENTREGA DE DINERO (Copia)";
                    mail($destinocont,$asuntocont,$mensajedecorreo,$cabeceras);*/
/*-------------------------FIN DEL CODIGO PARA ENVIAR EL CORREO AL PROCURADOR--------------------*/

             echo "<script > setTimeout(function(){ location.href='contador_mis_causa.php'; }, 1000); swal('EXELENTE','Se hizo la entrega a  con Exito','success'); </script>";
            
        }/*FIN DEL IF QUE PREGUNTA SI TOTAL A ENTREGAR ES MENOR O IGUAL A CAJA DEL CONTADOR */
           /*POR FALSO MOSTRARA UN MENSAJE DICIENTO QUE NO TIENE SALDO SUFICIENTE*/
          else
          {
            echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No Tiene Saldo Suficiente','warning'); </script>";
          }/*FIN DEL ELSE QUE MUESTRA MENSAJE DICIENDO QUE NO TIENE SALDO SUFICIENTE*/

    }/*FIN DEL IF QUE PREGUNTA SI EL NUEVOCONT ES MAYOR A CERO*/
    /*POR FALSO, OSEA SI ES IGUAL A CERO, OSEA NO CHEQUEO NINGUNO, MUESTRA UN MENSAJE*/
    else
      {
         echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No Selecciono Casillas','warning'); </script>";
      }/*fin del else que muestra mensaje cuando no hay casillas seeccionadas*/
}
/*FUNCION DE ENVIO DE CORREO PARA EL PROCURADOR Y CONTADOR*/
/*function enviarCorreoEntregarMuchos($fechaentrega,$montoentregado,$tabladetalle,$idprocu,$idcontador)
{ /*Se obtiene los datos de la planilla con codigo 11*/
 /* $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(11);
  $filplanilla=mysqli_fetch_object($resulplanilla);
  $envia_notif           =$filplanilla->envia_notif;
  $emisor                =$filplanilla->emisor;
  $tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
  $receptor_estatico     =$filplanilla->receptor_estatico;
  $asunto                =$filplanilla->asunto;
  $texto                 =$filplanilla->texto;
  if ($envia_notif==1) //preguntamos si envia la notificacion
  { //preguntamos si existe un emisor con direccion de correo electronico valido 
      $arroba='@';
      if (strpos($emisor, $arroba)==true) 
      {
        $correoEmisor=$emisor;
      }
      else //por falso colocamos el correo del administrador
      {
                /*obtenemos el correo del user admin*/
     /*          $objuser=new Usuario();
               $resultuser=$objuser->MostrarUserAdmin();
               $filuser=mysqli_fetch_object($resultuser);
               $correoEmisor=$filuser->correousuario;
      }
      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
     /*       $cabeceras = "From: ITECH <".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {
       /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
     /*     $objproc1=new Procurador();
          $resulproc=$objproc1->mostrarunProcurador1($idprocu);
          $filproc=mysqli_fetch_object($resulproc);

          $destinoproc=$filproc->correoproc;
          $nombreProcurador=$filproc->nombreproc.' '.$filproc->apellidoproc;

          /*------------envia el correo al contador-------------------------------*/
     /*     $objcont=new Contador();
          $resulconta=$objcont->mostrarunContador($idcontador);
          $filcont=mysqli_fetch_object($resulconta);
          $destinocont=$filcont->correocont;
        
                   
           /*reemplazamos las variables en el asunto*/
    /*        $searchasunto = array('[numeroorden]');
            $replaceasunto = array($idorden);
            $asuntoproc=str_replace($searchasunto,$replaceasunto,$asunto);
            $asuntocont=$asuntoproc." (Copia)";
         
            //Reemplazamos las variables en el texto
          $search = array('[nombreapellidoprocurador]',
                          '[fechahora]',
                          '[montoentregado]',
                          '[tabladetalle]');
            $replace = array('<b>'.$nombreProcurador.'</b>',
                             '<b>'.$fechaentrega.'</b>',
                             '<b>'.$montoentregado.'</b>',
                             '<b>'.$tabladetalle.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
          

          //Correo para el procurador
         mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
         //Correo para el contador
         mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico;
           /*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
      /*    $objproc1=new Procurador();
          $resulproc=$objproc1->mostrarunProcurador1($idprocu);
          $filproc=mysqli_fetch_object($resulproc);
          $destinoproc=$filproc->correoproc;
          $nombreProcurador=$filproc->nombreproc.' '.$filproc->apellidoproc;

          /*------------envia el correo al contador-------------------------------*/
       /*   $objcont=new Contador();
          $resulconta=$objcont->mostrarunContador($idcontador);
          $filcont=mysqli_fetch_object($resulconta);
          $destinocont=$filcont->correocont;
      
           /*reemplazamos las variables en el asunto*/
      /*      $searchasunto = array('[numeroorden]');
            $replaceasunto = array($idorden);
            $asuntoproc=str_replace($searchasunto,$replaceasunto,$asunto);
            $asuntocont=$asuntoproc." (Copia)";
           //Reemplazamos las variables en el texto
          $search = array('[nombreapellidoprocurador]',
                          '[fechahora]',
                          '[montoentregado]',
                          '[tabladetalle]');
            $replace = array('<b>'.$nombreProcurador.'</b>',
                             '<b>'.$fechaentrega.'</b>',
                             '<b>'.$montoentregado.'</b>',
                             '<b>'.$tabladetalle.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
            //Correo para el destino  
          mail($receptor,$asuntoproc,$textomodificado,$cabeceras);
          //Correo para el contador
         mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         }
  }//fin cuando pregunta si envia notificacion

}/* fin de funcion enviarCOrreoEntregarMuchos*/
?>

<!--FUNCION AJAX QUE SE EJECUTAL AL HACER CLICK EN UN CHECKBOX-->
    <script type="text/javascript">
          $(function(){

          $('body').on('click', '#listaregistros input[type=checkbox]', function(event)
            {
                /// asignamos a la variavle montopresupuesto el valor del presupuesto de la orden
                var  montopresupuesto= $(this).attr('data-idRegistro');
                //PRESGUNTA SI EL CHECKBOX ESTA CHECKEADO, SUMARA EL VALOR DEL PRESUPUESTO DE ESA ORDEN
                if ($(this).is(':checked')) 
                {
                
                  $.ajax({
                  url : 'sumador_entregar.php',
                  type : 'POST',
                  dataType : 'html',
                  data : { montoentregar:montopresupuesto },
                  })

                   .done(function(resultado){
                   $("#texttotalentregar").val(resultado);
                   })    

                }
            //POR FALSO, SI NO ESTA CHECKEADO, RESTARA EL VALOR DEL SALDO DE ESA ORDEN
            else{

                 $.ajax({
                 url : 'restador_emtregar.php',
                 type : 'POST',
                 dataType : 'html',
                 data : { montoentregar:montopresupuesto },
                 })

                 .done(function(resultado){
                 $("#texttotalentregar").val(resultado);
                  })
                }
            
        
           });
         });
      /*funcion en javascript para enviar correo*/
     
    </script>      
