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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Causas Activas</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="css/sweet-alert.css">

     <script src="js/jquery.js"></script>
    

     <link rel="stylesheet" type="text/css" href="resources/stylomodal.css">

</head>
<body>
<?php
 
include_once('model/clscausa.php');
include_once('model/clsordengeneral.php');
include_once('model/clsabogado.php');
include_once('model/clsprocurador.php'); 
include_once('model/clscliente.php');
include_once('model/clscategoria.php'); 
include_once('model/clspiso.php');
include_once('model/clstipolegal.php');
include_once('model/clscajasdesalida.php');
include_once('controller/control-imagenindex.php');


?>
    <div id="header">
        
        <div class="container" >

        <?php
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
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first main_current">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first ">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
                
               

                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->


    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->

                 <?php
                   /*CONTADORES DE ORDENES VENCIDADAS LEVES Y GRAVES*/
                   $objorden9=new OrdenGeneral();
                   $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   $fil9=mysqli_fetch_object($resul9);

                   $objorden10=new OrdenGeneral();
                   $resul10=$objorden10->mostrarTotalVencidasGraves();
                   $fil10=mysqli_fetch_object($resul10);
                   
                   $resultorpre_presu=$objorden9->mostrartotalordenesPre_presupuestadas();
                   $filprepresu=mysqli_fetch_object($resultorpre_presu);


                  ?>
    
    <div id="main_content">
            
        <div id="portfolio_area">
            
            <div class="container">
     
            <div id="portfolio_menu">
                
                <ul>
                    <li><button style="width: 200px;" class="botones" onclick="location.href='crearcausas.php'">CREAR CAUSAS</button></li>
                    <li><button style="width: 200px;" class="botones" onclick="location.href='causascongeladas.php'">CAUSAS CONGELADAS</button></li>
                    <li><button style="width: 200px;" class="botones" onclick="location.href='causasterminadas.php'">CAUSAS TERMINADAS</button></li>
                    <li><button style="width: 200px;" class="botones" onclick="location.href='pagoprocuradores.php'">PAGO A PROCURADORES</button></li>
                    <li><button style="width: 230px;" class="botones" onclick="location.href='colocarcostojudicial.php'">COLOCAR COSTO JUDICIAL VENTA</button></li>
                    <li><button style="width: 158px;" class="botones" onclick="location.href='materia.php'">ACTUALIZAR TABLA MATERIA</button></li>

                    
                </ul>
                 <ul>
                 
                   <li><button style="width: 200px;" class="botones" onclick="window.open('impresiones/tcpdf/pdf/saldos_activos_inf1.php')">INF1 SALDOS ACTIVOS</button></li>
                
                    <li><button style="width: 200px;" class="botones" onclick="window.open('impresiones/tcpdf/pdf/saldos_congelados_inf2.php')">INF2 SALDOS CONGELADOS</button></li>
                    <li><button style="width: 200px;" class="botones" onclick="window.open('impresiones/tcpdf/pdf/saldos_terminados_inf3.php')">INF3 SALDOS TERMINADOS</button></li>
                    <li><button style="width: 200px;" class="botones" id="myBtnformcont">INF4 SALDO DE UNA CAUSA</button></li>
                    <li><button style="width: 180px;" class="botones" onclick="location.href='actualizartribunal.php'">ACTUALIZAR TRIBUNALES</button></li>
                    <li ><button style="width: 208px;" class="botones" onclick="location.href='tipolegal.php'">ACTUALIZAR TABLA TIPO LEGAL</button></li>
                    
                    
                </ul>
                <ul>
                    <form method="post" action="respaldos/myphp-backup.php" target="_blank">
                   <li><button style="background: red; color: white;" class="botones">EXPORTAR BASE DE DATOS</button></li>
                   </form>
                    <li><button style="background: red; color: white;" class="botones">EXPORTAR PERSONALIZADO</button></li>

                    <li style="float: right;"><button style="background: #1A5895; color: white;" onclick="location.href='caja_admin.php'" class="botones">OPERACIONES</button></li>
                    <li style="float: right;"><button  class="botones" onclick="location.href='causasvencidasgraves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil10->Totalvencidasgraves; ?>&nbsp;&nbsp;</span><br>VENCIDOS GRAVES</button></li>
                    <li style="float: right;"><button  class="botones" onclick="location.href='causasvencidasleves.php'"><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $fil9->Totalvencidasleves; ?>&nbsp;&nbsp;</span><br>VENCIDOS LEVES</button></li>
                    <li style="float: right;"><button class="botones" onclick="location.href='tipoTribunal.php'">ACT. TABLA CLASE DE TRIBUNALES</button></li>
                    <li style="float: right;"><button class="botones" id="myBtn">MODIFICAR IMAGEN INDEX</button></li>
                    <li style="float: right;"><button class="botones" onclick="location.href='planilla_notificaciones.php'" >NOTIFICACIONES</button></li>
                    
                    
                    
                </ul>
                <br>
                <br>
                 <?php
                include_once('botones_seguimientos.php');
                ?>
                <br>
            </div> <!-- END #portfolio_menu -->
            
            
            
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->



    <!--TABLA CAUSAS ACTIVAS-->
    <div class="container">
