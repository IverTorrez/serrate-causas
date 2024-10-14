<?php
error_reporting(E_ERROR);
include_once('../model/clstipousuario.php');
include_once('../model/clsusuario.php');
include_once('../model/clsabogado.php');
include_once('../model/clscliente.php');
include_once('../model/clscontador.php');
include_once('../model/clsprocurador.php');

$accionm='modificar';
$resultado->error ='false';
$resul=''; 
if (isset($_GET['accionm'])) 
{
	$accionm=$_GET['accionm'];
	switch ($accionm) {
		case 'modificar':
		/*comprobamos si esta cambiando su contaseña*/
        $switch=0;
		if ($_POST['textpasscompara']==$_POST['textpassusu']) 
		{
			$switch=0;
		}/*fin del if que pregunta si esta cambiando de contraseña*/
		else/*por falso verificara que esa contraseña no exista en otros usuarios*/
		{
			 $objusus=new Usuario();
		     $lis=$objusus->mostrarclaveusuarios();
		     while ($fil=mysqli_fetch_object($lis)) 
		     {
		     	   if ($_POST['textpassusu']==$fil->claveusu) 
		     	   {
		     	   	   $switch=1;
		     	   } 
		     }

		     $objabo=new Abogado();
		     $li=$objabo->mostrarclaveabogado();
		     while ($fi=mysqli_fetch_object($li)) 
		     {
		     	   if ($_POST['textpassusu']==$fi->claveabog) 
		     	   {
		     	   	   $switch=1;
		     	   }
		     }

		     $objclie=new Cliente();
		     $liss=$objclie->mostrarclavecliente();
		     while ($f=mysqli_fetch_object($liss)) 
		     {
		     	   if ($_POST['textpassusu']==$f->clavecli) 
		     	   {
		     	   	   $switch=1;
		     	   }
		     }


		     $objconta=new Contador();
		     $list=$objconta->mostrarclavecontador();
		     while ($fila=mysqli_fetch_object($list)) 
		     {
		     	   if ($_POST['textpassusu']==$fila->clavecont) 
		     	   {
		     	   	   $switch=1;
		     	   }
		     }

		     $objpro=new Procurador();
		     $lista=$objpro->mostrarclaveprocurador();
		     while ($filap=mysqli_fetch_object($lista)) 
		     {
		     	   if ($_POST['textpassusu']==$filap->claveproc) 
		     	   {
		     	   	   $switch=1;
		     	   }
		     }

		}/*FIN DEL ELSE QUE VIRIFICA LA CONTRASEÑA DE TODOS LOS USUARIOS*/

if ($switch==0) 
{
	

		/**PREGUNTA QUE TIPODE USUARIO SE MODIFICARA*/
if ($_POST['texttipousuario']==1) 
	{
		//modificartablaUsuario();
		$objmodusu=new Usuario();
		$objmodusu->setnombreusu($_POST['textnombusu']);
		$objmodusu->setapellidousu($_POST['textapellusu']);
		$objmodusu->setnombreloginusu($_POST['textnomblogin']);
		$objmodusu->settelefonousu($_POST['texttelfusu']);
		$objmodusu->setcorreousu($_POST['textmailusu']);
		$objmodusu->setclaveusu($_POST['textpassusu']);
		$objmodusu->setdireccionusu($_POST['textdirusu']); 
		$objmodusu->setcoordenadasusu($_POST['textlink']);
		$objmodusu->setobservacionesusu($_POST['textobservusu']);
		$objmodusu->setid_usuario($_POST['textidusuario']);
			if ($_POST['checkestado']=='null') 
			{
			 $objmodusu->setestadorusu('Activo');
			}
			else
			{
			  $objmodusu->setestadorusu('Inactivo');
			}



	   if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
	   {
	   	  if ($objmodusu->editarunUsuarioSinFoto()) 
	   	   {
	   	   	$resultado->error ='true';
	   	  	 //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Con Exito','success'); </script>";
	   	   }
	   	   else
	   	   {
	   	   	$resultado->error ='false';
	         //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario ','warning'); </script>";
	   	   }
	   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/




	   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
	   {
	        $foto=$_FILES['filefotousu']['name'];
			$ruta=$_FILES['filefotousu']['tmp_name'];
			$destino="../fotos/fotosusuarios/".$foto;
			copy($ruta,$destino);
		  	$objmodusu->setfotousu($foto);

		  	if ($objmodusu->editarunUsuarioConFoto()) 
		  	{
		  		$resultado->error ='true';
		  		//echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Con Exito','success'); </script>";
		  	}
		  	else
		  	{
		  		$resultado->error ='false';
	           //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario ','warning'); </script>";
		  	}
	     }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
	}/*FIN DEL IF QUE PREGUNTA SI EL TEXTTIPOUSUARIO ==1*/

	if ($_POST['texttipousuario']==2) 
	{
		//modificarAbogado();
		$objabmod=new Abogado();
		$objabmod->setnombabogado($_POST['textnombusu']);
		$objabmod->setapellabogado($_POST['textapellusu']);
		$objabmod->setnombloginabog($_POST['textnomblogin']);
		$objabmod->settelefonoabog($_POST['texttelfusu']);
		$objabmod->setcorreoabog($_POST['textmailusu']);
		$objabmod->setclaveabog($_POST['textpassusu']);
		$objabmod->setdireccionabog($_POST['textdirusu']);
		$objabmod->setcoordenadasabog($_POST['textlink']);
		$objabmod->setobservacionesabog($_POST['textobservusu']);
		$objabmod->setid_abogado($_POST['textidusuario']);
		if ($_POST['checkestado']=='null') {
			$objabmod->setestadoabog('Activo');
		}
		else{
			$objabmod->setestadoabog('Inactivo');
		}


		 if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
		   {
		   	  if ($objabmod->editarUnAbogadoSinFoto()) 
		   	   {
		   	   	$resultado->error ='true';
		   	  	 //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Abogado Con Exito','success'); </script>";
		   	   }
		   	   else
		   	   {
		   	   	$resultado->error ='false';
		         //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Abogado ','warning'); </script>";
		   	   }
		   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

		   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
		   {
		        $foto=$_FILES['filefotousu']['name'];
				$ruta=$_FILES['filefotousu']['tmp_name'];
				$destino="../fotos/fotosusuarios/".$foto;
				copy($ruta,$destino);
			  	$objabmod->setfotoabog($foto);

			  	if ($objabmod->editarUnAbogadoConFoto()) 
			  	{
			  		$resultado->error ='true';
			  		//echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Abogado Con Exito','success'); </script>";
			  	}
			  	else
			  	{
		           $resultado->error ='false';
		           //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Abogado ','warning'); </script>";
			  	}
		   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/



	}/*FIN DEL IF QUE PREGUNTA SI EL TEXTTIPOUSUARIO ==2*/


	if ($_POST['texttipousuario']==3) 
	{
		//modificarContador();
		$objcontmod=new Contador();
		$objcontmod->setnombcontador($_POST['textnombusu']);
		$objcontmod->setapellcont($_POST['textapellusu']);
		$objcontmod->setnomblogincont($_POST['textnomblogin']);
		$objcontmod->settelefonocont($_POST['texttelfusu']);
		$objcontmod->setcorreocont($_POST['textmailusu']);
		$objcontmod->setclavecont($_POST['textpassusu']);
		$objcontmod->setdireccioncont($_POST['textdirusu']);
		$objcontmod->setcoordenadascont($_POST['textlink']);
		$objcontmod->setobservacionescont($_POST['textobservusu']);
		$objcontmod->setid_contador($_POST['textidusuario']);

		if ($_POST['checkestado']=='null') 
		{
			$objcontmod->setestadocont('Activo');
		}
		else
		{
			$objcontmod->setestadocont('Inactivo');
		}



		 if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
		   {
		   	  if ($objcontmod->editarUnContadorSinFoto()) 
		   	   {
		   	  	 $resultado->error ='true';
		   	  	 //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Contador Con Exito','success'); </script>";
		   	   }
		   	   else
		   	   {
		         $resultado->error ='false';
		         //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Contador ','warning'); </script>";
		   	   }
		   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

		    else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
		   {
		        $foto=$_FILES['filefotousu']['name'];
				$ruta=$_FILES['filefotousu']['tmp_name'];
				$destino="../fotos/fotosusuarios/".$foto;
				copy($ruta,$destino);
			  	$objcontmod->setfotocont($foto);

			  	if ($objcontmod->editarUnContadorConnFoto()) 
			  	{
			  		$resultado->error ='true';
			  		//echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Contador Con Exito','success'); </script>";
			  	}
			  	else
			  	{
		           $resultado->error ='false';
		           //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Contador ','warning'); </script>";
			  	}
		   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
	}/*FIN DEL IF QUE PREGUNTA SI EL TEXTTIPOUSUARIO ==3*/


	if ($_POST['texttipousuario']==4) 
	{
		//modificarProcurador();
		$objprocmod=new Procurador();
		$objprocmod->setnombprocurador($_POST['textnombusu']);
		$objprocmod->setapellprocurador($_POST['textapellusu']);
		$objprocmod->setnombloginproc($_POST['textnomblogin']);
		$objprocmod->settelefonoproc($_POST['texttelfusu']);
		$objprocmod->setcorreoproc($_POST['textmailusu']);
		$objprocmod->setclaveproc($_POST['textpassusu']);
		$objprocmod->setdireccionproc($_POST['textdirusu']);
		$objprocmod->setcoordenadasproc($_POST['textlink']);
		$objprocmod->setobservacionesproc($_POST['textobservusu']);

		$objprocmod->setid_procurador($_POST['textidusuario']);

		if ($_POST['checkestado']=='null') {
			$objprocmod->setestadoproc('Activo');
		}
		else
		{
			$objprocmod->setestadoproc('Inactivo');
		}

		 if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
		   {
		   	  if ($objprocmod->editarunProcuradorSinFoto()) 
		   	   {
		   	  	 $resultado->error ='true';
		   	  	 //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Procurador Con Exito','success'); </script>";
		   	   }
		   	   else
		   	   {
		         $resultado->error ='false';
		         //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Procurador ','warning'); </script>";
		   	   }
		   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

		    else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
		   {
		        $foto=$_FILES['filefotousu']['name'];
				$ruta=$_FILES['filefotousu']['tmp_name'];
				$destino="../fotos/fotosusuarios/".$foto;
				copy($ruta,$destino);
			  	$objprocmod->setfotoproc($foto);

			  	if ($objprocmod->editarunProcuradorConFoto()) 
			  	{
			  		$resultado->error ='true';
			  		//echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Procurador Con Exito','success'); </script>";
			  	}
			  	else
			  	{
		           $resultado->error ='false';
		           //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Procurador ','warning'); </script>";
			  	}
		   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
	}/*FIN DEL IF QUE PREGUNTA SI EL TEXTTIPOUSUARIO ==4*/


	if ($_POST['texttipousuario']==5) 
	{
		//modificarCliente();
		$objclimod=new Cliente();
		$objclimod->setnombrecli($_POST['textnombusu']);
		$objclimod->setapellidocli($_POST['textapellusu']);
		$objclimod->setnomblogincli($_POST['textnomblogin']);
		$objclimod->settelefonocli($_POST['texttelfusu']);
		$objclimod->setcorreocli($_POST['textmailusu']);
		$objclimod->setclavecli($_POST['textpassusu']);
		$objclimod->setdireccioncli($_POST['textdirusu']);
		$objclimod->setcoordenadascli($_POST['textlink']);
		$objclimod->setobservacionescli($_POST['textobservusu']);

		$objclimod->setid_cliente($_POST['textidusuario']);

		if ($_POST['checkestado']=='null') {
			$objclimod->setestadocli('Activo');
		}
		else
		{
			$objclimod->setestadocli('Inactivo');
		}



		 if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
		   {
		   	  if ($objclimod->editarUnClienteSinFoto()) 
		   	   {
		   	  	 $resultado->error ='true';
		   	  	 //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Cliente Con Exito','success'); </script>";
		   	   }
		   	   else
		   	   {
		         $resultado->error ='false';
		         //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Cliente ','warning'); </script>";
		   	   }
		   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/



		   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
		   {
		        $foto=$_FILES['filefotousu']['name'];
				$ruta=$_FILES['filefotousu']['tmp_name'];
				$destino="../fotos/fotosusuarios/".$foto;
				copy($ruta,$destino);
			  	$objclimod->setfotocli($foto);

			  	if ($objclimod->editarUnClienteConFoto()) 
			  	{
			  	  $resultado->error ='true';
			  	  //echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Cliente Con Exito','success'); </script>";
			  	}
			  	else
			  	{
		           $resultado->error ='false';
		           //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Cliente ','warning'); </script>";
			  	}
		   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
	}/*FIN DEL IF QUE PREGUNTA SI EL TEXTTIPOUSUARIO ==5*/



 }/*FIN DEL IF QUE PREGUNTA SI EL SWITCH ES IGUAL A CERO,*/
 else/*por falso si el switch no es cero quiere decir que ya hay una contraseña igual a la que se esta cambiando*/
 {
    $resultado->error= 'password';
 }


/*FIN DE TODOS LOS IF QUE PREGUNTA QUE TIPO DE USUARIO SE MODIFICARA*/
			
			break;
		
		default:
			# code...
			break;
	}/*FIN DEL SWITCH*/



}/*FIN DEL IF DEL GET*/

echo json_encode($resultado);
die();
?>