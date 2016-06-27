<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager($_POST["username"]," ",$_POST["password"]);
$rdt=$dt->Login();
if ($rdt!=false){
    echo json_encode($rdt);
}else{
    echo json_encode(false);
}

?>
