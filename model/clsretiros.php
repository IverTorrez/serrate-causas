<?php
include_once('clsconexion.php');
class Retiros extends Conexion{
	private $id_retiro;
	private $montoretiro;
	private $montosobrante;
	private $fecharetiro;
	private $detalleretiro;
	private $monto_totalcaja;
	private $id_usuario;
	

	public function Retiros()
	{
		parent::Conexion();
		$this->id_retiro=0;
		$this->montoretiro=0;
		$this->montosobrante=0;
		$this->fecharetiro="";
		$this->detalleretiro="";
		$this->monto_totalcaja=0;
		$this->id_usuario=0;
		
	}

	public function setid_retiro($valor)
	{
		$this->id_retiro=$valor;
	}
	public function getid_retiro()
	{
		return $this->id_retiro;
	}
	public function setmontoretiro($valor)
	{
		$this->montoretiro=$valor;
	}
	public function getmontoretiro()
	{
		return $this->montoretiro;
	}
	public function setmontosobrante($valor)
	{
		$this->montosobrante=$valor;
	}
	public function getmontosobrante()
	{
		return $this->montosobrante;
	}
	public function setfecharetiro($valor)
	{
		$this->fecharetiro=$valor;
	}
	public function getfecharetiro()
	{
		return $this->fecharetiro;
	}
	public function setdetalleretiro($valor)
	{
		$this->detalleretiro=$valor;
	}
	public function getdetalleretiro()
	{
		return $this->detalleretiro;
	}

	public function setmontototalcaja($valor)
	{
		$this->monto_totalcaja=$valor;
	}
	public function getmontototalcaja()
	{
		return $this->monto_totalcaja;
	}

	public function setid_usuarioret($valor)
	{
       $this->id_usuario=$valor;
	}
	public function getid_usuarioret()
	{
		return $this->id_usuario;
	}
	
	

	public function guardarretiro()
	{
		$sql="INSERT INTO retiros(monto_retiro,monto_sobrante,fecha_retiro,detalle_retiro,montototalcaja,id_usuario) VALUES('$this->montoretiro','$this->montosobrante','$this->fecharetiro','$this->detalleretiro','$this->monto_totalcaja','$this->id_usuario')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function listar_retiros()
	{
		$sql="SELECT *FROM retiros ORDER BY id_retiro ASC";
		return parent::ejecutar($sql);
	}

	public function SumaDeRetiros()
	{
		$sql="SELECT SUM(retiros.monto_retiro)AS totalretirados FROM retiros";
		return parent::ejecutar($sql);
	}
	

}
?>