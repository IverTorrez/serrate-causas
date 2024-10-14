<?php
include_once('clsconexion.php');
class CuerpoExpediente extends Conexion{
	private $id_cuerpo;
	private $linkcuerpo;
	private $nombrecuerpo;
	
	private $id_tribunal;
	
 
	public function CuerpoExpediente()
	{
		parent::Conexion();
        $this->id_cuerpo=0;
		$this->linkcuerpo="";
		$this->nombrecuerpo="";
		
		$this->id_tribunal=0;
		
	}

	public function setid_cuerpo($valor)
	{
		$this->id_cuerpo=$valor;
	}
	public function getid_cuerpo()
	{
		return $this->id_cuerpo;
	}

	public function setlinkcuerpo($valor)
	{
		$this->linkcuerpo=$valor;
	}
	public function getlinkcuerpo()
	{
		return $this->linkcuerpo;
	}
	public function setnombrecuerpo($valor)
	{
		$this->nombrecuerpo=$valor;
	}
	public function getnombrecuerpo()
	{
		return $this->nombrecuerpo;
	}
	
	public function setid_tribunal($valor)
	{
		$this->id_tribunal=$valor;
	}
	public function getid_tribunal()
	{
		return $this->id_tribunal;
	}
	



	public function guardarCuerpoExpediente()
	{
		$sql="INSERT INTO cuerpo_expediente(linkcuerpo,nombrecuerpo,id_tribunal) VALUES ('$this->linkcuerpo','$this->nombrecuerpo','$this->id_tribunal')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function mostrarLosCuerposDeExpedientesDeTribunal($codtrib)
	{
		$sql="SELECT id_cuerpo,linkcuerpo,nombrecuerpo,id_tribunal FROM cuerpo_expediente WHERE id_tribunal=$codtrib ORDER BY nombrecuerpo ASC ";
		return parent::ejecutar($sql);
	}

	public function modificarCuerpoExpediente()
	{
		$sql="UPDATE cuerpo_expediente SET linkcuerpo='$this->linkcuerpo', nombrecuerpo='$this->nombrecuerpo' WHERE id_cuerpo='$this->id_cuerpo'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function eliminarcuerpoexp()
	{
		$sql="DELETE FROM cuerpo_expediente WHERE id_cuerpo='$this->id_cuerpo'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function eliminarCuerposDeTribunal()
	{
		$sql="DELETE FROM cuerpo_expediente WHERE id_tribunal='$this->id_tribunal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	

	

}
?>