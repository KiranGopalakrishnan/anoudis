<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 31-05-2016
 * Time: 12:18 PM
 */
session_start();
include 'class.insightManager.php';
$dt=new insightManager();
$rdt=$dt->getInsights($_SESSION["BusinessId"]);
$audience=$dt->getLargestAudience($_SESSION["BusinessId"]);
$finalData["chart"]=$rdt;
$finalData["pie"]=$audience;
echo json_encode($finalData);