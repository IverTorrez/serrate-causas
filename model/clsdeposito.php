<?php
include_once('clsconexion.php');
class Deposito extends Conexion{
	private $id_deposito;
	private $fechadeposito;
	private $detalledeposito;
	private $montodeposito;
	private $id_causa;
	private $tipdeposito;
	private $idorigen;

	public function Deposito()
	{
		parent::Conexion();
		$this->id_deposito=0;
		$this->fechadeposito="";
		$this->detalledeposito="";
		$this->montodeposito=0;
		$this->id_causa=0;
		$this->tipdeposito="";
		$this->idorigen=0;
	}

	public function setid_deposito($valor)
	{
		$this->id_deposito=$valor;
	}
	public function getid_deposito()
	{
		return $this->id_deposito;
	}
	public function setfechadeposito($valor)
	{
		$this->fechadeposito=$valor;
	}
	public function getfechadeposito()
	{
		return $this->fechadeposito;
	}

	public function setdetalledeposito($valor)
	{
		$this->detalledeposito=$valor;
	}
	public function getdetalledeposito()
	{
		return $this->detalledeposito;
	}

	public function setmontodeposito($valor)
	{
		$this->montodeposito=$valor;
	}
	public function getmontodeposito()
	{
		return $this->montodeposito;
	}

	public function setid_causadeposito($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causadeposito()
	{
		return $this->id_causa;
	}
	public function settipodeposito($valor)
	{
		$this->tipdeposito=$valor;
	}
	public function gettipodeposito()
	{
		return $this->tipdeposito;
	}
	public function setidorigen($valor)
	{
		$this->idorigen=$valor;
	}
	public function getidorigen()
	{
		return $this->idorigen;
	}




	public function guardardeposito()
	{
		$sql="INSERT INTO deposito(fecha_deposito,detalle_deposito,monto_deposito,id_causa,tipodeposito,idorigendeposito) VALUES('$this->fechadeposito','$this->detalledeposito','$this->montodeposito','$this->id_causa','$this->tipdeposito','$this->idorigen')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function Listardepositodecausa($cod)
	{
		$sql="SELECT id_deposito,fecha_deposito,detalle_deposito,monto_deposito FROM deposito WHERE id_causa=$cod and tipodeposito='Deposito'";
		return parent::ejecutar($sql);
	}

	public function ListarTransferenciarecibidadecausa($cod)
	{
		$sql="SELECT id_deposito,fecha_deposito,detalle_deposito,monto_deposito FROM deposito WHERE id_causa=$cod and tipodeposito='Transferencia'";
		return parent::ejecutar($sql);
	}

	public function ListarTransferenciaentregadadecausa($cod)
	{
		$sql="SELECT id_deposito,fecha_deposito,detalle_deposito,monto_deposito FROM deposito WHERE deposito.idorigendeposito=$cod and tipodeposito='Transferencia'";
		return parent::ejecutar($sql);
	}

}
?>