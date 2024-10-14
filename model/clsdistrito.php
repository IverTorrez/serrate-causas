<?php
include_once('clsconexion.php');
class Distrito extends Conexion{
	private $id_distrito;
	private $nombdistrito;
	private $abrevdist;
	private $estado;

	public function Distrito()
	{
		parent::Conexion();
		$this->id_distrito=0;
		$this->nombdistrito="";
		$this->abrevdist="";
		$this->estado="";
	}

	public function setid_distrito($valor)
	{
		$this->id_distrito=$valor;
	}
	public function getid_distrito()
	{
		return $this->id_distrito;
	}
	public function setnombredistrito($valor)
	{
		$this->nombdistrito=$valor;
	}
	public function getnombredistrito()
	{
		return $this->nombdistrito;
	}
	public function setabreviaturadist($valor)
	{
		$this->abrevdist=$valor;
	}
	public function getabreviaturadist()
	{
		return $this->abrevdist;
	}

	public function setestadodist($valor)
	{
		$this->estado=$valor;
	}
	public function getestadodist()
	{
		return $this->estado;
	}

	public function guardardistrito()
	{
		$sql="INSERT INTO distrito(nombredistrito,abreviaturadist,estado) VALUES('$this->nombdistrito','$this->abrevdist','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listardistritos()
	{
		$sql="SELECT *FROM distrito WHERE estado='Activo' ORDER BY nombredistrito ASC";
		return parent::ejecutar($sql);
	}

	public function modificardistrito()
	{
		$sql="UPDATE distrito set nombredistrito='$this->nombdistrito', abreviaturadist='$this->abrevdist' WHERE id_distrito='$this->id_distrito'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function darbajadistrito()
	{
		$sql="UPDATE distrito SET estado='$this->estado' WHERE id_distrito='$this->id_distrito'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
   /*MUESTRA EL DISTRITO DE UN TRIBUNAL O JUZGADOS*/
	public function mostrarDistritoDetribunal($cod)
	{
		$sql="SELECT (distrito.id_distrito)AS iddistrito,nombredistrito,abreviaturadist FROM  juzgados,distrito WHERE juzgados.id_distrito=distrito.id_distrito AND juzgados.id_juzgados=$cod";
		return parent::ejecutar($sql);
	}

	public function listarDistritosexeptouno($cod)
	{
		$sql="SELECT *FROM distrito WHERE estado='Activo' AND id_distrito<>$cod ORDER BY nombredistrito ASC";
		return parent::ejecutar($sql);
	}


}
?>