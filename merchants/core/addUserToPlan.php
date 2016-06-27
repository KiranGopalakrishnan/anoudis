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
$dt=new subscriptionManager($_SESSION["BusinessId"]);
$rdt=$dt->addUserToPlan($_POST["plan"],$cData[0]["E-Mail"]);
//var_dump($rdt["object"]);
//var_dump($_POST);
   $ab= $dt->addSubscription($_POST["planId"],$rdt["id"]);
    echo $ab;