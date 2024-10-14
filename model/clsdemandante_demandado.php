<?php
include_once('clsconexion.php');
class Demandante_Demandado extends Conexion{
	private $id_demdem;
	private $nombdem;
	private $tipod;
	private $ultimodom;
	private $foja;
	private $id_causa;
	private $estadodem;

	private $ultimodomiciliosolotexto;

	public function Demandante_Demandado()
	{
		parent::Conexion();
		$this->id_demdem=0;
		$this->nombdem="";
		$this->tipod="";
		$this->ultimodom="";
		$this->foja="";
		$this->id_causa=0;
		$this->estadodem="";
		$this->ultimodomiciliosolotexto="";
	}

	public function setid_demdem($valor)
	{
		$this->id_demdem=$valor;
	}
	public function getid_demdem()
	{
		return $this->id_demdem;
	}
	public function setnombdeman($valor)
	{
		$this->nombdem=$valor;
	}
	public function getnombdeman()
	{
		return $this->nombdem;
	}
	public function settipodeman($valor)
	{
		$this->tipod=$valor;
	}
	public function gettipodeman()
	{
		return $this->tipod;
	}
	public function setultimo($valor)
	{
		$this->ultimodom=$valor;
	}
	public function getultimo()
	{
		return $this->ultimodom;
	}

	public function setfoja($valor)
	{
		$this->foja=$valor;
	}
	public function getfoja()
	{
		return $this->foja;
	}
	public function setid_causadem($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causadem()
	{
		return $this->id_causa;
	}

	public function setestadodeman($valor)
	{
		$this->estadodem=$valor;
	}
	public function getestadodem()
	{
		return $this->estadodem;
	}

	public function setultimodomiciliosolotexto($valor)
	{
		$this->ultimodomiciliosolotexto=$valor;
	}
	public function getultimodomiciliosolotexto()
	{
		return $this->ultimodomiciliosolotexto;
	}



	public function guardardemand()
	{
		$sql="INSERT INTO denandante_demandado(nombresdeman,tipodeman,id_causa,foja,ultimodomicilio,estadodem,ultimodomiciliosolotexto) VALUES('$this->nombdem','$this->tipod','$this->id_causa','$this->foja','$this->ultimodom','$this->estadodem','$this->ultimodomiciliosolotexto')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listardemandante($cod)
	{
		$sql="SELECT *FROM denandante_demandado WHERE tipodeman='Demandante' AND id_causa=$cod AND estadodem='Activo'";
		return parent::ejecutar($sql);
	}

	public function listardemandado($cod)
	{
		$sql="SELECT *FROM denandante_demandado WHERE tipodeman='Demandado' AND id_causa=$cod AND estadodem='Activo'";
		return parent::ejecutar($sql);
	}

	public function listartercerista($cod)
	{
		$sql="SELECT *FROM denandante_demandado WHERE tipodeman='Tercerista' AND id_causa=$cod AND estadodem='Activo'";
		return parent::ejecutar($sql);
	}

	public function mostrarUnDemandante($cod)
	{
		$sql="SELECT id_deman,nombresdeman,tipodeman,id_causa,foja,ultimodomicilio FROM denandante_demandado WHERE id_deman=$cod";
		return parent::ejecutar($sql);
	}

	public function modificarDemandadoTercer()
	{
		$sql="UPDATE denandante_demandado SET nombresdeman='$this->nombdem', foja='$this->foja', ultimodomicilio='$this->ultimodom', ultimodomiciliosolotexto='$this->ultimodomiciliosolotexto' WHERE id_deman='$this->id_demdem'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function eliminardeamndtercerista()
	{
		$sql="UPDATE denandante_demandado SET estadodem='$this->estadodem' WHERE id_deman='$this->id_demdem'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

}


?>