<!-- BOTON NUEVO AGREGADO PARA EL PASO INTERMEDIO      -->
    <div >
      <table width="100%">
        <tr>

          <td width="35%"> 
            <button style="height: 55px;" class="botones" onclick="location.href='causas_ordenes_pre_presupuestadas.php'" ><span id="contadoresvencidos">&nbsp;&nbsp;<?php echo $filprepresu->Totalpre_presupuestadas; ?>&nbsp;&nbsp;</span> <img style="width: 65px; float: right;" src="resources/imagenedesistema/Intermedio.png"></button>
          </td>

          <td width="65%">
            <h3 style="color: #000000;font-size: 25px;">LISTADO DE CAUSAS ACTIVAS</h3>
          </td>
        </tr>
      </table>  
    </div>
    
   <section class="responsive">

 
    <br>
       <table id="tablacausasactivas">
 <thead> 
 <tr >
  <!--SELECTOR PARA ELEJIR CAUSAS-->
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
                 
                 $nombreAbogado=$abog['apellidoabog'].', '.$abog['nombreabog'];
                 //Consulta antigua echo '<option value="'.$abog['id_abogado'].'">'.$abog['Nombre'].'</option>';
                 echo '<option value="'.$abog['id_abogado'].'">'.$nombreAbogado.'</option>';
               }

          ?>
        </select></td>
    </form>


   <!--SELECTOR PARA ELEJIR CAUSAS segun el PROCURADOR-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodprocurador" onchange="this.form.submit()"> 
           <option>FILTRAR POR PROCURADOR</option>
             <?php
              $obproc=new Procurador();
              $listaproc=$obproc->listarProcuradorActivos();
              while($proc=mysqli_fetch_array($listaproc)){
                $nombreProc=$proc['apellidoproc'].', '.$proc['nombreproc'];
                //Consulta antigua echo '<option value="'.$proc['id_procurador'].'">'.$proc['NombreP'].'</option>';
                echo '<option value="'.$proc['id_procurador'].'">'.$nombreProc.'</option>';
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
                $nombreClien=$cli['apellidocli'].', '.$cli['nombrecli'];
                //consulta antigua echo '<option value="'.$cli['id_cliente'].'">'.$cli['NombreC'].'</option>';
                echo '<option value="'.$cli['id_cliente'].'">'.$nombreClien.'</option>';
               }

             ?>
        </select></td>
    </form>

    <!--SELECTOR PARA ELEJIR CAUSAS SEGUN LA CATEGORIA-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodcateg"  onchange="this.form.submit()"> 
               <option>FILTRAR POR CATEGORIA</option>
               <?php
              $obcat=new Categoria();
              $listarcat=$obcat->listarCategoriasActivas();
              while($cat=mysqli_fetch_array($listarcat)){
                $nombreCat=$cat['nombrecat'].'- '.$cat['abreviaturacat'];
                 echo '<option value="'.$cat['id_categoria'].'">'.$nombreCat.'</option>';
               }

             ?>
        </select></td>
    </form>

   <!--SELECTOR PARA ELEJIR CAUSAS SEGUN EL PISO DEL TRIBUNAL-->
    <form method="post">
    <td><select id="selectcausas" name="selectcodpiso"  onchange="this.form.submit()"> 
               <option>FILTRAR POR PISO</option>
               <?php
              $obpiso=new Piso();
              $listarpiso=$obpiso->listarpisos();
              while($pis=mysqli_fetch_array($listarpiso)){
                $nombrePiso=$pis['nombrepiso'];
                 echo '<option value="'.$pis['id_piso'].'">'.$nombrePiso.'</option>';
               }

             ?>
        </select></td>
    </form>
 </tr>    
  <tr>
    <th width="150px">CODIGO</th>
    <th width="300px">NOMBRE DEL PROCESO</th>
    <th width="250px">ABOGADO</th>
    <th width="250px">PROCURADOR <br><p id="psubt">(POR DEFECTO)</p></th>
    <th width="250px">CLIENTE</th>
    <th width="100px" >CATEGORIA</th>
    <th width="440px">OBSERVACIONES</th>
  </tr>
</thead>
<tbody id="tabla_resultadoActivos">




 <?php

