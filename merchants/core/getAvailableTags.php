<?php
session_start();
$search=$_GET["search"];
include 'class.coupons.php';
$dt=new coupons();
$rdt=array();
$rdt=$dt->getAvailableTags($search);
echo json_encode($rdt);
?>