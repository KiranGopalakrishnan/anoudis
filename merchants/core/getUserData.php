<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager("","","");
$rdt=$dt->getCurrentUserData();
echo json_encode($rdt);
?>
