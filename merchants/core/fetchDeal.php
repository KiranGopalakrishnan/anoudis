<?php
session_start();
//$userId=$_SESSION["userId"];
$id=$_GET["id"];
include 'class.coupons.php';
$dt=new coupons();
$rdt=array();
$rdt=$dt->retrieveDeal($id);
echo json_encode($rdt);
?>
