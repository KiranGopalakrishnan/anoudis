<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 10-05-2016
 * Time: 09:29 AM
 */
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'class.insightManager.php';
$dt=new insightManager();
$week1=$dt->getDashboardInsights($_SESSION["BusinessId"],"DEAL",0); // The week before starting from today - 14 and ending in today -7
$week2=$dt->getDashboardInsights($_SESSION["BusinessId"],"DEAL",1); // Current week starting from today-7 and ending today
$data="";
//Counting all the result arrays
$data["engagements"][0]=count($week2["engagement"]);
$data["purchases"][0]=count($week2["purchases"]);
$data["engagements"][1]=count($week1["engagement"]);
$data["purchases"][1]=count($week1["purchases"]);
$data["customers"][0]=count($week2["customers"]);
$data["customers"][1]=count($week1["customers"]);

// calculating the increase in metrics and the percentage of increase from previous week
$finalData["engagements"]["count"]=$data["engagements"][0];

$increase1=$data["engagements"][0]-$data["engagements"][1];
$perc1=($increase1/$data["engagements"][0])*100;

$increase2=$data["purchases"][0]-$data["purchases"][1];
$perc2=($increase1/$data["purchases"][0])*100;

$increase3=$data["customers"][0]-$data["customers"][1];
$perc3=($increase3/$data["customers"][0])*100;
//var_dump($increase3);
//Transfering it into a single array for json echoing
$finalData["engagements"]["improvement"]=$perc1;
$finalData["engagements"]["new"]=$data["engagements"][0];
$finalData["purchases"]["improvement"]=$perc2;
$finalData["purchases"]["new"]=$data["purchases"][0];
$finalData["customers"]["improvement"]=$perc3;
$finalData["customers"]["new"]=$data["customers"][0];
echo json_encode($finalData);