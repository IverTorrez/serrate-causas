<?php
include_once('clsconexion.php');
class AutoOrden extends Conexion{
	private $id_autoorden;
	private $detalleautoorden;
	private $fechainiauto;
	private $fechafinauto;
	private $colorauto;
	private $estadoauto;
	private $id_causa;
	

	public function AutoOrden()
	{
		parent::Conexion();
		$this->id_autoorden=0;
		$this->detalleautoorden="";
		$this->fechainiauto="";
		$this->fechafinauto="";
		$this->colorauto="";
		$this->estadoauto="";
		$this->id_causa=0;
		
	}

	public function setid_autoorden($valor)
	{
		$this->id_autoorden=$valor;
	}
	public function getid_autoorden()
	{
		return $this->id_autoorden;
	}
	public function setdetalleautoorden($valor)
	{
		$this->detalleautoorden=$valor;
	}
	public function getdetalleautoorden()
	{
		return $this->detalleautoorden;
	}
	public function setfechainiauto($valor)
	{
		$this->fechainiauto=$valor;
	}
	public function getfechainiauto()
	{
		return $this->fechainiauto;
	}
	public function setfechafinauto($valor)
	{
		$this->fechafinauto=$valor;
	}
	public function getfechafinauto()
	{
		return $this->fechafinauto;
	}
	public function setcolorauto($valor)
	{
		$this->colorauto=$valor;
	}
	public function getcolorauto()
	{
		return $this->colorauto;
	}
	public function setestadoauto($valor)
	{
		$this->estadoauto=$valor;
	}
	public function getestadoauto()
	{
		return $this->estadoauto;
	}
	public function setid_causaauto($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causaauto()
	{
		return $this->id_causa;
	}
	

	public function guardarautoorden()
	{
		$sql="INSERT INTO autoorden(detalleautoorden,fechaini,fechafin,color,estadoauto,id_causa) VALUES('$this->detalleautoorden','$this->fechainiauto','$this->fechafinauto','$this->colorauto','$this->estadoauto','$this->id_causa')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function listarAutoOrdenesDeCausa($cod)
	{
		$sql="SELECT id_autoorden,detalleautoorden,fechaini,fechafin,color,estadoauto,id_causa FROM autoorden WHERE id_causa=$cod AND estadoauto='Activo'";
		return parent::ejecutar($sql);
	}
	public function darbajaAutoOrden()
	{
		$sql="UPDATE autoorden SET estadoauto='$this->estadoauto' WHERE id_autoorden='$this->id_autoorden'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	

}
?>