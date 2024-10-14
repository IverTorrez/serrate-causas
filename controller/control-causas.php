<?php
if (isset($_POST['btncrearproceso'])) {
	guardacausa();
}
if (isset($_POST['btnmodiproceso']))  
{
	modificarUnaCausa();
}

function guardacausa() 
{
	
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
				echo "<script > setTimeout(function(){ location.href='causasActivas.php' }, 1000); swal('EXELENTE','Se Creo La Causa Con Exito','success'); </script>";
			}/*FIN DEL IF QUE PREGUNTA SI SE INSERTO LA CAUSA CON EXITO*/
			else
			{
				echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se Creo La Causa','warning'); </script>";
			}


		
		

	
} /*FIN DE LA FUNCION GUARDAR CAUSA*/



function modificarUnaCausa()
{
	$objcausamod=new Causa();
	$objcausamod->setid_materiac($_POST['selectmat']);
	$objcausamod->setid_tplegalc($_POST['selecttplegal']);	
	$objcausamod->setnombrecausa($_POST['textnombproceso']);
	$objcausamod->setid_categoriac($_POST['selectcat']);
	$objcausamod->setobservcausa($_POST['textobserpro']);
	$objcausamod->setobservsolotexto($_POST['textobsersolotexto']);
	$objcausamod->setid_abogadoc($_POST['selectabog']);
	$objcausamod->setid_procuradorc($_POST['selectproc']);
	
    $objcausamod->setid_causa($_POST['textidcausa']);

	if ($objcausamod->editarUnaCausa()) 
	{
		       $idplantilla=$_POST['selectplantilla'];
				if ($idplantilla>0) /*pregunta si escogio plantilla*/
				{
					/*FUNCION PARA OBTENER EL ULTIMO REGISTRO  DE CAUSA DEL USUARIO
					$objcausault=new Causa();
					$resulUltimo=$objcausault->mostarUltimoIdcausaDeUnUsuario($_POST['textidadm']);
					$filidult=mysqli_fetch_object($resulUltimo);*/

					$idcausa=$_POST['textidcausa'];
					/*-----------------------------------------------------------------*/
                
	                /*FUNCION PARA OBTENER EL NOMBRE DE LA PLANTILLA SELECCIONADA*/
					$objplant=new Plantilla();
					$resulplant=$objplant->mostrarUnaPlantilla($idplantilla);
					$filplant=mysqli_fetch_object($resulplant);
					$nombreplantilla=$filplant->nombreplantilla;
					/*-------------------------------------------------------------------*/

					/*AQUI SE CREARA LA POSTA CERO (LA PRIMER POSTA PARA LA CAUSA)*/
					   $objpostCeroCausa=new PostaCausa();
						$objpostCeroCausa->setnumeropostacausa(0);
						$objpostCeroCausa->setnombrepostacausa('INICIO');
						$objpostCeroCausa->setestadopostacausa('vacia');
						$objpostCeroCausa->setid_causap($idcausa);
						$objpostCeroCausa->setcopianombreplantilla($nombreplantilla);

						$objpostCeroCausa->guardarpostaCausa();
					/*HASTA AQUI SE CREARA LA POSTA CERO*/
                
	                /*FUNCION PARA LISTAR Y COPIAR TODAS LAS POSTAS DE UNA PLANTILLA A UNA NUEVA TABAL (POSTA CAUSA)*/
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
				  

		echo "<script > setTimeout(function(){ location.href='causasActivas.php' }, 1000); swal('EXELENTE','Se modifico La Causa Con Exito','success'); </script>";
	}/*FIN DEL IF QUE PREGUNTA SI SE EDITO CORRECTAMENTE UNA CAUSA*/
	else{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No se modifico La Causa','warning'); </script>";
	}
}

?>