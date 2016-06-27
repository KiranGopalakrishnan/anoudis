<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 02:50 PM
 */
session_start();
require_once 'class.businessManager.php';
$bm=new businessManager();
if(isset($_SESSION["BusinessId"])){
    $businessId=$_SESSION["BusinessId"];
}else{
    $businessId=$_POST["businessId"];
}
$rdt3=$bm->getRemainingPoints($businessId);
$rdt2[0]["RemPoints"]=$rdt3[0]["points"];
echo json_encode($rdt2);