<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 03-04-2016
 * Time: 11:50 PM
 */
session_start();
require_once 'class.postManager.php';
$dt=new postManager();
$offId=$dt->addDeal($_POST["dealName"],$_POST["dPrice"],$_POST["aPrice"],(($_POST["dPrice"]/$_POST["aPrice"])*100),$_POST["Description"],$_POST["vFrom"],$_POST["vTill"]);
$rdt=$dt->addPhotos($offId);