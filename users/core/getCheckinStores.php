<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 28-03-2016
 * Time: 08:27 PM
 */
include 'class.locationManager.php';
$locManager=new locationManager($_POST["latitude"],$_POST["longitude"]);
$dt=$locManager->getNearestStores(".100");
if(count($dt)>0){
    echo json_encode($dt);
}else{
    echo json_encode(false);
}