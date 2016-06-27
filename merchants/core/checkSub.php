<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 02:11 PM
 */
session_start();
require_once 'class.subscriptionManager.php';
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$rdt=$dt->checkSubscription($_SESSION["BusinessId"]);
if(count($rdt)>0){
    echo json_encode($rdt);
}
else{
    echo json_encode(false);
}