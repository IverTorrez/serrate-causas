<?php
error_reporting(E_ERROR);
include_once('../model/clsplanilla_notificacion.php');

//$accion='crear';


if (isset($_GET['accion'])) 
{
	$accion=$_GET['accion'];
 if ($accion=="crear") 
    {  
	crearPlanillaNotificacion();
    }

 if ($accion=="modificar") 
 {
 	modificarPlanillaNotificacion();
 }

 if ($accion=="eliminar") 
 {
 	eliminarPlanilla();
 }
   
}

function crearPlanillaNotificacion()
{
	      $evento         =ltrim(rtrim($_POST['texteventonotif'])); 
        $emisor         =ltrim(rtrim($_POST['textemisornotif'])); 
        $recept_estatico=ltrim(rtrim($_POST['textreceptorestatico']));
        $descr_recept   =ltrim(rtrim($_POST['textdescriprecept']));
        $asunto         =ltrim(rtrim($_POST['textasunto']));
        $texto          =ltrim(rtrim($_POST['text_textonotif']));
        $nombre_emisor  =ltrim(rtrim($_POST['textnombreemisor']));
	
  if ($asunto!='' and $evento!='' and $texto!='') 
  {
  	   
		 ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;
		 $objab=new Planillas_envio_notificacion();
		 //obtenemos el codigo maximo de planilla
		 $resulmax=$objab->obtenerMaximoCodigo();
		 $filmax=mysqli_fetch_object($resulmax);
		 $cod_planilla=$filmax->max_codigo;
		 if ($cod_planilla<1) 
		 {
		 	$cod_planilla=1;
		 }
		 else
		 {
		 	$cod_planilla=$filmax->max_codigo+1;
		 }

		$objab->setcod_planilla($cod_planilla);
		$objab->setIndicador('A');
		$objab->setFechaProceso($fechoyal);
		$objab->setFecha_proceso_hasta('2050-01-01');
		$objab->set_Sec(1);
		$objab->set_evento($evento);
		$objab->set_tipo_dinamico_estatico($_POST['selecttpreceptor']);
		$objab->set_emisor($emisor);
		$objab->set_receptor_estatico($recept_estatico);
		$objab->set_descripcion_receptor($descr_recept);
		$objab->set_asunto($asunto);
		$objab->set_texto($texto);
		$objab->set_tipo_notificacion($_POST['selecttpnotif']);
		
		$objab->set_estado('A');
		$objab->set_id_usuario_alta($_POST['textidusuario']);
		$objab->set_fecha_alta($concat);
		$objab->set_id_usuario_baja(0);
		$objab->set_fecha_baja('1900-01-01');
    $objab->set_nombre_emisor($nombre_emisor);
		if ($_POST['checkenvianotif']=='null') //pregunta si no lo tikeo, por defecnto sin tickear es activo
		{
			$objab->set_envia_notif(1);//si envia
		}
		else{
			$objab->set_envia_notif(2);//no envia
		}

		
		if ($objab->guardar_planillas_envio_notificacion()) 
		{
			$resultado->error='true';

			/*echo "<script > setTimeout(function(){ location.href='usuarios.php' }, 500); swal('EXELENTE','Se Creo El Usuario Abogado Con Exito','success'); </script>";*/
		}
		else
			{
				$resultado->error='false';
			 /*echo "<script > setTimeout(function(){  }, 2000); swal('ERROR',' No Se Creo El Usuario Abogado ','warning'); </script>";*/
			}
		 
  
  }/*fin del if que pregunta si los campos importantes estan vacios*/
  else
  {
    $resultado->error= 'vacio';	
  }
  
  echo json_encode($resultado);
  die();

  } //fin de la funcion guardar  

