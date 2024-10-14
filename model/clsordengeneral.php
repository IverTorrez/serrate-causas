<?php
include_once('clsconexion.php');
class OrdenGeneral extends Conexion{
	private $id_orden;
	private $informacion;
	private $documentacion;
	private $fechainiorden;
	private $fechafinorden;
	private $horainiorden;
	private $horafinorden;
	private $fechagiroorden;
	private $plazohorasorden;
	private $fecharecepcion; 
	private $estadoorden;
	private $calificacion;
	private $prioridadorden;
	private $fechacierreorden;
	private $id_causa;
	private $id_procurador;
	private $id_prioridad;
	private $tiporden;
	private $visible;
	private $infosolotexto;
	private $docsolotexto;
	private $fechainibandera;
	private $notificadoemail;
	private $lugar_ejecucion;
	private $sugerencia_presupuesto;


	public function OrdenGeneral()
	{
		parent::Conexion();
		$this->id_orden=0;
		$this->informacion="";
		$this->documentacion="";
		$this->fechainiorden="";
		$this->fechafinorden="";
		$this->horainiorden="";
		$this->horafinorden="";
		$this->fechagiroorden="";
		$this->plazohorasorden="";
		$this->fecharecepcion="";
		$this->estadoorden="";
		$this->calificacion="";
		$this->prioridadorden="";
		$this->fechacierreorden="";
		$this->id_causa=0;
		$this->id_procurador=0;
		$this->id_prioridad=0;
		$this->tiporden="";
		$this->visible="";
		$this->infosolotexto="";
		$this->docsolotexto="";
		$this->fechainibandera="";
		$this->notificadoemail="";
		$this->lugar_ejecucion="";
		$this->sugerencia_presupuesto="";
	}

	public function setid_orden($valor)
	{
		$this->id_orden=$valor;
	}
	public function getid_orden()
	{
		return $this->id_orden;
	}
	public function setinformacion($valor)
	{
		$this->informacion=$valor;
	}
	public function getinformacion()
	{
		return $this->informacion;
	}
	public function setdocumentacion($valor)
	{
		$this->documentacion=$valor;
	}
	public function getdocumentacion()
	{
		return $this->documentacion;
	}
	public function setfechainiorden($valor)
	{
		$this->fechainiorden=$valor;
	}
	public function getfechainiorden()
	{
		return $this->fechainiorden;
	}
	public function setfechafinorden($valor)
	{
		$this->fechafinorden=$valor;
	}
	public function getfechafinorden()
	{
		return $this->fechafinorden;
	}
	public function sethorainiorden($valor)
	{
		$this->horainiorden=$valor;
	}
	public function gethorainiorden()
	{
		return $this->horainiorden;
	}

	public function sethorafinorden($valor)
	{
		$this->horafinorden=$valor;
	}
	public function gethorafinorden()
	{
		return $this->horafinorden;
	}
	public function setfechagiro($valor)
	{
		$this->fechagiroorden=$valor;
	}
	public function getfechagiro()
	{
		return $this->fechagiroorden;
	}
	public function setplazohoras($valor)
	{
		$this->plazohorasorden=$valor;
	}
	public function getplazohoras()
	{
		return $this->plazohorasorden;
	}
	public function setfecharecepcion($valor)
	{
		$this->fecharecepcion=$valor;
	}
	public function getfecharecepcion()
	{
		return $this->fecharecepcion;
	}

	public function setestadoorden($valor)
	{
		$this->estadoorden=$valor;
	}
	public function getestadoorden()
	{
		return $this->estadoorden;
	}
	public function setcalificacion($valor)
	{
		$this->calificacion=$valor;
	}
	public function getcalificacion()
	{
		return $this->calificacion;
	}



