<?php
session_start();
include 'class.userManager.php';
$dt=new userManager(" "," "," ");
$rdt=$dt->Authenticate();
echo $rdt;
?>
