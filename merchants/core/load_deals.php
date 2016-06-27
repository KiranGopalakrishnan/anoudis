<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->retrieveCoupons();
echo json_encode($rdt);
?>
