<?php
error_reporting(E_ERROR);
include_once('../model/clsmateria.php');
include_once('../model/clstipolegal.php');
include_once('../model/clscliente.php');
include_once('../model/clscategoria.php');
include_once('../model/clsabogado.php');
include_once('../model/clsprocurador.php');
include_once('../model/clscausa.php');
include_once('../model/clsplantilla.php');
include_once('../model/clsposta.php');
include_once('../model/clspostacausa.php');
include_once('../model/clsusuario.php');
include_once('../model/clsplanilla_notificacion.php');

$accion='crear';
$resultado->error ='false';

if (isset($_GET['accion'])) 
{  
	$accion=$_GET['accion'];
  switch ($accion) {
  		case 'crear':

	  		$objposta1=new Posta();
			$resultpos1=$objposta1->mostrarcantidaddePostasActivasDeUnaPlantilla($idplantilla);
			$filpost1=mysqli_fetch_object($resultpos1);
			 
			
					
				$objcausa=new Causa();
				$objcausa->setobservcausa($_POST['textobserpro']);
				$objcausa->setobservsolotexto($_POST['textobsersolotexto']);
				$objcausa->setestadocausa('Activa');
				$objcausa->setnombrecausa($_POST['textnombproceso']);
				$objcausa->setid_clientec($_POST['selectcli']);
				$objcausa->setid_abogadoc($_POST['selectabog']);
				$objcausa->setid_tplegalc($_POST['selecttplegal']);
				$objcausa->setid_procuradorc($_POST['selectproc']);
				$objcausa->setid_materiac($_POST['selectmat']);
				$objcausa->setid_categoriac($_POST['selectcat']);
			    $objcausa->setid_usuc($_POST['textidadm']);

				if ($objcausa->guardarcausa()) 
				{
				    
				    enviarCorreoCrearCausa();
					/*-------------FIN DE CORREO PARA PROCURADOR MAESTRO-----------*/
					
					/*----------FIN DE LOS ENVIOS DE CORREO--------*/
	                $idplantilla=$_POST['selectplantilla'];
					if ($idplantilla>0) /*pregunta si escogio plantilla*/
					{
						/*FUNCION PARA OBTENER EL ULTIMO REGISTRO  DE CAUSA DEL USUARIO*/
						$objcausault=new Causa();
						$resulUltimo=$objcausault->mostarUltimoIdcausaDeUnUsuario($_POST['textidadm']);
						$filidult=mysqli_fetch_object($resulUltimo);

						$idcausa=$filidult->idcausaultimo;
						/*-----------------------------------------------------------------*/
	                
		                /*FUNCION PARA OBTENER EL NOMBRE DE LA PLANTILLA SELECCIONADA*/
						$objplant=new Plantilla();
						$resulplant=$objplant->mostrarUnaPlantilla($idplantilla);
						$filplant=mysqli_fetch_object($resulplant);
						$nombreplantilla=$filplant->nombreplantilla;
						/*-------------------------------------------------------------------*/

						/*AQUI SE CREARA LA POSTA CERO (OSEA LA PRIMER POSTA ), PARA LA POSTA CAUSA*/
						    $objpostCeroCausa=new PostaCausa();
							$objpostCeroCausa->setnumeropostacausa(0);
							$objpostCeroCausa->setnombrepostacausa('INICIO');
							$objpostCeroCausa->setestadopostacausa('vacia');
							$objpostCeroCausa->setid_causap($idcausa);
							$objpostCeroCausa->setcopianombreplantilla($nombreplantilla);

							$objpostCeroCausa->guardarpostaCausa();
	                    
						/*HASTA AQUI SE CREA LA POSTA CERO PARA LA POSTA CAUSA*/
	                
		                /*FUNCION PARA LISTAR Y COPIAR TODAS LAS POSTAS DE UNA PLANTILLA A UNA NUEVA TABLA (POSTA CAUSA)*/
						$objposta2=new Posta();
						$resultposta2=$objposta2->listarPostasDePLantillaParaInsertarENCausa($idplantilla);
						while ($filpost2=mysqli_fetch_object($resultposta2)) 
						{
							$objpostCausa=new PostaCausa();
							$objpostCausa->setnumeropostacausa($filpost2->numeroposta);
							$objpostCausa->setnombrepostacausa($filpost2->nombreposta);
							$objpostCausa->setestadopostacausa('vacia');
							$objpostCausa->setid_causap($idcausa);
							$objpostCausa->setcopianombreplantilla($nombreplantilla);

							$objpostCausa->guardarpostaCausa();
						}

				    }//fin del if que pregunta si escogio plantilla
					else
					{
					 
					}   
					
					/**------------------------------------------------------------------------------------------*/
					 $resultado->error='true';
					 /*echo "<script > setTimeout(function(){ location.href='causasActivas.php' }, 1000); swal('EXELENTE','Se Creo La Causa Con Exito','success'); </script>";*/
				}/*FIN DEL IF QUE PREGUNTA SI SE INSERTO LA CAUSA CON EXITO*/
				else
				{
					 $resultado->error='false';
					/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se Creo La Causa','warning'); </script>";*/
				}

  			
  			break;
  		
  		default:
  			# code...
  			break;
  	}/*FIN DEL SWITCH*/	
}/*FIN DEL IF QUE OBTINE EL GET*/