if (!isset($_POST['selectcodcausa']) and !isset($_POST['selectcodabogado']) and !isset($_POST['selectcodcliente']) and !isset($_POST['selectcodprocurador']) and !isset($_POST['selectcodcateg']) and !isset($_POST['selectcodpiso'])) 
{
   echo "<script type='text/javascript'>
    $(document).ready(function(){
        // Añadimos un parámetro único a la URL para evitar el caché
        var url = 'consultacausasactivasadmin.php?nocache=' + new Date().getTime();
        $('#tabla_resultadoActivos').load(url);
    });
</script>";
 
 /*  $objcausa=new Causa();
   $resul=$objcausa->listarcausas();
   while ($fil=mysqli_fetch_object($resul)) 
   {
      echo "<tr>";
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td class='tdcod'><a href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br>";

        /*LISTAR ORDENES DE LA CAUSA*/
/*               $cont=0;
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
 /*                 $objneworden=new OrdenGeneral();
                  $resultadoorden=$objneworden->mostrarfechayhorafin($filord->codorden);
                   $filordd=mysqli_fetch_object($resultadoorden);

                   $fechafinorden=$filordd->Fechafin;
                   $newfechfin=date_create($fechafinorden);
                   $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

                   $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
 /*                  $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/

                   /*COMPARACION DE FECHAS */
  /*                 if ($fecha1>$fecha2) {
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




                 
  /*                 $mascara=$filord->codorden*10987654321;
                   $encriptada=base64_encode($mascara);
                 echo "<a href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  $cont++;
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/ 


  /*    echo "</td>";

      echo "<td><a href='crearcausas.php?squart=$encriptado'>$fil->nombrecausa</a></td>";
      echo "<td>$fil->abogadogestor</td>";
      echo "<td>$fil->procuradorasig</td>"; 
      echo "<td>$fil->clienteasig</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td>$fil->Observ</td>";

      echo "</tr>";
    }*//*FIN DE LISTADO DE CAUSAS*/

}


/*PREGUNTA SI SE SELECCIONO ALGUN CODIGO DE CAUSA (OSEA UN TIPOLEGAL)*/
if (isset($_POST['selectcodcausa'])) 
{
  $idtplegal=$_POST['selectcodcausa'];
  $objcausa=new Causa();
   $resul=$objcausa->listarCausaDeUnTipoLegal($idtplegal);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
}/*FIN DEL IF QUE PREGUNTA SI SE SELECCIONO ALGUNA CAUSA*/


