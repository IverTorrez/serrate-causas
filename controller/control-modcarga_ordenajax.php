<?php
 error_reporting(E_ERROR);
include_once('../model/clsordengeneral.php');
include_once('../model/clspresupuesto.php');
$accion='crear';
$resultado->error =false;

if (isset($_GET['accion'])) {
	$accion=$_GET['accion'];
	switch ($accion) {
		case 'crear':

		    $objorden=new OrdenGeneral();
			$objorden->setid_orden($_POST['textidorden1']);
			$objorden->setinformacion($_POST['texteditorinformacion']);
			$objorden->setdocumentacion($_POST['texteditordocum']);
			$objorden->setinfosolotexto($_POST['infosolotexto']);
			$objorden->setdocsolotexto($_POST['docusolotexto']);

			if ($objorden->modificarInfoDocOrden()) 
			{
				$objpresu=new Presupuesto();
				$objpresu->setdetalle_presupuesto($_POST['texteditordetallepresu']);
				$objpresu->setdetallepresusolotexto($_POST['detallepresusolotexto']);
				$objpresu->setid_orden($_POST['textidorden1']);
				if ($objpresu->modificarDetallePresupuesto()) 
				{
					$resultado->error='true';

					/*$idorden=$_POST['textidorden1'];
					$mascara=$idorden*10987654321;
					$encriptado=base64_encode($mascara);
					echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success'); </script>";*/
				}
				else
				{
					$resultado->error='false';

					/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Al Parecer No Se Pudo Modificar El Detalle De Presupuesto ','warning'); </script>";*/
				}
				
			}
			else
			{
				$resultado->error='error1';

				/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning'); </script>";*/
			}

			
			break;
		
		default:
			# code...
			break;
	}/*FIN DEL SWITCH*/
}/*FIN DEL IF*/


echo json_encode($resultado);
die();



?>