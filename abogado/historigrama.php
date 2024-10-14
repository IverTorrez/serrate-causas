<?php
error_reporting(E_ERROR);
session_start();
if(!isset($_SESSION["abogado"]))
{
  header("location:../index.php");
}
$datos=$_SESSION["abogado"];
?>
<!DOCTYPE html>
<html>
<head>
    <title> Historigrama</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="../resources/menu.css">
    <link rel="stylesheet" type="text/css" href="../resources/tabla.css">
   
    <link rel="stylesheet" type="text/css" href="../resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="../resources/stylomodal.css">
    
</head>
<body>
<?php

include_once('../model/clscausa.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clspostacausa.php');
include_once('../model/clsinformeposta.php');
include_once('../model/clstipoposta.php');

$cod=$_GET['squart'];

 //SE DESENCRIPTA EL CODIGO PARA PODER USARLO //
   $decodificado=base64_decode($cod);

   $codigonuevo=$decodificado/12345678910;

   $objcausa=new Causa();
   $resul=$objcausa->mostrarcodcausa($codigonuevo);
   $fil=mysqli_fetch_object($resul);
   // echo "<td style='width: 10%;'>$fil->codigo</td>";

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
       <div id="main_menu_admin">
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
                
                <ul>
                    <li><button class="botones" style="width: 200px;height: 45px;" onclick="location.href='fichacausa.php?squart=<?php echo $cod; ?>'">FICHA</button></li>
                    <li><button class="botones" style="width: 200px; height: 45px;" onclick="location.href='listaorden.php?squart=<?php echo $cod; ?>'"> LISTA ORDENES </button></li>
                    <?php
                   // $idabogado=2;
                    $idabogado=$datos["id_abogado"];
                    $objc=new Causa();
                    $lis=$objc->mostrariddelabogadoenunacausa($codigonuevo);
                    $fila=mysqli_fetch_object($lis);
                    if ($fila->id_abogado==$idabogado) 
                    {
                          
                      
                    }

                     ?>
                 
                </ul>
                <br>
                <br>
            </div> <!-- END #portfolio_menu -->

            </div> <!-- END .container -->
            
        </div> <!-- END #portfolio_area -->
        
    </div> <!-- END #main_content -->

     <!--NOMBRE DE LA PLANTILLA-->
  <div class="container">

      <input type="hidden" name="" placeholder="id causa" value="<?php echo $codigonuevo; ?>">
     <section class="responsive">
      <h3 style="color: #000000;font-size: 20px;text-align: center;">AVANCE FISICO DE LA PRESENTE CAUSA</h3>
      <br>
      <!--TABLA 1-->

     </section>

  </div>

   












<div class="container">

    <div>
    <?php
    $objpostcausa=new PostaCausa();
    $resulnombplantilla=$objpostcausa->listarPostasDeCausa($codigonuevo);
    $filanompl=mysqli_fetch_object($resulnombplantilla);
    
    echo "<center>  <h3 style='text-align: center;'>$filanompl->copianombreplantilla</h3></center>
    </div><br>";
    ?>


 </div>


    
    <br>
    



    <?php
/*DESDE AQUI EMPIEZA EL BOTON INICIO CON SU FLECHA HACIA ABAJO*/

$objpstcausa=new PostaCausa();
$resulpstcausa=$objpstcausa->mostrarPrimerPostaCausa(1,$codigonuevo);
$filpstcausa=mysqli_fetch_object($resulpstcausa);
/*PREGUNTA SI YA SE INTRODCIO EL PRIMER PASO, PARA DARLE COLOR A LOS BORDES*/
  if ($filpstcausa->estado=='llena') 
    {
      $colorbordebtnini='#87E534';
       $colorfondopostaini='#87E534';
    }
  else/*POR FALSO LOS DEJA CON EL COLOR NONE*/
    {
      $colorbordebtnini='#E5E5E5';
       $colorfondopostaini='#E5E5E5';
    }

