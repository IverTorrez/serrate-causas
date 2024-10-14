<?php
if (isset($_POST['btnguardartpusu'])) {
   
   guardartpusu();	
}

 function guardartpusu()
{
	$objtipou=new TipoUsuario();

	$objtipou->setnombretipo($_POST['textnombtpusu']);

	if ($objtipou->guardartipousuario()) {
		echo "<script>alert('Se inserto')</script>";
	}
	else{
		echo "<script>alert('No se inserto')</script>";
	}
}

?>