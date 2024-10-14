<?php
error_reporting(E_ERROR);
if (isset($_POST['btnguardarinfoposta'])) 
{
	if ($_POST['textestadopostaCausa']=='vacia') 
	{
		guardarinformedePostacausa();
	}
	else
	{
	
	  modificarInformeDePostaCausa();
	}
	
}


if (isset($_POST['btneliminarinforme'])) 
{
	eliminarinformedepostacausa();
}

function guardarinformedePostacausa()
{
	$idcausa=$_POST['textidcausa'];
    $idposta=$_POST['textidpostacausa'];
    $nuevoidposta=$idposta-1;

    $objPostaCausa1=new PostaCausa();
   $resulPc1=$objPostaCausa1->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc1=mysqli_fetch_object($resulPc1);
   /*PREGUNTA SI LA POSTA ANTERIOR ESTA VACIA*/
   $id_postacausa_anterior=$filpc1->id_postacausa;/*ES DATO ES EL ID_POSTACAUSA ANTERIOR, SI LO UBIERA*/
   if ($filpc1->estado=='vacia')/*pregunta si la posta anterior esta vacia, (si ubiera post anterior,puede que no ayga)*/ 
   {
   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro,Porque La Anterior Posta Esta Sin Informe ','warning');</script >";
   }
   else/*por falso, osea no esta vacia la posta anterior, o no hay posta anterior, procede a hacer el registro*/
   {
   	   /*CODIGO PARA VERIFICAR QUE EL INFORME DE LA POSTA ANTERIOR NO SEA UN TRUNCAMIENTO*/
   	   $oblinfop=new InformePosta();
	   $resultinfPC_anterior=$oblinfop->muestraTodoelInformeDePosta($id_postacausa_anterior);/*muestra el informe de LA ANTERIOR postacasa, si ubiera*/
	   $filinforAnterior=mysqli_fetch_object($resultinfPC_anterior);
	   /* HASTA AQUI CODIGO PARA VERIFICAR QUE EL INFORME DE LA POSTA ANTERIOR NO SEA UN TRUNCAMIENTO*/
       if ($filinforAnterior->id_tipoposta>1)/*PREGUNTA SI ES TIPO DE POSTA ES MAYOR A 1 (SI ES MAYOR A 1 ES TRUNCAMIENTO, NO SE PODRA REGISTRAR EL INFORME DE LA ACTUAL POSTA )*/ 
       {
       	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro,Porque La Anterior Posta Esta Con Un Tipo De Truncamiento','warning');</script >";
       }
       else/*POR FALSO EL TIPO DE POSTA NO ES TRUNCAMIENTO O NO EXISTE (SE HARA EL NUEVO REGISTRO)*/
       {



		   /*DESDE AQUI COMPROBARA QUE EL ID_POSTACAUSA NO TENGA REGITROS EN LA TABLA INFORMEPOSTS*/
		   $obinfop=new InformePosta();
		   $resulveri=$obinfop->muestraTodoelInformeDePosta($_POST['textidpostacausa']);/*muestra el informe de esa postacasa, si ubiera*/
		   $filinfor=mysqli_fetch_object($resulveri);
		   /*PREGUNTA SI EL ID_INFORMEPOSTA ESTA VACIA(OSEA SI NO HAY REGISTROS) POR VERDADERO DEJARA REGISTRAR EL INFORME*/
		   if ($filinfor->id_informeposta=='') 
		   {
		   	
				$objinforp=new InformePosta();
				$objinforp->setfojainformep($_POST['textfoja']);
				$objinforp->setfechainforme($_POST['datefechainst']);
				$objinforp->setcalculogasto(00000);/*FALTA SACAR EL CALCULO DE GASTO ******************************************/
				$objinforp->setinformehonora($_POST['texthonorarios']);
				$objinforp->setestadoinf('escrito');
				$objinforp->setid_postacausainf($_POST['textidpostacausa']);
				$objinforp->setid_tipopostainf($_POST['selecttpposta']);
			   
				
				if ($objinforp->guardarinformeposta()) 
				{
					$obpostacaus=new PostaCausa();
					$obpostacaus->setid_postacausa($_POST['textidpostacausa']);
					$obpostacaus->setestadopostacausa('llena');

					if ($obpostacaus->cambiarestadoPostaCausa()) 
					{
						echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Guardo El Registro Con Exito','success');</script >";
					}
					else
					{
			          echo "<script >setTimeout(function(){  }, 2000); swal('ERROR FATAL','No Se Registraron Todos Los Registros, Comuniquese Con El Ingeniero e Informe Del Problema','warning');</script >";
					}
				}
				else
				{
			      echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro ','warning');</script >";
				}
			}/*fin del if que pregunta si esta vacia el id_informeposta*/
			else/*por falso (osea ya hay registros de esa postacausa) mostrara un mensaje diciendo que ya tiene registro y no se puede crear mas*/
			{
		      echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro, Porque Ya Se Registro Anteriormente  ','warning');</script >";
			}
	    }/*FIN DEL ELSE CUANDO EL TIPO DE POSTA NO ES UN TRUNCAMIENTO (O NO EXISTE)*/

	}/*FIN DEL ELSE, CUANDO LA POSTA ANTERIOR NO ESTA VACIA (SI UBIERA POSTA ANTERIOR)*/
}/*FIN DE LA FUNCION */