/*FUNCION PARAVERIFICAR SI ESTA CAUSA TIENE PLANTILA ASIGNADA*/
$objPC=new PostaCausa();
$resulconteo=$objPC->contadorDePostasCausaDeunaCausa($codigonuevo);
$filconteo=mysqli_fetch_object($resulconteo);

if ($filconteo->cantidadPostas) 
{
  echo " <div class='container'>
   <center> <div style='height: 60px; '>
     <button class='btniniposta' style='border: 5px solid $colorbordebtnini; background:$colorfondopostaini;'>INICIO</button>
   </div>
    <div class='trianguloini' style='border-bottom: 20px solid $colorbordebtnini ;'></div>
   </center></div ";/*div del container*/
/*HASTA AQUI EMPEZO EL BOTON INICIO CON SU FLECHA HACIA ABAJO*/
}

//$varabilitaboton="enabled=''";


/*$objposca=new PostaCausa();
$reulpcau=$objposca->listarPostasDeCausa($codigonuevo);
while ($filposta=mysqli_fetch_object($reulpcau)) 
{

  $objinformeposta=new InformePosta();
  $resulinformep=$objinformeposta->muestraTodoelInformeDePostaParaDemasUsuarios($filposta->id_postacausa);
  $filinfor=mysqli_fetch_object($resulinformep);
   /*PREGUNTA SI LA POSTA ACTUAL ESTA LLENA, DEPENDE DE ESO COLOREARA LOS BORDES DE LOS CIRCULOS Y LAS FLECHAS Y LE PERMITIRA USAR EL BOTON */


 /*   if ($filposta->estado=='llena') 
    {
      $colorflechalinea='green';
      $colorflechatriang='green';

      $colorbordePosta='green';
      $colorfondoposta='#32BD49';
      /*SE ABILITA BOTON NUMEROPOSTA*/
/*      $varabilitaboton="enabled=''";
       $colorNombreposta='green';
    }
    else
    {
      $colorflechalinea='#B0B0B0';
      $colorflechatriang='#B0B0B0';

      $colorbordePosta='none';
      $colorfondoposta='#E5E5E5';
      /*SE DESABILITA EL BOTON*/
 /*     $varabilitaboton="disabled=''";
      $colorNombreposta='#B0B0B0';
    }*/


    /*****************************************************************************/


    /*CODIG PARA VERIFICAR SI LA SIGUIENTE POSTA ESTA LLENA (POR VERDADERO SE INABILITA EL BOTON ACTUAL)
    $idpostasiguiente=$filposta->id_postacausa+1;
    $objpostcausa11=new PostaCausa();
    $resulpostcausa11=$objpostcausa11->mostrarUnaPostaCausa($idpostasiguiente,$codigonuevo);
    $filpostasigu=mysqli_fetch_object($resulpostcausa11);
    if ($filpostasigu->estado=='llena') 
    {
      $varabilitaboton="disabled=''";
    }*/

//  echo "
//      <div class='linea' style='background:$colorflechalinea;'  id=''></div> 
//       <div class='triangulo' style='border-bottom: 20px solid $colorflechatriang ;'></div>
//        ";/*FLECHA APUNTANDO HACIA ABAJO*/


/*AQUI ARA EL CALCULO PARA EL GASTO PROCESALES*/
//          $fechainformeConhora=$filinfor->fechainforme.' '.'23:59';
//          $oborden=new OrdenGeneral();
//          $resultgastos=$oborden->mostrarGastosProcesalesHastaUnaPostaDeUnaCausa($codigonuevo,$fechainformeConhora);
//          $filgastosp=mysqli_fetch_object($resultgastos);
//          if ($filgastosp->Gastosprocesales>0) 
//          {
//            $gastosprocesales1=$filgastosp->Gastosprocesales;
//          }
//          else
//          {
//            $gastosprocesales1=0;
//            //$totalgastodecausa=0;
//          }
          
