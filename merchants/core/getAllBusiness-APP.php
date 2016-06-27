<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 12-04-2016
 * Time: 11:42 AM
 */
session_start();
require_once 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->getAllBusiness($_POST["merchant"]);
echo json_encode($rdt);
?>