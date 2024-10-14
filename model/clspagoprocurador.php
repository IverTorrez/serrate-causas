<?php
include_once('clsconexion.php');
class PagoProcurador extends Conexion{
	private $id_pago;
	private $fechapago;
	private $montopago;
	private $fechainiconsul;
	private $fechafinconsul;
	private $idprocurador;
	private $ordenes_canceladas;

	public function PagoProcurador() 
	{
		parent::Conexion();
		$this->id_pago=0;
		$this->fechapago="";
		$this->montopago=0;
		$this->fechainiconsul="";
		$this->fechafinconsul="";
		$this->idprocurador=0;
		$this->ordenes_canceladas="";
	}

	public function setid_pago($valor)
	{
		$this->id_pago=$valor;
	}
	public function getid_pago()
	{
		return $this->id_pago;
	}
	public function setfechapago($valor)
	{
		$this->fechapago=$valor;
	}
	public function getfechapago()
	{
		return $this->fechapago;
	}
	public function setmontopago($valor)
	{
		$this->montopago=$valor;
	}
	public function getmontopago()
	{
		return $this->montopago;
	}

	public function setfechainiconsulta($valor)
	{
		$this->fechainiconsul=$valor;
	}
	public function getfechainiconsulta()
	{
		return $this->fechainiconsul;
	}

	public function setfechafinconsulta($valor)
	{
		$this->fechafinconsul=$valor;
	}
	public function getfechafinconsulta()
	{
		return $this->fechafinconsul;
	}

	public function setidprocurador($valor)
	{
		$this->idprocurador=$valor;
	}
	public function getidprocurador()
	{
		return $this->idprocurador;
	}
	
	public function setOrdenesCanceladas($valor)
	{
		$this->ordenes_canceladas=$valor;
	}
	public function getordenesCanceladas()
	{
		return $this->ordenes_canceladas;
	}

	public function guardarpagoprocurador()
	{
		$sql="INSERT INTO pagoprocurador(fechapago,
			                             pagoproc,
			                             fechainiconsul,
			                             fechafinconsul,
			                             id_procurador,
			                             ordenes_canceladas) 
		                         VALUES('$this->fechapago',
		                         	    '$this->montopago',
		                         	    '$this->fechainiconsul',
		                         	    '$this->fechafinconsul',
		                         	    '$this->idprocurador',
		                         	    '$this->ordenes_canceladas')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function mostrarIdUltimoPagoDeProcurador($cod)
	{
		$sql="SELECT MAX(id_pago)AS idultimopago FROM pagoprocurador WHERE id_procurador=$cod ";
		return parent::ejecutar($sql);
	}

	public function mostrarUnPago($cod)
	{
		$sql="SELECT id_pago,fechapago,pagoproc,fechainiconsul,fechafinconsul,id_procurador,ordenes_canceladas FROM pagoprocurador WHERE id_pago=$cod";
		return parent::ejecutar($sql);
	}
/*------------------------NUEVAS FUNCIONES----------------------------------------*/
	public function mostrarTodosLosPagos()
	{
		$sql="SELECT id_pago,fechapago, concat(procurador.nombreproc,' ',procurador.apellidoproc)AS procu,pagoproc FROM procurador,pagoprocurador WHERE procurador.id_procurador=pagoprocurador.id_procurador ORDER BY id_pago ASC";
		return parent::ejecutar($sql);
	}

	public function consultaParaPagarATodosProcuradores()
	{
		$sql="SELECT concat(procurador.nombreproc,' ',procurador.apellidoproc)AS procu, SUM(costofinal.costo_procuradoria_compra)as compraprocu, SUM(costofinal.penalidadcostofinal)as penalidadproc FROM ordengeneral,cotizacion,costofinal,procurador WHERE procurador.id_procurador=ordengeneral.id_procurador AND ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_orden=costofinal.id_orden AND costofinal.canceladoprocurador='No' GROUP BY procurador.id_procurador";
		return parent::ejecutar($sql);
	}
/*------------------FIN DE NUEVAS FUNCIONES----------------------*/
     public function obtenerUltimoPagoDeProcDeFecha($id,$fecha)
   {
     $sql="SELECT max(id_pago) as id_pago 
             FROM pagoprocurador 
            WHERE id_procurador=$id
              and cast(fechapago as date)='$fecha' ";
              return parent::ejecutar($sql);
   }
   public function mostrarDatosdeOrdenCanceladoProc($cod)
   {
   	 $sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,
			      (ordengeneral.id_orden)as codorden,
			      (ordengeneral.prioridad)as priori,
			      (cotizacion.condicioncot)as condicion,
			      (cotizacion.compra)as cotcompra,
			      (cotizacion.penalizacion)as cotpenalidad,
			      (costofinal.costo_procuradoria_compra)as compraprocu,
			      (costofinal.penalidadcostofinal)as penalidadproc,
			      calificacion_todo,
			      fecha_giro,
			      fecha_cierre 
			 FROM materia,
			      tipolegal,
			      causa, 
			      ordengeneral,
			      cotizacion,
			      costofinal 
			WHERE causa.id_materia=materia.id_materia 
			  AND tipolegal.id_tipolegal=causa.id_tipolegal 
			  AND causa.id_causa=ordengeneral.id_causa 
			  AND ordengeneral.id_orden=cotizacion.id_orden 
			  AND ordengeneral.id_orden=costofinal.id_orden 
			  AND ordengeneral.id_orden=$cod
			  AND costofinal.canceladoprocurador='Si'";
		   return parent::ejecutar($sql);
   }
	
	
}
?>