
<?php


$si=1;
$no=0;
	$contadorlista=$_POST['lista'];/*ASIGNAMOS LOS VALORES DEL CHECKBOX A UNA NUEVA VARIABLE*/

        $nuevocont=count($_POST['lista']);/*ASIGNAMOS UN CONTADOR DE TODOS LOS CHECKBOX QUEESTAN SELECCIONADOS*/

        if ($nuevocont>0) /*PREGUNTAMO SI SE SE SELECCIONO ALGUN CHECKBOX*/
        {
            /*foreach ($contadorlista as $key => $value) 
            {
               echo "<script>alert('$value');</script>";
            }*/
            
           echo 1; 
            
        }
        else
        {
        	echo 0;
            //echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Selecciono Casillas','warning'); </script>";
        }
    
   
	

?>