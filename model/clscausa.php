<?php
include_once('clsconexion.php');
class Causa extends Conexion{
	private $id_causa;
	private $obsevcausa;
	private $objetcausa;
	private $estracausa;
	private $inforcausa;
	private $estadcausa;
	private $nombcausa;
	private $cajacausa;
	private $id_cliente;
	private $id_abogado;
	private $id_tplegal;
	private $id_procurador;
	private $id_materia;
	private $id_categoria;
	private $id_usuario;
	private $saldodevuelto;
	private $apuntjurid;
	private $apunthonora;

	private $observsolotexto;
	private $objetivossolotexto;
	private $estrategiassolotexto;
	private $inforsolotexto;
	private $apuntesjuridicossolotexto;
	private $apunteshonorariossolotexto;
	private $color_causa;


	public function Causa()
	{
		parent::Conexion();
		$this->id_causa=0;
		$this->obsevcausa="";
		$this->objetcausa="";
		$this->estracausa="";
		$this->inforcausa="";
		$this->estadcausa="";
		$this->nombcausa="";
		$this->cajacausa=0;
		$this->id_cliente=0;
		$this->id_abogado=0;
		$this->id_tplegal=0;
		$this->id_procurador=0;
		$this->id_materia=0;
		$this->id_categoria=0;
		$this->id_usuario=0;
		$this->saldodevuelto=0;
		$this->apuntjurid="";
		$this->apunthonora="";

		$this->observsolotexto="";
		$this->objetivossolotexto="";
		$this->estrategiassolotexto="";
		$this->inforsolotexto="";
		$this->apuntesjuridicossolotexto="";
		$this->apunteshonorariossolotexto="";
		$this->color_causa="";
	}

	public function setid_causa($valor)
	{
		$this->id_causa=$valor;
	}
	public function getid_causa()
	{
		return $this->id_causa;
	}
	public function setobservcausa($valor)
	{
		$this->obsevcausa=$valor;
	}
	public function getobservcausa()
	{
		return $this->obsevcausa;
	}
	public function setobjetivocausa($valor)
	{
		$this->objetcausa=$valor;
	}
	public function getobjetivocausa()
	{
		return $this->objetcausa;
	}
	public function setestrategiscausa($valor)
	{
		$this->estracausa=$valor;
	}
	public function getestrategiacausa()
	{
		return $this->estracausa;
	}
	public function setinformacioncausa($valor)
	{
		$this->inforcausa=$valor;
	}
	public function getinformacioncausa()
	{
		return $this->inforcausa;
	}
	public function setestadocausa($valor)
	{
		$this->estadcausa=$valor;
	}
	public function getestadocausa()
	{
		return $this->estadcausa;
	}
	public function setnombrecausa($valor)
	{
		$this->nombcausa=$valor;
	}
	public function getnombrecausa()
	{
		return $this->nombcausa;
	}
	public function setcajacausa($valor)
	{
		$this->cajacausa=$valor;
	}
	public function getcajacausa()
	{
		return $this->cajacausa;
	}
	public function setid_clientec($valor)
	{
		$this->id_cliente=$valor;
	}
	public function getid_clientec()
	{
		return $this->id_cliente;
	}
	public function setid_abogadoc($valor)
	{
		$this->id_abogado=$valor;
	}
	public function getid_abogadoc()
	{
		return $this->id_abogado;
	}
	public function setid_tplegalc($valor)
	{
		$this->id_tplegal=$valor;
	}
	public function getid_tplegalc()
	{
		return $this->id_tplegal;
	}
	public function setid_procuradorc($valor)
	{
		$this->id_procurador=$valor;
	}
	public function getid_procuradorc()
	{
		return $this->id_procurador;
	}
	public function setid_materiac($valor)
	{
		$this->id_materia=$valor;
	}
	public function getid_materiac()
	{
		return $this->id_materia;
	}
	public function setid_categoriac($valor)
	{
		$this->id_categoria=$valor;
	}
	public function getid_categoriac()
	{
		return $this->id_categoria;
	}

	public function setid_usuc($valor)
	{
		$this->id_usuario=$valor;
	}
	public function getid_usuc()
	{
		return $this->id_usuario;
	}

	public function setsaldodevuelto($valor)
	{
		$this->saldodevuelto=$valor;
	}
	public function getsaldodevuelto()
	{
		return $this->saldodevuelto;
	}

	public function setapuntesjuridicos($valor)
	{
		$this->apuntjurid=$valor;
	}
	public function getapuntesjuridicos()
	{
		return $this->apuntjurid;
	}

	public function setapunteshonorarios($valor)
	{
		$this->apunthonora=$valor;
	}
	public function getapunteshonorarios()
	{
		return $this->apunthonora;
	}

	public function setobservsolotexto($valor)
	{
		$this->observsolotexto=$valor;
	}
	public function getobservsolotexto()
	{
		return $this->observsolotexto;
	}


