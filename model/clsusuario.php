<?php
include_once('clsconexion.php');
class Usuario extends Conexion{
	private $id_usuario;
	private $nombusu;
	private $apellusu;
	private $nombloginusu;
	private $telfusu;
	private $correousu;
	private $claveusu;
	private $direccionusu;
	private $coordenadasusu;
	private $observusu;
	private $estadousu;
	private $fotousu;
	private $tipousu;
	private $visibleusu;

	public function Usuario()
	{
		parent::Conexion();
		$this->id_usuario=0;
		$this->nombusu="";
		$this->apellusu="";
		$this->nombloginusu="";
		$this->telfusu="";
		$this->correousu="";
		$this->claveusu="";
		$this->direccionusu="";
		$this->coordenadasusu="";
		$this->observusu="";
		$this->estadousu="";
		$this->fotousu="";
		$this->tipousu="";
		$this->visibleusu="";
	}

	public function setid_usuario($valor)
	{
		$this->id_usuario=$valor;
	}
	public function getid_usuario()
	{
		return $this->id_usuario;
	}
	public function setnombreusu($valor)
	{
       $this->nombusu=$valor;
	}
	public function getnombreusu()
	{
		return $this->nombusu;
	}
	public function setapellidousu($valor)
	{
		$this->apellusu=$valor;
	}
	public function getapellidousu()
	{
		return $this->apellusu;
	}
	public function setnombreloginusu($valor)
	{
		$this->nombloginusu=$valor;
	}
	public function getnombreloginusu()
	{
		return $this->nombloginusu;
	}
	public function settelefonousu($valor)
	{
		$this->telfusu=$valor;
	}
	public function gettelefonousu()
	{
		return $this->telfusu;
	}
	public function setcorreousu($valor)
	{
		$this->correousu=$valor;
	}
	public function getcorreousu()
	{
		return $this->correousu;
	}
	public function setclaveusu($valor)
	{
		$this->claveusu=$valor;
	}
	public function getclaveusu()
	{
		return $this->claveusu;
	}
	public function setdireccionusu($valor)
	{
		$this->direccionusu=$valor;
	}
	public function getdireccionusu()
	{
		return $this->direccionusu;
	}
	public function setcoordenadasusu($valor)
	{
		$this->coordenadasusu=$valor;
	}
	public function getcoordenadasusu()
	{
		return $this->coordenadasusu;
	}
	public function setobservacionesusu($valor)
	{
		$this->observusu=$valor;
	}
	public function getobservacionesusu()
	{
		return $this->observusu;
	}
	public function setestadorusu($valor)
	{
		$this->estadousu=$valor;
	}
	public function getestadousu()
	{
		return $this->estadousu;
	}
	public function setfotousu($valor)
	{
		$this->fotousu=$valor;
	}
	public function getfotousu()
	{
		return $this->fotousu;
	}
	public function settipousu($valor)
	{
		$this->tipousu=$valor;
	}
	public function gettipousu()
	{
		return $this->tipousu;
	}

	public function setvisibleusu($valor)
	{
		$this->visibleusu=$valor;
	}
	public function getvisibleusu()
	{
		return $this->visibleusu;
	}

	public function guardarusuario()
	{
		$sql="INSERT INTO usuario(nombreusuario,apellidosusuario,nombrelogusu,telefonousu,correousuario,claveusu,direccion,coordenadas,observaciones,estadousu,fotousu,tipousuario,visibleusu) VALUES('$this->nombusu','$this->apellusu','$this->nombloginusu','$this->telfusu','$this->correousu','$this->claveusu','$this->direccionusu','$this->coordenadasusu','$this->observusu','$this->estadousu','$this->fotousu','$this->tipousu','$this->visibleusu')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}
    
    /*LISTA TODOS LOS DATOS DE LA TABLA USUARIO*/
    public function listarusuarios()
	{
		$sql="SELECT *FROM usuario WHERE visibleusu='Si'";
		return parent::ejecutar($sql); 
	}

	/*LISTA TODOS LOS DATOS DE OBSERVADORES*/
    public function listarusuariosObservador()
	{
		$sql="SELECT *FROM usuario WHERE tipousuario='Observador' AND visibleusu='Si' ORDER BY apellidosusuario ASC";
		return parent::ejecutar($sql); 
	}

	/*LISTA TODOS LOS DATOS DE OBSERVADORES*/
    public function listarusuariosAdministrador()
	{
		$sql="SELECT *FROM usuario WHERE tipousuario='Administrador' AND visibleusu='Si' ORDER BY apellidosusuario ASC";
		return parent::ejecutar($sql); 
	}

	public function mostrarclaveusuarios()
	{
		$sql="SELECT claveusu FROM usuario ";
		return parent::ejecutar($sql);
	}


	/*DATOS DE USUARIO PARA LOGIN*/
	public function loginUsuario()
      {
	$sql="SELECT * from usuario where nombrelogusu='$this->nombloginusu' and claveusu='$this->claveusu' AND estadousu='Activo' AND visibleusu='Si'";
	return parent::ejecutar($sql);
       }

       public function mostrarunUsuario($cod)
       {
       	$sql="SELECT id_usuario, nombreusuario,apellidosusuario,nombrelogusu,telefonousu,correousuario,claveusu,direccion,coordenadas,observaciones,estadousu,fotousu,tipousuario FROM usuario WHERE id_usuario=$cod";
       	return parent::ejecutar($sql);
       }

       public function editarunUsuarioSinFoto()
       {
       	$sql="UPDATE usuario SET nombreusuario='$this->nombusu', apellidosusuario='$this->apellusu',nombrelogusu='$this->nombloginusu',claveusu='$this->claveusu', direccion='$this->direccionusu',telefonousu='$this->telfusu',correousuario='$this->correousu',coordenadas='$this->coordenadasusu', observaciones='$this->observusu',estadousu='$this->estadousu' WHERE id_usuario='$this->id_usuario'";
       	if (parent::ejecutar($sql))
			return true;
		else
			return false;

       }
       public function editarunUsuarioConFoto()
       {
       	$sql="UPDATE usuario SET nombreusuario='$this->nombusu', apellidosusuario='$this->apellusu',nombrelogusu='$this->nombloginusu',claveusu='$this->claveusu', direccion='$this->direccionusu',telefonousu='$this->telfusu',correousuario='$this->correousu',coordenadas='$this->coordenadasusu', observaciones='$this->observusu',estadousu='$this->estadousu',fotousu='$this->fotousu' WHERE id_usuario='$this->id_usuario'";
       	if (parent::ejecutar($sql))
			return true;
		else
			return false;

       }
      /*ELIMINA EL USUARIO DE LA VISTA DE USUARIOS*/
       public function eliminarUsuario()
       {
       	$sql="UPDATE usuario SET visibleusu='$this->visibleusu' WHERE id_usuario='$this->id_usuario'";
       	if (parent::ejecutar($sql))
			return true;
		else
			return false;

       }
       /*MOSTRAR USUARIO ADMINISTRADOR*/
        public  function MostrarUserAdmin()
        {
        	$sql="SELECT * FROM usuario WHERE tipousuario='Administrador' AND visibleusu='Si' AND estadousu='Activo' ORDER BY id_usuario ASC ";
        		return parent::ejecutar($sql);
        }


}

?>