	public function setprioridaorden($valor)
	{
		$this->prioridadorden=$valor;
	}
	public function getprioridadorden()
	{
		return $this->prioridadorden;
	}
	public function setfechacierre($valor)
	{
		$this->fechacierreorden=$valor;
	}
	public function getfechacierre()
	{
		return $this->fechacierreorden;
	}
	public function setid_causaorden($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causaorden()
	{
		return $this->id_causa;
	}

	public function setid_procuradororden($valor)
	{
		$this->id_procurador=$valor;
	}
	public function getid_procuradororden()
	{
		return $this->id_procurador;
	}
	public function setid_prioridadorden($valor)
	{
		$this->id_prioridad=$valor;
	}
	public function getid_prioridadorden()
	{
		return $this->id_prioridad;
	}

	public function settiporden($valor)
	{
		$this->tiporden=$valor;
	}
	public function gettiporden()
	{
		return $this->tiporden;
	}

	public function setvisible($valor)
	{
		$this->visible=$valor;
	}
	public function getvisible()
	{
		return $this->visible;
	}

	public function setinfosolotexto($valor)
	{
		$this->infosolotexto=$valor;
	}
	public function getinfosolotexto()
	{
		return $this->infosolotexto;
	}

	public function setdocsolotexto($valor)
	{
		$this->docsolotexto=$valor;
	}
	public function getdocsolotexto()
	{
		return $this->docsolotexto;
	}

	public function setfechainibandera($valor)
	{
		$this->fechainibandera=$valor;
	}
	public function getfechainibandera()
	{
		return $this->fechainibandera;
	}
	
	public function set_notificadoemail($valor)
	{
		$this->notificadoemail=$valor;
	}
    public function get_notificadoemail()
    {
    	return $this->notificadoemail;
    }
    
    public function set_lugar_ejecucion($valor)
	{
		$this->lugar_ejecucion=$valor;
	}
    public function get_lugar_ejecucion()
    {
    	return $this->lugar_ejecucion;
    }
    
    public function set_sugerencia_presupuesto($valor)
	{
		$this->sugerencia_presupuesto=$valor;
	}
    public function get_sugerencia_presupuesto()
    {
    	return $this->sugerencia_presupuesto;
    }

	public function guardarorden()
	{
		$sql="INSERT INTO ordengeneral(informacion,documentacion,fecha_inicio_orden,fecha_fin_orden,hora_inicio,hora_fin,fecha_giro,plazo_hora,fecha_recepcion,estado_orden,calificacion_todo,prioridad,fecha_cierre,id_causa,id_procurador,id_prioridad,tipoorden,visible,infosolotexto,docsolotexto,fecha_inibandera,notificado_email,lugar_ejecucion,sugerencia_presupuesto) VALUES('$this->informacion','$this->documentacion','$this->fechainiorden','$this->fechafinorden','$this->horainiorden','$this->horafinorden','$this->fechagiroorden','$this->plazohorasorden','$this->fecharecepcion','$this->estadoorden','$this->calificacion','$this->prioridadorden','$this->fechacierreorden','$this->id_causa','$this->id_procurador','$this->id_prioridad','$this->tiporden','$this->visible','$this->infosolotexto','$this->docsolotexto','$this->fechainibandera','$this->notificadoemail','$this->lugar_ejecucion','$this->sugerencia_presupuesto')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	public function listarorden()
	{
		$sql="SELECT *FROM ordengeneral";
		return parent::ejecutar($sql); 
	}
   //ESTA FUNCION SE USA PARA SACAR EL ID DE LA ULTIMA ORDEN,PARA ASI INSERTAR LA TABLACOTIZACION
	public function listarultimaorden($cod)
	{
		$sql="SELECT max(id_orden) as ultorden FROM ordengeneral WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}
    
    //ESTA FUNCION SE USA PARA SACAR EL ID DE LA ULTIMA ORDEN que giro el abogado,PARA ASI INSERTAR LA TABLACOTIZACION
	public function listarultimaordenDeAbogado($cod)
	{
		$sql="SELECT max(id_orden) as ultorden FROM ordengeneral WHERE id_causa=$cod AND tipoorden='Normal'";
		return parent::ejecutar($sql);
	}

	//ESTA FUNCION SE USA PARA SACAR EL ID DE LA ULTIMA ORDEN que giro el admin,PARA ASI INSERTAR LA TABLACOTIZACION
	public function listarultimaordenDeAdmin($cod)
	{
		$sql="SELECT max(id_orden) as ultorden FROM ordengeneral WHERE id_causa=$cod AND tipoorden='ADM'";
		return parent::ejecutar($sql);
	}

	public function listarordenesdeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,
		             fecha_giro,
		             fecha_recepcion, 
		             concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, 
		             concat(fecha_fin_orden,' ',hora_fin)as fin,
		             fecha_cierre,
		             (cotizacion.prioridadcot)as prioridad, 
		             (cotizacion.condicioncot)as condicion,
		             (cotizacion.compra)as Compra,
		             (cotizacion.venta)as Venta,
		             (cotizacion.penalizacion)as Penalidad, 
		             concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, 
		             calificacion_todo,
		             estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador 
          AND cotizacion.id_orden=ordengeneral.id_orden 
          AND ordengeneral.id_causa=$cod 
          ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	//////LISTAR ORDENES GIRADAS DE UNA CAUSA
	public function listarordenesgiradasdeunacausa($cod)
	{
		ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Girada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' ";
         return parent::ejecutar($sql);
	}
		//////LISTAR ORDENES PRESUPUESTADAS DE UNA CAUSA
	public function listarordenespresupuestadasdeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Presupuestada'";
         return parent::ejecutar($sql);
	}
			/// ///LISTAR ORDENES ACEPTADAS DE UNA CAUSA (NO DEBEN ESTAR ENTREGADO EL DINERO)
	public function listarordenesaceptadasdeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador,presupuesto
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Aceptada' AND presupuesto.fecha_entrega='' ";
         return parent::ejecutar($sql);
	}
	//////LISTAR ORDENES CON DINERO ENTREGADO DE UNA CAUSA (pero no fueron aceptadas)
	public function listarordenesdineroentregadodeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='DineroEntregado' AND ordengeneral.fecha_recepcion='' ";
         return parent::ejecutar($sql);
	}
	/////LISTAR ORDENES LISTAS PARA REALIZAR
	public function listarordeneslistaspararealizarabogado($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador,presupuesto
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' ";
        return parent::ejecutar($sql);
	}
	/////LISTAR ORDENES PRONUNCIADAS POR EL ABOGADO DE UNA CAUSA
	public function listarordenespronuncioabogadodeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioAbogado'";
         return parent::ejecutar($sql);
	}
		/////LISTAR ORDENES PRONUNCIADAS POR EL CONTADOR DE UNA CAUSA
	public function listarordenespronunciocontadordeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioContador'";
         return parent::ejecutar($sql);
	}

	public function listardetalledeordentabla1($cod)
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(ordengeneral.id_orden)as numeroorden,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig FROM ordengeneral,causa,materia,tipolegal,cotizacion,procurador WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND ordengeneral.id_causa=causa.id_causa AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function listarfechasdeunaorden($cod)
	{
	$sql="SELECT fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin, fecha_cierre FROM ordengeneral WHERE id_orden=$cod";
	  return parent::ejecutar($sql);
	}

	public function mostrarinfodocuorden($cod)
	{
		$sql="SELECT informacion,documentacion FROM ordengeneral WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	/////DESDE AQUI ES DE TITO
	public function modificar_alpresupuestar(){
  $sql=" UPDATE ordengeneral SET prioridad='$this->prioridadorden',id_procurador='$this->id_procurador',id_prioridad='$this->id_prioridad', estado_orden='$this->estadoorden' WHERE id_orden='$this->id_orden'";
  if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function modificarorden_almodificarpresupuestar(){
  $sql=" UPDATE ordengeneral SET prioridad='$this->prioridadorden',id_procurador='$this->id_procurador',id_prioridad='$this->id_prioridad' WHERE id_orden='$this->id_orden'";
  if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	///HASTA AQUI

	public function mostrardatosorden($cod)
	{ //antiguo $sql="SELECT (ordengeneral.prioridad)as Prioridad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,(causa.caja) as Cajacausa  FROM ordengeneral,causa,procurador WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_procurador=procurador.id_procurador AND id_orden=$cod";
		$sql="SELECT (ordengeneral.prioridad)as Prioridad,concat(procurador.apellidoproc,', ',procurador.nombreproc)as procuradorasig,(causa.caja) as Cajacausa  FROM ordengeneral,causa,procurador WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_procurador=procurador.id_procurador AND id_orden=$cod";
		return parent::ejecutar($sql);
	}
  
    ///codigo que enlista ordenes y las causas en la pag mis causas
    public function listarordenesproc($cod,$idproc)
    {
    	$sql="SELECT (ordengeneral.id_orden) as codorden FROM ordengeneral, presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND id_causa=$cod AND id_procurador=$idproc";
    	return parent::ejecutar($sql);
    }
    //insertar fecha de recepcion 
    public function recibirorden()
    {
    	$sql="UPDATE ordengeneral SET fecha_recepcion='$this->fecharecepcion', estado_orden='$this->estadoorden' WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }
    /*FUNCION PARA UN PROCURADOR*/
    public function mostrarfecharecepcion($idproc,$codorden)
    {
    	$sql="SELECT fecha_recepcion, fecha_presupuesto FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND (ordengeneral.estado_orden='Presupuestada' OR ordengeneral.estado_orden='DineroEntregado') AND id_procurador=$idproc AND ordengeneral.id_orden=$codorden";
    	return parent::ejecutar($sql);
    }
    /*FUNCION PARA PROCURADOR MAESTRO TIENE ACCESO A TODAS LAS ORDENES*/
    public function mostrarfecharecepcionPM($codorden)
    {
    	$sql="SELECT fecha_recepcion, fecha_presupuesto FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND (ordengeneral.estado_orden='Presupuestada' OR ordengeneral.estado_orden='DineroEntregado') AND  ordengeneral.id_orden=$codorden";
    	return parent::ejecutar($sql);
    }


//	listado de ordenes de un procurador en una causa
    public function listarordenesdelproc($cod,$codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig FROM ordengeneral,cotizacion, procurador,presupuesto  WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND procurador.id_procurador=$cod AND id_causa=$codcausa";
    	return parent::ejecutar($sql);
    }
    ///LISTADO DE ORDENES DE UNA CAUSA
    public function listarordenesdeunacausaparaproc($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa ORDER BY ordengeneral.id_orden";
    	return parent::ejecutar($sql);
    }

     ///LISTADO DE ORDENES DE UNA CAUSA (solo las ordenes del procurador)
    public function listarOrdenesDeProcuradorDeunaCausaparaproc($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_procurador=$codproc  AND id_causa=$codcausa ORDER BY ordengeneral.id_orden";
    	return parent::ejecutar($sql);
    }


      ///LISTADO DE ORDENES GIRADAS DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesgiradasdeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Girada'";
    	return parent::ejecutar($sql);
    }

     ///LISTADO DE ORDENES GIRADAS DE UNA CAUSA PARA UN PROCURADORE
    public function listarordenesgiradasdeunacausaparaUnProcuradores($codcausa,$codproc)
    {
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
	     
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Girada' AND ordengeneral.id_procurador=$codproc AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'";
    	return parent::ejecutar($sql);
    }
     ///LISTADO DE ORDENES PRESUPUESTADAS DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenespresupuestadasdeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Presupuestada'";
    	return parent::ejecutar($sql);
    }

     ///LISTADO DE ORDENES PRESUPUESTADAS DE UNA CAUSA PARA UN PROCURADORES
    public function listarordenespresupuestadasdeunacausaparaUnProcuradoresGestor($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Presupuestada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

        ///LISTADO DE ORDENES ACEPTADAS DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesaceptadasdeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador,presupuesto WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND id_causa=$codcausa AND presupuesto.fecha_entrega='' AND ordengeneral.estado_orden='Aceptada'";
    	return parent::ejecutar($sql);
    }

        ///LISTADO DE ORDENES ACEPTADAS DE UN PROCURADOR DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesaceptadasdeunacausaDeUnProcuradorparaprocuradores($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador,presupuesto WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega=''  AND id_causa=$codcausa AND ordengeneral.estado_orden='Aceptada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
           ///LISTADO DE ORDENES CON DIENRO ENTREGADO DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesdineroentregadodeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='DineroEntregado' AND fecha_recepcion='' ";
    	return parent::ejecutar($sql);
    }

            ///LISTADO DE ORDENES CON DIENRO ENTREGADO DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesdineroentregadodeunacausaDeUnProcuradorparaprocuradores($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='DineroEntregado' AND ordengeneral.fecha_recepcion='' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
    ////////LISTADO DE ORDENES LISTAS PARA REALIZAR (PARA MOSTRAR AL PROCURADOR)
    public function listarordeneslistasparadescargar($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador,presupuesto WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden  AND id_causa=$cod AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado'";
            return parent::ejecutar($sql);
    }

    ////////LISTADO DE ORDENES LISTAS PARA REALIZAR (PARA MOSTRAR A UN PROCURADOR)
    public function listarordeneslistasparadescargarDeProcurador($cod,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador,presupuesto WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden  AND id_causa=$cod AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND ordengeneral.id_procurador=$codproc";
            return parent::ejecutar($sql);
    }

    ///LISTADO DE ORDENES descargadas DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesdescargadasdeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Descargada'";
    	return parent::ejecutar($sql);
    }

    ///LISTADO DE ORDENES descargadas DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesdescargadasDeProcuradorDeunacausaparaprocuradores($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Descargada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

      ///LISTADO DE ORDENES PRONUNCIADAS POR EL ABOGADO DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenespronuncioabogadodeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='PronuncioAbogado'";
    	return parent::ejecutar($sql);
    }

     ///LISTADO DE ORDENES PRONUNCIADAS POR EL ABOGADO DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesDeProcuradorpronuncioabogadodeunacausaparaprocuradores($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='PronuncioAbogado' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
          ///LISTADO DE ORDENES PRONUNCIADAS POR EL CONTADOR DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenespronunciocontadordeunacausaparaprocuradores($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='PronuncioContador'";
    	return parent::ejecutar($sql);
    }

        ///LISTADO DE ORDENES PRONUNCIADAS POR EL CONTADOR DE UNA CAUSA PARA LOS PROCURADORES
    public function listarordenesDeProcuradorPronuncioContadorDeunaCausaParaProcuradores($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='PronuncioContador' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
     ///LISTADO DE ORDENES GIRADAS DE UNA CAUSA
    public function listarordenesgiradasdeunacausaparaproc($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig FROM ordengeneral,cotizacion, procurador,presupuesto  WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND id_causa=$codcausa";
    	return parent::ejecutar($sql);
    }

    ///FUNCION PARA ENLISTAR LAS ORDENES PARA ENTREGAR PRESUPUESTOS(ENTREGA DE DINERO)
    public function listarordenesentregadinero()
    {
    	$sql="SELECT (ordengeneral.id_orden)as codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio,concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_recepcion,prioridad,monto_presupuesto,fecha_presupuesto, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig FROM ordengeneral,procurador,presupuesto WHERE procurador.id_procurador=ordengeneral.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND (ordengeneral.estado_orden='Presupuestada' OR ordengeneral.estado_orden='Aceptada') AND fecha_entrega=''";
    	return parent::ejecutar($sql);
    }

    public function listarfechasdeunaordenaentregar($cod)
    {
    	$sql="SELECT ordengeneral.id_orden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio,concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_presupuesto,fecha_recepcion FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    }
    public function mostrarpresupuestoentregar($cod)
    {
    	$sql="SELECT monto_presupuesto FROM presupuesto WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }
 ///ESTA FUNCION MUESTRA LA INFORMACION Y DOCUMENTACION CARGADA, DETALLE PRESUPUESTO Y MONTO DEL PRESUPYESTO
    public function mostrarinformacionparadescarga($cod)
    {
    	$sql="SELECT informacion,documentacion,detalle_presupuesto,monto_presupuesto FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    }
///funcion para saber si una orden tiene descarga
    public function compruebasihaydescargadeorden($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as idorden FROM ordengeneral,descargaprocurador WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    } 
    ///FUNCION PARA VERIFICAR SI UNA ORDEN ESTA LISTA PARA DESCARGARSE (PARA UN PROCURADOR)
    public function verificarparadescargarorden($codorden,$idproc)
    {
       $sql="SELECT fecha_recepcion,fecha_entrega,estado_orden FROM ordengeneral,presupuesto 
       WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=$codorden AND ordengeneral.id_procurador=$idproc";
       return parent::ejecutar($sql);
    }

     ///FUNCION PARA VERIFICAR SI UNA ORDEN ESTA LISTA PARA DESCARGARSE (PARA PROCURADOR MAESTRO)
    public function verificarparadescargarordenPM($codorden)
    {
       $sql="SELECT fecha_recepcion,fecha_entrega,estado_orden FROM ordengeneral,presupuesto 
       WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=$codorden";
       return parent::ejecutar($sql);
    }
    ////////FUNCION PARA MOSTRAR LA FECHA FIN Y HORA FIN PARA HACER COMPARACION CON FECHA DE DESCARGA
    public function mostrarfechayhorafin($cod)
    {
    	$sql="SELECT concat(fecha_fin_orden,' ',hora_fin)as Fechafin,(ordengeneral.prioridad)AS prioriOrden FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);

    }

    ///MUESTRA LA FECHA DE DESCARGA DE UNA ORDEN
    public function mostrarfechadescarga($cod)
    {
    	$sql="SELECT fecha_descarga FROM descargaprocurador  WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }
 ///FUNCION QUE ENLISTA TODAS LAS ORDENES QUE ESTEN DESCARGADAS(PARA QUE EL ABOGADO SE PRONUNCIE) 
    public function listarordenesdescargadasdeunacausa($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='Descargada'";
         return parent::ejecutar($sql);
    }
///////////FUNCION QUE MUESTRA EL ESTADO DE UNA ORDEN
    public function mustraestadodeunaorden($cod)
    {
    	$sql="SELECT estado_orden FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }
    ///////////FUNCION QUE MUESTRA EL ESTADO DE UNA ORDEN el id del abogado
    public function mustraestadodeunaordenidabogado($cod)
    {
    	$sql="SELECT estado_orden,(causa.id_abogado)as idabogado, (confirmacion.fecha_confir_abogado)as fechaconfabogado FROM ordengeneral,causa,descargaprocurador,confirmacion WHERE ordengeneral.id_causa=causa.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    }
////////CAMBIA EL ESTADO DE UNA ORDEN 
    public function cambiarestadodeorden()
    {
    	$sql="UPDATE ordengeneral SET estado_orden='$this->estadoorden' WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

    }
//////FUNCION QUE ENLISTA TODAS LAS ORDENES DESCARGADAS Y CON PRONUNCIAMIENTO DEL ABOGADO (ES PARA QUE EL CONTADOR SE PRONUNCIO DEL DIMERO)
    public function listarordenesparaabprobardinero($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='PronuncioAbogado'";
         return parent::ejecutar($sql);
    }
    ////FUNCION PARA MOSTRAR LAS ORDENES GIRADAS AL CONTADOR(LISTAS PARA PRESUPUESTAR)
     public function listarordenesgiradasdeunacausacontador($cod)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='Girada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'";
         return parent::ejecutar($sql);
    }

     ////FUNCION PARA MOSTRAR LAS ORDENES PRESUPUESTADAS AL CONTADOR()
     public function listarordenespresupuestadasdeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='Presupuestada'";
         return parent::ejecutar($sql);
    }
       ////FUNCION PARA MOSTRAR LAS ORDENES ACEPTADAS POR EL PROCURADAR,PARA EL CONTADOR()
     public function listarordenesaceptadasdeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador,presupuesto
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_causa=$cod AND presupuesto.fecha_entrega='' AND estado_orden='Aceptada'";
         return parent::ejecutar($sql);
    }
    ///FUNCION PARA MOSTRAR LAS ORDENES LISTAS PARA REALIZAR
    public function listarordeneslistaspararealizar($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador,presupuesto
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado'";
     return parent::ejecutar($sql);
    }
    ////FUNCION PARA MOSTRAR LAS ORDENES DESCARGADAS,PARA EL CONTADOR()
     public function listarordenesdescargadasdeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='Descargada' ORDER BY ordengeneral.id_orden ASC";
         return parent::ejecutar($sql);
    }
        ////FUNCION PARA MOSTRAR LAS ORDENES PRONUNCIADAS POR EL ABOGADO,PARA EL CONTADOR()
     public function listarordenespronunciabogadodeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='PronuncioAbogado' ORDER BY ordengeneral.id_orden ASC";
         return parent::ejecutar($sql);
    }
       ////FUNCION PARA MOSTRAR LAS ORDENES PRONUNCIADAS POR EL CONTADOR,PARA EL CONTADOR()
     public function listarordenespronuncicontadordeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='PronuncioContador'";
         return parent::ejecutar($sql);
    }
           ////FUNCION PARA MOSTRAR LAS ORDENES CON DINERO ENTREGADO POR EL CONTADOR()
     public function listarordenesdineroentregadodeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND fecha_recepcion='' AND estado_orden='DineroEntregado' ORDER BY ordengeneral.id_orden ASC";
         return parent::ejecutar($sql);
    }

    public function mostraridcausadeunaorden($cod)
    {
    	$sql="SELECT id_causa FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalgiradasdeCausa($cod)
    {
    	$sql="SELECT COUNT(ordengeneral.id_orden)as totalgiradacausa FROM ordengeneral WHERE id_causa=$cod AND ordengeneral.estado_orden='Girada'";
    	return parent::ejecutar($sql);
    }

    public function ultinacalificacion()
    {
    	$sql="UPDATE ordengeneral SET calificacion_todo='$this->calificacion', fecha_cierre='$this->fechacierreorden' WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

    }

    public function listarordenesparacolocarcostojudicial()
    {
    	$sql="SELECT (costofinal.id_costofinal)as codcostofial, (ordengeneral.id_orden)as codorden, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(ordengeneral.informacion)as cargainfo,detalle_informacion,comprajudicial,detalle_presupuesto,detalle_gasto
FROM ordengeneral,causa,materia,tipolegal,descargaprocurador,presupuesto,costofinal
WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND ordengeneral.id_causa=causa.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND  ordengeneral.id_orden=costofinal.id_orden AND costofinal.validadofinal='No'";
     return parent::ejecutar($sql);
    }

    public function mostrardetallesdeordendescargadaparacolocarcostojudicial($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codorden,(ordengeneral.prioridad)as Prioridad,concat(fecha_inicio_orden,' ', hora_inicio)as Inicio,concat(fecha_fin_orden,' ',hora_fin)as Fin,(descargaprocurador.comprajudicial)as Comprajudi,(costofinal.costo_procesal_venta)as costoventajuducial,
costo_procuradoria_compra, costo_procuradoria_venta,total_egreso
FROM ordengeneral,descargaprocurador,costofinal
WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND ordengeneral.id_orden=costofinal.id_orden AND costofinal.id_costofinal=$cod";
   return parent::ejecutar($sql);
    }

    public function mostraridordenDeCostofinal($cod)
    {
    	$sql="SELECT id_orden FROM costofinal WHERE id_costofinal=$cod";
    	return parent::ejecutar($sql);
    }

    public function mostrarcalificacionorden($cod)
    {
    	$sql="SELECT calificacion_todo FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);

    }
///////////////////FUNCIONES PARA HACER EL CONTEO DE OREDENES DURANTE LOS 8 PASOS SE MUESTRA EN LOS BOTONES DE SEGUIMIENTO
    /*MUESTRA EL TOTOAL DE LAS ORDENES NO PREDATADAS*/
    public function mostrartotalordenesgiradas()
    {
    	
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(id_orden)as Totalgiradas FROM ordengeneral WHERE concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND estado_orden='Girada' ";
    	return parent::ejecutar($sql);
    }

     /*MUESTRA EL TOTOAL DE LAS ORDENES GIRADAS DE UN PROCURADOR NO PREDATADAS */
    public function mostrartotalordenesgiradasDeProcurador($codproc)
    {
    	
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(id_orden)as Totalgiradas FROM ordengeneral WHERE concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND estado_orden='Girada' AND ordengeneral.id_procurador=$codproc ";
    	return parent::ejecutar($sql);
    }

     /*MUESTRA EL TOTOAL DE LAS ORDENES NO PREDATADAS, giradas de las causas de un abogado*/
    public function mostrartotalordenesgiradasDeAbogado($codabog)
    {
    	
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(id_orden)as Totalgiradas FROM ordengeneral, causa WHERE causa.id_causa=ordengeneral.id_causa AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND estado_orden='Girada' AND causa.id_abogado=$codabog ";
    	return parent::ejecutar($sql);
    }
    
 /*MUESTRA TODAS LAS ORDENES GIRADAS (INCLUYENDO LAS PREDATADAS, CON ESTAS FUNCION SE FILTRARAN SOLO LAS QUE ESTAS DISPONIBLES(NO PREDATADAS),)*/
    public function mostrarordeneegiradasNoPredatadas()
    {
    	
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
    	$sql="SELECT COUNT(id_orden)as TotalgiradasNopreDatadas FROM ordengeneral 
                 WHERE concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND  estado_orden='Girada'";
     return parent::ejecutar($sql);

    }

    public function mostrartotalordenespresupuestadas()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpresupuestadas FROM ordengeneral WHERE estado_orden='Presupuestada'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenespresupuestadasDeProcurador($codproc)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpresupuestadas FROM ordengeneral WHERE estado_orden='Presupuestada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenespresupuestadasDeCausaDeAbogado($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpresupuestadas FROM ordengeneral,causa  WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='Presupuestada'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesaceptadas()
    {
    	$sql="SELECT COUNT(ordengeneral.id_orden)as Totalaceptadas FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND estado_orden='Aceptada'";
    	return parent::ejecutar($sql);
    }
   /*MOSTRARA EL TOTAL DE ORDENES ACEPTADAS, PERO NO HAN SIDO ENTREGADAS DINERO**/
    public function mostrartotalordenesaceptadasDeProcurador($codproc)
    {
    	$sql="SELECT COUNT(ordengeneral.id_orden)as Totalaceptadas FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND estado_orden='Aceptada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

     public function mostrartotalordenesaceptadasDeCausaAbogado($codabog)
    {
    	$sql="SELECT COUNT(ordengeneral.id_orden)as Totalaceptadas FROM ordengeneral,causa,presupuesto WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND causa.id_abogado=$codabog AND estado_orden='Aceptada' AND presupuesto.fecha_entrega='' ";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesdineroentregado()
    {
    	$sql="SELECT COUNT(id_orden)as Totalentregado FROM ordengeneral WHERE estado_orden='DineroEntregado' AND fecha_recepcion='' ";
    	return parent::ejecutar($sql);
    }

     public function mostrartotalordenesdineroentregadoDeProcurador($codproc)
    {
    	$sql="SELECT COUNT(id_orden)as Totalentregado FROM ordengeneral WHERE estado_orden='DineroEntregado' AND ordengeneral.id_procurador=$codproc AND ordengeneral.fecha_recepcion='' ";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesdineroentregadoDeCausaAbogado($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as Totalentregado FROM ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='DineroEntregado' AND fecha_recepcion='' ";
    	return parent::ejecutar($sql);
    }

    public function mostrartotlalistaspararealizar()
    {
    	$sql="SELECT count(ordengeneral.id_orden)as Totallistasrealizar FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotlalistaspararealizarDeProcurador($codproc)
    {
    	$sql="SELECT count(ordengeneral.id_orden)as Totallistasrealizar FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

     public function mostrartotlalistaspararealizarDeCausaAbogado($codabog)
    {
    	$sql="SELECT count(ordengeneral.id_orden)as Totallistasrealizar FROM ordengeneral,presupuesto,causa WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND causa.id_abogado=$codabog AND ordengeneral.fecha_recepcion<>'' AND  presupuesto.estadopresupuesto='Entregado'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesdescargadas()
    {
    	$sql="SELECT COUNT(id_orden)as Totaldescargadas FROM ordengeneral WHERE estado_orden='Descargada'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesdescargadasDeUnProcurador($codproc)
    {
    	$sql="SELECT COUNT(id_orden)as Totaldescargadas FROM ordengeneral WHERE estado_orden='Descargada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesdescargadasDeCausaDeAbogado($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as Totaldescargadas FROM ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='Descargada'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenespronunciabogado()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronunabogado FROM ordengeneral WHERE estado_orden='PronuncioAbogado'";
    	return parent::ejecutar($sql);
    }

     public function mostrartotalordenesDeUnProcuradorpronunciabogado($codproc)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronunabogado FROM ordengeneral WHERE estado_orden='PronuncioAbogado' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }


    public function mostrartotalordenesDeCausaDeAbogadopronunciabogado($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronunabogado FROM ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='PronuncioAbogado'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenespronunciocontador()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronuncontador FROM ordengeneral WHERE estado_orden='PronuncioContador'";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesDeUnProcuradorPronunciocontador($codproc)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronuncontador FROM ordengeneral WHERE estado_orden='PronuncioContador' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesDeUnProcuradorVencidasLeves($codproc)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(ordengeneral.id_orden)AS Totalvencidasleves FROM ordengeneral,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND confirmacion.confir_sistema=1 AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' AND  estado_orden <> 'Serrada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

    public function mostrartotalordenesVencidasLevesDeCausaDeAbogado($codabog)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(ordengeneral.id_orden)AS Totalvencidasleves FROM ordengeneral,descargaprocurador,confirmacion,causa WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND confirmacion.confir_sistema=1 AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' AND  estado_orden <> 'Serrada' AND causa.id_abogado=$codabog";
    	return parent::ejecutar($sql);
    }

     public function mostrartotalordenesVencidasLeves()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(ordengeneral.id_orden)AS Totalvencidasleves FROM ordengeneral,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND confirmacion.confir_sistema=1 AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' AND  estado_orden <> 'Serrada' ";
    	return parent::ejecutar($sql);
    }



    public function mostrartotalordenesDeCausaDeAbogadoPronuncioElContador($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronuncontador FROM ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='PronuncioContador'";
    	return parent::ejecutar($sql);
    }
/////////////////////////HASTA AQUI LAS FUNCIONES DE CONTEO/////////////////////////////////

////////FUNCION QUE MUESTRA LOS DATOS PARA HACER LA DEVOLUCION DE MUCHOS (INTERFAZ DEL CONTADOR)
    public function consultaparadevolvermuchos($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)AS Codorden, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa, (ordengeneral.informacion)AS infoorden,(presupuesto.detalle_presupuesto)as Infopresupuesto,(descargaprocurador.detalle_informacion)as Infodescarga,(descargaprocurador.detalle_gasto)AS Infogastodesc,(presupuesto.monto_presupuesto)AS Montopresu,(descargaprocurador.gastos)AS Gastodescarga,(descargaprocurador.saldo)AS Saldodevolver FROM ordengeneral,materia,tipolegal,causa,presupuesto,descargaprocurador WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.validado='No' AND ordengeneral.id_procurador=$cod";
    	return parent::ejecutar($sql);
    }
    /*FUNCIO QUE MUESTRA DATOS PARA HACER ENTREGA DE PRESUPUESTOS A MUCHOS (INTERFAZ CONTADOR)*/
    public function consultaentregarmuchos($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)AS Codorden, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(presupuesto.monto_presupuesto)AS Montopresu FROM  ordengeneral,materia,tipolegal,causa,presupuesto WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.estadopresupuesto='Presupuestado' AND ordengeneral.id_procurador=$cod ";
    	return parent::ejecutar($sql);

    }
  /////FUNCION QUE MUESTRA SALDOS DE DESCARGA DE ORDENES QUE AUN NO HAN SIDO SERRADAS, ESTO PARA HACER CUADREA CAJAS
    public function mostrarsaldosOrdenesNoserradas()
    {
    	$sql="SELECT SUM(descargaprocurador.saldo)AS saldito  FROM descargaprocurador,ordengeneral WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND ordengeneral.estado_orden='PronuncioContador'";
    	return parent::ejecutar($sql);
    }
 /*FUNCION PARA MOSTRAR LA PRIORIDAD Y CONDICION DE UNA ORDEN*/
    public function mostrarCondicionyPrioridadOrden($cod)
    {
    	$sql="SELECT (ordengeneral.prioridad)as Prioridadorden, (prioridad.condicion)as Condicionorden FROM ordengeneral,prioridad WHERE prioridad.id_prioridad=ordengeneral.id_prioridad AND ordengeneral.id_orden=$cod";
      return parent::ejecutar($sql);
    }

  
 /*FUNCION QUE ENLISTA LAS ORDENES DE UNA CAUA QUE NO ESTAN SERRADAS*/
    public function listarordenssinserrardecausa($cod)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
    	$sql="SELECT (ordengeneral.id_orden)AS codorden FROM ordengeneral WHERE ordengeneral.id_causa=$cod AND ordengeneral.estado_orden<>'Serrada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'";
    	return parent::ejecutar($sql);
    }

    /*FUNCION QUE ENLISTA LAS ORDENES DE UNA CAUSA, DE UN PROCURADOR QUE NO ESTAN SERRADAS*/
    public function listarordenssinserrardecausaDeProcurador($cod,$codproc)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
    	$sql="SELECT (ordengeneral.id_orden)AS codorden FROM ordengeneral WHERE ordengeneral.id_causa=$cod AND ordengeneral.estado_orden<>'Serrada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }


    /*FUNCION PARA MOSTRAR LA FECHA Y EL PRONUNCIAMIENTO DEL ABOGADO*/
    public function mostrarfechaypronuncionabogado($cod)
    {
    	$sql="SELECT (confirmacion.confir_abogado)as confabog,(confirmacion.fecha_confir_abogado)as fechaabog,(confirmacion.justificacionrechazo)as justificacion FROM ordengeneral,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    }
    /*FUNCION PARA LISTAR ORDENES POR URGENCIAS PARA UN PROCURADPR*/
    public function listarordenesSinSerrardeProcurador($cod)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT (ordengeneral.id_orden)AS codorden,concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS Fechafin,(ordengeneral.prioridad)AS prioridadorden FROM ordengeneral WHERE  (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND ordengeneral.id_procurador=$cod AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'  ";
    	return parent::ejecutar($sql);
    }
   /*FUNCION PARA LISTAR ORDENES POR URGENCIAS PARA EL PROCURADPR MAESTRO*/
    public function listarordenesSinSerrarParaProcuradorMaestro()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT (ordengeneral.id_orden)AS codorden,concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS Fechafin,(ordengeneral.prioridad)AS prioridadorden FROM ordengeneral WHERE  (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'";
    	return parent::ejecutar($sql);
    }

    public function mostrarFechafinyPrioridadOrden($cod)
    {
    	$sql="SELECT concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS Fechafin,(ordengeneral.prioridad)AS PrioridadOrden FROM ordengeneral WHERE ordengeneral.id_orden=$cod";
    	return parent::ejecutar($sql);
    }

    public function mostrarInformaciondeCausaDeUnaOrden($cod)
    {
    	$sql="SELECT (causa.id_causa)AS idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (ordengeneral.id_orden)as idorden,estadocausa,(abogado.id_abogado)as idabogado,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=$cod";
       return parent::ejecutar($sql);
    }
    /*ENLISTA LAS ORDENES DE UN PROCURADOR , DE FORMA DECRECIENTE SEGUN LOS PISOS DEL JUZGADOS*/
    public function listarOrdenesProcuradorPorpisosDecreciente($cod)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

      $sql="SELECT (ordengeneral.id_orden)as idordenn,(piso.nombrepiso)as pisoNomb FROM piso,juzgados,tribunal,causa,ordengeneral WHERE piso.id_piso=juzgados.id_piso AND juzgados.id_juzgados=tribunal.id_juzgados AND tribunal.id_causa=causa.id_causa AND causa.id_causa=ordengeneral.id_causa  AND (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND ordengeneral.id_procurador=$cod AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' GROUP BY ordengeneral.id_orden,nombrepiso ORDER BY nombrepiso DESC";
       return parent::ejecutar($sql);
    }


    /*ENLISTA LAS ORDENES PARA PROCURADOR MAESTRO , DE FORMA DECRECIENTE SEGUN LOS PISOS DEL JUZGADOS*/
    public function listarOrdenesProcuradorMaestroPorpisosDecreciente()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

      $sql="SELECT (ordengeneral.id_orden)as idordenn,(piso.nombrepiso)as pisoNomb FROM piso,juzgados,tribunal,causa,ordengeneral WHERE piso.id_piso=juzgados.id_piso AND juzgados.id_juzgados=tribunal.id_juzgados AND tribunal.id_causa=causa.id_causa AND causa.id_causa=ordengeneral.id_causa AND (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat'  GROUP BY ordengeneral.id_orden,nombrepiso
          ORDER BY nombrepiso DESC";
       return parent::ejecutar($sql);
    }
    /*CONSULTAR PARA HACER PAGO A PROCURADORES*/
    public function consultaparapagoaprocurador($cod)
    {
    	$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(ordengeneral.id_orden)as codorden,(ordengeneral.prioridad)as priori,(cotizacion.condicioncot)as condicion,(cotizacion.compra)as cotcompra,(cotizacion.penalizacion)as cotpenalidad,(costofinal.costo_procuradoria_compra)as compraprocu,(costofinal.penalidadcostofinal)as penalidadproc,calificacion_todo,fecha_giro,fecha_cierre 
FROM materia,tipolegal,causa, ordengeneral,cotizacion,costofinal WHERE causa.id_materia=materia.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_orden=costofinal.id_orden AND ordengeneral.id_procurador=$cod AND costofinal.canceladoprocurador='No'";
      return parent::ejecutar($sql);
    }

    public function mostrarfechagiroorden()
    {
    	$sql="SELECT fecha_giro FROM ordengeneral";
    	return parent::ejecutar($sql);
    }

    public function muestraPresupuestogastadoGastodescarga()
    {
    	$sql="SELECT (presupuesto.monto_presupuesto)as presupuestadogastado,(descargaprocurador.gastos)AS gastadodescarga FROM ordengeneral,presupuesto,descargaprocurador,confirmacion 
WHERE ordengeneral.id_orden=presupuesto.id_presupuesto AND ordengeneral.id_orden=descargaprocurador.id_orden
AND descargaprocurador.id_descarga=confirmacion.id_descarga AND confirmacion.fecha_confir_contador<>'' AND confirmacion.fecha_confir_abogado=''";
     return parent::ejecutar($sql);
    }
    public function muestraCalificacionOrden($cod)
    {
    	$sql="SELECT calificacion_todo FROM ordengeneral WHERE estado_orden='Serrada' AND id_orden=$cod";
    	return parent::ejecutar($sql);
    }

    public function mostrarfechafinalyCodCausaVencidosLeves()
    {
    	$sql="SELECT concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,(ordengeneral.id_orden)AS idorden ,id_causa FROM ordengeneral,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1";
    	return parent::ejecutar($sql);
    }

    public function mostrarfechafinalyCodCausaDeOrdenesDeProcuradorVencidosLeves($codproc)
    {
    	$sql="SELECT concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,(ordengeneral.id_orden)AS idorden ,id_causa FROM ordengeneral,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }

    public function mostrarfechafinalyCodCausaDeAbogadoVencidosLeves($codabog)
    {
    	$sql="SELECT concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,(ordengeneral.id_orden)AS idorden ,(ordengeneral.id_causa)AS id_causa FROM ordengeneral,descargaprocurador,confirmacion,causa WHERE ordengeneral.id_causa=causa.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND causa.id_abogado=$codabog AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1";
    	return parent::ejecutar($sql);
    }
    /*MUESTRA LAS ORDENES QUE YA SE DESCARGARON A TIEMPO , ES PARA SABER SI ESTAN VENCIDAS LEVES (INTERFAZ PROCURADOR)*/
    public function mostrarOrdenVencidasLevesDeCausa($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa FROM ordengeneral,cotizacion, procurador,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND id_causa=$cod";
    	return parent::ejecutar($sql);
    }


    public function mostrarOrdenVencidasLevesDeUnProcuradorDeCausa($cod,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa FROM ordengeneral,cotizacion, procurador,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND id_causa=$cod AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
    /*MUESTRA LAS ORDENES QUE YA SE DESCARGARON A TIEMPO , ES PARA SABER SI ESTAN VENCIDAS LEVES (INTERFAZ ADMINISTRADOR)*/
    public function mostrarOrdenVencidasLevesDeCausaAdmin($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,fecha_presupuesto,fecha_recepcion,fecha_entrega,fecha_descarga,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,fecha_confir_abogado,fecha_confir_contador,fecha_cierre,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra,(cotizacion.venta)as Venta, (cotizacion.penalizacion)as Penalidad,gastos,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa,calificacion_todo 
FROM ordengeneral,cotizacion, procurador,descargaprocurador,confirmacion,presupuesto 
WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND id_causa=$cod";
    	return parent::ejecutar($sql);
    }
      /*MUESTRA LAS ORDENES QUE YA SE DESCARGARON A TIEMPO , ES PARA SABER SI ESTAN VENCIDAS LEVES (INTERFAZ CONTADOR)*/
    public function mostrarOrdenVencidasLevesDeCausaCont($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,monto_presupuesto,gastos,saldo,fecha_giro,fecha_presupuesto,fecha_entrega,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,fecha_descarga,fecha_cierre,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa FROM ordengeneral,cotizacion, procurador,descargaprocurador,confirmacion,presupuesto WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND id_causa=$cod";
    	return parent::ejecutar($sql);
    }

    /*MUESTRA LAS ORDENES QUE YA SE DESCARGARON A TIEMPO , ES PARA SABER SI ESTAN VENCIDAS LEVES (INTERFAZ ABOGADO)*/
    public function mostrarOrdenVencidasLevesDeCausaAbog($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,fecha_recepcion,fecha_descarga,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa,(confirmacion.confir_abogado)as ConfirAbog FROM ordengeneral,cotizacion, procurador,descargaprocurador,confirmacion WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga  AND ordengeneral.estado_orden<>'Serrada' AND confirmacion.confir_sistema=1 AND id_causa=$cod";
    	return parent::ejecutar($sql);
    }


    /*MUESTRA LAS ORDENES SIN DESCARGAS, ES PARA SABER SI ESTAN VENCIDAS O NO*/
    public function mostrarOrdenVencidasGraves()
    {
    	$sql="SELECT id_orden,concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,id_causa FROM ordengeneral
        WHERE  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND ordengeneral.estado_orden<>'Serrada'";
          return parent::ejecutar($sql);
    }

    /*MUESTRA LAS ORDENES SIN DESCARGAS, ES PARA SABER SI ESTAN VENCIDAS O NO*/
    public function mostrarOrdenDeProcuradorVencidasGraves($codproc)
    {
    	$sql="SELECT id_orden,concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,id_causa FROM ordengeneral
        WHERE  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_procurador=$codproc";
          return parent::ejecutar($sql);
    }
    
    public function mostrarTotalVencidasGravesDeUnProcurador($codproc)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
	     
    	$sql="SELECT COUNT(id_orden)AS Totalvencidasgraves FROM ordengeneral
        WHERE  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' AND ordengeneral.id_procurador=$codproc";
          return parent::ejecutar($sql);
    }

    public function mostrarTotalVencidasGravesDeCausaDeAbogado($codabog)
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
	     
    	$sql="SELECT COUNT(id_orden)AS Totalvencidasgraves FROM ordengeneral,causa
        WHERE causa.id_causa=ordengeneral.id_causa AND  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' AND causa.id_abogado=$codabog";
          return parent::ejecutar($sql);
    }

    public function mostrarTotalVencidasGraves()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;
	     
    	$sql="SELECT COUNT(id_orden)AS Totalvencidasgraves FROM ordengeneral
        WHERE  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND concat(fecha_fin_orden,' ',hora_fin) <= '$concat' ";
          return parent::ejecutar($sql);
    }

    /*MUESTRA LAS ORDENES SIN DESCARGAS, ES PARA SABER SI ESTAN VENCIDAS O NO (de causa deun abogado)*/
    public function mostrarOrdenVencidasGravesDeCausaDeAbogado($codabog)
    {
    	$sql="SELECT id_orden,concat(fecha_fin_orden,' ',hora_fin)AS Fechafinal,(ordengeneral.id_causa)AS id_causa FROM ordengeneral,causa
        WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND  ordengeneral.id_orden NOT IN (SELECT id_orden FROM descargaprocurador) AND ordengeneral.estado_orden<>'Serrada'";
          return parent::ejecutar($sql);
    }

  /*EN LISTA ORDENES , PARA HACER LA VERIFICACION DE LAS ORDENES VENCIDAS GRAVES (interfaz procurador)*/
    public function mostrarVencidasGravesDeCausa($cod)
    {
      $sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,fecha_recepcion,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra,(cotizacion.venta)as Venta, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa 
          FROM ordengeneral,cotizacion, procurador 
          WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_orden NOT IN(SELECT id_orden FROM descargaprocurador) AND id_causa=$cod";
          return parent::ejecutar($sql);
    }

    /*EN LISTA ORDENES , PARA HACER LA VERIFICACION DE LAS ORDENES VENCIDAS GRAVES (interfaz procurador)*/
    public function mostrarOrdenesDeProcuradorVencidasGravesDeCausa($cod,$codproc)
    {
      $sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,fecha_recepcion,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra,(cotizacion.venta)as Venta, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa 
          FROM ordengeneral,cotizacion, procurador 
          WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_orden NOT IN(SELECT id_orden FROM descargaprocurador) AND id_causa=$cod AND ordengeneral.id_procurador=$codproc";
          return parent::ejecutar($sql);
    }

     /*EN LISTA ORDENES , PARA HACER LA VERIFICACION DE LAS ORDENES VENCIDAS GRAVES (interfaz contador)*/
    public function mostrarVencidasGravesDeCausaCont($cod)
    {
      $sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa 
          FROM ordengeneral,cotizacion, procurador 
          WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_orden NOT IN(SELECT id_orden FROM descargaprocurador) AND id_causa=$cod";
          return parent::ejecutar($sql);
    }

      /*EN LISTA ORDENES , PARA HACER LA VERIFICACION DE LAS ORDENES VENCIDAS GRAVES (interfaz abogado)*/
    public function mostrarVencidasGravesDeCausaAbog($cod)
    {
      $sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,fecha_recepcion,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, (ordengeneral.id_causa)AS idcausa 
          FROM ordengeneral,cotizacion, procurador 
          WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_orden NOT IN(SELECT id_orden FROM descargaprocurador) AND id_causa=$cod";
          return parent::ejecutar($sql);
    }

    public function mostrarTipoOrden($cod)
    {
    	$sql="SELECT tipoorden FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }

    public function listarOrdenesProcuradorMaestro($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as idorden,fecha_giro, concat(fecha_inicio_orden,' ',hora_inicio)AS Inicio,concat(fecha_fin_orden,' ',hora_fin)AS Fin, (cotizacion.prioridadcot)AS Prioridad,(cotizacion.condicioncot)AS Condicion,(cotizacion.compra)AS Compra,(cotizacion.penalizacion)AS Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)AS Procurador,estado_orden 
			FROM ordengeneral,cotizacion,procurador
			WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_causa=$cod ORDER BY ordengeneral.id_orden";
			return parent::ejecutar($sql);
    }

    public function mostrarfecharecepcionDeOrden($cod)
    {
    	$sql="SELECT fecha_recepcion FROM ordengeneral WHERE id_orden=$cod";
    	return parent::ejecutar($sql);
    }

    public function listarordenesParaClientedeCausa($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)AS idorden,informacion,concat(fecha_fin_orden,' ',hora_fin)AS Fin,prioridadcot,condicioncot,estado_orden FROM ordengeneral,cotizacion WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_causa=$cod ";
    	return parent::ejecutar($sql);
    }

    public function mostrarGastosProcesalesHastaUnaPostaDeUnaCausa($codcausa,$fechaposta)
    {
    	$sql="SELECT SUM(costofinal.total_egreso)AS Gastosprocesales FROM costofinal,ordengeneral 
           WHERE ordengeneral.id_orden=costofinal.id_orden AND ordengeneral.id_causa=$codcausa 
           AND ordengeneral.fecha_cierre<='$fechaposta'";
           return parent::ejecutar($sql);
    }

    public function modificarInfoDocOrden()
    {
    	$sql="UPDATE ordengeneral SET informacion='$this->informacion',documentacion='$this->documentacion', infosolotexto='$this->infosolotexto',docsolotexto='$this->docsolotexto' WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }

    public function eliminarUnaOrden()
    {
    	$sql="DELETE FROM ordengeneral WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

    }
    
    /*FUNCION PARA LISTAR TODAS LAS ORDENES QUE NO AN SIDO NOTIFICADAS POR CORREO(PARA HACER LA NOTIFICACION AL PROC)*/
    public function listarDatosDeOrdenesParaNotificarEmail()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT (ordengeneral.id_orden)AS codorden,concat(fecha_inicio_orden,' ',hora_inicio)AS Inicio,concat(fecha_fin_orden,' ',hora_fin)AS Fin, (procurador.correoproc)AS correoprocurador,concat(procurador.nombreproc,' ',procurador.apellidoproc)AS procasig,(procurador.token)AS token, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)AS codigocausa
