<?php
include_once('clsconexion.php');
class ClaseTribunal extends Conexion{
	private $id_clstribunal;
	private $nombclstrib;
	private $estado;

	public function ClaseTribunal()
	{
		parent::Conexion();
		$this->id_clstribunal=0;
		$this->nombclstrib="";
		$this->estado="";
	}

	public function setid_clasetrib($valor)
	{
		$this->id_clstribunal=$valor;
	}
	public function getid_clasetrib()
	{
		return $this->id_clstribunal;
	}
	public function setnombreclstrib($valor)
	{
		$this->nombclstrib=$valor;
	}
	public function getnombreclstrib()
	{
		return $this->nombclstrib;
	}

	public function setestadoclstrib($valor)
	{
		$this->estado=$valor;
	}
	public function getestadoclstrib()
	{
		return $this->estado;
	}

	public function guardarclasetrib()
	{
		$sql="INSERT INTO clase_tribunal(nombreclasetrib,estado) VALUES('$this->nombclstrib','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarclasetribunal()
	{
		$sql="SELECT *FROM clase_tribunal WHERE estado='Activo' ORDER BY nombreclasetrib ASC ";
		return parent::ejecutar($sql);
	}

	public function modificarclasetribunal()
	{
		$sql="UPDATE clase_tribunal SET nombreclasetrib='$this->nombclstrib' WHERE id_clasetribunal='$this->id_clstribunal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function darbajaclasedeTribunal()
	{
		$sql="UPDATE clase_tribunal SET estado='$this->estado' WHERE id_clasetribunal='$this->id_clstribunal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

}
?>