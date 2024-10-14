<?php

include_once('../model/clscajasdesalida.php');
include_once('../model/clstransferencia_contador.php');
$obc=new Cajasdesalida();
	$lis=$obc->mostrarcajadelcontador();
	$fila=mysqli_fetch_object($lis);
	$montodeposito=$_POST['textdepositocon'];
	$sumatotal=$montodeposito+$fila->cajacontador;

	$objcaja=new Cajasdesalida();
	$objcaja->setid_cajasalida($_POST['textidcaja']);
	$objcaja->setcajacontador($sumatotal);

	
	$totalcajadm=$_POST['textsaldoadm'];
	if ($montodeposito<=$totalcajadm) {

		
	  if ($objcaja->modificarsaldodecaja()) 
	  {
/*------------CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR----------------------------------------*/
         ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         $objtranscont=new TransferenciaContador();
         $objtranscont->setfechatransferencia($concat);
         $objtranscont->setmontotransferencia($montodeposito);
         $objtranscont->settipotransferencia('Deposito');
         $objtranscont->setId_usuario($_POST['textidusu1']);
         $objtranscont->guardartransferenciaContador();
/*--------------FIN DEL CODIGO NUEVO PARA INSERTAR A LA TABLA DE TRANSFERENCIA_CONTADOR------------------------------*/
		echo 1;
      }
	   else
		{
          echo 0;
		}

    }
    else
    	{
          echo 2;/*PARA EL MENSAJE DE QUE NO PUEDE DEPOSITAR UNA CANTIDAD MAYOR A LA CAJA ADMIN*/
		}

?>