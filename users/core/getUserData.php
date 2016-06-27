<?php
session_start();
include 'class.userManager.php';
$dt=new userManager("","","");
$rdt=$dt->getCurrentUserData();
echo json_encode($rdt);
?>
