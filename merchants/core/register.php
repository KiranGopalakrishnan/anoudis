<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager($_POST["username"],$_POST["email"],$_POST["password"]);
$dt->Register($_POST["firstname"],$_POST["lastname"],$_POST["accountType"],$_POST["dob"]);
$rdt= $dt->Login();
echo json_encode($rdt);
?>