//          $totalgastodecausa=$gastosprocesales1+$filinfor->informehonorario;

 /*DESDE AQUI EMPIEZA EL NUMERO DE POSTA*/
//  echo "
//        <div style='width: 100%; height: 90px; '>
//       <!--DESDE AQUI EMPIEZA EL NUMERO DE POSTA-->
       
//      <div style=' width: 10%; float: center;'>

//         <button onclick='funcionllevaidmodal($filposta->id_postacausa)' parametro='$filposta->estado' parametro2='$filinfor->fojainforme' parametro3='$filinfor->informehonorario' parametro4='$filposta->nombrepostacausa' parametro5='$filinfor->fechainforme' parametro6='$filinfor->nombreTposta' parametro7='$filinfor->id_informeposta' parametrogastopro='$gastosprocesales1' parametrogastototal='$totalgastodecausa' class='btnposta' style='border-color: $colorbordePosta ; background:$colorfondoposta;' $varabilitaboton >$filposta->numeropostacausa</button>
//       </div>

       
//      <!--HASTA AQUI TERMINA EL NUMERO DE POSTA-->";
 /*HASTA AQUI TERMINA EL NUMERO DE POSTA*/



/*DESDE AQUI EMPIEZA LA INFORMACION DE LA POSTA (LO QUE INTRODUCE EL ABOGADO)*/
// echo "     <!--DESDE AQUI EMPIEZA LA INFORMACION DE LA POSTA , LO QUE INTRODUCE EL ABOGADO-->
//      <div style='float: left; height: 90px; text-align: right; width: 42%; '>
//        <label style='color: $colorNombreposta; font-family: fantasy;'>$filposta->nombrepostacausa</label><br>";

//        if ($filposta->estado=='vacia') 
//        {
//          echo "<label></label><br>
//                <label></label><br>
//                <label></label><br>
//                <label></label>";
          //$varabilitaboton="disabled=''";
//        }
//        else
//        {
          /*AQUI ARA EL CALCULO PARA EL GASTO PROCESALES*/
//          $fechainformeConhora=$filinfor->fechainforme.' '.'23:59';
//         $oborden=new OrdenGeneral();
//          $resultgastos=$oborden->mostrarGastosProcesalesHastaUnaPostaDeUnaCausa($codigonuevo,$fechainformeConhora);
//          $filgastosp=mysqli_fetch_object($resultgastos);
//          if ($filgastosp->Gastosprocesales>0) 
//          {
//            $gastosprocesales1=$filgastosp->Gastosprocesales;
//          }
//          else
//          {
//            $gastosprocesales1=0;
            //$totalgastodecausa=0;
//          }
          
//           $totalgastodecausa=$gastosprocesales1+$filinfor->informehonorario;
//          echo "<label>(Foja: $filinfor->fojainforme) </label><br>
//
//               <label>$filinfor->fechainforme </label><br>
//
//               <label>Gastos Procesales: $gastosprocesales1 Bs </label><br>
//
//               <label>Honorarios Profesionales: $filinfor->informehonorario Bs </label><br>

//               <label>TOTAL: $totalgastodecausa Bs </label><br>";

         // $varabilitaboton="enabled=''";
 //       }
        
 // echo "</div>"; 
  //echo "  <!--HASTA AQUI TERMINA LA INFORMACION DE LA POSTA , LO QUE INTRODUCE EL ABOGADO-->";
/*HASTA AQUI TERMINA LA INFORMACION DE LA POSTA (LO QUE INTRODUCE EL ABOGADO)*/





    /*IF QUE PREGUNTA SI EL TIPO DE POSTA ES DIFERENTE DE UNO Y SI NO ESTA VACIO (SI ES DIFERENTE ES TRUNCAMIENTE)**/
//    if ($filinfor->idtipoposta!=1 and $filinfor->idtipoposta!=null) 
//    {
//      $objtipoposta1=new TipoPosta();
//      $resultpposta1=$objtipoposta1->mostrarUnTipoPosta($filinfor->idtipoposta);
//      $filtpposta=mysqli_fetch_object($resultpposta1);
     
