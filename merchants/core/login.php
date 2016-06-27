<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager($_POST["username"]," ",$_POST["password"]);
$rdt=$dt->Login();
if ($rdt==true){
    $chk=$dt->checkFbPage();
    if($chk==false){
        header("location:../social.php");
    }else{
        header("location:../home.php");
    }
}else{
    header("location:../login.php?error=1");
}

?>
