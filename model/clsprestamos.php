<?php
include_once('clsconexion.php');
class Prestamos extends Conexion{
	private $id_prestamos;
	private $fechaprestamo;
	private $detalleprestamo;
	private $montoprestamo;
	private $tipoprestamo;
	private $id_usuario;
	
	

	public function Prestamos()
	{
		parent::Conexion();
		$this->id_prestamos=0;
		$this->fechaprestamo="";
		$this->detalleprestamo="";
		$this->montoprestamo=0;
		$this->tipoprestamo="";	
		$this->id_usuario=0;
		
	}

	public function setid_prestamo($valor)
	{
		$this->id_prestamos=$valor;
	}
	public function getid_prestamo()
	{
		return $this->id_prestamos;
	}
	public function setfechaprestamo($valor)
	{
		$this->fechaprestamo=$valor;
	}
	public function getfechaprestamo()
	{
		return $this->fechaprestamo;
	}
	public function setdetalleprestamo($valor)
	{
		$this->detalleprestamo=$valor;
	}
	public function getdetalleprestamo()
	{
		return $this->detalleprestamo;
	}
	public function setmontoprestamo($valor)
	{
		$this->montoprestamo=$valor;
	}
	public function getmontoprestamo()
	{
		return $this->montoprestamo;
	}
	public function settipoprestamo($valor)
	{
		$this->tipoprestamo=$valor;
	}
	public function gettipoprestamo()
	{
		return $this->tipoprestamo;
	}

	public function setid_usuariop($valor)
	{
		$this->id_usuario=$valor;
	}
	public function getid_usuariop()
	{
		return $this->id_usuario;
	}

	
	
	public function guardarprestamo()
	{
		$sql="INSERT INTO prestamos(fecha_prestamo,detalle_prestamo,monto_prestamo,tipo_prestamo,id_usuario) VALUES('$this->fechaprestamo','$this->detalleprestamo','$this->montoprestamo','$this->tipoprestamo','$this->id_usuario')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function listar_prestamos()
	{
		$sql="SELECT *FROM prestamos ORDER BY id_prestamos ASC";
		return parent::ejecutar($sql);
	}
	

}
?>