<?php
if(isset($_POST['btndescarga']))
{   $idorden1=$_POST['textidorden'];
    $mascara1=$idorden1*1020304050;
    $encriptado=base64_encode($mascara1);

    $objdes11=new DescargaProcurador();
    $resultdes=$objdes11->mostraridOrdenEnDescarga($_POST['textidorden']);
    $filidor=mysqli_fetch_object($resultdes);
    if ($filidor->id_orden=='') 
    {
        

    	ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         $gastocondecimal=$_POST['textgasto'].'.'.$_POST['textgastodecimal'];/*formamos el gasto con decimal*/

    	$objdescarga=new DescargaProcurador();
    	$objdescarga->setdetalleinformacion($_POST['textdescargainf']);
    	$objdescarga->setultimafoja($_POST['textfoja']);
    	$objdescarga->setdescargadocumentacion($_POST['textdescargadoc']);
    	$objdescarga->setgastos($gastocondecimal); 

        $objpresupuesto=new Presupuesto();
        $listado=$objpresupuesto->mostrarpresupuesto($_POST['textidorden']);

        $gasto=$gastocondecimal;

         $fil=mysqli_fetch_object($listado); 
         $saldo=$fil->monto_presupuesto-$gasto;

     
    	$objdescarga->setsaldo($saldo);
    	$objdescarga->setdetallegasto($_POST['textdetallegasto']);
    	$objdescarga->setfechadescarga($concat);
    	$objdescarga->setcomprajudicial($gastocondecimal);
    	$objdescarga->setid_orden($_POST['textidorden']);
        $objdescarga->setvalidado('No');
    	if($objdescarga->guardardescarga()){
            //CODIGO QUE CAMBIA EL ESTADO DE UNA ORDEN A DESCARGADA
            $objorden=new OrdenGeneral();
            $objorden->setid_orden($_POST['textidorden']);
            $objorden->setestadoorden('Descargada');
            $objorden->cambiarestadodeorden();
            ///////CODIGO PARA CAMBIAR EL ESTADO DEL PRESUPUESTO A GASTADO
            $objp=new Presupuesto();
            $objp->setid_orden($_POST['textidorden']);
            $objp->setestadopresupuesto('Gastado');
            $objp->cambiarelestadodepresupuesto();

    	 
    	 //CODIGO PARA INSERTAR LA CONFIRMACION DE DESCARGA(TABLA CONFIRMACION)
    	     $idorden=$_POST['textidorden'];
             $objdesc=new DescargaProcurador();
             $result=$objdesc->mostrarultimoiddescargadeorden($idorden);
             $fila=mysqli_fetch_object($result);

            $objord=new OrdenGeneral();
            $list=$objord->mostrarfechayhorafin($idorden);
            $filas=mysqli_fetch_object($list);
            $fechafinorden=$filas->Fechafin;
            $newfechfin=date_create($fechafinorden);
            $fechafinformato=date_format($newfechfin, 'Y-m-d H:i');

            $fechasistema1=new DateTime($concat);
            $fechafinalorden2=new DateTime($fechafinformato);
            if ($fechasistema1<=$fechafinalorden2) {
            	$valorconfir=1;
            }
            else{
            	$valorconfir=0;
            }
             
             $objconfir=new Confirmacion();
             $objconfir->setconfirsistema($valorconfir);
             $objconfir->setid_descarga($fila->ultiddesc);
             if ($objconfir->guardarconfirmacion()) 
             {
                

             	  if ($valorconfir==1) 
                  {
                    
             	  	echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 2000); swal('EXELENTE','Se Registro La Descarga Con Exito','success'); </script>";

                  
             	  }
             	  else{
                      
             	  	echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 2000); swal('ATENCION','Se Registro La Descarga Fuera Del Plazo De La Fecha Final','warning'); </script>";

                    
             	  }
           	   
             }


    	}
       else{
      	 echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Descargo La Ordeno','warning'); </script>";
       }

    }/*FIN DEL IF QUE PREGUNTA SI EL ID_ORDEN ESTA VACIA*/
    else
    {
     echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 3000); swal('ATENCION','No se registro la descarga porque la orden ya fue descargada','warning'); </script>";
    }

}/*FIN AL PRESIONAR BOTON*/



/////////MODIFICA EL GASTO DE UNA DESCARGA
if (isset($_POST['btnmodgasto'])) 
{
    /*MUESTRA LA FECHA DE CONFIRMACION DEL CONTADOR A PARTIR DE ID ORDEN , PARA VERIFICAR QUE NO SE AYGA PRONUNCIADO AUN EL CONTADOR*/
   $objconfir1=new Confirmacion();
   $resulfech=$objconfir1->mostrarfechaconfircontador($_POST['textidorden']);
   $filfec=mysqli_fetch_object($resulfech);
   if ($filfec->fecha_confir_contador=='')
    {  
        $gastnew=$_POST['textnuevogasto'].'.'.$_POST['textnuevogastodecimal'];/*formamos el gasto con decimal*/
        if ($gastnew>=0) 
        {
            modificarGastosDedescargaProc();
        }
        else
        {
            echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Puede Colocar Una Cantidad Menor A Cero','warning'); </script>";
        }
      
    } 
    else 
    {
      echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No se puede Modificar el gasto, porque el contador ya hizo la devolucion del saldo','warning'); </script>";
    }
   
}
    

    function modificarGastosDedescargaProc()
    {
        $objpresupuesto=new Presupuesto();
        $listado=$objpresupuesto->mostrarpresupuesto($_POST['textidorden']);
        $newgasto=$_POST['textnuevogasto'].'.'.$_POST['textnuevogastodecimal'];/*formamos el gasto con decimal*/
         $fil=mysqli_fetch_object($listado);
         $nuevosaldo=$fil->monto_presupuesto-$newgasto;

         $objdes=new DescargaProcurador();
         $objdes->setid_descarga($_POST['textiddescarga']);
         $objdes->setgastos($newgasto);
         $objdes->setcomprajudicial($newgasto);
         $objdes->setsaldo($nuevosaldo);

         $codor=$_POST['textidorden'];
         $mascara=$codor*10987654321;
         $encript=base64_encode($mascara);

         if ($objdes->modificargastosdedescarga()) 
         {
             echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encript' }, 2000); swal('EXELENTE','Modifico el gasto Con Exito','success'); </script>";
         }
         else
         {
            echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico el gasto ','warning'); </script>";
         }
     }/*FIN DE LA FUNCION MODIFICAR GASTO*/


?>