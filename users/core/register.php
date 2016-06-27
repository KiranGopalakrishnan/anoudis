<?php
session_start();
include 'class.userManager.php';
$dt=new userManager($_POST["email"],$_POST["email"],$_POST["password"]);
$dt->Register($_POST["firstname"],$_POST["lastname"],$_POST["accountType"],$_POST["sex"],$_POST["dob"]);
$rdt= $dt->Login();
echo json_encode($rdt);
?>
