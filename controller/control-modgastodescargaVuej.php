<?php
error_reporting(E_ERROR);
include_once('../model/clsconfirmacion.php');
include_once('../model/clspresupuesto.php');
include_once('../model/clsdescarga_procurador.php');
/////////MODIFICA EL GASTO DE UNA DESCARGA

 $accion='modgasto';
$resultado->error ='false';

if ($_GET['accion']) 
{
	$accion=$_GET['accion'];
	switch ($accion) {
		case 'modgasto':

		/*MUESTRA LA FECHA DE CONFIRMACION DEL CONTADOR A PARTIR DE ID ORDEN , PARA VERIFICAR QUE NO SE AYGA PRONUNCIADO AUN EL CONTADOR*/
		   $objconfir1=new Confirmacion();
		   $resulfech=$objconfir1->mostrarfechaconfircontador($_POST['textidorden']);
		   $filfec=mysqli_fetch_object($resulfech);
		   if ($filfec->fecha_confir_contador=='')
		    {  
		        $gastnew=$_POST['textnuevogasto'].'.'.$_POST['textnuevogastodecimal'];/*formamos el gasto con decimal*/
		        if ($gastnew>=0) 
		        {
			           // modificarGastosDedescargaProc();
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
				         	$resultado->error ='true';
				            /* echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encript' }, 2000); swal('EXELENTE','Modifico el gasto Con Exito','success'); </script>";*/
				         }
				         else
				         {
				         	$resultado->error ='false';
				            /*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modifico el gasto ','warning'); </script>";*/
				         }
		        }/*FIN DEL IF QUE PREGUNTA SI EL NUEVO GASTO ES IGUAL O MAYOR A CERO*/
		        else
		        {
		        	$resultado->error ='negativo';
		            /*echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Puede Colocar Una Cantidad Menor A Cero','warning'); </script>";*/
		        }
		      
		    }/*FIN DEL IF QUE PREGUNTA SIL LA FECHA DE CONFIRMACION DEL CONTADOR ES VACIO*/ 
		    else 
		    {
		      $resultado->error ='entregado';

		      /*echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No se puede Modificar el gasto, porque el contador ya hizo la devolucion del saldo','warning'); </script>";*/
		    }
			
			break;
		
		default:
			# code...
			break;
	}/*FIN DEL SWITCH*/
    
   
}/*FIN DEL IF QUE OPTINE EL GET*/
    

 /*   function modificarGastosDedescargaProc()
    {
        $objpresupuesto=new Presupuesto();
        $listado=$objpresupuesto->mostrarpresupuesto($_POST['textidorden']);
        $newgasto=$_POST['textnuevogasto'].'.'.$_POST['textnuevogastodecimal'];/*formamos el gasto con decimal*/
 /*        $fil=mysqli_fetch_object($listado);
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
echo json_encode($resultado);
die();


?>
