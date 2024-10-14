<?php
include_once('clsconexion.php');
class Cliente extends Conexion{
	private $id_cliente;
	private $nombcli;
	private $apellcli;
	private $nomblogincli;
	private $telfcli;
	private $correocli;
	private $clavecli;
	private $direccioncli;
	private $coordenadascli;
	private $observcli;
	private $estadocli;
	private $fotocli;
	private $visiblecli;
	
	public function Cliente()
	{
		parent::Conexion();
		$this->id_cliente=0;
		$this->nombcli="";
		$this->apellcli="";
		$this->nomblogincli="";
		$this->telfcli="";
		$this->correocli="";
		$this->clavecli="";
		$this->direccioncli="";
		$this->coordenadascli="";
		$this->observcli="";
		$this->estadocli="";
		$this->fotocli="";
		$this->visiblecli="";
		
	}

	public function setid_cliente($valor)
	{
		$this->id_cliente=$valor;

	}
	public function getid_cliente()
	{
		return $this->id_cliente;
	}
	public function setnombrecli($valor)
	{
		$this->nombcli=$valor;
	}
	public function getnombrecli()
	{
		return $this->nombcli;
	}
	public function setapellidocli($valor)
	{
		$this->apellcli=$valor;
	}
	public function getapellidocli()
	{
		return $this->apellcli;
	}
	public function setnomblogincli($valor)
	{
		$this->nomblogincli=$valor;
	}
	public function getnomblogincli()
	{
		return $this->nomblogincli;
	}
	public function settelefonocli($valor)
	{
		$this->telfcli=$valor;
	}
	public function gettelefonocli()
	{
		return $this->telfcli;
	}
	public function setcorreocli($valor)
	{
		$this->correocli=$valor;
	}
	public function getcorreocli()
	{
		return $this->correocli;
	}
	public function setclavecli($valor)
	{
		$this->clavecli=$valor;
	}
	public function getclavecli()
	{
		return $this->clavecli;
	}
	public function setdireccioncli($valor)
	{
		$this->direccioncli=$valor;
	}
	public function getdireccioncli()
	{
		return $this->direccioncli;
	}
	public function setcoordenadascli($valor)
	{
		$this->coordenadascli=$valor;
	}
	public function getcoordenadascli()
	{
		return $this->coordenadascli;
	}
	public function setobservacionescli($valor)
	{
		$this->observcli=$valor;
	}
	public function getobservacionescli()
	{
		return $this->observcli;
	}
	public function setestadocli($valor)
	{
		$this->estadocli=$valor;
	}
	public function getestadocli()
	{
		return $this->estadocli;
	}
	public function setfotocli($valor)
	{
		$this->fotocli=$valor;
	}
	public function getfotocli()
	{
		return $this->fotocli;
	}

	public function setvisiblecli($valor)
	{
		$this->visiblecli=$valor;
	}
	public function getvisiblecli()
	{
		return $this->visiblecli;
	}

	public function guardarcliente()
	{
		$sql="INSERT INTO cliente(nombrecli,apellidocli,nombrelogcli,telefonocli,correocli,clavecli,direccioncli,coordenadascli,observacionescli,estadocli,fotocli,visiblecli) VALUES('$this->nombcli','$this->apellcli','$this->nomblogincli','$this->telfcli','$this->correocli','$this->clavecli','$this->direccioncli','$this->coordenadascli','$this->observcli','$this->estadocli','$this->fotocli','$this->visiblecli')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function listarcliente()
	{
		$sql="SELECT *FROM cliente WHERE visiblecli='Si' ORDER BY apellidocli ASC";
		return parent::ejecutar($sql);
	}

	public function listarTodosClienteActivos()
	{
		$sql="SELECT *FROM cliente WHERE estadocli='Activo' AND visiblecli='Si' ORDER BY apellidocli ASC ";
		return parent::ejecutar($sql);
	}
	public function mostrarUNClienteenCausa($cod)
	{
		$sql="SELECT (cliente.id_cliente)as idcli,nombrecli,apellidocli,nombrelogcli,telefonocli,correocli,clavecli,direccioncli,coordenadascli,observacionescli,estadocli,fotocli FROM cliente,causa WHERE causa.id_cliente=cliente.id_cliente AND causa.id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarclavecliente()
	{
		$sql="SELECT clavecli FROM cliente";
		return parent::ejecutar($sql);
	}

	/*DATOS DE USUARIO PARA LOGIN*/
	public function loginCliente()
      {
	$sql="SELECT * from cliente where nombrelogcli='$this->nomblogincli' and clavecli='$this->clavecli' AND estadocli='Activo' AND visiblecli='Si'";
	return parent::ejecutar($sql);
       }

    public function listarClienteActivos()
    {
    	$sql="SELECT id_cliente,nombrecli,apellidocli FROM cliente WHERE visiblecli='Si' AND estadocli='Activo' ORDER BY apellidocli ASC";
    	return parent::ejecutar($sql);
    }
    public function mostrarunCliente($cod)
    {
    	$sql="SELECT id_cliente,nombrecli,apellidocli,nombrelogcli,telefonocli,correocli,clavecli,direccioncli,coordenadascli,observacionescli,estadocli,fotocli FROM cliente WHERE id_cliente=$cod";
    	return parent::ejecutar($sql);
    }
    public function editarUnClienteSinFoto()
    {
    	$sql="UPDATE cliente SET nombrecli='$this->nombcli', apellidocli='$this->apellcli',nombrelogcli='$this->nomblogincli',telefonocli='$this->telfcli',correocli='$this->correocli',clavecli='$this->clavecli',direccioncli='$this->direccioncli',coordenadascli='$this->coordenadascli',observacionescli='$this->observcli',estadocli='$this->estadocli' WHERE id_cliente='$this->id_cliente' ";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;

    }
    public function editarUnClienteConFoto()
    {
    	$sql="UPDATE cliente SET nombrecli='$this->nombcli', apellidocli='$this->apellcli',nombrelogcli='$this->nomblogincli',telefonocli='$this->telfcli',correocli='$this->correocli',clavecli='$this->clavecli',direccioncli='$this->direccioncli',coordenadascli='$this->coordenadascli',observacionescli='$this->observcli',estadocli='$this->estadocli',fotocli='$this->fotocli' WHERE id_cliente='$this->id_cliente' ";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;

    }

    public function eliminarCliente()
    {
    	$sql="UPDATE cliente SET visiblecli='$this->visiblecli' WHERE id_cliente='$this->id_cliente' ";
    	if (parent::ejecutar($sql))
			return true;
		else
			return false;

    }



}
?>