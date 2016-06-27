<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->retrieveFeaturedDeals();
echo json_encode($rdt);
?>