FROM ordengeneral,procurador,causa,materia,tipolegal
WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_procurador=procurador.id_procurador AND notificado_email='No' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' ";
      return parent::ejecutar($sql);
    }
    public function MarcarNotificacionEmail($cod)
    {
    	$sql="UPDATE ordengeneral SET notificado_email='$this->notificadoemail' WHERE id_orden=$cod";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }
    
    
    
    
    
    
    
    
    
    
    /*--------------------------------------------NUEVAS FUNCIONES----------------------------*/
public function dineroGastadoSinConciliarporContador()
{
	$sql="SELECT SUM(descargaprocurador.gastos)AS gastado FROM presupuesto,ordengeneral,descargaprocurador WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=descargaprocurador.id_orden AND presupuesto.estadopresupuesto='Gastado'";
	return parent::ejecutar($sql);
}

public function SaldosPorDevolverAContador()
{
	$sql="SELECT SUM(descargaprocurador.saldo)AS saldos FROM presupuesto,ordengeneral,descargaprocurador WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.id_orden=descargaprocurador.id_orden AND presupuesto.estadopresupuesto='Gastado'";
	return parent::ejecutar($sql);
}



/*FUNCIONES PARA QUE CUADRE LA CAJA DEL CONTADOR (SUMA LOS PRESUPUESTOS DE ORDENES SIN SERRAR DESDE LOS PRESUPUESTOS ENTREGADOS)*/
 public function presupuestosENtregadosSinSerrar()
 {
 	$sql="SELECT SUM(presupuesto.monto_presupuesto)AS presup_entregado FROM presupuesto WHERE presupuesto.estadopresupuesto='Entregado'";
 	return parent::ejecutar($sql);
 }

