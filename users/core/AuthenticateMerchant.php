<?php
session_start();
include 'class.userManager.php';
$dt=new userManager(" "," "," ");
$rdt=$dt->AuthenticateMerchant();
if(!$rdt==true){
    header("location:registration.html");
}
?>
