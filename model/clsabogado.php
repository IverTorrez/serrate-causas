<?php
include_once('clsconexion.php');
class Abogado extends Conexion{
	private $id_abogado;
	private $nombabog;
	private $apellabog;
	private $nomblogabog;
	private $telfabog;
	private $correoabog;
	private $claveabog;
	private $direccionabog;
	private $coordenadasabog;
	private $observabog;
	private $estadoabog;
	private $fotoabog;
	private $visibleab;

	public function Abogado()
	{
		parent::Conexion();
		$this->id_abogado=0;
		$this->nombabog="";
		$this->apellabog="";
		$this->nomblogabog="";
		$this->telfabog="";
		$this->correoabog="";
		$this->claveabog="";
		$this->direccionabog="";
		$this->coordenadasabog="";
		$this->observabog="";
		$this->estadoabog="";
		$this->fotoabog="";
		$this->visibleab="";
	}

	public function setid_abogado($valor)
	{
		$this->id_abogado=$valor;
	}
	public function getid_abogado()
	{
		return $this->id_abogado;
	}
	public function setnombabogado($valor)
	{
		$this->nombabog=$valor;
	}
	public function getnombabogado()
	{
		return $this->nombabog;
	}
	public function setapellabogado($valor)
	{
		$this->apellabog=$valor;
	}
	public function getapellabogado()
	{
		return $this->apellabog;
	}
	public function setnombloginabog($valor)
	{
		$this->nomblogabog=$valor;
	}
	public function getnombloginabog()
	{
		return $this->nomblogabog;
	}
	public function settelefonoabog($valor)
	{
		$this->telfabog=$valor;
	}
	public function gettelefonoabog()
	{
		return $this->telfabog;
	}
	public function setcorreoabog($valor)
	{
		$this->correoabog=$valor;
	}
	public function getcorreoabog()
	{
		return $this->correoabog;
	}
	public function setclaveabog($valor)
	{
		$this->claveabog=$valor;
	}
	public function getclaveabog()
	{
		return $this->claveabog;
	}
	public function setdireccionabog($valor)
	{
		$this->direccionabog=$valor;
	}
	public function getdireccionabog()
	{
		return $this->direccionabog;
	}
	public function setcoordenadasabog($valor)
	{
		$this->coordenadasabog=$valor;
	}
	public function getcoordenadasabog()
	{
		return $this->coordenadasabog;
	}
	public function setobservacionesabog($valor)
	{
		$this->observabog=$valor;
	}
	public function getobservacionesabog()
	{
		return $this->observabog;
	}
	public function setestadoabog($valor)
	{
		$this->estadoabog=$valor;
	}
	public function getestadoabog()
	{
		return $this->estadoabog;
	}
	public function setfotoabog($valor)
	{
		$this->fotoabog=$valor;
	}
	public function getfotoabog()
	{
		return $this->fotoabog;
	}

	public function setvisibleabog($valor)
	{
		$this->visibleab=$valor;
	}
	public function getvisibleabog()
	{
		return $this->visibleab;
	}

	public function guardarabogado()
	{
		$sql="INSERT INTO abogado(nombreabog,apellidoabog,nombrelogabog,telefonoabog,correoabog,claveabog,direccionabog,coordenadasabog,observacionesabog,estadoabog,fotoabog,visibleusuab) VALUES('$this->nombabog','$this->apellabog','$this->nomblogabog','$this->telfabog','$this->correoabog','$this->claveabog','$this->direccionabog','$this->coordenadasabog','$this->observabog','$this->estadoabog','$this->fotoabog','$this->visibleab')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function listarabogado()
	{
		$sql="SELECT *FROM abogado WHERE visibleusuab='Si' ORDER BY apellidoabog ASC ";
		return parent::ejecutar($sql);
	}

	public function listarTodosAbogadosActivos()
	{
		$sql="SELECT *FROM abogado WHERE estadoabog='Activo'";
		return parent::ejecutar($sql);
	}
	public function listarTodosAbogadosActivosExceptoUno($cod)
	{
		$sql="SELECT *FROM abogado WHERE estadoabog='Activo' AND visibleusuab='Si' AND id_abogado<>$cod ORDER BY apellidoabog ASC ";
		return parent::ejecutar($sql);
	}

	public function listarUnAbogadosDeUnaCausa($cod)
	{
		$sql="SELECT (abogado.id_abogado)AS idabog,nombreabog,apellidoabog,nombrelogabog,telefonoabog,correoabog,claveabog,direccionabog,coordenadasabog,observacionesabog,estadoabog,fotoabog FROM abogado,causa WHERE causa.id_abogado=abogado.id_abogado AND causa.id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarclaveabogado()
	{
		$sql="SELECT claveabog FROM abogado";
		return parent::ejecutar($sql);
	}

	/*DATOS DE USUARIO PARA LOGIN*/
	public function loginAbogado()
      {
	$sql="SELECT * from abogado where nombrelogabog='$this->nomblogabog' and claveabog='$this->claveabog' AND estadoabog='Activo' AND visibleusuab='Si'";
	return parent::ejecutar($sql);
       }

    public function listarAbogadosActivos()
    {
    	$sql="SELECT id_abogado, nombreabog,apellidoabog FROM abogado WHERE visibleusuab='Si' AND estadoabog='Activo' ORDER BY apellidoabog ASC ";
    	return parent::ejecutar($sql);
    }
    
    public function mostrarunAbogado($cod)
    {
    	$sql="SELECT id_abogado,nombreabog,apellidoabog,nombrelogabog,telefonoabog,correoabog,claveabog,direccionabog,coordenadasabog,observacionesabog,estadoabog,fotoabog FROM abogado WHERE id_abogado=$cod";
    	return parent::ejecutar($sql);
    }
    public function editarUnAbogadoSinFoto()
    {
    	$sql="UPDATE abogado SET nombreabog='$this->nombabog',apellidoabog='$this->apellabog',nombrelogabog='$this->nomblogabog',telefonoabog='$this->telfabog',correoabog='$this->correoabog',claveabog='$this->claveabog',direccionabog='$this->direccionabog',coordenadasabog='$this->coordenadasabog',observacionesabog='$this->observabog', estadoabog='$this->estadoabog' WHERE id_abogado='$this->id_abogado' ";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;
    }

    public function editarUnAbogadoConFoto()
    {
    	$sql="UPDATE abogado SET nombreabog='$this->nombabog',apellidoabog='$this->apellabog',nombrelogabog='$this->nomblogabog',telefonoabog='$this->telfabog',correoabog='$this->correoabog',claveabog='$this->claveabog',direccionabog='$this->direccionabog',coordenadasabog='$this->coordenadasabog',observacionesabog='$this->observabog', estadoabog='$this->estadoabog', fotoabog='$this->fotoabog' WHERE id_abogado='$this->id_abogado' ";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;
    }
    /*eliminar abogado(visibleusuab=No)*/
    public function eliminarAbogado()
    {
    	$sql="UPDATE abogado SET visibleusuab='$this->visibleab' WHERE id_abogado='$this->id_abogado'";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;

    }
    
    public function mostrarultimaCausaDeAbogado($cod)
    {
    	$sql="SELECT MAX(id_causa)AS idcausaultima FROM causa  WHERE id_abogado=$cod";
    	return parent::ejecutar($sql);

    }

}
?>