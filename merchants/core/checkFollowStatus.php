<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 07-03-2016
 * Time: 10:43 PM
 */
session_start();
$id=$_GET["business"];
require_once 'class.businessManager.php';
$dt=new businessManager(" "," "," ");
$rdt=$dt->checkFollowStatus($id);
echo json_encode($rdt);
?>