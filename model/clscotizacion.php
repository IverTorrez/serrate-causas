<?php
include_once('clsconexion.php');
class Cotizacion extends Conexion{
	private $id_cotizacion;
	private $cotizacioncompra;
	private $cotizacionventa;
	private $cotizacionpenalizacion;
	private $id_orden;
	private $prioridadcoti;
	private $condicioncoti;
	

	public function Cotizacion()
	{
		parent::Conexion();
		$this->id_cotizacion=0;
		$this->cotizacioncompra=0;
		$this->cotizacionventa=0;
		$this->cotizacionpenalizacion=0;
		$this->id_orden=0;
		$this->prioridadcoti=0;
		$this->condicioncoti=0;
		
	}

	public function setid_cotizacion($valor)
	{
		$this->id_cotizacion=$valor;
	}
	public function getid_cotizacion()
	{
		return $this->id_cotizacion;
	}
	public function setcotizacioncompra($valor)
	{
		$this->cotizacioncompra=$valor;
	}
	public function getcotizacioncompra()
	{
		return $this->cotizacioncompra;
	}
	public function setcotizacionventa($valor)
	{
		$this->cotizacionventa=$valor;
	}
	public function getcotizacionventa()
	{
		return $this->cotizacionventa;
	}
	public function setcotizacionpenalidad($valor)
	{
		$this->cotizacionpenalizacion=$valor;
	}
	public function getcotizacionpenalidad()
	{
		return $this->cotizacionpenalizacion;
	}
	public function setid_ordencotizacion($valor)
	{
		$this->id_orden=$valor;
	}
	public function getid_ordencotizacion()
	{
		return $this->id_orden;
	}

	public function setprioridadcoti($valor)
	{
		$this->prioridadcoti=$valor;
	}
	public function getprioridadcoti()
	{
		return $this->prioridadcoti;
	}
	public function setcondicioncoti($valor)
	{
		$this->condicioncoti=$valor;
	}
	public function getcondicioncoti()
	{
		return $this->condicioncoti;
	}
	

	public function guardarcotizacion()
	{
		$sql="INSERT INTO cotizacion(compra,venta,penalizacion,id_orden,prioridadcot,condicioncot) VALUES('$this->cotizacioncompra','$this->cotizacionventa','$this->cotizacionpenalizacion','$this->id_orden','$this->prioridadcoti','$this->condicioncoti')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	public function listarcotizacion()
	{
		$sql="SELECT *FROM cotizacion";
		return parent::ejecutar($sql); 
	}

	////DESDDE AQUI ES DE TITO
	public function devolvercondicion(){
		$sql="SELECT *FROM cotizacion WHERE id_orden='$this->id_orden'";
         return parent::ejecutar($sql); 

	}
	public function modificar_alpresupuestarcoti(){
		$sql="UPDATE cotizacion SET compra='$this->cotizacioncompra',venta='$this->cotizacionventa',penalizacion='$this->cotizacionpenalizacion',prioridadcot='$this->prioridadcoti' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}	
	///HASTA AQUI
	public function mostrarcotizaciondeorden($cod)
	{
		$sql="SELECT id_cotizacion,compra,venta,penalizacion FROM cotizacion WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function eliminarCotizacion()
	{
		$sql="DELETE FROM cotizacion WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	
}