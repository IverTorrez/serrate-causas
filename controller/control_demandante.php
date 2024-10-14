<?php
if (isset($_POST['GUARDAR'])) {
	guardarDemandanteDemandado();
}

if (isset($_POST['btnmoddeman'])) 
{
	modificarUNdemandateDemanTerc();
}

if (isset($_POST['btneliminardeman'])) {
	eliminarUnDemandanteTercerista();
}
function guardarDemandanteDemandado(){
	$deman= new Demandante_Demandado();
	$deman->setnombdeman($_POST['nombre']);
	$deman->settipodeman($_POST['tipodemandante']);
	$deman->setultimo($_POST['texteditor']);
	$deman->setultimodomiciliosolotexto($_POST['textultimodomsolotexto']);
	$deman->setfoja($_POST['foja']);
	$deman->setid_causadem($_POST['textidcausa']);
	$deman->setestadodeman('Activo');

	$tipousu=$_POST['tipousuario'];
	$idcausa=$_POST['textidcausa'];

	if($deman->guardardemand())
	{
	       if ($tipousu=='Abogado') 
	       {
	       	 $mascara=$idcausa*12345678910;
	       	 $encriptado=base64_encode($mascara);
	       	 echo"<script > setTimeout(function(){ location.href='fichacausa.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Creo El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
	       }
	       if ($tipousu=='Admin') 
	       {
	       	$mascara=$idcausa*1234567;
	        $encriptado=base64_encode($mascara);
	       	 echo"<script > setTimeout(function(){ location.href='ficha.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Creo El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
	       }
			
		  if ($tipousu=='PMaestro') 
		  {
		  	$mascara=$idcausa*1213141516;
	        $encriptado=base64_encode($mascara);
		  	echo"<script > setTimeout(function(){ location.href='pm_ficha.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Creo El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
		  }
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Demandante, Demandado o Tercerista ','warning'); </script>";
	}
}


function modificarUNdemandateDemanTerc()
{
	$objdeammod=new Demandante_Demandado();
	$objdeammod->setnombdeman($_POST['nombre']);
	$objdeammod->setultimo($_POST['texteditor']);
	$objdeammod->setultimodomiciliosolotexto($_POST['textultimodomsolotexto']);
	$objdeammod->setfoja($_POST['foja']);
	$objdeammod->setid_demdem($_POST['textiddemanedit']);

	if ($objdeammod->modificarDemandadoTercer()) 
	{
		$tipousu=$_POST['tipousuario'];
	    $idcausa=$_POST['textidcausa'];
		if ($tipousu=='Abogado') 
	       {
	       	 $mascara=$idcausa*12345678910;
	       	 $encriptado=base64_encode($mascara);
	       	 echo"<script > setTimeout(function(){ location.href='fichacausa.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Modifco El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
	       }
	       if ($tipousu=='Admin') 
	       {
	       	$mascara=$idcausa*1234567;
	        $encriptado=base64_encode($mascara);
	       	 echo"<script > setTimeout(function(){ location.href='ficha.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Modifco El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
	       }
			
		  if ($tipousu=='PMaestro') 
		  {
		  	$mascara=$idcausa*1213141516;
	        $encriptado=base64_encode($mascara);
		  	echo"<script > setTimeout(function(){ location.href='pm_ficha.php?squart=$encriptado'; }, 1500); swal('EXELENTE','Se Modifco El Demandante, Demandado o Tercerista Con Exito','success'); </script>";
		  }
		
	}/*FIN DEL IF QUE PREGUNTA SI SE EJECUTO LA FUNCION*/
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Demandante, Demandado o Tercerista ','warning'); </script>";
	}

}/*FIN DE LA FUNCION MODIFICAR DEMANDANTE DEMANDADO TERCERISTA*/


function eliminarUnDemandanteTercerista()
{
	$objdemanelim=new Demandante_Demandado();
	$objdemanelim->setestadodeman('Inactivo');
	$objdemanelim->setid_demdem($_POST['textiddeman']);
	if ($objdemanelim->eliminardeamndtercerista()) 
	{ $tipo=$_POST['texttipod'];
       if ($tipo=='Demandante') 
       {
       	 echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino El Demandante Con Exito','success'); </script>";
       }

       if ($tipo=='Demandado') 
       {
       	 echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino El Demandado Con Exito','success'); </script>";
       }

       if ($tipo=='Tercerista') 
       {
       	 echo"<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino El Tercerista Con Exito','success'); </script>";
       }

		
	}
	else
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Registro','warning'); </script>";	
	}
	
}
?>