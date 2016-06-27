<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 07:39 PM
 */
session_start();
require_once 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->addBusiness($_POST['businessName'],$_POST['category'],$_POST['buildingNumber'],$_POST['streetName'],$_POST['cityName'],$_POST['provinceName'],$_POST['postalCode'],$_POST['description']);
require_once 'class.subscriptionManager.php';
$sm=new subscriptionManager(" ");
$sm->addPoints("0");
//header("location:../home.php");
?>
