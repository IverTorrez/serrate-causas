<?php 
include_once('clsconexion.php');
class TipoUsuario extends Conexion{
	private $id_tipousuario;
	private $nombretipou;

	public function TipoUsuario(){
		parent::Conexion();
		$this->id_tipousuario=0;
		$this->nombretipou="";
	}

	public function setid_tipo($valor)
	{
      $this->id_tipousuario=$valor;
	}
	public function getid_tipo()
	{
		return $this->id_tipousuario;
	}
	public function setnombretipo($valor)
	{
		$this->nombretipou=$valor;
	}
	public function getnombretipo()
	{
		return $this->nombretipou;
	}

	public function guardartipousuario()
	{
		$sql="INSERT INTO tipousuario(nombretipo) VALUES('$this->nombretipou')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}
	public function listartipousu()
	{
		$sql="SELECT *FROM tipousuario";
		return parent::ejecutar($sql);
	}


}

 ?>