	public function setobjetivossolotexto($valor)
	{
		$this->objetivossolotexto=$valor;
	}
	public function getobjetivossolotexto()
	{
		return $this->objetivossolotexto;
	}
	public function setestrategiassolotexto($valor)
	{
		$this->estrategiassolotexto=$valor;
	}
	public function getestrategiassolotexto()
	{
		return $this->estrategiassolotexto;
	}
	public function setinforsolotexto($valor)
	{
		$this->inforsolotexto=$valor;
	}
	public function getinforsolotexto()
	{
		return $this->inforsolotexto;
	}
	public function setapuntesjuridicossolotexto($valor)
	{
		$this->apuntesjuridicossolotexto=$valor;
	}
	public function getapuntesjuridicossolotexto()
	{
		return $this->apuntesjuridicossolotexto;
	}
	public function setapunteshonorariossolotexto($valor)
	{
		$this->apunteshonorariossolotexto=$valor;
	}
	public function geapunteshonorariossolotexto()
	{
		return $this->apunteshonorariossolotexto;
	}
	
	public function setcolor_causa($valor)
	{
		$this->color_causa=$valor;
	}
	public function getcolor_causa()
	{
		return $this->color_causa;
	}

	public function guardarcausa()
	{
		$sql="INSERT INTO causa(obsevacionescausas,objetivos,estrategias,informacion,estadocausa,nombrecausa,caja,id_cliente,id_abogado,id_tipolegal,id_procurador,id_materia,id_categoria,id_usuario,saldodevuelto,apuntesjuridicos,apunteshonorarios,observsolotexto,objetivossolotexto,estrategiassolotexto,inforsolotexto,apuntesjuridicossolotexto,apunteshonorariosolotexto,color_causa) VALUES('$this->obsevcausa','$this->objetcausa','$this->estracausa','$this->inforcausa','$this->estadcausa','$this->nombcausa','$this->cajacausa','$this->id_cliente','$this->id_abogado','$this->id_tplegal','$this->id_procurador','$this->id_materia','$this->id_categoria','$this->id_usuario', '$this->saldodevuelto','$this->apuntjurid','$this->apunthonora','$this->observsolotexto','$this->objetivossolotexto','$this->estrategiassolotexto','$this->inforsolotexto','$this->apuntesjuridicossolotexto','$this->apunteshonorariossolotexto','$this->color_causa')";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}
	public function editarUnaCausa()
	{
		$sql="UPDATE causa SET id_materia='$this->id_materia',id_tipolegal='$this->id_tplegal',nombrecausa='$this->nombcausa',id_categoria='$this->id_categoria',obsevacionescausas='$this->obsevcausa',id_abogado='$this->id_abogado',id_procurador='$this->id_procurador',observsolotexto='$this->observsolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function insert()
	{
		$sql="INSERT INTO causa(observacionescausas,objetivos,estrategias,informacion,estadocausa,nombrecausa,caja,id_cliente,id_abogado,id_tipolegal,id_procurador,id_materia,id_categoria) VALUES('obsevcausa','objetcausa','estracausa','inforcausa','estadcausa','nombcausa','cajacausa',1,1,1,1,1,1)";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}
    
    /*LISTA LAS CAUSA ACTIVAS*/
	public function listarcausas()
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' ORDER BY id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	 /*LISTA LAS CAUSA ACTIVAS ORDENADO POR CATEGORIA*/
	public function listarcausasOrdenadoPorCategoria()
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' ORDER BY categoria.abreviaturacat ASC";
    
    return parent::ejecutar($sql);
	}