//    echo "   <!--DESDE AQUI MUESTRA EL TRUNCAMIENTO DE UNA POSTA***********************************************-->
//        <div style='float: right; height: 90px; text-align: left; width: 49%; '>

//            <!--DESDE AQUI MUESTRA LA FLECHA DE TRUNCAMIENTO**************************************-->
//              <div class='divflechatrunca' >
//                <div class='lineatrunca' id=''></div> <div class='triangulotrunca'></div>
//              </div>
//            <!--HASTA AQUI MUESTRA FLECHA DE TRUNCAMIENTO********************************************-->
      
//              <div style=' width: 50%; margin-left: 107px; margin-top: -8px; ' class='tipotruncamiento'>
//                  <div>
//                    <br>
//                    <center> <p >$filtpposta->nombretipoposta</p></center>
//                  </div>
//              </div>     
//        </div>

//        <!--HASTA QUI MUESTRA EL TRUNCAMIENTO DE UNA POSTA******************************************************-->";
        /*SE BESABILITA EL BOTON*/
//     $varabilitaboton="disabled=''";
//    }/*FIN DEL IF QUE PREGUNTA SI EL TIPO DE POSTA ES DIFERENTE DE UNO Y SI NO ESTA VACIO**/
    
  
//echo "</div>";

  
//}ANTIGUO WHILE QUE MOSTRABA EL AVANCE FISICO (HISTORIGRAMA) */ 
/*FIN DEL WHILE QUE RECORRE TODAS LAS POSTAS DE UNA CAUSA*/






