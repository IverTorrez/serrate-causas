<?php
include_once('clsconexion.php');
class TipoLegal extends Conexion{
	private $id_tipolegal;
	private $nombtplegal;
	private $abrevtplegal;
	private $estado;
	private $id_materia;

	public function TipoLegal()
	{
		parent::Conexion();
		$this->id_tipolegal=0;
		$this->nombtplegal="";
		$this->abrevtplegal="";
		$this->estado="";
		$this->id_materia;
	}

	public function setid_tplegal($valor)
	{
		$this->id_tipolegal=$valor;
	}
	public function getid_tplegal()
	{
		return $this->id_tipolegal;
	}
	public function setnombtplegal($valor)
	{
		$this->nombtplegal=$valor;
	}
	public function getnombtplegal()
	{
		return $this->nombtplegal;
	}
	public function setabrevtplegal($valor)
	{
		$this->abrevtplegal=$valor;
	}
	public function getabrevtplegal()
	{
		return $this->abrevtplegal;
	}

	public function setestado($valor)
	{
		$this->estado=$valor;
	}
	public function getestado()
	{
		return $this->estado;
	}


	public function setid_materiatp($valor)
	{
		$this->id_materia=$valor;
	}
	public function getid_materiatp()
	{
		return $this->id_materia;
	}

	public function guardartipolegal()
	{
		$sql="INSERT INTO tipolegal(nombretipolegal,abreviaturalegal,estado,id_materia) VALUES('$this->nombtplegal','$this->abrevtplegal','$this->estado','$this->id_materia')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listartipolegal()
	{
		$sql="SELECT id_tipolegal,nombretipolegal,abreviaturalegal, (tipolegal.id_materia)as idmat,(materia.nombremateria)as matlegal FROM tipolegal,materia 
WHERE tipolegal.id_materia=materia.id_materia AND tipolegal.estado='Activo' ORDER BY matlegal ASC,abreviaturalegal ASC ";
		return parent::ejecutar($sql);
	}

	public function listarUNtipolegalDeCausa($cod)
	{
		$sql="SELECT (tipolegal.id_tipolegal)AS idtplegal,(tipolegal.nombretipolegal)AS nomtplegal,(tipolegal.abreviaturalegal)AS abrevtplegal FROM tipolegal,causa WHERE causa.id_tipolegal=tipolegal.id_tipolegal AND causa.id_causa=$cod";
		return parent::ejecutar($sql);
	}
	public function listartipolegalActivosExceptoUno($cod)
	{
		$sql="SELECT *FROM tipolegal WHERE estado='Activo' and id_tipolegal<>$cod";
		return parent::ejecutar($sql);
	}
    /*ENLISTA TODAS LOS TIPOS LEGALES DE UNA MATERIA EXEPTO UNA*/
	public function listartipolegalActivosDeUnaMateriaExceptoUno($cod,$codmat)
	{
		$sql="SELECT *FROM tipolegal WHERE estado='Activo' and id_tipolegal<>$cod AND id_materia=$codmat";
		return parent::ejecutar($sql);
	}

	public function mostrarunTipolegal($cod)
	{
		$sql="SELECT id_tipolegal, nombretipolegal,abreviaturalegal FROM tipolegal WHERE id_tipolegal=$cod";
		return parent::ejecutar($sql);
	}

	public function modificartipolegal()
	{
		$sql="UPDATE tipolegal SET nombretipolegal='$this->nombtplegal', abreviaturalegal='$this->abrevtplegal', id_materia='$this->id_materia' WHERE id_tipolegal='$this->id_tipolegal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function darbajatipolegal()
	{
		$sql="UPDATE tipolegal SET estado='$this->estado' WHERE id_tipolegal='$this->id_tipolegal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function listartipolegalDeUnaMateria($cod)
	{
		$sql="SELECT id_tipolegal,nombretipolegal,abreviaturalegal FROM tipolegal WHERE id_materia=$cod AND estado='Activo' ";
		return parent::ejecutar($sql);
	}
    /*ENLISTA TODOS LOS TIPOS LEGALES CON SU MATERIA, PARA EL FILTRADO DE CAUSA POR CODIGO*/
	public function listarLosTiposLegalConSuMateria()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal)AS Codigo,id_tipolegal FROM tipolegal,materia WHERE tipolegal.id_materia=materia.id_materia AND tipolegal.estado='Activo'";
		return parent::ejecutar($sql);
	}



}

?>