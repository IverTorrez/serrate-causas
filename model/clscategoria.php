<?php
include_once('clsconexion.php');
class Categoria extends Conexion{
	private $id_categoria;
	private $nombcat;
	private $abrevcat;
	private $estado;

	public function Categoria()
	{
		parent::Conexion();
		$this->id_categoria=0;
		$this->nombcat="";
		$this->abrevcat="";
		$this->estado="";
	}

	public function setid_categoria($valor)
	{
		$this->id_categoria=$valor;
	}
	public function getid_categoria()
	{
		return $this->id_categoria;
	}
	public function setnombcategoria($valor)
	{
		$this->nombcat=$valor;
	}
	public function getnombcategoria()
	{
		return $this->nombcat;
	}
	public function setabrevcategoria($valor)
	{
		$this->abrevcat=$valor;
	}
	public function getabrevcategoria()
	{
		return $this->abrevcat;
	}

	public function setestadocat($valor)
	{
		$this->estado=$valor;
	}
	public function getestadocat()
	{
		return $this->estado;
	}

	public function guardarcategoria()
	{
		$sql="INSERT INTO categoria(nombrecat,abreviaturacat,estado) VALUES('$this->nombcat','$this->abrevcat','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarcategoria()
	{
		$sql="SELECT *FROM categoria WHERE estado='Activo'";
		return parent::ejecutar($sql);
	}
	public function listarcategoriaActivasExceptoUna($cod)
	{
		$sql="SELECT *FROM categoria WHERE estado='Activo' and id_categoria<>$cod";
		return parent::ejecutar($sql);
	}

	public function listarUnacategoriaDeCausa($cod)
	{
		$sql="SELECT (categoria.id_categoria)AS idcat,nombrecat,abreviaturacat FROM categoria,causa WHERE causa.id_categoria=categoria.id_categoria AND causa.id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function listarCategoriasActivas()
	{
		$sql="SELECT id_categoria,nombrecat,abreviaturacat FROM categoria WHERE estado='Activo' ORDER BY nombrecat ASC ";
		return parent::ejecutar($sql);
	}

	public function modificarcategoria()
	{
		$sql="UPDATE categoria SET nombrecat='$this->nombcat', abreviaturacat='$this->abrevcat' WHERE id_categoria='$this->id_categoria'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function darbajacategoria()
	{
		$sql="UPDATE categoria SET estado='$this->estado' WHERE id_categoria='$this->id_categoria'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}


	
}
?>