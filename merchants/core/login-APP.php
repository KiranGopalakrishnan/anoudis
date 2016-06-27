<?php
session_start();
require_once 'class.userManager.php';
$dt=new userManager($_POST["username"]," ",$_POST["password"]);
$rdt=$dt->Login();
if ($rdt!=false){
    $udt=$dt->getCurrentUserData();
    echo json_encode($udt);
}else{
    echo json_encode(false);
}

?>
