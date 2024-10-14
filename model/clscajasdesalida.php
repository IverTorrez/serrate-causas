<?php
include_once('clsconexion.php');
class Cajasdesalida extends Conexion{
    private $id_cajasalida;
    private $cajacontador;
    private $deudaexterna;
    private $ganancialpp;
    private $imagenindex;

public function Cajasdesalida()
    {
		parent::Conexion();
		$this->id_cajasalida=0;
		$this->cajacontador=0;
		$this->deudaexterna=0;
		$this->ganancialpp=0;
		$this->imagenindex="";
		
	}
public function setid_cajasalida($valor){
     $this->id_cajasalida=$valor;
}
public function getid_cajasalida(){
	return $this->id_cajasalida;
}
public function setcajacontador($valor){
	$this->cajacontador=$valor;
}
public function getcajacontador(){
	$this->cajacontador;
}
public function setdeudaexterna($valor){
     $this->deudaexterna=$valor;
}
public function getdeudaexterna(){
	return $this->deudaexterna;
}
public function setgananciaspp($valor)
{
	$this->ganancialpp=$valor;
}
public function getganaciaspp()
{
	return $this->ganancialpp;
}

public function setimaginindex($valor)
{
	$this->imagenindex=$valor;
}
public function getimaginindex()
{
	return $this->imagenindex;
}

public function guardarcajadesalida()
	{
		$sql="INSERT INTO cajasdesalida(cajacontador,deudaexterna,gananciasprocesalyproc,imagenindex) VALUES('$this->cajacontador','$this->deudaexterna','$this->ganancialpp','$this->imagenindex')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostrarcajadelcontador()
	{
		$sql="SELECT cajacontador FROM cajasdesalida WHERE id_cajasalida=1";
		return parent::ejecutar($sql);
	}

	public function incrementarganancias()
	{
		$sql="UPDATE cajasdesalida SET gananciasprocesalyproc='$this->ganancialpp'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	public function mostrarganacias()
	{
		$sql="SELECT gananciasprocesalyproc FROM cajasdesalida WHERE id_cajasalida=1";
		return parent::ejecutar($sql);
	}

	public function mostrardeudaexterna()
	{
		$sql="SELECT deudaexterna  FROM cajasdesalida WHERE id_cajasalida=1";
		return parent::ejecutar($sql);
	}
   /*MODIFICA LA CAJA DEL CONTADOR*/
	public function modificarsaldodecaja()
	{
		$sql="UPDATE cajasdesalida SET cajacontador='$this->cajacontador' WHERE id_cajasalida='$this->id_cajasalida'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}
	public function modificarganancias()
	{
		$sql="UPDATE cajasdesalida SET gananciasprocesalyproc='$this->ganancialpp' WHERE id_cajasalida='$this->id_cajasalida'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function modificarcajacontador()
	{
		$sql="UPDATE cajasdesalida SET cajacontador='$this->cajacontador' WHERE id_cajasalida=1";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	public function modificardeudaexterna()
	{
		$sql="UPDATE cajasdesalida SET deudaexterna='$this->deudaexterna' WHERE id_cajasalida=1";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function modificarImagenIndex()
	{
		$sql="UPDATE cajasdesalida SET imagenindex='$this->imagenindex' WHERE id_cajasalida='$this->id_cajasalida'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostrarImagenIndex()
	{
		$sql="SELECT imagenindex FROM cajasdesalida WHERE id_cajasalida=1";
		return parent::ejecutar($sql);
	}

	public function devolverTodoelDinerodelContador()
	{
		$sql="UPDATE cajasdesalida SET cajacontador='$this->cajacontador' WHERE id_cajasalida='$this->id_cajasalida'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}



}
?>