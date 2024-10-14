 <?php
  

  if (isset($_POST['btnguardarorden']))
  {
    crearordenadmin();
  } 

  function crearordenadmin()  
  {
    $idcausas=$_POST['textidcausa'];
   $idprocu=$_POST['selectproc'];
   
   $f1=$_POST['fechainicio'];
     $h1=$_POST['horainicio'];
     $f2=$_POST['fechafinal'];
     $h2=$_POST['horafinal'];
     if ( ($f1!=null) and ($h1!=null) and ($f2!=null) and ($h2!=null) ) {
      //echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Las Fechas no son nulas','success'); </script>";
       $fechini1=$_POST['fechainicio'];
    $newfechini1=date_create($fechini1);
    $fechainiformato=date_format($newfechini1, 'Y-m-d');


    $horaini1=$_POST['horainicio'];
    $newhoraini1=date_create($horaini1);
    $horainiformato=date_format($newhoraini1, 'H:i');
    $fechasinihoracompleto=$fechainiformato.' '.$horainiformato;

    ///DAR FORMATO A LA FECHA Y HORA DEL SISTEMA
    ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     ////$concat es la fecha y hora del sistema
     $concat=$fechoyal.' '.$horita;

     ///fecha y hora final
     $fechfin2=$_POST['fechafinal'];
    $newfechfin2=date_create($fechfin2);
    $fechafinformato=date_format($newfechfin2, 'Y-m-d');


    $horafin2=$_POST['horafinal'];
    $newhorafin2=date_create($horafin2);
    $horafinformato=date_format($newhorafin2, 'H:i');

    $fechasfinhoracompleto=$fechafinformato.' '.$horafinformato;
    /////////////////////
    //AQUI SE HACE LA VALIDACION DE FECHAS ES DECIR: FECHA INICIO MAYOR A FECHA DEL SISTEMA Y FECHA FIN MAYOR A FECHA INICIO
   /* */
    
     if ($fechasinihoracompleto>$concat) 
     {

         if ($fechasfinhoracompleto>$fechasinihoracompleto) {
           //echo "<script > setTimeout(function(){ }, 2000); swal('Bien',' Fecha Final es mayor que Fecha Inicio TODO ESTA BIEN','success'); </script>";
             ///AQUI SE SACA LA HORA DEL SISTEMA Y SE DA FORMATO A LA FECHA Y HORA
     ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;


    $f1=$_POST['fechainicio'];
    $f2=$_POST['fechafinal'];

    
    $horafinal=$_POST['horafinal'];

     //LA FECHA INTRODUCIDA SE CAMBIA DE FORMATO A AÑO-MES-DIA
     $date=date_create($f2); 
     $nuevafecha=date_format($date, 'Y-m-d');
  //  echo ' Fecha Final con FORMATO :'.$nuevafecha; echo "<br>"; 
   
     //LA HORA INTRODUCIDA SE CAMBIA EL FORMATO A HORA-MINITO-SEGUNDO
    $horas=date_create($horafinal); 
    $nuevahora=date_format($horas, 'H:i:s');
  //  echo 'Hora Final con FORMATO :'.$nuevahora;echo "<br>";

   $fechahora=$nuevafecha.$nuevahora;
  //  echo 'Fecha y Hora Final juntos :'.$fechahora;echo "<br>";


    ///ESTAS DOS LINEAS DE CODIGO AGARRAN FECHA Y HORA DE LA ZONA HORARIA Y FECHA Y HORA FINAL PUESTA POR EL ABOGADO
    $fecha1 =new DateTime($concat);/*fechas de la zona horaria*/
    $fecha2 =new DateTime($fechahora);


    $intervalo= $fecha1->diff($fecha2);

 //   echo 'DIferencia de horas  :'.$intervalo->format('%Y-%m-%d %H:%i:%s');echo "<br>"; 
 //   echo 'Fecha y hora actual  :'.$concat;echo "<br>";
    

    //CONVERTIMOS A ENTEROS DIAS,HORAS Y MINUTOS PARA PODER HACER CALCULOS
    $diasentero=intval($intervalo->format('%d'));
    $horaentero=intval($intervalo->format('%H'));
    $minutos=intval($intervalo->format('%i'));

 //   echo 'DIAS ENTEROS  :'.$diasentero;echo "<br>";
 //   echo 'HORAS ENTEROS  :'.$horaentero;echo "<br>";   
  //  echo 'MINUTOS ENTEROS  :'.$minutos;echo "<br>";
     

     /// CONVERTIMOS A MINUTOS LOS DIAS Y HORAS
    $totaldeminh=$horaentero*60;
    $totalminDia=$diasentero*1440;
    
    //SUMAMOS TODOS LOS MINUTOS EN UNA SOLA VARIABLE
    $resultadomin=$totaldeminh+$totalminDia+$minutos;
   
   ///CONVERTIMOS A HORAS TODOS LOS MINUTOS
    $resultadohora=$resultadomin/60;

 //  echo 'EL TOTAL DE HORAS ES  :'.$resultadohora;echo "<br>";

  ///PROVAMOS SI LA COMPARACION CON NUMEROS ENTEROS ES POSIBLE 
    if ($resultadohora >8) {
    //  echo "El intervalo de hora es mayor a 8 horas";echo "<br>";echo "<br>";
    }
    else{
     // echo "El intervalo de hora es menor a 8 horas";echo "<br>";echo "<br>";
    }//ES POSIBLE, COMPARAR TODO OK
    
  /*  */
  //PREGUNTA EL TOTAL DE LAS HORAS DE CADA ORDEN
      if ($resultadohora>=96) {
        $condicion=1;
      }
      if ($resultadohora>=24 and $resultadohora<96) {
        $condicion=2;
      }
      if ($resultadohora>=8 and $resultadohora<24) {
        $condicion=3;
      }
      if ($resultadohora>=3 and $resultadohora<8) {
         $condicion=4;
      }
      if ($resultadohora>=1 and $resultadohora<3) {
        $condicion=5;
      }
      if ($resultadohora<1) {
        $condicion=6;
      }
      $prioridad=$_POST['selectprioridad'];

    //  echo "La condicion es:".$condicion;echo "<br>";echo "<br>";
    //  echo "La prioridad es:".$prioridad;echo "<br>";echo "<br>";
  
     //obtenemos datos de la tabla prioridad para hacr cotizacion
      $objprioridad=new Prioridad();
      $listprio=$objprioridad->muestraprioridadselect($prioridad,$condicion);
      $fil=mysqli_fetch_object($listprio);
    //  echo "BD El id es:".$fil->id_prioridad;echo "<br>";echo "<br>";
    //   echo "BD El nombre de prio es:".$fil->nombreprioridad;echo "<br>";echo "<br>";
    //   echo "BD El preciocompra es:".$fil->preciocompra;echo "<br>";echo "<br>";
    //  echo "BD El precioventa es:". $fil->precioventa;echo "<br>";echo "<br>";
      // echo "BD la penalizacion  es:".$fil->penalizacion;echo "<br>";echo "<br>";
      // echo "BD La condicion es:".$fil->condicion;echo "<br>";echo "<br>";
      
      $objorden=new OrdenGeneral();
    $objorden->setinformacion($_POST['texteditorinformacion']);
    $objorden->setdocumentacion($_POST['texteditordocum']);
    $objorden->setfechainiorden($_POST['fechainicio']); //la fecha que da el abogado, desde cuando empieza la orden
    $objorden->setfechafinorden($_POST['fechafinal']);//fecha que da el abogado, cuando caduca la orden
    $objorden->sethorainiorden($_POST['horainicio']);//la hora que da el abogado, desde cuando empieza la orden
    $objorden->sethorafinorden($_POST['horafinal']);//hora que da el abogado, cuando caduca la orden
    $objorden->setfechagiro($concat); //fecha cuando se giro la orden la pone el sistema
    $objorden->setplazohoras($resultadohora);//el total de horas entre fechagiro y fechafinal
    $objorden->setestadoorden('Girada');//la orden ya a sido girada
    $objorden->setprioridaorden($fil->nombreprioridad);//no se muy bien para que lo puse, por el momento esta asi
    $objorden->setid_causaorden($idcausas);
    $objorden->setid_procuradororden($idprocu);
    $objorden->setid_prioridadorden($fil->id_prioridad);

    $objorden->settiporden('ADM');
    $objorden->setvisible('Si');
    
    $idcausas=0;
    $idcausas=$_POST['textidcausa'];
     $mascara=$idcausas*1234567;
    $encriptado=base64_encode($mascara);
  

    if ($objorden->guardarorden()) {
      
      $objcotiz=new Cotizacion();
      $objcotiz->setcotizacioncompra($fil->preciocompra);
      $objcotiz->setcotizacionventa($fil->precioventa);
      $objcotiz->setcotizacionpenalidad($fil->penalizacion);
      $objcotiz->setprioridadcoti($prioridad);
      $objcotiz->setcondicioncoti($condicion);

      $objord=new OrdenGeneral();
      $idcausa=$_POST['textidcausa'];
      $resul=$objord->listarultimaorden($idcausa);
      $fila=mysqli_fetch_object($resul);
      $objcotiz->setid_ordencotizacion($fila->ultorden);
      if ($objcotiz->guardarcotizacion()) {
        echo "<script > setTimeout(function(){ location.href='listaordenes.php?squart=$encriptado'; }, 500); swal('EXELENTE','Se Giro La Orden Del Administrador Con Exito ','success'); </script>";
      }
      else{
        echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Giro La Orden Del Administrador ','warning'); </script>";
      }

    }
             


         }
         else{
            echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora  Final deben ser mayores a Fecha y Hora inicio ','warning'); </script>";
         }
       
     }
     else{
       echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora Inicio deben ser mayores a la Fecha y Hora actual, Asegurese de que la Fecha y Hora Inicio sean mayores que la fecha y hora  actual ','warning'); </script>";
     }

       
     }
     else{
      echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' Complete todos los campos de fechas y horas','warning'); </script>";
     }








    


  }
  ?>