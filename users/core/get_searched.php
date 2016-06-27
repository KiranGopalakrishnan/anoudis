<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=array();
$rdt=$dt->retrieveCouponsFromSearch("chain");
echo json_encode("chain");
?>
