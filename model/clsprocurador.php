<?php
include_once('clsconexion.php');
class Procurador extends Conexion{
	private $id_procurador;
	private $nombproc;
	private $apellproc;
	private $nomblogproc;
	private $telfproc;
	private $correoproc;
	private $claveproc;
	private $direccionproc;
	private $coordenadasproc;
	private $observproc;
	private $estadoproc;
	private $fotoproc;
	private $tpprocurador;
	private $visibleproc;
	private $token;

	public function Procurador()
	{
		parent::Conexion();
		$this->id_procurador=0;
		$this->nombproc="";
		$this->apellproc="";
		$this->nomblogproc="";
		$this->telfproc="";
		$this->correoproc="";
		$this->claveproc="";
		$this->direccionproc="";
		$this->coordenadasproc="";
		$this->observproc="";
		$this->estadoproc="";
		$this->fotoproc="";
		$this->tpprocurador="";
		$this->visibleproc="";
		$this->token="";
	}

	public function setid_procurador($valor)
	{
		$this->id_procurador=$valor;
	}
	public function getid_procurador()
	{
		return $this->id_procurador;
	}
	public function setnombprocurador($valor)
	{
		$this->nombproc=$valor;
	}
	public function getnombprocurador()
	{
		return $this->nombproc;
	}
	public function setapellprocurador($valor)
	{
		$this->apellproc=$valor;
	}
	public function getapellprocurador()
	{
		return $this->apellproc;
	}

	public function setnombloginproc($valor)
	{
		$this->nomblogproc=$valor;
	}
	public function getnombloginproc()
	{
		return $this->nomblogproc;
	}
	public function settelefonoproc($valor)
	{
		$this->telfproc=$valor;
	}
	public function gettelefonoproc()
	{
		return $this->telfproc;
	}
	public function setcorreoproc($valor)
	{
		$this->correoproc=$valor;
	}
	public function getcorreoproc()
	{
		return $this->correoproc;
	}
	public function setclaveproc($valor)
	{
		$this->claveproc=$valor;
	}
	public function getclaveproc()
	{
		return $this->claveproc;
	}

	public function setdireccionproc($valor)
	{
		$this->direccionproc=$valor;
	}
	public function getdireccionproc()
	{
		return $this->direccionproc;
	}
	public function setcoordenadasproc($valor)
	{
		$this->coordenadasproc=$valor;
	}
	public function getcoordenadasproc()
	{
		return $this->coordenadasproc;
	}
	public function setobservacionesproc($valor)
	{
		$this->observproc=$valor;
	}
	public function getobservacionesproc()
	{
		return $this->observproc;
	}
	public function setestadoproc($valor)
	{
		$this->estadoproc=$valor;
	}
	public function getestadoproc()
	{
		return $this->estadoproc;
	}
	public function setfotoproc($valor)
	{
		$this->fotoproc=$valor;
	}
	public function getfotoproc()
	{
		return $this->fotoproc;
	}
	public function settpprocurador($valor)
	{
		$this->tpprocurador=$valor;
	}
	public function gettpprocurador()
	{
		return $this->tpprocurador;
	}

	public function setvisibleproc($valor)
	{
		$this->visibleproc=$valor;
	}
	public function getvisibleproc()
	{
		return $this->visibleproc;
	}
	
	public function setToken($valor)
	{
		$this->token=$valor;
	}
	public function getToken()
	{
		return $this->token;
	}

	public function guardarprocurador()
	{
		$sql="INSERT INTO procurador(nombreproc,apellidoproc,nombrelogproc,telefonoproc,correoproc,claveproc,direccionproc,coordenadasproc,observacionesproc,estadoproc,fotoproc,tipoproc,visibleproc,token) VALUES('$this->nombproc','$this->apellproc','$this->nomblogproc','$this->telfproc','$this->correoproc','$this->claveproc','$this->direccionproc','$this->coordenadasproc','$this->observproc','$this->estadoproc','$this->fotoproc','$this->tpprocurador','$this->visibleproc','$this->token')";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

	}

    public function listarTodosprocurador()
	{
		$sql="SELECT *FROM procurador WHERE visibleproc='Si' ORDER BY apellidoproc ASC  ";
		return parent::ejecutar($sql);
	}
    /*FUNCION QUE ENLISTA SOLO PROCURADORES*/
	public function listarSoloprocuradores()
	{
		$sql="SELECT *FROM procurador WHERE tipoproc='Procurador' AND visibleproc='Si' ORDER BY  apellidoproc ASC";
		return parent::ejecutar($sql);
	}

