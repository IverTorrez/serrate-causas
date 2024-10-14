<?php
error_reporting(E_ERROR);
session_start();
$saldo=$_POST['saldord'];
$_SESSION['sumatotal']=$_SESSION['sumatotal']+($saldo);
echo $_SESSION['sumatotal'];

?>