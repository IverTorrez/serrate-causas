<?php
if(isset($_POST['btnaceptargastos']))
{
     $obdesc=new DescargaProcurador();
     $lst=$obdesc->mostrardescargaorden($_POST['idorden']);
     $fl=mysqli_fetch_object($lst);
     $saldodescarga=$fl->saldo;

    $obcaj=new Cajasdesalida();
    $lss=$obcaj->mostrarcajadelcontador();
    $fll=mysqli_fetch_object($lss);
    $saldocontador=$fll->cajacontador;

    $futurosaldocontador=$saldocontador+($saldodescarga); 
    if ($futurosaldocontador>=0) {
       
   
	 ini_set('date.timezone','America/La_Paz');
     $fechoyal=date("Y-m-d");
     $horita=date("H:i");
     $concat=$fechoyal.' '.$horita;
     
     $objconfir=new Confirmacion();
     $objconfir->setid_confirmacion($_POST['idconfir']);
     $objconfir->setconfircontador(1);
     $objconfir->setfechaconfircontador($concat);
     if ($objconfir->pronunciamientocontador()) {

     	 $orden1=new OrdenGeneral();
	     $orden1->setid_orden($_POST['idorden']);
         $codor=$_POST['idorden'];
         $mascara=$codor*1020304050;
         $encript=base64_encode($mascara); 
	     $orden1->setestadoorden('PronuncioContador');

	     if($orden1->cambiarestadodeorden()){


                $obpre=new Presupuesto();
                $obpre->setestadopresupuesto('Gastadoconfir');
                $obpre->setid_orden($_POST['idorden']);
                $obpre->cambiarelestadodepresupuesto();

                $objcotizacion=new Cotizacion();
                $lista=$objcotizacion->mostrarcotizaciondeorden($_POST['idorden']);
                $filcot=mysqli_fetch_object($lista);
                $compraprocu=$filcot->compra;
                $ventaprocu=$filcot->venta;
                $penalidad=$filcot->penalizacion;

/////////////FUNCION QUE MUESTRA LO QUE NOS COSTO PROCESAL (LO QUE NOSOTROS GASTAMOS)
                $objdesc=new DescargaProcurador();
                $listad=$objdesc->mostrarcomprajudicialdeorden($_POST['idorden']);
                $fild=mysqli_fetch_object($listad);
                $compjudicial=$fild->comprajudicial;

                $egresototal=$compjudicial+$ventaprocu;

                $gananciaprocuradoria=$ventaprocu-$compraprocu;

                

            $obconf=new Confirmacion();
            $list=$obconf->mostrarlaconfirmaciondelsistemayabogado($_POST['idconfir']);
            $filac=mysqli_fetch_object($list);
            ////////////////DESDE AQUI SE ASIGNA VALORES A COSTOS FINALES////////////
/////////////////verifica que las dos confirmaciones sean 1 , caso contrario se asignan otros valores 
            if ($filac->confir_sistema==1 and $filac->confir_abogado==1) {
                
                             
                $objcostofin=new Costofinal();
                $objcostofin->setcosto_procuradoria_compra($compraprocu);
                $objcostofin->setcosto_procuradoria_venta($ventaprocu);
                $objcostofin->setcosto_prosesal_venta($compjudicial);
                $objcostofin->settotal_egreso($egresototal);
                $objcostofin->setid_orden($_POST['idorden']);
                $objcostofin->setpenalidadcostofinal(0);
                $objcostofin->setmalgasto(0);
                $objcostofin->setvalidadofinal('No');
                $objcostofin->setcanceladoprocurador('No');
                $objcostofin->setgananciaprocuradoria($gananciaprocuradoria);
                $objcostofin->setgananciaprocesal(0);

                $objcostofin->guardarcostofinal();

                $objo=new OrdenGeneral();
                $lis=$objo->mostraridcausadeunaorden($_POST['idorden']);
                $filc=mysqli_fetch_object($lis);
                $idcausa=$filc->id_causa;

                $objor=new OrdenGeneral();
                $objor->setid_orden($_POST['idorden']);
                $objor->setcalificacion('Suficiente');
                $objor->setfechacierre($concat);
                $objor->ultinacalificacion();

                $obca=new Causa();
                $li=$obca->mostrarcajacausa($idcausa);
                $filca=mysqli_fetch_object($li);
                $saldocaja=$filca->caja;

                $nuevosaldo=$saldocaja-$egresototal;

                $objcausa=new Causa();
                $objcausa->setid_causa($idcausa);
                $objcausa->setcajacausa($nuevosaldo);
                $objcausa->modificarcajadecausa();

                $objdes=new DescargaProcurador();
                $objdes->setid_orden($_POST['idorden']);
                $objdes->setvalidado('Si');
                $objdes->validardescarga();
////////CODIGO PARA ACTUALIZAR LA CAJA DEL CONTADOR//////////////////////////
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
/////////////////////////////////////////////////////////////////////////////////////////////

                $objca=new Cajasdesalida();
                $listaca=$objca->mostrarganacias();
                $fic=mysqli_fetch_object($listaca);
                $saldoganancia=$fic->gananciasprocesalyproc;
                $nuevosaldoganacia=$saldoganancia+$gananciaprocuradoria;

                $objcaja=new Cajasdesalida();
                $objcaja->setid_cajasalida(1);

                $objcaja->setgananciaspp($nuevosaldoganacia);

                if ($objcaja->modificarganancias()) {
                   echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE',' Se registro el pronunciamiento del contador','success'); </script>";
                }
                else{
                    echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No se registro el pronunciamiento del contador','warning'); </script>";
                }
              

                
            }
////////////CUNADO UNA ORDEN ES INSUFICIENTE, se asignan las penalidades//////////
            else{

                $objcostofin=new Costofinal();
                $objcostofin->setcosto_procuradoria_compra(0);
                $objcostofin->setcosto_procuradoria_venta(0);
                $objcostofin->setcosto_prosesal_venta($compjudicial);
                $objcostofin->settotal_egreso($compjudicial);
                $objcostofin->setid_orden($_POST['idorden']);
                $objcostofin->setpenalidadcostofinal($penalidad);////////////SE ANOTA LA PENALIDAD PARA EL PROCURADOR
                $objcostofin->setmalgasto(0);///LO QUE SE GASTO EN LA ORDEN (JUDICIAL), GASTO MAL HECHO, dato sin valor
                $objcostofin->setvalidadofinal('No');
                $objcostofin->setcanceladoprocurador('No');
                $objcostofin->setgananciaprocuradoria(0);
                $objcostofin->setgananciaprocesal(0);

                $objcostofin->guardarcostofinal();
////////////////SE MODIFICA LA CAJA DE LA CAUSA ///////////////////////////////////////////
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
////////////////////SE CALIFICA LA ORDEN COMO INSUFICIENTE
                $objor=new OrdenGeneral();
                $objor->setid_orden($_POST['idorden']);
                $objor->setcalificacion('Insuficiente');
                $objor->setfechacierre($concat);
                $objor->ultinacalificacion();

                //////////////SE CONFIRMA LA DESCARGA POR EL CONTADOR///////////
                $objdes=new DescargaProcurador();
                $objdes->setid_orden($_POST['idorden']);
                $objdes->setvalidado('Si');
                $objdes->validardescarga();
//////////////////////////////////////HASTA AQUI/////////////////////////////////// 
     ////////CODIGO PARA ACTUALIZAR LA CAJA DEL CONTADOR//////////////////////////
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

                
/////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////MODIFICAR EL SALDO DE GANANCIAS//////////////////////
          //////POR EL MOMENTO EL DINERO MAL GASTADO NO AFECTARA LAS GANACIAS, SOLO SE REGISTRA EL DATO COMO MAL GASTADO PARA QUE NO AFECTE AL HACER CUADRAR LA CAJA ADM////////////////
                /*$objca=new Cajasdesalida();
                $listaca=$objca->mostrarganacias();
                $fic=mysqli_fetch_object($listaca);
                $saldoganancia=$fic->gananciasprocesalyproc;
                $nuevosaldoganacia=$saldoganancia-$compjudicial;///SE RESTA A LA CAJA DE GANANCIAS, EL GASTO MAL HECHO

                $objcaja=new Cajasdesalida();
                $objcaja->setid_cajasalida(1);

                $objcaja->setgananciaspp($nuevosaldoganacia);
                $objcaja->modificarganancias();*/

                if ($obcajac->modificarcajacontador()) {
                   echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se registro el pronunciamiento del contador','success'); </script>";
                }
                else{
                    echo "<script > setTimeout(function(){ }, 2000); swal('ERROR',' No se registro el pronunciamiento del contador','warning'); </script>";
                }




            }
    //////////////////////////////////////HASTA AQUI///////////////////////////////////        		                  
     	
     }

     else{
		 echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se registro el pronunciamiento','warning'); </script>";
     }
 }


  }
  else{ echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Hay suficiente saldo en caja del Contador para devolve','warning'); </script>";}


}
?>