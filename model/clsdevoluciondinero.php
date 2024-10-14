<?php
include_once('clsconexion.php');
class DevolucionDinero extends Conexion{
	private $id_devolucion;
	private $montodevolucion;
	private $fechadevolucion;
	private $id_causa;
	

	public function DevolucionDinero()
	{
		parent::Conexion();
		$this->id_devolucion=0;
		$this->montodevolucion=0;
		$this->fechadevolucion="";
		$this->id_causa=0;
		
	}

	public function setid_devolucion($valor)
	{
		$this->id_devolucion=$valor;
	}
	public function getid_devolucion()
	{
		return $this->id_devolucion;
	}
	public function setmontodevolucion($valor)
	{
		$this->montodevolucion=$valor;
	}
	public function getmontodevolucion()
	{
		return $this->montodevolucion;
	}

	public function setfechadevolucion($valor)
	{
		$this->fechadevolucion=$valor;
	}
	public function getfechadevolucion()
	{
		return $this->fechadevolucion;
	}

	public function setid_causadevolucion($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causadevolucion()
	{
		return $this->id_causa;
	}

	
	public function guardardevolucion()
	{
		$sql="INSERT INTO devoluciondinero(montodevolucion,fechadevolucion,id_causa) VALUES('$this->montodevolucion','$this->fechadevolucion','$this->id_causa')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarLasDevolucionesdeCausa($cod)
	{
	  $sql="SELECT id_devolucion, montodevolucion,fechadevolucion,id_causa FROM devoluciondinero WHERE id_causa=$cod";
	  return parent::ejecutar($sql);	
	}


}
?>