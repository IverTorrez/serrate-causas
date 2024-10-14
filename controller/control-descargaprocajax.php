<?php
 error_reporting(E_ERROR);
 include_once('../model/clsdescarga_procurador.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsordengeneral.php');
include_once('../model/clsconfirmacion.php');

$accion='crear';
$resultado->error =false;
$resul=''; 

if(isset($_GET['accion']))
{   
	$accion=$_GET['accion'];

	switch ($accion) {
		case 'crear':   

		$idorden1=$_POST['textidorden'];
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

           if ($gastocondecimal>=0) 
           {
             
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

                $objdescarga->setdescargainforsolotexto($_POST['infosolotexto']);
                $objdescarga->setdescargadocumsolotexto($_POST['docusolotexto']);
                $objdescarga->setdescargadetgastosolotexto($_POST['detallegastosolotexto']);

            	$objdescarga->setfechadescarga($concat);
            	$objdescarga->setcomprajudicial($gastocondecimal);
            	$objdescarga->setid_orden($_POST['textidorden']);
                $objdescarga->setvalidado('No');
            	if($objdescarga->guardardescarga())
            	{
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

                          	$resultado->error='true';
                            
                     	  /*	echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 2000); swal('EXELENTE','Se Registro La Descarga Con Exito','success'); </script>";*/

                          
                     	  }
                     	  else
                     	  {
                     	  	$resultado->error='false';
                              
                     	  	/*echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 2000); swal('ATENCION','Se Registro La Descarga Fuera Del Plazo De La Fecha Final','warning'); </script>";*/

                            
                     	  }
                   	   
                     }


                }/*FIN DEL IF QUE PEGUNTA SI SE GUARDO LA DESCARGA*/
                else
                {
                   	 $resultado->error='error1';
                  	/* echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Descargo La Orden','warning'); </script>";*/
                }

            }/*FIN DEL IF QUE PREGUNTA SI EL GASTO ES MAYOR  O IGUAL A CERO*/
            else
            {
              $resultado->error='negativo';
              /*echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Puede Colocar Una Cantidad Menor A Cero','warning'); </script>";*/
            }




    }/*FIN DEL IF QUE PREGUNTA SI EL ID_ORDEN ESTA VACIA*/
    else
    {
    	$resultado->error='error2';
     /*echo "<script > setTimeout(function(){ location.href='orden.php?squart=$encriptado'; }, 3000); swal('ATENCION','No se registro la descarga porque la orden ya fue descargada','warning'); </script>";*/
    }


			
			break;
		
		default:
			# code...
			break;
	}/*FIN DE SWITCH*/




	

}/*FIN DEL IF */

echo json_encode($resultado);
die();
?>