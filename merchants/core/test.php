<?php
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager("23");
var_dump($_SESSION);
$rdt=$dt->addSubscription("12","2","y","fsadas");
var_dump($rdt);
?>
