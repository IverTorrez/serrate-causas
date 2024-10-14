

 <h3 style="color: #000000;font-size: 30px;text-align: center; text-shadow: -2px -2px 5px #333">SALDOS DE LAS CAUSAS CONGELADAS</h3>
<table id="customers">
       <thead>
         <tr>
           <th width="25%">CODIGO DE CAUSA</th>
           <th>NOMBRE DE LA CAUSA</th>
           <th width="10%" >SALDO</th>
         </tr>
       </thead>
       <tbody>
         

         <?php
         error_reporting(E_ERROR);
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaCongeladasYsaldo();
        $totalsaldocausascongeladas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausascongeladas=$totalsaldocausascongeladas+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA CONGELADAS</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausascongeladas</td>";
           ?>

         </tr>
       </tbody>
     </table>