function modificarInformeDePostaCausa()
{
	
	/*FUNCION PARA VERIFICAR QUE LA SIGUIENTE POSTA DE ESTA CAUSA ESTE VACIA O NO ESTE LLENA*/
	$idcausa=$_POST['textidcausa'];
   $idposta=$_POST['textidpostacausa'];
   $nuevoidposta=$idposta+1;
 
   $objPostaCausa=new PostaCausa();
   $resulPc=$objPostaCausa->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc=mysqli_fetch_object($resulPc);
   if ($filpc->estado=='llena') /*PREGUNTA SI LA SIGUIENTE POSTA ESTA LLENA (SI UBIERA SIGUIENTE POSTA)*/
   {
   	   echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Registro,Porque la Siguiente Posta Ya Tiene Informe','warning');</script >";	
   }
   else/*POR FALSO (NO ESTA LLENA O NO HAY POSTA, SE MODIFICA EL REGISTRO)*/
   {
     	$objinforp1=new InformePosta();
		$objinforp1->setfojainformep($_POST['textfoja']);
		$objinforp1->setfechainforme($_POST['datefechainst']);
		$objinforp1->setcalculogasto(00000);
		$objinforp1->setinformehonora($_POST['texthonorarios']);
		$objinforp1->setid_tipopostainf($_POST['selecttpposta']);

		$objinforp1->setid_informeposta($_POST['textidinformeposta']);
		if ($objinforp1->modificarInformeDePosta()) 
		{
			echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico El Registro Con Exito','success');</script >";
		}
		else
		{
			echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Registro ','warning');</script >";
		}
   }


	
}/*fin de la funcion modificar posta inicio*/



function eliminarinformedepostacausa()
{
	/*FUNCION PARA VERIFICAR QUE LA SIGUIENTE POSTA DE ESTA CAUSA ESTE VACIA O NO ESTE LLENA (SI UBIERA POSTA SIGUIENTE)*/
	$idcausa=$_POST['textidcausa'];
   $idposta=$_POST['textidpostacausa'];
   $nuevoidposta=$idposta+1;
 
   $objPostaCausa=new PostaCausa();
   $resulPc=$objPostaCausa->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc=mysqli_fetch_object($resulPc);
   if ($filpc->estado=='llena') /*PREGUNTA SI LA SIGUIENTE POSTA ESTA LLENA (SI UBIERA SIGUIENTE POSTA)*/
   {
   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino La Instancia, Porque La Posta Siguiente Tiene Registros  ','warning');</script >";
   }
   else/*POR FALSO ,OSEA NO ESTA LLENA LA POSTA SIGUIENTE O NO HAY POSTA SIGUIENTE (HARA LA ELIMINACION)*/
   {

	   $objinforp2=new InformePosta();
	   $objinforp2->setid_informeposta($_POST['textidinformeposta']);
	   if ($objinforp2->eliminarUnInformedePostaCausa()) 
	   {
	   	    $obpostacaus1=new PostaCausa();
			$obpostacaus1->setid_postacausa($_POST['textidpostacausa']);
			$obpostacaus1->setestadopostacausa('vacia');

			if ($obpostacaus1->cambiarestadoPostaCausa()) 
			{
				echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino La Instancia Con Exito','success');</script >";
			}
			else
			{
			 echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','Algo Salio Mal, Comuniquese Con EL Desarrollador e Informe del Problema','warning');</script >";
			}
	   }
	   else
	   {
	   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino La Instancia ','warning');</script >";
	   }
	}/*FIN DEL ELSE QUE EJECULA ELIMINACION DEL INFORME DE LA POSTA*/
}/*FIN DE LA FUNCION ELIMINAR INFORME DE POSTA*/









