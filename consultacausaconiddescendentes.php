 <tbody>
 <?php
 error_reporting(E_ERROR);
         include_once('model/clscausa.php');
         $objdeposito=new Causa();
        $resul=$objdeposito->mostrarcodigocausaConIdDescenenteYsaldo();
        $totalsaldocausasterminadas=0;
        while ($fila=mysqli_fetch_object($resul)){
            $totalsaldocausasterminadas=$totalsaldocausasterminadas+$fila->caja;
          echo "<tr>"; 
          echo "<td>$fila->codigo</td>";
          echo "<td style='text-align: left;'>$fila->nombrecausa</td>";
          echo "<td style='text-align: right;'>$fila->caja</td>";
          echo "</tr>";


        }


         ?>

         <tr>
           <td colspan="2">SALDO TOTAL DE CAUSA DESCENDENTES</td>
          
           <?php
           echo "<td style='text-align: right;'>$totalsaldocausasterminadas</td>";
           ?>

         </tr>

</tbody>