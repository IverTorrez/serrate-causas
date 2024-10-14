<?php
 error_reporting(E_ERROR);
include_once('model/clspagoprocurador.php');

$objpagoproc=new PagoProcurador();
$resultpago=$objpagoproc->mostrarIdUltimoPagoDeProcurador($_POST['dato']);
$filid=mysqli_fetch_object($resultpago);


	if ($filid->idultimopago>0) 
	{
		$obfechpago=new PagoProcurador();
		$resulfech=$obfechpago->mostrarUnPago($filid->idultimopago);
		$filfecha=mysqli_fetch_object($resulfech);

		$fecha=date_create($filfecha->fechapago);
		$fechaformat=date_format($fecha, 'Y-m-d');

		$fechaformat;

		$hora=date_create($filfecha->fechapago);
		$horaformat=date_format($hora, 'H:i');

		$horaformat;
	}
	else
	{
	  $fechaformat='';
      $horaformat='';
	}

?>

<form method="POST">
 <table id="customers">
        <thead>
           
        </thead>
        <tbody>
        <tr>
                   <td>Desde</td>
                   <td>Fecha Inicio <input type="date" name="fechinicio" value="<?php echo $fechaformat; ?>" > <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Inicio  <input type="time" name="horainico" value="<?php echo $horaformat; ?>"> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                  
                 </tr>

                  <tr>
                   <td>Hasta</td>
                   <td>Fecha Final <input type="date" name="fechafin" required=""> <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></td>
                   <td>Hora</td>
                   <td>Hora Final <input type="time" name="horafin" required=""> <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></td>
                 
                 </tr>

        
            
        </tbody>
    </table>
    </form>