/*******************************FUNCIONES PARA LA POSTA CERO (POSTA INICIO)*****************************************************/
if (isset($_POST['btnguardarinfopostaini'])) 
{
	if ($_POST['textestadopostaCausaini']=='vacia') 
	{
		guardarinformedePostacausaIni();
	}
	else
	{
	
	  modificarInformeDePostaCausaIni();
	}
	
}

if (isset($_POST['btneliminarinformeini'])) 
{
	eliminarinformedepostacausaIni();
}

if (isset($_POST['btnguardarinfopostainitrunca'])) 
{
	guardarTruncamientodeInformePosta();
}

function guardarinformedePostacausaIni()
{
	$idcausa=$_POST['textidcausa'];
    $idposta=$_POST['textidpostacausaini'];
    $nuevoidposta=$idposta-1;

    $objPostaCausa1=new PostaCausa();
   $resulPc1=$objPostaCausa1->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc1=mysqli_fetch_object($resulPc1);
   /*PREGUNTA SI LA POSTA ANTERIOR ESTA VACIA*/
   $id_postacausa_anterior=$filpc1->id_postacausa;/*ES DATO ES EL ID_POSTACAUSA ANTERIOR, SI LO UBIERA*/
   if ($filpc1->estado=='vacia')/*pregunta si la posta anterior esta vacia, (si ubiera post anterior,puede que no ayga)*/ 
   {
   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro,Porque La Anterior Posta Esta Sin Informe ','warning');</script >";
   }
   else/*por falso, osea no esta vacia la posta anterior, o no hay posta anterior, procede a hacer el registro*/
   {
   	   /*CODIGO PARA VERIFICAR QUE EL INFORME DE LA POSTA ANTERIOR NO SEA UN TRUNCAMIENTO*/
   	   $oblinfop=new InformePosta();
	   $resultinfPC_anterior=$oblinfop->muestraTodoelInformeDePosta($id_postacausa_anterior);/*muestra el informe de LA ANTERIOR postacasa, si ubiera*/
	   $filinforAnterior=mysqli_fetch_object($resultinfPC_anterior);
	   /* HASTA AQUI CODIGO PARA VERIFICAR QUE EL INFORME DE LA POSTA ANTERIOR NO SEA UN TRUNCAMIENTO*/
       if ($filinforAnterior->id_tipoposta>1)/*PREGUNTA SI ES TIPO DE POSTA ES MAYOR A 1 (SI ES MAYOR A 1 ES TRUNCAMIENTO, NO SE PODRA REGISTRAR EL INFORME DE LA ACTUAL POSTA )*/ 
       {
       	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro,Porque La Anterior Posta Esta Con Un Tipo De Truncamiento','warning');</script >";
       }
       else/*POR FALSO EL TIPO DE POSTA NO ES TRUNCAMIENTO O NO EXISTE (SE HARA EL NUEVO REGISTRO)*/
       {



		   /*DESDE AQUI COMPROBARA QUE EL ID_POSTACAUSA NO TENGA REGITROS EN LA TABLA INFORMEPOSTS*/
		   $obinfop=new InformePosta();
		   $resulveri=$obinfop->muestraTodoelInformeDePosta($_POST['textidpostacausaini']);/*muestra el informe de esa postacasa, si ubiera*/
		   $filinfor=mysqli_fetch_object($resulveri);
		   /*PREGUNTA SI EL ID_INFORMEPOSTA ESTA VACIA(OSEA SI NO HAY REGISTROS) POR VERDADERO DEJARA REGISTRAR EL INFORME*/
		   if ($filinfor->id_informeposta=='') 
		   {
		   	
				$objinforp=new InformePosta();
				$objinforp->setfojainformep($_POST['textfojaini']);
				$objinforp->setfechainforme($_POST['datefechainstini']);
				$objinforp->setcalculogasto(00000);/*FALTA SACAR EL CALCULO DE GASTO ******************************************/
				$objinforp->setinformehonora($_POST['texthonorariosini']);
				$objinforp->setestadoinf('escrito');
				$objinforp->setid_postacausainf($_POST['textidpostacausaini']);
				$objinforp->setid_tipopostainf($_POST['selecttppostaini']);
			   
				
				if ($objinforp->guardarinformeposta()) 
				{
					$obpostacaus=new PostaCausa();
					$obpostacaus->setid_postacausa($_POST['textidpostacausaini']);
					$obpostacaus->setestadopostacausa('llena');

					if ($obpostacaus->cambiarestadoPostaCausa()) 
					{
						echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Guardo El Registro Con Exito','success');</script >";
					}
					else
					{
			          echo "<script >setTimeout(function(){  }, 2000); swal('ERROR FATAL','No Se Registraron Todos Los Registros, Comuniquese Con El Ingeniero e Informe Del Problema','warning');</script >";
					}
				}
				else
				{
			      echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro ','warning');</script >";
				}
			}/*fin del if que pregunta si esta vacia el id_informeposta*/
			else/*por falso (osea ya hay registros de esa postacausa) mostrara un mensaje diciendo que ya tiene registro y no se puede crear mas*/
			{
		      echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Guardo El Registro, Porque Ya Se Registro Anteriormente  ','warning');</script >";
			}
	    }/*FIN DEL ELSE CUANDO EL TIPO DE POSTA NO ES UN TRUNCAMIENTO (O NO EXISTE)*/

	}/*FIN DEL ELSE, CUANDO LA POSTA ANTERIOR NO ESTA VACIA (SI UBIERA POSTA ANTERIOR)*/
}/*FIN DE LA FUNCION */


