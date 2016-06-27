<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->retrieveMainDeal();
echo json_encode($rdt);
?>
