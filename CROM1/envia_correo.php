<?php
//wget -nv -O /dev/null http://
error_reporting(E_ERROR);
ini_set('date.timezone','America/La_Paz');
$fechoyal=date("Y-m-d");
$horita=date("H:i");
$concat=$fechoyal.' '.$horita;
$destino="ivertorrez23@hotmail.com";
$asunto="Prueba cada 5 min. $concat";
$mensajedecorreo="ESTE ES UN MENSAJE CADA 5 MINUTOS";

$cabeceras = 'From: SERRATE <ronaldocr7ventura@gmail.com>' . "\r\n" .
'Reply-To: ronaldocr7ventura@gmail.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($destino,$asunto,$mensajedecorreo,$cabeceras);
?>