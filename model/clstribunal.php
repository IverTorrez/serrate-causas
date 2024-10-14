<?php
include_once('clsconexion.php');
class Tribunal extends Conexion{
	private $id_tribunal;
	private $expedientet;
	private $codnurianuj;
	
	private $id_clstrib;
	private $id_causa;
	private $id_juzgado;
	private $linkcarpeta;
 
	public function Tribunal()
	{
		parent::Conexion();
        $this->id_tribunal=0;
		$this->expedientet="";
		$this->codnurianuj="";
		
		$this->id_clstrib=0;
		$this->id_causa=0;
		$this->id_juzgado=0;
		$this->linkcarpeta="";
	}

	public function setid_tribunal($valor)
	{
		$this->id_tribunal=$valor;
	}
	public function getid_tribunal()
	{
		return $this->id_tribunal;
	}

	public function setexpediente($valor)
	{
		$this->expedientet=$valor;
	}
	public function getexpediente()
	{
		return $this->expedientet;
	}
	public function setcodigonianuj($valor)
	{
		$this->codnurianuj=$valor;
	}
	public function getcodigonianuj()
	{
		return $this->codnurianuj;
	}
	
	public function setid_clstribunalt($valor)
	{
		$this->id_clstrib=$valor;
	}
	public function getid_clstribunalt()
	{
		return $this->id_clstrib;
	}
	public function setid_causat($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causat()
	{
		return $this->id_causa;
	}
	public function setid_juzgadot($valor)
	{
		$this->id_juzgado=$valor;
	}
	public function getid_juzgadot()
	{
		return $this->id_juzgado;
	}

	public function setlinkcarpeta($valor)
	{
		$this->linkcarpeta=$valor;
	}
	public function getlinkcarpeta()
	{
		return $this->linkcarpeta;
	}



	public function guardartribunal()
	{
		$sql="INSERT INTO tribunal(expediente,codnurejianuj,id_clasetribunal,id_causa,id_juzgados,linkcarpeta) VALUES ('$this->expedientet','$this->codnurianuj','$this->id_clstrib','$this->id_causa','$this->id_juzgado','$this->linkcarpeta')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listartribunalficha($idcausa)
	{
		$sql="SELECT (clase_tribunal.nombreclasetrib)as tptribu, concat(juzgados.nombrenumerico,'º ',juzgados.jerarquia,' ',juzgados.materiajuz,' ',distrito.abreviaturadist)as juzg, coordenadasjuz ,fotojuz, (piso.nombrepiso)as Pis, expediente,codnurejianuj,(juzgados.contacto1)as cont1,(juzgados.contacto2)as cont2,(juzgados.contacto3)as cont3,(juzgados.contacto4)as cont4,(juzgados.id_juzgados)as idjuzgado, id_tribunal FROM tribunal,clase_tribunal,juzgados,piso,distrito WHERE distrito.id_distrito=juzgados.id_distrito AND piso.id_piso=juzgados.id_piso AND juzgados.id_juzgados=tribunal.id_juzgados AND clase_tribunal.id_clasetribunal=tribunal.id_clasetribunal AND id_causa=$idcausa ORDER BY id_tribunal ASC";
	    return parent::ejecutar($sql);
	}

	public function eliminarTribunalCausa()
	{
		$sql="DELETE FROM tribunal WHERE id_causa='$this->id_causa' AND id_tribunal='$this->id_tribunal' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function mostrardatosdeUntribunal($cod)
	{
		$sql="SELECT id_tribunal,expediente,codnurejianuj,linkcarpeta,id_clasetribunal,id_causa,id_juzgados FROM tribunal WHERE id_tribunal=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarDetallesDeTribunal($cod)
	{
		$sql="SELECT (clase_tribunal.nombreclasetrib)as tptribu,concat(juzgados.nombrenumerico,'º ',juzgados.jerarquia,' ',juzgados.materiajuz,' ',distrito.abreviaturadist)as juzg,expediente,codnurejianuj FROM tribunal,juzgados,clase_tribunal,distrito WHERE distrito.id_distrito=juzgados.id_distrito AND juzgados.id_juzgados=tribunal.id_juzgados AND clase_tribunal.id_clasetribunal=tribunal.id_clasetribunal AND tribunal.id_tribunal=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarDatosDeTribunalDeCausaYJuzgado($codcausa,$codjuz)
	{
		$sql="SELECT id_tribunal,expediente,codnurejianuj,linkcarpeta,id_clasetribunal,id_causa,id_juzgados FROM tribunal WHERE id_causa=$codcausa AND id_juzgados=$codjuz";
		return parent::ejecutar($sql);
	}
	public function modificarelLinkDeCarpetaDeTribunal()
	{
		$sql="UPDATE tribunal SET linkcarpeta='$this->linkcarpeta' WHERE id_tribunal='$this->id_tribunal'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	

}
?>