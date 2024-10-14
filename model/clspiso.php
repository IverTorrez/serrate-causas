<?php
include_once('clsconexion.php');
class Piso extends Conexion{
	private $id_piso;
	private $nombpiso;
	private $estado;

	public function Piso()
	{
		parent::Conexion();
		$this->id_piso=0;
		$this->nombpiso="";
		$this->estado="";
	}

	public function setid_piso($valor)
	{
		$this->id_piso=$valor;
	}
	public function getid_piso()
	{
		return $this->id_piso;
	}
	public function setnombrepiso($valor)
	{
		$this->nombpiso=$valor;
	}
	public function getnombrepiso()
	{
		return $this->nombpiso;
	}

	public function setestado($valor)
	{
		$this->estado=$valor;
	}
	public function getestado()
	{
		return $this->estado;
	}

	public function guardarpiso()
	{
		$sql="INSERT INTO piso(nombrepiso,estado) VALUES('$this->nombpiso','$this->estado')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarpisos()
	{
		$sql="SELECT *FROM piso WHERE estado='Activo' ORDER BY nombrepiso DESC";
		return parent::ejecutar($sql);
	}
	public function mostrarUnPiso($cod)
	{
		$sql="SELECT id_piso,nombrepiso FROM piso where id_piso=$cod";
		return parent::ejecutar($sql);
	}

	public function modificarpiso()
	{
		$sql="UPDATE piso SET nombrepiso='$this->nombpiso' WHERE id_piso='$this->id_piso'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	public function darbajapiso()
	{
		$sql="UPDATE piso SET estado='$this->estado' WHERE id_piso='$this->id_piso'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}
    /*MOSTRAMOS UN PISO RELACIONADO CON EL JUZGADO O TRIBUNAL*/
	public function mostrarpisoEnTribunal($cod)
	{
     $sql="SELECT (piso.id_piso)AS idpiso,nombrepiso FROM  juzgados,piso WHERE juzgados.id_piso=piso.id_piso AND juzgados.id_juzgados=$cod";
     return parent::ejecutar($sql);
	}

	public function listarPisosActivosExeptoUno($cod)
	{
		$sql="SELECT id_piso,nombrepiso FROM piso where id_piso<>$cod AND estado='Activo' ORDER BY nombrepiso DESC";
		return parent::ejecutar($sql);
	}


}
?>