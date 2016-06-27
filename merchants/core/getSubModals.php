<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 02:34 PM
 */
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$rdt=$dt->getSubscriptionModels();

echo json_encode($rdt);