     /*LISTA LAS CAUSA ACTIVAS DE UN PROCURADOR*/
	public function listarcausasActivasDeUnProcurador($codproc)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_procurador=$codproc ORDER BY  causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS DE UN ABOGADO*/
	public function listarcausasDeAbogado($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_abogado=$cod ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS DE UN ABOGADO ORDENADO POR CATEGORIA*/
	public function listarcausasDeAbogadoOrdenadoPorCategoria($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_abogado=$cod ORDER BY categoria.abreviaturacat ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS DE UN CLIENTE*/
	public function listarcausasActivasDeunCliente($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,caja,estadocausa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND (causa.estadocausa='Activa' OR causa.estadocausa='Congelada') AND causa.id_cliente=$cod";
    
    return parent::ejecutar($sql);
	}

	public function listarCausasActivasPorPiso($cod)
	{
		$sql="SELECT (causa.id_causa)AS idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,tribunal,juzgados,piso
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=tribunal.id_causa AND tribunal.id_juzgados=juzgados.id_juzgados AND juzgados.id_piso=piso.id_piso AND piso.id_piso=$cod AND causa.estadocausa<>'Terminada' ORDER BY causa.id_causa ASC";
    return parent::ejecutar($sql);
	}

	public function listarCausasActivasPorPisoDeAbogado($cod)
	{
		$sql="SELECT (causa.id_causa)AS idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ , (causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,tribunal,juzgados,piso
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=tribunal.id_causa AND tribunal.id_juzgados=juzgados.id_juzgados AND juzgados.id_piso=piso.id_piso AND causa.id_abogado=$cod AND causa.estadocausa<>'Terminada' GROUP BY causa.id_causa,nombrepiso ORDER BY piso.nombrepiso DESC";
    return parent::ejecutar($sql);
	}


	public function listarCausasActivasPorPisoTerminadas($cod)
	{
		$sql="SELECT (causa.id_causa)AS idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,tribunal,juzgados,piso
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=tribunal.id_causa AND tribunal.id_juzgados=juzgados.id_juzgados AND juzgados.id_piso=piso.id_piso AND piso.id_piso=$cod AND causa.estadocausa='Terminada'";
    return parent::ejecutar($sql);
	}

	public function listarCausasActivasPorPisoCongeladas($cod)
	{
		$sql="SELECT (causa.id_causa)AS idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,tribunal,juzgados,piso
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=tribunal.id_causa AND tribunal.id_juzgados=juzgados.id_juzgados AND juzgados.id_piso=piso.id_piso AND piso.id_piso=$cod AND causa.estadocausa='Congelada'";
    return parent::ejecutar($sql);
	}

	/*ENLISTA Una CAUSA ACTIVA*/
	public function listarUnaCausa($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Activa' AND causa.id_causa=$cod";
    
    return parent::ejecutar($sql);
	}

	/*ENLISTA CAUSA ACTIVA de un tipo legal*/
	public function listarCausaDeUnTipoLegal($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_tipolegal=$cod";
    
    return parent::ejecutar($sql);
	}

	/*ENLISTA CAUSA ACTIVA de un tipo legal,De Un Procuraador*/
	public function listarCausaDeUnTipoLegalDeProcurador($cod,$codproc)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog,estadocausa,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_tipolegal=$cod AND causa.id_procurador=$codproc ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*ENLISTA CAUSA ACTIVA de un tipo legal , y de un Abogado*/
	public function listarCausaDeUnTipoLegalDeAbogado($cod,$codabog)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_tipolegal=$cod AND causa.id_abogado=$codabog ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}


	/*ENLISTA CAUSA congeladas de un tipo legal*/
	public function listarCausaCongeladasDeUnTipoLegal($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_tipolegal=$cod";
    
    return parent::ejecutar($sql);
	}


	/*ENLISTA CAUSA terminadas de un tipo legal*/
	public function listarCausaterminadasDeUnTipoLegal($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_tipolegal=$cod";
    
    return parent::ejecutar($sql);
	}


	/*ENLISTA Una CAUSA */
	public function listarUnaCausaCualquiera($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria  AND causa.id_causa=$cod";
    
    return parent::ejecutar($sql);
	}

	/*ENLISTA Una CAUSA congelada*/
	public function listarUnaCausaCongelada($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_causa=$cod";
    
    return parent::ejecutar($sql);
	}

	/*ENLISTA Una CAUSA terminada*/
	public function listarUnaCausaTerminada($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_causa=$cod";
    
    return parent::ejecutar($sql);
	}
	/*LISTA LAS CAUSA ACTIVAS de un abogado*/
	public function listarcausasactivasdeabogado($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_abogado=$cod ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de un abogado,de un Procurdor*/
	public function listarcausasactivasdeabogadoDeProcurador($cod,$codproc)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ, (causa.id_abogado)as idabog,estadocausa,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_abogado=$cod AND causa.id_procurador=$codproc ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA congeladas de un abogado*/
	public function listarcausasCongeladasdeabogado($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_abogado=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA terminadas de un abogado*/
	public function listarcausasTerminadasdeabogado($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_abogado=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de un procurador*/
	public function listarcausasactivasdeprocurador($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_procurador=$cod ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de un procurador de un Abogado*/
	public function listarcausasactivasdeprocuradorDeAbogado($cod,$codabog)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_procurador=$cod AND causa.id_abogado=$codabog ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}


	/*LISTA LAS CAUSA congeladas de un procurador*/
	public function listarcausasCongeladadeprocurador($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_procurador=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA terminada de un procurador*/
	public function listarcausasTerminadasdeprocurador($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_procurador=$cod";
    
    return parent::ejecutar($sql);
	}


	/*LISTA LAS CAUSA ACTIVAS de un cliente*/
	public function listarcausasactivasdecliente($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_cliente=$cod ORDER BY  causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	

	/*LISTA LAS CAUSA ACTIVAS de un cliente,De un procurador*/
	public function listarcausasactivasdeclienteDeProcurador($cod,$codproc)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_cliente=$cod AND causa.id_procurador=$codproc ORDER BY  causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de un cliente,De un procurador*/
	public function listarcausasactivasdeCategoriaDeProcurador($cod,$codproc)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_categoria=$cod AND causa.id_procurador=$codproc ORDER BY  causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de un cliente, de un Abogado*/
	public function listarcausasactivasdeclienteDeAbogado($cod,$codabog)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_cliente=$cod AND causa.id_abogado=$codabog ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}


	/*LISTA LAS CAUSA congeladas de un cliente*/
	public function listarcausasCongeladasdecliente($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_cliente=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA terminadas de un cliente*/
	public function listarcausasTerminadasdecliente($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_cliente=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de una categoria*/
	public function listarcausasactivasdeCategoria($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,estadocausa,color_causa
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_categoria=$cod ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA ACTIVAS de una categoria de Abogado*/
	public function listarcausasactivasdeCategoriaDeAbogado($cod,$codabog)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ,(causa.id_abogado)as idabog,estadocausa,(procurador.id_procurador)as idprocurador,(cliente.id_cliente)as idcliente
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa<>'Terminada' AND causa.id_categoria=$cod AND causa.id_abogado=$codabog ORDER BY causa.id_causa ASC";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA Congeladas de una categoria*/
	public function listarcausasCongeladasdeCategoria($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada' AND causa.id_categoria=$cod";
    
    return parent::ejecutar($sql);
	}


	/*LISTA LAS CAUSA terminadas de una categoria*/
	public function listarcausasTerminadasdeCategoria($cod)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada' AND causa.id_categoria=$cod";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA CONGELASA*/
	public function listarcausasCongeladas()
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Congelada'";
    
    return parent::ejecutar($sql);
	}

	/*LISTA LAS CAUSA TERMINADAS*/
	public function listarcausasTerminadas()
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.estadocausa='Terminada'";
    
    return parent::ejecutar($sql);
	}

	public function fichacausa($idcausa)
	{
		$sql="SELECT id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig
          FROM causa,materia,tipolegal,abogado,procurador,cliente
         WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND causa.id_causa=$idcausa";
    return parent::ejecutar($sql);
	}

	public function mostrarobservaciones($cod)
	{
		$sql="SELECT obsevacionescausas,objetivos,estrategias,apuntesjuridicos,apunteshonorarios,informacion FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarcajacausa($cod)
	{
		$sql="SELECT caja FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function sumarEldepositoAcaja($cod,$monto)
	{
		$sql="UPDATE causa SET caja=$monto WHERE id_causa=$cod";
		if (parent::ejecutar($sql)) 
			return true;
		else
			return false;
	}

	public function mostrarcodcausa($cod)
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,estadocausa FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND id_causa=$cod";
		return parent::ejecutar($sql);

	}

	public function mostraridcausadeorden($cod)
	{
		$sql="SELECT (causa.id_causa)AS codcausa FROM ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND id_orden=$cod";
		return parent::ejecutar($sql);
	}
  /////////FUNCION PARA LISTAR LAS CAUSAS DE UN ABOGADO, QUE TIENEN ORDENES DESCARGADAS
	public function listarcausasconordenesdescargadas($codabog)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Descargada' AND abogado.id_abogado=$codabog GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	  /////////FUNCION PARA LISTAR LAS CAUSAS DE , QUE TIENEN ORDENES GIRADAS
	public function listarcausasconordenesgiradas()
	{
		ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Girada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}


	  /////////FUNCION PARA LISTAR LAS CAUSAS DE , QUE TIENEN ORDENES GIRADAS de un procurador gestor
	public function listarcausasconordenesgiradasDeProcurador($codproc)
	{
		ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Girada' AND ordengeneral.id_procurador=$codproc AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}


	  /////////FUNCION PARA LISTAR LAS CAUSAS DE UN ABOGADO , QUE TIENEN ORDENES GIRADAS
	public function listarcausasconordenesgiradasDeAbogado($cod)
	{
		ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Girada' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' AND causa.id_abogado=$cod GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRESUPUESTADAS
	public function listarcausasconordenespresupuestadas()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Presupuestada' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
     
     ///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRESUPUESTADAS DE UN PROCURADOR
	public function listarcausasconordenespresupuestadasDeProcurador($codproc)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Presupuestada' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRESUPUESTADAS DE UN ABOGADO
	public function listarcausasconordenespresupuestadasDeAbogado($codabog)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Presupuestada' AND causa.id_abogado=$codabog GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES ACEPTADAS POR EL PROCURADOR
	public function listarcausasconordenesaceptadas()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND ordengeneral.estado_orden='Aceptada' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES ACEPTADAS POR EL PROCURADOR
	public function listarcausasconordenesaceptadasDeProcurador($codproc)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND ordengeneral.estado_orden='Aceptada' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES ACEPTADAS POR EL PROCURADOR(PERO NO SE ANENTREGADO EL DINERO AUN), de causas de un Abogado
	public function listarcausasconordenesaceptadasDeCausaAbogado($codabog)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.estado_orden='Aceptada' AND presupuesto.fecha_entrega='' AND causa.id_abogado=$codabog GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

		///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES CON DINERO ENTREGADO
	public function listarcausasconordenesdineroentregado()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='DineroEntregado' AND fecha_recepcion='' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

		///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES CON DINERO ENTREGADO
	public function listarcausasconordenesdineroentregadoDeProcurador($codproc)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='DineroEntregado' AND ordengeneral.fecha_recepcion='' AND  ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}


		///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES CON DINERO ENTREGADO DE CAUSA DE ABOGADO
	public function listarcausasconordenesdineroentregadoDeCausaDeAbogado($codabog)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND ordengeneral.estado_orden='DineroEntregado' AND ordengeneral.fecha_recepcion='' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	///FUNCION PARA LISTAR LAS CAUSAS CON ORDENES LISTAS PARA DESCARGAR
	public function listarcausasconordeneslistasparadescargar()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado'  GROUP BY causa.id_causa";
       return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS CON ORDENES LISTAS PARA DESCARGAR DE UN PROCURADOR 
	public function listarcausasconordeneslistasparadescargarDeProcurador($codproc)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND ordengeneral.id_procurador=$codproc AND presupuesto.estadopresupuesto='Entregado'  GROUP BY causa.id_causa";
       return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS DE UN ABOGADO CON ORDENES LISTAS PARA DESCARGAR 
	public function listarcausasDeAbogadoconordeneslistasparadescargar($codabog)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND causa.id_abogado=$codabog AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado'  GROUP BY causa.id_causa";
       return parent::ejecutar($sql);
	}
	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES DESCARGADAS
	public function listarcausasconordenesdescargadascontador()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Descargada' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES DESCARGADAS
	public function listarcausasconordenesdescargadasDeUnProcurador($codproc)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Descargada' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS deun abogado QUE TIENEN ORDENES DESCARGADAS
	public function listarcausasDeAbogadoconordenesdescargadascontador($codabog)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND ordengeneral.estado_orden='Descargada' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRONUNCIADAS POR EL ABOGADO
	public function listarcausasconordenespronunciadasabogado()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioAbogado' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRONUNCIADAS POR EL ABOGADO
	public function listarcausasconordenesDeUnProcuradorPronunciadasabogado($codproc)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioAbogado' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS, de un abogado QUE TIENEN ORDENES PRONUNCIADAS POR EL ABOGADO
	public function listarcausasDeAbogadoConOrdenesPronunciadasAbogado($codabog)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND ordengeneral.estado_orden='PronuncioAbogado' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

		///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRONUNCIADAS POR EL CONTADOR
	public function listarcausasconordenespronunciadascontador()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioContador' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRONUNCIADAS POR EL CONTADOR
	public function listarcausasconordenesDeProcuradorpronunciadascontador($codproc)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioContador' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

		///FUNCION PARA LISTAR LAS CAUSAS DE UN ABOGADO QUE TIENEN ORDENES PRONUNCIADAS POR EL CONTADOR
	public function listarcausasDeAbogadoconordenespronunciadascontador($codabog)
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND causa.id_abogado=$codabog AND ordengeneral.estado_orden='PronuncioContador' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
/////////FUNCION PARA LISTAR LAS CAUSAS, QUE TIENEN ORDENES DESCARGADAS  (para que el contador apruebe el gasto)
	public function listarcausasordenespronunciadasabog()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioAbogado' GROUP BY causa.id_causa";
		return parent::ejecutar($sql);
	}
////MUESTRA EL ID DEL ABOGADO ASIGNADO A UNA CAUSA
	public function mostrariddelabogadoenunacausa($cod)
	{
		$sql="SELECT id_abogado FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarcodigocausaysaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,nombrecausa,caja FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal";
		return parent::ejecutar($sql);

	}

	public function mostrarcodigocausaCongeladasYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,(causa.id_causa)as id,nombrecausa,caja,concat(cliente.nombrecli,' ',cliente.apellidocli)as cli FROM causa,materia,tipolegal,cliente WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND estadocausa='Congelada'";
		return parent::ejecutar($sql);

	}
	public function mostrarcodigocausaTerminadasYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,(causa.id_causa)as id, nombrecausa,caja,concat(cliente.nombrecli,' ',cliente.apellidocli)as cli FROM causa,materia,tipolegal,cliente WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND estadocausa='Terminada'";
		return parent::ejecutar($sql);

	}

	public function mostrarcodigocausaConIdDescenenteYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,(causa.id_causa)as id, nombrecausa,caja,concat(cliente.nombrecli,' ',cliente.apellidocli)as cli,estadocausa FROM causa,materia,tipolegal,cliente WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND cliente.id_cliente=causa.id_cliente ORDER BY causa.id_causa DESC";
		return parent::ejecutar($sql);

	}

	public function mostrarcodigocausaConSaldoDescenenteYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,nombrecausa,caja FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal ORDER BY causa.caja DESC";
		return parent::ejecutar($sql);

	}

	public function mostrarcodigocausaConSaldoAscenenteYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,nombrecausa,caja FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal ORDER BY causa.caja ASC";
		return parent::ejecutar($sql);

	}

	public function mostrarcodigocausaActivasYsaldo()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,nombrecausa,caja FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND estadocausa='Activa'";
		return parent::ejecutar($sql);

	}


