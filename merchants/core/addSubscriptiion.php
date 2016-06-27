<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 03:39 PM
 */
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$rdt=$dt->addSubscription($_GET["subscribe"]);
echo json_encode($rdt);
?>