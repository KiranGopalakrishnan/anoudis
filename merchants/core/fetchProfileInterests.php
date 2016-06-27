<?php
session_start();
//$userId=$_SESSION["userId"];
include 'class.coupons.php';
$dt=new coupons();
$rdt=array();
$rdt=$dt->fetchProfileInterests($_SESSION["user"]);
echo json_encode($rdt);
?>
