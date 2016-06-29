<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 12-04-2016
 * Time: 12:12 AM
 */
session_start();
require_once 'class.subscriptionManager.php';
require_once 'class.userManager.php';
$um=new userManager(" "," "," ");
$cData=$um->getUser($_SESSION["MerchantId"]);
$term = $_POST["term"];
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$planData=$dt->getSubscriptionData($_POST["plan"]);
$plan=$planData[0]["subName"];
if($term=="Y"){
    $plan=$planData[0]["subName"].strtolower($term);
}

var_dump($plan);
$rdt=$dt->addUserToPlan($plan,$cData[0]["E-Mail"]);
//var_dump($rdt["object"]);
//var_dump($_POST);
   $ab= $dt->addSubscription($_SESSION["MerchantId"],$_POST["plan"],$term,$rdt["id"]);
    echo $ab;