<?php
$senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
$senior = iconv('UTF-8', 'windows-1252', $senior);
////SACAMOS LOS NUMEROS CON LOS QUE FUERON COTIZADO LA ORDEN

/*$objcotizacion=new Cotizacion();
$lista=$objcotizacion->mostrarcotizaciondeorden($_POST['idorden']);
$filcot=mysqli_fetch_object($lista);
$compraprocu=$filcot->compra;
$ventaprocu=$filcot->venta;
$penalidad=$filcot->penalizacion;*/

///FUNCION QUE MUESTRA LO QUE NOS COSTO PROCESAL (LO QUE NOSOTROS GASTAMOS)

/*$objdesc=new DescargaProcurador();
$listad=$objdesc->mostrarcomprajudicialdeorden($_POST['idorden']);
$fild=mysqli_fetch_object($listad);
$compjudicial=$fild->comprajudicial;

$egresototal=$compjudicial+$ventaprocu;

$gananciaprocuradoria=$ventaprocu-$compraprocu;*/


/*SI OPRIME EL BOTON ACEPTAR*/
if (isset($_POST['btnaceptardescarga'])) 
{
   $objconfir22=new OrdenGeneral();
   $resulconfir=$objconfir22->mustraestadodeunaordenidabogado($_POST['idorden']);
   $filconf=mysqli_fetch_object($resulconfir);
   /*SE COMPRUEBA QUE AUN NO SE AYGA PRONUNCIADO EL ABOGADO*/
   if ($filconf->fechaconfabogado=='') 
   {
     
   ////SACAMOS LOS NUMEROS CON LOS QUE FUERON COTIZADO LA ORDEN
              $objcotizacion=new Cotizacion();
              $lista=$objcotizacion->mostrarcotizaciondeorden($_POST['idorden']);
              $filcot=mysqli_fetch_object($lista);
              $compraprocu=$filcot->compra;
              $ventaprocu=$filcot->venta;
              $penalidad=$filcot->penalizacion;

              ///FUNCION QUE MUESTRA LO QUE NOS COSTO PROCESAL (LO QUE NOSOTROS GASTAMOS)
              $objdesc=new DescargaProcurador();
              $listad=$objdesc->mostrarcomprajudicialdeorden($_POST['idorden']);
              $fild=mysqli_fetch_object($listad);
              $compjudicial=$fild->comprajudicial;

              $egresototal=$compjudicial+$ventaprocu;

              $gananciaprocuradoria=$ventaprocu-$compraprocu;



            ini_set('date.timezone','America/La_Paz');
             $fechoyal=date("Y-m-d");
             $horita=date("H:i");
             $concat=$fechoyal.' '.$horita;
/*PRIMERO PREGUNTAMOS SI LA FECHA DE CONFIRMACION DEL CONTADOR ESTA VACIA, DE SER ASI SOLO SE HACE EL PRONUNCIAMIENTO DEL ABOGADO*/
         $objconfir1=new Confirmacion();
         $resultado1=$objconfir1->mostrarfechaconfircontador($_POST['idorden']);
         $filaconf1=mysqli_fetch_object($resultado1);
         if ($filaconf1->fecha_confir_contador=='') 
         {  /*CAMBIA EL ESTADO DE LA ORDEN */
            $orden2=new OrdenGeneral();
            $orden2->setid_orden($_POST['idorden']);          
            $orden2->setestadoorden('PronuncioAbogado');
            $orden2->cambiarestadodeorden();
            /*FUNCION PRONUNCIAMIENTO DEL ABOGADO*/

            $objconfir=new Confirmacion();
            $objconfir->setid_confirmacion($_POST['idconfir']);
            $objconfir->setconfirabogado(1);
            $objconfir->setfechaconfirabogado($concat);

           
            if ( $objconfir->pronunciamientoabogado()) {
               echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Acepto La Descarga De la Orden','success'); </script>";
            }
            else
            {
              echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se Acepto la Descarga de la Orden','warning'); </script>";
            }
         }/*FIN DEL IF (PREGUNTA POR LA FECHA DEL CONFIRMACION DEL CONTADOR)*/
          
        /*POR FALSO (ES DECIR SI LA FECHA DEL PRONUNCIAMIENTO DEL CONTADOR ESTA LLENA(OSEA YA SE PRONUNCIO, SE SERRARA LA ORDEN))*/
           else
           {
            /*FUNCION PRONUNCIAMIENTO DEL ABOGADO*/
            $objconfir=new Confirmacion();
            $objconfir->setid_confirmacion($_POST['idconfir']);
            $objconfir->setconfirabogado(1);
            $objconfir->setfechaconfirabogado($concat);
            $objconfir->pronunciamientoabogado();

            //FUNCION QUE CAMBIA EL ESTADO DEL PRESUPUESTO, OJO POR EL MOMENTO ESTA CUANDO SE TIENE QUE SERRAR LA ORDEN 
            /*(TODAVIA NO SE SI ES NECESARIO QUE ESTE AQUI (YA QUE NORMALMENTE EL GASTO CONFIRMA EL CONTADOR))*/
            $obpre=new Presupuesto();
            $obpre->setestadopresupuesto('Gastadoconfir');
            $obpre->setid_orden($_POST['idorden']);
            $obpre->cambiarelestadodepresupuesto();

            /*FUNCION QUE CAMBIA ES ESTADO DE LA ORDEN A SERRADA*/
            $orden1=new OrdenGeneral();
            $orden1->setid_orden($_POST['idorden']); 
            $orden1->setestadoorden('Serrada');
            $orden1->cambiarestadodeorden();
            /*FUNCION QUE MUESTRA LAS CONFIRMACIONES DEL SISTEMA Y DEL ABOGADO, ESTO PARA ASIGNAR LOS VALORES CORRESPONDIETE*/
            $obconf=new Confirmacion();
            $list=$obconf->mostrarlaconfirmaciondelsistemayabogado($_POST['idconfir']);
            $filaco=mysqli_fetch_object($list);
             /*DESDE AQUI SE ASIGNA VALORES A COSTOS FINALES*/
            /*verifica que las dos confirmaciones sean 1 , caso contrario se asignan otros valores*/
  /*IF PARA PREGUNTAR SI LAS CONFIRMACIONES SISTEMA Y ABOGADO SON 1 Y 1, POR VERDAD ASIGNARA VALORES POSITIVOS(SI ES SUFICIENTE)  */
               if ($filaco->confir_sistema==1 and $filaco->confir_abogado==1)
               {
                $objcostofin=new Costofinal();
                $objcostofin->setcosto_procuradoria_compra($compraprocu);
                $objcostofin->setcosto_procuradoria_venta($ventaprocu);
                $objcostofin->setcosto_prosesal_venta($compjudicial);

                 $objcostofin->setCostoprocesalCompra($compjudicial);

                $objcostofin->settotal_egreso($egresototal);
                $objcostofin->setid_orden($_POST['idorden']);
                $objcostofin->setpenalidadcostofinal(0);
                $objcostofin->setmalgasto(0);
                $objcostofin->setvalidadofinal('No');
                $objcostofin->setcanceladoprocurador('No');
                $objcostofin->setgananciaprocuradoria($gananciaprocuradoria);
                $objcostofin->setgananciaprocesal(0);

                $objcostofin->guardarcostofinal();

                /*MUESTRA EL ID CAUSA A PARTIR DE ID ORDEN*/
                $objo=new OrdenGeneral();
                $lis=$objo->mostraridcausadeunaorden($_POST['idorden']);
                $filc=mysqli_fetch_object($lis);
                $idcausa=$filc->id_causa;

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

                /*CALIFICACION DE LA ORDEN COMO SUFICIENTE*/
                $objor=new OrdenGeneral();
                $objor->setid_orden($_POST['idorden']);
                $objor->setcalificacion('Suficiente');
                $objor->setfechacierre($concat);
                $objor->ultinacalificacion();
                
                /////EL CONTADOR VALIDA LA DESCARGA  (TODAVIA NO ESTA SEGUTO, YA QUE EL CONTADOR VALIDA LA DESCARGA)///
                $objdes=new DescargaProcurador();
                $objdes->setid_orden($_POST['idorden']);
                $objdes->setvalidado('Si');
                $objdes->validardescarga();
               
               /*(MODIFICADORES DE GANANCIAS) FUNCIONES QUE NO  ESTAN MUY SEGURAS, YA QUE LAS GANANCIAS SON CONSULTAS*/
                $objca=new Cajasdesalida();
                $listaca=$objca->mostrarganacias();
                $fic=mysqli_fetch_object($listaca);
                $saldoganancia=$fic->gananciasprocesalyproc;
                $nuevosaldoganacia=$saldoganancia+$gananciaprocuradoria;

                $objcaja=new Cajasdesalida();
                $objcaja->setid_cajasalida(1);
                $objcaja->setgananciaspp($nuevosaldoganacia);
                
                if ($objcaja->modificarganancias()) 
                  {
/*------COMO YA SE SERRO LA ORDEN, SE VERIFICARA EL SALDO DE LA CAUSA PARA ENVIAR EN CORREO AL ADMINISTRADOR*/
                          $objcausa=new Causa();
                          $resulcausa=$objcausa->mostrarcodcausadeorden($_POST['idorden']);
                          $filcausa=mysqli_fetch_object($resulcausa);
                          $codigocausa=$filcausa->codigo;
                          $idcausa1=$filcausa->idcausa;

                          /*MUESTRA LA CAJA(SALDO DE LA CAUSA)*/
                          $objcajacausa=new Causa();
                          $resulcajac=$objcajacausa->mostrarcajacausa($idcausa1);
                          $filcajac=mysqli_fetch_object($resulcajac);
                          $cajacausa=$filcajac->caja;
                          /*$destino="info@serrate.bo";
                          $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                        'Reply-To: info@serrate.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();*/
                          if ($cajacausa>=0 and $cajacausa<=200) 
                          {
                            /*$asunto="Alerta De Cobranza";
                            $mensajedecorreo="$senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo de $cajacausa Bs. Le recordamos que haga sus gestiones de cobranza";
                            mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
                            enviarCorreoSaldoEntre0y300($cajacausa);
                          }
                          if ($cajacausa<0) 
                          {
                            /*$asunto="Alerta De Cobranza (Urgente)";
                            $mensajedecorreo="URGENTE $senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo en contra de $cajacausa Bs. Se recomienda congelar el proceso inmediatamente y hacer sus gestiones de cobranza ";
                            mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
                            enviarCorreoSaldoMenorA_Cero($cajacausa);
                          }
/*---------------------FIN DEL ENVIO DE CORREO-----------------------------------------------------------*/
                      echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Acepto La Descarga De la Orden','success'); </script>";
                  }
                  else
                  {
                    echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se Acepto la Descarga de la Orden','warning'); </script>";
                  }


               }/*fin del if que pregunta sobre las confirmaciones del sistema y abogado (OSEA SI ES SUFICIENTE)*/
                    /* ELSE CUANDO LA ORDEN ES INSUFICIENTE, APLICA VALORES NEGATIVOS Y PENALIDAD*/
                    else
                    { $objcostofin=new Costofinal();
                      $objcostofin->setcosto_procuradoria_compra(0);
                      $objcostofin->setcosto_procuradoria_venta(0);
                      $objcostofin->setcosto_prosesal_venta($compjudicial);

                      $objcostofin->setCostoprocesalCompra($compjudicial);

                      $objcostofin->settotal_egreso($compjudicial);
                      $objcostofin->setid_orden($_POST['idorden']);
                      $objcostofin->setpenalidadcostofinal($penalidad);////////////SE ANOTA LA PENALIDAD PARA EL PROCURADOR
                      $objcostofin->setmalgasto(0);///LO QUE SE GASTO EN LA ORDEN (JUDICIAL), GASTO MAL HECHO, dato sin valor
                      $objcostofin->setvalidadofinal('No');
                      $objcostofin->setcanceladoprocurador('No');
                      $objcostofin->setgananciaprocuradoria(0);
                      $objcostofin->setgananciaprocesal(0);

                      $objcostofin->guardarcostofinal();

                      /////SE MODIFICA LA CAJA DE LA CAUSA ////////////
                      $objo=new OrdenGeneral();
                      $lis=$objo->mostraridcausadeunaorden($_POST['idorden']);
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

                      /////SE CALIFICA LA ORDEN COMO INSUFICIENTE//
                      $objor=new OrdenGeneral();
                      $objor->setid_orden($_POST['idorden']);
                      $objor->setcalificacion('Insuficiente');
                      $objor->setfechacierre($concat);
                      $objor->ultinacalificacion();

                      ///SE CONFIRMA LA DESCARGA POR EL CONTADOR  (NO MUY SEGURA , YA QUE EL QUE CONFIRMA ES EL CONTADOR)////
                      $objdes=new DescargaProcurador();
                      $objdes->setid_orden($_POST['idorden']);
                      $objdes->setvalidado('Si');
                       
                       if ($objdes->validardescarga())
                        {
/*------COMO YA SE SERRO LA ORDEN, SE VERIFICARA EL SALDO DE LA CAUSA PARA ENVIAR EN CORREO AL ADMINISTRADOR*/
                          $objcausa=new Causa();
                          $resulcausa=$objcausa->mostrarcodcausadeorden($_POST['idorden']);
                          $filcausa=mysqli_fetch_object($resulcausa);
                          $codigocausa=$filcausa->codigo;
                          $idcausa1=$filcausa->idcausa;

                          /*MUESTRA LA CAJA(SALDO DE LA CAUSA)*/
                          $objcajacausa=new Causa();
                          $resulcajac=$objcajacausa->mostrarcajacausa($idcausa1);
                          $filcajac=mysqli_fetch_object($resulcajac);
                          $cajacausa=$filcajac->caja;
                         /* $destino="info@serrate.bo";
                          $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                        'Reply-To: info@serrate.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();*/
                          if ($cajacausa>=0 and $cajacausa<=300) 
                          {
                            /*$asunto="Alerta De Cobranza";
                            $mensajedecorreo="$senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo de $cajacausa Bs. Le recordamos que haga sus gestiones de cobranza";
                            mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
                            enviarCorreoSaldoEntre0y300($cajacausa);
                          }
                          if ($cajacausa<0) 
                          {
                            /*$asunto="Alerta De Cobranza (Urgente)";
                            $mensajedecorreo="URGENTE $senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo en contra de $cajacausa Bs. Se recomienda congelar el proceso inmediatamente y hacer sus gestiones de cobranza ";
                            mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
                            enviarCorreoSaldoMenorA_Cero($cajacausa);
                          }
/*---------------------FIN DEL ENVIO DE CORREO-----------------------------------------------------------*/
                      echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Acepto La Descarga De la Orden','success'); </script>";
                        }
                       else
                       {
                      echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se Acepto la Descarga de la Orden','warning'); </script>";
                       }


                    }/*FIN DEL ELSE QUE HACE LAS FUNCIONES CUANDO UNA ORDEN ES INSUFICIENTE*/

           }/*FIN DEL ELSE (PARA SERRAR LA ORDEN)*/
  }/*FIN DEL IF QUE VERIFICA QUE ELABOGADO NO SE AYGA PRONUNCIADO TODAVIA*/
  /*else que se ejecuta al ver que ya se pronuncio el abogado*/
  else
  {
    echo "<script > setTimeout(function(){ }, 2000); swal('ATENCION','El abogado ya hizo el pronunciamiento a la descarga','warning'); </script>";
  }
  
}/*FIN DEL BOTON ACEPTAR*/

/*SI OPRIME EL BOTON RECHAZAR*/
if (isset($_POST['btnrechazardescarga'])) 
{
    $objconfir22=new OrdenGeneral();
   $resulconfir=$objconfir22->mustraestadodeunaordenidabogado($_POST['idorden']);
   $filconf=mysqli_fetch_object($resulconfir);
   /*SE COMPRUEBA QUE AUN NO SE AYGA PRONUNCIADO EL ABOGADO*/
   if ($filconf->fechaconfabogado=='') 
   {

            ////SACAMOS LOS NUMEROS CON LOS QUE FUERON COTIZADO LA ORDEN
          $objcotizacion=new Cotizacion();
          $lista=$objcotizacion->mostrarcotizaciondeorden($_POST['idorden']);
          $filcot=mysqli_fetch_object($lista);
          $compraprocu=$filcot->compra;
          $ventaprocu=$filcot->venta;
          $penalidad=$filcot->penalizacion;

          ///FUNCION QUE MUESTRA LO QUE NOS COSTO PROCESAL (LO QUE NOSOTROS GASTAMOS)
          $objdesc=new DescargaProcurador();
          $listad=$objdesc->mostrarcomprajudicialdeorden($_POST['idorden']);
          $fild=mysqli_fetch_object($listad);
          $compjudicial=$fild->comprajudicial;

          $egresototal=$compjudicial+$ventaprocu;

          $gananciaprocuradoria=$ventaprocu-$compraprocu;

     ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;

  /*PRIMERO PREGUNTAMOS SI LA FECHA DE CONFIRMACION DEL CONTADOR ESTA VACIA, DE SER ASI SOLO SE HACE EL PRONUNCIAMIENTO DEL ABOGADO*/
    $objconfir1=new Confirmacion();
    $resultado1=$objconfir1->mostrarfechaconfircontador($_POST['idorden']);
    $filaconf1=mysqli_fetch_object($resultado1);
    if ($filaconf1->fecha_confir_contador=='') 
    {  /*CAMBIA EL ESTADO DE LA ORDEN*/
       $orden2=new OrdenGeneral();
       $orden2->setid_orden($_POST['idorden']);          
       $orden2->setestadoorden('PronuncioAbogado');
       $orden2->cambiarestadodeorden();
    /*FUNCION PRONUNCIAMIENTO DEL ABOGADO CON JUSTIFICACION DE RECHAZO*/
       $objconfir=new Confirmacion();
       $objconfir->setid_confirmacion($_POST['idconfir']);
       $objconfir->setconfirabogado(0);
       $objconfir->setfechaconfirabogado($concat);
       $objconfir->setjustificacionabog($_POST['textarearechazo']);
       

       if ($objconfir->pronunciamientoabogadorechazo()) 
       {
         echo "<script > setTimeout(function(){ }, 2000); swal('EXELENTE','Se Rechazo La Descarga De la Orden','success'); </script>";
       }
       else
       {
         echo "<script > setTimeout(function(){ }, 2000); swal('ERROR','No se Rechazo la Descarga de la Orden','warning'); </script>";
       }
    }/*FIN DEL IF (PREGUNTA POR LA FECHA DEL CONFIRMACION DEL CONTADOR)*/

        /*POR FALSO, SI ESQUE YA SE PRONUNCIO EL CONTADOR, OSEA LA ORDEN ESTA PARA SERRARSE*/
        /*SE APLICA VALORES NEGATIVOS Y PENALIZACION*/
        else
        {
            /*FUNCION QUE CAMBIA ES ESTADO DE LA ORDEN A SERRADA*/
            $orden1=new OrdenGeneral();
            $orden1->setid_orden($_POST['idorden']); 
            $orden1->setestadoorden('Serrada');
            $orden1->cambiarestadodeorden();
            /*EL RECHAZO CON JUSTIFICACION*/
            $objconfir=new Confirmacion();
            $objconfir->setid_confirmacion($_POST['idconfir']);
            $objconfir->setconfirabogado(0);
            $objconfir->setfechaconfirabogado($concat);
            $objconfir->setjustificacionabog($_POST['textarearechazo']);
            $objconfir->pronunciamientoabogadorechazo();

            $objcostofin=new Costofinal();
            $objcostofin->setcosto_procuradoria_compra(0);
            $objcostofin->setcosto_procuradoria_venta(0);
            $objcostofin->setcosto_prosesal_venta($compjudicial);

            $objcostofin->setCostoprocesalCompra($compjudicial);
            
            $objcostofin->settotal_egreso($compjudicial);
            $objcostofin->setid_orden($_POST['idorden']);
            $objcostofin->setpenalidadcostofinal($penalidad);////////////SE ANOTA LA PENALIDAD PARA EL PROCURADOR
            $objcostofin->setmalgasto(0);///LO QUE SE GASTO EN LA ORDEN (JUDICIAL), GASTO MAL HECHO, dato sin valor
            $objcostofin->setvalidadofinal('No');
            $objcostofin->setcanceladoprocurador('No');
            $objcostofin->setgananciaprocuradoria(0);
            $objcostofin->setgananciaprocesal(0);

            $objcostofin->guardarcostofinal();

            /////SE MODIFICA LA CAJA DE LA CAUSA ////////////
            $objo=new OrdenGeneral();
            $lis=$objo->mostraridcausadeunaorden($_POST['idorden']);
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

            /////SE CALIFICA LA ORDEN COMO INSUFICIENTE//
            $objor=new OrdenGeneral();
            $objor->setid_orden($_POST['idorden']);
            $objor->setcalificacion('Insuficiente');
            $objor->setfechacierre($concat);
            $objor->ultinacalificacion();

             ///SE CONFIRMA LA DESCARGA POR EL CONTADOR  (NO MUY SEGURA , YA QUE EL QUE CONFIRMA ES EL CONTADOR)////
            $objdes=new DescargaProcurador();
            $objdes->setid_orden($_POST['idorden']);
            $objdes->setvalidado('Si');
            

            if ($objdes->validardescarga()) 
             {
/*------COMO YA SE SERRO LA ORDEN, SE VERIFICARA EL SALDO DE LA CAUSA PARA ENVIAR EN CORREO AL ADMINISTRADOR*/
                          $objcausa=new Causa();
                          $resulcausa=$objcausa->mostrarcodcausadeorden($_POST['idorden']);
                          $filcausa=mysqli_fetch_object($resulcausa);
                          $codigocausa=$filcausa->codigo;
                          $idcausa1=$filcausa->idcausa;

                          /*MUESTRA LA CAJA(SALDO DE LA CAUSA)*/
                          $objcajacausa=new Causa();
                          $resulcajac=$objcajacausa->mostrarcajacausa($idcausa1);
                          $filcajac=mysqli_fetch_object($resulcajac);
                          $cajacausa=$filcajac->caja;
                          /*$destino="info@serrate.bo";
                          $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                        'Reply-To: info@serrate.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();*/
                          if ($cajacausa>=0 and $cajacausa<=300) 
                          {
                            /*$asunto="Alerta De Cobranza";
                            $mensajedecorreo="$senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo de $cajacausa Bs. Le recordamos que haga sus gestiones de cobranza";
                            mail($destino,$asunto,$mensajedecorreo,$cabeceras);*/
                            enviarCorreoSaldoEntre0y300($cajacausa);
                          }
                          if ($cajacausa<0) 
                          {
                            /*$asunto="Alerta De Cobranza (Urgente)";
                            $mensajedecorreo="URGENTE $senior Administrador: \n";
                            $mensajedecorreo.="El proceso $codigocausa tiene un saldo en contra de $cajacausa Bs. Se recomienda congelar el proceso inmediatamente y hacer sus gestiones de cobranza ";*/
                            //mail($destino,$asunto,$mensajedecorreo,$cabeceras);
                            enviarCorreoSaldoMenorA_Cero($saldocausa);
                          }
/*---------------------FIN DEL ENVIO DE CORREO-----------------------------------------------------------*/
              echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Rechazo La Descarga De la Orden','success'); </script>";
             }
             else
             {
               echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No se registro el pronunciamiento','warning'); </script>";
             }



        }/*FIN DELELSE*/

   }/*FIN DEL IF QUE PREGUNTA SI EL ABOGADO AUN NO SE PRONUNCIO*/
   else
   {
    echo "<script > setTimeout(function(){ }, 2000); swal('ATENCION','El abogado ya hizo el pronunciamiento a la descarga','warning'); </script>";
   }
}/*FIN DEL IF, SI PRESIONA EL BOTON RECHAZAR*/



/*funcion para enviar correo cuando el saldo esta entre 0 y 300*/
function enviarCorreoSaldoEntre0y300($saldocausa)
{
  /*Se obtiene los datos de la planilla con codigo 13*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(13);
  $filplanilla=mysqli_fetch_object($resulplanilla);
  $envia_notif           =$filplanilla->envia_notif;
  $emisor                =$filplanilla->emisor;
  $tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
  $receptor_estatico     =$filplanilla->receptor_estatico;
  $asunto                =$filplanilla->asunto;
  $texto                 =$filplanilla->texto;
  $nombre_emisor         =$filplanilla->nombre_emisor;


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
               $objuser=new Usuario();
               $resultuser=$objuser->MostrarUserAdmin();
               $filuser=mysqli_fetch_object($resultuser);
               $correoEmisor=$filuser->correousuario;
      }
            $objcausa=new Causa();
            $resulcausa=$objcausa->mostrarcodcausadeorden($_POST['idorden']);
            $filcausa=mysqli_fetch_object($resulcausa);
            $codigocausa=$filcausa->codigo;
            $idcausa1=$filcausa->idcausa;
      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                        // "Cc:".$destinocont.""."\r\n" .  // esto sería copia normal
                        // "Bcc: tumail@dominio.com" . "\r\n" . // esto sería copia oculta
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {
      
            $asuntoproc=$asunto;
           
            //Reemplazamos las variables en el texto
          $search = array('[codigocausa]',
                          '[saldocausa]');
            $replace = array('<b>'.$codigocausa.'</b>',
                             '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
          //Correo para el destino
         //mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
         //Correo para el contador
        // mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         //echo 1;
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico; 
           $asuntoproc=$asunto;
 
          //Reemplazamos las variables en el texto
             $search = array('[codigocausa]',
                          '[saldocausa]');
            $replace = array('<b>'.$codigocausa.'</b>',
                             '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
            //Correo para el destino  
          mail($receptor,$asuntoproc,$textomodificado,$cabeceras);
          
         }
  }//fin cuando pregunta si envia notificacion
}//fin de funcion de enviar correo


/*funcion para enviar correo cuando el saldo esta entre 0 y 300*/
function enviarCorreoSaldoMenorA_Cero($saldocausa)
{
  /*Se obtiene los datos de la planilla con codigo 14*/
  $objplanilla= new Planillas_envio_notificacion();
  $resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(14);
  $filplanilla=mysqli_fetch_object($resulplanilla);
  $envia_notif           =$filplanilla->envia_notif;
  $emisor                =$filplanilla->emisor;
  $tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
  $receptor_estatico     =$filplanilla->receptor_estatico;
  $asunto                =$filplanilla->asunto;
  $texto                 =$filplanilla->texto;
  $nombre_emisor         =$filplanilla->nombre_emisor;
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
               $objuser=new Usuario();
               $resultuser=$objuser->MostrarUserAdmin();
               $filuser=mysqli_fetch_object($resultuser);
               $correoEmisor=$filuser->correousuario;
      }
            $objcausa=new Causa();
            $resulcausa=$objcausa->mostrarcodcausadeorden($_POST['idorden']);
            $filcausa=mysqli_fetch_object($resulcausa);
            $codigocausa=$filcausa->codigo;
            $idcausa1=$filcausa->idcausa;
      /*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                        // "Cc:".$destinocont.""."\r\n" .  // esto sería copia normal
                        // "Bcc: tumail@dominio.com" . "\r\n" . // esto sería copia oculta
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";
      if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
        {
      
            $asuntoproc=$asunto;
           
            //Reemplazamos las variables en el texto
          $search = array('[codigocausa]',
                          '[saldocausa]');
            $replace = array('<b>'.$codigocausa.'</b>',
                             '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
          //Correo para el destino
         //mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
         //Correo para el contador
        // mail($destinocont,$asuntocont,$textomodificado,$cabeceras);
         //echo 1;
         
        }//fin del if que pregunta si el receptor es dinamico
        else//por falso cargamos el receptor estatico
         {
           $receptor=$receptor_estatico; 
           $asuntoproc=$asunto;
 
          //Reemplazamos las variables en el texto
             $search = array('[codigocausa]',
                          '[saldocausa]');
            $replace = array('<b>'.$codigocausa.'</b>',
                             '<b>'.$saldocausa.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);
            
            //Correo para el destino  
          mail($receptor,$asuntoproc,$textomodificado,$cabeceras);
          
         }
  }//fin cuando pregunta si envia notificacion
}//fin de funcion de enviar correo
?>