<?php
include_once('clsconexion.php');
class Presupuesto extends Conexion{
	private $id_presupuesto;
	private $montopresupuesto;
	private $detallepresupuesto;
	private $fechapresupuesto;
	private $fechaentrega;
	private $id_orden;
	private $id_contador;
	private $estadopresu;
	private $detallepresusolotexto;
	

	public function Presupuesto()
	{
		parent::Conexion();
		$this->id_presupuesto=0;
		$this->montopresupuesto=0;
		$this->detallepresupuesto="";
		$this->fechapresupuesto="";
		$this->fechaentrega="";
		$this->id_orden=0;
		$this->id_contador=0;
		$this->estadopresu="";
		$this->detallepresusolotexto="";
		
	}

	public function setid_presupuesto($valor)
	{
		$this->id_presupuesto=$valor;
	}
	public function getid_presupuesto()
	{
		return $this->id_presupuesto;
	}
	public function setmonto_presupuesto($valor)
	{
		$this->montopresupuesto=$valor;
	}
	public function getmonto_presupuesto()
	{
		return $this->montopresupuesto;
	}
	public function setdetalle_presupuesto($valor)
	{
		$this->detallepresupuesto=$valor;
	}
	public function getdetalle_presupuesto()
	{
		return $this->detallepresupuesto;
	}
	public function setfecha_presupuesto($valor)
	{
		$this->fechapresupuesto=$valor;
	}
	public function getfecha_presupuesto()
	{
		return $this->fechapresupuesto;
	}
	public function setfecha_entrega($valor)
	{
		$this->fechaentrega=$valor;
	}
	public function getfecha_entrega()
	{
		return $this->fechaentrega;
	}

	public function setid_orden($valor)
	{
		$this->id_orden=$valor;
	}
	public function getid_orden()
	{
		return $this->id_orden;
	}
	public function setid_contador($valor)
	{
		$this->id_contador=$valor;
	}
	public function getid_contador()
	{
		return $this->id_contador;
	}

	public function setestadopresupuesto($valor)
	{
		$this->estadopresu=$valor;
	}
	public function getestadopresupuesto()
	{
		return $this->estadopresu;
	}

	public function setdetallepresusolotexto($valor)
	{
		$this->detallepresusolotexto=$valor;
	}
	public function getdetallepresusolotexto()
	{
		return $this->detallepresusolotexto;
	}
	

	public function guardarpresupuesto()
	{
		$sql="INSERT INTO presupuesto(monto_presupuesto,detalle_presupuesto,fecha_presupuesto,fecha_entrega,id_orden,id_contador,estadopresupuesto,detallepresusolotexto) VALUES('$this->montopresupuesto','$this->detallepresupuesto','$this->fechapresupuesto','$this->fechaentrega','$this->id_orden','$this->id_contador','$this->estadopresu','$this->detallepresusolotexto')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostrarpresupuesto($cod)
	{
		$sql="SELECT id_presupuesto,monto_presupuesto,detalle_presupuesto,fecha_presupuesto,fecha_entrega,id_orden,id_contador FROM presupuesto WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarUnpresupuestoEntregadoDeorden($cod)
	{
		$sql="SELECT id_presupuesto,monto_presupuesto,detalle_presupuesto,fecha_presupuesto,fecha_entrega,id_orden,id_contador FROM presupuesto WHERE id_orden=$cod AND fecha_entrega<>'' ";
		return parent::ejecutar($sql);
	}

	public function entregardinero()
	{
		$sql="UPDATE presupuesto SET fecha_entrega='$this->fechaentrega', estadopresupuesto='$this->estadopresu' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	///FUNCION PARA MOSTRAR FECHA DE PRESUPUESTO Y FECHA ENTREGA DE DINERO
	public function mostrarfechaspresupuestoyentrega($cod)
	{
		$sql="SELECT fecha_presupuesto,fecha_entrega,estadopresupuesto FROM presupuesto WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
//////funcion para cambiar el estado del presupuesto, cuando se gasta el dinero
	public function cambiarelestadodepresupuesto()
	{
		$sql="UPDATE presupuesto set estadopresupuesto='$this->estadopresu' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostrarlospresupuestados()
	{
		$sql="SELECT monto_presupuesto FROM presupuesto WHERE estadopresupuesto='Presupuestado'";
		return parent::ejecutar($sql);
	}
	public function mostrarpresupuestosentregados()
	{
		$sql="SELECT monto_presupuesto FROM presupuesto WHERE estadopresupuesto='Entregado'";
		return parent::ejecutar($sql);
	}

	public function mostrarpresupuestogastado()
	{
		$sql="SELECT monto_presupuesto FROM presupuesto WHERE estadopresupuesto='Gastado'";
		return parent::ejecutar($sql);
	}

	public function modificarPresupuesto()
	{
		$sql="UPDATE presupuesto set monto_presupuesto='$this->montopresupuesto',detalle_presupuesto='$this->detallepresupuesto', id_contador='$this->id_contador',detallepresusolotexto='$this->detallepresusolotexto' WHERE id_orden='$this->id_orden' ";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
    /*funcion para verificar si una orden ya tiene presupuesto*/
	public function mostrarIdordenenPresupuesto($cod)
	{
		$sql="SELECT id_orden FROM presupuesto WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	} 
	/*funcion para verificar que no se modique un presupuesto despuues de aver entregado el dinero(control-modificarpresupuesto.php)*/
	public function mostrarFechaEntregaPresupuestoDEorden($cod)
	{
		$sql="SELECT fecha_entrega FROM presupuesto WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function modificarDetallePresupuesto()
	{
		$sql="UPDATE presupuesto SET detalle_presupuesto='$this->detallepresupuesto', detallepresusolotexto='$this->detallepresusolotexto' WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function eliminarUNpresupuesto()
	{
		$sql="DELETE FROM presupuesto WHERE id_orden='$this->id_orden'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function sumaPresupuestoEntregado_al_Procurador()
	{
		$sql="SELECT SUM(monto_presupuesto)AS totalentregado FROM presupuesto WHERE estadopresupuesto='Entregado' OR estadopresupuesto='Gastado'";
		return parent::ejecutar($sql);
	}

	public function sumaPresupuestoConfirmadoContador()
	{
		$sql="SELECT SUM(monto_presupuesto)AS totalconfirmado FROM presupuesto WHERE estadopresupuesto='Gastadoconfir'";
		return parent::ejecutar($sql);
	}

	public function sumaPresupuestoEntregado_al_Procurador_SinGastar()
	{
		$sql="SELECT SUM(monto_presupuesto)AS totalentregadosingastar FROM presupuesto WHERE estadopresupuesto='Entregado'";
		return parent::ejecutar($sql);
	}

	public function sumaPresupuestoGastadoSinConfirContador()
	{
		$sql="SELECT SUM(monto_presupuesto)AS totalgastado FROM presupuesto WHERE estadopresupuesto='Gastado'";
		return parent::ejecutar($sql);
	}
	


	
	
}