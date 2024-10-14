<?php
if (isset($_POST['guardarTribunalF'])) {
	guardatribunalficha();
}

if (isset($_POST['btneliminartribcausa'])) 
{
	eliminartribunaldeCausa();
}

function guardatribunalficha()
{
	$objtrib=new Tribunal();
	$objtrib->setexpediente($_POST['nroExpediente']);
	$objtrib->setcodigonianuj($_POST['codNI']);
	
	$objtrib->setid_clstribunalt($_POST['idClaseTrib']);
	$objtrib->setid_causat($_POST['textidcausa']);
	$objtrib->setid_juzgadot($_POST['idJuzgado']);
     
      
   $objtrib1=new Tribunal();
   $resultrib=$objtrib1->mostrarDatosDeTribunalDeCausaYJuzgado($_POST['textidcausa'],$_POST['idJuzgado']);
   $filtrib=mysqli_fetch_object($resultrib);
   if ($filtrib->id_tribunal=='')/*pregunta si no existe registro de la causa con el tribunal, por verdad inserta*/
   {
   	
  

		if ($objtrib->guardartribunal()) 
		{
			/*CREARA UN DIRECTORIO (CARPETA) PARA LA CAUSA CON EL TRIBUNAL*/
			   $objcausa=new Causa();
			   $resul=$objcausa->mostrarcodcausa($_POST['textidcausa']);
			   $fil=mysqli_fetch_object($resul);

	   // echo "<td style='width: 10%;'>$fil->codigo</td>";
			   $objjuz=new Juzgados();
			   $resuljuz=$objjuz->mostrardatostribunal($_POST['idJuzgado']);
			   $filjuz=mysqli_fetch_object($resuljuz);

			   $objtrib3=new Tribunal();
			   $resultrib3=$objtrib3->mostrarDatosDeTribunalDeCausaYJuzgado($_POST['textidcausa'],$_POST['idJuzgado']);
			   $filtrib3=mysqli_fetch_object($resultrib3);

				$nombrecarpeta = $fil->codigo.'['.$filjuz->nombrenumerico.'-'.$filjuz->jerarquia.'-'.$filjuz->materiajuz.']'.'-'.$filtrib3->id_tribunal;
		        
		        /*HASTA AQUI CREA UNA CARPETA PARA LA CAUSA ,CON EL TRIBUNAL*/


		     /* DESDE SE MODIFICA EL TRIBUNAL PARA GUARDAR EL NOMBRE DEL DIRECTORIO*/
		     $objtribmod=new Tribunal();
		     $objtribmod->setid_tribunal($filtrib3->id_tribunal);
		     $objtribmod->setlinkcarpeta($nombrecarpeta);
		     $objtribmod->modificarelLinkDeCarpetaDeTribunal();


		     /*HASTA AQUI SE MODIFICA EL TRIBUNAL*/

			$tipousu=$_POST['texttipousu'];
			if ($tipousu=='Admin') 
			{ 
				mkdir('expedientes/'.$nombrecarpeta, 0777, true);
				$idcausa=$_POST['textidcausa'];
			    $mascara=$idcausa*1234567;
		        $encriptado=base64_encode($mascara);
			   echo "<script > setTimeout(function(){ location.href='ficha.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Inserto el Tribunal Con Exito','success'); </script>";
			}
			if ($tipousu=='PMaestro') 
			{
				mkdir('../expedientes/'.$nombrecarpeta, 0777, true);
				$idcausa=$_POST['textidcausa'];
			    $mascara=$idcausa*1213141516;
		        $encriptado=base64_encode($mascara);
			   echo "<script > setTimeout(function(){ location.href='pm_ficha.php?squart=$encriptado' }, 2000); swal('EXELENTE','Se Inserto el Tribunal Con Exito','success'); </script>";
			}
			
		}/*FIN DEL IF QUE PREGUNTA SI SE EJECUTO LA FUNCION*/
		else
			{
	          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Inserto el Tribunal, Tal Vez Una Razon Sea Que Esta Intentando Repetir Registros','warning'); </script>";
			}

	}/*fin del if que pregunta si no existe registros de causa con el juzgado*/
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Inserto, Esta Intentando Repetir Registros','warning'); </script>";
	}


}

function eliminartribunaldeCausa()
{
	$objcuerpo=new CuerpoExpediente();
	$objcuerpo->setid_tribunal($_POST['textidtribunal']);
	if ($objcuerpo->eliminarCuerposDeTribunal()) 
	{
		
	
		$objelimtrib=new Tribunal();
		$objelimtrib->setid_causat($_POST['textidcausa1']);
		$objelimtrib->setid_tribunal($_POST['textidtribunal']);
		if ($objelimtrib->eliminarTribunalCausa()) 
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino el Tribunal Con Exito','success'); </script>";
		}
		else
		{
		 echo "<script > setTimeout(function(){  }, 2000); swal('ERROR FATAL','No Se Eliminaron Todos Los Datos Del Tribunal','warning'); </script>";	
		}
	}
	else
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No se Elimino el Tribunal','warning'); </script>";		
	}
}
?>