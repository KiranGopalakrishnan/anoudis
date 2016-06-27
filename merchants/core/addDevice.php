<?php
session_start();
include 'class.businessManager.php';
$bm=new businessManager();
$fId=$_POST["token"];
$bId=$_POST["business"];
$rdt=$bm->addDevice($fId,$bId);
echo "Done";
