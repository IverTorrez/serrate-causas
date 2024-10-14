<?php
if (isset($_POST['btncolocarcostojudiventa'])) {
	colocarcostojudicialventa();
} 

function colocarcostojudicialventa()
{
	$objcosf=new Costofinal();
	$resultc=$objcosf->mostrarValidacionFinalDelAdminDEunCostoFinal($_POST['textidcostofinal']);
	$filacos=mysqli_fetch_object($resultc);

	if ($filacos->validadofinal=='No') /*PREGUNTA SI AUN NO SE VALIDO EL COSTO FINAL*/
	{
		$objdescarga=new DescargaProcurador();
		$resultdescarga=$objdescarga->muestraDescargaDeorden($_POST['textidorden']);
		$fildescarga=mysqli_fetch_object($resultdescarga);
        $nuevogastoprocesal=$_POST['textnewcostoproceventa'].'.'.$_POST['textdecimales'];
		$gastodescarga=$fildescarga->gastos;
		/*CONDICION ANTIGUA-->$nuevogastoprocesal>=$gastodescarga*/
		if ($nuevogastoprocesal>=0) 
		{
		
				$nuevocostoproceventa=$_POST['textnewcostoproceventa'].'.'.$_POST['textdecimales'];
				$objcost=new Costofinal();
				$list=$objcost->mostrardatoscostofinal($_POST['textidcostofinal']);
				$fila=mysqli_fetch_object($list);
			    
			    
				$ganaciapventa=$nuevocostoproceventa-$fila->costo_procesal_venta;/*en principio tenia costo_procesal_venta*/

				$nuevototalegreso=$fila->costo_procuradoria_venta+$nuevocostoproceventa;

				$fila->total_egreso;
				$fila->ganaciaprocesal;
			    
			    $objco=new Costofinal();
				$objco->setcosto_prosesal_venta($nuevocostoproceventa);
				$objco->settotal_egreso($nuevototalegreso);
				$objco->setvalidadofinal('Si');
				$objco->setgananciaprocesal($ganaciapventa);
				$objco->setid_costofinal($_POST['textidcostofinal']);

				if ($objco->colocarcostoprocesalventa()) {

					$objor=new OrdenGeneral();
					$result=$objor->mostraridcausadeunaorden($_POST['textidorden']);
					$fil=mysqli_fetch_object($result);
					$idcausa=$fil->id_causa;

					$objcausa=new Causa();
					$ress=$objcausa->mostrarcajacausa($idcausa);
					$fi=mysqli_fetch_object($ress);
					$newsaldocaja=$fi->caja-$ganaciapventa;

					$obcausa=new Causa();
					$obcausa->setcajacausa($newsaldocaja);
					$obcausa->setid_causa($idcausa);
					if ($obcausa->modificarcajadecausa()) {

						$obcaja=new Cajasdesalida();
						$liss=$obcaja->mostrarganacias();
						$fill=mysqli_fetch_object($liss);

						$nuevaganancias=$fill->gananciasprocesalyproc+$ganaciapventa;

						$obcajas=new Cajasdesalida();
						$obcajas->setgananciaspp($nuevaganancias);
						$obcajas->setid_cajasalida(1);
						if ($obcajas->modificarganancias()) {
							echo "<script > setTimeout(function(){ location.href='colocarcostojudicial.php' }, 2000); swal('EXELENTE','Se Insero El Costo Judicial Venta','success'); </script>";
						}

						else{
					        echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Inserto El Costo Judicial Venta','warning'); </script>";
					
				            }

					}

					else{
					echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Inserto El Costo Judicial Venta','warning'); </script>";
					
				        }


					
				}
				else{
					echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Inserto El Costo Judicial Venta','warning'); </script>";
					
				}

		}
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Puede Colocar Un Costo Menor a Cero','warning'); </script>";
		}

	}/*fin del if que pregunta si se valido el costo final*/
	else/*osea ya se valido el costo final*/
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se coloco el egreso final, porque ya se coloco el egreso final anteriormente','warning'); </script>";
	}
}/*FIN DE LA FUNCION*/

?>