	 /*FUNCION QUE ENLISTA PROCURADORES MAESTROS*/
	public function listarProcuradoresMaestros()
	{
		$sql="SELECT *FROM procurador WHERE tipoproc='ProcuradorMaestro' AND visibleproc='Si' ORDER BY  apellidoproc ASC";
		return parent::ejecutar($sql);
	}
	public function listarprocurador()
	{  //antiguo $sql="SELECT *FROM procurador WHERE estadoproc='Activo' AND tipoproc='Procurador' AND visibleproc='Si'";
	    $sql="SELECT *FROM procurador WHERE estadoproc='Activo' AND tipoproc='Procurador' AND visibleproc='Si' ORDER BY  apellidoproc ASC";
		return parent::ejecutar($sql);
	}
  
  ///ESTE FUNCION MUESTRA AL PROCURADOR ESCOGIDO PARA UNA CAUSA (AL CREAR UNA ORDEN) y a leditar una causa
	public function mostrarprocuradorpordefectodecausa($cod)
	{
		$sql="SELECT (procurador.id_procurador)AS idproc, (procurador.nombreproc)AS Nombre, (procurador.apellidoproc)AS Apellidos,(procurador.tipoproc)AS Tipo FROM causa,procurador WHERE causa.id_procurador=procurador.id_procurador AND causa.id_causa=$cod";   
     return parent::ejecutar($sql);

	}
///ESTE FUNCION MUESTRA AL PROCURADOR ESCOGIDO PARA UNA ORDEN (AL PRESUPUESTAR UNA ORDEN) 
	public function mostrarprocuradorpordefectodeOrden($cod)
	{
		$sql="SELECT (procurador.id_procurador)AS idproc, (procurador.nombreproc)AS Nombre, (procurador.apellidoproc)AS Apellidos,(procurador.tipoproc)AS Tipo FROM ordengeneral ,procurador WHERE ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_orden=$cod";   
     return parent::ejecutar($sql);

	}
   /*ENLISTA LOS PROCURADORES ACTIVOS EXCEPTO UNO*/
	public function listarprocuradoresexeptouno($cod)
	{
		$sql="SELECT (procurador.id_procurador)AS idproc, (procurador.nombreproc)AS Nombre, (procurador.apellidoproc)AS Apellidos,(procurador.tipoproc)AS Tipo FROM procurador WHERE estadoproc='Activo' AND tipoproc='Procurador' AND procurador.id_procurador<>$cod AND visibleproc='Si'  ORDER BY apellidoproc ASC" ;
		return parent::ejecutar($sql);
	}

	public function mostrarclaveprocurador()
	{
		$sql="SELECT claveproc FROM procurador";
		return parent::ejecutar($sql);
	}

	public function mostrarunprocuradro($cod)
	{
		$sql="SELECT concat(nombreproc,' ',apellidoproc)as Nombre,token FROM procurador WHERE id_procurador=$cod";
		return parent::ejecutar($sql);
	}
	public function listarProcuradorActivos()
	{  //Consulta antigua $sql="SELECT id_procurador, concat(nombreproc,' ',apellidoproc)AS NombreP FROM procurador WHERE visibleproc='Si' AND tipoproc='Procurador' AND estadoproc='Activo' ORDER BY nombreproc ASC ";
		$sql="SELECT id_procurador,nombreproc,apellidoproc FROM procurador WHERE visibleproc='Si' AND tipoproc='Procurador' AND estadoproc='Activo' ORDER BY apellidoproc ASC ";
		return parent::ejecutar($sql);
	}

	/*DATOS DE USUARIO PARA LOGIN*/
	public function loginProcurador()
      {
	$sql="SELECT * from procurador where nombrelogproc='$this->nomblogproc' and claveproc='$this->claveproc' AND estadoproc='Activo' AND visibleproc='Si'";
	return parent::ejecutar($sql);
       }
       public function mostrarunProcurador1($cod)
       {
       	$sql="SELECT id_procurador,nombreproc,apellidoproc,nombrelogproc,telefonoproc,correoproc,claveproc,direccionproc,coordenadasproc,observacionesproc,estadoproc,fotoproc,tipoproc FROM procurador WHERE id_procurador=$cod ";
       	return parent::ejecutar($sql);
       }


