 <?php
                  //////FUNCIONES PARA MOSTRAR EL TOTAL DE CADA ORDEN EN SUS PASOS DE SEGUIMUIENTO
                  

                   $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradas();
                   $fil1=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadas();
                   $fil2=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadas();
                   $fil3=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregado();
                   $fil4=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizar();
                   $fil5=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadas();
                   $fil6=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenespronunciabogado();
                   $fil7=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenespronunciocontador();
                   $fil8=mysqli_fetch_object($resul8); 

                   // $objorden9=new OrdenGeneral();
                   // $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   // $fil9=mysqli_fetch_object($resul9);

                   // $objorden10=new OrdenGeneral();
                   // $resul10=$objorden10->mostrarTotalVencidasGraves();
                   // $fil10=mysqli_fetch_object($resul10);

                  ?>
                


<div class="collapsible">BOTONES DE SEGUIMIENTO GENERAL</div>
<div class="content">
    <ul style="padding-top: 2px;">
      <li><button class="botones" style="width: 150px; height: 50px;" onclick="location.href='causasordenesgiradas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil1->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

      <li><button class="botones" style="width: 150px; height: 50px;" onclick="location.href='causasordenespresupuestadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

      <li><button class="botones" style="width: 145px; height: 50px;" onclick="location.href='causasordenesaceptadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: INF/DOC  &nbsp;&nbsp;ENTREGADOS &nbsp;</button></li>
                   
      <li><button class="botones" style="width: 140px; height: 50px; " onclick="location.href='causasordenesdineroentregado.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

      <li><button class="botones" style="width: 140px; height: 50px; " onclick="location.href='causasordeneslistasparadescargar.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

      <li><button class="botones"  style="width: 150px; height: 50px; " onclick="location.href='causasordenesdescargadas.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>
                   
      <li><button class="botones" onclick="location.href='causasordenespronunciadasabogado.php'" style="width: 160px; height: 50px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

      <li><button class="botones" style="width: 145px; height: 50px;" onclick="location.href='causasordenespronunciadascontador.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>



                    
    </ul>
</div>
<br>










<?php
    /*contadores especiales para el admin*/
                 $objorden1=new OrdenGeneral();
                   $resul1=$objorden1->mostrartotalordenesgiradasDeAdmin();
                   $fil1A=mysqli_fetch_object($resul1);

                   $objorden2=new OrdenGeneral();
                   $resul2=$objorden2->mostrartotalordenespresupuestadasDeAdmin();
                   $fil2A=mysqli_fetch_object($resul2);

                   $objorden3=new OrdenGeneral();
                   $resul3=$objorden3->mostrartotalordenesaceptadasDeAdmin();
                   $fil3A=mysqli_fetch_object($resul3);

                   $objorden4=new OrdenGeneral();
                   $resul4=$objorden4->mostrartotalordenesdineroentregadoDeAdmin();
                   $fil4A=mysqli_fetch_object($resul4);

                   $objorden5=new OrdenGeneral();
                   $resul5=$objorden5->mostrartotlalistaspararealizarDeAdmin();
                   $fil5A=mysqli_fetch_object($resul5);

                   $objorden6=new OrdenGeneral();
                   $resul6=$objorden6->mostrartotalordenesdescargadasDeAdmin();
                   $fil6A=mysqli_fetch_object($resul6);

                   $objorden7=new OrdenGeneral();
                   $resul7=$objorden7->mostrartotalordenespronunciabogadoDeAdmin();
                   $fil7A=mysqli_fetch_object($resul7);

                   $objorden8=new OrdenGeneral();
                   $resul8=$objorden8->mostrartotalordenespronunciocontadorDeAdmin();
                   $fil8A=mysqli_fetch_object($resul8); 

                   // $objorden9=new OrdenGeneral();
                   // $resul9=$objorden9->mostrartotalordenesVencidasLeves();
                   // $fil9=mysqli_fetch_object($resul9);

                   // $objorden10=new OrdenGeneral();
                   // $resul10=$objorden10->mostrarTotalVencidasGraves();
                   // $fil10=mysqli_fetch_object($resul10);


?>




<div class="collapsible">BOTONES DE SEGUIMIENTO ESPECIAL</div>
<div class="content">
    <ul style="padding-top: 2px;">
      <li><button class="botones" style="width: 150px; height: 50px;" onclick="location.href='causas_ordenesgiradas_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil1A->Totalgiradas; ?>&nbsp;&nbsp;</span><br>1: ORDENES GIRADAS </button></li>

      <li><button class="botones" style="width: 150px; height: 50px;" onclick="location.href='causas_ordenespresupuestadas_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil2A->Totalpresupuestadas; ?>&nbsp;&nbsp;</span><br>2: PRESUPUESTADAS &nbsp;&nbsp;</button></li>

      <li><button class="botones" style="width: 145px; height: 50px;" onclick="location.href='causas_ordenesaceptadas_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil3A->Totalaceptadas; ?>&nbsp;&nbsp;</span><br>3: INF/DOC  &nbsp;&nbsp;ENTREGADOS &nbsp;</button></li>
                   
      <li><button class="botones" style="width: 140px; height: 50px; " onclick="location.href='causas_ordenesdineroentegado_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil4A->Totalentregado; ?>&nbsp;&nbsp;</span><br>4: DINERO ENTREGADO </button></li>

      <li><button class="botones" style="width: 140px; height: 50px; " onclick="location.href='causas_ordeneslistasrealizar_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil5A->Totallistasrealizar; ?>&nbsp;&nbsp;</span><br>5: LISTAS PRA REALIZAR </button></li>

      <li><button class="botones"  style="width: 150px; height: 50px; " onclick="location.href='causas_ordenesdescargadas_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil6A->Totaldescargadas; ?>&nbsp;&nbsp;</span><br>6: DESCARGADAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></li>
                   
      <li><button class="botones" onclick="location.href='causas_ordenespronuncioabogado_admin.php'" style="width: 160px; height: 50px;"><span id="contadores">&nbsp;&nbsp;<?php echo $fil7A->Totalpronunabogado; ?>&nbsp;&nbsp;</span><br>7: PRONUNCIAMIENTO DEL ABOGADO </button></li> 

      <li><button class="botones" style="width: 145px; height: 50px;" onclick="location.href='causas_ordenescuentasconciliadas_admin.php'"><span id="contadores">&nbsp;&nbsp;<?php echo $fil8A->Totalpronuncontador; ?>&nbsp;&nbsp;</span><br>8: CUENTAS CONCILIADAS </button></li>



                    
    </ul>
</div>


























<style type="text/css">
  .collapsible {
  background-color: #1A5895;
  color: #ffffff;
  cursor: pointer;
  padding: 5px;
  width: 99%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 11px;
}

.active, .collapsible:hover {
  background-color: #1A5895;
}

.content {
  
  /*display: none;*/
  display: block;
  overflow: hidden;
  background-color: #f1f1f1;
}

</style>

<script type="text/javascript">
  // var coll = document.getElementsByClassName("collapsible");
  // var i;

  // for (i = 0; i < coll.length; i++) {
  //   coll[i].addEventListener("click", function() {
  //     this.classList.toggle("active");
  //     var content = this.nextElementSibling;
  //     if (content.style.display === "block") {
  //       content.style.display = "none";
  //     } else {
  //       content.style.display = "block";
  //     }
  //   });
  // }
</script>