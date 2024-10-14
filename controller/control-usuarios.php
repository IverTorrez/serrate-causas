<?php
if (isset($_POST['btnguardarusu'])) 
{
////////////////VERIFA QUE LA CONTRASEÑA DEL NUEVO USUARIO NO SEA IGUAL A UNA YA EXISTENTE
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
if ($switch==0) 
{
	

     
	if ($_POST['selecttpusu']==1) {

		 guardarabog();

	}
	
	if ($_POST['selecttpusu']==2) {

		guardarcli();
	}
	//PREGUNTA SI EL SELECTOR ES 3 O 7 SI ES 3 EL USUARIO SE REGISTRA COMO ADMINISTRADOR SI ES 7 SE REGISTRA COMO OBSERVVADOR
	if ($_POST['selecttpusu']!=1 and $_POST['selecttpusu']!=2 and $_POST['selecttpusu']!=4 and $_POST['selecttpusu']!=5 and $_POST['selecttpusu']!=6  ) {
		guardarusu();
	}	 

	if ($_POST['selecttpusu']==4 ) {
		guardarcont();
	}
	if ($_POST['selecttpusu']==5 or $_POST['selecttpusu']==6) {
		 	guardarproc();
		 }	

 
}
  else
  {
  	echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','Debe usar otra Contraseña ','warning'); </script>";
  }	

}/*FIN DEL IF QUE PREGUNTA SI SE PRESIONO EL BOTON GUARDAR*/

if (isset($_POST['btnmodusu'])) /**PREGUNTA SI SE PRESIONO EL BOTON MODIFICAR  */
{
	if ($_POST['texttipousuario']==1) 
	{
		modificartablaUsuario();
	}
	if ($_POST['texttipousuario']==2) 
	{
		modificarAbogado();
	}
	if ($_POST['texttipousuario']==3) 
	{
		modificarContador();
	}
	if ($_POST['texttipousuario']==4) 
	{
		modificarProcurador();
	}
	if ($_POST['texttipousuario']==5) 
	{
		modificarCliente();
	}
}/*FIN DEL IF QUE PREGUNTA SI SE PRESIONO EL BOTOM MODIFICAR*/


/*PREGUNTA SI SE PRESIONO EL BOTON ELILIMAR USUARIO*/
if (isset($_POST['btneliminarusu'])) 
{
	if ($_POST['textidadmin']==$_POST['textidusu']) /*PREGUNTA SI EL ADMINISTRADOR ACTUAL SE QUIERE ELIMINAR*/
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Puede Eliminar Usted Mismo ','warning'); </script>";	
	}
	else
	{
		eliminarUnUsuario();
	}
}

/*PREGUNTA SI SE PRESIONO EL BOTON ELIMINAR ABOGADO*/
if (isset($_POST['btneliminarabog'])) 
{
	eliminarUnAbogado();
}

/*PREGUNTA SI SE PRESIONO EL BOTON ELIMINAR CONTADOR*/
if (isset($_POST['btneliminarcont'])) 
{
	eliminarUnContador();
}

/*PREGUNTA SI SE PRESIONO EL BOTON ELIMINAR PROCURADOR*/
if (isset($_POST['btneliminarproc'])) 
{
	eliminarUnProcurador();
}

/*PREGUNTA SI SE PRESIONO EL BOTON ELIMINAR CLIENTE*/
if (isset($_POST['btneliminarcli'])) 
{
	eliminarUnCliente();
}

