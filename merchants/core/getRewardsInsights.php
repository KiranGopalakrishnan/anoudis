<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 25-04-2016
 * Time: 10:38 PM
 */
session_start();
require_once'class.insightManager.php';
$im=new insightManager();
$nw=Date("Y-m-d");
$date=Date("m",strtotime("-4 months"));
$rdt=$im->getRewardsInsights($_SESSION["BusinessId"],$_GET["action"],$date);

$data="";
for($i=0;$i<5;$i++){
    $dateObj   = DateTime::createFromFormat('!m', $date+$i);
    $monthName = $dateObj->format('F');
    $data[$i]["month"]= $monthName;
    $data[$i]["points"]="0";
}
for($i=0;$i<count($rdt);$i++){

    switch($rdt[$i]["mnth"]){
        case $date+0:
            $data[0]["points"]=$rdt[$i]["points"];
            break;
        case $date+1: $data[1]["points"]=$rdt[$i]["points"];
            break;
        case $date+2: $data[2]["points"]=$rdt[$i]["points"];
            break;
        case $date+3: $data[3]["points"]=$rdt[$i]["points"];
            break;
        case $date+4: $data[4]["points"]=$rdt[$i]["points"];
            break;
    }
}
if(count($data)>0) {
    echo json_encode($data);
}else{
    echo false;
}