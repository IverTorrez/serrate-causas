<?php
include_once('clsconexion.php');
class Posta extends Conexion{
	private $id_posta;
	private $numeroposta;
	private $nombposta;
	private $id_plantilla;
	private $estado;
	

	public function Posta()
	{
		parent::Conexion();
		$this->id_posta=0;
		$this->numeroposta=0;
		$this->nombposta="";
		$this->id_plantilla=0;
		$this->estado="";
	}

	public function setid_posta($valor)
	{
		$this->id_posta=$valor;
	}
	public function getid_posta()
	{
		return $this->id_posta;
	}
	public function setnumeroposta($valor)
	{
		$this->numeroposta=$valor;
	}
	public function getnumeroposta()
	{
		return $this->numeroposta;
	}
	

	public function setnombreposta($valor)
	{
		$this->nombposta=$valor;
	}
	public function getnombreposta()
	{
		return $this->nombposta;
	}
	public function setid_plantillap($valor)
	{
		$this->id_plantilla=$valor;
	}
	public function getid_plantillap()
	{
		return $this->id_plantilla;
	}

	public function setestadop($valor)
	{
		$this->estado=$valor;
	}
	public function getestadop()
	{
		return $this->estado;
	}


	public function guardarposta()
	{
		$sql="INSERT INTO posta(numeroposta,nombreposta,id_plantilla,estado) VALUES('$this->numeroposta','$this->nombposta','$this->id_plantilla','$this->estado')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function contarpostasDePlantilla($cod)
	{
		$sql="SELECT COUNT(id_posta)AS cantidad FROM posta WHERE id_plantilla=$cod";
		return parent::ejecutar($sql);
	}

	public function listarPostasDePlantilla($cod)
	{
		$sql="SELECT id_posta, numeroposta,nombreposta,(plantilla.id_plantilla)as idplantilla FROM posta,plantilla WHERE posta.id_plantilla=plantilla.id_plantilla AND plantilla.id_plantilla=$cod AND plantilla.estado='Activa' ";
		return parent::ejecutar($sql);
	}
   /*FUNCION QUE SE UTILIZA AL INSERTAR UNA CAUSA, SE USA PARA COPIAR LOS DATOS DE LA plantilla y sus postas*/
	public function listarPostasDePLantillaParaInsertarENCausa($cod)
	{
		$sql="SELECT id_posta,numeroposta,nombreposta,id_plantilla,estado FROM posta WHERE id_plantilla=$cod AND posta.estado='Activa' ORDER BY numeroposta ASC";
		return parent::ejecutar($sql);
	}
	/*FUNCION PARA VERIFICAR CUANTAS POSTAS ACTIVAS TIENE UNA PLANTILLA(ESTO PARA NO DEJA REGISTRAR CAUSAS CON PLANTILLAS VACIAS(SIN POSTAS)) */
	public function mostrarcantidaddePostasActivasDeUnaPlantilla($cod)
	{
      $sql="SELECT COUNT(id_posta)AS cantidadpostas FROM posta WHERE estado='Activa' AND id_plantilla=$cod";
      return parent::ejecutar($sql);
	}

	public function listarSIguientePostasDEPlantilla($codposta,$codplantilla)
	{
		$sql="SELECT id_posta, numeroposta,nombreposta,(plantilla.id_plantilla)as idplantilla FROM posta,plantilla WHERE posta.id_plantilla=plantilla.id_plantilla AND plantilla.id_plantilla=$codplantilla AND plantilla.estado='Activa' 
           AND id_posta >$codposta";
           return parent::ejecutar($sql);
	}
  /*FUNCION QUE BORRA LA POSTA DE LA BASE DE DATOS*/
	public function eliminarPostaDeBD()
	{
		$sql="DELETE FROM posta WHERE id_posta='$this->id_posta'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function modificarPosta()
	{
		$sql="UPDATE posta SET nombreposta='$this->nombposta' WHERE id_posta='$this->id_posta'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarPostasDePlantillaAscendente($cod)
	{
		$sql="SELECT id_posta, numeroposta,nombreposta,(plantilla.id_plantilla)as idplantilla FROM posta,plantilla WHERE posta.id_plantilla=plantilla.id_plantilla AND plantilla.id_plantilla=$cod AND plantilla.estado='Activa' ORDER BY numeroposta ASC";
		return parent::ejecutar($sql);
	}


	


	
}
?>