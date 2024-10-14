<?php
include_once('../model/clsordengeneral.php');
$idorden=$_POST['idorden'];
$sugerencia_presupuesto=$_POST['sugerencia_presu_html'];

$objorden=new OrdenGeneral();
$resultveriorden=$objorden->mustraestadodeunaorden($idorden);
$filverif=mysqli_fetch_object($resultveriorden);
/*PREGUNTAMOS SI LA ORDEN ESTA GIRADA O , POR VERDADERO PODEMOS HACER EL PRE-PRESUPUESTO*/
if ($filverif->estado_orden=='Girada' || $filverif->estado_orden=='Pre-presupuestada') 
{
	$objorden->setid_orden($idorden);
	$objorden->setestadoorden('Pre-presupuestada');
	$objorden->set_sugerencia_presupuesto($sugerencia_presupuesto);
	if ($objorden->pre_presupuestarUnaOrden()) 
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
	
	
}/*FIN DEL IF QUE PREGUNTA SI EL ESTADO DE LA ORDEN ES IGUAL A GIRADA*/

/*por falso, mostramos mensaje que no puede sugerir presupuesto*/
else
{
  echo 2;
}
?>