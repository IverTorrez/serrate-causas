<?php
include_once('../model/clscajasdesalida.php');
include_once('../model/clstransferencia_contador.php');


	$objcajacont=new Cajasdesalida();
	$objcajacont->setcajacontador(0);
	$objcajacont->setid_cajasalida(1);

	if ($objcajacont->devolverTodoelDinerodelContador()) 
	{
/*------------CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR----------------------------------------*/
         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;
         $montodev=$_POST['montodevcont'];

         $objtranscont=new TransferenciaContador();
         $objtranscont->setfechatransferencia($concat);
         $objtranscont->setmontotransferencia($montodev);
         $objtranscont->settipotransferencia('Devolucion');
         $objtranscont->setId_usuario($_POST['textidusu1']);
         $objtranscont->guardartransferenciaContador();
/*--------------FIN DEL CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR------------------------------*/
		echo 1;
	}
	else
	{
		 echo 0;
	}

?>