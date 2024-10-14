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
	<title>lista de ordenes</title>
  <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
	<link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
   <link rel="stylesheet" type="text/css" href="../resources/tablalistordenab.css">
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once('../model/clscausa.php');
include_once('../model/clstribunal.php');
include_once('../model/clsordengeneral.php');

include_once('../model/clsdemandante_demandado.php');
include_once('../model/clspresupuesto.php'); 
include_once('../model/clsdescarga_procurador.php'); 

?> 

<?php
  /* $_SESSION['cod']=$_POST['idped'];
   echo $_SESSION['cod'];*/
 
   $codcausa=$_GET['squart'];
   //SE DESENCRIPTA EL CODIGO PARA PODER USARLO // 
   $decodificado=base64_decode($codcausa);

   $codigonuevo=$decodificado/1234567;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
    //echo "<td style='width: 10%;'>$fil->codigo</td>";

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
        
          <p id="codcausas"><?php echo $fil->codigo; ?> </p>
        <div id="main_menu">
        
            <ul>
                <li  class="first_listleft" style="float: left; width: 620px;"><a >USUARIO:<?php echo $datos['nombrecont']; ?>  TIPO:Contador</a></li>
                
                <li class="first_list" ><a href="contador_mis_causa.php" class="main_menu_first ">CAUSAS ACTIVAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
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
                
                <ul>
                    <li><button style="width: 200px; height: 45px;" class="botones" onclick="location.href='contador_ficha.php?squart=<?php echo $codcausa; ?>'">VOLVER A LA FICHA</button></li>
                    <li><button style="width: 200px; height: 45px;" class="botones" onclick="window.open('impresiones/pdf/lista_de_ordenes.php?squart=<?php echo $codcausa; ?>')">IMPRIMIR</button></li>
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->
   
            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->  

    <!--TABLA CAUSAS ACTIVAS-->
  <div class="container">
  <input type="hidden" name="" value="<?php echo $codigonuevo ?>">
   
    <h3 style="color: #000000;font-size: 25px;text-align: center;">LISTADO DE ORDENES</h3>
    <br>
   

<section class="responsive">
    <!--TABLA 1-->
       <table id="tblistordencontador">
    
 <thead>     
  <tr>
    <th width="100px"># DE ORDEN</th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(MONTO ENTREGADO)</p></th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(MONTO GASTADO)</p></th>
    <th width="100px">COSTO PROCESAL <br><p id="psubt">(SALDO POR DEVOLVER)</p></th>
    <th width="150px">PROCURADOR <br><p id="psubt">(GESTOR)</p></th>

    <th width="140px">FECHA DE GIRO DE LA ORDEN</th>
    <th width="140px">FECHA DE PRESUPUESTO</th>
    <th width="140px">FECHA DE ENTREGA DE DINERO</th>
    <th width="140px">FECHA DE DESCARGA</th>
    <th width="140px">FECHA DE INICIO DE VIGENCIA</th>
    <th width="140px">FECHA DE TERMINO DE VIGENCIA</th>
    
  </tr>
</thead>
<tbody>
  

  <?php
      ini_set('date.timezone','America/La_Paz');
       $fechoyal=date("Y-m-d");
       $horita=date("H:i");
       ////$concat es la fecha y hora del sistema
       $concat=$fechoyal.' '.$horita; 

   $objorden=new OrdenGeneral();
   $resul=$objorden->listarordenesdeunacausa($codigonuevo);
   while ($fil=mysqli_fetch_object($resul)) 
   {

    /*PARA EL COLOR A LAS FILAS DEPENDIENDO DE SU URGENCIA*/
      if ($fil->estado_orden=='Serrada')/*PREGUNTA SI ESTA SERRADA LA ORDEN*/ 
      {
       $backgroundfila='white'; 
       $fontcolor='#000000';
      }
      else/*POR FALSO*/
      {


          $fechafinorden=$fil->fin;
          $newfechfin=date_create($fechafinorden);
          $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

          $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
          $fecha2 =new DateTime($fechafinformato);/*FECHA Y HORA FINAL DE LA ORDEN*/
          if ($fecha1>$fecha2)/*PREGUNTA SI LA ORDEN ESTA VENCIDA*/ 
              {
                $vard='R';
                $varconcat=$vard.$prioriorden;

                $varcaraorden="<strike>$varconcat</strike>";

                $totaltiempoexpirar=0;
                $tiempo=0;
                $backgroundfila='#ffffff';
                $fontcolor='#b7b3b3';
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
                      $tiempo=$resultadohora;
                      $fontcolor='#000000';
                      if ($resultadohora>96) 
                      {
                        $backgroundfila='#D0E2D1'; 
                      }
                      if ($resultadohora>24 and $resultadohora<=96) 
                      {
                        $backgroundfila='#42A4D2'; 
                      }
                      if ($resultadohora>8 and $resultadohora<=24) 
                      {
                        $backgroundfila='#39B743'; 
                      }
                      if ($resultadohora>3 and $resultadohora<=8) 
                      {
                        $backgroundfila='#F5EB0F'; 
                      }
                      if ($resultadohora>1 and $resultadohora<=3) 
                      {
                        $backgroundfila='#F5860F'; 
                      }
                      if ($resultadohora>0 and $resultadohora<=1) 
                      {
                        $backgroundfila='red'; 
                      }

                      

          }
        }/*FIN DEL ELSE CUANDO UNA ORDEN NO ESTA SERRADA*/
     /*HASTA AQUI PONE LOS COLORES DE SU URGENCIAS*/

       echo "<tr style='background: $backgroundfila; color:$fontcolor;'>";
            //SE ENCRIPTA EL CODIGO DE LA ORDEN PARA ENVIARLO POR LA URL //
            $mascara=$fil->codigo*10987654321;
             $encriptado=base64_encode($mascara);
             if ($fil->Inicio<=$concat) 
             {
               echo "<td class='tdcod'><a style='color:$fontcolor;' href='contador_orden.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
             else
             {
              echo "<td class='tdcod'>*<a style='color:$fontcolor;' href='contador_orden.php?squart=$encriptado'>$fil->codigo</a></td>";
             }
 
              

              $objpre=new Presupuesto();
              $lis=$objpre->mostrarUnpresupuestoEntregadoDeorden($fil->codigo);
              $filap=mysqli_fetch_object($lis);

              echo "<td>$filap->monto_presupuesto</td>";

              $objdescar=new DescargaProcurador();
              $list=$objdescar->mostrardescargaorden($fil->codigo);
              $filades=mysqli_fetch_object($list);

              echo "<td>$filades->gastos</td>";//no hay ni en la consulta
              echo "<td>$filades->saldo</td>";//no hay ni en la consulta

              echo "<td>$fil->procuradorasig</td>";


              echo "<td>$fil->fecha_giro</td>";

              $objpresup=new Presupuesto();
              $listado=$objpresup->mostrarfechaspresupuestoyentrega($fil->codigo);
              $filapres=mysqli_fetch_object($listado);

             echo "<td>$filapres->fecha_presupuesto</td>";
              echo "<td>$filapres->fecha_entrega</td>";

              $objdesc=new DescargaProcurador();
              $resultado=$objdesc->mostrarfechadescarga($fil->codigo);
              $filafe=mysqli_fetch_object($resultado);

               echo "<td>$filafe->fecha_descarga</td>";

               echo "<td>$fil->Inicio</td>";
              echo "<td>$fil->fin</td>";


             
           

                            
              

               

            
        echo "</tr>";
          }
  ?>
 

</tbody>
</table>
</section>
<br>
<br>
 </div>

</body>
</html>