//FUNCION QUE MODIFICA UNA REGISTRO DEJANDO HISTORIAL
 function modificarPlanillaNotificacion()
 {
 	      $codigoPlanilla =ltrim(rtrim($_POST['textcodigoplanilla']));
 	      $evento         =ltrim(rtrim($_POST['texteventonotif'])); 
        $emisor         =ltrim(rtrim($_POST['textemisornotif'])); 
        $recept_estatico=ltrim(rtrim($_POST['textreceptorestatico']));
        $descr_recept   =ltrim(rtrim($_POST['textdescriprecept']));
        $asunto         =ltrim(rtrim($_POST['textasunto']));
        $texto          =ltrim(rtrim($_POST['text_textonotif']));
        $tipo_receptor  =ltrim(rtrim($_POST['selecttpreceptor']));
        $tipo_notifi    =ltrim(rtrim($_POST['selecttpnotif']));
        $nombre_emisor  =ltrim(rtrim($_POST['textnombreemisor']));
        if ($_POST['checkenvianotif']=='null') //pregunta si no lo tikeo, por defecnto sin tickear es activo
		{
			$envia_notifi=1;//si envia
		}
		else{
			$envia_notifi=2;//no envia
		}
    $objab=new Planillas_envio_notificacion();
    $resulpla=$objab->mostrarUnaPlanillas_envioNotif_activa($codigoPlanilla);
    $filpla=mysqli_fetch_object($resulpla);


    //PREGUNTAMOS SI LOS DATOS INGRESADOS POR PANTALLA SON LOS MISMOS QUE ESTAN EN LA BASE DE DATOS, 
    //ESTO PARA INSERTAR UNICAMENTE CUANDO HAYA MODIFICACION EN LOS DATOS
    if ($evento         ==$filpla->evento &&
        $emisor         ==$filpla->emisor &&
        $recept_estatico==$filpla->receptor_estatico &&
        $descr_recept   ==$filpla->descripcion_receptor &&
        $asunto         ==$filpla->asunto &&
        $texto          ==$filpla->texto &&
        $tipo_receptor  ==$filpla->tipo_dinamico_estatico &&
        $tipo_notifi    ==$filpla->tipo_notificacion &&
        $envia_notifi   ==$filpla->envia_notif &&
        $nombre_emisor  ==$filpla->nombre_emisor) 
     {
    	$resultado->error='datosiguales';
     }

 else//por falso, osea se va hacer modificacion y una nueva insercion
 	{
      if ($asunto!='' and $evento!='' and $texto!='') 
       {
  	   
		 ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         if ($filpla->fecha_proceso==$fechoyal) 
         {
         	$indicador_mod='N';
         	$fecha_proceso_hasta_mod=$fechoyal;
         	$sec_nuevo_reg=$filpla->sec+1;
         }
         else
         {
         	$indicador_mod='A';

         	$fecha_proceso_hasta_mod=date("Y-m-d",strtotime($fechoyal."- 1 days")); //$fechoyal-1;
         	$sec_nuevo_reg=1;
         }

         //damos de baja el registro para crear otro
         $objab->setIndicador($indicador_mod);
         $objab->setFecha_proceso_hasta($fecha_proceso_hasta_mod);
         $objab->setcod_planilla($codigoPlanilla);
        if ($objab->modRegPlanillaParaHistorial()) 
         {
         	$objab->setcod_planilla($codigoPlanilla);
			$objab->setIndicador('A');
			$objab->setFechaProceso($fechoyal);
			$objab->setFecha_proceso_hasta('2050-01-01');
			$objab->set_Sec($sec_nuevo_reg);
			$objab->set_evento($evento);
			$objab->set_tipo_dinamico_estatico($tipo_receptor);
			$objab->set_emisor($emisor);
			$objab->set_receptor_estatico($recept_estatico);
			$objab->set_descripcion_receptor($descr_recept);
			$objab->set_asunto($asunto);
			$objab->set_texto($texto);
			$objab->set_tipo_notificacion($tipo_notifi);
			
			$objab->set_estado('A');
			$objab->set_id_usuario_alta($_POST['textidusuario']);
			$objab->set_fecha_alta($concat);
			$objab->set_id_usuario_baja(0);
			$objab->set_fecha_baja('1900-01-01');	
		  $objab->set_envia_notif($envia_notifi);//no envia
      $objab->set_nombre_emisor($nombre_emisor);
			
			if ($objab->guardar_planillas_envio_notificacion()) 
			{
				$resultado->error='true';
			}
			else
			{
				$resultado->error='false';		
			}
         }//fin del if que pregunta si se hizo la modificacion en el registro para guardar historial 
         else//por falso, osea no se modifico el registro para guardar historial
         {
           $resultado->error='errorupdate';	
         }


		
		 
  
     }/*fin del if que pregunta si los campos importantes estan vacios*/
     else
     {
       $resultado->error= 'vacio';	
     }

  
  

  }//fin del else, cuando se verifica que los datos ingresados son diferentes a los de la BD
 
 echo json_encode($resultado);
  die();
  }//fin de la funcion modificar

  /**FUNCION PARA ELIMINAR***/
  function eliminarPlanilla()
  {
  	 $codigoPlanilla=$_POST['textcodplanilla'];
  	 $id_usuario_baja=$_POST['textidusuariobaja'];
  	 $objab=new Planillas_envio_notificacion();
     $resulpla=$objab->mostrarUnaPlanillas_envioNotif_activa($codigoPlanilla);
     $filpla=mysqli_fetch_object($resulpla);

     $evento                =$filpla->evento;
     $emisor                =$filpla->emisor;
     $tipo_dinamico_estatico=$filpla->tipo_dinamico_estatico;
     $receptor_estatico     =$filpla->receptor_estatico;
     $descripcion_receptor  =$filpla->descripcion_receptor;
     $asunto                =$filpla->asunto;
     $texto                 =$filpla->texto;
     $tipo_notificacion     =$filpla->tipo_notificacion;
     $envia_notif           =$filpla->envia_notif;
     $id_usuario_alta       =$filpla->id_usuario_alta;
     $fecha_alta            =$filpla->fecha_alta;
     $nombre_emisor         =$filpla->nombre_emisor;

         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         if ($filpla->fecha_proceso==$fechoyal) 
         {
         	$indicador_mod='N';
         	$fecha_proceso_hasta_mod=$fechoyal;
         	$sec_nuevo_reg=$filpla->sec+1;
         }
         else
         {
         	$indicador_mod='A';

         	$fecha_proceso_hasta_mod=date("Y-m-d",strtotime($fechoyal."- 1 days")); //$fechoyal-1;
         	$sec_nuevo_reg=1;
         }

     /*MODIFICA EL REGISTRO PARA DEJAR HISTORIAL*/
     $objab->setIndicador($indicador_mod);
     $objab->setFecha_proceso_hasta($fecha_proceso_hasta_mod);
     $objab->setcod_planilla($codigoPlanilla);
     if ($objab->modRegPlanillaParaHistorial()) 
     {
     	    $objab->setcod_planilla($codigoPlanilla);
			$objab->setIndicador('A');
			$objab->setFechaProceso($fechoyal);
			$objab->setFecha_proceso_hasta('2050-01-01');
			$objab->set_Sec($sec_nuevo_reg);
			$objab->set_evento($evento);
			$objab->set_tipo_dinamico_estatico($tipo_dinamico_estatico);
			$objab->set_emisor($emisor);
			$objab->set_receptor_estatico($receptor_estatico);
			$objab->set_descripcion_receptor($descripcion_receptor);
			$objab->set_asunto($asunto);
			$objab->set_texto($texto);
			$objab->set_tipo_notificacion($tipo_notificacion);
			
			$objab->set_estado('N');
			$objab->set_id_usuario_alta($id_usuario_alta);
			$objab->set_fecha_alta($fecha_alta);
			$objab->set_id_usuario_baja($id_usuario_baja);
			$objab->set_fecha_baja($concat);	
		  $objab->set_envia_notif($envia_notif);
      $objab->set_nombre_emisor($nombre_emisor);
			
			if ($objab->guardar_planillas_envio_notificacion()) 
			{
				$resultado->error='true';
			}
			else
			{
				$resultado->error='false';		
			}
     }
     else
      {
     	$resultado->error='mod';	
     }

   echo json_encode($resultado);
  die();
  }//FIN DE FUNCION ELIMINAR


	  

?>