//FUNCION PARA ENVIAR CORREO ELECTRONICO
function enviarCorreoCrearCausa()
{   /*Se obtiene los datos de la planilla con codigo 1*/
	$objplanilla= new Planillas_envio_notificacion();
	$resulplanilla=$objplanilla->mostrarUnaPlanillas_envioNotif_activa(1);
	$filplanilla=mysqli_fetch_object($resulplanilla);
	$envia_notif           =$filplanilla->envia_notif;
	$emisor                =$filplanilla->emisor;
	$tipo_dinamico_estatico=$filplanilla->tipo_dinamico_estatico;
	$receptor_estatico     =$filplanilla->receptor_estatico;
	$asunto                =$filplanilla->asunto;
	$texto                 =$filplanilla->texto;
	$nombre_emisor         =$filplanilla->nombre_emisor;
	if ($envia_notif==1) //preguntamos si envia la notificacion
	{
		//preguntamos si existe un emisor con direccion de correo electronico valido 
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
			/*SACAMOS LOS DATOS DEL PROCURADOR, Y EL CORREO*/
	        $objproc1=new Procurador();
	        $resulproc=$objproc1->mostrarunProcurador1($_POST['selectproc']);
	        $filproc=mysqli_fetch_object($resulproc);
	        $nombreProc=$filproc->nombreproc.' '.$filproc->apellidoproc;
	        $destinoproc=$filproc->correoproc;

	        /*--------------CORREO PARA PROCURADOR MAESTRO---------------*/
	        $resulprocM=$objproc1->mostrarProcuradorMaestro();
	        $filpm=mysqli_fetch_object($resulprocM);
	        $destinoprocM=$filpm->correoproc;
           $correoCopia=$destinoproc.",".$destinoprocM;

			/*CABEZERA DEL CORREO, DE PARTE DE QUIEN ES*/
            $cabeceras = "From: ".$nombre_emisor."<".$correoEmisor.">"."\r\n".
                         "Reply-To:".$correoEmisor."\r\n".
                         "Cc:".$correoCopia.""."\r\n" .  // esto sería copia normal
                         "MIME-Version: 1.0\r\n".//phpversion().
                         "Content-Type: text/html; charset=utf-8\r\n";

             /*SACAMOS EL ID DE LA ULTIMA CAUSA DEL ABOGADO*/
            $objcausaab=new Abogado();
            $resulcaab=$objcausaab->mostrarultimaCausaDeAbogado($_POST['selectabog']);
            $filcauab=mysqli_fetch_object($resulcaab);

            $idcausaab=$filcauab->idcausaultima;
                    
            /*MOSTRAMOS EL CODIGO DE LA ULTIMA CAUSA*/
            $objcausacod=new Causa();
            $resulcod=$objcausacod->mostrarcodcausa($idcausaab);
            $filcaucod=mysqli_fetch_object($resulcod);
            $codigocausa=$filcaucod->codigo;

            $objabog=new Abogado();
	        $resulabo=$objabog->mostrarunAbogado($_POST['selectabog']);
            $filab=mysqli_fetch_object($resulabo);
            /*SACAMOS EL CORREO DEL ABOGADO*/
            $destinoCorreo=$filab->correoabog;
            $abogadoasignado=$filab->nombreabog.' '.$filab->apellidoabog;

	        $nombreCausa=$_POST['textnombproceso'];
            //Reemplazamos los nombre de causas, abogado procurador etc
	        $search = array('[nombreapellidoabogado]', 
                            '[codigocausa]', 
                            '[nombrecausa]', 
                            '[nombreapellidoprocurador]');
            $replace = array('<b>'.$abogadoasignado.'</b>',
                            '<b>'.$codigocausa.'</b>',
                            '<b>'.$nombreCausa.'</b>',
                            '<b>'.$nombreProc.'</b>');
            $textomodificado=str_replace($search,$replace,$texto);

		if ($tipo_dinamico_estatico==1) //preguntamos si el receptor es dinamico 
		{
			
	       mail($destinoCorreo,$asunto,$textomodificado,$cabeceras);
	       //Correo para el procurador
	      // mail($destinoproc,$asuntoproc,$textomodificado,$cabeceras);
	       //Correo para el procurador maestro
	      // mail($destinoprocM,$asuntoproc,$textomodificado,$cabeceras);
		}//fin del if que pregunta si el receptor es dinamico
		else//por falso cargamos el receptor estatico
		{
			$receptor=$receptor_estatico;
            //Correo para el destino	
	        mail($receptor,$asunto,$textomodificado,$cabeceras);
		}
	}//fin cuando pregunta si envia notificacion


} //fin de funcion de enviar correo

        
echo json_encode($resultado);
die();
?>