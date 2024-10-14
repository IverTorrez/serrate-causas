<?php
error_reporting(E_ERROR);
session_start();

$montopresu=$_POST['montoentregar'];
$_SESSION['sumatotalentrga']=$_SESSION['sumatotalentrga']+($montopresu);

echo $_SESSION['sumatotalentrga'];

?>