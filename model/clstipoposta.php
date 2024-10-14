<?php
include_once('clsconexion.php');
class TipoPosta extends Conexion{
	private $id_tipoposta;
	private $nombtipoposta;
	private $estado;
	

	public function TipoPosta()
	{
		parent::Conexion();
		$this->id_tipoposta=0;
		$this->nombtipoposta="";
		$this->estado="";
	}

	public function setid_tipoposta($valor)
	{
		$this->id_tipoposta=$valor;
	}
	public function getid_tipoposta()
	{
		return $this->id_tipoposta;
	}
	
	
	public function setnombretipoposta($valor)
	{
		$this->nombtipoposta=$valor;
	}
	public function getnombretipoposta()
	{
		return $this->nombtipoposta;
	}
	

	public function setestadotp($valor)
	{
		$this->estado=$valor;
	}
	public function getestadotp()
	{
		return $this->estado;
	}


	public function guardartipoposta()
	{
		$sql="INSERT INTO tipoposta(nombretipoposta,estado) VALUES('$this->nombtipoposta','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarTipoPostas()
	{
		$sql="SELECT id_tipoposta,nombretipoposta,estado FROM tipoposta WHERE estado='Activo'";
		return parent::ejecutar($sql);
	}

	public function listarTipoPostasTruncamientos()
	{
		$sql="SELECT id_tipoposta,nombretipoposta,estado FROM tipoposta WHERE estado='Activo' AND id_tipoposta>1";
		return parent::ejecutar($sql);
	}

	public function modificarTipoPosta()
	{
		$sql="UPDATE tipoposta SET nombretipoposta='$this->nombtipoposta' WHERE id_tipoposta='$this->id_tipoposta'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function mostrarUnTipoPosta($cod)
	{
		$sql="SELECT id_tipoposta,nombretipoposta FROM tipoposta WHERE id_tipoposta=$cod";
		return parent::ejecutar($sql);
	}
	public function DarbajaTipoPosta()
	{
		$sql="UPDATE tipoposta SET estado='$this->estado' WHERE id_tipoposta='$this->id_tipoposta'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	
	
}
?>