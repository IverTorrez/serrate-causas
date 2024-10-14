<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["abogado"];
$_SESSION['listado']='vacio';
?>
<!DOCTYPE html>
<html>
<head>
    <title>causasActivas</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/jquery.js"></script>

</head>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsabogado.php');
include_once('../model/clsprocurador.php'); 
include_once('../model/clscliente.php');
include_once('../model/clscategoria.php');
include_once('../model/clsautoorden.php');
include_once('../model/clstipolegal.php');
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
                
                <li  class="first_listleft" style="float: left; width: 600px;"><a >USUARIO:<?php echo $datos['nombreabog']; ?>  TIPO:Abogado</a></li>
                
                <li class="first_list" ><a href="miscausas.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </li>
                
                <li class="first_list" ><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                <?php
                $idabogadoactual=$datos['id_abogado'];
                  //////FUNCIONES PARA MOSTRAR EL TOTAL DE CADA ORDEN EN SUS PASOS DE SEGUIMUIENTO
                   $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradasDeAbogado($idabogadoactual);
                   $fil1=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadasDeCausaDeAbogado($idabogadoactual);
                   $fil2=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadasDeCausaAbogado($idabogadoactual);
                   $fil3=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregadoDeCausaAbogado($idabogadoactual);
                   $fil4=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizarDeCausaAbogado($idabogadoactual);
                   $fil5=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadasDeCausaDeAbogado($idabogadoactual);
                   $fil6=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenesDeCausaDeAbogadopronunciabogado($idabogadoactual);
                   $fil7=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenesDeCausaDeAbogadoPronuncioElContador($idabogadoactual);
                   $fil8=mysqli_fetch_object($resul8); 

                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLevesDeCausaDeAbogado($idabogadoactual);
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGravesDeCausaDeAbogado($idabogadoactual);
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resultprepre=$objorden1->mostrartotalordenesPre_presupuestadasDeCausaDeAbogado($idabogadoactual);
                   $filprepre=mysqli_fetch_object($resultprepre);

                  ?>
                
                <ul>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenesgiradas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil1->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenespresupuestadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

                     <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenesaceptadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: INF/DOC  &nbsp;&nbsp;ENTREGADOS &nbsp;</button></li>

                     <li><button class="botones" style="width: 140px; height: 55px; " onclick="location.href='causasordenesdineroentregado.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

                     <li><button class="botones" style="width: 140px; height: 55px;" onclick="location.href='causasordeneslistaspararealizar.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

                     <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasordenesdescargas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>

                     <li><button class="botones" onclick="location.href='causasordenespronunciadasabogado.php'" style="width: 160px; height: 55px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

                     <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenespronunciadascontador.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>

                  
                    
                </ul><br>
                 <ul>
                    
                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDAS LEVES</button></li>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDAS GRAVES</button></li>

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="window.open('impresiones/pdf/miscausas_imp.php')">IMPRIMIR</button></li>
                    <form method="post">
                    <li><button class="botones" style="width: 140px; height: 55px;" name="btnordercategoria">ORDENAR POR CATEGORIA</button></li>
                    <li><button class="botones" style="width: 140px; height: 55px;" name="btnorderpiso">ORDENAR POR PISOS</button></li>
                    </form>
                   
                    <li style="float: right;"><button style="height: 55px; background: white;margin-right: 4px; width: 145px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepre->TotalPrepresupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="../resources/imagenedesistema/Intermedio.png"></button></li> 
                    
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
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE CAUSAS ACTIVAS</h3>
    <br>
   <section class="responsive">
    
       <table id="customers">
 <thead> 
 <tr>
  <!--SELECTOR PARA ELEJIR tipo legal y materia de CAUSAS-->
  <form method="post">
   <td><select id="selectcausas" name="selectcodcausa" onchange="this.form.submit()">
          <option>FILTRAR POR CODIGO </option>       
          <?php
          $objtplegal=new TipoLegal();
          $listatplegal=$objtplegal->listarLosTiposLegalConSuMateria();
          while($tpl=mysqli_fetch_array($listatplegal)){
                
                 echo '<option value="'.$tpl['id_tipolegal'].'">'.$tpl['Codigo'].'</option>';
               }

          ?>
        </select></td>
  </form>

    <td></td>
     <!--SELECTOR PARA ELEJIR CAUSAS segun el PROCURADOR-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodprocurador" onchange="this.form.submit()"> 
           <option>FILTRAR POR PROCURADOR</option>
             <?php
              $obproc=new Procurador();
              $listaproc=$obproc->listarProcuradorActivos();
              while($proc=mysqli_fetch_array($listaproc)){
                 echo '<option value="'.$proc['id_procurador'].'">'.$proc['apellidoproc'].', '.$proc['nombreproc'].'</option>';
               //antiguo  echo '<option value="'.$proc['id_procurador'].'">'.$proc['NombreP'].'</option>';
               }

             ?>
        </select></td>
    </form>

     <!--SELECTOR PARA ELEJIR CAUSAS segun el CLIENTE-->
   <form method="post">
    <td><select id="selectcausas" name="selectcodcliente"  onchange="this.form.submit()"> 
               <option>FILTRAR POR CLIENTE</option>
               <?php
              $obcli=new Cliente();
              $listarcli=$obcli->listarClienteActivos();
              while($cli=mysqli_fetch_array($listarcli)){
                 echo '<option value="'.$cli['id_cliente'].'">'.$cli['apellidocli'].', '.$cli['nombrecli'].'</option>';
             //antiguo    echo '<option value="'.$cli['id_cliente'].'">'.$cli['NombreC'].'</option>';
               }

             ?>
        </select></td>
    </form>
   
    <!--SELECTOR PARA ELEJIR CAUSAS SEGUN LA CATEGORIA-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodcateg"  onchange="this.form.submit()"> 
               <option>FIL. POR CATEGORIA</option>
               <?php
              $obcat=new Categoria();
              $listarcat=$obcat->listarCategoriasActivas();
              while($cat=mysqli_fetch_array($listarcat)){
                
                 echo '<option value="'.$cat['id_categoria'].'">'.$cat['nombrecat'].'- '.$cat['abreviaturacat'].'</option>';
               }

             ?>
        </select></td>
    </form>

    
    <td></td>
 </tr>    
  <tr>
    <th width="150px">CODIGO</th>
    <th width="300px">NOMBRE DEL PROCESO</th>
    
    <th width="150px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="150px">CLIENTE</th>
    <th width="130px">CATEGORIA</th>
    <th width="350px">OBSERVACIONES</th> 
   
  </tr>
