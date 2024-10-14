<?php
/*FUNCION QUE HACE LA TRANSFERENCIA DE DINERO DE UNA CAUSA A OTRA*/ 
if (isset($_POST['btntransferencia'])) 
     {
       registrartransferencia();
     }
function registrartransferencia()
{
  ini_set('date.timezone','America/La_Paz');
         $fechoyal=date("Y-m-d");
         $horita=date("H:i");
         $concat=$fechoyal.' '.$horita;

         $idorigen=$_POST['selectcausaorigen'];
         $iddestino=$_POST['selectdestino'];
         $montotranfer=$_POST['textmontotransferencia'];
         /*PREGUNTA SI LA CAUSA ORIGEN ES IGUAL A CAUSA DESTINO*/
  if ($idorigen!=0 and $iddestino!=0) 
  {   $idcli1=0;
      $idcli2=0;

      $objcausa5=new Causa();
      $resultcausa=$objcausa5->mostraridempleadoCausa($idorigen);
      $filid=mysqli_fetch_object($resultcausa);
      $idcli1=$filid->id_cliente;

      $objcausa6=new Causa();
      $resultcausa2=$objcausa6->mostraridempleadoCausa($iddestino);
      $filid2=mysqli_fetch_object($resultcausa2);
      $idcli2=$filid2->id_cliente;

      if ($idcli1==$idcli2) 
        {
          
      
      
      
                 if ($idorigen==$iddestino) 
                 {
                    echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Causa Origen Tiene Que ser Diferente a Causa Destino','warning'); </script>";
                 }
                 else
                 {  $objcausa1=new Causa();
                    $list1=$objcausa1->mostrarcajacausa($idorigen);
                    $fil1=mysqli_fetch_object($list1);
                    $montocajaorigen=$fil1->caja;

                    if ($montotranfer<=$montocajaorigen)
                    {
                        /*MODIFICA LA CAJA DE CAUSA ORIGEN(EL QUE ENTREGA DINERO) */
                         $objcausa=new Causa();
                         $list=$objcausa->mostrarcajacausa($idorigen);
                         $fil=mysqli_fetch_object($list);
                         $saldocajaorigen=$fil->caja;
                         $nuevacajaorigen=$saldocajaorigen-$montotranfer;

                         $objcausa2=new Causa();
                         $objcausa2->setid_causa($idorigen);
                         $objcausa2->setcajacausa($nuevacajaorigen);
                         $objcausa2->modificarcajadecausa();
                        /*MODIFICA EL SALDO DE LA CAUSA DESTINO (EL QUE RECIBE DINERO)*/
                         $objcausa3=new Causa();
                         $list3=$objcausa3->mostrarcajacausa($iddestino);
                         $fil3=mysqli_fetch_object($list3);
                         $saldocajadestino=$fil3->caja;
                         $nuevacajadestino=$saldocajadestino+$montotranfer;

                         $objcausa4=new Causa();
                         $objcausa4->setid_causa($iddestino);
                         $objcausa4->setcajacausa($nuevacajadestino);
                         $objcausa4->modificarcajadecausa();

                         /*FUNCION QUE GUARDA EL DEPOSITO*/
                         
                         $objdeposito=new Deposito();
                         $objdeposito->setfechadeposito($concat);
                         $objdeposito->setdetalledeposito('Es Transferencia');
                         $objdeposito->setmontodeposito($montotranfer);
                         $objdeposito->setid_causadeposito($iddestino);
                         $objdeposito->settipodeposito('Transferencia');
                         $objdeposito->setidorigen($idorigen);

                         if ($objdeposito->guardardeposito()) 
                         {
/*------------ENVIO DE CORREO AL CLIENTE-------------------------------------------------*/
                           $senior = stripslashes('Señor'); /*se pasa los datos para que se interprete*/
                           $senior = iconv('UTF-8', 'windows-1252', $senior);

                           $codigo1 = stripslashes('código'); /*se pasa los datos para que se interprete*/
                           $codigo1 = iconv('UTF-8', 'windows-1252', $codigo1);
                           /*-----obtenemos el correo del cliente--------------*/
                           $objcli=new Cliente();
                           $resulcli=$objcli->mostrarUNClienteenCausa($iddestino);
                           $filcli=mysqli_fetch_object($resulcli);
                           $destino=$filcli->correocli;

                           /*CAUSA ORIGEN*/
                           $objcodcausa=new Causa();
                           $resulcod=$objcodcausa->listarUnaCausaCualquiera($idorigen);
                           $filcod=mysqli_fetch_object($resulcod);
                           $codigocausaorigen=$filcod->codigo;
                           $nombreorigen=$filcod->nombrecausa;
                           /*CAUSA DESTINO*/
                           $objcodcausa1=new Causa();
                           $resulcod1=$objcodcausa1->listarUnaCausaCualquiera($iddestino);
                           $filcod1=mysqli_fetch_object($resulcod1);
                           $codigocausadestino=$filcod1->codigo;
                           $nombredestino=$filcod1->nombrecausa;

                           $asunto="Recibo De Transferencia";
                           $mensajedecorreo="$senior cliente \n";
                           $mensajedecorreo.="Informamos a usted, que se ha transferido el monto de $montotranfer Bs. de la causa con $codigo1 $codigocausaorigen de nombre $nombreorigen, a la causa de $codigo1 $codigocausadestino de nombre $nombredestino.\n ";
                           $mensajedecorreo.="El Administrador.";
                            $cabeceras = 'From: SERRATE <info@serrate.bo>' . "\r\n" .
                                        'Reply-To:  info@serrate.bo' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion();
                          mail($destino,$asunto,$mensajedecorreo,$cabeceras);
/*-------------FIN DE ENVIO DE CORREO AL CLIENTE-----------------------------------------*/
                                                  
                            echo "<script > setTimeout(function(){  }, 2000); swal('EXELENTE','Se Deposito a la Causa','success'); </script>";
                           
                         }
                         else
                         {
                           echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Deposito','warning'); </script>"; 
                         }
                    }/*FIN DEL IF QUE PREGUNTA SI EL MONTO DE TRANSFERENCIA ES MENOR O IGUAL A LA CAJA DE CAUSA ORIGEN*/
                    else
                    {
                        echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','La caja de causa origen es menor al monto de transferencia','warning'); </script>";
                    }

                         
                 }/*FIN DEL ELSE QUE EJECUTA CUANDO LA CAUSA ORIGEN Y DESTINO NO SON IGUALES*/

        }//fin del if que pregunta si la causa es del mismo cliente
        else
        {
          echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Solo se puede transferir entre causas del mismo cliente','warning'); </script>";
        }
    }//IF QUE PREGUNTA SI ESCOGIO CAUSAS 
    else
    {
        echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','Debe seleccionar causa origen y causa Destino','warning'); </script>";
    }

         
} 
     
?>
