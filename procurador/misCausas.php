<?php
error_reporting(E_ERROR);
session_start();
/*PROCURADOR*/
if(!isset($_SESSION["procurador"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["procurador"]; 

header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>
  <link rel="manifest" href="manifest.json">
    <title>Mis Causas</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
    
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/jquery.js"></script>
</head>
<body >
<?php
include_once('../model/clsmateria.php');
include_once('../model/clstipolegal.php');
include_once('../model/clscliente.php'); 
include_once('../model/clscategoria.php');
include_once('../model/clsabogado.php');
include_once('../model/clsprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
 
 
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
                <li  class="first_listleft" style="float: left; width: 540px;"><a >USUARIO:<?php echo $datos['nombreproc']; ?>  TIPO:Procurador</a></li>
                
                <li class="first_list"><a href="pagos.php" class="main_menu_first">PAGOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="first_list"><a href="misCausas.php"  class="main_menu_first main_current">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="first_list"><a href="../cerrarSesion.php" class="main_menu_first">SALIR</a></li>
            </ul>
        
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">    
            <div id="portfolio_menu">
               <?php
                 $idprocuradoractual=$datos['id_procurador'];
                  //////FUNCIONES PARA MOSTRAR EL TOTAL DE CADA ORDEN EN SUS PASOS DE SEGUIMUIENTO
                   $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradasDeProcurador($idprocuradoractual);
                   $fil1=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadasDeProcurador($idprocuradoractual);
                   $fil2=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadasDeProcurador($idprocuradoractual);
                   $fil3=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregadoDeProcurador($idprocuradoractual);
                   $fil4=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizarDeProcurador($idprocuradoractual);
                   $fil5=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadasDeUnProcurador($idprocuradoractual);
                   $fil6=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenesDeUnProcuradorpronunciabogado($idprocuradoractual);
                   $fil7=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenesDeUnProcuradorPronunciocontador($idprocuradoractual);
                   $fil8=mysqli_fetch_object($resul8);

                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesDeUnProcuradorVencidasLeves($idprocuradoractual);
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGravesDeUnProcurador($idprocuradoractual);
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resultorpre_presu=$objorden1->mostrartotalordenesPre_presupuestadasDeProcurador($idprocuradoractual);
                   $filprepresu=mysqli_fetch_object($resultorpre_presu);


                  ?>
                
                 <ul>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordengiradas.php'" ><span id="contadores">&nbsp;&nbsp;<?php echo $fil1->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px;" onclick="location.href='causasordenespresupuestadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenesaceptadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: INF/DOC  &nbsp;&nbsp;ENTREGADOS &nbsp;</button></li>

                    <li><button class="botones" style="width: 140px; height: 55px; " onclick="location.href='causasordenesdineroentregado.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

                     <li><button class="botones" style="width: 140px; height: 55px;" onclick="location.href='causasordeneslistaspararealizar.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

                    <li><button class="botones" style="width: 150px; height: 55px; " onclick="location.href='causasordenesdescargadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>

                    <li><button class="botones" onclick="location.href='causasordenespronunciadasabogado.php'" style="width: 163px; height: 55px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

                    <li><button class="botones" style="width: 145px; height: 55px;" onclick="location.href='causasordenespronunciadascontador.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>

                   
                       
                </ul><br>

                <ul>
                   
                  <li><form method="post"> <button name="btnlistarporurgencias" style="height: 55px; width: 383px;" class="botones">ENLISTAR CONFORME AL VALOR DE LAS URGENCIAS</button></form></li>
                  <li><form method="post"> <button name="btnlistarporpisos" style="height: 55px; width: 385px; " class="botones" >ENLISTAR DECRECIENTEMENTE CONFORME A LOS PISO</button></form></li>

                    <li><button style="height: 55px; " class="botones" onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDAS LEVES</button></li>

                    <li><button style="height: 55px; " class="botones" onclick="location.href='caususvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDAS GRAVES</button></li>

                    <li><button style="height: 55px; " class="botones" onclick="window.open('impresiones/pdf/ejecutar_operacionesDOMP.php')">EJECUTAR GESTIONES</button></li>
                </ul>
               
                <br>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
            
   
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

   <!--TABLA MIS CAUSAS PROCURADOR-->
    <div class="container">
    <?php
    if (isset($_POST['btnlistarporurgencias'])) {
      $titulotabla="LISTADO DE ORDENES CONFORME A LAS URGENCIAS";
    }
    else{ 
         if (isset($_POST['btnlistarporpisos'])) {
          $titulotabla="LISTADO DE ORDENES DECRECIENTEMENTE CONFORME A LOS PISOS";
        }
        else{
          $titulotabla="LISTADO DE CAUSAS";
        }

    }
   
     
//   echo " <h3 style='color: #000000;font-size: 25px;text-align: center;'>$titulotabla</h3>";
    ?>
<!-- BOTON NUEVO AGREGADO PARA EL PASO INTERMEDIO      -->
    <div >
      <table width="100%">
        <tr>

          <td width="35%"> 
            <button style="height: 55px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepresu->Totalpre_presupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="../resources/imagenedesistema/Intermedio.png"></button>
          </td>

          <td width="65%">
            <h3 style='color: #000000;font-size: 25px;'><?php echo $titulotabla; ?></h3>
          </td>
        </tr>
      </table>  
    </div>
    
    
   
    <br>
   
    <br>
       <table id="customers">
 <thead> 
 <tr>
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
   <!--SELECTOR PARA ELEJIR CAUSAS segun el abogado-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodabogado"  onchange="this.form.submit()"> 
               <option>FILTRAR POR ABOGADO</option>
               <?php
              $obabog=new Abogado();
              $listaabog=$obabog->listarAbogadosActivos();
              while($abog=mysqli_fetch_array($listaabog)){
                echo '<option value="'.$abog['id_abogado'].'">'.$abog['apellidoabog'].', '.$abog['nombreabog'].'</option>';
              //antiguo   echo '<option value="'.$abog['id_abogado'].'">'.$abog['Nombre'].'</option>';
               }

          ?>
        </select></td>
    </form>

    <!--SELECTOR PARA ELEJIR CAUSAS segun el CLIENTE-->
   <form method="post">
    <td><select id="selectcausas" name="selectcodcliente"  onchange="this.form.submit()"> 
               <option>FIL. POR CLIENTE</option>
               <?php
              $obcli=new Cliente();
              $listarcli=$obcli->listarClienteActivos();
              while($cli=mysqli_fetch_array($listarcli)){
                 echo '<option value="'.$cli['id_cliente'].'">'.$cli['apellidocli'].', '.$cli['nombrecli'].'</option>';
              //antiguo   echo '<option value="'.$cli['id_cliente'].'">'.$cli['NombreC'].'</option>';
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
    <th width="160px">CODIGO</th>
    <th width="280px">NOMBRE DEL PROCESO</th>
    <th width="150px">ABOGADO</th>
   
    <th width="150px">CLIENTE</th>

    <th width="90px">CATEGORIA</th>
    <th width="400px">OBSERVACIONES</th>
  </tr>
</thead>
<tbody id="tabla_resultadoActivos">
 <?php
 $idprocuradoractual=$datos['id_procurador'];
 if (!isset($_POST['btnlistarporurgencias']) and !(isset($_POST['btnlistarporpisos'])) and !isset($_POST['selectcodcausa']) and !isset($_POST['selectcodabogado']) and !isset($_POST['selectcodcliente']) and !isset($_POST['selectcodcateg']) ) 
 {
echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro de timestamp para evitar el caché
        var url = 'consultacausasactivasprocurador.php?codproc=$idprocuradoractual&nocache=' + new Date().getTime();
        $('#tabla_resultadoActivos').load(url);
    });
</script>";

/*   $objcausa=new Causa();
   $resul=$objcausa->listarcausasActivasDeUnProcurador($idprocuradoractual);
   while ($fil=mysqli_fetch_object($resul)) /*LISTADO DE CAUSAS ACTIVAS*/
/*   {
       echo "<tr height: 300px;>";
          //ENCRIPTACION DE CODIGO DE LA CAUSA PARA ENVIARLA POR LA URL
             $mascarac=$fil->id_causa*1213141516;
             $encriptado1=base64_encode($mascarac);
              echo "<td class='tdcod'><a href='ficha.php?squart=$encriptado1' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>";

            
                $cont=0;
               /*LISTAR ORDENES DE LA CAUSA*/
/*               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
               while ($filord=mysqli_fetch_object($listadoor)) 
               {  
                   if ($cont==0) 
                  {
                    echo "<br>";
                  }
                  /*FECHA Y HORA ACTUAL DE BOLIVIA*/
/*                  ini_set('date.timezone','America/La_Paz');
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
/*                   $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
/*                   if ($fecha1>$fecha2) {
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




                 
/*                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 
               $cont++;
                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
             


/*              echo " </td>";
              echo "<td>$fil->nombrecausa</td>";
              echo "<td>$fil->abogadogestor</td>";
             // echo "<td>$fil->procuradorasig</td>";
              echo "<td>$fil->clienteasig</td>";
               echo "<td>$fil->Categ</td>";
              echo "<td>$fil->Observ</td>";
        echo "</tr>";
  }/*FIN DEL LISTADO DE CAUAS ACTIVAS*/

}/*FIN DEL IF QUE PREGUNTA SI EL BOTON LISTAR NO ESTA PRESIONADO*/

  /*BOTON DEL LISTAR CONFORME LAS URGENCIAS*/
  /*if (isset($_POST['btnlistarporurgenciasAAss'])) 
  { ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat1=$fechoyal.' '.$horita;


    $contadororden=0;

    $arrayorden=array();/*CREACION DE ARRAY PARA CARGAR LAS ORDENES*/
    /*$arrayordenvenciadas=array();

    $urgenciatiempo=0;
    $sumatotalurgencia=0;

    $urgenciamenor=100;

    $idprocurador=1;
    $objordeness=new OrdenGeneral();
    $resull=$objordeness->listarordenesSinSerrardeProcurador($idprocurador);

        while($filordenes=mysqli_fetch_object($resull))
        {
          /*PREGUNTA LA URGENCIA DE LA ORDEN RESPECTO A LAS HORAS QUE LE QUEDAN*/
    /*      $prioridadorden1=$filordenes->prioridadorden;
          $fechafinordenes=$filordenes->Fechafin;
          $newfechfinal=date_create($fechafinordenes);
          $fechafinalformato=date_format($newfechfinal, 'Y-m-d H:i');

          $fechas1 =new DateTime($concat1);/*fechas de la zona horaria*/
    /*      $fechas2 =new DateTime($fechafinalformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
          /*PREGUNTA SI LA ORDEN ESTA VENCIDA ,SI ESTA VENCIDA SE LA ORDEN SE GUARDA EN UN ARRAY PARA ORDENES VENCIDAS*/
     /*       if ($fechas1>$fechas2) 
            {
                $varcondicion='R';
                $varconcat1=$varcondicion.$prioridadorden1;

               $varcaraorden1="<strike>$varconcat1</strike>";
               /*GUARDA EN EL ARRAY*/
     /*          array_push($arrayordenvenciadas, $filordenes->codorden);

            }
            else
            {
                $intervalo1= $fechas1->diff($fechas2);

                //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                $diasentero1=intval($intervalo1->format('%d'));
                $horaentero1=intval($intervalo1->format('%H'));
                $minutos1=intval($intervalo1->format('%i'));


                /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                $totaldeminh1=$horaentero1*60;
                $totalminDia1=$diasentero1*1440;

                //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                $resultadomin1=$totaldeminh1+$totalminDia1+$minutos1;
               
                 ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                $resultadohora1=$resultadomin1/60;

                if ($resultadohora1>=96) {
                  $varcaraorden='Gris'.$prioridadorden1;
                           $urgenciatiempo=6;
                }
                if ($resultadohora1>=24 and $resultadohora1<96) {
                  $varcaraorden='Celeste'.$prioridadorden1;
                           $urgenciatiempo=5;
                }
                if ($resultadohora1>=8 and $resultadohora1<24) {
                  $varcaraorden='Verde'.$prioridadorden1;
                           $urgenciatiempo=4;
                }

                if ($resultadohora1>=3 and $resultadohora1<8) {
                  $varcaraorden='Amarillo'.$prioridadorden1;
                           $urgenciatiempo=3;
                }
                if ($resultadohora1>=1 and $resultadohora1<3) {
                  $varcaraorden='Naranja'.$prioridadorden1;
                           $urgenciatiempo=2;
                }
                if ($resultadohora1<1) {
                   $varcaraorden='Rojo'.$prioridadorden1;
                           $urgenciatiempo=1;
                }

                $sumatotalurgencia=$urgenciatiempo+$prioridadorden1;

                    if ($sumatotalurgencia<$urgenciamenor) 
                    {  
                      $urgenciamenor=$sumatotalurgencia;
                      array_push($arrayorden, $filordenes->codorden);
                     
                    }


            }/*FIN DEL ELSE*/

         //  array_push($arrayorden, $filordenes->codorden);

/*        }/*FIN DEL WHILE QUE RRECORRE TODAS LAS ORDENES DEL PROCURADOR*/
/*    $contadororden=count($arrayorden);
    $contadorsito=0;
    while ($contadorsito<$contadororden) {
      echo $arrayorden[$contadorsito]; echo "<br>";
      $contadorsito++;
    }


    
    
  }*/

  /*NUEVO PROCEDIMIENTO DEL BOTON LISTAR POR URGENCIAS DE LAS ORDENES*/
  if (isset($_POST['btnlistarporurgencias'])) 
  {

    $idprocurador=$datos['id_procurador'];
echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro de timestamp para evitar el caché
        var url = 'consultaordenesporurgenciasprocurador.php?codproc=$idprocurador&nocache=' + new Date().getTime();
        $('#tabla_resultadoActivos').load(url);
    });
</script>";


 /*   ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat2=$fechoyal.' '.$horita;

    ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat=$fechoyal.' '.$horita;

    $nuevoarrayordenes1=array();
    $arrayordenvenciadasnuevas=array();
    $arrayordenesParahaceractivas=array();
    $contadoraarayorden=0;
    $valormenor=100;

    $ordenurgente=0;

    $varcaraorden="";
    $sumatotalurgencia=0;
    $urgenciatiempo=0;
    $urgenciamayor=0;
    $posicionurgente=0;

    $objordeness=new OrdenGeneral();
    $resull=$objordeness->listarordenesSinSerrardeProcurador($idprocurador);

      while($filordenes=mysqli_fetch_object($resull))
      {
          array_push($nuevoarrayordenes1, $filordenes->codorden);
      }
      //$contadoraarayorden=count($nuevoarrayordenes);
        $CONTADOR1=0;
        $CONTADORARRAYY=count($nuevoarrayordenes1);
        while ($CONTADOR1<$CONTADORARRAYY) /*while 2*/
 /*         { $nuevoarrayordenes=array();
            $nuevoarrayordenes=$nuevoarrayordenes1;
             
                  $contador=0;
                  $urgenciamayor=500;/*recien agregado, ES EL PARAMETRO PARA COMPARAR LA URGENCIA DE UNA ORDEN*/
/*                  while ($contador<count($nuevoarrayordenes)) /*while 3*/
/*                  { $idOrden=0;
                    $idOrden=$nuevoarrayordenes[$contador];
                    /**/
/*                    $obbjorden=new OrdenGeneral();
                    $listoo=$obbjorden->mostrarFechafinyPrioridadOrden($idOrden);
                    $filaordenes=mysqli_fetch_object($listoo);

                    $prioridadorden1=$filaordenes->PrioridadOrden;
                    $fechafinordenes=$filaordenes->Fechafin;
                    $newfechfinal=date_create($fechafinordenes);
                    $fechafinalformato=date_format($newfechfinal, 'Y-m-d H:i');

                    $fechas1 =new DateTime($concat2);/*fechas de la zona horaria*/
/*                    $fechas2 =new DateTime($fechafinalformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

/*                    if ($fechas2>$fechas1) 
                      {   

                          $intervalo1= $fechas1->diff($fechas2);

                        //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
                        $diasentero1=intval($intervalo1->format('%d'));
                        $horaentero1=intval($intervalo1->format('%H'));
                        $minutos1=intval($intervalo1->format('%i'));


                        /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
                        $totaldeminh1=$horaentero1*60;
                        $totalminDia1=$diasentero1*1440;

                        //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
                        $resultadomin1=$totaldeminh1+$totalminDia1+$minutos1;
                       
                         ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
                        $resultadohora1=$resultadomin1/60;

                        if ($resultadohora1>=96) {
                          $varcaraorden='G'.$prioridadorden1;
                                   $urgenciatiempo=16;
                        }
                        if ($resultadohora1>=24 and $resultadohora1<96) {
                          $varcaraorden='C'.$prioridadorden1;
                                   $urgenciatiempo=13;
                        }
                        if ($resultadohora1>=8 and $resultadohora1<24) {
                          $varcaraorden='V'.$prioridadorden1;
                                   $urgenciatiempo=10;
                        }

                        if ($resultadohora1>=3 and $resultadohora1<8) {
                          $varcaraorden='A'.$prioridadorden1;
                                   $urgenciatiempo=7;
                        }
                        if ($resultadohora1>=1 and $resultadohora1<3) {
                          $varcaraorden='N'.$prioridadorden1;
                                   $urgenciatiempo=4;
                        }
                        if ($resultadohora1<1) {
                           $varcaraorden='R'.$prioridadorden1;
                                   $urgenciatiempo=1;
                        }

                        $sumatotalurgencia=$urgenciatiempo+$prioridadorden1;
                        
                        $auxurgencia=$sumatotalurgencia;
                        $auxorden=$idOrden;
                        $auxposision=$contador;

                              

                         
                      }/*FIN DEL IF   QUE PREGUNTA SI LA FECHA FINAL DE LA ORDEN ES MAYOR A LA DE ZONA HORARIA*/
  /*                    else  /*SI, LA ORDEN ESTA VENCIDA*/
  /*                    {
                         $varcondicion='R';
                         $varconcat1=$varcondicion.$prioridadorden1;

                         $varcaraorden1="<strike>$varconcat1</strike>";
                         /*GUARDA EN EL ARRAY*/

  /*                        $ordenurgente=$idOrden;
                          $posicionurgente=$contador;
                          //$contador=count($nuevoarrayordenes);
                         // array_push($arrayordenvenciadasnuevas, $idOrdenvencida);

                          $auxurgencia=19+$prioridadorden1;
                          $auxorden=$ordenurgente;
                          $auxposision=$contador;
                          

                      }/*FIN DEL ELSE*/

  /*                    if ($auxurgencia<$urgenciamayor) 
                              {  
                                $urgenciamayor=$auxurgencia;
                                $oficialorden=$auxorden;
                                $oficiposicionurgente=$auxposision;      
                              }
                 


                      $contador++;
                    
                  }/*FIN DEL WHILE 3 QUE RRECORRE EL ARRAY DE ORDENES*/
              
  /*            array_push($arrayordenesParahaceractivas, $oficialorden);

              unset($nuevoarrayordenes1[$oficiposicionurgente]);/*ELIMINA UNA POSICION DEL VECTOR*/

   /*           $nuevoarrayordenes1 = array_values($nuevoarrayordenes1);/*le da un nuevo formato*/
   /*           $CONTADOR1++;                     
             
          }/*FIN DEL WHILE 2*/
          
          
          /*  $contadororden=count($arrayordenesParahaceractivas);
            $contadorsito=0;
            while ($contadorsito<$contadororden) 
            {
              echo $arrayordenesParahaceractivas[$contadorsito]; echo "<br>";
              $contadorsito++;
            }*/

/*EMPIEZA A LISTAR LAS CAUSAS CON SU RESPECTIVA ORDEN ,UNA FILA POR ORDEN,  (LISTADO DE ORDENES CONFORME A LAS URGENCIAS///////) */
 /*           $arrayparaenlistarcausa=array();
 /*           $arrayparaenlistarcausa=$arrayordenesParahaceractivas;
            $cantidadordenes=count($arrayparaenlistarcausa);
            $contadorOrdenes=0;
          while ($contadorOrdenes<$cantidadordenes) /*while que muestra la causa con una orden*/
/*          {
            $idordenarray=$arrayparaenlistarcausa[$contadorOrdenes];

            $objetoorden=new OrdenGeneral();
            $listarcausaordenes=$objetoorden->mostrarInformaciondeCausaDeUnaOrden($idordenarray);
            $filacausas=mysqli_fetch_object($listarcausaordenes);
            /*ENCRIPTACION DEL ID DE CAUSA*/
  /*             $mascarac=$filacausas->idcausa*1213141516;
               $encriptado1=base64_encode($mascarac);
            echo "<tr>";
            echo "<td><a href='ficha.php?squart=$encriptado1' target='_blank'>$filacausas->codigocausa</a> <br> <br>" ;

              /*FUNCION QUE MUESTRA LA FECHA FINAL Y HORA FINA DE UNA ORDEN*/
  /*                $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($idordenarray);
                   $filordd=mysqli_fetch_object($resultadoorden);
                   
                   $prioriorden=$filordd->prioriOrden;
                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
   /*                $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
   /*                if ($fecha1>$fecha2) {
                        $vard='R';
                        $varconcat=$vard.$prioriorden;

                        $varcaraorden="<strike>$varconcat</strike>";

                        $totaltiempoexpirar='';
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

                             $minutosparaexpirar=$resultadomin;
                             
                             $horaconvert=0;
                             $minutoscovert=0;
                             $totaltiempoexpirar=0;
                             
                             $horaconvert=$minutosparaexpirar/60;
                             $horaconvert11=intval($horaconvert);
                             $minutoscovert=$minutosparaexpirar%60;
                             $totaltiempoexpirar=$horaconvert11.':'.$minutoscovert;

                 }/*FIN DEL ELSE*/
                  
                 



                 
   /*                $mascara=$idordenarray*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a href='orden.php?squart=$encriptada' target='_blank'>$varcaraorden&nbsp;$totaltiempoexpirar&nbsp;($idordenarray)</td></a>";

            
            echo "<td>$filacausas->nombrecausa</td>";
            echo "<td>$filacausas->abogadogestor</td>";
           // echo "<td>$filacausas->procuradorasig</td>";
            echo "<td>$filacausas->clienteasig</td>";
            echo "<td>$filacausas->Categ</td>";
            echo "<td>$filacausas->Observ</td>";
            echo "</tr>";
            $contadorOrdenes++;
          }/*FIN DEL WHILE QUE MUESRA UNA CAUSA CON UNA ORDEN*/

            


}/*FIN DEL BOTON LISTAR POR URGENCIAS DE ORDEN*/


/*FUNCION PARA MOSTRAR LA CONDICION DE UNA ORDEN*/
function mostrarcondiciondeorden($idordennn)
{
  ini_set('date.timezone','America/La_Paz');
    $fechoyal=date("Y-m-d");
    $horita=date("H:i");
    $concat=$fechoyal.' '.$horita;

      $objneworden=new OrdenGeneral();
      $resultadoorden=$objneworden->mostrarfechayhorafin($idordennn);
      $filordd=mysqli_fetch_object($resultadoorden);
                           
      $prioriorden=$filordd->prioriOrden;
      $fechafinorden=$filordd->Fechafin;
      $newfechfin=date_create($fechafinorden);
      $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

      $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
      $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                           /*COMPARACION DE FECHAS */
          if ($fecha1>$fecha2) 
          {
            $vard='R';
            $varconcat=$vard.$prioriorden;

            $varcaraorden="<strike>$varconcat</strike>";

            $totaltiempoexpirar=0;
          }

              else
              {

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

                  $minutosparaexpirar=$resultadomin;
                                               
                  $horaconvert=0;
                  $minutoscovert=0;
                  $totaltiempoexpirar=0;
                                               
                  $horaconvert=$minutosparaexpirar/60;
                  $horaconvert11=intval($horaconvert);
                  $minutoscovert=$minutosparaexpirar%60;
                  $totaltiempoexpirar=$horaconvert11.':'.$minutoscovert;

              }/*FIN DEL ELSE*/
  return $varcaraorden;
}/*fin de la funcion que muestra la condicion de una orden*/


  /*FUNCION DEL BOTON LISTAR POR PISOS*/
  if (isset($_POST['btnlistarporpisos'])) 
  {

    $idprocurador1=$datos['id_procurador'];
    echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro de timestamp para evitar el caché
        var url = 'consultaordenesporpisosprocurador.php?codproc=$idprocurador1&nocache=' + new Date().getTime();
        $('#tabla_resultadoActivos').load(url);
    });
