<?php
session_start();
include 'class.userManager.php';
$dt=new userManager($_POST["username"]," ",$_POST["password"]);
//$dt=new userManager("kiran@gmail.com"," ","kiran");
$rdt=$dt->Login();
if ($rdt!=false){
    echo json_encode($rdt);
}else{
    echo json_encode(false);
}

?>
