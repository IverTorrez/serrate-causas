<?php
include_once('clsconexion.php');
class Plantilla extends Conexion{
	private $id_plantilla;
	private $nombplantilla;
	private $estado;
	

	public function Plantilla()
	{
		parent::Conexion();
		$this->id_plantilla=0;
		$this->nombplantilla="";
		$this->estado="";
	}

	public function setid_plantilla($valor)
	{
		$this->id_plantilla=$valor;
	}
	public function getid_plantilla()
	{
		return $this->id_plantilla;
	}
	public function setnombreplantilla($valor)
	{
		$this->nombplantilla=$valor;
	}
	public function getnombreplantilla()
	{
		return $this->nombplantilla;
	}
	

	public function setestadoplan($valor)
	{
		$this->estado=$valor;
	}
	public function getestadoplan()
	{
		return $this->estado;
	}

	public function guardarplantilla()
	{
		$sql="INSERT INTO plantilla(nombreplantilla,estado) VALUES('$this->nombplantilla','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarplantillasActivas()
	{
		$sql="SELECT id_plantilla,nombreplantilla FROM plantilla WHERE estado='Activa'";
		return parent::ejecutar($sql);
	}
	public function listarplantillasActivasConPostas()
	{
		$sql="SELECT (plantilla.id_plantilla)AS id_plantilla,nombreplantilla FROM plantilla,posta WHERE  plantilla.estado='Activa' AND plantilla.id_plantilla=posta.id_plantilla GROUP BY plantilla.id_plantilla";
		return parent::ejecutar($sql);
	}

	public function mostrarUnaPlantilla($cod)
	{
		$sql="SELECT id_plantilla, nombreplantilla FROM plantilla WHERE id_plantilla=$cod AND plantilla.estado='Activa'";
		return parent::ejecutar($sql);
	}

	public function darbajaplantilla()
	{
		$sql="UPDATE plantilla SET estado='$this->estado' WHERE id_plantilla='$this->id_plantilla' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function modificarplantillanombre()
	{
		$sql="UPDATE plantilla SET nombreplantilla='$this->nombplantilla' WHERE id_plantilla='$this->id_plantilla'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	


	
}
?>