</script>";

 /*   $arrayordensporpisos=array();
    $objetorden1=new OrdenGeneral();
    $listaordenpiso=$objetorden1->listarOrdenesProcuradorPorpisosDecreciente($idprocurador1);
    while ($filaordenpiso=mysqli_fetch_object($listaordenpiso)) 
    {
      $pisojuzgado=$filaordenpiso->pisoNomb;
      $idordenpiso=$filaordenpiso->idordenn;
      array_push($arrayordensporpisos,$idordenpiso); 

       $objordenlistado=new OrdenGeneral();
       $resultadoinfo=$objordenlistado->mostrarInformaciondeCausaDeUnaOrden($idordenpiso);
       $filacausasorden=mysqli_fetch_object($resultadoinfo);

       $condicionorden=mostrarcondiciondeorden($idordenpiso);
       /*ENCRIPTACION DEL ID DE CAUSA*/
/*       $mascarac=$filacausasorden->idcausa*1213141516;
       $encriptado1=base64_encode($mascarac);
        /*ENCRIPTACION DEL ID DE ORDEN*/
/*        $mascara=$filacausasorden->idorden*1020304050;
        $encriptada=base64_encode($mascara);
       echo "<tr>";
       echo " <td><a href='ficha.php?squart=$encriptado1' target='_blank'>$filacausasorden->codigocausa</a><br><br>
        <a href='orden.php?squart=$encriptada' target='_blank'>$condicionorden&nbsp;$pisojuzgado&nbsp;($idordenpiso)</a> 
       </td>";
       echo "<td>$filacausasorden->nombrecausa</td>";
       echo "<td>$filacausasorden->abogadogestor</td>";
       //echo "<td>$filacausasorden->procuradorasig</td>";
       echo "<td>$filacausasorden->clienteasig</td>";
       echo "<td>$filacausasorden->Categ</td>";
       echo "<td>$filacausasorden->Observ</td>";
       echo "</tr>";


     
    }*/


  }/*FIN DEL BOTON LISTAR POR PISOS*/





  /*PREGUNTA SI SE SELECCIONO ALGUN tipo legal de CAUSA*/
