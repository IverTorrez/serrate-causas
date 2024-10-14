<?php
if (isset($_POST['btnconfirmarmontos'])) 
{
   confirmarCostofinalSeleccionados();
}

    function  confirmarCostofinalSeleccionados()
    {
        $contadorlista=$_POST['lista'];/*ASIGNAMOS LOS VALORES DEL CHECKBOX A UNA NUEVA VARIABLE*/

        $nuevocont=count($_POST['lista']);/*ASIGNAMOS UN CONTADOR DE TODOS LOS CHECKBOX QUEESTAN SELECCIONADOS*/
        
        $contadorforeach=0;
        if ($nuevocont>0) /*PREGUNTAMO SI SE SE SELECCIONO ALGUN CHECKBOX*/
        {
            foreach ($contadorlista as $key => $value) 
            {
                $objcostofin=new Costofinal();
                $objcostofin->setid_costofinal($value);/*value es el id_costofinal de costofinal*/
                $objcostofin->setvalidadofinal('Si');
                if ($objcostofin->confirmaMontoDescargaCostofinal()) 
                {
                  $contadorforeach++;
                }
                
            }
                 /*PREGUNTA SI DIO LAS VUELTAS SELECCIONADAS Y SE EJECUTARON LAS FUNCIONES*/
                if ($contadorforeach==$nuevocont) 
                {
                   echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Confirmo Todos Los Seleccionados ','success'); </script>"; 
                }
                else
                {
                  echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Al Parecer No Se Confirmo Todos Los Seleccionados','warning'); </script>";
                }
            
            
            
        }
        else
        {
            echo "<script > setTimeout(function(){  }, 2000); swal('ATENCION','No Selecciono Casillas','warning'); </script>";
        }
    }
    ?>