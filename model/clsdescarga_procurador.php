<?php
include_once('clsconexion.php');
class DescargaProcurador extends Conexion{
	private $id_descarga;
	private $detalleinformacion;
	private $ultimafoja;
	private $descargadocumentacion;
	private $gastos;
	private $saldo;
	private $detallegasto;
	private $fechadescarga;
	private $comprajudicial;
	private $id_orden;
	private $validado;

	private $descargainfosolotexto;
	private $descargadocusolotexto;
	private $descargadetallegastosolotexto;

	public function DescargaProcurador()
	{
		parent::Conexion();
		$this->id_descarga=0;
		$this->detalleinformacion="";
		$this->ultimafoja="";
		$this->descargadocumentacion="";
		$this->gastos=0;
		$this->saldo=0;
		$this->detallegasto="";
		$this->fechadescarga="";
		$this->comprajudicial=0;
		$this->id_orden=0;
		$this->validado="";

		$this->descargainfosolotexto="";
		$this->descargadocusolotexto="";
		$this->descargadetallegastosolotexto="";
		
	}

	public function setid_descarga($valor)
	{
		$this->id_descarga=$valor;
	}
	public function getid_descarga()
	{
		return $this->id_descarga;
	}
	public function setdetalleinformacion($valor)
	{
		$this->detalleinformacion=$valor;
	}
	public function getdetalleinformacion()
	{
		return $this->detalleinformacion;
	}
	public function setultimafoja($valor)
	{
		$this->ultimafoja=$valor;
	}
	public function getultimafoja()
	{
		return $this->ultimafoja;
	}
	public function setdescargadocumentacion($valor)
	{
		$this->descargadocumentacion=$valor;
	}
	public function getdescargadocumentacion()
	{
		return $this->descargadocumentacion;
	}
	public function setgastos($valor)
	{
		$this->gastos=$valor;
	}
	public function getgastos()
	{
		return $this->gastos;
	}
	public function setsaldo($valor)
	{
		$this->saldo=$valor;
	}
	public function getsaldo()
	{
		return $this->saldo;
	}
	public function setdetallegasto($valor)
	{
		$this->detallegasto=$valor;
	}
	public function getdetallegasto()
	{
		return $this->detallegasto;
	}
	public function setfechadescarga($valor)
	{
		$this->fechadescarga=$valor;
	}
	public function getfechadescarga()
	{
		return $this->fechadescarga;
	}
	public function setcomprajudicial($valor)
	{
		$this->comprajudicial=$valor;
	}
	public function getcomprajudicial()
	{
		return $this->comprajudicial;
	}
	public function setid_orden($valor)
	{
		$this->id_orden=$valor;
	}
	public function getid_orden()
	{
		return $this->id_orden;
	}

	public function setvalidado($valor)
	{
		$this->validado=$valor;
	}
	public function getvalidado()
	{
		return $this->validado;
	}

	public function setdescargainforsolotexto($valor)
	{
		$this->descargainfosolotexto=$valor;
	}
	public function getdescargainfosolotexto()
	{
		return $this->descargainfosolotexto;
	}

	public function setdescargadocumsolotexto($valor)
	{
		$this->descargadocusolotexto=$valor;
	}
	public function getdescargadocumsolotexto()
	{
		return $this->descargadocusolotexto;
	}

	public function setdescargadetgastosolotexto($valor)
	{
		$this->descargadetallegastosolotexto=$valor;
	}
	public function getdescargadetgastosolotexto()
	{
		return $this->descargadetallegastosolotexto;
	}
	
	public function guardardescarga()
	{
		$sql="INSERT INTO descargaprocurador(detalle_informacion,ultima_foja,documentaciondescarga,gastos,saldo,detalle_gasto,fecha_descarga,comprajudicial,id_orden,validado,descargainfosolotexto,descargadocusolotexto,descargadetallegastosolotexto) VALUES('$this->detalleinformacion','$this->ultimafoja','$this->descargadocumentacion','$this->gastos','$this->saldo','$this->detallegasto','$this->fechadescarga','$this->comprajudicial','$this->id_orden','$this->validado','$this->descargainfosolotexto','$this->descargadocusolotexto','$this->descargadetallegastosolotexto')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function mostrardescargaorden($cod)
	{
		$sql="SELECT id_descarga,detalle_informacion,ultima_foja,documentaciondescarga,gastos,saldo,detalle_gasto,fecha_descarga,comprajudicial,id_orden FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarfojadescarga($cod)
	{
		$sql="SELECT ultima_foja FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
    
    ///ESTA FUNCION SACA EL ID DESCARGA DE UNA ORDEN, PARA PODER INSERTAR DATOS EN LA TABLA CONFRIMACION
	public function mostrarultimoiddescargadeorden($cod)
	{
		$sql="SELECT MAX(id_descarga)as ultiddesc FROM descargaprocurador  WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public  function mostrarfechadescarga($cod)
	{
		$sql="SELECT fecha_descarga FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);

	}

	public function modificargastosdedescarga()
	{
		$sql="UPDATE descargaprocurador SET gastos='$this->gastos', saldo='$this->saldo',comprajudicial='$this->comprajudicial' WHERE id_descarga=$this->id_descarga";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarlosgastossinvalidar()
	{
		$sql="SELECT comprajudicial FROM descargaprocurador WHERE validado='No'";
		return parent::ejecutar($sql);
	}
	public function mostrarcomprajudicialdeorden($cod)
	{
		$sql="SELECT comprajudicial FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
	///////VALIDA LA DESCARGA PARA QUE NO SE TOME EN CUENTA EN EL LISTADO DE DINERO DEL CONTADOR
	public function validardescarga()
	{
		$sql="UPDATE descargaprocurador SET validado='$this->validado' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}
	////////FUNCION QUE MUESTRA LOS SALDOS DE CADA ORDEN DESCARGADA
	public function mostrarsaldodescarga($cod)
	{
		$sql="SELECT saldo FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
	/*FUNCION QUE MUESTRA ID ORDEN EN LA DESCARGA*/
	public function mostraridOrdenEnDescarga($cod)
	{
		$sql="SELECT id_orden FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
	public function muestraDescargaDeorden($cod)
	{
		$sql="SELECT id_descarga,detalle_informacion,ultima_foja,documentaciondescarga,gastos,saldo,detalle_gasto,fecha_descarga,comprajudicial,id_orden,validado FROM descargaprocurador WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function modificarDescargaInfoDocGastoDetalle()
	{
		$sql="UPDATE descargaprocurador SET detalle_informacion='$this->detalleinformacion', documentaciondescarga='$this->descargadocumentacion', detalle_gasto='$this->detallegasto', ultima_foja='$this->ultimafoja', descargainfosolotexto='$this->descargainfosolotexto',descargadocusolotexto='$this->descargadocusolotexto',descargadetallegastosolotexto='$this->descargadetallegastosolotexto' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostarultimafojaDeCausa($cod)
	{
		$sql="SELECT ultima_foja FROM descargaprocurador WHERE id_descarga=(SELECT MAX(id_descarga) FROM descargaprocurador,ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND causa.id_causa=$cod)";
		return parent::ejecutar($sql);
	}

	

	
}

 