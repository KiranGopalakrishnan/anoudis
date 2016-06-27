<?php
session_start();
require_once 'class.coupons.php';
$dt=new coupons();
$rdt=$dt->getPurchaseCount($_GET["id"]);
echo json_encode($rdt);
?>