if (isset($_POST['selectcodcausa'])) 
{
  $idtplegal=$_POST['selectcodcausa'];
  $objcausa=new Causa();
   $resul=$objcausa->listarCausaDeUnTipoLegalDeProcurador($idtplegal,$idprocuradoractual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1213141516;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
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




                 
                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
/*PARA EL ABOGADO*/       
      $mascara=$fil->idabog*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
      echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$fil->abogadogestor</a></td>";
             // echo "<td>$fil->procuradorasig</td>";
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
   $resul=$objcausa->listarcausasactivasdeabogadoDeProcurador($idabog,$idprocuradoractual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1213141516;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
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




                 
                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
/*PARA EL ABOGADO*/       
      $mascara=$fil->idabog*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
      echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
       echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$fil->abogadogestor</a></td>";
             // echo "<td>$fil->procuradorasig</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun abogado*/



/*PREGUNTA SI SE SELECCIONO ALGUN procurador*/
if (isset($_POST['selectcodprocurador'])) 
{
  $idproc=$_POST['selectcodprocurador'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeprocurador($idproc);
   while ($fil=mysqli_fetch_object($resul)) {
      echo "<tr>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1213141516;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
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




                 
                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>";
      echo "<td>$fil->clienteasig</td>";
     // echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun procurador*/




/*PREGUNTA SI SE SELECCIONO ALGUN cliente*/
if (isset($_POST['selectcodcliente'])) 
{
  $idclie=$_POST['selectcodcliente'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeclienteDeProcurador($idclie,$idprocuradoractual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1213141516;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
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




                 
                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
/*PARA EL ABOGADO*/       
      $mascara=$fil->idabog*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
      echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
      echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$fil->abogadogestor</a></td>";
             // echo "<td>$fil->procuradorasig</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun cliente*/


/*PREGUNTA SI SE SELECCIONO ALGUNa categoria*/
if (isset($_POST['selectcodcateg'])) 
{
  $idcateg=$_POST['selectcodcateg'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeCategoriaDeProcurador($idcateg,$idprocuradoractual);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1213141516;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausaDeProcurador($fil->id_causa,$idprocuradoractual);
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




                 
                   $mascara=$filord->codorden*1020304050;
                   $encriptada=base64_encode($mascara);
                 echo "<a style='color: $colorcausa' target='_blank' href='orden.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
/*PARA EL ABOGADO*/       
      $mascara=$fil->idabog*1234567;
      $encriptadoid=base64_encode($mascara);

      $mascarauser=2*1234567;
      $encriptadouser=base64_encode($mascarauser);
      // PARA EL CLIENTE
      $mascaraCli=$fil->idcliente*1234567;
      $encriptadoidcli=base64_encode($mascaraCli);

      $mascarauserCli=5*1234567;
      $encriptadouserCli=base64_encode($mascarauserCli);
      echo "</td>";
      echo "<td>$fil->nombrecausa</td>";
     echo "<td><a href='../perfil_user.php?squart=$encriptadoid&type=$encriptadouser' target='_blank'>$fil->abogadogestor</a></td>";
             // echo "<td>$fil->procuradorasig</td>";
              echo "<td><a href='../perfil_user.php?squart=$encriptadoidcli&type=$encriptadouserCli' target='_blank'>$fil->clienteasig</a></td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$fil->Observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono alguna categoria*/
  ?>
 
</tbody>
</table>

    </div>
    <br>
    <br>
    <br>
<script type="text/javascript" src="../resources/jquery.js"></script>


<img class="imgcargando" id="imgcargando" src="../cargando.gif">
    <style type="text/css">
      .imgcargando{
        position: absolute;
        top: 6%;
        left: 23%;
        width: 60%;
         display: none;
    }
    </style>

<!-- ======================CODIGO PARA PEDIR EL TOKEN Y GUARDARLO===================================== -->


<script>
  // Initialize Firebase
  /*Update this config*/
  // Your web app's Firebase configuration
  var firebaseConfig = {
   apiKey: "AIzaSyCzZmsCOBlZ3919YXWXBW9EjGeOeLW3pGs",
    authDomain: "proyectocausas.firebaseapp.com",
    databaseURL: "https://proyectocausas.firebaseio.com",
    projectId: "proyectocausas",
    storageBucket: "proyectocausas.appspot.com",
    messagingSenderId: "841093566284",
    appId: "1:841093566284:web:4fcb8682f97b7b9eed49e9",
    measurementId: "G-T2XQX77ZTG"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

// ======================0NUEVO CODIGO QUE PIDE PERMISO AL TOKEN============================
var newtoken='';

const messaging = firebase.messaging();
messaging.requestPermission()
.then(function(){
    $('#imgcargando').show();
  console.log('Tenemos permiso putos');
  
  return messaging.getToken();
  
})
.then(function(token){
  console.log(token);
  /*MOSTRAMOS EL TOKEN EL HTML */
   newtoken=token;
   // $('#text_token2').text(token);
   //alert(token);
 //===== ENVIAMOS EL TOKEN A LA BASE DE DATOS=====================
   var formDataUp = new FormData(); 
   var tokenbd=token;
   var idproc=<?php echo $idprocuradoractual ?>;

   formDataUp.append('token',tokenbd);
   formDataUp.append('idprocurador',idproc);
   
   $.ajax({ url: '../controller/control-regTokenProcurador.php', 
               type: 'post', 
               data: formDataUp, 
               contentType: false, 
               processData: false, 
               success: function(response) { 
                 if (response == 1) { 
                      $('#imgcargando').hide();
                    } 
                    if (response==0) 
                   {
                    
                    }
                  
                 
                } 
            });
//    //===== ENVIAMOS EL TOKEN A LA BASE DE DATOS===================== 

})
.catch(function(err){
  console.log('Error, Denegado')
})


  messaging.onMessage(function(payload) {
    console.log("Message received. ", payload);
    notificationTitle = payload.data.title;
    notificationOptions = {
      body: payload.data.body,
      message: payload.data.message,
      icon: payload.data.icon,
      requireInteraction: payload.data.requireInteraction,
      sound: payload.data.sound
    };
    var notification = new Notification(notificationTitle,notificationOptions);
  });
</script>
<!--==================FIN DEL CODIGO QUE PIDE EL TOKEN Y LO GUARDA A LA BASE DE DATOS===============-->


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