<?php  
include_once('clsconexion.php');
class Materia extends Conexion{
	private $id_materia;
	private $nombmateria;
	private $abrevmat;
	private $estado;

	public function Materia()
	{
		parent::Conexion();
		$this->id_materia=0;
		$this->nombmateria="";
		$this->abrevmat="";
		$this->estado="";

	}

	public function setid_materia($valor)
	{
		$this->id_materia=$valor;
	}
	public function getid_materia()
	{
		return $this->id_materia;
	}
	public function setnombmateria($valor)
	{
		$this->nombmateria=$valor;
	}
	public function getnombmateria()
	{
		return $this->nombmateria;
	}
	public function setabrevmateria($valor)
	{
		$this->abrevmat=$valor;
	}
	public function getabrevmateria()
	{
		return $this->abrevmat;
	}

	public function setestadomat($valor)
	{
		$this->estado=$valor;
	}
	public function getestadomat()
	{
		return $this->estado;
	}

	public function guardarmateria()
	{
		$sql="INSERT INTO materia(nombremateria,abreviaturamat,estado) VALUES('$this->nombmateria','$this->abrevmat','$this->estado')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarUnaMateriaDeCausa($cod)
	{
		$sql="SELECT (materia.id_materia)AS idmateriaa,(materia.abreviaturamat)AS abrevmatt,(materia.nombremateria)AS nombmat FROM causa,materia WHERE causa.id_materia=materia.id_materia AND causa.id_causa=$cod";
		return parent::ejecutar($sql);
	}
	public function listarMateriasActivasExceptoUna($cod) 
	{
		$sql="SELECT *FROM materia where estado='Activo' and id_materia<>$cod ";
		return parent::ejecutar($sql);
	}

	public function listarmateria()
	{
		$sql="SELECT *FROM materia where estado='Activo' ";
		return parent::ejecutar($sql);
	}
	public function mostrarunaMateria($cod)
	{
		$sql="SELECT id_materia,nombremateria, abreviaturamat FROM materia where id_materia=$cod";
		return parent::ejecutar($sql);
	}

	public function modificaMateria()
	{
		$sql="UPDATE materia SET nombremateria='$this->nombmateria', abreviaturamat='$this->abrevmat' where id_materia='$this->id_materia'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	public function darbajamateria()
	{
		$sql="UPDATE materia SET estado='$this->estado' WHERE id_materia='$this->id_materia'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	

}
?>