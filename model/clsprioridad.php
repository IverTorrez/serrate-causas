<?php
include_once('clsconexion.php');
/*ESTA CLASE ES LA MATRIZ , SE LLAMA PRIORIDAD PORQUE ASI SE DENOMINO PRIERO*/
class Prioridad extends Conexion{
	private $id_prioridad;
	private $nombreprioridad;
	private $precio_compra;
	private $precio_venta;
	private $penalizacion;
	private $condicion;
	

	public function Prioridad()
	{
		parent::Conexion();
		$this->id_prioridad=0;
		$this->nombreprioridad="";
		$this->precio_compra=0;
		$this->precio_venta=0;
		$this->penalizacion=0;
		$this->condicion=0;
		
	}

	public function setid_prioridad($valor)
	{
		$this->id_prioridad=$valor;
	}
	public function getid_prioridad()
	{
		return $this->id_prioridad;
	}
	public function setnonmbreproridad($valor)
	{
		$this->nombreprioridad=$valor;
	}
	public function getnombreprioridad()
	{
		return $this->nombreprioridad;
	}
	public function setpreciocompra($valor)
	{
		$this->precio_compra=$valor;
	}
	public function getpreciocompra()
	{
		return $this->precio_compra;
	}
	public function setprecioventa($valor)
	{
		$this->precio_venta=$valor;
	}
	public function getprecioventa()
	{
		return $this->precio_venta;
	}
	public function setpenalizacion($valor)
	{
		$this->penalizacion=$valor;
	}
	public function getpenalizacion()
	{
		return $this->penalizacion;
	}

	public function setcondicion($valor)
	{
		$this->condicion=$valor;
	}
	public function getcondicion()
	{
		return $this->condicion;
	}
	

	public function guardarprioridad()
	{
		$sql="INSERT INTO prioridad(nombreprioridad,preciocompra,precioventa,penalizacion,condicion) VALUES('$this->nombreprioridad','$this->precio_compra','$this->precio_venta','$this->penalizacion','$this->condicion')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function modificarmatrizprioridadM()
	{
		$sql="UPDATE prioridad SET preciocompra='$this->precio_compra',precioventa='$this->precio_venta',penalizacion='$this->penalizacion' WHERE nombreprioridad='$this->nombreprioridad' and condicion='$this->condicion'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	public function listarprioridad()
	{
		$sql="SELECT *FROM prioridad";
		return parent::ejecutar($sql); 
	}

	public function muestraprioridadselect($prior,$condi)
	{
     $sql="SELECT id_prioridad,nombreprioridad,preciocompra,precioventa,penalizacion,condicion FROM prioridad WHERE nombreprioridad=$prior AND condicion=$condi";
		return parent::ejecutar($sql);
	}

	public function listaunaprioridad($prior,$condi)
	{
		$sql="SELECT id_prioridad,nombreprioridad,preciocompra,precioventa,penalizacion,condicion FROM prioridad WHERE nombreprioridad=$prior AND condicion=$condi";
		return parent::ejecutar($sql);
	}
	public function mostrarConteoRegistros()
	{
		$sql="SELECT COUNT(id_prioridad)AS totalregistrosmatriz FROM prioridad";
		return parent::ejecutar($sql);
	}

	///DESDE AQUI ESDE TITO
//	public function listaunaprioridad($prior,$condi)
//	{
	//	$sql="SELECT id_prioridad,nombreprioridad,preciocompra,precioventa,penalizacion,condicion FROM prioridad WHERE /nombreprioridad=$prior AND condicion=$condi";
	//	return parent::ejecutar($sql);
//	}
	/////HASTA AQUI
}