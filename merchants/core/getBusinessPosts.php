<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 08-03-2016
 * Time: 10:29 AM
 */
session_start();
$id=$_GET["business"];
include 'class.postManager.php';
$dt=new postManager();
$rdt=$dt->readBusinessPosts($id);
echo json_encode($rdt);
?>