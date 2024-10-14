<?php
error_reporting(E_ERROR);
include_once('model/clstipolegal.php');
echo "<option>ASIGNE TIPO LEGAL</option>";
$objtplegal=new TipoLegal();
$resultplegalmat=$objtplegal->listartipolegalDeUnaMateria($_POST['dato']);
while ($filtp=mysqli_fetch_array($resultplegalmat)) 
 {
   echo '<option value="'.$filtp['id_tipolegal'].'">'.$filtp['abreviaturalegal'].'-'.$filtp['nombretipolegal'].'</option>';	
 } 
?>