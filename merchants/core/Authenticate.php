<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager(" "," "," ");
$rdt=$dt->Authenticate();
echo json_encode($rdt);
?>
