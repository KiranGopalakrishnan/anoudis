<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager(" "," "," ");
$rdt=$dt->Authenticate();
if(!$rdt==true){
    header("location:login.php?attempt=1&error=1");
}
?>
