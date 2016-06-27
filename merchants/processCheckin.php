<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 23-05-2016
 * Time: 03:23 PM
 */
session_start();
//$_SESSION["user"]="29";
include 'class.businessManager.php';
include 'class.userManager.php';
$dt=new businessManager();
$rdt=$dt->checkIn($_GET["businessId"],$_GET["userId"]);
$um=new userManager("","","");
$user=$um->getUser($_GET["userId"]);
$business=$dt->getBusiness($_GET["businessId"]);
$merchant=$um->getUser($business[0]["MerchantId"]);
$message=array('notification'=>array(
    'title'=>'Checkin request recieved',
    'text'=>$user[0]["Lastname"]." ". $user[0]["Firstname"]),
    'to'=>$merchant[0]["firebaseId"]
);
$ch = curl_init('https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Key=AIzaSyBe_E7W1gleL7MDmTj6q__jrmkUQxSOYXc',
        'Content-Type: application/json')
);

$result = curl_exec($ch);
echo $result;
echo json_encode($rdt);
//var_dump($message);
