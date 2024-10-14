<?php  
include_once('clsconexion.php');
class Planillas_envio_notificacion extends Conexion{
	private $cod_planilla;
	private $indicador;
	private $fecha_proceso;
	private $fecha_proceso_hasta;
	private $sec;
	private $evento;
	private $emisor;
	private $tipo_dinamico_estatico;
	private $receptor_estatico;
	private $descripcion_receptor;
	private $asunto;
	private $texto;
	private $tipo_notificacion;
	private $envia_notif;
	private $estado;
	private $id_usuario_alta;
	private $fecha_alta;
	private $id_usuario_baja;
	private $fecha_baja;
	private $nombre_emisor;

	public function Planillas_envio_notificacion()
	{
		parent::Conexion();
		$this->cod_planilla=0;
		$this->indicador="";
		$this->fecha_proceso="";
		$this->fecha_proceso_hasta="";
		$this->sec=0;
		$this->evento="";
		$this->emisor="";
		$this->tipo_dinamico_estatico=0;
		$this->receptor_estatico="";
		$this->descripcion_receptor="";
		$this->asunto="";
		$this->texto="";
		$this->tipo_notificacion=0;
		$this->envia_notif=0;
		$this->estado="";
		$this->id_usuario_alta=0;
		$this->fecha_alta="";
		$this->id_usuario_baja=0;
		$this->fecha_baja="";
		$this->nombre_emisor="";

	}

	public function setcod_planilla($valor)
	{
		$this->cod_planilla=$valor;
	}
	public function getcod_planilla()
	{
		return $this->cod_planilla;
	}
	public function setIndicador($valor)
	{
		$this->indicador=$valor;
	}
	public function getIndicador()
	{
		return $this->indicador;
	}
	public function setFechaProceso($valor)
	{
		$this->fecha_proceso=$valor;
	}
	public function getFechaProceso()
	{
		return $this->fecha_proceso;
	}

	public function setFecha_proceso_hasta($valor)
	{
		$this->fecha_proceso_hasta=$valor;
	}
	public function getFecha_proceso_hasta()
	{
		return $this->fecha_proceso_hasta;
	}

	public function set_Sec($valor)
	{
		$this->sec=$valor;
	}
	public function get_Sec()
	{
		return $this->sec;
	}

	public function set_evento($valor)
	{
		$this->evento=$valor;
	}
	public function get_evento()
	{
		return $this->evento;
	}
	public function set_tipo_dinamico_estatico($valor)
	{
		$this->tipo_dinamico_estatico=$valor;
	}
	public function get_tipo_dinamico_estatico()
	{
		return $this->tipo_dinamico_estatico;
	}
    
	public function set_emisor($valor)
	{
		$this->emisor=$valor;
	}
	public function get_emisor()
	{
		return $this->emisor;
	}

	public function set_receptor_estatico($valor)
	{
		$this->receptor_estatico=$valor;
	}
	public function get_receptor_estatico()
	{
		return $this->receptor_estatico;
	}
	public function set_descripcion_receptor($valor)
	{
		$this->descripcion_receptor=$valor;
	}
	public function get_descripcion_receptor()
	{
		return $this->descripcion_receptor;
	}
    
	public function set_asunto($valor)
	{
		$this->asunto=$valor;
	}
	public function get_asunto()
	{
		return $this->asunto;
	}

	public function set_texto($valor)
	{
		$this->texto=$valor;
	}
	public function get_texto()
	{
		return $this->texto;
	}
	public function set_tipo_notificacion($valor)
	{
		$this->tipo_notificacion=$valor;
	}
	public function get_tipo_notificacion()
	{
		return $this->tipo_notificacion;
	}
	public function set_envia_notif($valor)
	{
		$this->envia_notif=$valor;
	}
	public function get_envia_notif()
	{
		return $this->envia_notif;
	}

	public function set_estado($valor)
	{
		$this->estado=$valor;
	}
	public function get_estado()
	{
		return $this->estado;
	}

	public function set_id_usuario_alta($valor)
	{
		$this->id_usuario_alta=$valor;
	}
	public function get_id_usuario_alta()
	{
		return $this->id_usuario_alta;
	}

	public function set_fecha_alta($valor)
	{
		$this->fecha_alta=$valor;
	}
	public function get_fecha_alta()
	{
		return $this->fecha_alta;
	}