</thead>
<tbody id="tabla_resultadoActivos">
 <?php
 $idabogadoactual=$datos['id_abogado'];
 if (!isset($_POST['selectcodcausa']) and !isset($_POST['selectcodabogado']) and !isset($_POST['selectcodcliente']) and !isset($_POST['selectcodprocurador']) and !isset($_POST['selectcodcateg']) and !isset($_POST['btnordercategoria']) and !isset($_POST['btnorderpiso'])) 
 {
echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro de timestamp para evitar el caché
        var url = 'consultacausasactivasabogado.php?codab=$idabogadoactual&nocache=' + new Date().getTime();
        $('#tabla_resultadoActivos').load(url);
    });
</script>";
  
/*   $objcausa=new Causa();
   $resul=$objcausa->listarcausasDeAbogado($idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       echo "<tr>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>"; 

                 /*LISTAR ORDENES DE LA CAUSA*/
/*                 $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
/*                  if ($cont==0) 
                  {
                    echo "<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
/*                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
 /*                  $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
 /*                  if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
 /*                  $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/

 /*             echo "</td>";
              /*if que pregunta si esta causa es del abogado actual*/
 /*             if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
 /*                 {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

/*                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
/*                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
/*                echo "<td style='color:$colorletra; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
              
             // echo "<td>$fil->abogadogestor</td>";
              echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
             echo "<td>$fil->Categ</td>";
              echo "<td>$fil->Observ</td>";

            
        echo "</tr>";
    }/*FIN DEL LISTADO DE CAUSAS*/

  }/*FIN DEL IF QUE PREGUNTA SI NO SE SELECCIONO ALGUNO DE LOS SELECT*/


  /*PREGUNTA SI SE SELECCIONO ALGUN tipo legal de CAUSA*/