echo "<br>";
/*PRUEBA PARA EL HITORGRMA SIN RESPONSIVE*/
$objposca=new PostaCausa();
$reulpcau=$objposca->listarPostasDeCausa($codigonuevo);
while ($filposta=mysqli_fetch_object($reulpcau)) 
{

  $objinformeposta=new InformePosta();
  $resulinformep=$objinformeposta->muestraTodoelInformeDePostaParaDemasUsuarios($filposta->id_postacausa);
  $filinfor=mysqli_fetch_object($resulinformep);
   /*PREGUNTA SI LA POSTA ACTUAL ESTA LLENA, DEPENDE DE ESO COLOREARA LOS BORDES DE LOS CIRCULOS Y LAS FLECHAS Y LE PERMITIRA USAR EL BOTON */
    if ($filposta->estado=='llena') 
    {
      $colorflechalinea='#87E534';
      $colorflechatriang='#87E534';

      $colorbordePosta='#87E534';
      $colorfondoposta='#87E534';
      /*SE ABILITA BOTON NUMEROPOSTA*/
      $varabilitaboton="enabled=''";
       $colorNombreposta='green';
    }
    else
    {
      $colorflechalinea='#B0B0B0';
      $colorflechatriang='#B0B0B0';

      $colorbordePosta='none';
      $colorfondoposta='#E5E5E5';
      /*SE DESABILITA EL BOTON*/
      $varabilitaboton="disabled=''";
      $colorNombreposta='#B0B0B0';
    }
    /*****************************************************************************/


    /*CODIG PARA VERIFICAR SI LA SIGUIENTE POSTA ESTA LLENA (POR VERDADERO SE INABILITA EL BOTON ACTUAL)
    $idpostasiguiente=$filposta->id_postacausa+1;
    $objpostcausa11=new PostaCausa();
    $resulpostcausa11=$objpostcausa11->mostrarUnaPostaCausa($idpostasiguiente,$codigonuevo);
    $filpostasigu=mysqli_fetch_object($resulpostcausa11);
    if ($filpostasigu->estado=='llena') 
    {
      $varabilitaboton="disabled=''";
    }*/









/*****************************************************DESDE AQUI AGREGAMOS LA TABLA*********************************************/

/*EMPIEZA LAS FLACHAS CON LA TABLA*****************************************************************************************/
echo "<div class='container'>
    <center> 
        <div style=''>
        <div class='linea' style='background:$colorflechalinea;' ></div> 
        <div class='triangulo' style='border-bottom: 20px solid $colorflechatriang ;'></div>
        </div>
    </center>";
  

  echo "<table style='width: 100%;'><!--EMPIEZA LA TABLA QUE MUESTRA LAS POSTAS-->
  <tbody>
    <tr style='height: 100px;'>";
   /*empieza la primera columna de la tabla informacion de posta*/
   echo "<td style='width: 46%;'>
                             <div style='text-align: right;'>
                              <label style='color: $colorNombreposta; '>$filposta->nombrepostacausa</label><br>";
                              if ($filposta->estado=='vacia') 
                                {
                                  echo "<label></label><br>
                                        <label></label><br>
                                        <label></label><br>
                                        <label></label><br>
                                        <label></label><br>";
                                  //$varabilitaboton="disabled=''";
                                }
                                else
                                {
                                  /*AQUI ARA EL CALCULO PARA EL GASTO PROCESALES*/
                                  $fechainformeConhora=$filinfor->fechainforme.' '.'23:59';
                                  $oborden=new OrdenGeneral();
                                  $resultgastos=$oborden->mostrarGastosProcesalesHastaUnaPostaDeUnaCausa($codigonuevo,$fechainformeConhora);
                                  $filgastosp=mysqli_fetch_object($resultgastos);
                                  if ($filgastosp->Gastosprocesales>0) 
                                  {
                                    $gastosprocesales1=$filgastosp->Gastosprocesales;
                                  }
                                  else
                                  {
                                    $gastosprocesales1=0;
                                    //$totalgastodecausa=0;
                                  }
                                  
                                   $totalgastodecausa=$gastosprocesales1+$filinfor->informehonorario;
                                  echo "<label>(Foja: $filinfor->fojainforme) </label><br>

                                       <label>$filinfor->fechainforme </label><br>

                                      <!-- <label>Gastos Procesales: $gastosprocesales1 Bs </label><br>

                                       <label>Honorarios Profesionales: $filinfor->informehonorario Bs </label><br>

                                       <label>TOTAL: $totalgastodecausa Bs </label>--><br><br><br>";

                                 // $varabilitaboton="enabled=''";
                                }
        
     echo "</td>";/*termina la primera columna de latabla*/

  
  /*empieza la segunda columna de la tabla numero de posta*/
   echo "<td style='width: 8%;'>

        <button onclick='funcionllevaidmodal($filposta->id_postacausa)' parametro='$filposta->estado' parametro2='$filinfor->fojainforme' parametro3='$filinfor->informehonorario' parametro4='$filposta->nombrepostacausa' parametro5='$filinfor->fechainforme' parametro6='$filinfor->nombreTposta' parametro7='$filinfor->id_informeposta' parametrogastopro='$gastosprocesales1' parametrogastototal='$totalgastodecausa' class='btnpostanuevo' style='border-color: $colorbordePosta ; background:$colorfondoposta;' $varabilitaboton>$filposta->numeropostacausa</button>

        </td>";/*termina la segunda columna*/



   /*empieza la tercera columna de la tabla flecha del truncamiento*/
    echo "<td style='width: 8%;'>";
           /*IF QUE PREGUNTA SI EL TIPO DE POSTA ES DIFERENTE DE UNO Y SI NO ESTA VACIO (SI ES DIFERENTE ES TRUNCAMIENTE)**/
            if ($filinfor->idtipoposta!=1 and $filinfor->idtipoposta!=null) 
            {
              $objtipoposta1=new TipoPosta();
              $resultpposta1=$objtipoposta1->mostrarUnTipoPosta($filinfor->idtipoposta);
              $filtpposta=mysqli_fetch_object($resultpposta1);

           echo " <div style='width: 100%;'>
                     <div class='divflechatruncaprueeva'>
                      <div class='lineatruncaprueva' id=''></div> <div class='triangulotruncaprueba'></div>
                    </div>

                 </div>";
            $varabilitaboton="disabled=''";
          }/*FIN DEL IF QUE PREGUNTA SI EL TIPO DE POSTA ES DIFERENTE DE UNO Y SI NO ESTA VACIO**/
    
     echo "</td>";/*termina la tercera columna de la tabla*/



  /*empieza la cuarta columna de la tabla , el tipode truncamiento*/
  echo "<td style='width: 38%;'>";
        if ($filinfor->idtipoposta!=1 and $filinfor->idtipoposta!=null) 
            {
              $objtipoposta1=new TipoPosta();
              $resultpposta1=$objtipoposta1->mostrarUnTipoPosta($filinfor->idtipoposta);
              $filtpposta=mysqli_fetch_object($resultpposta1);
          echo " <div style=' width: 70%; margin-top: -8px; ' class='tipotruncamiento'>
                  <div>
                    <br>
                       <center> <p >$filtpposta->nombretipoposta</p></center>
                  </div>
               </div>"; 
             $varabilitaboton="disabled=''";
           } /*FIN DEL IF QUE PREGUNTA SI EL TIPO DE POSTA ES DIFERENTE DE UNO Y SI NO ESTA VACIO**/
        
    echo "</td>";/*termina la cuarta columna de la tabla , el tipode truncamiento*/


  echo " </tr>

  </tbody>
</table><!--FIN DE LA TABALA-->
</div><!--FIN DEL CONTAINER-->"; 

  
}/*FIN DEL WHILE QUE RECORRE TODAS LAS POSTAS DE UNA CAUSA*/
?>

