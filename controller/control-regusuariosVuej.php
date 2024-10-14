<?php
error_reporting(E_ERROR);
include_once('../model/clstipousuario.php');
include_once('../model/clsusuario.php');
include_once('../model/clsabogado.php');
include_once('../model/clscliente.php');
include_once('../model/clscontador.php');
include_once('../model/clsprocurador.php');

////////////////VERIFA QUE LA CONTRASEÑA DEL NUEVO USUARIO NO SEA IGUAL A UNA YA EXISTENTE

$accion='crear';
$resultado->error ='false';
$resul=''; 
if (isset($_GET['accion'])) 
{

  if ($_POST['textnombusu']!='' and $_POST['textapellusu']!='' and $_POST['textnomblogin']!='' and $_POST['textpassusu']!='') 
  {
  	
	$accion=$_GET['accion'];
	switch ($accion) {
		case "crear":

		$objusus=new Usuario();
     $switch=0;
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


     ///////////////////////////HASTA AQUI///////////////////////////////////////////
if ($switch==0) /*PREGUNTA SI, ES SWITCH ESA EN CERO(OSEA NO HAY CONTRASEÑA IGUAL A LA NUEVA)*/
{
	

/*TODOS ESTOS IF PREGUNTAN QUE TIPO DE USUARIO SE REGISTRARA*/     
	if ($_POST['selecttpusu']==1) 
	{

		 //guardarabog();
		 $objab=new Abogado();
		$objab->setnombabogado($_POST['textnombusu']);
		$objab->setapellabogado($_POST['textapellusu']);
		$objab->setnombloginabog($_POST['textnomblogin']);
		$objab->settelefonoabog($_POST['texttelfusu']);
		$objab->setcorreoabog($_POST['textmailusu']);
		$objab->setclaveabog($_POST['textpassusu']);
		$objab->setdireccionabog($_POST['textdirusu']);
		$objab->setcoordenadasabog($_POST['textlink']);
		$objab->setobservacionesabog($_POST['textobservusu']);
		$objab->setvisibleabog('Si');
		if ($_POST['checkestado']=='null') {
			$objab->setestadoabog('Activo');
		}
		else{
			$objab->setestadoabog('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="../fotos/fotosusuarios/".$foto;

		//$newdestiono="fotos/fotosusuarios/";
		//$target_file=$newdestiono.basename($foto);
		copy($ruta,$destino);

		//move_uploaded_file($_FILES['filefotousu']['tmp_name'],$target_file);
		
		$objab->setfotoabog($foto);
		if ($objab->guardarabogado()) 
		{
			$resultado->error='true';

			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Abogado Con Exito','success'); </script>";*/
		}
		else
			{
				$resultado->error='false';
			 /*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Abogado ','warning'); </script>";*/
			}
		 

	}/*FIN DEL IF QUE PREGUNTA SI EL SELECTOR ES IGUAL A 1*/
	
	if ($_POST['selecttpusu']==2) 
	{

		//guardarcli();
		$objcli=new Cliente();
		$objcli->setnombrecli($_POST['textnombusu']);
		$objcli->setapellidocli($_POST['textapellusu']);
		$objcli->setnomblogincli($_POST['textnomblogin']);
		$objcli->settelefonocli($_POST['texttelfusu']);
		$objcli->setcorreocli($_POST['textmailusu']);
		$objcli->setclavecli($_POST['textpassusu']);
		$objcli->setdireccioncli($_POST['textdirusu']);
		$objcli->setcoordenadascli($_POST['textlink']);
		$objcli->setobservacionescli($_POST['textobservusu']);
		$objcli->setvisiblecli('Si');

		if ($_POST['checkestado']=='null') {
			$objcli->setestadocli('Activo');
		}
		else
		{
			$objcli->setestadocli('Inactivo');
		}
		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="../fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		
		$objcli->setfotocli($foto);
		if ($objcli->guardarcliente()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Cliente Con Exito','success'); </script>";*/
		}
		else
			{
				$resultado->error= 'false';
				/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Cliente ','warning'); </script>";*/
			}

	}/*FIN DEL IF QUE PREGUNTA SI EL SELECTOR ES IGUAL A 2*/

	//PREGUNTA SI EL SELECTOR ES 3 O 7 SI ES 3 EL USUARIO SE REGISTRA COMO ADMINISTRADOR SI ES 7 SE REGISTRA COMO OBSERVVADOR
	if ($_POST['selecttpusu']!=1 and $_POST['selecttpusu']!=2 and $_POST['selecttpusu']!=4 and $_POST['selecttpusu']!=5 and $_POST['selecttpusu']!=6  ) 
	{
		//guardarusu();
		$objusu=new Usuario();
	  	$objusu->setnombreusu($_POST['textnombusu']);
	  	$objusu->setapellidousu($_POST['textapellusu']);
	  	$objusu->setnombreloginusu($_POST['textnomblogin']);
	  	$objusu->settelefonousu($_POST['texttelfusu']);
	  	$objusu->setcorreousu($_POST['textmailusu']);
	  	$objusu->setclaveusu($_POST['textpassusu']);
	  	$objusu->setdireccionusu($_POST['textdirusu']);
	  	$objusu->setcoordenadasusu($_POST['textlink']);
	  	$objusu->setobservacionesusu($_POST['textobservusu']);
	  	$objusu->setvisibleusu('Si');

	  	if ($_POST['checkestado']=='null') {
			$objusu->setestadorusu('Activo');
		}
		else
		{
			$objusu->setestadorusu('Inactivo');
		}
	  	$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="../fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objusu->setfotousu($foto);

	  	if ($_POST['selecttpusu']==3) 
	  	{
	  		$objusu->settipousu('Administrador');
	  	}
	  	if ($_POST['selecttpusu']==7) 
	  	{
	  		$objusu->settipousu('Observador');
	  	}
	  	

	  	if ($objusu->guardarusuario()) 
	  	{
	  		$resultado->error= 'true';
	  		/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Con Exito','success'); </script>";*/
	  	}
	  	else
	  	{
	  		$resultado->error= 'false';
	  		/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo Usuario ','warning'); </script>";*/
	  	}
	}/*FIN DEL IF QUE PREGUNTA SI EL SELECTOR ES IGUAL A 3 O 7*/


	if ($_POST['selecttpusu']==4 ) 
	{
		//guardarcont();
		$objcont=new Contador();
		$objcont->setnombcontador($_POST['textnombusu']);
		$objcont->setapellcont($_POST['textapellusu']);
		$objcont->setnomblogincont($_POST['textnomblogin']);
		$objcont->settelefonocont($_POST['texttelfusu']);
		$objcont->setcorreocont($_POST['textmailusu']);
		$objcont->setclavecont($_POST['textpassusu']);
		$objcont->setdireccioncont($_POST['textdirusu']);
		$objcont->setcoordenadascont($_POST['textlink']);
		$objcont->setobservacionescont($_POST['textobservusu']);
		$objcont->setvisiblecont('Si');
		if ($_POST['checkestado']=='null') {
			$objcont->setestadocont('Activo');
		}
		else
		{
			$objcont->setestadocont('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="../fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		
		$objcont->setfotocont($foto);

		if ($objcont->guardarcontador()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Contador Con Exito','success'); </script>";*/
		}
		else
		{
			$resultado->error= 'false';
			/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Contador ','warning'); </script>";*/
		}
	}/*FIN DEL IF QUE PREGUNTA SI EL SELECTOR ES IGUAL A 4*/


	if ($_POST['selecttpusu']==5 or $_POST['selecttpusu']==6) 
	{
	  //guardarproc();
		$objproc=new Procurador();
		$objproc->setnombprocurador($_POST['textnombusu']);
		$objproc->setapellprocurador($_POST['textapellusu']);
		$objproc->setnombloginproc($_POST['textnomblogin']);
		$objproc->settelefonoproc($_POST['texttelfusu']);
		$objproc->setcorreoproc($_POST['textmailusu']);
		$objproc->setclaveproc($_POST['textpassusu']);
		$objproc->setdireccionproc($_POST['textdirusu']);
		$objproc->setcoordenadasproc($_POST['textlink']);
		$objproc->setobservacionesproc($_POST['textobservusu']);
		$objproc->setvisibleproc('Si');

		if ($_POST['checkestado']=='null') {
			$objproc->setestadoproc('Activo');
		}
		else
		{
			$objproc->setestadoproc('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="../fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		$objproc->setfotoproc($foto);
        if ($_POST['selecttpusu']==5 ) {
        	$objproc->settpprocurador('Procurador');
        }
        if ($_POST['selecttpusu']==6) {
        	$objproc->settpprocurador('ProcuradorMaestro');
        }
		

		if ($objproc->guardarprocurador()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Procurador Con Exito','success'); </script>";*/
		}
		else
		{
			$resultado->error= 'false';
			/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Procurador','warning'); </script>";*/
		}
	}	/*FIN DEL IF QUE PREGUNTA SI EL SELECTOR ES IGUAL A 6 O 5*/

 
}/*FIN DEL IF QUE PREGUNTA  SI SWITCH ES IGUAL A CERO*/
else/*POR FALSO OSEA HAY CONTRASEÑA IGUAL (MUESTRA UN MENSAJE)*/
{
	 $resultado->error= 'password';
    /*echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña ','warning'); </script>";*/
}



/*************************FUNCIONES****************FUNCIONES******************FUNCIONES*******************FUNCIONES**************/
/*function guardarabog()
		{
		$objab=new Abogado();
		$objab->setnombabogado($_POST['textnombusu']);
		$objab->setapellabogado($_POST['textapellusu']);
		$objab->setnombloginabog($_POST['textnomblogin']);
		$objab->settelefonoabog($_POST['texttelfusu']);
		$objab->setcorreoabog($_POST['textmailusu']);
		$objab->setclaveabog($_POST['textpassusu']);
		$objab->setdireccionabog($_POST['textdirusu']);
		$objab->setcoordenadasabog($_POST['textlink']);
		$objab->setobservacionesabog($_POST['textobservusu']);
		$objab->setvisibleabog('Si');
		if ($_POST['checkestado']==null) {
			$objab->setestadoabog('Activo');
		}
		else{
			$objab->setestadoabog('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		
		$objab->setfotoabog($foto);
		if ($objab->guardarabogado()) 
		{
			$resultado->error= 'true';

			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Abogado Con Exito','success'); </script>";*/
/*		}
		else
			{
				$resultado->error= 'false';
			 /*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Abogado ','warning'); </script>";*/
/*			}
       }/*FIN DE LA FUNCION REGISTRAR ABOGADO*/


/*function guardarcli()
    {
		$objcli=new Cliente();
		$objcli->setnombrecli($_POST['textnombusu']);
		$objcli->setapellidocli($_POST['textapellusu']);
		$objcli->setnomblogincli($_POST['textnomblogin']);
		$objcli->settelefonocli($_POST['texttelfusu']);
		$objcli->setcorreocli($_POST['textmailusu']);
		$objcli->setclavecli($_POST['textpassusu']);
		$objcli->setdireccioncli($_POST['textdirusu']);
		$objcli->setcoordenadascli($_POST['textlink']);
		$objcli->setobservacionescli($_POST['textobservusu']);
		$objcli->setvisiblecli('Si');

		if ($_POST['checkestado']==null) {
			$objcli->setestadocli('Activo');
		}
		else
		{
			$objcli->setestadocli('Inactivo');
		}
		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		
		$objcli->setfotocli($foto);
		if ($objcli->guardarcliente()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Cliente Con Exito','success'); </script>";*/
	/*	}
		else
			{
				$resultado->error= 'false';
				/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Cliente ','warning'); </script>";*/
/*			}
	}/*FIN DE LA FUNCION REGISTRAR CLIENTE*/



/*function guardarcont()
	{
		$objcont=new Contador();
		$objcont->setnombcontador($_POST['textnombusu']);
		$objcont->setapellcont($_POST['textapellusu']);
		$objcont->setnomblogincont($_POST['textnomblogin']);
		$objcont->settelefonocont($_POST['texttelfusu']);
		$objcont->setcorreocont($_POST['textmailusu']);
		$objcont->setclavecont($_POST['textpassusu']);
		$objcont->setdireccioncont($_POST['textdirusu']);
		$objcont->setcoordenadascont($_POST['textlink']);
		$objcont->setobservacionescont($_POST['textobservusu']);
		$objcont->setvisiblecont('Si');
		if ($_POST['checkestado']==null) {
			$objcont->setestadocont('Activo');
		}
		else
		{
			$objcont->setestadocont('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		
		$objcont->setfotocont($foto);

		if ($objcont->guardarcontador()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Contador Con Exito','success'); </script>";*/
	/*	}
		else
		{
			$resultado->error= 'false';
			/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Contador ','warning'); </script>";*/
/*		}
	}/*FIN DE LA FUNCION GUARDAR CONTADOR*/



/*function guardarproc()
	{
		$objproc=new Procurador();
		$objproc->setnombprocurador($_POST['textnombusu']);
		$objproc->setapellprocurador($_POST['textapellusu']);
		$objproc->setnombloginproc($_POST['textnomblogin']);
		$objproc->settelefonoproc($_POST['texttelfusu']);
		$objproc->setcorreoproc($_POST['textmailusu']);
		$objproc->setclaveproc($_POST['textpassusu']);
		$objproc->setdireccionproc($_POST['textdirusu']);
		$objproc->setcoordenadasproc($_POST['textlink']);
		$objproc->setobservacionesproc($_POST['textobservusu']);
		$objproc->setvisibleproc('Si');

		if ($_POST['checkestado']==null) {
			$objproc->setestadoproc('Activo');
		}
		else
		{
			$objcont->setestadoproc('Inactivo');
		}

		$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
		$objproc->setfotoproc($foto);
        if ($_POST['selecttpusu']==5 ) {
        	$objproc->settpprocurador('Procurador');
        }
        if ($_POST['selecttpusu']==6) {
        	$objproc->settpprocurador('ProcuradorMaestro');
        }
		

		if ($objproc->guardarprocurador()) 
		{
			$resultado->error= 'true';
			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Procurador Con Exito','success'); </script>";*/
/*		}
		else
		{
			$resultado->error= 'false';
			/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Procurador','warning'); </script>";*/
/*		}
	}/*FIN DE LA FUNCION GUARDAR PROCURADOR*/



/*function guardarusu()
	  {
	  	$objusu=new Usuario();
	  	$objusu->setnombreusu($_POST['textnombusu']);
	  	$objusu->setapellidousu($_POST['textapellusu']);
	  	$objusu->setnombreloginusu($_POST['textnomblogin']);
	  	$objusu->settelefonousu($_POST['texttelfusu']);
	  	$objusu->setcorreousu($_POST['textmailusu']);
	  	$objusu->setclaveusu($_POST['textpassusu']);
	  	$objusu->setdireccionusu($_POST['textdirusu']);
	  	$objusu->setcoordenadasusu($_POST['textlink']);
	  	$objusu->setobservacionesusu($_POST['textobservusu']);
	  	$objusu->setvisibleusu('Si');

	  	if ($_POST['checkestado']==null) {
			$objusu->setestadorusu('Activo');
		}
		else
		{
			$objcont->setestadorusu('Inactivo');
		}
	  	$foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objusu->setfotousu($foto);

	  	if ($_POST['selecttpusu']==3) 
	  	{
	  		$objusu->settipousu('Administrador');
	  	}
	  	if ($_POST['selecttpusu']==7) 
	  	{
	  		$objusu->settipousu('Observador');
	  	}
	  	

	  	if ($objusu->guardarusuario()) 
	  	{
	  		$resultado->error= 'true';
	  		/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Con Exito','success'); </script>";*/
	/*  	}
	  	else
	  	{
	  		$resultado->error= 'false';
	  		/*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo Usuario ','warning'); </script>";*/
	/*  	}

	  }/*FIN DE LA FUNCION GUARDAR USUARIO (ADMIN U OBSERVADOR)*/
			

			break;
		
		default:
			# code...
			break;
	}/*FIN DEL SWITCH*/


  
  }/*fin del if que pregunta si los campos importantes estan vacios*/
  else
  {
    $resultado->error= 'vacio';	
  }


	
}/*FIN DEL IF 	QUE OBTINE EL GET*/
     

	  echo json_encode($resultado);
die();

?>