/*************************FUNCIONES****************FUNCIONES******************FUNCIONES*******************FUNCIONES**************/
function guardarabog()
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
		if ($objab->guardarabogado()) {
			echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Abogado Con Exito','success'); </script>";
		}
		else{echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Abogado ','warning'); </script>";}
       }/*FIN DE LA FUNCION REGISTRAR ABOGADO*/

  function guardarcli()
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
		if ($objcli->guardarcliente()) {
			echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Cliente Con Exito','success'); </script>";
		}
		else{echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Cliente ','warning'); </script>";}
	}/*FIN DE LA FUNCION REGISTRAR CLIENTE*/

	function guardarcont()
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

		if ($objcont->guardarcontador()) {
			echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Contador Con Exito','success'); </script>";
		}
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Contador ','warning'); </script>";
		}
	}/*FIN DE LA FUNCION GUARDAR CONTADOR*/



	function guardarproc()
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
		

		if ($objproc->guardarprocurador()) {
			echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Procurador Con Exito','success'); </script>";
		}
		else
		{
			echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Procurador','warning'); </script>";
		}
	}/*FIN DE LA FUNCION GUARDAR PROCURADOR*/






	 function guardarusu()
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
	  	

	  	if ($objusu->guardarusuario()) {
	  		echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Con Exito','success'); </script>";
	  	}
	  	else{
	  		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo Usuario ','warning'); </script>";
	  	}

	  }/*FIN DE LA FUNCION GUARDAR USUARIO (ADMIN U OBSERVADOR)*/


function modificartablaUsuario()
{
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
		if ($_POST['checkestado']==null) 
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
   	  	 echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Con Exito','success'); </script>";
   	   }
   	   else
   	   {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario ','warning'); </script>";
   	   }
   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/




   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
   {
        $foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objmodusu->setfotousu($foto);

	  	if ($objmodusu->editarunUsuarioConFoto()) 
	  	{
	  		echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Con Exito','success'); </script>";
	  	}
	  	else
	  	{
           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario ','warning'); </script>";
	  	}
   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/

}/*FIN DE LA FUNCION MODIFICAR USUARIO*/

