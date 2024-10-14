<?php
error_reporting(E_ERROR);
session_start();
$montopres=$_POST['montoentregar'];
$_SESSION['sumatotalentrga']=$_SESSION['sumatotalentrga']-($montopres);

echo $_SESSION['sumatotalentrga'];

?>