/*OJO ES EL PRESUPUESTO, NO ES EL GASTO REALMENTE*/
 public function presupuestosGastadosSinSerrar()
 {
 	$sql="SELECT SUM(presupuesto.monto_presupuesto)AS presup_gastado FROM presupuesto WHERE presupuesto.estadopresupuesto='Gastado'";
 	return parent::ejecutar($sql);
 }

     /*DEVUELVE LOS PRESUPUESTOS GASTADOS CONFIRMADOS POR EL CONTADOR, SIN SERRAR(NO CONFIRMO ABOGADOS)*/
 public function presupuestoConfirContadorNoSerrada()
 {
 	$sql="SELECT SUM(presupuesto.monto_presupuesto)AS monto_confir_sinserrar FROM presupuesto,ordengeneral WHERE ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.estadopresupuesto='Gastadoconfir' AND ordengeneral.estado_orden<>'Serrada'";
 	return parent::ejecutar($sql);
 }


 /*FIN DE LAS FUNCIONES PARA CUADRAR LA CAJA DEL CONTADOR*/




/*----------------------------------FIN DE NUEVAS FUNCIONES-------------------------------*/

/*FUNCION PARA CAMBIAR LA CALIFICACION DE UNAORDEN*/
   public function cambiarCalificacionOrden()
    {
    	$sql="UPDATE ordengeneral SET calificacion_todo='$this->calificacion' WHERE id_orden='$this->id_orden'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }
    public function mostrarEstadoOrdenYCanceladoProc_DeOrden($idorden)
    {
    	$sql="SELECT estado_orden,canceladoprocurador FROM ordengeneral,costofinal WHERE ordengeneral.id_orden=costofinal.id_orden AND ordengeneral.id_orden=$idorden";
    	return parent::ejecutar($sql);
    }
/*FUNCION PARA CAMBIAR LA CALIFICACION DE UNAORDEN*/















/*FUNCIONES PARA LOS FILTRADOS DE LAS ORDENES EN GENERAL(SEGUIMIENTO) PARA EL ADMIN DEL SISTEMA*/
public function listarordenesGiradasdeunacausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Girada' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesPresupuestadasDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Presupuestada' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesAceptadasDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Aceptada' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesDineroEntregadoDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='DineroEntregado' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesListasParaDescargarDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador,presupuesto
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND ordengeneral.id_causa=$cod ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesDescargadasDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Descargada' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesPronunciadasAbogadoDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioAbogado' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

	public function listarordenesCuentasConciliadasDeunaCausaAdmin($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioContador' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
/*FIN DE FUNCIONES PARA LOS FILTRADOS DE LAS ORDENES EN GENERAL(SEGUIMIENTO) PARA EL ADMIN DEL SISTEMA*/






/*FUNCIONES PARA LOS FILTRADOS DE LAS ORDENES ESPECIAL(SEGUIMIENTO) PARA EL ADMIN DEL SISTEMA(SUS ORDENES GIRADAS)*/
                    /*FUNCION DE CONTADORES DE TOTAL ORDENES DEL ADMIN*/
    /*FUNCIONES QUE MUESTRA EL TOTOAL DE LAS ORDENES NO PREDATADAS*/
    public function mostrartotalordenesgiradasDeAdmin()
    {
    	
    	 ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT COUNT(id_orden)as Totalgiradas FROM ordengeneral WHERE concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND estado_orden='Girada' AND tipoorden='ADM'";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalordenespresupuestadasDeAdmin()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpresupuestadas FROM ordengeneral WHERE estado_orden='Presupuestada' AND tipoorden='ADM'";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalordenesaceptadasDeAdmin()
    {
    	$sql="SELECT COUNT(ordengeneral.id_orden)as Totalaceptadas FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND estado_orden='Aceptada' AND tipoorden='ADM'";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalordenesdineroentregadoDeAdmin()
    {
    	$sql="SELECT COUNT(id_orden)as Totalentregado FROM ordengeneral WHERE estado_orden='DineroEntregado' AND fecha_recepcion='' AND tipoorden='ADM' ";
    	return parent::ejecutar($sql);
    }
    public function mostrartotlalistaspararealizarDeAdmin()
    {
    	$sql="SELECT count(ordengeneral.id_orden)as Totallistasrealizar FROM ordengeneral,presupuesto WHERE ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND tipoorden='ADM'";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalordenesdescargadasDeAdmin()
    {
    	$sql="SELECT COUNT(id_orden)as Totaldescargadas FROM ordengeneral WHERE estado_orden='Descargada' AND tipoorden='ADM' ";
    	return parent::ejecutar($sql);
    }
    public function mostrartotalordenespronunciabogadoDeAdmin()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronunabogado FROM ordengeneral WHERE estado_orden='PronuncioAbogado' AND tipoorden='ADM' ";
    	return parent::ejecutar($sql);
    }
     public function mostrartotalordenespronunciocontadorDeAdmin()
    {
    	$sql="SELECT COUNT(id_orden)as Totalpronuncontador FROM ordengeneral WHERE estado_orden='PronuncioContador' AND tipoorden='ADM' ";
    	return parent::ejecutar($sql);
    }
    /*FIN DE FUNCIONES MUESTRA EL TOTOAL DE LAS ORDENES NO PREDATADAS*/



    /*FUNCIONES DE LISTADOR DE ORDENES DENTRO DE LOS 8 PASOS(ORDENES DEL ADMINISTRAODR)(LAS QUE EL CREO)*/
    public function listarordenesGiradasPorADMINdeunacausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Girada' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminPresupuestadasDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Presupuestada' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminAceptadasDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Aceptada' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdmin_DineroEntregadoDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='DineroEntregado' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminListasParaDescargarDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador,presupuesto
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND ordengeneral.id_causa=$cod AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminDescargadasDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Descargada' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminPronunciadasAbogadoDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioAbogado' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	public function listarordenesDeAdminCuentasConciliadasDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='PronuncioContador' AND ordengeneral.tipoorden='ADM' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}

    /*FIN DE FUNCIONES DE LISTADOR DE ORDENES DENTRO DE LOS 8 PASOS(ORDENES DEL ADMINISTRAODR)(LAS QUE EL CREO)*/

/*FUNCIONES PARA LOS FILTRADOS DE LAS ORDENES ESPECIAL(SEGUIMIENTO) PARA EL ADMIN DEL SISTEMA(SUS ORDENES GIRADAS)*/
/*FUNCION PARA MOSTRAR EL LUGAR DE EJECUCION DE UNA ORDEN*/
   public function mostrarLugarDeEjecucionDeOrden($idorden)
   {
   	$sql="SELECT lugar_ejecucion FROM ordengeneral WHERE id_orden=$idorden";
   	return parent::ejecutar($sql);
   }
/*FUNCION PARA MOSTRAR EL LUGAR DE EJECUCION DE UNA ORDEN*/
/*FUNCION PARA EDITAR O CREAR EL DETALLE DE PRE-PRESUPUESTO*/
public function pre_presupuestarUnaOrden()
{
	$sql="UPDATE ordengeneral SET sugerencia_presupuesto='$this->sugerencia_presupuesto',estado_orden='$this->estadoorden' WHERE id_orden='$this->id_orden'";
	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

}
/*FIN DE FUNCION PARA EDITAR O CREAR EL DETALLE DE PRE-PRESUPUESTO*/

/*FUNCION PARA HACER EL CONTEO DE TOTAL ORDENES PRE-PRESUPUESTADAS DE UN PROCURADOR*/
 /*MUESTRA EL TOTAL DE LAS ORDENES PRE-PRESUPUESTADAS DE UN PROCURADOR NO PREDATADAS */
    public function mostrartotalordenesPre_presupuestadasDeProcurador($codproc)
    {
    	
    	$sql="SELECT COUNT(id_orden)as Totalpre_presupuestadas FROM ordengeneral WHERE estado_orden='Pre-presupuestada' AND ordengeneral.id_procurador=$codproc ";
    	return parent::ejecutar($sql);
    }
   ///LISTADO DE ORDENES PRE-PRESUPUESTADAS DE UNA CAUSA PARA UN PROCURADORES
    public function listarordenesPre_presupuestadasdeunacausaparaUnProcuradoresGestor($codcausa,$codproc)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Pre-presupuestada' AND ordengeneral.id_procurador=$codproc";
    	return parent::ejecutar($sql);
    }
    /*funcion para mostrar la sugerencia del pre-presupuesto de una orden*/
    public function mostrarSugerenciaPre_presupuestodeOrden($idorden)
    {
    	$sql="SELECT sugerencia_presupuesto FROM ordengeneral WHERE id_orden=$idorden";
    	return parent::ejecutar($sql);
    }

    /*MUESTRA EL TOTAL DE LAS ORDENES PRE-PRESUPUESTADAS DE TODAS LAS CAUSAS */
    public function mostrartotalordenesPre_presupuestadas()
    {
    	
    	$sql="SELECT COUNT(id_orden)as Totalpre_presupuestadas FROM ordengeneral WHERE estado_orden='Pre-presupuestada' ";
    	return parent::ejecutar($sql);
    }
    ////FUNCION PARA MOSTRAR LAS ORDENES PRE-PRESUPUESTADAS AL CONTADOR()
     public function listarordenesPre_presupuestadasdeunacausacontador($cod)
    {
    	$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig
 FROM ordengeneral,cotizacion,procurador
 WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND estado_orden='Pre-presupuestada'";
         return parent::ejecutar($sql);
    }
    public function listarordenesPre_PresupuestadasDeunaCausa($cod)
	{
		$sql="SELECT (ordengeneral.id_orden)as codigo,fecha_giro,fecha_recepcion, concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as fin,fecha_cierre,(cotizacion.prioridadcot)as prioridad, (cotizacion.condicioncot)as condicion,(cotizacion.compra)as Compra,(cotizacion.venta)as Venta,(cotizacion.penalizacion)as Penalidad, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, calificacion_todo,estado_orden
        FROM ordengeneral,cotizacion,procurador
        WHERE ordengeneral.id_procurador=procurador.id_procurador AND cotizacion.id_orden=ordengeneral.id_orden AND ordengeneral.id_causa=$cod AND ordengeneral.estado_orden='Pre-presupuestada' ORDER by ordengeneral.id_orden";
         return parent::ejecutar($sql);
	}
	/*contador de total ordenes pre-presupuestadas de un abogado*/
	public function mostrartotalordenesPre_presupuestadasDeCausaDeAbogado($codabog)
    {
    	$sql="SELECT COUNT(id_orden)as TotalPrepresupuestadas FROM ordengeneral,causa  WHERE causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND estado_orden='Pre-presupuestada'";
    	return parent::ejecutar($sql);
    }
    ///LISTADO DE ORDENES PRE-PRESUPUESTADAS DE UNA CAUSA PARA LOS PROCURADORES MAESTROS
    public function listarordenesPre_presupuestadasdeunacausaparaprocuradoresM($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)as Codorden,fecha_giro,concat(fecha_inicio_orden,' ',hora_inicio)as Inicio, concat(fecha_fin_orden,' ',hora_fin)as Fin,(cotizacion.prioridadcot)as Prioridad,(cotizacion.condicioncot)as Condicion, (cotizacion.compra)as Compra, (cotizacion.penalizacion)as Penalidad,concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig,estado_orden FROM ordengeneral,cotizacion, procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador  AND id_causa=$codcausa AND ordengeneral.estado_orden='Pre-presupuestada'";
    	return parent::ejecutar($sql);
    }
    
    /*---LISTAR ORDEN CON VIGENCIA VENCIDA (SE ACABO EL PLAZO , FECHA FIN MENOR A LA FECHA ACTUAL)*/
    public function listarDatosDeOrdenesParaNotificarPlazoFinalizo()
    {
    	ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

    	$sql="SELECT (ordengeneral.id_orden)AS codorden,concat(fecha_inicio_orden,' ',hora_inicio)AS Inicio,concat(fecha_fin_orden,' ',hora_fin)AS Fin, (procurador.correoproc)AS correoprocurador,concat(procurador.nombreproc,' ',procurador.apellidoproc)AS procasig,(procurador.token)AS token, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)AS codigocausa
        FROM ordengeneral,procurador,causa,materia,tipolegal
        WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_procurador=procurador.id_procurador AND notificado_email='Si' AND concat(fecha_fin_orden,' ',hora_fin)<'$concat' ";
       return parent::ejecutar($sql);
    }
    /*contador de total de ordenes de una causa*/
	public function contadorde_ordenesDeCausa($cod)
	{
		$sql="SELECT COUNT(id_orden)as cantidadorden FROM ordengeneral WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	/*listado de ordenes para imprimir en PDF*/
	public function listarordenesdeunacausaPDF_1($cod)
	{
		$sql="
		      SELECT (@rownum:= @rownum+1) AS cont,
		             (a.id_orden)as codigo,
		             a.fecha_giro,
		             a.fecha_recepcion, 
		             concat(a.fecha_inicio_orden,' ',a.hora_inicio)as Inicio, 
		             concat(a.fecha_fin_orden,' ',a.hora_fin)as fin,
		             a.fecha_cierre,
		             (b.prioridadcot)as prioridad, 
		             (b.condicioncot)as condicion,
		             (b.compra)as Compra,
		             (b.venta)as Venta,
		             (b.penalizacion)as Penalidad, 
		             concat(c.nombreproc,' ',c.apellidoproc)as procuradorasig,
		             a.calificacion_todo,
		             a.estado_orden
        FROM ordengeneral as a,
             cotizacion as b,
             procurador as c,
             (SELECT @rownum:=0) as r
        WHERE a.id_procurador=c.id_procurador 
          AND b.id_orden=a.id_orden 
          AND a.id_causa=$cod 
          ORDER by a.id_orden asc
          ";
         return parent::ejecutar($sql);
	}
	public function listarOrdenesLiquidacionParaCliente($codcausa)
	{
				$sql="SELECT (a.id_orden)AS idorden,
		        b.prioridadcot,
		        concat(a.fecha_inicio_orden,' ',a.hora_inicio)as Inicio,
		        concat(a.fecha_fin_orden,' ',a.hora_fin)AS Fin,
		        a.informacion,
		        c.detalle_informacion,
		        d.costo_procesal_venta,
		        b.venta, /*cotizacion judicial*/
		        d.costo_procuradoria_venta,
		     
		        d.validadofinal,
		        b.condicioncot,
		        a.estado_orden      
		   FROM ordengeneral as a
 INNER JOIN cotizacion as b 
		     ON a.id_orden=b.id_orden
	LEFT JOIN descargaprocurador as c
		     ON a.id_orden=c.id_orden
	LEFT JOIN costofinal as d
		     ON a.id_orden=d.id_orden
		  WHERE a.id_causa=$codcausa
	 ORDER BY a.id_orden ASC";
	 return parent::ejecutar($sql);
	}

	public function listarOrdenesLiquidacionParaClienteTEXT($codcausa)
	{
				$sql="SELECT (a.id_orden)AS idorden,
		        b.prioridadcot,
		        concat(a.fecha_inicio_orden,' ',a.hora_inicio)as Inicio,
		        concat(a.fecha_fin_orden,' ',a.hora_fin)AS Fin,
		        a.infosolotexto as informacion,
		        c.descargainfosolotexto as detalle_informacion,
		        d.costo_procesal_venta,
		        b.venta, /*cotizacion judicial*/
		        d.costo_procuradoria_venta,
		     
		        d.validadofinal,
		        b.condicioncot,
		        a.estado_orden      
		   FROM ordengeneral as a
 INNER JOIN cotizacion as b 
		     ON a.id_orden=b.id_orden
	LEFT JOIN descargaprocurador as c
		     ON a.id_orden=c.id_orden
	LEFT JOIN costofinal as d
		     ON a.id_orden=d.id_orden
		  WHERE a.id_causa=$codcausa
	 ORDER BY a.id_orden ASC";
	 return parent::ejecutar($sql);
	}


}

?>