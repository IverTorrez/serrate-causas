<?php
include_once('clsconexion.php');
class PostaCausa extends Conexion{
	private $id_postacausa;
	private $numeropostacausa;
	private $nombpostacausa;
	private $estado;
	private $id_causa;
	private $copianombplantilla;

	public function PostaCausa()
	{
		parent::Conexion();
		$this->id_postacausa=0;
		$this->numeropostacausa=0;
		$this->nombpostacausa="";
		$this->estado="";
		$this->id_causa=0;
		$this->copianombplantilla="";
	}

	public function setid_postacausa($valor)
	{
		$this->id_postacausa=$valor;
	}
	public function getid_postacausa()
	{
		return $this->id_postacausa;
	}
	public function setnumeropostacausa($valor)
	{
		$this->numeropostacausa=$valor;
	}
	public function getnumeropostacausa()
	{
		return $this->numeropostacausa;
	}
	

	public function setnombrepostacausa($valor)
	{
		$this->nombpostacausa=$valor;
	}
	public function getnombrepostacausa()
	{
		return $this->nombpostacausa;
	}
	
	public function setestadopostacausa($valor)
	{
		$this->estado=$valor;
	}
	public function getestadopostascausa()
	{
		return $this->estado;
	}

	public function setid_causap($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causap()
	{
		return $this->id_causa;
	}

	public function setcopianombreplantilla($valor)
	{
		$this->copianombplantilla=$valor;
	}
	public function getcopianombreplantilla()
	{
		return $this->copianombplantilla;
	}




	public function guardarpostaCausa()
	{
		$sql="INSERT INTO postacausa(numeropostacausa,nombrepostacausa,estado,id_causa,copianombreplantilla) VALUES('$this->numeropostacausa','$this->nombpostacausa','$this->estado','$this->id_causa','$this->copianombplantilla')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarPostasDeCausa($cod)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa  FROM postacausa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function listarPostasDeCausaApartirDePosta1($cod)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa  FROM postacausa WHERE id_causa=$cod AND numeropostacausa>0 ORDER BY id_postacausa ASC";
		return parent::ejecutar($sql);
	}
 
	public function cambiarestadoPostaCausa()
	{
		$sql="UPDATE postacausa SET estado='$this->estado' WHERE id_postacausa='$this->id_postacausa'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
    /*MUESTRA LA PRIMER POSTA DE UNA PLANTILLA DE LA CAUSA*/
	public function mostrarPrimerPostaCausa($cod,$codcausa)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa FROM postacausa WHERE numeropostacausa=$cod AND id_causa=$codcausa";
		return parent::ejecutar($sql);
	}
    /*MUESTRA UNA POSTA APARTIR DEL ID_POSTACAUSA Y ID_CAUSA*/
	public function mostrarUnaPostaCausa($cod,$codcausa)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa FROM postacausa WHERE id_postacausa=$cod AND id_causa=$codcausa ";
		return parent::ejecutar($sql);
	}
	public function contadorDePostasCausaDeunaCausa($cod)
	{
		$sql="SELECT COUNT(id_postacausa)as cantidadPostas FROM postacausa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function eliminarPostasDeUNaCausa()
	{
		$sql="DELETE FROM postacausa WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function mostrarUnaPostaEnUnaCausaConIdPostaCausa($cod)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa FROM postacausa WHERE id_postacausa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostaraPostaCeroDeUnaCausa($cod)
	{
		$sql="SELECT id_postacausa,numeropostacausa,nombrepostacausa,estado,copianombreplantilla,id_causa FROM postacausa WHERE id_causa=$cod AND numeropostacausa=0";
		return parent::ejecutar($sql);
	}


	

	


	
}
?>