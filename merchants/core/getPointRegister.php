<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 08:46 PM
 */
session_start();
require_once 'class.pointsManager.php';
$dt=new pointsManager($_SESSION["BusinessId"]);
$rdt=$dt->getPointRegister();
echo json_encode($rdt);
