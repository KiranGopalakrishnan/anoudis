<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->retrieveLastMinuteDeals();
echo json_encode($rdt);
?>