</div>




  



  


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
  background: #FF6A49 ;

  margin-left: 50px;
}
.triangulotruncaprueba{
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 20px solid #FF6A49;
   margin-left: 42px;

   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);
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
right: 50%;
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
  /*border-bottom: 20px solid #B0B0B0 ;*/
 /*  margin-left: 617px;*/

   transform: rotate(180deg);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);

}
.linea
{
  height: 100px;
  width: 4px;
 /* background: #B0B0B0   ;*/
 /* margin-left: 625px;*/

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
     
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <label style="font-size:13px;"><b> FECHA DE INSTANCIA: </b></label>   
     <label style="font-size:15px;" ><b id="labelfecha"></b></label><br>

     
                                                          

    </div>
    <div class="modal-footer">
     

     
     <button type="button" class="btnclose" id="btncloseformpres" style="float: right;">Ok</button>
     </div>
      </form>

   
  </div>

</div>







<script type="text/javascript" src="../resources/jquery.js"></script>

  <!-- javascript -->
    <script type="text/javascript" src="../resources/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../resources/tinymce/plugin/tinymce/init-tinymce.js"></script>

</body>
</html>



<!--CODIGO PARA CARGAR DATOS DE UN REGISTRO AL TEXT, PARA MODIFICAR UN REGISTRO-->
<script type="text/javascript">
         
         $('#titulomod').hide();

        $(document).ready(function(){
        $('.btnpostanuevo').click(function(){
          $valor = $(this).attr('parametro'); // puedes remplazar "parametro" por le parametro que desees ya sea standar o personalizado
          $valor2=$(this).attr('parametro2');
          $valor3=$(this).attr('parametro3');
          $valor4=$(this).attr('parametro4');
          $valor5=$(this).attr('parametro5');
          $valor6=$(this).attr('parametro6');
          $valor7=$(this).attr('parametro7');
          //var sw=$(this).attr('parametro3');
          
          $('#textestadopostaCausa').val($valor);
           $('#labelfoja').text($valor2);
           $('#labelhonorario').text($valor3);
           $('#titlusent').text($valor4);
           $('#labelfecha').text($valor5);
           $('#labeltipoposta').text($valor6);
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