	public function modificarcajadecausa()
	{
		$sql="UPDATE causa SET caja='$this->cajacausa' WHERE id_causa='$this->id_causa'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function mostrarcodcausadeorden($cod)
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,(ordengeneral.id_causa)as idcausa FROM causa,materia,tipolegal,ordengeneral WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=$cod";
		return parent::ejecutar($sql);
	}
   /*MUESTRA LAS CAUSA ACTIVAS*/
	public function mostrarCodigoDeCausasActivas()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,id_causa FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.estadocausa='Activa'";
		return parent::ejecutar($sql);
	}

	/*MUESTRA LAS CAUSA codigo CONGELADAS*/
	public function mostrarCodigoDeCausasCongeladas()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,id_causa FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.estadocausa='Congelada'";
		return parent::ejecutar($sql);
	}

	/*MUESTRA LAS CAUSA codigo Terminada*/
	public function mostrarCodigoDeCausasTerminadas()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,id_causa FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.estadocausa='Terminada'";
		return parent::ejecutar($sql);
	}


	/*FUNCION QUE MUESTRA LAS CAUSAS QUE PUEDEN PASAR DINERO A OTROS*/
	public function mostrarCausaOrigen()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,id_causa FROM causa,materia,tipolegal WHERE causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal AND causa.estadocausa='Activa' AND caja>1";
		return  parent::ejecutar($sql);
	}

	public function mostrarUnacausa($cod)
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND id_causa=$cod";
    return parent::ejecutar($sql);
	}
    /*MUESTRA UNA CAUSA DE UN ABOGADO*/
	public function mostrarUnacausaDeAbogado($cod,$codabog)
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND id_causa=$cod AND causa.id_abogado=$codabog";
    return parent::ejecutar($sql);
	}


	public function mostraridempleadoCausa($cod)
	{
      $sql="SELECT id_cliente FROM causa WHERE id_causa=$cod";
      return parent::ejecutar($sql);
	}

	public function mostrarDetallesTransferenciasRecibidasDeCausa($cod)
	{
		$sql="SELECT id_deposito,fecha_deposito,detalle_deposito,monto_deposito,concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigocausa,idorigendeposito FROM deposito,causa,materia,tipolegal WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND causa.id_causa=deposito.id_causa AND causa.id_causa=$cod and tipodeposito='Transferencia'";
		return parent::ejecutar($sql);
	}

	public function mostrarDetallesTransferenciasEntregadasDeCausa($cod)
	{
		$sql="SELECT id_deposito,fecha_deposito,detalle_deposito,monto_deposito,id_causa FROM deposito WHERE deposito.idorigendeposito=$cod and tipodeposito='Transferencia'";
		return parent::ejecutar($sql);
	}

	public function mostrarCantidadOrdenesSinSerrar($cod)
	{
      $sql="SELECT COUNT(id_orden)AS conteosinserrar FROM ordengeneral WHERE ordengeneral.estado_orden<>'Serrada' AND ordengeneral.id_causa=$cod";
      return parent::ejecutar($sql);
	}
   /*CAMBIA EL ESTADO DE UNA CAUSA YA SEA PARA CONGELAR, TERMINAR REINICIAR DESCONGELAR*/
	public function cambiarestadoCausa()
	{
		$sql="UPDATE causa SET estadocausa='$this->estadcausa' WHERE id_causa='$this->id_causa'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function devolverSaldoCausa()
	{
		$sql="UPDATE causa SET saldodevuelto='$this->saldodevuelto' WHERE id_causa='$this->id_causa'";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
		
	}

	public function mostrarSaldoDevueltoDeCausa($cod)
	{
		$sql="SELECT saldodevuelto FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarEstadoCausa($cod)
	{
		$sql="SELECT estadocausa FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}
	public function modificarObservacionCausa()
	{
		$sql="UPDATE causa SET obsevacionescausas='$this->obsevcausa', observsolotexto='$this->observsolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function modificarObjetivosCausa()
	{
		$sql="UPDATE causa SET objetivos='$this->objetcausa', objetivossolotexto='$this->objetivossolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function modificarEstrategiasCausa()
	{
		$sql="UPDATE causa SET estrategias='$this->estracausa', estrategiassolotexto='$this->estrategiassolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function modificarApuntesJuridicosCausa()
	{
		$sql="UPDATE causa SET apuntesjuridicos='$this->apuntjurid', apuntesjuridicossolotexto='$this->apuntesjuridicossolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function modificarApuntesHonorarioCausa()
	{
		$sql="UPDATE causa SET apunteshonorarios='$this->apunthonora', apunteshonorariosolotexto='$this->apunteshonorariossolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}
	public function modificarInformacionCausa()
	{
		$sql="UPDATE causa SET informacion='$this->inforcausa',inforsolotexto='$this->inforsolotexto' WHERE id_causa='$this->id_causa' ";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;

	}

	public function mostrarDatosDeUnaCausa($cod)
	{
		$sql="SELECT *FROM causa WHERE id_causa=$cod";
		return parent::ejecutar($sql);
	}

	public function mostarUltimoIdcausaDeUnUsuario($cod)
	{
		$sql="SELECT MAX(id_causa)as idcausaultimo FROM causa WHERE id_usuario=$cod";
		return parent::ejecutar($sql);
	}

	public function mostrarInforme_1()
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (cliente.direccioncli)AS Dircliente,(cliente.telefonocli)AS Telfcli,(cliente.correocli)AS CorreoCli,(cliente.coordenadascli)AS CoorCli, caja, (causa.observsolotexto)as Observ,obsevacionescausas FROM causa,materia,tipolegal,cliente,categoria WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND cliente.id_cliente=causa.id_cliente GROUP BY id_causa ORDER BY caja ASC";
		return parent::ejecutar($sql);
	}

	public function SumadorDeGastoProcesalesDeCausaSinconfirmarPorAdmin($codcausa)
	{
		$sql="SELECT SUM(costofinal.costo_procesal_compra)AS CostoproceSInConfirmar FROM causa, ordengeneral,costofinal WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=costofinal.id_orden AND costofinal.validadofinal='No' AND causa.id_causa=$codcausa";
		return parent::ejecutar($sql);
	}
	public function listarcausasConSaldoENtre300y0()
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (cliente.id_cliente)AS idcli,(cliente.correocli)AS correocliente, caja
FROM causa,materia,tipolegal,cliente
WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND causa.estadocausa<>'Terminada' AND caja BETWEEN 0 AND 300";
return parent::ejecutar($sql);

	}
	public function listarCausasConSaldoMenosCero()
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (cliente.id_cliente)AS idcli,(cliente.correocli)AS correocliente, caja
FROM causa,materia,tipolegal,cliente
WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND caja<60 AND causa.estadocausa<>'Terminada'";
   return parent::ejecutar($sql);

	}
	
	/*------------------------------------------------*/
	public function totalCostosfinalSinCOnfirmar($idcausa)
	{
		$sql="SELECT COUNT(costofinal.id_costofinal)as totalsinconfirmar FROM costofinal,ordengeneral,causa WHERE causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=costofinal.id_orden AND costofinal.validadofinal='No' AND causa.id_causa=$idcausa";
		return parent::ejecutar($sql);
	}
	/*-------------------------------------------------*/


/*********************NUEVAS FUNCIONES PARA LA NUEVA CAJA***********/
 public function mostrarcodigocausaysaldoYcliente()
	{
		$sql="SELECT concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo,nombrecausa,caja, concat(cliente.nombrecli,' ',cliente.apellidocli)as nombcli, (causa.id_causa)as idcausa FROM causa,materia,tipolegal,cliente WHERE cliente.id_cliente=causa.id_cliente AND causa.id_materia=materia.id_materia AND causa.id_tipolegal=tipolegal.id_tipolegal ORDER BY causa.id_causa ASC";
		return parent::ejecutar($sql);

	}

	public function totalDeDepositosDeCausa($idcausa)
	{
		$sql="SELECT SUM(deposito.monto_deposito)AS totaldeposito FROM deposito WHERE deposito.id_causa=$idcausa AND tipodeposito='Deposito'";
		return parent::ejecutar($sql);
	}

	public function totalDevueltoAlCliente($idcausa)
	{
		$sql="SELECT SUM(montodevolucion)AS totaldevuelto FROM devoluciondinero WHERE id_causa=$idcausa";
		return parent::ejecutar($sql);
	}
	
/******************FIN DE NUEVAS FUNCIONES*************************/











/****************FUNCIONES PARA LAS IMPRESIONES EN PDF  PARA EL ADMIN*********************************************/
   public function mostrarInforme_2saldoscongeladas()
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (cliente.direccioncli)AS Dircliente,(cliente.telefonocli)AS Telfcli,(cliente.correocli)AS CorreoCli,(cliente.coordenadascli)AS CoorCli, caja, (causa.observsolotexto)as Observ,obsevacionescausas FROM causa,materia,tipolegal,cliente,categoria WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND causa.estadocausa='Congelada' GROUP BY id_causa ORDER BY caja ASC";
		return parent::ejecutar($sql);
	}

	public function mostrarInforme_3saldosterminados()
	{
		$sql="SELECT (causa.id_causa)idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (cliente.direccioncli)AS Dircliente,(cliente.telefonocli)AS Telfcli,(cliente.correocli)AS CorreoCli,(cliente.coordenadascli)AS CoorCli, caja, (causa.observsolotexto)as Observ,obsevacionescausas FROM causa,materia,tipolegal,cliente,categoria WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND cliente.id_cliente=causa.id_cliente AND causa.estadocausa='Terminada' GROUP BY id_causa ORDER BY caja ASC";
		return parent::ejecutar($sql);
	}

	public function listarTodasLasCausas()
	{
		$sql="SELECT (causa.id_causa)as idcausa,concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo FROM causa,tipolegal,materia WHERE tipolegal.id_tipolegal=causa.id_tipolegal AND materia.id_materia=causa.id_materia ORDER BY causa.id_causa ASC";
		return parent::ejecutar($sql);
	}
	
	/*****************FUNCIONES PARA MOSTRAR RENDIMIENTO DE  PROCURADURIA*********/
    public function funcionParaMostrarRendimientodeProcurduriadeCausa($codcausa)
    {
    	$sql="SELECT (ordengeneral.id_orden)AS codorden,(ordengeneral.informacion)AS CargaInfo,(ordengeneral.prioridad)AS Prioriorden,(ordengeneral.plazo_hora)AS plazoHora,(cotizacion.compra)AS cot_positiva,(cotizacion.penalizacion)AS cot_negativa, concat(procurador.nombreproc,' ',procurador.apellidoproc)AS procuAsignado,(cotizacion.condicioncot)as condicion FROM ordengeneral,cotizacion,procurador WHERE ordengeneral.id_orden=cotizacion.id_orden AND ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_causa=$codcausa ORDER BY ordengeneral.id_orden ASC";
    	return parent::ejecutar($sql);
    }
    public function rendimientoProcuradoriaDeCausa($codcausa)
    {
      $sql="SELECT (a.id_orden)AS codorden,
               (a.informacion)AS CargaInfo,
			   e.detalle_informacion,
               (a.prioridad)AS Prioriorden,
			   ( case when b.condicioncot=1
                     then 'mas de 96'
                     when b.condicioncot=2
                     then '24-96'
                     when b.condicioncot=3
                     then '8-24'
                     when b.condicioncot=4
                     then '3-8'
                     when b.condicioncot=5
                     then '1-3'
                     when b.condicioncot=6
                     then '0-1'
                     end) as plazo_horas,
               (b.compra)AS cot_positiva,
               (b.penalizacion)AS cot_negativa, 
               ifnull((SUM(f.costo_procuradoria_compra+f.penalidadcostofinal)),'') AS pagadoProcurador,            
               concat(c.nombreproc,' ',c.apellidoproc)AS procuAsignado,
               (a.plazo_hora)AS plazoHora
           FROM ordengeneral as a
     inner join cotizacion as b
             ON a.id_orden=b.id_orden
     inner join procurador as c
             ON a.id_procurador=c.id_procurador 
      inner join descargaprocurador as e
             ON e.id_orden=a.id_orden
      inner join costofinal as f
             on f.id_orden=a.id_orden
             and f.canceladoprocurador='Si'
          WHERE a.id_causa=$codcausa
            and a.visible='Si'
          GROUP by a.id_orden  ,e.detalle_informacion,b.condicioncot,b.compra,b.penalizacion
       ORDER BY a.id_orden ASC";
       return parent::ejecutar($sql);
    }

    public function mostrarCostoFinalDeOrden($codorden)
    {
    	$sql="SELECT SUM(costofinal.costo_procuradoria_compra+costofinal.penalidadcostofinal)AS pagadoProcurador FROM costofinal WHERE costofinal.canceladoprocurador='Si' AND costofinal.id_orden=$codorden";
    	return parent::ejecutar($sql);
    }
	/*******************FIN DE FUNCION DERENDIMIENTO DE PROCURADURIA*/



	/***********FUNCION PARA MOSTRAR LAS FECHAS DE TRAMITACION DE ORDENES DE UNA CAUSA*****/
	public function listarOrdenesParaFechasDeTramitacion($codcausa)
	{
		$sql="SELECT (ordengeneral.id_orden)AS codorden,fecha_giro,fecha_recepcion, concat(ordengeneral.fecha_inicio_orden,' ',ordengeneral.hora_inicio)AS Inicio, concat(ordengeneral.fecha_fin_orden,' ',ordengeneral.hora_fin)AS Fin,fecha_cierre, concat(procurador.nombreproc,' ',procurador.apellidoproc)AS ProcuAsig, informacion FROM ordengeneral,procurador WHERE ordengeneral.id_procurador=procurador.id_procurador AND ordengeneral.id_causa=$codcausa ORDER BY ordengeneral.id_orden ASC";
		return parent::ejecutar($sql);
	} 
	/*********FIN DE LAS FUNCION PARA MOSTRAR LAS FECHAS DE TRAMITACION DE ORDENES DE UNA CAUSA*****/
/****************FIN DE LAS FUNCIONES NUEVAS PARA LAS IMPRESIONES EN PDF******************************************/










/*FUNCIONES PARA  LISTADO DE CAUSAS DENTRO DE LOS 8 PASOS (ORDENES DEL ADMIN)*/
public function listarcausasconordenesgiradasDeAdmin()
	{
		ini_set('date.timezone','America/La_Paz');
	     $fechoyal=date("Y-m-d");
	     $horita=date("H:i");
	     ////$concat es la fecha y hora del sistema
	     $concat=$fechoyal.' '.$horita;

		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Girada' AND ordengeneral.tipoorden='ADM' AND concat(fecha_inicio_orden,' ',hora_inicio)<='$concat' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordenespresupuestadasDeAdmin()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Presupuestada' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordenesaceptadasDeAdmin()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND presupuesto.fecha_entrega='' AND ordengeneral.estado_orden='Aceptada' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordenesdineroentregadoDeAdmin()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='DineroEntregado' AND fecha_recepcion='' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordeneslistasparadescargarDeAdmin()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral,presupuesto
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.id_orden=presupuesto.id_orden AND ordengeneral.fecha_recepcion<>'' AND presupuesto.estadopresupuesto='Entregado' AND ordengeneral.tipoorden='ADM'  GROUP BY causa.id_causa";
       return parent::ejecutar($sql);
	}
	public function listarcausasconordenesdescargadascontadorDeAdmin()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Descargada' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordenespronunciadasabogadoDeAdmin()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioAbogado' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	public function listarcausasconordenespronunciadascontadorDeAdmin()
	{
		$sql="SELECT (causa.id_causa)as idcausa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='PronuncioContador' AND ordengeneral.tipoorden='ADM' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

/*FIN DE FUNCIONES PARA  LISTADO DE CAUSAS DENTRO DE LOS 8 PASOS (ORDENES DEL ADMIN)*/

///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRE-PRESUPUESTADAS DE UN PROCURADOR
	public function listarcausasconordenesPre_presupuestadasDeProcurador($codproc)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Pre-presupuestada' AND ordengeneral.id_procurador=$codproc GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}

	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRE-PRESUPUESTADAS
	public function listarcausasconordenesPre_presupuestadas()
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Pre-presupuestada' GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	///FUNCION PARA LISTAR LAS CAUSAS QUE TIENEN ORDENES PRE-PRESUPUESTADAS DE UN ABOGADO
	public function listarcausasconordenesPre_presupuestadasDeAbogado($codabog)
	{
		$sql="SELECT causa.id_causa, concat(materia.abreviaturamat,'-',tipolegal.abreviaturalegal,'-',causa.id_causa)as codigo, nombrecausa, concat(abogado.nombreabog,' ',abogado.apellidoabog)as abogadogestor, concat(procurador.nombreproc,' ',procurador.apellidoproc)as procuradorasig, concat(cliente.nombrecli,' ',cliente.apellidocli)as clienteasig, (categoria.abreviaturacat)as Categ, (causa.obsevacionescausas)as Observ
    FROM causa,materia,tipolegal,abogado,procurador,cliente,categoria,ordengeneral
    WHERE materia.id_materia=causa.id_materia AND tipolegal.id_tipolegal=causa.id_tipolegal AND abogado.id_abogado=causa.id_abogado AND procurador.id_procurador=causa.id_procurador AND cliente.id_cliente=causa.id_cliente AND categoria.id_categoria=causa.id_categoria AND causa.id_causa=ordengeneral.id_causa AND ordengeneral.estado_orden='Pre-presupuestada' AND causa.id_abogado=$codabog GROUP BY causa.id_causa";
    return parent::ejecutar($sql);
	}
	
	// FUNCION PARA ASIGNAR UN COLOR A LA CAUSA
	public function asignarColorA_Causa()
	{
		$sql="UPDATE causa SET color_causa='$this->color_causa' WHERE id_causa='$this->id_causa'";
		if (parent::ejecutar($sql)) 
		  return true;
		else
			return false;
	}


 

}

?>