<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager(" "," "," ");
$rdt=$dt->AuthenticateMerchant();
if(!$rdt==true){
    header("location:registration.html");
}
?>
