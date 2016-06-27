<?php
session_start();
$dealId=$_GET["userId"];
include 'class.coupons.php';
$dt=new coupons();
$rdt=array();
$rdt=$dt->retrieveTags($dealId);
echo json_encode($rdt);
?>