       public function editarunProcuradorSinFoto()
       {
       	 $sql="UPDATE procurador SET nombreproc='$this->nombproc',apellidoproc='$this->apellproc',nombrelogproc='$this->nomblogproc',telefonoproc='$this->telfproc',correoproc='$this->correoproc',claveproc='$this->claveproc',direccionproc='$this->direccionproc',coordenadasproc='$this->coordenadasproc',observacionesproc='$this->observproc',estadoproc='$this->estadoproc' WHERE id_procurador='$this->id_procurador' ";
       	 if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
       }

       public function editarunProcuradorConFoto()
       {
       	 $sql="UPDATE procurador SET nombreproc='$this->nombproc',apellidoproc='$this->apellproc',nombrelogproc='$this->nomblogproc',telefonoproc='$this->telfproc',correoproc='$this->correoproc',claveproc='$this->claveproc',direccionproc='$this->direccionproc',coordenadasproc='$this->coordenadasproc',observacionesproc='$this->observproc',estadoproc='$this->estadoproc',fotoproc='$this->fotoproc' WHERE id_procurador='$this->id_procurador' ";
       	 if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
       }
       /*ELIMINA UN PROCURADOR (VISIBLEPROC=NO)*/
       public function eliminarProcurador()
       {
       	$sql="UPDATE procurador SET visibleproc='$this->visibleproc' WHERE id_procurador='$this->id_procurador' ";
       	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

       }








/*---------------------------NUEVAS FUNCIONES PARA LA IMPRESION DE EJECUCION PARA EL PROCURADOR----*/
      public function listarOrdenesParaEjecutar_Impresion($id)
      {
      	  ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

      	$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(causa.id_causa)AS idcausa,(ordengeneral.id_orden)AS codorden,(causa.nombrecausa)AS nomcausa,(causa.obsevacionescausas)AS Obser,concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS fechafin, (ordengeneral.informacion)AS infocarga FROM causa,tipolegal,materia, ordengeneral WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND ordengeneral.id_procurador=$id ORDER BY concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin) ASC";
      	return parent::ejecutar($sql);
      }
      
      public function listarOrdenesParaEjecutarPM_Impresion()
      {
      	  ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

      	$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,(causa.id_causa)AS idcausa,(ordengeneral.id_orden)AS codorden,(causa.nombrecausa)AS nomcausa,(causa.obsevacionescausas)AS Obser,concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS fechafin, (ordengeneral.informacion)AS infocarga FROM causa,tipolegal,materia, ordengeneral WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND (ordengeneral.estado_orden<>'Serrada' AND ordengeneral.estado_orden<>'Descargada' AND ordengeneral.estado_orden<>'PronuncioAbogado' AND ordengeneral.estado_orden<>'PronuncioContador') AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' ORDER BY concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin) ASC";
      	return parent::ejecutar($sql);
      }

      public function mostrarPrimerTribunaldeCausa($id)
      {
      	$sql="SELECT id_tribunal,expediente,codnurejianuj FROM tribunal WHERE id_tribunal=(SELECT MIN(id_tribunal) FROM tribunal WHERE tribunal.id_causa=$id)";
      	return parent::ejecutar($sql);
      }


      public function mostrarUltimafojaDeCausa($id)
      {
      	$sql="SELECT id_descarga, ultima_foja FROM descargaprocurador WHERE id_descarga=(SELECT MAX(id_descarga) FROM descargaprocurador,ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=descargaprocurador.id_orden AND causa.id_causa=$id)";
      	return parent::ejecutar($sql);
      }
/*--------------------FIN DE NUEVAS FUNCIONES-----------------------------------------------------*/
/*================FUNCION PARA GUARDAR EL TOKEN DEL PROCURADOR=================================*/
    public function guardarTokenDeProcurador()
    {
    	$sql="UPDATE procurador SET token='$this->token' WHERE id_procurador='$this->id_procurador'";
    	if (parent::ejecutar($sql)) 
			return true;
		else
			return false;

    }
/*================FIN FUNCION PARA GUARDAR EL TOKEN DEL PROCURADOR=================================*/

  public function mostrarProcuradorMaestro()
    {
    	$sql="SELECT *FROM procurador WHERE tipoproc='ProcuradorMaestro' AND estadoproc='Activo' AND visibleproc='Si' ORDER BY id_procurador ASC";
    	return parent::ejecutar($sql);
    }


}
?>