if (isset($_POST['selectcodcausa'])) 
{
    $_SESSION['id']=$_POST['selectcodcausa'];
  $_SESSION['listado']='codigo';
  
  $idtplegal=$_POST['selectcodcausa'];
  $objcausa=new Causa();
   $resul=$objcausa->listarCausaDeUnTipoLegalDeAbogado($idtplegal,$idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   { 
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style='color:$colorcausa; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc);
      //echo "<td>$fil->abogadogestor</td>";
     echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
     echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI SE SELECCIONO ALGUNA CAUSA*/


/*PREGUNTA SI SE SELECCIONO ALGUN ABOGADO*/
if (isset($_POST['selectcodabogado'])) 
{
  $idabog=$_POST['selectcodabogado'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeabogado($idabog);
   while ($fil=mysqli_fetch_object($resul)) {
      echo "<tr>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style='color:$colorletra; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
      //echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun abogado*/



/*PREGUNTA SI SE SELECCIONO ALGUN procurador*/
if (isset($_POST['selectcodprocurador'])) 
{
    $_SESSION['listado']='procurador';
  $_SESSION['id']=$_POST['selectcodprocurador'];
  
  $idproc=$_POST['selectcodprocurador'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeprocuradorDeAbogado($idproc,$idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style='color:$colorcausa; background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc);
     // echo "<td>$fil->abogadogestor</td>";
     echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun procurador*/


/*PREGUNTA SI SE SELECCIONO ALGUN cliente*/
if (isset($_POST['selectcodcliente'])) 
{
    $_SESSION['listado']='cliente';
  $_SESSION['id']=$_POST['selectcodcliente'];
  
  $idclie=$_POST['selectcodcliente'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeclienteDeAbogado($idclie,$idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style='background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc);
     // echo "<td>$fil->abogadogestor</td>";
      echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
      echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun cliente*/


/*PREGUNTA SI SE SELECCIONO ALGUN CATEGORIA*/
if (isset($_POST['selectcodcateg'])) 
{
    $_SESSION['listado']='categoria';
  $_SESSION['id']=$_POST['selectcodcateg'];
  
  $idcat=$_POST['selectcodcateg'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeCategoriaDeAbogado($idcat,$idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*12345678910;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc);
     // echo "<td>$fil->abogadogestor</td>";
       echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
      echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono alguna categoria*/


/* if que pregunta si se presiono ordenar por categoria*/
if (isset($_POST['btnordercategoria'])) 
 {
     $_SESSION['listado']='porcategoria';
  
   $objcausa=new Causa();
   $resul=$objcausa->listarcausasDeAbogadoOrdenadoPorCategoria($idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
       echo "<tr style='color: $colorcausa'>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->id_causa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>"; 

                 /*LISTAR ORDENES DE LA CAUSA*/
                 $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->id_causa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
                    echo "<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/

              echo "</td>";
              /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->id_causa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc);       
             // echo "<td>$fil->abogadogestor</td>";
             echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
             echo "<td>$fil->Categ</td>";
              echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
        echo "</tr>";
    }/*FIN DEL LISTADO DE CAUSAS*/

  }/*FIN DEL IF QUE PREGUNTA SI SE presiono boton ordenar por categoria */



/* if que pregunta si se presiono ordenar por piso*/
if (isset($_POST['btnorderpiso'])) 
 {
     $_SESSION['listado']='porpisos';
     
   $arrayorcausapisos=array();
   $objcausa=new Causa();
   $resul=$objcausa->listarCausasActivasPorPisoDeAbogado($idabogadoactual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      
       if (in_array($fil->idcausa,$arrayorcausapisos)) /*COMPRUEBA SI ESA ORDEN YA A MOSTRADO*/
          {
           
          }
          else
          {
         echo "<tr style='color: $colorcausa'>";
            //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
            $mascara=$fil->idcausa*12345678910;
             $encriptado=base64_encode($mascara);
              echo "<td class='tdcod'><a style='color: $colorcausa' href='fichacausa.php?squart=$encriptado' onclick=funcionirficha($fil->idcausa)>$fil->codigo</a><br>"; 
          
             array_push($arrayorcausapisos,$fil->idcausa); /*METEMOS LA ORDEN EN UN ARRAY*/
                 /*LISTAR ORDENES DE LA CAUSA*/
                 $cont=0;
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->idcausa);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
                  if ($cont==0) 
                  {
                    echo "<br>";
                  }

                  ini_set('date.timezone','America/La_Paz');
                  $fechoyal=date("Y-m-d");
                  $horita=date("H:i");
                  $concat=$fechoyal.' '.$horita;

                  $vard='';

                  $objordenn=new OrdenGeneral();
                  $resultado=$objordenn->mostrarCondicionyPrioridadOrden($filord->codorden);
                  $filorden=mysqli_fetch_object($resultado);
                  $prioriorden=$filorden->Prioridadorden;

                  /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
                  $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
                   if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";
                   }

                   else{

                             $intervalo= $fecha1->diff($fecha2);

                             //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                             $diasentero=intval($intervalo->format('%d'));
                             $horaentero=intval($intervalo->format('%H'));
                             $minutos=intval($intervalo->format('%i'));


                               /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                             $totaldeminh=$horaentero*60;
                             $totalminDia=$diasentero*1440;

                             //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                             $resultadomin=$totaldeminh+$totalminDia+$minutos;
             
                              ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                             $resultadohora=$resultadomin/60;

                             if ($resultadohora>=96) {
                               $varcaraorden='G'.$prioriorden;
                             }
                             if ($resultadohora>=24 and $resultadohora<96) {
                               $varcaraorden='C'.$prioriorden;
                             }
                             if ($resultadohora>=8 and $resultadohora<24) {
                               $varcaraorden='V'.$prioriorden;
                             }

                             if ($resultadohora>=3 and $resultadohora<8) {
                               $varcaraorden='A'.$prioriorden;
                             }
                             if ($resultadohora>=1 and $resultadohora<3) {
                               $varcaraorden='N'.$prioriorden;
                             }
                             if ($resultadohora<1) {
                               $varcaraorden='R'.$prioriorden;
                             }

                 }/*FIN DEL ELSE*/




                 
                   $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 $cont++;

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/

              echo "</td>";
              /*if que pregunta si esta causa es del abogado actual*/
              if ($datos['id_abogado']==$fil->idabog) 
              {
                $obauto=new AutoOrden();
                $resulauto=$obauto->listarAutoOrdenesDeCausa($fil->idcausa);
                $colorfondo='none';
                $colorletra='black';
                $contador=0;
                  while ($filauto=mysqli_fetch_object($resulauto))/*while que recorre todas las las autoordenes*/
                  {
                     $colorfondo=$filauto->color;
                     $colorletra='white';
                     $contador++;

                  }/*fin del while que recorre todas las autoordenes*/

                    if ($contador>0) /*if que pregunta si aumento el contador (si encontro registros de utoordens)*/
                    {
                      
                    }/*fin del if que pregunta si $contador>0 (si hay auto ordenes)*/
                echo "<td style=' background:$colorfondo;'>$fil->nombrecausa</td>";
              }
              else
              {
                echo "<td>$fil->nombrecausa</td>";
              }
// PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
//para el procurador 
      $mascaraProc=$fil->idprocurador*1234567;
      $encriptadoidProc=base64_encode($mascaraProc);

      $mascarauserProc=4*1234567;
      $encriptadouserProc=base64_encode($mascarauserProc); 
             // echo "<td>$fil->abogadogestor</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidProc&type=$encriptadouserProc' target='_blank'>$fil->procuradorasig</a></td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
             echo "<td>$fil->Categ</td>";
              echo "<td style='text-align: justify;'>$fil->Observ</td>";

            
        echo "</tr>";
      }/*din del else*/
    }/*FIN DEL LISTADO DE CAUSAS*/

  }/*FIN DEL IF QUE PREGUNTA SI SE presiono boton ordenar por piso */


  ?> 
 
</tbody>
</table>
</section>
    </div>
<script type="text/javascript">
      /*  function  fyuncionirficha()
        {
            location.href='index.php';
        }*/
    </script>


 <script type="text/javascript">
  
 /* $(funcionirficha());

  function funcionirficha(idped)
 {
  $.ajax({
    url : 'ficha.php',
    type : 'POST',
    dataType : 'html',
    data : { idped: idped },
    })
  //location.href='ficha.php';
  //.done(function(resultadoproduct){
  //  $("#tabladetallepedido").html(resultadoproduct);
 // })
 // $('#textidped').val(idped);
  location.href='ficha.php';
}

</script>
    <br>
    <br>
    <br>

<script type="text/javascript" src="../resources/jquery.js"></script>
</body>
</html>
