<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 03:27 PM
 */
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager(" ");
$rdt=$dt->getSubscription($_GET["subscribe"]);
echo json_encode($rdt);
?>
