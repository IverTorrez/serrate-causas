<?php
include_once('clsconexion.php');
class Confirmacion extends Conexion{
	private $id_confirmacion;
	private $confirmasistema;
	private $confirmaabogado;
	private $fechaconfirabogado;
	private $confirmacontador;
	private $fechaconfircontador;
	private $id_descarga;
	private $justificacionabog;

	public function Confirmacion()
	{
		parent::Conexion();
		$this->id_confirmacion=0;
		$this->confirmasistema=0;
		$this->confirmaabogado=0;
		$this->fechaconfirabogado="";
		$this->confirmacontador=0;
		$this->fechaconfircontador="";
		$this->id_descarga=0;
		$this->justificacionabog="";

	}

	public function setid_confirmacion($valor)
	{
		$this->id_confirmacion=$valor;
	}
	public function getid_confirmacion()
	{
		return $this->id_confirmacion;
	}
	public function setconfirsistema($valor)
	{
		$this->confirmasistema=$valor;
	}
	public function getconfirsistema()
	{
		return $this->confirmasistema;
	}
	public function setconfirabogado($valor)
	{
		$this->confirmaabogado=$valor;
	}
	public function getconfirabogado()
	{
		return $this->confirmaabogado;
	}

	public function setfechaconfirabogado($valor)
	{
		$this->fechaconfirabogado=$valor;
	}
	public function getfechaconfirabogado()
	{
		return $this->fechaconfirabogado;
	}

	public function setconfircontador($valor)
	{
		$this->confirmacontador=$valor;
	}
	public function getconfircontador()
	{
		return $this->confirmacontador;
	}

	public function setfechaconfircontador($valor)
	{
		$this->fechaconfircontador=$valor;
	}
	public function getfechaconfircontador()
	{
		return $this->fechaconfircontador;
	}

	public function setid_descarga($valor)
	{
		$this->id_descarga=$valor;
	}
	public function getid_descarga()
	{
		return $this->id_descarga;
	}

	public function setjustificacionabog($valor)
	{
		$this->justificacionabog=$valor;
	}
	public function getjustificacionabog()
	{
		return $this->justificacionabog;
	}

	public function guardarconfirmacion()
	{
		$sql="INSERT INTO confirmacion(confir_sistema,confir_abogado,fecha_confir_abogado,confir_contador,fecha_confir_contador,id_descarga,justificacionrechazo) VALUES('$this->confirmasistema','$this->confirmaabogado','$this->fechaconfirabogado','$this->confirmacontador','$this->fechaconfircontador','$this->id_descarga','$this->justificacionabog')";
		if (parent::ejecutar($sql))
			return true;
		else 
			return false;
	}
////FUNCION QUE MUESTRA EL CODIGO DE UNA CONFIRMACION APARTIR DE UN CODIGO DE ORDEN
	public function mostrarcodconfirmacion($cod)
	{
		$sql="SELECT (confirmacion.id_confirmacion)AS codconfir FROM confirmacion,descargaprocurador WHERE descargaprocurador.id_descarga=confirmacion.id_descarga AND descargaprocurador.id_orden=$cod";
		return parent::ejecutar($sql);
	}
   //FUNCION PARA EL PRONUNCIONAMIENTO DEL ABOGADO 
	public function pronunciamientoabogado()
	{
		$sql="UPDATE confirmacion SET confir_abogado='$this->confirmaabogado', fecha_confir_abogado='$this->fechaconfirabogado' WHERE id_confirmacion='$this->id_confirmacion'";
		if (parent::ejecutar($sql))
			return true;
		else 
			return false;
	}

	//FUNCION PARA EL PRONUNCIONAMIENTO DEL ABOGADO, CUANDO RECHAZA LA DESCARGA, SE LLENA EL CAMPO JUSTIFICACION 
	public function pronunciamientoabogadorechazo()
	{
		$sql="UPDATE confirmacion SET confir_abogado='$this->confirmaabogado', fecha_confir_abogado='$this->fechaconfirabogado', justificacionrechazo='$this->justificacionabog' WHERE id_confirmacion='$this->id_confirmacion'";
		if (parent::ejecutar($sql))
			return true;
		else 
			return false;
	}

	public function pronunciamientocontador()
	{
		$sql="UPDATE confirmacion SET confir_contador='$this->confirmacontador', fecha_confir_contador='$this->fechaconfircontador' WHERE id_confirmacion='$this->id_confirmacion'";
		if (parent::ejecutar($sql))
			return true;
		else 
			return false;
	}

	public function mostrarlaconfirmaciondelsistemayabogado($cod)
	{
		$sql="SELECT confir_sistema,confir_abogado FROM confirmacion WHERE id_confirmacion=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarfechasdeconfirmacion($cod)
	{
		$sql="SELECT fecha_confir_abogado,fecha_confir_contador FROM confirmacion,ordengeneral,descargaprocurador WHERE ordengeneral.id_orden=descargaprocurador.id_orden AND descargaprocurador.id_descarga=confirmacion.id_descarga AND ordengeneral.id_orden=$cod";
		return parent::ejecutar($sql);
	}
////funcion que muestra la fecha de confirmacion del abogado, para saber si ya confirmo
	public function mostrarfechaconfirabogado($cod)
	{
		$sql="SELECT fecha_confir_abogado,confir_abogado FROM confirmacion, descargaprocurador WHERE confirmacion.id_descarga=descargaprocurador.id_descarga AND descargaprocurador.id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function registrarpronunciamientoContador()
	{
		$sql="UPDATE confirmacion SET confir_contador='$this->confirmacontador', fecha_confir_contador='$this->fechaconfircontador' WHERE id_confirmacion='$this->id_confirmacion'";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
		
	}
	////funcion que muestra la fecha de confirmacion del contador, para saber si ya confirmo
	public function mostrarfechaconfircontador($cod)
	{
		$sql="SELECT fecha_confir_contador FROM confirmacion, descargaprocurador WHERE confirmacion.id_descarga=descargaprocurador.id_descarga AND descargaprocurador.id_orden=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarFechasdescargaFechaconfircont($cod)
	{
		$sql="SELECT fecha_confir_contador,fecha_descarga FROM confirmacion, descargaprocurador WHERE confirmacion.id_descarga=descargaprocurador.id_descarga AND descargaprocurador.id_orden=$cod";
		return parent::ejecutar($sql);
	}
	
	/*FUNCION PARA CAMBIAR EL PRONUNCIAMIENTO DEL ABOGADO*/
    public function cambiarPronunciamientoAbogado()
    {
    	$sql="UPDATE confirmacion SET confir_abogado='$this->confirmaabogado' WHERE id_confirmacion='$this->id_confirmacion'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }

    public function cambiarPronunciamientoAbogado_Rechazar()
    {
    	$sql="UPDATE confirmacion SET confir_abogado='$this->confirmaabogado',justificacionrechazo='$this->justificacionabog' WHERE id_confirmacion='$this->id_confirmacion'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
    }
    
/*FIN DE FUNCION PARA CAMBIAR EL PRONUNCIAMIENTO DEL ABOGADO*/



	
}  
?>