 <?php

 if (isset($_POST['btnguardarautoorden'])) 
 {
    crearAutoOrden();
 }

 if (isset($_POST['btneliminarautoorden'])) 
 {
     eliminarUnaAutoOrden();
 }

function crearAutoOrden()
{
     $f1=$_POST['fechainicio'];
     $h1=$_POST['horainicio'];
     $f2=$_POST['fechafinal'];
     $h2=$_POST['horafinal'];
     if ( ($f1!=null) and ($h1!=null) and ($f2!=null) and ($h2!=null) ) 
     {
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

                 if ($fechasfinhoracompleto>$fechasinihoracompleto) 
                 {
                         $idcausas=0;
                         $idcausas=$_POST['textidcausa'];
                         $mascara=$idcausas*12345678910;
                         $encriptado=base64_encode($mascara);

                        $objauto=new AutoOrden();
                        $objauto->setdetalleautoorden($_POST['texteditordetalleauto']);
                        $objauto->setfechainiauto($fechasinihoracompleto);
                        $objauto->setfechafinauto($fechasfinhoracompleto);
                        $objauto->setcolorauto($_POST['selectcolor']);
                        $objauto->setestadoauto('Activo');
                        $objauto->setid_causaauto($idcausas);
                        if ($objauto->guardarautoorden()) 
                        {
                           echo "<script > setTimeout(function(){ location.href='listaorden.php?squart=$encriptado'; }, 500); swal('EXELENTE','Se creo la nota para la agenda con exito ','success'); </script>"; 
                        }
                        else
                        {
                          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No creo la nota para la agenda ','warning'); </script>";
                        }

                 }/*FIN DEL IF QUE PREGUNTA SI LA FECHA FINAL ES MAYOR A LA FECHA INICIO */
                 else/*por falso osea(fecha final es menor a fecha inicio)*/
                 {
                    echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora  Final deben ser mayores a Fecha y Hora inicio ','warning'); </script>";
                 }



             }/*FIN DEL IF QUE PREGUNTA SI LA FECHA INICIO ES MAYOR A LA FECHA ACTUAL DE LA PAZ*/
             else/*por falso (osea la fecha inico es menor a la fecha actual de la paz) manda un mensaje*/
             {
                echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','Fecha y Hora Inicio deben ser mayores a la Fecha y Hora actual, Asegurese de que la Fecha y Hora Inicio sean mayores que la fecha y hora  actual ','warning'); </script>";
             }

    }/*FIN DEL IF QUE PREGUNTA SI LAS FECHAS NO ESTAN VACIAS*/



}/*FIN DE LA FUNCION CREARAUTOORDEN()*/


function eliminarUnaAutoOrden()
{
    $objauto1=new AutoOrden();
    $objauto1->setid_autoorden($_POST['textidautoorden']);
    $objauto1->setestadoauto('Inactivo');
    if ($objauto1->darbajaAutoOrden()) 
    {
      echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se elimino la nota de la agenda con exito ','success'); </script>";   
    }
    else
    {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No elimino la nota de la agenda ','warning'); </script>";
    }
}

 ?>