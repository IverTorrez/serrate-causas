<?php
include_once('clsconexion.php');
class TransferenciaContador extends Conexion
{
	private $id_transferencia;
	private $fechatrans;
	private $montotrans;
	private $tipotrans;
	private $id_usuario;
	
	

	public function TransferenciaContador()
	{
		parent::Conexion();
		$this->id_transferencia=0;
		$this->fechatrans="";
		$this->montotrans=0;
		$this->tipotrans="";
		$this->id_usuario=0;
		
		
	}

	public function setid_transferencia($valor)
	{
		$this->id_transferencia=$valor;
	}
	public function getid_transferencia()
	{
		return $this->id_transferencia;
	}
	public function setfechatransferencia($valor)
	{
		$this->fechatrans=$valor;
	}
	public function getfechatransferencia()
	{
		return $this->fechatrans;
	}
	public function setmontotransferencia($valor)
	{
		$this->montotrans=$valor;
	}
	public function getmontotransferencia()
	{
		return $this->montotrans;
	}
	public function settipotransferencia($valor)
	{
		$this->tipotrans=$valor;
	}
	public function gettipotransferencia()
	{
		return $this->tipotrans;
	}

	public function setId_usuario($valor)
	{
		$this->id_usuario=$valor;
	}

	public function getid_usuario()
	{
		return $this->id_usuario;
	}
	

	
	public function guardartransferenciaContador()
	{
		$sql="INSERT INTO transferencia_contador(fecha_trans,monto_trans,tipo_trans,id_usuario) VALUES('$this->fechatrans','$this->montotrans','$this->tipotrans','$this->id_usuario')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function listarTransferenciasCOntador()
	{
		$sql="SELECT id_tranferencia,fecha_trans,monto_trans,tipo_trans FROM transferencia_contador";
		return parent::ejecutar($sql);
	}
		

}
?>