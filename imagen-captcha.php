<?php 
error_reporting(E_ERROR);
session_start();
header("Content-Type: image/png");
$ancho = 100;
$alto = 30;
$im = imagecreate($ancho, $alto) or die("Ha ocurrido un error, librería de funciones GD no disponible");
$color_fondo = imagecolorallocate($im, 130, 194, 68);
$color_texto = imagecolorallocate($im, 0, 0, 0);

function generate_captcha($chars, $length)
{
$captcha = null;
for ($x = 0; $x < $length; $x++)
{
$rand = rand(0, count($chars)-1);
$captcha .= $chars[$rand];
}
return $captcha;
}
$captcha = generate_captcha(array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'), 3); /* 5 es la longitud del capcha */
/*CREA SESION DE CAPTCHA PARA VALIDARLO*/
$_SESSION['captcha']=base64_encode($captcha);

$color3 = ImageColorAllocate($im, 26, 88, 149);

// Líneas diagonales
    imageline($im, 0, 5, $ancho, 5, $color3);
    imageline($im, $ancho/4, 0, $ancho/2, $alto, $color3);
    imageline($im, 0, 18, $ancho, 18, $color3);
    imageline($im, 46, 0, 86, $alto, $color3);


ImageString($im, 5, 30, 3, $captcha, $color_texto);
imagepng($im);

// Liberamos recursos
    ImageDestroy($im);

?>

