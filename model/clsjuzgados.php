<?php
include_once('clsconexion.php');
class Juzgados extends Conexion{
	private $id_juzgado;
	private $nombnumerico;
	private $jerarq;
	private $matjuz;
	private $coordjuz;
	private $fotojuz;
	private $id_distrito;
	private $id_piso;
	private $contac1;
	private $contac2;
	private $contac3;
	private $contac4;

	public function Juzgados()
	{
		parent::Conexion();
		$this->id_juzgado=0;
		$this->nombnumerico=0;
		$this->jerarq="";
		$this->matjuz="";
		$this->coordjuz="";
		$this->fotojuz="";
		$this->id_distrito=0;
		$this->id_piso=0;
		$this->contac1="";
		$this->contac2="";
		$this->contac3="";
		$this->contac4="";
		$this->estado="";
	}

	public function setid_juzgado($valor)
	{
		$this->id_juzgado=$valor;
	}
	public function getid_juzgado()
	{
		return $this->id_juzgado;
	}
	public function setnombnumerico($valor)
	{
		$this->nombnumerico=$valor;
	}
	public function getnombnumerico()
	{
		return $this->nombnumerico;
	}
	public function setjerarquia($valor)
	{
		$this->jerarq=$valor;
	}
	public function getjerarquia()
	{
		return $this->jerarq;
	}
	public function setmateriajuz($valor)
	{
		$this->matjuz=$valor;
	}
	public function getmateriajuz()
	{
		return $this->matjuz;
	}
	public function setcoordenadasjuz($valor)
	{
		$this->coordjuz=$valor;
	}
	public function getcoordenadasjuz()
	{
		return $this->coordjuz;
	}
	public function setfotojuz($valor)
	{
		$this->fotojuz=$valor;
	}
	public function getfotojuz()
	{
		return $this->fotojuz;
	}
	public function setid_distritoj($valor)
	{
		$this->id_distrito=$valor;
	}
	public function getid_distritoj()
	{
		return $this->id_distrito;
	}
	public function setid_pisoj($valor)
	{
		$this->id_piso=$valor;
	}
	public function getid_pisoj()
	{
		return $this->id_piso;
	}

	public function setcontacto1($valor)
	{
		$this->contac1=$valor;
	}
	public function getcontacto1()
	{
		return $this->contac1;
	}
	public function setcontacto2($valor)
	{
		$this->contac2=$valor;
	}
	public function getcontacto2()
	{
		return $this->contac2;
	}
	public function setcontacto3($valor)
	{
		$this->contac3=$valor;
	}
	public function getcontacto3()
	{
		return $this->contac3;
	}
	public function setcontacto4($valor)
	{
		$this->contac4=$valor;
	}
	public function getcontacto4()
	{
		return $this->contac4;
	}

	public function setestadoj($valor)
	{
		$this->estado=$valor;
	}
	public function getestado()
	{
		return $this->estado;
	}

	public function guardarjuzgados()
	{
		$sql="INSERT INTO juzgados(nombrenumerico,jerarquia,materiajuz,coordenadasjuz,fotojuz,id_distrito,id_piso,contacto1,contacto2,contacto3,contacto4,estado) VALUES('$this->nombnumerico','$this->jerarq','$this->matjuz','$this->coordjuz','$this->fotojuz','$this->id_distrito','$this->id_piso','$this->contac1','$this->contac2','$this->contac3','$this->contac4','$this->estado')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarjuzgados()
	{
		$sql="SELECT id_juzgados, nombrenumerico, concat(jerarquia,' ',materiajuz)as juzgado, (distrito.abreviaturadist)as dist 
        FROM juzgados,distrito
        WHERE juzgados.id_distrito=distrito.id_distrito AND juzgados.estado='Activo' ORDER BY dist ASC ,juzgados.nombrenumerico ASC";
		return parent::ejecutar($sql);
	}
   /*ENLISTA LOS JUZGADOS O TRIBUNALES ACTIVOS*/
	public function listartodosjuzgados()
	{
		$sql="SELECT id_juzgados,nombrenumerico,jerarquia,materiajuz, (distrito.abreviaturadist) as distr, (piso.nombrepiso)as piso1,coordenadasjuz,fotojuz,contacto1,contacto2,contacto3,contacto4 FROM juzgados,distrito,piso WHERE juzgados.id_distrito=distrito.id_distrito AND juzgados.id_piso=piso.id_piso AND juzgados.estado='Activo' ORDER BY distr ASC ,juzgados.nombrenumerico ASC";
		return parent::ejecutar($sql);
	}
   /*MUESTRA LOS DATOS DE UN TRIBUNAL O JUZGADO (ES LO MISMO)*/
	public function mostrardatostribunal($cod)
	{
     $sql="SELECT id_juzgados,nombrenumerico,jerarquia,materiajuz,coordenadasjuz,fotojuz,id_distrito,id_piso,contacto1,contacto2,contacto3,contacto4 FROM juzgados WHERE id_juzgados=$cod";
     return parent::ejecutar($sql);
	}
	/*FUNCION QUE MODIFICA JUZGADO O TRIBUNAL , PERO SIN FOTO*/
	public function modificarJuzgSinFoto()
	{
		$sql="UPDATE juzgados SET nombrenumerico='$this->nombnumerico',jerarquia='$this->jerarq',materiajuz='$this->matjuz',coordenadasjuz='$this->coordjuz', id_distrito='$this->id_distrito',id_piso='$this->id_piso',contacto1='$this->contac1', contacto2='$this->contac2',contacto3='$this->contac3',contacto4='$this->contac4' WHERE id_juzgados='$this->id_juzgado'";
		if (parent::ejecutar($sql)) 
		    return true;
		else
			return false;
	}

	/*FUNCION QUE MODIFICA JUZGADO O TRIBUNAL , PERO CON FOTO*/
	public function modificarJuzgConFoto()
	{
		$sql="UPDATE juzgados SET nombrenumerico='$this->nombnumerico',jerarquia='$this->jerarq',materiajuz='$this->matjuz',coordenadasjuz='$this->coordjuz',fotojuz='$this->fotojuz', id_distrito='$this->id_distrito',id_piso='$this->id_piso',contacto1='$this->contac1', contacto2='$this->contac2',contacto3='$this->contac3',contacto4='$this->contac4' WHERE id_juzgados='$this->id_juzgado'";
		if (parent::ejecutar($sql)) 
		    return true;
		else
			return false;
	}
	/*eliminar (dar de baja un tribunal o juzgados)*/
	public function darbajaUntribunal()
	{
		$sql="UPDATE juzgados SET estado='$this->estado' WHERE id_juzgados='$this->id_juzgado'";
		if (parent::ejecutar($sql)) 
		    return true;
		else
			return false;

	}




}
?>