function modificarInformeDePostaCausaIni()
{
	
	/*FUNCION PARA VERIFICAR QUE LA SIGUIENTE POSTA DE ESTA CAUSA ESTE VACIA O NO ESTE LLENA*/
	$idcausa=$_POST['textidcausa'];
   $idposta=$_POST['textidpostacausaini'];
   $nuevoidposta=$idposta+1;
 
   $objPostaCausa=new PostaCausa();
   $resulPc=$objPostaCausa->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc=mysqli_fetch_object($resulPc);
   if ($filpc->estado=='llena') /*PREGUNTA SI LA SIGUIENTE POSTA ESTA LLENA (SI UBIERA SIGUIENTE POSTA)*/
   {
   	   echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Registro,Porque la Siguiente Posta Ya Tiene Informe','warning');</script >";	
   }
   else/*POR FALSO (NO ESTA LLENA O NO HAY POSTA, SE MODIFICA EL REGISTRO)*/
   {
     	$objinforp1=new InformePosta();
		$objinforp1->setfojainformep($_POST['textfojaini']);
		$objinforp1->setfechainforme($_POST['datefechainstini']);
		$objinforp1->setcalculogasto(00000);
		$objinforp1->setinformehonora($_POST['texthonorariosini']);
		$objinforp1->setid_tipopostainf($_POST['selecttppostaini']);

		$objinforp1->setid_informeposta($_POST['textidinformepostaini']);
		if ($objinforp1->modificarInformeDePosta()) 
		{
			echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico El Registro Con Exito','success');</script >";
		}
		else
		{
			echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Registro ','warning');</script >";
		}
   }


	
}/*fin de la funcion modificar posta inicio*/


function eliminarinformedepostacausaIni()
{
	/*FUNCION PARA VERIFICAR QUE LA SIGUIENTE POSTA DE ESTA CAUSA ESTE VACIA O NO ESTE LLENA (SI UBIERA POSTA SIGUIENTE)*/
	$idcausa=$_POST['textidcausa'];
   $idposta=$_POST['textidpostacausaini'];
   $nuevoidposta=$idposta+1;
 
   $objPostaCausa=new PostaCausa();
   $resulPc=$objPostaCausa->mostrarUnaPostaCausa($nuevoidposta,$idcausa);
   $filpc=mysqli_fetch_object($resulPc);
   if ($filpc->estado=='llena') /*PREGUNTA SI LA SIGUIENTE POSTA ESTA LLENA (SI UBIERA SIGUIENTE POSTA)*/
   {
   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino La Instancia, Porque La Posta Siguiente Tiene Registros  ','warning');</script >";
   }
   else/*POR FALSO ,OSEA NO ESTA LLENA LA POSTA SIGUIENTE O NO HAY POSTA SIGUIENTE (HARA LA ELIMINACION)*/
   {

	   $objinforp2=new InformePosta();
	   $objinforp2->setid_informeposta($_POST['textidinformepostaini']);
	   if ($objinforp2->eliminarUnInformedePostaCausa()) 
	   {
	   	    $obpostacaus1=new PostaCausa();
			$obpostacaus1->setid_postacausa($_POST['textidpostacausaini']);
			$obpostacaus1->setestadopostacausa('vacia');

			if ($obpostacaus1->cambiarestadoPostaCausa()) 
			{
				echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino La Instancia Con Exito','success');</script >";
			}
			else
			{
			 echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','Algo Salio Mal, Comuniquese Con EL Desarrollador e Informe del Problema','warning');</script >";
			}
	   }
	   else
	   {
	   	echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino La Instancia ','warning');</script >";
	   }
	}/*FIN DEL ELSE QUE EJECULA ELIMINACION DEL INFORME DE LA POSTA*/
}/*FIN DE LA FUNCION ELIMINAR INFORME DE POSTA INICIO (POSTA CERO)*/


