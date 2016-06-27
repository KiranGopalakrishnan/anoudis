<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 27-06-2016
 * Time: 10:08 AM
 */
include'class.pointsManager.php';
$pm=new pointsManager();
$bId=$_GET["businessId"];
$uId=$_GET["userId"];
$action="02";
$points=(Intval($_GET["amount"])*10);
$rdt=$pm->addToPointsRegister($points,$bId,$action,$uId);
var_dump($rdt);
