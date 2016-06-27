<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 13-04-2016
 * Time: 02:37 PM
 */
session_start();
require_once 'class.businessManager.php';
require_once "class.insightManager.php";
$dt=new insightManager();
$rdt=$dt->getLargestAudience($_SESSION["BusinessId"]);
var_dump($rdt);