function guardarTruncamientodeInformePosta()
{
	$objinfposatrunca=new InformePosta();
	$objinfposatrunca->setid_informeposta($_POST['textidinformepostaini']);
	$objinfposatrunca->setid_tipopostainf($_POST['selecttppostainitruna']);
	$objinfposatrunca->setfojatrunca($_POST['textfojainitruca']);
	$objinfposatrunca->setfechatrunca($_POST['datefechainstinitrunca']);
	$objinfposatrunca->setinformhonotrunca($_POST['texthonorariosinitrunca']);

	if ($objinfposatrunca->guardarTruncamientoDeInformePosta()) 
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Registro El Truncamiento Con Exito','success');</script >";
	}
	else
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Registro El Truncamiento','warning');</script >";
	}
}

/***********FUNCIONES PARA MODIFICAR O ELIMINAR UN TRUNCAMNIENTO**************************/
if (isset($_POST['btnguardarinfopostatruna'])) 
{
	modificarTruncamiento();

}

if (isset($_POST['btneliminarinformetruna'])) 
{
	eliminarTruncamiento();
}

function modificarTruncamiento()
{
	$objinfposatrunca=new InformePosta();
	$objinfposatrunca->setid_informeposta($_POST['textidinformepostatruna']);
	$objinfposatrunca->setid_tipopostainf($_POST['selecttppostatrunca']);
	$objinfposatrunca->setfojatrunca($_POST['textfojatruna']);
	$objinfposatrunca->setfechatrunca($_POST['datefechainsttrunca']);
	$objinfposatrunca->setinformhonotrunca($_POST['texthonorariostrunca']);

	if ($objinfposatrunca->guardarTruncamientoDeInformePosta()) 
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Modifico El Truncamiento Con Exito','success');</script >";
	}
	else
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Modifico El Truncamiento','warning');</script >";
	}
}

function eliminarTruncamiento()
{
	$objinfposatrunca=new InformePosta();
	$objinfposatrunca->setid_informeposta($_POST['textidinformepostatruna']);
	$objinfposatrunca->setid_tipopostainf(1);
	$objinfposatrunca->setfojatrunca('');
	$objinfposatrunca->setfechatrunca('');
	$objinfposatrunca->setinformhonotrunca('');

	if ($objinfposatrunca->guardarTruncamientoDeInformePosta()) 
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Elimino El Truncamiento Con Exito','success');</script >";
	}
	else
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Elimino El Truncamiento','warning');</script >";
	}

}


/****FUNCIONES PARA LOS TRUNCAMIENTOS DE LAS DEMAS POSTAS  OSEA LAS POSTAS NORMALES QUE NO SON INICIO********/
if (isset($_POST['btnguardartruncademeaspostas'])) 
{
	guardarTruncamientoDemasPostas();

}

function guardarTruncamientoDemasPostas()
{
	$objinfposatruncademasp=new InformePosta();
	$objinfposatruncademasp->setid_informeposta($_POST['textidinformeposta']);
	$objinfposatruncademasp->setid_tipopostainf($_POST['selecttppostatruncademasp']);
	$objinfposatruncademasp->setfojatrunca($_POST['textfojatruncademasp']);
	$objinfposatruncademasp->setfechatrunca($_POST['datefechainsttruncademasp']);
	$objinfposatruncademasp->setinformhonotrunca($_POST['texthonorariostruncademasp']);

	if ($objinfposatruncademasp->guardarTruncamientoDeInformePosta()) 
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('EXELENTE','Se Registro El Truncamiento Con Exito','success');</script >";
	}
	else
	{
		echo "<script >setTimeout(function(){  }, 2000); swal('ERROR','No Se Registro El Truncamiento','warning');</script >";
	}
}

?>