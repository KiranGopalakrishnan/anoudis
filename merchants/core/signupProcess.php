<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 13-04-2016
 * Time: 12:23 PM
 */
session_start();
require_once "class.userManager.php";
$dt=new userManager($_POST["email"],$_POST["email"],$_POST["password"]);
$names=explode(" ",$_POST["name"]);
$rst=$dt->Register($names[0],$names[1],"M",$_POST["sex"],date("Y-m-d",strtotime($_POST["dob"])));
if($rst=="E1"){
    header("location:../signup.php?error=E1");
} else{
    $rdt= $dt->Login();
    $to = $_POST["email"];
    $subject = "Anoudis - Confirm your Email Address";
    $txt = "<html><body>Hello There<br/>";
    $txt.="Welcome to Anoudis<br/>";
    $txt.="Please confirm your email id to continue !<br/>";
    $txt.="Please verify your E-mail by <a href>Clicking Here</a></body></html>";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= "From: verify@anoudis.com" . "\r\n";


    $suc=mail($to,$subject,$txt,$headers);


    if($rdt==true) {
         header("location:../newBusiness.php");
    }
}