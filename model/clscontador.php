<?php
include_once('clsconexion.php');
class Contador extends Conexion{
	private $id_contador;
	private $nombcont;
	private $apellcont;
	private $nomblogincont;
	private $telfcont;
	private $correocont;
	private $clavecont;
	private $direccioncont;
	private $coordenadascont;
	private $observcont;
	private $estadocont;
	private $fotocont;
	private $visiblecont;

	public function Contador()
	{
		parent::Conexion();
		$this->id_contador=0;
		$this->nombcont="";
		$this->apellcont="";
		$this->nomblogincont="";
		$this->telfcont="";
		$this->correocont="";
		$this->clavecont="";
		$this->direccioncont="";
		$this->coordenadascont="";
		$this->observcont="";
		$this->estadocont="";
		$this->fotocont="";
		$this->visiblecont="";
	}

	public function setid_contador($valor)
	{
		$this->id_contador=$valor;
	}
	public function getid_contador()
	{
		return $this->id_contador;
	}
	public function setnombcontador($valor)
	{
		$this->nombcont=$valor;
	}
	public function getnombcontador()
	{
		return $this->nombcont;
	}
	public function setapellcont($valor)
	{
		$this->apellcont=$valor;
	}
	public function getapellcont()
	{
		return $this->apellcont;
	}
	public function setnomblogincont($valor)
	{
		$this->nomblogincont=$valor;
	}
	public function getnomblogincont()
	{
		return $this->nomblogincont;
	}
	public function settelefonocont($valor)
	{
		$this->telfcont=$valor;
	}
	public function gettelefonocont()
	{
		return $this->telfcont;
	}
	public function setcorreocont($valor)
	{
		$this->correocont=$valor;
	}
	public function getcorreocont()
	{
		return $this->correocont;
	}

	public function setclavecont($valor)
	{
		$this->clavecont=$valor;
	}
	public function getclavecont()
	{
		return $this->clavecont;
	}
	public function setdireccioncont($valor)
	{
		$this->direccioncont=$valor;
	}
	public function getdireccioncont()
	{
		return $this->direccioncont;
	}
	public function setcoordenadascont($valor)
	{
		$this->coordenadascont=$valor;
	}
	public function getcoordenadascont()
	{
		return $this->coordenadascont;
	}
	public function setobservacionescont($valor)
	{
		$this->observcont=$valor;
	}
	public function getobservacionescont()
	{
		return $this->observcont;
	}

	public function setestadocont($valor)
	{
		$this->estadocont=$valor;
	}
	public function getestadocont()
	{
		return $this->estadocont;
	}
	public function setfotocont($valor)
	{
		$this->fotocont=$valor;
	}
	public function getfotocont()
	{
		return $this->fotocont;
	}

	public function setvisiblecont($valor)
	{
		$this->visiblecont=$valor;
	}
	public function getvisiblecont()
	{
		return $this->visiblecont;
	}

	public function guardarcontador()
	{
		$sql="INSERT INTO contador(nombrecont,apellidocont,nombrelogcont,telefonocont,correocont,clavecont,direccioncont,coordenadascont,observacionescont,estadocont,fotocont,visiblecont) VALUES('$this->nombcont','$this->apellcont','$this->nomblogincont','$this->telfcont','$this->correocont','$this->clavecont','$this->direccioncont','$this->coordenadascont','$this->observcont','$this->estadocont','$this->fotocont','$this->visiblecont')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	public function listarcontador()
	{
		$sql="SELECT *FROM contador WHERE visiblecont='Si' ORDER BY apellidocont ASC ";
		return parent::ejecutar($sql); 
	}

	public function mostrarclavecontador()
	{
		$sql="SELECT clavecont FROM contador";
		return parent::ejecutar($sql);
	}

	/*DATOS DE CONTADOR PARA LOGIN*/
	public function loginContador()
      {
	$sql="SELECT * from contador where nombrelogcont='$this->nomblogincont' and clavecont='$this->clavecont' AND estadocont='Activo' AND visiblecont='Si'";
	return parent::ejecutar($sql);
       }

       public function mostrarunContador($cod)
       {
       	$sql="SELECT id_contador, nombrecont,apellidocont,nombrelogcont,telefonocont,correocont,clavecont,direccioncont,coordenadascont,observacionescont,estadocont,fotocont FROM contador WHERE id_contador=$cod";
       	return parent::ejecutar($sql);
       }
   public function editarUnContadorSinFoto()
   {
   	$sql="UPDATE contador SET nombrecont='$this->nombcont',apellidocont='$this->apellcont',nombrelogcont='$this->nomblogincont',telefonocont='$this->telfcont',correocont='$this->correocont',clavecont='$this->clavecont',direccioncont='$this->direccioncont',coordenadascont='$this->coordenadascont',observacionescont='$this->observcont',estadocont='$this->estadocont' WHERE id_contador='$this->id_contador' ";
   	  if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
   }

   public function editarUnContadorConnFoto()
   {
   	$sql="UPDATE contador SET nombrecont='$this->nombcont',apellidocont='$this->apellcont',nombrelogcont='$this->nomblogincont',telefonocont='$this->telfcont',correocont='$this->correocont',clavecont='$this->clavecont',direccioncont='$this->direccioncont',coordenadascont='$this->coordenadascont',observacionescont='$this->observcont',estadocont='$this->estadocont',fotocont='$this->fotocont' WHERE id_contador='$this->id_contador' ";
   	  if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
   }
   /*elimina un contador (visiblecont=No)*/
   public function eliminarContador()
   {
   	$sql="UPDATE contador SET visiblecont='$this->visiblecont' WHERE id_contador='$this->id_contador' ";
   	  if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
   }
}