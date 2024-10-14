<?php
include_once('clsconexion.php');
class InformePosta extends Conexion{
	private $id_informeposta;
	private $fojainformep;
	private $fechainformep;
	private $calculogastop;
	private $informehonp;
	private $estado;
	private $id_postacausa;
	private $id_tipoposta;

	private $fojainformetrunca;
	private $fechainformetrunca;
	private $informhonortrunca;
	

	public function InformePosta()
	{
		parent::Conexion();
		$this->id_informeposta=0;
		$this->fojainformep="";
		$this->fechainformep="";
		$this->calculogastop=0;
		$this->informehonp="";
		$this->estado="";
		$this->id_postacausa=0;
		$this->id_tipoposta=0;

		$this->fojainformetrunca="";
		$this->fechainformetrunca="";
		$this->informhonortrunca="";
	}

	public function setid_informeposta($valor)
	{
		$this->id_informeposta=$valor;
	}
	public function getid_informeposta()
	{
		return $this->id_informeposta;
	}
	public function setfojainformep($valor)
	{
		$this->fojainformep=$valor;
	}
	public function getfojainforme()
	{
		return $this->fojainformep;
	}
	

	public function setfechainforme($valor)
	{
		$this->fechainformep=$valor;
	}
	public function getfechainforme()
	{
		return $this->fechainformep;
	}
	public function setcalculogasto($valor)
	{
		$this->calculogastop=$valor;
	}
	public function getcalculogasto()
	{
		return $this->calculogastop;
	}

	public function setinformehonora($valor)
	{
		$this->informehonp=$valor;
	}
	public function getinformehonora()
	{
		return $this->informehonp;
	}

	public function setestadoinf($valor)
	{
		$this->estado=$valor;
	}
	public function getestadoinf()
	{
		return $this->estado;
	}

	public function setid_postacausainf($valor)
	{
		$this->id_postacausa=$valor;
	}
	public function getid_postacausainf()
	{
		return $this->id_postacausa;
	}

	public function setid_tipopostainf($valor)
	{
		$this->id_tipoposta=$valor;
	}
	public function getid_tipopostainf()
	{
		return $this->id_tipoposta;
	}

	public function setfojatrunca($valor)
	{
		$this->fojainformetrunca=$valor;
	}
	public function getfojatrunca()
	{
		return $this->fojainformetrunca;
	}
	public function setfechatrunca($valor)
	{
		$this->fechainformetrunca=$valor;
	}
	public function getfechatrunca()
	{
		return $this->fechainformetrunca;
	}

	public function setinformhonotrunca($valor)
	{
		$this->informhonortrunca=$valor;
	}
	public function getinformehonortrunca()
	{
		return $this->informhonortrunca;
	}



	public function guardarinformeposta()
	{
		$sql="INSERT INTO informeposta(fojainforme,fechainforme,calculogasto,informehonorario,estado,id_postacausa,id_tipoposta,fojainformetrunca,fechainformetrunca,informehonorariotrunca) VALUES('$this->fojainformep','$this->fechainformep','$this->calculogastop','$this->informehonp','$this->estado','$this->id_postacausa','$this->id_tipoposta','$this->fojainformetrunca','$this->fechainformetrunca','$this->informhonortrunca')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function muestraTodoelInformeDePosta($cod)
	{
		$sql="SELECT id_informeposta,fojainforme,fechainforme,calculogasto,informehonorario,estado,id_postacausa,id_tipoposta FROM informeposta WHERE id_postacausa=$cod";
		return parent::ejecutar($sql);
	}

	public function muestraTodoelInformeDePostaParaDemasUsuarios($cod)
	{
		$sql="SELECT id_informeposta,fojainforme,fechainforme,calculogasto,informehonorario,(informeposta.estado)as estadoInfor ,id_postacausa,(informeposta.id_tipoposta)as idtipoposta,(tipoposta.nombretipoposta)as nombreTposta,fojainformetrunca,fechainformetrunca,informehonorariotrunca FROM informeposta,tipoposta WHERE informeposta.id_tipoposta=tipoposta.id_tipoposta AND id_postacausa=$cod ";
		return parent::ejecutar($sql);
	}

	public function mostrarDatosDelTruncamientoDePosta($cod)
	{
		$sql="SELECT id_informeposta,fojainforme,fechainforme,calculogasto,informehonorario,(informeposta.estado)as estadoInfor ,id_postacausa,(informeposta.id_tipoposta)as idtipoposta,(tipoposta.nombretipoposta)as nombreTposta,fojainformetrunca,fechainformetrunca,informehonorariotrunca FROM informeposta,tipoposta WHERE informeposta.id_tipoposta=tipoposta.id_tipoposta AND id_postacausa=$cod ";
		return parent::ejecutar($sql);
	}

   /*FUNCION PARA MODIFICAR UN INFORMA DE UNA POSTA EN UNA CAUSA*/
	public function modificarInformeDePosta()
	{
		$sql="UPDATE informeposta SET fojainforme='$this->fojainformep',fechainforme='$this->fechainformep',calculogasto='$this->calculogastop',informehonorario='$this->informehonp',id_tipoposta='$this->id_tipoposta' WHERE id_informeposta='$this->id_informeposta' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function eliminarUnInformedePostaCausa()
	{
      $sql="DELETE FROM informeposta WHERE id_informeposta='$this->id_informeposta'";
      if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function eliminarUnInformedePostaCausaConID_PostaCausa()
	{
		$sql="DELETE FROM informeposta WHERE id_postacausa='$this->id_postacausa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	} 

	public function guardarTruncamientoDeInformePosta()
	{
		$sql="UPDATE informeposta SET id_tipoposta='$this->id_tipoposta', fojainformetrunca='$this->fojainformetrunca',fechainformetrunca='$this->fechainformetrunca', informehonorariotrunca='$this->informhonortrunca' WHERE id_informeposta='$this->id_informeposta' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}


	
	
}
?>