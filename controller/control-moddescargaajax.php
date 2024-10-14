 <?php
  error_reporting(E_ERROR);
 include_once('../model/clsdescarga_procurador.php');
 $accion='crear';
$resultado->error =false;

if ($_GET['accion']) 
{
 	$accion=$_GET['accion'];
 	switch ($accion) {
 		case 'crear':

	 		$objdesc=new DescargaProcurador();
			$objdesc->setdetalleinformacion($_POST['textdescargainf']);
			$objdesc->setdescargadocumentacion($_POST['textdescargadoc']);
			$objdesc->setdetallegasto($_POST['textdetallegasto']);

			$objdesc->setdescargainforsolotexto($_POST['infodescsolotexto']);
			$objdesc->setdescargadocumsolotexto($_POST['docudescsolotexto']);
			$objdesc->setdescargadetgastosolotexto($_POST['detallegastdescsolotexto']);
			
			$objdesc->setultimafoja($_POST['textfoja']);
			$objdesc->setid_orden($_POST['textidordendescarga']);

			if ($objdesc->modificarDescargaInfoDocGastoDetalle()) 
			{
				   $resultado->error ='true';
				    
				    /*$idorden=$_POST['textidordendescarga'];
					$mascara=$idorden*10987654321;
					$encriptado=base64_encode($mascara);
					echo "<script > setTimeout(function(){ location.href='ordenadmin.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Modificaron Los Registros Con Exito','success'); </script>";*/
			}
			else
			{
				$resultado->error ='false';

				/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Modificaron Los Registros','warning'); </script>";*/
			}
 			
 			break;
 		
 		default:
 			# code...
 			break;
 	}/*fin del switch*/
} 

echo json_encode($resultado);
die();


   
?>