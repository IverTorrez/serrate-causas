<?php
session_start();
include_once("../model/clsusuario.php");
include_once("../model/clsabogado.php");
include_once("../model/clscliente.php");
include_once("../model/clscontador.php");

include_once("../model/clsprocurador.php");

if(isset($_POST))
{ 
	$user= ($_POST["usuario"]);
	$pass= ($_POST["password"]);
	//$captcha = base64_encode($_POST["captcha"]);
    //$numero_captcha = $_SESSION['captcha'];

	/*USUARIO ADMINISTRADOR*/
	$usuario=new Usuario(); 
	$usuario->setnombreloginusu($user);
	$usuario->setclaveusu($pass);
    $resul1=$usuario->loginUsuario();
    $datosUsuarioAdm=array();

    /*ABOGADO*/
	$abogado=new Abogado(); 
	$abogado->setnombloginabog($user);
	$abogado->setclaveabog($pass);
    $resul2=$abogado->loginAbogado();
    $datosAbogado=array();

    /*CLIENTE*/
	$cliente=new Cliente(); 
	$cliente->setnomblogincli($user);
	$cliente->setclavecli($pass);
    $resul3=$cliente->loginCliente();
    $datosCliente=array();

    /*CONTADOR*/
	$contador=new Contador(); 
	$contador->setnomblogincont($user);
	$contador->setclavecont($pass);
    $resul4=$contador->loginContador();
    $datosContador=array();
    /*PROCURADOR Y PROCURADOR MAESTRO*/
    $procurador=new Procurador(); 
	$procurador->setnombloginproc($user);
	$procurador->setclaveproc($pass);
    $resul5=$procurador->loginProcurador();
    $datosProcurador=array();
  
/*------------------------------------------------------------------------------*/
  if($user=="")
  {
	      echo "¡ERROR! caracteres de captcha no coinciden";
  }
  else
  {

 
	if($data=mysqli_fetch_array($resul1))
	{
		/*CREAR LA SESION*/
		if ($data['tipousuario']=='Administrador') 
		{
			$datosUsuarioAdm["id_usuario"]=$data["id_usuario"];
			$datosUsuarioAdm["nombreusuario"]=$data["nombreusuario"];
			$datosUsuarioAdm["apellidosusuario"]=$data["apellidosusuario"];
	        $_SESSION["useradmin"]=$datosUsuarioAdm;

	        echo "administrador";
		}
		else
		{
			$datosUsuarioObs["id_usuario"]=$data["id_usuario"];
			$datosUsuarioObs["nombreusuario"]=$data["nombreusuario"];
			$datosUsuarioObs["apellidosusuario"]=$data["apellidosusuario"];
	        $_SESSION["userObs"]=$datosUsuarioObs;

	        echo "observador";

		}
		

		/*ENVIA EL TIPO DE USUARIO COMO RESPUESTA (3=ADMINISTRADOR)*/
			
		/*echo "<script>alert('$captcha')</script>";*/

	}

	else
	{
		if($datoAbgd=mysqli_fetch_array($resul2))
	    {
		
		
		/*CREAR LA SESION*/
		$datosAbogado["id_abogado"]=$datoAbgd["id_abogado"];
		$datosAbogado["nombreabog"]=$datoAbgd["nombreabog"];
		$datosAbogado["apellidoabog"]=$datoAbgd["apellidoabog"];
        $_SESSION["abogado"]=$datosAbogado;

		/*ENVIA EL ABOGADO COMO RESPUESTA (ID)*/
		echo "abogado"; 
	   }


	   else
	   {
	   	if($datocli=mysqli_fetch_array($resul3))
	    {
		
		
		/*CREAR LA SESION*/
		$datosCliente["id_cliente"]=$datocli["id_cliente"];
		$datosCliente["nombrecli"]=$datocli["nombrecli"];
		$datosCliente["apellidocli"]=$datocli["apellidocli"];
        $_SESSION["cliente"]=$datosCliente;

		/*ENVIA EL ABOGADO COMO RESPUESTA (ID)*/
		echo "cliente";
	   }

	   else
	     { 
	  	   if($datocont=mysqli_fetch_array($resul4))
	         {
		
		
		     /*CREAR LA SESION*/
		   $datosContador["id_contador"]=$datocont["id_contador"];
		   $datosContador["nombrecont"]=$datocont["nombrecont"];
		   $datosContador["apellidocont"]=$datocont["apellidocont"];
           $_SESSION["contador"]=$datosContador;
  
		   /*ENVIA EL ABOGADO COMO RESPUESTA (ID)*/
		   echo "contador";
	       }

		   else
		     { 
		     	if($datoproc=mysqli_fetch_array($resul5))
			    {
				  

					 if ($datoproc["tipoproc"]=="ProcuradorMaestro") 
					 {
					 	 /*CREAR LA SESION*/
						 $datosProcuradorMaestro["id_procurador"]=$datoproc["id_procurador"];
						 $datosProcuradorMaestro["nombreproc"]=$datoproc["nombreproc"];
						 $datosProcuradorMaestro["apellidoproc"]=$datoproc["apellidoproc"];
						 $_SESSION["procuradormaestro"]=$datosProcuradorMaestro;
						  /*ENVIA EL PROCURADOR COMO RESPUESTA (ID)*/
						 echo "procuradormaestro";
					 }
					 else
					 {
					 	   /*CREAR LA SESION*/
						 $datosProcurador["id_procurador"]=$datoproc["id_procurador"];
						 $datosProcurador["nombreproc"]=$datoproc["nombreproc"];
						 $datosProcurador["apellidoproc"]=$datoproc["apellidoproc"];
						 $_SESSION["procurador"]=$datosProcurador;
						 /*ENVIA EL PROCURADOR COMO RESPUESTA (ID)*/
						 echo "procurador";
					 }
		         
			     }
			      else
			      {
			      	echo "¡ERROR! el usuario no se encuentra en la base de datos";
			      }
		  	   	  	
		     }	

	     }

	   }
	}
 }

}
	
	/*LIBERAR RESULTADOS DE MEMORIA(BASE DE DATOS)*/
	mysqli_free_result($resul1);
	mysqli_free_result($resul2);
	mysqli_free_result($resul3);
	mysqli_free_result($resul4);
	mysqli_free_result($resul5);
?>