/*PREGUNTA SI SE SELECCIONO ALGUN ABOGADO*/
if (isset($_POST['selectcodabogado'])) 
{
  $idabog=$_POST['selectcodabogado'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeabogado($idabog);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun abogado*/


/*PREGUNTA SI SE SELECCIONO ALGUN procurador*/
if (isset($_POST['selectcodprocurador'])) 
{
  $idproc=$_POST['selectcodprocurador'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeprocurador($idproc);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
     if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun procurador*/


/*PREGUNTA SI SE SELECCIONO ALGUN cliente*/
if (isset($_POST['selectcodcliente'])) 
{
  $idclie=$_POST['selectcodcliente'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdecliente($idclie);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun cliente*/


/*PREGUNTA SI SE SELECCIONO ALGUNa categoria*/
if (isset($_POST['selectcodcateg'])) 
{
  $idcateg=$_POST['selectcodcateg'];
  $objcausa=new Causa();
   $resul=$objcausa->listarcausasactivasdeCategoria($idcateg);
   while ($fil=mysqli_fetch_object($resul)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->id_causa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->id_causa)>$fil->codigo</a><br><br>";

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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono alguna categoria*/


/*PREGUNTA SI SE SELECCIONO ALGUN PISO*/
if (isset($_POST['selectcodpiso'])) 
{
  $idpiso=$_POST['selectcodpiso'];
  $objcausap=new Causa();
   $resulpiso=$objcausap->listarCausasActivasPorPiso($idpiso);
   while ($fil=mysqli_fetch_object($resulpiso)) 
   {
       $colorcausa='';
     if ($fil->estadocausa=='Congelada') 
      {
        $colorcausa='#b7b3b3';
      }
      echo "<tr style='color: $colorcausa'>";
      /*ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      if ($fil->color_causa!='') 
      {
        $numerodeborde='30px';
        $colorfondoEstadoCausa=$fil->color_causa;
      }
      else
      {
        $numerodeborde='2px';
        $colorfondoEstadoCausa='none';
      }
      /*FIN ASIGNAMOS COLORES A LA COLUMNA SEGUN LAS CONDICIONES*/
      //SE ENCRIPTA EL CODIGO DE LA CAUSA PARA ENVIARLO POR LA URL //
      $mascara=$fil->idcausa*1234567;
      $encriptado=base64_encode($mascara);
      echo "<td style='border-left: $numerodeborde solid $colorfondoEstadoCausa;' class='tdcod'><a style='color: $colorcausa' href='ficha.php?squart=$encriptado' onclick=funcionirficha($fil->idcausa)>$fil->codigo</a><br><br>";

       /*LISTAR ORDENES DE LA CAUSA*/
               $objordenes=new OrdenGeneral();
               $listadoor=$objordenes->listarordenssinserrardecausa($fil->idcausa);
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
                 echo "<a style='color: $colorcausa' target='_blank' href='ordenadmin.php?squart=$encriptada'>$varcaraorden&nbsp; </a>";

                 

                  
               }/*FIN DEL LISTADO DE ORDEN DE LA CAUSA*/
      $nombreCausa=$fil->nombrecausa;
       $nombabogado=$fil->abogadogestor;
       $nombproc   =$fil->procuradorasig;
       $nombcliente=$fil->clienteasig;
       $observ     =$fil->Observ;
      echo "</td>";
      echo "<td><a style='color: $colorcausa' href='crearcausas.php?squart=$encriptado'>$nombreCausa</a></td>";
      echo "<td>$nombabogado</td>";
      echo "<td>$nombproc</td>";
      echo "<td>$nombcliente</td>";
      echo "<td>$fil->Categ</td>";
      echo "<td style='text-align: justify;'>$observ</td>";
      echo "</tr>";
  }/*FIN DEL LISTADO DE CAUSAS*/
  
}/*fin de if que pregunta si se selecciono algun  piso*/



  ?>
 
</tbody>
</table>


</section>

    </div>




    <br>
    <br>
    <br>




     <!-- The Modal PARA VISUALIZAR EL MOTIVO DEL RECHAZO -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="closeid">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >ESCOJA IMAGEN PARA EL INDEX</p></center>
     </div><br>
<form method="post" enctype="multipart/form-data">
    <div class="modal-body">
      
    <input type="file" class="inputfile" name="fileimagenindex" id="fileimagenindex" required="">
    <label style="font-size: 12px;">Las Medidas Para La Imagen A Ingresar Son: Alto:76px; Ancho:400px;</label>
    </div>
    
    <div class="modal-footer">
    <input style="background: #1A5895; max-width: 180px; float: left; width: 35%;" type="submit" class="btnclose" id="btncambiarimagenindex" name="btncambiarimagenindex" value="MODIFICAR">
    <button class="btnclose" id="btnclose" style="float: right;" type="button">Cancelar</button>
    </div>

  </form>

  </div>

</div>


<!--SCRIP QUE LLAMA AL MODAL motivo del rechazo-->
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btnclose = document.getElementById("btnclose");

// Get the <span> element that closes the modal
var spanid = document.getElementById("closeid");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanid.onclick = function() {
  modal.style.display = "none";
}
btnclose.onclick=function() {
  modal.style.display = "none";
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









<!-- The Modal (FORMULARIO) PARA MOSTRAR EL INFORME 4 -->
<div id="myModalformcont" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="spanclosecont">&times;</span><br>
      
      <h2 style="font-style: italic; ">SERRATE 3.0</h2>
    </div>
     <div><br>
      <center> <p style="font-size: 20px;font-family: fantasy;" >SELECCIONE UNA CAUSA PARA MOSTRAR SU SALDO</p></center>
     </div><br>
    
    <div class="modal-body">
      <select style="width: 100%;" class="textform" ondblclick="window.open('impresiones/tcpdf/pdf/saldo_decausa_inf4.php?cod='+this.value)" onchange="window.open('impresiones/tcpdf/pdf/saldo_decausa_inf4.php?cod='+this.value)">
        
        <?php
        $objc=new Causa();
        $resulc=$objc->listarTodasLasCausas();
        while ($filc=mysqli_fetch_object($resulc)) 
        {
          echo "<option value='$filc->idcausa'>$filc->codigo</option>";
        }
        ?>
      </select>
                                                        
      

     



    </div>
    <div class="modal-footer">
     
    <button class="btnclose" type="button" id="btncloseformcont" style="float: right;" >Cancelar</button>
    </div>
      

    </div>
  </div>

</div>








<!--SCRIP QUE LLAMA AL MODAL (FORMULARIO) PARA MOSTRAR EL INFORME 4-->
<script>
// Get the modal
var modalformcont = document.getElementById("myModalformcont");

// Get the button that opens the modal
var btn = document.getElementById("myBtnformcont");
var btncloseform = document.getElementById("btncloseformcont");

// Get the <span> element that closes the modal
var spanclose = document.getElementById("spanclosecont");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modalformcont.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanclose.onclick = function() {
  modalformcont.style.display = "none";
}
btncloseform.onclick=function() {
  modalformcont.style.display = "none";
}

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
</script>

