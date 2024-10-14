<?php
if (isset($_POST['btnelimihistorigrama'])) 
{
	eliminarhistorigrama();
}

function eliminarhistorigrama()
{
	$idcausa=$_POST['textidCausa'];/*obtenemos el id causa*/
    
    /*CODIGO PARA ENLISTAR TODAS LAS POSTAS DE UNA CAUSA*/
	$objPostaCausa=new PostaCausa();
	$resulPC=$objPostaCausa->listarPostasDeCausa($idcausa);
	while ($filPC=mysqli_fetch_object($resulPC)) 
	{
		/*CODIGO PARA LIMINAR EL INFORME DE CADA POSTA*/
		$objInformePosta=new InformePosta();
		$objInformePosta->setid_postacausainf($filPC->id_postacausa);
		$objInformePosta->eliminarUnInformedePostaCausaConID_PostaCausa();
	 	
	}/*FIN DEL WHILE QUE RRECORE TODAS LAS POSTAS DE UNA CAUSA*/ 
    
    /*CODIGO PARA ELIMINAR TODAS LAS POSTAS DE UNA causa*/
	$obPC_elim=new PostaCausa();
	$obPC_elim->setid_causap($idcausa);
    if ($obPC_elim->eliminarPostasDeUNaCausa()) 
    {
   		echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino EL Historigrama Con Exito','success'); </script>";
   	}
   	else
   	{
   		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Historigrama','warning'); </script>";
   	}
}

?>