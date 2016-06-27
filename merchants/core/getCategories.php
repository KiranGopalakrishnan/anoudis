<?php
include 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->getCategories();
echo json_encode($rdt);
?>
