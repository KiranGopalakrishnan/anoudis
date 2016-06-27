<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 20-06-2016
 * Time: 04:10 PM
 */
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$rdt=$dt->getAllSubscription();
echo json_encode($rdt);
?>
