<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 08-03-2016
 * Time: 09:27 AM
 */
session_start();
require_once 'class.postManager.php';
$dt=new postManager();
$_SESSION["BusinessId"]="1";
$dt->addPost("photo","B");
$rdt=$dt->addPhotos($_POST["postdata"]);
echo json_encode($rdt);
?>