/*FUNCION MODICIFAR ABOGADO*/
function modificarAbogado()
{
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
		if ($_POST['checkestado']==null) {
			$objabmod->setestadoabog('Activo');
		}
		else{
			$objabmod->setestadoabog('Inactivo');
		}


 if ($_FILES['filefotousu']['tmp_name']==null) /*PREGUNTA SI NO SE ESCOGIO FOTO POR VERDADERO LLAMA A UNA FINCION SIN FOTO*/
   {
   	  if ($objabmod->editarUnAbogadoSinFoto()) 
   	   {
   	  	 echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Abogado Con Exito','success'); </script>";
   	   }
   	   else
   	   {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Abogado ','warning'); </script>";
   	   }
   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
   {
        $foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objabmod->setfotoabog($foto);

	  	if ($objabmod->editarUnAbogadoConFoto()) 
	  	{
	  		echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Abogado Con Exito','success'); </script>";
	  	}
	  	else
	  	{
           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Abogado ','warning'); </script>";
	  	}
   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/



}/*FIN DE LA FUNCION MODIFICAR ABOGADO*/


function modificarContador()
{
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

		if ($_POST['checkestado']==null) 
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
   	  	 echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Contador Con Exito','success'); </script>";
   	   }
   	   else
   	   {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Contador ','warning'); </script>";
   	   }
   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

    else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
   {
        $foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objcontmod->setfotocont($foto);

	  	if ($objcontmod->editarUnContadorConnFoto()) 
	  	{
	  		echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Contador Con Exito','success'); </script>";
	  	}
	  	else
	  	{
           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Contador ','warning'); </script>";
	  	}
   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/

}/*FIN DE LA FUNCION MODIFICAR CONTADOR*/

function modificarProcurador()
{
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

		if ($_POST['checkestado']==null) {
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
   	  	 echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Procurador Con Exito','success'); </script>";
   	   }
   	   else
   	   {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Procurador ','warning'); </script>";
   	   }
   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/

    else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
   {
        $foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objprocmod->setfotoproc($foto);

	  	if ($objprocmod->editarunProcuradorConFoto()) 
	  	{
	  		echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Procurador Con Exito','success'); </script>";
	  	}
	  	else
	  	{
           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Procurador ','warning'); </script>";
	  	}
   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
}/*FIN DE LA FUNCION MODIFICAR PROCURADOR*/

function modificarCliente()
{
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

		if ($_POST['checkestado']==null) {
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
   	  	 echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Cliente Con Exito','success'); </script>";
   	   }
   	   else
   	   {
         echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Cliente ','warning'); </script>";
   	   }
   }/*FIN DEL IF QUE PREGUNTA SI NO SE ESCOGIO FOTO*/



   else/*POR FALSO (OSEA ESCOGIO FOTO LLAMARA A OTRA FUNCION)*/
   {
        $foto=$_FILES['filefotousu']['name'];
		$ruta=$_FILES['filefotousu']['tmp_name'];
		$destino="fotos/fotosusuarios/".$foto;
		copy($ruta,$destino);
	  	$objclimod->setfotocli($foto);

	  	if ($objclimod->editarUnClienteConFoto()) 
	  	{
	  	  echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se modifico El Usuario Cliente Con Exito','success'); </script>";
	  	}
	  	else
	  	{
           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se modifico Usuario Cliente ','warning'); </script>";
	  	}
   }/*FIN DEL ELSE QUE SE EJECUTA CUANDO ESCOGIO FOTO*/
}/*FIN DE LA FUNCION MODIFICAR CLIENTE*/



/**************************FUNCIONES DE ELIMINACION DE TODOS LOS USUARIOS*****************************************************/

function eliminarUnUsuario()
{
	$objusuelim=new Usuario();
	$objusuelim->setid_usuario($_POST['textidusu']);
	$objusuelim->setvisibleusu('No');
	if ($objusuelim->eliminarUsuario()) 
	{
		 echo "<script > setTimeout(function(){  }, 500); swal('EXELENTE','Se Elimino El Usuario Con Exito','success'); </script>";
	}
	else
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Usuario ','warning'); </script>";	
	}
}


function eliminarUnAbogado()
{
	$objabogelim=new Abogado();
	$objabogelim->setid_abogado($_POST['textidabog']);
	$objabogelim->setvisibleabog('No');
	if ($objabogelim->eliminarAbogado()) 
	{
		echo "<script > setTimeout(function(){  }, 500); swal('EXELENTE','Se Elimino El Usuario Abogado Con Exito','success'); </script>";
	}
	else
	{
		 echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Usuario Abogado ','warning'); </script>";
	}
}


function eliminarUnContador()
{
	$objcontelim=new Contador();
	$objcontelim->setid_contador($_POST['textidcont']);
	$objcontelim->setvisiblecont('No');
	if ($objcontelim->eliminarContador()) 
	{
		echo "<script > setTimeout(function(){  }, 500); swal('EXELENTE','Se Elimino El Usuario Contador Con Exito','success'); </script>";
	}
	else
	{
		echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Usuario Contador ','warning'); </script>";
	}
}


function eliminarUnProcurador()
{
	$objprocelim=new Procurador();
	$objprocelim->setid_procurador($_POST['textidproc']);
	$objprocelim->setvisibleproc('No');

	if ($objprocelim->eliminarProcurador()) 
	{
		echo "<script > setTimeout(function(){  }, 500); swal('EXELENTE','Se Elimino El Usuario  Con Exito','success'); </script>";
	}
	else
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Usuario  ','warning'); </script>";
	}
}


function eliminarUnCliente()
{
	$objclielim=new Cliente();
	$objclielim->setid_cliente($_POST['textidcli']);
	$objclielim->setvisiblecli('No');
	if ($objclielim->eliminarCliente()) 
	{
		echo "<script > setTimeout(function(){  }, 500); swal('EXELENTE','Se Elimino El Usuario Cliente Con Exito','success'); </script>";
	}
	else
	{
	  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Elimino El Usuario Cliente','warning'); </script>";	
	}
}

?>