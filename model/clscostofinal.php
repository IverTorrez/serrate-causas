<?php
include_once('clsconexion.php');
class Costofinal extends Conexion{
    private $id_costofinal;
    private $costo_procuradoria_compra;
    private $costo_procuradoria_venta;
    private $costo_prosesal_venta;
    private $total_egreso;
    private $id_orden;
    private $penalidadcostofinal;
    private $malgasto;
    private $validadofinal;
    private $canceladoprocurador;
    private $gananciaprocu;
    private $gananciaproce;
    private $costo_prosesal_compra;

public function Costofinal()
    {
		parent::Conexion();
		$this->id_costofinal=0;
		$this->costo_procuradoria_compra=0;
		$this->costo_procuradoria_venta=0;
		$this->costo_prosesal_venta=0;
		$this->total_egreso=0;
		$this->id_orden=0;
		$this->penalidadcostofinal=0;
		$this->malgasto=0;
		$this->validadofinal="";
		$this->canceladoprocurador="";
		$this->gananciaprocu=0;
		$this->gananciaproce=0;
		$this->costo_prosesal_compra=0;
		
	}
public function setid_costofinal($valor)
{
     $this->id_costofinal=$valor;
}
public function getid_costofinal()
{
	return $this->id_costofinal;
}
public function setcosto_procuradoria_compra($valor)
{
	$this->costo_procuradoria_compra=$valor;
}
public function getcosto_procuradoria_compra()
{
	$this->costo_procuradoria_compra;
}
public function setcosto_procuradoria_venta($valor)
{
     $this->costo_procuradoria_venta=$valor;
}
public function getcosto_procuradoria_venta()
{
	return $this->costo_procuradoria_venta;
}
public function setcosto_prosesal_venta($valor)
{
     $this->costo_prosesal_venta=$valor;
}
public function getcosto_prosesal_venta()
{
	return $this->costo_prosesal_venta;
}
public function settotal_egreso($valor)
{
     $this->total_egreso=$valor;
}
public function gettotal_egreso()
{
	return $this->total_egreso;
}
public function setid_orden($valor)
{
     $this->id_orden=$valor;
}
public function getid_orden()
{
	return $this->id_orden;
}
public function setpenalidadcostofinal($valor)
{
     $this->penalidadcostofinal=$valor;
}
public function getpenalidadcostofinal()
{
	return $this->penalidadcostofinal;
}
public function setmalgasto($valor)
{
     $this->malgasto=$valor;
}
public function getmalgasto()
{
	return $this->malgasto;
}
public function setvalidadofinal($valor)
{
     $this->validadofinal=$valor;
}
public function getvalidadofinal()
{
	return $this->validadofinal;
}
public function setcanceladoprocurador($valor)
{
     $this->canceladoprocurador=$valor;
}
public function getcanceladoprocurador()
{
	return $this->canceladoprocurador;
}
public function setgananciaprocuradoria($valor)
{
	$this->gananciaprocu=$valor;
}
public function getgananciaprocuradoria()
{
	return $this->gananciaprocu;
}
public function setgananciaprocesal($valor)
{
	$this->gananciaproce=$valor;
}
public function getgananciaprocesal()
{
	return $this->gananciaproce;
}

public function setCostoprocesalCompra($valor)
{
	$this->costo_prosesal_compra=$valor;
}
public function getCostoprocesalCOmpra()
{
	return $this->costo_prosesal_compra;
}



public function guardarcostofinal()
	{
		$sql="INSERT INTO costofinal(costo_procuradoria_compra,costo_procuradoria_venta,costo_procesal_venta,total_egreso,id_orden,penalidadcostofinal,malgasto,validadofinal,canceladoprocurador,ganaciaprocuradoria,ganaciaprocesal,costo_procesal_compra) VALUES('$this->costo_procuradoria_compra','$this->costo_procuradoria_venta','$this->costo_prosesal_venta','$this->total_egreso','$this->id_orden','$this->penalidadcostofinal','$this->malgasto','$this->validadofinal','$this->canceladoprocurador','$this->gananciaprocu','$this->gananciaproce','$this->costo_prosesal_compra' )";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
///////MUESTRA LO GENERADO POR PROCURADORES EN COMPRA, QUE NO ESTAN CANCELADOS(NO ES LO MISMO QUE MONTO A PAGAR)
	public function mostrargeneradosporprocuradornocancelados()
	{
		$sql="SELECT costo_procuradoria_compra  FROM costofinal WHERE canceladoprocurador='No'";
		return parent::ejecutar($sql);
	}
	public function mostrartodolosmalgasto()
	{
		$sql="SELECT malgasto FROM costofinal";
		return parent::ejecutar($sql);
	}

	public function mostrardatoscostofinal($cod)
	{
		$sql="SELECT costo_procuradoria_venta,costo_procesal_venta,total_egreso,ganaciaprocesal,costo_procesal_compra FROM costofinal WHERE id_costofinal=$cod";
		return parent::ejecutar($sql);
	}

	public function colocarcostoprocesalventa()
	{
		$sql="UPDATE costofinal SET costo_procesal_venta='$this->costo_prosesal_venta', total_egreso='$this->total_egreso', validadofinal='$this->validadofinal', ganaciaprocesal='$this->gananciaproce' WHERE id_costofinal='$this->id_costofinal'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

	public function mostrarcostoprocesalventasinvalida()
	{
		$sql="SELECT costo_procesal_venta FROM costofinal WHERE  validadofinal='No'";
		return parent::ejecutar($sql);
	}

	public function mostrartodaslaspenalidades()
	{
		$sql="SELECT penalidadcostofinal FROM costofinal WHERE canceladoprocurador='No'";
		return parent::ejecutar($sql);
	}

	public function mostrardinerogastadosinvalida()
	{
		$sql="SELECT (costo_procesal_venta+malgasto)as Gastado FROM costofinal WHERE  validadofinal='No'";
		return parent::ejecutar($sql);
	}

	public function mostrarcostosdeunaorden($cod)
	{
		$sql="SELECT costo_procuradoria_compra,costo_procuradoria_venta,costo_procesal_venta,total_egreso,id_orden,penalidadcostofinal,malgasto,validadofinal,canceladoprocurador,ganaciaprocuradoria,ganaciaprocesal FROM costofinal WHERE id_orden=$cod ";
		return parent::ejecutar($sql);
	}
//////MUESTRA COMPRA Y PENALIDAD DE PROCURADORIA
	public function mostrarcompraparaprocuradr($cod)
	{
		$sql="SELECT (costo_procuradoria_compra+penalidadcostofinal)AS Compraproc FROM costofinal WHERE id_orden=$cod";
		return parent::ejecutar($sql);
	}
////////FUNCION PARA MOSTRAR TODAS LAS GANANCIAS EN PROCURADORIA 
	public function mostrargananciasprocuradoria()
	{
		$sql="SELECT SUM(ganaciaprocuradoria)as GananciaProcuradoria FROM costofinal ";
		return parent::ejecutar($sql);
	}
////////FUNCION PARA MOSTRAR TODAS LAS GANANCIAS PROCESALES	
	public function mostrargananciaprocesal()
	{
		$sql="SELECT SUM(ganaciaprocesal)as GananciaProcesal FROM costofinal ";
		return parent::ejecutar($sql);
	}

	public function modificarelCanceladoProcurador($cod)
	{
		$sql="UPDATE costofinal SET canceladoprocurador='$this->canceladoprocurador' WHERE id_orden=$cod";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}
	/*MUESTRA LAS PENALIDADES CANCELADAS POR EL PROCUURADOR*/
	public function mostrarpenalidadCancelada()
	{
		$sql="SELECT penalidadcostofinal FROM costofinal WHERE canceladoprocurador='Si'";
		return parent::ejecutar($sql);
	}

	public function mostrarValidacionFinalDelAdminDEunCostoFinal($cod)
	{
		$sql="SELECT validadofinal FROM costofinal WHERE id_costofinal=$cod";
		return parent::ejecutar($sql);
	}
    /*CONFIRMA EL COSTOFINAL CON EL QUE SE DESCARGARGO LA ORDEN*/
	public function confirmaMontoDescargaCostofinal()
	{
		$sql="UPDATE costofinal SET validadofinal='$this->validadofinal' WHERE id_costofinal='$this->id_costofinal' ";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	/*FUNCION PARA MODIFICAR EL COSTO FINAL DE PROCURADURIA DE UNA ORDEN*/
	public function modificarCostosDeProcuraduriaDeOrden()
	{
		$sql="UPDATE costofinal SET costo_procuradoria_compra='$this->costo_procuradoria_compra', costo_procuradoria_venta='$this->costo_procuradoria_venta',total_egreso='$this->total_egreso', penalidadcostofinal='$this->penalidadcostofinal',ganaciaprocuradoria='$this->gananciaprocu' WHERE id_orden='$this->id_orden' ";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}
	/*FIN FUNCION PARA MODIFICAR EL COSTO FINAL DE PROCURADURIA*/

	


}
?>