	public function set_id_usuario_baja($valor)
	{
		$this->id_usuario_baja=$valor;
	}
	public function get_id_usuario_baja()
	{
		return $this->id_usuario_baja;
	}
	public function set_fecha_baja($valor)
	{
		$this->fecha_baja=$valor;
	}
	public function get_fecha_baja()
	{
		return $this->fecha_baja;
	}
	public function set_nombre_emisor($valor)
	{
		$this->nombre_emisor=$valor;
	}
	public function get_nombre_emisor()
	{
		return $this->nombre_emisor;
	}

	public function guardar_planillas_envio_notificacion()
	{
		$sql="INSERT INTO planillas_envio_notificacion(cod_planilla,
							                          indicador,
							                          fecha_proceso,
							                          fecha_proceso_hasta,
							                          sec,
							                          evento,
							                          emisor,
							                          tipo_dinamico_estatico,
							                          receptor_estatico,
							                          descripcion_receptor,
							                          asunto,
							                          texto,
							                          tipo_notificacion,
							                          envia_notif,
							                          estado,
							                          id_usuario_alta,
							                          fecha_alta,
							                          id_usuario_baja,
							                          fecha_baja,
							                          nombre_emisor)
		                    VALUES('$this->cod_planilla',
		                           '$this->indicador',
		                           '$this->fecha_proceso',
		                           '$this->fecha_proceso_hasta',
		                           '$this->sec',
		                           '$this->evento',
		                           '$this->emisor',
		                           '$this->tipo_dinamico_estatico',
		                           '$this->receptor_estatico',
		                           '$this->descripcion_receptor',
		                           '$this->asunto',
		                           '$this->texto',
		                           '$this->tipo_notificacion',
		                           '$this->envia_notif',
		                           '$this->estado',
		                           '$this->id_usuario_alta',
		                           '$this->fecha_alta',
		                           '$this->id_usuario_baja',
		                           '$this->fecha_baja',
		                           '$this->nombre_emisor')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function listarPlanillas_envioNotif_activas()
	{
		$sql="SELECT cod_planilla,
                     indicador,
                     fecha_proceso,
                     fecha_proceso_hasta,
                     sec,
                     evento,
                     emisor,
                     (CASE WHEN tipo_dinamico_estatico=1
                          THEN 'DINAMICO'
                          WHEN tipo_dinamico_estatico=2
                          THEN 'ESTATICO'
                          ELSE ''
                          END) AS tipo_dinamico_est,
                     receptor_estatico,
                     descripcion_receptor,
                     asunto,
                     texto,
                     (case WHEN tipo_notificacion=1
                          THEN 'CORREO'
                          WHEN tipo_notificacion=2
                          THEN 'NOTIFICACIÓN PUSH'
                          ELSE ''
                          END) as tipo_notifi,
                     (CASE WHEN envia_notif=1
                          THEN 'Si'
                          WHEN envia_notif=2
                          THEN 'No'
                          ELSE ''
                          END) as envia_notificacion,
                     estado,
                     id_usuario_alta,
                     fecha_alta,
                     id_usuario_baja,
                     fecha_baja,
                     nombre_emisor 
		        FROM planillas_envio_notificacion 
		       WHERE estado='A'
		         and indicador='A'
		         and fecha_proceso_hasta='2050-01-01'";
		return parent::ejecutar($sql);
	}
	public function obtenerMaximoCodigo()
	{
		$sql="SELECT MAX(cod_planilla) as max_codigo  FROM planillas_envio_notificacion";
		 return parent::ejecutar($sql);
	}
	public function mostrarUnaPlanillas_envioNotif_activa($cod)
	{
		$sql="SELECT cod_planilla,
                     indicador,
                     fecha_proceso,
                     fecha_proceso_hasta,
                     sec,
                     evento,
                     emisor,
                     tipo_dinamico_estatico,
                     receptor_estatico,
                     descripcion_receptor,
                     asunto,
                     texto,
                     tipo_notificacion,
                     envia_notif,
                     estado,
                     id_usuario_alta,
                     fecha_alta,
                     id_usuario_baja,
                     fecha_baja,
                     nombre_emisor 
		        FROM planillas_envio_notificacion 
		       WHERE estado='A'
		         and indicador='A'
		         and fecha_proceso_hasta='2050-01-01'
		         and cod_planilla=$cod";
		return parent::ejecutar($sql);
	}

	public function modRegPlanillaParaHistorial()
	{
		$sql="UPDATE planillas_envio_notificacion
		         SET indicador='$this->indicador',
		             fecha_proceso_hasta='$this->fecha_proceso_hasta' 
		       WHERE estado='A'
		         and indicador='A'
		         and fecha_proceso_hasta='2050-01-01'
		         and cod_planilla='$this->cod_planilla'  ";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	
}
?>